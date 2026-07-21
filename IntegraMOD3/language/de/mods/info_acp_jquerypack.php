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
	'ACP_JQPACK_MOD_TITLE'					=> 'jQuery Pack for phpBB',
	'ACP_JQPACK_CONFIG_TITLE'				=> 'jQuery Pack',
	'ACP_JQPACK_TITLE'						=> 'jQuery Pack',
	'ACP_JQPACK_LEGEND1'					=> 'General',
	'ACP_JQPACK_CONFIG_ENABLE'				=> 'Enable jQuery',
	'ACP_JQPACK_UI_CONFIG_ENABLE'			=> 'Enable jQuery UI',
	'ACP_JQPACK_CONFIG_USE_GOOGLE'			=> 'Use Google CDN',
	'ACP_JQPACK_CONFIG_AT_HEADER'			=> 'Include code in header',
	'ACP_JQPACK_CONFIG_AT_HEADER_EXPLAIN'	=> '(if select no, include it in footer)',
	'ACP_JQPACK_CONFIG_NO_CONFLICT'			=> 'Enable global variable',
	'ACP_JQPACK_CONFIG_NO_CONFLICT_EXPLAIN'	=> '(enable `$jqpack_JQuery` variable, need for some MODs)',
));
?>