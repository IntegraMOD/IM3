<?php
/**
*
* Moderator action undo: snapshots of moderator deletions and edits that an administrator can restore.
*
* @package IntegraMOD
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
* Create the undo table and default settings on existing boards.
*/
function im3_mod_undo_ensure_schema()
{
	global $db, $config, $phpbb_root_path, $phpEx;

	static $done = false;

	if ($done || !defined('MOD_UNDO_TABLE') || !empty($config['mod_undo_ready']))
	{
		return;
	}

	$done = true;

	if (!class_exists('phpbb_db_tools'))
	{
		include($phpbb_root_path . 'includes/db/db_tools.' . $phpEx);
	}

	$db_tools = new phpbb_db_tools($db);

	if (!$db_tools->sql_table_exists(MOD_UNDO_TABLE))
	{
		$db_tools->sql_create_table(MOD_UNDO_TABLE, array(
			'COLUMNS'		=> array(
				'undo_id'		=> array('UINT', null, 'auto_increment'),
				'undo_token'	=> array('VCHAR:32', ''),
				'undo_action'	=> array('VCHAR:30', ''),
				'user_id'		=> array('UINT', 0),
				'forum_id'		=> array('UINT', 0),
				'topic_id'		=> array('UINT', 0),
				'post_id'		=> array('UINT', 0),
				'undo_time'		=> array('TIMESTAMP', 0),
				'undo_summary'	=> array('VCHAR_UNI', ''),
				'undo_data'		=> array('MTEXT_UNI', ''),
				'undo_status'	=> array('TINT:1', 0),
				'restored_by'	=> array('UINT', 0),
				'restored_time'	=> array('TIMESTAMP', 0),
			),
			'PRIMARY_KEY'	=> 'undo_id',
			'KEYS'			=> array(
				'user_id'		=> array('INDEX', 'user_id'),
				'undo_time'		=> array('INDEX', 'undo_time'),
				'undo_status'	=> array('INDEX', 'undo_status'),
			),
		));
	}

	if (!isset($config['mod_undo_enable']))
	{
		set_config('mod_undo_enable', '1');
	}

	if (!isset($config['mod_undo_admins']))
	{
		set_config('mod_undo_admins', '0');
	}

	if (!isset($config['mod_undo_days']))
	{
		set_config('mod_undo_days', '30');
	}

	set_config('mod_undo_ready', '1');
}

/**
* Whether actions of the current user are recorded.
*/
function im3_mod_undo_user_tracked()
{
	global $config, $auth, $user;

	im3_mod_undo_ensure_schema();

	if (empty($config['mod_undo_enable']) || empty($user->data['is_registered']))
	{
		return false;
	}

	if (empty($config['mod_undo_admins']) && $auth->acl_get('a_'))
	{
		return false;
	}

	return true;
}

/**
* Quarantine folder for attachment files of deleted posts.
*/
function im3_mod_undo_dir()
{
	global $phpbb_root_path;

	$dir = $phpbb_root_path . 'store/mod_undo/';

	if (!is_dir($dir))
	{
		if (!@mkdir($dir, 0755))
		{
			return false;
		}

		@file_put_contents($dir . 'index.htm', '');
		@file_put_contents($dir . '.htaccess', "<Limit GET POST PUT>\nOrder Allow,Deny\nDeny from All\n</Limit>\n");
	}

	return $dir;
}

/**
* Copy one upload file into quarantine.
*/
function im3_mod_undo_store_file($token, $name)
{
	global $phpbb_root_path, $config;

	$name = utf8_basename($name);
	$src = $phpbb_root_path . $config['upload_path'] . '/' . $name;
	$dir = im3_mod_undo_dir();

	if ($dir === false || $name === '' || !file_exists($src))
	{
		return false;
	}

	return @copy($src, $dir . $token . '_' . $name);
}

/**
* Copy one quarantined file back to the upload folder.
*/
function im3_mod_undo_return_file($token, $name)
{
	global $phpbb_root_path, $config;

	$name = utf8_basename($name);
	$dst = $phpbb_root_path . $config['upload_path'] . '/' . $name;
	$dir = im3_mod_undo_dir();

	if (file_exists($dst))
	{
		return true;
	}

	if ($dir === false || !file_exists($dir . $token . '_' . $name))
	{
		return false;
	}

	return @copy($dir . $token . '_' . $name, $dst);
}

/**
* Remove all quarantined files of one entry.
*/
function im3_mod_undo_drop_files($token)
{
	if (!preg_match('/^[a-f0-9]+$/', $token))
	{
		return;
	}

	$dir = im3_mod_undo_dir();

	if ($dir === false)
	{
		return;
	}

	$files = glob($dir . $token . '_*');

	if (is_array($files))
	{
		foreach ($files as $file)
		{
			@unlink($file);
		}
	}
}

/**
* Start recording one moderator action.
*/
function im3_mod_undo_begin($action)
{
	if (!im3_mod_undo_user_tracked())
	{
		$GLOBALS['im3_mod_undo'] = array('active' => false);
		return false;
	}

	$GLOBALS['im3_mod_undo'] = array(
		'active'		=> true,
		'action'		=> $action,
		'token'			=> unique_id(),
		'posts'			=> array(),
		'topics'		=> array(),
		'reports'		=> array(),
		'attachments'	=> array(),
		'poll_options'	=> array(),
		'poll_votes'	=> array(),
		'watch'			=> array(),
		'bookmarks'		=> array(),
	);

	return true;
}

/**
* Called from delete_posts() before the rows are removed.
*/
function im3_mod_undo_capture_posts($post_ids)
{
	global $db;

	if (empty($GLOBALS['im3_mod_undo']['active']) || empty($post_ids))
	{
		return;
	}

	$ctx =& $GLOBALS['im3_mod_undo'];
	$post_ids = array_map('intval', $post_ids);

	$sql = 'SELECT *
		FROM ' . POSTS_TABLE . '
		WHERE ' . $db->sql_in_set('post_id', $post_ids);
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$ctx['posts'][(int) $row['post_id']] = $row;
	}
	$db->sql_freeresult($result);

	$sql = 'SELECT *
		FROM ' . REPORTS_TABLE . '
		WHERE ' . $db->sql_in_set('post_id', $post_ids);
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$ctx['reports'][(int) $row['report_id']] = $row;
	}
	$db->sql_freeresult($result);

	$sql = 'SELECT *
		FROM ' . ATTACHMENTS_TABLE . '
		WHERE ' . $db->sql_in_set('post_msg_id', $post_ids) . '
			AND in_message = 0';
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$ctx['attachments'][(int) $row['attach_id']] = $row;

		im3_mod_undo_store_file($ctx['token'], $row['physical_filename']);

		if ($row['thumbnail'])
		{
			im3_mod_undo_store_file($ctx['token'], 'thumb_' . utf8_basename($row['physical_filename']));
		}
	}
	$db->sql_freeresult($result);
}

