<?php
/**
*
* @package phpBB3
* @version $Id: memberlist.php,v 1.247 2007/07/26 15:49:44 acydburn Exp $
* @copyright (c) 2005 phpBB Group
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
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('mods_db'));

$is_authorised = ( $config['mod_show'] == 0 && $user->data['is_registered'] && !$user->data['is_bot']) ? true : ( $config['mod_show'] == 1 && $auth->acl_get('a_',' m_') ) ? true : ( $config['mod_show'] == 2 && $auth->acl_get('a_') ) ? true : false;

if (!$is_authorised)
{
trigger_error('NOT_AUTHORISED');
}

// Grab data
$mode		= request_var('mode', '');
$action		= request_var('action', '');
$mod_id		= request_var('m', '');

// Check our mode...
if (!in_array($mode, array('', 'moddetail')))
{
	trigger_error('NO_MODE');
}
$start	= request_var('start', 0);
$submit = (isset($_POST['submit'])) ? true : false;

$default_key = 'a';
$sort_key = request_var('sk', $default_key);
$sort_dir = request_var('sd', 'a');




switch ($mode)
{
	case 'moddetail':
		$page_title = $user->lang['MODS_DATABASE_DETAIL'];
		$template_html = 'modsdb_body_detail.html';

				$sql = 'SELECT *
					FROM ' . MODS_DATABASE_TABLE . '
					WHERE ' . $db->sql_in_set('mod_id', $mod_id);
			
			$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{

			if ( $row['mod_access'] && !$auth->acl_get('a_') )
			{
			trigger_error('NOT_AUTHORISED');
			}
			elseif ( !$is_authorised )
			{
			trigger_error('NOT_AUTHORISED');
			}


			$template->assign_vars(array(
				'MOD_TITLE'			=> $row['mod_title'],
				'MOD_VERSION'		=> $row['mod_version'],
				'MOD_VERSION_TYPE'	=> $row['mod_version_type'],
				'MOD_DESC'			=> prepare_description($row['mod_desc']),
				'MOD_AUTHOR'		=> $row['mod_author'],
				'MOD_AUTHOR_EMAIL'	=> $row['mod_author_email'],
				'WWW_IMG' 			=> $user->img('icon_contact_www', $user->lang['WWW']),
				'DOWNLOAD_IMG' 		=> $user->img('icon_download', $user->lang['DOWNLOAD']),
				'MOD_URL'			=> $row['mod_url'],
				'MOD_PHPBB_VERSION'	=> $row['mod_phpbb_version'],
				'MOD_COMMENTS'		=> prepare_description($row['mod_comments']),
				'MOD_DOWNLOAD_URL'	=> $row['mod_download'],
				'MOD_INSTALL_DATE'	=> $row['mod_install_date'] ? date('d F Y', $row['mod_install_date']) : '',
				
				'S_MOD_IS_FOUNDER' 	=> ($user->data['user_type'] == USER_FOUNDER) ? true : false

			));

		}
		$db->sql_freeresult($result);


	break;

	default:

	// The basic memberlist
		$page_title = $user->lang['MODS_DATABASE'];
		$template_html = 'modsdb_body.html';

		// Sorting
		$sort_key_text = array('a' => $user->lang['SORT_MOD_TITLE'], 'b' => $user->lang['SORT_MOD_VERSION'], 'c' => $user->lang['SORT_MOD_AUTHOR']);

		$sort_key_sql = array('a' => 'mod_title', 'b' => 'mod_version', 'c' => 'mod_author');

		$sort_dir_text = array('a' => $user->lang['ASCENDING'], 'd' => $user->lang['DESCENDING']);

			// Additional sorting options for user search ... if search is enabled, if not
		// then only admins can make use of this (for ACP functionality)
		$order_by = '';

		$form			= request_var('form', '');
		$field			= request_var('field', '');
		$select_single 	= request_var('select_single', false);	
	
		// Sorting and order
		if (!isset($sort_key_sql[$sort_key]))
		{
			$sort_key = $default_key;
		}

		$order_by .= $sort_key_sql[$sort_key] . ' ' . (($sort_dir == 'a') ? 'ASC' : 'DESC');

		$where = (!$auth->acl_get('a_')) ? 'WHERE mod_access = 0' : '';
		// Count the  MODs ...
			$sql = 'SELECT COUNT(mod_id) AS total_mods
				FROM ' . MODS_DATABASE_TABLE . " 
				$where";
			$result = $db->sql_query($sql);
			$total_mods = (int) $db->sql_fetchfield('total_mods');
			$db->sql_freeresult($result);
		


		// Build a relevant pagination_url
		$params = $sort_params = array();
		foreach (array('_POST', '_GET') as $global_var)
		{
			foreach ($$global_var as $key => $var)
			{
				if ($global_var == '_POST')
				{
					unset($_GET[$key]);
				}

				if (in_array($key, array('submit', 'start', 'mode', 'char')) || empty($var))
				{
					continue;
				}

				$param = urlencode($key) . '=' . urlencode(htmlspecialchars($var));
				$params[] = $param;

				if (!in_array($key, array('sk', 'sd')))
				{
					$sort_params[] = $param;
				}
			}
		}

		$pagination_url = append_sid("{$phpbb_root_path}modsdb.$phpEx", implode('&amp;', $params));
		$sort_url = append_sid("{$phpbb_root_path}modsdb.$phpEx", implode('&amp;', $sort_params));

		unset($params, $sort_params);


		// Get us some MODS :D
		$sql = "SELECT mod_id
			FROM " . MODS_DATABASE_TABLE . " 
			$where
			ORDER BY $order_by";
		$result = $db->sql_query_limit($sql, $config['topics_per_page'], $start);

		$mods_list = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$mods_list[] = (int) $row['mod_id'];
		}
		$db->sql_freeresult($result);

		// So, did we get any MODS?
		if (sizeof($mods_list))
		{

			// Do the SQL thang
				$sql = 'SELECT *
					FROM ' . MODS_DATABASE_TABLE . '
					WHERE ' . $db->sql_in_set('mod_id', $mods_list);
			
			$result = $db->sql_query($sql);

			$id_cache = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$id_cache[$row['mod_id']] = $row;
			}
			$db->sql_freeresult($result);
				

			for ($i = 0, $end = sizeof($mods_list); $i < $end; ++$i)
			{
				$mod_id = $mods_list[$i];
				$row =& $id_cache[$mod_id];
			
				
			$template->assign_block_vars('modsrow', array(
				'ROW_NUMBER'		=> $i + ($start + 1),
				'MOD_TITLE'			=> $row['mod_title'],
				'MOD_VERSION'		=> $row['mod_version'],
				'MOD_VERSION_TYPE'	=> $row['mod_version_type'],
				'MOD_DESC'			=> prepare_description($row['mod_desc']),
				'MOD_AUTHOR'		=> $row['mod_author'],
				'WWW_IMG' 			=> $user->img('icon_contact_www', $user->lang['WWW']),
				'DOWNLOAD_IMG' 		=> $user->img('icon_download', $user->lang['WWW']),
				'MOD_URL'			=> $row['mod_url'],
				'MOD_DETAIL'		=> append_sid("{$phpbb_root_path}modsdb.$phpEx", "mode=moddetail&amp;m={$mod_id}"),
				'MOD_DOWNLOAD_URL'	=> $row['mod_download'],
				'MOD_PHPBB_VERSION'	=> $row['mod_phpbb_version'],
				'MOD_COMMENTS'		=> $row['mod_comments'],
				'MOD_ACCESS'		=> $row['mod_access'])
				
			);
			
				unset($id_cache[$mod_id]);
			
			}
		}
	
		// Generate page
		$template->assign_vars(array(
			'PAGINATION'	=> generate_pagination($pagination_url, $total_mods, $config['topics_per_page'], $start),
			'PAGE_NUMBER'	=> on_page($total_mods, $config['topics_per_page'], $start),
			'TOTAL_MODS'	=> ($total_mods == 1) ? $user->lang['LIST_MOD'] : sprintf($user->lang['LIST_MODS'], $total_mods),

			'U_SORT_MOD_TITLE'		=> $sort_url . '&amp;sk=a&amp;sd=' . (($sort_key == 'a' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_MOD_VERSION'	=> $sort_url . '&amp;sk=b&amp;sd=' . (($sort_key == 'b' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_MOD_AUTHOR'		=> $sort_url . '&amp;sk=c&amp;sd=' . (($sort_key == 'c' && $sort_dir == 'a') ? 'd' : 'a'),

			'S_MODE_ACTION'		=> $pagination_url . "&amp;form=$form")
		);
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
// Output the page
page_header($page_title);

$template->set_filenames(array(
	'body' => $template_html)
);
make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));

page_footer();
?>