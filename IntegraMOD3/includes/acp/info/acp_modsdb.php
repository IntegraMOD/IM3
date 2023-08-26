<?php
/** 
*
* @package acp
* @copyright (c) 2005 phpBB Group, (c) 2007 lefty74 (modified acp_bots.php for Mods Database) 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class acp_modsdb_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_modsdb',
			'title'		=> 'ACP_MODS_DATABASE',
			'version'	=> '1.0.0',
			'modes'		=> array(
			'modsdb'		=> array('title' => 'ACP_MODS_DATABASE', 'auth' => 'acl_a_user', 'cat' => array('ACP_GENERAL_TASKS')),
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


?>