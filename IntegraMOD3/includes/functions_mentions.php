<?php
/**
*
* @package IntegraMOD
* @copyright (c) 2026 IntegraMOD Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Resolve mention tags, render profile links, and optionally notify mentioned users.
*
* @param string $message Stored or raw message
* @param string $bbcode_uid
* @param int    $forum_id
* @param int    $topic_id
* @param int    $post_id
* @param string $subject
* @param string $author_name
* @param int    $author_id
* @param bool   $notify
* @return string
*/
function im3_process_mentions(&$message, $bbcode_uid, $forum_id, $topic_id, $post_id, $subject, $author_name, $author_id, $notify = false)
{
	global $db, $auth, $phpEx;

	$uid = preg_replace('/[^0-9a-z]/i', '', (string) $bbcode_uid);
	$pattern = ($uid !== '') ? '#\[mention(?::' . $uid . ')?\]([^\[]{1,64})\[/mention(?::' . $uid . ')?\]#ui' : '#\[mention\]([^\[]{1,64})\[/mention\]#ui';

	if ($notify && $post_id && isset($GLOBALS['im3_mentions_sent'][(int) $post_id]))
	{
		return $message;
	}

	if (!preg_match_all($pattern, $message, $matches))
	{
		return $message;
	}

	$names = array();
	foreach ($matches[1] as $name)
	{
		$name = trim(htmlspecialchars_decode($name, ENT_QUOTES));
		if ($name !== '')
		{
			$names[utf8_clean_string($name)] = $name;
		}
	}

	if (!sizeof($names))
	{
		return $message;
	}

	$clean = array();
	foreach (array_keys($names) as $clean_name)
	{
		$clean[] = $db->sql_escape($clean_name);
	}

	$sql = 'SELECT user_id, username, username_clean, user_colour, user_email, user_lang, user_allow_pm, user_options, user_type
		FROM ' . USERS_TABLE . "
		WHERE username_clean IN ('" . implode("','", $clean) . "')
			AND user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')';
	$result = $db->sql_query($sql);
	$users = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$users[$row['username_clean']] = $row;
	}
	$db->sql_freeresult($result);

	$forum_id = (int) $forum_id;
	$author_id = (int) $author_id;
	$allowed = array();
	if ($forum_id && sizeof($users))
	{
		$user_ids = array();
		foreach ($users as $row)
		{
			$user_ids[] = (int) $row['user_id'];
			// Founders are not always present in the forum ACL rows.
			if ((int) $row['user_type'] === USER_FOUNDER)
			{
				$allowed[(int) $row['user_id']] = (int) $row['user_id'];
			}
		}
		foreach ($auth->acl_get_list($user_ids, 'f_read', $forum_id) as $auth_forum_id => $forum_ary)
		{
			foreach ($forum_ary as $auth_option => $user_ary)
			{
				foreach ($user_ary as $user_id)
				{
					$allowed[(int) $user_id] = (int) $user_id;
				}
			}
		}
	}
	else
	{
		// Display-only rendering without a forum context: link every resolved user
		foreach ($users as $row)
		{
			$allowed[(int) $row['user_id']] = (int) $row['user_id'];
		}
	}

	$url = ($post_id) ? generate_board_url() . "/viewtopic.$phpEx?f=$forum_id&t=" . (int) $topic_id . '&p=' . (int) $post_id . '#p' . (int) $post_id : '';

	$GLOBALS['im3_mention_context'] = array(
		'users'			=> $users,
		'allowed'		=> $allowed,
		'notify'		=> $notify,
		'author_name'	=> $author_name,
		'subject'		=> $subject,
		'url'			=> $url,
		'author_id'		=> $author_id,
		'notified'		=> array(),
	);
	$message = preg_replace_callback($pattern, 'im3_replace_mention', $message);
	if ($notify && $post_id && !empty($GLOBALS['im3_mention_context']['notified']))
	{
		if (!isset($GLOBALS['im3_mentions_sent']))
		{
			$GLOBALS['im3_mentions_sent'] = array();
		}
		$GLOBALS['im3_mentions_sent'][(int) $post_id] = true;
	}
	unset($GLOBALS['im3_mention_context']);

	return $message;
}

