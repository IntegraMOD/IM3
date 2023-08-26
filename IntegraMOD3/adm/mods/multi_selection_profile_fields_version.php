<?php
/**
*
* @package acp
* @version $Id: mod_version_check_version.php 48 2007-09-23 20:23:14Z Handyman $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package mod_version_check
*/
class multi_selection_profile_fields_version
{
	function version()
	{
		return array(
			'author'	=> 'djchrisnet',
			'title'		=> 'Multi Selection Profile Fields',
			'tag'		=> 'mspf',
			'version'	=> '1.0.0',
			'file'		=> array('djchrisnet.de', 'modcheck', 'mods.xml'),
		);
	}
}

?>