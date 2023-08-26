<?php

/**
*
* @mod package		Download Mod 6
* @file				dl_comments.php 21 2014/04/13 OXPUS
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
* check general permissions
*/
if (!dl_auth::cat_auth_comment_read($cat_id))
{
	trigger_error('DL_NO_PERMISSION');
}

$cat_auth = array();
$cat_auth = dl_auth::dl_cat_auth($cat_id);

if (!$cat_auth['auth_view'] && !$index[$cat_id]['auth_view'] && !$auth->acl_get('a_'))
{
	trigger_error('DL_NO_PERMISSION');
}

/*
* redirect to download details if comments are disabled for this category
*/
if (!$index[$cat_id]['comments'])
{
	$view = 'detail';
	$action = '';
}

/*
* redirect to comments list if comment editing was canceled
*/
if ($goback)
{
	$view = 'comment';
	$action = 'view';
	$cancel = '';
}

/*
* someone cancel a job? list the list again and again...
*/
if ($cancel && $action == 'delete')
{
	$action = 'view';
}

/*
* take the message if entered
*/
$comment_text = utf8_normalize_nfc(request_var('message', '', true));

/*
* check permissions to manage comments
*/
$sql = 'SELECT user_id FROM ' . DL_COMMENTS_TABLE . '
	WHERE id = ' . (int) $df_id . '
		AND dl_id = ' . (int) $dl_id . '
		AND approve = ' . true . '
		AND cat_id = ' . (int) $cat_id;
$result = $db->sql_query($sql);
$row_user = $db->sql_fetchfield('user_id');
$db->sql_freeresult($result);

$allow_manage = 0;
    if (($row_user == $user->data['user_id'] || $cat_auth['auth_mod'] || $index[$cat_id]['auth_mod'] || $auth->acl_get('a_')) && $user->data['is_registered'])
	{
	$allow_manage = true;
}

$deny_post = false;
if (!dl_auth::cat_auth_comment_post($cat_id))
{
	$allow_manage = 0;
	$deny_post = true;
}

