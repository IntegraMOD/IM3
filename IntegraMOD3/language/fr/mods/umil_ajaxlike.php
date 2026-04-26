<?php
/**
*
* @package phpBB3
* @copyright (c) 2013 github.com/eMosbat
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ACP_MOD_TITLE'							=> 'phpBB Ajax Like',
	'INSTALL_AJAXLIKE_MOD'				=> 'Install phpBB Ajax Like Mod',
	'INSTALL_AJAXLIKE_MOD_CONFIRM'		=> 'Are you ready to install the phpBB Ajax Like Mod?',

	'AJAXLIKE_MOD'						=> 'phpBB Ajax Like Mod',

	'UNINSTALL_AJAXLIKE_MOD'			=> 'Uninstall phpBB Ajax Like Mod',
	'UNINSTALL_AJAXLIKE_MOD_CONFIRM'	=> 'Are you ready to uninstall the phpBB Ajax Like Mod?  All settings and data saved by this mod will be removed!',
	'UPDATE_AJAXLIKE_MOD'				=> 'Update phpBB Ajax Like Mod',
	'UPDATE_AJAXLIKE_MOD_CONFIRM'		=> 'Are you ready to update the phpBB Ajax Like Mod?',
));

?>