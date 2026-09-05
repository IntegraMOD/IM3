<?php
/**
 * - [Spanish [Es]]
 *
 * @package phpBB Social Network
 * @version 1.0.0
 * @copyright (c) phpBB Social Network Team 2010-2012 http://phpbbsocialnetwork.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (!isset($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	/**
	 * Edit these two lines write your own Welcome text for unregistered guests on Activity page.
	 */
	'SN_AP_WELCOME_TITLE'					 => '&iexcl;Bienvenido a nuestro sitio web!',
	'SN_AP_WELCOME_TEXT'					 => 'No dudes en registrarte y usar todas las funciones de nuestro sitio web.<br /><br />Un saludo,<br />la Administraci&oacute;n',

	'SN_MODULE_IM_NAME'						 => 'Mensajer&iacute;a instant&aacute;nea',
	'SN_MODULE_USERSTATUS_NAME'				 => 'Estado del usuario',
	'SN_MODULE_APPROVAL_NAME'				 => 'Sistema de gesti&oacute;n de amigos',

	'SN_IM_CHAT'							 => 'Chat',
	'SN_IM_NO_ONLINE_USER'					 => 'No hay usuarios conectados',
	'SN_IM_YOU_ARE_OFFLINE'					 => 'Est&aacute;s desconectado',
	'SN_IM_SOUND'							 => 'Sonido',
	'SN_IM_SELECT_NAME'						 => 'Elige un sonido',
	'SN_IM_NEW_MESSAGE'						 => 'Nuevo mensaje',
	'SN_IM_LOGIN'							 => 'Conectado',
	'SN_IM_LOGOUT'							 => 'Desconectado',
	'SN_IM_PRESS_TO_CLOSE'					 => 'Presiona %1$s para cerrar la ventana de chat',
	'SN_IM_PRESS_TO_SEND'					 => 'Presiona %1$s para enviar el mensaje',

	'SN_US_SHARE_STATUS'					 => 'Compartir',
	'SN_US_WHATS_ON_YOUR_MIND'				 => '&iquest;En qu&eacute; est&aacute;s pensando?',
	'SN_US_EMPTY_STATUS'					 => 'No puedes publicar un estado vac&iacute;o',
	'SN_US_COMMENT'							 => 'Comentar',
	'SN_US_EMPTY_COMMENT'					 => 'No puedes enviar un comentario vac&iacute;o',
	'SN_US_USER_STATUS_WALL'				 => 'Actividad',
	'SN_US_WRITE_COMMENT'					 => 'Escribe un comentario...',
	'SN_US_COMMENT_STATUS'					 => 'Comentar',
	'SN_US_HAS_NO_STATUS'					 => 'no tiene estado',
	'SN_US_HAS_DELETED_STATUS'				 => 'Este estado ha sido eliminado',
	'SN_STATUS_NOT_EXISTS'					 => 'Este estado no existe',
	'SN_US_HAS_NO_ACTIVITY'					 => 'no tiene actividad',
	'SN_US_SHARED_STATUS'					 => 'Has compartido tu estado',
	'SN_US_DELETE_STATUS'					 => 'Eliminar',
	'SN_US_LOAD_MORE'						 => 'Publicaciones anteriores',
	'SN_US_VIEW'						 	 => 'Ver',
	'SN_US_LOAD_MORE_COMMENT'				 => 'm&aacute;s comentario',
	'SN_US_LOAD_MORE_COMMENTS'				 => 'm&aacute;s comentarios',
	'SN_US_CONFIRM'							 => 'Confirmar',
	'SN_US_CLOSE'							 => 'Cerrar',
	'SN_US_CANCEL'							 => 'Cancelar',
	'SN_US_SHARED_A'						 => 'ha compartido un',
	'SN_US_LINK'							 => 'enlace',

	//
	// FETCH PAGE
	//
	'SN_US_FETCH_PAGE'						 => 'Obtener p&aacute;gina',
	'SN_US_FETCH_CLEAR'						 => 'Limpiar p&aacute;gina cargada',
	'SN_US_NO_VIDEO_THUMB'					 => 'Sin vista previa de v&iacute;deo',
	'LOADER'								 => 'Cargando',
	'NEXT_IMAGE'							 => 'Siguiente imagen',
	'PREVIOUS_IMAGE'						 => 'Imagen anterior',
	'OF'									 => 'de',
	'SN_US_NO_IMG_THUMB'					 => 'Sin vista previa de imagen',
	'SN_US_CHOOSE_THUMB'					 => 'im&aacute;genes',
	'SN_CB_FETCH_ERROR'						 => 'Se produjo un error al obtener la p&aacute;gina web',

	'SN_AP_ACTIVITYPAGE'					 => 'Mi red',
	'SN_AP_AND'								 => 'y',
	'SN_AP_ARE_FRIENDS'						 => 'ahora son amigos',
	'SN_AP_ADD_AS_FRIEND'					 => 'A&ntilde;adir como amigo',
	'SN_AP_PRIVATE_MESSAGE'					 => 'Mensajes',
	'SN_AP_MANAGE_PROFILE'					 => 'Editar mi perfil',
	'SN_AP_VIEW_FRIENDS'					 => 'Ver mis amigos',
	'SN_AP_VIEW_SUGGESTIONS'				 => 'Personas que quiz&aacute;s conozcas',
	'SN_AP_MANAGE_FRIENDS'					 => 'Gestionar amigos',
	'SN_AP_BOARD'							 => 'Foro de discusi&oacute;n',
	'SN_AP_VIEW_MEMBERLIST'					 => 'Ver miembros',
	'SN_AP_LOG_OUT'							 => 'Cerrar sesi&oacute;n',
	'SN_AP_LAST_POSTS'						 => 'Debates recientes',
	'SN_AP_TOTAL_FRIEND'					 => 'Tienes 1 amigo',
	'SN_AP_TOTAL_FRIENDS'					 => 'Tienes %s amigos',
	'SN_AP_FRIEND_SUGGESTIONS'				 => 'Personas que quiz&aacute;s conozcas',
	'SN_AP_REQUESTS_LIST'					 => 'Solicitudes',
	'SN_AP_ONLINE_FRIENDS'					 => 'Amigos conectados',
	'SN_AP_NO_ONLINE_USER'					 => 'No hay usuarios conectados',
	'SN_AP_NO_DISCUSSION'					 => 'No hay debates recientes',
	'SN_AP_NO_BIRTHDAY'					 	 => 'No hay cumplea&ntilde;os pr&oacute;ximos',
	'SN_AP_NO_ENTRY'						 => 'No hay novedades aqu&iacute;',
	'SN_AP_LOAD_NEWS'						 => 'Actualizar',
	'SN_AP_SEE_ALL'							 => 'Ver todo',
	'SN_AP_NO_FRIENDS'						 => 'No tienes amigos',
	'SN_AP_KEEP_LOGGEDIN'					 => 'Recordarme',
	'SN_AP_STATISTICS'						 => 'Estad&iacute;sticas',
	'SN_AP_TOTAL_USERS'						 => '<strong>%d</strong> miembros',
	'SN_AP_TOTAL_POSTS'						 => '<strong>%d</strong> mensajes',
	'SN_AP_TOTAL_TOPICS'					 => '<strong>%d</strong> temas',
	'SN_AP_TOPICS_PER_DAY'					 => '<strong>%d</strong> temas por d&iacute;a',
	'SN_AP_POSTS_PER_DAY'					 => '<strong>%d</strong> mensajes por d&iacute;a',
	'SN_AP_USERS_PER_DAY'					 => '<strong>%d</strong> usuarios por d&iacute;a',
	'SN_AP_BIRTHDAY'						 => 'Cumplea&ntilde;os',
	'SN_AP_BIRTHDAY_1'						 => 'cumplea&ntilde;os <span class="sn-ap-textNoWrap">%1$s</span>',
	'SN_AP_BIRTHDAY_2'						 => 'cumplea&ntilde;os el <span class="sn-ap-textNoWrap">%1$s</span>',
	'SN_AP_BIRTHDAY_USERNAME'				 => 'de %1$s',
	'SN_AP_WELCOME'							 => 'Bienvenido',
	'SN_AP_VIEWING_ACTIVITYPAGE'			 => 'Viendo p&aacute;gina de actividad',
	'SN_AP_NO_SUGGESTIONS'					 => 'Actualmente no tienes sugerencias de amistad',
	'SN_AP_SEARCH'							 => 'Buscar…',
	'SN_AP_CHANGED_PROFILE_HIS'				 => 'ha actualizado su perfil',
	'SN_AP_CHANGED_PROFILE_HER'				 => 'ha actualizado su perfil',
	'SN_AP_CHANGED_PROFILE_THEIR'			 => 'han actualizado su perfil',
	'SN_UP_CHANGED_AVATAR_HIS'				 => 'ha cambiado su avatar',
	'SN_UP_CHANGED_AVATAR_HER'				 => 'ha cambiado su avatar',
	'SN_UP_CHANGED_AVATAR_THEIR'			 => 'han cambiado su avatar',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_HIS'		 => 'ha a&ntilde;adido a %1$s (%2$s) como nuevo miembro de la familia en su perfil',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_HER'		 => 'ha a&ntilde;adido a %1$s (%2$s) como nuevo miembro de la familia en su perfil',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_THEIR'	 => 'han a&ntilde;adido a %1$s (%2$s) como nuevo miembro de la familia en su perfil',
	'SN_AP_CHANGED_RELATIONSHIP_HIS'		 => 'ha a&ntilde;adido una nueva relaci&oacute;n a su perfil',
	'SN_AP_CHANGED_RELATIONSHIP_HER'		 => 'ha a&ntilde;adido una nueva relaci&oacute;n a su perfil',
	'SN_AP_CHANGED_RELATIONSHIP_THEIR'		 => 'han a&ntilde;adido una nueva relaci&oacute;n a su perfil',
	'SN_UP_SEND_EMOTE'						 => 'ha enviado un emote a',

	'SN_PROFILE'							 => 'Perfil',
	'SN_MYPROFILE'							 => 'Mi perfil',

	// User profile
	'SN_UP_PROFILE_UPDATED'					 => 'Tu perfil se ha actualizado correctamente.',
	'SN_UP_HOMETOWN'						 => 'Ciudad natal',
	'SN_UP_SEX'								 => 'Sexo',
	'SN_UP_INTERESTED_IN'					 => 'Interesado en',
	'SN_UP_PRIVACY_LEVEL'					 => 'Nivel de privacidad',
	'SN_UP_PRIVACY_PRIVATE'					 => 'Privado (solo administradores)',
	'SN_UP_PRIVACY_FRIENDS'					 => 'Solo amigos',
	'SN_UP_PRIVACY_DEFAULT'					 => 'Predeterminado (todos)',
	'SN_UP_ALLOW_FRIEND_REQUESTS'			 => 'Permitir que los miembros me envíen solicitudes de amistad',
	'SN_UP_PRIVACY_LOCKED'					 => 'El administrador del foro no permite que los miembros cambien su política de privacidad.',
	'SN_UP_PRIVACY_DEFAULT_NOTICE'			 => 'La política de privacidad predeterminada del foro es: <strong>%s</strong>.',
	'SN_UP_LANGUAGES'						 => 'Idiomas',
	'SN_UP_ABOUT_ME'						 => 'Sobre m&iacute;',
	'SN_UP_EMPLOYER'						 => 'Empresa',
	'SN_UP_UNIVERSITY'						 => 'Universidad',
	'SN_UP_HIGH_SCHOOL'						 => 'Instituto',
	'SN_UP_OCCUPATION'						 => 'Ocupaci&oacute;n',
	'SN_UP_RELIGION'						 => 'Religi&oacute;n',
	'SN_UP_POLITICAL_VIEWS'					 => 'Ideolog&iacute;a pol&iacute;tica',
	'SN_UP_QUOTATIONS'						 => 'Citas favoritas',
	'SN_UP_INTERESTS'						 => 'Intereses',
	'SN_UP_MUSIC'							 => 'M&uacute;sica',
	'SN_UP_BOOKS'							 => 'Libros',
	'SN_UP_MOVIES'							 => 'Pel&iacute;culas',
	'SN_UP_GAMES'							 => 'Juegos',
	'SN_UP_FOODS'							 => 'Comidas',
	'SN_UP_SPORTS'							 => 'Deportes que practicas',
	'SN_UP_SPORT_TEAMS'						 => 'Equipos deportivos favoritos',
	'SN_UP_ACTIVITIES'						 => 'Actividades',
	'SN_UP_SKYPE'							 => 'Skype',
	'SN_UP_FACEBOOK'						 => 'Facebook',
	'SN_UP_TWITTER'							 => 'Twitter',
	'SN_UP_YOUTUBE'							 => 'Youtube',
	'SN_UP_USER_ICQ'						 => 'N&uacute;mero ICQ',
	'SN_UP_USER_AIM'						 => 'AOL Instant Messenger',
	'SN_UP_USER_MSNM'						 => 'WL/MSN Messenger',
	'SN_UP_USER_YIM'						 => 'Yahoo Messenger',
	'SN_UP_USER_JABBER'						 => 'Direcci&oacute;n Jabber',
	'SN_UP_USER_WEBSITE'					 => 'Sitio web',
	'SN_UP_USER_FROM'						 => 'Ubicaci&oacute;n',
	'SN_UP_USER_INTERESTS'					 => 'Intereses',
	'SN_UP_BDAY_MONTH'						 => 'Mes de nacimiento',
	'SN_UP_BDAY_DAY'						 => 'D&iacute;a de nacimiento',
	'SN_UP_BDAY_YEAR'						 => 'A&ntilde;o de nacimiento',
	'SN_UP_USERNAME'						 => 'Nombre de usuario',
	'SN_UP_USER_EMAIL'						 => 'Correo electr&oacute;nico',
	'SN_UP_USER_BIRTHDAY'					 => 'Cumplea&ntilde;os',
	'SN_UP_USER_OCC'						 => 'Ocupaci&oacute;n',
	'SN_UP_USER_SIG'						 => 'Firma',
	'SN_UP_PROFILE_VIEWS'					 => 'Visitas al perfil',
	'SN_UP_X_TIMES'							 => 'veces',
	'SN_UP_PROFILE_VISITORS'				 => 'Visitantes del perfil',
	'SN_UP_LAST_CHANGE'						 => '&Uacute;ltima actualizaci&oacute;n del perfil',
	'SN_UP_MALE'							 => 'Hombre',
	'SN_UP_MALES'							 => 'Hombres',
	'SN_UP_FEMALE'							 => 'Mujer',
	'SN_UP_FEMALES'							 => 'Mujeres',
	'SN_UP_BOTH'							 => 'Ambos',
	'SN_UP_RELATIONSHIP'					 => 'Estado civil / Relaci&oacute;n',
	'SN_UP_SINGLE'							 => 'Soltero/a',
	'SN_UP_IN_RELATIONSHIP'					 => 'En una relaci&oacute;n',
	'SN_UP_ENGAGED'							 => 'Prometido/a',
	'SN_UP_MARRIED'							 => 'Casado/a',
	'SN_UP_ITS_COMPLICATED'					 => 'Es complicado',
	'SN_UP_OPEN_RELATIONSHIP'				 => 'En una relaci&oacute;n abierta',
	'SN_UP_WIDOWED'							 => 'Viudo/a',
	'SN_UP_SEPARATED'						 => 'Separado/a',
	'SN_UP_DIVORCED'						 => 'Divorciado/a',
	'SN_UP_TO'								 => 'con',
	'SN_UP_WITH'							 => 'con',
	'SN_UP_ANNIVERSARY'						 => 'Aniversario',
	'SN_UP_ANNIVERSARY_ON'					 => 'Aniversario el',
	'SN_UP_BIRTHDAY'						 => 'Fecha de nacimiento',
	'SN_UP_SUNDAY'							 => 'Domingo',
	'SN_UP_MONDAY'							 => 'Lunes',
	'SN_UP_TUESDAY'							 => 'Martes',
	'SN_UP_WEDNESDAY'						 => 'Mi&eacute;rcoles',
	'SN_UP_THURSDAY'						 => 'Jueves',
	'SN_UP_FRIDAY'							 => 'Viernes',
	'SN_UP_SATURDAY'						 => 'S&aacute;bado',
	'SN_UP_SUNDAY_MIN'						 => 'Do',
	'SN_UP_MONDAY_MIN'						 => 'Lu',
	'SN_UP_TUESDAY_MIN'						 => 'Ma',
	'SN_UP_WEDNESDAY_MIN'					 => 'Mi',
	'SN_UP_THURSDAY_MIN'					 => 'Ju',
	'SN_UP_FRIDAY_MIN'						 => 'Vi',
	'SN_UP_SATURDAY_MIN'					 => 'S&aacute;',
	'SN_UP_JANUARY_MIN'						 => 'Ene',
	'SN_UP_FEBRUARY_MIN'					 => 'Feb',
	'SN_UP_MARCH_MIN'						 => 'Mar',
	'SN_UP_APRIL_MIN'						 => 'Abr',
	'SN_UP_MAY_MIN'							 => 'May',
	'SN_UP_JUNE_MIN'						 => 'Jun',
	'SN_UP_JULY_MIN'						 => 'Jul',
	'SN_UP_AUGUST_MIN'						 => 'Ago',
	'SN_UP_SEPTEMBER_MIN'					 => 'Sep',
	'SN_UP_OCTOBER_MIN'						 => 'Oct',
	'SN_UP_NOVEMBER_MIN'					 => 'Nov',
	'SN_UP_DECEMBER_MIN'					 => 'Dic',
	'SN_UP_FAMILY'							 => 'Familia',
	'SN_UP_SELECT_RELATIONSHIP'				 => 'A&ntilde;adir una relaci&oacute;n',
	'SN_UP_SELECT_FAMILY_RELATION'			 => 'A&ntilde;adir un miembro de la familia',
	'SN_UP_SISTER'							 => 'Hermana',
	'SN_UP_BROTHER'							 => 'Hermano',
	'SN_UP_DAUGHTER'						 => 'Hija',
	'SN_UP_SON'								 => 'Hijo',
	'SN_UP_MOTHER'							 => 'Madre',
	'SN_UP_FATHER'							 => 'Padre',
	'SN_UP_AUNT'							 => 'T&iacute;a',
	'SN_UP_UNCLE'							 => 'T&iacute;o',
	'SN_UP_NIECE'							 => 'Sobrina',
	'SN_UP_NEPHEW'							 => 'Sobrino',
	'SN_UP_COUSIN_FEMALE'					 => 'Prima',
	'SN_UP_COUSIN_MALE'						 => 'Primo',
	'SN_UP_GRANDDAUGHTER'					 => 'Nieta',
	'SN_UP_GRANDSON'						 => 'Nieto',
	'SN_UP_GRANDMOTHER'						 => 'Abuela',
	'SN_UP_GRANDFATHER'						 => 'Abuelo',
	'SN_UP_SISTER_IN_LAW'					 => 'Cu&ntilde;ada',
	'SN_UP_BROTHER_IN_LAW'					 => 'Cu&ntilde;ado',
	'SN_UP_MOTHER_IN_LAW'					 => 'Suegra',
	'SN_UP_FATHER_IN_LAW'					 => 'Suegro',
	'SN_UP_DAUGHTER_IN_LAW'					 => 'Nuera',
	'SN_UP_SON_IN_LAW'						 => 'Yerno',
	'SN_UP_ADD_FAMILY_MEMBER'				 => 'A&ntilde;adir miembro de la familia',
	'SN_UP_ADD_FAMILY_ERR_MEMBER_EMPTY'		 => 'Nombre de miembro de la familia vac&iacute;o',
	'SN_UP_APPROVE'							 => 'Aprobar',
	'SN_UP_IGNORE'							 => 'Ignorar',
	'SN_UP_APPROVE_RELATION_SUBJECT'		 => '%1$s ha indicado una relaci&oacute;n contigo',
	'SN_UP_APPROVE_RELATION_TEXT'			 => '%2$s ha indicado la relaci&oacute;n contigo: <strong>%3$s %2$s</strong>.<br /><br />%1$sPuedes aprobar esta relaci&oacute;n aqu&iacute;%4$s',
	'SN_UP_APPROVE_RELATION_CONFIRM'		 => '&iquest;Est&aacute;s seguro de que deseas aprobar esta relaci&oacute;n?',
	'SN_UP_REFUSE_RELATION_CONFIRM'			 => '&iquest;Est&aacute;s seguro de que deseas rechazar esta relaci&oacute;n?',
	'SN_UP_APPROVE_RELATION_ERROR_CANCELED'	 => 'Esta relaci&oacute;n ha sido cancelada',
	'SN_UP_APPROVE_RELATION_ERROR_MYSELF'	 => 'No puedes crear una relaci&oacute;n contigo mismo',
	'SN_UP_APPROVE_RELATION_ERROR_APPROVED'	 => 'Esta relaci&oacute;n ya ha sido aprobada',
	'SN_UP_APPROVE_RELATION_ERROR_REFUSED'	 => 'Esta relaci&oacute;n ya ha sido rechazada',
	'SN_UP_APPROVE_RELATION_VICE_VERSA'		 => 'Tambi&eacute;n quiero a&ntilde;adir esta relaci&oacute;n a mi perfil.',
	'SN_UP_DELETE_RELATIONSHIP_CONFIRM'		 => '&iquest;Est&aacute;s seguro de que deseas eliminar esta relaci&oacute;n?',
	'SN_UP_APPROVE_RELATION_NO_RELATIONSHIP' => 'Sin estado de relaci&oacute;n',
	'SN_UP_APPROVE_FAMILY_SUBJECT'			 => '%1$s te ha a&ntilde;adido como %2$s',
	'SN_UP_APPROVE_FAMILY_TEXT'				 => '%2$s te ha a&ntilde;adido como <strong>%3$s</strong>.<br /><br />%1$sPuedes aprobar esta relaci&oacute;n aqu&iacute;%4$s',
	'SN_UP_APPROVE_FAMILY_CONFIRM'			 => '&iquest;Est&aacute;s seguro de que deseas aprobar esta relaci&oacute;n familiar?',
	'SN_UP_REFUSE_FAMILY_CONFIRM'			 => '&iquest;Est&aacute;s seguro de que deseas rechazar esta relaci&oacute;n familiar?',
	'SN_UP_APPROVE_FAMILY_ERROR_CANCELED'	 => 'Esta relaci&oacute;n familiar ha sido cancelada',
	'SN_UP_APPROVE_FAMILY_ERROR_MYSELF'		 => 'No puedes a&ntilde;adirte a ti mismo como miembro de tu familia',
	'SN_UP_APPROVE_FAMILY_ERROR_APPROVED'	 => 'Esta relaci&oacute;n familiar ya ha sido aprobada.',
	'SN_UP_APPROVE_FAMILY_ERROR_REFUSED'	 => 'Esta relaci&oacute;n familiar ya ha sido rechazada.',
	'SN_UP_APPROVE_FAMILY_ERROR_EXIST'		 => '%1$s ya ha sido a&ntilde;adido a tu familia',
	'SN_UP_APPROVE_FAMILY_VICE_VERSA'		 => 'Tambi&eacute;n quiero a&ntilde;adir a %1$s como miembro de mi familia.',
	'SN_UP_APPROVE_FAMILY_USERNAME'			 => '%1$s es mi',
	'SN_UP_APPROVE_NO_FAMILY_MEMBER'		 => 'Ning&uacute;n miembro de la familia',
	'SN_UP_DELETE_FAMILY_CONFIRM'			 => '&iquest;Est&aacute;s seguro de que deseas eliminar a <strong>%1$s</strong> de tus familiares?',
	'SN_UP_USERNAME_NOT_EXIST'				 => 'El nombre de usuario introducido no existe',
	'SN_UP_NOT_APPROVED'					 => 'a&uacute;n no aprobado',
	'SN_UP_RELATION_REFUSED'				 => 'rechazado',
	'SN_UP_RELATION_REQUESTS'				 => 'Solicitudes',
	'SN_UP_APPROVE_REQUESTS'				 => 'Aprobar relaci&oacute;n',
	'WRONG_DATA_FACEBOOK'					 => 'La direcci&oacute;n de Facebook debe ser una URL v&aacute;lida, incluyendo el protocolo http. Por ejemplo http://www.facebook.com/<usuario>/',
	'WRONG_DATA_TWITTER'					 => 'La direcci&oacute;n de Twitter debe ser una URL v&aacute;lida, incluyendo el protocolo http. Por ejemplo http://twitter.com/<usuario>/',
	'WRONG_DATA_YOUTUBE'					 => 'La direcci&oacute;n de Youtube debe ser una URL v&aacute;lida, incluyendo el protocolo http. Por ejemplo http://www.youtube.com/user/<usuario>/',
	'WRONG_DATA_FAMILY_USER'				 => 'Uno de los nombres de usuario familiares introducidos no existe',
	'WRONG_DATA_RELATION_USER'				 => 'El nombre de usuario de la relaci&oacute;n introducido no existe',
	'WRONG_DATA_ANNIVERSARY'				 => 'El aniversario debe ser una fecha v&aacute;lida en el formato dd-mm-aaaa. Por ejemplo 01-12-2011',
	'TOO_SHORT_FACEBOOK'					 => 'La direcci&oacute;n de Facebook introducida es demasiado corta, se requiere un m&iacute;nimo de 12 caracteres.',
	'TOO_SHORT_TWITTER'						 => 'La direcci&oacute;n de Twitter introducida es demasiado corta, se requiere un m&iacute;nimo de 12 caracteres.',
	'TOO_SHORT_YOUTUBE'						 => 'La direcci&oacute;n de Youtube introducida es demasiado corta, se requiere un m&iacute;nimo de 12 caracteres.',
	'TOO_SHORT_ANNIVERSARY'					 => 'El aniversario introducido es demasiado corto, se requiere un m&iacute;nimo de 8 caracteres.',
	'TOO_SHORT_SKYPE'						 => 'El nombre de Skype introducido es demasiado corto, se requiere un m&iacute;nimo de 6 caracteres.',
	'SN_UP_WALL'							 => 'Actividad',
	'SN_UP_INFO'							 => 'Informaci&oacute;n',
	'SN_UP_FRIENDS'							 => 'Amigos',
	'SN_UP_STATS'							 => 'Estad&iacute;sticas',
	'SN_UP_BASIC_INFO'						 => 'Informaci&oacute;n b&aacute;sica',
	'SN_UP_EDU_WORK'						 => 'Educaci&oacute;n y Trabajo',
	'SN_UP_PHILOSOPHY'						 => 'Filosof&iacute;a',
	'SN_UP_ENT_ACT'							 => 'Entretenimiento y Actividades',
	'SN_UP_CONTACT_INFO'					 => 'Informaci&oacute;n de contacto',
	'SN_UP_OTHER_INFO'						 => 'Otra informaci&oacute;n',
	'SN_UP_LAST_VISITORS'					 => '&Uacute;ltimos visitantes del perfil',
	'SN_UP_PROFILE_VIEWED'					 => 'Perfil visto',
	'SN_UP_ADD_FRIEND'						 => 'A&ntilde;adir amigo',
	'SN_UP_ADD_FRIEND_TO_GROUP'				 => 'A&ntilde;adir al grupo',
	'SN_UP_EDIT_PROFILE'					 => 'Editar perfil',
	'SN_UP_EDIT_FRIENDS'					 => 'Gestionar amigos',
	'SN_UP_EDIT_RELATIONS'					 => 'Gestionar relaciones',
	'SN_UP_REPORT_PROFILE'					 => 'Reportar usuario',
	'SN_UP_EMPTY_REPORT'					 => 'Debes elegir el motivo de la denuncia',
	'SN_UP_REPORT_SUCCESS'					 => 'El usuario ha sido reportado con &eacute;xito',
	'SN_UP_CAN_LEAVE_BLANK'					 => 'Esto puede dejarse en blanco.',
	'SN_UP_MORE_INFO'						 => 'M&aacute;s informaci&oacute;n',
	'SN_UP_RETURN_TO_PROFILE'				 => '%1$sVolver al perfil%2$s',
	'SN_UP_TABS_SPINNER'					 => '<em>Cargando&#8230;<\/em>',
	'SN_UP_EMOTES'							 => 'Enviar Emote',

	'SN_LIKED_POSTS'						 => 'Me gusta recibidos',
	'SN_SEARCH_LIKED_POSTS'					 => 'Buscar publicaciones que le gustan al usuario',
	'SN_LIKES_SENT'         				 => 'Me gusta enviados',
	'SN_SEARCH_LIKES_SENT'  				 => 'Buscar publicaciones que te han gustado',

	'SN_UP_PROFILE_VALUE_DELETED'			 => '<em>Eliminado</em>',

	'SN_NTF_EMOTE_CB_TITLE'					 => 'Emote enviado',
	'SN_NTF_EMOTE_CB_TEXT'					 => 'El emote %2$s %3$s se ha enviado con &eacute;xito a %1$s',

	'SN_IN'									 => 'en',

	'AVATAR'								 => 'Avatar',

	'FOES'									 => 'Ignorados',
	'MUTUAL'								 => 'Amigos en com&uacute;n',
	'SUGGESTIONS'							 => 'Sugerencias',

	// This patterns are used for various date labels.
	// Each language should have convention how to display dates,
	// this is where you specify it for each user browsing the labels in
	// this language.
	'SN_DAY_MONTH_YEAR_PATTERN'				 => 'j F Y',
	'SN_DAY_MONTH_PATTERN'						 => 'j F',
	'SN_MONTH_YEAR_PATTERN'					 => 'F Y',
	'SN_YEAR_PATTERN'							 => 'Y',

	/**
	 * CONFIRM BOXES
	 */
	'SN_CB_DELETE_STATUS_TITLE'				 => 'Eliminar estado',
	'SN_CB_DELETE_STATUS_TEXT'				 => '&iquest;Est&aacute;s seguro de que deseas eliminar este estado?',
	'SN_CB_DELETE_COMMENT_TITLE'			 => 'Eliminar comentario',
	'SN_CB_DELETE_COMMENT_TEXT'				 => '&iquest;Est&aacute;s seguro de que deseas eliminar este comentario?',
	'SN_CB_DELETE_ACTIVITY_TITLE'			 => 'Eliminar actividad',
	'SN_CB_DELETE_ACTIVITY_TEXT'			 => '&iquest;Est&aacute;s seguro de que deseas eliminar esta actividad?',

	/**
	 * SOCIALNET TIME AGO
	 */
	'SN_TIME_AGO'							 => 'hace %1$u %2$s',
	'SN_TIME_FROM_NOW'						 => 'dentro de %1$u %2$s',
	'SN_TIME_PERIODS'						 => array(
		'SECOND'	 => 'segundo',
		'SECONDS'	 => 'segundos',
		'MINUTE'	 => 'minuto',
		'MINUTES'	 => 'minutos',
		'HOUR'		 => 'hora',
		'HOURS'		 => 'horas',
		'DAY'		 => 'd&iacute;a',
		'DAYS'		 => 'd&iacute;as',
		'WEEK'		 => 'semana',
		'WEEKS'		 => 'semanas',
		'MONTH'		 => 'mes',
		'MONTHS'	 => 'meses',
		'YEAR'		 => 'a&ntilde;o',
		'YEARS'		 => 'a&ntilde;os',
		'DECADE'	 => 'd&eacute;cada',
		'DECADES'	 => 'd&eacute;cadas',
	)
));

