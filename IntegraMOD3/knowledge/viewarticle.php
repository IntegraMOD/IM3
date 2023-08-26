<?php
/** 
*
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package Knowledge_Base
* @version $Id: viewarticle.php 49 2009-06-14 15:05:03Z tobi.schaefer $
* @copyright (c) 2007 SEO phpBB http://www.phpbb-seo.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/bbcode.' . $phpEx);
include($phpbb_root_path . 'includes/functions_kb.' . $phpEx);
include('kb_common.' . $phpEx);

$config['allow_pm_attach'] = $config['allow_attachments'];



// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('viewtopic', 'viewforum', 'mods/kb'));

$article_id = request_var('id', 0);
$filename = request_var('filename', '');
$mode = request_var('mode', '');
$script_path = ( $config['script_path'] != '/' ) ? $config['script_path'] . '/' : '/';
$filename = str_replace($script_path . KB_FOLDER . '/', '', $filename);

// Select article data
$where = ($filename != '') ? "a.page_uri = '" . $db->sql_escape($filename). "'" : 'a.article_id = ' . (int) $article_id;
$sql_array = array(
	'SELECT'	=> 'c.ads, c.cat_title, c.show_edits, t.name, a.*, u.username, u.user_colour, u.user_id, p.topic_id, p.forum_id',

	'FROM'		=> array(
		KB_ARTICLE_TABLE	=> 'a',
	),
	'LEFT_JOIN'	=> array(
		array(
			'FROM'	=>	array(USERS_TABLE	=> 'u'),
			'ON'	=> 'a.user_id = u.user_id'
		),
		array(
			'FROM'	=>	array(POSTS_TABLE	=> 'p'),
			'ON'	=> 'p.post_id = a.post_id AND p.post_approved = 1'
		),
		array(
			'FROM'	=>	array(KB_TYPES_TABLE	=> 't'),
			'ON'	=> 't.type_id = a.type_id'
		),

		array(
			'FROM'	=>	array(KB_CATEGORIE_TABLE	=> 'c'),
			'ON'	=> 'c.cat_id = a.cat_id'
		),
	),
	'WHERE'		=> $where,
);

if ($user->data['is_registered'] && !$user->data['is_bot'])
{
	$sql_array['LEFT_JOIN'][] = array('FROM' => array(KB_ARTICLE_TRACK_TABLE => 'tt'), 'ON' => 'tt.article_id = a.article_id AND tt.user_id = ' . (int) $user->data['user_id']);
	$sql_array['SELECT'] .= ', tt.mark_time';
}

$sql = $db->sql_build_query('SELECT', $sql_array);
$result = $db->sql_query($sql, $kb_config['cache_time']);
$row = $db->sql_fetchrow($result);
$db->sql_freeresult($result);


// rate an article
if($mode == 'rate' && $kb_config['activ_rating'] && $auth->acl_get('kb_rate_article', $row['cat_id']))
{
	$points = request_var('points', 0);
	$ratings = $article_rating_points = $article_points = 0;
	$sql = 'SELECT points, user_id
		FROM ' . KB_RATING_TABLE . "
		WHERE article_id = " . (int) $article_id;
	$result = $db->sql_query($sql);
	while ($rating_row = $db->sql_fetchrow($result))
	{
		if($rating_row['user_id'] ==  $user->data['user_id'])
		{
			$redirect_url = article_link($article_id, $data['page_uri']);
			meta_refresh(3, $redirect_url);
			trigger_error($user->lang['ALREADY_RATED'] . '<br /><br />' . sprintf($user->lang['BACK_TO_KB'], '<a href="' . append_sid("{$kb_root_path}") . '">', '</a>') . '<br /><br />'. sprintf($user->lang['BACK_TO_ARTICLE'], '<a href="' . $redirect_url . '">', '</a>'));
		}
		$article_rating_points = $article_rating_points + $rating_row['points'];
		$ratings++;
	}
	$article_points = ($article_rating_points + $points) / ($ratings + 1);
	$article_points = round($article_points);

	$sql_ary = array(
		'rating'			=> $article_points,
	);
	$db->sql_query('UPDATE ' . KB_ARTICLE_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE article_id = ' . (int) $article_id);
	$cache->destroy('sql', KB_ARTICLE_TABLE);

	$sql_ary = array(
		'article_id'=> (int) $article_id,
		'user_id'	=> (int) $user->data['user_id'],
		'points'	=> (int) $points,
	);
	$db->sql_query('INSERT INTO ' . KB_RATING_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
	$cache->destroy('sql', KB_RATING_TABLE);

	$redirect_url = article_link($article_id, $row['page_uri']);
	meta_refresh(3, $redirect_url);
	trigger_error($user->lang['ARTICLE_RATED'] . '<br /><br />' . sprintf($user->lang['BACK_TO_KB'], '<a href="' . append_sid("{$kb_root_path}") . '">', '</a>') . '<br /><br />'. sprintf($user->lang['BACK_TO_ARTICLE'], '<a href="' . $redirect_url . '">', '</a>'));
}

// URL check if SEO
if (KB_SEO == true && !empty($row['page_uri']) && !isset($_GET['explain']) && !isset($_GET['highlight']) && $mode != 'print')
{
	$script_path = ( $config['script_path'] != '/' ) ? $config['script_path'] . '/' : '/';
	$needed_url = $script_path . KB_FOLDER . '/'. $row['page_uri'] . '.html';
	if($needed_url != $_SERVER['REQUEST_URI'])
	{
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: " . generate_board_url() . '/' . KB_FOLDER . '/'. $row['page_uri'] . '.html');
	}
}

// Article activ?
if(!$row || !$auth->acl_get('kb_view_article', $row['cat_id']) || ($row['activ'] == '0' && !$auth->acl_get('m_edit_kb')))
{	
	trigger_error($user->lang['NO_ARTICLE'] . '<br /><br />' . sprintf($user->lang['BACK_TO_KB'], '<a href="' . append_sid("{$kb_root_path}") . '">', '</a>'));
}

if(empty($row['mark_time']) && $user->data['is_registered'] && !$user->data['is_bot'])
{
	$sql_ary = array(
		'article_id'=> (int) $row['article_id'],
		'cat_id'	=> (int) $row['cat_id'],
		'user_id'	=> (int) $user->data['user_id'],
		'mark_time'	=> time(),
	);
	$db->sql_query('INSERT INTO ' . KB_ARTICLE_TRACK_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
	$cache->destroy('sql', KB_ARTICLE_TRACK_TABLE);
}


// Begin similar articles
if($kb_config['activ_similar'])
{
	$sql_array = array(
		'SELECT'	=> 'c.cat_title, c.cat_id, a.article_id, a.page_uri, a.titel, u.user_id, u.username, u.user_colour',	

		'FROM'		=> array(
			KB_ARTICLE_TABLE	=> 'a',
		),

		'LEFT_JOIN'	=> array(
			array(
				'FROM'	=>	array(USERS_TABLE	=> 'u'),
				'ON'	=> 'u.user_id = a.user_id'
		),
			array(
				'FROM'	=>	array(KB_CATEGORIE_TABLE	=> 'c'),
				'ON'	=> 'c.cat_id = a.cat_id'
			),
		),	

		'WHERE'		=> "MATCH (a.titel) AGAINST ('" . $db->sql_escape($row['titel']) . "' ) >= 0.5
			AND a.article_id <> " . (int) $row['article_id'],

		'GROUP_BY'	=> 'a.article_id',
	);
	$sql = $db->sql_build_query('SELECT', $sql_array);
	if ($result = $db->sql_query_limit($sql, 5, 0, $kb_config['cache_time']))
	{
		while($similar = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('similar', array(
				'TOPIC_TITLE'			=> $similar['titel'],
				'U_TOPIC'				=> article_link($similar['article_id'], $similar['page_uri']),
				'USER'					=> get_username_string('full', $similar['user_id'], $similar['username'], $similar['user_colour'], $similar['username']),
				'U_CATEGORIE'			=> categorie_link($similar['cat_id']),
				'CATEGORIE'				=> $similar['cat_title'])
			);
		}
	}
}


// last change user
if (($row['last_change'] != $row['post_time']) && $row['show_edits'] == '1')
{
	$sql = 'SELECT username, user_colour, user_id
		FROM ' . USERS_TABLE . '
		WHERE user_id = ' . (int) $row['last_edit_user'];
	$result = $db->sql_query($sql, $kb_config['cache_time']);
	$last_user = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	$last_change_user = get_username_string('full', $last_user['user_id'], $last_user['username'], $last_user['user_colour']);
}
else
{
	$last_change_user = '';
}

// Update views, but not for bots
if (!$user->data['is_bot'])
{
	$sql = 'UPDATE ' . KB_ARTICLE_TABLE . '
		SET hits = hits + 1
		WHERE article_id = ' . (int) $row['article_id'];
	$db->sql_query($sql);
}

// Get attachements
if ($auth->acl_get('kb_download', $row['cat_id']) && $row['has_attachment'] && $config['allow_attachments'])
{
	$sql = 'SELECT *
		FROM ' . ATTACHMENTS_TABLE . '
		WHERE post_msg_id = ' . (int) $row['article_id'] . '
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

$row['bbcode_options'] = (($row['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) +
    (($row['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) + 
    (($row['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
$message = generate_text_for_display($row['article'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']);

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

// highlight search words
$hilit_words = request_var('highlight', '');
$highlight_match = $highlight = '';
if ($hilit_words)
{
	foreach (explode(' ', trim($hilit_words)) as $word)
	{
		if (trim($word))
		{
			$word = str_replace('\*', '\w+?', preg_quote($word, '#'));
			$word = preg_replace('#(^|\s)\\\\w\*\?(\s|$)#', '$1\w+?$2', $word);
			$highlight_match .= (($highlight_match != '') ? '|' : '') . $word;
		}
	}
}
if ($highlight_match)
{
	$message = preg_replace('#(?!<.*)(?<!\w)(' . $highlight_match . ')(?!\w|[^<>]*(?:</s(?:cript|tyle))?>)#is', '<span class="posthilit">\1</span>', $message);
}

$user->lang['TRANSLATION_INFO'] = $user->lang['KB_COPYRIGHT'] . '<br />' . $user->lang['TRANSLATION_INFO'];  

// output ratings
if($kb_config['activ_rating'])
{
	$ratings = $article_rating_points = $article_points = 0;
	$sql = 'SELECT points, user_id
		FROM ' . KB_RATING_TABLE . "
		WHERE article_id = " . (int) $row['article_id'];
	$result = $db->sql_query($sql, $kb_config['cache_time']);
	while ($rating_row = $db->sql_fetchrow($result))
	{
		if($rating_row['user_id'] ==  $user->data['user_id'])
		{
			$own_rating = $rating_row['points'];
		}
		$article_rating_points = $article_rating_points + $rating_row['points'];
		$ratings++;
	}
	if($ratings > 0)
	{
		$article_points = $article_rating_points / $ratings;
		$article_points = round($article_points);
	}
}


if($kb_config['activ_diff'] && $auth->acl_get('kb_view_diff', $row['cat_id']))
{

	$diff_id = request_var('diff_id', 0);
	if($diff_id != 0)
	{
		$sql = 'SELECT article, bbcode_uid, time
			FROM ' . KB_ARTICLE_DIFF_TABLE . '
			WHERE diff_id = ' . (int) $diff_id;
		$result = $db->sql_query($sql);
		$diff_row = $db->sql_fetchrow($result);
		decode_message($diff_row['article'], $diff_row['bbcode_uid']);
		decode_message($row['article'], $row['bbcode_uid']);
		include($phpbb_root_path . 'includes/diff/diff.' . $phpEx);
		include($phpbb_root_path . 'includes/diff/engine.' . $phpEx);
		include($phpbb_root_path . 'includes/diff/renderer.' . $phpEx);
		$diff = new diff(trim_trailing_spaces($diff_row['article']), trim_trailing_spaces($row['article']));
		$renderer = new diff_renderer_inline();
		$diff_message = $renderer->get_diff_content($diff);
		$diff_message = bbcode_nl2br($diff_message);
		$diff_title = sprintf($user->lang['DIFFERENCE'], $user->format_date($diff_row['time']));
	}

	$sql = 'SELECT d.diff_id, d.time, d.edit_reason, u.username, u.user_colour, u.user_id
		FROM ' . KB_ARTICLE_DIFF_TABLE . ' d, ' . USERS_TABLE . ' u
		WHERE d.user_id = u.user_id
			AND d.article_id = ' . (int) $article_id . '
		ORDER BY d.time DESC';
	$result = $db->sql_query($sql);
	while ($diff_row = $db->sql_fetchrow($result))
	{
		$template->assign_block_vars('diff_row', array(
			'U_DIFF'		=> append_sid("{$kb_root_path}viewarticle.$phpEx", 'id=' . $article_id . '&amp;diff_id=' . $diff_row['diff_id']) . '#diff',
			'TIME'			=> $user->format_date($diff_row['time']),
			'EDIT_REASON'	=> $diff_row['edit_reason'],
			'USER'			=> get_username_string('full', $diff_row['user_id'], $diff_row['username'], $diff_row['user_colour']),
			'U_DELETE'		=> append_sid("{$kb_root_path}kbposting.$phpEx", 'mode=del_diff&amp;id=' . $article_id . '&amp;diff_id=' . $diff_row['diff_id']),
			'U_RESTORE'		=> append_sid("{$kb_root_path}kbposting.$phpEx", 'mode=restore&amp;id=' . $article_id . '&amp;diff_id=' . $diff_row['diff_id']),
		));
	}
}

// Assign index specific vars
$template->assign_vars(array(
	'DIFFERENCE'			=> isset($diff_title) ? $diff_title : '',
	'DIFF_MESSAGE'			=> isset($diff_message) ? $diff_message : '',
	'U_CANONICAL'			=> generate_board_url() . '/' . KB_FOLDER . '/' . (KB_SEO == true && !empty($row['page_uri']) ? $row['page_uri'] . '.html' : "viewarticle.$phpEx?id=" . $row['article_id']),
	'OWN_RATING'			=> isset($own_rating) ? $own_rating : '',
	'S_POST_ACTION'			=> append_sid("{$kb_root_path}viewarticle.$phpEx", 'mode=rate&amp;id=' . $row['article_id']),
	'ARTICLE_POINTS'		=> (int) $article_points,
	'TOTAL_RATINGS'			=> (int) $ratings,
	'HITS'					=> $row['hits']+1,
	'TYPE'					=> ($row['name'] !='0') ? $row['name'] : '',
	//'POST_URI'    			=> ($row['topic_id'] != 0 && $row['topic_id']) ? generate_seourl_topic($row['topic_id'], false, $row['forum_id']) : '',
	'POST_URI'				=> ($row['topic_id'] != 0) ? append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;t=' . $row['topic_id']) : '',
	'LAST_CHANGE'			=> ($row['last_change'] != $row['post_time'] && $row['show_edits'] == '1') ? $user->format_date($row['last_change']) : '',
	'USER'					=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
	'CHANGE_USER'			=> $last_change_user,
	'ARTICLE_TIME'			=> $user->format_date($row['post_time']),
	'ARTICLE'				=> $message,
	'ID'					=> $article_id,
	'ADS'					=> htmlspecialchars_decode($row['ads']),
	'EDIT_IMG' 				=> $user->img('icon_post_edit', 'EDIT_POST'),
	'DELETE_IMG' 			=> $user->img('icon_post_delete', 'DELETE_POST'),
	'INFO_IMG' 				=> $user->img('icon_post_info', 'VIEW_INFO'),
	'REPORT_IMG'			=> $user->img('icon_post_report', 'REPORT_POST'),
	'REPORTED_IMG'			=> $user->img('icon_topic_reported', 'POST_REPORTED'),
	'UNAPPROVED_IMG'		=> $user->img('icon_topic_unapproved', 'TOPIC_UNAPPROVED'),
	'U_MCP'					=> ($auth->acl_get('m_activate_kb') || $auth->acl_get('m_report_kb') || $auth->acl_get('m_log_kb')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_main&amp;a=' . $article_id) : '',
	'U_ARTICLE_HISTORY'		=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_main&amp;a=' . $row['article_id']),
	'U_ADD_ARTICLE'			=> append_sid("{$kb_root_path}kbposting.$phpEx", 'cat_id=' . $row['cat_id']),
	'U_CATEGORIE'			=> (KB_SEO == true) ? append_sid("{$kb_root_path}categorie-" . $row['cat_id'] . '.html') : append_sid("{$kb_root_path}viewcategorie.$phpEx", 'id=' . $row['cat_id']),
	'U_EDIT_ARTICLE'		=> append_sid("{$kb_root_path}kbposting.$phpEx", 'mode=edit&amp;id=' . $row['article_id']),
	'U_REPORT'				=> append_sid("{$kb_root_path}kbreport.$phpEx", 'id=' . $row['article_id']),
	'U_DELETE_ARTICLE'		=> append_sid("{$kb_root_path}index.$phpEx", 'mode=delete&amp;id=' . $row['article_id']),
	'TITEL'					=> $row['titel'],
	'CAT_TITEL'				=> $row['cat_title'],
	'NOFORUMNAV'			=> true,
	'DESCRIPTION'			=> str_replace('\n', '<br />', $row['description']),
	'S_ADD_ARTICLE'			=> $auth->acl_get('kb_add_article', $row['cat_id']),
	'S_RATE_ARTICLE'		=> $auth->acl_get('kb_rate_article', $row['cat_id']),
	'S_RATING_ACTIV'		=> $kb_config['activ_rating'],
	'S_EDIT_ARTICLE'		=> (($auth->acl_get('kb_edit_article', $row['cat_id']) && $row['user_id'] == $user->data['user_id']) || $auth->acl_get('m_edit_kb') || $auth->acl_get('kb_edit_all_article', $row['cat_id'])),
	'S_ARTICLE_LOG'			=> $auth->acl_get('m_log_kb'),
	'S_ARTICLE_REPORT'		=> $auth->acl_get('kb_report_article', $row['cat_id']),
	'S_DELETE_ARTICLE'		=> (($auth->acl_get('kb_del_article', $row['cat_id']) && $row['user_id'] == $user->data['user_id']) || $auth->acl_get('m_del_kb')),
	'U_PRINT_TOPIC'			=> $auth->acl_get('kb_print_article', $row['cat_id']) ? append_sid("{$kb_root_path}viewarticle.$phpEx", 'mode=print&amp;id=' . $row['article_id']) : '',
	'S_POST_REPORTED'		=> ($row['reported_id'] != 0) ? true : false,
	'S_POST_UNAPPROVED'		=> ($row['activ'] == 0) ? true : false,
	'S_DISPLAY_NOTICE'   	=> !$auth->acl_get('u_download') && $row['has_attachment'],
	'U_MCP_REPORT'			=> ($row['reported_id'] != 0) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_reports&amp;part=view&amp;r=' . $row['reported_id']) : '',
	'U_MCP_APPROVE'			=> ($row['activ'] == 0) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_activate&amp;part=view&amp;id=' . $row['article_id']) : '',
	)
);




$template->assign_block_vars('navlinks', array(
	'U_VIEW_FORUM'	=> append_sid("{$kb_root_path}"),
	'FORUM_NAME'	=> $user->lang['KBASE'])
);

$categorie_nav = get_categorie_branch($row['cat_id'], 'parents', 'descending', true);
foreach ($categorie_nav as $row1)
{
	$template->assign_block_vars('navlinks', array(
		'U_VIEW_FORUM'	=> categorie_link($row1['cat_id']),
		'FORUM_NAME'	=> $row1['cat_title'])
	);
}

function trim_trailing_spaces($lines)
{
	if (!is_array($lines))
	{
		$lines = explode("\n", $lines);
	}		

	return array_map('rtrim', $lines);
}

// Output page
page_header($row['titel']);

$template->set_filenames(array(
	'body' => $mode == 'print' ? 'kb/printarticle.html' : 'kb/viewarticle.html')
);

page_footer();

?>
