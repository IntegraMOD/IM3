<?php
/** 
*
* acp_modsdb [French]
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
	'MODS_DATABASE_DETAIL'		=> 'Base de données des mods - Détail du mod',
	'MODS_DATABASE'				=> 'Base de données des mods',
	'MODS_DATABASE_EXPLAIN'		=> 'Vous pouvez gérer ici votre base de données des mods. Ajouter, modifier ou supprimer des mods dans la base de données.',

	'MOD_ADD'			=> 'Ajouter un mod',
	'MOD_ADDED'			=> 'Nouveau mod ajouté avec succès.',
	'MOD_DELETED'		=> 'Mod supprimé avec succès.',
	'MOD_DETAIL'		=> 'Détails du mod',
	'MOD_EDIT'			=> 'Modifier les mods',
	'MOD_EDIT_EXPLAIN'	=> 'Vous pouvez ici ajouter ou modifier une entrée de mod existante. Le titre et le numéro de version sont obligatoires. Vous pourrez également saisir les détails de l’endroit où le mod peut être téléchargé et où le mod lui-même peut être trouvé.',
	'BOT_NAME'			=> 'Nom du bot',
	'BOT_NAME_EXPLAIN'	=> 'Utilisé uniquement pour vos propres informations.',
	'MOD_NAME_TAKEN'	=> 'Le titre est déjà utilisé dans la base de données des mods et ne peut pas être réutilisé.',
	'MOD_UPDATED'		=> 'Mod existant mis à jour avec succès.',

	'ERR_MOD_NO_MATCHES'		=> 'Vous devez fournir au minimum le titre du mod et la version du mod pour cette entrée.',

	'NO_MOD'					=> 'Aucun mod trouvé avec l’ID spécifié.',

	'MOD_INSTALL_DATE'			=>	'Date d’installation du mod',
	'MOD_TITLE'					=>	'Titre du mod',
	'MOD_COMMENTS'				=>	'Commentaires',
	'MOD_PHPBB_VERSION'			=>	'Version phpBB',
	'MOD_VERSION'				=>	'Version',
	'MOD_VERSION_TYPE'			=>	'Type de version',
	'MOD_VERSION_TYPE_EXPLAIN'	=>	'Bêta, Alpha, Dev ou RC*',
	'MOD_DESC'					=>	'Description',
	'MOD_AUTHOR'				=>	'Auteur',
	'MOD_URL'					=>	'Emplacement',
	'VISIT_WEBSITE'				=>	'Lien URL où le mod est publié',
	'DOWNLOAD_MOD'				=>	'Lien URL où le mod peut être téléchargé',
	'LIST_MOD'					=>  '1 mod installé',
	'LIST_MODS'					=>  '%s mods installés',
	'SORT_MOD_TITLE'			=>  'SORT_MOD_TITLE',
	'SORT_MOD_VERSION'			=>  'SORT_MOD_VERSION',
	'SORT_MOD_VERSION'			=>  'SORT_MOD_VERSION',
	'SORT_MOD_AUTHOR'			=>  'SORT_MOD_AUTHOR',
	'WWW'						=>  'Site web',
	'DOWNLOAD'					=>  'Télécharger',
	
));

