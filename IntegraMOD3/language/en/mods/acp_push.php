<?php
/**
* acp_push [English Language File]
*
* @package IntegraMOD
* @version 1.0.0
* @author HelterSkelter
* @copyright (c) 2024 IntegraMOD Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
    'ACP_PUSH_NOTIFICATIONS'		=> 'Push Notifications',
    'ACP_PUSH_EXPLAIN'				=> 'Configure OneSignal push notification settings and send broadcast messages.',
    'ACP_PUSH_SETTINGS'				=> 'OneSignal Settings',
    'ACP_PUSH_SMS_SETTINGS'			=> 'SMS Gateway Settings',
    'SMS_GATEWAY'					=> 'SMS Gateway',
    'EVENT'							=> 'Event Type',
    'WEB_PUSH'						=> 'Web Push',
    'SMS_PUSH'						=> 'SMS Push',
    'ACP_PUSH_SETTINGS_SAVED'		=> 'Push notification settings have been saved successfully.',
    'ACP_PUSH_SEND'					=> 'Send Broadcast',
    'ACP_PUSH_SEND_BROADCAST'		=> 'Send Mass Notification',
    'ACP_PUSH_SEND_SUCCESS'			=> 'Push notification sent successfully.',
    'ACP_PUSH_SEND_ERROR'			=> 'Failed to send push notification',
    'ACP_PUSH_SEND_ERROR_EMPTY'		=> 'Title and message cannot be empty.',

    'ONESIGNAL_APP_ID'				=> 'OneSignal App ID',
    'ONESIGNAL_APP_ID_EXPLAIN'		=> 'Your OneSignal application ID.',
    'ONESIGNAL_REST_KEY'			=> 'OneSignal REST API Key',
    'ONESIGNAL_REST_KEY_EXPLAIN'	=> 'Your OneSignal REST API Key for server-side authentication.',

    'ACP_PUSH_GLOBAL_TOGGLES'		=> 'Push Notifications',
    'PUSH_ALLOW_FRIEND_REQ'			=> 'Friend Request Notifications',
    'PUSH_ALLOW_FRIEND_ACC'			=> 'Friend Request Accepted Notifications',
    'PUSH_ALLOW_PM'					=> 'Private Message Notifications',
    'PUSH_ALLOW_LIKE'				=> 'Post Liked Notifications',
    'PUSH_ALLOW_ACTIVITY'			=> 'Activity Page Notifications',
    'PUSH_ALLOW_SUB_POST'			=> 'Subscribed Post Reply Notifications',
    'PUSH_ALLOW_SUB_TOPIC'			=> 'Subscribed Topic Post Notifications',
    'PUSH_ALLOW_NEWS'				=> 'News Post Notifications',
    'PUSH_ALLOW_ANNOUNCE'			=> 'Announcement Post Notifications',

    'PUSH_EVENT_TYPE'				=> 'Event Type',
    'PUSH_EVENT_TYPE_EXPLAIN'		=> 'Select the type of event for this broadcast.',
    'PUSH_EVENT_NEWS'				=> 'News',
    'PUSH_EVENT_ANNOUNCE'			=> 'Announcement',

    'NOTIFICATION_TITLE'			=> 'Notification Title',
    'NOTIFICATION_MESSAGE'			=> 'Notification Message',
    'NOTIFICATION_URL'				=> 'Notification URL',
    'NOTIFICATION_URL_EXPLAIN'		=> 'Optional: URL to open when notification is clicked.',
));

?>
