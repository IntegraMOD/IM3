<?php
/**
* @version $Id$
*
* @copyright (c) 2008 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
*/
if (!defined('IN_PHPBB')) {
    exit;
}
 
class acp_mods
{
    public $u_action;
    public $parser;
    public $mod_root = '';
    public $store_dir = '';
    public $mods_dir = '';
    public $edited_root = '';
    public $backup_root = '';
    public $sort_key = '';
    public $sort_dir = '';

	public function main($id, $mode)
	{
	    global $config, $db, $user, $auth, $template, $cache;
	    global $phpbb_root_path, $phpEx;
	    global $ftp_method, $test_ftp_connection, $test_connection, $sort_key, $sort_dir;
	 
	    include "{$phpbb_root_path}includes/functions_transfer.$phpEx";
	    include "{$phpbb_root_path}includes/editor.$phpEx";
	    include "{$phpbb_root_path}includes/functions_mods.$phpEx";
	    include "{$phpbb_root_path}includes/mod_parser.$phpEx";
	 
	    // start the page
	    $user->add_lang(['install', 'acp/mods']);
	 
	    $this->tpl_name = 'acp_mods';
	    $this->page_title = 'ACP_CAT_MODS';
	    $this->store_dir = $phpbb_root_path.'store';
	    $this->mods_dir = $phpbb_root_path.'store/mods';
	 
	    // get any url vars
	    $action = request_var('action', '');
	    $mod_id = request_var('mod_id', 0);
	    $mod_url = request_var('mod_url', '');
	    $parent = request_var('parent', 0);
	 
	    // sort keys
	    $sort_key = request_var('sk', 't');
	    $sort_dir = request_var('sd', 'a');
	 
	    $mod_path = request_var('mod_path', '');
	 
	    if ($mod_path) {
	        $mod_path = htmlspecialchars_decode($mod_path);                // "/my_mod/install.xml" or "/./contrib/blah.xml"
	        $mod_dir = substr($mod_path, 1, strpos($mod_path, '/', 1));    // "my_mod/"
	 
	        $this->mod_root = $this->mods_dir.'/'.$mod_dir;                // "./../store/mods/my_mod/"
	        $this->backup_root = "{$this->mod_root}_backups/";             // "./../store/mods/my_mod/_backups/"
	        $this->edited_root = "{$this->mod_root}_edited/";              // "./../store/mods/my_mod/_edited/"
	    }
	 
	    switch ($mode) {
	        case 'config':
				$ftp_method = request_var('ftp_method', $config['ftp_method']);
				if (!$ftp_method || !class_exists($ftp_method)) {
					$ftp_method = 'ftp';
					$transfer = new transfer();
					$ftp_methods = $transfer->methods();
				 
					if (!in_array('ftp', $ftp_methods)) {
						$ftp_method = $ftp_methods[0];
					}
				}
	 
	            if (isset($_POST['submit']) && check_form_key('acp_mods')) {
	                $ftp_host = request_var('host', '');
	                $ftp_username = request_var('username', '');
	                $ftp_password = request_var('password', ''); // not stored, used to test connection
	                $ftp_root_path = request_var('root_path', '');
	                $ftp_port = request_var('port', 21);
	                $ftp_timeout = request_var('timeout', 10);
	                $write_method = request_var('write_method', 0);
	                $file_perms = request_var('file_perms', '0644');
	                $dir_perms = request_var('dir_perms', '0755');
	                $compress_method = request_var('compress_method', '');
	                $preview_changes = request_var('preview_changes', 0);
	 
	                $error = '';
	                if (WRITE_DIRECT == $write_method) {
	                    // the very best method would be to check every file for is_writable
	                    if (!is_writable("{$phpbb_root_path}common.$phpEx") || !is_writable("{$phpbb_root_path}adm/style/acp_groups.html")) {
	                        $error = 'FILESYSTEM_NOT_WRITABLE';
	                    }
	                } elseif (WRITE_FTP == $write_method) {
	                    // check the correctness of FTP infos
	                    $test_ftp_connection = true;
	                    $test_connection = false;
	                    test_ftp_connection($ftp_method, $test_ftp_connection, $test_connection);
	 
	                    if (true !== $test_connection) {
	                        $error = $test_connection;
	                    }
	                } elseif (WRITE_MANUAL == $write_method) {
	                    // the compress class requires write access to the store/ dir
	                    if (!is_writable($this->store_dir)) {
	                        $error = 'STORE_NOT_WRITABLE';
	                    }
	                }
	 
	                if (empty($error)) {
	                    set_config('ftp_method', $ftp_method);
	                    set_config('ftp_host', $ftp_host);
	                    set_config('ftp_username', $ftp_username);
	                    set_config('ftp_root_path', $ftp_root_path);
	                    set_config('ftp_port', $ftp_port);
	                    set_config('ftp_timeout', $ftp_timeout);
	                    set_config('write_method', $write_method);
	                    set_config('compress_method', $compress_method);
	                    set_config('preview_changes', $preview_changes);
	                    set_config('am_file_perms', $file_perms);
	                    set_config('am_dir_perms', $dir_perms);
	 
	                    trigger_error($user->lang['MOD_CONFIG_UPDATED'].adm_back_link($this->u_action));
	                } else {
	                    $template->assign_var('ERROR', $user->lang[$error]);
	                }
	            } elseif (isset($_POST['submit']) && !check_form_key('acp_mods')) {
	                trigger_error($user->lang['FORM_INVALID'].adm_back_link($this->u_action), E_USER_WARNING);
	            }
	 
	            add_form_key('acp_mods');
	 
	            // implicit else
				include "{$phpbb_root_path}includes/functions_compress.$phpEx";
				 
				$compress = new compress();
				foreach ($compress->methods() as $compress_method) {
					$template->assign_block_vars('compress', [
						'METHOD' => $compress_method,
					]);
				}
	 
//	            $requested_data = call_user_func([$ftp_method, 'data']);
				$ftp_object = new ftp_fsock();
				$requested_data = $ftp_object->data();
	            foreach ($requested_data as $data => $default) {
	                $default = (!empty($config['ftp_'.$data])) ? $config['ftp_'.$data] : $default;
	                $template->assign_block_vars('data', [
	                    'DATA' => $data,
	                    'NAME' => $user->lang[strtoupper($ftp_method.'_'.$data)],
	                    'EXPLAIN' => $user->lang[strtoupper($ftp_method.'_'.$data).'_EXPLAIN'],
	                    'DEFAULT' => (!empty($_REQUEST[$data])) ? request_var($data, '') : $default,
	                ]);
	            }
	 
	            $template->assign_vars([
	                'S_CONFIG' => true,
	                'U_CONFIG' => $this->u_action.'&amp;mode=config',
	 
	                'UPLOAD_METHOD_FTP' => ('ftp' == $config['ftp_method']) ? ' checked="checked"' : '',
	                'UPLOAD_METHOD_FSOCK' => ('ftp_fsock' == $config['ftp_method']) ? ' checked="checked"' : '',
	                'WRITE_DIRECT' => (WRITE_DIRECT == $config['write_method']) ? ' checked="checked"' : '',
	                'WRITE_FTP' => (WRITE_FTP == $config['write_method']) ? ' checked="checked"' : '',
	                'WRITE_MANUAL' => (WRITE_MANUAL == $config['write_method']) ? ' checked="checked"' : '',
	 
	                'WRITE_METHOD_DIRECT' => WRITE_DIRECT,
	                'WRITE_METHOD_FTP' => WRITE_FTP,
	                'WRITE_METHOD_MANUAL' => WRITE_MANUAL,
	 
	                'AUTOMOD_VERSION' => $config['automod_version'],
	                'COMPRESS_METHOD' => $config['compress_method'],
	                'DIR_PERMS' => $config['am_dir_perms'],
	                'FILE_PERMS' => $config['am_file_perms'],
	                'PREVIEW_CHANGES_YES' => ($config['preview_changes']) ? ' checked="checked"' : '',
	                'PREVIEW_CHANGES_NO' => (!$config['preview_changes']) ? ' checked="checked"' : '',
	                'S_HIDE_FTP' => (WRITE_FTP == $config['write_method']) ? false : true,
	            ]);
	        break;
	 
	        case 'frontend':
	            if (WRITE_FTP == $config['write_method']) {
	                $ftp_method = basename(request_var('method', $config['ftp_method']));
	                if (!$ftp_method || !class_exists($ftp_method)) {
	                    $ftp_method = 'ftp';
	                    $ftp_methods = transfer::methods();
	 
	                    if (!in_array('ftp', $ftp_methods)) {
	                        $ftp_method = $ftp_methods[0];
	                    }
	                }
	 
	                $test_connection = false;
	                $test_ftp_connection = request_var('test_connection', '');
	                if (!empty($test_ftp_connection) || in_array($action, ['install', 'uninstall', 'upload_mod', 'delete_mod'])) {
	                    test_ftp_connection($ftp_method, $test_ftp_connection, $test_connection);
	 
	                    // Make sure the login details are correct before continuing
	                    if (true !== $test_connection || !empty($test_ftp_connection)) {
	                        $action = 'pre_'.$action;
	                    }
	                }
	            }
	 
	            // store/ needs to be world-writable even when FTP is the write method,
	            // for extracting uploaded mod zip files
	            if (!is_writable($this->store_dir)) {
	                $template->assign_var('S_STORE_WRITABLE_WARN', true);
	            }
	            // Otherwise, store/mods/ needs to be writable
	            elseif (WRITE_FTP != $config['write_method'] && !is_writable($this->mods_dir)) {
	                $template->assign_var('S_MODS_WRITABLE_WARN', true);
	            }
	 
	            switch ($action) {
	                case 'pre_install':
	                case 'install':
	                    $this->install($action, $mod_path, $parent);
	                break;
	 
	                case 'pre_uninstall':
	                case 'uninstall':
	                    $this->uninstall($action, $mod_id, $parent);
	                break;
	 
	                case 'details':
	                    $mod_ident = ($mod_id) ? $mod_id : $mod_path;
	                    $this->list_details($mod_ident);
	                break;
	 
	                case 'pre_delete_mod':
	                case 'delete_mod':
	                    $this->delete_mod($action, $mod_path);
	                    break;
	 
	                case 'pre_upload_mod':
	                case 'upload_mod':
	                default:
	                    $action = $action ?? '';
	                    if (!$this->upload_mod($action)) {
	                        $this->list_installed();
	                        $this->list_uninstalled();
	                    }
	                break;
	 
	                case 'download':
	                    include $phpbb_root_path."includes/functions_compress.$phpEx";
	                    $editor = new editor_manual();
	 
	                    $time = request_var('time', 0);
	 
	                    // if for some reason the MOD isn't found in the DB...
	                    $download_name = 'mod_'.$time;
	                    $sql = 'SELECT mod_name FROM '.MODS_TABLE.'
	                        WHERE mod_time = '.$time;
	                    $result = $db->sql_query($sql);
	 
	                    if ($row = $db->sql_fetchrow($result)) {
	                        // Always use the English name except for showing the user.
	                        $mod_name = localize_title($row['mod_name'], 'en');
	                        $download_name = str_replace(' ', '_', $mod_name);
	                    }
	 
	                    $editor->compress->download("{$this->store_dir}/mod_$time", $download_name);
	                    exit;
	                break;
	            }
	 
	            return;
	 
	        break;
	    }
	}

/**
	 * List all the installed mods.
	 */
	public function list_installed()
	{
	    global $db, $template, $user, $sort_key, $sort_dir;
	    $sort_by_text = ['u' => $user->lang['SORT_NAME'], 't' => $user->lang['SORT_DATE']];
	 
	    $sort = ('t' == $sort_key) ? 'mod_time' : 'mod_name';
	    $s_sort_key = $sort;
	    $dir = ('d' == $sort_dir) ? 'DESC' : 'ASC';
	    $s_sort_dir = $dir;
	    $limit_days = [];
	    $s_limit_days = $sort_days = $s_limit_days = $u_sort_param = '';
	    gen_sort_selects($limit_days, $sort_by_text, $sort_days, $sort_key, $sort_dir, $s_limit_days, $s_sort_key, $s_sort_dir, $u_sort_param);
	 
	    $template->assign_vars([
	            'S_SORT_KEY' => $s_sort_key,
	            'S_SORT_DIR' => $s_sort_dir,
	            'U_SORT_ACTION' => $this->u_action."&amp;$u_sort_param",
	    ]);
	    // The MOD name is a array so it can't be used as sort key directly.
	    $sql_sort = ('t' == $sort_key) ? " ORDER BY mod_time $dir" : '';
	    $sql = 'SELECT mod_name, mod_id, mod_time
	        FROM '.MODS_TABLE.
	        $sql_sort;
	    $result = $db->sql_query($sql);
	    $mod_ary = $db->sql_fetchrowset($result);
	    $db->sql_freeresult($result);
	 
	    foreach ($mod_ary as $key => $row) {
	        $name_ary = @unserialize($row['mod_name']);
	        if ($name_ary === false) {
	            $name_ary['en'] = $row['mod_name'];
	        }
	 
	        $mod_ary[$key]['mod_name'] = $name_ary;
	    }
	 
	    if ('t' != $sort_key) {
	        $sort_ary = [];
	        foreach ($mod_ary as $key => $row) {
	            $sort_ary[$key] = $row['mod_name']['en'];
	        }
	 
	        if ('d' == $sort_dir) {
	            arsort($sort_ary, SORT_STRING);
	        } else {
	            asort($sort_ary, SORT_STRING);
	        }
	 
	        foreach ($sort_ary as $key => $name) {
	            $sort_ary[$key] = $mod_ary[$key];
	        }
	 
	        $mod_ary = $sort_ary;
	        unset($sort_ary);
	    }
	 
	    foreach ($mod_ary as $row) {
	        $mod_name = localize_title($row['mod_name'], $user->data['user_lang']);
	        $template->assign_block_vars('installed', [
	            'MOD_ID' => $row['mod_id'],
	            'MOD_NAME' => htmlspecialchars($mod_name),
	 
	            'MOD_TIME' => $user->format_date($row['mod_time']),
	 
	            'U_DETAILS' => $this->u_action.'&amp;action=details&amp;mod_id='.$row['mod_id'],
	            'U_UNINSTALL' => $this->u_action.'&amp;action=pre_uninstall&amp;mod_id='.$row['mod_id'], ]
	        );
	    }
	 
	    return;
	}
	 
