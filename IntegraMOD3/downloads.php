<?php

/**
*
* @mod package		Download Mod 6
* @file				downloads.php 77 2014/03/07 OXPUS
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
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/bbcode.' . $phpEx);

/*
* session management
*/
$user->session_begin();
$auth->acl($user->data);
$user->setup();

/*
* init and get various values
*/
$submit		= request_var('submit', '');
$preview	= request_var('preview', '');
$cancel		= request_var('cancel', '');
$confirm	= request_var('confirm', '');
$delete		= request_var('delete', '');
$cdelete	= request_var('cdelete', '');
$save		= request_var('save', '');
$post		= request_var('post', '');
$view		= request_var('view', '');
$show		= request_var('show', '');
$order		= request_var('order', '');
$action		= request_var('action', '');
$save		= request_var('save', '');
$goback		= request_var('goback', '');
$edit		= request_var('edit', '');
$bt_show	= request_var('bt_show', '');
$move		= request_var('move', '');
$fmove		= request_var('fmove', '');
$lock		= request_var('lock', '');
$sort		= request_var('sort', '');
$code		= request_var('code', '');
$sid		= request_var('sid', '');

$df_id		= request_var('df_id', 0);
$cat		= request_var('cat', 0);
$new_cat	= request_var('new_cat', 0);
$cat_id		= request_var('cat_id', 0);
$fav_id		= request_var('fav_id', 0);
$dl_id		= request_var('dl_id', 0);
$start		= request_var('start', 0);
$sort_by	= request_var('sort_by', 0);
$rate_point	= request_var('rate_point', 0);
$del_file	= request_var('del_file', 0);
$bt_filter	= request_var('bt_filter', -1);
$modcp		= request_var('modcp', 0);

$file_option	= request_var('file_ver_opt', 0);
$file_version	= request_var('file_version', 0);
$file_ver_del	= request_var('file_ver_del', array(0));

$dl_mod_is_active = true;
$dl_mod_link_show = true;
$dl_mod_is_active_for_admins = false;

if ($cat < 0)
{
	$cat = 0;
}

if (!$config['dl_active'])
{
	if ($config['dl_off_now_time'])
	{
		$dl_mod_is_active = false;
	}
	else
	{
		$curr_time = (date('H', time()) * 60) + date('i', time());
		$off_from = (substr($config['dl_off_from'], 0, 2) * 60) + (substr($config['dl_off_from'], -2));
		$off_till = (substr($config['dl_off_till'], 0, 2) * 60) + (substr($config['dl_off_till'], -2));

		if ($curr_time >= $off_from && $curr_time < $off_till)
		{
			$dl_mod_is_active = false;
		}
	}
}

if (!$dl_mod_is_active && $auth->acl_get('a_') && $config['dl_on_admins'])
{
	$dl_mod_is_active = true;
	$dl_mod_is_active_for_admins = true;
}

if (!$dl_mod_is_active && $config['dl_off_hide'])
{
	$dl_mod_link_show = false;
}

if ($user->data['is_bot'] && in_array($view, array('ajax', 'broken', 'bug_tracker', 'fav', 'load', 'modcp', 'popup', 'rss', 'search', 'stat', 'thumbs', 'todo', 'unbroken', 'unfav', 'upload', 'user_config')))
{
	$view = '';
}

if ($view != 'bug_tracker')
{
	if ($dl_mod_is_active_for_admins)
	{
		$template->assign_var('S_DL_MOD_OFFLINE_ADMINS', true);
	}
	else
	{
		if (!$dl_mod_is_active && $dl_mod_link_show)
		{
			trigger_error($user->lang['DL_OFF_MESSAGE']);
		}

		if (!$dl_mod_is_active)
		{
			redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
		}
	}
}

/*
* Ajax functions
*/
if ($view == 'ajax' && $df_id)
{
	include($phpbb_root_path . 'dl_mod/includes/dl_ajax.' . $phpEx);

	if (!empty($cache))
	{
		$cache->unload();
	}
	$db->sql_close();
	exit;
}
else if ($view == 'ajax')
{
	$view = '';
}

