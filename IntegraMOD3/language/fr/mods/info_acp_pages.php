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
	'PAGE_DESC_EXPLAIN' => 'Utilisée dans le PCA, la liste des pages et comme méta-description pour les moteurs de recherche. Visez 150 à 160 caractères.',
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
	'PAGE_OG_IMAGE' => 'URL de l’image sociale',
	'PAGE_OG_IMAGE_EXPLAIN' => 'L\'image affichée lorsque cette page est partagée sur Facebook, X, Discord et les sites similaires. Facultatif. Doit être une URL complète commençant par http:// ou https://, idéalement d\'environ 1200 par 630 pixels.',
	'PAGE_OG_IMAGE_INVALID' => 'L’URL de l’image doit commencer par http:// ou https://.',
	'PAGE_PORTAL_KEY' => 'Clé de page du portail',
	'PAGE_PORTAL_KEY_EXPLAIN' => 'Ajoutez cette entrée sous Portail, Gérer les pages phpBB pour attribuer des blocs uniquement à cette page. Sinon, l’entrée générique de page s’applique.',
	'PAGE_PUBLIC_URL' => 'URL publique',
	'PAGE_RELATED' => 'Pages associées',
	'PAGE_SEO_TITLE' => 'Titre SEO',
	'PAGE_SEO_TITLE_EXPLAIN' => 'Remplace le titre du navigateur et de recherche. Utilisez 70 caractères ou moins. Laissez vide pour utiliser le titre de la page.',
	'PAGE_SHOW_TITLE' => 'Afficher le titre sur la page',
	'PAGE_SHOW_TITLE_EXPLAIN' => 'Si Non, le titre est masqué visuellement, mais reste dans le titre HTML et le balisage pour les moteurs de recherche et les lecteurs d’écran.',
	'PAGE_TITLE' => 'Titre de la page',
	'PAGE_UPDATED' => 'The page was successfully updated.',
	'PAGE_URL' => 'URL identifier',
	'PAGE_URL_EXPLAIN' => 'Used in the URL to access the page, use lowercase letters, numbers and hyphens. If not entered, the system will generate it from the page title.',
	'PAGE_URL_RESERVED' => 'Cet identifiant d\'URL correspond à un fichier ou un dossier existant. Choisissez un autre nom.',
	'PAGE_CONTENT_FORMAT' => 'Format du contenu',
	'PAGE_CONTENT_FORMAT_EXPLAIN' => 'BBCode utilise l\'éditeur normal. Le HTML est enregistré et affiché tel qu\'il est saisi, sans l\'analyseur BBCode.',
	'PAGE_FORMAT_BBCODE' => 'BBCode',
	'PAGE_FORMAT_HTML' => 'HTML',
	'PAGE_VISIBLE' => 'The selected page is now displayed.',
	'STATIC_PAGES_OG_IMAGE' => 'URL par défaut de l’image sociale',
	'STATIC_PAGES_OG_IMAGE_EXPLAIN' => 'L\'image affichée lorsqu\'une page est partagée sur Facebook, X, Discord et les sites similaires. Utilisée pour toute page qui n\'a pas sa propre image définie ci-dessus.',
	'STATIC_PAGES_SEO_URLS' => 'Utiliser des URL publiques stables',
	'STATIC_PAGES_SEO_URLS_EXPLAIN' => 'Si activé, les liens publics vers les pages utilisent une adresse lisible comme page123-titre au lieu de page.php?id=123. L\'adresse reste identique même si le titre change, ce qui est préférable pour les moteurs de recherche. Nécessite que la réécriture SEO des URL du forum soit active.',
	'STATIC_PAGES_SETTINGS' => 'Réglages SEO des pages',
	'STATIC_PAGES_MOD_UPDATED' => '<strong>MOD des pages statiques mis à jour vers la version » %s</strong>',
	'STATIC_PAGES_MOD_INSTALLED' => '<strong>Static page MOD was installed - MOD version » %s</strong>',
	
	// Log messages
	'LOG_PAGE_ADDED'	=> '<strong>Static page added</strong><br />» %s',
	'LOG_PAGE_UPDATED'	=> '<strong>Static page updated</strong><br />» %s',
	'LOG_PAGE_REMOVED'	=> '<strong>Static page removed</strong><br />» %s',
	
	// Manage pages permission
	'acl_a_manage_pages'			=> array('lang' => 'Can create, edit and delete static pages', 'cat' => 'misc'),
));
