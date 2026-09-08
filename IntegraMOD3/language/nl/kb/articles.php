<?php
/**
*
* Knowledge Base article catalog [Dutch]
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
    'RANDOM_TITLE'       => 'Voorbeeld van een gelokaliseerde titel',
    'RANDOM_DESCRIPTION' => 'Voorbeeld van een gelokaliseerde beschrijving',
    'RANDOM_ARTICLE'     => 'Dit is een voorbeeld van de tekst van een gelokaliseerd Kennisbank-artikel. U kunt hier BBCode gebruiken.',
));
