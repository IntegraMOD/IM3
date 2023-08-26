<?php

/**
*
* @mod package		Download Mod 6
* @file				dl_details.php 48 2014/10/08 OXPUS
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

if ($cancel)
{
	$action = '';
}

if (!$df_id)
{
	redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
}

/*
* default entry point for download details
*/
$dl_files = array();
$dl_files = dl_files::all_files(0, '', 'ASC', '', $df_id, $modcp, '*');

if (!$dl_files)
{
	redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
}

$cat_id = $dl_files['cat'];

$cat_auth = array();
$cat_auth = dl_auth::dl_cat_auth($cat_id);

if (!$auth->acl_get('a_') && !$cat_auth['auth_mod'])
{
	$modcp = 0;
}

/*
* check the permissions
*/
$check_status = array();
$check_status = dl_status::status($df_id);

if (!$dl_files['id'])
{
	trigger_error('DL_NO_PERMISSION');
}

// Check saved thumbs
$sql = 'SELECT * FROM ' . DL_IMAGES_TABLE . '
	WHERE dl_id = ' . (int) $df_id;
$result = $db->sql_query($sql);
$total_images = $db->sql_affectedrows($result);

if ($total_images)
{
	$template->assign_var('S_DL_LYTEBOX', true);
	$template->assign_var('S_TOTAL_IMAGES', true);

	$thumbs_ary = array();

	while ($row = $db->sql_fetchrow($result))
	{
		$thumbs_ary[] = $row;
	}
}

$db->sql_freeresult($result);

$inc_module = true;
page_header($user->lang['DOWNLOADS'] . ' - ' . $dl_files['description']);

/*
* User is banned?
*/
if (dl_auth::user_banned())
{
	$template->assign_var('S_DL_USERBAN', true);
}

/*
* Forum rules?
*/
if (isset($index[$cat_id]['rules']) && $index[$cat_id]['rules'] != '')
{
	$cat_rule = $index[$cat_id]['rules'];
	$cat_rule_uid = (isset($index[$cat_id]['rule_uid'])) ? $index[$cat_id]['rule_uid'] : '';
	$cat_rule_bitfield = (isset($index[$cat_id]['rule_bitfield'])) ? $index[$cat_id]['rule_bitfield'] : '';
	$cat_rule_flags = (isset($index[$cat_id]['rule_flags'])) ? $index[$cat_id]['rule_flags'] : '';
	$cat_rule = censor_text($cat_rule);
	$cat_rule = generate_text_for_display($cat_rule, $cat_rule_uid, $cat_rule_bitfield, $cat_rule_flags);

	$template->assign_var('S_CAT_RULE', true);
}
else
{
	$cat_rule = '';
}

/*
* Cat Traffic?
*/
$cat_traffic = 0;

if (!$config['dl_traffic_off'])
{
	if ($user->data['is_registered'])
	{
		$cat_overall_traffic = $config['dl_overall_traffic'];
		$cat_limit = DL_OVERALL_TRAFFICS;
	}
	else
	{
		$cat_overall_traffic = $config['dl_overall_guest_traffic'];
		$cat_limit = DL_GUESTS_TRAFFICS;
	}

	if (isset($index[$cat_id]['cat_traffic']) && isset($index[$cat_id]['cat_traffic_use']))
	{
		$cat_traffic = $index[$cat_id]['cat_traffic'] - $index[$cat_id]['cat_traffic_use'];

		if ($index[$cat_id]['cat_traffic'] && $cat_traffic > 0)
		{
			$cat_traffic = ($cat_traffic > $cat_overall_traffic && $cat_limit == true) ? $cat_overall_traffic : $cat_traffic;
			$cat_traffic = dl_format::dl_size($cat_traffic);
	
			$template->assign_var('S_CAT_TRAFFIC', true);
		}
	}
}
else
{
	unset($cat_traffic);
}

/*
* Read the ratings for this little download
*/
$rating = $s_hidden_fields = '';
$ratings = 0;
$rating_access = $user_have_rated = false;

if ($config['dl_enable_rate'])
{
	$sql = 'SELECT dl_id, user_id FROM ' . DL_RATING_TABLE . '
		WHERE dl_id = ' . (int) $df_id;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$ratings++;
		$user_have_rated = ($row['user_id'] == $user->data['user_id']) ? true : false;
	}

	$db->sql_freeresult($result);

	if ($user->data['is_registered'] && !$user_have_rated)
	{
		$rating_access = true;
	}
}

/*
* fetch last comment, if exists
*/
$s_comments_tab = false;

