<?php
/**
*
* @package install
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
*/
if (!defined('IN_INSTALL'))
{
	// Someone has tried to access the file direct. This is not a good idea, so exit
	exit;
}

ini_set("mbstring.http_input", "pass");
ini_set("mbstring.http_output", "pass");

if (!empty($setmodules))
{
	// If phpBB is already installed we do not include this module
	if (@file_exists($phpbb_root_path . 'config.' . $phpEx) && !file_exists($phpbb_root_path . 'cache/install_lock'))
	{
		include_once($phpbb_root_path . 'config.' . $phpEx);

		if (defined('PHPBB_INSTALLED'))
		{
			return;
		}
	}

	$module[] = array(
		'module_type'		=> 'install',
		'module_title'		=> 'INSTALL',
		'module_filename'	=> substr(basename(__FILE__), 0, -strlen($phpEx)-1),
		'module_order'		=> 10,
		'module_subs'		=> '',
		'module_stages'		=> array('INTRO', 'REQUIREMENTS', 'DATABASE', 'ADMINISTRATOR', 'CONFIG_FILE', 'ADVANCED', 'CREATE_TABLE', 'FINAL'),
		'module_reqs'		=> ''
	);
}

/**
* Installation
* @package install
*/
class install_install extends module
{
	function __construct(&$p_master)
	{
		$this->p_master = &$p_master;
	}

	function main($mode, $sub)
	{
		global $lang, $template, $language, $phpbb_root_path, $cache;

		switch ($sub)
		{
			case 'intro':
				$cache->purge();

				$this->page_title = $lang['SUB_INTRO'];

				$template->assign_vars(array(
					'TITLE'			=> $lang['INSTALL_INTRO'],
					'BODY'			=> $lang['INSTALL_INTRO_BODY'],
					'L_SUBMIT'		=> $lang['NEXT_STEP'],
					'S_LANG_SELECT'	=> '<select id="language" name="language">' . $this->p_master->inst_language_select($language) . '</select>',
					'U_ACTION'		=> $this->p_master->module_url . "?mode=$mode&amp;sub=requirements&amp;language=$language",
				));

			break;

			case 'requirements':
				$this->check_server_requirements($mode, $sub);

			break;

			case 'database':
				$this->obtain_database_settings($mode, $sub);

			break;

			case 'administrator':
				$this->obtain_admin_settings($mode, $sub);

			break;

			case 'config_file':
				$this->create_config_file($mode, $sub);

			break;

			case 'advanced':
				$this->obtain_advanced_settings($mode, $sub);

			break;

			case 'create_table':
				$this->load_schema($mode, $sub);
			break;

			case 'final':
				$this->build_search_index($mode, $sub);
				$this->add_modules($mode, $sub);
				$this->add_language($mode, $sub);
				$this->add_bots($mode, $sub);
				$this->email_admin($mode, $sub);
				$this->disable_avatars_if_unwritable();

				// Remove the lock file
				@unlink($phpbb_root_path . 'cache/install_lock');

			break;
		}

		$this->tpl_name = 'install_install';
	}

	/**
	* Checks that the server we are installing on meets the requirements for running phpBB
	*/
	function check_server_requirements($mode, $sub)
	{
		global $lang, $template, $phpbb_root_path, $phpEx, $language;

		$this->page_title = $lang['STAGE_REQUIREMENTS'];

		$template->assign_vars(array(
			'TITLE'		=> $lang['REQUIREMENTS_TITLE'],
			'BODY'		=> $lang['REQUIREMENTS_EXPLAIN'],
		));

		$passed = array('php' => false, 'db' => false, 'files' => false, 'pcre' => false, 'imagesize' => false,);

		// Test for basic PHP settings
		$template->assign_block_vars('checks', array(
			'S_LEGEND'			=> true,
			'LEGEND'			=> $lang['PHP_SETTINGS'],
			'LEGEND_EXPLAIN'	=> $lang['PHP_SETTINGS_EXPLAIN'],
		));

		// Test the minimum PHP version
		$php_version = PHP_VERSION;

		if (version_compare($php_version, '4.3.3') < 0)
		{
			$result = '<strong style="color:red">' . $lang['NO'] . '</strong>';
		}
		else
		{
			$passed['php'] = true;

			// We also give feedback on whether we're running in safe mode
			$result = '<strong style="color:green">' . $lang['YES'];
			if (@ini_get('safe_mode') == '1' || strtolower(@ini_get('safe_mode')) == 'on')
			{
				$result .= ', ' . $lang['PHP_SAFE_MODE'];
			}
			$result .= '</strong>';
		}

		$template->assign_block_vars('checks', array(
			'TITLE'			=> $lang['PHP_VERSION_REQD'],
			'RESULT'		=> $result,

			'S_EXPLAIN'		=> false,
			'S_LEGEND'		=> false,
		));

		// Don't check for register_globals on 5.4+
		if (version_compare($php_version, '5.4.0-dev') < 0)
		{
			// Check for register_globals being enabled
			if (@ini_get('register_globals') == '1' || strtolower(@ini_get('register_globals')) == 'on')
			{
				$result = '<strong style="color:red">' . $lang['NO'] . '</strong>';
			}
			else
			{
				$result = '<strong style="color:green">' . $lang['YES'] . '</strong>';
			}

			$template->assign_block_vars('checks', array(
				'TITLE'			=> $lang['PHP_REGISTER_GLOBALS'],
				'TITLE_EXPLAIN'	=> $lang['PHP_REGISTER_GLOBALS_EXPLAIN'],
				'RESULT'		=> $result,

				'S_EXPLAIN'		=> true,
				'S_LEGEND'		=> false,
			));
		}

		// Check for url_fopen
		if (@ini_get('allow_url_fopen') == '1' || strtolower(@ini_get('allow_url_fopen')) == 'on')
		{
			$result = '<strong style="color:green">' . $lang['YES'] . '</strong>';
		}
		else
		{
			$result = '<strong style="color:red">' . $lang['NO'] . '</strong>';
		}

		$template->assign_block_vars('checks', array(
			'TITLE'			=> $lang['PHP_URL_FOPEN_SUPPORT'],
			'TITLE_EXPLAIN'	=> $lang['PHP_URL_FOPEN_SUPPORT_EXPLAIN'],
			'RESULT'		=> $result,

			'S_EXPLAIN'		=> true,
			'S_LEGEND'		=> false,
		));


		// Check for getimagesize
		if (@function_exists('getimagesize'))
		{
			$passed['imagesize'] = true;
			$result = '<strong style="color:green">' . $lang['YES'] . '</strong>';
		}
		else
		{
			$result = '<strong style="color:red">' . $lang['NO'] . '</strong>';
		}

		$template->assign_block_vars('checks', array(
			'TITLE'			=> $lang['PHP_GETIMAGESIZE_SUPPORT'],
			'TITLE_EXPLAIN'	=> $lang['PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'],
			'RESULT'		=> $result,

			'S_EXPLAIN'		=> true,
			'S_LEGEND'		=> false,
		));

		// Check for PCRE UTF-8 support
		if (@preg_match('//u', ''))
		{
			$passed['pcre'] = true;
			$result = '<strong style="color:green">' . $lang['YES'] . '</strong>';
		}
		else
		{
			$result = '<strong style="color:red">' . $lang['NO'] . '</strong>';
		}

		$template->assign_block_vars('checks', array(
			'TITLE'			=> $lang['PCRE_UTF_SUPPORT'],
			'TITLE_EXPLAIN'	=> $lang['PCRE_UTF_SUPPORT_EXPLAIN'],
			'RESULT'		=> $result,

			'S_EXPLAIN'		=> true,
			'S_LEGEND'		=> false,
		));

/**
*		Better not enabling and adding to the loaded extensions due to the specific requirements needed
		if (!@extension_loaded('mbstring'))
		{
			can_load_dll('mbstring');
		}
*/

		$passed['mbstring'] = true;
		if (@extension_loaded('mbstring'))
		{
			// Test for available database modules
			$template->assign_block_vars('checks', array(
				'S_LEGEND'			=> true,
				'LEGEND'			=> $lang['MBSTRING_CHECK'],
				'LEGEND_EXPLAIN'	=> $lang['MBSTRING_CHECK_EXPLAIN'],
			));

			$checks = array(
//				array('func_overload', '&', MB_OVERLOAD_MAIL|MB_OVERLOAD_STRING),
				array('encoding_translation', '!=', 0),
//				array('http_input', '!=', array('pass', '')),
//				array('http_output', '!=', array('pass', ''))
			);

			foreach ($checks as $mb_checks)
			{
				$ini_val = @ini_get('mbstring.' . $mb_checks[0]);
				switch ($mb_checks[1])
				{
					case '&':
						if (intval($ini_val) & $mb_checks[2])
						{
							$result = '<strong style="color:red">' . $lang['NO'] . '</strong>';
							$passed['mbstring'] = false;
						}
						else
						{
							$result = '<strong style="color:green">' . $lang['YES'] . '</strong>';
						}
					break;

					case '!=':
						if (!is_array($mb_checks[2]) && $ini_val != $mb_checks[2] ||
							is_array($mb_checks[2]) && !in_array($ini_val, $mb_checks[2]))
						{
							$result = '<strong style="color:red">' . $lang['NO'] . '</strong>';
							$passed['mbstring'] = false;
						}
						else
						{
							$result = '<strong style="color:green">' . $lang['YES'] . '</strong>';
						}
					break;
				}
				$template->assign_block_vars('checks', array(
					'TITLE'			=> $lang['MBSTRING_' . strtoupper($mb_checks[0])],
					'TITLE_EXPLAIN'	=> $lang['MBSTRING_' . strtoupper($mb_checks[0]) . '_EXPLAIN'],
					'RESULT'		=> $result,

					'S_EXPLAIN'		=> true,
					'S_LEGEND'		=> false,
				));
			}
		}

		// Test for available database modules
		$template->assign_block_vars('checks', array(
			'S_LEGEND'			=> true,
			'LEGEND'			=> $lang['PHP_SUPPORTED_DB'],
			'LEGEND_EXPLAIN'	=> $lang['PHP_SUPPORTED_DB_EXPLAIN'],
		));

		$available_dbms = get_available_dbms(false, true);
		$passed['db'] = $available_dbms['ANY_DB_SUPPORT'];
		unset($available_dbms['ANY_DB_SUPPORT']);

		foreach ($available_dbms as $db_name => $db_ary)
		{
			if (!$db_ary['AVAILABLE'])
			{
				$template->assign_block_vars('checks', array(
					'TITLE'		=> $lang['DLL_' . strtoupper($db_name)],
					'RESULT'	=> '<span style="color:red">' . $lang['UNAVAILABLE'] . '</span>',

					'S_EXPLAIN'	=> false,
					'S_LEGEND'	=> false,
				));
			}
			else
			{
				$template->assign_block_vars('checks', array(
					'TITLE'		=> $lang['DLL_' . strtoupper($db_name)],
					'RESULT'	=> '<strong style="color:green">' . $lang['AVAILABLE'] . '</strong>',

					'S_EXPLAIN'	=> false,
					'S_LEGEND'	=> false,
				));
			}
		}

		// Test for other modules
		$template->assign_block_vars('checks', array(
			'S_LEGEND'			=> true,
			'LEGEND'			=> $lang['PHP_OPTIONAL_MODULE'],
			'LEGEND_EXPLAIN'	=> $lang['PHP_OPTIONAL_MODULE_EXPLAIN'],
		));

		foreach ($this->php_dlls_other as $dll)
		{
			if (!@extension_loaded($dll))
			{
				if (!can_load_dll($dll))
				{
					$template->assign_block_vars('checks', array(
						'TITLE'		=> $lang['DLL_' . strtoupper($dll)],
						'RESULT'	=> '<strong style="color:red">' . $lang['UNAVAILABLE'] . '</strong>',

						'S_EXPLAIN'	=> false,
						'S_LEGEND'	=> false,
					));
					continue;
				}
			}

			$template->assign_block_vars('checks', array(
				'TITLE'		=> $lang['DLL_' . strtoupper($dll)],
				'RESULT'	=> '<strong style="color:green">' . $lang['AVAILABLE'] . '</strong>',

				'S_EXPLAIN'	=> false,
				'S_LEGEND'	=> false,
			));
		}

		// Can we find Imagemagick anywhere on the system?
		$exe = (DIRECTORY_SEPARATOR == '\\') ? '.exe' : '';

		$magic_home = getenv('MAGICK_HOME');
		$img_imagick = '';
		if (empty($magic_home))
		{
			$locations = array('C:/WINDOWS/', 'C:/WINNT/', 'C:/WINDOWS/SYSTEM/', 'C:/WINNT/SYSTEM/', 'C:/WINDOWS/SYSTEM32/', 'C:/WINNT/SYSTEM32/', '/usr/bin/', '/usr/sbin/', '/usr/local/bin/', '/usr/local/sbin/', '/opt/', '/usr/imagemagick/', '/usr/bin/imagemagick/');
			$path_locations = str_replace('\\', '/', (explode(($exe) ? ';' : ':', getenv('PATH'))));

			$locations = array_merge($path_locations, $locations);
			foreach ($locations as $location)
			{
				// The path might not end properly, fudge it
				if (substr($location, -1, 1) !== '/')
				{
					$location .= '/';
				}

				if (@file_exists($location) && @is_readable($location . 'mogrify' . $exe) && @filesize($location . 'mogrify' . $exe) > 3000)
				{
					$img_imagick = str_replace('\\', '/', $location);
					continue;
				}
			}
		}
		else
		{
			$img_imagick = str_replace('\\', '/', $magic_home);
		}

		$template->assign_block_vars('checks', array(
			'TITLE'		=> $lang['APP_MAGICK'],
			'RESULT'	=> ($img_imagick) ? '<strong style="color:green">' . $lang['AVAILABLE'] . ', ' . $img_imagick . '</strong>' : '<strong style="color:blue">' . $lang['NO_LOCATION'] . '</strong>',

			'S_EXPLAIN'	=> false,
			'S_LEGEND'	=> false,
		));

		// Check permissions on files/directories we need access to
		$template->assign_block_vars('checks', array(
			'S_LEGEND'			=> true,
			'LEGEND'			=> $lang['FILES_REQUIRED'],
			'LEGEND_EXPLAIN'	=> $lang['FILES_REQUIRED_EXPLAIN'],
		));

		$directories = array('cache/', 'files/', 'store/');

		umask(0);

		$passed['files'] = true;
		foreach ($directories as $dir)
		{
			$exists = $write = false;

			// Try to create the directory if it does not exist
			if (!file_exists($phpbb_root_path . $dir))
			{
				@mkdir($phpbb_root_path . $dir, 0777);
				phpbb_chmod($phpbb_root_path . $dir, CHMOD_READ | CHMOD_WRITE);
			}

			// Now really check
			if (file_exists($phpbb_root_path . $dir) && is_dir($phpbb_root_path . $dir))
			{
				phpbb_chmod($phpbb_root_path . $dir, CHMOD_READ | CHMOD_WRITE);
				$exists = true;
			}

			// Now check if it is writable by storing a simple file
			$fp = @fopen($phpbb_root_path . $dir . 'test_lock', 'wb');
			if ($fp !== false)
			{
				$write = true;
			}
			@fclose($fp);

			@unlink($phpbb_root_path . $dir . 'test_lock');

			$passed['files'] = ($exists && $write && $passed['files']) ? true : false;

			$exists = ($exists) ? '<strong style="color:green">' . $lang['FOUND'] . '</strong>' : '<strong style="color:red">' . $lang['NOT_FOUND'] . '</strong>';
			$write = ($write) ? ', <strong style="color:green">' . $lang['WRITABLE'] . '</strong>' : (($exists) ? ', <strong style="color:red">' . $lang['UNWRITABLE'] . '</strong>' : '');

			$template->assign_block_vars('checks', array(
				'TITLE'		=> $dir,
				'RESULT'	=> $exists . $write,

				'S_EXPLAIN'	=> false,
				'S_LEGEND'	=> false,
			));
		}

		// Check permissions on files/directories it would be useful access to
		$template->assign_block_vars('checks', array(
			'S_LEGEND'			=> true,
			'LEGEND'			=> $lang['FILES_OPTIONAL'],
			'LEGEND_EXPLAIN'	=> $lang['FILES_OPTIONAL_EXPLAIN'],
		));

		$directories = array('config.' . $phpEx, 'images/avatars/upload/');

		foreach ($directories as $dir)
		{
			$write = $exists = true;
			if (file_exists($phpbb_root_path . $dir))
			{
				if (!phpbb_is_writable($phpbb_root_path . $dir))
				{
					$write = false;
				}
			}
			else
			{
				$write = $exists = false;
			}

			$exists_str = ($exists) ? '<strong style="color:green">' . $lang['FOUND'] . '</strong>' : '<strong style="color:red">' . $lang['NOT_FOUND'] . '</strong>';
			$write_str = ($write) ? ', <strong style="color:green">' . $lang['WRITABLE'] . '</strong>' : (($exists) ? ', <strong style="color:red">' . $lang['UNWRITABLE'] . '</strong>' : '');

			$template->assign_block_vars('checks', array(
				'TITLE'		=> $dir,
				'RESULT'	=> $exists_str . $write_str,

				'S_EXPLAIN'	=> false,
				'S_LEGEND'	=> false,
			));
		}

		// And finally where do we want to go next (well today is taken isn't it :P)
		$s_hidden_fields = ($img_imagick) ? '<input type="hidden" name="img_imagick" value="' . addslashes($img_imagick) . '" />' : '';

		$url = (!in_array(false, $passed)) ? $this->p_master->module_url . "?mode=$mode&amp;sub=database&amp;language=$language" : $this->p_master->module_url . "?mode=$mode&amp;sub=requirements&amp;language=$language	";
		$submit = (!in_array(false, $passed)) ? $lang['INSTALL_START'] : $lang['INSTALL_TEST'];


		$template->assign_vars(array(
			'L_SUBMIT'	=> $submit,
			'S_HIDDEN'	=> $s_hidden_fields,
			'U_ACTION'	=> $url,
		));
	}

