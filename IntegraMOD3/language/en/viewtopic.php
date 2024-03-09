<?php
/**
*
* viewtopic [English]
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
	// ajaxlike
	// 																		examples:
	'AL_YOU_TEXT'						=> 'You',						// `You` like this post.
	'AL_AND_TEXT'						=> 'and',						// userX `and` y like this post.
	'AL_OTHER_TEXT'						=> 'other',						// userX and 1 `other`  like this post.
	'AL_OTHERS_TEXT'					=> 'others',					// userX and 5 `others` like this post.
	'AL_PEOPLE_TEXT'					=> 'people',					// 4 `people` like this post.
	'AL_LIKE_POST_TEXT'					=> 'like this post.',			// 3 people `like this post`.
	'AL_ONE_LIKE_POST_TEXT'				=> 'likes this post.',			// userX `likes this post`.
	'AL_LIKE_POST_WITH_YOU_TEXT'		=> 'like this post.',			// You and 2 others `like this post`.
	'AL_YOU_LIKE_TEXT'					=> 'like this post.',			// You `like this post`.
	// 																		alternative mode:
	'AL_ALTER_ONE_PEOPLE_TEXT'			=> 'person',					// 1 `person` likes this post.
	'AL_ALTER_TWO_PEOPLE_TEXT'			=> 'people',					// 2 `people` like this post.
	'AL_ALTER_THREE_PEOPLE_TEXT'		=> 'people',					// 3 `people` like this post.
	'AL_ALTER_MORE_PEOPLE_TEXT'			=> 'people',					// 12 `people` like this post.
	'AL_ALTER_ONE_LIKE_POST_TEXT'		=> 'likes this post.',			// 1 person `likes this post`.
	'AL_ALTER_TWO_LIKE_POST_TEXT'		=> 'like this post.',			// 2 people `like this post`.
	'AL_ALTER_THREE_LIKE_POST_TEXT'		=> 'like this post.',			// 3 people `like this post`.
	'AL_ALTER_MORE_LIKE_POST_TEXT'		=> 'like this post.',			// 10 people `like this post`.
	//
	'AL_LIKE_TEXT'						=> 'Like',
	'AL_UNLIKE_TEXT'					=> 'Unlike',
	'AL_PEOPLE_LIKE_THIS_TEXT'			=> 'People like this post',		// dialog box title
	'AL_LIKE_COUNT_TEXT'				=> 'Likes',						// number of likes
	'AL_LIKED_COUNT_TEXT'				=> 'Liked in',					// number of received likes
	'AL_POSTS_TEXT'						=> 'posts',
	'AL_POST_TEXT'						=> 'post',
	'AL_LIKE_AT_TEXT'					=> 'Liked at',					// like date
	'AL_ERROR_INVALID_REQUEST'			=> 'Invalid request!',
	'AL_ERROR_ACCESS_DENIED'			=> 'Access Denied!',
	// ajaxlike
	'ATTACHMENT'						=> 'Attachment',
	'ATTACHMENT_FUNCTIONALITY_DISABLED'	=> 'The attachments feature has been disabled.',

	'BOOKMARK_ADDED'		=> 'Bookmarked topic successfully.',
	'BOOKMARK_ERR'			=> 'Bookmarking the topic failed. Please try again.',
	'BOOKMARK_REMOVED'		=> 'Removed bookmarked topic successfully.',
	'BOOKMARK_TOPIC'		=> 'Bookmark topic',
	'BOOKMARK_TOPIC_REMOVE'	=> 'Remove from bookmarks',
	'BUMPED_BY'				=> 'Last bumped by %1$s on %2$s.',
	'BUMP_TOPIC'			=> 'Bump topic',

	'CODE'					=> 'Code',
	'COLLAPSE_QR'			=> 'Hide Quick Reply',

	'DELETE_TOPIC'			=> 'Delete topic',
	'DOWNLOAD_NOTICE'		=> 'You do not have the required permissions to view the files attached to this post.',

	'EDITED_TIMES_TOTAL'	=> 'Last edited by %1$s on %2$s, edited %3$d times in total.',
	'EDITED_TIME_TOTAL'		=> 'Last edited by %1$s on %2$s, edited %3$d time in total.',
	'EMAIL_TOPIC'			=> 'E-mail friend',
	'ERROR_NO_ATTACHMENT'	=> 'The selected attachment does not exist anymore.',

	'FILE_NOT_FOUND_404'	=> 'The file <strong>%s</strong> does not exist.',
	'FORK_TOPIC'			=> 'Copy topic',
	'FULL_EDITOR'			=> 'Full Editor',
	
	'LINKAGE_FORBIDDEN'		=> 'You are not authorised to view, download or link from/to this site.',
	'LOGIN_NOTIFY_TOPIC'	=> 'You have been notified about this topic, please login to view it.',
	'LOGIN_VIEWTOPIC'		=> 'The board requires you to be registered and logged in to view this topic.',

	'MAKE_ANNOUNCE'				=> 'Change to “Announcement”',
	'MAKE_GLOBAL'				=> 'Change to “Global”',
	'MAKE_NORMAL'				=> 'Change to “Standard Topic”',
	'MAKE_STICKY'				=> 'Change to “Sticky”',
	'MAX_OPTIONS_SELECT'		=> 'You may select up to <strong>%d</strong> options',
	'MAX_OPTION_SELECT'			=> 'You may select <strong>1</strong> option',
	'MISSING_INLINE_ATTACHMENT'	=> 'The attachment <strong>%s</strong> is no longer available',
	'MOVE_TOPIC'				=> 'Move topic',

	'NO_ATTACHMENT_SELECTED'=> 'You haven’t selected an attachment to download or view.',
	'NO_NEWER_TOPICS'		=> 'There are no newer topics in this forum.',
	'NO_OLDER_TOPICS'		=> 'There are no older topics in this forum.',
	'NO_UNREAD_POSTS'		=> 'There are no new unread posts for this topic.',
	'NO_VOTE_OPTION'		=> 'You must specify an option when voting.',
	'NO_VOTES'				=> 'No votes',

	'POLL_ENDED_AT'			=> 'Poll ended at %s',
	'POLL_RUN_TILL'			=> 'Poll runs till %s',
	'POLL_VOTED_OPTION'		=> 'You voted for this option',
	'PRINT_TOPIC'			=> 'Print view',

	'QUICK_MOD'				=> 'Quick-mod tools',
	'QUICKREPLY'			=> 'Quick Reply',
	'QUOTE'					=> 'Quote',

	'REPLY_TO_TOPIC'		=> 'Reply to topic',
	'RETURN_POST'			=> '%sReturn to the post%s',

	'SHOW_QR'				=> 'Quick Reply',
	'SUBMIT_VOTE'			=> 'Submit vote',

	'TOTAL_VOTES'			=> 'Total votes',

	'UNLOCK_TOPIC'			=> 'Unlock topic',

	'VIEW_INFO'				=> 'Post details',
	'VIEW_NEXT_TOPIC'		=> 'Next topic',
	'VIEW_PREVIOUS_TOPIC'	=> 'Previous topic',
	'VIEW_RESULTS'			=> 'View results',
	'VIEW_TOPIC_POST'		=> '1 post',
	'VIEW_TOPIC_POSTS'		=> '%d posts',
	'VIEW_UNREAD_POST'		=> 'First unread post',
	'VISIT_WEBSITE'			=> 'WWW',
	'VOTE_SUBMITTED'		=> 'Your vote has been cast.',
	'VOTE_CONVERTED'		=> 'Changing votes is not supported for converted polls.',

));

$lang = array_merge($lang, array(
// ajaxlike
	'AL_YOU_TEXT'						=> 'You',						// `You` like this post.
	'AL_AND_TEXT'						=> 'and',						// userX `and` y like this post.
	'AL_OTHER_TEXT'						=> 'other',						// userX and 1 `other`  like this post.
	'AL_OTHERS_TEXT'					=> 'others',					// userX and 5 `others` like this post.
	'AL_PEOPLE_TEXT'					=> 'people',					// 4 `people` like this post.
	'AL_LIKE_POST_TEXT'					=> 'like this post.',			// 3 people `like this post`.
	'AL_ONE_LIKE_POST_TEXT'				=> 'likes this post.',			// userX `likes this post`.
	'AL_LIKE_POST_WITH_YOU_TEXT'		=> 'like this post.',			// You and 2 others `like this post`.
	'AL_YOU_LIKE_TEXT'					=> 'like this post.',			// You `like this post`.
	// 																		alternative mode:
	'AL_ALTER_ONE_PEOPLE_TEXT'			=> 'person',					// 1 `person` likes this post.
	'AL_ALTER_TWO_PEOPLE_TEXT'			=> 'people',					// 2 `people` like this post.
	'AL_ALTER_THREE_PEOPLE_TEXT'		=> 'people',					// 3 `people` like this post.
	'AL_ALTER_MORE_PEOPLE_TEXT'			=> 'people',					// 12 `people` like this post.
	'AL_ALTER_ONE_LIKE_POST_TEXT'		=> 'likes this post.',			// 1 person `likes this post`.
	'AL_ALTER_TWO_LIKE_POST_TEXT'		=> 'like this post.',			// 2 people `like this post`.
	'AL_ALTER_THREE_LIKE_POST_TEXT'		=> 'like this post.',			// 3 people `like this post`.
	'AL_ALTER_MORE_LIKE_POST_TEXT'		=> 'like this post.',			// 10 people `like this post`.
	//
	'AL_LIKE_TEXT'						=> 'Like',
	'AL_UNLIKE_TEXT'					=> 'Unlike',
	'AL_PEOPLE_LIKE_THIS_TEXT'			=> 'People like this post',		// dialog box title
	'AL_LIKE_COUNT_TEXT'				=> 'Likes',						// number of likes
	'AL_LIKED_COUNT_TEXT'				=> 'Liked in',					// number of received likes
	'AL_POSTS_TEXT'						=> 'posts',
	'AL_POST_TEXT'						=> 'post',
	'AL_LIKE_AT_TEXT'					=> 'Liked at',					// like date
	'AL_ERROR_INVALID_REQUEST'			=> 'Invalid request!',
	'AL_ERROR_ACCESS_DENIED'			=> 'Access Denied!',
));