if ($index[$cat_id]['comments'] && dl_auth::cat_auth_comment_read($cat_id))
{
	$s_comments_tab = true;
	$template->assign_var('S_COMMENTS_TAB', $s_comments_tab);

	$s_hidden_fields = array(
		'cat_id'	=> $cat_id,
		'df_id'		=> $df_id,
		'view'		=> 'comment'
	);

	$template->assign_vars(array(
		'S_COMMENT_ACTION'			=> append_sid("{$phpbb_root_path}downloads.$phpEx"),
		'S_HIDDEN_COMMENT_FIELDS'	=> build_hidden_fields($s_hidden_fields))
	);

	$sql = 'SELECT * FROM ' . DL_COMMENTS_TABLE . '
		WHERE cat_id = ' . (int) $cat_id . '
			AND id = ' . (int) $df_id . '
			AND approve = ' . true;
	$result = $db->sql_query($sql);
	$real_comment_exists = $db->sql_affectedrows($result);
	$db->sql_freeresult($result);

	if ($real_comment_exists)
	{
		$template->assign_var('S_VIEW_COMMENTS', true);
	}

	if ($config['dl_latest_comments'] && $real_comment_exists)
	{
		$template->assign_var('S_COMMENTS_ON', true);

		$sql = 'SELECT c.*, u.user_colour, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height FROM ' . DL_COMMENTS_TABLE . ' c
			LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = c.user_id
			WHERE cat_id = ' . (int) $cat_id . '
				AND id = ' . (int) $df_id . '
				AND approve = ' . true . '
			ORDER BY comment_time DESC';
		$result = $db->sql_query_limit($sql, $config['dl_latest_comments']);

		while ($row = $db->sql_fetchrow($result))
		{
			$poster_id			= $row['user_id'];
			$poster				= $row['username'];
			$poster_color		= $row['user_colour'];
			$poster_avatar		= ($user->optionget('viewavatars')) ? get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height']) : '';

			$message			= $row['comment_text'];
			$com_uid			= $row['com_uid'];
			$com_bitfield		= $row['com_bitfield'];
			$com_flags			= $row['com_flags'];

			$message			= censor_text($message);
			$message			= generate_text_for_display($message, $com_uid, $com_bitfield, $com_flags);

			$comment_time		= $row['comment_time'];
			$comment_edit_time	= $row['comment_edit_time'];

			if($comment_time <> $comment_edit_time)
			{
				$edited_by = sprintf($user->lang['DL_COMMENT_EDITED'], $user->format_date($comment_edit_time));
			}
			else
			{
				$edited_by = '';
			}

			$template->assign_block_vars('comment_row', array(
				'EDITED_BY'		=> $edited_by,
				'POSTER'		=> get_username_string('full', $poster_id, $poster, $poster_color),
				'POSTER_AVATAR'	=> $poster_avatar,
				'MESSAGE'		=> $message,
				'POST_TIME'		=> $user->format_date($comment_time))
			);
		}
	}

	if (dl_auth::cat_auth_comment_post($cat_id))
	{
		$s_hidden_fields = array(
			'cat_id'	=> $cat_id,
			'df_id'		=> $df_id,
			'view'		=> 'comment'
		);

		$template->assign_var('S_POST_COMMENT', true);

		$template->assign_vars(array(
			'S_COMMENT_POST_ACTION'	=> append_sid("{$phpbb_root_path}downloads.$phpEx"),
			'S_HIDDEN_POST_FIELDS'	=> build_hidden_fields($s_hidden_fields))
		);
	}
	$db->sql_freeresult($result);
}

/*
* Check existing hashes and build the hash table if the category allowes it
*/
$hash_method = $config['dl_file_hash_algo'];
$func_hash = $hash_method . '_file';
$hash_table = array();
$hash_tab = false;

