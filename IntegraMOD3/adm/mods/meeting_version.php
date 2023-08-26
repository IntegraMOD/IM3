<?php
/**
*
* @package acp
* @version $Id: meeting_version.php 1 2009-01-03 OXPUS $
* @copyright (c) 2009 OXPUS.net
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
* @package meeting mod
*/
class meeting_version
{
	function version()
	{
		global $config;

		return array(
			'author'	=> 'OXPUS',
			'title'		=> 'MEETING',
			'tag'		=> 'meeting',
			'version'	=> $config['meeting_version'],
			'file'		=> array('www.oxpus.net', 'mods_check', 'oxpus_mods.xml'),
		);
	}
}

?>