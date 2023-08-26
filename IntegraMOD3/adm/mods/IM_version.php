<?php
/**
*
* @package acp
* @version $Id: mod_version_check_version.php 51 2007-10-30 04:40:42Z Handyman $
* @copyright (c) 2007 StarTrekGuide
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package mod_version_check
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

class IM_version
{
	function version()
	{
		return array(
			'author'	=> 'Helter Skelter',
			'title'		=> 'IntegraMOD3',
			'tag'		=> 'integramod3',
			'version'	=> '0.3.0',
			'file'		=> array('integramod.com', 'version', 'IM_version.xml'),
		);
	}
}

?>