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
	'DONATION_DISABLED'				=> 'Désolé, la page de dons est actuellement indisponible.',
	'DONATION_NOT_INSTALLED'		=> 'Les entrées de la base de données du mod Paypal Donation sont manquantes.<br />Veuillez exécuter l\'%sinstallateur%s pour appliquer les modifications de base de données pour le MOD.',
	'DONATION_INSTALL_MISSING'		=> 'Le fichier d\'installation semble manquer. Veuillez vérifier votre installation !',
	'DONATION_ADDRESS_MISSING'		=> 'Désolé, Paypal Donation est activé mais certains paramètres sont manquants. Veuillez en informer le fondateur du forum.',
	'SANDBOX_ADDRESS_MISSING'		=> 'Désolé, Paypal Sandbox est activé mais certains paramètres sont manquants. Veuillez en informer le fondateur du forum.',

	// Image alternative text
	'IMG_DONATE'			=> 'don',
	'IMG_LOADER'			=> 'chargement',

	// Default Currency
	'CURRENCY_DEFAULT'		=> 'USD', // Note : If you remove from ACP ALL currencies, this value will be defined as the default currency.

	// Stats
	//--------------------------->	%1$d = donation raised; %2$s = currency
	'DONATE_RECEIVED'			=> 'Nous avons reçu <strong>%1$d</strong> %2$s en dons.',
	'DONATE_NOT_RECEIVED'		=> 'Nous n\'avons reçu aucun don.',

	//--------------------------->	%1$d = donation goal; %2$s = currency
	'DONATE_GOAL_RAISE'			=> 'Notre objectif est de récolter <strong>%1$d</strong> %2$s.',
	'DONATE_GOAL_REACHED'		=> 'L\'objectif de dons a été atteint.',
	'DONATE_NO_GOAL'			=> 'Nous n\'avons pas défini d\'objectif de dons.',

	//--------------------------->	%1$d = donation used; %2$s = currency; %3$d = donation raised;
	'DONATE_USED'				=> 'Nous avons utilisé <strong>%1$d</strong> %2$s des <strong>%3$d</strong> %2$s de dons déjà reçus.',
	'DONATE_USED_EXCEEDED'		=> 'Nous avons utilisé <strong>%1$d</strong> %2$s. Tous vos dons ont été utilisés.',
	'DONATE_NOT_USED'			=> 'Nous n\'avons utilisé aucun don.',

	// Pages
	'DONATION_TITLE'			=> 'Faire un don',
	'DONATION_TITLE_HEAD'		=> 'Faire un don à',
	'DONATION_CANCEL_TITLE'		=> 'Don annulé',
	'DONATION_SUCCESS_TITLE'	=> 'Don effectué avec succès',
	'DONATION_CONTACT_PAYPAL'	=> 'Connexion à PayPal - veuillez patienter…',
	'SANDBOX_TITLE'				=> 'Tester le don PayPal avec PayPal Sandbox',

	'DONATION_INDEX'			=> 'Dons',
));

/*
* UMIL
*/
$lang = array_merge($lang, array(
	'INSTALL_DONATION_MOD'				=> 'Installer le mod Donation',
	'INSTALL_DONATION_MOD_CONFIRM'		=> 'Êtes‑vous prêt à installer le mod Donation ?',
	'INSTALL_DONATION_MOD_WELCOME'		=> 'Changements majeurs depuis la version 1.0.3',
	'INSTALL_DONATION_MOD_WELCOME_NOTE'	=> 'Les clés de langue utilisées par les pages de dons ont été migrées dans la base de données.
											<br />Si vous utilisez cette fonctionnalité, sauvegardez vos fichiers de langue avant de mettre à jour le MOD vers cette nouvelle version.
											<br /><br />Une nouvelle permission a été ajoutée.
											<br />N\'oubliez pas de configurer cette nouvelle permission dans <strong>ACP >> Permissions >> Global permissions >> User permissions</strong>
											<br />Pour permettre aux invités d\'effectuer un don, cochez la case "Select anonymous user".',

	'DONATION_MOD'						=> 'Donation Mod',
	'DONATION_MOD_EXPLAIN'				=> 'Installer les modifications de base de données du Donation Mod avec la méthode automatique UMIL.',

	'UNINSTALL_DONATION_MOD'			=> 'Désinstaller Donation Mod',
	'UNINSTALL_DONATION_MOD_CONFIRM'	=> 'Êtes‑vous prêt à désinstaller le Donation Mod ? Toutes les configurations et données enregistrées par ce mod seront supprimées !',

	'UPDATE_DONATION_MOD'				=> 'Mettre à jour Donation Mod',
	'UPDATE_DONATION_MOD_CONFIRM'		=> 'Êtes‑vous prêt à mettre à jour le Donation Mod ?',

	'UNUSED_LANG_FILES_TRUE'			=> 'Suppression des fichiers de langue inutilisés.',
	'UNUSED_LANG_FILES_FALSE'			=> 'La suppression des fichiers inutilisés n\'est pas nécessaire.',
));
