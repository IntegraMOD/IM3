<?php
/**
*
* @package Kiss Portal Engine (acp_k_pages) (English)
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
	'ACP_PAGES'					=> 'Pages phpBB actuelles.',
	'ACP_K_PAGES'				=> 'Pages phpBB',
	'ACP_K_PAGES_LAND'			=> 'Définir la page de destination',
	'ACP_K_PAGES_MANAGE'		=> 'Gérer les pages phpBB',
	'ACP_K_RESOURCES'			=> 'Ressources du portail',
	'ACP_K_RESOURCES'			=> 'Gérer les ressources du portail',
	'ADD_PAGE'					=> 'Ajouter une page',
	'ADDING_PAGES'				=> 'Page ajoutée... ',
	'CONFIG_PAGES'				=> 'Configurer les pages',
	'DELETE_FROM_LIST'			=> 'Supprimer cette page de la liste ?',
	'ERROR_PORTAL_PAGES'		=> 'Erreur ! suppression de cette page de la liste de la base de données',
	'FOLDER_ADDED'              => 'Liste des répertoires de mod mise à jour...',
	'ID'						=> 'ID',
	'LAND'                      => 'Définir la page par défaut à charger après la connexion.',
	'LANDING_PAGE'				=> 'Page de destination',
	'LANDING_PAGE_EXPLAIN'		=> 'Revenir à cette page après une connexion réussie.',
	'LANDING_PAGE_SET'			=> 'Page de destination définie',
	'LINE'						=> ', ligne ',
	'MANAGE_PAGES'				=> 'Gérer les pages',
	'MOD_FOLDERS'               => 'Dossier(s) de mod à rechercher',
	'MOD_FOLDERS_EXPLAIN'       => 'Liste séparée par des virgules (sans espaces)... Soumettez pour l’ajouter à la liste déroulante',
	'NO_FILES_FOUND'			=> 'La liste déroulante est indisponible car aucun fichier n’est disponible à ajouter...',
	'NO_MOD_FOLDER'             => 'Le dossier que vous essayez d’ajouter est introuvable : root/',
	'PAGE_NAME'					=> 'Pages phpBB actuelles',
	'PAGE_NAME_EXPLAIN'			=> 'Les blocs peuvent être affichés sur ces pages.',
	'PAGE_NEW_FILENAME'			=> 'Ajouter ce fichier (page) à la liste',
	'PAGE_NEW_FILENAME_EXPLAIN'	=> 'Sélectionnez un fichier (page) dans la liste déroulante puis cliquez sur Soumettre...',
	'REMOVING_PAGES'			=> 'Page supprimée... ',
	'SWITCHING'					=> 'Basculement vers k_pages',
	'TRAILING_COMMA'            => 'Virgule finale supprimée de la liste des dossiers de mod...',
	'TITLE_PAGES'               => 'Pages phpBB',
	'TITLE_EXPLAIN_PAGES'		=> '&bull; Les blocs peuvent être affichés sur des pages valides, y compris phpBB, les pages de mods et les pages web...<br />
	&bull; Pour faciliter cette action, nous fournissons une méthode permettant d’ajouter des pages supplémentaires (fichiers) depuis root/mod_directory.<br />
	&bull; Une fois une page ajoutée, elle sera disponible dans la disposition des blocs.<br />
	&bull; Les pages de mods sont enregistrées sous forme de chaîne séparée par des virgules (sans espaces, sans virgule finale)...<br />
	<br />Remarque : les pages de mods doivent fournir le code nécessaire pour permettre les blocs (facile à ajouter si vous le souhaitez)...',
));

