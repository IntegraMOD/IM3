<?php
/**
*
* @author @author Tobi Schaefer www.tas2580.de/
*
* Knowledge Base
* @note: Do not remove this copyright. Just append yours if you have modified it,
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'acl_u_print_kb'			=> array('lang' => 'Can print articles', 'cat' => 'kb'),
	'acl_u_attache_kb'			=> array('lang' => 'Can upload attachements', 'cat' => 'kb'),
	'acl_u_edit_kb'				=> array('lang' => 'Can edit own article', 'cat' => 'kb'),
	'acl_u_del_kb'				=> array('lang' => 'Can delete own article', 'cat' => 'kb'),
	'acl_u_add_kb'				=> array('lang' => 'Can add article', 'cat' => 'kb'),
	'acl_u_report_kb'			=> array('lang' => 'Can report article', 'cat' => 'kb'),
	'acl_u_restore_kb'			=> array('lang' => 'Can restore articles', 'cat' => 'kb'),
	'acl_u_rate_kb'				=> array('lang' => 'Can rate article', 'cat' => 'kb'),



	'acl_m_log_kb'				=> array('lang' => 'Can view article log', 'cat' => 'kb'),
	'acl_m_log_kb_delete'		=> array('lang' => 'Can delete article log', 'cat' => 'kb'),
	'acl_m_report_kb'			=> array('lang' => 'Can manage reported article', 'cat' => 'kb'),
	'acl_m_activate_kb'			=> array('lang' => 'Can activate article', 'cat' => 'kb'),
	'acl_m_edit_kb'				=> array('lang' => 'Can edit article', 'cat' => 'kb'),
	'acl_m_del_kb'				=> array('lang' => 'Can delete article', 'cat' => 'kb'),
	'acl_m_ch_poster'			=> array('lang' => 'Can change the author of an article', 'cat' => 'kb'),

	'acl_a_config_kb'			=> array('lang' => 'Can edit configuration', 'cat' => 'kb'),
	'acl_a_categorie_kb'		=> array('lang' => 'Can edit categories', 'cat' => 'kb'),
	'acl_a_types_kb'			=> array('lang' => 'Can edit types', 'cat' => 'kb'),
));

?>