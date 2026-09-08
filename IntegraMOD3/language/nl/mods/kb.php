<?php
/**
*
* Knowledge Base [Dutch]
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package language
* @version $Id$
* @copyright (c) 2007 SEO phpBB http://www.phpbb-seo.de
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



$lang = array_merge($lang, array(
	'VIEW_KB_TOPIC'				=> 'Onderwerp in het forum bekijken',
	'EDIT_REASON'				=> 'Reden voor het bewerken van dit artikel',
	'ACL_TYPE_KB_'				=> '',
	'ACP_KB_ROLES'				=> 'Kennisbankrollen',
	'ACP_KB_ROLES_EXPLAIN'		=> '',
	'KB_CATEGORIE_PERMISSIONS'	=> 'Categoriepermissies van de kennisbank',
	'KB_CATEGORIE_PERMISSIONS_DESC'	=> 'Hier kunt u instellen welke gebruikers en groepen toegang hebben tot welke categorie.',
	'LOOK_UP_CATEGORIE'			=> 'Selecteer een categorie',
	'LOOK_UP_FORUMS_EXPLAIN'	=> 'U kunt meer dan één categorie selecteren',
	'ACL_TYPE_LOCAL_KB_'		=> 'Kennisbankpermissies',
	'PERMISSION_TYPE'			=> 'Kennisbankpermissies',
	'ALL_CATEGORIES'			=> 'Alle categorieën',
	'SELECT_CATEGORIE_SUBFORUM_EXPLAIN'	=> 'De hier geselecteerde categorie neemt alle subcategorieën mee in de selectie.',
	'USER'						=> 'Gebruiker',
	'ACTIVATE_RATING'			=> 'Beoordelingen toestaan',
	'ACTIVATE_RATING_DESC'		=> 'Gebruikers mogen artikelen beoordelen',
	'YOU_RATED'					=> 'Eigen beoordeling',
	'ALREADY_RATED'				=> 'FOUT!!! U heeft al beoordeeld',
	'ARTICLE_RATED'				=> 'U heeft dit artikel beoordeeld',
	'RATING'					=> 'Beoordeling',
	'RATINGS'					=> 'Beoordelingen',
	'RATE_GOOD'					=> 'zeer goed',
	'RATE_ACCEPTABLE'			=> 'aanvaardbaar',
	'RATE_BAD'					=> 'slecht',
	'RATE_ARTICLE'				=> 'Artikel beoordelen',
	'RATE'						=> 'Beoordelen',
	'ACTIVATE_POST'				=> 'Bericht plaatsen',
	'ACTIVATE_POST_DESC'		=> 'Plaats een forumbericht bij het toevoegen van een artikel',
	'ACTIVATE_DIFF'				=> 'Geschiedenis inschakelen',
	'ACTIVATE_DIFF_DESC'		=> 'Bij het bewerken van een artikel wordt de oude versie opgeslagen',
	'ACTION'					=> 'Actie',
	'ACTIVATE_SIMILAR'			=> 'Vergelijkbare artikelen inschakelen',
	'ACTIVATE_SIMILAR_DESC'		=> '',
	'DIFFERENCE'				=> 'Verschil tussen versie: %s en het huidige artikel',
	'DIFF_DEL'					=> 'De oude versie verwijderen?',
	'DIFF_RESTORE'				=> 'De oude versie herstellen',
	'ARTICLE_RESTORED'			=> 'Het artikel is hersteld',
	'SIMILAR_ARTICLES'			=> 'Vergelijkbare artikelen',
	'OLD_VERSIONS'				=> 'Oude versies',
	'RESTORE'					=> 'Herstellen',
	'ARTICLE_DETAIL'			=> 'Artikeldetails',
	'ARTICLE_REPORTED'			=> 'Dit artikel is gemeld',
	'DISPLAY_ON_INDEX'			=> 'Tonen in de hoofdcategorie',
	'DISPLAY_ON_INDEX_DESC'		=> '',
	'DELETED'					=> 'Het item is verwijderd',
	'MCP_REPORT_TITLE'			=> 'Gemelde artikelen',
	'MCP_REPORT_EXPLAIN'		=> '',
	'REALY_DELETE'				=> 'Moet het item echt worden verwijderd?',
	'VIEW_REPORTS_OLD'			=> 'Gesloten meldingen bekijken',
	'VIEW_REPORTS_NEW'			=> 'Open meldingen bekijken',
	'SHOW_ARTICLE'				=> 'Artikel tonen',
	'SORT_ORDER'				=> 'Sorteervolgorde',
	'SORT_ORDER_DESC'			=> 'Sortering van artikelen in categorieën',
	'SUB_CATGEGORIES'			=> 'Subcategorieën',
	'SEARCH_CATEGORIE'			=> 'Categorie doorzoeken',
	'ACP_TYPES'					=> 'Artikeltypen',
	'ACP_TYPES_DESC'			=> 'Hier kunt u artikeltypen toevoegen en bewerken',
	'ACP_CATEGORIE'				=> 'Categorie',
	'ACP_CATEGORIE_DESC'		=> 'Hier kunt u categorieën voor de kennisbank toevoegen of bewerken.',
	'ACP_CONFIG'				=> 'Configuratie',
	'ACP_CONFIG_DESC'			=> 'Hier kunt u de configuratie van de kennisbank bewerken.',
	'ARTICLE_ACTIVATED'			=> 'Het artikel is vrijgegeven!',
	'ARTICLE_DELETED'			=> 'Het artikel is verwijderd!',
	'ARTICLE_ADDED'				=> 'Het artikel is ingediend en wordt na controle in de kennisbank gepubliceerd.',
	'ARTICLE_HISTORY'			=> 'Artikellogboek',
	'ARTICLE_ADD'				=> 'Artikel toevoegen',
	'ARTICLE_TITLE'				=> 'Titel',
	'ARTICLE_TITLE_LANG_EXPLAIN'	=> 'Om een gelokaliseerde catalogusreeks te gebruiken, voert u het hele veld in als {L_KEY}. Sleutels staan in language/{iso}/kb/articles.php. Sla dat PHP-bestand op als UTF-8 zonder BOM (Notepad++: Encoding → Convert to UTF-8 without BOM, daarna Opslaan). Kladblok van Windows kan een BOM toevoegen en het forum laten crashen met headers already sent. Gewone titels worden opgeslagen zoals ingevoerd.',
	'ARTICLE_DESCRIPTION'		=> 'Beschrijving',
	'ARTICLE_DESCRIPTION_LANG_EXPLAIN'	=> 'Optioneel. Gebruik {L_KEY} voor een gelokaliseerde beschrijving, of gewone tekst. Catalogusbestanden moeten als UTF-8 zonder BOM worden opgeslagen.',
	'ARTICLE_LANG_EXPLAIN'		=> 'Om de artikeltekst te lokaliseren, voert u in dit veld alleen {L_KEY} in. Schrijf anders het artikel zoals gebruikelijk. Bewerk language/{iso}/kb/articles.php in Notepad++ of een andere editor die UTF-8 zonder BOM kan opslaan. Gebruik niet Kladblok van Windows.',
	'KB_LANG_KEY_MISSING'		=> 'De taalsleutel %s is niet gevonden in language/en/kb/articles.php.',
	'ARTICLE'					=> 'Artikel',
	'ARTICLE_TYPES'				=> 'Artikeltypen',
	'ARTICLE_TYPES_DESC'		=> 'In welke artikeltypen wilt u zoeken? Gebruik de Ctrl-toets om meer dan één type te kiezen. Kies geen type om in alle typen te zoeken.',
	'ARTICLE_CONT'				=> 'Artikelen in de database',
	'ARTICLE_DEL'				=> 'Moet het artikel echt worden verwijderd?',
	'ARTICLE_EDIT'				=> 'Artikel bewerken',
	'ARTICLE_EDITED'			=> 'Het artikel is bewerkt!',
	'ARTICLE_DEACTIVATED'		=> 'Vergrendeld artikel',
	'ARTICLE_POSTET'			=> 'Artikel geplaatst',
	'AKTIVATE'					=> 'Activeren',

	'BACK_ARTICLE'				=> 'Terug naar artikel',
	'BACK_KB'					=> 'Terug naar de kennisbank',
	'BACK_TO_ARTICLE'			=> 'Klik %shier%s om het artikel te bekijken.',
	'BACK_TO_POSTING'			=> 'Klik %shier%s om terug te gaan.',
	'BACK_TO_KB'				=> 'Klik %shier%s om terug te gaan naar de kennisbank.',
	'BACK_TO_LOG'				=> 'Klik %shier%s om terug te gaan naar het artikellogboek.',

	'CATEGORIE'					=> 'Categorie',
	'CHANGED_AT'				=> 'Gewijzigd op',
	'CONT_CAT'					=> 'Categorieën',
	'CATEGORIES'				=> 'categorieën',
	'CATEGORIES_DESC'			=> 'In welke categorieën wilt u zoeken? Gebruik de Ctrl-toets om meer dan één categorie te kiezen. Kies geen categorie om in alle te zoeken.',
	'CAT_NOT_EMPTY'				=> 'De categorie is niet leeg!',
	'NO_CAT'					=> 'De geselecteerde categorie bestaat niet.',
	'CAT_NAME'					=> 'Categorienaam',
	'CAT_NAME_DESC'				=> 'Naam van de categorie',
	'CAT_IMAGE'					=> 'Categorieafbeelding',
	'CAT_IMAGE_DESC'			=> 'Voer hier de URL naar een afbeelding voor de categorie in.',
	'CAT_DECRIPTION_DESC'		=> 'Geef een beschrijving van de categorie',
	'CAT_MAIN'					=> 'Hoofdcategorie',
	'CAT_SELECT_MAIN'			=> 'Kies een hoofdcategorie',
	'CAT_ADDED'					=> 'De categorie is toegevoegd',
	'CAT_DELETED'				=> 'De categorie is verwijderd.',
	'CAT_UPDATED'				=> 'De categorie is bijgewerkt.',
	'CAT_REALY_DELETE'			=> 'Moet de categorie echt worden verwijderd?',
	'CAT_CREATE_NEW'			=> 'Nieuwe categorie',
	'DESCRIPTION'				=> 'Beschrijving',


	'FIENAME'				=> 'Bestandsnaam',
	'FOUND_IN'				=> 'Gevonden in',
	'INDEX_POSTS'			=> 'Artikelen op de indexpagina',
	'INDEX_POSTS_DESC'		=> 'Hoeveel artikelen moeten op de indexpagina worden getoond?',
	'KB_NAME'				=> 'Kennisbank',
	'KB_NAME_DESC'			=> 'De naam van de kennisbank',
	'KB_DECRIPTION_DESC'	=> 'Voer een beschrijving van de kennisbank in.',
	'KBASE'					=> 'Kennisbank',
	'KB_DESCRIPTION'		=> 'Als u een artikel hebt geschreven, kunt u het onderaan de pagina bekijken en ter beoordeling indienen. Na goedkeuring wordt het artikel in de kennisbank gepubliceerd. ',

	'LOG_TITEL'				=> 'Artikellogboek',
	'LOG_DESCRIPTION'		=> 'Hier ziet u wanneer het artikel is bewerkt en door welke gebruiker.',
	'LOG_DELETED'			=> 'Het artikellogboek is verwijderd.',

	'MAINCAT_DESC'			=> 'Hier kunt u hoofdcategorieën aanmaken, waarin u vervolgens subcategorieën voor de artikelen maakt.',
	'MODE'					=> 'Modus',
	'MODE_DESC'				=> 'Welke modus wilt u voor de indexpagina gebruiken?',
	'MODE_MODERN'			=> 'Modern',
	'MODE_CLASSIC'			=> 'Klassiek',
	'NO_ARTICLE'			=> 'Het gewenste artikel bestaat niet!',
	'NEED_INPUT'			=> 'Voer een titel en tekst in voor het artikel!',
	'ARTICLE_NEW'			=> 'Niet vrijgegeven artikelen',
	'ARTICLE_NEW_DESC'		=> 'De volgende artikelen zijn nog niet vrijgegeven of zijn vergrendeld',
	'NAME'					=> 'Categorienaam',
	'NEED_NAME'				=> 'Geef een naam op voor de categorie',
	'ARTICLE_NEWEST'		=> 'Het nieuwste artikel is',
	'NO_TYPE'				=> 'Geen type',
	'POST_FORUM'			=> 'Forum voor de verwijzing naar het artikel',
	'POST_TEMPLATE'			=> 'Berichtensjabloon',
	'POST_MESSAGE'			=> 'Berichttekst',
	'POST_USER'				=> 'Gebruikers-ID',
	'POST_NORMAL'			=> 'Normaal',
	'POST_TOPIC_GLOBAL'		=> 'Algemene aankondiging',
	'POST_TOPIC_AS'			=> 'Onderwerp plaatsen als',
	'POST_TOPIC_AS_DESC'	=> 'Wat voor soort onderwerp wordt er aangemaakt?',
	'POST_USER_DESC'		=> 'Het ID van de gebruiker die de berichten aanmaakt',
	'POST_SUBJECT'			=> 'Onderwerptitel',
	'POST_SUBJECT_DESC'		=> 'De titel van het onderwerp dat wordt aangemaakt',
	'POST_FORUM_DESC'		=> 'Geef het forum-ID op van het forum waarin een verwijzing naar het artikel moet worden aangemaakt. Voer "0" in om geen verwijzing naar nieuwe artikelen te maken.',
	'POST_MESSAGE_DESC'		=> '{TITLE} = Artikeltitel <br />{DESCRIPTION} = Artikelbeschrijving<br />{POST_TIME} = Tijdstip van schrijven<br />{TYPE} = Artikeltype<br />{SUB_CAT} = Categorie<br />{URL} = URL naar het artikel<br />{AUTHOR} = Auteur van het artikel<br />{AUTHOR_ID} = Gebruikers-ID van de auteur.',
	'RELASED'				=> 'Vrijgegeven op',
	'READ_MORE'				=> 'Alle %s artikelen tonen',


	'SEARCH_KEYWORDS_DESC'	=> 'Hier kunt u in de kennisbank zoeken.',
	'SHOW_EDITS'			=> 'Bewerkingen tonen',
	'SHOW_EDITS_DESC'		=> 'Moeten bewerkingen in het artikel worden getoond?',
	'TYPE'					=> 'Artikeltype',
	'TYPE_DESC'				=> 'Geef een naam op voor het artikeltype',
	'TYPE_ADDED'			=> 'Het type is toegevoegd',
	'TYPE_UPDATED'			=> 'Het type is verwijderd',

	'NO_SUBCAT_IN_MAINCAT'	=> 'U kunt geen subcategorieën in de index aanmaken!',
	'CAT_TYPE'				=> 'Categorietype',
	'CAT_TYPE_DESC'			=> 'Kies een categorietype',
	'IN_INDEX'				=> 'In de index',
	'CAT_SUB'				=> 'Subcategorie',

	'CACHE_TIME'			=> 'Cachetijd',
	'CACHE_TIME_DESC'		=> 'Tijd waarvoor typen en categorieën in de cache worden bewaard',
	'SECONDS'				=> 'Seconden',
	'ACTIVATE_TYPES'		=> 'Artikeltypen gebruiken?',
	'ACTIVATE_TYPES_DESC'	=> 'Kan aan een artikel een type worden toegewezen?',
	'UPDATE_POST'			=> 'Bericht vernieuwen',
	'UPDATE_POST_DESC'		=> 'Moet het bericht bij het artikel worden bijgewerkt wanneer het artikel is bijgewerkt?',
	'POST_UPDATE_MESSAGE'	=> 'Artikel bijgewerkt',
	'POST_ID'				=> 'ID van het forumbericht',
	'ARTICLE_ADDED_AKTIV'	=> 'Het artikel is in de database opgeslagen en geactiveerd',
	'SHOW_POST_EDIT'		=> 'Updates tonen',
	'SHOW_POST_EDIT_DESC'	=> 'Moet een update in het bericht worden getoond?',

	'PRINT_TOPIC'			=> 'Artikel afdrukken',
	'SEARCH_CATEGORIE'		=> 'Zoeken in categorie...',

	'ADS'					=> 'Advertenties',
	'KB_COPYRIGHT'			=> 'Kennisbank door Tobi Schaefer',
	'ADS_DESC'				=> 'Hier kunt u code voor uw advertenties invoegen.',
	'URI_IN_USE'			=> 'De URL is al in gebruik',
	'USER_CHANGED'			=> 'De gebruiker is gewijzigd',

));

?>
