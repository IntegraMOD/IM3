<?php
/**
*
* acp_portal_config [English]
*
* @package language
* @version $Id: k_config.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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

// phpbbportal profile fields
$lang = array_merge($lang, array(

	'IMOD' 					=> 'IntegraMod',
	'TITLE' 				=> 'Configuration principale d’IntegraMod',
	'TITLE_EXPLAIN'			=> 'Vous avez ici accès aux modifications contrôlées par IntegraMOD.',
	'IMOD_CONFIG_HEADING'	=> 'IntegraMOD',

	'IMOD_VERSION'			=> 'Version d’IntegraMod',
	'IMOD_ENABLED'			=> 'Désactiver/Activer IntegraMod',

	'IMOD_VERSION_EXPLAIN'	=> 'Il s’agit de la version actuellement installée.',
	'IMOD_ENABLED_EXPLAIN'	=> '0 (zéro) désactive, 1 active. Tous les autres nombres positifs activent avec les options de débogage.',
));

