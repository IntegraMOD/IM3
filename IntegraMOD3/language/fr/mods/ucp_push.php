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
    'UCP_PUSH_NOTIFICATIONS'			=> 'Notifications Push',
    'UCP_PUSH_EXPLAIN'			=> 'Gérez vos préférences de notifications push. Seuls les types de notification activés par les administrateurs apparaîtront ci-dessous.',
    'USER_PUSH_BROWSER'			=> 'Notifications bureau / navigateur',
    'USER_PUSH_BROWSER_EXPLAIN'	=> 'Ce navigateur doit être abonné avant que les notifications web puissent apparaître sur votre bureau. Cliquez sur Activer, puis sur Autoriser lorsque le navigateur le demande.',
    'USER_PUSH_BROWSER_ENABLE'	=> 'Activer les notifications bureau',
    'USER_PUSH_BROWSER_ON'		=> 'Ce navigateur est abonné.',
    'USER_PUSH_BROWSER_OFF'		=> 'Ce navigateur n\'est pas abonné.',
    'USER_PUSH_BROWSER_LOADING'	=> 'Chargement des notifications bureau...',
    'USER_PUSH_BROWSER_BLOCKED'	=> 'Le service de notification (cdn.onesignal.com) a été bloqué par votre navigateur ou par une extension telle que DuckDuckGo Privacy Essentials, uBlock Origin, AdGuard, Brave Shields ou la protection stricte contre le pistage de Firefox. Autorisez-le pour ce site, puis',
    'USER_PUSH_BROWSER_RETRY'	=> 'réessayez',
    'USER_PUSH_BROWSER_DENIED'	=> 'Les notifications sont bloquées pour ce site dans les paramètres de votre navigateur.',
    'USER_PUSH_BROWSER_UNSUPPORTED'	=> 'Les notifications bureau ne sont pas prises en charge par ce navigateur.',
    'USER_PUSH_BROWSER_NOT_CONFIGURED'	=> 'Les notifications push ne sont pas configurées.',
    'USER_PUSH_BROWSER_ERROR'	=> 'Échec de l\'initialisation des notifications bureau : %s',
    'UCP_PUSH_SETTINGS'			=> 'Préférences de notifications',
    'UCP_PUSH_SETTINGS_SAVED'			=> 'Vos préférences de notifications push ont été enregistrées.',
    'USER_MOBILE'			=> 'Numéro de téléphone mobile',
    'USER_MOBILE_EXPLAIN'			=> 'Requis pour les notifications par SMS.<br> Par mesure de sécurité, ce numéro de téléphone est crypté et ne peut pas être lu par l\'administration.',
    'USER_MOBILE_CC'			=> 'Indicatif du pays',
    'USER_MOBILE_CC_EXPLAIN'			=> 'Saisissez l\'indicatif de votre pays dans la première case (ex. 33 pour la France) et votre numéro de téléphone dans la seconde. L\'indicatif du pays est obligatoire.',
    'MOBILE_CC_REQUIRED'			=> 'Vous devez saisir un indicatif de pays avec votre numéro de téléphone. L\'envoi de SMS nécessite l\'indicatif international (ex. 33 pour la France).',
    'EVENT'			=> 'Type d\'événement',
    'WEB_PUSH'			=> 'Web Push',
    'SMS_PUSH'			=> 'SMS Push',
    'USER_PUSH_FRIEND_REQ'			=> 'Demandes d\'ami',
    'USER_PUSH_FRIEND_ACC'			=> 'Demandes d\'ami acceptées',
    'USER_PUSH_PM'			=> 'Messages privés',
    'USER_PUSH_LIKE'			=> 'Mentions J\'aime',
    'USER_PUSH_ACTIVITY'			=> 'Notifications d\'activité',
    'USER_PUSH_SUB_POST'			=> 'Réponses aux publications abonnées',
    'USER_PUSH_SUB_TOPIC'			=> 'Mises à jour des sujets abonnés',
    'USER_PUSH_NEWS'			=> 'Diffusions de nouvelles',
    'USER_PUSH_ANNOUNCE'			=> 'Diffusions d\'annonces',
));

?>