<?php

/** 
*
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package Knowledge_Base
* @version $Id$
* @copyright (c) 2007 SEO phpBB http://www.phpbb-seo.de
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

/**
* @package mcp
*/


class mcp_kb
{
	var $u_action;
	var $p_master;

	function mcp_reports(&$p_master)
	{
		$this->p_master = &$p_master;
	}

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $cache;
		global $phpbb_root_path, $phpEx, $action, $kb_root_path;

		$kb_root_path = $phpbb_root_path . KB_FOLDER . '/';
		include($kb_root_path . 'kb_common.' . $phpEx);
		include($phpbb_root_path . 'includes/functions_kb.' . $phpEx);

		$part	= request_var('part', '');
		$user->add_lang(array('mods/kb'));


		switch ($action)
		{
			case 'chgposter':

				if($auth->acl_get('m_ch_poster'))
				{
					$username	= request_var('username', '', true);
					$article_id	= request_var('a', 0);
					if (confirm_box(true))
					{

						$sql = 'SELECT user_id
							FROM ' . USERS_TABLE . "
							WHERE username_clean = '" . $db->sql_escape(utf8_clean_string($username)) . "'";
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

						if (!$row)
						{
							trigger_error('NO_USER');
						}
						$sql = 'UPDATE ' . KB_ARTICLE_TABLE . "
							SET user_id = {$row['user_id']}
							WHERE article_id = " . (int) $article_id;
						$db->sql_query($sql);

						update_article_post($article_id);
						trigger_error($user->lang['USER_CHANGED'] . '<br /><br />' . sprintf($user->lang['RETURN_PAGE'], '<a href="' . append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_main&amp;a=' . $article_id) . '">', '</a>'));

					}
					else
					{
						confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
							'action'	=> 'chgposter',
							'username'	=> $username))
						);
					}
				}

			break;

			case 'close':
			case 'delete':
				include_once($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);

				$report_id_list = request_var('report_id_list', array(0));

				if (!sizeof($report_id_list))
				{
					trigger_error('NO_REPORT_SELECTED');
				}