if (!$dl_files['extern'])
{
	if (!$dl_files['file_hash'])
	{
		if (file_exists($phpbb_root_path . $config['dl_download_dir'] . $index[$cat_id]['cat_path'] . $dl_files['real_file']))
		{
			$dl_files['file_hash'] = $func_hash($phpbb_root_path . $config['dl_download_dir'] . $index[$cat_id]['cat_path'] . $dl_files['real_file']);
			$sql = 'UPDATE ' . DOWNLOADS_TABLE . " SET file_hash = '" . $db->sql_escape($dl_files['file_hash']) . "' WHERE id = " . (int) $df_id;
			$db->sql_query($sql);
		}
	}
	
	if ($index[$cat_id]['show_file_hash'])
	{
		$dl_key = $dl_files['description'] . (($dl_files['hack_version']) ? ' ' . $dl_files['hack_version'] : ' (' . $user->lang['DL_CURRENT_VERSION'] . ')');
		$hash_table[$dl_key]['hash'] = ($dl_files['file_hash']) ? $dl_files['file_hash'] : '';
		$hash_table[$dl_key]['file'] = $dl_files['file_name'];
		$hash_table[$dl_key]['type'] = ($dl_files['file_hash']) ? $hash_method : sprintf($user->lang['DL_FILE_NOT_FOUND'], $dl_files['file_name'], $config['dl_download_dir'] . $index[$cat_id]['cat_path']);
	}
	
	$sql = 'SELECT ver_id, ver_version, ver_real_file, ver_file_hash, ver_file_name, ver_change_time FROM ' . DL_VERSIONS_TABLE . '
		WHERE dl_id = ' . (int) $df_id . '
		ORDER BY ver_version DESC, ver_change_time DESC';
	$result = $db->sql_query($sql);
	$total_releases = $db->sql_affectedrows($result);
	
	if ($total_releases)
	{
		while ($row = $db->sql_fetchrow($result))
		{
			$ver_file_hash = $row['ver_file_hash'];
	
			if (!$ver_file_hash)
			{
				if (file_exists($phpbb_root_path . $config['dl_download_dir'] . $index[$cat_id]['cat_path'] . $row['ver_real_file']))
				{
					$ver_file_hash = $func_hash($phpbb_root_path . $config['dl_download_dir'] . $index[$cat_id]['cat_path'] . $row['ver_real_file']);
					$sql = 'UPDATE ' . DL_VERSIONS_TABLE . " SET ver_file_hash = '" . $db->sql_escape($ver_file_hash) . "' WHERE ver_id = " . (int) $row['ver_id'];
					$db->sql_query($sql);
				}
			}
			
			if ($index[$cat_id]['show_file_hash'])
			{
				$dl_key = $dl_files['description'] . (($row['ver_version']) ? ' ' . $row['ver_version'] : ' (' . $user->format_date($row['ver_change_time']) . ')');
				$hash_table[$dl_key]['hash'] = ($ver_file_hash) ? $ver_file_hash : '';
				$hash_table[$dl_key]['file'] = $row['ver_file_name'];
				$hash_table[$dl_key]['type'] = ($ver_file_hash) ? $hash_method : sprintf($user->lang['DL_FILE_NOT_FOUND'], $row['ver_file_name'], $config['dl_download_dir'] . $index[$cat_id]['cat_path']);
			}
		}
	}
	
	$db->sql_freeresult($result);
	
	if (sizeof($hash_table) && $index[$cat_id]['show_file_hash'])
	{
		foreach ($hash_table as $key => $value)
		{
			$template->assign_block_vars('hash_row', array(
				'DL_VERSION'		=> $key,
				'DL_FILE_NAME'		=> $value['file'],
				'DL_HASH_METHOD'	=> $hash_table[$dl_key]['type'],
				'DL_HASH'			=> $value['hash'],
			));
		}
	
		$hash_tab = true;
	}
}

/*
* generate page
*/
$template->set_filenames(array(
	'body' => 'dl_mod/view_dl_body.html')
);

$user_id = $user->data['user_id'];
$username = $user->data['username'];

/*
* prepare the download for displaying
*/
$description		= $dl_files['description'];
$desc_uid			= $dl_files['desc_uid'];
$desc_bitfield		= $dl_files['desc_bitfield'];
$desc_flags			= $dl_files['desc_flags'];
$description		= generate_text_for_display($description, $desc_uid, $desc_bitfield, $desc_flags);

$mini_icon			= dl_status::mini_status_file($cat_id, $df_id);

$hack_version		= '&nbsp;'.$dl_files['hack_version'];

$long_desc			= $dl_files['long_desc'];
$long_desc_uid		= $dl_files['long_desc_uid'];
$long_desc_bitfield	= $dl_files['long_desc_bitfield'];
$long_desc_flags	= $dl_files['long_desc_flags'];
$long_desc			= generate_text_for_display($long_desc, $long_desc_uid, $long_desc_bitfield, $long_desc_flags);

$file_status	= array();
$file_status	= dl_status::status($df_id);

$status			= $file_status['status_detail'];
$file_name		= $file_status['file_detail'];
$file_load		= $file_status['auth_dl'];
$real_file		= $dl_files['real_file'];

if ($dl_files['extern'])
{
	if ($config['dl_shorten_extern_links'])
	{
		if (strlen($file_name) > $config['dl_shorten_extern_links'] && strlen($file_name) <= $config['dl_shorten_extern_links'] * 2)
		{
			$file_name = substr($file_name, strlen($file_name) - $config['dl_shorten_extern_links']);
		}
		else
		{
			$file_name = substr($file_name, 0, $config['dl_shorten_extern_links']) . '...' . substr($file_name, strlen($file_name) - $config['dl_shorten_extern_links']);
		}
	}
}

if ($dl_files['file_size'])
{
	$file_size_out = dl_format::dl_size($dl_files['file_size'], 2);
}
else
{
	$file_size_out = $user->lang['DL_NOT_AVAILIBLE'];
}

$file_klicks			= $dl_files['klicks'];
$file_overall_klicks	= $dl_files['overall_klicks'];

$cat_name = $index[$cat_id]['cat_name'];
$cat_view = $index[$cat_id]['nav_path'];
$cat_desc = $index[$cat_id]['description'];

$add_user		= $add_time = '';
$change_user	= $change_time = '';

$sql = 'SELECT username, user_id, user_colour FROM ' . USERS_TABLE . '
	WHERE user_id = ' . (int) $dl_files['add_user'];
$result = $db->sql_query($sql);

$row			= $db->sql_fetchrow($result);
$add_user		= get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);
$add_time		= $user->format_date($dl_files['add_time']);

