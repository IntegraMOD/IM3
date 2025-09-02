<?php
/**
*
* @package acp
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* @todo add cron intervals to server settings? (database_gc, queue_interval, session_gc, search_gc, cache_gc, warnings_gc)
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/
class acp_board
{
	var $u_action;
	var $new_config = array();

	function main($id, $mode)
	{
		global $db, $user, $auth, $template;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		global $cache;

		$user->add_lang('acp/board');

		$action	= request_var('action', '');
		$submit = (isset($_POST['submit']) || isset($_POST['allow_quick_reply_enable'])) ? true : false;

		$form_key = 'acp_board';
		add_form_key($form_key);

		/**
		*	Validation types are:
		*		string, int, bool,
		*		script_path (absolute path in url - beginning with / and no trailing slash),
		*		rpath (relative), rwpath (realtive, writable), path (relative path, but able to escape the root), wpath (writable)
		*/
		switch ($mode)
		{
			case 'settings':
				$display_vars = array(
					'title'	=> 'ACP_BOARD_SETTINGS',
					'vars'	=> array(
						'legend1'				=> 'ACP_BOARD_SETTINGS',
						'sitename'				=> array('lang' => 'SITE_NAME',				'validate' => 'string',	'type' => 'text:40:255', 'explain' => false),
						'site_copyright_enable'	=> array('lang' => 'SITE_COPYRIGHT_ENABLE',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'site_desc'				=> array('lang' => 'SITE_DESC',				'validate' => 'string',	'type' => 'text:40:255', 'explain' => false),
						'board_disable'			=> array('lang' => 'DISABLE_BOARD',			'validate' => 'bool',	'type' => 'custom', 'method' => 'board_disable', 'explain' => true),
						'board_disable_msg'		=> false,
						'default_lang'			=> array('lang' => 'DEFAULT_LANGUAGE',		'validate' => 'lang',	'type' => 'select', 'function' => 'language_select', 'params' => array('{CONFIG_VALUE}'), 'explain' => false),
						'default_dateformat'	=> array('lang' => 'DEFAULT_DATE_FORMAT',	'validate' => 'string',	'type' => 'custom', 'method' => 'dateformat_select', 'explain' => true),
						'board_timezone'		=> array('lang' => 'SYSTEM_TIMEZONE',		'validate' => 'string',	'type' => 'select', 'function' => 'tz_select', 'params' => array('{CONFIG_VALUE}', 1), 'explain' => true),
						'board_dst'				=> array('lang' => 'SYSTEM_DST',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'default_style'			=> array('lang' => 'DEFAULT_STYLE',			'validate' => 'int',	'type' => 'select', 'function' => 'style_select', 'params' => array('{CONFIG_VALUE}', false), 'explain' => false),
						'override_user_style'	=> array('lang' => 'OVERRIDE_STYLE',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'portal_enabled'		=> array('lang' => 'ENABLE_PORTAL',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),

						'legend2'				=> 'WARNINGS',
						'warnings_expire_days'	=> array('lang' => 'WARNINGS_EXPIRE',		'validate' => 'int',	'type' => 'text:3:4', 'explain' => true, 'append' => ' ' . $user->lang['DAYS']),

						'legend3'					=> 'ACP_SUBMIT_CHANGES',
					)
				);
			break;

			case 'features':
				$display_vars = array(
					'title'	=> 'ACP_BOARD_FEATURES',
					'vars'	=> array(
						'legend1'				=> 'ACP_BOARD_FEATURES',
						'allow_privmsg'			=> array('lang' => 'BOARD_PM',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_topic_notify'	=> array('lang' => 'ALLOW_TOPIC_NOTIFY',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_forum_notify'	=> array('lang' => 'ALLOW_FORUM_NOTIFY',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_namechange'		=> array('lang' => 'ALLOW_NAME_CHANGE',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_attachments'		=> array('lang' => 'ALLOW_ATTACHMENTS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_pm_attach'		=> array('lang' => 'ALLOW_PM_ATTACHMENTS',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_pm_report'		=> array('lang' => 'ALLOW_PM_REPORT',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_bbcode'			=> array('lang' => 'ALLOW_BBCODE',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_smilies'			=> array('lang' => 'ALLOW_SMILIES',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_sig'				=> array('lang' => 'ALLOW_SIG',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_nocensors'		=> array('lang' => 'ALLOW_NO_CENSORS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_bookmarks'		=> array('lang' => 'ALLOW_BOOKMARKS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_birthdays'		=> array('lang' => 'ALLOW_BIRTHDAYS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
// User details mod
						'legend33'				=> 'ACP_USER_DETAILS',
						'user_details_max_cols'	=> array('lang' => 'MAX_ATTRIBUTE_COLS',	'validate' => 'int',	'type' => 'text:3:4', 'explain' => true),
						'user_details_save'		=> array('lang' => 'SAVE_OPTS',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'notes'					=> array('lang' => 'ACP_NOTES_SETTINGS',	'validate' => 'int:0',	'type' => 'text:4:10', 'explain' => false),
						'allow_quick_reply'		=> array('lang' => 'ALLOW_QUICK_REPLY',		'validate' => 'bool',	'type' => 'custom', 'method' => 'quick_reply', 'explain' => true),

						'legend2'				=> 'ACP_LOAD_SETTINGS',
						'load_birthdays'		=> array('lang' => 'YES_BIRTHDAYS',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'load_moderators'		=> array('lang' => 'YES_MODERATORS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'load_jumpbox'			=> array('lang' => 'YES_JUMPBOX',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'load_cpf_memberlist'	=> array('lang' => 'LOAD_CPF_MEMBERLIST',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'load_cpf_viewprofile'	=> array('lang' => 'LOAD_CPF_VIEWPROFILE',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'load_cpf_viewtopic'	=> array('lang' => 'LOAD_CPF_VIEWTOPIC',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),

						'legend3'				=> 'MOD_LINKS',
						'show_activity'			=> array('lang' => 'SHOW_ACTIVITY',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'show_blog'				=> array('lang' => 'SHOW_BLOG',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'show_kb'				=> array('lang' => 'SHOW_KB',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'show_cal'				=> array('lang' => 'SHOW_CAL',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'show_gall'				=> array('lang' => 'SHOW_GALL',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'show_cht'				=> array('lang' => 'SHOW_CHT',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'show_dls'				=> array('lang' => 'SHOW_DLS',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'show_faq'				=> array('lang' => 'SHOW_FAQ',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'show_mem'				=> array('lang' => 'SHOW_MEM',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'show_notes'			=> array('lang' => 'SHOW_NOTES',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'show_meeting'			=> array('lang' => 'SHOW_MEETING',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'show_contact'			=> array('lang' => 'SHOW_CONTACT',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),

						'legend4'					=> 'ACP_SUBMIT_CHANGES',
					)
				);
			break;

			case 'avatar':
				$display_vars = array(
					'title'	=> 'ACP_AVATAR_SETTINGS',
					'vars'	=> array(
						'legend1'				=> 'ACP_AVATAR_SETTINGS',

						'avatar_min_width'		=> array('lang' => 'MIN_AVATAR_SIZE', 'validate' => 'int:0', 'type' => false, 'method' => false, 'explain' => false,),
						'avatar_min_height'		=> array('lang' => 'MIN_AVATAR_SIZE', 'validate' => 'int:0', 'type' => false, 'method' => false, 'explain' => false,),
						'avatar_max_width'		=> array('lang' => 'MAX_AVATAR_SIZE', 'validate' => 'int:0', 'type' => false, 'method' => false, 'explain' => false,),
						'avatar_max_height'		=> array('lang' => 'MAX_AVATAR_SIZE', 'validate' => 'int:0', 'type' => false, 'method' => false, 'explain' => false,),

						'allow_avatar'			=> array('lang' => 'ALLOW_AVATARS',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_avatar_local'	=> array('lang' => 'ALLOW_LOCAL',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_avatar_remote'	=> array('lang' => 'ALLOW_REMOTE',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_avatar_upload'	=> array('lang' => 'ALLOW_UPLOAD',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_avatar_remote_upload'=> array('lang' => 'ALLOW_REMOTE_UPLOAD', 'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'avatar_filesize'		=> array('lang' => 'MAX_FILESIZE',			'validate' => 'int:0',	'type' => 'text:4:10', 'explain' => true, 'append' => ' ' . $user->lang['BYTES']),
						'avatar_min'			=> array('lang' => 'MIN_AVATAR_SIZE',		'validate' => 'int:0',	'type' => 'dimension:3:4', 'explain' => true, 'append' => ' ' . $user->lang['PIXEL']),
						'avatar_max'			=> array('lang' => 'MAX_AVATAR_SIZE',		'validate' => 'int:0',	'type' => 'dimension:3:4', 'explain' => true, 'append' => ' ' . $user->lang['PIXEL']),
						'avatar_path'			=> array('lang' => 'AVATAR_STORAGE_PATH',	'validate' => 'rpath',	'type' => 'text:20:255', 'explain' => true),
						'avatar_gallery_path'	=> array('lang' => 'AVATAR_GALLERY_PATH',	'validate' => 'rpath',	'type' => 'text:20:255', 'explain' => true)
					)
				);
			break;

			case 'message':
				$display_vars = array(
					'title'	=> 'ACP_MESSAGE_SETTINGS',
					'lang'	=> 'ucp',
					'vars'	=> array(
						'legend1'				=> 'GENERAL_SETTINGS',
						'allow_privmsg'			=> array('lang' => 'BOARD_PM',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'pm_max_boxes'			=> array('lang' => 'BOXES_MAX',				'validate' => 'int:0',	'type' => 'text:4:4', 'explain' => true),
						'pm_max_msgs'			=> array('lang' => 'BOXES_LIMIT',			'validate' => 'int:0',	'type' => 'text:4:4', 'explain' => true),
						'full_folder_action'	=> array('lang' => 'FULL_FOLDER_ACTION',	'validate' => 'int',	'type' => 'select', 'method' => 'full_folder_select', 'explain' => true),
						'pm_edit_time'			=> array('lang' => 'PM_EDIT_TIME',			'validate' => 'int:0',	'type' => 'text:5:5', 'explain' => true, 'append' => ' ' . $user->lang['MINUTES']),
						'pm_max_recipients'		=> array('lang' => 'PM_MAX_RECIPIENTS',		'validate' => 'int:0',	'type' => 'text:5:5', 'explain' => true),

						'legend2'				=> 'GENERAL_OPTIONS',
						'allow_mass_pm'			=> array('lang' => 'ALLOW_MASS_PM',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'auth_bbcode_pm'		=> array('lang' => 'ALLOW_BBCODE_PM',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'auth_smilies_pm'		=> array('lang' => 'ALLOW_SMILIES_PM',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_pm_attach'		=> array('lang' => 'ALLOW_PM_ATTACHMENTS',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_sig_pm'			=> array('lang' => 'ALLOW_SIG_PM',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'print_pm'				=> array('lang' => 'ALLOW_PRINT_PM',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'forward_pm'			=> array('lang' => 'ALLOW_FORWARD_PM',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'auth_img_pm'			=> array('lang' => 'ALLOW_IMG_PM',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'auth_flash_pm'			=> array('lang' => 'ALLOW_FLASH_PM',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'enable_pm_icons'		=> array('lang' => 'ENABLE_PM_ICONS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),

						'legend3'					=> 'ACP_SUBMIT_CHANGES',
					)
				);
			break;

			case 'post':
				$display_vars = array(
					'title'	=> 'ACP_POST_SETTINGS',
					'vars'	=> array(
						'legend1'				=> 'GENERAL_OPTIONS',
						'allow_topic_notify'	=> array('lang' => 'ALLOW_TOPIC_NOTIFY',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_forum_notify'	=> array('lang' => 'ALLOW_FORUM_NOTIFY',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_bbcode'			=> array('lang' => 'ALLOW_BBCODE',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_post_flash'		=> array('lang' => 'ALLOW_POST_FLASH',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_smilies'			=> array('lang' => 'ALLOW_SMILIES',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_post_links'		=> array('lang' => 'ALLOW_POST_LINKS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_nocensors'		=> array('lang' => 'ALLOW_NO_CENSORS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_bookmarks'		=> array('lang' => 'ALLOW_BOOKMARKS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'enable_post_confirm'	=> array('lang' => 'VISUAL_CONFIRM_POST',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_quick_reply'		=> array('lang' => 'ALLOW_QUICK_REPLY',		'validate' => 'bool',	'type' => 'custom', 'method' => 'quick_reply', 'explain' => true),

						'legend2'				=> 'POSTING',
						'bump_type'				=> false,
						'edit_time'				=> array('lang' => 'EDIT_TIME',				'validate' => 'int:0',		'type' => 'text:5:5', 'explain' => true, 'append' => ' ' . $user->lang['MINUTES']),
						'delete_time'			=> array('lang' => 'DELETE_TIME',			'validate' => 'int:0',		'type' => 'text:5:5', 'explain' => true, 'append' => ' ' . $user->lang['MINUTES']),
						'display_last_edited'	=> array('lang' => 'DISPLAY_LAST_EDITED',	'validate' => 'bool',		'type' => 'radio:yes_no', 'explain' => true),
						'flood_interval'		=> array('lang' => 'FLOOD_INTERVAL',		'validate' => 'int:0',		'type' => 'text:3:10', 'explain' => true, 'append' => ' ' . $user->lang['SECONDS']),
						'bump_interval'			=> array('lang' => 'BUMP_INTERVAL',			'validate' => 'int:0',		'type' => 'custom', 'method' => 'bump_interval', 'explain' => true),
						'topics_per_page'		=> array('lang' => 'TOPICS_PER_PAGE',		'validate' => 'int:1',		'type' => 'text:3:4', 'explain' => false),
						'posts_per_page'		=> array('lang' => 'POSTS_PER_PAGE',		'validate' => 'int:1',		'type' => 'text:3:4', 'explain' => false),
						'smilies_per_page'		=> array('lang' => 'SMILIES_PER_PAGE',		'validate' => 'int:1',		'type' => 'text:3:4', 'explain' => false),
						'hot_threshold'			=> array('lang' => 'HOT_THRESHOLD',			'validate' => 'int:0',		'type' => 'text:3:4', 'explain' => true),
						'max_poll_options'		=> array('lang' => 'MAX_POLL_OPTIONS',		'validate' => 'int:2:127',	'type' => 'text:4:4', 'explain' => false),
						'max_post_chars'		=> array('lang' => 'CHAR_LIMIT',			'validate' => 'int:0',		'type' => 'text:4:6', 'explain' => true),
						'min_post_chars'		=> array('lang' => 'MIN_CHAR_LIMIT',		'validate' => 'int:1',		'type' => 'text:4:6', 'explain' => true),
						'max_post_smilies'		=> array('lang' => 'SMILIES_LIMIT',			'validate' => 'int:0',		'type' => 'text:4:4', 'explain' => true),
						'max_post_urls'			=> array('lang' => 'MAX_POST_URLS',			'validate' => 'int:0',		'type' => 'text:5:4', 'explain' => true),
						'max_post_font_size'	=> array('lang' => 'MAX_POST_FONT_SIZE',	'validate' => 'int:0',		'type' => 'text:5:4', 'explain' => true, 'append' => ' %'),
						'max_quote_depth'		=> array('lang' => 'QUOTE_DEPTH_LIMIT',		'validate' => 'int:0',		'type' => 'text:4:4', 'explain' => true),
						'max_post_img_width'	=> array('lang' => 'MAX_POST_IMG_WIDTH',	'validate' => 'int:0',		'type' => 'text:5:4', 'explain' => true, 'append' => ' ' . $user->lang['PIXEL']),
						'max_post_img_height'	=> array('lang' => 'MAX_POST_IMG_HEIGHT',	'validate' => 'int:0',		'type' => 'text:5:4', 'explain' => true, 'append' => ' ' . $user->lang['PIXEL']),

						'legend3'					=> 'ACP_SUBMIT_CHANGES',
					)
				);
			break;

			case 'signature':
				$display_vars = array(
					'title'	=> 'ACP_SIGNATURE_SETTINGS',
					'vars'	=> array(
						'legend1'				=> 'GENERAL_OPTIONS',
						'allow_sig'				=> array('lang' => 'ALLOW_SIG',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_sig_bbcode'		=> array('lang' => 'ALLOW_SIG_BBCODE',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_sig_img'			=> array('lang' => 'ALLOW_SIG_IMG',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_sig_flash'		=> array('lang' => 'ALLOW_SIG_FLASH',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_sig_smilies'		=> array('lang' => 'ALLOW_SIG_SMILIES',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_sig_links'		=> array('lang' => 'ALLOW_SIG_LINKS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),

						'legend2'				=> 'GENERAL_SETTINGS',
						'max_sig_chars'			=> array('lang' => 'MAX_SIG_LENGTH',		'validate' => 'int:0',	'type' => 'text:5:4', 'explain' => true),
						'max_sig_urls'			=> array('lang' => 'MAX_SIG_URLS',			'validate' => 'int:0',	'type' => 'text:5:4', 'explain' => true),
						'max_sig_font_size'		=> array('lang' => 'MAX_SIG_FONT_SIZE',		'validate' => 'int:0',	'type' => 'text:5:4', 'explain' => true, 'append' => ' %'),
						'max_sig_smilies'		=> array('lang' => 'MAX_SIG_SMILIES',		'validate' => 'int:0',	'type' => 'text:5:4', 'explain' => true),
						'max_sig_img_width'		=> array('lang' => 'MAX_SIG_IMG_WIDTH',		'validate' => 'int:0',	'type' => 'text:5:4', 'explain' => true, 'append' => ' ' . $user->lang['PIXEL']),
						'max_sig_img_height'	=> array('lang' => 'MAX_SIG_IMG_HEIGHT',	'validate' => 'int:0',	'type' => 'text:5:4', 'explain' => true, 'append' => ' ' . $user->lang['PIXEL']),

						'legend3'					=> 'ACP_SUBMIT_CHANGES',
					)
				);
			break;

			case 'registration':
				$display_vars = array(
					'title'	=> 'ACP_REGISTER_SETTINGS',
					'vars'	=> array(
						'legend1'				=> 'GENERAL_SETTINGS',
						'max_name_chars'		=> array('lang' => 'USERNAME_LENGTH', 'validate' => 'int:8:180', 'type' => false, 'method' => false, 'explain' => false,),
						'max_pass_chars'		=> array('lang' => 'PASSWORD_LENGTH', 'validate' => 'int:8:255', 'type' => false, 'method' => false, 'explain' => false,),

						'require_activation'	=> array('lang' => 'ACC_ACTIVATION',	'validate' => 'int',	'type' => 'select', 'method' => 'select_acc_activation', 'explain' => true),
						'new_member_post_limit'	=> array('lang' => 'NEW_MEMBER_POST_LIMIT', 'validate' => 'int:0:255', 'type' => 'text:4:4', 'explain' => true, 'append' => ' ' . $user->lang['POSTS']),
						'new_member_group_default'=> array('lang' => 'NEW_MEMBER_GROUP_DEFAULT', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
						'min_name_chars'		=> array('lang' => 'USERNAME_LENGTH',	'validate' => 'int:1',	'type' => 'custom:5:180', 'method' => 'username_length', 'explain' => true),
						'min_pass_chars'		=> array('lang' => 'PASSWORD_LENGTH',	'validate' => 'int:1',	'type' => 'custom', 'method' => 'password_length', 'explain' => true),
						'allow_name_chars'		=> array('lang' => 'USERNAME_CHARS',	'validate' => 'string',	'type' => 'select', 'method' => 'select_username_chars', 'explain' => true),
						'pass_complex'			=> array('lang' => 'PASSWORD_TYPE',		'validate' => 'string',	'type' => 'select', 'method' => 'select_password_chars', 'explain' => true),
						'chg_passforce'			=> array('lang' => 'FORCE_PASS_CHANGE',	'validate' => 'int:0',	'type' => 'text:3:3', 'explain' => true, 'append' => ' ' . $user->lang['DAYS']),

						'legend2'				=> 'GENERAL_OPTIONS',
						'allow_namechange'		=> array('lang' => 'ALLOW_NAME_CHANGE',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_emailreuse'		=> array('lang' => 'ALLOW_EMAIL_REUSE',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'enable_confirm'		=> array('lang' => 'VISUAL_CONFIRM_REG',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'max_login_attempts'	=> array('lang' => 'MAX_LOGIN_ATTEMPTS',	'validate' => 'int:0',	'type' => 'text:3:3', 'explain' => true),
						'max_reg_attempts'		=> array('lang' => 'REG_LIMIT',				'validate' => 'int:0',	'type' => 'text:4:4', 'explain' => true),

						'legend3'			=> 'COPPA',
						'coppa_enable'		=> array('lang' => 'ENABLE_COPPA',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'coppa_mail'		=> array('lang' => 'COPPA_MAIL',		'validate' => 'string',	'type' => 'textarea:5:40', 'explain' => true),
						'coppa_fax'			=> array('lang' => 'COPPA_FAX',			'validate' => 'string',	'type' => 'text:25:100', 'explain' => false),

						'legend4'			=> 'ACP_SUBMIT_CHANGES',
					)
				);
			break;
			// phpBB Digest MOD - Addition begin -----------------------------------------------------------
			case 'digest_general':
				$orig_digests_enabled = $config['digests_enabled'];
				$digest_version_info = digests_version();
		
				$display_vars = array(
					'title'	=> 'ACP_DIGEST_GENERAL_SETTINGS',
					'vars'	=> array(
						'legend1'								=> '',
						'digests_enabled'						=> array('lang' => 'DIGEST_ENABLED',							'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_show_output'					=> array('lang' => 'DIGEST_SHOW_OUTPUT',						'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_show_email'					=> array('lang' => 'DIGEST_SHOW_EMAIL',						    'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_enable_log'					=> array('lang' => 'DIGEST_ENABLE_LOG',							'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_enable_auto_subscriptions'		=> array('lang' => 'DIGEST_ENABLE_AUTO_SUBSCRIPTIONS',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_registration_field'			=> array('lang' => 'DIGEST_REGISTRATION_FIELD',			        'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_block_images'					=> array('lang' => 'DIGEST_BLOCK_IMAGES',						'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_weekly_digest_day'				=> array('lang' => 'DIGEST_WEEKLY_DIGEST_DAY',					'validate' => 'int:0:6',	'type' => 'select', 'method' => 'dow_select', 'explain' => false),
						'digests_max_items'						=> array('lang' => 'DIGEST_MAX_ITEMS',							'validate' => 'int:0',	'type' => 'text:5:5', 'explain' => true),
						'digests_enable_custom_stylesheets'		=> array('lang' => 'DIGEST_ENABLE_CUSTOM_STYLESHEET',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_custom_stylesheet_path'		=> array('lang' => 'DIGEST_CUSTOM_STYLESHEET_PATH',				'validate' => 'string',	'type' => 'text:40:255', 'explain' => true),
						'digests_require_key'					=> array('lang' => 'DIGEST_REQUIRE_KEY',						'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_key_value'						=> array('lang' => 'DIGEST_KEY_VALUE',							'validate' => 'string',	'type' => 'text:40:255', 'explain' => true),
						'digests_override_queue'				=> array('lang' => 'DIGEST_OVERRIDE_QUEUE',						'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_from_email_address'			=> array('lang' => 'DIGEST_FROM_EMAIL_ADDRESS',					'validate' => 'string',	'type' => 'text:40:255', 'explain' => true),
						'digests_from_email_name'				=> array('lang' => 'DIGEST_FROM_EMAIL_NAME',					'validate' => 'string',	'type' => 'text:40:255', 'explain' => true),
						'digests_reply_to_email_address'		=> array('lang' => 'DIGEST_REPLY_TO_EMAIL_ADDRESS',				'validate' => 'string',	'type' => 'text:40:255', 'explain' => true),
						'digests_users_per_page'				=> array('lang' => 'DIGEST_USERS_PER_PAGE',						'validate' => 'int:0',	'type' => 'text:4:4', 'explain' => true),
						'digests_include_forums'				=> array('lang' => 'DIGEST_INCLUDE_FORUMS',						'validate' => 'string',	'type' => 'text:15:255', 'explain' => true),
						'digests_exclude_forums'				=> array('lang' => 'DIGEST_EXCLUDE_FORUMS',						'validate' => 'string',	'type' => 'text:15:255', 'explain' => true),
						'digests_time_zone'						=> array('lang' => 'DIGEST_TIME_ZONE',							'validate' => 'int:-12:12',	'type' => 'text:5:5', 'explain' => true),
					)
				);
			break;
				
			case 'digest_user_defaults':
				$digest_version_info = digests_version();
				$display_vars = array(
					'title'	=> 'ACP_DIGEST_USER_DEFAULT_SETTINGS',
					'vars'	=> array(
						'legend1'								=> '',
						'digests_user_digest_registration'		=> array('lang' => 'DIGEST_USER_DIGEST_REGISTRATION',		    'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_user_digest_type'				=> array('lang' => 'DIGEST_USER_DIGEST_TYPE',					'validate' => 'string',	'type' => 'select', 'method' => 'digest_type_select', 'explain' => false),
						'digests_user_digest_format'			=> array('lang' => 'DIGEST_USER_DIGEST_STYLE',					'validate' => 'string',	'type' => 'select', 'method' => 'digest_style_select', 'explain' => false),
						'digests_user_digest_send_hour_gmt'		=> array('lang' => 'DIGEST_USER_DIGEST_SEND_HOUR_GMT',			'validate' => 'int:-1:23',	'type' => 'select', 'method' => 'digest_send_hour_gmt', 'explain' => false),
						'digests_user_digest_filter_type'		=> array('lang' => 'DIGEST_USER_DIGEST_FILTER_TYPE',			'validate' => 'string',	'type' => 'select', 'method' => 'digest_filter_type', 'explain' => false),
						'digests_user_check_all_forums'			=> array('lang' => 'DIGEST_USER_DIGEST_CHECK_ALL_FORUMS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_user_digest_max_posts'			=> array('lang' => 'DIGEST_USER_DIGEST_MAX_POSTS',				'validate' => 'int:0',	'type' => 'text:5:5', 'explain' => true),
						'digests_user_digest_min_words'			=> array('lang' => 'DIGEST_USER_DIGEST_MIN_POSTS',				'validate' => 'int:0',	'type' => 'text:5:5', 'explain' => true),
						'digests_user_digest_new_posts_only'	=> array('lang' => 'DIGEST_USER_DIGEST_NEW_POSTS_ONLY',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'digests_user_digest_show_mine'			=> array('lang' => 'DIGEST_USER_DIGEST_SHOW_MINE',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'digests_user_digest_remove_foes'		=> array('lang' => 'DIGEST_USER_DIGEST_SHOW_FOES',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'digests_user_digest_show_pms'			=> array('lang' => 'DIGEST_USER_DIGEST_SHOW_PMS',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'digests_user_digest_pm_mark_read'		=> array('lang' => 'DIGEST_USER_DIGEST_PM_MARK_READ',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'digests_user_digest_sortby'			=> array('lang' => 'DIGEST_USER_DIGEST_SORT_ORDER',				'validate' => 'string',	'type' => 'select', 'method' => 'digest_post_sort_order', 'explain' => false),
						'digests_user_digest_max_display_words'	=> array('lang' => 'DIGEST_USER_DIGEST_MAX_DISPLAY_WORDS',		'validate' => 'int:-1',	'type' => 'text:5:5', 'explain' => true),
						'digests_user_digest_send_on_no_posts'	=> array('lang' => 'DIGEST_USER_DIGEST_SEND_ON_NO_POSTS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'digests_user_digest_reset_lastvisit'	=> array('lang' => 'DIGEST_USER_DIGEST_RESET_LASTVISIT',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'digests_user_digest_attachments'		=> array('lang' => 'DIGEST_USER_DIGEST_ATTACHMENTS',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'digests_user_digest_block_images'		=> array('lang' => 'DIGEST_USER_DIGEST_BLOCK_IMAGES',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'digests_user_digest_toc'				=> array('lang' => 'DIGEST_USER_DIGEST_TOC',					'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
					)
				);
			break;
			
			
			
			
			
	        case 'digest_edit_subscribers':
				$digest_version_info = digests_version();
				$display_vars = array(
				    'title' => 'ACP_DIGEST_EDIT_SUBSCRIBERS',
				    'vars'  => array()
				);
	 
				$user->add_lang('mods/ucp_digests');
				$user->add_lang('ucp');
	 
				// Grab some URL parameters
				$member = request_var('member', '');
				$start = request_var('start', 0);
				$subscribe = request_var('subscribe', 'a');
				$sortby = request_var('sortby', 'u');
				$sortorder = request_var('sortorder', 'a');
	 
				// Set up subscription filter               
				$all_selected = $stopped_subscribing = $subscribe_selected = $unsubscribe_selected = '';
				switch ($subscribe)
				{
				    case 'u':
				        $subscribe_sql = "user_digest_type = 'NONE' AND user_digest_has_unsubscribed = 0 AND ";
				        $unsubscribe_selected = ' selected="selected"';
				        $context = $user->lang['DIGEST_UNSUBSCRIBED'];
				    break;
				    case 't':
				        $subscribe_sql = "user_digest_type = 'NONE' AND user_digest_has_unsubscribed = 1 AND";
				        $stopped_subscribing = ' selected="selected"';
				        $context = $user->lang['DIGEST_STOPPED_SUBSCRIBING'];
				    break;
				    case 's':
				        $subscribe_sql = "user_digest_type <> 'NONE' AND user_digest_send_hour_gmt >= 0 AND user_digest_send_hour_gmt < 24 AND user_digest_has_unsubscribed = 0 AND";
				        $subscribe_selected = ' selected="selected"';
				        $context = $user->lang['DIGEST_SUBSCRIBED'];
				    break;
				    case 'a':
				    default:
				        $subscribe_sql = '';
				        $all_selected = ' selected="selected"';
				        $context = $user->lang['DIGEST_ALL'];
				    break;
				}
	 
				// Set up sort by column
				$last_sent_selected = $has_unsubscribed_selected = $username_selected = $frequency_selected = $format_selected = $hour_selected = $lastvisit_selected = $email_selected = '';
				switch ($sortby)
				{
				    case 'f':
				        $sort_by_sql = 'user_digest_type %s, lower(username) %s';
				        $frequency_selected = ' selected="selected"';
				    break;
				    case 'e':
				        $sort_by_sql = 'user_email %s, lower(username) %s';
				        $email_selected = ' selected="selected"';
				    break;
				    case 's':
				        $sort_by_sql = 'user_digest_format %s, lower(username) %s';
				        $format_selected = ' selected="selected"';
				    break;
				    case 'h':
				        $sort_by_sql = 'send_hour_board %s, lower(username) %s';
				        $hour_selected = ' selected="selected"';
				    break;
				    case 'l':
				        $sort_by_sql = 'user_lastvisit %s, lower(username) %s';
				        $lastvisit_selected = ' selected="selected"';
				    break;
				    case 'b':
				        $sort_by_sql = 'user_digest_has_unsubscribed %s, lower(username) %s';
				        $has_unsubscribed_selected = ' selected="selected"';
				    break;
				    case 't':
				        $sort_by_sql = 'user_digest_last_sent %s, lower(username) %s';
				        $last_sent_selected = ' selected="selected"';
				    break;
				    case 'u':
				    default:
				        $sort_by_sql = 'lower(username) %s';
				        $username_selected = ' selected="selected"';
				    break;
				}
	 
				// Set up sort order
				$ascending_selected = $descending_selected = '';
				switch ($sortorder)
				{
				    case 'd':
				        $order_by_sql = 'DESC';
				        $descending_selected = ' selected="selected"';
				    break;
				    case 'a':
				    default:
				        $order_by_sql = 'ASC';
				        $ascending_selected = ' selected="selected"';
				    break;
				}
	 
				// Set up member search SQL 
				$member_sql = ($member != '') ? " username " . $db->sql_like_expression($db->get_any_char() . $member . $db->get_any_char()) . " AND " : '';
	 
				$pagination_url = append_sid($phpbb_root_path . 'adm/index.' . $phpEx) . sprintf('&amp;i=board&amp;mode=digest_edit_subscribers&amp;sortby=%s&amp;sortorder=%s&amp;subscribe=%s&amp;member=%s',$sortby,$sortorder,$subscribe,isset($member) ? $member : '');
	 
				// Get the total rows for pagination purposes
				$sql = 'SELECT count(*) AS total_users 
				    FROM ' . USERS_TABLE . "
				    WHERE $subscribe_sql $member_sql user_type <> " . USER_IGNORE;
				$result = $db->sql_query($sql);
	 
				// Get the total users, this is a single row, single field.
				$total_users = $db->sql_fetchfield('total_users');
	 
				// Free the result
				$db->sql_freeresult($result);
	 
				// Calculate the total pages and current page
				$total_pages_string = generate_pagination($pagination_url, $total_users, $config['digests_users_per_page'], $start);
				$current_page = on_page($total_users, $config['digests_users_per_page'], $start);
	 
				// Stealing some code from my Smartfeed mod so I can get a list of forum that a particular user can access
	 
				// We need to know which auth_option_id corresponds to the forum read privilege (f_read) and forum list (f_list) privilege.
				$auth_options = array('f_read', 'f_list');
				$sql = 'SELECT auth_option, auth_option_id
				        FROM ' . ACL_OPTIONS_TABLE . '
				        WHERE ' . $db->sql_in_set('auth_option', $auth_options);
				$result = $db->sql_query($sql);
				while ($row = $db->sql_fetchrow($result))
				{
				    if ($row['auth_option'] == 'f_read')
				    {
				        $read_id = $row['auth_option_id'];
				    }
				    if ($row['auth_option'] == 'f_list')
				    {
				        $list_id = $row['auth_option_id'];
				    }
				}
				$db->sql_freeresult($result); // Query be gone!
	 
				// Fill in some non-block template variables
				$template->assign_vars(array(
				    'ALL_SELECTED'              => $all_selected,
				    'ASCENDING_SELECTED'        => $ascending_selected,
				    'DESCENDING_SELECTED'       => $descending_selected,
				    'EMAIL_SELECTED'            => $email_selected,
				    'FORMAT_SELECTED'           => $format_selected,
				    'FREQUENCY_SELECTED'        => $frequency_selected,
				    'HAS_UNSUBSCRIBED_SELECTED' => $has_unsubscribed_selected,
				    'HOUR_SELECTED'             => $hour_selected,
				    'IMAGE_PATH'                => $phpbb_root_path . 'adm/images/',
				    'LAST_SENT_SELECTED'        => $last_sent_selected,
				    'LASTVISIT_SELECTED'        => $lastvisit_selected,
				    'L_CONTEXT'                 => $context,
				    'L_DIGEST_HOUR_SENT'        => sprintf($user->lang['DIGEST_HOUR_SENT'], $config['digests_time_zone']),
				    'L_DIGEST_HTML_VALUE'           => DIGEST_HTML_VALUE,
				    'L_DIGEST_HTML_CLASSIC_VALUE'   => DIGEST_HTML_CLASSIC_VALUE,
				    'L_DIGEST_PLAIN_VALUE'          => DIGEST_PLAIN_VALUE,
				    'L_DIGEST_PLAIN_CLASSIC_VALUE'  => DIGEST_PLAIN_CLASSIC_VALUE,  
				    'L_DIGEST_FORMAT_TEXT_VALUE'    => DIGEST_TEXT_VALUE,
				    'MEMBER'                    => $member,
				    'PAGE_NUMBER'               => $current_page,
				    'PAGINATION'                => $total_pages_string,
				    'STOPPED_SUBSCRIBING_SELECTED'  => $stopped_subscribing,
				    'SUBSCRIBE_SELECTED'        => $subscribe_selected,
				    'TOTAL_USERS'               => ($total_users == 1) ? $user->lang['DIGEST_LIST_USER'] : sprintf($user->lang['DIGEST_LIST_USERS'], $total_users),
				    'UNSUBSCRIBE_SELECTED'      => $unsubscribe_selected,
				    'USERNAME_SELECTED'         => $username_selected,
				));
	
	            $sql = 'SELECT *, CASE
				    WHEN user_digest_send_hour_gmt + ' . ($config['digests_time_zone']) . ' >= 24 THEN
				         user_digest_send_hour_gmt + ' . ($config['digests_time_zone']) . ' - 24  
				    WHEN user_digest_send_hour_gmt + ' . ($config['digests_time_zone']) . ' < 0 THEN
				         user_digest_send_hour_gmt + ' . ($config['digests_time_zone']) . ' + 24 
				    ELSE user_digest_send_hour_gmt + ' . ($config['digests_time_zone']) . '
				    END AS send_hour_board
				    FROM ' . USERS_TABLE . "
				    WHERE $subscribe_sql $member_sql user_type <> " . USER_IGNORE . "
				    ORDER BY " . sprintf($sort_by_sql, $order_by_sql, $order_by_sql);
				$result = $db->sql_query_limit($sql, $config['digests_users_per_page'], $start);
	 
				while ($row = $db->sql_fetchrow($result))
				{
	 
				    // Make some translations into something more readable
				    switch($row['user_digest_type'])
				    {
				        case 'DAY':
				            $digest_type = $user->lang['DIGEST_DAILY'];
				        break;
				        case 'WEEK':
				            $digest_type = $user->lang['DIGEST_WEEKLY'];
				        break;
				        case 'MNTH':
				            $digest_type = $user->lang['DIGEST_MONTHLY'];
				        break;
				        default:
				            $digest_type = $user->lang['DIGEST_UNKNOWN'];
				        break;
				    }
	 
				    switch($row['user_digest_format'])
				    {
				        case DIGEST_HTML_VALUE:
				            $digest_format = $user->lang['DIGEST_FORMAT_HTML'];
				        break;
				        case DIGEST_HTML_CLASSIC_VALUE:
				            $digest_format = $user->lang['DIGEST_FORMAT_HTML_CLASSIC'];
				        break;
				        case DIGEST_PLAIN_VALUE:
				            $digest_format = $user->lang['DIGEST_FORMAT_PLAIN'];
				        break;
				        case DIGEST_PLAIN_CLASSIC_VALUE:
				            $digest_format = $user->lang['DIGEST_FORMAT_PLAIN_CLASSIC'];
				        break;
				        case DIGEST_TEXT_VALUE:
				            $digest_format = $user->lang['DIGEST_FORMAT_TEXT'];
				        break;
				        default:
				            $digest_format = $user->lang['DIGEST_UNKNOWN'];
				        break;
				    }
	 
				    // Calculate a digest send hour in board time
				    $send_hour_board = str_replace('.', ':', (string)floor((float)$row['user_digest_send_hour_gmt']) + $config['digests_time_zone']);
				    if ($send_hour_board >= 24)
				    {
				        $send_hour_board = $send_hour_board - 24;
				    }
				    else if ($send_hour_board < 0)
				    {
				        $send_hour_board = $send_hour_board + 24;
				    }
	 
				    // Create an array of GMT offsets from board time zone
				    $gmt_offset = $config['digests_time_zone'];
				    $board_to_gmt = array();
				    for($i=0;$i<24;$i++)
				    {
				        if (($i - $gmt_offset) < 0)
				        {
				            $board_to_gmt[$i] = $i - $gmt_offset + 24;
				        }
				        else if (($i - $gmt_offset) > 23)
				        {
				            $board_to_gmt[$i] = $i - $gmt_offset - 24;
				        }
				        else
				        {
				            $board_to_gmt[$i] = $i - $gmt_offset;
				        }
				    }
	 
				    // Get current subscribed forums for this user, if any. If none, all allowed forums are assumed
				    $sql2 = 'SELECT forum_id 
				            FROM ' . DIGESTS_SUBSCRIBED_FORUMS_TABLE . ' 
				            WHERE user_id = ' . (int) $row['user_id'];
				    $result2 = $db->sql_query($sql2);
				    $subscribed_forums = $db->sql_fetchrowset($result2);
				    $db->sql_freeresult($result2);
	 
				    $all_by_default = (count($subscribed_forums) == 0) ? true : false;
						
	                $template->assign_block_vars('digest_edit_subscribers', array(
				        '1ST'                               => ($row['user_digest_filter_type'] == DIGEST_FIRST),
				        'ALL'                               => ($row['user_digest_filter_type'] == DIGEST_ALL),
				        'BM'                                => ($row['user_digest_filter_type'] == DIGEST_BOOKMARKS),
				        'BOARD_TO_GMT_0'                    => $board_to_gmt[0],
				        'BOARD_TO_GMT_1'                    => $board_to_gmt[1],
				        'BOARD_TO_GMT_2'                    => $board_to_gmt[2],
				        'BOARD_TO_GMT_3'                    => $board_to_gmt[3],
				        'BOARD_TO_GMT_4'                    => $board_to_gmt[4],
				        'BOARD_TO_GMT_5'                    => $board_to_gmt[5],
				        'BOARD_TO_GMT_6'                    => $board_to_gmt[6],
				        'BOARD_TO_GMT_7'                    => $board_to_gmt[7],
				        'BOARD_TO_GMT_8'                    => $board_to_gmt[8],
				        'BOARD_TO_GMT_9'                    => $board_to_gmt[9],
				        'BOARD_TO_GMT_10'                   => $board_to_gmt[10],
				        'BOARD_TO_GMT_11'                   => $board_to_gmt[11],
				        'BOARD_TO_GMT_12'                   => $board_to_gmt[12],
				        'BOARD_TO_GMT_13'                   => $board_to_gmt[13],
				        'BOARD_TO_GMT_14'                   => $board_to_gmt[14],
				        'BOARD_TO_GMT_15'                   => $board_to_gmt[15],
				        'BOARD_TO_GMT_16'                   => $board_to_gmt[16],
				        'BOARD_TO_GMT_17'                   => $board_to_gmt[17],
				        'BOARD_TO_GMT_18'                   => $board_to_gmt[18],
				        'BOARD_TO_GMT_19'                   => $board_to_gmt[19],
				        'BOARD_TO_GMT_20'                   => $board_to_gmt[20],
				        'BOARD_TO_GMT_21'                   => $board_to_gmt[21],
				        'BOARD_TO_GMT_22'                   => $board_to_gmt[22],
				        'BOARD_TO_GMT_23'                   => $board_to_gmt[23],
				        'DIGEST_MAX_SIZE'                   => $row['user_digest_max_display_words'],
				        'L_DIGEST_CHANGE_SUBSCRIPTION'      => ($row['user_digest_type'] != 'NONE') ? $user->lang['DIGEST_UNSUBSCRIBE'] : $user->lang['DIGEST_SUBSCRIBE_LITERAL'],
				        'S_ALL_BY_DEFAULT'                  => $all_by_default,
				        'S_ATTACHMENTS_NO_CHECKED'          => ($row['user_digest_attachments'] == 0),
				        'S_ATTACHMENTS_YES_CHECKED'         => ($row['user_digest_attachments'] == 1),
				        'S_BLOCK_IMAGES_NO_CHECKED'         => ($row['user_digest_block_images'] == 0),
				        'S_BLOCK_IMAGES_YES_CHECKED'        => ($row['user_digest_block_images'] == 1),
				        'S_BOARD_SELECTED'                  => ($row['user_digest_sortby'] == DIGEST_SORTBY_BOARD),
				        'S_DIGEST_FILTER_FOES_CHECKED_NO'   => ($row['user_digest_remove_foes'] == 0),
				        'S_DIGEST_FILTER_FOES_CHECKED_YES'  => ($row['user_digest_remove_foes'] == 1),
				        'S_DIGEST_DAY_CHECKED'              => ($row['user_digest_type'] == DIGEST_DAILY_VALUE),
				        'S_DIGEST_HTML_CHECKED'             => ($row['user_digest_format'] == DIGEST_HTML_VALUE),
				        'S_DIGEST_HTML_CLASSIC_CHECKED'     => ($row['user_digest_format'] == DIGEST_HTML_CLASSIC_VALUE),
				        'S_DIGEST_MONTH_CHECKED'            => ($row['user_digest_type'] == DIGEST_MONTHLY_VALUE),
				        'S_DIGEST_NEW_POSTS_ONLY_CHECKED_NO'    => ($row['user_digest_new_posts_only'] == 0),
				        'S_DIGEST_NEW_POSTS_ONLY_CHECKED_YES'   => ($row['user_digest_new_posts_only'] == 1),
				        'S_DIGEST_NONE_CHECKED'             => ($row['user_digest_type'] == DIGEST_NONE_VALUE),
				        'S_DIGEST_NO_POST_TEXT_CHECKED_NO'  => ($row['user_digest_no_post_text'] == 0),
				        'S_DIGEST_NO_POST_TEXT_CHECKED_YES' => ($row['user_digest_no_post_text'] == 1),
				        'S_DIGEST_PLAIN_CHECKED'            => ($row['user_digest_format'] == DIGEST_PLAIN_VALUE),
				        'S_DIGEST_PLAIN_CLASSIC_CHECKED'    => ($row['user_digest_format'] == DIGEST_PLAIN_CLASSIC_VALUE),
				        'S_DIGEST_PM_MARK_READ_CHECKED_NO'  => ($row['user_digest_pm_mark_read'] == 0),
				        'S_DIGEST_PM_MARK_READ_CHECKED_YES' => ($row['user_digest_pm_mark_read'] == 1),
				        'S_DIGEST_POST_ANY'                 => ($row['user_digest_filter_type'] == DIGEST_ALL),
				        'S_DIGEST_POST_BM'                  => ($row['user_digest_filter_type'] == DIGEST_BOOKMARKS),
				        'S_DIGEST_POST_FIRST'               => ($row['user_digest_filter_type'] == DIGEST_FIRST),
				        'S_DIGEST_PRIVATE_MESSAGES_IN_DIGEST_NO'    => ($row['user_digest_show_pms'] == 0),
				        'S_DIGEST_PRIVATE_MESSAGES_IN_DIGEST_YES'   => ($row['user_digest_show_pms'] == 1),
				        'S_DIGEST_SEND_HOUR_0_CHECKED'      => ($send_hour_board == 0),
				        'S_DIGEST_SEND_HOUR_1_CHECKED'      => ($send_hour_board == 1),
				        'S_DIGEST_SEND_HOUR_2_CHECKED'      => ($send_hour_board == 2),
				        'S_DIGEST_SEND_HOUR_3_CHECKED'      => ($send_hour_board == 3),
				        'S_DIGEST_SEND_HOUR_4_CHECKED'      => ($send_hour_board == 4),
				        'S_DIGEST_SEND_HOUR_5_CHECKED'      => ($send_hour_board == 5),
				        'S_DIGEST_SEND_HOUR_6_CHECKED'      => ($send_hour_board == 6),
				        'S_DIGEST_SEND_HOUR_7_CHECKED'      => ($send_hour_board == 7),
				        'S_DIGEST_SEND_HOUR_8_CHECKED'      => ($send_hour_board == 8),
				        'S_DIGEST_SEND_HOUR_9_CHECKED'      => ($send_hour_board == 9),
				        'S_DIGEST_SEND_HOUR_10_CHECKED'     => ($send_hour_board == 10),
				        'S_DIGEST_SEND_HOUR_11_CHECKED'     => ($send_hour_board == 11),
				        'S_DIGEST_SEND_HOUR_12_CHECKED'     => ($send_hour_board == 12),
				        'S_DIGEST_SEND_HOUR_13_CHECKED'     => ($send_hour_board == 13),
				        'S_DIGEST_SEND_HOUR_14_CHECKED'     => ($send_hour_board == 14),
				        'S_DIGEST_SEND_HOUR_15_CHECKED'     => ($send_hour_board == 15),
				        'S_DIGEST_SEND_HOUR_16_CHECKED'     => ($send_hour_board == 16),
				        'S_DIGEST_SEND_HOUR_17_CHECKED'     => ($send_hour_board == 17),
				        'S_DIGEST_SEND_HOUR_18_CHECKED'     => ($send_hour_board == 18),
				        'S_DIGEST_SEND_HOUR_19_CHECKED'     => ($send_hour_board == 19),
				        'S_DIGEST_SEND_HOUR_20_CHECKED'     => ($send_hour_board == 20),
				        'S_DIGEST_SEND_HOUR_21_CHECKED'     => ($send_hour_board == 21),
				        'S_DIGEST_SEND_HOUR_22_CHECKED'     => ($send_hour_board == 22),
				        'S_DIGEST_SEND_HOUR_23_CHECKED'     => ($send_hour_board == 23),
				        'S_DIGEST_SEND_ON_NO_POSTS_NO_CHECKED'  => ($row['user_digest_send_on_no_posts'] == 0),
				        'S_DIGEST_SEND_ON_NO_POSTS_YES_CHECKED' => ($row['user_digest_send_on_no_posts'] == 1),
				        'S_DIGEST_SHOW_MINE_CHECKED_YES'    => ($row['user_digest_show_mine'] == 1),
				        'S_DIGEST_SHOW_MINE_CHECKED_NO'     => ($row['user_digest_show_mine'] == 0),
				        'S_DIGEST_TEXT_CHECKED'             => ($row['user_digest_format'] == DIGEST_TEXT_VALUE),
				        'S_DIGEST_WEEK_CHECKED'             => ($row['user_digest_type'] == DIGEST_WEEKLY_VALUE),
				        'S_DIGEST_PRIVATE_MESSAGES_IN_DIGEST_NO'    => ($user->data['user_digest_show_pms'] == 0),
				        'S_LASTVISIT_NO_CHECKED'            => ($row['user_digest_reset_lastvisit'] == 0),
				        'S_LASTVISIT_YES_CHECKED'           => ($row['user_digest_reset_lastvisit'] == 1),
				        'S_POSTDATE_DESC_SELECTED'          => ($row['user_digest_sortby'] == DIGEST_SORTBY_POSTDATE_DESC),
				        'S_POSTDATE_SELECTED'               => ($row['user_digest_sortby'] == DIGEST_SORTBY_POSTDATE),
				        'S_STANDARD_DESC_SELECTED'          => ($row['user_digest_sortby'] == DIGEST_SORTBY_STANDARD_DESC),
				        'S_STANDARD_SELECTED'               => ($row['user_digest_sortby'] == DIGEST_SORTBY_STANDARD),
				        'S_TOC_NO_CHECKED'                  => ($row['user_digest_toc'] == 0),
				        'S_TOC_YES_CHECKED'                 => ($row['user_digest_toc'] == 1),
				        'USERNAME'                          => $row['username'],
				        'USER_DIGEST_FORMAT'                => $digest_format,
				        'USER_DIGEST_HAS_UNSUBSCRIBED'      => ($row['user_digest_has_unsubscribed']) ? 'x' : '-',
				        'USER_DIGEST_LAST_SENT'             => ($row['user_digest_last_sent'] == 0) ? $user->lang['DIGEST_NO_DIGESTS_SENT'] : date($config['default_dateformat'], $row['user_digest_last_sent'] + (3600 * $config['digests_time_zone'])),
				        'USER_DIGEST_MAX_POSTS'             => $row['user_digest_max_posts'],
				        'USER_DIGEST_MIN_WORDS'             => $row['user_digest_min_words'],
				        'USER_DIGEST_TYPE'                  => $digest_type,
				        'USER_EMAIL'                        => $row['user_email'],
				        'USER_ID'                           => $row['user_id'],
				        'USER_LAST_VISIT'                   => ($row['user_lastvisit'] == 0) ? $user->lang['DIGEST_NEVER_VISITED'] : date($config['default_dateformat'], $row['user_lastvisit'] + (3600 * $config['digests_time_zone'])),
				        'USER_SUBSCRIBE_UNSUBSCRIBE_FLAG'   => ($row['user_digest_type'] != 'NONE') ? 'u' : 's')
				    );
	 
				    // Now let's get this user's forum permissions. Note that non-registered, robots etc. get a list of public forums
				    // with read permissions.
	 
				    unset($allowed_forums, $forum_array, $parent_stack);
	 
				    $forum_array = $auth->acl_raw_data_single_user($row['user_id']);
	 
				    foreach ($forum_array as $key => $value)
				    {
	 
				        foreach ($value as $auth_option_id => $auth_setting)
				        {
				            if ($auth_option_id == $read_id)
				            {
				                if ($auth_setting == 1)
				                {
				                    $allowed_forums[] = $key;
				                }
				            }
				        }
	 
				    }

					// Now we will display the forums that this user can read, as well as any parent forums, checking those if any that 
					// the user has subscribed to.

					if (isset($allowed_forums))
					{
				 
						$sql2 = 'SELECT forum_name, forum_id, parent_id, forum_type
						FROM ' . FORUMS_TABLE . ' 
						WHERE ' . $db->sql_in_set('forum_id', $allowed_forums) . ' AND forum_type <> ' . FORUM_LINK . "
						AND forum_password = ''
						ORDER BY left_id ASC";
	 
						$result2 = $db->sql_query($sql2);
					 
						$current_level = 0;            // How deeply nested are we at the moment
						$parent_stack = array();   // Holds a stack showing the current parent_id of the forum
						$parent_stack[] = 0;       // 0, the first value in the stack, represents the <div_0> element, a container holding all the categories and forums in the template
					 
						while ($row2 = $db->sql_fetchrow($result2))
						{
							if ((int) $row2['parent_id'] != (int) end($parent_stack) || (end($parent_stack) == 0))
							{
								if (in_array($row2['parent_id'], $parent_stack, true))
								{
									// If parent is in the stack, then pop the stack until the parent is found, otherwise push stack adding the current parent. This creates a </div>
									while ((int) $row2['parent_id'] != (int) end($parent_stack))
									{
										array_pop($parent_stack);
										$current_level--;
										// Need to close a category level here
										$template->assign_block_vars('digest_edit_subscribers.forums', array( 
											'S_DIV_CLOSE'   => true,
											'S_DIV_OPEN'    => false,
											'S_PRINT'       => false,
											)
										);
									}
								}
								else
								{
									// If the parent is not in the stack, then push the parent_id on the stack. This is also a trigger to indent the block. This creates a <div>
									array_push($parent_stack, (int) $row2['parent_id']);
									$current_level++;
									// Need to add a category level here
									$template->assign_block_vars('digest_edit_subscribers.forums', array( 
										'CAT_ID'            => 'div_' . $row2['parent_id'],
										'S_DIV_CLOSE'       => false,
										'S_DIV_OPEN'        => true,
										'S_PRINT'           => false,
										)
									);
								}
							}
					 
							// This code prints the forum or category, which will exist inside the previously created <div> block
					 
							// Check this forum's checkbox? Only if they have forum subscriptions
							if (!$all_by_default)
							{
								$check = false;
								foreach($subscribed_forums as $this_row)
								{
									if ($this_row['forum_id'] == $row2['forum_id'])
									{
										$check = true;
										break;
									}
								}
							}
							else
							{
								$check = true;
							}
					 
							$success = $template->assign_block_vars('digest_edit_subscribers.forums', array( 
								'FORUM_LABEL'           => $row2['forum_name'],
								'FORUM_NAME'            => 'elt_' . (int) $row2['forum_id'] . '_' . (int) $row2['parent_id'],
								'S_FORUM_SUBSCRIBED'    => $check,
								'S_IS_FORUM'            => !($row2['forum_type'] == FORUM_CAT),
								'S_PRINT'               => true,
								)
							);
					 
						}
					 
						$db->sql_freeresult($result2);
					 
						// Now out of the loop, it is important to remember to close any open <div> tags. Typically there is at least one.
						while (!empty($parent_stack) && end($parent_stack) !== 0)
						{
							array_pop($parent_stack);
							$current_level--;
							// Need to close the <div> tag
							$template->assign_block_vars('digest_edit_subscribers.forums', array( 
								'S_DIV_CLOSE'   => true,
								'S_DIV_OPEN'    => false,
								'S_PRINT'       => false,
								)
							);
						}
					 
					}
					
				}
		
				$db->sql_freeresult($result); // Query be gone!
					
			break;
			
	        case 'digest_balance_load':
	 
				$digest_version_info = digests_version();
				$display_vars = array(
				    'title' => 'ACP_DIGEST_BALANCE_LOAD',
				    'vars'  => array(
				        'legend1'                               => '',
				    )
				);
	 
				// Translate time zone information
				$template->assign_vars(array(
				    'L_DIGEST_HOUR_SENT'                        => sprintf($user->lang['DIGEST_HOUR_SENT'], $config['digests_time_zone']),
				));
	 
				$sql = 'SELECT user_digest_send_hour_gmt AS hour, count(*) AS hour_count
				    FROM ' . USERS_TABLE . "
				    WHERE user_digest_type <> '" . DIGEST_NONE_VALUE . "' AND user_type <> " . USER_IGNORE . '
				    GROUP BY user_digest_send_hour_gmt
				    ORDER BY 1';
	 
				$result = $db->sql_query($sql);
				$rowset = $db->sql_fetchrowset($result);
	 
				for($i=0;$i<24;$i++)
				{
	 
				    // Convert digest timezone to GMT, to the hour if necessary to accommodate strange timezones
				    $hour_gmt = floor($i - $config['digests_time_zone']);
	 
				    if ($hour_gmt < 0)
				    {
				        $hour_gmt = $hour_gmt + 24;
				    }
				    else if ($hour_gmt > 23)
				    {
				        $hour_gmt = $hour_gmt - 24;
				    }
	 
				    // If there are digest counts for this GMT hour, show it, otherwise show zero (no digests for this GMT hour)
				    $hour_count = 0;
				    if (isset($rowset) && is_array($rowset))
				    {
				        foreach ($rowset as $row)
				        {
				            if (floor($row['hour']) == $hour_gmt)
				            {
				                $hour_count = $row['hour_count'];
				                break;
				            }
				        }
				    }
	 
				    $template->assign_block_vars('digest_balance_load', array(
				        'HOUR'               => $i,
				        'HOUR_COUNT'         => $hour_count,
				    ));
	 
				}               
				$db->sql_freeresult($result); // Query be gone!
	 
	            break;
	 
	            case 'digest_mass_subscribe_unsubscribe':
				$orig_digests_enabled = $config['digests_enabled'];
				$digest_version_info = digests_version();
	 
				$display_vars = array(
				    'title' => 'ACP_DIGEST_MASS_SUBSCRIBE_UNSUBSCRIBE',
				    'vars'  => array(
				        'legend1'                               => '',
				        'digests_enable_subscribe_unsubscribe'  => array('lang' => 'DIGEST_ENABLE_SUBSCRIBE_UNSUBSCRIBE',   'validate' => 'bool',   'type' => 'radio:yes_no', 'explain' => true),
				        'digests_subscribe_all'                 => array('lang' => 'DIGEST_SUBSCRIBE_ALL',              'validate' => 'bool',   'type' => 'radio:yes_no', 'explain' => true),
				        'digests_include_admins'                => array('lang' => 'DIGEST_INCLUDE_ADMINS',             'validate' => 'bool',   'type' => 'radio:yes_no', 'explain' => true),
				        'digests_notify_on_mass_subscribe'      => array('lang' => 'DIGEST_NOTIFY_ON_MASS_SUBSCRIBE',           'validate' => 'bool',   'type' => 'radio:yes_no', 'explain' => false),
				    )
				);
	            break;
				
			// phpBB Digest MOD - Addition end -------------------------------------------------------------
 
			case 'feed':
				$display_vars = array(
					'title'	=> 'ACP_FEED_MANAGEMENT',
					'vars'	=> array(
						'legend1'					=> 'ACP_FEED_GENERAL',
						'feed_enable'				=> array('lang' => 'ACP_FEED_ENABLE',				'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => true ),
						'feed_item_statistics'		=> array('lang' => 'ACP_FEED_ITEM_STATISTICS',		'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => true),
						'feed_http_auth'			=> array('lang' => 'ACP_FEED_HTTP_AUTH',			'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => true),

						'legend2'					=> 'ACP_FEED_POST_BASED',
						'feed_limit_post'			=> array('lang' => 'ACP_FEED_LIMIT',				'validate' => 'int:5',	'type' => 'text:3:4',				'explain' => true),
						'feed_overall'				=> array('lang' => 'ACP_FEED_OVERALL',				'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => true ),
						'feed_forum'				=> array('lang' => 'ACP_FEED_FORUM',				'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => true ),
						'feed_topic'				=> array('lang' => 'ACP_FEED_TOPIC',				'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => true ),

						'legend3'					=> 'ACP_FEED_TOPIC_BASED',
						'feed_limit_topic'			=> array('lang' => 'ACP_FEED_LIMIT',				'validate' => 'int:5',	'type' => 'text:3:4',				'explain' => true),
						'feed_topics_new'			=> array('lang' => 'ACP_FEED_TOPICS_NEW',			'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => true ),
						'feed_topics_active'		=> array('lang' => 'ACP_FEED_TOPICS_ACTIVE',		'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => true ),
						'feed_news_id'				=> array('lang' => 'ACP_FEED_NEWS',					'validate' => 'string',	'type' => 'custom', 'method' => 'select_news_forums', 'explain' => true),

						'legend4'					=> 'ACP_FEED_SETTINGS_OTHER',
						'feed_overall_forums'		=> array('lang'	=> 'ACP_FEED_OVERALL_FORUMS',		'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => true ),
						'feed_exclude_id'			=> array('lang' => 'ACP_FEED_EXCLUDE_ID',			'validate' => 'string',	'type' => 'custom', 'method' => 'select_exclude_forums', 'explain' => true),
					)
				);
			break;

			case 'cookie':
				$display_vars = array(
					'title'	=> 'ACP_COOKIE_SETTINGS',
					'vars'	=> array(
						'legend1'				=> 'ACP_COOKIE_SETTINGS',
						'cookie_domain'			=> array('lang' => 'COOKIE_DOMAIN',		'validate' => 'string',	'type' => 'text:25:255', 'explain' => true),
						'cookie_name'			=> array('lang' => 'COOKIE_NAME',		'validate' => 'string',	'type' => 'text:25:255', 'explain' => true),
						'cookie_path'			=> array('lang' => 'COOKIE_PATH',		'validate' => 'string',	'type' => 'text:25:255', 'explain' => true),
						'cookie_secure'			=> array('lang' => 'COOKIE_SECURE',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'cookie_httponly'		=> array('lang' => 'COOKIE_HTTPONLY',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'cookie_samesite'		=> array('lang' => 'COOKIE_SAMESITE',	'validate' => 'int',	'type' => 'custom', 'method' => 'samesite_select', 'explain' => true),
						'cookie_partitioned'	=> array('lang' => 'COOKIE_PARTITIONED',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'cookie_secure_admin'	=> array('lang' => 'COOKIE_SECURE_ADMIN',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'session_length'		=> array('lang' => 'SESSION_LENGTH',	'validate' => 'int:60:9999999',	'type' => 'text:5:8', 'explain' => true, 'append' => ' ' . $user->lang['SECONDS']),
						'online_length'			=> array('lang' => 'ONLINE_LENGTH',		'validate' => 'int:1:9999',	'type' => 'text:4:4', 'explain' => true, 'append' => ' ' . $user->lang['MINUTES']),
						
						'legend2'				=> 'COOKIE_CONSENT_SETTINGS',
						'cookie_consent_enable'	=> array('lang' => 'COOKIE_CONSENT_ENABLE', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
						'cookie_consent_title'	=> array('lang' => 'COOKIE_CONSENT_TITLE', 'validate' => 'string', 'type' => 'text:25:255', 'explain' => true),
						'cookie_consent_message'=> array('lang' => 'COOKIE_CONSENT_MESSAGE', 'validate' => 'string', 'type' => 'textarea:5:50', 'explain' => true),
						'cookie_consent_accept_text'=> array('lang' => 'COOKIE_CONSENT_ACCEPT_TEXT', 'validate' => 'string', 'type' => 'text:25:255', 'explain' => true),
						'cookie_consent_decline_text'=> array('lang' => 'COOKIE_CONSENT_DECLINE_TEXT', 'validate' => 'string', 'type' => 'text:25:255', 'explain' => true),
						'cookie_consent_position'=> array('lang' => 'COOKIE_CONSENT_POSITION', 'validate' => 'int', 'type' => 'custom', 'method' => 'consent_position_select', 'explain' => true),
					)
				);
			break;

			case 'load':
				$display_vars = array(
					'title'	=> 'ACP_LOAD_SETTINGS',
					'vars'	=> array(
						'legend1'			=> 'GENERAL_SETTINGS',
						'limit_load'		=> array('lang' => 'LIMIT_LOAD',		'validate' => 'string',	'type' => 'text:4:4', 'explain' => true),
						'session_length'	=> array('lang' => 'SESSION_LENGTH',	'validate' => 'int:60',	'type' => 'text:5:10', 'explain' => true, 'append' => ' ' . $user->lang['SECONDS']),
						'active_sessions'	=> array('lang' => 'LIMIT_SESSIONS',	'validate' => 'int:0',	'type' => 'text:4:4', 'explain' => true),
						'load_online_time'	=> array('lang' => 'ONLINE_LENGTH',		'validate' => 'int:0',	'type' => 'text:4:3', 'explain' => true, 'append' => ' ' . $user->lang['MINUTES']),

						'legend2'				=> 'GENERAL_OPTIONS',
						'load_db_track'			=> array('lang' => 'YES_POST_MARKING',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'load_db_lastread'		=> array('lang' => 'YES_READ_MARKING',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'load_anon_lastread'	=> array('lang' => 'YES_ANON_READ_MARKING',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'load_online'			=> array('lang' => 'YES_ONLINE',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'load_online_guests'	=> array('lang' => 'YES_ONLINE_GUESTS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'load_onlinetrack'		=> array('lang' => 'YES_ONLINE_TRACK',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'load_birthdays'		=> array('lang' => 'YES_BIRTHDAYS',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'load_unreads_search'	=> array('lang' => 'YES_UNREAD_SEARCH',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'load_moderators'		=> array('lang' => 'YES_MODERATORS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'load_jumpbox'			=> array('lang' => 'YES_JUMPBOX',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'load_user_activity'	=> array('lang' => 'LOAD_USER_ACTIVITY',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'load_tplcompile'		=> array('lang' => 'RECOMPILE_STYLES',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),

						'legend3'				=> 'CUSTOM_PROFILE_FIELDS',
						'load_cpf_memberlist'	=> array('lang' => 'LOAD_CPF_MEMBERLIST',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'load_cpf_viewprofile'	=> array('lang' => 'LOAD_CPF_VIEWPROFILE',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'load_cpf_viewtopic'	=> array('lang' => 'LOAD_CPF_VIEWTOPIC',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),

						'legend4'					=> 'ACP_SUBMIT_CHANGES',
					)
				);
			break;

			case 'auth':
				$display_vars = array(
					'title'	=> 'ACP_AUTH_SETTINGS',
					'vars'	=> array(
						'legend1'		=> 'ACP_AUTH_SETTINGS',
						'auth_method'	=> array('lang' => 'AUTH_METHOD',	'validate' => 'string',	'type' => 'select', 'method' => 'select_auth_method', 'explain' => false)
					)
				);
			break;

			case 'server':
				$display_vars = array(
					'title'	=> 'ACP_SERVER_SETTINGS',
					'vars'	=> array(
						'legend1'				=> 'ACP_SERVER_SETTINGS',
						'gzip_compress'			=> array('lang' => 'ENABLE_GZIP',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),

						'legend2'				=> 'PATH_SETTINGS',
						'smilies_path'			=> array('lang' => 'SMILIES_PATH',		'validate' => 'rpath',	'type' => 'text:20:255', 'explain' => true),
						'icons_path'			=> array('lang' => 'ICONS_PATH',		'validate' => 'rpath',	'type' => 'text:20:255', 'explain' => true),
						'upload_icons_path'		=> array('lang' => 'UPLOAD_ICONS_PATH',	'validate' => 'rpath',	'type' => 'text:20:255', 'explain' => true),
						'ranks_path'			=> array('lang' => 'RANKS_PATH',		'validate' => 'rpath',	'type' => 'text:20:255', 'explain' => true),

						'legend3'				=> 'SERVER_URL_SETTINGS',
						'force_server_vars'		=> array('lang' => 'FORCE_SERVER_VARS',	'validate' => 'bool',			'type' => 'radio:yes_no', 'explain' => true),
						'server_protocol'		=> array('lang' => 'SERVER_PROTOCOL',	'validate' => 'string',			'type' => 'text:10:10', 'explain' => true),
						'server_name'			=> array('lang' => 'SERVER_NAME',		'validate' => 'string',			'type' => 'text:40:255', 'explain' => true),
						'server_port'			=> array('lang' => 'SERVER_PORT',		'validate' => 'int:0',			'type' => 'text:5:5', 'explain' => true),
						'script_path'			=> array('lang' => 'SCRIPT_PATH',		'validate' => 'script_path',	'type' => 'text::255', 'explain' => true),

						'legend4'					=> 'ACP_SUBMIT_CHANGES',
					)
				);
			break;

			case 'security':
				$display_vars = array(
					'title'	=> 'ACP_SECURITY_SETTINGS',
					'vars'	=> array(
						'legend1'				=> 'ACP_SECURITY_SETTINGS',
						'allow_autologin'		=> array('lang' => 'ALLOW_AUTOLOGIN',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'max_autologin_time'	=> array('lang' => 'AUTOLOGIN_LENGTH',		'validate' => 'int:0',	'type' => 'text:5:5', 'explain' => true, 'append' => ' ' . $user->lang['DAYS']),
						'ip_check'				=> array('lang' => 'IP_VALID',				'validate' => 'int',	'type' => 'custom', 'method' => 'select_ip_check', 'explain' => true),
						'browser_check'			=> array('lang' => 'BROWSER_VALID',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'forwarded_for_check'	=> array('lang' => 'FORWARDED_FOR_VALID',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'referer_validation'	=> array('lang' => 'REFERER_VALID',		'validate' => 'int:0:3','type' => 'custom', 'method' => 'select_ref_check', 'explain' => true),
						'check_dnsbl'			=> array('lang' => 'CHECK_DNSBL',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'email_check_mx'		=> array('lang' => 'EMAIL_CHECK_MX',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'max_pass_chars'		=> array('lang' => 'PASSWORD_LENGTH', 'validate' => 'int:8:255', 'type' => false, 'method' => false, 'explain' => false,),
						'min_pass_chars'		=> array('lang' => 'PASSWORD_LENGTH',	'validate' => 'int:1',	'type' => 'custom', 'method' => 'password_length', 'explain' => true),
						'pass_complex'			=> array('lang' => 'PASSWORD_TYPE',			'validate' => 'string',	'type' => 'select', 'method' => 'select_password_chars', 'explain' => true),
						'chg_passforce'			=> array('lang' => 'FORCE_PASS_CHANGE',		'validate' => 'int:0',	'type' => 'text:3:3', 'explain' => true, 'append' => ' ' . $user->lang['DAYS']),
						'max_login_attempts'	=> array('lang' => 'MAX_LOGIN_ATTEMPTS',	'validate' => 'int:0',	'type' => 'text:3:3', 'explain' => true),
						'ip_login_limit_max'	=> array('lang' => 'IP_LOGIN_LIMIT_MAX',	'validate' => 'int:0',	'type' => 'text:3:3', 'explain' => true),
						'ip_login_limit_time'	=> array('lang' => 'IP_LOGIN_LIMIT_TIME',	'validate' => 'int:0',	'type' => 'text:5:5', 'explain' => true, 'append' => ' ' . $user->lang['SECONDS']),
						'ip_login_limit_use_forwarded'	=> array('lang' => 'IP_LOGIN_LIMIT_USE_FORWARDED',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'tpl_allow_php'			=> array('lang' => 'TPL_ALLOW_PHP',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'form_token_lifetime'	=> array('lang' => 'FORM_TIME_MAX',			'validate' => 'int:-1',	'type' => 'text:5:5', 'explain' => true, 'append' => ' ' . $user->lang['SECONDS']),
						'form_token_sid_guests'	=> array('lang' => 'FORM_SID_GUESTS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),

					)
				);
			break;

			case 'email':
				$display_vars = array(
					'title'	=> 'ACP_EMAIL_SETTINGS',
					'vars'	=> array(
						'legend1'				=> 'GENERAL_SETTINGS',
						'email_enable'			=> array('lang' => 'ENABLE_EMAIL',			'validate' => 'bool',	'type' => 'radio:enabled_disabled', 'explain' => true),
						'board_email_form'		=> array('lang' => 'BOARD_EMAIL_FORM',		'validate' => 'bool',	'type' => 'radio:enabled_disabled', 'explain' => true),
						'email_function_name'	=> array('lang' => 'EMAIL_FUNCTION_NAME',	'validate' => 'string',	'type' => 'text:20:50', 'explain' => true),
						'email_package_size'	=> array('lang' => 'EMAIL_PACKAGE_SIZE',	'validate' => 'int:0',	'type' => 'text:5:5', 'explain' => true),
						'board_contact'			=> array('lang' => 'CONTACT_EMAIL',			'validate' => 'email',	'type' => 'text:25:100', 'explain' => true),
						'board_email'			=> array('lang' => 'ADMIN_EMAIL',			'validate' => 'email',	'type' => 'text:25:100', 'explain' => true),
						'board_email_sig'		=> array('lang' => 'EMAIL_SIG',				'validate' => 'string',	'type' => 'textarea:5:30', 'explain' => true),
						'board_hide_emails'		=> array('lang' => 'BOARD_HIDE_EMAILS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),

						'legend2'				=> 'SMTP_SETTINGS',
						'smtp_delivery'			=> array('lang' => 'USE_SMTP',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'smtp_host'				=> array('lang' => 'SMTP_SERVER',			'validate' => 'string',	'type' => 'text:25:50', 'explain' => false),
						'smtp_port'				=> array('lang' => 'SMTP_PORT',				'validate' => 'int:0',	'type' => 'text:4:5', 'explain' => true),
						'smtp_auth_method'		=> array('lang' => 'SMTP_AUTH_METHOD',		'validate' => 'string',	'type' => 'select', 'method' => 'mail_auth_select', 'explain' => true),
						'smtp_username'			=> array('lang' => 'SMTP_USERNAME',			'validate' => 'string',	'type' => 'text:25:255', 'explain' => true),
						'smtp_password'			=> array('lang' => 'SMTP_PASSWORD',			'validate' => 'string',	'type' => 'password:25:255', 'explain' => true),

						'legend3'					=> 'ACP_SUBMIT_CHANGES',
					)
				);
			break;

			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}

		if (isset($display_vars['lang']))
		{
			$user->add_lang($display_vars['lang']);
		}

		$this->new_config = $config;
		$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
		$error = array();

		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);

		if ($submit && !check_form_key($form_key))
		{
			$error[] = $user->lang['FORM_INVALID'];
		}
		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
		}

		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}

			if ($config_name == 'auth_method' || $config_name == 'feed_news_id' || $config_name == 'feed_exclude_id')
			{
				continue;
			}

			$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

			if ($config_name == 'email_function_name')
			{
				$this->new_config['email_function_name'] = trim(str_replace(array('(', ')'), array('', ''), $this->new_config['email_function_name']));
				$this->new_config['email_function_name'] = (empty($this->new_config['email_function_name']) || !function_exists($this->new_config['email_function_name'])) ? 'mail' : $this->new_config['email_function_name'];
				$config_value = $this->new_config['email_function_name'];
			}

			if ($submit)
			{
				set_config($config_name, $config_value);

				if ($config_name == 'allow_quick_reply' && isset($_POST['allow_quick_reply_enable']))
				{
					enable_bitfield_column_flag(FORUMS_TABLE, 'forum_flags', log(FORUM_FLAG_QUICK_REPLY, 2));
				}
			}
		}

		// Store news and exclude ids
		if ($mode == 'feed' && $submit)
		{
			$cache->destroy('_feed_news_forum_ids');
			$cache->destroy('_feed_excluded_forum_ids');

			$this->store_feed_forums(FORUM_OPTION_FEED_NEWS, 'feed_news_id');
			$this->store_feed_forums(FORUM_OPTION_FEED_EXCLUDE, 'feed_exclude_id');
		}

		if ($mode == 'auth')
		{
			// Retrieve a list of auth plugins and check their config values
			$auth_plugins = array();

			$dp = @opendir($phpbb_root_path . 'includes/auth');

			if ($dp)
			{
				while (($file = readdir($dp)) !== false)
				{
					if (preg_match('#^auth_(.*?)\.' . $phpEx . '$#', $file))
					{
						$auth_plugins[] = basename(preg_replace('#^auth_(.*?)\.' . $phpEx . '$#', '\1', $file));
					}
				}
				closedir($dp);

				sort($auth_plugins);
			}

			$updated_auth_settings = false;
			$old_auth_config = array();
			foreach ($auth_plugins as $method)
			{
				if ($method && file_exists($phpbb_root_path . 'includes/auth/auth_' . $method . '.' . $phpEx))
				{
					include_once($phpbb_root_path . 'includes/auth/auth_' . $method . '.' . $phpEx);

					$method = 'acp_' . $method;
					if (function_exists($method))
					{
						if ($fields = $method($this->new_config))
						{
							// Check if we need to create config fields for this plugin and save config when submit was pressed
							foreach ($fields['config'] as $field)
							{
								if (!isset($config[$field]))
								{
									set_config($field, '');
								}

								if (!isset($cfg_array[$field]) || strpos($field, 'legend') !== false)
								{
									continue;
								}

								$old_auth_config[$field] = $this->new_config[$field];
								$config_value = $cfg_array[$field];
								$this->new_config[$field] = $config_value;

								if ($submit)
								{
									$updated_auth_settings = true;
									set_config($field, $config_value);
								}
							}
						}
						unset($fields);
					}
				}
			}

			if ($submit && (($cfg_array['auth_method'] != $this->new_config['auth_method']) || $updated_auth_settings))
			{
				$method = basename($cfg_array['auth_method']);
				if ($method && in_array($method, $auth_plugins))
				{
					include_once($phpbb_root_path . 'includes/auth/auth_' . $method . '.' . $phpEx);

					$method = 'init_' . $method;
					if (function_exists($method))
					{
						if ($error = $method())
						{
							foreach ($old_auth_config as $config_name => $config_value)
							{
								set_config($config_name, $config_value);
							}
							trigger_error($error . adm_back_link($this->u_action), E_USER_WARNING);
						}
					}
					set_config('auth_method', basename($cfg_array['auth_method']));
				}
				else
				{
					trigger_error('NO_AUTH_PLUGIN', E_USER_ERROR);
				}
			}
		}

		if ($submit)
		{
			add_log('admin', 'LOG_CONFIG_' . strtoupper($mode));

	        // Begin Digest Mod
	        $custom_message = '';
	        if ($mode == 'digest_general')
	        {
	            if ($orig_digests_enabled != $config['digests_enabled'])
	            {
	                // Enable or disable the digests module
	                $sql = 'UPDATE ' . MODULES_TABLE . 
	                    " SET module_enabled = " . $config['digests_enabled'] . "
	                    WHERE module_langname = 'UCP_DIGESTS'";
	                $result = $db->sql_query($sql);
	                // Purge the cache otherwise the module is still seen
	                $cache->purge();
	            }
	        }
	 
	        if ($mode == 'digest_edit_subscribers')
	        {
	 
	            // Find the value of "selected" so we can set a switch
	            $subscribe_mode = request_var('selected', DIGEST_NONE_VALUE);
	 
	            // Now let's sort them so we process one user at a time
	            ksort($_POST);
	 
	            // Set some flags
	            $current_user_id = NULL;
	            $subscribe_default = false;    // When true, subscribe this user with the default rules
	            unset($sql_ary, $sql_ary2);
	 
	            // Any users to unsubscribe or subscribe? If yes, process these now.
	            foreach ($_POST as $name => $value)
	            {
	 
	                // We only care if the POST variable starts with "user-". There are likely multiple variables like this for the same user
	                // representing all the controls for that user.
	                if (substr(htmlspecialchars($name, ENT_QUOTES, 'UTF-8'), 0, 5) == 'user-')
	                {
	 
	                    // Parse for the user id, which is embedded in the form field name. Format is user-99-column_name where 99
	                    // is the user id.
	                    $delimiter_pos = strpos($name, '-', 5);
	                    $user_id = substr(htmlspecialchars($name, ENT_QUOTES, 'UTF-8'), 5, $delimiter_pos - 5);
	                    $var_part = substr(htmlspecialchars($name, ENT_QUOTES, 'UTF-8'), $delimiter_pos + 1);
	 
	                    if ($current_user_id === NULL)
	                    {
	                        $current_user_id = $user_id;
	                        // We need to set these variables so we can detect if individual forum subscriptions will need to be processed.
	                        $var = 'user-' . $current_user_id . '-all_forums';
	                        $all_forums = request_var($var, '');
	                        $var = 'user-' . $current_user_id . '-filter_type';
	                        $filter_type = request_var($var, '');
	                    }
	 
	                    // Associate the database columns with its requested value
	                    switch (substr($name, $delimiter_pos + 1))
	                    {
	                        case 'digest_type':
	                            // Default digest wanted because row is checked
	                            if ((($subscribe_mode == DIGEST_DEFAULT_VALUE) && (array_key_exists('mark-' . $user_id, $_POST))) ||
	                                ($value == DIGEST_DEFAULT_VALUE))
	                            {
	                                $subscribe_default = true;
	                            }
	                            else if (($subscribe_mode == DIGEST_NONE_VALUE) && (array_key_exists('mark-' . $user_id, $_POST)))
	                            {
	                                $sql_ary['user_digest_type'] = DIGEST_NONE_VALUE;
	                            }
	                            else
	                            {
	                                $sql_ary['user_digest_type'] = $value;
	                            }
	                            break;
	                        case 'style':
	                            $sql_ary['user_digest_format'] = $value;
	                            break;
	                        case 'send_hour':
	                            $sql_ary['user_digest_send_hour_gmt'] = $value;
	                            break;
	                        case 'filter_type':
	                            $sql_ary['user_digest_filter_type'] = $value;
	                            break;
	                        case 'max_posts':
	                            $sql_ary['user_digest_max_posts'] = $value;
	                            break;
	                        case 'min_words':
	                            $sql_ary['user_digest_min_words'] = $value;
	                            break;
	                        case 'new_posts_only':
	                            $sql_ary['user_digest_new_posts_only'] = $value;
	                            break;
	                        case 'show_mine':
	                            $sql_ary['user_digest_show_mine'] = ($value == '0') ? '1' : '0';
	                            break;
	                        case 'filter_foes':
	                            $sql_ary['user_digest_remove_foes'] = $value;
	                            break;
	                        case 'pms':
	                            $sql_ary['user_digest_show_pms'] = $value;
	                            break;
	                        case 'mark_read':
	                            $sql_ary['user_digest_pm_mark_read'] = $value;
	                            break;
	                        case 'sortby':
	                            $sql_ary['user_digest_sortby'] = $value;
	                            break;
	                        case 'max_word_size':
	                            $sql_ary['user_digest_max_display_words'] = $value;
	                            break;
	                        case 'no_post_text':
	                            $sql_ary['user_digest_no_post_text'] = $value;
	                            break;
	                        case 'send_on_no_posts':
	                            $sql_ary['user_digest_send_on_no_posts'] = $value;
	                            break;
	                        case 'lastvisit':
	                            $sql_ary['user_digest_reset_lastvisit'] = $value;
	                            break;
	                        case 'attachments':
	                            $sql_ary['user_digest_attachments'] = $value;
	                            break;
	                        case 'blockimages':
	                            $sql_ary['user_digest_block_images'] = $value;
	                            break;
	                        case 'toc':
	                            $sql_ary['user_digest_toc'] = $value;
	                            break;
	                    }
	 
	                    // Note that if "all_forums" is unchecked and bookmarks is unchecked, there are individual forum subscriptions, so they must be saved.
	                    if (substr($var_part, 0, 4) == 'elt_')
	                    {
	                        // We should save this forum as an individual forum subscription, but only if the all forums checkbox
	                        // is not set AND the user should not get posts for bookmarked topics only.
	 
	                        // This $_POST variable is a checkbox for a forum for this user. It should be checked or it would
	                        // not be in the $_POST array.
	 
	                        $delimiter_pos = strpos($var_part, '_', 4);
	                        $forum_id = substr($var_part, 4, $delimiter_pos - 4);
	 
	                        if (($all_forums !== 'on') && (trim($filter_type) !== DIGEST_BOOKMARKS)) 
	                        {
	                            $sql_ary2[] = array(
	                                'user_id'       => $current_user_id,
	                                'forum_id'      => $forum_id);
	                        }
	                    }
	 
	                    if ($user_id !== $current_user_id)
	                    {
	                        // Since the $user_id has changed, we need to save the digest settings for this user
	                        if ($subscribe_default)
	                        {
	                            unset($sql_ary);
	 
	                            // Create a digest subscription using board defaults
	                            $sql_ary = array(
	                                'user_digest_type'              => $config['digests_user_digest_type'],
	                                'user_digest_format'            => $config['digests_user_digest_format'],
	                                'user_digest_show_mine'         => ($config['digests_user_digest_show_mine'] == 1) ? 0 : 1,
	                                'user_digest_send_on_no_posts'  => $config['digests_user_digest_send_on_no_posts'],
	                                'user_digest_send_hour_gmt'     => ($config['digests_user_digest_send_hour_gmt'] == -1) ? rand(0, 23) : $config['digests_user_digest_send_hour_gmt'],
	                                'user_digest_show_pms'          => $config['digests_user_digest_show_pms'],
	                                'user_digest_max_posts'         => $config['digests_user_digest_max_posts'],
	                                'user_digest_min_words'         => $config['digests_user_digest_min_words'],
	                                'user_digest_remove_foes'       => $config['digests_user_digest_remove_foes'],
	                                'user_digest_sortby'            => $config['digests_user_digest_sortby'],
	                                'user_digest_max_display_words' => ($config['digests_user_digest_max_display_words'] == -1) ? 0 : $config['digests_user_digest_max_display_words'],
	                                'user_digest_reset_lastvisit'   => $config['digests_user_digest_reset_lastvisit'],
	                                'user_digest_filter_type'       => $config['digests_user_digest_filter_type'],
	                                'user_digest_pm_mark_read'      => $config['digests_user_digest_pm_mark_read'],
	                                'user_digest_new_posts_only'    => $config['digests_user_digest_new_posts_only'],
	                                'user_digest_no_post_text'      => ($config['digests_user_digest_max_display_words'] == 0) ? 1 : 0,
	                                'user_digest_attachments'       => $config['digests_user_digest_attachments'],
	                                'user_digest_block_images'      => $config['digests_user_digest_block_images'],
	                                'user_digest_toc'               => $config['digests_user_digest_toc'],
	                            );
	                        }
	 
	                        // Save this subscriber's digest settings
	                        $sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
	                            WHERE user_id = ' . $current_user_id;
	                        $result = $db->sql_query($sql);
	 
	                        // If there are any individual forum subscriptions for this user, remove the old ones. 
	                        $sql = 'DELETE FROM ' . DIGESTS_SUBSCRIBED_FORUMS_TABLE . ' 
	                                WHERE user_id = ' . $current_user_id;
	                        $result = $db->sql_query($sql);
	 
	                        // Now save the individual forum subscriptions, if any
	                        if (isset($sql_ary2) && sizeof($sql_ary2) > 0)
	                        {
	                            foreach($sql_ary2 as $sql_row)
	                            {
	                                $sql = 'INSERT INTO ' . DIGESTS_SUBSCRIBED_FORUMS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_row);
	                                $result = $db->sql_query($sql);
	                            }
	                        }
	 
	                        // With all the data saved for this user, we can set variables needed to process the next user.
	                        $current_user_id = $user_id;
	                        unset($sql_ary, $sql_ary2);
	                        $subscribe_default = false;
	 
	                        // We need to set these variables so we can detect if individual forum subscriptions will need to be processed.
	                        $var = 'user-' . $current_user_id . '-all_forums';
	                        $all_forums = request_var($var, '');
	                        $var = 'user-' . $current_user_id . '-filter_type';
	                        $filter_type = request_var($var, '');
	 
	                    }
	 
	                } // $_POST variable is named user-*
	 
	            } // foreach
	 
	            // Process last user
	            if (isset($sql_ary) && sizeof($sql_ary) > 0)
	            {
	 
	                // Since the $user_id has changed, we need to save the digest settings for this user
	                if ($subscribe_default)
	                {
	                    unset($sql_ary);
	 
	                    // Create a digest subscription using board defaults
	                    $sql_ary = array(
	                        'user_digest_type'              => $config['digests_user_digest_type'],
	                        'user_digest_format'            => $config['digests_user_digest_format'],
	                        'user_digest_show_mine'         => ($config['digests_user_digest_show_mine'] == 1) ? 0 : 1,
	                        'user_digest_send_on_no_posts'  => $config['digests_user_digest_send_on_no_posts'],
	                        'user_digest_send_hour_gmt'     => ($config['digests_user_digest_send_hour_gmt'] == -1) ? rand(0, 23) : $config['digests_user_digest_send_hour_gmt'],
	                        'user_digest_show_pms'          => $config['digests_user_digest_show_pms'],
	                        'user_digest_max_posts'         => $config['digests_user_digest_max_posts'],
	                        'user_digest_min_words'         => $config['digests_user_digest_min_words'],
	                        'user_digest_remove_foes'       => $config['digests_user_digest_remove_foes'],
	                        'user_digest_sortby'            => $config['digests_user_digest_sortby'],
	                        'user_digest_max_display_words' => ($config['digests_user_digest_max_display_words'] == -1) ? 0 : $config['digests_user_digest_max_display_words'],
	                        'user_digest_reset_lastvisit'   => $config['digests_user_digest_reset_lastvisit'],
	                        'user_digest_filter_type'       => $config['digests_user_digest_filter_type'],
	                        'user_digest_pm_mark_read'      => $config['digests_user_digest_pm_mark_read'],
	                        'user_digest_new_posts_only'    => $config['digests_user_digest_new_posts_only'],
	                        'user_digest_no_post_text'      => ($config['digests_user_digest_max_display_words'] == 0) ? 1 : 0,
	                        'user_digest_attachments'       => $config['digests_user_digest_attachments'],
	                        'user_digest_block_images'      => $config['digests_user_digest_block_images'],
	                        'user_digest_toc'               => $config['digests_user_digest_toc'],
	                    );
	                }
	 
	                // Save this subscriber's digest setting
	                $sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
	                    WHERE user_id = ' . $current_user_id;
	                $result = $db->sql_query($sql);
	 
	                // If there are any individual forum subscriptions for this user, remove the old ones. 
	                $sql = 'DELETE FROM ' . DIGESTS_SUBSCRIBED_FORUMS_TABLE . ' 
	                        WHERE user_id = ' . $current_user_id;
	                $result = $db->sql_query($sql);
	 
	                // Now save the individual forum subscriptions, if any
	                if (isset($sql_ary2) && sizeof($sql_ary2) > 0)
	                {
	                    foreach($sql_ary2 as $sql_row)
	                    {
	                        $sql = 'INSERT INTO ' . DIGESTS_SUBSCRIBED_FORUMS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_row);
	                        $result = $db->sql_query($sql);
	                    }
	                }
	 
	            }
	 
	            trigger_error($user->lang['CONFIG_UPDATED'] . $custom_message . adm_back_link($this->u_action));
	 
	        }
	 
	        if ($mode == 'digest_balance_load')
	        {
	 
	        // Get total number of digest subscriptions
	        $sql = "SELECT count(*) AS digests_count
	            FROM " . USERS_TABLE . "
	            WHERE user_digest_type <> '" . DIGEST_NONE_VALUE . "' AND user_type <> " . USER_IGNORE;
	        $result = $db->sql_query($sql);
	        $row = $db->sql_fetchrow($result);
	 
	            // Determine the average number of subscribers per hour. We need to assume at least one subscriber per hour to avoid 
	            // resetting user's preferred digest time unnecessarily. If the average is 3 per hour, the first 3 already subscribed 
	            // will not have their digest arrival time changed.
	 
	            $avg_subscribers_per_hour = max(floor($row['digests_count']/24), 1);
	 
	            $db->sql_freeresult($result);
	 
	            // Get oversubscribed hours, place in an array
	 
	            $sql = 'SELECT user_digest_send_hour_gmt AS hour, count(*) AS hour_count
	                FROM ' . USERS_TABLE . "
	                WHERE user_digest_type <> 'NONE' AND user_type <> " . USER_IGNORE . "
	                GROUP BY user_digest_send_hour_gmt
	                HAVING count(user_digest_send_hour_gmt ) > " . (int) $avg_subscribers_per_hour . "
	                ORDER BY 1";
	 
	            $result = $db->sql_query($sql);
	            $rowset = $db->sql_fetchrowset($result);
	            $oversubscribed_hours = array();
	            foreach ($rowset as $row)
	            {
	                $oversubscribed_hours[] = $row['hour'];
	            }
	            $db->sql_freeresult($result);
	 
	            // Get a list of subscribers whose hour to get digest should be changed because they exceed the average number of subscribers 
	            // allowed in that hour. We will ignore the first $oversubscribed_hours subscribers.
	 
	            $rebalanced = 0;
	            if (sizeof($oversubscribed_hours) > 0)
	            {
	 
	                $sql = 'SELECT user_digest_send_hour_gmt, user_id
	                    FROM ' . USERS_TABLE . "
	                    WHERE user_digest_type <> '" . DIGEST_NONE_VALUE . "' AND user_type <> " . USER_IGNORE . '
	                    AND ' . $db->sql_in_set('user_digest_send_hour_gmt', $oversubscribed_hours) . '
	                    ORDER BY 1, 2';
	                $result = $db->sql_query_limit($sql, 100000, $avg_subscribers_per_hour - 1); // Result sets start with array indexed at zero
	                $rowset = $db->sql_fetchrowset($result);
	 
	                $current_hour = -1;
	                $counted_for_this_hour= 0;
	 
	                // Finally, change the digest send hour for these subscribers to a random hour between 0 and 24.
	                foreach ($rowset as $row)
	                {
	                    if ($current_hour != $row['user_digest_send_hour_gmt'])
	                    {
	                        $current_hour = $row['user_digest_send_hour_gmt'];
	                        $counted_for_this_hour = 0;
	                    }
	                    $counted_for_this_hour++;
	                    if ($counted_for_this_hour > $avg_subscribers_per_hour)
	                    {
	                        // Change this subscription to a random hour to help balance the load
	                        $sql2 = 'UPDATE ' . USERS_TABLE . '
	                            SET user_digest_send_hour_gmt = ' . rand(0, 23) . "
	                            WHERE user_id = " . $row['user_id'];
	                        $result2 = $db->sql_query($sql2);
	                        $rebalanced++;
	                    }
	                }
	 
	                $db->sql_freeresult($result);
	 
	            }
	 
	            trigger_error(sprintf($user->lang['DIGEST_REBALANCED'], $rebalanced) . $custom_message . adm_back_link($this->u_action));
	 
	        }
	 
	        if ($mode == 'digest_mass_subscribe_unsubscribe')
	        {
	 
	            // Did the admin explicitly request a mass subscription or unsubscription action?
	            if ($config['digests_enable_subscribe_unsubscribe'])
	            {
	 
	                // Determine which user types are to be updated
	                $user_types = array(USER_NORMAL);
	                if ($config['digests_include_admins'])
	                {
	                    $user_types[] = USER_FOUNDER;
	                }
	 
	                // If doing a mass subscription, we don't want to mess up digest subscriptions already in place, so we need to create a snippet of SQL.
	                // If doing a mass unsubscribe, all qualified subscriptions are removed. Note however that except for the digest type, all other settings 
	                // are retained.
	                $sql_qualifier = ($config['digests_subscribe_all']) ? " AND user_digest_type = '" . DIGEST_NONE_VALUE . "'": " AND user_digest_type != '" . DIGEST_NONE_VALUE . "'";
	 
	                if ($config['digests_notify_on_mass_subscribe'])
	                {
	 
	                    // Collect the email addresses of those who will be affected to send them an email notification.
	                    $sql2 = 'SELECT username, user_email FROM ' . USERS_TABLE . 
	                        ' WHERE ' . $db->sql_in_set('user_type', $user_types) . $sql_qualifier;
	 
	                    $result2 = $db->sql_query($sql2);
	                    $rowset2 = $db->sql_fetchrowset($result2);
	 
	                    foreach ($rowset2 as $row2)
	                    {
	                        $digest_notify_list[$row2['username']] = $row2['user_email'];
	                    }
	 
	                    $db->sql_freeresult($result2); // Query be gone!
	 
	                }
	 
	                // Set columns in user table to be updated
	                $sql_ary = array(
	                    'user_digest_type'              => ($config['digests_subscribe_all']) ? $config['digests_user_digest_type'] : DIGEST_NONE_VALUE,
	                    'user_digest_format'            => $config['digests_user_digest_format'],
	                    'user_digest_show_mine'         => ($config['digests_user_digest_show_mine'] == 1) ? 0 : 1,
	                    'user_digest_send_on_no_posts'  => $config['digests_user_digest_send_on_no_posts'],
	                    'user_digest_send_hour_gmt'     => ($config['digests_user_digest_send_hour_gmt'] == -1) ? rand(0,23) : $config['digests_user_digest_send_hour_gmt'],
	                    'user_digest_show_pms'          => $config['digests_user_digest_show_pms'],
	                    'user_digest_max_posts'         => $config['digests_user_digest_max_posts'],
	                    'user_digest_min_words'         => $config['digests_user_digest_min_words'],
	                    'user_digest_remove_foes'       => $config['digests_user_digest_remove_foes'],
	                    'user_digest_sortby'            => $config['digests_user_digest_sortby'],
	                    'user_digest_max_display_words' => ($config['digests_user_digest_max_display_words'] == -1) ? 0 : $config['digests_user_digest_max_display_words'],
	                    'user_digest_reset_lastvisit'   => $config['digests_user_digest_reset_lastvisit'],
	                    'user_digest_filter_type'       => $config['digests_user_digest_filter_type'],
	                    'user_digest_pm_mark_read'      => $config['digests_user_digest_pm_mark_read'],
	                    'user_digest_new_posts_only'    => $config['digests_user_digest_new_posts_only'],
	                    'user_digest_no_post_text'      => ($config['digests_user_digest_max_display_words'] == 0) ? 1 : 0,
	                    'user_digest_attachments'       => $config['digests_user_digest_attachments'],
	                    'user_digest_block_images'      => $config['digests_user_digest_block_images'],
	                    'user_digest_toc'               => $config['digests_user_digest_toc'],
	                );
	 
	                $sql2 = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
	                    WHERE " . $db->sql_in_set('user_type', $user_types) . $sql_qualifier;
	 
	                $result2 = $db->sql_query($sql2);
	 
	                $db->sql_freeresult($result2); // Query be gone!
	 
	                // Notify users or subscription or unsubscription if directed
	                if ($config['digests_notify_on_mass_subscribe'])
	                {
	 
	                    if (isset($digest_notify_list))
	                    {
	 
	                        include($phpbb_root_path . 'includes/functions_messenger.' . $phpEx); // Used to send emails
	                        $user->add_lang('mods/ucp_digests');   // Get language file needed
	 
	                        // Set up associations between digest types as constants and their language equivalents
	                        switch ($config['digests_user_digest_type'])
	                        {
	                            case DIGEST_DAILY_VALUE:
	                                $digest_type_text = strtolower($user->lang['DIGEST_DAILY']);
	                                break;
	                            case DIGEST_WEEKLY_VALUE:
	                                $digest_type_text = strtolower($user->lang['DIGEST_WEEKLY']);
	                                break;
	                            case DIGEST_MONTHLY_VALUE:
	                                $digest_type_text = strtolower($user->lang['DIGEST_MONTHLY']);
	                                break;
	                        }
	 
	                        // Set up associations between digest formats as constants and their language equivalents
	                        switch ($config['digests_user_digest_format'])
	                        {
	                            case DIGEST_HTML_VALUE:
	                                $digest_format_text = $user->lang['DIGEST_FORMAT_HTML'];
	                                break;
	                            case DIGEST_HTML_CLASSIC_VALUE:
	                                $digest_format_text = $user->lang['DIGEST_FORMAT_HTML_CLASSIC'];
	                                break;
	                            case DIGEST_PLAIN_VALUE:
	                                $digest_format_text = $user->lang['DIGEST_FORMAT_PLAIN'];
	                                break;
	                            case DIGEST_PLAIN_CLASSIC_VALUE:
	                                $digest_format_text = $user->lang['DIGEST_FORMAT_PLAIN_CLASSIC'];
	                                break;
	                            case DIGEST_TEXT_VALUE:
	                                $digest_format_text = strtolower($user->lang['DIGEST_FORMAT_TEXT']);
	                                break;
	                        }
	 
	                        foreach ($digest_notify_list as $username => $user_email)
	                        {
	 
	                            // E-mail setup
	                            $messenger = new messenger();
	                            $digest_notify_template = ($config['digests_subscribe_all']) ? 'digests_subscribe' : 'digests_unsubscribe';
	                            $digest_email_subject = ($config['digests_subscribe_all']) ? $user->lang['DIGEST_SUBSCRIBE_SUBJECT'] : $user->lang['DIGEST_UNSUBSCRIBE_SUBJECT'];
	                            $messenger->template($digest_notify_template);
	                            $messenger->to($user_email);
	 
	                            // SMTP delivery must strip text names due to likely bug in messenger class
	                            if ($config['smtp_delivery'])
	                            {
	                                $messenger->from($user->data['user_email']);
	                            }
	                            else
	                            {   
	                                $messenger->from($user->data['user_email'] . ' <' . $user->data['username'] . '>');
	                            }
	 
	                            $messenger->replyto($config['board_contact']);
	                            $messenger->subject($digest_email_subject);
	 
	                            $messenger->assign_vars(array(
	                                'DIGEST_FORMAT'         => $digest_format_text,
	                                'DIGEST_TYPE'           => $digest_type_text,
	                                'DIGEST_UCP_LINK'       => generate_board_url() . '/' . 'ucp.' . $phpEx,
	                                'FORUM_NAME'            => $config['sitename'],
	                                'USERNAME'              => $username,
	                                )
	                            );
	 
	                            $mail_sent = $messenger->send(NOTIFY_EMAIL, false, false, true);
	 
	                            if (!$mail_sent)
	                            {
	                                add_log('admin', sprintf($user->lang['LOG_CONFIG_DIGEST_SEND_MASS_EMAIL_ERROR'], $user_email));
	                            }
	                            $messenger->reset();
	 
	                        }
	 
	                    }
	 
	                }
	 
	                if ($config['digests_subscribe_all'])
	                {
	                    trigger_error($user->lang['DIGEST_ALL_SUBSCRIBED'] . $custom_message . adm_back_link($this->u_action));
	                }
	                else
	                {
	                    trigger_error($user->lang['DIGEST_ALL_UNSUBSCRIBED'] . $custom_message . adm_back_link($this->u_action));
	                }
	 
	            }
	            else
	            {
	                // show no update message
	                trigger_error($user->lang['DIGEST_NO_MASS_ACTION'] . $custom_message . adm_back_link($this->u_action));
	            }
	 
	        }
	    // End Digest Mod

		}

		$this->tpl_name = 'acp_board';
		$this->page_title = $display_vars['title'];

		$template->assign_vars(array(
			'L_TITLE'			=> $user->lang[$display_vars['title']],
			'L_TITLE_EXPLAIN'	=> $user->lang[$display_vars['title'] . '_EXPLAIN'],

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),
			// Begin Digest Mod
			'S_BALANCE_LOAD'		=> ($mode == 'digest_balance_load') ? true : false,
			'S_DIGESTS'				=> ($mode == 'digest_general' || $mode == 'digest_user_defaults' || $mode == 'digest_edit_subscribers' || $mode == 'digest_balance_load' || $mode == 'digest_mass_subscribe_unsubscribe') ? true : false,
			'S_EDIT_SUBSCRIBERS'	=> ($mode == 'digest_edit_subscribers') ? true : false,
			'L_DIGEST_VERSION_INFO'	=> isset($digest_version_info) ? $digest_version_info : '',
			// End Digest Mod

			'U_ACTION'			=> $this->u_action)
		);

		// Output relevant page
		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
				);

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}

			$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);

			if (empty($content))
			{
				continue;
			}

			$template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> $content,
				)
			);

			unset($display_vars['vars'][$config_key]);
		}

		if ($mode == 'auth')
		{
			$template->assign_var('S_AUTH', true);

			foreach ($auth_plugins as $method)
			{
				if ($method && file_exists($phpbb_root_path . 'includes/auth/auth_' . $method . '.' . $phpEx))
				{
					$method = 'acp_' . $method;
					if (function_exists($method))
					{
						$fields = $method($this->new_config);

						if ($fields['tpl'])
						{
							$template->assign_block_vars('auth_tpl', array(
								'TPL'	=> $fields['tpl'])
							);
						}
						unset($fields);
					}
				}
			}
		}
	}

	/**
	* Select auth method
	*/
	function build_select($option_ary, $option_default = false)
	{
		global $user;

		$html = '';
		foreach ($option_ary as $value => $title)
		{
			$selected = ($value == $option_default) ? ' selected="selected"' : '';
			$html .= '<option value="' . $value . '"' . $selected . '>' . ((isset($user->lang[$title])) ? $user->lang[$title] : $title) . '</option>';
		}

		return $html;
	}

	/**
	* Select auth method
	*/
	function select_auth_method($selected_method, $key = '')
	{
		global $phpbb_root_path, $phpEx;

		$auth_plugins = array();

		$dp = @opendir($phpbb_root_path . 'includes/auth');

		if (!$dp)
		{
			return '';
		}

		while (($file = readdir($dp)) !== false)
		{
			if (preg_match('#^auth_(.*?)\.' . $phpEx . '$#', $file))
			{
				$auth_plugins[] = preg_replace('#^auth_(.*?)\.' . $phpEx . '$#', '\1', $file);
			}
		}
		closedir($dp);

		sort($auth_plugins);

		$auth_select = '';
		foreach ($auth_plugins as $method)
		{
			$selected = ($selected_method == $method) ? ' selected="selected"' : '';
			$auth_select .= '<option value="' . $method . '"' . $selected . '>' . ucfirst($method) . '</option>';
		}

		return $auth_select;
	}

	/**
	* Select mail authentication method
	*/
	function mail_auth_select($selected_method, $key = '')
	{
		global $user;

		$auth_methods = array('PLAIN', 'LOGIN', 'CRAM-MD5', 'DIGEST-MD5', 'POP-BEFORE-SMTP');
		$s_smtp_auth_options = '';

		foreach ($auth_methods as $method)
		{
			$s_smtp_auth_options .= '<option value="' . $method . '"' . (($selected_method == $method) ? ' selected="selected"' : '') . '>' . $user->lang['SMTP_' . str_replace('-', '_', $method)] . '</option>';
		}

		return $s_smtp_auth_options;
	}

	/**
	* Select full folder action
	*/
	function full_folder_select($value, $key = '')
	{
		global $user;

		return '<option value="1"' . (($value == 1) ? ' selected="selected"' : '') . '>' . $user->lang['DELETE_OLDEST_MESSAGES'] . '</option><option value="2"' . (($value == 2) ? ' selected="selected"' : '') . '>' . $user->lang['HOLD_NEW_MESSAGES_SHORT'] . '</option>';
	}

	/**
	* Select ip validation
	*/
	function select_ip_check($value, $key = '')
	{
		$radio_ary = array(4 => 'ALL', 3 => 'CLASS_C', 2 => 'CLASS_B', 0 => 'NO_IP_VALIDATION');

		return h_radio('config[ip_check]', $radio_ary, $value, $key);
	}

	/**
	* Select referer validation
	*/
	function select_ref_check($value, $key = '')
	{
		$radio_ary = array(REFERER_VALIDATE_PATH => 'REF_PATH', REFERER_VALIDATE_HOST => 'REF_HOST', REFERER_VALIDATE_NONE => 'NO_REF_VALIDATION');

		return h_radio('config[referer_validation]', $radio_ary, $value, $key);
	}

	/**
	* Select account activation method
	*/
	function select_acc_activation($selected_value, $value)
	{
		global $user, $config;

		$act_ary = array(
		  'ACC_DISABLE' => USER_ACTIVATION_DISABLE,
		  'ACC_NONE' => USER_ACTIVATION_NONE,
		);
		if ($config['email_enable'])
		{
			$act_ary['ACC_USER'] = USER_ACTIVATION_SELF;
			$act_ary['ACC_ADMIN'] = USER_ACTIVATION_ADMIN;
		}		
		$act_options = '';

		foreach ($act_ary as $key => $value)
		{
			$selected = ($selected_value == $value) ? ' selected="selected"' : '';
			$act_options .= '<option value="' . $value . '"' . $selected . '>' . $user->lang[$key] . '</option>';
		}

		return $act_options;
	}

	/**
	* Maximum/Minimum username length
	*/
	function username_length($value, $key = '')
	{
		global $user;

		return '<input id="' . $key . '" type="text" size="3" maxlength="3" name="config[min_name_chars]" value="' . $value . '" /> ' . $user->lang['MIN_CHARS'] . '&nbsp;&nbsp;<input type="text" size="3" maxlength="3" name="config[max_name_chars]" value="' . $this->new_config['max_name_chars'] . '" /> ' . $user->lang['MAX_CHARS'];
	}

	/**
	* Allowed chars in usernames
	*/
	function select_username_chars($selected_value, $key)
	{
		global $user;

		$user_char_ary = array('USERNAME_CHARS_ANY', 'USERNAME_ALPHA_ONLY', 'USERNAME_ALPHA_SPACERS', 'USERNAME_LETTER_NUM', 'USERNAME_LETTER_NUM_SPACERS', 'USERNAME_ASCII');
		$user_char_options = '';
		foreach ($user_char_ary as $user_type)
		{
			$selected = ($selected_value == $user_type) ? ' selected="selected"' : '';
			$user_char_options .= '<option value="' . $user_type . '"' . $selected . '>' . $user->lang[$user_type] . '</option>';
		}

		return $user_char_options;
	}

	/**
	* Maximum/Minimum password length
	*/
	function password_length($value, $key)
	{
		global $user;

		return '<input id="' . $key . '" type="text" size="3" maxlength="3" name="config[min_pass_chars]" value="' . $value . '" /> ' . $user->lang['MIN_CHARS'] . '&nbsp;&nbsp;<input type="text" size="3" maxlength="3" name="config[max_pass_chars]" value="' . $this->new_config['max_pass_chars'] . '" /> ' . $user->lang['MAX_CHARS'];
	}

	/**
	* Required chars in passwords
	*/
	function select_password_chars($selected_value, $key)
	{
		global $user;

		$pass_type_ary = array('PASS_TYPE_ANY', 'PASS_TYPE_CASE', 'PASS_TYPE_ALPHA', 'PASS_TYPE_SYMBOL');
		$pass_char_options = '';
		foreach ($pass_type_ary as $pass_type)
		{
			$selected = ($selected_value == $pass_type) ? ' selected="selected"' : '';
			$pass_char_options .= '<option value="' . $pass_type . '"' . $selected . '>' . $user->lang[$pass_type] . '</option>';
		}

		return $pass_char_options;
	}

	/**
	* Select bump interval
	*/
	function bump_interval($value, $key)
	{
		global $user;

		$s_bump_type = '';
		$types = array('m' => 'MINUTES', 'h' => 'HOURS', 'd' => 'DAYS');
		foreach ($types as $type => $lang)
		{
			$selected = ($this->new_config['bump_type'] == $type) ? ' selected="selected"' : '';
			$s_bump_type .= '<option value="' . $type . '"' . $selected . '>' . $user->lang[$lang] . '</option>';
		}

		return '<input id="' . $key . '" type="text" size="3" maxlength="4" name="config[bump_interval]" value="' . $value . '" />&nbsp;<select name="config[bump_type]">' . $s_bump_type . '</select>';
	}

	/**
	* Board disable option and message
	*/
	function board_disable($value, $key)
	{
		global $user;

		$radio_ary = array(1 => 'YES', 0 => 'NO');

		return h_radio('config[board_disable]', $radio_ary, $value) . '<br /><input id="' . $key . '" type="text" name="config[board_disable_msg]" maxlength="255" size="40" value="' . $this->new_config['board_disable_msg'] . '" />';
	}

	/**
	* Global quick reply enable/disable setting and button to enable in all forums
	*/
	function quick_reply($value, $key)
	{
		global $user;

		$radio_ary = array(1 => 'YES', 0 => 'NO');

		return h_radio('config[allow_quick_reply]', $radio_ary, $value) .
			'<br /><br /><input class="button2" type="submit" id="' . $key . '_enable" name="' . $key . '_enable" value="' . $user->lang['ALLOW_QUICK_REPLY_BUTTON'] . '" />';
	}


	/**
	* Select default dateformat
	*/
	function dateformat_select($value, $key)
	{
		global $user, $config;

		// Let the format_date function operate with the acp values
		$old_tz = $user->timezone;
		$old_dst = $user->dst;

		$user->timezone = $config['board_timezone'] * 3600;
		$user->dst = $config['board_dst'] * 3600;

		$dateformat_options = '';

		foreach ($user->lang['dateformats'] as $format => $null)
		{
			$dateformat_options .= '<option value="' . $format . '"' . (($format == $value) ? ' selected="selected"' : '') . '>';
			$dateformat_options .= $user->format_date(time(), $format, false) . ((strpos($format, '|') !== false) ? $user->lang['VARIANT_DATE_SEPARATOR'] . $user->format_date(time(), $format, true) : '');
			$dateformat_options .= '</option>';
		}

		$dateformat_options .= '<option value="custom"';
		if (!isset($user->lang['dateformats'][$value]))
		{
			$dateformat_options .= ' selected="selected"';
		}
		$dateformat_options .= '>' . $user->lang['CUSTOM_DATEFORMAT'] . '</option>';

		// Reset users date options
		$user->timezone = $old_tz;
		$user->dst = $old_dst;

		return "<select name=\"dateoptions\" id=\"dateoptions\" onchange=\"if (this.value == 'custom') { document.getElementById('" . addslashes($key) . "').value = '" . addslashes($value) . "'; } else { document.getElementById('" . addslashes($key) . "').value = this.value; }\">$dateformat_options</select>
		<input type=\"text\" name=\"config[$key]\" id=\"$key\" value=\"$value\" maxlength=\"30\" />";
	}
	// Begin Digest Mod 
	function dow_select($default = '')
	{
		global $config, $user;
		$user->add_lang('mods/ucp_digests');
		
		$dow_options = '';
		$index = 0;
		foreach ($user->lang['DIGEST_WEEKDAY'] as $key => $value)
		{
			$selected = ($index == $config['digests_weekly_digest_day']) ? ' selected="selected"' : '';
			$dow_options .= '<option value="' . $index . '"' . $selected . '>' . $value . '</option>';
			$index++;
		}
		
		return $dow_options;
	}

	function digest_type_select($default = '')
	{
		global $config, $user;
		$user->add_lang('mods/ucp_digests');
		
		$selected = ($config['digests_user_digest_type'] == DIGEST_DAILY_VALUE) ? ' selected="selected"' : '';
		$digest_types = '<option value="' . DIGEST_DAILY_VALUE . '"' . $selected. '>' . $user->lang['DIGEST_DAILY'] . '</option>';
		$selected = ($config['digests_user_digest_type'] == DIGEST_WEEKLY_VALUE) ? ' selected="selected"' : '';
		$digest_types .= '<option value="' . DIGEST_WEEKLY_VALUE . '"' . $selected . '>' . $user->lang['DIGEST_WEEKLY'] . '</option>';
		$selected = ($config['digests_user_digest_type'] == DIGEST_MONTHLY_VALUE) ? ' selected="selected"' : '';
		$digest_types .= '<option value="' . DIGEST_MONTHLY_VALUE . '"' . $selected . '>' . $user->lang['DIGEST_MONTHLY'] . '</option>';
		
		return $digest_types;
	}

	function digest_style_select($default = '')
	{
		global $config, $user;
		$user->add_lang('mods/ucp_digests');
		
		$selected = ($config['digests_user_digest_format'] == DIGEST_HTML_VALUE) ? ' selected="selected"' : '';
		$digest_styles = '<option value="' . DIGEST_HTML_VALUE . '"' . $selected . '>' . $user->lang['DIGEST_FORMAT_HTML'] . '</option>';
		$selected = ($config['digests_user_digest_format'] == DIGEST_HTML_CLASSIC_VALUE) ? ' selected="selected"' : '';
		$digest_styles .= '<option value="' . DIGEST_HTML_CLASSIC_VALUE . '"' . $selected . '>' . $user->lang['DIGEST_FORMAT_HTML_CLASSIC'] . '</option>';
		$selected = ($config['digests_user_digest_format'] == DIGEST_PLAIN_VALUE) ? ' selected="selected"' : '';
		$digest_styles .= '<option value="' . DIGEST_PLAIN_VALUE . '"' . $selected . '>' . $user->lang['DIGEST_FORMAT_PLAIN'] . '</option>';
		$selected = ($config['digests_user_digest_format'] == DIGEST_PLAIN_CLASSIC_VALUE) ? ' selected="selected"' : '';
		$digest_styles .= '<option value="' . DIGEST_PLAIN_CLASSIC_VALUE . '"' . $selected . '>' . $user->lang['DIGEST_FORMAT_PLAIN_CLASSIC'] . '</option>';
		$selected = ($config['digests_user_digest_format'] == DIGEST_TEXT_VALUE) ? ' selected="selected"' : '';
		$digest_styles .= '<option value="' . DIGEST_TEXT_VALUE . '"' . $selected  . '>' . $user->lang['DIGEST_FORMAT_TEXT'] . '</option>';
		
		return $digest_styles;
	} 

	function digest_send_hour_gmt($default = '')
	{
		global $config, $user;
		$user->add_lang('mods/ucp_digests');
		
		$digest_send_hour_gmt = '';
		
		// Populate the Hour Sent select control
		for($i=-1;$i<24;$i++)
		{
			$selected = ($i == $config['digests_user_digest_send_hour_gmt']) ? ' selected="selected"' : '';
			$display_text = ($i == -1) ? $user->lang['DIGEST_RANDOM_HOUR'] : $i;
			$digest_send_hour_gmt .= '<option value="' . $i . '"' . $selected . '>' . $display_text . '</option>';
		}
		
		
		return $digest_send_hour_gmt;
	} 

	function digest_filter_type ($default = '')
	{
		global $config, $user;
		$user->add_lang('mods/ucp_digests');
		
		$selected = ($config['digests_user_digest_filter_type'] == DIGEST_ALL) ? ' selected="selected"' : '';
		$digest_filter_types = '<option value="' . DIGEST_ALL . '"' . $selected. '>' . $user->lang['DIGEST_ALL_FORUMS'] . '</option>';
		$selected = ($config['digests_user_digest_filter_type'] == DIGEST_FIRST) ? ' selected="selected"' : '';
		$digest_filter_types .= '<option value="' . DIGEST_FIRST . '"' . $selected . '>' . $user->lang['DIGEST_POSTS_TYPE_FIRST'] . '</option>';
		$selected = ($config['digests_user_digest_filter_type'] == DIGEST_BOOKMARKS) ? ' selected="selected"' : '';
		$digest_filter_types .= '<option value="' . DIGEST_BOOKMARKS . '"' . $selected. '>' . $user->lang['DIGEST_USE_BOOKMARKS'] . '</option>';
		
		return $digest_filter_types;
	} 

	function digest_post_sort_order ($default = '')
	{
		global $config, $user;
		$user->add_lang('mods/ucp_digests');
		
		$selected = ($config['digests_user_digest_sortby'] == DIGEST_SORTBY_BOARD) ? ' selected="selected"' : '';
		$digest_sort_order = '<option value="' . DIGEST_SORTBY_BOARD . '"' . $selected . '>' . $user->lang['DIGEST_SORT_USER_ORDER'] . '</option>';
		$selected = ($config['digests_user_digest_sortby'] == DIGEST_SORTBY_STANDARD) ? ' selected="selected"' : '';
		$digest_sort_order .= '<option value="' . DIGEST_SORTBY_STANDARD . '"' . $selected .  '>' . $user->lang['DIGEST_SORT_FORUM_TOPIC'] . '</option>';
		$selected = ($config['digests_user_digest_sortby'] == DIGEST_SORTBY_STANDARD_DESC) ? ' selected="selected"' : '';
		$digest_sort_order .= '<option value="' . DIGEST_SORTBY_STANDARD_DESC . '"' . $selected. '>' . $user->lang['DIGEST_SORT_FORUM_TOPIC_DESC'] . '</option>';
		$selected = ($config['digests_user_digest_sortby'] == DIGEST_SORTBY_POSTDATE) ? ' selected="selected"' : '';
		$digest_sort_order .= '<option value="' . DIGEST_SORTBY_POSTDATE . '"' . $selected. '>' . $user->lang['DIGEST_SORT_POST_DATE'] . '</option>';
		$selected = ($config['digests_user_digest_sortby'] == DIGEST_SORTBY_POSTDATE_DESC) ? ' selected="selected"' : '';
		$digest_sort_order .= '<option value="' . DIGEST_SORTBY_POSTDATE_DESC . '"' . $selected. '>' . $user->lang['DIGEST_SORT_POST_DATE_DESC'] . '</option>';
		
		return $digest_sort_order;
	} 
	// End Digest Mod

	/**
	* Select multiple forums
	*/
	function select_news_forums($value, $key)
	{
		global $user, $config;

		$forum_list = make_forum_select(false, false, true, true, true, false, true);

		// Build forum options
		$s_forum_options = '<select id="' . $key . '" name="' . $key . '[]" multiple="multiple">';
		foreach ($forum_list as $f_id => $f_row)
		{
			$f_row['selected'] = phpbb_optionget(FORUM_OPTION_FEED_NEWS, $f_row['forum_options']);

			$s_forum_options .= '<option value="' . $f_id . '"' . (($f_row['selected']) ? ' selected="selected"' : '') . (($f_row['disabled']) ? ' disabled="disabled" class="disabled-option"' : '') . '>' . $f_row['padding'] . $f_row['forum_name'] . '</option>';
		}
		$s_forum_options .= '</select>';

		return $s_forum_options;
	}

	function select_exclude_forums($value, $key)
	{
		global $user, $config;

		$forum_list = make_forum_select(false, false, true, true, true, false, true);

		// Build forum options
		$s_forum_options = '<select id="' . $key . '" name="' . $key . '[]" multiple="multiple">';
		foreach ($forum_list as $f_id => $f_row)
		{
			$f_row['selected'] = phpbb_optionget(FORUM_OPTION_FEED_EXCLUDE, $f_row['forum_options']);

			$s_forum_options .= '<option value="' . $f_id . '"' . (($f_row['selected']) ? ' selected="selected"' : '') . (($f_row['disabled']) ? ' disabled="disabled" class="disabled-option"' : '') . '>' . $f_row['padding'] . $f_row['forum_name'] . '</option>';
		}
		$s_forum_options .= '</select>';

		return $s_forum_options;
	}

	function store_feed_forums($option, $key)
	{
		global $db, $cache;

		// Get key
		$values = request_var($key, array(0 => 0));

		// Empty option bit for all forums
		$sql = 'UPDATE ' . FORUMS_TABLE . '
			SET forum_options = forum_options - ' . (1 << $option) . '
			WHERE ' . $db->sql_bit_and('forum_options', $option, '<> 0');
		$db->sql_query($sql);

		// Already emptied for all...
		if (sizeof($values))
		{
			// Set for selected forums
			$sql = 'UPDATE ' . FORUMS_TABLE . '
				SET forum_options = forum_options + ' . (1 << $option) . '
				WHERE ' . $db->sql_in_set('forum_id', $values);
			$db->sql_query($sql);
		}

		// Empty sql cache for forums table because options changed
		$cache->destroy('sql', FORUMS_TABLE);
	}

	/**
	* Select SameSite cookie setting
	*/
	function samesite_select($value, $key)
	{
		global $user;

		$samesite_options = array(
			0 => 'COOKIE_SAMESITE_NONE',
			1 => 'COOKIE_SAMESITE_LAX',
			2 => 'COOKIE_SAMESITE_STRICT',
		);

		$samesite_select = '';
		foreach ($samesite_options as $option_value => $lang_key)
		{
			$selected = ($value == $option_value) ? ' selected="selected"' : '';
			$samesite_select .= '<option value="' . $option_value . '"' . $selected . '>' . $user->lang[$lang_key] . '</option>';
		}

		return '<select id="' . $key . '" name="config[' . $key . ']">' . $samesite_select . '</select>';
	}

	/**
	* Select cookie consent position
	*/
	function consent_position_select($value, $key)
	{
		global $user;

		$position_options = array(
			0 => 'COOKIE_CONSENT_POSITION_TOP',
			1 => 'COOKIE_CONSENT_POSITION_BOTTOM',
			2 => 'COOKIE_CONSENT_POSITION_CENTER',
		);

		$position_select = '';
		foreach ($position_options as $option_value => $lang_key)
		{
			$selected = ($value == $option_value) ? ' selected="selected"' : '';
			$position_select .= '<option value="' . $option_value . '"' . $selected . '>' . $user->lang[$lang_key] . '</option>';
		}

		return '<select id="' . $key . '" name="config[' . $key . ']">' . $position_select . '</select>';
	}

}

// Begin Digest Mod 
function digests_version()
{
 
    // Check for new version of digests
    global $config, $user;
    $latest_version = get_remote_file($config['digests_host'], '/digests/updatecheck', 'version_phpBB3.txt', $errstr, $errno);
 
    if ($latest_version === false)
    {
        if ($errstr)
        {
            $version_info = '<span style="color:red">' . sprintf($user->lang['DIGEST_CONNECT_SOCKET_ERROR'], $errstr) . '</span>';
        }
        else
        {
            $version_info = '<span>' . $user->lang['DIGEST_SOCKET_FUNCTIONS_DISABLED'] . '</span>';
        }
    }
    else
    {
        $latest_version = str_replace("\n", '.', $latest_version);
        $version_info = version_compare($latest_version, $config['digests_version'], '>');
        if ($version_info)
        {
            $version_info = '<span style="color:red">' . sprintf($user->lang['DIGEST_VERSION_NOT_UP_TO_DATE'], $config['digests_page_url']);
            $version_info .= ' ' . sprintf($user->lang['DIGEST_LATEST_VERSION_INFO'], $latest_version) . ' ' . sprintf($user->lang['DIGEST_CURRENT_VERSION_INFO'], $config['digests_version']) . '</span>';
        }
        else
        {
            $version_info = '<span style="color:green">' . $user->lang['DIGEST_VERSION_UP_TO_DATE'] . '</span>';
        }
    }
 
    return $version_info;
 
}
// End Digest Mod