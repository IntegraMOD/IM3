<?php

/**
*
* @mod package		Download Mod 6
* @file				class_dl_nav.php 1 2012/03/20 OXPUS
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

class dl_nav extends dl_mod
{
	public function __construct()
	{
		return;
	}

	public function __destruct()
	{
		return;
	}

	public static function nav($parent, $disp_art, &$tmp_nav)
	{
		static $dl_index, $dl_auth, $user_admin;

		global $config, $path_dl_array;
		global $dl_index, $dl_auth, $user_admin;

		if (!is_array($dl_index) || !sizeof($dl_index))
		{
			return;
		}

		$cat_id = (isset($dl_index[$parent]['id'])) ? $dl_index[$parent]['id'] : 0;

		if ($cat_id == 0)
		{
			return;;
		}

		$temp_url = append_sid(dl_init::phpbb_root_path() . "downloads" . dl_init::phpEx(), "cat=$cat_id");
		$temp_title = $dl_index[$parent]['cat_name_nav'];

		if (((isset($dl_index[$cat_id]['auth_view']) && $dl_index[$cat_id]['auth_view']) || (isset($dl_auth[$cat_id]['auth_view']) && $dl_auth[$cat_id]['auth_view']) || $user_admin) && $disp_art == 'url')
		{
			$tmp_nav['link'][] = $temp_url;
			$tmp_nav['name'][] = $temp_title;
		}
		if (((isset($dl_index[$cat_id]['auth_view']) && $dl_index[$cat_id]['auth_view']) || (isset($dl_auth[$cat_id]['auth_view']) && $dl_auth[$cat_id]['auth_view']) || $user_admin) && $disp_art == 'links')
		{
			$path_dl_array[] = '&nbsp;»&nbsp;<a href="' . $temp_url . '">' . $temp_title . '</a>';
		}
		else
		{
			$path_dl_array[] = '&nbsp;<strong>&#8249;</strong>&nbsp;' . $temp_title;
		}

		if (isset($dl_index[$parent]['parent']) && $dl_index[$parent]['parent'] != 0)
		{
			self::nav($dl_index[$parent]['parent'], $disp_art, $tmp_nav);
		}

		$path_dl = '';

		if ($disp_art != 'url')
		{
			for ($i = sizeof($path_dl_array); $i >= 0 ; $i--)
			{
				$path_dl .= (isset($path_dl_array[$i])) ? $path_dl_array[$i] : '';
			}
		}

		return ($disp_art == 'url') ? $tmp_nav : $path_dl;
	}
}

?>