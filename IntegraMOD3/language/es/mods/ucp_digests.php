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
	'DIGEST_BAD_EOL'					=> 'El extremo de la línea valor de %s es inválido.', 
	'DIGEST_BOARD_LIMIT'				=> '%s (Límite del tablero)',
	'DIGEST_BY'							=> 'Por',
	'DIGEST_CONNECT_SOCKET_ERROR'		=> 'Incapaz abrir la conexión al sitio de Smartfeed del phpBB, divulgado error es:<br />%s',
	'DIGEST_COUNT_LIMIT'				=> 'Número máximo de postes en el resumen',
	'DIGEST_COUNT_LIMIT_EXPLAIN'		=> 'Incorpore un número cero mayor que si usted desea limitar el número de postes en el resumen.',
	'DIGEST_CURRENT_VERSION_INFO'		=> 'Usted está funcionando la versión <strong>%s</strong>.',
	'DIGEST_DAILY'						=> 'Diario',
	'DIGEST_DATE'						=> 'Fecha',
	'DIGEST_DISABLED_MESSAGE'			=> 'Para permitir campos, fundamentos selectos y seleccionar un tipo del resumen',
	'DIGEST_DISCLAIMER'					=> 'Este resumen se está enviando a los miembros registrados de <a href="%s">%s</a> foros. Usted puede cambiar o suprimir su suscripción de <a href="%sucp.%s">User Control Panel</a>. Si usted hace que las preguntas o la regeneración en el formato de este resumen por favor lo envíen a <a href="mailto:%s">%s Webmaster</a>.',
	'DIGEST_EXPLANATION'				=> 'Los resúmenes son resúmenes del email de los mensajes fijados aquí que se envían usted periódicamente. Los resúmenes se pueden enviar diario, semanalmente o mensualmente en una hora del día usted selecto. Usted puede especificar esos foros particulares para los cuales usted desee los resúmenes del mensaje (selección selecta de los postes), o por defecto usted puede elegir para recibir todos los mensajes para todos los foros para los cuales le no prohiban el acceso. Usted puede, por supuesto, cancelar su suscripción del resumen en cualquier momento simplemente volviéndose a esta página. La mayoría de los usuarios encuentran los resúmenes para ser muy útiles. ¡Le animamos a que le dé un intento!',
	'DIGEST_FILTER_ERROR'				=> "mail_digests.$phpEx fue llamado con un invalid user_digest_filter_type = %s",
	'DIGEST_FILTER_FOES'				=> 'Quite los postes de mis enemigos',
	'DIGEST_FILTER_TYPE'				=> 'Tipos de postes en resumen',
	'DIGEST_FORMAT_ERROR'				=> "mail_digests.$phpEx fue llamado con un invalid user_digest_format of %s",
	'DIGEST_FORMAT_FOOTER' 				=> 'Formato del resumen:',
	'DIGEST_FORMAT_HTML'				=> 'HTML',
	'DIGEST_FORMAT_HTML_EXPLAIN'		=> 'HTML proporcionará el formato, BBCode y firmas (si está permitido). Se aplica Stylesheets si su programa del email permite.',
	'DIGEST_FORMAT_HTML_CLASSIC'		=> 'HTML Clásico',
	'DIGEST_FORMAT_HTML_CLASSIC_EXPLAIN'	=> 'Similar al HTML excepto los postes del asunto se enumeran dentro de las tablas',
	'DIGEST_FORMAT_PLAIN'				=> 'Llano HTML',
	'DIGEST_FORMAT_PLAIN_EXPLAIN'		=> 'Llano HTML no aplica estilos o colores',
	'DIGEST_FORMAT_PLAIN_CLASSIC'		=> 'Llano HTML Clásico',
	'DIGEST_FORMAT_PLAIN_CLASSIC_EXPLAIN'	=> 'Similar a Llano HTML excepto asunto los postes se enumeran dentro de las tablas',
	'DIGEST_FORMAT_STYLING'				=> 'El labrar del resumen',
	'DIGEST_FORMAT_STYLING_EXPLAIN'		=> 'Observe por favor que el labrar rendido realmente depende de las capacidades de su programa del email. Mueva su excedente del cursor el tipo labrador para aprender más sobre cada estilo.',
	'DIGEST_FORMAT_TEXT'				=> 'Texto',
	'DIGEST_FORMAT_TEXT_EXPLAIN'		=> 'Ningún HTML aparecerá en el resumen. Solamente el texto será demostrado.',
	'DIGEST_FREQUENCY'					=> 'El tipo de resumen deseó',
	'DIGEST_FREQUENCY_EXPLAIN'			=> "Los resúmenes semanales se envían encendido %s. Los resúmenes mensuales se envían en los primeros del mes. Tiempo universal se utiliza para determinar el día de la semana.",
	'DIGEST_INTRODUCTION' 				=> 'Aquí está el resumen más último de los mensajes fijados encendido %s foros. Venga por favor ensamblar la discusión!',
	'DIGEST_LASTVISIT_RESET'			=> 'Reajuste la mi fecha pasada de la visita en que me envían un resumen',
	'DIGEST_LATEST_VERSION_INFO'		=> 'Tél versión disponible está lo más tarde posible <strong>%s</strong>.',
	'DIGEST_LINK'						=> 'Acoplamiento',
	'DIGEST_LOG_WRITE_ERROR'			=> 'Incapaz escribir al registro con la trayectoria, trayectoria = %s. Esto es causada con frecuencia por la carencia del público permisos de escritura en este archivo.',
	'DIGEST_MAIL_FREQUENCY' 			=> 'Frecuencia del resumen',
	'DIGEST_MARK_READ'					=> 'Marca según lo leído cuando aparecen en el resumen',
	'DIGEST_MAX_SIZE'					=> 'Palabras máximas a exhibir en un poste',
	'DIGEST_MAX_SIZE_EXPLAIN'			=> 'Aviso: Para asegurar la representación constante, si un poste debe ser truncado, el HTML será quitado del poste.',
	'DIGEST_MAX_WORDS_NOTIFIER'			=> '... ',
	'DIGEST_MIN_SIZE'					=> 'Palabras mínimas requeridas en el poste para el poste para aparecer en un resumen',
	'DIGEST_MIN_SIZE_EXPLAIN'			=> 'Si usted deja esto en blanco, los postes con el texto de cualquier número de palabras son incluidos',
	'DIGEST_MONTHLY'					=> 'Mensual',
	'DIGEST_NEW'						=> 'Nuevo',
	'DIGEST_NEW_POSTS_ONLY'				=> 'Demuestre los nuevos postes solamente',
	'DIGEST_NEW_POSTS_ONLY_EXPLAIN'		=> 'Esto filtrará hacia fuera cualesquiera postes fijados antes de la fecha y de la hora que usted visitó por último a este tablero. Si usted visita a tablero con frecuencia y lee la mayor parte de los postes, esto mantendrá los postes redundantes de aparecer su resumen. Puede también significar que usted faltará algunos postes en los foros que usted no leyó.',
	'DIGEST_NO_CONSTRAINT'				=> 'Ningún constreñimiento',
	'DIGEST_NO_FORUMS_CHECKED' 			=> 'Por lo menos un foro debe ser comprobado',
	'DIGEST_NO_LIMIT'					=> 'Ningún límite',
	'DIGEST_NO_POSTS'					=> 'No hay nuevos postes.',
	'DIGEST_NO_PRIVATE_MESSAGES'		=> 'Usted no tiene ningún mensaje privado nuevo o del unread.',
	'DIGEST_NONE'						=> 'Ninguno (unsubscribe)',
	'DIGEST_ON'							=> 'en',
	'DIGEST_POST_TEXT'					=> 'Poste Texto', 
	'DIGEST_POST_TIME'					=> 'Poste Tiempo', 
	'DIGEST_POST_SIGNATURE_DELIMITER'	=> '<br />____________________<br />', // Place here whatever code (make sure it is valid XHTML) you want to use to distinguish the end of a post from the beginning of the signature line
	'DIGEST_POSTS_TYPE_ANY'				=> 'Todos los postes',
	'DIGEST_POSTS_TYPE_FIRST'			=> 'Primeros postes de asuntos solamente',
	'DIGEST_POWERED_BY'					=> 'Accionado cerca',
	'DIGEST_PRIVATE_MESSAGES_IN_DIGEST'	=> 'Agregue mis mensajes privados del unread',
	'DIGEST_PUBLISH_DATE'				=> 'El resumen fue publicado específicamente para usted encendido %s',
	'DIGEST_REMOVE_YOURS'				=> 'Quite mis postes',
	'DIGEST_ROBOT'						=> 'Robusteza',
	'DIGEST_SALUTATION' 				=> 'Estimado',
	'DIGEST_SELECT_FORUMS'				=> 'Incluya los postes para estos foros',
	'DIGEST_SELECT_FORUMS_EXPLAIN'		=> 'Observe por favor las categorías y los foros demostrados están para ésos que a le se permite leer solamente. La selección del foro es lisiada cuando usted selecciona asuntos bookmarked solamente.',
	'DIGEST_SEND_HOUR' 					=> 'Hora enviada',
	'DIGEST_SEND_HOUR_EXPLAIN'			=> 'El tiempo de llegada del resumen es el tiempo basado el los ahorros de la zona y de la luz del día de tiempo/el tiempo de verano que usted fija en sus preferencias del tablero.',
	'DIGEST_SEND_IF_NO_NEW_MESSAGES'	=> 'Envíe el resumen si ningunos nuevos mensajes:',
	'DIGEST_SEND_ON_NO_POSTS'	 		=> 'Envíe un resumen si no hay nuevos postes',
	'DIGEST_SHOW_MY_MESSAGES' 			=> 'Demuestre mis postes en el resumen:',
	'DIGEST_SHOW_NEW_POSTS_ONLY' 		=> 'Demuestre los nuevos postes solamente',
	'DIGEST_SHOW_PMS' 					=> 'Demuestre mis mensajes privados',
	'DIGEST_SIZE_ERROR'					=> "Este campo es un campo requerido. Usted debe incorporar un número entero positivo, inferior o igual el máximo permitido por el administrador del foro. El máximo permitido es %s. Si este valor es cero, no hay límite.",
	'DIGEST_SIZE_ERROR_MIN'				=> 'Usted debe incorporar un valor positivo o dejar el espacio en blanco del campo',
	'DIGEST_SOCKET_FUNCTIONS_DISABLED'	=> 'Las funciones del zócalo se inhabilitan actualmente.',
	'DIGEST_SORT_BY'					=> 'Orden de la clase del poste',
	'DIGEST_SORT_BY_ERROR'				=> "mail_digests.$phpEx fue llamado con un invalid user_digest_sortby = %s",
	'DIGEST_SORT_BY_EXPLAIN'			=> 'Todos los resúmenes son clasificados por categoría y entonces por el foro, como se demuestran en el índice principal. Las opciones de la clase se aplican a cómo los postes se arreglan dentro de asuntos. La orden tradicional es la orden del defecto usada por el phpBB 2, que es la vez pasada del poste del asunto (el descender) entonces por correo mide el tiempo dentro del asunto.',
	'DIGEST_SORT_FORUM_TOPIC'			=> 'Orden tradicional',
	'DIGEST_SORT_FORUM_TOPIC_DESC'		=> 'Orden tradicional, los postes más últimos primero',
	'DIGEST_SORT_POST_DATE'				=> 'De la más viejo a la más nuevo',
	'DIGEST_SORT_POST_DATE_DESC'		=> 'De la más nuevo a la más viejo',
	'DIGEST_SORT_USER_ORDER'			=> 'Utilice mis preferencias de la exhibición del tablero',
	'DIGEST_SQL_PMS'					=> 'SQL usado para los mensajes privados para %s: %s',
	'DIGEST_SQL_PMS_NONE'				=> 'Ningún SQL publicó para private_messages para %s porque el usuario optó no demostrar mensajes privados en el resumen.',
	'DIGEST_SQL_POSTS_USERS'			=> 'SQL usado para los postes para %s: %s',
	'DIGEST_SQL_USERS'					=> 'El SQL recuperaba a usuarios que conseguían los resúmenes: %s',
	'DIGEST_SUBJECT_LABEL'				=> 'Tema',
	'DIGEST_SUBJECT_TITLE'				=> '%s %s Resumen',
	'DIGEST_TIME_ERROR'					=> "mail_digests.$phpEx calculaba un mal resumen envían hora de %s",
	'DIGEST_TOTAL_POSTS'				=> 'Postes totales en esto resumen:',
	'DIGEST_TOTAL_UNREAD_PRIVATE_MESSAGES'	=> 'Mensajes privados del unread total:',
	'DIGEST_UNREAD'						=> 'Unread',
	'DIGEST_UPDATED'					=> 'Sus ajustes del resumen fueron ahorrados',
	'DIGEST_USE_BOOKMARKS'				=> 'Asuntos Bookmarked solamente',
	'DIGEST_VERSION_NOT_UP_TO_DATE'		=> 'Aviso del administrador: esta versión de los resúmenes del phpBB no es actual. Las actualizaciones están disponibles en <a href="%s">Digiere Web site</a>.',
	'DIGEST_VERSION_UP_TO_DATE'			=> 'Esta versión de los resúmenes del phpBB es actualizada, ninguna actualización disponible.',
	'DIGEST_WEEKDAY' => array(
		0	=> 'Domingo',
		1 	=> 'Lunes',
		2	=> 'Martes',
		3	=> 'Miércoles',
		4	=> 'Jueves',
		5	=> 'Viernes',
		6	=> 'Sábado'),
	'DIGEST_WEEKLY'						=> 'Semanal',
	'DIGEST_YOU_HAVE_PRIVATE_MESSAGES' 	=>	'Usted tiene mensajes privados',
	'DIGEST_YOUR_DIGEST_OPTIONS' 		=> 'Sus opciones del resumen:',
	'S_DIGEST_TITLE'					=> (isset($config['digests_digests_title'])) ? $config['digests_digests_title'] : 'phpBB Digests',
	'UCP_DIGESTS_MODE_ERROR'			=> 'Los resúmenes fueron llamados con un modo inválido de %s',
				
));
			
?>