// UCP
$lang = array_merge($lang, array(
	// UCP
	'UCP_SOCIALNET'							 => 'Red Social',
	'UCP_SOCIALNET_SETTINGS'				 => 'Configuraci&oacute;n de Red Social',
	'UCP_SN_IM'								 => 'Ajustes de mensajer&iacute;a instant&aacute;nea',
	'UCP_SN_IM_SETTINGS'					 => 'Ajustes de mensajer&iacute;a instant&aacute;nea',
	'UCP_SN_IM_HISTORY'						 => 'Historial de mensajer&iacute;a instant&aacute;nea',
	'UCP_SN_APPROVAL_UFG'					 => 'Grupos de amigos',
	'UCP_SOCIALNET_IM_PURGE_MESSAGES'		 => 'Purgar mensajes de mensajer&iacute;a instant&aacute;nea',
	'UCP_SOCIALNET_USERSTATUS'				 => 'Ajustes de estado del usuario',
	'UCP_SN_PROFILE'						 => 'Editar informaci&oacute;n personal',
	'UCP_SN_PROFILE_RELATIONS'				 => 'Relaciones y Familia',

	// Instant Messenger
	'IM_ONLINE'								 => 'Estoy conectado',
	'IM_ONLINE_EXPLAIN'						 => 'Si est&aacute; activado, los amigos te ver&aacute;n en la lista de conectados y podr&aacute;n chatear contigo.',
	'IM_ALLOW_SOUND'						 => 'Reproducir un sonido cuando se recibe un mensaje',
	'IM_ALLOW_SOUND_EXPLAIN'				 => 'Esta opci&oacute;n activa/desactiva el sonido al recibir un nuevo mensaje',

	'IM_HISTORY_PURGED_AT'					 => 'El historial de mensajer&iacute;a instant&aacute;nea ha sido eliminado por el administrador el %1$s',
	'IM_NO_HISTORY'							 => 'No tienes mensajes instant&aacute;neos',
	//'IM_HISTORY_WITH'						 => 'Historial con',
	'IM_MSG_TOTAL'							 => '1 mensaje',
	'IM_MSGS_TOTAL'							 => '%1$s mensajes',
	'IM_CONVERSATION_TOTAL'					 => '1 conversaci&oacute;n',
	'IM_CONVERSATIONS_TOTAL'				 => '%1$s conversaciones',
	'IM_SOUND_SELECT_NAME'					 => 'Seleccionar sonido',
	'EXPORT_IM_HISTORY'						 => 'Exportar conversaci&oacute;n con %s',
	//'IM_HISTORY_SELECT_USER'				 => 'Seleccionar usuario',
	'IM_GROUP_UNDECIDED'					 => 'Sin categor&iacute;a',

	// Friends approval
	'ADD_FRIEND'							 => 'A&ntilde;adir nuevo amigo',
	'ACCEPT_FRIEND'							 => 'Aceptar solicitud de amistad',

	'SN_APPROVAL_FRIENDS'					 => 'Aprobar amistad',
	'SN_APPROVALS_FRIENDS_EXPLAIN'			 => 'Aqu&iacute; puedes aprobar a los usuarios que han solicitado ser tus amigos.',

	'SN_APPROVE'							 => 'Aceptar',
	'SN_NO_APPROVE'							 => 'Denegar',
	'SN_REFUSE'								 => 'Rechazar',

	'SN_APPROVAL_REQUESTS'					 => 'Tus solicitudes',
	'SN_APPROVALS_REQUESTS_EXPLAIN'			 => 'Aqu&iacute; puedes cancelar las solicitudes que has enviado.',

	'SN_VIEW_PROFILE'						 => 'Ver perfil',

	'SN_CANCEL_REQUEST'						 => 'Cancelar solicitud',

	'SN_REMOVE_FRIEND'						 => 'Eliminar amigo',
	'SN_REMOVE_FRIENDS'						 => 'Tus amigos',
	'SN_REMOVE_FRIENDS_EXPLAIN'				 => 'Aqu&iacute; puedes ver a todos tus amigos y eliminarlos de tu lista de amigos',

	'SN_USING_AVATARS_1_EXPLAIN'			 => 'Haz clic en los usuarios para seleccionarlos, luego confirma la operaci&oacute;n',

	'FRIENDS_APPROVALS_SUCCESS'				 => ' ha sido a&ntilde;adido a tu lista de amigos',
	'FRIENDS_APPROVALS_REQUEST_EXIST'		 => 'Ya has enviado la solicitud a',
	'FRIENDS_APPROVALS_DENY'				 => 'La solicitud de amistad ha sido cancelada',
	'FRIENDS_APPROVALS_REMOVE'				 => 'El amigo ha sido eliminado con &eacute;xito',
	'FRIENDS_APPROVALS_ADDED'				 => 'La solicitud de amistad se ha enviado con &eacute;xito',

	'SN_FAS_FRIEND_LIST'					 => 'Lista de amigos',
	'SN_FAS_COMMON_FRIEND_LIST'				 => 'Amigos en com&uacute;n',
	'SN_FAS_REMOVE'							 => 'Amigo eliminado',

	'FAS_FRIEND_TOTAL'						 => 'Un amigo',
	'FAS_FRIENDS_TOTAL'						 => '%1$s amigos',
	'FAS_FRIEND_NO_TOTAL'					 => 'Ning&uacute;n amigo',
	'FAS_FRIENDGROUP_TOTAL'					 => 'Un amigo',
	'FAS_FRIENDGROUPS_TOTAL'				 => '%1$s amigos',
	'FAS_FRIENDGROUP_NO_TOTAL'				 => 'Ning&uacute;n amigo',
	'FAS_APPROVE_TOTAL'						 => 'Una aprobaci&oacute;n',
	'FAS_APPROVES_TOTAL'					 => '%1$s aprobaciones',
	'FAS_APPROVE_NO_TOTAL'					 => 'Ninguna aprobaci&oacute;n',
	'FAS_CANCEL_TOTAL'						 => 'Una solicitud',
	'FAS_CANCELS_TOTAL'						 => '%1$s solicitudes',
	'FAS_CANCEL_NO_TOTAL'					 => 'Ninguna solicitud',
	'FAS_COMMON_TOTAL'						 => 'Un amigo en com&uacute;n',
	'FAS_COMMONS_TOTAL'						 => '%1$s amigos en com&uacute;n',
	'FAS_COMMON_NO_TOTAL'					 => 'Ning&uacute;n amigo en com&uacute;n',
	'FAS_MUTUAL_NO_TOTAL'					 => 'Ning&uacute;n amigo en com&uacute;n',
	'FAS_MUTUAL_TOTAL'						 => 'Un amigo en com&uacute;n',
	'FAS_MUTUALS_TOTAL'						 => '%1$s amigos en com&uacute;n',
	'FAS_SUGGESTION_NO_TOTAL'				 => 'Ninguna sugerencia',
	'FAS_SUGGESTION_TOTAL'					 => 'Una sugerencia',
	'FAS_SUGGESTIONS_TOTAL'					 => '%1$s sugerencias',

	'SN_FAS_NOT_ADDED_FRIENDS_IN_APPROVAL'	 => 'El usuario ya ha sido a&ntilde;adido',
	'SN_FAS_NOT_ADDED_FRIENDS_IN_FOES'		 => 'El usuario ya est&aacute; en la lista de ignorados',
	'SN_FAS_NOT_ADDED_FRIENDS_IN_FRIENDS'	 => 'El usuario ya es tu amigo',

	// Friends groups
	'UFG_CREATE'							 => 'Crear un nuevo grupo de amigos',
	'UFG_NAME'								 => 'Nombre del grupo de amigos',
	'UFG_CREATE_EXPLAIN'					 => 'Aqu&iacute; puedes crear un grupo de amigos para dividirlos en categor&iacute;as.',
	'UFG_MANAGE'							 => 'Grupos de amigos',
	'UFG_DRAG_FRIENDS_INTO_UFG'				 => 'Arrastra y suelta usuarios en el grupo de amigos',
	'SN_CREATE_NEW_GROUP'					 => 'Crear nuevo grupo',
	//'CONFIRM_CREATE_UFG'					 => '&iquest;Est&aacute;s seguro de que deseas crear el grupo de amigos <strong>%1$s</strong>?',
	'CONFIRM_DELETE_UFG'					 => '&iquest;Est&aacute;s seguro de que deseas eliminar el grupo de amigos <strong>%1$s</strong>?',
	'FMS_DELETE_UFG'						 => 'Eliminar grupo de amigos',
	'FMS_DELETE_UFG_TEXT'					 => '&iquest;Est&aacute;s seguro de que deseas eliminar este grupo de amigos?',

	'ADD_FRIEND_TO_GROUP'					 => 'A&ntilde;adir amigo al grupo de amigos',
	'ERROR_GROUP_EMPTY_NAME'				 => 'Nombre de grupo vac&iacute;o',
	'ERROR_GROUP_ALREADY_EXISTS'			 => 'Ya has creado este grupo',
));

