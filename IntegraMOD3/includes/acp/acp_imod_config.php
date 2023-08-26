<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_imod_config.php 312 2009-01-02 02:51:12Z Michealo $
* @copyright (c) 2007 Michael O'Toole aka michaelo
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

class acp_imod_config
{
	var $u_action;
		
	function main($id, $mode)
	{
		
		global $db, $user, $auth, $template, $cache;
		global $config, $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;
	
		$message ='';
			
		$user->add_lang('acp/imod_config');
		$this->tpl_name = 'acp_imod_config';
		$this->page_title = 'ACP_IMOD_CONFIG';

		$form_key = 'acp_imod_config';
		add_form_key($form_key);		
		
		$action = request_var('action', '');
		$mode	= request_var('mode', '');	
		
		$submit = (isset($_POST['submit'])) ? true : false;

		$forum_id	= request_var('f', 0);		
		$forum_data = $errors = array();
		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			$mode = '';
			trigger_error($user->lang['FORM_INVALID']);
		}		

		$sql = 'SELECT * FROM ' . IMOD_CONFIG_TABLE . '';
		if( $result = $db->sql_query($sql) )
		{
			$row = $db->sql_fetchrow($result);
			$imod_enabled	= $row['imod_enabled'];
			$imod_version	= $row['imod_version'];
		}
		else
		{
			trigger_error('Error! Could not query integramod config information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
		}	

		$template->assign_vars(array(
			'L_IMOD_MESSAGE'		=> $message,
			'S_IMOD_ENABLED'		=> $imod_enabled,
			'S_IMOD_VERSION'		=> $imod_version,
			'U_BACK'				=> $this->u_action,
			)
		);		
		
		$template->assign_vars(array('S_OPT' => 'Configure'));

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
				$imod_enabled		= request_var('imod_enabled', '');
				$imod_version		= request_var('imod_version', '');
				
				$sql = "UPDATE " . IMOD_CONFIG_TABLE . "
					SET 
					imod_enabled = '$imod_enabled', 
					imod_version = '$imod_version'";

				$db->sql_query($sql);
				
				$mode='reset';
				
				$template->assign_vars(array('S_OPT' => 'Config Data Saved'));
				
				meta_refresh(2, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=imod_config&amp;mode=config");
				return;
				break;
			}
			case 'default': break;
		}
		
		switch ($action)
		{
			case 'default': break;
		}		
		
	}				
}
