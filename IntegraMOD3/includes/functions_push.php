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
 * Provision push columns and config once. Safe to call on every request.
 *
 * @return void
 */
function im3_push_install()
{
    global $db, $config, $cache, $phpbb_root_path, $phpEx;

    if (!empty($config['im3_push_schema']))
    {
        return;
    }

    if (!class_exists('phpbb_db_tools'))
    {
        include($phpbb_root_path . 'includes/db/db_tools.' . $phpEx);
    }

    $db_tools = new phpbb_db_tools($db);
    $events = array('register', 'new_post', 'mention');
    $columns = array();

    foreach ($events as $event)
    {
        $columns['user_push_web_' . $event] = array('BOOL', 0);
        $columns['user_push_sms_' . $event] = array('BOOL', 0);
    }

    $db_tools->perform_schema_changes(array(
        'add_columns' => array(
            USERS_TABLE => $columns,
        ),
    ));

    foreach ($events as $event)
    {
        if (!isset($config['push_allow_web_' . $event]))
        {
            set_config('push_allow_web_' . $event, 0);
        }
        if (!isset($config['push_allow_sms_' . $event]))
        {
            set_config('push_allow_sms_' . $event, 0);
        }
    }

    if (!isset($config['push_register_mods']))
    {
        set_config('push_register_mods', 0);
    }
    if (!isset($config['push_new_post_groups']))
    {
        set_config('push_new_post_groups', '');
    }

    set_config('im3_push_schema', 1);
    $cache->destroy('config');
    $config['im3_push_schema'] = 1;
}

/**
 * User ids with a named permission, including role-based assignments.
 *
 * @param string $permission ACL option name
 * @param bool   $global_only Ignore forum-local assignments
 * @return array
 */
function im3_users_with_permission($permission, $global_only = true)
{
    global $db;

    $option_id = 0;
    $sql = 'SELECT auth_option_id
        FROM ' . ACL_OPTIONS_TABLE . "
        WHERE auth_option = '" . $db->sql_escape($permission) . "'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    if (!empty($row['auth_option_id']))
    {
        $option_id = (int) $row['auth_option_id'];
    }

    if (!$option_id)
    {
        return array();
    }

    $forum_sql = $global_only ? ' AND a.forum_id = 0' : '';
    $user_ids = array();

    if ($permission === 'a_')
    {
        $sql = 'SELECT user_id
            FROM ' . USERS_TABLE . '
            WHERE user_type = ' . USER_FOUNDER;
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result))
        {
            $user_ids[(int) $row['user_id']] = (int) $row['user_id'];
        }
        $db->sql_freeresult($result);
    }

    $sql = 'SELECT a.user_id
        FROM ' . ACL_USERS_TABLE . ' a
        WHERE a.auth_option_id = ' . $option_id . '
            AND a.auth_setting = 1
            AND a.user_id <> ' . ANONYMOUS . $forum_sql;
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result))
    {
        $user_ids[(int) $row['user_id']] = (int) $row['user_id'];
    }
    $db->sql_freeresult($result);

    $sql = 'SELECT DISTINCT ug.user_id
        FROM ' . ACL_GROUPS_TABLE . ' a, ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
        WHERE a.auth_option_id = ' . $option_id . '
            AND a.auth_setting = 1
            AND ug.group_id = a.group_id
            AND ug.user_pending = 0
            AND g.group_id = ug.group_id
            AND g.group_type <> ' . GROUP_HIDDEN . $forum_sql;
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result))
    {
        $user_ids[(int) $row['user_id']] = (int) $row['user_id'];
    }
    $db->sql_freeresult($result);

    $sql = 'SELECT DISTINCT ug.user_id
        FROM ' . ACL_GROUPS_TABLE . ' a, ' . ACL_ROLES_DATA_TABLE . ' r, ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
        WHERE a.auth_role_id = r.role_id
            AND r.auth_option_id = ' . $option_id . '
            AND a.auth_setting = 1
            AND ug.group_id = a.group_id
            AND ug.user_pending = 0
            AND g.group_id = ug.group_id
            AND g.group_type <> ' . GROUP_HIDDEN . $forum_sql;
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result))
    {
        $user_ids[(int) $row['user_id']] = (int) $row['user_id'];
    }
    $db->sql_freeresult($result);

    $sql = 'SELECT a.user_id
        FROM ' . ACL_USERS_TABLE . ' a, ' . ACL_ROLES_DATA_TABLE . ' r
        WHERE a.auth_role_id = r.role_id
            AND r.auth_option_id = ' . $option_id . '
            AND a.auth_setting = 1
            AND a.user_id <> ' . ANONYMOUS . $forum_sql;
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result))
    {
        $user_ids[(int) $row['user_id']] = (int) $row['user_id'];
    }
    $db->sql_freeresult($result);

    return $user_ids;
}

