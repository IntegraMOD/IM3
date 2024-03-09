<?php
/**
*
* recaptcha [Dutch]
*
* @package language
* @copyright (c) 2009 phpBB Group
* @copyright (c) 2009 phpBB.nl
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	'RECAPTCHA_LANG'				=> 'nl',
	'RECAPTCHA_NOT_AVAILABLE'		=> 'Om gebruik te kunnen maken van reCaptcha, moet je een account hebben op <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>.',
	'CAPTCHA_RECAPTCHA'				=> 'reCaptcha',
	'RECAPTCHA_INCORRECT'			=> 'De visuele bevestigingscode die je invoerde was onjuist',

	'RECAPTCHA_PUBLIC'				=> 'Publieke reCaptcha sleutel',
	'RECAPTCHA_PUBLIC_EXPLAIN'		=> 'Jouw publieke reCaptcha sleutel. Sleutels kunnen worden verkregen via <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>.',
	'RECAPTCHA_PRIVATE'				=> 'Privé reCaptcha sleutel',
	'RECAPTCHA_PRIVATE_EXPLAIN'		=> 'Jouw privé reCaptcha sleutel. Sleutels kunnen worden verkregen via <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>.',

	'RECAPTCHA_EXPLAIN'				=> 'In een poging om automatische registraties te voorkomen, verzoeken we je de beide woorden die worden weergegeven in het tekstveld in te vullen.',
));

