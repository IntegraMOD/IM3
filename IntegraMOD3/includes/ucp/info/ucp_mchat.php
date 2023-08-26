<?php
/**
*
* @package mChat
* @version $Id ucp_mchat.php
* @copyright (c) 2010 RMcGirr83 Rich McGirr
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class ucp_mchat_info
{
	function module()
	{
		return array(
			'filename'	=> 'ucp_mchat',
			'title'		=> 'UCP_MCHAT',
			'version'	=> '1.3.5',
			'modes'		=> array(
				'configuration'	=> array('title' => 'UCP_MCHAT_CONFIG', 'auth' => 'acl_u_mchat_use', 'cat' => array('UCP_MCHAT')),
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