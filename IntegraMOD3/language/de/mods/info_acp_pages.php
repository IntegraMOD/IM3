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
	'PAGE_DESC_EXPLAIN' => 'Dies wird an zwei Stellen genutzt, hier im ACP zum identifizieren von statischen Seiten und in der Beschreibung der Meta-Tags während die Seite angezeigt wird.',
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
	'PAGE_TITLE' => 'Seitentitel',
	'PAGE_UPDATED' => 'Die Seite wurde erfolgreich aktualisiert.',
	'PAGE_URL' => 'URL-ID',
	'PAGE_URL_EXPLAIN' => 'Zu verwenden in der URL um auf die Seite zuzugreifen. Verwende kleine Buchstaben, Zahlen und Bindestriche. Falls nicht, generiert das System es vom Seitentitel.',
	'PAGE_VISIBLE' => 'Die ausgewählte Seite wird nun angezeigt.',
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