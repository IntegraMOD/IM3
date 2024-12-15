<?php
/**
*
* donate.php [French]
*
* @package Paypal Donation MOD
* @copyright (c) 2013 Skouat
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
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	// Notice
	'DONATION_DISABLED'				=> 'Désolé, la page des Dons n’est pas disponible.',
	'DONATION_NOT_INSTALLED'		=> 'Des entrées dans la base de données pour le MOD <strong>Paypal Donation</strong> sont manquantes.<br />Merci de lancer à nouveau le %sfichier d’installation%s pour corriger le problème.',
	'DONATION_INSTALL_MISSING'		=> 'Le fichier d’installation semble être manquant. Veuillez vérifier votre installation !',
	'DONATION_ADDRESS_MISSING'		=> 'Désolé, Paypal Donation est activé mais certains paramètres sont manquants. Merci de contacter l’administrateur du forum.',
	'SANDBOX_ADDRESS_MISSING'		=> 'Désolé, Paypal Sandbox est activé mais certains paramètres sont manquants. Merci de contacter l’administrateur du forum.',

	// Image alternative text
	'IMG_DONATE'			=> 'donation',
	'IMG_LOADER'			=> 'chargement',

	// Default Currency
	'CURRENCY_DEFAULT'		=> 'EUR', // Note : Si depuis l’ACP vous supprimez toutes les devises, cette valeur sera définie comme valeur par défaut.

	// Stats
	//--------------------------->	%1$d = donation raised; %2$s = currency
	'DONATE_RECEIVED'			=> 'Nous avons reçu <strong>%1$d</strong> %2$s de dons.',
	'DONATE_NOT_RECEIVED'		=> 'Nous n’avons pas encore reçu de dons.',

	//--------------------------->	%1$d = donation goal; %2$s = currency
	'DONATE_GOAL_RAISE'			=> 'Notre objectif est d’obtenir <strong>%1$d</strong> %2$s.',
	'DONATE_GOAL_REACHED'		=> 'L’objectif de don a été atteint.',
	'DONATE_NO_GOAL'			=> 'Nous n’avons pas défini d’objectif de dons à atteindre.',

	//--------------------------->	%1$d = donation used; %2$s = currency; %3$d = donation raised;
	'DONATE_USED'				=> 'Les dons ont été utilisé à hauteur de <strong>%1$d</strong> %2$s des <strong>%3$d</strong> %2$s déjà reçus.',
	'DONATE_USED_EXCEEDED'		=> 'Nous avons utilisé <strong>%1$d</strong> %2$s. Tous les dons ont été utilisés.',
	'DONATE_NOT_USED'			=> 'Les dons n’ont pas été utilisés.',

	// Pages
	'DONATION_TITLE'			=> 'Faire un don',
	'DONATION_TITLE_HEAD'		=> 'Faire un don pour',
	'DONATION_CANCEL_TITLE'		=> 'Dons Annulés',
	'DONATION_SUCCESS_TITLE'	=> 'Dons Validés',
	'DONATION_CONTACT_PAYPAL'	=> 'Connexion à Paypal - Merci de patienter…',
	'SANDBOX_TITLE'				=> 'Tester Paypal Donation avec Paypal Sandbox',

	'DONATION_INDEX'			=> 'Faire un don',
));

/*
* UMIL
*/
$lang = array_merge($lang, array(
	'INSTALL_DONATION_MOD'				=> 'Installer Donation Mod',
	'INSTALL_DONATION_MOD_CONFIRM'		=> 'Êtes-vous prêt à installer Paypal Donation Mod ?',
	'INSTALL_DONATION_MOD_WELCOME'		=> 'Changements majeurs depuis la version 1.0.3',
	'INSTALL_DONATION_MOD_WELCOME_NOTE'	=> 'Les clés de langue utilisées par la fonctionnalité « Donation pages » ont été migrées dans la base de données.
											<br />Si vous utilisez cette fonctionnalité, sauvegardez vos fichiers de langue avant de mettre à jour le MOD vers cette nouvelle version.
											<br /><br />Une nouvelle permission a été ajoutée.
											<br />N’oubliez pas de paramètrer cette nouvelle permission en allant dans <strong>ACP >> Permissions >> Permissions globles >> Permissions des utilisateurs</strong>
											<br />Pour autoriser les invités à faire un don, cochez la case « Sélectionner l’utilisateur invité »',

	'DONATION_MOD'						=> 'Paypal Donation Mod',
	'DONATION_MOD_EXPLAIN'				=> 'UMIL effectuera automatiquement, dans la base de données, tous les changements nécessaires pour le MOD Paypal Donation.',

	'UNINSTALL_DONATION_MOD'			=> 'Désinstaller Paypal Donation Mod',
	'UNINSTALL_DONATION_MOD_CONFIRM'	=> 'Êtes-vous prêt à désinstaller Paypal Donation Mod ? Tous les réglages et données sauvegardées par ce MOD seront supprimés !',

	'UPDATE_DONATION_MOD'				=> 'Mettre à jour Paypal Donation Mod',
	'UPDATE_DONATION_MOD_CONFIRM'		=> 'Êtes-vous prêt à mettre à jour Paypal Donation Mod ?',

	'UNUSED_LANG_FILES_TRUE'			=> 'Suppression des fichiers non utilisés.',
	'UNUSED_LANG_FILES_FALSE'			=> 'La suppression des fichiers non utilisés n’est pas nécessaire.',
));
?>