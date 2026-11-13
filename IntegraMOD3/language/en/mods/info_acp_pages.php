<?php
/**
*
* Static Pages MOD language file
*
* @version $Id$
* @copyright (c) 2009 Vojtěch Vondra
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

$lang = array_merge($lang, array(
	// Front-end keys
	'PAGE_ID_INVALID'			=> 'The selected page does not exist.',
	'PAGE_NOT_FOUND'			=> 'The selected page was not found.',
	
	// ACP keys
	'ACP_MANAGE_PAGES' => 'Manage Pages',
	'ACP_PAGES' => 'Pages',
	'ACP_PAGES_EXPLAIN' => 'Here you can add and edit static pages on your board.',
	'ADD_PAGE' => 'Add page',
	'GO_TO_PAGE' => 'See the page',
	'MUST_SELECT_PAGE' => 'You must select a page',
	'NO_PAGE_DESC' => 'You have not entered the page\'s description.',
	'NO_PAGE_TITLE' => 'You have not entered the page\'s title.',
	'NO_PAGE_CONTENT' => 'You have not entered the page\'s content.',
	'PAGE'     => 'Page',
	'PAGES'     => 'Pages',
	'PAGE_ADDED' => 'The page was successfully added.',
	'PAGE_AUTHOR' => 'Page author',
	'PAGE_CONTENT' => 'Page content',
	'PAGE_DESC' => 'Description',
	'PAGE_DESC_EXPLAIN' => 'Used in the ACP, the page list, and as the search-engine meta description. Aim for 150-160 characters.',
	'PAGE_DISPLAY' => 'Display page',
	'PAGE_DISPLAY_EXPLAIN' => 'If set to no, the page will not be accessible to public. Admins and moderators can always access the page directly.',
	'PAGE_DISPLAY_GUESTS' => 'Display page to guests',
	'PAGE_DISPLAY_GUESTS_EXPLAIN' => 'If set to No, only Registered users will be able to see the page.',
	'PAGE_HIDDEN' => 'This page is hidden, only moderators and administrators can see it. You can enable it in the ACP.',
	'PAGE_LINK' => 'Page link',
	'PAGE_MAKE_HIDDEN' => 'Hide',
	'PAGE_MAKE_VISIBLE' => 'Make visible',
	'PAGE_NOT_VISIBLE' => 'The selected page is now hidden from public view.',
	'PAGE_ORDER' => 'Page order',
	'PAGE_ORDER_EXPLAIN' => 'If a list of pages is shown, you can define the order of the pages by setting a number here, pages are sorted ascending by this field.',
	'PAGE_OG_IMAGE' => 'Social image URL',
	'PAGE_OG_IMAGE_EXPLAIN' => 'The picture shown when this page is shared on Facebook, X, Discord and similar sites. Optional. Must be a full URL starting with http:// or https://, ideally about 1200 by 630 pixels.',
	'PAGE_OG_IMAGE_INVALID' => 'The image URL must begin with http:// or https://.',
	'PAGE_PORTAL_KEY' => 'Portal page key',
	'PAGE_PORTAL_KEY_EXPLAIN' => 'Add this entry under Portal, Manage phpBB Pages to assign blocks to this page only. Otherwise the generic page entry applies.',
	'PAGE_PUBLIC_URL' => 'Public URL',
	'PAGE_RELATED' => 'Related pages',
	'PAGE_SEO_TITLE' => 'SEO title',
	'PAGE_SEO_TITLE_EXPLAIN' => 'Overrides the browser and search title. Use 70 characters or fewer. Leave blank to use the page title.',
	'PAGE_SHOW_TITLE' => 'Display title on page',
	'PAGE_SHOW_TITLE_EXPLAIN' => 'If No, the heading is visually hidden but remains in the HTML title and page markup for search engines and screen readers.',
	'PAGE_TITLE' => 'Page title',
	'PAGE_UPDATED' => 'The page was successfully updated.',
	'PAGE_URL' => 'URL identifier',
	'PAGE_URL_EXPLAIN' => 'Used in the URL to access the page, use lowercase letters, numbers and hyphens. If not entered, the system will generate it from the page title.',
	'PAGE_URL_RESERVED' => 'That URL identifier matches an existing file or directory. Choose another name.',
	'PAGE_CONTENT_FORMAT' => 'Content format',
	'PAGE_CONTENT_FORMAT_EXPLAIN' => 'BBCode uses the normal editor. HTML is saved and displayed as entered, without the BBCode parser.',
	'PAGE_FORMAT_BBCODE' => 'BBCode',
	'PAGE_FORMAT_HTML' => 'HTML',
	'PAGE_VISIBLE' => 'The selected page is now displayed.',
	'STATIC_PAGES_OG_IMAGE' => 'Default social image URL',
	'STATIC_PAGES_OG_IMAGE_EXPLAIN' => 'The picture shown when a page is shared on Facebook, X, Discord and similar sites. Used for any page that does not have its own image set above.',
	'STATIC_PAGES_SEO_URLS' => 'Use stable public page URLs',
	'STATIC_PAGES_SEO_URLS_EXPLAIN' => 'When enabled, public links to pages use a clean address such as page123-title instead of page.php?id=123. The page keeps the same address even if its title changes, which is better for search engines. Requires the board SEO URL rewriting to be active.',
	'STATIC_PAGES_SETTINGS' => 'Page SEO settings',
	'STATIC_PAGES_MOD_UPDATED' => '<strong>Static page MOD updated to version » %s</strong>',
	'STATIC_PAGES_MOD_INSTALLED' => '<strong>Static page MOD was installed - MOD version » %s</strong>',
	
	// Log messages
	'LOG_PAGE_ADDED'	=> '<strong>Static page added</strong><br />» %s',
	'LOG_PAGE_UPDATED'	=> '<strong>Static page updated</strong><br />» %s',
	'LOG_PAGE_REMOVED'	=> '<strong>Static page removed</strong><br />» %s',
	
	// Manage pages permission
	'acl_a_manage_pages'			=> array('lang' => 'Can create, edit and delete static pages', 'cat' => 'misc'),
));
