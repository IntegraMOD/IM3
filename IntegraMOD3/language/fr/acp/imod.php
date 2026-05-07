<?php
/**
*
* acp_portal [English]
*
* @package language
* @version $Id: imod.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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

	'IMOD'				=> 'IntegraMod',
	'TITLE' 			=> 'Informations IntegraMod',
	'TITLE_EXPLAIN'		=> 'Détails étendus des blocs installés... Auteur, révision, site/liens, etc.',
	'IMOD_MAIN'			=> 'Configuration principale',
));
