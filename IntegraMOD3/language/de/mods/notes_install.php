<?PHP

/** 
*
* @mod package		Personal Notes
* @file				notes_install.php 2 2009/10/23 OXPUS
* @copyright		(c) 2009 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/*
* [ german ] language file for Personal Notes
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
	'PERSONAL_NOTES'					=> 'Personal Notes',
	'NOTES_CURRENT_RELEASE'				=> 'Aktuell installierte Version',
	'NOTES_CURRENT_RELEASE_EXPLAIN'		=> 'Es konnte die aktuelle Version nicht ermittelt werden.<br />Bitte gib deine Version an, damit die MOD korrekt aktualisiert werden kann.<br />Wenn du die MOD noch nicht installiert hast, dann lass dieses Feld bitte leer.',

	'INSTALL_PERSONAL_NOTES'			=> 'Personal Notes installieren',
	'INSTALL_PERSONAL_NOTES_CONFIRM'	=> 'Hiermit installiert du die Personal Notes in dein Forum.<br />Klicke auf den Button, um fortzufahren.',
	'UPDATE_PERSONAL_NOTES'				=> 'Personal Notes aktualisieren',
	'UPDATE_PERSONAL_NOTES_CONFIRM'		=> 'Hiermit aktualisierst du die Personal Notes in deinem Forum.<br />Klicke auf den Button, um fortzufahren.',
	'UNINSTALL_PERSONAL_NOTES'			=> 'Personal Notes entfernen',
	'UNINSTALL_PERSONAL_NOTES_CONFIRM'	=> 'Hiermit kannst du die Personal Notes aus deinem Forum entfernen.<br />Klicke auf den Button, um fortzufahren.',

));

?>