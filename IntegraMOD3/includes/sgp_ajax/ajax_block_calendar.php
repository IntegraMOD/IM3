<?php
/**
*
* @package sgp_ajax
* @version $Id: ajax_block_calendar.php 2008-08-03 17:56:00Z livewirestu $
* @copyright (c) 2008 www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

function populate_table()
{
    global $phpbb_root_path, $phpEx, $user, $auth;

    // Start session management
    $user->session_begin();
    $auth->acl($user->data);
    $user->setup('mods/calendar');

    include_once($phpbb_root_path . 'includes/functions_calendar.' . $phpEx);

    $month = request_var('cal_h_month', '');
    $year = request_var('cal_h_year', '');
    $action = request_var('action', '');

    if(empty($month) || empty($year))
    {
        // Something went wrong
        return false;
    }

    if($action == 'prev')
    {
        $month -= 1;
    }
    else if($action == 'next')
    {
        $month += 1;
    }
    // else just show the current month

    list($month, $year) = explode('-', date('n-Y', (mktime(0, 0, 1, $month, 1, $year))));

    $data = generate_month_array($month, $year, true);

    $return_array['data'] = $data;
    $return_array['data']['cal_h_month'] = $month;
    $return_array['data']['cal_h_year'] = $year;
    $return_array['data']['cal_month_name'] = '<b>' . $user->lang['CAL_CALENDAR']['CAL_LONG_MONTH'][(int)$month] . ' ' . date('Y', (mktime(0, 0, 1, $month, 1, $year))) . '</b>';
    $return_array['mode'] = 'update_block'; // So the client side handler knows what to do

    // We don't actually echo anything out here. The outputs are handled in sgp_ajax.php
    return $return_array;


}
?>
