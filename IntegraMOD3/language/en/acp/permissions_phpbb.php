<?php
/**
* acp_permissions_phpbb (phpBB Permission Set) [English]
*
* @package language
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

/**
*	MODDERS PLEASE NOTE
*
*	You are able to put your permission sets into a separate file too by
*	prefixing the new file with permissions_ and putting it into the acp
*	language folder.
*
*	An example of how the file could look like:
*
*	<code>
*
*	if (empty($lang) || !is_array($lang))
*	{
*		$lang = array();
*	}
*
*	// Adding new category
*	$lang['permission_cat']['bugs'] = 'Bugs';
*
*	// Adding new permission set
*	$lang['permission_type']['bug_'] = 'Bug Permissions';
*
*	// Adding the permissions
*	$lang = array_merge($lang, array(
*		'acl_bug_view'		=> array('lang' => 'Can view bug reports', 'cat' => 'bugs'),
*		'acl_bug_post'		=> array('lang' => 'Can post bugs', 'cat' => 'post'), // Using a phpBB category here
*	));
*
*	</code>
*/

// Define categories and permission types
$lang = array_merge($lang, array(
	'permission_cat'	=> array(
		'actions'		=> 'Actions',
		'content'		=> 'Content',
		'forums'		=> 'Forums',
		'misc'			=> 'Misc',
		'permissions'	=> 'Permissions',
		'pm'			=> 'Private messages',
		'polls'			=> 'Polls',
		'post'			=> 'Post',
		'post_actions'	=> 'Post actions',
		'posting'		=> 'Posting',
		'profile'		=> 'Profile',
		'settings'		=> 'Settings',
		'topic_actions'	=> 'Topic actions',
		'user_group'	=> 'Users &amp; Groups',
		'meeting'		=> 'Meetings',
	),

	// With defining 'global' here we are able to specify what is printed out if the permission is within the global scope.
	'permission_type'	=> array(
		'u_'			=> 'User permissions',
		'a_'			=> 'Admin permissions',
		'm_'			=> 'Moderator permissions',
		'f_'			=> 'Forum permissions',
		'global'		=> array(
			'm_'			=> 'Global moderator permissions',
		),
	),
));