				$this->close_report($report_id_list, $mode, $action);
			break;
			case 'approve':
				$marked		= request_var('article_id_list', array(0));
				foreach ($marked as $article)
				{
					activate_article($article);
				}
				trigger_error($user->lang['ARTICLE_ACTIVATED'] . '<br /><br />' . sprintf($user->lang['BACK_TO_KB'], '<a href="' . append_sid("{$kb_root_path}") . '">', '</a>'));
			break;
			case 'delete_article':
			case 'disapprove':
					$deletemark = true;
					$marked		= request_var('article_id_list', array(0));
					$cat_id		= request_var('c', 0);
					if ($deletemark )
					{
						if (confirm_box(true))
						{
							$where_sql = '';
							if (sizeof($marked))
							{
								delete_article($marked);
							}
						}
						else
						{
							confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
								'action'	=> 'disapprove',
								'delmarked'	=> $deletemark,
								'article_id_list'		=> $marked))
							);
						}
					}

			break;
		}

		switch ($mode)
		{
			case 'kb_main':
				$article_id = request_var('a', 0);
				$cat_id = request_var('c', 0);

				if($article_id)
				{

					$this->tpl_name = 'kb/mcp_kb_post';
					$this->page_title = $user->lang['ARTICLE_DETAIL'];
					$this->show_log($article_id);
					$this->show_article($article_id);
				}
				elseif($cat_id)
				{
					$this->tpl_name = 'kb/mcp_kb_categorie';
					$this->page_title = $user->lang['KBASE'];
					$this->list_articles($cat_id);
				}
				else
				{
					$this->tpl_name = 'kb/mcp_kb_main';
					$this->page_title = $user->lang['KBASE'];
					if($auth->acl_get('m_report_kb'))
					{
						$this->list_reports(5);
						$s_show_unapproved = true;
					}
					if($auth->acl_get('m_activate_kb'))
					{
						$this->list_activate(5);
						$s_show_reports = true;
					}
					if($auth->acl_get('m_log_kb'))
					{					
						$this->show_logs(5);
						$s_show_logs = true;
					}

					$template->assign_vars(array(
						'S_SHOW_UNAPPROVED'			=> isset($s_show_unapproved) ? true : false,
						'S_SHOW_REPORTS'			=> isset($s_show_reports) ? true : false,
						'S_SHOW_LOGS'				=> isset($s_show_logs) ? true : false,

					));
				}
			break;

			case 'kb_reports':
				if ($part == 'view')
				{
					// View Reports
					$user->add_lang('posting');
					$this->page_title = $user->lang['REPORT_DETAILS'];
					$this->tpl_name = 'kb/mcp_kb_post';
					$report_id = request_var('r', 0);
					$report = $this->show_report($report_id);
					$this->show_article($report['article_id']);

				}
				else
				{
					// List Reports
					$this->tpl_name = 'kb/mcp_kb_reports';
					$this->page_title = $user->lang['MCP_REPORT_TITLE'];
					$this->list_reports($config['topics_per_page']);
				}
			break;


			case 'kb_activate':
				$article_id = request_var('id', 0);
				if ($part == 'view')
				{
					// View Reports
					$user->add_lang('posting');
					$this->page_title = 'ARTICLE_DETAIL';

					$this->show_article($article_id);
					$template->assign_vars(array(
						'U_APPROVE_ACTION'	=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_activate&amp;id=' . $article_id),
						'S_MCP_REPORT'		=> false,
						'S_POST_UNAPPROVED'	=> true,
					));
					$this->tpl_name = 'kb/mcp_kb_post';
				}
				else
				{
					$this->tpl_name = 'kb/mcp_kb_activate';	
					$this->page_title = 'ARTICLE_NEW';
					$this->list_activate($config['topics_per_page']);
				}
			break;

			$template->assign_vars(array('NOFORUMNAV'		=> true,));
			$template->assign_block_vars('navlinks', array(
				'U_VIEW_FORUM'	=> append_sid("{$kb_root_path}"),
				'FORUM_NAME'	=> $user->lang['KBASE'])
			);
		}
	}

	function close_report($report_id_list, $mode, $action)
	{
		global $db, $template, $user, $config;
		global $phpEx, $phpbb_root_path;
		if (confirm_box(true))
		{
			if ($action == 'close')
			{
				$sql = 'UPDATE ' . KB_REPORTS_TABLE . '
					SET report_closed = 1
					WHERE ' . $db->sql_in_set('report_id', $report_id_list);
			}
			else
			{
				$sql = 'DELETE FROM ' . KB_REPORTS_TABLE . '
					WHERE ' . $db->sql_in_set('report_id', $report_id_list);
			}
			$db->sql_query($sql);
			$cache->destroy('sql', KB_REPORTS_TABLE);

			$sql = 'UPDATE ' . KB_ARTICLE_TABLE . '
				SET reported_id = 0
				WHERE ' . $db->sql_in_set('reported_id', $report_id_list);
			$db->sql_query($sql);
			$cache->destroy('sql', KB_ARTICLE_TABLE);
		}
		confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
			'report_id_list'	=> $report_id_list,
			'mode'				=> $mode,
			'action'			=> $action
		)));

 		$messenger = new messenger();
		$sql = 'SELECT r.report_id, r.post_id, r.report_closed, r.user_id, r.user_notify, u.username, u.username_clean, u.user_email, u.user_jabber, u.user_lang, u.user_notify_type
			FROM ' . REPORTS_TABLE . ' r, ' . USERS_TABLE . ' u
			WHERE ' . $db->sql_in_set('r.report_id', $report_id_list) . '
				' . (($action == 'close') ? 'AND r.report_closed = 0' : '') . '
				AND r.user_id = u.user_id';
		$result = $db->sql_query($sql);

		$reports = $close_report_posts = $close_report_topics = $notify_reporters = $report_id_list = array();
		while ($report = $db->sql_fetchrow($result))
		{
			$reports[$report['report_id']] = $report;
			$report_id_list[] = $report['report_id'];

			if (!$report['report_closed'])
			{
				$close_report_posts[] = $report['post_id'];
			}

			if ($report['user_notify'] && !$report['report_closed'])
			{
				$notify_reporters[$report['report_id']] = &$reports[$report['report_id']];
			}
		}
		$db->sql_freeresult($result);
		// Notify reporters
		if (sizeof($notify_reporters))
		{
			foreach ($notify_reporters as $report_id => $reporter)
			{
				if ($reporter['user_id'] == ANONYMOUS)
				{
					continue;
				}

				$post_id = $reporter['post_id'];

				$messenger->template('report_' . $action . 'd', $reporter['user_lang']);
				$messenger->to($reporter['user_email'], $reporter['username']);
				$messenger->im($reporter['user_jabber'], $reporter['username']);

				$messenger->assign_vars(array(
					'USERNAME'		=> htmlspecialchars_decode($reporter['username']),
					'CLOSER_NAME'	=> htmlspecialchars_decode($user->data['username']),
					'POST_SUBJECT'	=> htmlspecialchars_decode(censor_text($post_info[$post_id]['post_subject'])),
					'TOPIC_TITLE'	=> htmlspecialchars_decode(censor_text($post_info[$post_id]['topic_title'])))
				);

				$messenger->send($reporter['user_notify_type']);
			}
		}

		unset($notify_reporters, $post_info, $reports);

		$messenger->save_queue();
	}

	function show_logs($per_page)
	{
		global $db, $template, $phpbb_root_path, $phpEx, $user, $auth;
		$sql_array = array(
			'SELECT'	=> 'l.log_id, l.time, l.user_id, l.reason, u.username, u.user_colour, a.article_id, a.titel',
		
			'FROM'		=> array(
				KB_LOG_TABLE	=> 'l',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=>	array(USERS_TABLE	=> 'u'),
					'ON'	=> 'u.user_id = l.user_id'
				),
		
				array(
					'FROM'	=>	array(KB_ARTICLE_TABLE	=> 'a'),
					'ON'	=> 'a.article_id = l.article_id'
				),
			),
			'ORDER_BY'	=> 'l.time DESC, l.log_id DESC'
		);
		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query_limit($sql, $per_page);
		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('log', array(
				'CHANGE_TIME'	=> $user->format_date($row['time']),
				'CHANGE_REASON'	=> $row['reason'],
				'ID'			=> $row['log_id'],
				'U_ARTICLE'		=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_main&amp;a=' . $row['article_id']),
				'ARTICLE'		=> $row['titel'],
				'USER'			=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
			));
		}
		$db->sql_freeresult($result);
	}

	function show_log($article_id)
	{
		global $db, $template, $phpbb_root_path, $phpEx, $user, $auth;
		$sql_array = array(
			'SELECT'	=> 'l.log_id, l.time, l.user_id, l.reason, u.username, u.user_colour, a.page_uri',
		
			'FROM'		=> array(
				KB_LOG_TABLE	=> 'l',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=>	array(USERS_TABLE	=> 'u'),
					'ON'	=> 'u.user_id = l.user_id'
				),
		
				array(
					'FROM'	=>	array(KB_ARTICLE_TABLE	=> 'a'),
					'ON'	=> 'a.article_id = l.article_id'
				),
			),
			'WHERE'		=> 'l.article_id =' . (int) $article_id,
			'ORDER_BY'	=> 'l.time DESC, l.log_id DESC'
		);
		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('log', array(
				'CHANGE_TIME'	=> $user->format_date($row['time']),
				'CHANGE_REASON'	=> $row['reason'],
				'ID'			=> $row['log_id'],
				'USER'			=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
			));
		}
		$db->sql_freeresult($result);


		$template->assign_vars(array(
			'S_DELETE_LOG'			=> $auth->acl_get('m_log_kb_delete'),
			'S_SHOW_EDITS'			=> true,
			'U_ACTION' 				=> append_sid("{$phpbb_root_path}mcp.$phpEx", "i=kb&amp;mode=kb_main&amp;a=$article_id"),
		));


		// Delete Log
		$marked		= request_var('mark', array(0));
		$deletemark = (!empty($_POST['delmarked'])) ? true : false;
		$deleteall	= (!empty($_POST['delall'])) ? true : false;
		// Delete entries if requested and able
		if (($deletemark || $deleteall) && $auth->acl_get('m_log_kb_delete'))
		{
			if (confirm_box(true))
			{
				$where_sql = '';
				if ($deletemark && sizeof($marked))
				{
					$sql_in = array();
					foreach ($marked as $mark)
					{
						$sql_in[] = $mark;
					}
					$where_sql = ' AND ' . $db->sql_in_set('log_id', $sql_in);
					unset($sql_in);
				}
		
				if ($where_sql || $deleteall)
				{
					$sql = 'DELETE FROM ' . KB_LOG_TABLE . '
						WHERE article_id = ' . (int) $article_id .
							$where_sql;
					$db->sql_query($sql);
					trigger_error($user->lang['LOG_DELETED'] . '<br /><br />' . sprintf($user->lang['BACK_TO_LOG'], '<a href="' . append_sid("{$phpbb_root_path}mcp.$phpEx", 
'i=kb&amp;mode=kb_main&amp;a= ' .$article_id) . '">', '</a>'));
				}
			}
			else
			{
				confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
					'id'		=> $article_id,
					'delmarked'	=> $deletemark,
					'delall'	=> $deleteall,
					'mark'		=> $marked))
				);
			}
		}
	}


	function list_articles($cat_id)
	{

		global $db, $kb_config, $start, $config, $template, $user, $phpbb_root_path, $phpEx, $auth, $kb_root_path;

		// Categorie info
		$sql = 'SELECT cat_title
			FROM ' . KB_CATEGORIE_TABLE . '
			WHERE cat_id = ' . (int) $cat_id;
		$result = $db->sql_query($sql, $kb_config['cache_time']);
		$cat_row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		// Article in this categorie
		$sql = 'SELECT COUNT(a.article_id) AS total_articles
			FROM ' . KB_ARTICLE_TABLE . " a
			WHERE a.activ = '1'
				AND a.cat_id = " . (int) $cat_id;
		$result = $db->sql_query($sql, $kb_config['cache_time']);
		$total_articles = (int) $db->sql_fetchfield('total_articles');
		$db->sql_freeresult($result);


		$sql_array = array(
			'SELECT'	=> 'a.activ, a.article_id, a.titel, a.description, a.cat_id, a.has_attachment, a.post_time, a.page_uri, a.hits, u.username, u.user_colour, a.user_id, a.reported_id',

			'FROM'		=> array(
				KB_ARTICLE_TABLE	=> 'a',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=>	array(USERS_TABLE	=> 'u'),
					'ON'	=> 'u.user_id = a.user_id'
				),
			),
			'WHERE'		=> 'a.cat_id = ' . (int) $cat_id,
			//'ORDER_BY'	=> 'a.' . $db->sql_escape($kb_config['sort_order']) . ' ' . $db->sql_escape($kb_config['sort_order_dir'])
		);
		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query_limit($sql, $config['topics_per_page'], $start);
		while ($row = $db->sql_fetchrow($result))
		{
			$dotts = strlen($row['description']) > 50 ? '...' : '';
			$template->assign_block_vars('article_row', array(
				'TITLE'				=> $row['titel'],
				'ARTICLE_ID'		=> $row['article_id'],
				'DESCRIPTION'		=> substr(str_replace('\n', '<br />', $row['description']), 0, 50) . $dotts,
				'TIME'				=> $user->format_date($row['post_time']),
				'HITS'				=> $row['hits'],
				'HAS_ATTACHEMENT'	=> ($row['has_attachment'] == 1) ? true: false,
				'U_ARTICLE'			=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_main&amp;a=' . $row['article_id']),
				'AUTHOR_FULL'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
				'U_MCP_QUEUE'		=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_activate&amp;part=view&amp;id=' . $row['article_id']),
				'U_MCP_REPORT'		=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_reports&amp;part=view&amp;r=' . $row['reported_id']),
				'S_ARTICLE_UNAPPROVED'	=> ($row['activ'] == 0) ? true : false,
				'S_ARTICLE_REPORTED'	=> ($row['reported_id'] != 0) ? true : false,
			));
		}
		$db->sql_freeresult($result);


		$template->assign_vars(array(
			'U_VIEW_CAT'		=> categorie_link($cat_id),
			'CAT_NAME'			=> $cat_row['cat_title'],
			'UNAPPROVED_IMG'	=> $user->img('icon_topic_unapproved', 'TOPIC_UNAPPROVED'),
			'REPORTED_IMG'		=> $user->img('icon_topic_reported', 'TOPIC_REPORTED'),
			'ATTACH_ICON_IMG'	=> $user->img('icon_topic_attach', $user->lang['TOTAL_ATTACHMENTS']),
			'PAGINATION'		=> generate_pagination("{$phpbb_root_path}mcp.$phpEx?i=kb&amp;mode=kb_activate", $total_articles, $config['topics_per_page'], $start),
			'PAGE_NUMBER'		=> on_page($total_articles, $config['topics_per_page'], $start),
			'TOTAL_REPORTS'		=> ($total_articles == 1) ? $user->lang['LIST_REPORT'] : sprintf($user->lang['LIST_REPORTS'], $total_articles),
			'NOFORUMNAV'		=> true,
			'S_CAN_DELETE'		=> $auth->acl_get('m_del_kb'),
			'S_MCP_ACTION'		=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_main&amp;c=' . $cat_id),
		));
	}


	function list_activate($per_page)
	{
		global $db, $template, $kb_root_path, $phpbb_root_path, $phpEx, $user, $auth;
		$action = request_var('action', '');
		$article_id = request_var('id', 0);
		$start = request_var('start', 0);

		$sql = 'SELECT COUNT(article_id) AS total_articles
			FROM ' . KB_ARTICLE_TABLE . '
			WHERE activ = 0';
		$result = $db->sql_query($sql);
		$total_articles = (int) $db->sql_fetchfield('total_articles');
		$db->sql_freeresult($result);
		
		// Artikel
		$sql = 'SELECT a.article_id, a.titel, a.description, a.page_uri, c.cat_title, c.cat_id
			FROM ' . KB_ARTICLE_TABLE . ' a, ' . KB_CATEGORIE_TABLE . ' c
			WHERE a.activ = 0
				AND c.cat_id = a.cat_id
			ORDER BY a.titel';
		$result = $db->sql_query_limit($sql, $per_page, $start);
		while ($row = $db->sql_fetchrow($result))
		{

			$template->assign_block_vars('article_row', array(
				'ARTICLE_ID'	=> $row['article_id'],
				'TITLE'			=> $row['titel'],
				'DESCRIPTION'	=> $row['description'],
				'CAT'			=> $row['cat_title'],
				'U_CATEGORIE'	=> categorie_link($row['cat_id']),
				'U_SHOW'		=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_activate&amp;part=view&amp;id=' . $row['article_id']),
			));
		}
		$db->sql_freeresult($result);
		
		$template->assign_block_vars('navlinks', array(
			'U_VIEW_FORUM'	=> append_sid("{$kb_root_path}"),
			'FORUM_NAME'	=> $user->lang['KBASE'])
		);
		$template->assign_vars(array(
			'PAGINATION'		=> generate_pagination("{$phpbb_root_path}mcp.$phpEx?i=kb&amp;mode=kb_activate", $total_articles, $per_page, $start),
			'PAGE_NUMBER'		=> on_page($total_articles, $per_page, $start),
			'TOTAL_REPORTS'		=> ($total_articles == 1) ? $user->lang['LIST_REPORT'] : sprintf($user->lang['LIST_REPORTS'], $total_articles),
			'NOFORUMNAV'		=> true,
			'S_DELETE_ARTICLE'	=> $auth->acl_get('m_del_kb'),
			'S_EDIT_ARTICLE'	=> $auth->acl_get('m_edit_kb'),
			'S_MCP_ACTION'		=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_activate'),
		));
	}



	function list_reports($per_page)
	{
		global $db, $template, $kb_root_path, $phpbb_root_path, $phpEx, $user;
		$start	= request_var('start', 0);
		$type	= (request_var('type', '') == 'old') ? 1 : 0;

		$sql = 'SELECT COUNT(report_id) AS total_reports
			FROM ' . KB_REPORTS_TABLE . '
			WHERE report_closed = ' . (int) $type;
		$result = $db->sql_query($sql);
		$total_reports = (int) $db->sql_fetchfield('total_reports');
		$db->sql_freeresult($result);

		$sql = 'SELECT a.article_id, a.titel, a.post_time, a.page_uri, c.cat_title, c.cat_id, a.user_id, u.username, u.user_colour, r.report_time, r.report_id,
			ru.username as reporter_name, ru.user_colour as reporter_colour, r.user_id as reporter_id
			FROM ' . KB_ARTICLE_TABLE . ' a, ' . KB_CATEGORIE_TABLE . ' c, ' . KB_REPORTS_TABLE . ' r, ' . USERS_TABLE . ' u, ' . USERS_TABLE . ' ru
			WHERE a.article_id = r.article_id
				AND c.cat_id = a.cat_id
				AND u.user_id = a.user_id
				AND ru.user_id = r.user_id
				AND r.report_closed = ' . (int) $type;
		$result = $db->sql_query_limit($sql, $per_page, $start);
		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('postrow', array(
				'ARTICLE_TITLE'			=> $row['titel'],
				'POST_TIME'				=> $user->format_date($row['post_time']),
				'REPORT_ID'				=> $row['report_id'],
				'REPORT_TIME'			=> $user->format_date($row['report_time']),
				'U_CATEGORIE'			=> categorie_link($row['cat_id']),
				'U_VIEW_DETAILS'		=> append_sid("{$phpbb_root_path}mcp.$phpEx", "i=kb&amp;mode=kb_reports&amp;part=view&amp;r={$row['report_id']}"),
				'CATEGORIE_NAME'		=> $row['cat_title'],
				'POST_AUTHOR_FULL'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $row['username']),
				'REPORT_AUTHOR_FULL'	=> get_username_string('full', $row['reporter_id'], $row['reporter_name'], $row['reporter_colour'], $row['reporter_name']),
			));
		}
		$u_type	= (request_var('type', '') == 'old') ? 'new' : 'old';
		$list_reports	= (request_var('type', '') == 'old') ? $user->lang['VIEW_REPORTS_NEW'] : $user->lang['VIEW_REPORTS_OLD'];
		$template->assign_vars(array(
			'LIST_REPORTS'		=> $list_reports,
			'LIST_NEW'			=> (request_var('type', '') == 'old') ? false : true,
			'U_LIST_REPORTS'	=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_reports&amp;type=' . $u_type),
			'PAGINATION'		=> generate_pagination("{$phpbb_root_path}mcp.$phpEx?i=kb&amp;mode=kb_reports&amp;type=" . $u_type, $total_reports, $per_page, $start),
			'PAGE_NUMBER'		=> on_page($total_reports, $per_page, $start),
			'TOTAL_REPORTS'		=> ($total_reports == 1) ? $user->lang['LIST_REPORT'] : sprintf($user->lang['LIST_REPORTS'], $total_reports),
			)
		);
	}

	function show_report($report_id)
	{
		global $db, $template, $phpbb_root_path, $phpEx, $user;
		$sql = 'SELECT r.article_id, r.user_id, r.report_id, r.report_closed, report_time, r.report_text, rr.reason_title, rr.reason_description, u.username, u.username_clean, u.user_colour
			FROM ' . KB_REPORTS_TABLE . ' r, ' . REPORTS_REASONS_TABLE . ' rr, ' . USERS_TABLE . ' u
			WHERE ' . (($report_id) ? 'r.report_id = ' . $report_id : "r.article_id = $post_id") . '
				AND rr.reason_id = r.reason_id
				AND r.user_id = u.user_id
			ORDER BY report_closed ASC';
		$result = $db->sql_query_limit($sql, 1);
		$report = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$reason = array('title' => $report['reason_title'], 'description' => $report['reason_description']);
		if (isset($user->lang['report_reasons']['TITLE'][strtoupper($reason['title'])]) && isset($user->lang['report_reasons']['DESCRIPTION'][strtoupper($reason['title'])]))
		{
			$reason['description'] = $user->lang['report_reasons']['DESCRIPTION'][strtoupper($reason['title'])];
			$reason['title'] = $user->lang['report_reasons']['TITLE'][strtoupper($reason['title'])];
		}
		
		$template->assign_vars(array(
			'S_MCP_REPORT'				=> true,
			'REPORT_REASON_TITLE'		=> $reason['title'],
			'REPORT_REASON_DESCRIPTION'	=> $reason['description'],
			'REPORT_TEXT'				=> $report['report_text'],
			'S_POST_REPORTED'			=> ($report['report_closed'] == 0) ? true : false,
			'REPORTER_FULL'				=> get_username_string('full', $report['user_id'], $report['username'], $report['user_colour']),
			'REPORT_DATE'				=> $user->format_date($report['report_time']),
			'S_POST_UNAPPROVED'			=> false,
			'S_CLOSE_ACTION'			=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_reports&amp;r=' . $report_id),
			'REPORT_ID'					=> $report['report_id'],
		));
		return $report;
	}

	function show_article($article_id)
	{
		global $db, $template, $kb_root_path, $phpbb_root_path, $phpEx, $user, $auth, $config;

		$sql_array = array(
			'SELECT'	=> 'a.*, u.username, u.user_colour, u.user_id',
		
			'FROM'		=> array(
				KB_ARTICLE_TABLE	=> 'a',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=>	array(USERS_TABLE	=> 'u'),
					'ON'	=> 'a.user_id = u.user_id'
				),
			),
			'WHERE'		=> 'a.article_id = ' . (int) $article_id,
		);
		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql);
		$post_info = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		// Get attachements
		if ($post_info['has_attachment'] && $config['allow_attachments'])
		{
			$sql = 'SELECT *
				FROM ' . ATTACHMENTS_TABLE . '
				WHERE post_msg_id = ' . (int) $post_info['article_id'] . '
						AND in_message = 2
						AND topic_id = 0
						AND is_orphan = 0
				ORDER BY filetime DESC';
			$result = $db->sql_query($sql);
		
			while ($arow = $db->sql_fetchrow($result))
			{
				$attachments[] = $arow;
			}
			$db->sql_freeresult($result);
		}
		
		if (!empty($attachments) && $config['allow_attachments'])
		{
			parse_attachments(0, $message, $attachments, $update_count);
			foreach ($attachments as $attachment)
			{
				$template->assign_block_vars('attachment', array(
					'DISPLAY_ATTACHMENT'	=> $attachment)
				);
			}
		}

		$post_info['bbcode_options'] = (($post_info['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) +
			(($post_info['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) + 
			(($post_info['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
		$message = generate_text_for_display($post_info['article'], $post_info['bbcode_uid'], $post_info['bbcode_bitfield'], $post_info['bbcode_options']);
		$template->assign_vars(array(
			'U_POST_ACTION'			=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_main&amp;a=' . $article_id),
			'U_FIND_USERNAME'		=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=searchuser&amp;form=mcp_chgposter&amp;field=username&amp;select_single=true'),
			'U_ARTICLE'				=> article_link($post_info['article_id'], $post_info['page_uri']),
			'ARTICLE_ID'			=> $post_info['article_id'],
			'EDIT_IMG'				=> $user->img('icon_post_edit', $user->lang['EDIT_POST']),
			'U_EDIT'				=> ($auth->acl_get('m_edit_kb')) ? append_sid("{$kb_root_path}kbposting.$phpEx", 'mode=edit&amp;id=' . $article_id) : '',
			'POST_AUTHOR_FULL'		=> get_username_string('full', $post_info['user_id'], $post_info['username'], $post_info['user_colour'], $post_info['username']),
			'POST_DATE'				=> $user->format_date($post_info['post_time']),
			'POST_PREVIEW'			=> $message,
			'S_CH_POSTER'			=> $auth->acl_get('m_ch_poster'),
			'POST_SUBJECT'			=> ($post_info['titel']) ? $post_info['titel'] : $user->lang['NO_SUBJECT'],
		));
	}
}

?>