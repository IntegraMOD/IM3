<?php
/**
 *
 * @package phpBB Social Network
 * @version 0.7.2
 * @copyright (c) phpBB Social Network Team 2010-2012 http://phpbbsocialnetwork.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
 * @ignore
 */
define('UMIL_AUTO', true);
/**
 * @ignore
 */
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include_once($phpbb_root_path . 'common.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'phpBB Social Network';

/**
 * The name of the config variable which will hold the currently installed version
 * You do not need to set this yourself, UMIL will handle setting and updating the version itself.
 */
$version_config_name = 'version_socialNet';

/**
 * The language file which will be included when installing
 * Language entries that should exist in the language file for UMIL (replace $mod_name with the mod's name you set to $mod_name above)
 * $mod_name
 * 'INSTALL_' . $mod_name
 * 'INSTALL_' . $mod_name . '_CONFIRM'
 * 'UPDATE_' . $mod_name
 * 'UPDATE_' . $mod_name . '_CONFIRM'
 * 'UNINSTALL_' . $mod_name
 * 'UNINSTALL_' . $mod_name . '_CONFIRM'
 */

$language_file = array('ucp', 'mods/socialnet', 'mods/socialnet_acp');

/**
 * Load default constants for extend phpBB constants
 */
include_once($phpbb_root_path . 'socialnet/includes/constants.' . $phpEx);

/*
 * Options to display to the user (this is purely optional, if you do not need the options you do not have to set up this variable at all)
 * Uses the acp_board style of outputting information, with some extras (such as the 'default' and 'select_user' options)
 */

/*
 * Optionally we may specify our own logo image to show in the upper corner instead of the default logo.
 * $phpbb_root_path will get prepended to the path specified
 * Image height should be 50px to prevent cut-off or stretching.
 */
//$logo_img = 'styles/prosilver/imageset/site_logo.gif';

/*
 * The array of versions and actions within each.
 * You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
 *
 * You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
 * The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
 */
$versions = array(
	'0.7.0'	 => array(

		'module_add'		 => array(
			array('acp', 0, 'ACP_CAT_SOCIALNET'),
			array('acp', 'ACP_CAT_SOCIALNET', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'ACP_SN_MAIN',
				'module_mode'		 => 'main',
				'module_auth'		 => 'acl_a_sn_settings',
			)),
			array('acp', 'ACP_CAT_SOCIALNET', 'ACP_SN_CONFIGURATION'),
			array('acp', 'ACP_SN_CONFIGURATION', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'ACP_SN_AVAILABLE_MODULES',
				'module_mode'		 => 'sett_modules',
				'module_auth'		 => 'acl_a_sn_settings'
			)),
			array('acp', 'ACP_SN_CONFIGURATION', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'ACP_SN_CONFIRMBOX_SETTINGS',
				'module_mode'		 => 'sett_confirmBox',
				'module_auth'		 => 'acl_a_sn_settings'
			)),
			array('acp', 'ACP_CAT_SOCIALNET', 'ACP_SN_MODULES_CONFIGURATION'),
			array('acp', 'ACP_SN_MODULES_CONFIGURATION', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'ACP_SN_IM_SETTINGS',
				'module_mode'		 => 'module_im',
				'module_auth'		 => 'acl_a_sn_settings'
			)),
			array('acp', 'ACP_SN_MODULES_CONFIGURATION', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'ACP_SN_USERSTATUS_SETTINGS',
				'module_mode'		 => 'module_userstatus',
				'module_auth'		 => 'acl_a_sn_settings'
			)),
			array('acp', 'ACP_SN_MODULES_CONFIGURATION', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'ACP_SN_APPROVAL_SETTINGS',
				'module_mode'		 => 'module_approval',
				'module_auth'		 => 'acl_a_sn_settings'
			)),
			array('acp', 'ACP_SN_MODULES_CONFIGURATION', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'ACP_SN_ACTIVITYPAGE_SETTINGS',
				'module_mode'		 => 'module_activitypage',
				'module_auth'		 => 'acl_a_sn_settings'
			)),
			array('ucp', 0, 'UCP_SOCIALNET'),
			array('ucp', 'UCP_SOCIALNET', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'UCP_ZEBRA_FRIENDS',
				'module_mode'		 => 'module_approval_friends',
				'module_auth'		 => ''
			)),
			array('ucp', 'UCP_SOCIALNET', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'UCP_SN_IM',
				'module_mode'		 => 'module_im',
				'module_auth'		 => '',
			)),
			array('ucp', 'UCP_SOCIALNET', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'UCP_SN_IM_HISTORY',
				'module_mode'		 => 'module_im_history',
				'module_auth'		 => '',
			)),
			array('acp', 'ACP_SN_MODULES_CONFIGURATION', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'ACP_SN_NOTIFY_SETTINGS',
				'module_mode'		 => 'module_notify',
				'module_auth'		 => 'acl_a_sn_settings'
			)),
			array('acp', 'ACP_SN_CONFIGURATION', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'ACP_SN_BLOCKS_ENABLE',
				'module_mode'		 => 'blocks_enable',
				'module_auth'		 => 'acl_a_sn_settings'
			)),
			array('acp', 'ACP_SN_CONFIGURATION', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'ACP_SN_BLOCKS_CONFIGURATION',
				'module_mode'		 => 'blocks_config',
				'module_auth'		 => 'acl_a_sn_settings'
			)),
			array('ucp', 'UCP_SOCIALNET', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'UCP_SN_APPROVAL_UFG',
				'module_mode'		 => 'module_approval_ufg',
				'module_auth'		 => ''
			)),
			array('ucp', 'UCP_SOCIALNET', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'UCP_SN_PROFILE',
				'module_mode'		 => 'module_profile',
				'module_auth'		 => ''
			)),
			array('ucp', 'UCP_SOCIALNET', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'UCP_SN_PROFILE_RELATIONS',
				'module_mode'		 => 'module_profile_relations',
				'module_auth'		 => '',
			)),
			array('ucp', 'UCP_PROFILE', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'UCP_SN_PROFILE',
				'module_mode'		 => 'module_profile',
				'module_auth'		 => ''
			)),
			array('ucp', 'UCP_PROFILE', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'UCP_SN_PROFILE_RELATIONS',
				'module_mode'		 => 'module_profile_relations',
				'module_auth'		 => '',
			)),
			array('acp', 'ACP_SN_MODULES_CONFIGURATION', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'ACP_SN_PROFILE_SETTINGS',
				'module_mode'		 => 'module_profile',
				'module_auth'		 => 'acl_a_sn_settings'
			)),
			array('mcp', 0, 'MCP_SOCIALNET'),
			array('mcp', 'MCP_SOCIALNET', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'MCP_SN_REPORTUSER',
				'module_mode'		 => 'module_reportuser',
				'module_auth'		 => 'acl_m_sn_close_reports'
			)),
			array('acp', 'ACP_SN_CONFIGURATION', array(
				'module_basename'	 => 'socialnet',
				'module_langname'	 => 'ACP_SN_ADDONS_HOOK_CONFIGURATION',
				'module_mode'		 => 'addons',
				'module_auth'		 => 'acl_a_sn_settings'
			)),
		),

		'custom'			 => array(
			'phpbbSN_smilies_allow',
			'phpbbSN_create_fms_primarygroups',
			'phpbb_SN_umil_send'
		),

		'cache_purge'		 => array(
			'imageset',
			'template',
			'theme',
			'cache',
		),

	),

	'0.7.1'	 => array(

		'permission_set' => array(
			// USER GROUP permissions
			array('REGISTERED', 'u_sn_userstatus', 'group', true),
			array('REGISTERED', 'u_sn_notify', 'group', true),
			array('REGISTERED', 'u_sn_im', 'group', true),
			array('NEWLY_REGISTERED', 'u_sn_userstatus', 'group', true),
			array('NEWLY_REGISTERED', 'u_sn_notify', 'group', true),
			array('NEWLY_REGISTERED', 'u_sn_im', 'group', true),
			// USER ROLE permissions
			array('ROLE_USER_STANDARD', 'u_sn_userstatus', 'role', true),
			array('ROLE_USER_STANDARD', 'u_sn_notify', 'role', true),
			array('ROLE_USER_STANDARD', 'u_sn_im', 'role', true),
			array('ROLE_USER_FULL', 'u_sn_userstatus', 'role', true),
			array('ROLE_USER_FULL', 'u_sn_notify', 'role', true),
			array('ROLE_USER_FULL', 'u_sn_im', 'role', true),
			array('ROLE_USER_NEW_MEMBER', 'u_sn_userstatus', 'role', true),
			array('ROLE_USER_NEW_MEMBER', 'u_sn_notify', 'role', true),
			array('ROLE_USER_NEW_MEMBER', 'u_sn_im', 'role', true),
			// MODERATOR ROLE permissions
			array('ROLE_MOD_FULL', 'm_sn_close_reports', 'role', true),
			array('ROLE_MOD_STANDARD', 'm_sn_close_reports', 'role', true),
			// ADMINISTRATOR ROLE permissions
			array('ROLE_ADMIN_STANDARD', 'a_sn_settings', 'role', true),
			array('ROLE_ADMIN_FULL', 'a_sn_settings', 'role', true),
		),

		'custom'			 => array(
			'phpbb_SN_umil_send'
		)
	),

	'0.7.2'	 => array(
		'custom'			 => array(
			'phpbbSN_replace_primary_by_unique',
			'phpbb_SN_umil_send'
		),

		'cache_purge'		 => array(
			'imageset',
			'template',
			'theme',
			'cache',
		),
	),
);