// User Permissions
$lang = array_merge($lang, array(
	'acl_u_viewprofile'	=> array('lang' => 'Can view profiles, memberlist and online list', 'cat' => 'profile'),
	'acl_u_chgname'		=> array('lang' => 'Can change username', 'cat' => 'profile'),
	'acl_u_chgpasswd'	=> array('lang' => 'Can change password', 'cat' => 'profile'),
	'acl_u_chgemail'	=> array('lang' => 'Can change e-mail address', 'cat' => 'profile'),
	'acl_u_chgavatar'	=> array('lang' => 'Can change avatar', 'cat' => 'profile'),
	'acl_u_chggrp'		=> array('lang' => 'Can change default usergroup', 'cat' => 'profile'),

	'acl_u_attach'		=> array('lang' => 'Can attach files', 'cat' => 'post'),
	'acl_u_download'	=> array('lang' => 'Can download files', 'cat' => 'post'),
	'acl_u_savedrafts'	=> array('lang' => 'Can save drafts', 'cat' => 'post'),
	'acl_u_chgcensors'	=> array('lang' => 'Can disable word censors', 'cat' => 'post'),
	'acl_u_sig'			=> array('lang' => 'Can use signature', 'cat' => 'post'),

	'acl_u_sendpm'		=> array('lang' => 'Can send private messages', 'cat' => 'pm'),
	'acl_u_masspm'		=> array('lang' => 'Can send messages to multiple users', 'cat' => 'pm'),
	'acl_u_masspm_group'=> array('lang' => 'Can send messages to groups', 'cat' => 'pm'),
	'acl_u_readpm'		=> array('lang' => 'Can read private messages', 'cat' => 'pm'),
	'acl_u_pm_edit'		=> array('lang' => 'Can edit own private messages', 'cat' => 'pm'),
	'acl_u_pm_delete'	=> array('lang' => 'Can remove private messages from own folder', 'cat' => 'pm'),
	'acl_u_pm_forward'	=> array('lang' => 'Can forward private messages', 'cat' => 'pm'),
	'acl_u_pm_emailpm'	=> array('lang' => 'Can e-mail private messages', 'cat' => 'pm'),
	'acl_u_pm_printpm'	=> array('lang' => 'Can print private messages', 'cat' => 'pm'),
	'acl_u_pm_attach'	=> array('lang' => 'Can attach files in private messages', 'cat' => 'pm'),
	'acl_u_pm_download'	=> array('lang' => 'Can download files in private messages', 'cat' => 'pm'),
	'acl_u_pm_bbcode'	=> array('lang' => 'Can use BBCode in private messages', 'cat' => 'pm'),
	'acl_u_pm_smilies'	=> array('lang' => 'Can use smilies in private messages', 'cat' => 'pm'),
	'acl_u_pm_img'		=> array('lang' => 'Can use [img] BBCode tag in private messages', 'cat' => 'pm'),
	'acl_u_pm_flash'	=> array('lang' => 'Can use [flash] BBCode tag in private messages', 'cat' => 'pm'),

	'acl_u_sendemail'	=> array('lang' => 'Can send e-mails', 'cat' => 'misc'),
	'acl_u_sendim'		=> array('lang' => 'Can send instant messages', 'cat' => 'misc'),
	'acl_u_ignoreflood'	=> array('lang' => 'Can ignore flood limit', 'cat' => 'misc'),
	'acl_u_hideonline'	=> array('lang' => 'Can hide online status', 'cat' => 'misc'),
	'acl_u_viewonline'	=> array('lang' => 'Can view hidden online users', 'cat' => 'misc'),
	'acl_u_search'		=> array('lang' => 'Can search board', 'cat' => 'misc'),
	
	'acl_u_kb'		=> array('lang' => 'Can view Knowledge Base link on header', 'cat' => 'misc'),
	'acl_u_cal'		=> array('lang' => 'Can view Topic Calendar link on header', 'cat' => 'misc'),
	'acl_u_gall'	=> array('lang' => 'Can view Gallery link on header', 'cat' => 'misc'),
	'acl_u_cht'		=> array('lang' => 'Can view Chat link on header', 'cat' => 'misc'),
	'acl_u_dls'		=> array('lang' => 'Can view Downloads link on header', 'cat' => 'misc'),
	'acl_u_faq'		=> array('lang' => 'Can view FAQ link on header', 'cat' => 'misc'),
	'acl_u_mem'		=> array('lang' => 'Can view Memberlist link on header', 'cat' => 'misc'),
	'acl_u_notes'	=> array('lang' => 'Can view Notes link on header', 'cat' => 'misc'),
	'acl_u_meeting'	=> array('lang' => 'Can view Meeting link on header', 'cat' => 'misc'),
	'acl_u_contact'	=> array('lang' => 'Can view Contact link on header', 'cat' => 'misc'),

));

// Forum Permissions
$lang = array_merge($lang, array(
	'acl_f_list'		=> array('lang' => 'Can see forum', 'cat' => 'post'),
	'acl_f_read'		=> array('lang' => 'Can read forum', 'cat' => 'post'),
	'acl_f_post'		=> array('lang' => 'Can start new topics', 'cat' => 'post'),
	'acl_f_reply'		=> array('lang' => 'Can reply to topics', 'cat' => 'post'),
	'acl_f_icons'		=> array('lang' => 'Can use topic/post icons', 'cat' => 'post'),
	'acl_f_announce'	=> array('lang' => 'Can post announcements', 'cat' => 'post'),
	'acl_f_sticky'		=> array('lang' => 'Can post stickies', 'cat' => 'post'),

	'acl_f_poll'		=> array('lang' => 'Can create polls', 'cat' => 'polls'),
	'acl_f_vote'		=> array('lang' => 'Can vote in polls', 'cat' => 'polls'),
	'acl_f_votechg'		=> array('lang' => 'Can change existing vote', 'cat' => 'polls'),

	'acl_f_attach'		=> array('lang' => 'Can attach files', 'cat' => 'content'),
	'acl_f_download'	=> array('lang' => 'Can download files', 'cat' => 'content'),
	'acl_f_sigs'		=> array('lang' => 'Can use signatures', 'cat' => 'content'),
	'acl_f_bbcode'		=> array('lang' => 'Can use BBCode', 'cat' => 'content'),
	'acl_f_smilies'		=> array('lang' => 'Can use smilies', 'cat' => 'content'),
	'acl_f_img'			=> array('lang' => 'Can use [img] BBCode tag', 'cat' => 'content'),
	'acl_f_flash'		=> array('lang' => 'Can use [flash] BBCode tag', 'cat' => 'content'),

	'acl_f_edit'		=> array('lang' => 'Can edit own posts', 'cat' => 'actions'),
	'acl_f_delete'		=> array('lang' => 'Can delete own posts', 'cat' => 'actions'),
	'acl_f_user_lock'	=> array('lang' => 'Can lock own topics', 'cat' => 'actions'),
	'acl_f_bump'		=> array('lang' => 'Can bump topics', 'cat' => 'actions'),
	'acl_f_report'		=> array('lang' => 'Can report posts', 'cat' => 'actions'),
	'acl_f_subscribe'	=> array('lang' => 'Can subscribe forum', 'cat' => 'actions'),
	'acl_f_print'		=> array('lang' => 'Can print topics', 'cat' => 'actions'),
	'acl_f_email'		=> array('lang' => 'Can e-mail topics', 'cat' => 'actions'),

	'acl_f_search'		=> array('lang' => 'Can search the forum', 'cat' => 'misc'),
	'acl_f_ignoreflood' => array('lang' => 'Can ignore flood limit', 'cat' => 'misc'),
	'acl_f_postcount'	=> array('lang' => 'Increment post counter<br /><em>Please note that this setting only affects new posts.</em>', 'cat' => 'misc'),
	'acl_f_noapprove'	=> array('lang' => 'Can post without approval', 'cat' => 'misc'),
));

