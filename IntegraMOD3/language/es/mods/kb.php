<?php
/**
*
* @author @author Tobi Schaefer www.tas2580.de/
*
* Knowledge Base [Spanish]
* @note: Do not remove this copyright. Just append yours if you have modified it,
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

$lang = array_merge($lang, array(
	'USER'					=> 'Usuario',
	'ACTIVATE_RATING'		=> 'Permitir valoraciones',
	'ACTIVATE_RATING_DESC'	=> 'Permitir a los usuarios valorar artículos',
	'YOU_RATED'				=> 'Valoración propia',
	'ALREADY_RATED'			=> '¡ERROR! Ya has valorado',
	'ARTICLE_RATED'			=> 'Has valorado este artículo',
	'RATING'				=> 'Valoración',
	'RATINGS'				=> 'Valoraciones',
	'RATE_GOOD'				=> 'muy bueno',
	'RATE_ACCEPTABLE'		=> 'aceptable',
	'RATE_BAD'				=> 'malo',
	'RATE_ARTICLE'			=> 'Valorar artículo',
	'RATE'					=> 'Valorar',
	'ACTIVATE_POST'			=> 'Crear mensaje',
	'ACTIVATE_POST_DESC'	=> 'Crear un mensaje en el foro al añadir un artículo',
	'ACTIVATE_DIFF'			=> 'Activar historial',
	'ACTIVATE_DIFF_DESC'	=> 'Al editar un artículo se guardará la versión anterior',
	'ACTION'				=> 'Acción',
	'ACTIVATE_SIMILAR'		=> 'Activar artículos similares',
	'ACTIVATE_SIMILAR_DESC'	=> '',
	'DIFFERENCE'			=> 'Diferencia entre la versión: %s y el artículo actual',
	'DIFF_DEL'				=> '¿Eliminar la versión anterior?',
	'DIFF_RESTORE'			=> 'Restaurar la versión anterior',
	'ARTICLE_RESTORED'		=> 'El artículo ha sido restaurado',
	'SIMILAR_ARTICLES'		=> 'Artículos similares',
	'OLD_VERSIONS'			=> 'Versiones anteriores',
	'RESTORE'				=> 'Restaurar',
	'ARTICLE_DETAIL'		=> 'Detalles del artículo',
	'ARTICLE_REPORTED'		=> 'Este artículo ha sido denunciado',
	'DISPLAY_ON_INDEX'		=> 'Mostrar en la categoría principal',
	'DISPLAY_ON_INDEX_DESC'	=> '',
	'DELETED'				=> 'La entrada ha sido eliminada',
	'MCP_REPORT_TITLE'		=> 'Artículos denunciados',
	'MCP_REPORT_EXPLAIN'	=> '',
	'REALY_DELETE'			=> '¿Debe eliminarse realmente la entrada?',
	'VIEW_REPORTS_OLD'		=> 'Ver denuncias cerradas',
	'VIEW_REPORTS_NEW'		=> 'Ver denuncias abiertas',
	'SHOW_ARTICLE'			=> 'Mostrar artículo',
	'SORT_ORDER'			=> 'Orden de clasificación',
	'SORT_ORDER_DESC'		=> 'Ordenación de los artículos en las categorías',
	'SUB_CATGEGORIES'		=> 'Subcategorías',
	'SEARCH_CATEGORIE'		=> 'Buscar categoría',
	'ACP_TYPES'				=> 'Tipos de artículo',
	'ACP_TYPES_DESC'		=> 'Aquí puedes añadir y editar tipos de artículo',
	'ACP_CATEGORIE'			=> 'Categoría',
	'ACP_CATEGORIE_DESC'	=> 'Aquí puedes añadir o editar categorías de la Base de Conocimientos.',
	'ACP_CONFIG'			=> 'Configuración',
	'ACP_KB'				=> 'Base de Conocimientos',
	'ACP_CONFIG_DESC'		=> 'Aquí puedes editar la configuración de la Base de Conocimientos.',
	'ARTICLE_ACTIVATED'		=> '¡El artículo ha sido publicado!',
	'ARTICLE_DELETED'		=> '¡El artículo ha sido eliminado!',
	'ARTICLE_ADDED'			=> 'El artículo ha sido enviado y se publicará en la Base de Conocimientos tras su revisión.',
	'ARTICLE_HISTORY'		=> 'Registro del artículo',
	'ARTICLE_ADD'			=> 'Añadir un artículo',
	'ARTICLE_TITLE'			=> 'Título',
	'ARTICLE_TITLE_LANG_EXPLAIN'	=> 'Para usar una cadena del catálogo localizado, introduce el campo completo como {L_KEY}. Las claves están en language/{iso}/kb/articles.php. Guarda ese archivo PHP como UTF-8 sin BOM (Notepad++: Encoding → Convert to UTF-8 without BOM, luego Guardar). El Bloc de notas de Windows puede añadir un BOM y tumbar el foro con headers already sent. Los títulos normales se guardan tal como se escriben.',
	'ARTICLE_DESCRIPTION'	=> 'Descripción',
	'ARTICLE_DESCRIPTION_LANG_EXPLAIN'	=> 'Opcional. Usa {L_KEY} para una descripción localizada, o deja texto normal. Los archivos de catálogo deben guardarse como UTF-8 sin BOM.',
	'ARTICLE_LANG_EXPLAIN'	=> 'Para localizar el cuerpo del artículo, introduce solo {L_KEY} en este campo. De lo contrario, escribe el artículo como de costumbre. Edita language/{iso}/kb/articles.php en Notepad++ u otro editor que pueda guardar UTF-8 sin BOM. No uses el Bloc de notas de Windows.',
	'KB_LANG_KEY_MISSING'	=> 'La clave de idioma %s no se encontró en language/en/kb/articles.php.',
	'ARTICLE'				=> 'Artículo',
	'ARTICLE_TYPES'			=> 'Tipos de artículo',
	'ARTICLE_TYPES_DESC'	=> '¿En qué tipos de artículo quieres buscar? Usa la tecla Ctrl para elegir más de uno. No elijas ningún tipo para buscar en todos.',
	'ARTICLE_CONT'			=> 'Artículos en la base de datos',
	'ARTICLE_DEL'			=> '¿Debe eliminarse realmente el artículo?',
	'ARTICLE_EDIT'			=> 'Editar artículo',
	'ARTICLE_EDITED'		=> '¡El artículo ha sido editado!',
	'ARTICLE_DEACTIVATED'	=> 'Artículo bloqueado',
	'ARTICLE_POSTET'		=> 'Artículo publicado',
	'AKTIVATE'				=> 'Activar',

	'BACK_ARTICLE'			=> 'Volver al artículo',
	'BACK_KB'				=> 'Volver a la Base de Conocimientos',
	'BACK_TO_ARTICLE'		=> 'Haz clic %saquí%s para ver el artículo.',
	'BACK_TO_POSTING'		=> 'Haz clic %saquí%s para volver.',
	'BACK_TO_KB'			=> 'Haz clic %saquí%s para volver a la Base de Conocimientos.',
	'BACK_TO_LOG'			=> 'Haz clic %saquí%s para volver al registro del artículo.',



	'CATEGORIE'				=> 'Categoría',
	'CHANGED_AT'			=> 'Cambiado el',
	'CONT_CAT'				=> 'Categoría',
	'CATEGORIES'			=> 'categorías',
	'CATEGORIES_DESC'		=> '¿En qué categorías quieres buscar? Usa la tecla Ctrl para elegir más de una. No elijas ninguna para buscar en todas.',
	'CAT_NOT_EMPTY'			=> '¡La categoría no está vacía!',
	'NO_CAT'				=> 'La categoría seleccionada no existe.',
	'CAT_NAME'				=> 'Nombre de la categoría',
	'CAT_NAME_DESC'			=> 'Nombre de la categoría',
	'CAT_IMAGE'				=> 'Imagen de la categoría',
	'CAT_IMAGE_DESC'		=> 'Introduce aquí la URL de una imagen para la categoría.',
	'CAT_DECRIPTION_DESC'		=> 'Indica una descripción para la categoría',
	'CAT_MAIN'				=> 'Categoría principal',
	'CAT_SELECT_MAIN'		=> 'Elige una categoría principal',
	'CAT_ADDED'				=> 'La categoría ha sido añadida',
	'CAT_DELETED'			=> 'La categoría ha sido eliminada.',
	'CAT_UPDATED'			=> 'La categoría ha sido actualizada.',
	'CAT_REALY_DELETE'		=> '¿Debe eliminarse realmente la categoría?',
	'CAT_CREATE_NEW'		=> 'Nueva categoría',
	'DESCRIPTION'			=> 'Descripción',


	'FIENAME'				=> 'Nombre de archivo',
	'FOUND_IN'				=> 'Encontrado en',
	'INDEX_POSTS'			=> 'Artículos en la página de índice',
	'INDEX_POSTS_DESC'		=> '¿Cuántos artículos deben mostrarse en la página de índice?',
	'KB_NAME'				=> 'Base de Conocimientos',
	'KB_SHORT'				=> 'BC',	
	'KB_NAME_DESC'			=> 'El nombre de la Base de Conocimientos',
	'KB_DECRIPTION_DESC'	=> 'Introduce una descripción para la Base de Conocimientos.',
	'KBASE'					=> 'Base de Conocimientos',
	'KB_DESCRIPTION'		=> 'Si has escrito un artículo, puedes previsualizarlo al final de la página y enviarlo para su revisión. Si se aprueba, el artículo se publicará en la Base de Conocimientos. ',

	'LOG_TITEL'				=> 'Registro del artículo',
	'LOG_DESCRIPTION'		=> 'Aquí puedes ver cuándo se editó el artículo y qué usuario lo hizo.',
	'LOG_DELETED'			=> 'El registro del artículo ha sido eliminado.',

	'MAINCAT_DESC'			=> 'Aquí puedes crear categorías principales, en las que luego crearás subcategorías para los artículos.',

	'MODE'					=> 'Modo',
	'MODE_DESC'				=> '¿Qué modo quieres usar para la página de índice?',
	'MODE_MODERN'			=> 'Moderno',
	'MODE_CLASSIC'			=> 'Clásico',
	'NO_ARTICLE'			=> '¡El artículo deseado no existe!',
	'NEED_INPUT'			=> '¡Introduce un título y un texto para el artículo!',
	'ARTICLE_NEW'			=> 'Artículos no publicados',
	'ARTICLE_NEW_DESC'		=> 'Los siguientes artículos aún no se han publicado o han sido bloqueados',
	'NAME'					=> 'Nombre de la categoría',
	'NEED_NAME'				=> 'Indica un nombre para la categoría',
	'ARTICLE_NEWEST'		=> 'El artículo más reciente es',
	'NO_TYPE'				=> 'Sin tipo',
	'POST_FORUM'			=> 'Foro de referencia del artículo',
	'POST_TEMPLATE'			=> 'Plantilla de mensaje',
	'POST_MESSAGE'			=> 'Texto del mensaje',
	'POST_USER'				=> 'ID de usuario',
	'POST_NORMAL'			=> 'Normal',
	'POST_TOPIC_GLOBAL'		=> 'Anuncio global',
	'POST_TOPIC_AS'			=> 'Publicar el tema como',
	'POST_TOPIC_AS_DESC'	=> '¿Qué tipo de tema se creará?',
	'POST_USER_DESC'		=> 'El ID del usuario que crea los mensajes',
	'POST_SUBJECT'			=> 'Título del tema',
	'POST_SUBJECT_DESC'		=> 'El título del tema que se creará',
	'POST_FORUM_DESC'		=> 'Indica el ID del foro en el que se debe crear una referencia al artículo. Introduce «0» para no crear referencias a artículos nuevos.',
	'POST_MESSAGE_DESC'		=> '{TITLE} = Título del artículo <br />{DESCRIPTION} = Descripción del artículo<br />{POST_TIME} = Fecha de redacción<br />{TYPE} = Tipo de artículo<br />{SUB_CAT} = Categoría<br />{URL} = URL del artículo<br />{AUTHOR} = Autor del artículo<br />{AUTHOR_ID} = ID de usuario del autor.',
	'RELASED'				=> 'Publicado el',
	'READ_MORE'				=> 'Mostrar los %s artículos',


	'SEARCH_KEYWORDS_DESC'	=> 'Aquí puedes buscar en la Base de Conocimientos.',
	'SHOW_EDITS'			=> 'Mostrar ediciones',
	'SHOW_EDITS_DESC'		=> '¿Deben mostrarse las ediciones en el artículo?',
	'TYPE'					=> 'Tipo de artículo',
	'TYPE_DESC'				=> 'Indica un nombre para el tipo de artículo',
	'TYPE_ADDED'			=> 'El tipo ha sido añadido',
	'TYPE_UPDATED'			=> 'El tipo ha sido eliminado',

	'NO_SUBCAT_IN_MAINCAT'	=> '¡No puedes crear subcategorías en el índice!',
	'CAT_TYPE'				=> 'Tipo de categoría',
	'CAT_TYPE_DESC'			=> 'Elige un tipo de categoría',
	'IN_INDEX'				=> 'En el índice',
	'CAT_SUB'				=> 'Subcategoría',

	'CACHE_TIME'			=> 'Tiempo de caché',
	'CACHE_TIME_DESC'		=> 'Tiempo durante el cual se almacenan en caché los tipos y las categorías',
	'SECONDS'				=> 'Segundos',
	'ACTIVATE_TYPES'		=> '¿Usar tipos de artículo?',
	'ACTIVATE_TYPES_DESC'	=> '¿Se puede asignar un tipo a un artículo?',
	'UPDATE_POST'			=> 'Actualizar mensaje',
	'UPDATE_POST_DESC'		=> '¿Debe actualizarse el mensaje del artículo cuando se actualice el artículo?',
	'POST_UPDATE_MESSAGE'	=> 'Artículo actualizado',
	'POST_ID'				=> 'ID del mensaje del foro',
	'ARTICLE_ADDED_AKTIV'	=> 'El artículo se ha guardado en la base de datos y se ha activado',
	'SHOW_POST_EDIT'		=> 'Mostrar actualizaciones',
	'SHOW_POST_EDIT_DESC'	=> '¿Debe mostrarse una actualización en el mensaje?',

	'PRINT_TOPIC'			=> 'Imprimir artículo',
	'SEARCH_CATEGORIE'		=> 'Buscar en la categoría...',

	'ADS'					=> 'Publicidad',
	'KB_COPYRIGHT'			=> 'Base de Conocimientos por Tobi Schaefer',
	'ADS_DESC'				=> 'Aquí puedes insertar el código de tu publicidad.',
	'URI_IN_USE'			=> 'La URL ya está en uso',
	'USER_CHANGED'			=> 'El usuario ha sido cambiado',

	// Missing variables
	'VIEW_KB_TOPIC'						=> 'Ver tema en el foro',
	'EDIT_REASON'						=> 'Razón para editar este artículo',
	'ACL_TYPE_KB_'						=> '', // blank per phpBB convention for prefix map if intended that way, or could be 'Base de Conocimientos'
	'ACP_KB_ROLES'						=> 'Roles de Base de Conocimientos',
	'ACP_KB_ROLES_EXPLAIN'				=> '',
	'KB_CATEGORIE_PERMISSIONS'			=> 'Permisos de categoría de Base de Conocimientos',
	'KB_CATEGORIE_PERMISSIONS_DESC'		=> 'Aquí puedes modificar qué usuarios y grupos pueden acceder a cuál categoría.',
	'LOOK_UP_CATEGORIE'					=> 'Seleccione una categoría',
	'LOOK_UP_FORUMS_EXPLAIN'			=> 'Usted puede seleccionar más de una categoría',
	'ACL_TYPE_LOCAL_KB_'				=> 'Permisos de Base de Conocimientos',
	'PERMISSION_TYPE'					=> 'Permisos de Base de Conocimientos',
	'ALL_CATEGORIES'					=> 'Todas las categorías',
	'SELECT_CATEGORIE_SUBFORUM_EXPLAIN'	=> 'La Categoría que seleccione aquí incluirá todas las subcategorías en la selección.',
));

?>