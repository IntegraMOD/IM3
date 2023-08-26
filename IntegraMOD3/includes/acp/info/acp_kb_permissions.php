<?php
/** 
*
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package Knowledge_Base
* @version $Id$
* @copyright (c) 2007 SEO phpBB http://www.phpbb-seo.de
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
class acp_kb_permissions_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_kb_permissions',
			'title'		=> 'ACP_CAT_KB',
			'version'	=> '0.2.13',
			'modes'		=> array(
				'set_permissions'	=> array('title' => 'ACP_KB_PERMISSIONS',	'auth' => 'acl_a_premissions_kb',	'cat' => array('ACP_CAT_KB')),
				'set_roles'	=> array('title' => 'ACP_KB_ROLES',	'auth' => 'acl_a_premissions_kb',	'cat' => array('ACP_CAT_KB')),
				),
			);
	}
}
?>