	/**
	 * List all mods available locally.
	 */
	public function list_uninstalled()
	{
	    global $phpbb_root_path, $db, $template, $config, $user;
	 
	    // get available MOD paths
	    $available_mods = $this->find_mods($this->mods_dir, 1);
	 
	    if (empty($available_mods['main'])) {
	        return;
	    }
	 
	    // get installed MOD paths
	    $installed_paths = [];
	    $sql = 'SELECT mod_path
	        FROM '.MODS_TABLE;
	    $result = $db->sql_query($sql);
	    while ($row = $db->sql_fetchrow($result)) {
	        $installed_paths[] = $row['mod_path'];
	    }
	    $db->sql_freeresult($result);
	 
	    $mod_paths = [];
	    foreach ($available_mods['main'] as $mod_info) {
	        $mod_paths[] = $mod_info['href'];
	    }
	 
	    // we don't care about any xml files not in the main directory
	    $available_mods = array_diff($mod_paths, $installed_paths);
	    unset($installed_paths);
	    unset($mod_paths);
	 
	    // show only available MODs that paths aren't in the DB
	    foreach ($available_mods as $file) {
	        $details = $this->mod_details($file, false);
	        $short_path = urlencode(str_replace($this->mods_dir, '', $details['MOD_PATH']));
	        $mod_name = localize_title($details['MOD_NAME'], $user->data['user_lang']);
	 
	        $template->assign_block_vars('uninstalled', [
	            'MOD_NAME' => htmlspecialchars($mod_name),
	            'MOD_PATH' => $short_path,
	 
	            'PHPBB_VERSION' => $details['PHPBB_VERSION'],
	            'S_PHPBB_VESION' => ($details['PHPBB_VERSION'] != $config['version']) ? true : false,
	 
	            'U_INSTALL' => $this->u_action."&amp;action=pre_install&amp;mod_path=$short_path",
	            'U_DELETE' => $this->u_action."&amp;action=pre_delete_mod&amp;mod_path=$short_path",
	            'U_DETAILS' => $this->u_action."&amp;action=details&amp;mod_path=$short_path",
	        ]);
	    }
	 
	    return;
	}

	/**
	 * Lists mod details.
	 */
	public function list_details($mod_ident)
	{
	    global $template, $config, $user;
	 
	    $template->assign_vars([
	        'S_DETAILS' => true,
	        'U_BACK' => $this->u_action,
	    ]);
	 
	    $details = $this->mod_details($mod_ident, true);
	 
	    if (!is_int($mod_ident) && $details['PHPBB_VERSION'] !== $config['version']) {
	        $version_warning = sprintf($user->lang['VERSION_WARNING'], $details['PHPBB_VERSION'], $config['version']);
	 
	        $template->assign_vars([
	            'VERSION_WARNING' => $version_warning,
	            'S_PHPBB_VERSION' => true,
	        ]);
	    }
	 
	    if (!empty($details['AUTHOR_DETAILS'])) {
	        foreach ($details['AUTHOR_DETAILS'] as $author_details) {
	            $template->assign_block_vars('author_list', $author_details);
	        }
	        unset($details['AUTHOR_DETAILS']);
	    }
	 
	    // Display Do-It-Yourself Actions...per the MODX spec,
	    // Need to handle the language later, but it's not saved for now.
	    if (!empty($details['DIY_INSTRUCTIONS'])) {
	        $template->assign_var('S_DIY', true);
	 
	        if (!is_array($details['DIY_INSTRUCTIONS'])) {
	            $details['DIY_INSTRUCTIONS'] = [$details['DIY_INSTRUCTIONS']];
	        }
	 
	        foreach ($details['DIY_INSTRUCTIONS'] as $instruction) {
	            $template->assign_block_vars('diy_instructions', [
	                'DIY_INSTRUCTION' => nl2br($instruction),
	            ]);
	        }
	    }
	 
	    if (!empty($details['MOD_HISTORY'])) {
	        $template->assign_var('S_CHANGELOG', true);
	 
	        foreach ($details['MOD_HISTORY'] as $mod_version) {
	            $template->assign_block_vars('changelog', [
	                'VERSION' => $mod_version['VERSION'],
	                'DATE' => $mod_version['DATE'],
	            ]);
	 
	            foreach ($mod_version['CHANGES'] as $changes) {
	                $template->assign_block_vars('changelog.changes', [
	                    'CHANGE' => $changes,
	                ]);
	            }
	        }
	    }
	 
	    unset($details['MOD_HISTORY']);
	 
	    $details['MOD_NAME'] = localize_title($details['MOD_NAME'], $user->data['user_lang']);
	    $details['MOD_NAME'] = htmlspecialchars($details['MOD_NAME'], ENT_QUOTES, 'UTF-8');
	 
	    $template->assign_vars($details);
	 
	    if (!empty($details['AUTHOR_NOTES'])) {
	        $template->assign_var('S_AUTHOR_NOTES', true);
	    }
	    if (!empty($details['MOD_INSTALL_TIME'])) {
	        $template->assign_var('S_INSTALL_TIME', true);
	    }
	 
	    return;
	}

	/**
	 * Returns array of mod information.
	 */
	public function mod_details($mod_ident, $find_children = true, $uninstall = false)
	{
	    global $phpbb_root_path, $phpEx, $user, $template, $parent_id;
	 
	    if (is_int($mod_ident)) {
	        global $db, $user;
	 
	        $mod_id = (int) $mod_ident;
	 
	        $sql = 'SELECT *
	            FROM '.MODS_TABLE."
	                WHERE mod_id = $mod_id";
	        $result = $db->sql_query($sql);
	        if ($row = $db->sql_fetchrow($result)) {
	            // TODO: Yuck, get rid of this.
	            $author_details = [];
	            $author_details[0] = [
	                    'AUTHOR_NAME' => $row['mod_author_name'],
	                    'AUTHOR_EMAIL' => $row['mod_author_email'],
	                    'AUTHOR_WEBSITE' => $row['mod_author_url'],
	            ];
	 
	            $actions = unserialize($row['mod_actions']);
	 
	            $details = [
	                'MOD_ID' => $row['mod_id'],
	                'MOD_PATH' => $row['mod_path'],
	                'MOD_INSTALL_TIME' => $user->format_date($row['mod_time']),
//                  'MOD_DEPENDENCIES'  => unserialize($row['mod_dependencies']), // ?
	                'MOD_NAME' => $row['mod_name'],
	                'MOD_DESCRIPTION' => nl2br($row['mod_description']),
	                'MOD_VERSION' => $row['mod_version'],
	 
	                'DIY_INSTRUCTIONS' => (!empty($actions['DIY_INSTRUCTIONS'])) ? $actions['DIY_INSTRUCTIONS'] : '',
	 
	                'AUTHOR_NOTES' => nl2br($row['mod_author_notes']),
	                'AUTHOR_DETAILS' => $author_details,
	            ];
	 
	            // This is a check for any further XML files to go with this MOD.
	            // Obviously, the files must not have been removed for this to work.
	            if (($find_children || $uninstall) && file_exists($row['mod_path'])) {
	                $parent_id = $mod_id;
	                $mod_path = $row['mod_path'];
	 
	                $actions = [];
	 
	                $mod_dir = dirname($mod_path);
	                $this->mod_root = $mod_dir.'/';
	 
	                $ext = substr(strrchr($mod_path, '.'), 1);
	                $this->parser = new parser($ext);
	                $this->parser->set_file($mod_path);
	 
	                // Find and display the available MODX files
	                $children = $this->find_children($mod_path);
	 
	                $elements = ['language' => [], 'template' => []];
	                $found_prosilver = false;
	 
	                if (!$uninstall) {
	                    $this->handle_contrib($children);
	                    $this->handle_language_prompt($children, $elements, 'details');
	                    $this->handle_template_prompt($children, $elements, 'details');
	 
	                    // Now offer to install additional templates
	                    if (isset($children['template']) && count($children['template'])) {
	                        // These are the instructions included with the MOD
	                        foreach ($children['template'] as $template_name) {
	                            if (!is_array($template_name)) {
	                                continue;
	                            }
	 
	                            if ('prosilver' == $template_name['realname']) {
	                                $found_prosilver = true;
	                            }
	 
	                            if (file_exists($this->mod_root.$template_name['href'])) {
	                                $xml_file = $template_name['href'];
	                            } else {
	                                $xml_file = str_replace($this->mods_dir, '', $mod_dir).'/'.$template_name['href'];
	                            }
	 
	                            $template->assign_block_vars('avail_templates', [
	                                'TEMPLATE_NAME' => $template_name['realname'],
	                                'XML_FILE' => urlencode($xml_file),
	                            ]);
	                        }
	                    }
	                } else {
	                    if (isset($children['uninstall']) && count($children['uninstall'])) {
	                        // Override already exising actions with the ones
	                        global $rev_actions;
	                        $xml_file = $mod_dir.'/'.ltrim($children['uninstall'][0]['href'], './');
	                        $this->parser->set_file($xml_file);
	                        $rev_actions = $this->parser->get_actions();
	                    }
	                }
	 
	                if (!$found_prosilver) {
	                    $template->assign_block_vars('avail_templates', [
	                        'TEMPLATE_NAME' => 'prosilver',
	                        'XML_FILE' => basename($mod_path),
	                    ]);
	                }
	 
	                $processed_templates = ['prosilver'];
	                $processed_templates = array_merge($processed_templates, explode(',', $row['mod_template']));
	 
	                // now grab the templates that have not already been processed
	                $sql = 'SELECT template_id, template_path FROM '.STYLES_TEMPLATE_TABLE.'
	                    WHERE '.$db->sql_in_set('template_name', $processed_templates, true);
	                $result = $db->sql_query($sql);
	 
	                while ($row = $db->sql_fetchrow($result)) {
	                    $template->assign_block_vars('board_templates', [
	                        'TEMPLATE_ID' => $row['template_id'],
	                        'TEMPLATE_NAME' => $row['template_path'],
	                    ]);
	                }
	 
	                $s_hidden_fields = build_hidden_fields([
	                    'action' => ($uninstall) ? 'uninstall' : 'pre_install',
	                    'parent' => $parent_id,
	                ]);
	 
	                $template->assign_vars([
	                    'S_FORM_ACTION' => $this->u_action,
	                    'S_HIDDEN_FIELDS' => $s_hidden_fields,
	                ]);
	 
	                add_form_key('acp_mods');
	            }
	        } else {
	            trigger_error($user->lang['NO_MOD'].adm_back_link($this->u_action), E_USER_WARNING);
	        }
	        $db->sql_freeresult($result);
	    } else {
	        $parent = request_var('parent', 0);
	        if ($parent) {
	            global $db;
	            // reset the class parameters to refelect the proper directory
	            $sql = 'SELECT mod_path FROM '.MODS_TABLE.'
	                WHERE mod_id = '.(int) $parent;
	            $result = $db->sql_query($sql);
	 
	            if ($row = $db->sql_fetchrow($result)) {
	                $this->mod_root = dirname($row['mod_path']).'/';
	            }
	        }
	 
	        if (false === strpos($mod_ident, (string) $this->mods_dir)) {
	            $mod_ident = $this->mods_dir.$mod_ident;
	        }
	 
	        if (!file_exists($mod_ident)) {
	            $mod_ident = str_replace($this->mods_dir, $this->mod_root, $mod_ident);
	        }
	 
	        $mod_path = $mod_ident;
	        $mod_parent = 0;
	 
	        $ext = substr(strrchr($mod_path, '.'), 1);
	 
	        $this->parser = new parser($ext);
	        $this->parser->set_file($mod_path);
	 
	        $details = $this->parser->get_details();
	 
	        if ($find_children) {
	            $actions = [];
	            $children = $this->find_children($mod_path);
	 
	            $elements = ['language' => [], 'template' => []];
	 
	            $this->handle_contrib($children);
	            $this->handle_language_prompt($children, $elements, 'details');
	            $this->handle_template_prompt($children, $elements, 'details');
	        }
	    }
	 
	    return $details;
	}

