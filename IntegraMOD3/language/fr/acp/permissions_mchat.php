<?php
/**
* acp_permissions_mchat (phpBB Permission Set) [English]
*
* @package language
* @version $Id: permissions_mchat.php
* @copyright (c) 2010 rmcgirr83.org
* @copyright (c) 2009 phpbb3bbcodes.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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

// Adding new category
$lang['permission_cat']['mchat'] = 'mChat';

// Adding the permissions
$lang = array_merge($lang, array(
	// User perms
	'acl_u_mchat_use'			=> array('lang' => 'Peut utiliser mChat', 'cat' => 'mchat'),
	'acl_u_mchat_view'			=> array('lang' => 'Peut voir mChat', 'cat' => 'mchat'),
	'acl_u_mchat_edit'			=> array('lang' => 'Peut modifier les messages mChat', 'cat' => 'mchat'),
	'acl_u_mchat_delete'		=> array('lang' => 'Peut supprimer les messages mChat', 'cat' => 'mchat'),
	'acl_u_mchat_ip'			=> array('lang' => 'Peut voir les adresses IP mChat', 'cat' => 'mchat'),
	'acl_u_mchat_flood_ignore'	=> array('lang' => 'Peut ignorer l’anti-flood mChat', 'cat' => 'mchat'),
	'acl_u_mchat_archive'		=> array('lang' => 'Peut voir l’archive', 'cat' => 'mchat'),
	'acl_u_mchat_bbcode'		=> array('lang' => 'Peut utiliser le BBCode dans mChat', 'cat' => 'mchat'),
	'acl_u_mchat_smilies'		=> array('lang' => 'Peut utiliser les smileys dans mChat', 'cat' => 'mchat'),
	'acl_u_mchat_urls'			=> array('lang' => 'Peut poster des URLs dans mChat', 'cat' => 'mchat'),

	// Admin perms
	'acl_a_mchat'				=> array('lang' => 'Peut gérer les paramètres mChat', 'cat' => 'permissions'),
));

