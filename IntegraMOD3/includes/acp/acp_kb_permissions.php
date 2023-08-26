<?php
/** 
*
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package Knowledge_Base
* @version $Id$
* @copyright (c) 2007 SEO phpBB http://www.phpbb-seo.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*
* based on
* @version $Id: acp_permissions.php 9496 2009-04-29 14:52:43Z acydburn $
* @version $Id: acp_permission_roles.php 8479 2008-03-29 00:22:48Z naderman $
* @copyright (c) 2005 phpBB Group
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
class acp_kb_permissions
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		include($phpbb_root_path . 'includes/functions_kb.' . $phpEx);

		include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);
		include_once($phpbb_root_path . 'includes/acp/auth.' . $phpEx);

		$auth_admin = new auth_admin();

		$user->add_lang('acp/permissions');
		add_permission_language();


		add_form_key('acp_kb');
		$user->add_lang('mods/kb');
		switch ($mode)
		{

			case 'set_roles':
				$this->tpl_name = 'acp_permission_roles';


				$submit = (isset($_POST['submit'])) ? true : false;
				$role_id = request_var('role_id', 0);
				$action = request_var('action', '');
				$action = (isset($_POST['add'])) ? 'add' : $action;

				$permission_type = 'kb_';
				$this->page_title = 'ACP_KB_ROLES';

				$template->assign_vars(array(
					'L_TITLE'		=> $user->lang[$this->page_title],
					'L_FORUM'		=> $user->lang['CATEGORIE'],
					'L_EXPLAIN'		=> $user->lang[$this->page_title . '_EXPLAIN'])
				);

				// Take action... admin submitted something
				if ($submit || $action == 'remove')
				{
					switch ($action)
					{
						case 'remove':

							if (!$role_id)
							{
								trigger_error($user->lang['NO_ROLE_SELECTED'] . adm_back_link($this->u_action), E_USER_WARNING);
							}

							$sql = 'SELECT *
								FROM ' . ACL_ROLES_TABLE . '
								WHERE role_id = ' . $role_id;
							$result = $db->sql_query($sql);
							$role_row = $db->sql_fetchrow($result);
							$db->sql_freeresult($result);

							if (!$role_row)
							{
								trigger_error($user->lang['NO_ROLE_SELECTED'] . adm_back_link($this->u_action), E_USER_WARNING);
							}

							if (confirm_box(true))
							{
								$this->remove_role($role_id, $permission_type);

								$role_name = (!empty($user->lang[$role_row['role_name']])) ? $user->lang[$role_row['role_name']] : $role_row['role_name'];
								add_log('admin', 'LOG_' . strtoupper($permission_type) . 'ROLE_REMOVED', $role_name);
								trigger_error($user->lang['ROLE_DELETED'] . adm_back_link($this->u_action));
							}
							else
							{
								confirm_box(false, 'DELETE_ROLE', build_hidden_fields(array(
									'i'			=> $id,
									'mode'		=> $mode,
									'role_id'	=> $role_id,
									'action'	=> $action,
								)));
							}

						break;

						case 'edit':
							if (!$role_id)
							{
								trigger_error($user->lang['NO_ROLE_SELECTED'] . adm_back_link($this->u_action), E_USER_WARNING);
							}

							// Get role we edit
							$sql = 'SELECT *
								FROM ' . ACL_ROLES_TABLE . '
								WHERE role_id = ' . $role_id;
							$result = $db->sql_query($sql);
							$role_row = $db->sql_fetchrow($result);
							$db->sql_freeresult($result);

							if (!$role_row)
							{
								trigger_error($user->lang['NO_ROLE_SELECTED'] . adm_back_link($this->u_action), E_USER_WARNING);
							}

						// no break;

						case 'add':

							if (!check_form_key('acp_kb'))
							{
								trigger_error($user->lang['FORM_INVALID']. adm_back_link($this->u_action), E_USER_WARNING);
							}

							$role_name = utf8_normalize_nfc(request_var('role_name', '', true));
							$role_description = utf8_normalize_nfc(request_var('role_description', '', true));
							$auth_settings = request_var('setting', array('' => 0));

							if (!$role_name)
							{
								trigger_error($user->lang['NO_ROLE_NAME_SPECIFIED'] . adm_back_link($this->u_action), E_USER_WARNING);
							}

							if (utf8_strlen($role_description) > 4000)
							{
								trigger_error($user->lang['ROLE_DESCRIPTION_LONG'] . adm_back_link($this->u_action), E_USER_WARNING);
							}

							// if we add/edit a role we check the name to be unique among the settings...
							$sql = 'SELECT role_id
								FROM ' . ACL_ROLES_TABLE . "
								WHERE role_type = '" . $db->sql_escape($permission_type) . "'
									AND role_name = '" . $db->sql_escape($role_name) . "'";
							$result = $db->sql_query($sql);
							$row = $db->sql_fetchrow($result);
							$db->sql_freeresult($result);

							// Make sure we only print out the error if we add the role or change it's name
							if ($row && ($mode == 'add' || ($mode == 'edit' && $role_row['role_name'] != $role_name)))
							{
								trigger_error(sprintf($user->lang['ROLE_NAME_ALREADY_EXIST'], $role_name) . adm_back_link($this->u_action), E_USER_WARNING);
							}

							$sql_ary = array(
								'role_name'			=> (string) $role_name,
								'role_description'	=> (string) $role_description,
								'role_type'			=> (string) $permission_type,
							);

							if ($action == 'edit')
							{
								$sql = 'UPDATE ' . ACL_ROLES_TABLE . '
									SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
									WHERE role_id = ' . $role_id;
								$db->sql_query($sql);
							}
							else
							{
								// Get maximum role order for inserting a new role...
								$sql = 'SELECT MAX(role_order) as max_order
									FROM ' . ACL_ROLES_TABLE . "
									WHERE role_type = '" . $db->sql_escape($permission_type) . "'";
								$result = $db->sql_query($sql);
								$max_order = (int) $db->sql_fetchfield('max_order');
								$db->sql_freeresult($result);

								$sql_ary['role_order'] = $max_order + 1;

								$sql = 'INSERT INTO ' . ACL_ROLES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
								$db->sql_query($sql);

								$role_id = $db->sql_nextid();
							}

							// Now add the auth settings
							$auth_admin->acl_set_role($role_id, $auth_settings);

							$role_name = (!empty($user->lang[$role_name])) ? $user->lang[$role_name] : $role_name;
							add_log('admin', 'LOG_' . strtoupper($permission_type) . 'ROLE_' . strtoupper($action), $role_name);

							trigger_error($user->lang['ROLE_' . strtoupper($action) . '_SUCCESS'] . adm_back_link($this->u_action));

						break;
					}
				}

				// Display screens
				switch ($action)
				{
					case 'add':

						$options_from = request_var('options_from', 0);

						$role_row = array(
							'role_name'			=> utf8_normalize_nfc(request_var('role_name', '', true)),
							'role_description'	=> utf8_normalize_nfc(request_var('role_description', '', true)),
							'role_type'			=> $permission_type,
						);

						if ($options_from)
						{
							$sql = 'SELECT p.auth_option_id, p.auth_setting, o.auth_option
								FROM ' . ACL_ROLES_DATA_TABLE . ' p, ' . ACL_OPTIONS_TABLE . ' o
								WHERE o.auth_option_id = p.auth_option_id
									AND p.role_id = ' . $options_from . '
								ORDER BY p.auth_option_id';
							$result = $db->sql_query($sql);

							$auth_options = array();
							while ($row = $db->sql_fetchrow($result))
							{
								$auth_options[$row['auth_option']] = $row['auth_setting'];
							}
							$db->sql_freeresult($result);
						}
						else
						{
							$sql = 'SELECT auth_option_id, auth_option
								FROM ' . ACL_OPTIONS_TABLE . "
								WHERE auth_option " . $db->sql_like_expression($permission_type . $db->any_char) . "
									AND auth_option <> '{$permission_type}'
								ORDER BY auth_option_id";
							$result = $db->sql_query($sql);

							$auth_options = array();
							while ($row = $db->sql_fetchrow($result))
							{
								$auth_options[$row['auth_option']] = ACL_NO;
							}
							$db->sql_freeresult($result);
						}

					// no break;

					case 'edit':

						if ($action == 'edit')
						{
							if (!$role_id)
							{
								trigger_error($user->lang['NO_ROLE_SELECTED'] . adm_back_link($this->u_action), E_USER_WARNING);
							}
					
							$sql = 'SELECT *
								FROM ' . ACL_ROLES_TABLE . '
								WHERE role_id = ' . $role_id;
							$result = $db->sql_query($sql);
							$role_row = $db->sql_fetchrow($result);
							$db->sql_freeresult($result);

							$sql = 'SELECT p.auth_option_id, p.auth_setting, o.auth_option
								FROM ' . ACL_ROLES_DATA_TABLE . ' p, ' . ACL_OPTIONS_TABLE . ' o
								WHERE o.auth_option_id = p.auth_option_id
									AND p.role_id = ' . $role_id . '
								ORDER BY p.auth_option_id';
							$result = $db->sql_query($sql);

							$auth_options = array();
							while ($row = $db->sql_fetchrow($result))
							{
								$auth_options[$row['auth_option']] = $row['auth_setting'];
							}
							$db->sql_freeresult($result);
						}

						if (!$role_row)
						{
							trigger_error($user->lang['NO_ROLE_SELECTED'] . adm_back_link($this->u_action), E_USER_WARNING);
						}

						$template->assign_vars(array(
							'S_EDIT'			=> true,

							'U_ACTION'			=> $this->u_action . "&amp;action={$action}&amp;role_id={$role_id}",
							'U_BACK'			=> $this->u_action,

							'ROLE_NAME'			=> $role_row['role_name'],
							'ROLE_DESCRIPTION'	=> $role_row['role_description'],
							'L_ACL_TYPE'		=> $user->lang['ACL_TYPE_' . strtoupper($permission_type)],
							)
						);

						// We need to fill the auth options array with ACL_NO options ;)
						$sql = 'SELECT auth_option_id, auth_option
							FROM ' . ACL_OPTIONS_TABLE . "
							WHERE auth_option " . $db->sql_like_expression($permission_type . $db->any_char) . "
								AND auth_option <> '{$permission_type}'
							ORDER BY auth_option_id";
						$result = $db->sql_query($sql);

						while ($row = $db->sql_fetchrow($result))
						{
							if (!isset($auth_options[$row['auth_option']]))
							{
								$auth_options[$row['auth_option']] = ACL_NO;
							}
						}
						$db->sql_freeresult($result);

						// Unset global permission option
						unset($auth_options[$permission_type]);

						// Display auth options
						$this->display_auth_options($auth_options);

						// Get users/groups/categories using this preset...
						if ($action == 'edit')
						{
							$hold_ary = $auth_admin->get_role_mask($role_id);

							if (sizeof($hold_ary))
							{
								$role_name = (!empty($user->lang[$role_row['role_name']])) ? $user->lang[$role_row['role_name']] : $role_row['role_name'];

								$template->assign_vars(array(
									'S_DISPLAY_ROLE_MASK'	=> true,
									'L_ROLE_ASSIGNED_TO'	=> sprintf($user->lang['ROLE_ASSIGNED_TO'], $role_name))
								);

								$auth_admin->display_role_mask($hold_ary);
							}
						}

						return;
					break;

					case 'move_up':
					case 'move_down':

						$order = request_var('order', 0);
						$order_total = $order * 2 + (($action == 'move_up') ? -1 : 1);

						$sql = 'UPDATE ' . ACL_ROLES_TABLE . '
							SET role_order = ' . $order_total . " - role_order
							WHERE role_type = '" . $db->sql_escape($permission_type) . "'
								AND role_order IN ($order, " . (($action == 'move_up') ? $order - 1 : $order + 1) . ')';
						$db->sql_query($sql);

					break;
				}

				// By default, check that role_order is valid and fix it if necessary
				$sql = 'SELECT role_id, role_order
					FROM ' . ACL_ROLES_TABLE . "
					WHERE role_type = '" . $db->sql_escape($permission_type) . "'
					ORDER BY role_order ASC";
				$result = $db->sql_query($sql);

				if ($row = $db->sql_fetchrow($result))
				{
					$order = 0;
					do
					{
						$order++;
						if ($row['role_order'] != $order)
						{
							$db->sql_query('UPDATE ' . ACL_ROLES_TABLE . " SET role_order = $order WHERE role_id = {$row['role_id']}");
						}
					}
					while ($row = $db->sql_fetchrow($result));
				}
				$db->sql_freeresult($result);

				// Display assigned items?
				$display_item = request_var('display_item', 0);

				// Select existing roles
				$sql = 'SELECT *
					FROM ' . ACL_ROLES_TABLE . "
					WHERE role_type = '" . $db->sql_escape($permission_type) . "'
					ORDER BY role_order ASC";
				$result = $db->sql_query($sql);

				$s_role_options = '';
				while ($row = $db->sql_fetchrow($result))
				{
					$role_name = (!empty($user->lang[$row['role_name']])) ? $user->lang[$row['role_name']] : $row['role_name'];

					$template->assign_block_vars('roles', array(
						'ROLE_NAME'				=> $role_name,
						'ROLE_DESCRIPTION'		=> (!empty($user->lang[$row['role_description']])) ? $user->lang[$row['role_description']] : nl2br($row['role_description']),

						'U_EDIT'			=> $this->u_action . '&amp;action=edit&amp;role_id=' . $row['role_id'],
						'U_REMOVE'			=> $this->u_action . '&amp;action=remove&amp;role_id=' . $row['role_id'],
						'U_MOVE_UP'			=> $this->u_action . '&amp;action=move_up&amp;order=' . $row['role_order'],
						'U_MOVE_DOWN'		=> $this->u_action . '&amp;action=move_down&amp;order=' . $row['role_order'],
						'U_DISPLAY_ITEMS'	=> ($row['role_id'] == $display_item) ? '' : $this->u_action . '&amp;display_item=' . $row['role_id'] . '#assigned_to')
					);

					$s_role_options .= '<option value="' . $row['role_id'] . '">' . $role_name . '</option>';

					if ($display_item == $row['role_id'])
					{
						$template->assign_vars(array(
							'L_ROLE_ASSIGNED_TO'	=> sprintf($user->lang['ROLE_ASSIGNED_TO'], $role_name))
						);
					}
				}
				$db->sql_freeresult($result);

				$template->assign_vars(array(
					'S_ROLE_OPTIONS'		=> $s_role_options)
				);

				if ($display_item)
				{
					$template->assign_vars(array(
						'S_DISPLAY_ROLE_MASK'	=> true)
					);

					$hold_ary = $auth_admin->get_role_mask($display_item);
					$auth_admin->display_role_mask($hold_ary);
				}
			break;

			case 'set_permissions':

			$this->tpl_name = 'acp_permissions';
			$this->page_title = $user->lang['PERMISSION_TYPE'];

	
			$action = request_var('action', array('' => 0));
			$action = key($action);
			$action = (isset($_POST['psubmit'])) ? 'apply_permissions' : $action;
			$permission_type = 'kb_';

			$all_forums = request_var('all_forums', 0);
			$subforum_id = request_var('subforum_id', 0);
			$forum_id = request_var('forum_id', array(0));

			$username = request_var('username', array(''), true);
			$usernames = request_var('usernames', '', true);
			$user_id = request_var('user_id', array(0));

			$group_id = request_var('group_id', array(0));
			$select_all_groups = request_var('select_all_groups', 0);
			// Build forum ids (of all forums are checked or subforum listing used)

			if ($all_forums)
			{
				$sql = 'SELECT cat_id
					FROM ' .  KB_CATEGORIE_TABLE . '
					ORDER BY left_id';
				$result = $db->sql_query($sql);

				$forum_id = array();
				while ($row = $db->sql_fetchrow($result))
				{
					$forum_id[] = (int) $row['cat_id'];
				}
				$db->sql_freeresult($result);
			}
			else if ($subforum_id)
			{
				$forum_id = array();
				foreach (get_categorie_branch($subforum_id, 'children') as $row)
				{
					$forum_id[] = (int) $row['cat_id'];
				}
			}

			// Setting permissions screen
			$s_hidden_fields = build_hidden_fields(array(
				'user_id'		=> $user_id,
				'group_id'		=> $group_id,
				'forum_id'		=> $forum_id,
				)
			);
			switch($action)
			{
				case 'apply_all_permissions':
					$this->set_all_permissions(false, $permission_type, $auth_admin, $user_id, $group_id);
				break;

				case 'apply_permissions':
					$this->set_permissions($mode, $permission_type, $auth_admin, $user_id, $group_id);
				break;

				case 'delete':
					if (!check_form_key('acp_kb'))
					{
						trigger_error($user->lang['FORM_INVALID']. adm_back_link($this->u_action), E_USER_WARNING);
					}
					// All users/groups selected?
					$all_users = (isset($_POST['all_users'])) ? true : false;
					$all_groups = (isset($_POST['all_groups'])) ? true : false;

					if ($all_users || $all_groups)
					{
						$items = $this->retrieve_defined_user_groups($permission_scope, $forum_id, $permission_type);

						if ($all_users && sizeof($items['user_ids']))
						{
							$user_id = $items['user_ids'];
						}
						else if ($all_groups && sizeof($items['group_ids']))
						{
							$group_id = $items['group_ids'];
						}
					}

					if (sizeof($user_id) || sizeof($group_id))
					{
						$this->remove_permissions($mode, $permission_type, $auth_admin, $user_id, $group_id, $forum_id);
					}
					else
					{
						trigger_error($user->lang['NO_USER_GROUP_SELECTED'] . adm_back_link($this->u_action), E_USER_WARNING);
					}
				break;
			}

			if($usernames or $username or sizeof($user_id) or sizeof($group_id))
			{
				//Overwrite forum names with categorie names
				$sql = 'SELECT cat_id, cat_title, parent_id, left_id, right_id, cat_mode
					FROM ' . KB_CATEGORIE_TABLE . '
					ORDER BY left_id ASC';
				$result = $db->sql_query($sql);
				while($row = $db->sql_fetchrow($result))
				{
					$cat_data[$row['cat_id']]['forum_name'] = $row['cat_title'];
					$cat_data[$row['cat_id']]['forum_id'] = $row['cat_id'];
					$cat_data[$row['cat_id']]['disabled'] = false;
					$cat_data[$row['cat_id']]['padding'] = '';
				}


				$hold_ary = $this->get_mask('set', (sizeof($user_id)) ? $user_id : false, (sizeof($group_id)) ? $group_id : false, (sizeof($forum_id)) ? $forum_id : false, $permission_type, 'local', ACL_NO);
				$auth_admin->display_mask('set', $permission_type, $hold_ary, ((sizeof($user_id)) ? 'user' : 'group'), true , true, $cat_data);

				$template->assign_vars(array(
					'S_SETTING_PERMISSIONS'	=> true,
				));
			}

			elseif($all_forums or sizeof($forum_id) or $subforum_id)
			{
				$items = $this->retrieve_defined_user_groups('local', $forum_id, $permission_type);
				$template->assign_vars(array(
					'L_TITLE'					=> $user->lang['KB_CATEGORIE_PERMISSIONS'],
					'L_EXPLAIN'					=> $user->lang['KB_CATEGORIE_PERMISSIONS_DESC'],
					'S_SELECT_USERGROUP'		=> true,
					'S_CAN_SELECT_USER'			=> true,
					'S_CAN_SELECT_GROUP'		=> true,
					'S_SELECT_VICTIM' 			=> true,
					'S_DEFINED_USER_OPTIONS'	=> $items['user_ids_options'],
					'S_DEFINED_GROUP_OPTIONS'	=> $items['group_ids_options'],
					'S_ADD_GROUP_OPTIONS'		=> group_select_options(false, $items['group_ids'], false),	// Show all groups
					'S_HIDDEN_FIELDS'			=> $s_hidden_fields,

				));
			}
			else
			{
				$template->assign_vars(array(
					'L_TITLE'					=> $user->lang['KB_CATEGORIE_PERMISSIONS'],
					'L_EXPLAIN'					=> $user->lang['KB_CATEGORIE_PERMISSIONS_DESC'],
					'L_LOOK_UP_FORUM'			=> $user->lang['LOOK_UP_CATEGORIE'],
					'L_LOOK_UP_FORUMS_EXPLAIN'	=> $user->lang['LOOK_UP_FORUMS_EXPLAIN'],
					'L_ALL_FORUMS'				=> $user->lang['ALL_CATEGORIES'],
					'L_SELECT_FORUM_SUBFORUM_EXPLAIN'		=> $user->lang['SELECT_CATEGORIE_SUBFORUM_EXPLAIN'],
					'U_ACTION'					=> $this->u_action,
					'S_PERMISSION_C_MASK'		=> true,
					'S_FORUM_OPTIONS'			=> make_cat_select(false, 2),
					'S_SUBFORUM_OPTIONS'		=> make_cat_select(false, 2),
					'S_FORUM_MULTIPLE'			=> true,
					'S_FORUM_ALL'				=> true,
					'S_SELECT_FORUM'			=> true,
					'S_SELECT_VICTIM' 			=> true,
					'S_HIDDEN_FIELDS'			=> $s_hidden_fields,
				));
			}
		}
	}


	/**
	* Display permission settings able to be set
	*/
	function display_auth_options($auth_options)
	{
		global $template, $user;

		$content_array = $categories = array();
		$key_sort_array = array(0);
		$auth_options = array(0 => $auth_options);

		// Making use of auth_admin method here (we do not really want to change two similar code fragments)
		auth_admin::build_permission_array($auth_options, $content_array, $categories, $key_sort_array);

		$content_array = $content_array[0];

		$template->assign_var('S_NUM_PERM_COLS', sizeof($categories));

		// Assign to template
		foreach ($content_array as $cat => $cat_array)
		{
			$template->assign_block_vars('auth', array(
				'CAT_NAME'	=> $user->lang['permission_cat'][$cat],

				'S_YES'		=> ($cat_array['S_YES'] && !$cat_array['S_NEVER'] && !$cat_array['S_NO']) ? true : false,
				'S_NEVER'	=> ($cat_array['S_NEVER'] && !$cat_array['S_YES'] && !$cat_array['S_NO']) ? true : false,
				'S_NO'		=> ($cat_array['S_NO'] && !$cat_array['S_NEVER'] && !$cat_array['S_YES']) ? true : false)
			);

			foreach ($cat_array['permissions'] as $permission => $allowed)
			{
				$template->assign_block_vars('auth.mask', array(
					'S_YES'		=> ($allowed == ACL_YES) ? true : false,
					'S_NEVER'	=> ($allowed == ACL_NEVER) ? true : false,
					'S_NO'		=> ($allowed == ACL_NO) ? true : false,

					'FIELD_NAME'	=> $permission,
					'PERMISSION'	=> $user->lang['acl_' . $permission]['lang'])
				);
			}
		}
	}

	/**
	* Remove role
	*/
	function remove_role($role_id, $permission_type)
	{
		global $db;

		$auth_admin = new auth_admin();

		// Get complete auth array
		$sql = 'SELECT auth_option, auth_option_id
			FROM ' . ACL_OPTIONS_TABLE . "
			WHERE auth_option " . $db->sql_like_expression($permission_type . $db->any_char);
		$result = $db->sql_query($sql);

		$auth_settings = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$auth_settings[$row['auth_option']] = ACL_NO;
		}
		$db->sql_freeresult($result);

		// Get the role auth settings we need to re-set...
		$sql = 'SELECT o.auth_option, r.auth_setting
			FROM ' . ACL_ROLES_DATA_TABLE . ' r, ' . ACL_OPTIONS_TABLE . ' o
			WHERE o.auth_option_id = r.auth_option_id
				AND r.role_id = ' . $role_id;
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$auth_settings[$row['auth_option']] = $row['auth_setting'];
		}
		$db->sql_freeresult($result);

		// Get role assignments
		$hold_ary = $auth_admin->get_role_mask($role_id);

		// Re-assign permissions
		foreach ($hold_ary as $forum_id => $forum_ary)
		{
			if (isset($forum_ary['users']))
			{
				$auth_admin->acl_set('user', $forum_id, $forum_ary['users'], $auth_settings, 0, false);
			}

			if (isset($forum_ary['groups']))
			{
				$auth_admin->acl_set('group', $forum_id, $forum_ary['groups'], $auth_settings, 0, false);
			}
		}

		// Remove role from users and groups just to be sure (happens through acl_set)
		$sql = 'DELETE FROM ' . ACL_USERS_TABLE . '
			WHERE auth_role_id = ' . $role_id;
		$db->sql_query($sql);

		$sql = 'DELETE FROM ' . ACL_GROUPS_TABLE . '
			WHERE auth_role_id = ' . $role_id;
		$db->sql_query($sql);

		// Remove role data and role
		$sql = 'DELETE FROM ' . ACL_ROLES_DATA_TABLE . '
			WHERE role_id = ' . $role_id;
		$db->sql_query($sql);

		$sql = 'DELETE FROM ' . ACL_ROLES_TABLE . '
			WHERE role_id = ' . $role_id;
		$db->sql_query($sql);

		$auth_admin->acl_clear_prefetch();
	}



	/**
	* Remove permissions
	*/
	function remove_permissions($mode, $permission_type, &$auth_admin, &$user_id, &$group_id, &$forum_id)
	{
		global $user, $db, $auth;

		// User or group to be set?
		$ug_type = (sizeof($user_id)) ? 'user' : 'group';

		$auth_admin->acl_delete($ug_type, (($ug_type == 'user') ? $user_id : $group_id), (sizeof($forum_id) ? $forum_id : false), $permission_type);



		if ($mode == 'setting_forum_local' || $mode == 'setting_mod_local')
		{
			trigger_error($user->lang['AUTH_UPDATED'] . adm_back_link($this->u_action . '&amp;forum_id[]=' . implode('&amp;forum_id[]=', $forum_id)));
		}
		else
		{
			trigger_error($user->lang['AUTH_UPDATED'] . adm_back_link($this->u_action));
		}
	}


	/**
	* Apply permissions
	*/
	function set_permissions($mode, $permission_type, &$auth_admin, &$user_id, &$group_id)
	{
		global $user, $auth;

		$psubmit = request_var('psubmit', array(0 => array(0 => 0)));

		// User or group to be set?
		$ug_type = (sizeof($user_id)) ? 'user' : 'group';


		$ug_id = $forum_id = 0;

		// We loop through the auth settings defined in our submit
		list($ug_id, ) = each($psubmit);
		list($forum_id, ) = each($psubmit[$ug_id]);

		if (empty($_POST['setting']) || empty($_POST['setting'][$ug_id]) || empty($_POST['setting'][$ug_id][$forum_id]) || !is_array($_POST['setting'][$ug_id][$forum_id]))
		{
			trigger_error('WRONG_PERMISSION_SETTING_FORMAT', E_USER_WARNING);
		}

		// We obtain and check $_POST['setting'][$ug_id][$forum_id] directly and not using request_var() because request_var()
		// currently does not support the amount of dimensions required. ;)
		//		$auth_settings = request_var('setting', array(0 => array(0 => array('' => 0))));
		$auth_settings = array_map('intval', $_POST['setting'][$ug_id][$forum_id]);

		// Do we have a role we want to set?
		$assigned_role = (isset($_POST['role'][$ug_id][$forum_id])) ? (int) $_POST['role'][$ug_id][$forum_id] : 0;

		// Do the admin want to set these permissions to other items too?
		$inherit = request_var('inherit', array(0 => array(0)));

		$ug_id = array($ug_id);
		$forum_id = array($forum_id);

		if (sizeof($inherit))
		{
			foreach ($inherit as $_ug_id => $forum_id_ary)
			{
				// Inherit users/groups?
				if (!in_array($_ug_id, $ug_id))
				{
					$ug_id[] = $_ug_id;
				}

				// Inherit forums?
				$forum_id = array_merge($forum_id, array_keys($forum_id_ary));
			}
		}

		$forum_id = array_unique($forum_id);

		// If the auth settings differ from the assigned role, then do not set a role...
		if ($assigned_role)
		{
			if (!$this->check_assigned_role($assigned_role, $auth_settings))
			{
				$assigned_role = 0;
			}
		}

		// Update the permission set...
		$this->acl_set($ug_type, $forum_id, $ug_id, $auth_settings, $assigned_role);

		trigger_error($user->lang['AUTH_UPDATED'] . adm_back_link($this->u_action));
	}



	/**
	* Set a user or group ACL record
	*/
	function acl_set($ug_type, $forum_id, $ug_id, $auth, $role_id = 0, $clear_prefetch = true)
	{
		global $db;
$auth_admin = new auth_admin();
		// One or more forums
		if (!is_array($forum_id))
		{
			$forum_id = array($forum_id);
		}

		// One or more users
		if (!is_array($ug_id))
		{
			$ug_id = array($ug_id);
		}

		$ug_id_sql = $db->sql_in_set($ug_type . '_id', array_map('intval', $ug_id));
		$forum_sql = $db->sql_in_set('forum_id', array_map('intval', $forum_id));

		// Instead of updating, inserting, removing we just remove all current settings and re-set everything...
		$table = ($ug_type == 'user') ? ACL_USERS_TABLE : ACL_GROUPS_TABLE;
		$id_field = $ug_type . '_id';

		// Get any flags as required
		reset($auth);
		$flag = key($auth);
		$flag = substr($flag, 0, strpos($flag, '_') + 1);

		// This ID (the any-flag) is set if one or more permissions are true...
		$any_option_id = (int) $auth_admin->acl_options['id'][$flag];

		// Remove any-flag from auth ary
		if (isset($auth[$flag]))
		{
			unset($auth[$flag]);
		}

		// Remove current auth options...
		$auth_option_ids = array((int)$any_option_id);
		foreach ($auth as $auth_option => $auth_setting)
		{
			$auth_option_ids[] = (int) $auth_admin->acl_options['id'][$auth_option];
		}

		$sql = "DELETE FROM $table
			WHERE $forum_sql
				AND $ug_id_sql
				AND " . $db->sql_in_set('auth_option_id', $auth_option_ids);
		$db->sql_query($sql);

		// Remove those having a role assigned... the correct type of course...
		$sql = 'SELECT role_id
			FROM ' . ACL_ROLES_TABLE . "
			WHERE role_type = '" . $db->sql_escape($flag) . "'";
		$result = $db->sql_query($sql);

		$role_ids = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$role_ids[] = $row['role_id'];
		}
		$db->sql_freeresult($result);

		if (sizeof($role_ids))
		{
			$sql = "DELETE FROM $table
				WHERE $forum_sql
					AND $ug_id_sql
					AND auth_option_id = 0
					AND " . $db->sql_in_set('auth_role_id', $role_ids);
			$db->sql_query($sql);
		}

		// Ok, include the any-flag if one or more auth options are set to yes...
		foreach ($auth as $auth_option => $setting)
		{
			if ($setting == ACL_YES && (!isset($auth[$flag]) || $auth[$flag] == ACL_NEVER))
			{
				$auth[$flag] = ACL_YES;
			}
		}

		$sql_ary = array();
		foreach ($forum_id as $forum)
		{
			$forum = (int) $forum;

			if ($role_id)
			{
				foreach ($ug_id as $id)
				{
					$sql_ary[] = array(
						$id_field			=> (int) $id,
						'forum_id'			=> (int) $forum,
						'auth_option_id'	=> 0,
						'is_kb'				=> 1,
						'auth_setting'		=> 0,
						'auth_role_id'		=> (int) $role_id,
					);
				}
			}
			else
			{
				foreach ($auth as $auth_option => $setting)
				{
					$auth_option_id = (int) $auth_admin->acl_options['id'][$auth_option];

					if ($setting != ACL_NO)
					{
						foreach ($ug_id as $id)
						{
							$sql_ary[] = array(
								$id_field			=> (int) $id,
								'is_kb'				=> 1,
								'forum_id'			=> (int) $forum,
								'auth_option_id'	=> (int) $auth_option_id,
								'auth_setting'		=> (int) $setting
							);
						}
					}
				}
			}
		}

		$db->sql_multi_insert($table, $sql_ary);

		if ($clear_prefetch)
		{
			$auth_admin->acl_clear_prefetch();
		}
	}




	/**
	* Apply all permissions
	*/
	function set_all_permissions($mode, $permission_type, &$auth_admin, &$user_id, &$group_id)
	{
		global $user, $auth;

		// User or group to be set?
		$ug_type = (sizeof($user_id)) ? 'user' : 'group';



		$auth_settings = (isset($_POST['setting'])) ? $_POST['setting'] : array();
		$auth_roles = (isset($_POST['role'])) ? $_POST['role'] : array();
		$ug_ids = $forum_ids = array();

		// We need to go through the auth settings
		foreach ($auth_settings as $ug_id => $forum_auth_row)
		{
			$ug_id = (int) $ug_id;
			$ug_ids[] = $ug_id;

			foreach ($forum_auth_row as $forum_id => $auth_options)
			{
				$forum_id = (int) $forum_id;
				$forum_ids[] = $forum_id;

				// Check role...
				$assigned_role = (isset($auth_roles[$ug_id][$forum_id])) ? (int) $auth_roles[$ug_id][$forum_id] : 0;

				// If the auth settings differ from the assigned role, then do not set a role...
				if ($assigned_role)
				{
					if (!$this->check_assigned_role($assigned_role, $auth_options))
					{
						$assigned_role = 0;
					}
				}

				// Update the permission set...
				$this->acl_set($ug_type, $forum_id, $ug_id, $auth_options, $assigned_role, false);
			}
		}

		$auth_admin->acl_clear_prefetch();


		//$this->log_action($mode, 'add', $permission_type, $ug_type, $ug_ids, $forum_ids);

		if ($mode == 'setting_forum_local' || $mode == 'setting_mod_local')
		{
			trigger_error($user->lang['AUTH_UPDATED'] . adm_back_link($this->u_action . '&amp;forum_id[]=' . implode('&amp;forum_id[]=', $forum_ids)));
		}
		else
		{
			trigger_error($user->lang['AUTH_UPDATED'] . adm_back_link($this->u_action));
		}
	}



	/**
	* Compare auth settings with auth settings from role
	* returns false if they differ, true if they are equal
	*/
	function check_assigned_role($role_id, &$auth_settings)
	{
		global $db;

		$sql = 'SELECT o.auth_option, r.auth_setting
			FROM ' . ACL_OPTIONS_TABLE . ' o, ' . ACL_ROLES_DATA_TABLE . ' r
			WHERE o.auth_option_id = r.auth_option_id
				AND r.role_id = ' . $role_id;
		$result = $db->sql_query($sql);

		$test_auth_settings = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$test_auth_settings[$row['auth_option']] = $row['auth_setting'];
		}
		$db->sql_freeresult($result);

		// We need to add any ACL_NO setting from auth_settings to compare correctly
		foreach ($auth_settings as $option => $setting)
		{
			if ($setting == ACL_NO)
			{
				$test_auth_settings[$option] = $setting;
			}
		}

		if (sizeof(array_diff_assoc($auth_settings, $test_auth_settings)))
		{
			return false;
		}

		return true;
	}


	/**
	* Get permission mask
	* This function only supports getting permissions of one type (for example a_)
	*
	* @param set|view $mode defines the permissions we get, view gets effective permissions (checking user AND group permissions), set only gets the user or group permission set alone
	* @param mixed $user_id user ids to search for (a user_id or a group_id has to be specified at least)
	* @param mixed $group_id group ids to search for, return group related settings (a user_id or a group_id has to be specified at least)
	* @param mixed $forum_id forum_ids to search for. Defining a forum id also means getting local settings
	* @param string $auth_option the auth_option defines the permission setting to look for (a_ for example)
	* @param local|global $scope the scope defines the permission scope. If local, a forum_id is additionally required
	* @param ACL_NEVER|ACL_NO|ACL_YES $acl_fill defines the mode those permissions not set are getting filled with
	*/
	function get_mask($mode, $user_id = false, $group_id = false, $categorie_id = false, $auth_option = false, $scope = false, $acl_fill = ACL_NEVER)
	{
		global $db, $user, $auth_admin;
		$auth_admin = new auth_admin();
		$hold_ary = array();
		$view_user_mask = ($mode == 'view' && $group_id === false) ? true : false;

		if ($auth_option === false || $scope === false)
		{
			return array();
		}

		$acl_user_function = ($mode == 'set') ? 'acl_user_raw_data' : 'acl_raw_data';

		if (!$view_user_mask)
		{
			if ($categorie_id !== false)
			{
				$hold_ary = ($group_id !== false) ? $auth_admin->acl_group_raw_data($group_id, $auth_option . '%', $categorie_id) : $auth_admin->$acl_user_function($user_id, $auth_option . '%', $categorie_id);
			}
			else
			{
				$hold_ary = ($group_id !== false) ? $auth_admin->acl_group_raw_data($group_id, $auth_option . '%', ($scope == 'global') ? 0 : false) : $auth_admin->$acl_user_function($user_id, $auth_option . '%', ($scope == 'global') ? 0 : false);
			}
		}

		// Make sure hold_ary is filled with every setting (prevents missing categories/users/groups)
		$ug_id = ($group_id !== false) ? ((!is_array($group_id)) ? array($group_id) : $group_id) : ((!is_array($user_id)) ? array($user_id) : $user_id);
		$categorie_ids = ($categorie_id !== false) ? ((!is_array($categorie_id)) ? array($categorie_id) : $categorie_id) : (($scope == 'global') ? array(0) : array());

		// Only those options we need
		$compare_options = array_diff(preg_replace('/^((?!' . $auth_option . ').+)|(' . $auth_option . ')$/', '', array_keys($auth_admin->acl_options[$scope])), array(''));

		// If categorie_ids is false and the scope is local we actually want to have all categories within the array
		if ($scope == 'local' && !sizeof($categorie_ids))
		{
			$sql = 'SELECT cat_id
				FROM ' . KB_CATEGORIE_TABLE;
			$result = $db->sql_query($sql, 120);

			while ($row = $db->sql_fetchrow($result))
			{
				$categorie_ids[] = (int) $row['cat_id'];
			}
			$db->sql_freeresult($result);
		}

		if ($view_user_mask)
		{
			$auth2 = null;

			$sql = 'SELECT user_id, user_permissions, user_type
				FROM ' . USERS_TABLE . '
				WHERE ' . $db->sql_in_set('user_id', $ug_id);
			$result = $db->sql_query($sql);

			while ($userdata = $db->sql_fetchrow($result))
			{
				if ($user->data['user_id'] != $userdata['user_id'])
				{
					$auth2 = new auth();
					$auth2->acl($userdata);
				}
				else
				{
					global $auth;
					$auth2 = &$auth;
				}


				$hold_ary[$userdata['user_id']] = array();
				foreach ($categorie_ids as $f_id)
				{
					$hold_ary[$userdata['user_id']][$f_id] = array();
					foreach ($compare_options as $option)
					{
						$hold_ary[$userdata['user_id']][$f_id][$option] = $auth2->acl_get($option, $f_id);
					}
				}
			}
			$db->sql_freeresult($result);

			unset($userdata);
			unset($auth2);
		}

		foreach ($ug_id as $_id)
		{
			if (!isset($hold_ary[$_id]))
			{
				$hold_ary[$_id] = array();
			}

			foreach ($categorie_ids as $f_id)
			{
				if (!isset($hold_ary[$_id][$f_id]))
				{
					$hold_ary[$_id][$f_id] = array();
				}
			}
		}

		// Now, we need to fill the gaps with $acl_fill. ;)

		// Now switch back to keys
		if (sizeof($compare_options))
		{
			$compare_options = array_combine($compare_options, array_fill(1, sizeof($compare_options), $acl_fill));
		}

		// Defining the user-function here to save some memory
		$return_acl_fill = create_function('$value', 'return ' . $acl_fill . ';');

		// Actually fill the gaps
		if (sizeof($hold_ary))
		{
			foreach ($hold_ary as $ug_id => $row)
			{
				foreach ($row as $id => $options)
				{
					// Do not include the global auth_option
					unset($options[$auth_option]);

					// Not a "fine" solution, but at all it's a 1-dimensional
					// array_diff_key function filling the resulting array values with zeros
					// The differences get merged into $hold_ary (all permissions having $acl_fill set)
					$hold_ary[$ug_id][$id] = array_merge($options,

						array_map($return_acl_fill,
							array_flip(
								array_diff(
									array_keys($compare_options), array_keys($options)
								)
							)
						)
					);
				}
			}
		}
		else
		{
			$hold_ary[($group_id !== false) ? $group_id : $user_id][(int) $categorie_id] = $compare_options;
		}

		return $hold_ary;
	}






	/**
	* Get already assigned users/groups
	*/
	function retrieve_defined_user_groups($permission_scope, $forum_id, $permission_type)
	{
		global $db, $user;

		$sql_forum_id = ($permission_scope == 'global') ? 'AND a.forum_id = 0' : ((sizeof($forum_id)) ? 'AND ' . $db->sql_in_set('a.forum_id', $forum_id) : 'AND a.forum_id <> 0');

		// Permission options are only able to be a permission set... therefore we will pre-fetch the possible options and also the possible roles
		$option_ids = $role_ids = array();

		$sql = 'SELECT auth_option_id
			FROM ' . ACL_OPTIONS_TABLE . '
			WHERE auth_option ' . $db->sql_like_expression($permission_type . $db->any_char);
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$option_ids[] = (int) $row['auth_option_id'];
		}
		$db->sql_freeresult($result);

		if (sizeof($option_ids))
		{
			$sql = 'SELECT DISTINCT role_id
				FROM ' . ACL_ROLES_DATA_TABLE . '
				WHERE ' . $db->sql_in_set('auth_option_id', $option_ids);
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$role_ids[] = (int) $row['role_id'];
			}
			$db->sql_freeresult($result);
		}

		if (sizeof($option_ids) && sizeof($role_ids))
		{
			$sql_where = 'AND (' . $db->sql_in_set('a.auth_option_id', $option_ids) . ' OR ' . $db->sql_in_set('a.auth_role_id', $role_ids) . ')';
		}
		else if (sizeof($role_ids))
		{
			$sql_where = 'AND ' . $db->sql_in_set('a.auth_role_id', $role_ids);
		}
		else if (sizeof($option_ids))
		{
			$sql_where = 'AND ' . $db->sql_in_set('a.auth_option_id', $option_ids);
		}

		// Not ideal, due to the filesort, non-use of indexes, etc.
		$sql = 'SELECT DISTINCT u.user_id, u.username, u.username_clean, u.user_regdate
			FROM ' . USERS_TABLE . ' u, ' . ACL_USERS_TABLE . " a
			WHERE u.user_id = a.user_id
				$sql_forum_id
				$sql_where
			ORDER BY u.username_clean, u.user_regdate ASC";
		$result = $db->sql_query($sql);

		$s_defined_user_options = '';
		$defined_user_ids = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$s_defined_user_options .= '<option value="' . $row['user_id'] . '">' . $row['username'] . '</option>';
			$defined_user_ids[] = $row['user_id'];
		}
		$db->sql_freeresult($result);

		$sql = 'SELECT DISTINCT g.group_type, g.group_name, g.group_id
			FROM ' . GROUPS_TABLE . ' g, ' . ACL_GROUPS_TABLE . " a
			WHERE g.group_id = a.group_id
				$sql_forum_id
				$sql_where
			ORDER BY g.group_type DESC, g.group_name ASC";
		$result = $db->sql_query($sql);

		$s_defined_group_options = '';
		$defined_group_ids = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$s_defined_group_options .= '<option' . (($row['group_type'] == GROUP_SPECIAL) ? ' class="sep"' : '') . ' value="' . $row['group_id'] . '">' . (($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name']) . '</option>';
			$defined_group_ids[] = $row['group_id'];
		}
		$db->sql_freeresult($result);

		return array(
			'group_ids'			=> $defined_group_ids,
			'group_ids_options'	=> $s_defined_group_options,
			'user_ids'			=> $defined_user_ids,
			'user_ids_options'	=> $s_defined_user_options
		);
	}


	/**
	* Display permission mask (assign to template)
	*/

	function display_mask($mode, $permission_type, &$hold_ary, $user_mode = 'user', $local = false, $group_display = true)
	{
		global $template, $user, $db, $phpbb_root_path, $phpEx, $auth_admin;

		// Define names for template loops, might be able to be set
		$tpl_pmask = 'p_mask';
		$tpl_fmask = 'f_mask';
		$tpl_category = 'category';
		$tpl_mask = 'mask';

		$l_acl_type = (isset($user->lang['ACL_TYPE_' . (($local) ? 'LOCAL' : 'GLOBAL') . '_' . strtoupper($permission_type)])) ? $user->lang['ACL_TYPE_' . (($local) ? 'LOCAL' : 'GLOBAL') . '_' . strtoupper($permission_type)] : 'ACL_TYPE_' . (($local) ? 'LOCAL' : 'GLOBAL') . '_' . strtoupper($permission_type);

		// Allow trace for viewing permissions and in user mode
		$show_trace = ($mode == 'view' && $user_mode == 'user') ? true : false;

		// Get names
		if ($user_mode == 'user')
		{
			$sql = 'SELECT user_id as ug_id, username as ug_name
				FROM ' . USERS_TABLE . '
				WHERE ' . $db->sql_in_set('user_id', array_keys($hold_ary)) . '
				ORDER BY username_clean ASC';
		}
		else
		{
			$sql = 'SELECT group_id as ug_id, group_name as ug_name, group_type
				FROM ' . GROUPS_TABLE . '
				WHERE ' . $db->sql_in_set('group_id', array_keys($hold_ary)) . '
				ORDER BY group_type DESC, group_name ASC';
		}
		$result = $db->sql_query($sql);

		$ug_names_ary = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$ug_names_ary[$row['ug_id']] = ($user_mode == 'user') ? $row['ug_name'] : (($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['ug_name']] : $row['ug_name']);
		}
		$db->sql_freeresult($result);

		// Get used forums
		$forum_ids = array();
		foreach ($hold_ary as $ug_id => $row)
		{
			$forum_ids = array_merge($forum_ids, array_keys($row));
		}
		$forum_ids = array_unique($forum_ids);

		$forum_names_ary = array();
		if ($local)
		{
			$forum_names_ary = make_forum_select(false, false, true, false, false, false, true);

			// Remove the disabled ones, since we do not create an option field here...
			foreach ($forum_names_ary as $key => $value)
			{
				if (!$value['disabled'])
				{
					continue;
				}
				unset($forum_names_ary[$key]);
			}
		}
		else
		{
			$forum_names_ary[0] = $l_acl_type;
		}

		// Get available roles
		$sql = 'SELECT *
			FROM ' . ACL_ROLES_TABLE . "
			WHERE role_type = '" . $db->sql_escape($permission_type) . "'
			ORDER BY role_order ASC";
		$result = $db->sql_query($sql);

		$roles = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$roles[$row['role_id']] = $row;
		}
		$db->sql_freeresult($result);

		$cur_roles = $auth_admin->acl_role_data($user_mode, $permission_type, array_keys($hold_ary));

		// Build js roles array (role data assignments)
		$s_role_js_array = '';

		if (sizeof($roles))
		{
			$s_role_js_array = array();

			// Make sure every role (even if empty) has its array defined
			foreach ($roles as $_role_id => $null)
			{
				$s_role_js_array[$_role_id] = "\n" . 'role_options[' . $_role_id . '] = new Array();' . "\n";
			}

			$sql = 'SELECT r.role_id, o.auth_option, r.auth_setting
				FROM ' . ACL_ROLES_DATA_TABLE . ' r, ' . ACL_OPTIONS_TABLE . ' o
				WHERE o.auth_option_id = r.auth_option_id
					AND ' . $db->sql_in_set('r.role_id', array_keys($roles));
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$flag = substr($row['auth_option'], 0, strpos($row['auth_option'], '_') + 1);
				if ($flag == $row['auth_option'])
				{
					continue;
				}

				$s_role_js_array[$row['role_id']] .= 'role_options[' . $row['role_id'] . '][\'' . addslashes($row['auth_option']) . '\'] = ' . $row['auth_setting'] . '; ';
			}
			$db->sql_freeresult($result);

			$s_role_js_array = implode('', $s_role_js_array);
		}

		$template->assign_var('S_ROLE_JS_ARRAY', $s_role_js_array);
		unset($s_role_js_array);

		// Now obtain memberships
		$user_groups_default = $user_groups_custom = array();
		if ($user_mode == 'user' && $group_display)
		{
			$sql = 'SELECT group_id, group_name, group_type
				FROM ' . GROUPS_TABLE . '
				ORDER BY group_type DESC, group_name ASC';
			$result = $db->sql_query($sql);

			$groups = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$groups[$row['group_id']] = $row;
			}
			$db->sql_freeresult($result);

			$memberships = group_memberships(false, array_keys($hold_ary), false);

			// User is not a member of any group? Bad admin, bad bad admin...
			if ($memberships)
			{
				foreach ($memberships as $row)
				{
					if ($groups[$row['group_id']]['group_type'] == GROUP_SPECIAL)
					{
						$user_groups_default[$row['user_id']][] = $user->lang['G_' . $groups[$row['group_id']]['group_name']];
					}
					else
					{
						$user_groups_custom[$row['user_id']][] = $groups[$row['group_id']]['group_name'];
					}
				}
			}
			unset($memberships, $groups);
		}

		// If we only have one forum id to display or being in local mode and more than one user/group to display,
		// we switch the complete interface to group by user/usergroup instead of grouping by forum
		// To achieve this, we need to switch the array a bit
		if (sizeof($forum_ids) == 1 || ($local && sizeof($ug_names_ary) > 1))
		{
			$hold_ary_temp = $hold_ary;
			$hold_ary = array();
			foreach ($hold_ary_temp as $ug_id => $row)
			{
				foreach ($forum_names_ary as $forum_id => $forum_row)
				{
					if (isset($row[$forum_id]))
					{
						$hold_ary[$forum_id][$ug_id] = $row[$forum_id];
					}
				}
			}
			unset($hold_ary_temp);

			foreach ($hold_ary as $forum_id => $forum_array)
			{
				$content_array = $categories = array();
				$this->build_permission_array($hold_ary[$forum_id], $content_array, $categories, array_keys($ug_names_ary));

				$template->assign_block_vars($tpl_pmask, array(
					'NAME'			=> ($forum_id == 0) ? $forum_names_ary[0] : $forum_names_ary[$forum_id]['forum_name'],
					'PADDING'		=> ($forum_id == 0) ? '' : $forum_names_ary[$forum_id]['padding'],

					'CATEGORIES'	=> implode('</th><th>', $categories),

					'L_ACL_TYPE'	=> $l_acl_type,

					'S_LOCAL'		=> ($local) ? true : false,
					'S_GLOBAL'		=> (!$local) ? true : false,
					'S_NUM_CATS'	=> sizeof($categories),
					'S_VIEW'		=> ($mode == 'view') ? true : false,
					'S_NUM_OBJECTS'	=> sizeof($content_array),
					'S_USER_MODE'	=> ($user_mode == 'user') ? true : false,
					'S_GROUP_MODE'	=> ($user_mode == 'group') ? true : false)
				);

				@reset($content_array);
				while (list($ug_id, $ug_array) = each($content_array))
				{
					// Build role dropdown options
					$current_role_id = (isset($cur_roles[$ug_id][$forum_id])) ? $cur_roles[$ug_id][$forum_id] : 0;

					$s_role_options = '';

					@reset($roles);
					while (list($role_id, $role_row) = each($roles))
					{
						$role_description = (!empty($user->lang[$role_row['role_description']])) ? $user->lang[$role_row['role_description']] : nl2br($role_row['role_description']);
						$role_name = (!empty($user->lang[$role_row['role_name']])) ? $user->lang[$role_row['role_name']] : $role_row['role_name'];

						$title = ($role_description) ? ' title="' . $role_description . '"' : '';
						$s_role_options .= '<option value="' . $role_id . '"' . (($role_id == $current_role_id) ? ' selected="selected"' : '') . $title . '>' . $role_name . '</option>';
					}

					if ($s_role_options)
					{
						$s_role_options = '<option value="0"' . ((!$current_role_id) ? ' selected="selected"' : '') . ' title="' . htmlspecialchars($user->lang['NO_ROLE_ASSIGNED_EXPLAIN']) . '">' . $user->lang['NO_ROLE_ASSIGNED'] . '</option>' . $s_role_options;
					}

					if (!$current_role_id && $mode != 'view')
					{
						$s_custom_permissions = false;

						foreach ($ug_array as $key => $value)
						{
							if ($value['S_NEVER'] || $value['S_YES'])
							{
								$s_custom_permissions = true;
								break;
							}
						}
					}
					else
					{
						$s_custom_permissions = false;
					}

					$template->assign_block_vars($tpl_pmask . '.' . $tpl_fmask, array(
						'NAME'				=> $ug_names_ary[$ug_id],
						'S_ROLE_OPTIONS'	=> $s_role_options,
						'UG_ID'				=> $ug_id,
						'S_CUSTOM'			=> $s_custom_permissions,
						'FORUM_ID'			=> $forum_id)
					);

					$this->assign_cat_array($ug_array, $tpl_pmask . '.' . $tpl_fmask . '.' . $tpl_category, $tpl_mask, $ug_id, $forum_id, $show_trace, ($mode == 'view'));

					unset($content_array[$ug_id]);
				}

				unset($hold_ary[$forum_id]);
			}
		}
		else
		{
			foreach ($ug_names_ary as $ug_id => $ug_name)
			{
				if (!isset($hold_ary[$ug_id]))
				{
					continue;
				}

				$content_array = $categories = array();
				$auth_admin->build_permission_array($hold_ary[$ug_id], $content_array, $categories, array_keys($forum_names_ary));

				$template->assign_block_vars($tpl_pmask, array(
					'NAME'			=> $ug_name,
					'CATEGORIES'	=> implode('</th><th>', $categories),

					'USER_GROUPS_DEFAULT'	=> ($user_mode == 'user' && isset($user_groups_default[$ug_id]) && sizeof($user_groups_default[$ug_id])) ? implode(', ', $user_groups_default[$ug_id]) : '',
					'USER_GROUPS_CUSTOM'	=> ($user_mode == 'user' && isset($user_groups_custom[$ug_id]) && sizeof($user_groups_custom[$ug_id])) ? implode(', ', $user_groups_custom[$ug_id]) : '',
					'L_ACL_TYPE'			=> $l_acl_type,

					'S_LOCAL'		=> ($local) ? true : false,
					'S_GLOBAL'		=> (!$local) ? true : false,
					'S_NUM_CATS'	=> sizeof($categories),
					'S_VIEW'		=> ($mode == 'view') ? true : false,
					'S_NUM_OBJECTS'	=> sizeof($content_array),
					'S_USER_MODE'	=> ($user_mode == 'user') ? true : false,
					'S_GROUP_MODE'	=> ($user_mode == 'group') ? true : false)
				);

				@reset($content_array);
				while (list($forum_id, $forum_array) = each($content_array))
				{
					// Build role dropdown options
					$current_role_id = (isset($cur_roles[$ug_id][$forum_id])) ? $cur_roles[$ug_id][$forum_id] : 0;

					$s_role_options = '';

					@reset($roles);
					while (list($role_id, $role_row) = each($roles))
					{
						$role_description = (!empty($user->lang[$role_row['role_description']])) ? $user->lang[$role_row['role_description']] : nl2br($role_row['role_description']);
						$role_name = (!empty($user->lang[$role_row['role_name']])) ? $user->lang[$role_row['role_name']] : $role_row['role_name'];

						$title = ($role_description) ? ' title="' . $role_description . '"' : '';
						$s_role_options .= '<option value="' . $role_id . '"' . (($role_id == $current_role_id) ? ' selected="selected"' : '') . $title . '>' . $role_name . '</option>';
					}

					if ($s_role_options)
					{
						$s_role_options = '<option value="0"' . ((!$current_role_id) ? ' selected="selected"' : '') . ' title="' . htmlspecialchars($user->lang['NO_ROLE_ASSIGNED_EXPLAIN']) . '">' . $user->lang['NO_ROLE_ASSIGNED'] . '</option>' . $s_role_options;
					}

					if (!$current_role_id && $mode != 'view')
					{
						$s_custom_permissions = false;

						foreach ($forum_array as $key => $value)
						{
							if ($value['S_NEVER'] || $value['S_YES'])
							{
								$s_custom_permissions = true;
								break;
							}
						}
					}
					else
					{
						$s_custom_permissions = false;
					}

					$template->assign_block_vars($tpl_pmask . '.' . $tpl_fmask, array(
						'NAME'				=> ($forum_id == 0) ? $forum_names_ary[0] : $forum_names_ary[$forum_id]['forum_name'] . 'hhh',
						'PADDING'			=> ($forum_id == 0) ? '' : $forum_names_ary[$forum_id]['padding'],
						'S_ROLE_OPTIONS'	=> $s_role_options,
						'S_CUSTOM'			=> $s_custom_permissions,
						'UG_ID'				=> $ug_id,
						'FORUM_ID'			=> $forum_id)
					);

					$auth_admin->assign_cat_array($forum_array, $tpl_pmask . '.' . $tpl_fmask . '.' . $tpl_category, $tpl_mask, $ug_id, $forum_id, $show_trace, ($mode == 'view'));
				}

				unset($hold_ary[$ug_id], $ug_names_ary[$ug_id]);
			}
		}
	}






}

?>