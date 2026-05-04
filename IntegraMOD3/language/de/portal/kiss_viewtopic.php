<?php
/**
*
* viewtopic [Deutsch]
*
* @package language
* @version $Id$
* @copyright (c) 2005 phpBB Group
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

	'ADD_ATTACHMENT'			=> 'Anhang hinzufügen',
	'ADD_ATTACHMENT_EXPLAIN'	=> 'Wenn Sie eine oder mehrere Dateien anhängen möchten, geben Sie die Angaben unten ein.',
	'ADD_FILE'					=> 'Datei hinzufügen',
	'ADD_POLL'					=> 'Umfrage erstellen',
	'ADD_POLL_EXPLAIN'			=> 'Wenn Sie Ihrem Thema keine Umfrage hinzufügen möchten, lassen Sie die Felder leer.',
	'ALREADY_DELETED'			=> 'Entschuldigung, diese Nachricht wurde bereits gelöscht.',
	'ATTACH_QUOTA_REACHED'		=> 'Das Kontingent für Forenanhänge wurde erreicht.',
	'ATTACH_SIG'				=> 'Signatur anhängen (Signaturen können im UCP geändert werden)',

	'BBCODE_A_HELP'				=> 'Inline hochgeladener Anhang: [attachment=]dateiname.ext[/attachment]',
	'BBCODE_B_HELP'				=> 'Fetter Text: [b]Text[/b]',
	'BBCODE_C_HELP'				=> 'Code-Anzeige: [code]Code[/code]',
	'BBCODE_E_HELP'				=> 'Liste: Listenelement hinzufügen',
	'BBCODE_F_HELP'				=> 'Schriftgröße: [size=85]kleiner Text[/size]',
	'BBCODE_IS_OFF'				=> '%sBBCode%s ist <em>AUS</em>',
	'BBCODE_IS_ON'				=> '%sBBCode%s ist <em>AN</em>',
	'BBCODE_I_HELP'				=> 'Kursiver Text: [i]Text[/i]',
	'BBCODE_L_HELP'				=> 'Liste: [list]Text[/list]',
	'BBCODE_LISTITEM_HELP'		=> 'Listenelement: [*]Text[/*]',
	'BBCODE_O_HELP'				=> 'Nummerierte Liste: [list=]Text[/list]',
	'BBCODE_P_HELP'				=> 'Bild einfügen: [img]http://bild_url[/img]',
	'BBCODE_Q_HELP'				=> 'Zitat: [quote]Text[/quote]',
	'BBCODE_S_HELP'				=> 'Schriftfarbe: [color=red]Text[/color]  Tipp: Sie können auch color=#FF0000 verwenden',
	'BBCODE_U_HELP'				=> 'Unterstrichener Text: [u]Text[/u]',
	'BBCODE_W_HELP'				=> 'URL einfügen: [url]http://url[/url] oder [url=http://url]Linktext[/url]',
	'BBCODE_D_HELP'				=> 'Flash: [flash=Breite,Höhe]http://url[/flash]',
	'BUMP_ERROR'				=> 'Sie können dieses Thema nicht so bald nach dem letzten Beitrag erneut hochschieben.',

	'MAKE_NEWS'					=> 'In "News" ändern',
	'MAKE_NEWS_GLOBAL'			=> 'In "Global News" ändern',

));