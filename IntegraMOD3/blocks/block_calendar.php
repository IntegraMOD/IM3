<?php
/**
*
* @package phpBB3
* @version $Id: calendar_view.php,v 1.000 2007/09/18 10:00:00 Jcc264 Exp $
* @copyright (c) 2007 M and J Media
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
/**
* Rewritten for Stargate Portal by Michae O'Toole copyright 2007
* @package phpBB3
* @version $Id: block_calendar.php,v 1.000 2007/09/28 22:45:00 Michaelo Exp $
* @copyright (c) 2007 phpbbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}
$phpEx = substr(strrchr(__FILE__, '.'), 1);

global $db, $user, $template, $auth, $phpEx, $phpbb_root_path, $config;

// Start session management
/*
$user->session_begin();
$auth->acl($user->data);
*/

$user->setup('mods/calendar');
// Note this file is included after user->setup(), to ensure that some globals in functions_calendar.php can
// find the $user->lang array
include($phpbb_root_path . 'includes/functions_calendar.'.$phpEx);

// Lets start outputting the calendar table. Note that we don't put any information in the tables yet,
// this will be done using ajax, thus avoiding page refreshes when changing the calendar month on the block
// First, build the header, where the day initials will go.

$calendar_table = '<tr class="cal_block_header">';
for($y = 0 ; $y < 7 ; $y++)
{
    $calendar_table .= '<td id="cal_dname_' . $y . '" class="xrow1" align="center" width="14%"></td>';
}
$calendar_table .= '</tr>';

// Now build the grid of calendar days (7 x 6)
for($y = 1 ; $y <= 6 ; $y++)
{
    $calendar_table .= '<tr id="r' . $y . '">';
    for($x = 1 ; $x <= 7 ; $x++)
    {
        $calendar_table .= '<td class="calendar" align="center" id="cal_' . (($y * 7) -7 + $x) . '" height="15"></td>';
    }
    $calendar_table .= '</tr>';

}

$template->assign_vars(array(
    'CALENDAR_TABLE'            => $calendar_table,
	'U_CALENDAR_MAIN'           => append_sid($phpbb_root_path . 'calendar.' . $phpEx . "?mode=main"),
    'HIDDEN_MONTH'              => gmdate('n', time() + $user->timezone + $user->dst),
    'HIDDEN_YEAR'               => gmdate('Y', time() + $user->timezone + $user->dst),
    'S_SGP_AJAX'                => true,
));


if($config['calendar_override_user'] == true)
{
    $s_show_upcoming_events     = $config['calendar_show_events_list'];
    $upcoming_events_days       = $config['calendar_default_events_list_days'];
    $s_show_upcoming_birthdays  = $config['calendar_show_birthdays_list'];
    $upcoming_birthdays_days    = $config['calendar_default_bdays_list_days'];
}
else
{
    $s_show_upcoming_events     = (isset($_COOKIE[$config['cookie_name'] . '_' . 'cal_events_list'])) ? $_COOKIE[$config['cookie_name'] . '_' . 'cal_events_list'] : $config['calendar_show_events_list'];
    $upcoming_events_days       = (isset($_COOKIE[$config['cookie_name'] . '_' . 'cal_upcoming_events_days'])) ? $_COOKIE[$config['cookie_name'] . '_' . 'cal_upcoming_events_days'] : $config['calendar_max_events_list_days'];
    $s_show_upcoming_birthdays  = (isset($_COOKIE[$config['cookie_name'] . '_' . 'cal_birthdays_list'])) ? $_COOKIE[$config['cookie_name'] . '_' . 'cal_birthdays_list'] : $config['calendar_show_birthdays_list'];
    $upcoming_birthdays_days    = (isset($_COOKIE[$config['cookie_name'] . '_' . 'cal_upcoming_birthdays_days'])) ? $_COOKIE[$config['cookie_name'] . '_' . 'cal_upcoming_birthdays_days'] : $config['calendar_max_bdays_list_days'];
}

$is_events = false;
$is_birthdays = false;

