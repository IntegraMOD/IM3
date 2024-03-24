<?php
/** 
*
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package Digests
* @version $Id$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class acp_digests_info
{
	function module()
	{		
		return array(
			'filename'	=> 'acp_digest',
			'title'		=> 'ACP_CAT_DIGESTS',
			'version'	=> '2.2.27',
			'modes'		=> array(
				'digest_general'					=> array('title' => 'ACP_DIGEST_GENERAL_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'digest_user_defaults'				=> array('title' => 'ACP_DIGEST_USER_DEFAULT_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'digest_edit_subscribers'			=> array('title' => 'ACP_DIGEST_EDIT_SUBSCRIBERS', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'digest_balance_load'				=> array('title' => 'ACP_DIGEST_BALANCE_LOAD', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'digest_mass_subscribe_unsubscribe'	=> array('title' => 'ACP_DIGEST_MASS_SUBSCRIBE_UNSUBSCRIBE', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
			),
		);
	}












	function install()
	{
	}

	function uninstall()
	{
	}
	
	function update()
	{
	}
}