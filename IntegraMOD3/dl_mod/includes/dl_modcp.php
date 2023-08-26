<?php

/**
*
* @mod package		Download Mod 6
* @file				dl_modcp.php 58 2016/02/23 OXPUS
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

$own_edit = false;
$deny_modcp = true;

if (($action == 'edit' || $action == 'save') && $config['dl_edit_own_downloads'])
{
	$sql = 'SELECT add_user FROM ' . DOWNLOADS_TABLE . '
		WHERE id = ' . (int) $df_id;
	$result = $db->sql_query($sql);
	$add_user = $db->sql_fetchfield('add_user');
	$db->sql_freeresult($result);

	if ($add_user == $user->data['user_id'])
	{
		$own_edit = true;
	}
	else
	{
		$own_edit = false;
	}
}
else
{
	$own_edit = false;
}

if ($own_edit == true)
{
	$access_cat[0] = $cat_id;
	$deny_modcp = false;
}
else
{
	$access_cat = array();
	$access_cat = dl_main::full_index(0, 0, 0, 2);
}

$cat_auth = array();
$cat_auth = dl_auth::dl_cat_auth($cat_id);

if (sizeof($access_cat) || $auth->acl_get('a_'))
{
	$deny_modcp = false;
}

if (isset($index[$cat_id]['auth_mod']) && $index[$cat_id]['auth_mod'])
{
	$deny_modcp = false;
}

if ($cat_id && $cat_auth['auth_mod'])
{
	$deny_modcp = false;
}

if ($action == 'delete')
{
	$deny_modcp = false;
}

if ($deny_modcp)
{
	trigger_error($user->lang['DL_NO_PERMISSION']);
}
else
{
	if ($cancel && $file_option == 3)
	{
		redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&df_id=$df_id"));
	}

	$action = ($move) ? 'move' : $action;
	$action = ($delete) ? 'delete' : $action;
	$action = ($cdelete) ? 'cdelete' : $action;
	$action = ($lock) ? 'lock' : $action;
	$action = ($cancel) ? 'manage' : $action;

	$action = (!$action) ? 'manage' : $action;

	if ((isset($own_edit) && $own_edit == true) && $action != 'edit' && $action != 'save' && (!$auth->acl_get('a_') || $deny_modcp))
	{
		$view = '';
		$action = '';
	}
	else
	{
		$dl_id = (isset($_POST['dlo_id'])) ? $_POST['dlo_id'] : array();

		if ($fmove && ($auth->acl_get('a_') && $user->data['is_registered']))
		{
			if ($fmove == 'ABC')
			{
				$sql = 'SELECT id FROM ' . DOWNLOADS_TABLE . '
					WHERE cat = ' . (int) $cat_id . '
					ORDER BY description ASC';
				$result = $db->sql_query($sql);
			}
			else
			{

				$sql = 'SELECT sort FROM ' . DOWNLOADS_TABLE . '
					WHERE id = ' . (int) $df_id;
				$result = $db->sql_query($sql);
				$sort = $db->sql_fetchfield('sort');
				$db->sql_freeresult($result);

				$sql_move = ($fmove == 1) ? $sort + 15 : $sort - 15;

				$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'sort' => $sql_move)) . ' WHERE id = ' . (int) $df_id;
				$db->sql_query($sql);

				$sql = 'SELECT id FROM ' . DOWNLOADS_TABLE . '
					WHERE cat = ' . (int) $cat_id . '
					ORDER BY sort ASC';
				$result = $db->sql_query($sql);
			}

			$i = 10;

			while($row = $db->sql_fetchrow($result))
			{
				$sql_sort = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'sort' => $i)) . ' WHERE id = ' . (int) $row['id'];
				$db->sql_query($sql_sort);
				$i += 10;
			}

			$db->sql_freeresult($result);

			$action = 'manage';
		}

		$fmove = '';

		$inc_module = true;

		add_form_key('dl_modcp');
		
		// Initiate custom fields
		include($phpbb_root_path . 'includes/functions_dl_fields.' . $phpEx);
		
		$cp = new custom_profile();
		
		/*
		* And now the different work from here
		*/
		if ($action == 'save' && $submit)
		{
			if (!check_form_key('dl_modcp'))
			{
				trigger_error('FORM_INVALID');
			}
		
			if ($file_option == 3)
			{
				if (!sizeof($file_ver_del))
				{
					trigger_error($user->lang['DL_VER_DEL_ERROR'], E_USER_ERROR);
				}
		
				if (!$confirm)
				{
					/*
					* output confirmation page
					*/
					page_header($user->lang['DL_DELETE_FILE_CONFIRM']);
		
					$template->set_filenames(array(
						'body' => 'dl_mod/dl_confirm_body.html')
					);
		
					$template->assign_var('S_DELETE_FILES_CONFIRM', true);
		
					$s_hidden_fields = array(
						'view'			=> 'modcp',
						'action'		=> 'save',
						'cat_id'		=> $cat_id,
						'df_id'			=> $df_id,
						'submit'		=> 1,
						'file_ver_opt'	=> 3,
					);
		
					for ($i = 0; $i < sizeof($file_ver_del); $i++)
					{
						$s_hidden_fields = array_merge($s_hidden_fields, array('file_ver_del[' . $i . ']' => $file_ver_del[$i]));
					}
		
					$template->assign_vars(array(
						'MESSAGE_TITLE' => $user->lang['INFORMATION'],
						'MESSAGE_TEXT' => sprintf($user->lang['DL_CONFIRM_DELETE_VERSIONS']),
		
						'S_CONFIRM_ACTION' => append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp"),
						'S_HIDDEN_FIELDS' => build_hidden_fields($s_hidden_fields))
					);
		
					page_footer();
				}
				else
				{
					$dl_ids = array();
		
					for ($i = 0; $i < sizeof($file_ver_del); $i++)
					{
						$dl_ids[] = intval($file_ver_del[$i]);
					}
		
					if ($del_file)
					{
						$sql = 'SELECT path FROM ' . DL_CAT_TABLE . '
							WHERE id = ' . (int) $cat_id;
						$result = $db->sql_query($sql);
						$path = $db->sql_fetchfield('path');
						$db->sql_freeresult($result);
		
						if (sizeof($dl_ids))
						{
							$sql = 'SELECT ver_real_file FROM ' . DL_VERSIONS_TABLE . '
								WHERE ' . $db->sql_in_set('ver_id', $dl_ids);
							$result = $db->sql_query($sql);
		
							while ($row = $db->sql_fetchrow($result))
							{
								@unlink($phpbb_root_path . $config['dl_download_dir'] . $path . $row['ver_real_file']);
							}
		
							$db->sql_freeresult($result);
						}
					}
		
					if (sizeof($dl_ids))
					{
						$sql = 'DELETE FROM ' . DL_VERSIONS_TABLE . '
							WHERE ' . $db->sql_in_set('ver_id', $dl_ids);
						$db->sql_query($sql);
					}
		
					redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&df_id=$df_id"));
				}
			}
			else
			{
				$approve				= request_var('approve', 0);
				$description			= utf8_normalize_nfc(request_var('description', '', true));
				$file_traffic			= request_var('file_traffic', 0);
				$long_desc				= utf8_normalize_nfc(request_var('long_desc', '', true));
				$file_name				= utf8_normalize_nfc(request_var('file_name', '', true));
		
				$file_free				= request_var('file_free', 0);
				$file_extern			= request_var('file_extern', 0);
				$file_extern_size		= request_var('file_extern_size', '');
		
				$test					= utf8_normalize_nfc(request_var('test', '', true));
				$require				= utf8_normalize_nfc(request_var('require', '', true));
				$todo					= utf8_normalize_nfc(request_var('todo', '', true));
				$warning				= utf8_normalize_nfc(request_var('warning', '', true));
				$mod_desc				= utf8_normalize_nfc(request_var('mod_desc', '', true));
				$mod_list				= request_var('mod_list', 0);
				$mod_list				= ($mod_list) ? 1 : 0;
		
				$send_notify			= request_var('send_notify', 0);
				$disable_popup_notify	= request_var('disable_popup_notify', 0);
				$change_time			= request_var('change_time', 0);
				$del_thumb				= request_var('del_thumb', 0);
				$click_reset			= request_var('click_reset', 0);
		
				$hacklist				= request_var('hacklist', 0);
				$hack_author			= utf8_normalize_nfc(request_var('hack_author', '', true));
				$hack_author_email		= utf8_normalize_nfc(request_var('hack_author_email', '', true));
				$hack_author_website	= utf8_normalize_nfc(request_var('hack_author_website', '', true));
				$hack_version			= utf8_normalize_nfc(request_var('hack_version', '', true));
				$hack_dl_url			= utf8_normalize_nfc(request_var('hack_dl_url', '', true));

				$file_hash			= '';

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
					$file_traffic = dl_format::resize_value('dl_file_traffic', $file_traffic);
				}

				$dl_file = array();
				$dl_file = dl_files::all_files(0, 0, 'ASC', 0, $df_id, true, '*');
		
				$real_file_old	= $dl_file['real_file'];
				$file_name_old	= $dl_file['file_name'];
				$file_size_old	= $dl_file['file_size'];
				$file_cat_old	= $dl_file['cat'];
		
				$ext_blacklist = dl_auth::get_ext_blacklist();
		
				if (!class_exists('fileupload'))
				{
					include($phpbb_root_path . 'includes/functions_upload.' . $phpEx);
				}
		
				$fileupload = new fileupload();
				$fileupload->fileupload('');
		
				$user->add_lang('posting');
		
				if ($config['dl_thumb_fsize'] && $index[$cat_id]['allow_thumbs'] && !$del_thumb)
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
						$pic_size 	= @getimagesize($thumb_temp);
						$pic_width	= $pic_size[0];
						$pic_height	= $pic_size[1];
		
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
		
				if (isset($thumb_name) && $thumb_name != '')
				{
					@unlink($phpbb_root_path . 'dl_mod/thumbs/' . $dl_file['thumbnail']);
					@unlink($phpbb_root_path . 'dl_mod/thumbs/' . $df_id . '_' . $thumb_name);
		
					$thumb_file->realname = $df_id . '_' . $thumb_name;
					$thumb_file->move_file('dl_mod/thumbs/', false, false, CHMOD_ALL);
					@chmod($thumb_file->destination_file, 0777);
		
					$thumb_message = '<br />' . $user->lang['DL_THUMB_UPLOAD'];
		
					$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
						'thumbnail' => $df_id . '_' . $thumb_name)) . ' WHERE id = ' . (int) $df_id;
					$db->sql_query($sql);
				}
				else if ($del_thumb)
				{
					$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
						'thumbnail' => '')) . ' WHERE id = ' . (int) $df_id;
					$db->sql_query($sql);
		
					@unlink($phpbb_root_path . 'dl_mod/thumbs/' . $dl_file['thumbnail']);
		
					$thumb_message = '<br />'.$user->lang['DL_THUMB_DEL'];
				}
				else
				{
					$thumb_message = '';
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
		
					$error_count = sizeof($upload_file->error);
					if ($error_count > 1 && $upload_file->uploadname)
					{
						$upload_file->remove();
						trigger_error(implode('<br />', $upload_file->error), E_USER_ERROR);
					}
		
					$upload_file->error = array();
		
					if ($file_name)
					{
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

							if(!$file_size || ($remain_traffic && $file_size > $remain_traffic && $config['dl_upload_traffic_count']))
							{
								trigger_error($user->lang['DL_NO_UPLOAD_TRAFFIC'], E_USER_ERROR);
							}
						}
		
						$dl_path = $index[$cat_id]['cat_path'];
		
						if ($file_option == 2 && !$file_version)
						{
							@unlink($phpbb_root_path . $config['dl_download_dir'] . $dl_path . $real_file_old);
						}
		
						$real_file_new = md5($file_name);
		
						$i = 1;
						while (file_exists($phpbb_root_path . $config['dl_download_dir'] . $dl_path . $real_file_new))
						{
							$real_file_new = $i . md5($file_name);
							$i++;
						}
		
						if ($index[$cat_id]['statistics'])
						{
							if ($index[$cat_id]['stats_prune'])
							{
								$stat_prune = dl_main::dl_prune_stats($cat_id, $index[$cat_id]['stats_prune']);
							}
		
							$browser = dl_init::dl_client($user->data['session_browser']);
		
							$sql = 'INSERT INTO ' . DL_STATS_TABLE . ' ' . $db->sql_build_array('INSERT', array(
								'cat_id'		=> $new_cat,
								'id'			=> $df_id,
								'user_id'		=> $user->data['user_id'],
								'username'		=> $user->data['username'],
								'traffic'		=> $file_size,
								'direction'		=> 2,
								'user_ip'		=> $user->data['session_ip'],
								'browser'		=> $browser,
								'time_stamp'	=> time()));
							$db->sql_query($sql);
						}
					}
					else
					{
						$real_file_new = $real_file_old;
					}
				}
				else
				{
					$file_size = 0;
					$real_file_new = '';
				}

				if (!$file_name)
				{
					$file_name = $file_name_old;
					$file_size = $file_size_old;
					$file_new = false;
				}
				else
				{
					$file_new = true;
				}

				if ($file_extern)
				{
					$file_size = dl_format::resize_value('dl_extern_size', $file_extern_size);
				}

				if (!$file_extern && $file_name && $file_new)
				{
					$upload_file->realname = $real_file_new;
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
					$file_hash = $func_hash($phpbb_root_path . $config['dl_download_dir'] . $dl_path . $real_file_new);
				}

				// validate custom profile fields
				$error = $cp_data = $cp_error = array();
				$cp->submit_cp_field($user->get_iso_lang_id(), $cp_data, $error);
		
				// Stop here, if custom fields are invalid!
				if (sizeof($error))
				{
					trigger_error(implode('<br />', $error), E_USER_WARNING);
				}
		
				if ($df_id && $new_cat)
				{
					/*
					* Enter new version if choosen
					*/
					if (!$file_option || $file_option == 1)
					{
						$sql = 'INSERT INTO ' . DL_VERSIONS_TABLE . ' ' . $db->sql_build_array('INSERT', array(
							'dl_id'				=> $df_id,
							'ver_file_name'		=> ($file_option) ? $file_name : $dl_file['file_name'],
							'ver_real_file'		=> ($file_option) ? $real_file_new : $dl_file['real_file'],
							'ver_file_hash'		=> ($file_option) ? $file_hash : $dl_file['file_hash'],
							'ver_file_size'		=> ($file_option) ? $file_size : $dl_file['file_size'],
							'ver_version'		=> ($file_option) ? $hack_version : $dl_file['hack_version'],
							'ver_add_time'		=> ($file_option) ? time() : $dl_file['add_time'],
							'ver_change_time'	=> ($file_option) ? time() : $dl_file['change_time'],
							'ver_add_user'		=> ($file_option) ? $user->data['user_id'] : $dl_file['add_user'],
							'ver_change_user'	=> ($file_option) ? $user->data['user_id'] : $dl_file['change_user'],
						));
	
						$db->sql_query($sql);
					}
					else if ($file_option == 2 && $file_version)
					{
						$sql = 'SELECT * FROM ' . DL_VERSIONS_TABLE . '
							WHERE dl_id = ' . (int) $df_id . '
								AND ver_id = ' . (int) $file_version;
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);
	
						if ($file_new)
						{
							@unlink($phpbb_root_path . $config['dl_download_dir'] . $dl_path . $real_old_file);
						}

						$sql = 'UPDATE ' . DL_VERSIONS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
							'ver_file_name'		=> ($file_new) ? $file_name : $row['ver_file_name'],
							'ver_real_file'		=> ($file_new) ? $real_file_new : $row['ver_real_file'],
							'ver_file_hash'		=> ($file_new) ? $file_hash : $row['ver_file_hash'],
							'ver_file_size'		=> ($file_new) ? $file_size : $row['ver_file_size'],
							'ver_change_time'	=> time(),
							'ver_change_user'	=> $user->data['user_id'],
							'ver_version'		=> $hack_version,
						)) . ' WHERE dl_id = ' . (int) $df_id . ' AND ver_id = ' . (int) $file_version;
	
						$db->sql_query($sql);
					}
		
					unset($sql_array);
		
					if (!$index[$cat_id]['allow_mod_desc'] && !($auth->acl_get('a_') && $user->data['is_registered']))
					{
						$test = $require = $warning = $mod_desc = '';
					}
		
					$sql_array = array(
						'description'			=> $description,
						'file_traffic'			=> $file_traffic,
						'long_desc'				=> $long_desc,
						'free'					=> $file_free,
						'extern'				=> $file_extern,
						'cat'					=> $new_cat,
						'desc_uid'				=> $desc_uid,
						'desc_bitfield'			=> $desc_bitfield,
						'desc_flags'			=> $desc_flags,
						'long_desc_uid'			=> $long_desc_uid,
						'long_desc_bitfield'	=> $long_desc_bitfield,
						'long_desc_flags'		=> $long_desc_flags,
						'approve'				=> $approve,
						'hacklist'				=> $hacklist,
						'hack_author'			=> $hack_author,
						'hack_author_email'		=> $hack_author_email,
						'hack_author_website'	=> $hack_author_website,
						'hack_dl_url'			=> $hack_dl_url,
						'todo'					=> $todo,
						'todo_uid'				=> $todo_uid,
						'todo_bitfield'			=> $todo_bitfield,
						'todo_flags'			=> $todo_flags,
						'test'					=> $test,
						'req'					=> $require,
						'warning'				=> $warning,
						'mod_desc'				=> $mod_desc);
		
					if (!$file_option || ($file_option == 2 && !$file_version && $hack_version))
					{
						$sql_array = array_merge($sql_array, array(
							'file_name'				=> $file_name,
							'real_file'				=> $real_file_new,
							'file_hash'				=> $file_hash,
							'file_size'				=> $file_size,
							'hack_version'			=> $hack_version));
					}
					else
					{
						$sql_array = array_merge($sql_array, array(
							'file_name'		=> $dl_file['file_name'],
							'real_file'		=> $dl_file['real_file'],
							'file_hash'		=> $dl_file['file_hash'],
							'file_size'		=> $dl_file['file_size'],
							'hack_version'	=> $dl_file['hack_version'],
						));
					}
		
					if (!$change_time)
					{
						$sql_array = array_merge($sql_array, array(
							'change_time'	=> time(),
							'change_user'	=> $user->data['user_id']));
					}
		
					if ($click_reset)
					{
						$sql_array = array_merge($sql_array, array(
							'klicks' => 0));
					}
		
					if ($index[$cat_id]['allow_mod_desc'] || ($auth->acl_get('a_') && $user->data['is_registered']))
					{
						$sql_array = array_merge($sql_array, array(
							'mod_list'			=> $mod_list,
							'mod_desc_uid'		=> $mod_desc_uid,
							'mod_desc_bitfield'	=> $mod_desc_bitfield,
							'mod_desc_flags'	=> $mod_desc_flags,
							'warn_uid'			=> $warn_uid,
							'warn_bitfield'		=> $warn_bitfield,
							'warn_flags'		=> $warn_flags));
					}

					$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_array) . ' WHERE id = ' . (int) $df_id;
					$db->sql_query($sql);

					dl_topic::update_topic($dl_file['dl_topic'], $df_id);
		
					if ($approve)
					{
						$processing_user	= dl_auth::dl_auth_users($cat_id, 'auth_view');
						$email_template		= 'downloads_change_notify';
		
						dl_topic::gen_dl_topic($df_id);
					}
					else
					{
						$processing_user	= dl_auth::dl_auth_users($cat_id, 'auth_mod');
						$email_template		= 'downloads_approve_notify';
					}
		
					$sql = 'SELECT fav_user_id FROM ' . DL_FAVORITES_TABLE . '
						WHERE fav_dl_id = ' . (int) $df_id;
					$result = $db->sql_query($sql);
		
					$fav_user = array();
		
					while ($row = $db->sql_fetchrow($result))
					{
						$fav_user[] = $row['fav_user_id'];
					}
		
					$db->sql_freeresult($result);
		
					$sql_fav_user = (sizeof($fav_user)) ? ' AND ' . $db->sql_in_set('user_id', $fav_user) : '';
		
					if (!$config['dl_disable_email'] && !$send_notify && $sql_fav_user)
					{
						$sql = 'SELECT user_email, username, user_lang FROM ' . USERS_TABLE . "
							WHERE user_allow_fav_download_email = 1
								$sql_fav_user
								AND (" . $db->sql_in_set('user_id', explode(',', $processing_user)) . '
									OR user_type = ' . USER_FOUNDER . ')';

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
		
					if (!$config['dl_disable_popup'] && !$disable_popup_notify)
					{
						$sql = 'UPDATE ' . USERS_TABLE . "
							SET user_new_download = 1
							WHERE user_allow_fav_download_popup = 1
								$sql_fav_user
								AND " . $db->sql_in_set('user_id', explode(',', $processing_user));
						$db->sql_query($sql);
					}
		
					if ($config['dl_upload_traffic_count'] && !$file_extern && !$config['dl_traffic_off'])
					{
						$config['dl_remain_traffic'] += $file_size;
		
						$sql = 'UPDATE ' . DL_REM_TRAF_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
							'config_value' => $config['dl_remain_traffic'])) . " WHERE config_name = 'remain_traffic'";
						$db->sql_query($sql);
					}
		
					if ($file_cat_old <> $new_cat && !$file_extern && !$file_temp)
					{
						$old_path = $index[$file_cat_old]['cat_path'];
						$new_path = $index[$new_cat]['cat_path'];
		
						if ($new_path != $old_path)
						{
							@copy($phpbb_root_path . $config['dl_download_dir'] . $old_path . $real_file_old, $phpbb_root_path . $config['dl_download_dir'] . $new_path . $real_file_new);
							@chmod($phpbb_root_path . $config['dl_download_dir'] . $new_path . $real_file_new, 0777);
							@unlink($phpbb_root_path . $config['dl_download_dir'] . $old_path . $real_file_old);
		
							$sql = 'SELECT ver_real_file FROM ' . DL_VERSIONS_TABLE . '
								WHERE dl_id = ' . (int) $df_id;
							$result = $db->sql_query($sql);
		
							while ($row = $db->sql_fetchrow($result))
							{
								$real_ver_file = $row['ver_real_file'];
								@copy($phpbb_root_path . $config['dl_download_dir'] . $old_path . $real_ver_file, $phpbb_root_path . $config['dl_download_dir'] . $new_path . $real_ver_file);
								@chmod($phpbb_root_path . $config['dl_download_dir'] . $new_path . $real_ver_file, 0777);
								@unlink($phpbb_root_path . $config['dl_download_dir'] . $old_path . $real_ver_file);
							}
		
							$db->sql_freeresult($result);
						}
		
						$sql = 'UPDATE ' . DL_STATS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
							'cat_id' => $new_cat)) . ' WHERE id = ' . (int) $df_id;
						$db->sql_query($sql);
		
						$sql = 'UPDATE ' . DL_COMMENTS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
							'cat_id' => $new_cat)) . ' WHERE id = ' . (int) $df_id;
						$db->sql_query($sql);
					}
		
					// Purge the files cache
					@unlink($phpbb_root_path . 'cache/data_dl_cat_counts.' . $phpEx);
					@unlink($phpbb_root_path . 'cache/data_dl_file_preset.' . $phpEx);
				}
			}
		
			// Update Custom Fields
			$cp->update_profile_field_data($df_id, $cp_data);
		
			if ($own_edit)
			{
				$meta_url	= append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$df_id");
				$message	= $user->lang['DOWNLOAD_UPDATED'] . $thumb_message . '<br /><br />' . sprintf($user->lang['CLICK_RETURN_DOWNLOAD_DETAILS'], '<a href="' . $meta_url . '">', '</a>');
			}
			else
			{
				$meta_url		= append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=manage&amp;cat_id=$cat_id");
				$return_string	= ($action == 'approve') ? $user->lang['CLICK_RETURN_MODCP_APPROVE'] : $user->lang['CLICK_RETURN_MODCP_MANAGE'];
				$message		= $user->lang['DOWNLOAD_UPDATED'] . $thumb_message . '<br /><br />' . sprintf($return_string, '<a href="' . $meta_url . '">', '</a>');
			}
		
			meta_refresh(3, $meta_url);
		
			trigger_error($message);
		
			$action = 'manage';
		}
		
		if ($action == 'delete')
		{
			$dl_id = request_var('dlo_id', array(0));

			if (!empty($dl_id))
			{
				if (!$confirm)
				{
					if (sizeof($dl_id) == 1)
					{
						$dl_file	= array();
						$dl_file	= dl_files::all_files(0, '', 'ASC', '', intval($dl_id[0]), true, '*');
		
						$description			= $dl_file['description'];
						$delete_confirm_text	= $user->lang['DL_CONFIRM_DELETE_SINGLE_FILE'];
					}
					else
					{
						$description			= sizeof($dl_id);
						$delete_confirm_text	= $user->lang['DL_CONFIRM_DELETE_MULTIPLE_FILES'];
					}
		
					/*
					* output confirmation page
					*/
					page_header($user->lang['DL_DELETE_FILE_CONFIRM']);
		
					$template->set_filenames(array(
						'body' => 'dl_mod/dl_confirm_body.html')
					);
		
					$template->assign_var('S_DELETE_FILES_CONFIRM', true);
		
					$s_hidden_fields = array(
						'view'		=> 'modcp',
						'df_id'		=> $df_id,
						'action'	=> 'delete',
						'confirm'	=> 1
					);
		
					$i = 0;
					foreach($dl_id as $key => $value)
					{
						$s_hidden_fields = array_merge($s_hidden_fields, array('dlo_id[' . $i . ']' => $value));
						$i++;
					}
		
					$template->assign_vars(array(
						'MESSAGE_TITLE' => $user->lang['INFORMATION'],
						'MESSAGE_TEXT' => sprintf($delete_confirm_text, $description),
		
						'S_CONFIRM_ACTION' => append_sid("{$phpbb_root_path}downloads.$phpEx"),
						'S_HIDDEN_FIELDS' => build_hidden_fields($s_hidden_fields))
					);
		
					page_footer();
				}
				else
				{
					if (!check_form_key('dl_modcp'))
					{
						trigger_error('FORM_INVALID');
					}
		
					$dl_ids = array();
		
					for ($i = 0; $i < sizeof($dl_id); $i++)
					{
						$dl_ids[] = intval($dl_id[$i]);
					}
		
					if ($del_file)
					{
						$sql = 'SELECT dl_id, ver_real_file FROM ' . DL_VERSIONS_TABLE . '
							WHERE ' . $db->sql_in_set('dl_id', $dl_ids);
						$result = $db->sql_query($sql);
		
						while ($row = $db->sql_fetchrow($result))
						{
							$real_ver_file[$row['dl_id']][] = $row['ver_real_file'];
						}
		
						$db->sql_freeresult($result);
					}
		
					$sql = 'SELECT c.path, d.cat, d.real_file, d.thumbnail, d.dl_topic, d.id AS df_id FROM ' . DL_CAT_TABLE . ' c, ' . DOWNLOADS_TABLE . ' d
						WHERE c.id = d.cat
							AND ' . $db->sql_in_set('d.id', $dl_ids);
					$result = $db->sql_query($sql);
		
					$dl_topics = array();
		
					while ($row = $db->sql_fetchrow($result))
					{
						$cat_id = $row['cat'];

						if (!$auth->acl_get('a_') && isset($index[$cat_id]['auth_mod']) && !$index[$cat_id]['auth_mod'])
						{
							trigger_error($user->lang['DL_NO_PERMISSION'] . __LINE__);
						}
						
						$cat_auth = array();
						$cat_auth = dl_auth::dl_cat_auth($cat_id);
						
						if (!$auth->acl_get('a_') && !$cat_auth['auth_mod'])
						{
							trigger_error($user->lang['DL_NO_PERMISSION'] . __LINE__);
						}
						
						$path		= $row['path'];
						$real_file	= $row['real_file'];
						$df_id		= $row['df_id'];
		
						@unlink($phpbb_root_path . 'dl_mod/thumbs/' . $row['thumbnail']);
		
						if ($del_file)
						{
							@unlink($phpbb_root_path . $config['dl_download_dir'] . $path . $real_file);
		
							if (isset($real_ver_file[$df_id]))
							{
								for ($i = 0; $i < sizeof($real_ver_file[$df_id]); $i++)
								{
									@unlink($phpbb_root_path . $config['dl_download_dir'] . $path . $real_ver_file[$df_id][$i]);
								}
							}
						}
		
						if ($row['dl_topic'])
						{
							$dl_topics[] = $row['dl_topic'];
						}
					}
					$db->sql_freeresult($result);
		
					if (sizeof($dl_ids))
					{
						$sql = 'DELETE FROM ' . DOWNLOADS_TABLE . '
							WHERE ' . $db->sql_in_set('id', $dl_ids) . '
								AND cat = ' . (int) $cat_id;
						$db->sql_query($sql);
		
						$sql = 'DELETE FROM ' . DL_STATS_TABLE . '
							WHERE ' . $db->sql_in_set('id', $dl_ids) . '
								AND cat_id = ' . (int) $cat_id;
						$db->sql_query($sql);
		
						$sql = 'DELETE FROM ' . DL_COMMENTS_TABLE . '
							WHERE ' . $db->sql_in_set('id', $dl_ids) . '
								AND cat_id = ' . (int) $cat_id;
						$db->sql_query($sql);
		
						$sql = 'DELETE FROM ' . DL_NOTRAF_TABLE . '
							WHERE ' . $db->sql_in_set('dl_id', $dl_ids);
						$db->sql_query($sql);
		
						$sql = 'DELETE FROM ' . DL_VERSIONS_TABLE . '
							WHERE ' . $db->sql_in_set('dl_id', $dl_ids);
						$db->sql_query($sql);
		
						$sql = 'DELETE FROM ' . DL_FIELDS_DATA_TABLE . '
							WHERE ' . $db->sql_in_set('df_id', $dl_ids);
						$db->sql_query($sql);
		
						$sql = 'DELETE FROM ' . DL_RATING_TABLE . '
							WHERE ' . $db->sql_in_set('dl_id', $dl_ids);
						$db->sql_query($sql);
		
						$sql = 'DELETE FROM ' . DL_FAVORITES_TABLE . '
							WHERE ' . $db->sql_in_set('fav_dl_id', $dl_ids);
						$db->sql_query($sql);
					}
		
					// Purge the files cache
					@unlink($phpbb_root_path . 'cache/data_dl_cat_counts.' . $phpEx);
					@unlink($phpbb_root_path . 'cache/data_dl_file_preset.' . $phpEx);
		
					dl_topic::delete_topic($dl_topics);
				}
			}
		
			$action = 'manage';
		}
		
		if ($action == 'cdelete')
		{
			if (!empty($dl_id))
			{
				$dl_ids = array();
		
				for ($i = 0; $i < sizeof($dl_id); $i++)
				{
					$dl_ids[] = intval($dl_id[$i]);
				}
		
				if (!check_form_key('dl_modcp'))
				{
					trigger_error('FORM_INVALID');
				}
		
				$sql = 'DELETE FROM ' . DL_COMMENTS_TABLE . '
					WHERE ' . $db->sql_in_set('dl_id', $dl_ids);
				$db->sql_query($sql);
			}
		
			$dl_id = array();
			$action = 'capprove';
		}
		
		if ($action == 'edit')
		{
			$dl_file = array();
			$dl_file = dl_files::all_files(0, '', 'ASC', '', $df_id, true, '*');
		
			$s_hidden_fields = array(
				'view'		=> 'modcp',
				'action'	=> 'save',
				'cat_id'	=> $cat_id,
				'df_id'		=> $df_id
			);
		
			$description			= $dl_file['description'];
			$file_traffic			= $dl_file['file_traffic'];
			$file_size				= $dl_file['file_size'];
			$cat					= $dl_file['cat'];
			$long_desc				= $dl_file['long_desc'];
			$approve				= $dl_file['approve'];
			$hacklist				= $dl_file['hacklist'];
			$hack_author			= $dl_file['hack_author'];
			$hack_author_email		= $dl_file['hack_author_email'];
			$hack_author_website	= $dl_file['hack_author_website'];
			$hack_version			= $dl_file['hack_version'];
			$hack_dl_url			= $dl_file['hack_dl_url'];
			$mod_test				= $dl_file['test'];
			$require				= $dl_file['req'];
			$todo					= $dl_file['todo'];
			$warning				= $dl_file['warning'];
			$mod_desc				= $dl_file['mod_desc'];
			$mod_list				= ($dl_file['mod_list']) ? 'checked="checked"' : '';
		
			$mod_desc_uid			= $dl_file['mod_desc_uid'];
			$mod_desc_flags			= $dl_file['mod_desc_flags'];
			$long_desc_uid			= $dl_file['long_desc_uid'];
			$long_desc_flags		= $dl_file['long_desc_flags'];
			$desc_uid				= $dl_file['desc_uid'];
			$desc_flags				= $dl_file['desc_flags'];
			$warn_uid				= $dl_file['warn_uid'];
			$warn_flags				= $dl_file['warn_flags'];
			$todo_uid				= $dl_file['todo_uid'];
			$todo_flags				= $dl_file['todo_flags'];

			$text_ary		= generate_text_for_edit($mod_desc, $mod_desc_uid, $mod_desc_flags);
			$mod_desc		= $text_ary['text'];
			$text_ary		= generate_text_for_edit($long_desc, $long_desc_uid, $long_desc_flags);
			$long_desc		= $text_ary['text'];
			$text_ary		= generate_text_for_edit($description, $desc_uid, $desc_flags);
			$description	= $text_ary['text'];
			$text_ary		= generate_text_for_edit($warning, $warn_uid, $warn_flags);
			$warning		= $text_ary['text'];
			$text_ary		= generate_text_for_edit($todo, $todo_uid, $warn_flags);
			$todo			= $text_ary['text'];
		
			if ($index[$cat_id]['allow_thumbs'] && $config['dl_thumb_fsize'])
			{
				$thumbnail			= $dl_file['thumbnail'];
				$thumbnail_explain	= sprintf($user->lang['DL_THUMB_DIM_SIZE'], $config['dl_thumb_xsize'], $config['dl_thumb_ysize'], dl_format::dl_size($config['dl_thumb_fsize']));
				$template->assign_var('S_ALLOW_THUMBS', true);
		
				$thumbnail = $phpbb_root_path . 'dl_mod/thumbs/' . $thumbnail;
				if (file_exists($thumbnail))
				{
					$template->assign_var('S_THUMBNAIL', true);
				}
				else
				{
					$thumbnail = '';
				}
			}
			else
			{
				$thumbnail_explain	= '';
				$thumbnail			= '';
			}
		
			$s_check_free = '<select name="file_free">';
			$s_check_free .= '<option value="0">' . $user->lang['NO'] . '</option>';
			$s_check_free .= '<option value="1">' . $user->lang['YES'] . '</option>';
			$s_check_free .= '<option value="2">' . $user->lang['DL_IS_FREE_REG'] . '</option>';
			$s_check_free .= '</select>';
		
			$s_traffic_range = '<select name="dl_t_quote">';
			$s_traffic_range .= '<option value="byte">' . $user->lang['DL_BYTES'] . '</option>';
			$s_traffic_range .= '<option value="kb">' . $user->lang['DL_KB'] . '</option>';
			$s_traffic_range .= '<option value="mb">' . $user->lang['DL_MB'] . '</option>';
			$s_traffic_range .= '<option value="gb">' . $user->lang['DL_GB'] . '</option>';
			$s_traffic_range .= '</select>';
		
			$s_file_ext_size_range = '<select name="dl_e_quote">';
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

			$tmp_ary				= dl_format::dl_size($file_traffic, 2, 'select');
			$file_traffic_out		= $tmp_ary['size_out'];
			$data_range_select		= $tmp_ary['range'];

			$tmp_ary				= dl_format::dl_size($file_size, 2, 'select');
			$file_extern_size_out	= $tmp_ary['size_out'];
			$file_extern_size_range	= $tmp_ary['range'];

			unset($tmp_ary);

			$s_traffic_range		= str_replace('value="' . $data_range_select . '">', 'value="' . $data_range_select . '" selected="selected">', $s_traffic_range);
			$s_file_ext_size_range	= str_replace('value="' . $file_extern_size_range . '">', 'value="' . $file_extern_size_range . '" selected="selected">', $s_file_ext_size_range);
			$s_hacklist				= str_replace('value="' . $hacklist . '">', 'value="' . $hacklist . '" selected="selected">', $s_hacklist);
			$s_check_free			= str_replace('value="' . $dl_file['free'] . '">', 'value="' . $dl_file['free'] . '" selected="selected">', $s_check_free);
	
			if (!$own_edit)
			{
				$select_code = '<select name="new_cat">';
				$select_code .= dl_extra::dl_dropdown(0, 0, $cat_id, 'auth_up');
				$select_code .= '</select>';
		
				$template->assign_var('S_CAT_CHOOSE', true);
			}
			else
			{
				$select_code = '';
		
				$s_hidden_fields = array_merge($s_hidden_fields, array('new_cat' => $cat_id));
			}
		
			if ($dl_file['extern'])
			{
				$checkextern = 'checked="checked"';
				$dl_extern_url = $dl_file['file_name'];
			}
			else
			{
				$checkextern = '';
				$dl_extern_url = '';
			}
		
			page_header($user->lang['DL_MODCP_EDIT']);
		
			$template->set_filenames(array(
				"body" => "dl_mod/dl_edit_body.html")
			);
		
			$template->assign_var('S_MODCP', true);
		
			if (!$config['dl_disable_email'])
			{
				$template->assign_var('S_EMAIL_BLOCK', true);
			}
		
			if (!$config['dl_disable_popup'])
			{
				$template->assign_var('S_CHANGE_TIME', true);
		
				if ($config['dl_disable_popup_notify'])
				{
					$template->assign_var('S_POPUP_NOTIFY', true);
				}
			}
		
			$template->assign_var('S_CLICK_RESET', true);
		
			$bg_row			= 1;
			$hacklist_on	= 0;
			$mod_block_bg	= 0;
		
			if ($config['dl_use_hacklist'])
			{
				$template->assign_var('S_USE_HACKLIST', true);
				$hacklist_on = true;
				$bg_row = 1 - $bg_row;
			}
		
			if ($index[$cat_id]['allow_mod_desc'])
			{
				$template->assign_var('S_ALLOW_EDIT_MOD_DESC', true);
				$mod_block_bg = ($bg_row) ? true : 0;
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
		
			$sql = 'SELECT ver_id, ver_change_time, ver_version FROM ' . DL_VERSIONS_TABLE . '
				WHERE dl_id = ' . (int) $df_id . '
				ORDER BY ver_version DESC, ver_change_time DESC';
			$result = $db->sql_query($sql);
		
			$total_versions = $db->sql_affectedrows($result);
			$multiple_size = ($total_versions > 10) ? 10 : $total_versions;
		
			$s_select_version = '<select name="file_version">';
			$s_select_ver_del = '<select name="file_ver_del[]" multiple="multiple" size="' . $multiple_size . '">';
			$s_select_version .= '<option value="0" selected="selected">' . $user->lang['DL_VERSION_CURRENT'] . '</option>';
		
			while ($row = $db->sql_fetchrow($result))
			{
				$s_select_version .= '<option value="' . $row['ver_id'] . '">' . $row['ver_version'] . ' - ' . $user->format_date($row['ver_change_time']) . '</option>';
				$s_select_ver_del .= '<option value="' . $row['ver_id'] . '">' . $row['ver_version'] . ' - ' . $user->format_date($row['ver_change_time']) . '</option>';
			}
		
			$db->sql_freeresult($result);
		
			$s_select_version .= '</select>';
			$s_select_ver_del .= '</select>';
		
			if (!$total_versions)
			{
				$s_select_ver_del = '';
			}
		
			$dl_files_page_title = $user->lang['DL_FILES_TITLE'];

			$template->assign_vars(array(
				'DL_FILES_TITLE'					=> $dl_files_page_title,
		
				'DL_THUMBNAIL_SECOND'				=> $thumbnail_explain,
				'EXT_BLACKLIST'						=> $blacklist_explain,
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
				'L_CLICK_RESET_EXPLAIN'				=> 'DL_KLICKS_RESET',
		
				'DESCRIPTION'			=> $description,
				'SELECT_CAT'			=> $select_code,
				'LONG_DESC'				=> $long_desc,
				'TRAFFIC'				=> $file_traffic_out,
				'APPROVE'				=> ($approve) ? 'checked="checked"' : '',
				'MOD_DESC'				=> $mod_desc,
				'MOD_LIST'				=> $mod_list,
				'MOD_REQUIRE'			=> $require,
				'MOD_TEST'				=> $mod_test,
				'MOD_TODO'				=> $todo,
				'MOD_WARNING'			=> $warning,
				'HACK_AUTHOR'			=> $hack_author,
				'HACK_AUTHOR_EMAIL'		=> $hack_author_email,
				'HACK_AUTHOR_WEBSITE'	=> $hack_author_website,
				'HACK_DL_URL'			=> $hack_dl_url,
				'HACK_VERSION'			=> $hack_version,
				'HACKLIST_EVER'			=> ($hacklist == 2) ? 'checked="checked"' : '',
				'HACKLIST_NO'			=> ($hacklist == 0) ? 'checked="checked"' : '',
				'HACKLIST_YES'			=> ($hacklist == 1) ? 'checked="checked"' : '',
				'THUMBNAIL'				=> $thumbnail,
				'URL'					=> $dl_extern_url,
				'CHECKEXTERN'			=> $checkextern,
				'FILE_EXT_SIZE'			=> $file_extern_size_out,

				'HACKLIST_BG'	=> ($hacklist_on) ? ' bg2' : '',
				'MOD_BLOCK_BG'	=> ($mod_block_bg) ? ' bg2' : '',
		
				'MAX_UPLOAD_SIZE' => sprintf($user->lang['DL_UPLOAD_MAX_FILESIZE'], dl_physical::dl_max_upload_size()),
		
				'ENCTYPE' => 'enctype="multipart/form-data"',

				'S_TODO_LINK_ONOFF'		=> ($config['dl_todo_onoff']) ? true : false,
				'S_SELECT_VERSION'		=> $s_select_version,
				'S_SELECT_VER_DEL'		=> $s_select_ver_del,
				'S_CHECK_FREE'			=> $s_check_free,
				'S_TRAFFIC_RANGE'		=> $s_traffic_range,
				'S_FILE_EXT_SIZE_RANGE'	=> $s_file_ext_size_range,
				'S_HACKLIST'			=> $s_hacklist,
				'S_DOWNLOADS_ACTION'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp"),
				'S_HIDDEN_FIELDS'		=> build_hidden_fields($s_hidden_fields))
			);

			// Init and display the custom fields with the existing data
			$cp->get_profile_fields($df_id);
			$cp->generate_profile_fields($user->get_iso_lang_id());
		
			$template->assign_var('S_VERSION_ON', true);
		}
		
		if ($action == 'move' && $new_cat && $cat_id)
		{
			if (!empty($dl_id))
			{
				$new_path = $index[$new_cat]['cat_path'];
		
				$sql = 'SELECT dl_id, ver_real_file FROM ' . DL_VERSIONS_TABLE . '
					WHERE ' . $db->sql_in_set('dl_id', $dl_id);
				$result = $db->sql_query($sql);
		
				while ($row = $db->sql_fetchrow($result))
				{
					$real_ver_file[$row['dl_id']][] = $row['ver_real_file'];
				}
		
				$db->sql_freeresult($result);
		
				for ($i = 0; $i < sizeof($dl_id); $i++)
				{
					$df_id = intval($dl_id[$i]);
		
					$sql = 'SELECT c.path, d.real_file FROM ' . DOWNLOADS_TABLE . ' d, ' . DL_CAT_TABLE . ' c
						WHERE d.cat = c.id
							AND d.id = ' . (int) $df_id . '
							AND c.id = ' . (int) $cat_id . '
							AND d.extern = 0';
					$result = $db->sql_query($sql);
					$row = $db->sql_fetchrow($result);
		
					$old_path = $row['path'];
					$real_file = $row['real_file'];
		
					$db->sql_freeresult($result);
		
					if ($new_path != $old_path)
					{
						@copy($phpbb_root_path . $config['dl_download_dir'] . $old_path . $real_file, $phpbb_root_path . $config['dl_download_dir'] . $new_path . $real_file);
						@chmod($phpbb_root_path . $config['dl_download_dir'] . $new_path . $real_file, 0777);
						@unlink($phpbb_root_path . $config['dl_download_dir'] . $old_path . $real_file);
		
						if (isset($real_ver_file[$df_id]))
						{
							for ($j = 0; $j < sizeof($real_ver_file[$df_id]); $j++)
							{
								@copy($phpbb_root_path . $config['dl_download_dir'] . $old_path . $real_ver_file[$df_id][$j], $phpbb_root_path . $config['dl_download_dir'] . $new_path . $real_ver_file[$df_id][$j]);
								@chmod($phpbb_root_path . $config['dl_download_dir'] . $new_path . $real_ver_file[$df_id][$j], 0777);
								@unlink($phpbb_root_path . $config['dl_download_dir'] . $old_path . $real_ver_file[$df_id][$j]);
							}
						}
					}
				}
		
				$dl_ids = array();
		
				for ($i = 0; $i < sizeof($dl_id); $i++)
				{
					$dl_ids[] = intval($dl_id[$i]);
				}
		
				$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'cat' => $new_cat)) . ' WHERE ' . $db->sql_in_set('id', $dl_ids) . ' AND cat = ' . (int) $cat_id;
				$db->sql_query($sql);
		
				$sql = "UPDATE " . DL_STATS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'cat_id' => $new_cat)) . ' WHERE ' . $db->sql_in_set('id', $dl_ids) . ' AND cat_id = ' . (int) $cat_id;
				$db->sql_query($sql);
		
				$sql = "UPDATE " . DL_COMMENTS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'cat_id' => $new_cat)) . ' WHERE ' . $db->sql_in_set('id', $dl_ids) . ' AND cat_id = ' . (int) $cat_id;
				$db->sql_query($sql);
		
				// Purge the files cache
				@unlink($phpbb_root_path . 'cache/data_dl_cat_counts.' . $phpEx);
				@unlink($phpbb_root_path . 'cache/data_dl_file_preset.' . $phpEx);
			}
		
			$action = 'manage';
		}
		
		if ($action == 'lock')
		{
			if (!empty($dl_id))
			{
				$dl_ids = array();
		
				for ($i = 0; $i < sizeof($dl_id); $i++)
				{
					$dl_ids[] = intval($dl_id[$i]);
				}
		
				$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'approve' => 0)) . ' WHERE ' . $db->sql_in_set('id', $dl_ids);
				$db->sql_query($sql);
			}
		
			$action = 'manage';
		}
		
		if ($action == 'approve')
		{
			if (!empty($dl_id))
			{
				$dl_ids = array();
		
				for ($i = 0; $i < sizeof($dl_id); $i++)
				{
					$dl_ids[] = intval($dl_id[$i]);
				}
		
				if (!check_form_key('dl_modcp'))
				{
					trigger_error('FORM_INVALID');
				}
		
				$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'approve' => true)) . ' WHERE ' . $db->sql_in_set('id', $dl_ids);
				$db->sql_query($sql);
		
				if ($config['dl_enable_dl_topic'])
				{
					for ($i = 0; $i < sizeof($dl_id); $i++)
					{
						dl_topic::gen_dl_topic(intval($dl_id[$i]));
					}
				}
		
				redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
			}
		
			$sql_access_cats = ($auth->acl_get('a_') && $user->data['is_registered']) ? '' : ' AND ' . $db->sql_in_set('cat', $access_cat);
		
			$sql = 'SELECT COUNT(id) AS total FROM ' . DOWNLOADS_TABLE . "
				WHERE approve = 0
					$sql_access_cats";
			$result = $db->sql_query($sql);
			$total_approve = $db->sql_fetchfield('total');
			$db->sql_freeresult($result);
		
			if (!$total_approve)
			{
				redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
			}
		
			page_header($user->lang['DL_MODCP_APPROVE']);
		
			$template->set_filenames(array(
				'body' => 'dl_mod/dl_modcp_approve.html')
			);
		
			$sql = 'SELECT cat, id, description, desc_uid, desc_bitfield, desc_flags FROM ' . DOWNLOADS_TABLE . "
				WHERE approve = 0
					$sql_access_cats
				ORDER BY cat, description";
			$result = $db->sql_query_limit($sql, $config['dl_links_per_page'], $start);
		
			while ($row = $db->sql_fetchrow($result))
			{
				$cat_id		= $row['cat'];
				$cat_name	= $index[$cat_id]['cat_name'];
				$cat_name	= str_replace('&nbsp;&nbsp;|', '', $cat_name);
				$cat_name	= str_replace('___&nbsp;', '', $cat_name);
				$cat_view	= $index[$cat_id]['nav_path'];
		
				$description	= $row['description'];
				$desc_uid		= $row['desc_uid'];
				$desc_bitfield	= $row['desc_bitfield'];
				$desc_flags		= $row['desc_flags'];
				$description	= generate_text_for_display($description, $desc_uid, $desc_bitfield, $desc_flags);
		
				$file_id = $row['id'];
		
				$template->assign_block_vars('approve_row', array(
					'CAT_NAME'		=> $cat_name,
					'FILE_ID'		=> $file_id,
					'DESCRIPTION'	=> $description,
		
					'U_CAT_VIEW'	=> $cat_view,
					'U_EDIT'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=edit&amp;df_id=$file_id&amp;cat_id=$cat_id&amp;modcp=1"),
					'U_DOWNLOAD'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$file_id&amp;modcp=1&amp;cat_id=$cat_id"))
				);
			}
			$db->sql_freeresult($result);
		
			$s_hidden_fields = array(
				'view'		=> 'modcp',
				'action'	=> 'approve',
				'cat_id'	=> $cat_id,
				'start'		=> $start
			);
		
			if ($total_approve > $config['dl_links_per_page'])
			{
				$pagination = generate_pagination(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=approve&amp;cat_id=$cat_id"), $total_approve, $config['dl_links_per_page'], $start, true);
				$page_number = on_page($total_approve, $config['dl_links_per_page'], $start);
			}
			else
			{
				$pagination = '';
				$page_number = '';
			}
		
			$template->assign_vars(array(
				'PAGINATION'	=> $pagination,
				'PAGE_NUMBER'	=> $page_number,

				'S_DL_MODCP_ACTION'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp"),
				'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields))
			);
		}
		
		if ($action == 'capprove')
		{
			if (!empty($dl_id))
			{
				$dl_ids = array();
		
				for ($i = 0; $i < sizeof($dl_id); $i++)
				{
					$dl_ids[] = intval($dl_id[$i]);
				}
		
				if (!check_form_key('dl_modcp'))
				{
					trigger_error('FORM_INVALID');
				}
		
				$sql = 'UPDATE ' . DL_COMMENTS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'approve' => true)) . ' WHERE ' . $db->sql_in_set('dl_id', $dl_ids);
				$db->sql_query($sql);
		
				redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
			}
		
			$sql_access_cats = ($auth->acl_get('a_') && $user->data['is_registered']) ? '' : ' AND ' . $db->sql_in_set('c.cat_id', $access_cat);
		
			$sql = 'SELECT COUNT(c.dl_id) AS total FROM ' . DL_COMMENTS_TABLE . " c
				WHERE c.approve = 0
					$sql_access_cats";
			$result = $db->sql_query($sql);
			$total_approve = $db->sql_fetchfield('total');
			$db->sql_freeresult($result);
		
			if (!$total_approve)
			{
				redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
			}
		
			page_header($user->lang['DL_MODCP_CAPPROVE']);
		
			$template->set_filenames(array(
				'body' => 'dl_mod/dl_modcp_capprove.html')
			);
		
			$sql = 'SELECT d.cat, d.id, d.description, d.desc_uid, d.desc_bitfield, d.desc_flags, c.comment_text, c.com_uid, c.com_bitfield, c.com_flags, c.user_id, c.username, c.dl_id FROM ' . DOWNLOADS_TABLE . ' d, ' . DL_COMMENTS_TABLE . " c
				WHERE d.id = c.id
					AND c.approve = 0
					$sql_access_cats
				ORDER BY d.cat, d.description";
			$result = $db->sql_query_limit($sql, $config['dl_links_per_page'], $start);
		
			while ($row = $db->sql_fetchrow($result))
			{
				$cat_id		= $row['cat'];
				$cat_name	= $index[$cat_id]['cat_name'];
				$cat_name	= str_replace('&nbsp;&nbsp;|', '', $cat_name);
				$cat_name	= str_replace('___&nbsp;', '', $cat_name);
				$cat_view	= $index[$cat_id]['nav_path'];
		
				$description	= $row['description'];
				$desc_uid		= $row['desc_uid'];
				$desc_bitfield	= $row['desc_bitfield'];
				$desc_flags		= $row['desc_flags'];
				$description	= generate_text_for_display($description, $desc_uid, $desc_bitfield, $desc_flags);
		
				$comment_text	= $row['comment_text'];
				$com_uid		= $row['com_uid'];
				$com_bitfield	= $row['com_bitfield'];
				$com_flags		= $row['com_flags'];
				$comment_text	= generate_text_for_display($comment_text, $com_uid, $com_bitfield, $com_flags);
		
				$file_id = $row['id'];
		
				$comment_id = $row['dl_id'];
		
				$comment_user_id	= $row['user_id'];
				$comment_username	= $row['username'];
				$comment_user_link	= ($comment_user_id <> ANONYMOUS) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=$comment_user_id") : '';
		
				$template->assign_block_vars('approve_row', array(
					'CAT_NAME'			=> $cat_name,
					'FILE_ID'			=> $file_id,
					'DESCRIPTION'		=> $description,
					'COMMENT_USERNAME'	=> $comment_username,
					'COMMENT_TEXT'		=> $comment_text,
					'COMMENT_ID'		=> $comment_id,
		
					'U_CAT_VIEW'	=> $cat_view,
					'U_USER_LINK'	=> $comment_user_link,
					'U_EDIT'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=comment&amp;action=edit&amp;df_id=$file_id&amp;cat_id=$cat_id&amp;dl_id=$comment_id"),
					'U_DOWNLOAD'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$file_id"))
				);
			}
			$db->sql_freeresult($result);
		
			$s_hidden_fields = array(
				'view'		=> 'modcp',
				'action'	=> 'capprove',
				'cat_id'	=> $cat_id,
				'start'		=> $start
			);
		
			if ($total_approve > $config['dl_links_per_page'])
			{
				$pagination = generate_pagination(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=capprove&amp;cat_id=$cat_id"), $total_approve, $config['dl_links_per_page'], $start, true);
				$page_number = on_page($total_approve, $config['dl_links_per_page'], $start);
			}
			else
			{
				$pagination = '';
				$page_number = '';
			}
		
			$template->assign_vars(array(
				'PAGINATION'	=> $pagination,
				'PAGE_NUMBER'	=> $page_number,
		
				'S_DL_MODCP_ACTION'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp"),
				'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields))
			);
		}
		
		if ($action == 'manage' && $cat_id)
		{
			$total_downloads = $index[$cat_id]['total'];
		
			if ($sort && ($auth->acl_get('a_') && $user->data['is_registered']))
			{
				$per_page	= $total_downloads;
				$start		= 0;
		
				$template->assign_var('S_MODCP_BUTTON', true);
			}
			else
			{
				$per_page = $config['dl_links_per_page'];
		
				if ($auth->acl_get('a_') && $user->data['is_registered'])
				{
					$template->assign_var('S_ORDER_BUTTON', true);
				}
			}
		
			if ($auth->acl_get('a_') && $user->data['is_registered'])
			{
				$template->assign_var('S_SORT_ASC', true);
			}
		
			if (!$total_downloads)
			{
				redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
			}
		
			page_header($user->lang['DL_MODCP_MANAGE']);
		
			$template->set_filenames(array(
				'body' => 'dl_mod/dl_modcp_manage.html')
			);
		
			$sql = 'SELECT id, description, desc_uid, desc_bitfield, desc_flags FROM ' . DOWNLOADS_TABLE . '
				WHERE approve = ' . true . '
					AND cat = ' . (int) $cat_id . '
				ORDER BY cat, sort';
			$result = $db->sql_query_limit($sql, $per_page, $start);
			$max_downloads = $db->sql_affectedrows($result);
		
			while ($row = $db->sql_fetchrow($result))
			{
				$description	= $row['description'];
				$desc_uid		= $row['desc_uid'];
				$desc_bitfield	= $row['desc_bitfield'];
				$desc_flags		= $row['desc_flags'];
		
				$description	= generate_text_for_display($description, $desc_uid, $desc_bitfield, $desc_flags);
		
				$file_id		= $row['id'];
		
				$mini_icon		= dl_status::mini_status_file($cat_id, $file_id);
		
				$template->assign_block_vars('manage_row', array(
					'FILE_ID'		=> $file_id,
					'MINI_ICON'		=> $mini_icon,
					'DESCRIPTION'	=> $description,
		
					'U_UP'			=> ($auth->acl_get('a_') && $user->data['is_registered']) ? append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=manage&amp;fmove=-1&amp;sort=1&amp;df_id=$file_id&amp;cat_id=$cat_id") : '',
					'U_DOWN'		=> ($auth->acl_get('a_') && $user->data['is_registered']) ? append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=manage&amp;fmove=1&amp;sort=1&amp;df_id=$file_id&amp;cat_id=$cat_id") : '',
					'U_EDIT'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=edit&amp;df_id=$file_id&amp;cat_id=$cat_id"),
					'U_DOWNLOAD'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$file_id"))
				);
			}
			$db->sql_freeresult($result);
		
			if (!isset($file_id))
			{
				$file_id = '';
			}
		
			$s_cat_select = '<select name="new_cat">';
			$s_cat_select .= dl_extra::dl_dropdown(0, 0, $cat_id, 'auth_view');
			$s_cat_select .= '</select>';
		
			$s_hidden_fields = array(
				'view'		=> 'modcp',
				'action'	=> 'manage',
				'cat_id'	=> $cat_id,
				'start'		=> $start
			);
		
			$cat_name = $index[$cat_id]['cat_name'];
			$cat_name = str_replace('&nbsp;&nbsp;|', '', $cat_name);
			$cat_name = str_replace('___&nbsp;', '', $cat_name);
		
			if ($total_downloads > $per_page)
			{
				$pagination = generate_pagination(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;cat_id=$cat_id"), $total_downloads, $per_page, $start, true);
				$page_number = on_page($total_downloads, $per_page, $start);
			}
			else
			{
				$pagination = '';
				$page_number = '';
			}
		
			$template->assign_vars(array(
				'DL_UP'			=> ($sort && ($auth->acl_get('a_') && $user->data['is_registered'])) ? $user->lang['DL_UP'] : '',
				'DL_DOWN'		=> ($sort && ($auth->acl_get('a_') && $user->data['is_registered'])) ? $user->lang['DL_DOWN'] : '',
				'DL_ABC'		=> ($auth->acl_get('a_') && $user->data['is_registered']) ? $user->lang['SORT_BY'] . ' ASC' : '',
		
				'PAGINATION'	=> $pagination,
				'PAGE_NUMBER'	=> $page_number,
				'SORT'			=> $sort,
				'MAX_DOWNLOADS'	=> $max_downloads,
		
				'U_SORT_ASC'		=> ($auth->acl_get('a_') && $user->data['is_registered']) ? append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=manage&amp;fmove=ABC&amp;sort=" . (($sort) ? 1 : '') . "&amp;df_id=$file_id&amp;cat_id=$cat_id") : '',
				'S_CAT_SELECT'		=> $s_cat_select,
				'S_DL_MODCP_ACTION'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp"),
				'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields))
			);
		}
	}
}

?>