	/**
	* Obtain the information required to connect to the database
	*/
	function obtain_database_settings($mode, $sub)
	{
		global $lang, $template, $phpEx;

		$this->page_title = $lang['STAGE_DATABASE'];

		// Obtain any submitted data
		$data = $this->get_submitted_data();

		$connect_test = false;
		$error = array();
		$available_dbms = get_available_dbms(false, true);

		// Has the user opted to test the connection?
		if (isset($_POST['testdb']))
		{
			if (!isset($available_dbms[$data['dbms']]) || !$available_dbms[$data['dbms']]['AVAILABLE'])
			{
				$error[] = $lang['INST_ERR_NO_DB'];
				$connect_test = false;
			}
			else if (!preg_match(get_preg_expression('table_prefix'), $data['table_prefix']))
			{
				$error[] = $lang['INST_ERR_DB_INVALID_PREFIX'];
				$connect_test = false;
			}
			else
			{
				$connect_test = connect_check_db(true, $error, $available_dbms[$data['dbms']], $data['table_prefix'], $data['dbhost'], $data['dbuser'], htmlspecialchars_decode($data['dbpasswd'], ENT_COMPAT), $data['dbname'], $data['dbport']);
			}

			$template->assign_block_vars('checks', array(
				'S_LEGEND'			=> true,
				'LEGEND'			=> $lang['DB_CONNECTION'],
				'LEGEND_EXPLAIN'	=> false,
			));

			if ($connect_test)
			{
				$template->assign_block_vars('checks', array(
					'TITLE'		=> $lang['DB_TEST'],
					'RESULT'	=> '<strong style="color:green">' . $lang['SUCCESSFUL_CONNECT'] . '</strong>',

					'S_EXPLAIN'	=> false,
					'S_LEGEND'	=> false,
				));
			}
			else
			{
				$template->assign_block_vars('checks', array(
					'TITLE'		=> $lang['DB_TEST'],
					'RESULT'	=> '<strong style="color:red">' . implode('<br />', $error) . '</strong>',

					'S_EXPLAIN'	=> false,
					'S_LEGEND'	=> false,
				));
			}
		}

		if (!$connect_test)
		{
			// Update the list of available DBMS modules to only contain those which can be used
			$available_dbms_temp = array();
			foreach ($available_dbms as $type => $dbms_ary)
			{
				if (empty($dbms_ary['AVAILABLE']))
				{
					continue;
				}

				$available_dbms_temp[$type] = $dbms_ary;
			}

			$available_dbms = &$available_dbms_temp;

			// And now for the main part of this page
			$data['table_prefix'] = (!empty($data['table_prefix']) ? $data['table_prefix'] : 'phpbb_');

			foreach ($this->db_config_options as $config_key => $vars)
			{
				if (!is_array($vars) && strpos($config_key, 'legend') === false)
				{
					continue;
				}

				if (strpos($config_key, 'legend') !== false)
				{
					$template->assign_block_vars('options', array(
						'S_LEGEND'		=> true,
						'LEGEND'		=> $lang[$vars])
					);

					continue;
				}

				$options = isset($vars['options']) ? $vars['options'] : '';

				$template->assign_block_vars('options', array(
					'KEY'			=> $config_key,
					'TITLE'			=> $lang[$vars['lang']],
					'S_EXPLAIN'		=> $vars['explain'],
					'S_LEGEND'		=> false,
					'TITLE_EXPLAIN'	=> ($vars['explain']) ? $lang[$vars['lang'] . '_EXPLAIN'] : '',
					'CONTENT'		=> $this->p_master->input_field($config_key, $vars['type'], $data[$config_key], $options),
					)
				);
			}
		}

		// And finally where do we want to go next (well today is taken isn't it :P)
		$s_hidden_fields = ($data['img_imagick']) ? '<input type="hidden" name="img_imagick" value="' . addslashes($data['img_imagick']) . '" />' : '';
		$s_hidden_fields .= '<input type="hidden" name="language" value="' . $data['language'] . '" />';
		if ($connect_test)
		{
			foreach ($this->db_config_options as $config_key => $vars)
			{
				if (!is_array($vars))
				{
					continue;
				}
				$s_hidden_fields .= '<input type="hidden" name="' . $config_key . '" value="' . $data[$config_key] . '" />';
			}
		}

		$url = ($connect_test) ? $this->p_master->module_url . "?mode=$mode&amp;sub=administrator" : $this->p_master->module_url . "?mode=$mode&amp;sub=database";
		$s_hidden_fields .= ($connect_test) ? '' : '<input type="hidden" name="testdb" value="true" />';

		$submit = $lang['NEXT_STEP'];

		$template->assign_vars(array(
			'L_SUBMIT'	=> $submit,
			'S_HIDDEN'	=> $s_hidden_fields,
			'U_ACTION'	=> $url,
		));
	}

	/**
	* Obtain the administrator's name, password and email address
	*/
	function obtain_admin_settings($mode, $sub)
	{
		global $lang, $template, $phpEx;

		$this->page_title = $lang['STAGE_ADMINISTRATOR'];

		// Obtain any submitted data
		$data = $this->get_submitted_data();

		if ($data['dbms'] == '')
		{
			// Someone's been silly and tried calling this page direct
			// So we send them back to the start to do it again properly
			$this->p_master->redirect("index.$phpEx?mode=install");
		}

		$s_hidden_fields = ($data['img_imagick']) ? '<input type="hidden" name="img_imagick" value="' . addslashes($data['img_imagick']) . '" />' : '';
		$passed = false;

		$data['default_lang'] = ($data['default_lang'] !== '') ? $data['default_lang'] : $data['language'];

		if (isset($_POST['check']))
		{
			$error = array();

			// Check the entered email address and password
			if ($data['admin_name'] == '' || $data['admin_pass1'] == '' || $data['admin_pass2'] == '' || $data['board_email1'] == '' || $data['board_email2'] == '')
			{
				$error[] = $lang['INST_ERR_MISSING_DATA'];
			}

			if ($data['admin_pass1'] != $data['admin_pass2'] && $data['admin_pass1'] != '')
			{
				$error[] = $lang['INST_ERR_PASSWORD_MISMATCH'];
			}

			// Test against the default username rules
			if ($data['admin_name'] != '' && utf8_strlen($data['admin_name']) < 3)
			{
				$error[] = $lang['INST_ERR_USER_TOO_SHORT'];
			}

			if ($data['admin_name'] != '' && utf8_strlen($data['admin_name']) > 20)
			{
				$error[] = $lang['INST_ERR_USER_TOO_LONG'];
			}

			// Test against the default password rules
			if ($data['admin_pass1'] != '' && utf8_strlen($data['admin_pass1']) < 6)
			{
				$error[] = $lang['INST_ERR_PASSWORD_TOO_SHORT'];
			}

			if ($data['admin_pass1'] != '' && utf8_strlen($data['admin_pass1']) > 30)
			{
				$error[] = $lang['INST_ERR_PASSWORD_TOO_LONG'];
			}

			if ($data['board_email1'] != $data['board_email2'] && $data['board_email1'] != '')
			{
				$error[] = $lang['INST_ERR_EMAIL_MISMATCH'];
			}

			if ($data['board_email1'] != '' && !preg_match('/^' . get_preg_expression('email') . '$/i', $data['board_email1']))
			{
				$error[] = $lang['INST_ERR_EMAIL_INVALID'];
			}

			$template->assign_block_vars('checks', array(
				'S_LEGEND'			=> true,
				'LEGEND'			=> $lang['STAGE_ADMINISTRATOR'],
				'LEGEND_EXPLAIN'	=> false,
			));

			if (!sizeof($error))
			{
				$passed = true;
				$template->assign_block_vars('checks', array(
					'TITLE'		=> $lang['ADMIN_TEST'],
					'RESULT'	=> '<strong style="color:green">' . $lang['TESTS_PASSED'] . '</strong>',

					'S_EXPLAIN'	=> false,
					'S_LEGEND'	=> false,
				));
			}
			else
			{
				$template->assign_block_vars('checks', array(
					'TITLE'		=> $lang['ADMIN_TEST'],
					'RESULT'	=> '<strong style="color:red">' . implode('<br />', $error) . '</strong>',

					'S_EXPLAIN'	=> false,
					'S_LEGEND'	=> false,
				));
			}
		}

		if (!$passed)
		{
			foreach ($this->admin_config_options as $config_key => $vars)
			{
				if (!is_array($vars) && strpos($config_key, 'legend') === false)
				{
					continue;
				}

				if (strpos($config_key, 'legend') !== false)
				{
					$template->assign_block_vars('options', array(
						'S_LEGEND'		=> true,
						'LEGEND'		=> $lang[$vars])
					);

					continue;
				}

				$options = isset($vars['options']) ? $vars['options'] : '';

				$template->assign_block_vars('options', array(
					'KEY'			=> $config_key,
					'TITLE'			=> $lang[$vars['lang']],
					'S_EXPLAIN'		=> $vars['explain'],
					'S_LEGEND'		=> false,
					'TITLE_EXPLAIN'	=> ($vars['explain']) ? $lang[$vars['lang'] . '_EXPLAIN'] : '',
					'CONTENT'		=> $this->p_master->input_field($config_key, $vars['type'], $data[$config_key], $options),
					)
				);
			}
		}
		else
		{
			foreach ($this->admin_config_options as $config_key => $vars)
			{
				if (!is_array($vars))
				{
					continue;
				}
				$s_hidden_fields .= '<input type="hidden" name="' . $config_key . '" value="' . $data[$config_key] . '" />';
			}
		}

		$s_hidden_fields .= ($data['img_imagick']) ? '<input type="hidden" name="img_imagick" value="' . addslashes($data['img_imagick']) . '" />' : '';
		$s_hidden_fields .= '<input type="hidden" name="language" value="' . $data['language'] . '" />';

		foreach ($this->db_config_options as $config_key => $vars)
		{
			if (!is_array($vars))
			{
				continue;
			}
			$s_hidden_fields .= '<input type="hidden" name="' . $config_key . '" value="' . $data[$config_key] . '" />';
		}

		$submit = $lang['NEXT_STEP'];

		$url = ($passed) ? $this->p_master->module_url . "?mode=$mode&amp;sub=config_file" : $this->p_master->module_url . "?mode=$mode&amp;sub=administrator";
		$s_hidden_fields .= ($passed) ? '' : '<input type="hidden" name="check" value="true" />';

		$template->assign_vars(array(
			'L_SUBMIT'	=> $submit,
			'S_HIDDEN'	=> $s_hidden_fields,
			'U_ACTION'	=> $url,
		));
	}

	/**
	* Writes the config file to disk, or if unable to do so offers alternative methods
	*/
	function create_config_file($mode, $sub)
	{
		global $lang, $template, $phpbb_root_path, $phpEx;

		$this->page_title = $lang['STAGE_CONFIG_FILE'];

		// Obtain any submitted data
		$data = $this->get_submitted_data();

		if ($data['dbms'] == '')
		{
			// Someone's been silly and tried calling this page direct
			// So we send them back to the start to do it again properly
			$this->p_master->redirect("index.$phpEx?mode=install");
		}

		$s_hidden_fields = ($data['img_imagick']) ? '<input type="hidden" name="img_imagick" value="' . addslashes($data['img_imagick']) . '" />' : '';
		$s_hidden_fields .= '<input type="hidden" name="language" value="' . $data['language'] . '" />';
		$written = false;

		// Create a list of any PHP modules we wish to have loaded
		$load_extensions = array();
		$available_dbms = get_available_dbms($data['dbms']);
		$check_exts = array_merge(array($available_dbms[$data['dbms']]['MODULE']), $this->php_dlls_other);

		foreach ($check_exts as $dll)
		{
			if (!@extension_loaded($dll))
			{
				if (!can_load_dll($dll))
				{
					continue;
				}

				$load_extensions[] = $dll . '.' . PHP_SHLIB_SUFFIX;
			}
		}

		// Create a lock file to indicate that there is an install in progress
		$fp = @fopen($phpbb_root_path . 'cache/install_lock', 'wb');
		if ($fp === false)
		{
			// We were unable to create the lock file - abort
			$this->p_master->error($lang['UNABLE_WRITE_LOCK'], __LINE__, __FILE__);
		}
		@fclose($fp);

		@chmod($phpbb_root_path . 'cache/install_lock', 0777);

		// Time to convert the data provided into a config file
		$config_data = phpbb_create_config_file_data($data, $available_dbms[$data['dbms']]['DRIVER'], $load_extensions);

		// Attempt to write out the config file directly. If it works, this is the easiest way to do it ...
		if ((file_exists($phpbb_root_path . 'config.' . $phpEx) && phpbb_is_writable($phpbb_root_path . 'config.' . $phpEx)) || phpbb_is_writable($phpbb_root_path))
		{
			// Assume it will work ... if nothing goes wrong below
			$written = true;

			if (!($fp = @fopen($phpbb_root_path . 'config.' . $phpEx, 'w')))
			{
				// Something went wrong ... so let's try another method
				$written = false;
			}

			if (!(@fwrite($fp, $config_data)))
			{
				// Something went wrong ... so let's try another method
				$written = false;
			}

			@fclose($fp);

			if ($written)
			{
				// We may revert back to chmod() if we see problems with users not able to change their config.php file directly
				phpbb_chmod($phpbb_root_path . 'config.' . $phpEx, CHMOD_READ);
			}
		}

		if (isset($_POST['dldone']))
		{
			// Do a basic check to make sure that the file has been uploaded
			// Note that all we check is that the file has _something_ in it
			// We don't compare the contents exactly - if they can't upload
			// a single file correctly, it's likely they will have other problems....
			if (filesize($phpbb_root_path . 'config.' . $phpEx) > 10)
			{
				$written = true;
			}
		}

		$config_options = array_merge($this->db_config_options, $this->admin_config_options);

		foreach ($config_options as $config_key => $vars)
		{
			if (!is_array($vars))
			{
				continue;
			}
			$s_hidden_fields .= '<input type="hidden" name="' . $config_key . '" value="' . $data[$config_key] . '" />';
		}

		if (!$written)
		{
			// OK, so it didn't work let's try the alternatives

			if (isset($_POST['dlconfig']))
			{
				// They want a copy of the file to download, so send the relevant headers and dump out the data
				header("Content-Type: text/x-delimtext; name=\"config.$phpEx\"");
				header("Content-disposition: attachment; filename=config.$phpEx");
				echo $config_data;
				exit;
			}

			// The option to download the config file is always available, so output it here
			$template->assign_vars(array(
				'BODY'					=> $lang['CONFIG_FILE_UNABLE_WRITE'],
				'L_DL_CONFIG'			=> $lang['DL_CONFIG'],
				'L_DL_CONFIG_EXPLAIN'	=> $lang['DL_CONFIG_EXPLAIN'],
				'L_DL_DONE'				=> $lang['DONE'],
				'L_DL_DOWNLOAD'			=> $lang['DL_DOWNLOAD'],
				'S_HIDDEN'				=> $s_hidden_fields,
				'S_SHOW_DOWNLOAD'		=> true,
				'U_ACTION'				=> $this->p_master->module_url . "?mode=$mode&amp;sub=config_file",
			));
			return;
		}
		else
		{
			$template->assign_vars(array(
				'BODY'		=> $lang['CONFIG_FILE_WRITTEN'],
				'L_SUBMIT'	=> $lang['NEXT_STEP'],
				'S_HIDDEN'	=> $s_hidden_fields,
				'U_ACTION'	=> $this->p_master->module_url . "?mode=$mode&amp;sub=advanced",
			));
			return;
		}
	}

	/**
	* Provide an opportunity to customise some advanced settings during the install
	* in case it is necessary for them to be set to access later
	*/
	function obtain_advanced_settings($mode, $sub)
	{
		global $lang, $template, $phpEx;

		$this->page_title = $lang['STAGE_ADVANCED'];

		// Obtain any submitted data
		$data = $this->get_submitted_data();

		if ($data['dbms'] == '')
		{
			// Someone's been silly and tried calling this page direct
			// So we send them back to the start to do it again properly
			$this->p_master->redirect("index.$phpEx?mode=install");
		}

		$s_hidden_fields = ($data['img_imagick']) ? '<input type="hidden" name="img_imagick" value="' . addslashes($data['img_imagick']) . '" />' : '';
		$s_hidden_fields .= '<input type="hidden" name="language" value="' . $data['language'] . '" />';

		// HTTP_HOST is having the correct browser url in most cases...
		$server_name = (!empty($_SERVER['HTTP_HOST'])) ? strtolower($_SERVER['HTTP_HOST']) : ((!empty($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : getenv('SERVER_NAME'));

		// HTTP HOST can carry a port number...
		if (strpos($server_name, ':') !== false)
		{
			$server_name = substr($server_name, 0, strpos($server_name, ':'));
		}

		$data['email_enable'] = ($data['email_enable'] !== '') ? $data['email_enable'] : true;
		$data['server_name'] = ($data['server_name'] !== '') ? $data['server_name'] : $server_name;
		$data['server_port'] = ($data['server_port'] !== '') ? $data['server_port'] : ((!empty($_SERVER['SERVER_PORT'])) ? (int) $_SERVER['SERVER_PORT'] : (int) getenv('SERVER_PORT'));
		$data['server_protocol'] = ($data['server_protocol'] !== '') ? $data['server_protocol'] : ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://');
		$data['cookie_secure'] = ($data['cookie_secure'] !== '') ? $data['cookie_secure'] : ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? true : false);

		if ($data['script_path'] === '')
		{
			$name = (!empty($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : getenv('PHP_SELF');
			if (!$name)
			{
				$name = (!empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
			}

			// Replace backslashes and doubled slashes (could happen on some proxy setups)
			$name = str_replace(array('\\', '//'), '/', $name);
			$data['script_path'] = trim(dirname(dirname($name)));
		}

		foreach ($this->advanced_config_options as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> $lang[$vars])
				);

				continue;
			}

			$options = isset($vars['options']) ? $vars['options'] : '';

			$template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> $lang[$vars['lang']],
				'S_EXPLAIN'		=> $vars['explain'],
				'S_LEGEND'		=> false,
				'TITLE_EXPLAIN'	=> ($vars['explain']) ? $lang[$vars['lang'] . '_EXPLAIN'] : '',
				'CONTENT'		=> $this->p_master->input_field($config_key, $vars['type'], $data[$config_key], $options),
				)
			);
		}

		$config_options = array_merge($this->db_config_options, $this->admin_config_options);
		foreach ($config_options as $config_key => $vars)
		{
			if (!is_array($vars))
			{
				continue;
			}
			$s_hidden_fields .= '<input type="hidden" name="' . $config_key . '" value="' . $data[$config_key] . '" />';
		}

		$submit = $lang['NEXT_STEP'];

		$url = $this->p_master->module_url . "?mode=$mode&amp;sub=create_table";

