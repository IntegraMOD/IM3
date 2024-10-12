<?php
/**
*
* @package acp_user_details
* @version 1.0.0
* @copyright (c) 2008 david63
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
class acp_user_details
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $db, $user, $template, $phpbb_root_path, $phpEx;

		$action = request_var('action', '');
		$mode = (!empty($_POST['display'])) ? 'display' : 'select';	
		$mode = ($action == '') ? $mode : $action;

		$this->tpl_name		= 'acp_user_details';
		$this->page_title	= 'ACP_USER_DETAILS';

		define('ONE_COL',	1);
		define('TWO_COL',	2);
		define('THREE_COL',	3);
		define('FOUR_COL',	4);

		// Define some arrays that we need
		// The main data array
		$select_ary = array(
			array('id' => 'user_id', 'attribute' => $user->lang['USER_ID'], 'explain' => $user->lang['USER_ID_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u1', 'filter' => false, 'save_id' => 's1'),
			array('id' => 'user_type', 'attribute' => $user->lang['USER_TYPE'], 'explain' => $user->lang['USER_TYPE_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u2', 'filter' => false, 'save_id' => 's2'),
			array('id' => 'group_id', 'attribute' => $user->lang['USER_GROUP'], 'explain' => $user->lang['USER_GROUP_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u36', 'filter' => false, 'save_id' => 's36'),
			array('id' => 'user_ip', 'attribute' => $user->lang['USER_IP'], 'explain' => $user->lang['USER_IP_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u3', 'filter' => false, 'save_id' => 's3'),
			array('id' => 'user_regdate', 'attribute' => $user->lang['USER_REGDATE'], 'explain' => $user->lang['USER_REGDATE_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u4', 'filter' => false, 'save_id' => 's4'),
			array('id' => 'user_passchg', 'attribute' => $user->lang['USER_PASS_CHANGE'], 'explain' => $user->lang['USER_PASS_CHANGE_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u33', 'filter' => false, 'save_id' => 's33'),
			array('id' => 'user_email', 'attribute' => $user->lang['USER_EMAIL'], 'explain' => $user->lang['USER_EMAIL_EXPLAIN'], 'size' => FOUR_COL, 'sort_key' => 'u5', 'filter' => true, 'save_id' => 's5'),
			array('id' => 'user_birthday', 'attribute' => $user->lang['USER_BIRTHDAY'], 'explain' => $user->lang['USER_BIRTHDAY_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u6', 'filter' => false, 'save_id' => 's6'),
			array('id' => 'user_lastvisit', 'attribute' => $user->lang['USER_LASTVISIT'], 'explain' => $user->lang['USER_LASTVISIT_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u7', 'filter' => false, 'save_id' => 's7'),
			array('id' => 'user_lastmark', 'attribute' => $user->lang['USER_LASTMARK'], 'explain' => $user->lang['USER_LASTMARK_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u8', 'filter' => false, 'save_id' => 's8'),
			array('id' => 'user_lastpost_time', 'attribute' => $user->lang['USER_LASTPOST_TIME'], 'explain' => $user->lang['USER_LASTPOST_TIME_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u9', 'filter' => false, 'save_id' => 's9'),
			array('id' => 'user_lastpage', 'attribute' => $user->lang['USER_LAST_PAGE'], 'explain' => $user->lang['USER_LAST_PAGE_EXPLAIN'], 'size' => FOUR_COL, 'sort_key' => 'u34', 'filter' => false, 'save_id' => 's34'),
			array('id' => 'user_last_search', 'attribute' => $user->lang['USER_LAST_SEARCH'], 'explain' => $user->lang['USER_LAST_SEARCH_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u35', 'filter' => false, 'save_id' => 's35'),
			array('id' => 'user_warnings', 'attribute' => $user->lang['USER_WARNINGS'], 'explain' => $user->lang['USER_WARNINGS_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u10', 'filter' => false, 'save_id' => 's10'),
			array('id' => 'user_last_warning', 'attribute' => $user->lang['USER_LAST_WARNING'], 'explain' => $user->lang['USER_LAST_WARNING_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u11', 'filter' => false, 'save_id' => 's11'),
			array('id' => 'user_login_attempts', 'attribute' => $user->lang['USER_LOGIN_ATTEMPTS'], 'explain' => $user->lang['USER_LOGIN_ATTEMPTS_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u12', 'filter' => false, 'save_id' => 's12'),		
			array('id' => 'user_inactive_reason', 'attribute' => $user->lang['USER_INACTIVE_REASON'], 'explain' => $user->lang['USER_INACTIVE_REASON_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u36', 'filter' => false, 'save_id' => 's36'),
			array('id' => 'user_inactive_time', 'attribute' => $user->lang['USER_INACTIVE_TIME'], 'explain' => $user->lang['USER_INACTIVE_TIME_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u37', 'filter' => false, 'save_id' => 's37'),
			array('id' => 'user_posts', 'attribute' => $user->lang['USER_POSTS'], 'explain' => $user->lang['USER_POSTS_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u13', 'filter' => false, 'save_id' => 's13'),
			array('id' => 'user_lang', 'attribute' => $user->lang['USER_LANG'], 'explain' => $user->lang['USER_LANG_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u14', 'filter' => true, 'save_id' => 's14'),
			array('id' => 'user_timezone', 'attribute' => $user->lang['USER_TIMEZONE'], 'explain' => $user->lang['USER_TIMEZONE_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u15', 'filter' => false, 'save_id' => 's15'),
			array('id' => 'user_dst', 'attribute' => $user->lang['USER_DST'], 'explain' => $user->lang['USER_DST_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u16', 'filter' => false, 'save_id' => 's16'),
			array('id' => 'user_dateformat', 'attribute' => $user->lang['USER_DATE_FORMAT'], 'explain' => $user->lang['USER_DATE_FORMAT_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u47', 'filter' => false, 'save_id' => 's47'),
			array('id' => 'user_style', 'attribute' => $user->lang['USER_STYLE'], 'explain' => $user->lang['USER_STYLE_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u17', 'filter' => true, 'save_id' => 's17'),
			array('id' => 'user_rank', 'attribute' => $user->lang['USER_RANK'], 'explain' => $user->lang['USER_RANK_EXPLAIN'], 'size' => TWO_COL, 'filter' => false, 'save_id' => 's18'),
			array('id' => 'user_new_privmsg', 'attribute' => $user->lang['USER_NEW_PRIVMSG'], 'explain' => $user->lang['USER_NEW_PRIVMSG_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u38', 'filter' => true, 'save_id' => 's38'),
			array('id' => 'user_unread_privmsg', 'attribute' => $user->lang['USER_UNREAD_PRIVMSG'], 'explain' => $user->lang['USER_UNREAD_PRIVMSG_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u39', 'filter' => true, 'save_id' => 's39'),
			array('id' => 'user_last_privmsg', 'attribute' => $user->lang['USER_LAST_PRIVMSG'], 'explain' => $user->lang['USER_LAST_PRIVMSG_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u40', 'filter' => true, 'save_id' => 's40'),
			array('id' => 'user_emailtime', 'attribute' => $user->lang['USER_EMAILTIME'], 'explain' => $user->lang['USER_EMAILTIME_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u41', 'filter' => true, 'save_id' => 's41'),
			array('id' => 'user_notify', 'attribute' => $user->lang['USER_NOTIFY'], 'explain' => $user->lang['USER_NOTIFY_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u19', 'filter' => false, 'save_id' => 's19'),
			array('id' => 'user_notify_pm', 'attribute' => $user->lang['USER_NOTIFY_PM'], 'explain' => $user->lang['USER_NOTIFY_PM_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u20', 'filter' => false, 'save_id' => 's20'),
			array('id' => 'user_notify_type', 'attribute' => $user->lang['USER_NOTIFY_TYPE'], 'explain' => $user->lang['USER_NOTIFY_TYPE_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u21', 'filter' => false, 'save_id' => 's21'),
			array('id' => 'user_allow_pm', 'attribute' => $user->lang['USER_ALLOW_PM'], 'explain' => $user->lang['USER_ALLOW_PM_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u42', 'filter' => false, 'save_id' => 's42'),
			array('id' => 'user_allow_viewonline', 'attribute' => $user->lang['USER_ALLOW_VIEWONLINE'], 'explain' => $user->lang['USER_ALLOW_VIEWONLINE_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u43', 'filter' => false, 'save_id' => 's43'),
			array('id' => 'user_allow_viewemail', 'attribute' => $user->lang['USER_ALLOW_VIEWEMAIL'], 'explain' => $user->lang['USER_ALLOW_VIEWEMAIL_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u44', 'filter' => false, 'save_id' => 's44'),
			array('id' => 'user_allow_massemail', 'attribute' => $user->lang['USER_ALLOW_MASSEMAIL'], 'explain' => $user->lang['USER_ALLOW_MASSEMAIL_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u45', 'filter' => false, 'save_id' => 's45'),
			array('id' => 'user_avatar', 'attribute' => $user->lang['USER_AVATAR'], 'explain' => $user->lang['USER_AVATAR_EXPLAIN'], 'size' => FOUR_COL, 'sort_key' => 'u22', 'filter' => false, 'save_id' => 's22'),
			array('id' => 'user_avatar_type', 'attribute' => $user->lang['USER_AVATAR_TYPE'], 'explain' => $user->lang['USER_AVATAR_TYPE_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u46', 'filter' => false, 'save_id' => 's46'),
			array('id' => 'user_sig', 'attribute' => $user->lang['USER_SIG'], 'explain' => $user->lang['USER_SIG_EXPLAIN'], 'size' => FOUR_COL, 'sort_key' => 'u23', 'filter' => false, 'save_id' => 's23'),
			array('id' => 'user_from', 'attribute' => $user->lang['USER_FROM'], 'explain' => $user->lang['USER_FROM_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u24', 'filter' => true, 'save_id' => 's24'),
			array('id' => 'user_icq', 'attribute' => $user->lang['USER_ICQ'], 'explain' => $user->lang['USER_ICQ_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u25', 'filter' => true, 'save_id' => 's25'),
			array('id' => 'user_aim', 'attribute' => $user->lang['USER_AIM'], 'explain' => $user->lang['USER_AIM_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u26', 'filter' => true, 'save_id' => 's26'),
			array('id' => 'user_yim', 'attribute' => $user->lang['USER_YIM'], 'explain' => $user->lang['USER_YIM_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u27', 'filter' => true, 'save_id' => 's27'),
			array('id' => 'user_msnm', 'attribute' => $user->lang['USER_MSNM'], 'explain' => $user->lang['USER_MSNM_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u27', 'filter' => true, 'save_id' => 's28'),
			array('id' => 'user_jabber', 'attribute' => $user->lang['USER_JABBER'], 'explain' => $user->lang['USER_JABBER_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u29', 'filter' => true, 'save_id' => 's29'),
			array('id' => 'user_website', 'attribute' => $user->lang['USER_WEBSITE'], 'explain' => $user->lang['USER_WEBSITE_EXPLAIN'], 'size' => ONE_COL, 'sort_key' => 'u30', 'filter' => false, 'save_id' => 's30'),
			array('id' => 'user_occ', 'attribute' => $user->lang['USER_OCC'], 'explain' => $user->lang['USER_OCC_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u31', 'filter' => true, 'save_id' => 's31'),
			array('id' => 'user_interests', 'attribute' => $user->lang['USER_INTERESTS'], 'explain' => $user->lang['USER_INTERESTS_EXPLAIN'], 'size' => TWO_COL, 'sort_key' => 'u32', 'filter' => true, 'save_id' => 's32'),
			// Next key/save_id = 47
		);

		// Some output arrays
		$user_type_ary = array(
			USER_NORMAL		=> $user->lang['USER_NORMAL'],
			USER_INACTIVE	=> $user->lang['USER_INACTIVE'],
			USER_IGNORE		=> $user->lang['USER_IGNORE'],
			USER_FOUNDER	=> $user->lang['USER_FOUNDER'],
		);

		$notify_type_ary = array(
			NOTIFY_EMAIL	=> $user->lang['EMAIL'],
			NOTIFY_IM		=> $user->lang['JABBER'],
			NOTIFY_BOTH		=> $user->lang['EMAIL_JABBER'],
		);

		$inactive_ary = array(
			INACTIVE_REGISTER	=> $user->lang['INACTIVE_REASON_REGISTER'],
			INACTIVE_PROFILE	=> $user->lang['INACTIVE_REASON_PROFILE'],
			INACTIVE_MANUAL		=> $user->lang['INACTIVE_REASON_MANUAL'],
			INACTIVE_REMIND		=> $user->lang['INACTIVE_REASON_REMIND'],
		);

		$avatar_ary = array(
			AVATAR_UPLOAD	=> $user->lang['AVATAR_UPLOAD'],
			AVATAR_REMOTE	=> $user->lang['AVATAR_REMOTE'],
			AVATAR_GALLERY	=> $user->lang['AVATAR_GALLERY'],
		);

		// Start the processing
		switch ($mode)
		{
			case 'select':
				$save_opts = unserialize($config['user_details_opts']);	
				if (empty($save_opts) || !$config['user_details_save'])
				{
					$save_opts = array();
				}

				foreach ($select_ary as $row)
				{
					$template->assign_block_vars('select_row', array(
						'OPT_SET'			=> in_array($row['save_id'], $save_opts),
						'ID'				=> $row['id'],
						'ATTRIBUTE'			=> $row['attribute'],
						'ATTRIBUTE_EXPLAIN'	=> $row['explain'],
						'SIZE'				=> $row['size'],
						'FILTER'			=> ($row['filter']) ? $user->lang['YES'] : $user->lang['NO'],
					));
				}

				$template->assign_vars(array(
					'USER_DETAILS_EXPLAIN'	=> sprintf($user->lang['USER_DETAILS_SELECT'], $config['user_details_max_cols']),
					'S_INSTALL_CHECK'		=> file_exists($phpbb_root_path . 'install_user_details.' . $phpEx),
					'U_ACTION'				=> $this->u_action,
					'U_DISPLAY'				=> false,
					'U_SELECT'				=> true,
				));
			break;

			case 'display':			
				// Start initial var setup
				$start			= request_var('start', 0);
				$fc				= request_var('fc', '');
				$fb				= request_var('fb', '');
				$sort_key		= request_var('sk', 'u');
				$sd = $sort_dir	= request_var('sd', 'a');
				$disp_ary		= request_var('disp_ary', '');

				// We need to restore the format
				$disp_ary		= str_replace('|', '"', $disp_ary);
				$display_ary	= request_var('mark', array(''));
				$display_ary	= ($disp_ary != '') ? unserialize($disp_ary) : $display_ary;

				if (!sizeof($display_ary))
				{
					trigger_error('NO_ATTRIBUTES_SELECTED');
				}

				// Create some arrays of data that we will need
				$col_count	= 0;
				$headings	= '';
				$sort_ary	= array('u' => $user->lang['SORT_USERNAME']);
				$order_ary	= array('u' => 'u.username_clean');
				$filter_ary	= array('u' => $user->lang['SORT_USERNAME']);
				$save_ary	= array();

				foreach ($display_ary as $rows)
				{
					foreach ($select_ary as $data)
					{
						if ($data['id'] == $rows)
						{
							$col_count = $col_count + $data['size'];
							$headings .= '<th>' . $data['attribute'] . '</th>';
							$save_ary[] = $data['save_id'];
							if (array_key_exists('sort_key', $data))
							{
								$sort_ary[$data['sort_key']] = $data['attribute'];
								$order_ary[$data['sort_key']] = 'u.' . $data['id'];
							}
							if ($data['filter'])
							{
								$filter_ary[$data['sort_key']] = $data['attribute'];
							}
						}
					}
				}

				if ($col_count > $config['user_details_max_cols'])
				{
					trigger_error(sprintf($user->lang['TOO_MANY_ATTRIBUTES'], $col_count, $config['user_details_max_cols']));
				}
			
				$options_too_long = false;
				if ($config['user_details_save'])
				{
					$save_opts = serialize($save_ary);

					// Make sure that we can save this in the config table
					if (strlen($save_opts) > 255)
					{
						$save_opts = '';
						$options_too_long = true;
					}

					set_config('user_details_opts', $save_opts, true);
				}

				if (!function_exists('get_user_avatar'))
				{
					include_once($phpbb_root_path . 'includes/functions_display.' . $phpEx);
				}

				// Sorting & filtering
				$sort_dir	= ($sort_dir == 'd') ? ' DESC' : ' ASC';
				$order_by	= $order_ary[$sort_key] . $sort_dir . ', username_clean ASC';
				$filter_by	= '';

				if ($fc == 'other')
				{
					for ($i = 97; $i < 123; $i++)
					{
						$filter_by .= ' AND ' . $order_ary[$fb] . ' NOT ' . $db->sql_like_expression(chr($i) . $db->any_char);
					}
				}
				else if ($fc)
				{
					$filter_by .= ' AND ' . $order_ary[$fb] . ' ' . $db->sql_like_expression(substr($fc, 0, 1) . $db->any_char);
				}

				$limit_days = array();
				$s_sort_key = $s_limit_days = $s_sort_dir = $u_sort_param = '';
				gen_sort_selects($limit_days, $sort_ary, $sort_days, $sort_key, $sd, $s_limit_days, $s_sort_key, $s_sort_dir, $u_sort_param);

				// Create the output
				$sql = 'SELECT u.*, s.style_name, g.group_name
					FROM ' . USERS_TABLE . ' u, ' . STYLES_TABLE . ' s, ' . GROUPS_TABLE . ' g
					WHERE u.user_type <> ' . USER_IGNORE . '
						AND u.user_style = s.style_id
						AND u.group_id = g.group_id' .
					$filter_by . '
					ORDER BY ' . $order_by;
				$result = $db->sql_query_limit($sql, $config['topics_per_page'], $start);

				while ($row = $db->sql_fetchrow($result))
				{						
					get_user_rank($row['user_rank'], $row['user_posts'], $rank_title, $rank_img, $rank_img_src);

					// Create an array so that we can select the items that we need
					$user_vars = array(
						'user_id'				=> '#' . $row['user_id'],
						'user_type'				=> $user_type_ary[$row['user_type']],
						'group_id'				=> $row['group_name'],
						'user_ip'				=> $row['user_ip'],
						'user_regdate'			=> $user->format_date($row['user_regdate']),
						'user_passchg'			=> ($row['user_passchg'] != 0) ? $user->format_date($row['user_passchg'] + ($config['chg_passforce'] * 86400)) : '',
						'user_email'			=> $row['user_email'],
						'user_birthday'			=> get_birthday($row['user_birthday']),
						'user_lastvisit'		=> get_last_visit($row['user_id']),
						'user_lastmark'			=> $user->format_date($row['user_lastmark']),
						'user_lastpost_time'	=> ($row['user_lastpost_time'] != 0) ? $user->format_date($row['user_lastpost_time']) : '',					
						'user_lastpage'			=> '<a href="' .  generate_board_url() . '/' . $row['user_lastpage'] . '">' . $row['user_lastpage'] . '</a>',
						'user_last_search'		=> ($row['user_last_search'] != 0) ? $user->format_date($row['user_last_search']) : '',
						'user_warnings'			=> $row['user_warnings'],
						'user_last_warning'		=> ($row['user_last_warning'] != 0) ? $user->format_date($row['user_last_warning']) : '',
						'user_login_attempts'	=> $row['user_login_attempts'],
						'user_inactive_reason'	=> ($row['user_inactive_reason'] != 0) ? $inactive_ary[$row['user_inactive_reason']] : '',
						'user_inactive_time'	=> ($row['user_inactive_time'] != 0) ? $user->format_date($row['user_inactive_time']) : '',
						'user_posts'			=> $row['user_posts'],
						'user_lang'				=> $row['user_lang'],
						'user_timezone'         => isset($user->lang['tz'][(float) $row['user_timezone']]) ? $user->lang['tz'][(float) $row['user_timezone']] : null,
						'user_dst'				=> ($row['user_dst'] == true) ? $user->lang['YES'] : $user->lang['NO'],
						'user_dateformat'		=> date($row['user_dateformat'], time()),
						'user_style'			=> $row['style_name'],
						'user_rank'				=> $rank_title,
						'user_new_privmsg'		=> ($row['user_new_privmsg'] != 0) ? $row['user_new_privmsg'] : '',
						'user_unread_privmsg'	=> ($row['user_unread_privmsg'] != 0) ? $row['user_unread_privmsg'] : '',
						'user_last_privmsg'		=> ($row['user_last_privmsg'] != 0) ? $user->format_date($row['user_last_privmsg']) : '',
						'user_emailtime'		=> ($row['user_emailtime'] != 0) ? $user->format_date($row['user_emailtime']) : '',
						'user_notify'			=> ($row['user_notify'] == true) ? $user->lang['YES'] : $user->lang['NO'],
						'user_notify_pm'		=> ($row['user_notify_pm'] == true) ? $user->lang['YES'] : $user->lang['NO'],
						'user_notify_type'		=> $notify_type_ary[$row['user_notify_type']],
						'user_allow_pm'			=> ($row['user_allow_pm'] == true) ? $user->lang['YES'] : $user->lang['NO'],
						'user_allow_viewonline'	=> ($row['user_allow_viewonline'] == true) ? $user->lang['YES'] : $user->lang['NO'],
						'user_allow_viewemail'	=> ($row['user_allow_viewemail'] == true) ? $user->lang['YES'] : $user->lang['NO'],
						'user_allow_massemail'	=> ($row['user_allow_massemail'] == true) ? $user->lang['YES'] : $user->lang['NO'],
						'user_avatar'			=> get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height']),
						'user_avatar_type'		=> ($row['user_avatar_type'] != 0) ? $avatar_ary[$row['user_avatar_type']] : '',
						'user_sig'				=> generate_text_for_display($row['user_sig'], $row['user_sig_bbcode_uid'], $row['user_sig_bbcode_bitfield'], 7),
						'user_from'				=> $row['user_from'],
						'user_icq'				=> $row['user_icq'],
						'user_aim'				=> $row['user_aim'],
						'user_yim'				=> $row['user_yim'],
						'user_msnm'				=> $row['user_msnm'],
						'user_jabber'			=> $row['user_jabber'],
						'user_website'			=> $row['user_website'],
						'user_occ'				=> $row['user_occ'],
						'user_interests'		=> $row['user_interests'],
					);

					$output_data = '';
					foreach ($display_ary as $rows)
					{
						foreach ($select_ary as $data)
						{
							if ($data['id'] == $rows)
							{
								$output_data .= '<td>' . $user_vars[$data['id']] . '</td>';
							}
						}
					}

					$template->assign_block_vars('user_data', array(
						'USERNAME'				=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
						'OUTPUT_DATA'			=> $output_data,
					));
				}
				$db->sql_freeresult($result);

				// Count total users for pagination
				$sql = 'SELECT COUNT(u.user_id) AS total_users
					FROM ' . USERS_TABLE . ' u
					WHERE u.user_type <> ' . USER_IGNORE .
					$filter_by;
				$result = $db->sql_query($sql);
				$user_count = (int) $db->sql_fetchfield('total_users');
				$db->sql_freeresult($result); 

				// We have to replace " in this variable because the template system will not parse it!
				$display_ary = str_replace('"', '|', serialize($display_ary));

				$action = $this->u_action . '&amp;sk=' . $sort_key . '&amp;sd=' . $sd . '&amp;fc=' . $fc . '&amp;fb=' . $fb . '&amp;action=display&amp;disp_ary=' . $display_ary;
		
				$template->assign_vars(array(
					'HEADINGS'				=> $headings,
					'PAGINATION'			=> generate_pagination($action, $user_count, $config['posts_per_page'], $start, true),
					'TOTAL_USERS'			=> $user_count,
					'USER_DETAILS_EXPLAIN'	=> $user->lang['USER_DETAILS_DISPLAY'],

					'S_INSTALL_CHECK'		=> file_exists($phpbb_root_path . 'install_user_details.' . $phpEx),
					'S_ON_PAGE'				=> on_page($user_count, $config['posts_per_page'], $start),
					'S_SORT_KEY'			=> $s_sort_key,
					'S_SORT_DIR'			=> $s_sort_dir,
					'S_FILTER_BY'			=> filter_select($fb, $filter_ary),
					'S_FILTER_CHAR'			=> character_select($fc),

					'U_ACTION'				=> $action,
					'U_DISPLAY'				=> true,
					'U_SELECT'				=> false,
					'U_TOO_LONG'			=> $options_too_long,
				));
			break;
		}
	}
}

function get_birthday($birthday)
{
	global $user;

	$month_ary = array(
		'1'  => $user->lang['datetime']['January'],
		'2'  => $user->lang['datetime']['February'],
		'3'  => $user->lang['datetime']['March'],
		'4'  => $user->lang['datetime']['April'],
		'5'  => $user->lang['datetime']['May'],
		'6'  => $user->lang['datetime']['June'],
		'7'  => $user->lang['datetime']['July'],
		'8'  => $user->lang['datetime']['August'],
		'9'  => $user->lang['datetime']['September'],
		'10' => $user->lang['datetime']['October'],
		'11' => $user->lang['datetime']['November'],
		'12' => $user->lang['datetime']['December'],
	);

	$birthday_date = '';

	if (substr($birthday, 2, 1) == '-')
	{
		list($bday_day, $bday_month, $bday_year) = array_map('intval', explode('-', $birthday));

		$now = getdate(time() + $user->timezone + $user->dst - date('Z'));

		$diff = $now['mon'] - $bday_month;
		if ($diff == 0)
		{
			$diff = ($now['mday'] - $bday_day < 0) ? 1 : 0;
		}
		else
		{
			$diff = ($diff < 0) ? 1 : 0;
		}

		$age = (int) ($now['year'] - $bday_year - $diff);

		// Add this check in case there are any strange results
		if ($age < 0 || $age > 120)
		{
			$birthday_date = '';
		}
		else
		{
			$birthday_date = $bday_day . ' ' . $month_ary[$bday_month] . '  ' . $bday_year . ' (' . $age . ')';
		}
	}
	return $birthday_date;
}

function get_last_visit($user_id)
{
	global $db, $config, $user;

	$last_visit = '';

	$sql = 'SELECT session_user_id, MAX(session_time) AS session_time
		FROM ' . SESSIONS_TABLE . '
		WHERE session_time >= ' . (time() - $config['session_length']) . '
			AND ' . $db->sql_in_set('session_user_id', $user_id) . '
		GROUP BY session_user_id';
	$result = $db->sql_query($sql);

	$session_times = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$session_times[$row['session_user_id']] = $row['session_time'];
	}
	$db->sql_freeresult($result);

	$sql = 'SELECT user_lastvisit
		FROM ' . USERS_TABLE . '
		WHERE ' . $db->sql_in_set('user_id', $user_id);
	$result = $db->sql_query($sql);
				
	while ($row = $db->sql_fetchrow($result))
	{	
		$session_time = (!empty($session_times[$user_id])) ? $session_times[$user_id] : 0;
		$last_visit = (!empty($session_time)) ? $session_time : $row['user_lastvisit'];
		$last_visit = $user->format_date($last_visit);
	}
	$db->sql_freeresult($result);

	return $last_visit;
}

function filter_select($default, $options)
{
	$filter_select = '<select name="fb" id="fb">';
	foreach ($options as $key => $text)
	{
		$selected = ($default == $key) ? ' selected="selected"' : '';
		$filter_select .= '<option value="' . $key . '"' . $selected . '>' . $text . '</option>';
	} 
	$filter_select .= '</select>';

	return $filter_select;
}

function character_select($default)
{
	global $user;
	
	$options = array(
		$user->lang['ALL'],
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I',
		'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R',
		'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '#',
	);
	
	$char_select = '<select name="fc" id="fc">';
	for ($i = 0; $i < sizeof($options); $i++) 
	{
		if ($options[$i] == $user->lang['ALL'])
		{
			$value = '';
		}
		else if ($options[$i] == '#')
		{
			$value = 'other';
		}
		else
		{
			$value = strtolower($options[$i]);
		}

		$char_select .= '<option value="' . $value . '"'; 
		if (isset($default) && $default == strtolower($options[$i]))
		{ 
			$char_select .= ' selected'; 
		} 
		$char_select .= '>' . $options[$i] . '</option>'; 
	} 
	$char_select .= '</select>';

	return $char_select;
}

?>