	/**
	 * Returns complex array of all mod actions.
	 */
	public function mod_actions($mod_ident)
	{
	    global $phpbb_root_path, $phpEx;
	 
	    if (is_int($mod_ident)) {
	        global $db, $user;
	 
	        $sql = 'SELECT mod_actions, mod_name
	            FROM '.MODS_TABLE."
	                WHERE mod_id = $mod_ident";
	        $result = $db->sql_query($sql);
	        $row = $db->sql_fetchrow($result);
	        $db->sql_freeresult($result);
	 
	        if ($row) {
	            $mod_actions = @unserialize($row['mod_actions']) ?: [];
	 
	            if (false === @unserialize($row['mod_name'])) {
	                // On version 1.0.1 and later the mod name is a serialized array.
	                // Earlier it was a string so unserialize will fail.
	                $mod_actions['EDITS'] = $this->update_edits($mod_actions['EDITS']);
	            }
	 
	            return $mod_actions;
	        } else {
	            trigger_error($user->lang['NO_MOD'].adm_back_link($this->u_action), E_USER_WARNING);
	        }
	    } else {
	        if (false === strpos($mod_ident, (string) $this->mods_dir)) {
	            $mod_ident = $this->mods_dir.$mod_ident;
	        }
	 
	        if (!file_exists($mod_ident)) {
	            $mod_ident = str_replace($this->mods_dir, $this->mod_root, $mod_ident);
	        }
	 
	        $this->parser->set_file($mod_ident);
	        $actions = $this->parser->get_actions();
	    }
	 
	    return $actions;
	}
	 
	/**
	 * Updates inline edits for MODs installed before AutoMOD 1.0.1.
	 *
	 * @param array $mod_edits, MOD actions directly from the DB
	 *
	 * @return mixed uppdated array or false on error
	 */
	public function update_edits($mod_edits)
	{
	    if (empty($mod_edits)) {
	        return false;
	    }
	 
	    $updated_ary = [];
	 
	    foreach ($mod_edits as $file => $edits) {
	        $updated_ary[$file] = [];
	        $inline = false;
	        $key = 0;
	        $old_find = $find_line = '';
	 
	        foreach ($edits as $edit) {
	            foreach ($edit as $find => $action) {
	                $first_key = key($action); // The first key contains the action or "in-line-edit".
	 
	                if ('in-line-edit' != $first_key) {
	                    if ($inline) {
	                        $updated_ary[$file][$key++][$find_line] = ['in-line-edit' => $inline_edit];
	                        $inline_edit = [];
	                        $inline = false;
	                        $old_find = $find_line = '';
	                    }
	 
	                    $updated_ary[$file][$key++][$find] = $action;
	                    $inline = false;
	                    continue;
	                }
	 
	                $inline = true;
	                $inline_edit = (empty($inline_edit)) ? [] : $inline_edit;
	 
	                if (!empty($old_find) && !$this->same_line($old_find, $find, $action['in-line-edit'])) {
	                    $updated_ary[$file][$key++][$find_line] = ['in-line-edit' => $inline_edit];
	                    $inline_edit = [];
	                }
	 
	                $find_line = $find;
	                $old_find = $find;
	                $inline_edit[] = $action['in-line-edit'];
	            }
	        }
	 
	        if ($inline && !empty($inline_edit)) {
	            $updated_ary[$file][$key++][$find_line] = ['in-line-edit' => $inline_edit];
	            $inline = false;
	            $inline_edit = [];
	            $old_find = $find_line = '';
	        }
	    }
	 
	    return $updated_ary;
	}
	 
	/**
	 * Tries to check if two inline edits are editing the same line.
	 *
	 * @param string $prev,   the find from the previous in-line-edit
	 * @param string $find,   the find for the current in-line-edit
	 * @param array  $action, the current edit array
	 *
	 * @return bool true for identical lines, otherwise false
	 */
	public function same_line($prev_find, $find, $action)
	{
	    if (empty($prev_find) || empty($find)) {
	        // If both are empty something is wrong.
	        return false;
	    }
	 
	    // The first key in $action is the in-line-find string
	    $edit_ary = reset($action);        // Array with what to do and what to remove.
	    $inline_find = key($action);    // String to find in $find.
	 
	    $add_ary = reset($edit_ary);    // $add_ary[0] contains the string to remove from $find
	    $add_str = $add_ary[0];
	    $inline_action = key($edit_ary);    // What to do.
	 
	    // The actions currently supported are in-line-before-add and in-line-after-add.
	    // replace and delete will be added later.
	    switch ($inline_action) {
	        case 'in-line-replace':
	            // There are no positions stored in the DB so we can not be sure that there
	            // is only one occasion of the string added instead of the search string.
	            // Keeping count on the previous edits still don't give a 100% guaranty that
	            // we are in the right place in the string.
	            $compare = str_replace($add_str, $inline_find, $find);
	        break;
	 
	        case 'in-line-before-add':
	            $pos = strpos($find, (string) $inline_find);
	            $len = strlen($add_str);
	            $start = $pos - $len;
	            $compare = substr_replace($find, '', $start, $len);
	        break;
	 
	        case 'in-line-after-add':
	            $pos = strpos($find, (string) $inline_find);
	            $start = $pos + strlen($inline_find);
	            $compare = substr_replace($find, '', $start, strlen($add_str));
	        break;
	 
	        case 'inline-remove':
	        default:
	            // inline-remove don't yet work to install with AutoMOD so I assume nobody
	            // is trying to remove it either in MODs installed with 1.0.0.1 or earlier.
	            return false;
	        break;
	    }
	 
	    $check = ($compare == $prev_find) ? true : false;
	 
	    return $check;
	}
	
