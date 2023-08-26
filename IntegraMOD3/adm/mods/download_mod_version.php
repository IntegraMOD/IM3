<?php
/**
*
* @package acp
* @version $Id: download_mod_version.php 3 2009-10-28 OXPUS $
* @copyright (c) 2008 OXPUS.net
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package download_mod
*/
class download_mod_version
{
	function version()
	{
		global $config;

		return array(
			'author'	=> 'OXPUS',
			'title'		=> 'Download MOD',
			'tag'		=> 'download_mod',
			'version'	=> $config['dl_mod_version'],
			'file'		=> array('www.oxpus.net', 'mods_check', 'oxpus_mods.xml'),
		);
	}
}

?>