/**
* Called from delete_topics() before the rows are removed.
*/
function im3_mod_undo_capture_topics($where_clause)
{
	global $db;

	if (empty($GLOBALS['im3_mod_undo']['active']) || $where_clause === '')
	{
		return;
	}

	$ctx =& $GLOBALS['im3_mod_undo'];
	$topic_ids = array();

	$sql = 'SELECT *
		FROM ' . TOPICS_TABLE . '
		WHERE ' . $where_clause;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$ctx['topics'][(int) $row['topic_id']] = $row;
		$topic_ids[] = (int) $row['topic_id'];
	}
	$db->sql_freeresult($result);

	if (!sizeof($topic_ids))
	{
		return;
	}

	// Shadow topics pointing to these topics are removed as well
	$sql = 'SELECT *
		FROM ' . TOPICS_TABLE . '
		WHERE ' . $db->sql_in_set('topic_moved_id', $topic_ids);
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$ctx['topics'][(int) $row['topic_id']] = $row;
	}
	$db->sql_freeresult($result);

	$tables = array(
		'poll_options'	=> POLL_OPTIONS_TABLE,
		'poll_votes'	=> POLL_VOTES_TABLE,
		'watch'			=> TOPICS_WATCH_TABLE,
		'bookmarks'		=> BOOKMARKS_TABLE,
	);

	foreach ($tables as $key => $table)
	{
		$rows = array();

		$sql = 'SELECT *
			FROM ' . $table . '
			WHERE ' . $db->sql_in_set('topic_id', $topic_ids);
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$rows[(int) $row['topic_id']][] = $row;
		}
		$db->sql_freeresult($result);

		foreach ($rows as $topic_id => $list)
		{
			$ctx[$key][$topic_id] = $list;
		}
	}
}

