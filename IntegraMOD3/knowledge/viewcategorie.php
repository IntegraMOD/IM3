<?php
/** 
*
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package Knowledge_Base
* @version $Id: viewcategorie.php 49 2009-06-14 15:05:03Z tobi.schaefer $
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
include($phpbb_root_path . 'includes/functions_kb.' . $phpEx);
include($phpbb_root_path . 'includes/bbcode.' . $phpEx);
include('kb_common.' . $phpEx);  

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/kb');

$cat_id	= request_var('id', 0);
$start	= request_var('start', 0);

// Categorie info
$sql = 'SELECT cat_id, cat_title, parent_id, description
	FROM ' . KB_CATEGORIE_TABLE . '
	WHERE cat_id = ' . (int) $cat_id;
$result = $db->sql_query($sql, $kb_config['cache_time']);
$cat_row = $db->sql_fetchrow($result);
$db->sql_freeresult($result);


if (!$auth->acl_get('kb_view_article', $cat_id))
{
	trigger_error('NOT_AUTHORISED');
}

// Sub categories
$data = make_categorie_list($cat_id);


// Article in this categorie
$sql_where = (!$auth->acl_get('m_activate_kb')) ? ' AND a.activ = "1"' : '';
$sql = 'SELECT COUNT(a.article_id) AS total_articles
	FROM ' . KB_ARTICLE_TABLE . ' a
	WHERE a.cat_id = ' . (int) $cat_id .
	$sql_where;
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
	'WHERE'		=> 'a.cat_id = ' . (int) $cat_id .
		$sql_where,
	'ORDER_BY'	=> 'a.' . $db->sql_escape($kb_config['sort_order']) . ' ' . $db->sql_escape($kb_config['sort_order_dir'])
);
if ($user->data['is_registered'] && !$user->data['is_bot'])
{
	$sql_array['LEFT_JOIN'][] = array('FROM' => array(KB_ARTICLE_TRACK_TABLE => 'tt'), 'ON' => 'tt.article_id = a.article_id AND tt.user_id = ' . $user->data['user_id']);
	$sql_array['SELECT'] .= ', tt.mark_time';
}

$sql = $db->sql_build_query('SELECT', $sql_array);
$result = $db->sql_query_limit($sql, $config['topics_per_page'], $start);
while ($row = $db->sql_fetchrow($result))
{
	$dotts = strlen($row['description']) > 50 ? '...' : '';
	$template->assign_block_vars('article_row', array(
		'TITLE'					=> $row['titel'],
		'FOLDER'				=> empty($row['mark_time']) && $user->data['is_registered'] && !$user->data['is_bot'] ? 'topic_unread' : 'topic_read',
		'DESCRIPTION'			=> substr(str_replace('\n', '<br />', $row['description']), 0, 50) . $dotts,
		'TIME'					=> $user->format_date($row['post_time']),
		'HITS'					=> $row['hits'],
		'U_ARTICLE'				=> article_link($row['article_id'], $row['page_uri']),
		'AUTHOR_FULL'			=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
		'U_MCP_QUEUE'			=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_activate&amp;part=view&amp;id=' . $row['article_id']),
		'U_MCP_REPORT'			=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_reports&amp;part=view&amp;r=' . $row['reported_id']),
		'S_ARTICLE_UNAPPROVED'	=> ($row['activ'] == 0) ? true : false,
		'S_ARTICLE_REPORTED'	=> ($row['reported_id'] != 0) ? true : false,
		'HAS_ATTACHEMENT'		=> ($row['has_attachment'] == 1) ? true: false,
	));
}
$db->sql_freeresult($result);

$user->lang['TRANSLATION_INFO'] = $user->lang['KB_COPYRIGHT'] . '<br />' . $user->lang['TRANSLATION_INFO'];  

// Assign index specific vars
$template->assign_vars(array(
	'PAGINATION'		=> generate_pagination("viewcategorie.$phpEx?id=" . $cat_id, $total_articles, $config['topics_per_page'], $start),
	'PAGE_NUMBER'		=> on_page($total_articles, $config['topics_per_page'], $start),
	'TOTAL_TOPICS'		=> $total_articles,
	'CAT_TITLE'			=> $cat_row['cat_title'],
	'CAT_DESCRIPTION'	=> $cat_row['description'],
	'U_ADD_ARTICLE'		=> append_sid("{$kb_root_path}kbposting.$phpEx", 'cat_id=' . $cat_id),
	'S_ADD_ARTICLE'		=> ($auth->acl_get('kb_add_article', $cat_id) || $auth->acl_get('kb_add_article_direct', $cat_id)) ? true : false,
	'NOFORUMNAV'		=> true,
	'U_CANONICAL'		=> generate_board_url() . '/' . KB_FOLDER . '/' . (KB_SEO == true ? 'categorie-' . $cat_id . '.html' : "viewcategorie.$phpEx?id=" . $cat_id),
	'CLASSIC_INDEX'		=> $kb_config['kb_mode'],
	'S_SEARCHBOX_ACTION'	=> append_sid("{$kb_root_path}kb-search.$phpEx", 'terms=all'),
	'CATEGORIE_ID'		=> $cat_id,
	'U_MCP'				=> ($auth->acl_get('m_activate_kb') || $auth->acl_get('m_report_kb') || $auth->acl_get('m_log_kb')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_main&amp;c=' . $cat_id) : '',
	'ATTACH_ICON_IMG'	=> $user->img('icon_topic_attach', $user->lang['TOTAL_ATTACHMENTS']),
	'UNAPPROVED_IMG'	=> $user->img('icon_topic_unapproved', 'TOPIC_UNAPPROVED'),
	'REPORTED_IMG'		=> $user->img('icon_topic_reported', 'TOPIC_REPORTED'),
));

$template->assign_block_vars('navlinks', array(
	'U_VIEW_FORUM'	=> append_sid("{$kb_root_path}"),
	'FORUM_NAME'	=> $user->lang['KBASE'])
);

$categorie_nav = get_categorie_branch($cat_id, 'parents', 'descending', true);
foreach ($categorie_nav as $row)
{
	$template->assign_block_vars('navlinks', array(
		'U_VIEW_FORUM'	=> categorie_link($cat_id),
		'FORUM_NAME'	=> $row['cat_title'])
	);
}

// Output page
page_header($user->lang['KBASE'] . '-' . $cat_row['cat_title']);

$template->set_filenames(array(
	'body' => 'kb/kb_categorie.html')
);

page_footer();

?>
