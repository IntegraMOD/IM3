<?php
/**
*
* @package Kiss Portal Engine (acp_k_tools) (English)
*
* @package language
* @version $Id:$ 1.0.19
* @copyright (c) 2005-2011 Michael O'Toole (mike@phpbbireland.com)
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

	'ALL_USERS_RESET'	=> 'Reset login attempts for all users',
	'REPORT'			=> 'Resetting login attempt for all users...',
	'REPORT_ONE'		=> 'Resetting login attempt for: %s',
	'TITLE' 			=> 'Portal Tools',
	'TITLE_EXPLAIN'		=> 'Miscellaneous portal tools.',
	'TOOL_OPTIONS'		=> 'Available options',
	'USER_RESET'		=> 'Reset login attempts for user (users name)',
));

?>