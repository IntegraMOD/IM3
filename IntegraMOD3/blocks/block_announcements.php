<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, Jan 22, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_announcements.php 336 2009-01-23 02:06:37Z Michealo $
* Updated: 28 July 2011 00:03
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

global $k_config, $k_blocks;

$phpEx = substr(strrchr(__FILE__, '.'), 1);
if (!class_exists('bbcode'))
{
	include($phpbb_root_path . 'includes/bbcode.' . $phpEx);
}

foreach ($k_blocks as $blk)
{
	if ($blk['html_file_name'] == 'block_announcements.html')
	{
		$block_cache_time = $blk['block_cache_time'];
	}
}
$block_cache_time = (isset($block_cache_time) ? $block_cache_time : $k_config['k_block_cache_time_default']);

$queries = $cached_queries = $i = $j = 0;

// Get portal cache data
$k_announce_allow = $k_config['k_announce_allow'];
$k_announce_type = $k_config['k_announce_type'];
$k_announce_to_display = $k_config['k_announce_to_display'];
$k_announce_item_max_length = $k_config['k_announce_item_max_length'];

$bbcode_bitfield = $a_type = '';
$has_attachments = $display_notice = false;
$attach_array = $attach_list = $post_list = $posts = $attachments = $extensions = array();
$time_now = time();

switch ($k_announce_type)
{
	case 0: // POST_ANNOUNCE: or POST_GLOBAL:
		$a_type = "(t.topic_id = p.topic_id AND (t.topic_type = " . POST_ANNOUNCE . " OR t.topic_type = " . POST_GLOBAL . ") AND t.topic_status <> " . FORUM_LINK . " AND (t.topic_time_limit = 0 OR (t.topic_time + t.topic_time_limit)  >  $time_now))";
	break;

	case POST_ANNOUNCE:
		$a_type = "(t.topic_id = p.topic_id AND t.topic_type = " . POST_ANNOUNCE . " AND t.topic_status <> " . FORUM_LINK . " AND (t.topic_time_limit = 0 OR (t.topic_time + t.topic_time_limit)  >  $time_now))";
	break;

	case POST_GLOBAL:
		$a_type = "(t.topic_id = p.topic_id AND t.topic_type = " . POST_GLOBAL . " AND t.topic_status <> " . FORUM_LINK . " AND (t.topic_time_limit = 0 OR (t.topic_time + t.topic_time_limit)  >  $time_now))";
	break;

	default:
		$a_type = "(t.topic_id = p.topic_id AND t.topic_type = " . POST_GLOBAL . " AND t.topic_status <> " . FORUM_LINK . "  AND (t.topic_time_limit = 0 OR (t.topic_time + t.topic_time_limit)  >  $time_now))";
	break;
}

$template->assign_block_vars('welcome_text', array());

// Search and return all posts of type announcement including global...
$sql = 'SELECT
		t.forum_id,
		t.topic_id,
		t.topic_status,
		t.topic_time,
		t.topic_time_limit,
		t.topic_title,
		t.topic_replies,
		t.topic_poster,
		t.topic_attachment,
		t.poll_title,
		t.topic_type,
		t.topic_time_limit,
		p.poster_id,
		p.topic_id,
		p.post_text,
		p.bbcode_uid,
		p.post_approved,
		p.post_id,
		p.post_time,
		p.enable_smilies,
		p.enable_bbcode,
		p.enable_magic_url,
		p.bbcode_bitfield,
		p.bbcode_uid,
		p.post_attachment,
		u.username,
		u.user_colour
	FROM
		' . TOPICS_TABLE . ' AS t,
		' . POSTS_TABLE . ' AS p,
		' . USERS_TABLE . ' AS u
	WHERE
		' . $a_type . ' AND
		t.topic_poster = u.user_id AND
           p.post_time = t.topic_time
	ORDER BY
		t.topic_type DESC, t.topic_time DESC';

