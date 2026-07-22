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
    'ACP_BLOGS'						=> 'Benutzer Blog Mod',
    'ACP_BLOG_CATEGORIES'			=> 'Blog Kategorien',
    'ACP_BLOG_PLUGINS'				=> 'Blog Plugins',
    'ACP_BLOG_SEARCH'				=> 'Blog Suche',
    'ACP_BLOG_SETTINGS'				=> 'Blog Einstellungen',

    'IMG_BUTTON_BLOG_NEW'			=> 'Neuer Blogeintrag',

    'LOG_ADDED_BLOG'				=> '<strong>Neuer Blogeintrag Hinzugefügt</strong><br />» %s',
    'LOG_EDITED_BLOG'				=> '<strong>Blogeintrag Bearbeitet</strong><br />» %s',
    'LOG_ADDED_BLOG_REPLY'			=> '<strong>Neue Blogantwort Hinzugefügt</strong><br />» %s',
    'LOG_EDITED_BLOG_REPLY'			=> '<strong>Blogantwort Bearbeitet</strong><br />» %s',
    'LOG_BLOG_CATEGORY_ADD'			=> '<strong>Neue Blogkategorie Hinzugefügt</strong><br />» %s',
    'LOG_BLOG_CATEGORY_DELETE'		=> '<strong>Blogkategorie Gelöscht</strong><br />» %s',
    'LOG_BLOG_CATEGORY_EDIT'		=> '<strong>Blogkategorie Bearbeitet</strong><br />» %s',
    'LOG_BLOG_CONFIG'				=> '<strong>Blog Einstellungen Geändert</strong>',
    'LOG_BLOG_CONFIG_SEARCH'		=> '<strong>Blog Sucheinstellungen Geändert</strong>',
    'LOG_BLOG_PLUGIN_DISABLED'		=> '<strong>Blog Plugin Deaktiviert</strong><br />» %s',
    'LOG_BLOG_PLUGIN_ENABLED'		=> '<strong>Blog Plugin Aktiviert</strong><br />» %s',
    'LOG_BLOG_PLUGIN_INSTALLED'		=> '<strong>Blog Plugin Installiert</strong><br />» %s',
    'LOG_BLOG_PLUGIN_UNINSTALLED'	=> '<strong>Blog Plugin Deinstalliert</strong><br />» %s',
    'LOG_BLOG_PLUGIN_UPDATED'		=> '<strong>Blog Plugin Aktualisiert</strong><br />» %s',
    'LOG_BLOG_SEARCH_INDEX_CREATED'	=> '<strong>Blog Suchindex Neu Erstellt</strong>',
    'LOG_BLOG_SEARCH_INDEX_REMOVED'	=> '<strong>Blog Suchindex Gelöscht</strong>',
));

?>
