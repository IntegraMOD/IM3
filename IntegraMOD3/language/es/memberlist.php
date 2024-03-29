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
*
* memberlist.php [Spanish [Es]]
*
* @package language
* @version $Id: $
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

$lang = array_merge($lang, array(
	'ABOUT_USER'		=> 'Perfil',
	'ACTIVE_IN_FORUM'	=> 'Foro más activo',
	'ACTIVE_IN_TOPIC'	=> 'Tema más activo',
	'ADD_FOE'			=> 'Añadir Ignorado',
	'ADD_FRIEND'		=> 'Añadir amigo',
	'AFTER'				=> 'Después',
	
	'ALL'				=> 'Todos',
	
	'BEFORE'			=> 'Antes',
	
	'CC_EMAIL'		=> 'Enviar copia de este email a si mismo',
	'CONTACT_USER'	=> 'Contacto',
	
	'DEST_LANG'			=> 'Idioma',
	'DEST_LANG_EXPLAIN'	=> 'Seleccione un idioma apropiado (si está disponible) para el destinatario de este mensaje.',
	
	'EMAIL_BODY_EXPLAIN'	=> 'Este mensaje será enviado como texto plano, no incluya HTML o BBCode. La dirección del remitente será su dirección de email.',
	'EMAIL_DISABLED'		=> 'Lo siento, todas las funciones de email han sido deshabilitadas.',
	'EMAIL_SENT'			=> 'El email ha sido enviado.',
	'EMAIL_TOPIC_EXPLAIN'	=> 'Este mensaje será enviado como texto plano, no incluya HTML o BBCode. Por favor tenga en cuenta que el tema ya ha sido incluido en el cuerpo del mensaje. La dirección del remitente será su dirección de email.',
	'EMPTY_ADDRESS_EMAIL'	=> 'Debe proporcionar una dirección de email válida para el destinatario.',
	'EMPTY_MESSAGE_EMAIL'	=> 'Debe ingresar el texto del mensaje.',
	'EMPTY_MESSAGE_IM'		=> 'Debe introducir un mensaje para enviar.',
	'EMPTY_NAME_EMAIL'		=> 'Debe ingresar el nombre real del destinatario.',
	'EMPTY_SUBJECT_EMAIL'	=> 'Debe especificar un tema para el email.',
	'EQUAL_TO'				=> 'Igual a',
	
	'FIND_USERNAME_EXPLAIN'	=> 'Use este formulario para buscar usuarios específicos. No necesita rellenar todos los campos. Para indicar datos parciales use * como comodín. Cuando introduzca fechas, use el formato <kbd>YYYY-MM-DD</kbd>, p.ej. <samp>2004-02-29</samp>. Use los checkboxes para seleccionar uno o más usuarios (Se aceptan varios usuarios dependiendo del formulario en sí mismo) y clic en el botón Seleccionar Marcados para volver al foro previo.',
	'FLOOD_EMAIL_LIMIT'		=> 'No puede enviar otro email tan pronto. Por favor intente más tarde.',
	
	'GROUP_LEADER'			=> 'Líder de grupo',
	
	'HIDE_MEMBER_SEARCH'    => 'Ocultar búsqueda de usuarios',
	
	'IM_ADD_CONTACT'	=> 'Añadir Contacto',
	'IM_AIM'			=> 'Por favor tenga en cuenta que necesita AOL Instant Messenger instalado para usar esta opción.',
	'IM_AIM_EXPRESS'	=> 'AIM Express',
	'IM_DOWNLOAD_APP'	=> 'Descargar programa',
	'IM_ICQ'			=> 'Por favor observe que los usuarios pueden haber elegido no recibir mensajes instantáneos no solicitados.',
	'IM_JABBER'			=> 'Por favor observe que los usuarios pueden haber elegido no recibir mensajes instantáneos no solicitados.',
	'IM_JABBER_SUBJECT'	=> 'Este es un mensaje automático, ¡por favor no responda! Mensaje del usuario %1$s en %2$s',
	'IM_MESSAGE'		=> 'Su mensaje',
	'IM_MSNM'			=> 'Por favor observe que necesita Windows Messenger instalado para usar esta opción.',
	'IM_MSNM_BROWSER'	=> 'Su navegador no soporta esta opción.',
	'IM_MSNM_CONNECT'	=> 'MSNM no identificado.\\nTiene que conectar a MSNM para continuar.',
	'IM_NAME'			=> 'Su nombre',
	'IM_NO_DATA'		=> 'No hay información de contacto adecuada para este usuario.',
	'IM_NO_JABBER'		=> 'Disculpe, los mensajes directos de usuarios de Jabber no están soportados por este foro. Necesita un cliente Jabber instalado en su sistema para contactar con el destinatario.',
	'IM_RECIPIENT'		=> 'Destinatario',
	'IM_SEND'			=> 'Enviar',
	'IM_SEND_MESSAGE'	=> 'Enviar mensaje',
	'IM_SENT_JABBER'	=> 'Su mensaje a %1$s ha sido enviado correctamente.',
	'IM_USER'			=> 'Enviar un mensaje instantáneo',
	
	'LAST_ACTIVE'				=> 'Última vez activo',
	'LESS_THAN'					=> 'Menos que',
	'LIST_USER'					=> '1 usuario',
	'LIST_USERS'				=> '%d usuarios',
	'LOGIN_EXPLAIN_LEADERS'		=> 'El administrador del Sitio requiere que esté registrado y se haya identificado para ver la nómina del equipo.',
	'LOGIN_EXPLAIN_MEMBERLIST'	=> 'El administrador del Sitio requiere que esté registrado y se haya identificado para acceder a la lista de usuarios.',
	'LOGIN_EXPLAIN_SEARCHUSER'	=> 'El administrador del Sitio requiere que esté registrado y se haya identificado para buscar usuarios.',
	'LOGIN_EXPLAIN_VIEWPROFILE'	=> 'El administrador del Sitio requiere que esté registrado y se haya identificado para ver perfiles.',
	
	'MORE_THAN'	=> 'Más que',
	
	'NO_EMAIL'		=> 'No tiene permitido enviar email a este usuario.',
	'NO_VIEW_USERS'	=> 'No está autorizado para ver la lista de usuarios o perfiles.',
	
	'ORDER'	=> 'Orden',
	'OTHER'	=> 'Otro',

	'POST_IP'	=> 'Enviado desde IP/dominio',
	
	'REAL_NAME'		=> 'Nombre del destinatario',
	'RECIPIENT'		=> 'Destinatario',
	'REMOVE_FOE'	=> 'Eliminar Ignorado',
	'REMOVE_FRIEND'	=> 'Eliminar amigo',
	
	'SELECT_MARKED'			=> 'Seleccionar marcados',
	'SELECT_SORT_METHOD'	=> 'Seleccione método de orden',
	'SEND_AIM_MESSAGE'		=> 'Enviar mensaje AIM',
	'SEND_ICQ_MESSAGE'		=> 'Enviar mensaje ICQ',
	'SEND_IM'				=> 'Mensaje instantáneo',
	'SEND_JABBER_MESSAGE'	=> 'Enviar mensaje Jabber',
	'SEND_MESSAGE'			=> 'Enviar mensaje',
	'SEND_MSNM_MESSAGE'		=> 'Enviar mensaje MSNM/WLM',
	'SEND_YIM_MESSAGE'		=> 'Enviar mensaje YIM',
	'SORT_EMAIL'			=> 'Email',
	'SORT_LAST_ACTIVE'		=> 'Última actividad',
	'SORT_POST_COUNT'		=> 'Contar mensajes',
	
	'USERNAME_BEGINS_WITH'	=> 'Usuarios que comienzan con',
	'USER_ADMIN'			=> 'Modificar Usuario',
	'USER_BAN'				=> 'Banear',
	'USER_FORUM'			=> 'Estadísticas de usuario',
	'USER_LAST_REMINDED'	=> array(
		0		=> 'Ningún recordatorio enviado hasta este momento',
		1		=> '%1$d recordatorio enviado<br />» %2$s',
	),
	'USER_ONLINE'			=> 'Online',
	'USER_PRESENCE'			=> 'Presente en el foro',
	
	'VIEWING_PROFILE'	=> 'Viendo perfil - %s',
	'VISITED'			=> 'Última visita',
	
	'WWW'				=> 'Sitio web',
));

$lang = array_merge($lang, array(
	// ajaxlike
	'AL_TITLE'				=> 'Last Likes',
	'AL_NO_LIKE'			=> 'No post liked yet.',
	'AL_BY'					=> 'posted by',			// like by
	'AL_AT'					=> 'Liked at',			// like date
	'AL_VIEW'				=> '[View Post]',
	'AL_LIKE_COUNT_TEXT'	=> 'Likes',				// number of likes
	'AL_LIKED_COUNT_TEXT'	=> 'Liked in',			// number of recieved likes
	'AL_POSTS_TEXT'			=> 'posts',
	'AL_POST_TEXT'			=> 'post',
	// ajaxlike
));