if (!defined('DEBUG_EXTRA'))
{
	define('DEBUG_EXTRA', true);
}

$sql = "SELECT * FROM " . CONFIG_TABLE . " WHERE config_name = '{$version_config_name}'";
$rs = $db->sql_query($sql);
$c_version = $db->sql_fetchfield('config_value');
$db->sql_freeresult($rs);

/**
 * Check if DB update need to run previously DB update
 */
$previous_versions = array('0.7.0');

foreach ($previous_versions as $idx => $a_version)
{
	if ($c_version != '' && version_compare($c_version, $a_version, 'lt'))
	{
		include($phpbb_root_path . 'umil/umil_frontend.' . $phpEx);
		$umil = new umil_frontend();
		$stages = array('UPDATE');

		$umil->display_stages($stages);
		$template->set_filenames(array(
			'body' => 'message_body.html'
		));

		$template->assign_vars(array(
			'S_USER_NOTICE'	 => false,
			'MESSAGE_TITLE'	 => 'phpBB Social Network has been already installed',
			'MESSAGE_TEXT'	 => '</p></div>phpBB Social Network ' . $c_version . ' is already installed on this board.<br />We recommend you to update it to version ' . $a_version . '.<br />Please read update instructions, where you can find the <a href="' . $phpbb_root_path . 'socialnet/update_sn_' . $a_version . '.' . $phpEx . '">update database script</a>.<div><p>'
		));

		$umil->done();
	}
}
// Include the UMIF Auto file and everything else will be handled automatically.
/**
 * @ignore
 */
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

