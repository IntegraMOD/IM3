<?php
/**
*
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package Knowledge_Base
* @version $Id: functions_kb.php 50 2009-06-15 20:31:16Z tobi.schaefer $
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


function upload_popup($forum_style = 0)
{
	global $template, $user;

	($forum_style) ? $user->setup('posting', $forum_style) : $user->setup('posting');
 
	page_header($user->lang['PROGRESS_BAR']);

	$template->set_filenames(array(
		'popup'    => 'posting_progress_bar.html')
	);

	$template->assign_vars(array(
		'PROGRESS_BAR'    => $user->img('upload_bar', $user->lang['UPLOAD_IN_PROGRESS']))
	);
	$template->display('popup');
}


function article_link($article_id, $page_uri = false)
{
	global $kb_root_path, $phpEx;
	$article_link = (KB_SEO == true && !empty($page_uri)) ? append_sid("{$kb_root_path}" . $page_uri . '.html') : append_sid("{$kb_root_path}viewarticle.$phpEx", 'id=' . $article_id);
	return $article_link;
}

function categorie_link($categorie_id)
{
	global $kb_root_path, $phpEx;
	$categorie_link = (KB_SEO == true) ? append_sid("{$kb_root_path}categorie-" . $categorie_id . '.html') : append_sid("{$kb_root_path}viewcategorie.$phpEx", 'id=' . $categorie_id);
	return $categorie_link;
}

/**
* Upload attachements
*/
function post_attacement($data)
{
	global $user, $db, $config, $phpbb_root_path;

	// Submit Attachments
	if (!empty($data['attachment_data']) && $data['post_id'])
	{
		$space_taken = $files_added = 0;
		$orphan_rows = array();

		foreach ($data['attachment_data'] as $pos => $attach_row)
		{
			$orphan_rows[(int) $attach_row['attach_id']] = array();
		}

		if (sizeof($orphan_rows))
		{

			$sql = 'SELECT attach_id, filesize, physical_filename
				FROM ' . ATTACHMENTS_TABLE . '
				WHERE ' . $db->sql_in_set('attach_id', array_keys($orphan_rows)) . '
					AND is_orphan = 1
					AND poster_id = ' . (int) $data['poster_id'];
			$result = $db->sql_query($sql);

			$orphan_rows = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$orphan_rows[$row['attach_id']] = $row;
			}
			$db->sql_freeresult($result);
		}

		foreach ($data['attachment_data'] as $pos => $attach_row)
		{
			if ($attach_row['is_orphan'] && !in_array($attach_row['attach_id'], array_keys($orphan_rows)))
			{
				continue;
			}

			if (!$attach_row['is_orphan'])
			{
				// update entry in db if attachment already stored in db and filespace
				$sql = 'UPDATE ' . ATTACHMENTS_TABLE . "
					SET attach_comment = '" . $db->sql_escape($attach_row['attach_comment']) . "'
					WHERE attach_id = " . (int) $attach_row['attach_id'] . '
						AND is_orphan = 0';
				$db->sql_query($sql);
			}
			else
			{
				// insert attachment into db
				if (!@file_exists($phpbb_root_path . $config['upload_path'] . '/' . basename($orphan_rows[$attach_row['attach_id']]['physical_filename'])))
				{
					continue;
				}
				$space_taken += $orphan_rows[$attach_row['attach_id']]['filesize'];
				$files_added++;

				$attach_sql = array(
					'post_msg_id'		=> $data['post_id'],
					'in_message'		=> 2,
					'is_orphan'			=> 0,
					'poster_id'			=> $data['poster_id'],
					'attach_comment'	=> $attach_row['attach_comment'],
				);

				$sql = 'UPDATE ' . ATTACHMENTS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $attach_sql) . '
					WHERE attach_id = ' . (int) $attach_row['attach_id'] . '
						AND is_orphan = 1
						AND poster_id = ' . (int) $user->data['user_id'];
				$db->sql_query($sql);
			}
		}

		if ($space_taken && $files_added)
		{
			set_config('upload_dir_size', $config['upload_dir_size'] + $space_taken, true);
			set_config('num_files', $config['num_files'] + $files_added, true);
		}
	}
}