		$template->assign_vars(array(
			'BODY'		=> $lang['STAGE_ADVANCED_EXPLAIN'],
			'L_SUBMIT'	=> $submit,
			'S_HIDDEN'	=> $s_hidden_fields,
			'U_ACTION'	=> $url,
		));
	}

	/**
	* Load the contents of the schema into the database and then alter it based on what has been input during the installation
	*/
	function load_schema($mode, $sub)
	{
		global $db, $lang, $template, $phpbb_root_path, $phpEx;

		$this->page_title = $lang['STAGE_CREATE_TABLE'];
		$s_hidden_fields = '';

		// Obtain any submitted data
		$data = $this->get_submitted_data();

		if ($data['dbms'] == '')
		{
			// Someone's been silly and tried calling this page direct
			// So we send them back to the start to do it again properly
			$this->p_master->redirect("index.$phpEx?mode=install");
		}

		// HTTP_HOST is having the correct browser url in most cases...
		$server_name = (!empty($_SERVER['HTTP_HOST'])) ? strtolower($_SERVER['HTTP_HOST']) : ((!empty($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : getenv('SERVER_NAME'));
		$referer = (!empty($_SERVER['HTTP_REFERER'])) ? strtolower($_SERVER['HTTP_REFERER']) : getenv('HTTP_REFERER');

		// HTTP HOST can carry a port number...
		if (strpos($server_name, ':') !== false)
		{
			$server_name = substr($server_name, 0, strpos($server_name, ':'));
		}

		$cookie_domain = ($data['server_name'] != '') ? $data['server_name'] : $server_name;

		// Try to come up with the best solution for cookie domain...
		if (strpos($cookie_domain, 'www.') === 0)
		{
			$cookie_domain = str_replace('www.', '.', $cookie_domain);
		}

		// If we get here and the extension isn't loaded it should be safe to just go ahead and load it
		$available_dbms = get_available_dbms($data['dbms']);

		if (!isset($available_dbms[$data['dbms']]))
		{
			// Someone's been silly and tried providing a non-existant dbms
			$this->p_master->redirect("index.$phpEx?mode=install");
		}

		$dbms = $available_dbms[$data['dbms']]['DRIVER'];

		// Load the appropriate database class if not already loaded
		include($phpbb_root_path . 'includes/db/' . $dbms . '.' . $phpEx);

		// Instantiate the database
		$db = new $sql_db();
		$db->sql_connect($data['dbhost'], $data['dbuser'], htmlspecialchars_decode($data['dbpasswd'], ENT_COMPAT), $data['dbname'], $data['dbport'], false, false);

		// NOTE: trigger_error does not work here.
		$db->sql_return_on_error(true);

		// If mysql is chosen, we need to adjust the schema filename slightly to reflect the correct version. ;)
		if ($data['dbms'] == 'mysql')
		{
			if (version_compare($db->sql_server_info(true), '4.1.3', '>='))
			{
				$available_dbms[$data['dbms']]['SCHEMA'] .= '_41';
			}
			else
			{
				$available_dbms[$data['dbms']]['SCHEMA'] .= '_40';
			}
		}

		// Ok we have the db info go ahead and read in the relevant schema
		// and work on building the table
		$dbms_schema = 'schemas/' . $available_dbms[$data['dbms']]['SCHEMA'] . '_schema.sql';

		// How should we treat this schema?
		$delimiter = $available_dbms[$data['dbms']]['DELIM'];

		$sql_query = @file_get_contents($dbms_schema);

		$sql_query = preg_replace('#phpbb_#i', $data['table_prefix'], $sql_query);

		$sql_query = phpbb_remove_comments($sql_query);

		$sql_query = split_sql_file($sql_query, $delimiter);

		foreach ($sql_query as $sql)
		{
			//$sql = trim(str_replace('|', ';', $sql));
			if (!$db->sql_query($sql))
			{
				$error = $db->sql_error();
				$this->p_master->db_error($error['message'], $sql, __LINE__, __FILE__);
			}
		}
		unset($sql_query);

		// Ok tables have been built, let's fill in the basic information
		$sql_query = file_get_contents('schemas/schema_data.sql');

		// Deal with any special comments
		switch ($data['dbms'])
		{
			case 'mssql':
			case 'mssql_odbc':
			case 'mssqlnative':
				$sql_query = preg_replace('#\# MSSQL IDENTITY (phpbb_[a-z_]+) (ON|OFF) \##s', 'SET IDENTITY_INSERT \1 \2;', $sql_query);
			break;

			case 'postgres':
				$sql_query = preg_replace('#\# POSTGRES (BEGIN|COMMIT) \##s', '\1; ', $sql_query);
			break;
		}

		// Change prefix
		$sql_query = preg_replace('# phpbb_([^\s]*) #i', ' ' . $data['table_prefix'] . '\1 ', $sql_query);

		// Change language strings...
		$sql_query = preg_replace_callback('#\{L_([A-Z0-9\-_]*)\}#s', 'adjust_language_keys_callback', $sql_query);

		$sql_query = phpbb_remove_comments($sql_query);
		$sql_query = split_sql_file($sql_query, ';');

		foreach ($sql_query as $sql)
		{
			//$sql = trim(str_replace('|', ';', $sql));
			if (!$db->sql_query($sql))
			{
				$error = $db->sql_error();
				$this->p_master->db_error($error['message'], $sql, __LINE__, __FILE__);
			}
		}
		unset($sql_query);

		$current_time = time();

		$user_ip = (!empty($_SERVER['REMOTE_ADDR'])) ? htmlspecialchars($_SERVER['REMOTE_ADDR'], ENT_COMPAT) : '';
		$user_ip = (stripos($user_ip, '::ffff:') === 0) ? substr($user_ip, 7) : $user_ip;

		if ($data['script_path'] !== '/')
		{
			// Adjust destination path (no trailing slash)
			if (substr($data['script_path'], -1) == '/')
			{
				$data['script_path'] = substr($data['script_path'], 0, -1);
			}

			$data['script_path'] = str_replace(array('../', './'), '', $data['script_path']);

			if ($data['script_path'][0] != '/')
			{
				$data['script_path'] = '/' . $data['script_path'];
			}
		}

		// Set default config and post data, this applies to all DB's
		$sql_ary = array(
			'INSERT INTO ' . $data['table_prefix'] . "config (config_name, config_value)
				VALUES ('board_startdate', '$current_time')",

			'INSERT INTO ' . $data['table_prefix'] . "config (config_name, config_value)
				VALUES ('default_lang', '" . $db->sql_escape($data['default_lang']) . "')",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['img_imagick']) . "'
				WHERE config_name = 'img_imagick'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['server_name']) . "'
				WHERE config_name = 'server_name'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['server_port']) . "'
				WHERE config_name = 'server_port'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['board_email1']) . "'
				WHERE config_name = 'board_email'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['board_email1']) . "'
				WHERE config_name = 'board_contact'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($cookie_domain) . "'
				WHERE config_name = 'cookie_domain'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($lang['default_dateformat']) . "'
				WHERE config_name = 'default_dateformat'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['email_enable']) . "'
				WHERE config_name = 'email_enable'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['smtp_delivery']) . "'
				WHERE config_name = 'smtp_delivery'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['smtp_host']) . "'
				WHERE config_name = 'smtp_host'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['smtp_auth']) . "'
				WHERE config_name = 'smtp_auth_method'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['smtp_user']) . "'
				WHERE config_name = 'smtp_username'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['smtp_pass']) . "'
				WHERE config_name = 'smtp_password'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['cookie_secure']) . "'
				WHERE config_name = 'cookie_secure'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['force_server_vars']) . "'
				WHERE config_name = 'force_server_vars'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['script_path']) . "'
				WHERE config_name = 'script_path'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['server_protocol']) . "'
				WHERE config_name = 'server_protocol'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($data['admin_name']) . "'
				WHERE config_name = 'newest_username'",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . md5(mt_rand()) . "'
				WHERE config_name = 'avatar_salt'",

			'UPDATE ' . $data['table_prefix'] . "users
				SET username = '" . $db->sql_escape($data['admin_name']) . "', user_password='" . $db->sql_escape(md5($data['admin_pass1'])) . "', user_ip = '" . $db->sql_escape($user_ip) . "', user_lang = '" . $db->sql_escape($data['default_lang']) . "', user_email='" . $db->sql_escape($data['board_email1']) . "', user_dateformat='" . $db->sql_escape($lang['default_dateformat']) . "', user_email_hash = " . $db->sql_escape(phpbb_email_hash($data['board_email1'])) . ", username_clean = '" . $db->sql_escape(utf8_clean_string($data['admin_name'])) . "'
				WHERE username = 'Admin'",

			'UPDATE ' . $data['table_prefix'] . "moderator_cache
				SET username = '" . $db->sql_escape($data['admin_name']) . "'
				WHERE username = 'Admin'",

			'UPDATE ' . $data['table_prefix'] . "forums
				SET forum_last_poster_name = '" . $db->sql_escape($data['admin_name']) . "'
				WHERE forum_last_poster_name = 'Admin'",

			'UPDATE ' . $data['table_prefix'] . "topics
				SET topic_first_poster_name = '" . $db->sql_escape($data['admin_name']) . "', topic_last_poster_name = '" . $db->sql_escape($data['admin_name']) . "'
				WHERE topic_first_poster_name = 'Admin'
					OR topic_last_poster_name = 'Admin'",

			'UPDATE ' . $data['table_prefix'] . "users
				SET user_regdate = $current_time",

			'UPDATE ' . $data['table_prefix'] . "posts
				SET post_time = $current_time, poster_ip = '" . $db->sql_escape($user_ip) . "'",

			'UPDATE ' . $data['table_prefix'] . "topics
				SET topic_time = $current_time, topic_last_post_time = $current_time",

			'UPDATE ' . $data['table_prefix'] . "forums
				SET forum_last_post_time = $current_time",

			'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '" . $db->sql_escape($db->sql_server_info(true)) . "'
				WHERE config_name = 'dbms_version'",
		);

		$ref = substr($referer, strpos($referer, '://') + 3);

		if (!(stripos($ref, $server_name) === 0))
		{
			$sql_ary[] = 'UPDATE ' . $data['table_prefix'] . "config
				SET config_value = '0'
				WHERE config_name = 'referer_validation'";
		}

		// We set a (semi-)unique cookie name to bypass login issues related to the cookie name.
		$cookie_name = 'imod3_';
		$rand_str = md5(mt_rand());
		$rand_str = str_replace('0', 'z', base_convert($rand_str, 16, 35));
		$rand_str = substr($rand_str, 0, 5);
		$cookie_name .= strtolower($rand_str);

		$sql_ary[] = 'UPDATE ' . $data['table_prefix'] . "config
			SET config_value = '" . $db->sql_escape($cookie_name) . "'
			WHERE config_name = 'cookie_name'";

		foreach ($sql_ary as $sql)
		{
			//$sql = trim(str_replace('|', ';', $sql));

			if (!$db->sql_query($sql))
			{
				$error = $db->sql_error();
				$this->p_master->db_error($error['message'], $sql, __LINE__, __FILE__);
			}
		}

		$submit = $lang['NEXT_STEP'];

		$url = $this->p_master->module_url . "?mode=$mode&amp;sub=final";

		$template->assign_vars(array(
			'BODY'		=> $lang['STAGE_CREATE_TABLE_EXPLAIN'],
			'L_SUBMIT'	=> $submit,
			'S_HIDDEN'	=> build_hidden_fields($data),
			'U_ACTION'	=> $url,
		));
	}

	/**
	* Build the search index...
	*/
	function build_search_index($mode, $sub)
	{
		global $db, $lang, $phpbb_root_path, $phpEx, $config;

		// Obtain any submitted data
		$data = $this->get_submitted_data();
		$table_prefix = $data['table_prefix'];

		// If we get here and the extension isn't loaded it should be safe to just go ahead and load it
		$available_dbms = get_available_dbms($data['dbms']);

		if (!isset($available_dbms[$data['dbms']]))
		{
			// Someone's been silly and tried providing a non-existant dbms
			$this->p_master->redirect("index.$phpEx?mode=install");
		}

		$dbms = $available_dbms[$data['dbms']]['DRIVER'];

		// Load the appropriate database class if not already loaded
		include($phpbb_root_path . 'includes/db/' . $dbms . '.' . $phpEx);

		// Instantiate the database
		$db = new $sql_db();
		$db->sql_connect($data['dbhost'], $data['dbuser'], htmlspecialchars_decode($data['dbpasswd'], ENT_COMPAT), $data['dbname'], $data['dbport'], false, false);

		// NOTE: trigger_error does not work here.
		$db->sql_return_on_error(true);

		include_once($phpbb_root_path . 'includes/constants.' . $phpEx);
		include_once($phpbb_root_path . 'includes/search/fulltext_native.' . $phpEx);

		// Fill the config array - it is needed by those functions we call
		$sql = 'SELECT *
			FROM ' . CONFIG_TABLE;
		$result = $db->sql_query($sql);

		$config = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$config[$row['config_name']] = $row['config_value'];
		}
		$db->sql_freeresult($result);

		$error = false;
		$search = new fulltext_native($error);

		$sql = 'SELECT post_id, post_subject, post_text, poster_id, forum_id
			FROM ' . POSTS_TABLE;
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$search->index('post', $row['post_id'], $row['post_text'], $row['post_subject'], $row['poster_id'], $row['forum_id']);
		}
		$db->sql_freeresult($result);
	}

	/**
	* Populate the module tables
	*/
	function add_modules($mode, $sub)
	{
		global $db, $lang, $phpbb_root_path, $phpEx;

		include_once($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);

		$_module = new acp_modules();
		$module_classes = array('acp', 'mcp', 'ucp');

		// Add categories
		foreach ($module_classes as $module_class)
		{
			$categories = array();

			// Set the module class
			$_module->module_class = $module_class;

			foreach ($this->module_categories[$module_class] as $cat_name => $subs)
			{
				$module_data = array(
					'module_basename'	=> '',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> 0,
					'module_class'		=> $module_class,
					'module_langname'	=> $cat_name,
					'module_mode'		=> '',
					'module_auth'		=> '',
				);

				// Add category
				$_module->update_module_data($module_data, true);

				// Check for last sql error happened
				if ($db->sql_error_triggered)
				{
					$error = $db->sql_error($db->sql_error_sql);
					$this->p_master->db_error($error['message'], $db->sql_error_sql, __LINE__, __FILE__);
				}

				$categories[$cat_name]['id'] = (int) $module_data['module_id'];
				$categories[$cat_name]['parent_id'] = 0;

				// Create sub-categories...
				if (is_array($subs))
				{
					foreach ($subs as $level2_name)
					{
						$module_data = array(
							'module_basename'	=> '',
							'module_enabled'	=> 1,
							'module_display'	=> 1,
							'parent_id'			=> (int) $categories[$cat_name]['id'],
							'module_class'		=> $module_class,
							'module_langname'	=> $level2_name,
							'module_mode'		=> '',
							'module_auth'		=> '',
						);

						$_module->update_module_data($module_data, true);

						// Check for last sql error happened
						if ($db->sql_error_triggered)
						{
							$error = $db->sql_error($db->sql_error_sql);
							$this->p_master->db_error($error['message'], $db->sql_error_sql, __LINE__, __FILE__);
						}

						$categories[$level2_name]['id'] = (int) $module_data['module_id'];
						$categories[$level2_name]['parent_id'] = (int) $categories[$cat_name]['id'];
					}
				}
			}

			// Get the modules we want to add... returned sorted by name
			$module_info = $_module->get_module_infos('', $module_class);

			foreach ($module_info as $module_basename => $fileinfo)
			{
				foreach ($fileinfo['modes'] as $module_mode => $row)
				{
					foreach ($row['cat'] as $cat_name)
					{
						if (!isset($categories[$cat_name]))
						{
							continue;
						}

						$module_data = array(
							'module_basename'	=> $module_basename,
							'module_enabled'	=> 1,
							'module_display'	=> (isset($row['display'])) ? (int) $row['display'] : 1,
							'parent_id'			=> (int) $categories[$cat_name]['id'],
							'module_class'		=> $module_class,
							'module_langname'	=> $row['title'],
							'module_mode'		=> $module_mode,
							'module_auth'		=> $row['auth'],
						);

						$_module->update_module_data($module_data, true);

						// Check for last sql error happened
						if ($db->sql_error_triggered)
						{
							$error = $db->sql_error($db->sql_error_sql);
							$this->p_master->db_error($error['message'], $db->sql_error_sql, __LINE__, __FILE__);
						}
					}
				}
			}

			// Move some of the modules around since the code above will put them in the wrong place
			if ($module_class == 'acp')
			{
				// Move main module 4 up...
				$sql = 'SELECT *
					FROM ' . MODULES_TABLE . "
					WHERE module_basename = 'main'
						AND module_class = 'acp'
						AND module_mode = 'main'";
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$_module->move_module_by($row, 'move_up', 4);

				// Move permissions intro screen module 4 up...
				$sql = 'SELECT *
					FROM ' . MODULES_TABLE . "
					WHERE module_basename = 'permissions'
						AND module_class = 'acp'
						AND module_mode = 'intro'";
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$_module->move_module_by($row, 'move_up', 4);

				// Move manage users screen module 5 up...
				$sql = 'SELECT *
					FROM ' . MODULES_TABLE . "
					WHERE module_basename = 'users'
						AND module_class = 'acp'
						AND module_mode = 'overview'";
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$_module->move_module_by($row, 'move_up', 5);
			}

			if ($module_class == 'mcp')
			{
				// Move pm report details module 3 down...
				$sql = 'SELECT *
					FROM ' . MODULES_TABLE . "
					WHERE module_basename = 'pm_reports'
						AND module_class = 'mcp'
						AND module_mode = 'pm_report_details'";
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$_module->move_module_by($row, 'move_down', 3);

				// Move closed pm reports module 3 down...
				$sql = 'SELECT *
					FROM ' . MODULES_TABLE . "
					WHERE module_basename = 'pm_reports'
						AND module_class = 'mcp'
						AND module_mode = 'pm_reports_closed'";
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$_module->move_module_by($row, 'move_down', 3);

				// Move open pm reports module 3 down...
				$sql = 'SELECT *
					FROM ' . MODULES_TABLE . "
					WHERE module_basename = 'pm_reports'
						AND module_class = 'mcp'
						AND module_mode = 'pm_reports'";
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$_module->move_module_by($row, 'move_down', 3);
			}

			if ($module_class == 'ucp')
			{
				// Move attachment module 4 down...
				$sql = 'SELECT *
					FROM ' . MODULES_TABLE . "
					WHERE module_basename = 'attachments'
						AND module_class = 'ucp'
						AND module_mode = 'attachments'";
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$_module->move_module_by($row, 'move_down', 4);
			}

			// And now for the special ones
			// (these are modules which appear in multiple categories and thus get added manually to some for more control)
			if (isset($this->module_extras[$module_class]))
			{
				foreach ($this->module_extras[$module_class] as $cat_name => $mods)
				{
					$sql = 'SELECT module_id, left_id, right_id
						FROM ' . MODULES_TABLE . "
						WHERE module_langname = '" . $db->sql_escape($cat_name) . "'
							AND module_class = '" . $db->sql_escape($module_class) . "'";
					$result = $db->sql_query_limit($sql, 1);
					$row2 = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					foreach ($mods as $mod_name)
					{
						$sql = 'SELECT *
							FROM ' . MODULES_TABLE . "
							WHERE module_langname = '" . $db->sql_escape($mod_name) . "'
								AND module_class = '" . $db->sql_escape($module_class) . "'
								AND module_basename <> ''";
						$result = $db->sql_query_limit($sql, 1);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

						$module_data = array(
							'module_basename'	=> $row['module_basename'],
							'module_enabled'	=> (int) $row['module_enabled'],
							'module_display'	=> (int) $row['module_display'],
							'parent_id'			=> (int) $row2['module_id'],
							'module_class'		=> $row['module_class'],
							'module_langname'	=> $row['module_langname'],
							'module_mode'		=> $row['module_mode'],
							'module_auth'		=> $row['module_auth'],
						);

						$_module->update_module_data($module_data, true);

						// Check for last sql error happened
						if ($db->sql_error_triggered)
						{
							$error = $db->sql_error($db->sql_error_sql);
							$this->p_master->db_error($error['message'], $db->sql_error_sql, __LINE__, __FILE__);
						}
					}
				}
			}

			$_module->remove_cache_file();
		}
	}

	/**
	* Populate the language tables
	*/
	function add_language($mode, $sub)
	{
		global $db, $lang, $phpbb_root_path, $phpEx;

		$dir = @opendir($phpbb_root_path . 'language');

		if (!$dir)
		{
			$this->error('Unable to access the language directory', __LINE__, __FILE__);
		}

		while (($file = readdir($dir)) !== false)
		{
			$path = $phpbb_root_path . 'language/' . $file;

			if ($file == '.' || $file == '..' || is_link($path) || is_file($path) || $file == 'CVS')
			{
				continue;
			}

			if (is_dir($path) && file_exists($path . '/iso.txt'))
			{
				$lang_file = file("$path/iso.txt");

				$lang_pack = array(
					'lang_iso'			=> basename($path),
					'lang_dir'			=> basename($path),
					'lang_english_name'	=> trim(htmlspecialchars($lang_file[0], ENT_COMPAT)),
					'lang_local_name'	=> trim(htmlspecialchars($lang_file[1], ENT_COMPAT, 'UTF-8')),
					'lang_author'		=> trim(htmlspecialchars($lang_file[2], ENT_COMPAT, 'UTF-8')),
				);

				$db->sql_query('INSERT INTO ' . LANG_TABLE . ' ' . $db->sql_build_array('INSERT', $lang_pack));

				if ($db->sql_error_triggered)
				{
					$error = $db->sql_error($db->sql_error_sql);
					$this->p_master->db_error($error['message'], $db->sql_error_sql, __LINE__, __FILE__);
				}

				$valid_localized = array(
					'icon_back_top', 'icon_contact_aim', 'icon_contact_email', 'icon_contact_icq', 'icon_contact_jabber', 'icon_contact_msnm', 'icon_contact_pm', 'icon_contact_yahoo', 'icon_contact_www', 'icon_post_delete', 'icon_post_edit', 'icon_post_info', 'icon_post_quote', 'icon_post_report', 'icon_user_online', 'icon_user_offline', 'icon_user_profile', 'icon_user_search', 'icon_user_warn', 'button_pm_forward', 'button_pm_new', 'button_pm_reply', 'button_topic_locked', 'button_topic_new', 'button_topic_reply',
				);

				$sql_ary = array();

				$sql = 'SELECT *
					FROM ' . STYLES_IMAGESET_TABLE;
				$result = $db->sql_query($sql);

				while ($imageset_row = $db->sql_fetchrow($result))
				{
					if (@file_exists("{$phpbb_root_path}styles/{$imageset_row['imageset_path']}/imageset/{$lang_pack['lang_iso']}/imageset.cfg"))
					{
						$cfg_data_imageset_data = parse_cfg_file("{$phpbb_root_path}styles/{$imageset_row['imageset_path']}/imageset/{$lang_pack['lang_iso']}/imageset.cfg");
						foreach ($cfg_data_imageset_data as $image_name => $value)
						{
							if (strpos($value, '*') !== false)
							{
								if (substr($value, -1, 1) === '*')
								{
									list($image_filename, $image_height) = explode('*', $value);
									$image_width = 0;
								}
								else
								{
									list($image_filename, $image_height, $image_width) = explode('*', $value);
								}
							}
							else
							{
								$image_filename = $value;
								$image_height = $image_width = 0;
							}

							if (strpos($image_name, 'img_') === 0 && $image_filename)
							{
								$image_name = substr($image_name, 4);
								if (in_array($image_name, $valid_localized))
								{
									$sql_ary[] = array(
										'image_name'		=> (string) $image_name,
										'image_filename'	=> (string) $image_filename,
										'image_height'		=> (int) $image_height,
										'image_width'		=> (int) $image_width,
										'imageset_id'		=> (int) $imageset_row['imageset_id'],
										'image_lang'		=> (string) $lang_pack['lang_iso'],
									);
								}
							}
						}
					}
				}
				$db->sql_freeresult($result);

				if (sizeof($sql_ary))
				{
					$db->sql_multi_insert(STYLES_IMAGESET_DATA_TABLE, $sql_ary);

					if ($db->sql_error_triggered)
					{
						$error = $db->sql_error($db->sql_error_sql);
						$this->p_master->db_error($error['message'], $db->sql_error_sql, __LINE__, __FILE__);
					}
				}
			}
		}
		closedir($dir);
	}

	/**
	* Add search robots to the database
	*/
	function add_bots($mode, $sub)
	{
		global $db, $lang, $phpbb_root_path, $phpEx, $config;

		// Obtain any submitted data
		$data = $this->get_submitted_data();

		// Fill the config array - it is needed by those functions we call
		$sql = 'SELECT *
			FROM ' . CONFIG_TABLE;
		$result = $db->sql_query($sql);

		$config = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$config[$row['config_name']] = $row['config_value'];
		}
		$db->sql_freeresult($result);

		$sql = 'SELECT group_id
			FROM ' . GROUPS_TABLE . "
			WHERE group_name = 'BOTS'";
		$result = $db->sql_query($sql);
		$group_id = (int) $db->sql_fetchfield('group_id');
		$db->sql_freeresult($result);

		if (!$group_id)
		{
			// If we reach this point then something has gone very wrong
			$this->p_master->error($lang['NO_GROUP'], __LINE__, __FILE__);
		}

		if (!function_exists('user_add'))
		{
			include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
		}

		foreach ($this->bot_list as $bot_name => $bot_ary)
		{
			$user_row = array(
				'user_type'				=> USER_IGNORE,
				'group_id'				=> $group_id,
				'username'				=> $bot_name,
				'user_regdate'			=> time(),
				'user_password'			=> '',
				'user_colour'			=> '9E8DA7',
				'user_email'			=> '',
				'user_lang'				=> $data['default_lang'],
				'user_style'			=> 1,
				'user_timezone'			=> 0,
				'user_dateformat'		=> $lang['default_dateformat'],
				'user_allow_massemail'	=> 0,
				'user_allow_pm'			=> 0,
				'user_points'			=> 0,
			);

			$user_id = user_add($user_row);

			if (!$user_id)
			{
				// If we can't insert this user then continue to the next one to avoid inconsistent data
				$this->p_master->db_error('Unable to insert bot into users table', $db->sql_error_sql, __LINE__, __FILE__, true);
				continue;
			}

			$sql = 'INSERT INTO ' . BOTS_TABLE . ' ' . $db->sql_build_array('INSERT', array(
				'bot_active'	=> 1,
				'bot_name'		=> (string) $bot_name,
				'user_id'		=> (int) $user_id,
				'bot_agent'		=> (string) $bot_ary[0],
				'bot_ip'		=> (string) $bot_ary[1],
			));

			$result = $db->sql_query($sql);
		}
	}

	/**
	* Sends an email to the board administrator with their password and some useful links
	*/
	function email_admin($mode, $sub)
	{
		global $auth, $config, $db, $lang, $template, $user, $phpbb_root_path, $phpEx;

		$this->page_title = $lang['STAGE_FINAL'];

		// Obtain any submitted data
		$data = $this->get_submitted_data();

		$sql = 'SELECT *
			FROM ' . CONFIG_TABLE;
		$result = $db->sql_query($sql);

		$config = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$config[$row['config_name']] = $row['config_value'];
		}
		$db->sql_freeresult($result);

		define('CAPTCHA_QUESTIONS_TABLE',	$data['table_prefix'] . 'captcha_questions');
		define('CAPTCHA_ANSWERS_TABLE',		$data['table_prefix'] . 'captcha_answers');
		define('CAPTCHA_QA_CONFIRM_TABLE',	$data['table_prefix'] . 'qa_confirm');
		$this->captcha_qa_install();

		$user->session_begin();
		$auth->login($data['admin_name'], $data['admin_pass1'], false, true, true);

		// OK, Now that we've reached this point we can be confident that everything
		// is installed and working......I hope :)
		// So it's time to send an email to the administrator confirming the details
		// they entered

		if ($config['email_enable'])
		{
			include_once($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);

			$messenger = new messenger(false);

			$messenger->template('installed', $data['language']);

			$messenger->to($data['board_email1'], $data['admin_name']);

			$messenger->anti_abuse_headers($config, $user);

			$messenger->assign_vars(array(
				'USERNAME'		=> htmlspecialchars_decode($data['admin_name'], ENT_COMPAT),
				'PASSWORD'		=> htmlspecialchars_decode($data['admin_pass1'], ENT_COMPAT))
			);

			$messenger->send(NOTIFY_EMAIL);
		}

		// And finally, add a note to the log
		add_log('admin', 'LOG_INSTALL_INSTALLED', $config['version']);

		$template->assign_vars(array(
			'TITLE'		=> $lang['INSTALL_CONGRATS'],
			'BODY'		=> sprintf($lang['INSTALL_CONGRATS_EXPLAIN'], $config['version'], append_sid($phpbb_root_path . 'install/index.' . $phpEx, 'mode=convert&amp;language=' . $data['language']), '../docs/README.html'),
			'L_SUBMIT'	=> $lang['INSTALL_LOGIN'],
			'U_ACTION'	=> append_sid($phpbb_root_path . 'adm/index.' . $phpEx),
		));
	}

	function captcha_qa_install()
	{
		global $db, $phpbb_root_path, $phpEx;

		if (!class_exists('phpbb_db_tools'))
		{
			include("$phpbb_root_path/includes/db/db_tools.$phpEx");
		}
		$db_tool = new phpbb_db_tools($db);

		$tables = array(CAPTCHA_QUESTIONS_TABLE, CAPTCHA_ANSWERS_TABLE, CAPTCHA_QA_CONFIRM_TABLE);

		$schemas = array(
			CAPTCHA_QUESTIONS_TABLE => array (
				'COLUMNS' => array(
					'question_id'	=> array('UINT', Null, 'auto_increment'),
					'strict'		=> array('BOOL', 0),
					'lang_id'		=> array('UINT', 0),
					'lang_iso'		=> array('VCHAR:30', ''),
					'question_text'	=> array('TEXT_UNI', ''),
				),
				'PRIMARY_KEY' => 'question_id',
				'KEYS' => array(
					'lang'			=> array('INDEX', 'lang_iso'),
				),
			),
			CAPTCHA_ANSWERS_TABLE => array (
				'COLUMNS' => array(
					'question_id'	=> array('UINT', 0),
					'answer_text'	=> array('STEXT_UNI', ''),
				),
				'KEYS' => array(
					'qid'			=> array('INDEX', 'question_id'),
				),
			),
			CAPTCHA_QA_CONFIRM_TABLE => array (
				'COLUMNS' => array(
					'session_id'	=> array('CHAR:32', ''),
					'confirm_id'	=> array('CHAR:32', ''),
					'lang_iso'		=> array('VCHAR:30', ''),
					'question_id'	=> array('UINT', 0),
					'attempts'		=> array('UINT', 0),
					'confirm_type'	=> array('USINT', 0),
				),
				'PRIMARY_KEY' => 'confirm_id',
				'KEYS' => array(
					'session_id'	=> array('INDEX', 'session_id'),
					'lookup'		=> array('INDEX', array('confirm_id', 'session_id', 'lang_iso')),
				),
			),
		);

		foreach($schemas as $table => $schema)
		{
			if (!$db_tool->sql_table_exists($table))
			{
				$db_tool->sql_create_table($table, $schema);
			}
		}
	}

	/**
	* Check if the avatar directory is writable and disable avatars
	* if it isn't writable.
	*/
	function disable_avatars_if_unwritable()
	{
		global $phpbb_root_path;

		if (!phpbb_is_writable($phpbb_root_path . 'images/avatars/upload/'))
		{
			set_config('allow_avatar', 0);
			set_config('allow_avatar_upload', 0);
		}
	}

	/**
	* Generate a list of available mail server authentication methods
	*/
	function mail_auth_select($selected_method)
	{
		global $lang;

		$auth_methods = array('PLAIN', 'LOGIN', 'CRAM-MD5', 'DIGEST-MD5', 'POP-BEFORE-SMTP');
		$s_smtp_auth_options = '';

		foreach ($auth_methods as $method)
		{
			$s_smtp_auth_options .= '<option value="' . $method . '"' . (($selected_method == $method) ? ' selected="selected"' : '') . '>' . $lang['SMTP_' . str_replace('-', '_', $method)] . '</option>';
		}

		return $s_smtp_auth_options;
	}

	/**
	* Fix the visibility issue with edit/delete etc..
	*/
	function fix_view()
	{
		global $db, $lang, $phpbb_root_path, $phpEx;

		// Obtain any submitted data
		$data = $this->get_submitted_data();
		$table_prefix = $data['table_prefix'];
		
		$sql["fix"] = array(
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_blocks' AND " . $table_prefix . "modules.module_mode = 'edit'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_blocks' AND " . $table_prefix . "modules.module_mode = 'up'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_blocks' AND " . $table_prefix . "modules.module_mode = 'down'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_blocks' AND " . $table_prefix . "modules.module_mode = 'delete'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_menus' AND " . $table_prefix . "modules.module_mode = 'edit'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_menus' AND " . $table_prefix . "modules.module_mode = 'up'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_menus' AND " . $table_prefix . "modules.module_mode = 'down'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_menus' AND " . $table_prefix . "modules.module_mode = 'delete'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_vars' AND " . $table_prefix . "modules.module_mode = 'edit'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_vars' AND " . $table_prefix . "modules.module_mode = 'up'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_vars' AND " . $table_prefix . "modules.module_mode = 'down'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_vars' AND " . $table_prefix . "modules.module_mode = 'delete'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_modules' AND " . $table_prefix . "modules.module_mode = 'edit'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_modules' AND " . $table_prefix . "modules.module_mode = 'up'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_modules' AND " . $table_prefix . "modules.module_mode = 'down'",
			'UPDATE ' . $table_prefix . "modules SET module_display = '0' WHERE " . $table_prefix. "modules.module_basename = 'k_modules' AND " . $table_prefix . "modules.module_mode = 'delete'"
		);
		
		foreach($sql[fix] as $v)
		{
			if( !$result = $db->sql_query($v) )
			{
				$error = $db->sql_error();
				$this->p_master->db_error($error['message'], $sql, __LINE__, __FILE__);
			}
		}
		
	}
	/**
	* Get submitted data
	*/
	function get_submitted_data()
	{
		return array(
			'language'		=> basename(request_var('language', '')),
			'dbms'			=> request_var('dbms', ''),
			'dbhost'		=> request_var('dbhost', ''),
			'dbport'		=> request_var('dbport', ''),
			'dbuser'		=> request_var('dbuser', ''),
			'dbpasswd'		=> request_var('dbpasswd', '', true),
			'dbname'		=> request_var('dbname', ''),
			'table_prefix'	=> request_var('table_prefix', ''),
			'default_lang'	=> basename(request_var('default_lang', '')),
			'admin_name'	=> utf8_normalize_nfc(request_var('admin_name', '', true)),
			'admin_pass1'	=> request_var('admin_pass1', '', true),
			'admin_pass2'	=> request_var('admin_pass2', '', true),
			'board_email1'	=> strtolower(request_var('board_email1', '')),
			'board_email2'	=> strtolower(request_var('board_email2', '')),
			'img_imagick'	=> request_var('img_imagick', ''),
			'ftp_path'		=> request_var('ftp_path', ''),
			'ftp_user'		=> request_var('ftp_user', ''),
			'ftp_pass'		=> request_var('ftp_pass', ''),
			'email_enable'	=> request_var('email_enable', ''),
			'smtp_delivery'	=> request_var('smtp_delivery', ''),
			'smtp_host'		=> request_var('smtp_host', ''),
			'smtp_auth'		=> request_var('smtp_auth', ''),
			'smtp_user'		=> request_var('smtp_user', ''),
			'smtp_pass'		=> request_var('smtp_pass', ''),
			'cookie_secure'	=> request_var('cookie_secure', ''),
			'force_server_vars'	=> request_var('force_server_vars', ''),
			'server_protocol'	=> request_var('server_protocol', ''),
			'server_name'	=> request_var('server_name', ''),
			'server_port'	=> request_var('server_port', ''),
			'script_path'	=> request_var('script_path', ''),
		);
	}

	/**
	* The information below will be used to build the input fields presented to the user
	*/
	var $db_config_options = array(
		'legend1'				=> 'DB_CONFIG',
		'dbms'					=> array('lang' => 'DBMS',			'type' => 'select', 'options' => 'dbms_select(\'{VALUE}\')', 'explain' => false),
		'dbhost'				=> array('lang' => 'DB_HOST',		'type' => 'text:25:100', 'explain' => true),
		'dbport'				=> array('lang' => 'DB_PORT',		'type' => 'text:25:100', 'explain' => true),
		'dbname'				=> array('lang' => 'DB_NAME',		'type' => 'text:25:100', 'explain' => false),
		'dbuser'				=> array('lang' => 'DB_USERNAME',	'type' => 'text:25:100', 'explain' => false),
		'dbpasswd'				=> array('lang' => 'DB_PASSWORD',	'type' => 'password:25:100', 'explain' => false),
		'table_prefix'			=> array('lang' => 'TABLE_PREFIX',	'type' => 'text:25:100', 'explain' => true),
	);
	var $admin_config_options = array(
		'legend1'				=> 'ADMIN_CONFIG',
		'default_lang'			=> array('lang' => 'DEFAULT_LANG',				'type' => 'select', 'options' => '$this->module->inst_language_select(\'{VALUE}\')', 'explain' => false),
		'admin_name'			=> array('lang' => 'ADMIN_USERNAME',			'type' => 'text:25:100', 'explain' => true),
		'admin_pass1'			=> array('lang' => 'ADMIN_PASSWORD',			'type' => 'password:25:100', 'explain' => true),
		'admin_pass2'			=> array('lang' => 'ADMIN_PASSWORD_CONFIRM',	'type' => 'password:25:100', 'explain' => false),
		'board_email1'			=> array('lang' => 'CONTACT_EMAIL',				'type' => 'text:25:100', 'explain' => false),
		'board_email2'			=> array('lang' => 'CONTACT_EMAIL_CONFIRM',		'type' => 'text:25:100', 'explain' => false),
	);
	var $advanced_config_options = array(
		'legend1'				=> 'ACP_EMAIL_SETTINGS',
		'email_enable'			=> array('lang' => 'ENABLE_EMAIL',		'type' => 'radio:enabled_disabled', 'explain' => true),
		'smtp_delivery'			=> array('lang' => 'USE_SMTP',			'type' => 'radio:yes_no', 'explain' => true),
		'smtp_host'				=> array('lang' => 'SMTP_SERVER',		'type' => 'text:25:50', 'explain' => false),
		'smtp_auth'				=> array('lang' => 'SMTP_AUTH_METHOD',	'type' => 'select', 'options' => '$this->module->mail_auth_select(\'{VALUE}\')', 'explain' => true),
		'smtp_user'				=> array('lang' => 'SMTP_USERNAME',		'type' => 'text:25:255', 'explain' => true, 'options' => array('autocomplete' => 'off')),
		'smtp_pass'				=> array('lang' => 'SMTP_PASSWORD',		'type' => 'password:25:255', 'explain' => true, 'options' => array('autocomplete' => 'off')),

		'legend2'				=> 'SERVER_URL_SETTINGS',
		'cookie_secure'			=> array('lang' => 'COOKIE_SECURE',		'type' => 'radio:enabled_disabled', 'explain' => true),
		'force_server_vars'		=> array('lang' => 'FORCE_SERVER_VARS',	'type' => 'radio:yes_no', 'explain' => true),
		'server_protocol'		=> array('lang' => 'SERVER_PROTOCOL',	'type' => 'text:10:10', 'explain' => true),
		'server_name'			=> array('lang' => 'SERVER_NAME',		'type' => 'text:40:255', 'explain' => true),
		'server_port'			=> array('lang' => 'SERVER_PORT',		'type' => 'text:5:5', 'explain' => true),
		'script_path'			=> array('lang' => 'SCRIPT_PATH',		'type' => 'text::255', 'explain' => true),
	);

	/**
	* Specific PHP modules we may require for certain optional or extended features
	*/
	var $php_dlls_other = array('zlib', 'ftp', 'gd', 'xml');

	/**
	* A list of the web-crawlers/bots we recognise by default
	*
	* Candidates but not included:
	* 'Accoona [Bot]'				'Accoona-AI-Agent/'
	* 'ASPseek [Crawler]'			'ASPseek/'
	* 'Boitho [Crawler]'			'boitho.com-dc/'
	* 'Bunnybot [Bot]'				'powered by www.buncat.de'
	* 'Cosmix [Bot]'				'cfetch/'
	* 'Crawler Search [Crawler]'	'.Crawler-Search.de'
	* 'Findexa [Crawler]'			'Findexa Crawler ('
	* 'GBSpider [Spider]'			'GBSpider v'
	* 'genie [Bot]'					'genieBot ('
	* 'Hogsearch [Bot]'				'oegp v. 1.3.0'
	* 'Insuranco [Bot]'				'InsurancoBot'
	* 'IRLbot [Bot]'				'http://irl.cs.tamu.edu/crawler'
	* 'ISC Systems [Bot]'			'ISC Systems iRc Search'
	* 'Jyxobot [Bot]'				'Jyxobot/'
	* 'Kraehe [Metasuche]'			'-DIE-KRAEHE- META-SEARCH-ENGINE/'
	* 'LinkWalker'					'LinkWalker'
	* 'MMSBot [Bot]'				'http://www.mmsweb.at/bot.html'
	* 'Naver [Bot]'					'nhnbot@naver.com)'
	* 'NetResearchServer'			'NetResearchServer/'
	* 'Nimble [Crawler]'			'NimbleCrawler'
	* 'Ocelli [Bot]'				'Ocelli/'
	* 'Onsearch [Bot]'				'onCHECK-Robot'
	* 'Orange [Spider]'				'OrangeSpider'
	* 'Sproose [Bot]'				'http://www.sproose.com/bot'
	* 'Susie [Sync]'				'!Susie (http://www.sync2it.com/susie)'
	* 'Tbot [Bot]'					'Tbot/'
	* 'Thumbshots [Capture]'		'thumbshots-de-Bot'
	* 'Vagabondo [Crawler]'			'http://webagent.wise-guys.nl/'
	* 'Walhello [Bot]'				'appie 1.1 (www.walhello.com)'
	* 'WissenOnline [Bot]'			'WissenOnline-Bot'
	* 'WWWeasel [Bot]'				'WWWeasel Robot v'
	* 'Xaldon [Spider]'				'Xaldon WebSpider'
	*/
	var $bot_list = array(
		'AdsBot [Google]'			=> array('AdsBot-Google', ''),
		'Ahrefs [Bot]'			    => array('AhrefsBot/', ''),
		'Alexa [Bot]'			    => array('ia_archiver', ''),
		'Alta Vista [Bot]'			=> array('Scooter/', ''),
		'Amazon [Bot]'			    => array('Amazonbot/', ''),
		'Ask Jeeves [Bot]'			=> array('Ask Jeeves', ''),
		'Baidu [Spider]'			=> array('Baiduspider', ''),
		'Bing [Bot]'			    => array('bingbot/', ''),
		'DuckDuckGo [Bot]'			=> array('DuckDuckBot/', ''),
		'Exabot [Bot]'			    => array('Exabot/', ''),
		'FAST Enterprise [Crawler]'	=> array('FAST Enterprise Crawler', ''),
		'FAST WebCrawler [Crawler]'	=> array('FAST-WebCrawler/', ''),
		'Francis [Bot]'       	    => array('http://www.neomo.de/', ''),
		'Gigabot [Bot]'	            => array('Gigabot/', ''),
		'Google Adsense [Bot]'	    => array('Mediapartners-Google', ''),
		'Google Desktop'			=> array('Google Desktop', ''),
		'Google Feedfetcher'		=> array('Feedfetcher-Google', ''),
		'Google [Bot]'		        => array('Googlebot', ''),
		'Heise IT-Markt [Crawler]'	=> array('heise-IT-Markt-Crawler', ''),
		'Heritrix [Crawler]'		=> array('heritrix/1.', ''),
		'IBM Research [Bot]'		=> array('ibm.com/cs/crawler', ''),
		'ICCrawler - ICjobs'		=> array('ICCrawler - ICjobs', ''),
		'ichiro [Crawler]'		    => array('ichiro/', ''),
		'Majestic-12 [Bot]'		    => array('MJ12bot/', ''),
		'Metager [Bot]'		        => array('MetagerBot/', ''),
		'MSN NewsBlogs'		        => array('msnbot-NewsBlogs/', ''),
		'MSN [Bot]'		            => array('msnbot/', ''),
		'MSNbot Media'		        => array('msnbot-media/', ''),
		'NG-Search [Bot]'		    => array('NG-Search/', ''),
		'Nutch [Bot]'		        => array('http://lucene.apache.org/nutch/', ''),
		'Nutch/CVS [Bot]'		    => array('NutchCVS/', ''),
		'OmniExplorer [Bot]'		=> array('OmniExplorer_Bot/', ''),
		'Online link [Validator]'	=> array('online link validator', ''),
		'psbot [Picsearch]'		    => array('psbot/0', ''),
		'Seekport [Bot]'		    => array('Seekbot/', ''),
		'Semrush [Bot]'		        => array('SemrushBot/', ''),
		'Sensis [Crawler]'		    => array('Sensis Web Crawler', ''),
		'SEO Crawler'		        => array('SEO search Crawler/', ''),
		'Seoma [Crawler]'		    => array('Seoma [SEO Crawler]', ''),
		'SEOSearch [Crawler]'		=> array('SEOsearch/', ''),
		'Snappy [Bot]'		        => array('Snappy/1.1 ( http://www.urltrends.com/ )', ''),
		'Steeler [Crawler]'		    => array('http://www.tkl.iis.u-tokyo.ac.jp/~crawler/', ''),
		'Synoo [Bot]'		        => array('SynooBot/', ''),
		'Telekom [Bot]'		        => array('crawleradmin.t-info@telekom.de', ''),
		'TurnitinBot [Bot]'		    => array('TurnitinBot/', ''),
		'Voyager [Bot]'		        => array('voyager/', ''),
		'W3 [Sitesearch]'		    => array('W3 SiteSearch Crawler', ''),
		'W3C [Linkcheck]'		    => array('W3C-checklink/', ''),
		'W3C [Validator]'		    => array('W3C_*Validator', ''),
		'WiseNut [Bot]'		        => array('http://www.WISEnutbot.com', ''),
		'YaCy [Bot]'		        => array('yacybot', ''),
		'Yahoo MMCrawler [Bot]'		=> array('Yahoo-MMCrawler/', ''),
		'Yahoo Slurp [Bot]'		    => array('Yahoo! DE Slurp', ''),
		'Yahoo [Bot]'		        => array('Yahoo! Slurp', ''),
		'YahooSeeker [Bot]'		    => array('YahooSeeker/', ''),
	);

	/**
	* Define the module structure so that we can populate the database without
	* needing to hard-code module_id values
	*/
	var $module_categories = array(
		'acp'	=> array(
			'ACP_CAT_GENERAL'		=> [
				'ACP_QUICK_ACCESS',
				'ACP_BOARD_CONFIGURATION',
				'ACP_CLIENT_COMMUNICATION',
				'ACP_SERVER_CONFIGURATION',
			],
			'ACP_CAT_FORUMS'		=> [
				'ACP_MANAGE_FORUMS',
				'ACP_FORUM_BASED_PERMISSIONS',
			],
			'ACP_CAT_POSTING'		=> [
				'ACP_MESSAGES',
				'ACP_ABBCODES',
				'ACP_AJAXLIKE_MOD_TITLE',
				'ACP_ATTACHMENTS',
			],
			'ACP_CAT_USERGROUP'		=> [
				'ACP_CAT_USERS',
				'ACP_GROUPS',
				'ACP_USER_SECURITY',
			],
			'ACP_CAT_PERMISSIONS'	=> [
				'ACP_GLOBAL_PERMISSIONS',
				'ACP_FORUM_BASED_PERMISSIONS',
				'ACP_PERMISSION_ROLES',
				'ACP_PERMISSION_MASKS',
			],
			'ACP_CAT_STYLES'		=> [
				'ACP_STYLE_MANAGEMENT',
				'ACP_STYLE_COMPONENTS',
			],
			'ACP_CAT_MAINTENANCE'	=> [
				'ACP_FORUM_LOGS',
				'ACP_CAT_DATABASE',
				'ACP_CAT_FILES',
			],
			'ACP_CAT_SYSTEM'		=> [
				'ACP_GENERAL_TASKS',
				'ACP_MODULE_MANAGEMENT',
			],
			'ACP_CAT_PORTAL'		=> [
				'ACP_K_CONFIG',
				'ACP_K_BLOCKS',
				'ACP_K_MENUS',
				'ACP_K_PAGES',
				'ACP_K_VARS_AND_RESOURCES',
			],
			'ACP_CAT_IMOD'		 	=> [
				'ACP_IMOD_CONFIG',
//				'ACP_CAT_IMOD',
				'ANTISPAM',
				'ACP_CALENDAR',
				'ACP_CAT_CONTACT',
				'ACP_DOWNLOADS',
				'ACP_FAQ_MANAGER',
				'PHPBB_GALLERY',
				'ACP_CAT_KB',
				'ACP_CAT_MCHAT',
				'MEETING',
				'ACP_PAGES',
				'ACP_POINTS',
                'ACP_BLOGS',
			],
			'ACP_CAT_SOCIALNET'		=> [],
			'ACP_CAT_DOT_MODS'		=> null,
		),
		'mcp'	=> array(
			'MCP_MAIN'		=> null,
			'MCP_QUEUE'		=> null,
			'MCP_REPORTS'	=> null,
			'MCP_NOTES'		=> null,
			'MCP_WARN'		=> null,
			'MCP_LOGS'		=> null,
			'MCP_BAN'		=> null,
			'ANTISPAM'		=> null,
			'MCP_KB'		=> null,
			'MCP_BLOG'		=> null,
		),
		'ucp'	=> array(
			'UCP_MAIN'			=> null,
			'UCP_PROFILE'		=> null,
			'UCP_PREFS'			=> null,
			'UCP_PM'			=> null,
			'UCP_USERGROUPS'	=> null,
			'UCP_ZEBRA'			=> null,
			'UCP_GALLERY'		=> null,
			'UCP_BLOG'		    => null,
			'UCP_K_BLOCKS'		=> null,
		),
	);

	var $module_extras = array(
		'acp'	=> array(
			'ACP_QUICK_ACCESS' => array(
				'ACP_MANAGE_USERS',
				'ACP_GROUPS_MANAGE',
				'ACP_MANAGE_FORUMS',
				'ACP_MOD_LOGS',
				'ACP_BOTS',
				'ACP_PHP_INFO',
			),
			'ACP_FORUM_BASED_PERMISSIONS' => array(
				'ACP_FORUM_PERMISSIONS',
				'ACP_FORUM_PERMISSIONS_COPY',
				'ACP_FORUM_MODERATORS',
				'ACP_USERS_FORUM_PERMISSIONS',
				'ACP_GROUPS_FORUM_PERMISSIONS',
			),

		),
	);	
}

