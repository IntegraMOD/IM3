<?php
/**
*
* @package acp_email_list
* @version 1.0.0
* @copyright (c) 2008 david63
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class acp_user_details_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_user_details',
			'title'		=> 'ACP_USER_DETAILS',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'select'	=> array('title'	=> 'ACP_USER_DETAILS', 'auth'	=> 'acl_a_user', 'cat'	=> array('ACP_CAT_USERS')),
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