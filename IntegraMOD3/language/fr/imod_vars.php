<?php
/**
*
* acp_imod_vars [English] (Additional variables used by portal)
*
* @package language
* @version $Id: imod_vars.php 297 2008-12-30 18:40:30Z Michaelo $
* @copyright (c) 2006 phpbbireland Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(

	'TITLE_MAIN' => 'General Portal Variable',
	'TITLE_BLOCK' => 'Portal Block Variable',

));

// Portal Menu Names + add you menu language variables here! //
$lang = array_merge($lang, array(
	'ACP'					=> 'Admin CP',
	'ALBUM'					=> 'Album',
	'BOOKMARKS'				=> 'Bookmarks',
	'CATEGORIES'			=> 'Categories',
	'SGP_Blog'				=> 'SGP Integrated Blog',
	'DOWNLOADS'				=> 'Downloads',
	'FORUM'					=> 'Forum',
	'KB'					=> 'Knowledge Base',
	'LINKS'					=> 'Links',
	'MEMBERS'				=> 'Members',
	'PORTAL'				=> 'Portal',
	'RATINGS'				=> 'Latest Ratings',
	'RULES'					=> 'Portal Rules',
	'SITE_NAVIGATOR'		=> 'Navigator',
	'STATISTICS'			=> 'Statistics',
	'SITE_RULES'			=> 'Site Rules',
	'SITE_STATISTICS'		=> 'Site Statistics',
	'STAFF'					=> 'Staff',
	'STYLES_DEMO'			=> 'Styles Demo',
	'STYLE_SELECT'			=> 'Style Select',
	'UCP'					=> 'User CP',
	'UNRESOLVED/BUGS'		=> 'Unresolved/Bugs',
	'UPLOAD'				=> 'Upload Images',
	'USER_INFORMATION'		=> 'User Information',
	'WELCOME'				=> 'Welcome',
));

// Portal Block Names + add your block name language variables here! //
$lang = array_merge($lang, array(
	'ACP_SMALL'			=> 'Admin CP',
	'ANNOUNCEMENTS'		=> 'Announcements',
	'BIRTHDAY'			=> 'Birthday',
	'BLOG'				=> 'SGP Integrated Blog',
));


