<?php
/**
* ucp_push [Language File]
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
    'UCP_PUSH_NOTIFICATIONS'			=> 'Push Notifications',
    'UCP_PUSH_EXPLAIN'			=> 'Manage your push notification preferences. Only notification types enabled by administrators will appear below.',
    'USER_PUSH_BROWSER'			=> 'Desktop / browser notifications',
    'USER_PUSH_BROWSER_EXPLAIN'	=> 'This browser must be subscribed before web push can appear on your desktop. Click Enable, then Allow when the browser asks. OneSignal will show a push token after that.',
    'USER_PUSH_BROWSER_ENABLE'	=> 'Enable desktop notifications',
    'USER_PUSH_BROWSER_ON'		=> 'This browser is subscribed.',
    'USER_PUSH_BROWSER_OFF'		=> 'This browser is not subscribed.',
    'UCP_PUSH_SETTINGS'			=> 'Notification Preferences',
    'UCP_PUSH_SETTINGS_SAVED'			=> 'Your push notification preferences have been saved.',
    'USER_MOBILE'			=> 'Mobile Phone Number',
    'USER_MOBILE_EXPLAIN'			=> 'Required for SMS notifications.<br> For security this phone number is encrypted and cannot be read by the administation.',
    'USER_MOBILE_CC'			=> 'Country Code',
    'USER_MOBILE_CC_EXPLAIN'			=> 'Enter your country code in the first box (e.g. 1 for USA/Canada, 44 for UK) and your phone number in the second box. The country code is required.',
    'MOBILE_CC_REQUIRED'			=> 'You must enter a country code with your phone number. SMS delivery requires the international country code (e.g. 1 for USA/Canada).',
    'EVENT'			=> 'Event Type',
    'WEB_PUSH'			=> 'Web Push',
    'SMS_PUSH'			=> 'SMS Push',
    'USER_PUSH_FRIEND_REQ'			=> 'Friend Requests',
    'USER_PUSH_FRIEND_ACC'			=> 'Friend Accepts',
    'USER_PUSH_PM'			=> 'Private Messages',
    'USER_PUSH_LIKE'			=> 'Likes',
    'USER_PUSH_ACTIVITY'			=> 'Activity Notifications',
    'USER_PUSH_SUB_POST'			=> 'Subscribed Post Replies',
    'USER_PUSH_SUB_TOPIC'			=> 'Subscribed Topic Updates',
    'USER_PUSH_NEWS'			=> 'News Broadcasts',
    'USER_PUSH_ANNOUNCE'			=> 'Announcement Broadcasts',
));

?>