<?php
/**
*
* @package ucp_mchat
* @version $Id$
* @copyright (c) 2013 RMcGirr83 Rich McGirr http://rmcgirr83.org
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

class ucp_mchat
{
	var $u_action;

	function main($id, $mode)
	{
		global $cache, $config, $db, $user, $auth, $template, $phpbb_root_path, $phpEx;
		include($phpbb_root_path . 'includes/functions_mchat.' . $phpEx);
		
		$user->add_lang('mods/mchat_lang');

		$submit		= (!empty($_POST['submit'])) ? true : false;
		$error = $data = array();

		switch ($mode)
		{
			case 'configuration':

				$data = array(
					'user_mchat_index'		=> request_var('user_mchat_index', (bool) $user->data['user_mchat_index']),
					'user_mchat_sound'		=> request_var('user_mchat_sound', (bool) $user->data['user_mchat_sound']),
					'user_mchat_stats_index'	=> request_var('user_mchat_stats_index', (bool) $user->data['user_mchat_stats_index']),
					'user_mchat_topics'		=> request_var('user_mchat_topics', (bool) $user->data['user_mchat_topics']),
					'user_mchat_avatars'	=> request_var('user_mchat_avatars', (bool) $user->data['user_mchat_avatars']),
					'user_mchat_input_area'	=> request_var('user_mchat_input_area', (bool) $user->data['user_mchat_input_area']),
				);

				add_form_key('ucp_mchat');

				if ($submit)
				{
					if (!check_form_key('ucp_mchat'))
					{
						$error[] = 'FORM_INVALID';
					}

					if (!sizeof($error))
					{
						$sql_ary = array(
							'user_mchat_index'	=> $data['user_mchat_index'],
							'user_mchat_sound'	=> $data['user_mchat_sound'],
							'user_mchat_stats_index'	=> $data['user_mchat_stats_index'],
							'user_mchat_topics'	=> $data['user_mchat_topics'],
							'user_mchat_avatars'	=> $data['user_mchat_avatars'],
							'user_mchat_input_area'	=> $data['user_mchat_input_area'],
						);

						if (sizeof($sql_ary))
						{
							$sql = 'UPDATE ' . USERS_TABLE . '
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
								WHERE user_id = ' . (int) $user->data['user_id'];
							$db->sql_query($sql);
						}

						meta_refresh(3, $this->u_action);
						$message = $user->lang['PROFILE_UPDATED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
						trigger_error($message);
					}

					// Replace "error" strings with their real, localised form
					$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$user->lang['\\1'])) ? \$user->lang['\\1'] : '\\1'", $error);
				}
				if (($mchat_cache = $cache->get('_mchat_config')) === false)
				{
					mchat_cache();
				}
				$mchat_cache = $cache->get('_mchat_config');
				
				$template->assign_vars(array(
					'ERROR'			=> (sizeof($error)) ? implode('<br />', $error) : '',

					'S_DISPLAY_MCHAT'	=> $data['user_mchat_index'],
					'S_SOUND_MCHAT'		=> $data['user_mchat_sound'],
					'S_STATS_MCHAT'		=> $data['user_mchat_stats_index'],
					'S_TOPICS_MCHAT'	=> $data['user_mchat_topics'],
					'S_AVATARS_MCHAT'	=> $data['user_mchat_avatars'],
					'S_INPUT_MCHAT'		=> $data['user_mchat_input_area'],
					'S_MCHAT_TOPICS'	=> $config['mchat_new_posts'],
					'S_MCHAT_INDEX'		=> ($config['mchat_on_index'] || $config['mchat_stats_index']) ? true : false,
					'S_MCHAT_AVATARS'	=> $mchat_cache['avatars'],
				));
			break;

		}

		$template->assign_vars(array(
			'L_TITLE'			=> $user->lang['UCP_PROFILE_MCHAT'],
			'S_UCP_ACTION'		=> $this->u_action
		));

		// Set desired template
		$this->tpl_name = 'ucp_mchat';
		$this->page_title = 'UCP_PROFILE_MCHAT';
	}
}

?>