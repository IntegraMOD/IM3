<?php
/**
*
* viewtopic [French]
*
* @package language
* @version $Id$
* @copyright (c) 2005 phpBB Group, (c) Maël Soucaze
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
	'ATTACHMENT'						=> 'Pièce jointe',
	'ATTACHMENT_FUNCTIONALITY_DISABLED'	=> 'La fonctionnalité liée aux pièces jointes est désactivée.',

	'BOOKMARK_ADDED'		=> 'Le sujet a été ajouté aux favoris.',
	'BOOKMARK_ERR'			=> 'Le sujet n’a pas pu être ajouté aux favoris. Veuillez réessayer ultérieurement.',
	'BOOKMARK_REMOVED'		=> 'Le sujet a été supprimé de vos favoris.',
	'BOOKMARK_TOPIC'		=> 'Ajouter ce sujet aux favoris',
	'BOOKMARK_TOPIC_REMOVE'	=> 'Supprimer ce sujet de vos favoris',
	'BUMPED_BY'				=> 'Dernière remontée par %1$s le %2$s.',
	'BUMP_TOPIC'			=> 'Remonter le sujet',

	'CODE'					=> 'Code',
	'COLLAPSE_QR'			=> 'Masquer la réponse rapide',

	'DELETE_TOPIC'			=> 'Supprimer le sujet',
	'DOWNLOAD_NOTICE'		=> 'Vous ne pouvez pas consulter les fichiers insérés à ce message.',

	'EDITED_TIMES_TOTAL'	=> 'Dernière édition par %1$s le %2$s, édité %3$d fois.',
	'EDITED_TIME_TOTAL'		=> 'Dernière édition par %1$s le %2$s, édité %3$d fois.',
	'EMAIL_TOPIC'			=> 'Envoyer par courrier électronique le sujet',
	'ERROR_NO_ATTACHMENT'	=> 'La pièce jointe que vous avez sélectionnée n’existe plus.',

	'FILE_NOT_FOUND_404'	=> 'Le fichier <strong>%s</strong> n’existe pas.',
	'FORK_TOPIC'			=> 'Copier le sujet',
	'FULL_EDITOR'			=> 'Éditeur avancé et prévisualisation',
	
	'LINKAGE_FORBIDDEN'		=> 'Vous ne pouvez pas consulter, télécharger ou insérer de lien vers ce site.',
	'LOGIN_NOTIFY_TOPIC'	=> 'Vous avez reçu une notification concernant un message de ce sujet. Veuillez vous connecter afin de consulter ce dernier.',
	'LOGIN_VIEWTOPIC'		=> 'Vous devez être inscrit(e) et connecté(e) afin de consulter ce sujet.',

	'MAKE_ANNOUNCE'				=> 'Modifier en « annonce »',
	'MAKE_GLOBAL'				=> 'Modifier en « annonce générale »',
	'MAKE_NORMAL'				=> 'Modifier en « sujet standard »',
	'MAKE_STICKY'				=> 'Modifier en « note »',
	'MAX_OPTIONS_SELECT'		=> 'Vous pouvez sélectionner jusqu’à <strong>%d</strong> options',
	'MAX_OPTION_SELECT'			=> 'Vous pouvez sélectionner <strong>1</strong> option',
	'MISSING_INLINE_ATTACHMENT'	=> 'La pièce jointe <strong>%s</strong> n’est plus disponible',
	'MOVE_TOPIC'				=> 'Déplacer le sujet',

	'NO_ATTACHMENT_SELECTED'=> 'Aucune pièce jointe à télécharger ou à consulter n’a été sélectionnée.',
	'NO_NEWER_TOPICS'		=> 'Aucun nouveau sujet n’a été publié dans ce forum.',
	'NO_OLDER_TOPICS'		=> 'Aucun ancien sujet n’a été publié dans ce forum.',
	'NO_UNREAD_POSTS'		=> 'Aucun message non lu n’a été publié dans ce sujet.',
	'NO_VOTE_OPTION'		=> 'Vous devez sélectionner une option lors du vote.',
	'NO_VOTES'				=> 'Aucun vote',

	'POLL_ENDED_AT'			=> 'Le sondage a expiré le %s',
	'POLL_RUN_TILL'			=> 'Le sondage est ouvert jusqu’au %s',
	'POLL_VOTED_OPTION'		=> 'Vous avez voté pour cette option',
	'PRINT_TOPIC'			=> 'Aperçu avant impression',

	'QUICK_MOD'				=> 'Outils de modération rapide',
	'QUICKREPLY'			=> 'Réponse rapide',
	'QUOTE'					=> 'Citer',

	'REPLY_TO_TOPIC'		=> 'Répondre au sujet',
	'RETURN_POST'			=> '%sRevenir au message%s',

	'SHOW_QR'				=> 'Réponse rapide',
	'SUBMIT_VOTE'			=> 'Voter',

	'TOTAL_VOTES'			=> 'Nombre total de votes',

	'UNLOCK_TOPIC'			=> 'Déverrouiller le sujet',

	'VIEW_INFO'				=> 'Informations sur le message',
	'VIEW_NEXT_TOPIC'		=> 'Sujet suivant',
	'VIEW_PREVIOUS_TOPIC'	=> 'Sujet précédent',
	'VIEW_RESULTS'			=> 'Consulter les résultats',
	'VIEW_TOPIC_POST'		=> '1 message',
	'VIEW_TOPIC_POSTS'		=> '%d messages',
	'VIEW_UNREAD_POST'		=> 'Premier message non lu',
	'VISIT_WEBSITE'			=> 'Site internet',
	'VOTE_SUBMITTED'		=> 'Votre vote a bien été comptabilisé.',
	'VOTE_CONVERTED'		=> 'Impossible de modifier les votes d’un sondage qui a été converti.',

));

$lang = array_merge($lang, array(
// ajaxlike
	'AL_YOU_TEXT'						=> 'Vous',						// `You` like this post.
	'AL_AND_TEXT'						=> 'et',						// userX `and` y like this post.
	'AL_OTHER_TEXT'						=> 'autre',						// userX and 1 `other`  like this post.
	'AL_OTHERS_TEXT'					=> 'autres',					// userX and 5 `others` like this post.
	'AL_PEOPLE_TEXT'					=> 'personnes',					// 4 `people` like this post.
	'AL_LIKE_POST_TEXT'					=> 'aiment ce message.',			// 3 people `like this post`.
	'AL_ONE_LIKE_POST_TEXT'				=> 'aime ce message.',			// userX `likes this post`.
	'AL_LIKE_POST_WITH_YOU_TEXT'		=> 'aiment ce message.',			// You and 2 others `like this post`.
	'AL_YOU_LIKE_TEXT'					=> 'aimez ce message.',			// You `like this post`.
	// 																		alternative mode:
	'AL_ALTER_ONE_PEOPLE_TEXT'			=> 'personne',					// 1 `person` likes this post.
	'AL_ALTER_TWO_PEOPLE_TEXT'			=> 'personnes',					// 2 `people` like this post.
	'AL_ALTER_THREE_PEOPLE_TEXT'		=> 'personnes',					// 3 `people` like this post.
	'AL_ALTER_MORE_PEOPLE_TEXT'			=> 'personnes',					// 12 `people` like this post.
	'AL_ALTER_ONE_LIKE_POST_TEXT'		=> 'aime ce message.',			// 1 person `likes this post`.
	'AL_ALTER_TWO_LIKE_POST_TEXT'		=> 'aiment ce message.',			// 2 people `like this post`.
	'AL_ALTER_THREE_LIKE_POST_TEXT'		=> 'aiment ce message.',			// 3 people `like this post`.
	'AL_ALTER_MORE_LIKE_POST_TEXT'		=> 'aiment ce message.',			// 10 people `like this post`.
	//
	'AL_LIKE_TEXT'						=> 'J’aime',
	'AL_UNLIKE_TEXT'					=> 'Je n’aime plus',
	'AL_PEOPLE_LIKE_THIS_TEXT'			=> 'Les personnes qui aiment ce message',		// dialog box title
	'AL_LIKE_COUNT_TEXT'				=> 'J’aime',						// number of likes
	'AL_LIKED_COUNT_TEXT'				=> 'Aimé dans',					// number of received likes
	'AL_POSTS_TEXT'						=> 'messages',
	'AL_POST_TEXT'						=> 'message',
	'AL_LIKE_AT_TEXT'					=> 'Aimé le',					// like date
	'AL_ERROR_INVALID_REQUEST'			=> 'Requête invalide !',
	'AL_ERROR_ACCESS_DENIED'			=> 'Accès refusé !',
));