// NTF MESSAGE TITLES FOR PMs
$lang = array_merge($lang, array(
	'SN_NTF_FRIENDSHIP_REQUEST_PM_TITLE'		=> '%1$s te ha enviado una solicitud de amistad',
	'SN_NTF_FRIENDSHIP_CANCEL_PM_TITLE'			=> '%1$s cancel&oacute; tu solicitud de amistad',
	'SN_NTF_FRIENDSHIP_DENY_PM_TITLE'				=> '%1$s deneg&oacute; tu solicitud de amistad',
	'SN_NTF_FRIENDSHIP_ACCEPT_PM_TITLE'			=> '%1$s acept&oacute; tu solicitud de amistad',

	'SN_NTF_STATUS_FRIEND_WALL_PM_TITLE'	 	=> '%1$s ha dejado un mensaje en tu perfil',
	'SN_NTF_STATUS_USER_COMMENT_PM_TITLE'	 	=> '%1$s ha comentado el estado de %2$s',
	'SN_NTF_STATUS_AUTHOR_COMMENT_PM_TITLE'	=> '%1$s ha comentado tu estado',

	'SN_NTF_APPROVE_FAMILY_PM_TITLE'				=> '%1$s te ha a&ntilde;adido como %2$s',
	'SN_NTF_APPROVE_RELATIONSHIP_PM_TITLE'	=> '%1$s ha indicado una relaci&oacute;n contigo',

	'SN_NTF_EMOTE_PM_TITLE'					 				=> '%1$s te ha enviado un emote',

	'SN_NTF_RELATIONSHIP_APPROVED_PM_TITLE'	=> '%1$s ha confirmado una relaci&oacute;n contigo',
	'SN_NTF_FAMILY_APPROVED_PM_TITLE'		 		=> '%1$s ha confirmado una relaci&oacute;n familiar contigo',

	'SN_NTF_RELATIONSHIP_REFUSED_PM_TITLE'	=> '%1$s ha rechazado una relaci&oacute;n contigo',
	'SN_NTF_FAMILY_REFUSED_PM_TITLE'				=> '%1$s ha rechazado una relaci&oacute;n familiar contigo',

	'SN_NTF_STATUS_FRIEND_MENTION_PM_TITLE' => '%1$s te ha mencionado en su estado',
));

