<?php
/**
*
* @package calendar
* @version $Id: functions_calendar.php 2008-07-10 21:16:00Z livewirestu and NeXur $
* @copyright (c) 2008 phpbbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Description: functions required for event and topic calendar mod.
* Notes: This project was started after the calendar project by John Cottage (jcc264) on phpbb.com went stale
* It has since been completely overhauled, although still contains some small sections of John's original code
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Some globals - Note that the file inclusion in any user facing file must be declared after $user->setup() to ensure
* these variables can access the $user->lang array
* First, second, third or last
*/

if (!isset($nth_position_list))
{
	$nth_position_list = array(
		'F' => $user->lang['FIRST'],
		'S' => $user->lang['SECOND'],
		'T' => $user->lang['THIRD'],
		'O' => $user->lang['FOURTH'],
		'L' => $user->lang['LAST'],
	);
}

// Day
if (!isset($weekday_list))
{
	$weekday_list = array(
		'S' => $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][0],   // Sunday
		'M' => $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][1],   // Monday
		'T' => $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][2],   // Tuesday
		'W' => $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][3],   // Wednesday
		'H' => $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][4],   // Thursday
		'F' => $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][5],   // Friday
		'A' => $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][6],   // Saturday
	);
}

// Month
if (!isset($month_list))
{
	$month_list = array(
		'J' => $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][1],   // January
		'F' => $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][2],   // February
		'M' => $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][3],   // March
		'A' => $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][4],   // April
		'Y' => $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][5],   // May
		'U' => $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][6],   // June
		'L' => $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][7],   // July
		'G' => $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][8],   // August
		'S' => $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][9],   // September
		'O' => $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][10],   // October
		'N' => $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][11],   // November
		'D' => $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][12],   // December
	);
}

if (!isset($month_numbers))
{
	$month_numbers = array(
		'J'	=> 1,	// January
		'F'	=> 2,	// February
		'M'	=> 3,	// March
		'A'	=> 4,	// April
		'Y'	=> 5,	// May
		'U'	=> 6,	// June
		'L'	=> 7,	// July
		'G'	=> 8,	// August
		'S'	=> 9,	// September
		'O'	=> 10,	// October
		'N'	=> 11,	// November
		'D'	=> 12,	// December
	);
}

/**
* function:    generate_month_array()
* description: Calculates which dates occur on which days on the calendar table, based on the month
*				An array of maximum size = 42 (7 days * 6 weeks) is generated. The weekday of the first
*				day of the month is calculated, then from this point, the array is filled with the day
*				of each month, until the end of the month
*				This function takes into account if the user has selected to view the calendar starting
*				on either Mondays or Sundays
* parameters:	integer $mon - the month in question
*				integer $year - the year in question
*				mixed $simple - Optional - If true, the array is just a 49 element array with the day numbers in it.
*					The first 7 elements of the array in simple mode will be the day initials
*					Use this for the ajax calendar block
* returns:		array $month - Multidimensional array containing month data
* author:		livewirestu
* notes:		Original function of same name written by John Cottage (jcc264)
*				This is a completely rewritten version
*				Note on week numbers
*				ISO-8601 states that the week number is associated with that week's thursday.
*				So each week number is calculated from its thursday. The php date function handles this, so
*				we just calculate the week number of each row from the sunday or monday. If a week does not
*				start on a thursday we show two week numbers. If the calendar is set to display weeks starting
*				from Sunday, the week number for monday onwards is shown - I.e., the sunday would be from the
*				 previous week number. There is a note to the user about this when 'Sunday first' is selected
*/
function generate_month_array($mon, $year, $simple = false)
{
	global $config, $user, $phpEx, $phpbb_root_path;

	if ($config['calendar_override_user'] == true)
	{
		$s_show_monday_first	= (int)$config['calendar_monday_first'];
	}
	else
	{
		$s_show_monday_first	= (isset($_COOKIE[$config['cookie_name'] . '_' . 'cal_start_day'])) ? (int)request_var(($config['cookie_name'] . '_' . 'cal_start_day'), '', false, true) : (int)$config['calendar_monday_first'];
	}
	$first_day_of_week = $s_show_monday_first ? 1 : 0; // Are we starting from Sunday or Monday?

	// First things first, convert into unix timestamp - Then we can do what we like with it
	$month_start = gmmktime(0, 0, 0, $mon, 1, $year);
	list($first_dom, $days_in_month) = explode(',', gmdate('w,t', $month_start));

	// $month is the base level of the month structure - This is what is returned to the calling function
	$month = array();
	$week = $dom = 1;

	// Tweak required if first day of month is a sunday and calendar is viewed starting on monday
	if ($first_dom == 0 && $first_day_of_week == 1)
	{
		$first_dom = 7;
	}

	$grid_count = 1 + $first_day_of_week;
	if (!$simple)
	{
		while($grid_count <= $first_dom + $days_in_month)
		{
			$month[$week] = array();
			$month[$week]['week_no'] = gmdate('W', gmmktime(0, 0, 0, $mon, ($first_day_of_week == 1 ? $dom : ($dom + 1)), $year));
			for($weekday = $first_day_of_week; $weekday <= $first_day_of_week + 6 ; $weekday++, $grid_count++)
			{
				$month[$week][$weekday] = ( ($grid_count <= $first_dom) && ($week == 1) ) || ( $grid_count > ($first_dom + $days_in_month) ) ? '' : $dom++;
			}
			$week++;
		}
	}
	else
	{
		$month['identifier'] = $cal_id = 'cal_';
		// Fill in the day initials, starting Sunday or Monday depending on settings
		for($dname = 0 ; $dname < 7 ; $dname++)
		{
			if ($s_show_monday_first && $dname == 6)
			{
				$month[$cal_id . 'dname_' . $dname] = '<b>' . $user->lang['CAL_CALENDAR']['DAY_INITIAL'][0] . '</b>';
			}
			else
			{
				$month[$cal_id . 'dname_' . $dname] = $s_show_monday_first == 1 ? '<b>' . $user->lang['CAL_CALENDAR']['DAY_INITIAL'][$dname + 1] : '<b>' . $user->lang['CAL_CALENDAR']['DAY_INITIAL'][$dname] . '</b>';
			}
		}
		// Fill empty days at start of grid with spaces
		// Then proceed to fill the array with the day numbers until we reach the last day of the given month.
		// Then fill the rest with spaces
		$day_count = 1;
		for($current_grid = 1 ; $current_grid <= 42 ; $current_grid++)
		{
			$month[$cal_id . $current_grid] = (($current_grid > ($first_dom - $first_day_of_week)) && ($day_count <= $days_in_month)) ? $day_count++ : ' ';
		}

		// Now put the events in the table
		$events = get_events(0, $mon, $year, 'monthly', true);
		if (is_array($events)) {
		foreach ($events as $event)
		{
			// We should only have the selected month's events, so we only need to extract the day from the date
			$event_day = gmdate('j', $event['start_time']);
			$month[$cal_id . ($event_day + $first_dom - $first_day_of_week)] = '<a href="'.append_sid("{$phpbb_root_path}calendar.$phpEx", 'mode=view&month=' . $mon . '&day=' . $event_day . '&year=' . $year) . '"><b>' . $event_day . '</b></a>';
		}
		}

		$bdays = get_birthdays(0, $mon, $year, 'monthly');
		if (is_array($bdays))
		{
			foreach ($bdays as $bday)
			{
				// We should only have the selected month's birthdays, so we only need to extract the day from the date
				$birthday = gmdate('j', $bday['birthday']);
				$month[$cal_id . ($birthday + $first_dom - $first_day_of_week)] = '<a href="'.append_sid("{$phpbb_root_path}calendar.$phpEx", 'mode=view&month=' . $mon . '&day=' . $birthday . '&year=' . $year) . '"><b>' . $birthday . '</b></a>';
			}
		}
		$today = array();
		list($today['mon'], $today['year'], $today['mday']) = explode('-', gmdate('n-Y-j', time() + $user->timezone + $user->dst));
		//$today = getdate(gmdate('U', time()));
		if ((int)$today['mon'] == (int)$mon && (int)$today['year'] == (int)$year)
		{
			$month[$cal_id . ($today['mday'] + $first_dom - $first_day_of_week)] = '<div class="cal_today">' . $month[$cal_id . ($today['mday'] + $first_dom - $first_day_of_week)] . '</div>';
		}
	}
	return $month;
}