/**
 * Whether this user is staff for staff-only registration alerts.
 *
 * @param int $user_id
 * @return bool
 */
function im3_user_can_receive_staff_push($user_id)
{
    global $auth, $config;

    $user_id = (int) $user_id;
    if ($user_id <= ANONYMOUS)
    {
        return false;
    }

    $admins = im3_users_with_permission('a_', true);
    if (isset($admins[$user_id]))
    {
        return true;
    }

    if (!empty($config['push_register_mods']))
    {
        $mods = im3_users_with_permission('m_', false);
        if (isset($mods[$user_id]))
        {
            return true;
        }
    }

    return false;
}

/**
 * Whether the user belongs to a group selected for new-post alerts.
 *
 * @param int $user_id
 * @return bool
 */
function im3_user_in_push_groups($user_id)
{
    global $db, $config;

    $user_id = (int) $user_id;
    if ($user_id <= ANONYMOUS || empty($config['push_new_post_groups']))
    {
        return false;
    }

    $group_ids = array_filter(array_map('intval', explode(',', $config['push_new_post_groups'])));
    if (!sizeof($group_ids))
    {
        return false;
    }

    $sql = 'SELECT user_id
        FROM ' . USER_GROUP_TABLE . '
        WHERE user_id = ' . $user_id . '
            AND user_pending = 0
            AND ' . $db->sql_in_set('group_id', $group_ids);
    $result = $db->sql_query_limit($sql, 1);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return !empty($row);
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
 * Load a language string for a recipient without changing the current user language.
 *
 * @param string $lang_name
 * @param string $key
 * @param array  $args
 * @return string
 */
function im3_push_lang($lang_name, $key, $args = array())
{
	global $phpbb_root_path, $phpEx;

	$lang_name = preg_replace('/[^a-z0-9_-]/i', '', $lang_name);
	if ($lang_name === '')
	{
		$lang_name = 'en';
	}

	$file = $phpbb_root_path . 'language/' . $lang_name . '/mods/ucp_push.' . $phpEx;
	if (!file_exists($file))
	{
		$file = $phpbb_root_path . 'language/en/mods/ucp_push.' . $phpEx;
	}

	$lang = array();
	include($file);

	if (!isset($lang[$key]))
	{
		return $key;
	}

	if (sizeof($args))
	{
		return vsprintf($lang[$key], $args);
	}

	return $lang[$key];
}

/**
 * Send one event to many users, grouping identical web payloads and SMS by language.
 *
 * @param array  $user_ids
 * @param string $event_type
 * @param string $lang_key
 * @param array  $lang_args
 * @param string $url
 * @param array  $exclude_ids
 * @return bool
 */
function im3_push_users($user_ids, $event_type, $lang_key, $lang_args, $url = '', $exclude_ids = array())
{
	global $db, $config;

	$event_type = preg_replace('/[^a-z0-9_]/i', '', $event_type);
	if ($event_type === '' || !sizeof($user_ids))
	{
		return false;
	}

	$clean_ids = array();
	foreach ($user_ids as $user_id)
	{
		$user_id = (int) $user_id;
		if ($user_id > ANONYMOUS && !isset($exclude_ids[$user_id]))
		{
			$clean_ids[$user_id] = $user_id;
		}
	}

	if (!sizeof($clean_ids))
	{
		return false;
	}

	$web_on = !empty($config['push_allow_web_' . $event_type]) && !empty($config['onesignal_app_id']) && !empty($config['onesignal_rest_key']);
	$sms_on = !empty($config['push_allow_sms_' . $event_type]);
	if (!$web_on && !$sms_on)
	{
		return false;
	}

	$sql = 'SELECT user_id, user_lang, user_mobile, user_push_web_' . $event_type . ' AS push_web, user_push_sms_' . $event_type . ' AS push_sms
		FROM ' . USERS_TABLE . '
		WHERE ' . $db->sql_in_set('user_id', $clean_ids) . '
			AND user_type IN (' . USER_NORMAL . ', ' . USER_FOUNDER . ')';
	$result = $db->sql_query($sql);

	$web_groups = array();
	$sms_rows = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$lang_name = !empty($row['user_lang']) ? $row['user_lang'] : 'en';
		if ($web_on && !empty($row['push_web']))
		{
			if (!isset($web_groups[$lang_name]))
			{
				$web_groups[$lang_name] = array();
			}
			$web_groups[$lang_name][] = (string) $row['user_id'];
		}
		if ($sms_on && !empty($row['push_sms']) && !empty($row['user_mobile']))
		{
			$sms_rows[] = $row;
		}
	}
	$db->sql_freeresult($result);

	$sent = false;

	foreach ($web_groups as $lang_name => $ids)
	{
		$title = im3_push_lang($lang_name, $lang_key . '_TITLE', $lang_args);
		$message = im3_push_lang($lang_name, $lang_key . '_MESSAGE', $lang_args);
		$chunks = array_chunk($ids, 2000);

		foreach ($chunks as $chunk)
		{
			$payload = array(
				'app_id' => $config['onesignal_app_id'],
				'include_external_user_ids' => $chunk,
				'headings' => array('en' => $title),
				'contents' => array('en' => $message),
			);
			if ($url !== '')
			{
				$payload['url'] = $url;
			}
			if (onesignal_send_request($payload, $config['onesignal_rest_key']))
			{
				$sent = true;
			}
		}
	}

	if (sizeof($sms_rows))
	{
		$gateway = isset($config['sms_gateway']) ? $config['sms_gateway'] : 'onesignal';
		foreach ($sms_rows as $row)
		{
			$mobile = im3_decrypt_mobile($row['user_mobile']);
			if (!$mobile)
			{
				continue;
			}

			$title = im3_push_lang($row['user_lang'], $lang_key . '_TITLE', $lang_args);
			$message = im3_push_lang($row['user_lang'], $lang_key . '_MESSAGE', $lang_args);
			$sms_text = $title . ': ' . $message;
			if ($url !== '')
			{
				$sms_text .= ' ' . $url;
			}

			if ($gateway === 'twilio' && !empty($config['twilio_sid']) && !empty($config['twilio_token']) && !empty($config['twilio_from_number']))
			{
				if (send_twilio_sms($config['twilio_sid'], $config['twilio_token'], $config['twilio_from_number'], $mobile, $sms_text))
				{
					$sent = true;
				}
			}
			else if ($gateway === 'onesignal' && !empty($config['onesignal_app_id']) && !empty($config['onesignal_rest_key']))
			{
				if (send_onesignal_sms($config['onesignal_app_id'], $config['onesignal_rest_key'], $mobile, $sms_text))
				{
					$sent = true;
				}
			}
		}
	}

	return $sent;
}

