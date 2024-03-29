<?PHP

/**
*
* @mod package		Download Mod 6
* @file				dl_install.php 5 2012/10/26 OXPUS
* @copyright		(c) 2008 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/*
* [ english ] language file for Download MOD 6
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
	'DOWNLOAD_MOD'						=> 'Download MOD',

	'INSTALL_DOWNLOAD_MOD'				=> 'Install Download MOD',
	'INSTALL_DOWNLOAD_MOD_CONFIRM'		=> 'From here you can install the Download MOD into your forum.<br />Click on the button to continue.',
	'UPDATE_DOWNLOAD_MOD'				=> 'Update Download MOD',
	'UPDATE_DOWNLOAD_MOD_CONFIRM'		=> 'From here you can update the Download MOD into your forum.<br />Click on the button to continue.',
	'UNINSTALL_DOWNLOAD_MOD'			=> 'Remove Download MOD',
	'UNINSTALL_DOWNLOAD_MOD_CONFIRM'	=> 'From here you can uninstall the Download MOD completely.<br />Click on the button to continue.',

	'DL_CHANGE_CONFIG'					=> 'Change config settings',
	'DL_RESET_VC_VALUES'				=> 'Convert settings for visual confirmations',

));