/*
* Only a little feed as RSS or RSS with feed or what?!? :P
*/
if ($view == 'rss')
{
	include($phpbb_root_path . 'dl_mod/includes/dl_rss.' . $phpEx);
}

/*
* include and create the main class
*/
include($phpbb_root_path . 'dl_mod/classes/class_dlmod.' . $phpEx);
$dl_mod = new dl_mod($phpbb_root_path, $phpEx);
$dl_mod->register();
dl_init::init();

/*
* set the right values for comments
*/
if (!$action)
{
	if ($post)
	{
		$view = 'comment';
		$action = 'post';
	}

	if ($show)
	{
		$view = 'comment';
		$action = 'view';
	}

	if ($save)
	{
		$view = 'comment';
		$action = 'save';
	}

	if ($delete)
	{
		$view = 'comment';
		$action = 'delete';
	}

	if ($edit)
	{
		$view = 'comment';
		$action = 'edit';
	}
}

/*
* wanna have smilies ;-)
*/
if ($action == 'smilies')
{
	include($phpbb_root_path . '/includes/functions_posting.'.$phpEx);
	generate_smilies('window', 0);
}

/*
* get the needed index
*/
$index = array();

switch ($view)
{
	case 'overall':
	case 'load':
	case 'detail':
	case 'thumbs':
	case 'comment':
	case 'upload':
	case 'modcp':
	case 'bug_tracker':

		$index = dl_main::full_index();
	break;

	default:

		$index = ($cat) ? dl_main::index($cat) : dl_main::index();
}

/*
* Build the navigation and check the permissions for the user
*/
$nav_string = array();
$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx");
$nav_string['name'][] = $user->lang['DL_CAT_TITLE'];

if ($dl_id || $df_id)
{
	$file_id = ($df_id) ? $df_id : $dl_id;

	$sql = 'SELECT cat, description FROM ' . DOWNLOADS_TABLE . '
		WHERE id = ' . (int) $file_id;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$cat_id = (!$cat_id) ? $row['cat'] : $cat_id;
	$description = $row['description'];
	$db->sql_freeresult($result);
}
else
{
	$description = $user->lang['DL_DOWNLOAD'];
}

if ($cat_id)
{
	$cat_auth = dl_auth::user_auth($cat_id, 'auth_view');

	if (!$cat_auth)
	{
		trigger_error($user->lang['DL_NO_PERMISSION']);
	}

	$tmp_nav = array();
	dl_nav::nav($cat_id, 'url', $tmp_nav);

	if (isset($tmp_nav['link']))
	{
		for ($i = sizeof($tmp_nav['link']) - 1; $i >= 0; $i--)
		{
			$nav_string['link'][] = $tmp_nav['link'][$i];
			$nav_string['name'][] = $tmp_nav['name'][$i];
		}
	}
}

