<?php
/**
*
* @package Kiss Portal Engine (acp_k_resources) (English)
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

$lang = array_merge($lang, array(

	'ACP_K_RES_WORDS'			=> 'Ressources',
	'ACP_K_ADMIN_REFERRALS'		=> 'Gérer les mots des ressources',
	'ADD_VARIABLE'				=> 'Ajouter une variable',
	'CONFIG'					=> 'config',
	'DISABLE_MARKED'			=> 'Désactiver la sélection',
	'ENABLE_MARKED'				=> 'Activer la sélection',
	'ID'						=> 'ID',
	'K_CONFIG'					=> 'k_config',
	'LINE'						=> ', ligne ',
	'NA'						=> '...',
	'NEW'						=> 'Nouveau',
	'NEW_WORD'					=> 'Un nouveau mot',
	'NEW_WORD_ADD'				=> 'Ajouter un $ initial pour la variable',
	'NO_ITEMS_MARKED'			=> 'Aucun élément sélectionné.',
	'OPTION'					=> 'Option',
	'ORDER'						=> 'Ordre',
	'PROCESS_REPORT'			=> 'Rapport de traitement : %1$s',
	'PLEASE_CONFIRM'			=> 'Veuillez confirmer.',
	'PLEASE_CONFIRM_ADD'		=> 'Confirmer l’ajout du mot ?',
	'PLEASE_CONFIRM_UPDATE'		=> 'Mettre à jour les mots ?',
	'PLEASE_CONFIRM_DELETE'		=> 'Confirmer la suppression ?',

	'R'								=> 'Réservé',
	'REFERRALS_MANAGEMENT'			=> 'Gestion des référents.',
	'REFERRALS_MANAGEMENT_EXPLAIN'	=> 'Vous pouvez gérer ici les référents HTTP stockés dans votre base de données.',

	'REPORT'					=> 'Dernier rapport de traitement',
	'RESERVED'					=> 'Réservé',
	'RESERVED_WORDS'			=> 'Mot réservé',
	'SAVE_CURRENT'				=> 'Enregistrer l’actuel',
	'SELECT_FILTER'				=> 'Sélectionner un filtre',
	'SELECT_SORT_METHOD'		=> 'Sélectionner la méthode de tri',
	'SHOW_BOTH_TYPES'			=> 'Afficher les deux types',
	'SORT'						=> 'Trier',
	'SORT_ASCENDING'			=> 'Croissant',
	'SORT_DESCENDING'			=> 'Décroissant',
	'SWITCH'					=> 'Changer de type',
	'SWITCH_A'					=> 'Les deux',
	'SWITCH_R'					=> 'Réservé',
	'SWITCH_TO_WORDS'			=> 'Passer aux mots',
	'SWITCH_TO_VARIABLES'		=> 'Passer aux variables',
	'SWITCH_V'					=> 'Variables',
	'TABLE'						=> 'Table',
	'TYPE'						=> 'Type',
	'V'							=> 'Variable',
	'VAR'						=> 'Variable',
	'VARIABLE'					=> 'Une variable',
	'VAR_NAME'					=> 'Nom de la variable',
	'WORDS'						=> 'Réservé',
	'UNKNOWN'					=> 'Inconnu',
	'VAR_NOT_FOUND'				=> '<strong>%s</strong> n’est pas une variable de configuration valide... Ajout annulé !',
	'VAR_ADDED'					=> '<strong>%s</strong> ajouté !',

	'TITLE' 		=> 'Gestionnaire des variables du portail',
	'TITLE_EXPLAIN'	=> 'Méthode utilisée pour transmettre les variables aux pages/pages web...<br />Le portail remplace automatiquement les variables par leurs valeurs.<br />Seules les variables des tables $config et $k_config sont traitées...',
	'TITLE_ADD'		=> 'Ajouter une variable',
));


