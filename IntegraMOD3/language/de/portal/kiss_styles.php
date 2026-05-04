<?php
/**
*
* styles [Deutsch]
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

$lang = array_merge($lang, array(

	'IMG_NEWS_READ'					=> 'Neuigkeiten',
	'IMG_NEWS_READ_MINE'			=> 'Neuigkeiten (zugeordnet)',
	'IMG_NEWS_READ_LOCKED'			=> 'Neuigkeiten (gesperrt)',
	'IMG_NEWS_READ_LOCKED_MINE'		=> 'Neuigkeiten (gesperrt, zugeordnet)',
	'IMG_NEWS_UNREAD'				=> 'Neuigkeiten (neue Beiträge)',
	'IMG_NEWS_UNREAD_MINE'			=> 'Neuigkeiten (neue Beiträge, zugeordnet)',
	'IMG_NEWS_UNREAD_LOCKED'		=> 'Neuigkeiten (gesperrt, neue Beiträge)',
	'IMG_NEWS_UNREAD_LOCKED_MINE'	=> 'Neuigkeiten (gesperrt, neue Beiträge, zugeordnet)',

));

