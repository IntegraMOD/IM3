<?php

/**
*
* @mod package		Download Mod 6
* @file				dl_bug_tracker.php 22 2014/03/07 OXPUS
* @copyright		(c) 2005 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/*
* connect to phpBB
*/
if ( !defined('IN_PHPBB') )
{
	exit;
}

/*
* clean up bug tracker for unset categories
* hard stuff to do this, but we must be sure to track downloads only in the choosen categories...
*/
$sql = 'SELECT d.id FROM ' . DL_CAT_TABLE . ' c, ' . DOWNLOADS_TABLE . ' d
	WHERE c.bug_tracker = 0
		AND c.id = d.cat';
$result = $db->sql_query($sql);

$dl_ids = array();

while ($row = $db->sql_fetchrow($result))
{
	$dl_ids[] = $row['id'];
}
$db->sql_freeresult($result);

if (sizeof($dl_ids))
{
	$sql = 'DELETE FROM ' . DL_BUGS_TABLE . '
		WHERE ' . $db->sql_in_set('df_id', $dl_ids);
	$db->sql_query($sql);

	$sql = 'DELETE FROM ' . DL_BUG_HISTORY_TABLE . '
		WHERE ' . $db->sql_in_set('df_id', $dl_ids);
	$db->sql_query($sql);

	unset($dl_ids);
}

/*
* check the current user for mod permissions
*/
if ($user->data['is_registered'] && ($auth->acl_get('a_') || $auth->acl_get('m_')))
{
	$allow_bug_mod = true;
}
else
{
	$allow_bug_mod = false;
}

/*
* check the user permissions for all download categories
*/
$bug_access_cats = array();
$bug_access_cats = dl_main::full_index(0, 0, 0, 1);

$report_title		= utf8_normalize_nfc(request_var('report_title', '', true));
$report_text		= utf8_normalize_nfc(request_var('message', '', true));
$report_file_ver	= utf8_normalize_nfc(request_var('report_file_ver', '', true));
$report_php			= utf8_normalize_nfc(request_var('report_php', '', true));
$report_db			= utf8_normalize_nfc(request_var('report_db', '', true));
$report_forum		= utf8_normalize_nfc(request_var('report_forum', '', true));

$allow_bbcode	= ($config['allow_bbcode']) ? true : false;
$allow_urls		= true;
$allow_smilies	= ($config['allow_smilies']) ? true : false;
$bug_uid		=
$bug_bitfield	= '';
$bug_flags		= 0;

if ($preview && $user->data['is_registered'])
{
	// check form
	if (!check_form_key('posting'))
	{
		trigger_error($user->lang['FORM_INVALID'], E_USER_WARNING);
	}

	if (!$report_title)
	{
		trigger_error($user->lang['DL_BUG_REPORT_NO_TITLE'], E_USER_WARNING);
	}

	if (!$report_text)
	{
		trigger_error($user->lang['DL_BUG_REPORT_NO_TEXT'], E_USER_WARNING);
	}

	$preview_title	= $report_title;
	$preview_text	= $report_text;

	generate_text_for_storage($preview_text, $bug_uid, $bug_bitfield, $bug_flags, $allow_bbcode, $allow_urls, $allow_smilies);
	$preview_text	= generate_text_for_display($preview_text, $bug_uid, $bug_bitfield, $bug_flags);

	$template->assign_var('S_PREVIEW', true);

	$template->assign_vars(array(
		'PREVIEW_TITLE'	=> $preview_title,
		'PREVIEW_TEXT'	=> $preview_text,
	));

	$action = ($fav_id && dl_auth::user_admin()) ? 'edit' : 'add';
}

