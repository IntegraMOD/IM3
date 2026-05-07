<?php
/** 
*
* contact [French]
*
* @package	language
* @version	1.0.9 2009-12-25
* @copyright(c) 2009 RMcGirr83
* @copyright (c) 2007 eviL3
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

	// the form
	
	'CONTACT_BOT_ERROR'						=> 'Vous ne pouvez pas utiliser le formulaire de contact pour le moment car il y a une erreur dans la configuration. Un e‑mail a été envoyé au fondateur du forum.',
	'CONTACT_BOT_NONE'						=> 'L\'utilisateur %1$s a tenté d\'utiliser la modification Contact Admin à %2$s pour envoyer un(e) %3$s, mais il n\'existe aucun administrateur autorisant les %3$ss par les utilisateurs.' . "\n\n" . 'Veuillez configurer le Contact Bot dans le panneau d\'administration pour le forum %4$s et choisir l\'option « Board Founder ».' . "\n\n" . 'La modification a été désactivée',
	'CONTACT_BOT_SUBJECT'					=> 'Erreur de la modification Contact Board Administration',
	'CONTACT_BOT_USER_MESSAGE'				=> 'L\'utilisateur %1$s a tenté d\'utiliser la modification Contact Admin à %2$s, mais l\'utilisateur sélectionné dans la configuration est incorrect.' . "\n\n" . 'Veuillez visiter le forum %3$s et choisir un autre utilisateur dans l\'ACP pour le Contact Board Administration.' . "\n\n" . 'La modification a été désactivée',
	'CONTACT_BOT_FORUM_MESSAGE'				=> 'L\'utilisateur %1$s a tenté d\'utiliser la modification Contact Admin à %2$s, mais le forum sélectionné dans la configuration est incorrect.' . "\n\n" . 'Veuillez visiter le forum %3$s et choisir un autre forum dans l\'ACP pour le Contact Board Administration.' . "\n\n" . 'La modification a été désactivée',
	'CONTACT_CONFIRM'						=> 'Confirmer',
	'CONTACT_INSTALLED'						=> 'La modification « Contact Board Administration » a été installée avec succès.',

	'CONTACT_DISABLED'			=> 'Vous ne pouvez pas utiliser le formulaire de contact pour le moment car il est désactivé.',
	'CONTACT_MAIL_DISABLED'		=> 'Il y a une erreur dans la configuration de la modification Contact Board Administration.<br />Le mod est configuré pour envoyer un e‑mail mais la configuration du forum ne permet pas l\'envoi d\'e‑mails. Veuillez en informer l\'administrateur du forum ou le webmaster : <a href="mailto:%1$s">%1$s</a>', 
	'CONTACT_MSG_SENT'			=> 'Votre message a été envoyé avec succès',
	'CONTACT_MSG_BODY_EXPLAIN'	=> '<br /><span>Veuillez n\'utiliser le formulaire de contact <strong><em>que</em></strong> s\'il n\'existe aucun autre moyen de nous contacter.<br /><br /><span style="text-align:center;"><strong>Votre adresse IP est enregistrée et toute tentative d\'abus sera sanctionnée.</strong></span></span>',
	'CONTACT_NO_NAME'			=> 'Vous n\'avez pas saisi de nom.',
	'CONTACT_NO_EMAIL'			=> 'Vous n\'avez pas saisi d\'adresse e‑mail.',
	'CONTACT_NO_MSG'			=> 'Vous n\'avez pas saisi de message.',
	'CONTACT_NO_SUBJ'			=> 'Vous n\'avez pas saisi d\'objet.',
	'CONTACT_NO_REASON'			=> 'Vous n\'avez pas saisi de raison valide.',
	'CONTACT_OUTDATED'			=> 'La base de données de la page de contact n\'a pas encore été mise à jour. Veuillez attendre qu\'un administrateur procède à la mise à jour.',
	'CONTACT_REASON'			=> 'Raison',
	'CONTACT_TEMPLATE'			=> '<strong>Nom :</strong> %1$s' . "\n" . '<strong>Adresse e‑mail :</strong> %2$s' . "\n" . '<strong>IP :</strong> %3$s' . "\n" . '<strong>Date :</strong> %4$s' . "\n" . '<strong>Raison :</strong> %5$s' . "\n" . '<strong>Objet :</strong> %6$s' . "\n\n" . '<strong>A saisi le message suivant dans le formulaire de contact :</strong>' . "\n" . '%7$s',
	'CONTACT_TEMPLATE_NO_REASON'	=> '<strong>Nom :</strong> %1$s' . "\n" . '<strong>Adresse e‑mail :</strong> %2$s' . "\n" . '<strong>IP :</strong> %3$s' . "\n" . '<strong>Date :</strong> %4$s' . "\n" . '<strong>Objet :</strong> %5$s' . "\n\n" . '<strong>A saisi le message suivant dans le formulaire de contact :</strong>' . "\n" . '%6$s',
	'CONTACT_TITLE'				=> 'Contacter l\'administration du forum',
	'CONTACT_TOO_MANY'			=> 'Vous avez dépassé le nombre maximal de tentatives de confirmation de contact pour cette session. Veuillez réessayer plus tard.',
	'CONTACT_UNINSTALLED'		=> 'La modification « contact board administration » a été désinstallée avec succès.',
	'CONTACT_UPDATED'			=> 'La modification « contact board administration » a été mise à jour vers la version %s avec succès.',
	
	'CONTACT_YOUR_NAME'				=> 'Votre nom',
	'CONTACT_YOUR_NAME_EXPLAIN'		=> 'Veuillez saisir votre nom, afin que le message ait une identité.',
	'CONTACT_YOUR_EMAIL'			=> 'Votre adresse e‑mail',
	'CONTACT_YOUR_EMAIL_EXPLAIN'	=> 'Veuillez saisir une adresse e‑mail valide afin que nous puissions vous répondre.',
	'CONTACT_YOUR_EMAIL_CONFIRM'	=> 'Saisir de nouveau votre adresse e‑mail',
	'CONTACT_YOUR_EMAIL_CONFIRM_EXPLAIN'	=> 'Veuillez ressaisir votre adresse e‑mail.',	

	'RETURN_CONTACT'				=> '%sRetour à la page de contact%s',
	'URL_UNAUTHED'		=> 'Vous ne pouvez pas poster d\'URL, veuillez supprimer ou renommer :<br /><em>%1$s</em>',
));