/**
* Send the categorie list to the template and returns the following variables
*/
function make_categorie_list($id)
{
	global $db, $template, $kb_root_path, $user, $phpEx, $kb_config, $auth;

	$has_subs = $i = $j = 0;
	$sql = 'SELECT *
		FROM ' . KB_CATEGORIE_TABLE . '
		WHERE ((parent_id = ' . (int) $id . ') OR cat_mode = 1)
		ORDER BY left_id ASC';
	$result = $db->sql_query($sql, $kb_config['cache_time']);
	while ($row = $db->sql_fetchrow($result))
	{
		if($auth->acl_get('kb_view_article', $row['cat_id']))
		{

			$description = generate_text_for_display($row['description'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']);
			if ($row['cat_mode'] == 0)
			{
				$main_cat[$i]['cat_id']			= $row['cat_id'];
				$main_cat[$i]['cat_title']		= $row['cat_title'];
				$main_cat[$i]['description']	= $description;
				$i++;
			}
			else
			{
				$cat[$j]['cat_id']			= $row['cat_id'];
				$cat[$j]['cat_title']		= $row['cat_title'];
				$cat[$j]['parent_id']		= $row['parent_id'];
				$cat[$j]['description']		= $description;
				$cat[$j]['image']			= $row['image'];
				$cat[$j]['left_id']			= $row['left_id'];
				$cat[$j]['right_id']		= $row['right_id'];
				$cat[$j]['last_poster']		= get_username_string('full', $row['last_article_poster_id'], $row['last_article_poster_name'], $row['last_article_poster_colour']);
				$cat[$j]['last_article_time']	= $row['last_article_time'];
				$cat[$j]['cat_articles']		= $row['cat_articles'];
				$cat[$j]['last_article_url']	= $row['last_article_url'];
				$cat[$j]['last_article_id']		= $row['last_article_id'];
				$cat[$j]['last_article_title']	= $row['last_article_title'];

				if($row['display_on_index'])
				{
					@$cat[$row['parent_id']]['subs'] .= '<a href="' . categorie_link($row['cat_id']) . '" class="subforum read">' . $row['cat_title'] . '</a> ';
				}
				if ($row['parent_id'] == $id)
				{
					$has_subs = true;
				}
				$j++;
			}
			$has_sub = ($row['parent_id'] == $id) ? true : false;
		}
	}

	if($has_subs)
	{
		// The global categorie
		$main_cat[$i]['cat_id']			= $id;
		$main_cat[$i]['cat_title']		= $user->lang['CATEGORIE'];
		$main_cat[$i]['description']	= '';
	}	

	$data['count_cats'] = $j;
	$db->sql_freeresult($result);
	
	if($kb_config['kb_mode'] == 0)
	{
		// Article
		$sql = 'SELECT a.article_id, a.titel, a.description, a.cat_id, a.post_time, a.page_uri, a.user_id, u.username, u.user_colour
			FROM ' . KB_ARTICLE_TABLE . ' a, ' . USERS_TABLE . " u
			WHERE a.activ  = '1'
				AND u.user_id = a.user_id
			ORDER BY a." . $db->sql_escape($kb_config['sort_order']) . ' ' . $db->sql_escape($kb_config['sort_order_dir']);
		$result = $db->sql_query($sql, $kb_config['cache_time']);

		for ($i = 0; $row = $db->sql_fetchrow($result); $i++)
		{
			$article[$i]['titel']		= $row['titel'];
			$article[$i]['description']	= str_replace('\n', '<br />', $row['description']);
			$article[$i]['article_id']	= $row['article_id'];
			$article[$i]['cat_id']		= $row['cat_id'];
			$article[$i]['page_uri']	= $row['page_uri'];
		}
		$data['count_article'] = $i;
		$db->sql_freeresult($result);
	}
	$s_ucats = false;
	// Maincat
	for ($i = 0; isset($main_cat[$i]['cat_id']); $i++)
	{
		$template->assign_block_vars('maincat', array(
			'TITLE'	=> $main_cat[$i]['cat_title'],
			'DESCRIPTION'	=> $main_cat[$i]['description'])
		);
		// Subcat
		for ($j = 0; isset($cat[$j]['cat_id']); $j++)
		{
			if ($cat[$j]['parent_id'] == $main_cat[$i]['cat_id'] && $auth->acl_get('kb_view_article', $cat[$j]['cat_id']))
			{
				$folder_image = ($cat[$j]['left_id'] + 1 != $cat[$j]['right_id']) ? 'forum_read_subforum' : 'forum_read';
				$template->assign_block_vars('maincat.ucat', array(
					'U_CATEGORIE'			=> categorie_link($cat[$j]['cat_id']),
					'S_MORE_LINK'			=> true,
					'NEWEST_ARTICLE'		=> $cat[$j]['last_article_title'],
					'U_NEWEST_ARTICLE'		=> article_link($cat[$j]['last_article_id'], $cat[$j]['last_article_url']),
					'NEWEST_TIME'			=> $user->format_date($cat[$j]['last_article_time']),
					'AUTHOR_FULL'			=> $cat[$j]['last_poster'],
					'ARTICLES'				=> $cat[$j]['cat_articles'],
					'DESCRIPTION'			=> $cat[$j]['description'],
					'CAT_IMAGE'				=> $cat[$j]['image'],
					'SUB_CAT'				=> isset($cat[$cat[$j]['cat_id']]['subs']) ? $cat[$cat[$j]['cat_id']]['subs'] : '',
					'READ_MORE'				=> sprintf($user->lang['READ_MORE'], $cat[$j]['cat_articles']),
					'TITLE'					=> $cat[$j]['cat_title'],
					'FORUM_FOLDER_IMG_SRC'	=> $user->img($folder_image, '', false, '', 'src'),
				));
				$s_ucats = true;

				// article
				if($kb_config['kb_mode'] == 0)
				{
					$l = 0;
					for ($k = 0; isset($article[$k]['article_id']); $k++)
					{
						if ($cat[$j]['cat_id'] == $article[$k]['cat_id'] && $l < $kb_config['index_topics'])
						{
							$template->assign_block_vars('maincat.ucat.article', array(
								'TITLE'			=> $article[$k]['titel'],
								'DESCRIPTION'	=> $article[$k]['description'],
								'U_ARTICLE'		=> article_link($article[$k]['article_id'], $article[$k]['page_uri']),
							));
							$l++;
						}
					}
				} // article
			} 
		}// Subcat
	}// Maincat
	$template->assign_vars(array(
		'S_UCATS'	=> $s_ucats,
	));
	return $data;
}

function get_categorie_branch($main_id, $type = 'all', $order = 'descending', $cats = false)
{
	global $db;

	switch ($type)
	{
		case 'parents':
			$condition = 'c1.left_id BETWEEN c2.left_id AND c2.right_id';
		break;

		case 'children':
			$condition = 'c2.left_id BETWEEN c1.left_id AND c1.right_id';
		break;

		default:
			$condition = 'c2.left_id BETWEEN c1.left_id AND c1.right_id OR c1.left_id BETWEEN c2.left_id AND c2.right_id';
		break;
	}

	$where = ($cats) ? ' AND c2.cat_mode = 1' : '';
	$rows = array();
	$sql = 'SELECT c2.*
		FROM ' . KB_CATEGORIE_TABLE . ' c1
		LEFT JOIN ' . KB_CATEGORIE_TABLE . " c2 ON ($condition)
		WHERE c1.cat_id = " . (int) $main_id .
			$where
		. " ORDER BY c2.left_id " . (($order == 'descending') ? 'ASC' : 'DESC');
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$rows[] = $row;
	}
	$db->sql_freeresult($result);
	return $rows;
}

/**
* Make a Select Box wit all categories in system
*/
function make_cat_select($select_id = false, $disable = 0, $own_id = 0)
{
	global $db, $user, $auth, $kb_config;

	// This query is identical to the jumpbox one
	$sql = 'SELECT cat_id, cat_title, parent_id, left_id, right_id, cat_mode
		FROM ' . KB_CATEGORIE_TABLE . '
		ORDER BY left_id ASC';
	$result = $db->sql_query($sql, $kb_config['cache_time']);

	$right = 0;
	$padding_store = array('0' => '');
	$padding = '';
	$forum_list = '';

	while ($row = $db->sql_fetchrow($result))
	{
		if($auth->acl_get('kb_view_article', $row['cat_id']) or $auth->acl_get('a_premissions_kb'))
		{
			if ($row['left_id'] < $right)
			{
				$padding .= '&nbsp; &nbsp;';
				$padding_store[$row['parent_id']] = $padding;
			}
			else if ($row['left_id'] > $right + 1)
			{
				$padding = (isset($padding_store[$row['parent_id']])) ? $padding_store[$row['parent_id']] : '';
			}

			$right = $row['right_id'];
			$disabled = false;


			if ($own_id != 0 && $row['parent_id'] == $own_id) 
			{
				$disabled = ' disabled="disabled" class="disabled-option"';
			}


			if ($row['cat_mode'] == $disable || $own_id == $row['cat_id'])
			{
				$disabled = ' disabled="disabled" class="disabled-option" style="font-weight: bold"';
			}

			$selected = ($row['cat_id'] == $select_id) ? ' selected="selected"' : '';
			$forum_list .= '<option label="' . $row['cat_title'] . '" value="' . $row['cat_id'] . '"' . $disabled . $selected . '>' . $padding . $row['cat_title'] . '</option>';
		}
	}
	$db->sql_freeresult($result);
	unset($padding_store);

	return $forum_list;
}

/**
* Add entry to article log
*/
function article_log($article_id, $reason)
{
	global $user, $db, $cache;
	$sql_ary = array(
		'article_id'	=> (int) $article_id,
		'user_id'		=> $user->data['user_id'],
		'reason'		=> $reason,
		'time'			=> time(),
	);
	$db->sql_query('INSERT INTO ' . KB_LOG_TABLE .' ' . $db->sql_build_array('INSERT', $sql_ary));
	$cache->destroy('sql', KB_LOG_TABLE);
}

/**
* Activate a article and post topic if there is a forum for the sub categorie and article have no posting
*/
function activate_article($article_id)
{
	global $auth, $cache, $phpbb_root_path, $db, $phpEx, $user, $config, $kb_config, $data;

	if(!$auth->acl_get('m_activate_kb') && !$auth->acl_get('kb_add_article_direct', $data['cat_id']))
	{
		trigger_error($user->lang['NO_AUTH_OPERATION']);
	}

	$kb_root_path = $phpbb_root_path . KB_FOLDER . '/';
	$sql = 'SELECT config_name, config_value
		FROM ' . KB_CONFIG_TABLE;
	$result = $db->sql_query($sql, 3600);
	while($row = $db->sql_fetchrow($result))
	{
		$kb_config[$row['config_name']] = $row['config_value'];
	}

	$post_data = array();

	$sql_array = array(
		'SELECT'	=> 'a.article_id, a.activ, a.article, a.titel, a.description, a.post_time, a.cat_id, a.type_id, a.user_id, a.page_uri, a.post_id, c.post_forum, c.cat_title, c.show_edits, c.right_id, c.left_id, t.name, ut.username, ut.user_colour, ut.user_id, au.username AS author',
	
		'FROM'		=> array(
			KB_ARTICLE_TABLE	=> 'a',
		),
		'LEFT_JOIN'	=> array(
			array(
				'FROM'	=>	array(KB_CATEGORIE_TABLE	=> 'c'),
				'ON'	=> 'c.cat_id = a.cat_id'
			),
			array(
				'FROM'	=> array(KB_TYPES_TABLE => 't'),
				'ON'	=> 't.type_id = a.type_id'
			),
			array(
				'FROM'	=> array(USERS_TABLE => 'ut'),
				'ON'	=> 'ut.user_id = ' . (int) $kb_config['post_user']
			),
			array(
				'FROM'	=> array(USERS_TABLE => 'au'),
				'ON'	=> 'au.user_id = a.user_id'
			)
		),
		'WHERE'		=> 'a.article_id = ' . (int) $article_id,
	);

	$sql = $db->sql_build_query('SELECT', $sql_array);
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);


	if($row['activ'] <> 1)
	{
		// Insert article log
		article_log($article_id, $user->lang['ARTICLE_ACTIVATED']);
	}

	// Post article if article have no post and categorie have post forum
	if($row['post_id'] == 0 && $row['post_forum'] <> 0 && $kb_config['activ_post'])
	{
		include_once($phpbb_root_path . 'includes/bbcode.' . $phpEx);
		include_once($phpbb_root_path . 'includes/message_parser.' . $phpEx);
		include_once($phpbb_root_path . 'includes/functions_posting.' . $phpEx);

		$user_tmp['user_id'] = $user->data['user_id'];
		$user_tmp['username'] = $user->data['username'];
		$user_tmp['user_colour'] = $user->data['user_colour'];

		$user->data['user_id'] = $row['user_id'];
		$user->data['username'] = $row['username'];
		$user->data['user_colour'] = $row['user_colour'];
	
		$message = replace_post_text($row, $kb_config['post_message']);
		$subject = replace_post_text($row, $kb_config['post_subject']);
	
		$poll = $uid = $bitfield = $options = '';
		generate_text_for_storage($message, $uid, $bitfield, $options, true, true, true);

		$post_data = array(
			'poster_id'			=> $kb_config['post_user'],
			'forum_id'			=> $row['post_forum'],
			'icon_id'			=> false,
			'enable_bbcode'		=> true,
			'post_approved'		=> 1,
			'topic_approved'	=> 1,
			'enable_smilies'	=> true,
			'enable_urls'		=> true,
			'enable_sig'		=> true,
			'message'			=> $message,
			'topic_time_limit'	=> 0,
			'message_md5'		=> md5($message),
			'bbcode_bitfield'	=> $bitfield,
			'bbcode_uid'		=> $uid,
			'post_edit_locked'	=> 0,
			'topic_title'		=> $subject,
			'notify_set'		=> false,
			'notify'			=> false,
			'post_time'			=> 0,
			'forum_name'		=> '',
			'enable_indexing'	=> true,
		);
		submit_post('post', $subject, $row['username'], $kb_config['topic_type'], $poll, $post_data);

		// And now we put the user data back
		$user->data['user_id'] = $user_tmp['user_id'];
		$user->data['username'] = $user_tmp['username'];
		$user->data['user_colour'] = $user_tmp['user_colour'];

		$sql = 'SELECT post_id
			FROM ' . POSTS_TABLE . '
			WHERE poster_id = ' . $kb_config['post_user'] . '
				AND forum_id = ' . $row['post_forum'] . '
			ORDER BY post_time DESC';
		$result = $db->sql_query($sql);
		$post_data = $db->sql_fetchrow($result);
	}

	// activate article
	if (sizeof($post_data))
	{
		$sql = 'UPDATE ' . KB_ARTICLE_TABLE . '
			SET activ = 1, post_id = ' . (int) $post_data['post_id'] . '
			WHERE article_id = ' . (int) $article_id;
	}
	else
	{
		$sql = 'UPDATE ' . KB_ARTICLE_TABLE . '
			SET activ = 1
			WHERE article_id = ' . (int) $article_id;
	}
	$db->sql_query($sql);
	$cache->destroy('sql', KB_ARTICLE_TABLE);

	set_config('num_kb_article', $config['num_kb_article'] + 1, true);

	$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
		SET cat_articles = cat_articles + 1
		WHERE cat_id = ' . (int) $row['cat_id'] . '
			OR (left_id < ' . (int) $row['left_id'] . '
				AND right_id > ' . (int) $row['right_id'] . ')';
	$db->sql_query($sql);
	$cache->destroy('sql', KB_CATEGORIE_TABLE);
	set_newest_article($row['cat_id']);
}