function phpbbSN_smilies_allow($action, $version)
{
	global $db;

	if (($action == 'install' || $action == 'update') && $version == '0.7.0')
	{
		$sql = "SELECT smiley_id FROM " . SMILIES_TABLE;
		$rs = $db->sql_query($sql);

		$db->sql_return_on_error(true);
		while ($row = $db->sql_fetchrow($rs))
		{
			$sql = "INSERT INTO " . SN_SMILIES_TABLE . " (smiley_id, smiley_allowed) VALUES ({$row['smiley_id']},1)";
			$db->sql_query($sql);
		}
		$db->sql_return_on_error(false);

		$db->sql_freeresult($rs);

		return 'Social Network::IM smilies default settings added';
	}
	else
	{
		return 'Social Network::IM smilies default settings untouched';
	}
}

function phpbbSN_create_fms_primarygroups($action, $version)
{
	global $db;

	if (($action == 'install' || $action == 'update') && $version == '0.7.0')
	{
		$return_status = '';
		$sql = "SELECT user_id FROM " . USERS_TABLE . " WHERE user_type <> 2";
		$rs = $db->sql_query($sql);
		$rowset = $db->sql_fetchrowset($rs);
		if ($action == 'update')
		{
			$db->sql_return_on_error(true);
			for ($i = 0; isset($rowset[$i]); $i++)
			{
				$sql = "INSERT INTO " . SN_FMS_GROUPS_TABLE . " (fms_gid,user_id,fms_name,fms_clean,fms_collapse) VALUES (0,{$rowset[$i]['user_id']}, '---','---',0)";
				$db->sql_query($sql);
			}
			$db->sql_return_on_error(false);
		}

		$sql = "SELECT COUNT(*) FROM " . SN_FMS_USERS_GROUP_TABLE . " WHERE owner_id = 0";
		$rs = $db->sql_query($sql);
		if ($db->sql_affectedrows($rs))
		{
			$return_status = '- There are friends to be included into groups. Use SQL manager to repair.';
		}

		return 'Social Network::FMS IM primary groups added' . $return_status;
	}
	else
	{
		return 'Social Network::FMS IM primary groups untouched';
	}
}

