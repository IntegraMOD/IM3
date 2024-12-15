<?php
/**
*
* donate.php [Dutch Formal]
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
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	// Notice
	'DONATION_DISABLED'				=> 'Helaas, de donatie-pagina is gedeactiveerd.',
	'DONATION_NOT_INSTALLED'		=> 'Paypal Donatie MOD database gegevens missen.<br />Voer de %sinstaller%s uit om databaseveranderingen voor de MOD te implementeren.',
	'DONATION_INSTALL_MISSING'		=> 'Het installatiebestand lijkt niet te bestaan. Controleer uw installatie!',
	'DONATION_ADDRESS_MISSING'		=> 'Helaas, de Paypal Donatie module is geactiveerd maar een aantal instellingen nog niet correct; neem contact op met uw forumadministrator.',
	'SANDBOX_ADDRESS_MISSING'		=> 'Helaas, de Paypal testomgeving is geactiveerd maar een aantal instellingen nog niet correct. Neem contact op met uw forumadministrator.',

	// Image alternative text
	'IMG_DONATE'			=> 'doneer',
	'IMG_LOADER'			=> 'aan het laden',

	// Default Currency
	'CURRENCY_DEFAULT'		=> 'EUR', // Note : If you remove from ACP ALL currencies, this value will be defined as the default currency.

	// Stats
	//--------------------------->	%1$d = donation raised; %2$s = currency
	'DONATE_RECEIVED'			=> 'We ontvingen <strong>%1$d</strong> %2$s via donaties.',
	'DONATE_NOT_RECEIVED'		=> 'We hebben nog geen donaties ontvangen.',

	//--------------------------->	%1$d = donation goal; %2$s = currency
	'DONATE_GOAL_RAISE'			=> 'Ons doel is om <strong>%1$d</strong> %2$s op te halen.',
	'DONATE_GOAL_REACHED'		=> 'Ons doel is bereikt.',
	'DONATE_NO_GOAL'			=> 'We hebben geen doel vastgesteld.',

	//--------------------------->	%1$d = donation used; %2$s = currency; %3$d = donation raised;
	'DONATE_USED'				=> 'We hebben <strong>%1$d</strong> %2$s van uw donaties gebruikt van <strong>%3$d</strong> %2$s al ontvangen.',
	'DONATE_USED_EXCEEDED'		=> 'We hebben <strong>%1$d</strong> %2$s gebruikt. Alle donaties zijn gebruikt.',
	'DONATE_NOT_USED'			=> 'We hebben nog geen donaties gebruikt.',

	// Pages
	'DONATION_TITLE'			=> 'Doneer',
	'DONATION_TITLE_HEAD'		=> 'Doneer aan',
	'DONATION_CANCEL_TITLE'		=> 'Donatie geannuleerd',
	'DONATION_SUCCESS_TITLE'	=> 'Donatie Succesvol',
	'DONATION_CONTACT_PAYPAL'	=> 'Verbinden met Paypal - Een moment a.u.b.…',
	'SANDBOX_TITLE'				=> 'Test Paypal Donatie met Paypal testomgeving',

	'DONATION_INDEX'			=> 'Donaties',
));

/*
* UMIL
*/
$lang = array_merge($lang, array(
	'INSTALL_DONATION_MOD'				=> 'Installeer Donatie Mod',
	'INSTALL_DONATION_MOD_CONFIRM'		=> 'Klaar om de Donatie Mod te installeren?',
	'INSTALL_DONATION_MOD_WELCOME'		=> 'Grootste veranderingen sinds versie 1.0.3',
	'INSTALL_DONATION_MOD_WELCOME_NOTE'	=> 'De taal sleutels in “Donatie pagina” zijn naar de database verplaatst.
											<br />Wanneer u deze mogelijkheid gebruikt, zorg voor een backup van uw taalbestanden voordat u deze MOD gaat updaten naar de nieuwe versie.
											<br /><br />Een nieuwe gebruikerspermissie is toegevoegd.
											<br />Vergeet niet nieuwe permissies toe te voegen <strong>ACP >> Permissies >> Globale permissies >> Gebruiker permissies</strong>
											<br />Om het voor anonieme gasten mogelijk maken te doneren, vink “Selecteer anonieme gebruiker” aan',

	'DONATION_MOD'						=> 'Donatie Mod',
	'DONATION_MOD_EXPLAIN'				=> 'Installeer Donatie Mod database veranderingen met UMIL auto methode.',

	'UNINSTALL_DONATION_MOD'			=> 'Oninstalleer Donatie Mod',
	'UNINSTALL_DONATION_MOD_CONFIRM'	=> 'Klaar om de Donatie Mod te oninstalleren? Alle instellingen en data zullen worden verwijderd!',

	'UPDATE_DONATION_MOD'				=> 'Update Donatie Mod',
	'UPDATE_DONATION_MOD_CONFIRM'		=> 'Klaar om de Donatie Mod te updaten?',

	'UNUSED_LANG_FILES_TRUE'			=> 'Verwijdering van ongebruikte taalbestanden.',
	'UNUSED_LANG_FILES_FALSE'			=> 'De verwijdering van ongebruikte bestanden is niet nodig.',
));
?>