<?php
/**
*
* @author Michael O'Toole (michaelo) http://phpbbireland.com
*
* @package acp (Integramodl)
* @version $Id: acp_imod_vars.php 305 2009-01-01 16:03:23Z Michealo $
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

class acp_imod_vars_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_imod_vars',
			'title'		=> 'ACP_IMOD_VARS',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'config'	=> array('title' => 'ACP_IMOD_VARS_CONFIG','auth' => 'acl_a_imod', 'cat' => array('ACP_IMOD_TOOLS')),
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