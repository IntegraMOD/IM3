<?php
/** 
*
* @package ucp
* @version $Id: ucp_bank.php 490 2007-06-27 02:17:56Z roadydude $
* @copyright (c) 2006-2007 StarTrekGuide Development Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* ucp_groups
* @package ucp
*/
class ucp_bank
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $phpbb_root_path, $phpEx;
		global $db, $user, $auth, $cache, $template;

		$user->add_lang('mods/cash');

		$return_page = '<br /><br />' . sprintf($user->lang['RETURN_PAGE'], '<a href="' . $this->u_action . '">', '</a>');
		$update = isset($_POST['update']) ? true : false;

		switch ($mode)
		{
			case 'management':
				$this->page_title = 'UCP_BANK';
				
				$user_id = request_var('u', 0);
				$username = request_var('un', '', true);
				
				if (!$user_id && !$username)
				{
					trigger_error('SELECT_VALID_USER');
				}

				//time to pick-pocket an user
				if ($update && $user_id)
				{
					if ($user_id == $user->data['user_id'] && $user->data['user_type'] != USER_FOUNDER)
					{
						trigger_error('BANK_ROBBERY');
					}
					$cash_amt = request_var('cash_amt', array(0));

					foreach ($cash_amt as $key => $var)
					{
						$cash_ary[] = array(
							'cash_id'	=> $key,
							'cash_amt'	=> $var,
						);
					}

					foreach ($cash_ary as $row)
					{
						$sql = 'UPDATE ' . CASH_AMT_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $row) . " WHERE user_id = $user_id AND cash_id = {$row['cash_id']}";
						$db->sql_query($sql);
						$results = $db->sql_affectedrows();
						
						if ($results < 1)
						{
							$row = array_merge($row, array(
								'user_id'	=> $user_id,
							));
							$sql = 'INSERT INTO ' . CASH_AMT_TABLE . ' ' . $db->sql_build_array('INSERT', $row);
							$db->sql_query($sql);
						}
					}
					$error = $user->lang['USER_CASH_UPDATED'];
					$error .= '<br /><br />' . sprintf($user->lang['RETURN_PAGE'], '<a href="' . $this->u_action . "&amp;u=$user_id" . '">', '</a>');
					trigger_error($error);
				}
				
				$sql = 'SELECT *
					FROM ' . USERS_TABLE . '
					WHERE ' . (($username) ? "username_clean = '" . $db->sql_escape(utf8_clean_string($username)) . "'" : "user_id = $user_id");
				$result = $db->sql_query($sql);
				$userinfo = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);
				
				$user_id = $userinfo['user_id'];
				
				if ($user_id == $user->data['user_id'] && $user->data['user_type'] != USER_FOUNDER)
				{
					trigger_error('BANK_ROBBERY');
				}
				
				//grab the users cash info
				$sql = 'SELECT c.*, ca.cash_amt
					FROM ' . CASH_TABLE . ' c
					LEFT JOIN ' . CASH_AMT_TABLE . " ca ON (ca.cash_id = c.cash_id AND ca.user_id = $user_id)";
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					$template->assign_block_vars('cashrow', array(
						'CASH_ID'		=> $row['cash_id'],
						'CASH_NAME'		=> $row['cash_name'],
						'CASH_VALUE'	=> $row['cash_value'],
						'CASH_AMT'		=> ($row['cash_amt']) ? $row['cash_amt'] : 0,
					));
				}
				$db->sql_freeresult($result);
				
				$template->assign_vars(array(
					'USERNAME_FULL'		=> get_username_string('full', $user_id, $userinfo['username'], $userinfo['user_colour']),
					'U_ACTION'			=> $this->u_action . "&amp;u=$user_id",
				));
			break;
			default:
		}
		$this->tpl_name = 'mods/ucp/bank/' . $mode;
	}
}