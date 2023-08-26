<?php

/**
*
* @mod package		Download Mod 6
* @file				dl_thumbs.php 4 2012/03/23 OXPUS
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

/*
* default entry point for download details
*/
$dl_files = array();
$dl_files = dl_files::all_files(0, '', 'ASC', '', $df_id, 0, '*');

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

	$thumbs_ary = array();

	while ($row = $db->sql_fetchrow($result))
	{
		$thumbs_ary[] = $row;
	}
}

$db->sql_freeresult($result);

$inc_module = true;
page_header($user->lang['DOWNLOADS'] . ' - ' . $dl_files['description'] . ' - ' . $user->lang['DL_EDIT_THUMBS']);

$img_id			= request_var('img_id', 0);
$edit_img_link	= utf8_normalize_nfc(request_var('edit_img_link', '', true));
$img_title		= utf8_normalize_nfc(request_var('img_title', '', true));
$action			= utf8_normalize_nfc(request_var('action', '', true));

$edit_img_title	= '';

if ($action == 'delete' && $img_id && $df_id)
{
	$sql = 'SELECT img_name FROM ' . DL_IMAGES_TABLE . '
		WHERE img_id = ' . (int) $img_id . '
			AND dl_id = ' . (int) $df_id;
	$result = $db->sql_query($sql);
	$img_link = $db->sql_fetchfield('img_name');
	$db->sql_freeresult($result);

	@unlink($phpbb_root_path . 'dl_mod/thumbs/' . $img_link);

	$sql = 'DELETE FROM ' . DL_IMAGES_TABLE . '
		WHERE img_id = ' . (int) $img_id . '
			AND dl_id = ' . (int) $df_id;
	$db->sql_query($sql);

	$action = '';
}

if ($action == 'edit' && $img_id && $df_id)
{
	$sql = 'SELECT img_name, img_title FROM ' . DL_IMAGES_TABLE . '
		WHERE img_id = ' . (int) $img_id . '
			AND dl_id = ' . (int) $df_id;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$edit_img_link = $row['img_name'];
	$edit_img_title = $row['img_title'];
	$db->sql_freeresult($result);

	$action = '';
}

if ($submit && !$action)
{
	if (!check_form_key('dl_thumbs'))
	{
		trigger_error('FORM_INVALID');
	}

	$user->add_lang('posting');

	if (!class_exists('fileupload'))
	{
		include($phpbb_root_path . 'includes/functions_upload.' . $phpEx);
	}

	$fileupload = new fileupload();
	$fileupload->fileupload('');

	if ($config['dl_thumb_fsize'] && $index[$cat_id]['allow_thumbs'])
	{
		$thumb_file = $fileupload->form_upload('img_link');

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

	if (isset($thumb_name) && $thumb_name != '')
	{
		$cur_time = time();
		$thumb_tmp_link = $phpbb_root_path . 'dl_mod/thumbs/' . $cur_time . '_' . $thumb_name;

		while (!file_exists($thumb_tmp_link))
		{
			$thumb_file->realname = $thumb_tmp_link;
			$thumb_file->move_file('dl_mod/thumbs/', false, false, CHMOD_ALL);
			@chmod($thumb_file->destination_file, 0777);

			$cur_time = time();
			$thumb_tmp_link = $phpbb_root_path . 'dl_mod/thumbs/' . $cur_time . '_' . $thumb_name;
		}

		$img_link = $cur_time . '_' . $thumb_name;;

		if ($img_id)
		{
			$sql = 'SELECT img_name FROM ' . DL_IMAGES_TABLE . ' WHERE img_id = ' . (int) $img_id;
			$result = $db->sql_query($sql);
			$old_img_link = $db->sql_fetchfield('img_name');
			$db->sql_freeresult($result);

			if ($old_img_link != '')
			{
				@unlink($phpbb_root_path . 'dl_mod/thumbs/' . $old_img_link);
			}
		}
	}
	else
	{
		$img_link = $edit_img_link;
	}

	$thumb_message = '<br />' . $user->lang['DL_THUMB_UPLOAD'];

	if ($img_id)
	{
		$sql_array = array(
				'img_name'		=> $img_link,
				'img_title'		=> $img_title,
		);

		$sql = 'UPDATE ' . DL_IMAGES_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_array) . ' WHERE img_id = ' . (int) $img_id . ' AND dl_id = ' . (int) $df_id;
		$db->sql_query($sql);
	}
	else
	{
		$sql_array = array(
				'img_id'		=> $img_id,
				'dl_id'			=> $df_id,
				'img_name'		=> $img_link,
				'img_title'		=> $img_title,
		);

		$sql = 'INSERT INTO ' . DL_IMAGES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_array);
		$db->sql_query($sql);
	}

	meta_refresh(3, append_sid("downloads.$phpEx", "view=thumbs&amp;df_id=$df_id&amp;cat=$cat_id"));

	$message = $thumb_message . '<br /><br />' . sprintf($user->lang['CLICK_RETURN_THUMBS'], '<a href="' . append_sid("{$phpbb_root_path}downloads.$phpEx", "view=thumbs&amp;df_id=$df_id&amp;cat=$cat_id") . '">', '</a>');

	trigger_error($message);
}

$template->set_filenames(array(
	'body' => 'dl_mod/dl_thumbs_body.html')
);

add_form_key('dl_thumbs');

$description		= $dl_files['description'];
$desc_uid			= $dl_files['desc_uid'];
$desc_bitfield		= $dl_files['desc_bitfield'];
$desc_flags			= $dl_files['desc_flags'];
$description		= generate_text_for_display($description, $desc_uid, $desc_bitfield, $desc_flags);

$s_hidden_fields = array(
	'img_id'		=> $img_id,
	'edit_img_link'	=> $edit_img_link,
	'df_id'			=> $df_id,
);

$thumb_max_size = sprintf($user->lang['DL_THUMB_DIM_SIZE'], $config['dl_thumb_xsize'], $config['dl_thumb_ysize'], dl_format::dl_size($config['dl_thumb_fsize']));

$sql = 'SELECT * FROM ' . DL_IMAGES_TABLE . '
	WHERE dl_id = ' . (int) $df_id;
$result = $db->sql_query($sql);

while ($row = $db->sql_fetchrow($result))
{
	$template->assign_block_vars('thumbnails', array(
		'IMG_LINK'	=> $phpbb_root_path . 'dl_mod/thumbs/' . str_replace(" ", "%20", $row['img_name']),
		'IMG_TITLE'	=> $row['img_title'],

		'U_DELETE'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=thumbs&amp;action=delete&amp;cat_id=$cat_id&amp;df_id=$df_id&amp;img_id=" . $row['img_id']),
		'U_EDIT'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=thumbs&amp;action=edit&amp;cat_id=$cat_id&amp;df_id=$df_id&amp;img_id=" . $row['img_id']),
	));
}
$db->sql_freeresult($result);

$template->assign_vars(array(
	'DL_THUMBS_SECOND'	=> $description,
	'DL_THUMB_MAX_SIZE'	=> $thumb_max_size,

	'EDIT_IMG_TITLE'	=> $edit_img_title,

	'ENCTYPE'			=> 'enctype="multipart/form-data"',

	'S_FORM_ACTION'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=thumbs"),
	'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields))
);

?>