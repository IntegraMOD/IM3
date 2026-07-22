<?php
/**
*
* common [German]
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
    'ACP_CALENDAR_SETTINGS'					=> 'Kalender Einstellungen',
    'ACP_CALENDAR_SETTINGS_EXPLAIN'			=> 'Hier kannst du allgemeine Einstellungen für den Kalender festlegen.<br />Einige dieser Optionen werden auch für Benutzer verfügbar sein, auf Basis pro Benutzer. Du hast jedoch die Möglichkeit, Benutzereinstellungen zu überschreiben',
    'ACP_CALENDAR_USER_SETTINGS'			=> 'Kalender Benutzereinstellungen',
    'ACP_CALENDAR_USER_SETTINGS_EXPLAIN'	=> 'Hier kannst du Benutzereinstellungen für den Kalender verwalten',
    'OVERRIDE_USER'							=> 'Benutzereinstellungen Überschreiben',
    'OVERRIDE_USER_EXPLAIN'					=> 'Du kannst entscheiden, ob du deine Einstellungen für alle Benutzer verwenden oder sie die Einstellungen anpassen lassen möchtest',
    'ALLOW_PRIV_EVENTS'						=> 'Private Veranstaltungen Erlauben',
    'ALLOW_PRIV_EVENTS_EXPLAIN'				=> 'Private Veranstaltungen können nicht von anderen Benutzern gesehen werden als denen, die der Veranstaltungsposter angibt',
    'ALLOW_INDEX_MINICAL'					=> 'Mini Kalender auf Index Erlauben',
    'SHOW_WEEK_NUMS'						=> 'Wochennummern Anzeigen',
    'SHOW_WEEK_NUMS_EXPLAIN'				=> 'Du kannst optional ISO-8601 Wochennummern in der Hauptkalenderansicht anzeigen',
    'MONDAY_FIRST'							=> 'Kalender Starttag',
    'MONDAY_FIRST_EXPLAIN'					=> 'Kalenderwochen anzeigen beginnend mit Sonntag oder Montag',
    'SHOW_EVENTS_LIST'						=> 'Veranstaltungsliste Anzeigen',
    'SHOW_EVENTS_LIST_EXPLAIN'				=> 'Optional eine Liste bevorstehender Veranstaltungen unter der Hauptkalenderansicht anzeigen. Du kannst festlegen, wie viele Tage im Voraus Veranstaltungen angezeigt werden sollen',
    'SHOW_BIRTHDAYS_LIST'					=> 'Geburtstagsliste Anzeigen',
    'SHOW_BIRTHDAYS_LIST_EXPLAIN'			=> 'Optional eine Liste bevorstehender Geburtstage unter der Hauptkalenderansicht anzeigen. Du kannst festlegen, wie viele Tage im Voraus Geburtstage angezeigt werden sollen',
    'SHOW_BIRTHDAYS_MAIN'					=> 'Geburtstage Im Kalender Anzeigen',
    'SHOW_BIRTHDAYS_MAIN_EXPLAIN'			=> 'Optional Geburtstage in der Hauptkalenderansicht anzeigen',
    'MAX_EVENTS_LIST_DAYS'					=> 'Maximale Tage Für Veranstaltungsliste',
    'MAX_EVENTS_LIST_DAYS_EXPLAIN'			=> 'Lege die maximale Anzahl von Tagen fest, die ein Benutzer angeben kann, um bevorstehende Veranstaltungen in der Veranstaltungsliste unter der Hauptkalenderansicht anzuzeigen',
    'DEFAULT_EVENTS_LIST_DAYS'				=> 'Standard Tage Für Veranstaltungsliste',
    'DEFAULT_EVENTS_LIST_DAYS_EXPLAIN'		=> 'Lege die Standardeinstellung fest, wie viele Tage bevorstehender Veranstaltungen in der bevorstehenden Veranstaltungsliste unter der Hauptkalenderansicht angezeigt werden sollen',
    'MAX_BDAYS_LIST_DAYS'					=> 'Maximale Tage Für Geburtstagsliste',
    'MAX_BDAYS_LIST_DAYS_EXPLAIN'			=> 'Lege die maximale Anzahl von Tagen fest, die ein Benutzer angeben kann, um bevorstehende Geburtstage in der bevorstehenden Geburtstagsliste unter der Hauptkalenderansicht anzuzeigen',
    'DEFAULT_BDAYS_LIST_DAYS'				=> 'Standard Tage Für Geburtstagsliste',
    'DEFAULT_BDAYS_LIST_DAYS_EXPLAIN'		=> 'Lege die Standardeinstellung fest, wie viele Tage bevorstehender Geburtstage in der bevorstehenden Geburtstagsliste unter der Hauptkalenderansicht angezeigt werden sollen',
    'CALENDAR_VERSION'						=> 'Kalender Version',
    'CALENDAR_VERSION_EXPLAIN'				=> 'Die aktuell installierte Version der Kalender Mod.<br />Für Support besuche: www.stargate-portal.com',
    'SUNDAY'								=> 'Sonntag',
    'MONDAY'								=> 'Montag',
));
