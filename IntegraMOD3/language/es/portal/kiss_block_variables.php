<?php
/**
*
* common [English]
*
* @package language (Kiss Portal Engine)
* @version $Id:$
* @copyright (c) 2005 phpbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* @note: Do not remove this copyright. Just append yours if you have modified it, this is part of the Kiss Portal Engine copyright
* @updated 09 May 2011
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
// Portal Menu Names + add you menu language variables here! //

$lang = array_merge($lang, array(
	'SGP_BLOG'         => 'SGP Blog Integrado',
	'LINKS_MENU'       => 'Links Menu',
	'RATINGS_LATEST'   => 'Ultimos rankings',
	'REFRESH_ALL'      => 'Actualizar todo',
	'SITE_NAVIGATOR'   => 'Navegante',
	'SITE_RULES'       => 'Reglas del Sitio',
	'SITE_STATISTICS'  => 'Estadísticas del sitio',
	'STYLES_DEMO'      => 'Estilos Demostración',
	'STYLE_SELECT'     => 'Estilo Seleccione',
	'UNRESOLVED/BUGS'  => 'Sin resolver/Errores',
	'UPLOAD_IMAGES'    => 'Subir Imágenes',
	'USER_INFORMATION' => 'Información del usuario',

));

// Portal Block Names + add your block name language variables here! //
$lang = array_merge($lang, array(
	'ACP_SMALL'         => 'ACP',
	'BOARD_MINI_NAV'    => 'Sub Nav',
	'BOARD_STYLE'       => 'Estilo del Foro',
	'BOARD_NAV'         => 'navegación Junta',
	'BOT_TRACKER'       => 'Rastreador de Bot',
	'BOT_TRACKER_SMALL' => 'Rastreador de Bot',
	'CLOUD9_LINKS'      => 'Cloud9 Enlaces',
	'CLOUD9_SEARCHES'   => 'Cloud9 búsquedas',
	'FM_RADIO'          => 'Radio FM',
	'FORUM_CATEGORIES'  => 'categorías del foro',
	'MAIN_MENU'         => 'navegación Junta',
	'MP3_PLAYER'        => 'reproductor mp3',
	'NEWS_REPORT'       => 'sitio noticia',
	'PORTAL_STATUS'     => 'Estado del Portal',
	'RECENT_TOPICS'     => 'Temas recientes',
	'SELECT_STYLE'      => 'Seleccione un nuevo estilo',
	'SITE_LINK_TXT'     => 'Enlace con nosotros',
	'STATS'             => 'estadística',
	'STYLE_STATUS'      => 'Estilos Estado',
	'SUB_MENU'          => 'submenú',
	'TOP_10_PICS'       => '10 mejores fotografías valoradas',
	'TOP_DOWNLOADS'     => 'top descargas',
	'TOP_POSTERS'       => 'Los mejores carteles',
	'TOP_TOPICS_DAYS'   => 'en los últimos %d días',
	'WELCOME_SITE'      => 'Bienvenido a<br /><strong>%s</strong>',
	'YOUR_PROFILE'      => 'perfil de usuario',

));

// Block Names
$lang = array_merge($lang, array(
	'ADMIN_OPTIONS'           => 'Opciones admin',
	'BUG_TRACKER'             => 'rastreador de errores',
	'TRANSLATE_SITE'          => '<strong>Traducir el sitio a...</strong>',
	'TRANSLATE_RESET'         => '<strong>Restablecer lengua original</strong>',
	'ANNOUNCEMENTS_AND_NEWS'  => 'Noticias y Anuncios',
));

// Acronyms
$lang = array_merge($lang, array(
	'ALLOW_ACRONYMS'         => 'Procesar Siglas locales en los puestos',
	'ALLOW_ACRONYMS_EXPLAIN' => 'Permitir siglas locales en los mensajes',
));

// IRC Channel(s)
$lang = array_merge($lang, array(
	'IRC_POPUP'    => 'Emergente Canal IRC',
	'SIGNED_OFF'   => 'Firmado off',
	'NO_JAVA_SUP'  => 'No hay soporte java',
	'NO_JAVA_VER'  => 'Lo sentimos, pero usted necesita un navegador habilitado para Java 1.4.x utilizar PJIRC',
));

// Age ranges
$lang = array_merge($lang, array(
	'AGE_RANGE'        => 'El rango de edad',
	'AVERAGE_AGE'      => 'Edad media',
	'TOTAL_AGE'        => 'edad total',
	'TOTAL_AGE_COUNTS' => 'Los recuentos totales de edad',
));

// RSS Newsfeeds
$lang = array_merge($lang, array(
	'NO_CURL'               => 'No curl instalado. Utilice fopen lugar (cambiar en ACP)',
	'NO_FOPEN'              => 'No fopen instalado. Utilice curl lugar (cambiar en ACP)',
	'RSS_CACHE_ERROR'       => 'Lo sentimos, no hay elementos RSS que se encuentra en el archivo de caché.',
	'RSS_DISABLED'          => 'Newsfeeds están deshabilitados actualmente',
	'RSS_FEED_ERROR'        => 'o hay algún problema con RSS feed.',
	'RSS_LIST_ERROR'        => 'No se pudo obtener la lista de RSS.',
	'RSS_ERROR'             => 'RSS Error - Compruebe enlace del feed (arriba) para confirmar.',
	'LOG_RSS_CACHE_CLEANED' => 'Caché RSS despejado',
));

// HTTP Referrals
$lang = array_merge($lang, array(
	'TOT_REF' => 'Referidos total',
));

// Mini Mods
$lang = array_merge($lang, array(
	'CHECK_VERSION'  => 'Buscar actualizaciones',
));

?>