$result = $db->sql_query_limit($sql, (($k_announce_to_display) ? $k_announce_to_display : 1), 0, $block_cache_time);

while ($row = $db->sql_fetchrow($result))
{
	if ($auth->acl_get('f_read', $row['forum_id']) || $row['forum_id'] == 0)
	{
		// Do post have an attachment? If so, add them to the list //
		if ($row['post_attachment'] && $config['allow_attachments'])
		{
			$attach_list = $row['post_id'];
			$attach_list_forums = $row['forum_id'];

			if ($row['post_approved'])
			{
				$has_attachments = true;
			}
		}
		$post_list[$i++] = $row['post_id'];

		// store all data for now //
		$rowset[$row['post_id']] = array(
			'post_id'			=> $row['post_id'],
			'post_text'			=> $row['post_text'],
			'topic_id'			=> $row['topic_id'],
			'forum_id'			=> $row['forum_id'],
			'post_id'			=> $row['post_id'],
			'poster_id'			=> $row['poster_id'],
			'topic_replies'		=> $row['topic_replies'],
			'topic_title'		=> $row['topic_title'],
			'topic_type'		=> $row['topic_type'],
			'topic_status'		=> $row['topic_status'],
			'username'			=> $row['username'],
			'user_colour'		=> $row['user_colour'],
			'poll_title'		=> ($row['poll_title']) ? true : false,
			'post_time'			=> $user->format_date($row['post_time']),
			'topic_time'		=> $user->format_date($row['topic_time']),
			'post_approved'		=> $row['post_approved'],
			'post_attachment'	=> $row['post_attachment'],
			'bbcode_bitfield'	=> $row['bbcode_bitfield'],
			'bbcode_uid'		=> $row['bbcode_uid'],
			'enable_bbcode'		=> $row['enable_bbcode'],
			'bbcode_options'	=> (($row['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) + (($row['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) + (($row['enable_magic_url']) ? OPTION_FLAG_LINKS : 0),
		);

		// Define the global bbcode bitfield, will be used to load bbcodes
		$bbcode_bitfield = $bbcode_bitfield | base64_decode($row['bbcode_bitfield']);

		// build a list of allowed posts containing attachments //
		if ($row['post_attachment'] && $config['allow_attachments'])
		{
			global $cache;

			if (!class_exists('cache'))
			{
				include($phpbb_root_path . 'includes/cache.' . $phpEx);
			}

			$attach_array[$j++] = $row['post_id'];

			if (empty($extensions) || !is_array($extensions))
			{
				$extensions = $cache->obtain_attach_extensions($row['forum_id']);
			}
		}
	}
}
$db->sql_freeresult($result);

// Pull attachment data
if (sizeof($attach_list))
{
	if ($auth->acl_get('u_download'))
	{
		$sql = 'SELECT *
			FROM ' . ATTACHMENTS_TABLE . '
			WHERE ' . $db->sql_in_set('post_msg_id', $attach_array) . '
			ORDER BY filetime DESC';
		$result = $db->sql_query($sql, $block_cache_time);

		while($row = $db->sql_fetchrow($result))
		{
			$attachments[$row['post_msg_id']][] = $row;
		}
		$db->sql_freeresult($result);
	}
	else
	{
		$display_notice = true;
	}
}

// Instantiate BBCode if need be
if ($bbcode_bitfield !== '')
{
	$bbcode = new bbcode(base64_encode($bbcode_bitfield));
}

$image_path = $phpbb_root_path . 'styles/' . $user->theme['imageset_path'] . '/imageset/portal/';

for ($i = 0, $end = sizeof($post_list); $i < $end; ++$i)
{
	if (!isset($rowset[$post_list[$i]]))
	{
		continue;
	}

	$row =& $rowset[$post_list[$i]];

	// Size the message to max length
	if (($k_announce_item_max_length != 0) && (strlen($row['post_text']) > $k_announce_item_max_length))
	{
		$row['post_text'] = sgp_truncate_message($row['post_text'], $k_announce_item_max_length);
		$row['post_text'] .= ' <a href="' . append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($row['forum_id']) ? $row['forum_id'] : $forum_id) . '&amp;t=' . $row['topic_id']) . '"><strong>[' . $user->lang['VIEW_FULL_ARTICLE']  . ']</strong></a>';
	}

	$message = generate_text_for_display($row['post_text'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']);

	if (!empty($attachments[$row['post_id']]))
	{
		parse_attachments($row['forum_id'], $message, $attachments[$row['post_id']], $update_count);
	}

	if ($k_config['k_allow_acronyms'])
	{
		$message = sgp_local_acronyms($message);
	}

	$postrow = array(
		'ALLOW_REPLY'	=> ($auth->acl_get('f_reply', $row['forum_id']) && $row['topic_status'] != ITEM_LOCKED) ? TRUE : FALSE,
		'ALLOW_POST'	=> ($auth->acl_get('f_post', $row['forum_id']) && $row['topic_status'] != ITEM_LOCKED) ? TRUE : FALSE,
		'POSTER'		=> '<span style="color:#' . $row['user_colour'] . ';">' . $row['username'] . '</span>',
		'TIME'			=> $row['post_time'],
		'TITLE'			=> $row['topic_title'],
		'MESSAGE'		=> $message,

		'U_POSTER'		=> get_username_string('full', $row['poster_id'], $row['username'], $row['user_colour']),
		'U_VIEW'		=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($row['forum_id']) ? $row['forum_id'] : $forum_id) . '&amp;t=' . $row['topic_id']),
		'U_REPLY'		=> append_sid("{$phpbb_root_path}posting.$phpEx", 'mode=reply&amp;t=' . $row['topic_id'] . '&amp;f=' . $row['forum_id']),
		'U_PRINT'		=> ($auth->acl_get('f_print', $row['forum_id'])) ? append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=" . $row['forum_id'] . "&amp;t=" . $row['topic_id'] . "&amp;view=print") : '',

		'REPLY_IMG'		=> $image_path . 'post_comment.png',
		'PRINT_IMG' 	=> $image_path . 'post_print.png',
		'VIEW_IMG'		=> $image_path . 'post_view.png',

		'S_TOPIC_TYPE'	=> $row['topic_type'],
		'S_NOT_LAST'	=> ($i < sizeof($posts) - 1) ? true : false,
		'S_ROW_COUNT'	=> $i,
		'S_POST_UNAPPROVED'	=> ($row['post_approved']) ? false : true,
		'S_DISPLAY_NOTICE'	=> $display_notice,

		'S_HAS_ATTACHMENTS'	=> (!empty($attachments[$row['post_id']])) ? true : false,
		'S_DISPLAY_NOTICE'	=> $display_notice && $row['post_attachment'],
	);

	$template->assign_block_vars('announce_row', $postrow);

	// Display not already displayed Attachments for this post, we already parsed them. ;)
	if (!empty($attachments[$row['post_id']]))
	{
		foreach ($attachments[$row['post_id']] as $attachment)
		{
			$template->assign_block_vars('announce_row.attachment', array(
				'DISPLAY_ATTACHMENT'	=> $attachment)
			);
		}
	}

	unset($rowset[$post_list[$i]]);
	unset($attachments[$row['post_id']]);
}
unset($rowset, $user_cache);

$message = '';
//$u_group = append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=group&amp;g=' . $row['group_id']);

$template->assign_vars(array(
	'S_ANNOUNCEMENTS_COUNT_ASKED'		=> sizeof($posts),
	'S_ANNOUNCEMENTS_COUNT_RETURNED'	=> sizeof($post_list),
	'T_IMAGESET_LANG_PATH'				=> "{$phpbb_root_path}styles/" . $user->theme['imageset_path'] . '/imageset/' . $user->data['user_lang'],

	'ANNOUNCEMENYS_DEBUG'				=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
));

// END: Fetch Announcements //

?>