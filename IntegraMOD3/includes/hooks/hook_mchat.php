<?php
/**
*
* @package mchat
* @version $Id$
* @copyright (c) 2011 RMcGirr83 (Rich McGirr)
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

// hook into the acp_users class
/*
class mchat_acp_users extends acp_users
{
}
*/
/**
 * This hook displays the mchat functions
 *
 * @param hook_mchat $hook
 * @return void
 */
function hook_mchat(&$hook)
{
	global $auth, $cache, $config, $db, $template, $user;
	global $phpbb_root_path, $phpEx;

	// cause no errors during update of forum software
	if (defined('IN_INSTALL'))
	{
		return;
	}	
	$mchat_installed = (!empty($config['mchat_version']) && !empty($config['mchat_enable']) && $auth->acl_get('u_mchat_view')) ? true : false;
	if ($mchat_installed)
	{
		if(!function_exists('mchat_cache'))
		{
			include ($phpbb_root_path . 'includes/functions_mchat.' . $phpEx);
		}	
		// Add lang file
		$user->add_lang('mods/mchat_lang');		

		if (($config_mchat = $cache->get('_mchat_config')) === false)
		{
			mchat_cache();
		}
		$config_mchat = $cache->get('_mchat_config');
		$page_name = substr($user->page['page_name'], 0, strpos($user->page['page_name'], '.'));
		// check the users page
		if($page_name == 'index' && $user->data['user_mchat_index'])
		{
			// mod included on index page?
			if(!defined('MCHAT_INCLUDE') && $config['mchat_on_index'])
			{
				define('MCHAT_INCLUDE', true);
				$mchat_include_index = true;
				include($phpbb_root_path . 'mchat.' . $phpEx);
			}
		}
		
//		if($page_name == 'portal' && $user->data['user_mchat_portal'])
//		{
//			// mod included on portal page?
//			if(!defined('MCHAT_INCLUDE') && $config['mchat_on_portal'])
//			{
//				define('MCHAT_INCLUDE', true);
//				$mchat_include_portal = true;
//				include($phpbb_root_path . 'mchat.' . $phpEx);
//			}
//		}
		
		// show index stats
		if (!empty($config['mchat_stats_index']) && !empty($user->data['user_mchat_stats_index']))
		{
			// stats display
			$mchat_session_time = !empty($config_mchat['timeout']) ? $config_mchat['timeout'] : $config['session_length'];
			$mchat_stats = mchat_users($mchat_session_time);
			$template->assign_vars(array(
				'MCHAT_INDEX_STATS'	=> true,
				'MCHAT_INDEX_USERS_COUNT'	=> $mchat_stats['mchat_users_count'],
				'MCHAT_INDEX_USERS_LIST'	=> !empty($mchat_stats['online_userlist']) ? $mchat_stats['online_userlist'] : '',
				'L_MCHAT_ONLINE_EXPLAIN'	=> $mchat_stats['refresh_message'],	
			));
		}
		
		$template->assign_vars(array(	
			'U_MCHAT'				=> $auth->acl_get('u_mchat_view') && $config_mchat['custom_page'] ? append_sid("{$phpbb_root_path}mchat.$phpEx") : '',
			'S_MCHAT_ON_INDEX'		=> ($config['mchat_on_index'] && !empty($user->data['user_mchat_index'])) ? true : false,
//			'S_MCHAT_ON_PORTAL'		=> ($config['mchat_on_portal'] && !empty($user->data['user_mchat_portal'])) ? true : false,
			'S_MCHAT_ENABLE'		=> true,
			'S_MCHAT_VERSION'		=> !empty($config['mchat_version']) ? $config['mchat_version'] : 0,
			)
		);
	}
}

/**
 * Only register the hook for normal pages, not administration pages.
 */
if (!defined('ADMIN_START'))
{
	$phpbb_hook->register(array('template', 'display'), 'hook_mchat');
}
