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
    'RANDOM_TITLE'		 => 'Example localized title',
	'RANDOM_DESCRIPTION' => 'Example localized description',
	'RANDOM_ARTICLE'	 => 'This is an example localized Knowledge Base article body. You may use BBCode here.',
));
