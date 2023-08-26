<?php

/**
*
* @mod package		Download Mod 6
* @file				dl_rss.php 5 2012/04/16 OXPUS
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

// disable the feed until it is enabled and contains at least one entry
$display_feed = false;

if ($config['dl_rss_enable'])
{
	// Switch user to anonymous to prepare the correct permissions, if wanted
	if (!$config['dl_rss_perms'])
	{
		$perm_backup = array('user_backup' => $user->data);

		// sql to get the users info
		$sql = 'SELECT *
			FROM ' . USERS_TABLE . '
			WHERE user_id = ' . ANONYMOUS;
		$result	= $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		// reset the current users info to that of the bot
		$user->data = array_merge($user->data, $row);
		$user->data['user_permissions'] = '';
		$user->data['session_user_id'] = ANONYMOUS;
		$user->data['session_admin'] = 0;
		$user->data['is_registered'] = false;
		$user->data['user_perm_from'] = ANONYMOUS;

		unset($row);
	}

	/*
	* include and create the main class
	*/
	include($phpbb_root_path . 'dl_mod/classes/class_dlmod.' . $phpEx);
	$dl_mod = new dl_mod($phpbb_root_path, $phpEx);
	$dl_mod->register();
	dl_init::init();

	// Get the possible categories
	$access_cats = array();
	$access_cats = dl_main::full_index(0, 0, 0, 1);

	// Does we have some cats? miau ...
	if (sizeof($access_cats))
	{
		$sql_where_cats = ' AND ' . $db->sql_in_set('cat', $access_cats);

		$rss_cats_ary = array_map('intval', explode(',', $config['dl_rss_cats_select']));
		
		switch ($config['dl_rss_cats'])
		{
			case 1:
				$sql_where_cats .= ' AND ' . $db->sql_in_set('cat', $rss_cats_ary);
			break;

			case 2:
				$sql_where_cats .= ' AND ' . $db->sql_in_set('cat', $rss_cats_ary, true);
			break;

			default:
				$sql_where_cats .= '';
		}

		$sql_sort_by = ($config['dl_rss_select']) ? 'rand()' : 'change_time';
		$sql_order_by = ($config['dl_rss_select']) ? '' : 'DESC';
		$sql_limit = intval($config['dl_rss_number']);

		if ($config['dl_rss_desc_length'])
		{
			$sql_fields = 'id, cat, description, desc_uid, hack_version, add_time, change_time, long_desc, long_desc_uid';
		}
		else
		{
			$sql_fields = 'id, cat, description, desc_uid, hack_version, add_time, change_time';
		}

		$rss = true;

		$dl_files = array();
		$dl_files = dl_files::all_files(0, $sql_sort_by, $sql_order_by , $sql_where_cats, 0, 0, $sql_fields, $sql_limit);

		if (sizeof($dl_files))
		{
			header("Content-Type: application/rss+xml");

			$template->set_filenames(array(
				'body'	=> 'dl_mod/dl_rss.xml',
			));

			for ($i = 0; $i < sizeof($dl_files); $i++)
			{
				$dl_id			= $dl_files[$i]['id'];
				$dl_cat			= $dl_files[$i]['cat'];
				$hack_version	= $dl_files[$i]['hack_version'];
				$last_time		= date('r', $dl_files[$i]['change_time']);

				if ($i == 0)
				{
					$timetmp	= $last_time;
				}

				$description	= $dl_files[$i]['description'];
				$desc_uid		= $dl_files[$i]['desc_uid'];
				$description	= censor_text($description);
				strip_bbcode($description, $desc_uid);
				$description	.= ' ' . $hack_version;

				if ($config['dl_rss_desc_length'])
				{
					$long_desc			= $dl_files[$i]['long_desc'];
					$long_desc_uid		= $dl_files[$i]['long_desc_uid'];

					if ($config['dl_rss_desc_length'] == 2)
					{
						if (intval($config['dl_rss_desc_shorten']) && strlen($long_desc) > intval($config['dl_rss_desc_shorten']))
						{
							$long_desc = substr($long_desc, 0, intval($config['dl_rss_desc_shorten'])) . ' [...]';
						}
						else
						{
							$long_desc = '';
						}
					}

					if ($long_desc)
					{
						$long_desc = censor_text($long_desc);
						strip_bbcode($long_desc, $long_desc_uid);
					}
				}
				else
				{
					$long_desc = '';
				}

				if ($config['dl_rss_new_update'])
				{
					$mini_status = dl_status::mini_status_file($dl_cat, $dl_id, $rss);
				}
				else
				{
					$mini_status = '';
				}

				$template->assign_block_vars('dl_rss_feed', array(
					'DL_RSS_TITLE'	=> $description,
					'DL_RSS_MINI_S'	=> $mini_status,
					'DL_RSS_DESC'	=> $long_desc,
					'DL_RSS_TIME'	=> $last_time,

					'U_DL_RSS'		=> generate_board_url() . "/downloads.$phpEx?view=detail&amp;df_id=$dl_id",
				));
			}

			$display_feed = true;
		}
	}

	// Restore the user data to the original one to finish the feed here correctly
	if (!$config['dl_rss_perms'])
	{
		$user->data = $perm_backup['user_backup'];
		unset($perm_backup);
	}
}

if (!$config['dl_rss_enable'] || !$display_feed)
{
	switch ($config['dl_rss_off_action'])
	{
		case 0:
			redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
		break;

		case 1:
			redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
		break;

		default:
			trigger_error($config['dl_rss_off_text']);
	}
}

$template->assign_vars(array(
	'SITENAME'				=> $config['sitename'],
	'BOARD_URL'				=> generate_board_url() . '/',
	'BOARD_SIG'				=> $config['board_email'],
	'DL_RSS_TIME_TMP'   	=> $timetmp,
	'SITE_DESCRIPTION'		=> $config['site_desc'],

	'S_CONTENT_ENCODING'	=> 'UTF-8',

	'U_DL_RSS'				=> generate_board_url() . "/downloads.$phpEx?view=rss",
));

page_footer();

?>