	/**
	* Install/pre-install a mod
	* Preforms all Edits, Copies, and SQL queries.
	*/
		public function install($action, $mod_path, $parent = 0)
		{
		global $phpbb_root_path, $phpEx, $db, $template, $user, $config, $cache, $dest_template;
		global $force_install, $mod_installed;
		 
		// Are we forcing a template install?
		$dest_template = $mod_contribs = $mod_language = '';
		if (isset($_POST['template_submit'])) {
			if (!check_form_key('acp_mods')) {
				trigger_error($user->lang['FORM_INVALID'].adm_back_link($this->u_action), E_USER_WARNING);
			}
		 
			$mod_path = urldecode(request_var('source', ''));
			$dest_template = request_var('dest', '');
		 
			if (preg_match('#.*install.*xml$#i', $mod_path)) {
				$src_template = 'prosilver';
			} else {
				preg_match('#([a-z0-9]+)$#i', core_basename($mod_path), $match);
				$src_template = $match[1];
				unset($match);
			}
		}
		 
		if (empty($mod_path)) {
			return false;    // ERROR
		}
		 
		$details = $this->mod_details($mod_path, false);
		 
		if (!$parent) {
			// $details['MOD_NAME'] is a array and not knowing what language was used when the MOD was installed,
			// if it was installed with AutoMOD 1.0.0. So need to check all.
			$sql_where = '';
			foreach ($details['MOD_NAME'] as $mod_name) {
				$sql_where .= (('' == $sql_where) ? ' mod_name ' : ' OR mod_name ').$db->sql_like_expression($db->any_char.$mod_name.$db->any_char);
			}
		 
			$sql = 'SELECT mod_name FROM '.MODS_TABLE."
				WHERE $sql_where";
			$result = $db->sql_query($sql);
		 
			if ($row = $db->sql_fetchrow($result)) {
				trigger_error('AM_MOD_ALREADY_INSTALLED');
			}
		} elseif ($dest_template) { // implicit && $parent
			// Has this template already been processed?
			$sql = 'SELECT mod_name
					FROM '.MODS_TABLE."
					WHERE mod_id = $parent
						AND mod_template ".$db->sql_like_expression($db->any_char.$dest_template.$db->any_char);
			$result = $db->sql_query($sql);
		 
			if ($row = $db->sql_fetchrow($result)) {
				trigger_error('AM_MOD_ALREADY_INSTALLED');
			}
			$db->sql_freeresult($result);
		}
		// NB: There could and should be cases to check for duplicated MODs and contribs
		// However, there is not appropriate book-keeping in place for those in 1.0.x
		// grab installed contrib and language items from the database
		if ($parent) {
			$modx_type = request_var('type', '');
			if ('lang' == $modx_type) {
				$sql = 'SELECT mod_name
						FROM '.MODS_TABLE."
						WHERE mod_id = $parent
							AND mod_languages ".$db->sql_like_expression($db->any_char.$mod_path.$db->any_char);
				$result = $db->sql_query($sql);
		 
				if ($row = $db->sql_fetchrow($result)) {
					trigger_error('AM_MOD_ALREADY_INSTALLED');
				} else {
					$mod_language = $mod_path;
				}
				$db->sql_freeresult($result);
			} elseif ('contrib' == $modx_type) {
				$sql = 'SELECT mod_name
						FROM '.MODS_TABLE."
						WHERE mod_id = $parent
							AND mod_contribs ".$db->sql_like_expression($db->any_char.$mod_path.$db->any_char);
				$result = $db->sql_query($sql);
		 
				if ($row = $db->sql_fetchrow($result)) {
					trigger_error('AM_MOD_ALREADY_INSTALLED');
				} else {
					$mod_contribs = $mod_path;
				}
				$db->sql_freeresult($result);
			}
		}
		 
		$execute_edits = ('pre_install' == $action) ? false : true;
		$write_method = 'editor_'.determine_write_method(!$execute_edits);
		$editor = new $write_method();
		 
		// get FTP information if we need it (or initialize array $hidden_ary)
		$hidden_ary = get_connection_info(!$execute_edits);
		 
		$actions = $this->mod_actions($mod_path);
		 
		if ($dest_template) {
			$sql = 'SELECT template_inherit_path FROM '.STYLES_TEMPLATE_TABLE."
				WHERE template_path = '".$db->sql_escape($dest_template)."'";
			$result = $db->sql_query($sql);
		 
			global $dest_inherits;
			$dest_inherits = '';
			if ($row = $db->sql_fetchrow($result)) {
				$dest_inherits = $row['template_inherit_path'];
			}
			$db->sql_freeresult($result);
		 
			if (!empty($actions['EDITS'])) {
				foreach ($actions['EDITS'] as $file => $edits) {
					if (false === strpos($file, 'styles/')) {
						unset($actions['EDITS'][$file]);
					} elseif ($src_template != $dest_template) {
						$file_new = str_replace($src_template, $dest_template, $file);
						$actions['EDITS'][$file_new] = $edits;
						unset($actions['EDITS'][$file]);
					}
				}
			}
		 
			if (!empty($actions['NEW_FILES'])) {
				foreach ($actions['NEW_FILES'] as $src_file => $dest_file) {
					if (false === strpos($src_file, 'styles/')) {
						unset($actions['NEW_FILES']);
					} else {
						$actions['NEW_FILES'][$src_file] = str_replace($src_template, $dest_template, $dest_file);
					}
				}
			}
		}
		 
		// only supporting one level of hierarchy here
		if (!$parent) {
			// check for "child" MODX files and attempt to decide which ones we need
			$children = $this->find_children($mod_path);
		 
			$elements = ['language' => [], 'template' => []];
		 
			if ($execute_edits) {
				global $mode;
				$this->handle_dependency($children, $mode, $mod_path);
			}
			$this->handle_language_prompt($children, $elements, $action);
			$this->handle_merge('language', $actions, $children, $elements['language']);
			$this->handle_template_prompt($children, $elements, $action);
			$this->handle_merge('template', $actions, $children, $elements['template']);
		} else {
			if ($dest_template) {
				$elements['template'] = [$dest_template];
			} elseif ($mod_language) {
				$elements['language'] = [$mod_path];
			} else {
				$elements['contrib'] = [$mod_path];
			}
		}
		 
		$template->assign_vars([
			'S_INSTALL' => $execute_edits,
			'S_PRE_INSTALL' => !$execute_edits,
			'MOD_PATH' => str_replace($this->mod_root, '', $mod_path),
			'U_INSTALL' => $this->u_action.'&amp;action=install'.($parent ? "&amp;parent=$parent" : ''),
			'U_RETURN' => $this->u_action,
			'U_BACK' => $this->u_action,
		]);
		 
		if ($execute_edits) {
			$editor->create_edited_root($this->edited_root);
			$force_install = request_var('force', false);
		}
		 
		$display = ($execute_edits || $config['preview_changes']) ? true : false;
		 
		// process the actions
		$mod_installed = $this->process_edits($editor, $actions, $details, $execute_edits, $display, false);
		 
		if (!$execute_edits) {
			$s_hidden_fields = ['dependency_confirm' => !empty($_REQUEST['dependency_confirm'])];
		 
			if ($dest_template) {
				$s_hidden_fields['dest'] = $dest_template;
				$s_hidden_fields['source'] = $mod_path;
				$s_hidden_fields['template_submit'] = true;
			}
		 
			if ($parent) {
				$s_hidden_fields['type'] = $modx_type;
			}
		 
			$template->assign_var('S_HIDDEN_FIELDS', build_hidden_fields($s_hidden_fields));
			add_form_key('acp_mods');
		 
			return;
		} // end pre_install
		 
		// Display Do-It-Yourself Actions...per the MODX spec, these should be displayed last
		if (!empty($actions['DIY_INSTRUCTIONS'])) {
			$template->assign_var('S_DIY', true);
		 
			if (!is_array($actions['DIY_INSTRUCTIONS'])) {
				$actions['DIY_INSTRUCTIONS'] = [$actions['DIY_INSTRUCTIONS']];
			}
		 
			foreach ($actions['DIY_INSTRUCTIONS'] as $instruction) {
				$template->assign_block_vars('diy_instructions', [
					'DIY_INSTRUCTION' => nl2br($instruction),
				]);
			}
		}
		 
		if (!empty($actions['PHP_INSTALLER'])) {
			$template->assign_vars([
				'U_PHP_INSTALLER' => $phpbb_root_path.$actions['PHP_INSTALLER'],
			]);
		}
		 
		if ($mod_installed || $force_install) {
			// Move edited files back
			$status = $editor->commit_changes($this->edited_root, '');
		 
			if (is_string($status)) {
				$mod_installed = false;
		 
				$template->assign_block_vars('error', [
					'ERROR' => $status,
				]);
			}
		}
		 
		// The editor class provides more pertinent information regarding edits
		// so we store that as the canonical version, used for uninstalling
		$actions['EDITS'] = $editor->mod_actions;
		$editor->clear_actions();
		 
		// if MOD installed successfully, make a record.
		if (($mod_installed || $force_install) && !$parent) {
			$mod_name = (is_array($details['MOD_NAME'])) ? serialize($details['MOD_NAME']) : $details['MOD_NAME'];
		 
			// Insert database data
			$sql = 'INSERT INTO '.MODS_TABLE.' '.$db->sql_build_array('INSERT', [
				'mod_time' => (int) $editor->install_time,
				// @todo: Are dependencies part of the MODX Spec?
				'mod_dependencies' => '', // (string) serialize($details['MOD_DEPENDENCIES']),
				'mod_name' => (string) $mod_name,
				'mod_description' => (string) $details['MOD_DESCRIPTION'],
				'mod_version' => (string) $details['MOD_VERSION'],
				'mod_path' => (string) $details['MOD_PATH'],
				'mod_author_notes' => (string) $details['AUTHOR_NOTES'],
				'mod_author_name' => (string) $details['AUTHOR_DETAILS'][0]['AUTHOR_NAME'],
				'mod_author_email' => (string) $details['AUTHOR_DETAILS'][0]['AUTHOR_EMAIL'],
				'mod_author_url' => (string) $details['AUTHOR_DETAILS'][0]['AUTHOR_WEBSITE'],
				'mod_actions' => (string) serialize($actions),
				'mod_languages' => (string) (isset($elements['language']) && count($elements['language'])) ? implode(',', $elements['language']) : '',
				'mod_template' => (string) (isset($elements['template']) && count($elements['template'])) ? implode(',', $elements['template']) : '',
				'mod_contribs' => (string) (isset($elements['contrib']) && count($elements['contrib'])) ? implode(',', $elements['contrib']) : '',
			]);
			$db->sql_query($sql);
		 
			$cache->purge();
		 
			// Add log
			$mod_name = localize_title($details['MOD_NAME'], 'en');
			add_log('admin', 'LOG_MOD_ADD', $mod_name);
		}
		// in this case, we are installing an additional template or language
		elseif (($mod_installed || $force_install) && $parent) {
			$sql = 'SELECT * FROM '.MODS_TABLE." WHERE mod_id = $parent";
			$result = $db->sql_query($sql);
		 
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
		 
			if (!$row) {
				trigger_error($user->lang['NO_MOD'].adm_back_link($this->u_action));
			}
		 
			$sql_ary = [
				'mod_version' => $details['MOD_VERSION'],
			];
		 
			if (!empty($elements['language'])) {
				$sql_ary['mod_languages'] = (!empty($row['mod_languages'])) ? $row['mod_languages'].',' : '';
				$sql_ary['mod_languages'] .= implode(',', $elements['language']);
			} else {
				$sql_ary['mod_languages'] = $row['mod_languages'];
			}
		 
			if (!empty($elements['template'])) {
				$sql_ary['mod_template'] = $row['mod_template'].','.implode(',', $elements['template']);
			} else {
				$sql_ary['mod_template'] = $row['mod_template'];
			}
		 
			if (!empty($elements['contrib'])) {
				$sql_ary['mod_contribs'] = (!empty($row['mod_contribs'])) ? $row['mod_contribs'].',' : '';
				$sql_ary['mod_contribs'] .= implode(',', $elements['contrib']);
			} else {
				$sql_ary['mod_contribs'] = $row['mod_contribs'];
			}
		 
			$sql_ary['mod_time'] = $editor->install_time;
		 
			$prior_mod_actions = unserialize($row['mod_actions']);
			$sql_ary['mod_actions'] = serialize(array_merge_recursive($prior_mod_actions, $actions));
			unset($prior_mod_actions);
		 
			$sql = 'UPDATE '.MODS_TABLE.' SET '.$db->sql_build_array('UPDATE', $sql_ary)."
				WHERE mod_id = $parent";
			$db->sql_query($sql);
		 
			add_log('admin', 'LOG_MOD_CHANGE', htmlspecialchars_decode($row['mod_name']));
		}
		// there was an error we need to tell the user about
		else {
			add_form_key('acp_mods');
		 
			if ($parent) {
				$hidden_ary['parent'] = $parent;
			}
		 
			if ($dest_template) {
				$hidden_ary['dest'] = $dest_template;
				$hidden_ary['source'] = $mod_path;
				$hidden_ary['template_submit'] = true;
			}
		 
			if ($mod_language || $mod_contribs
		) {
				$hidden_ary['type'] = $modx_type;
			}
		 
			$template->assign_vars([
				'S_ERROR' => true,
				'S_HIDDEN_FIELDS' => build_hidden_fields($hidden_ary),
				'U_RETRY' => $this->u_action.'&amp;action=install&amp;mod_path='.$mod_path,
			]);
		}
		 
		// if we forced the install of the MOD, we need to let the user know their board could be broken
		if ($force_install) {
			$template->assign_var('S_FORCE', true);
		}
		 
		if ($mod_installed || $force_install) {
			// $editor->commit_changes_final don't do anything ATM, but to be compatible with future versions
			$mod_name = localize_title($details['MOD_NAME'], 'en');
			$editor->commit_changes_final('mod_'.$editor->install_time, str_replace(' ', '_', $mod_name));
		}
	}
		 
