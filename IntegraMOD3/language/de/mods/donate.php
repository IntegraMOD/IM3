<?php
/**
*
* donate.php [German]
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

$lang = array_merge($lang, array(
    // Notice
    'DONATION_DISABLED'				=> 'Entschuldigung, die Spendenseite ist derzeit nicht verfügbar.',
    'DONATION_NOT_INSTALLED'		=> 'Paypal Donation MOD Datenbankeinträge fehlen.<br />Bitte führe das %sInstallationsprogramm%s aus, um die Datenbankänderungen für die MOD vorzunehmen.',
    'DONATION_INSTALL_MISSING'		=> 'Die Installationsdatei scheint zu fehlen. Bitte überprüfe deine Installation !',
    'DONATION_ADDRESS_MISSING'		=> 'Entschuldigung, Paypal Donation ist aktiviert, aber einige Einstellungen fehlen. Bitte benachrichtige den Board-Gründer.',
    'SANDBOX_ADDRESS_MISSING'		=> 'Entschuldigung, Paypal Sandbox ist aktiviert, aber einige Einstellungen fehlen. Bitte benachrichtige den Board-Gründer.',

    // Image alternative text
    'IMG_DONATE'		=> 'spenden',
    'IMG_LOADER'		=> 'lädt',

    // Default Currency
    'CURRENCY_DEFAULT'		=> 'USD', // Note : If you remove from ACP ALL currencies, this value will be defined as the default currency.

    // Stats
    //----------------------------->	%1$d = donation raised; %2$s = currency
    'DONATE_RECEIVED'			=> 'Wir haben <strong>%1$d</strong> %2$s an Spenden erhalten.',
    'DONATE_NOT_RECEIVED'		=> 'Wir haben noch keine Spenden erhalten.',

    //----------------------------->	%1$d = donation goal; %2$s = currency
    'DONATE_GOAL_RAISE'			=> 'Unser Ziel ist es, <strong>%1$d</strong> %2$s zu sammeln.',
    'DONATE_GOAL_REACHED'		=> 'Unser Spendenziel wurde erreicht.',
    'DONATE_NO_GOAL'			=> 'Wir haben kein Spendenziel festgelegt.',

    //----------------------------->	%1$d = donation used; %2$s = currency; %3$d = donation raised;
    'DONATE_USED'				=> 'Wir haben <strong>%1$d</strong> %2$s deiner Spenden von <strong>%3$d</strong> %2$s bereits erhalten verwendet.',
    'DONATE_USED_EXCEEDED'		=> 'Wir haben <strong>%1$d</strong> %2$s verwendet. Alle deine Spenden wurden verwendet.',
    'DONATE_NOT_USED'			=> 'Wir haben noch keine Spenden verwendet.',

    // Pages
    'DONATION_TITLE'			=> 'Spende Tätigen',
    'DONATION_TITLE_HEAD'		=> 'Eine Spende Machen An',
    'DONATION_CANCEL_TITLE'		=> 'Spende Abgebrochen',
    'DONATION_SUCCESS_TITLE'	=> 'Spende Erfolgreich',
    'DONATION_CONTACT_PAYPAL'	=> 'Verbindung zu Paypal - Bitte Warten…',
    'SANDBOX_TITLE'				=> 'Paypal Donation mit Paypal Sandbox Testen',

    'DONATION_INDEX'			=> 'Spenden',
));

/*
* UMIL
*/
$lang = array_merge($lang, array(
    'INSTALL_DONATION_MOD'				=> 'Donation Mod Installieren',
    'INSTALL_DONATION_MOD_CONFIRM'		=> 'Bist du bereit, die Donation Mod zu installieren?',
    'INSTALL_DONATION_MOD_WELCOME'		=> 'Wichtige Änderungen seit Version 1.0.3',
    'INSTALL_DONATION_MOD_WELCOME_NOTE'	=> 'Die von "Donation pages" verwendeten Sprachschlüssel wurden in die Datenbank migriert.
                                            <br />Wenn du diese Funktion verwendest, sichere deine Sprachdateien, bevor du die MOD auf diese neue Version aktualisierst.
                                            <br /><br />Eine neue Berechtigung wurde hinzugefügt.
                                            <br />Vergiss nicht, diese neue Berechtigung unter <strong>ACP >> Berechtigungen >> Globale Berechtigungen >> Benutzerberechtigungen</strong> einzurichten
                                            <br />Um Gästen das Spenden zu ermöglichen, aktiviere das Kontrollkästchen "Anonymen Benutzer auswählen"',

    'DONATION_MOD'						=> 'Donation Mod',
    'DONATION_MOD_EXPLAIN'				=> 'Donation Mod Datenbankänderungen mit UMIL Auto-Methode installieren.',

    'UNINSTALL_DONATION_MOD'			=> 'Donation Mod Deinstallieren',
    'UNINSTALL_DONATION_MOD_CONFIRM'	=> 'Bist du bereit, die Donation Mod zu deinstallieren? Alle Einstellungen und Daten, die von dieser Mod gespeichert wurden, werden entfernt!',

    'UPDATE_DONATION_MOD'				=> 'Donation Mod Aktualisieren',
    'UPDATE_DONATION_MOD_CONFIRM'		=> 'Bist du bereit, die Donation Mod zu aktualisieren?',

    'UNUSED_LANG_FILES_TRUE'			=> 'Entfernung ungenutzter Sprachdateien.',
    'UNUSED_LANG_FILES_FALSE'			=> 'Die Entfernung ungenutzter Dateien ist nicht erforderlich.',
));
