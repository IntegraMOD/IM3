<?php
/**
*
* @author Michael O'Toole (michaelo) http://phpbbireland.com
*
* @package acp (Stargate Portal)
* @version $Id: acp_k_menus.php 305 2009-01-01 16:03:23Z Michealo $
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

class acp_k_menus_info
{
	function module()
	{
		return array(
			'filename'  => 'acp_k_menus',
			'title'     => 'ACP_K_MENUS',
			'version'   => '1.0.19',
			'modes' => array(
				'add'       => array('title' => 'ACP_K_MENU_ADD',         'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS')),
				'nav'       => array('title' => 'ACP_K_MENU_MAIN',        'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS')),
				'sub'       => array('title' => 'ACP_K_MENU_SUB',         'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS')),
				'link'      => array('title' => 'ACP_K_MENU_LINKS',       'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS')),

				'edit'      => array('title' => 'ACP_K_MENU_EDIT',        'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS'), 'display' => false),
				'delete'    => array('title' => 'ACP_K_MENU_DELETE',      'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS'), 'display' => false),
				'up'        => array('title' => 'ACP_K_UP',               'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS'), 'display' => false),
				'down'      => array('title' => 'ACP_K_DOWN',             'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS'), 'display' => false),

				//'head'      => array('title' => 'ACP_K_MENU_HEADER',      'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS')),
				//'foot'      => array('title' => 'ACP_K_MENU_FOOTER',      'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS')),
				//'manage'	=> array('title' => 'ACP_K_MENU_MANAGE',      'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS')),
				//'icons'		=> array('title' => 'ACP_K_MENU_ICONS',   'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS')),

				'all'       => array('title' => 'ACP_K_MENU_ALL',         'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS')),
				'unalloc'   => array('title' => 'ACP_K_MENU_UNALLOCATED', 'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MENUS'))
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