/**
* Store the recorded action.
*/
function im3_mod_undo_end()
{
	global $db, $user;

	$ctx = isset($GLOBALS['im3_mod_undo']) ? $GLOBALS['im3_mod_undo'] : array();
	$GLOBALS['im3_mod_undo'] = array('active' => false);

	if (empty($ctx['active']) || (!sizeof($ctx['posts']) && !sizeof($ctx['topics']) && empty($ctx['extra'])))
	{
		return 0;
	}

	$forum_id = $topic_id = $post_id = 0;
	$subjects = array();

	foreach ($ctx['topics'] as $row)
	{
		if (!$forum_id)
		{
			$forum_id = (int) $row['forum_id'];
			$topic_id = (int) $row['topic_id'];
		}

		if (!$row['topic_moved_id'])
		{
			$subjects[] = $row['topic_title'];
		}
	}

	foreach ($ctx['posts'] as $row)
	{
		if (!$post_id)
		{
			$post_id = (int) $row['post_id'];
			$forum_id = ($forum_id) ? $forum_id : (int) $row['forum_id'];
			$topic_id = ($topic_id) ? $topic_id : (int) $row['topic_id'];
		}

		if (!sizeof($ctx['topics']))
		{
			$subjects[] = $row['post_subject'];
		}
	}

	$subjects = array_values(array_unique($subjects));
	$summary = implode(', ', array_slice($subjects, 0, 3));
	$summary .= (sizeof($subjects) > 3) ? ' (+' . (sizeof($subjects) - 3) . ')' : '';
	$summary = '[' . sizeof($ctx['posts']) . '] ' . $summary;

	if (!empty($ctx['extra']['to_topic_id']))
	{
		$topic_id = (int) $ctx['extra']['to_topic_id'];
		$post_id = (int) key($ctx['extra']['origins']);
		$summary = '[' . sizeof($ctx['extra']['origins']) . '] → ' . im3_mod_undo_titles(array($topic_id));
	}

	$payload = array(
		'posts'			=> $ctx['posts'],
		'topics'		=> $ctx['topics'],
		'reports'		=> $ctx['reports'],
		'attachments'	=> $ctx['attachments'],
		'poll_options'	=> $ctx['poll_options'],
		'poll_votes'	=> $ctx['poll_votes'],
		'watch'			=> $ctx['watch'],
		'bookmarks'		=> $ctx['bookmarks'],
	);

	if (!empty($ctx['extra']))
	{
		$payload = array_merge($payload, $ctx['extra']);
	}

	$sql_ary = array(
		'undo_token'	=> $ctx['token'],
		'undo_action'	=> $ctx['action'],
		'user_id'		=> (int) $user->data['user_id'],
		'forum_id'		=> $forum_id,
		'topic_id'		=> $topic_id,
		'post_id'		=> $post_id,
		'undo_time'		=> time(),
		'undo_summary'	=> utf8_substr($summary, 0, 250),
		'undo_data'		=> serialize($payload),
		'undo_status'	=> 0,
	);

	$db->sql_query('INSERT INTO ' . MOD_UNDO_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
	$undo_id = (int) $db->sql_nextid();

	im3_mod_undo_prune();

	return $undo_id;
}

/**
* Save the current state of a post before someone other than the author edits it.
*/
function im3_mod_undo_capture_edit($post_id)
{
	global $db, $user;

	if ($post_id < 1 || !im3_mod_undo_user_tracked())
	{
		return;
	}

	$sql = 'SELECT p.*, t.topic_title, t.topic_first_post_id
		FROM ' . POSTS_TABLE . ' p, ' . TOPICS_TABLE . ' t
		WHERE p.post_id = ' . (int) $post_id . '
			AND t.topic_id = p.topic_id';
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if (!$row || (int) $row['poster_id'] === (int) $user->data['user_id'])
	{
		return;
	}

	$fields = array(
		'post_subject', 'post_text', 'bbcode_uid', 'bbcode_bitfield', 'post_checksum',
		'enable_bbcode', 'enable_smilies', 'enable_magic_url', 'enable_sig', 'icon_id',
		'post_attachment', 'post_edit_time', 'post_edit_reason', 'post_edit_user',
		'post_edit_count', 'post_edit_locked',
	);

	$post = array();
	foreach ($fields as $field)
	{
		if (array_key_exists($field, $row))
		{
			$post[$field] = $row[$field];
		}
	}

	$payload = array(
		'post'			=> $post,
		'topic_title'	=> ((int) $row['topic_first_post_id'] === (int) $row['post_id']) ? $row['topic_title'] : null,
	);

	$sql_ary = array(
		'undo_token'	=> unique_id(),
		'undo_action'	=> 'edit',
		'user_id'		=> (int) $user->data['user_id'],
		'forum_id'		=> (int) $row['forum_id'],
		'topic_id'		=> (int) $row['topic_id'],
		'post_id'		=> (int) $row['post_id'],
		'undo_time'		=> time(),
		'undo_summary'	=> utf8_substr($row['post_subject'], 0, 250),
		'undo_data'		=> serialize($payload),
		'undo_status'	=> 0,
	);

	$db->sql_query('INSERT INTO ' . MOD_UNDO_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
}

/**
* Delete entries older than the retention period (once a day unless forced).
*/
function im3_mod_undo_prune($force = false)
{
	global $db, $config;

	$days = isset($config['mod_undo_days']) ? (int) $config['mod_undo_days'] : 0;

	if ($days < 1)
	{
		return;
	}

	if (!$force && !empty($config['mod_undo_last_prune']) && (int) $config['mod_undo_last_prune'] > time() - 86400)
	{
		return;
	}

	set_config('mod_undo_last_prune', time(), true);

	$cutoff = time() - ($days * 86400);
	$ids = array();

	$sql = 'SELECT undo_id, undo_token
		FROM ' . MOD_UNDO_TABLE . '
		WHERE undo_time < ' . $cutoff;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$ids[] = (int) $row['undo_id'];
		im3_mod_undo_drop_files($row['undo_token']);
	}
	$db->sql_freeresult($result);

	if (sizeof($ids))
	{
		$db->sql_query('DELETE FROM ' . MOD_UNDO_TABLE . ' WHERE ' . $db->sql_in_set('undo_id', $ids));
	}
}

/**
* Search backend instance or false.
*/
function im3_mod_undo_search()
{
	global $config, $phpbb_root_path, $phpEx;

	$search_type = basename($config['search_type']);

	if (!file_exists($phpbb_root_path . 'includes/search/' . $search_type . '.' . $phpEx))
	{
		return false;
	}

	if (!class_exists($search_type))
	{
		include($phpbb_root_path . 'includes/search/' . $search_type . '.' . $phpEx);
	}

	$error = false;
	$search = new $search_type($error);

	return ($error) ? false : $search;
}

/**
* Restore one entry. $error receives a language key on failure.
*/
function im3_mod_undo_restore($undo_id, &$error)
{
	global $db, $user;

	$error = '';

	$sql = 'SELECT *
		FROM ' . MOD_UNDO_TABLE . '
		WHERE undo_id = ' . (int) $undo_id;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if (!$row)
	{
		$error = 'MOD_UNDO_NOT_FOUND';
		return false;
	}

	if ((int) $row['undo_status'] !== 0)
	{
		$error = 'MOD_UNDO_ALREADY';
		return false;
	}

	$data = @unserialize($row['undo_data'], array('allowed_classes' => false));

	if (!is_array($data))
	{
		$error = 'MOD_UNDO_BAD_DATA';
		return false;
	}

	switch ($row['undo_action'])
	{
		case 'edit':
			$ok = im3_mod_undo_restore_edit((int) $row['post_id'], $data, $error);
		break;

		case 'delete_post':
		case 'delete_topic':
			$ok = im3_mod_undo_restore_delete($data, $row['undo_token'], $error);
		break;

		case 'lock':
		case 'unlock':
		case 'lock_post':
		case 'unlock_post':
			$ok = im3_mod_undo_restore_lock($data, $error);
		break;

		case 'move':
			$ok = im3_mod_undo_restore_move($data, $error);
		break;

		case 'split':
			$ok = im3_mod_undo_restore_split($data, $error);
		break;

		case 'merge':
			$ok = im3_mod_undo_restore_merge($data, $error);
		break;

		case 'change_poster':
			$ok = im3_mod_undo_restore_change_poster($data, $error);
		break;

		case 'ban':
		case 'unban':
			$ok = im3_mod_undo_restore_ban($data, $error);
		break;

		case 'warning':
			$ok = im3_mod_undo_restore_warning($data, $error);
		break;

		default:
			$error = 'MOD_UNDO_BAD_DATA';
			$ok = false;
		break;
	}

	if (!$ok)
	{
		return false;
	}

	$sql = 'UPDATE ' . MOD_UNDO_TABLE . '
		SET ' . $db->sql_build_array('UPDATE', array(
			'undo_status'	=> 1,
			'restored_by'	=> (int) $user->data['user_id'],
			'restored_time'	=> time(),
		)) . '
		WHERE undo_id = ' . (int) $row['undo_id'];
	$db->sql_query($sql);

	if (in_array($row['undo_action'], array('delete_post', 'delete_topic', 'merge')))
	{
		im3_mod_undo_drop_files($row['undo_token']);
	}

	$label = isset($user->lang['MOD_UNDO_ACTION_' . strtoupper($row['undo_action'])]) ? $user->lang['MOD_UNDO_ACTION_' . strtoupper($row['undo_action'])] : $row['undo_action'];
	add_log('admin', 'LOG_MOD_UNDO_RESTORE', $label, $row['undo_summary']);

	return true;
}

