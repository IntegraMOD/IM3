<?php

/**
*
* @mod package		Download Mod 6
* @file				class_dl_status.php 6 2013/05/23 OXPUS
* @copyright		(c) 2005 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class dl_status extends dl_mod
{
	public function __construct()
	{
		return;
	}

	public function __destruct()
	{
		return;
	}

	public static function mini_status_file($parent, $file_id, $rss = false)
	{
		static $dl_file_icon;

		global $user, $dl_file_icon;

		if (isset($dl_file_icon['new'][$parent][$file_id]) && $dl_file_icon['new'][$parent][$file_id] == true)
		{
			$mini_icon_img = ($rss) ? $user->lang['DL_FILE_NEW'] : $user->img('dl_file_new');
		}
		else if (isset($dl_file_icon['edit'][$parent][$file_id]) && $dl_file_icon['edit'][$parent][$file_id] == true)
		{
			$mini_icon_img = ($rss) ? $user->lang['DL_FILE_EDIT'] : $user->img('dl_file_edit');
		}
		else
		{
			$mini_icon_img = '';
		}

		return $mini_icon_img;
	}

	public static function mini_status_cat($cur, $parent, $flag = 0)
	{
		static $dl_index, $dl_auth, $dl_file_icon;
		global $dl_index, $dl_auth, $dl_file_icon;

		$mini_status_icon[$cur]['new'] = 0;
		$mini_status_icon[$cur]['edit'] = 0;

		if (!is_array($dl_index) || !sizeof($dl_index))
		{
			return array();
		}

		foreach($dl_index as $cat_id => $value)
		{
			if ($cat_id == $parent && !$flag)
			{
				if ((isset($dl_index[$cat_id]['auth_view']) && $dl_index[$cat_id]['auth_view']) || (isset($dl_auth[$cat_id]['auth_view'])))
				{
					if (isset($dl_index[$cat_id]['total']))
					{
						$new_sum = (isset($dl_file_icon['new_sum'][$cat_id])) ? intval($dl_file_icon['new_sum'][$cat_id]) : 0;
						$edit_sum = (isset($dl_file_icon['edit_sum'][$cat_id])) ? intval($dl_file_icon['edit_sum'][$cat_id]) : 0;

						$mini_status_icon[$cur]['new'] += $new_sum;
						$mini_status_icon[$cur]['edit'] += $edit_sum;
					}
				}

				$mini_icon = self::mini_status_cat($cur, $cat_id, 1);
				$mini_status_icon[$cur]['new'] += $mini_icon[$cur]['new'];
				$mini_status_icon[$cur]['edit'] += $mini_icon[$cur]['edit'];
			}

			if ((isset($dl_index[$cat_id]['parent']) && $dl_index[$cat_id]['parent'] == $parent) && $flag)
			{
				if ((isset($dl_index[$cat_id]['auth_view']) && $dl_index[$cat_id]['auth_view']) || (isset($dl_auth[$cat_id]['auth_view'])))
				{
					if (isset($dl_index[$cat_id]['total']))
					{
						$new_sum = (isset($dl_file_icon['new_sum'][$cat_id])) ? intval($dl_file_icon['new_sum'][$cat_id]) : 0;
						$edit_sum = (isset($dl_file_icon['edit_sum'][$cat_id])) ? intval($dl_file_icon['edit_sum'][$cat_id]) : 0;

						$mini_status_icon[$cur]['new'] += $new_sum;
						$mini_status_icon[$cur]['edit'] += $edit_sum;
					}
				}

				$mini_icon = self::mini_status_cat($cur, $cat_id, 1);
				$mini_status_icon[$cur]['new'] += $mini_icon[$cur]['new'];
				$mini_status_icon[$cur]['edit'] += $mini_icon[$cur]['edit'];
			}
		}

		return $mini_status_icon;
	}

	public static function status($df_id)
	{
		static $dl_file_p, $user_banned, $user_logged_in, $user_traffic, $user_posts, $user_admin;

		global $user, $config;
		global $dl_file_p, $user_banned, $user_logged_in, $user_traffic, $user_posts, $user_admin;

		$user->lang['DL_RED_EXPLAIN_ALT'] = sprintf($user->lang['DL_RED_EXPLAIN_ALT'], $config['dl_posts']);

		if (!isset($dl_file_p[$df_id]['cat']))
		{
			return array('status' => '', 'file_name' => '', 'auth_dl' => 0, 'file_detail' => '', 'status_detail' => $user->img('dl_red', $user->lang['DL_RED_EXPLAIN_ALT']));
		}

		$cat_id = $dl_file_p[$df_id]['cat'];
		$cat_auth = array();
		$cat_auth = dl_auth::dl_cat_auth($cat_id);
		$index = array();
		$index = dl_main::full_index($cat_id);
		$status = '';
		$status_detail = $user->img('dl_red', $user->lang['DL_RED_EXPLAIN_ALT']);
		$file_name = '';
		$auth_dl = 0;

		$file_name = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $dl_file_p[$df_id]['file_name'] . '</a>';
		$file_detail = $dl_file_p[$df_id]['file_name'];

		if ($user_banned)
		{
			$status_detail = $user->img('dl_banlist', $user->lang['DL_BANNED']);
			$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';
			$auth_dl = 0;
			return array('status' => $status, 'file_name' => $file_detail, 'auth_dl' => $auth_dl, 'file_detail' => $file_detail, 'status_detail' => $status_detail);
		}

		if (!$config['dl_traffic_off'] && (DL_USERS_TRAFFICS == true || FOUNDER_TRAFFICS_OFF == true))
		{
			if (FOUNDER_TRAFFICS_OFF == true)
			{
				$status_detail = $user->img('dl_yellow', $user->lang['DL_YELLOW_EXPLAIN']);
				$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';
				$auth_dl = true;
			}
			else if ($user_logged_in && intval($user_traffic) >= $dl_file_p[$df_id]['file_size'] && !$dl_file_p[$df_id]['extern'])
			{
				$status_detail = $user->img('dl_yellow', $user->lang['DL_YELLOW_EXPLAIN']);
				$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';
				$auth_dl = true;
			}
			else if ($user_logged_in && intval($user_traffic) < $dl_file_p[$df_id]['file_size'] && !$dl_file_p[$df_id]['extern'])
			{
				$status_detail = $user->img('dl_red', $user->lang['DL_RED_EXPLAIN_ALT']);
				$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';
				$auth_dl = 0;
			}
		}
		else
		{
			$status_detail = $user->img('dl_white', $user->lang['DL_WHITE_EXPLAIN']);
			$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';
			$auth_dl = true;
		}

		if ($user_posts < $config['dl_posts'] && !$dl_file_p[$df_id]['extern'] && !$dl_file_p[$df_id]['free'])
		{
			$status_detail = $user->img('dl_red', $user->lang['DL_RED_EXPLAIN_ALT']);
			$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';
			$auth_dl = 0;
		}

		if (!$user_logged_in && !$dl_file_p[$df_id]['extern'] && !$dl_file_p[$df_id]['free'])
		{
			$status_detail = $user->img('dl_red', $user->lang['DL_RED_EXPLAIN_ALT']);
			$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';
			$auth_dl = 0;
		}

		if ($dl_file_p[$df_id]['free'] == 1)
		{
			$status_detail = $user->img('dl_green', $user->lang['DL_GREEN_EXPLAIN']);
			$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';
			$auth_dl = true;
		}

		if ($dl_file_p[$df_id]['free'] == 2)
		{
			if (($config['dl_icon_free_for_reg'] && !$user_logged_in) || (!$config['dl_icon_free_for_reg'] && $user_logged_in))
			{
				$status_detail = $user->img('dl_white', $user->lang['DL_WHITE_EXPLAIN']);
				$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';
			}

			if ($user_logged_in || FOUNDER_TRAFFICS_OFF == true)
			{
				$auth_dl = true;
			}
			else
			{
				$auth_dl = 0;
			}
		}

		if (!$cat_auth['auth_dl'] && !$index[$cat_id]['auth_dl'] && !$user_admin)
		{
			$status_detail = $user->img('dl_red', $user->lang['DL_RED_EXPLAIN_PERM']);
			$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';
			$auth_dl = 0;
		}

		if ($dl_file_p[$df_id]['file_traffic'] && $dl_file_p[$df_id]['klicks'] * $dl_file_p[$df_id]['file_size'] >= $dl_file_p[$df_id]['file_traffic'] && !$config['dl_traffic_off'])
		{
			$status_detail = $user->img('dl_blue', $user->lang['DL_BLUE_EXPLAIN_FILE']);
			$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';

			if (FOUNDER_TRAFFICS_OFF == true)
			{
				$auth_dl = true;
			}
			else
			{
				$auth_dl = 0;
			}
		}

		if ($user->data['is_registered'])
		{
			$load_limit = DL_OVERALL_TRAFFICS;
			$overall_traffic = $config['dl_overall_traffic'];
			$remain_traffic = $config['dl_remain_traffic'];
		}
		else
		{
			$load_limit = DL_GUESTS_TRAFFICS;
			$overall_traffic = $config['dl_overall_guest_traffic'];
			$remain_traffic = $config['dl_remain_guest_traffic'];
		}
		
		if (($overall_traffic - $remain_traffic <= $dl_file_p[$df_id]['file_size']) && !$config['dl_traffic_off'] && $load_limit == true)
		{
			$status_detail = $user->img('dl_blue', $user->lang['DL_BLUE_EXPLAIN']);
			$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';

			if (FOUNDER_TRAFFICS_OFF == true)
			{
				$auth_dl = true;
			}
			else
			{
				$auth_dl = 0;
			}
		}

		if (($index[$cat_id]['cat_traffic'] && ($index[$cat_id]['cat_traffic'] - $index[$cat_id]['cat_traffic_use'] <= 0)) && !$config['dl_traffic_off'])
		{
			$status_detail = $user->img('dl_blue', $user->lang['DL_BLUE_EXPLAIN']);
			$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';

			if (FOUNDER_TRAFFICS_OFF == true)
			{
				$auth_dl = true;
			}
			else
			{
				$auth_dl = 0;
			}
		}

		if ($dl_file_p[$df_id]['extern'])
		{
			$status_detail = $user->img('dl_grey', $user->lang['DL_GREY_EXPLAIN']);
			$status = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $status_detail . '</a>';
			$file_name = '<a href="' . append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "view=detail&amp;df_id=$df_id") . '">' . $user->lang['DL_EXTERN'] . '</a>';
			$auth_dl = true;
		}

		return array('status' => $status, 'file_name' => $file_name, 'auth_dl' => $auth_dl, 'file_detail' => $file_detail, 'status_detail' => $status_detail);
	}
}

?>