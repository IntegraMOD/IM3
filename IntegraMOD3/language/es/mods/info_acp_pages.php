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
	'PAGE_DESC_EXPLAIN' => 'Se usa en el PCA, en la lista de páginas y como meta descripción para los buscadores. Procura usar entre 150 y 160 caracteres.',
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
	'PAGE_OG_IMAGE' => 'URL de la imagen social',
	'PAGE_OG_IMAGE_EXPLAIN' => 'La imagen que se muestra cuando esta página se comparte en Facebook, X, Discord y sitios similares. Opcional. Debe ser una URL completa que empiece por http:// o https://, idealmente de unos 1200 por 630 píxeles.',
	'PAGE_OG_IMAGE_INVALID' => 'La URL de la imagen debe comenzar por http:// o https://.',
	'PAGE_PORTAL_KEY' => 'Clave de página del portal',
	'PAGE_PORTAL_KEY_EXPLAIN' => 'Añade esta entrada en Portal, Gestionar páginas phpBB para asignar bloques solo a esta página. De lo contrario se aplica la entrada genérica de página.',
	'PAGE_PUBLIC_URL' => 'URL pública',
	'PAGE_RELATED' => 'Páginas relacionadas',
	'PAGE_SEO_TITLE' => 'Título SEO',
	'PAGE_SEO_TITLE_EXPLAIN' => 'Sustituye el título del navegador y de búsqueda. Usa 70 caracteres o menos. Déjalo vacío para usar el título de la página.',
	'PAGE_SHOW_TITLE' => 'Mostrar el título en la página',
	'PAGE_SHOW_TITLE_EXPLAIN' => 'Si es No, el encabezado se oculta visualmente, pero permanece en el título HTML y en el marcado para los buscadores y lectores de pantalla.',
	'PAGE_TITLE' => 'Título de la página',
	'PAGE_UPDATED' => 'The page was successfully updated.',
	'PAGE_URL' => 'URL identifier',
	'PAGE_URL_EXPLAIN' => 'Used in the URL to access the page, use lowercase letters, numbers and hyphens. If not entered, the system will generate it from the page title.',
	'PAGE_URL_RESERVED' => 'Ese identificador de URL coincide con un archivo o directorio existente. Elija otro nombre.',
	'PAGE_CONTENT_FORMAT' => 'Formato del contenido',
	'PAGE_CONTENT_FORMAT_EXPLAIN' => 'BBCode usa el editor normal. El HTML se guarda y se muestra tal como se introduce, sin el analizador BBCode.',
	'PAGE_FORMAT_BBCODE' => 'BBCode',
	'PAGE_FORMAT_HTML' => 'HTML',
	'PAGE_VISIBLE' => 'The selected page is now displayed.',
	'STATIC_PAGES_OG_IMAGE' => 'URL predeterminada de la imagen social',
	'STATIC_PAGES_OG_IMAGE_EXPLAIN' => 'La imagen que se muestra cuando una página se comparte en Facebook, X, Discord y sitios similares. Se usa para cualquier página que no tenga su propia imagen definida arriba.',
	'STATIC_PAGES_SEO_URLS' => 'Usar URL públicas estables',
	'STATIC_PAGES_SEO_URLS_EXPLAIN' => 'Si se activa, los enlaces públicos a las páginas usan una dirección legible como page123-titulo en lugar de page.php?id=123. La dirección no cambia aunque cambie el título, lo que es mejor para los buscadores. Requiere que la reescritura SEO de URLs del foro esté activa.',
	'STATIC_PAGES_SETTINGS' => 'Ajustes SEO de las páginas',
	'STATIC_PAGES_MOD_UPDATED' => '<strong>MOD de páginas estáticas actualizado a la versión » %s</strong>',
	'STATIC_PAGES_MOD_INSTALLED' => '<strong>Static page MOD was installed - MOD version » %s</strong>',
	
	// Log messages
	'LOG_PAGE_ADDED'	=> '<strong>Static page added</strong><br />» %s',
	'LOG_PAGE_UPDATED'	=> '<strong>Static page updated</strong><br />» %s',
	'LOG_PAGE_REMOVED'	=> '<strong>Static page removed</strong><br />» %s',
	
	// Manage pages permission
	'acl_a_manage_pages'			=> array('lang' => 'Can create, edit and delete static pages', 'cat' => 'misc'),
));
?>