function set_newest_article($cat_id)
{
	global $db, $cache;

	$sql = 'SELECT a.*, u.username, u.user_colour, u.user_id
		FROM ' . KB_ARTICLE_TABLE . ' a, ' . USERS_TABLE . ' u
		WHERE a.cat_id = ' . (int) $cat_id . '
			AND a.activ = 1
			AND a.user_id = u.user_id
		ORDER BY a.post_time DESC';
	$result = $db->sql_query_limit($sql, 1);
	$row = $db->sql_fetchrow($result);

	$sql_ary = array(	
		//'cat_articles'					=> $total_articles,
		'last_article_title'			=> $row['titel'],
		'last_article_url'				=> $row['page_uri'],
		'last_article_time'				=> $row['post_time'],
		'last_article_id'				=> $row['article_id'],
		'last_article_poster_name'		=> $row['username'],
		'last_article_poster_id'		=> $row['user_id'],
		'last_article_poster_colour'	=> $row['user_colour'],
	);

	$sql = 'SELECT *
		FROM ' . KB_ARTICLE_TABLE . '
		WHERE activ = 1
		ORDER BY post_time DESC';
	$result = $db->sql_query_limit($sql, 1);
	$row = $db->sql_fetchrow($result);
	set_config('kb_newest_title', $row['titel']);
	set_config('kb_newest_id', $row['article_id']);
	set_config('kb_newest_uri', $row['page_uri']);

	$sql = 'SELECT left_id, right_id, cat_id
		FROM ' . KB_CATEGORIE_TABLE . '
		WHERE cat_id = ' . (int) $row['cat_id'];
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	$db->sql_query('UPDATE ' . KB_CATEGORIE_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' 
		WHERE cat_id = ' . (int) $cat_id . '
			OR (left_id < ' . (int) $row['left_id'] . '
				AND right_id > ' . (int) $row['right_id'] . ')');
	$cache->destroy('sql', KB_CATEGORIE_TABLE);
}

/**
* Update the post in forum
*/
function update_article_post($article_id)
{
	global $db, $user, $auth, $kb_config, $phpbb_root_path, $phpEx;

	if ($kb_config['update_post'] == 1)
	{
		$post_data = array();
		$sql_array = array(
			'SELECT'	=> 'a.article_id, a.activ, a.article, a.titel, a.description, a.post_time, a.cat_id, a.type_id, a.user_id, a.page_uri, a.post_id, c.post_forum, c.cat_title, c.show_edits, t.name, ut.username, ut.user_colour, ut.user_id, ua.username AS author',
		
			'FROM'		=> array(
				KB_ARTICLE_TABLE	=> 'a',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=>	array(KB_CATEGORIE_TABLE	=> 'c'),
					'ON'	=> 'c.cat_id = a.cat_id'
				),
				array(
					'FROM'	=> array(KB_TYPES_TABLE => 't'),
					'ON'	=> 't.type_id = a.type_id'
				),
				array(
					'FROM'	=> array(USERS_TABLE => 'ut'),
					'ON'	=> 'ut.user_id = ' . (int) $kb_config['post_user']
				),
				array(
					'FROM'	=> array(USERS_TABLE => 'ua'),
					'ON'	=> 'ua.user_id = a.user_id'
				)
			),
			'WHERE'		=> 'a.article_id = ' . (int) $article_id,
		);
	
		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
	
		$sql = 'SELECT t.topic_replies_real, t.topic_id
			FROM ' . TOPICS_TABLE . ' t, ' . POSTS_TABLE . ' p
			WHERE p.post_id = ' . (int) $row['post_id'] . '
				AND t.topic_id = p.topic_id';
		$result = $db->sql_query($sql);
		$post_row = $db->sql_fetchrow($result);
		if (!empty($post_row))
		{
			include_once($phpbb_root_path . 'includes/bbcode.' . $phpEx);
			include_once($phpbb_root_path . 'includes/message_parser.' . $phpEx);
			include_once($phpbb_root_path . 'includes/functions_posting.' . $phpEx);

			// Fake Userdata while posting
			$user_tmp['user_id'] = $user->data['user_id'];
			$user_tmp['username'] = $user->data['username'];
			$user_tmp['user_colour'] = $user->data['user_colour'];
			$user->data['user_id'] = $row['user_id'];
			$user->data['username'] = $row['username'];
			$user->data['user_colour'] = $row['user_colour'];
 
			// Replace variables in post message
			$message = replace_post_text($row, $kb_config['post_message']);
			$subject = replace_post_text($row, $kb_config['post_subject']);
		
			// Lets post to forum
			$poll = $uid = $bitfield = $options = '';
			generate_text_for_storage($message, $uid, $bitfield, $options, true, true, true);
			$data = array(
				'topic_replies_real'	=> $post_row['topic_replies_real'],
				'topic_id'				=> $post_row['topic_id'],
				'post_edit_reason'		=> false,
				'post_id'				=> $row['post_id'],
				'poster_id'				=> $kb_config['post_user'],
				'forum_id'				=> $row['post_forum'],
				'icon_id'				=> false,
				'enable_bbcode'			=> true,
				'enable_smilies'		=> true,
				'enable_urls'			=> true,
				'enable_sig'			=> true,
				'message'				=> $message,
				'topic_time_limit'		=> 0,
				'message_md5'			=> md5($message),
				'bbcode_bitfield'		=> $bitfield,
				'bbcode_uid'			=> $uid,
				'topic_first_post_id'	=> false,
				'topic_last_post_id'	=> false,
				'post_edit_locked'		=> 0,
				'post_edit_reason'		=> ($kb_config['show_post_edit'] == 1) ? $user->lang['POST_UPDATE_MESSAGE'] : '',
				'post_edit_user'		=> ($kb_config['show_post_edit'] == 1) ? $user_tmp['user_id'] : '',
				'topic_title'			=> $subject,
				'notify_set'			=> false,
				'notify'				=> false,
				'post_time'				=> 0,
				'forum_name'			=> '',
				'enable_indexing'		=> true,
			);
			submit_post('edit', $subject, $row['username'], $kb_config['topic_type'], $poll, $data);

			// And now we put the user data back
			$user->data['user_id'] = $user_tmp['user_id'];
			$user->data['username'] = $user_tmp['username'];
			$user->data['user_colour'] = $user_tmp['user_colour'];
		}
	}
}

