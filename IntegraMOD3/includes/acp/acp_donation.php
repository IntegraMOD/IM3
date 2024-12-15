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
/**
* @package acp
*/
class acp_donation
{
	var $u_action;
	private $u_version_check = 'http://skouat31.free.fr';

	function main($id, $mode)
	{
		global $config, $db, $user, $template;
		global $phpbb_root_path, $phpEx;

		include($phpbb_root_path . 'includes/functions_donation.' . $phpEx);

		$user->add_lang(array('posting','acp/board'));
		$action	= request_var('action', '');

		$this->tpl_name = 'acp_donation';
		$this->page_title = $user->lang['ACP_DONATION_MOD'];
		$form_key = 'acp_donation';
		add_form_key($form_key);

		$submit = (isset($_POST['submit'])) ? true : false;

		switch ($mode)
		{
			case 'overview':

				global $phpbb_admin_path, $auth;

				$this->page_title = 'DONATION_OVERVIEW';

				if ($action)
				{
					if (!confirm_box(true))
					{
						switch ($action)
						{
							case 'date':
								$confirm = true;
								$confirm_lang = 'STAT_RESET_DATE_CONFIRM';
							break;

							default:
								$confirm = true;
								$confirm_lang = 'CONFIRM_OPERATION';
						}

						if ($confirm)
						{
							confirm_box(false, $user->lang[$confirm_lang], build_hidden_fields(array(
								'i'			=> $id,
								'mode'		=> $mode,
								'action'	=> $action,
							)));
						}
					}
					else
					{
						switch ($action)
						{

							case 'date':
								if (!$auth->acl_get('a_board'))
								{
									trigger_error($user->lang['NO_AUTH_OPERATION'] . adm_back_link($this->u_action), E_USER_WARNING);
								}

								set_config('donation_install_date', time() - 1);
								add_log('admin', 'LOG_STAT_RESET_DATE');
							break;

						}
					}
				}

				// Check if a new version of this MOD is available
				$latest_version_info = $this->obtain_latest_version_info(request_var('donation_versioncheck_force', false));

				if ($latest_version_info === false || !function_exists('phpbb_version_compare'))
				{
					$template->assign_vars(array(
						'S_DONATION_VERSIONCHECK_FAIL'	=> true,
						'L_VERSIONCHECK_FAIL'			=> sprintf($user->lang['VERSIONCHECK_FAIL'], $latest_version_info),
					));
				}
				else
				{
					$latest_version_info = explode("\n", $latest_version_info);

					$template->assign_vars(array(
						'S_DONATION_VERSION_UP_TO_DATE'	=> phpbb_version_compare(trim($latest_version_info[0]), $config['donation_mod_version'], '<='),
						'U_DONATION_VERSIONCHECK'		=> $latest_version_info[1],
					));
				}

				// Check if fsockopen and cURL are available and display it in stats
				$info_curl = $info_fsockopen = $user->lang['INFO_NOT_DETECTED'];
				$s_curl = $s_fsockopen = false;

				if (function_exists('fsockopen'))
				{
					$url = parse_url($this->u_version_check);

					$fp = @fsockopen($url['host'], 80);

					if ($fp)
					{
						$info_fsockopen = $user->lang['INFO_DETECTED'];
						$s_fsockopen = true;
					}
				}

				if (function_exists('curl_init'))
				{

					$ch = curl_init($this->u_version_check);

					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

					$response = curl_exec($ch);
					$response_status = strval(curl_getinfo($ch, CURLINFO_HTTP_CODE));

					curl_close ($ch);

					if ($response !== false || $response_status != '0')
					{
						$info_curl = $user->lang['INFO_DETECTED'];
						$s_curl = true;
					}
				}

				$donation_install_date = $user->format_date($config['donation_install_date']);

				$template->assign_vars(array(
					'DONATION_INSTALL_DATE'		=> $donation_install_date,
					'DONATION_VERSION'			=> $config['donation_mod_version'],
					'INFO_CURL'					=> $info_curl,
					'INFO_FSOCKOPEN'			=> $info_fsockopen,

					'U_DONATION_VERSIONCHECK_FORCE'	=> append_sid("{$phpbb_admin_path}index.$phpEx", 'i=donation&amp;mode=' . $mode . '&amp;donation_versioncheck_force=1'),
					'U_ACTION'						=> $this->u_action,

					'S_ACTION_OPTIONS'		=> ($auth->acl_get('a_board')) ? true : false,
					'S_FSOCKOPEN'			=> $s_fsockopen,
					'S_CURL'				=> $s_curl,
					'S_OVERVIEW'			=> $mode,
				));

			break;

			case 'configuration':

				$user->add_lang('mods/donate');

				$display_vars = array(
					'title'	=> 'DONATION_CONFIG',
					'vars'	=> array(
						'legend1'						=> 'GENERAL_SETTINGS',
						'donation_enable'				=> array('lang' => 'DONATION_ENABLE',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true,),
						'donation_account_id'			=> array('lang' => 'DONATION_ACCOUNT_ID',			'validate' => 'string',	'type' => 'text:40:255', 'explain' => true,),
						'donation_default_currency'		=> array('lang' => 'DONATION_DEFAULT_CURRENCY',		'validate' => 'int',	'type' => 'select', 'function' => 'donation_item_list', 'params' => array('{CONFIG_VALUE}', 'currency', 'acp',  $user->lang['CURRENCY_DEFAULT']), 'explain' => true,),
						'donation_default_value'		=> array('lang' => 'DONATION_DEFAULT_VALUE',		'validate' => 'int:0',	'type' => 'text:10:50', 'explain' => true,),
						'donation_dropbox_enable'		=> array('lang' => 'DONATION_DROPBOX_ENABLE',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true,),
						'donation_dropbox_value'		=> array('lang' => 'DONATION_DROPBOX_VALUE',		'validate' => 'string',	'type' => 'text:40:255', 'explain' => true),

						'legend2'						=> 'SANDBOX_SETTINGS',
						'paypal_sandbox_enable'			=> array('lang' => 'SANDBOX_ENABLE',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'paypal_sandbox_founder_enable'	=> array('lang' => 'SANDBOX_FOUNDER_ENABLE',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'paypal_sandbox_address'		=> array('lang' => 'SANDBOX_ADDRESS',				'validate' => 'string',	'type' => 'text:40:255', 'explain' => true),

						'legend3'						=> 'DONATION_STATS_SETTINGS',
						'donation_stats_index_enable'	=> array('lang' => 'DONATION_STATS_INDEX_ENABLE',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true,),
						'donation_raised_enable'		=> array('lang' => 'DONATION_RAISED_ENABLE',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false,),
						'donation_raised'				=> array('lang' => 'DONATION_RAISED',				'validate' => 'int:0',	'type' => 'text:10:50', 'explain' => true,),
						'donation_goal_enable'			=> array('lang' => 'DONATION_GOAL_ENABLE',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false,),
						'donation_goal'					=> array('lang' => 'DONATION_GOAL',					'validate' => 'int:0',	'type' => 'text:10:50', 'explain' => true,),
						'donation_used_enable'			=> array('lang' => 'DONATION_USED_ENABLE',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false,),
						'donation_used'					=> array('lang' => 'DONATION_USED',					'validate' => 'int:0',	'type' => 'text:10:50', 'explain' => true,),

						'legend4'						=> 'ACP_SUBMIT_CHANGES',
					)
				);

				if (isset($display_vars['lang']))
				{
					$user->add_lang($display_vars['lang']);
				}

				$this->new_config = $config;
				$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
				$error = array();

				// We validate the complete config if whished
				validate_config_vars($display_vars['vars'], $cfg_array, $error);

				if ($submit && !check_form_key($form_key))
				{
					$error[] = $user->lang['FORM_INVALID'];
				}
				// Do not write values if there is an error
				if (sizeof($error))
				{
					$submit = false;
				}

				// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
				foreach ($display_vars['vars'] as $config_name => $null)
				{
					if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
					{
						continue;
					}

					$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

					if ($submit)
					{
						// Cleaning 'donation_dropbox_value' to conserve only numeric value
						if ($config_name == 'donation_dropbox_value' && !empty($config_value))
						{
							$donation_arr_value = explode(',', $config_value);
							if (!empty($donation_arr_value))
							{
								$donation_merge_value = array();

								foreach ($donation_arr_value as $value)
								{
									$int_value = (int) $value;
									if (!empty($int_value) && ($int_value == $value))
									{
										$donation_merge_value[] = $int_value;
									}
								}
								unset($value);

								$config_value = (!empty($donation_merge_value)) ? implode(',', $donation_merge_value) : '';
							}
						}

						set_config($config_name, $config_value);
					}
				}

				if ($submit)
				{
					add_log('admin', 'LOG_DONATION_UPDATED');

					trigger_error($user->lang['DONATION_SAVED'] . adm_back_link($this->u_action));
				}

				$this->tpl_name = 'acp_board';
				$this->page_title = $display_vars['title'];

				$template->assign_vars(array(
					'L_TITLE'			=> $user->lang[$display_vars['title']],
					'L_TITLE_EXPLAIN'	=> $user->lang[$display_vars['title'] . '_EXPLAIN'],

					'U_ACTION'			=> $this->u_action,
				));

				if (sizeof($error))
				{
					$template->assign_vars(array(
						'S_ERROR' => true,
						'ERROR_MSG' => implode('<br />', $error),
					));
				}

				// Output relevant page
				foreach ($display_vars['vars'] as $config_key => $vars)
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

					$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);

					if (empty($content))
					{
						continue;
					}

					$template->assign_block_vars('options', array(
						'KEY'			=> $config_key,
						'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
						'S_EXPLAIN'		=> $vars['explain'],
						'TITLE_EXPLAIN'	=> $l_explain,
						'CONTENT'		=> $content,
						)
					);

					unset($display_vars['vars'][$config_key]);
				}

			break;

			case 'donation_pages':

				global $cache;

				$ppdm = new ppdm_main();

				$this->page_title = 'DONATION_DP_CONFIG';

				$item_id = request_var('id', 0);
				$preview = request_var('preview', false);
				$add = request_var('add', false);
				$donation_name = request_var('donation_name', '');
				$action = $add ? 'add' : ($preview ? 'preview' : $action);

				// Retrieve available board language
				$langs = $this->get_languages();

				switch ($action)
				{
					case 'add':
					case 'edit':
					case 'preview':
						// okay, show the editor

						if (!function_exists('generate_smilies'))
						{
							include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
						}

						if (!function_exists('display_custom_bbcodes'))
						{
							include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
						}

						foreach ($langs as $lang => $entry)
						{
							$template->assign_block_vars('langs', array(
								'ISO' => $lang,
								'NAME' => $entry['name'],
							));
						}

						$input_pages = utf8_normalize_nfc(request_var('input_pages', '', true));
						$input_lang = request_var('lang_iso', '', true);

						$error = array();
						$dp_preview = false;

						// Initiate donation page data array
						$dp_data = array(
							'item_type'					=> $mode,
							'item_name'					=> $donation_name,
							'item_iso_code'				=> $input_lang,
							'item_text'					=> $input_pages,
							'item_text_bbcode_uid'		=> '',
							'item_text_bbcode_bitfield'	=> '',
						);

						if ($submit || $preview)
						{
							if (!class_exists('parse_message'))
							{
								include ($phpbb_root_path . 'includes/message_parser.' . $phpEx);
							}

							$message_parser = new parse_message($input_pages);

							// Allowing Quote BBCode
							$message_parser->parse(true, true, true, true, true, true, true, true, $mode);

							if (sizeof($message_parser->warn_msg))
							{
								$error[] = implode('<br />', $message_parser->warn_msg);
							}

							if (!check_form_key($form_key))
							{
								$error = 'FORM_INVALID';
							}

							if (!sizeof($error) && $submit && check_form_key($form_key))
							{
								$dp_data = array_merge($dp_data, array(
									'item_text'					=> (string) $message_parser->message,
									'item_text_bbcode_uid'		=> (string) $message_parser->bbcode_uid,
									'item_text_bbcode_bitfield'	=> (string) $message_parser->bbcode_bitfield,
								));

								if ($this->validate_input($dp_data))
								{
									if ($item_id || $item_id = $this->acp_exist_item_data($dp_data))
									{
										$this->acp_update_item_data($dp_data, $item_id);
									}
									else
									{
										$this->acp_add_item_data($dp_data);
									}

									$item_action = $item_id ? 'UPDATED' : 'ADDED';
									add_log('admin', 'LOG_ITEM_' . $item_action, $user->lang['MODE_DONATION_PAGES'], $user->lang[strtoupper($dp_data['item_name'])]);
									trigger_error($user->lang['DONATION_DP_LANG_' . $item_action] . adm_back_link($this->u_action));
								}

							}

							// Replace "error" strings with their real, localised form
							$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$user->lang['\\1'])) ? \$user->lang['\\1'] : '\\1'", $error);

							if ($preview)
							{
								// Now parse it for displaying
								$dp_preview = $message_parser->format_display(true, true, true, false);
								unset($message_parser);
							}
						}

						if ($item_id && !$preview)
						{
							if (!$dp_data = $this->acp_get_item_data($item_id, $mode))
							{
								trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action));
							}
						}

						decode_message($dp_data['item_text'], $dp_data['item_text_bbcode_uid']);

						$s_hidden_fields = build_hidden_fields(array(
							'id'			=> $item_id,
							'action'		=> $action,
							'donation_name'	=> $dp_data['item_name'],
						));

						// Get predifined vars
						$ppdm->get_vars(true);

						for($i = 0; $i < sizeof($ppdm->vars); $i++)
						{
							$dp_vars[$ppdm->vars[$i]['var']] = $ppdm->vars[$i]['value'];
						}

						// Assigging predefined variables in a template block vars
						for ($i = 0, $size = sizeof($ppdm->vars); $i < $size; $i++)
						{
							$template->assign_block_vars('dp_vars', array(
								'NAME'		=> $ppdm->vars[$i]['name'],
								'VARIABLE'	=> $ppdm->vars[$i]['var'],
								'EXAMPLE'	=> $ppdm->vars[$i]['value'])
							);
						}

						$template->assign_vars(array(
							'DONATION_DRAFT_PREVIEW'	=> str_replace(array_keys($dp_vars), array_values($dp_vars), $dp_preview),
							'DONATION_BODY'				=> $dp_data['item_text'],
							'LANG_ISO'					=> !empty($item_id) ? $dp_data['item_iso_code'] : $input_lang,

							'L_DONATION_PAGES_TITLE'			=> !empty($dp_data['item_name']) ? $user->lang[strtoupper($dp_data['item_name'])] : $user->lang[$this->page_title],
							'L_DONATION_PAGES_TITLE_EXPLAIN'	=> !empty($dp_data['item_name']) ? $user->lang[strtoupper($dp_data['item_name']) . '_EXPLAIN'] : '',

							'S_EDIT_DP'			=> true,
							'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
						));

						// Generate smilies on inline displaying
						generate_smilies('inline', '');

						// Assigning custom bbcodes
						display_custom_bbcodes();
					break;

					case 'delete':
						if (!$item_id)
						{
							trigger_error($user->lang['MUST_SELECT_ITEM'] . adm_back_link($this->u_action), E_USER_WARNING);
						}

						$sql = 'SELECT item_name
							FROM ' . DONATION_ITEM_TABLE . '
							WHERE item_id = ' . (int) $item_id;
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

							if (confirm_box(true))
							{
								$db->sql_query('DELETE FROM ' . DONATION_ITEM_TABLE . ' WHERE item_id = '. (int) $item_id);
								$cache->destroy('sql', DONATION_ITEM_TABLE);
								add_log('admin', 'LOG_ITEM_REMOVED', $user->lang[strtoupper($row['item_name'])]);
								trigger_error($user->lang['DONATION_DP_LANG_REMOVED'] . adm_back_link($this->u_action));
							}
							else
							{
								confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
									'item_id'	=> $item_id,
									'i'			=> $id,
									'mode'		=> $mode,
									'action'	=> $action,
									))
								);
							}
					break;
				}
				$template->assign_vars(array(
					'L_TITLE'			=> $user->lang[$this->page_title],
					'L_TITLE_EXPLAIN'	=> $user->lang[$this->page_title . '_EXPLAIN'],

					'S_DONATION_PAGES'	=> $mode,

					'U_ACTION'			=> $this->u_action,
				));

				// Show the list
				if (!$action || $action === 'delete')
				{
					// Template available language
					foreach ($langs as $lang => $entry)
					{
						$template->assign_block_vars('langs', array(
							'ISO' => $lang,
							'NAME' => $entry['name'],
						));

						// Build sql query with alias field
						$sql = 'SELECT item_id, item_name AS donation_title, item_iso_code AS lang_iso
							FROM ' . DONATION_ITEM_TABLE . "
							WHERE item_type = '" . $mode . "'
								AND item_iso_code = '" . $lang . "'";
						$result = $db->sql_query($sql);

						while ($row = $db->sql_fetchrow($result))
						{
							$row['item_id'] = (int) $row['item_id'];

							$template->assign_block_vars('langs.dp_list', array(
								'DP_TITLE'			=> $user->lang[strtoupper($row['donation_title'])],
								'DP_LANG'			=> $row['lang_iso'],

								'U_DELETE'			=> $this->u_action . '&amp;action=delete&amp;id=' . $row['item_id'],
								'U_EDIT'			=> $this->u_action . '&amp;action=edit&amp;id=' . $row['item_id'],
							));
						}
						$db->sql_freeresult($result);
					}
				}

			break;

			case 'currency':
				if ($submit && !check_form_key($form_key))
				{
					trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action));
				}

				$this->page_title = 'DONATION_DC_CONFIG';

				$action = isset($_POST['add']) ? 'add' : (isset($_POST['save']) ? 'save' : $action);
				$item_id = request_var('id', 0);

				$template->assign_vars(array(
					'L_TITLE'			=> $user->lang[$this->page_title],
					'L_TITLE_EXPLAIN'	=> $user->lang[$this->page_title . '_EXPLAIN'],
					'L_NAME'			=> $user->lang['DONATION_DC_NAME'],
					'L_CREATE_ITEM'		=> $user->lang['DONATION_DC_CREATE_CURRENCY'],

					'S_CURRENCY'		=> $mode,

					'U_ACTION'			=> $this->u_action,
				));

				//skip this code if $action is used
				if (!$action)
				{
					$sql = 'SELECT *
						FROM ' . DONATION_ITEM_TABLE . "
						WHERE item_type= '" . $mode . "'
						ORDER BY left_id";
					$result = $db->sql_query($sql);

					while ($row = $db->sql_fetchrow($result))
					{
						$row['item_id'] = (int) $row['item_id'];

						$template->assign_block_vars('items', array(
						'ITEM_NAME'			=> $row['item_name'],
						'ITEM_ENABLED'		=> ($row['item_enable']) ? true : false,

						// links
						'U_EDIT'			=> $this->u_action . '&amp;action=edit&amp;id=' . $row['item_id'],
						'U_MOVE_UP'			=> $this->u_action . '&amp;action=move_up&amp;id=' . $row['item_id'],
						'U_MOVE_DOWN'		=> $this->u_action . '&amp;action=move_down&amp;id=' . $row['item_id'],
						'U_DELETE'			=> $this->u_action . '&amp;action=delete&amp;id=' . $row['item_id'],
						'U_ENABLE'			=> $this->u_action . '&amp;action=enable&amp;id=' . $row['item_id'],
						'U_DISABLE'			=> $this->u_action . '&amp;action=disable&amp;id=' . $row['item_id'],
						));
					};
					$db->sql_freeresult($result);
				}

				switch ($action)
				{
					case 'edit':
						if (!$item_id)
						{
							trigger_error($user->lang['MUST_SELECT_ITEM'] . adm_back_link($this->u_action), E_USER_WARNING);
						}

						$sql = 'SELECT *
								FROM ' . DONATION_ITEM_TABLE . '
								WHERE item_id = ' . (int) $item_id . "
									AND item_type = '" . $mode . "'";
						$result = $db->sql_query($sql);
						$currency_ary = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

						if (!$currency_ary)
						{
							trigger_error($user->lang['MUST_SELECT_ITEM'] . adm_back_link($this->u_action), E_USER_WARNING);
						}

						$s_hidden_fields = array('id' => $item_id);

					case 'add':
						if (empty($s_hidden_fields) || !is_array($s_hidden_fields))
						{
							$s_hidden_fields = array();
						}

						$s_hidden_fields = array_merge($s_hidden_fields, array('action' => 'save',));

						$template->assign_vars(array(
							'S_EDIT'			=> true,
							'S_MODE'			=> $mode,

							'U_ACTION'			=> $this->u_action,
							'U_BACK'			=> $this->u_action,

							'ITEM_NAME'			=> isset($currency_ary['item_name']) ? $currency_ary['item_name'] : utf8_normalize_nfc(request_var('item_name', '', true)),
							'ITEM_ISO_CODE'		=> isset($currency_ary['item_iso_code']) ? $currency_ary['item_iso_code'] : utf8_normalize_nfc(request_var('item_iso_code', '', true)),
							'ITEM_SYMBOL'		=> isset($currency_ary['item_symbol']) ? $currency_ary['item_symbol'] : utf8_normalize_nfc(request_var('item_symbol', '', true)),
							'ITEM_ENABLED'		=> isset($currency_ary['item_enable']) ? $currency_ary['item_enable'] : true,

							'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
						));
						return;
					break;

					case 'save':

						$item_name = utf8_normalize_nfc(request_var('item_name', '', true));
						$item_iso_code = utf8_normalize_nfc(request_var('item_iso_code', '', true));
						$item_symbol = utf8_normalize_nfc(request_var('item_symbol','',true));
						$item_enable = request_var('item_enable', 0);

						if ( empty($item_name) )
						{
							$trigger_url = !$item_id ? '&amp;action=add' : '&amp;action=edit&amp;id=' . (int) $item_id;

							trigger_error($user->lang['DONATION_DC_ENTER_NAME'] . adm_back_link($this->u_action . $trigger_url), E_USER_WARNING);
						}

						$sql_ary = array(
							'item_name'			=> $item_name,
							'item_iso_code'		=> $item_iso_code,
							'item_symbol'		=> $item_symbol,
							'item_enable'		=> $item_enable,
							'item_type'			=> $mode,
							'item_text'			=> '',
						);

						if ($item_id)
						{
							$db->sql_query('UPDATE ' . DONATION_ITEM_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE item_id = ' . (int) $item_id);
						}
						else
						{
							$sql = 'SELECT MAX(right_id) AS right_id FROM ' . DONATION_ITEM_TABLE; 
							$result = $db->sql_query($sql);
							$right_id = (string) $db->sql_fetchfield('right_id');
							$db->sql_freeresult($result);
							$sql_ary['left_id'] = $right_id + 1;
							$sql_ary['right_id'] = $right_id + 2;

							$db->sql_query('INSERT INTO ' . DONATION_ITEM_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
						}

						$item_action = $item_id ? 'UPDATED' : 'ADDED';
						add_log('admin', 'LOG_ITEM_' . $item_action, $user->lang['MODE_CURRENCY'], $item_name);
						trigger_error($user->lang['DONATION_DC_' . $item_action] . adm_back_link($this->u_action));

					break;

					case 'delete':
						if (!$item_id)
						{
							trigger_error($user->lang['MUST_SELECT_ITEM'] . adm_back_link($this->u_action), E_USER_WARNING);
						}

						if (confirm_box(true))
						{

							$sql = 'DELETE FROM ' . DONATION_ITEM_TABLE . ' WHERE item_id = ' . (int) $item_id;
							$db->sql_query($sql);

							add_log('admin', 'LOG_ITEM_REMOVED', $user->lang['MODE_CURRENCY']);

							trigger_error($user->lang['DONATION_DC_REMOVED'] . adm_back_link($this->u_action));
						}
						else
						{
							confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
								'mode'		=> $mode,
								'item_id'	=> (int) $item_id,
								'action'	=> 'delete',
							)));
						}
					break;

					case 'move_up':
					case 'move_down':
						if (!$item_id)
						{
							trigger_error($user->lang['MUST_SELECT_ITEM'] . adm_back_link($this->u_action), E_USER_WARNING);
						}

						$sql = 'SELECT *
								FROM ' . DONATION_ITEM_TABLE . '
								WHERE item_id = ' . (int) $item_id . "
									AND item_type = '" . $mode . "'";
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

						$move_item_name = $this->move_items_by($row, $action, 1);

						if ($move_item_name !== false )
						{
							add_log('admin', 'LOG_ITEM_' . strtoupper($action), $user->lang['MODE_CURRENCY'], $row['item_name'], $move_item_name);
						}

					break;

					case 'enable':
					case 'disable':

						if (!$item_id)
						{
							trigger_error($user->lang['NO_CURRENCY'] . adm_back_link($this->u_action), E_USER_WARNING);
						}

						if ($action == 'enable')
						{
							// SQL Build array
							$sql = 'SELECT item_id
									FROM ' . DONATION_ITEM_TABLE . "
									WHERE item_type = '" . $mode . "'
										AND item_enable = 1";
							$result = $db->sql_query($sql);
							$default_currency_check = $db->sql_fetchrow($result);
							$db->sql_freeresult($result);


							if (!$default_currency_check)
							{
								set_config('donation_default_currency', (int) $item_id);
							}
						}

						if ($action)
						{
							$item_enable = ($action == 'enable') ? true : false;
							$sql = 'UPDATE ' . DONATION_ITEM_TABLE . ' SET item_enable = ' . (int) $item_enable . ' WHERE item_id = ' . (int) $item_id;
							$db->sql_query($sql);
						}

						$sql = 'SELECT *
								FROM ' . DONATION_ITEM_TABLE . '
								WHERE item_id = ' . (int) $item_id . "
									AND item_type = '" . $mode . "'";
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

						$item_action = ($action == 'enable') ? 'ENABLED' : 'DISABLED';

						add_log('admin', 'LOG_ITEM_' . $item_action, $user->lang['MODE_CURRENCY'], $row['item_name']);
						trigger_error($user->lang['DONATION_DC_' . $item_action] . adm_back_link($this->u_action));
					break;
				}

			break;

			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}
	}
	/**
	* Move item position by $steps up/down
	*/
	function move_items_by($item_row, $action = 'move_up', $steps = 1)
	{
		global $db;

		/**
		* Fetch all the siblings between the item's current spot
		* and where we want to move it to. If there are less than $steps
		* siblings between the current spot and the target then the
		* item will move as far as possible
		*/
		$sql = 'SELECT item_id, item_name, left_id, right_id
			FROM ' . DONATION_ITEM_TABLE . '
			WHERE ' . (($action == 'move_up') ? 'right_id < ' . (int) $item_row['right_id'] . ' ORDER BY right_id DESC' : 'left_id > ' . (int) $item_row['left_id'] . ' ORDER BY left_id ASC');
		$result = $db->sql_query_limit($sql, $steps);

		$target = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$target = $row;
		}
		$db->sql_freeresult($result);

		if (!sizeof($target))
		{
			// The item is already on top or bottom
			return false;
		}

		/**
		* $left_id and $right_id define the scope of the nodes that are affected by the move.
		* $diff_up and $diff_down are the values to substract or add to each node's left_id
		* and right_id in order to move them up or down.
		* $move_up_left and $move_up_right define the scope of the nodes that are moving
		* up. Other nodes in the scope of ($left_id, $right_id) are considered to move down.
		*/
		if ($action == 'move_up')
		{
			$left_id = (int) $target['left_id'];
			$right_id = (int) $item_row['right_id'];

			$diff_up = (int) ($item_row['left_id'] - $target['left_id']);
			$diff_down = (int) ($item_row['right_id'] + 1 - $item_row['left_id']);

			$move_up_left = (int) $item_row['left_id'];
			$move_up_right = (int) $item_row['right_id'];
		}
		else
		{
			$left_id = (int) $item_row['left_id'];
			$right_id = (int) $target['right_id'];

			$diff_up = (int) ($item_row['right_id'] + 1 - $item_row['left_id']);
			$diff_down = (int) ($target['right_id'] - $item_row['right_id']);

			$move_up_left = (int) ($item_row['right_id'] + 1);
			$move_up_right = (int) $target['right_id'];
		}

		$sql = 'UPDATE ' . DONATION_ITEM_TABLE . "
			SET left_id = left_id + CASE
				WHEN left_id BETWEEN {$move_up_left} AND {$move_up_right} THEN -{$diff_up}
				ELSE {$diff_down}
			END,
			right_id = right_id + CASE
				WHEN right_id BETWEEN {$move_up_left} AND {$move_up_right} THEN -{$diff_up}
				ELSE {$diff_down}
			END
			WHERE left_id BETWEEN {$left_id} AND {$right_id}
				AND right_id BETWEEN {$left_id} AND {$right_id}";
		$db->sql_query($sql);

		return $target['item_name'];
	}

	/**
	* Grab an item and bring it into a format the editor understands
	*/
	function acp_get_item_data($item_id, $item_type)
	{
		global $db;

		if ($item_id)
		{
			$sql = 'SELECT *
				FROM ' . DONATION_ITEM_TABLE . '
				WHERE item_id = ' . $item_id . "
					AND item_type= '" . $db->sql_escape($item_type) ."'";
			$result = $db->sql_query($sql);
			$item = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			if (!$item)
			{
				return false;
			}

			return $item;
		}
	}

	/**
	* Grab item_id if $data match
	*/
	function acp_exist_item_data($data)
	{
		global $db;

		$sql = 'SELECT item_id
			FROM ' . DONATION_ITEM_TABLE . "
			WHERE item_type= '" . $db->sql_escape($data['item_type']) ."'
				AND item_name = '" . $db->sql_escape($data['item_name']) . "'
				AND item_iso_code = '" . $db->sql_escape($data['item_iso_code']) . "'";
		$result = $db->sql_query($sql);
		$item = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if (!$item)
		{
			return false;
		}
		return $item['item_id'];
	}

	/**
	* List the installed language packs
	*/
	function get_languages()
	{
		global $db;

		$sql = 'SELECT *
			FROM ' . LANG_TABLE;
		$result = $db->sql_query($sql);

		$langs = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$langs[$row['lang_iso']] = array(
				'name'	=> $row['lang_local_name'],
				'id'	=> (int) $row['lang_id'],
			);
		}
		$db->sql_freeresult($result);

		return $langs;
	}

	/**
	* Insert an item.
	* param mixed $data : an array as created from acp_get_item_data
	*/
	function acp_add_item_data($data)
	{
		global $db, $cache;

		$sql = 'INSERT INTO ' . DONATION_ITEM_TABLE . ' ' . $db->sql_build_array('INSERT', $data);
		$db->sql_query($sql);

		$cache->destroy('sql', DONATION_ITEM_TABLE);
	}

	/**
	* Update an item.
	* param mixed $data : an array as created from acp_get_item_data
	*/
	function acp_update_item_data($data, $item_id)
	{
		global $db, $cache;

		$sql = 'UPDATE ' . DONATION_ITEM_TABLE . '
			SET ' . $db->sql_build_array('UPDATE', $data) . '
			WHERE item_id = ' . (int) $item_id;
		$db->sql_query($sql);

		$cache->destroy('sql', DONATION_ITEM_TABLE);
	}

	/**
	* Check if the entered data can be inserted/used
	* param mixed $data : an array as created from acp_get_item_data
	*/
	function validate_input($data)
	{
		$langs = $this->get_languages();

		if (!isset($data['item_iso_code']) ||
			!isset($data['item_name']) ||
			!isset($data['item_text']))
		{
			return false;
		}

		if (!isset($langs[$data['item_iso_code']]) ||
			!strlen($data['item_name']))
		{
			return false;
		}

		return true;
	}

	/**
	 * Obtains the latest version information
	 *
	 * @param bool $force_update Ignores cached data. Defaults to false.
	 * @param bool $warn_fail Trigger a warning if obtaining the latest version information fails. Defaults to false.
	 * @param int $ttl Cache version information for $ttl seconds. Defaults to 86400 (24 hours).
	 *
	 * @return string | false Version info on success, false on failure.
	 */
	function obtain_latest_version_info($force_update = false, $warn_fail = false, $ttl = 86400)
	{
		global $cache;

		$info = $cache->get('donationversioncheck');

		if ($info === false || $force_update)
		{
			$errstr = '';
			$errno = 0;

			$info = get_remote_file('skouat31.free.fr', '/phpbb', 'paypal_donation_10x.txt', $errstr, $errno);

			if ($info === false)
			{
				$cache->destroy('donationversioncheck');
				if ($warn_fail)
				{
					trigger_error($errstr, E_USER_WARNING);
				}
				return false;
			}

			$cache->put('donationversioncheck', $info, $ttl);
		}

		return $info;
	}
}
?>