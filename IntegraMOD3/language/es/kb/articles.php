<?php
/**
*
* Knowledge Base article catalog [Spanish]
*
* Use whole-field tokens such as {L_RANDOM_NAME} in the article title,
* description, or body when creating a Knowledge Base article.
* Do not merge this file into $user->lang.
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
    'RANDOM_TITLE'       => 'Ejemplo de título localizado',
    'RANDOM_DESCRIPTION' => 'Ejemplo de descripción localizada',
    'RANDOM_ARTICLE'     => 'Este es un ejemplo del cuerpo de un artículo de la Base de Conocimientos localizado. Puede usar BBCode aquí.',
));
