<?php
/**
*
* info_acp_donation.php [German]
*
* @package Paypal Donation MOD
* @copyright (c) 2013 Skouat
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ' « » " " …
//


/**
* mode: main
*/
$lang = array_merge($lang, array(
    'ACP_DONATION_MOD' => 'Paypal Donation',
));

/**
* mode: overview
*/
$lang = array_merge($lang, array(
    'DONATION_OVERVIEW'			=> 'Übersicht',
    'DONATION_WELCOME'			=> 'Willkommen bei Paypal Donation MOD',
    'DONATION_WELCOME_EXPLAIN'	=> '',

    'DONATION_STATS'			=> 'Spendenstatistiken',
    'DONATION_INSTALL_DATE'		=> 'Installationsdatum von <strong>Paypal Donation MOD</strong>',
    'DONATION_VERSION'			=> '<strong>Paypal Donation</strong> Version',

    'INFO_FSOCKOPEN'			=> 'Fsockopen',
    'INFO_CURL'					=> 'cURL',
    'INFO_DETECTED'				=> 'Erkannt',
    'INFO_NOT_DETECTED'			=> 'Nicht erkannt',
    'DONATION_VERSION_NOT_UP_TO_DATE_TITLE'	=> 'Deine Paypal Donation Installation ist nicht aktuell.',

    'STAT_RESET_DATE'					=> 'MOD Installationsdatum Zurücksetzen',
    'STAT_RESET_DATE_EXPLAIN'			=> 'Zurücksetzen der Installation beeinflusst Statistiken über die Gesamtbetragsberechnung',
    'STAT_RESET_DATE_CONFIRM'			=> 'Bist du sicher, dass du das Installationsdatum der MOD zurücksetzen möchtest?',
));

/**
* mode: configuration
*/
$lang = array_merge($lang, array(
    'DONATION_CONFIG'			=> 'Konfiguration',
    'DONATION_CONFIG_EXPLAIN'	=> '',
    'DONATION_SAVED'			=> 'Spendeneinstellungen gespeichert',
    'MODE_CURRENCY'				=> 'Währung',
    'MODE_DONATION_PAGES'		=> 'Spendenseiten',

    // Global Donation settings
    'DONATION_ENABLE'						=> 'Paypal Donation Aktivieren',
    'DONATION_ENABLE_EXPLAIN'				=> 'Paypal Donation MOD aktivieren oder deaktivieren',
    'DONATION_ACCOUNT_ID'					=> 'Paypal Konto ID',
    'DONATION_ACCOUNT_ID_EXPLAIN'			=> 'Gib deine Paypal E-Mail-Adresse oder Händler-Konto-ID ein',
    'DONATION_DEFAULT_CURRENCY'				=> 'Standardwährung',
    'DONATION_DEFAULT_CURRENCY_EXPLAIN'		=> 'Lege fest, welche Währung standardmäßig ausgewählt wird',
    'DONATION_DEFAULT_VALUE'				=> 'Standard Spendenwert',
    'DONATION_DEFAULT_VALUE_EXPLAIN'		=> 'Lege fest, welcher Spendenwert standardmäßig vorgeschlagen wird',
    'DONATION_DROPBOX_ENABLE'				=> 'Dropdown-Liste Aktivieren',
    'DONATION_DROPBOX_ENABLE_EXPLAIN'		=> 'Wenn aktiviert, wird die Textbox durch eine Dropdown-Liste ersetzt.',
    'DONATION_DROPBOX_VALUE'				=> 'Dropdown-Wert',
    'DONATION_DROPBOX_VALUE_EXPLAIN'		=> 'Lege die Zahlen fest, die du in der Dropdown-Liste sehen möchtest.<br />Verwende <strong>Komma</strong> (",") <strong>ohne Leerzeichen</strong> um jeden Wert zu trennen.',

    // Paypal sandbox settings
    'SANDBOX_SETTINGS'						=> 'Paypal Sandbox Einstellungen',
    'SANDBOX_ENABLE'						=> 'Sandbox Testing',
    'SANDBOX_ENABLE_EXPLAIN'				=> 'Aktiviere diese Option, wenn du Paypal Sandbox anstelle von Paypal Services verwenden möchtest.<br />Nützlich für Entwickler/Tester. Alle Transaktionen sind fiktiv.',
    'SANDBOX_FOUNDER_ENABLE'				=> 'Sandbox nur für Gründer',
    'SANDBOX_FOUNDER_ENABLE_EXPLAIN'		=> 'Wenn aktiviert, wird Paypal Sandbox nur den Board-Gründern angezeigt.',
    'SANDBOX_ADDRESS'						=> 'PayPal Sandbox Adresse',
    'SANDBOX_ADDRESS_EXPLAIN'				=> 'Lege hier deine Paypal Sandbox Verkäufer E-Mail-Adresse fest',

    // Stats Donation settings
    'DONATION_STATS_SETTINGS'				=> 'Spendenstatistik Konfiguration',
    'DONATION_STATS_INDEX_ENABLE'			=> 'Spendenstatistik auf Index Anzeigen',
    'DONATION_STATS_INDEX_ENABLE_EXPLAIN'	=> 'Aktiviere dies, wenn du die Spendenstatistik auf dem Index anzeigen möchtest',
    'DONATION_RAISED_ENABLE'				=> 'Gesammelte Spenden Aktivieren',
    'DONATION_RAISED'						=> 'Gesammelte Spenden',
    'DONATION_RAISED_EXPLAIN'				=> 'Der aktuelle Betrag, der durch Spenden gesammelt wurde',
    'DONATION_GOAL_ENABLE'					=> 'Spendenziel Aktivieren',
    'DONATION_GOAL'							=> 'Spendenziel',
    'DONATION_GOAL_EXPLAIN'					=> 'Der Gesamtbetrag, den du sammeln möchtest',
    'DONATION_USED_ENABLE'					=> 'Verwendete Spenden Aktivieren',
    'DONATION_USED'							=> 'Verwendete Spenden',
    'DONATION_USED_EXPLAIN'					=> 'Der Betrag der Spenden, den du bereits verwendet hast',

    'DONATION_CURRENCY_ENABLE'				=> 'Spendenwährung Aktivieren',
    'DONATION_CURRENCY_ENABLE_EXPLAIN'		=> 'Aktiviere diese Option, wenn du den ISO 4217 Code der Standardwährung in den Statistiken anzeigen möchtest.',
));

