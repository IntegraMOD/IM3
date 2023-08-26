<?php
/** 
*
* @package acp
* @version $Id: acp_cash.php 490 2007-06-27 02:17:56Z roadydude $
* @copyright (c) 2006-2007 StarTrekGuide Development Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/
class acp_cash
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $cache;
		global $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix;

		$this->tpl_name = 'acp_cash';
		$this->page_title = 'ACP_CASH';
		
		$submit = isset($_POST['submit']) ? true : false;
		switch ($mode)
		{
			default:
				if ($submit)
				{
					$cash_amt = request_var('cash_amt', 1);
					$cash_id = request_var('cash_id', 1);
					$cash_limit = request_var('cash_limit', 0);
					$cash_mod = request_var('cash_mod', 1);
					$cash_value = request_var('cash_value', array(0));
					$new_currency = request_var('new_currency', '', true);
					$new_value = request_var('new_value', 0);
					if ($cash_amt != $config['cash_amt'])
					{
						set_config('cash_amt', $cash_amt);
					}
					if ($cash_id != $config['cash_id'])
					{
						$sql = 'SELECT cash_name FROM ' . CASH_TABLE . "
							WHERE cash_id = $cash_id";
						$result = $db->sql_query($sql);
						$cash_name = $db->sql_fetchfield('cash_name');
						$db->sql_freeresult($result);
						
						set_config('cash_id', $cash_id);
						set_config('cash_name', $cash_name);
					}
					if ($cash_limit != $config['cash_limit'])
					{
						set_config('cash_limit', $cash_limit);
					}
					if ($cash_mod != $config['cash_mod'])
					{
						set_config('cash_mod', $cash_mod);
					}
					
					foreach ($cash_value as $key => $var)
					{
						$sql = 'UPDATE ' . CASH_TABLE . "
							SET cash_value = '" . $db->sql_escape($var) . "'
							WHERE cash_id = '" . $key . "'";
						$db->sql_query($sql);
					}
					
					if ($new_currency && $new_value)
					{
						$sql_ary = array(
							'cash_name'		=> $new_currency,
							'cash_value'	=> $new_value,
							'cash_trade'	=> 1,
						);
						$sql = 'INSERT INTO ' . CASH_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
						$db->sql_query($sql);
					}
					
					trigger_error($user->lang['CASH_UPDATED'] . adm_back_link($this->u_action));
				}
			
				$sql = 'SELECT * FROM ' . CASH_TABLE;
				$result = $db->sql_query($sql);
				while ($row = $db->sql_fetchrow($result))
				{
					$template->assign_block_vars('currencies', array(
						'CASH_ID'		=> $row['cash_id'],
						'CASH_NAME'		=> $row['cash_name'],
						'CASH_VALUE'	=> $row['cash_value'],
						'CHECKED'		=> ($config['cash_id'] == $row['cash_id']) ? 'checked="checked"' : '',
					));
				}
				$db->sql_freeresult($result);

				$cashmod = ($config['cash_mod']) ? 'ENABLE' : 'DISABLE';	
				$template->assign_vars(array(
					"{$config['cash_mod']}_CASHMOD"	=> 'checked="checked"',
					'CASH_AMT'						=> $config['cash_amt'],
					'CASH_LIMIT'					=> $config['cash_limit'],
				));
			break;
		}
	}
}
