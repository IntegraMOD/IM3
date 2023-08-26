<?php
/**
*
* @mod package		Download Mod 6
* @file				dl_overview.php 5 2014/10/08 OXPUS
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

page_header($user->lang['DOWNLOADS'] . ' ' . $user->lang['DL_OVERVIEW']);

$sql = 'SELECT dl_id, user_id FROM ' . DL_RATING_TABLE;
$result = $db->sql_query($sql);

$ratings = array();
while ($row = $db->sql_fetchrow($result))
{
	$ratings[$row['dl_id']][] = $row['user_id'];
}
$db->sql_freeresult($result);

$template->set_filenames(array(
	'body' => 'dl_mod/dl_overview_body.html')
);

$template->assign_vars(array(
	'S_FORM_ACTION'		=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=overall"),

	'U_DL_INDEX'		=> append_sid("{$phpbb_root_path}downloads.$phpEx"),

	'PAGE_NAME'			=> $user->lang['DOWNLOADS'] . ' ' . $user->lang['DL_OVERVIEW'])
);

$dl_files = array();
$dl_files = dl_files::all_files(0, '', '', '', 0, 0, '*');

$total_files = 0;

if (sizeof($dl_files))
{
	for ($i = 0; $i < sizeof($dl_files); $i++)
	{
		$cat_id = $dl_files[$i]['cat'];
		$cat_auth = array();
		$cat_auth = dl_auth::dl_cat_auth($cat_id);
		if (isset($cat_auth['auth_view']) && $cat_auth['auth_view'] || isset($index[$cat_id]['auth_view']) && $index[$cat_id]['auth_view'] || ($auth->acl_get('a_') && $user->data['is_registered']))
		{
			$total_files++;
		}
	}
}

if ($total_files)
{
	$template->assign_var('S_OVERALL_VIEW', true);
}

if ($total_files > $config['dl_links_per_page'])
{
	$pagination = generate_pagination(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=overall&amp;sort_by=$sort_by&amp;order=$order"), $total_files, $config['dl_links_per_page'], $start, true);
	$page_number = on_page($total_files, $config['dl_links_per_page'], $start);

	$template->assign_vars(array(
		'PAGINATION'	=> $pagination,
		'PAGE_NUMBER'	=> $page_number,
	));
}

$sql_sort_by = ($sql_sort_by == 'sort') ? 'cat, sort' : $sql_sort_by;

$dl_files = array();
$dl_files = dl_files::all_files(0, '', '', ' ORDER BY ' . $sql_sort_by . ' ' . $sql_order . ' LIMIT ' . $start . ', ' . $config['dl_links_per_page'], 0, 0, 'cat, id, description, desc_uid, desc_bitfield, desc_flags, hack_version, extern, file_size, klicks, overall_klicks, rating');

if (sizeof($dl_files))
{
	for ($i = 0; $i < sizeof($dl_files); $i++)
	{
		$cat_id = $dl_files[$i]['cat'];
		$cat_auth = array();
		$cat_auth = dl_auth::dl_cat_auth($cat_id);
		if (isset($cat_auth['auth_view']) && $cat_auth['auth_view'] || isset($index[$cat_id]['auth_view']) && $index[$cat_id]['auth_view'] || ($auth->acl_get('a_') && $user->data['is_registered']))
		{
			$cat_name = $index[$cat_id]['cat_name'];
			$cat_name = str_replace('&nbsp;&nbsp;|', '', $cat_name);
			$cat_name = str_replace('___&nbsp;', '', $cat_name);
			$cat_view = $index[$cat_id]['nav_path'];

			$file_id = $dl_files[$i]['id'];
			$mini_file_icon = dl_status::mini_status_file($cat_id, $file_id);

			$description = $dl_files[$i]['description'];
			$desc_uid = $dl_files[$i]['desc_uid'];
			$desc_bitfield = $dl_files[$i]['desc_bitfield'];
			$desc_flags = $dl_files[$i]['desc_flags'];
			$description = censor_text($description);
			$description = generate_text_for_display($description, $desc_uid, $desc_bitfield, $desc_flags);

			$dl_link = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$file_id");

			$hack_version = '&nbsp;'.$dl_files[$i]['hack_version'];

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

			$rating_points = $dl_files[$i]['rating'];
			$s_rating_perm = false;

			if ($config['dl_enable_rate'] && ($rating_points == 0 || !@in_array($user->data['user_id'], $ratings[$file_id])) && $user->data['is_registered'])
			{
				$s_rating_perm = true;
			}

			if (isset($ratings[$file_id]) && $config['dl_enable_rate'])
			{
				$rating_count_text = '&nbsp;[ '.sizeof($ratings[$file_id]).' ]';
			}
			else
			{
				$rating_count_text = '';
			}

			$template->assign_block_vars('downloads', array(
				'CAT_NAME'				=> $cat_name,
				'DESCRIPTION'			=> $mini_file_icon.$description,
				'FILE_KLICKS'			=> $file_klicks,
				'FILE_OVERALL_KLICKS'	=> $file_overall_klicks,
				'FILE_SIZE'				=> $file_size,
				'HACK_VERSION'			=> $hack_version,
				'RATING_IMG'			=> dl_format::rating_img($rating_points, $s_rating_perm, $file_id),
				'RATINGS'				=> $rating_count_text,
				'STATUS'				=> $status,
				'DF_ID'					=> $file_id,

				'U_CAT_VIEW'			=> $cat_view,
				'U_DL_LINK'				=> $dl_link)
			);
		}
	}

	$template->assign_var('S_ENABLE_RATE', (isset($config['dl_enable_rate']) && $config['dl_enable_rate']) ? true : false);
}

?>