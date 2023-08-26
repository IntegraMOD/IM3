<?php

/**
*
* @mod package		Download Mod 6
* @file				ucp_downloads.php 16 2012/03/23 OXPUS
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
class ucp_downloads
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $cache, $dl_cache;
		global $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix;

		$this->tpl_name = 'dl_mod/dl_user_config_body';

		$user->data['dl_enable_desc'] = false;
		$user->data['dl_enable_rule'] = false;

		/*
		* include and create the main class
		*/
		include($phpbb_root_path . 'dl_mod/classes/class_dlmod.' . $phpEx);
		$dl_mod = new dl_mod($phpbb_root_path, $phpEx);
		$dl_mod->register();
		dl_init::init();

		$submit			= request_var('submit', '');
		$cancel			= request_var('cancel', '');
		$confirm		= request_var('confirm', '');
		$mode			= request_var('mode', 'config');

		$basic_link = append_sid("{$phpbb_root_path}ucp.$phpEx", "i=downloads&amp;mode=$mode");

		$template->assign_var('S_DL_UCP', true);

		/*
		* include the choosen module
		*/
		switch($mode)
		{
			case 'config':
				$this->page_title = 'DL_CONFIG';

				$template->assign_var('S_DL_UCP_CONFIG', true);

				if ($submit)
				{
					if (!check_form_key('dl_ucp'))
					{
						trigger_error('FORM_INVALID');
					}

					$user_allow_new_download_popup	= request_var('user_allow_new_download_popup', 0);
					$user_allow_fav_download_popup	= request_var('user_allow_fav_download_popup', 0);
					$user_allow_new_download_email	= request_var('user_allow_new_download_email', 0);
					$user_allow_fav_download_email	= request_var('user_allow_fav_download_email', 0);
					$user_allow_fav_comment_email	= request_var('user_allow_fav_comment_email', 0);
					$user_dl_note_type				= request_var('user_dl_note_type', 0);
					$user_dl_sort_fix				= request_var('user_dl_sort_fix', 0);
					$user_dl_sort_opt				= request_var('user_dl_sort_opt', 0);
					$user_dl_sort_dir				= request_var('user_dl_sort_dir', 0);
					$user_dl_sub_on_index			= request_var('user_dl_sub_on_index', 0);

					$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
						'user_allow_new_download_popup'	=> $user_allow_new_download_popup,
						'user_allow_fav_download_popup'	=> $user_allow_fav_download_popup,
						'user_allow_new_download_email'	=> $user_allow_new_download_email,
						'user_allow_fav_download_email'	=> $user_allow_fav_download_email,
						'user_allow_fav_comment_email'	=> $user_allow_fav_comment_email,
						'user_dl_note_type'				=> $user_dl_note_type,
						'user_dl_sort_fix'				=> $user_dl_sort_fix,
						'user_dl_sort_opt'				=> $user_dl_sort_opt,
						'user_dl_sort_dir'				=> $user_dl_sort_dir,
						'user_dl_sub_on_index'			=> $user_dl_sub_on_index)) . ' WHERE user_id = ' . (int) $user->data['user_id'];
					$db->sql_query($sql);

					$message = sprintf($user->lang['DL_USER_CONFIG_SAVED'], '<a href="' . $basic_link . '">', '</a>');

					trigger_error($message);
				}

				add_form_key('dl_ucp');

				$allow_new_popup_yes	= ($user->data['user_allow_new_download_popup']) ? 'checked="checked"' : '';
				$allow_new_popup_no		= (!$user->data['user_allow_new_download_popup']) ? 'checked="checked"' : '';
				$allow_fav_popup_yes	= ($user->data['user_allow_fav_download_popup']) ? 'checked="checked"' : '';
				$allow_fav_popup_no		= (!$user->data['user_allow_fav_download_popup']) ? 'checked="checked"' : '';
				$allow_new_email_yes	= ($user->data['user_allow_new_download_email']) ? 'checked="checked"' : '';
				$allow_new_email_no		= (!$user->data['user_allow_new_download_email']) ? 'checked="checked"' : '';
				$allow_fav_email_yes	= ($user->data['user_allow_fav_download_email']) ? 'checked="checked"' : '';
				$allow_fav_email_no		= (!$user->data['user_allow_fav_download_email']) ? 'checked="checked"' : '';
				$allow_com_email_yes	= ($user->data['user_allow_fav_comment_email']) ? 'checked="checked"' : '';
				$allow_com_email_no		= (!$user->data['user_allow_fav_comment_email']) ? 'checked="checked"' : '';

				$user_dl_note_type_popup	= ($user->data['user_dl_note_type']) ? 'checked="checked"' : '';
				$user_dl_note_type_message	= (!$user->data['user_dl_note_type']) ? 'checked="checked"' : '';
				$user_dl_sort_opt			= ($user->data['user_dl_sort_opt']) ? 'checked="checked"' : '';

				$user_dl_sub_on_index_yes	= ($user->data['user_dl_sub_on_index']) ? 'checked="checked"' : '';
				$user_dl_sub_on_index_no	= (!$user->data['user_dl_sub_on_index']) ? 'checked="checked"' : '';

				$s_user_dl_sort_fix = '<select name="user_dl_sort_fix">';
				$s_user_dl_sort_fix .= '<option value="0">'.$user->lang['DL_DEFAULT_SORT'].'</option>';
				$s_user_dl_sort_fix .= '<option value="1">'.$user->lang['DL_FILE_DESCRIPTION'].'</option>';
				$s_user_dl_sort_fix .= '<option value="2">'.$user->lang['DL_FILE_NAME'].'</option>';
				$s_user_dl_sort_fix .= '<option value="3">'.$user->lang['DL_KLICKS'].'</option>';
				$s_user_dl_sort_fix .= '<option value="4">'.$user->lang['DL_FREE'].'</option>';
				$s_user_dl_sort_fix .= '<option value="5">'.$user->lang['DL_EXTERN'].'</option>';
				$s_user_dl_sort_fix .= '<option value="6">'.$user->lang['DL_FILE_SIZE'].'</option>';
				$s_user_dl_sort_fix .= '<option value="7">'.$user->lang['LAST_UPDATED'].'</option>';
				$s_user_dl_sort_fix .= '<option value="8">'.$user->lang['DL_RATING'].'</option>';
				$s_user_dl_sort_fix .= '</select>';
				$s_user_dl_sort_fix = str_replace('value="'.$user->data['user_dl_sort_fix'].'">', 'value="'.$user->data['user_dl_sort_fix'].'" selected="selected">', $s_user_dl_sort_fix);

				$s_user_dl_sort_dir = '<select name="user_dl_sort_dir">';
				$s_user_dl_sort_dir .= '<option value="0">'.$user->lang['ASCENDING'].'</option>';
				$s_user_dl_sort_dir .= '<option value="1">'.$user->lang['DESCENDING'].'</option>';
				$s_user_dl_sort_dir .= '</select>';
				$s_user_dl_sort_dir = str_replace('value="'.$user->data['user_dl_sort_dir'].'">', 'value="'.$user->data['user_dl_sort_dir'].'" selected="selected">', $s_user_dl_sort_dir);

				if (!$config['dl_disable_email'])
				{
					$template->assign_var('S_NO_DL_EMAIL_NOTIFY', true);
				}

				if (!$config['dl_disable_popup'])
				{
					$template->assign_var('S_NO_DL_POPUP_NOTIFY', true);
				}

				if (!$config['dl_sort_preform'])
				{
					$template->assign_var('S_SORT_CONFIG_OPTIONS', true);
				}

				$template->assign_vars(array(
					'ALLOW_NEW_DOWNLOAD_POPUP_YES'		=> $allow_new_popup_yes,
					'ALLOW_NEW_DOWNLOAD_POPUP_NO'		=> $allow_new_popup_no,
					'ALLOW_FAV_DOWNLOAD_POPUP_YES'		=> $allow_fav_popup_yes,
					'ALLOW_FAV_DOWNLOAD_POPUP_NO'		=> $allow_fav_popup_no,

					'ALLOW_NEW_DOWNLOAD_EMAIL_YES'		=> $allow_new_email_yes,
					'ALLOW_NEW_DOWNLOAD_EMAIL_NO'		=> $allow_new_email_no,
					'ALLOW_FAV_DOWNLOAD_EMAIL_YES'		=> $allow_fav_email_yes,
					'ALLOW_FAV_DOWNLOAD_EMAIL_NO'		=> $allow_fav_email_no,
					'ALLOW_FAV_COMMENT_EMAIL_YES'		=> $allow_com_email_yes,
					'ALLOW_FAV_COMMENT_EMAIL_NO'		=> $allow_com_email_no,

					'USER_DL_NOTE_TYPE_POPUP'			=> $user_dl_note_type_popup,
					'USER_DL_NOTE_TYPE_MESSAGE'			=> $user_dl_note_type_message,

					'USER_DL_SUB_ON_INDEX_YES'			=> $user_dl_sub_on_index_yes,
					'USER_DL_SUB_ON_INDEX_NO'			=> $user_dl_sub_on_index_no,

					'S_DL_SORT_USER_OPT'				=> $s_user_dl_sort_fix,
					'S_DL_SORT_USER_EXT'				=> $user_dl_sort_opt,
					'S_DL_SORT_USER_DIR'				=> $s_user_dl_sort_dir,

					'S_FORM_ACTION'						=> $basic_link,
				));

			break;
			case 'favorite':
				$this->page_title = 'DL_FAVORITE';

				if ($submit)
				{
					if (!check_form_key('dl_ucp'))
					{
						trigger_error('FORM_INVALID');
					}

					/*
					* drop all choosen favorites
					*/
					$fav_id = request_var('fav_id', array(0 => ''));

					$sql_drop_fav = implode(',', array_map('intval',$fav_id));

					if ($sql_drop_fav)
					{
						$sql = "DELETE FROM " . DL_FAVORITES_TABLE . "
							WHERE fav_id IN ($sql_drop_fav)
								AND fav_user_id = " . (int) $user->data['user_id'];
						$db->sql_query($sql);
					}

					$message = sprintf($user->lang['DL_USER_CONFIG_SAVED'], '<a href="' . $basic_link . '">', '</a>');

					trigger_error($message);
				}

				/*
				* drop all unaccessable favorites
				*/
				$access_cat = array();
				$access_cat = dl_main::full_index(0, 0, 0, 1);
				if (sizeof($access_cat))
				{
					$sql_access_cat = implode(', ', array_map('intval', $access_cat));

					$sql = "DELETE FROM " . DL_FAVORITES_TABLE . "
						WHERE fav_dl_cat NOT IN ($sql_access_cat)
							AND fav_user_id = " . (int) $user->data['user_id'];
					$db->sql_query($sql);
				}

				/*
				* fetch all favorite downloads
				*/
				$sql = 'SELECT f.fav_id, d.description, d.cat, d.id FROM ' . DL_FAVORITES_TABLE . ' f, ' . DOWNLOADS_TABLE . ' d
					WHERE f.fav_dl_id = d.id
						AND f.fav_user_id = ' . (int) $user->data['user_id'];
				$result = $db->sql_query($sql);

				$total_favorites = $db->sql_affectedrows($result);

				$template->assign_var('S_FAV_BLOCK', true);

				if ($total_favorites)
				{
					while ($row = $db->sql_fetchrow($result))
					{
						$path_dl_array = $tmp_nav = array();
						$dl_nav = dl_nav::nav($row['cat'], 'links', $tmp_nav).'&nbsp;»&nbsp;';

						$template->assign_block_vars('favorite_row', array(
							'DL_ID'			=> $row['fav_id'],
							'DL_CAT'		=> $dl_nav,
							'DOWNLOAD'		=> $row['description'],
							'U_DOWNLOAD'	=> append_sid("{$phpbb_root_path}downloads.$phpEx", "view=detail&amp;df_id=" . $row['id'] . "&amp;cat_id=".$row['cat']))
						);
					}
				}
				$db->sql_freeresult($result);

				add_form_key('dl_ucp');

				$template->assign_vars(array(
					'S_FORM_ACTION'	=> $basic_link,
				));

			break;
		}

		$template->assign_vars(array(
			'DL_MOD_RELEASE' => sprintf($user->lang['DL_MOD_VERSION_PUBLIC']),
		));
	}
}

?>