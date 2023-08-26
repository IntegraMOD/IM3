<?php

/**
*
* @mod package		Download Mod 6
* @file				acp_downloads.php 27 2012/08/03 OXPUS
* @copyright		(c) 2005 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
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
class acp_downloads
{
	var $u_action;

	var $edit_lang_id;
	var $lang_defs;

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $cache, $dl_cache;
		global $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix;

		$auth->acl($user->data);
		if (!$auth->acl_get('a_'))
		{
			trigger_error('DL_NO_PERMISSION', E_USER_WARNING);
		}

		$this->tpl_name = 'dl_mod/acp_downloads';

		$user->data['dl_enable_desc'] = $user->data['dl_enable_rule'] = true;

		/*
		* include and create the main class
		*/
		include($phpbb_root_path . 'dl_mod/classes/class_dlmod.' . $phpEx);
		$dl_mod = new dl_mod($phpbb_root_path, $phpEx);
		$dl_mod->register();
		dl_init::init();

		$action			= request_var('action', '');
		$submit			= request_var('submit', '');
		$cancel			= request_var('cancel', '');
		$confirm		= request_var('confirm', '');
		$mode			= request_var('mode', 'main');
		$delete			= request_var('delete', '');
		$sorting		= request_var('sorting', '');
		$sort_order		= request_var('sort_order', '');
		$filtering		= request_var('filtering', '');
		$filter_string	= request_var('filter_string', '');
		$func			= request_var('func', '');
		$username		= request_var('username', '');
		$add			= request_var('add', '');
		$edit			= request_var('edit', '');
		$move			= request_var('move', '');
		$save_cat		= request_var('save_cat', '');
		$path			= request_var('path', '');
		$dircreate		= request_var('dircreate', '');
		$dir_name		= utf8_normalize_nfc(request_var('dir_name', '', true));
		$new_path		= request_var('new_path', '');
		$new_cat		= request_var('new_cat', '');
		$file_command	= request_var('file_command', '');
		$file_assign	= request_var('file_assign', '');
		$x				= request_var('x', '');
		$y				= request_var('y', '');
		$z				= request_var('z', '');

		$df_id			= request_var('df_id', 0);
		$cat_id			= request_var('cat_id', 0);
		$new_cat_id		= request_var('new_cat_id', 0);
		$start			= request_var('start', 0);
		$show_guests	= request_var('show_guests', 0);
		$user_id		= request_var('user_id', 0);
		$user_traffic	= request_var('user_traffic', 0);
		$all_traffic	= request_var('all_traffic', 0);
		$group_id		= request_var('group_id', 0);
		$group_traffic	= request_var('group_traffic', 0);
		$group_id		= request_var('g', 0);
		$auth_view		= request_var('auth_view', 0);
		$auth_dl		= request_var('auth_dl', 0);
		$auth_up		= request_var('auth_up', 0);
		$auth_mod		= request_var('auth_mod', 0);
		$del_file		= request_var('del_file', 0);
		$click_reset	= request_var('click_reset', 0);

		if ($action == 'edit')
		{
			$enable_desc = $enable_rule = true;
		}

		$basic_link = append_sid("{$phpbb_root_path}adm/index.$phpEx", "i=downloads&amp;mode=$mode");

		/*
		* initiate the help system
		*/
		$template->assign_vars(array(
			'U_HELP_POPUP' => "{$phpbb_root_path}dl_help.$phpEx")
		);

		if ($cancel)
		{
			$action = '';
		}

		/*
		* create overall mini statistics
		*/
		$total_todo = sizeof(dl_files::all_files(0, '', 'ASC', "AND todo <> '' AND todo IS NOT NULL", 0, true, 'id'));
		$total_size = dl_physical::read_dl_sizes($phpbb_root_path . $config['dl_download_dir']);
		$total_dl = dl_main::get_sublevel_count();
		$total_extern = sizeof(dl_files::all_files(0, '', 'ASC', "AND extern = 1", 0, true, 'id'));

		$physical_limit = $config['dl_physical_quota'];
		$total_size = ($total_size > $physical_limit) ? $physical_limit : $total_size;

		$physical_limit = dl_format::dl_size($physical_limit, 2);

		/*
		* include the choosen module
		*/
		switch($mode)
		{
			case 'main':
			case 'overview':
				$this->page_title = 'ACP_DOWNLOADS';

				if ($total_dl && $total_size)
				{
					$total_size = dl_format::dl_size($total_size, 2);

					$template->assign_block_vars('total_stat', array(
						'TOTAL_STAT' => sprintf($user->lang['DL_TOTAL_STAT'], $total_dl, $total_size, $physical_limit, $total_extern))
					);
				}

				if (!$config['dl_traffic_off'])
				{
					$remain_traffic = $config['dl_overall_traffic'] - $config['dl_remain_traffic'];

					if (DL_OVERALL_TRAFFICS == true)
					{
						if ($remain_traffic <= 0)
						{
							$overall_traffic = dl_format::dl_size($config['dl_overall_traffic']);
	
							if ($user->data['user_type'] == USER_FOUNDER && FOUNDER_TRAFFICS_OFF)
							{
								$user->lang['DL_NO_MORE_REMAIN_TRAFFIC'] = '<strong>' . $user->lang['DL_TRAFFICS_FOUNDER_INFO'] . ':</strong> ' . $user->lang['DL_NO_MORE_REMAIN_TRAFFIC'];
							}
			
							$template->assign_block_vars('no_remain_traffic', array(
								'NO_OVERALL_TRAFFIC' => sprintf($user->lang['DL_NO_MORE_REMAIN_TRAFFIC'], $overall_traffic))
							);
						}
						else
						{
							$remain_text_out = $user->lang['DL_REMAIN_OVERALL_TRAFFIC'] . '<b>' . dl_format::dl_size($remain_traffic, 2) . '</b>';
	
							if ($user->data['user_type'] == USER_FOUNDER && FOUNDER_TRAFFICS_OFF)
							{
								$remain_text_out = '<strong>' . $user->lang['DL_TRAFFICS_FOUNDER_INFO'] . ':</strong> ' . $remain_text_out;
							}
			
							$template->assign_block_vars('remain_traffic', array(
								'REMAIN_TRAFFIC' => $remain_text_out)
							);
						}
					}

					if (DL_GUESTS_TRAFFICS == true)
					{
						if ($config['dl_overall_guest_traffic'] - $config['dl_remain_guest_traffic'] <= 0)
						{
							$overall_guest_traffic = dl_format::dl_size($config['dl_overall_guest_traffic']);
	
							$template->assign_block_vars('no_remain_guest_traffic', array(
								'NO_OVERALL_GUEST_TRAFFIC' => sprintf($user->lang['DL_NO_MORE_REMAIN_GUEST_TRAFFIC'], $overall_guest_traffic))
							);
						}
						else
						{
							$remain_guest_traffic = $config['dl_overall_guest_traffic'] - $config['dl_remain_guest_traffic'];
	
							$remain_guest_text_out = $user->lang['DL_REMAIN_OVERALL_GUEST_TRAFFIC'] . '<b>' . dl_format::dl_size($remain_guest_traffic, 2) . '</b>';
	
							$template->assign_block_vars('remain_guest_traffic', array(
								'REMAIN_GUEST_TRAFFIC' => $remain_guest_text_out)
							);
						}
					}
				}
				else
				{
					$template->assign_var('S_DL_TRAFFIC_OFF', true);
				}

				dl_version::dl_mod_version('acp');

				$template->assign_vars(array(
					'DL_MANAGEMENT_TITLE'	=> $user->lang['DL_ACP_MANAGEMANT_PAGE'],
					'DL_MANAGEMENT_EXPLAIN'	=> $user->lang['DL_ACP_MANAGEMANT_PAGE_EXPLAIN'],
				));

				$template->assign_var('S_DL_OVERVIEW', true);
			break;
			case 'config':
				$this->page_title = 'DL_ACP_CONFIG_MANAGEMENT';

				include($phpbb_root_path . "dl_mod/admin/dl_admin_config.$phpEx");
			break;
			case 'traffic':
				$this->page_title = 'DL_ACP_TRAFFIC_MANAGEMENT';

				include($phpbb_root_path . "dl_mod/admin/dl_admin_traffic.$phpEx");
			break;
			case 'categories':
				$this->page_title = 'DL_ACP_CATEGORIES_MANAGEMENT';

				include($phpbb_root_path . "dl_mod/admin/dl_admin_categories.$phpEx");
			break;
			case 'files':
				$this->page_title = 'DL_ACP_FILES_MANAGEMENT';

				include($phpbb_root_path . "dl_mod/admin/dl_admin_files.$phpEx");
			break;
			case 'permissions':
				$this->page_title = 'DL_ACP_PERMISSIONS';

				include($phpbb_root_path . "dl_mod/admin/dl_admin_permissions.$phpEx");
			break;
			case 'toolbox':
				$this->page_title = 'DL_MANAGE';

				include($phpbb_root_path . "dl_mod/admin/dl_admin_toolbox.$phpEx");
			break;
			case 'stats':
				$this->page_title = 'DL_ACP_STATS_MANAGEMENT';

				include($phpbb_root_path . "dl_mod/admin/dl_admin_stats.$phpEx");
			break;
			case 'ext_blacklist':
				$this->page_title = 'DL_EXT_BLACKLIST';

				include($phpbb_root_path . "dl_mod/admin/dl_admin_ext_blacklist.$phpEx");
			break;
			case 'banlist':
				$this->page_title = 'DL_ACP_BANLIST';

				include($phpbb_root_path . "dl_mod/admin/dl_admin_banlist.$phpEx");
			break;
			case 'fields':
				$this->page_title = 'DL_ACP_FIELDS';

				include($phpbb_root_path . "dl_mod/admin/dl_admin_fields.$phpEx");
			break;
			case 'browser':
				$this->page_title = 'DL_ACP_BROWSER';

				include($phpbb_root_path . "dl_mod/admin/dl_admin_browser.$phpEx");
			break;
		}

		$template->assign_vars(array(
			'DL_MOD_RELEASE' => sprintf($user->lang['DL_MOD_VERSION'], $config['dl_mod_version']),
		));
	}

	/**
	* Build all Language specific options
	* Taken from acp_profile.php (c) by phpbb.com
	*/
	function build_language_options(&$cp, $field_type, $action = 'create')
	{
		global $user, $config, $db;

		$default_lang_id = (!empty($this->edit_lang_id)) ? $this->edit_lang_id : $this->lang_defs['iso'][$config['default_lang']];

		$sql = 'SELECT lang_id, lang_iso
			FROM ' . LANG_TABLE . '
			WHERE lang_id <> ' . (int) $default_lang_id . '
			ORDER BY lang_english_name';
		$result = $db->sql_query($sql);

		$languages = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$languages[$row['lang_id']] = $row['lang_iso'];
		}
		$db->sql_freeresult($result);

		$options = array();
		$options['lang_name'] = 'string';
		if ($cp->vars['lang_explain'])
		{
			$options['lang_explain'] = 'text';
		}

		switch ($field_type)
		{
			case FIELD_BOOL:
				$options['lang_options'] = 'two_options';
			break;

			case FIELD_DROPDOWN:
				$options['lang_options'] = 'optionfield';
			break;

			case FIELD_TEXT:
			case FIELD_STRING:
				if (strlen($cp->vars['lang_default_value']))
				{
					$options['lang_default_value'] = ($field_type == FIELD_STRING) ? 'string' : 'text';
				}
			break;
		}

		$lang_options = array();

		foreach ($options as $field => $field_type)
		{
			$lang_options[1]['lang_iso'] = $this->lang_defs['id'][$default_lang_id];
			$lang_options[1]['fields'][$field] = array(
				'TITLE'		=> $user->lang['CP_' . strtoupper($field)],
				'FIELD'		=> '<dd>' . ((is_array($cp->vars[$field])) ? implode('<br />', $cp->vars[$field]) : bbcode_nl2br($cp->vars[$field])) . '</dd>'
			);

			if (isset($user->lang['CP_' . strtoupper($field) . '_EXPLAIN']))
			{
				$lang_options[1]['fields'][$field]['EXPLAIN'] = $user->lang['CP_' . strtoupper($field) . '_EXPLAIN'];
			}
		}

		foreach ($languages as $lang_id => $lang_iso)
		{
			$lang_options[$lang_id]['lang_iso'] = $lang_iso;
			foreach ($options as $field => $field_type)
			{
				$value = ($action == 'create') ? utf8_normalize_nfc(request_var('l_' . $field, array(0 => ''), true)) : $cp->vars['l_' . $field];
				if ($field == 'lang_options')
				{
					$var = (!isset($cp->vars['l_lang_options'][$lang_id]) || !is_array($cp->vars['l_lang_options'][$lang_id])) ? $cp->vars['lang_options'] : $cp->vars['l_lang_options'][$lang_id];

					switch ($field_type)
					{
						case 'two_options':

							$lang_options[$lang_id]['fields'][$field] = array(
								'TITLE'		=> $user->lang['CP_' . strtoupper($field)],
								'FIELD'		=> '
											<dd><input class="medium" name="l_' . $field . '[' . $lang_id . '][]" value="' . ((isset($value[$lang_id][0])) ? $value[$lang_id][0] : $var[0]) . '" /> ' . $user->lang['FIRST_OPTION'] . '</dd>
											<dd><input class="medium" name="l_' . $field . '[' . $lang_id . '][]" value="' . ((isset($value[$lang_id][1])) ? $value[$lang_id][1] : $var[1]) . '" /> ' . $user->lang['SECOND_OPTION'] . '</dd>'
							);
						break;

						case 'optionfield':
							$value = ((isset($value[$lang_id])) ? ((is_array($value[$lang_id])) ?  implode("\n", $value[$lang_id]) : $value[$lang_id]) : implode("\n", $var));
							$lang_options[$lang_id]['fields'][$field] = array(
								'TITLE'		=> $user->lang['CP_' . strtoupper($field)],
								'FIELD'		=> '<dd><textarea name="l_' . $field . '[' . $lang_id . ']" rows="7" cols="80">' . $value . '</textarea></dd>'
							);
						break;
					}

					if (isset($user->lang['CP_' . strtoupper($field) . '_EXPLAIN']))
					{
						$lang_options[$lang_id]['fields'][$field]['EXPLAIN'] = $user->lang['CP_' . strtoupper($field) . '_EXPLAIN'];
					}
				}
				else
				{
					$var = ($action == 'create' || !is_array($cp->vars[$field])) ? $cp->vars[$field] : $cp->vars[$field][$lang_id];

					$lang_options[$lang_id]['fields'][$field] = array(
						'TITLE'		=> $user->lang['CP_' . strtoupper($field)],
						'FIELD'		=> ($field_type == 'string') ? '<dd><input class="medium" type="text" name="l_' . $field . '[' . $lang_id . ']" value="' . ((isset($value[$lang_id])) ? $value[$lang_id] : $var) . '" /></dd>' : '<dd><textarea name="l_' . $field . '[' . $lang_id . ']" rows="3" cols="80">' . ((isset($value[$lang_id])) ? $value[$lang_id] : $var) . '</textarea></dd>'
					);

					if (isset($user->lang['CP_' . strtoupper($field) . '_EXPLAIN']))
					{
						$lang_options[$lang_id]['fields'][$field]['EXPLAIN'] = $user->lang['CP_' . strtoupper($field) . '_EXPLAIN'];
					}
				}
			}
		}

		return $lang_options;
	}

	/**
	* Save Profile Field
	* Taken from acp_profile.php (c) by phpbb.com
	*/
	function save_profile_field(&$cp, $field_type, $action = 'create')
	{
		global $db, $config, $user;

		$field_id = request_var('field_id', 0);

		// Collect all information, if something is going wrong, abort the operation
		$profile_sql = $profile_lang = $empty_lang = $profile_lang_fields = array();

		$default_lang_id = (!empty($this->edit_lang_id)) ? $this->edit_lang_id : $this->lang_defs['iso'][$config['default_lang']];

		if ($action == 'create')
		{
			$sql = 'SELECT MAX(field_order) as max_field_order
				FROM ' . DL_FIELDS_TABLE;
			$result = $db->sql_query($sql);
			$new_field_order = (int) $db->sql_fetchfield('max_field_order');
			$db->sql_freeresult($result);

			$field_ident = $cp->vars['field_ident'];
		}

		// Save the field
		$profile_fields = array(
			'field_length'			=> $cp->vars['field_length'],
			'field_minlen'			=> $cp->vars['field_minlen'],
			'field_maxlen'			=> $cp->vars['field_maxlen'],
			'field_novalue'			=> $cp->vars['field_novalue'],
			'field_default_value'	=> $cp->vars['field_default_value'],
			'field_validation'		=> $cp->vars['field_validation'],
			'field_required'		=> $cp->vars['field_required'],
		);

		if ($action == 'create')
		{
			$profile_fields += array(
				'field_type'		=> $field_type,
				'field_ident'		=> $field_ident,
				'field_name'		=> $field_ident,
				'field_order'		=> $new_field_order + 1,
				'field_active'		=> 1
			);

			$sql = 'INSERT INTO ' . DL_FIELDS_TABLE . ' ' . $db->sql_build_array('INSERT', $profile_fields);
			$db->sql_query($sql);

			$field_id = $db->sql_nextid();
		}
		else
		{
			$sql = 'UPDATE ' . DL_FIELDS_TABLE . '
				SET ' . $db->sql_build_array('UPDATE', $profile_fields) . '
				WHERE field_id = ' . (int) $field_id;
			$db->sql_query($sql);
		}

		if ($action == 'create')
		{
			$field_ident = 'pf_' . $field_ident;
			$profile_sql[] = $this->add_field_ident($field_ident, $field_type);
		}

		$sql_ary = array(
			'lang_name'				=> $cp->vars['lang_name'],
			'lang_explain'			=> $cp->vars['lang_explain'],
			'lang_default_value'	=> $cp->vars['lang_default_value']
		);

		if ($action == 'create')
		{
			$sql_ary['field_id'] = $field_id;
			$sql_ary['lang_id'] = $default_lang_id;

			$profile_sql[] = 'INSERT INTO ' . DL_LANG_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		}
		else
		{
			$this->update_insert(DL_LANG_TABLE, $sql_ary, array('field_id' => $field_id, 'lang_id' => $default_lang_id));
		}

		if (is_array($cp->vars['l_lang_name']) && sizeof($cp->vars['l_lang_name']))
		{
			foreach ($cp->vars['l_lang_name'] as $lang_id => $data)
			{
				if (($cp->vars['lang_name'] != '' && $cp->vars['l_lang_name'][$lang_id] == '')
					|| ($cp->vars['lang_explain'] != '' && $cp->vars['l_lang_explain'][$lang_id] == '')
					|| ($cp->vars['lang_default_value'] != '' && $cp->vars['l_lang_default_value'][$lang_id] == ''))
				{
					$empty_lang[$lang_id] = true;
					break;
				}

				if (!isset($empty_lang[$lang_id]))
				{
					$profile_lang[] = array(
						'field_id'		=> $field_id,
						'lang_id'		=> $lang_id,
						'lang_name'		=> $cp->vars['l_lang_name'][$lang_id],
						'lang_explain'	=> (isset($cp->vars['l_lang_explain'][$lang_id])) ? $cp->vars['l_lang_explain'][$lang_id] : '',
						'lang_default_value'	=> (isset($cp->vars['l_lang_default_value'][$lang_id])) ? $cp->vars['l_lang_default_value'][$lang_id] : ''
					);
				}
			}

			foreach ($empty_lang as $lang_id => $NULL)
			{
				$sql = 'DELETE FROM ' . DL_LANG_TABLE . '
					WHERE field_id = ' . (int) $field_id . '
					AND lang_id = ' . (int) $lang_id;
				$db->sql_query($sql);
			}
		}

		// These are always arrays because the key is the language id...
		$cp->vars['l_lang_name']			= utf8_normalize_nfc(request_var('l_lang_name', array(0 => ''), true));
		$cp->vars['l_lang_explain']			= utf8_normalize_nfc(request_var('l_lang_explain', array(0 => ''), true));
		$cp->vars['l_lang_default_value']	= utf8_normalize_nfc(request_var('l_lang_default_value', array(0 => ''), true));

		if ($field_type != FIELD_BOOL)
		{
			$cp->vars['l_lang_options']			= utf8_normalize_nfc(request_var('l_lang_options', array(0 => ''), true));
		}
		else
		{
			$cp->vars['l_lang_options']	= utf8_normalize_nfc(request_var('l_lang_options', array(0 => array('')), true));
		}

		if ($cp->vars['lang_options'])
		{
			if (!is_array($cp->vars['lang_options']))
			{
				$cp->vars['lang_options'] = explode("\n", $cp->vars['lang_options']);
			}

			if ($action != 'create')
			{
				$sql = 'DELETE FROM ' . DL_FIELDS_LANG_TABLE . '
					WHERE field_id = ' . (int) $field_id . '
						AND lang_id = ' . (int) $default_lang_id;
				$db->sql_query($sql);
			}

			foreach ($cp->vars['lang_options'] as $option_id => $value)
			{
				$sql_ary = array(
					'field_type'	=> (int) $field_type,
					'lang_value'	=> $value
				);

				if ($action == 'create')
				{
					$sql_ary['field_id'] = $field_id;
					$sql_ary['lang_id'] = $default_lang_id;
					$sql_ary['option_id'] = (int) $option_id;

					$profile_sql[] = 'INSERT INTO ' . DL_FIELDS_LANG_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
				}
				else
				{
					$this->update_insert(DL_FIELDS_LANG_TABLE, $sql_ary, array(
						'field_id'	=> $field_id,
						'lang_id'	=> (int) $default_lang_id,
						'option_id'	=> (int) $option_id)
					);
				}
			}
		}

		if (is_array($cp->vars['l_lang_options']) && sizeof($cp->vars['l_lang_options']))
		{
			$empty_lang = array();

			foreach ($cp->vars['l_lang_options'] as $lang_id => $lang_ary)
			{
				if (!is_array($lang_ary))
				{
					$lang_ary = explode("\n", $lang_ary);
				}

				if (sizeof($lang_ary) != sizeof($cp->vars['lang_options']))
				{
					$empty_lang[$lang_id] = true;
				}

				if (!isset($empty_lang[$lang_id]))
				{
					if ($action != 'create')
					{
						$sql = 'DELETE FROM ' . DL_FIELDS_LANG_TABLE . '
							WHERE field_id = ' . (int) $field_id . '
							AND lang_id = ' . (int) $lang_id;
						$db->sql_query($sql);
					}

					foreach ($lang_ary as $option_id => $value)
					{
						$profile_lang_fields[] = array(
							'field_id'		=> (int) $field_id,
							'lang_id'		=> (int) $lang_id,
							'option_id'		=> (int) $option_id,
							'field_type'	=> (int) $field_type,
							'lang_value'	=> $value
						);
					}
				}
			}

			foreach ($empty_lang as $lang_id => $NULL)
			{
				$sql = 'DELETE FROM ' . DL_FIELDS_LANG_TABLE . '
					WHERE field_id = ' . (int) $field_id . '
					AND lang_id = ' . (int) $lang_id;
				$db->sql_query($sql);
			}
		}

		foreach ($profile_lang as $sql)
		{
			if ($action == 'create')
			{
				$profile_sql[] = 'INSERT INTO ' . DL_LANG_TABLE . ' ' . $db->sql_build_array('INSERT', $sql);
			}
			else
			{
				$lang_id = $sql['lang_id'];
				unset($sql['lang_id'], $sql['field_id']);

				$this->update_insert(DL_LANG_TABLE, $sql, array('lang_id' => (int) $lang_id, 'field_id' => $field_id));
			}
		}

		if (sizeof($profile_lang_fields))
		{
			foreach ($profile_lang_fields as $sql)
			{
				if ($action == 'create')
				{
					$profile_sql[] = 'INSERT INTO ' . DL_FIELDS_LANG_TABLE . ' ' . $db->sql_build_array('INSERT', $sql);
				}
				else
				{
					$lang_id = $sql['lang_id'];
					$option_id = $sql['option_id'];
					unset($sql['lang_id'], $sql['field_id'], $sql['option_id']);

					$this->update_insert(DL_FIELDS_LANG_TABLE, $sql, array(
						'lang_id'	=> $lang_id,
						'field_id'	=> $field_id,
						'option_id'	=> $option_id)
					);
				}
			}
		}


		$db->sql_transaction('begin');

		if ($action == 'create')
		{
			foreach ($profile_sql as $sql)
			{
				$db->sql_query($sql);
			}
		}

		$db->sql_transaction('commit');

		if ($action == 'edit')
		{
			add_log('admin', 'DL_LOG_FIELD_EDIT', $cp->vars['field_ident'] . ':' . $cp->vars['lang_name']);
			trigger_error($user->lang['DL_FIELD_CHANGED'] . adm_back_link($this->u_action));
		}
		else
		{
			add_log('admin', 'DL_LOG_FIELD_CREATE', substr($field_ident, 3) . ':' . $cp->vars['lang_name']);
			trigger_error($user->lang['DL_FIELD_ADDED'] . adm_back_link($this->u_action));
		}
	}

	/**
	* Update, then insert if not successfull
	* Taken from acp_profile.php (c) by phpbb.com
	*/
	function update_insert($table, $sql_ary, $where_fields)
	{
		global $db;

		$where_sql = array();
		$check_key = '';

		foreach ($where_fields as $key => $value)
		{
			$check_key = (!$check_key) ? $key : $check_key;
			$where_sql[] = $key . ' = ' . ((is_string($value)) ? "'" . $db->sql_escape($value) . "'" : (int) $value);
		}

		if (!sizeof($where_sql))
		{
			return;
		}

		$sql = "SELECT $check_key
			FROM $table
			WHERE " . implode(' AND ', $where_sql);
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if (!$row)
		{
			$sql_ary = array_merge($where_fields, $sql_ary);

			if (sizeof($sql_ary))
			{
				$db->sql_query("INSERT INTO $table " . $db->sql_build_array('INSERT', $sql_ary));
			}
		}
		else
		{
			if (sizeof($sql_ary))
			{
				$sql = "UPDATE $table SET " . $db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE ' . implode(' AND ', $where_sql);
				$db->sql_query($sql);
			}
		}
	}

	/**
	* Return sql statement for adding a new field ident (profile field) to the profile fields data table
	* Taken from acp_profile.php (c) by phpbb.com
	*/
	function add_field_ident($field_ident, $field_type)
	{
		global $db;

		switch ($db->sql_layer)
		{
			case 'mysql':
			case 'mysql4':
			case 'mysqli':

				// We are defining the biggest common value, because of the possibility to edit the min/max values of each field.
				$sql = 'ALTER TABLE ' . DL_FIELDS_DATA_TABLE . " ADD $field_ident ";

				switch ($field_type)
				{
					case FIELD_STRING:
						$sql .= ' VARCHAR(255) ';
					break;

					case FIELD_DATE:
						$sql .= 'VARCHAR(10) ';
					break;

					case FIELD_TEXT:
						$sql .= "TEXT";
					break;

					case FIELD_BOOL:
						$sql .= 'TINYINT(2) ';
					break;

					case FIELD_DROPDOWN:
						$sql .= 'MEDIUMINT(8) ';
					break;

					case FIELD_INT:
						$sql .= 'BIGINT(20) ';
					break;
				}

			break;

			case 'sqlite':

				switch ($field_type)
				{
					case FIELD_STRING:
						$type = ' VARCHAR(255) ';
					break;

					case FIELD_DATE:
						$type = 'VARCHAR(10) ';
					break;

					case FIELD_TEXT:
						$type = "TEXT(65535)";
					break;

					case FIELD_BOOL:
						$type = 'TINYINT(2) ';
					break;

					case FIELD_DROPDOWN:
						$type = 'MEDIUMINT(8) ';
					break;

					case FIELD_INT:
						$type = 'BIGINT(20) ';
					break;
				}

				// We are defining the biggest common value, because of the possibility to edit the min/max values of each field.
				$sql = 'ALTER TABLE ' . DL_FIELDS_DATA_TABLE . " ADD $field_ident [$type]";

			break;

			case 'mssql':
			case 'mssql_odbc':

				// We are defining the biggest common value, because of the possibility to edit the min/max values of each field.
				$sql = 'ALTER TABLE [' . DL_FIELDS_DATA_TABLE . "] ADD [$field_ident] ";

				switch ($field_type)
				{
					case FIELD_STRING:
						$sql .= ' [VARCHAR] (255) ';
					break;

					case FIELD_DATE:
						$sql .= '[VARCHAR] (10) ';
					break;

					case FIELD_TEXT:
						$sql .= "[TEXT]";
					break;

					case FIELD_BOOL:
					case FIELD_DROPDOWN:
						$sql .= '[INT] ';
					break;

					case FIELD_INT:
						$sql .= '[FLOAT] ';
					break;
				}

			break;

			case 'postgres':

				// We are defining the biggest common value, because of the possibility to edit the min/max values of each field.
				$sql = 'ALTER TABLE ' . DL_FIELDS_DATA_TABLE . " ADD COLUMN \"$field_ident\" ";

				switch ($field_type)
				{
					case FIELD_STRING:
						$sql .= ' VARCHAR(255) ';
					break;

					case FIELD_DATE:
						$sql .= 'VARCHAR(10) ';
					break;

					case FIELD_TEXT:
						$sql .= "TEXT";
					break;

					case FIELD_BOOL:
						$sql .= 'INT2 ';
					break;

					case FIELD_DROPDOWN:
						$sql .= 'INT4 ';
					break;

					case FIELD_INT:
						$sql .= 'INT8 ';
					break;
				}

			break;

			case 'firebird':

				// We are defining the biggest common value, because of the possibility to edit the min/max values of each field.
				$sql = 'ALTER TABLE ' . DL_FIELDS_DATA_TABLE . ' ADD "' . strtoupper($field_ident) . '" ';

				switch ($field_type)
				{
					case FIELD_STRING:
						$sql .= ' VARCHAR(255) ';
					break;

					case FIELD_DATE:
						$sql .= 'VARCHAR(10) ';
					break;

					case FIELD_TEXT:
						$sql .= "BLOB SUB_TYPE TEXT";
					break;

					case FIELD_BOOL:
					case FIELD_DROPDOWN:
						$sql .= 'INTEGER ';
					break;

					case FIELD_INT:
						$sql .= 'DOUBLE PRECISION ';
					break;
				}

			break;

			case 'oracle':

				// We are defining the biggest common value, because of the possibility to edit the min/max values of each field.
				$sql = 'ALTER TABLE ' . DL_FIELDS_DATA_TABLE . " ADD $field_ident ";

				switch ($field_type)
				{
					case FIELD_STRING:
						$sql .= ' VARCHAR2(255) ';
					break;

					case FIELD_DATE:
						$sql .= 'VARCHAR2(10) ';
					break;

					case FIELD_TEXT:
						$sql .= "CLOB";
					break;

					case FIELD_BOOL:
						$sql .= 'NUMBER(2) ';
					break;

					case FIELD_DROPDOWN:
						$sql .= 'NUMBER(8) ';
					break;

					case FIELD_INT:
						$sql .= 'NUMBER(20) ';
					break;
				}

			break;
		}

		return $sql;
	}
}

?>