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
			'filename'	=> 'acp_imod_config',
			'title'		=> 'ACP_IMOD_CONFIG',
			'version'	=> '3.0.15',
			'modes'		=> array(
				'config' 	=> array('title' => 'ACP_IMOD_CONFIG', 'auth' => 'acl_a_imod',	'cat' => array('ACP_IMOD_CONFIG')),
/**
*               'calendar'  => array('title' => 'ACP_CALENDAR_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_CALENDAR')),
*				'contact'	=> array('title' => 'ACP_CONTACT_CONFIG', 'auth' => 'acl_a_contact', 'cat' => array('ACP_CAT_CONTACT')),
*				'mchat'		=> array('title' => 'ACP_MCHAT_CONFIG', 'auth' => 'acl_a_mchat', 'cat' => array('ACP_CAT_MCHAT')),
*/
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