<?php
/**
*
* @package calendar
* @version $Id: calendar.php 2008-07-10 21:16:00Z livewirestu and NeXur $
* @copyright (c) 2008 phpbbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Description: Main file for event and topic calendar mod.
* Notes: This project was started after the calendar project by John Cottage (jcc264) on phpbb.com went stale
*		It has since been completely overhauled, although still contains some small sections of John's original code
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
// Note the '1' forces the calendar to be loaded with prosilver - This can be removed when we have templates for subsilver
$user->setup(array('posting', 'mods/calendar'));
// Note this file is included after user->setup(), to ensure that some globals in functions_calendar.php can
// find the $user->lang array
include($phpbb_root_path . 'includes/functions_calendar.' . $phpEx);
$user_id = $user->data['user_id'];

// Permissions
$over_ride = (($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_'))) ? 1 : 0;

$can_view = ($auth->acl_get('u_view_event') || $over_ride);
$can_post_new = ($auth->acl_get('u_new_event') || $over_ride);
$can_edit_self = ($auth->acl_get('u_edit_event') || $over_ride);
$can_delete_self = ($auth->acl_get('u_delete_event') || $over_ride);

$can_edit_others = $auth->acl_get('m_edit_event') || $auth->acl_get('a_edit_event');
$can_delete_others = $auth->acl_get('m_delete_event') || $auth->acl_get('a_delete_event');
$can_publish_rss = $auth->acl_get('a_publish_rss');


// For selecting members for private events
$select_single = ($config['allow_mass_pm'] && $auth->acl_get('u_masspm')) ? false : true;

$mode = request_var('mode', 'main');

if (request_var('submit_settings', '') == 'Submit')
{
	$submit_settings = true;
	$mode = 'settings';
}

$submit = isset($_POST['post']) ? true : false;

// Check authorisation here before running any real code
// Kill unauthorised viewing, posting or editing attempts
$authed = true;
if (!$can_view)
{
	$authed = false;
}
switch($mode)
{
	case 'new':
		if (!$can_post_new)
			$authed = false;
	break;

	case 'main':
		if (!$can_view)
			$authed = false;
	break;

	case 'edit':
		if (!$can_edit_others || (!$can_edit_self && $poster_id == $user_id))
			$authed = false;
	break;

	default:
	break;

	// Note: delete auth is handled later
}

if (!$authed)
{
	$message = $user->lang['NO_AUTH_OPERATION'] . '<br /><br />' . sprintf($user->lang['RETURN_INDEX'], '<a href="' . $phpbb_root_path . '">', '</a>');
	$meta_url = append_sid("{$phpbb_root_path}index.$phpEx");
	meta_refresh(3, $meta_url);
	trigger_error($message, E_USER_WARNING);
}


// Lets set up some global variables
// Global configuration data
$smilies_status = ($config['allow_smilies']) ? true : false;
$bbcode_status = ($config['allow_bbcode']) ? true : false;
$url_status = ($config['allow_post_links']) ? true : false;

// Checkboxes default status
$smilies_checked = false;
$bbcode_checked = false;
$urls_checked = false;

$message = '';

$current_time = time();
$lastclick = request_var('lastclick', 0);
$cancel = isset($_POST['cancel']) ? true : false;

// Was cancel pressed? If so then redirect to the appropriate page
if ($cancel || ($current_time - $lastclick < 2 && $submit))
{
	$redir_month = request_var('redir_month', '');
	$redir_year = request_var('redir_year', '');
	if (!empty($redir_month) && !empty($redir_year))
	{
		$redirect = append_sid("{$phpbb_root_path}calendar.$phpEx", "mode=main&amp;month=$redir_month&amp;year=$redir_year");
	}
	else
	{
		$redirect = append_sid("{$phpbb_root_path}calendar.$phpEx", "mode=main");
	}
	redirect($redirect);
}

// Here we are retrieving data from the template and deciding what to do with it
if (isset($_POST['post']) || $mode == 'main' || $mode == 'new' || $mode == 'edit')
{
	if (isset($_POST['post']))
	{
		// Note that not all data here is neccessarily in a state ready to be committed to the db
		// Note also that commented lines are shown here to indicate entire structure of $event_data array
		// The additional keys are only unset when we commit the data to the db

		$event_data = array(
			'user_id'			 => request_var('user_id', $user->data['user_id']),
			'event_name'			=> utf8_normalize_nfc(request_var('name','', true)),
			'event_desc'			=> utf8_normalize_nfc(request_var('message', '', true)),
			'event_groups'		=> request_var('group', array('' => 0)),
			'group_cats'			=> request_var('group_select', EVENT_VIEW_BY_PUBLIC),
			'priv_users'			=> request_var('username_list', ''),
			'invite_attendees'	=> request_var('invite_attendees', 0),
			// 'event_attendees'	 is not modified here
			// 'event_non_attendees'  is not modified here
			'enable_bbcode'		=> (!$bbcode_status || isset($_POST['disable_bbcode'])) ? false : true,
			'enable_smilies'		=> (!$smilies_status || isset($_POST['disable_smilies'])) ? false : true,
			'enable_magic_url'	=> (isset($_POST['disable_magic_url'])) ? 0 : 1,
			// 'bbcode_uid'			is not modified here
			// 'bbcode_bitfield'	 is not modified here
			'event_start_time'	=> request_var('time', ''),				// Unset later
			'event_start_date'	=> request_var('date', ''),				// Unset later
			'event_end_time'		=> request_var('end_time', ''),			// Unset later
			'event_end_date'		=> request_var('end_date', ''),			// Unset later
			// 'event_start'		 this is calculated from event_start_time and event_start_date later on
			// 'event_end'			this is calculated from event_end_time and event_end_date later on
			'event_repeat'		=> request_var('event_repeat', 0),		// Unset later
			'event_repeat_count'	=> request_var('event_repeat_count', ''),  // Unset later
			'event_repeat_when'	=> request_var('event_repeat_when', ''),	// Unset later
			'repeat_nth_pos'		=> request_var('nth_day_position', ''),	// Unset later
			'repeat_nth_weekday'	=> request_var('nth_weekday', ''),		// Unset later
			'repeat_nth_count'	=> request_var('nth_count', ''),			// Unset later
			'nth_month_position'	=> request_var('nth_month_position', ''),  // Unset later
			'nth_month_weekday'	=> request_var('nth_month_weekday', ''),	// Unset later
			'nth_month_month'	 => request_var('nth_month_month', ''),	// Unset later

		);

		if ($mode == 'edit')
		{
			// We need the event_id to update the event
			$event_data['event_id'] = request_var('event_id', 0);
		}
		if ($mode == 'new')
		{
			$event_data['event_attendees'] = '';
			$event_data['event_non_attendees'] = '';
		}
	}

	// Not submitting data, therefore we must be loading data for an existing event for editing.
	else if ($mode == 'edit')
	{
		$event_id = request_var('event_id', '');
		$sql = 'SELECT * FROM ' . CALENDAR_TABLE . "
			WHERE event_id = $event_id";
		$result = $db->sql_query($sql);
		$event_data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		// Now we need to unpack some variables.
		$event_data['event_groups'] = explode(';', $event_data['event_groups']);
		list($event_data['event_start_date'], $event_data['event_start_time']) = explode('|', gmdate('m-d-Y|h:i a', ($event_data['event_start'] + $user->timezone + $user->dst)));
		list($event_data['event_end_date'], $event_data['event_end_time']) = explode('|', gmdate('m-d-Y|h:i a', ($event_data['event_end'] + $user->timezone + $user->dst)));
		if (!empty($event_data['event_repeat']))
		{
			extract_repeat_params($event_data['event_repeat'], $event_data);
		}
	}

	if (!empty($event_data) && isset($_POST['post']))
	{
		$misc_errors = validate_misc_event_data($event_data);
		if (sizeof($misc_errors))
		{
			$error = $misc_errors;
		}

		//$error = validate_event_data($event_data, 'standard_event');
		$times = validate_event_times(true, $event_data);

		if ($times['valid'] == true)
		{
			if (!empty($event_data['event_repeat']))
			{
				$repeat_params = validate_repeat_params(true, true, $event_data);
				if ($repeat_params['valid'] == true)
				{
					$repeat_info = generate_repeat_event_info(0, $times['start'], $times['end'], $repeat_params['repeat_code']);
					$return_array['data'] = $repeat_info['list'];
				}
				else
				{
					$error = $repeat_params['error'];
				}
			}
		}
		else
		{
			$error = $times['error'];
		}

		if ($mode != 'edit')
		{
			// Get the next available event_id. Note we don't use auto increment on event_id, so we can
			// more easily extract the new event_id and pass it to the repeat event handler (if there are repeats)
			$sql = 'SELECT event_id
				FROM ' . CALENDAR_TABLE . '
				ORDER BY event_id DESC
				LIMIT 1';
			$result = $db->sql_query($sql);
			if ($row = $db->sql_fetchrow($result))
			{
				$event_data['event_id'] = ($row['event_id'] + 1);
			}
			else
			{
				$event_data['event_id'] = 1;
			}
			$db->sql_freeresult($result);
		}

		if (empty($error))
		{
			$event_data['event_start'] = str_to_unix($event_data['event_start_time'], $event_data['event_start_date']);
			$event_data['event_end'] = str_to_unix($event_data['event_end_time'], $event_data['event_end_date']);

			// Are we adding repeat events too?
			if (!empty($event_data['event_repeat']))
			{
				// construct the code for repeat events
				$event_data['event_repeat'] = $event_data['event_repeat_when'] . str_pad($event_data['event_repeat_count'], 2, '0', STR_PAD_LEFT);

				// We have already determined there are no errors, so we can just append stuff straight onto the repeat code
				switch($event_data['event_repeat_when'])
				{
					case 'WM': // nth weekday every n months
						$event_data['event_repeat'] .= $event_data['repeat_nth_pos'] . $event_data['repeat_nth_weekday'] . str_pad($event_data['repeat_nth_count'], 2, '0', STR_PAD_LEFT);
					break;

					case 'WY': // nth weekday of nth month every year
						$event_data['event_repeat'] .= $event_data['nth_month_position'] . $event_data['nth_month_weekday'] . $event_data['nth_month_month'] . ' ';
					break;

					default:	// DD, WW, MM or YY
					break;
				}
				$event_info = generate_repeat_event_info($event_data['event_id'], $event_data['event_start'], $event_data['event_end'], $event_data['event_repeat']);
			}
			else
			{
				$event_info = array(
					'details'  => $user->lang['SINGLE_EVENT'],
					'list'	=> str_replace(' ', '&nbsp;', sprintf("%-23s", $user->lang['INITIAL_EVENT'] . ':')) . $user->lang['CALENDAR_EVENT_START'] . ': ' . gmdate('m/d/Y, H:i:s', $event_data['event_start']) . ' - ' . $user->lang['CALENDAR_EVENT_END'] . ': ' . gmdate('m/d/Y, H:i:s', ($event_data['event_start'] + ($event_data['event_end'] - $event_data['event_start']))) . '<br />',
				);
			}
			// If the data is error free, shove it all in the db
			// Note we should only be able to get here if there are no errors in the event data
			// Ensure everything is prepared for the db
			// Timezone alteration - convert to GMT time
			$event_data['event_start'] -= ($user->timezone + $user->dst);
			$event_data['event_end'] -= ($user->timezone + $user->dst);

			$event_data['bbcode_bitfield'] = $options = $event_data['bbcode_uid'] = ''; // will be modified by generate_text_for_storage
			generate_text_for_storage($event_data['event_desc'], $event_data['bbcode_uid'], $event_data['bbcode_bitfield'], $options, $event_data['enable_bbcode'], $event_data['enable_magic_url'], $event_data['enable_smilies']);

			$event_data['event_groups'] = implode(';', $event_data['event_groups']);

			// Remove all unwanted keys before committing to db
			unset($event_data['event_start_time'], $event_data['event_start_date'], $event_data['event_end_time'], $event_data['event_end_date']);
			unset($event_data['event_repeat_count'], $event_data['event_repeat_when']);
			unset($event_data['repeat_nth_pos'], $event_data['repeat_nth_weekday'], $event_data['repeat_nth_count']);
			unset($event_data['nth_month_position'], $event_data['nth_month_weekday'], $event_data['nth_month_month']);
			unset($event_data['priv_user_list']);

			if ($mode == 'main' || $mode == 'new')
			{
				$message = $user->lang['CALENDAR_EVENT_ADDED'];
				// If it is not a repeat, let the sql auto increment handle the event_id assignment
				$sql = 'INSERT INTO ' . CALENDAR_TABLE . ' ' . $db->sql_build_array('INSERT', $event_data);
			}
			else if ($mode == 'edit')
			{
				$sql = 'UPDATE ' . CALENDAR_TABLE . '
					SET ' . $db->sql_build_array('UPDATE', $event_data) . '
					WHERE event_id = ' . $event_data['event_id'];

				if (!empty($event_data['event_repeat']))
				{
					$message = $user->lang['CALENDAR_EVENT_EDITED'];
				}
			}
			else
			{
				// Something bad happened
			}
			$db->sql_query($sql);

			// Are we adding repeat events too?
			if (!empty($event_data['event_repeat']))
			{
				$event_info = generate_repeat_event_info($event_data['event_id'], $event_data['event_start'], $event_data['event_end'], $event_data['event_repeat']);
				if ($mode == 'edit' || $mode == 'main' || $mode == 'new')
				{
					put_repeat_events($mode, $event_data);
				}
			}

			// Extract the month, day and year so we can view the event we just posted
			list($m, $d, $y) = explode('/', gmdate('m/d/Y', ($event_data['event_start'] + $user->timezone + $user->dst)));
			// if all went well, let the user know, then redirect
			$message .= '<br />' . $event_info['details'] . '<br />' . $event_info['list'];
			$meta_url = append_sid("{$phpbb_root_path}calendar.$phpEx", "mode=view&amp;month=$m&amp;day=$d&amp;year=$y");
			meta_refresh(3, $meta_url);	// This is our exit point when everything is happy
			trigger_error($message);
		}

		else if (isset($_POST['cancel']))
		{
			// User changed their mind? Send them back to the event submission page, populated with the info they entered

		}
	}
}



/******************* Choose what we output to the template *********************************/
// Viewing main calendar, viewing events, editing event, creating new event or deleting event
switch($mode)
{
	case 'main':
	case 'new':
	case 'edit':

		// Generation of the main calendar view tab is always the same
		build_calendar_panel();
		// Events and birthdays list panel has been seperated for readability and structure.
		// this also enables the list to be easily generated on the index page in the future.
		events_bdays_panel();

	/******* BEGIN Stuff which applies to all conditions ********/

		// If this is a new post, you started the topic - Else get the original posters usergroup memberships
		// This way, if someone edits an event that they did not create, the event will not be seen by people
		// within groups that the original poster could not make it available to.
		// TODO - Not sure about poster_id being here
		$poster_id = (isset($event_data['user_id']) ? $event_data['user_id'] : $user_id);
		$user_groups = get_users_groups($poster_id);

		// Generate drop down list values from 1-99 for repeat events
		for($i = 1 ; $i <= 99 ; $i++)
		{
			$template->assign_block_vars('repeat_count_options', array(
				'COUNT_VAL'		=> str_pad($i, 2, '0', STR_PAD_LEFT),
			));
		}
		// Array of options for repeat events period
		$repeat_opt_list = array(
			'DD'	=> $user->lang['PERIOD_DAYS'],
			'WW'	=> $user->lang['PERIOD_WEEKS'],
			'MM'	=> $user->lang['PERIOD_MONTHS'],
			'YY'	=> $user->lang['PERIOD_YEARS'],
			'WM'	=> $user->lang['PERIOD_WEEKDAY_MONTH'],
			'WY'	=> $user->lang['PERIOD_WEEKDAY_MONTH_YEAR'],
		);
		// Generate drop down list of event repeat period options
		if (isset($repeat_opt_list))
		{
			foreach ($repeat_opt_list as $key => $opt)
			{
				$template->assign_block_vars('repeat_period_options', array(
					'REPEAT_OPT_CODE'  => $key,
					'REPEAT_OPT'		=> $opt,
			));
		}
	}

		// Generate drop down lists for "nth weekday every n months" options
		// Position

		if (isset($nth_position_list))
		{
			foreach ($nth_position_list as $key => $opt)
			{
				$template->assign_block_vars('repeat_nth_position_options', array(
					'POSITION_CODE'	=> $key,
					'POSITION_NAME'	=> $opt,
				));
			}
		}

		if (isset($weekday_list))
		{
			foreach ($weekday_list as $key => $opt)
			{
				$template->assign_block_vars('repeat_nth_day_options', array(
					'DAY_CODE'	=> $key,
					'DAY_NAME'	=> $opt,
				));
			}
		}

		// Count (i.e., every 1?, 2?, 3? ... months). Only go to 11 cuz 12 could be done with every year option
		for($i = 1 ; $i <= 11 ; $i++)
		{
			$template->assign_block_vars('repeat_nth_count_options', array(
				'COUNT'	=> str_pad($i, 2, '0', STR_PAD_LEFT),
			));
		}

		// Generate dropdown list of months for 'nth weekday of nth month every year' option
		// (other fields shared from 'nth weekday every n months' options
		if (isset($month_list))
		{
 			foreach ($month_list as $key => $opt)
			{
				$template->assign_block_vars('repeat_nth_month_options', array(
					'MONTH_CODE'	=> $key,
					'MONTH_NAME'	=> $opt,
				));
			}
 		}

		if ($smilies_status)
		{
			generate_smilies('inline', 1);
		}

		// This is always required
		$template->assign_vars(array(
			'NUM_GROUPS'				=> sizeof($user_groups),
			'S_SMILIES_ALLOWED'		=> $smilies_status,
			'S_BBCODE_ALLOWED'		=> $bbcode_status,
			'S_LINKS_ALLOWED'		 => $url_status,
			'SMILIES_STATUS'			=> ($smilies_status) ? $user->lang['SMILIES_ARE_ON'] : $user->lang['SMILIES_ARE_OFF'],
			'BBCODE_STATUS'			=> ($bbcode_status) ? sprintf($user->lang['BBCODE_IS_ON'], '<a href="' . append_sid("{$phpbb_root_path}faq.$phpEx", 'mode=bbcode') . '">', '</a>') : sprintf($user->lang['BBCODE_IS_OFF'], '<a href="' . append_sid("{$phpbb_root_path}faq.$phpEx", 'mode=bbcode') . '">', '</a>'),
			'URL_STATUS'				=> ($url_status) ? $user->lang['URL_IS_ON'] : $user->lang['URL_IS_OFF'],
			'U_FIND_USERNAME'		 => append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=searchuser&amp;form=postform&amp;field=username_list&amp;select_single=$select_single"),
			'S_PUBLIC_CHECKED'		=> 'true',
			'EVENT_VIEW_BY_PUBLIC'	=> EVENT_VIEW_BY_PUBLIC,
			'EVENT_VIEW_BY_PRIVATE'	=> EVENT_VIEW_BY_PRIVATE,
			'EVENT_VIEW_BY_GROUPS'	=> EVENT_VIEW_BY_GROUPS,
			'L_UPCOMING_EVENTS_DAYS'	=> sprintf($user->lang['UPCOMING_EVENTS_DAYS'], $config['calendar_max_events_list_days']),
			'EVENTS_LIST_MAX_DAYS'	=> $config['calendar_max_events_list_days'],
			'L_UPCOMING_BIRTHDAYS_DAYS' => sprintf($user->lang['UPCOMING_BIRTHDAYS_DAYS'], $config['calendar_max_bdays_list_days']),
			'BDAYS_LIST_MAX_DAYS'	 => $config['calendar_max_bdays_list_days'],
			'S_OVERRIDE_USER'		 => $config['calendar_override_user'],
			'U_ADD_EDIT_TAB'			=> $user->lang['CALENDAR_ADD_EVENT'],
			'U_ICAL_LINK'			 => append_sid($phpbb_root_path . 'sgpical.' . $phpEx),
			'U_CSV_LINK'				=> append_sid($phpbb_root_path . 'csv.' . $phpEx),
			'U_SUBSCRIBE_PRIV_CAL'	=> 'feed.php',
			'U_SUBSCRIBE_PUBLIC_CAL'	=> 'feed.php',
			'U_PUBLISH_RSS_CAL'		=> $can_publish_rss ? 'feed.php' : null,
			'S_POST_ACTION'			=> append_sid("{$phpbb_root_path}calendar.$phpEx", "mode=new"),
			'ACTIVE_TAB'				=> $mode == 'edit' ? 'event-panel' : 'calendar-panel',
			'S_SGP_AJAX'				=> true,
		));

		/********* END Stuff which applies to all conditions **********/

		/************* BEGIN Mode specific stuff **********************/

		if ($mode == 'main') // TODO - || $mode == 'new' ?
		{

			if (!isset($user_groups))
			{
 				foreach ($user_groups as $g_num => $g_name)
				{
					$template->assign_block_vars('group_row',array(
						'GROUP_ID'	=> $g_num,
						'GROUP_NAME'	=> ucwords(strtolower( str_replace('_', ' ',$g_name))),
					));
				}
			}

			$template->assign_vars(array(
				'S_SMILIES_CHECKED'	=> ($smilies_checked) ? ' checked="yes"' : '',
				'S_BBCODE_CHECKED'	=> ($bbcode_checked) ? ' checked="yes"' : '',
				'S_MAGIC_URL_CHECKED'  => ($urls_checked) ? ' checked="yes"' : '',
			));
		}
		else
		{
			// Only check posted groups if we are fixing errors
			if (!empty($error))
			{
				$posted_groups = $event_data['event_groups'];
				if (!isset($user_groups))
 				{
 					foreach ($user_groups as $g_num => $g_name)
					{
						$template->assign_block_vars('group_row',array(
							'GROUP_ID'	=> $g_num,
							'GROUP_NAME'	=> ucwords(strtolower( str_replace('_', ' ' ,$g_name))),
							'GROUP_SELECT' => (in_array($g_num, $posted_groups) ? 'selected' : ''),
						));
					}
				}
			}
			if ($mode == 'edit')
			{
				$event_id = $event_data['event_id'];
				$template->assign_vars(array(
					'S_POST_ACTION'	=> append_sid("{$phpbb_root_path}calendar.$phpEx", "mode=edit&amp;event_id=$event_id"),
				));

				if (empty($error))
				{
					$sql = 'SELECT * FROM ' . CALENDAR_TABLE . "
						WHERE event_id = '$event_id'";
					$result = $db->sql_query($sql);
					$event_data = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					decode_message($event_data['event_desc'], $event_data['bbcode_uid']);

					$event_groups = explode(';',$event_data['event_groups']);
					if (!isset($user_groups))
					{
						foreach($user_groups as $g_num => $g_name)
						{
							$template->assign_block_vars('group_row',array(
								'GROUP_ID'		=> $g_num,
								'GROUP_NAME'	=> ucwords(strtolower( str_replace('_', ' ' ,$g_name))),
								'GROUP_SELECT'	=> (in_array($g_num, $event_groups) ? 'selected' : ''),
							));
						}
					}

					// Convert the stored unix timestamps to readable format and split into time and date
					list($start_date, $start_time) = explode('|', gmdate('m-d-Y|h:i a', ($event_data['event_start'] + $user->timezone + $user->dst)));
					list($end_date, $end_time) = explode('|', gmdate('m-d-Y|h:i a', ($event_data['event_end'] + $user->timezone + $user->dst)));

					$rep_code_base = substr($event_data['event_repeat'], 0, 2);

					$template->assign_vars(array(
						'S_SMILIES_CHECKED'		=> ($event_data['enable_smilies']) ? '':' checked="yes"',
						'S_BBCODE_CHECKED'		=> ($event_data['enable_bbcode']) ? '':' checked="yes"',
						'S_MAGIC_URL_CHECKED'	=> ($event_data['enable_html']) ? '':' checked="yes"',
						'S_EDIT'				=> true,
						'SUBJECT'				=> $event_data['event_name'],
						'DATE_IN'				=> $start_date,
						'TIME_IN'				=> $start_time,
						'DATE_OUT'				=> $end_date,
						'TIME_OUT'				=> $end_time,
						'S_EVENT_REPEAT'						=> $event_data['event_repeat'] ? true : false,
						'REPEAT_COUNT_SELECTED'					=> !empty($event_data['event_repeat']) ? substr($event_data['event_repeat'], 2, 2) : '',
						'REPEAT_PERIOD_SELECTED'				=> !empty($event_data['event_repeat']) ? substr($event_data['event_repeat'], 0, 2) : '',
						'REPEAT_NTH_DAY_POSITION_SELECTED'		=> $rep_code_base == 'WM' ? substr($event_data['event_repeat'], 4, 1) : '',
						'REPEAT_NTH_DAY_SELECTED'				=> $rep_code_base == 'WM' ? substr($event_data['event_repeat'], 5, 1) : '',
						'REPEAT_NTH_COUNT_SELECTED'				=> $rep_code_base == 'WM' ? substr($event_data['event_repeat'], 6, 2) : '',
						'REPEAT_NTH_MONTH_POSITION_SELECTED'	=> $rep_code_base == 'WY' ? substr($event_data['event_repeat'], 4, 1) : '',
						'REPEAT_NTH_MONTH_DAY_SELECTED'			=> $rep_code_base == 'WY' ? substr($event_data['event_repeat'], 5, 1) : '',
						'REPEAT_NTH_MONTH_SELECTED'				=> $rep_code_base == 'WY' ? substr($event_data['event_repeat'], 6, 1) : '',
						'MESSAGE'				=> $event_data['event_desc'],
						'S_HIDDEN_FIELDS'		=> '<input type="hidden" name="event_id" value="' . $event_id . '">',
						'U_ADD_EDIT_TAB'		=> $user->lang['CALENDAR_EDIT_EVENT'],
						'ACTIVE_TAB'			=> 'event-panel',
						'PRIV_USER_LIST'		=> !empty($event_data['priv_users']) ? $event_data['priv_users'] : '',
						'S_PUBLIC_CHECKED'		=> $event_data['group_cats'] == EVENT_VIEW_BY_PUBLIC ? true : false,
						'S_PRIVATE_CHECKED'		=> $event_data['group_cats'] == EVENT_VIEW_BY_PRIVATE ? true : false,
						'S_GROUPS_CHECKED'		=> $event_data['group_cats'] == EVENT_VIEW_BY_GROUPS ? true : false,
						'S_INVITE_ATTENDEES'	=> $event_data['invite_attendees'],
					));
				}
			}
		}


	/****** BEGIN Stuff required if we are reloading page due to erroneous input *******/

		// If we are fixing errors for new or edited event
		if (!empty($error) && ($mode == 'edit' || $mode == 'new'))
		{
			$template->assign_vars(array(
				'EVENT_ERROR'						=> implode("<br/>", $error),
				'NUM_GROUPS'						=> sizeof($user_groups),
				'S_SMILIES_CHECKED'					=> (request_var('disable_smilies',0)) ? ' checked="yes"':'',
				'S_BBCODE_CHECKED'					=> (request_var('disable_bbcode',0)) ? ' checked="yes"':'',
				'S_MAGIC_URL_CHECKED'				=> (request_var('disable_magic_url',0)) ? ' checked="yes"':'',
				'SUBJECT'							=> $event_data['event_name'],
				'DATE_IN'							=> $event_data['event_start_date'],
				'TIME_IN'							=> $event_data['event_start_time'],
				'DATE_OUT'							=> $event_data['event_end_date'],
				'TIME_OUT'							=> $event_data['event_end_time'],
				'S_EVENT_REPEAT'					=> !empty($event_data['event_repeat']) ? true : false,
				'REPEAT_COUNT_SELECTED'				=> !empty($event_data['event_repeat_count']) ? $event_data['event_repeat_count'] : '',
				'REPEAT_PERIOD_SELECTED'			=> !empty($event_data['event_repeat_when']) ? $event_data['event_repeat_when'] : '',
				'REPEAT_NTH_DAY_POSITION_SELECTED'	=> !empty($event_data['repeat_nth_pos']) ? $event_data['repeat_nth_pos'] : '',
				'REPEAT_NTH_DAY_SELECTED'			=> !empty($event_data['repeat_nth_weekday']) ? $event_data['repeat_nth_weekday'] : '',
				'REPEAT_NTH_COUNT_SELECTED'			=> !empty($event_data['repeat_nth_count']) ? $event_data['repeat_nth_count'] : '',
				'REPEAT_NTH_MONTH_POSITION_SELECTED'	=> !empty($event_data['nth_month_position']) ? $event_data['nth_month_position'] : '',
				'REPEAT_NTH_MONTH_DAY_SELECTED'		=> !empty($event_data['nth_month_weekday']) ? $event_data['nth_month_weekday'] : '',
				'REPEAT_NTH_MONTH_SELECTED'			=> !empty($event_data['nth_month_month']) ? $event_data['nth_month_month'] : '',
				'MESSAGE'							=> $event_data['event_desc'],
				'ACTIVE_TAB'						=> 'event-panel',
				'PRIV_USER_LIST'					=> $event_data['priv_users'] ? implode("\n", $event_data['priv_user_list']) : '',
				'S_PUBLIC_CHECKED'					=> $event_data['group_cats'] == EVENT_VIEW_BY_PUBLIC ? true : false,
				'S_PRIVATE_CHECKED'					=> $event_data['group_cats'] == EVENT_VIEW_BY_PRIVATE ? true : false,
				'S_GROUPS_CHECKED'					=> $event_data['group_cats'] == EVENT_VIEW_BY_GROUPS ? true : false,
			));

			if ($mode == 'new')
			{
				$template->assign_vars(array(
					'S_POST_ACTION'		=> append_sid("{$phpbb_root_path}calendar.$phpEx", "mode=new"),
					'U_ADD_EDIT_TAB'		=> $user->lang['CALENDAR_ADD_EVENT'],
					'S_NEW'				=> true,
				));
			}

			if ($mode == 'edit')
			{
				$template->assign_vars(array(
					'S_POST_ACTION'		=> append_sid("{$phpbb_root_path}calendar.$phpEx", "mode=edit&amp;event_id=$event_id"),
					'U_ADD_EDIT_TAB'	=> $user->lang['CALENDAR_EDIT_EVENT'],
					'S_HIDDEN_FIELDS'	=> '<input type="hidden" name="event_id" value="' . $event_id . '">',
					'S_EDIT'			=> true,
				));
			}
		}
	/****** END Stuff required if we are reloading page due to erronous input *******/
	/************************* END Mode specific stuff ******************************/

		// Spit it out
		$page_title = $user->lang['CALENDAR'];
		page_header($page_title);
		$template->set_filenames(array(
			'body' => 'calendar_layout.html')
		);
		page_footer();

	break;

	case 'settings':
		if ($submit_settings)
		{
			// Feed the Cookie Monster :)
			$user->set_cookie('cal_start_day', request_var('cal_start_day', ''), time() + 31536000);
			$user->set_cookie('cal_week_nums', request_var('cal_week_nums', ''), time() + 31536000);
			$user->set_cookie('cal_birthdays', request_var('cal_birthdays', ''), time() + 31536000);
			$user->set_cookie('cal_events_list', request_var('cal_events_list', ''), time() + 31536000);
			$user->set_cookie('cal_upcoming_events_days', (int)request_var('cal_upcoming_events_days', ''), time() + 31536000);
			$user->set_cookie('cal_birthdays_list', request_var('cal_birthdays_list', ''), time() + 31536000);
			$user->set_cookie('cal_upcoming_birthdays_days', (int)request_var('cal_upcoming_birthdays_days', ''), time() + 31536000);
			$redirect = append_sid($phpbb_root_path . 'calendar.' . $phpEx . "?mode=main");
			redirect($redirect);
		}
		else
		{
			trigger_error("Something bad happened");
		}
	break;

	case 'attend':
		$opt = request_var('opt', '');
		$eid = request_var('eid', '');
		$fid = request_var('fid', '');
		$tid = request_var('tid', '');

		if (!empty($tid))
		{
			$sql = "SELECT event_attendees, event_non_attendees
				FROM " . TOPICS_TABLE . "
				WHERE topic_id = '$tid'";
		}
		else
		{
			$sql = "SELECT event_attendees, event_non_attendees, event_start
				FROM " . CALENDAR_TABLE . "
				WHERE event_id = '$eid'";
		}
		$result = $db->sql_query($sql);
		$user_list = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$attendee_list = explode(',', $user_list['event_attendees']);
		$non_attendee_list = explode(',', $user_list['event_non_attendees']);

		switch($opt)
		{
			case 'accept':
				// If we are marked as 'not attending', remove us from that list
				if (sizeof($non_attendee_list) && in_array($user->data['user_id'], $non_attendee_list))
				{

					if (isset($non_attendee_list))
					{
						foreach ($non_attendee_list as $key => $u)
						{
							if ($user->data['user_id'] == $u)
								unset($non_attendee_list[$key]);
						}
					}
				}
				$user_list['event_non_attendees'] = implode(',', $non_attendee_list);

				// If we are not already in the attendees list, add us.
				if (!in_array($user->data['user_id'], $attendee_list))
				{
					$user_list['event_attendees'] .= ($user->data['user_id'] . ',');
				}
				$message = $user->lang['CALENDAR_SIGN_UP_SUCCESS'];

			break;

			case 'decline':
				// If we are marked as 'attending', remove us from that list
				if (sizeof($attendee_list) && in_array($user->data['user_id'], $attendee_list))
				{
					foreach($attendee_list as $key => $u)
					{
						if ($user->data['user_id'] == $u)
							unset($attendee_list[$key]);
					}
				}
				$user_list['event_attendees'] = implode(',', $attendee_list);

				// If we are not already in the non_attendees list, add us.
				if (!in_array($user->data['user_id'], $non_attendee_list))
				{
					$user_list['event_non_attendees'] .= ($user->data['user_id'] . ',');
				}
				$message = $user->lang['CALENDAR_SIGN_UP_SUCCESS'];

			break;

			case 'unreg':
				// If we are marked as 'attending', remove us from that list
				if (sizeof($attendee_list) && in_array($user->data['user_id'], $attendee_list))
				{
					foreach($attendee_list as $key => $u)
					{
						if ($user->data['user_id'] == $u)
							unset($attendee_list[$key]);
					}
				}
				$user_list['event_attendees'] = implode(',', $attendee_list);

				// If we are marked as 'not attending', remove us from that list
				if (sizeof($non_attendee_list) && in_array($user->data['user_id'], $non_attendee_list))
				{
					foreach($non_attendee_list as $key => $u)
					{
						if ($user->data['user_id'] == $u)
							unset($non_attendee_list[$key]);
					}
				}
				$user_list['event_non_attendees'] = implode(',', $non_attendee_list);

				$message = $user->lang['CALENDAR_RETRACT_SIGN_UP_SUCCESS'];

			break;

			default:
			break;
		}

		if (!empty($tid))
		{
			$sql = 'UPDATE ' . TOPICS_TABLE . '
				SET ' . $db->sql_build_array('UPDATE', $user_list) . '
				WHERE topic_id = ' . $tid;
		}
		else
		{
			// Get month, day and year of event so we can redirect back to the event we just signed up for
			list($m, $d, $y) = explode(',', gmdate('m,d,Y', $user_list['event_start']));

			$sql = 'UPDATE ' . CALENDAR_TABLE . '
				SET ' . $db->sql_build_array('UPDATE', $user_list) . '
				WHERE event_id = ' . $eid;
		}
		$db->sql_query($sql);

		if (!empty($tid))
		{
			$message .= '<br /><br />' . $user->lang['RETURN_TOPIC'];
			$meta_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$fid&amp;t=$tid");
		}
		else
		{
			$message .= '<br /><br />' . $user->lang['RETURN_CALENDAR'];
			$meta_url = append_sid("{$phpbb_root_path}calendar.$phpEx", "mode=view&amp;month=$m&amp;day=$d&amp;year=$y");
		}
		meta_refresh(3, $meta_url);
		trigger_error($message);

	break;


	case 'view':	// Viewing events of a given day.
		$day = request_var('day', 0);
		$month = request_var('month', 0);
		$year = request_var('year', 0);

		if (checkdate($month, $day, $year))
		{
			$template->assign_vars(array(
				'I_MONTH'	=> $month,
				'I_DAY'		=> $day,
				'I_YEAR'	=> $year,

				'PM_IMG'	=> $user->img('icon_contact_pm', 'SEND_PRIVATE_MESSAGE'),
				'EMAIL_IMG'	=> $user->img('icon_contact_email', 'SEND_EMAIL'),
				'WWW_IMG'	=> $user->img('icon_contact_www', 'VISIT_WEBSITE'),
				'MSN_IMG'	=> $user->img('icon_contact_msnm', 'MSNM'),
				'ICQ_IMG'	=> $user->img('icon_contact_icq', 'ICQ'),
				'YIM_IMG'	=> $user->img('icon_contact_yahoo', 'YIM'),
				'AIM_IMG'	=> $user->img('icon_contact_aim', 'AIM'),
				'JABBER_IMG'	=> $user->img('icon_contact_jabber', 'JABBER') ,

				'REPEAT_IMG'	=> "{$phpbb_root_path}styles/" . $user->theme['theme_path'] . '/imageset/repeat_event.png',
				'CONTINUED_IMG'	=> "{$phpbb_root_path}styles/" . $user->theme['theme_path'] . '/imageset/continued_event.png',

				'EDIT_IMG'		=> $user->img('icon_post_edit', 'EDIT_POST'),
				'DELETE_IMG'	=> $user->img('icon_post_delete', 'DELETE_POST'),
				'S_SHOW_ATTENDEES_LIST' => true,
			));

			$user_cache = array();

			//Get Events for the given day
			$events_array = get_events($day, $month, $year, 'daily');
			if (sizeof($events_array) == 0)
			{
				$template->assign_var('S_NO_EVENTS', true);
			}
			else
			{
      		if (isset($events_array)) 
			{
				foreach ($events_array as $row)
				{
					if (!isset($user_cache[$row['user_id']]))
					{
						$sql = "SELECT * FROM " . USERS_TABLE . "
							WHERE user_id = " . $row['user_id'];
						if (!$result1 = $db->sql_query($sql))
						{
							trigger_error("Could not get user information");
						}

						$this_user_row = array();
						$this_user_row = $db->sql_fetchrow($result1);
						// Unset user's password for security reasons
						unset($this_user_row['user_password']);
						$user_colour = ($this_user_row['user_colour']) ? ' style="color:#' . $this_user_row['user_colour'] . '" class="username-coloured"' : '';
						$this_user_row['username_full'] = ($this_user_row['user_type'] != USER_IGNORE) ? get_username_string('full', $this_user_row['user_id'], $this_user_row['username'], $this_user_row['user_colour']) : '<span' . $user_colour . '>' . $this_user_row['username'] . '</span>';
						$user_cache[$row['user_id']] = $this_user_row;
					}
					$row = array_merge($row, $user_cache[$row['user_id']]);

					// Get users who are signed up for event
					$sql = 'SELECT username, user_id, user_colour FROM ' . USERS_TABLE . '
							WHERE ' . $db->sql_in_set('user_id', explode(',', $row['event_attendees']));
					$result = $db->sql_query($sql);
					$signed_up_array = array();
					$s_is_signed_up = false;

					while($up_list = $db->sql_fetchrow($result))
					{
						$signed_up_array[] = get_username_string('full', $up_list['user_id'], $up_list['username'], $up_list['user_colour']);
						if ($up_list['user_id'] == $user->data['user_id'])
						{
							$s_is_signed_up = true;
						}
					}
					$db->sql_freeresult($result);
					$signed_up_list = implode(', ', $signed_up_array);

					// Get users who have specified they cannot attend / participate in event
					$sql = 'SELECT username, user_id, user_colour FROM ' . USERS_TABLE . '
							WHERE ' . $db->sql_in_set('user_id', explode(',', $row['event_non_attendees']));
					$result = $db->sql_query($sql);
					$signed_down_array = array();
					$s_is_signed_down = false;
					while($down_list = $db->sql_fetchrow($result))
					{
						$signed_down_array[] = get_username_string('full', $down_list['user_id'], $down_list['username'], $down_list['user_colour']);
						if ($down_list['user_id'] == $user->data['user_id'])
						{
							$s_is_signed_down = true;
						}
					}
					$db->sql_freeresult($result);
					$signed_down_list = implode(', ', $signed_down_array);

					// If it is a topic event, get the forum_id and topic_id from the link.
					if (isset($row['topic_link']))
					{
						// Rather than pull out the end of the link, extract the numbers explicitly
						$ids = preg_match_all("[\d+]", $row['topic_link'], $id_array);
						$fid = $id_array[0][0];
						$tid = $id_array[0][1];
						$reg_link = "fid=$fid&amp;tid=$tid";
					}
					else
					{
						$reg_link = 'eid=' . $row['event_id'];
					}

					$template->assign_block_vars('event_row', array(
						'NAME'				=> $row['topic_link'] == null ? censor_text($row['event_name']) : censor_text($row['event_name'] . '<a href="' . $row['topic_link'] . '">' . $user->lang['READ_FULL_TOPIC'] . '</a>'),
						'DESC'				=> $row['topic_link'] == null ? $row['desc'] : $row['desc'] . '<br /><a href="' . $row['topic_link'] . '">' . $user->lang['READ_FULL_TOPIC'] . '</a>',
						'AUTHOR'			=> $row['username_full'],
						'POSTER_ID'			=> $row['user_id'],
						'START_TIME'		=> gmdate($user->date_format, $row['start_time']),
						'END_TIME'			=> gmdate($user->date_format, $row['end_time']),
						'DURATION'			=> calc_duration($row['start_time'], $row['end_time']),
						'REPEAT_LIST'		=> isset($row['repeats']) ? generate_repeat_link_list($row['repeats']) : '',
						'EVENT_ID'			=> $row['event_id'],
						'TOPIC_LINK'		=> $row['topic_link'],
						'POSTER_AVATAR'		=> ($user->optionget('viewavatars')) ? get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height']) : '',
						'POSTER_POSTS'		=> $row['user_posts'],
						'POSTER_JOINED'		=> $user->format_date($row['user_regdate']),
						'POSTER_FROM'		=> (!empty($row['user_from'])) ? $row['user_from'] : '',

						'U_EMAIL'			=> (!empty($row['user_allow_viewemail']) || $auth->acl_get('a_email'))?($config['board_email_form'] && $config['email_enable']) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=email&amp;u=".$row['user_id']) : (($config['board_hide_emails'] && !$auth->acl_get('a_email')) ? '' : 'mailto:' . $row['user_email']):'',
						'U_PM'				=> ($row['user_id'] != ANONYMOUS && $config['allow_privmsg'] && $auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $auth->acl_gets('a_', 'm_') || $auth->acl_getf_global('m_'))) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=pm&amp;mode=compose&amp;action=quotepost&amp;p=' . $row['user_id']) : '',
						'U_WWW'				=> $row['user_website'],
						'U_AIM'				=> ($row['user_aim'] && $auth->acl_get('u_sendim')) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=contact&amp;action=aim&amp;u=".$row['user_id']) : '',
						'U_MSN'				=> ($row['user_msnm'] && $auth->acl_get('u_sendim')) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=contact&amp;action=msnm&amp;u=".$row['user_id']) : '',
						'U_YIM'				=> ($row['user_yim']) ? 'http://edit.yahoo.com/config/send_webmesg?.target=' . $row['user_yim'] . '&amp;.src=pg' : '',
						'U_ICQ'				=> (!empty($row['user_icq']))?'http://www.icq.com/people/webmsg.php?to=' . $row['user_icq']:'',
						'U_JABBER'			=> ($row['user_jabber'] && $auth->acl_get('u_sendim')) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=contact&amp;action=jabber&amp;u=".$row['user_id']) : '',

						'U_EDIT_ACTION'		=> append_sid($phpbb_root_path . 'calendar.' . $phpEx, "mode=edit&amp;event_id=" . $row['event_id']),
						'U_DELETE_ACTION'	=> append_sid($phpbb_root_path . 'calendar.' . $phpEx, "mode=delete&amp;event_id=" . $row['event_id']),

						'S_EDIT'			=> ($row['topic_link'] == null && $user->data['user_id'] == $row['user_id'] ) || ($auth->acl_get('u_edit_event') || $auth->acl_get('m_edit_event') || $auth->acl_get('a_edit_event')) ? true : false,
						'S_DELETE'			=> ($row['topic_link'] == null && $user->data['user_id'] == $row['user_id'] ) || ($auth->acl_get('u_delete_event') || $auth->acl_get('m_delete_event') || $auth->acl_get('a_delete_event')) ? true : false,

						'S_IS_REPEAT'		=> ($row['info'] & EVENT_IS_REPEAT) ? true : false,
						'S_IS_CONTINUED'	=> ($row['info'] & EVENT_IS_CONTINUED) ? true : false,
						'S_HAS_REPEATS'		=> ($row['info'] & EVENT_HAS_REPEATS) ? true : false,

						'S_IS_SIGNED_UP'	=> $s_is_signed_up,
						'S_IS_SIGNED_DOWN'	=> $s_is_signed_down,
						'S_IS_INVITED'		=> $row['invite_attendees'] ? true : false,
						'SIGNED_UP_LIST'	=> empty($signed_up_list) ? null : $signed_up_list,
						'SIGNED_DOWN_LIST'	=> empty($signed_down_list) ? null : $signed_down_list,

						'U_SIGN_UP'			=> append_sid($phpbb_root_path . 'calendar.' . $phpEx, "mode=attend&amp;opt=accept&amp;" . $reg_link),
						'U_SIGN_DOWN'		=> append_sid($phpbb_root_path . 'calendar.' . $phpEx, "mode=attend&amp;opt=decline&amp;" . $reg_link),
						'U_UNREG'			=> append_sid($phpbb_root_path . 'calendar.' . $phpEx, "mode=attend&amp;opt=unreg&amp;" . $reg_link),

					));
				// TODO: Rank title and image ???
				}
			}
			}
			// Get Birthdays for the given day
			$birthday_array = get_birthdays($day, $month, $year, 'daily');
			if (count($birthday_array) == 0)
			{
				$template->assign_var('S_NO_BIRTHDAY', true);
			}
			else
			{
				foreach ($birthday_array as $row)
				$template->assign_block_vars('birthday_row', array(
					'USERNAME_FULL'	=> $row['username'],
					'AGE'			=> $row['age'],
				));
			}
		}
		else
		{
			header('Location:calendar.php');
		}

		// Spit it out
		$page_title= $user->lang['CALENDAR'];
		page_header($page_title);
		$template->set_filenames(array(
		 'body' => 'calendar_view.html')
		);
		page_footer();

	break;

	case 'delete':
		// Kill unauthorised deletion attempts
		if (!$can_delete_others || (!$can_delete_self && $poster_id == $user_id))
		{
			$message = $user->lang['NO_AUTH_OPERATION'] . '<br /><br />' . sprintf($user->lang['RETURN_INDEX'], '<a href="' . $phpbb_root_path . '">', '</a>');
			$meta_url = $can_view_events ? append_sid("{$phpbb_root_path}calendar.$phpEx", "mode=main") : append_sid("{$phpbb_root_path}index.$phpEx");
			meta_refresh(3, $meta_url);
			trigger_error($message, E_USER_WARNING);
		}
		else
		{
			$event_id = request_var('event_id', '');
			$rep = request_var('rep', '');
			$e_name = request_var('e_name', '');
			if (confirm_box(true))
			{
				$sql = 'DELETE FROM ' . CALENDAR_TABLE . "
					WHERE event_id = '$event_id'";
				$db->sql_query($sql);
				$log_msg = 'LOG_DELETED_CALENDAR_EVENT';

				if ($rep)
				{
					$sql = 'DELETE FROM ' . CALENDAR_REPEATS_TABLE . "
						WHERE repeat_id = 'e$event_id'";
					$db->sql_query($sql);
					$log_msg = 'LOG_DELETED_CALENDAR_EVENTS';
				}
				add_log('mod', null, null, $log_msg, $e_name);

				$message = $rep ? $user->lang['CALENDAR_EVENTS_DELETED'] : $user->lang['CALENDAR_EVENT_DELETED'];
				$message .= '<br /><br />' . $user->lang['RETURN_CALENDAR'];
				$meta_url = append_sid("{$phpbb_root_path}calendar.$phpEx", 'mode=main');
				meta_refresh(3, $meta_url);
				trigger_error($message);
			}
			else
			{
				// Get the event name - Just for the moderator log, and start_date to redirect if user cancels confirmation
				$sql = "SELECT event_name, event_start FROM " . CALENDAR_TABLE . "
					WHERE event_id = '$event_id'";
				$result = $db->sql_query($sql);
				$event = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$sql = "SELECT * FROM " . CALENDAR_REPEATS_TABLE . "
					WHERE repeat_id = 'e$event_id'";
				$result = $db->sql_query($sql);
				if ($db->sql_fetchrow($result))
				{
					$msg = 'DELETE_MULTIPLE_EVENTS';
					$rep = true;
				}
				else
				{
					$msg = 'DELETE_SINGLE_EVENT';
					$rep = false;
				}

				confirm_box(false, $msg, build_hidden_fields(array(
					'event_id'		=> $event_id,
					'mode'			=> $mode,
					'rep'			=> $rep,
					'e_name'		=> $event['event_name'],
					'redir_month'	=> gmdate('n', $event['event_start']),
					'redir_year'	=> gmdate('y', $event['event_start']),
					'lastclick'		=> $current_time,
				)));
			}
		}
	break;
}


