<?php
/** 
*
* permissions_kb [English]
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package language
* @version $Id$
* @copyright (c) 2007 SEO phpBB http://www.phpbb-seo.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

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

// Adding new category
$lang['permission_cat']['kb'] = 'Knowledge Base';
$lang['permission_cat']['read'] = 'read';
$lang['permission_cat']['write'] = 'write';
$lang['permission_type']['kb_'] = 'Knowledge Base';

// Adding the permissions
$lang = array_merge($lang, array(


	'acl_kb_print_article'			=> array('lang' => 'Can print articles', 'cat' => 'read'),
	'acl_kb_view_article'			=> array('lang' => 'Can view articles in this category', 'cat' => 'read'),
	'acl_kb_download'				=> array('lang' => 'Can download attachements', 'cat' => 'read'),
	'acl_kb_report_article'			=> array('lang' => 'Can report article', 'cat' => 'read'),
	'acl_kb_rate_article'			=> array('lang' => 'Can rate article', 'cat' => 'read'),
	'acl_kb_attache_article'		=> array('lang' => 'Can uploade attachements', 'cat' => 'write'),
	'acl_kb_edit_article'			=> array('lang' => 'Can edit own articles', 'cat' => 'write'),
	'acl_kb_del_article'			=> array('lang' => 'Can delete own articles', 'cat' => 'write'),
	'acl_kb_add_article'			=> array('lang' => 'Can add articles', 'cat' => 'write'),
	'acl_kb_add_article_direct'		=> array('lang' => 'Can add articles without activation', 'cat' => 'write'),
	'acl_kb_edit_all_article'		=> array('lang' => 'Can edit all articles', 'cat' => 'write'),


	'acl_m_delete_diff_kb'		=> array('lang' => 'Can delete old versions of an article', 'cat' => 'kb'),
	'acl_m_restore_kb'			=> array('lang' => 'Can restore old versions of an article', 'cat' => 'kb'),
	'acl_m_log_kb'				=> array('lang' => 'Can view article log', 'cat' => 'kb'),
	'acl_m_log_kb_delete'		=> array('lang' => 'Can delete article log', 'cat' => 'kb'),
	'acl_m_report_kb'			=> array('lang' => 'Can manage reported articles', 'cat' => 'kb'),
	'acl_m_activate_kb'			=> array('lang' => 'Can activate article', 'cat' => 'kb'),
	'acl_m_edit_kb'				=> array('lang' => 'Can edit article', 'cat' => 'kb'),
	'acl_m_del_kb'				=> array('lang' => 'Can delete article', 'cat' => 'kb'),
	'acl_m_ch_poster'			=> array('lang' => 'Can change the author of an article', 'cat' => 'kb'),

	'acl_a_config_kb'			=> array('lang' => 'Can edit configuration', 'cat' => 'kb'),
	'acl_a_categorie_kb'		=> array('lang' => 'Can edit categories', 'cat' => 'kb'),
	'acl_a_types_kb'			=> array('lang' => 'Can edit types', 'cat' => 'kb'),
	'acl_a_permissions_kb'		=> array('lang' => 'Can edit category permissions', 'cat' => 'kb'),

));

