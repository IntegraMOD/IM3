<?php
/**
*
* acp_imod_vars [English] (Additional variables used by portal)
*
* @package language
* @version $Id: imod_vars.php 297 2008-12-30 18:40:30Z Michaelo $
* @copyright (c) 2006 phpbbireland Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(

	'TITLE_MAIN' => 'General Portal Variable',
	'TITLE_BLOCK' => 'Portal Block Variable',

));

// Portal Menu Names + add you menu language variables here! //
$lang = array_merge($lang, array(
	'ACP'					=> 'Panneau admin',
	'ALBUM'					=> 'Album',
	'BOOKMARKS'				=> 'Favoris',
	'CATEGORIES'			=> 'Catégories',
	'SGP_Blog'				=> 'Blog intégré SGP',
	'DOWNLOADS'				=> 'Téléchargements',
	'FORUM'					=> 'Forum',
	'KB'					=> 'Base de connaissances',
	'LINKS'					=> 'Liens',
	'MEMBERS'				=> 'Membres',
	'PORTAL'				=> 'Portail',
	'RATINGS'				=> 'Dernières évaluations',
	'RULES'					=> 'Règles du portail',
	'SITE_NAVIGATOR'		=> 'Navigateur',
	'STATISTICS'			=> 'Statistiques',
	'SITE_RULES'			=> 'Règles du site',
	'SITE_STATISTICS'		=> 'Statistiques du site',
	'STAFF'					=> 'Équipe',
	'STYLES_DEMO'			=> 'Démo des styles',
	'STYLE_SELECT'			=> 'Sélection du style',
	'UCP'					=> 'Panneau utilisateur',
	'UNRESOLVED/BUGS'		=> 'Non résolus/Bugs',
	'UPLOAD'				=> 'Téléverser des images',
	'USER_INFORMATION'		=> 'Informations utilisateur',
	'WELCOME'				=> 'Bienvenue',
));

// Portal Block Names + add your block name language variables here! //
$lang = array_merge($lang, array(
	'ACP_SMALL'			=> 'Panneau admin',
	'ANNOUNCEMENTS'		=> 'Annonces',
	'BIRTHDAY'			=> 'Anniversaire',
	'BLOG'				=> 'Blog intégré SGP',
));


