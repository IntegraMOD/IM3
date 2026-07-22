<?php
/**
*
* @package phpBB3
* @copyright (c) 2013 emosbat
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
    'ACP_MOD_TITLE'						=> 'jQuery Pack für phpBB',
    'INSTALL_JQUERYPACK_MOD'			=> 'jQuery Pack für phpBB Mod Installieren',
    'INSTALL_JQUERYPACK_MOD_CONFIRM'	=> 'Bist du bereit, die jQuery Pack für phpBB Mod zu installieren?',

    'JQUERYPACK_MOD'					=> 'jQuery Pack für phpBB Mod',

    'UNINSTALL_JQUERYPACK_MOD'			=> 'jQuery Pack für phpBB Mod Deinstallieren',
    'UNINSTALL_JQUERYPACK_MOD_CONFIRM'	=> 'Bist du bereit, die jQuery Pack für phpBB Mod zu deinstallieren?  Alle Einstellungen und Daten, die von dieser Mod gespeichert wurden, werden entfernt!',
    'UPDATE_JQUERYPACK_MOD'				=> 'jQuery Pack für phpBB Mod Aktualisieren',
    'UPDATE_JQUERYPACK_MOD_CONFIRM'		=> 'Bist du bereit, die jQuery Pack für phpBB Mod zu aktualisieren?',
));

?>
