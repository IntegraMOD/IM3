<?php
/**
*
* info_acp_donation.php [Dutch Formal]
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


/**
* mode: main
*/
$lang = array_merge($lang, array(
	'ACP_DONATION_MOD' => 'Paypal Donatie',
));

/**
* mode: overview
*/
$lang = array_merge($lang, array(
	'DONATION_OVERVIEW'			=> 'Overzicht',
	'DONATION_WELCOME'			=> 'Welkom bij de Paypal Donatie MOD',
	'DONATION_WELCOME_EXPLAIN'	=> '',

	'DONATION_STATS'			=> 'Donatie statistieken',
	'DONATION_INSTALL_DATE'		=> 'Installeerdatum van de <strong>Paypal Donatie MOD</strong>',
	'DONATION_VERSION'			=> '<strong>Paypal Donatie</strong> versie',

	'INFO_FSOCKOPEN'			=> 'Fsockopen',
	'INFO_CURL'					=> 'cURL',
	'INFO_DETECTED'				=> 'Gedetecteerd',
	'INFO_NOT_DETECTED'			=> 'Niet gedetecteerd',
	'DONATION_VERSION_NOT_UP_TO_DATE_TITLE'	=> 'De Paypal Donatie installatie is niet recent genoeg.',

	'STAT_RESET_DATE'							=> 'Reset MOD Installatie datum',
	'STAT_RESET_DATE_EXPLAIN'					=> 'Resetten van de installatie heeft effect op statistieken over de berekening van het volledige bedrag wat is gedoneerd',
	'STAT_RESET_DATE_CONFIRM'					=> 'Weet u zeker dat u de MOD’s installatie datum wilt resetten?',
));

/**
* mode: configuration
*/
$lang = array_merge($lang, array(
	'DONATION_CONFIG'				=> 'Configuratie',
	'DONATION_CONFIG_EXPLAIN'		=> '',
	'DONATION_SAVED'				=> 'Donatie instellingen bewaard',
	'MODE_CURRENCY'					=> 'munteenheid',
	'MODE_DONATION_PAGES'			=> 'donatie pagina',

	// Global Donation settings
	'DONATION_ENABLE'						=> 'Zet Paypal Donatie aan',
	'DONATION_ENABLE_EXPLAIN'				=> 'Zet de Paypal Donatie MOD aan of uit',
	'DONATION_ACCOUNT_ID'					=> 'Paypal account ID',
	'DONATION_ACCOUNT_ID_EXPLAIN'			=> 'Voer hier uw Paypal email-adres of account ID in',
	'DONATION_DEFAULT_CURRENCY'				=> 'Standaard munteenheid',
	'DONATION_DEFAULT_CURRENCY_EXPLAIN'		=> 'Geef aan welke munteenheid standaard wordt gebruikt',
	'DONATION_DEFAULT_VALUE'				=> 'Standaard donatie bedrag',
	'DONATION_DEFAULT_VALUE_EXPLAIN'		=> 'Geef aan welk donatie-bedrag standaard wordt geadviseerd',
	'DONATION_DROPBOX_ENABLE'				=> 'Zet de drop-down lijst aan',
	'DONATION_DROPBOX_ENABLE_EXPLAIN'		=> 'Indien aangezet zal dit het tekstveld vervangen door een drop-downlijst.',
	'DONATION_DROPBOX_VALUE'				=> 'Drop-down waarde',
	'DONATION_DROPBOX_VALUE_EXPLAIN'		=> 'Geef aan welke getallen uw in de drop-down lijst wil hebben, gescheiden door</strong> (",") <strong>zonder spaties om aparte bedragen te scheiden.',

	// Paypal sandbox settings
	'SANDBOX_SETTINGS'						=> 'Paypal testomgeving instellingen',
	'SANDBOX_ENABLE'						=> 'Testomgeving aan',
	'SANDBOX_ENABLE_EXPLAIN'				=> 'Gebruik deze instelling indien u de Paypal testomgeving wil gebruiken i.p.v. Paypal Services.<br />Met name om te testen. Alle transacties zullen niet echt plaatsvinden.',
	'SANDBOX_FOUNDER_ENABLE'				=> 'Testomgeving alleen voor forum-administrator',
	'SANDBOX_FOUNDER_ENABLE_EXPLAIN'		=> 'Indien aangezet zal de Paypal testomgeving alleen zichtbaar zijn voor de forum-administrators.',
	'SANDBOX_ADDRESS'						=> 'PayPal testomgeving adres',
	'SANDBOX_ADDRESS_EXPLAIN'				=> 'Geef hier het Paypal testomgeving verkopers e-mail adres op',

	// Stats Donation settings
	'DONATION_STATS_SETTINGS'				=> 'Stats donatie config',
	'DONATION_STATS_INDEX_ENABLE'			=> 'Laat de donatie zien op de indexpagina',
	'DONATION_STATS_INDEX_ENABLE_EXPLAIN'	=> 'Zet deze optie aan indien u de donatie statistieken op de indexpagina wilt laten zien',
	'DONATION_RAISED_ENABLE'				=> 'Zet donaties opgehaald aan',
	'DONATION_RAISED'						=> 'Donaties opgehaald',
	'DONATION_RAISED_EXPLAIN'				=> 'Het huidige bedrag opgehaald via donaties',
	'DONATION_GOAL_ENABLE'					=> 'Zet donatie doel aan',
	'DONATION_GOAL'							=> 'Donatie doel',
	'DONATION_GOAL_EXPLAIN'					=> 'Het totale bedrag dat opgehaald moet worden',
	'DONATION_USED_ENABLE'					=> 'Zet donaties gebruikt aan',
	'DONATION_USED'							=> 'Donaties gebruikt',
	'DONATION_USED_EXPLAIN'					=> 'Het bedrag wat al is gebruikt uit de donaties',

	'DONATION_CURRENCY_ENABLE'				=> 'Zet donatie munteenheid aan',
	'DONATION_CURRENCY_ENABLE_EXPLAIN'		=> 'Zet deze optie aan indien u de ISO 4217 code van standaard munteenheden wil laten zien in Statistieken.',
));

