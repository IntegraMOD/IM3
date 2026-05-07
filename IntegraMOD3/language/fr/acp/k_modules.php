<?php
/** 
*
* acp_k_modules [English] (Additional variables used by portal)
*
* @package {k_modules.php}
* @version $Id: k_modules.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//
// phpbbportal profile fields
$lang = array_merge($lang, array(
	
	'TITLE' => 'Données supplémentaires',
	'TITLE_EXPLAIN' => '<b>Gestionnaire de mini-mods :</b><br />Ce sont de petits mods utilisés pour afficher et gérer des informations supplémentaires, un bon exemple étant le mini-mod Message de bienvenue. Les mini-mods par défaut incluent : blocs, mods et styles...',

	'AUTHOR'						=> 'Auteur',
	'AUTHOR_EXPLAIN'				=> 'Le nom du créateur du bloc/mod/style.',
	//'AUTHOR_EXPLAIN'				=> 'Le nom de l’auteur original, ou de la personne qui supporte actuellement ce bloc/mod/style.',

	'AUTHOR_CO'						=> 'Porté par / Co-auteur',
	'AUTHOR_CO_EXPLAIN'				=> 'Varie selon le type de mod.',

	'AUTHOR_LINK'					=> 'Lien de l’auteur',
	'AUTHOR_LINK_EXPLAIN'			=> 'Généralement le lien de téléchargement original du bloc/mod/style.',

	'AUTHOR_LINK_2'					=> 'Lien de support',
	'AUTHOR_LINK_2_EXPLAIN'			=> 'Lien vers le site de support.',

	'MOD_FILENAME'					=> 'Nom du fichier (<strong>sans extension</strong>)',
	'MOD_FILENAME_EXPLAIN'			=> 'Aucun espace autorisé dans le nom de fichier (utilisé pour le téléchargement).',

	'AVAILABLE_STYLES'				=> 'Styles disponibles.',
	'AVAILABLE_STYLES_EXPLAIN'		=> 'Sélectionnez le style que vous souhaitez mettre à jour...',

	'AVAILABLE_TYPES'				=> 'Catégorie de minimod',
	'AVAILABLE_TYPES_EXPLAIN'		=> 'Sélectionnez une catégorie de minimod, ou utilisez le champ suivant pour en créer une nouvelle.',
	'NEW_TYPE'						=> 'Nom de la nouvelle catégorie',
	'NEW_TYPE_EXPLAIN'				=> 'Les catégories servent à regrouper les données des minimods.',

	'BMS_NAME'						=> 'Nom',
	'BMS_NAME_EXPLAIN'				=> 'Le nom du MiniMod.',
	'CONFIRM_OPERATION_MODULE'		=> 'Souhaitez-vous supprimer ce bloc de module ?',
	'COPYRIGHT'						=> 'Copyright',
	'COPYRIGHT_EXPLAIN'				=> 'Informations de copyright fournies par l’auteur.',
	'DELETE'						=> 'Supprimer',
	'DELETE_EXPLAIN'				=> 'Supprimer ce module',
	'DOWNLOADED'					=> 'Nombre de téléchargements',
	'DOWNLOADED_EXPLAIN'			=> 'Incrémenté automatiquement lors des clics de téléchargement.',
	'EDIT' 							=> 'Modifier',
	'EDIT_EXPLAIN'					=> 'Modifier le module',
	'ID'							=> 'ID',
	'ID_EXPLAIN'					=> 'ID du module (attribué automatiquement).',
	'IMAGE'							=> 'Miniature/Image pour ce mini-module',
	'IMAGE_EXPLAIN' 				=> 'Requis pour le message de bienvenue (chemin défini dans le template), également utilisé pour le développement des styles.',

	'INFO' 							=> 'Information',
	'INFO_EXPLAIN'					=> 'Informations à afficher',
	'INFO_1_EXPLAIN'  				=> 'Les informations que vous souhaitez afficher.',
	'INFO_2_EXPLAIN'  				=> '(code texte/html).',
	'LAST_UPDATED_EXPLAIN'			=> 'Exemple : Dim 12 Déc 2007, si laissé vide, la date du jour sera utilisée.',
	'LINK'							=> 'Lien',
	'LINK_EXPLAIN'					=> 'Lien vers le site de développement.',
	'MODULES_TYPE'					=> 'Ajout d’un nouveau mini-module portail',
	'MOD_HEADER_ADMIN'				=> 'Gérer les mini-mods du portail ',
	'MOD_NAME'						=> 'Nom du mod',
	'MOD_ORIGIN'					=> 'Origine',
	'MOD_ORIGIN_EXPLAIN'			=> 'Mini-mod/style/bloc de l’équipe/membres SGP ?',
	'MOD_TYPE'						=> 'Type de mod',
	'MOD_INFO'						=> 'Détails du mod',
	'MUST_SELECT_VALID_MODULE_DATA' => 'ID K_Module invalide.',	
	'NAME_EXPLAIN'					=> 'Le nom du mini-module.',	
	'UNIQUE'						=> 'Unique',
	'SELECT_EDIT_TO_VIEW'			=> '<span style="font-style:italic">Sélectionnez modifier pour voir ce code...</span>',
	'STATUS'						=> 'Statut (% complété)',
	'STATUS_EXPLAIN'				=> 'Entrez 1 à 100, ou 0 pour désactiver le traitement de ce mod.',
	'TYPE'							=> 'Type de mini-mod',
	'TYPE_EXPLAIN'					=> 'bloc/mod/style (vous pouvez ajouter vos propres types).',
	'WELCOME_MESSAGE_EDITOR'		=> 'Éditeur de message de bienvenue',
	'WELCOME'						=> 'Message de bienvenue',
	'WELCOME_EXPLAIN'				=> 'Le module de message de bienvenue ne peut pas être supprimé...',
	'ACTIVE_STYLES'					=> 'Styles disponibles',
	'ACTIVE_STYLES_EXPLAIN'			=> 'Liste des styles non encore ajoutés.',
	'ID_TO_USE'						=> 'Lien vers ID',
	'ID_TO_USE_EXPLAIN'				=> 'Si applicable, cet ID est attribué automatiquement.',
	'MOD_VERSION'					=> 'Version',
	'MOD_VERSION_EXPLAIN'			=> 'Le numéro de révision du mod/mini-mod',
	'EDIT_WELCOME_MESSAGE'			=> 'Modifier le message de bienvenue',
	'MODULE_BLOCK_DELETED'			=> 'Bloc de module supprimé',

	'MODULES_BLOCK_ADDED'			=> 'Bloc de modules ajouté',
	'DO_NOT_CHANGE'					=> '<br />Type par défaut, non modifiable',
	'CANT_DELETE'					=> 'Vous ne pouvez pas supprimer le message de bienvenue',
	'WELCOME'						=> 'bienvenue',
	'NO_NAME_NO_TYPE'				=> 'Nom ou type de module manquant...',

));

