<?php
/**
*
* @package Paypal Donation MOD
* @copyright (c) 2013 Skouat
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

class ppdm_main
{
	var $vars = array();

	/**
	* Method get_vars
	* Sets preset dynamic vars
	*
	* @param bool $acp
	*/
	function get_vars($acp = false)
	{
		global $config, $user, $auth;

		$this->vars = array(
			0	=> array(
				'var'	=> '{USER_ID}',
				'value'	=> $user->data['user_id'],
			),
			1	=> array(
				'var'	=> '{USERNAME}',
				'value'	=> $user->data['username'],
			),
			2	=> array(
				'var'	=> '{SITE_NAME}',
				'value'	=> $config['sitename'],
			),
			3	=> array(
				'var'	=> '{SITE_DESC}',
				'value'	=> $config['site_desc'],
			),
			4	=> array(
				'var'	=> '{BOARD_CONTACT}',
				'value'	=> $config['board_contact'],
			),
			5	=> array(
				'var'	=> '{BOARD_EMAIL}',
				'value'	=> $config['board_email'],
			),
			6	=> array(
				'var'	=> '{BOARD_SIG}',
				'value'	=> $config['board_email_sig'],
			),
		);

		if ($acp)
		{
			//Add language entries for displaying the vars
			for ($i = 0, $size = sizeof($this->vars); $i < $size; $i++)
			{
				$this->vars[$i]['name'] = $user->lang['DONATION_DP_' . substr(substr($this->vars[$i]['var'], 0, -1), 1)];
			}
		}
	}
}

/**
* Calculate donations stats percent number
*
* @param str $type = ''
* @param int $multiplicand
* @param int $dividend
*/
function donation_stats_percent($type = '', $multiplicand, $dividend)
{
	global $template;

	$donation_stats_percent = ($multiplicand * 100) / $dividend;

	$template->assign_vars(array(
		'DONATION_' . $type	=> round($donation_stats_percent, 2),
		'S_' . $type 		=> !empty($type) ? true : false,
	));
}

/**
* Paypal donation configuration check.
*
* @param bool $is_founder = false
*/

function donation_check_configuration($is_founder = false, $is_authorised = false)
{
	global $config, $user;
	// Do we have the donation mod enabled and paypal account set ?

	// Paypal Donation and Paypal Sandbox is disabled
	if (empty($config['donation_enable']) && empty($config['paypal_sandbox_enable']))
	{
		trigger_error($user->lang['DONATION_DISABLED'], E_USER_NOTICE);
	}

	// Paypal Donation enabled and Account ID missing
	if (!empty($config['donation_enable']) && empty($config['paypal_sandbox_enable']) && empty($config['donation_account_id']))
	{
			trigger_error($user->lang['DONATION_ADDRESS_MISSING'], E_USER_NOTICE);
	}

	// Sandbox is enabled only for founder and $is_founder is false. Or Sandbox is visible for all autorised members
	if (!empty($config['paypal_sandbox_enable']) && ((!empty($config['paypal_sandbox_founder_enable']) && !$is_founder) || (empty($config['paypal_sandbox_founder_enable']) && $is_authorised)))
	{
		// Paypal Donation disabled
		if (empty($config['donation_enable']) && !empty($config['paypal_sandbox_founder_enable']))
		{
			trigger_error($user->lang['DONATION_DISABLED'], E_USER_NOTICE);
		}

		// Paypal Donation enabled and Account ID missing
		if (!empty($config['donation_enable']) && empty($config['donation_account_id']))
		{
			trigger_error($user->lang['DONATION_ADDRESS_MISSING'], E_USER_NOTICE);
		}
	}

	// Paypal Sandbox address missing
	if (empty($config['paypal_sandbox_address']))
	{
		if (!empty($config['paypal_sandbox_enable']) && ((!empty($config['paypal_sandbox_founder_enable']) && $is_founder) || (empty($config['paypal_sandbox_founder_enable']) && $is_authorised)))
		{
			trigger_error($user->lang['SANDBOX_ADDRESS_MISSING'], E_USER_NOTICE);
		}
	}
}


