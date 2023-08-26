<?php

/**
*
* @mod package		Download Mod 6
* @file				hacks_list.php 9 2012/05/19 OXPUS
* @copyright		(c) 2005 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/*
* connect to phpBB
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

/*
* session management
*/
$user->session_begin();
$auth->acl($user->data);
$user->setup();

/*
* init and get various values
*/
$sort_by	= request_var('sort_by', '');
$order		= request_var('order', '');
$start		= request_var('start', 0);

switch ($sort_by)
{
	case 1:
		$sql_sort_by = 'long_desc';
		break;
	case 2:
		$sql_sort_by = 'hack_author';
		break;
	default:
		$sql_sort_by = 'description';
}

$sql_order = ($order) ? $order : 'ASC';

/*
* include and create the hacklist class
*/
include($phpbb_root_path . 'dl_mod/classes/class_hacklist.' . $phpEx);

$hacklist = array();
$hacklist = hacklist::hacks_index();
$status = $config['dl_use_hacklist'];

if (!$status || !sizeof($hacklist))
{
	redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
}

page_header($user->lang['DL_HACKS_LIST']);

$template->set_filenames(array(
	'body' => 'dl_mod/hacks_list_body.html')
);

$dl_files = array();
$dl_files = hacklist::all_files($sql_sort_by, $sql_order, $start, $config['dl_links_per_page']);

$all_files = array();
$all_files = hacklist::all_files('id', 'ASC');

$pagination = ($all_files > $config['dl_links_per_page']) ? generate_pagination(append_sid("{$phpbb_root_path}hacks_list.$phpEx", "sort_by=$sort_by&amp;order=$order"), $all_files, $config['dl_links_per_page'], $start, true) : '';
$page_number = ($all_files > $config['dl_links_per_page']) ? on_page($all_files, $config['dl_links_per_page'], $start) : '';

$selected_0 = ($sort_by == 0) ? ' selected="selected"' : '';
$selected_1 = ($sort_by == 1) ? ' selected="selected"' : '';
$selected_2 = ($sort_by == 2) ? ' selected="selected"' : '';

$selected_sort_0 = ($order == 'ASC') ? ' selected="selected"' : '';
$selected_sort_1 = ($order == 'DESC') ? ' selected="selected"' : '';

$template->assign_vars(array(
	'PAGINATION' 		=> $pagination,
	'PAGE_NUMBER' 		=> $page_number,

	'SELECTED_0'		=> $selected_0,
	'SELECTED_1'		=> $selected_1,
	'SELECTED_2'		=> $selected_2,

	'SELECTED_SORT_0'	=> $selected_sort_0,
	'SELECTED_SORT_1'	=> $selected_sort_1,

	'S_FORM_ACTION' => append_sid("{$phpbb_root_path}hacks_list.$phpEx"))
);

if (sizeof($dl_files))
{
	for ($i = 0; $i < sizeof($dl_files); $i++)
	{
		$cat_id = $dl_files[$i]['cat'];
		if ($hacklist[$cat_id])
		{
			$hack_name				= $dl_files[$i]['description'];
			$hack_author			= ($dl_files[$i]['hack_author'] != '') ? $dl_files[$i]['hack_author'] : 'n/a';
			$hack_author_email		= $dl_files[$i]['hack_author_email'];
			$hack_author_website	= $dl_files[$i]['hack_author_website'];
			$hackname				= ($dl_files[$i]['hacklist'] != '') ? '&nbsp;'.$dl_files[$i]['description'] : '';
			$hack_version			= ($dl_files[$i]['hacklist'] != '') ? '&nbsp;'.$dl_files[$i]['hack_version'] : '';
			$hack_dl_url			= $dl_files[$i]['hack_dl_url'];
			$description			= $dl_files[$i]['long_desc'];
			$uid					= $dl_files[$i]['long_desc_uid'];
			$bitfield				= $dl_files[$i]['long_desc_bitfield'];
			$flags					= $dl_files[$i]['long_desc_flags'];

			if ($uid)
			{
				$text_ary = generate_text_for_display($description, $uid, $bitfield, $flags);
				$description = (isset($text_ary['text'])) ? $text_ary['text'] : $description;
			}

			$template->assign_block_vars('listrow', array(
				'CAT_NAME'				=> $hacklist[$cat_id],
				'HACK_NAME'				=> $hackname . $hack_version,
				'HACK_DESCRIPTION'		=> $description,
				'HACK_AUTHOR'			=> ($hack_author_email != '') ? '<a href="mailto:' . $hack_author_email . '">'.$hack_author.'</a>' : $hack_author,
				'HACK_AUTHOR_WEBSITE'	=> ($hack_author_website != '') ? '<a href="' . $hack_author_website . '">' . $user->lang['DL_HACK_AUTOR_WEBSITE'] . '</a>' : '',
				'HACK_DL_URL'			=> ($hack_dl_url != '') ? '<a href="' . $hack_dl_url . '">' . $user->lang['DL_DOWNLOAD'] . '</a>' : '')
			);
		}
	}
}

page_footer();

?>