// MCP
$lang = array_merge($lang, array(
	'MCP_SOCIALNET'					 => 'Red Social',
	'MCP_SN_REPORTUSER'				 => 'Usuarios reportados',

	'POSTS_IN_QUEUE'				 => 'Mensajes en cola de moderaci&oacute;n',

	'SN_UP_REPORTED_USER'			 => 'Usuario reportado',
	'SN_UP_REPORT_TEXT'				 => 'Detalles',
	'SN_UP_REASON'					 => 'Motivo',
	'SN_UP_VIEW_REPORTS'			 => 'Ver reportes',
	'SN_UP_CLOSE_REPORT_CONFIRM'	 => '&iquest;Est&aacute;s seguro de que deseas cerrar este reporte?',
	'SN_UP_CLOSE_REPORTS_CONFIRM'	 => '&iquest;Est&aacute;s seguro de que deseas cerrar estos reportes?',
	'SN_UP_CLOSE_REPORT_SUCCESS'	 => 'El reporte se ha cerrado con &eacute;xito.',
	'SN_UP_CLOSE_REPORTS_SUCCESS'	 => 'Los reportes se han cerrado con &eacute;xito.',
	'SN_UP_DELETE_REPORT_CONFIRM'	 => '&iquest;Est&aacute;s seguro de que deseas eliminar este reporte?',
	'SN_UP_DELETE_REPORTS_CONFIRM'	 => '&iquest;Est&aacute;s seguro de que deseas eliminar estos reportes?',
	'SN_UP_DELETE_REPORT_SUCCESS'	 => 'El reporte se ha eliminado con &eacute;xito.',
	'SN_UP_DELETE_REPORTS_SUCCESS'	 => 'Los reportes se han eliminado con &eacute;xito.',
));