/**
* mode: donation pages
* Info: language keys are prefixed with 'DONATION_DP_' for 'DONATION_DONATION_PAGES_'
*/
$lang = array_merge($lang, array(
    // Donation Page settings
    'DONATION_DP_CONFIG'		=> 'Spendenseiten',
    'DONATION_DP_CONFIG_EXPLAIN'=> 'Erlaubt die Verbesserung der Darstellung anpassbarer Seiten der MOD.',

    'DONATION_DP_PAGE'			=> 'Seitentyp',
    'DONATION_DP_LANG'			=> 'Sprache',

    // Donation Page Body settings
    'DONATION_BODY_SETTINGS'	=> 'Spenden-Hauptseite Konfiguration',
    'DONATION_BODY'				=> 'Spenden-Hauptseite',
    'DONATION_BODY_EXPLAIN'		=> 'Gib den Text ein, den du auf der Hauptspendenseite angezeigt haben möchtest.',

    // Donation Success settings
    'DONATION_SUCCESS_SETTINGS'	=> 'Spendenerfolg Konfiguration',
    'DONATION_SUCCESS'			=> 'Spendenerfolg',
    'DONATION_SUCCESS_EXPLAIN'	=> 'Gib den Text ein, den du auf der Erfolgsseite angezeigt haben möchtest.',

    // Donation Cancel settings
    'DONATION_CANCEL_SETTINGS'	=> 'Spendenabbruch Konfiguration',
    'DONATION_CANCEL'			=> 'Spendenabbruch',
    'DONATION_CANCEL_EXPLAIN'	=> 'Gib den Text ein, den du auf der Abbruchseite angezeigt haben möchtest.',

    // Donation Page Template vars
    'DONATION_DP_PREDEFINED_VARS'=> 'Vordefinierte Variablen',
    'DONATION_DP_VAR_EXAMPLE'	=> 'Beispiel',
    'DONATION_DP_VAR_NAME'		=> 'Name',
    'DONATION_DP_VAR_VAR'		=> 'Variable',

    'DONATION_DP_BOARD_CONTACT'	=> 'Board Kontakt',
    'DONATION_DP_BOARD_EMAIL'	=> 'Board E-Mail',
    'DONATION_DP_BOARD_SIG'		=> 'Board Signatur',
    'DONATION_DP_SITE_DESC'		=> 'Seitenbeschreibung',
    'DONATION_DP_SITE_NAME'		=> 'Seitenname',
    'DONATION_DP_USER_ID'		=> 'Benutzer ID',
    'DONATION_DP_USERNAME'		=> 'Benutzername',
));

