<?php
/**
*
* @package Kiss Portal Engine (acp_k_config) (English)
*
* @package language
* @version $Id:$ 1.0.19
* @copyright (c) 2005-2011 Michael O'Toole (mike@phpbbireland.com)
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
// phpbbportal profile fields
$lang = array_merge($lang, array(

	'BLOCK_DEFAULT'		=> 'Par défaut',
	'BLOCK_FIVE_COLUMN'	=> 'Cinq colonnes',
	'BLOCK_FOUR_COLUMN'	=> 'Quatre colonnes',
	'BLOCK_THREE_COLUMN'	=> 'Trois colonnes',
	'BLOCK_TWO_COLUMN'	=> 'Deux colonnes',

	'BLOCKS_CONFIGURE'			=> 'Configurer les paramètres par défaut du portail',
	'BLOCKS_UPDATE_FILES'			=> 'Mettre à jour les fichiers',
	'BLOCKS_UPDATED'			=> 'Informations du portail mises à jour',
	'BLOCKS_UPDATE_FILES'			=> 'Générer les fichiers HTML',
	'BLOCKS_UPDATE_FILES_EXPLAIN'		=> 'Après avoir mis à jour tous vos blocs, vous pouvez créer ici les fichiers de mise en page HTML... Voir <b>Gérer/Modifier les blocs</b> pour ces paramètres',
	'BLOCKS_UPDATE_HTML_FILES'		=> 'Mettre à jour / créer les fichiers HTML des blocs',
	'BLOCKS_USE_EXTERNAL_FILES_EXPLAIN'	=> 'Vous pouvez utiliser des fichiers HTML externes ou des fichiers générés automatiquement',

	'CONFIG_SAVED'			=> 'Données de configuration enregistrées...',
	'GENERATE'			=> 'Créer les fichiers HTML des blocs',
	'HEADER_MENU'			=> 'Menu d’en-tête',
	'HEADER_MENU'			=> 'Menu d’en-tête',

	'PBLOCK_HEADER'			=> 'Stargate alias Kiss Portal Block Manager (Développement futur !) ',
	'PBLOCK_NAME'			=> 'Nom du bloc',
	'PBLOCK_CLASS'			=> 'Classe',
	'PBLOCK_APPROVED'		=> 'Approuvé',
	'PBLOCK_AUTHOR'			=> 'Auteur',
	'PBLOCK_VERSION'		=> 'Révision',
	'PBLOCK_DATE'			=> 'Date',
	'PBLOCK_UPDATE'			=> 'Mettre à jour',
	'PBLOCK_SITE'			=> 'Site',

	'PORTAL' 			=> 'Portail',

	'PORTAL_BLOCKS_CENTRE_ENABLED' 	=> 'Activer les blocs centraux du portail',
	'PORTAL_BLOCKS_ENABLED_EXPLAIN'	=> 'Activer tous les blocs, notez que les blocs peuvent être désactivés individuellement voir : Gérer/Modifier tous les blocs',
	'PORTAL_BLOCKS_LEFT_ENABLED' 	=> 'Activer les blocs à gauche du portail',
	'PORTAL_BLOCKS_RIGHT_ENABLED' 	=> 'Activer les blocs à droite du portail',
	'PORTAL_BLOCKS_ENABLED'		=> 'Blocs activés',
	'PORTAL_BLOCKS_WIDTH' 		=> 'Largeur des blocs (blocs gauche et droit)',
	'PORTAL_BLOCKS_WIDTH_EXPLAIN'	=> 'Les largeurs des autres blocs sont proportionnelles, c’est-à-dire que les blocs centraux occupent 100 % de l’espace disponible. Si vous affichez deux blocs au centre, ils feront environ 50 % chacun, trois blocs environ 33 %, etc.',
	'PORTAL_BUILD'			=> 'Version de build',
	'PORTAL_BUILD_EXPLAIN'		=> 'La version de build du portail.',
	'PORTAL_CONFIG_UPDATED'		=> 'Configuration du portail mise à jour !... ',
	'PORTAL_MAIN'			=> 'Bloc principal / configuration du portail',
	'PORTAL_SCROLL_RECENT'		=> 'Autoriser le défilement des sujets récents ',
	'PORTAL_SCROLL_LINKS'		=> 'Autoriser le défilement des liens',
	'PORTAL_SET_LAYOUT'		=> '*Définir la disposition/style des blocs pour le site (option par défaut)',
	'PORTAL_SET_LAYOUT_EXPLAIN'	=> 'Disposition par défaut Stargate alias Kiss Portal (voir les options de la liste déroulante).',
	'PORTAL_SET_LAYOUT_NEW'		=> '*Définir la disposition/style des blocs pour la page d’accueil (nouvelle option)',
	'PORTAL_SET_LAYOUT_NEW_EXPLAIN'	=> 'Nouvelle disposition pour la page actualités/bienvenue',
	'PORTAL_VERSION'		=> 'Version du portail',

	'TITLE' 	=> 'Configuration par défaut du portail',
	'TITLE_EXPLAIN'	=> 'Vous pouvez ici définir les paramètres par défaut des blocs du portail. Les éléments marqués d’un <strong>*</strong> sont en cours de développement ou prévus pour des évolutions futures.',
));

