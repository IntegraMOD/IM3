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
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_donation.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/donate');

$is_founder = $user->data['user_type'] == USER_FOUNDER;
$is_authorised = $auth->acl_get('u_pdm_use');

if (!$is_authorised)
{
	trigger_error('NOT_AUTHORISED');
}

// Checks that the MOD is fully installed and configured with the prerequisite settings
donation_check_install($is_founder);
donation_check_configuration($is_founder, $is_authorised);

// Request vars
$mode = request_var('mode', '');

// Assign $mode to template
$template->assign_var('MODE', $mode);

// initiate ppdm class
$ppdm = new ppdm_main();

// Get predifined vars
$ppdm->get_vars();

for($i = 0; $i < sizeof($ppdm->vars); $i++)
{
	$dp_vars[$ppdm->vars[$i]['var']] = $ppdm->vars[$i]['value'];
}

switch ($mode)
{
	case 'success':
	case 'cancel':
		// Retrieve information text of donation customizable pages
		$sql = 'SELECT item_text, item_text_bbcode_uid, item_text_bbcode_bitfield, item_text_bbcode_options
			FROM ' . DONATION_ITEM_TABLE . "
			WHERE item_name = 'donation_" . $db->sql_escape($mode) . "'
				AND item_type = 'donation_pages'
				AND item_iso_code = '" . $user->lang_name . "'";
		$result = $db->sql_query($sql);
		$donation_pages = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$donation_body = isset($user->lang[strtoupper($donation_pages['item_text'])]) ? $user->lang[strtoupper($donation_pages['item_text'])] : $donation_pages['item_text'];
		$donation_body = generate_text_for_display($donation_body, $donation_pages['item_text_bbcode_uid'], $donation_pages['item_text_bbcode_bitfield'], $donation_pages['item_text_bbcode_options']);

		$donation_title = $user->lang['DONATION_' . strtoupper($mode) . '_TITLE'];

		$template->assign_vars(array(
			'DONATION_BODY'		=> str_replace(array_keys($dp_vars), array_values($dp_vars), $donation_body),
			'L_DONATION_TITLE'	=> $donation_title,
		));

		page_header($donation_title);
		$template->set_filenames(array('body' => 'donate/donate_body.html'));
	break;

	default:
		// Build Paypal return URL
		$success_url = append_sid(generate_board_url(true) . $user->page['script_path'] . $user->page['page_name'], 'mode=success');
		$cancel_url = append_sid(generate_board_url(true) . $user->page['script_path'] . $user->page['page_name'], 'mode=cancel');

		// Retrieve Paypal Sandbox value
		if (!empty($config['paypal_sandbox_enable']) && (!empty($config['paypal_sandbox_founder_enable']) && $is_founder || empty($config['paypal_sandbox_founder_enable'])))
		{
			$business = $config['paypal_sandbox_address'];
			$forms_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
			$s_sandbox = true;
		}
		else
		{
			$business = $config['donation_account_id'];
			$forms_url = 'https://www.paypal.com/cgi-bin/webscr';
			$s_sandbox = false;
		}

		// Retrieve currency value
		$list_currency = donation_item_list((int) $config['donation_default_currency'], 'currency', '', $user->lang['CURRENCY_DEFAULT']);
		$donation_currency = donation_item_list((int) $config['donation_default_currency'], 'currency', 'default_currency', $user->lang['CURRENCY_DEFAULT']);

		// Retrieve donation value for drop-down list
		$list_donation_value = '';

		if (!empty($config['donation_dropbox_enable']) && !empty($config['donation_dropbox_value']))
		{
			$donation_arr_value = explode(',', $config['donation_dropbox_value']);

			foreach ($donation_arr_value as $value)
			{
				$int_value = (int) $value;
				if (!empty($int_value) && ($int_value == $value))
				{
					$list_donation_value .= '<option value="' . $int_value . '">' . $int_value . '</option>';
				}
			}
			unset($value);
		}

		// Build hidden fields
		$s_hidden_fields = build_hidden_fields(array(
			'cmd'			=> '_xclick',
			'business'		=> $business,
			'item_name'		=> $user->lang['DONATION_TITLE_HEAD'] . ' ' . $config['sitename'],
			'no_shipping'	=> 1,
			'return'		=> $success_url,
			'cancel_return'	=> $cancel_url,
			'item_number'	=> 'uid_' . $user->data['user_id'] . '_' . time(),
			'tax'			=> 0,
			'bn'			=> 'Board_Donate_WPS',
			'charset'		=> 'utf-8',
			));

		// Retrieve text content for DONATION_BODY
		$sql = 'SELECT item_text, item_text_bbcode_uid, item_text_bbcode_bitfield, item_text_bbcode_options
			FROM ' . DONATION_ITEM_TABLE . "
			WHERE item_type = 'donation_pages'
				AND item_name = 'donation_body'
				AND item_iso_code = '" . $user->lang_name . "'";
		$result = $db->sql_query($sql);
		$donation_pages = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$donation_body = generate_text_for_display($donation_pages['item_text'], $donation_pages['item_text_bbcode_uid'], $donation_pages['item_text_bbcode_bitfield'], $donation_pages['item_text_bbcode_options']);

		// Donation percent
		if (!empty($config['donation_goal_enable']) && (int) $config['donation_goal'] > 0)
		{
			donation_stats_percent('GOAL_NUMBER', (int) $config['donation_raised'], (int) $config['donation_goal']);
		}

		if (!empty($config['donation_used_enable']) && (int) $config['donation_raised'] > 0 && (int) $config['donation_used'] > 0)
		{
			donation_stats_percent('USED_NUMBER', (int) $config['donation_used'], (int) $config['donation_raised']);
		}

		// Assign vars to template
		$template->assign_vars(array(
			'DONATION_GOAL_ENABLE'			=> (!empty($config['donation_goal_enable'])) ? true : false,
			'DONATION_RAISED_ENABLE'		=> (!empty($config['donation_raised_enable'])) ? true : false,
			'DONATION_USED_ENABLE'			=> (!empty($config['donation_used_enable'])) ? true : false,

			'L_DONATION_GOAL'				=> ((int) $config['donation_goal'] <= 0) ? $user->lang['DONATE_NO_GOAL'] : ((int) $config['donation_goal'] < (int) $config['donation_raised'] ? $user->lang['DONATE_GOAL_REACHED'] : sprintf($user->lang['DONATE_GOAL_RAISE'], (int) $config['donation_goal'], $donation_currency)),
			'L_DONATION_RAISED'				=> ((int) $config['donation_raised'] <= 0) ? $user->lang['DONATE_NOT_RECEIVED'] : sprintf($user->lang['DONATE_RECEIVED'], (int) $config['donation_raised'], $donation_currency),
			'L_DONATION_USED'				=> ((int) $config['donation_used'] <= 0) ? $user->lang['DONATE_NOT_USED'] : ((int) $config['donation_used'] < (int) $config['donation_raised'] ? sprintf($user->lang['DONATE_USED'], (int) $config['donation_used'], $donation_currency, (int) $config['donation_raised']) : sprintf($user->lang['DONATE_USED_EXCEEDED'], (int) $config['donation_used'], $donation_currency)),
 
			'DONATION_BODY'					=> str_replace(array_keys($dp_vars), array_values($dp_vars), $donation_body),
			'LIST_DONATION_CURRENCY'		=> $list_currency,
			'DONATION_DEFAULT_VALUE'		=> (!empty($config['donation_default_value'])) ? $config['donation_default_value'] : 0,
			'LIST_DONATION_VALUE'			=> $list_donation_value,

			'S_HIDDEN_FIELDS'				=> $s_hidden_fields,
			'S_DONATE_FORMS'				=> $forms_url,
			'S_DONATION_DROPBOX'			=> (!empty($list_donation_value)) ? true : false,
			'S_SANDBOX'						=> $s_sandbox,
			));

		page_header($user->lang['DONATION_TITLE']);
		$template->set_filenames(array('body' => 'donate/donate_body.html'));
	break;
}

// Set up Navlinks
$template->assign_block_vars('navlinks', array(
	'FORUM_NAME'	=> $user->lang['DONATION_TITLE'],
	'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}donate.$phpEx"),
));

page_footer();
?>