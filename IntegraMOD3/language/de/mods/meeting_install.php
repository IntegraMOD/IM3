<?PHP

/** 
*
* @mod package		Meeting MOD
* @file				meeting_install.php 8 2009/10/23 OXPUS
* @copyright		(c) 2009 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/*
* [ german ] language file for Meeting MOD 2
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

	'INSTALL_MEETING'			=> 'Meeting MOD installieren',
	'INSTALL_MEETING_CONFIRM'	=> 'Hiermit installiert du die Meeting MOD in dein Forum.<br />Klicke auf den Button, um fortzufahren.',
	'UPDATE_MEETING'			=> 'Meeting MOD aktualisieren',
	'UPDATE_MEETING_CONFIRM'	=> 'Hiermit aktualisierst du die Meeting MOD in deinem Forum.<br />Klicke auf den Button, um fortzufahren.',
	'UNINSTALL_MEETING'			=> 'Meeting MOD entfernen',
	'UNINSTALL_MEETING_CONFIRM'	=> 'Hiermit kannst du die Meeting MOD aus deinem Forum entfernen.<br />Klicke auf den Button, um fortzufahren.',

));

?>