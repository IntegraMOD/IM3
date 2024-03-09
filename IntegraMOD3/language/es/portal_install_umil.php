<?php
/**
*
* @package install
* @version $Id: portal_install.php 1.0.19
* @copyright (c) 2005 phpbBB Group
* @copyright (c) 2005 phpbireland
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


$lang = array_merge($lang, array(

	'KISS_PORTAL_ENGINE' 		=> 'Kiss Portal Engine',
	'STARGATE_PORTAL_EXPLAIN' 	=> 'Versión simplificada de Stargate Portalpara phpBB3 con una serie de características básicas todos los cuales se pueden configurar a través de la ACP.',

	'NONE'				=> 'No se ha instalado',
	'INSTALL_PANEL'		=> 'Stargate Portal Panel de instalación',
	'SUB_INTRO'			=> 'introducción',
	'OVERVIEW_BODY'		=> '<p><strong>This code is a rework of the phpBB install code &copy; phpBB 2000, 2002, 2005, 2007 phpBB Group, to facilitate the Stargate Portal installation...</strong></p><hr /><br /><strong>Welcome to our pre-test release of Stargate Portal  RC1 (Prometheus Edition) <img src="./../portal/portal_install.png" alt="" border="none"></strong><br /><br />If you are <b>upgrading</b>, please run the remove_portal.php script before continuing... (See portal/Read_Me_First.txt)<br /><br />This release is intended for wider scale use to help us identifying last bugs and problematic areas.<br />Please read <a href="../portal/docs/install.html"><b>our installation guide</b></a> for more information about installing Stargate Portal.</p><p><strong style="text-transform: uppercase;"><br />Note:</strong> This release is <strong style="text-transform: uppercase;">a beta product</strong>. You may want to wait for the full final release before running it live.</p><p>This installation system will guide you through the process of installing the portal and updating to the latest version.<br />For more information on each option, select it from the menu above.<br />',
	'SELECT_LANG'		=> 'Seleccionar idioma',
	'SUPPORT_BODY'		=> 'Durante el pleno apoyo de fase beta se le dará al <a href="http://www.phpbbireland.com/phpBB3/">phpbbireland</a>. 
	Vamos a proporcionar respuestas a preguntas generales de configuración, problemas de configuración, problemas de conversión y el apoyo a la determinación de los problemas comunes en su mayoría relacionados con errores. También permitimos que las discusiones acerca de las modificaciones y adiciones código personalizado / estilo.</p><p>For further assistance with the Stargate Portal contact <a href="http://www.phpbbireland.com/phpBB3/"> phpbbireland development site.</a></p><p>For assistance with phpBB, please refer to the <a href="http://www.phpbb.com/support/documentation/3.0/quickstart/">Quick Start Guide</a> and <a href="http://www.phpbb.com/support/documentation/3.0/">the online documentation</a>.</p><p>To ensure you stay up to date please visit the <a href="http://www.phpbbireland.com/portal/">dev site</a> or subscribe to our <a href="http://www.phpbbireland.com/support/">mailing list</a>...',
	'SUB_SUPPORT'		=> 'apoyo',
	'REPORT_INSTALLED'	=> 'El portal en ya instalado',
	'INSTALL_INTRO'		=> 'Bienvenido a la instalación de Stargate Portal <img src="./../portal/portal_install.png" alt="" border="none">',


	'VERSION_NOT_UP_TO_DATE'	=> 'Su versión del portal no está actualizado. Por favor, continúe el proceso de actualización.',
	'VERSION_NOT_UP_TO_DATE'	=> 'No se puede recuperar la versión info ... código no escrito.',
	'VERSION_CHECK'				=> 'comprobación de la versión',
	'VERSION_CHECK_EXPLAIN'		=> 'Comprueba si la versión del portal que está ejecutando actualmente está al día.',
	'CURRENT_VERSION'			=> 'La versión actual',
	'LATEST_VERSION'			=> 'Última versión',

));

