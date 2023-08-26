<?php

/**
*
* @mod package		Download Mod 6
* @file				class_dl_files.php 1 2012/03/20 OXPUS
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

class dl_files extends dl_mod
{
	public function __construct()
	{
		return;
	}

	public function __destruct()
	{
		return;
	}

	public static function files($cat_id, $sql_sort_by, $sql_order, $start, $limit, $sql_fields = '*')
	{
		global $db;

		$dl_files = array();

		$sql = 'SELECT ' . $db->sql_escape($sql_fields) . ' FROM ' . DOWNLOADS_TABLE . '
			WHERE cat = ' . (int) $cat_id . '
				AND approve = ' . true . '
			ORDER BY ' . $db->sql_escape($sql_sort_by) . ' ' . $db->sql_escape($sql_order);
		if ($limit)
		{
			$result = $db->sql_query_limit($sql, $limit, $start);
		}
		else
		{
			$result = $db->sql_query($sql);
		}

		while ($row = $db->sql_fetchrow($result))
		{
			$dl_files[] = $row;
		}
		$db->sql_freeresult($result);

		return $dl_files;
	}

	public static function all_files($cat_id, $sql_sort_by, $sql_order, $extra_where, $df_id, $modcp, $sql_fields, $sql_limit = 0)
	{
		global $db;

		$dl_files = array();

		$sql = 'SELECT ' . $db->sql_escape($sql_fields) . ' FROM ' . DOWNLOADS_TABLE;
		$sql .= ($modcp) ? ' WHERE ' . $db->sql_in_set('approve', array(0, 1)) : ' WHERE approve = ' . true;
		$sql .= ($cat_id) ? ' AND cat = ' . (int) $cat_id . ' ' : '';
		$sql .= ($df_id) ? ' AND id = ' . (int) $df_id . ' ' : '';
		$sql .= ($extra_where) ? ' ' . str_replace("\'\'", "''", $db->sql_escape($extra_where)) . ' ' : '';
		$sql .= ($sql_sort_by) ? ' ORDER BY ' . $db->sql_escape($sql_sort_by) . ' ' . $db->sql_escape($sql_order) : '';
		$sql .= ($sql_limit) ? ' LIMIT ' . (int) $sql_limit : '';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$dl_files[] = $row;
		}
		$db->sql_freeresult($result);

		return ($df_id) ? ((isset($dl_files[0])) ? $dl_files[0] : array()) : $dl_files;
	}
}

?>