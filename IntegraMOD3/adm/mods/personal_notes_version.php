<?php
/**
*
* @package acp
* @version $Id: personal_notes_version.php 7 2009-06-16 OXPUS $
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
* @package personal_notes
*/
class personal_notes_version
{
	function version()
	{
		global $config;

		return array(
			'author'	=> 'OXPUS',
			'title'		=> 'Personal Notes',
			'tag'		=> 'personal_notes',
			'version'	=> $config['notes_version'],
			'file'		=> array('www.oxpus.net', 'mods_check', 'oxpus_mods.xml'),
		);
	}
}

?>