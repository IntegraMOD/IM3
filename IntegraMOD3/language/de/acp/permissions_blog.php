<?php
/**
* @package language(permissions)
* @version $Id: permissions_blog.php 485 2008-08-15 23:33:57Z exreaction@gmail.com $
* @copyright (c) 2008 EXreaction, Lithium Studios
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

// Create the lang array if it does not already exist
if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

// Create a new category named Blog
$lang['permission_cat']['blog'] = 'Blog';

// User Permissions
$lang = array_merge($lang, array(
    'acl_u_blogview'			=> array('lang' => 'Kann Blogeinträge ansehen', 'cat' => 'blog'),
    'acl_u_blogpost'			=> array('lang' => 'Kann Blogeinträge posten', 'cat' => 'blog'),
    'acl_u_blogedit'			=> array('lang' => 'Kann eigene Blogeinträge bearbeiten', 'cat' => 'blog'),
    'acl_u_blogdelete'			=> array('lang' => 'Kann eigene Blogeinträge löschen', 'cat' => 'blog'),
    'acl_u_blognoapprove'		=> array('lang' => 'Blogeinträge benötigen keine Genehmigung vor öffentlicher Ansicht', 'cat' => 'blog'),
    'acl_u_blogreport'			=> array('lang' => 'Kann Blogeinträge und Antworten melden', 'cat' => 'blog'),
    'acl_u_blogreply'			=> array('lang' => 'Kann Blogeinträge kommentieren', 'cat' => 'blog'),
    'acl_u_blogreplyedit'		=> array('lang' => 'Kann eigene Kommentare bearbeiten', 'cat' => 'blog'),
    'acl_u_blogreplydelete'		=> array('lang' => 'Kann eigene Kommentare löschen', 'cat' => 'blog'),
    'acl_u_blogreplynoapprove'	=> array('lang' => 'Kommentare benötigen keine Genehmigung vor öffentlicher Ansicht', 'cat' => 'blog'),
    'acl_u_blogbbcode'			=> array('lang' => 'Kann BBCode in Blogeinträgen und Kommentaren verwenden', 'cat' => 'blog'),
    'acl_u_blogsmilies'			=> array('lang' => 'Kann Smilies in Blogeinträgen und Kommentaren verwenden', 'cat' => 'blog'),
    'acl_u_blogimg'				=> array('lang' => 'Kann Bilder in Blogeinträgen und Kommentaren posten', 'cat' => 'blog'),
    'acl_u_blogurl'				=> array('lang' => 'Kann URLs in Blogeinträgen und Kommentaren posten', 'cat' => 'blog'),
    'acl_u_blogflash'			=> array('lang' => 'Kann Flash in Blogeinträgen und Kommentaren posten', 'cat' => 'blog'),
    'acl_u_blogmoderate'		=> array('lang' => 'Kann Kommentare im eigenen Blog moderieren (bearbeiten und löschen).', 'cat' => 'blog'),
    'acl_u_blogattach'			=> array('lang' => 'Kann Anhänge in Blogeinträgen und Kommentaren posten', 'cat' => 'blog'),
    'acl_u_blognolimitattach'	=> array('lang' => 'Kann Anhangsgröße und Mengeneinschränkungen ignorieren', 'cat' => 'blog'),

    'acl_u_blog_create_poll'	=> array('lang' => 'Kann Umfragen erstellen', 'cat' => 'blog'),
    'acl_u_blog_vote'			=> array('lang' => 'Kann in Umfragen abstimmen', 'cat' => 'blog'),
    'acl_u_blog_vote_change'	=> array('lang' => 'Kann bestehende Stimme ändern', 'cat' => 'blog'),
    'acl_u_blog_style'			=> array('lang' => 'Kann einen Stil für ihren eigenen Blog auswählen', 'cat' => 'blog'),
    'acl_u_blog_css'			=> array('lang' => 'Kann eigenen CSS-Code eingeben, um ihren Blogstil nach Wunsch anzupassen.', 'cat' => 'blog'),
));

// Moderator Permissions
$lang = array_merge($lang, array(
    'acl_m_blogapprove'			=> array('lang' => 'Kann nicht genehmigte Blogeinträge ansehen und Blogeinträge für öffentliche Ansicht genehmigen', 'cat' => 'blog'),
    'acl_m_blogedit'			=> array('lang' => 'Kann Blogeinträge bearbeiten', 'cat' => 'blog'),
    'acl_m_bloglockedit'		=> array('lang' => 'Kann Bearbeitung von Blogeinträgen sperren', 'cat' => 'blog'),
    'acl_m_blogdelete'			=> array('lang' => 'Kann Blogeinträge löschen und wiederherstellen', 'cat' => 'blog'),
    'acl_m_blogreport'			=> array('lang' => 'Kann Blogeintragsmeldungen schließen und löschen.', 'cat' => 'blog'),
    'acl_m_blogreplyapprove'	=> array('lang' => 'Kann nicht genehmigte Kommentare ansehen und Kommentare für öffentliche Ansicht genehmigen', 'cat' => 'blog'),
    'acl_m_blogreplyedit'		=> array('lang' => 'Kann Kommentare bearbeiten', 'cat' => 'blog'),
    'acl_m_blogreplylockedit'	=> array('lang' => 'Kann Bearbeitung von Kommentaren sperren', 'cat' => 'blog'),
    'acl_m_blogreplydelete'		=> array('lang' => 'Kann Kommentare löschen und wiederherstellen', 'cat' => 'blog'),
    'acl_m_blogreplyreport'		=> array('lang' => 'Kann Kommentarmeldungen schließen und löschen.', 'cat' => 'blog'),
));

// Administrator Permissions
$lang = array_merge($lang, array(
    'acl_a_blogmanage'			=> array('lang' => 'Kann Blog-Einstellungen ändern', 'cat' => 'blog'),
    'acl_a_blogdelete'			=> array('lang' => 'Kann Blogeinträge dauerhaft löschen', 'cat' => 'blog'),
    'acl_a_blogreplydelete'		=> array('lang' => 'Kann Kommentare zu Blogeinträgen dauerhaft löschen', 'cat' => 'blog'),
));
?>
