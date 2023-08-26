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
class acp_kb_info
{
	function module()
	{		
		return array(
			'filename'	=> 'acp_kb',
			'title'		=> 'ACP_CAT_KB',
			'version'	=> '0.2.13',
			'modes'		=> array(
				'config'	=> array('title'	=> 'KB_CONFIG', 'auth'	=> 'acl_a_config_kb',	'cat'	=> array('ACP_CAT_KB'), ),
				'main'		=> array('title'	=> 'CATEGORIES', 'auth'	=> 'acl_a_categorie_kb',	'cat'	=> array('ACP_CAT_KB'), ),
				'types'		=> array('title'	=> 'TYPES', 'auth'		=> 'acl_a_types_kb',	'cat'	=> array('ACP_CAT_KB'), ),
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

?>