	/**
	 * Uninstall/pre uninstall a mod.
	 */
	public function uninstall($action, $mod_id, $parent)
	{
		global $phpbb_root_path, $phpEx, $db, $template, $user, $config;
		global $force_install, $mod_uninstalled;
		 
		if (!$mod_id && !$parent) {
			return false;    // ERROR
		}
		 
		// the MOD is more important than additional MODx files
		if ($parent == $mod_id) {
			$parent = 0;
		}
		 
		if ($parent) {
			// grab installed contrib and language items from the database
			$sql = 'SELECT mod_languages, mod_contribs
					FROM '.MODS_TABLE."
					WHERE mod_id = $parent";
			$result = $db->sql_query($sql);
		 
			if ($row = $db->sql_fetchrow($result)) {
				$mod_path = request_var('mod_path', '');
				if (in_array($mod_path, explode(',', $row['mod_languages']))) {
					$elements['languages'] = $mod_path;
				} elseif (in_array($mod_path, explode(',', $row['mod_contribs']))) {
					$elements['contrib'] = $mod_path;
				} else {
					trigger_error('AM_MOD_NOT_INSTALLED');
				}
			} else {
				return false;
			}
		}
		 
		// set the class parameters to reflect the proper directory
		$sql = 'SELECT mod_path FROM '.MODS_TABLE.'
			WHERE mod_id = '.(($mod_id) ? $mod_id : $parent);
		$result = $db->sql_query($sql);
		 
		if ($row = $db->sql_fetchrow($result)) {
			$this->mod_root = dirname($row['mod_path']).'/';
			$this->edited_root = "{$this->mod_root}_edited/";
		} else {
			return false;    // ERROR
		}
		 
		$execute_edits = ('pre_uninstall' == $action) ? false : true;
		$write_method = 'editor_'.determine_write_method(!$execute_edits);
		$editor = new $write_method();
		 
		// get FTP information if we need it (or initialize array $hidden_ary)
		$hidden_ary = get_connection_info(!$execute_edits);
		 
		if ($parent) {
			$hidden_ary['parent'] = $parent;
			$hidden_ary['mod_path'] = $mod_path;
		}
		 
		$template->assign_vars([
			'S_UNINSTALL' => $execute_edits,
			'S_PRE_UNINSTALL' => !$execute_edits,
			'L_FORCE_INSTALL' => $user->lang['FORCE_UNINSTALL'],
			'MOD_ID' => $mod_id,
			'U_UNINSTALL' => ($parent) ? $this->u_action."&amp;action=uninstall&amp;parent=$parent&mod_path=$mod_path" : $this->u_action.'&amp;action=uninstall&amp;mod_id='.$mod_id,
			'U_RETURN' => $this->u_action,
			'U_BACK' => $this->u_action,
			'S_HIDDEN_FIELDS' => build_hidden_fields($hidden_ary),
		]);
		 
		// grab actions and details
		if (!$parent) {
			$details = $this->mod_details($mod_id, false, true);
			$actions = $this->mod_actions($mod_id);
		} else {
			$details = $this->mod_details($mod_path, false);
			$actions = $this->mod_actions($mod_path);
		}
		 
		if ($execute_edits) {
			$editor->create_edited_root($this->edited_root);
			$force_install = $force_uninstall = request_var('force', false);
		}
		 
		$display = ($execute_edits || $config['preview_changes']) ? true : false;
		 
		// cleanup edits if we forced the install on a contrib or language
		if ($parent) {
			if (isset($actions['EDITS'])) {
				foreach ($actions['EDITS'] as $file => $edit_ary) {
					foreach ($edit_ary as $edit_id => $edit) {
						foreach ($edit as $find => $action_ary) {
							if (empty($action_ary)) {
								unset($actions['EDITS'][$file][$edit_id][$find]);
							}
						}
					}
				}
			}
		}
		 
		// process the actions
		$mod_uninstalled = $this->process_edits($editor, $actions, $details, $execute_edits, $display, true);
		 
		if (!$execute_edits) {
			return;
		} // end pre_uninstall
		 
		if (($mod_uninstalled || $force_uninstall) && !$parent) {
			// Move edited files back
			$status = $editor->commit_changes($this->edited_root, '');
		 
			if (is_string($status)) {
				$mod_uninstalled = false;
		 
				$template->assign_block_vars('error', [
					'ERROR' => $status,
				]);
			}
		} elseif (($mod_uninstalled || $force_uninstall) && $parent) {
			// Only update the database entries and don't move any files back
			$sql = 'SELECT * FROM '.MODS_TABLE." WHERE mod_id = $parent";
			$result = $db->sql_query($sql);
		 
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
		 
			if (!$row) {
				trigger_error($user->lang['NO_MOD'].adm_back_link($this->u_action));
			}
		 
			$sql_ary = [
				'mod_version' => $details['MOD_VERSION'],
			];
		 
			if (!empty($elements['languages'])) {
				$sql_ary['mod_languages'] = explode(',', $row['mod_languages']);
				foreach ($sql_ary['mod_languages'] as $key => $value) {
					if ($value != $elements['languages']);
		 
					unset($sql_ary['mod_languages'][$key]);
				}
				$sql_ary['mod_languages'] = implode(',', $sql_ary['mod_languages']);
			} else {
				$sql_ary['mod_languages'] = $row['mod_languages'];
			}
		 
			// let's just not support uninstalling styles edits
			$sql_ary['mod_template'] = $row['mod_template'];
		 
			if (!empty($elements['contrib'])) {
				$sql_ary['mod_contribs'] = explode(',', $row['mod_contribs']);
				foreach ($sql_ary['mod_contribs'] as $key => $value) {
					if ($value != $elements['contrib']);
		 
					unset($sql_ary['mod_contribs'][$key]);
				}
				$sql_ary['mod_contribs'] = implode(',', $sql_ary['mod_contribs']);
			} else {
				$sql_ary['mod_contribs'] = $row['mod_contribs'];
			}
		 
			$sql_ary['mod_time'] = $row['mod_time'];
		 
			// $prior_mod_actions = unserialize($row['mod_actions']);
			// $sql_ary['mod_actions'] = serialize(array_merge_recursive($prior_mod_actions, $actions));
			$sql_ary['mod_actions'] = $row['mod_actions'];
			// unset($prior_mod_actions);
		 
			$sql = 'UPDATE '.MODS_TABLE.' SET '.$db->sql_build_array('UPDATE', $sql_ary)."
				WHERE mod_id = $parent";
			$db->sql_query($sql);
		 
			$mod_name = localize_title($row['mod_name'], $user->data['user_lang']);
			add_log('admin', 'LOG_MOD_CHANGE', htmlspecialchars_decode($mod_name));
		}
		 
		// if we forced uninstall of the MOD, we need to let the user know their board could be broken
		if ($force_uninstall) {
			$template->assign_var('S_FORCE', true);
		} elseif (!$mod_uninstalled) {
			add_form_key('acp_mods');
		 
			$template->assign_vars([
				'S_ERROR' => true,
				'S_HIDDEN_FIELDS' => build_hidden_fields($hidden_ary),
				'U_RETRY' => $this->u_action.'&amp;action=uninstall&amp;mod_id='.$mod_id,
			]);
		}
		 
		if ($mod_uninstalled || $force_uninstall) {
			// Delete from DB
			$sql = 'DELETE FROM '.MODS_TABLE.'
				WHERE mod_id = '.$mod_id;
			$db->sql_query($sql);
		 
			// Add log
			$mod_name = localize_title($details['MOD_NAME'], 'en');
			$mod_name = htmlspecialchars_decode($mod_name);
			add_log('admin', 'LOG_MOD_REMOVE', $mod_name);
		 
			$mod_name = localize_title($details['MOD_NAME'], 'en');
			$editor->commit_changes_final('mod_'.$editor->install_time, str_replace(' ', '_', $mod_name));
		}
	}

	/**
	 * Returns array of available mod install files in dir (Recursive).
	 *
	 * @param $dir string - dir to search
	 * @param $recurse int - number of levels to recurse
	 * @return array
	 */
	public function find_mods($dir, $recurse = false)
	{
	    global $user;
	 
	    if (false === $recurse) {
	        $mods = ['main' => [], 'contrib' => [], 'template' => [], 'language' => []];
	        $recurse = 0;
	    } else {
	        static $mods = ['main' => [], 'contrib' => [], 'template' => [], 'language' => []];
	    }
	 
	    // ltrim shouldn't be needed, but some users had problems.  See #44305
	    $dir = ltrim($dir, '/');
	 
	    if (!file_exists($dir)) {
	        return [];
	    }
	 
	    if (!is_readable($dir)) {
	        trigger_error(sprintf($user->lang['NEED_READ_PERMISSIONS'], $dir), E_USER_WARNING);
	    }
	 
	    $files = scandir($dir);
	    foreach ($files as $file) {
	        if ('.' !== $file[0] && false === strpos("$dir/$file", '_edited') && false === strpos("$dir/$file", '_backups')) {
	            // recurse - we don't want anything within the MODX "root" though
	            if ($recurse && !is_file("$dir/$file") && false === strpos("$dir/$file", 'root')) {
	                $mods = array_merge_recursive($mods, $this->find_mods("$dir/$file", $recurse - 1));
	            }
	            // this might be better as an str function, especially being in a loop
	            elseif (preg_match('#.*install.*xml$#i', $file) || (preg_match('#(contrib|templates|languages)#i', $dir, $match)) || (0 === $recurse && false !== strpos($file, '.xml'))) {
	                // if this is an "extra" MODX file, make a record of it as such
	                // we are assuming the MOD follows MODX packaging standards here
	                if (false !== strpos($file, '.xml') && preg_match('#(contrib|templates|languages)#i', $dir, $match)) {
	                    // Get rid of the S.  This is a side effect of understanding
	                    // MODX 1.0.x and 1.2.x.
	                    $match[1] = rtrim($match[1], 's');
	 
	                    $mods[$match[1]][] = [
	                        'href' => "$dir/$file",
	                        'realname' => basename($file),
	                        'title' => basename($file),
	                    ];
	                } else {
	                    $check = end($mods['main']);
	                    $check = $check['href'] ?? '';
	 
	                    // we take the first file alphabetically with install in the filename
	                    if (!$check || dirname($check) == $dir) {
	                        if (preg_match('#.*install.*xml$#i', $file) && preg_match('#.*install.*xml$#i', $check) && strnatcasecmp(basename($check), $file) > 0) {
	                            $index = max(0, count($mods['main']) - 1);
	                            $mods['main'][$index] = [
	                                'href' => "$dir/$file",
	                                'realname' => basename($file),
	                                'title' => basename($file),
	                            ];
	 
	                            break;
	                        } elseif (preg_match('#.*install.*xml$#i', $file) && !preg_match('#.*install.*xml$#i', $check)) {
	                            $index = max(0, count($mods['main']) - 1);
	                            $mods['main'][$index] = [
	                                'href' => "$dir/$file",
	                                'realname' => basename($file),
	                                'title' => basename($file),
	                            ];
	 
	                            break;
	                        }
	                    } else {
	                        if (false !== strpos($file, '.xml')) {
	                            $mods['main'][] = [
	                                'href' => "$dir/$file",
	                                'realname' => basename($file),
	                                'title' => basename($file),
	                            ];
	                        }
	                    }
	                }
	            }
	        }
	    }
	 
	    return $mods;
	}

