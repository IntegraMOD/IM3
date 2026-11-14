<?php
/**
*
* Moderator action undo [English]
*
* @package language
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_MOD_UNDO'						=> 'Moderator undo',
	'ACP_MOD_UNDO_LIST'					=> 'Moderator actions',
	'ACP_MOD_UNDO_LIST_EXPLAIN'			=> 'Actions made by moderators: deletions, edits, moves, splits, merges, locks, poster changes, bans and warnings. Restoring returns the content to the state before the action. When reverting several actions they are undone newest first.',
	'ACP_MOD_UNDO_SETTINGS'				=> 'Moderator undo settings',
	'ACP_MOD_UNDO_SETTINGS_EXPLAIN'		=> 'Keep a record of moderator actions so an administrator can undo them.',

	'MOD_UNDO_ENABLE'					=> 'Record moderator actions',
	'MOD_UNDO_ENABLE_EXPLAIN'			=> 'Deletions, edits of other users’ posts, moves, splits, merges, locks, poster changes, bans and warnings are recorded so they can be undone.',
	'MOD_UNDO_ADMINS'					=> 'Also record administrators',
	'MOD_UNDO_ADMINS_EXPLAIN'			=> 'Record actions by users with any administrator permission as well. Protects against a hijacked administrator account.',
	'MOD_UNDO_DAYS'						=> 'Keep records for',
	'MOD_UNDO_DAYS_EXPLAIN'				=> 'Records older than this are removed together with their saved attachment files. 0 keeps them forever.',

	'MOD_UNDO_ACTION_DELETE_POST'		=> 'Deleted post(s)',
	'MOD_UNDO_ACTION_DELETE_TOPIC'		=> 'Deleted topic(s)',
	'MOD_UNDO_ACTION_EDIT'				=> 'Edited post',
	'MOD_UNDO_ACTION_LOCK'				=> 'Locked topic(s)',
	'MOD_UNDO_ACTION_UNLOCK'			=> 'Unlocked topic(s)',
	'MOD_UNDO_ACTION_LOCK_POST'			=> 'Locked post(s)',
	'MOD_UNDO_ACTION_UNLOCK_POST'		=> 'Unlocked post(s)',
	'MOD_UNDO_ACTION_MOVE'				=> 'Moved topic(s)',
	'MOD_UNDO_ACTION_SPLIT'				=> 'Split topic',
	'MOD_UNDO_ACTION_MERGE'				=> 'Merged posts/topics',
	'MOD_UNDO_ACTION_CHANGE_POSTER'		=> 'Changed poster',
	'MOD_UNDO_ACTION_BAN'				=> 'Ban',
	'MOD_UNDO_ACTION_UNBAN'				=> 'Unban',
	'MOD_UNDO_ACTION_WARNING'			=> 'Warning',

	'MOD_UNDO_MODERATOR'				=> 'Moderator',
	'MOD_UNDO_SUMMARY'					=> 'Content',
	'MOD_UNDO_STATUS'					=> 'Status',
	'MOD_UNDO_PENDING'					=> 'Can be restored',
	'MOD_UNDO_RESTORED_ON'				=> 'Restored',
	'MOD_UNDO_ALL'						=> 'All',
	'MOD_UNDO_FILTER_USER'				=> 'Moderator username',
	'MOD_UNDO_VIEW'						=> 'View',
	'MOD_UNDO_DISABLED'					=> 'Recording is currently disabled. Existing records can still be restored.',
	'MOD_UNDO_NO_ENTRIES'				=> 'No recorded moderator actions.',

	'MOD_UNDO_RESTORE_MARKED'			=> 'Restore marked',
	'MOD_UNDO_REVERT_USER'				=> 'Revert all actions of a moderator',
	'MOD_UNDO_REVERT_USER_EXPLAIN'		=> 'Restores every pending action of this moderator within the chosen number of days, newest first. Use this when an account was hijacked.',
	'MOD_UNDO_REVERT_DAYS'				=> 'Days back',
	'MOD_UNDO_REVERT'					=> 'Revert',

	'MOD_UNDO_RESTORED'					=> '%d action(s) restored.',
	'MOD_UNDO_ERRORS'					=> 'These actions could not be restored:',
	'MOD_UNDO_NOTHING_MARKED'			=> 'No actions were marked.',
	'MOD_UNDO_NOTHING_FOUND'			=> 'No pending actions were found for this moderator in that period.',
	'MOD_UNDO_NO_USER'					=> 'Enter an existing username and a number of days.',
	'MOD_UNDO_NOT_FOUND'				=> 'The record no longer exists.',
	'MOD_UNDO_ALREADY'					=> 'This action was already restored.',
	'MOD_UNDO_BAD_DATA'					=> 'The saved data is unreadable.',
	'MOD_UNDO_FORUM_GONE'				=> 'A forum this content belonged to no longer exists.',
	'MOD_UNDO_TOPIC_GONE'				=> 'A topic this content belonged to no longer exists and was not part of this record.',
	'MOD_UNDO_POST_GONE'				=> 'The post no longer exists.',
	'MOD_UNDO_STATE_CHANGED'			=> 'The content was changed again after this action; undo the newer action first.',

	'LOG_MOD_UNDO_RESTORE'				=> '<strong>Restored moderator action</strong><br />» %1$s: %2$s',
));
