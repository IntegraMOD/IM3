<?php
/**
*
* viewforum [Dutch]
*
* @package language
* @copyright (c) 2005 phpBB Group
* @copyright (c) 2007 phpBB.nl
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	'ACTIVE_TOPICS'			=> 'Actieve onderwerpen',
	'ANNOUNCEMENTS'			=> 'Mededelingen',

	'FORUM_PERMISSIONS'		=> 'Forumpermissies',

	'ICON_ANNOUNCEMENT'		=> 'Mededeling',
	'ICON_STICKY'			=> 'Sticky',

	'LOGIN_NOTIFY_FORUM'	=> 'Je bent op de hoogte gebracht van dit forum, log in om het te openen.',

	'MARK_TOPICS_READ'		=> 'Markeer onderwerpen als gelezen',

	'NEW_POSTS_HOT'			=> 'Nieuwe berichten [ populair ]',	// Not used anymore
	'NEW_POSTS_LOCKED'		=> 'Nieuwe berichten [ gesloten ]',	// Not used anymore
	'NO_NEW_POSTS_HOT'		=> 'Geen nieuwe berichten [ populair ]',	// Not used anymore
	'NO_NEW_POSTS_LOCKED'	=> 'Geen nieuwe berichten [ gesloten ]',	// Not used anymore
	'NO_READ_ACCESS'		=> 'Je mag de berichten in dit forum niet lezen.',
	'NO_UNREAD_POSTS_HOT'		=> 'Geen nieuwe berichten [ populair ]',
	'NO_UNREAD_POSTS_LOCKED'	=> 'Geen nieuwe berichten [ gesloten ]',

	'POST_FORUM_LOCKED'		=> 'Het forum is gesloten.',

	'TOPICS_MARKED'			=> 'De onderwerpen in dit forum zijn als gelezen gemarkeerd.',

	'UNREAD_POSTS_HOT'			=> 'Nieuwe berichten [ populair ]',
	'UNREAD_POSTS_LOCKED'		=> 'Nieuwe berichten [ gesloten ]',

	'VIEW_FORUM'			=> 'Toon forum',
	'VIEW_FORUM_TOPIC'		=> '1 onderwerp',
	'VIEW_FORUM_TOPICS'		=> '%d onderwerpen',
	'WHO_POSTED'	        => 'Wie heeft hier gepost?',
));

