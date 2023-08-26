<?php
/** 
*
* @package acp
* @copyright (c) 2005 phpBB Group, (c) 2007 lefty74 (modified acp_bots.php for Mods Database)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package acp
*/
class acp_modsdb
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $cache;
		global $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix;

		$action = request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;
		$mark	= request_var('mark', array(0));
		$mod_id	= request_var('id', 0);
		$mod_show	= request_var('mod_show', '');

		if (isset($_POST['add']))
		{
			$action = 'add';
		}

		$error = array();

		$user->add_lang('acp/modsdb');
		$this->tpl_name = 'acp_modsdb';
		$this->page_title = 'ACP_MODS_DATABASE';
		add_form_key('acp_modsdb');

		if ($submit && !check_form_key('acp_modsdb'))
		{
			$error[] = $user->lang['FORM_INVALID'];
		}

		// User wants to do something, how inconsiderate of them!
		switch ($action)
		{
			case 'delete':
				if ($mod_id || sizeof($mark))
				{
					if (confirm_box(true))
					{
						// We need to delete the relevant user, usergroup and bot entries ...
						$sql_id = ($mod_id) ? " = $mod_id" : ' IN (' . implode(', ', $mark) . ')';
						$sql = 'SELECT mod_title, mod_id 
							FROM ' . MODS_DATABASE_TABLE . " 
							WHERE mod_id $sql_id";
						$result = $db->sql_query($sql);

						$mod_id_ary = $mod_title_ary = array();
						while ($row = $db->sql_fetchrow($result))
						{
						$mod_id_ary[] = (int) $row['mod_id'];
							$mod_title_ary[] = $row['mod_title'];
						}
						$db->sql_freeresult($result);
						$db->sql_transaction('begin');

						$sql = 'DELETE FROM ' . MODS_DATABASE_TABLE . " 
							WHERE mod_id $sql_id";
						$db->sql_query($sql);

						$db->sql_transaction('commit');

						$cache->destroy('_mods');

						add_log('admin', 'LOG_MOD_DELETE', implode(', ', $mod_title_ary));
						trigger_error($user->lang['MOD_DELETED'] . adm_back_link($this->u_action));
					}
					else
					{
						confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
							'mark'		=> $mark,
							'id'		=> $mod_id,
							'mode'		=> $mode,
							'action'	=> $action))
						);
					}
				}
			break;

			case 'edit':
			case 'add':

				$mod_row = array(
					'mod_title'			=> request_var('mod_title', '', true),
					'mod_version'		=> request_var('mod_version', ''),
					'mod_version_type'	=> request_var('mod_version_type', ''),
					'mod_desc'			=> request_var('mod_desc', '', true),
					'mod_author'		=> request_var('mod_author', '', true),
					'mod_author_email'	=> strtolower(request_var('mod_author_email', '', true)),
					'mod_url'			=> request_var('mod_url', '', true),
					'mod_download'		=> request_var('mod_download' , '', true),
					'mod_phpbb_version'	=> request_var('mod_phpbb_version' , '', true),
					'mod_comments'		=> request_var('mod_comments' , '', true),
					'mod_access'		=> request_var('mod_access', ''	),
					'mod_install_day'	=> request_var('mod_install_day' , ''),
					'mod_install_month'	=> request_var('mod_install_month' , ''),
					'mod_install_year'	=> request_var('mod_install_year' , ''),
					
				);

				if ($submit)
				{
					if (!$mod_row['mod_title'] || !$mod_row['mod_version'])
					{
						$error[] = $user->lang['ERR_MOD_NO_MATCHES'];
					}

								
					if ($mod_id)
					{
						$sql = 'SELECT mod_title
							FROM ' . MODS_DATABASE_TABLE . " 
							WHERE mod_id = $mod_id";
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

						if (!$row)
						{
							$error[] = $user->lang['NO_MOD'];
						}
					}
					else
					{
					$sql = 'SELECT mod_title
						FROM ' . MODS_DATABASE_TABLE . "
						WHERE mod_title = '" . $db->sql_escape($mod_row['mod_title']) . "'";
					$result = $db->sql_query($sql);
					$row = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);
					
					if ($row)
					{
						$error[] = $user->lang['MOD_NAME_TAKEN'];
					}
					}
					if (!sizeof($error))
					{
						// New Mod? Create a Mod entry
						if ($action == 'add')
						{
							
							$sql = 'INSERT INTO ' . MODS_DATABASE_TABLE . ' ' . $db->sql_build_array('INSERT', array(
								'mod_title'			=> (string) $mod_row['mod_title'],
								'mod_version'		=> (string) $mod_row['mod_version'], 
								'mod_version_type'	=> (string) $mod_row['mod_version_type'], 
								'mod_desc'			=> (string) $mod_row['mod_desc'], 
								'mod_author'		=> (string) $mod_row['mod_author'], 
								'mod_author_email'	=> (string) $mod_row['mod_author_email'], 
								'mod_url'			=> (string) $mod_row['mod_url'], 
								'mod_download'		=> (string) $mod_row['mod_download'], 
								'mod_phpbb_version'	=> (string) $mod_row['mod_phpbb_version'], 
								'mod_comments'		=> (string) $mod_row['mod_comments'],
								'mod_access'		=> (int) $mod_row['mod_access'],
								'mod_install_date'	=> (int) ( $mod_row['mod_install_day'] == 0 || $mod_row['mod_install_month'] == 0 || $mod_row['mod_install_year'] == 0 ) ? 0 : mktime(0, 0, 0, $mod_row['mod_install_month'], $mod_row['mod_install_day'],$mod_row['mod_install_year']),
						));
							$db->sql_query($sql);
	
							$log = 'ADDED';
						}
						else if ($mod_id)
						{
							$sql = 'SELECT mod_id, mod_title 
								FROM ' . MODS_DATABASE_TABLE . " 
								WHERE mod_id = $mod_id";
							$result = $db->sql_query($sql);
							$row = $db->sql_fetchrow($result);
							$db->sql_freeresult($result);

							if (!$row)
							{
								trigger_error($user->lang['NO_MOD'] . adm_back_link($this->u_action . "&amp;id=$mod_id&amp;action=$action"), E_USER_WARNING);
							}

							$sql = 'UPDATE ' . MODS_DATABASE_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
								'mod_title'			=> (string) $mod_row['mod_title'],
								'mod_version'		=> (string) $mod_row['mod_version'], 
								'mod_version_type'	=> (string) $mod_row['mod_version_type'], 
								'mod_desc'			=> (string) $mod_row['mod_desc'], 
								'mod_author'		=> (string) $mod_row['mod_author'], 
								'mod_author_email'	=> (string) $mod_row['mod_author_email'], 
								'mod_url'			=> (string) $mod_row['mod_url'], 
								'mod_download'		=> (string) $mod_row['mod_download'],
								'mod_phpbb_version'	=> (string) $mod_row['mod_phpbb_version'], 
								'mod_comments'		=> (string) $mod_row['mod_comments'],
								'mod_access'		=> (int) $mod_row['mod_access'],
								'mod_install_date'	=> (string) ( $mod_row['mod_install_day'] == 0 || $mod_row['mod_install_month'] == 0 || $mod_row['mod_install_year'] == 0 ) ? 0 : mktime(0, 0, 0, $mod_row['mod_install_month'], $mod_row['mod_install_day'],$mod_row['mod_install_year'])
							)) . " WHERE mod_id = $mod_id";
							$db->sql_query($sql);

							$log = 'UPDATED';
						}
						
						$cache->destroy('_mods');
						
						add_log('admin', 'LOG_MOD_' . $log, $mod_row['mod_title']);
						trigger_error($user->lang['MOD_' . $log] . adm_back_link($this->u_action));
					
					}
				}
				else if ($mod_id)
				{
					$sql = 'SELECT * 
						FROM ' . MODS_DATABASE_TABLE . "
						WHERE mod_id = $mod_id";
					$result = $db->sql_query($sql);
					$mod_row = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					if (!$mod_row)
					{
						trigger_error($user->lang['NO_MOD'] . adm_back_link($this->u_action . "&amp;id=$mod_id&amp;action=$action"), E_USER_WARNING);
					}

				}
				$mod_install_day = ($action == 'edit') ? (($mod_row['mod_install_date'] == 0) ? 0 : date('j', $mod_row['mod_install_date'])) : '' ;
				$mod_install_month = ($action == 'edit') ? (($mod_row['mod_install_date'] == 0) ? 0 : date('n', $mod_row['mod_install_date'])) : '';
				$mod_install_year = ($action == 'edit') ? (($mod_row['mod_install_date'] == 0) ? 0 : date('Y', $mod_row['mod_install_date'])) : '';
				
				$s_mod_install_day_options = '<option value="0"' . ((!$mod_install_day) ? ' selected="selected"' : '') . '>--</option>';
				for ($i = 1; $i < 32; $i++)
				{
					$selected = ($i == $mod_install_day) ? ' selected="selected"' : '';
					$s_mod_install_day_options .= "<option value=\"$i\"$selected>$i</option>";
				}

				$s_mod_install_month_options = '<option value="0"' . ((!$mod_install_month) ? ' selected="selected"' : '') . '>--</option>';
				for ($i = 1; $i < 13; $i++)
				{
					$selected = ($i == $mod_install_month) ? ' selected="selected"' : '';
					$s_mod_install_month_options .= "<option value=\"$i\"$selected>$i</option>";
				}
				$s_mod_install_year_options = '';

				$now = getdate();
				$s_mod_install_year_options = '<option value="0"' . ((!$mod_install_year) ? ' selected="selected"' : '') . '>--</option>';
				for ($i = $now['year'] - 10; $i < $now['year'] + 10; $i++)
				{
					$selected = ($i == $mod_install_year) ? ' selected="selected"' : '';
					$s_mod_install_year_options .= "<option value=\"$i\"$selected>$i</option>";
				}
				unset($now);


				$l_title = ($action == 'edit') ? 'EDIT' : 'ADD';

				$template->assign_vars(array(
					'L_TITLE'		=> $user->lang['MOD_' . $l_title],
					'U_ACTION'		=> $this->u_action . "&amp;id=$mod_id&amp;action=$action",
					'U_BACK'		=> $this->u_action,
					'ERROR_MSG'		=> (sizeof($error)) ? implode('<br />', $error) : '',
					
					'MOD_TITLE'			=> $mod_row['mod_title'],
					'MOD_VERSION'		=> $mod_row['mod_version'],
					'MOD_VERSION_TYPE'	=> $mod_row['mod_version_type'],
					'MOD_DESC'			=> $mod_row['mod_desc'],
					'MOD_AUTHOR'		=> $mod_row['mod_author'],
					'MOD_AUTHOR_EMAIL'	=> $mod_row['mod_author_email'],
					'MOD_URL'			=> $mod_row['mod_url'],
					'MOD_DOWNLOAD'		=> $mod_row['mod_download'],
					'MOD_PHPBB_VERSION'	=> $mod_row['mod_phpbb_version'],
					'MOD_COMMENTS'		=> $mod_row['mod_comments'],
					'MOD_ACCESS'		=> $mod_row['mod_access'],

					'S_MOD_INSTALL_DAY_OPTIONS'		=> $s_mod_install_day_options,
					'S_MOD_INSTALL_MONTH_OPTIONS'	=> $s_mod_install_month_options,
					'S_MOD_INSTALL_YEAR_OPTIONS'	=> $s_mod_install_year_options,

					'WWW_IMG' 			=> $user->img('icon_contact_www', 'VISIT_WEBSITE'),
					'DOWNLOAD_IMG' 		=> $user->img('icon_contact_download', 'DOWNLOAD_MOD'),
						
					'S_EDIT_MOD'		=> true,
					'S_ERROR'			=> (sizeof($error)) ? true : false,
					)
				);

				return;

			break;
		}

		$s_options = '';
		$_options = array('delete' => 'DELETE');
		foreach ($_options as $value => $lang)
		{
			$s_options .= '<option value="' . $value . '">' . $user->lang[$lang] . '</option>';
		}

		if ($submit)
		{
			set_config('mod_show', (int) $mod_show);
		}


		$template->assign_vars(array(
			'U_ACTION'		=> $this->u_action,
			'S_MOD_SHOW_MEMBERS'		=> ( $config['mod_show'] == 0 ) ? true:false,
			'S_MOD_SHOW_MODS'			=> ( $config['mod_show'] == 1 ) ? true:false,
			'S_MOD_SHOW_ADMINS'		=> ( $config['mod_show'] == 2 ) ? true:false,
			'S_MOD_OPTIONS'	=> $s_options)
		);

		$sql = 'SELECT * 
			FROM ' . MODS_DATABASE_TABLE . ' 
			ORDER BY mod_title ASC';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{

		$template->assign_block_vars('mods', array(
				'MOD_ID'			=> $row['mod_id'],
				'MOD_TITLE'			=> $row['mod_title'],
				'MOD_VERSION'		=> $row['mod_version'],
				'MOD_VERSION_TYPE'	=> $row['mod_version_type'],
				'MOD_DESC'			=> prepare_description($row['mod_desc']), //bbcode etc can be used in the mod description
				'MOD_AUTHOR'		=> $row['mod_author'],
				'MOD_AUTHOR_EMAIL'	=> $row['mod_author_email'],
				'MOD_URL'			=> $row['mod_url'],
				'MOD_DOWNLOAD'		=> $row['mod_download'],
				'MOD_PHPBB_VERSION'	=> $row['mod_phpbb_version'],
				'MOD_COMMENTS'		=> prepare_description($row['mod_comments']),//bbcode etc can be used in the mod description
				'MOD_ACCESS'		=> ( $row['mod_access'] ) ? true : false,

				'U_EDIT'				=> $this->u_action . "&amp;id={$row['mod_id']}&amp;action=edit",
				'U_DELETE'				=> $this->u_action . "&amp;id={$row['mod_id']}&amp;action=delete")
			);
		}
		$db->sql_freeresult($result);
	}
	
}
	function prepare_description($text)
	{
		 		
		$text			= utf8_normalize_nfc($text);
		$uid			= $bitfield			= $options	= '';	
		$allow_bbcode	= $allow_smilies	= true;
		$allow_urls		= false;
		generate_text_for_storage($text, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);
		$text			= generate_text_for_display($text, $uid, $bitfield, $options);
		
		return $text;
	}

?>