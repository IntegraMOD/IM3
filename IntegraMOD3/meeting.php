<?php

/** 
*
* @mod package		Meeting MOD
* @file				meeting.php 28 2014/08/27 OXPUS
* @copyright		(c) 2009 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/*
* connect to phpBB
*/
define('IN_PHPBB', true);
define('IN_MEETING', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_user.' . $phpEx);

/*
* session management
*/
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!$auth->acl_get('u_meeting'))
{
	redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
}

$allow_sign_onoff = false;

// Check the userlevel
if ($user->data['user_type'] == USER_FOUNDER)
{
	$allow_sign_onoff = true;
}

if (($auth->acl_get('a_') && $user->data['is_registered']))
{
	$is_admin	= true;
	$is_mod		= false;
	$is_user	= false;

	if (($config['meeting_sign_perm'] ?? null) >= 1)
	{
		$allow_sign_onoff = true;
	}
}
else if (($auth->acl_get('m_') && $user->data['is_registered']))
{
	$is_admin	= false;
	$is_mod		= true;
	$is_user	= false;

	if ($config['meeting_sign_perm'] >= 2)
	{
		$allow_sign_onoff = true;
	}
}
else
{
	$is_admin	= false;
	$is_mod		= false;
	$is_user	= true;
}

// And about this check the meeting permissions
if (($config['meeting_user_enter'] ?? null) == 1 || $is_admin || $is_mod)
{
	$allow_add = true;
}
else if ($config['meeting_user_enter'] == 2 && $is_user)
{
	$sql = 'SELECT COUNT(g.group_id) AS total FROM ' . GROUPS_TABLE . ' g, ' . USER_GROUP_TABLE . ' ug
		WHERE ug.group_id = g.group_id
			AND ug.user_pending <> ' . TRUE . '
			AND g.group_meeting_create = ' . TRUE . '
			AND ug.user_id = ' . $user->data['user_id'];
	$result = $db->sql_query($sql);
	$count_groups = $db->sql_fetchfield('total');
	$db->sql_freeresult($result);

	if ($count_groups > 0)
	{
		$allow_add = true;
	}
	else
	{
		$allow_add = false;
	}
}
else
{
	$allow_add = false;
}

$allow_edit = ($is_admin || $is_mod) ? true : false;
$allow_delete = ($is_admin || $is_mod) ? true : false;
$template->assign_var('S_IN_MEETING', true);

// Get access status for all meetings
$meetings_access_ids = array();
$allowed_meetings_ary = array(0);

$sql = 'SELECT m.meeting_id, mg.meeting_group FROM ' . MEETING_DATA_TABLE . ' m, ' . MEETING_USERGROUP_TABLE . ' mg
	WHERE mg.meeting_id = m.meeting_id
	ORDER BY meeting_id';
$result = $db->sql_query($sql);

$cur_meeting = 0;

while ($row = $db->sql_fetchrow($result))
{
	$meeting_id = $row['meeting_id'];
	$meeting_group = $row['meeting_group'];

	if ($cur_meeting <> $meeting_id)
	{
		$meetings_access_ids[$meeting_id] = 0;
		$cur_meeting = $meeting_id;
	}

	if ($meeting_group == -1)
	{
		$meetings_access_ids[$meeting_id] = true;
		$allowed_meetings_ary[] = $meeting_id;
	}
	else
	{
		$count_usergroups = group_memberships($meeting_group, $user->data['user_id'], true);

		if ($count_usergroups)
		{
			$meetings_access_ids[$meeting_id] = true;
			$allowed_meetings_ary[] = $meeting_id;
		}
	}
}

// Get entered values
$action		= request_var('action', '');
$cancel		= request_var('cancel', '');
$confirm	= request_var('confirm', '');
$submit		= request_var('submit', '');
$mode		= request_var('mode', 'manage');
$delete		= request_var('delete', '');
$view		= request_var('view', '');

$m_cal_month	= request_var('m_cal_month', date('m', time()));
$m_cal_year		= request_var('m_cal_year', date('Y', time()));
$m_cal_month_s	= request_var('m_cal_month_s', 0);
$m_cal_year_s	= request_var('m_cal_year_s', 0);
$m_cal_month	= ($m_cal_month <> $m_cal_month_s && $m_cal_month_s) ? $m_cal_month_s : $m_cal_month;
$m_cal_year		= ($m_cal_year <> $m_cal_year_s && $m_cal_year_s) ? $m_cal_year_s : $m_cal_year;
$m_cal_period	= $m_cal_year . '-' . sprintf("%02d", $m_cal_month);

$sign_on_edit	= request_var('sign_on_edit', '');
$sign_off		= request_var('sign_off', '');
$sign_user		= request_var('sign_user', '');

$c_id					= request_var('c_id', 0);
$c_user_id				= request_var('c_user_id', 0);
$closed					= request_var('closed', 1);
$e_date					= request_var('e_date', '');
$e_time					= request_var('e_date_time', '');
$filter					= request_var('filter', '');
$filter_by				= request_var('filter_by', 'none');
$group_id				= request_var('group_id', array(0 => ''));
$m_id					= request_var('m_id', 0);
$m_date					= request_var('m_date', '');
$m_time					= request_var('m_date_time', '');
$meeting_approve		= request_var('meeting_approve', 0);
$meeting_comment		= utf8_normalize_nfc(request_var('meeting_comment', '', true));
$meeting_desc			= utf8_normalize_nfc(request_var('meeting_desc', utf8_normalize_nfc(request_var('message', '', true)), true));
$meeting_guest_names	= request_var('meeting_guest_names', 0);
$meeting_guest_overall	= request_var('meeting_guest_overall', 0);
$meeting_guest_single	= request_var('meeting_guest_single', 0);
$meeting_guests			= request_var('meeting_guests', 0);
$meeting_link			= utf8_normalize_nfc(request_var('meeting_link', '', true));
$meeting_location		= utf8_normalize_nfc(request_var('meeting_location', '', true));
$meeting_notify			= request_var('meeting_notify', 0);
$meeting_places			= request_var('meeting_places', 0);
$meeting_recure_value	= request_var('meeting_recure_value', 0);
$meeting_signon			= request_var('meeting_signon', 0);
$meeting_start_value	= request_var('meeting_start_value', 0);
$meeting_subject		= utf8_normalize_nfc(request_var('meeting_subject', '', true));
$meeting_sure			= request_var('meeting_sure', 0);
$sort_field				= request_var('sort_field', 'meeting_time');
$sort_order				= request_var('sort_order', 'ASC');
$start					= request_var('start', 0);
$u_date					= request_var('u_date', '');
$u_time					= request_var('u_date_time', '');
$user_id				= request_var('u', 0);

$meeting_mail_subject	= utf8_normalize_nfc(request_var('meeting_mail_subject', '', true));
$meeting_mail_text		= utf8_normalize_nfc(request_var('meeting_mail_text', '', true));
$mail_to				= request_var('mail_to', 0);

// And now at least recheck the permission for a given $m_id to reset the mode
if ($m_id && !$meetings_access_ids[$m_id] && !$is_admin)
{
	$mode = 'manage';
	$m_id = 0;
}

// What shall we do on cancel a deleting
if ($cancel)
{
	$submit = '';
	$cancel = '';
	$confirm = '';
	$action = '';
	$sign_on_edit = '';
	$sign_off = '';

	if ($m_id)
	{
		if ($mode == 'delete')
		{
			$mode = 'manage';
		}
		else
		{
			$mode = 'detail';
		}
	}
	else
	{
		$mode = 'manage';
	}
}

// Change the mode if the meeting id is not set
if (in_array($mode, array('edit', 'delete', 'detail', 'mail', 'popup')) && !$m_id)
{
	$mode = 'manage';
}

// Reset the module mode based on the given permissions
if (($mode == 'add' && !$allow_add) || ($mode == 'edit' && !$allow_edit) || ($mode == 'delete' && !$allow_delete))
{
	$sql = 'SELECT meeting_by_user FROM ' . MEETING_DATA_TABLE . "
		WHERE meeting_id = $m_id";
	$result = $db->sql_query($sql);
	$meeting_creator = $db->sql_fetchfield('meeting_by_user');
	$db->sql_freeresult($result);
	
	if ($meeting_creator == $user->data['user_id'])
	{
		$mbu = true;
	}
	else
	{
		$mbu = false;
	}

	if ($mode != 'add' && !$mbu)
	{
		$mode = 'manage';
		$m_id = 0;
	}
}

if ($sign_on_edit)
{
	$action = 'sign_on';
	$mode = 'detail';
}

if ($sign_off)
{
	$action = 'sign_off';
	$mode = 'detail';
}

// Set the needed template file
$meeting_html = '';
if ($mode == 'popup')
{
	$meeting_html = '_popup';
}
else if ($mode == 'mail')
{
	$meeting_html = '_email';
}

$template->set_filenames(array(
	'body' => "meeting/meeting{$meeting_html}.html")
);

// Prepare basic link for various form actions
$basic_values_start	= "sort_field=$sort_field&amp;sort_order=$sort_order&amp;filter_by=$filter_by&amp;filter=$filter&amp;closed=$closed&amp;view=$view&amp;m_cal_month=$m_cal_month&amp;m_cal_year=$m_cal_year";
$basic_values_page	= $basic_values_start . "&amp;meeting_signon=$meeting_signon&amp;meeting_approve=$meeting_approve";
$basic_values		= $basic_values_page . "&amp;start=$start";
$basic_link			= append_sid("{$phpbb_root_path}meeting.$phpEx?mode=$mode", $basic_values);
$basic_link_smode	= append_sid("{$phpbb_root_path}meeting.$phpEx?$basic_values");
$basic_link_page	= append_sid("{$phpbb_root_path}meeting.$phpEx?mode=$mode", $basic_values_page);
$basic_link_start	= append_sid("{$phpbb_root_path}meeting.$phpEx?mode=manage", $basic_values_start . "&amp;start=$start");

// Prepare filter settings
$sql_filter = ( $filter_by == 'none' ) ? '' : (($filter) ? " WHERE $filter_by LIKE ('%$filter%')" : '' );

// Generate page title and set template
switch ($mode)
{
	case 'mail':
		$page_title = 'MEETING_MAIL';
		$m_nav_link	= $basic_link_smode . "&amp;mode=detail&amp;m_id=$m_id";
		$m_nav_name	= $user->lang['MEETING_DETAIL'];
	break;

	case 'popup':
		$page_title = 'MEETING';
		$m_nav_link	= '';
		$m_nav_name	= '';
	break;

	case 'add':
		$page_title = 'MEETING_ADD';
		$m_nav_link	= '';
		$m_nav_name	= '';
		$template->assign_var('S_MEETING_EDIT', true);
	break;

	case 'edit':
		$page_title = 'MEETING_EDIT';
		$m_nav_link	= $basic_link_smode . "&amp;mode=detail&amp;m_id=$m_id";
		$m_nav_name	= $user->lang['MEETING_DETAIL'];
		$template->assign_var('S_MEETING_EDIT', true);
	break;

	case 'delete':
		$page_title = 'MEETING_DELETE';
		$m_nav_link	= $basic_link_smode . "&amp;mode=detail&amp;m_id=$m_id";
		$m_nav_name	= $user->lang['MEETING_DETAIL'];
	break;

	case 'detail':
		$page_title = 'MEETING_DETAIL';
		$m_nav_link	= '';
		$m_nav_name	= '';
		$template->assign_var('S_MEETING_DETAIL', true);
	break;

	default:
		$m_nav_link	= '';
		$m_nav_name	= '';
		if ($view == 'cal')
		{
			$page_title = 'MEETING_CALENDAR';
			$template->assign_var('S_MEETING_CAL', true);
		}
		else
		{
			$page_title = 'MEETING_MANAGE';
			$template->assign_var('S_MEETING_MANAGE', true);
		}
}

$page_title = $user->lang[$page_title];

$meeting_nav_link[] = array('m_link'	=> $basic_link_start, 'm_name'	=> $user->lang['MEETING']);
$meeting_nav_link[] = array('m_link'	=> $m_nav_link, 'm_name'	=> $m_nav_name);
$meeting_nav_link[] = array('m_link'	=> '', 'm_name'	=> $page_title);

for ($i = 0; $i < sizeof($meeting_nav_link); $i++)
{
	if ($meeting_nav_link[$i]['m_name'])
	{
		$template->assign_block_vars('meeting_nav', array(
			'NAME'		=> $meeting_nav_link[$i]['m_name'],
			'U_LINK'	=> $meeting_nav_link[$i]['m_link'],
		));
	}
}

