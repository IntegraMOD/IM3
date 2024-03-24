<?php
/**
*
* @package acp Digests
* @version $Id: acp_digests.php 312 2024-03-22 02:51:12Z Helter $
* @copyright (c) 2024 IntegraMOD
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

/**
* @package acp
*/

class acp_digests
{
	var $u_action;
		
	function main($id, $mode)
	{
		
		global $db, $user, $auth, $template, $cache;
		global $config, $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;
	
		$message ='';
			
		$user->add_lang('acp_cat_digests');
		$this->tpl_name = 'acp_digests';
		$this->page_title = 'ACP_CAT_DIGESTS';

		$form_key = 'acp_digests';
		add_form_key($form_key);		
		$submode = request_var('submode', '');

		switch ($mode)
		{
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
						'digests_show_email'					=> array('lang' => 'DIGEST_SHOW_EMAIL',						'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_enable_log'					=> array('lang' => 'DIGEST_ENABLE_LOG',							'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_enable_auto_subscriptions'		=> array('lang' => 'DIGEST_ENABLE_AUTO_SUBSCRIPTIONS',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_registration_field'			=> array('lang' => 'DIGEST_REGISTRATION_FIELD',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
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
						'digests_user_digest_registration'		=> array('lang' => 'DIGEST_USER_DIGEST_REGISTRATION',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
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
					'title'	=> 'ACP_DIGEST_EDIT_SUBSCRIBERS',
					'vars'	=> array()
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
				$member_sql = ($member <> '') ? " username " . $db->sql_like_expression($db->any_char . $member . $db->any_char) . " AND " : '';

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
					'ALL_SELECTED'				=> $all_selected,
					'ASCENDING_SELECTED'		=> $ascending_selected,
					'DESCENDING_SELECTED'		=> $descending_selected,
					'EMAIL_SELECTED'			=> $email_selected,
					'FORMAT_SELECTED'			=> $format_selected,
					'FREQUENCY_SELECTED'		=> $frequency_selected,
					'HAS_UNSUBSCRIBED_SELECTED'	=> $has_unsubscribed_selected,
					'HOUR_SELECTED'				=> $hour_selected,
					'IMAGE_PATH'				=> $phpbb_root_path . 'adm/images/',
					'LAST_SENT_SELECTED'		=> $last_sent_selected,
					'LASTVISIT_SELECTED'		=> $lastvisit_selected,
					'L_CONTEXT'					=> $context,
					'L_DIGEST_HOUR_SENT'		=> sprintf($user->lang['DIGEST_HOUR_SENT'], $config['digests_time_zone']),
					'L_DIGEST_HTML_VALUE'			=> DIGEST_HTML_VALUE,
					'L_DIGEST_HTML_CLASSIC_VALUE'	=> DIGEST_HTML_CLASSIC_VALUE,
					'L_DIGEST_PLAIN_VALUE'			=> DIGEST_PLAIN_VALUE,
					'L_DIGEST_PLAIN_CLASSIC_VALUE'	=> DIGEST_PLAIN_CLASSIC_VALUE,	
					'L_DIGEST_FORMAT_TEXT_VALUE'	=> DIGEST_TEXT_VALUE,
					'MEMBER'					=> $member,
					'PAGE_NUMBER'       		=> $current_page,
					'PAGINATION'        		=> $total_pages_string,
					'STOPPED_SUBSCRIBING_SELECTED'	=> $stopped_subscribing,
					'SUBSCRIBE_SELECTED'		=> $subscribe_selected,
					'TOTAL_USERS'       		=> ($total_users == 1) ? $user->lang['DIGEST_LIST_USER'] : sprintf($user->lang['DIGEST_LIST_USERS'], $total_users),
					'UNSUBSCRIBE_SELECTED'		=> $unsubscribe_selected,
					'USERNAME_SELECTED'			=> $username_selected,
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
					$send_hour_board = str_replace('.',':', floor($row['user_digest_send_hour_gmt']) + $config['digests_time_zone']);
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
					$db->sql_freeresult();

					$all_by_default = (sizeof($subscribed_forums) == 0) ? true : false;
					
					$template->assign_block_vars('digest_edit_subscribers', array(
						'1ST'								=> ($row['user_digest_filter_type'] == DIGEST_FIRST),
						'ALL'								=> ($row['user_digest_filter_type'] == DIGEST_ALL),
						'BM'								=> ($row['user_digest_filter_type'] == DIGEST_BOOKMARKS),
						'BOARD_TO_GMT_0'					=> $board_to_gmt[0],
						'BOARD_TO_GMT_1'					=> $board_to_gmt[1],
						'BOARD_TO_GMT_2'					=> $board_to_gmt[2],
						'BOARD_TO_GMT_3'					=> $board_to_gmt[3],
						'BOARD_TO_GMT_4'					=> $board_to_gmt[4],
						'BOARD_TO_GMT_5'					=> $board_to_gmt[5],
						'BOARD_TO_GMT_6'					=> $board_to_gmt[6],
						'BOARD_TO_GMT_7'					=> $board_to_gmt[7],
						'BOARD_TO_GMT_8'					=> $board_to_gmt[8],
						'BOARD_TO_GMT_9'					=> $board_to_gmt[9],
						'BOARD_TO_GMT_10'					=> $board_to_gmt[10],
						'BOARD_TO_GMT_11'					=> $board_to_gmt[11],
						'BOARD_TO_GMT_12'					=> $board_to_gmt[12],
						'BOARD_TO_GMT_13'					=> $board_to_gmt[13],
						'BOARD_TO_GMT_14'					=> $board_to_gmt[14],
						'BOARD_TO_GMT_15'					=> $board_to_gmt[15],
						'BOARD_TO_GMT_16'					=> $board_to_gmt[16],
						'BOARD_TO_GMT_17'					=> $board_to_gmt[17],
						'BOARD_TO_GMT_18'					=> $board_to_gmt[18],
						'BOARD_TO_GMT_19'					=> $board_to_gmt[19],
						'BOARD_TO_GMT_20'					=> $board_to_gmt[20],
						'BOARD_TO_GMT_21'					=> $board_to_gmt[21],
						'BOARD_TO_GMT_22'					=> $board_to_gmt[22],
						'BOARD_TO_GMT_23'					=> $board_to_gmt[23],
						'DIGEST_MAX_SIZE' 					=> $row['user_digest_max_display_words'],
						'L_DIGEST_CHANGE_SUBSCRIPTION' 		=> ($row['user_digest_type'] != 'NONE') ? $user->lang['DIGEST_UNSUBSCRIBE'] : $user->lang['DIGEST_SUBSCRIBE_LITERAL'],
						'S_ALL_BY_DEFAULT'					=> $all_by_default,
						'S_ATTACHMENTS_NO_CHECKED' 			=> ($row['user_digest_attachments'] == 0),
						'S_ATTACHMENTS_YES_CHECKED' 		=> ($row['user_digest_attachments'] == 1),
						'S_BLOCK_IMAGES_NO_CHECKED' 		=> ($row['user_digest_block_images'] == 0),
						'S_BLOCK_IMAGES_YES_CHECKED' 		=> ($row['user_digest_block_images'] == 1),
						'S_BOARD_SELECTED' 					=> ($row['user_digest_sortby'] == DIGEST_SORTBY_BOARD),
						'S_DIGEST_FILTER_FOES_CHECKED_NO' 	=> ($row['user_digest_remove_foes'] == 0),
						'S_DIGEST_FILTER_FOES_CHECKED_YES' 	=> ($row['user_digest_remove_foes'] == 1),
						'S_DIGEST_DAY_CHECKED' 				=> ($row['user_digest_type'] == DIGEST_DAILY_VALUE),
						'S_DIGEST_HTML_CHECKED' 			=> ($row['user_digest_format'] == DIGEST_HTML_VALUE),
						'S_DIGEST_HTML_CLASSIC_CHECKED' 	=> ($row['user_digest_format'] == DIGEST_HTML_CLASSIC_VALUE),
						'S_DIGEST_MONTH_CHECKED' 			=> ($row['user_digest_type'] == DIGEST_MONTHLY_VALUE),
						'S_DIGEST_NEW_POSTS_ONLY_CHECKED_NO' 	=> ($row['user_digest_new_posts_only'] == 0),
						'S_DIGEST_NEW_POSTS_ONLY_CHECKED_YES' 	=> ($row['user_digest_new_posts_only'] == 1),
						'S_DIGEST_NONE_CHECKED' 			=> ($row['user_digest_type'] == DIGEST_NONE_VALUE),
						'S_DIGEST_NO_POST_TEXT_CHECKED_NO' 	=> ($row['user_digest_no_post_text'] == 0),
						'S_DIGEST_NO_POST_TEXT_CHECKED_YES' => ($row['user_digest_no_post_text'] == 1),
						'S_DIGEST_PLAIN_CHECKED' 			=> ($row['user_digest_format'] == DIGEST_PLAIN_VALUE),
						'S_DIGEST_PLAIN_CLASSIC_CHECKED' 	=> ($row['user_digest_format'] == DIGEST_PLAIN_CLASSIC_VALUE),
						'S_DIGEST_PM_MARK_READ_CHECKED_NO' 	=> ($row['user_digest_pm_mark_read'] == 0),
						'S_DIGEST_PM_MARK_READ_CHECKED_YES' => ($row['user_digest_pm_mark_read'] == 1),
						'S_DIGEST_POST_ANY'					=> ($row['user_digest_filter_type'] == DIGEST_ALL),
						'S_DIGEST_POST_BM'					=> ($row['user_digest_filter_type'] == DIGEST_BOOKMARKS),
						'S_DIGEST_POST_FIRST'				=> ($row['user_digest_filter_type'] == DIGEST_FIRST),
						'S_DIGEST_PRIVATE_MESSAGES_IN_DIGEST_NO' 	=> ($row['user_digest_show_pms'] == 0),
						'S_DIGEST_PRIVATE_MESSAGES_IN_DIGEST_YES' 	=> ($row['user_digest_show_pms'] == 1),
						'S_DIGEST_SEND_HOUR_0_CHECKED'		=> ($send_hour_board == 0),
						'S_DIGEST_SEND_HOUR_1_CHECKED'		=> ($send_hour_board == 1),
						'S_DIGEST_SEND_HOUR_2_CHECKED'		=> ($send_hour_board == 2),
						'S_DIGEST_SEND_HOUR_3_CHECKED'		=> ($send_hour_board == 3),
						'S_DIGEST_SEND_HOUR_4_CHECKED'		=> ($send_hour_board == 4),
						'S_DIGEST_SEND_HOUR_5_CHECKED'		=> ($send_hour_board == 5),
						'S_DIGEST_SEND_HOUR_6_CHECKED'		=> ($send_hour_board == 6),
						'S_DIGEST_SEND_HOUR_7_CHECKED'		=> ($send_hour_board == 7),
						'S_DIGEST_SEND_HOUR_8_CHECKED'		=> ($send_hour_board == 8),
						'S_DIGEST_SEND_HOUR_9_CHECKED'		=> ($send_hour_board == 9),
						'S_DIGEST_SEND_HOUR_10_CHECKED'		=> ($send_hour_board == 10),
						'S_DIGEST_SEND_HOUR_11_CHECKED'		=> ($send_hour_board == 11),
						'S_DIGEST_SEND_HOUR_12_CHECKED'		=> ($send_hour_board == 12),
						'S_DIGEST_SEND_HOUR_13_CHECKED'		=> ($send_hour_board == 13),
						'S_DIGEST_SEND_HOUR_14_CHECKED'		=> ($send_hour_board == 14),
						'S_DIGEST_SEND_HOUR_15_CHECKED'		=> ($send_hour_board == 15),
						'S_DIGEST_SEND_HOUR_16_CHECKED'		=> ($send_hour_board == 16),
						'S_DIGEST_SEND_HOUR_17_CHECKED'		=> ($send_hour_board == 17),
						'S_DIGEST_SEND_HOUR_18_CHECKED'		=> ($send_hour_board == 18),
						'S_DIGEST_SEND_HOUR_19_CHECKED'		=> ($send_hour_board == 19),
						'S_DIGEST_SEND_HOUR_20_CHECKED'		=> ($send_hour_board == 20),
						'S_DIGEST_SEND_HOUR_21_CHECKED'		=> ($send_hour_board == 21),
						'S_DIGEST_SEND_HOUR_22_CHECKED'		=> ($send_hour_board == 22),
						'S_DIGEST_SEND_HOUR_23_CHECKED'		=> ($send_hour_board == 23),
						'S_DIGEST_SEND_ON_NO_POSTS_NO_CHECKED' 	=> ($row['user_digest_send_on_no_posts'] == 0),
						'S_DIGEST_SEND_ON_NO_POSTS_YES_CHECKED' => ($row['user_digest_send_on_no_posts'] == 1),
						'S_DIGEST_SHOW_MINE_CHECKED_YES' 	=> ($row['user_digest_show_mine'] == 1),
						'S_DIGEST_SHOW_MINE_CHECKED_NO' 	=> ($row['user_digest_show_mine'] == 0),
						'S_DIGEST_TEXT_CHECKED' 			=> ($row['user_digest_format'] == DIGEST_TEXT_VALUE),
						'S_DIGEST_WEEK_CHECKED' 			=> ($row['user_digest_type'] == DIGEST_WEEKLY_VALUE),
						'S_DIGEST_PRIVATE_MESSAGES_IN_DIGEST_NO' 	=> ($user->data['user_digest_show_pms'] == 0),
						'S_LASTVISIT_NO_CHECKED' 			=> ($row['user_digest_reset_lastvisit'] == 0),
						'S_LASTVISIT_YES_CHECKED' 			=> ($row['user_digest_reset_lastvisit'] == 1),
						'S_POSTDATE_DESC_SELECTED' 			=> ($row['user_digest_sortby'] == DIGEST_SORTBY_POSTDATE_DESC),
						'S_POSTDATE_SELECTED' 				=> ($row['user_digest_sortby'] == DIGEST_SORTBY_POSTDATE),
						'S_STANDARD_DESC_SELECTED' 			=> ($row['user_digest_sortby'] == DIGEST_SORTBY_STANDARD_DESC),
						'S_STANDARD_SELECTED' 				=> ($row['user_digest_sortby'] == DIGEST_SORTBY_STANDARD),
						'S_TOC_NO_CHECKED' 					=> ($row['user_digest_toc'] == 0),
						'S_TOC_YES_CHECKED' 				=> ($row['user_digest_toc'] == 1),
						'USERNAME'							=> $row['username'],
						'USER_DIGEST_FORMAT'				=> $digest_format,
						'USER_DIGEST_HAS_UNSUBSCRIBED'		=> ($row['user_digest_has_unsubscribed']) ? 'x' : '-',
						'USER_DIGEST_LAST_SENT'				=> ($row['user_digest_last_sent'] == 0) ? $user->lang['DIGEST_NO_DIGESTS_SENT'] : date($config['default_dateformat'], $row['user_digest_last_sent'] + (3600 * $config['digests_time_zone'])),
						'USER_DIGEST_MAX_POSTS'				=> $row['user_digest_max_posts'],
						'USER_DIGEST_MIN_WORDS'				=> $row['user_digest_min_words'],
						'USER_DIGEST_TYPE'					=> $digest_type,
						'USER_EMAIL'						=> $row['user_email'],
						'USER_ID'							=> $row['user_id'],
						'USER_LAST_VISIT'					=> ($row['user_lastvisit'] == 0) ? $user->lang['DIGEST_NEVER_VISITED'] : date($config['default_dateformat'], $row['user_lastvisit'] + (3600 * $config['digests_time_zone'])),
						'USER_SUBSCRIBE_UNSUBSCRIBE_FLAG'	=> ($row['user_digest_type'] != 'NONE') ? 'u' : 's')
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
						
						$current_level = 0;			// How deeply nested are we at the moment
						$parent_stack = array();	// Holds a stack showing the current parent_id of the forum
						$parent_stack[] = 0;		// 0, the first value in the stack, represents the <div_0> element, a container holding all the categories and forums in the template
						
						while ($row2 = $db->sql_fetchrow($result2))
						{
							if ((int) $row2['parent_id'] != (int) end($parent_stack) || (end($parent_stack) == 0))
							{
								if (in_array($row2['parent_id'],$parent_stack))
								{
									// If parent is in the stack, then pop the stack until the parent is found, otherwise push stack adding the current parent. This creates a </div>
									while ((int) $row2['parent_id'] != (int) end($parent_stack))
									{
										array_pop($parent_stack);
										$current_level--;
										// Need to close a category level here
										$template->assign_block_vars('digest_edit_subscribers.forums', array( 
											'S_DIV_CLOSE' 	=> true,
											'S_DIV_OPEN' 	=> false,
											'S_PRINT' 		=> false,
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
										'CAT_ID' 			=> 'div_' . $row2['parent_id'],
										'S_DIV_CLOSE' 		=> false,
										'S_DIV_OPEN' 		=> true,
										'S_PRINT' 			=> false,
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
								'FORUM_LABEL' 			=> $row2['forum_name'],
								'FORUM_NAME' 			=> 'elt_' . (int) $row2['forum_id'] . '_' . (int) $row2['parent_id'],
								'S_FORUM_SUBSCRIBED' 	=> $check,
								'S_IS_FORUM' 			=> !($row2['forum_type'] == FORUM_CAT),
								'S_PRINT' 				=> true,
								)
							);
							
						}
					
						$db->sql_freeresult($result2);
					
						// Now out of the loop, it is important to remember to close any open <div> tags. Typically there is at least one.
						while ((int) $row2['parent_id'] != (int) end($parent_stack))
						{
							array_pop($parent_stack);
							$current_level--;
							// Need to close the <div> tag
							$template->assign_block_vars('digest_edit_subscribers.forums', array( 
								'S_DIV_CLOSE' 	=> true,
								'S_DIV_OPEN' 	=> false,
								'S_PRINT' 		=> false,
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
					'title'	=> 'ACP_DIGEST_BALANCE_LOAD',
					'vars'	=> array(
						'legend1'								=> '',
					)
				);

				// Translate time zone information
				$template->assign_vars(array(
					'L_DIGEST_HOUR_SENT'               			=> sprintf($user->lang['DIGEST_HOUR_SENT'], $config['digests_time_zone']),
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
					if (isset($rowset))
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
					'title'	=> 'ACP_DIGEST_MASS_SUBSCRIBE_UNSUBSCRIBE',
					'vars'	=> array(
						'legend1'								=> '',
						'digests_enable_subscribe_unsubscribe'	=> array('lang' => 'DIGEST_ENABLE_SUBSCRIBE_UNSUBSCRIBE',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_subscribe_all'					=> array('lang' => 'DIGEST_SUBSCRIBE_ALL',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_include_admins'				=> array('lang' => 'DIGEST_INCLUDE_ADMINS',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'digests_notify_on_mass_subscribe'		=> array('lang' => 'DIGEST_NOTIFY_ON_MASS_SUBSCRIBE',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
				)
				);
			break;
				
			// phpBB Digest MOD - Addition end -------------------------------------------------------------

		}		
		$action = request_var('action', '');
		$mode	= request_var('mode', '');	
		
		$submit = (isset($_POST['submit'])) ? true : false;

		$forum_id	= request_var('f', 0);		
		$forum_data = $errors = array();
		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			$mode = '';
			trigger_error($user->lang['FORM_INVALID']);
		}		
	}				
}