$db->sql_freeresult($result);

if ($dl_files['add_time'] != $dl_files['change_time'])
{
	$sql = 'SELECT username, user_id, user_colour FROM ' . USERS_TABLE . '
		WHERE user_id = ' . (int) $dl_files['change_user'];
	$result = $db->sql_query($sql);

	$row			= $db->sql_fetchrow($result);
	$change_user	= get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);
	$change_time	= $user->format_date($dl_files['change_time']);

	$db->sql_freeresult($result);
}

$last_time_string		= ($dl_files['extern']) ? $user->lang['DL_LAST_TIME_EXTERN'] : $user->lang['DL_LAST_TIME'];
$last_time				= ($dl_files['last_time']) ? sprintf($last_time_string, $user->format_date($dl_files['last_time'])) : $user->lang['DL_NO_LAST_TIME'];

$hack_author_email		= $dl_files['hack_author_email'];
$hack_author			= ( $dl_files['hack_author'] != '' ) ? $dl_files['hack_author'] : 'n/a';
$hack_author_website	= $dl_files['hack_author_website'];
$hack_dl_url			= $dl_files['hack_dl_url'];

$test					= $dl_files['test'];
$require				= $dl_files['req'];
$todo					= $dl_files['todo'];
$todo_uid				= $dl_files['todo_uid'];
$todo_bitfield			= $dl_files['todo_bitfield'];
$todo_flags				= $dl_files['todo_flags'];
$todo					= generate_text_for_display($todo, $todo_uid, $todo_bitfield, $todo_flags);
$warning				= $dl_files['warning'];
$warn_uid				= $dl_files['warn_uid'];
$warn_bitfield			= $dl_files['warn_bitfield'];
$warn_flags				= $dl_files['warn_flags'];
$warning				= generate_text_for_display($warning, $warn_uid, $warn_bitfield, $warn_flags);

$mod_list				= $dl_files['mod_list'];

if ($mod_list)
{
	$mod_desc			= $dl_files['mod_desc'];
	$mod_desc_uid		= $dl_files['mod_desc_uid'];
	$mod_desc_bitfield	= $dl_files['mod_desc_bitfield'];
	$mod_desc_flags		= $dl_files['mod_desc_flags'];
	$mod_desc			= generate_text_for_display($mod_desc, $mod_desc_uid, $mod_desc_bitfield, $mod_desc_flags);
}

/*
* Hacklist
*/
if ($dl_files['hacklist'] && $config['dl_use_hacklist'])
{
	$template->assign_block_vars('hacklist', array(
		'HACK_AUTHOR'			=> ( $hack_author_email != '' ) ? '<a href="mailto:'.$hack_author_email.'">'.$hack_author.'</a>' : $hack_author,
		'HACK_AUTHOR_WEBSITE'	=> ( $hack_author_website != '' ) ? ' [ <a href="'.$hack_author_website.'">'.$user->lang['WEBSITE'].'</a> ]' : '',
		'HACK_DL_URL'	=> ( $hack_dl_url != '' ) ? '<a href="' . $hack_dl_url . '">'.$user->lang['DL_DOWNLOAD'].'</a>' : 'n/a')
	);
}

/*
* MOD block
*/
if ($mod_list && $index[$cat_id]['allow_mod_desc'])
{
	$template->assign_var('S_MOD_LIST', true);

	if ($test)
	{
		$template->assign_block_vars('modlisttest', array('MOD_TEST' => $test));
	}

	if ($mod_desc)
	{
		$template->assign_block_vars('modlistdesc', array('MOD_DESC' => $mod_desc));
	}

	if ($warning)
	{
		$template->assign_block_vars('modwarning', array('MOD_WARNING' => $warning));
	}

	if ($require)
	{
		$template->assign_block_vars('modrequire', array('MOD_REQUIRE' => $require));
	}
}

if ($todo)
{
	$template->assign_var('S_MOD_TODO', true);
	$template->assign_block_vars('modtodo', array('MOD_TODO' => $todo));
}

/*
* Check for recurring downloads
*/
if ($config['dl_user_traffic_once'] && !$file_load && !$dl_files['free'] && !$dl_files['extern'] && ($dl_files['file_size'] > $user->data['user_traffic'] ) && !$config['dl_traffic_off'] && DL_USERS_TRAFFICS == true)
{
	$sql = 'SELECT * FROM ' . DL_NOTRAF_TABLE . '
		WHERE user_id = ' . (int) $user->data['user_id'] . '
			AND dl_id = ' . (int) $df_id;
	$result = $db->sql_query($sql);
	$still_count = $db->sql_affectedrows($result);
	$db->sql_freeresult($result);

	if ($still_count)
	{
		$file_load = true;

		$template->assign_var('S_ALLOW_TRAFFICFREE_DOWNLOAD', true);
	}
}

/*
* Hotlink or not hotlink, that is the question :-P
* And we will check a broken download inclusive the visual confirmation here ...
*/
$user_can_alltimes_load = false;

