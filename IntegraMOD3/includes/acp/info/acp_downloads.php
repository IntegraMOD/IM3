<?php
/**
*
* @mod package		Download Mod 6
* @file				acp_downloads.php 11 2011/07/22 OXPUS
* @copyright		(c) 2005 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class acp_downloads_info
{
	function module()
	{
		global $config;

		return array(
			'filename'	=> 'acp_downloads',
			'title'		=> 'ACP_DOWNLOADS',
			'version'	=> $config['dl_mod_version'],
			'modes'		=> array(
				'main'			=> array('title' => 'ACP_DOWNLOADS',				'auth' => 'acl_a_dl_overview',		'cat' => array('ACP_DOWNLOADS')),
				'config'		=> array('title' => 'DL_ACP_CONFIG_MANAGEMENT',		'auth' => 'acl_a_dl_config',		'cat' => array('ACP_DOWNLOADS')),
				'traffic'		=> array('title' => 'DL_ACP_TRAFFIC_MANAGEMENT',	'auth' => 'acl_a_dl_traffic',		'cat' => array('ACP_DOWNLOADS')),
				'categories'	=> array('title' => 'DL_ACP_CATEGORIES_MANAGEMENT',	'auth' => 'acl_a_dl_categories',	'cat' => array('ACP_DOWNLOADS')),
				'files'			=> array('title' => 'DL_ACP_FILES_MANAGEMENT',		'auth' => 'acl_a_dl_files',			'cat' => array('ACP_DOWNLOADS')),
				'permissions'	=> array('title' => 'DL_ACP_PERMISSIONS',			'auth' => 'acl_a_dl_permissions',	'cat' => array('ACP_DOWNLOADS')),
				'stats'			=> array('title' => 'DL_ACP_STATS_MANAGEMENT',		'auth' => 'acl_a_dl_stats',			'cat' => array('ACP_DOWNLOADS')),
				'banlist'		=> array('title' => 'DL_ACP_BANLIST',				'auth' => 'acl_a_dl_banlist',		'cat' => array('ACP_DOWNLOADS')),
				'ext_blacklist'	=> array('title' => 'DL_EXT_BLACKLIST',				'auth' => 'acl_a_dl_blacklist',		'cat' => array('ACP_DOWNLOADS')),
				'toolbox'		=> array('title' => 'DL_MANAGE',					'auth' => 'acl_a_dl_toolbox',		'cat' => array('ACP_DOWNLOADS')),
				'fields'		=> array('title' => 'DL_ACP_FIELDS',				'auth' => 'acl_a_dl_fields',		'cat' => array('ACP_DOWNLOADS')),
				'browser'		=> array('title' => 'DL_ACP_BROWSER',				'auth' => 'acl_a_dl_browser',		'cat' => array('ACP_DOWNLOADS')),
			),
		);
	}
}

?>