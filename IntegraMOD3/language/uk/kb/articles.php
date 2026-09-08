<?php
/**
*
* Knowledge Base article catalog [Ukrainian]
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
    'RANDOM_TITLE'       => 'Приклад локалізованого заголовка',
    'RANDOM_DESCRIPTION' => 'Приклад локалізованого опису',
    'RANDOM_ARTICLE'     => 'Це приклад тіла локалізованої статті бази знань. Тут ви можете використовувати BBCode.',
));