/**
* Put back the text of an edited post.
*/
function im3_mod_undo_restore_edit($post_id, $data, &$error)
{
	global $db, $phpbb_root_path, $phpEx;

	if (empty($data['post']) || !is_array($data['post']))
	{
		$error = 'MOD_UNDO_BAD_DATA';
		return false;
	}

	$sql = 'SELECT post_id, topic_id, forum_id, poster_id, enable_indexing
		FROM ' . POSTS_TABLE . '
		WHERE post_id = ' . (int) $post_id;
	$result = $db->sql_query($sql);
	$post = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if (!$post)
	{
		$error = 'MOD_UNDO_POST_GONE';
		return false;
	}

	$db->sql_transaction('begin');

	$db->sql_query('UPDATE ' . POSTS_TABLE . '
		SET ' . $db->sql_build_array('UPDATE', $data['post']) . '
		WHERE post_id = ' . (int) $post_id);

	if (isset($data['topic_title']) && $data['topic_title'] !== null)
	{
		$db->sql_query('UPDATE ' . TOPICS_TABLE . '
			SET ' . $db->sql_build_array('UPDATE', array('topic_title' => $data['topic_title'])) . '
			WHERE topic_id = ' . (int) $post['topic_id'] . '
				AND topic_first_post_id = ' . (int) $post_id);
	}

	$db->sql_transaction('commit');

	if (!function_exists('sync'))
	{
		include($phpbb_root_path . 'includes/functions_admin.' . $phpEx);
	}

	sync('topic', 'topic_id', array((int) $post['topic_id']), true);

	if ($post['enable_indexing'] && isset($data['post']['post_text'], $data['post']['post_subject']))
	{
		$search = im3_mod_undo_search();

		if ($search)
		{
			$message = $data['post']['post_text'];
			$subject = $data['post']['post_subject'];
			$search->index('edit', (int) $post_id, $message, $subject, (int) $post['poster_id'], (int) $post['forum_id']);
		}
	}

	return true;
}

/**
* Put back deleted posts and topics with their related rows and files.
*/
function im3_mod_undo_restore_delete($data, $token, &$error)
{
	global $db, $phpbb_root_path, $phpEx;

	$posts = (!empty($data['posts']) && is_array($data['posts'])) ? $data['posts'] : array();
	$topics = (!empty($data['topics']) && is_array($data['topics'])) ? $data['topics'] : array();

	if (!sizeof($posts) && !sizeof($topics))
	{
		$error = 'MOD_UNDO_BAD_DATA';
		return false;
	}

	// Every forum involved must still exist
	$forum_ids = array();
	foreach (array_merge(array_values($topics), array_values($posts)) as $row)
	{
		if ((int) $row['forum_id'] > 0)
		{
			$forum_ids[(int) $row['forum_id']] = (int) $row['forum_id'];
		}
	}

	if (sizeof($forum_ids))
	{
		$found = array();
		$sql = 'SELECT forum_id
			FROM ' . FORUMS_TABLE . '
			WHERE ' . $db->sql_in_set('forum_id', array_values($forum_ids));
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$found[] = (int) $row['forum_id'];
		}
		$db->sql_freeresult($result);

		if (sizeof(array_diff(array_values($forum_ids), $found)))
		{
			$error = 'MOD_UNDO_FORUM_GONE';
			return false;
		}
	}

	// Topics that exist right now
	$check_topic_ids = array_keys($topics);
	foreach ($posts as $row)
	{
		$check_topic_ids[] = (int) $row['topic_id'];
	}
	foreach ($topics as $row)
	{
		if ((int) $row['topic_moved_id'])
		{
			$check_topic_ids[] = (int) $row['topic_moved_id'];
		}
	}
	$check_topic_ids = array_values(array_unique(array_map('intval', $check_topic_ids)));

	$existing_topics = array();
	if (sizeof($check_topic_ids))
	{
		$sql = 'SELECT topic_id
			FROM ' . TOPICS_TABLE . '
			WHERE ' . $db->sql_in_set('topic_id', $check_topic_ids);
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$existing_topics[(int) $row['topic_id']] = true;
		}
		$db->sql_freeresult($result);
	}

	foreach ($posts as $row)
	{
		$tid = (int) $row['topic_id'];

		if (!isset($existing_topics[$tid]) && !isset($topics[$tid]))
		{
			$error = 'MOD_UNDO_TOPIC_GONE';
			return false;
		}
	}

	// Posts that were recreated some other way are skipped
	$existing_posts = array();
	if (sizeof($posts))
	{
		$sql = 'SELECT post_id
			FROM ' . POSTS_TABLE . '
			WHERE ' . $db->sql_in_set('post_id', array_map('intval', array_keys($posts)));
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$existing_posts[(int) $row['post_id']] = true;
		}
		$db->sql_freeresult($result);
	}

	$db->sql_transaction('begin');

	// Real topics first, shadows after their target exists
	$restored_topics = array();
	$num_topics = 0;

	foreach ($topics as $tid => $row)
	{
		if ((int) $row['topic_moved_id'] || isset($existing_topics[(int) $tid]))
		{
			continue;
		}

		$db->sql_query('INSERT INTO ' . TOPICS_TABLE . ' ' . $db->sql_build_array('INSERT', $row));
		$restored_topics[(int) $tid] = true;
		$existing_topics[(int) $tid] = true;

		if ($row['topic_approved'])
		{
			$num_topics++;
		}
	}

	foreach ($topics as $tid => $row)
	{
		$target = (int) $row['topic_moved_id'];

		if (!$target || isset($existing_topics[(int) $tid]) || !isset($existing_topics[$target]))
		{
			continue;
		}

		$db->sql_query('INSERT INTO ' . TOPICS_TABLE . ' ' . $db->sql_build_array('INSERT', $row));
		$existing_topics[(int) $tid] = true;
	}

	// Posts
	$restored_posts = $post_counts = $topic_ids = array();
	$approved_posts = 0;

	foreach ($posts as $pid => $row)
	{
		if (isset($existing_posts[(int) $pid]))
		{
			continue;
		}

		$db->sql_query('INSERT INTO ' . POSTS_TABLE . ' ' . $db->sql_build_array('INSERT', $row));
		$restored_posts[(int) $pid] = $row;
		$topic_ids[(int) $row['topic_id']] = (int) $row['topic_id'];
		$forum_ids[(int) $row['forum_id']] = (int) $row['forum_id'];

		if ($row['post_approved'])
		{
			$approved_posts++;

			if ($row['post_postcount'])
			{
				$poster = (int) $row['poster_id'];
				$post_counts[$poster] = (isset($post_counts[$poster])) ? $post_counts[$poster] + 1 : 1;
			}
		}
	}

	// Reports
	if (!empty($data['reports']) && sizeof($restored_posts))
	{
		$existing = array();
		$sql = 'SELECT report_id
			FROM ' . REPORTS_TABLE . '
			WHERE ' . $db->sql_in_set('report_id', array_map('intval', array_keys($data['reports'])));
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$existing[(int) $row['report_id']] = true;
		}
		$db->sql_freeresult($result);

		foreach ($data['reports'] as $rid => $row)
		{
			if (!isset($existing[(int) $rid]) && isset($restored_posts[(int) $row['post_id']]))
			{
				$db->sql_query('INSERT INTO ' . REPORTS_TABLE . ' ' . $db->sql_build_array('INSERT', $row));
			}
		}
	}

	// Attachments
	$space_added = $files_added = 0;

	if (!empty($data['attachments']) && sizeof($restored_posts))
	{
		$existing = array();
		$sql = 'SELECT attach_id
			FROM ' . ATTACHMENTS_TABLE . '
			WHERE ' . $db->sql_in_set('attach_id', array_map('intval', array_keys($data['attachments'])));
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$existing[(int) $row['attach_id']] = true;
		}
		$db->sql_freeresult($result);

		foreach ($data['attachments'] as $aid => $row)
		{
			if (isset($existing[(int) $aid]) || !isset($restored_posts[(int) $row['post_msg_id']]))
			{
				continue;
			}

			$file_ok = im3_mod_undo_return_file($token, $row['physical_filename']);

			if ($row['thumbnail'])
			{
				im3_mod_undo_return_file($token, 'thumb_' . utf8_basename($row['physical_filename']));
			}

			$db->sql_query('INSERT INTO ' . ATTACHMENTS_TABLE . ' ' . $db->sql_build_array('INSERT', $row));

			if ($file_ok && !$row['is_orphan'])
			{
				$space_added += (int) $row['filesize'];
				$files_added++;
			}
		}
	}

	// Rows that belong to restored topics
	$tables = array(
		'poll_options'	=> POLL_OPTIONS_TABLE,
		'poll_votes'	=> POLL_VOTES_TABLE,
		'watch'			=> TOPICS_WATCH_TABLE,
		'bookmarks'		=> BOOKMARKS_TABLE,
	);

	foreach ($tables as $key => $table)
	{
		if (empty($data[$key]))
		{
			continue;
		}

		foreach ($data[$key] as $tid => $rows)
		{
			if (isset($restored_topics[(int) $tid]) && is_array($rows) && sizeof($rows))
			{
				$db->sql_multi_insert($table, $rows);
			}
		}
	}

	// User post counts
	foreach ($post_counts as $poster_id => $add)
	{
		$db->sql_query('UPDATE ' . USERS_TABLE . '
			SET user_posts = user_posts + ' . (int) $add . '
			WHERE user_id = ' . (int) $poster_id);
	}

	$db->sql_transaction('commit');

	if ($approved_posts)
	{
		set_config_count('num_posts', $approved_posts, true);
	}

	if ($num_topics)
	{
		set_config_count('num_topics', $num_topics, true);
	}

	if ($space_added || $files_added)
	{
		set_config_count('upload_dir_size', $space_added, true);
		set_config_count('num_files', $files_added, true);
	}

	if (!function_exists('sync'))
	{
		include($phpbb_root_path . 'includes/functions_admin.' . $phpEx);
	}

	foreach ($topics as $row)
	{
		if ((int) $row['forum_id'] > 0)
		{
			$forum_ids[(int) $row['forum_id']] = (int) $row['forum_id'];
		}

		if (isset($existing_topics[(int) $row['topic_id']]) && !(int) $row['topic_moved_id'])
		{
			$topic_ids[(int) $row['topic_id']] = (int) $row['topic_id'];
		}
	}

	$topic_ids = array_values($topic_ids);
	$forum_ids = array_values(array_filter($forum_ids));

	if (sizeof($topic_ids))
	{
		update_posted_info($topic_ids);
		sync('topic_reported', 'topic_id', $topic_ids);
		sync('topic_attachment', 'topic_id', $topic_ids);
		sync('topic', 'topic_id', $topic_ids, true);
	}

	if (sizeof($forum_ids))
	{
		sync('forum', 'forum_id', $forum_ids, true, true);
	}

	// Recent poster caches used by delete_post()
	if (!function_exists('rebuild_recent_poster_cache'))
	{
		include_once($phpbb_root_path . 'includes/functions_display.' . $phpEx);
	}

	if (function_exists('rebuild_recent_poster_cache'))
	{
		foreach ($topic_ids as $tid)
		{
			$db->sql_query('UPDATE ' . TOPICS_TABLE . "
				SET topic_recent_posters = '" . $db->sql_escape(rebuild_recent_poster_cache('topic', $tid)) . "'
				WHERE topic_id = " . (int) $tid);
		}

		foreach ($forum_ids as $fid)
		{
			$db->sql_query('UPDATE ' . FORUMS_TABLE . "
				SET forum_recent_posters = '" . $db->sql_escape(rebuild_recent_poster_cache('forum', $fid)) . "'
				WHERE forum_id = " . (int) $fid);
		}
	}

	// Search index
	if (sizeof($restored_posts))
	{
		$search = im3_mod_undo_search();

		if ($search)
		{
			foreach ($restored_posts as $pid => $row)
			{
				if (empty($row['enable_indexing']))
				{
					continue;
				}

				$message = $row['post_text'];
				$subject = $row['post_subject'];
				$search->index('post', (int) $pid, $message, $subject, (int) $row['poster_id'], (int) $row['forum_id']);
			}
		}
	}

	return true;
}

/**
* Store one record directly (actions that are not deletions or edits).
*/
function im3_mod_undo_store($action, $forum_id, $topic_id, $post_id, $summary, $payload)
{
	global $db, $user;

	$sql_ary = array(
		'undo_token'	=> unique_id(),
		'undo_action'	=> $action,
		'user_id'		=> (int) $user->data['user_id'],
		'forum_id'		=> (int) $forum_id,
		'topic_id'		=> (int) $topic_id,
		'post_id'		=> (int) $post_id,
		'undo_time'		=> time(),
		'undo_summary'	=> utf8_substr((string) $summary, 0, 250),
		'undo_data'		=> serialize($payload),
		'undo_status'	=> 0,
	);

	$db->sql_query('INSERT INTO ' . MOD_UNDO_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));

	im3_mod_undo_prune();

	return (int) $db->sql_nextid();
}

function im3_mod_undo_load_admin()
{
	global $phpbb_root_path, $phpEx;

	if (!function_exists('sync'))
	{
		include($phpbb_root_path . 'includes/functions_admin.' . $phpEx);
	}
}

/**
* Topic titles for a summary.
*/
function im3_mod_undo_titles($topic_ids)
{
	global $db;

	$titles = array();
	$topic_ids = array_values(array_filter(array_map('intval', (array) $topic_ids)));

	if (!sizeof($topic_ids))
	{
		return '';
	}

	$sql = 'SELECT topic_title
		FROM ' . TOPICS_TABLE . '
		WHERE ' . $db->sql_in_set('topic_id', $topic_ids);
	$result = $db->sql_query_limit($sql, 4);

	while ($row = $db->sql_fetchrow($result))
	{
		$titles[] = $row['topic_title'];
	}
	$db->sql_freeresult($result);

	$summary = implode(', ', array_slice($titles, 0, 3));
	$summary .= (sizeof($topic_ids) > 3) ? ' (+' . (sizeof($topic_ids) - 3) . ')' : '';

	return $summary;
}

/**
* Lock / unlock topics or posts: values before the change.
*/
function im3_mod_undo_lock_before($action, $ids)
{
	global $db;

	if (!im3_mod_undo_user_tracked() || empty($ids))
	{
		return false;
	}

	$is_topic = ($action == 'lock' || $action == 'unlock');
	$table = ($is_topic) ? TOPICS_TABLE : POSTS_TABLE;
	$sql_id = ($is_topic) ? 'topic_id' : 'post_id';
	$set_id = ($is_topic) ? 'topic_status' : 'post_edit_locked';

	$state = array();
	$sql = "SELECT $sql_id, $set_id, forum_id, topic_id
		FROM $table
		WHERE " . $db->sql_in_set($sql_id, array_map('intval', $ids));
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$state[(int) $row[$sql_id]] = array(
			'value'		=> (int) $row[$set_id],
			'forum_id'	=> (int) $row['forum_id'],
			'topic_id'	=> (int) $row['topic_id'],
		);
	}
	$db->sql_freeresult($result);

	return array('action' => $action, 'state' => $state);
}

