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
* [French] language file for Download MOD 6
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

	'INSTALL_DOWNLOAD_MOD'				=> 'Installer Download MOD',
	'INSTALL_DOWNLOAD_MOD_CONFIRM'		=> 'Vous pouvez installer le Download MOD sur votre forum à partir d\'ici.<br />Cliquez sur le bouton pour continuer.',
	'UPDATE_DOWNLOAD_MOD'				=> 'Mettre à jour Download MOD',
	'UPDATE_DOWNLOAD_MOD_CONFIRM'		=> 'Vous pouvez mettre à jour le Download MOD sur votre forum depuis ici.<br />Cliquez sur le bouton pour continuer.',
	'UNINSTALL_DOWNLOAD_MOD'			=> 'Désinstaller Download MOD',
	'UNINSTALL_DOWNLOAD_MOD_CONFIRM'	=> 'Vous pouvez désinstaller complètement le Download MOD depuis ici.<br />Cliquez sur le bouton pour continuer.',

	'DL_CHANGE_CONFIG'					=> 'Modifier les paramètres de configuration',
	'DL_RESET_VC_VALUES'				=> 'Convertir les paramètres de confirmation visuelle',

));