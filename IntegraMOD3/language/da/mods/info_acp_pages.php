<?php
/**
*
* Static Pages Danish MOD language file
*
* @version $Id$
* @copyright (c) 2009 Vojtěch Vondra
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @author jask ( jan at skovsgaard dot net )
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

$lang = array_merge($lang, array(
	// Front-end keys
	'PAGE_ID_INVALID'			=> 'Den valgte side eksisterer ikke.',
	'PAGE_NOT_FOUND'			=> 'Den valgte side findes ikke.',
	
	// ACP keys
	'ACP_MANAGE_PAGES' => 'Sideadministration',
	'ACP_PAGES' => 'Sider',
	'ACP_PAGES_EXPLAIN' => 'Her tilføjer og ændrer du boardets statiske sider.',
	'ADD_PAGE' => 'Tilføj side',
	'GO_TO_PAGE' => 'Se siden',
	'MUST_SELECT_PAGE' => 'Du skal vælge en side.',
	'NO_PAGE_DESC' => 'Du har ikke angivet sidens beskrivelse.',
	'NO_PAGE_TITLE' => 'Du har ikke angivet sidens titel.',
	'NO_PAGE_CONTENT' => 'Du har ikke angivet sidens indhold.',
	'PAGE'     => 'Side',
	'PAGES'     => 'Sider',
	'PAGE_ADDED' => 'Siden blev tilføjet.',
	'PAGE_AUTHOR' => 'Sidens forfatter',
	'PAGE_CONTENT' => 'Sidens indhold',
	'PAGE_DESC' => 'Beskrivelse',
	'PAGE_DESC_EXPLAIN' => 'Denne anvendes flere steder. Her i ACP til at identificere dine sider, i det beskrivende meta tag når siden vises og i sidelisten når ingen side er valgt.',
	'PAGE_DISPLAY' => 'Vis side',
	'PAGE_DISPLAY_EXPLAIN' => 'Vælges nej, vises siden ikke offentligt. Administratorer og redaktører kan tilgå siden direkte.',
	'PAGE_HIDDEN' => 'Siden er skjult for alle andre end administratorer og redaktører. Du kan gøre den offentligt tilgængelig via ACP.',
	'PAGE_LINK' => 'Link til siden',
	'PAGE_MAKE_HIDDEN' => 'Skjul',
	'PAGE_MAKE_VISIBLE' => 'Synliggør',
	'PAGE_NOT_VISIBLE' => 'Den valgte side er nu ikke offentligt tilgængelig.',
	'PAGE_ORDER' => 'Sideorden',
	'PAGE_ORDER_EXPLAIN' => 'Vises en liste over sider, kan du her bestemme sorteringen ved at anføre et tal i feltet. Siderne sorteres stigende efter værdien i dette felt.',
	'PAGE_TITLE' => 'Sidens titel',
	'PAGE_UPDATED' => 'Siden blev opdateret.',
	'PAGE_URL' => 'URL identifier',
	'PAGE_URL_EXPLAIN' => 'Anvendes i URL\'en for at tilgå siden. Angiv kun små bogstaver, tal og bindestreger. Angives intet, danner systemet URL\'en udfra sidens titel.',
	'PAGE_VISIBLE' => 'Den valgte side vises nu.',
	'STATIC_PAGES_MOD_UPDATED' => '<strong>MODet Statiske sider opdateret til version » %s</strong>',
	'STATIC_PAGES_MOD_INSTALLED' => '<strong>MODet Statiske sider blev installeret - MOD version » %s</strong>',
	
	// Log messages
	'LOG_PAGE_ADDED'	=> '<strong>Statisk side tilføjet</strong><br />» %s',
	'LOG_PAGE_UPDATED'	=> '<strong>Statisk side opdateret</strong><br />» %s',
	'LOG_PAGE_REMOVED'	=> '<strong>Statisk side slettet</strong><br />» %s',
	
	// Manage pages permission
	'acl_a_manage_pages'			=> array('lang' => 'Kan oprette, ændre og slette statiske sider', 'cat' => 'misc'),
));
?>