function im3_mod_undo_lock_after($before)
{
	if (empty($before['state']))
	{
		return;
	}

	$first = reset($before['state']);
	$topic_ids = array();
	foreach ($before['state'] as $row)
	{
		$topic_ids[] = $row['topic_id'];
	}

	im3_mod_undo_store($before['action'], $first['forum_id'], $first['topic_id'], 0, im3_mod_undo_titles(array_unique($topic_ids)), $before);
}

function im3_mod_undo_restore_lock($data, &$error)
{
	global $db;

	if (empty($data['state']) || empty($data['action']))
	{
		$error = 'MOD_UNDO_BAD_DATA';
		return false;
	}

	$is_topic = ($data['action'] == 'lock' || $data['action'] == 'unlock');
	$table = ($is_topic) ? TOPICS_TABLE : POSTS_TABLE;
	$sql_id = ($is_topic) ? 'topic_id' : 'post_id';
	$set_id = ($is_topic) ? 'topic_status' : 'post_edit_locked';

	foreach ($data['state'] as $id => $row)
	{
		$value = (int) $row['value'];

		// Topics moved since then keep their moved status
		$sql = "UPDATE $table
			SET $set_id = $value
			WHERE $sql_id = " . (int) $id . (($is_topic) ? ' AND topic_status <> ' . ITEM_MOVED : '');
		$db->sql_query($sql);
	}

	return true;
}