/**
 * Notify founders and administrators, optionally moderators, of a new account.
 *
 * @param int    $user_id
 * @param string $username
 * @return bool
 */
function trigger_registration_push($user_id, $username)
{
	global $config, $phpbb_root_path, $phpEx;

	if (empty($config['push_allow_web_register']) && empty($config['push_allow_sms_register']))
	{
		return false;
	}

	$recipients = im3_users_with_permission('a_', true);
	if (!empty($config['push_register_mods']))
	{
		$recipients = $recipients + im3_users_with_permission('m_', false);
	}

	$url = generate_board_url() . '/' . append_sid("memberlist.$phpEx", 'mode=viewprofile&u=' . (int) $user_id, true, '');
	return im3_push_users($recipients, 'register', 'PUSH_REGISTER', array($username), $url, array((int) $user_id => (int) $user_id));
}

/**
 * Notify staff, scoped moderators, and selected groups about a new post.
 *
 * @param int    $forum_id
 * @param int    $topic_id
 * @param int    $post_id
 * @param string $subject
 * @param string $author_name
 * @param int    $poster_id
 * @param bool   $approved
 * @param bool   $groups_only Send only to configured groups
 * @param array  $exclude_ids Recipients already notified for this post
 * @return bool
 */
function trigger_new_post_push($forum_id, $topic_id, $post_id, $subject, $author_name, $poster_id, $approved = true, $groups_only = false, $exclude_ids = array())
{
	global $db, $auth, $config, $phpEx;

	if (empty($config['push_allow_web_new_post']) && empty($config['push_allow_sms_new_post']))
	{
		return false;
	}

	$forum_id = (int) $forum_id;
	$poster_id = (int) $poster_id;
	$recipients = array();

	if (!$groups_only)
	{
		$recipients = im3_users_with_permission('a_', true);
		$mods = im3_users_with_permission('m_', false);
		$mod_ids = array_keys($mods);

		if (sizeof($mod_ids))
		{
			$moderated = array();
			foreach ($auth->acl_get_list($mod_ids, 'm_', $forum_id) as $auth_forum_id => $forum_ary)
			{
				foreach ($forum_ary as $auth_option => $user_ary)
				{
					foreach ($user_ary as $user_id)
					{
						$moderated[(int) $user_id] = (int) $user_id;
					}
				}
			}
			$recipients = $recipients + $moderated;
		}
	}

	if ($approved && !empty($config['push_new_post_groups']))
	{
		$group_ids = array_filter(array_map('intval', explode(',', $config['push_new_post_groups'])));
		if (sizeof($group_ids))
		{
			$sql = 'SELECT ug.user_id
				FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
				WHERE ' . $db->sql_in_set('ug.group_id', $group_ids) . '
					AND ug.user_pending = 0
					AND g.group_id = ug.group_id
					AND g.group_type <> ' . GROUP_HIDDEN;
			$result = $db->sql_query($sql);
			$group_users = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$group_users[(int) $row['user_id']] = (int) $row['user_id'];
			}
			$db->sql_freeresult($result);

			if (sizeof($group_users))
			{
				$allowed = array();
				foreach ($auth->acl_get_list(array_keys($group_users), 'f_read', $forum_id) as $auth_forum_id => $forum_ary)
				{
					foreach ($forum_ary as $auth_option => $user_ary)
					{
						foreach ($user_ary as $user_id)
						{
							$allowed[(int) $user_id] = (int) $user_id;
						}
					}
				}
				$recipients = $recipients + $allowed;
			}
		}
	}

	$exclude_ids[(int) $poster_id] = (int) $poster_id;
	$url = generate_board_url() . "/viewtopic.$phpEx?f=$forum_id&t=" . (int) $topic_id . '&p=' . (int) $post_id . '#p' . (int) $post_id;
	return im3_push_users($recipients, 'new_post', 'PUSH_NEW_POST', array($author_name, $subject), $url, $exclude_ids);
}

