<?php
/**
 *
 * @package IntegraMOD
 * @copyright (c) 2026 IntegraMOD Team
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();

header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('X-Content-Type-Options: nosniff');

if (!$user->data['is_registered'] || $user->data['is_bot'])
{
	echo json_encode(array());
	exit;
}

$forum_id = request_var('f', 0);
if (empty($config['allow_mentions']) || !$forum_id || !$auth->acl_get('f_read', $forum_id))
{
	echo json_encode(array());
	exit;
}

$sql = 'SELECT forum_id FROM ' . FORUMS_TABLE . '
	WHERE forum_id = ' . (int) $forum_id;
$result = $db->sql_query_limit($sql, 1);
$forum_row = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
if (!$forum_row)
{
	echo json_encode(array());
	exit;
}

$query = utf8_clean_string(utf8_normalize_nfc(request_var('q', '', true)));
$query = substr($query, 0, 32);
if (utf8_strlen($query) < 1)
{
	echo json_encode(array());
	exit;
}

$sql = 'SELECT username
	FROM ' . USERS_TABLE . "
	WHERE username_clean " . $db->sql_like_expression($query . $db->any_char) . '
		AND user_type IN (' . USER_NORMAL . ', ' . USER_FOUNDER . ')
	ORDER BY username_clean ASC';
$result = $db->sql_query_limit($sql, 5);

$names = array();
while ($row = $db->sql_fetchrow($result))
{
	$names[] = $row['username'];
}
$db->sql_freeresult($result);

echo json_encode($names);
exit;
