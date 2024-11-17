<?php
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!$user->data['is_registered'])
{
	login_box();
}

if ($user->data['user_type'] != USER_FOUNDER)
{
	trigger_error('FOUNDERS_ONLY');
}

require($phpbb_root_path . 'includes/db/db_tools.' . $phpEx);
$db_tools = new phpbb_db_tools($db);

if ( !$db_tools->sql_table_exists($table_prefix . 'sn_users'))
{
	trigger_error('Social Network is not installed on this board');
}

$mode = request_var('mode', '');

switch($mode)
{
	case 'mod_fields':

		$table = request_var('table', '');
		$column = request_var('column', '');
		$uid_column = request_var('uid_column', '');
		$sn_column = request_var('sn_column', '');

		transfer_fields($table, $column, $uid_column, $sn_column);

		break;

	case 'cpf':

		$table = $table_prefix . 'profile_fields_data';
		$column = request_var('column', '');
		$uid_column = 'user_id';
		$sn_column = request_var('sn_column', '');

		transfer_fields($table, $column, $uid_column, $sn_column);

		break;

	case 'simple_comments_mod':

		$sql = 'SELECT comment_poster_id, comment_date, comment_text, bbcode_bitfield, bbcode_uid, comment_to_id
			FROM ' . $table_prefix . 'comment';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$sql = "INSERT INTO " . SN_STATUS_TABLE . " (poster_id, status_time, status_text, bbcode_bitfield, bbcode_uid, wall_id, page_data)
				VALUES (" . $row['comment_poster_id'] . ", " . $row['comment_date'] . ", '" . $row['comment_text'] . "', '" . $row['bbcode_bitfield'] . "', '" . $row['bbcode_uid'] . "', " . $row['comment_to_id'] . ", '')";
			$db->sql_query($sql);

			$last_id = $db->sql_nextid();

			$sql = "INSERT INTO " . SN_ENTRIES_TABLE . " (user_id, entry_target, entry_type, entry_time, entry_additionals)
				VALUES (" . $row['comment_poster_id'] . ", " . $last_id . ", 1, " . $row['comment_date'] . ", 'a:0:{}')";
			$db->sql_query($sql);

			echo '.';
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'FINISHED'	=> true,
		));

		break;

	default:

		$template->assign_vars(array(
			'SELECT_MODE'						=> true,
			'U_MOD_FIELDS'					=> append_sid("{$phpbb_root_path}socialnet/transfer_fields.{$phpEx}", 'mode=mod_fields'),
			'U_CPF'									=> append_sid("{$phpbb_root_path}socialnet/transfer_fields.{$phpEx}", 'mode=cpf'),
			'U_SIMPLE_COMMENTS_MOD'	=> append_sid("{$phpbb_root_path}socialnet/transfer_fields.{$phpEx}", 'mode=simple_comments_mod'),
		));
}

$template->assign_vars(array(
	'U_ACTION'	=> append_sid("{$phpbb_root_path}socialnet/transfer_fields.{$phpEx}", 'mode='.$mode),
));

// Output page
page_header('Transfer fields tool');

$template->set_filenames(array(
	'body'	=> 'socialnet/transfer_fields.html'
));

page_footer();

function select_columns($table)
{
	global $db_tools, $template;

	$columns = $db_tools->sql_list_columns($table);
	asort($columns);

	foreach ($columns as $column_name)
	{
		$template->assign_block_vars('columns', array(
			'COLUMN'	=> $column_name
		));
	}
	unset($columns);
}

function transfer_fields($table, $column, $uid_column, $sn_column)
{
	global $template, $table_prefix, $db;

	if ( empty($table))
	{
		$tables = $db_tools->sql_list_tables();
		asort($tables);

		foreach ($tables as $table_name)
		{
			if (strlen($table_prefix) === 0 || stripos($table_name, $table_prefix) === 0)
			{
				$template->assign_block_vars('tables', array(
					'TABLE'	=> $table_name
				));
			}
		}
		unset($tables);

		$template->assign_vars(array(
			'SELECT_TABLE'	=> true,
		));
	}
	else if ( empty($column))
	{
		select_columns($table);

		$template->assign_vars(array(
			'SELECT_COLUMN'	=> true,
		));
	}
	else if ( empty($uid_column))
	{
		select_columns($table);

		$template->assign_vars(array(
			'SELECT_UID_COLUMN'	=> true,
		));
	}
	else if ( empty($sn_column))
	{
		select_columns($table_prefix . 'sn_users');

		$template->assign_vars(array(
			'SELECT_SN_COLUMN'	=> true,
		));
	}
	else
	{
		$sql = 'SELECT ' . $uid_column . ', ' . $column . '
			FROM ' . $table . '
				WHERE ' . $column . ' <> ""
					AND ' . $column . ' IS NOT NULL';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$sql2 = 'SELECT user_id
				FROM ' . SN_USERS_TABLE . '
					WHERE user_id = ' . $row[$uid_column];
			$db->sql_query($sql2);
			$uid = $db->sql_fetchfield('user_id');

			if ( empty($uid))
			{
				$sql_arr = array(
					'user_id'									=> $row[$uid_column],
					'user_status'							=> '',
					'user_im_sound'						=> 1,
					'user_im_soundname'				=> 'IM_New-message-1.mp3',
					'user_im_online'					=> 1,
					'user_zebra_alert_friend'	=> 1,
					'user_note'								=> '',
					'languages'								=> '',
					'about_me'								=> '',
					'employer'								=> '',
					'university'							=> '',
					'high_school'							=> '',
					'religion'								=> '',
					'political_views'					=> '',
					'quotations'							=> '',
					'music'										=> '',
					'books'										=> '',
					'movies'									=> '',
					'games'										=> '',
					'foods'										=> '',
					'sports'									=> '',
					'sport_teams'							=> '',
					'activities'							=> '',
					'profile_last_change'			=> 0,
					$sn_column								=> $row[$column],
				);

				$sql_insert = "INSERT INTO " . SN_USERS_TABLE . $db->sql_build_array('INSERT', $sql_arr);
				$db->sql_query($sql_insert);

				$sql2 = "INSERT INTO " . SN_FMS_GROUPS_TABLE . " (fms_gid,user_id,fms_name,fms_clean,fms_collapse) VALUES (0, {$row[$uid_column]}, '---', '---',0)";
				$db->sql_query($sql);
			}
			else
			{
				if ( is_string($row[$column]))
				{
					$sql2 = 'UPDATE ' . SN_USERS_TABLE . '
						SET ' . $sn_column . ' = "' . $row[$column] . '"
							WHERE user_id = ' . $row[$uid_column];
					$db->sql_query($sql2);
				}
				else
				{
					$sql2 = 'UPDATE ' . SN_USERS_TABLE . '
						SET ' . $sn_column . ' = ' . $row[$column] . '
							WHERE user_id = ' . $row[$uid_column];
					$db->sql_query($sql2);
				}
			}
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'FINISHED'	=> true,
		));
	}

	$s_hidden_fields = build_hidden_fields(array(
		'table'				=> $table,
		'column'			=> $column,
		'uid_column'	=> $uid_column,
		'sn_column'		=> $sn_column,
	));

	$template->assign_vars(array(
		'TABLE'				=> ($table != '') ? $table : '',
		'COLUMN'			=> ($column != '') ? $column : '',
		'UID_COLUMN'	=> ($uid_column != '') ? $uid_column : '',
		'SN_COLUMN'		=> ($sn_column != '') ? $sn_column : '',
		'TRANSFERING'	=> ($table && $column && $uid_column && $sn_column) ? true : false,
	));
}