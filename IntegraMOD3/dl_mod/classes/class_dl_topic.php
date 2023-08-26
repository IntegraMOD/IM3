<?php

/**
*
* @mod package		Download Mod 6
* @file				class_dl_topic.php 5 2014/09/01 OXPUS
* @copyright		(c) 2005 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class dl_topic extends dl_mod
{
	public function __construct()
	{
		return;
	}

	public function __destruct()
	{
		return;
	}

	public static function gen_dl_topic($dl_id, $force = false)
	{
		static $dl_index;

		global $db, $user, $config, $auth;
		global $dl_index;

		if (!$config['dl_enable_dl_topic'])
		{
			return;
		}

		$sql = 'SELECT id, description, dl_topic, long_desc, file_name, extern, file_size, cat, hack_version, add_user, long_desc_uid, long_desc_flags, desc_uid, desc_flags
			FROM ' . DOWNLOADS_TABLE . '
			WHERE id = ' . (int) $dl_id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if ($row['dl_topic'] && !$force)
		{
			return;
		}

		$description = $row['description'];
		$long_desc = $row['long_desc'];
		$file_name = $row['file_name'];
		$file_size = $row['file_size'];
		$extern = $row['extern'];
		$version = $row['hack_version'];

		$long_desc_uid			= $row['long_desc_uid'];
		$long_desc_flags		= $row['long_desc_flags'];
		$desc_uid				= $row['desc_uid'];
		$desc_flags				= $row['desc_flags'];

		$long_text		= generate_text_for_edit($long_desc, $long_desc_uid, $long_desc_flags);
		$long_desc		= $long_text['text'];
		$desc_text		= generate_text_for_edit($description, $desc_uid, $desc_flags);
		$description	= $desc_text['text'];

		$cat_id		= $row['cat'];
		$dl_title	= $description;
		if ($config['dl_topic_title_catname'])
		{
			$dl_title .= ' - ' . $dl_index[$cat_id]['cat_name_nav'];
		}

		$topic_text_add = "\n[b]" . $user->lang['DL_NAME'] . ":[/b] " . $description;
		if ($config['dl_topic_post_catname'])
		{
			$topic_text_add .= "\n[b]" . $user->lang['DL_CAT_NAME'] . ":[/b] " . $dl_index[$cat_id]['cat_name_nav'];
		}

		if ($config['dl_diff_topic_user'] == 1)
		{
			$sql = 'SELECT username, user_colour
				FROM ' . USERS_TABLE . '
				WHERE user_id = ' . (int) $row['add_user'];
			$result = $db->sql_query($sql);
			if ($db->sql_affectedrows($result))
			{
				$username = $db->sql_fetchfield('username');
				$user_colour = $db->sql_fetchfield('user_colour');
				$user_id = $row['add_user'];
			}
			else
			{
				$username = $user->data['username'];
				$user_colour = $user->data['user_colour'];
				$user_id = $user->data['user_id'];
			}
			$db->sql_freeresult($result);

			$author_full = get_username_string('full', $user_id, $username, $user_colour);
			$topic_text_add .= "\n[b]" . $user->lang['DL_HACK_AUTOR'] . ":[/b] " . $author_full;
		}
		else if ($config['dl_diff_topic_user'] == 2 && $dl_index[$cat_id]['diff_topic_user'])
		{
			$sql = 'SELECT username, user_colour
				FROM ' . USERS_TABLE . '
				WHERE user_id = ' . (int) $dl_index[$cat_id]['diff_topic_user'];
			$result = $db->sql_query($sql);
			if ($db->sql_affectedrows($result))
			{
				$username = $db->sql_fetchfield('username');
				$user_colour = $db->sql_fetchfield('user_colour');
				$user_id = $row['add_user'];
			}
			else
			{
				$username = $user->data['username'];
				$user_colour = $user->data['user_colour'];
				$user_id = $user->data['user_id'];
			}
			$db->sql_freeresult($result);

			$author_full = get_username_string('full', $user_id, $username, $user_colour);
			$topic_text_add .= "\n[b]" . $user->lang['DL_HACK_AUTOR'] . ":[/b] " . $author_full;
		}

		$topic_text_add .= "\n[b]" . $user->lang['DL_FILE_DESCRIPTION'] . ":[/b] " . html_entity_decode($long_desc);
		$topic_text_add .= "\n\n[b]" . $user->lang['DL_HACK_VERSION'] . ":[/b] " . $version;
		$topic_text_add .= "\n[b]" . (($extern) ? $user->lang['DL_EXTERN'] : $user->lang['DL_FILE_NAME']) . ":[/b] " . $file_name;
		$topic_text_add .= (($extern) ? '' : "\n[b]" . $user->lang['DL_FILE_SIZE'] . ":[/b] " . dl_format::dl_size($file_size));

		if ($config['dl_topic_forum'] == -1)
		{
			$topic_forum		= $dl_index[$cat_id]['dl_topic_forum'];
			$topic_text			= $dl_index[$cat_id]['dl_topic_text'];

			if ($dl_index[$cat_id]['topic_more_details'] == 1)
			{
				$topic_text .= $topic_text_add;
			}
			else if ($dl_index[$cat_id]['topic_more_details'] == 2)
			{
				$topic_text = $topic_text_add . "\n\n" . $topic_text;
			}
		}
		else
		{
			$topic_forum		= $config['dl_topic_forum'];
			$topic_text			= $config['dl_topic_text'];

			if ($config['dl_topic_more_details'] == 1)
			{
				$topic_text .= $topic_text_add;
			}
			else if ($config['dl_topic_more_details'] == 2)
			{
				$topic_text = $topic_text_add . "\n\n" . $topic_text;
			}
		}

		if (!$topic_forum)
		{
			return;
		}

		$reset_perms = false;

		if (!$config['dl_diff_topic_user'] || ($config['dl_diff_topic_user'] == 2 && !$dl_index[$cat_id]['diff_topic_user']))
		{
			$sql_tmp = 'SELECT user_id FROM ' . USERS_TABLE . ' WHERE user_id = ' . (int) $row['add_user'];
			$result_tmp = $db->sql_query($sql_tmp);
			if ($db->sql_affectedrows($result_tmp))
			{
				//Get add_user permissions
				$dl_topic_user_id = $row['add_user'];
				$reset_perms = true;
			}
			else
			{
				$dl_topic_user_id = $user->data['user_id'];
			}
			$db->sql_freeresult($result_tmp);
		}
		else if ($config['dl_diff_topic_user'] == 1 && $config['dl_topic_user'])
		{
			$sql_tmp = 'SELECT user_id FROM ' . USERS_TABLE . ' WHERE user_id = ' . (int) $config['dl_topic_user'];
			$result_tmp = $db->sql_query($sql_tmp);
			if ($db->sql_affectedrows($result_tmp))
			{
				//Get dl_topic_user permissions
				$dl_topic_user_id = $config['dl_topic_user'];
				$reset_perms = true;
			}
			else
			{
				$dl_topic_user_id = $user->data['user_id'];
			}
			$db->sql_freeresult($result_tmp);
		}
		else if ($config['dl_diff_topic_user'] == 2 && $dl_index[$cat_id]['diff_topic_user'])
		{
			$sql_tmp = 'SELECT user_id FROM ' . USERS_TABLE . ' WHERE user_id = ' . (int) $dl_index[$cat_id]['topic_user'];
			$result_tmp = $db->sql_query($sql_tmp);
			if ($db->sql_affectedrows($result_tmp))
			{
				//Get category topic_user permissions
				$dl_topic_user_id = $dl_index[$cat_id]['topic_user'];
				$reset_perms = true;
			}
			else
			{
				$dl_topic_user_id = $user->data['user_id'];
			}
			$db->sql_freeresult($result_tmp);
		}

		if ($reset_perms)
		{
			$perms = self::_change_auth($dl_topic_user_id);
		}

		if ($config['dl_topic_title_catname'])
		{
			$topic_title = utf8_normalize_nfc($dl_title);
		}
		else
		{
			$topic_title = utf8_normalize_nfc(sprintf($user->lang['DL_TOPIC_SUBJECT'], $dl_title));
		}

		$topic_text .= "\n\n[b]" . $user->lang['DL_VIEW_LINK'] . ':[/b] <!-- l --><a class="postlink-local" href="' . generate_board_url() . '/downloads' . dl_init::phpEx() . '?view=detail&amp;df_id=' . $dl_id . '">' . $dl_title . '</a><!-- l -->';

		$poll			= array();
		$update_message	= false;

		$sql = 'SELECT forum_parents, forum_name FROM ' . FORUMS_TABLE . '
			WHERE forum_id = ' . (int) $topic_forum;
		$result = $db->sql_query($sql);
		$post_data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$message = utf8_normalize_nfc($topic_text);

		$bbcode_status	= true;
		$smilies_status	= true;
		$img_status		= true;
		$url_status		= true;
		$flash_status	= ($auth->acl_get('f_flash', $topic_forum) && $config['allow_post_flash']) ? true : false;
		$quote_status	= true;
		$enable_sig		= true;

		if (!class_exists('parse_message'))
		{
			include(dl_init::phpbb_root_path() . 'includes/message_parser' . dl_init::phpEx());
		}
		$message_parser = new parse_message();

		if (isset($message))
		{
			$message_parser->message = &$message;
			unset($message);
		}
		$message_md5 = md5($message_parser->message);
		$message_parser->parse($bbcode_status, $url_status, $smilies_status, $img_status, $flash_status, $quote_status, $url_status);

		$data = array(
			'topic_title'			=> $topic_title,
			'topic_first_post_id'	=> 0,
			'topic_last_post_id'	=> 0,
			'topic_time_limit'		=> 0,
			'topic_attachment'		=> 0,
			'post_id'				=> 0,
			'topic_id'				=> 0,
			'forum_id'				=> (int) $topic_forum,
			'icon_id'				=> 0,
			'poster_id'				=> (int) $dl_topic_user_id,
			'enable_sig'			=> (bool) $enable_sig,
			'enable_bbcode'			=> (bool) $bbcode_status,
			'enable_smilies'		=> (bool) $smilies_status,
			'enable_urls'			=> (bool) $url_status,
			'enable_indexing'		=> 0,
			'message_md5'			=> (string) $message_md5,
			'post_time'				=> time(),
			'post_checksum'			=> '',
			'post_edit_reason'		=> '',
			'post_edit_user'		=> 0,
			'forum_parents'			=> $post_data['forum_parents'],
			'forum_name'			=> $post_data['forum_name'],
			'notify'				=> false,
			'notify_set'			=> 0,
			'poster_ip'				=> $user->data['user_ip'],
			'post_edit_locked'		=> 0,
			'bbcode_bitfield'		=> $message_parser->bbcode_bitfield,
			'bbcode_uid'			=> $message_parser->bbcode_uid,
			'message'				=> $message_parser->message,
		);

		if (!function_exists('submit_post'))
		{
			include(dl_init::phpbb_root_path() . 'includes/functions_posting' . dl_init::phpEx());
		}
		submit_post('post', $topic_title, $user->data['username'], POST_NORMAL, $poll, $data, $update_message, true);

		$dl_topic_id = (int) $data['topic_id'];

		$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
			'dl_topic' => $dl_topic_id)) . ' WHERE id = ' . (int) $dl_id;
		$db->sql_query($sql);

		if ($reset_perms)
		{
			//Restore user permissions
			self::_change_auth('', 'restore', $perms);
		}

		return;
	}

	public static function delete_topic($topic_ids)
	{
		if (!$topic_ids)
		{
			return;
		}

		if (!function_exists('recalc_nested_sets'))
		{
			include(dl_init::phpbb_root_path() . 'includes/functions_admin' . dl_init::phpEx());
		}

		$return = delete_topics('topic_id', $topic_ids);
	}

	public static function update_topic($topic_id, $dl_id)
	{
		static $dl_index;

		global $db, $user, $config, $auth;
		global $dl_index;

		if (!$topic_id || !$dl_id)
		{
			return;
		}

		$sql = 'SELECT topic_id FROM ' . TOPICS_TABLE . ' WHERE topic_id = ' . (int) $topic_id;
		$result = $db->sql_query($sql);
		$topic_exists = $db->sql_affectedrows($result);
		$db->sql_freeresult($result);

		if (!$topic_exists && $config['dl_enable_dl_topic'])
		{
			self::gen_dl_topic($dl_id, true);
			return;
		}

		$sql = 'SELECT id, description, dl_topic, long_desc, file_name, extern, file_size, cat, hack_version, add_user, long_desc_uid, long_desc_flags, desc_uid, desc_flags, dl_topic
			FROM ' . DOWNLOADS_TABLE . '
			WHERE id = ' . (int) $dl_id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$description = $row['description'];
		$long_desc = $row['long_desc'];
		$file_name = $row['file_name'];
		$file_size = $row['file_size'];
		$extern = $row['extern'];
		$version = $row['hack_version'];

		$long_desc_uid			= $row['long_desc_uid'];
		$long_desc_flags		= $row['long_desc_flags'];
		$desc_uid				= $row['desc_uid'];
		$desc_flags				= $row['desc_flags'];

		$long_text		= generate_text_for_edit($long_desc, $long_desc_uid, $long_desc_flags);
		$long_desc		= $long_text['text'];
		$desc_text		= generate_text_for_edit($description, $desc_uid, $desc_flags);
		$description	= $desc_text['text'];

		$cat_id		= $row['cat'];
		$dl_title	= $description;
		if ($config['dl_topic_title_catname'])
		{
			$dl_title .= ' - ' . $dl_index[$cat_id]['cat_name_nav'];
		}

		$topic_text_add = "\n[b]" . $user->lang['DL_NAME'] . ":[/b] " . $description;
		if ($config['dl_topic_post_catname'])
		{
			$topic_text_add .= "\n[b]" . $user->lang['DL_CAT_NAME'] . ":[/b] " . $dl_index[$cat_id]['cat_name_nav'];
		}

		if ($config['dl_diff_topic_user'] == 1)
		{
			$sql = 'SELECT username, user_colour
				FROM ' . USERS_TABLE . '
				WHERE user_id = ' . (int) $row['add_user'];
			$result = $db->sql_query($sql);
			if ($db->sql_affectedrows($result))
			{
				$username = $db->sql_fetchfield('username');
				$user_colour = $db->sql_fetchfield('user_colour');
				$user_id = $row['add_user'];
			}
			else
			{
				$username = $user->data['username'];
				$user_colour = $user->data['user_colour'];
				$user_id = $user->data['user_id'];
			}
			$db->sql_freeresult($result);

			$author_full = get_username_string('full', $user_id, $username, $user_colour);
			$topic_text_add .= "\n[b]" . $user->lang['DL_HACK_AUTOR'] . ":[/b] " . $author_full;
		}
		else if ($config['dl_diff_topic_user'] == 2 && $dl_index[$cat_id]['diff_topic_user'])
		{
			$sql = 'SELECT username, user_colour
				FROM ' . USERS_TABLE . '
				WHERE user_id = ' . (int) $dl_index[$cat_id]['diff_topic_user'];
			$result = $db->sql_query($sql);
			if ($db->sql_affectedrows($result))
			{
				$username = $db->sql_fetchfield('username');
				$user_colour = $db->sql_fetchfield('user_colour');
				$user_id = $dl_index[$cat_id]['diff_topic_user'];
			}
			else
			{
				$username = $user->data['username'];
				$user_colour = $user->data['user_colour'];
				$user_id = $user->data['user_id'];
			}
			$db->sql_freeresult($result);

			$author_full = get_username_string('full', $user_id, $username, $user_colour);
			$topic_text_add .= "\n[b]" . $user->lang['DL_HACK_AUTOR'] . ":[/b] " . $author_full;
		}

		$topic_text_add .= "\n[b]" . $user->lang['DL_FILE_DESCRIPTION'] . ":[/b] " . html_entity_decode($long_desc);
		$topic_text_add .= "\n\n[b]" . $user->lang['DL_HACK_VERSION'] . ":[/b] " . $version;
		$topic_text_add .= "\n[b]" . (($extern) ? $user->lang['DL_EXTERN'] : $user->lang['DL_FILE_NAME']) . ":[/b] " . $file_name;
		$topic_text_add .= (($extern) ? '' : "\n[b]" . $user->lang['DL_FILE_SIZE'] . ":[/b] " . dl_format::dl_size($file_size));

		if ($config['dl_topic_forum'] == -1)
		{
			$topic_forum		= $dl_index[$cat_id]['dl_topic_forum'];
			$topic_text			= $dl_index[$cat_id]['dl_topic_text'];

			if ($dl_index[$cat_id]['topic_more_details'] == 1)
			{
				$topic_text .= $topic_text_add;
			}
			else if ($dl_index[$cat_id]['topic_more_details'] == 2)
			{
				$topic_text = $topic_text_add . "\n\n" . $topic_text;
			}
		}
		else
		{
			$topic_forum		= $config['dl_topic_forum'];
			$topic_text			= $config['dl_topic_text'];

			if ($config['dl_topic_more_details'] == 1)
			{
				$topic_text .= $topic_text_add;
			}
			else if ($config['dl_topic_more_details'] == 2)
			{
				$topic_text = $topic_text_add . "\n\n" . $topic_text;
			}
		}

		if (!$topic_forum)
		{
			return;
		}

		$reset_perms = false;

		if (!$config['dl_diff_topic_user'] || ($config['dl_diff_topic_user'] == 2 && !$dl_index[$cat_id]['diff_topic_user']))
		{
			$sql_tmp = 'SELECT user_id FROM ' . USERS_TABLE . ' WHERE user_id = ' . (int) $row['add_user'];
			$result_tmp = $db->sql_query($sql_tmp);
			if ($db->sql_affectedrows($result_tmp))
			{
				//Get add_user permissions
				$dl_topic_user_id = $row['add_user'];
				$reset_perms = true;
			}
			else
			{
				$dl_topic_user_id = $user->data['user_id'];
			}
			$db->sql_freeresult($result_tmp);
		}
		else if ($config['dl_diff_topic_user'] == 1 && $config['dl_topic_user'])
		{
			$sql_tmp = 'SELECT user_id FROM ' . USERS_TABLE . ' WHERE user_id = ' . (int) $config['dl_topic_user'];
			$result_tmp = $db->sql_query($sql_tmp);
			if ($db->sql_affectedrows($result_tmp))
			{
				//Get dl_topic_user permissions
				$dl_topic_user_id = $config['dl_topic_user'];
				$reset_perms = true;
			}
			else
			{
				$dl_topic_user_id = $user->data['user_id'];
			}
			$db->sql_freeresult($result_tmp);
		}
		else if ($config['dl_diff_topic_user'] == 2 && $dl_index[$cat_id]['diff_topic_user'])
		{
			$sql_tmp = 'SELECT user_id FROM ' . USERS_TABLE . ' WHERE user_id = ' . (int) $dl_index[$cat_id]['topic_user'];
			$result_tmp = $db->sql_query($sql_tmp);
			if ($db->sql_affectedrows($result_tmp))
			{
				//Get category topic_user permissions
				$dl_topic_user_id = $dl_index[$cat_id]['topic_user'];
				$reset_perms = true;
			}
			else
			{
				$dl_topic_user_id = $user->data['user_id'];
			}
			$db->sql_freeresult($result_tmp);
		}

		if ($reset_perms)
		{
			$perms = self::_change_auth($dl_topic_user_id);
		}

		if ($config['dl_topic_title_catname'])
		{
			$topic_title = utf8_normalize_nfc($dl_title);
		}
		else
		{
			$topic_title = utf8_normalize_nfc(sprintf($user->lang['DL_TOPIC_SUBJECT'], $dl_title));
		}
		$topic_text .= "\n\n[b]" . $user->lang['DL_VIEW_LINK'] . ':[/b] <!-- l --><a class="postlink-local" href="' . generate_board_url() . '/downloads' . dl_init::phpEx() . '?view=detail&amp;df_id=' . $dl_id . '">' . $dl_title . '</a><!-- l -->';

		$poll = $forum_data = $post_data = array();
		$update_message	= true;

		$sql = 'SELECT forum_parents, forum_name FROM ' . FORUMS_TABLE . '
			WHERE forum_id = ' . (int) $topic_forum;
		$result = $db->sql_query($sql);
		$forum_data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$sql = 'SELECT topic_first_post_id, topic_replies, topic_replies_real, topic_last_post_id, topic_time FROM ' . TOPICS_TABLE . '
			WHERE topic_id = ' . (int) $topic_id;
		$result = $db->sql_query($sql);
		$post_data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		$post_id = $post_data['topic_first_post_id'];
		$message = utf8_normalize_nfc($topic_text);

		$bbcode_status	= true;
		$smilies_status	= true;
		$img_status		= true;
		$url_status		= true;
		$flash_status	= ($auth->acl_get('f_flash', $topic_forum) && $config['allow_post_flash']) ? true : false;
		$quote_status	= true;
		$enable_sig		= true;

		if (!class_exists('parse_message'))
		{
			include(dl_init::phpbb_root_path() . 'includes/message_parser' . dl_init::phpEx());
		}

		$message_parser = new parse_message();

		if (isset($message))
		{
			$message_parser->message = &$message;
			unset($message);
		}
		$message_md5 = md5($message_parser->message);
		$message_parser->parse($bbcode_status, $url_status, $smilies_status, $img_status, $flash_status, $quote_status, $url_status);

		$data = array(
			'topic_title'			=> $topic_title,
			'topic_first_post_id'	=> (int) $post_data['topic_first_post_id'],
			'topic_last_post_id'	=> (int) $post_data['topic_last_post_id'],
			'topic_time_limit'		=> 0,
			'topic_replies_real'	=> (int) $post_data['topic_replies_real'],
			'topic_replies'			=> (int) $post_data['topic_replies'],
			'topic_attachment'		=> 0,
			'post_id'				=> (int) $post_id,
			'topic_id'				=> (int) $topic_id,
			'forum_id'				=> (int) $topic_forum,
			'icon_id'				=> 0,
			'poster_id'				=> (int) $dl_topic_user_id,
			'enable_sig'			=> (bool) $enable_sig,
			'enable_bbcode'			=> (bool) $bbcode_status,
			'enable_smilies'		=> (bool) $smilies_status,
			'enable_urls'			=> (bool) $url_status,
			'enable_indexing'		=> 0,
			'message_md5'			=> (string) $message_md5,
			'post_time'				=> (int) $post_data['topic_time'],
			'post_checksum'			=> '',
			'post_edit_reason'		=> $user->lang['DOWNLOAD_UPDATED'],
			'post_edit_user'		=> (int) $user->data['user_id'],
			'forum_parents'			=> $forum_data['forum_parents'],
			'forum_name'			=> $forum_data['forum_name'],
			'notify'				=> false,
			'notify_set'			=> 0,
			'poster_ip'				=> $user->data['user_ip'],
			'post_edit_locked'		=> 0,
			'bbcode_bitfield'		=> $message_parser->bbcode_bitfield,
			'bbcode_uid'			=> $message_parser->bbcode_uid,
			'message'				=> $message_parser->message,
		);

		if (!function_exists('submit_post'))
		{
			include(dl_init::phpbb_root_path() . 'includes/functions_posting' . dl_init::phpEx());
		}
		submit_post('edit', $topic_title, $user->data['username'], POST_NORMAL, $poll, $data, $update_message, true);

		// We need to sync the forum if we changed from current user to user id and back to get the correct colour, so do this for every updated download
		if (!function_exists('sync'))
		{
			include(dl_init::phpbb_root_path() . 'includes/functions_admin' . dl_init::phpEx());
		}
		sync('topic', 'topic_id', $topic_id, false, false);
		sync('forum', 'forum_id', $topic_forum, false, false);

		if ($reset_perms)
		{
			//Restore user permissions
			self::_change_auth('', 'restore', $perms);
		}
	}

	/**
	* _change_auth
	* Added by Mickroz for changing permissions
	* code by poppertom69 & RMcGirr83
	* private - not for public use!
	*/
	private static function _change_auth($user_id, $mode = 'replace', $bkup_data = false)
	{
		global $auth, $db, $config, $user;

		switch($mode)
		{
			case 'replace':

				$bkup_data = array(
					'user_backup'	=> $user->data,
				);

				// sql to get the users info
				$sql = 'SELECT *
					FROM ' . USERS_TABLE . '
					WHERE user_id = ' . (int) $user_id;
				$result	= $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				// reset the current users info to that of the bot
				$user->data = array_merge($user->data, $row);

				unset($row);

				return $bkup_data;

			break;

			// now we restore the users stuff
			case 'restore':

				$user->data = $bkup_data['user_backup'];

				unset($bkup_data);

			break;
		}
	}
}

?>