/**
 * Public hook for a future mentions modification.
 * Call this after the mention has been validated; this function does not parse post text.
 *
 * @param int    $mentioned_user_id
 * @param string $author_name
 * @param string $subject
 * @param string $url
 * @param int    $author_id
 * @return bool
 */
/**
 * Recipients that will already receive a subscription push for this post.
 *
 * @param int    $forum_id
 * @param int    $topic_id
 * @param string $mode
 * @return array
 */
function im3_push_subscription_recipients($forum_id, $topic_id, $mode)
{
	global $db, $user, $phpbb_root_path, $phpEx;

	$forum_id = (int) $forum_id;
	$topic_id = (int) $topic_id;
	$topic_notification = ($mode == 'reply' || $mode == 'quote');
	$recipients = array();

	if (!function_exists('phpbb_get_banned_user_ids'))
	{
		include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
	}

	$ignore = phpbb_get_banned_user_ids();
	$ignore[ANONYMOUS] = ANONYMOUS;
	$ignore[(int) $user->data['user_id']] = (int) $user->data['user_id'];

	$sql = 'SELECT w.user_id
		FROM ' . ($topic_notification ? TOPICS_WATCH_TABLE : FORUMS_WATCH_TABLE) . ' w
		WHERE w.' . ($topic_notification ? 'topic_id' : 'forum_id') . ' = ' . ($topic_notification ? $topic_id : $forum_id) . '
			AND w.notify_status = ' . NOTIFY_YES . '
			AND ' . $db->sql_in_set('w.user_id', $ignore, true);
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result))
	{
		$recipients[(int) $row['user_id']] = (int) $row['user_id'];
	}
	$db->sql_freeresult($result);

	if ($topic_notification)
	{
		$ignore = $ignore + $recipients;
		$sql = 'SELECT fw.user_id
			FROM ' . FORUMS_WATCH_TABLE . " fw
			WHERE fw.forum_id = $forum_id
				AND fw.notify_status = " . NOTIFY_YES . '
				AND ' . $db->sql_in_set('fw.user_id', $ignore, true);
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$recipients[(int) $row['user_id']] = (int) $row['user_id'];
		}
		$db->sql_freeresult($result);
	}

	return $recipients;
}

/**
 * Public hook for a future mentions modification.
 * Call this after the mention has been validated; this function does not parse post text.
 *
 * @param int    $mentioned_user_id
 * @param string $author_name
 * @param string $subject
 * @param string $url
 * @param int    $author_id
 * @return bool
 */
function trigger_mention_push($mentioned_user_id, $author_name, $subject, $url = '', $author_id = 0)
{
	global $config;

	if (empty($config['push_allow_web_mention']) && empty($config['push_allow_sms_mention']))
	{
		return false;
	}

	$mentioned_user_id = (int) $mentioned_user_id;
	$author_id = (int) $author_id;
	if ($mentioned_user_id <= ANONYMOUS || $mentioned_user_id === $author_id)
	{
		return false;
	}

	return im3_push_users(array($mentioned_user_id), 'mention', 'PUSH_MENTION', array($author_name, $subject), $url, array($author_id => $author_id));
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

