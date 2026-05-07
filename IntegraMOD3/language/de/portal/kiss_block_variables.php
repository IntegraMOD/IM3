<?php
/**
*
* kis_block_variables [Deutsch]
*
* @package language (Kiss Portal Engine)
* @version $Id:$
* @copyright (c) 2005 phpbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* @note: Do not remove this copyright. Just append yours if you have modified it, this is part of the Kiss Portal Engine copyright
* @updated 09 May 2011
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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//
// Portal Menu Names + add you menu language variables here! //

$lang = array_merge($lang, array(
	'SGP_BLOG'         => 'SGP Integriertes Blog',
	'LINKS_MENU'       => 'Links‑Menü',
	'RATINGS_LATEST'   => 'Neueste Bewertungen',
	'REFRESH_ALL'      => 'Alle aktualisieren',
	'SITE_NAVIGATOR'   => 'Navigator',
	'SITE_RULES'       => 'Seitenregeln',
	'SITE_STATISTICS'  => 'Seitenstatistik',
	'STYLES_DEMO'      => 'Styles Demo',
	'STYLE_SELECT'     => 'Style wählen',
	'UNRESOLVED/BUGS'  => 'Offene Fehler/Bugs',
	'UPLOAD_IMAGES'    => 'Bilder hochladen',
	'USER_INFORMATION' => 'Benutzerinformationen',

));

// Portal Block Names + add your block name language variables here! //
$lang = array_merge($lang, array(
	'ACP_SMALL'         => 'Admin CP',
	'BOARD_MINI_NAV'    => 'Untermenü',
	'BOARD_STYLE'       => 'Board‑Design',
	'BOARD_NAV'         => 'Board‑Navigation',
	'BOT_TRACKER'       => 'Bot‑Tracker',
	'BOT_TRACKER_SMALL' => 'Bot‑Tracker',
	'CLOUD9_LINKS'      => 'Cloud9‑Links',
	'CLOUD9_SEARCHES'   => 'Cloud9‑Suchen',
	'FM_RADIO'          => 'FM Radio',
	'FORUM_CATEGORIES'  => 'Forenkategorien',
	'MAIN_MENU'         => 'Hauptmenü',
	'MP3_PLAYER'        => 'MP3‑Player',
	'NEWS_REPORT'       => 'Seiten‑Nachrichten',
	'PORTAL_STATUS'     => 'Portalstatus',
	'RECENT_TOPICS'     => 'Aktuelle Themen',
	'SELECT_STYLE'      => 'Neuen Style auswählen',
	'SITE_LINK_TXT'     => 'Link zu uns',
	'STATS'             => 'Statistiken',
	'STYLE_STATUS'      => 'Style‑Status',
	'SUB_MENU'          => 'Untermenü',
	'TOP_10_PICS'       => 'Top 10 bewertete Bilder',
	'TOP_DOWNLOADS'     => 'Top Downloads',
	'TOP_POSTERS'       => 'Top Poster',
	'TOP_TOPICS_DAYS'   => 'in den letzten %d Tagen',
	'WELCOME_SITE'      => 'Willkommen bei<br /><strong>%s</strong>',
	'YOUR_PROFILE'      => 'Benutzerprofil',

));

// Block Names
$lang = array_merge($lang, array(
	'ADMIN_OPTIONS'           => 'Administrator‑Optionen',
	'BUG_TRACKER'             => 'Bug‑Tracker',
	'TRANSLATE_SITE'          => '<strong>Sprache auswählen</strong>',
	'TRANSLATE_RESET'         => '<strong>Zur Original‑Sprache zurücksetzen</strong>',
	'ANNOUNCEMENTS_AND_NEWS'  => 'Nachrichten und Ankündigungen',
));

// Acronyms
$lang = array_merge($lang, array(
	'ALLOW_ACRONYMS'         => 'Lokale Abkürzungen in Beiträgen verarbeiten (eingebaut)',
	'ALLOW_ACRONYMS_EXPLAIN' => 'Lokale Abkürzungen in Beiträgen erlauben',
));

// IRC Channel(s)
$lang = array_merge($lang, array(
	'IRC_POPUP'    => 'IRC‑Popup',
	'SIGNED_OFF'   => 'Abgemeldet',
	'NO_JAVA_SUP'  => 'Keine Java‑Unterstützung',
	'NO_JAVA_VER'  => 'Sorry, Sie benötigen einen Java 1.4.x‑fähigen Browser, um PJIRC zu nutzen',
));

// Age ranges
$lang = array_merge($lang, array(
	'AGE_RANGE'        => 'Altersbereich',
	'AVERAGE_AGE'      => 'Durchschnittsalter',
	'TOTAL_AGE'        => 'Gesamtalter',
	'TOTAL_AGE_COUNTS' => 'Anzahl Altersangaben',
));

// RSS Newsfeeds
$lang = array_merge($lang, array(
	'NO_CURL'               => 'curl nicht installiert. Verwenden Sie stattdessen fopen (Änderung im ACP)',
	'NO_FOPEN'              => 'fopen nicht installiert. Verwenden Sie stattdessen curl (Änderung im ACP)',
	'RSS_CACHE_ERROR'       => 'Entschuldigung, keine RSS‑Einträge im Cache gefunden.',
	'RSS_DISABLED'          => 'Newsfeeds sind derzeit deaktiviert',
	'RSS_FEED_ERROR'        => 'Oder es gibt ein Problem mit dem RSS‑Feed.',
	'RSS_LIST_ERROR'        => 'RSS‑Liste konnte nicht abgerufen werden.',
	'RSS_ERROR'             => 'RSS‑Fehler – Überprüfen Sie den Feed‑Link (oben).',
	'LOG_RSS_CACHE_CLEANED' => 'RSS‑Cache geleert',
));

// HTTP Referrals
$lang = array_merge($lang, array(
	'TOT_REF' => 'Gesamt‑Referrals',
));

// Mini Mods
$lang = array_merge($lang, array(
	'CHECK_VERSION'  => 'Auf Updates prüfen',
));
