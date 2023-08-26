<?php

/**
*
* @mod package		Download Mod 6
* @file				dl_admin_traffic.php 15 2012/07/31 OXPUS
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

if ($submit)
{
	if (!check_form_key('dl_adm_traffic'))
	{
		trigger_error('FORM_INVALID', E_USER_WARNING);
	}

	switch($action)
	{
		case 'single':

			switch ($x)
			{
				case 'B':
					$traffic_bytes = $user_traffic;
					break;
				case 'KB':
					$traffic_bytes = floor($user_traffic * 1024);
					break;
				case 'MB':
					$traffic_bytes = floor($user_traffic * 1048576);
					break;
				case 'GB':
					$traffic_bytes = floor($user_traffic * 1073741824);
					break;
				default:
					$traffic_bytes = 0;
			}

			if ($traffic_bytes)
			{
				$username = utf8_clean_string($username);

				$sql = 'SELECT user_traffic, user_id FROM ' . USERS_TABLE . "
					WHERE username_clean = '" . $db->sql_escape($username) . "'";
				$result			= $db->sql_query($sql);
				$row			= $db->sql_fetchrow($result);
				$user_id		= $row['user_id'];
				$user_traffic	= $row['user_traffic'];
				$db->sql_freeresult($result);

				if (!$user_id)
				{
					trigger_error($user->lang['USERNAME'] . ' ' . $username . '<br /><br />' . $user->lang['NO_USER'] . adm_back_link($this->u_action));
				}

				if ($func == 'add')
				{
					$user_traffic += $traffic_bytes;

					add_log('admin', 'DL_LOG_USER_TR_ADD', $username, $user_traffic, $x);
				}
				else
				{
					$user_traffic = $traffic_bytes;

					add_log('admin', 'DL_LOG_USER_TR_SET', $username, $user_traffic, $x);
				}

				$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'user_traffic' => $user_traffic)) . ' WHERE user_id = ' . (int) $user_id;
				$db->sql_query($sql);

				$message = $user->lang['DL_USER_AUTO_TRAFFIC_USER'] . '<br /><br />' . sprintf($user->lang['CLICK_RETURN_USER_TRAFFIC_ADMIN'], '<a href="' . $basic_link . '">', '</a>') . adm_back_link($this->u_action);

				trigger_error($message);
			}

			break;

		case 'all':

			switch ($y)
			{
				case 'B':
					$traffic_bytes = $all_traffic;
					break;
				case 'KB':
					$traffic_bytes = floor($all_traffic * 1024);
					break;
				case 'MB':
					$traffic_bytes = floor($all_traffic * 1048576);
					break;
				case 'GB':
					$traffic_bytes = floor($all_traffic * 1073741824);
					break;
				default:
					$traffic_bytes = 0;
			}

			if ($traffic_bytes)
			{
				if ($func == 'add')
				{
					$sql = 'SELECT user_id, user_traffic FROM ' . USERS_TABLE . '
						WHERE user_id <> ' . ANONYMOUS;
					$result = $db->sql_query($sql);

					while ($row = $db->sql_fetchrow($result))
					{
						$user_id = $row['user_id'];
						$user_traffic = $row['user_traffic'] + $traffic_bytes;

						$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
							'user_traffic' => $user_traffic)) . ' WHERE user_id = ' . (int) $user_id;
						$db->sql_query($sql);
					}

					$db->sql_freeresult($result);

					add_log('admin', 'DL_LOG_ALL_TR_ADD', $all_traffic, $y);
				}
				if ($func == 'set')
				{
					$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
						'user_traffic' => $traffic_bytes)) . ' WHERE user_id <> ' . ANONYMOUS;
					$db->sql_query($sql);

					add_log('admin', 'DL_LOG_ALL_TR_SET', $all_traffic, $y);
				}

				$message = $user->lang['DL_USER_AUTO_TRAFFIC_USER'] . '<br /><br />' . sprintf($user->lang['CLICK_RETURN_USER_TRAFFIC_ADMIN'], '<a href="' . $basic_link . '">', '</a>') . adm_back_link($this->u_action);

				trigger_error($message);
			}

			break;

		case 'group':

			switch ($z)
			{
				case 'B':
					$traffic_bytes = $group_traffic;
					break;
				case 'KB':
					$traffic_bytes = floor($group_traffic * 1024);
					break;
				case 'MB':
					$traffic_bytes = floor($group_traffic * 1048576);
					break;
				case 'GB':
					$traffic_bytes = floor($group_traffic * 1073741824);
					break;
				default:
					$traffic_bytes = 0;
			}

			if ($traffic_bytes)
			{
				$sql = 'SELECT group_type, group_name FROM ' . GROUPS_TABLE . '
					WHERE group_id = ' . (int) $group_id;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];

				$sql = 'SELECT u.user_traffic, u.user_id FROM ' . USER_GROUP_TABLE . ' ug, ' . USERS_TABLE . ' u
					WHERE ug.user_id = u.user_id
						AND ug.user_pending <> ' . true . '
						AND ug.group_id = ' . (int) $group_id;
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					$user_id		= $row['user_id'];
					$user_traffic	= $row['user_traffic'];

					if ($func == 'add')
					{
						$user_traffic += $traffic_bytes;
					}
					else
					{
						$user_traffic = $traffic_bytes;
					}

					$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
						'user_traffic' => $user_traffic)) . ' WHERE user_id = ' . (int) $user_id;
					$db->sql_query($sql);
				}

				$db->sql_freeresult($result);

				if ($func == 'add')
				{
					add_log('admin', 'DL_LOG_GRP_TR_ADD', $group_name, $group_traffic, $z);
				}
				else
				{
					add_log('admin', 'DL_LOG_GRP_TR_SET', $group_name, $group_traffic, $z);
				}

				$message = $user->lang['DL_USER_AUTO_TRAFFIC_USER'] . '<br /><br />' . sprintf($user->lang['CLICK_RETURN_USERGROUP_TRAFFIC_ADMIN'], '<a href="' . $basic_link . '">', '</a>') . adm_back_link($this->u_action);

				trigger_error($message);
			}

			break;

		case 'auto':

			$sql = 'SELECT group_type, group_name, group_id FROM ' . GROUPS_TABLE . '
				ORDER BY group_name';
			$result = $db->sql_query($sql);

			while($row = $db->sql_fetchrow($result))
			{
				$group_id	= $row['group_id'];
				$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];

				$group_dl_auto_traffic	= (isset($_POST['group_dl_auto_traffic'])) ? $_POST['group_dl_auto_traffic'] : array();
				$data_group_range		= (isset($_POST['data_group_range'])) ? $_POST['data_group_range'] : array();

				if ($data_group_range[$group_id] == 'B')
				{
					$traffic = $group_dl_auto_traffic[$group_id];
				}
				else if ($data_group_range[$group_id] == 'KB')
				{
					$traffic = floor($group_dl_auto_traffic[$group_id] * 1024);
				}
				else if ($data_group_range[$group_id] == 'MB')
				{
					$traffic = floor($group_dl_auto_traffic[$group_id] * 1048576);
				}
				else if ($data_group_range[$group_id] == 'GB')
				{
					$traffic = floor($group_dl_auto_traffic[$group_id] * 1073741824);
				}
				else
				{
					$traffic = 0;
				}

				$sql = 'UPDATE ' . GROUPS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'group_dl_auto_traffic' => $traffic)) . ' WHERE group_id = ' . (int) $group_id;
				$db->sql_query($sql);

				add_log('admin', 'DL_LOG_AUTO_TR_GRP', $group_name, $group_dl_auto_traffic[$group_id], $data_group_range[$group_id]);
			}

			$user_dl_auto_traffic	= request_var('user_dl_auto_traffic', 0);
			$data_user_range		= request_var('data_user_range', '');

			if ($data_user_range == 'B')
			{
				$traffic = $user_dl_auto_traffic;
			}
			else if ($data_user_range == 'KB')
			{
				$traffic = floor($user_dl_auto_traffic * 1024);
			}
			else if ($data_user_range == 'MB')
			{
				$traffic = floor($user_dl_auto_traffic * 1048576);
			}
			else if ($data_user_range == 'GB')
			{
				$traffic = floor($user_dl_auto_traffic * 1073741824);
			}
			else
			{
				$traffic = 0;
			}

			set_config('dl_user_dl_auto_traffic', $traffic, false);

			add_log('admin', 'DL_LOG_AUTO_TR_USER', $user_dl_auto_traffic, $data_user_range);

			$message = $user->lang['DL_USER_AUTO_TRAFFIC_USER'] . '<br /><br />' . sprintf($user->lang['CLICK_RETURN_USERGROUP_TRAFFIC_ADMIN'], '<a href="' . $basic_link . '">', '</a>') . adm_back_link($this->u_action);

			trigger_error($message);

			break;
	}
}

$template->set_filenames(array(
	'traffic' => 'dl_mod/dl_traffic_body.html')
);

add_form_key('dl_adm_traffic');

$s_select_datasize = '<option value="B">' . $user->lang['DL_BYTES_LONG'] . '</option>';
$s_select_datasize .= '<option value="KB">' . $user->lang['DL_KB'] . '</option>';
$s_select_datasize .= '<option value="MB">' . $user->lang['DL_MB'] . '</option>';
$s_select_datasize .= '<option value="GB">' . $user->lang['DL_GB'] . '</option>';
$s_select_datasize .= '</select>';

$sql = 'SELECT group_id, group_name, group_dl_auto_traffic, group_type FROM ' . GROUPS_TABLE . '
	ORDER BY group_name';
$result = $db->sql_query($sql);
$total_groups = $db->sql_affectedrows($result);

if ($total_groups)
{
	$template->assign_var('S_GROUP_BLOCK', true);

	$s_select_list = '<select name="g">';

	while ($row = $db->sql_fetchrow($result))
	{
		$group_dl_auto_traffic = ($row['group_dl_auto_traffic']) ? $row['group_dl_auto_traffic'] : 0;
		$data_range_select = 'B';

		if ($group_dl_auto_traffic > 1073741823)
		{
			$group_traffic = number_format($group_dl_auto_traffic / 1073741824, 2);
			$data_range_select = 'GB';
		}
		if ($group_dl_auto_traffic < 1073741824)
		{
			$group_traffic = number_format($group_dl_auto_traffic / 1048576, 2);
			$data_range_select = 'MB';
		}
		if ($group_dl_auto_traffic < 1048576)
		{
			$group_traffic = number_format($group_dl_auto_traffic / 1024, 2);
			$data_range_select = 'KB';
		}
		if ($group_dl_auto_traffic < 1024)
		{
			$group_traffic = number_format($group_dl_auto_traffic, 2);
			$data_range_select = 'B';
		}

		$s_group_data_range = str_replace('value="' . $data_range_select . '">', 'value="' . $data_range_select . '" selected="selected">', $s_select_datasize);
		$s_group_data_range = '<select name="data_group_range[' . $row['group_id'] . ']">' . $s_group_data_range;

		$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];

		$template->assign_block_vars('group_row',array(
			'GROUP_ID'				=> $row['group_id'],
			'GROUP_NAME'			=> $group_name,
			'GROUP_DL_AUTO_TRAFFIC'	=> $group_traffic,

			'S_GROUP_DATA_RANGE'	=> $s_group_data_range)
		);

		$s_select_list .= '<option value="' . $row['group_id'] . '">' . $group_name . '</option>';
	}

	$s_select_list .= '</select>';
}
$db->sql_freeresult($result);

$user_dl_auto_traffic = $config['dl_user_dl_auto_traffic'];

if ($user_dl_auto_traffic > 1073741823)
{
	$user_traffic = number_format($user_dl_auto_traffic / 1073741824, 2);
	$data_range_select = 'GB';
}
if ($user_dl_auto_traffic < 1073741824)
{
	$user_traffic = number_format($user_dl_auto_traffic / 1048576, 2);
	$data_range_select = 'MB';
}
if ($user_dl_auto_traffic < 1048576)
{
	$user_traffic = number_format($user_dl_auto_traffic / 1024, 2);
	$data_range_select = 'KB';
}
if ($user_dl_auto_traffic < 1024)
{
	$user_traffic = $user_dl_auto_traffic;
	$data_range_select = 'B';
}

$s_user_data_range	= str_replace('value="' . $data_range_select . '">', 'value="' . $data_range_select . '" selected="selected">', $s_select_datasize);
$s_user_range		= str_replace('value="KB">', 'value="KB" selected="selected">', $s_select_datasize);

$s_user_data_range		= '<select name="data_user_range">' . $s_user_data_range;
$s_user_single_range	= '<select name="x">' . $s_user_range;
$s_user_all_range		= '<select name="y">' . $s_user_range;
$s_user_group_range		= '<select name="z">' . $s_user_range;

$template->assign_vars(array(
	'USER_DL_AUTO_TRAFFIC'		=> $user_traffic,

	'S_GROUP_SELECT'			=> $s_select_list,
	'S_USER_DATA_RANGE'			=> $s_user_data_range,
	'S_USER_SINGLE_RANGE'		=> $s_user_single_range,
	'S_USER_ALL_RANGE'			=> $s_user_all_range,
	'S_USER_GROUP_RANGE'		=> $s_user_group_range,

	'S_PROFILE_ACTION_ALL'		=> "{$basic_link}&amp;action=all",
	'S_PROFILE_ACTION_USER'		=> "{$basic_link}&amp;action=single",
	'S_PROFILE_ACTION_GROUP'	=> "{$basic_link}&amp;action=group",
	'S_CONFIG_ACTION'			=> "{$basic_link}&amp;action=auto")
);

$acl_cat_names = array(
	0 => $user->lang['DL_ACP_TRAF_AUTO'],
	1 => $user->lang['DL_ACP_TRAF_ALL'],
	2 => $user->lang['DL_ACP_TRAF_USER'],
	3 => $user->lang['DL_ACP_TRAF_GRP'],
);

for ($i = 0; $i < sizeof($acl_cat_names); $i++)
{
	$template->assign_block_vars('category', array('CAT_NAME' => $acl_cat_names[$i]));
}

$template->assign_var('S_DL_TRAFFIC', true);

$template->assign_display('traffic');

?>