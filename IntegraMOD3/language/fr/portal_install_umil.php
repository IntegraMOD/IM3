<?php
/**
*
* @package install
* @version $Id: portal_install.php 1.0.19
* @copyright (c) 2005 phpbBB Group
* @copyright (c) 2005 phpbireland
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

	'KISS_PORTAL_ENGINE' 		=> 'Moteur du portail Kiss',
	'STARGATE_PORTAL_EXPLAIN' 	=> 'Version simplifiée du portail Stargate pour phpBB3 avec des fonctionnalités de base, toutes configurables via l’ACP.',

	'NONE'				=> 'Non installé',
	'INSTALL_PANEL'		=> 'Panneau d’installation du portail Stargate',
	'SUB_INTRO'			=> 'Introduction',
	'OVERVIEW_BODY'		=> '<p><strong>Ce code est une refonte du code d’installation de phpBB &copy; phpBB 2000, 2002, 2005, 2007 Groupe phpBB, afin de faciliter l’installation du portail Stargate...</strong></p><hr /><br /><strong>Bienvenue dans notre version pré-test du portail Stargate RC1 (Édition Prometheus) <img src="./../portal/portal_install.png" alt="" border="none"></strong><br /><br />Si vous effectuez une <b>mise à niveau</b>, veuillez exécuter le script remove_portal.php avant de continuer... (Voir portal/Read_Me_First.txt)<br /><br />Cette version est destinée à une utilisation à plus grande échelle afin de nous aider à identifier les derniers bugs et zones problématiques.<br />Veuillez lire <a href="../portal/docs/install.html"><b>notre guide d’installation</b></a> pour plus d’informations sur l’installation du portail Stargate.</p><p><strong style="text-transform: uppercase;"><br />Remarque :</strong> cette version est <strong style="text-transform: uppercase;">un produit bêta</strong>. Vous préférerez peut-être attendre la version finale complète avant de l’utiliser en production.</p><p>Ce système d’installation vous guidera tout au long du processus d’installation du portail et de mise à jour vers la dernière version.<br />Pour plus d’informations sur chaque option, sélectionnez-la dans le menu ci-dessus.<br />',
	'SELECT_LANG'		=> 'Sélectionner la langue',
	'SUPPORT_BODY'		=> 'Pendant la phase bêta, une assistance complète sera fournie sur <a href="http://www.phpbbireland.com/phpBB3/">phpbbireland</a>. Nous fournirons des réponses aux questions générales de configuration, aux problèmes de configuration, aux problèmes de conversion et une aide pour identifier les problèmes courants principalement liés aux bugs. Nous autorisons également les discussions sur les modifications et les ajouts de code/style personnalisés.</p><p>Pour une assistance supplémentaire concernant le portail Stargate, contactez le <a href="http://www.phpbbireland.com/phpBB3/">site de développement phpbbireland</a>.</p><p>Pour obtenir de l’aide sur phpBB, veuillez consulter le <a href="http://www.phpbb.com/support/documentation/3.0/quickstart/">Guide de démarrage rapide</a> et <a href="http://www.phpbb.com/support/documentation/3.0/">la documentation en ligne</a>.</p><p>Pour vous assurer de rester à jour, veuillez visiter le <a href="http://www.phpbbireland.com/portal/">site de développement</a> ou vous abonner à notre <a href="http://www.phpbbireland.com/support/">liste de diffusion</a>...',
	'SUB_SUPPORT'		=> 'Support',
	'REPORT_INSTALLED'	=> 'Le portail est déjà installé',
	'INSTALL_INTRO'		=> 'Bienvenue dans l’installation du portail Stargate <img src="./../portal/portal_install.png" alt="" border="none">',


	'VERSION_NOT_UP_TO_DATE'	=> 'Votre version du portail n’est pas à jour. Veuillez poursuivre le processus de mise à jour.',
	'VERSION_NOT_UP_TO_DATE'	=> 'Impossible de récupérer les informations de version... code pas encore écrit.',
	'VERSION_CHECK'				=> 'Vérification de la version',
	'VERSION_CHECK_EXPLAIN'		=> 'Vérifie si la version du portail que vous utilisez actuellement est à jour.',
	'CURRENT_VERSION'			=> 'Version actuelle',
	'LATEST_VERSION'			=> 'Dernière version',

));