	public function process_edits($editor, $actions, $details, $change = false, $display = true, $reverse = false)
	{
	    global $template, $user, $db, $phpbb_root_path, $force_install, $mod_installed;
	    global $dest_inherits, $dest_template, $children, $config;
	 
	    $mod_installed = true;
	 
	    if ($reverse) {
	        global $rev_actions;
	 
	        if (empty($rev_actions)) {
	            // maybe should allow for potential extensions here
	            $actions = parser::reverse_edits($actions);
	        } else {
	            $actions = $rev_actions;
	            unset($rev_actions);
	        }
	    }
	 
	    $template->assign_vars([
	        'S_DISPLAY_DETAILS' => (bool) $display,
	        'S_CHANGE_FILES' => (bool) $change,
	    ]);
	 
	    if (!empty($details['PHPBB_VERSION']) && $details['PHPBB_VERSION'] != $config['version']) {
	        $version_warning = sprintf($user->lang['VERSION_WARNING'], $details['PHPBB_VERSION'], $config['version']);
	 
	        $template->assign_vars([
	            'VERSION_WARNING' => $version_warning,
	            'S_PHPBB_VERSION' => true,
	        ]);
	    }
	 
	    if (!empty($details['AUTHOR_NOTES']) && $details['AUTHOR_NOTES'] != $user->lang['UNKNOWN_MOD_AUTHOR-NOTES']) {
	        $template->assign_vars([
	            'S_AUTHOR_NOTES' => true,
	 
	            'AUTHOR_NOTES' => nl2br($details['AUTHOR_NOTES']),
	        ]);
	    }
	 
	    // not all MODs will have edits (!)
	    if (isset($actions['EDITS'])) {
	        $template->assign_var('S_EDITS', true);
	 
	        foreach ($actions['EDITS'] as $filename => $edits) {
	            // see if the file to be opened actually exists
	            if (!file_exists("$phpbb_root_path$filename")) {
	                $is_inherit = (false !== strpos($filename, 'styles/') && !empty($dest_inherits)) ? true : false;
	 
	                $template->assign_block_vars('edit_files', [
	                    'S_MISSING_FILE' => ($is_inherit) ? false : true,
	                    'INHERIT_MSG' => ($is_inherit) ? sprintf($user->lang['INHERIT_NO_CHANGE'], $dest_template, $dest_inherits) : '',
	                    'FILENAME' => $filename,
	                ]);
	 
	                $mod_installed = ($is_inherit) ? $mod_installed : false;
	 
	                continue;
	            } else {
	                $template->assign_block_vars('edit_files', [
	                    'S_SUCCESS' => false,
	                    'FILENAME' => $filename,
	                ]);
	 
	                // If installing - not pre_install nor (pre_)uninstall, backup the file
	                // This is to make sure it works with editor_ftp because write_method is
	                // forced to direct when in preview modes, and ignored in editor_manual!
	                if ($change && !$reverse) {
	                    $status = $editor->open_file($filename, $this->backup_root);
	                } else {
	                    $status = $editor->open_file($filename);
	                }
	 
	                if (is_string($status)) {
	                    $template->assign_block_vars('error', [
	                        'ERROR' => $status,
	                    ]);
	 
	                    $mod_installed = false;
	                    continue;
	                }
	 
	                $edit_success = true;
	 
	                foreach ($edits as $finds) {
	                    $comment = '';
	                    foreach ($finds as $find => $commands) {
	                        if (isset($finds['comment']) && !$comment && $finds['comment'] != $user->lang['UNKNOWN_MOD_COMMENT']) {
	                            $comment = $finds['comment'];
	                            unset($finds['comment']);
	                        }
	 
	                        if ('comment' == $find) {
	                            continue;
	                        }
	 
	                        $find_tpl = [
	                            'FIND_STRING' => htmlspecialchars($find),
	                            'COMMENT' => htmlspecialchars($comment),
	                        ];
	 
	                        $offset_ary = $editor->find($find);
	 
	                        // special case for FINDs with no action associated
	                        if (is_null($commands)) {
	                            continue;
	                        }
	 
	                        foreach ($commands as $type => $contents) {
	                            if (!$offset_ary) {
	                                $offset_ary['start'] = $offset_ary['end'] = false;
	                            }
	 
	                            $status = false;
	                            $inline_template_ary = [];
	                            $contents_orig = $contents;
	 
	                            switch (strtoupper($type)) {
	                                case 'AFTER ADD':
	                                    $status = $editor->add_string($find, $contents, 'AFTER', $offset_ary['start'], $offset_ary['end']);
	                                break;
	 
	                                case 'BEFORE ADD':
	                                    $status = $editor->add_string($find, $contents, 'BEFORE', $offset_ary['start'], $offset_ary['end']);
	                                break;
	 
	                                case 'INCREMENT':
	                                case 'OPERATION':
	                                    // $contents = "";
	                                    $status = $editor->inc_string($find, '', $contents);
	                                break;
	 
	                                case 'REPLACE WITH':
	                                    $status = $editor->replace_string($find, $contents, $offset_ary['start'], $offset_ary['end']);
	                                break;
	 
	                                case 'IN-LINE-EDIT':
	                                    // these aren't quite as straight forward.  Still have multi-level arrays to sort through
	                                    $inline_comment = '';
	                                    foreach ($contents as $inline_edit_id => $inline_edit) {
	                                        if ('inline-comment' === $inline_edit_id) {
	                                            // This is a special case for tucking comments in the array
	                                            if ($inline_edit != $user->lang['UNKNOWN_MOD_INLINE-COMMENT']) {
	                                                $inline_comment = $inline_edit;
	                                            }
	                                            continue;
	                                        }
	 
	                                        foreach ($inline_edit as $inline_find => $inline_commands) {
	                                            foreach ($inline_commands as $inline_action => $inline_contents) {
	                                                // inline finds are pretty cantankerous, so do them in the loop
	                                                $line = $editor->inline_find($find, $inline_find, $offset_ary['start'], $offset_ary['end']);
	                                                if (!$line) {
	                                                    // find failed
	                                                    $status = $mod_installed = false;
	 
	                                                    $inline_template_ary[] = [
	                                                        'FIND' => [
	                                                            'S_SUCCESS' => $status,
	 
	                                                            'NAME' => $user->lang[$type],
	                                                            'COMMAND' => htmlspecialchars($inline_find),
	                                                        ],
	                                                        'ACTION' => [], ];
	 
	                                                    continue 2;
	                                                }
	 
	                                                $inline_contents = $inline_contents[0];
	                                                $contents_orig = $inline_find;
	 
	                                                switch (strtoupper($inline_action)) {
	                                                    case 'IN-LINE-':
	                                                        $editor->last_string_offset = $line['string_offset'] + $line['find_length'] - 1;
	                                                        $status = true;
	                                                        continue 2;
	                                                    break;
	 
	                                                    case 'IN-LINE-BEFORE-ADD':
	                                                        $status = $editor->inline_add($find, $inline_find, $inline_contents, 'BEFORE', $line['array_offset'], $line['string_offset'], $line['find_length']);
	                                                    break;
	 
	                                                    case 'IN-LINE-AFTER-ADD':
	                                                        $status = $editor->inline_add($find, $inline_find, $inline_contents, 'AFTER', $line['array_offset'], $line['string_offset'], $line['find_length']);
	                                                    break;
	 
	                                                    case 'IN-LINE-REPLACE':
	                                                    case 'IN-LINE-REPLACE-WITH':
	                                                        $status = $editor->inline_replace($find, $inline_find, $inline_contents, $line['array_offset'], $line['string_offset'], $line['find_length']);
	                                                    break;
	 
	                                                    case 'IN-LINE-OPERATION':
	                                                        $status = $editor->inc_string($find, $inline_find, $inline_contents);
	                                                    break;
	 
	                                                    default:
	                                                        $message = sprintf($user->lang['UNRECOGNISED_COMMAND'], $inline_action);
	                                                        trigger_error($message, E_USER_WARNING); // ERROR!
	                                                    break;
	                                                }
	 
	                                                $inline_template_ary[] = [
	                                                    'FIND' => [
	                                                        'S_SUCCESS' => $status,
	 
	                                                        'NAME' => $user->lang[$type],
	                                                        'COMMAND' => (is_array($contents_orig)) ? $user->lang['INVALID_MOD_INSTRUCTION'] : htmlspecialchars($contents_orig),
	                                                    ],
	 
	                                                    'ACTION' => [
	                                                        'S_SUCCESS' => $status,
	 
	                                                        'NAME' => $user->lang[$inline_action],
	                                                        'COMMAND' => (is_array($inline_contents)) ? $user->lang['INVALID_MOD_INSTRUCTION'] : htmlspecialchars($inline_contents),
	                                        //                'COMMENT'   => $inline_comment, (inline comments aren't actually part of the MODX spec)
	                                                    ],
	                                                ];
	                                            }
	 
	                                            if (!$status) {
	                                                $mod_installed = false;
	                                            }
	 
	                                            $editor->close_inline_edit();
	                                        }
	                                    }
	                                break;
	 
	                                default:
	                                    $message = sprintf($user->lang['UNRECOGNISED_COMMAND'], $type);
	                                    trigger_error($message, E_USER_WARNING); // ERROR!
	                                break;
	                            }
	 
	                            $template->assign_block_vars('edit_files.finds', array_merge($find_tpl, [
	                                'S_SUCCESS' => $status,
	                            ]));
	 
	                            if (!$status) {
	                                $edit_success = false;
	                                $mod_installed = false;
	                            }
	 
	                            if (count($inline_template_ary)) {
	                                foreach ($inline_template_ary as $inline_template) {
	                                    // We must assign the vars for the FIND first
	                                    $template->assign_block_vars('edit_files.finds.actions', $inline_template['FIND']);
	 
	                                    // And now the vars for the ACTION
	                                    $template->assign_block_vars('edit_files.finds.actions.inline', $inline_template['ACTION']);
	                                }
	                                $inline_template_ary = [];
	                            } elseif (!is_array($contents_orig)) {
	                                $template->assign_block_vars('edit_files.finds.actions', [
	                                    'S_SUCCESS' => $status,
	 
	                                    'NAME' => $user->lang[$type],
	                                    'COMMAND' => htmlspecialchars($contents_orig),
	                                ]);
	                            }
	                        }
	                    }
	 
	                    $editor->close_edit();
	                }
	 
	                $template->alter_block_array('edit_files', [
	                    'S_SUCCESS' => $edit_success,
	                ], true, 'change');
	            }
	 
	            if ($change) {
	                $status = $editor->close_file("{$this->edited_root}$filename");
	                if (is_string($status)) {
	                    $template->assign_block_vars('error', [
	                        'ERROR' => $status,
	                    ]);
	 
	                    $mod_installed = false;
	                }
	            }
	        }
	    } // end foreach
	 
	    // Move included files
	    if (isset($actions['NEW_FILES']) && !empty($actions['NEW_FILES'])) {
	        $template->assign_var('S_NEW_FILES', true);
	 
	        // Because foreach operates on a copy of the specified array and not the array itself,
	        // we cannot rely on the array pointer while using it, so we use a while loop w/ each()
	        // We need array pointer to rewind the loop when is_array($target) (See Ticket #62341)
	        foreach ($actions['NEW_FILES'] as $source => $target) {
	            if (is_array($target)) {
	                // If we've shifted off all targets, we're done w/ that element
	                if (empty($target)) {
	                    continue;
	                }
	 
	                // Shift off first target, then rewind array pointer to get next target
	                $target = array_shift($actions['NEW_FILES'][$source]);
	                prev($actions['NEW_FILES']);
	            }
	            if ($change && ($mod_installed || $force_install)) {
	                $status = $editor->copy_content($this->mod_root.str_replace('*.*', '', $source), str_replace('*.*', '', $target));
	 
	                if (true !== $status && !is_null($status)) {
	                    $mod_installed = false;
	                }
	 
	                $template->assign_block_vars('new_files', [
	                    'S_SUCCESS' => (true === $status) ? true : false,
	                    'S_NO_COPY_ATTEMPT' => (is_null($status)) ? true : false,
	                    'SOURCE' => $source,
	                    'TARGET' => $target,
	                ]);
	            } elseif ($display && !$change) {
	                $template->assign_block_vars('new_files', [
	                    'SOURCE' => $source,
	                    'TARGET' => $target,
	                ]);
	            }
	            // To avoid "error" on install page when being asked to force install
	            elseif ($change && $display && !$mod_installed && !$force_install) {
	                $template->assign_block_vars('new_files', [
	                    'S_NO_COPY_ATTEMPT' => true,
	                    'FILENAME' => $target,
	                ]);
	            }
	        }
	    }
	 
	    // Delete (or reverse-delete) installed files
	    if (!empty($actions['DELETE_FILES'])) {
	        $template->assign_var('S_REMOVING_FILES', true);
	 
	        // Dealing with a reverse-delete, must heed to the dangers ahead!
	        if ($reverse) {
	            $directories = [];
	            $directories['src'] = [];
	            $directories['dst'] = [];
	            $directories['del'] = [];
	 
	            // Because foreach operates on a copy of the specified array and not the array itself,
	            // we cannot rely on the array pointer while using it, so we use a while loop w/ each()
	            // We need array pointer to rewind the loop when is_array($target) (See Ticket #62341)
	            foreach ($actions['DELETE_FILES'] as $source => $target) {
	                if (is_array($target)) {
	                    // If we've shifted off all targets, we're done w/ that element
	                    if (empty($target)) {
	                        continue;
	                    }
	 
	                    // Shift off first target, then rewind array pointer to get next target
	                    $target = array_shift($actions['DELETE_FILES'][$source]);
	                    prev($actions['DELETE_FILES']);
	                }
	                // Some MODs include 'umil/', avoid deleting!
	                if (strpos($target, 'umil/') === 0) {
	                    unset($actions['DELETE_FILES'][$source]);
	                    continue;
	                }
	                // MODX used '*.*' or 'dir/*.*'  (Fun!)
	                elseif (strpos($source, '*.*') !== false) {
	                    // This could be phpbb_root_path, if "Copy: root/*.* to: *.*" syntax was used
	                    // or root/custom_dir if "Copy: root/custom/*.* to: custom/*.*", etc.
	                    $source = $this->mod_root.str_replace('*.*', '', $source);
	                    $target = str_replace('*.*', '', $target);
	 
	                    // Get all of the files in the source directory
	                    $files = find_files($source, '.*');
	                    // And translate into destination files
	                    $files = str_replace($source, $target, $files);
	 
	                    // Get all of the sub-directories in the source directory
	                    $directories['src'] = find_files($source, '.*', 20, true);
	                    // And translate it into destination sub-directories
	                    $directories['dst'] = str_replace($source, $target, $directories['src']);
	 
	                    // Compare source and destination subdirs, if any, in _reverse_ order! (array_pop)
	                    for ($i = 0, $cnt = count($directories['dst']); $i < $cnt; ++$i) {
	                        $dir_source = array_pop($directories['src']);
	                        $dir_target = array_pop($directories['dst']);
	 
	                        // Some MODs include 'umil/', avoid deleting!
	                        if (strpos($dir_target, 'umil/') === 0) {
	                            continue;
	                        }
	 
	                        $src_file_cnt = directory_num_files($dir_source, false, true);
	                        $dst_file_cnt = directory_num_files($phpbb_root_path.$dir_target, false, true);
	                        $src_dir_cnt = directory_num_files($dir_source, true, true);
	                        $dst_dir_cnt = directory_num_files($phpbb_root_path.$dir_target, true, true);
	 
	                        // Do we have a match in recursive file count and match in recursive subdir count?
	                        // This could be vastly improved..
	                        if ($src_file_cnt == $dst_file_cnt && $src_dir_cnt == $dst_dir_cnt) {
	                            $directories['del'][] = $dir_target;
	                        }
	                        unset($dir_source, $dir_target, $src_file_cnt, $dst_file_cnt, $src_dir_cnt, $dst_dir_cnt); // cleanup
	                    }
	 
	                    foreach ($files as $file) {
	                        // Some MODs include 'umil/', avoid deleting!
	                        if (strpos($file, 'umil/') === 0) {
	                            continue;
	                        } elseif (!file_exists($phpbb_root_path.$file) && ($change || $display)) {
	                            $template->assign_block_vars('removing_files', [
	                                'S_MISSING_FILE' => true,
	                                'S_NO_DELETE_ATTEMPT' => true,
	                                'FILENAME' => $file,
	                            ]);
	                        } elseif ($change && ($mod_installed || $force_install)) {
	                            $status = $editor->remove($file);
	 
	                            $template->assign_block_vars('removing_files', [
	                                'S_SUCCESS' => (true === $status) ? true : false,
	                                'S_NO_DELETE_ATTEMPT' => (is_null($status)) ? true : false,
	                                'FILENAME' => $file,
	                            ]);
	                        } elseif ($display && !$change) {
	                            $template->assign_block_vars('removing_files', [
	                                'FILENAME' => $file,
	                            ]);
	                        }
	                        // To avoid "error" on uninstall page when being asked to force
	                        elseif ($change && $display && !$mod_installed && !$force_install) {
	                            $template->assign_block_vars('removing_files', [
	                                'S_NO_DELETE_ATTEMPT' => true,
	                                'FILENAME' => $file,
	                            ]);
	                        }
	                    }
	                    unset($files); // cleanup
	                } elseif (!file_exists($phpbb_root_path.$target) && ($change || $display)) {
	                    $template->assign_block_vars('removing_files', [
	                        'S_MISSING_FILE' => true,
	                        'S_NO_DELETE_ATTEMPT' => true,
	                        'FILENAME' => $target,
	                    ]);
	                } elseif ($change && ($mod_installed || $force_install)) {
	                    $status = $editor->remove($target);
	 
	                    $template->assign_block_vars('removing_files', [
	                        'S_SUCCESS' => (true === $status) ? true : false,
	                        'S_NO_DELETE_ATTEMPT' => (is_null($status)) ? true : false,
	                        'FILENAME' => $target,
	                    ]);
	                } elseif ($display && !$change) {
	                    $template->assign_block_vars('removing_files', [
	                        'FILENAME' => $target,
	                    ]);
	                }
	                // To avoid "error" on uninstall page when being asked to force
	                elseif ($change && $display && !$mod_installed && !$force_install) {
	                    $template->assign_block_vars('removing_files', [
	                        'S_NO_DELETE_ATTEMPT' => true,
	                        'FILENAME' => $target,
	                    ]);
	                }
	            }
	 
	            // Delete wildcard directories, if any, which should now be empty anyway (no recursive delete needed)
	            if ($cnt = count($directories['del'])) {
	                for ($i = 0; $i < $cnt; ++$i) {
	                    if ($change && ($mod_installed || $force_install)) {
	                        $status = $editor->remove($directories['del'][$i]);
	 
	                        $template->assign_block_vars('removing_files', [
	                            'S_SUCCESS' => (true === $status) ? true : false,
	                            'S_NO_DELETE_ATTEMPT' => (is_null($status)) ? true : false,
	                            'FILENAME' => $directories['del'][$i],
	                        ]);
	                    } elseif ($display && !$change) {
	                        $template->assign_block_vars('removing_files', [
	                            'FILENAME' => $directories['del'][$i],
	                        ]);
	                    }
	                    // To avoid "error" on uninstall page when being asked to force
	                    elseif ($change && $display && !$mod_installed && !$force_install) {
	                        $template->assign_block_vars('removing_files', [
	                            'S_NO_DELETE_ATTEMPT' => true,
	                            'FILENAME' => $directories['del'][$i],
	                        ]);
	                    }
	                }
	                unset($directories['del']); // cleanup
	            }
	        }
	        // Normal deleting functionality (not in reverse edits mode)
	        elseif ($mod_installed || $force_install) {
	            foreach ($actions['DELETE_FILES'] as $file) {
	                $wildcards = strpos($file, '*.*');
	                $file = str_replace('*.*', '', $file);
	 
	                if (!file_exists($phpbb_root_path.$file) && ($change || $display)) {
	                    $template->assign_block_vars('removing_files', [
	                        'S_MISSING_FILE' => true,
	                        'S_NO_DELETE_ATTEMPT' => true,
	                        'FILENAME' => $file,
	                    ]);
	                }
	                // purposely do not use !== false here, because we don't expect wildcards at position 0
	                // if there's no wildcard, make sure it's a file to avoid recursively deleting a directory!!!
	                elseif ($wildcards || is_file($phpbb_root_path.$file)) {
	                    if ($change) {
	                        // Delete, recursively if needed
	                        $status = $editor->remove($file, true);
	 
	                        $template->assign_block_vars('removing_files', [
	                            'S_SUCCESS' => (true === $status) ? true : false,
	                            'S_NO_DELETE_ATTEMPT' => (is_null($status)) ? true : false,
	                            'FILENAME' => $file,
	                        ]);
	                    } elseif ($display) {
	                        $template->assign_block_vars('removing_files', [
	                            'FILENAME' => $file,
	                        ]);
	                    }
	                }
	            }
	        }
	    }
	 
	    // Perform SQL queries last -- Queries usually cannot be done a second
	    // time, so do them only if the edits were successful.  Still complies
	    // with the MODX spec in this location
	    if (!empty($actions['SQL']) && ($mod_installed || $force_install || ($display && !$change))) {
	        $template->assign_var('S_SQL', true);
	 
	        parser::parse_sql($actions['SQL']);
	 
	        $db->sql_return_on_error(true);
	 
	        foreach ($actions['SQL'] as $query) {
	            if ($change) {
	                $query_success = $db->sql_query($query);
	 
	                if ($query_success) {
	                    $template->assign_block_vars('sql_queries', [
	                        'S_SUCCESS' => true,
	                        'QUERY' => $query,
	                    ]);
	                } else {
	                    $error = $db->sql_error();
	 
	                    $template->assign_block_vars('sql_queries', [
	                        'S_SUCCESS' => false,
	                        'QUERY' => $query,
	                        'ERROR_MSG' => $error['message'],
	                        'ERROR_CODE' => $error['code'],
	                    ]);
	 
	                    $mod_installed = false;
	                }
	            } elseif ($display) {
	                $template->assign_block_vars('sql_queries', [
	                    'QUERY' => $query,
	                ]);
	            }
	        }
	 
	        $db->sql_return_on_error(false);
	    } else {
	        $template->assign_var('S_SQL', false);
	    }
	 
	    return $mod_installed;
	}