/**
* Move topics: state before the move.
*/
function im3_mod_undo_move_before($topic_ids, $to_forum_id)
{
	global $db;

	if (!im3_mod_undo_user_tracked() || empty($topic_ids))
	{
		return false;
	}

	$topic_ids = array_map('intval', $topic_ids);
	$topics = $shadows = $old_shadow_ids = array();

	$sql = 'SELECT topic_id, forum_id, topic_type
		FROM ' . TOPICS_TABLE . '
		WHERE ' . $db->sql_in_set('topic_id', $topic_ids);
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$topics[(int) $row['topic_id']] = array('forum_id' => (int) $row['forum_id'], 'topic_type' => (int) $row['topic_type']);
	}
	$db->sql_freeresult($result);

	// Shadows that move_topics() removes, and the ones already present
	$sql = 'SELECT *
		FROM ' . TOPICS_TABLE . '
		WHERE ' . $db->sql_in_set('topic_moved_id', $topic_ids);
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$old_shadow_ids[] = (int) $row['topic_id'];

		if ((int) $row['forum_id'] === (int) $to_forum_id)
		{
			$shadows[(int) $row['topic_id']] = $row;
		}
	}
	$db->sql_freeresult($result);

	return array(
		'topics'			=> $topics,
		'to_forum_id'		=> (int) $to_forum_id,
		'removed_shadows'	=> $shadows,
		'old_shadow_ids'	=> $old_shadow_ids,
	);
}

function im3_mod_undo_move_after($before)
{
	global $db;

	if (empty($before['topics']))
	{
		return;
	}

	$created = array();
	$sql = 'SELECT topic_id
		FROM ' . TOPICS_TABLE . '
		WHERE ' . $db->sql_in_set('topic_moved_id', array_keys($before['topics']));
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		if (!in_array((int) $row['topic_id'], $before['old_shadow_ids']))
		{
			$created[] = (int) $row['topic_id'];
		}
	}
	$db->sql_freeresult($result);

	$before['created_shadows'] = $created;
	unset($before['old_shadow_ids']);

	$first_id = key($before['topics']);
	im3_mod_undo_store('move', $before['to_forum_id'], $first_id, 0, im3_mod_undo_titles(array_keys($before['topics'])), $before);
}

