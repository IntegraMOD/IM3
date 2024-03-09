<?php
/**
*
* viewtopic [Dutch]
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
	'ATTACHMENT'						=> 'Bijlage',
	'ATTACHMENT_FUNCTIONALITY_DISABLED'	=> 'Bijlagen zijn uitgeschakeld',

	'BOOKMARK_ADDED'		=> 'Het onderwerp is toegevoegd aan je bladwijzers.',
	'BOOKMARK_ERR'			=> 'Het is niet gelukt om het onderwerp toe te voegen aan je bladwijzers. Probeer het nog eens.',
	'BOOKMARK_REMOVED'		=> 'Het onderwerp is uit je bladwijzers verwijderd.',
	'BOOKMARK_TOPIC'		=> 'Bladwijzer onderwerp',
	'BOOKMARK_TOPIC_REMOVE'	=> 'Verwijder het onderwerp uit je bladwijzers.',
	'BUMPED_BY'				=> 'Laatst gebumpt door %1$s op %2$s',
	'BUMP_TOPIC'			=> 'Bump onderwerp',

	'CODE'					=> 'Code',
	'COLLAPSE_QR'			=> 'Verberg snel reageren',

	'DELETE_TOPIC'			=> 'Verwijder onderwerp',
	'DOWNLOAD_NOTICE'		=> 'Je hebt geen permissies om de bijlage(n)) in dit bericht te zien.',

	'EDITED_TIMES_TOTAL'	=> 'Laatst bijgewerkt door %1$s op %2$s, in totaal %3$d keer bewerkt.',
	'EDITED_TIME_TOTAL'		=> 'Laatst bijgewerkt door %1$s op %2$s, in totaal %3$d keer bewerkt.',
	'EMAIL_TOPIC'			=> 'E-mail vriend',
	'ERROR_NO_ATTACHMENT'	=> 'De geselecteerde bijlage bestaat niet (meer).',

	'FILE_NOT_FOUND_404'	=> 'Het bestand <strong>%s</strong> bestaat niet (meer).',
	'FORK_TOPIC'			=> 'Kopieer het onderwerp',
	'FULL_EDITOR'			=> 'Volledige bewerker',

	'LINKAGE_FORBIDDEN'		=> 'Je bent niet bevoegd om te lezen, downloaden of te linken van/naar deze site.',
	'LOGIN_NOTIFY_TOPIC'	=> 'Je bent geïnformeerd over dit onderwerp, log in om het te lezen.',
	'LOGIN_VIEWTOPIC'		=> 'Het forum is zo ingesteld, dat je geregistreerd en ingelogd moet zijn om dit onderwerp te lezen.',

	'MAKE_ANNOUNCE'				=> 'Wijzig in mededeling',
	'MAKE_GLOBAL'				=> 'Wijzig in globale mededeling',
	'MAKE_NORMAL'				=> 'Wijzig in normaal onderwerp',
	'MAKE_STICKY'				=> 'Wijzig in sticky',
	'MAX_OPTIONS_SELECT'		=> 'Je mag tot <strong>%d</strong> opties selecteren.',
	'MAX_OPTION_SELECT'			=> 'Je mag <strong>1</strong> optie selecteren.',
	'MISSING_INLINE_ATTACHMENT'	=> 'De bijlage <strong>%s</strong> is niet langer beschikbaar.',
	'MOVE_TOPIC'				=> 'Verplaats onderwerp',

	'NO_ATTACHMENT_SELECTED'=> 'Je hebt geen bijlage opgegeven om te downloaden of te tonen.',
	'NO_NEWER_TOPICS'		=> 'Er zijn geen nieuwere onderwerpen in dit forum',
	'NO_OLDER_TOPICS'		=> 'Er zijn geen oudere onderwerpen in dit forum',
	'NO_UNREAD_POSTS'		=> 'Er zijn geen ongelezen berichten in dit onderwerp.',
	'NO_VOTE_OPTION'		=> 'Je moet een optie selecteren om te stemmen.',
	'NO_VOTES'				=> 'Geen stemmen',

	'POLL_ENDED_AT'			=> 'Poll eindigt op %s',
	'POLL_RUN_TILL'			=> 'De poll loopt tot %s',
	'POLL_VOTED_OPTION'		=> 'Je hebt gestemd voor deze optie',
	'PRINT_TOPIC'			=> 'Afdrukweergave',

	'QUICK_MOD'				=> 'Mod gereedschap',
	'QUICKREPLY'			=> 'Snel reageren',
	'QUOTE'					=> 'Citaat',

	'REPLY_TO_TOPIC'	=> 'Antwoord op onderwerp',
	'RETURN_POST'		=> '%sKeer terug naar het bericht%s',

	'SHOW_QR'				=> 'Snel reageren',
	'SUBMIT_VOTE'			=> 'Stem',

	'TOTAL_VOTES'			=> 'Totaal aantal stemmen',

	'UNLOCK_TOPIC'			=> 'Heropen onderwerp',

	'VIEW_INFO'				=> 'Bericht details',
	'VIEW_NEXT_TOPIC'		=> 'Volgend onderwerp',
	'VIEW_PREVIOUS_TOPIC'	=> 'Vorig onderwerp',
	'VIEW_RESULTS'			=> 'Toon resultaten',
	'VIEW_TOPIC_POST'		=> '1 bericht',
	'VIEW_TOPIC_POSTS'		=> '%d berichten',
	'VIEW_UNREAD_POST'		=> 'Eerste ongelezen',
	'VISIT_WEBSITE'			=> 'WWW',
	'VOTE_SUBMITTED'		=> 'Je stem is verwerkt',
	'VOTE_CONVERTED'		=> 'Je stem wijzigen is niet mogelijk voor geconverteerde polls',

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