/**
* Replace variables in post text
*/
function replace_post_text($row, $text)
{
	global $phpEx, $user;

	$url = (KB_SEO == true && !empty($row['page_uri'])) ? generate_board_url() . '/' . KB_FOLDER . '/' . $row['page_uri'] . '.html' : generate_board_url() . '/' . KB_FOLDER . "/viewarticle.$phpEx?id=" . $row['article_id'];
	// Replace variables
	$search = array(
		'{TITLE}',
		'{DESCRIPTION}',
		'{ARTICLE}',
		'{POST_TIME}',
		'{URL}',
		'{TYPE}',
		'{SUB_CAT}',
		'{AUTHOR}',
		'{AUTHOR_ID}'
	);
	$replace = array(
		$row['titel'],
		$row['description'],
		$row['article'],
		$user->format_date($row['post_time']),
		$url,
		$row['name'],
		$row['cat_title'],
		$row['author'],
		$row['user_id'],
	);

	return str_replace($search, $replace, $text);
}

/**
* Deactivate a article
*/
function deactivate_article($article_id)
{
	global $auth, $cache, $phpbb_root_path, $db, $phpEx, $user, $config;

	if(!$auth->acl_get('m_activate_kb'))
	{
		trigger_error($user->lang['NO_AUTH_OPERATION']);
	}

	$sql = 'SELECT activ, cat_id
		FROM ' . KB_ARTICLE_TABLE . '
		WHERE article_id = ' . (int) $article_id;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);


	// Insert article log
	if($row['activ'] <> 0)
	{
		article_log($article_id, $user->lang['ARTICLE_DEACTIVATED']);
	}
	// deactivate article
	$db->sql_query('UPDATE ' . KB_ARTICLE_TABLE . "
		SET activ = '0'
		WHERE article_id = " . (int) $article_id );
	$cache->destroy('sql', KB_ARTICLE_TABLE);


	$sql = 'SELECT left_id, right_id, cat_id
		FROM ' . KB_CATEGORIE_TABLE . '
		WHERE cat_id = ' . (int) $row['cat_id'];
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	set_config('num_kb_article', $config['num_kb_article'] - 1, true);

	$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
		SET cat_articles = cat_articles - 1
		WHERE cat_id = ' . (int) $row['cat_id'] . '
			OR (left_id < ' . (int) $row['left_id'] . '
				AND right_id > ' . (int) $row['right_id'] . ')';
	$db->sql_query($sql);
	set_newest_article($row['cat_id']);
}



function move_article($article_id, $to_categorie)
{

	global $db, $cache;

	$articles = is_array($article_id) ? $article_id : array($article_id);
	$cat = array();
	$count = 0;
	$sql = 'SELECT a.cat_id, a.user_id, a.article_id, c.left_id, c.right_id
		FROM ' . KB_ARTICLE_TABLE . ' a, ' . KB_CATEGORIE_TABLE . ' c
		WHERE ' . $db->sql_in_set('a.article_id', $articles) . '
			AND  a.article_id <> 0
			AND c.cat_id = a.cat_id';
	$result = $db->sql_query($sql);
	while($row = $db->sql_fetchrow($result))
	{
		$count++;
		$article_ids[] = $row['article_id'];
		@$cat[$row['cat_id']]['count']++;
		$cat[$row['cat_id']]['right_id'] = $row['right_id'];
		$cat[$row['cat_id']]['left_id'] = $row['left_id'];
	}

	$db->sql_freeresult($result);

	$sql = 'SELECT left_id, right_id
		FROM ' . KB_CATEGORIE_TABLE . ' c
		WHERE c.cat_id = ' . (int) $to_categorie;
	$result = $db->sql_query($sql);
	$to_row = $db->sql_fetchrow($result);


	$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
		SET cat_articles = cat_articles + ' . $count . '
		WHERE cat_id = ' . (int) $to_categorie . '
			OR (left_id < ' . (int) $to_row['left_id'] . '
				AND right_id > ' . (int) $to_row['right_id'] . ')';
	$db->sql_query($sql);
	
	foreach ($cat as $categorie => $cat_row)
	{
		$sql = 'UPDATE ' . KB_ARTICLE_TABLE . ' 
			SET cat_id = ' .  (int) $to_categorie . ' 
			WHERE ' . $db->sql_in_set('article_id', $articles) . '
				AND cat_id = ' . (int) $categorie;
		$db->sql_query($sql);

		$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
			SET cat_articles = cat_articles - ' . $cat_row['count'] . '
			WHERE cat_id = ' . (int) $categorie . '
				OR (left_id < ' . (int) $cat_row['left_id'] . '
					AND right_id > ' . (int) $cat_row['right_id'] . ')';
		$db->sql_query($sql);

		set_newest_article($categorie);
	}
	set_newest_article($to_categorie);
	$cache->destroy('sql', KB_ARTICLE_TABLE);
	$cache->destroy('sql', KB_CATEGORIE_TABLE);
	return true;
}



/**
* Delete articles from database
*/
function delete_article($article_id)
{
	global $auth, $cache, $user, $db, $phpbb_root_path, $phpEx, $config;

	if (confirm_box(true))
	{
		$articles = is_array($article_id) ? $article_id : array($article_id);
		$cat = array();
		$sql = 'SELECT a.cat_id, a.user_id, a.article_id, c.left_id, c.right_id
			FROM ' . KB_ARTICLE_TABLE . ' a, ' . KB_CATEGORIE_TABLE . ' c
			WHERE ' . $db->sql_in_set('a.article_id', $articles) . '
				AND  a.article_id <> 0
				AND c.cat_id = a.cat_id';
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result))
		{
			if($auth->acl_get('m_del_kb') || ($auth->acl_get('kb_del_article', $row['cat_id']) && $row['user_id'] == $user->data['user_id']))
			{
				$article_ids[] = $row['article_id'];
				@$cat[$row['cat_id']]['count']++;
				$cat[$row['cat_id']]['right_id'] = $row['right_id'];
				$cat[$row['cat_id']]['left_id'] = $row['left_id'];
			}
		}

		$db->sql_freeresult($result);

		$sql = 'SELECT *
			FROM ' . ATTACHMENTS_TABLE . '
			WHERE ' . $db->sql_in_set('post_msg_id', $article_ids) . '
				AND in_message = 2
				AND topic_id = 0';
		$result = $db->sql_query($sql);
		$attachments = array();
		while ($arow = $db->sql_fetchrow($result))
		{
			$attachments[] = $arow['attach_id'];
		}
		$db->sql_freeresult($result);
		if( sizeof($attachments))
		{
			include_once($phpbb_root_path . 'includes/functions_admin.' . $phpEx);
			delete_attachments('attach', $attachments, false);
		}

		$sql = 'DELETE FROM ' . KB_ARTICLE_TABLE . '
			WHERE ' . $db->sql_in_set('article_id', $article_ids);
		$db->sql_query($sql);
		$cache->destroy('sql', KB_ARTICLE_TABLE);

		$sql = 'DELETE FROM ' . KB_LOG_TABLE . '
			WHERE ' . $db->sql_in_set('article_id', $article_ids);
		$db->sql_query($sql);
		$cache->destroy('sql', KB_LOG_TABLE);

		$sql = 'DELETE FROM ' . KB_ARTICLE_DIFF_TABLE . '
			WHERE ' . $db->sql_in_set('article_id', $article_ids);
		$db->sql_query($sql);
		$cache->destroy('sql', KB_ARTICLE_DIFF_TABLE);

		foreach ($cat as $categorie => $cat_row)
		{
			$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
				SET cat_articles = cat_articles - ' . $cat_row['count'] . '
				WHERE cat_id = ' . (int) $categorie . '
					OR (left_id < ' . (int) $cat_row['left_id'] . '
						AND right_id > ' . (int) $cat_row['right_id'] . ')';
			$db->sql_query($sql);
			set_config('num_kb_article', $config['num_kb_article'] - $cat_row['count'], true);
			set_newest_article($categorie);
		}
		$cache->destroy('sql', KB_CATEGORIE_TABLE);
		return true;
	}
	else
	{
		confirm_box(false, $user->lang['ARTICLE_DEL'], build_hidden_fields(array(
			'id'		=> $articles,
			'action'	=> 'delete',
		)));
	}
}

/**
* Return a option list with all types
*/
function make_type_list($id = 0)
{
	global $user, $db, $kb_config;
	$type_option = '<option value="0">' . $user->lang['NO_TYPE'] . '</option>';
	$sql = 'SELECT type_id, name 
		FROM ' . KB_TYPES_TABLE;
	$result = $db->sql_query($sql, $kb_config['cache_time']);
	while ($row = $db->sql_fetchrow($result))
	{
		$type_option .= ($id == $row['type_id']) ? '<option selected="selected" value="' . $row['type_id'] . '">' . $row['name'] . '</option>' : '<option value="' . $row['type_id'] . '">' . $row['name'] . '</option>';
	}
	$db->sql_freeresult($result);
	return $type_option;
}

?>