 	/**
	* Search on the file system for other .xml files that belong to this MOD.
	*
	* @param string $mod_path - path to the "main" MODX file, relative to phpBB Root
	*/
 	public function find_children($mod_path)
 	{
 	    $children = [];
	 
 	    if (1.2 == $this->parser->get_modx_version()) {
 	        // TODO: eww, yuck ... processing the XML again?
 	        $details = $this->mod_details($mod_path, false);
	 
 	        $children = $details['CHILDREN'];
	 
 	        if (isset($children['template-lang'])) {
 	            if (isset($children['template'])) {
 	                $children['template'] = array_merge($children['template'], $children['template-lang']);
 	            } else {
 	                $children['template'] = $children['template-lang'];
 	            }
	 
 	            unset($children['template-lang']);
 	        }
	 
 	        $child_types = ['contrib', 'template', 'language', 'dependency', 'uninstall'];
	 
 	        foreach ($child_types as $type) {
 	            if (empty($children[$type])) {
 	                continue;
 	            }
 	            $child_count = count($children[$type]);
 	            // Remove duplicate hrefs if they exist (links in multiple languages can cause this)
 	            for ($i = 1; $i < $child_count; ++$i) {
 	                if (isset($children[$type][$i - 1]) && $children[$type][$i - 1]['href'] == $children[$type][$i]['href']) {
 	                    unset($children[$type][$i]);
 	                }
 	            }
 	        }
 	    } elseif (1.0 == $this->parser->get_modx_version()) {
 	        $search_dir = (0 === strpos($mod_path, $this->mods_dir)) ? dirname($mod_path) : $this->mods_dir.dirname($mod_path);
 	        $children = $this->find_mods($search_dir, 5);
 	    }
	 
 	    return $children;
 	}
	 
 	public function handle_dependency(&$children, $mode, $mod_path)
 	{
 	    if (isset($children['dependency']) && count($children['dependency'])) {
 	        // TODO: check for the chance that the MOD has been installed by AutoMOD
 	        // previously
 	        if (confirm_box(true)) {
 	            // do nothing
 	        } elseif (empty($_REQUEST['dependency_confirm']) && empty($_REQUEST['force'])) {
 	            global $user, $id;
	 
 	            $full_url_list = [];
 	            $message = '';
 	            $children['dependency'] = array_unique($children['dependency']);
 	            foreach ($children['dependency'] as $dependency) {
 	                // $full_url_list[] = $dependency_url;
 	                $message .= sprintf($user->lang['DEPENDENCY_INSTRUCTIONS'], $dependency['href'], $dependency['title']).'<br /><br />';
 	            }
	 
 	            confirm_box(false, $message, build_hidden_fields([
 	                    'dependency_confirm' => true,
 	                    'mode' => $mode,
 	                    'action' => 'install',
 	                    'mod_path' => $mod_path,
 	            ]));
 	        }
 	    }
 	}
	 
 	/**
 	 * Get all contrib links for the selected language.
 	 * This functions will be removed.
 	 */
 	public function get_contrib_lang($contrib, $lang = 'en')
 	{
 	    $ary = [];
	 
 	    foreach ($contrib as $element) {
 	        if (match_language($lang, $element['lang'])) {
 	            $ary[] = $element;
 	        }
 	    }
	 
 	    return $ary;
 	}
	 
 	public function handle_contrib(&$children)
 	{
 	    global $template, $parent_id, $phpbb_root_path, $user, $db;
	 
 	    if (isset($children['contrib']) && count($children['contrib'])) {
 	        $template->assign_var('S_CONTRIB_AVAILABLE', true);
	 
 	        // Do we have links in the users selected language.
 	        // Start with getting the Enlgish links.
 	        $contrib_en = $this->get_contrib_lang($children['contrib']);
	 
 	        if ('en' == $user->data['user_lang'] || count($contrib_en) == count($children['contrib'])) {
 	            // Our user has either English or there is only English links.
 	            $children['contrib'] = $contrib_en;
 	        } else {
 	            // If there are any links in the users language, let's get them.
 	            $contrib_lang = $this->get_contrib_lang($children['contrib'], $user->data['user_lang']);
	 
 	            if (!count($contrib_lang)) {
 	                // There is no links in the right language, give them the English links.
 	                $children['contrib'] = $contrib_en;
 	            } else {
 	                $children['contrib'] = $contrib_lang;
 	            }
 	        }
	 
 	        if (!empty($parent_id)) {
 	            // get installed contribs from the database
 	            $sql = 'SELECT mod_contribs FROM '.MODS_TABLE.'
 	                    WHERE mod_id = '.$parent_id;
 	            $result = $db->sql_query($sql);
 	            $mod_contribs = $db->sql_fetchfield('mod_contribs');
 	            $db->sql_freeresult();
 	        }
	 
 	        $mod_contribs = (!empty($mod_contribs)) ? explode(',', $mod_contribs) : [];
	 
 	        // there are things like upgrades...we don't care unless the MOD has previously been installed.
 	        foreach ($children['contrib'] as $xml_file) {
 	            // Another hack for supporting both versions of MODX
 	            $xml_file = (is_array($xml_file)) ? $xml_file['href'] : str_replace($this->mod_root, '', $xml_file);
	 
 	            $child_details = $this->mod_details($xml_file, false);
	 
 	            // don't do the urlencode until after the file is looked up on the
 	            // filesystem
 	            $xml_file = urlencode('/'.$xml_file);
	 
 	            if (in_array(urldecode($xml_file), $mod_contribs)) {
 	                $child_details['U_UNINSTALL'] = ($parent_id) ? $this->u_action."&amp;action=pre_uninstall&amp;parent=$parent_id&amp;mod_path=$xml_file&amp;type=contrib" : '';
 	            } else {
 	                $child_details['U_INSTALL'] = ($parent_id) ? $this->u_action."&amp;action=pre_install&amp;parent=$parent_id&amp;mod_path=$xml_file&amp;type=contrib" : '';
 	            }
	 
 	            $child_details['MOD_NAME'] = localize_title($child_details['MOD_NAME'], $user->data['user_lang']);
 	            $template->assign_block_vars('contrib', $child_details);
 	        }
 	    }
 	}
	 
