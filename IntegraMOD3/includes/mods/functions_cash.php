<?php
/** 
*
* @package ucp
* @version $Id: functions_cash.php 490 2007-06-27 02:17:56Z roadydude $
* @copyright (c) 2006-2007 StarTrekGuide Development Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* cash functions
* @package functions
*/


function cash_post($forum_id)
{
	global $config, $auth, $user, $db;
	
	$user_update = '';
	$cash_update = false;

	//is cash mod enabled? do we have permission to gain cash for this post?
	if ($config['cash_mod'] && $auth->acl_get('f_cash', $forum_id))
	{
		if ($config['cash_limit'] != 0)
		{
			if ($user->data['user_cash_date'] != date('d-m-y'))
			{
				$cash_update = true;
				$user_update = ", user_cash_date = '" . date('d-m-y') . "', user_cash = {$config['cash_amt']}";
			}
			else if ($user->data['user_cash'] < $config['cash_limit'])
			{
				$cash_update = true;
				$user_update = ", user_cash = user_cash + {$config['cash_amt']}";
			}
		}
		else
		{
			$cash_update = true;
		}

		
		if ($cash_update)
		{
			$sql = 'UPDATE ' . CASH_AMT_TABLE . "
				SET cash_amt = cash_amt + {$config['cash_amt']}
				WHERE user_id = '{$user->data['user_id']}'
					AND cash_id = {$config['cash_id']}";
			$db->sql_query($sql);
			$number = $db->sql_affectedrows();

			if ($number < 1)
			{
				$cash_ary = array(
					'user_id'	=> $user->data['user_id'],
					'cash_id'	=> $config['cash_id'],
					'cash_amt'	=> $config['cash_amt'],
				);
				$sql = 'INSERT INTO ' . CASH_AMT_TABLE . ' ' . $db->sql_build_array('INSERT', $cash_ary);
				$db->sql_query($sql);
			}
		}
	}		
	return $user_update;
}

function member_cash($user_id)
{
	global $config, $db;
	$member['cash'] = '';
	if ($config['cash_mod'])
	{
		$member['cash'] .= '<select>';
		$sql = 'SELECT c.*, ca.cash_amt
			FROM ' . CASH_TABLE . ' c
			LEFT JOIN ' . CASH_AMT_TABLE . " ca ON (ca.cash_id = c.cash_id)
			WHERE ca.user_id = $user_id";
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$member['cash'] .= "<option>{$row['cash_name']} : {$row['cash_amt']}</option>";
		}
		$member['cash'] .= '</select>';
		if ($member['cash'] == '<select></select>')
		{
			$member['cash'] = '';
		}
	}
	return $member['cash'];
}

function cash_sql(&$sql, $user_list)
{
	global $config, $db;
	if ($config['cash_mod'])
	{
		$sql = 'SELECT u.*, ca.cash_amt
			FROM ' . USERS_TABLE . ' u
			LEFT JOIN ' . CASH_AMT_TABLE . " ca ON (ca.user_id = u.user_id AND ca.cash_id = {$config['cash_id']})
			WHERE " . $db->sql_in_set('u.user_id', $user_list);
	}
	return $sql;
}

function cash_vars()
{
	global $config, $template;
	
	$template->assign_vars(array(
		'CASH_NAME'		=> ($config['cash_mod']) ? $config['cash_name'] : '',
	));
}

function cash_array($data, $user_id)
{
	global $config, $auth, $phpbb_root_path, $phpEx;
	return array(
		'CASH' 				=> isset($data['cash']) ? $data['cash'] : '',
		'CASH_AMT'			=> ($config['cash_mod'] && isset($data['cash_amt'])) ? $data['cash_amt'] : 0,
		'CASH_NAME'			=> ($config['cash_mod'] && isset($data['cash_amt'])) ? $config['cash_name'] : '',
		'U_MANAGE_ACCOUNT'	=> ($auth->acl_get('a_bank_manage') || $auth->acl_get('m_bank_manage')) ? append_sid("{$phpbb_root_path}ucp.$phpEx", "i=bank&amp;mode=management&amp;u=$user_id") : '',
	);
}

//viewtopic stuff
function viewtopic_cash(&$sql)
{
	global $config;
	if ($config['cash_mod'])
	{
		$sql = str_replace('p.*', 'p.*, ca.cash_amt', $sql);
		$sql = str_replace('LEFT JOIN', 'LEFT JOIN ' . CASH_AMT_TABLE . " ca ON (ca.cash_id = {$config['cash_id']} AND ca.user_id = p.poster_id) LEFT JOIN", $sql);
	}
	return $sql;
}

function user_cash($poster_id, $row = array())
{
	global $config;
	if ($config['cash_mod'])
	{
		if ($poster_id == ANONYMOUS)
		{
			return array(
				'cash_amt'		=> '',
				'cash_name'		=> '',
			);
		}
		else
		{
			return array(
				'cash_amt'		=> ($config['cash_mod'] && isset($row['cash_amt'])) ? $row['cash_amt'] : '',
				'cash_name'		=> ($config['cash_mod'] && isset($row['cash_amt'])) ? $config['cash_name'] : '',
			);
		}
	}
	return array();
}

function postrow_cash($user_cache, $poster_id)
{
	global $config, $auth, $phpbb_root_path, $phpEx;
	if ($config['cash_mod'])
	{
		return array(
			'CASH_NAME'			=> $user_cache[$poster_id]['cash_name'],
			'CASH_AMT'			=> $user_cache[$poster_id]['cash_amt'],
			'U_MANAGE_ACCOUNT'	=> ($auth->acl_get('a_bank_manage') || $auth->acl_get('m_bank_manage')) ? append_sid("{$phpbb_root_path}ucp.$phpEx", "i=bank&amp;mode=management&amp;u=$poster_id") : '',
		);
	}
	return array();
}