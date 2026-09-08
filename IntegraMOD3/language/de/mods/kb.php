<?php
/**
*
* Knowledge Base [German]
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
	'VIEW_KB_TOPIC'				=> 'Thema im Forum anzeigen',
	'EDIT_REASON'				=> 'Grund für die Bearbeitung dieses Artikels',
	'ACL_TYPE_KB_'				=> '',
	'ACP_KB_ROLES'				=> 'Wissensdatenbank-Rollen',
	'ACP_KB_ROLES_EXPLAIN'		=> '',
	'KB_CATEGORIE_PERMISSIONS'	=> 'Kategorieberechtigungen der Wissensdatenbank',
	'KB_CATEGORIE_PERMISSIONS_DESC'	=> 'Hier können Sie festlegen, welche Benutzer und Gruppen auf welche Kategorie zugreifen dürfen.',
	'LOOK_UP_CATEGORIE'			=> 'Kategorie auswählen',
	'LOOK_UP_FORUMS_EXPLAIN'	=> 'Sie können mehr als eine Kategorie auswählen',
	'ACL_TYPE_LOCAL_KB_'		=> 'Berechtigungen der Wissensdatenbank',
	'PERMISSION_TYPE'			=> 'Berechtigungen der Wissensdatenbank',
	'ALL_CATEGORIES'			=> 'Alle Kategorien',
	'SELECT_CATEGORIE_SUBFORUM_EXPLAIN'	=> 'Die hier ausgewählte Kategorie schließt alle Unterkategorien in die Auswahl ein.',
	'USER'						=> 'Benutzer',
	'ACTIVATE_RATING'			=> 'Bewertungen erlauben',
	'ACTIVATE_RATING_DESC'		=> 'Benutzer dürfen Artikel bewerten',
	'YOU_RATED'					=> 'Eigene Bewertung',
	'ALREADY_RATED'				=> 'FEHLER!!! Sie haben bereits bewertet',
	'ARTICLE_RATED'				=> 'Sie haben diesen Artikel bewertet',
	'RATING'					=> 'Bewertung',
	'RATINGS'					=> 'Bewertungen',
	'RATE_GOOD'					=> 'sehr gut',
	'RATE_ACCEPTABLE'			=> 'akzeptabel',
	'RATE_BAD'					=> 'schlecht',
	'RATE_ARTICLE'				=> 'Artikel bewerten',
	'RATE'						=> 'Bewerten',
	'ACTIVATE_POST'				=> 'Beitrag erstellen',
	'ACTIVATE_POST_DESC'		=> 'Beim Hinzufügen eines Artikels einen Forenbeitrag erstellen',
	'ACTIVATE_DIFF'				=> 'Verlauf aktivieren',
	'ACTIVATE_DIFF_DESC'		=> 'Beim Bearbeiten eines Artikels wird die alte Version gespeichert',
	'ACTION'					=> 'Aktion',
	'ACTIVATE_SIMILAR'			=> 'Ähnliche Artikel aktivieren',
	'ACTIVATE_SIMILAR_DESC'		=> '',
	'DIFFERENCE'				=> 'Unterschied zwischen Version: %s und aktuellem Artikel',
	'DIFF_DEL'					=> 'Die alte Version löschen?',
	'DIFF_RESTORE'				=> 'Die alte Version wiederherstellen',
	'ARTICLE_RESTORED'			=> 'Der Artikel wurde wiederhergestellt',
	'SIMILAR_ARTICLES'			=> 'Ähnliche Artikel',
	'OLD_VERSIONS'				=> 'Alte Versionen',
	'RESTORE'					=> 'Wiederherstellen',
	'ARTICLE_DETAIL'			=> 'Artikeldetails',
	'ARTICLE_REPORTED'			=> 'Dieser Artikel wurde gemeldet',
	'DISPLAY_ON_INDEX'			=> 'In der Hauptkategorie anzeigen',
	'DISPLAY_ON_INDEX_DESC'		=> '',
	'DELETED'					=> 'Der Eintrag wurde gelöscht',
	'MCP_REPORT_TITLE'			=> 'Gemeldete Artikel',
	'MCP_REPORT_EXPLAIN'		=> '',
	'REALY_DELETE'				=> 'Soll der Eintrag wirklich gelöscht werden?',
	'VIEW_REPORTS_OLD'			=> 'Geschlossene Meldungen anzeigen',
	'VIEW_REPORTS_NEW'			=> 'Offene Meldungen anzeigen',
	'SHOW_ARTICLE'				=> 'Artikel anzeigen',
	'SORT_ORDER'				=> 'Sortierung',
	'SORT_ORDER_DESC'			=> 'Sortierung der Artikel in Kategorien',
	'SUB_CATGEGORIES'			=> 'Unterkategorien',
	'SEARCH_CATEGORIE'			=> 'Kategorie durchsuchen',
	'ACP_TYPES'					=> 'Artikeltypen',
	'ACP_TYPES_DESC'			=> 'Hier können Sie Artikeltypen hinzufügen und bearbeiten',
	'ACP_CATEGORIE'				=> 'Kategorie',
	'ACP_CATEGORIE_DESC'		=> 'Hier können Sie Kategorien für die Wissensdatenbank hinzufügen oder bearbeiten.',
	'ACP_CONFIG'				=> 'Konfiguration',
	'ACP_CONFIG_DESC'			=> 'Hier können Sie die Konfiguration der Wissensdatenbank bearbeiten.',
	'ARTICLE_ACTIVATED'			=> 'Der Artikel wurde freigegeben!',
	'ARTICLE_DELETED'			=> 'Der Artikel wurde gelöscht!',
	'ARTICLE_ADDED'				=> 'Der Artikel wurde übermittelt und nach der Prüfung in der Wissensdatenbank veröffentlicht.',
	'ARTICLE_HISTORY'			=> 'Artikelprotokoll',
	'ARTICLE_ADD'				=> 'Artikel hinzufügen',
	'ARTICLE_TITLE'				=> 'Titel',
	'ARTICLE_TITLE_LANG_EXPLAIN'	=> 'Für einen lokalisierten Katalogeintrag das gesamte Feld als {L_KEY} eingeben. Die Schlüssel stehen in language/{iso}/kb/articles.php. Speichern Sie diese PHP-Datei als UTF-8 ohne BOM (Notepad++: Encoding → Convert to UTF-8 without BOM, dann Speichern). Der Windows-Editor kann ein BOM einfügen und das Forum mit „headers already sent“ abstürzen lassen. Normale Titel werden so gespeichert, wie sie eingegeben wurden.',
	'ARTICLE_DESCRIPTION'		=> 'Beschreibung',
	'ARTICLE_DESCRIPTION_LANG_EXPLAIN'	=> 'Optional. Verwenden Sie {L_KEY} für eine lokalisierte Beschreibung oder normalen Text. Katalogdateien müssen als UTF-8 ohne BOM gespeichert werden.',
	'ARTICLE_LANG_EXPLAIN'		=> 'Um den Artikeltext zu lokalisieren, geben Sie in diesem Feld nur {L_KEY} ein. Andernfalls schreiben Sie den Artikel wie gewohnt. Bearbeiten Sie language/{iso}/kb/articles.php in Notepad++ oder einem anderen Editor, der UTF-8 ohne BOM speichern kann. Nutzen Sie nicht den Windows-Editor.',
	'KB_LANG_KEY_MISSING'		=> 'Der Sprachschlüssel %s wurde in language/en/kb/articles.php nicht gefunden.',
	'ARTICLE'					=> 'Artikel',
	'ARTICLE_TYPES'				=> 'Artikeltypen',
	'ARTICLE_TYPES_DESC'		=> 'In welchen Artikeltypen möchten Sie suchen? Halten Sie die Strg-Taste gedrückt, um mehrere Typen auszuwählen. Wählen Sie keinen Typ, um in allen Typen zu suchen.',
	'ARTICLE_CONT'				=> 'Artikel in der Datenbank',
	'ARTICLE_DEL'				=> 'Soll der Artikel wirklich gelöscht werden?',
	'ARTICLE_EDIT'				=> 'Artikel bearbeiten',
	'ARTICLE_EDITED'			=> 'Der Artikel wurde bearbeitet!',
	'ARTICLE_DEACTIVATED'		=> 'Gesperrter Artikel',
	'ARTICLE_POSTET'			=> 'Artikel veröffentlicht',
	'AKTIVATE'					=> 'Aktivieren',

	'BACK_ARTICLE'				=> 'Zurück zum Artikel',
	'BACK_KB'					=> 'Zurück zur Wissensdatenbank',
	'BACK_TO_ARTICLE'			=> 'Klicken Sie %shier%s, um den Artikel anzuzeigen.',
	'BACK_TO_POSTING'			=> 'Klicken Sie %shier%s, um zurückzugehen.',
	'BACK_TO_KB'				=> 'Klicken Sie %shier%s, um zur Wissensdatenbank zurückzukehren.',
	'BACK_TO_LOG'				=> 'Klicken Sie %shier%s, um zum Artikelprotokoll zurückzukehren.',

	'CATEGORIE'					=> 'Kategorie',
	'CHANGED_AT'				=> 'Geändert am',
	'CONT_CAT'					=> 'Kategorien',
	'CATEGORIES'				=> 'Kategorien',
	'CATEGORIES_DESC'			=> 'In welchen Kategorien möchten Sie suchen? Halten Sie die Strg-Taste gedrückt, um mehrere Kategorien auszuwählen. Wählen Sie keine Kategorie, um in allen zu suchen.',
	'CAT_NOT_EMPTY'				=> 'Die Kategorie ist nicht leer!',
	'NO_CAT'					=> 'Die gewählte Kategorie existiert nicht.',
	'CAT_NAME'					=> 'Kategoriename',
	'CAT_NAME_DESC'				=> 'Name der Kategorie',
	'CAT_IMAGE'					=> 'Kategoriebild',
	'CAT_IMAGE_DESC'			=> 'Geben Sie hier die URL zu einem Bild für die Kategorie ein.',
	'CAT_DECRIPTION_DESC'		=> 'Geben Sie eine Beschreibung für die Kategorie an',
	'CAT_MAIN'					=> 'Hauptkategorie',
	'CAT_SELECT_MAIN'			=> 'Hauptkategorie wählen',
	'CAT_ADDED'					=> 'Die Kategorie wurde hinzugefügt',
	'CAT_DELETED'				=> 'Die Kategorie wurde gelöscht.',
	'CAT_UPDATED'				=> 'Die Kategorie wurde aktualisiert.',
	'CAT_REALY_DELETE'			=> 'Soll die Kategorie wirklich gelöscht werden?',
	'CAT_CREATE_NEW'			=> 'Neue Kategorie',
	'DESCRIPTION'				=> 'Beschreibung',


	'FIENAME'				=> 'Dateiname',
	'FOUND_IN'				=> 'Gefunden in',
	'INDEX_POSTS'			=> 'Artikel auf der Indexseite',
	'INDEX_POSTS_DESC'		=> 'Wie viele Artikel sollen auf der Indexseite angezeigt werden?',
	'KB_NAME'				=> 'Wissensdatenbank',
	'KB_NAME_DESC'			=> 'Der Name der Wissensdatenbank',
	'KB_DECRIPTION_DESC'	=> 'Geben Sie eine Beschreibung für die Wissensdatenbank ein.',
	'KBASE'					=> 'Wissensdatenbank',
	'KB_DESCRIPTION'		=> 'Wenn Sie einen Artikel geschrieben haben, können Sie ihn am Ende der Seite in der Vorschau ansehen und zur Prüfung einreichen. Nach der Freigabe wird der Artikel in der Wissensdatenbank veröffentlicht. ',

	'LOG_TITEL'				=> 'Artikelprotokoll',
	'LOG_DESCRIPTION'		=> 'Hier sehen Sie, wann der Artikel bearbeitet wurde und von welchem Benutzer.',
	'LOG_DELETED'			=> 'Das Artikelprotokoll wurde gelöscht.',

	'MAINCAT_DESC'			=> 'Hier können Sie Hauptkategorien anlegen, in denen Sie anschließend Unterkategorien für die Artikel erstellen.',
	'MODE'					=> 'Modus',
	'MODE_DESC'				=> 'Welchen Modus möchten Sie für die Indexseite verwenden?',
	'MODE_MODERN'			=> 'Modern',
	'MODE_CLASSIC'			=> 'Klassisch',
	'NO_ARTICLE'			=> 'Der gewünschte Artikel existiert nicht!',
	'NEED_INPUT'			=> 'Geben Sie einen Titel und einen Text für den Artikel ein!',
	'ARTICLE_NEW'			=> 'Nicht freigegebene Artikel',
	'ARTICLE_NEW_DESC'		=> 'Die folgenden Artikel sind noch nicht freigegeben oder wurden gesperrt',
	'NAME'					=> 'Kategoriename',
	'NEED_NAME'				=> 'Geben Sie einen Namen für die Kategorie an',
	'ARTICLE_NEWEST'		=> 'Der neueste Artikel ist',
	'NO_TYPE'				=> 'Kein Typ',
	'POST_FORUM'			=> 'Forum für den Verweis auf den Artikel',
	'POST_TEMPLATE'			=> 'Beitragsvorlage',
	'POST_MESSAGE'			=> 'Beitragstext',
	'POST_USER'				=> 'Benutzer-ID',
	'POST_NORMAL'			=> 'Normal',
	'POST_TOPIC_GLOBAL'		=> 'Globale Ankündigung',
	'POST_TOPIC_AS'			=> 'Thema erstellen als',
	'POST_TOPIC_AS_DESC'	=> 'Welche Art von Thema soll erstellt werden?',
	'POST_USER_DESC'		=> 'Die ID des Benutzers, der die Beiträge erstellt',
	'POST_SUBJECT'			=> 'Thementitel',
	'POST_SUBJECT_DESC'		=> 'Der Titel des Themas, das erstellt wird',
	'POST_FORUM_DESC'		=> 'Geben Sie die Foren-ID des Forums an, in dem ein Verweis auf den Artikel erstellt werden soll. Geben Sie „0“ ein, um keinen Verweis auf neue Artikel zu erstellen.',
	'POST_MESSAGE_DESC'		=> '{TITLE} = Artikeltitel <br />{DESCRIPTION} = Artikelbeschreibung<br />{POST_TIME} = Erstellungszeit<br />{TYPE} = Artikeltyp<br />{SUB_CAT} = Kategorie<br />{URL} = URL zum Artikel<br />{AUTHOR} = Autor des Artikels<br />{AUTHOR_ID} = Benutzer-ID des Autors.',
	'RELASED'				=> 'Freigegeben am',
	'READ_MORE'				=> 'Alle %s Artikel anzeigen',


	'SEARCH_KEYWORDS_DESC'	=> 'Hier können Sie in der Wissensdatenbank suchen.',
	'SHOW_EDITS'			=> 'Bearbeitungen anzeigen',
	'SHOW_EDITS_DESC'		=> 'Sollen Bearbeitungen im Artikel angezeigt werden?',
	'TYPE'					=> 'Artikeltyp',
	'TYPE_DESC'				=> 'Geben Sie einen Namen für den Artikeltyp an',
	'TYPE_ADDED'			=> 'Der Typ wurde hinzugefügt',
	'TYPE_UPDATED'			=> 'Der Typ wurde gelöscht',

	'NO_SUBCAT_IN_MAINCAT'	=> 'Im Index können keine Unterkategorien erstellt werden!',
	'CAT_TYPE'				=> 'Kategorietyp',
	'CAT_TYPE_DESC'			=> 'Wählen Sie einen Kategorietyp',
	'IN_INDEX'				=> 'Im Index',
	'CAT_SUB'				=> 'Unterkategorie',

	'CACHE_TIME'			=> 'Cache-Zeit',
	'CACHE_TIME_DESC'		=> 'Zeit, für die Typen und Kategorien zwischengespeichert werden',
	'SECONDS'				=> 'Sekunden',
	'ACTIVATE_TYPES'		=> 'Artikeltypen verwenden?',
	'ACTIVATE_TYPES_DESC'	=> 'Kann einem Artikel ein Typ zugewiesen werden?',
	'UPDATE_POST'			=> 'Beitrag aktualisieren',
	'UPDATE_POST_DESC'		=> 'Soll der Beitrag zum Artikel aktualisiert werden, wenn der Artikel aktualisiert wurde?',
	'POST_UPDATE_MESSAGE'	=> 'Artikel aktualisiert',
	'POST_ID'				=> 'ID des Forenbeitrags',
	'ARTICLE_ADDED_AKTIV'	=> 'Der Artikel wurde in die Datenbank übernommen und aktiviert',
	'SHOW_POST_EDIT'		=> 'Aktualisierungen anzeigen',
	'SHOW_POST_EDIT_DESC'	=> 'Soll eine Aktualisierung im Beitrag angezeigt werden?',

	'PRINT_TOPIC'			=> 'Artikel drucken',
	'SEARCH_CATEGORIE'		=> 'In Kategorie suchen...',

	'ADS'					=> 'Werbung',
	'KB_COPYRIGHT'			=> 'Wissensdatenbank von Tobi Schaefer',
	'ADS_DESC'				=> 'Hier können Sie Code für Ihre Werbung einfügen.',
	'URI_IN_USE'			=> 'Die URL wird bereits verwendet',
	'USER_CHANGED'			=> 'Der Benutzer wurde geändert',

));

?>
