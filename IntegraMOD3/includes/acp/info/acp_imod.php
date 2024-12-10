<?php
/**
*
* @author Michael O'Toole (michaelo) http://phpbbireland.com
*
* @package acp (Integramod)
* @version $Id: acp_imod_config.php 305 2009-01-01 16:03:23Z Michealo $
* @copyright (c) 2005-2009 phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package module_install
*/

class acp_imod_config_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_imod',
			'title'		=> 'ACP_IMOD',
			'version'	=> '3.0.15',
			'modes'		=> array(
				'acp_imod_config' 	=> array('title' => 'ACP_IMOD_CONFIG', 'auth' => 'acl_a_imod',	'cat' => array('ACP_MOD')),
				'acp_calendar'      => array('title' => 'ACP_CALENDAR_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_IMOD')),
                'acp_mchat'         => array('title' => 'ACP_MCHAT_CONFIG', 'auth' => 'acl_a_mchat', 'cat' => array('ACP_IMOD')),
				'pages'		        => array('title' => 'ACP_MANAGE_PAGES', 'auth' => '', 'cat' => array('ACP_IMOD')),
			),	
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}