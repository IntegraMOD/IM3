<?php

/** 
*
* @mod package		Meeting MOD
* @file				meeting.php 10 2014/02/26 OXPUS
* @copyright		(c) 2009 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

// [ english ] Language Pack for Meeting MOD

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

$lang = array_merge($lang, array(

// Version
	'MEETING_VERSION'			=> 'Meeting MOD &copy; 2009, 2010, 2011, 2012 <a href="http://www.oxpus.net">OXPUS</a>',

// Administration
	'MEETING_ADMIN'				=> 'Meeting',
	'MEETING_ADD_NEW'			=> 'Add new meeting',
	'MEETING_MANAGE'			=> 'Manage meetings',
	'MEETING_MANAGE_EXPLAIN'	=> 'From here you can manage all saved meetings. You can edit or delete them.',
	'MEETING_DELETE'			=> 'Delete a meeting?',
	'MEETING_DELETE_EXPLAIN'	=> 'Are you sure to delete this meeting?',
	'MEETING_ADD'				=> 'Add new meeting',
	'MEETING_EDIT'				=> 'Edit meeting',

// Configuration
	'MEETING_CONFIG'								=> 'Meeting Configuration',
	'MEETING_CONFIG_EXPLAIN'						=> 'From here you can manage all basic settings for meetings on your board.',
	'MEETING_CONFIG_UPDATED'						=> 'Meeting Configuration successfull updated',
	'CLICK_RETURN_MEETING_CONFIG'					=> '%sClick here to return to the Meeting Configuration%s',
	'USER_ALLOW_ENTER_MEETING'						=> 'Allow users to create meetings',
	'USER_ALLOW_ENTER_MEETING_EXPLAIN'				=> 'If you will set here YES, each user can create meetings. Say NO here to enable this only on ACP by an Admin. GROUPS will enable this to users who are a member of minimum one of the following groups.',
	'USER_ALLOW_EDIT_MEETING'						=> 'Allow users to edit meetings',
	'USER_ALLOW_EDIT_MEETING_EXPLAIN'				=> 'If you will set here YES, each user can edit meetings. Say NO here to enable this only on ACP by an Admin.',
	'USER_ALLOW_DELETE_MEETING'						=> 'Allow Users to delete their Meetings',
	'USER_ALLOW_DELETE_MEETING_EXPLAIN'				=> 'If you say YES here, each user can delete his own meeting. Say NO here to disable this option.',
	'USER_ALLOW_DELETE_MEETING_COMMENTS'			=> 'Allow Users to delete their Meeting Comments',
	'USER_ALLOW_DELETE_MEETING_COMMENTS_EXPLAIN'	=> 'If you say YES here, each user can delete his own meeting comments. Say NO here fo disable this option.',
	'MEETING_NOTIFY'								=> 'Enable email notification for user sign on/off',
	'MEETING_NOTIFY_EXPLAIN'						=> 'Enable the notifications to the board email adress, if a user will sign of/off a meeting or changing the promise',
	'MEETING_SIGN_OTHER_PERM'						=> 'Sign on/off other user',
	'MEETING_SIGN_OTHER_PERM_EXPLAIN'				=> 'Defines which user will be able to sign on/off other users to/from a meeting.<br />Board founder can still sign on/off other user. They will not be affected by this settings.',
	'MEETING_SIGN_OTHER_P1'							=> 'Founder',
	'MEETING_SIGN_OTHER_P2'							=> 'Founder, Administrators',
	'MEETING_SIGN_OTHER_P3'							=> 'Founder, Administrators, Moderators',
	'MEETING_SIGN_OTHER_P4'							=> 'Founder, Administrators, Moderators, Meeting Authors',

// Forum part
	'CLICKMEETINGBACK'						=> '%sClick here to return to the meeting list%s',
	'MEETING'								=> 'Meeting Management',
	'MEETING_UNTIL'							=> 'Peroid for registration',
	'MEETING_LOCATION'						=> 'Location',
	'MEETING_SUBJECT'						=> 'Title',
	'MEETING_CLOSED'						=> 'Closed',
	'NO_MEETING'							=> 'No meeting found',
	'MEETING_NO_PERIOD'						=> 'Period for registration is over',
	'MEETING_DESC'							=> 'Description',
	'MEETING_LINK'							=> 'Link',
	'MEETING_PLACES'						=> 'Maximum count of places',
	'MEETING_USERGROUP'						=> 'Usergroups',
	'MEETING_FILTER'						=> 'Filter by field',
	'MEETING_ALL'							=> 'Every status',
	'MEETING_OPEN'							=> 'Active',
	'MEETING_SIGN_ON'						=> 'Sign on the meeting with',
	'MEETING_SIGN_EDIT'						=> 'Change promise to',
	'MEETING_SIGN_OFF'						=> 'Sign off the meeting',
	'MEETING_SIGN_OFF_EXPLAIN'				=> 'Are you sure to sign off this meeting?',
	'MEETING_DETAIL'						=> 'Meeting details',
	'MEETING_VIEWLIST'						=> 'Meetinglist',
	'MEETING_USERLIST'						=> 'Signed on user',
	'MEETING_USER_JOINS'					=> 'registered people',
	'MEETING_NO_USER'						=> 'Currently no signed on user',
	'MEETING_FREE_PLACES'					=> 'Total free places',
	'MEETING_SURE_TOTAL'					=> 'Currently signed on user in per cent',
	'MEETING_SURE_TOTAL_USER'				=> 'Current user promises in per cent',
	'MEETING_STATISTIC'						=> 'Statistics',
	'MEETING_COMMENTS'						=> 'Comments about this meeting',
	'MEETING_COMMENT'						=> 'User comment',
	'MEETING_COMMENT_HINT'					=> 'Your comment must first be approved after posting!',
	'MEETING_ENTER_COMMENT'					=> 'Enter a comment',
	'NO_ACTIVE_MEETINGS'					=> '<span class="badge text-bg-light rounded-pill align-text-bottom"><strong>0</strong></span> Meetings',
	'ONE_ACTIVE_MEETING'					=> '<span class="badge text-bg-light rounded-pill align-text-bottom"><strong>1</strong></span> planned meeting',
	'ACTIVE_MEETINGS'						=> '<span class="badge text-bg-light rounded-pill align-text-bottom"><strong> %s </strong></span> planned meetings',
	'MEETING_CREATE_BY'						=> 'Created by <a href="%s" class="genmed">%s</a>',
	'MEETING_EDIT_BY'						=> 'Last edited by <a href="%s" class="genmed">%s</a>',
	'MEETING_START_VALUE'					=> 'Start value for assign drop down',
	'MEETING_RECURE_VALUE'					=> 'Intervall for this drop down',
	'MEETING_UNWILL_MESSAGE'				=> 'A user will not visit a meeting',
	'MEETING_UNWILL_USER'					=> 'User %s will not visit the meeting %s.',
	'MEETING_UNJOIN_MESSAGE'				=> 'A user have unjoined a meeting',
	'MEETING_UNJOIN_USER'					=> 'User %s have unjoined from meeting %s.',
	'MEETING_JOIN_MESSAGE'					=> 'A user have joined a meeting',
	'MEETING_JOIN_USER'						=> 'User %s have joined to meeting %s.',
	'MEETING_CHANGE_MESSAGE'				=> 'A user have changed the sign on to a meeting',
	'MEETING_CHANGE_USER'					=> 'User %s have changed the sign on to meeting %s.',
	'MEETING_SIGNONS'						=> 'Your signons',
	'MEETING_GUEST_OVERALL'					=> 'Overall number of guests all user can max. invite',
	'MEETING_GUEST_SINGLE'					=> 'Number of guests a user can max. invite',
	'MEETING_REMAIN_GUEST_TEXT'				=> 'You have invited %s guests, but currently there are only %s places free.<br />Please go back and invite less people.',
	'MEETING_USER_GUEST'					=> ' + one guest',
	'MEETING_USER_GUESTS'					=> ' + %s guests',
	'MEETING_USER_GUEST_POPUP'				=> ' + <a href="javascript:void(0)" onclick="openguestpopup(%s, %s);">one guest</a>',
	'MEETING_USER_GUESTS_POPUP'				=> ' + <a href="javascript:void(0)" onclick="openguestpopup(%s, %s);">%s guests</a>',
	'MEETING_GUESTS'						=> 'Guests',
	'MEETING_OWM_GUESTS'					=> 'Your guests',
	'MEETING_PRENAMES'						=> 'Prenames',
	'MEETING_NAMES'							=> 'Names',
	'MEETING_INVITE_GUESTS'					=> ' with ',
	'MEETING_OVERALL_GUEST_PLACES'			=> ' + overall %s guests',
	'MEETING_OVERALL_GUEST_PLACES_ONE'		=> ' + overall one guest',
	'MEETING_SINGLE_GUEST_PLACES'			=> ' (nax. %s guests each user)',
	'MEETING_SINGLE_GUEST_PLACES_ONE'		=> ' (max. one guest each user)',
	'MEETING_REMAIN_GUEST_PLACES'			=> '. You can invite %s guests.',
	'MEETING_REMAIN_GUEST_PLACES_ONE'		=> '. You can invite one guest.',
	'MEETING_NO_GUEST_LIMIT'				=> 'Enter 0 to disable this limit',
	'MEETING_ALL_USERS'						=> 'All User',
	'MEETING_GROUP_CREATE'					=> 'Usergroup(s) for edits',
	'MEETING_GROUP_CREATE_EXPLAIN'			=> 'Members of these usergroups can add a meeting if the previous option enables this',
	'MEETING_GROUP_SELECT'					=> 'Usergroup(s) for selects',
	'MEETING_GROUP_SELECT_EXPLAIN'			=> 'These usergroups can be used on edit a meeting',
	'MEETING_NO_SIGNON'						=> 'Refusal',
	'MEETING_NO_SIGNONS'					=> 'Refusals',
	'MEETING_MAYBE_SIGNONS'					=> 'Other',
	'MEETING_YES_SIGNON'					=> 'Promise',
	'MEETING_YES_SIGNONS'					=> 'Promises ',
	'MEETING_INTERVALL_EXPLAIN'				=> 'Use 0/100 to let the users just refuse or promise a meeting',
	'MEETING_ONLY_REGISTERED'				=> 'Only for registered users!',
	'MEETING_GUEST_NAMES'					=> 'User must enter the names of invited guests',
	'MEETING_GUEST_NAMES_EXPLAIN'			=> 'This option will replace the drop down for the number of invited guests into a form to enter the guest names.<br />The user will invite the number of guests he enters in the new form; based on the maximum allowed number of guests.',
	'MEETING_GUESTNAME_ENTERING_EXPLAIN'	=> 'Enter here the name of your guests.<br />Be sure you enter the prename <b>and</b> the name of your guests.<br />To sign off a guest, delete the row and submit the form.',
	'MEETING_TIMEFORMAT'					=> 'yyyy-mm-dd hh:ss',
	'MEETING_TIME'							=> 'Time',
	'MEETING_TIME_END'						=> 'Time until',
	'MEETING_SORT'							=> 'Sort on',
	'MEETING_ORDER'							=> 'Ordering',
	'MEETING_SORT_ASC'						=> 'ascending',
	'MEETING_SORT_DESC'						=> 'descending',
	'MEETING_TIME_WRONG'					=> 'The entered meeting time is not valid!<br />Please go back and check your entry.',
	'MEETING_END_WRONG'						=> 'The entered meeting until time is not valid!<br />Please go back and check your entry.',
	'MEETING_UNTIL_WRONG'					=> 'The entered period of registration is not valid!<br />Please go back and check your entry.',
	'MEETING_DATA_UPDATED'					=> 'The meeting was successfully updated.',
	'MEETING_DATA_STORED'					=> 'The meeting was successfully stored.',
	'MEETING_CLOSE_STATUS'					=> 'Status',
	'MEETING_TIMEZONE_HINT'					=> 'All meeting times bases on the local timecode of the meeting location!',
	'MEETING_POST_COMMENT'					=> 'Post a comment',
	'MEETING_EDIT_COMMENT'					=> 'Edit a comment',
	'MEETING_UNAPPROVED_COMMENTS'			=> 'Just the meetings with unapproved comments',
	'MEETING_ALL_GROUPS'					=> 'All Groups',

// Email functions
	'MEETING_MAIL'			=> 'Send email to all registered people',
	'MEETING_MAIL_SUBJECT'	=> 'Email subject',
	'MEETING_MAIL_TEXT'		=> 'Email message',
	'MEETING_MAIL_TO'		=> 'Send email to',
	'MEETING_MAIL_ALL'		=> 'all registered people',
	'MEETING_MAIL_SIGN_YES'	=> 'only promised people',
	'MEETING_MAIL_SIGN_NO'	=> 'only not promised people',

// Log functions
	'MEETING_LOG_CONFIG'	=> '<strong>General configuration of meeting management changed</strong>',
	'MEETING_LOG_ADD'		=> '<strong>Meeting added</strong> &raquo; %s', 
	'MEETING_LOG_EDIT'		=> '<strong>Metting updated</strong> &raquo; %s', 
	'MEETING_LOG_DELETE'	=> '<strong>Meeting deleted</strong> &raquo; %s',

// Calendar strings
	'MEETING_CALENDAR'		=> 'Meeting Calendar',
	'MEETING_FIRST_WEEKDAY'	=> 'First day of a week',
	'MEETING_CAL_MONDAY'	=> 'Monday',
	'MEETING_CAL_SUNDAY'	=> 'Sunday',
	'MEETING_CAL_DAY'		=> array(
								0 => 'Sunday',
								1 => 'Monday',
								2 => 'Tuesday',
								3 => 'Wednesday',
								4 => 'Thursday',
								5 => 'Friday',
								6 => 'Saturday',
	),
	'MEETING_MONTH_TEXT'	=> array(
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

));

?>