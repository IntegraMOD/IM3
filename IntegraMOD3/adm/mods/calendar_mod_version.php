<?php
/**
*
* @package acp
* @version $Id: calendar_mod_version.php 2008-07-24 18:35:00Z livewirestu $
* @copyright (c) 2008 phpbbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package mod_version_check
*/
class calendar_mod_version
{
	function version()
	{
		return array(
			'author'	=> 'livewirestu',
			'title'		=> 'Calendar MOD',
			'tag'		=> 'calendar_mod',
			'version'	=> '1.0.0b1',
			'file'		=> array('livewiremods.com', 'updatecheck', 'mods.xml'),
		);
	}
}

?>