if (($cat_auth['auth_mod'] || ($auth->acl_get('a_') && $user->data['is_registered'])) && !dl_auth::user_banned())
{
	$modcp = ($modcp) ? 1 : 0;
	$user_can_alltimes_load = true;
	$user_is_mod = true;
}
else
{
	$modcp = 0;
	$user_is_mod = false;
}

// Prepare the captcha permissions for the current user
$captcha_active = true;
$user_is_guest = false;
$user_is_admin = false;
$user_is_founder = false;

if (!$user->data['is_registered'])
{
	$user_is_guest = true;
}
else
{
	if ($auth->acl_get('a_'))
	{
		$user_is_admin = true;
	}

	if ($user->data['user_type'] == USER_FOUNDER)
	{
		$user_is_founder = true;
	}
}

switch ($config['dl_download_vc'])
{
	case 0:
		$captcha_active = false;
	break;

	case 1:
		if (!$user_is_guest)
		{
			$captcha_active = false;
		}
	break;

	case 2:
		if ($user_is_mod || $user_is_admin || $user_is_founder)
		{
			$captcha_active = false;
		}
	break;

	case 3:
		if ($user_is_admin || $user_is_founder)
		{
			$captcha_active = false;
		}
	break;

	case 4:
		if ($user_is_founder)
		{
			$captcha_active = false;
		}
	break;
}

if (($file_load || $user_can_alltimes_load) && !$user->data['is_bot'])
{
	if (!$dl_files['broken'] || ($dl_files['broken'] && !$config['dl_report_broken_lock']) || $user_can_alltimes_load)
	{
		if ($config['dl_prevent_hotlink'])
		{
			$hotlink_id = md5($user->data['user_id'] . time() . $df_id . $user->data['session_id']);

			$sql = 'INSERT INTO ' . DL_HOTLINK_TABLE . ' ' . $db->sql_build_array('INSERT', array(
				'user_id'		=> $user->data['user_id'],
				'session_id'	=> $user->data['session_id'],
				'hotlink_id'	=> $hotlink_id));
			$db->sql_query($sql);
		}
		else
		{
			$hotlink_id = '';
		}

		$error = array();

		$s_hidden_fields = array(
			'df_id'			=> $df_id,
			'modcp'			=> $modcp,
			'cat_id'		=> $cat_id,
			'hotlink_id'	=> $hotlink_id,
			'submit'		=> true,
		);

		if (!$captcha_active)
		{
			$s_hidden_fields = array_merge($s_hidden_fields, array('view' => 'load'));
		}
		else
		{
			$s_hidden_fields = array_merge($s_hidden_fields, array('view' => 'detail'));
		}

		$sql = 'SELECT v.ver_id, v.ver_change_time, v.ver_version, u.username FROM ' . DL_VERSIONS_TABLE . ' v
			LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = v.ver_change_user
			WHERE v.dl_id = ' . (int) $df_id . '
			ORDER BY v.ver_version DESC, v.ver_change_time DESC';
		$result = $db->sql_query($sql);
		$total_releases = $db->sql_affectedrows($result);

		if ($total_releases)
		{
			$s_select_version = '<select name="file_version">';
			$s_select_version .= '<option value="0" selected="selected">' . $user->lang['DL_VERSION_CURRENT'] . '</option>';

			while ($row = $db->sql_fetchrow($result))
			{
				$ver_id			= $row['ver_id'];
				$ver_version	= $row['ver_version'];
				$ver_time		= $user->format_date($row['ver_change_time']);
				$ver_username	= ($row['username']) ? ' [ ' . $row['username'] . ' ]' : '';

				$s_select_version .= '<option value="' . $ver_id . '">' . $ver_version . ' - ' . $ver_time . $ver_username . '</option>';
			}

			$s_select_version .= '</select>';
		}
		else
		{
			$s_select_version = '<input type="hidden" name="file_version" value="0" />';
		}

		$db->sql_freeresult($result);


		$template->assign_block_vars('download_button', array(
			'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
			'S_HOTLINK_ID'		=> $hotlink_id,
			'S_DL_WINDOW'		=> ($dl_files['extern'] && $config['dl_ext_new_window']) ? 'target="_blank"' : '',
			'S_DL_VERSION'		=> $s_select_version,
			'U_DOWNLOAD'		=> append_sid("{$phpbb_root_path}downloads.$phpEx"),
		));

		add_form_key('dl_load');

		if ($captcha_active)
		{
			$code_match = false;

			$template->assign_var('S_VC', true);

			include($phpbb_root_path . 'includes/captcha/captcha_factory.' . $phpEx);
			$captcha = phpbb_captcha_factory::get_instance($config['captcha_plugin']);
			$captcha->init(CONFIRM_POST);

	        if ($submit)
	        {
				$vc_response = $captcha->validate();

		        if ($vc_response)
		        {
		            $error[] = $vc_response;
		        }

		        if (!sizeof($error))
		        {
					$captcha->reset();
					$code_match = true;
		        }
				else if (sizeof($error))
		        {
		        	$template->assign_block_vars('dl_error', array(
						'DL_ERROR' => $error[0],
					));
		        }
				else if ($captcha->is_solved())
		        {
		            $s_hidden_c_fields = $captcha->get_hidden_fields();
					$code_match = false;
		        }
			}

			if (!$captcha->is_solved() || !$code_match)
			{
				$template->assign_vars(array(
					'S_HIDDEN_FIELDS'	=> (isset($s_hidden_c_fields)) ? build_hidden_fields($s_hidden_c_fields) : '',
		            'S_CONFIRM_CODE'	=> true,
		            'CAPTCHA_TEMPLATE'	=> $captcha->get_template(),
				));
			}
		}
		else
		{
			$code_match = true;
		}

		if ($submit && $code_match)
		{
			// check form
			if (!check_form_key('dl_load'))
			{
				trigger_error($user->lang['FORM_INVALID'], E_USER_WARNING);
			}

			$code = request_var('confirm_code', '');

			if ($code)
			{
				$sql = 'INSERT INTO ' . DL_HOTLINK_TABLE . ' ' . $db->sql_build_array('INSERT', array(
					'user_id'		=> $user->data['user_id'],
					'session_id'	=> $user->data['session_id'],
					'hotlink_id'	=> 'dlvc',
					'code'			=> $code));
				$db->sql_query($sql);
			}

			redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=load&hotlink_id=$hotlink_id&code=$code&df_id=$df_id&modcp=$modcp&cat_id=$cat_id&file_version=$file_version"));
		}
	}
}