/**
*				***************************************************
*				********* OBSOLETE - RETAIN FOR REFERENCE *********
*				***************************************************
* function:		validate_event_data
* description:	Validates all data entered by user for events. Returns array $error[]
*				Data is fully sanitised later before committing to db
*				$event_type can be 'standard_event' or 'topic_event' or 'ajax'
*				'ajax' is used just to check repeat event parameters on the fly during user entry
*				For topic events, not all parameters are checked
* parameters:	array $event_data - Array containing various event related data
*				string $event_type - Can be standard_event, topic_event or ajax
* returns:		array $error - array of error messages
* author:		livewirestu
* notes:		For standard events, all parameters are validated
*				For topic events and ajax, only times, dates and repeat parameters are validated
*/
/*
function validate_event_data($event_data, $event_type)
{
	global $user, $db, $nth_position_list, $weekday_list, $month_list, $month_numbers;

	$start_valid = true;
	$is_event = true;
	$general_repeat_error = false;
	$inconsistent_error = false;
	$error = array();

	if ($event_type == 'standard_event')
	{
		if ($event_data['event_name'] == '')
		{
			$error[] = $user->lang['CALENDAR_NAME_ERROR'];
		}
		if ($event_data['event_desc'] == '')
		{
			$error[] = $user->lang['CALENDAR_DESC_ERROR'];
		}
		if ($event_data['group_cats'] == EVENT_VIEW_BY_GROUPS && !sizeof($event_data['event_groups']))
		{
			$error[] = $user->lang['CALENDAR_MUST_SELECT_GROUP'];
		}
		if ($event_data['group_cats'] == EVENT_VIEW_BY_PRIVATE && !$event_data['priv_users'])
		{
			$error[] = $user->lang['CALENDAR_MUST_SELECT_USER'];
		}

		// Check validity of usernames in list if private event
		$priv_user_list = explode("\n", $event_data['priv_users']);

		$sql = 'SELECT user_id FROM ' . USERS_TABLE . '
				WHERE ' . $db->sql_in_set('username', explode("\n", $event_data['priv_users']));
		$result = $db->sql_query($sql);
		$user_id_list = array();
		while($row = $db->sql_fetchrow($result))
		{
			$user_id_list[] = $row['user_id'];
		}
		$db->sql_freeresult($result);

		// TODO - Determine if any entered user names are invalid and inform user which are wrong if any
	}

	// For topic events, either all or none of the times and dates must be set.
	if ($event_type == 'topic_event' || $event_type == 'ajax')
	{
		if (!($event_data['event_start_time'] || $event_data['event_start_date'] || $event_data['event_end_time'] || $event_data['event_end_date']))
		{
			$is_event = false;
		}
	}

	if ($is_event)
	{
		if (!$event_data['event_start_time'] || !$event_data['event_start_date'])
		{
			$error[] = $user->lang['CALENDAR_INPUT_START_TIME_DATE_ERROR'];
			$start_valid = false;
		}
		if (!$event_data['event_end_time'] || !$event_data['event_end_date'])
		{
			$error[] = $user->lang['CALENDAR_INPUT_END_TIME_DATE_ERROR'];
		}
	}

	if ($event_data['event_start_time'] && $event_data['event_start_date'] && $event_data['event_end_time'] && $event_data['event_end_date'])
	{
		if (str_to_unix($event_data['event_start_time'], $event_data['event_start_date']) >= str_to_unix($event_data['event_end_time'], $event_data['event_end_date']))
		{
			$error[] = $user->lang['CALENDAR_OVERLAP_ERROR'];
		}
	}
	if (($event_data['event_repeat'] == 1) && ((int)$event_data['event_repeat_count'] < 1 || (int)$event_data['event_repeat_count'] > 99))
	{
		$error[] = $user->lang['CALENDAR_REPEAT_COUNT_ERROR'];
		$general_repeat_error = true;
	}
	if (($event_data['event_repeat'] == 1) && !in_array($event_data['event_repeat_when'], array('DD', 'WW', 'MM', 'YY', 'WM', 'WY')))
	{
		$error[] = $user->lang['CALENDAR_REPEAT_WHEN_ERROR'];
		$general_repeat_error = true;
	}
	if (($event_data['event_repeat'] == 1) && ($event_data['event_repeat_when'] == 'WM'))
	{
		// Check values are ones we offered
		if (!array_key_exists($event_data['repeat_nth_pos'], $nth_position_list)
			|| !array_key_exists($event_data['repeat_nth_weekday'], $weekday_list)
			|| ((int)$event_data['repeat_nth_count'] < 1 || (int)$event_data['repeat_nth_count'] > 11))
		{
			$error[] = $user->lang['CALENDAR_REPEAT_WHEN_ERROR'];
			$general_repeat_error = true;
		}
		// Check that the specified start date is consistent with the repeat parameters
		if ($start_valid && !$general_repeat_error)
		{
			list($_m, $_d, $_y) = explode('-', $event_data['event_start_date']);
			$_init_start_date = mktime(0, 0, 0, $_m, $_d, $_y);
			$_init_repeat_date = nth_weekday_to_unix($event_data['repeat_nth_pos'], $event_data['repeat_nth_weekday'], $_m, $_y);
			if ($_init_start_date != $_init_repeat_date)
			{
				$inconsistent_error = true;
				$error[] = $user->lang['CALENDAR_REPEAT_TIMES_INCONSISTENT'];
				if (!$general_repeat_error)
				{
					$error[] = sprintf($user->lang['CALENDAR_INCONSISTENCY_SPECIFICS'], date('m/d/Y', $_init_start_date), $nth_position_list[$event_data['repeat_nth_pos']], $weekday_list[$event_data['repeat_nth_weekday']]);
				}
			}
		}
	}
	if (($event_data['event_repeat'] == 1) && ($event_data['event_repeat_when'] == 'WY'))
	{
		// Check values are ones we offered
		if (!array_key_exists($event_data['nth_month_position'], $nth_position_list)
			|| !array_key_exists($event_data['nth_month_weekday'], $weekday_list)
			|| !array_key_exists($event_data['nth_month_month'], $month_list))
		{
			$error[] = $user->lang['CALENDAR_REPEAT_WHEN_ERROR'];
			$general_repeat_error = true;
		}
		// Check that the specified start date is consistent with the repeat parameters
		if ($start_valid && !$general_repeat_error)
		{
			list($_m, $_d, $_y) = explode('-', $event_data['event_start_date']);
			$_init_start_date = mktime(0, 0, 0, $_m, $_d, $_y);
			$_init_repeat_date = nth_weekday_to_unix($event_data['nth_month_position'], $event_data['nth_month_weekday'], $month_numbers[$event_data['nth_month_month']], $_y);
			$t1 = date('m/d/Y, H:i:s', $_init_start_date);
			$t2 = date('m/d/Y, H:i:s', $_init_repeat_date);
			if ($_init_start_date != $_init_repeat_date)
			{
				if (!$inconsistent_error)
				{
					$error[] = $user->lang['CALENDAR_REPEAT_TIMES_INCONSISTENT'];
				}
				if (!$general_repeat_error)
				{
					$error[] = sprintf($user->lang['CALENDAR_INCONSISTENT_MONTH'], date('m/d/Y', $_init_start_date), $nth_position_list[$event_data['nth_month_position']], $weekday_list[$event_data['nth_month_weekday']], $month_list[$event_data['nth_month_month']]);
				}
			}
		}
	}
	return $error;
}
*/

/**
* function:		check_date
* description:	First checks that the date is in a valid format, then verifies that the actual date is valid
* parameters:	string $date - date in either mm-dd-yyyy or m-dd-yyyy format
* returns:		true if $date is valid, else false
* author:		livewirestu
* notes:		Should never be a case where this returns false, since the date fields are filled by the
*				javascript mini popup calendar - But just in case someone is monkeying around changing post vars :P
*/
function check_date($date)
{
	if (preg_match("/^([1-9]|0[1-9]|1[0-2])-([0-3][0-9])-([1-2][0-9]{3})$/", $date, $mdy))
	{
		return checkdate($mdy[1], $mdy[2], $mdy[3]) ? true : false;
	}
	else
	{
		return false;
	}
}

/**
* function:		check_time
* description:	Check that the time is in a valid format
* parameters:	string $time - in hh:mm am/pm format
* returns:		true if time is valid, else false
* author:		livewirestu
* notes:		This should be all the validation that is required to check for a valid time
*/
function check_time($time)
{
	return preg_match("/^(0[1-9]|1[0-2]):[0-5][0-9] ([ap]m)$/", $time) ? true : false;
}

