<?php
/** 
*
* @package acp
* @version $Id: acp_cash.php 490 2007-06-27 02:17:56Z roadydude $
* @copyright (c) 2006-2007 StarTrekGuide Development Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class acp_cash_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_cash',
			'title'		=> 'ACP_CASH',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'default'	=> array('title' => 'ACP_CASH', 'auth' => 'acl_a_', 'cat' => array('ACP_DOT_MODS')),
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