<?php
/**
*
* @author RMcGirr83
* @package - mChat
* @version $Id acp_mchat.php
* @copyright RMcGirr83 ( http://www.rmcgirr83.org/ )
* @copyright (c) Stokerpiller
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
class acp_mchat_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_mchat',
			'title'		=> 'ACP_CAT_MCHAT',
			'version'	=> '1.3.7',
			'modes'		=> array(
				'configuration'		=> array('title' => 'ACP_MCHAT_CONFIG', 'auth' => 'acl_a_mchat', 'cat' => array('ACP_CAT_DOT_MODS')),
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