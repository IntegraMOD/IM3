<?php
/**
*
* @package acp integramod
* @version $Id: acp_imod_vars.php 335 2009-01-18 15:01:12Z Michealo $
* @copyright (c) 2007 Michael O'Toole aka michaelo
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* Last Updated: 27 March 2009 Mike
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

class acp_imod_vars
{
	var $u_action;

	function main($id, $mode)
	{

		global $db, $user, $auth, $template, $cache;
		global $imod_config, $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$message ='';

		$user->add_lang('acp/imod_vars');
		$this->tpl_name = 'acp_imod_vars';
		$this->page_title = 'ACP_IMOD_VARS_CONFIG';

		$form_key = 'acp_imod_vars';
		add_form_key($form_key);

		$mode	= request_var('mode', '');

		if($mode = 'config' && $choice == '')
			$choice = 'config';

		$action = request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		$forum_id	= request_var('f', 0);
		$forum_data = $errors = array();

		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			$mode = '';
			trigger_error($user->lang['FORM_INVALID']);
		}

		$wheresql = '';
		$sql = 'SELECT config_name, config_value
			FROM ' . IMOD_CONFIG_VAR_TABLE . $wheresql;
 
		$result = $db->sql_query($sql);

		while($row = $db->sql_fetchrow($result))
		{
			$imod_config[$row['config_name']] = $row['config_value'];
		}

		$template->assign_vars(array(
			'S_SAMPLE'	=> ($imod_config['sample']) ? true : false,
		));

		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'S_OPT' => 'Configure',
			'MESSAGE' => '',
		));

		if($submit)
		{
			$mode = 'save';
		}
		else
			$mode = 'reset';

		switch ($mode)
		{
			case 'save':
			{
				$sample	= request_var('sample', '');

				sgp_acp_set_config('saple', $sample);

				$mode='reset';

				$message = $user->lang['SAVED_BUT_PURGE_REQD'];

				$template->assign_vars(array(
					'S_OPT' => $user->lang['SAVING'],
					'MESSAGE' => $message,
				));

				meta_refresh(3, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=imod_vars&amp;mode=config");
				return;
				break;
			}
			case 'default': break;
		}

		switch ($action)
		{
			case 'submit':  $mode = 'reset'; break;
			case 'default': break;
		}

	}
}
?>