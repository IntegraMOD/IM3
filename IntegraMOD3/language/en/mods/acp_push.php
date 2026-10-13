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

    'ACP_PUSH_GLOBAL_TOGGLES'		=> 'Member Notifications',
    'ACP_PUSH_GLOBAL_TOGGLES_EXPLAIN'	=> 'These notifications are available to the member they concern.',
    'ACP_PUSH_STAFF'				=> 'Staff Notifications',
    'ACP_PUSH_STAFF_EXPLAIN'		=> 'These notifications are limited to founders and administrators. They are not offered to ordinary members. Each staff member must still enable them in the User Control Panel.',
    'ACP_PUSH_AUDIENCE_EXPLAIN'		=> 'Use these options to widen the staff notifications above. They do not make those notifications available to every member.',
    'PUSH_ALLOW_FRIEND_REQ'			=> 'Friend Request Notifications',
    'PUSH_ALLOW_FRIEND_ACC'			=> 'Friend Request Accepted Notifications',
    'PUSH_ALLOW_PM'					=> 'Private Message Notifications',
    'PUSH_ALLOW_LIKE'				=> 'Post Liked Notifications',
    'PUSH_ALLOW_ACTIVITY'			=> 'Activity Page Notifications',
    'PUSH_ALLOW_SUB_POST'			=> 'Subscribed Post Reply Notifications',
    'PUSH_ALLOW_SUB_TOPIC'			=> 'Subscribed Topic Post Notifications',
    'PUSH_ALLOW_NEWS'				=> 'News Post Notifications',
    'PUSH_ALLOW_ANNOUNCE'			=> 'Announcement Post Notifications',
    'PUSH_ALLOW_REGISTER'			=> 'New Registration Notifications',
    'PUSH_ALLOW_REGISTER_EXPLAIN'	=> 'Staff only. Sent when an account is created, before activation. Founders and administrators receive it. Moderators receive it only when included below.',
    'PUSH_ALLOW_NEW_POST'			=> 'New Post Notifications',
    'PUSH_ALLOW_NEW_POST_EXPLAIN'	=> 'Staff only by default. Founders, administrators, and moderators of that forum receive approved and unapproved posts. Selected groups receive approved posts only, and only in forums they can read.',
    'PUSH_ALLOW_MENTION'			=> 'Mention Notifications',
    'ACP_PUSH_AUDIENCE'				=> 'Notification Audience',
    'PUSH_REGISTER_MODS'			=> 'Include moderators',
    'PUSH_REGISTER_MODS_EXPLAIN'	=> 'Administrators and founders always receive new registration notifications. Enable this to include moderators.',
    'PUSH_NEW_POST_GROUPS'			=> 'Groups for new posts',
    'PUSH_NEW_POST_GROUPS_EXPLAIN'	=> 'Hold Ctrl to select groups that may receive approved new-post notifications. Staff always receive them, including unapproved posts. Groups only receive posts in forums they can read.',

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
