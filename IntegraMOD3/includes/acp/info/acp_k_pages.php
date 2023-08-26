<?php
/**
*
* @author Michael O'Toole (michaelo) http://phpbbireland.com
*
* @package acp (Stargate Portal)
* @version $Id: acp_k_pages.php 305 10 August 2010 18:23:23Z Michealo $
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

class acp_k_pages_info
{
	function module()
	{
		return array(
			'filename' => 'acp_k_pages',
			'title'    => 'ACP_K_MANAGE_PAGES',
			'version'  => '1.0.19',
			'modes'    => array(
				'add'    => array('title' => 'ACP_K_PAGES_ADD',	   'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_PAGES'), 'display' => false),
				'delete' => array('title' => 'ACP_K_PAGES_DELETE', 'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_PAGES'), 'display' => false),
				'land'   => array('title' => 'ACP_K_PAGES_LAND',   'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_PAGES'), 'display' => false),
				'manage' => array('title' => 'ACP_K_PAGES_MANAGE', 'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_PAGES'))
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