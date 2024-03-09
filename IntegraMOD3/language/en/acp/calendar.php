<?php
/**
*
* common [English]
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
// â€™ Â» â€œ â€ â€¦
//
// Board Settings
$lang = array_merge($lang, array(
	'ACP_CALENDAR_SETTINGS'					=> 'Calendar Settings',
	'ACP_CALENDAR_SETTINGS_EXPLAIN'			=> 'Here you can define general settings for the calendar.<br />Some of these options will be available to users also, on a per user basis. However, you have the option of overriding user\'s settings',
	'ACP_CALENDAR_USER_SETTINGS'			=> 'Calendar User Settings',
	'ACP_CALENDAR_USER_SETTINGS_EXPLAIN'	=> 'Here you can manage user\'s settings for the calendar',
	'OVERRIDE_USER'							=> 'Override User\'s Settings',
	'OVERRIDE_USER_EXPLAIN'					=> 'You can decide whether to use your settings for all users, or let them customise the settings',
	'ALLOW_PRIV_EVENTS'						=> 'Allow Private Events',
	'ALLOW_PRIV_EVENTS_EXPLAIN'				=> 'Private events can not be seen by any users other than those which the event poster specifies',
	'ALLOW_INDEX_MINICAL'					=> 'Allow Mini Calendar on Index',
	'SHOW_WEEK_NUMS'						=> 'Show Week Wumbers',
	'SHOW_WEEK_NUMS_EXPLAIN'				=> 'You can optionally display ISO-8601 week numbers in the main calendar view',
	'MONDAY_FIRST'							=> 'Calendar Starting Day',
	'MONDAY_FIRST_EXPLAIN'					=> 'Display calendar weeks starting from Sunday or Monday',
	'SHOW_EVENTS_LIST'						=> 'Show Events List',
	'SHOW_EVENTS_LIST_EXPLAIN'				=> 'Optionally display a list of upcoming events beneath the main calendar view. You can define how many days in advance for which events should be displayed',
	'SHOW_BIRTHDAYS_LIST'					=> 'Show Birthdays List',
	'SHOW_BIRTHDAYS_LIST_EXPLAIN'			=> 'Optionally display a list of upcoming birthdays beneath the main calendar view. You can define how many days in advance for which birthdays should be displayed',
	'SHOW_BIRTHDAYS_MAIN'					=> 'Show Birthdays In Calendar',
	'SHOW_BIRTHDAYS_MAIN_EXPLAIN'			=> 'Optionally display birthdays in the main calendar view',
	'MAX_EVENTS_LIST_DAYS'					=> 'Maximum Days For Events List',
	'MAX_EVENTS_LIST_DAYS_EXPLAIN'			=> 'Define the maximum amount of days that a user can specifiy to display upcoming events in the events list beneath the main calendar view',
	'DEFAULT_EVENTS_LIST_DAYS'				=> 'Default Days For Event List',
	'DEFAULT_EVENTS_LIST_DAYS_EXPLAIN'		=> 'Define the default setting for how many days worth of upcoming events should be displayed in the upcoming events list beneath the main calendar view',
	'MAX_BDAYS_LIST_DAYS'					=> 'Maximum Days For Birthdays List',
	'MAX_BDAYS_LIST_DAYS_EXPLAIN'			=> 'Define the maximum amount of days that a user can specifiy to display upcoming birthdays in the upcoming birthdays list beneath the main calendar view',
	'DEFAULT_BDAYS_LIST_DAYS'				=> 'Default Days For Birthdays List',
	'DEFAULT_BDAYS_LIST_DAYS_EXPLAIN'		=> 'Define the default setting for how many days worth of upcoming birthdays should be displayed in the upcoming birthdays list beneath the main calendar view',
	'CALENDAR_VERSION'						=> 'Calendar Version',
	'CALENDAR_VERSION_EXPLAIN'				=> 'The currently installed version of the calendar mod.<br />For support visit: www.stargate-portal.com',
	'SUNDAY'								=> 'Sunday',
	'MONDAY'								=> 'Monday',
));
