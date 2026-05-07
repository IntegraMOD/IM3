<?php
/**
*
* @package Kiss Portal Engine (acp_k_portal) (English)
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


	'BLOCK_DEFAULT'					=> 'Par défaut',
	'BLOCK_FIVE_COLUMN'				=> 'Cinq colonnes',
	'BLOCK_FOUR_COLUMN'				=> 'Quatre colonnes',
	'BLOCK_THREE_COLUMN'			=> 'Trois colonnes',
	'BLOCK_TWO_COLUMN'				=> 'Deux colonnes',
	'BLOCKS_UPDATED'				=> 'Informations du portail mises à jour',
	'BLOCKS_UPDATE_FILES'			=> 'Mettre à jour les fichiers',

	'HEADER_MENU'					=> 'Menu d’en-tête',

	'PORTAL' 						=> 'Portail',
	'PORTAL_MAIN'					=> 'Configuration principale du portail/blocs',
	'PORTAL_BLOCKS_WIDTH' 			=> 'Largeur des blocs (blocs gauche et droite)',
	'PORTAL_BLOCKS_LEFT_ENABLED' 	=> 'Activer les blocs de gauche',
	'PORTAL_BLOCKS_RIGHT_ENABLED' 	=> 'Activer les blocs de droite',
	'PORTAL_SCROLL_RECENT'			=> 'Autoriser le défilement',
	'PORTAL_SCROLL_LINKS'			=> 'Faire défiler les liens',
	'PORTAL_SET_LAYOUT_NEW'			=> '*Définir la mise en page/style des blocs pour la page d’accueil (nouvelle option)',
	'PORTAL_SET_LAYOUT'				=> '*Définir la mise en page/style des blocs pour le site (option par défaut)',

	'PBLOCK_HEADER'			=> 'Gestionnaire de blocs du portail Stargate (alias Kiss) (développement futur !) ',
	'PBLOCK_NAME'			=> 'Nom du bloc',
	'PBLOCK_CLASS'			=> 'Classe',
	'PBLOCK_APPROVED'		=> 'Approuvé',
	'PBLOCK_AUTHOR'			=> 'Auteur',
	'PBLOCK_VERSION'		=> 'Révision',
	'PBLOCK_DATE'			=> 'Date',
	'PBLOCK_UPDATE'			=> 'Mettre à jour',
	'PBLOCK_SITE'			=> 'Site',

	'TITLE' 			=> 'Informations du portail',
	'TITLE_EXPLAIN'		=> 'Détails étendus des blocs installés... Auteur, révision, site/liens, etc.',

));

