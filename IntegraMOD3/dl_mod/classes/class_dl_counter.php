<?php

/**
*
* @mod package		Download Mod 6
* @file				class_dl_counter.php 1 2012/03/20 OXPUS
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

class dl_counter extends dl_mod
{
	public function __construct()
	{
		return;
	}

	public function __destruct()
	{
		return;
	}

	public static function count_dl_approve()
	{
		static $user_logged_in, $user_admin;

		global $db;
		global $user_logged_in, $user_admin;

		if (!$user_logged_in)
		{
			return 0;
		}

		$access_cats = array();
		$access_cats = dl_main::full_index(0, 0, 0, 2);
		if ((!isset($access_cats[0]) || !$access_cats[0] || !sizeof($access_cats)) && !$user_admin)
		{
			return 0;
		}

		$sql_access_cats = ($user_admin) ? '' : ' AND ' . $db->sql_in_set('cat', array_map('intval', $access_cats));

		$sql = 'SELECT COUNT(id) AS total FROM ' . DOWNLOADS_TABLE . "
			WHERE approve = 0
				$sql_access_cats";
		$result = $db->sql_query($sql);
		$total = $db->sql_fetchfield('total');
		$db->sql_freeresult($result);

		return $total;
	}

	public static function count_comments_approve()
	{
		static $user_logged_in, $user_admin;

		global $db;
		global $user_logged_in, $user_admin;

		if (!$user_logged_in)
		{
			return 0;
		}

		$access_cats = array();
		$access_cats = dl_main::full_index(0, 0, 0, 2);
		if ((!isset($access_cats[0]) || !$access_cats[0] || !sizeof($access_cats)) && !$user_admin)
		{
			return 0;
		}

		$sql_access_cats = ($user_admin) ? '' : ' AND ' . $db->sql_in_set('cat_id', array_map('intval', $access_cats));

		$sql = 'SELECT COUNT(dl_id) AS total FROM ' . DL_COMMENTS_TABLE . "
			WHERE approve = 0
				$sql_access_cats";
		$result = $db->sql_query($sql);
		$total = $db->sql_fetchfield('total');
		$db->sql_freeresult($result);

		return $total;
	}
}

?>