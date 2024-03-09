<?PHP

/** 
*
* @mod package		Personal Notes
* @file				notes_install.php 2 2009/10/24 OXPUS
* @copyright		(c) 2009 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/*
* [ english ] language file for Personal Notes
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
	'NOTES_CURRENT_RELEASE'				=> 'Current installed release',
	'NOTES_CURRENT_RELEASE_EXPLAIN'		=> 'The script cannot find a valid version number.<br />Please enter your current installed version of the MOD.<br />If you will just install this mod, the let this field empty.',

	'INSTALL_PERSONAL_NOTES'			=> 'Install Personal Notes',
	'INSTALL_PERSONAL_NOTES_CONFIRM'	=> 'From here you can install the Personal Notes into your forum.<br />Click on the button to continue.',
	'UPDATE_PERSONAL_NOTES'				=> 'Update Personal Notes',
	'UPDATE_PERSONAL_NOTES_CONFIRM'		=> 'From here you can update the Personal Notes into your forum.<br />Click on the button to continue.',
	'UNINSTALL_PERSONAL_NOTES'			=> 'Remove Personal Notes',
	'UNINSTALL_PERSONAL_NOTES_CONFIRM'	=> 'From here you can uninstall the Personal Notes completely.<br />Click on the button to continue.',

));

?>