// Moderator Permissions
$lang = array_merge($lang, array(
	'acl_m_edit'		=> array('lang' => 'Can edit posts', 'cat' => 'post_actions'),
	'acl_m_delete'		=> array('lang' => 'Can delete posts', 'cat' => 'post_actions'),
	'acl_m_approve'		=> array('lang' => 'Can approve posts', 'cat' => 'post_actions'),
	'acl_m_report'		=> array('lang' => 'Can close and delete reports', 'cat' => 'post_actions'),
	'acl_m_chgposter'	=> array('lang' => 'Can change post author', 'cat' => 'post_actions'),

	'acl_m_move'	=> array('lang' => 'Can move topics', 'cat' => 'topic_actions'),
	'acl_m_lock'	=> array('lang' => 'Can lock topics', 'cat' => 'topic_actions'),
	'acl_m_split'	=> array('lang' => 'Can split topics', 'cat' => 'topic_actions'),
	'acl_m_merge'	=> array('lang' => 'Can merge topics', 'cat' => 'topic_actions'),

	'acl_m_info'	=> array('lang' => 'Can view post details', 'cat' => 'misc'),
	'acl_m_warn'	=> array('lang' => 'Can issue warnings<br /><em>This setting is only assigned globally. It is not forum based.</em>', 'cat' => 'misc'), // This moderator setting is only global (and not local)
	'acl_m_ban'		=> array('lang' => 'Can manage bans<br /><em>This setting is only assigned globally. It is not forum based.</em>', 'cat' => 'misc'), // This moderator setting is only global (and not local)
));

