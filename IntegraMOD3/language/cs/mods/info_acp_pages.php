<?php
/**
*
* Static Pages MOD language file [Czech]
*
* @version $Id$
* @copyright (c) 2009 Vojtěch Vondra
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

$lang = array_merge($lang, array(
	// Front-end keys
	'PAGE_ID_INVALID'			=> 'Vybraná stránka neexistuje.',
	'PAGE_NOT_FOUND'			=> 'Vybraná stránka nebyla nalezana.',
	
	// ACP keys
	'ACP_MANAGE_PAGES' => 'Spravovat stránky',
	'ACP_PAGES' => 'Statické stránky',
	'ACP_PAGES_EXPLAIN' => 'Zde můžete přidávat a spravovat statické stránky na vašem fóru.',
	'ADD_PAGE' => 'Přidat stránku',
	'GO_TO_PAGE' => 'Zobrazit stránku',
	'MUST_SELECT_PAGE' => 'Musíte vybrat stránku',
	'NO_PAGE_DESC' => 'Musíte zadat popis stránky.',
	'NO_PAGE_TITLE' => 'Musíte zadat název stránky.',
	'NO_PAGE_CONTENT' => 'Musíte zadat obsah stránky.',
	'PAGE'     => 'Stránka',
	'PAGES'     => 'Stránky',
	'PAGE_ADDED' => 'Stránka byla úspěšně přidána.',
	'PAGE_AUTHOR' => 'Autor stránky',
	'PAGE_CONTENT' => 'Obsah stránky',
	'PAGE_DESC' => 'Popis',
	'PAGE_DESC_EXPLAIN' => 'Toto je použito na dvou místech, zde v administraci pro rozpoznání stránek a v seznamu stránek.',
	'PAGE_DISPLAY' => 'Zobrazit stránku',
	'PAGE_DISPLAY_EXPLAIN' => 'Pokud je nastaveno na Ne, tato stránka nebude veřejně dostupná. Pouze moderátoři a administrátoři ji budou moci vidět.',
	'PAGE_DISPLAY_GUESTS' => 'Zobrazit stránku návštěvníkům',
	'PAGE_DISPLAY_GUESTS_EXPLAIN' => 'Pokud je nastaveno na Ne, pouze registrovaní uživatele mohou vidět tuto stránku.',
	'PAGE_HIDDEN' => 'Tato stránka je skryta, pouze moderátoři a administrátoři ji vidí. Stránku můžete zveřejnit v administraci.',
	'PAGE_LINK' => 'Odkaz na stránku',
	'PAGE_MAKE_HIDDEN' => 'Skrýt',
	'PAGE_MAKE_VISIBLE' => 'Zobrazit',
	'PAGE_NOT_VISIBLE' => 'Vybraná stránka je nyní skrytá.',
	'PAGE_ORDER' => 'Pořadí stránky',
	'PAGE_ORDER_EXPLAIN' => 'Pokud je zobrazen seznam stránek, stránky s nižším číslem jsou zobrazeny jako první.',
	'PAGE_TITLE' => 'Název stránky',
	'PAGE_UPDATED' => 'Stránka byla úspěšně upravena.',
	'PAGE_URL' => 'Identifikátor v URL',
	'PAGE_URL_EXPLAIN' => 'Použito v URL pro zobrázení stránky. Použijte malá písmena, čísla a pomlčku. Pokud jej nezadáte, systém vygeneruje identifikátor z názvu stránky.',
	'PAGE_VISIBLE' => 'Vybraná stránka je nyní veřejná.',
	'STATIC_PAGES_MOD_UPDATED' => '<strong>Static Pages MOD byl aktualizován na verzi » %s</strong>',
	'STATIC_PAGES_MOD_INSTALLED' => '<strong>Static Pages MOD byl instalován - verze » %s</strong>',
	
	// Log messages
	'LOG_PAGE_ADDED'	=> '<strong>Statická stránka přidána</strong><br />» %s',
	'LOG_PAGE_UPDATED'	=> '<strong>Statická stránka upravena</strong><br />» %s',
	'LOG_PAGE_REMOVED'	=> '<strong>Statická stránka odstraněna</strong><br />» %s',
	
	// Manage pages permission
	'acl_a_manage_pages'			=> array('lang' => 'Může přidávat, upravovat nebo mazat statické stránky', 'cat' => 'misc'),
));
?>