function phpbb_SN_umil_send($action, $version)
{
	global $version_config_name, $config, $user, $versions;

	$max_version = max(array_keys($versions));

	$condition = true;
	if ($_POST['version_select'] == '')
	{
		if ( $action == 'uninstall' )
		{
			$condition = false;
		}
		else
		{
			if ( $version == $max_version )
			{
				$condition == false;
			}
		}
	}

	if ( $condition )
	{
		$action .= ' ' . $version;
	}
	else
	{
		$data = array(
			'a'	 => $action,
			'o'	 => isset($config[$version_config_name]) ? $config[$version_config_name] : '0.0.0',
			'n'	 => ($action == 'uninstall') ? $_POST['version_select'] : $version,
			's'	 => $config['server_name'],
			'p'	 => $config['script_path'],
			't'	 => time(),
			'u'	 => $user->data['username']
		);
		$query = http_build_query(array('q' => base64_encode(serialize($data))));

		$host = "update.phpbb3hacks.com";
		$directory = '/socialnet';
		$filename = 'update_sn.php';
		$port = 80;
		$errno = 0;
		$errstr = '';
		$timeout = 6;

		$file_info = '';
		if ($fsock = @fsockopen($host, $port, $errno, $errstr, $timeout))
		{
			@fputs($fsock, "POST $directory/$filename HTTP/1.1\r\n");
			@fputs($fsock, "Host: $host\r\n");
			@fputs($fsock, "Referer: {$_SERVER['HTTP_REFERER']}\r\n");
			@fputs($fsock, "Content-type: application/x-www-form-urlencoded\r\n");
			@fputs($fsock, "Content-length: " . strlen($query) . "\r\n");
			@fputs($fsock, "Connection: close\r\n\r\n");
			@fputs($fsock, $query);

			$timer_stop = time() + $timeout;
			@stream_set_timeout($fsock, $timeout);

			$get_info = false;

			while (!@feof($fsock))
			{
				if ($get_info)
				{
					$file_info .= @fread($fsock, 1024);
				}
				else
				{
					$line = @fgets($fsock, 1024);
					if ($line == "\r\n")
					{
						$get_info = true;
					}
					else if (stripos($line, '404 not found') !== false)
					{
						$errstr = $user->lang['FILE_NOT_FOUND'] . ': ' . $filename;
						return false;
					}
				}

				$stream_meta_data = stream_get_meta_data($fsock);

				if (!empty($stream_meta_data['timed_out']) || time() >= $timer_stop)
				{
					return false;
				}
			}
			$file_info = explode("\r\n", trim($file_info));
			$file_info = $file_info[1];
			@fclose($fsock);
		}
		else
		{
			$file_info = strtoupper($action) . '_FAILED';
		}
	}

	return "Social Network: {$action} is completed";
}

function phpbbSN_replace_primary_by_unique($action, $version)
{
	global $db, $umil;

	if ($action == 'update')
	{
		switch ($db->sql_layer)
		{
			case 'firebird':
			case 'postgres':
			case 'oracle':
			case 'mssql':
			case 'mssqlnative':

				$db->sql_query('ALTER TABLE ' . SN_FMS_GROUPS_TABLE . ' DROP CONSTRAINT PRIMARY');

			break;

			case 'mysql_40':
			case 'mysql_41':
			case 'mysqli':
			case 'mysql':
			case 'mysql4':

				$db->sql_query('ALTER TABLE ' . SN_FMS_GROUPS_TABLE . ' DROP PRIMARY KEY');

			break;

			case 'sqlite':

				// do nothing, because no installation succeeded before this patch,
				// see https://github.com/phpBB-Social-Network/phpBB-Social-Network/pull/144

			break;
		}

		$db->sql_query('ALTER TABLE ' . SN_FMS_GROUPS_TABLE . ' ADD PRIMARY KEY (fms_gid)');
		$db->sql_query('ALTER TABLE ' . SN_FMS_GROUPS_TABLE . ' ADD CONSTRAINT f UNIQUE (user_id, fms_clean)');
	}

	return 'Updating of keys in SN_FMS_GROUPS_TABLE was successfully completed.';
}

if ( !function_exists('http_build_query'))
{
  /**
   * Generate URL-encoded query string for php4
	 * @see http://php.net/manual/en/function.http-build-query.php
	 * @param array It may be a simple one-dimensional structure, or an array of arrays
	 * @param string If numeric indices are used in the base array and this parameter is provided, it will be prepended to the numeric index for elements in the base array only
	 * @param string Used to separate arguments
	 * @param int Not used in function, just because of compatibility with php5 function
	 * @return string Returns a URL-encoded string
	 */
	function http_build_query($data, $prefix = '', $separator = '&', $enc_type = 0)
	{
		$queryString = '';

		if (is_array($data))
		{
			foreach ($data as $key => $value)
			{
				$correctKey = $prefix;

				if ('' === $prefix)
				{
					$correctKey .= $key;
				}
				else
				{
					$correctKey .= "[" . $key . "]";
				}

				if (!is_array($value))
				{
					$queryString .= urlencode($correctKey) . "=" . urlencode($value) . $separator;
				}
				else
				{
					$queryString .= http_build_query($value, $correctKey, $separator, $enc_type);
				}
			}
		}

		return substr($queryString, 0, strlen($queryString) - strlen($separator));
	}
}

?>
