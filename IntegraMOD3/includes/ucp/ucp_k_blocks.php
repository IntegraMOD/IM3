<?php
/**
*
* @package SGP Portal
* @version $Id$
* @copyright (c) 2005 2008 phpBB Group
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
* ucp_delete user block info
* Delete stored positions
*
* Note to potential users of this code ...
*
* Remember this is released under the _GPL_ and is subject
* to that licence. Do not incorporate this within software
* released or distributed in any way under a licence other
* than the GPL. We will be watching ... ;)
*
* @package SGP Portal
*/
class ucp_k_blocks
{
	var $u_action;

	private $dataleft, $datacenter, $dataright;

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $phpbb_root_path, $phpEx, $phpbb_root_path, $phpEx, $k_config;

		$user->add_lang('k_tools');

		$preview  = (!empty($_POST['preview'])) ? true : false;
		$submit   = (!empty($_POST['submit'])) ? true : false;
		$delete   = (!empty($_POST['delete'])) ? true : false;

		$error = $data = array();
		$s_hidden_fields = '';
		$message = '';

		global $dataleft, $datacenter, $dataright;

		$form_key = 'ucp_k_blocks';
		add_form_key($form_key);

		$user_id = $user->data['user_id'];

		$row = get_current_block_layout($user_id);

		$reset_blocks = request_var('reset_blocks', false);

		switch ($mode)
		{
			case 'arrange':
				$template->assign_vars(array(
					'ARRANGE_ICO'      => $user->lang['UCP_K_INFO_ARRANGE'],
					'L_ARRANGE_ICON'   => $user->lang['ARRANGE_ICON'],
					'U_PORTAL_ARRANGE' => append_sid("{$phpbb_root_path}portal.$phpEx", "arrange=1"),
					'LINK_IMG'         => '<img src="' . $phpbb_root_path . '/images/portal_ucp_images/arrange.gif" alt="" />',
				));
			break;

			case 'edit':
				$template->assign_vars(array(
					'L_SWITCH_INFO'    => $user->lang['UCP_K_INFO_EDIT'],
					'K_LEFT_BLOCKS'    => $row['user_left_blocks'],
					'K_CENTER_BLOCKS'  => $row['user_center_blocks'],
					'K_RIGHT_BLOCKS'   => $row['user_right_blocks'],
				));

			break;

			case 'delete':
				$template->assign_vars(array(
					'CKECKBOX'       => 1,
					'L_SWITCH_INFO'  => $user->lang['UCP_K_INFO_DELETE'],
				));
			break;

			case 'info':
				$template->assign_vars(array(
					'CKECKBOX'        => 1,
					'L_SWITCH_INFO'   => $user->lang['UCP_K_INFO_INFO'],
					'PORTAL_SITE'     => $user->lang['DEV_SITE'] . 'http://www.phpbbireland.com',
					'PORTAL_VERSION'  => $config['portal_version'],
					'PORTAL_BUILD'    => $config['portal_build'],
				));
			break;

			case 'width':
				$template->assign_vars(array(
					'CHECKBOX'       => 1,
					'L_SWITCH_INFO'  => $user->lang['UCP_K_INFO_WIDTH'],
				));
			break;

			default:
			break;
		}