// Admin Permissions
$lang = array_merge($lang, array(
	'acl_a_board'		=> array('lang' => 'Can alter board settings/check for updates', 'cat' => 'settings'),
	'acl_a_server'		=> array('lang' => 'Can alter server/communication settings', 'cat' => 'settings'),
	'acl_a_jabber'		=> array('lang' => 'Can alter Jabber settings', 'cat' => 'settings'),
	'acl_a_phpinfo'		=> array('lang' => 'Can view php settings', 'cat' => 'settings'),

	'acl_a_forum'		=> array('lang' => 'Can manage forums', 'cat' => 'forums'),
	'acl_a_forumadd'	=> array('lang' => 'Can add new forums', 'cat' => 'forums'),
	'acl_a_forumdel'	=> array('lang' => 'Can delete forums', 'cat' => 'forums'),
	'acl_a_prune'		=> array('lang' => 'Can prune forums', 'cat' => 'forums'),

	'acl_a_icons'		=> array('lang' => 'Can alter topic/post icons and smilies', 'cat' => 'posting'),
	'acl_a_words'		=> array('lang' => 'Can alter word censors', 'cat' => 'posting'),
	'acl_a_bbcode'		=> array('lang' => 'Can define BBCode tags', 'cat' => 'posting'),
	'acl_a_attach'		=> array('lang' => 'Can alter attachment related settings', 'cat' => 'posting'),

	'acl_a_user'		=> array('lang' => 'Can manage users<br /><em>This also includes seeing the users browser agent within the viewonline list.</em>', 'cat' => 'user_group'),
	'acl_a_userdel'		=> array('lang' => 'Can delete/prune users', 'cat' => 'user_group'),
	'acl_a_group'		=> array('lang' => 'Can manage groups', 'cat' => 'user_group'),
	'acl_a_groupadd'	=> array('lang' => 'Can add new groups', 'cat' => 'user_group'),
	'acl_a_groupdel'	=> array('lang' => 'Can delete groups', 'cat' => 'user_group'),
	'acl_a_ranks'		=> array('lang' => 'Can manage ranks', 'cat' => 'user_group'),
	'acl_a_profile'		=> array('lang' => 'Can manage custom profile fields', 'cat' => 'user_group'),
	'acl_a_names'		=> array('lang' => 'Can manage disallowed names', 'cat' => 'user_group'),
	'acl_a_ban'			=> array('lang' => 'Can manage bans', 'cat' => 'user_group'),

	'acl_a_viewauth'	=> array('lang' => 'Can view permission masks', 'cat' => 'permissions'),
	'acl_a_authgroups'	=> array('lang' => 'Can alter permissions for individual groups', 'cat' => 'permissions'),
	'acl_a_authusers'	=> array('lang' => 'Can alter permissions for individual users', 'cat' => 'permissions'),
	'acl_a_fauth'		=> array('lang' => 'Can alter forum permission class', 'cat' => 'permissions'),
	'acl_a_mauth'		=> array('lang' => 'Can alter moderator permission class', 'cat' => 'permissions'),
	'acl_a_aauth'		=> array('lang' => 'Can alter admin permission class', 'cat' => 'permissions'),
	'acl_a_uauth'		=> array('lang' => 'Can alter user permission class', 'cat' => 'permissions'),
	'acl_a_roles'		=> array('lang' => 'Can manage roles', 'cat' => 'permissions'),
	'acl_a_switchperm'	=> array('lang' => 'Can use others permissions', 'cat' => 'permissions'),

	'acl_a_styles'		=> array('lang' => 'Can manage styles', 'cat' => 'misc'),
	'acl_a_viewlogs'	=> array('lang' => 'Can view logs', 'cat' => 'misc'),
	'acl_a_clearlogs'	=> array('lang' => 'Can clear logs', 'cat' => 'misc'),
	'acl_a_modules'		=> array('lang' => 'Can manage modules', 'cat' => 'misc'),
	'acl_a_language'	=> array('lang' => 'Can manage language packs', 'cat' => 'misc'),
	'acl_a_email'		=> array('lang' => 'Can send mass e-mail', 'cat' => 'misc'),
	'acl_a_bots'		=> array('lang' => 'Can manage bots', 'cat' => 'misc'),
	'acl_a_reasons'		=> array('lang' => 'Can manage report/denial reasons', 'cat' => 'misc'),
	'acl_a_backup'		=> array('lang' => 'Can backup/restore database', 'cat' => 'misc'),
	'acl_a_search'		=> array('lang' => 'Can manage search backends and settings', 'cat' => 'misc'),
));


//---BEGIN CALENDAR MOD---
// Add new category for permissions
$lang['permission_cat']['calendar'] = 'Calendar';

$lang = array_merge($lang, array(
    'acl_u_view_event'    		=> array('lang' => 'Can view events', 'cat' => 'calendar'),
    'acl_u_new_event'     		=> array('lang' => 'Can post a new event', 'cat' => 'calendar'),
    'acl_u_edit_event'    		=> array('lang' => 'Can edit own events', 'cat' => 'calendar'),
    'acl_u_delete_event'  		=> array('lang' => 'Can delete own events', 'cat' => 'calendar'),
	'acl_u_allow_index_minical'	=> array('lang' => 'Can view the minical on the index page', 'cat' => 'calendar'),
 	'acl_m_edit_event'    		=> array('lang' => 'Can edit other\'s events', 'cat' => 'calendar'),
    'acl_m_delete_event'  		=> array('lang' => 'Can delete other\'s events', 'cat' => 'calendar'),
    'acl_a_calendar_manage'		=> array('lang' => 'Can manage calendar', 'cat' => 'calendar'),
    'acl_a_edit_event'    		=> array('lang' => 'Can edit other\'s events', 'cat' => 'calendar'),
    'acl_a_delete_event'  		=> array('lang' => 'Can delete other\'s events', 'cat' => 'calendar'),
	'acl_a_publish_rss'   		=> array('lang' => 'Can publish calendar RSS feeds', 'cat' => 'calendar'),
));
//---END CALENDAR MOD---

