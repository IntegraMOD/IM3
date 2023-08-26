<?php

/**
*
* @mod package		Download Mod 6
* @file				dl_load.php 6 2012/08/05 OXPUS
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
* check for hotlinking
*/
$hotlink_disabled = false;
$sql_where = '';

if ($config['dl_prevent_hotlink'])
{
	$hotlink_id = request_var('hotlink_id', '');

	if (!$hotlink_id)
	{
		$hotlink_disabled = true;
	}
	else
	{
		if (!$user->data['is_registered'])
		{
			$sql_where = " AND session_id = '" . $db->sql_escape($user->data['session_id']) . "' ";
		}

		$sql = 'SELECT COUNT(hotlink_id) AS total FROM ' . DL_HOTLINK_TABLE . '
			WHERE user_id = ' . (int) $user->data['user_id'] . "
				AND hotlink_id = '" . $db->sql_escape($hotlink_id) . "'
				$sql_where";
		$result = $db->sql_query($sql);
		$total_hotlinks = $db->sql_fetchfield('total');
		$db->sql_freeresult($result);

		if ($total_hotlinks <> 1)
		{
			$hotlink_disabled = true;
		}
	}

	if ($hotlink_disabled)
	{
		if ($config['dl_hotlink_action'])
		{
			redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&df_id=$df_id"));
		}
		else
		{
			trigger_error('DL_HOTLINK_PERMISSION');
		}
	}
}

/*
* THE basic function to get the download!
*/
$dl_file = array();
$dl_file = dl_files::all_files(0, '', 'ASC', '', $df_id, $modcp, '*');

$cat_id = ($modcp) ? $cat_id : $dl_file['cat'];

if ($modcp && $cat_id)
{
	$cat_auth = array();
	$cat_auth = dl_auth::dl_cat_auth($cat_id);

	if (!$auth->acl_get('a_') && !$cat_auth['auth_mod'])
	{
		$modcp = 0;
	}
}
else
{
	$modcp = 0;
}

/*
* check the permissions
*/
$check_status = array();
$check_status = dl_status::status($df_id);
$status = $check_status['auth_dl'];
$cat_auth = array();
$cat_auth = dl_auth::dl_cat_auth($cat_id);

if ($modcp)
{
	$check_status['auth_dl'] = true;
}

$browser = dl_init::dl_client($user->data['session_browser']);

// Prepare the captcha permissions for the current user
$captcha_active = false;
$user_is_guest = false;
$user_is_mod = false;
$user_is_admin = false;
$user_is_founder = false;

if (!$user->data['is_registered'])
{
	$user_is_guest = true;
}
else
{
	if (($cat_auth['auth_mod'] || ($auth->acl_get('a_') && $user->data['is_registered'])) && !dl_auth::user_banned())
	{
		$user_is_mod = true;
	}

	if ($auth->acl_get('a_'))
	{
		$user_is_admin = true;
	}

	if ($user->data['user_type'] == USER_FOUNDER)
	{
		$user_is_founder = true;
	}
}

switch ($config['dl_download_vc'])
{
	case 1:
		if ($user_is_guest)
		{
			$captcha_active = true;
		}
	break;

	case 2:
		if (!$user_is_mod && !$user_is_admin && !$user_is_founder)
		{
			$captcha_active = true;
		}
	break;

	case 3:
		if ($user_is_mod && !$user_is_admin && !$user_is_founder)
		{
			$captcha_active = true;
		}
	break;

	case 4:
		if ($user_is_mod && $user_is_admin && !$user_is_founder)
		{
			$captcha_active = true;
		}
	break;

	case 5:
		$captcha_active = true;
	break;
}

if ($captcha_active)
{
	if (!$user->data['is_registered'])
	{
		$sql_where = " AND session_id = '" . $db->sql_escape($user->data['session_id']) . "' ";
	}

	$sql = 'SELECT code FROM ' . DL_HOTLINK_TABLE . '
		WHERE user_id = ' . (int) $user->data['user_id'] . "
			AND hotlink_id = 'dlvc'
			$sql_where";
	$result = $db->sql_query($sql);
	$row_code = $db->sql_fetchfield('code');
	$db->sql_freeresult($result);

	if ($row_code != $code)
	{
		redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&df_id=$df_id"));
	}
}