		if ($submit)
		{
			if (!check_form_key($form_key))
			{
				$submit = false;
				$mode = '';
				trigger_error($user->lang['FORM_INVALID']);
			}

			if ($mode == 'edit')
			{
				$user_left_blocks = request_var('left_blocks', '');
				$user_center_blocks = request_var('center_blocks', '');
				$user_right_blocks = request_var('right_blocks', '');

				$sql = "UPDATE " . USERS_TABLE . "
					SET user_left_blocks = '" . $db->sql_escape($user_left_blocks) . "',
						user_center_blocks = '" . $db->sql_escape($user_center_blocks) . "',
						user_right_blocks = '" . $db->sql_escape($user_right_blocks) . "'
					WHERE user_id =  " . $user->data['user_id'];

				$result = $db->sql_query_limit($sql, 1);

				if (!$result)
				{
					$message = $user->lang['UCP_K_NOT_SAVED'];
				}
				else
				{
					$message = $user->lang['UCP_K_SAVED'];
				}

				meta_refresh(1, $this->u_action);
			}

			if ($mode == 'delete')
			{
				if ($reset_blocks)
				{
					$sql = "UPDATE " . USERS_TABLE . "
						SET user_left_blocks = '', user_center_blocks = '', user_right_blocks = ''
						WHERE user_id = " . $user_id;
					$result = $db->sql_query_limit($sql, 1);

					$template->assign_vars(array(
						'CKECKBOX'		=> 0,
					));

					$message = $user->lang['UCP_K_RESET'];
					meta_refresh(1, $this->u_action);
				}
			}
		}

		get_default_block_layout($user_id);

		$template->assign_vars(array(
			'SWITCH'           => $mode,
			'MESSAGE'          => $message,
			'CHECKBOX'         => ($mode == 'delete') ? 1 : 0,
			'DATA_LEFT'        => $dataleft,
			'DATA_CENTER'      => $datacenter,
			'DATA_RIGHT'       => $dataright,
			'L_TITLE'          => $user->lang['UCP_K_BLOCKS_' . strtoupper((string) $mode)],
			'S_HIDDEN_FIELDS'  => $s_hidden_fields,
			'S_UCP_ACTION'     => $this->u_action,
		));

		$this->tpl_name = 'ucp_k_blocks';
	}

}

function get_current_block_layout($id)
{
	global $config, $db, $user, $auth, $template, $phpbb_root_path, $phpEx, $phpbb_root_path;

	$sql = "SELECT user_id, user_left_blocks, user_center_blocks, user_right_blocks
		FROM " . USERS_TABLE . "
		WHERE user_id = " . (int)$id;

	if ($result = $db->sql_query($sql))
	{
		$row = $db->sql_fetchrow($result);
	}
	$db->sql_freeresult($result);
	return($row);
}

function get_default_block_layout($id)
{
	global $config, $db, $user, $auth, $template, $phpbb_root_path, $phpEx, $phpbb_root_path;

	global $dataleft, $datacenter, $dataright;

	$existing = get_current_block_layout($id);

	$sql = 'SELECT id, position, html_file_name, view_pages, view_all
		FROM ' . K_BLOCKS_TABLE . '
		WHERE active = 1
			AND view_pages <> 0';

	if ($result = $db->sql_query($sql))
	{
		while ($row = $db->sql_fetchrow($result))
		{
			if ($row['view_all'] == '1' || strpos((string) $row['view_pages'], (string) $user->data['group_id']))
			{
				if ($row['position'] == 'L')
				{
//					$count = count($row['view_pages']);

					if (strpos((string) $existing['user_left_blocks'], (string) $row['id']))
					{
						$dataleft .= $row['id'] . ',';
					}
					else
					{
						$dataleft .= '<strong>';
						$dataleft .= $row['id'];
						$dataleft .= '</strong>,';
					}
				}
				else if ($row['position'] == 'C')
				{
					if (!strpos((string) $existing['user_center_blocks'], (string) $row['id']))
					{
						$datacenter .= '<strong>';
						$datacenter .= $row['id'];
						$datacenter .= '</strong>,';
					}
					else
					{
						$datacenter .= $row['id'] . ',';
					}
				}
				else if ($row['position'] == 'R')
				{
					if (!strpos((string) $existing['user_right_blocks'], (string) $row['id']))
					{
						$dataright .= '<strong>';
						$dataright .= $row['id'];
						$dataright .= '</strong>,';
					}
					else
					{
						$dataright .= $row['id'] . ',';
					}
				}
			}
		}
	}
	$db->sql_freeresult($result);
}
 