function build_calendar_panel()
{
	global $template, $auth, $user, $phpbb_root_path, $phpEx, $config;

	if ($config['calendar_override_user'] == true)
	{
		$s_show_monday_first	= $config['calendar_monday_first'];
		$s_show_week_nums		= $config['calendar_show_week_nums'];
		$s_show_birthdays		= $config['calendar_show_birthdays_main'];
	}
	else
	{
		$s_show_monday_first		= (isset($_COOKIE[$config['cookie_name'] . '_' . 'cal_start_day'])) ? request_var($config['cookie_name'] . '_' . 'cal_start_day', '', false, true) : $config['calendar_monday_first'];
		$s_show_week_nums		 = (isset($_COOKIE[$config['cookie_name'] . '_' . 'cal_week_nums'])) ? request_var($config['cookie_name'] . '_' . 'cal_week_nums', '', false, true) : $config['calendar_show_week_nums'];
		$s_show_birthdays		 = (isset($_COOKIE[$config['cookie_name'] . '_' . 'cal_birthdays'])) ? request_var($config['cookie_name'] . '_' . 'cal_birthdays', '', false, true) : $config['calendar_show_birthdays_main'];
	}

	$cal_month = request_var('month', gmdate('m'));
	$cal_year = request_var('year', gmdate('Y'));
	$start_of_this_month = str_to_unix('00:00 am', ($cal_month) . "-01-$cal_year");
	$start_of_next_month = str_to_unix('00:00 am', ($cal_month + 1) . "-01-$cal_year") - 1;

	// This just fills in the day number in each grid square
	$month_array = generate_month_array($cal_month, $cal_year);

	$upcoming_events = get_events(0, $cal_month, $cal_year, 'monthly');
	$upcoming_birthdays = get_birthdays(0, $cal_month, $cal_year, 'monthly');

	$rep_img = "{$phpbb_root_path}styles/" . $user->theme['theme_path'] . '/imageset/repeat_event_small.png';
	$cont_img = "{$phpbb_root_path}styles/" . $user->theme['theme_path'] . '/imageset/continued_event_small.png';

	// Possible 6 week rows
	foreach ( $month_array as $week)
	{
		$first_day_of_week = $s_show_monday_first ? 1 : 0; // Are we starting from Sunday or Monday?

		// 7 days of the week
		for($i = $first_day_of_week ; $i <= $first_day_of_week + 6 ; $i++)
		{
			$time_from = str_to_unix('00:00 am', $cal_month . '-' . $week[$i] . '-' . $cal_year);
			$time_until = $time_from + (60 * 60 * 24) - 1 ;

			$event_array = array();
			foreach($upcoming_events as $event)
			{
				if (($event['start_time'] >= $time_from) && ($event['start_time'] <= $time_until) && ($event['start_time'] >= $start_of_this_month))
				{
					$event_array[] = $event;
				}
			}

			$bday_array = array();
			foreach($upcoming_birthdays as $bday)
			{
				if (($bday['birthday'] >= $time_from) && ($bday['birthday'] <= $time_until))
				{
					$bday_array[] = $bday;
				}
			}

			$todays_event_count = 0 ;
			if ( (sizeof($event_array) > 0) || ((sizeof($bday_array) > 0) && $s_show_birthdays) )
			{
				// There is an event going on
				$output_text = '';
				foreach($event_array as $this_event)
				{
					$todays_event_count++;
					if ($todays_event_count <= 3)
					{
						if ($this_event['info'] & EVENT_IS_REPEAT)
						{
							$output_text .= '<img src="' . $rep_img . '" title="' . $user->lang['IS_REPEAT_EVENT'] . '"/> ';
						}
						if ($this_event['info'] & EVENT_IS_CONTINUED)
						{
							$output_text .= '<img src="' . $cont_img . '" title="' . $user->lang['IS_CONTINUED_EVENT'] . '"/> ';
						}
						$output_text .= '<a href="calendar.php?mode=view&month=' . $cal_month . '&day=' . $week[$i] . '&year=' . $cal_year . '" title="' . $user->lang['STARTS'] . ' ' . gmdate($user->date_format, $this_event['start_time']) . ", " . $user->lang['ENDS'] . ' ' . gmdate($user->date_format, $this_event['end_time']) . '">' . mb_substr($this_event['event_name'], 0, 15) . (mb_strlen($this_event['event_name'])>15?'...':'') . '</a><br>';
					}
					else
					{
						if (sizeof($event_array) > 3)
						{
							$output_text .= '<a href="calendar.php?mode=view&month=' . $cal_month . '&day=' . $week[$i] . '&year=' . $cal_year . '" title="' . $user->lang['MORE_EVENTS'] . '">' . $user->lang['MORE_EVENTS'] . '</a><br>';
							break;
						}
						else
						{
							if (isset($this_event['info']))
							{
								if ($this_event['info'] & EVENT_IS_REPEAT)
								{
									$output_text .= '<img src="' . $rep_img . '" title="' . $user->lang['IS_REPEAT_EVENT'] . '"/> ';
								}
								if ($this_event['info'] & EVENT_IS_CONTINUED)
								{
									$output_text .= '<img src="' . $cont_img . '" title="' . $user->lang['IS_CONTINUED_EVENT'] . '"/> ';
								}
							}
							$output_text .= '<a href="calendar.php?mode=view&month=' . $cal_month . '&day=' . $week[$i] . '&year=' . $cal_year . '" title="' . $user->lang['STARTS'] . ' ' . gmdate($user->date_format, $this_event['start_time']) . ", " . $user->lang['ENDS'] . ' ' . gmdate($user->date_format, $this_event['end_time']) . '">' . mb_substr($this_event['event_name'], 0, 15) . (mb_strlen($this_event['event_name'])>15?'...':'') . '</a><br>';
							break;
						}
					}
				}
				while($todays_event_count++ < 3)
				{
					$output_text .= '&nbsp;<br>';
				}

				if (sizeof($bday_array) > 0 && $s_show_birthdays)
				{
					if (sizeof($bday_array) > 1)
					{
						$output_text .= '<a href="calendar.php?mode=view&month=' . $cal_month . '&day=' . $week[$i] . '&year=' . $cal_year . '" title="Birthday" >' . $user->lang['BIRTHDAYS'] . '</a><br>';
					}
					else
					{
						$output_text .= '<a href="calendar.php?mode=view&month=' . $cal_month . '&day=' . $week[$i] . '&year=' . $cal_year . '" title="Birthday" >' . $bday_array[0]['name'] . ' (' . $bday_array[0]['age'] . ')</a><br>';
					}
				}
				else
				{
					$output_text .= '&nbsp;<br>';
				}

				$week[$i] = array(
					'day'	 => '<b><a href="calendar.php?mode=view&month=' . $cal_month.'&day=' . $week[$i] . '&year=' . $cal_year . '">' . $week[$i] . '</a></b>',
					'event'	=> $output_text,
				);
			}
			else
			{
				// Sigh... This is a eventless day
				$week[$i] = array(
					'day'	 => (isset($week[$i]) ? $week[$i] : ''),
					'event'	=> '&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>',
				);
			}
			unset($event_array);
		}

		// Note: Day 0 stuff is a cheat so we can handle display starting Sunday or Monday.
		$template->assign_block_vars('calendar_week', array(
			'WEEK_NUM'		=> !empty($week['week_no']) ? $week['week_no'] : '',
			'DAY0'			=> !empty($week[0]['day']) ? $week[0]['day'] : '',
			'DAY1'			=> !empty($week[1]['day']) ? $week[1]['day'] : '',
			'DAY2'			=> !empty($week[2]['day']) ? $week[2]['day'] : '',
			'DAY3'			=> !empty($week[3]['day']) ? $week[3]['day'] : '',
			'DAY4'			=> !empty($week[4]['day']) ? $week[4]['day'] : '',
			'DAY5'			=> !empty($week[5]['day']) ? $week[5]['day'] : '',
			'DAY6'			=> !empty($week[6]['day']) ? $week[6]['day'] : '',
			'DAY7'			=> !empty($week[7]['day']) ? $week[7]['day'] : '',
			'DAY0_EVENTS'	=> !empty($week[0]['event']) ? $week[0]['event'] : '',
			'DAY1_EVENTS'	=> !empty($week[1]['event']) ? $week[1]['event'] : '',
			'DAY2_EVENTS'	=> !empty($week[2]['event']) ? $week[2]['event'] : '',
			'DAY3_EVENTS'	=> !empty($week[3]['event']) ? $week[3]['event'] : '',
			'DAY4_EVENTS'	=> !empty($week[4]['event']) ? $week[4]['event'] : '',
			'DAY5_EVENTS'	=> !empty($week[5]['event']) ? $week[5]['event'] : '',
			'DAY6_EVENTS'	=> !empty($week[6]['event']) ? $week[6]['event'] : '',
			'DAY7_EVENTS'	=> !empty($week[7]['event']) ? $week[7]['event'] : '',
		));
	}

	// Calculate date for previous / next links ( <<	>> )
	$next_month = ($cal_month + 1 == 13) ? 1 : $cal_month + 1;
	$previous_month = ($cal_month - 1 == 0) ? 12 : $cal_month - 1;

	$template->assign_vars(array(
		'L_CALENDAR'		 => $user->lang['LANG_CALENDAR'],
		'L_SUN'				=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][0],
		'L_MON'				=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][1],
		'L_TUE'				=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][2],
		'L_WED'				=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][3],
		'L_THU'				=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][4],
		'L_FRI'				=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][5],
		'L_SAT'				=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][6],
		'L_CALENDAR_MONTH'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][(int)$cal_month] . " " . $cal_year,

		'U_NEXT_MONTH'		=> append_sid($phpbb_root_path . 'calendar.' . $phpEx . "?mode=main&amp;month=" . $next_month . "&amp;year=" . ($next_month == 1 ? ($cal_year + 1) : $cal_year)),
		'U_PREV_MONTH'		=> append_sid($phpbb_root_path . 'calendar.' . $phpEx . "?mode=main&amp;month=" . $previous_month . "&amp;year=" . ($previous_month == 12 ? ($cal_year - 1) : $cal_year)),
		'U_CALENDAR_MAIN'	=> append_sid($phpbb_root_path . 'calendar.' . $phpEx . "?mode=main"),

		'IMG_LEFT_ARROW'	=> '&lt;&lt;',
		'IMG_RIGHT_ARROW'	=> '&gt;&gt;',

		// admin & moderators can always post events...
		// this is a bug fix, if you don't allow normal users to post no one can!!!

		//'S_NEW_EVENT'		=> $auth->acl_get('u_new_event'),
		'S_NEW_EVENT'		=> $auth->acl_get('u_new_event') or ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')),
		//

		'S_MONDAY_FIRST'	 => $s_show_monday_first,
		'S_SHOW_WEEK_NUMS'	=> $s_show_week_nums,
		'S_SHOW_BIRTHDAYS'	=> $s_show_birthdays,
	));
}

