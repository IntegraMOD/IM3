<?php
/**
*
* @package acp
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class acp_board_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_board',
			'title'		=> 'ACP_BOARD_MANAGEMENT',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'settings'		=> array('title' => 'ACP_BOARD_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'features'		=> array('title' => 'ACP_BOARD_FEATURES', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'avatar'		=> array('title' => 'ACP_AVATAR_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'message'		=> array('title' => 'ACP_MESSAGE_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION', 'ACP_MESSAGES')),
				'post'			=> array('title' => 'ACP_POST_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION', 'ACP_MESSAGES')),
				'signature'		=> array('title' => 'ACP_SIGNATURE_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'feed'			=> array('title' => 'ACP_FEED_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'registration'	=> array('title' => 'ACP_REGISTER_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				// phpBB Digest MOD - Addition begin -------------------------------------------------------
				'digest_general'					=> array('title' => 'ACP_DIGEST_GENERAL_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_DIGEST_SETTINGS')),
				'digest_user_defaults'				=> array('title' => 'ACP_DIGEST_USER_DEFAULT_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_DIGEST_SETTINGS')),
				'digest_edit_subscribers'			=> array('title' => 'ACP_DIGEST_EDIT_SUBSCRIBERS', 'auth' => 'acl_a_board', 'cat' => array('ACP_DIGEST_SETTINGS')),
				'digest_balance_load'				=> array('title' => 'ACP_DIGEST_BALANCE_LOAD', 'auth' => 'acl_a_board', 'cat' => array('ACP_DIGEST_SETTINGS')),
				'digest_mass_subscribe_unsubscribe'	=> array('title' => 'ACP_DIGEST_MASS_SUBSCRIBE_UNSUBSCRIBE', 'auth' => 'acl_a_board', 'cat' => array('ACP_DIGEST_SETTINGS')),
				// phpBB Digest MOD - Addition end ---------------------------------------------------------

				'auth'			=> array('title' => 'ACP_AUTH_SETTINGS', 'auth' => 'acl_a_server', 'cat' => array('ACP_CLIENT_COMMUNICATION')),
				'email'			=> array('title' => 'ACP_EMAIL_SETTINGS', 'auth' => 'acl_a_server', 'cat' => array('ACP_CLIENT_COMMUNICATION')),

				'cookie'	=> array('title' => 'ACP_COOKIE_SETTINGS', 'auth' => 'acl_a_server', 'cat' => array('ACP_SERVER_CONFIGURATION')),
				'server'	=> array('title' => 'ACP_SERVER_SETTINGS', 'auth' => 'acl_a_server', 'cat' => array('ACP_SERVER_CONFIGURATION')),
				'security'	=> array('title' => 'ACP_SECURITY_SETTINGS', 'auth' => 'acl_a_server', 'cat' => array('ACP_SERVER_CONFIGURATION')),
				'load'		=> array('title' => 'ACP_LOAD_SETTINGS', 'auth' => 'acl_a_server', 'cat' => array('ACP_SERVER_CONFIGURATION')),
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
