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
    'PAGE_DESC_EXPLAIN' => 'Wordt gebruikt in het ACP, de paginalijst en als meta-beschrijving voor zoekmachines. Richt op 150-160 tekens.',
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
    'PAGE_OG_IMAGE' => 'URL van socialmedia-afbeelding',
    'PAGE_OG_IMAGE_EXPLAIN' => 'De afbeelding die wordt getoond wanneer deze pagina wordt gedeeld op Facebook, X, Discord en vergelijkbare sites. Optioneel. Moet een volledige URL zijn die begint met http:// of https://, bij voorkeur ongeveer 1200 bij 630 pixels.',
    'PAGE_OG_IMAGE_INVALID' => 'De afbeeldings-URL moet beginnen met http:// of https://.',
    'PAGE_PORTAL_KEY' => 'Portaalpaginasleutel',
    'PAGE_PORTAL_KEY_EXPLAIN' => 'Voeg dit item toe onder Portaal, phpBB-pagina\'s beheren om blokken alleen aan deze pagina toe te wijzen. Anders geldt het algemene pagina-item.',
    'PAGE_PUBLIC_URL' => 'Openbare URL',
    'PAGE_RELATED' => 'Gerelateerde pagina\'s',
    'PAGE_SEO_TITLE' => 'SEO-titel',
    'PAGE_SEO_TITLE_EXPLAIN' => 'Overschrijft de browser- en zoektitel. Gebruik maximaal 70 tekens. Laat leeg om de paginatitel te gebruiken.',
    'PAGE_SHOW_TITLE' => 'Titel op de pagina tonen',
    'PAGE_SHOW_TITLE_EXPLAIN' => 'Bij Nee wordt de kop visueel verborgen, maar blijft deze in de HTML-titel en paginamarkering voor zoekmachines en schermlezers.',
    'PAGE_TITLE' => 'Pagina titel',
    'PAGE_UPDATED' => 'De pagina was successvol aangepast.',
    'PAGE_URL' => 'Pagina URL',
    'PAGE_URL_EXPLAIN' => 'Gebruikt als de URL om deze pagina te berijken, gebruik kleine letters, cijfers en streepjes. Als dit wordt leeg gelaten zal het systeem een URL genereren.',
    'PAGE_URL_RESERVED' => 'Deze pagina-URL komt overeen met een bestaand bestand of een bestaande map. Kies een andere naam.',
    'PAGE_CONTENT_FORMAT' => 'Inhoudsformaat',
    'PAGE_CONTENT_FORMAT_EXPLAIN' => 'BBCode gebruikt de normale editor. HTML wordt opgeslagen en getoond zoals ingevoerd, zonder de BBCode-parser.',
    'PAGE_FORMAT_BBCODE' => 'BBCode',
    'PAGE_FORMAT_HTML' => 'HTML',
    'PAGE_VISIBLE' => 'De geselecteerde pagina wordt nu weergegeven',
    'STATIC_PAGES_OG_IMAGE' => 'Standaard-URL van socialmedia-afbeelding',
    'STATIC_PAGES_OG_IMAGE_EXPLAIN' => 'De afbeelding die wordt getoond wanneer een pagina wordt gedeeld op Facebook, X, Discord en vergelijkbare sites. Wordt gebruikt voor elke pagina waarvoor hierboven geen eigen afbeelding is ingesteld.',
    'STATIC_PAGES_SEO_URLS' => 'Stabiele openbare pagina-URL\'s gebruiken',
    'STATIC_PAGES_SEO_URLS_EXPLAIN' => 'Indien ingeschakeld gebruiken openbare links naar pagina\'s een leesbaar adres zoals page123-titel in plaats van page.php?id=123. Het adres blijft hetzelfde als de titel wijzigt, wat beter is voor zoekmachines. Vereist dat de SEO-URL-herschrijving van het forum actief is.',
    'STATIC_PAGES_SETTINGS' => 'SEO-instellingen voor pagina\'s',
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