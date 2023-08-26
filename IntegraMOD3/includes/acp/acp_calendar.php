<?php
/**
*
* @package acp
* @version $Id: acp_calendar.php 2008-07-24 18:35:00Z livewirestu $
* @copyright (c) 2008 phpbbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/
class acp_calendar
{
	var $u_action;

	function main($id, $mode)
	{
		global $template, $db, $user, $config, $cash;

		$this->tpl_name = 'mods/calendar/acp_calendar';
		$user->add_lang('acp/mods/calendar');

		$action = request_var('action', '');
		$form_key = 'acp_calendar';
		add_form_key($form_key);
        
        $submit = (isset($_POST['submit'])) ? true : false; 

		switch ($mode)
		{
			case 'settings':
			    $display_vars = array(
                    'title'    => 'ACP_CALENDAR_SETTINGS',
                    'vars'    => array(
                        'legend1'                           => 'ACP_CALENDAR_SETTINGS',
                        'calendar_override_user'            => array('lang' => 'OVERRIDE_USER',             'validate' => 'bool',    'type' => 'radio:yes_no', 'explain' => true),
                        'calendar_allow_priv_events'        => array('lang' => 'ALLOW_PRIV_EVENTS',         'validate' => 'bool',    'type' => 'radio:yes_no', 'explain' => true),
                        'calendar_show_week_nums'           => array('lang' => 'SHOW_WEEK_NUMS',            'validate' => 'bool',    'type' => 'radio:yes_no', 'explain' => true),
                        'calendar_monday_first'             => array('lang' => 'MONDAY_FIRST',              'validate' => 'bool',    'type' => 'custom', 'method' => 'calendar_monday_first', 'explain' => true),
                        'calendar_show_events_list'         => array('lang' => 'SHOW_EVENTS_LIST',          'validate' => 'bool',    'type' => 'radio:yes_no', 'explain' => true),
                        'calendar_show_birthdays_list'      => array('lang' => 'SHOW_BIRTHDAYS_LIST',       'validate' => 'bool',    'type' => 'radio:yes_no', 'explain' => true),
                        'calendar_show_birthdays_main'      => array('lang' => 'SHOW_BIRTHDAYS_MAIN',       'validate' => 'bool',    'type' => 'radio:yes_no', 'explain' => true),
                        'calendar_allow_index_minical'      => array('lang' => 'ALLOW_INDEX_MINICAL',       'validate' => 'bool',    'type' => 'radio:yes_no', 'explain' => true),
                        'calendar_max_events_list_days'     => array('lang' => 'MAX_EVENTS_LIST_DAYS',      'validate' => 'int',    'type' => 'text:3:4', 'explain' => true, 'append' => ' ' . $user->lang['DAYS']),
                        'calendar_default_events_list_days' => array('lang' => 'DEFAULT_EVENTS_LIST_DAYS',  'validate' => 'int',    'type' => 'text:3:4', 'explain' => true, 'append' => ' ' . $user->lang['DAYS']),
                        'calendar_max_bdays_list_days'      => array('lang' => 'MAX_BDAYS_LIST_DAYS',       'validate' => 'int',    'type' => 'text:3:4', 'explain' => true, 'append' => ' ' . $user->lang['DAYS']),
                        'calendar_default_bdays_list_days'  => array('lang' => 'DEFAULT_BDAYS_LIST_DAYS',   'validate' => 'int',    'type' => 'text:3:4', 'explain' => true, 'append' => ' ' . $user->lang['DAYS']),
                        
                        'legend2'                           => 'VERSION',
                        'calendar_version'                  => array('lang' => 'CALENDAR_VERSION',          'validate' => 'string',    'type' => 'text:8:9', 'explain' => true),
                    )
                );
            break; 
            
            case 'users':
                $display_vars = array(
                    'title'    => 'ACP_CALENDAR_USER_SETTINGS',
                    'vars'     => array(
                        'legend1'                           => 'Might get rid of this section...',
                    )    
                );
            break; 
            
            default:
                trigger_error('NO_MODE', E_USER_ERROR);
            break;
		}
        
        $this->new_config = $config;
        $cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
        $error = array();

        // We validate the complete config if whished
        validate_config_vars($display_vars['vars'], $cfg_array, $error);

        if ($submit && !check_form_key($form_key))
        {
            $error[] = $user->lang['FORM_INVALID'];
        }
        // Do not write values if there is an error
        if (sizeof($error))
        {
            $submit = false;
        }

        // We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
        foreach ($display_vars['vars'] as $config_name => $null)
        {
            if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
            {
                continue;
            }

            $this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

            if ($submit)
            {
                set_config($config_name, $config_value);
            }
        }
        
        if ($submit)
        {
            add_log('admin', 'LOG_CONFIG_' . strtoupper($mode));

            trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
        }

        $this->tpl_name = 'acp_board';
        $this->page_title = $display_vars['title'];

        $template->assign_vars(array(
            'L_TITLE'            => $user->lang[$display_vars['title']],
            'L_TITLE_EXPLAIN'    => $user->lang[$display_vars['title'] . '_EXPLAIN'],

            'S_ERROR'            => (sizeof($error)) ? true : false,
            'ERROR_MSG'            => implode('<br />', $error),

            'U_ACTION'            => $this->u_action)
        );

        // Output relevant page
        foreach ($display_vars['vars'] as $config_key => $vars)
        {
            if (!is_array($vars) && strpos($config_key, 'legend') === false)
            {
                continue;
            }

            if (strpos($config_key, 'legend') !== false)
            {
                $template->assign_block_vars('options', array(
                    'S_LEGEND'        => true,
                    'LEGEND'        => (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
                );

                continue;
            }

            $type = explode(':', $vars['type']);

            $l_explain = '';
            if ($vars['explain'] && isset($vars['lang_explain']))
            {
                $l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
            }
            else if ($vars['explain'])
            {
                $l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
            }
            
            $content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);
            
            if (empty($content))
            {
                continue;
            }
            
            $template->assign_block_vars('options', array(
                'KEY'            => $config_key,
                'TITLE'            => (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
                'S_EXPLAIN'        => $vars['explain'],
                'TITLE_EXPLAIN'    => $l_explain,
                'CONTENT'        => build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars),
                )
            );

            unset($display_vars['vars'][$config_key]);
        }
	}

    /**
    * Write starting day config field
    */
    function calendar_monday_first($value, $key = '')
    {
        $radio_ary = array(0 => 'SUNDAY', 1 => 'MONDAY');

        return h_radio('config[calendar_monday_first]', $radio_ary, $value, $key);
    }    

}