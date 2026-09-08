<?php
/**
*
* Knowledge Base article catalog [English]
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
    'RANDOM_TITLE'       => 'Exemple de titre localisé',
    'RANDOM_DESCRIPTION' => 'Exemple de description localisée',
    'RANDOM_ARTICLE'     => 'Ceci est un exemple de corps d\'article de base de connaissances localisé. Vous pouvez utiliser du BBCode ici.',
));
