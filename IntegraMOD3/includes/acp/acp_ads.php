<?php
/**
*
* @package phpBB3 Advertisement Management
* @version $Id: acp_ads.php 109 2010-05-31 04:08:59Z exreaction@gmail.com $
* @copyright (c) 2008 EXreaction, Lithium Studios
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
class acp_ads
{
	var $u_action;
	var $new_config = array();

	function main($id, $mode)
	{
		global $db, $user, $auth, $template;
		global $cache, $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		require($phpbb_root_path . 'ads/constants.' . $phpEx);
		require($phpbb_root_path . 'includes/functions_user.' . $phpEx);

		$user->add_lang('mods/ads');
		$this->tpl_name = 'acp_ads';
		$this->page_title = 'ACP_ADVERTISEMENT_MANAGEMENT';

		$action	= request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;
		$position_id = request_var('p', 0);
		$ad_id = request_var('a', 0);
		$error = array();
		$ad_data = $position_data = false;

		// Check Form Key
		add_form_key('acp_ads');
		if ($submit && !check_form_key('acp_ads'))
		{
			trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
		}

		// Get the ad/position info if either id is sent.
		if ($ad_id)
		{
			$result = $db->sql_query('SELECT * FROM ' . ADS_TABLE . ' WHERE ad_id = ' . $ad_id);
			$ad_data = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			if ($ad_data)
			{
				$ad_data['forums'] = $ad_data['groups'] = $ad_data['positions'] = array();
				$result = $db->sql_query('SELECT forum_id FROM ' . ADS_FORUMS_TABLE . ' WHERE ad_id = ' . $ad_id);
				while ($row = $db->sql_fetchrow($result))
				{
					$ad_data['forums'][] = $row['forum_id'];
				}
				$db->sql_freeresult($result);
				$result = $db->sql_query('SELECT group_id FROM ' . ADS_GROUPS_TABLE . ' WHERE ad_id = ' . $ad_id);
				while ($row = $db->sql_fetchrow($result))
				{
					$ad_data['groups'][] = $row['group_id'];
				}
				$db->sql_freeresult($result);
				$result = $db->sql_query('SELECT position_id FROM ' . ADS_IN_POSITIONS_TABLE . ' WHERE ad_id = ' . $ad_id);
				while ($row = $db->sql_fetchrow($result))
				{
					$ad_data['positions'][] = $row['position_id'];
				}
				$db->sql_freeresult($result);
			}
		}
		if ($position_id)
		{
			$result = $db->sql_query('SELECT * FROM ' . ADS_POSITIONS_TABLE . ' WHERE position_id = ' . $position_id);
			$position_data = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
		}

		// Config Variables
		$config_vars = array(
			'legend1'				=> 'ACP_ADVERTISEMENT_MANAGEMENT_SETTINGS',
			'ads_enable'			=> array('lang' => 'ADS_ENABLE', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false),
			'ads_rules_groups'		=> array('lang' => 'ADS_RULES_GROUPS', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
			'ads_rules_forums'		=> array('lang' => 'ADS_RULES_FORUMS', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
			'ads_count_clicks'		=> array('lang' => 'ADS_COUNT_CLICKS', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
			'ads_count_views'		=> array('lang' => 'ADS_COUNT_VIEWS', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
			'ads_accurate_views'	=> array('lang' => 'ADS_ACCURATE_VIEWS', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
			'ads_group'				=> array('lang'	=> 'ADS_GROUP', 'validate' => 'int:0', 'type' => 'select', 'method' => 'group_select', 'explain' => true),
		);
		$this->new_config = $config;
		$this->new_config = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;

		// Other settings
		$ad_name = utf8_normalize_nfc(request_var('ad_name', '', true));
		$ad_code = utf8_normalize_nfc(request_var('ad_code', '', true));
		$ad_note = utf8_normalize_nfc(request_var('ad_note', '', true));
		$ad_time_end = (utf8_normalize_nfc(request_var('ad_time_end', '', true))) ? strtotime(utf8_normalize_nfc(request_var('ad_time_end', '', true))) : 0;
		$ad_groups = request_var('ad_groups', array(0), true);
		$ad_forums = request_var('ad_forums', array(0), true);
		$ad_positions = request_var('ad_positions', array(0), true);
		$position_name = request_var('position_name', '');
		$ad_owner = utf8_normalize_nfc(request_var('ad_owner', '', true));
		$ad_owner_id = 0;

		switch ($action)
		{
			/**************************************************************************************
			*
			* Add/Edit Advertisement/Position
			*
			**************************************************************************************/
			case 'add' :
			case 'edit' :
			case 'copy' :
				if ($position_id || ($position_name && $submit))
				{
					if (($action == 'edit' || $action == 'copy') && !$position_data)
					{
						trigger_error($user->lang['POSITION_NOT_EXIST'] . adm_back_link($this->u_action));
					}

					if ($action == 'add')
					{
						// Make sure the given position name isn't already in the database.
						$sql = 'SELECT position_id FROM ' . ADS_POSITIONS_TABLE . ' WHERE lang_key = \'' . $db->sql_escape($position_name) . "'";
						$result = $db->sql_query($sql);
						if ($db->sql_fetchrow($result))
						{
							trigger_error($user->lang['POSTITION_ALREADY_EXIST'] . adm_back_link($this->u_action));
						}

						$db->sql_query('INSERT INTO ' . ADS_POSITIONS_TABLE . ' ' . $db->sql_build_array('INSERT', array('lang_key' => $position_name)));
					}
					else
					{
						if ($submit && $position_name != $position_data['lang_key'])
						{
							// Make sure the given position name isn't already in the database.
							$sql = 'SELECT position_id FROM ' . ADS_POSITIONS_TABLE . ' WHERE lang_key = \'' . $db->sql_escape($position_name) . "'";
							$result = $db->sql_query($sql);
							if ($db->sql_fetchrow($result))
							{
								trigger_error($user->lang['POSTITION_ALREADY_EXIST'] . adm_back_link($this->u_action));
							}

							$db->sql_query('UPDATE ' . ADS_POSITIONS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array('lang_key' => $position_name)) . ' WHERE position_id = ' . $position_id);
						}
						else
						{
							$template->assign_vars(array(
								'S_EDIT_POSITION'	=> true,

								'POSITION_NAME'		=> $position_data['lang_key'],
							));
						}
					}

					if ($submit)
					{
						$cache->destroy('sql', ADS_POSITIONS_TABLE);

						trigger_error((($action == 'add') ? $user->lang['POSTITION_ADD_SUCCESS'] : $user->lang['POSITION_EDIT_SUCCESS']) . adm_back_link($this->u_action));
					}
				}
				else if ($ad_id || !$position_name)
				{
					if (($action == 'edit' || $action == 'copy') && !$ad_data)
					{
						trigger_error($user->lang['AD_NOT_EXIST'] . adm_back_link($this->u_action));
					}

					// Check for errors
					if ($submit)
					{
						if (!$ad_name)
						{
							$error[] = $user->lang['NO_AD_NAME'];
						}

						if ($ad_time_end !== false && $ad_time_end > 0 && $ad_time_end < time())
						{
							$error[] = $user->lang['AD_TIME_END_BEFORE_NOW'];
						}

						if ($ad_owner)
						{
							$sql = 'SELECT user_id FROM ' . USERS_TABLE . '
								WHERE user_type <> ' . USER_IGNORE . '
								AND ' . ((is_numeric($ad_owner)) ? 'user_id = ' . (int) $ad_owner : 'username_clean = \'' . $db->sql_escape(utf8_clean_string($ad_owner)) . '\'');
							$result = $db->sql_query($sql);
							$user_row = $db->sql_fetchrow($result);
							$db->sql_freeresult($result);

							if (!$user_row)
							{
								$error[] = $user->lang['NO_USER'];
							}
							else
							{
								$ad_owner_id = $user_row['user_id'];
							}
						}
					}

					if ($submit && !sizeof($error))
					{
						$sql_ary = array(
							'ad_name'			=> $ad_name,
							'ad_code'			=> $ad_code,
							'ad_note'			=> $ad_note,
							'ad_time'			=> ($action == 'edit') ? $ad_data['ad_time'] : time(),
							'ad_time_end'		=> ($ad_time_end !== false && $ad_time_end > 0) ? $ad_time_end : 0,
							'ad_views'			=> request_var('ad_views', 0),
							'ad_view_limit'		=> request_var('ad_view_limit', 0),
							'ad_clicks'			=> request_var('ad_clicks', 0),
							'ad_click_limit'	=> request_var('ad_click_limit', 0),
							'ad_priority'		=> request_var('ad_priority', 5),
							'ad_enabled'		=> (isset($_POST['ad_enabled'])) ? true : false,
							'all_forums'		=> (isset($_POST['all_forums']) || !$config['ads_rules_forums']) ? true : false,
							'ad_owner'			=> $ad_owner_id,
						);

						// Set them as able to see the ads page (stored as 1 for ad_user) and add them to the ads group if required
						if ($ad_owner_id && ($action != 'edit' || $ad_owner_id != $ad_data['ad_owner']))
						{
							$sql = 'UPDATE ' . USERS_TABLE . ' SET ad_owner = 1
								WHERE user_id = ' . (int) $ad_owner_id;
							$db->sql_query($sql);

							if ($config['ads_group'])
							{
								group_user_add($config['ads_group'], array($ad_owner_id));
							}
						}

						if ($action == 'edit')
						{
							$db->sql_query('UPDATE ' . ADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE ad_id = ' . $ad_id);

							// Does the old owner have any ads anymore if the owner was changed?
							if ($ad_owner_id != $ad_data['ad_owner'])
							{
								$sql = 'SELECT COUNT(ad_id) AS count FROM ' . ADS_TABLE . '
									WHERE ad_owner = ' . $ad_data['ad_owner'];
								$db->sql_query($sql);
								$count = $db->sql_fetchfield('count');
								$db->sql_freeresult();

								if (!$count)
								{
									$sql = 'UPDATE ' . USERS_TABLE . ' SET ad_owner = 0
										WHERE user_id = ' . (int) $ad_data['ad_owner'];
									$db->sql_query($sql);

									if ($config['ads_group'])
									{
										group_user_del($config['ads_group'], array($ad_data['ad_owner']));
									}
								}
							}

							// This is the simplest way to update the groups/forums/positions list
							if ($config['ads_rules_groups'])
							{
								$db->sql_query('DELETE FROM ' . ADS_GROUPS_TABLE . ' WHERE ad_id = ' . $ad_id);
							}
							if ($config['ads_rules_forums'])
							{
								$db->sql_query('DELETE FROM ' . ADS_FORUMS_TABLE . ' WHERE ad_id = ' . $ad_id);
							}
							$db->sql_query('DELETE FROM ' . ADS_IN_POSITIONS_TABLE . ' WHERE ad_id = ' . $ad_id);
						}
						else
						{
							$db->sql_query('INSERT INTO ' . ADS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
							$ad_id = $db->sql_nextid();
						}

						if ($config['ads_rules_groups'])
						{
							foreach ($ad_groups as $group_id)
							{
								$db->sql_query('INSERT INTO ' . ADS_GROUPS_TABLE . ' ' . $db->sql_build_array('INSERT', array('ad_id' => $ad_id, 'group_id' => $group_id)));
							}
							$cache->destroy('sql', ADS_GROUPS_TABLE);
						}

						if ($config['ads_rules_forums'])
						{
							foreach ($ad_forums as $forum_id)
							{
								$db->sql_query('INSERT INTO ' . ADS_FORUMS_TABLE . ' ' . $db->sql_build_array('INSERT', array('ad_id' => $ad_id, 'forum_id' => $forum_id)));
							}
							$cache->destroy('sql', ADS_FORUMS_TABLE);
						}

						foreach ($ad_positions as $position_id)
						{
							$sql_ary = array(
								'ad_id'				=> $ad_id,
								'position_id'		=> $position_id,
								'ad_priority'		=> request_var('ad_priority', 5),
								'ad_enabled'		=> (isset($_POST['ad_enabled'])) ? true : false,
								'all_forums'		=> (isset($_POST['all_forums']) || !$config['ads_rules_forums']) ? true : false,
							);
							$db->sql_query('INSERT INTO ' . ADS_IN_POSITIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
						}

						trigger_error((($action == 'edit') ? $user->lang['AD_EDIT_SUCCESS'] : $user->lang['AD_ADD_SUCCESS']) . adm_back_link($this->u_action));
					}
					else
					{
						$ad_owner = utf8_normalize_nfc(request_var('ad_owner', '', true));
						if (($action == 'edit' || $action == 'copy') && !$submit && $ad_data['ad_owner'])
						{
							$sql = 'SELECT username FROM ' . USERS_TABLE . '
								WHERE user_id = ' . (int) $ad_data['ad_owner'];
							$db->sql_query($sql);
							$ad_owner = $db->sql_fetchfield('username');
							$db->sql_freeresult();
						}

						$template->assign_vars(array(
							'S_ADD_AD'			=> ($action == 'add' || $action == 'copy') ? true : false,
							'S_EDIT_AD'			=> ($action == 'edit') ? true : false,
							'S_RULES_GROUPS'	=> ($config['ads_rules_groups']) ? true : false,
							'S_RULES_FORUMS'	=> ($config['ads_rules_forums']) ? true : false,

							'AD_NAME'			=> (($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['ad_name'] : $ad_name,
							'AD_CODE'			=> (($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['ad_code'] : $ad_code,
							'AD_NOTE'			=> (($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['ad_note'] : $ad_note,
							'AD_TIME_END'		=> (($action == 'edit' || $action == 'copy') && !$submit) ? (($ad_data['ad_time_end']) ? date('d F Y', $ad_data['ad_time_end']) : '') : (($ad_time_end) ? date('d F Y', $ad_time_end) : ''),
							'AD_VIEW_LIMIT'		=> (($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['ad_view_limit'] : request_var('ad_view_limit', 0),
							'AD_VIEWS'			=> (($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['ad_views'] : request_var('ad_views', 0),
							'AD_CLICK_LIMIT'	=> (($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['ad_click_limit'] : request_var('ad_click_limit', 0),
							'AD_CLICKS'			=> (($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['ad_clicks'] : request_var('ad_clicks', 0),
							'AD_PRIORITY'		=> (($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['ad_priority'] : request_var('ad_priority', 5),
	                        'AD_ENABLED'        => ($action == 'edit' || $action == 'copy') ? $ad_data['ad_enabled'] : ($submit ? (isset($_POST['ad_enabled']) ? true : false) : ($action == 'add' ? true : false)),
//							'AD_ENABLED'		=> (($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['ad_enabled'] : ((!$submit && $action == 'add') || isset($_POST['ad_enabled'])) ? true : false,
	                        'ALL_FORUMS'        => ($action == 'edit' || $action == 'copy') ? $ad_data['all_forums'] : ($submit ? (isset($_POST['all_forums']) ? true : false) : ($action == 'add' ? true : false)),
//							'ALL_FORUMS'		=> (($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['all_forums'] : ((!$submit && $action == 'add') || isset($_POST['all_forums'])) ? true : false,
							'AD_OWNER'			=> $ad_owner,

							'U_ACTION'			=> $this->u_action . '&amp;a=' . $ad_id . '&amp;action=' . $action,
						));

						// List the groups
						$sql = 'SELECT group_id, group_name FROM ' . GROUPS_TABLE . ' ORDER BY group_name ASC';
						$result = $db->sql_query($sql);
						while ($row = $db->sql_fetchrow($result))
						{
							$template->assign_block_vars('groups', array(
								'GROUP_ID'		=> $row['group_id'],
								'GROUP_NAME'	=> (isset($user->lang['G_' . $row['group_name']])) ? $user->lang['G_' . $row['group_name']] : $row['group_name'],

								'S_SELECTED'	=> (in_array($row['group_id'], ((($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['groups'] : $ad_groups))) ? true : false,
							));
						}
						$db->sql_freeresult($result);

						// List the forums
						$right = $padding = 0;
						$padding_store = array('0' => 0);
						$sql = 'SELECT forum_id, forum_name, parent_id, left_id, right_id FROM ' . FORUMS_TABLE . ' ORDER BY left_id ASC';
						$result = $db->sql_query($sql);
						while ($row = $db->sql_fetchrow($result))
						{
							if ($row['left_id'] < $right)
							{
								$padding++;
								$padding_store[$row['parent_id']] = $padding;
							}
							else if ($row['left_id'] > $right + 1)
							{
								$padding = (isset($padding_store[$row['parent_id']])) ? $padding_store[$row['parent_id']] : $padding;
							}
							$right = $row['right_id'];

							$template->assign_block_vars('forums', array(
								'FORUM_ID'		=> $row['forum_id'],
								'FORUM_NAME'	=> $row['forum_name'],

								'S_SELECTED'	=> (in_array($row['forum_id'], ((($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['forums'] : $ad_forums))) ? true : false,
							));
							for ($i = 0; $i < $padding; $i++)
							{
								$template->assign_block_vars('forums.level', array());
							}
						}
						$db->sql_freeresult($result);

						// List the positions
						$sql = 'SELECT * FROM ' . ADS_POSITIONS_TABLE . ' ORDER BY position_id ASC';
						$result = $db->sql_query($sql);
						while ($row = $db->sql_fetchrow($result))
						{
							$template->assign_block_vars('positions', array(
								'POSITION_ID'	=> $row['position_id'],
								'POSITION_NAME'	=> (isset($user->lang[$row['lang_key']])) ? $user->lang[$row['lang_key']] : $row['lang_key'],

								'S_SELECTED'	=> (in_array($row['position_id'], ((($action == 'edit' || $action == 'copy') && !$submit) ? $ad_data['positions'] : $ad_positions))) ? true : false,
							));
						}
						$db->sql_freeresult($result);
					}
				}
			break;

			/**************************************************************************************
			*
			* Delete Advertisement/Position
			*
			**************************************************************************************/
			case 'delete' :
				// Confirm that the ad/position exist.
				if ($ad_id)
				{
					if (!$ad_data)
					{
						trigger_error($user->lang['AD_NOT_EXIST'] . adm_back_link($this->u_action));
					}
				}
				else if ($position_id)
				{
					if (!$position_data)
					{
						trigger_error($user->lang['POSITION_NOT_EXIST'] . adm_back_link($this->u_action));
					}
				}

				if (confirm_box(true))
				{
					if ($ad_id)
					{
						$db->sql_query('DELETE FROM ' . ADS_TABLE . ' WHERE ad_id = ' . $ad_id);
						$db->sql_query('DELETE FROM ' . ADS_FORUMS_TABLE . ' WHERE ad_id = ' . $ad_id);
						$db->sql_query('DELETE FROM ' . ADS_GROUPS_TABLE . ' WHERE ad_id = ' . $ad_id);
						$db->sql_query('DELETE FROM ' . ADS_IN_POSITIONS_TABLE . ' WHERE ad_id = ' . $ad_id);
						$cache->destroy('sql', ADS_FORUMS_TABLE);
						$cache->destroy('sql', ADS_GROUPS_TABLE);

						// Does the old owner have any ads anymore if the owner was changed?
						$sql = 'SELECT COUNT(ad_id) AS count FROM ' . ADS_TABLE . '
							WHERE ad_owner = ' . $ad_data['ad_owner'];
						$db->sql_query($sql);
						$count = $db->sql_fetchfield('count');
						$db->sql_freeresult();

						if (!$count)
						{
							$sql = 'UPDATE ' . USERS_TABLE . ' SET ad_owner = 0
								WHERE user_id = ' . (int) $ad_data['ad_owner'];
							$db->sql_query($sql);

							if ($config['ads_group'])
							{
								group_user_del($config['ads_group'], array($ad_data['ad_owner']));
							}
						}

						trigger_error($user->lang['DELETE_AD_SUCCESS'] . adm_back_link($this->u_action));
					}
					else if ($position_id)
					{
						$db->sql_query('DELETE FROM ' . ADS_POSITIONS_TABLE . ' WHERE position_id = ' . $position_id);
						$db->sql_query('DELETE FROM ' . ADS_IN_POSITIONS_TABLE . ' WHERE position_id = ' . $position_id);
						$cache->destroy('sql', ADS_POSITIONS_TABLE);

						trigger_error($user->lang['DELETE_POSITION_SUCCESS'] . adm_back_link($this->u_action));
					}
				}
				else
				{
					confirm_box(false, (($ad_id) ? 'DELETE_AD' : 'DELETE_POSITION'));
				}
				redirect($this->u_action);
			break;

			/**************************************************************************************
			*
			* Enable/Disable Advertisements
			*
			**************************************************************************************/
			case 'enable' :
			case 'disable' :
				// Confirm that the ad exists
				if ($ad_id)
				{
					if (!$ad_data)
					{
						trigger_error($user->lang['AD_NOT_EXIST'] . adm_back_link($this->u_action));
					}
				}

				$sql = 'UPDATE ' . ADS_TABLE . '
					SET ad_enabled = ' . (($action == 'enable') ? 1 : 0) . '
					WHERE ad_id = ' . $ad_id;
				$db->sql_query($sql);

				redirect($this->u_action);
			break;

			/**************************************************************************************
			*
			* List Advertisements, Positions, Config Settings
			*
			**************************************************************************************/
			default :
				validate_config_vars($config_vars, $this->new_config, $error);

				if ($submit && !sizeof($error))
				{
					// Config Variables
					foreach ($config_vars as $config_name => $null)
					{
						if (strpos($config_name, 'legend') === false)
						{
							set_config($config_name, $this->new_config[$config_name]);
						}
					}

					trigger_error($user->lang['ADVERTISEMENT_MANAGEMENT_UPDATE_SUCCESS'] . adm_back_link($this->u_action));
				}
				else
				{
					$template->assign_vars(array(
						'S_POSITION_LIST'	=> true,
						'S_AD_LIST'			=> true,

						'U_ACTION'			=> $this->u_action,
					));

					// Positions
					$sql = 'SELECT * FROM ' . ADS_POSITIONS_TABLE . ' ORDER BY position_id ASC';
					$result = $db->sql_query($sql);
					while ($row = $db->sql_fetchrow($result))
					{
						$template->assign_block_vars('positions', array(
							'POSTITION_ID'		=> $row['position_id'],
							'POSITION_NAME'		=> (isset($user->lang[$row['lang_key']])) ? $user->lang[$row['lang_key']] : $row['lang_key'],
							'POSITION_CODE'		=> '{ADS_' . $row['position_id'] . '}',

							'U_EDIT'			=> $this->u_action . '&amp;action=edit&amp;p=' . $row['position_id'],
							'U_DELETE'			=> $this->u_action . '&amp;action=delete&amp;p=' . $row['position_id'],
						));
					}
					$db->sql_freeresult($result);

					// Advertisements
					$sql_ary = array(
						'SELECT' => 'u.user_id, u.username, u.user_colour, a. *',
						'FROM'		=> array(
							ADS_TABLE	=> 'a',
						),
						'LEFT_JOIN'	=> array(
							array(
								'FROM'	=> array(USERS_TABLE => 'u'),
								'ON'	=> 'u.user_id = a.ad_owner'
							)
						),
						'ORDER_BY' => 'a.ad_owner DESC, a.ad_enabled DESC, a.ad_name ASC',
					);
					$sql = $db->sql_build_query('SELECT', $sql_ary);
					$result = $db->sql_query($sql);
					while ($row = $db->sql_fetchrow($result))
					{
						$template->assign_block_vars('ads', array(
							'AD_ID'			=> $row['ad_id'],
							'AD_NAME'		=> $row['ad_name'],
							'AD_NOTE'		=> nl2br($row['ad_note']),
							'AD_TIME'		=> ($row['ad_time']) ? date('Y-m-d', $row['ad_time']) : $user->lang['NA'],
							'AD_ENABLED'	=> ($row['ad_enabled']) ? $user->lang['TRUE'] : '<strong>' . $user->lang['FALSE'] . '</strong>',
							'AD_VIEWS'		=> $row['ad_views'],
							'AD_CLICKS'		=> ($row['ad_clicks']) ? $row['ad_clicks'] : $user->lang['0_OR_NA'],
							'AD_PRIORITY'	=> $row['ad_priority'],
							'AD_OWNER'		=> ($row['ad_owner']) ? get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']) : '',

							'U_EDIT'			=> $this->u_action . '&amp;action=edit&amp;a=' . $row['ad_id'],
							'U_DELETE'			=> $this->u_action . '&amp;action=delete&amp;a=' . $row['ad_id'],
							'U_COPY'			=> $this->u_action . '&amp;action=copy&amp;a=' . $row['ad_id'],
							'U_ENABLE_DISABLE'	=> $this->u_action . '&amp;action=' . (($row['ad_enabled']) ? 'disable' : 'enable') . '&amp;a=' . $row['ad_id'],
						));
					}
					$db->sql_freeresult($result);

					// Config Variables
					foreach ($config_vars as $config_key => $vars)
					{
						if (!is_array($vars) && strpos($config_key, 'legend') === false)
						{
							continue;
						}

						if (strpos($config_key, 'legend') !== false)
						{
							$template->assign_block_vars('options', array(
								'S_LEGEND'		=> true,
								'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
							);

							continue;
						}

						$type = explode(':', $vars['type']);

						$l_explain = '';
						if ($vars['explain'] && isset($vars['lang_explain']))
						{
							$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
						}
						else if ($vars['explain'])
						{
							$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
						}

						$template->assign_block_vars('options', array(
							'KEY'			=> $config_key,
							'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
							'S_EXPLAIN'		=> $vars['explain'],
							'TITLE_EXPLAIN'	=> $l_explain,
							'CONTENT'		=> build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars),
						));
					}
				}
			break;
		}

		$template->assign_vars(array(
			'ERROR'				=> implode('<br />', $error),
			'ADS_VERSION'		=> $config['ads_version'],
		));
	}

	function group_select($selected_value, $key)
	{
		global $db, $user;

		$selected = ($selected_value == 0) ? ' selected="selected"' : '';
		$select = '<option value="0"' . $selected . '>----- ' . $user->lang['NA'] . ' -----</option>';

		$sql = 'SELECT *
			FROM ' . GROUPS_TABLE;
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			if ($user->data['user_type'] != USER_FOUNDER && $row['group_founder_manage'])
			{
				continue;
			}

			$selected = ($selected_value == $row['group_id']) ? ' selected="selected"' : '';
			$lang = (isset($user->lang['G_' . $row['group_name']])) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];

			$select .= '<option value="' . $row['group_id'] . '"' . $selected . '>' . $lang . '</option>';
		}
		$db->sql_freeresult($result);

		return $select;
	}
}

?>