<?php
/**
*
* @author eMosbat
* @package umil
* @copyright (c) 2008 phpBB Group
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

$mod_name = 'AJAXLIKE_MOD';
$version_config_name = 'ajaxlike_version';
$language_file = 'mods/umil_ajaxlike';

$versions = array(

	'0.0.1'	=> array(
		// Lets add a config setting named ajaxlike_enable and set it to true
		'config_add' => array(
			array('ajaxlike_enable', true),
			array('ajaxlike_guest_can_view', true),
			array('ajaxlike_alter_mode', false),
			array('ajaxlike_allow_unlike', true),
			array('ajaxlike_list_in_profile', true),
			array('ajaxlike_profile_num', 0),
			array('ajaxlike_notify', true),
			array('ajaxlike_notify_interval', 15),
		),

		'permission_add' => array(
			array('a_ajaxlike_mod', true),
			array('f_ajaxlike_mod', false),
			array('u_ajaxlike_mod', true),
		),

		'permission_set' => array(
			// Global Role permissions
			array('ROLE_ADMIN_FULL', 'a_ajaxlike_mod'),
			array('ROLE_USER_FULL', 'u_ajaxlike_mod'),
			array('ROLE_FORUM_STANDARD', 'f_ajaxlike_mod'),
		),
		
		'custom'	=> 'ajaxlike_create_tables',

	),

	'0.0.4' => array(

		'module_add' => array(
			array('acp', 'ACP_CAT_DOT_MODS', 'phpBB Ajax Like'),

			array('acp', 'phpBB Ajax Like', array(
					'module_basename'		=> 'ajaxlike',
					'modes'					=> array('config'),
				),
			),
		),
		
		'table_column_add' => array(
			array('phpbb_users', 'show_likes', array('BOOL', 1)),
		),

	),

	'1.2.0' => array(
		// Nothing changed in this version.
	),
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

function ajaxlike_create_tables($action, $version)
{
	global $db, $table_prefix, $umil;

	if ($action == 'install')
	{
		if(!$umil->table_exists('phpbb_likes')) {
		// Run this when installing
		$umil->table_add('phpbb_likes', array(
					'COLUMNS'		=> array(
						'like_id'			=> array('INT:11', NULL, 'auto_increment'),
						'post_id'			=> array('UINT', NULL, ''),
						'topic_id'			=> array('UINT', NULL, ''),
						'poster_id'			=> array('UINT', NULL, ''),
						'user_id'			=> array('UINT', NULL, ''),
						'like_date'			=> array('INT:11', NULL, ''),
					    'like_state'	    => array('UINT', NULL, ''),
					    'like_read'		    => array('UINT', NULL, ''),
					),
					'PRIMARY_KEY'	=> 'like_id'
				));
		}
	}

}

?>