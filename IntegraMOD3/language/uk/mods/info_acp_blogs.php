<?php
/**
*
* @package phpBB3 User Blog
* @version $Id: info_acp_blogs.php 493 2008-08-28 17:43:39Z exreaction@gmail.com $
* @copyright (c) 2008 EXreaction, Lithium Studios
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

// Create the lang array if it does not already exist
if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

// Merge the following language entries into the lang array
$lang = array_merge($lang, array(
    'ACP_BLOGS'						=> 'Користувацький Блог Мод',
    'ACP_BLOG_CATEGORIES'			=> 'Категорії Блогу',
    'ACP_BLOG_PLUGINS'				=> 'Плагіни Блогу',
    'ACP_BLOG_SEARCH'				=> 'Пошук Блогу',
    'ACP_BLOG_SETTINGS'				=> 'Налаштування Блогу',

    'IMG_BUTTON_BLOG_NEW'			=> 'Новий Запис Блогу',

    'LOG_ADDED_BLOG'				=> '<strong>Додано Новий Запис Блогу</strong><br />» %s',
    'LOG_EDITED_BLOG'				=> '<strong>Відредаговано Запис Блогу</strong><br />» %s',
    'LOG_ADDED_BLOG_REPLY'			=> '<strong>Додано Нову Відповідь Блогу</strong><br />» %s',
    'LOG_EDITED_BLOG_REPLY'			=> '<strong>Відредаговано Відповідь Блогу</strong><br />» %s',
    'LOG_BLOG_CATEGORY_ADD'			=> '<strong>Додано Нову Категорію Блогу</strong><br />» %s',
    'LOG_BLOG_CATEGORY_DELETE'		=> '<strong>Видалено Категорію Блогу</strong><br />» %s',
    'LOG_BLOG_CATEGORY_EDIT'		=> '<strong>Відредаговано Категорію Блогу</strong><br />» %s',
    'LOG_BLOG_CONFIG'				=> '<strong>Змінено Налаштування Блогу</strong>',
    'LOG_BLOG_CONFIG_SEARCH'		=> '<strong>Змінено Налаштування Пошуку Блогу</strong>',
    'LOG_BLOG_PLUGIN_DISABLED'		=> '<strong>Вимкнено Плагін Блогу</strong><br />» %s',
    'LOG_BLOG_PLUGIN_ENABLED'		=> '<strong>Увімкнено Плагін Блогу</strong><br />» %s',
    'LOG_BLOG_PLUGIN_INSTALLED'		=> '<strong>Встановлено Плагін Блогу</strong><br />» %s',
    'LOG_BLOG_PLUGIN_UNINSTALLED'	=> '<strong>Видалено Плагін Блогу</strong><br />» %s',
    'LOG_BLOG_PLUGIN_UPDATED'		=> '<strong>Оновлено Плагін Блогу</strong><br />» %s',
    'LOG_BLOG_SEARCH_INDEX_CREATED'	=> '<strong>Перебудовано Індекс Пошуку Блогу</strong>',
    'LOG_BLOG_SEARCH_INDEX_REMOVED'	=> '<strong>Видалено Індекс Пошуку Блогу</strong>',
));

?>