/*
* Display the link ro report the download as broken
*/
if ($config['dl_report_broken'] && !$dl_files['broken'] && !$user->data['is_bot'])
{
	if ($user->data['is_registered'] || (!$user->data['is_registered'] && $config['dl_report_broken'] == 1))
	{
		$template->assign_var('S_REPORT_BROKEN_DL', true);
		$template->assign_block_vars('report_broken_dl', array(
			'U_BROKEN_DOWNLOAD' => append_sid("{$phpbb_root_path}downloads.$phpEx", "view=broken&amp;df_id=$df_id&amp;cat_id=$cat_id"))
		);
	}
}

/*
* Second part of the report link
*/
if ($dl_files['broken'] && !$user->data['is_bot'])
{
	if ($index[$cat_id]['auth_mod'] || $cat_auth['auth_mod'] || ($auth->acl_get('a_') && $user->data['is_registered']))
	{
		$template->assign_var('S_DL_BROKEN_MOD', true);
		$template->assign_block_vars('dl_broken_mod', array(
			'U_REPORT' => append_sid("{$phpbb_root_path}downloads.$phpEx", "view=unbroken&amp;df_id=$df_id&amp;cat_id=$cat_id"))
		);
	}

	if (!$config['dl_report_broken_message'] || ($config['dl_report_broken_lock'] && $config['dl_report_broken_message']))
	{
		$template->assign_var('S_DL_BROKEN_CUR', true);
	}
}

/*
* Send the values to the template to be able to read something *g*
*/
$template->assign_block_vars('downloads', array(
	'DESCRIPTION'			=> $description,
	'MINI_IMG'				=> $mini_icon,
	'HACK_VERSION'			=> $hack_version,
	'LONG_DESC'				=> $long_desc,
	'STATUS'				=> $status,
	'FILE_SIZE'				=> $file_size_out,
	'FILE_KLICKS'			=> $file_klicks,
	'FILE_OVERALL_KLICKS'	=> $file_overall_klicks,
	'FILE_NAME'				=> ($dl_files['extern']) ? $user->lang['DL_EXTERN'] : $file_name,
	'LAST_TIME'				=> $last_time,
	'ADD_USER'				=> ($add_user != '') ? sprintf($user->lang['DL_ADD_USER'], $add_time, $add_user) : '',
	'CHANGE_USER'			=> ($change_user != '') ? sprintf($user->lang['DL_CHANGE_USER'], $change_time, $change_user) : '')
);

