<?php
/**
*
* common [English]
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

//
// If the portal is disabled we load this file to handle left over lang vars
//

$lang = array_merge($lang, array(
	'BLOCKS_DISABLED'         	=> 'Bloques del Portal están deshabilitados actualmente!',
	'ANNOUNCEMENTS_AND_NEWS'  	=> 'Noticias y Anuncios',
	'POST_NEWS'				 	=> 'noticias',
	'POST_NEWS_GLOBAL'		 	=> 'Noticias Globales',
	'POST_NEW_IMG'			 	=> 'Publicar nuevo',
	'POST_NEW_HOT_IMG'		 	=> 'Publicar nuevo caliente',
	'VIEW_TOPIC_NEWS'		 	=> 'Noticias: ',
));

?>