// require_once($phpbb_root_path . 'install/'replace_modules. $phpEx);

function replace_modules($id)  
{
	$sql = "REPLACE INTO phpbb_modules (module_id, module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth) VALUES
	(1, 1, 1, '', 'acp', 0, 1, 82, 'ACP_CAT_GENERAL', '', ''),
	(2, 1, 1, '', 'acp', 1, 4, 17, 'ACP_QUICK_ACCESS', '', ''),
	(3, 1, 1, '', 'acp', 1, 18, 47, 'ACP_BOARD_CONFIGURATION', '', ''),
	(4, 1, 1, '', 'acp', 1, 48, 55, 'ACP_CLIENT_COMMUNICATION', '', ''),
	(5, 1, 1, '', 'acp', 1, 56, 69, 'ACP_SERVER_CONFIGURATION', '', ''),
	(6, 1, 1, '', 'acp', 0, 83, 102, 'ACP_CAT_FORUMS', '', ''),
	(7, 1, 1, '', 'acp', 6, 84, 89, 'ACP_MANAGE_FORUMS', '', ''),
	(8, 1, 1, '', 'acp', 6, 90, 101, 'ACP_FORUM_BASED_PERMISSIONS', '', ''),
	(9, 1, 1, '', 'acp', 0, 103, 138, 'ACP_CAT_POSTING', '', ''),
	(10, 1, 1, '', 'acp', 9, 104, 117, 'ACP_MESSAGES', '', ''),
	(11, 1, 1, '', 'acp', 9, 118, 127, 'ACP_ATTACHMENTS', '', ''),
	(12, 1, 1, '', 'acp', 0, 139, 198, 'ACP_CAT_USERGROUP', '', ''),
	(13, 1, 1, '', 'acp', 12, 140, 175, 'ACP_CAT_USERS', '', ''),
	(14, 1, 1, '', 'acp', 12, 176, 185, 'ACP_GROUPS', '', ''),
	(15, 1, 1, '', 'acp', 12, 186, 197, 'ACP_USER_SECURITY', '', ''),
	(16, 1, 1, '', 'acp', 0, 199, 248, 'ACP_CAT_PERMISSIONS', '', ''),
	(17, 1, 1, '', 'acp', 16, 202, 211, 'ACP_GLOBAL_PERMISSIONS', '', ''),
	(18, 1, 1, '', 'acp', 16, 212, 223, 'ACP_FORUM_BASED_PERMISSIONS', '', ''),
	(19, 1, 1, '', 'acp', 16, 224, 233, 'ACP_PERMISSION_ROLES', '', ''),
	(20, 1, 1, '', 'acp', 16, 234, 247, 'ACP_PERMISSION_MASKS', '', ''),
	(21, 1, 1, '', 'acp', 0, 249, 262, 'ACP_CAT_STYLES', '', ''),
	(22, 1, 1, '', 'acp', 21, 250, 253, 'ACP_STYLE_MANAGEMENT', '', ''),
	(23, 1, 1, '', 'acp', 21, 254, 261, 'ACP_STYLE_COMPONENTS', '', ''),
	(24, 1, 1, '', 'acp', 0, 263, 288, 'ACP_CAT_MAINTENANCE', '', ''),
	(25, 1, 1, '', 'acp', 24, 264, 275, 'ACP_FORUM_LOGS', '', ''),
	(26, 1, 1, '', 'acp', 24, 276, 283, 'ACP_CAT_DATABASE', '', ''),
	(27, 1, 1, '', 'acp', 0, 289, 316, 'ACP_CAT_SYSTEM', '', ''),
	(28, 1, 1, '', 'acp', 27, 290, 293, 'ACP_AUTOMATION', '', ''),
	(29, 1, 1, '', 'acp', 27, 294, 307, 'ACP_GENERAL_TASKS', '', ''),
	(30, 1, 1, '', 'acp', 27, 308, 315, 'ACP_MODULE_MANAGEMENT', '', ''),
	(31, 1, 1, '', 'acp', 0, 317, 384, 'ACP_CAT_PORTAL', '', ''),
	(32, 1, 1, '', 'acp', 31, 318, 321, 'ACP_K_CONFIG', '', ''),
	(33, 1, 1, '', 'acp', 31, 322, 345, 'ACP_K_BLOCKS', '', ''),
	(34, 1, 1, '', 'acp', 31, 346, 367, 'ACP_K_MENUS', '', ''),
	(35, 1, 1, '', 'acp', 31, 368, 377, 'ACP_K_PAGES', '', ''),
	(36, 1, 1, '', 'acp', 31, 378, 383, 'ACP_K_VARS_AND_RESOURCES', '', ''),
	(37, 1, 1, '', 'acp', 0, 385, 520, 'ACP_CAT_IMOD', '', ''),
	(38, 1, 1, '', 'acp', 37, 400, 405, 'ACP_SHOUTBOX', '', ''),
	(39, 1, 1, '', 'acp', 37, 406, 421, 'ANTISPAM', '', ''),
	(40, 1, 1, '', 'acp', 37, 422, 423, 'ACP_CALENDAR', '', ''),
	(41, 1, 1, '', 'acp', 37, 454, 465, 'ACP_CAT_KB', '', ''),
	(42, 1, 1, '', 'acp', 37, 466, 481, 'PHPBB_GALLERY', '', ''),
	(43, 1, 1, '', 'acp', 0, 521, 524, 'ACP_CAT_DOT_MODS', '', ''),
	(44, 1, 1, 'asacp', 'acp', 39, 407, 408, 'ASACP_SETTINGS', 'settings', 'acl_a_asacp'),
	(45, 1, 1, 'asacp', 'acp', 39, 409, 410, 'ASACP_SPAM_LOG', 'log', 'acl_m_asacp_spam_log'),
	(46, 1, 1, 'asacp', 'acp', 39, 411, 412, 'ASACP_FLAG_LOG', 'flag', 'acl_m_asacp_user_flag'),
	(47, 1, 1, 'asacp', 'acp', 39, 413, 414, 'ASACP_FLAG_LIST', 'flag_list', 'acl_m_asacp_user_flag'),
	(48, 1, 1, 'asacp', 'acp', 39, 415, 416, 'ASACP_IP_SEARCH', 'ip_search', 'acl_m_asacp_ip_search'),
	(49, 1, 1, 'asacp', 'acp', 39, 417, 418, 'ASACP_SPAM_WORDS', 'spam_words', 'acl_a_asacp_spam_words'),
	(50, 1, 1, 'asacp', 'acp', 39, 419, 420, 'ASACP_PROFILE_FIELDS', 'profile_fields', 'acl_a_asacp_profile_fields'),
	(51, 1, 1, 'attachments', 'acp', 3, 19, 20, 'ACP_ATTACHMENT_SETTINGS', 'attach', 'acl_a_attach'),
	(52, 1, 1, 'attachments', 'acp', 11, 119, 120, 'ACP_ATTACHMENT_SETTINGS', 'attach', 'acl_a_attach'),
	(53, 1, 1, 'attachments', 'acp', 11, 121, 122, 'ACP_MANAGE_EXTENSIONS', 'extensions', 'acl_a_attach'),
	(54, 1, 1, 'attachments', 'acp', 11, 123, 124, 'ACP_EXTENSION_GROUPS', 'ext_groups', 'acl_a_attach'),
	(55, 1, 1, 'attachments', 'acp', 11, 125, 126, 'ACP_ORPHAN_ATTACHMENTS', 'orphan', 'acl_a_attach'),
	(56, 1, 1, 'ban', 'acp', 15, 187, 188, 'ACP_BAN_EMAILS', 'email', 'acl_a_ban'),
	(57, 1, 1, 'ban', 'acp', 15, 189, 190, 'ACP_BAN_IPS', 'ip', 'acl_a_ban'),
	(58, 1, 1, 'ban', 'acp', 15, 191, 192, 'ACP_BAN_USERNAMES', 'user', 'acl_a_ban'),
	(59, 1, 1, 'bbcodes', 'acp', 10, 105, 106, 'ACP_BBCODES', 'bbcodes', 'acl_a_bbcode'),
	(60, 1, 1, 'board', 'acp', 3, 21, 22, 'ACP_BOARD_SETTINGS', 'settings', 'acl_a_board'),
	(61, 1, 1, 'board', 'acp', 3, 23, 24, 'ACP_BOARD_FEATURES', 'features', 'acl_a_board'),
	(62, 1, 1, 'board', 'acp', 3, 25, 26, 'ACP_AVATAR_SETTINGS', 'avatar', 'acl_a_board'),
	(63, 1, 1, 'board', 'acp', 3, 27, 28, 'ACP_MESSAGE_SETTINGS', 'message', 'acl_a_board'),
	(64, 1, 1, 'board', 'acp', 10, 107, 108, 'ACP_MESSAGE_SETTINGS', 'message', 'acl_a_board'),
	(65, 1, 1, 'board', 'acp', 3, 29, 30, 'ACP_POST_SETTINGS', 'post', 'acl_a_board'),
	(66, 1, 1, 'board', 'acp', 10, 109, 110, 'ACP_POST_SETTINGS', 'post', 'acl_a_board'),
	(67, 1, 1, 'board', 'acp', 3, 31, 32, 'ACP_SIGNATURE_SETTINGS', 'signature', 'acl_a_board'),
	(68, 1, 1, 'board', 'acp', 3, 33, 34, 'ACP_FEED_SETTINGS', 'feed', 'acl_a_board'),
	(69, 1, 1, 'board', 'acp', 3, 35, 36, 'ACP_REGISTER_SETTINGS', 'registration', 'acl_a_board'),
	(70, 1, 1, 'board', 'acp', 4, 49, 50, 'ACP_AUTH_SETTINGS', 'auth', 'acl_a_server'),
	(71, 1, 1, 'board', 'acp', 4, 51, 52, 'ACP_EMAIL_SETTINGS', 'email', 'acl_a_server'),
	(72, 1, 1, 'board', 'acp', 5, 57, 58, 'ACP_COOKIE_SETTINGS', 'cookie', 'acl_a_server'),
	(73, 1, 1, 'board', 'acp', 5, 59, 60, 'ACP_SERVER_SETTINGS', 'server', 'acl_a_server'),
	(74, 1, 1, 'board', 'acp', 5, 61, 62, 'ACP_SECURITY_SETTINGS', 'security', 'acl_a_server'),
	(75, 1, 1, 'board', 'acp', 5, 63, 64, 'ACP_LOAD_SETTINGS', 'load', 'acl_a_server'),
	(76, 1, 1, 'bots', 'acp', 29, 295, 296, 'ACP_BOTS', 'bots', 'acl_a_bots'),
	(77, 1, 1, 'calendar', 'acp', 313, 391, 392, 'ACP_CALENDAR_SETTINGS', 'settings', 'acl_a_board'),
	(78, 1, 1, 'captcha', 'acp', 3, 37, 38, 'ACP_VC_SETTINGS', 'visual', 'acl_a_board'),
	(79, 1, 0, 'captcha', 'acp', 3, 39, 40, 'ACP_VC_CAPTCHA_DISPLAY', 'img', 'acl_a_board'),
	(80, 1, 1, 'database', 'acp', 26, 277, 278, 'ACP_BACKUP', 'backup', 'acl_a_backup'),
	(81, 1, 1, 'database', 'acp', 26, 279, 280, 'ACP_RESTORE', 'restore', 'acl_a_backup'),
	(82, 1, 1, 'disallow', 'acp', 15, 193, 194, 'ACP_DISALLOW_USERNAMES', 'usernames', 'acl_a_names'),
	(83, 1, 1, 'email', 'acp', 29, 297, 298, 'ACP_MASS_EMAIL', 'email', 'acl_a_email && cfg_email_enable'),
	(84, 1, 1, 'forums', 'acp', 7, 85, 86, 'ACP_MANAGE_FORUMS', 'manage', 'acl_a_forum'),
	(85, 1, 1, 'gallery', 'acp', 42, 467, 468, 'ACP_GALLERY_OVERVIEW', 'overview', 'acl_a_gallery_manage'),
	(86, 1, 1, 'gallery', 'acp', 42, 469, 470, 'ACP_IMPORT_ALBUMS', 'import_images', 'acl_a_gallery_import'),
	(87, 1, 1, 'gallery', 'acp', 42, 471, 472, 'ACP_GALLERY_CLEANUP', 'cleanup', 'acl_a_gallery_cleanup'),
	(88, 1, 1, 'gallery_albums', 'acp', 42, 473, 474, 'ACP_GALLERY_MANAGE_ALBUMS', 'manage', 'acl_a_gallery_albums'),
	(89, 1, 1, 'gallery_config', 'acp', 42, 475, 476, 'ACP_GALLERY_CONFIGURE_GALLERY', 'main', 'acl_a_gallery_manage'),
	(90, 1, 1, 'gallery_permissions', 'acp', 42, 477, 478, 'ACP_GALLERY_ALBUM_PERMISSIONS', 'manage', 'acl_a_gallery_albums'),
	(91, 1, 1, 'gallery_permissions', 'acp', 42, 479, 480, 'ACP_GALLERY_ALBUM_PERMISSIONS_COPY', 'copy', 'acl_a_gallery_albums'),
	(92, 1, 1, 'groups', 'acp', 14, 177, 178, 'ACP_GROUPS_MANAGE', 'manage', 'acl_a_group'),
	(93, 1, 1, 'icons', 'acp', 10, 111, 112, 'ACP_ICONS', 'icons', 'acl_a_icons'),
	(94, 1, 1, 'icons', 'acp', 10, 113, 114, 'ACP_SMILIES', 'smilies', 'acl_a_icons'),
	(95, 1, 1, 'inactive', 'acp', 13, 143, 144, 'ACP_INACTIVE_USERS', 'list', 'acl_a_user'),
	(96, 1, 1, 'jabber', 'acp', 4, 53, 54, 'ACP_JABBER_SETTINGS', 'settings', 'acl_a_jabber'),
	(97, 1, 1, 'k_blocks', 'acp', 33, 323, 324, 'ACP_K_BLOCKS_ADD', 'add', 'acl_a_k_portal'),
	(98, 1, 0, 'k_blocks', 'acp', 33, 325, 326, 'ACP_K_BLOCKS_EDIT', 'edit', 'acl_a_k_portal'),
	(99, 1, 0, 'k_blocks', 'acp', 33, 327, 328, 'ACP_K_BLOCKS_DELETE', 'delete', 'acl_a_k_portal'),
	(100, 1, 0, 'k_blocks', 'acp', 33, 329, 330, 'ACP_K_UP', 'up', 'acl_a_k_portal'),
	(101, 1, 0, 'k_blocks', 'acp', 33, 331, 332, 'ACP_K_DOWN', 'down', 'acl_a_k_portal'),
	(102, 1, 0, 'k_blocks', 'acp', 33, 333, 334, 'ACP_K_BLOCKS_REINDEX', 'reindex', 'acl_a_k_portal'),
	(103, 1, 1, 'k_blocks', 'acp', 33, 335, 336, 'ACP_K_PAGE_LEFT_BLOCKS', 'L', 'acl_a_k_portal'),
	(104, 1, 1, 'k_blocks', 'acp', 33, 337, 338, 'ACP_K_PAGE_CERTRE_BLOCKS', 'C', 'acl_a_k_portal'),
	(105, 1, 1, 'k_blocks', 'acp', 33, 339, 340, 'ACP_K_PAGE_RIGHT_BLOCKS', 'R', 'acl_a_k_portal'),
	(106, 1, 1, 'k_blocks', 'acp', 33, 341, 342, 'ACP_K_BLOCKS_MANAGE', 'manage', 'acl_a_k_portal'),
	(107, 1, 1, 'k_blocks', 'acp', 33, 343, 344, 'ACP_K_BLOCKS_RESET', 'reset', 'acl_a_k_portal'),
	(108, 1, 1, 'k_config', 'acp', 32, 319, 320, 'ACP_K_PORTAL_CONFIG', 'config', 'acl_a_k_portal'),
	(109, 1, 1, 'k_menus', 'acp', 34, 347, 348, 'ACP_K_MENU_ADD', 'add', 'acl_a_k_portal'),
	(110, 1, 1, 'k_menus', 'acp', 34, 349, 350, 'ACP_K_MENU_MAIN', 'nav', 'acl_a_k_portal'),
	(111, 1, 1, 'k_menus', 'acp', 34, 351, 352, 'ACP_K_MENU_SUB', 'sub', 'acl_a_k_portal'),
	(112, 1, 1, 'k_menus', 'acp', 34, 353, 354, 'ACP_K_MENU_LINKS', 'link', 'acl_a_k_portal'),
	(113, 1, 0, 'k_menus', 'acp', 34, 355, 356, 'ACP_K_MENU_EDIT', 'edit', 'acl_a_k_portal'),
	(114, 1, 0, 'k_menus', 'acp', 34, 357, 358, 'ACP_K_MENU_DELETE', 'delete', 'acl_a_k_portal'),
	(115, 1, 0, 'k_menus', 'acp', 34, 359, 360, 'ACP_K_UP', 'up', 'acl_a_k_portal'),
	(116, 1, 0, 'k_menus', 'acp', 34, 361, 362, 'ACP_K_DOWN', 'down', 'acl_a_k_portal'),
	(117, 1, 1, 'k_menus', 'acp', 34, 363, 364, 'ACP_K_MENU_ALL', 'all', 'acl_a_k_portal'),
	(118, 1, 1, 'k_menus', 'acp', 34, 365, 366, 'ACP_K_MENU_UNALLOCATED', 'unalloc', 'acl_a_k_portal'),
	(119, 1, 0, 'k_pages', 'acp', 35, 369, 370, 'ACP_K_PAGES_ADD', 'add', 'acl_a_k_portal'),
	(120, 1, 0, 'k_pages', 'acp', 35, 371, 372, 'ACP_K_PAGES_DELETE', 'delete', 'acl_a_k_portal'),
	(121, 1, 0, 'k_pages', 'acp', 35, 373, 374, 'ACP_K_PAGES_LAND', 'land', 'acl_a_k_portal'),
	(122, 1, 1, 'k_pages', 'acp', 35, 375, 376, 'ACP_K_PAGES_MANAGE', 'manage', 'acl_a_k_portal'),
	(123, 1, 1, 'k_resources', 'acp', 36, 379, 380, 'ACP_K_RESOURCES', 'select', 'acl_a_k_tools'),
	(124, 1, 1, 'k_vars', 'acp', 36, 381, 382, 'ACP_K_VARS_CONFIG', 'config', 'acl_a_k_portal'),
	(125, 1, 1, 'kb', 'acp', 41, 455, 456, 'KB_CONFIG', 'config', 'acl_a_config_kb'),
	(126, 1, 1, 'kb', 'acp', 41, 457, 458, 'CATEGORIES', 'main', 'acl_a_categorie_kb'),
	(127, 1, 1, 'kb', 'acp', 41, 459, 460, 'TYPES', 'types', 'acl_a_types_kb'),
	(128, 1, 1, 'kb_permissions', 'acp', 41, 461, 462, 'ACP_KB_PERMISSIONS', 'set_permissions', 'acl_a_premissions_kb'),
	(129, 1, 1, 'kb_permissions', 'acp', 41, 463, 464, 'ACP_KB_ROLES', 'set_roles', 'acl_a_premissions_kb'),
	(130, 1, 1, 'language', 'acp', 29, 299, 300, 'ACP_LANGUAGE_PACKS', 'lang_packs', 'acl_a_language'),
	(131, 1, 1, 'logs', 'acp', 25, 265, 266, 'ACP_ADMIN_LOGS', 'admin', 'acl_a_viewlogs'),
	(132, 1, 1, 'logs', 'acp', 25, 267, 268, 'ACP_MOD_LOGS', 'mod', 'acl_a_viewlogs'),
	(133, 1, 1, 'logs', 'acp', 25, 269, 270, 'ACP_USERS_LOGS', 'users', 'acl_a_viewlogs'),
	(134, 1, 1, 'logs', 'acp', 25, 271, 272, 'ACP_CRITICAL_LOGS', 'critical', 'acl_a_viewlogs'),
	(135, 1, 1, 'logs', 'acp', 25, 273, 274, 'ACP_GALLERY_LOGS', 'gallery', 'acl_a_viewlogs'),
	(136, 1, 1, 'main', 'acp', 1, 2, 3, 'ACP_INDEX', 'main', ''),
	(137, 1, 1, 'modules', 'acp', 30, 309, 310, 'ACP', 'acp', 'acl_a_modules'),
	(138, 1, 1, 'modules', 'acp', 30, 311, 312, 'UCP', 'ucp', 'acl_a_modules'),
	(139, 1, 1, 'modules', 'acp', 30, 313, 314, 'MCP', 'mcp', 'acl_a_modules'),
	(140, 1, 1, 'permission_roles', 'acp', 19, 225, 226, 'ACP_ADMIN_ROLES', 'admin_roles', 'acl_a_roles && acl_a_aauth'),
	(141, 1, 1, 'permission_roles', 'acp', 19, 227, 228, 'ACP_USER_ROLES', 'user_roles', 'acl_a_roles && acl_a_uauth'),
	(142, 1, 1, 'permission_roles', 'acp', 19, 229, 230, 'ACP_MOD_ROLES', 'mod_roles', 'acl_a_roles && acl_a_mauth'),
	(143, 1, 1, 'permission_roles', 'acp', 19, 231, 232, 'ACP_FORUM_ROLES', 'forum_roles', 'acl_a_roles && acl_a_fauth'),
	(144, 1, 1, 'permissions', 'acp', 16, 200, 201, 'ACP_PERMISSIONS', 'intro', 'acl_a_authusers || acl_a_authgroups || acl_a_viewauth'),
	(145, 1, 0, 'permissions', 'acp', 20, 235, 236, 'ACP_PERMISSION_TRACE', 'trace', 'acl_a_viewauth'),
	(146, 1, 1, 'permissions', 'acp', 18, 213, 214, 'ACP_FORUM_PERMISSIONS', 'setting_forum_local', 'acl_a_fauth && (acl_a_authusers || acl_a_authgroups)'),
	(147, 1, 1, 'permissions', 'acp', 18, 215, 216, 'ACP_FORUM_PERMISSIONS_COPY', 'setting_forum_copy', 'acl_a_fauth && acl_a_authusers && acl_a_authgroups && acl_a_mauth'),
	(148, 1, 1, 'permissions', 'acp', 18, 217, 218, 'ACP_FORUM_MODERATORS', 'setting_mod_local', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)'),
	(149, 1, 1, 'permissions', 'acp', 17, 203, 204, 'ACP_USERS_PERMISSIONS', 'setting_user_global', 'acl_a_authusers && (acl_a_aauth || acl_a_mauth || acl_a_uauth)'),
	(150, 1, 1, 'permissions', 'acp', 13, 145, 146, 'ACP_USERS_PERMISSIONS', 'setting_user_global', 'acl_a_authusers && (acl_a_aauth || acl_a_mauth || acl_a_uauth)'),
	(151, 1, 1, 'permissions', 'acp', 18, 219, 220, 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)'),
	(152, 1, 1, 'permissions', 'acp', 13, 147, 148, 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)'),
	(153, 1, 1, 'permissions', 'acp', 17, 205, 206, 'ACP_GROUPS_PERMISSIONS', 'setting_group_global', 'acl_a_authgroups && (acl_a_aauth|| acl_a_mauth || acl_a_uauth)'),
	(154, 1, 1, 'permissions', 'acp', 14, 179, 180, 'ACP_GROUPS_PERMISSIONS', 'setting_group_global', 'acl_a_authgroups && (acl_a_aauth || acl_a_mauth || acl_a_uauth)'),
	(155, 1, 1, 'permissions', 'acp', 18, 221, 222, 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)'),
	(156, 1, 1, 'permissions', 'acp', 14, 181, 182, 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)'),
	(157, 1, 1, 'permissions', 'acp', 17, 207, 208, 'ACP_ADMINISTRATORS', 'setting_admin_global', 'acl_a_aauth && (acl_a_authusers || acl_a_authgroups)'),
	(158, 1, 1, 'permissions', 'acp', 17, 209, 210, 'ACP_GLOBAL_MODERATORS', 'setting_mod_global', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)'),
	(159, 1, 1, 'permissions', 'acp', 20, 237, 238, 'ACP_VIEW_ADMIN_PERMISSIONS', 'view_admin_global', 'acl_a_viewauth'),
	(160, 1, 1, 'permissions', 'acp', 20, 239, 240, 'ACP_VIEW_USER_PERMISSIONS', 'view_user_global', 'acl_a_viewauth'),
	(161, 1, 1, 'permissions', 'acp', 20, 241, 242, 'ACP_VIEW_GLOBAL_MOD_PERMISSIONS', 'view_mod_global', 'acl_a_viewauth'),
	(162, 1, 1, 'permissions', 'acp', 20, 243, 244, 'ACP_VIEW_FORUM_MOD_PERMISSIONS', 'view_mod_local', 'acl_a_viewauth'),
	(163, 1, 1, 'permissions', 'acp', 20, 245, 246, 'ACP_VIEW_FORUM_PERMISSIONS', 'view_forum_local', 'acl_a_viewauth'),
	(164, 1, 1, 'php_info', 'acp', 29, 301, 302, 'ACP_PHP_INFO', 'info', 'acl_a_phpinfo'),
	(165, 1, 1, 'profile', 'acp', 13, 149, 150, 'ACP_CUSTOM_PROFILE_FIELDS', 'profile', 'acl_a_profile'),
	(166, 1, 1, 'prune', 'acp', 7, 87, 88, 'ACP_PRUNE_FORUMS', 'forums', 'acl_a_prune'),
	(167, 1, 1, 'prune', 'acp', 15, 195, 196, 'ACP_PRUNE_USERS', 'users', 'acl_a_userdel'),
	(168, 1, 1, 'ranks', 'acp', 13, 151, 152, 'ACP_MANAGE_RANKS', 'ranks', 'acl_a_ranks'),
	(169, 1, 1, 'reasons', 'acp', 29, 303, 304, 'ACP_MANAGE_REASONS', 'main', 'acl_a_reasons'),
	(170, 1, 1, 'search', 'acp', 5, 65, 66, 'ACP_SEARCH_SETTINGS', 'settings', 'acl_a_search'),
	(171, 1, 1, 'search', 'acp', 26, 281, 282, 'ACP_SEARCH_INDEX', 'index', 'acl_a_search'),
	(172, 1, 1, 'send_statistics', 'acp', 5, 67, 68, 'ACP_SEND_STATISTICS', 'send_statistics', 'acl_a_server'),
	(173, 1, 1, 'shoutbox', 'acp', 38, 401, 402, 'ACP_AS_OVERVIEW', 'overview', 'acl_a_as_manage'),
	(174, 1, 1, 'shoutbox', 'acp', 38, 403, 404, 'ACP_AS_SETTINGS', 'settings', 'acl_a_as_manage'),
	(175, 1, 1, 'styles', 'acp', 22, 251, 252, 'ACP_STYLES', 'style', 'acl_a_styles'),
	(176, 1, 1, 'styles', 'acp', 23, 255, 256, 'ACP_TEMPLATES', 'template', 'acl_a_styles'),
	(177, 1, 1, 'styles', 'acp', 23, 257, 258, 'ACP_THEMES', 'theme', 'acl_a_styles'),
	(178, 1, 1, 'styles', 'acp', 23, 259, 260, 'ACP_IMAGESETS', 'imageset', 'acl_a_styles'),
	(179, 1, 1, 'update', 'acp', 28, 291, 292, 'ACP_VERSION_CHECK', 'version_check', 'acl_a_board'),
	(180, 1, 1, 'users', 'acp', 13, 141, 142, 'ACP_MANAGE_USERS', 'overview', 'acl_a_user'),
	(181, 1, 0, 'users', 'acp', 13, 153, 154, 'ACP_USER_FEEDBACK', 'feedback', 'acl_a_user'),
	(182, 1, 0, 'users', 'acp', 13, 155, 156, 'ACP_USER_WARNINGS', 'warnings', 'acl_a_user'),
	(183, 1, 0, 'users', 'acp', 13, 157, 158, 'ACP_USER_PROFILE', 'profile', 'acl_a_user'),
	(184, 1, 0, 'users', 'acp', 13, 159, 160, 'ACP_USER_PREFS', 'prefs', 'acl_a_user'),
	(185, 1, 0, 'users', 'acp', 13, 161, 162, 'ACP_USER_AVATAR', 'avatar', 'acl_a_user'),
	(186, 1, 0, 'users', 'acp', 13, 163, 164, 'ACP_USER_RANK', 'rank', 'acl_a_user'),
	(187, 1, 0, 'users', 'acp', 13, 165, 166, 'ACP_USER_SIG', 'sig', 'acl_a_user'),
	(188, 1, 0, 'users', 'acp', 13, 167, 168, 'ACP_USER_GROUPS', 'groups', 'acl_a_user && acl_a_group'),
	(189, 1, 0, 'users', 'acp', 13, 169, 170, 'ACP_USER_PERM', 'perm', 'acl_a_user && acl_a_viewauth'),
	(190, 1, 0, 'users', 'acp', 13, 171, 172, 'ACP_USER_ATTACH', 'attach', 'acl_a_user'),
	(191, 1, 1, 'words', 'acp', 10, 115, 116, 'ACP_WORDS', 'words', 'acl_a_words'),
	(192, 1, 1, 'users', 'acp', 2, 5, 6, 'ACP_MANAGE_USERS', 'overview', 'acl_a_user'),
	(193, 1, 1, 'groups', 'acp', 2, 7, 8, 'ACP_GROUPS_MANAGE', 'manage', 'acl_a_group'),
	(194, 1, 1, 'forums', 'acp', 2, 9, 10, 'ACP_MANAGE_FORUMS', 'manage', 'acl_a_forum'),
	(195, 1, 1, 'logs', 'acp', 2, 11, 12, 'ACP_MOD_LOGS', 'mod', 'acl_a_viewlogs'),
	(196, 1, 1, 'bots', 'acp', 2, 13, 14, 'ACP_BOTS', 'bots', 'acl_a_bots'),
	(197, 1, 1, 'php_info', 'acp', 2, 15, 16, 'ACP_PHP_INFO', 'info', 'acl_a_phpinfo'),
	(198, 1, 1, 'permissions', 'acp', 8, 91, 92, 'ACP_FORUM_PERMISSIONS', 'setting_forum_local', 'acl_a_fauth && (acl_a_authusers || acl_a_authgroups)'),
	(199, 1, 1, 'permissions', 'acp', 8, 93, 94, 'ACP_FORUM_PERMISSIONS_COPY', 'setting_forum_copy', 'acl_a_fauth && acl_a_authusers && acl_a_authgroups && acl_a_mauth'),
	(200, 1, 1, 'permissions', 'acp', 8, 95, 96, 'ACP_FORUM_MODERATORS', 'setting_mod_local', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)'),
	(201, 1, 1, 'permissions', 'acp', 8, 97, 98, 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)'),
	(202, 1, 1, 'permissions', 'acp', 8, 99, 100, 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)'),
	(203, 1, 1, '', 'mcp', 0, 1, 10, 'MCP_MAIN', '', ''),
	(204, 1, 1, '', 'mcp', 0, 11, 18, 'MCP_QUEUE', '', ''),
	(205, 1, 1, '', 'mcp', 0, 19, 32, 'MCP_REPORTS', '', ''),
	(206, 1, 1, '', 'mcp', 0, 33, 38, 'MCP_NOTES', '', ''),
	(207, 1, 1, '', 'mcp', 0, 39, 48, 'MCP_WARN', '', ''),
	(208, 1, 1, '', 'mcp', 0, 49, 56, 'MCP_LOGS', '', ''),
	(209, 1, 1, '', 'mcp', 0, 57, 64, 'MCP_BAN', '', ''),
	(210, 1, 1, '', 'mcp', 0, 65, 74, 'ANTISPAM', '', ''),
	(211, 1, 1, '', 'mcp', 0, 75, 82, 'MCP_KB', '', ''),
	(212, 1, 1, 'asacp', 'mcp', 210, 66, 67, 'ASACP_SPAM_LOG', 'log', 'acl_m_asacp_spam_log'),
	(213, 1, 1, 'asacp', 'mcp', 210, 68, 69, 'ASACP_FLAG_LOG', 'flag', 'acl_m_asacp_user_flag'),
	(214, 1, 1, 'asacp', 'mcp', 210, 70, 71, 'ASACP_FLAG_LIST', 'flag_list', 'acl_m_asacp_user_flag'),
	(215, 1, 1, 'asacp', 'mcp', 210, 72, 73, 'ASACP_IP_SEARCH', 'ip_search', 'acl_m_asacp_ip_search'),
	(216, 1, 1, 'ban', 'mcp', 209, 58, 59, 'MCP_BAN_USERNAMES', 'user', 'acl_m_ban'),
	(217, 1, 1, 'ban', 'mcp', 209, 60, 61, 'MCP_BAN_IPS', 'ip', 'acl_m_ban'),
	(218, 1, 1, 'ban', 'mcp', 209, 62, 63, 'MCP_BAN_EMAILS', 'email', 'acl_m_ban'),
	(219, 1, 1, 'kb', 'mcp', 211, 76, 77, 'MCP_KB_MAIN', 'kb_main', ''),
	(220, 1, 1, 'kb', 'mcp', 211, 78, 79, 'MCP_KB_ACTIVATE', 'kb_activate', 'acl_m_activate_kb'),
	(221, 1, 1, 'kb', 'mcp', 211, 80, 81, 'MCP_KB_REPORTS', 'kb_reports', 'acl_m_report_kb'),
	(222, 1, 1, 'logs', 'mcp', 208, 50, 51, 'MCP_LOGS_FRONT', 'front', 'acl_m_ || aclf_m_'),
	(223, 1, 1, 'logs', 'mcp', 208, 52, 53, 'MCP_LOGS_FORUM_VIEW', 'forum_logs', 'acl_m_," . $id . "'),
	(224, 1, 1, 'logs', 'mcp', 208, 54, 55, 'MCP_LOGS_TOPIC_VIEW', 'topic_logs', 'acl_m_," . $id . "'),
	(225, 1, 1, 'main', 'mcp', 203, 2, 3, 'MCP_MAIN_FRONT', 'front', ''),
	(226, 1, 1, 'main', 'mcp', 203, 4, 5, 'MCP_MAIN_FORUM_VIEW', 'forum_view', 'acl_m_," . $id . "'),
	(227, 1, 1, 'main', 'mcp', 203, 6, 7, 'MCP_MAIN_TOPIC_VIEW', 'topic_view', 'acl_m_," . $id . "'),
	(228, 1, 1, 'main', 'mcp', 203, 8, 9, 'MCP_MAIN_POST_DETAILS', 'post_details', 'acl_m_," . $id . " || (!$id && aclf_m_)'),
	(229, 1, 1, 'notes', 'mcp', 206, 34, 35, 'MCP_NOTES_FRONT', 'front', ''),
	(230, 1, 1, 'notes', 'mcp', 206, 36, 37, 'MCP_NOTES_USER', 'user_notes', ''),
	(231, 1, 1, 'pm_reports', 'mcp', 205, 20, 21, 'MCP_PM_REPORTS_OPEN', 'pm_reports', 'aclf_m_report'),
	(232, 1, 1, 'pm_reports', 'mcp', 205, 22, 23, 'MCP_PM_REPORTS_CLOSED', 'pm_reports_closed', 'aclf_m_report'),
	(233, 1, 1, 'pm_reports', 'mcp', 205, 24, 25, 'MCP_PM_REPORT_DETAILS', 'pm_report_details', 'aclf_m_report'),
	(234, 1, 1, 'queue', 'mcp', 204, 12, 13, 'MCP_QUEUE_UNAPPROVED_TOPICS', 'unapproved_topics', 'aclf_m_approve'),
	(235, 1, 1, 'queue', 'mcp', 204, 14, 15, 'MCP_QUEUE_UNAPPROVED_POSTS', 'unapproved_posts', 'aclf_m_approve'),
	(236, 1, 1, 'queue', 'mcp', 204, 16, 17, 'MCP_QUEUE_APPROVE_DETAILS', 'approve_details', 'acl_m_approve," . $id . " || (!$id && aclf_m_approve)'),
	(237, 1, 1, 'reports', 'mcp', 205, 26, 27, 'MCP_REPORTS_OPEN', 'reports', 'aclf_m_report'),
	(238, 1, 1, 'reports', 'mcp', 205, 28, 29, 'MCP_REPORTS_CLOSED', 'reports_closed', 'aclf_m_report'),
	(239, 1, 1, 'reports', 'mcp', 205, 30, 31, 'MCP_REPORT_DETAILS', 'report_details', 'acl_m_report," . $id . " || (!$id && aclf_m_report)'),
	(240, 1, 1, 'warn', 'mcp', 207, 40, 41, 'MCP_WARN_FRONT', 'front', 'aclf_m_warn'),
	(241, 1, 1, 'warn', 'mcp', 207, 42, 43, 'MCP_WARN_LIST', 'list', 'aclf_m_warn'),
	(242, 1, 1, 'warn', 'mcp', 207, 44, 45, 'MCP_WARN_USER', 'warn_user', 'aclf_m_warn'),
	(243, 1, 1, 'warn', 'mcp', 207, 46, 47, 'MCP_WARN_POST', 'warn_post', 'acl_m_warn && acl_f_read," . $id . "'),
	(244, 1, 1, '', 'ucp', 0, 1, 12, 'UCP_MAIN', '', ''),
	(245, 1, 1, '', 'ucp', 0, 13, 26, 'UCP_PROFILE', '', ''),
	(246, 1, 1, '', 'ucp', 0, 27, 34, 'UCP_PREFS', '', ''),
	(247, 1, 1, '', 'ucp', 0, 35, 46, 'UCP_PM', '', ''),
	(248, 1, 1, '', 'ucp', 0, 47, 52, 'UCP_USERGROUPS', '', ''),
	(249, 1, 1, '', 'ucp', 0, 53, 58, 'UCP_ZEBRA', '', ''),
	(250, 0, 1, '', 'ucp', 0, 59, 68, 'UCP_GALLERY', '', ''),
	(251, 0, 1, '', 'ucp', 0, 69, 80, 'UCP_K_BLOCKS', '', ''),
	(252, 1, 1, 'attachments', 'ucp', 244, 10, 11, 'UCP_MAIN_ATTACHMENTS', 'attachments', 'acl_u_attach'),
	(253, 1, 1, 'gallery', 'ucp', 250, 60, 61, 'UCP_GALLERY_PERSONAL_ALBUMS', 'manage_albums', ''),
	(254, 1, 1, 'gallery', 'ucp', 250, 62, 63, 'UCP_GALLERY_SETTINGS', 'manage_settings', ''),
	(255, 1, 1, 'gallery', 'ucp', 250, 64, 65, 'UCP_GALLERY_WATCH', 'manage_subscriptions', ''),
	(256, 1, 1, 'gallery', 'ucp', 250, 66, 67, 'UCP_GALLERY_FAVORITES', 'manage_favorites', ''),
	(257, 1, 1, 'groups', 'ucp', 248, 48, 49, 'UCP_USERGROUPS_MEMBER', 'membership', ''),
	(258, 1, 1, 'groups', 'ucp', 248, 50, 51, 'UCP_USERGROUPS_MANAGE', 'manage', ''),
	(259, 1, 1, 'k_blocks', 'ucp', 251, 70, 71, 'UCP_K_BLOCKS_INFO', 'info', ''),
	(260, 1, 1, 'k_blocks', 'ucp', 251, 72, 73, 'UCP_K_BLOCKS_ARRANGE', 'arrange', ''),
	(261, 1, 1, 'k_blocks', 'ucp', 251, 74, 75, 'UCP_K_BLOCKS_EDIT', 'edit', ''),
	(262, 1, 1, 'k_blocks', 'ucp', 251, 76, 77, 'UCP_K_BLOCKS_DELETE', 'delete', ''),
	(263, 1, 1, 'k_blocks', 'ucp', 251, 78, 79, 'UCP_K_BLOCKS_WIDTH', 'width', ''),
	(264, 1, 1, 'main', 'ucp', 244, 2, 3, 'UCP_MAIN_FRONT', 'front', ''),
	(265, 1, 1, 'main', 'ucp', 244, 4, 5, 'UCP_MAIN_SUBSCRIBED', 'subscribed', ''),
	(266, 1, 1, 'main', 'ucp', 244, 6, 7, 'UCP_MAIN_BOOKMARKS', 'bookmarks', 'cfg_allow_bookmarks'),
	(267, 1, 1, 'main', 'ucp', 244, 8, 9, 'UCP_MAIN_DRAFTS', 'drafts', ''),
	(268, 1, 0, 'pm', 'ucp', 247, 36, 37, 'UCP_PM_VIEW', 'view', 'cfg_allow_privmsg'),
	(269, 1, 1, 'pm', 'ucp', 247, 38, 39, 'UCP_PM_COMPOSE', 'compose', 'cfg_allow_privmsg'),
	(270, 1, 1, 'pm', 'ucp', 247, 40, 41, 'UCP_PM_DRAFTS', 'drafts', 'cfg_allow_privmsg'),
	(271, 1, 1, 'pm', 'ucp', 247, 42, 43, 'UCP_PM_OPTIONS', 'options', 'cfg_allow_privmsg'),
	(272, 1, 0, 'pm', 'ucp', 247, 44, 45, 'UCP_PM_POPUP_TITLE', 'popup', 'cfg_allow_privmsg'),
	(273, 1, 1, 'prefs', 'ucp', 246, 28, 29, 'UCP_PREFS_PERSONAL', 'personal', ''),
	(274, 1, 1, 'prefs', 'ucp', 246, 30, 31, 'UCP_PREFS_POST', 'post', ''),
	(275, 1, 1, 'prefs', 'ucp', 246, 32, 33, 'UCP_PREFS_VIEW', 'view', ''),
	(276, 1, 1, 'profile', 'ucp', 245, 14, 15, 'UCP_PROFILE_PROFILE_INFO', 'profile_info', ''),
	(277, 1, 1, 'profile', 'ucp', 245, 16, 17, 'UCP_PROFILE_SIGNATURE', 'signature', 'acl_u_sig'),
	(278, 1, 1, 'profile', 'ucp', 245, 18, 19, 'UCP_PROFILE_AVATAR', 'avatar', 'cfg_allow_avatar && (cfg_allow_avatar_local || cfg_allow_avatar_remote || cfg_allow_avatar_upload || cfg_allow_avatar_remote_upload)'),
	(279, 1, 1, 'profile', 'ucp', 245, 20, 21, 'UCP_PROFILE_REG_DETAILS', 'reg_details', ''),
	(280, 1, 0, 'zebra', 'ucp', 249, 54, 55, 'UCP_ZEBRA_FRIENDS', 'friends', ''),
	(281, 1, 1, 'zebra', 'ucp', 249, 56, 57, 'UCP_ZEBRA_FOES', 'foes', ''),
	(282, 0, 1, '', 'acp', 0, 525, 532, 'ACP_CAT_MODS', '', 'acl_a_mods'),
	(283, 1, 1, '', 'acp', 282, 526, 531, 'ACP_MODS', '', 'acl_a_mods'),
	(284, 1, 1, 'mods', 'acp', 283, 527, 528, 'ACP_AUTOMOD', 'frontend', 'acl_a_mods'),
	(285, 1, 1, 'mods', 'acp', 283, 529, 530, 'ACP_AUTOMOD_CONFIG', 'config', 'acl_a_mods'),
	(288, 1, 1, 'modsdb', 'acp', 29, 305, 306, 'ACP_MODS_DATABASE', 'modsdb', 'acl_a_user'),
	(289, 1, 1, '', 'acp', 37, 428, 453, 'DOWNLOADS', '', ''),
	(290, 1, 1, 'downloads', 'acp', 289, 429, 430, 'ACP_USER_OVERVIEW', 'overview', 'acl_a_dl_overview'),
	(291, 1, 1, 'downloads', 'acp', 289, 431, 432, 'DL_ACP_CONFIG_MANAGEMENT', 'config', 'acl_a_dl_config'),
	(292, 1, 1, 'downloads', 'acp', 289, 433, 434, 'DL_ACP_TRAFFIC_MANAGEMENT', 'traffic', 'acl_a_dl_traffic'),
	(293, 1, 1, 'downloads', 'acp', 289, 435, 436, 'DL_ACP_CATEGORIES_MANAGEMENT', 'categories', 'acl_a_dl_categories'),
	(294, 1, 1, 'downloads', 'acp', 289, 437, 438, 'DL_ACP_FILES_MANAGEMENT', 'files', 'acl_a_dl_files'),
	(295, 1, 1, 'downloads', 'acp', 289, 439, 440, 'DL_ACP_PERMISSIONS', 'permissions', 'acl_a_dl_permissions'),
	(296, 1, 1, 'downloads', 'acp', 289, 441, 442, 'DL_ACP_STATS_MANAGEMENT', 'stats', 'acl_a_dl_stats'),
	(297, 1, 1, 'downloads', 'acp', 289, 443, 444, 'DL_ACP_BANLIST', 'banlist', 'acl_a_dl_banlist'),
	(298, 1, 1, 'downloads', 'acp', 289, 445, 446, 'DL_EXT_BLACKLIST', 'ext_blacklist', 'acl_a_dl_blacklist'),
	(299, 1, 1, 'downloads', 'acp', 289, 447, 448, 'DL_MANAGE', 'toolbox', 'acl_a_dl_toolbox'),
	(300, 1, 1, '', 'ucp', 0, 81, 86, 'DOWNLOADS', '', ''),
	(301, 1, 1, 'downloads', 'ucp', 300, 82, 83, 'DL_CONFIG', 'config', ''),
	(302, 1, 1, 'downloads', 'ucp', 300, 84, 85, 'DL_FAVORITE', 'favorite', ''),
	(303, 1, 1, 'downloads', 'acp', 289, 449, 450, 'DL_ACP_FIELDS', 'fields', 'acl_a_dl_fields'),
	(304, 1, 1, 'downloads', 'acp', 289, 451, 452, 'DL_ACP_BROWSER', 'browser', 'acl_a_dl_browser'),
	(305, 1, 1, '', 'acp', 37, 426, 427, 'ACP_CAT_CONTACT', '', ''),
	(306, 1, 1, 'contact', 'acp', 313, 393, 394, 'ACP_CAT_CONTACT', 'configuration', 'acl_a_contact'),
	(307, 1, 1, '', 'acp', 37, 482,489, 'MEETING_ADMIN', '', ''),
	(308, 1, 1, 'meeting', 'acp', 307, 483, 484, 'MEETING_CONFIG', 'config', 'acl_a_meeting_config'),
	(309, 1, 1, 'meeting', 'acp', 307, 485, 486, 'MEETING_ADD', 'add', 'acl_a_meeting_add'),
	(310, 1, 1, 'meeting', 'acp', 307, 487, 488, 'MEETING_MANAGE', 'manage', 'acl_a_meeting_manage'),
	(311, 1, 1, '', 'acp', 37, 490, 491, 'ACP_PAGES', '', ''),
	(312, 1, 1, 'pages', 'acp', 313, 395, 396, 'ACP_MANAGE_PAGES', 'pages', ''),
	(313, 1, 1, '', 'acp', 37, 386, 399, 'ACP_CAT_IMOD', '', ''),
	(319, 1, 1, 'imod_config', 'acp', 313, 387, 388, 'ACP_IMOD_CONFIG', 'config', 'acl_a_imod'),
	(325, 1, 1, '', 'acp', 37, 492, 493, 'ACP_CAT_MCHAT', '', ''),
	(326, 1, 1, 'mchat', 'acp', 313, 397, 398, 'ACP_CAT_MCHAT', 'configuration', 'acl_a_mchat'),
	(327, 1, 1, 'ads', 'acp', 3, 41, 42, 'ACP_ADVERTISEMENT_MANAGEMENT', 'default', 'acl_a_ads'),
	(330, 1, 1, '', 'ucp', 0, 91, 100, 'UCP_DIGESTS', '', ''),
	(338, 1, 1, '', 'acp', 1, 70, 81, 'ACP_DIGEST_SETTINGS', '', ''),
	(339, 1, 1, 'board', 'acp', 338, 71, 72, 'ACP_DIGEST_GENERAL_SETTINGS', 'digest_general', 'acl_a_board'),
	(340, 1, 1, 'board', 'acp', 338, 73, 74, 'ACP_DIGEST_USER_DEFAULT_SETTINGS', 'digest_user_defaults', 'acl_a_board'),
	(342, 1, 1, 'digests', 'ucp', 330, 92, 93, 'UCP_DIGESTS_BASICS', 'basics', ''),
	(343, 1, 1, 'digests', 'ucp', 330, 94, 95, 'UCP_DIGESTS_FORUMS_SELECTION', 'forums_selection', ''),
	(344, 1, 1, 'digests', 'ucp', 330, 96, 97, 'UCP_DIGESTS_POST_FILTERS', 'post_filters', ''),
	(345, 1, 1, 'digests', 'ucp', 330, 98, 99, 'UCP_DIGESTS_ADDITIONAL_CRITERIA', 'additional_criteria', ''),
	(349, 1, 1, 'board', 'acp', 338, 75, 76, 'ACP_DIGEST_EDIT_SUBSCRIBERS', 'digest_edit_subscribers', 'acl_a_board'),
	(350, 1, 1, 'board', 'acp', 338, 77, 78, 'ACP_DIGEST_BALANCE_LOAD', 'digest_balance_load', 'acl_a_board'),
	(351, 1, 1, 'board', 'acp', 338, 79, 80, 'ACP_DIGEST_MASS_SUBSCRIBE_UNSUBSCRIBE', 'digest_mass_subscribe_unsubscribe', 'acl_a_board'),
	(352, 1, 1, '', 'acp', 24, 284, 287, 'Files', '', ''),
	(353, 1, 1, 'file_backup', 'acp', 352, 285, 286, 'ACP_FILE_BACKUP', 'backup', 'acl_a_backup'),
	(354, 1, 1, 'groups_reg', 'acp', 14, 183, 184, 'ACP_GROUPS_REGS', 'groups_reg', 'acl_a_group'),
	(355, 1, 1, '', 'acp', 9, 128, 133, 'ACP_ABBCODES', '', ''),
	(356, 1, 1, 'abbcodes', 'acp', 355, 129, 130, 'ACP_ABBC3_SETTINGS', 'settings', 'acl_a_bbcode'),
	(357, 1, 1, 'abbcodes', 'acp', 355, 131, 132, 'ACP_ABBC3_BBCODES', 'bbcodes', 'acl_a_bbcode'),
	(358, 1, 1, 'user_details', 'acp', 13, 173, 174, 'ACP_USER_DETAILS', 'select', 'acl_a_user'),
	(359, 1, 1, '', 'acp', 37, 494, 507, 'ACP_POINTS', '', ''),
	(360, 1, 1, 'points', 'acp', 359, 495, 496, 'ACP_POINTS_INDEX_TITLE', 'points', 'acl_a_points'),
	(361, 1, 1, 'points', 'acp', 359, 497, 498, 'ACP_POINTS_BANK_TITLE', 'bank', 'acl_a_points'),
	(362, 1, 1, 'points', 'acp', 359, 499, 500, 'ACP_POINTS_LOTTERY_TITLE', 'lottery', 'acl_a_points'),
	(363, 1, 1, 'points', 'acp', 359, 501, 502, 'ACP_POINTS_ROBBERY_TITLE', 'robbery', 'acl_a_points'),
	(364, 1, 1, 'points', 'acp', 359, 503, 504, 'ACP_POINTS_FORUM_TITLE', 'forumpoints', 'acl_a_points'),
	(365, 1, 1, 'points', 'acp', 359, 505, 506, 'ACP_POINTS_USERGUIDE_TITLE', 'userguide', 'acl_a_points'),
	(366, 1, 1, '', 'acp', 3, 43, 46, 'ACP_FAQ_MANAGER', '', ''),
	(367, 1, 1, 'faq_manager', 'acp', 366, 44, 45, 'ACP_FAQ_MANAGER', 'default', 'acl_a_language'),
	(368, 1, 1, '', 'acp', 43, 522, 523, 'ACP_POINTS', '', ''),
	(369, 1, 1, '', 'acp', 0, 533, 566, 'ACP_CAT_SOCIALNET', '', ''),
	(370, 1, 1, 'socialnet', 'acp', 369, 534, 535, 'ACP_SN_MAIN', 'main', 'acl_a_sn_settings'),
	(371, 1, 1, '', 'acp', 369, 536, 547, 'ACP_SN_CONFIGURATION', '', ''),
	(372, 1, 1, 'socialnet', 'acp', 371, 537, 538, 'ACP_SN_AVAILABLE_MODULES', 'sett_modules', 'acl_a_sn_settings'),
	(373, 1, 1, 'socialnet', 'acp', 371, 539, 540, 'ACP_SN_CONFIRMBOX_SETTINGS', 'sett_confirmBox', 'acl_a_sn_settings'),
	(374, 1, 1, '', 'acp', 369, 548, 561, 'ACP_SN_MODULES_CONFIGURATION', '', ''),
	(375, 1, 1, 'socialnet', 'acp', 374, 549, 550, 'ACP_SN_IM_SETTINGS', 'module_im', 'acl_a_sn_settings'),
	(376, 1, 1, 'socialnet', 'acp', 374, 551, 552, 'ACP_SN_USERSTATUS_SETTINGS', 'module_userstatus', 'acl_a_sn_settings'),
	(377, 1, 1, 'socialnet', 'acp', 374, 553, 554, 'ACP_SN_APPROVAL_SETTINGS', 'module_approval', 'acl_a_sn_settings'),
	(378, 1, 1, 'socialnet', 'acp', 374, 555, 556, 'ACP_SN_ACTIVITYPAGE_SETTINGS', 'module_activitypage', 'acl_a_sn_settings'),
	(379, 1, 1, '', 'ucp', 0, 101, 114, 'UCP_SOCIALNET', '', ''),
	(380, 1, 1, 'socialnet', 'ucp', 379, 102, 103, 'UCP_ZEBRA_FRIENDS', 'module_approval_friends', ''),
	(381, 1, 1, 'socialnet', 'ucp', 379, 104, 105, 'UCP_SN_IM', 'module_im', ''),
	(382, 1, 1, 'socialnet', 'ucp', 379, 106, 107, 'UCP_SN_IM_HISTORY', 'module_im_history', ''),
	(383, 1, 1, 'socialnet', 'acp', 374, 557, 558, 'ACP_SN_NOTIFY_SETTINGS', 'module_notify', 'acl_a_sn_settings'),
	(384, 1, 1, 'socialnet', 'acp', 371, 541, 542, 'ACP_SN_BLOCKS_ENABLE', 'blocks_enable', 'acl_a_sn_settings'),
	(385, 1, 1, 'socialnet', 'acp', 371, 543, 544, 'ACP_SN_BLOCKS_CONFIGURATION', 'blocks_config', 'acl_a_sn_settings'),
	(386, 1, 1, 'socialnet', 'ucp', 379, 108, 109, 'UCP_SN_APPROVAL_UFG', 'module_approval_ufg', ''),
	(387, 1, 1, 'socialnet', 'ucp', 379, 110, 111, 'UCP_SN_PROFILE', 'module_profile', ''),
	(388, 1, 1, 'socialnet', 'ucp', 379, 112, 113, 'UCP_SN_PROFILE_RELATIONS', 'module_profile_relations', ''),
	(389, 1, 1, 'socialnet', 'ucp', 245, 22, 23, 'UCP_SN_PROFILE', 'module_profile', ''),
	(390, 1, 1, 'socialnet', 'ucp', 245, 24, 25, 'UCP_SN_PROFILE_RELATIONS', 'module_profile_relations', ''),
	(391, 1, 1, 'socialnet', 'acp', 374, 559, 560, 'ACP_SN_PROFILE_SETTINGS', 'module_profile', 'acl_a_sn_settings'),
	(392, 1, 1, '', 'mcp', 0, 83, 86, 'MCP_SOCIALNET', '', ''),
	(393, 1, 1, 'socialnet', 'mcp', 392, 84, 85, 'MCP_SN_REPORTUSER', 'module_reportuser', 'acl_m_sn_close_reports'),
	(394, 1, 1, 'socialnet', 'acp', 371, 545, 546, 'ACP_SN_ADDONS_HOOK_CONFIGURATION', 'addons', 'acl_a_sn_settings'),
	(395, 1, 1, 'ajaxlike', 'acp', 398, 135, 136, 'phpBB Ajax Like', 'config', 'acl_a_ajaxlike_mod'),
	(396, 1, 1, '', 'acp', 369, 562, 565, 'phpBB Ajax Like', '', ''),
	(397, 1, 1, 'ajaxlike', 'acp', 396, 563, 564, 'phpBB Ajax Like', 'config', 'acl_a_ajaxlike_mod'),
	(398, 1, 1, '', 'acp', 9, 134, 137, 'phpBB Ajax Like', '', ''),
	(399, 1, 1, '', 'acp', 37, 508, 519, 'ACP_BLOGS', '', ''),
	(400, 1, 1, 'blogs', 'acp', 399, 509, 510, 'ACP_BLOG_SETTINGS', 'settings', 'acl_a_blogmanage'),
	(401, 1, 1, 'blogs', 'acp', 399, 511, 512, 'ACP_BLOG_CATEGORIES', 'categories', 'acl_a_blogmanage'),
	(402, 1, 1, 'blogs', 'acp', 399, 513, 514, 'ACP_BLOG_PLUGINS', 'plugins', 'acl_a_blogmanage'),
	(403, 1, 1, 'blogs', 'acp', 399, 515, 516, 'ACP_BLOG_SEARCH', 'search', 'acl_a_blogmanage'),
	(404, 1, 1, 'blogs', 'acp', 399, 517, 518, 'ACP_EXTENSION_GROUPS', 'ext_groups', 'acl_a_blogmanage'),
	(405, 1, 1, '', 'mcp', 0, 87, 96, 'MCP_BLOG', '', ''),
	(406, 1, 1, 'blog', 'mcp', 405, 88, 89, 'MCP_BLOG_REPORTED_BLOGS', 'reported_blogs', 'acl_m_blogreport'),
	(407, 1, 1, 'blog', 'mcp', 405, 90, 91, 'MCP_BLOG_REPORTED_REPLIES', 'reported_replies', 'acl_m_blogreplyreport'),
	(408, 1, 1, 'blog', 'mcp', 405, 92, 93, 'MCP_BLOG_DISAPPROVED_BLOGS', 'disapproved_blogs', 'acl_m_blogapprove'),
	(409, 1, 1, 'blog', 'mcp', 405, 94, 95, 'MCP_BLOG_DISAPPROVED_REPLIES', 'disapproved_replies', 'acl_m_blogreplyapprove'),
	(410, 1, 1, '', 'ucp', 0, 115, 122, 'UCP_BLOG', '', ''),
	(411, 1, 1, 'blog', 'ucp', 410, 116, 117, 'UCP_BLOG_SETTINGS', 'ucp_blog_settings', 'acl_u_blogpost'),
	(412, 1, 1, 'blog', 'ucp', 410, 118, 119, 'UCP_BLOG_TITLE_DESCRIPTION', 'ucp_blog_title_description', 'acl_u_blogpost'),
	(413, 1, 1, 'blog', 'ucp', 410, 120, 121, 'UCP_BLOG_PERMISSIONS', 'ucp_blog_permissions', 'acl_u_blogpost')";
	return $sql;
}

$id = 0;
$result = replace_modules($id);
