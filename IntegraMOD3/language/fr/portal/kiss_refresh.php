<?php
/**
*
* @package kiss refresh
* @version $Id$
* @copyright (c) 2005 phpbbireland
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
//- stargate aka kiss portal engine lang definitions -//
$lang = array_merge($lang, array(
	//SGP Refresh ALL
	'CACHE_PURGED'			=> '<br />&nbsp;&#187;&nbsp;Cache vidé !',
	'CACHE_DIR_CLEANED'		=> '<br />&nbsp;&#187;&nbsp;répertoire cache nettoyé.',
	'DISABSLE_USE'			=> '<br />&nbsp;&#187;&nbsp;Désactivé, utilisez l’actualisation dans l’ACP pour le moment...',
	'DATABASE_TABLE'		=> ' table de base de données !</b>',
	'FAILED_UPDATE'			=> '<br /><b>Échec de la mise à jour de ',
	'NO_INFO_FOUND'			=> '<br /><b>Aucune information trouvée dans ',
	'PURGING_CACHE'			=> '<b>Vidage du cache :</b>',
	'REFRESHED'				=> ' - <b>actualisé</b>',
	'REFRESHING_TEMPLATES'	=> '<b>Actualisation des modèles de styles :</b>',
	'REFRESHING_THEMES'		=> '<b>Actualisation des thèmes de styles :</b>',
	'REFRESHING_IMAGESETS'	=> '<b>Actualisation des jeux d’images des styles :</b>',
	'SGP_REFRESH_ALL'		=> '<strong>Kiss Refresh All - version : 1.0.1</strong>',
	'SGP_REFRESH_TITLE'		=> 'Tout actualiser (1.0.1)',
	'SGPRA_EXEPTIONS'		=> '<strong><span class="red">!NOTE :</span><br />SGP Refresh ALL terminé avec des exceptions !</strong> (voir ci-dessus pour les informations)<br />',
	'SGPRA_LOG_IN'			=> '<strong>connectez-vous</strong></a> en tant qu’<strong class="red">ADMINISTRATEUR</strong> et <strong class="green">actualisez</strong> cette page...<br /><br /><hr />',
	'SGPRA_NO_ADMIN'		=> '<strong class="red">Vous n’avez pas l’autorisation d’exécuter SGP Refresh ALL !</strong>',
	'SGPRA_NO_ERRORS'		=> '<br /><strong class="green">SGP Refresh ALL s’est terminé sans aucune erreur !...</strong><br />',

));

