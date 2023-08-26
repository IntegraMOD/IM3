<?php

/**
*
* @author RMcGirr83 (Rich McGirr) rmcgirr83@gmail.com 
* @package mChat
* @version $Id mchat_install.php
* @copyright (c) 2013 RMcGirr83 ( http://www.rmcgirr83.org/ )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();


if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

/*
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
$language_file = 'mods/info_acp_mchat';

// The name of the mod to be displayed during installation.
$mod_name = 'ACP_MCHAT_TITLE';

/*
* The name of the config variable which will hold the currently installed version
* You do not need to set this yourself, UMIL will handle setting and updating the version itself.
*/
$version_config_name = 'mchat_version';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	// Version 1.2.10
	'1.2.10'	=> array(
	
		// Lets add a config setting and set it to true
		'config_add' => array(
			array('mchat_enable', true),
		),

		// now install the mchat table
		// see if it exists from prior versions
		'custom'	=> 'mchat_table',
		
		// Now to add some tables
		// one will hold the chats, the other the config
		'table_add' => array(
			array('phpbb_mchat_config', array(
					'COLUMNS'		=> array(
						'config_name'		=> array('VCHAR', ''),
						'config_value'		=> array('VCHAR', ''),
					),
					'PRIMARY_KEY'	=> 'config_name',
				),
			),
			array('phpbb_mchat', array(
					'COLUMNS'		=> array(
						'message_id'		=> array('UINT', NULL, 'auto_increment'),
						'user_id'			=> array('UINT', 0),
						'user_ip'			=> array('VCHAR:40', ''),
						'message'			=> array('MTEXT_UNI', ''),
						'bbcode_bitfield'	=> array('VCHAR', ''),
						'bbcode_uid'		=> array('VCHAR:8', ''),
						'bbcode_options'	=> array('BOOL', '7'),
						'message_time'		=> array('INT:11', 0),
					),
					'PRIMARY_KEY'	=> 'message_id',
				),
			),			
		),		

		// Now we need to insert some data into the config table
		'table_insert'	=> array(
			array('phpbb_mchat_config', array(			
				array(			
					'config_name' 	=> 'refresh',
					'config_value'	=> '10',
				),
				array(			
					'config_name' 	=> 'message_limit',
					'config_value'	=> '10',
				),
				array(			
					'config_name' 	=> 'archive_limit',
					'config_value'	=> '25',
				),
				array(			
					'config_name' 	=> 'flood_time',
					'config_value'	=> '20',
				),
				array(			
					'config_name' 	=> 'max_message_lngth',
					'config_value'	=> '500',
				),
				array(			
					'config_name' 	=> 'max_words_lngth',
					'config_value'	=> '100',
				),
				array(			
					'config_name' 	=> 'custom_page',
					'config_value'	=> '1',
				),
				array(			
					'config_name' 	=> 'date',
					'config_value'	=> 'D M d, Y g:i a',
				),
				array(			
					'config_name' 	=> 'whois',
					'config_value'	=> '1',
				),	
				array(			
					'config_name' 	=> 'bbcode_disallowed',
					'config_value'	=> '',
				),
			)),			
		),		
		// Now to add some permission settings
		'permission_add' => array(
			array('u_mchat_use'),
			array('u_mchat_view'),
			array('u_mchat_edit'),
			array('u_mchat_delete'),
			array('u_mchat_ip'),
			array('u_mchat_flood_ignore'),
			array('u_mchat_archive'),
			array('u_mchat_bbcode'),
			array('u_mchat_smilies'),
			array('u_mchat_urls'),
			array('a_mchat'),
		),

		// How about we give some default permissions then as well?
		// Admins can do anything with the mini chat
		'permission_set' => array(
			// Global Group permissions
			array('ADMINISTRATORS', 'u_mchat_use', 'group'),
			array('ADMINISTRATORS', 'u_mchat_view', 'group'),
			array('ADMINISTRATORS', 'u_mchat_edit', 'group'),
			array('ADMINISTRATORS', 'u_mchat_delete', 'group'),
			array('ADMINISTRATORS', 'u_mchat_ip', 'group'),
			array('ADMINISTRATORS', 'u_mchat_flood_ignore', 'group'),
			array('ADMINISTRATORS', 'u_mchat_archive', 'group'),
			array('ADMINISTRATORS', 'u_mchat_bbcode', 'group'),
			array('ADMINISTRATORS', 'u_mchat_smilies', 'group'),
			array('ADMINISTRATORS', 'u_mchat_urls', 'group'),
			array('ADMINISTRATORS', 'a_mchat', 'group'),
			// Global Role permissions for admins
			array('ROLE_ADMIN_FULL', 'a_mchat'),
		),
		
		// and last but not least...give Stoker his module
		'module_add' => array(
			// First, lets add a new category named ACP_CAT_MCHAT to ACP_CAT_DOT_MODS
			array('acp', 'ACP_CAT_DOT_MODS', 'ACP_CAT_MCHAT'),

			// next let's add our module
			array('acp', 'ACP_CAT_MCHAT', array(
					'module_basename'	=> 'mchat',
					'modes'				=> array('configuration'),
					'module_auth'		=> 'a_mchat',
				),
			),
		),		
	),	
	// Version 1.2.11
	'1.2.11'	=> array(
		// let's add a prune feature
		'table_insert'	=> array(
			array('phpbb_mchat_config', array(			
				array(			
					'config_name' 	=> 'prune_enable',
					'config_value'	=> '0',
				),
				array(			
					'config_name' 	=> 'prune_num',
					'config_value'	=> '0',
				),
			)),			
		),
	),
	// Version 1.2.12
	'1.2.12' => array(
		// Insert a new entry
		'table_insert'	=> array(
			array('phpbb_mchat_config', array(			
				array(			
					'config_name' 	=> 'location',
					'config_value'	=> '1',
				),
			)),			
		),	
	),
	// Version 1.2.13
	'1.2.13' => array(
		// Nothing changed in this version.
	),
	// Version 1.2.14
	'1.2.14' => array(
		// Nothing changed in this version.
	),
	// Version 1.2.15
	'1.2.15' => array(
		// Insert a new entry
		'table_insert'	=> array(
			array('phpbb_mchat_config', array(			
				array(			
					'config_name' 	=> 'whois_refresh',
					'config_value'	=> '30',
				),
			)),			
		),	
	),
	// Version 1.2.16
	'1.2.16' => array(
		// Lets add a config setting and set it to true
		'config_add' => array(
			array('mchat_on_index', true),
		),
		// max_words_lngth was causing a problem
		// removed in 1.2.16, handled via css
		'table_row_remove'	=> array(
			array('phpbb_mchat_config', array(
					'config_name'		=> 'max_words_lngth',
			)),
		),		
	),
	// Version 1.2.17
	'1.2.17' => array(
		// Nothing changed in this version.
	),
	// Version 1.2.18
	'1.2.18' => array(
		// Nothing changed in this version.
	),	
	// Version 1.3.0
	'1.3.0' => array(
		// Lets add a config setting and set it to false
		'config_add' => array(
			array('mchat_new_posts', false),
		),	
		// Insert a new entry
		'table_insert'	=> array(
			array('phpbb_mchat_config', array(			
				array(			
					'config_name' 	=> 'static_message',
					'config_value'	=> '',
				),
				array(			
					'config_name' 	=> 'index_height',
					'config_value'	=> '250',
				),
				array(			
					'config_name' 	=> 'custom_height',
					'config_value'	=> '500',
				),
				array(			
					'config_name' 	=> 'override_min_post_chars',
					'config_value'	=> '0',
				),
				array(			
					'config_name' 	=> 'timeout',
					'config_value'	=> '0',
				),
				array(
					'config_name'	=> 'override_smilie_limit',
					'config_value'	=> '0',
				),
			)),			
		),
		// new entry allowing users to disable the mod when viewing index.php
		'table_column_add'	=> array(
			array('phpbb_users', 'user_mchat_index', array('BOOL', true)),
			array('phpbb_users', 'user_mchat_sound', array('BOOL', true)),
			array('phpbb_users', 'user_mchat_stats_index', array('BOOL', true)),
		),
		// in this version we will use a new table instead of relying
		// on the default sessions table to find who is chatting
		'table_add' => array(
			array('phpbb_mchat_sessions', array(
					'COLUMNS'		=> array(
						'user_id'			=> array('UINT', 0),
						'user_lastupdate'	=> array('TIMESTAMP', 0),
						'user_ip'			=> array('VCHAR:40', ''),
					),
					'PRIMARY_KEY'	=> 'user_id',
				),
			),
		),

		// add a module to the ACP for users
		'module_add' => array(
			array('acp', 'ACP_CAT_USERS', array(
				'module_basename'	=> 'users',
				'module_enabled'	=> 1,
				'module_display'	=> 0,
				'module_langname'	=> 'ACP_USER_MCHAT',
				'module_mode'		=> 'mchat',
				'module_auth'		=> 'acl_a_user',
				),
			),
			// First, lets add a new category named UCP_CAT_MCHAT
			array('ucp', false, 'UCP_CAT_MCHAT'),

			// next let's add our module
			array('ucp', 'UCP_CAT_MCHAT', array(
					'module_basename'	=> 'mchat',
					'modes'				=> array('configuration'),
					'module_auth'		=> 'u_mchat_use',
				),
			),
		),
		// add an index to the mchat table
		'table_index_add' => array(
			array('phpbb_mchat', 'user_id', 'user_id'),
		),
		'custom' => 'mchat_posting',

	),
	// Version 1.3.1
	'1.3.1' => array(
		//nothing to do
	),
	// Version 1.3.2
	'1.3.2' => array(
		//nothing to do
	),
	// Version 1.3.3
	'1.3.3' => array(
		//nothing to do	
	),
	// Version 1.3.4
	'1.3.4'	=> array(
		// Insert a new entry
		'table_insert'	=> array(
			array('phpbb_mchat_config', array(			
					'config_name' 	=> 'pause_on_input',
					'config_value'	=> '0',
				),
			),			
		),		
	),
	// Version 1.3.5
	'1.3.5'	=> array(
		// Lets add a config setting and set it to false
		'config_add' => array(
			array('mchat_stats_index', false),
		),
		'table_column_add'	=> array(
			array('phpbb_users', 'user_mchat_topics', array('BOOL', true)),
			array('phpbb_users', 'user_mchat_avatars', array('BOOL', true)),
		),		
		// Insert a new entry
		'table_insert'	=> array(
			array('phpbb_mchat_config', array(			
					'config_name' 	=> 'rules',
					'config_value'	=> '',
				),
			),
			array('phpbb_mchat_config', array(			
					'config_name' 	=> 'avatars',
					'config_value'	=> '0',
				),
			),					
		),
		'permission_unset' => array(
			// Global Role permissions for admins
			array('ROLE_ADMIN_FULL', 'a_mchat'),
		),	
	),
	// Version 1.3.6
	'1.3.6'	=> array(	
	
		//nothing to do here ...
		// purge the cache, template and theme...may save all nub questions...
		'cache_purge' => array('', 'template', 'theme'),
	),
	// Version 1.3.7
	'1.3.7'	=> array(	
	
		'permission_set' => array(
			// Registered users permissions
			array('REGISTERED', 'u_mchat_use', 'group'),
			array('REGISTERED', 'u_mchat_view', 'group'),
			array('REGISTERED', 'u_mchat_archive', 'group'),
			array('REGISTERED', 'u_mchat_bbcode', 'group'),
			array('REGISTERED', 'u_mchat_smilies', 'group'),
			array('REGISTERED', 'u_mchat_urls', 'group'),
		),
		'table_insert'	=> array(
			array('phpbb_mchat_config', array(			
				array(			
					'config_name' 	=> 'message_num',
					'config_value'	=> '10',
				),
			)),			
		),		
		'table_column_add'	=> array(
			array('phpbb_users', 'user_mchat_input_area', array('BOOL', true)),
		),
		'cache_purge' => array('', 'template', 'theme'),
	),
	// Version 1.3.8
	'1.3.8'	=> array(
		//nothing to do here ...
	),	
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

/*
* Here is our custom function that will be called
*
* @param string $action The action (install|update|uninstall) will be sent through this.
* @param string $version The version this is being run for will be sent through this.
*/
function mchat_table($action, $version)
{
	global $db, $table_prefix, $umil;

	if ($action == 'install')
	{
		// Run this when installing

		if ($umil->table_exists('phpbb_mchat'))
		{
			//table from previous version exists...delete it.
			$sql = 'DROP TABLE ' . $table_prefix . 'mchat';
			$db->sql_query($sql);
			return 'MCHAT_TABLE_DELETED';
		}			
		
		return 'MCHAT_NOTHING_TO_UPDATE';
	}
}

function mchat_posting ($action, $version)
{
	global $db, $table_prefix, $umil;
	
	if ($action == 'install' || $action == 'update')
	{
		if ($umil->table_column_exists('phpbb_mchat', 'forum_id'))
		{
			return 'MCHAT_NOTHING_TO_UPDATE';
		}
		else
		{
			$umil->table_column_add('phpbb_mchat', 'forum_id', array('UINT', 0));
			$umil->table_column_add('phpbb_mchat', 'post_id', array('UINT', 0));
			return 'MCHAT_TABLE_UPDATED';
		}
	}		
}		
?>