/**
* mode: donation pages
* Info: language keys are prefixed with 'DONATION_DP_' for 'DONATION_DONATION_PAGES_'
*/
$lang = array_merge($lang, array(
	// Donation Page settings
	'DONATION_DP_CONFIG'			=> 'Donatie pagina',
	'DONATION_DP_CONFIG_EXPLAIN'	=> 'Sta toe dat er verbeteringen worden gesuggereerd aan de vertalingen van de MOD.',

	'DONATION_DP_PAGE'				=> 'Pagina type',
	'DONATION_DP_LANG'				=> 'Taal',

	// Donation Page Body settings
	'DONATION_BODY_SETTINGS'	=> 'Donatie hoofdpagina config',
	'DONATION_BODY'				=> 'Donatie hoofd pagina',
	'DONATION_BODY_EXPLAIN'		=> 'Zet hier de tekst die op de hoofd-donatiepagina moet verschijnen.',

	// Donation Success settings
	'DONATION_SUCCESS_SETTINGS'	=> 'Donatie succes config',
	'DONATION_SUCCESS'			=> 'Donatie succesvol',
	'DONATION_SUCCESS_EXPLAIN'	=> 'Zet hier de tekst die u op de succes-pagina wilt laten zien.',

	// Donation Cancel settings
	'DONATION_CANCEL_SETTINGS'	=> 'Donatie annuleer config',
	'DONATION_CANCEL'			=> 'Donatie annuleren',
	'DONATION_CANCEL_EXPLAIN'	=> 'Zet hier de tekst die u op de annuleerpagina wilt laten zien.',

	// Donation Page Template vars
	'DONATION_DP_PREDEFINED_VARS'	=> 'Voorgedefinieerde Variabele',
	'DONATION_DP_VAR_EXAMPLE'		=> 'Voorbeeld',
	'DONATION_DP_VAR_NAME'			=> 'Naam',
	'DONATION_DP_VAR_VAR'			=> 'Variabele',

	'DONATION_DP_BOARD_CONTACT'		=> 'Forum contactpersoon',
	'DONATION_DP_BOARD_EMAIL'		=> 'Forum e-mail',
	'DONATION_DP_BOARD_SIG'			=> 'Forum Handtekening',
	'DONATION_DP_SITE_DESC'			=> 'Website beschrijving',
	'DONATION_DP_SITE_NAME'			=> 'Website Naam',
	'DONATION_DP_USER_ID'			=> 'Gebruiker ID',
	'DONATION_DP_USERNAME'			=> 'Gebruikersnaam',
));

