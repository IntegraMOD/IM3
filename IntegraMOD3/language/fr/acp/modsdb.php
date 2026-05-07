<?php
/** 
*
* acp_modsdb [English]
*
* @package language
* @version $Id:modsdb.php,v 1.0 2007/08/20 lefty74 Exp $
* @copyright (c) 2007 lefty74 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
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

// Bot settings
$lang = array_merge($lang, array(
	'MODS_DATABASE'				=> 	'Gérer la base de données des mods',
	'MODS_DATABASE_EXPLAIN'		=> 	'Vous pouvez gérer ici votre base de données des mods. Ajouter, modifier ou supprimer des mods de la base de données.',
	'MODS_SHOW'					=> 	'Affichage de la base de données des mods',
	'MODS_SHOW_EXPLAIN'			=> 	'Afficher la base de données des mods à :',
	'MOD_ADD'					=> 	'Ajouter un mod',
	'MOD_ADDED'					=> 	'Nouveau mod ajouté avec succès.',
	'MOD_COMMENTS'				=>	'Commentaires',
	'MOD_COMMENTS_EXPLAIN'		=>	'Vous pouvez ici ajouter des commentaires supplémentaires, comme vos personnalisations du mod, etc.',
	'MOD_DELETED'				=> 	'Mod supprimé avec succès.',
	'MOD_EDIT'					=> 	'Modifier les mods',
	'MOD_ADD_INFO'				=> 	'Informations supplémentaires',
	'MOD_EDIT_EXPLAIN'			=> 	'Vous pouvez ici ajouter ou modifier une entrée de mod existante. Le titre et le numéro de version sont requis. Vous pourrez également indiquer où le mod peut être téléchargé et où il peut être trouvé.',

	'MOD_INSTALL_DATE'			=> 	'Date d’installation',
	'MOD_INSTALL_DATE_EXPLAIN'	=> 	'Date à laquelle vous avez installé ce mod (Remarque : une saisie partielle des champs de date ne sera pas enregistrée)',

	'MOD_NAME_TAKEN'			=> 	'Le titre est déjà utilisé dans la base de données des mods et ne peut pas être réutilisé.',
	'MOD_UPDATED'				=> 	'Mod existant mis à jour avec succès.',
	'MOD_PHPBB_VERSION'			=>	'Version de phpBB',
	'MOD_PHPBB_VERSION_EXPLAIN'	=>	'Saisissez la version de phpBB pour laquelle ce mod est conçu, par ex. 3.0 RC5',

	'ERR_MOD_NO_MATCHES'		=> 	'Vous devez au minimum fournir le titre et la version du mod pour cette entrée.',

	'NO_MOD'					=> 	'Aucun mod trouvé avec l’ID spécifié.',

	'MOD_TITLE'					=>	'Titre du mod',
	'MOD_VERSION'				=>	'Version',
	'MOD_VERSION_TYPE'			=>	'Type de version',
	'MOD_VERSION_TYPE_EXPLAIN'	=>	'Bêta, Alpha, Dev ou RC*',
	'MOD_DESC'					=>	'Description',
	'MOD_AUTHOR'				=>	'Auteur',
	'MOD_AUTHOR_EMAIL'			=>	'E-mail de l’auteur',
	'MOD_AUTHOR_EMAIL_EXPLAIN'	=>	'Inclure l’e-mail de l’auteur si disponible (rend le nom de l’auteur cliquable en mailto:)',
	'MOD_URL'					=>	'URL',
	'MOD_DOWNLOAD'				=>	'Téléchargement',
	'MOD_ACCESS'				=>	'Afficher le mod uniquement aux administrateurs',
	
));