function im3_mod_undo_restore_move($data, &$error)
{
	global $db;

	if (empty($data['topics']))
	{
		$error = 'MOD_UNDO_BAD_DATA';
		return false;
	}

	im3_mod_undo_load_admin();

	$existing = array();
	$sql = 'SELECT topic_id
		FROM ' . TOPICS_TABLE . '
		WHERE ' . $db->sql_in_set('topic_id', array_map('intval', array_keys($data['topics'])));
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$existing[(int) $row['topic_id']] = true;
	}
	$db->sql_freeresult($result);

	if (!sizeof($existing))
	{
		$error = 'MOD_UNDO_TOPIC_GONE';
		return false;
	}

	$forum_ids = array((int) $data['to_forum_id']);

	if (!empty($data['created_shadows']))
	{
		$db->sql_query('DELETE FROM ' . TOPICS_TABLE . '
			WHERE ' . $db->sql_in_set('topic_id', array_map('intval', $data['created_shadows'])) . '
				AND topic_status = ' . ITEM_MOVED);
	}

	$by_forum = array();
	foreach ($data['topics'] as $tid => $row)
	{
		if (isset($existing[(int) $tid]))
		{
			$by_forum[(int) $row['forum_id']][] = (int) $tid;
		}
	}

	foreach ($by_forum as $forum_id => $ids)
	{
		move_topics($ids, $forum_id, false);
		$forum_ids[] = $forum_id;

		foreach ($ids as $tid)
		{
			$db->sql_query('UPDATE ' . TOPICS_TABLE . '
				SET topic_type = ' . (int) $data['topics'][$tid]['topic_type'] . '
				WHERE topic_id = ' . (int) $tid);
		}
	}

	if (!empty($data['removed_shadows']))
	{
		foreach ($data['removed_shadows'] as $sid => $row)
		{
			$sql = 'SELECT topic_id
				FROM ' . TOPICS_TABLE . '
				WHERE topic_id = ' . (int) $sid;
			$result = $db->sql_query($sql);
			$found = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			if (!$found && isset($existing[(int) $row['topic_moved_id']]))
			{
				$db->sql_query('INSERT INTO ' . TOPICS_TABLE . ' ' . $db->sql_build_array('INSERT', $row));
			}
		}
	}

	sync('forum', 'forum_id', array_values(array_unique(array_filter($forum_ids))), true, true);

	return true;
}

/**
* Split: called after the new topic was created and the posts were moved.
*/
function im3_mod_undo_split_subject($post_id)
{
	global $db;

	$sql = 'SELECT post_subject
		FROM ' . POSTS_TABLE . '
		WHERE post_id = ' . (int) $post_id;
	$result = $db->sql_query($sql);
	$subject = (string) $db->sql_fetchfield('post_subject');
	$db->sql_freeresult($result);

	return $subject;
}

function im3_mod_undo_split_record($from_topic_id, $from_forum_id, $to_topic_id, $post_ids, $old_subject, $new_subject)
{
	if (!im3_mod_undo_user_tracked() || empty($post_ids))
	{
		return;
	}

	$post_ids = array_values(array_map('intval', $post_ids));

	im3_mod_undo_store('split', $from_forum_id, $from_topic_id, $post_ids[0], $new_subject, array(
		'from_topic_id'	=> (int) $from_topic_id,
		'to_topic_id'	=> (int) $to_topic_id,
		'post_ids'		=> $post_ids,
		'first_post_id'	=> $post_ids[0],
		'old_subject'	=> $old_subject,
	));
}

function im3_mod_undo_restore_split($data, &$error)
{
	global $db;

	if (empty($data['post_ids']) || empty($data['from_topic_id']))
	{
		$error = 'MOD_UNDO_BAD_DATA';
		return false;
	}

	$sql = 'SELECT topic_id
		FROM ' . TOPICS_TABLE . '
		WHERE topic_id = ' . (int) $data['from_topic_id'];
	$result = $db->sql_query($sql);
	$found = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if (!$found)
	{
		$error = 'MOD_UNDO_TOPIC_GONE';
		return false;
	}

	$post_ids = array();
	$sql = 'SELECT post_id
		FROM ' . POSTS_TABLE . '
		WHERE ' . $db->sql_in_set('post_id', array_map('intval', $data['post_ids'])) . '
			AND topic_id = ' . (int) $data['to_topic_id'];
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$post_ids[] = (int) $row['post_id'];
	}
	$db->sql_freeresult($result);

	if (!sizeof($post_ids))
	{
		$error = 'MOD_UNDO_STATE_CHANGED';
		return false;
	}

	im3_mod_undo_load_admin();

	$db->sql_query('UPDATE ' . POSTS_TABLE . "
		SET post_subject = '" . $db->sql_escape($data['old_subject']) . "'
		WHERE post_id = " . (int) $data['first_post_id']);

	// sync() removes the split topic once it is empty
	move_posts($post_ids, (int) $data['from_topic_id']);

	return true;
}

/**
* Merge posts / topics. Origins are kept per post; topics emptied by the merge are captured by delete_topics().
*/
function im3_mod_undo_merge_begin($post_ids, $to_topic_id)
{
	global $db;

	if (!im3_mod_undo_begin('merge') || empty($post_ids))
	{
		return;
	}

	$origins = array();
	$sql = 'SELECT post_id, topic_id
		FROM ' . POSTS_TABLE . '
		WHERE ' . $db->sql_in_set('post_id', array_map('intval', $post_ids));
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$origins[(int) $row['post_id']] = (int) $row['topic_id'];
	}
	$db->sql_freeresult($result);

	$GLOBALS['im3_mod_undo']['extra'] = array(
		'origins'		=> $origins,
		'to_topic_id'	=> (int) $to_topic_id,
	);
}

function im3_mod_undo_restore_merge($data, &$error)
{
	global $db;

	if (empty($data['origins']) || empty($data['to_topic_id']))
	{
		$error = 'MOD_UNDO_BAD_DATA';
		return false;
	}

	im3_mod_undo_load_admin();

	$topics = (!empty($data['topics']) && is_array($data['topics'])) ? $data['topics'] : array();
	$origin_topics = array_values(array_unique($data['origins']));

	$existing = array();
	$sql = 'SELECT topic_id
		FROM ' . TOPICS_TABLE . '
		WHERE ' . $db->sql_in_set('topic_id', array_merge($origin_topics, array_map('intval', array_keys($topics)), array((int) $data['to_topic_id'])));
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$existing[(int) $row['topic_id']] = true;
	}
	$db->sql_freeresult($result);

	foreach ($origin_topics as $tid)
	{
		if (!isset($existing[$tid]) && !isset($topics[$tid]))
		{
			$error = 'MOD_UNDO_TOPIC_GONE';
			return false;
		}
	}

	$db->sql_transaction('begin');

	$restored = array();
	$num_topics = 0;

	foreach ($topics as $tid => $row)
	{
		if (!(int) $row['topic_moved_id'] && !isset($existing[(int) $tid]))
		{
			$db->sql_query('INSERT INTO ' . TOPICS_TABLE . ' ' . $db->sql_build_array('INSERT', $row));
			$existing[(int) $tid] = $restored[(int) $tid] = true;
			$num_topics += ($row['topic_approved']) ? 1 : 0;
		}
	}

	foreach ($topics as $tid => $row)
	{
		if ((int) $row['topic_moved_id'] && !isset($existing[(int) $tid]) && isset($existing[(int) $row['topic_moved_id']]))
		{
			$db->sql_query('INSERT INTO ' . TOPICS_TABLE . ' ' . $db->sql_build_array('INSERT', $row));
			$existing[(int) $tid] = true;
		}
	}

	$tables = array(
		'poll_options'	=> POLL_OPTIONS_TABLE,
		'poll_votes'	=> POLL_VOTES_TABLE,
		'watch'			=> TOPICS_WATCH_TABLE,
		'bookmarks'		=> BOOKMARKS_TABLE,
	);

	foreach ($tables as $key => $table)
	{
		if (empty($data[$key]))
		{
			continue;
		}

		foreach ($data[$key] as $tid => $rows)
		{
			if (isset($restored[(int) $tid]) && is_array($rows) && sizeof($rows))
			{
				$db->sql_multi_insert($table, $rows);
			}
		}
	}

	$db->sql_transaction('commit');

	if ($num_topics)
	{
		set_config_count('num_topics', $num_topics, true);
	}

	// Posts still in the merge target go back to their original topic
	$current = array();
	$sql = 'SELECT post_id
		FROM ' . POSTS_TABLE . '
		WHERE ' . $db->sql_in_set('post_id', array_map('intval', array_keys($data['origins']))) . '
			AND topic_id = ' . (int) $data['to_topic_id'];
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$current[(int) $row['post_id']] = true;
	}
	$db->sql_freeresult($result);

	$by_topic = array();
	foreach ($data['origins'] as $pid => $tid)
	{
		if (isset($current[(int) $pid]) && (int) $tid !== (int) $data['to_topic_id'])
		{
			$by_topic[(int) $tid][] = (int) $pid;
		}
	}

	foreach ($by_topic as $tid => $pids)
	{
		move_posts($pids, $tid);
	}

	if (sizeof($restored))
	{
		$ids = array_keys($restored);
		sync('topic', 'topic_id', $ids, true);
	}

	return true;
}

