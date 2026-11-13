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
	'PAGE_DESC_EXPLAIN' => 'Використовується в ACP, у списку сторінок і як метаопис для пошукових систем. Бажано 150-160 символів.',
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
	'PAGE_OG_IMAGE' => 'URL зображення для соцмереж',
	'PAGE_OG_IMAGE_EXPLAIN' => 'Зображення, яке показується, коли цю сторінку поширюють у Facebook, X, Discord та подібних сервісах. Необов’язково. Має бути повною URL-адресою, що починається з http:// або https://, бажано близько 1200 на 630 пікселів.',
	'PAGE_OG_IMAGE_INVALID' => 'URL-адреса зображення має починатися з http:// або https://.',
	'PAGE_PORTAL_KEY' => 'Ключ сторінки порталу',
	'PAGE_PORTAL_KEY_EXPLAIN' => 'Додайте цей запис у Портал, Керування сторінками phpBB, щоб призначати блоки лише цій сторінці. Інакше застосовується загальний запис сторінки.',
	'PAGE_PUBLIC_URL' => 'Публічна URL-адреса',
	'PAGE_RELATED' => 'Пов’язані сторінки',
	'PAGE_SEO_TITLE' => 'SEO-заголовок',
	'PAGE_SEO_TITLE_EXPLAIN' => 'Замінює заголовок браузера та пошуку. Використовуйте не більше 70 символів. Залиште порожнім, щоб використати назву сторінки.',
	'PAGE_SHOW_TITLE' => 'Показувати заголовок на сторінці',
	'PAGE_SHOW_TITLE_EXPLAIN' => 'Якщо Ні, заголовок візуально приховано, але він залишається в HTML-заголовку та розмітці для пошукових систем і програм зчитування з екрана.',
	'PAGE_TITLE' => 'Назва сторінки',
	'PAGE_UPDATED' => 'The page was successfully updated.',
	'PAGE_URL' => 'URL identifier',
	'PAGE_URL_EXPLAIN' => 'Used in the URL to access the page, use lowercase letters, numbers and hyphens. If not entered, the system will generate it from the page title.',
	'PAGE_URL_RESERVED' => 'That URL identifier matches an existing file or directory. Choose another name.',
	'PAGE_CONTENT_FORMAT' => 'Content format',
	'PAGE_CONTENT_FORMAT_EXPLAIN' => 'BBCode uses the normal editor. HTML is saved and displayed as entered, without the BBCode parser.',
	'PAGE_FORMAT_BBCODE' => 'BBCode',
	'PAGE_FORMAT_HTML' => 'HTML',
	'PAGE_VISIBLE' => 'The selected page is now displayed.',
	'STATIC_PAGES_OG_IMAGE' => 'Стандартна URL-адреса зображення для соцмереж',
	'STATIC_PAGES_OG_IMAGE_EXPLAIN' => 'Зображення, яке показується, коли сторінку поширюють у Facebook, X, Discord та подібних сервісах. Використовується для будь-якої сторінки, для якої вище не задано власне зображення.',
	'STATIC_PAGES_SEO_URLS' => 'Використовувати стабільні публічні URL-адреси',
	'STATIC_PAGES_SEO_URLS_EXPLAIN' => 'Якщо ввімкнено, публічні посилання на сторінки використовують читабельну адресу на кшталт page123-title замість page.php?id=123. Адреса не змінюється, навіть якщо змінюється назва, що краще для пошукових систем. Потребує активної SEO-переадресації URL форуму.',
	'STATIC_PAGES_SETTINGS' => 'Налаштування SEO сторінок',
	'STATIC_PAGES_MOD_UPDATED' => '<strong>MOD статичних сторінок оновлено до версії » %s</strong>',
	'STATIC_PAGES_MOD_INSTALLED' => '<strong>Static page MOD was installed - MOD version » %s</strong>',
	
	// Log messages
	'LOG_PAGE_ADDED'	=> '<strong>Static page added</strong><br />» %s',
	'LOG_PAGE_UPDATED'	=> '<strong>Static page updated</strong><br />» %s',
	'LOG_PAGE_REMOVED'	=> '<strong>Static page removed</strong><br />» %s',
	
	// Manage pages permission
	'acl_a_manage_pages'			=> array('lang' => 'Can create, edit and delete static pages', 'cat' => 'misc'),
));
?>