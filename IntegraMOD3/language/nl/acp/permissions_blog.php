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
    'acl_u_blogview'			=> array('lang' => 'Kan blogberichten bekijken', 'cat' => 'blog'),
    'acl_u_blogpost'			=> array('lang' => 'Kan blogberichten plaatsen', 'cat' => 'blog'),
    'acl_u_blogedit'			=> array('lang' => 'Kan eigen blogberichten bewerken', 'cat' => 'blog'),
    'acl_u_blogdelete'			=> array('lang' => 'Kan eigen blogberichten verwijderen', 'cat' => 'blog'),
    'acl_u_blognoapprove'		=> array('lang' => 'Blogberichten hoeven geen goedkeuring voor publieke weergave', 'cat' => 'blog'),
    'acl_u_blogreport'			=> array('lang' => 'Kan blogberichten en reacties rapporteren', 'cat' => 'blog'),
    'acl_u_blogreply'			=> array('lang' => 'Kan reageren op blogberichten', 'cat' => 'blog'),
    'acl_u_blogreplyedit'		=> array('lang' => 'Kan eigen reacties bewerken', 'cat' => 'blog'),
    'acl_u_blogreplydelete'		=> array('lang' => 'Kan eigen reacties verwijderen', 'cat' => 'blog'),
    'acl_u_blogreplynoapprove'	=> array('lang' => 'Reacties hoeven geen goedkeuring voor publieke weergave', 'cat' => 'blog'),
    'acl_u_blogbbcode'			=> array('lang' => 'Kan BBCode gebruiken in blogberichten en reacties', 'cat' => 'blog'),
    'acl_u_blogsmilies'			=> array('lang' => 'Kan smilies gebruiken in blogberichten en reacties', 'cat' => 'blog'),
    'acl_u_blogimg'				=> array('lang' => 'Kan afbeeldingen plaatsen in blogberichten en reacties', 'cat' => 'blog'),
    'acl_u_blogurl'				=> array('lang' => 'Kan URLs plaatsen in blogberichten en reacties', 'cat' => 'blog'),
    'acl_u_blogflash'			=> array('lang' => 'Kan flash plaatsen in blogberichten en reacties', 'cat' => 'blog'),
    'acl_u_blogmoderate'		=> array('lang' => 'Kan modereren (bewerken en verwijderen) reacties in eigen blog.', 'cat' => 'blog'),
    'acl_u_blogattach'			=> array('lang' => 'Kan bijlagen plaatsen in blogberichten en reacties', 'cat' => 'blog'),
    'acl_u_blognolimitattach'	=> array('lang' => 'Kan bijlagegrootte en hoeveelheidlimieten negeren', 'cat' => 'blog'),

    'acl_u_blog_create_poll'	=> array('lang' => 'Kan polls aanmaken', 'cat' => 'blog'),
    'acl_u_blog_vote'			=> array('lang' => 'Kan stemmen in polls', 'cat' => 'blog'),
    'acl_u_blog_vote_change'	=> array('lang' => 'Kan bestaande stem wijzigen', 'cat' => 'blog'),
    'acl_u_blog_style'			=> array('lang' => 'Kan een stijl selecteren om te gebruiken voor hun eigen blog', 'cat' => 'blog'),
    'acl_u_blog_css'			=> array('lang' => 'Kan hun eigen CSS-code invoeren om hun blogstijl naar wens aan te passen.', 'cat' => 'blog'),
));

// Moderator Permissions
$lang = array_merge($lang, array(
    'acl_m_blogapprove'			=> array('lang' => 'Kan niet-goedgekeurde blogberichten bekijken en blogberichten goedkeuren voor publieke weergave', 'cat' => 'blog'),
    'acl_m_blogedit'			=> array('lang' => 'Kan blogberichten bewerken', 'cat' => 'blog'),
    'acl_m_bloglockedit'		=> array('lang' => 'Kan bewerken van blogberichten vergrendelen', 'cat' => 'blog'),
    'acl_m_blogdelete'			=> array('lang' => 'Kan blogberichten verwijderen en herstellen', 'cat' => 'blog'),
    'acl_m_blogreport'			=> array('lang' => 'Kan blogberichtrapportages sluiten en verwijderen.', 'cat' => 'blog'),
    'acl_m_blogreplyapprove'	=> array('lang' => 'Kan niet-goedgekeurde reacties bekijken en reacties goedkeuren voor publieke weergave', 'cat' => 'blog'),
    'acl_m_blogreplyedit'		=> array('lang' => 'Kan reacties bewerken', 'cat' => 'blog'),
    'acl_m_blogreplylockedit'	=> array('lang' => 'Kan bewerken van reacties vergrendelen', 'cat' => 'blog'),
    'acl_m_blogreplydelete'		=> array('lang' => 'Kan reacties verwijderen en herstellen', 'cat' => 'blog'),
    'acl_m_blogreplyreport'		=> array('lang' => 'Kan reactierapportages sluiten en verwijderen.', 'cat' => 'blog'),
));

// Administrator Permissions
$lang = array_merge($lang, array(
    'acl_a_blogmanage'			=> array('lang' => 'Kan Blog instellingen wijzigen', 'cat' => 'blog'),
    'acl_a_blogdelete'			=> array('lang' => 'Kan blogberichten permanent verwijderen', 'cat' => 'blog'),
    'acl_a_blogreplydelete'		=> array('lang' => 'Kan reacties op blogberichten permanent verwijderen', 'cat' => 'blog'),
));
?>
