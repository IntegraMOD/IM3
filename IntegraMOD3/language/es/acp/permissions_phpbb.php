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
* acp_permissions_phpbb.php [Spanish [Es]]
*
* @package language
* @version $Id: $
* @copyright (c) 2007 phpBB Group. Modified by Huan Manwe for phpbb-es.com in 2007
* @author 2007-11-26 - Traducido por Huan Manwe junto con phpbb-es.com (http://www.phpbb-es.com) basado en la version argentina hecha por larveando.com.ar ).
* @author - ImagePack made by Xoom (webmaster of http://www.muchografico.com and colaborator of http://www.phpbb-es.com)
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License
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

/**
*	MODDERS PLEASE NOTE
*	
*	You are able to put your permission sets into a separate file too by
*	prefixing the new file with permissions_ and putting it into the acp
*	language folder.
*
*	An example of how the file could look like:
*
*	<code>
*
*	if (empty($lang) || !is_array($lang))
*	{
*		$lang = array();
*	}
*
*	// Adding new category
*	$lang['permission_cat']['bugs'] = 'Bugs';
*
*	// Adding new permission set
*	$lang['permission_type']['bug_'] = 'Bug Permissions';
*
*	// Adding the permissions
*	$lang = array_merge($lang, array(
*		'acl_bug_view'		=> array('lang' => 'Can view bug reports', 'cat' => 'bugs'),
*		'acl_bug_post'		=> array('lang' => 'Can post bugs', 'cat' => 'post'), // Using a phpBB category here
*	));
*
*	</code>
*/

// Define categories and permission types
$lang = array_merge($lang, array(
	'permission_cat'	=> array(
		'actions'	=> 'Acciones',
		'content'	=> 'Contenido',
		'forums'	=> 'Foros',
		'misc'		=> 'Varios',
		'permissions'	=> 'Permisos',
		'pm'		=> 'Mensajes privados',
		'polls'		=> 'Encuestas',
		'post'		=> 'Mensaje',
		'post_actions'	=> 'Acciones en mensaje',
		'posting'	=> 'Envío',
		'profile'	=> 'Perfil',
		'settings'	=> 'Configuración',
		'topic_actions'	=> 'Acciones en temas',
		'user_group'	=> 'Usuarios &amp; Grupos',
	),

	// With defining 'global' here we are able to specify what is printed out if the permission is within the global scope.
	'permission_type'	=> array(
		'u_'		=> 'Permisos de usuario',
		'a_'		=> 'Permisos de Admin',
		'm_'		=> 'Permisos de moderador',
		'f_'		=> 'Permisos de Foro',
		'global'	=> array(
			'm_'	=> 'Permisos moderador global',
		),
	),
));

// User Permissions
$lang = array_merge($lang, array(
	'acl_u_viewprofile'	=> array('lang'	=> 'Puede ver perfiles','cat'	=> 'profile',),
	'acl_u_chgname'		=> array('lang'	=> 'Puede cambiar nombre de usuario','cat'	=> 'profile',),
	'acl_u_chgpasswd'	=> array('lang'	=> 'Puede cambiar contraseña','cat'	=> 'profile',),
	'acl_u_chgemail'	=> array('lang'	=> 'Puede cambiar email','cat'	=> 'profile',),
	'acl_u_chgavatar'	=> array('lang'	=> 'Puede cambiar avatar','cat'	=> 'profile',),'acl_u_chggrp'	=> array('lang'	=> 'Puede cambiar grupo de usuarios por defecto','cat'	=> 'profile',),
	'acl_u_chggrp'		=> array('lang' => 'Puede cambiar el grupo de usuarios por defecto', 'cat' => 'profile'),

	'acl_u_attach'		=> array('lang'	=> 'Puede adjuntar archivos','cat'	=> 'post',),
	'acl_u_download'	=> array('lang'	=> 'Puede descargar archivos','cat'	=> 'post',),
	'acl_u_savedrafts'	=> array('lang'	=> 'Puede guardar borradores','cat'	=> 'post',),
	'acl_u_chgcensors'	=> array('lang'	=> 'Puede deshabilitar censura','cat'	=> 'post',),
	'acl_u_sig'			=> array('lang'	=> 'Puede usar firma','cat'	=> 'post',),

	'acl_u_sendpm'		=> array('lang'	=> 'Puede enviar mensajes privados','cat'	=> 'pm',),
	'acl_u_masspm'		=> array('lang'	=> 'Puede enviar mensajes a múltiples usuarios','cat'	=> 'pm',),
	'acl_u_masspm_group'	=> array('lang' => 'Puede enviar mensajes a grupos', 'cat' => 'pm'),
	'acl_u_readpm'		=> array('lang'	=> 'Puede leer mensajes privados','cat'	=> 'pm',),
	'acl_u_pm_edit'		=> array('lang'	=> 'Puede editar sus mensajes privados','cat'	=> 'pm',),
	'acl_u_pm_delete'	=> array('lang'	=> 'Puede borrar mensajes privados de su carpeta','cat'	=> 'pm',),
	'acl_u_pm_forward'	=> array('lang'	=> 'Puede reenviar mensajes privados','cat'	=> 'pm',),
	'acl_u_pm_emailpm'	=> array('lang'	=> 'Puede enviar mp por email','cat'	=> 'pm',),
	'acl_u_pm_printpm'	=> array('lang'	=> 'Puede imprimir mensajes privados','cat'	=> 'pm',),
	'acl_u_pm_attach'	=> array('lang'	=> 'Puede adjuntar archivos en mensajes privados','cat'	=> 'pm',),
	'acl_u_pm_download'	=> array('lang'	=> 'Puede descargar archivos en mensajes privados','cat'	=> 'pm',),
	'acl_u_pm_bbcode'	=> array('lang'	=> 'Puede usar BBCode en mensajes privados','cat'	=> 'pm',),
	'acl_u_pm_smilies'	=> array('lang'	=> 'Puede usar emoticonos en mensajes privados','cat'	=> 'pm',),
	'acl_u_pm_img'		=> array('lang'	=> 'Puede usar imágenes en mensajes privados','cat'	=> 'pm',),
	'acl_u_pm_flash'	=> array('lang'	=> 'Puede usar Flash en mensajes privados','cat'	=> 'pm',),

	'acl_u_sendemail'	=> array('lang'	=> 'Puede enviar emails','cat'	=> 'misc',),
	'acl_u_sendim'		=> array('lang'	=> 'Puede enviar mensajes instantáneos','cat'	=> 'misc',),
	'acl_u_ignoreflood'	=> array('lang'	=> 'Puede ignorar límite de saturación','cat'	=> 'misc',),
	'acl_u_hideonline'	=> array('lang'	=> 'Puede ocultar estado de conexión','cat'	=> 'misc',),
	'acl_u_viewonline'	=> array('lang'	=> 'Puede ver online','cat'	=> 'misc',),
	'acl_u_search'		=> array('lang'	=> 'Puede hacer búsquedas','cat'	=> 'misc',),
));

// Forum Permissions
$lang = array_merge($lang, array(
	'acl_f_list'		=> array('lang'	=> 'Puede ver foros','cat'	=> 'post',),
	'acl_f_read'		=> array('lang'	=> 'Puede leer foros','cat'	=> 'post',),
	'acl_f_post'		=> array('lang'	=> 'Puede iniciar nuevos temas','cat'	=> 'post',),
	'acl_f_reply'		=> array('lang'	=> 'Puede responder temas','cat'	=> 'post',),
	'acl_f_icons'		=> array('lang'	=> 'Puede usar emoticonos en mensajes','cat'	=> 'post',),
	'acl_f_announce'	=> array('lang'	=> 'Puede publicar anuncios','cat'	=> 'post',),
	'acl_f_sticky'		=> array('lang'	=> 'Puede publicar fijos','cat'	=> 'post',),

	'acl_f_poll'		=> array('lang'	=> 'Puede hacer encuestas','cat'	=> 'polls',),
	'acl_f_vote'		=> array('lang'	=> 'Puede votar en encuestas','cat'	=> 'polls',),
	'acl_f_votechg'		=> array('lang'	=> 'Puede cambiar una encuesta existente','cat'	=> 'polls',),

	'acl_f_attach'		=> array('lang'	=> 'Puede adjuntar archivos','cat'	=> 'content',),
	'acl_f_download'	=> array('lang'	=> 'Puede descargar archivos','cat'	=> 'content',),
	'acl_f_sigs'		=> array('lang'	=> 'Puede usar firmas','cat'	=> 'content',),
	'acl_f_bbcode'		=> array('lang'	=> 'Puede usar BBCode','cat'	=> 'content',),
	'acl_f_smilies'		=> array('lang'	=> 'Puede usar emoticonos','cat'	=> 'content',),
	'acl_f_img'		=> array('lang'	=> 'Puede usar la etiqueta BBCode [img]','cat'	=> 'content',),
	'acl_f_flash'		=> array('lang'	=> 'Puede usar la etiqueta BBCode [flash]','cat'	=> 'content',),

	'acl_f_edit'		=> array('lang'	=> 'Puede editar sus mensajes','cat'	=> 'actions',),
	'acl_f_delete'		=> array('lang'	=> 'Puede borrar sus mensajes','cat'	=> 'actions',),
	'acl_f_user_lock'	=> array('lang'	=> 'Puede bloquear sus mensajes','cat'	=> 'actions',),
	'acl_f_bump'		=> array('lang'	=> 'Puede activar temas','cat'	=> 'actions',),
	'acl_f_report'		=> array('lang'	=> 'Puede reportar mensajes','cat'	=> 'actions',),
	'acl_f_subscribe'	=> array('lang'	=> 'Puede suscribir a foros','cat'	=> 'actions',),
	'acl_f_print'		=> array('lang'	=> 'Puede imprimir temas','cat'	=> 'actions',),
	'acl_f_email'		=> array('lang'	=> 'Puede enviar temas por email','cat'	=> 'actions',),

	'acl_f_search'		=> array('lang'	=> 'Puede buscar en foros','cat'	=> 'misc',),
	'acl_f_ignoreflood'	=> array('lang'	=> 'Puede ignorar límite de saturación','cat'	=> 'misc',),
	'acl_f_postcount'	=> array('lang'	=> 'Incrementar cuenta de mensaje<br /><em>Por favor obsérvese que este parámetro solo afecta a mensajes nuevos.</em>','cat'	=> 'misc',),
	'acl_f_noapprove'	=> array('lang'	=> 'Puede publicar sin aprobación','cat'	=> 'misc',),
));

// Moderator Permissions
$lang = array_merge($lang, array(
	'acl_m_edit'		=> array('lang'	=> 'Puede editar mensajes','cat'	=> 'post_actions',),
	'acl_m_delete'		=> array('lang'	=> 'Puede borrar mensajes','cat'	=> 'post_actions',),
	'acl_m_approve'		=> array('lang'	=> 'Puede aprobar mensajes','cat'	=> 'post_actions',),
	'acl_m_report'		=> array('lang'	=> 'Puede cerrar y borrar informes','cat'	=> 'post_actions',),
	'acl_m_chgposter'	=> array('lang'	=> 'Puede cambiar autor en mensajes','cat'	=> 'post_actions',),

	'acl_m_move'		=> array('lang'	=> 'Puede mover temas','cat'	=> 'topic_actions',),
	'acl_m_lock'		=> array('lang'	=> 'Puede bloquear temas','cat'	=> 'topic_actions',),
	'acl_m_split'		=> array('lang'	=> 'Puede dividir temas','cat'	=> 'topic_actions',),
	'acl_m_merge'		=> array('lang'	=> 'Puede unir temas','cat'	=> 'topic_actions',),

	'acl_m_info'		=> array('lang'	=> 'Puede ver detalles de mensaje','cat'	=> 'misc',),
	'acl_m_warn'		=> array('lang'	=> 'Puede hacer advertencia','cat'	=> 'misc',),
	'acl_m_ban'		=> array('lang'	=> 'Puede administrar exclusiones','cat'	=> 'misc',),
));

// Admin Permissions
$lang = array_merge($lang, array(
	'acl_a_board'		=> array('lang'	=> 'Puede modificar configuración de sitio/verificar actualizaciones','cat'	=> 'settings',),
	'acl_a_server'		=> array('lang'	=> 'Puede modificar configuración de servidor/comunicación','cat'	=> 'settings',),
	'acl_a_jabber'		=> array('lang'	=> 'Puede modificar parámetros Jabber','cat'	=> 'settings',),
	'acl_a_phpinfo'		=> array('lang'	=> 'Puede ver configuración de PHP','cat'	=> 'settings',),

	'acl_a_forum'		=> array('lang'	=> 'Puede administrar foros','cat'	=> 'forums',),
	'acl_a_forumadd'	=> array('lang'	=> 'Puede agregar nuevos foros','cat'	=> 'forums',),
	'acl_a_forumdel'	=> array('lang'	=> 'Puede borrar foros','cat'	=> 'forums',),
	'acl_a_prune'		=> array('lang'	=> 'Puede purgar foros','cat'	=> 'forums',),

	'acl_a_icons'		=> array('lang'	=> 'Puede modificar iconos de tema y emoticonos','cat'	=> 'posting',),
	'acl_a_words'		=> array('lang'	=> 'Puede modificar palabras censuradas','cat'	=> 'posting',),
	'acl_a_bbcode'		=> array('lang'	=> 'Puede definir código BBCode','cat'	=> 'posting',),
	'acl_a_attach'		=> array('lang'	=> 'Puede modificar parámetros relativos a adjuntos','cat'	=> 'posting',),

	'acl_a_user'		=> array('lang'	=> 'Puede administrar usuarios','cat'	=> 'user_group',),
	'acl_a_userdel'		=> array('lang'	=> 'Puede borrar/purgar usuarios','cat'	=> 'user_group',),
	'acl_a_group'		=> array('lang'	=> 'Puede administrar grupos','cat'	=> 'user_group',),
	'acl_a_groupadd'	=> array('lang'	=> 'Puede agregar nuevos grupos','cat'	=> 'user_group',),
	'acl_a_groupdel'	=> array('lang'	=> 'Puede borrar grupos','cat'	=> 'user_group',),
	'acl_a_ranks'		=> array('lang'	=> 'Puede manejar rangos','cat'	=> 'user_group',),
	'acl_a_profile'		=> array('lang'	=> 'Puede administrar campos de perfil personalizados','cat'	=> 'user_group',),
	'acl_a_names'		=> array('lang'	=> 'Puede administrar nombres deshabilitados','cat'	=> 'user_group',),
	'acl_a_ban'		=> array('lang'	=> 'Puede administrar exclusiones','cat'	=> 'user_group',),

	'acl_a_viewauth'	=> array('lang'	=> 'Puede ver máscaras de permisos','cat'	=> 'permissions',),
	'acl_a_authgroups'	=> array('lang'	=> 'Puede modificar permisos para grupos individuales','cat'	=> 'permissions',),
	'acl_a_authusers'	=> array('lang'	=> 'Puede modificar permisos para usuarios individuales','cat'	=> 'permissions',),
	'acl_a_fauth'		=> array('lang'	=> 'Puede modificar tipos de permisos de foros','cat'	=> 'permissions',),
	'acl_a_mauth'		=> array('lang'	=> 'Puede modificar tipos de permisos de moderadores','cat'	=> 'permissions',),
	'acl_a_aauth'		=> array('lang'	=> 'Puede modificar tipos de permisos de Admin','cat'	=> 'permissions',),
	'acl_a_uauth'		=> array('lang'	=> 'Puede modificar tipos de permisos de usuario','cat'	=> 'permissions',),
	'acl_a_roles'		=> array('lang'	=> 'Puede administrar roles','cat'	=> 'permissions',),
	'acl_a_switchperm'	=> array('lang'	=> 'Puede usar otros permisos','cat'	=> 'permissions',),
	
	'acl_a_styles'		=> array('lang'	=> 'Puede administrar estilos','cat'	=> 'misc',),
	'acl_a_viewlogs'	=> array('lang'	=> 'Puede ver registros','cat'	=> 'misc',),
	'acl_a_clearlogs'	=> array('lang'	=> 'Puede limpiar registros','cat'	=> 'misc',),
	'acl_a_modules'		=> array('lang'	=> 'Puede administrar módulos','cat'	=> 'misc',),
	'acl_a_modules'		=> array('lang' => 'Puede administrar modulos', 'cat' => 'misc'),
	'acl_a_language'	=> array('lang'	=> 'Puede administrar paquetes de idioma','cat'	=> 'misc',),
	'acl_a_email'		=> array('lang'	=> 'Puede enviar emails masivos','cat'	=> 'misc',),
	'acl_a_bots'		=> array('lang'	=> 'Puede administrar bots','cat'	=> 'misc',),
	'acl_a_reasons'		=> array('lang'	=> 'Puede administrar motivos de reporte/negación','cat'	=> 'misc',),
	'acl_a_backup'		=> array('lang'	=> 'Puede resguardar/restaurar base de datos','cat'	=> 'misc',),
	'acl_a_search'		=> array('lang'	=> 'Puede administrar motores de búsqueda y parámetros','cat'	=> 'misc',),
));

//---BEGIN CALENDAR MOD---
// Add new category for permissions
$lang['permission_cat']['calendar'] = 'Calendar';

$lang = array_merge($lang, array(
    'acl_u_view_event'    		=> array('lang' => 'Can view events', 'cat' => 'calendar'),
    'acl_u_new_event'     		=> array('lang' => 'Can post a new event', 'cat' => 'calendar'),
    'acl_u_edit_event'    		=> array('lang' => 'Can edit own events', 'cat' => 'calendar'),
    'acl_u_delete_event'  		=> array('lang' => 'Can delete own events', 'cat' => 'calendar'),
	'acl_u_allow_index_minical'	=> array('lang' => 'Can view the minical on the index page', 'cat' => 'calendar'),
 	'acl_m_edit_event'    		=> array('lang' => 'Can edit other\'s events', 'cat' => 'calendar'),
    'acl_m_delete_event'  		=> array('lang' => 'Can delete other\'s events', 'cat' => 'calendar'),
    'acl_a_calendar_manage'		=> array('lang' => 'Can manage calendar', 'cat' => 'calendar'),
    'acl_a_edit_event'    		=> array('lang' => 'Can edit other\'s events', 'cat' => 'calendar'),
    'acl_a_delete_event'  		=> array('lang' => 'Can delete other\'s events', 'cat' => 'calendar'),
	'acl_a_publish_rss'   		=> array('lang' => 'Can publish calendar RSS feeds', 'cat' => 'calendar'),
));
//---END CALENDAR MOD---

//---BEGIN KNOWLEDGE BASE MOD---
// Adding the permissions
$lang['permission_cat']['kb'] = 'Knowledge Base';
$lang['permission_cat']['read'] = 'read';
$lang['permission_cat']['write'] = 'write';
$lang['permission_type']['kb_'] = 'Knowledge Base';
$lang = array_merge($lang, array(
	'acl_kb_print_article'		=> array('lang' => 'Can print articles', 'cat' => 'read'),
	'acl_kb_view_article'		=> array('lang' => 'Can view articles in this category', 'cat' => 'read'),
	'acl_kb_download'			=> array('lang' => 'Can download attachements', 'cat' => 'read'),
	'acl_kb_report_article'		=> array('lang' => 'Can report article', 'cat' => 'read'),
	'acl_kb_rate_article'		=> array('lang' => 'Can rate article', 'cat' => 'read'),
	'acl_u_rate_kb'				=> array('lang' => 'Can rate article', 'cat' => 'read'),
	'acl_kb_attache_article'	=> array('lang' => 'Can upload attachements', 'cat' => 'write'),
	'acl_kb_edit_article'		=> array('lang' => 'Can edit own articles', 'cat' => 'write'),
	'acl_kb_del_article'		=> array('lang' => 'Can delete own articles', 'cat' => 'write'),
	'acl_kb_add_article'		=> array('lang' => 'Can add articles', 'cat' => 'write'),
	'acl_kb_add_article_direct'	=> array('lang' => 'Can add articles without activation', 'cat' => 'write'),
	'acl_kb_edit_all_article'	=> array('lang' => 'Can edit all articles', 'cat' => 'write'),
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
//---END KNOWLEDGE BASE MOD---

// Meeting MOD Permissions
	'acl_a_meeting_config'	=> array('lang' => 'Can manage the meeting configuration', 'cat' => 'meeting'),
	'acl_a_meeting_add'		=> array('lang' => 'Can add new meetings', 'cat' => 'meeting'),
	'acl_a_meeting_manage'	=> array('lang' => 'Can manage existing meetings', 'cat' => 'meeting'),
	'acl_u_meeting'			=> array('lang' => 'Can edit meetings', 'cat' => 'meeting'),

// ajaxlike
	'acl_u_ajaxlike_mod'	=>	array('lang' => 'Can like posts', 'cat' => 'misc'),
	'acl_f_ajaxlike_mod'	=>	array('lang' => 'Can like posts in forum', 'cat' => 'misc'),
	'acl_a_ajaxlike_mod'	=>	array('lang' => 'Can manage likes', 'cat' => 'misc'),
));