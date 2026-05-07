<?php

/**
*
* @mod package		Download Mod 6
* @file				permissions_dl_mod.php 1 2011/03/09 OXPUS
* @copyright		(c) 2005 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* Language pack for MOD permissions [English]
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

// Adding new category
$lang['permission_cat']['downloads'] = 'Panneau de téléchargement';

// Download MOD Permissions
$lang = array_merge($lang, array(
	'acl_a_dl_overview'		=> array('lang' => 'Peut voir l’écran d’accueil', 'cat' => 'downloads'),
	'acl_a_dl_config'		=> array('lang' => 'Peut gérer les paramètres généraux', 'cat' => 'downloads'),
	'acl_a_dl_traffic'		=> array('lang' => 'Peut gérer le trafic', 'cat' => 'downloads'),
	'acl_a_dl_categories'	=> array('lang' => 'Peut gérer les catégories', 'cat' => 'downloads'),
	'acl_a_dl_files'		=> array('lang' => 'Peut gérer les téléchargements', 'cat' => 'downloads'),
	'acl_a_dl_permissions'	=> array('lang' => 'Peut gérer les permissions', 'cat' => 'downloads'),
	'acl_a_dl_stats'		=> array('lang' => 'Peut voir et gérer les statistiques', 'cat' => 'downloads'),
	'acl_a_dl_banlist'		=> array('lang' => 'Peut gérer la liste de bannissement', 'cat' => 'downloads'),
	'acl_a_dl_blacklist'	=> array('lang' => 'Peut gérer la liste noire des extensions de fichiers', 'cat' => 'downloads'),
	'acl_a_dl_toolbox'		=> array('lang' => 'Peut utiliser la boîte à outils', 'cat' => 'downloads'),
	'acl_a_dl_fields'		=> array('lang' => 'Peut gérer les champs définis par l’utilisateur', 'cat' => 'downloads'),
	'acl_a_dl_browser'		=> array('lang' => 'Peut gérer les agents utilisateurs', 'cat' => 'downloads'),
));