//---BEGIN KNOWLEDGE BASE MOD---
// Adding the permissions
$lang['permission_cat']['kb'] = 'Knowledge Base';
$lang['permission_cat']['read'] = 'read';
$lang['permission_cat']['write'] = 'write';
$lang['permission_type']['kb_'] = 'Knowledge Base';
$lang = array_merge($lang, array(
	'acl_kb_print_article'		=> array('lang' => 'Can print articles', 'cat' => 'read'),
	'acl_kb_view_article'		=> array('lang' => 'Can view articles in this category', 'cat' => 'read'),
	'acl_kb_download'			=> array('lang' => 'Can download attachements', 'cat' => 'read'),
	'acl_kb_report_article'		=> array('lang' => 'Can report article', 'cat' => 'read'),
	'acl_kb_rate_article'		=> array('lang' => 'Can rate article', 'cat' => 'read'),
	'acl_u_rate_kb'				=> array('lang' => 'Can rate article', 'cat' => 'read'),
	'acl_kb_attache_article'	=> array('lang' => 'Can upload attachements', 'cat' => 'write'),
	'acl_kb_edit_article'		=> array('lang' => 'Can edit own articles', 'cat' => 'write'),
	'acl_kb_del_article'		=> array('lang' => 'Can delete own articles', 'cat' => 'write'),
	'acl_kb_add_article'		=> array('lang' => 'Can add articles', 'cat' => 'write'),
	'acl_kb_add_article_direct'	=> array('lang' => 'Can add articles without activation', 'cat' => 'write'),
	'acl_kb_edit_all_article'	=> array('lang' => 'Can edit all articles', 'cat' => 'write'),
	'acl_m_delete_diff_kb'		=> array('lang' => 'Can delete old versions of an article', 'cat' => 'kb'),
	'acl_m_restore_kb'			=> array('lang' => 'Can restore old versions of an article', 'cat' => 'kb'),
	'acl_m_log_kb'				=> array('lang' => 'Can view article log', 'cat' => 'kb'),
	'acl_m_log_kb_delete'		=> array('lang' => 'Can delete article log', 'cat' => 'kb'),
	'acl_m_report_kb'			=> array('lang' => 'Can manage reported articles', 'cat' => 'kb'),
	'acl_m_activate_kb'			=> array('lang' => 'Can activate article', 'cat' => 'kb'),
	'acl_m_edit_kb'				=> array('lang' => 'Can edit article', 'cat' => 'kb'),
	'acl_m_del_kb'				=> array('lang' => 'Can delete article', 'cat' => 'kb'),
	'acl_m_ch_poster'			=> array('lang' => 'Can change the author of an article', 'cat' => 'kb'),
	'acl_a_permissions_kb'		=> array('lang' => 'Can edit category permissions', 'cat' => 'kb'),
	'acl_a_config_kb'			=> array('lang' => 'Can edit configuration', 'cat' => 'kb'),
	'acl_a_categorie_kb'		=> array('lang' => 'Can edit categories', 'cat' => 'kb'),
	'acl_a_types_kb'			=> array('lang' => 'Can edit types', 'cat' => 'kb'),
//---END KNOWLEDGE BASE MOD---

// Meeting MOD Permissions
	'acl_a_meeting_config'	=> array('lang' => 'Can manage the meeting configuration', 'cat' => 'meeting'),
	'acl_a_meeting_add'		=> array('lang' => 'Can add new meetings', 'cat' => 'meeting'),
	'acl_a_meeting_manage'	=> array('lang' => 'Can manage existing meetings', 'cat' => 'meeting'),
	'acl_u_meeting'			=> array('lang' => 'Can edit meetings', 'cat' => 'meeting'),

// ajaxlike
	'acl_u_ajaxlike_mod'	=>	array('lang' => 'Can like posts', 'cat' => 'misc'),
	'acl_f_ajaxlike_mod'	=>	array('lang' => 'Can like posts in forum', 'cat' => 'misc'),
	'acl_a_ajaxlike_mod'	=>	array('lang' => 'Can manage likes', 'cat' => 'misc'),
));