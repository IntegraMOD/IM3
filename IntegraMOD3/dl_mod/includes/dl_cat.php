<?php
/**
*
* @mod package		Download Mod 6
* @file				dl_cat.php 9 2014/10/08 OXPUS
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

$view = 'view';

if (!$cat)
{
	$template->set_filenames(array(
		'body' => 'dl_mod/view_dl_cat_body.html')
	);

	if ($user->data['user_dl_sub_on_index'])
	{
		$template->assign_var('S_SUB_ON_INDEX', true);
	}
}
else
{
	$cat_auth = array();
	$cat_auth = dl_auth::dl_cat_auth($cat);
	$index_auth = array();
	$index_auth = dl_main::full_index($cat);

	if (!$cat_auth['auth_view'] && !$index_auth[$cat]['auth_view'] && !$auth->acl_get('a_'))
	{
		redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
	}

	$template->set_filenames(array(
		'body' => 'dl_mod/downloads_body.html')
	);

	$ratings = array();
	if ($config['dl_enable_rate'])
	{
		$sql = "SELECT dl_id, user_id FROM " . DL_RATING_TABLE;
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$ratings[$row['dl_id']][] = $row['user_id'];
		}
		$db->sql_freeresult($result);
	}
}

$path_dl_array = array();

page_header($user->lang['DOWNLOADS']);

$user_id = $user->data['user_id'];
$username = $user->data['username'];
$user_traffic = $user->data['user_traffic'];

$sql = 'SELECT c.parent, d.cat, d.id, d.change_time, d.description, d.change_user, u.user_id, u.user_colour, u.username
	FROM ' . DOWNLOADS_TABLE . ' d, ' . USERS_TABLE . ' u, ' . DL_CAT_TABLE . ' c
	WHERE d.change_user = u.user_id
		AND d.approve = ' . true . '
		AND d.cat = c.id
	ORDER BY cat, change_time DESC, id DESC';
$result = $db->sql_query($sql);

$last_dl = array();
$last_id = 0;

while ($row = $db->sql_fetchrow($result))
{
	if ($row['cat'] != $last_id)
	{
		$last_id = $row['cat'];
		$last_dl[$last_id]['change_time'] = $row['change_time'];
		$last_dl[$last_id]['parent'] = $row['parent'];
		$last_dl[$last_id]['desc'] = $row['description'];
		$last_dl[$last_id]['user'] = get_username_string('no_profile', $row['user_id'], $row['username'], $row['user_colour']);
		$last_dl[$last_id]['time'] = $user->format_date($row['change_time']);
		$last_dl[$last_id]['link'] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=" . $row['id']);
		$last_dl[$last_id]['user_link'] = append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" . $row['change_user']);
	}
}
$db->sql_freeresult($result);

if (sizeof($index) > 0)
{
	foreach(array_keys($index) as $cat_id)
	{
		$parent_id = (isset($index[$cat_id]['parent'])) ? $index[$cat_id]['parent'] : 0;
		$cat_name = (isset($index[$cat_id]['cat_name'])) ? $index[$cat_id]['cat_name'] : '';
		$cat_desc = (isset($index[$cat_id]['description'])) ? $index[$cat_id]['description'] : '';
		$cat_view = (isset($index[$cat_id]['nav_path'])) ? $index[$cat_id]['nav_path'] : '';
		$cat_uid = (isset($index[$cat_id]['desc_uid'])) ? $index[$cat_id]['desc_uid'] : '';
		$cat_bitfield = (isset($index[$cat_id]['desc_bitfield'])) ? $index[$cat_id]['desc_bitfield'] : '';
		$cat_flags = (isset($index[$cat_id]['desc_flags'])) ? $index[$cat_id]['desc_flags'] : '';
		$cat_sublevel = (isset($index[$cat_id]['sublevel'])) ? $index[$cat_id]['sublevel'] : '';
		$cat_icon = $index[$cat_id]['cat_icon'];

		if ($cat_desc)
		{
			$cat_desc = censor_text($cat_desc);
			$cat_desc = generate_text_for_display($cat_desc, $cat_uid, $cat_bitfield, $cat_flags);
		}

		$mini_icon = array();
		$mini_icon = dl_status::mini_status_cat($cat_id, $cat_id);

		if ($mini_icon[$cat_id]['new'] && !$mini_icon[$cat_id]['edit'])
		{
			$mini_cat_icon = $user->img('dl_new');
		}
		else if (!$mini_icon[$cat_id]['new'] && $mini_icon[$cat_id]['edit'])
		{
			$mini_cat_icon = $user->img('dl_edit');
		}
		else if ($mini_icon[$cat_id]['new'] && $mini_icon[$cat_id]['edit'])
		{
			$mini_cat_icon = $user->img('dl_new_edit');
		}
		else
		{
			$mini_cat_icon = $user->img('dl_default');
		}

		$temp_config_pages = $config['posts_per_page'];
		$config['posts_per_page'] = $config['dl_links_per_page'];
		$cat_pages = (isset($index[$cat_id]['total'])) ? topic_generate_pagination($index[$cat_id]['total'] - 1, append_sid("{$phpbb_root_path}downloads.$phpEx", "cat=$cat_id")) : '';
		$config['posts_per_page'] = $temp_config_pages;

		$last_dl_time = dl_main::find_latest_dl($last_dl, $cat_id, $cat_id, array());
		$last_cat_id = (isset($last_dl_time['cat_id'])) ? $last_dl_time['cat_id'] : 0;

		if (isset($last_dl[$cat_id]['change_time']) && isset($last_dl_time['change_time']))
		{
			if ($last_dl[$cat_id]['change_time'] > $last_dl_time['change_time'])
			{
				$last_cat_id = $cat_id;
			}
		}

		if ($cat)
		{
			$template->set_filenames(array(
				'subcats' => 'dl_mod/view_dl_subcat_body.html')
			);

			$block = 'subcats';

			$template->assign_var('S_SUBCATS', true);
		}
		else
		{
			$block = 'downloads';
		}

		$template->assign_block_vars($block, array(
			'MINI_IMG' => $mini_cat_icon,
			'SUBLEVEL' => $cat_sublevel,
			'CAT_DESC' => $cat_desc,
			'CAT_NAME' => $cat_name,
			'CAT_ICON' => $cat_icon,
			'CAT_PAGES' => $cat_pages,
			'CAT_DL' => ((isset($index[$cat_id]['total'])) ? $index[$cat_id]['total'] : 0) + dl_main::get_sublevel_count($cat_id),
			'CAT_LAST_DL' => (isset($last_dl[$last_cat_id]['desc'])) ? $last_dl[$last_cat_id]['desc'] : '',
			'CAT_LAST_USER' => (isset($last_dl[$last_cat_id]['user'])) ? $last_dl[$last_cat_id]['user'] : '',
			'CAT_LAST_TIME' => (isset($last_dl[$last_cat_id]['time'])) ? $last_dl[$last_cat_id]['time'] : '',
			'U_CAT_VIEW' => $cat_view,
			'U_CAT_LAST_LINK' => (isset($last_dl[$last_cat_id]['link'])) ? $last_dl[$last_cat_id]['link'] : '',
			'U_CAT_LAST_USER' => (isset($last_dl[$last_cat_id]['user_link'])) ? $last_dl[$last_cat_id]['user_link'] : '')
		);

		$cat_subs = (isset($cat_sublevel['cat_path'])) ? $cat_sublevel['cat_path'] : '';

		if ($cat_subs)
		{
			$template->assign_block_vars($block.'.sub', array());

			for ($j = 0; $j < sizeof($cat_subs); $j++)
			{
				$sub_id = $cat_sublevel['cat_id'][$j];
				$mini_icon = array();
				$mini_icon = dl_status::mini_status_cat($sub_id, $sub_id);

				if ($mini_icon[$sub_id]['new'] && !$mini_icon[$sub_id]['edit'])
				{
					$mini_cat_icon = $user->img('dl_new');
				}
				else if (!$mini_icon[$sub_id]['new'] && $mini_icon[$sub_id]['edit'])
				{
					$mini_cat_icon = $user->img('dl_edit');
				}
				else if ($mini_icon[$sub_id]['new'] && $mini_icon[$sub_id]['edit'])
				{
					$mini_cat_icon = $user->img('dl_new_edit');
				}
				else
				{
					$mini_cat_icon = $user->img('dl_default');
				}

				if (isset($cat_sublevel['description'][$j]) && $cat_sublevel['description'][$j] != '')
				{
					$subcat_desc = censor_text($cat_sublevel['description'][$j]);
					$subcat_desc = generate_text_for_display($subcat_desc, $cat_sublevel['desc_uid'][$j], $cat_sublevel['desc_bitfield'][$j], $cat_sublevel['desc_flags'][$j]);
				}
				else
				{
					$subcat_desc = '';
				}

				$template->assign_block_vars($block.'.sub.sublevel_row', array(
					'L_SUBLEVEL' => $cat_sublevel['cat_name'][$j],
					'SUBLEVEL_COUNT' => $cat_sublevel['total'][$j] + dl_main::get_sublevel_count($cat_sublevel['cat_id'][$j]),
					'SUBLEVEL_DESC' => $subcat_desc,
					'M_SUBLEVEL' => $mini_cat_icon,
					'M_SUBLEVEL_ICON' => $cat_sublevel['cat_icon'][$j],
					'U_SUBLEVEL' => $cat_sublevel['cat_path'][$j])
				);
			}
		}

		if ($cat)
		{
			$template->assign_var('S_SUBCAT_BOX', true);

			$template->assign_display('subcats');
		}
	}
}
else
{
	$template->assign_var('S_NO_CATEGORY', true);
}

if ($cat)
{
	$index_cat = array();
	$index_cat = dl_main::full_index($cat);
	$total_downloads = (isset($index_cat[$cat]['total'])) ? $index_cat[$cat]['total'] : 0;

	if ($total_downloads)
	{
		$pagination = generate_pagination(append_sid("{$phpbb_root_path}downloads.$phpEx", "cat=$cat&amp;sort_by=$sort_by&amp;order=$order"), $total_downloads, $config['dl_links_per_page'], $start, true). '&nbsp;';

		$template->assign_vars(array(
			'PAGINATION' => $pagination,
			'PAGE_NUMBER' => ($total_downloads > $config['dl_links_per_page']) ? on_page($total_downloads, $config['dl_links_per_page'], $start) : '')
		);
	}

	if (isset($index_cat[$cat]['rules']) && $index_cat[$cat]['rules'] != '')
	{
		$cat_rule = $index_cat[$cat]['rules'];
		$cat_rule_uid = (isset($index_cat[$cat]['rule_uid'])) ? $index_cat[$cat]['rule_uid'] : '';
		$cat_rule_bitfield = (isset($index_cat[$cat]['rule_bitfield'])) ? $index_cat[$cat]['rule_bitfield'] : '';
		$cat_rule_flags = (isset($index_cat[$cat]['rule_flags'])) ? $index_cat[$cat]['rule_flags'] : '';
		$cat_rule = censor_text($cat_rule);
		$cat_rule = generate_text_for_display($cat_rule, $cat_rule_uid, $cat_rule_bitfield, $cat_rule_flags);

		$template->assign_var('S_CAT_RULE', true);
	}

	if (dl_auth::user_auth($cat, 'auth_mod'))
	{
		$template->assign_var('S_MODCP', true);
	}

	$physical_size = dl_physical::read_dl_sizes($phpbb_root_path . $config['dl_download_dir']);
	if ($physical_size < $config['dl_physical_quota'] && (!$config['dl_stop_uploads']) || ($auth->acl_get('a_') && $user->data['is_registered']))
	{
		if (dl_auth::user_auth($cat, 'auth_up'))
		{
			$template->assign_var('S_DL_UPLOAD', true);
		}
	}

	$cat_traffic = 0;

	if (!$config['dl_traffic_off'])
	{
		if ($user->data['is_registered'])
		{
			$cat_overall_traffic = $config['dl_overall_traffic'];
			$cat_limit = DL_OVERALL_TRAFFICS;
		}
		else
		{
			$cat_overall_traffic = $config['dl_overall_guest_traffic'];
			$cat_limit = DL_GUESTS_TRAFFICS;
		}

		if (isset($index_cat[$cat]['cat_traffic_use']))
		{
			$cat_traffic = $index_cat[$cat]['cat_traffic'] - $index_cat[$cat]['cat_traffic_use'];
		}
		else
		{
			$cat_traffic = 0;
		}

		if ($index_cat[$cat]['cat_traffic'] && $cat_traffic > 0)
		{
			$cat_traffic = ($cat_traffic > $cat_overall_traffic && $cat_limit == true) ? $cat_overall_traffic : $cat_traffic;
			$cat_traffic = dl_format::dl_size($cat_traffic);

			$template->assign_var('S_CAT_TRAFFIC', true);
		}
	}
	else
	{
		unset($cat_traffic);
	}
}

$i = 0;

if ($cat && $total_downloads)
{
	$dl_files = array();
	$dl_files = dl_files::files($cat, $sql_sort_by, $sql_order, $start, $config['dl_links_per_page'], 'id, description, desc_uid, desc_bitfield, desc_flags, hack_version, extern, file_size, klicks, overall_klicks, rating, long_desc, long_desc_uid, long_desc_bitfield, long_desc_flags, add_user');

	if (dl_auth::cat_auth_comment_read($cat))
	{
		$sql = 'SELECT COUNT(dl_id) AS total_comments, id FROM ' . DL_COMMENTS_TABLE . '
			WHERE cat_id = ' . (int) $cat . '
				AND approve = ' . true . '
			GROUP BY id';
		$result = $db->sql_query($sql);

		$comment_count = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$comment_count[$row['id']] = $row['total_comments'];
		}
		$db->sql_freeresult($result);
	}

	for ($i = 0; $i < sizeof($dl_files); $i++)
	{
		$file_id = $dl_files[$i]['id'];
		$mini_file_icon = dl_status::mini_status_file($cat, $file_id);

		$description = $dl_files[$i]['description'];
		$file_url = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=" . $file_id);

		$hack_version = '&nbsp;'.$dl_files[$i]['hack_version'];

		$long_desc_uid = $dl_files[$i]['long_desc_uid'];
		$long_desc_bitfield = $dl_files[$i]['long_desc_bitfield'];
		$long_desc_flags = $dl_files[$i]['long_desc_flags'];

		$desc_uid = $dl_files[$i]['desc_uid'];
		$desc_bitfield = $dl_files[$i]['desc_bitfield'];
		$desc_flags = $dl_files[$i]['desc_flags'];

		$description = censor_text($description);
		$description = generate_text_for_display($description, $desc_uid, $desc_bitfield, $desc_flags);

		$long_desc = $dl_files[$i]['long_desc'];
		$long_desc = censor_text($long_desc);
		$long_desc = generate_text_for_display($long_desc, $long_desc_uid, $long_desc_bitfield, $long_desc_flags);
		if (intval($config['dl_limit_desc_on_index']) && strlen($long_desc) > intval($config['dl_limit_desc_on_index']))
		{
			$long_desc = substr($long_desc, 0, intval($config['dl_limit_desc_on_index'])) . ' [...]';
		}

		$dl_status = array();
		$dl_status = dl_status::status($file_id);
		$status = $dl_status['status'];

		if ($dl_files[$i]['file_size'])
		{
			$file_size = dl_format::dl_size($dl_files[$i]['file_size'], 2);
		}
		else
		{
			$file_size = $user->lang['DL_NOT_AVAILIBLE'];
		}

		$file_klicks = $dl_files[$i]['klicks'];
		$file_overall_klicks = $dl_files[$i]['overall_klicks'];

		$s_rating_perm = false;
		$rating_count_text = '';
		$rating_points = 0;

		if ($cat && $config['dl_enable_rate'])
		{
			$rating_points = $dl_files[$i]['rating'];

			if ((!$rating_points || !@in_array($user->data['user_id'], $ratings[$file_id])) && $user->data['is_registered'])
			{
				$s_rating_perm = true;
			}

			if (isset($ratings[$file_id]))
			{
				$rating_count_text = '&nbsp;[ ' . sizeof($ratings[$file_id]) . ' ]';
			}
			else
			{
				$rating_count_text = '';
			}
		}

		$cat_edit_link = false;

		switch ($config['dl_cat_edit'])
		{
			case 1:
				if (dl_auth::user_admin())
				{
					$cat_edit_link = true;
				}
			break;
			case 2:
				if (dl_auth::user_admin() || dl_auth::user_auth($cat, 'auth_mod'))
				{
					$cat_edit_link = true;
				}
			break;
			case 3:
				if (dl_auth::user_admin() || dl_auth::user_auth($cat, 'auth_mod') || ($config['dl_edit_own_downloads'] && $dl_files[$i]['add_user'] == $user->data['user_id']))
				{
					$cat_edit_link = true;
				}
			break;
			default:
				$cat_edit_link = false;
		}

		$template->assign_block_vars('downloads', array(
			'DESCRIPTION'			=> $description,
			'MINI_IMG'				=> $mini_file_icon,
			'HACK_VERSION'			=> $hack_version,
			'LONG_DESC'				=> $long_desc,
			'RATING_IMG'			=> dl_format::rating_img($rating_points, $s_rating_perm, $file_id),
			'RATINGS'				=> $rating_count_text,
			'STATUS'				=> $status,
			'FILE_SIZE'				=> $file_size,
			'FILE_KLICKS'			=> $file_klicks,
			'FILE_OVERALL_KLICKS'	=> $file_overall_klicks,
			'DF_ID'					=> $file_id,
			'U_DIRECT_EDIT'			=> ($cat_edit_link) ? append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=edit&amp;cat_id=$cat&amp;df_id=$file_id") : '',
			'U_FILE'				=> $file_url)
		);

		if ($index_cat[$cat]['comments'] && dl_auth::cat_auth_comment_read($cat))
		{
			if (isset($comment_count[$file_id]))
			{
				$template->assign_block_vars('downloads.comments', array(
					'BREAK' => (dl_auth::cat_auth_comment_post($cat)) ? '<br />' : '',
					'U_COMMENT_POST' => (dl_auth::cat_auth_comment_post($cat)) ? append_sid("{$phpbb_root_path}downloads.$phpEx", "view=comment&amp;action=post&amp;cat_id=$cat&amp;df_id=$file_id") : '',
					'U_COMMENT_SHOW' => append_sid("{$phpbb_root_path}downloads.$phpEx", "view=comment&amp;action=view&amp;cat_id=$cat&amp;df_id=$file_id"))
				);
			}
			else if (dl_auth::cat_auth_comment_post($cat))
			{
				$template->assign_block_vars('downloads.comments', array(
					'U_COMMENT_POST' => append_sid("{$phpbb_root_path}downloads.$phpEx", "view=comment&amp;action=post&amp;cat_id=$cat&amp;df_id=$file_id"))
				);
			}
			else
			{
				$template->assign_block_vars('downloads.comments', array());
			}
		}
	}
}

if ($i)
{
	$template->assign_var('S_DOWNLOAD_ROWS', true);

	if ($index_cat[$cat]['comments'] && dl_auth::cat_auth_comment_read($cat))
	{
		$sql = 'SELECT COUNT(dl_id) AS total_comments, id FROM ' . DL_COMMENTS_TABLE . '
			WHERE cat_id = ' . (int) $cat . '
				AND approve = ' . true . '
			GROUP BY id';
		$result = $db->sql_query($sql);

		$comment_count = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$comment_count[$row['id']] = $row['total_comments'];
		}
		$db->sql_freeresult($result);

		$template->assign_block_vars('comment_header', array());
	}
}

if ($cat && !$total_downloads)
{
	$template->assign_var('S_EMPTY_CATEGORY', true);
}

$template->assign_vars(array(
	'CAT_RULE'		=> (isset($cat_rule)) ? $cat_rule : '',
	'CAT_TRAFFIC'	=> (isset($cat_traffic)) ? sprintf($user->lang['DL_CAT_TRAFFIC_MAIN'], $cat_traffic) : '',
	'DL_MODCP'		=> (isset($total_downloads) && $total_downloads <> 0 && dl_auth::user_auth($cat, 'auth_mod')) ? sprintf($user->lang['DL_MODCP_MOD_AUTH'], '<a href="'.append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;cat_id=$cat").'">', '</a>') : '',
	'T_DL_CAT'		=> (isset($index[$cat]['cat_name']) && $cat) ? $index[$cat]['cat_name'] : $user->lang['DL_CAT_NAME'],
	'DL_UPLOAD'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=upload&amp;cat_id=$cat"),
	'PHPEX'			=> $phpEx,

	'S_ENABLE_RATE'	=> (isset($config['dl_enable_rate']) && $config['dl_enable_rate']) ? true : false,

	'U_DOWNLOADS'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", (($cat) ? 'cat=' . $cat : '')),
	'U_DL_SEARCH'	=> (sizeof($index) || $cat) ? append_sid("{$phpbb_root_path}downloads.$phpEx", "view=search") : '',
));

?>