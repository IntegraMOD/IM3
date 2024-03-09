<?php
/**
*
* This program is the full and free Spanish (of Spain) phpBB 3.0 Translation.
* Copyright (c) 2007 Huan Manwe for phpbb-es.com
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License along
* with this program; if not, write to the Free Software Foundation, Inc.,
* 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*
**/

/**
* viewtopic.php [Spanish [Es]]
*
* @package language
* @copyright (c) 2007 phpBB Group. Modified by Huan Manwe for phpbb-es.com in 2007
* @author 2007-11-26 - Traducido por Huan Manwe junto con phpbb-es.com (http://www.phpbb-es.com) basado en la version argentina hecha por larveando.com.ar ).
* @author - ImagePack made by Xoom (webmaster of http://www.muchografico.com and colaborator of http://www.phpbb-es.com)
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License
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

$lang = array_merge($lang, array(
	'ATTACHMENT'						=> 'Adjunto',
	'ATTACHMENT_FUNCTIONALITY_DISABLED'	=> 'Los adjuntos han sido deshabilitados',
	
	'BOOKMARK_ADDED'					=> 'Tema añadido con éxito a Favoritos.',
	'BOOKMARK_ERR'						=> 'Añadido de tema a Favoritos fallido. Por favor, inténtelo de nuevo.',
	'BOOKMARK_REMOVED'					=> 'Eliminado con éxito el tema de Favoritos.',
	'BOOKMARK_TOPIC'					=> 'Añadir tema a Favoritos',
	'BOOKMARK_TOPIC_REMOVE'				=> 'Eliminar de Favoritos',
	'BUMPED_BY'							=> 'Última reactivación por %1$s en %2$s',
	'BUMP_TOPIC'						=> 'Reactivar tema',
	
	'CODE'								=> 'Código',
	'COLLAPSE_QR'			=> 'Ocultar Respuesta Rápida',
	
	'DELETE_TOPIC'						=> 'Borrar tema',
	'DOWNLOAD_NOTICE'					=> 'No tiene los permisos requeridos para ver los archivos adjuntos a este mensaje.',
	
	'EDITED_TIMES_TOTAL'				=> 'Última edición por %1$s el %2$s, editado %3$d veces en total',
	'EDITED_TIME_TOTAL'					=> 'Última edición por %1$s el %2$s, editado %3$d vez en total',
	'EMAIL_TOPIC'						=> 'Email a un amigo',
	'ERROR_NO_ATTACHMENT'				=> 'El adjunto seleccionado ya no existe',
	
	'FILE_NOT_FOUND_404'				=> 'El archivo <strong>%s</strong> no existe.',
	'FORK_TOPIC'						=> 'Copiar tema',
	'FULL_EDITOR'			=> 'Editor completo',
	
	'LINKAGE_FORBIDDEN'					=> 'No está autorizado a ver, descargar o enlazar de/a este Sitio.',
	'LOGIN_NOTIFY_TOPIC'				=> 'Ha sido notificado sobre este tema, por favor identifíquese para verlo.',
	'LOGIN_VIEWTOPIC'					=> 'La Administración del Sitio requiere que esté registrado e identificado para ver este tema.',
	
	'MAKE_ANNOUNCE'						=> 'Cambiar a "Anuncio"',
	'MAKE_GLOBAL'						=> 'Cambiar a "Global"',
	'MAKE_NORMAL'						=> 'Cambiar a "Tema"',
	'MAKE_STICKY'						=> 'Cambiar a "Fijo"',
	'MAX_OPTIONS_SELECT'				=> 'Puede seleccionar hasta <strong>%d</strong> opciones',
	'MAX_OPTION_SELECT'					=> 'Puede seleccionar <strong>1</strong> opción',
	'MISSING_INLINE_ATTACHMENT'			=> 'El adjunto <strong>%s</strong> ya no está disponible',
	'MOVE_TOPIC'						=> 'Mover tema',
	
	'NO_ATTACHMENT_SELECTED'			=> 'No ha seleccionado un adjunto para descargar o ver.',
	'NO_NEWER_TOPICS'					=> 'No hay temas nuevos en este foro',
	'NO_OLDER_TOPICS'					=> 'No hay temas viejos en este foro',
	'NO_UNREAD_POSTS'					=> 'No hay nuevos mensajes sin leer en este tema.',
	'NO_VOTE_OPTION'					=> 'Debe especificar una opción cuando vote.',
	'NO_VOTES'							=> 'No hay votos',
	
	'POLL_ENDED_AT'						=> 'La encuesta terminó el %s',
	'POLL_RUN_TILL'						=> 'La encuesta continúa hasta el %s',
	'POLL_VOTED_OPTION'					=> 'Votó por esta opción',
	'PRINT_TOPIC'						=> 'Imprimir vista',
	
	'QUICK_MOD'							=> 'Herramientas de Moderación Rápida',
	'QUICKREPLY'			=> 'Respuesta Rápida',
	'QUOTE'								=> 'Citar',
	
	'REPLY_TO_TOPIC'					=> 'Responder al tema',
	'RETURN_POST'						=> '%sVolver al mensaje%s',
	'SHOW_QR'				=> 'Respuesta Rápida',
	
	'SUBMIT_VOTE'						=> 'Enviar voto',
	
	'TOTAL_VOTES'						=> 'Votos totales',
	
	'UNLOCK_TOPIC'						=> 'Desbloquear tema',
	
	'VIEW_INFO'							=> 'Detalles',
	'VIEW_NEXT_TOPIC'					=> 'Siguiente tema',
	'VIEW_PREVIOUS_TOPIC'				=> 'Tema previo',
	'VIEW_RESULTS'						=> 'Ver resultados',
	'VIEW_TOPIC_POST'					=> '1 mensaje',
	'VIEW_TOPIC_POSTS'					=> '%d mensajes',
	'VIEW_UNREAD_POST'					=> 'Primer mensaje sin leer',
	'VISIT_WEBSITE'						=> 'WWW',
	'VOTE_SUBMITTED'					=> 'Su voto ha sido enviado',
	'VOTE_CONVERTED'					=> 'El cambio de voto no está soportado en encuestas convertidas.',
	
));

$lang = array_merge($lang, array(
// ajaxlike
	'AL_YOU_TEXT'						=> 'You',						// `You` like this post.
	'AL_AND_TEXT'						=> 'and',						// userX `and` y like this post.
	'AL_OTHER_TEXT'						=> 'other',						// userX and 1 `other`  like this post.
	'AL_OTHERS_TEXT'					=> 'others',					// userX and 5 `others` like this post.
	'AL_PEOPLE_TEXT'					=> 'people',					// 4 `people` like this post.
	'AL_LIKE_POST_TEXT'					=> 'like this post.',			// 3 people `like this post`.
	'AL_ONE_LIKE_POST_TEXT'				=> 'likes this post.',			// userX `likes this post`.
	'AL_LIKE_POST_WITH_YOU_TEXT'		=> 'like this post.',			// You and 2 others `like this post`.
	'AL_YOU_LIKE_TEXT'					=> 'like this post.',			// You `like this post`.
	// 																		alternative mode:
	'AL_ALTER_ONE_PEOPLE_TEXT'			=> 'person',					// 1 `person` likes this post.
	'AL_ALTER_TWO_PEOPLE_TEXT'			=> 'people',					// 2 `people` like this post.
	'AL_ALTER_THREE_PEOPLE_TEXT'		=> 'people',					// 3 `people` like this post.
	'AL_ALTER_MORE_PEOPLE_TEXT'			=> 'people',					// 12 `people` like this post.
	'AL_ALTER_ONE_LIKE_POST_TEXT'		=> 'likes this post.',			// 1 person `likes this post`.
	'AL_ALTER_TWO_LIKE_POST_TEXT'		=> 'like this post.',			// 2 people `like this post`.
	'AL_ALTER_THREE_LIKE_POST_TEXT'		=> 'like this post.',			// 3 people `like this post`.
	'AL_ALTER_MORE_LIKE_POST_TEXT'		=> 'like this post.',			// 10 people `like this post`.
	//
	'AL_LIKE_TEXT'						=> 'Like',
	'AL_UNLIKE_TEXT'					=> 'Unlike',
	'AL_PEOPLE_LIKE_THIS_TEXT'			=> 'People like this post',		// dialog box title
	'AL_LIKE_COUNT_TEXT'				=> 'Likes',						// number of likes
	'AL_LIKED_COUNT_TEXT'				=> 'Liked in',					// number of received likes
	'AL_POSTS_TEXT'						=> 'posts',
	'AL_POST_TEXT'						=> 'post',
	'AL_LIKE_AT_TEXT'					=> 'Liked at',					// like date
	'AL_ERROR_INVALID_REQUEST'			=> 'Invalid request!',
	'AL_ERROR_ACCESS_DENIED'			=> 'Access Denied!',
));