/**
* function:
* description:	Check that entered start/end dates/times are valid
* parameters:	bool $return_params - if true, and times and dates are valid, the UNIX start and end times are returned
*				mixed array $event_data - If provided, event data is used for validation - Else data is taken from template
* returns:		mixed array $result
*					=> error - list of error messages
*					=> valid - true if data is valid, else false
*					=> start - if $return_params is true, contains UNIX start time
*					=> end - if $return_params is true, contains UNIX end time
* author:
* notes:		Validity checks:
*				All start/end dates/times must be completed
*				Times and dates must be of valid format - if they are not, they are either empty or the user is attempting to modify post vars
*				Event start must be in the future
*				Event end must be after event start
*/
function validate_event_times($return_params = false, $event_data = false)
{
	global $user, $template;

	$result = array();
	$result['error'] = array();
	$result['valid'] = true;

	if (!$event_data)
	{
		$sd = request_var('date', '');
		$st = request_var('time', '');
		$ed = request_var('end_date', '');
		$et = request_var('end_time', '');
	}
	else
	{
		$sd = $event_data['event_start_date'];
		$st = $event_data['event_start_time'];
		$ed = $event_data['event_end_date'];
		$et = $event_data['event_end_time'];
	}

	if (!check_date($sd) || !check_time($st))
	{
		$result['error'][] = $user->lang['CALENDAR_INPUT_START_TIME_DATE_ERROR'];
	}
	if (!check_date($ed) || !check_time($et))
	{
		$result['error'][] = $user->lang['CALENDAR_INPUT_END_TIME_DATE_ERROR'];
	}
	if (sizeof($result['error']))
	{
		$result['valid'] = false;
		return $result;
	}

	// Check that event start is in the future
	// TODO - Add ACP option to allow events starting in the past?

	// If previous checks passed, check that event end is after event start
	if (str_to_unix($st, $sd) >= str_to_unix($et, $ed))
	{
		$result['error'][] = $user->lang['CALENDAR_OVERLAP_ERROR'];
		$result['valid'] = false;
		return $result;
	}

	if ($return_params == true)
	{
		$result['start'] = str_to_unix($st, $sd);
		$result['end'] = str_to_unix($et, $ed);
	}

	return $result;
}


/**
* function:		validate_repeat_params
* description:	Checks to see that the user has entered valid parameters for repeat events
* parameters:	bool $return_params - if true, we return the constructed repeat code
*				bool $ajax - // TODO - maybe remove this now
*				mixed array $event_data - If provided, we validate data within this array, else we get data from template
* returns:		mixed array $result
*						=> valid - True if repeat parameters are valid, else false
*						=> error - list of error messages
*						=> repeat_code - if $return_params is true, return the constructed repeat code
*				If $return_params is true, repeat code is returned
* author:
* notes:		This should only ever be called if the user has checked the 'Repeat event:' radio button.
*				For nth weekday of nth month blah blah type repeat events, it will attempt to validate these
*				parameters against the provided start date.
*				This function must only be called after validate_event_times() has returned true
*/
function validate_repeat_params($return_params = false, $ajax = false, $event_data = false)
{
	global $user, $template;

if (!isset($nth_position_list))
{
	$nth_position_list = array(
		'F'	=> $user->lang['FIRST'],
		'S'	=> $user->lang['SECOND'],
		'T'	=> $user->lang['THIRD'],
		'O'	=> $user->lang['FOURTH'],
		'L'	=> $user->lang['LAST'],
	);
}

// Day
if (!isset($weekday_list))
{
	$weekday_list = array(
		'S'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][0],   // Sunday
		'M'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][1],   // Monday
		'T'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][2],   // Tuesday
		'W'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][3],   // Wednesday
		'H'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][4],   // Thursday
		'F'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][5],   // Friday
		'A'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_DAY'][6],   // Saturday
	);
}

// Month
if (!isset($month_list))
{
	$month_list = array(
		'J'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][1],   // January
		'F'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][2],   // February
		'M'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][3],   // March
		'A'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][4],   // April
		'Y'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][5],   // May
		'U'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][6],   // June
		'L'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][7],   // July
		'G'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][8],   // August
		'S'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][9],   // September
		'O'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][10],   // October
		'N'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][11],   // November
		'D'	=> $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][12],   // December
	);
}

if (!isset($month_numbers))
{
	$month_numbers = array(
		'J'	=> 1,	 // January
		'F'	=> 2,	 // February
		'M'	=> 3,	 // March
		'A'	=> 4,	 // April
		'Y'	=> 5,	 // May
		'U'	=> 6,	 // June
		'L'	=> 7,	 // July
		'G'	=> 8,	 // August
		'S'	=> 9,	 // September
		'O'	=> 10,	// October
		'N'	=> 11,	// November
		'D'	=> 12,	// December
	);
}

	// First things first, lets double check that the user has chosen a repeat event
	if (request_var('event_repeat', 0) == 0)
	{
		return false;
	}

	if (!$event_data)
	{
		$r_count = request_var('event_repeat_count', '');
		$r_when = request_var('event_repeat_when', '');
		$r_pos = request_var('nth_day_position', '');
		$r_wday = request_var('nth_weekday', '');
		$r_n_months = request_var('nth_count' ,'');
		$r_mon_pos = request_var('nth_month_position', '');
		$r_mon_wday = request_var('nth_month_weekday', '');
		$r_mon_mon = request_var('nth_month_month', '');
	}
	else
	{
		$r_count = $event_data['event_repeat_count'];
		$r_when = $event_data['event_repeat_when'];
		$r_pos = $event_data['repeat_nth_pos'];
		$r_wday = $event_data['repeat_nth_weekday'];
		$r_n_months = $event_data['repeat_nth_count'];
		$r_mon_pos = $event_data['nth_month_position'];
		$r_mon_wday = $event_data['nth_month_weekday'];
		$r_mon_mon = $event_data['nth_month_month'];
	}

	$result = array();
	$result['error'] = array();
	$result['valid'] = true;	// Innocent until proven guilty

	// Validate repeat parameters
	if (!in_array($r_when, array('DD', 'WW', 'MM', 'YY', 'WM', 'WY')))
	{
		$result['error'][] = $user->lang['CALENDAR_REPEAT_WHEN_ERROR'];
	}
	if ((int)$r_count < 1 || (int)$r_count > 99)
	{
		$result['error'][] = $user->lang['CALENDAR_REPEAT_COUNT_ERROR'];
	}
	if (sizeof($result['error']))  // No point in going any further
	{
		$result['valid'] = false;
		return $result;
	}

	// nth weekday every n months
	if ($r_when == 'WM')
	{
		// Check values are ones we offered
		if (!array_key_exists($r_pos, $nth_position_list)
			|| !array_key_exists($r_wday, $weekday_list)
			|| ((int)$r_n_months < 1 || (int)$r_n_months > 11))
		{
			$result['error'][] = $user->lang['CALENDAR_REPEAT_WHEN_ERROR'];
			$result['valid'] = false;
			return $result;
		}
		// Check that the specified start date is consistent with the repeat parameters
		list($_m, $_d, $_y) = explode('-', request_var('date', ''));
		$init_start_date = gmmktime(0, 0, 0, $_m, $_d, $_y);
		$init_repeat_date = nth_weekday_to_unix($r_pos, $r_wday, $_m, $_y);
		if ($init_start_date != $init_repeat_date)
		{
			$result['error'][] = $user->lang['CALENDAR_REPEAT_TIMES_INCONSISTENT'];
			$result['error'][] = sprintf($user->lang['CALENDAR_INCONSISTENCY_SPECIFICS'], gmdate('m/d/Y', $init_start_date), $nth_position_list[$r_pos], $weekday_list[$r_wday]);
			$result['valid'] = false;
			return $result;
		}
	}

	// nth weekday of nth month every year
	if (($r_when == 'WY'))
	{
		// Check values are ones we offered
		if (!array_key_exists($r_mon_pos, $nth_position_list)
			|| !array_key_exists($r_mon_wday, $weekday_list)
			|| !array_key_exists($r_mon_mon, $month_list))
		{
			$result['error'][] = $user->lang['CALENDAR_REPEAT_WHEN_ERROR'];
			$result['valid'] = false;
			return $result;
		}
		// Check that the specified start date is consistent with the repeat parameters
		list($_m, $_d, $_y) = explode('-', request_var('date', ''));
		$init_start_date = gmmktime(0, 0, 0, $_m, $_d, $_y);
		$init_repeat_date = nth_weekday_to_unix($r_mon_pos, $r_mon_wday, $month_numbers[$r_mon_mon], $_y);
		if ($init_start_date != $init_repeat_date)
		{
			$result['error'][] = $user->lang['CALENDAR_REPEAT_TIMES_INCONSISTENT'];
			$result['error'][] = sprintf($user->lang['CALENDAR_INCONSISTENT_MONTH'], gmdate('m/d/Y', $init_start_date), $nth_position_list[$r_mon_pos], $weekday_list[$r_mon_wday], $month_list[$r_mon_mon]);
			$result['valid'] = false;
			return $result;
		}
	}

	// Seems everything is ok, so generate the repeat code if required and return the results
	if ($return_params == true)
	{
		$result['repeat_code'] = '';
		// construct the code for repeat events
		$result['repeat_code'] = $r_when . str_pad($r_count, 2, '0', STR_PAD_LEFT);

		// We have already determined there are no errors, so we can just append stuff straight onto the repeat code
		switch($r_when)
		{
			case 'WM':  // nth weekday every n months
				$result['repeat_code'] .= $r_pos . $r_wday . str_pad($r_n_months, 2, '0', STR_PAD_LEFT);
			break;

			case 'WY':  // nth weekday of nth month every year
				$result['repeat_code'] .= $r_mon_pos . $r_mon_wday . $r_mon_mon . ' ';
			break;

			default:	// DD, WW, MM or YY
			break;
		}
	}
	else
	{
		$result['repeat_code'] = false;
	}

	return $result;
}

