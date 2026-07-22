<?php
/**
*
* common [Dutch]
*
* @package language
* @version $Id: calendar.php,v ALPHA 3.5 2007/10/02 12:00:00 jcc264 Exp $
* @copyright (c) 2007 M and J Media
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
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
// ' » " " …
//
// Board Settings
$lang = array_merge($lang, array(
    'ACP_CALENDAR_SETTINGS'					=> 'Kalender Instellingen',
    'ACP_CALENDAR_SETTINGS_EXPLAIN'			=> 'Hier kun je algemene instellingen voor de kalender definiëren.<br />Sommige van deze opties zullen ook beschikbaar zijn voor gebruikers, op basis van per gebruiker. Je hebt echter de mogelijkheid om gebruikersinstellingen te overschrijven',
    'ACP_CALENDAR_USER_SETTINGS'			=> 'Kalender Gebruikersinstellingen',
    'ACP_CALENDAR_USER_SETTINGS_EXPLAIN'	=> 'Hier kun je gebruikersinstellingen voor de kalender beheren',
    'OVERRIDE_USER'							=> 'Gebruikersinstellingen Overschrijven',
    'OVERRIDE_USER_EXPLAIN'					=> 'Je kunt bepalen of je jouw instellingen voor alle gebruikers wilt gebruiken, of ze de instellingen laten aanpassen',
    'ALLOW_PRIV_EVENTS'						=> 'Privé Evenementen Toestaan',
    'ALLOW_PRIV_EVENTS_EXPLAIN'				=> 'Privé evenementen kunnen niet worden gezien door andere gebruikers dan degenen die de evenementposter specificeert',
    'ALLOW_INDEX_MINICAL'					=> 'Mini Kalender op Index Toestaan',
    'SHOW_WEEK_NUMS'						=> 'Weeknummers Tonen',
    'SHOW_WEEK_NUMS_EXPLAIN'				=> 'Je kunt optioneel ISO-8601 weeknummers weergeven in de hoofdkalenderweergave',
    'MONDAY_FIRST'							=> 'Kalender Startdag',
    'MONDAY_FIRST_EXPLAIN'					=> 'Kalender weken weergeven beginnend vanaf zondag of maandag',
    'SHOW_EVENTS_LIST'						=> 'Evenementenlijst Tonen',
    'SHOW_EVENTS_LIST_EXPLAIN'				=> 'Optioneel een lijst met aankomende evenementen onder de hoofdkalenderweergave weergeven. Je kunt definiëren hoeveel dagen van tevoren evenementen moeten worden weergegeven',
    'SHOW_BIRTHDAYS_LIST'					=> 'Verjaardagenlijst Tonen',
    'SHOW_BIRTHDAYS_LIST_EXPLAIN'			=> 'Optioneel een lijst met aankomende verjaardagen onder de hoofdkalenderweergave weergeven. Je kunt definiëren hoeveel dagen van tevoren verjaardagen moeten worden weergegeven',
    'SHOW_BIRTHDAYS_MAIN'					=> 'Verjaardagen In Kalender Tonen',
    'SHOW_BIRTHDAYS_MAIN_EXPLAIN'			=> 'Optioneel verjaardagen in de hoofdkalenderweergave weergeven',
    'MAX_EVENTS_LIST_DAYS'					=> 'Maximum Dagen Voor Evenementenlijst',
    'MAX_EVENTS_LIST_DAYS_EXPLAIN'			=> 'Definieer het maximum aantal dagen dat een gebruiker kan specificeren om aankomende evenementen weer te geven in de evenementenlijst onder de hoofdkalenderweergave',
    'DEFAULT_EVENTS_LIST_DAYS'				=> 'Standaard Dagen Voor Evenementenlijst',
    'DEFAULT_EVENTS_LIST_DAYS_EXPLAIN'		=> 'Definieer de standaardinstelling voor hoeveel dagen van aankomende evenementen moeten worden weergegeven in de aankomende evenementenlijst onder de hoofdkalenderweergave',
    'MAX_BDAYS_LIST_DAYS'					=> 'Maximum Dagen Voor Verjaardagenlijst',
    'MAX_BDAYS_LIST_DAYS_EXPLAIN'			=> 'Definieer het maximum aantal dagen dat een gebruiker kan specificeren om aankomende verjaardagen weer te geven in de aankomende verjaardagenlijst onder de hoofdkalenderweergave',
    'DEFAULT_BDAYS_LIST_DAYS'				=> 'Standaard Dagen Voor Verjaardagenlijst',
    'DEFAULT_BDAYS_LIST_DAYS_EXPLAIN'		=> 'Definieer de standaardinstelling voor hoeveel dagen van aankomende verjaardagen moeten worden weergegeven in de aankomende verjaardagenlijst onder de hoofdkalenderweergave',
    'CALENDAR_VERSION'						=> 'Kalender Versie',
    'CALENDAR_VERSION_EXPLAIN'				=> 'De momenteel geïnstalleerde versie van de kalender mod.<br />Voor ondersteuning bezoek: www.stargate-portal.com',
    'SUNDAY'								=> 'Zondag',
    'MONDAY'								=> 'Maandag',
));
