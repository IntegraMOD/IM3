<?php
/**
*
* @package sgp_ajax
* @version $Id: ajax_calendar.php 2008-07-04 17:42:00Z livewirestu $
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

// Calendar Ajax Functions

/**
* get_repeat_dates
*
* As user fills out repeat event information, a list of the calculated event dates which will be generated
* is displayed to the user via Ajax. 
* This is helpful, for example, when the user is creating events which repeat on the nth weekday every n months
* 
*/
function get_repeat_dates()
{
    global $phpbb_root_path, $phpEx, $user, $auth;
    
    // Start session management
    $user->session_begin();
    $auth->acl($user->data);
    $user->add_lang('mods/calendar');
    
    include_once($phpbb_root_path . 'includes/functions_calendar.' . $phpEx);
    
    if($_GET['event_repeat'] == 1)
    {  
        include_once($phpbb_root_path . 'common.' . $phpEx);
        
        if(!isset($_GET['container']))
        {
            die('No container specified');   
        }

        $times = validate_event_times(true);
        
        if($times['valid'] == true)
        {
            $repeat_params = validate_repeat_params(true, true);
            if($repeat_params['valid'] == true)
            {
                $repeat_info = generate_repeat_event_info(0, $times['start'], $times['end'], $repeat_params['repeat_code']);        
                $return_array['data'] = $repeat_info['list'];
            }
            else
            {
                $return_array['data'] = implode('<br />', $repeat_params['error']);
            }    
        }
        else
        {
            $return_array['data'] = implode('<br />', $times['error']);
        }
        
        $return_array['mode'] = 'update_field'; // So the client side handler knows what to do
        $return_array['container'] = request_var('container', '');      
        
        
        // We don't actually echo anything out here. The outputs are handled in sgp_ajax.php
        return $return_array;
    }    
}
?>
