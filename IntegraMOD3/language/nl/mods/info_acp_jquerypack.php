<?php
/**
*
* @package acp
* @copyright (c) 2013 emosbat
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
    exit;
}

/**
* DO NOT CHANGE
*/
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
    'ACP_JQPACK_MOD_TITLE'					=> 'jQuery Pack voor phpBB',
    'ACP_JQPACK_CONFIG_TITLE'				=> 'jQuery Pack',
    'ACP_JQPACK_TITLE'						=> 'jQuery Pack',
    'ACP_JQPACK_LEGEND1'					=> 'Algemeen',
    'ACP_JQPACK_CONFIG_ENABLE'				=> 'jQuery Inschakelen',
    'ACP_JQPACK_UI_CONFIG_ENABLE'			=> 'jQuery UI Inschakelen',
    'ACP_JQPACK_CONFIG_USE_GOOGLE'			=> 'Google CDN Gebruiken',
    'ACP_JQPACK_CONFIG_AT_HEADER'			=> 'Code in header opnemen',
    'ACP_JQPACK_CONFIG_AT_HEADER_EXPLAIN'	=> '(als je nee selecteert, neem het op in footer)',
    'ACP_JQPACK_CONFIG_NO_CONFLICT'			=> 'Globale variabele inschakelen',
    'ACP_JQPACK_CONFIG_NO_CONFLICT_EXPLAIN'	=> '(schakel `$jqpack_JQuery` variabele in, nodig voor sommige MODs)',
));
?>