if ($check_status['auth_dl'] && $dl_file['id'])
{
	/*
	* fix the mod and admin auth if needed
	*/
	if (!$dl_file['approve'])
	{
		if ((($cat_auth['auth_mod'] || $index[$cat_id]['auth_mod']) && !$auth->acl_get('a_')) || ($auth->acl_get('a_') && $user->data['is_registered']))
		{
			$status = true;
		}
	}

	if (!$config['dl_traffic_off'])
	{
		if (FOUNDER_TRAFFICS_OFF == true)
		{
			$status = true;
		}
		else if ($user->data['is_registered'] && DL_OVERALL_TRAFFICS == true)
		{
			if (($config['dl_overall_traffic'] - $config['dl_remain_traffic']) < $dl_file['file_size'])
			{
				$status = false;
			}
		}
		else if (!$user->data['is_registered'] && DL_GUESTS_TRAFFICS == true)
		{
			if (($config['dl_overall_guest_traffic'] - $config['dl_remain_guest_traffic']) < $dl_file['file_size'])
			{
				$status = false;
			}
		}
	}

	/*
	* Antispam-Modul
	*
	* Block downloads for users who must have at least the given number of posts to download a file
	* and tries to download after spamming in the forum more than the needed number of posts in the last 24 hours
	*/
	if ($user->data['user_posts'] >= $config['dl_posts'] && !$dl_file['extern'] && !$dl_file['free'] && $config['dl_antispam_posts'] && $config['dl_antispam_hours'])
	{
		$sql = 'SELECT COUNT(post_id) AS total_posts FROM ' . POSTS_TABLE . '
			WHERE poster_id = ' . (int) $user->data['user_id'] . '
				AND post_time >= ' . (time() - ((int) $config['dl_antispam_hours'] * 3600));
		$result = $db->sql_query($sql);
		$post_count = $db->sql_fetchfield('total_posts');
		$db->sql_freeresult($result);

		if ($post_count >= $config['dl_antispam_posts'])
		{
			$status = false;
		}
	}

	// Prepare correct file for download
	if ($file_version)
	{
		$sql = 'SELECT ver_file_name, ver_real_file, ver_file_size FROM ' . DL_VERSIONS_TABLE . '
			WHERE ver_id = ' . (int) $file_version;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$dl_file_name = $row['ver_file_name'];
		$dl_real_file = $row['ver_real_file'];
		$dl_file_size = $row['ver_file_size'];
		$db->sql_freeresult($result);

		if (!$dl_file_name)
		{
			trigger_error('DL_NO_ACCESS');
		}
		else
		{
			if ($dl_file['extern'])
			{
				$dl_file['file_name'] = $dl_file_name;
			}
			else
			{
				$dl_file['file_name'] = $dl_file_name;
				$dl_file['real_file'] = $dl_real_file;
				$dl_file['file_size'] = $dl_file_size;
			}
		}
	}

	/*
	* update all statistics
	*/
	if ($status)
	{
		$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
			'klicks'			=> $dl_file['klicks'] + 1,
			'overall_klicks'	=> $dl_file['overall_klicks'] + 1,
			'last_time'			=> time(),
			'down_user'			=> $user->data['user_id'])) . ' WHERE id = ' . (int) $df_id;
		$db->sql_query($sql);

		if ($user->data['is_registered'] && !$dl_file['free'] && !$dl_file['extern'] && !$config['dl_traffic_off'] && DL_USERS_TRAFFICS == true)
		{
			$count_user_traffic = true;

			if ($config['dl_user_traffic_once'])
			{
				$sql = 'SELECT COUNT(dl_id) AS total FROM ' . DL_NOTRAF_TABLE . '
					WHERE user_id = ' . (int) $user->data['user_id'] . '
						AND dl_id = ' . (int) $dl_file['id'];
				$result = $db->sql_query($sql);
				$still_count = $db->sql_fetchfield('total');
				$db->sql_freeresult($result);

				if ($still_count)
				{
					$count_user_traffic = false;
				}
			}

			if ($count_user_traffic && FOUNDER_TRAFFICS_OFF == false)
			{
				$user->data['user_traffic'] -= $dl_file['file_size'];

				$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'user_traffic' => $user->data['user_traffic'])) . ' WHERE user_id = ' . (int) $user->data['user_id'];
				$db->sql_query($sql);

				if ($config['dl_user_traffic_once'])
				{
					$sql = 'INSERT INTO ' . DL_NOTRAF_TABLE . ' ' . $db->sql_build_array('INSERT', array(
						'user_id'	=> $user->data['user_id'],
						'dl_id'		=> $dl_file['id']));
					$db->sql_query($sql);
				}
			}
		}

		if ($user->data['is_registered'])
		{
			$load_limit = DL_OVERALL_TRAFFICS;
			$remain_traffic = 'dl_remain_traffic';
		}
		else
		{
			$load_limit = DL_GUESTS_TRAFFICS;
			$remain_traffic = 'dl_remain_guest_traffic';
		}

		if (!$dl_file['extern'] && !$config['dl_traffic_off'] && FOUNDER_TRAFFICS_OFF == false)
		{
			if ($load_limit == true)
			{
				$new_remain = $config[$remain_traffic] + $dl_file['file_size'];

				$sql = 'UPDATE ' . DL_REM_TRAF_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'config_value' => $new_remain)) . " WHERE config_name = '" . $db->sql_escape($remain_traffic) . "'";
				$db->sql_query($sql);
			}

			$cat_traffic = $index[$cat_id]['cat_traffic'];

			if ($cat_traffic)
			{
				$sql = 'SELECT cat_traffic_use FROM ' . DL_CAT_TRAF_TABLE . '
					WHERE cat_id = ' . (int) $cat_id;
				$result = $db->sql_query($sql);
				$cat_traffic_use = $db->sql_fetchfield('cat_traffic_use');
				$db->sql_freeresult($result);

				if (($cat_traffic - $cat_traffic_use) < $dl_file['file_size'])
				{
					$status = false;
				}
				else
				{
					$cat_traffic_use += $dl_file['file_size'];
	
					$sql = 'UPDATE ' . DL_CAT_TRAF_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
						'cat_traffic_use' => $cat_traffic_use)) . ' WHERE cat_id = ' . (int) $cat_id;
					$db->sql_query($sql);
				}
			}
		}

		if ($index[$cat_id]['statistics'] && $status)
		{
			if ($index[$cat_id]['stats_prune'])
			{
				$stat_prune = dl_main::dl_prune_stats($cat_id, $index[$cat_id]['stats_prune']);
			}

			$sql = 'INSERT INTO ' . DL_STATS_TABLE . ' ' . $db->sql_build_array('INSERT', array(
				'cat_id'		=> $cat_id,
				'id'			=> $df_id,
				'user_id'		=> $user->data['user_id'],
				'username'		=> $user->data['username'],
				'traffic'		=> $dl_file['file_size'],
				'direction'		=> 0,
				'user_ip'		=> $user->data['session_ip'],
				'browser'		=> $browser,
				'time_stamp'	=> time()));
			$db->sql_query($sql);
		}
	}

	/*
	* now it is time and we are ready to rumble: send the file to the user client to download it there!
	*/
	if ($dl_file['extern'])
	{
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".str_replace('&amp;', '&', $dl_file['file_name']));
	}
	else if ($status)
	{
	 	$dl_file_url = $phpbb_root_path . $config['dl_download_dir'] . $index[$cat_id]['cat_path'] . $dl_file['real_file'];

		$dl_file_size = sprintf("%u", @filesize($dl_file_url));

		$mem_limit = ini_get('memory_limit');

		$last = strlen($mem_limit) - 1;
		$max_mem_limit = (int) $mem_limit;

		switch($mem_limit{$last})
		{
			case 'G':
				$max_mem_limit *= 1024;
			case 'M':
				$max_mem_limit *= 1024;
			case 'K':
				$max_mem_limit *= 1024;
		}

		if ($dl_file_size > $max_mem_limit || $config['dl_method'] == 3)
		{
			header("Content-Disposition: attachment; filename=" . $dl_file['file_name']);
			header("Content-Type: application/octet-stream");
			header("Content-Description: File Transfer");
			header("Content-Length: " . $dl_file_size);
			header("Cache-Control: ");
			header("Pragma: ");
			header("Connection: close");

			$fp = fopen($dl_file_url, "rb");
			while (!feof($fp))
			{
			    echo fread($fp, 4096);
			}
			fclose($fp);
		}
		else
		{
			if ($config['dl_method'] == 1)
			{
				header("Content-Type: application/octet-stream");
				header("Content-Disposition: attachment; filename=\"" . $dl_file['file_name'] . "\"");
				readfile($dl_file_url);
			}
			else if ($config['dl_method'] == 2)
			{
				$size = sprintf("%u", @filesize($dl_file_url));

				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Content-Type: application/octet-stream");
				header("Content-Length: ".$size);
				header("Content-Transfer-Encoding: binary");
				header("Content-Disposition: attachment; filename=\"" . $dl_file['file_name'] . "\"");

				if ($size > $config['dl_method_quota'])
				{
					dl_physical::readfile_chunked($dl_file_url);
				}
				else
				{
					readfile($dl_file_url);
				}
			}
		}
	}
	else
	{
		trigger_error('DL_NO_ACCESS');
	}
}
else
{
	trigger_error('DL_NO_ACCESS');
}

exit;

?>