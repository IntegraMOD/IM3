<?php
/**
*
* @package acp
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
class acp_mod_undo
{
	var $u_action;
	var $tpl_name;
	var $page_title;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $config, $phpbb_root_path, $phpEx;

		include_once($phpbb_root_path . 'includes/functions_mod_undo.' . $phpEx);

		$user->add_lang('mods/info_acp_mod_undo');
		im3_mod_undo_ensure_schema();

		$this->tpl_name = 'acp_mod_undo';
		$form_key = 'acp_mod_undo';
		add_form_key($form_key);

		if ($mode == 'settings')
		{
			$this->page_title = 'ACP_MOD_UNDO_SETTINGS';

			if (isset($_POST['submit']))
			{
				if (!check_form_key($form_key))
				{
					trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				set_config('mod_undo_enable', request_var('mod_undo_enable', 0) ? '1' : '0');
				set_config('mod_undo_admins', request_var('mod_undo_admins', 0) ? '1' : '0');
				set_config('mod_undo_days', (string) max(0, min(3650, request_var('mod_undo_days', 30))));

				add_log('admin', 'LOG_CONFIG_SETTINGS');
				trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
			}

			$template->assign_vars(array(
				'S_SETTINGS'	=> true,
				'L_TITLE'		=> $user->lang['ACP_MOD_UNDO_SETTINGS'],
				'L_TITLE_EXPLAIN'	=> $user->lang['ACP_MOD_UNDO_SETTINGS_EXPLAIN'],
				'S_ENABLE'		=> !empty($config['mod_undo_enable']),
				'S_ADMINS'		=> !empty($config['mod_undo_admins']),
				'UNDO_DAYS'		=> (int) $config['mod_undo_days'],
				'U_ACTION'		=> $this->u_action,
			));

			return;
		}

		$this->page_title = 'ACP_MOD_UNDO_LIST';

		$restore_marked = isset($_POST['restore_marked']);
		$revert_user = isset($_POST['revert_user']);

		if ($restore_marked || $revert_user)
		{
			$ids = array();

			if ($restore_marked)
			{
				$ids = array_map('intval', request_var('mark', array(0)));
				$ids = array_values(array_filter($ids));

				if (!sizeof($ids))
				{
					trigger_error($user->lang['MOD_UNDO_NOTHING_MARKED'] . adm_back_link($this->u_action), E_USER_WARNING);
				}
			}
			else
			{
				$name = utf8_normalize_nfc(request_var('revert_name', '', true));
				$days = request_var('revert_days', 0);
				$revert_id = 0;

				if ($name !== '' && $days > 0)
				{
					$sql = 'SELECT user_id
						FROM ' . USERS_TABLE . "
						WHERE username_clean = '" . $db->sql_escape(utf8_clean_string($name)) . "'";
					$result = $db->sql_query($sql);
					$revert_id = (int) $db->sql_fetchfield('user_id');
					$db->sql_freeresult($result);
				}

				if (!$revert_id)
				{
					trigger_error($user->lang['MOD_UNDO_NO_USER'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$sql = 'SELECT undo_id
					FROM ' . MOD_UNDO_TABLE . '
					WHERE user_id = ' . $revert_id . '
						AND undo_status = 0
						AND undo_time >= ' . (time() - (min(3650, $days) * 86400));
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					$ids[] = (int) $row['undo_id'];
				}
				$db->sql_freeresult($result);

				if (!sizeof($ids))
				{
					trigger_error($user->lang['MOD_UNDO_NOTHING_FOUND'] . adm_back_link($this->u_action), E_USER_WARNING);
				}
			}

			if (!check_form_key($form_key))
			{
				trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
			}

			// Newest first so stacked actions unwind in the correct order
			$sql = 'SELECT undo_id, undo_summary
				FROM ' . MOD_UNDO_TABLE . '
				WHERE ' . $db->sql_in_set('undo_id', $ids) . '
				ORDER BY undo_time DESC, undo_id DESC';
			$result = $db->sql_query($sql);
			$rows = $db->sql_fetchrowset($result);
			$db->sql_freeresult($result);

			$done = 0;
			$errors = array();

			foreach ($rows as $row)
			{
				$error = '';

				if (im3_mod_undo_restore((int) $row['undo_id'], $error))
				{
					$done++;
				}
				else
				{
					$errors[] = htmlspecialchars($row['undo_summary'], ENT_COMPAT, 'UTF-8') . ': ' . (isset($user->lang[$error]) ? $user->lang[$error] : $error);
				}
			}

			$message = sprintf($user->lang['MOD_UNDO_RESTORED'], $done);

			if (sizeof($errors))
			{
				$message .= '<br /><br />' . $user->lang['MOD_UNDO_ERRORS'] . '<br />' . implode('<br />', $errors);
			}

			trigger_error($message . adm_back_link($this->u_action), (sizeof($errors)) ? E_USER_WARNING : E_USER_NOTICE);
		}

		$start = request_var('start', 0);
		$filter_status = request_var('filter_status', 0);
		$filter_user = utf8_normalize_nfc(request_var('filter_user', '', true));
		$per_page = 25;

		$where = array();

		if ($filter_status === 0 || $filter_status === 1)
		{
			$where[] = 'u.undo_status = ' . $filter_status;
		}

		if ($filter_user !== '')
		{
			$where[] = "m.username_clean = '" . $db->sql_escape(utf8_clean_string($filter_user)) . "'";
		}

		$sql_where = (sizeof($where)) ? ' AND ' . implode(' AND ', $where) : '';

		$sql = 'SELECT COUNT(u.undo_id) AS total
			FROM ' . MOD_UNDO_TABLE . ' u, ' . USERS_TABLE . ' m
			WHERE m.user_id = u.user_id' . $sql_where;
		$result = $db->sql_query($sql);
		$total = (int) $db->sql_fetchfield('total');
		$db->sql_freeresult($result);

		$sql = 'SELECT u.undo_id, u.undo_action, u.user_id, u.forum_id, u.topic_id, u.post_id, u.undo_time, u.undo_summary, u.undo_status, u.restored_time,
				m.username, m.user_colour
			FROM ' . MOD_UNDO_TABLE . ' u, ' . USERS_TABLE . ' m
			WHERE m.user_id = u.user_id' . $sql_where . '
			ORDER BY u.undo_time DESC, u.undo_id DESC';
		$result = $db->sql_query_limit($sql, $per_page, $start);

		while ($row = $db->sql_fetchrow($result))
		{
			$key = 'MOD_UNDO_ACTION_' . strtoupper($row['undo_action']);
			$u_view = '';

			if ($row['undo_action'] === 'edit' && $row['post_id'])
			{
				$u_view = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'p=' . (int) $row['post_id']) . '#p' . (int) $row['post_id'];
			}

			$template->assign_block_vars('undo', array(
				'ID'			=> (int) $row['undo_id'],
				'DATE'			=> $user->format_date($row['undo_time']),
				'MODERATOR'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
				'ACTION'		=> isset($user->lang[$key]) ? $user->lang[$key] : $row['undo_action'],
				'SUMMARY'		=> htmlspecialchars($row['undo_summary'], ENT_COMPAT, 'UTF-8'),
				'U_VIEW'		=> $u_view,
				'S_PENDING'		=> ((int) $row['undo_status'] === 0),
				'RESTORED_DATE'	=> ($row['restored_time']) ? $user->format_date($row['restored_time']) : '',
			));
		}
		$db->sql_freeresult($result);

		$base_url = $this->u_action . '&amp;filter_status=' . $filter_status . (($filter_user !== '') ? '&amp;filter_user=' . urlencode($filter_user) : '');

		$template->assign_vars(array(
			'S_LIST'			=> true,
			'S_ENABLED'			=> !empty($config['mod_undo_enable']),
			'L_TITLE'			=> $user->lang['ACP_MOD_UNDO_LIST'],
			'L_TITLE_EXPLAIN'	=> $user->lang['ACP_MOD_UNDO_LIST_EXPLAIN'],
			'FILTER_STATUS'		=> $filter_status,
			'FILTER_USER'		=> htmlspecialchars($filter_user, ENT_COMPAT, 'UTF-8'),
			'PAGINATION'		=> generate_pagination($base_url, $total, $per_page, $start, true),
			'S_ON_PAGE'			=> on_page($total, $per_page, $start),
			'U_ACTION'			=> $this->u_action,
		));
	}
}
