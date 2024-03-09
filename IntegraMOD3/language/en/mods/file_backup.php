<?php
/**
*
* acp_file_backup [English]
*
* @package language
* @version $Id: file_backup.php,v 1.00 2008/02/22 livewirestu Exp $
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

// Database Backup/Restore
$lang = array_merge($lang, array(
    'ACP_FILE_BACKUP_EXPLAIN'    => 'Here you can backup all your phpBB related files. You may store the resulting archive in your <samp>file_store/</samp> folder or download it directly. The resulting archive will be stored in .zip format. <br /><strong>Notes:</strong><br />&bull;Depending on your hosting provider, you may not be able to back up all your files into a single archive. The hosting provider may impose limits on processor usage allocation, resulting in the archive operation failing part way through. In this case, divide your backup into sections.<br />&bull;It may take a while to back up your files, depending on the size of the files selected for backup. Please be patient.<br />&bull;For security reasons, your config.php file will be excluded from the resultant archive.',
	
	'BACKUP_DELETE'		=> 'The backup file has been deleted successfully.',
	'BACKUP_INVALID'	=> 'The selected file to backup is invalid.',
	'BACKUP_OPTIONS'	=> 'Backup options',
	'BACKUP_SUCCESS'	=> 'The backup file has been created successfully.',
	'BACKUP_TYPE'		=> 'Backup type',

	'DELETE_BACKUP'		=> 'Delete backup',
	'DELETE_SELECTED_BACKUP'	=> 'Are you sure you want to delete the selected backup?',
	'DESELECT_ALL'		=> 'Deselect all',
	'DOWNLOAD_BACKUP'	=> 'Download backup',

	'FILE_TYPE'			=> 'File type',
	'FULL_BACKUP'		=> 'Full',
    
    'FILE_BACKUP_SUCCESS' => 'File backup successful',
    'FILE_BACKUP_FAILURE' => 'File backup failed',
    'FILE_DOWNLOAD_FAILURE' => 'File can not be downloaded',

	'RESTORE_FAILURE'		=> 'The backup file may be corrupt.',
	'RESTORE_OPTIONS'		=> 'Restore options',
	'RESTORE_SUCCESS'		=> 'Files have been successfully restored.<br /><br />Your board should be back to the state it was when the backup was made.',

	'SELECT_ALL'			=> 'Select all',
	'SELECT_FILE'			=> 'Select a file',
	'START_BACKUP'			=> 'Start backup',
	'START_RESTORE'			=> 'Start restore',
	'STORE_AND_DOWNLOAD'	=> 'Store and download',
	'STORE_LOCAL'			=> 'Store file locally',

	'FILE_SELECT'			=> 'File select',
	'FILE_SELECT_ERROR'		=> 'You must select at least one file.',
));

