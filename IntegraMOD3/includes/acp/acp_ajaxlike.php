<?php
/**
*
* @package acp
* @copyright (c) 2013 github.com/eMosbat
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

/**
* @package acp
*/
class acp_ajaxlike
{
   var $u_action;
   var $new_config;
   function main($id, $mode)
   {
      global $db, $user, $auth, $template;
      global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$action	= request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;
		$form_key = 'acp_ajaxlike';
		add_form_key($form_key);


      switch($mode)
      {
         case 'config':
            $this->page_title = $user->lang['ACP_AJAXLIKE_MOD_TITLE'];
            $this->tpl_name = 'acp_ajaxlike';

				$display_vars = array(
					'title'	=> $this->page_title,
					'vars'	=> array(
						'legend1'	=> 'ACP_AJAXLIKE_LEGEND1',
						'ajaxlike_enable'		=> array(
							'lang' => 'ACP_AJAXLIKE_CONFIG_ENABLE',
							'validate' => 'bool',
							'type' => 'radio:enabled_disabled',
							'explain' => true
						),
						'ajaxlike_alter_mode'		=> array(
							'lang' => 'ACP_AJAXLIKE_CONFIG_ALTER_MODE',
							'validate' => 'bool',
							'type' => 'radio:enabled_disabled',
							'explain' => true
						),
						'ajaxlike_guest_can_view'		=> array(
							'lang' => 'ACP_AJAXLIKE_CONFIG_GUEST',
							'validate' => 'bool',
							'type' => 'radio:yes_no',
							'explain' => true
						),
						'ajaxlike_list_in_profile'		=> array(
							'lang' => 'ACP_AJAXLIKE_CONFIG_LIST_PROFILE',
							'validate' => 'bool',
							'type' => 'radio:yes_no',
							'explain' => true
						),
						'ajaxlike_profile_num'	=> array(
							'lang' => 'ACP_AJAXLIKE_CONFIG_LIST_MAX',
							'validate' => 'int:0',
							'type' => 'text:6:6',
							'method' => false, 'explain' => true
						),
						'ajaxlike_allow_unlike'	=> array(
							'lang' => 'ACP_AJAXLIKE_CONFIG_ALLOW_UNLIKE',
							'validate' => 'bool',
							'type' => 'radio:yes_no',
							'explain' => true
						),
						'ajaxlike_notify'	=> array(
							'lang' => 'ACP_AJAXLIKE_CONFIG_NOTIFY',
							'validate' => 'bool',
							'type' => 'radio:enabled_disabled',
							'explain' => true
						),
						'ajaxlike_notify_interval'	=> array(
							'lang' => 'ACP_AJAXLIKE_CONFIG_INTERVAL',
							'validate' => 'int:0',
							'type' => 'text:6:6',
							'method' => false,
							'explain' => true
						),
					)
				);
			
            break;
      }

		if (isset($display_vars['lang']))
		{
			$user->add_lang($display_vars['lang']);
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
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(

			'S_ERROR'	=> (sizeof($error)) ? true : false,
			'ERROR_MSG'	=> implode('<br />', $error),

			'U_ACTION'	=> $this->u_action)
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
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
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
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> $content,
				)
			);

			unset($display_vars['vars'][$config_key]);
		}

   }

}
?>