if($s_show_upcoming_events || $s_show_upcoming_birthdays)
{
    $now_month = gmdate('m', time() + $user->timezone + $user->dst);
    $now_year = gmdate('Y', time() + $user->timezone + $user->dst);
    $start_of_next_month = str_to_unix('00:00 am', ($now_month + 1) . "-01-$now_year") - 1;

    if($s_show_upcoming_events)
    {
        if($config['calendar_override_user'])
        {
            $event_list_date_span = $config['calendar_default_events_list_days'];
        }
        else
        {
            // Check how many days worth of events the user would like to view
            $event_list_date_span = $upcoming_events_days > $config['calendar_max_events_list_days'] ? $config['calendar_max_events_list_days'] : $upcoming_events_days;
        }
        $event_list_end_time = (time() + $user->timezone + $user->dst) + ($event_list_date_span * 24 * 60 * 60) - 1;

        $period = $event_list_end_time - str_to_unix('00:00 am', "$now_month-01-$now_year");
        $upcoming_events = get_events(0, $now_month, $now_year, $period);

        $is_events = false;
		if (is_array($upcoming_events)) {
        foreach ($upcoming_events as $event)
        {
            if(($event['end_time'] > (time() + $user->timezone + $user->dst )) && $event['start_time'] < ($event_list_end_time + $user->timezone + $user->dst))
            {
                list($m, $d, $y) = explode(',', gmdate('m,d,Y', ($event['start_time'] + $user->timezone + $user->dst)));
                $template->assign_block_vars('event_list', array(
                    'TITLE'      => '<a href="calendar.php?mode=view&month=' . $m . '&day=' . $d . '&year=' . $y . '" title="' . $event['event_name'] . '">' . $event['event_name'] . '</a>',
                    'DATE'      => gmdate('D jS M', $event['start_time']),
                    'TIME'      => gmdate('H:i', $event['start_time']),
                ));
                $is_events = true;
            }
        }
		}
    }

    if($s_show_upcoming_birthdays)
    {
        if($config['calendar_override_user'])
        {
            $birthday_list_date_span = $config['calendar_default_bdays_list_days'];
        }
        else
        {
            // Check how many days worth of birthdays the user would like to view
            $birthday_list_date_span = $upcoming_birthdays_days > $config['calendar_max_bdays_list_days'] ? $config['calendar_max_bdays_list_days'] : $upcoming_birthdays_days;
        }
        $birthday_list_end_time = time() + ($birthday_list_date_span * 24 * 60 * 60) - 1;

        $period = $birthday_list_end_time - str_to_unix('00:00 am', "$now_month-01-$now_year");
        $upcoming_birthdays = get_birthdays(0, $now_month, $now_year, $period);

        $is_birthdays = false;
		if (is_array($upcoming_birthdays)) {
        foreach($upcoming_birthdays as $bday)
        {
            list($m, $d, $y) = explode ('/', gmdate('n/j/Y', time() + $user->timezone + $user->dst));
            $bday_date = gmmktime(0, 0, 0, (int)$m, (int)$d, (int)$y);
            if(($bday['birthday'] >= $bday_date) && $bday['birthday'] <= $birthday_list_end_time)
            {
                $template->assign_block_vars('bday_list', array(
                    'USERNAME_FULL' => $bday['username'],
                    'AGE'           => $bday['age'],
                    'ON_DAY'        => gmdate('D jS M', $bday['birthday']),
                ));
                $is_birthdays = true;
            }
        }
		}
    }
}

$template->assign_vars(array(
	'S_NEW_EVENT'				=> $auth->acl_get('u_new_event') or ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')),

    'S_SHOW_UPCOMING_EVENTS'    => $s_show_upcoming_events,
    'UPCOMING_EVENTS_DAYS'      => $upcoming_events_days,
    'L_EVENTS_TIMEFRAME'        => sprintf($user->lang['UPCOMING_EVENTS_TIME_FRAME'], $upcoming_events_days),
    'S_IS_EVENTS'               => $is_events ? true : false,

    'S_SHOW_UPCOMING_BIRTHDAYS' => $s_show_upcoming_birthdays,
    'UPCOMING_BIRTHDAYS_DAYS'   => $upcoming_birthdays_days,
    'L_BIRTHDAYS_TIMEFRAME'     => sprintf($user->lang['UPCOMING_EVENTS_TIME_FRAME'], $upcoming_birthdays_days),
    'S_IS_BIRTHDAYS'            => $is_birthdays ? true : false,
));



?>