<?php
/**
*
* @package k_links
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

function k_links_stage_upload($file, $user_id, &$staged, &$error_msg)
{
	global $phpbb_root_path, $user;

	$staged = array();
	$error_msg = '';

	if (empty($file) || !is_array($file) || empty($file['name']))
	{
		return false;
	}

	if (!isset($file['error']) || (int) $file['error'] !== 0)
	{
		$error_msg = $user->lang['K_LINKS_UPLOAD_ERR'];
		return false;
	}

	if (empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name']))
	{
		$error_msg = $user->lang['K_LINKS_UPLOAD_ERR'];
		return false;
	}

	$original_name = basename(str_replace('\\', '/', $file['name']));
	$ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
	$allowed_ext = array('gif', 'jpg', 'jpeg', 'png');
	if (!in_array($ext, $allowed_ext))
	{
		$error_msg = $user->lang['K_LINKS_EXT_ERR'];
		return false;
	}

	$safe_name = preg_replace('#[^A-Za-z0-9._+@-]#', '', $original_name);
	if ($safe_name === '' || $safe_name === '.' || $safe_name === '..' || strpos($safe_name, '..') !== false || strtolower(pathinfo($safe_name, PATHINFO_EXTENSION)) !== $ext)
	{
		$error_msg = $user->lang['K_LINKS_UPLOAD_ERR'];
		return false;
	}

	$image_data = @getimagesize($file['tmp_name']);
	if (!$image_data || empty($image_data['mime']) || !in_array($image_data['mime'], array('image/gif', 'image/jpeg', 'image/png')))
	{
		$error_msg = $user->lang['K_LINKS_IMAGE_ERR'];
		return false;
	}

	if ((int) $image_data[0] > 200 || (int) $image_data[1] > 50)
	{
		$error_msg = isset($user->lang['K_LINKS_DIMENSION_ERR']) ? $user->lang['K_LINKS_DIMENSION_ERR'] : $user->lang['K_LINKS_IMAGE_ERR'];
		return false;
	}

	$tmp_dir = $phpbb_root_path . 'images/links/tmp/';

	if (!@file_exists($tmp_dir))
	{
		@mkdir($tmp_dir, 0775, true);
	}

	if (!@is_dir($tmp_dir) || !@is_writable($tmp_dir))
	{
		$error_msg = $user->lang['K_LINKS_TMP_DIR_ERR'];
		return false;
	}

	$stored = 'klink_' . (int) $user_id . '_' . time() . '_' . unique_id() . '.' . $ext;
	$dest = $tmp_dir . $stored;

	if (!@move_uploaded_file($file['tmp_name'], $dest))
	{
		$error_msg = $user->lang['K_LINKS_UPLOAD_ERR'];
		return false;
	}

	@chmod($dest, 0644);

	$staged = array(
		'logo_original'	=> (string) $file['name'],
		'logo_tmp'		=> (string) $stored,
		'logo_ext'		=> (string) $ext,
		'logo_size'		=> (int) $file['size'],
	);

	return true;
}

function k_links_queue_insert($forum_id, $topic_id, $post_id, $user_id, $staged)
{
	global $db;

	if (empty($staged['logo_tmp']) || !$post_id)
	{
		return;
	}

	$sql_ary = array(
		'post_id'		=> (int) $post_id,
		'topic_id'		=> (int) $topic_id,
		'forum_id'		=> (int) $forum_id,
		'user_id'		=> (int) $user_id,
		'logo_original'	=> (string) $staged['logo_original'],
		'logo_tmp'		=> (string) $staged['logo_tmp'],
		'logo_final'	=> '',
		'logo_ext'		=> (string) $staged['logo_ext'],
		'logo_size'		=> (int) $staged['logo_size'],
		'logo_status'	=> 0,
		'upload_time'	=> time(),
	);

	$sql = 'INSERT INTO ' . K_LINKS_QUEUE_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	$db->sql_query($sql);
}

function k_links_queue_approve_by_posts($post_id_list, $approver_id)
{
	global $db, $phpbb_root_path;

	if (!is_array($post_id_list) || !sizeof($post_id_list))
	{
		return;
	}

	$sql = 'SELECT *
		FROM ' . K_LINKS_QUEUE_TABLE . '
		WHERE ' . $db->sql_in_set('post_id', array_map('intval', $post_id_list)) . '
			AND logo_status = 0';
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$src = $phpbb_root_path . 'images/links/tmp/' . $row['logo_tmp'];
		if (!@file_exists($src))
		{
			continue;
		}

		$final_name = basename(str_replace('\\', '/', $row['logo_original']));
		$final_name = preg_replace('#[^A-Za-z0-9._+@-]#', '', $final_name);
		if ($final_name === '' || $final_name === '.' || $final_name === '..' || strpos($final_name, '..') !== false)
		{
			$final_name = $row['logo_tmp'];
		}
		$dst = $phpbb_root_path . 'images/links/' . $final_name;

		if (@file_exists($dst))
		{
			@unlink($dst);
		}

		if (@rename($src, $dst))
		{
			$sql = 'UPDATE ' . K_LINKS_QUEUE_TABLE . "
				SET logo_status = 1,
					logo_final = '" . $db->sql_escape($final_name) . "',
					approved_time = " . time() . ',
					approved_by = ' . (int) $approver_id . '
				WHERE queue_id = ' . (int) $row['queue_id'];
			$db->sql_query($sql);
		}
	}
	$db->sql_freeresult($result);
}
