<?php
/** 
*
* acp_modsdb [English]
*
* @package language
* @version $Id:modsdb.php,v 1.0 2007/08/20 lefty74 Exp $
* @copyright (c) 2007 lefty74 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
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

// Bot settings
$lang = array_merge($lang, array(
	'MODS_DATABASE_DETAIL'		=> 'Mods Database - Mod Detail',
	'MODS_DATABASE'				=> 'Mods Database',
	'MODS_DATABASE_EXPLAIN'		=> 'You can maintain your Mods Database here. Add, Edit or Delete Mods to and from the database.',

	'MOD_ADD'			=> 'Add Mod',
	'MOD_ADDED'			=> 'New Mod successfully added.',
	'MOD_DELETED'		=> 'Mod successfully deleted.',
	'MOD_DETAIL'		=> 'Mod Details',
	'MOD_EDIT'			=> 'Edit Mods',
	'MOD_EDIT_EXPLAIN'	=> 'Here you can add or edit an existing Mod entry. The Title and version number are required. You will also be able to enter details of where the Mod can be downloaded from and where the Mod itself can be found.',
	'BOT_NAME'			=> 'Bot name',
	'BOT_NAME_EXPLAIN'	=> 'Used only for your own information.',
	'MOD_NAME_TAKEN'	=> 'The Title is already in use in the Mods Database and can’t be used again.',
	'MOD_UPDATED'		=> 'Existing Mod updated successfully.',

	'ERR_MOD_NO_MATCHES'		=> 'You must supply at least the Mod Title and Mod Version for this Mod entry.',

	'NO_MOD'					=> 'Found no Mod with the specified ID.',

	'MOD_INSTALL_DATE'			=>	'Mod Installation Date',
	'MOD_TITLE'					=>	'Mod Title',
	'MOD_COMMENTS'				=>	'Comments',
	'MOD_PHPBB_VERSION'			=>	'phpbb Version',
	'MOD_VERSION'				=>	'Version',
	'MOD_VERSION_TYPE'			=>	'Version Type',
	'MOD_VERSION_TYPE_EXPLAIN'	=>	'Beta, Alpha, Dev or RC*',
	'MOD_DESC'					=>	'Description',
	'MOD_AUTHOR'				=>	'Author',
	'MOD_URL'					=>	'Location',
	'VISIT_WEBSITE'				=>	'URL Link where Mod is published',
	'DOWNLOAD_MOD'				=>	'URL Link where Mod can be downloaded',
	'LIST_MOD'					=>  '1 Mod installed',
	'LIST_MODS'					=>  '%s Mods installed',
	'SORT_MOD_TITLE'			=>  'SORT_MOD_TITLE',
	'SORT_MOD_VERSION'			=>  'SORT_MOD_VERSION',
	'SORT_MOD_VERSION'			=>  'SORT_MOD_VERSION',
	'SORT_MOD_AUTHOR'			=>  'SORT_MOD_AUTHOR',
	'WWW'						=>  'Website',
	'DOWNLOAD'					=>  'Download',
	
));