// Display the current MOD release and home link
$template->assign_vars(array(
	'L_PAGE_TITLE'		=> $page_title,
	'MEETING_VERSION'	=> $user->lang['MEETING_VERSION'],
	'U_MEETING'			=> $basic_link_start,
));

page_header($page_title);

/*
* And now include the choosen module
*/		
switch($mode)
{
	case 'mail':
		$sql = 'SELECT meeting_by_user, meeting_subject FROM ' . MEETING_DATA_TABLE . "
			WHERE meeting_id = $m_id";
		$result = $db->sql_query($sql);
		$meeting_by_user = $db->sql_fetchfield('meeting_by_user', 0);
		$meeting_subject = $db->sql_fetchfield('meeting_subject', 0);
		$db->sql_freeresult($result);

		if ($meeting_by_user == $user->data['user_id'] || $is_admin || $is_mod)
		{
			$allow_mail = true;
		}
		else
		{
			redirect($basic_link_smode . "&amp;mode=detail&amp;m_id=$m_id");
		}
	
		// Sending this email
		if ($submit && $allow_mail)
		{
			if (!check_form_key('meeting_email'))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			if ($meeting_subject && $meeting_mail_subject && $meeting_mail_text )
			{
				switch ($mail_to)
				{
					case 1:
						$sql_meeting_where = ' AND meeting_sure <> 0 ';
						break;
					case 2:
						$sql_meeting_where = ' AND meeting_sure = 0 ';
						break;
					default:
						$sql_meeting_where = '';
				}
		
				if (!class_exists('messenger'))
				{
					include($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
					$messenger = new messenger();
				}

				$sql = 'SELECT u.username, u.user_email, u.user_lang FROM ' . MEETING_USER_TABLE . ' m, ' . USERS_TABLE . " u
					WHERE m.user_id = u.user_id
						AND m.meeting_id = $m_id
						$sql_meeting_where";

				$result = $db->sql_query($sql);
				
				while ($row = $db->sql_fetchrow($result))
				{
					$messenger->template('meeting_email', $row['user_lang']);
					$messenger->to($row['user_email'], $row['username']);
					$messenger->subject($meeting_mail_subject);
					
					$messenger->assign_vars(array(
						'BOARD_EMAIL'			=> $config['board_email'],
						'SITENAME'				=> $config['sitename'],
						'MEETING_MAIL_TEXT'		=> $meeting_mail_text,
						'MEETING_MAIL_SUBJECT'	=> $meeting_mail_subject,
						'MEETING_SUBJECT'		=> $meeting_subject,
						'USERNAME'				=> $row['username'],
						'FROM_USER'				=> $user->data['username'],
						'U_MEETING_MAIL_LINK'	=> generate_board_url() . "/meeting.$phpEx?mode=detail&m_id=$m_id",
					));
					
					$messenger->send(NOTIFY_EMAIL);
				}

				$db->sql_freeresult($result);

				$messenger->save_queue();
			}	

			redirect($basic_link_smode . "&amp;mode=detail&amp;m_id=$m_id");
		}

		add_form_key('meeting_email');
	
		$template->assign_vars(array(
			'L_MEETING'			=> $user->lang['MEETING_VIEWLIST'],
			'L_MEETING_DETAIL'	=> $meeting_subject,
		
			'MEETING_SUBJECT'	=> $meeting_subject,
			'S_FORM_ACTION'		=> $basic_link . "&amp;m_id=$m_id",
		
			'U_MEETING_DETAIL'	=> $basic_link_smode . "&amp;mode=detail&amp;m_id=$m_id",
		));

	break;

	case 'popup':

		$sql = 'SELECT meeting_subject, meeting_time FROM ' . MEETING_DATA_TABLE . "
			WHERE meeting_id = $m_id";
		$result = $db->sql_query($sql);
		$meeting_title	= $db->sql_fetchfield('meeting_subject');
		$meeting_time	= $db->sql_fetchfield('meeting_time');
		$db->sql_freeresult($result);
	
		$sql = 'SELECT username FROM ' . USERS_TABLE . "
			WHERE user_id = $user_id";
		$result = $db->sql_query($sql);
		$current_username = $db->sql_fetchfield('username');
		$db->sql_freeresult($result);
	
		$sql = 'SELECT guest_prename, guest_name FROM ' . MEETING_GUESTNAMES_TABLE . "
			WHERE meeting_id = $m_id
				AND user_id = $user_id
			ORDER BY guest_name, guest_prename";
		$result = $db->sql_query($sql);
	
		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('guest_name_row', array(
				'GUEST_PRENAME'	=> $row['guest_prename'],
				'GUEST_NAME'	=> $row['guest_name'])
			);
		}

		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'MEETING_TITLE'		=> $meeting_title,
			'MEETING_TIME'		=> $meeting_time,
			'USERNAME'			=> $current_username,
		));		
	
	break;

	case 'add':
	case 'edit':

		// Save the meeting
		if ($submit)
		{
			if (!check_form_key('meeting_save'))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$meeting_time = meeting_date_save($m_date, $m_time);
			if (!$meeting_time)
			{
				trigger_error($user->lang['MEETING_TIME_WRONG'], E_USER_WARNING);
			}

			$meeting_end = meeting_date_save($e_date, $e_time);
			if (!$meeting_end)
			{
				trigger_error($user->lang['MEETING_END_WRONG'], E_USER_WARNING);
			}

			$meeting_until = meeting_date_save($u_date, $u_time);
			if (!$meeting_time)
			{
				trigger_error($user->lang['MEETING_UNTIL_WRONG'], E_USER_WARNING);
			}

			$meeting_until	= ( $meeting_until > $meeting_time ) ? $meeting_time : $meeting_until;
			$meeting_end	= ( $meeting_end < $meeting_time ) ? $meeting_time : $meeting_end;
		
			$allow_bbcode	= ($config['allow_bbcode']) ? true : false;
			$allow_urls		= true;
			$allow_smilies	= ($config['allow_smilies']) ? true : false;
			$uid = $bitfield = '';
			$flags = 0;
			
			generate_text_for_storage($meeting_desc, $uid, $bitfield, $flags, $allow_bbcode, true, $allow_smilies);

			if ($m_id)
			{
				$sql = 'DELETE FROM ' . MEETING_USERGROUP_TABLE . "
					WHERE meeting_id = $m_id";
				$db->sql_query($sql);
			}
			else
			{
				$sql = 'SELECT MAX(meeting_id) AS max_id FROM ' . MEETING_DATA_TABLE;
				$result = $db->sql_query($sql);
				$next_id = $db->sql_fetchfield('max_id') + 1;
				$db->sql_freeresult($result);
			}
		
			$next_id = ($m_id) ? $m_id : $next_id;

			if (isset($group_id) && $group_id[0] == -1 && !$meeting_places)
			{
				$sql = 'SELECT COUNT(user_id) AS total_users FROM ' . USERS_TABLE . '
					WHERE ' . $db->sql_in_set('user_type', array(USER_FOUNDER, USER_NORMAL));
				$result = $db->sql_query($sql);
				$meeting_places = $db->sql_fetchfield('total_users');
				$db->sql_freeresult($result);
			}
		
			if (isset($group_id) && $group_id[0] != -1)
			{
				$usergroups = '';

				$sql = 'SELECT COUNT(DISTINCT ug.user_id) AS total_users FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
					WHERE ug.group_id = g.group_id
						AND ug.user_pending <> ' . TRUE . '
						AND ' . $db->sql_in_set('g.group_id', $group_id);
				$result = $db->sql_query($sql);
				$places = $db->sql_fetchfield('total_users');
				$db->sql_freeresult($result);
		
				$meeting_places = ( $places < $meeting_places || $meeting_places == 0 ) ? $places : $meeting_places;
			}
		
			if (sizeof($group_id))
			{
				if ($group_id[0] == -1)
				{
					$sql = 'INSERT INTO ' . MEETING_USERGROUP_TABLE . $db->sql_build_array('INSERT', array(
						'meeting_id'	=> $next_id,
						'meeting_group'	=> -1,
					));
					$db->sql_query($sql);
				}
				else
				{
					for ($i = 0; $i < sizeof($group_id); $i++)
					{
						$sql = 'INSERT INTO ' . MEETING_USERGROUP_TABLE . $db->sql_build_array('INSERT', array(
							'meeting_id'	=> $next_id,
							'meeting_group'	=> intval($group_id[$i]),
						));
						$db->sql_query($sql);
					}
				}
			}

			if ($meeting_start_value < 0)
			{
				$meeting_start_value = 0;
			}

			if ($meeting_recure_value < 1)
			{
				$meeting_recure_value = 1;
			}

			if ($meeting_start_value > $meeting_recure_value)
			{
				$meeting_start_value = 0;
				$meeting_recure_value = 1;
			}
			
			if ($m_id)
			{
				$sql = 'UPDATE ' . MEETING_DATA_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'meeting_time'			=> $meeting_time,
					'meeting_end'			=> $meeting_end,
					'meeting_until'			=> $meeting_until,
					'meeting_location'		=> $meeting_location,
					'meeting_subject'		=> $meeting_subject,
					'meeting_desc'			=> $meeting_desc,
					'meeting_link'			=> $meeting_link,
					'meeting_places'		=> $meeting_places,
					'meeting_edit_by_user'	=> $user->data['user_id'],
					'meeting_start_value'	=> $meeting_start_value,
					'meeting_recure_value'	=> $meeting_recure_value,
					'meeting_notify'		=> $meeting_notify,
					'meeting_guest_overall'	=> $meeting_guest_overall,
					'meeting_guest_single'	=> $meeting_guest_single,
					'meeting_guest_names'	=> $meeting_guest_names,
					'uid'					=> $uid,
					'bitfield'				=> $bitfield,
					'flags'					=> $flags)) . "	WHERE meeting_id = $m_id";
			}
			else
			{
				$sql = 'INSERT INTO ' . MEETING_DATA_TABLE . $db->sql_build_array('INSERT', array(
					'meeting_id'			=> $next_id,
					'meeting_time'			=> $meeting_time,
					'meeting_end'			=> $meeting_end,
					'meeting_until'			=> $meeting_until,
					'meeting_location'		=> $meeting_location,
					'meeting_subject'		=> $meeting_subject,
					'meeting_desc'			=> $meeting_desc,
					'meeting_link'			=> $meeting_link,
					'meeting_places'		=> $meeting_places,
					'meeting_by_user'		=> $user->data['user_id'],
					'meeting_edit_by_user'	=> $user->data['user_id'],
					'meeting_start_value'	=> $meeting_start_value,
					'meeting_recure_value'	=> $meeting_recure_value,
					'meeting_notify'		=> $meeting_notify,
					'meeting_guest_overall'	=> $meeting_guest_overall,
					'meeting_guest_single'	=> $meeting_guest_single,
					'meeting_guest_names'	=> $meeting_guest_names,
					'uid'					=> $uid,
					'bitfield'				=> $bitfield,
					'flags'					=> $flags));
			}

			$db->sql_query($sql);

			$meeting_save_text = ($m_id) ? $user->lang['MEETING_DATA_UPDATED'] : $user->lang['MEETING_DATA_STORED'];
			$message = $meeting_save_text . '<br /><br />' . sprintf($user->lang['CLICKMEETINGBACK'], '<a href="' . $basic_link_smode . '&amp;mode=manage">', '</a>');
			trigger_error($message);
		}

		$usergroups = array();

		$sql = 'SELECT group_id, group_name, group_meeting_create, group_type FROM ' . GROUPS_TABLE . '
			WHERE group_meeting_select = ' . true . '
			ORDER BY group_name';
		$result = $db->sql_query($sql);
	
		$s_meeting_usergroup = '<select name="group_id[]" multiple="multiple" size="10">';
		$s_meeting_usergroup .= '<option value="-1"' . (($mode == 'add') ? 'selected="selected"' : '') . '>' . $user->lang['MEETING_ALL_USERS'] . '</option>';
	
		while ($row = $db->sql_fetchrow($result))
		{
			$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];

			$s_meeting_usergroup .= '<option value="' . $row['group_id'] . '">' . $group_name . '</option>';
			$usergroups[] = $row['group_id'];
		}
	
		$s_meeting_usergroup .= '</select>';
	
		$db->sql_freeresult($result);

		$meeting_location			= '';
		$meeting_subject			= '';
		$meeting_desc				= '';
		$meeting_link				= '';
		$meeting_places				= 0;
		$meeting_time				= time();
		$meeting_end				= time();
		$meeting_until				= time();
		$meeting_start_value		= 0;
		$meeting_recure_value		= 5;
		$meeting_guest_overall		= 0;
		$meeting_guest_single		= 0;
		$meeting_guest_names_yes	= '';
		$meeting_guest_names_no		= 'checked="checked"';
		$meeting_by_user			= sprintf($user->lang['MEETING_CREATE_BY'], append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" . $user->data['user_id']), $user->data['username']);
		$meeting_edit_by_user		= '';

		$s_hidden_fields = array(
			'start'	=> $start,
		);
		
		// Get the data for the choosen meeting or display an empty form 
		if ($m_id)
		{
			$s_hidden_fields = array_merge($s_hidden_fields, array(
				'm_id'	=> $m_id,
			));

			$sql = 'SELECT meeting_group FROM ' . MEETING_USERGROUP_TABLE . "
				WHERE meeting_id = $m_id
				AND meeting_group <> -1";
			$result = $db->sql_query($sql);
			$total_saved_groups = $db->sql_affectedrows($result);
			
			if (!$total_saved_groups)
			{
				$s_meeting_usergroup = str_replace('value="-1">', 'value="-1" selected="selected">', $s_meeting_usergroup);
			}
			else
			{		
				while ( $row = $db->sql_fetchrow($result) )
				{
					if (in_array($row['meeting_group'], $usergroups))
					{
						$s_meeting_usergroup = str_replace('value="' . ($row['meeting_group']) . '">', 'value="' . ($row['meeting_group']) . '" selected="selected">', $s_meeting_usergroup);
					}
				}
			}
			$db->sql_freeresult($result);

			$sql = 'SELECT
				m.*,
				u1.username as create_username, u1.user_id as create_user_id,
				u2.username as edit_username, u2.user_id as edit_user_id
				FROM ' . MEETING_DATA_TABLE . ' m, ' . USERS_TABLE . ' u1, ' . USERS_TABLE . " u2
				WHERE m.meeting_id = $m_id
					AND m.meeting_by_user = u1.user_id
					AND m.meeting_edit_by_user = u2.user_id";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);

			$meeting_time				= $row['meeting_time'];
			$meeting_end				= $row['meeting_end'];
			$meeting_until				= $row['meeting_until'];
			$meeting_location			= $row['meeting_location'];
			$meeting_subject			= $row['meeting_subject'];
			$meeting_desc				= $row['meeting_desc'];
			$meeting_link				= $row['meeting_link'];
			$meeting_places				= $row['meeting_places'];
			$meeting_by_username		= $row['create_username'];
			$meeting_by_user_id			= append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=".$row['create_user_id']);
			$meeting_edit_by_username	= $row['edit_username'];
			$meeting_edit_by_user_id	= append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=".$row['edit_user_id']);
			$meeting_start_value		= $row['meeting_start_value'];
			$meeting_recure_value		= $row['meeting_recure_value'];
			$meeting_notify				= $row['meeting_notify'];
			$meeting_guest_overall		= $row['meeting_guest_overall'];
			$meeting_guest_single		= $row['meeting_guest_single'];
			$meeting_guest_names_yes	= ($row['meeting_guest_names']) ? 'checked="checked"' : '';
			$meeting_guest_names_no		= (!$row['meeting_guest_names']) ? 'checked="checked"' : '';

			$text_ary		= generate_text_for_edit($meeting_desc, $row['uid'], $row['flags']);
			$meeting_desc	= $text_ary['text'];

			$db->sql_freeresult($result);

			$meeting_by_user		= sprintf($user->lang['MEETING_CREATE_BY'], $meeting_by_user_id, $meeting_by_username);
			$meeting_edit_by_user	= sprintf($user->lang['MEETING_EDIT_BY'], $meeting_edit_by_user_id, $meeting_edit_by_username);
		}

		// Preset time fields
		$m_date		= meeting_date_edit('m_date', (int) $meeting_time);
		$e_date		= meeting_date_edit('e_date', (int) $meeting_end);
		$u_date		= meeting_date_edit('u_date', (int) $meeting_until);

		// Status for HTML, BBCode, Smilies, Images and Flash,
		$bbcode_status	= ($config['allow_bbcode']) ? true : false;
		$smilies_status	= ($bbcode_status && $config['allow_smilies']) ? true : false;
		$img_status		= true;
		$url_status		= ($config['allow_post_links']) ? true : false;
		$flash_status	= ($config['allow_post_flash']) ? true : false;
		$quote_status	= true;

		if (!class_exists('bbcode'))
		{
			include($phpbb_root_path . "includes/bbcode.$phpEx"); 
		}

		if (!function_exists('generate_smilies'))
		{
			include($phpbb_root_path . "includes/functions_posting.$phpEx"); 
		}

		if (!function_exists('display_custom_bbcodes'))
		{
			include($phpbb_root_path . "includes/functions_display.$phpEx"); 
		}

		$user->add_lang('posting');
		display_custom_bbcodes();

		add_form_key('meeting_save');

		$template->assign_vars(array(
			'MODULE_NAME'			=> $page_title,

			'MEETING_DATE'			=> $m_date,
			'MEETING_DATE_END'		=> $e_date,
			'MEETING_DATE_UNTIL'	=> $u_date,

			'MEETING_LOCATION'		=> $meeting_location,
			'MEETING_SUBJECT'		=> $meeting_subject,
			'MEETING_DESC'			=> $meeting_desc,
			'MEETING_LINK_D'		=> $meeting_link,
			'MEETING_PLACES'		=> $meeting_places,
			'MEETING_BY_USER'		=> $meeting_by_user,
			'MEETING_EDIT_BY_USER'	=> $meeting_edit_by_user,
			'MEETING_START_VALUE'	=> $meeting_start_value,
			'MEETING_RECURE_VALUE'	=> $meeting_recure_value,

			'MEETING_NOTIFY_YES'	=> ($meeting_notify) ? 'checked="checked"' : '',
			'MEETING_NOTIFY_NO'		=> (!$meeting_notify) ? 'checked="checked"' : '',

			'MEETING_GUEST_OVERALL'	=> $meeting_guest_overall,
			'MEETING_GUEST_SINGLE'	=> $meeting_guest_single,

			'MEETING_GUEST_NAMES_YES'	=> $meeting_guest_names_yes,
			'MEETING_GUEST_NAMES_NO'	=> $meeting_guest_names_no,

			'S_MEETING_USERGROUP'		=> $s_meeting_usergroup,

			'S_BBCODE_ALLOWED'	=> $bbcode_status,
			'S_BBCODE_IMG'		=> $img_status,
			'S_BBCODE_URL'		=> $url_status,
			'S_BBCODE_FLASH'	=> $flash_status,
			'S_BBCODE_QUOTE'	=> $quote_status,

			'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
			'S_FORM_ACTION'		=> $basic_link,
		));

	break;

	case 'delete':
		// Please confirm the deleting. The better way.
		if (!$confirm)
		{
			$template->set_filenames(array(
				'body' => 'confirm_body.html')
			);
		
			$s_hidden_fields = array(
				'action'	=> 'delete',
				'm_id'		=> $m_id,
				'start'		=> $start,
			);

			$template->assign_vars(array(
				'MESSAGE_TITLE'		=> $user->lang['MEETING_DELETE'],
				'MESSAGE_TEXT'		=> $user->lang['MEETING_DELETE_EXPLAIN'],
	
				'YES_VALUE'			=> $user->lang['YES'],
		
				'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
				'S_CONFIRM_ACTION'	=> $basic_link,
			));
		
			page_footer();
		}
		else
		{
			// Now we will delete. Good bye meeting :-)
			$sql = 'DELETE FROM ' . MEETING_COMMENT_TABLE . "
				WHERE meeting_id = $m_id";
			$db->sql_query($sql);
		
			$sql = 'DELETE FROM ' . MEETING_DATA_TABLE . "
				WHERE meeting_id = $m_id";
			$db->sql_query($sql);
		
			$sql = 'DELETE FROM ' . MEETING_GUESTNAMES_TABLE . "
				WHERE meeting_id = $m_id";
			$db->sql_query($sql);
	
			$sql = 'DELETE FROM ' . MEETING_USER_TABLE . "
				WHERE meeting_id = $m_id";
			$db->sql_query($sql);
		
			$sql = 'DELETE FROM ' . MEETING_USERGROUP_TABLE . "
				WHERE meeting_id = $m_id";
			$db->sql_query($sql);
		
			redirect($basic_link_smode . '&amp;mode=manage');
		}

	break;

	case 'detail':

		if ($action == 'approve_comment' && !$is_user)
		{
			$sql = 'UPDATE ' . MEETING_COMMENT_TABLE . "
				SET approve = 1
				WHERE comment_id = $c_id
					AND meeting_id = $m_id";
			$db->sql_query($sql);

			redirect($basic_link . "&amp;m_id=$m_id");
		}

		if ($action == 'edit_comment')
		{
			$save = request_var('save', 0);

			if ($submit && $save)
			{
				if (!check_form_key('meeting_com'))
				{
					trigger_error('FORM_INVALID', E_USER_WARNING);
				}

				$sql = 'SELECT approve FROM ' . MEETING_COMMENT_TABLE . "
					WHERE user_id = $c_user_id
						AND comment_id = $c_id
						AND meeting_id = $m_id";
				$result = $db->sql_query($sql);
				$comment_approve = $db->sql_fetchfield('approve');
				$submit_check = $db->sql_affectedrows($result);
				$db->sql_freeresult($result);
			
				if ($meeting_comment)
				{
					$meeting_edit_time = time();
					
					$allow_bbcode	= ($config['allow_bbcode']) ? true : false;
					$allow_urls		= true;
					$allow_smilies	= ($config['allow_smilies']) ? true : false;
					$uid = $bitfield = '';
					$flags = 0;
					
					generate_text_for_storage($meeting_comment, $uid, $bitfield, $flags, $allow_bbcode, true, $allow_smilies);

					if ($submit_check)
					{
						$approve = (!$is_user) ? 1 : $comment_approve;
			
						$sql = 'UPDATE ' . MEETING_COMMENT_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
							'meeting_comment'	=> $meeting_comment,
							'approve'			=> $approve,
							'uid'				=> $uid,
							'bitfield'			=> $bitfield,
							'flags'				=> $flags)) . '
							WHERE ' . $db->sql_build_array("SELECT", array(
								'meeting_id'	=> $m_id,
								'user_id'		=> $c_user_id,
								'comment_id'	=> $c_id));
					}
					else
					{
						$approve = ($is_user) ? 0 : 1;
			
						$sql = 'INSERT INTO ' . MEETING_COMMENT_TABLE . $db->sql_build_array('INSERT', array(
							'user_id'			=> $user->data['user_id'],
							'meeting_id	'		=> $m_id,
							'meeting_comment'	=> $meeting_comment,
							'meeting_edit_time'	=> $meeting_edit_time,
							'approve'			=> $approve,
							'uid'				=> $uid,
							'bitfield'			=> $bitfield,
							'flags'				=> $flags));
					}
				}
				else if (!$meeting_comment && $comment_approve)
				{
					$sql = 'DELETE FROM ' . MEETING_COMMENT_TABLE . "
						WHERE meeting_id = $m_id
							AND user_id = $c_user_id
							AND comment_id = $c_id";
				}

				$db->sql_query($sql);

				redirect($basic_link . "&amp;m_id=$m_id");
			}
			
			if ($c_user_id && $c_id)
			{
				$sql = 'SELECT m.comment_id, m.meeting_comment, m.uid, m.flags, u.username, u.user_id
					FROM ' . MEETING_COMMENT_TABLE . ' m, ' . USERS_TABLE . ' u
					WHERE m.user_id = u.user_id AND ' . $db->sql_build_array('SELECT', array(
						'm.user_id'		=> $c_user_id,
						'm.meeting_id'	=> $m_id,
						'm.comment_id'	=> $c_id));
				$result = $db->sql_query($sql);
				
				$row = $db->sql_fetchrow($result);
		
				$current_user		= $row['username'];
				$meeting_comment	= $row['meeting_comment'];
		
				$uid				= $row['uid'];
				$flags				= $row['flags'];
				$text_ary			= generate_text_for_edit($meeting_comment, $uid, $flags);
				$meeting_comment	= $text_ary['text'];	
		
				$comment_mode		= $user->lang['MEETING_EDIT_COMMENT'];
		
				$db->sql_freeresult($result);
			}
			else
			{
				$c_user_id			= $user->data['user_id'];
				$c_id				= 0;
				$current_user		= $user->data['username'];
				$meeting_comment	= '';
				
				$comment_mode		= $user->lang['MEETING_POST_COMMENT'];
				
				if ($is_user)
				{
					$template->assign_var('S_COMMENT_HINT', true);
				}
			}
		
			$comment_user = '<a href="' . append_sid("{$phpbb_root_path}memberlist.$phpEx?mode=viewprofile&amp;u=" . $c_user_id) . '">' . $current_user . '</a>';
		
			$s_hidden_comment_fields = array(
				'c_id'		=> $c_id,
				'c_user_id'	=> $c_user_id,
				'action'	=> 'edit_comment',
				'save'		=> true,
			);

			add_form_key('meeting_com');
		
			$template->assign_var('S_EDIT_COMMENT', true);
			$template->assign_vars(array(
				'USERNAME'			=> $comment_user,
				'MEETING_COMMENT'	=> $meeting_comment,
				'COMMENT_EDIT_MODE'	=> $comment_mode,
		
				'S_FORM_COMMENT_ACTION'		=> $basic_link,
				'S_HIDDEN_COMMENT_FIELDS'	=> build_hidden_fields($s_hidden_comment_fields),
			));
		}
		
		if ($action == 'delete_comment')
		{
			if (!$confirm)
			{
				$template->set_filenames(array(
					'body' => 'confirm_body.html')
				);
			
				$s_hidden_fields = array(
					'action'	=> 'delete_comment',
					'c_id'		=> $c_id,
					'm_id'		=> $m_id,
					'c_user_id'	=> $c_user_id,
					'start'		=> $start,
					'action'	=> 'delete_comment',
				);
			
				$template->assign_vars(array(
					'MESSAGE_TITLE'		=> $user->lang['DELETE'],
					'MESSAGE_TEXT'		=> $user->lang['CONFIRM_OPERATION'],
		
					'YES_VALUE'			=> $user->lang['YES'],
			
					'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
					'S_CONFIRM_ACTION'	=> $basic_link,
				));
			
				page_footer();
			}

			$sql = 'DELETE FROM ' . MEETING_COMMENT_TABLE . "
				WHERE meeting_id = $m_id
					AND comment_id = $c_id";
			$sql .= ($is_user) ? ' AND user_id = ' . $user->data['user_id'] : '';
			$db->sql_query($sql);
		}

		if ($action == 'sign_on')
		{
			if ($sign_user == 'other')
			{
				$meeting_user = $user_id;
			}
			else
			{
				$meeting_user = $user->data['user_id'];
				$allow_sign_onoff = true;
			}
		
			if ($meeting_user == -1)
			{
				redirect($basic_link_smode . '&amp;mode=manage');
			}
		
			$meeting_guests = ($meeting_sure) ? $meeting_guests : 0;
			
			$sql = 'SELECT username FROM ' . USERS_TABLE . "
				WHERE user_id = $meeting_user";
			$result = $db->sql_query($sql);
			$signed_username = $db->sql_fetchfield('username');
			$db->sql_freeresult($result);

			$sql = 'SELECT user_id FROM ' . MEETING_USER_TABLE . "
				WHERE user_id = $meeting_user
					AND meeting_id = $m_id";
			$result = $db->sql_query($sql);
			$submit_check = $db->sql_affectedrows($result);
			$db->sql_freeresult($result);
		
			$sql = 'SELECT	
				m.meeting_by_user, m.meeting_subject, m.meeting_guest_overall, m.meeting_guest_single, m.meeting_guest_names, m.meeting_notify,
				u.user_email, u.user_lang, u.username
				FROM ' . MEETING_DATA_TABLE . ' m, ' . USERS_TABLE . " u
				WHERE m.meeting_id = $m_id
					AND m.meeting_by_user = u.user_id";
			$result = $db->sql_query($sql);
		
			$row = $db->sql_fetchrow($result);

			$meeting_subject = $row['meeting_subject'];
			$meeting_notify = $row['meeting_notify'];
			$meeting_guest_overall = $row['meeting_guest_overall'];
			$meeting_guest_single = $row['meeting_guest_single'];
			$meeting_gnames = $row['meeting_guest_names'];
			$mail_to_user = $row['username'];
			$user_email = $row['user_email'];
			$user_lang = $row['user_lang'];
			$meeting_creator = $row['meeting_by_user'];

			$db->sql_freeresult($result);

			if ($meeting_creator == $user->data['user_id'] && $config['meeting_sign_perm'] == 3)
			{
				$allow_sign_onoff = true;
			}

			if (!$allow_sign_onoff)
			{
				redirect($basic_link_smode . '&amp;mode=manage');
			}

			$sql = 'SELECT SUM(meeting_guests) AS total_guests FROM ' . MEETING_USER_TABLE . "
				WHERE meeting_id = $m_id
					AND user_id <> $meeting_user";
			$result = $db->sql_query($sql);	
			$total_guests = $db->sql_fetchfield('total_guests');
			$db->sql_freeresult($result);
		
			$remain_guests = 0;
		
			if ($meeting_guest_overall)
			{
				$remain_guests = $meeting_guest_overall - $total_guests;
			}
		
			if ($meeting_guest_single)
			{
				$remain_guests = $meeting_guest_single;
				if ($meeting_guest_overall && $remain_guests > ($meeting_guest_overall - $total_guests))
				{
					$remain_guests = $meeting_guest_overall - $total_guests;
				}
			}
		
			if ($meeting_guests > $remain_guests)
			{
				trigger_error(sprintf($user->lang['MEETING_REMAIN_GUEST_TEXT'], $meeting_guests, $remain_guests), E_USER_WARNING);
			}
		
			if (!$submit_check)
			{
				$sql = 'INSERT INTO ' . MEETING_USER_TABLE . $db->sql_build_array('INSERT', array(
					'user_id'			=> $meeting_user,
					'meeting_id'		=> $m_id,
					'meeting_sure'		=> $meeting_sure,
					'meeting_guests'	=> $meeting_guests
				));
				$db->sql_query($sql);
		
				if ($meeting_sure <> 0)
				{
					$subject = $user->lang['MEETING_JOIN_MESSAGE'];
					$message = sprintf($user->lang['MEETING_JOIN_USER'], $signed_username, $meeting_subject);
				}
				else
				{
					$subject = $user->lang['MEETING_UNWILL_MESSAGE'];
					$message = sprintf($user->lang['MEETING_UNWILL_USER'], $signed_username, $meeting_subject);
				}
			}
			else
			{
				$sql = 'UPDATE ' . MEETING_USER_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
					'meeting_sure'		=> $meeting_sure,
					'meeting_guests'	=> $meeting_guests,
				)) . "	WHERE meeting_id = $m_id
						AND user_id = $meeting_user";
				$db->sql_query($sql);
		
				if ($meeting_sure <> 0)
				{
					$subject = $user->lang['MEETING_CHANGE_MESSAGE'];
					$message = sprintf($user->lang['MEETING_CHANGE_USER'], $signed_username, $meeting_subject);
				}
				else
				{
					$subject = $user->lang['MEETING_UNWILL_MESSAGE'];
					$message = sprintf($user->lang['MEETING_UNWILL_USER'], $signed_username, $meeting_subject);
				}
			}
		
			$sql = 'DELETE FROM ' . MEETING_GUESTNAMES_TABLE . "
				WHERE meeting_id = $m_id
					AND user_id = $meeting_user";
			$db->sql_query($sql);
		
			if ($meeting_gnames && $meeting_sure)
			{
				$guest_counter = 0;

				$meeting_guest_prename	= request_var('meeting_guest_prename', array(0 => ''), true);
				$meeting_guest_name		= request_var('meeting_guest_name', array(0 => ''), true);
				
				for ($i = 0; $i < sizeof($meeting_guest_name); $i++)
				{
					$mgpn = utf8_normalize_nfc($meeting_guest_prename[$i]);
					$mgna = utf8_normalize_nfc($meeting_guest_name[$i]);
		
					if ($mgpn && $mgna)
					{
						$sql = 'INSERT INTO ' . MEETING_GUESTNAMES_TABLE . $db->sql_build_array('INSERT', array(
							'meeting_id'	=> $m_id,
							'user_id'		=> $meeting_user,
							'guest_prename'	=> $db->sql_escape($mgpn),
							'guest_name	'	=> $db->sql_escape($mgna)
						));
						$db->sql_query($sql);
						$guest_counter++;
					}
				}
		
				if ($guest_counter <> $meeting_guests)
				{
					$meeting_guests = $guest_counter;
		
					$sql = 'UPDATE ' . MEETING_USER_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
						'meeting_guests' => $guest_counter
					)) . "	WHERE meeting_id = $m_id
							AND user_id = $meeting_user";
					$db->sql_query($sql);
				}
			}
		
			if ($config['meeting_notify'] || $meeting_notify)
			{
				if (!class_exists('messenger'))
				{
					include($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
					$messenger = new messenger();
				}
				
				$messenger->template('admin_send_email', $user_lang);
				$messenger->to($user_email, $mail_to_user);
				$messenger->subject($subject);
				
				$messenger->assign_vars(array(
					'CONTACT_EMAIL'	=> $config['board_email'],
					'SITENAME'		=> $config['sitename'],
					'EMAIL_SIG'		=> $config['board_email'],
					'MESSAGE'		=> $message,
				));
				
				$messenger->send(NOTIFY_EMAIL);
				$messenger->save_queue();
			}

			redirect($basic_link_smode . "&amp;mode=detail&amp;m_id=$m_id");
		}

		if ($action == 'sign_off' && $m_id)
		{
			if (!$confirm)
			{
				// Load header and templates
				$template->set_filenames(array(
					'body' => 'confirm_body.html')
				);

				if (!$user_id)
				{
					$user_id = $user->data['user_id'];
					$allow_sign_onoff = true;
				}

				$s_hidden_fields = array(
					'm_id'	=> $m_id,
					'u'		=> $user_id,
				);
			
				$template->assign_vars(array(
					'MESSAGE_TITLE'	=> $user->lang['MEETING_SIGN_OFF'],
					'MESSAGE_TEXT'	=> $user->lang['MEETING_SIGN_OFF_EXPLAIN'],
		
					'YES_VALUE'			=> $user->lang['YES'],
		
					'S_CONFIRM_ACTION'	=> $basic_link_smode . '&amp;mode=detail&amp;sign_off=1',
					'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
				));
		
				page_footer();
			}
		
			$sql = 'SELECT m.meeting_subject, m.meeting_notify, m.meeting_by_user,
				u.user_email, u.user_lang, u.username
				FROM ' . MEETING_DATA_TABLE . ' m, ' . USERS_TABLE . " u
				WHERE m.meeting_id = $m_id
					AND m.meeting_by_user = u.user_id";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);

			$meeting_subject = $row['meeting_subject'];
			$meeting_notify = $row['meeting_notify'];
			$meeting_by_user = $row['meeting_by_user'];
			$user_email = $row['user_email'];
			$user_lang = $row['user_lang'];
			$mail_to_user = $row['username'];

			$db->sql_freeresult($result);

			if ($meeting_by_user == $user->data['user_id'] && $config['meeting_sign_perm'] == 3)
			{
				$allow_sign_onoff = true;
			}
		
			if ($user->data['user_id'] != $user_id && $allow_sign_onoff)
			{
				$meeting_user = $user_id;
		
				$sql = 'SELECT username FROM ' . USERS_TABLE . "
					WHERE user_id = $meeting_user";
				$result = $db->sql_query($sql);
				$username = $db->sql_fetchfield('username');
				$db->sql_freeresult($result);
			}
			else
			{
				$meeting_user = $user->data['user_id'];
				$username = $user->data['username'];
			}
		
			$sql = 'DELETE FROM ' . MEETING_USER_TABLE . "
				WHERE meeting_id = $m_id
				AND user_id = $meeting_user";
			$db->sql_query($sql);
		
			$sql = 'DELETE FROM ' . MEETING_GUESTNAMES_TABLE . "
				WHERE meeting_id = $m_id
				AND user_id = $meeting_user";
			$db->sql_query($sql);
		
			if ($config['meeting_notify'] || $meeting_notify)
			{
				$subject = $user->lang['MEETING_UNJOIN_MESSAGE'];
				$message = sprintf($user->lang['MEETING_UNJOIN_USER'], $username, $meeting_subject);
		
				if (!class_exists('messenger'))
				{
					include($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
					$messenger = new messenger();
				}
				
				$messenger->template('admin_send_email', $user_lang);
				$messenger->to($user_email, $mail_to_user);
				$messenger->subject($subject);
				
				$messenger->assign_vars(array(
					'CONTACT_EMAIL'	=> $config['board_email'],
					'SITENAME'		=> $config['sitename'],
					'EMAIL_SIG'		=> $config['board_email'],
					'MESSAGE'		=> $message,
				));
				
				$messenger->send(NOTIFY_EMAIL);
				$messenger->save_queue();
			}
			
			redirect($basic_link_smode . "&amp;mode=detail&amp;m_id=$m_id");
		}

		$sql_array = array(
			'SELECT'	=> 'm.*, u1.username as create_username, u1.user_id as create_user_id, u2.username as edit_username, u2.user_id as edit_user_id',

			'FROM'		=> array(MEETING_DATA_TABLE => 'm'),
		);

		$sql_array['LEFT_JOIN'] = array();
		$sql_array['LEFT_JOIN'][] = array(
			'FROM'	=> array(USERS_TABLE	=> 'u1'),
			'ON'	=> 'u1.user_id = m.meeting_by_user'
		);
		$sql_array['LEFT_JOIN'][] = array(
			'FROM'	=> array(USERS_TABLE	=> 'u2'),
			'ON'	=> 'u2.user_id = m.meeting_edit_by_user'
		);

		$sql_array['WHERE'] = "m.meeting_id = $m_id";

		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
	
		$meeting_time				= $row['meeting_time'];
		$meeting_end				= $row['meeting_end'];
		$meeting_until				= $row['meeting_until'];
		$meeting_location			= $row['meeting_location'];
		$meeting_subject			= $row['meeting_subject'];
		$meeting_desc				= $row['meeting_desc'];
		$meeting_link				= $row['meeting_link'];
		$meeting_places				= $row['meeting_places'];
		$meeting_by_username		= ($row['create_username']) ? $row['create_username'] : '---';
		$meeting_by_user_id			= append_sid("{$phpbb_root_path}memberlist.$phpEx?mode=viewprofile&amp;u=" . $row['create_user_id']);
		$meeting_edit_by_username	= ($row['edit_username']) ? $row['edit_username'] : '---';;
		$meeting_edit_by_user_id	= append_sid("{$phpbb_root_path}memberlist.$phpEx?mode=viewprofile&amp;u=" . $row['edit_user_id']);
		$meeting_start_value		= $row['meeting_start_value'];
		$meeting_recure_value		= $row['meeting_recure_value'];
		$meeting_guest_overall		= $row['meeting_guest_overall'];
		$meeting_guest_single		= $row['meeting_guest_single'];
		$meeting_guest_names		= $row['meeting_guest_names'];
		$meeting_creator			= $row['meeting_by_user'];
	
		$uid		= $row['uid'];
		$bitfield	= $row['bitfield'];
		$flags		= $row['flags'];

		$meeting_desc	= generate_text_for_display($meeting_desc, $uid, $bitfield, $flags);
	 
		$meeting_by_user		= sprintf($user->lang['MEETING_CREATE_BY'], $meeting_by_user_id, $meeting_by_username);
		$meeting_edit_by_user	= sprintf($user->lang['MEETING_EDIT_BY'], $meeting_edit_by_user_id, $meeting_edit_by_username);

		if ($meeting_creator == $user->data['user_id'] && $config['meeting_sign_perm'] == 3)
		{
			$allow_sign_onoff = true;
		}
	
		$sql = $db->sql_build_query('SELECT', array(
			'SELECT'	=> 'm.user_id, m.meeting_sure, m.meeting_guests, u.username',

			'FROM'		=> array(MEETING_USER_TABLE => 'm', USERS_TABLE => 'u'),

			'WHERE'		=> 'm.user_id = u.user_id AND ' . $db->sql_build_array('SELECT', array('m.meeting_id' => $m_id)),

			'ORDER_BY'	=> 'm.meeting_sure DESC, UPPER(u.username)'
		));
		$result = $db->sql_query($sql);

		$meeting_total_user_ids = 0;
		$meeting_user_ids = 0;
		$meeting_user = '';
		$meeting_sure = 0;
		$total_guests = 0;
		$meeting_guests = 0;
		$remain_guests = 0;
		$guest_places = '';
		$meeting_users_sql = array($user->data['user_id'], ANONYMOUS);
		$guest_popup = '';
		$s_signed_on_edit = '';
		$s_signed_off = '';	
		$s_meeting_signoffs = '';
	
		$signed_on = FALSE;
		$current_user = $user->data['user_id'];
	
		while ($row = $db->sql_fetchrow($result))
		{
			$signed_on_user = $row['user_id'];
			$meeting_users_sql[] = $signed_on_user;
			$guests = $row['meeting_guests'];
	
			if ($signed_on_user == $current_user)
			{
				$signed_on = true;
				$meeting_guests = $guests;
			}
			else
			{
				$total_guests += ($row['meeting_sure']) ? $guests : 0;
			}
			
			$meeting_user .= ' <a href="' . append_sid("{$phpbb_root_path}memberlist.$phpEx?mode=viewprofile&amp;u=" . $row['user_id']) . '">' . $row['username'] . '</a> (';
			$meeting_user .= ($row['meeting_sure']) ? (($row['meeting_sure'] == 100) ? $user->lang['MEETING_YES_SIGNON'] : $row['meeting_sure'].'%') : $user->lang['MEETING_NO_SIGNON'];

			if ($guests)
			{
				if ($meeting_guest_names)
				{
					$meeting_guests_text = ($guests == 1) ? sprintf($user->lang['MEETING_USER_GUEST_POPUP'], $m_id, $row['user_id']) : sprintf($user->lang['MEETING_USER_GUESTS_POPUP'], $m_id, $row['user_id'], $guests);
					$guest_popup = str_replace("&amp;", "&", $basic_link_smode) . "&mode=popup&m_id=$m_id&u=$signed_on_user";
				}
				else
				{
					$meeting_guests_text = ($guests == 1) ? $user->lang['MEETING_USER_GUEST'] : sprintf($user->lang['MEETING_USER_GUESTS'], $guests);
					$guest_popup = '';
				}
	
				$meeting_user .= $meeting_guests_text;
			}
			$meeting_user .= ') |';
	
			$meeting_sure += $row['meeting_sure'];
			$meeting_user_ids += ($row['meeting_sure']) ? 1 : 0;
			$meeting_total_user_ids++;
	
			$s_meeting_signoffs .= ($user->data['user_id'] != $signed_on_user) ? '<option value="' . $signed_on_user . '">' . $row['username'] . '</option>' : '';
		}
		$db->sql_freeresult($result);
	
		if ($meeting_guest_overall)
		{
			$remain_guests = $meeting_guest_overall - $total_guests;
			$guest_places .= ($meeting_guest_overall == 1) ? $user->lang['MEETING_OVERALL_GUEST_PLACES_ONE'] : sprintf($user->lang['MEETING_OVERALL_GUEST_PLACES'], $meeting_guest_overall);
		}
	
		if ($meeting_guest_single)
		{
			$guest_places .= ($meeting_guest_single == 1) ? $user->lang['MEETING_SINGLE_GUEST_PLACES_ONE'] : sprintf($user->lang['MEETING_SINGLE_GUEST_PLACES'], $meeting_guest_single);
			$remain_guests = $meeting_guest_single;
			if ($meeting_guest_overall && $remain_guests > ($meeting_guest_overall - $total_guests))
			{
				$remain_guests = $meeting_guest_overall - $total_guests;
			}
		}
	
		$meeting_sure_total = ($meeting_user_ids && $meeting_places) ? number_format((100/$meeting_places*$meeting_user_ids),2,',','.') : 0;
		$meeting_sure_total_user = ($meeting_sure && $meeting_places) ? number_format((100/$meeting_places*$meeting_sure)/100,2,',','.') : 0;
	
		$meeting_free_places = ($meeting_user_ids != 0) ? ($meeting_places - $meeting_user_ids) : $meeting_places;
	
		if ($meeting_end)
		{
			$meeting_tmp_time = $meeting_end;
		}
		else
		{
			$meeting_tmp_time = $meeting_time;
		}

		$meeting_closed = ($meeting_tmp_time < time()) ? 2 : (($meeting_until < time()) ? 1 : 0);
		$meeting_closed_string = ($meeting_tmp_time < time()) ? '[ ' . $user->lang['MEETING_CLOSED'] . ' ]' : (($meeting_until < time()) ? '[ ' . $user->lang['MEETING_NO_PERIOD'] . ' ]' : '');
	
		$meeting_time	= meeting_date($meeting_time);
		$meeting_end	= (!$meeting_end) ? $meeting_time : meeting_date($meeting_end);
		$meeting_until	= meeting_date($meeting_until);
	
		if (($is_admin || $is_mod || $user->data['user_id'] == $meeting_creator) && $meeting_total_user_ids)
		{
			$template->assign_vars(array(
				'U_MEETING_MAIL' => $basic_link_smode . "&amp;mode=mail&amp;m_id=$m_id",
			));
		}		
	
		if ($remain_guests && $user->data['is_registered'])
		{
			$remain_guest_places = ($remain_guests == 1) ? $user->lang['MEETING_REMAIN_GUEST_PLACES_ONE'] : sprintf($user->lang['MEETING_REMAIN_GUEST_PLACES'], $remain_guests);

			if ($meeting_guest_names)
			{
				$s_remain_guests = '';
	
				$sql = $db->sql_build_query('SELECT', array(
					'SELECT'	=> 'mg.guest_prename, mg.guest_name',

					'FROM'		=> array(MEETING_GUESTNAMES_TABLE => 'mg'),

					'WHERE'		=> "mg.meeting_id = $m_id AND mg.user_id = $current_user",

					'ORDER_BY'	=> 'UPPER(mg.guest_name), UPPER(mg.guest_prename)'
				));

				$result = $db->sql_query($sql);

				$my_guest_names['prename'] = array();
				$my_guest_names['name'] = array();
				
				while ($row = $db->sql_fetchrow($result))
				{
					$my_guest_names['prename'][] = $row['guest_prename'];
					$my_guest_names['name'][] = $row['guest_name'];
				}
				$db->sql_freeresult($result);
	
				if ($meeting_closed)
				{
					$meeting_closed_row = '_read_only';
					$remain_guests = sizeof($my_guest_names['name']);
					if ($remain_guests)
					{
						$template->assign_var('S_GUEST_NAMES_BLOCK', true);
					}
				}
				else
				{
					$meeting_closed_row = '';
					$template->assign_var('S_GUEST_BLOCK_HEADER', true);
					$template->assign_var('S_GUEST_NAMES_BLOCK', true);
				}

				for ($i = 0; $i < $remain_guests; $i++)
				{
					$template->assign_block_vars('guest_name_row'. $meeting_closed_row, array(
						'GUEST_PRENAME' => (isset($my_guest_names['prename'][$i])) ? $my_guest_names['prename'][$i] : '',
						'GUEST_NAME' => (isset($my_guest_names['name'][$i])) ? $my_guest_names['name'][$i] : '',
					));
				}
			}
			else
			{
				$s_remain_guests = $user->lang['MEETING_INVITE_GUESTS'] . '<select name="meeting_guests">';
				for ($i = 0; $i <= $remain_guests; $i++)
				{
					$s_remain_guests .= '<option value="' . $i . '">' . $i . '</option>';
				}
				$s_remain_guests .= '</select>&nbsp;' . $user->lang['MEETING_GUESTS'];
				$s_remain_guests = str_replace('value="' . $meeting_guests . '"', 'value="' . $meeting_guests . '" selected="selected"', $s_remain_guests);
			}
		}
		else
		{
			$remain_guest_places = '';
			$s_remain_guests = '';
		}
	
		$remain_guests -= $meeting_guests;
		$total_guests += $meeting_guests;

		if ($total_guests)
		{
			$total_guests_text = ($total_guests == 1) ? $user->lang['MEETING_USER_GUEST'] : sprintf($user->lang['MEETING_USER_GUESTS'], $total_guests);
		}
		else
		{
			$total_guests_text = '';
		}
	
		$total_meeting_users = $meeting_user_ids + $total_guests;
		$meeting_user = ($meeting_total_user_ids == 0) ? $user->lang['MEETING_NO_USER'] : '<strong>' . ($meeting_total_user_ids + $total_guests) . ' ' . $user->lang['MEETING_USER_JOINS'] . '</strong> (' . $user->lang['MEETING_YES_SIGNONS'] . $meeting_user_ids . $total_guests_text . '):<br />' . substr($meeting_user, 0, strlen($meeting_user)-1);
	
		if ($remain_guests)
		{
			$meeting_free_guests = ($remain_guests == 1) ? $user->lang['MEETING_USER_GUEST'] : sprintf($user->lang['MEETING_USER_GUESTS'], $remain_guests);
		}
		else
		{
			$meeting_free_guests = '';
		}

		if (!$user->data['is_registered'])
		{
			$meeting_closed = 2;
		}
		
		switch ($meeting_closed)
		{
			case 0:
				if ($signed_on)
				{
					$s_signed_on_edit = $user->lang['MEETING_SIGN_EDIT'];
					$s_signed_off = $user->lang['MEETING_SIGN_OFF'];
				}
				else if ($meeting_free_places)
				{
					$s_signed_on_edit = $user->lang['MEETING_SIGN_ON'];
					$s_signed_off = '';
				}
			break;

			case 1:
				if ($signed_on)
				{
					$s_signed_on_edit = $user->lang['MEETING_SIGN_EDIT'];
					$s_signed_off = $user->lang['MEETING_SIGN_OFF'];
				}
				else
				{
					$s_signed_on_edit = '';
					$s_signed_off = '';
				}

				$s_remain_guests = array(
					'meeting_guests'	=> $meeting_guests,
				);
				$s_remain_guests = build_hidden_fields($s_remain_guests);
			break;

			case 2:
				$s_signed_on_edit = '';
				$s_signed_off = '';
				$s_remain_guests = '';
			break;
		}
	
		if ($meeting_free_places != 0 || ($meeting_free_places == 0 && $signed_on == true))
		{
			if ($meeting_closed == 0 || ($meeting_closed == 1 && $signed_on == true))
			{
				$meeting_sure_user = '&nbsp;<select name="meeting_sure">';
				$meeting_recure_value = (!$meeting_recure_value) ? 1 : $meeting_recure_value;
				$meeting_start_value = ($meeting_start_value < 0) ? 0 : $meeting_start_value;
				if ($meeting_start_value > $meeting_recure_value)
				{
					$meeting_start_value = 0;
					$meeting_recure_value = 1;
				}

				for ( $i = $meeting_start_value; $i < 100; $i += $meeting_recure_value )
				{
					$meeting_sure_user .= '<option value="' . $i . '">' . (($i == 0) ? $user->lang['MEETING_NO_SIGNON'] : $i . '%').'</option>';
				}
				$meeting_sure_user .= '<option value="100" selected="selected">' . $user->lang['MEETING_YES_SIGNON'] . '</option>';
				$meeting_sure_user .= '</select>';
			}
			else
			{
				$meeting_sure_user = '';
			}
		}
		else
		{
			$meeting_sure_user = '';
		}

		if ($meeting_closed < 2 && $s_meeting_signoffs && $allow_sign_onoff && $user->data['is_registered'])
		{
			$s_meeting_signoffs = '<select name="u">' . $s_meeting_signoffs . '</select>';
			$s_hidden_fields_soff = array(
				'm_id'	=> $m_id,
			);

			$template->assign_var('S_SIGN_OFF_USER', true);
			$template->assign_vars(array(
				'S_MEETING_SIGNOFFS'	=> $s_meeting_signoffs,
				'S_HIDDEN_FIELDS_SOFF'	=> build_hidden_fields($s_hidden_fields_soff),
			));
		}

		if (!$meeting_closed && $allow_sign_onoff && $meeting_free_places && $user->data['is_registered'])
		{
			// Get all unsigned but possible users for this meeting
			$sql = 'SELECT meeting_group FROM ' . MEETING_USERGROUP_TABLE . "
				WHERE meeting_id = $m_id
				ORDER BY meeting_group";
			$result = $db->sql_query($sql);
	
			$meeting_new_user_ary = array();
	
			while ($row = $db->sql_fetchrow($result))
			{
				$meeting_new_user_ary[] = $row['meeting_group'];
			}
			$db->sql_freeresult($result);
	
			unset($sql);
	
			if ($meeting_new_user_ary[0] == -1)
			{
				$sql = 'SELECT user_id, username FROM ' . USERS_TABLE . '
					WHERE ';
				$sql .= $db->sql_in_set('user_id', $meeting_users_sql, true);
				$sql .= ' AND ' . $db->sql_in_set('user_type', array(USER_NORMAL, USER_FOUNDER));
				$sql .= ' ORDER BY UPPER(username)';
			}
			else if (sizeof($meeting_new_user_ary))
			{
				unset($sql_array);
				$sql_array = array();
				$sql_array['SELECT'] = 'ug.user_id, u.username';

				$sql_array['FROM'] = array(
						GROUPS_TABLE		=> 'g',
						USER_GROUP_TABLE	=> 'ug',
						USERS_TABLE			=> 'u');

				$sql_array['WHERE'] = $db->sql_in_set('g.group_id', $meeting_new_user_ary);
				$sql_array['WHERE'] .= ' AND ' . $db->sql_in_set('ug.user_id', $meeting_users_sql, true);
				$sql_array['WHERE'] .= ' AND g.group_id = ug.group_id
						AND ug.user_pending <> ' . true . '
						AND ug.user_id = u.user_id';

				$sql_array['ORDER_BY'] = 'UPPER(u.username)';

				$sql = $db->sql_build_query('SELECT', $sql_array);
			}
	
			if ($sql)
			{
				$result = $db->sql_query($sql);
	
				$total_users = $db->sql_affectedrows($result);
				if ($total_users)
				{
					$s_new_users = '<select name="u">';

					$s_hidden_fields_son = array(
						'm_id'			=> $m_id,
						'sign_user'		=> 'other',
					);
	
					while ($row = $db->sql_fetchrow($result))
					{
						$s_new_users .= '<option value="' . $row['user_id'] . '">' . $row['username'] . '</option>';
					}

					$s_new_users .= '</select>';

					$template->assign_var('S_SIGN_ON_OTHER_USER', true);
					$template->assign_vars(array(
						'S_NEW_USERS'			=> $s_new_users,
						'S_HIDDEN_FIELDS_SON'	=> build_hidden_fields($s_hidden_fields_son),
					));
				}
	
				$db->sql_freeresult($result);
			}
		}
	
		$s_hidden_fields = array(
			'm_id'	=> $m_id,
			'u'		=> $user->data['user_id'],
		);
	
		$template->assign_vars(array(
			'MODULE_NAME'					=> $page_title,

			'MEETING_REMAIN_GUESTS'			=> $guest_places,
			'MEETING_REMAIN_GUESTS_PLACES'	=> $remain_guest_places,
			'MEETING_FREE_GUESTS'			=> $meeting_free_guests,

			'S_SIGNED_ON_EDIT'				=> $s_signed_on_edit,
			'S_SIGNED_OFF'					=> $s_signed_off,
	
			'MEETING_TIME'					=> $meeting_time . (($meeting_end == $meeting_time) ? '' : ' &raquo; ' . $meeting_end),
			'MEETING_UNTIL'					=> $meeting_until,
			'MEETING_LOCATION'				=> $meeting_location,
			'MEETING_SUBJECT'				=> $meeting_subject,
			'MEETING_DESC'					=> $meeting_desc,
			'MEETING_LINK_D'				=> $meeting_link,
			'MEETING_PLACES'				=> $meeting_places,
			'MEETING_CLOSED_STRING'			=> $meeting_closed_string,
			'MEETING_SURE_TOTAL'			=> $meeting_sure_total,
			'MEETING_SURE_TOTAL_USER'		=> $meeting_sure_total_user,
			'MEETING_SURE_USER'				=> $meeting_sure_user,
			'MEETING_FREE_PLACES'			=> $meeting_free_places,
			'MEETING_BY_USER'				=> $meeting_by_user,
			'MEETING_EDIT_BY_USER'			=> $meeting_edit_by_user,
	
			'U_MEETING_DETAIL'				=> $basic_link_smode . "&amp;mode=detail&amp;m_id=$m_id",
			'U_MEETING_USER'				=> $meeting_user,
			'U_GUEST_POPUP'					=> $guest_popup,
	
			'S_REMAIN_GUESTS'				=> $s_remain_guests,
			'S_HIDDEN_FIELDS'				=> build_hidden_fields($s_hidden_fields),
			'S_FORM_ACTION'					=> $basic_link,
		));
	
		$sql = 'SELECT m.user_id, m.comment_id, m.meeting_comment, m.meeting_edit_time, m.approve, m.uid, m.bitfield, m.flags, u.username
			FROM ' . MEETING_COMMENT_TABLE . ' m, ' . USERS_TABLE . " u
			WHERE m.user_id = u.user_id
			AND m.meeting_id = $m_id
			ORDER BY approve, meeting_edit_time DESC";
		$result = $db->sql_query($sql);
	
		$meeting_comment = $meeting_approve = $comment_action = $meeting_comment_user = $meeting_comment_user_id = array();
	
		while ($row = $db->sql_fetchrow($result))
		{
			$comment_id = $row['comment_id'];
			$comment_user = $row['user_id'];

			if ($is_admin || $is_mod || ($is_user && $config['meeting_user_delete_comments'] && $comment_user == $user->data['user_id']) )
			{
				$temp_link_1 = '<a href="' . $basic_link_smode . "&amp;mode=detail&amp;action=delete_comment&amp;m_id=$m_id&amp;c_user_id=$comment_user&amp;c_id=$comment_id" . '">' . $user->lang['DELETE'] . '</a>';
			}
			else 
			{
				$temp_link_1 = '';
			}
	
			if ($comment_user == $user->data['user_id'] || $is_admin || $is_mod)
			{
				$temp_link_2 = '<a href="' . $basic_link_smode . "&amp;mode=detail&amp;action=edit_comment&amp;m_id=$m_id&amp;c_user_id=$comment_user&amp;c_id=$comment_id" . '">' . $user->lang['EDIT_POST'] . '</a>';
			}
			else 
			{
				$temp_link_2 = '';
			}
	
			if (!$row['approve'] && ($is_admin || $is_mod))
			{
				$temp_link_3 = '<a href="' . $basic_link_smode . "&amp;mode=detail&amp;action=approve_comment&amp;m_id=$m_id&amp;c_id=$comment_id" . '"><strong>' . $user->lang['POST_UNAPPROVED'] . '</strong></a>';
			}
			else if ($row['approve'])
			{
				$temp_link_3 = 'approved';
			}
			else
			{
				$temp_link_3 = '';
			}

			$temp_link			= $temp_link_1;

			if ($temp_link && $temp_link_2)
			{
				$temp_link		.= ' | ' . $temp_link_2;
			}

			if ($temp_link && $temp_link_3 != '' && $temp_link_3 != 'approved')
			{
				$temp_link		.= ' | ' . $temp_link_3;
			}
			
			$comment_action[]	= $temp_link;
			$meeting_approve[]	= $temp_link_3;

			$comment_text		= $row['meeting_comment'];
			$uid				= $row['uid'];
			$bitfield			= $row['bitfield'];
			$flags				= $row['flags'];
			$meeting_comment[]	= generate_text_for_display($comment_text, $uid, $bitfield, $flags);
	
			$meeting_comment_user[]		= '<strong><a href="' . append_sid("{$phpbb_root_path}memberlist.$phpEx?mode=viewprofile&amp;u=" . $comment_user) . '">' . $row['username'] . '</a></strong> ' . $user->format_date($row['meeting_edit_time']) . ':';
			$meeting_comment_user_id[]	= $comment_user;
		}
	
		$total_comments = $db->sql_affectedrows($result);
	
		$db->sql_freeresult($result);
	
		if ($total_comments)
		{
			$template->assign_var('S_MEETING_COMMENTS', true);
	
			for ($i = 0; $i < count($meeting_comment); $i++)
			{
				if ($meeting_approve[$i] == 'approved' || ($meeting_approve[$i] != 'approved' && $meeting_approve[$i] != '' && ($is_admin || $is_mod)))
				{
					$template->assign_block_vars('meeting_comments', array(
						'MEETING_COMMENT'			=> $meeting_comment[$i],
						'MEETING_COMMENT_USER'		=> $meeting_comment_user[$i],
						'MEETING_COMMENT_ACTION'	=> $comment_action[$i],
					));
				}
			}
		}
	
		$template->assign_vars(array(
			'S_FORM_COMMENT_ACTION' => $basic_link_smode . "&amp;mode=detail&amp;m_id=$m_id&amp;action=edit_comment",
		));

	break;

	default:
		// Get per page value
		$per_page = $config['topics_per_page'];
		
		$closed_no		= '';
		$closed_yes		= '';
		$closed_period	= '';
		$closed_none	= '';
	
		$sql_closed = ' AND ';
		$current_time = time();

		switch ($closed)
		{
			case 1:
				$sql_closed	.= 'meeting_end > ' . $current_time;
				$closed_no = 'checked="checked"';
				break;
			case 2:
				$sql_closed .= 'meeting_end < ' . $current_time;
				$closed_yes = 'checked="checked"';
				break;
			case 3:
				$sql_closed .= 'meeting_until < ' . $current_time . ' AND meeting_time > ' . $current_time;
				$closed_period = 'checked="checked"';
				break;
			case 4:
				$sql_closed = '';
				$closed_none = 'checked="checked"';
				break;
		}

		// List meetings with unapproved comments
		$unapproved_comment_ids = array();

		if (!$is_user && $view != 'cal')
		{
			$sql = 'SELECT meeting_id FROM ' . MEETING_COMMENT_TABLE . "
				WHERE approve = 0
				GROUP BY meeting_id";
			$result = $db->sql_query($sql);
			$total_unapproved = $db->sql_affectedrows($result);

			if ($total_unapproved)
			{
				while ($row = $db->sql_fetchrow($result))
				{
					$unapproved_comment_ids[] = $row['meeting_id'];
				}
			}

			$db->sql_freeresult($result);

			if (sizeof($unapproved_comment_ids))
			{
				$allowed_meetings = ($meeting_approve) ? $unapproved_comment_ids : $allowed_meetings_ary;
				$template->assign_var('S_CHECK_APPROVE', true);
			}
		}
		else
		{
			$allowed_meetings = $allowed_meetings_ary;
		}

		// SQL statement to read from a table
		if ($is_admin && !$meeting_approve)
		{
			$sql_where_1 = '';
			$sql_where_2 = '';
		}
		else
		{
			$sql_where_1 = ' AND ' . $db->sql_in_set('m.meeting_id', ((isset($allowed_meetings)) ? $allowed_meetings : $allowed_meetings_ary));
			$sql_where_2 = ' AND ' . $db->sql_in_set('meeting_id', ((isset($allowed_meetings)) ? $allowed_meetings : $allowed_meetings_ary));
		}

		if ($view == 'cal')
		{
			// Get the meetings for the current shown month
			$sql = "SELECT * FROM " . MEETING_DATA_TABLE . " 
				WHERE meeting_id <> 0 
					AND (FROM_UNIXTIME(meeting_time, '%Y-%m') <= '" . $db->sql_escape($m_cal_period) . "' 
					OR FROM_UNIXTIME(meeting_end, '%Y-%m') >= '" . $db->sql_escape($m_cal_period) . "'
					OR FROM_UNIXTIME(meeting_until, '%Y-%m') = '" . $db->sql_escape($m_cal_period) . "') 
					$sql_where_2
				ORDER BY meeting_until, meeting_time, meeting_id";

		}
		else if ($meeting_signon)
		{
			// Read the meeting data based on the filter and where the current user have signed on
			$sql = 'SELECT m.* FROM ' . MEETING_USER_TABLE . ' u, ' . MEETING_DATA_TABLE . " m
				WHERE u.user_id = " . $user->data['user_id'] . "
					AND u.meeting_id = m.meeting_id
					$sql_closed
					$sql_filter
					$sql_where_1
				ORDER BY $sort_field $sort_order";
		}
		else
		{
			// Read all meeting data based on the filter
			$sql = "SELECT * FROM " . MEETING_DATA_TABLE . "
				WHERE meeting_id <> 0
					$sql_filter
					$sql_closed
					$sql_where_2
				ORDER BY $sort_field $sort_order";
		}

		$result = $db->sql_query($sql);
		$total_meetings = $db->sql_affectedrows($result);

		if ($view != 'cal')
		{
			$result = $db->sql_query_limit($sql, $per_page, $start);

			if ($start > $total_meetings)
			{
				$start = 0;
				$result = $db->sql_query_limit($sql, $per_page, $start);
			}
		}

		$meetingrow = array();
		$meeting_ids = array();

		while ($row = $db->sql_fetchrow($result))
		{
			$meetingrow[] = $row;
			$meeting_ids[] = $row['meeting_id'];
		}

		$db->sql_freeresult($result);
	
		// Output global values
		$template->assign_vars(array(
			'MODULE_NAME'		=> $user->lang['MEETING_MANAGE'],
	
			'L_MEETING_TIME'	=> $user->lang['TIME'],
		));

		// Create the sort and filter fields
		$sort_by_field = '<select name="sort_field">';
		$sort_by_field .= '<option value="meeting_subject">'	.	$user->lang['MEETING_SUBJECT']	.	'</option>';
		$sort_by_field .= '<option value="meeting_time">'	.	$user->lang['TIME']	.	'</option>';
		$sort_by_field .= '<option value="meeting_until">'	.	$user->lang['MEETING_UNTIL']	.	'</option>';
		$sort_by_field .= '<option value="meeting_location">'	.	$user->lang['MEETING_LOCATION']	.	'</option>';
		$sort_by_field .= '</select>';
		$sort_by_field = str_replace('value="'.$sort_field.'">', 'value="'.$sort_field.'" selected="selected">', $sort_by_field);
	
		$sort_by_order = '<select name="sort_order">';
		$sort_by_order .= '<option value="ASC">' . $user->lang['MEETING_SORT_ASC'] . '</option>';
		$sort_by_order .= '<option value="DESC">' . $user->lang['MEETING_SORT_DESC'] . '</option>';
		$sort_by_order .= '</select>';
		$sort_by_order = str_replace('value="'.$sort_order.'">', 'value="'.$sort_order.'" selected="selected">', $sort_by_order);
	
		$filter_by_field = '<select name="filter_by">';
		$filter_by_field .= '<option value="none">---</option>';
		$filter_by_field .= '<option value="meeting_subject">' . $user->lang['MEETING_SUBJECT'] . '</option>';
		$filter_by_field .= '<option value="meeting_location">' . $user->lang['MEETING_LOCATION'] . '</option>';
		$filter_by_field .= '</select>';
		$filter_by_field = str_replace('value="'.$filter_by.'">', 'value="'.$filter_by.'" selected="selected">', $filter_by_field);

		// Build the calender period selection, if the calendar view was selected
		if ($view == 'cal')
		{
			$s_select_cal_month = '<select name="m_cal_month_s" onchange="forms[\'filter_meetings\'].submit();">';
			for ($i = 1; $i < 13; $i++)
			{
				$month = ($i < 10) ? '0' . $i : $i;
				$selected = ($month == $m_cal_month) ? ' selected="selected"' : '';
				$s_select_cal_month .= '<option value="' . $month . '"' . $selected . '>' . $user->lang['MEETING_MONTH_TEXT'][$i] . '</option>';
			}
			$s_select_cal_month .= '</select>';

			$s_select_cal_year = '<select name="m_cal_year_s" onchange="forms[\'filter_meetings\'].submit();">';
			$first_year = $m_cal_year - 6;
			$last_year = $m_cal_year + 5;
			for ($i = $last_year; $i > $first_year; $i--)
			{
				$selected = ($i == $m_cal_year) ? ' selected="selected"' : '';
				$s_select_cal_year .= '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
			}
			$s_select_cal_year .= '</select>';

			$last_year = $m_cal_year - 1;
			$next_year = $m_cal_year + 1;

			$u_last_year = $basic_link_start . '&amp;m_cal_year_s=' . $last_year . '&amp;m_cal_month_s=' . $m_cal_month;
			$u_next_year = $basic_link_start . '&amp;m_cal_year_s=' . $next_year . '&amp;m_cal_month_s=' . $m_cal_month;

			$last_month = $m_cal_month - 1;
			if ($last_month == 0)
			{
				$last_month = 12;
				$last_year = $m_cal_year - 1;
			}
			else
			{
				$last_year = $m_cal_year;
			}

			$u_last_month = $basic_link_start . '&amp;m_cal_year_s=' . $last_year . '&amp;m_cal_month_s=' . $last_month;

			$next_month = $m_cal_month + 1;
			if ($next_month == 13)
			{
				$next_month = 1;
				$next_year = $m_cal_year + 1;
			}
			else
			{
				$next_year = $m_cal_year;
			}
	
			$u_next_month = $basic_link_start . '&amp;m_cal_year_s=' . $next_year . '&amp;m_cal_month_s=' . $next_month;
		}
		else
		{
			$s_select_cal_month = '';
			$s_select_cal_year = '';
			$u_last_year = '';
			$u_next_year = '';
			$u_last_month = '';
			$u_next_month = '';
		}
	
		// Output the sorting and filter values
		$template->assign_vars(array(
			'SORT_BY_FIELD'		=> $sort_by_field,
			'SORT_BY_ORDER'		=> $sort_by_order,
			'FILTER_BY_FIELD'	=> $filter_by_field,
			'FILTER_FIELD'		=> $filter,
	
			'CLOSED_NO'			=> $closed_no,
			'CLOSED_YES'		=> $closed_yes,
			'CLOSED_PERIOD'		=> $closed_period,
			'CLOSED_NONE'		=> $closed_none,

			'U_LAST_YEAR'		=> $u_last_year,
			'U_NEXT_YEAR'		=> $u_next_year,
			'U_LAST_MONTH'		=> $u_last_month,
			'U_NEXT_MONTH'		=> $u_next_month,

			'S_MEETING_SIGNON'	=> ($meeting_signon) ? 'checked="checked"' : '',
			'S_MEETING_APPROVE'	=> ($meeting_approve) ? 'checked="checked"' : '',
			'S_CAL_MONTH'		=> $s_select_cal_month,
			'S_CAL_YEAR'		=> $s_select_cal_year,
			'S_FORM_ACTION'		=> $basic_link_start,
		));
	
		if ($total_meetings && $view != 'cal')
		{
			$sql = 'SELECT m.meeting_id, m.meeting_sure, COUNT(m.user_id) AS users, SUM(m.meeting_guests) AS guests FROM ' . MEETING_USER_TABLE . ' m, ' . USERS_TABLE . ' u
				WHERE ' . $db->sql_in_set('meeting_id', $meeting_ids) . '
					AND u.user_id = m.user_id
				GROUP BY meeting_id, meeting_sure
				ORDER BY meeting_id, meeting_sure';
			$result = $db->sql_query($sql);

			for ($i = 0; $i < sizeof($meeting_ids); $i++)
			{
				$no_meet_u[$meeting_ids[$i]]	= 0;
				$no_meet_g[$meeting_ids[$i]]	= 0;
				$yes_meet_u[$meeting_ids[$i]]	= 0;
				$yes_meet_g[$meeting_ids[$i]]	= 0;
				$maybe_meet_u[$meeting_ids[$i]]	= 0;
				$maybe_meet_g[$meeting_ids[$i]]	= 0;
			}

			while ($row = $db->sql_fetchrow($result))
			{
				$meeting_sure	= $row['meeting_sure'];
				$meeting_id		= $row['meeting_id'];

				if (!$meeting_sure)
				{
					$no_meet_u[$meeting_id] += $row['users'];
					$no_meet_g[$meeting_id] += $row['guests'];
				}
				else if ($meeting_sure == 100)
				{
					$yes_meet_u[$meeting_id] += $row['users'];
					$yes_meet_g[$meeting_id] += $row['guests'];
				}
				else
				{
					$maybe_meet_u[$meeting_id] += $row['users'];
					$maybe_meet_g[$meeting_id] += $row['guests'];
				}
			}

			$db->sql_freeresult($result);
			unset($meeting_ids);

			// Cycle a loop through all data
			for($i = 0; $i < sizeof($meetingrow); $i++)
			{
				$meeting_check_time		= $meetingrow[$i]['meeting_time'];
				$meeting_check_end		= $meetingrow[$i]['meeting_end'];
				$meeting_check_until	= $meetingrow[$i]['meeting_until'];

				$meeting_time		= meeting_date($meeting_check_time);
				$meeting_end		= (!$meeting_check_end) ? $meeting_time : meeting_date($meeting_check_end);
				$meeting_until		= meeting_date($meeting_check_until);
	
				$meeting_location	= $meetingrow[$i]['meeting_location'];
				$meeting_link		= $meetingrow[$i]['meeting_link'];
				$meeting_subject	= $meetingrow[$i]['meeting_subject'];
				$meeting_location	= ($meeting_link) ? '<a href="' . $meeting_link . '">' . $meeting_location . '</a>' : $meeting_location;
	
				$meeting_id			= $meetingrow[$i]['meeting_id'];
				$meeting_edit		= $basic_link_smode . "&amp;mode=edit&amp;m_id=$meeting_id";
				$meeting_delete		= $basic_link_smode . "&amp;mode=delete&amp;m_id=$meeting_id";
	
				$meeting_closed		= ($meeting_check_time < time()) ? $user->lang['YES'] : (($meeting_check_until < time()) ? $user->lang['MEETING_NO_PERIOD'] : $user->lang['NO']);
	
				$meeting_by_user		= $meetingrow[$i]['meeting_by_user'];

				if ($allow_edit || ($meeting_by_user == $user->data['user_id'] && $config['meeting_user_edit']))
				{
					$s_meeting_edit = true;
				}
				else
				{
					$s_meeting_edit = false;
				}
		
				if ($allow_delete || ($meeting_by_user == $user->data['user_id'] && $config['meeting_user_delete']))
				{
					$s_meeting_delete = true;
				}
				else
				{
					$s_meeting_delete = false;
				}

				$meeting_users = '';

				$meeting_users .= $user->lang['MEETING_YES_SIGNONS'] . ': ' . ((isset($yes_meet_u[$meeting_id])) ? $yes_meet_u[$meeting_id] : 0);
				$meeting_users .= ((isset($yes_meet_g[$meeting_id])) ? ' (' . $yes_meet_g[$meeting_id] . ')' : '');
				$meeting_users .= '<br />' . $user->lang['MEETING_NO_SIGNONS'] . ': ' . ((isset($no_meet_u[$meeting_id])) ? $no_meet_u[$meeting_id] : 0);
				$meeting_users .= ((isset($no_meet_g[$meeting_id])) ? ' (' . $no_meet_g[$meeting_id] . ')' : '');
				$meeting_users .= '<br />' . $user->lang['MEETING_MAYBE_SIGNONS'] . ': ' . ((isset($maybe_meet_u[$meeting_id])) ? $maybe_meet_u[$meeting_id] : 0);
				$meeting_users .= ((isset($maybe_meet_g[$meeting_id])) ? ' (' . $maybe_meet_g[$meeting_id] . ')' : '');

				// Output the values
				$template->assign_block_vars('meeting_row', array(
					'MEETING_TIME'		=> $meeting_time . (($meeting_end == $meeting_time) ? '' : '<br />&raquo;<br />' . $meeting_end),
					'MEETING_UNTIL'		=> $meeting_until,
					'MEETING_LOCATION'	=> $meeting_location,
					'MEETING_SUBJECT'	=> $meeting_subject,
					'MEETING_CLOSED'	=> $meeting_closed,
					'MEETING_EDIT'		=> $meeting_edit,
					'MEETING_DELETE'	=> $meeting_delete,
					'MEETING_USERS'		=> $meeting_users,

					'S_MEETING_EDIT'	=> $s_meeting_edit,
					'S_MEETING_DELETE'	=> $s_meeting_delete,

					'U_MEETING_DETAIL'	=> $basic_link_smode . "&amp;mode=detail&amp;m_id=$meeting_id",
				));
			}
	
			$pagination = generate_pagination($basic_link_page, $total_meetings, $per_page, $start);

			$template->assign_vars(array(
				'PAGINATION' => $pagination)
			);
		}
		else if ($view == 'cal')
		{
			// And at least here the calendar view with all meetings in the current shown month or meetings with signon time period within it.
			$first_day_of_month = 1;
			$date_art = ($config['meeting_first_weekday'] == 'm') ? 'N' : 'w';
			$last_day_of_month = intval(date('t', strtotime("01.{$m_cal_month}.{$m_cal_year}")));
			$first_weekday_of_month = date($date_art, strtotime("01.{$m_cal_month}.{$m_cal_year}")) - (($date_art == 'w') ? 0 : 1);
			$last_weekday_of_month = date($date_art, strtotime("{$last_day_of_month}.{$m_cal_month}.{$m_cal_year}")) - (($date_art == 'w') ? 0 : 1);

			// First pre-define the blank cells before the current month
			$pre_cells = $first_weekday_of_month;

			// Second pre-define the blank cells after the current month
			$post_cells = 6 - $last_weekday_of_month;
				
			// And now build the calendar view: Weekday titles, pre cells, current month, post cells
			$cal_header = '';
			$cal_cells = '';
			$cur_week = 0;

			for ($i = 0; $i < 7; $i++)
			{
				if ($config['meeting_first_weekday'] == 'm')
				{
					$day = $i + 1;
					if ($day == 7)
					{
						$day_title = $user->lang['MEETING_CAL_DAY'][0];
					}
					else
					{
						$day_title = $user->lang['MEETING_CAL_DAY'][$day];
					}
				}
				else
				{
					$day_title = $user->lang['MEETING_CAL_DAY'][$i];
				}

				$template->assign_block_vars('cal_title', array(
					'MEETING_DAY_TITLE'	=> $day_title,
				));
			}

			$template->assign_block_vars('cal_weeks', array());

			for ($i = 0; $i < $pre_cells; $i++)
			{
				$template->assign_block_vars('cal_weeks.cal_day_title', array(
					'C_CAL_DAY_TITLE'	=> 1,
					'CAL_DAY_TITLE'		=> '',
				));

				$template->assign_block_vars('cal_weeks.cal_day_title.cal_day', array(
					'U_CAL_DAY' => '',
				));
			}

			for ($i = 0; $i < $last_day_of_month; $i++)
			{
				$j = $i + 1;
				$cur_weekday = date('w', strtotime("$j.$m_cal_month.$m_cal_year"));
				$current_day = (string) $m_cal_year . '-' . sprintf('%02d', $m_cal_month) . '-' . sprintf('%02d', $j);

				$template->assign_block_vars('cal_weeks.cal_day_title', array(
					'C_CAL_DAY_TITLE'	=> ($cur_weekday == 0 || $cur_weekday == 6) ? 3 : 2,
					'CAL_DAY_TITLE'		=> $j,
				));

				// The real inserts here: add the meetings to the calendar view
				$day_meetings = 0;

				for ($k = 0; $k < $total_meetings; $k++)
				{
					$meeting_time = (string) date('Y-m-d', $meetingrow[$k]['meeting_time']);
					$meeting_end = (string) date('Y-m-d', $meetingrow[$k]['meeting_end']);
					$meeting_until = (string) date('Y-m-d', $meetingrow[$k]['meeting_until']);

					if ($current_day >= $meeting_time && $current_day <= $meeting_end)
					{
						$template->assign_block_vars('cal_weeks.cal_day_title.cal_day', array(
							'C_CAL_DAY' => 't',
							'CAL_DAY'	=> $meetingrow[$k]['meeting_subject'],
							'U_CAL_DAY'	=> $basic_link_smode . '&amp;mode=detail&amp;m_id=' . (int) $meetingrow[$k]['meeting_id'],
						));
						$day_meetings++;
					}

					if ($meeting_until == $current_day)
					{
						$template->assign_block_vars('cal_weeks.cal_day_title.cal_day', array(
							'C_CAL_DAY' => 'u',
							'CAL_DAY'	=> $meetingrow[$k]['meeting_subject'],
							'U_CAL_DAY'	=> $basic_link_smode . '&amp;mode=detail&amp;m_id=' . (int) $meetingrow[$k]['meeting_id'],
						));
						$day_meetings++;
					}						
				}

				if (!$day_meetings)
				{
					$template->assign_block_vars('cal_weeks.cal_day_title.cal_day', array(
						'S_CAL_DAY' => true,
						'CAL_DAY'	=> "<br /><br /><br /><br />",
					));
				}

				if ($config['meeting_first_weekday'] == 's' && $cur_weekday == 6 || $config['meeting_first_weekday'] == 'm' && $cur_weekday == 0)
				{
					$template->assign_block_vars('cal_weeks', array());
				}
			}

			for ($i = 0; $i < $post_cells; $i++)
			{
				$template->assign_block_vars('cal_weeks.cal_day_title', array(
					'C_CAL_DAY_TITLE'	=> 1,
					'CAL_DAY_TITLE'		=> '',
				));

				$template->assign_block_vars('cal_weeks.cal_day_title.cal_day', array(
					'U_CAL_DAY' => '',
				));
			}
		}
		else
		{
			// Output message if no meeting was found
			$template->assign_var('S_NO_MEETING', true);
		}

		// Set the permissions for the meeting handling
		if ($allow_add)
		{
			$template->assign_var('S_M_CAN_ADD', true);
			$template->assign_vars(array(
				'U_MEETING_ADD'	=> $basic_link_smode . '&amp;mode=add',
			));
		}

		if ($total_meetings)
		{
			$template->assign_var('S_M_CAN_VIEW', true);
		}

		if ($view == 'cal')
		{
			$back_link = str_replace("&amp;view=cal&amp;", "&amp;view=&amp;", $basic_link_start);
			$meeting_view = $user->lang['MEETING'];
		}
		else
		{
			$back_link = str_replace("&amp;view=&amp;", "&amp;view=cal&amp;", $basic_link_start);
			$meeting_view = $user->lang['MEETING_CALENDAR'];
		}

		$template->assign_vars(array(
			'MEETING_VIEW'		=> $meeting_view,
			'U_MEETING_VIEW'	=> $back_link,
		));
}

