<?php

/**
*
* @mod package		Download Mod 6
* @file				dl_upload.php 46 2014/11/12 OXPUS
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

$cat_auth = array();
$cat_auth = dl_auth::dl_cat_auth($cat_id);

$physical_size = dl_physical::read_dl_sizes($phpbb_root_path . $config['dl_download_dir']);

if ($physical_size >= $config['dl_physical_quota'])
{
	trigger_error('DL_BLUE_EXPLAIN');
}

if (($config['dl_stop_uploads'] && !$auth->acl_get('a_')) || !sizeof($index) || (!$cat_auth['auth_up'] && !$index[$cat_id]['auth_up'] && !$auth->acl_get('a_')))
{
	trigger_error('DL_NO_PERMISSION');
}

// Initiate custom fields
include($phpbb_root_path . 'includes/functions_dl_fields.' . $phpEx);

$cp = new custom_profile();

if ($submit)
{
	if (!check_form_key('dl_upload'))
	{
		trigger_error('FORM_INVALID');
	}

	$approve			= request_var('approve', 0);
	$description		= utf8_normalize_nfc(request_var('description', '', true));
	$file_traffic		= request_var('file_traffic', 0);
	$long_desc			= utf8_normalize_nfc(request_var('long_desc', '', true));
	$file_name_name		= utf8_normalize_nfc(request_var('file_name', '', true));

	$file_free			= request_var('file_free', 0);
	$file_extern		= request_var('file_extern', 0);
	$file_extern_size	= request_var('file_extern_size', '');

	$test				= utf8_normalize_nfc(request_var('test', '', true));
	$require			= utf8_normalize_nfc(request_var('require', '', true));
	$todo				= utf8_normalize_nfc(request_var('todo', '', true));
	$warning			= utf8_normalize_nfc(request_var('warning', '', true));
	$mod_desc			= utf8_normalize_nfc(request_var('mod_desc', '', true));
	$mod_list			= request_var('mod_list', 0);
	$mod_list			= ($mod_list) ? 1 : 0;

	$send_notify			= request_var('send_notify', 0);
	$disable_popup_notify	= request_var('disable_popup_notify', 0);

	$hacklist				= request_var('hacklist', 0);
	$hack_author			= utf8_normalize_nfc(request_var('hack_author', '', true));
	$hack_author_email		= utf8_normalize_nfc(request_var('hack_author_email', '', true));
	$hack_author_website	= utf8_normalize_nfc(request_var('hack_author_website', '', true));
	$hack_version			= utf8_normalize_nfc(request_var('hack_version', '', true));
	$hack_dl_url			= utf8_normalize_nfc(request_var('hack_dl_url', '', true));

	$allow_bbcode		= ($config['allow_bbcode']) ? true : false;
	$allow_urls			= true;
	$allow_smilies		= ($config['allow_smilies']) ? true : false;
	$desc_uid			= '';
	$desc_bitfield		= '';
	$long_desc_uid		= '';
	$long_desc_bitfield	= '';
	$mod_desc_uid		= '';
	$mod_desc_bitfield	= '';
	$warn_uid			= '';
	$warn_bitfield		= '';
	$todo_uid			= '';
	$todo_bitfield		= '';
	$desc_flags			= 0;
	$long_desc_flags	= 0;
	$mod_desc_flags		= 0;
	$warn_flags			= 0;
	$todo_flags			= 0;

	generate_text_for_storage($description, $desc_uid, $desc_bitfield, $desc_flags, $allow_bbcode, $allow_urls, $allow_smilies);
	generate_text_for_storage($long_desc, $long_desc_uid, $long_desc_bitfield, $long_desc_flags, $allow_bbcode, $allow_urls, $allow_smilies);
	generate_text_for_storage($mod_desc, $mod_desc_uid, $mod_desc_bitfield, $mod_desc_flags, $allow_bbcode, $allow_urls, $allow_smilies);
	generate_text_for_storage($warning, $warn_uid, $warn_bitfield, $warn_flags, $allow_bbcode, $allow_urls, $allow_smilies);
	generate_text_for_storage($todo, $todo_uid, $todo_bitfield, $todo_flags, $allow_bbcode, $allow_urls, $allow_smilies);
	
	if (!$description)
	{
		trigger_error($user->lang['NO_SUBJECT'], E_USER_WARNING);
	}		

	if ($file_extern)
	{
		$file_traffic = 0;
	}
	else
	{
		$file_traffic = dl_format::resize_value('dl_traffic_size', $file_traffic);
	}

	if (!class_exists('fileupload'))
	{
		include($phpbb_root_path . 'includes/functions_upload.' . $phpEx);
	}

	$ext_blacklist = dl_auth::get_ext_blacklist();

	$fileupload = new fileupload();
	$fileupload->fileupload('');

	$user->add_lang('posting');

	if ($config['dl_thumb_fsize'] && $index[$cat_id]['allow_thumbs'])
	{
		$thumb_file = $fileupload->form_upload('thumb_name');

		$thumb_size = $thumb_file->filesize;
		$thumb_temp = $thumb_file->filename;
		$thumb_name = $thumb_file->realname;

		$error_count = sizeof($thumb_file->error);
		if ($error_count > 1 && $thumb_file->uploadname)
		{
			$thumb_file->remove();
			trigger_error(implode('<br />', $thumb_file->error), E_USER_ERROR);
		}

		$thumb_file->error = array();

		if ($thumb_name)
		{
			$pic_size = @getimagesize($thumb_temp);
			$pic_width = $pic_size[0];
			$pic_height = $pic_size[1];

			if (!$pic_width || !$pic_height)
			{
				trigger_error($user->lang['DL_UPLOAD_ERROR'], E_USER_ERROR);
			}

			if ($pic_width > $config['dl_thumb_xsize'] || $pic_height > $config['dl_thumb_ysize'] || (sprintf("%u", @filesize($thumb_temp) > $config['dl_thumb_fsize'])))
			{
				trigger_error($user->lang['DL_THUMB_TO_BIG'], E_USER_ERROR);
			}
		}
	}

	if (!$file_extern)
	{
		$upload_file = $fileupload->form_upload('dl_name');

		$file_size = $upload_file->filesize;
		$file_temp = $upload_file->filename;
		$file_name = $upload_file->realname;

		if ($config['dl_enable_blacklist'])
		{
			$extention = str_replace('.', '', trim(strrchr(strtolower($file_name), '.')));

			if (in_array($extention, $ext_blacklist))
			{
				trigger_error($user->lang['DL_FORBIDDEN_EXTENTION'], E_USER_ERROR);
			}
		}

		$upload_file->error = array();

		$error_count = sizeof($upload_file->error);
		if ($error_count > 1 && $upload_file->uploadname)
		{
			$upload_file->remove();
			trigger_error(implode('<br />', $upload_file->error), E_USER_ERROR);
		}

		if (!$file_name)
		{
			trigger_error($user->lang['DL_NO_FILENAME_ENTERED'], E_USER_ERROR);
		}

		if (!$config['dl_traffic_off'])
		{
			$remain_traffic = 0;

			if ($user->data['is_registered'] && DL_OVERALL_TRAFFICS == true)
			{
				$remain_traffic = $config['dl_overall_traffic'] - $config['dl_remain_traffic'];
			}
			else if (!$user->data['is_registered'] && DL_GUESTS_TRAFFICS == true)
			{
				$remain_traffic = $config['dl_overall_guest_traffic'] - $config['dl_remain_guest_traffic'];
			}

			if($file_size == 0 || ($remain_traffic && $file_size > $remain_traffic && $config['dl_upload_traffic_count']))
			{
				trigger_error($user->lang['DL_NO_UPLOAD_TRAFFIC'], E_USER_ERROR);
			}
		}

		$dl_path = $index[$cat_id]['cat_path'];

		$real_file = md5($file_name);

		$i = 0;
		while(@file_exists($phpbb_root_path . $config['dl_download_dir'] . $dl_path . $real_file))
		{
			$real_file = md5($i . $file_name);
			$i++;
		}
	}
	else
	{
		if (empty($file_name_name))
		{
			trigger_error($user->lang['DL_NO_EXTERNAL_URL'], E_USER_ERROR);
		}

		$file_name = $file_name_name;
		$file_size = dl_format::resize_value('dl_extern_size', $file_extern_size);
		$real_file = '';
	}

	// validate custom profile fields
	$error = $cp_data = $cp_error = array();
	$cp->submit_cp_field($user->get_iso_lang_id(), $cp_data, $error);

	// Stop here, if custom fields are invalid!
	if (sizeof($error))
	{
		trigger_error(implode('<br />', $error), E_USER_WARNING);
	}

	if($cat_id)
	{
		if (!$file_extern)
		{
			$upload_file->realname = $real_file;
			$upload_file->move_file($config['dl_download_dir'] . $dl_path, false, false, CHMOD_ALL);
			@chmod($upload_file->destination_file, 0777);

			$error_count = sizeof($upload_file->error);
			if ($error_count)
			{
				$upload_file->remove();
				trigger_error(implode('<br />', $upload_file->error), E_USER_ERROR);
			}

			$hash_method = $config['dl_file_hash_algo'];
			$func_hash = $hash_method . '_file';
			$file_hash = $func_hash($phpbb_root_path . $config['dl_download_dir'] . $dl_path . $real_file);		
		}
		else
		{
			$file_hash = '';
		}

		$current_time = time();
		$current_user = $user->data['user_id'];

		$approve = ($index[$cat_id]['must_approve'] && !$cat_auth['auth_mod'] && !$index[$cat_id]['auth_mod'] && !($auth->acl_get('a_') && $user->data['is_registered'])) ? 0 : $approve;

		unset($sql_array);

		if (!$cat_auth['auth_mod'] && !$index[$cat_id]['auth_mod'] && !$index[$cat_id]['allow_mod_desc'] && !($auth->acl_get('a_') && $user->data['is_registered']))
		{
			$test = $require = $warning = $mod_desc = '';
		}

		$sql_array = array(
				'file_name'				=> $file_name,
				'real_file'				=> $real_file,
				'file_hash'				=> $file_hash,
				'cat'					=> $cat_id,
				'description'			=> $description,
				'long_desc'				=> $long_desc,
				'free'					=> $file_free,
				'extern'				=> $file_extern,
				'desc_uid'				=> $desc_uid,
				'desc_bitfield'			=> $desc_bitfield,
				'desc_flags'			=> $desc_flags,
				'long_desc_uid'			=> $long_desc_uid,
				'long_desc_bitfield'	=> $long_desc_bitfield,
				'long_desc_flags'		=> $long_desc_flags,
				'hacklist'				=> $hacklist,
				'hack_author'			=> $hack_author,
				'hack_author_email'		=> $hack_author_email,
				'hack_author_website'	=> $hack_author_website,
				'hack_version'			=> $hack_version,
				'hack_dl_url'			=> $hack_dl_url,
				'todo'					=> $todo,
				'approve'				=> $approve,
				'file_size'				=> $file_size,
				'change_time'			=> $current_time,
				'add_time'				=> $current_time,
				'change_user'			=> $current_user,
				'add_user'				=> $current_user,
				'test'					=> $test,
				'req'					=> $require,
				'warning'				=> $warning,
				'mod_desc'				=> $mod_desc,
				'file_traffic'			=> $file_traffic,
				'todo_uid'				=> $todo_uid,
				'todo_bitfield'			=> $todo_bitfield,
				'todo_flags'			=> $todo_flags);

		if (!$cat_auth['auth_mod'] && !$index[$cat_id]['auth_mod'] && !$index[$cat_id]['allow_mod_desc'] && !($auth->acl_get('a_') && $user->data['is_registered']))
		{
			$sql = 'INSERT INTO ' . DOWNLOADS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_array);
		}
		else
		{
			$sql_array = array_merge($sql_array, array(
				'mod_list'				=> $mod_list,
				'mod_desc_uid'			=> $mod_desc_uid,
				'mod_desc_bitfield'		=> $mod_desc_bitfield,
				'mod_desc_flags'		=> $mod_desc_flags,
				'warn_uid'				=> $warn_uid,
				'warn_bitfield'			=> $warn_bitfield,
				'warn_flags'			=> $warn_flags));

			$sql = 'INSERT INTO ' . DOWNLOADS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_array);
		}

		$db->sql_query($sql);

		$next_id = $db->sql_nextid();

		// Update Custom Fields
		$cp->update_profile_field_data($next_id, $cp_data);

		if (isset($thumb_name) && $thumb_name != '')
		{
			$thumb_file->realname = $next_id . '_' . $thumb_name;
			$thumb_file->move_file('dl_mod/thumbs/', false, false, CHMOD_ALL);
			@chmod($thumb_file->destination_file, 0777);

			$thumb_message = '<br />' . $user->lang['DL_THUMB_UPLOAD'];

			$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
				'thumbnail' => $next_id . '_' . $thumb_name)) . ' WHERE id = ' . (int) $next_id;
			$db->sql_query($sql);
		}
		else
		{
			$thumb_message = '';
		}

		if ($index[$cat_id]['statistics'])
		{
			if ($index[$cat_id]['stats_prune'])
			{
				$stat_prune = dl_main::dl_prune_stats($cat_id, $index[$cat_id]['stats_prune']);
			}

			$browser = dl_init::dl_client($user->data['session_browser']);

			$sql = 'INSERT INTO ' . DL_STATS_TABLE . ' ' . $db->sql_build_array('INSERT', array(
				'cat_id'		=> $cat_id,
				'id'			=> $next_id,
				'user_id'		=> $user->data['user_id'],
				'username'		=> $user->data['username'],
				'traffic'		=> $file_size,
				'direction'		=> 1,
				'user_ip'		=> $user->data['session_ip'],
				'browser'		=> $browser,
				'time_stamp'	=> time()));
			$db->sql_query($sql);
		}

		if ($approve)
		{
			$processing_user = dl_auth::dl_auth_users($cat_id, 'auth_dl');

			$email_template = 'downloads_new_notify';

			$sql = 'SELECT user_email, username, user_lang FROM ' . USERS_TABLE . '
				WHERE user_allow_new_download_email = 1
					AND ' . $db->sql_in_set('user_id', explode(',', $processing_user));

			dl_topic::gen_dl_topic($next_id);
		}
		else
		{
			$processing_user = dl_auth::dl_auth_users($cat_id, 'auth_mod');

			$email_template = 'downloads_approve_notify';

			$sql = 'SELECT user_email, username, user_lang FROM ' . USERS_TABLE . '
				WHERE user_allow_new_download_email = 1
					AND (' . $db->sql_in_set('user_id', explode(',', $processing_user)) . '
					OR user_type = ' . USER_FOUNDER . ')';
		}

		if (!$config['dl_disable_email'] && !$send_notify)
		{
			$mail_data = array(
				'query'				=> $sql,
				'email_template'	=> $email_template,
				'description'		=> $description,
				'long_desc'			=> $long_desc,
				'cat_name'			=> $index[$cat_id]['cat_name_nav'],
				'cat_id'			=> $cat_id,
			);

			dl_email::send_dl_notify($mail_data);
		}

		if (!$config['dl_disable_popup'] && !$disable_popup_notify && $approve)
		{
			$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
				'user_new_download' => 1)) . '
					WHERE user_allow_new_download_popup = 1
					AND ' . $db->sql_in_set('user_id', explode(',', $processing_user));
			$db->sql_query($sql);
		}


		if ($config['dl_upload_traffic_count'] && !$file_extern && !$config['dl_traffic_off'])
		{
			if ($user->data['is_registered'] && DL_OVERALL_TRAFFICS == true)
			{
				$config['dl_remain_traffic'] += $file_size;
	
				$sql = 'UPDATE ' . DL_REM_TRAF_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'config_value' => $config['dl_remain_traffic'])) . " WHERE config_name = 'dl_remain_traffic'";
				$db->sql_query($sql);
			}
			else if (!$user->data['is_registered'] && DL_GUESTS_TRAFFICS == true)
			{
				$config['dl_remain_guest_traffic'] += $file_size;
	
				$sql = 'UPDATE ' . DL_REM_TRAF_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'config_value' => $config['dl_remain_guest_traffic'])) . " WHERE config_name = 'dl_remain_guest_traffic'";
				$db->sql_query($sql);
			}
		}

		$approve_message = ($approve) ? '' : '<br />' . $user->lang['DL_MUST_BE_APPROVED'];

		$message = $user->lang['DOWNLOAD_ADDED'] . $thumb_message . $approve_message . '<br /><br />' . sprintf($user->lang['CLICK_RETURN_DOWNLOADS'], '<a href="' . append_sid("{$phpbb_root_path}downloads.$phpEx", "cat=$cat_id") . '">', '</a>');

		// Purge the files cache
		@unlink($phpbb_root_path . 'cache/data_dl_cat_counts.' . $phpEx);
		@unlink($phpbb_root_path . 'cache/data_dl_file_preset.' . $phpEx);

		meta_refresh(3, append_sid("downloads.$phpEx", "cat=$cat_id"));

		trigger_error($message);
	}
}

$template->set_filenames(array(
	'body' => 'dl_mod/dl_edit_body.html')
);

$bg_row = 0;

if ($cat_auth['auth_mod'] || $index[$cat_id]['auth_mod'] || ($auth->acl_get('a_') && $user->data['is_registered']))
{
	$template->assign_var('S_MODCP', true);
	$bg_row = 1;
}

if (!$config['dl_disable_email'])
{
	$template->assign_var('S_EMAIL_BLOCK', true);
	$bg_row = 1;
}

if (!$config['dl_disable_popup'] && $config['dl_disable_popup_notify'])
{
	$template->assign_var('S_POPUP_NOTIFY', true);
	$bg_row = 1;
}

if ($index[$cat_id]['allow_thumbs'] && $config['dl_thumb_fsize'])
{
	$template->assign_var('S_ALLOW_THUMBS', true);
}

if ($config['dl_use_hacklist'] && $auth->acl_get('a_') && $user->data['is_registered'])
{
	$template->assign_var('S_USE_HACKLIST', true);
	$hacklist_on = ($bg_row) ? true : 0;
	$bg_row = 1 - $bg_row;
}

if ($index[$cat_id]['allow_mod_desc'])
{
	$template->assign_var('S_ALLOW_EDIT_MOD_DESC', true);
	$mod_block_bg = ($bg_row) ? true : 0;
}

if ($config['dl_upload_traffic_count'] && !$config['dl_traffic_off'])
{
	$template->assign_var('S_UPLOAD_TRAFFIC', true);
}

$s_cat_select = '<select name="cat_id">';
$s_cat_select .= dl_extra::dl_dropdown(0, 0, $cat_id, 'auth_up');
$s_cat_select .= '</select>';

$thumbnail_explain = sprintf($user->lang['DL_THUMB_DIM_SIZE'], $config['dl_thumb_xsize'], $config['dl_thumb_ysize'], dl_format::dl_size($config['dl_thumb_fsize']));

$s_hidden_fields = array();

if (!$cat_auth['auth_mod'] && !$index[$cat_id]['auth_mod'] && !($auth->acl_get('a_') && $user->data['is_registered']))
{
	$approve = ($index[$cat_id]['must_approve']) ? 0 : true;
	$s_hidden_fields = array_merge($s_hidden_fields, array('approve' => $approve));
}

if ($config['dl_disable_email'])
{
	$s_hidden_fields = array_merge($s_hidden_fields, array('send_notify' => 0));
}

$ext_blacklist = dl_auth::get_ext_blacklist();
if (sizeof($ext_blacklist))
{
	$blacklist_explain = '<br />' . sprintf($user->lang['DL_FORBIDDEN_EXT_EXPLAIN'], implode(', ', $ext_blacklist));
}
else
{
	$blacklist_explain = '';
}

$s_check_free = '<select name="file_free">';
$s_check_free .= '<option value="0">' . $user->lang['NO'] . '</option>';
$s_check_free .= '<option value="1">' . $user->lang['YES'] . '</option>';
$s_check_free .= '<option value="2">' . $user->lang['DL_IS_FREE_REG'] . '</option>';
$s_check_free .= '</select>';

$s_traffic_range = '<select name="dl_t_range">';
$s_traffic_range .= '<option value="byte">' . $user->lang['DL_BYTES'] . '</option>';
$s_traffic_range .= '<option value="kb">' . $user->lang['DL_KB'] . '</option>';
$s_traffic_range .= '<option value="mb">' . $user->lang['DL_MB'] . '</option>';
$s_traffic_range .= '<option value="gb">' . $user->lang['DL_GB'] . '</option>';
$s_traffic_range .= '</select>';

$s_file_ext_size_range = '<select name="dl_e_range">';
$s_file_ext_size_range .= '<option value="byte">' . $user->lang['DL_BYTES'] . '</option>';
$s_file_ext_size_range .= '<option value="kb">' . $user->lang['DL_KB'] . '</option>';
$s_file_ext_size_range .= '<option value="mb">' . $user->lang['DL_MB'] . '</option>';
$s_file_ext_size_range .= '<option value="gb">' . $user->lang['DL_GB'] . '</option>';
$s_file_ext_size_range .= '</select>';

$s_hacklist = '<select name="hacklist">';
$s_hacklist .= '<option value="0">' . $user->lang['NO'] . '</option>';
$s_hacklist .= '<option value="1">' . $user->lang['YES'] . '</option>';
$s_hacklist .= '<option value="2">' . $user->lang['DL_MOD_LIST'] . '</option>';
$s_hacklist .= '</select>';

$template->assign_var('S_CAT_CHOOSE', true);

add_form_key('dl_upload');

$dl_files_page_title = $user->lang['DL_UPLOAD'];

$file_size_ary		= dl_format::dl_size(0, 2, 'select');
$file_size			= $file_size_ary['size_out'];
$file_size_range	= $file_size_ary['range'];

$template->assign_vars(array(
	'DL_FILES_TITLE'			=> $dl_files_page_title,
	'DL_THUMBNAIL_SECOND'		=> $thumbnail_explain,
	'EXT_BLACKLIST'				=> $blacklist_explain,

	'L_DL_NAME_EXPLAIN'					=> 'DL_NAME',
	'L_DL_APPROVE_EXPLAIN'				=> 'DL_APPROVE',
	'L_DL_CAT_NAME_EXPLAIN'				=> 'DL_CHOOSE_CATEGORY',
	'L_DL_DESCRIPTION_EXPLAIN'			=> 'DL_FILE_DESCRIPTION',
	'L_DL_EXTERN_EXPLAIN'				=> 'DL_EXTERN_UP',
	'L_DL_HACK_AUTHOR_EXPLAIN'			=> 'DL_HACK_AUTOR',
	'L_DL_HACK_AUTHOR_EMAIL_EXPLAIN'	=> 'DL_HACK_AUTOR_EMAIL',
	'L_DL_HACK_AUTHOR_WEBSITE_EXPLAIN'	=> 'DL_HACK_AUTOR_WEBSITE',
	'L_DL_HACK_DL_URL_EXPLAIN'			=> 'DL_HACK_DL_URL',
	'L_DL_HACK_VERSION_EXPLAIN'			=> 'DL_HACK_VERSION',
	'L_DL_HACKLIST_EXPLAIN'				=> 'DL_HACKLIST',
	'L_DL_IS_FREE_EXPLAIN'				=> 'DL_IS_FREE',
	'L_DL_MOD_DESC_EXPLAIN'				=> 'DL_MOD_DESC',
	'L_DL_MOD_LIST_EXPLAIN'				=> 'DL_MOD_LIST',
	'L_DL_MOD_REQUIRE_EXPLAIN'			=> 'DL_MOD_REQUIRE',
	'L_DL_MOD_TEST_EXPLAIN'				=> 'DL_MOD_TEST',
	'L_DL_MOD_TODO_EXPLAIN'				=> 'DL_MOD_TODO',
	'L_DL_MOD_WARNING_EXPLAIN'			=> 'DL_MOD_WARNING',
	'L_DL_TRAFFIC_EXPLAIN'				=> 'DL_TRAFFIC',
	'L_DL_UPLOAD_FILE_EXPLAIN'			=> 'DL_UPLOAD_FILE',
	'L_DL_THUMBNAIL_EXPLAIN'			=> 'DL_THUMB',
	'L_CHANGE_TIME_EXPLAIN'				=> 'DL_NO_CHANGE_EDIT_TIME',
	'L_DISABLE_POPUP_EXPLAIN'			=> 'DL_DISABLE_POPUP',
	'L_DL_SEND_NOTIFY_EXPLAIN'			=> 'DL_DISABLE_EMAIL',

	'DESCRIPTION'			=> '',
	'SELECT_CAT'			=> $s_cat_select,
	'LONG_DESC'				=> '',
	'URL'					=> '',
	'CHECKEXTERN'			=> '',
	'TRAFFIC'				=> 0,
	'APPROVE'				=> 'checked="checked"',
	'MOD_DESC'				=> '',
	'MOD_LIST'				=> '',
	'MOD_REQUIRE'			=> '',
	'MOD_TEST'				=> '',
	'MOD_TODO'				=> '',
	'MOD_WARNING'			=> '',
	'FILE_EXT_SIZE'			=> $file_size,

	'HACKLIST_BG'			=> (isset($hacklist_on) && $hacklist_on) ? ' bg2' : '',
	'MOD_BLOCK_BG'			=> (isset($mod_block_bg) && $mod_block_bg) ? ' bg2' : '',

	'MAX_UPLOAD_SIZE'		=> sprintf($user->lang['DL_UPLOAD_MAX_FILESIZE'], dl_physical::dl_max_upload_size()),

	'ENCTYPE'	=> 'enctype="multipart/form-data"',

	'S_TODO_LINK_ONOFF'		=> ($config['dl_todo_onoff']) ? true : false,
	'S_CHECK_FREE'			=> $s_check_free,
	'S_TRAFFIC_RANGE'		=> $s_traffic_range,
	'S_FILE_EXT_SIZE_RANGE'	=> $s_file_ext_size_range,
	'S_HACKLIST'			=> $s_hacklist,
	'S_DOWNLOADS_ACTION'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=upload"),
	'S_HIDDEN_FIELDS'		=> build_hidden_fields($s_hidden_fields))
);

// Init and display the custom fields with the existing data
$cp->get_profile_fields($df_id);
$cp->generate_profile_fields($user->get_iso_lang_id());

?>