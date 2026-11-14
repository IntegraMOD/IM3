<?php
/**
*
* Moderator action undo [Français]
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
	'ACP_MOD_UNDO'						=> 'Annulation des actions de modération',
	'ACP_MOD_UNDO_LIST'					=> 'Actions des modérateurs',
	'ACP_MOD_UNDO_LIST_EXPLAIN'			=> 'Actions effectuées par les modérateurs : suppressions, éditions, déplacements, divisions, fusions, verrouillages, changements d’auteur, bannissements et avertissements. La restauration remet le contenu dans l’état précédant l’action. Plusieurs actions sont annulées de la plus récente à la plus ancienne.',
	'ACP_MOD_UNDO_SETTINGS'				=> 'Paramètres d’annulation',
	'ACP_MOD_UNDO_SETTINGS_EXPLAIN'		=> 'Conserve un historique des actions des modérateurs afin qu’un administrateur puisse les annuler.',

	'MOD_UNDO_ENABLE'					=> 'Enregistrer les actions des modérateurs',
	'MOD_UNDO_ENABLE_EXPLAIN'			=> 'Les suppressions, éditions de messages d’autrui, déplacements, divisions, fusions, verrouillages, changements d’auteur, bannissements et avertissements sont enregistrés afin de pouvoir être annulés.',
	'MOD_UNDO_ADMINS'					=> 'Enregistrer aussi les administrateurs',
	'MOD_UNDO_ADMINS_EXPLAIN'			=> 'Enregistre également les actions des utilisateurs disposant d’une permission d’administration. Protège contre un compte administrateur piraté.',
	'MOD_UNDO_DAYS'						=> 'Conserver les entrées pendant',
	'MOD_UNDO_DAYS_EXPLAIN'				=> 'Les entrées plus anciennes sont supprimées avec leurs fichiers joints sauvegardés. 0 les conserve indéfiniment.',

	'MOD_UNDO_ACTION_DELETE_POST'		=> 'Message(s) supprimé(s)',
	'MOD_UNDO_ACTION_DELETE_TOPIC'		=> 'Sujet(s) supprimé(s)',
	'MOD_UNDO_ACTION_EDIT'				=> 'Message édité',
	'MOD_UNDO_ACTION_LOCK'				=> 'Sujet(s) verrouillé(s)',
	'MOD_UNDO_ACTION_UNLOCK'			=> 'Sujet(s) déverrouillé(s)',
	'MOD_UNDO_ACTION_LOCK_POST'			=> 'Message(s) verrouillé(s)',
	'MOD_UNDO_ACTION_UNLOCK_POST'		=> 'Message(s) déverrouillé(s)',
	'MOD_UNDO_ACTION_MOVE'				=> 'Sujet(s) déplacé(s)',
	'MOD_UNDO_ACTION_SPLIT'				=> 'Sujet divisé',
	'MOD_UNDO_ACTION_MERGE'				=> 'Messages/sujets fusionnés',
	'MOD_UNDO_ACTION_CHANGE_POSTER'		=> 'Auteur modifié',
	'MOD_UNDO_ACTION_BAN'				=> 'Bannissement',
	'MOD_UNDO_ACTION_UNBAN'				=> 'Débannissement',
	'MOD_UNDO_ACTION_WARNING'			=> 'Avertissement',

	'MOD_UNDO_MODERATOR'				=> 'Modérateur',
	'MOD_UNDO_SUMMARY'					=> 'Contenu',
	'MOD_UNDO_STATUS'					=> 'Statut',
	'MOD_UNDO_PENDING'					=> 'Restaurable',
	'MOD_UNDO_RESTORED_ON'				=> 'Restauré',
	'MOD_UNDO_ALL'						=> 'Tous',
	'MOD_UNDO_FILTER_USER'				=> 'Nom d’utilisateur du modérateur',
	'MOD_UNDO_VIEW'						=> 'Voir',
	'MOD_UNDO_DISABLED'					=> 'L’enregistrement est actuellement désactivé. Les entrées existantes peuvent toujours être restaurées.',
	'MOD_UNDO_NO_ENTRIES'				=> 'Aucune action de modération enregistrée.',

	'MOD_UNDO_RESTORE_MARKED'			=> 'Restaurer la sélection',
	'MOD_UNDO_REVERT_USER'				=> 'Annuler toutes les actions d’un modérateur',
	'MOD_UNDO_REVERT_USER_EXPLAIN'		=> 'Restaure toutes les actions en attente de ce modérateur sur le nombre de jours choisi, de la plus récente à la plus ancienne. À utiliser lorsqu’un compte a été piraté.',
	'MOD_UNDO_REVERT_DAYS'				=> 'Jours en arrière',
	'MOD_UNDO_REVERT'					=> 'Annuler',

	'MOD_UNDO_RESTORED'					=> '%d action(s) restaurée(s).',
	'MOD_UNDO_ERRORS'					=> 'Ces actions n’ont pas pu être restaurées :',
	'MOD_UNDO_NOTHING_MARKED'			=> 'Aucune action n’a été sélectionnée.',
	'MOD_UNDO_NOTHING_FOUND'			=> 'Aucune action en attente n’a été trouvée pour ce modérateur sur cette période.',
	'MOD_UNDO_NO_USER'					=> 'Saisissez un nom d’utilisateur existant et un nombre de jours.',
	'MOD_UNDO_NOT_FOUND'				=> 'L’entrée n’existe plus.',
	'MOD_UNDO_ALREADY'					=> 'Cette action a déjà été restaurée.',
	'MOD_UNDO_BAD_DATA'					=> 'Les données enregistrées sont illisibles.',
	'MOD_UNDO_FORUM_GONE'				=> 'Un forum auquel appartenait ce contenu n’existe plus.',
	'MOD_UNDO_TOPIC_GONE'				=> 'Un sujet auquel appartenait ce contenu n’existe plus et ne faisait pas partie de cette entrée.',
	'MOD_UNDO_POST_GONE'				=> 'Le message n’existe plus.',
	'MOD_UNDO_STATE_CHANGED'			=> 'Le contenu a été modifié à nouveau après cette action ; annulez d’abord l’action la plus récente.',

	'LOG_MOD_UNDO_RESTORE'				=> '<strong>Action de modération restaurée</strong><br />» %1$s : %2$s',
));