/**
* Change poster.
*/
function im3_mod_undo_change_poster($post_info, $userdata)
{
	if (empty($userdata) || $userdata['user_id'] == $post_info['user_id'] || !im3_mod_undo_user_tracked())
	{
		return;
	}

	im3_mod_undo_store('change_poster', $post_info['forum_id'], $post_info['topic_id'], $post_info['post_id'], $post_info['username'] . ' → ' . $userdata['username'], array(
		'post_id'		=> (int) $post_info['post_id'],
		'old_poster'	=> (int) $post_info['user_id'],
		'new_poster'	=> (int) $userdata['user_id'],
	));
}

function im3_mod_undo_restore_change_poster($data, &$error)
{
	global $db, $config;

	$sql = 'SELECT post_id, topic_id, forum_id, poster_id, post_postcount, post_approved, post_attachment
		FROM ' . POSTS_TABLE . '
		WHERE post_id = ' . (int) $data['post_id'];
	$result = $db->sql_query($sql);
	$post = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if (!$post)
	{
		$error = 'MOD_UNDO_POST_GONE';
		return false;
	}

	if ((int) $post['poster_id'] !== (int) $data['new_poster'])
	{
		$error = 'MOD_UNDO_STATE_CHANGED';
		return false;
	}

	$old = (int) $data['old_poster'];
	$new = (int) $data['new_poster'];

	im3_mod_undo_load_admin();

	$db->sql_transaction('begin');

	$db->sql_query('UPDATE ' . POSTS_TABLE . " SET poster_id = $old WHERE post_id = " . (int) $post['post_id']);

	if ($post['post_postcount'] && $post['post_approved'])
	{
		$db->sql_query('UPDATE ' . USERS_TABLE . " SET user_posts = user_posts - 1 WHERE user_id = $new AND user_posts > 0");
		$db->sql_query('UPDATE ' . USERS_TABLE . " SET user_posts = user_posts + 1 WHERE user_id = $old");
	}

	if ($post['post_attachment'])
	{
		$db->sql_query('UPDATE ' . ATTACHMENTS_TABLE . "
			SET poster_id = $old
			WHERE poster_id = $new
				AND post_msg_id = " . (int) $post['post_id'] . '
				AND topic_id = ' . (int) $post['topic_id']);
	}

	$db->sql_transaction('commit');

	update_posted_info($ids = array((int) $post['topic_id']));
	sync('topic', 'topic_id', (int) $post['topic_id'], false, false);
	sync('forum', 'forum_id', (int) $post['forum_id'], false, false);

	$search = im3_mod_undo_search();
	if ($search && method_exists($search, 'destroy_cache'))
	{
		$search->destroy_cache(array(), array($old, $new));
	}

	return true;
}

/**
* Bans: the ban list is compared before and after user_ban() / user_unban().
*/
function im3_mod_undo_ban_snapshot()
{
	global $db;

	if (!im3_mod_undo_user_tracked())
	{
		return false;
	}

	$rows = array();
	$result = $db->sql_query('SELECT * FROM ' . BANLIST_TABLE);

	while ($row = $db->sql_fetchrow($result))
	{
		$rows[(int) $row['ban_id']] = $row;
	}
	$db->sql_freeresult($result);

	return $rows;
}

function im3_mod_undo_ban_record($action, $before, $summary)
{
	global $db;

	if ($before === false)
	{
		return;
	}

	$after = array();
	$result = $db->sql_query('SELECT ban_id FROM ' . BANLIST_TABLE);

	while ($row = $db->sql_fetchrow($result))
	{
		$after[(int) $row['ban_id']] = true;
	}
	$db->sql_freeresult($result);

	$added = array_values(array_diff(array_keys($after), array_keys($before)));
	$removed = array();
	$now = time();

	foreach ($before as $id => $row)
	{
		// Expired bans removed by the cleanup are not part of this action
		if (!isset($after[$id]) && ((int) $row['ban_end'] === 0 || (int) $row['ban_end'] >= $now))
		{
			$removed[$id] = $row;
		}
	}

	if (!sizeof($added) && !sizeof($removed))
	{
		return;
	}

	im3_mod_undo_store($action, 0, 0, 0, $summary, array(
		'added'		=> $added,
		'removed'	=> $removed,
	));
}

function im3_mod_undo_restore_ban($data, &$error)
{
	global $db, $cache;

	if (!empty($data['added']))
	{
		$db->sql_query('DELETE FROM ' . BANLIST_TABLE . ' WHERE ' . $db->sql_in_set('ban_id', array_map('intval', $data['added'])));
	}

	if (!empty($data['removed']))
	{
		$existing = array();
		$sql = 'SELECT ban_id
			FROM ' . BANLIST_TABLE . '
			WHERE ' . $db->sql_in_set('ban_id', array_map('intval', array_keys($data['removed'])));
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$existing[(int) $row['ban_id']] = true;
		}
		$db->sql_freeresult($result);

		$now = time();
		foreach ($data['removed'] as $id => $row)
		{
			if (!isset($existing[(int) $id]) && ((int) $row['ban_end'] === 0 || (int) $row['ban_end'] >= $now))
			{
				$db->sql_query('INSERT INTO ' . BANLIST_TABLE . ' ' . $db->sql_build_array('INSERT', $row));
			}
		}
	}

	$cache->destroy('sql', BANLIST_TABLE);

	return true;
}

/**
* Warnings.
*/
function im3_mod_undo_warning($warning_id, $user_row, $post_id, $points)
{
	if (!$warning_id || !im3_mod_undo_user_tracked())
	{
		return;
	}

	im3_mod_undo_store('warning', 0, 0, $post_id, $user_row['username'], array(
		'warning_id'	=> (int) $warning_id,
		'user_id'		=> (int) $user_row['user_id'],
		'points'		=> (float) $points,
	));
}

function im3_mod_undo_restore_warning($data, &$error)
{
	global $db;

	$sql = 'SELECT warning_id
		FROM ' . WARNINGS_TABLE . '
		WHERE warning_id = ' . (int) $data['warning_id'];
	$result = $db->sql_query($sql);
	$found = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	// Warning already expired or deleted: nothing to undo but the points
	if ($found)
	{
		$db->sql_query('DELETE FROM ' . WARNINGS_TABLE . ' WHERE warning_id = ' . (int) $data['warning_id']);
		$db->sql_query('UPDATE ' . USERS_TABLE . '
			SET user_warnings = user_warnings - 1
			WHERE user_id = ' . (int) $data['user_id'] . '
				AND user_warnings > 0');
	}

	if (!empty($data['points']) && function_exists('add_points'))
	{
		add_points((int) $data['user_id'], $data['points']);
	}

	return true;
}
