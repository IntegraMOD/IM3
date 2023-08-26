<?php
/**
*
* Static Pages MOD acp module info file
*
* @version $Id$
* @copyright (c) 2009 Vojtěch Vondra
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

class acp_pages_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_pages',
			'title'		=> 'ACP_PAGES',
			'version'	=> '1.0.3',
			'modes'		=> array(
				'pages'		=> array('title' => 'ACP_MANAGE_PAGES', 'auth' => '', 'cat' => array('ACP_PAGES')),
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