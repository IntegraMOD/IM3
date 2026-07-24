<?php
/** 
*
* ucp_digests.php [Spanish]
*
* @package language
* @version $Id: v3_modules.xml 52 2007-12-09 19:45:45Z jelly_doughnut $
* @copyright (c) 2005 phpBB Group 
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
		
global $config;
				
$lang = array_merge($lang, array(
	'DIGEST_ALL_FORUMS'					=> 'Todos',
	'DIGEST_AUTHOR'						=> 'Autor',
	'DIGEST_BAD_EOL'					=> 'El extremo de la l�nea valor de %s es inv�lido.', 
	'DIGEST_BOARD_LIMIT'				=> '%s (L�mite del tablero)',
	'DIGEST_BY'							=> 'Por',
	'DIGEST_CONNECT_SOCKET_ERROR'		=> 'Incapaz abrir la conexi�n al sitio de Smartfeed del phpBB, divulgado error es:<br />%s',
	'DIGEST_COUNT_LIMIT'				=> 'N�mero m�ximo de postes en el resumen',
	'DIGEST_COUNT_LIMIT_EXPLAIN'		=> 'Incorpore un n�mero cero mayor que si usted desea limitar el n�mero de postes en el resumen.',
	'DIGEST_CURRENT_VERSION_INFO'		=> 'Usted est� funcionando la versi�n <strong>%s</strong>.',
	'DIGEST_DAILY'						=> 'Diario',
	'DIGEST_DATE'						=> 'Fecha',
	'DIGEST_DISABLED_MESSAGE'			=> 'Para permitir campos, fundamentos selectos y seleccionar un tipo del resumen',
	'DIGEST_DISCLAIMER'					=> 'Este resumen se est� enviando a los miembros registrados de <a href="%s">%s</a> foros. Usted puede cambiar o suprimir su suscripci�n de <a href="%sucp.%s">User Control Panel</a>. Si usted hace que las preguntas o la regeneraci�n en el formato de este resumen por favor lo env�en a <a href="mailto:%s">%s Webmaster</a>.',
	'DIGEST_EXPLANATION'				=> 'Los res�menes son res�menes del email de los mensajes fijados aqu� que se env�an usted peri�dicamente. Los res�menes se pueden enviar diario, semanalmente o mensualmente en una hora del d�a usted selecto. Usted puede especificar esos foros particulares para los cuales usted desee los res�menes del mensaje (selecci�n selecta de los postes), o por defecto usted puede elegir para recibir todos los mensajes para todos los foros para los cuales le no prohiban el acceso. Usted puede, por supuesto, cancelar su suscripci�n del resumen en cualquier momento simplemente volvi�ndose a esta p�gina. La mayor�a de los usuarios encuentran los res�menes para ser muy �tiles. �Le animamos a que le d� un intento!',
	'DIGEST_FILTER_ERROR'				=> "mail_digests.$phpEx fue llamado con un invalid user_digest_filter_type = %s",
	'DIGEST_FILTER_FOES'				=> 'Quite los postes de mis enemigos',
	'DIGEST_FILTER_TYPE'				=> 'Tipos de postes en resumen',
	'DIGEST_FORMAT_ERROR'				=> "mail_digests.$phpEx fue llamado con un invalid user_digest_format of %s",
	'DIGEST_FORMAT_FOOTER' 				=> 'Formato del resumen:',
	'DIGEST_FORMAT_HTML'				=> 'HTML',
	'DIGEST_FORMAT_HTML_EXPLAIN'		=> 'HTML proporcionar� el formato, BBCode y firmas (si est� permitido). Se aplica Stylesheets si su programa del email permite.',
	'DIGEST_FORMAT_HTML_CLASSIC'		=> 'HTML Cl�sico',
	'DIGEST_FORMAT_HTML_CLASSIC_EXPLAIN'	=> 'Similar al HTML excepto los postes del asunto se enumeran dentro de las tablas',
	'DIGEST_FORMAT_PLAIN'				=> 'Llano HTML',
	'DIGEST_FORMAT_PLAIN_EXPLAIN'		=> 'Llano HTML no aplica estilos o colores',
	'DIGEST_FORMAT_PLAIN_CLASSIC'		=> 'Llano HTML Cl�sico',
	'DIGEST_FORMAT_PLAIN_CLASSIC_EXPLAIN'	=> 'Similar a Llano HTML excepto asunto los postes se enumeran dentro de las tablas',
	'DIGEST_FORMAT_STYLING'				=> 'El labrar del resumen',
	'DIGEST_FORMAT_STYLING_EXPLAIN'		=> 'Observe por favor que el labrar rendido realmente depende de las capacidades de su programa del email. Mueva su excedente del cursor el tipo labrador para aprender m�s sobre cada estilo.',
	'DIGEST_FORMAT_TEXT'				=> 'Texto',
	'DIGEST_FORMAT_TEXT_EXPLAIN'		=> 'Ning�n HTML aparecer� en el resumen. Solamente el texto ser� demostrado.',
	'DIGEST_FREQUENCY'					=> 'El tipo de resumen dese�',
	'DIGEST_FREQUENCY_EXPLAIN'			=> "Los res�menes semanales se env�an encendido %s. Los res�menes mensuales se env�an en los primeros del mes. Tiempo universal se utiliza para determinar el d�a de la semana.",
	'DIGEST_INTRODUCTION' 				=> 'Aqu� est� el resumen m�s �ltimo de los mensajes fijados encendido %s foros. Venga por favor ensamblar la discusi�n!',
	'DIGEST_LASTVISIT_RESET'			=> 'Reajuste la mi fecha pasada de la visita en que me env�an un resumen',
	'DIGEST_LATEST_VERSION_INFO'		=> 'T�l versi�n disponible est� lo m�s tarde posible <strong>%s</strong>.',
	'DIGEST_LINK'						=> 'Acoplamiento',
	'DIGEST_LOG_WRITE_ERROR'			=> 'Incapaz escribir al registro con la trayectoria, trayectoria = %s. Esto es causada con frecuencia por la carencia del p�blico permisos de escritura en este archivo.',
	'DIGEST_MAIL_FREQUENCY' 			=> 'Frecuencia del resumen',
	'DIGEST_MARK_READ'					=> 'Marca seg�n lo le�do cuando aparecen en el resumen',
	'DIGEST_MAX_SIZE'					=> 'Palabras m�ximas a exhibir en un poste',
	'DIGEST_MAX_SIZE_EXPLAIN'			=> 'Aviso: Para asegurar la representaci�n constante, si un poste debe ser truncado, el HTML ser� quitado del poste.',
	'DIGEST_MAX_WORDS_NOTIFIER'			=> '... ',
	'DIGEST_MIN_SIZE'					=> 'Palabras m�nimas requeridas en el poste para el poste para aparecer en un resumen',
	'DIGEST_MIN_SIZE_EXPLAIN'			=> 'Si usted deja esto en blanco, los postes con el texto de cualquier n�mero de palabras son incluidos',
	'DIGEST_MONTHLY'					=> 'Mensual',
	'DIGEST_NEW'						=> 'Nuevo',
	'DIGEST_NEW_POSTS_ONLY'				=> 'Demuestre los nuevos postes solamente',
	'DIGEST_NEW_POSTS_ONLY_EXPLAIN'		=> 'Esto filtrar� hacia fuera cualesquiera postes fijados antes de la fecha y de la hora que usted visit� por �ltimo a este tablero. Si usted visita a tablero con frecuencia y lee la mayor parte de los postes, esto mantendr� los postes redundantes de aparecer su resumen. Puede tambi�n significar que usted faltar� algunos postes en los foros que usted no ley�.',
	'DIGEST_NO_CONSTRAINT'				=> 'Ning�n constre�imiento',
	'DIGEST_NO_FORUMS_CHECKED' 			=> 'Por lo menos un foro debe ser comprobado',
	'DIGEST_NO_LIMIT'					=> 'Ning�n l�mite',
	'DIGEST_NO_POSTS'					=> 'No hay nuevos postes.',
	'DIGEST_NO_PRIVATE_MESSAGES'		=> 'Usted no tiene ning�n mensaje privado nuevo o del unread.',
	'DIGEST_NONE'						=> 'Ninguno (unsubscribe)',
	'DIGEST_ON'							=> 'en',
	'DIGEST_POST_TEXT'					=> 'Poste Texto', 
	'DIGEST_POST_TIME'					=> 'Poste Tiempo', 
	'DIGEST_POST_SIGNATURE_DELIMITER'	=> '<br />____________________<br />', // Place here whatever code (make sure it is valid XHTML) you want to use to distinguish the end of a post from the beginning of the signature line
	'DIGEST_POSTS_TYPE_ANY'				=> 'Todos los postes',
	'DIGEST_POSTS_TYPE_FIRST'			=> 'Primeros postes de asuntos solamente',
	'DIGEST_POWERED_BY'					=> 'Accionado cerca',
	'DIGEST_PRIVATE_MESSAGES_IN_DIGEST'	=> 'Agregue mis mensajes privados del unread',
	'DIGEST_PUBLISH_DATE'				=> 'El resumen fue publicado espec�ficamente para usted encendido %s',
	'DIGEST_REMOVE_YOURS'				=> 'Quite mis postes',
	'DIGEST_ROBOT'						=> 'Robusteza',
	'DIGEST_SALUTATION' 				=> 'Estimado',
	'DIGEST_SELECT_FORUMS'				=> 'Incluya los postes para estos foros',
	'DIGEST_SELECT_FORUMS_EXPLAIN'		=> 'Observe por favor las categor�as y los foros demostrados est�n para �sos que a le se permite leer solamente. La selecci�n del foro es lisiada cuando usted selecciona asuntos bookmarked solamente.',
	'DIGEST_SEND_HOUR' 					=> 'Hora enviada',
	'DIGEST_SEND_HOUR_EXPLAIN'			=> 'El tiempo de llegada del resumen es el tiempo basado el los ahorros de la zona y de la luz del d�a de tiempo/el tiempo de verano que usted fija en sus preferencias del tablero.',
	'DIGEST_SEND_IF_NO_NEW_MESSAGES'	=> 'Env�e el resumen si ningunos nuevos mensajes:',
	'DIGEST_SEND_ON_NO_POSTS'	 		=> 'Env�e un resumen si no hay nuevos postes',
	'DIGEST_SHOW_MY_MESSAGES' 			=> 'Demuestre mis postes en el resumen:',
	'DIGEST_SHOW_NEW_POSTS_ONLY' 		=> 'Demuestre los nuevos postes solamente',
	'DIGEST_SHOW_PMS' 					=> 'Demuestre mis mensajes privados',
	'DIGEST_SIZE_ERROR'					=> "Este campo es un campo requerido. Usted debe incorporar un n�mero entero positivo, inferior o igual el m�ximo permitido por el administrador del foro. El m�ximo permitido es %s. Si este valor es cero, no hay l�mite.",
	'DIGEST_SIZE_ERROR_MIN'				=> 'Usted debe incorporar un valor positivo o dejar el espacio en blanco del campo',
	'DIGEST_SOCKET_FUNCTIONS_DISABLED'	=> 'Las funciones del z�calo se inhabilitan actualmente.',
	'DIGEST_SORT_BY'					=> 'Orden de la clase del poste',
	'DIGEST_SORT_BY_ERROR'				=> "mail_digests.$phpEx fue llamado con un invalid user_digest_sortby = %s",
	'DIGEST_SORT_BY_EXPLAIN'			=> 'Todos los res�menes son clasificados por categor�a y entonces por el foro, como se demuestran en el �ndice principal. Las opciones de la clase se aplican a c�mo los postes se arreglan dentro de asuntos. La orden tradicional es la orden del defecto usada por el phpBB 2, que es la vez pasada del poste del asunto (el descender) entonces por correo mide el tiempo dentro del asunto.',
	'DIGEST_SORT_FORUM_TOPIC'			=> 'Orden tradicional',
	'DIGEST_SORT_FORUM_TOPIC_DESC'		=> 'Orden tradicional, los postes m�s �ltimos primero',
	'DIGEST_SORT_POST_DATE'				=> 'De la m�s viejo a la m�s nuevo',
	'DIGEST_SORT_POST_DATE_DESC'		=> 'De la m�s nuevo a la m�s viejo',
	'DIGEST_SORT_USER_ORDER'			=> 'Utilice mis preferencias de la exhibici�n del tablero',
	'DIGEST_SQL_PMS'					=> 'SQL usado para los mensajes privados para %s: %s',
	'DIGEST_SQL_PMS_NONE'				=> 'Ning�n SQL public� para private_messages para %s porque el usuario opt� no demostrar mensajes privados en el resumen.',
	'DIGEST_SQL_POSTS_USERS'			=> 'SQL usado para los postes para %s: %s',
	'DIGEST_SQL_USERS'					=> 'El SQL recuperaba a usuarios que consegu�an los res�menes: %s',
	'DIGEST_SUBJECT_LABEL'				=> 'Tema',
	'DIGEST_SUBJECT_TITLE'				=> '%s %s Resumen',
	'DIGEST_TIME_ERROR'					=> "mail_digests.$phpEx calculaba un mal resumen env�an hora de %s",
	'DIGEST_TOTAL_POSTS'				=> 'Postes totales en esto resumen:',
	'DIGEST_TOTAL_UNREAD_PRIVATE_MESSAGES'	=> 'Mensajes privados del unread total:',
	'DIGEST_UNREAD'						=> 'Unread',
	'DIGEST_UPDATED'					=> 'Sus ajustes del resumen fueron ahorrados',
	'DIGEST_USE_BOOKMARKS'				=> 'Asuntos Bookmarked solamente',
	'DIGEST_VERSION_NOT_UP_TO_DATE'		=> 'Aviso del administrador: esta versi�n de los res�menes del phpBB no es actual. Las actualizaciones est�n disponibles en <a href="%s">Digiere Web site</a>.',
	'DIGEST_VERSION_UP_TO_DATE'			=> 'Esta versi�n de los res�menes del phpBB es actualizada, ninguna actualizaci�n disponible.',
	'DIGEST_WEEKDAY' => array(
		0	=> 'Domingo',
		1 	=> 'Lunes',
		2	=> 'Martes',
		3	=> 'Mi�rcoles',
		4	=> 'Jueves',
		5	=> 'Viernes',
		6	=> 'S�bado'),
	'DIGEST_WEEKLY'						=> 'Semanal',
	'DIGEST_YOU_HAVE_PRIVATE_MESSAGES' 	=>	'Usted tiene mensajes privados',
	'DIGEST_YOUR_DIGEST_OPTIONS' 		=> 'Sus opciones del resumen:',
	'S_DIGEST_TITLE'					=> (isset($config['digests_digests_title'])) ? $config['digests_digests_title'] : 'phpBB Digests',
	'UCP_DIGESTS_MODE_ERROR'			=> 'Los res�menes fueron llamados con un modo inv�lido de %s',
				

// Missing variables
'DIGEST_BAD_SEND_HOUR'=> 'La hora de enví­o del resumen del usuario %s no es válida. Es %s. El número debe ser >= 0 y < 24.',
'DIGEST_BLOCK_IMAGES'=> 'Bloquear imágenes',
'DIGEST_BLOCK_IMAGES_EXPLAIN'=> 'Prohí­be que aparezcan imágenes en sus resúmenes, incluidas las adjuntas a mensajes o mensajes privados. Esto puede ser útil para conexiones lentas o para foros activos con muchas imágenes. Los resúmenes de solo texto nunca muestran contenido no textual.',
'DIGEST_CLOSED_QUOTE'=> '"',
'DIGEST_CREATED_FOR'=> 'creado para',
'DIGEST_EXCEPTION'=> 'Excepción no detectada al ejecutar mail_digests.php:',
'DIGEST_FORUMS_WANTED'=> 'Foros deseados',
'DIGEST_FREQUENCY_SHORT'=> 'Tipo de resumen',
'DIGEST_INSTALL_MOD_CONFIRM'=> 'Deseo instalar phpBB Digests',
'DIGEST_JUMP_TO'=> 'Ir a',
'DIGEST_MAX_EXEC_TIME_EXCEEDED'=> 'Advertencia: algunos suscriptores no recibieron resúmenes porque se excedió el tiempo máximo de un proceso PHP. Este problema suele ocurrir debido a que PHP Safe Mode está habilitado. Si no puede deshabilitarlo o cambiar el límite en php.ini, el problema probablemente se repetirá. Ocurrió a las %s GMT.',
'DIGEST_NO_BOOKMARKED_POSTS'=> 'No hay mensajes marcados como favoritos nuevos.',
'DIGEST_NO_POST_TEXT'=> 'No mostrar texto de los mensajes en absoluto',
'DIGEST_OPEN_QUOTE'=> '"',
'DIGEST_PHPBB_DIGESTS'=> 'phpBB Digests',
'DIGEST_POST_IMAGE_TEXT'=> '<br />(Haga clic en la imagen para verla en tamaño completo.)',
'DIGEST_POSTED_TO_THE_TOPIC'=> 'ha publicado en el tema',
'DIGEST_REGISTER'=> 'Recibir resúmenes',
'DIGEST_REGISTER_EXPLAIN'=> 'Se utilizarán los valores predeterminados del sitio. Puede ajustar la configuración de su resumen o darse de baja tras finalizar el registro.',
'DIGEST_REPLY'=> 'Responder',
'DIGEST_SENDER'=> 'Remitente',
'DIGEST_SENT_TO'=> 'enviado a',
'DIGEST_SENT_YOU_A_MESSAGE'=> 'le ha enviado un mensaje privado con el asunto',
'DIGEST_SHOW_ATTACHMENTS'=> 'Mostrar adjuntos',
'DIGEST_SHOW_ATTACHMENTS_EXPLAIN'=> 'Si está habilitado, las imágenes adjuntas aparecerán en su resumen al final del mensaje. Los archivos no gráficos aparecerán como enlaces (solo resúmenes HTML).',
'DIGEST_SKIP'=> 'Ir al contenido',
'DIGEST_SUMMARY'=> 'Sumario del Resumen',
'DIGEST_TERMINATED_ABNORMALLY'=> 'mail_digests.php terminó de forma anormal',
'DIGEST_TOC'=> 'Tabla de contenidos',
'DIGEST_TOC_EXPLAIN'=> 'Si el sitio es activo, tal vez quiera incluir una tabla de contenidos. En resúmenes HTML contiene enlaces para saltar directamente a un mensaje especí­fico.',
'DIGEST_UNKNOWN'=> 'Desconocido',));

