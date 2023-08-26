<?php

/**
*
* @mod package		Download Mod 6
* @file				dl_stats.php 12 2012/10/15 OXPUS
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
* check permissions and redirect if missing
*/
$stats_view = dl_auth::stats_perm();
if (!$stats_view)
{
	redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
}

if (sizeof($index))
{
	$access_cats = array();
	$access_cats = dl_main::full_index(0, 0, 0, 1);

	if (sizeof($access_cats))
	{
		/*
		* enable/disable guest data on basic statistics
		*/
		$sql_where = ($config['dl_guest_stats_show'] == 1) ? '' : ' AND u.user_id <> ' . ANONYMOUS;

		/*
		* latest downloads
		*/
		$sql = 'SELECT d.*, u.username, u.user_colour, c.cat_name FROM ' . DOWNLOADS_TABLE . ' d, ' . DL_CAT_TABLE . ' c, ' . USERS_TABLE . ' u
			WHERE d.cat = c.id
				AND d.down_user = u.user_id
				AND ' . $db->sql_in_set('c.id', $access_cats) . "
				$sql_where
			ORDER BY d.last_time DESC";
		$result = $db->sql_query_limit($sql, 10);
		$total_top_ten = $db->sql_affectedrows($result);

		if ($total_top_ten)
		{
			$template->assign_var('S_LATEST_DOWNLOADS', true);

			$dl_pos = 1;

			while ($row = $db->sql_fetchrow($result))
			{
				$file_id		= $row['id'];
				$cat_id			= $row['cat'];
				$file_name_name	= $row['file_name'];
				$description	= $row['description'];
				$cat_name		= $row['cat_name'];

				$dl_time		= $row['last_time'];
				$dl_time		= $user->format_date($dl_time);

				$file_link		= append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$file_id");

				$user_link		= get_username_string('full', $row['down_user'], $row['username'], $row['user_colour']);

				$template->assign_block_vars('top_ten_latest', array(
					'POS'			=> $dl_pos,
					'DESCRIPTION'	=> $description,
					'U_FILE_LINK'	=> $file_link,
					'CAT_NAME'		=> $cat_name,
					'USER_LINK'		=> $user_link,
					'DL_TIME'		=> $dl_time)
				);

				$dl_pos++;
			}
			$db->sql_freeresult($result);
		}

		/*
		* lastest uploads
		*/
		$sql = 'SELECT d.*, u.username, u.user_colour, c.cat_name FROM ' . DOWNLOADS_TABLE . ' d, ' . DL_CAT_TABLE . ' c, ' . USERS_TABLE . ' u
			WHERE d.cat = c.id
				AND d.add_user = u.user_id
				AND approve = ' . true . '
				AND ' . $db->sql_in_set('c.id', $access_cats) . '
			ORDER BY d.add_time DESC';
		$result = $db->sql_query_limit($sql, 10);
		$total_top_ten = $db->sql_affectedrows($result);

		if ($total_top_ten)
		{
			$template->assign_var('S_LATEST_UPLOADS', true);

			$dl_pos = 1;

			while ($row = $db->sql_fetchrow($result))
			{
				$file_id		= $row['id'];
				$cat_id			= $row['cat'];
				$file_name_name	= $row['file_name'];
				$description	= $row['description'];
				$cat_name		= $row['cat_name'];

				$dl_time		= $row['add_time'];
				$dl_time		= $user->format_date($dl_time);

				$file_link		= append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$file_id");

				$user_link		= get_username_string('full', $row['add_user'], $row['username'], $row['user_colour']);

				$template->assign_block_vars('top_ten_uploads', array(
					'POS'			=> $dl_pos,
					'DESCRIPTION'	=> $description,
					'U_FILE_LINK'	=> $file_link,
					'CAT_NAME'		=> $cat_name,
					'USER_LINK'		=> $user_link,
					'DL_TIME'		=> $dl_time)
				);

				$dl_pos++;
			}
			$db->sql_freeresult($result);
		}

		/*
		* top ten downloads this month
		*/
		$sql = 'SELECT d.*, c.cat_name FROM ' . DOWNLOADS_TABLE . ' d, ' . DL_CAT_TABLE . ' c
			WHERE d.cat = c.id
				AND ' . $db->sql_in_set('c.id', $access_cats) . '
			ORDER BY d.klicks DESC';
		$result = $db->sql_query_limit($sql, 10);
		$total_top_ten = $db->sql_affectedrows($result);

		if ($total_top_ten)
		{
			$template->assign_var('S_TOP10_DOWN_MONTH', true);

			$dl_pos = 1;

			while ($row = $db->sql_fetchrow($result))
			{
				$file_id		= $row['id'];
				$cat_id			= $row['cat'];
				$file_name_name	= $row['file_name'];
				$description	= $row['description'];
				$cat_name		= $row['cat_name'];
				$dl_klicks		= $row['klicks'];

				$file_link		= append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$file_id");

				$template->assign_block_vars('top_ten_dl_cur_month', array(
					'POS'			=> $dl_pos,
					'DESCRIPTION'	=> $description,
					'U_FILE_LINK'	=> $file_link,
					'CAT_NAME'		=> $cat_name,
					'DL_KLICKS'		=> $dl_klicks)
				);

				$dl_pos++;
			}
			$db->sql_freeresult($result);
		}

		/*
		* top ten downloads overall
		*/
		$sql = 'SELECT d.*, c.cat_name FROM ' . DOWNLOADS_TABLE . ' d, ' . DL_CAT_TABLE . ' c
			WHERE d.cat = c.id
				AND ' . $db->sql_in_set('c.id', $access_cats) . '
			ORDER BY d.overall_klicks DESC';
		$result = $db->sql_query_limit($sql, 10);
		$total_top_ten = $db->sql_affectedrows($result);

		if ($total_top_ten)
		{
			$template->assign_var('S_TOP10_DOWN_ALL', true);

			$dl_pos = 1;

			while ($row = $db->sql_fetchrow($result))
			{
				$file_id		= $row['id'];
				$cat_id			= $row['cat'];
				$file_name_name	= $row['file_name'];
				$description	= $row['description'];
				$cat_name		= $row['cat_name'];
				$dl_klicks		= $row['overall_klicks'];

				$file_link		= append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$file_id");

				$template->assign_block_vars('top_ten_dl_overall', array(
					'POS'			=> $dl_pos,
					'DESCRIPTION'	=> $description,
					'U_FILE_LINK'	=> $file_link,
					'CAT_NAME'		=> $cat_name,
					'DL_KLICKS'		=> $dl_klicks)
				);

				$dl_pos++;
			}
			$db->sql_freeresult($result);
		}

		if (!$config['dl_traffic_off'])
		{
			/*
			* top ten traffic this month
			*/
			$sql = 'SELECT (d.klicks * d.file_size) AS month_traffic, d.*, c.cat_name FROM ' . DOWNLOADS_TABLE . ' d, ' . DL_CAT_TABLE . ' c
				WHERE d.cat = c.id
					AND ' . $db->sql_in_set('c.id', $access_cats) . '
				ORDER BY month_traffic DESC';
			$result = $db->sql_query_limit($sql, 10);
			$total_top_ten = $db->sql_affectedrows($result);

			if ($total_top_ten)
			{
				$template->assign_var('S_TOP10_TRAFFIC_MONTH', true);

				$dl_pos = 1;

				while ($row = $db->sql_fetchrow($result))
				{
					$file_id		= $row['id'];
					$cat_id			= $row['cat'];
					$file_name_name	= $row['file_name'];
					$description	= $row['description'];
					$cat_name		= $row['cat_name'];
					$dl_traffic		= dl_format::dl_size($row['month_traffic']);

					$file_link		= append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$file_id");

					$template->assign_block_vars('top_ten_traffic_cur_month', array(
						'POS'			=> $dl_pos,
						'DESCRIPTION'	=> $description,
						'U_FILE_LINK'	=> $file_link,
						'CAT_NAME'		=> $cat_name,
						'DL_TRAFFIC'	=> $dl_traffic,)
					);

					$dl_pos++;
				}
				$db->sql_freeresult($result);
			}

			/*
			* top ten traffic overall
			*/
			$sql = 'SELECT (d.overall_klicks * d.file_size) AS overall_traffic, d.*, c.cat_name FROM ' . DOWNLOADS_TABLE . ' d, ' . DL_CAT_TABLE . ' c
				WHERE d.cat = c.id
					AND ' . $db->sql_in_set('c.id', $access_cats) . '
				ORDER BY overall_traffic DESC';
			$result = $db->sql_query_limit($sql, 10);
			$total_top_ten = $db->sql_affectedrows($result);

			if ($total_top_ten)
			{
				$template->assign_var('S_TOP10_TRAFFIC_ALL', true);

				$dl_pos = 1;

				while ($row = $db->sql_fetchrow($result))
				{
					$file_id		= $row['id'];
					$cat_id			= $row['cat'];
					$file_name_name	= $row['file_name'];
					$description	= $row['description'];
					$cat_name		= $row['cat_name'];
					$dl_traffic		= dl_format::dl_size($row['overall_traffic']);

					$file_link		= append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$file_id");

					$template->assign_block_vars('top_ten_traffic_overall', array(
						'POS'			=> $dl_pos,
						'DESCRIPTION'	=> $description,
						'U_FILE_LINK'	=> $file_link,
						'CAT_NAME'		=> $cat_name,
						'DL_TRAFFIC'	=> $dl_traffic)
					);

					$dl_pos++;
				}
				$db->sql_freeresult($result);
			}
		}

		/*
		* enable/disable guest data on extended statistics
		*/
		$sql_where = ($config['dl_guest_stats_show'] == 1) ? '' : ' AND s.user_id <> ' . ANONYMOUS;

		/*
		* top ten download counts
		*/
		unset($sql_array);

		$sql = 'SELECT COUNT(s.id) AS dl_counts, s.user_id, s.username, u.user_colour
			FROM ' . DL_STATS_TABLE . ' s
			LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = s.user_id
			WHERE s.direction = 0
				AND ' . $db->sql_in_set('s.cat_id', $access_cats) . "
				$sql_where
			GROUP BY s.user_id, s.username, u.user_colour
			ORDER BY dl_counts DESC";
		$result = $db->sql_query_limit($sql, 10);

		$total_top_ten = $db->sql_affectedrows($result);

		if ($total_top_ten)
		{
			$template->assign_var('S_TOP10_DOWN_CLICKS', true);

			$dl_pos = 1;

			while ($row = $db->sql_fetchrow($result))
			{
				$user_link		= get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);

				$template->assign_block_vars('top_ten_dl_counts', array(
					'POS'			=> $dl_pos,
					'USER_LINK'		=> $user_link,
					'DL_COUNTS'		=> $row['dl_counts'])
				);

				$dl_pos++;
			}
			$db->sql_freeresult($result);
		}

		if (!$config['dl_traffic_off'])
		{
			/*
			* top ten download traffic
			*/
			unset($sql_array);

			$sql = 'SELECT SUM(s.traffic) AS dl_traffic, s.user_id, s.username, u.user_colour
				FROM ' . DL_STATS_TABLE . ' s
				LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = s.user_id
				WHERE s.direction = 0
					AND ' . $db->sql_in_set('s.cat_id', $access_cats) . "
					$sql_where
				GROUP BY s.user_id, s.username, u.user_colour
				ORDER BY dl_traffic DESC";
			$result = $db->sql_query_limit($sql, 10);
			$total_top_ten = $db->sql_affectedrows($result);

			if ($total_top_ten)
			{
				$template->assign_var('S_TOP10_DOWN_TRAFFIC', true);

				$dl_pos = 1;

				while ($row = $db->sql_fetchrow($result))
				{
					$user_link		= get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);

					$dl_traffic	= dl_format::dl_size($row['dl_traffic']);

					$template->assign_block_vars('top_ten_dl_traffic', array(
						'POS'			=> $dl_pos,
						'USER_LINK'		=> $user_link,
						'DL_TRAFFIC'	=> $dl_traffic)
					);

					$dl_pos++;
				}
				$db->sql_freeresult($result);
			}
		}

		/*
		* top ten upload counts
		*/
		unset($sql_array);

		$sql = 'SELECT COUNT(s.id) AS dl_counts, s.user_id, s.username, u.user_colour
			FROM ' . DL_STATS_TABLE . ' s
			LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = s.user_id
			WHERE s.direction = 1
				AND ' . $db->sql_in_set('s.cat_id', $access_cats) . "
				$sql_where
			GROUP BY s.user_id, s.username, u.user_colour
			ORDER BY dl_counts DESC";
		$result = $db->sql_query_limit($sql, 10);
		$total_top_ten = $db->sql_affectedrows($result);

		if ($total_top_ten)
		{
			$template->assign_var('S_TOP10_UP_COUNT', true);

			$dl_pos = 1;

			while ($row = $db->sql_fetchrow($result))
			{
				$user_link		= get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);

				$template->assign_block_vars('top_ten_up_counts', array(
					'POS'			=> $dl_pos,
					'USER_LINK'	=> $user_link,
					'DL_COUNTS'		=> $row['dl_counts'])
				);

				$dl_pos++;
			}
			$db->sql_freeresult($result);
		}

		if (!$config['dl_traffic_off'])
		{
			/*
			* top ten upload traffic
			*/
			unset($sql_array);

			$sql = 'SELECT SUM(s.traffic) AS dl_traffic, s.user_id, s.username, u.user_colour
				FROM ' . DL_STATS_TABLE . ' s
				LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = s.user_id
				WHERE s.direction = 1
					AND ' . $db->sql_in_set('s.cat_id', $access_cats) . "
					$sql_where
				GROUP BY s.user_id, s.username, u.user_colour
				ORDER BY dl_traffic DESC";
			$result = $db->sql_query_limit($sql, 10);
			$total_top_ten = $db->sql_affectedrows($result);

			if ($total_top_ten)
			{
				$template->assign_var('S_TOP10_UP_TRAFFIC', true);

				$dl_pos = 1;

				while ($row = $db->sql_fetchrow($result))
				{
					$user_link		= get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);

					$dl_traffic	= dl_format::dl_size($row['dl_traffic']);

					$template->assign_block_vars('top_ten_up_traffic', array(
						'POS'			=> $dl_pos,
						'USER_LINK'	=> $user_link,
						'DL_TRAFFIC'	=> $dl_traffic)
					);

					$dl_pos++;
				}
				$db->sql_freeresult($result);
			}
		}
	}
	else
	{
		redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
	}
}
else
{
	redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
}

$template->set_filenames(array(
	'body' => 'dl_mod/dl_stat_body.html')
);

?>