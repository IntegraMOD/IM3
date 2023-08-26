<?php
/**
*
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package Knowledge_Base
* @version $Id: kbposting.php 50 2009-06-15 20:31:16Z tobi.schaefer $
* @copyright (c) 2007 SEO phpBB http://www.phpbb-seo.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/message_parser.' . $phpEx);
include($phpbb_root_path . 'includes/functions_kb.' . $phpEx);
include('kb_common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('posting', 'mods/kb'));



$config['allow_pm_attach'] = $config['allow_attachments'];

$submit			= (isset($_POST['post'])) ? true : false;
$preview		= (isset($_POST['preview'])) ? true : false;
$article_id 			= request_var('id', 0);
$refresh		= (isset($_POST['add_file']) || isset($_POST['delete_file'])) ? true : false;
$error			= array();
$mode			= request_var('mode', '');
$cat_id			= request_var('cat_id', '');


$data['post_id']			= request_var('post_id', 0);
$data['cat_id'] 			= request_var('cat_id', 0);
$data['activ'] 				= request_var('activ', 0);
$data['type_id']			= request_var('type_id', 0);
$data['user_id']			= request_var('user', 0);
$data['post_time'] 			= request_var('post_time', time());
$data['edit_reason']		= utf8_normalize_nfc(request_var('edit_reason', '', true));
$data['title'] 				= utf8_normalize_nfc(request_var('title', '', true));
$data['description'] 		= utf8_normalize_nfc(request_var('description', '', true));
$data['message'] 			= $post_message = utf8_normalize_nfc(request_var('message', '', true));
$data['bbcode_checked']		= (isset($_POST['disable_bbcode'])) ? false : true;
$data['smilies_checked']	= (isset($_POST['disable_smilies'])) ? false : true;
$data['urls_checked']		= (isset($_POST['disable_magic_url'])) ? false : true;
$data['post_attachment']	= request_var('post_attachment', 0);
$data['activ']				= ($auth->acl_get('m_activate_kb')) ? request_var('activ', 1) : 0;
$data['page_uri'] 			= (KB_SEO == true) ? htmlentities(request_var('page_uri', '')) : '';


add_form_key('kb_posting');


if ($mode == 'popup')
{
	upload_popup();
	exit_handler();
}


$sql = 'SELECT *
	FROM ' . KB_ARTICLE_TABLE . '
	WHERE article_id = ' . (int) $article_id;
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);


if ($mode == 'edit' && empty($row))
{
	$redirect_url = append_sid("{$kb_root_path}");
	meta_refresh(3, $redirect_url);
	trigger_error($user->lang['NO_ARTICLE'] . '<br /><br />' . sprintf($user->lang['BACK_TO_KB'], '<a href="' . append_sid("{$kb_root_path}") . '">', '</a>'));
}

if (!$auth->acl_get('kb_add_article', $data['cat_id']) && !$auth->acl_get('kb_edit_article', $row['cat_id']) && !$auth->acl_get('edit_all_article', $row['cat_id']) && !$auth->acl_get('m_edit_kb'))
{
	trigger_error('NOT_AUTHORISED');
}


$message_parser = new parse_message();
$poll_bbcode = new bbcode();

if ($auth->acl_get('kb_attache_article', $row['cat_id']) && $config['allow_attachments'])
{
	$message_parser->get_submitted_attachment_data();
	$message_parser->parse_attachments('fileupload', $mode, 0, $submit, $preview, $refresh);
}

// preview
if ($preview == true)
{
	$uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
	generate_text_for_storage($data['message'], $uid, $bitfield, $options, $data['bbcode_checked'], $data['urls_checked'], $data['smilies_checked']);
	$preview_message = generate_text_for_display($data['message'], $uid, $bitfield, $options);

	// Attachment Preview
	if (sizeof($message_parser->attachment_data))
	{
		$template->assign_var('S_HAS_ATTACHMENTS', true && $auth->acl_get('u_attach'));
	
		$update_count = array();
		$attachment_data = $message_parser->attachment_data;
		parse_attachments(0, $preview_message, $attachment_data, $update_count, true);

		foreach ($attachment_data as $i => $attachment)
		{
			$template->assign_block_vars('attachment', array(
				'DISPLAY_ATTACHMENT'	=> $attachment)
			);
		}
		unset($attachment_data);
	}

	$template->assign_vars(array(
		'PREVIEW_SUBJECT'	=> $data['title'],
		'PREVIEW_MESSAGE'	=> $preview_message,
		'S_DISPLAY_PREVIEW'	=> true)
	);
}

// Make SQL array
if ($submit == true && $preview == false)
{
	if (!check_form_key('kb_posting'))
	{
		$error[] = $user->lang['FORM_INVALID'];
	}

	if(KB_SEO == true)
	{
		$sql_where = ($mode == 'edit') ? ' AND article_id != ' . (int) $article_id : '';
		$sql = 'SELECT page_uri
			FROM ' . KB_ARTICLE_TABLE . '
			WHERE page_uri = "' . $data['page_uri'] . '"' .
				$sql_where;
		$result = $db->sql_query($sql);
		$arow = $db->sql_fetchrow($result);
		if(!empty($arow['page_uri']))
		{
			$error[] = $user->lang['URI_IN_USE'];
		}
	}


	if(empty($data['title']) || empty($data['message']) || empty($data['cat_id']))
	{
		$error[] = $user->lang['NEED_INPUT'];
	}

	$uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
	generate_text_for_storage($data['message'], $uid, $bitfield, $options, $data['bbcode_checked'], $data['urls_checked'], $data['smilies_checked']);

	$sql_ary = array(
		'titel'				=> $data['title'],
		'article'			=> $data['message'],
		'description'		=> $data['description'],
		'type_id'			=> $data['type_id'],
		'enable_bbcode' 	=> $data['bbcode_checked'],
		'enable_smilies' 	=> $data['smilies_checked'],
		'enable_magic_url'	=> $data['urls_checked'],
		'post_id'			=> $data['post_id'],
		'last_edit_user'	=> $user->data['user_id'],
		'last_change'		=> time(),
		'bbcode_bitfield'	=> $bitfield,
		'bbcode_uid'		=> $uid,
		'bbcode_options' 	=> $options,
		'has_attachment'	=> sizeof($message_parser->attachment_data) ? '1' : '0',
	);

	if($mode != 'edit')
	{
		$sql_ary1 = array(
			'cat_id'			=> $data['cat_id'],
		);
		$sql_ary = array_merge($sql_ary, $sql_ary1);	
	}
	if(KB_SEO == true)
	{
		$sql_ary1 = array(
			'page_uri'	=> $data['page_uri'],
		);
		$sql_ary = array_merge($sql_ary, $sql_ary1);	
	}
}


// submit
if ($submit == true && $mode != 'edit' && $preview == false && $auth->acl_get('kb_add_article', $data['cat_id']) && !sizeof($error))
{
	$sql_ary1 = array(
		'post_time'	=> time(),
		'user_id'	=> $user->data['user_id'],
	);
	$sql_ary = array_merge($sql_ary, $sql_ary1);

	$db->sql_query('INSERT INTO ' . KB_ARTICLE_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
	$article_id = $db->sql_nextid();
	article_log($article_id, $user->lang['ARTICLE_POSTET']);

	if ($auth->acl_get('kb_attache_article', $row['cat_id']) && $config['allow_attachments'])
	{
		$attach_data = array(
			'poster_id'			=> $user->data['user_id'],
			'post_id'			=> $article_id,
			'attachment_data'	=> $message_parser->attachment_data,
		);
		post_attacement($attach_data);
	}

	if(isset($_POST['activ']) || $auth->acl_get('kb_add_article_direct', $data['cat_id']))
	{
		activate_article($article_id);
		$redirect_url = article_link($article_id, $data['page_uri']);
		meta_refresh(3, $redirect_url);
		trigger_error($user->lang['ARTICLE_ADDED_AKTIV'] . '<br /><br />' . sprintf($user->lang['BACK_TO_KB'], '<a href="' . append_sid("{$kb_root_path}") . '">', '</a>') . '<br /><br />'. sprintf($user->lang['BACK_TO_ARTICLE'], '<a href="' . $redirect_url . '">', '</a>'));
	}
	else
	{
		$redirect_url = append_sid("{$kb_root_path}");
		meta_refresh(3, $redirect_url);
		trigger_error($user->lang['ARTICLE_ADDED'] . '<br /><br />' . sprintf($user->lang['BACK_TO_KB'], '<a href="' . append_sid("{$kb_root_path}") . '">', '</a>'));
	}
}

// Edit
if ($mode == 'edit' && ($auth->acl_get('kb_edit_article', $row['cat_id']) || $auth->acl_get('kb_edit_all_article', $row['cat_id']) || $auth->acl_get('m_edit_kb')) && $preview == false && !sizeof($error))
{
	if ($row['user_id'] != $user->data['user_id'] && !$auth->acl_get('m_edit_kb') && !$auth->acl_get('kb_edit_all_article', $row['cat_id']))
	{
		$redirect_url = append_sid("{$kb_root_path}");
		meta_refresh(3, $redirect_url);
		trigger_error($user->lang['NOT_AUTHORISED'] . '<br /><br />' . sprintf($user->lang['BACK_TO_KB'], '<a href="' . append_sid("{$kb_root_path}") . '">', '</a>'));
	}

	if ($row['has_attachment'] && !$submit && !$refresh && $auth->acl_get('kb_attache_article', $row['cat_id']) && $config['allow_attachments'])
	{
		// Do not change to SELECT *
		$sql = 'SELECT attach_id, is_orphan, attach_comment, real_filename
			FROM ' . ATTACHMENTS_TABLE . '
			WHERE post_msg_id = ' . $row['article_id'] . '
				AND in_message = 2
				AND topic_id = 0
				AND is_orphan = 0
			ORDER BY filetime DESC';
		$result = $db->sql_query($sql);
		$message_parser->attachment_data = array_merge($message_parser->attachment_data, $db->sql_fetchrowset($result));
		$db->sql_freeresult($result);
	}



	if ($submit == true && !sizeof($error))
	{
		$db->sql_query('UPDATE ' . KB_ARTICLE_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE article_id = ' . $article_id);
		$cache->destroy('sql', KB_ARTICLE_TABLE);

		// save revision
		if($kb_config['activ_diff'])
		{
			if($row['article'] != utf8_normalize_nfc(request_var('message', '', true))) // only if article has changed
			{
				$sql_ary = array(
					'article_id'	=> $row['article_id'],
					'article'		=> $row['article'],
					'time'			=> time(),
					'user_id'		=> $user->data['user_id'],
					'edit_reason'	=> utf8_normalize_nfc($data['edit_reason']),
					'bbcode_uid'	=> $row['bbcode_uid'],
				);
				$db->sql_query('INSERT INTO ' . KB_ARTICLE_DIFF_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
			}
		}

		if($data['cat_id'] <> $row['cat_id'])
		{
			move_article($article_id, $data['cat_id']);
		}
		if($row['activ'] <> $data['activ'])
		{
			if(isset($_POST['activ']) && ($auth->acl_get('kb_add_article_direct', $row['cat_id']) || $auth->acl_get('m_activate_kb')))
			{
				activate_article($article_id, $row['user_id']);
			}
			else
			{
				deactivate_article($article_id, $row['user_id']);
			}
		}
		if ($auth->acl_get('kb_attache_article', $row['cat_id']) && $config['allow_attachments'])
		{
			$attach_data = array(
				'poster_id'			=> $row['user_id'],
				'post_id'			=> $row['article_id'],
				'attachment_data'	=> $message_parser->attachment_data,
			);
			post_attacement($attach_data);
		}
		if($kb_config['activ_post'] && $data['post_id'] != 0)
		{
			update_article_post($article_id);
		}		
		article_log($article_id, utf8_normalize_nfc($data['edit_reason']));

		$redirect_url = article_link($article_id,  request_var('page_uri', ''));
		meta_refresh(3, $redirect_url);
		trigger_error($user->lang['ARTICLE_EDITED'] . '<br /><br />' . sprintf($user->lang['BACK_TO_KB'], '<a href="' . append_sid("{$kb_root_path}") . '">', '</a>') . '<br /><br />'. sprintf($user->lang['BACK_TO_ARTICLE'], '<a href="' . $redirect_url . '">', '</a>'));
	}


	decode_message($row['article'], $row['bbcode_uid']);
	$post_message				= $row['article'];
	$data['title'] 				= $row['titel'];
	$data['description']		= $row['description'];
	$data['post_time']			= $row['post_time'];
	$data['user_id']			= $row['user_id'];
	$data['cat_id']				= $row['cat_id'];
	$data['post_id']			= $row['post_id'];
	$data['type_id']			= $row['type_id'];
	$data['page_uri']			= $row['page_uri'];
	$data['post_id']			= $row['post_id'];
	$data['bbcode_checked']		= $row['enable_bbcode'];
	$data['smilies_checked']	= $row['enable_smilies'];
	$data['urls_checked']		= $row['enable_magic_url'];
	$data['activ'] 				= $row['activ'];


}

if (sizeof($message_parser->warn_msg))
{
	$error[] = implode('<br />', $message_parser->warn_msg);
	$message_parser->warn_msg = array();
}

if ($auth->acl_get('kb_attache_article', $row['cat_id']) && $config['allow_attachments'])
{
	$attachment_data = $message_parser->attachment_data;
	$filename_data = $message_parser->filename_data;
	posting_gen_attachment_entry($attachment_data, $filename_data);
	posting_gen_inline_attachments($attachment_data);
}
// Build custom bbcodes array
display_custom_bbcodes();
if($user->optionget('smilies'))
{
	generate_smilies('inline', 1);
}


// Output page
page_header(($mode == 'edit') ? $user->lang['ARTICLE_EDIT'] : $user->lang['ARTICLE_ADD']);

// DIFF
if($kb_config['activ_diff'])
{
	$diff_id = request_var('diff_id', 0);

	if($mode == 'del_diff')
	{
		if (confirm_box(true))
		{
			$sql = 'DELETE FROM ' . KB_ARTICLE_DIFF_TABLE . '
				WHERE article_id = ' . (int) $article_id . '
					AND diff_id = ' . (int) $diff_id;
			$db->sql_query($sql);
			trigger_error($user->lang['ARTICLE_DELETED'] . '<br /><br />' . sprintf($user->lang['BACK_TO_POSTING'], '<a href="' . append_sid("{$kb_root_path}kbposting.$phpEx", 'mode=edit&amp;id=' . $article_id) . '">', '</a>') . '<br /><br />' . sprintf($user->lang['BACK_TO_KB'], '<a href="' . append_sid("{$kb_root_path}") . '">', '</a>'));
		}
		else
		{
			confirm_box(false, $user->lang['DIFF_DEL'], build_hidden_fields(array(
				'id'		=> $article_id,
				'mode'		=> 'del_diff',
				'diff_id'	=> $diff_id
			)));
		}
	}		


	if($mode == 'restore' && $auth->acl_get('m_restore_kb'))
	{
		if (confirm_box(true))
		{
			$sql = 'SELECT article, bbcode_uid
				FROM ' . KB_ARTICLE_DIFF_TABLE . '
				WHERE diff_id = ' . (int) $diff_id . '
				AND article_id = ' . (int) $article_id;
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);

			$sql_ary = array(
				'article'		=> $row['article'],
				'bbcode_uid'	=> $row['bbcode_uid'],
			);
			$db->sql_query('UPDATE ' . KB_ARTICLE_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE article_id = ' . (int) $article_id);
			article_log($article_id, $user->lang['ARTICLE_RESTORED']);
			trigger_error($user->lang['ARTICLE_RESTORED'] . '<br /><br />' . sprintf($user->lang['BACK_TO_POSTING'], '<a href="' . append_sid("{$kb_root_path}kbposting.$phpEx", 'mode=edit&amp;id=' . $article_id) . '">', '</a>') . '<br /><br />' . sprintf($user->lang['BACK_TO_KB'], '<a href="' . append_sid("{$kb_root_path}") . '">', '</a>'));

		}
		else
		{
			confirm_box(false, $user->lang['DIFF_RESTORE'], build_hidden_fields(array(
				'id'		=> $article_id,
				'mode'		=> 'restore',
				'diff_id'	=> $diff_id
			)));
		}
	}		

	$sql = 'SELECT d.diff_id, d.time, d.edit_reason, u.username, u.user_colour, u.user_id
		FROM ' . KB_ARTICLE_DIFF_TABLE . ' d, ' . USERS_TABLE . ' u
		WHERE d.user_id = u.user_id
			AND d.article_id = ' . (int) $article_id . '
		ORDER BY d.time DESC';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result))
	{
		$template->assign_block_vars('diff_row', array(
			'U_DIFF'		=> append_sid("{$kb_root_path}kbposting.$phpEx", 'mode=edit&amp;id=' . $article_id . '&amp;diff_id=' . $row['diff_id']) . '#diff',
			'TIME'			=> $user->format_date($row['time']),
			'EDIT_REASON'	=> $row['edit_reason'],
			'USER'			=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
			'U_DELETE'		=> append_sid("{$kb_root_path}kbposting.$phpEx", 'mode=del_diff&amp;id=' . $article_id . '&amp;diff_id=' . $row['diff_id']),
			'U_RESTORE'		=> append_sid("{$kb_root_path}kbposting.$phpEx", 'mode=restore&amp;id=' . $article_id . '&amp;diff_id=' . $row['diff_id']),
		));
	}


	if($diff_id != 0)
	{
		$sql = 'SELECT article, bbcode_uid, time
			FROM ' . KB_ARTICLE_DIFF_TABLE . '
			WHERE diff_id = ' . (int) $diff_id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		decode_message($row['article'], $row['bbcode_uid']);

		include($phpbb_root_path . 'includes/diff/diff.' . $phpEx);
		include($phpbb_root_path . 'includes/diff/engine.' . $phpEx);
		include($phpbb_root_path . 'includes/diff/renderer.' . $phpEx);
		$diff = new diff(trim_trailing_spaces($row['article']), trim_trailing_spaces($post_message));
		$renderer = new diff_renderer_inline();
		$diff_message = $renderer->get_diff_content($diff);
		//$diff_message = bbcode_nl2br($diff_message);
		$diff_title = sprintf($user->lang['DIFFERENCE'], $user->format_date($row['time']));
	}
}

// Start assigning vars for main posting page ...
$template->assign_vars(array(
	'DESCRIPTION' 				=> $data['description'],
	'TITLE'						=> $data['title'],
	'EDIT_REASON'				=> $data['edit_reason'],
	'POST_ID'					=> $data['post_id'],
	'ACTIV'						=> ($data['activ'] == 1) ? ' checked="checked"' : '',
	'MESSAGE'					=> $post_message,
	'DIFFERENCE'				=> isset($diff_title) ? $diff_title : '',
	'DIFF_MESSAGE'				=> isset($diff_message) ? $diff_message : '',
	'PAGE_URI'					=> isset($data['page_uri']) ? $data['page_uri'] : '',
	'CAT_LIST'					=> make_cat_select($data['cat_id']),
	'TYPE_LIST'					=> ($kb_config['activ_types'] == 1 ) ? make_type_list($data['type_id']) : '',
	'TYPE_ID'					=> $data['type_id'],
	'S_ARTICLE_TYPES'			=> ($kb_config['activ_types'] == 1 ) ? true : false,
	'S_ACTIV_DIFF'				=> ($kb_config['activ_diff'] == 1 ) ? true : false,
	'L_POST_A' 					=> ($mode == 'edit') ? $user->lang['ARTICLE_EDIT'] : $user->lang['ARTICLE_ADD'],
	'S_EDIT_MODE'				=> ($mode == 'edit') ? true : false,
	'S_EDIT'					=> ($mode == 'edit') ? true : false,
	'S_POST_ACTION'				=> ($mode == 'edit') ? append_sid("{$kb_root_path}kbposting.$phpEx", 'mode=edit&amp;id=' . $article_id . '&amp;cat_id=' . $data['cat_id']) : append_sid("{$kb_root_path}kbposting.$phpEx", 'cat_id=' . $data['cat_id']),
	'S_ACTIVATE_ARTICLE'		=> $auth->acl_get('m_activate_kb'),
	'S_RESTORE_ARTICLE'			=> $auth->acl_get('m_restore_kb'),
	'S_DELETE_DIFF'				=> $auth->acl_get('m_delete_diff_kb'),
	'S_SHOW_ATTACH_BOX'			=> $auth->acl_get('kb_attache_article', $data['cat_id']),
	'S_SEO_URI'					=> KB_SEO,
	'NOFORUMNAV'				=> true,
	'S_BBCODE_CHECKED'			=> ($data['bbcode_checked']) ? '' : ' checked="checked"',
	'S_SMILIES_CHECKED'			=> ($data['smilies_checked']) ? '' : ' checked="checked"',
	'S_MAGIC_URL_CHECKED'		=> ($data['urls_checked']) ? '' : ' checked="checked"',
	'ERROR'						=> (sizeof($error)) ? implode('<br />', $error) : '',
	'UA_PROGRESS_BAR'			=> addslashes(append_sid("{$kb_root_path}kbposting.$phpEx", "mode=popup")),
	'S_CLOSE_PROGRESS_WINDOW'	=> (isset($_POST['add_file'])) ? true : false,
	'S_FORM_ENCTYPE'			=> ' enctype="multipart/form-data"',
	'S_BBCODE_ALLOWED'			=> $user->optionget('bbcode'),
	'S_BBCODE_IMG'				=> $user->optionget('bbcode'),
	'S_LINKS_ALLOWED'			=> $user->optionget('bbcode'),
	'S_BBCODE_URL'				=> $user->optionget('bbcode'),
	'S_BBCODE_FLASH'			=> $user->optionget('bbcode'),
	'S_BBCODE_QUOTE'			=> true,
	'BBCODE_STATUS'				=> sprintf($user->lang['BBCODE_IS_ON'], '<a href="' . append_sid("{$phpbb_root_path}faq.$phpEx", 'mode=bbcode') . '">', '</a>'),
));

$template->assign_block_vars('navlinks', array(
	'U_VIEW_FORUM'	=> append_sid("{$kb_root_path}"),
	'FORUM_NAME'	=> $user->lang['KBASE'])
);

$categorie_nav = get_categorie_branch($data['cat_id'], 'parents', 'descending', true);
foreach ($categorie_nav as $row1)
{
	$template->assign_block_vars('navlinks', array(
		'U_VIEW_FORUM'	=> categorie_link($row1['cat_id']),
		'FORUM_NAME'	=> $row1['cat_title'])
	);
}


$template->set_filenames(array(
	'body' => 'kb/kb_posting.html')
);

page_footer();

function trim_trailing_spaces($lines)
{
	if (!is_array($lines))
	{
		$lines = explode("\n", $lines);
	}		

	return array_map('rtrim', $lines);
}

?>
