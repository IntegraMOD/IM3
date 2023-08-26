<?php

/** 
*
* @mod package		Meeting MOD
* @file				meeting.php 10 2014/02/26 OXPUS
* @copyright		(c) 2009 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

// [ german ] Language Pack for Meeting MOD

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

// Version
	'MEETING_VERSION'			=> 'Meeting MOD &copy; 2009, 2010, 2011, 2012 <a href="http://www.oxpus.net">OXPUS</a>',

// Administration
	'MEETING_ADMIN'				=> 'Treffen',
	'MEETING_ADD_NEW'			=> 'Neues Treffen hinzufügen',
	'MEETING_MANAGE'			=> 'Treffen verwalten',
	'MEETING_MANAGE_EXPLAIN'	=> 'Hiermit kannst Du alle gespeicherte Treffen verwalten. Du kannst sie bearbeiten oder löschen.',
	'MEETING_DELETE'			=> 'Treffen löschen?',
	'MEETING_DELETE_EXPLAIN'	=> 'Bist Du sicher, dieses Treffen zu löschen?',
	'MEETING_ADD'				=> 'Neues Treffen hinzufügen',
	'MEETING_EDIT'				=> 'Treffen bearbeiten',

// Configuration
	'MEETING_CONFIG'								=> 'Meeting Konfiguration',
	'MEETING_CONFIG_EXPLAIN'						=> 'Auf dieser Seite kannst Du alle Basiseinstellungen zu Treffen auf Deinem Board vornehmen.',
	'MEETING_CONFIG_UPDATED'						=> 'Meeting Konfiguration erfolgreich aktualisiert',
	'CLICK_RETURN_MEETING_CONFIG'					=> '%sKlicke hier, um zur Meeting Konfiguration zurückzukehren%s',
	'USER_ALLOW_ENTER_MEETING'						=> 'Erlaube Benutzern, Treffen einzutragen',
	'USER_ALLOW_ENTER_MEETING_EXPLAIN'				=> 'Wenn Du hier JA angibst, kann jeder Benutzer Treffen erfassen. Sagst Du hier NEIN, ist dieses nur Administratoren per ACP erlaubt. GRUPPEN erlaubt Benutzern die Erstellung von Meetings, wenn diese in mindestens einer der unten ausgewählten Gruppen Mitglied sind.',
	'USER_ALLOW_EDIT_MEETING'						=> 'Erlaube Benutzern, Treffen zu bearbeiten',
	'USER_ALLOW_EDIT_MEETING_EXPLAIN'				=> 'Wenn Du hier JA angibst, kann jeder Benutzer Treffen bearbeiten. Sagst Du hier NEIN, ist dieses nur Administratoren per ACP erlaubt.',
	'USER_ALLOW_DELETE_MEETING'						=> 'Erlaube Benutzern, die eigenen Treffen zu löschen',
	'USER_ALLOW_DELETE_MEETING_EXPLAIN'				=> 'Wenn Du hier JA angibts, kann jeder Benutzer seine eigenen Treffen löschen. Sagst Du hier NEIN, deaktivierst Du diese Option.',
	'USER_ALLOW_DELETE_MEETING_COMMENTS'			=> 'Erlaube Benutzern, die eigenen Kommentare zu Treffen zu löschen',
	'USER_ALLOW_DELETE_MEETING_COMMENTS_EXPLAIN'	=> 'Wenn Du hier JA angibts, kann jeder Benutzer seine Kommentare zu Treffen löschen. Sagst Du hier NEIN, deaktivierst Du diese Option.',
	'MEETING_NOTIFY'								=> 'Emailbenachrichtigung über An-/Abmeldungen aktivieren',
	'MEETING_NOTIFY_EXPLAIN'						=> 'Schaltet die Benachrichtung per Email an die Board-Emailadresse ein, wenn sich Benutzer an Treffen an-/abmelden oder die Anmeldung ändern.',
	'MEETING_SIGN_OTHER_PERM'						=> 'Andere Benutzer an-/abmelden',
	'MEETING_SIGN_OTHER_PERM_EXPLAIN'				=> 'Bestimmt, wer in einem Meeting andere Benutzer an-, bzw. abmelden darf.<br />Forengründer dürfen hierbei immer andere Benutzer an-, bzw. abmelden und sind von diesen Einstellungen daher ausgenommen.',
	'MEETING_SIGN_OTHER_P1'							=> 'Gründer',
	'MEETING_SIGN_OTHER_P2'							=> 'Gründer, Administratoren',
	'MEETING_SIGN_OTHER_P3'							=> 'Gründer, Administratoren, Moderatoren',
	'MEETING_SIGN_OTHER_P4'							=> 'Gründer, Administratoren, Moderatoren, Meeting Autoren',

// Forum part
	'CLICKMEETINGBACK'						=> '%sKlick hier, um zur Treffenübersicht zurückzukehren%s',
	'MEETING'								=> 'Treffen Übersicht',
	'MEETING_UNTIL'							=> 'Anmeldefrist',
	'MEETING_LOCATION'						=> 'Ort',
	'MEETING_SUBJECT'						=> 'Titel',
	'MEETING_CLOSED'						=> 'abgelaufen',
	'NO_MEETING'							=> 'Kein Treffen gefunden',
	'MEETING_NO_PERIOD'						=> 'Anmeldefrist ist abgelaufen',
	'MEETING_DESC'							=> 'Beschreibung',
	'MEETING_LINK'							=> 'Link',
	'MEETING_PLACES'						=> 'Maximale Anzahl Plätze',
	'MEETING_USERGROUP'						=> 'Benutzergruppen',
	'MEETING_FILTER'						=> 'Filtern nach Feld',
	'MEETING_ALL'							=> 'Alle Stati',
	'MEETING_OPEN'							=> 'Aktiv',
	'MEETING_SIGN_ON'						=> 'Beim Treffen anmelden mit',
	'MEETING_SIGN_EDIT'						=> 'Teilnahme ändern in',
	'MEETING_SIGN_OFF'						=> 'Vom Treffen verabschieden',
	'MEETING_SIGN_OFF_EXPLAIN'				=> 'Bist Du sicher, Dich von diesem Treffen abzumelden?',
	'MEETING_DETAIL'						=> 'Details Treffen',
	'MEETING_VIEWLIST'						=> 'Treffenliste',
	'MEETING_USERLIST'						=> 'Angemeldete Benutzer',
	'MEETING_USER_JOINS'					=> 'eingetragene Personen',
	'MEETING_NO_USER'						=> 'Aktuell kein angemeldeter Benutzer',
	'MEETING_FREE_PLACES'					=> 'Gesamtzahl freie Plätze',
	'MEETING_SURE_TOTAL'					=> 'Aktuell angemeldete Benutzer in Prozent',
	'MEETING_SURE_TOTAL_USER'				=> 'Aktuelle Benutzerzusagen in Prozent',
	'MEETING_STATISTIC'						=> 'Statistiken',
	'MEETING_COMMENTS'						=> 'Kommentare zum Treffen',
	'MEETING_COMMENT'						=> 'Kommentar des Benutzers',
	'MEETING_COMMENT_HINT'					=> 'Dein Kommentar muss nach dem Absenden erst freigeschaltet werden!',
	'MEETING_ENTER_COMMENT'					=> 'Kommentar abgeben',
	'NO_ACTIVE_MEETINGS'					=> 'Zur Zeit kein geplantes Treffen',
	'ONE_ACTIVE_MEETING'					=> 'Zur Zeit ist ein Treffen geplant',
	'ACTIVE_MEETINGS'						=> 'Zur Zeit sind %s Treffen geplant',
	'MEETING_CREATE_BY'						=> 'Erstellt von <a href="%s" class="genmed">%s</a>',
	'MEETING_EDIT_BY'						=> 'Zuletzt bearbeitet von <a href="%s" class="genmed">%s</a>',
	'MEETING_START_VALUE'					=> 'Startwert für Zusage-Auswahl',
	'MEETING_RECURE_VALUE'					=> 'Intervall für diese Auswahl',
	'MEETING_UNWILL_MESSAGE'				=> 'Ein Benutzer möchte an einem Treffen nicht teilnehmen',
	'MEETING_UNWILL_USER'					=> 'Benutzer %s möchte am Treffen %s nicht teilnehmen.',
	'MEETING_UNJOIN_MESSAGE'				=> 'Ein Benutzer hat sich von einem Treffen abgemeldet',
	'MEETING_UNJOIN_USER'					=> 'Benutzer %s hat sich von Treffen %s abgemeldet.',
	'MEETING_JOIN_MESSAGE'					=> 'Ein Benutzer hat sich bei einem Treffen angemeldet',
	'MEETING_JOIN_USER'						=> 'Benutzer %s hat sich am Treffen %s angemeldet.',
	'MEETING_CHANGE_MESSAGE'				=> 'Ein Benutzer hat die Zusage zu einem Treffen geändert',
	'MEETING_CHANGE_USER'					=> 'Benutzer %s hat die Zusage zum Treffen %s geändert.',
	'MEETING_SIGNONS'						=> 'Deine Anmeldungen',
	'MEETING_GUEST_OVERALL'					=> 'Gesamtanzahl Gäste, die die Benutzer max. einladen dürfen',
	'MEETING_GUEST_SINGLE'					=> 'Anzahl Gäste, die ein Benutzer max. einladen darf',
	'MEETING_REMAIN_GUEST_TEXT'				=> 'Du hast %s Gäste eingeladen, aber zur Zeit sind nur noch %s Plätze frei.<br />Gehe bitte zurück und lade weniger Leute ein.',
	'MEETING_USER_GUEST'					=> ' + ein Gast',
	'MEETING_USER_GUESTS'					=> ' + %s Gäste',
	'MEETING_USER_GUEST_POPUP'				=> ' + <a href="javascript:void(0)" onclick="openguestpopup(%s, %s);">ein Gast</a>',
	'MEETING_USER_GUESTS_POPUP'				=> ' + <a href="javascript:void(0)" onclick="openguestpopup(%s, %s);">%s Gäste</a>',
	'MEETING_GUESTS'						=> 'Gästen',
	'MEETING_OWM_GUESTS'					=> 'Deine Gäste',
	'MEETING_PRENAMES'						=> 'Vornamen',
	'MEETING_NAMES'							=> 'Namen',
	'MEETING_INVITE_GUESTS'					=> ' mit ',
	'MEETING_OVERALL_GUEST_PLACES'			=> ' + insgesamt %s Gäste',
	'MEETING_OVERALL_GUEST_PLACES_ONE'		=> ' + insgesamt ein Gast',
	'MEETING_SINGLE_GUEST_PLACES'			=> ' (max. %s Gäste je Benutzer)',
	'MEETING_SINGLE_GUEST_PLACES_ONE'		=> ' (max. ein Gast je Benutzer)',
	'MEETING_REMAIN_GUEST_PLACES'			=> '. Es können %s Gäste angemeldet werden.',
	'MEETING_REMAIN_GUEST_PLACES_ONE'		=> '. Es kann ein Gast angemeldet werden.',
	'MEETING_NO_GUEST_LIMIT'				=> 'Trage 0 ein, um dieses Limit zu deaktivieren',
	'MEETING_ALL_USERS'						=> 'Alle Benutzer',
	'MEETING_GROUP_CREATE'					=> 'Benutzergruppe(n) für Bearbeitung',
	'MEETING_GROUP_CREATE_EXPLAIN'			=> 'Mitglieder der ausgewählten Benutzergruppen werden Treffen erstellen können, sofern dieses mit der vorherigen Option aktiviert wurde.',
	'MEETING_GROUP_SELECT'					=> 'Benutzergruppe(n) für Auswahl',
	'MEETING_GROUP_SELECT_EXPLAIN'			=> 'Nur die eingestellten Benutzergruppen können beim Bearbeiten eines Treffens eingeladen werden.',
	'MEETING_NO_SIGNON'						=> 'Absage',
	'MEETING_NO_SIGNONS'					=> 'Absagen',
	'MEETING_MAYBE_SIGNONS'					=> 'Andere',
	'MEETING_YES_SIGNON'					=> 'Zusage',
	'MEETING_YES_SIGNONS'					=> 'Zusagen ',
	'MEETING_INTERVALL_EXPLAIN'				=> 'Verwende 0/100, um Benutzer lediglich an einem Treffen ab- oder anmelden zu lassen',
	'MEETING_ONLY_REGISTERED'				=> 'Nur für registrierte Benutzer!',
	'MEETING_GUEST_NAMES'					=> 'Benutzer muss Namen seiner eingeladenen Gäste angeben',
	'MEETING_GUEST_NAMES_EXPLAIN'			=> 'Diese Option ersetzt die Auswahlliste für die Anzahl eingeladener Gäste durch ein Formular, um die Namen der Gäste anzugeben.<br />Der Benutzer lädt dann soviele Gäste ein, wie er Namen in dem neuen Formular einträgt; unter Berücksichtigung der maximal zugelassenen Anzahl.',
	'MEETING_GUESTNAME_ENTERING_EXPLAIN'	=> 'Trage hier die Namen deiner Gäste ein.<br />Stelle sicher, daß Vor- <b>und</b> Nachnamen von deinen Gästen angegeben sind.<br />Um einen Gast auszuladen, leere die Zeile in der Liste und sende das Formular neu ab.',
	'MEETING_TIMEFORMAT'					=> 'yyyy-mm-dd hh:ss',
	'MEETING_TIME'							=> 'Zeit',
	'MEETING_TIME_END'						=> 'Zeit bis',
	'MEETING_SORT'							=> 'Sortieren nach',
	'MEETING_ORDER'							=> 'Richtung',
	'MEETING_SORT_ASC'						=> 'aufsteigend',
	'MEETING_SORT_DESC'						=> 'absteigend',
	'MEETING_TIME_WRONG'					=> 'Die angegebene Meeting-Zeit hat ein ungültiges Format!<br />Bitte gehe zurück und korrigiere Deine Eingabe.',
	'MEETING_END_WRONG'						=> 'Die angegebene Meeting-Bis-Zeit hat ein ungültiges Format!<br />Bitte gehe zurück und korrigiere Deine Eingabe.',
	'MEETING_UNTIL_WRONG'					=> 'Die angegebene Anmeldefrist hat ein ungültiges Format!<br />Bitte gehe zurück und korrigiere Deine Eingabe.',
	'MEETING_DATA_UPDATED'					=> 'Das Treffen wurde erfolgreich aktualisiert.',
	'MEETING_DATA_STORED'					=> 'Das Treffen wurde erfolgreich gespeichert.',
	'MEETING_CLOSE_STATUS'					=> 'Status',
	'MEETING_TIMEZONE_HINT'					=> 'Alle Meeting-Zeiten basieren auf der lokalen Ortszeit des Treffpunktes!',
	'MEETING_POST_COMMENT'					=> 'Kommentar verfassen',
	'MEETING_EDIT_COMMENT'					=> 'Kommentar ändern',
	'MEETING_UNAPPROVED_COMMENTS'			=> 'Nur Treffen mit freizugebenden Kommentaren',
	'MEETING_ALL_GROUPS'					=> 'Alle Gruppen',

// Email functions
	'MEETING_MAIL'			=> 'Email an eingetragene Personen senden',
	'MEETING_MAIL_SUBJECT'	=> 'Email Betreff',
	'MEETING_MAIL_TEXT'		=> 'Email Text',
	'MEETING_MAIL_TO'		=> 'Sende Email an',
	'MEETING_MAIL_ALL'		=> 'alle eingetragenen Personen',
	'MEETING_MAIL_SIGN_YES'	=> 'Personen, die zugesagt haben',
	'MEETING_MAIL_SIGN_NO'	=> 'Personen, die abgesagt haben',

// Log functions
	'MEETING_LOG_CONFIG'	=> '<strong>Allgemeine Konfiguration für die Treffenverwaltung geändert</strong>',
	'MEETING_LOG_ADD'		=> '<strong>Neues Treffen hinzugefügt</strong> &raquo; %s', 
	'MEETING_LOG_EDIT'		=> '<strong>Treffen geändert</strong> &raquo; %s', 
	'MEETING_LOG_DELETE'	=> '<strong>Treffen gelöscht</strong> &raquo; %s',

// Calendar strings
	'MEETING_CALENDAR'		=> 'Treffen Kalender',
	'MEETING_FIRST_WEEKDAY'	=> 'Erster Tag der Woche',
	'MEETING_CAL_MONDAY'	=> 'Montag',
	'MEETING_CAL_SUNDAY'	=> 'Sonntag',
	'MEETING_CAL_DAY'		=> array(
								0 => 'Sonntag',
								1 => 'Montag',
								2 => 'Dienstag',
								3 => 'Mittwoch',
								4 => 'Donnerstag',
								5 => 'Freitag',
								6 => 'Samstag',
	),
	'MEETING_MONTH_TEXT'	=> array(
								1 => 'Januar',
								2 => 'Februar',
								3 => 'März',
								4 => 'April',
								5 => 'Mai',
								6 => 'Juni',
								7 => 'Juli',
								8 => 'August',
								9 => 'September',
								10 => 'Oktober',
								11 => 'November',
								12 => 'Dezember',
	),

));

?>