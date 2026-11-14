<?php
/**
*
* @package acp
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class acp_mod_undo_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_mod_undo',
			'title'		=> 'ACP_MOD_UNDO',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'list'		=> array('title' => 'ACP_MOD_UNDO_LIST', 'auth' => 'acl_a_board', 'cat' => array('ACP_MOD_UNDO')),
				'settings'	=> array('title' => 'ACP_MOD_UNDO_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_MOD_UNDO')),
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