switch ($view)
{
	case 'overall':
		$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=overall");
		$nav_string['name'][] = $user->lang['DL_OVERVIEW'];
	break;
	case 'detail':
		$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$df_id");
		$nav_string['name'][] = $user->lang['DL_DETAIL'] . ': ' . $description;
	break;
	case 'thumbs':
		$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$df_id");
		$nav_string['name'][] = $user->lang['DL_DETAIL'] . ': ' . $description;
		$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=thumbs&amp;df_id=$df_id&amp;cat_id=$cat_id");
		$nav_string['name'][] = $user->lang['DL_EDIT_THUMBS'];
	break;
	case 'comment':
		$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$df_id");
		$nav_string['name'][] = $user->lang['DL_DETAIL'] . ': ' . $description;
		$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=comment&amp;df_id=$df_id&amp;cat_id=$cat_id&amp;action=view");
		$nav_string['name'][] = $user->lang['DL_COMMENTS'];
	break;
	case 'upload':
		$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=upload&amp;cat_id=$cat_id");
		$nav_string['name'][] = $user->lang['DL_UPLOAD'];
	break;
	case 'modcp':
		if ($action == 'edit')
		{
			$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=$df_id");
			$nav_string['name'][] = $user->lang['DL_DETAIL'] . ': ' . $description;
			$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=$action&amp;cat_id=$cat_id&amp;df_id=$df_id");
			$nav_string['name'][] = $user->lang['DL_EDIT_FILE'];
		}

		if ($action == 'approve')
		{
			$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=approve");
			$nav_string['name'][] = $user->lang['MCP'] . ' <strong>&#8249;</strong> ' . $user->lang['DOWNLOADS'] . ' ' . $user->lang['DL_APPROVE'];
		}
		else if ($action == 'capprove')
		{
			$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;action=capprove");
			$nav_string['name'][] = $user->lang['MCP'] . ' <strong>&#8249;</strong> ' . $user->lang['DL_APPROVE_COMMENTS'];
		}
		else if ($action != 'edit')
		{
			if (!$cat_id)
			{
				$cat_id = '';
			}
			$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=modcp&amp;cat_id=$cat_id");
			$nav_string['name'][] = $user->lang['MCP'];
		}
	break;
	case 'bug_tracker':
		$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=bug_tracker&amp;df_id=$df_id");
		$nav_string['name'][] = $user->lang['DL_BUG_TRACKER'];
	break;
	case 'stat':
		$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=stat");
		$nav_string['name'][] = $user->lang['DL_STATS'];
	break;
	case 'user_config':
		$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=user_config");
		$nav_string['name'][] = $user->lang['DL_CONFIG'];
	break;
	case 'search':
		$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=search");
		$nav_string['name'][] = $user->lang['SEARCH'];
	break;
	case 'todo':
		$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=todo");
		$nav_string['name'][] = $user->lang['DL_MOD_TODO'];

		if ($action == 'edit')
		{
			$nav_string['link'][] = append_sid("{$phpbb_root_path}downloads.$phpEx", "view=todo&amp;action=edit");
			$nav_string['name'][] = $user->lang['DL_EDIT_FILE'];
		}
	break;
	default:
		if ($cat)
		{
			$tmp_nav = array();
			$cat_auth = dl_auth::user_auth($cat, 'auth_view');
		
			if (!$cat_auth)
			{
				redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
			}

			dl_nav::nav($cat, 'url', $tmp_nav);

			if (sizeof($tmp_nav['link']))
			{
				for ($i = sizeof($tmp_nav['link']) - 1; $i >= 0; $i--)
				{
					$nav_string['link'][] = $tmp_nav['link'][$i];
					$nav_string['name'][] = $tmp_nav['name'][$i];
				}
			}
		}
}

for ($i = 0; $i < sizeof($nav_string['link']); $i++)
{
	$template->assign_block_vars('dl_nav', array(
		'L_DOWNLOAD'	=> $nav_string['name'][$i],
		'U_DOWNLOAD'	=> $nav_string['link'][$i],
	));
}

if ($view != 'load' && $view != 'broken')
{
	$sql_where = '';

	if (!$user->data['is_registered'])
	{
		$sql = 'SELECT session_id FROM ' . SESSIONS_TABLE . '
			WHERE session_user_id = ' . ANONYMOUS;
		$result = $db->sql_query($sql);

		$guest_sids = array();
		$guest_sids[0] = 0;

		while ($row = $db->sql_fetchrow($result))
		{
			$guest_sids[] = $row['session_id'];
		}
		$db->sql_freeresult($result);

		$sql_where = ' OR ' . $db->sql_in_set('session_id', array_map('intval', $guest_sids), true);
	}

	$sql = 'DELETE FROM ' . DL_HOTLINK_TABLE . '
		WHERE user_id = ' . (int) $user->data['user_id'] . "
			$sql_where";
	$db->sql_query($sql);
}