/**
* mode: currency
* Info: language keys are prefixed with 'DONATION_DC_' for 'DONATION_DONATION_CURRENCY_'
*/
$lang = array_merge($lang, array(
	// Currency Management
	'DONATION_DC_CONFIG'			=> 'Munteenheid management',
	'DONATION_DC_CONFIG_EXPLAIN'	=> 'Hier kunt u munteenheden managen',
	'DONATION_DC_NAME'				=> 'Munteenheid naam',
	'DONATION_DC_NAME_EXPLAIN'		=> 'Naam van de munteenheid.<br />(i.e. Euro)',
	'DONATION_DC_ISO_CODE'			=> 'ISO 4217 code',
	'DONATION_DC_ISO_CODE_EXPLAIN'	=> 'Alfabetische code van de munteenheid.<br />Meer over de ISO 4217 codes… zie <a href="http://www.phpbb.com/customise/db/mod/paypal_donation_mod/faq/f_746" title="Paypal Donatie MOD FAQ">Paypal Donatie MOD FAQ</a> (external link)',
	'DONATION_DC_SYMBOL'			=> 'Munteenheid symbool',
	'DONATION_DC_SYMBOL_EXPLAIN'	=> 'Definieer het munteenheid symbool.<br />(i.e. € for Euro, $ for U.S. Dollar)',
	'DONATION_DC_ENABLED'			=> 'Zet munteenheid aan',
	'DONATION_DC_ENABLED_EXPLAIN'	=> 'Indien aangezet zullen de munteenheden zichtbaar zijn in de drop-down lijst',
	'DONATION_DC_CREATE_CURRENCY'	=> 'Nieuwe munteenheid toevoegen',
));

/**
* logs
*/
$lang = array_merge($lang, array(
	//logs
	'LOG_DONATION_UPDATED'			=> '<strong>Paypal Donatie: Instellingen vernieuwd.</strong>',
	'LOG_DONATION_PAGES_UPDATED'	=> '<strong>Paypal Donatie: Donatie Pagina vernieuwd.</strong>',
	'LOG_ITEM_ADDED'				=> '<strong>Paypal Donatie: %1$s toegevoegd</strong><br />» %2$s',
	'LOG_ITEM_UPDATED'				=> '<strong>Paypal Donatie: %1$s vernieuwd</strong><br />» %2$s',
	'LOG_ITEM_REMOVED'				=> '<strong>Paypal Donatie: %1$s gewist</strong>',
	'LOG_ITEM_MOVE_DOWN'			=> '<strong>Paypal Donatie: Verplaatste %1$s. </strong> %2$s <strong>naar beneden</strong> %3$s',
	'LOG_ITEM_MOVE_UP'				=> '<strong>Paypal Donatie: Verplaatste %1$s. </strong> %2$s <strong>naar boven</strong> %3$s',
	'LOG_ITEM_ENABLED'				=> '<strong>Paypal Donatie: %1$s aangezet</strong><br />» %2$s',
	'LOG_ITEM_DISABLED'				=> '<strong>Paypal Donatie: %1$s uitgezet</strong><br />» %2$s',
	'LOG_STAT_RESET_DATE'			=> '<strong>Paypal Donatie: Installatie datum reset</strong>',

	// Confirm box
	'DONATION_DC_ENABLED'		=> 'Munteenheid aangezet',
	'DONATION_DC_DISABLED'		=> 'Munteenheid uitgezet.',
	'DONATION_DC_ADDED'			=> 'Munteenheid toegevoegd.',
	'DONATION_DC_UPDATED'		=> 'Munteenheid vernieuwd.',
	'DONATION_DC_REMOVED'		=> 'Munteenheid verwijderd.',
	'DONATION_DP_LANG_ADDED'	=> 'Een donatie pagina taal is toegevoegd',
	'DONATION_DP_LANG_UPDATED'	=> 'Een donatie pagina taal is vernieuwd',
	'DONATION_DP_LANG_REMOVED'	=> 'Een donatie pagina taal is verwijderd',

	// Errors
	'MUST_SELECT_ITEM'			=> 'Selectie bestaat niet',
	'DONATION_DC_ENTER_NAME'	=> 'Voer een naam in voor de munteenheid',
));
?>