/*
* Enabled Bug Tracker for this download category?
*/
if ($index[$cat_id]['bug_tracker'] && !$user->data['is_bot'])
{
	$template->assign_block_vars('downloads.bug_tracker', array(
		'U_BUG_TRACKER'			=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;df_id=$df_id"))
	);
}

/*
* Thumbnails? Okay, getting some thumbs, if they exists...
*/
if ($index[$cat_id]['allow_thumbs'] && $config['dl_thumb_fsize'])
{
	$first_thumb_exists	= false;
	$more_thumbs_exists	= false;

	if (@file_exists($phpbb_root_path . 'dl_mod/thumbs/' . $dl_files['thumbnail']) && $dl_files['thumbnail'])
	{
		if (!$total_images)
		{
			$template->assign_var('S_DL_LYTEBOX', true);
		}

		$first_thumb_exists = true;
	}

	if (isset($thumbs_ary) && sizeof($thumbs_ary))
	{
		$more_thumbs_exists = true;
	}

	if ($first_thumb_exists)
	{
		if ($more_thumbs_exists)
		{
			$thumbs_ary = array_merge(array(0 => array(
				'img_id'	=> 0,
				'dl_id'		=> $df_id,
				'img_name'	=> $dl_files['thumbnail'],
				'img_title'	=> $description,
			)), $thumbs_ary);

		}
		else
		{
			$thumbs_ary = array(0 => array(
				'img_id'	=> 0,
				'dl_id'		=> $df_id,
				'img_name'	=> $dl_files['thumbnail'],
				'img_title'	=> $description,
			));
		}
	}

	if ($first_thumb_exists || $more_thumbs_exists)
	{
		$drop_images = array();

		foreach ($thumbs_ary as $key => $value)
		{
			if (@file_exists($phpbb_root_path . 'dl_mod/thumbs/' . $thumbs_ary[$key]['img_name']))
			{
				$template->assign_block_vars('downloads.thumbnail', array(
					'THUMBNAIL_LINK'	=> $phpbb_root_path . 'dl_mod/thumbs/' . str_replace(" ", "%20", $thumbs_ary[$key]['img_name']),
					'THUMBNAIL_NAME'	=> $thumbs_ary[$key]['img_title'])
				);
			}
			else
			{
				$drop_images[] = $thumbs_ary[$key]['img_id'];
			}
		}

		if (sizeof($drop_images))
		{
			$sql = 'DELETE FROM ' . DL_IMAGES_TABLE . '
				WHERE dl_id = ' . (int) $df_id . '
					AND ' . $db->sql_in_set('img_id', array_map('intval', $drop_images));
			$db->sql_query($sql);
		}
	}
}

/*
* Urgh, the real filetime..... Heavy information, very important :D
*/
if ($config['dl_show_real_filetime'] && !$dl_files['extern'])
{
	if (@file_exists($phpbb_root_path . $config['dl_download_dir'] . $index[$cat_id]['cat_path'] . $real_file))
	{
		$template->assign_block_vars('downloads.real_filetime', array(
			'REAL_FILETIME'		=> $user->format_date(@filemtime($phpbb_root_path . $config['dl_download_dir'] . $index[$cat_id]['cat_path'] . $real_file)))
		);
	}
}

/*
* Like to rate? Do it!
*/
$rating_points = $dl_files['rating'];

$s_rating_perm = false;

if ($config['dl_enable_rate'])
{
	if ((!$rating_points || $rating_access) && $user->data['is_registered'])
	{
		$s_rating_perm = true;
	}

	if ($ratings)
	{
		$rating_count_text = '&nbsp;[ '.$ratings.' ]';
	}
	else
	{
		$rating_count_text = '';
	}

	$template->assign_vars(array(
		'RATING_IMG'	=> dl_format::rating_img($rating_points, $s_rating_perm, $df_id),
		'RATINGS'		=> $rating_count_text,
		'DF_ID'			=> $df_id,
		'PHPEX'			=> $phpEx,
	));
}

/*
* Some user like to link to each favorite page, download, programm, friend, house friend... ahrrrrrrggggg...
*/
if ($user->data['is_registered'] && !$config['dl_disable_email'])
{
	$sql = 'SELECT fav_id FROM ' . DL_FAVORITES_TABLE . '
		WHERE fav_dl_id = ' . (int) $df_id . '
			AND fav_user_id = ' . (int) $user->data['user_id'];
	$result = $db->sql_query($sql);
	$fav_id = $db->sql_fetchfield('fav_id');
	$db->sql_freeresult($result);

	$template->assign_var('S_FAV_BLOCK', true);

	if ($fav_id)
	{
		$l_favorite = $user->lang['DL_FAVORITE_DROP'];
		$u_favorite = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=unfav&amp;df_id=$df_id&amp;cat_id=$cat_id&amp;fav_id=$fav_id");
	}
	else
	{
		$l_favorite = $user->lang['DL_FAVORITE_ADD'];
		$u_favorite = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=fav&amp;df_id=$df_id&amp;cat_id=$cat_id");
	}
}
else
{
	$l_favorite = '';
	$u_favorite = '';
}

$file_id	= $dl_files['id'];
$cat_id		= $dl_files['cat'];

/*
* Can we edit the download? Yes we can, or not?
*/
if (!$user->data['is_bot'] && dl_auth::user_auth($dl_files['cat'], 'auth_mod') || ($config['dl_edit_own_downloads'] && $dl_files['add_user'] == $user->data['user_id']))
{
	$template->assign_var('S_EDIT_BUTTON', true);

	if ($index[$cat_id]['allow_thumbs'] && $config['dl_thumb_fsize'] && $dl_files['thumbnail'])
	{
		$template->assign_var('S_EDIT_THUMBS_BUTTON', true);
	}
}

/*
* A little bit more values and strings for the template *bfg*
*/
$template->assign_vars(array(
	'HASH_TAB'		=> $hash_tab,
	'FAVORITE'		=> $l_favorite,
	'EDIT_IMG'		=> $user->lang['DL_EDIT_FILE'],
	'CAT_RULE'		=> (isset($cat_rule)) ? $cat_rule : '',
	'CAT_TRAFFIC'	=> (isset($cat_traffic)) ? sprintf($user->lang['DL_CAT_TRAFFIC_MAIN'], $cat_traffic) : '',

	'I_DL_BUTTON'	=> $user->img('dl_button', $user->lang['DL_DOWNLOAD'], false, '', 'src'),
	'S_DL_ACTION'	=> append_sid("{$phpbb_root_path}downloads.$phpEx"),
	'S_ENABLE_RATE'	=> (isset($config['dl_enable_rate']) && $config['dl_enable_rate']) ? true : false,

	'U_TOPIC'		=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", "t=" . $dl_files['dl_topic']),
	'U_EDIT'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=edit&amp;df_id=$file_id&amp;cat_id=$cat_id"),
	'U_EDIT_THUMBS'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=thumbs&amp;df_id=$file_id&amp;cat_id=$cat_id"),
	'U_FAVORITE'	=> $u_favorite,
	'U_DL_SEARCH'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=search"),
));

if ($dl_files['dl_topic'])
{
	$template->assign_var('S_SHOW_TOPIC_LINK', true);
}

/**
* Custom Download Fields
* Taken from memberlist.php phpBB 3.0.7-PL1
*/
$dl_fields = array();
include($phpbb_root_path . 'includes/functions_dl_fields.' . $phpEx);
$cp = new custom_profile();
$dl_fields = $cp->generate_profile_fields_template('grab', $file_id);
$dl_fields = (isset($dl_fields[$file_id])) ? $cp->generate_profile_fields_template('show', false, $dl_fields[$file_id]) : array();

if (isset($dl_fields['row']) && sizeof($dl_fields['row']))
{
	$template->assign_var('S_DL_FIELDS', true);

	if (!empty($dl_fields['row']))
	{
		$template->assign_vars($dl_fields['row']);
	}

	if (!empty($dl_fields['blockrow']))
	{
		foreach ($dl_fields['blockrow'] as $field_data)
		{
			$template->assign_block_vars('custom_fields', $field_data);
		}
	}
}

if (($mod_list && $index[$cat_id]['allow_mod_desc']) || $todo || (isset($dl_fields['row']) && sizeof($dl_fields['row'])))
{
	$extra_tab = true;
}
else
{
	$extra_tab = false;
}

$detail_cat_names = array(
	0 => $user->lang['DL_FILE_DESCRIPTION'],
	1 => $user->lang['DL_DETAIL'],
	2 => ($s_comments_tab) ? $user->lang['DL_LAST_COMMENT'] : '',
	3 => ($extra_tab) ? $user->lang['DL_MOD_LIST_SHORT'] : '',
	4 => ($hash_tab) ? $user->lang['DL_MOD_FILE_HASH_TABLE'] : '',
);

for ($i = 0; $i < sizeof($detail_cat_names); $i++)
{
	if ($detail_cat_names[$i])
	{
		$template->assign_block_vars('category', array(
			'CAT_NAME'	=> $detail_cat_names[$i],
			'CAT_ID'	=> $i,
		));
	}
}

/**
* Find similar downloads
*/	
if ($config['dl_similar_dl'])
{
	$stopword_file = $phpbb_root_path . 'dl_mod/dl_stopwords.txt';
	$stopwords = array();
	
	if (file_exists($stopword_file))
	{
		$stopwords = array_map('trim', file($stopword_file));
	}
	
	$description = $dl_files['description'];
	
	if (sizeof($stopwords))
	{
		foreach ($stopwords as $key => $value)
		{
			$description = preg_replace('/\b' . $stopwords[$key] . '\b/iu', '', $description);
		}
	
		$description = trim($description);
	}
	
	$sql = 'SELECT id, description, desc_uid, desc_bitfield, desc_flags FROM ' . DOWNLOADS_TABLE . "
		WHERE MATCH (description) AGAINST ('" . $db->sql_escape($description) . "')
			AND id <> " . (int) $df_id . '
			AND cat = ' . (int) $cat_id . '
		ORDER BY description';
	$result = $db->sql_query_limit($sql, $config['dl_similar_limit']);
	
	while ($row = $db->sql_fetchrow($result))
	{
		$similar_id		= $row['id'];
		$similar_desc	= $row['description'];
		$desc_uid		= $dl_files['desc_uid'];
		$desc_bitfield	= $dl_files['desc_bitfield'];
		$desc_flags		= $dl_files['desc_flags'];
		$similar_desc	= generate_text_for_display($similar_desc, $desc_uid, $desc_bitfield, $desc_flags);
	
		$template->assign_block_vars('similar_dl', array(
			'DOWNLOAD'		=> $similar_desc,
			'U_DOWNLOAD'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$similar_id"),
		));
	}
	
	$db->sql_freeresult($result);	
}

/*
* The end... Yes? Yes!
*/

?>