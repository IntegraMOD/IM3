<?php
/**
*
* @package acp
* @version $Id$
* @copyright (c) 2005 phpBB Group
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
class acp_sn_main
{
	function module()
	{
		return array(
			'filename'	=> 'acp_sn_main',
			'title'		=> 'ACP_SN_MAIN',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'main'		=> array('title' => 'ACP_SN_MAIN', 'auth' => 'acl_a_sn_settings', 'cat' => array('ACP_CAT_SOCIALNET')),
			),
		);
	}
}
?>
