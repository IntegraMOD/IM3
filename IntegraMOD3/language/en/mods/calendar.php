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

$lang = array_merge($lang, array(

'CAL_CALENDAR'=> array(
   'DAY_INITIAL'=> array(
         0 => 'S',
         1 => 'M',
         2 => 'T',
         3 => 'W',
         4 => 'T',
         5 => 'F',
         6 => 'S',
         ),

   'CAL_DAY'=> array(
         0 => 'Su',
         1 => 'Mo',
         2 => 'Tu',
         3 => 'We',
         4 => 'Th',
         5 => 'Fr',
         6 => 'Sa',
         ),

   'CAL_LONG_DAY'=> array(
         0 => 'Sunday',
         1 => 'Monday',
         2 => 'Tuesday',
         3 => 'Wednesday',
         4 => 'Thursday',
         5 => 'Friday',
         6 => 'Saturday',
         ),

   'CAL_MONTH'=> array(
         1 => 'Jan',
         2 => 'Feb',
         3 => 'Mar',
         4 => 'Apr',
         5 => 'May',
         6 => 'Jun',
         7 => 'Jul',
         8 => 'Aug',
         9 => 'Sep',
         10 => 'Oct',
         11 => 'Nov',
         12 => 'Dec',
      ),

   'CAL_LONG_MONTH'=> array(
         1 => 'January',
         2 => 'February',
         3 => 'March',
         4 => 'April',
         5 => 'May',
         6 => 'June',
         7 => 'July',
         8 => 'August',
         9 => 'September',
         10 => 'October',
         11 => 'November',
         12 => 'December',
      ),
   ),

'NEW_EVENT'                 			=> 'New Event',

'CALENDAR_ADD_EVENT'        			=> 'Add Event',
'CALENDAR_EDIT_EVENT'       			=> 'Edit Event',
'CALENDAR_DELETE_EVENT'     			=> 'Delete Event',
'CALENDAR_DELETE_WARN'      			=> 'Once deleted the event cannot be recovered. Are you sure you wish to continue?',
'CALENDAR_EVENT_NAME'       			=> 'Event Name',
'CALENDAR_EVENT_DESC'       			=> 'Event Description',
'CALENDAR_EVENT_DESC_EXP'   			=> 'Enter your event description here, it may contain no more than 255 characters',
'CALENDAR_EVENT_END'        			=> 'Event End',
'CALENDAR_EVENT_START'      			=> 'Event Start',
'CALENDAR_EVENT_REPEAT'					=> 'Repeat event',
'CALENDAR_REPEAT_DATES'					=> 'Calculated repeat dates',
'CALENDAR_REPEAT_COUNT'					=> 'Number of Repetitions',
'CALENDAR_REPEAT_PERIOD'				=> 'Repeat Period',
'CALENDAR_ASSOC_EVENT'      			=> 'Associated Event',

'CALENDAR_NAME_ERROR'       			=> 'You must specify an event name.',
'CALENDAR_INPUT_START_TIME_DATE_ERROR'	=> 'You must specify a valid start time and date for the event.',
'CALENDAR_INPUT_END_TIME_DATE_ERROR'  	=> 'You must specify a valid end time and date for the event.',
'CALENDAR_OVERLAP_ERROR'    			=> 'The end of the event must occur after the start of the event.',
'CALENDAR_DESC_ERROR'       			=> 'You must include an event description.',
'CALENDAR_REPEAT_COUNT_ERROR'			=> 'Number of repetitions is not in range',
'CALENDAR_REPEAT_WHEN_ERROR'			=> 'Event repeat parameters are not valid',
'CALENDAR_REPEAT_TIMES_INCONSISTENT'	=> 'The initial event times are not consistent with the repeat parameters you have specified',
'CALENDAR_INCONSISTENCY_SPECIFICS'		=> '&rArr; %s is not the %s %s of the specified month',
'CALENDAR_INCONSISTENT_MONTH'			=> '&rArr; %s is not the %s %s of %s',
'CALENDAR_MUST_SELECT_GROUP'			=> 'You must select at least one group for group events',
'CALENDAR_MUST_SELECT_USER' 			=> 'You must select at least one member for private events',
'CALENDAR_INVALID_USERNAME'				=> 'The username \'%s\' is either invalid, or the user does not exist',

'PERIOD_DAYS'							=> 'Every day',
'PERIOD_WEEKS'							=> 'Every week',
'PERIOD_MONTHS'							=> 'Every month',
'PERIOD_YEARS'							=> 'Every year',
'PERIOD_WEEKDAY_MONTH'					=> 'nth weekday every n months',
'PERIOD_WEEKDAY_MONTH_YEAR'				=> 'nth weekday of nth month every year',
'PERIOD_SPECIFY_DATES'					=> 'Specify multiple dates',
'PERIOD_N_DAYS'							=> 'Every n days',
'PERIOD_N_WEEKS'						=> 'Every n weeks',
'PERIOD_N_MONTHS'						=> 'Every n months',
'PERIOD_N_YEARS'						=> 'Every n years',

'SINGLE_EVENT'							=> 'Single Event',
'INITIAL_EVENT'							=> 'Initial event',
'REPEAT'								=> 'Repeat',
'REPEATED'								=> 'Repeated',

'IS_REPEAT_EVENT'						=> 'This is a repeat event',
'IS_CONTINUED_EVENT'					=> 'This event is continued from the previous day',

'FIRST'									=> 'First',
'SECOND'								=> 'Second',
'THIRD'									=> 'Third',
'FOURTH'								=> 'Fourth',
'LAST'									=> 'Last',
'EVERY'									=> 'Every',
'MONTHS'								=> 'Months',
'OF'									=> 'Of',
'EVERY_YEAR'							=> 'Every Year',

'INITIAL_EVENT_SETTINGS_NOTICE'			=> 'The times of the initial event will be determined by the information entered above',

'NTH_DAY_N_MONTHS_DETAILS'				=> ' on the %s %s of the month, every %s months<br />',
'NTH_DAY_NTH_MONTH_EACH_YEAR_DETAILS'	=> '%s %s of %s every year',

'ADD_EVENTS_CONFIRM'					=> 'Are you sure you wish to add the following event(s)?<br />Repeat frequency: %s<br />%s',
'EDIT_EVENTS_CONFIRM'					=> 'Are you sure you wish to edit the event to the following parameters?<br />Repeat frequency: %s<br />%s',

'DELETE_SINGLE_EVENT_CONFIRM'			=> 'Once deleted, this event can not be recovered.<br />Are you sure you want to continue?',
'DELETE_MULTIPLE_EVENTS_CONFIRM'		=> 'There are repeat events associated with this event. Deleting this event will also delete the repeated instances of this event.<br />Are you sure you want to continue?',
'DELETE_REPEAT_EVENT_INSTANCE_CONFIRM'	=> 'Clicking \'YES\' will only delete this repeated instance of this event.<br />Once deleted, this event can not be recovered.<br />To delete all repeat events associated with this event, you must delete the initial event.<br />Are you sure you want to continue?',
'DELETE_SINGLE_T_EVENT_CONFIRM'			=> 'Once deleted, this event can not be recovered.<br />Deleting this event will not delete the topic.<br />Are you sure you want to continue?',
'DELETE_MULTIPLE_T_EVENTS_CONFIRM'		=> 'Deleting this event will also delete the repeated events associated with it.<br />Once deleted, these events can not be recovered.<br />Deleting these events will not delete the topic.<br /> Are you sure you want to continue?',
'DELETE_REPEAT_EVENT_T_INSTANCE_CONFIRM'=> 'Clicking \'YES\' will only delete this repeated instance of this event.<br />Once deleted, this event can not be recovered.<br />To delete all repeat events associated with this event, you must delete the initial event.<br />Deleting this event will not delete the topic.<br />Are you sure you want to continue?',

'CALENDAR_EVENT_ADDED'      			=> 'The event was added successfully',
'CALENDAR_EVENT_EDITED'     			=> 'The event was edited successfully',
'CALENDAR_EVENT_DELETED'    			=> 'The event was deleted successfully',
'CALENDAR_EVENTS_DELETED'    			=> 'The events were deleted successfully',
'CALENDAR_EVENT_INSTANCE_DELETED'		=> 'The repeat event instance was deleted successfully',
'CALENDAR_REPEAT_EVENT_ADDED'      		=> 'The repeat events were added successfully',
'CALENDAR_REPEAT_EVENT_EDITED'     		=> 'The repeat events were edited successfully',
'CALENDAR_REPEAT_EVENT_DELETED'    		=> 'The repeat events were deleted successfully',
'ACTION_FAILED'             			=> 'The requested action could not be completed',


// Special groups
'GROUP_PRIVATE'             			=> 'Private',
'GROUP_PUBLIC'              			=> 'Public',

'EVENTS_OF'								=> 'Events of',
'DATE'                     				=> 'Date',
'DAYS'                     				=> ' Days, ',
'HOURS'                     			=> ' Hours, ',
'MINUTES'                  				=> ' Minutes ',
'DAY'                     				=> ' Day, ',
'HOUR'                     				=> ' Hour, ',
'MINUTE'                  				=> ' Minute ',
'WEEK_NUM'                  			=> 'Wk',
'WEEK_NUM_EXPLAIN'          			=> 'Week numbers calculated according to ISO-8601',
'WEEK_NUM_NOTES'            			=> 'Week numbers relate to the week from monday onwards. Because you have your calendar set to display week days starting from Sunday, The Sunday of each week will be from the previous week number',
'STARTS'                  				=> 'Starts',
'ENDS'                     				=> 'Ends',
'DURATION'                  			=> 'Duration',

'UNEXPECTED_ERROR'          			=> 'An unexpected error has occured',
'RETURN_CALENDAR'           			=> 'Returning to Calendar',
'READ_FULL_TOPIC'           			=> ' ...Read full topic',

'CALENDAR_SETTINGS'         			=> 'Calendar Settings',
'CAL_START_DAY'             			=> 'Week Starts',
'SHOW_WEEK_NUMS'						=> 'Show Week Numbers?',
'SHOW_BIRTHDAYS'						=> 'Show Birthdays in main calendar view?',
'SHOW_UPCOMING_BIRTHDAYS'				=> 'Show List Of Upcoming Birthdays?',
'SHOW_UPCOMING_EVENTS'					=> 'Show List Of Upcoming Events?',
'UPCOMING_EVENTS_DAYS'					=> 'Upcoming Events (Number Of Days To Show - Max: %s)',
'UPCOMING_BIRTHDAYS_DAYS'				=> 'Upcoming Birthdays (Number Of Days To Show - Max: %s)',
'CALENDAR_NOTES'            			=> 'Additional notes about the calendar',
'HAS_ASSOCIATED_EVENT'      			=> 'This topic has an event associated with it',
'GO_TO_EVENT'               			=> '...View in calendar context',
'MORE_EVENTS'               			=> 'More events...',
'BIRTHDAYS'                 			=> 'Birthdays...',
'UPCOMING_BIRTHDAYS'        			=> 'Upcoming Birthdays',
'UPCOMING_EVENTS'       				=> 'Upcoming Events',
'NO_UPCOMING_BIRTHDAYS'     			=> 'No birthdays this month',
'NO_UPCOMING_EVENTS'        			=> 'No upcoming events',
'NO_EVENTS_TODAY'						=> 'No events today',
'NO_REPEATS_FOUND'						=> 'No repeated instances were found for this event',
'ON'                     				=> 'on',
'AT'                     				=> 'at',
'UPCOMING_EVENTS_TIME_FRAME'			=> ' (Within next %s days)',

'CALENDAR_EXPORT'						=> 'Export Calendar',
'CALENDAR_EXPORT_ICAL'					=> 'Export as ICAL',
'CALENDAR_EXPORT_ICAL_EXPLAIN'			=> 'Export Calendar in .ical format',
'CALENDAR_EXPORT_CSV'					=> 'Export as CSV',
'CALENDAR_EXPORT_CSV_EXPLAIN'			=> 'Export Calendar in .csv format',
'CALENDAR_PUBLISH_RSS'					=> 'Publish as RSS',
'CALENDAR_PUBLISH_RSS_EXPLAIN'			=> 'Publish Calendar in RSS format',
'CALENDAR_SUBSCRIBE_PRIV_CAL'			=> 'Subscribe To Private RSS',
'CALENDAR_SUBSCRIBE_PRIV_CAL_EXPLAIN'	=> 'Subscribe to your private calendar RSS feed',
'CALENDAR_SUBSCRIBE_PUBLIC_CAL'			=> 'Subscribe To Public RSS',
'CALENDAR_SUBSCRIBE_PUBLIC_CAL_EXPLAIN'	=> 'Subscribe to public calendar RSS feed',

'CALENDAR_INVITE_ATTENDEES'				=> 'Invite Attendees?',
'CALENDAR_SIGN_UP_INVITATION'			=> 'You are invited to attend or participate in this event',
'CALENDAR_SIGN_UP_ACCEPT'				=> 'ACCEPT',
'CALENDAR_SIGN_UP_DECLINE'				=> 'DECLINE',
'CALENDAR_SIGN_UP_CONFIRM'				=> 'Are you sure you wish to sign up for this event?',
'CALENDAR_SIGN_DOWN_CONFIRM'			=> 'Are you sure you wish to decline signing up for this event?',
'CALENDAR_SIGNED_UP'					=> 'You Are Signed Up For This Event ',
'CALENDAR_SIGNED_DOWN'					=> 'You Have Specified That You Will Not Attend This Event ',
'CALENDAR_SIGN_UP_SUCCESS'				=> 'You have successfully submitted your attendance status for this event',
'CALENDAR_RETRACT_SIGN_UP_SUCCESS'		=> 'You have successfully retracted your attendance status for this event',
'CALENDAR_UN_SIGN_UP'					=> 'UNREGISTER',
'CALENDAR_UN_SIGN_UP_CONFIRM'			=> 'Are you sure you want to unregister for this event?',
'CALENDAR_EVENT_MEMBERS_SIGNED'			=> 'Members signed up for this event',
'CALENDAR_EVENT_MEMBERS_SIGNED_NONE'	=> 'No members have signed up for this event',
'CALENDAR_EVENT_MEMBERS_NOT_SIGNED'		=> 'Members who will not be attending this event',
'CALENDAR_EVENT_MEMBERS_NOT_SIGNED_NONE'=> 'No members have specified that they will not attend this event',
'CALENDAR'	=> 'Calendar',

));