// NOTIFY
$lang = array_merge($lang, array(
	'SN_AP_NOTIFY'					 => 'Notificaciones',
	'SN_NO_NOTIFY'					 => 'No tienes notificaciones',
	'SN_NTF_FRIENDSHIP_ACCEPT'		 => '%1$s acept&oacute; tu <a href="%2$s">solicitud de amistad</a>',
	'SN_NTF_FRIENDSHIP_DENY'		 => '%1$s deneg&oacute; tu <a href="%2$s">solicitud de amistad</a>',
	'SN_NTF_FRIENDSHIP_REQUEST'		 => '%1$s te envi&oacute; una <a href="%2$s">solicitud de amistad</a>',
	'SN_NTF_FRIENDSHIP_CANCEL'		 => '%1$s cancel&oacute; su <a href="%2$s">solicitud de amistad</a>',

	'SN_NTF_STATUS_AUTHOR_COMMENT'	 => '%1$s ha comentado <a href="%2$s">tu estado</a>',
	'SN_NTF_STATUS_USER_COMMENT'		 => '%1$s ha comentado el estado de <a href="%3$s">%2$s</a>',
	'SN_NTF_STATUS_FRIEND_WALL'		 	=> '%1$s ha dejado un mensaje en <a href="%2$s">tu perfil</a>',

	'SN_NTF_APPROVE_FAMILY'			 => '%1$s te ha a&ntilde;adido como %2$s. Puedes <a href="%3$s">aprobar esta relaci&oacute;n aqu&iacute;</a>',
	'SN_NTF_APPROVE_RELATIONSHIP'	 => '%1$s ha indicado una relaci&oacute;n contigo. Puedes <a href="%2$s">aprobar esta relaci&oacute;n aqu&iacute;</a>',

	'SN_NTF_EMOTE'					 => '%1$s te ha enviado un emote: %2$s %3$s',

	'SN_NTF_RELATIONSHIP_APPROVED'	 => '%1$s ha confirmado la <a href="%2$s">relaci&oacute;n</a> contigo',
	'SN_NTF_FAMILY_APPROVED'		 => '%1$s ha confirmado la <a href="%2$s">relaci&oacute;n familiar</a> contigo',

	'SN_NTF_RELATIONSHIP_VICEVERSA'	 => '%1$s ha confirmado la <a href="%2$s">relaci&oacute;n</a> contigo y tambi&eacute;n la ha a&ntilde;adido a su perfil',
	'SN_NTF_FAMILY_VICEVERSA'		 => '%1$s ha confirmado la <a href="%2$s">relaci&oacute;n familiar</a> contigo y tambi&eacute;n la ha a&ntilde;adido a su perfil',

	'SN_NTF_RELATIONSHIP_REFUSED'	 => '%1$s ha rechazado la <a href="%2$s">relaci&oacute;n</a> contigo',
	'SN_NTF_FAMILY_REFUSED'			 => '%1$s ha rechazado la <a href="%2$s">relaci&oacute;n familiar</a> contigo',

	'SN_NTF_STATUS_FRIEND_MENTION' => '%1$s te ha mencionado en <a href="%2$s">su estado</a>',
));