/*
* open the comments view for this download if allowed
*/
if ($action)
{
	$inc_module = true;
	$page_title = $user->lang['DL_COMMENTS'];

	if ($action == 'save' && !$deny_post)
	{
		// check form
		if (!check_form_key('posting'))
		{
			trigger_error($user->lang['FORM_INVALID'], E_USER_WARNING);
		}
	
		$allow_bbcode	= ($config['allow_bbcode']) ? true : false;
		$allow_urls		= true;
		$allow_smilies	= ($config['allow_smilies']) ? true : false;
		$com_uid		= '';
		$com_bitfield	= '';
		$com_flags		= 0;
	
		generate_text_for_storage($comment_text, $com_uid, $com_bitfield, $com_flags, $allow_bbcode, $allow_urls, $allow_smilies);
	
		$sql = 'SELECT description FROM ' . DOWNLOADS_TABLE . '
			WHERE id = ' . (int) $df_id;
		$result = $db->sql_query($sql);
		$description = $db->sql_fetchfield('description');
		$db->sql_freeresult($result);
	
		if ($index[$cat_id]['approve_comments'] || dl_auth::user_admin())
		{
			$approve = true;
		}
		else
		{
			$approve = 0;
		}
	
		if ($dl_id)
		{
			$sql = 'UPDATE ' . DL_COMMENTS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
				'comment_edit_time'	=> time(),
				'comment_text'		=> $comment_text,
				'com_uid'			=> $com_uid,
				'com_bitfield'		=> $com_bitfield,
				'com_flags'			=> $com_flags,
				'approve'			=> $approve)) . ' WHERE dl_id = ' . (int) $dl_id;
			$db->sql_query($sql);
	
			$comment_message = $user->lang['DL_COMMENT_UPDATED'];
		}
		else
		{
			$sql = 'INSERT INTO ' . DL_COMMENTS_TABLE . ' ' . $db->sql_build_array('INSERT', array(
				'id'				=> $df_id,
				'cat_id'			=> $cat_id,
				'user_id'			=> $user->data['user_id'],
				'username'			=> $user->data['username'],
				'comment_time'		=> time(),
				'comment_edit_time'	=> time(),
				'comment_text'		=> $comment_text,
				'com_uid'			=> $com_uid,
				'com_bitfield'		=> $com_bitfield,
				'com_flags'			=> $com_flags,
				'approve'			=> $approve));
			$db->sql_query($sql);
	
			$comment_message = $user->lang['DL_COMMENT_ADDED'];
		}
	
		if (!$approve)
		{
			$processing_user = (dl_auth::cat_auth_comment_read($cat_id) == 3) ? 0 : dl_auth::dl_auth_users($cat_id, 'auth_mod');
	
			$sql = 'SELECT user_email, username, user_lang FROM ' . USERS_TABLE . '
				WHERE ' . $db->sql_in_set('user_id', explode(',', $processing_user)) . '
					OR user_type = ' . USER_FOUNDER;

			$mail_data = array(
				'query'				=> $sql,
				'email_template'	=> 'downloads_approve_comment',
				'cat_id'			=> $cat_id,
				'df_id'				=> $df_id,
				'description'		=> $description,
				'cat_name'			=> $index[$cat_id]['cat_name_nav'],
			);						

			dl_email::send_comment_notify($mail_data);

			$approve_message	= '';
			$return_parameters	= "view=comment&amp;action=view&amp;cat_id=$cat_id&amp;df_id=$df_id";
			$return_text		= $user->lang['CLICK_RETURN_COMMENTS'];
		}
		else
		{
			$sql = 'SELECT fav_user_id FROM ' . DL_FAVORITES_TABLE . '
				WHERE fav_dl_id = ' . (int) $df_id;
			$result = $db->sql_query($sql);
	
			$fav_user = array();
	
			while ($row = $db->sql_fetchrow($result))
			{
				$fav_user[] = $row['fav_user_id'];
			}
	
			$db->sql_freeresult($result);
	
			if (!$config['dl_disable_email'] && $fav_user)
			{
				$sql_fav_user = (sizeof($fav_user)) ? ' AND ' . $db->sql_in_set('user_id', $fav_user) : '';
				$com_perms = $index[$cat_id]['auth_cread'];
				$sql_user = '';
	
				switch ($com_perms)
				{
					case 0:
					case 1:
						if ($sql_fav_user)
						{
							$sql_user = $sql_fav_user;
							$send_notify = true;
						}
						else
						{
							$send_notify = false;
						}
					break;
	
					case 2:
						$processing_user = dl_auth::dl_auth_users($cat_id, 'auth_mod');
						if ($processing_user)
						{
							$sql_user .= ' AND ' . $db->sql_in_set('user_id', explode(',', $processing_user));
							$send_notify = true;
						}
	
						if ($sql_fav_user)
						{
							$sql_user .= $sql_fav_user;
							$send_notify = true;
						}
						else
						{
							$send_notify = false;
						}
					break;
	
					case 3:
					default:
						$sql_user = '';
						$send_notify = false;
					break;
				}
	
				if ($send_notify)
				{
					$sql = 'SELECT user_email, username, user_lang FROM ' . USERS_TABLE . '
						WHERE user_id <> ' . (int) $user->data['user_id'] . ' 
							AND user_allow_fav_download_email = 1 
							AND user_allow_fav_comment_email = 1' . $sql_fav_user;

					$mail_data = array(
						'query'				=> $sql,
						'email_template'	=> 'downloads_comment_notify',
						'cat_id'			=> $cat_id,
						'df_id'				=> $df_id,
						'description'		=> $description,
						'cat_name'			=> $index[$cat_id]['cat_name_nav'],
					);						

					dl_email::send_comment_notify($mail_data);
				}
			}
	
			$approve_message	= '<br />' . $user->lang['DL_MUST_BE_APPROVE_COMMENT'];
			$return_parameters	= "view=detail&amp;df_id=$df_id";
			$return_text		= $user->lang['CLICK_RETURN_DOWNLOAD_DETAILS'];
		}
	
		$message = $comment_message . $approve_message . '<br /><br />' . sprintf($return_text, '<a href="' . append_sid("{$phpbb_root_path}downloads.$phpEx", $return_parameters) . '">', '</a>');
	
		meta_refresh(3, append_sid("{$phpbb_root_path}downloads.$phpEx", "view=comment&amp;action=view&amp;cat_id=$cat_id&amp;df_id=$df_id"));
	
		trigger_error($message);
	}
	
	if ($action == 'delete' && $allow_manage)
	{
		// Delete comment by poster or admin or dl_mod
		if (!$confirm)
		{
			// Confirm deletion
			$s_hidden_fields = array(
				'cat_id'	=> $cat_id,
				'df_id'		=> $df_id,
				'dl_id'		=> $dl_id,
				'action'	=> 'delete',
				'view'		=> 'comment'
			);
	
			$user->add_lang('posting');
	
			$template->set_filenames(array(
				'body' => 'dl_mod/dl_confirm_body.html')
			);
	
			page_header($user->lang['DOWNLOADS'] . ' :: ' . $user->lang['DELETE_MESSAGE']);
	
			add_form_key('dl_com_del');
	
			$template->assign_vars(array(
				'MESSAGE_TITLE' => $user->lang['DELETE_MESSAGE'],
				'MESSAGE_TEXT' => $user->lang['DELETE_MESSAGE_CONFIRM'],
	
				'S_CONFIRM_ACTION' => append_sid("{$phpbb_root_path}downloads.$phpEx"),
				'S_HIDDEN_FIELDS' => build_hidden_fields($s_hidden_fields))
			);
	
			page_footer();
		}
		else
		{
			if (!check_form_key('dl_com_del'))
			{
				trigger_error('FORM_INVALID');
			}
	
			$sql = 'DELETE FROM ' . DL_COMMENTS_TABLE . '
				WHERE cat_id = ' . (int) $cat_id . '
					AND id = ' . (int) $df_id . '
					AND dl_id = ' . (int) $dl_id;
			$db->sql_query($sql);
	
			$sql = 'SELECT dl_id FROM ' . DL_COMMENTS_TABLE . '
				WHERE cat_id = ' . (int) $cat_id . '
					AND id = ' . (int) $df_id;
			$result = $db->sql_query($sql);
			$total_comments = $db->sql_affectedrows($result);
			$db->sql_freeresult($result);
	
			if (!$total_comments)
			{
				redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$df_id"));
			}
			else
			{
				$action = 'view';
			}
		}
	}
	
	if (($action == 'edit' && $allow_manage) || ($action == 'post' && !$deny_post))
	{
		// Edit or add a comment
		if ($action == 'edit')
		{
			$sql = 'SELECT comment_text, com_uid, com_flags FROM ' . DL_COMMENTS_TABLE . '
				WHERE dl_id = ' . (int) $dl_id . '
					AND id = ' . (int) $df_id . '
					AND cat_id = ' . (int) $cat_id;
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
	
			$comment_text	= $row['comment_text'];
			$com_uid		= $row['com_uid'];
			$com_flags		= $row['com_flags'];
	
			$db->sql_freeresult($result);
	
			$text_ary		= generate_text_for_edit($comment_text, $com_uid, $com_flags);
			$comment_text	= $text_ary['text'];
		}
	
		$s_hidden_fields = array(
			'dl_id'		=> $dl_id,
			'df_id'		=> $df_id,
			'cat_id'	=> $cat_id,
			'action'	=> 'save',
			'view'		=> 'comment'
		);
	
		$template->set_filenames(array(
			'body' => 'dl_mod/dl_edit_comments_body.html')
		);
	
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
	
		$template->assign_vars(array(
			'COMMENT_TEXT'		=> $comment_text,
	
			'S_BBCODE_ALLOWED'	=> $bbcode_status,
			'S_BBCODE_IMG'		=> $img_status,
			'S_BBCODE_URL'		=> $url_status,
			'S_BBCODE_FLASH'	=> $flash_status,
			'S_BBCODE_QUOTE'	=> $quote_status,
	
			'S_FORM_ACTION'		=> append_sid("{$phpbb_root_path}downloads.$phpEx"),
			'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
	
			'U_MORE_SMILIES'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "action=smilies"),
		));
	
		page_header($user->lang['DOWNLOADS'] . ' :: ' . $user->lang['DL_COMMENT']);
	}
	
	if ($action == 'view' || !$action)
	{
		/*
		* view the comments - users default entry point
		*/
		$sql = 'SELECT * FROM ' . DL_COMMENTS_TABLE . '
			WHERE cat_id = ' . (int) $cat_id . '
				AND id = ' . (int) $df_id . '
				AND approve = ' . true;
		$result = $db->sql_query($sql);
		$total_comments = $db->sql_affectedrows($result);
		$db->sql_freeresult($result);

		if ($total_comments)
		{
			$comment_row = array();
	
			$sql = 'SELECT c.*, u.user_colour, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height FROM ' . DL_COMMENTS_TABLE . ' c
				LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = c.user_id
				WHERE c.cat_id = ' . (int) $cat_id . '
					AND c.id = ' . (int) $df_id . '
					AND c.approve = ' . true . '
				ORDER BY c.comment_time DESC';
			$result = $db->sql_query_limit($sql, $config['dl_links_per_page'], $start);
	
			while ($row = $db->sql_fetchrow($result))
			{
				$comment_row[] = $row;
			}
			$db->sql_freeresult($result);
	
			if ($total_comments > $config['dl_links_per_page'])
			{
				$pagination = generate_pagination(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=comment&amp;action=view&amp;cat_id=$cat_id&amp;df_id=$df_id"), $total_comments, $config['dl_links_per_page'], $start, true);
				$page_number = on_page($total_comments, $config['dl_links_per_page'], $start);
			}
			else
			{
				$pagination = '';
				$page_number = '';
			}
	
			$sql = 'SELECT description, desc_uid, desc_bitfield, desc_flags FROM ' . DOWNLOADS_TABLE . '
				WHERE id = ' . (int) $df_id;
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
	
			$description	= $row['description'];
			$desc_uid		= $row['desc_uid'];
			$desc_bitfield	= $row['desc_bitfield'];
			$desc_flags		= $row['desc_flags'];
	
			$db->sql_freeresult($result);
	
			$cat_name = $index[$cat_id]['cat_name'];
			$cat_name = str_replace("&nbsp;&nbsp;|___&nbsp;", "", $cat_name);
	
			page_header($user->lang['DOWNLOADS'] . ' :: ' . $user->lang['DL_COMMENTS']);
	
			$template->set_filenames(array(
				'body' => 'dl_mod/dl_view_comments_body.html')
			);
	
			$s_hidden_fields = array(
				'cat_id'	=> $cat_id,
				'df_id'		=> $df_id
			);
	
			$template->assign_vars(array(
				'L_POST_COMMENT'	=> ($deny_post) ? '' : $user->lang['DL_COMMENT_WRITE'],
	
				'CAT_NAME'			=> $cat_name,
				'DESCRIPTION'		=> generate_text_for_display($description, $desc_uid, $desc_bitfield, $desc_flags),
				'PAGINATION'		=> $pagination,
				'PAGE_NUMBER'		=> $page_number,
				'EDIT_IMG' 			=> $user->img('icon_post_edit', 'EDIT_POST'),
				'DELETE_IMG' 		=> $user->img('icon_post_delete', 'DELETE'),
	
				'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
				'S_FORM_ACTION'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=comment"),
			));
	
			if (!$deny_post)
			{
				$template->assign_var('S_COMMENT_BUTTON', true);
			}
	
			for($i = 0; $i < sizeof($comment_row); $i++)
			{
				$poster_id			= $comment_row[$i]['user_id'];
				$poster_colour		= $comment_row[$i]['user_colour'];
				$poster_avatar		= ($user->optionget('viewavatars')) ? get_user_avatar($comment_row[$i]['user_avatar'], $comment_row[$i]['user_avatar_type'], $comment_row[$i]['user_avatar_width'], $comment_row[$i]['user_avatar_height']) : '';
				$poster				= $comment_row[$i]['username'];
				$dl_id				= $comment_row[$i]['dl_id'];
	
				$message			= $comment_row[$i]['comment_text'];
				$com_uid			= $comment_row[$i]['com_uid'];
				$com_bitfield		= $comment_row[$i]['com_bitfield'];
				$com_flags			= $comment_row[$i]['com_flags'];
				$comment_time		= $comment_row[$i]['comment_time'];
				$comment_edit_time	= $comment_row[$i]['comment_edit_time'];
	
				$message = censor_text($message);
				$message = generate_text_for_display($message, $com_uid, $com_bitfield, $com_flags);
	
				if($comment_time <> $comment_edit_time)
				{
					$edited_by = sprintf($user->lang['DL_COMMENT_EDITED'], $user->format_date($comment_edit_time));
				}
				else
				{
					$edited_by = '';
				}
	
				if ($poster_id == 1)
				{
				}
				else
				{
					$poster		= get_username_string('full', $poster_id, $poster, $poster_colour);
				}
	
				$post_time = $user->format_date($comment_time);
	
				$u_delete_comment	= append_sid("{$phpbb_root_path}downloads.$phpEx", "view=comment&amp;action=delete&amp;cat_id=$cat_id&amp;df_id=$df_id&amp;dl_id=$dl_id");
				$u_edit_comment		= append_sid("{$phpbb_root_path}downloads.$phpEx", "view=comment&amp;action=edit&amp;cat_id=$cat_id&amp;df_id=$df_id&amp;dl_id=$dl_id");
	
				$template->assign_block_vars('comment_row', array(
					'EDITED_BY'			=> $edited_by,
					'POSTER'			=> $poster,
					'POSTER_AVATAR'		=> $poster_avatar,
					'MESSAGE'			=> $message,
					'POST_TIME'			=> $post_time,
					'DL_ID'				=> $dl_id,
	
					'U_DELETE_COMMENT'	=> $u_delete_comment,
					'U_EDIT_COMMENT'	=> ($deny_post) ? '' : $u_edit_comment)
				);
	
                if (($poster_id == $user->data['user_id'] || $cat_auth['auth_mod'] || $index[$cat_id]['auth_mod'] || $auth->acl_get('a_')) && $user->data['is_registered'] && !$deny_post)
				{
					$template->assign_block_vars('comment_row.action_button', array());
				}
			}
		}
		else
		{
			redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$df_id"));
		}
	}
}
else
{
	if ($df_id)
	{
		redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&df_id=$df_id"));
	}
	else if ($cat_id)
	{
		redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "cat=$cat_id"));
	}
	else
	{
		redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
	}
}

?>