<?php
/**
 *
 * install [Spanish]
 *
 * @package language
 * @version $Id$
 * @copyright (c) 2005 phpBB Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB')) {
    exit;
}

if (empty($lang) || !is_array($lang)) {
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
    'ADMIN_CONFIG' => 'Configuración del administrador',
    'ADMIN_PASSWORD' => 'Contraseña del administrador',
    'ADMIN_PASSWORD_CONFIRM' => 'Confirmar contraseña del administrador',
    'ADMIN_PASSWORD_EXPLAIN' => 'Por favor introduzca una contraseña de entre 6 y 30 caracteres.',
    'ADMIN_TEST' => 'Comprobar ajustes del administrador',
    'ADMIN_USERNAME' => 'Nombre de usuario del administrador',
    'ADMIN_USERNAME_EXPLAIN' => 'Por favor introduzca un nombre de usuario de entre 3 y 20 caracteres.',
    'APP_MAGICK' => 'Soporte Imagemagick [Adjuntos]',
    'AUTHOR_NOTES' => 'Notas del autor<br />» %s',
    'AVAILABLE' => 'Disponible',
    'AVAILABLE_CONVERTORS' => 'Convertidores disponibles',

    'BEGIN_CONVERT' => 'Iniciar conversión',
    'BLANK_PREFIX_FOUND' => 'Un escaneo de sus tablas ha mostrado una instalación válida sin prefijo de tabla.',
    'BOARD_NOT_INSTALLED' => 'No se encontró instalación',
    'BOARD_NOT_INSTALLED_EXPLAIN' => 'El Framework de Convertidor Unificado de phpBB requiere una instalación por defecto de phpBB3 para funcionar, por favor <a href="%s">proceda instalando phpBB3 primero</a>.',
    'BACKUP_NOTICE' => 'Por favor haga una copia de seguridad de su foro antes de actualizar por si surgen problemas durante el proceso.',

    'CATEGORY' => 'Categoría',
    'CACHE_STORE' => 'Tipo de caché',
    'CACHE_STORE_EXPLAIN' => 'La ubicación física donde se cachean los datos; se prefiere el sistema de archivos.',
    'CAT_CONVERT' => 'Convertir',
    'CAT_INSTALL' => 'Instalar',
    'CAT_OVERVIEW' => 'Resumen',
    'CAT_UPDATE' => 'Actualizar',
    'CHANGE' => 'Cambiar',
    'CHECK_TABLE_PREFIX' => 'Por favor verifique el prefijo de las tablas y vuelva a intentarlo.',
    'CLEAN_VERIFY' => 'Limpiando y verificando la estructura final',
    'CLEANING_USERNAMES' => 'Limpiando nombres de usuario',
    'COLLIDING_CLEAN_USERNAME' => '<strong>%s</strong> es el nombre de usuario limpio para:',
    'COLLIDING_USERNAMES_FOUND' => 'Se han encontrado nombres de usuario en conflicto en su antiguo foro. Para completar la conversión elimine o renombre estos usuarios para que solo haya un usuario por cada nombre limpio.',
    'COLLIDING_USER' => '» id de usuario: <strong>%d</strong> nombre de usuario: <strong>%s</strong> (%d mensajes)',
    'CONFIG_CONVERT' => 'Convirtiendo la configuración',
    'CONFIG_FILE_UNABLE_WRITE' => 'No fue posible escribir el archivo de configuración. Se presentan métodos alternativos para crear este archivo a continuación.',
    'CONFIG_FILE_WRITTEN' => 'El archivo de configuración ha sido escrito. Puede proceder al siguiente paso de la instalación.',
    'CONFIG_PHPBB_EMPTY' => 'La variable de configuración phpBB3 para “%s” está vacía.',
    'CONFIG_RETRY' => 'Reintentar',
    'CONTACT_EMAIL_CONFIRM' => 'Confirmar correo de contacto',
    'CONTINUE_CONVERT' => 'Continuar conversión',
    'CONTINUE_CONVERT_BODY' => 'Se ha detectado un intento de conversión previo. Ahora puede elegir entre iniciar una nueva conversión o continuar la anterior.',
    'CONTINUE_LAST' => 'Continuar últimas instrucciones',
    'CONTINUE_OLD_CONVERSION' => 'Continuar conversión iniciada previamente',
    'CONVERT' => 'Convertir',
    'CONVERT_COMPLETE' => 'Conversión completada',
    'CONVERT_COMPLETE_EXPLAIN' => 'Ha convertido su foro a phpBB 3.0 con éxito. Ahora puede iniciar sesión y <a href="../">acceder a su foro</a>. Asegúrese de que los ajustes se han transferido correctamente antes de habilitar su foro eliminando el directorio de instalación. Recuerde que puede obtener ayuda sobre phpBB en la <a href="https://www.phpbb.com/support/documentation/3.0/">Documentación</a> y en los <a href="https://www.phpbb.com/community/viewforum.php?f=46">foros de soporte</a>.',
    'CONVERT_INTRO' => 'Bienvenido al Framework Convertidor Unificado de phpBB',
    'CONVERT_INTRO_BODY' => 'Desde aquí puede importar datos de otros sistemas de foros (instalados). La lista abajo muestra todos los módulos de conversión actualmente disponibles. Si no aparece un convertidor para el software del que desea convertir, consulte nuestro sitio web para más módulos disponibles para descargar.',
    'CONVERT_NEW_CONVERSION' => 'Nueva conversión',
    'CONVERT_NOT_EXIST' => 'El convertidor especificado no existe.',
    'CONVERT_OPTIONS' => 'Opciones',
    'CONVERT_SETTINGS_VERIFIED' => 'La información introducida ha sido verificada. Para comenzar la conversión pulse el botón abajo.',
    'CONV_ERR_FATAL' => 'Error fatal de conversión',

    'CONV_ERROR_ATTACH_FTP_DIR' => 'El envío FTP de adjuntos está habilitado en el foro antiguo. Desactive la opción FTP y asegúrese de que se especifica un directorio de subida válido, luego copie todos los archivos adjuntos a este nuevo directorio accesible por la web. Una vez hecho, reinicie el convertidor.',
    'CONV_ERROR_CONFIG_EMPTY' => 'No hay información de configuración disponible para la conversión.',
    'CONV_ERROR_FORUM_ACCESS' => 'No se pueden obtener información de acceso al foro.',
    'CONV_ERROR_GET_CATEGORIES' => 'No se pudieron obtener las categorías.',
    'CONV_ERROR_GET_CONFIG' => 'No se pudo recuperar la configuración de su foro.',
    'CONV_ERROR_COULD_NOT_READ' => 'No se puede acceder/leer “%s”.',
    'CONV_ERROR_GROUP_ACCESS' => 'No se puede obtener la información de autenticación de grupos.',
    'CONV_ERROR_INCONSISTENT_GROUPS' => 'Se detectó inconsistencia en la tabla de grupos en add_bots() — debe añadir todos los grupos especiales si lo hace manualmente.',
    'CONV_ERROR_INSERT_BOT' => 'No se pudo insertar el bot en la tabla users.',
    'CONV_ERROR_INSERT_BOTGROUP' => 'No se pudo insertar el bot en la tabla bots.',
    'CONV_ERROR_INSERT_USER_GROUP' => 'No se pudo insertar el usuario en la tabla user_group.',
    'CONV_ERROR_MESSAGE_PARSER' => 'Error del analizador de mensajes',
    'CONV_ERROR_NO_AVATAR_PATH' => 'Nota para el desarrollador: debe especificar $convertor[\'avatar_path\'] para usar %s.',
    'CONV_ERROR_NO_FORUM_PATH' => 'No se ha especificado la ruta relativa al foro fuente.',
    'CONV_ERROR_NO_GALLERY_PATH' => 'Nota para el desarrollador: debe especificar $convertor[\'avatar_gallery_path\'] para usar %s.',
    'CONV_ERROR_NO_GROUP' => 'No se pudo encontrar el grupo “%1$s” en %2$s.',
    'CONV_ERROR_NO_RANKS_PATH' => 'Nota para el desarrollador: debe especificar $convertor[\'ranks_path\'] para usar %s.',
    'CONV_ERROR_NO_SMILIES_PATH' => 'Nota para el desarrollador: debe especificar $convertor[\'smilies_path\'] para usar %s.',
    'CONV_ERROR_NO_UPLOAD_DIR' => 'Nota para el desarrollador: debe especificar $convertor[\'upload_path\'] para usar %s.',
    'CONV_ERROR_PERM_SETTING' => 'No se pudo insertar/actualizar la configuración de permisos.',
    'CONV_ERROR_PM_COUNT' => 'No se pudo seleccionar el recuento de carpetas de MP.',
    'CONV_ERROR_REPLACE_CATEGORY' => 'No se pudo insertar un foro nuevo reemplazando la categoría antigua.',
    'CONV_ERROR_REPLACE_FORUM' => 'No se pudo insertar un foro nuevo reemplazando el foro antiguo.',
    'CONV_ERROR_USER_ACCESS' => 'No se pudo obtener la información de autenticación de usuarios.',
    'CONV_ERROR_WRONG_GROUP' => 'Grupo incorrecto “%1$s” definido en %2$s.',
    'CONV_OPTIONS_BODY' => 'Esta página recoge los datos necesarios para acceder al foro fuente. Introduzca los detalles de la base de datos de su antiguo foro; el convertidor no cambiará nada en la base de datos indicada a continuación. El foro fuente debe estar deshabilitado para permitir una conversión coherente.',
    'CONV_SAVED_MESSAGES' => 'Mensajes guardados',

    'COULD_NOT_COPY' => 'No se pudo copiar el archivo <strong>%1$s</strong> a <strong>%2$s</strong><br /><br />Compruebe que el directorio destino existe y es escribible por el servidor web.',
    'COULD_NOT_FIND_PATH' => 'No se pudo encontrar la ruta a su antiguo foro. Compruebe sus ajustes y vuelva a intentarlo.<br />» %s fue especificado como ruta fuente.',

    'DBMS' => 'Tipo de base de datos',
    'DB_CONFIG' => 'Configuración de la base de datos',
    'DB_CONNECTION' => 'Conexión a la base de datos',
    'DB_ERR_INSERT' => 'Error al procesar la consulta <code>INSERT</code>.',
    'DB_ERR_LAST' => 'Error al procesar <var>query_last</var>.',
    'DB_ERR_QUERY_FIRST' => 'Error al ejecutar <var>query_first</var>.',
    'DB_ERR_QUERY_FIRST_TABLE' => 'Error al ejecutar <var>query_first</var>, %s (“%s”).',
    'DB_ERR_SELECT' => 'Error al ejecutar la consulta <code>SELECT</code>.',
    'DB_HOST' => 'Hostname del servidor de base de datos o DSN',
    'DB_HOST_EXPLAIN' => 'DSN significa Data Source Name y es relevante solo para instalaciones ODBC. En PostgreSQL use localhost para conectar mediante socket UNIX y 127.0.0.1 para TCP. Para SQLite, indique la ruta completa al archivo de la base de datos.',
    'DB_NAME' => 'Nombre de la base de datos',
    'DB_PASSWORD' => 'Contraseña de la base de datos',
    'DB_PORT' => 'Puerto del servidor de base de datos',
    'DB_PORT_EXPLAIN' => 'Déjelo en blanco a menos que sepa que el servidor usa un puerto no estándar.',
    'DB_UPDATE_NOT_SUPPORTED' => 'Lo sentimos, pero este script no soporta actualizaciones desde versiones de phpBB anteriores a “%1$s”. La versión actualmente instalada es “%2$s”. Por favor actualice a una versión intermedia antes de ejecutar este script. Puede obtener asistencia en el foro de soporte en phpBB.com.',
    'DB_USERNAME' => 'Usuario de la base de datos',
    'DB_TEST' => 'Probar conexión',
    'DEFAULT_LANG' => 'Idioma predeterminado del foro',
    'DEFAULT_PREFIX_IS' => 'El convertidor no pudo encontrar tablas con el prefijo especificado. Asegúrese de haber introducido los detalles correctos para el foro desde el que convierte. El prefijo por defecto para %1$s es <strong>%2$s</strong>.',
    'DEV_NO_TEST_FILE' => 'No se ha especificado un valor para la variable test_file en el convertidor. Si usted usa este convertidor no debería ver este error; repórtelo al autor del convertidor. Si es autor del convertidor, debe especificar el nombre de un archivo que exista en el foro fuente para verificar la ruta.',
    'DIRECTORIES_AND_FILES' => 'Configuración de directorios y archivos',
    'DISABLE_KEYS' => 'Deshabilitando claves',
    'DLL_FIREBIRD' => 'Firebird',
    'DLL_FTP' => 'Soporte FTP remoto [Instalación]',
    'DLL_GD' => 'Soporte GD para gráficos [Confirmación visual]',
    'DLL_MBSTRING' => 'Soporte multibyte',
    'DLL_MSSQL' => 'MSSQL Server 2000+',
    'DLL_MSSQL_ODBC' => 'MSSQL Server 2000+ via ODBC',
    'DLL_MSSQLNATIVE' => 'MSSQL Server 2005+ [Nativo]',
    'DLL_MYSQL' => 'MySQL',
    'DLL_MYSQLI' => 'MySQL con extensión MySQLi',
    'DLL_ORACLE' => 'Oracle',
    'DLL_POSTGRES' => 'PostgreSQL',
    'DLL_SQLITE' => 'SQLite',
    'DLL_XML' => 'Soporte XML [Jabber]',
    'DLL_ZLIB' => 'Soporte zlib [gz, .tar.gz, .zip]',
    'DL_CONFIG' => 'Descargar config',
    'DL_CONFIG_EXPLAIN' => 'Puede descargar el config.php completo a su PC. Luego deberá subirlo manualmente, reemplazando cualquier config.php existente en la raíz de phpBB 3.0. Recuerde subirlo en formato ASCII. Cuando haya subido config.php haga clic en “Done” para pasar al siguiente paso.',
    'DL_DOWNLOAD' => 'Descargar',
    'DONE' => 'Hecho',

    'ENABLE_KEYS' => 'Rehabilitando claves. Esto puede tardar un rato.',

    'FILES_OPTIONAL' => 'Archivos y directorios opcionales',
    'FILES_OPTIONAL_EXPLAIN' => '<strong>Opcional</strong> - Estos archivos, directorios o permisos no son obligatorios. El instalador intentará crearlos si no existen o no son escribibles. Sin embargo, su presencia acelera la instalación.',
    'FILES_REQUIRED' => 'Archivos y directorios',
    'FILES_REQUIRED_EXPLAIN' => '<strong>Requerido</strong> - Para funcionar correctamente phpBB necesita acceso o permisos de escritura en ciertos archivos o directorios. Si ve “Not Found” debe crear el archivo/directorio. Si ve “Unwritable” debe cambiar los permisos para permitir escritura.',
    'FILLING_TABLE' => 'Llenando la tabla <strong>%s</strong>',
    'FILLING_TABLES' => 'Llenando tablas',

    'FIREBIRD_DBMS_UPDATE_REQUIRED' => 'phpBB ya no soporta Firebird/Interbase anterior a la versión 2.1. Actualice Firebird a al menos 2.1.0 antes de continuar.',

    'FINAL_STEP' => 'Paso final del proceso',
    'FORUM_ADDRESS' => 'Dirección del foro',
    'FORUM_ADDRESS_EXPLAIN' => 'Esta es la URL de su foro anterior, por ejemplo <samp>http://www.example.com/phpBB2/</samp>. Si se introduce una dirección aquí, cada instancia de esa dirección será reemplazada por la dirección de su nuevo foro en mensajes, mensajes privados y firmas.',
    'FORUM_PATH' => 'Ruta del foro',
    'FORUM_PATH_EXPLAIN' => 'Esta es la ruta <strong>relativa</strong> en disco a su foro anterior desde la <strong>raíz de esta instalación phpBB3</strong>.',
    'FOUND' => 'Encontrado',
    'FTP_CONFIG' => 'Transferir configuración por FTP',
    'FTP_CONFIG_EXPLAIN' => 'phpBB ha detectado el módulo FTP en este servidor. Puede intentar instalar config.php por FTP. Deberá proporcionar la información indicada abajo. Recuerde que el usuario y la contraseña son los de su servidor (pregunte al proveedor si no está seguro).',
    'FTP_PATH' => 'Ruta FTP',
    'FTP_PATH_EXPLAIN' => 'Esta es la ruta desde su directorio raíz hasta phpBB, por ejemplo <samp>htdocs/phpBB3/</samp>.',
    'FTP_UPLOAD' => 'Subir',

    'GPL' => 'Licencia Pública General',

    'INITIAL_CONFIG' => 'Configuración básica',
    'INITIAL_CONFIG_EXPLAIN' => 'Ahora que el instalador ha determinado que su servidor puede ejecutar phpBB debe proporcionar información específica. Si no sabe cómo conectarse a su base de datos contacte a su proveedor de hosting o use los foros de soporte de phpBB. Revise cuidadosamente los datos antes de continuar.',
    'INSTALL_CONGRATS' => '¡Felicidades!',
    'INSTALL_CONGRATS_EXPLAIN' => '
		Ha instalado IntegraMOD %1$s correctamente. Por favor proceda eligiendo una de las siguientes opciones:</p>
		<h2>Convertir un foro existente a IntegraMOD3</h2>
		<p>El Framework Convertidor Unificado de phpBB soporta la conversión desde phpBB 2.0.x y otros sistemas a IntegraMOD3. Si tiene un foro que desea convertir, por favor <a href="%2$s">proceda al convertidor</a>.</p>
		<h2>¡Ponga IntegraMOD3 en producción!</h2>
		<p><strong>Por favor elimine, mueva o renombre el directorio de instalación antes de usar su foro. Mientras exista este directorio, solo el Panel de Control de Administración (ACP) será accesible.</strong>',
    'INSTALL_INTRO' => 'Bienvenido a la instalación',

    'INSTALL_INTRO_BODY' => 'Con esta opción puede instalar IntegraMOD en su servidor.</p><p>Para continuar necesitará los ajustes de su base de datos. Si no los conoce pida a su host. No podrá continuar sin ellos. Necesitará:</p>

	<ul>
		<li>El tipo de base de datos - la base que va a usar.</li>
		<li>El hostname o DSN del servidor de base de datos - la dirección del servidor.</li>
		<li>El puerto del servidor de base de datos - el puerto (la mayoría de las veces no es necesario).</li>
		<li>El nombre de la base de datos - el nombre en el servidor.</li>
		<li>El usuario y la contraseña de la base de datos - credenciales para acceder a la base.</li>
	</ul>

	<p><strong>Nota:</strong> si instala usando SQLite, introduzca la ruta completa al archivo de base de datos en el campo DSN y deje usuario y contraseña en blanco. Por seguridad asegúrese de que el archivo no esté en una ubicación accesible desde la web.</p>

	<p>IntegraMOD soporta las siguientes bases de datos:</p>
	<ul>
		<li>MySQL 3.23 o superior (MySQLi soportado)</li>
		<li>PostgreSQL 7.3+</li>
		<li>SQLite 2.8.2+</li>
		<li>Firebird 2.1+</li>
		<li>MS SQL Server 2000 o superior (directo o via ODBC)</li>
		<li>MS SQL Server 2005 o superior (nativo)</li>
		<li>Oracle</li>
	</ul>

	<p>Sólo se mostrarán las bases soportadas por su servidor.',
    'INSTALL_INTRO_NEXT' => 'Para comenzar la instalación, presione el botón abajo.',
    'INSTALL_LOGIN' => 'Acceder',
    'INSTALL_NEXT' => 'Siguiente etapa',
    'INSTALL_NEXT_FAIL' => 'Algunas pruebas fallaron y debe corregir estos problemas antes de continuar. No hacerlo puede ocasionar una instalación incompleta.',
    'INSTALL_NEXT_PASS' => 'Todas las pruebas básicas han pasado y puede proceder a la siguiente etapa de la instalación. Si ha cambiado permisos, módulos, etc. y desea re-probar, puede hacerlo.',
    'INSTALL_PANEL' => 'Panel de instalación',
    'INSTALL_SEND_CONFIG' => 'Desafortunadamente phpBB no pudo escribir la información de configuración directamente en su config.php. Esto puede deberse a que el archivo no existe o no es escribible. A continuación se listarán varias opciones para completar la instalación de config.php.',
    'INSTALL_START' => 'Iniciar instalación',
    'INSTALL_TEST' => 'Probar de nuevo',
    'INST_ERR' => 'Error de instalación',
    'INST_ERR_DB_CONNECT' => 'No se pudo conectar a la base de datos, vea el mensaje de error abajo.',
    'INST_ERR_DB_FORUM_PATH' => 'El archivo de base de datos especificado está dentro del árbol de directorios de su foro. Debe mover este archivo a una ubicación no accesible desde la web.',
    'INST_ERR_DB_INVALID_PREFIX' => 'El prefijo introducido es inválido. Debe comenzar con una letra y contener solo letras, números y guiones bajos.',
    'INST_ERR_DB_NO_ERROR' => 'No se ha dado mensaje de error.',
    'INST_ERR_DB_NO_MYSQLI' => 'La versión de MySQL en esta máquina es incompatible con la opción “MySQL with MySQLi Extension” que seleccionó. Pruebe la opción “MySQL”.',
    'INST_ERR_DB_NO_SQLITE' => 'La versión de la extensión SQLite que tiene instalada es demasiado antigua; debe actualizar al menos a 2.8.2.',
    'INST_ERR_DB_NO_ORACLE' => 'La versión de Oracle instalada requiere que el parámetro <var>NLS_CHARACTERSET</var> esté establecido en <var>UTF8</var>. Actualice a 9.2+ o cambie el parámetro.',
    'INST_ERR_DB_NO_FIREBIRD' => 'La versión de Firebird instalada en esta máquina es anterior a 2.1; por favor actualice.',
    'INST_ERR_DB_NO_FIREBIRD_PS' => 'La base de Firebird seleccionada tiene un tamaño de página menor a 8192; debe ser al menos 8192.',
    'INST_ERR_DB_NO_POSTGRES' => 'La base de datos seleccionada no fue creada en <var>UNICODE</var> o <var>UTF8</var>. Intente instalar con una base en <var>UNICODE</var> o <var>UTF8</var>.',
    'INST_ERR_DB_NO_NAME' => 'No se especificó el nombre de la base de datos.',
    'INST_ERR_EMAIL_INVALID' => 'La dirección de correo electrónico introducida es inválida.',
    'INST_ERR_EMAIL_MISMATCH' => 'Los correos introducidos no coinciden.',
    'INST_ERR_FATAL' => 'Error fatal de instalación',
    'INST_ERR_FATAL_DB' => 'Ha ocurrido un error fatal e irrecuperable de base de datos. Esto puede deberse a que el usuario especificado no tiene permisos para <code>CREATE TABLES</code> o <code>INSERT</code>. Se puede dar más información abajo. Contacte a su proveedor de hosting o a los foros de soporte de phpBB.',
    'INST_ERR_FTP_PATH' => 'No se pudo cambiar al directorio indicado, verifique la ruta.',
    'INST_ERR_FTP_LOGIN' => 'No se pudo iniciar sesión en el servidor FTP, verifique usuario y contraseña.',
    'INST_ERR_MISSING_DATA' => 'Debe rellenar todos los campos de este bloque.',
    'INST_ERR_NO_DB' => 'No se puede cargar el módulo PHP para el tipo de base de datos seleccionado.',
    'INST_ERR_PASSWORD_MISMATCH' => 'Las contraseñas introducidas no coinciden.',
    'INST_ERR_PASSWORD_TOO_LONG' => 'La contraseña introducida es demasiado larga. La longitud máxima es 30 caracteres.',
    'INST_ERR_PASSWORD_TOO_SHORT' => 'La contraseña introducida es demasiado corta. La longitud mínima es 6 caracteres.',
    'INST_ERR_PREFIX' => 'Ya existen tablas con el prefijo especificado, elija otro.',
    'INST_ERR_PREFIX_INVALID' => 'El prefijo de tabla especificado no es válido para su base de datos. Intente otro eliminando caracteres como el guion.',
    'INST_ERR_PREFIX_TOO_LONG' => 'El prefijo de tabla especificado es demasiado largo. La longitud máxima es %d caracteres.',
    'INST_ERR_USER_TOO_LONG' => 'El nombre de usuario introducido es demasiado largo. La longitud máxima es 20 caracteres.',
    'INST_ERR_USER_TOO_SHORT' => 'El nombre de usuario introducido es demasiado corto. La longitud mínima es 3 caracteres.',
    'INVALID_PRIMARY_KEY' => 'Clave primaria inválida : %s',

    'LONG_SCRIPT_EXECUTION' => 'Tenga en cuenta que esto puede tardar un rato... Por favor no detenga el script.',

    // mbstring
    'MBSTRING_CHECK' => 'Comprobación de la extensión <samp>mbstring</samp>',
    'MBSTRING_CHECK_EXPLAIN' => '<strong>Requerido</strong> - <samp>mbstring</samp> es una extensión PHP que proporciona funciones multibyte. Algunas funciones de mbstring no son compatibles con phpBB y deben desactivarse.',
    'MBSTRING_FUNC_OVERLOAD' => 'Sobrecarga de funciones',
    'MBSTRING_FUNC_OVERLOAD_EXPLAIN' => '<var>mbstring.func_overload</var> debe estar establecido en 0 o 4.',
    'MBSTRING_ENCODING_TRANSLATION' => 'Traducción transparente de codificación',
    'MBSTRING_ENCODING_TRANSLATION_EXPLAIN' => '<var>mbstring.encoding_translation</var> debe estar establecido en 0.',
    'MBSTRING_HTTP_INPUT' => 'Conversión de caracteres de entrada HTTP',
    'MBSTRING_HTTP_INPUT_EXPLAIN' => '<var>mbstring.http_input</var> debe estar establecido en <samp>pass</samp>.',
    'MBSTRING_HTTP_OUTPUT' => 'Conversión de caracteres de salida HTTP',
    'MBSTRING_HTTP_OUTPUT_EXPLAIN' => '<var>mbstring.http_output</var> debe estar establecido en <samp>pass</samp>.',

    'MAKE_FOLDER_WRITABLE' => 'Por favor asegúrese de que esta carpeta existe y es escribible por el servidor web y vuelva a intentarlo:<br />»<strong>%s</strong>.',
    'MAKE_FOLDERS_WRITABLE' => 'Por favor asegúrese de que estas carpetas existen y son escribibles por el servidor web y vuelva a intentarlo:<br />»<strong>%s</strong>.',

    'MYSQL_SCHEMA_UPDATE_REQUIRED' => 'El esquema MySQL de su base de datos para phpBB está obsoleto. phpBB detectó un esquema para MySQL 3.x/4.x, pero el servidor ejecuta MySQL %2$s.<br /><strong>Antes de continuar con la actualización, necesita actualizar el esquema.</strong><br /><br />Consulte el artículo de la base de conocimientos sobre actualización del esquema MySQL. Si encuentra problemas, use nuestros foros de soporte.',

    'NAMING_CONFLICT' => 'Conflicto de nombres: %s y %s son ambos alias<br /><br />%s',
    'NEXT_STEP' => 'Proceder al siguiente paso',
    'NOT_FOUND' => 'No se puede encontrar',
    'NOT_UNDERSTAND' => 'No se pudo entender %s #%d, tabla %s (“%s”)',
    'NO_CONVERTORS' => 'No hay convertidores disponibles.',
    'NO_CONVERT_SPECIFIED' => 'No se especificó convertidor.',
    'NO_LOCATION' => 'No se puede determinar la ubicación. Si sabe que Imagemagick está instalado, puede especificar la ubicación luego desde el panel de administración',
    'NO_TABLES_FOUND' => 'No se encontraron tablas.',

    'OVERVIEW_BODY' => '¡Bienvenido a IntegraMOD3!<br /><br />IntegraMOD3 es una distribución phpBB3.0.x totalmente integrada basada en phpBB3.0.15. Combina phpBB con una gran colección de modificaciones integradas, funcionalidad de portal y mejoras comunitarias en un paquete unificado. phpBB® es una de las soluciones de foros open source más usadas del mundo, conocida por su estabilidad, flexibilidad y amplio conjunto de características.<br /><br />IntegraMOD3 incluye KISS Portal&copy;, el sistema de portal original de phpBB3 y una de las primeras modificaciones mayores desarrolladas durante las etapas alpha y beta de phpBB3. KISS Portal está en desarrollo continuo desde 2005 y sigue siendo uno de los sistemas de portal más completos y bien integrados disponibles para phpBB3. A pesar de sus capacidades, la mayoría de las funciones se pueden configurar fácilmente desde el Panel de Administración sin cambios de código.<br /><br />IntegraMOD3 también incluye numerosas funciones y mejoras preintegradas para ofrecer una plataforma comunitaria completa desde el primer momento manteniendo compatibilidad con el framework phpBB3.0.x.<br /><br />Este sistema de instalación le guiará para instalar IntegraMOD3, actualizar desde versiones anteriores o convertir desde otro sistema de foros (incluyendo phpBB2). Para más información lea <a href="../docs/INSTALL.html">la guía de instalación</a>.<br /><br />Para leer la licencia phpBB3 u obtener soporte, seleccione las opciones correspondientes del menú lateral. Para continuar, seleccione la pestaña apropiada arriba.',

    'PCRE_UTF_SUPPORT' => 'Soporte PCRE UTF-8',
    'PCRE_UTF_SUPPORT_EXPLAIN' => 'phpBB <strong>no</strong> funcionará si su instalación de PHP no está compilada con soporte UTF-8 en la extensión PCRE.',
    'PHP_GETIMAGESIZE_SUPPORT' => 'La función PHP getimagesize() está disponible',
    'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN' => '<strong>Requerido</strong> - Para que phpBB funcione correctamente, la función getimagesize debe estar disponible.',
    'PHP_OPTIONAL_MODULE' => 'Módulos opcionales',
    'PHP_OPTIONAL_MODULE_EXPLAIN' => '<strong>Opcional</strong> - Estos módulos o aplicaciones son opcionales. Si están disponibles, habilitan funciones adicionales.',
    'PHP_SUPPORTED_DB' => 'Bases de datos soportadas',
    'PHP_SUPPORTED_DB_EXPLAIN' => '<strong>Requerido</strong> - Debe haber soporte para al menos una base de datos compatible en PHP. Si no aparece ningún módulo de base de datos, contacte a su proveedor de hosting o revise la documentación de PHP.',
    'PHP_REGISTER_GLOBALS' => 'La configuración PHP <var>register_globals</var> está desactivada',
    'PHP_REGISTER_GLOBALS_EXPLAIN' => 'phpBB seguirá funcionando si esta opción está activada, pero se recomienda desactivarla por seguridad si es posible.',
    'PHP_SAFE_MODE' => 'Modo seguro',
    'PHP_SETTINGS' => 'Versión y ajustes de PHP',
    'PHP_SETTINGS_EXPLAIN' => '<strong>Requerido</strong> - Debe ejecutar al menos PHP 7.0 para instalar IntegraMOD. Si se muestra <var>safe mode</var> su instalación PHP está en ese modo, lo que impone limitaciones en administración remota y funciones similares.',
    'PHP_URL_FOPEN_SUPPORT' => 'La configuración PHP <var>allow_url_fopen</var> está habilitada',
    'PHP_URL_FOPEN_SUPPORT_EXPLAIN' => '<strong>Opcional</strong> - Esta opción es opcional, pero ciertas funciones de phpBB como avatares externos no funcionarán correctamente sin ella.',
    'PHP_VERSION_REQD' => 'Versión de PHP >= 7.0',
    'POST_ID' => 'ID del mensaje',
    'PREFIX_FOUND' => 'Un escaneo de sus tablas ha mostrado una instalación válida usando <strong>%s</strong> como prefijo de tabla.',
    'PREPROCESS_STEP' => 'Ejecutando funciones/consultas de preprocesado',
    'PRE_CONVERT_COMPLETE' => 'Todos los pasos previos a la conversión se han completado con éxito. Ahora puede comenzar el proceso de conversión real. Tenga en cuenta que puede necesitar realizar y ajustar varias cosas manualmente. Tras la conversión, verifique especialmente los permisos asignados, reconstruya el índice de búsqueda (no convertido) y asegúrese de que los archivos se copiaron correctamente, por ejemplo avatares y emoticonos.',
    'PROCESS_LAST' => 'Procesando últimas instrucciones',

    'REFRESH_PAGE' => 'Actualice la página para continuar la conversión',
    'REFRESH_PAGE_EXPLAIN' => 'Si se establece en sí, el convertidor refrescará la página para continuar la conversión tras terminar un paso. Si es su primera conversión para pruebas, sugerimos establecerlo en No.',
    'REQUIREMENTS_TITLE' => 'Compatibilidad de instalación',
    'REQUIREMENTS_EXPLAIN' => 'Antes de proceder con la instalación completa, IntegraMOD realizará pruebas en su configuración de servidor y archivos para asegurar que puede instalar y ejecutar IntegraMOD. Lea los resultados y no continúe hasta que todas las pruebas requeridas pasen. Si desea usar funciones que dependen de pruebas opcionales, asegúrese de que también pasan.',
    'RETRY_WRITE' => 'Reintentar escritura de config',
    'RETRY_WRITE_EXPLAIN' => 'Si desea puede cambiar los permisos de config.php para permitir que phpBB escriba en él. Tras hacerlo, pulse Reintentar para probar de nuevo. Recuerde restaurar los permisos después de la instalación.',

    'SCRIPT_PATH' => 'Ruta del script',
    'SCRIPT_PATH_EXPLAIN' => 'La ruta donde está phpBB relativa al nombre de dominio, p. ej. <samp>/phpBB3</samp>.',
    'SELECT_LANG' => 'Seleccionar idioma',
    'SERVER_CONFIG' => 'Configuración del servidor',
    'SEARCH_INDEX_UNCONVERTED' => 'El índice de búsqueda no fue convertido',
    'SEARCH_INDEX_UNCONVERTED_EXPLAIN' => 'Su antiguo índice de búsqueda no fue convertido. La búsqueda devolverá siempre resultado vacío. Para crear un nuevo índice vaya al Panel de Administración → Mantenimiento → Índice de búsqueda.',
    'SOFTWARE' => 'Software del foro',
    'SPECIFY_OPTIONS' => 'Especificar opciones de conversión',
    'STAGE_ADMINISTRATOR' => 'Detalles del administrador',
    'STAGE_ADVANCED' => 'Ajustes avanzados',
    'STAGE_ADVANCED_EXPLAIN' => 'Los ajustes en esta página solo son necesarios si sabe que necesita algo distinto del valor por defecto. Si no está seguro, continúe; estos ajustes se pueden cambiar más tarde desde el Panel de Administración.',
    'STAGE_CONFIG_FILE' => 'Archivo de configuración',
    'STAGE_CREATE_TABLE' => 'Crear tablas de la base de datos',
    'STAGE_CREATE_TABLE_EXPLAIN' => 'Las tablas de base de datos usadas por IntegraMOD3 han sido creadas y pobladas con datos iniciales. Proceda a la siguiente pantalla para finalizar la instalación.',
    'STAGE_DATABASE' => 'Ajustes de la base de datos',
    'STAGE_SN_INSTALL' => 'Instalar Red Social',
    'STAGE_FINAL' => 'Etapa final',
    'STAGE_INTRO' => 'Introducción',
    'STAGE_IN_PROGRESS' => 'Conversión en progreso',
    'STAGE_REQUIREMENTS' => 'Requisitos',
    'STAGE_SETTINGS' => 'Ajustes',
    'STARTING_CONVERT' => 'Iniciando proceso de conversión',
    'STEP_PERCENT_COMPLETED' => 'Paso <strong>%d</strong> de <strong>%d</strong>',
    'SUB_INTRO' => 'Introducción',
    'SUB_LICENSE' => 'Licencia',
    'SUB_SUPPORT' => 'Soporte',
    'SUCCESSFUL_CONNECT' => 'Conexión exitosa',
    'SUPPORT_BODY' => 'Se proporcionará soporte completo para la versión estable actual de IntegraMOD3, gratuitamente. Esto incluye:</p><ul><li>instalación</li><li>configuración</li><li>preguntas técnicas</li><li>problemas relacionados con posibles errores del software</li><li>actualizaciones de Release Candidate (RC) a la versión estable más reciente</li><li>conversión desde phpBB 2.0.x a IntegraMOD3</li><li>conversión desde otro software de foros a IntegraMOD3 (vea el <a href="https://www.phpbb.com/community/viewforum.php?f=65">Foro de Convertidores</a>)</li></ul><p>Animamos a los usuarios que aún ejecutan versiones beta de IntegraMOD3 a reemplazar su instalación por una copia fresca de la última versión.</p><h2>MODs / Estilos</h2><p>Para problemas relacionados con MODs, publique en el <a href="https://integramod.com/forum/viewforum.php?f=84">Foro de Modificaciones</a>.<br />Para problemas con estilos, plantillas e imagesets, publique en el <a href="https://www.phpbb.com/community/viewforum.php?f=80">Foro de Estilos</a>.<br /><br />Si su pregunta está relacionada con un paquete específico, publíquelo en el tema dedicado al paquete.</p><h2>Obtener soporte</h2><p><a href="https://www.phpbb.com/community/viewtopic.php?f=14&amp;t=571070">El paquete de bienvenida phpBB</a><br /><a href="https://www.phpbb.com/support/">Sección de soporte</a><br /><a href="https://www.phpbb.com/support/documentation/3.0/quickstart/">Guía de inicio rápido</a><br /><br />Para mantenerse al día con noticias y lanzamientos, ¿por qué no <a href="https://www.phpbb.com/support/">suscribirse a nuestra lista de correo</a>?<br /><br />',
    'SYNC_FORUMS' => 'Iniciando sincronización de foros',
    'SYNC_POST_COUNT' => 'Sincronizando recuentos de mensajes',
    'SYNC_POST_COUNT_ID' => 'Sincronizando recuentos de mensajes desde <var>entry</var> %1$s a %2$s.',
    'SYNC_TOPICS' => 'Iniciando sincronización de temas',
    'SYNC_TOPIC_ID' => 'Sincronizando temas desde <var>topic_id</var> %1$s a %2$s.',

    'TABLES_MISSING' => 'No se pudieron encontrar estas tablas<br />» <strong>%s</strong>.',
    'TABLE_PREFIX' => 'Prefijo para tablas en la base de datos',
    'TABLE_PREFIX_EXPLAIN' => 'El prefijo debe comenzar con una letra y solo contener letras, números y guiones bajos.',
    'TABLE_PREFIX_SAME' => 'El prefijo de tablas debe ser el usado por el software del que está convirtiendo.<br />» El prefijo especificado fue %s.',
    'TESTS_PASSED' => 'Pruebas superadas',
    'TESTS_FAILED' => 'Pruebas falladas',

    'UNABLE_WRITE_LOCK' => 'No se puede escribir el archivo de bloqueo.',
    'UNAVAILABLE' => 'No disponible',
    'UNWRITABLE' => 'No escribible',
    'UPDATE_TOPICS_POSTED' => 'Generando información de temas publicados',
    'UPDATE_TOPICS_POSTED_ERR' => 'Ocurrió un error al generar la información de temas publicados. Puede reintentar este paso en el ACP después de completar la conversión.',
    'VERIFY_OPTIONS' => 'Verificando opciones de conversión',
    'VERSION' => 'Versión',

    'WELCOME_INSTALL' => 'Bienvenido a la instalación de IntegraMOD',
    'WRITABLE' => 'Escribible',
));

// Updater
$lang = array_merge($lang, array(
    'ALL_FILES_UP_TO_DATE' => 'Todos los archivos están actualizados con la última versión de phpBB. Ahora debería <a href="../ucp.php?mode=login">iniciar sesión en su foro</a> y comprobar que todo funciona correctamente. No olvide borrar, renombrar o mover el directorio de instalación. Por favor envíe información actualizada sobre su servidor y configuración desde el módulo <a href="../ucp.php?mode=login&amp;redirect=adm/index.php%3Fi=send_statistics%26mode=send_statistics">Enviar estadísticas</a> en su ACP.',
    'ARCHIVE_FILE' => 'Archivo fuente dentro del archivo',

    'BACK' => 'Atrás',
    'BINARY_FILE' => 'Archivo binario',
    'BOT' => 'Spider/Robot',

    'CHANGE_CLEAN_NAMES' => 'El método usado para asegurar que un nombre de usuario no sea usado por múltiples usuarios ha cambiado. Hay usuarios con el mismo nombre según el nuevo método. Debe eliminar o renombrar estos usuarios para que cada nombre sea usado por un solo usuario antes de continuar.',
    'CHECK_FILES' => 'Comprobar archivos',
    'CHECK_FILES_AGAIN' => 'Comprobar archivos de nuevo',
    'CHECK_FILES_EXPLAIN' => 'En el siguiente paso todos los archivos serán comprobados contra los archivos de actualización — esto puede tardar si es la primera comprobación.',
    'CHECK_FILES_UP_TO_DATE' => 'Según su base de datos su versión está actualizada. Puede proceder con la comprobación de archivos para asegurarse de que realmente están al día.',
    'CHECK_UPDATE_DATABASE' => 'Continuar proceso de actualización',
    'COLLECTED_INFORMATION' => 'Información de archivos',
    'COLLECTED_INFORMATION_EXPLAIN' => 'La lista abajo muestra información sobre los archivos que necesitan actualización. Lea la información delante de cada bloque de estado para ver lo que significan y lo que debe hacer.',
    'COLLECTING_FILE_DIFFS' => 'Recopilando diferencias de archivos',
    'COMPLETE_LOGIN_TO_BOARD' => 'Ahora debería <a href="../ucp.php?mode=login">iniciar sesión en su foro</a> y comprobar que todo funciona. No olvide eliminar, renombrar o mover el directorio de instalación.',
    'CONTINUE_UPDATE_NOW' => 'Continuar el proceso de actualización ahora',
    'CONTINUE_UPDATE' => 'Continuar actualización ahora',
    'CURRENT_FILE' => 'Inicio del conflicto - Código original del archivo antes de la actualización',
    'CURRENT_VERSION' => 'Versión actual',

    'DATABASE_TYPE' => 'Tipo de base de datos',
    'DATABASE_UPDATE_INFO_OLD' => 'El archivo de actualización de base de datos dentro del directorio install está desactualizado. Asegúrese de haber subido la versión correcta.',
    'DELETE_USER_REMOVE' => 'Eliminar usuario y remover mensajes',
    'DELETE_USER_RETAIN' => 'Eliminar usuario pero conservar mensajes',
    'DESTINATION' => 'Archivo destino',
    'DIFF_INLINE' => 'En línea',
    'DIFF_RAW' => 'Diff unificado crudo',
    'DIFF_SEP_EXPLAIN' => 'Bloque de código usado en el archivo actualizado/nuevo',
    'DIFF_SIDE_BY_SIDE' => 'Lado a lado',
    'DIFF_UNIFIED' => 'Diff unificado',
    'DO_NOT_UPDATE' => 'No actualizar este archivo',
    'DONE' => 'Hecho',
    'DOWNLOAD' => 'Descargar',
    'DOWNLOAD_AS' => 'Descargar como',
    'DOWNLOAD_UPDATE_METHOD_BUTTON' => 'Descargar archivo de archivos modificados (recomendado)',
    'DOWNLOAD_CONFLICTS' => 'Descargar conflictos para este archivo',
    'DOWNLOAD_CONFLICTS_EXPLAIN' => 'Busque &lt;&lt;&lt; para detectar conflictos',
    'DOWNLOAD_UPDATE_METHOD' => 'Descargar archivo de archivos modificados',
    'DOWNLOAD_UPDATE_METHOD_EXPLAIN' => 'Una vez descargado debe descomprimir el archivo. Encontrará los archivos modificados que debe subir a la raíz de phpBB. Súbalos a las ubicaciones respectivas y después vuelva a comprobar los archivos con el botón inferior.',

    'ERROR' => 'Error',
    'EDIT_USERNAME' => 'Editar nombre de usuario',

    'FILE_ALREADY_UP_TO_DATE' => 'El archivo ya está actualizado.',
    'FILE_DIFF_NOT_ALLOWED' => 'Archivo no permitido para diff.',
    'FILE_USED' => 'Información usada desde',			// Single file
    'FILES_CONFLICT' => 'Archivos en conflicto',
    'FILES_CONFLICT_EXPLAIN' => 'Los siguientes archivos están modificados y no representan los archivos originales de la versión antigua. phpBB determinó que estos archivos crean conflictos si se intenta fusionarlos. Investigue los conflictos e intente resolverlos manualmente o continúe la actualización eligiendo el método de fusión preferido. Si resuelve los conflictos manualmente, compruebe los archivos tras modificarlos. También puede elegir el método de fusión preferido para cada archivo. El primero resultará en un archivo donde se perderán las líneas conflictivas de su archivo antiguo; el otro en la pérdida de los cambios del archivo más reciente.',
    'FILES_MODIFIED' => 'Archivos modificados',
    'FILES_MODIFIED_EXPLAIN' => 'Los siguientes archivos están modificados y no representan los originales de la versión antigua. El archivo actualizado será una fusión entre sus modificaciones y el nuevo archivo.',
    'FILES_NEW' => 'Archivos nuevos',
    'FILES_NEW_EXPLAIN' => 'Los siguientes archivos no existen actualmente en su instalación. Estos archivos serán añadidos.',
    'FILES_NEW_CONFLICT' => 'Archivos nuevos en conflicto',
    'FILES_NEW_CONFLICT_EXPLAIN' => 'Los siguientes archivos son nuevos en la última versión pero ya existe un archivo con el mismo nombre en la misma ubicación. Este archivo será sobrescrito por el nuevo.',
    'FILES_NOT_MODIFIED' => 'Archivos no modificados',
    'FILES_NOT_MODIFIED_EXPLAIN' => 'Los siguientes archivos no han sido modificados y representan los archivos originales de phpBB de la versión desde la que desea actualizar.',
    'FILES_UP_TO_DATE' => 'Archivos ya actualizados',
    'FILES_UP_TO_DATE_EXPLAIN' => 'Los siguientes archivos ya están actualizados y no necesitan ser actualizados.',
    'FTP_SETTINGS' => 'Ajustes FTP',
    'FTP_UPDATE_METHOD' => 'Subida FTP',

    'INCOMPATIBLE_UPDATE_FILES' => 'Los archivos de actualización encontrados son incompatibles con su versión instalada. Su versión instalada es %1$s y el archivo de actualización es para actualizar phpBB %2$s a %3$s.',
    'INCOMPLETE_UPDATE_FILES' => 'Los archivos de actualización están incompletos.',
    'INLINE_UPDATE_SUCCESSFUL' => 'La actualización de la base de datos fue exitosa. Ahora debe continuar el proceso de actualización.',

    'KEEP_OLD_NAME' => 'Mantener nombre de usuario',

    'LATEST_VERSION' => 'Última versión',
    'LINE' => 'Línea',
    'LINE_ADDED' => 'Añadida',
    'LINE_MODIFIED' => 'Modificada',
    'LINE_REMOVED' => 'Eliminada',
    'LINE_UNMODIFIED' => 'No modificada',
    'LOGIN_UPDATE_EXPLAIN' => 'Para actualizar su instalación necesita iniciar sesión primero.',

    'MAPPING_FILE_STRUCTURE' => 'Para facilitar la subida estas son las ubicaciones de archivos que mapean su instalación phpBB.',

    'MERGE_MODIFICATIONS_OPTION' => 'Fusionar modificaciones',

    'MERGE_NO_MERGE_NEW_OPTION' => 'No fusionar - usar archivo nuevo',
    'MERGE_NO_MERGE_MOD_OPTION' => 'No fusionar - usar archivo instalado actualmente',
    'MERGE_MOD_FILE_OPTION' => 'Fusionar modificaciones (elimina el código phpBB nuevo dentro del bloque conflictivo)',
    'MERGE_NEW_FILE_OPTION' => 'Fusionar modificaciones (elimina el código modificado dentro del bloque conflictivo)',
    'MERGE_SELECT_ERROR' => 'Los modos de fusión de archivos en conflicto no están correctamente seleccionados.',
    'MERGING_FILES' => 'Fusionando diferencias',
    'MERGING_FILES_EXPLAIN' => 'Recolectando actualmente los cambios finales de archivos.<br /><br />Por favor espere hasta que phpBB haya completado todas las operaciones en los archivos modificados.',

    'NEW_FILE' => 'Fin del conflicto',
    'NEW_USERNAME' => 'Nuevo nombre de usuario',
    'NO_AUTH_UPDATE' => 'No autorizado para actualizar',
    'NO_ERRORS' => 'Sin errores',
    'NO_UPDATE_FILES' => 'No se actualizarán los siguientes archivos',
    'NO_UPDATE_FILES_EXPLAIN' => 'Los siguientes archivos son nuevos o modificados pero no se encontró el directorio donde normalmente residen en su instalación. Si esta lista contiene archivos fuera de language/ o styles/ puede haber modificado su estructura de directorios y la actualización puede estar incompleta.',
    'NO_UPDATE_FILES_OUTDATED' => 'No se encontró un directorio de actualización válido, asegúrese de haber subido los archivos relevantes.<br /><br />Su instalación <strong>no</strong> parece estar al día. Hay actualizaciones disponibles para su versión de phpBB %1$s; visite <a href="https://www.phpbb.com/downloads/" rel="external">https://www.phpbb.com/downloads/</a> para obtener el paquete correcto para actualizar de la Versión %2$s a la %3$s.',
    'NO_UPDATE_FILES_UP_TO_DATE' => 'Su versión está al día. No es necesario ejecutar la herramienta de actualización. Si desea comprobar la integridad de sus archivos asegúrese de haber subido los archivos de actualización correctos.',
    'NO_UPDATE_INFO' => 'No se pudo encontrar información del archivo de actualización.',
    'NO_UPDATES_REQUIRED' => 'No se requieren actualizaciones',
    'NO_VISIBLE_CHANGES' => 'No hay cambios visibles',
    'NOTICE' => 'Aviso',
    'NUM_CONFLICTS' => 'Número de conflictos',
    'NUMBER_OF_FILES_COLLECTED' => 'Actualmente se han comprobado diferencias de %1$d de %2$d archivos.<br />Por favor espere hasta que se comprueben todos los archivos.',

    'OLD_UPDATE_FILES' => 'Los archivos de actualización están desactualizados. Los archivos encontrados son para actualizar de phpBB %1$s a %2$s pero la última versión es %3$s.',

    'PACKAGE_UPDATES_TO' => 'El paquete actualiza a la versión',
    'PERFORM_DATABASE_UPDATE' => 'Realizar actualización de base de datos',
    'PERFORM_DATABASE_UPDATE_EXPLAIN' => 'Abajo encontrará un botón al script de actualización de base de datos. La actualización puede tardar, no detenga la ejecución. Después de la actualización siga las instrucciones para continuar el proceso.',
    'PREVIOUS_VERSION' => 'Versión previa',
    'PROGRESS' => 'Progreso',

    'RESULT' => 'Resultado',
    'RUN_DATABASE_SCRIPT' => 'Actualizar mi base de datos ahora',

    'SELECT_DIFF_MODE' => 'Seleccionar modo diff',
    'SELECT_DOWNLOAD_FORMAT' => 'Seleccionar formato de archivo para descargar',
    'SELECT_FTP_SETTINGS' => 'Seleccionar ajustes FTP',
    'SHOW_DIFF_CONFLICT' => 'Mostrar diferencias/conflictos',
    'SHOW_DIFF_FINAL' => 'Mostrar archivo resultante',
    'SHOW_DIFF_MODIFIED' => 'Mostrar diferencias fusionadas',
    'SHOW_DIFF_NEW' => 'Mostrar contenido del archivo',
    'SHOW_DIFF_NEW_CONFLICT' => 'Mostrar diferencias',
    'SHOW_DIFF_NOT_MODIFIED' => 'Mostrar diferencias',
    'SOME_QUERIES_FAILED' => 'Algunas consultas fallaron; las sentencias y errores se listan abajo.',
    'SQL' => 'SQL',
    'SQL_FAILURE_EXPLAIN' => 'Probablemente no sea grave, la actualización continuará. Si falla totalmente, puede necesitar ayuda en nuestros foros. Consulte <a href="../docs/README.html">README</a> para detalles de cómo obtener asistencia.',
    'STAGE_FILE_CHECK' => 'Comprobar archivos',
    'STAGE_UPDATE_DB' => 'Actualizar base de datos',
    'STAGE_UPDATE_FILES' => 'Actualizar archivos',
    'STAGE_VERSION_CHECK' => 'Comprobación de versión',
    'STATUS_CONFLICT' => 'Archivo modificado que produce conflictos',
    'STATUS_MODIFIED' => 'Archivo modificado',
    'STATUS_NEW' => 'Archivo nuevo',
    'STATUS_NEW_CONFLICT' => 'Archivo nuevo en conflicto',
    'STATUS_NOT_MODIFIED' => 'Archivo no modificado',
    'STATUS_UP_TO_DATE' => 'Archivo ya actualizado',

    'TOGGLE_DISPLAY' => 'Ver/Ocultar lista de archivos',
    'TRY_DOWNLOAD_METHOD' => 'Puede intentar el método de descargar los archivos modificados.<br />Este método siempre funciona y es el recomendado.',
    'TRY_DOWNLOAD_METHOD_BUTTON' => 'Probar este método ahora',

    'UPDATE_COMPLETED' => 'Actualización completada',
    'UPDATE_DATABASE' => 'Actualizar base de datos',
    'UPDATE_DATABASE_EXPLAIN' => 'En el siguiente paso la base de datos será actualizada.',
    'UPDATE_DATABASE_SCHEMA' => 'Actualizando el esquema de la base de datos',
    'UPDATE_FILES' => 'Actualizar archivos',
    'UPDATE_FILES_NOTICE' => 'Asegúrese de haber actualizado también los archivos del foro; este archivo sólo actualiza la base de datos.',
    'UPDATE_INSTALLATION' => 'Actualizar instalación phpBB',
    'UPDATE_INSTALLATION_EXPLAIN' => 'Con esta opción puede actualizar su instalación phpBB a la última versión.<br />Durante el proceso todos sus archivos serán verificados para integridad. Puede revisar todas las diferencias y archivos antes de la actualización.<br /><br />La actualización de archivos se puede hacer de dos maneras.</p><h2>Actualización manual</h2><p>Con esta actualización descargará su conjunto personalizado de archivos cambiados para asegurarse de no perder sus modificaciones. Tras descargar el paquete deberá subir manualmente los archivos a su ubicación correcta bajo la raíz de phpBB. Una vez hecho, podrá volver a la etapa de comprobación de archivos para verificar su ubicación.</p><h2>Actualización automática con FTP</h2><p>Este método es similar al primero pero sin necesidad de descargar y subir los archivos usted mismo. Esto se hará por usted. Para usar esta opción necesita conocer sus credenciales FTP. Una vez finalizado será redirigido a la comprobación de archivos para asegurarse de que todo se actualizó correctamente.<br /><br />',
    'UPDATE_INSTRUCTIONS' => '

		<h1>Anuncio de la versión</h1>

		<p>Por favor lea <a href="%1$s" title="%1$s"><strong>el anuncio de la última versión</strong></a> antes de continuar con la actualización; puede contener información útil y enlaces de descarga así como el registro de cambios.</p>

		<br />

		<h1>Cómo actualizar su instalación con el Automatic Update Package</h1>

		<p>La forma recomendada de actualizar que se indica aquí es válida sólo para el paquete de actualización automática. También puede actualizar usando los métodos listados en INSTALL.html. Los pasos son:</p>

		<ul style="margin-left: 20px; font-size: 1.1em;">
			<li>Vaya a la página de descargas <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">phpBB.com</a> y descargue el archivo "Automatic Update Package".<br /><br /></li>
			<li>Descomprima el archivo.<br /><br /></li>
			<li>Suba la carpeta install completa y descomprimida al directorio raíz de phpBB (donde está config.php).<br /><br /></li>
		</ul>

		<p>Una vez subido, su foro estará fuera de línea para usuarios normales debido al directorio install presente.<br /><br />
		<strong><a href="%2$s" title="%2$s">Ahora inicie el proceso de actualización apuntando su navegador al directorio install</a>.</strong><br />
		<br />
		Se le guiará a través del proceso de actualización y se le notificará cuando se complete.
		</p>
	',
    'UPDATE_INSTRUCTIONS_INCOMPLETE' => '

		<h1>Actualización incompleta detectada</h1>

		<p>phpBB detectó una actualización automática incompleta. Asegúrese de haber seguido cada paso de la herramienta de actualización automática. Abajo encontrará el enlace o vaya directamente a su directorio install.</p>
	',
    'UPDATE_METHOD' => 'Método de actualización',
    'UPDATE_METHOD_EXPLAIN' => 'Ahora puede elegir su método de actualización preferido. Usar la subida FTP mostrará un formulario para introducir sus datos FTP. Con este método los archivos se moverán automáticamente y se crearán copias de seguridad de los antiguos archivos añadiendo .bak al nombre. Si elige descargar los archivos modificados podrá descomprimirlos y subirlos manualmente después.',
    'UPDATE_REQUIRES_FILE' => 'El actualizador requiere que el siguiente archivo esté presente: %s',
    'UPDATE_SUCCESS' => 'Actualización realizada con éxito',
    'UPDATE_SUCCESS_EXPLAIN' => 'Todos los archivos se actualizaron correctamente. El siguiente paso es comprobar de nuevo todos los archivos para asegurarse de que se actualizaron correctamente.',
    'UPDATE_VERSION_OPTIMIZE' => 'Actualizando versión y optimizando tablas',
    'UPDATING_DATA' => 'Actualizando datos',
    'UPDATING_TO_LATEST_STABLE' => 'Actualizando la base de datos a la última versión estable',
    'UPDATED_VERSION' => 'Versión actualizada',
    'UPGRADE_INSTRUCTIONS' => 'Una nueva versión <strong>%1$s</strong> está disponible. Por favor lea <a href="%2$s" title="%2$s"><strong>el anuncio de la versión</strong></a> para conocer las novedades y cómo actualizar.',
    'UPLOAD_METHOD' => 'Método de subida',

    'UPDATE_DB_SUCCESS' => 'La actualización de la base de datos fue exitosa.',
    'USER_ACTIVE' => 'Usuario activo',
    'USER_INACTIVE' => 'Usuario inactivo',

    'VERSION_CHECK' => 'Comprobación de versión',
    'VERSION_CHECK_EXPLAIN' => 'Comprueba si su instalación phpBB está actualizada.',
    'VERSION_NOT_UP_TO_DATE' => 'Su instalación phpBB no está actualizada. Por favor continúe con el proceso de actualización.',
    'VERSION_NOT_UP_TO_DATE_ACP' => 'Su instalación phpBB no está actualizada.<br />Abajo hay un enlace al anuncio de la versión con más información y las instrucciones de actualización.',
    'VERSION_NOT_UP_TO_DATE_TITLE' => 'Su instalación phpBB no está actualizada.',
    'VERSION_UP_TO_DATE' => 'Su instalación phpBB está actualizada. Aunque no hay actualizaciones disponibles, puede continuar para realizar una comprobación de validez de archivos.',
    'VERSION_UP_TO_DATE_ACP' => 'Su instalación phpBB está actualizada. No hay actualizaciones disponibles en este momento.',
    'VIEWING_FILE_CONTENTS' => 'Viendo contenido del archivo',
    'VIEWING_FILE_DIFF' => 'Viendo diferencias de archivo',

    'WRONG_INFO_FILE_FORMAT' => 'Formato de archivo info incorrecto',
));

// Default database schema entries...
$lang = array_merge($lang, array(
    'CONFIG_BOARD_EMAIL_SIG' => 'Gracias, La Administración',
    'CONFIG_SITE_DESC' => 'Un texto corto para describir su foro',
    'CONFIG_SITENAME' => 'sudominio.com',

    'DEFAULT_INSTALL_POST' => 'Este es un mensaje de ejemplo en su instalación de IntegraMOD. Todo parece funcionar. Puede eliminar este mensaje si lo desea y continuar configurando su foro. Durante la instalación su primera categoría y su primer foro se asignan con un conjunto apropiado de permisos para los grupos predefinidos administradores, bots, moderadores globales, invitados, usuarios registrados y usuarios COPPA registrados. Si también elige eliminar su primera categoría y su primer foro, no olvide asignar permisos para todos estos grupos en todas las nuevas categorías y foros que cree. Se recomienda renombrar su primera categoría y su primer foro y copiar permisos desde éstos al crear nuevas categorías y foros. ¡Diviértase!',

    'FORUMS_FIRST_CATEGORY' => 'Su primera categoría',
    'FORUMS_TEST_FORUM_DESC' => 'Descripción de su primer foro.',
    'FORUMS_TEST_FORUM_TITLE' => 'Su primer foro',

    'RANKS_SITE_ADMIN_TITLE' => 'Administrador del sitio',
    'REPORT_WAREZ' => 'El mensaje contiene enlaces a software ilegal o pirateado.',
    'REPORT_SPAM' => 'El mensaje reportado tiene como único propósito publicitar un sitio web u otro producto.',
    'REPORT_OFF_TOPIC' => 'El mensaje reportado está fuera de tema.',
    'REPORT_OTHER' => 'El mensaje reportado no encaja en ninguna otra categoría, por favor use el campo de información adicional.',

    'SMILIES_ARROW' => 'Flecha',
    'SMILIES_CONFUSED' => 'Confundido',
    'SMILIES_COOL' => 'Cool',
    'SMILIES_CRYING' => 'Llorando o muy triste',
    'SMILIES_EMARRASSED' => 'Avergonzado',
    'SMILIES_EVIL' => 'Malvado o muy enfadado',
    'SMILIES_EXCLAMATION' => 'Exclamación',
    'SMILIES_GEEK' => 'Geek',
    'SMILIES_IDEA' => 'Idea',
    'SMILIES_LAUGHING' => 'Riendo',
    'SMILIES_MAD' => 'Enfadado',
    'SMILIES_MR_GREEN' => 'Sr. Verde',
    'SMILIES_NEUTRAL' => 'Neutral',
    'SMILIES_QUESTION' => 'Pregunta',
    'SMILIES_RAZZ' => 'Razz',
    'SMILIES_ROLLING_EYES' => 'Ojos en blanco',
    'SMILIES_SAD' => 'Triste',
    'SMILIES_SHOCKED' => 'Sorprendido',
    'SMILIES_SMILE' => 'Sonrisa',
    'SMILIES_SURPRISED' => 'Sorprendido',
    'SMILIES_TWISTED_EVIL' => 'Malvado retorcido',
    'SMILIES_UBER_GEEK' => 'Súper Geek',
    'SMILIES_VERY_HAPPY' => 'Muy feliz',
    'SMILIES_WINK' => 'Guiño',

    'TOPICS_TOPIC_TITLE' => 'Bienvenido a IntegraMOD',
));