// EMOTES
$lang = array_merge($lang, array(
	'SN_UP_EMOTES_USER'	 => 'Emotes',
));

// EXPANDER
$lang = array_merge($lang, array(
	'SN_EXPANDER_READ_MORE'	 => 'Ver m&aacute;s',
	'SN_EXPANDER_READ_LESS'	 => 'Cerrar',
));

// OUTDATED BROWSER
$lang = array_merge($lang, array(
	'BROWSER_OUTDATED_TITLE'	 => 'Tu navegador est&aacute; desactualizado',
	'BROWSER_OUTDATED'	 => 'Algunas funciones no funcionar&aacute;n en tu navegador. Te recomendamos encarecidamente actualizarlo.',

	// Missing variables
	'SN_UP_USER_FB'		=> 'Facebook',
	'SN_UP_USER_IG'		=> 'Instagram',
	'SN_UP_USER_PT'		=> 'Pinterest',
	'SN_UP_USER_TWR'	=> 'Twitter',
	'SN_UP_USER_SKP'	=> 'Skype',
	'SN_UP_USER_TG'		=> 'Telegram',
	'SN_UP_USER_LI'		=> 'LinkedIn',
	'SN_UP_USER_TT'		=> 'TikTok',
	'SN_UP_USER_DC'		=> 'Discord',
));
 
