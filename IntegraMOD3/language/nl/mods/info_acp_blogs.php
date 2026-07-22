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
    'ACP_BLOGS'						=> 'Gebruiker Blog Mod',
    'ACP_BLOG_CATEGORIES'			=> 'Blog Categorieën',
    'ACP_BLOG_PLUGINS'				=> 'Blog Plugins',
    'ACP_BLOG_SEARCH'				=> 'Blog Zoeken',
    'ACP_BLOG_SETTINGS'				=> 'Blog Instellingen',

    'IMG_BUTTON_BLOG_NEW'			=> 'Nieuw Blogbericht',

    'LOG_ADDED_BLOG'				=> '<strong>Nieuw Blogbericht Toegevoegd</strong><br />» %s',
    'LOG_EDITED_BLOG'				=> '<strong>Blogbericht Bewerkt</strong><br />» %s',
    'LOG_ADDED_BLOG_REPLY'			=> '<strong>Nieuwe Blogreactie Toegevoegd</strong><br />» %s',
    'LOG_EDITED_BLOG_REPLY'			=> '<strong>Blogreactie Bewerkt</strong><br />» %s',
    'LOG_BLOG_CATEGORY_ADD'			=> '<strong>Nieuwe Blogcategorie Toegevoegd</strong><br />» %s',
    'LOG_BLOG_CATEGORY_DELETE'		=> '<strong>Blogcategorie Verwijderd</strong><br />» %s',
    'LOG_BLOG_CATEGORY_EDIT'		=> '<strong>Blogcategorie Bewerkt</strong><br />» %s',
    'LOG_BLOG_CONFIG'				=> '<strong>Blog Instellingen Gewijzigd</strong>',
    'LOG_BLOG_CONFIG_SEARCH'		=> '<strong>Blog Zoekinstellingen Gewijzigd</strong>',
    'LOG_BLOG_PLUGIN_DISABLED'		=> '<strong>Blog Plugin Uitgeschakeld</strong><br />» %s',
    'LOG_BLOG_PLUGIN_ENABLED'		=> '<strong>Blog Plugin Ingeschakeld</strong><br />» %s',
    'LOG_BLOG_PLUGIN_INSTALLED'		=> '<strong>Blog Plugin Geïnstalleerd</strong><br />» %s',
    'LOG_BLOG_PLUGIN_UNINSTALLED'	=> '<strong>Blog Plugin Verwijderd</strong><br />» %s',
    'LOG_BLOG_PLUGIN_UPDATED'		=> '<strong>Blog Plugin Bijgewerkt</strong><br />» %s',
    'LOG_BLOG_SEARCH_INDEX_CREATED'	=> '<strong>Blog Zoekindex Herbouwd</strong>',
    'LOG_BLOG_SEARCH_INDEX_REMOVED'	=> '<strong>Blog Zoekindex Verwijderd</strong>',
));

?>