/**
* mode: currency
* Info: language keys are prefixed with 'DONATION_DC_' for 'DONATION_DONATION_CURRENCY_'
*/
$lang = array_merge($lang, array(
    // Currency Management
    'DONATION_DC_CONFIG'			=> 'Währungsverwaltung',
    'DONATION_DC_CONFIG_EXPLAIN'	=> 'Hier kannst du Währungen verwalten',
    'DONATION_DC_NAME'				=> 'Währungsname',
    'DONATION_DC_NAME_EXPLAIN'		=> 'Name der Währung.<br />(z.B. Euro)',
    'DONATION_DC_ISO_CODE'			=> 'ISO 4217 Code',
    'DONATION_DC_ISO_CODE_EXPLAIN'	=> 'Alphabetischer Code der Währung.<br />Mehr über ISO 4217… siehe <a href="http://www.phpbb.com/customise/db/mod/paypal_donation_mod/faq/f_746" title="Paypal Donation MOD FAQ">Paypal Donation MOD FAQ</a> (externer Link)',
    'DONATION_DC_SYMBOL'			=> 'Währungssymbol',
    'DONATION_DC_SYMBOL_EXPLAIN'	=> 'Lege das Währungssymbol fest.<br />(z.B. € für Euro, $ für U.S. Dollar)',
    'DONATION_DC_ENABLED'			=> 'Währung Aktivieren',
    'DONATION_DC_ENABLED_EXPLAIN'	=> 'Wenn aktiviert, wird die Währung in der Dropdown-Liste angezeigt',
    'DONATION_DC_CREATE_CURRENCY'	=> 'Neue Währung Hinzufügen',
));

/**
* logs
*/
$lang = array_merge($lang, array(
    //logs
    'LOG_DONATION_UPDATED'		=> '<strong>Paypal Donation: Einstellungen aktualisiert.</strong>',
    'LOG_DONATION_PAGES_UPDATED'=> '<strong>Paypal Donation: Spendenseiten aktualisiert.</strong>',
    'LOG_ITEM_ADDED'			=> '<strong>Paypal Donation: %1$s hinzugefügt</strong><br />» %2$s',
    'LOG_ITEM_UPDATED'			=> '<strong>Paypal Donation: %1$s aktualisiert</strong><br />» %2$s',
    'LOG_ITEM_REMOVED'			=> '<strong>Paypal Donation: %1$s gelöscht</strong>',
    'LOG_ITEM_MOVE_DOWN'		=> '<strong>Paypal Donation: %1$s verschoben. </strong> %2$s <strong>unter</strong> %3$s',
    'LOG_ITEM_MOVE_UP'			=> '<strong>Paypal Donation: %1$s verschoben. </strong> %2$s <strong>über</strong> %3$s',
    'LOG_ITEM_ENABLED'			=> '<strong>Paypal Donation: %1$s aktiviert</strong><br />» %2$s',
    'LOG_ITEM_DISABLED'			=> '<strong>Paypal Donation: %1$s deaktiviert</strong><br />» %2$s',
    'LOG_STAT_RESET_DATE'		=> '<strong>Paypal Donation: Installationsdatum zurückgesetzt</strong>',

    // Confirm box
    'DONATION_DC_ENABLED'		=> 'Eine Währung wurde aktiviert',
    'DONATION_DC_DISABLED'		=> 'Eine Währung wurde deaktiviert.',
    'DONATION_DC_ADDED'			=> 'Eine neue Währung wurde hinzugefügt.',
    'DONATION_DC_UPDATED'		=> 'Eine Währung wurde aktualisiert.',
    'DONATION_DC_REMOVED'		=> 'Eine Währung wurde entfernt.',
    'DONATION_DP_LANG_ADDED'	=> 'Eine Spendenseiten-Sprache wurde hinzugefügt',
    'DONATION_DP_LANG_UPDATED'	=> 'Eine Spendenseiten-Sprache wurde aktualisiert',
    'DONATION_DP_LANG_REMOVED'	=> 'Eine Spendenseiten-Sprache wurde entfernt',

    // Errors
    'MUST_SELECT_ITEM'			=> 'Das ausgewählte Element existiert nicht',
    'DONATION_DC_ENTER_NAME'	=> 'Gib einen Währungsnamen ein',
));