/**
* Paypal donation installation check.
*
* @param bool $is_founder = false
*/

function donation_check_install($is_founder = false)
{
	global $user;

	if ($is_founder)
	{
		global $config;

		// init var
		$error = false;

		// let's check if the install is good !
		$check_vars = array(
			'donation_account_id',
			'donation_default_currency',
			'donation_default_value',
			'donation_dropbox_enable',
			'donation_dropbox_value',
			'donation_enable',
			'donation_goal',
			'donation_goal_enable',
			'donation_install_date',
			'donation_mod_version',
			'donation_raised',
			'donation_raised_enable',
			'donation_stats_index_enable',
			'donation_used',
			'donation_used_enable',
			'paypal_sandbox_address',
			'paypal_sandbox_enable',
			'paypal_sandbox_founder_enable',
			);

		foreach ($check_vars as $check_var)
		{
			if (!isset($config[$check_var]))
			{
				$error = true;
			}
		}
		unset($check_var);

		if ($error)
		{
			global $phpbb_root_path, $phpEx;

			// load language file
			$user->add_lang('mods/donate');

			$installer = "{$phpbb_root_path}install_donation_mod.$phpEx";
			if (!file_exists($installer))
			{
				trigger_error($user->lang['DONATION_INSTALL_MISSING'], E_USER_ERROR);
			}

			trigger_error($user->lang('DONATION_NOT_INSTALLED', '<a href="' . append_sid($installer) . '">', '</a>'), E_USER_ERROR);
		}
	}
}

/**
* Generate currency list.
*
* @param int $default = 4		ID of the default currency
* @param str $type				Corresponds to 'item_type' value. Can be 'device' or 'donation_pages'
* @param str $format = ''		Determine the output format. Can be 'acp', 'default_currency' or empty
* @param str $lang_key = 'USD'	Retreive from language key file the language key nammed 'CURRENCY_DEFAULT'. If it doesn't exist, USD will be the default value.
*/
function donation_item_list($default = 4, $type, $format = '', $lang_key = 'USD')
{
	global $db;

	// Build $default_currency_check to determine the default currency
	$sql = 'SELECT item_id FROM ' . DONATION_ITEM_TABLE . ' WHERE item_id = ' . (int) $default;
	$result = $db->sql_query($sql);
	$default_currency_check = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	$item_select = '';
	if ($format == 'default_currency' && $default_currency_check)
	{
		$item_select .= ' AND item_id = ' . (int) $default;
	}

	$sql = 'SELECT item_id, item_name, item_iso_code, item_symbol
		FROM ' . DONATION_ITEM_TABLE . "
		WHERE item_type = '" . $db->sql_escape($type) . "'
			AND item_enable = 1
			$item_select
		ORDER BY left_id";
	$result = $db->sql_query($sql);

	$item_list_options = '';

	// Build output
	while ($row = $db->sql_fetchrow($result))
	{
		$selected = '';

		$row['item_id'] = (int) $row['item_id'];
		if ($row['item_id'] == (int) $default)
		{
			$selected = ' selected="selected"';
		}

		if ($format == 'acp')
		{
			// Build ACP list
			$item_list_options .= '<option value="' . $row['item_id'] . '"' . $selected . '>' . $row['item_name'] . '</option>';
		}
		elseif ($format == 'default_currency')
		{
			// Build stats default currency
			$item_list_options .= $row['item_iso_code'];
		}
		else
		{
			//Build main donation list
			$item_list_options .= '<option value="' . $row['item_iso_code'] . '"' . $selected . '>' . $row['item_symbol'] . ' ' . $row['item_iso_code'] . '</option>';
		}
	};

	$db->sql_freeresult($result);

	// Assign default value if SQL result is empty and if is a currency type
	if (empty($item_list_options) && $format == 'default_currency' && $type =='currency')
	{
		$item_list_options = $lang_key;
	}
	elseif (empty($item_list_options) && $type =='currency')
	{
		$item_list_options = '<option value="' . $lang_key . '">' . $lang_key . '</option>';
	}
	return $item_list_options;
}
?>