/*
* save new or edited bug report
*/
if ($action == 'save' && $user->data['is_registered'])
{
	// check form
	if (!check_form_key('posting'))
	{
		trigger_error($user->lang['FORM_INVALID'], E_USER_WARNING);
	}

	if (!$report_title)
	{
		trigger_error($user->lang['DL_BUG_REPORT_NO_TITLE'], E_USER_WARNING);
	}

	if (!$report_text)
	{
		trigger_error($user->lang['DL_BUG_REPORT_NO_TEXT'], E_USER_WARNING);
	}

	generate_text_for_storage($report_text, $bug_uid, $bug_bitfield, $bug_flags, $allow_bbcode, $allow_urls, $allow_smilies);

	if ($fav_id && dl_auth::user_admin())
	{
		$sql = 'UPDATE ' . DL_BUGS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
			'df_id'					=> $df_id,
			'report_title'			=> $report_title,
			'report_text'			=> $report_text,
			'bug_uid'				=> $bug_uid,
			'bug_bitfield'			=> $bug_bitfield,
			'bug_flags'				=> $bug_flags,
			'report_file_ver'		=> $report_file_ver,
			'report_date'			=> time(),
			'report_author_id'		=> $user->data['user_id'],
			'report_status_date'	=> time(),
			'report_php'			=> $report_php,
			'report_db'				=> $report_db,
			'report_forum'			=> $report_forum)) . ' WHERE report_id = ' . (int) $fav_id;
		$db->sql_query($sql);
	}
	else
	{
		$sql = 'INSERT INTO ' . DL_BUGS_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'df_id'					=> $df_id,
			'report_title'			=> $report_title,
			'report_text'			=> $report_text,
			'bug_uid'				=> $bug_uid,
			'bug_bitfield'			=> $bug_bitfield,
			'bug_flags'				=> $bug_flags,
			'report_file_ver'		=> $report_file_ver,
			'report_date'			=> time(),
			'report_author_id'		=> $user->data['user_id'],
			'report_status_date'	=> time(),
			'report_php'			=> $report_php,
			'report_db'				=> $report_db,
			'report_forum'			=> $report_forum));
		$db->sql_query($sql);

		$fav_id = $db->sql_nextid();

		$sql = 'INSERT INTO ' . DL_BUG_HISTORY_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'df_id'				=> $df_id,
			'report_id'			=> $fav_id,
			'report_his_type'	=> 'status',
			'report_his_date'	=>  time(),
			'report_his_value'	=> '0:' . $user->data['username']));
		$db->sql_query($sql);
	}

	$message = $user->lang['DL_BUG_REPORT_ADDED'] . '<br /><br />' . sprintf($user->lang['CLICK_RETURN_BUG_TRACKER'], '<a href="' . append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;df_id=$df_id" . (($fav_id && dl_auth::user_admin()) ? "&amp;action=detail&amp;fav_id=$fav_id" : '')) . '">', '</a>');

	trigger_error($message);
}

/*
* add new status to report
*/
if ($action == 'status' && $fav_id && $allow_bug_mod)
{
	// check form
	if (!check_form_key('bt_status'))
	{
		trigger_error($user->lang['FORM_INVALID'], E_USER_WARNING);
	}

	$new_status			= utf8_normalize_nfc(request_var('new_status', '', true));
	$new_status_text	= utf8_normalize_nfc(request_var('new_status_text', '', true));
	$new_status_text	= str_replace(':', '', $new_status_text);

	$sql = 'SELECT df_id, report_status, report_author_id, report_title FROM ' . DL_BUGS_TABLE . '
		WHERE report_id = ' . (int) $fav_id;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);

	$df_id				= $row['df_id'];
	$report_status		= $row['report_status'];
	$report_author_id	= $row['report_author_id'];
	$report_title		= $row['report_title'];

	$db->sql_freeresult($result);

	$sql = 'INSERT INTO ' . DL_BUG_HISTORY_TABLE . ' ' . $db->sql_build_array('INSERT', array(
		'df_id'				=> $df_id,
		'report_id'			=> $fav_id,
		'report_his_type'	=> 'status',
		'report_his_date'	=> time(),
		'report_his_value'	=> $new_status . ':' . $user->data['username'] . ':' . $new_status_text));
	$db->sql_query($sql);

	$sql = 'UPDATE ' . DL_BUGS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
		'report_status'			=> $new_status,
		'report_status_date'	=> time())) . ' WHERE report_id = ' . (int) $fav_id;
	$db->sql_query($sql);

	// Send email to report author about new status if it will not be the current one
	if ($report_author_id <> $user->data['user_id'])
	{
		$mail_data = array(
			'email_template'	=> 'dl_bt_status',
			'report_author_id'	=> $report_author_id,
			'new_status_text'	=> $new_status_text,
			'report_title'		=> $report_title,
			'report_status'		=> $report_status,
			'fav_id'			=> $fav_id,
		);

		dl_email::send_bt_status($mail_data);
	}

	$action = 'detail';
}

