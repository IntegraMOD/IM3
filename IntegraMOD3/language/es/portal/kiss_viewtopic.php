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

	'ADD_ATTACHMENT'			=> 'Subir archivo adjunto',
	'ADD_ATTACHMENT_EXPLAIN'	=> 'Si desea adjuntar uno o varios archivos rellene el formulario.',
	'ADD_FILE'					=> 'Agregue el archivo',
	'ADD_POLL'					=> 'Agregar Encuesta',
	'ADD_POLL_EXPLAIN'			=> 'Si no desea agregar una encuesta a su tema deje los campos en blanco.',
	'ALREADY_DELETED'			=> 'Lo sentimos, pero ya se borra este mensaje.',
	'ATTACH_QUOTA_REACHED'		=> 'Lo sentimos, se ha alcanzado la cuota atadura.',
	'ATTACH_SIG'				=> 'Adjuntar una firma (la firma puede ser alterada a través de la UCP)',

	'BBCODE_A_HELP'				=> 'En línea archivo adjunto cargado: [attachment=]filename.ext[/attachment]',
	'BBCODE_B_HELP'				=> 'El texto en negrita: [b]texto[/b]',
	'BBCODE_C_HELP'				=> 'pantalla Código: [code]code[/code]',
	'BBCODE_E_HELP'				=> 'lista: Agregar lista de elementos',
	'BBCODE_F_HELP'				=> 'tamaño de letra: [size=85]texto pequeño[/size]',
	'BBCODE_IS_OFF'				=> '%sBBCode%s is <em>OFF</em>',
	'BBCODE_IS_ON'				=> '%sBBCode%s is <em>EN</em>',
	'BBCODE_I_HELP'				=> 'El texto en cursiva: [i]texto[/i]',
	'BBCODE_L_HELP'				=> 'lista: [list]texto[/list]',
	'BBCODE_LISTITEM_HELP'		=> 'elemento de la lista: [*]texto[/*]',
	'BBCODE_O_HELP'				=> 'lista ordenada: [list=]texto[/list]',
	'BBCODE_P_HELP'				=> 'insertar una imagen: [img]http://image_url[/img]',
	'BBCODE_Q_HELP'				=> 'texto Cita: [quote]texto[/quote]',
	'BBCODE_S_HELP'				=> 'Color de fuente: [color=red]texto[/color]  Tip: you can also use color=#FF0000',
	'BBCODE_U_HELP'				=> 'Subrayar texto: [u]texto[/u]',
	'BBCODE_W_HELP'				=> 'insertar URL: [url]http://url[/url] or [url=http://url]URL texto[/url]',
	'BBCODE_D_HELP'				=> 'Flash: [flash=anchura, altura]http://url[/flash]',
	'BUMP_ERROR'				=> 'No se puede topar este tema tan pronto después del último mensaje.',

	'MAKE_NEWS'					=> 'Cambie a "Noticias"',
	'MAKE_NEWS_GLOBAL'			=> 'Cambie a "Noticias Globales"',

));