/**
* function:		validate_misc_event_data
* description:	Validates remaining event data that is not validated by validate_event_times() and validate_repeat_params()
* parameters:	mixed array $event_data - Optional array containing event data.
*					If any data exists, this data is used for the validation.
*					If false, data is pulled directly from template
* returns:		mixed array $error - List of error messages
* author:		livewirestu
* notes:		Only needs to be called for standard events, as topic events dont use any of the parameteres checked here.
*/
function validate_misc_event_data($event_data = false)
{
	global $user, $db;

	$error = array();

	if ($event_data == false)
	{
		$event_data = array(
			'user_id'		=> request_var('user_id', $user->data['user_id']),
			'event_name'	=> utf8_normalize_nfc(request_var('name','', true)),
			'event_desc'	=> utf8_normalize_nfc(request_var('message', '', true)),
			'event_groups'	=> request_var('group', array('' => 0)),
			'group_cats'	=> request_var('group_select', EVENT_VIEW_BY_PUBLIC),
			'priv_users'	=> request_var('username_list', ''),
		);
	}

	if ($event_data['event_name'] == '')
	{
		$error[] = $user->lang['CALENDAR_NAME_ERROR'];
	}
	if ($event_data['event_desc'] == '')
	{
		$error[] = $user->lang['CALENDAR_DESC_ERROR'];
	}
	if ($event_data['group_cats'] == EVENT_VIEW_BY_GROUPS && !sizeof($event_data['event_groups']))
	{
		$error[] = $user->lang['CALENDAR_MUST_SELECT_GROUP'];
	}
	if ($event_data['group_cats'] == EVENT_VIEW_BY_PRIVATE && !$event_data['priv_users'])
	{
		$error[] = $user->lang['CALENDAR_MUST_SELECT_USER'];
	}

	// Validate usernames if this is a private event
	if ($event_data['group_cats'] == EVENT_VIEW_BY_PRIVATE)
	{
		if (!empty($event_data['priv_users']))
		{
			$event_data['priv_user_list'] = explode("\n", $event_data['priv_users']);

			if (!isset($event_data['priv_user_list']))
			{
				foreach($event_data['priv_user_list'] as $pu)
				{
					$clean_username = utf8_clean_string($pu);
					$sql = 'SELECT username
						FROM ' . USERS_TABLE . "
						WHERE username_clean = '" . $db->sql_escape($clean_username) . "'";
					$result = $db->sql_query($sql);
					$row = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					if (!$row)
					{
						$error[] = sprintf($user->lang['CALENDAR_INVALID_USERNAME'], $pu);
					}
				}
			}
		}
		else
		{
			$error[] = $user->lang['CALENDAR_MUST_SELECT_USER'];
		}
	}

	return $error;
}


/**
* function:
* description:
* parameters:
* returns:
* author:
* notes:
*/
function generate_event_select_options()
{

}