/*
* assign bug report to team member
*/
if ($action == 'assign' && $df_id && $fav_id && $allow_bug_mod)
{
	// check form
	if (!check_form_key('bt_status'))
	{
		trigger_error($user->lang['FORM_INVALID'], E_USER_WARNING);
	}

	$new_user_id = request_var('user_assign', 0);

	if (!$new_user_id)
	{
		trigger_error($user->lang['DL_NO_PERMISSIONS'], E_USER_WARNING);
	}

	$sql = 'SELECT username, user_email, user_lang FROM ' . USERS_TABLE . '
		WHERE user_id = ' . (int) $new_user_id;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);

	$report_assign_user			= $row['username'];
	$report_assign_user_email	= $row['user_email'];
	$report_assign_user_lang	= $row['user_lang'];

	$db->sql_freeresult($result);

	$sql = 'INSERT INTO ' . DL_BUG_HISTORY_TABLE . ' ' . $db->sql_build_array('INSERT', array(
		'df_id'				=> $df_id,
		'report_id'			=> $fav_id,
		'report_his_type'	=> 'assign',
		'report_his_date'	=> time(),
		'report_his_value'	=> $new_user_id . ':' . $report_assign_user));
	$db->sql_query($sql);

	$sql = 'UPDATE ' . DL_BUGS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
		'report_assign_id'		=> $new_user_id,
		'report_assign_date'	=> time())) . ' WHERE report_id = ' . (int) $fav_id;
	$db->sql_query($sql);

	// Send email to new assigned user if it will not be the current one
	if ($new_user_id <> $user->data['user_id'])
	{
		$mail_data = array(
			'email_template'	=> 'dl_bt_assign',
			'user_lang'			=> $report_assign_user_lang,
			'user_mail'			=> $report_assign_user_email,
			'username'			=> $report_assign_user,
			'fav_id'			=> $fav_id,
		);

		dl_email::send_bt_assign($mail_data);
	}

	$action = 'detail';
}

