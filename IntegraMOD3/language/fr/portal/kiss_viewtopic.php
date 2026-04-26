<?php
/**
*
* viewtopic [English]
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

	'ADD_ATTACHMENT'			=> 'Ajouter une pièce jointe',
	'ADD_ATTACHMENT_EXPLAIN'	=> 'Si vous souhaitez joindre un ou plusieurs fichiers, saisissez les informations ci-dessous.',
	'ADD_FILE'					=> 'Ajouter le fichier',
	'ADD_POLL'					=> 'Créer un sondage',
	'ADD_POLL_EXPLAIN'			=> 'Si vous ne souhaitez pas ajouter de sondage à votre sujet, laissez les champs vides.',
	'ALREADY_DELETED'			=> 'Désolé, mais ce message a déjà été supprimé.',
	'ATTACH_QUOTA_REACHED'		=> 'Désolé, le quota de pièces jointes du forum a été atteint.',
	'ATTACH_SIG'				=> 'Joindre une signature (les signatures peuvent être modifiées via l’UCP)',

	'BBCODE_A_HELP'				=> 'Pièce jointe intégrée : [attachment=]nomfichier.ext[/attachment]',
	'BBCODE_B_HELP'				=> 'Texte en gras : [b]texte[/b]',
	'BBCODE_C_HELP'				=> 'Affichage du code : [code]code[/code]',
	'BBCODE_E_HELP'				=> 'Liste : ajouter un élément de liste',
	'BBCODE_F_HELP'				=> 'Taille de police : [size=85]petit texte[/size]',
	'BBCODE_IS_OFF'				=> '%sBBCode%s est <em>DÉSACTIVÉ</em>',
	'BBCODE_IS_ON'				=> '%sBBCode%s est <em>ACTIVÉ</em>',
	'BBCODE_I_HELP'				=> 'Texte en italique : [i]texte[/i]',
	'BBCODE_L_HELP'				=> 'Liste : [list]texte[/list]',
	'BBCODE_LISTITEM_HELP'		=> 'Élément de liste : [*]texte[/*]',
	'BBCODE_O_HELP'				=> 'Liste ordonnée : [list=]texte[/list]',
	'BBCODE_P_HELP'				=> 'Insérer une image : [img]http://url_image[/img]',
	'BBCODE_Q_HELP'				=> 'Citer un texte : [quote]texte[/quote]',
	'BBCODE_S_HELP'				=> 'Couleur de police : [color=red]texte[/color]  Astuce : vous pouvez aussi utiliser color=#FF0000',
	'BBCODE_U_HELP'				=> 'Texte souligné : [u]texte[/u]',
	'BBCODE_W_HELP'				=> 'Insérer une URL : [url]http://url[/url] ou [url=http://url]texte du lien[/url]',
	'BBCODE_D_HELP'				=> 'Flash : [flash=largeur,hauteur]http://url[/flash]',
	'BUMP_ERROR'				=> 'Vous ne pouvez pas remonter ce sujet aussi rapidement après le dernier message.',

	'MAKE_NEWS'					=> 'Changer en « Actualité »',
	'MAKE_NEWS_GLOBAL'			=> 'Changer en « Actualité globale »',

));