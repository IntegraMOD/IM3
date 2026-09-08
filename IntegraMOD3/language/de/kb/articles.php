<?php
/**
*
* Knowledge Base article catalog [German]
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
    'RANDOM_TITLE'       => 'Beispiel für einen lokalisierten Titel',
    'RANDOM_DESCRIPTION' => 'Beispiel für eine lokalisierte Beschreibung',
    'RANDOM_ARTICLE'     => 'Dies ist ein Beispiel für den Text eines lokalisierten Wissensdatenbank-Artikels. Sie können hier BBCode verwenden.',
));
