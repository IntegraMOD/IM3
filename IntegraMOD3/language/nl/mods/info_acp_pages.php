<?php
/**
*
* Static Pages MOD language file [Dutch]
*
* @author Erik Frèrejean
*
* @version $Id$
* @original copyright (c) 2009 Vojtěch Vondra
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
    'PAGE_ID_INVALID'            => 'De geselecteerde pagina bestaat niet.',
    'PAGE_NOT_FOUND'            => 'De geselecteerde pagina is niet gevonden.',

    // ACP keys
    'ACP_MANAGE_PAGES' => 'Beheer paginas',
    'ACP_PAGES' => 'Paginas',
    'ACP_PAGES_EXPLAIN' => 'Hier kun je statische paginas aan je forum toevoegen toevoegen en deze bewerken.',
    'ADD_PAGE' => 'Voeg pagina toe',
    'GO_TO_PAGE' => 'Bekijk de pagina',
    'MUST_SELECT_PAGE' => 'Je moet een pagina selecteren',
    'NO_PAGE_DESC' => 'Je hebt geen pagina beschrijving opgegeven.',
    'NO_PAGE_TITLE' => 'Je hebt geen pagina titel opgegeven.',
    'NO_PAGE_CONTENT' => 'Je hebt geen pagina inhoud opgegeven.',
    'PAGE'     => 'Pagina',
    'PAGES'     => 'Pagina\'s',
    'PAGE_ADDED' => 'De pagina was successvol toegevoegd.',
    'PAGE_AUTHOR' => 'Pagina autheur',
    'PAGE_CONTENT' => 'Pagina inhoud',
    'PAGE_DESC' => 'Beschrijving',
    'PAGE_DESC_EXPLAIN' => 'Dit is gebruikt in meerdere plaatsen, hier in het ACP om je pagina\'s te herkennen, in de "description" meta tag op de eigenlijke pagina en in de pagina lijst als er geen andere pagina is geselecteerd',
    'PAGE_DISPLAY' => 'Laat de pagina zien',
    'PAGE_DISPLAY_EXPLAIN' => 'Als deze waarde op nee staat is de pagina niet publiekelijk toegankelijk. Beheerders en moderatoren kunnen de pagina altijd bekijken.',
		'PAGE_DISPLAY_GUESTS' => 'Pagina aan gasten laten zien',
		'PAGE_DISPLAY_GUESTS_EXPLAIN' => 'Indien nee, kunnen alleen geregistreerde gebruikers deze pagina zien.',
		'PAGE_HIDDEN' => 'Deze pagina is verborgen, alleen beheerders en moderatoren kunnen hem zien. Je kan hem activeren via het ACP.',
    'PAGE_LINK' => 'Pagina link',
    'PAGE_MAKE_HIDDEN' => 'Verberg',
    'PAGE_MAKE_VISIBLE' => 'Maak zichtbaar',
    'PAGE_NOT_VISIBLE' => 'De geselecteerde pagina is nu verborgen voor publiek.',
    'PAGE_ORDER' => 'Pagina volgorde',
    'PAGE_ORDER_EXPLAIN' => 'Als een lijst met paginas is weergegeven kan je de volgorde van deze lijst hier bepalen door het zetten van een nummer hier. Pagina\'s worden oplopend gesorteerd aan de hand van dit veld.',
    'PAGE_TITLE' => 'Pagina titel',
    'PAGE_UPDATED' => 'De pagina was successvol aangepast.',
    'PAGE_URL' => 'Pagina URL',
    'PAGE_URL_EXPLAIN' => 'Gebruikt als de URL om deze pagina te berijken, gebruik kleine letters, cijfers en streepjes. Als dit wordt leeg gelaten zal het systeem een URL genereren.',
    'PAGE_VISIBLE' => 'De geselecteerde pagina wordt nu weergegeven',
    'STATIC_PAGES_MOD_UPDATED' => '<strong>Static page MOD is geupdate naar versie » %s</strong>',
    'STATIC_PAGES_MOD_INSTALLED' => '<strong>Static page MOD was geinstalleerd - MOD versie » %s</strong>',

    // Log messages
    'LOG_PAGE_ADDED'    => '<strong>Statische pagina toegevoegd</strong><br />» %s',
    'LOG_PAGE_UPDATED'    => '<strong>Statische pagina aangepast</strong><br />» %s',
    'LOG_PAGE_REMOVED'    => '<strong>Statische pagina verwijderd</strong><br />» %s',

    // Manage pages permission
    'acl_a_manage_pages'            => array('lang' => 'Kan statische pagina\'s aanmaken, aanpassen en verwijderen', 'cat' => 'misc'),
));
?>