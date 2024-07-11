<?php
/**
*
* @package phpBB3 User Blog
* @version $Id: edit.php 485 2008-08-15 23:33:57Z exreaction@gmail.com $
* @copyright (c) 2008 EXreaction, Lithium Studios
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

// If they did not include the $reply_id give them an error...
if ($reply_id == 0)
{
	trigger_error('REPLY_NOT_EXIST');
}

// Add the language Variables for posting
$user->add_lang('posting');

// check to see if editing this message is locked, or if the one editing it has mod powers
if (blog_data::$reply[$reply_id]['reply_edit_locked'] && !$auth->acl_get('m_blogreplyedit'))
{
	trigger_error('REPLY_EDIT_LOCKED');
}

// Setup the page header and sent the title of the page that will go into the browser header
page_header($user->lang['EDIT_REPLY']);

// Generate the breadcrumbs
generate_blog_breadcrumbs($user->lang['EDIT_REPLY']);

// Posting permissions
$post_options = new post_options;

blog_plugins::plugin_do('reply_edit_start');

// If they select edit mode and didn't submit or hit preview(means they came directly from the view reply page)
if (!$submit && !$preview && !$refresh)
{
	// Setup the message so we can import it to the edit page
	$reply_subject = blog_data::$reply[$reply_id]['reply_subject'];
	$reply_text = blog_data::$reply[$reply_id]['reply_text'];
	decode_message($reply_text, blog_data::$reply[$reply_id]['bbcode_uid']);
	$post_options->set_status(blog_data::$reply[$reply_id]['enable_bbcode'], blog_data::$reply[$reply_id]['enable_smilies'], blog_data::$reply[$reply_id]['enable_magic_url']);

	// Attachments
	$blog_attachment->get_attachment_data(false, $reply_id);
	$blog_attachment->attachment_data = blog_data::$reply[$reply_id]['attachment_data'];
}
else
{
	// so we can check if they did edit any text when they hit submit
	$original_subject = blog_data::$reply[$reply_id]['reply_subject'];
	$original_text = blog_data::$reply[$reply_id]['reply_text'];
	decode_message($original_text, blog_data::$reply[$reply_id]['bbcode_uid']);

	$reply_subject = utf8_normalize_nfc(request_var('subject', '', true));
	$reply_text = utf8_normalize_nfc(request_var('message', '', true));

	$post_options->set_status(!isset($_POST['disable_bbcode']), !isset($_POST['disable_smilies']), !isset($_POST['disable_magic_url']));

	// set up the message parser to parse BBCode, Smilies, etc
	$message_parser = new parse_message();
	$message_parser->message = $reply_text;
	$message_parser->parse($post_options->enable_bbcode, $post_options->enable_magic_url, $post_options->enable_smilies, $post_options->img_status, $post_options->flash_status, $post_options->bbcode_status, $post_options->url_status);

	// Check the basic posting data
	$error = handle_basic_posting_data(true, 'reply', 'edit');

	// If they did not include a subject, give them the empty subject error
	if ($reply_subject == '' && !$refresh)
	{
		$error[] = $user->lang['EMPTY_MESSAGE_SUBJECT'];
	}

	// If any errors were reported by the message parser add those as well
	if (sizeof($message_parser->warn_msg) && !$refresh)
	{
		$error[] = implode('<br />', $message_parser->warn_msg);
	}

	// Attachments
	$blog_attachment->get_submitted_attachment_data();
	$blog_attachment->parse_attachments('fileupload', $submit, $preview, $refresh, $reply_text);
	if (sizeof($blog_attachment->warn_msg))
	{
		$error[] = implode('<br />', $blog_attachment->warn_msg);
	}
}

$temp = compact('reply_subject', 'reply_text', 'error');
blog_plugins::plugin_do_ref('reply_edit_after_setup', $temp);
extract($temp);
unset($temp);

// Set the options up in the template
$post_options->set_in_template();

// if they did not submit or they have an error
if (!$submit || sizeof($error))
{
	// if they are trying to preview the message and do not have an error
	if ($preview && !sizeof($error))
	{
		$preview_message = $message_parser->format_display($post_options->enable_bbcode, $post_options->enable_magic_url, $post_options->enable_smilies, false);

		// Attachments
		if (sizeof($blog_attachment->attachment_data))
		{
			$template->assign_var('S_HAS_ATTACHMENTS', true);

			$update_count = array();
			$attachment_data = $blog_attachment->attachment_data;

			$blog_attachment->parse_attachments_for_view($preview_message, $attachment_data, $update_count, true);

			if (sizeof($attachment_data))
			{
				foreach ($attachment_data as $row)
				{
					$template->assign_block_vars('attachment', array(
						'DISPLAY_ATTACHMENT' => $row,
					));
				}
			}

			unset($attachment_data);
		}

		blog_plugins::plugin_do_ref('reply_edit_preview', $preview_message);

		// output some data to the template parser
		$template->assign_vars(array(
			'S_DISPLAY_PREVIEW'			=> true,
			'PREVIEW_SUBJECT'			=> censor_text($reply_subject),
			'PREVIEW_MESSAGE'			=> $preview_message,
			'POST_DATE'					=> $user->format_date(blog_data::$reply[$reply_id]['reply_time']),
		));
	}

	blog_plugins::plugin_do('reply_edit_after_preview');

	// handles the basic data we need to output for posting
	handle_basic_posting_data(false, 'reply', 'edit');

	// Assign some variables to the template parser
	$template->assign_vars(array(
		'ERROR'						=> (sizeof($error)) ? implode('<br />', $error) : '',
		'MESSAGE'					=> $reply_text,
		'SUBJECT'					=> $reply_subject,

		'L_MESSAGE_BODY_EXPLAIN'	=> (intval($config['max_post_chars'])) ? sprintf($user->lang['MESSAGE_BODY_EXPLAIN'], intval($config['max_post_chars'])) : '',
		'L_POST_A'					=> $user->lang['EDIT_A_REPLY'],

		'S_EDIT_REASON'				=> true,
		'S_LOCK_POST_ALLOWED'		=> (($auth->acl_get('m_blogreplylockedit')) && $user->data['user_id'] != $reply_user_id) ? true : false,
	));

	$template->set_filenames(array(
		'body'		=> 'blog/blog_posting_layout.html',
	));
}
else // user submitted and there are no errors
{
	$sql_data = array(
		'user_ip'				=> ($user->data['user_id'] == $reply_user_id) ? $user->data['user_ip'] : blog_data::$reply[$reply_id]['user_ip'],
		'reply_subject'			=> $reply_subject,
		'reply_text'			=> $message_parser->message,
		'reply_checksum'		=> md5($message_parser->message),
		'reply_approved' 		=> (blog_data::$reply[$reply_id]['reply_approved'] == 0) ? ($auth->acl_get('u_blogreplynoapprove')) ? 1 : 0 : 1,
		'enable_bbcode' 		=> $post_options->enable_bbcode,
		'enable_smilies'		=> $post_options->enable_smilies,
		'enable_magic_url'		=> $post_options->enable_magic_url,
		'bbcode_bitfield'		=> $message_parser->bbcode_bitfield,
		'bbcode_uid'			=> $message_parser->bbcode_uid,
		'reply_edit_time'		=> time(),
		'reply_edit_reason'		=> utf8_normalize_nfc(request_var('edit_reason', '', true)),
		'reply_edit_user'		=> $user->data['user_id'],
		'reply_edit_count'		=> blog_data::$reply[$reply_id]['reply_edit_count'] + 1,
		'reply_edit_locked'		=> ($auth->acl_get('m_blogreplylockedit') && $user->data['user_id'] != $reply_user_id) ? request_var('lock_post', false) : false,
		'reply_attachment'		=> (sizeof($blog_attachment->attachment_data)) ? 1 : 0,
	);

	$blog_search->index('edit', $blog_id, $reply_id, $message_parser->message, $reply_subject, blog_data::$reply[$reply_id]['user_id']);

	blog_plugins::plugin_do_ref('reply_edit_sql', $sql_data);

	// the update query
	$sql = 'UPDATE ' . BLOGS_REPLY_TABLE . '
		SET ' . $db->sql_build_array('UPDATE', $sql_data) . '
		WHERE reply_id = ' . intval($reply_id);

	$db->sql_query($sql);

	$blog_attachment->update_attachment_data(false, $reply_id);

	blog_plugins::plugin_do_arg('reply_edit_after_sql', $reply_id);

	unset($message_parser, $sql_data, $blog_search);

	// Handle the subscriptions
	add_blog_subscriptions($blog_id, 'subscription_');

	$message = ((!$auth->acl_get('u_blogreplynoapprove')) ? $user->lang['REPLY_NEED_APPROVE'] : $user->lang['REPLY_EDIT_SUCCESS']) . '<br /><br />'; 
	$message .= '<a href="' . $blog_urls['view_reply'] . '">' . $user->lang['VIEW_REPLY'] . '</a><br />';

	// If it needs reapproval...
	if (blog_data::$reply[$reply_id]['reply_approved'] == 0 && !$auth->acl_get('u_blogreplynoapprove'))
	{
		$sql = 'UPDATE ' . BLOGS_TABLE . ' SET blog_reply_count = blog_reply_count - 1 WHERE blog_id = ' . intval($blog_id);
		$db->sql_query($sql);
		set_config('num_blog_replies', --$config['num_blog_replies'], true);

		inform_approve_report('reply_approve', $reply_id);
	}

	handle_blog_cache('edit_reply', $user_id);

	// redirect
	blog_meta_refresh(3, $blog_urls['view_reply']);

	$message .= '<a href="' . $blog_urls['view_blog'] . '">' . $user->lang['VIEW_BLOG'] . '</a><br />';
	if ($user_id == $user->data['user_id'])
	{
		$message .= sprintf($user->lang['RETURN_BLOG_OWN'], '<a href="' . $blog_urls['view_user'] . '">', '</a>');
	}
	else
	{
		$message .= sprintf($user->lang['RETURN_BLOG_MAIN'], '<a href="' . $blog_urls['view_user'] . '">', blog_data::$user[$user_id]['username'], '</a>') . '<br />';
		$message .= sprintf($user->lang['RETURN_BLOG_OWN'], '<a href="' . $blog_urls['view_user_self'] . '">', '</a>');
	}

	trigger_error($message);
}
?>