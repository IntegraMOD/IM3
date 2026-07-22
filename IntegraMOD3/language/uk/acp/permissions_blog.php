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
$lang['permission_cat']['blog'] = 'Блог';

// User Permissions
$lang = array_merge($lang, array(
    'acl_u_blogview'			=> array('lang' => 'Може переглядати записи блогу', 'cat' => 'blog'),
    'acl_u_blogpost'			=> array('lang' => 'Може публікувати записи блогу', 'cat' => 'blog'),
    'acl_u_blogedit'			=> array('lang' => 'Може редагувати власні записи блогу', 'cat' => 'blog'),
    'acl_u_blogdelete'			=> array('lang' => 'Може видаляти власні записи блогу', 'cat' => 'blog'),
    'acl_u_blognoapprove'		=> array('lang' => 'Записи блогу не потребують схвалення перед публічним переглядом', 'cat' => 'blog'),
    'acl_u_blogreport'			=> array('lang' => 'Може повідомляти про записи блогу та відповіді', 'cat' => 'blog'),
    'acl_u_blogreply'			=> array('lang' => 'Може коментувати записи блогу', 'cat' => 'blog'),
    'acl_u_blogreplyedit'		=> array('lang' => 'Може редагувати власні коментарі', 'cat' => 'blog'),
    'acl_u_blogreplydelete'		=> array('lang' => 'Може видаляти власні коментарі', 'cat' => 'blog'),
    'acl_u_blogreplynoapprove'	=> array('lang' => 'Коментарі не потребують схвалення перед публічним переглядом', 'cat' => 'blog'),
    'acl_u_blogbbcode'			=> array('lang' => 'Може використовувати BBCode у записах блогу та коментарях', 'cat' => 'blog'),
    'acl_u_blogsmilies'			=> array('lang' => 'Може використовувати смайлики у записах блогу та коментарях', 'cat' => 'blog'),
    'acl_u_blogimg'				=> array('lang' => 'Може публікувати зображення у записах блогу та коментарях', 'cat' => 'blog'),
    'acl_u_blogurl'				=> array('lang' => 'Може публікувати URL у записах блогу та коментарях', 'cat' => 'blog'),
    'acl_u_blogflash'			=> array('lang' => 'Може публікувати flash у записах блогу та коментарях', 'cat' => 'blog'),
    'acl_u_blogmoderate'		=> array('lang' => 'Може модерувати (редагувати та видаляти) коментарі у власному блозі.', 'cat' => 'blog'),
    'acl_u_blogattach'			=> array('lang' => 'Може публікувати вкладення у записах блогу та коментарях', 'cat' => 'blog'),
    'acl_u_blognolimitattach'	=> array('lang' => 'Може ігнорувати обмеження розміру та кількості вкладень', 'cat' => 'blog'),

    'acl_u_blog_create_poll'	=> array('lang' => 'Може створювати опитування', 'cat' => 'blog'),
    'acl_u_blog_vote'			=> array('lang' => 'Може голосувати в опитуваннях', 'cat' => 'blog'),
    'acl_u_blog_vote_change'	=> array('lang' => 'Може змінити існуючий голос', 'cat' => 'blog'),
    'acl_u_blog_style'			=> array('lang' => 'Може вибрати стиль для власного блогу', 'cat' => 'blog'),
    'acl_u_blog_css'			=> array('lang' => 'Може вводити власний CSS код для налаштування стилю блогу на свій розсуд.', 'cat' => 'blog'),
));

// Moderator Permissions
$lang = array_merge($lang, array(
    'acl_m_blogapprove'			=> array('lang' => 'Може переглядати несхвалені записи блогу та схвалювати записи блогу для публічного перегляду', 'cat' => 'blog'),
    'acl_m_blogedit'			=> array('lang' => 'Може редагувати записи блогу', 'cat' => 'blog'),
    'acl_m_bloglockedit'		=> array('lang' => 'Може блокувати редагування записів блогу', 'cat' => 'blog'),
    'acl_m_blogdelete'			=> array('lang' => 'Може видаляти та відновлювати записи блогу', 'cat' => 'blog'),
    'acl_m_blogreport'			=> array('lang' => 'Може закривати та видаляти звіти про записи блогу.', 'cat' => 'blog'),
    'acl_m_blogreplyapprove'	=> array('lang' => 'Може переглядати несхвалені коментарі та схвалювати коментарі для публічного перегляду', 'cat' => 'blog'),
    'acl_m_blogreplyedit'		=> array('lang' => 'Може редагувати коментарі', 'cat' => 'blog'),
    'acl_m_blogreplylockedit'	=> array('lang' => 'Може блокувати редагування коментарів', 'cat' => 'blog'),
    'acl_m_blogreplydelete'		=> array('lang' => 'Може видаляти та відновлювати коментарі', 'cat' => 'blog'),
    'acl_m_blogreplyreport'		=> array('lang' => 'Може закривати та видаляти звіти про коментарі.', 'cat' => 'blog'),
));

// Administrator Permissions
$lang = array_merge($lang, array(
    'acl_a_blogmanage'			=> array('lang' => 'Може змінювати налаштування Блогу', 'cat' => 'blog'),
    'acl_a_blogdelete'			=> array('lang' => 'Може назавжди видаляти записи блогу', 'cat' => 'blog'),
    'acl_a_blogreplydelete'		=> array('lang' => 'Може назавжди видаляти коментарі до записів блогу', 'cat' => 'blog'),
));
?>
