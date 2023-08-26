<?php
/**
*
* @mod package		Download Mod 6
* @file				ucp_downloads.php 6 2011/07/22 OXPUS
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

class ucp_downloads_info
{
	function module()
	{
		global $config;

		return array(
			'filename'	=> 'ucp_downloads',
			'title'		=> 'DOWNLOADS',
			'version'	=> $config['dl_mod_version'],
			'modes'		=> array(
				'config'	=> array('title' => 'DL_CONFIG',	'auth' => '',	'cat' => array('DOWNLOADS')),
				'favorite'	=> array('title' => 'DL_FAVORITE',	'auth' => '',	'cat' => array('DOWNLOADS')),
			),
		);
	}
}

?>