page_footer();

function meeting_date($gmepoch)
{
	global $user;

	static $midnight;
	static $date_cache;

	$format = $user->data['user_dateformat'];
	$now = time();
	$delta = $now - $gmepoch;

	$date_cache[$format] = array(
		'is_short'		=> strpos($format, '|'),
		'format_short'	=> substr($format, 0, strpos($format, '|')) . '||' . substr(strrchr($format, '|'), 1),
		'format_long'	=> str_replace('|', '', $format),
		'lang'			=> $user->lang['datetime'],
	);

	// Short representation of month in format? Some languages use different terms for the long and short format of May
	if ((strpos($format, '\M') === false && strpos($format, 'M') !== false) || (strpos($format, '\r') === false && strpos($format, 'r') !== false))
	{
		$date_cache[$format]['lang']['May'] = $user->lang['datetime']['May_short'];
	}

	// Show date <= 1 hour ago as 'xx min ago'
	// A small tolerence is given for times in the future and times in the future but in the same minute are displayed as '< than a minute ago'
	if ($delta <= 3600 && ($delta >= -5 || (($now / 60) % 60) == (($gmepoch / 60) % 60)) && $date_cache[$format]['is_short'] !== false && isset($user->lang['datetime']['AGO']))
	{
		return $user->lang(array('datetime', 'AGO'), max(0, (int) floor($delta / 60)));
	}

	if (!$midnight)
	{
		list($d, $m, $y) = explode(' ', date('j n Y', time()));
		$midnight = mktime(0, 0, 0, $m, $d, $y);
	}

	if ($date_cache[$format]['is_short'] !== false)
	{
		$day = false;

		if ($gmepoch > $midnight + 2 * 86400)
		{
			$day = false;
		}
		else if($gmepoch > $midnight + 86400)
		{
			$day = 'TOMORROW';
		}
		else if ($gmepoch > $midnight)
		{
			$day = 'TODAY';
		}
		else if ($gmepoch > $midnight - 86400)
		{
			$day = 'YESTERDAY';
		}

		if ($day !== false)
		{
			return str_replace('||', $user->lang['datetime'][$day], strtr(@date($date_cache[$format]['format_short'], $gmepoch), $date_cache[$format]['lang']));
		}
	}

	return @strtr(@date($date_cache[$format]['format_long'], $gmepoch), $date_cache[$format]['lang']);
}

