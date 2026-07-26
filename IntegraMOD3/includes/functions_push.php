<?php
/**
 * OneSignal Push Notification Integration
 *
 * This file handles push notification delivery via OneSignal API for IntegraMOD 3.0.16 (phpBB 3.0.15).
 * Compatible with PHP 5.6 through 8.5.
 *
 * @package IM_PushNotifications
 * @version 2.0
 * @author HelterSkelter
 * @license GNU General Public License v2
 */

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Encrypt a mobile number for storage.
 * Prefers libsodium (PHP 7.2+ core, avoids broken OpenSSL builds), falls back to OpenSSL.
 *
 * @param string $plain Plain phone number
 * @return string Base64 packed payload, or '' on failure
 */
function im3_encrypt_mobile($plain)
{
	if ($plain === '')
	{
		return '';
	}

	if (function_exists('sodium_crypto_secretbox'))
	{
		$key = substr(hash('sha256', IM3_SMS_KEY, true), 0, SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
		$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
		$cipher = sodium_crypto_secretbox($plain, $nonce, $key);
		return base64_encode(json_encode(array(
			'alg'   => 'sodium',
			'iv'    => base64_encode($nonce),
			'value' => base64_encode($cipher),
		)));
	}

	if (function_exists('openssl_encrypt'))
	{
		$key = substr(hash('sha256', IM3_SMS_KEY, true), 0, 32);
		$iv = function_exists('random_bytes') ? random_bytes(16) : openssl_random_pseudo_bytes(16);
		$cipher = openssl_encrypt($plain, 'aes-256-cbc', $key, 0, $iv);
		if ($cipher !== false)
		{
			return base64_encode(json_encode(array(
				'alg'   => 'openssl',
				'iv'    => base64_encode($iv),
				'value' => $cipher,
			)));
		}
	}

	return '';
}

/**
 * Decrypt a stored mobile number payload.
 *
 * @param string $stored Base64 packed payload from the database
 * @param bool   $raw    If true, return the raw stored value (keeps the +CC.NUMBER separator).
 *                       If false (default), return a normalized E.164 number for sending.
 * @return string|false Plain phone number or false on failure
 */
function im3_decrypt_mobile($stored, $raw = false)
{
	if (empty($stored))
	{
		return false;
	}

	$pack = @json_decode(base64_decode($stored), true);
	if (!is_array($pack) || !isset($pack['iv']) || !isset($pack['value']))
	{
		return false;
	}

	$alg = isset($pack['alg']) ? $pack['alg'] : 'openssl';
	$plain = false;

	if ($alg === 'sodium' && function_exists('sodium_crypto_secretbox_open'))
	{
		$key = substr(hash('sha256', IM3_SMS_KEY, true), 0, SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
		$plain = @sodium_crypto_secretbox_open(base64_decode($pack['value']), base64_decode($pack['iv']), $key);
	}
	else if (function_exists('openssl_decrypt'))
	{
		$key = substr(hash('sha256', IM3_SMS_KEY, true), 0, 32);
		$plain = openssl_decrypt($pack['value'], 'aes-256-cbc', $key, 0, base64_decode($pack['iv']));
	}

	if ($plain === false)
	{
		return false;
	}

	// Normalize +CC.NUMBER to E.164 for gateway use unless raw requested
	return $raw ? $plain : str_replace('.', '', $plain);
}

/**
 * Trigger a push notification to a single user
 *
 * @param int    $target_user_id The phpBB user_id to receive the notification
 * @param string $event_type     Event type (friend_req, friend_acc, pm, like, activity, sub_post, sub_topic)
 * @param string $title          Notification title
 * @param string $message        Notification body message
 * @param string $url            URL to open when notification is clicked (optional)
 *
 * @return bool Returns true on success, false on failure
 */
function trigger_user_push($target_user_id, $event_type, $title, $message, $url = '')
{
	global $db, $config;

	// Query user preferences and mobile info
	$sql = 'SELECT user_push_web_' . $db->sql_escape($event_type) . ', 
				   user_push_sms_' . $db->sql_escape($event_type) . ', 
				   user_mobile
			FROM ' . USERS_TABLE . ' 
			WHERE user_id = ' . (int) $target_user_id;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if (empty($row))
	{
		return false;
	}

	$web_sent = false;
	$sms_sent = false;

	// WEB PUSH logic
	if (!empty($config['onesignal_app_id']) && !empty($config['onesignal_rest_key']))
	{
		$web_config_key = 'push_allow_web_' . $event_type;
		if (isset($config[$web_config_key]) && $config[$web_config_key])
		{
			if (!empty($row['user_push_web_' . $event_type]))
			{
				$payload = array(
					'app_id' => $config['onesignal_app_id'],
					'include_external_user_ids' => array((string) $target_user_id),
					'headings' => array('en' => $title),
					'contents' => array('en' => $message),
				);

				if (!empty($url))
				{
					$payload['url'] = $url;
				}

				if (onesignal_send_request($payload, $config['onesignal_rest_key']))
				{
					$web_sent = true;
				}
			}
		}
	}

	// SMS PUSH logic
	$sms_config_key = 'push_allow_sms_' . $event_type;
	if (isset($config[$sms_config_key]) && $config[$sms_config_key])
	{
		if (!empty($row['user_push_sms_' . $event_type]) && !empty($row['user_mobile']))
		{
			// Decrypt mobile number
			$decrypted_mobile = im3_decrypt_mobile($row['user_mobile']);

			if ($decrypted_mobile)
			{
				$sms_text = $title . ": " . $message;
				if (!empty($url)) {
					$sms_text .= " " . $url;
				}

				$gateway = isset($config['sms_gateway']) ? $config['sms_gateway'] : 'onesignal';

				if ($gateway === 'twilio' && !empty($config['twilio_sid']) && !empty($config['twilio_token']) && !empty($config['twilio_from_number']))
				{
					if (send_twilio_sms($config['twilio_sid'], $config['twilio_token'], $config['twilio_from_number'], $decrypted_mobile, $sms_text))
					{
						$sms_sent = true;
					}
				}
				elseif ($gateway === 'onesignal' && !empty($config['onesignal_app_id']) && !empty($config['onesignal_rest_key']))
				{
					if (send_onesignal_sms($config['onesignal_app_id'], $config['onesignal_rest_key'], $decrypted_mobile, $sms_text))
					{
						$sms_sent = true;
					}
				}
			}
		}
	}

	return ($web_sent || $sms_sent);
}

/**
 * Trigger a mass push notification to multiple users (for news/announcements)
 *
 * @param string $event_type Event type (news, announce)
 * @param string $title      Notification title
 * @param string $message    Notification body message
 * @param string $url        URL to open when notification is clicked (optional)
 *
 * @return bool Returns true on success, false on failure
 */
function trigger_mass_push($event_type, $title, $message, $url = '')
{
	global $db, $config;

	$success = true;

	// WEB PUSH LOGIC
	$web_config_key = 'push_allow_web_' . $event_type;
	if (isset($config[$web_config_key]) && $config[$web_config_key])
	{
		if (!empty($config['onesignal_app_id']) && !empty($config['onesignal_rest_key']))
		{
			$sql = 'SELECT user_id 
					FROM ' . USERS_TABLE . ' 
					WHERE user_push_web_' . $db->sql_escape($event_type) . ' = 1';
			$result = $db->sql_query($sql);

			$user_ids = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$user_ids[] = (string) $row['user_id'];
			}
			$db->sql_freeresult($result);

			if (!empty($user_ids))
			{
				$chunks = array_chunk($user_ids, 2000);
				foreach ($chunks as $chunk)
				{
					$payload = array(
						'app_id' => $config['onesignal_app_id'],
						'include_external_user_ids' => $chunk,
						'headings' => array('en' => $title),
						'contents' => array('en' => $message),
					);

					if (!empty($url))
					{
						$payload['url'] = $url;
					}

					if (!onesignal_send_request($payload, $config['onesignal_rest_key']))
					{
						$success = false;
					}
				}
			}
		}
	}

	// SMS PUSH LOGIC
	$sms_config_key = 'push_allow_sms_' . $event_type;
	if (isset($config[$sms_config_key]) && $config[$sms_config_key])
	{
		$gateway = isset($config['sms_gateway']) ? $config['sms_gateway'] : 'onesignal';

		$sql = 'SELECT user_mobile 
				FROM ' . USERS_TABLE . ' 
				WHERE user_push_sms_' . $db->sql_escape($event_type) . ' = 1 
				  AND user_mobile <> \'\'';
		$result = $db->sql_query($sql);

		$mobile_numbers = array();
		while ($row = $db->sql_fetchrow($result))
		{
			// Decrypt mobile number
			$decrypted_mobile = im3_decrypt_mobile($row['user_mobile']);
			if ($decrypted_mobile) {
				$mobile_numbers[] = $decrypted_mobile;
			}
		}
		$db->sql_freeresult($result);

		if (!empty($mobile_numbers))
		{
			$sms_text = $title . ": " . $message;
			if (!empty($url)) {
				$sms_text .= " " . $url;
			}

			if ($gateway === 'twilio' && !empty($config['twilio_sid']) && !empty($config['twilio_token']) && !empty($config['twilio_from_number']))
			{
				foreach ($mobile_numbers as $m)
				{
					if (!send_twilio_sms($config['twilio_sid'], $config['twilio_token'], $config['twilio_from_number'], $m, $sms_text))
					{
						$success = false;
					}
				}
			}
			elseif ($gateway === 'onesignal' && !empty($config['onesignal_app_id']) && !empty($config['onesignal_rest_key']))
			{
				// Send as chunk or via individual depending on payload layout, for safety individually
				foreach ($mobile_numbers as $m)
				{
					if (!send_onesignal_sms($config['onesignal_app_id'], $config['onesignal_rest_key'], $m, $sms_text))
					{
						$success = false;
					}
				}
			}
		}
	}

	return $success;
}

/**
 * Send an SMS via Twilio using native cURL
 */
function send_twilio_sms($sid, $token, $from, $to, $message)
{
    $url = 'https://api.twilio.com/2010-04-01/Accounts/' . $sid . '/Messages.json';
    $data = array(
        'From' => $from,
        'To' => $to,
        'Body' => $message,
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_USERPWD, $sid . ':' . $token);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Legacy server support

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($http_code >= 200 && $http_code < 300);
}

/**
 * Send an SMS via OneSignal using native cURL
 */
function send_onesignal_sms($app_id, $rest_key, $to, $message)
{
    $payload = array(
        'app_id' => $app_id,
        'contents' => array('en' => $message),
        'name' => 'Internal SMS',
        'sms_from' => '', // Configured in OneSignal Dashboard
        'include_phone_numbers' => array($to),
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic ' . $rest_key
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Legacy server support

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($http_code >= 200 && $http_code < 300);
}

/**
 * Internal helper function to send cURL request to OneSignal API
 *
 * @param array  $payload  JSON payload to send
 * @param string $rest_key OneSignal REST API Key
 *
 * @return bool Returns true on successful API call, false on failure
 */
function onesignal_send_request($payload, $rest_key)
{
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json; charset=utf-8',
		'Authorization: Basic ' . $rest_key
	));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For legacy PHP 5.6 compatibility

	$response = curl_exec($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	// OneSignal returns 200 on success
	return ($http_code == 200);
}