/*
* create todo list
*/
if ($view == 'todo')
{
	if (!$config['dl_todo_onoff'])
	{
		trigger_error($user->lang['DL_NO_PERMISSION'], E_USER_WARNING);
	}

	$todo_access_ids = dl_main::full_index(0, 0, 0, 2);
	$total_todo_ids = sizeof($todo_access_ids);

	if ($action == 'edit')
	{
		if ($total_todo_ids > 0 && $user->data['is_registered'])
		{
			include($phpbb_root_path . 'dl_mod/includes/dl_todo.' . $phpEx);
		}
		else
		{
			trigger_error($user->lang['DL_NO_PERMISSION'], E_USER_WARNING);
		}
	}
	else
	{
		$dl_todo = array();
		$dl_todo = dl_extra::get_todo();

		page_header($user->lang['DL_MOD_TODO']);

		$template->set_filenames(array(
			'body' => 'dl_mod/dl_todo_body.html')
		);

		$template->assign_vars(array(
			'U_TODO_EDIT'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=todo&amp;action=edit"),
			'U_DL_TOP'		=> append_sid("{$phpbb_root_path}downloads.$phpEx"))
		);

		if ($total_todo_ids > 0 && $user->data['is_registered'])
		{
			$template->assign_var('S_TODO_EDIT', true);
		}

		if (isset($dl_todo['file_name'][0]) && sizeof($dl_todo['file_name']))
		{
			for ($i = 0; $i < sizeof($dl_todo['file_name']); $i++)
			{
				$template->assign_block_vars('todolist_row', array(
					'FILENAME'		=> $dl_todo['file_name'][$i],
					'FILE_LINK'		=> $dl_todo['file_link'][$i],
					'HACK_VERSION'	=> $dl_todo['hack_version'][$i],
					'TODO'			=> $dl_todo['todo'][$i])
				);
			}
		}
		else
		{
			$template->assign_var('S_NO_TODOLIST', true);
		}
	}
}

