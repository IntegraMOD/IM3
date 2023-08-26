<?php

/**
*
* @mod package		Download Mod 6
* @file				class_dl_email.php 1 2014/03/07 OXPUS
* @copyright		(c) 2014 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
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

class dl_email extends dl_mod
{
	public function __construct()
	{
		return;
	}

	public function __destruct()
	{
		return;
	}

	/**
	* Send user information about a new/updated download
	* Used in
	*  dl_mod/admin/dl_admin_files.php	(add/update)
	*  dl_mod/includes/dl_modcp.php		(update)
	*  dl_mod/includes/dl_upload.php	(add)	
	*/	 	
	public static function send_dl_notify($mail_data)
	{
		global $db, $config, $user;

		include_once(dl_init::phpbb_root_path() . 'includes/functions_messenger' . dl_init::phpEx());
		$messenger = new messenger();

		$result = $db->sql_query($mail_data['query']);

		$cat_id = (int) $mail_data['cat_id'];

		while ($row = $db->sql_fetchrow($result))
		{
			$messenger->template($mail_data['email_template'], $row['user_lang']);
			$messenger->to($row['user_email'], $row['username']);

			$messenger->assign_vars(array(
				'SITENAME'		=> $config['sitename'],
				'BOARD_EMAIL'	=> $config['board_email_sig'],
				'USERNAME'		=> htmlspecialchars_decode($row['username']),
				'DOWNLOAD'		=> htmlspecialchars_decode($mail_data['description']),
				'DESCRIPTION'	=> htmlspecialchars_decode($mail_data['long_desc']),
				'CATEGORY'		=> htmlspecialchars_decode($mail_data['cat_name']),
				'U_APPROVE'		=> generate_board_url() . "/downloads" . dl_init::phpEx() . "?view=modcp&action=approve",
				'U_CATEGORY'	=> generate_board_url() . "/downloads" . dl_init::phpEx() . "?cat=$cat_id",
			));

			$messenger->send(NOTIFY_EMAIL);
		}

		$db->sql_freeresult($result);

		$messenger->save_queue();
	}

	/**
	* Send user new status about a bug tracker entry
	* Used in
	*  dl_mod/includes/dl_bug_tracker.php	
	*/	 	
	public static function send_bt_status($mail_data)
	{
		global $db, $config, $user;

		include_once(dl_init::phpbb_root_path() . 'includes/functions_messenger' . dl_init::phpEx());
		$messenger = new messenger();

		$sql = 'SELECT user_email, user_lang, username FROM ' . USERS_TABLE . '
			WHERE user_id = ' . (int) $mail_data['report_author_id'];
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if ($mail_data['new_status_text'])
		{
			$status_text = sprintf($user->lang['DL_BUG_REPORT_EMAIL_STATUS'], $mail_data['new_status_text']);
		}
		else
		{
			$status_text = '';
		}

		$messenger->template($mail_data['email_template'], $row['user_lang']);
		$messenger->to($row['user_email'], $row['username']);

		$messenger->assign_vars(array(
			'SITENAME'		=> $config['sitename'],
			'BOARD_EMAIL'	=> $config['board_email_sig'],
			'USERNAME'		=> $user->data['username'],
			'REPORT_TITLE'	=> htmlspecialchars_decode($mail_data['report_title']),
			'STATUS'		=> htmlspecialchars_decode($user->lang['DL_REPORT_STATUS'][$mail_data['report_status']]),
			'STATUS_TEXT'	=> htmlspecialchars_decode($status_text),
			'U_BUG_REPORT'	=> generate_board_url() . "/downloads" . dl_init::phpEx() . "?view=bug_tracker&action=detail&fav_id=" . (int) $mail_data['fav_id']
		));

		$messenger->send(NOTIFY_EMAIL);
		$messenger->save_queue();
	}

	/**
	* Send user the assignment to a bug tracker entry
	* Used in
	*  dl_mod/includes/dl_bug_tracker.php	
	*/	 	
	public static function send_bt_assign($mail_data)
	{
		global $db, $config, $user;

		include_once(dl_init::phpbb_root_path() . 'includes/functions_messenger' . dl_init::phpEx());
		$messenger = new messenger();

		$messenger->template($mail_data['email_template'], $mail_data['user_lang']);
		$messenger->to($mail_data['user_mail'], $mail_data['username']);

		$messenger->assign_vars(array(
			'SITENAME'		=> $config['sitename'],
			'BOARD_EMAIL'	=> $config['board_email_sig'],
			'USERNAME'		=> $user->data['username'],
			'U_BUG_REPORT'	=> generate_board_url() . "/downloads" . dl_init::phpEx() . "?view=bug_tracker&action=detail&fav_id=" . (int) $mail_data['fav_id']
		));

		$messenger->send(NOTIFY_EMAIL);
		$messenger->save_queue();
	}

	/**
	* Send user notification about new comment to approve or just for information
	* Used in
	*  dl_mod/includes/dl_comments.php	
	*/	 	
	public static function send_comment_notify($mail_data)
	{
		global $db, $config, $user;

		include_once(dl_init::phpbb_root_path() . 'includes/functions_messenger' . dl_init::phpEx());
		$messenger = new messenger();

		$result = $db->sql_query($mail_data['query']);

		$cat_id	= (int) $mail_data['cat_id'];
		$df_id	= (int) $mail_data['df_id'];

		while ($row = $db->sql_fetchrow($result))
		{
			$messenger->template($mail_data['email_template'], $row['user_lang']);
			$messenger->to($row['user_email'], $row['username']);

			$messenger->assign_vars(array(
				'SITENAME'		=> $config['sitename'],
				'BOARD_EMAIL'	=> $config['board_email_sig'],
				'CATEGORY'		=> htmlspecialchars_decode($mail_data['cat_name']),
				'USERNAME'		=> htmlspecialchars_decode($row['username']),
				'DOWNLOAD'		=> htmlspecialchars_decode($mail_data['description']),
				'U_APPROVE'		=> generate_board_url() . "/downloads" . dl_init::phpEx() . "?view=modcp&action=capprove",
				'U_DOWNLOAD'	=> generate_board_url() . "/downloads" . dl_init::phpEx() . "?view=comment&action=view&cat_id=$cat_id&df_id=$df_id",
			));
			$messenger->send(NOTIFY_EMAIL);
		}

		$db->sql_freeresult($result);

		$messenger->save_queue();
	}

	/**
	* Send user notification to report a broken download
	* Used in
	*  downloads.php	
	*/	 	
	public static function send_report($mail_data)
	{
		global $db, $config, $user;

		include_once(dl_init::phpbb_root_path() . 'includes/functions_messenger' . dl_init::phpEx());
		$messenger = new messenger();

		$cat_id	= (int) $mail_data['cat_id'];
		$df_id	= (int) $mail_data['df_id'];

		$username = (!$user->data['is_registered']) ? $user->lang['DL_A_GUEST'] : $user->data['username'];

		$sql = 'SELECT user_email, username, user_lang FROM ' . USERS_TABLE . '
			WHERE ' . $db->sql_in_set('user_id', explode(', ', $mail_data['processing_user'])) . '
				OR user_type = ' . USER_FOUNDER . '
			GROUP BY user_email, username, user_lang';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$messenger->template($mail_data['email_template'], $row['user_lang']);
			$messenger->to($row['user_email'], $row['username']);

			$messenger->assign_vars(array(
				'SITENAME'				=> $config['sitename'],
				'BOARD_EMAIL'			=> $config['board_email_sig'],
				'REPORTER'				=> htmlspecialchars_decode($username),
				'REPORT_NOTIFY_TEXT'	=> htmlspecialchars_decode($mail_data['report_notify_text']),
				'USERNAME'				=> htmlspecialchars_decode($row['username']),
				'U_DOWNLOAD'			=> generate_board_url() . "/downloads" . dl_init::phpEx() . "?view=detail&cat_id=$cat_id&df_id=$df_id")
			);

			$messenger->send(NOTIFY_EMAIL);
		}

		$db->sql_freeresult($result);

		$messenger->save_queue();
	}
}

?>