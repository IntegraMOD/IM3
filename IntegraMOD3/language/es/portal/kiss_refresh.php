<?php
/**
*
* @package kiss refresh
* @version $Id$
* @copyright (c) 2005 phpbbireland
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
//- stargate aka kiss portal engine lang definitions -//
$lang = array_merge($lang, array(
	//SGP Refresh ALL
	'CACHE_PURGED'			=> '<br />&nbsp;&#187;&nbsp;Caché purgó!',
	'CACHE_DIR_CLEANED'		=> '<br />&nbsp;&#187;&nbsp;directorio de caché limpiado.',
	'DISABSLE_USE'			=> '<br />&nbsp;&#187;&nbsp;Discapacitados, el uso de refresco en los países ACP para momento...',
	'DATABASE_TABLE'		=> 'tabla de base de datos!</b>',
	'FAILED_UPDATE'			=> '<br /><b>fallado para actualizar ',
	'NO_INFO_FOUND'			=> '<br /><b>No hay información que se encuentra en ',
	'PURGING_CACHE'			=> '<b>caché purga:</b>',
	'REFRESHED'				=> ' - <b>refrescar</b>',
	'REFRESHING_TEMPLATES'	=> '<b>Estilos refrescantes plantillas:</b>',
	'REFRESHING_THEMES'		=> '<b>Estilos refrescantes temas:</b>',
	'REFRESHING_IMAGESETS'	=> '<b>Estilos refrescantes imagesets:</b>',
	'SGP_REFRESH_ALL'		=> '<strong>Kiss Refresh All - version: 1.0.1</strong>',
	'SGP_REFRESH_TITLE'		=> 'Refresh All (1.0.1)',
	'SGPRA_EXEPTIONS'		=> '<strong><span class="red">!NOTA:</span><br />SGP Refresh ALL completado con excepciones!</strong> (véase más arriba para obtener información)<br />',
	'SGPRA_LOG_IN'			=> '<strong>iniciar la sesión</strong></a> como un <strong class="red">ADMINISTRADOR</strong> y volver a cargar esta página...<br /><br /><hr />',
	'SGPRA_NO_ADMIN'		=> '<strong class="red">Usted no tiene permiso para usar SGP Refresh ALL!</strong>',
	'SGPRA_NO_ERRORS'		=> '<br /><strong class="green">SGP Refresh ALL sin fallos!...</strong><br />',
));

?>