<?php
/**
*
* Static Pages MOD
* [German]
*
* @author language by Cerkes  |  phpBB-Translations.com
*
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
	'PAGE_ID_INVALID'			=> 'Die gewählte Seite ist ungültig.',
	'PAGE_NOT_FOUND'			=> 'Die gewählte Seite existiert nicht.',
	
	// ACP keys
	'ACP_MANAGE_PAGES' => 'Seiten verwalten',
	'ACP_PAGES' => 'Seiten',
	'ACP_PAGES_EXPLAIN' => 'Hier kannst du deinem Forum statische Seiten hinzufügen und bearbeiten.',
	'ADD_PAGE' => 'Seite hinzufügen',
	'GO_TO_PAGE' => 'Seite ansehen',
	'MUST_SELECT_PAGE' => 'Du musst eine Seite auswählen',
	'NO_PAGE_DESC' => 'Du hast keine Beschreibung der Seiten eingegeben.',
	'NO_PAGE_TITLE' => 'Du hast keinen Titel für die Seiten angegeben.',
	'NO_PAGE_CONTENT' => 'Du hast noch keinen Inhalt für die Seiten hinterlegt.',
	'PAGE'     => 'Seite',
	'PAGES'     => 'Seiten',
	'PAGE_ADDED' => 'Die Seite wurde erfolgreich hinzugefügt.',
	'PAGE_AUTHOR' => 'Verfasser der Seite',
	'PAGE_CONTENT' => 'Inhalt der Seite',
	'PAGE_DESC' => 'Beschreibung',
	'PAGE_DESC_EXPLAIN' => 'Wird im ACP, in der Seitenliste und als Meta-Beschreibung für Suchmaschinen verwendet. Empfohlen sind 150-160 Zeichen.',
	'PAGE_DISPLAY' => 'Seite anzeigen',
	'PAGE_DISPLAY_EXPLAIN' => 'Bei der Einstellung "Nein" wird die Seite öffentlich nicht zugänglich. Administratoren und Moderatoren können jederzeit direkt auf die Seite zugreifen.',
	'PAGE_DISPLAY_GUESTS' => 'Seite den Besuchern anzeigen',
	'PAGE_DISPLAY_GUESTS_EXPLAIN' => 'Bei der Einstellung "Nein" wird die Seite nur den registrierten Benutzern zugänglich.',
	'PAGE_HIDDEN' => 'Diese Seite ist versteckt. Lediglich Administratoren und Moderatoren können sie sehen. Du kannst es im ACP aktivieren.',
	'PAGE_LINK' => 'Seiten-Link',
	'PAGE_MAKE_HIDDEN' => 'Verstecken',
	'PAGE_MAKE_VISIBLE' => 'Sichtbar machen',
	'PAGE_NOT_VISIBLE' => 'Die ausgewählte Seite ist jetzt öffentlich nicht sichtbar.',
	'PAGE_ORDER' => 'Seiten Reihenfolge',
	'PAGE_ORDER_EXPLAIN' => 'Wenn eine Liste von Seiten angezeigt wird, kannst du die Reihenfolge der Seiten definieren indem du hier eine Zahl einstellst. In diesem Bereich werden dann die Seiten aufsteigend sortiert.',
	'PAGE_OG_IMAGE' => 'URL des Social-Media-Bildes',
	'PAGE_OG_IMAGE_EXPLAIN' => 'Das Bild, das angezeigt wird, wenn diese Seite auf Facebook, X, Discord und ähnlichen Seiten geteilt wird. Optional. Muss eine vollständige URL mit http:// oder https:// sein, idealerweise etwa 1200 mal 630 Pixel.',
	'PAGE_OG_IMAGE_INVALID' => 'Die Bild-URL muss mit http:// oder https:// beginnen.',
	'PAGE_PORTAL_KEY' => 'Portal-Seitenschlüssel',
	'PAGE_PORTAL_KEY_EXPLAIN' => 'Füge diesen Eintrag unter Portal, phpBB-Seiten verwalten hinzu, um Blöcke nur dieser Seite zuzuweisen. Andernfalls gilt der allgemeine Seiteneintrag.',
	'PAGE_PUBLIC_URL' => 'Öffentliche URL',
	'PAGE_RELATED' => 'Verwandte Seiten',
	'PAGE_SEO_TITLE' => 'SEO-Titel',
	'PAGE_SEO_TITLE_EXPLAIN' => 'Überschreibt den Browser- und Suchtitel. Maximal 70 Zeichen. Leer lassen, um den Seitentitel zu verwenden.',
	'PAGE_SHOW_TITLE' => 'Titel auf der Seite anzeigen',
	'PAGE_SHOW_TITLE_EXPLAIN' => 'Bei Nein wird die Überschrift visuell ausgeblendet, bleibt aber im HTML-Titel und in der Seitenauszeichnung für Suchmaschinen und Screenreader erhalten.',
	'PAGE_TITLE' => 'Seitentitel',
	'PAGE_UPDATED' => 'Die Seite wurde erfolgreich aktualisiert.',
	'PAGE_URL' => 'URL-ID',
	'PAGE_URL_EXPLAIN' => 'Zu verwenden in der URL um auf die Seite zuzugreifen. Verwende kleine Buchstaben, Zahlen und Bindestriche. Falls nicht, generiert das System es vom Seitentitel.',
	'PAGE_URL_RESERVED' => 'Diese URL-ID entspricht einer vorhandenen Datei oder einem Verzeichnis. Wählen Sie einen anderen Namen.',
	'PAGE_CONTENT_FORMAT' => 'Inhaltsformat',
	'PAGE_CONTENT_FORMAT_EXPLAIN' => 'BBCode verwendet den normalen Editor. HTML wird so gespeichert und angezeigt, wie es eingegeben wurde, ohne den BBCode-Parser.',
	'PAGE_FORMAT_BBCODE' => 'BBCode',
	'PAGE_FORMAT_HTML' => 'HTML',
	'PAGE_VISIBLE' => 'Die ausgewählte Seite wird nun angezeigt.',
	'STATIC_PAGES_OG_IMAGE' => 'Standard-URL des Social-Media-Bildes',
	'STATIC_PAGES_OG_IMAGE_EXPLAIN' => 'Das Bild, das angezeigt wird, wenn eine Seite auf Facebook, X, Discord und ähnlichen Seiten geteilt wird. Wird für jede Seite verwendet, für die oben kein eigenes Bild gesetzt ist.',
	'STATIC_PAGES_SEO_URLS' => 'Stabile öffentliche Seiten-URLs verwenden',
	'STATIC_PAGES_SEO_URLS_EXPLAIN' => 'Wenn aktiviert, verwenden öffentliche Links zu Seiten eine lesbare Adresse wie page123-titel statt page.php?id=123. Die Adresse bleibt gleich, auch wenn sich der Titel ändert, was für Suchmaschinen besser ist. Erfordert aktive SEO-URL-Umschreibung des Boards.',
	'STATIC_PAGES_SETTINGS' => 'SEO-Einstellungen für Seiten',
	'STATIC_PAGES_MOD_UPDATED' => '<strong>Die Modifikation für Statische Seiten aktualisiert auf die Version » %s</strong>',
	'STATIC_PAGES_MOD_INSTALLED' => '<strong>Die Modifikation für Statische Seiten wurde installiert - MOD Version ist » %s</strong>',
	
	// Log messages
	'LOG_PAGE_ADDED'	=> '<strong>Statische Seite hinzugefügt</strong><br />» %s',
	'LOG_PAGE_UPDATED'	=> '<strong>Statische Seite aktualisiert</strong><br />» %s',
	'LOG_PAGE_REMOVED'	=> '<strong>Statische Seite entfernt</strong><br />» %s',
	
	// Manage pages permission
	'acl_a_manage_pages'			=> array('lang' => 'Kann Statische Seiten erstellen, bearbeiten und löschen', 'cat' => 'misc'),
));
?>