/**
* Replace one validated mention tag. Context is stored globally for PHP 7.4 compatibility.
*
* @param array $match
* @return string
*/
function im3_replace_mention($match)
{
	global $phpEx;

	$context = &$GLOBALS['im3_mention_context'];
	$display = trim(htmlspecialchars_decode($match[1], ENT_QUOTES));
	$clean_name = utf8_clean_string($display);
	if (!isset($context['users'][$clean_name]))
	{
		return $match[0];
	}

	$row = $context['users'][$clean_name];
	$user_id = (int) $row['user_id'];
	if (!empty($context['notify']) && $user_id !== (int) $context['author_id'] && !isset($context['notified'][$user_id]))
	{
		$context['notified'][$user_id] = $user_id;
		im3_deliver_mention($row, $context['author_name'], $context['subject'], $context['url'], $context['author_id']);
	}
	if (!isset($context['allowed'][$user_id]))
	{
		return $match[0];
	}

	$profile = append_sid("memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $user_id);
	$colour = preg_replace('/[^0-9a-f]/i', '', (string) $row['user_colour']);
	$style = ($colour !== '') ? ' style="color:#' . $colour . '"' : '';
	return '<a class="mention" href="' . $profile . '"' . $style . '>@' . $row['username'] . '</a>';
}

/**
* Push, then the board notice. Failures must not stop the post from completing.
*
* @param array  $row
* @param string $author_name
* @param string $subject
* @param string $url
* @param int    $author_id
*/
function im3_deliver_mention($row, $author_name, $subject, $url, $author_id)
{
	if (function_exists('trigger_mention_push'))
	{
		trigger_mention_push((int) $row['user_id'], $author_name, $subject, $url, $author_id);
	}

	im3_notify_mention($row, $author_name, $subject, $url, $author_id);
}

/**
* Send the non-push mention notice. Private message is the default.
* user_options bit mention_email selects e-mail instead.
*
* @param array  $row
* @param string $author_name
* @param string $subject
* @param string $url
* @param int    $author_id
*/
function im3_notify_mention($row, $author_name, $subject, $url, $author_id)
{
	global $config, $user, $phpbb_root_path, $phpEx;

	$user_id = (int) $row['user_id'];
	$author_id = (int) $author_id;
	if ($user_id <= ANONYMOUS || $user_id === $author_id)
	{
		return;
	}

	$mention_email = false;
	if (isset($user->keyoptions['mention_email']))
	{
		$mention_email = phpbb_optionget($user->keyoptions['mention_email'], $row['user_options']);
	}

	$can_pm = ($author_id > ANONYMOUS && !empty($config['allow_privmsg']) && !empty($row['user_allow_pm']));
	if ($mention_email || !$can_pm)
	{
		im3_email_mention($row, $author_name, $subject, $url);
		return;
	}

	if (!function_exists('submit_pm'))
	{
		include($phpbb_root_path . 'includes/functions_privmsgs.' . $phpEx);
	}
	if (!function_exists('generate_text_for_storage'))
	{
		include($phpbb_root_path . 'includes/functions_content.' . $phpEx);
	}
	if (empty($user->lang['MENTION_PM_SUBJECT']))
	{
		$user->add_lang('ucp');
	}

	$author_name = htmlspecialchars_decode($author_name, ENT_QUOTES);
	$subject = htmlspecialchars_decode($subject, ENT_QUOTES);
	$pm_subject = (isset($user->lang['MENTION_PM_SUBJECT'])) ? sprintf($user->lang['MENTION_PM_SUBJECT'], $author_name) : 'You were mentioned by ' . $author_name;
	$pm_text = (isset($user->lang['MENTION_PM_BODY'])) ? sprintf($user->lang['MENTION_PM_BODY'], $author_name, $subject, $url) : $author_name . ' mentioned you in "' . $subject . '": ' . $url;

	$uid = $bitfield = $flags = '';
	generate_text_for_storage($pm_subject, $uid, $bitfield, $flags, false, false, false);
	$uid = $bitfield = $flags = '';
	generate_text_for_storage($pm_text, $uid, $bitfield, $flags, false, true, false);

	$pm_data = array(
		'address_list'		=> array('u' => array($user_id => 'to')),
		'from_user_id'		=> $author_id,
		'from_username'		=> $author_name,
		'icon_id'			=> 0,
		'from_user_ip'		=> $user->ip,

		'enable_bbcode'		=> false,
		'enable_smilies'	=> false,
		'enable_urls'		=> true,
		'enable_sig'		=> false,

		'message'			=> $pm_text,
		'bbcode_bitfield'	=> $bitfield,
		'bbcode_uid'		=> $uid,
	);

	// Do not also send the generic new-PM e-mail or PM push. Mention push is separate.
	submit_pm('post', $pm_subject, $pm_data, false, false);
}

/**
* E-mail a mention notice. Used when the user chose e-mail, or a PM cannot be delivered.
*
* @param array  $row
* @param string $author_name
* @param string $subject
* @param string $url
*/
function im3_email_mention($row, $author_name, $subject, $url)
{
	global $phpbb_root_path, $phpEx;

	if (!trim($row['user_email']))
	{
		return;
	}

	if (!class_exists('messenger'))
	{
		include($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
	}

	$messenger = new messenger();
	$messenger->template('mention_notify', $row['user_lang']);
	$messenger->to($row['user_email'], $row['username']);
	$messenger->assign_vars(array(
		'USERNAME'		=> htmlspecialchars_decode($row['username'], ENT_COMPAT),
		'AUTHOR_NAME'	=> htmlspecialchars_decode($author_name, ENT_COMPAT),
		'TOPIC_TITLE'	=> htmlspecialchars_decode($subject, ENT_COMPAT),
		'U_POST'		=> $url,
	));
	$messenger->send(NOTIFY_EMAIL);
	$messenger->save_queue();
}
