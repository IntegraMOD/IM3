<?php
/**
* acp_permissions_phpbb (phpBB Permission Set) [Dutch]
*
* @package language
* @copyright (c) 2005 phpBB Group
* @copyright (c) 2007 phpBB.nl
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
		'actions'		=> 'Acties',
		'content'		=> 'Inhoud',
		'forums'		=> 'Forums',
		'misc'			=> 'Andere',
		'permissions'	=> 'Permissies',
		'pm'			=> 'Privéberichten',
		'polls'			=> 'Polls',
		'post'			=> 'Bericht',
		'post_actions'	=> 'Berichtacties',
		'posting'		=> 'Plaatsen',
		'profile'		=> 'Profiel',
		'settings'		=> 'Instellingen',
		'topic_actions'	=> 'Onderwerpacties',
		'user_group'	=> 'Gebruikers &amp; Groepen',
	),

	// With defining 'global' here we are able to specify what is printed out if the permission is within the global scope.
	'permission_type'	=> array(
		'u_'			=> 'Gebruikerspermissies',
		'a_'			=> 'Beheerderspermissies',
		'm_'			=> 'Moderatorpermissies',
		'f_'			=> 'Forumpermissies',
		'global'		=> array(
			'm_'			=> 'Globale moderatorpermissies',
		),
	),
));

// User Permissions
$lang = array_merge($lang, array(
	'acl_u_viewprofile'	=> array('lang' => 'Kan profielen bekijken, ledenlijst en `wie is er online´ lijst', 'cat' => 'profile'),
	'acl_u_chgname'		=> array('lang' => 'Kan gebruikersnaam wijzigen', 'cat' => 'profile'),
	'acl_u_chgpasswd'	=> array('lang' => 'Kan wachtwoord wijzigen', 'cat' => 'profile'),
	'acl_u_chgemail'	=> array('lang' => 'Kan e-mailadres wijzigen', 'cat' => 'profile'),
	'acl_u_chgavatar'	=> array('lang' => 'Kan avatar wijzigen', 'cat' => 'profile'),
	'acl_u_chggrp'		=> array('lang' => 'Kan standaard gebruikersgroep wijzigen', 'cat' => 'profile'),

	'acl_u_attach'		=> array('lang' => 'Kan bijlagen toevoegen', 'cat' => 'post'),
	'acl_u_download'	=> array('lang' => 'Kan bestanden downloaden', 'cat' => 'post'),
	'acl_u_savedrafts'	=> array('lang' => 'Kan concepten opslaan', 'cat' => 'post'),
	'acl_u_chgcensors'	=> array('lang' => 'Kan censuur uitschakelen', 'cat' => 'post'),
	'acl_u_sig'			=> array('lang' => 'Kan onderschrift gebruiken', 'cat' => 'post'),

	'acl_u_sendpm'		=> array('lang' => 'Kan privéberichten sturen', 'cat' => 'pm'),
	'acl_u_masspm'		=> array('lang' => 'Kan privéberichten naar meerdere gebruikers sturen', 'cat' => 'pm'),
	'acl_u_masspm_group'=> array('lang' => 'Kan privéberichten naar meerdere groepen sturen', 'cat' => 'pm'),
	'acl_u_readpm'		=> array('lang' => 'Kan privéberichten lezen', 'cat' => 'pm'),
	'acl_u_pm_edit'		=> array('lang' => 'Kan eigen privéberichten wijzigen', 'cat' => 'pm'),
	'acl_u_pm_delete'	=> array('lang' => 'Kan privéberichten uit eigen map verwijderen', 'cat' => 'pm'),
	'acl_u_pm_forward'	=> array('lang' => 'Kan privéberichten doorsturen', 'cat' => 'pm'),
	'acl_u_pm_emailpm'	=> array('lang' => 'Kan privéberichten e-mailen', 'cat' => 'pm'),
	'acl_u_pm_printpm'	=> array('lang' => 'Kan privéberichten afdrukken', 'cat' => 'pm'),
	'acl_u_pm_attach'	=> array('lang' => 'Kan bijlagen aan privéberichten toevoegen', 'cat' => 'pm'),
	'acl_u_pm_download'	=> array('lang' => 'Kan bestanden uit privéberichten downloaden', 'cat' => 'pm'),
	'acl_u_pm_bbcode'	=> array('lang' => 'Kan BBCode in privéberichten gebruiken', 'cat' => 'pm'),
	'acl_u_pm_smilies'	=> array('lang' => 'Kan smilies in privéberichten gebruiken', 'cat' => 'pm'),
	'acl_u_pm_img'		=> array('lang' => 'Kan [img] BBCode in privéberichten gebruiken', 'cat' => 'pm'),
	'acl_u_pm_flash'	=> array('lang' => 'Kan [flash] BBCode in privéberichten gebruiken', 'cat' => 'pm'),

	'acl_u_sendemail'	=> array('lang' => 'Kan e-mails versturen', 'cat' => 'misc'),
	'acl_u_sendim'		=> array('lang' => 'Kan IM berichten versturen', 'cat' => 'misc'),
	'acl_u_ignoreflood'	=> array('lang' => 'Kan minimale tijdsinterval overschrijden', 'cat' => 'misc'),
	'acl_u_hideonline'	=> array('lang' => 'Kan online status verbergen', 'cat' => 'misc'),
	'acl_u_viewonline'	=> array('lang' => 'Kan onzichtbare online gebruikers zien', 'cat' => 'misc'),
	'acl_u_search'		=> array('lang' => 'Kan het forum doorzoeken', 'cat' => 'misc'),
));

// Forum Permissions
$lang = array_merge($lang, array(
	'acl_f_list'		=> array('lang' => 'Kan forum zien', 'cat' => 'post'),
	'acl_f_read'		=> array('lang' => 'Kan forum lezen', 'cat' => 'post'),
	'acl_f_post'		=> array('lang' => 'Kan nieuwe onderwerpen openen', 'cat' => 'post'),
	'acl_f_reply'		=> array('lang' => 'Kan reageren op onderwerpen', 'cat' => 'post'),
	'acl_f_icons'		=> array('lang' => 'Kan bericht/onderwerp iconen gebruiken', 'cat' => 'post'),
	'acl_f_announce'	=> array('lang' => 'Kan mededelingen plaatsen', 'cat' => 'post'),
	'acl_f_sticky'		=> array('lang' => 'Kan sticky berichten plaatsen', 'cat' => 'post'),

	'acl_f_poll'		=> array('lang' => 'Kan polls starten', 'cat' => 'polls'),
	'acl_f_vote'		=> array('lang' => 'Kan stemmen op polls', 'cat' => 'polls'),
	'acl_f_votechg'		=> array('lang' => 'Kan zijn huidige stem wijzigen', 'cat' => 'polls'),

	'acl_f_attach'		=> array('lang' => 'Kan bestanden toevoegen', 'cat' => 'content'),
	'acl_f_download'	=> array('lang' => 'Kan bestanden downloaden', 'cat' => 'content'),
	'acl_f_sigs'		=> array('lang' => 'Kan onderschrift gebruiken', 'cat' => 'content'),
	'acl_f_bbcode'		=> array('lang' => 'Kan BBCode gebruiken', 'cat' => 'content'),
	'acl_f_smilies'		=> array('lang' => 'Kan smilies gebruiken', 'cat' => 'content'),
	'acl_f_img'			=> array('lang' => 'Kan [img] BBCode gebruiken', 'cat' => 'content'),
	'acl_f_flash'		=> array('lang' => 'Kan [flash] BBCode gebruiken', 'cat' => 'content'),

	'acl_f_edit'		=> array('lang' => 'Kan eigen berichten wijzigen', 'cat' => 'actions'),
	'acl_f_delete'		=> array('lang' => 'Kan eigen berichten verwijderen', 'cat' => 'actions'),
	'acl_f_user_lock'	=> array('lang' => 'Kan eigen onderwerpen sluiten', 'cat' => 'actions'),
	'acl_f_bump'		=> array('lang' => 'Kan onderwerpen bumpen', 'cat' => 'actions'),
	'acl_f_report'		=> array('lang' => 'Kan berichten melden', 'cat' => 'actions'),
	'acl_f_subscribe'	=> array('lang' => 'Kan abonneren op forums', 'cat' => 'actions'),
	'acl_f_print'		=> array('lang' => 'Kan onderwerpen afdrukken', 'cat' => 'actions'),
	'acl_f_email'		=> array('lang' => 'Kan onderwerpen e-mailen', 'cat' => 'actions'),

	'acl_f_search'		=> array('lang' => 'Kan forums doorzoeken', 'cat' => 'misc'),
	'acl_f_ignoreflood'	=> array('lang' => 'Kan minimale tijdsinterval overschrijden', 'cat' => 'misc'),
	'acl_f_postcount'	=> array('lang' => 'Verhoog berichtenteller<br /><em>Houd er rekening mee dat deze instelling alleen effect heeft op nieuwe berichten.</em>', 'cat' => 'misc'),
	'acl_f_noapprove'	=> array('lang' => 'Kan berichten plaatsen zonder goedkeuring', 'cat' => 'misc'),
));

// Moderator Permissions
$lang = array_merge($lang, array(
	'acl_m_edit'		=> array('lang' => 'Kan berichten wijzigen', 'cat' => 'post_actions'),
	'acl_m_delete'		=> array('lang' => 'Kan berichten verwijderen', 'cat' => 'post_actions'),
	'acl_m_approve'		=> array('lang' => 'Kan berichten goedkeuren', 'cat' => 'post_actions'),
	'acl_m_report'		=> array('lang' => 'Kan meldingen sluiten en verwijderen', 'cat' => 'post_actions'),
	'acl_m_chgposter'	=> array('lang' => 'Kan auteur van bericht wijzigen', 'cat' => 'post_actions'),

	'acl_m_move'	=> array('lang' => 'Kan onderwerpen verplaatsen', 'cat' => 'topic_actions'),
	'acl_m_lock'	=> array('lang' => 'Kan onderwerpen sluiten', 'cat' => 'topic_actions'),
	'acl_m_split'	=> array('lang' => 'Kan onderwerpen splitsen', 'cat' => 'topic_actions'),
	'acl_m_merge'	=> array('lang' => 'Kan onderwerpen samenvoegen', 'cat' => 'topic_actions'),

	'acl_m_info'	=> array('lang' => 'Kan berichtdetail bekijken', 'cat' => 'misc'),
	'acl_m_warn'	=> array('lang' => 'Kan waarschuwingen versturen<br /><em>Deze optie is alleen globaal in te stellen, dus niet per forum.</em>', 'cat' => 'misc'), // This moderator setting is only global (and not local)
	'acl_m_ban'		=> array('lang' => 'Kan bans beheren<br /><em>Deze optie is alleen globaal in te stellen, dus niet per forum.</em>', 'cat' => 'misc'), // This moderator setting is only global (and not local)
));

// Admin Permissions
$lang = array_merge($lang, array(
	'acl_a_board'		=> array('lang' => 'Kan foruminstellingen wijzigen en controleren voor updates', 'cat' => 'settings'),
	'acl_a_server'		=> array('lang' => 'Kan server- en communicatie-instellingen wijzigen', 'cat' => 'settings'),
	'acl_a_jabber'		=> array('lang' => 'Kan Jabber-instellingen wijzigen', 'cat' => 'settings'),
	'acl_a_phpinfo'		=> array('lang' => 'Kan PHP-instellingen bekijken', 'cat' => 'settings'),

	'acl_a_forum'		=> array('lang' => 'Kan forums beheren', 'cat' => 'forums'),
	'acl_a_forumadd'	=> array('lang' => 'Kan nieuwe forums toevoegen', 'cat' => 'forums'),
	'acl_a_forumdel'	=> array('lang' => 'Kan forums verwijderen', 'cat' => 'forums'),
	'acl_a_prune'		=> array('lang' => 'Kan forums opruimen', 'cat' => 'forums'),

	'acl_a_icons'		=> array('lang' => 'Kan bericht/onderwerp iconen en smilies wijzigen', 'cat' => 'posting'),
	'acl_a_words'		=> array('lang' => 'Kan censuur wijzigen', 'cat' => 'posting'),
	'acl_a_bbcode'		=> array('lang' => 'Kan BBCode tags definiëren', 'cat' => 'posting'),
	'acl_a_attach'		=> array('lang' => 'Kan bijlage gerelateerde instellingen wijzigen', 'cat' => 'posting'),

	'acl_a_user'		=> array('lang' => 'Kan gebruikers beheren<br /><em>Dit voegt ook de mogelijkheid toe om de gebruikers browser-agent te zien in de `wie is er online´ lijst.</em>', 'cat' => 'user_group'),
	'acl_a_userdel'		=> array('lang' => 'Kan gebruikers verwijderen/opruimen', 'cat' => 'user_group'),
	'acl_a_group'		=> array('lang' => 'Kan groepen beheren', 'cat' => 'user_group'),
	'acl_a_groupadd'	=> array('lang' => 'Kan nieuwe groepen toevoegen', 'cat' => 'user_group'),
	'acl_a_groupdel'	=> array('lang' => 'Kan groepen verwijderen', 'cat' => 'user_group'),
	'acl_a_ranks'		=> array('lang' => 'Kan rangen beheren', 'cat' => 'user_group'),
	'acl_a_profile'		=> array('lang' => 'Kan aangepaste profielvelden beheren', 'cat' => 'user_group'),
	'acl_a_names'		=> array('lang' => 'Kan geweigerde gebruikersnamen beheren', 'cat' => 'user_group'),
	'acl_a_ban'			=> array('lang' => 'Kan bans beheren', 'cat' => 'user_group'),

	'acl_a_viewauth'	=> array('lang' => 'Kan permissierollen bekijken', 'cat' => 'permissions'),
	'acl_a_authgroups'	=> array('lang' => 'Kan de permissies van individuele groepen wijzigen', 'cat' => 'permissions'),
	'acl_a_authusers'	=> array('lang' => 'Kan de permissies van individuele gebruikers wijzigen', 'cat' => 'permissions'),
	'acl_a_fauth'		=> array('lang' => 'Kan de klasse van forumpermissies wijzigen', 'cat' => 'permissions'),
	'acl_a_mauth'		=> array('lang' => 'Kan de klasse van moderator permissies wijzigen', 'cat' => 'permissions'),
	'acl_a_aauth'		=> array('lang' => 'Kan de klasse van beheerder permissies wijzigen', 'cat' => 'permissions'),
	'acl_a_uauth'		=> array('lang' => 'Kan de klasse van gebruikerspermissies wijzigen', 'cat' => 'permissions'),
	'acl_a_roles'		=> array('lang' => 'Kan rollen beheren', 'cat' => 'permissions'),
	'acl_a_switchperm'	=> array('lang' => 'Kan permissies van anderen gebruiken', 'cat' => 'permissions'),

	'acl_a_styles'		=> array('lang' => 'Kan stijlen beheren', 'cat' => 'misc'),
	'acl_a_viewlogs'	=> array('lang' => 'Kan logs bekijken', 'cat' => 'misc'),
	'acl_a_clearlogs'	=> array('lang' => 'Kan logs legen', 'cat' => 'misc'),
	'acl_a_modules'		=> array('lang' => 'Kan modules beheren', 'cat' => 'misc'),
	'acl_a_language'	=> array('lang' => 'Kan taalpakketten beheren', 'cat' => 'misc'),
	'acl_a_email'		=> array('lang' => 'Kan massa e-mails sturen', 'cat' => 'misc'),
	'acl_a_bots'		=> array('lang' => 'Kan bots beheren', 'cat' => 'misc'),
	'acl_a_reasons'		=> array('lang' => 'Kan meldings- en afkeurredenen beheren', 'cat' => 'misc'),
	'acl_a_backup'		=> array('lang' => 'Kan de database back-uppen en/of terugzetten', 'cat' => 'misc'),
	'acl_a_search'		=> array('lang' => 'Kan de zoekmethodes en -instellingen beheren', 'cat' => 'misc'),
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
	'acl_a_config_kb'			=> array('lang' => 'Can edit configuration', 'cat' => 'kb'),
	'acl_a_categorie_kb'		=> array('lang' => 'Can edit categories', 'cat' => 'kb'),
	'acl_a_types_kb'			=> array('lang' => 'Can edit types', 'cat' => 'kb'),
	'acl_a_permissions_kb'		=> array('lang' => 'Can edit category permissions', 'cat' => 'kb'),
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