 	public function handle_merge($type, &$actions, &$children, $process_files)
 	{
 	    if (!isset($children[$type]) || !count($process_files)) {
 	        return;
 	    }
	 
 	    // add the actions to our $actions array...give praise to array_merge_recursive
 	    foreach ($process_files as $key => $name) {
 	        foreach ($children[$type] as $child_key => $child_data) {
 	            $root_position = strpos($child_data['href'], $this->mod_root);
 	            if ($child_data['realname'] == $name && false === $root_position) {
 	                $child_filename = $this->mod_root.ltrim($child_data['href'], './');
 	                break;
 	            } elseif ($child_data['realname'] == $name && 0 === $root_position) {
 	                $child_filename = $child_data['href'];
 	            }
 	        }
	 
 	        $actions_ary = $this->mod_actions($child_filename);
	 
 	        if (!isset($actions_ary['NEW_FILES'])) {
 	            $actions = array_merge_recursive($actions, $actions_ary);
 	            continue;
 	        }
	 
 	        // perform some cleanup if the MOD author didn't specify the proper root directory
 	        foreach ($actions_ary['NEW_FILES'] as $source => $destination) {
 	            // if the source file does not exist, and languages/ is not at the beginning
 	            // this is probably only applicable with MODX 1.0.
 	            if (!file_exists($this->mod_root.$source) && false === strpos("{$type}s/", $source)) {
 	                // and it does exist if we force a languages/ into the path
 	                if (file_exists($this->mod_root."{$type}s/".$source)) {
 	                    // change the array key to include languages
 	                    unset($actions_ary['NEW_FILES'][$source]);
 	                    $actions_ary['NEW_FILES']["{$type}s/$source"] = $destination;
 	                }
	 
 	                // else we let the error handling do its thing
 	            }
 	        }
	 
 	        $actions = array_merge_recursive($actions, $actions_ary);
 	    }
 	}

	public function handle_language_prompt(&$children, &$elements, $action)
 	{
 	    global $db, $template, $parent_id, $phpbb_root_path;
	 
 	    if (isset($children['language']) && count($children['language'])) {
 	        // additional languages are available...find out which ones we may want to apply
 	        $sql = 'SELECT lang_id, lang_iso FROM '.LANG_TABLE;
 	        $result = $db->sql_query($sql);
	 
 	        $installed_languages = [];
 	        while ($row = $db->sql_fetchrow($result)) {
 	            $installed_languages[$row['lang_id']] = $row['lang_iso'];
 	        }
 	        $db->sql_freeresult($result);
	 
 	        foreach ($children['language'] as $key => $tag) {
 	            // remove useless title from MODX 1.2.0 tags
 	            $children['language'][$tag['realname']] = is_array($tag) ? $tag['href'] : $tag;
 	        }
	 
 	        $available_languages = array_keys($children['language']);
 	        $process_languages = $elements['language'] = array_intersect($available_languages, $installed_languages);
	 
 	        // $unknown_languages are provided for by the MOD, but not installed on the board
 	        $unknown_languages = array_diff($available_languages, $installed_languages);
	 
 	        // Inform the user if there are languages provided for by the MOD
 	        if (count($children['language'])) {
 	            if (!empty($parent_id)) {
 	                // get installed languages from the database
 	                $sql = 'SELECT mod_languages FROM '.MODS_TABLE.'
 	                        WHERE mod_id = '.$parent_id;
 	                $result = $db->sql_query($sql);
 	                $mod_languages = $db->sql_fetchfield('mod_languages');
 	                $db->sql_freeresult();
 	            }
	 
 	            $mod_languages = (!empty($mod_languages)) ? explode(',', $mod_languages) : [];
 	            foreach ($children['language'] as $row) {
 	                if (is_string($row)) {
 	                    continue;
 	                }
	 
 	                $xml_file = (!empty($row['href'])) ? urlencode($row['href']) : '';
	 
 	                $template->assign_block_vars('unknown_lang', [
 	                    'ENGLISH_NAME' => $row['title'],
 	                    'LOCAL_NAME' => $row['realname'],
 	                    'U_INSTALL' => (!empty($xml_file) && !in_array($row['href'], $mod_languages) && $parent_id) ? $this->u_action."&amp;action=pre_install&amp;parent=$parent_id&amp;mod_path=$xml_file&amp;type=lang" : '',
 	                    'U_UNINSTALL' => (!empty($xml_file) && $parent_id) ? $this->u_action."&amp;action=pre_uninstall&amp;parent=$parent_id&amp;mod_path=$xml_file&amp;type=lang" : '',
 	                ]);
 	                unset($row);
 	            }
 	        }
	 
 	        return $process_languages;
 	    }
 	}
	 
 	public function handle_template_prompt(&$children, &$elements, $action)
 	{
 	    global $db, $template, $phpbb_root_path, $parent_id;
	 
 	    if (isset($children['template']) && count($children['template'])) {
 	        // additional styles are available for this MOD
 	        $sql = 'SELECT template_id, template_name FROM '.STYLES_TEMPLATE_TABLE;
 	        $result = $db->sql_query($sql);
	 
 	        $installed_templates = [];
 	        while ($row = $db->sql_fetchrow($result)) {
 	            $installed_templates[$row['template_id']] = $row['template_name'];
 	        }
 	        $db->sql_freeresult($result);
	 
 	        foreach ($children['template'] as $key => $tag) {
 	            // remove useless title from MODX 1.2.0 tags
 	            $children['template'][$tag['realname']] = is_array($tag) ? $tag['href'] : $tag;
 	        }
	 
 	        $available_templates = array_keys($children['template']);
	 
 	        // $process_templates are those that are installed on the board and provided for by the MOD
 	        $process_templates = $elements['template'] = array_intersect($available_templates, $installed_templates);
 	    }
 	}
	 
 	public function upload_mod($action)
 	{
 	    global $phpbb_root_path, $phpEx, $template, $user;
	 
 	    $can_upload = ('0' == ini_get('file_uploads') || 'off' == strtolower(ini_get('file_uploads')) || !extension_loaded('zlib')) ? false : true;
	 
 	    // get FTP information if we need it
 	    $hidden_ary = get_connection_info(false);
	 
 	    if (!isset($_FILES['modupload']) || 'upload_mod' != $action) {
 	        $template->assign_vars([
 	            'S_FRONTEND' => true,
 	            'S_MOD_UPLOAD' => ($can_upload) ? true : false,
 	            'U_UPLOAD' => $this->u_action.'&amp;action=upload_mod',
 	            'S_FORM_ENCTYPE' => ($can_upload) ? ' enctype="multipart/form-data"' : '',
 	            'S_HIDDEN_FIELDS' => build_hidden_fields($hidden_ary),
 	        ]);
 	        add_form_key('acp_mods_upload');
	 
 	        return false;
 	    } // end pre_upload_mod
	 
 	    if (!check_form_key('acp_mods_upload')) {
 	        trigger_error($user->lang['FORM_INVALID'].adm_back_link($this->u_action), E_USER_WARNING);
 	    }
	 
 	    $user->add_lang('posting');  // For error messages
 	    include $phpbb_root_path.'includes/functions_upload.'.$phpEx;
 	    $upload = new fileupload();
 	    $upload->set_allowed_extensions(['zip']);    // Only allow ZIP files
	 
 	    $write_method = 'editor_'.determine_write_method(false);
	 
 	    // For Direct & Manual write methods, make sure store/mods/ directory is writable
 	    if ('editor_direct' == $write_method || 'editor_manual' == $write_method) {
 	        if (!is_writable($this->mods_dir)) {
 	            trigger_error($user->lang['MODS_NOT_WRITABLE'].adm_back_link($this->u_action), E_USER_WARNING);
 	        }
	 
 	        $write_method = 'editor_direct';    // Force Direct method, in the case of manual
 	        $upload_dir = $this->mods_dir;
 	    }
 	    // FTP method: we still need a known world-writable directory (store/) for zip extraction
 	    elseif (is_writable($this->store_dir)) {
 	        $upload_dir = $this->store_dir;
 	    } else {
 	        trigger_error($user->lang['STORE_NOT_WRITABLE'].adm_back_link($this->u_action), E_USER_WARNING);
 	    }
	 
 	    $editor = new $write_method();
	 
 	    // Make sure the store/mods/ directory exists and if it doesn't, create it
 	    if (!is_dir($this->mods_dir)) {
 	        $editor->recursive_mkdir($this->mods_dir);
 	    }
	 
 	    // Proceed with the upload
 	    $file = $upload->form_upload('modupload');
	 
 	    if (empty($file->filename)) {
 	        trigger_error($user->lang['NO_UPLOAD_FILE'].adm_back_link($this->u_action), E_USER_WARNING);
 	    } elseif ($file->init_error || count($file->error)) {
 	        $file->remove();
 	        trigger_error((count($file->error) ? implode('<br />', $file->error) : $user->lang['MOD_UPLOAD_INIT_FAIL']).adm_back_link($this->u_action), E_USER_WARNING);
 	    }
	 
 	    $file->clean_filename('real');
 	    $file->move_file(str_replace($phpbb_root_path, '', $upload_dir), true, true);
	 
 	    if (count($file->error)) {
 	        $file->remove();
 	        trigger_error(implode('<br />', $file->error).adm_back_link($this->u_action), E_USER_WARNING);
 	    }
	 
 	    include $phpbb_root_path.'includes/functions_compress.'.$phpEx;
 	    $mod_dir = $upload_dir.'/'.str_replace('.zip', '', $file->get('realname'));
 	    $compress = new compress_zip('r', $file->destination_file);
 	    $compress->extract($mod_dir.'_tmp/');
 	    $compress->close();
 	    $folder_contents = scandir($mod_dir.'_tmp/', 1);  // This ensures dir is at index 0
	 
 	    $folder_contents = array_diff($folder_contents, ['.', '..']);
	 
 	    // We need to check if there's only one (main) directory inside the temp MOD directory
 	    if (1 == count($folder_contents)) {
 	        $folder_contents = implode(null, $folder_contents);
 	        $from_dir = $mod_dir.'_tmp/'.$folder_contents;
 	        $to_dir = $this->mods_dir.'/'.$folder_contents;
 	    }
 	    // Otherwise assume the temp directory is the main directroy, so change the directory
 	    // name by moving to a directory without the '_tmp' suffix
 	    elseif (!is_dir($mod_dir)) {
 	        $from_dir = $mod_dir.'_tmp/';
 	        $to_dir = $mod_dir.'/';
 	    }
 	    // We should never really get here, but you never know!
 	    else {
 	        trigger_error($user->lang['MOD_UPLOAD_UNRECOGNIZED'].adm_back_link($this->u_action), E_USER_WARNING);
 	    }
	 
 	    // Copy that directory to the new path
 	    $editor->copy_content($from_dir, $to_dir);
	 
 	    // Finally remove the main tmp extraction directory, directly, just like we created it
 	    recursive_unlink($mod_dir.'_tmp/');
	 
 	    $template->assign_vars([
 	        'S_MOD_SUCCESSBOX' => true,
 	        'MESSAGE' => $user->lang['MOD_UPLOAD_SUCCESS'],
 	        'U_RETURN' => $this->u_action,
 	    ]);
	 
 	    // Remove the uploaded archive file
 	    $file->remove();
	 
	        return true;
 	}

    public function delete_mod($action, $mod_path = '')
	{
	    global $template, $user;
	 
	    if (!empty($mod_path)) {
	        $mod_path = explode('/', str_replace('\\', '/', $mod_path));
	        $mod_path = (!empty($mod_path[0])) ? $mod_path[0] : $mod_path[1];
	    } else {
	        $mod_path = request_var('mod_delete', '');
	    }
	 
	    if (empty($mod_path) || !is_dir($this->mods_dir.'/'.$mod_path)) {
	        return false;    // ERROR
	    }
	 
	    // get FTP information if we need it
	    $hidden_ary = get_connection_info(false);
	 
	    $hidden_ary['mod_delete'] = $mod_path;
	 
	    if ('delete_mod' != $action) {
	        $template->assign_vars([
	            'S_MOD_DELETE' => true,
	            'U_DELETE' => $this->u_action.'&amp;action=delete_mod',
	            'S_HIDDEN_FIELDS' => build_hidden_fields($hidden_ary),
	        ]);
	        add_form_key('acp_mods_delete');
	 
	        return;
	    } // end pre_delete_mod
	 
	    $write_method = 'editor_'.determine_write_method(false);
	    // Force Direct method, in the case of manual - just like above in mod_upload()
	    $write_method = ('editor_manual' == $write_method) ? 'editor_direct' : $write_method;
	    $editor = new $write_method();
	 
	    if (!check_form_key('acp_mods_delete')) {
	        trigger_error($user->lang['FORM_INVALID'].adm_back_link($this->u_action), E_USER_WARNING);
	    }
	 
	    $status = $editor->remove("{$this->mods_dir}/{$mod_path}", true);
	 
	    if (true !== $status) {
	        trigger_error($user->lang['DELETE_ERROR']."  $status".adm_back_link($this->u_action), E_USER_WARNING);
	    }
	 
	    $template->assign_vars([
	        'S_MOD_SUCCESSBOX' => true,
	        'MESSAGE' => $user->lang['DELETE_SUCCESS'],
	        'U_RETURN' => $this->u_action,
	    ]);
	}
}