function meeting_date_save($date_string, $time_string)
{
	if (!$date_string)
	{
		return time();
	}

	$year	= substr($date_string, 0, 4);
	$month	= substr($date_string, 5, 2);
	$day	= substr($date_string, 8, 2);
	$hour	= substr($time_string, 0, 2);
	$minute	= substr($time_string, 3, 2);

	$date_check = @mktime($hour, $minute, 0, $month, $day, $year);

	if (!$date_check || $date_check === false)
	{
		return '0';
	}			

	return $date_check;
}

function meeting_date_edit($module, $date)
{
	global $user;

	if (!$date)
	{
		$date = time();
	}

	$day	= date('d', $date);
	$month	= date('m', $date);
	$year	= date('Y', $date);
	$hour	= date('H', $date);
	$minute	= date('i', $date);

	$date = sprintf("%04s-%02s-%02s", $year, $month, $day);
	$time = sprintf("%02s:%02s", $hour, $minute);

	return '<input type="text" name="' . $module . '" id="' . $module . '" class="tcal" value="' . $date . '" readonly="readonly" size="11" maxlength="10" /><a href="#" onclick="DropDate(\'' . $module . '\');" style="text-decoration: none; border: 1px #A9B8C2 solid; padding: 1px 2px 1px 2px; background-color: #ECECEC;" /><strong>X</strong></a>&nbsp&nbsp;<input type="text" name="' . $module . '_time" size="5" maxlength="5" class="inputbox autowidth" value="' . $time . '" />';
}