function events_bdays_panel()
{
	global $template, $auth, $user, $phpbb_root_path, $phpEx, $config;

	if ($config['calendar_override_user'] == true)
	{
		$s_show_upcoming_events	= $config['calendar_show_events_list'];
		$upcoming_events_days	 = $config['calendar_default_events_list_days'];
		$s_show_upcoming_birthdays = $config['calendar_show_birthdays_list'];
		$upcoming_birthdays_days	= $config['calendar_default_bdays_list_days'];
	}
	else
	{
		$s_show_upcoming_events	= (isset($_COOKIE[$config['cookie_name'] . '_' . 'cal_events_list'])) ? request_var($config['cookie_name'] . '_' . 'cal_events_list', '', false, true) : $config['calendar_show_events_list'];
		$upcoming_events_days	 = (isset($_COOKIE[$config['cookie_name'] . '_' . 'cal_upcoming_events_days'])) ? request_var($config['cookie_name'] . '_' . 'cal_upcoming_events_days', '', false, true) : $config['calendar_max_events_list_days'];
		$s_show_upcoming_birthdays = (isset($_COOKIE[$config['cookie_name'] . '_' . 'cal_birthdays_list'])) ? request_var($config['cookie_name'] . '_' . 'cal_birthdays_list', '', false, true) : $config['calendar_show_birthdays_list'];
		$upcoming_birthdays_days	= (isset($_COOKIE[$config['cookie_name'] . '_' . 'cal_upcoming_birthdays_days'])) ? request_var($config['cookie_name'] . '_' . 'cal_upcoming_birthdays_days', '', false, true) : $config['calendar_max_bdays_list_days'];
	}

	$is_events = false;
	$is_birthdays = false;

	if ($s_show_upcoming_events || $s_show_upcoming_birthdays)
	{
		$cal_month = request_var('month', date('m', gmdate('U') + $user->timezone + $user->dst));
		$cal_year = request_var('year', date('Y', gmdate('U') + $user->timezone + $user->dst));
		$start_of_next_month = str_to_unix('00:00 am', ($cal_month + 1) . "-01-$cal_year") - 1;
		$time_now = gmdate('U') + $user->timezone + $user->dst;

		if ($s_show_upcoming_events)
		{
			if ($config['calendar_override_user'])
			{
				$event_list_date_span = $config['calendar_default_events_list_days'];
			}
			else
			{
				// Check how many days worth of events the user would like to view
				$event_list_date_span = $upcoming_events_days > $config['calendar_max_events_list_days'] ? $config['calendar_max_events_list_days'] : $upcoming_events_days;
			}
			$event_list_end_time = $time_now + ($event_list_date_span * 24 * 60 * 60) - 1;

			$period = $event_list_end_time - str_to_unix('00:00 am', "$cal_month-01-$cal_year");
			$upcoming_events = get_events(0, $cal_month, $cal_year, $period);

			$is_events = false;
			foreach($upcoming_events as $event)
			{
				if (($event['end_time'] > $time_now) && $event['start_time'] < $event_list_end_time)
				{
					list($m, $d, $y) = explode(',', gmdate('m,d,Y', $event['start_time']));

					$template->assign_block_vars('event_list', array(
						'TITLE'	=> '<a href="calendar.php?mode=view&month=' . $m . '&day=' . $d . '&year=' . $y . '" title="' . censor_text($event['event_name']) . '">' . censor_text($event['event_name']) . '</a>',
						'DATE'	=> gmdate('D jS M', $event['start_time']),
						'TIME'	=> gmdate('H:i', $event['start_time']),
					));
					$is_events = true;
				}
			}
		}

		if ($s_show_upcoming_birthdays)
		{
			if ($config['calendar_override_user'])
			{
				$birthday_list_date_span = $config['calendar_default_bdays_list_days'];
			}
			else
			{
				// Check how many days worth of birthdays the user would like to view
				$birthday_list_date_span = $upcoming_birthdays_days > $config['calendar_max_bdays_list_days'] ? $config['calendar_max_bdays_list_days'] : $upcoming_birthdays_days;
			}
			$birthday_list_end_time = $time_now + ($birthday_list_date_span * 24 * 60 * 60) - 1;

			//$period = $birthday_list_end_time - str_to_unix('00:00 am', "$cal_month-01-$cal_year");
			$period = $birthday_list_end_time - $time_now;

			$upcoming_birthdays = get_birthdays(0, 0, $cal_year, $period);

			$is_birthdays = false;
			foreach($upcoming_birthdays as $bday)
			{
				if (($bday['birthday'] > $time_now) && $bday['birthday'] < $birthday_list_end_time)
				{
					$template->assign_block_vars('bday_list', array(
						'USERNAME_FULL' => $bday['username'],
						'AGE'			=> $bday['age'],
						'ON_DAY'		=> gmdate('D jS M', $bday['birthday']),
					));
					$is_birthdays = true;
				}
			}
		}
	}

	$template->assign_vars(array(
		'S_SHOW_UPCOMING_EVENTS'	=> $s_show_upcoming_events,
		'UPCOMING_EVENTS_DAYS'		=> $upcoming_events_days,
		'L_EVENTS_TIMEFRAME'		=> sprintf($user->lang['UPCOMING_EVENTS_TIME_FRAME'], $upcoming_events_days),
		'S_IS_EVENTS'				=> $is_events ? true : false,

		'S_SHOW_UPCOMING_BIRTHDAYS'	=> $s_show_upcoming_birthdays,
		'UPCOMING_BIRTHDAYS_DAYS'	=> $upcoming_birthdays_days,
		'L_BIRTHDAYS_TIMEFRAME'		=> sprintf($user->lang['UPCOMING_EVENTS_TIME_FRAME'], $upcoming_birthdays_days),
		'S_IS_BIRTHDAYS'			=> $is_birthdays ? true : false,
	));
}


?>