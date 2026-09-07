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
    'UCP_PUSH_NOTIFICATIONS'			=> 'Push-Benachrichtigungen',
    'UCP_PUSH_EXPLAIN'			=> 'Verwalten Sie Ihre Push-Benachrichtigungseinstellungen. Es werden nur von Administratoren aktivierte Benachrichtigungstypen unten angezeigt.',
    'USER_PUSH_BROWSER'			=> 'Desktop-/Browser-Benachrichtigungen',
    'USER_PUSH_BROWSER_EXPLAIN'	=> 'Dieser Browser muss abonniert sein, bevor Web-Push auf Ihrem Desktop erscheinen kann. Klicken Sie auf Aktivieren und dann auf Zulassen, wenn der Browser fragt.',
    'USER_PUSH_BROWSER_ENABLE'	=> 'Desktop-Benachrichtigungen aktivieren',
    'USER_PUSH_BROWSER_ON'		=> 'Dieser Browser ist abonniert.',
    'USER_PUSH_BROWSER_OFF'		=> 'Dieser Browser ist nicht abonniert.',
    'USER_PUSH_BROWSER_LOADING'	=> 'Desktop-Benachrichtigungen werden geladen...',
    'USER_PUSH_BROWSER_BLOCKED'	=> 'Der Benachrichtigungsdienst (cdn.onesignal.com) wurde von Ihrem Browser oder einer Erweiterung wie DuckDuckGo Privacy Essentials, uBlock Origin, AdGuard, Brave Shields oder dem strengen Tracking-Schutz von Firefox blockiert. Erlauben Sie ihn für diese Seite und',
    'USER_PUSH_BROWSER_RETRY'	=> 'versuchen Sie es erneut',
    'USER_PUSH_BROWSER_DENIED'	=> 'Benachrichtigungen sind für diese Seite in Ihren Browsereinstellungen blockiert.',
    'USER_PUSH_BROWSER_UNSUPPORTED'	=> 'Desktop-Benachrichtigungen werden in diesem Browser nicht unterstützt.',
    'USER_PUSH_BROWSER_NOT_CONFIGURED'	=> 'Push-Benachrichtigungen sind nicht konfiguriert.',
    'USER_PUSH_BROWSER_ERROR'	=> 'Desktop-Benachrichtigungen konnten nicht initialisiert werden: %s',
    'UCP_PUSH_SETTINGS'			=> 'Benachrichtigungseinstellungen',
    'UCP_PUSH_SETTINGS_SAVED'			=> 'Ihre Push-Benachrichtigungseinstellungen wurden gespeichert.',
    'USER_MOBILE'			=> 'Mobiltelefonnummer',
    'USER_MOBILE_EXPLAIN'			=> 'Erforderlich für SMS-Benachrichtigungen.<br> Aus Sicherheitsgründen wird diese Telefonnummer verschlüsselt gespeichert und kann nicht von der Administration gelesen werden.',
    'USER_MOBILE_CC'			=> 'Ländervorwahl',
    'USER_MOBILE_CC_EXPLAIN'			=> 'Geben Sie im ersten Feld Ihre Ländervorwahl ein (z. B. 49 für Deutschland) und im zweiten Feld Ihre Telefonnummer. Die Ländervorwahl ist erforderlich.',
    'MOBILE_CC_REQUIRED'			=> 'Sie müssen zusammen mit Ihrer Telefonnummer eine Ländervorwahl eingeben. Für den SMS-Versand ist die internationale Ländervorwahl erforderlich (z. B. 49 für Deutschland).',
    'EVENT'			=> 'Ereignistyp',
    'WEB_PUSH'			=> 'Web Push',
    'SMS_PUSH'			=> 'SMS Push',
    'USER_PUSH_FRIEND_REQ'			=> 'Freundschaftsanfragen',
    'USER_PUSH_FRIEND_ACC'			=> 'Freundschaftsanfrage akzeptiert',
    'USER_PUSH_PM'			=> 'Private Nachrichten',
    'USER_PUSH_LIKE'			=> 'Beitrag Likes',
    'USER_PUSH_ACTIVITY'			=> 'Aktivitätsbenachrichtigungen',
    'USER_PUSH_SUB_POST'			=> 'Abonnierte Beitragsantworten',
    'USER_PUSH_SUB_TOPIC'			=> 'Abonnierte Themen-Updates',
    'USER_PUSH_NEWS'			=> 'News-Broadcasts',
    'USER_PUSH_ANNOUNCE'			=> 'Ankündigungs-Broadcasts',
));

?>