/*
* handle reported broken download
*/
if ($view == 'broken' && $df_id && $cat_id && ($user->data['is_registered'] || (!$user->data['is_registered'] && $config['dl_report_broken'])))
{
	// Prepare the captcha permissions for the current user
	$captcha_active = true;
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
		$cat_auth_tmp = array();
		$cat_auth_tmp = dl_auth::dl_cat_auth($cat_id);

		if (($cat_auth_tmp['auth_mod'] || ($auth->acl_get('a_') && $user->data['is_registered'])) && !dl_auth::user_banned())
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
	
	switch ($config['dl_report_broken_vc'])
	{
		case 0:
			$captcha_active = false;
		break;
	
		case 1:
			if (!$user_is_guest)
			{
				$captcha_active = false;
			}
		break;
	
		case 2:
			if ($user_is_mod || $user_is_admin || $user_is_founder)
			{
				$captcha_active = false;
			}
		break;
	
		case 3:
			if ($user_is_admin || $user_is_founder)
			{
				$captcha_active = false;
			}
		break;
	
		case 4:
			if ($user_is_founder)
			{
				$captcha_active = false;
			}
		break;
	}

	if ($captcha_active)
	{
		$code_match = false;

		include($phpbb_root_path . 'includes/captcha/captcha_factory.' . $phpEx);
		$captcha = phpbb_captcha_factory::get_instance($config['captcha_plugin']);
		$captcha->init(CONFIRM_POST);

		$s_hidden_fields = $error = array();

		if ($confirm == 'code')
		{
			if (!check_form_key('dl_report'))
			{
				trigger_error('FORM_INVALID');
			}

	        $vc_response = $captcha->validate();

	        if ($vc_response)
	        {
	            $error[] = $vc_response;
	        }

	        if (!sizeof($error))
	        {
	            $captcha->reset();
	            $code_match = true;
	        }
	        else if ($captcha->is_solved())
	        {
	            $s_hidden_fields = array_merge($s_hidden_fields, $captcha->get_hidden_fields());
	            $code_match = false;
	        }
		}
		else if (!$captcha->is_solved())
		{
			add_form_key('dl_report');

			page_header();

			$template->set_filenames(array(
				'body' => 'dl_mod/dl_report_code_body.html')
			);

			$s_hidden_fields = array_merge($s_hidden_fields, array(
				'cat_id' => $cat_id,
				'df_id' => $df_id,
				'view' => 'broken',
				'confirm' => 'code'
			));

			$template->assign_vars(array(
				'MESSAGE_TITLE'		=> $user->lang['DL_BROKEN'],
				'MESSAGE_TEXT'		=> $user->lang['DL_REPORT_CONFIRM_CODE'],

				'S_CONFIRM_ACTION'	=> append_sid("{$phpbb_root_path}downloads.$phpEx"),
				'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
	            'S_CONFIRM_CODE'	=> true,
	            'CAPTCHA_TEMPLATE'	=> $captcha->get_template(),
			));

			include($phpbb_root_path . '/dl_mod/includes/dl_footer.' . $phpEx);
			page_footer();
		}
	}
	else if (!$submit)
	{
		page_header();

		$template->set_filenames(array(
			'body' => 'dl_mod/dl_report_code_body.html')
		);

		$s_hidden_fields = array(
			'cat_id' => $cat_id,
			'df_id' => $df_id,
			'view' => 'broken',
		);

		$template->assign_vars(array(
			'MESSAGE_TITLE'		=> $user->lang['DL_BROKEN'],
			'MESSAGE_TEXT'		=> $user->lang['DL_REPORT_CONFIRM_CODE'],

			'S_CONFIRM_ACTION'	=> append_sid("{$phpbb_root_path}downloads.$phpEx"),
			'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
		));

		include($phpbb_root_path . '/dl_mod/includes/dl_footer.' . $phpEx);
		page_footer();
	}		

	if ($captcha_active && !$code_match)
	{
		trigger_error('DL_REPORT_BROKEN_VC_MISMATCH');
	}
	else
	{
		$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
			'broken' => true)) . ' WHERE id = ' . (int) $df_id;
		$db->sql_query($sql);

		$processing_user = dl_auth::dl_auth_users($cat_id, 'auth_mod');

		$report_notify_text = utf8_normalize_nfc(request_var('report_notify_text', '', true));
		$report_notify_text = ($report_notify_text) ? sprintf($user->lang['DL_REPORT_NOTIFY_TEXT'], $report_notify_text) : '';

		$mail_data = array(
			'email_template'		=> 'downloads_report_broken',
			'processing_user'		=> $processing_user,
			'report_notify_text'	=> $report_notify_text,
			'cat_id'				=> $cat_id,
			'df_id'					=> $df_id,
		);

		dl_email::send_report($mail_data);
	}

	redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&df_id=$df_id&cat_id=$cat_id"));
}

/*
* reset reported broken download if allowed
*/
if ($view == 'unbroken' && $df_id && $cat_id)
{
	$cat_auth = array();
	$cat_auth = dl_auth::dl_cat_auth($cat_id);

	if (isset($index[$cat_id]['auth_mod']) && $index[$cat_id]['auth_mod'] || isset($cat_auth['auth_mod']) && $cat_auth['auth_mod'] || ($auth->acl_get('a_') && $user->data['is_registered']))
	{
		$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
			'broken' => 0)) . ' WHERE id = ' . (int) $df_id;
		$db->sql_query($sql);
	}

	redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&df_id=$df_id&cat_id=$cat_id"));
}

/*
* set favorite for the choosen download
*/
if ($view == 'fav' && $df_id && $cat_id && $user->data['is_registered'])
{
	$sql = 'SELECT COUNT(fav_dl_id) AS total FROM ' . DL_FAVORITES_TABLE . '
		WHERE fav_dl_id = ' . (int) $df_id . '
			AND fav_user_id = ' . (int) $user->data['user_id'];
	$result = $db->sql_query($sql);
	$fav_check = $db->sql_fetchfield('total');
	$db->sql_freeresult($result);

	if (!$fav_check)
	{
		$sql = 'INSERT INTO ' . DL_FAVORITES_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'fav_dl_id'		=> $df_id,
			'fav_dl_cat'	=> $cat_id,
			'fav_user_id'	=> $user->data['user_id']));
		$db->sql_query($sql);
	}

	redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&df_id=$df_id&cat_id=$cat_id"));
}

