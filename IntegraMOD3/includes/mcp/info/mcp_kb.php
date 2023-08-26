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

/**
* @package module_install
*/
class mcp_kb_info
{
	function module()
	{
		return array(
			'filename'	=> 'mcp_kb',
			'title'		=> 'MCP_KB',
			'version'	=> '0.2.13',
			'modes'		=> array(
				'kb_main'			=> array('title' => 'MCP_KB_MAIN', 'auth' => '', 'cat' => array('MCP_KB')),
				'kb_activate'		=> array('title' => 'MCP_KB_ACTIVATE', 'auth' => 'acl_m_activate_kb', 'cat' => array('MCP_KB')),
				'kb_reports'		=> array('title' => 'MCP_KB_REPORTS', 'auth' => 'acl_m_report_kb', 'cat' => array('MCP_KB')),
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