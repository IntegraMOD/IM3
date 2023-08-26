<?php

/** 
*
* @mod package		Meeting MOD
* @file				acp_meeting.php 16 2014/02/26 OXPUS
* @copyright		(c) 2009 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
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

/**
* @package acp
*/
class acp_meeting
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $cache, $rpg;
		global $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix;

		$auth->acl($user->data);
		$this->tpl_name = 'meeting/meeting';

		$template->assign_vars(array(
			'MEETING_VERSION'	=> sprintf($user->lang['MEETING_VERSION'], $config['meeting_version']),
		));

		// Get entered values
		$action		= request_var('action', '');
		$cancel		= request_var('cancel', '');
		$confirm	= request_var('confirm', '');
		$submit		= request_var('submit', '');
		$mode		= request_var('mode', 'config');
		$delete		= request_var('delete', '');

		$closed					= request_var('closed', 4);
		$e_date					= request_var('e_date', '');
		$e_time					= request_var('e_date_time', '');
		$filter					= request_var('filter', '');
		$filter_by				= request_var('filter_by', 'none');
		$group_id				= request_var('group_id', array(0 => ''));
		$group_id_2				= request_var('group_id_2', array(0 => ''));
		$m_date					= request_var('m_date', '');
		$m_time					= request_var('m_date_time', '');
		$m_id					= request_var('m_id', 0);
		$meeting_desc			= utf8_normalize_nfc(request_var('meeting_desc', utf8_normalize_nfc(request_var('message', '', true)), true));
		$meeting_guest_names	= request_var('meeting_guest_names', 0);
		$meeting_guest_overall	= request_var('meeting_guest_overall', 0);
		$meeting_guest_single	= request_var('meeting_guest_single', 0);
		$meeting_link			= utf8_normalize_nfc(request_var('meeting_link', '', true));
		$meeting_location		= utf8_normalize_nfc(request_var('meeting_location', '', true));
		$meeting_notify			= request_var('meeting_notify', 0);
		$meeting_places			= request_var('meeting_places', 0);
		$meeting_recure_value	= request_var('meeting_recure_value', 0);
		$meeting_start_value	= request_var('meeting_start_value', 0);
		$meeting_subject		= utf8_normalize_nfc(request_var('meeting_subject', '', true));
		$sort_field				= request_var('sort_field', 'meeting_time');
		$sort_order				= request_var('sort_order', 'ASC');
		$start					= request_var('start', 0);
		$u_date					= request_var('u_date', '');
		$u_time					= request_var('u_date_time', '');
	
		// Prepare basic link for various form actions
		$basic_values = "sort_field=$sort_field&amp;sort_order=$sort_order&amp;filter_by=$filter_by&amp;filter=$filter&amp;closed=$closed&amp;start=$start";
		$basic_link = append_sid("{$phpbb_root_path}adm/index.$phpEx" , "i=meeting&amp;mode=$mode&amp;" . $basic_values);
		$basic_link_smode = append_sid("{$phpbb_root_path}adm/index.$phpEx" , "i=meeting");

		// Prepare filter settings
		$sql_filter = ( $filter_by == 'none' ) ? '' : (($filter) ? " WHERE $filter_by LIKE ('%$filter%')" : '' );
		
		// What shall we do on cancel a deleting
		if ($cancel)
		{
			$submit = '';
			$cancel = '';
			$confirm = '';
			$action = '';
			$mode = 'manage';
			$m_id = 0;
		}

		/*
		* include the choosen module
		*/		
		switch($mode)
		{
			case 'config':
				$this->page_title = 'MEETING_CONFIG';

				$sql = 'SELECT * FROM ' . CONFIG_TABLE . "
					WHERE config_name LIKE 'meeting_%'";
				$result = $db->sql_query($sql);

				add_form_key('meeting_config');

				if ($submit && !check_form_key('meeting_config'))
				{
					trigger_error('FORM_INVALID', E_USER_WARNING);
				}

				while ($row = $db->sql_fetchrow($result))
				{
					$default_config[$row['config_name']] = $row['config_value'];
		
					$new[$row['config_name']] = request_var($row['config_name'], $default_config[$row['config_name']]);
		
					if ($submit)
					{
						set_config($row['config_name'], $new[$row['config_name']]);
					}
				}
		
				if ($submit)
				{
					$sql = 'UPDATE ' . GROUPS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
						'group_meeting_create' => 0));
					$db->sql_query($sql);
		
					if (sizeof($group_id) > 0)
					{
						if ($new['meeting_user_enter'] == 2)
						{
							$sql = 'UPDATE ' . GROUPS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
								'group_meeting_create' => 1)) . ' WHERE ' . $db->sql_in_set('group_id', $group_id);
							$db->sql_query($sql);
						}
					}

					$sql = 'UPDATE ' . GROUPS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
						'group_meeting_select' => 0));
					$db->sql_query($sql);
		
					if ($group_id_2[0] == -1)
					{
						$sql = 'UPDATE ' . GROUPS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
							'group_meeting_select' => 1));
						$db->sql_query($sql);
					}
					else if (sizeof($group_id_2) > 0)
					{
						$sql = 'UPDATE ' . GROUPS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
							'group_meeting_select' => 1)) . ' WHERE ' . $db->sql_in_set('group_id', $group_id_2);
						$db->sql_query($sql);
					}

					add_log('admin', 'MEETING_LOG_CONFIG');

					$message = $user->lang['MEETING_CONFIG_UPDATED'] . adm_back_link($this->u_action);
					trigger_error($message);
				}
			
				$users_allow_enter_meeting_group	= ( $new['meeting_user_enter'] == 2 ) ? 'checked="checked"' : '';
			
				$users_allow_enter_meeting_yes	= ( $new['meeting_user_enter'] == 1 ) ? 'checked="checked"' : '';
				$users_allow_enter_meeting_no	= ( !$new['meeting_user_enter'] ) ? 'checked="checked"' : '';
			
				$users_allow_edit_meeting_yes	= ( $new['meeting_user_edit'] ) ? 'checked="checked"' : '';
				$users_allow_edit_meeting_no	= ( !$new['meeting_user_edit'] ) ? 'checked="checked"' : '';
			
				$users_allow_delete_meeting_yes	= ( $new['meeting_user_delete'] ) ? 'checked="checked"' : '';
				$users_allow_delete_meeting_no	= ( !$new['meeting_user_delete'] ) ? 'checked="checked"' : '';
			
				$users_allow_delete_meeting_comments_yes	= ( $new['meeting_user_delete_comments'] ) ? 'checked="checked"' : '';
				$users_allow_delete_meeting_comments_no		= ( !$new['meeting_user_delete_comments'] ) ? 'checked="checked"' : '';
			
				$meeting_notify_yes	= ( $new['meeting_notify'] ) ? 'checked="checked"' : '';
				$meeting_notify_no	= ( !$new['meeting_notify'] ) ? 'checked="checked"' : '';
	
				$meeting_first_weekday_m = ( $new['meeting_first_weekday'] == 'm' ) ? 'checked="checked"' : '';
				$meeting_first_weekday_s = ( $new['meeting_first_weekday'] == 's' ) ? 'checked="checked"' : '';
 		
				$sql = 'SELECT group_id, group_name, group_meeting_create, group_meeting_select, group_type FROM ' . GROUPS_TABLE . '
					ORDER BY group_name';
				$result = $db->sql_query($sql);
			
				$s_meeting_usergroup = '<select name="group_id[]" multiple="multiple" size="10">';
				$s_meeting_usergroup .= '<option value="-1"' . ((!$users_allow_enter_meeting_group) ? 'selected="selected"' : '') . '>' . $user->lang['MEETING_ALL_USERS'] . '</option>';

				$s_meeting_usergroup_2 = '<select name="group_id_2[]" multiple="multiple" size="10">';
				$s_meeting_usergroup_2 .= '<option value="-1" {SELECT} >' . $user->lang['MEETING_ALL_GROUPS'] . '</option>';

				$group_select = true;
					
				while ($row = $db->sql_fetchrow($result))
				{
					$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];

					$selected = ($row['group_meeting_create']) ? 'selected="selected"' : '';
					$s_meeting_usergroup .= '<option value="' . $row['group_id'] . '" '.$selected.'>' . $group_name . '</option>';

					$selected = ($row['group_meeting_select']) ? 'selected="selected"' : '';
					$s_meeting_usergroup_2 .= '<option value="' . $row['group_id'] . '" '.$selected.'>' . $group_name . '</option>';

					if (!$row['group_meeting_select'])
					{
						$group_select = false;
					}
				}

				$db->sql_freeresult($result);
	
				$s_meeting_usergroup .= '</select>';
				$s_meeting_usergroup_2 .= '</select>';

				if ($group_select)
				{
					$s_meeting_usergroup_2 = str_replace(' selected="selected"', '', $s_meeting_usergroup_2);
					$s_meeting_usergroup_2 = str_replace('{SELECT}', 'selected="selected"', $s_meeting_usergroup_2);
				}
				else
				{
					$s_meeting_usergroup_2 = str_replace(' {SELECT} ', '', $s_meeting_usergroup_2);
				}
	
				$s_meeting_sign_perm = '<select name="meeting_sign_perm">';
				$s_meeting_sign_perm .= '<option value="0">' . $user->lang['MEETING_SIGN_OTHER_P1'] . '</option>';
				$s_meeting_sign_perm .= '<option value="1">' . $user->lang['MEETING_SIGN_OTHER_P2'] . '</option>';
				$s_meeting_sign_perm .= '<option value="2">' . $user->lang['MEETING_SIGN_OTHER_P3'] . '</option>';
				$s_meeting_sign_perm .= '<option value="3">' . $user->lang['MEETING_SIGN_OTHER_P4'] . '</option>';
				$s_meeting_sign_perm .= '</select>';

				$s_meeting_sign_perm = str_replace('value="' . $new['meeting_sign_perm'] . '">', 'value="' . $new['meeting_sign_perm'] . '" selected="selected">', $s_meeting_sign_perm);

				$template->assign_vars(array(
					'MODULE_NAME'		=> $user->lang['MEETING_CONFIG'],
					'MODULE_EXPLAIN'	=> $user->lang['MEETING_CONFIG_EXPLAIN'],
			
					'USER_ALLOW_ENTER_MEETING_GROUP'	=> $users_allow_enter_meeting_group,
			
					'USER_ALLOW_ENTER_MEETING_YES'	=> $users_allow_enter_meeting_yes,
					'USER_ALLOW_ENTER_MEETING_NO'	=> $users_allow_enter_meeting_no, 
			
					'USER_ALLOW_EDIT_MEETING_YES'	=> $users_allow_edit_meeting_yes,
					'USER_ALLOW_EDIT_MEETING_NO'	=> $users_allow_edit_meeting_no, 
			
					'USER_ALLOW_DELETE_MEETING_YES'	=> $users_allow_delete_meeting_yes,
					'USER_ALLOW_DELETE_MEETING_NO'	=> $users_allow_delete_meeting_no, 
			
					'USER_ALLOW_DELETE_MEETING_COMMENTS_YES'	=> $users_allow_delete_meeting_comments_yes,
					'USER_ALLOW_DELETE_MEETING_COMMENTS_NO'		=> $users_allow_delete_meeting_comments_no, 
			
					'MEETING_NOTIFY_YES'	=> $meeting_notify_yes,
					'MEETING_NOTIFY_NO'		=> $meeting_notify_no, 
			
					'MEETING_FIRST_WEEKDAY_M'	=> $meeting_first_weekday_m,
					'MEETING_FIRST_WEEKDAY_S'	=> $meeting_first_weekday_s,

					'S_USERGROUPS_CREATE'	=> $s_meeting_usergroup,
					'S_USERGROUPS_SELECT'	=> $s_meeting_usergroup_2,
					'S_MEETING_SIGN_PERM'	=> $s_meeting_sign_perm,
			
					'S_FORM_ACTION'	=> $basic_link,
				));
				
				$template->assign_var('S_MEETING_CONFIG', true);
			break;

			case 'add':
			case 'manage':
				if ($mode == 'add')
				{
					$this->page_title = 'MEETING_ADD';
				}
				else
				{
					$this->page_title = 'MEETING_MANAGE';
				}

				add_form_key('meeting_edit');

				if ($submit && !check_form_key('meeting_edit'))
				{
					trigger_error('FORM_INVALID', E_USER_WARNING);
				}

				// Save the meeting
				if ($submit)
				{
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
						$sql = 'DELETE FROM ' . MEETING_USERGROUP_TABLE . '
							WHERE meeting_id = ' . (int) $m_id;
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
						$sql = 'SELECT COUNT(user_id) AS total_users FROM ' . USERS_TABLE;
						$result = $db->sql_query($sql);
						$meeting_places = $db->sql_fetchfield('total_users');
						$db->sql_freeresult($result);
					}
				
					if (isset($group_id) && $group_id[0] != -1)
					{
						$usergroups = '';
						$sql_usergroups = '';
				
						$sql_usergroups = ' AND ' . $db->sql_in_set('g.group_id', $group_id);
				
						$sql = 'SELECT COUNT(DISTINCT ug.user_id) AS total_users FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
							WHERE ug.group_id = g.group_id
							AND ug.user_pending <> ' . true . "
							$sql_usergroups";
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
								'meeting_group'	=> -1));
							$db->sql_query($sql);
						}
						else
						{
							for ($i = 0; $i < sizeof($group_id); $i++)
							{
								$sql = 'INSERT INTO ' . MEETING_USERGROUP_TABLE . $db->sql_build_array('INSERT', array(
									'meeting_id'	=> $next_id,
									'meeting_group'	=> intval($group_id[$i])));
								$db->sql_query($sql);
							}
						}
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

					$log_title = ($m_id) ? 'MEETING_LOG_EDIT' : 'MEETING_LOG_ADD';
					add_log('admin', $log_title, $meeting_subject);

					$meeting_save_text = ($m_id) ? $user->lang['MEETING_DATA_UPDATED'] : $user->lang['MEETING_DATA_STORED'];
					$message = $meeting_save_text . adm_back_link($basic_link_smode . '&amp;mode=manage');
					trigger_error($message);
				}

				// Please confirm the deleting. The better way.
				if ($action == 'delete')
				{
					if (!$confirm)
					{
						page_header();

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
				
							'L_YES'				=> $user->lang['YES'],
							'L_NO'				=> $user->lang['NO'],
					
							'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
							'S_CONFIRM_ACTION'	=> $basic_link,
						));
					
						page_footer();
					}
					else
					{
						$sql = 'SELECT meeting_subject FROM ' . MEETING_DATA_TABLE . '
							WHERE meeting_id = ' . (int) $m_id;
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);
						$meeting_subject = $row['meeting_subject'];

						// Now we will delete. Good bye meeting :-)
						$sql = 'DELETE FROM ' . MEETING_COMMENT_TABLE . '
							WHERE meeting_id = ' . (int) $m_id;
						$db->sql_query($sql);
					
						$sql = 'DELETE FROM ' . MEETING_DATA_TABLE . '
							WHERE meeting_id = ' . (int) $m_id;
						$db->sql_query($sql);
					
						$sql = 'DELETE FROM ' . MEETING_GUESTNAMES_TABLE . '
							WHERE meeting_id = ' . (int) $m_id;
						$db->sql_query($sql);
				
						$sql = 'DELETE FROM ' . MEETING_USER_TABLE . '
							WHERE meeting_id = ' . (int) $m_id;
						$db->sql_query($sql);
					
						$sql = 'DELETE FROM ' . MEETING_USERGROUP_TABLE . '
							WHERE meeting_id = ' . (int) $m_id;
						$db->sql_query($sql);
					
						add_log('admin', 'MEETING_LOG_DELETE', $meeting_subject);

						redirect($basic_link_smode . '&amp;mode=manage');
					}
				}

				// Edit 
				if ($m_id || $mode == 'add')
				{
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
					if ($mode == 'manage' && $m_id)
					{
						$s_hidden_fields = array_merge($s_hidden_fields, array(
							'm_id'	=> $m_id,
						));

						$sql = 'SELECT meeting_group FROM ' . MEETING_USERGROUP_TABLE . '
							WHERE meeting_id = ' . (int) $m_id . '
							AND meeting_group <> -1';
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
							FROM ' . MEETING_DATA_TABLE . ' m, ' . USERS_TABLE . ' u1, ' . USERS_TABLE . ' u2
							WHERE m.meeting_id = ' . (int) $m_id . '
								AND m.meeting_by_user = u1.user_id
								AND m.meeting_edit_by_user = u2.user_id';
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

					$template->assign_vars(array(
						'MEETING_DATE'			=> $m_date,
						'MEETING_DATE_END'		=> $e_date,
						'MEETING_DATE_UNTIL'	=> $u_date,

						'MEETING_LOCATION'		=> $meeting_location,
						'MEETING_SUBJECT'		=> $meeting_subject,
						'MEETING_DESC'			=> $meeting_desc,
						'MEETING_LINK'			=> $meeting_link,
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
				}
				
				// Display the list of existing meetings
				if ($mode == 'manage' && !$m_id)
				{
					// Get per page value
					$per_page = $config['topics_per_page'];
					
					$closed_no		= '';
					$closed_yes		= '';
					$closed_period	= '';
					$closed_none	= '';
				
					$sql_closed = (!$sql_filter) ? ' WHERE ' : ' AND ';
					$current_time = time();

					switch ($closed)
					{
						case 1:
							$sql_closed .= 'meeting_time > ' . $current_time;
							$closed_no = 'checked="checked"';
							break;
						case 2:
							$sql_closed .= 'meeting_time < ' . $current_time;
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
				
					// SQL statement to read from a table
					$sql = 'SELECT * FROM ' . MEETING_DATA_TABLE . "
						$sql_filter
						$sql_closed
						ORDER BY $sort_field $sort_order";
					$result = $db->sql_query_limit($sql, $per_page, $start);
					$total_meeting = $db->sql_affectedrows($result);
					$meetingrow = $db->sql_fetchrowset($result);
					$db->sql_freeresult($result);
				
					// Output global values
					$template->assign_vars(array(
						'MODULE_NAME'		=> $user->lang['MEETING_MANAGE'],
						'MODULE_EXPLAIN'	=> $user->lang['MEETING_MANAGE_EXPLAIN'],
				
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
						'S_FORM_ACTION'		=> $basic_link,
					));
				
					if ($total_meeting)
					{
						// Cycle a loop through all data
						for($i = 0; $i < $total_meeting; $i++)
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
							$meeting_location	= ($meeting_link != '') ? '<a href="' . $meeting_link . '">' . $meeting_location . '</a>' : $meeting_location;
				
							$meeting_id			= $meetingrow[$i]['meeting_id'];
							$meeting_edit		= $basic_link_smode . "&amp;mode=manage&amp;m_id=$meeting_id";
							$meeting_delete		= $basic_link_smode . "&amp;mode=manage&amp;action=delete&amp;m_id=$meeting_id";
				
							$meeting_closed		= ($meeting_check_time < time()) ? $user->lang['YES'] : (($meeting_check_until < time()) ? $user->lang['MEETING_NO_PERIOD'] : $user->lang['NO']);
				
							// Output the values
							$template->assign_block_vars('meeting_row', array(
								'MEETING_TIME'		=> $meeting_time . (($meeting_end == $meeting_time) ? '' : '<br />&raquo;<br />' . $meeting_end),
								'MEETING_UNTIL'		=> $meeting_until,
								'MEETING_LOCATION'	=> $meeting_location,
								'MEETING_SUBJECT'	=> $meeting_subject,
								'MEETING_CLOSED'	=> $meeting_closed,
								'MEETING_EDIT'		=> $meeting_edit,
								'MEETING_DELETE'	=> $meeting_delete)
							);
						}
				
						// Create the pagination
						$sql = 'SELECT * FROM ' . MEETING_DATA_TABLE . "
							$sql_filter
							$sql_closed";
						$result = $db->sql_query($sql);
						$total_meetings = $db->sql_affectedrows($result);
						$db->sql_freeresult($result);
						$pagination = generate_pagination($basic_link, $total_meetings, $per_page, $start);
						
						$template->assign_vars(array(
							'PAGINATION' => $pagination)
						);
					}
					else
					{
						// Output message if no meeting was found
						$template->assign_var('S_NO_MEETING', true);
					}
				} 				

				if ($mode == 'add' || $mode == 'manage' && $m_id)
				{
					$template->assign_var('S_MEETING_EDIT', true);
				}
				else
				{
					$template->assign_var('S_MEETING_MANAGE', true);
				}
			break;
		}
	}
}

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
		return 0;
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

	return '<input type="text" name="' . $module . '" id="' . $module . '" class="tcal" value="' . $date . '" readonly="readonly" size="11" maxlength="10" /><a href="#" onclick="DropDate(\'' . $module . '\');" style="text-decoration: none; border: 1px #A9B8C2 solid; padding: 1px 2px 1px 2px; background-color: #ECECEC;" /><strong>X</strong></a>&nbsp&nbsp;<input type="text" name="' . $module . '_time" size="5" maxlength="5" value="' . $time . '" />';
}

?>