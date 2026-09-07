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
    'UCP_PUSH_NOTIFICATIONS'			=> 'Pushmeldingen',
    'UCP_PUSH_EXPLAIN'			=> 'Beheer uw pushmelding voorkeuren. Alleen meldingstypes geactiveerd door beheerders verschijnen hieronder.',
    'USER_PUSH_BROWSER'			=> 'Bureaublad-/browsermeldingen',
    'USER_PUSH_BROWSER_EXPLAIN'	=> 'Deze browser moet geabonneerd zijn voordat webpush op uw bureaublad kan verschijnen. Klik op Inschakelen en daarna op Toestaan wanneer de browser dit vraagt.',
    'USER_PUSH_BROWSER_ENABLE'	=> 'Bureaubladmeldingen inschakelen',
    'USER_PUSH_BROWSER_ON'		=> 'Deze browser is geabonneerd.',
    'USER_PUSH_BROWSER_OFF'		=> 'Deze browser is niet geabonneerd.',
    'USER_PUSH_BROWSER_LOADING'	=> 'Bureaubladmeldingen worden geladen...',
    'USER_PUSH_BROWSER_BLOCKED'	=> 'De meldingsdienst (cdn.onesignal.com) is geblokkeerd door uw browser of een extensie zoals DuckDuckGo Privacy Essentials, uBlock Origin, AdGuard, Brave Shields of de strikte trackingbescherming van Firefox. Sta deze toe voor deze site en',
    'USER_PUSH_BROWSER_RETRY'	=> 'probeer opnieuw',
    'USER_PUSH_BROWSER_DENIED'	=> 'Meldingen zijn voor deze site geblokkeerd in uw browserinstellingen.',
    'USER_PUSH_BROWSER_UNSUPPORTED'	=> 'Bureaubladmeldingen worden niet ondersteund in deze browser.',
    'USER_PUSH_BROWSER_NOT_CONFIGURED'	=> 'Pushmeldingen zijn niet geconfigureerd.',
    'USER_PUSH_BROWSER_ERROR'	=> 'Bureaubladmeldingen konden niet worden geïnitialiseerd: %s',
    'UCP_PUSH_SETTINGS'			=> 'Melding Voorkeuren',
    'UCP_PUSH_SETTINGS_SAVED'			=> 'Uw pushmelding voorkeuren zijn opgeslagen.',
    'USER_MOBILE'			=> 'Mobiel Telefoonnummer',
    'USER_MOBILE_EXPLAIN'			=> 'Vereist voor SMS-meldingen.<br> Voor de veiligheid is dit telefoonnummer versleuteld en kan het niet worden gelezen door de administratie.',
    'USER_MOBILE_CC'			=> 'Landcode',
    'USER_MOBILE_CC_EXPLAIN'			=> 'Voer in het eerste vak uw landcode in (bijv. 31 voor Nederland) en in het tweede vak uw telefoonnummer. De landcode is verplicht.',
    'MOBILE_CC_REQUIRED'			=> 'U moet een landcode bij uw telefoonnummer invoeren. Voor SMS-bezorging is de internationale landcode vereist (bijv. 31 voor Nederland).',
    'EVENT'			=> 'Gebeurtenis type',
    'WEB_PUSH'			=> 'Web Push',
    'SMS_PUSH'			=> 'SMS Push',
    'USER_PUSH_FRIEND_REQ'			=> 'Vriendschapsverzoeken',
    'USER_PUSH_FRIEND_ACC'			=> 'Vriendschap verzoeken geaccepteerd',
    'USER_PUSH_PM'			=> 'Privéberichten',
    'USER_PUSH_LIKE'			=> 'Leuk gevonden',
    'USER_PUSH_ACTIVITY'			=> 'Activiteit meldingen',
    'USER_PUSH_SUB_POST'			=> 'Geabonneerde bericht reacties',
    'USER_PUSH_SUB_TOPIC'			=> 'Geabonneerde onderwerp updates',
    'USER_PUSH_NEWS'			=> 'Nieuws Uitzendingen',
    'USER_PUSH_ANNOUNCE'			=> 'Aankondiging Uitzendingen',
));

?>