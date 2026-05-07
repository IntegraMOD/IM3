<?php
/**
*
* captcha_recaptcha_new [French]
*
* @package language
* @copyright (c) 2015 Vinny
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
	'RECAPTCHA_NEW_LANG'			=> 'fr', // reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
	'RECAPTCHA_NEW_NOT_AVAILABLE'	=> 'Pour utiliser reCAPTCHA v2, vous devez créer un compte sur <a href="http://www.google.com/recaptcha/intro/index.html">www.google.com/recaptcha</a>.',
	'CAPTCHA_RECAPTCHA_NEW'			=> 'reCAPTCHA v2',

	'RECAPTCHA_INCORRECT'			=> 'La solution que vous avez fournie est incorrecte',
	'RECAPTCHA_NOSCRIPT'			=> 'Veuillez activer JavaScript dans votre navigateur pour charger le défi.',

	'RECAPTCHA_PUBLIC'				=> 'Clé publique reCAPTCHA v2',
	'RECAPTCHA_PUBLIC_EXPLAIN'		=> 'Votre clé publique reCAPTCHA v2. Les clés peuvent être obtenues sur <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>.',
	'RECAPTCHA_PRIVATE'				=> 'Clé privée reCAPTCHA v2',
	'RECAPTCHA_PRIVATE_EXPLAIN'		=> 'Votre clé privée reCAPTCHA. Les clés peuvent être obtenues sur <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>.',

	'RECAPTCHA_NEW_EXPLAIN'			=> 'Afin d\'empêcher les soumissions automatiques, nous vous demandons de compléter le défi suivant.',
));