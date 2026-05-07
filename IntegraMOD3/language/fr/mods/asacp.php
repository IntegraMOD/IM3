<?php
/**
*
* @package Anti-Spam ACP
* @copyright (c) 2008 EXreaction
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
	'ASACP_AKISMET'			=> 'Akismet',
	'ASACP_AKISMET_SUBMIT'	=> 'Soumettre le message suivant à Akismet (spam uniquement)',
	'ASACP_BAN'				=> 'Bannissement en un clic',
	'ASACP_BAN_ACTIONS'		=> 'Les actions suivantes seront effectuées : %s',
	'ASACP_BAN_COMPLETE'	=> 'Vous avez banni l\'utilisateur avec succès.<br /><br /><a href="%s">Cliquez ici pour revenir au profil de l\'utilisateur.</a>',
	'ASACP_BAN_CONFIRM'		=> 'Êtes-vous sûr de vouloir bannir l\'utilisateur %s ? <strong class="error">Ceci ne peut pas être annulé !</strong>',
	'ASACP_BAN_REASON'		=> 'Raison du bannissement',
	'ASACP_BAN_REASON_EXPLAIN'					=> 'Veuillez entrer la raison du bannissement (privée).',
	'ASACP_BAN_REASON_SHOWN_TO_USER'			=> 'Raison du bannissement affichée à l\'utilisateur',
	'ASACP_BAN_REASON_SHOWN_TO_USER_EXPLAIN'	=> 'Si un message est saisi ici, il sera affiché à l\'utilisateur qui a été banni.',
	'ASACP_CREDITS'			=> '',
	'ASACP_EVIDENCE_SFS'	=> 'Si vous soumettez des informations à Stop Forum Spam, vous devez entrer des preuves ici.<br />(Limite de 8 000 caractères)',

	'FOUNDER_ONLY'			=> 'Vous devez être Fondateur du forum pour accéder à cette page.',

	'IP_SEARCH'				=> 'Recherche d\'IP',

	'MORE'					=> 'Plus',

	'PROFILE_SPAM_DENIED'	=> 'Un ou plusieurs champs saisis ont été marqués comme spam.',

	'REMOVE_ASACP'			=> 'Supprimer l\'Anti-Spam ACP',
	'REMOVE_ASACP_CONFIRM'	=> 'Êtes-vous sûr de vouloir supprimer les modifications de la base de données effectuées par le mod Anti-Spam ACP ?<br /><br />Avant de faire cela, assurez-vous de retirer les modifications du mod dans les fichiers, sinon la section de la base de données sera automatiquement réajoutée.',

	'SFS_SUBMIT'			=> 'Soumettre les informations de profil à <a href="http://www.stopforumspam.com/">Stop Forum Spam</a><br /><br /><strong>Notez que soumettre des utilisateurs pour autre chose que du spam n\'est pas autorisé et peut entraîner une interdiction sur Stop Forum Spam.</strong>',
	'SIGNATURE_DISABLED'	=> 'Vous n\'êtes pas autorisé à utiliser une signature.',
	'SPAM_DENIED'			=> 'Ce message a été signalé comme spam et a été refusé.',
	'STOP_FORUM_SPAM'		=> 'Stop Forum Spam',

	'USER_FLAG'				=> 'Signaler',
	'USER_FLAGGED'			=> 'Utilisateur signalé',
	'USER_FLAG_CONFIRM'		=> 'Êtes-vous sûr de vouloir signaler l\'utilisateur %s ?',
	'USER_FLAG_NEW'			=> 'Nouveaux signalements enregistrés',
	'USER_FLAG_SUCCESS'		=> 'L\'utilisateur a été signalé avec succès.',
	'USER_UNFLAG'			=> 'Retirer le signalement',
	'USER_UNFLAG_CONFIRM'	=> 'Êtes-vous sûr de vouloir retirer le signalement de l\'utilisateur %s ?',
	'USER_UNFLAG_SUCCESS'	=> 'Le signalement a été retiré de cet utilisateur avec succès.',
));