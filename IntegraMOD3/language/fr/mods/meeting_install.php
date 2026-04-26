<?PHP

/** 
*
* @mod package		Meeting MOD 2
* @file				meeting_install.php 3 2009/10/23 OXPUS
* @copyright		(c) 2009 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/*
* [ english ] language file for Meeting MOD 2
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'MEETING_MOD'				=> 'Meeting MOD',

	'INSTALL_MEETING'			=> 'Install Meeting MOD',
	'INSTALL_MEETING_CONFIRM'	=> 'From here you can install the Meeting MOD into your forum.<br />Click on the button to continue.',
	'UPDATE_MEETING'			=> 'Update Meeting MOD',
	'UPDATE_MEETING_CONFIRM'	=> 'From here you can update the Meeting MOD into your forum.<br />Click on the button to continue.',
	'UNINSTALL_MEETING'			=> 'Remove Meeting MOD',
	'UNINSTALL_MEETING_CONFIRM'	=> 'From here you can uninstall the Meeting MOD completely.<br />Click on the button to continue.',

));