/*
* drop favorite for the choosen download
*/
if ($view == 'unfav' && $fav_id && $df_id && $cat_id && $user->data['is_registered'])
{
	$sql = 'DELETE FROM ' . DL_FAVORITES_TABLE . '
		WHERE fav_id = ' . (int) $fav_id . '
			AND fav_dl_id = ' . (int) $df_id . '
			AND fav_user_id = ' . (int) $user->data['user_id'];
	$db->sql_query($sql);

	redirect(append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&df_id=$df_id&cat_id=$cat_id"));
}

/*
* open the bug tracker, if choosen and possible
*/
if ($view == 'bug_tracker' && $user->data['is_registered'])
{
	$bug_tracker = dl_auth::bug_tracker();
	if ($bug_tracker)
	{
		$inc_module = true;
		page_header($user->lang['DL_BUG_TRACKER']);
		include($phpbb_root_path . 'dl_mod/includes/dl_bug_tracker.' . $phpEx);
	}
	else
	{
		$view = '';
	}
}

/*
* No real hard work until here? Must at least run one of the default modules?
*/
$inc_module = false;

if ($view == 'stat')
{
	/*
	* getting some stats
	*/
	$inc_module = true;
	page_header($user->lang['DL_STATS']);
	include($phpbb_root_path . 'dl_mod/includes/dl_stats.' . $phpEx);
}
else if ($view == 'user_config')
{
	/*
	* display the user config for the downloads
	*/
	$inc_module = true;
	page_header($user->lang['DL_CONFIG']);
	include($phpbb_root_path . 'dl_mod/includes/dl_user_config.' . $phpEx);
}
else if ($view == 'detail')
{
	include($phpbb_root_path . 'dl_mod/includes/dl_details.' . $phpEx);
}
else if ($view == 'thumbs')
{
	if (isset($index[$cat_id]['allow_thumbs']) && $index[$cat_id]['allow_thumbs'] && $config['dl_thumb_fsize'])
	{
		include($phpbb_root_path . 'dl_mod/includes/dl_thumbs.' . $phpEx);
	}
	else
	{
		trigger_error('DL_NO_PERMISSION');
	}
}
else if ($view == 'search')
{
	/*
	* open the search for downloads
	*/
	$inc_module = true;
	page_header($user->lang['SEARCH'].' '.$user->lang['DOWNLOADS']);
	include($phpbb_root_path . 'dl_mod/includes/dl_search.' . $phpEx);
}
else if ($view == 'popup')
{
	/*
	* display the popup for a new or changed download
	*/
	$gen_simple_header = true;
	page_header();

	$template->set_filenames(array(
		'body' => 'ucp_pm_popup.html')
	);

	$template->assign_vars(array(
		'L_CLOSE_WINDOW' => $user->lang['CLOSE_WINDOW'],
		'MESSAGE' => sprintf($user->lang['NEW_DOWNLOAD'], '<a href="javascript:jump_to_inbox(\'' . append_sid("{$phpbb_root_path}downloads.$phpEx") . '\');">', '</a>'))
	);

	page_footer();
}
else if ($view == 'load')
{
	include($phpbb_root_path . 'dl_mod/includes/dl_load.' . $phpEx);
}
else if ($view == 'comment')
{
	include($phpbb_root_path . 'dl_mod/includes/dl_comments.' . $phpEx);
}
else if ($view == 'upload')
{
	$inc_module = true;
	page_header($user->lang['DL_UPLOAD']);
	include($phpbb_root_path . 'dl_mod/includes/dl_upload.' . $phpEx);
}
else if ($view == 'modcp')
{
	include($phpbb_root_path . 'dl_mod/includes/dl_modcp.' . $phpEx);
}

/*
* sorting downloads
*/
if ($config['dl_sort_preform'])
{
	$sort_by = 0;
	$order = 'ASC';
}
else
{
	$sort_by = (!$sort_by) ? $user->data['user_dl_sort_fix'] : $sort_by;
	$order = (!$order) ? (($user->data['user_dl_sort_dir']) ? 'DESC' : 'ASC') : $order;
}

switch ($sort_by)
{
	case 1:
		$sql_sort_by = 'description';
		break;
	case 2:
		$sql_sort_by = 'file_name';
		break;
	case 3:
		$sql_sort_by = 'klicks';
		break;
	case 4:
		$sql_sort_by = 'free';
		break;
	case 5:
		$sql_sort_by = 'extern';
		break;
	case 6:
		$sql_sort_by = 'file_size';
		break;
	case 7:
		$sql_sort_by = 'change_time';
		break;
	case 8:
		$sql_sort_by = 'rating';
		break;
	default:
		$sql_sort_by = 'sort';
}

$sql_order = ($order == 'DESC') ? 'DESC' : 'ASC';

if (!$config['dl_sort_preform'] && $user->data['user_dl_sort_opt'])
{
	$template->assign_var('S_SORT_OPTIONS', true);

	$selected_0 = ($sort_by == 0) ? ' selected="selected"' : '';
	$selected_1 = ($sort_by == 1) ? ' selected="selected"' : '';
	$selected_2 = ($sort_by == 2) ? ' selected="selected"' : '';
	$selected_3 = ($sort_by == 3) ? ' selected="selected"' : '';
	$selected_4 = ($sort_by == 4) ? ' selected="selected"' : '';
	$selected_5 = ($sort_by == 5) ? ' selected="selected"' : '';
	$selected_6 = ($sort_by == 6) ? ' selected="selected"' : '';
	$selected_7 = ($sort_by == 7) ? ' selected="selected"' : '';
	$selected_8 = ($sort_by == 8) ? ' selected="selected"' : '';

	$selected_sort_0 = ($order == 'ASC') ? ' selected="selected"' : '';
	$selected_sort_1 = ($order == 'DESC') ? ' selected="selected"' : '';

	$template->assign_vars(array(
		'SELECTED_0'		=> $selected_0,
		'SELECTED_1'		=> $selected_1,
		'SELECTED_2'		=> $selected_2,
		'SELECTED_3'		=> $selected_3,
		'SELECTED_4'		=> $selected_4,
		'SELECTED_5'		=> $selected_5,
		'SELECTED_6'		=> $selected_6,
		'SELECTED_7'		=> $selected_7,
		'SELECTED_8'		=> $selected_8,

		'SELECTED_SORT_0'	=> $selected_sort_0,
		'SELECTED_SORT_1'	=> $selected_sort_1,
	));
}
else
{
	$s_sort_by = '';
	$s_order = '';
}

if ($view == 'overall' && sizeof($index))
{
	if ($config['dl_overview_link_onoff'])
	{
		include($phpbb_root_path . 'dl_mod/includes/dl_overview.' . $phpEx);
	}
	else
	{
		redirect(append_sid("{$phpbb_root_path}downloads.$phpEx"));
	}
}

/*
* default user entry. redirect to index or category
*/
if (empty($view) && !$inc_module)
{
	include($phpbb_root_path . 'dl_mod/includes/dl_cat.' . $phpEx);
}

$view_check = array('broken', 'bug_tracker', 'comment', 'detail', 'fav', 'load', 'modcp', 'overall', 'popup', 'rss', 'search', 'stat', 'thumbs', 'todo', 'unbroken', 'unfav', 'upload', 'user_config', 'view');

if (in_array($view, $view_check))
{
	dl_version::dl_mod_version('check');
}

if (!in_array($view, $view_check) || !isset($template->filename['body']))
{
	trigger_error('DL_NO_PERMISSION');
}

$template->assign_vars(array(
	'U_HELP_POPUP' => "{$phpbb_root_path}dl_help.$phpEx?sid=" . $user->data['session_id'] . "&help_key=",
));

/*
* include the mod footer
*/
include($phpbb_root_path . 'dl_mod/includes/dl_footer.' . $phpEx);

/*
* include the phpBB footer
*/
page_footer();

?>