/**
* function:		get_events
* description:	This function now grabs the whole months events in advance if displaying the main calendar
*				instead of querying if there are events on each individual day.
*				Topic events and repeat events are also grabbed here
*				If showing events of the day, only events on that day are fetched.
*				If $period is a number, events will be fetched from the start of the given month to the
*				start of the given month plus the time specified. This is so we can fetch events for the
*				upcoming events list beneath the calendar.
* parameters:	mixed $day - if only retrieving events for a given day
*				mixed $month - used for calculation of event times
*				mixed $year - used for calculation of event times
*				string $period  - either monthly or daily - Will probably include weekly soon also.
*				bool $simple - Used when retrieving events for ajax calendar block. Just returns event start times
* returns:		array $event_array - Array containing full data for all events within specified time range
* author:		livewirestu
* notes:		original function of same name written by John Cottage (jcc264)
*				This version was re-written from scratch, but may contain remnants of John's code
*/
function get_events($day, $month, $year, $period, $simple = false)
{
	global $db, $user, $auth, $phpbb_root_path, $phpEx;

	$user_id = $user->data['user_id'];

	if ($period == 'daily') // Use this when viewing events of a given day
	{
		$time_from = str_to_unix('00:00 am', "$month-$day-$year");
		$time_until = str_to_unix('00:00 am', "$month-" . ($day + 1) . "-$year") - 1 ;
	}
	else if ($period == 'monthly') // Use this when generating the main calendar
	{
		$time_from = str_to_unix('00:00 am', "$month-01-$year");
		$time_until = str_to_unix('00:00 am', ($month + 1) . "-01-$year") - 1;
	}
	else if (is_numeric($period))
	{
		$time_from = str_to_unix('00:00 am', "$month-01-$year");
		$time_until = $time_from + $period;
	}
	else
	{
		$message = $user->lang['UNEXPECTED_ERROR'];
		$message .= '<br /><br />' . $user->lang['RETURN_CALENDAR'];
		$meta_url = append_sid("{$phpbb_root_path}calendar.$phpEx", 'mode=main');
		meta_refresh(3, $meta_url);
		trigger_error($message);
	}

	// Time span has been calculated relative to GMT (UTC).
	// But we want to fetch all events from the GMT equivalent of whatever the local time span is
	$time_from -= ($user->timezone + $user->dst);
	$time_until -= ($user->timezone + $user->dst);

	list($start_date, $start_time) = explode('|', gmdate('m-d-Y|h:i a', $time_from));
	list($end_date, $end_time) = explode('|', gmdate('m-d-Y|h:i a', $time_until));

	// Get all available usergroups so we can fill in the gaps later
	$sql = 'SELECT ug.group_id, g.group_name FROM ' . USER_GROUP_TABLE . '  ug
		INNER JOIN ' . GROUPS_TABLE . ' g
		ON ug.group_id = g.group_id
		ORDER BY ug.group_id';
	$result = $db->sql_query($sql);
	$all_user_groups = array();

	while($grow = $db->sql_fetchrow($result))
	{
		$all_user_groups[$grow['group_id']] = $grow['group_name'];
	}
	$db->sql_freeresult($result);

	// Get all the groups this user is in
	$sql = 'SELECT group_id  FROM ' . USER_GROUP_TABLE . '
		WHERE user_id= ' . $user->data['user_id'] . ' AND user_pending != 1';
	$result = $db->sql_query($sql);
	$this_user_groups = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$this_user_groups[$row['group_id']] = true;
	}

	// Check if we have any repeat events... This is by no means a tidy piece of code!!!
	// We check for repeat events first because they carry no data other than an id and the
	// start and finish times - We look for the relevant associated data later.
	// TODO - Clean this bugger up.... lots
	// Whatever the specified period, we want to first check if there are any repeated instances of
	// events within the specified time frame
	$sql = 'SELECT * FROM ' . CALENDAR_REPEATS_TABLE . "
		WHERE (event_start_time BETWEEN '$time_from' AND '$time_until')
			OR (event_end_time BETWEEN '$time_from' AND '$time_until')
		ORDER BY event_start_time ASC";
	$result = $db->sql_query($sql);
	$repeat_events = $repeat_ids = $e_ids = $t_ids = array();
	while($row = $db->sql_fetchrow($result))
	{
		$repeat_events[] = $row;
		if (substr($row['repeat_id'], 0, 1) == 'e')
		{
			$e_ids[] = substr($row['repeat_id'], 1, 2); // TODO - DUH this only works for 2 digit event codes... Twat
		}
		else if (substr($row['repeat_id'], 0, 1) == 't')
		{
			$t_ids[] = substr($row['repeat_id'], 1, 2); // Same for this
		}
		else
		{
			die('Somthing bad happened');
		}
	}
	$db->sql_freeresult($result);

	// Get all the standard events within the specified time frame.
	// Also, look for data to attach to any repeat events
	$sql = 'SELECT * FROM ' . CALENDAR_TABLE . " c
		INNER JOIN " . USERS_TABLE . " u
		ON c.user_id = u.user_id
		WHERE c.event_start BETWEEN '$time_from' AND '$time_until' ";

	if (sizeof($e_ids))
	{
		$sql .= "OR c.event_id IN (" . implode(',', $e_ids) . ") "; // Getting data for repeat events
	}
	$sql .= 'ORDER BY c.event_start ASC';

	$result = $db->sql_query($sql);
	$event_array = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$repeat_ids[] = "'e" . $row['event_id'] . "'";
		if ($row['event_groups'])
		{
			$event_groups = explode(';', $row['event_groups']);
			$event_groups = array_flip($event_groups);

			// Groups allowed to view event
			if (is_array($event_groups))
			{
				foreach($event_groups as $key => $value)
				{
					$event_groups[$key] = true;
				}
			}

			// Fill in the gaps, i.e., groups not allowed to view event
			if (!isset($all_user_groups))
			{
				foreach($all_user_groups as $g_key => $g_name)
				{
					if (!array_key_exists($g_key, $event_groups))
					{
						$event_groups[$g_key] = false;
					}
				}
			}
		}
		else
		{
			$event_groups = array();
		}

		$priv_users = explode("\n", $row['priv_users']);

		$am_i_in = in_array($user->data['username'], $priv_users);

		$is_authed = false;
		if ($user->data['user_type'] == USER_FOUNDER)	// Big brother is watching you!
		{
			$is_authed = true;
		}
		if ($row['group_cats'] == EVENT_VIEW_BY_PRIVATE && (in_array($user->data['username'], $priv_users)) || $user->data['user_id'] == $row['user_id'])
		{
			$is_authed = true;
		}
		if ($row['group_cats'] == EVENT_VIEW_BY_PUBLIC)
		{
			$is_authed = true;
		}
		if (sizeof(array_intersect_assoc($this_user_groups, $event_groups)) > 0)
		{
			$is_authed = true;
		}
		// Heres the gotcha!
		if (!$auth->acl_get('u_view_event'))
		{
			$is_authed = false;
		}

		if ($is_authed)
		{
			$row['bbcode_options'] =	(($row['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) +
										(($row['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) +
										(($row['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
			$event_array[] = array(
				'event_id'				=> $row['event_id'],
				'event_name'			=> $row['event_name'],
				'desc'					=> $simple ? '' : generate_text_for_display($row['event_desc'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
				'user_id'				=> $row['user_id'],
				'start_time'			=> $row['event_start'] + $user->timezone + $user->dst,
				'end_time'				=> $row['event_end'] + $user->timezone + $user->dst,
				'topic_link'			=> null,
				'invite_attendees'		=> $period == 'daily' ? $row['invite_attendees'] : null,
				'event_attendees'		=> $period == 'daily' ? $row['event_attendees'] : null,
				'event_non_attendees'	=> $period == 'daily' ? $row['event_non_attendees'] : null,
				'info'					=> EVENT_INITIAL_INSTANCE,
			);

			// If any repeat instances of this event occur within the specified time frame, add the
			// event info to each instance
			if (in_array($row['event_id'], $e_ids))
			{
				$last_event_index = sizeof($event_array) - 1;
				if (!isset($repeat_events))
				{
					foreach ($repeat_events as $rep_ev)
					{
						if ($rep_ev['repeat_id'] == ('e' . $row['event_id']))
						{
							$row['bbcode_options'] =	(($row['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) +
														(($row['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) +
														(($row['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);

							$event_array[] = array(
								'event_id'			=> $rep_ev['repeat_id'],
								'event_name'		=> $row['event_name'],
								'desc'				=> $simple ? '' : generate_text_for_display($row['event_desc'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
								'user_id'			=> $row['user_id'],
								'start_time'		=> $rep_ev['event_start_time'] + $user->timezone + $user->dst,
								'end_time'			=> $rep_ev['event_end_time'] + $user->timezone + $user->dst,
								'topic_link'		=> null,
								'invite_attendees'	=> $period == 'daily' ? $row['invite_attendees'] : null,
								'event_attendees'	=> $period == 'daily' ? $row['event_attendees'] : null,
								'event_non_attendees'	=> $period == 'daily' ? $row['event_non_attendees'] : null,
								'info'					=> EVENT_IS_REPEAT,
							);
						}
					}
				}
			}
		}
	}
	$db->sql_freeresult($result);

	// Get topic events
	$sql = "SELECT * FROM ". FORUMS_TABLE . " ORDER BY forum_id";
	if (!$result1 = $db->sql_query($sql))
	{
		trigger_error("Could not query forums information");
	}

	$forum_data = array();

	while( $row1 = $db->sql_fetchrow($result1) )
	{
		$forum_data[] = $row1;
	}

	$except_forum_id = '';

	if (!isset($forum_data))
	{
		foreach ($forum_data as $this_forum)
		{
			if (!$auth->acl_gets('f_list', 'f_read', $this_forum['forum_id']))
			{
				$except_forum_id .= "'" . $this_forum['forum_id'] . "'";
				$except_forum_id .= ",";
			}
		}
	}
	$except_forum_id = rtrim($except_forum_id,",");

	if ($except_forum_id == '')
	{
		$except_forum_id = '0';
	}

	$sql = "SELECT  u.user_id, u.user_type, u.username, u.user_colour, t.topic_id, t.forum_id, t.topic_title, t.topic_poster,
				t.topic_calendar_time, t.topic_calendar_duration, t.event_repeat, t.invite_attendees, t.event_attendees, t.event_non_attendees,
				p.post_text, p.enable_bbcode, p.enable_smilies, p.enable_magic_url, p.bbcode_uid, p.bbcode_bitfield
			FROM " . TOPICS_TABLE . " AS t
			INNER JOIN " . USERS_TABLE . " u
				ON t.topic_poster = u.user_id
			INNER JOIN " . POSTS_TABLE . " p
				ON t.topic_first_post_id = p.post_id
			WHERE t.forum_id NOT IN (" . $except_forum_id . ")
				AND t.topic_status <> 2
				AND t.topic_calendar_time BETWEEN '$time_from' AND '$time_until'";

	if (sizeof($t_ids))
	{
		$sql .= "OR t.topic_id IN (" . implode(',', $t_ids) . ") "; // Getting data for repeat events
	}
	$sql .= 'ORDER BY t.topic_calendar_time ASC';

	if (!$result1 = $db->sql_query($sql))
	{
		trigger_error("Could not get topic events information");
	}
	$topic_event_row = array();

	while($row = $db->sql_fetchrow($result1))
	{
		$repeat_ids[] = "'t" . $row['topic_id'] . "'";

		$row['bbcode_options'] =	(($row['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) +
									(($row['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) +
									(($row['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
		$event_array[] = array(
			'event_id'				=> null, // This lets calling function know this is a topic event
			'event_name'			=> $row['topic_title'],
			'desc'					=> $simple ? '' : generate_text_for_display($row['post_text'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
			'user_id'				=> $row['user_id'],
			'start_time'			=> $row['topic_calendar_time'] + $user->timezone + $user->dst,
			'end_time'				=> $row['topic_calendar_time'] + $row['topic_calendar_duration'] + $user->timezone + $user->dst,
			'topic_link'			=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;t=' . $row['topic_id']),
			'invite_attendees'		=> $row['invite_attendees'],
			'event_attendees'		=> $row['event_attendees'],
			'event_non_attendees'	=> $row['event_non_attendees'],
			'info'					=> EVENT_INITIAL_INSTANCE,
		);

		// If any repeat instances of this event occur within the specified time frame, add the
		// event info to each instance
		if (in_array($row['topic_id'], $t_ids))
		{
			$last_event_index = sizeof($event_array) - 1;
			if (!isset($repeat_events))
			{
				foreach($repeat_events as $rep_ev)
				{
					if ($rep_ev['repeat_id'] == ('t' . $row['topic_id']))
					{
						$row['bbcode_options'] =	(($row['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) +
													(($row['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) +
													(($row['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
						$event_array[] = array(
							'event_id'				=> null, // This lets calling function know this is a topic event
							'event_name'			=> $row['topic_title'],
							'desc'					=> $simple ? '' : generate_text_for_display($row['post_text'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
							'user_id'				=> $row['user_id'],
							'start_time'			=> $rep_ev['event_start_time'] + $user->timezone + $user->dst,
							'end_time'				=> $rep_ev['event_end_time'] + $user->timezone + $user->dst,
							'topic_link'			=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;t=' . $row['topic_id']),
							'invite_attendees'		=> $row['invite_attendees'],
							'event_attendees'		=> $row['event_attendees'],
							'event_non_attendees'	=> $row['event_non_attendees'],
							'info'					=> EVENT_IS_REPEAT,
						);
					}
				}
			}
		}
	}
	$db->sql_freeresult($result);

	if ($period == 'daily' && !empty($repeat_ids))
	{
		// Now get repeat event dates and add them to their master event.
		$sql = "SELECT repeat_id, event_start_time FROM " . CALENDAR_REPEATS_TABLE . "
			WHERE repeat_id IN (" . implode(',', $repeat_ids) . ")
			ORDER BY event_start_time ASC;";
		$result = $db->sql_query($sql);
		$rep_instances = array();
		$rep_instances['e'] = array();
		$rep_instances['t'] = array();

		while($row = $db->sql_fetchrow($result))
		{
			// Split results into topic events and standard events
			$type = substr($row['repeat_id'], 0, 1);
			$id = substr($row['repeat_id'], 1);
			// Group all repeated instances of each event together by id and type
			$rep_instances[$type][$id][] = $row['event_start_time'];
		}
		if (!isset($event_array))
		{
			foreach($event_array as &$e)
			{
				if ($e['topic_link'] == null)
				{
					if (array_key_exists($e['event_id'], $rep_instances['e']))
					{
						$e['repeats'] = $rep_instances['e'][$e['event_id']];
						$e['info'] |= EVENT_HAS_REPEATS;
					}
				}
				else
				{
					$eid = substr(stristr($e['topic_link'], 't='), 2);
					if (array_key_exists($eid, $rep_instances['t']))
					{
						$e['repeats'] = $rep_instances['t'][$eid];
						$e['info'] |= EVENT_HAS_REPEATS;
					}
				}
			}
		}
	}

	// Mark continued events as such and delete any events which were queried purely to get info for repeat event instances
	for ($i = 0, $s = sizeof($event_array) ; $i < $s ; $i++)
	{
		if (($event_array[$i]['start_time'] < $time_from) && ($event_array[$i]['end_time'] > $time_from))
		{
			$event_array[$i]['info'] |= EVENT_IS_CONTINUED;
		}
		if ($event_array[$i]['end_time'] < $time_from)
		{
			unset($event_array[$i]);
		}
		// Now adjust event times to suit the user's timezone and dst settings
//		$event_array[$i]['start_time'] += $user->timezone + $user->dst;
//		$event_array[$i]['end_time'] += $user->timezone + $user->dst;
	}

	// This nifty piece of code sorts a multidimensional array by a chosen index :)
	usort($event_array, create_function('$a1, $a2', "return strnatcmp(\$a1['start_time'], \$a2['start_time']);"));
	return $event_array;
}

/**
* function:		generate_repeat_event_info
* description:	This is the best way I could think of to create repeat events. Was difficult to avoid extra db
*				overhead for the following reasons:
*				We store repeat details of the initial event as a 4-8 digit alphanumeric code.
*				When retrieving events for the calendar view and the main event listing view, if we just tried to
*				compute the events from the event code of the initial event, we would have to go back an indefinite
*				amount of time to check. I.e., say, for example, an event had 99 repeats, on the third wednesday
*				of June every year... Or it had 99 repeats on the nth day every month... etc...
*				Every time we fetch events, we would pretty much have to go back and analyse every event made in the
*				past 99 years (far fetched I know). Then, we would need to calculate every permutation of every event
*				to generate the dates of each event with which we could compare with the date queried by the user.
*				So... Instead we create an event for each repeated occurence - However, to avoid
*				bloating the database by adding a complete calendar / topic event for each one, a stripped down
*				version is stored, containing just the event id and the start / end times. The rest of the data
*				for the event is stored in the main calendar or topics tables, in the initial event
*				This way, times and dates of an anomolous repeat event could be altered if necessary...
*				I.e., say you have a repeat event which runs every thursday for 10 weeks but on the 6th week
*				it needs to happen on wednesday or something - Or if there is no event on the 3rd week, etc...
* parameters:	mixed $ev_id - event id - can be 't' or 'e' prefixed depending on whether it is a
*				standard event or a topic event - The numerical suffix will match the id of the initial event
* returns:		array $repeat_events_info
*					=> values - string of values which can eventually be commited directly to the db
*					=> details - Textual information about the repeated event
*					=> list - Times and dates of each event (initial and repeated events)
* author:		livewirestu
* notes:		Nothing is actually committed to the database here - We simply return data. The calling
*				function must decide how to handle it
*/
function generate_repeat_event_info($ev_id, $start_time, $end_time, $repeat_code)
{
	global $db, $user, $nth_position_list, $weekday_list, $month_list;

	$repeat_when = substr($repeat_code, 0, 2);
	$repeat_count = (int)substr($repeat_code, 2, 2);

	$values = '';

	list($hr, $min, $mon, $day, $yr) = explode(',', gmdate('H,i,m,d,Y', $start_time));

	$message_event_list = str_replace(' ', '&nbsp;', sprintf("%-20s", $user->lang['INITIAL_EVENT'] . ')')) . $user->lang['CALENDAR_EVENT_START'] . ': ' . gmdate('m/d/Y, H:i:s', ($start_time + $user->timezone + $user->dst)) . ' - ' . $user->lang['CALENDAR_EVENT_END'] . ': ' . gmdate('m/d/Y, H:i:s', (($start_time + $user->timezone + $user->dst)+ ($end_time - $start_time))) . '<br />';

	switch($repeat_when)
	{
		case 'DD':
			$message_event_details = $user->lang['PERIOD_DAYS'];
			for ($i = 0 ; $i < $repeat_count ; $i++)
			{
				$start_rep_time = gmmktime($hr, $min, 0, $mon, ($day + $i + 1), $yr);
				$end_rep_time = $start_rep_time + ($end_time - $start_time);
				$values .= "('$ev_id','$start_rep_time','$end_rep_time'),";
				$message_event_list .= str_replace(' ', '&nbsp;', sprintf("%-20s", $user->lang['REPEAT'] . ' ' . ($i + 1) . ')')) . $user->lang['CALENDAR_EVENT_START'] . ': ' . gmdate('m/d/Y, H:i:s', $start_rep_time + $user->timezone + $user->dst) . ' - ' . $user->lang['CALENDAR_EVENT_END'] . ': ' . gmdate('m/d/Y, H:i:s', $end_rep_time + $user->timezone + $user->dst) . '<br />';
			}
		break;

		case 'WW':
			$message_event_details = $user->lang['PERIOD_WEEKS'];
			for ($i = 0 ; $i < $repeat_count ; $i++)
			{
				$start_rep_time = gmmktime($hr, $min, 0, $mon, ($day + (($i + 1) * 7)), $yr);
				$end_rep_time = $start_rep_time + ($end_time - $start_time);
				$values .= "('$ev_id','$start_rep_time','$end_rep_time'),";
				$message_event_list .= str_replace(' ', '&nbsp;', sprintf("%-20s", $user->lang['REPEAT'] . ' ' . ($i + 1) . ')')) . $user->lang['CALENDAR_EVENT_START'] . ': ' . gmdate('m/d/Y, H:i:s', $start_rep_time + $user->timezone + $user->dst) . ' - ' . $user->lang['CALENDAR_EVENT_END'] . ': ' . gmdate('m/d/Y, H:i:s', $end_rep_time + $user->timezone + $user->dst) . '<br />';
			}
		break;

		case 'MM':
			$message_event_details = $user->lang['PERIOD_MONTHS'];
			for ($i = 0 ; $i < $repeat_count ; $i++)
			{
				$start_rep_time = gmmktime($hr, $min, 0, ($mon + $i + 1), $day, $yr);
				$end_rep_time = $start_rep_time + ($end_time - $start_time);
				$values .= "('$ev_id','$start_rep_time','$end_rep_time'),";
				$message_event_list .= str_replace(' ', '&nbsp;', sprintf("%-20s", $user->lang['REPEAT'] . ' ' . ($i + 1) . ')')) . $user->lang['CALENDAR_EVENT_START'] . ': ' . gmdate('m/d/Y, H:i:s', $start_rep_time + $user->timezone + $user->dst) . ' - ' . $user->lang['CALENDAR_EVENT_END'] . ': ' . gmdate('m/d/Y, H:i:s', $end_rep_time + $user->timezone + $user->dst) . '<br />';
			}
		break;

		case 'YY':
			$message_event_details = $user->lang['PERIOD_YEARS'];
			for ($i = 0 ; $i < $repeat_count ; $i++)
			{
				$start_rep_time = gmmktime($hr, $min, 0, $mon, $day, ($yr + $i + 1));
				$end_rep_time = $start_rep_time + ($end_time - $start_time);
				$values .= "('$ev_id','$start_rep_time','$end_rep_time'),";
				$message_event_list .= str_replace(' ', '&nbsp;', sprintf("%-20s", $user->lang['REPEAT'] . ' ' . ($i + 1) . ')')) . $user->lang['CALENDAR_EVENT_START'] . ': ' . gmdate('m/d/Y, H:i:s', $start_rep_time + $user->timezone + $user->dst) . ' - ' . $user->lang['CALENDAR_EVENT_END'] . ': ' . gmdate('m/d/Y, H:i:s', $end_rep_time + $user->timezone + $user->dst) . '<br />';
			}
		break;

		case 'WM':  // nth weekday every n months
			$nth_which = substr($repeat_code, 4, 1);
			$nth_day = substr($repeat_code, 5, 1);
			$n_months = (int)substr($repeat_code, 6, 2);
			$message_event_details = sprintf($user->lang['NTH_DAY_N_MONTHS_DETAILS'], strtolower($nth_position_list[$nth_which]), $weekday_list[$nth_day], $n_months);

			for ($i = 0 ; $i < $repeat_count ; $i++)
			{
				$mon += $n_months;
				$start_rep_time = nth_weekday_to_unix($nth_which, $nth_day, $mon, $yr) + ($hr * 3600) + ($min * 60);
				$end_rep_time = $start_rep_time + ($end_time - $start_time);
				$values .= "('$ev_id','$start_rep_time','$end_rep_time'),";
				$message_event_list .= str_replace(' ', '&nbsp;', sprintf("%-20s", $user->lang['REPEAT'] . ' ' . ($i + 1) . ')')) . $user->lang['CALENDAR_EVENT_START'] . ': ' . gmdate('m/d/Y, H:i:s', $start_rep_time + $user->timezone + $user->dst) . ' - ' . $user->lang['CALENDAR_EVENT_END'] . ': ' . gmdate('m/d/Y, H:i:s', $end_rep_time + $user->timezone + $user->dst) . '<br />';
			}
		break;

		case 'WY':  // nth weekday of nth month every year
			$nth_which = substr($repeat_code, 4, 1);
			$nth_day = substr($repeat_code, 5, 1);
			$nth_month = substr($repeat_code, 6, 1);
			$message_event_details = sprintf($user->lang['NTH_DAY_NTH_MONTH_EACH_YEAR_DETAILS'], strtolower($nth_position_list[$nth_which]), $weekday_list[$nth_day], $month_list[$nth_month]);

			for ($i = 1 ; $i <= $repeat_count ; $i++)
			{
				$start_rep_time = nth_weekday_to_unix($nth_which, $nth_day, $mon, ($yr + $i)) + ($hr * 3600) + ($min * 60);
				$end_rep_time = $start_rep_time + ($end_time - $start_time);
				$values .= "('$ev_id','$start_rep_time','$end_rep_time'),";
				$message_event_list .= str_replace(' ', '&nbsp;', sprintf("%-20s", $user->lang['REPEAT'] . ' ' . $i . ')')) . $user->lang['CALENDAR_EVENT_START'] . ': ' . gmdate('m/d/Y, H:i:s', $start_rep_time + $user->timezone + $user->dst) . ' - ' . $user->lang['CALENDAR_EVENT_END'] . ': ' . gmdate('m/d/Y, H:i:s', $end_rep_time + $user->timezone + $user->dst) . '<br />';
			}

		break;

		default:
		return 0;
	}

	// We return all necessary information here - The calling function decides whether we are chucking stuff in
	// the database or just providing the list to the user for confirmation that they want to add the events
	$repeat_events_info = array(
		'values'	=> rtrim($values, ','),
		'details'	=> $message_event_details,
		'list'		=> $message_event_list
	);

	return $repeat_events_info;
}

/**
* function:		generate_repeat_link_list
* description:	Generates a list of repeat dates for an event, with links to each repeated event instance
* parameters:	mixed array $repeat - Array of repeated dates in UNIX timestamp format
* returns:		mixed array - html code to directly assign to template
* author:		livewirestu
* notes:
*/
function generate_repeat_link_list($repeat)
{
	global $user, $phpEx, $phpbb_root_path;

	if (!sizeof($repeat))
	{
		$str = $user->lang['NO_REPEATS_FOUND'];
	}
	else
	{
		$str = '';
		if (!isset($repeat))
		{
			foreach($repeat as $r)
			{
				$r += $user->timezone + $user->dst;
				list($m, $d, $y) = explode(',', gmdate('m,d,Y', $r));
		//		  $str .= '<a href="'.append_sid("{$phpbb_root_path}calendar.$phpEx", 'mode=view&month=' . $m . '&day=' . $d . '&year=' . $y) . '">' . gmdate($user->date_format, $r) . '</a>, ';
				$str .= '<a href="'.append_sid("{$phpbb_root_path}calendar.$phpEx", 'mode=view&month=' . $m . '&day=' . $d . '&year=' . $y) . '">' . gmdate($user->date_format, $r) . '</a>, ';
			}
		}
	}
	return $str;
}

/**
* function:		put_repeat_events
* description:	Adds repeat events to the database
* parameters:	mixed $mode - Should only be 'edit', 'main' or 'new'
* returns:		True if operation was successful, else false
* author:		livewirestu
* notes:		Note that this only adds the repeated instances of an event - The initial (main instance) of
*				the event should have already been added before calling this function
*/
function put_repeat_events($mode, &$event_data)
{
	global $db;

	// First things first, is this a standard event or a topic event?
	$event_type = isset($event_data['event_id']) ? 'e' : 't';
	$rep_code = $event_data['event_repeat'];
	$id = $event_type . (!empty($event_data['event_id']) ? $event_data['event_id'] : $event_data['topic_id']);
	$start_time = !empty($event_data['event_start']) ? $event_data['event_start'] : $event_data['topic_calendar_time'];
	$end_time = !empty($event_data['event_end']) ? $event_data['event_end'] : ($event_data['topic_calendar_time'] + $event_data['topic_calendar_duration']);

	$event_list = generate_repeat_event_info(($id), $start_time, $end_time, $event_data['event_repeat']);
	$event_list = $event_list['values'];

	// If we are editing, delete any repeat events already associated with this event
	if ($mode == 'edit')
	{
		$sql = 'DELETE FROM ' . CALENDAR_REPEATS_TABLE . "
			WHERE repeat_id = '" . $id . "'";
		$db->sql_query($sql);
	}

	$sql = 'INSERT INTO ' . CALENDAR_REPEATS_TABLE . ' (repeat_id, event_start_time, event_end_time) VALUES ' . $event_list;
	$db->sql_query($sql);
}

/**
* function:		extract_repeat_params
* description:	Splits repeat code and assigns the parts to the passed event data array
* parameters:	string $repeat_code - The repeat code string
* returns:		None - $target array altered by reference
* author:		livewirestu
* notes:		This function is generally only used when editing or correcting event details
*				Used pointer to increase efficiency and reduce stack
*/
function extract_repeat_params($repeat_code, &$target_array)
{
	$target_array['event_repeat_when'] = substr($target_array['event_repeat'], 0, 2);
	$target_array['event_repeat_count'] = substr($target_array['event_repeat'], 2, 2);
	if (strlen($target_array['event_repeat']) > 4);
	{
		// nth weekday of nth month every year?
		if (substr($target_array['event_repeat'], 7, 1) == ' ')
		{
			$target_array['repeat_nth_pos'] = '-';
			$target_array['repeat_nth_weekday'] = '-';
			$target_array['repeat_nth_count'] = '--';
			$target_array['nth_month_position'] = substr($target_array['event_repeat'], 4, 1);
			$target_array['nth_month_weekday'] = substr($target_array['event_repeat'], 5, 1);
			$target_array['nth_month_month'] = substr($target_array['event_repeat'], 6, 1);
		}
		else
		{
			$target_array['repeat_nth_pos'] = substr($target_array['event_repeat'], 4, 1);
			$target_array['repeat_nth_weekday'] = substr($target_array['event_repeat'], 5, 1);
			$target_array['repeat_nth_count'] = substr($target_array['event_repeat'], 6, 2);
			$target_array['nth_month_position'] = '-';
			$target_array['nth_month_weekday'] = '-';
			$target_array['nth_month_month'] = '-';
		}
	}
}

/**
* function:		nth_weekday_to_unix
* description:	Converts the nth weekday of the month of a given year to a UNIX timestamp
* parameters:	string $nth_position - i.e., first, second, third, fourth or last
* returns:		UNIX timestamp
* author:		livewirestu
* notes:		The part of strtotime() which gets a date from something like 'Second Wednesday' is crap. Hence this function...
*				$nth position and $weekday are extracted from the event repeat code before calling this gfunction
*/
function nth_weekday_to_unix($nth_position, $weekday, $mon, $yr )
{
	$offsets = array(
		'F' => 0,   // First
		'S' => 7,   // Second
		'T' => 14,  // Third
		'O' => 21,  // Fourth
		'L' => -7   // Last
	);

	$wdays = array(
		'S' => 0,   // Sunday
		'M' => 1,   // Monday
		'T' => 2,   // Tuesday
		'W' => 3,   // Wednesday
		'H' => 4,   // Thursday
		'F' => 5,   // Friday
		'A' => 6,   // Saturday
	);

	if ($nth_position == 'L')
	{
		$mon += 1;
	}

	$stamp = gmmktime(0, 0, 0, $mon, 1, $yr);
	$temp_time = $wdays[$weekday] - gmdate('w', $stamp);

	return gmmktime( 0, 0, 0, $mon, (($temp_time < 0 ? $temp_time + 7 : $temp_time) + $offsets[$nth_position] + 1), $yr );
}

/**
* function:		get_users_groups
* description:	Gets the groups the user belongs to
* parameters:	mixed $this_user_id - id of the current user
* returns:		array $user_groups - an array of groups the user belongs to
* author:		livewirestu
* notes:		Based on original function by John Cottage (jcc264)
*/
function get_users_groups($this_user_id)
{
	global $db, $user;

	// Get user groups
	$sql = 'SELECT ug.group_id, g.group_name FROM ' . USER_GROUP_TABLE . '  ug
		  INNER JOIN ' . GROUPS_TABLE . ' g
		  ON ug.group_id=g.group_id
		  WHERE ug.user_id=' . $this_user_id . ' AND ug.user_pending <> 1
		  ORDER BY ug.group_id';
	$result = $db->sql_query($sql);
	$user_groups = array();

	while($grow = $db->sql_fetchrow($result))
	{
	   $user_groups[$grow['group_id']] = $grow['group_name'];
	}
	$db->sql_freeresult($result);

	return $user_groups;
}

/**
* function:		get_birthdays
* description:	Retrieves all birthdays within the specified timeframe
* parameters:	mixed $day - starting day of specified period to retrieve birthdays from
*				mixed $month - starting month of specified period to retrieve birthdays from
*				mixed $year - Starting year of specified period to retrieve birthdays from
*				mixed $period - Number of days in advance to retrieve birthdays
* returns:		mixed array $birthday_array
*					=> name
*					=> username
*					=> age
*					=> birthday
* author:		livewirestu
* notes:		Birthdays are stored in textual format in the db - This makes it tough to specify long periods
*				when retrieving birthdays. Hence can only retrieve birthdays up to the end of the month after $month
*				Acp option limits maximum period from date specified in which to retrieve birthdays to (TODO) 31 days
*				Complete rewrite of original code by John Cottage (jcc264)
*/
function get_birthdays($day, $month, $year, $period)
{
	global $db, $user;

	if ($period == 'daily') // Use this when viewing events of a given day
	{
		$bday_date = str_to_unix('00:00 am', "$month-$day-$year") + 1;
	}
	else if ($period == 'monthly') // Use this when generating the main calendar
	{
		$bday_date = str_to_unix('00:00 am', "$month-01-$year") + 1;
	}
	else if (is_numeric($period))
	{
		// Because users birthdays are stored in a dumb format in the db, its really
		// difficult to extract dates between two specific dates. So, we check if the
		// user's selected dates span for birthdays covers two seperate months.
		// If so, we just use two wildcards.
		$bday_date = $time_from = gmdate('U') + $user->timezone + $user->dst;
		$time_until = $time_from + $period;
		if (gmdate('m', $time_until) > gmdate('m', $time_from))
		{
			$next_month = getdate($time_from);
			$next_month['mon'] = ($next_month['mon'] >= 12) ? 0 : $next_month['mon'] + 1;
			$m = $next_month['mon'] > 9 ? $next_month['mon'] : ' ' . $next_month['mon'];
			$wildcard2 = "%-$m-%";
		}
	}
	else
	{
		$message = $user->lang['UNEXPECTED_ERROR'];
		$message .= '<br /><br />' . $user->lang['RETURN_CALENDAR'];
		$meta_url = append_sid("{$phpbb_root_path}calendar.$phpEx", 'mode=main');
		meta_refresh(3, $meta_url);
		trigger_error($message);
	}

	$now = getdate($bday_date);
	$d = $now['mday'] > 9 ? $now['mday'] : ' ' . $now['mday'];
	$m = $now['mon'] > 9 ? $now['mon'] : ' ' . $now['mon'];

	// If period is numeric, for now we get the same format as if period was 'monthly'
	$wildcard = $period == 'daily' ? "$d-$m-%" : "%-$m-%";

	// If birthday list spans two seperate months, add another clause to the sql query.
	if (is_numeric($period) && isset($wildcard2))
		$wildcard .= "' OR user_birthday LIKE '$wildcard2";


	$sql = 'SELECT user_id, username, user_colour, user_birthday
		FROM ' . USERS_TABLE . "
		WHERE user_birthday LIKE '$wildcard'
		AND user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')';
	$result = $db->sql_query($sql);

	$birthday_array = array();
	$birthday_count=0;
	while ($row = $db->sql_fetchrow($result))
	{
		list($_d, $_m, $_y) = explode('-', str_replace(' ', '', $row['user_birthday']));
		$birthday_count++;
		$birthday_array[$birthday_count] = array(
			'name'		=> $row['username'],
			'username'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
			'age'		=> intval(substr($row['user_birthday'], -4)) == 0 ? '?' : gmdate("Y") - intval(substr($row['user_birthday'], -4)),
			'birthday'	=> gmmktime(0, 0, 0, (int)$_m, (int)$_d, (int)$year),
		);
	}
	$db->sql_freeresult($result);
	return $birthday_array;
}

/**
* function:		str_to_unix
* description:	Converts the time and date generated via the javascript date picker to a UNIX timestamp
* parameters:	mixed $t - time in hh:mm am/pm format (h:mm am/pm is also valid)
*				mixed $d - date in mm/dd/yyyy format
* returns:		UNIX timestamp
* author:		livewirestu
* notes:		Ensure that parameters are valid in check_time and check_date functions before passing them here
*/
function str_to_unix($t, $d)
{
	list($hour, $min, $ampm, $month, $day, $year) = preg_split("[\s|\:|\-]", $t . ' ' .  $d);
	if (!isset($hour, $min, $ampm, $month, $day, $year))
	{
		return null;
	}
	$hour = (int)$hour;
	if ($ampm == 'am')
	{
		if ($hour == 12)
		{
			$hour = 0; //ie just after midnight
		}
	}
	else
	{
		if ($hour < 12)
		{
			$hour = $hour+12;
		}
	}

	return gmmktime($hour, (int)$min, 0, (int)$month, (int)$day, (int)$year);
}

/**
* function:		calc_duration
* description:	Calculated the difference between two dates and returns in human readable format
* parameters:	mixed $start - start time (UNIX)
*				mixed $end - end time (UNIX)
* returns:		string
* author:		livewirestu
* notes:		example of returned string: '6 days, 4 hours, 25 minutes'
*				Uses lang vars for 'days', 'hours' and 'minutes'
*/
function calc_duration($start, $end)
{
	global $user;

	$duration_seconds = $end - $start;
	$days = (int)($duration_seconds / (24 * 60 * 60));
	$hours = (int)($duration_seconds / (60 * 60) - ($days * 24) );
	$minutes = (int)($duration_seconds / 60) - ($days * (24 * 60) ) - ($hours * 60);
	return $days . ($days == 1 ? $user->lang['DAY'] : $user->lang['DAYS']) . $hours . ($hours == 1 ? $user->lang['HOUR'] : $user->lang['HOURS']) . $minutes . ($minutes == 1 ? $user->lang['MINUTE'] : $user->lang['MINUTES']);
}

/**
* function:
* description:
* parameters:
* returns:
* author:
* notes:		MIGHT PICK THIS PART UP AGAIN AT SOME POINT
*/
function generate_mini_cal($cal_id)
{
	global $user;

	$datebox = '{L_DATE}:<input class="post" type="text" name="' . $cal_id . '_date" id="' . $cal_id . '_date" size="10" maxlength="10" tabindex="3" value="{DATE_IN}" readonly="readonly" onfocus="date_show(this);" onclick="event.cancelBubble=true;date_show(this);"/>';

	$cal_string = '<div id="' . $cal_id . '_date_container' . '" style=" position:absolute;">';
	$cal_string .= '<table id="calender_end" style="border-collapse:collapse;background:#FFFFFF;border:1px solid #ABABAB;" cellpadding="2">';
	$cal_string .= '<tr><td style="cursor:pointer;" onclick="prev_month(\'' . $cal_id . '\');"><img src="images/arrowleftmonth.gif"></td><td colspan="5" id="' . $cal_id . '_month_name" align="center" style="font:bold 13px Arial;"></td><td align="right" style="cursor:pointer;" onclick="next_month(\'' . $cal_id . '\');"><img src="images/arrowrightmonth.gif"></td></tr>';

	$day_initial_langname = $user->lang['CAL_CALENDAR']['DAY_INITIAL'];
	$cal_string .= '<tr>';
	if (!isset($day_initial_langname))
	{
		foreach($day_initial_langname as $day_init)
		{
			$cal_string .= '<td align=center style="background:#ABABAB;font:12px Arial">' . $day_init . '</td>';
		}
	}
	$cal_string .= '</tr>';

	$td_count = 1;
	// 6 rows
	for($i = 0 ; $i < 6 ; $i++)
	{
		$cal_string .= '<tr class="row1">';
		// 7 days in a week
		for($j = 0 ; $j < 7 ; $j++)
		{
			$cal_string .= '<td id="' . $cal_id . '_d' . $td_count++ . '" style="border: 1px;width: 18px; height: 18px;">&nbsp;</td>';
		}
		$cal_string .= '</tr>';
	}
	$cal_string .= '</table></div>';

	$mini_cal = array();
	$mini_cal['datebox'] = $datebox;
	$mini_cal['calendar'] = $cal_string;

	return $mini_cal;
}

?>