/*
* view current details from bug report
*/
if ($action == 'detail' && $fav_id)
{
	unset($sql_array);

	$sql_array = array(
		'SELECT'	=> 'b.*, d.description AS report_file, u1.username AS report_author, u1.user_colour AS report_colour, u2.username AS report_assign, u2.user_colour AS report_assign_col',
		'FROM'		=> array(DL_BUGS_TABLE => 'b'));

	$sql_array['LEFT_JOIN'] = array();
	$sql_array['LEFT_JOIN'][] = array(
		'FROM'		=> array(DOWNLOADS_TABLE => 'd'),
		'ON'		=> 'b.df_id = d.id');
	$sql_array['LEFT_JOIN'][] = array(
		'FROM'		=> array(USERS_TABLE => 'u1'),
		'ON'		=> 'u1.user_id = b.report_author_id');
	$sql_array['LEFT_JOIN'][] = array(
		'FROM'		=> array(USERS_TABLE => 'u2'),
		'ON'		=> 'u2.user_id = b.report_assign_id');

	$sql_array['WHERE'] = 'b.report_id = ' . (int) $fav_id . ' AND ' . $db->sql_in_set('d.cat', $bug_access_cats);

	$sql = $db->sql_build_query('SELECT', $sql_array);
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);

	$report_id			= $fav_id;
	$report_file_id		= $row['df_id'];
	$report_file		= $row['report_file'];
	$report_title		= $row['report_title'];
	$report_text		= $row['report_text'];
	$bug_uid			= $row['bug_uid'];
	$bug_bitfield		= $row['bug_bitfield'];
	$bug_flags			= $row['bug_flags'];
	$report_text		= generate_text_for_display($report_text, $bug_uid, $bug_bitfield, $bug_flags);
	$report_file_ver	= $row['report_file_ver'];
	$report_date		= $row['report_date'];
	$report_author_id	= $row['report_author_id'];
	$report_assign_id	= $row['report_assign_id'];
	$report_assign_date	= $row['report_assign_date'];
	$report_status		= $row['report_status'];
	$report_status_date	= $row['report_status_date'];
	$report_php			= $row['report_php'];
	$report_db			= $row['report_db'];
	$report_forum		= $row['report_forum'];
	$report_author		= $row['report_author'];
	$report_author_col	= $row['report_colour'];
	$report_assign		= $row['report_assign'];
	$report_assign_col	= $row['report_assign_col'];

	$db->sql_freeresult($result);

	// Change status in the report was new and a team member will open the details
	if (!$report_status && $allow_bug_mod)
	{
		$sql = 'INSERT INTO ' . DL_BUG_HISTORY_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'df_id'				=> $report_file_id,
			'report_id'			=> $report_id,
			'report_his_type'	=> 'status',
			'report_his_date'	=> time(),
			'report_his_value'	=> '1:' . $user->data['username']));
		$db->sql_query($sql);

		$report_status = 1;
		$report_status_date = time();

		$sql = 'UPDATE ' . DL_BUGS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
			'report_status'			=> $report_status,
			'report_status_date'	=> $report_status_date)) . ' WHERE report_id = ' . (int) $report_id;
		$db->sql_query($sql);
	}

	$u_report_file_link		= append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$report_file_id");
	$report_author_link		= get_username_string('full', $report_author_id, $report_author, $report_author_col);

	if ($report_assign_id)
	{
		$template->assign_block_vars('assign', array(
			'ASSIGN_TO'		=> get_username_string('full', $report_assign_id, $report_assign, $report_assign_col),
			'ASSIGN_DATE'	=> $user->format_date($report_assign_date),
			'U_ASSIGN_TO'	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=$report_assign_id"))
		);
	}
	else
	{
		$template->assign_var('S_NO_ASSIGN', true);
	}

	$report_date = $user->format_date($report_date);

	$report_title	= censor_text($report_title);
	$report_text	= censor_text($report_text);

	$template->set_filenames(array(
		'body' => 'dl_mod/dl_bt_detail.html')
	);

	$template->assign_vars(array(
		'REPORT_ID'			=> $report_id,
		'REPORT_FILE'		=> $report_file,
		'REPORT_TITLE'		=> $report_title,
		'REPORT_TEXT'		=> $report_text,
		'REPORT_FILE_VER'	=> $report_file_ver,
		'REPORT_DATE'		=> $report_date,
		'REPORT_PHP'		=> $report_php,
		'REPORT_DB'			=> $report_db,
		'REPORT_FORUM'		=> $report_forum,
		'REPORT_AUTHOR'		=> $report_author_link,
		'REPORT_STATUS'		=> $user->lang['DL_REPORT_STATUS'][$report_status],
		'STATUS_DATE'		=> $user->format_date($report_status_date),

		'U_DOWNLOAD_FILE'	=> $u_report_file_link,
		'U_DOWNLOAD'		=> append_sid("{$phpbb_root_path}downloads.$phpEx"),
		'U_BUG_TRACKER'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker"))
	);

	// Begin report history
	$sql = 'SELECT * FROM ' . DL_BUG_HISTORY_TABLE . '
		WHERE report_id = ' . (int) $fav_id . '
		ORDER BY report_his_id DESC';
	$result = $db->sql_query($sql);

	$total_history = $db->sql_affectedrows($result);

	if ($total_history)
	{
		$template->assign_var('S_HISTORY', true);

		while ($row = $db->sql_fetchrow($result))
		{
			$report_his_type = $row['report_his_type'];
			$report_his_value = $row['report_his_value'];

			$output_date = $user->format_date($row['report_his_date']);

			if ($report_his_type == 'assign')
			{
				$output_value = $user->lang['DL_BUG_REPORT_ASSIGN'];
				$output_data = explode(':', $report_his_value);

				$output_text = $user->lang['DL_BUG_REPORT_ASSIGNED'] . ' -> ' . $output_data[1];
			}
			else if ($report_his_type == 'status')
			{
				$output_value = $user->lang['DL_BUG_REPORT_STATUS'];
				$output_data = explode(':', $report_his_value);

				$output_status = intval($output_data[0]);
				$output_text = $user->lang['DL_REPORT_STATUS'][$output_status] . ' -> ' . $output_data[1];
				$output_text .= (isset($output_data[2])) ? '</span><hr /><span>' . str_replace("\n", "<br />", $output_data[2]) : '';
			}

			$template->assign_block_vars('history_row', array(
				'VALUE'	=> $output_value,
				'DATE'	=> $output_date,
				'TEXT'	=> $output_text)
			);
		}
	}

	$db->sql_freeresult($result);

	if ($allow_bug_mod)
	{
		$template->assign_block_vars('delete', array(
			'U_DELETE' => append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;df_id=$report_file_id&amp;fav_id=$report_id&amp;action=delete"))
		);

		if ($report_status < 4)
		{
			$sql = 'SELECT ug.user_id FROM ' . DL_AUTH_TABLE . ' dl, ' . USER_GROUP_TABLE . ' ug
				WHERE dl.auth_mod = ' . true .'
					AND dl.group_id = ug.group_id
					AND ug.user_pending <> ' . true . '
				GROUP BY ug.user_id';
			$result = $db->sql_query($sql);

			$user_ids = array(0);

			while ($row = $db->sql_fetchrow($result))
			{
				$user_ids[] = $row['user_id'];
			}
			$db->sql_freeresult($result);

			// Codeblock to assign the report to a team member
			$sql = 'SELECT user_id, username_clean FROM ' . USERS_TABLE . '
				WHERE ((' . $db->sql_in_set('user_id', $user_ids) . '
					AND user_id <> ' . ANONYMOUS . ')
					OR user_type = ' . USER_FOUNDER . ')
					AND user_id <> ' . (int) $report_assign_id . '
				ORDER BY username';
			$result = $db->sql_query($sql);

			if ($db->sql_affectedrows($result))
			{
				$template->assign_var('S_ASSIGN_MOD', true);

				$s_select_assign_member = '<select name="user_assign">';

				while ($row = $db->sql_fetchrow($result))
				{
					$s_select_assign_member .= '<option value="' . $row['user_id'] . '">' . $row['username_clean'] . '</option>';
				}

				$s_select_assign_member .= '</select>';
				$s_select_assign_member = str_replace('<option value="'.$user->data['user_id'].'">', '<option value="'.$user->data['user_id'].'" selected="selected">', $s_select_assign_member);

				$template->assign_vars(array(
					'S_FORM_ASSIGN_ACTION' => append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;action=assign&amp;df_id=$report_file_id&amp;fav_id=$fav_id"),
					'S_SELECT_ASSIGN_USER' => $s_select_assign_member)
				);
			}

			$db->sql_freeresult($result);
		}

		// Create status select
		$s_select_status = '';

		switch ($report_status)
		{
			case 0:
			case 1:
			case 2:
			case 3:
				$s_select_status .= '<option value="2">'.$user->lang['DL_REPORT_STATUS'][2].'</option>';
				$s_select_status .= '<option value="3">'.$user->lang['DL_REPORT_STATUS'][3].'</option>';
				$s_select_status .= '<option value="4">'.$user->lang['DL_REPORT_STATUS'][4].'</option>';
				$s_select_status .= '<option value="5">'.$user->lang['DL_REPORT_STATUS'][5].'</option>';
				break;
			case 4:
			case 5:
		}

		if ($s_select_status)
		{
			$template->assign_var('S_SELECT_STATUS', true);

			$s_select_status = '<select name="new_status">' . $s_select_status . '</select>';

			$template->assign_vars(array(
				'S_FORM_STATUS_ACTION' => append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;action=status&amp;df_id=$report_file_id&amp;fav_id=$fav_id"),
				'S_SELECT_STATUS' => $s_select_status)
			);
		}
	}

	if (dl_auth::user_admin())
	{
		$template->assign_vars(array(
			'I_BUG_REPORT'		=> $user->img('icon_post_edit', 'EDIT_POST'),
			'U_BUG_REPORT_EDIT'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;action=edit&amp;fav_id=$fav_id"),
		));
	}

	add_form_key('bt_status');
}

/*
* display form to add a bug report or let an admin edit an existing report
*/
if (($action == 'add' && $user->data['is_registered']) || ($action == 'edit' && dl_auth::user_admin() && $fav_id))
{
	$template->set_filenames(array(
		'body' => 'dl_mod/dl_bt_add.html')
	);

	$s_hidden_fields = array('action' => 'save');

	if ($action == 'edit')
	{
		$s_hidden_fields = array_merge($s_hidden_fields, array('fav_id' => $fav_id));
	}

	$sql = 'SELECT c.cat_name, d.id, d.description, d.desc_uid, d.desc_bitfield, d.desc_flags FROM ' . DOWNLOADS_TABLE . ' d, ' . DL_CAT_TABLE . ' c
		WHERE d.cat = c.id
			AND c.bug_tracker = ' . true . '
			AND ' . $db->sql_in_set('c.id', $bug_access_cats) . '
		ORDER BY c.sort ASC, d.sort ASC';
	$result = $db->sql_query($sql);

	$s_select_download = '';

	$cur_cat = '';

	while ($row = $db->sql_fetchrow($result))
	{
		$cat_name = $row['cat_name'];
		if ($cat_name <> $cur_cat)
		{
			if ($s_select_download != '')
			{
				$s_select_download .= '</optgroup>';
			}
			$s_select_download .= '<optgroup label="' . $cat_name . '">';
			$cur_cat = $cat_name;
		}

		$download_name = $row['description'];
		$desc_uid = $row['desc_uid'];
		$desc_bitfield = $row['desc_bitfield'];
		$desc_flags = $row['desc_flags'];
		$description = generate_text_for_display($download_name, $desc_uid, $desc_bitfield, $desc_flags);

		if ($df_id == $row['id'])
		{
			$s_select_download .= '<option value="' . $row['id'] . '" selected="selected">' . $description . '</option>';
		}
		else
		{
			$s_select_download .= '<option value="' . $row['id'] . '">' . $description . '</option>';
		}
	}

	$s_select_download = '<select name="df_id">' . $s_select_download . '</optgroup></select>';

	$db->sql_freeresult($result);

	add_form_key('posting');

	// Status for HTML, BBCode, Smilies, Images and Flash
	$bbcode_status	= ($config['allow_bbcode']) ? true : false;
	$smilies_status	= ($bbcode_status && $config['allow_smilies']) ? true : false;
	$img_status		= ($bbcode_status) ? true : false;
	$url_status		= ($config['allow_post_links']) ? true : false;
	$flash_status	= ($bbcode_status && $config['allow_post_flash']) ? true : false;
	$quote_status	= true;

	// Smilies Block
	include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
	generate_smilies('inline', 0);

	// BBCode-Block
	$user->add_lang('posting');
	display_custom_bbcodes();

	if ($action == 'edit' && !$preview)
	{
		$preview = true;

		$sql = 'SELECT * FROM ' . DL_BUGS_TABLE . '
			WHERE report_id = ' . (int) $fav_id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$report_title		= $row['report_title'];
		$report_text		= $row['report_text'];
		$report_file_ver	= $row['report_file_ver'];
		$report_php			= $row['report_php'];
		$report_db			= $row['report_db'];
		$report_forum		= $row['report_forum'];

		$bug_uid			= $row['bug_uid'];
		$bug_flags			= $row['bug_flags'];

		$text_ary			= generate_text_for_edit($report_text, $bug_uid, $bug_flags);
		$report_text		= $text_ary['text'];
	}

	$template->assign_vars(array(
		'REPORT_TITLE'		=> ($preview) ? $report_title : '',
		'REPORT_TEXT'		=> ($preview) ? $report_text : '',
		'REPORT_FILE_VER'	=> ($preview) ? $report_file_ver : '',
		'REPORT_PHP'		=> ($preview) ? $report_php : '',
		'REPORT_DB'			=> ($preview) ? $report_db : '',
		'REPORT_FORUM'		=> ($preview) ? $report_forum : '',

		'S_BBCODE_ALLOWED'	=> $bbcode_status,
		'S_BBCODE_IMG'		=> $img_status,
		'S_BBCODE_URL'		=> $url_status,
		'S_BBCODE_FLASH'	=> $flash_status,
		'S_BBCODE_QUOTE'	=> $quote_status,

		'S_FORM_ACTION'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker"),
		'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
		'S_SELECT_DOWNLOAD'	=> $s_select_download,

		'U_MORE_SMILIES'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "action=smilies"),
		'U_DOWNLOAD'		=> append_sid("{$phpbb_root_path}downloads.$phpEx"),
		'U_BUG_TRACKER'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker"))
	);

	page_footer();
}

/*
* delete bug report - only if the report really will not be a bug ;)
*/
if ($action == 'delete' && $df_id && $fav_id && $allow_bug_mod)
{
	if (!$confirm && !$cancel)
	{
		// Confirm deletion
		$s_hidden_fields = array(
			'df_id'		=> $df_id,
			'fav_id'	=> $fav_id,
			'view'		=> 'bug_tracker',
			'action'	=> 'delete'
		);

		$template->set_filenames(array(
			'body' => 'dl_mod/dl_confirm_body.html')
		);

		add_form_key('dl_bug_del');

		$template->assign_vars(array(
			'MESSAGE_TITLE' => $user->lang['INFORMATION'],
			'MESSAGE_TEXT' => $user->lang['DL_CONFIRM_DELETE_BUG_REPORT'],

			'S_CONFIRM_ACTION' => append_sid("{$phpbb_root_path}downloads.$phpEx"),
			'S_HIDDEN_FIELDS' => build_hidden_fields($s_hidden_fields))
		);

		page_footer();
	}
	else if (!$cancel)
	{
		if (!check_form_key('dl_bug_del'))
		{
			trigger_error('FORM_INVALID');
		}

		$sql = 'DELETE FROM ' . DL_BUGS_TABLE . '
			WHERE report_id = ' . (int) $fav_id;
		$db->sql_query($sql);

		$sql = 'DELETE FROM ' . DL_BUG_HISTORY_TABLE . '
			WHERE report_id = ' . (int) $fav_id;
		$db->sql_query($sql);

		$fav_id = 0;
	}

	$df_id		= 0;
	$action		= '';
	$confirm	= '';
	$cancel		= '';
}

if (!$action)
{
	// Load board header and send default values to template
	$template->set_filenames(array(
		'body' => 'dl_mod/dl_bt_list.html')
	);

	unset($sql_array);

	$sql = 'SELECT b.report_status, COUNT(b.report_id) AS total FROM ' . DL_BUGS_TABLE . ' b
			LEFT JOIN ' . DOWNLOADS_TABLE . ' d ON d.id = b.df_id
		WHERE ' . $db->sql_in_set('d.cat', $bug_access_cats) . '
		GROUP BY report_status
		ORDER BY report_status';
	$result = $db->sql_query($sql);

	$job_status_count = array();

	while ($row = $db->sql_fetchrow($result))
	{
		$bug_status_count[$row['report_status']] = $row['total'];
	}

	$db->sql_freeresult($result);

	$bug_status_count[0] = (!isset($bug_status_count[0])) ? '' : ' ('.$bug_status_count[0].')';
	$bug_status_count[1] = (!isset($bug_status_count[1])) ? '' : ' ('.$bug_status_count[1].')';
	$bug_status_count[2] = (!isset($bug_status_count[2])) ? '' : ' ('.$bug_status_count[2].')';
	$bug_status_count[3] = (!isset($bug_status_count[3])) ? '' : ' ('.$bug_status_count[3].')';
	$bug_status_count[4] = (!isset($bug_status_count[4])) ? '' : ' ('.$bug_status_count[4].')';
	$bug_status_count[5] = (!isset($bug_status_count[5])) ? '' : ' ('.$bug_status_count[5].')';

	$s_select_filter = '<select name="bt_filter">';
	$s_select_filter .= '<option value="0">'.$user->lang['DL_NO_FILTER'].'</option>';
	$s_select_filter .= '<option value="-1">'.$user->lang['DL_FILTER_OPEN'].'</option>';
	$s_select_filter .= '<option value="1">'.$user->lang['DL_REPORT_STATUS'][0].$bug_status_count[0].'</option>';
	$s_select_filter .= '<option value="2">'.$user->lang['DL_REPORT_STATUS'][1].$bug_status_count[1].'</option>';
	$s_select_filter .= '<option value="3">'.$user->lang['DL_REPORT_STATUS'][2].$bug_status_count[2].'</option>';
	$s_select_filter .= '<option value="4">'.$user->lang['DL_REPORT_STATUS'][3].$bug_status_count[3].'</option>';
	$s_select_filter .= '<option value="5">'.$user->lang['DL_REPORT_STATUS'][4].$bug_status_count[4].'</option>';
	$s_select_filter .= '<option value="6">'.$user->lang['DL_REPORT_STATUS'][5].$bug_status_count[5].'</option>';
	$s_select_filter .= '</select>';
	$s_select_filter = str_replace('value="'.$bt_filter.'">', 'value="'.$bt_filter.'" selected="selected">', $s_select_filter);

	$s_hidden_fields = array(
		'df_id'		=> $df_id,
		'action'	=> 'add'
	);

	$template->assign_vars(array(
		'S_SELECT_FILTER'			=> $s_select_filter,
		'S_FORM_ACTION'				=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker"),
		'S_FORM_FILTER_ACTION'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;df_id=$df_id"),
		'S_FORM_OWN_ACTION'			=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;df_id=$df_id&amp;bt_show=own"),
		'S_FORM_ASSIGN_ACTION'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;df_id=$df_id&amp;bt_show=assign"),
		'S_HIDDEN_FIELDS'			=> build_hidden_fields($s_hidden_fields),

		'U_DOWNLOAD'				=> append_sid("{$phpbb_root_path}downloads.$phpEx"),
		'U_BUG_TRACKER'				=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker"))
	);

	/*
	* view bug tracker - detail overview for given download
	*/
	if ($bt_filter == -1)
	{
		$sql_where = ' AND report_status < 3 ';
	}
	else if ($bt_filter > 0)
	{
		$bt_filter--;
		$sql_where = ' AND report_status = ' . (int) $bt_filter . ' ';
	}
	else
	{
		$sql_where = '';
	}

	if ($bt_show == 'own')
	{
		$sql_where .= ' AND report_author_id = ' . (int) $user->data['user_id'] . ' ';
	}
	else
	{
		$template->assign_var('S_OWN_REPORT', true);
	}

	if ($bt_show == 'assign')
	{
		$sql_where .= ' AND report_assign_id = ' . (int) $user->data['user_id'] . ' ';
	}
	else
	{
		$template->assign_var('S_ASSIGN_REPORT', true);
	}

	if ($df_id)
	{
		$sql_first_where = ' AND df_id = ' . (int) $df_id . ' ';
		$template->assign_var('S_REPORT_TEXT', true);
	}
	else
	{
		$sql_first_where = ' AND df_id <> 0 ';
	}

	$sql = 'SELECT b.* FROM ' . DL_BUGS_TABLE . ' b
		LEFT JOIN ' . DOWNLOADS_TABLE . ' d ON d.id = b.df_id
		WHERE ' . $db->sql_in_set('d.cat', $bug_access_cats) . "
		$sql_first_where
			$sql_where";
	$result = $db->sql_query($sql);
	$total_reports = $db->sql_affectedrows($result);
	$db->sql_freeresult($result);

	if ($total_reports > $config['dl_links_per_page'])
	{
		$pagination = generate_pagination(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;df_id=$df_id"), $total_reports, $config['dl_links_per_page'], $start, true);
	}
	else
	{
		$pagination = '';
	}

	$template->assign_vars(array(
		'PAGINATION' => $pagination)
	);

	if ($total_reports)
	{
		if ($df_id)
		{
			$sql_where .= " AND b.df_id = $df_id ";
		}

		unset($sql_array);

		$sql_array = array(
			'SELECT'	=> 'b.*, d.id, d.description AS report_file, u1.username AS report_author, u1.user_colour AS report_colour, u2.username AS report_assign, u2.user_colour AS assign_colour',
			'FROM'		=> array(DL_BUGS_TABLE => 'b'));

		$sql_array['LEFT_JOIN'] = array();
		$sql_array['LEFT_JOIN'][] = array(
			'FROM'		=> array(DOWNLOADS_TABLE => 'd'),
			'ON'		=> 'b.df_id = d.id');
		$sql_array['LEFT_JOIN'][] = array(
			'FROM'		=> array(USERS_TABLE => 'u1'),
			'ON'		=> 'u1.user_id = b.report_author_id');
		$sql_array['LEFT_JOIN'][] = array(
			'FROM'		=> array(USERS_TABLE => 'u2'),
			'ON'		=> 'u2.user_id = b.report_assign_id');

		if ($sql_where)
		{
			$sql_array['WHERE'] = str_replace('# AND', '', '#' . $sql_where);
		}

		if (isset($sql_array['WHERE']))
		{
			$sql_array['WHERE'] .= ' AND ' . $db->sql_in_set('d.cat', $bug_access_cats);
		}
		else
		{
			$sql_array['WHERE'] = $db->sql_in_set('d.cat', $bug_access_cats);
		}

		$sql_array['ORDER_BY'] = 'b.report_date DESC';

		$sql = $db->sql_build_query('SELECT', $sql_array);

		$result = $db->sql_query_limit($sql, $config['dl_links_per_page'], $start);

		$reports_num = $db->sql_affectedrows($result);
	}
	else
	{
		$reports_num = 0;
	}

	if ($reports_num)
	{
		while ($row = $db->sql_fetchrow($result))
		{
			$report_dl_id		= $row['id'];
			$report_id			= $row['report_id'];
			$report_title		= $row['report_title'];
			$report_text		= $row['report_text'];
			$bug_uid			= $row['bug_uid'];
			$bug_bitfield		= $row['bug_bitfield'];
			$bug_flags			= $row['bug_flags'];
			$report_text		= generate_text_for_display($report_text, $bug_uid, $bug_bitfield, $bug_flags);
			$report_file_ver	= $row['report_file_ver'];
			$report_file		= $row['report_file'];
			$report_date		= $row['report_date'];
			$report_author_id	= $row['report_author_id'];
			$report_colour		= $row['report_colour'];
			$report_assign_id	= $row['report_assign_id'];
			$report_author		= $row['report_author'];
			$report_assign		= $row['report_assign'];
			$report_assign_col	= $row['assign_colour'];
			$report_assign_date	= $row['report_assign_date'];
			$report_status		= $row['report_status'];
			$report_status_date	= $row['report_status_date'];
			$report_php			= $row['report_php'];
			$report_db			= $row['report_db'];
			$report_forum		= $row['report_forum'];

			$report_title		= censor_text($report_title);
			$report_text		= censor_text($report_text);

			$template->assign_block_vars('bug_tracker_row', array(
				'REPORT_ID'				=> $report_id,
				'REPORT_TITLE'			=> $report_title,
				'REPORT_TEXT'			=> $report_text,
				'REPORT_DATE'			=> $user->format_date($report_date),

				'REPORT_PHP'			=> $report_php,
				'REPORT_DB'				=> $report_db,
				'REPORT_FORUM'			=> $report_forum,

				'REPORT_FILE'			=> $report_file,
				'REPORT_FILE_VER'		=> $report_file_ver,
				'REPORT_FILE_LINK'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$report_dl_id"),

				'REPORT_AUTHOR_LINK'	=> get_username_string('full', $report_author_id, $report_author, $report_colour),

				'REPORT_STATUS'			=> $user->lang['DL_REPORT_STATUS'][$report_status],
				'REPORT_STATUS_DATE'	=> $user->format_date($report_status_date),

				'REPORT_DETAIL'			=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;fav_id=$report_id&amp;action=detail"))
			);

			if ($report_assign_id)
			{
				$template->assign_block_vars('bug_tracker_row.assign', array(
					'REPORT_ASSIGN_LINK'	=> get_username_string('full', $report_assign_id, $report_assign, $report_assign_col),
					'REPORT_ASSIGN_DATE'	=> $user->format_date($report_assign_date))
				);
			}
			else
			{
				$template->assign_var('S_NO_ASSIGN', true);
			}

			if ($allow_bug_mod)
			{
				$template->assign_block_vars('bug_tracker_row.mod', array(
					'U_DELETE' => append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;df_id=$report_dl_id&amp;fav_id=$report_id&amp;action=delete"))
				);

				$template->assign_block_vars('bug_tracker_row.status_mod', array(
					'U_STATUS' => append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;df_id=$report_dl_id&amp;fav_id=$report_id&amp;action=status"))
				);
			}
			else
			{
				$template->assign_block_vars('bug_tracker_row.no_status_mod', array());
			}
		}

		$db->sql_freeresult($result);
	}
	else
	{
		$template->assign_var('S_NO_BUG_TRACKER', true);
	}
}

if ($user->data['is_registered'])
{
	$template->assign_var('S_ADD_NEW_REPORT', true);
}

?>