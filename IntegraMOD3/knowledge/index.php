<?php
/** 
*
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package Knowledge_Base
* @version $Id: index.php 43 2009-06-11 08:10:04Z tobi.schaefer $
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
include('kb_common.' . $phpEx);

$mode	= request_var('mode', '');

$kb_config['style'] = '2';

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/kb', empty($kb_config['overwrite_style']) ? $user->data['user_style'] : $kb_config['style']);



//delete
if ($mode =='delete')
{
	$id	= request_var('id', 0);
	if(delete_article($id))
	{
		trigger_error($user->lang['ARTICLE_DELETED'] . '<br /><br />' . sprintf($user->lang['BACK_TO_KB'], '<a href="' . append_sid("{$kb_root_path}") . '">', '</a>'));
	}
}

$data = make_categorie_list(0);

$user->lang['TRANSLATION_INFO'] = $user->lang['KB_COPYRIGHT'] . '<br />' . $user->lang['TRANSLATION_INFO'];  

// Assign index specific vars
$template->assign_vars(array(
	'S_LOGIN_ACTION'		=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=login'),
	'U_ACTION'				=> append_sid("{$kb_root_path}kb-search.$phpEx"),
	'U_MODERATE'			=> append_sid("{$kb_root_path}kb_mcp.$phpEx"),
	'U_NEWEST_ARTICLE'		=> isset($config['kb_newest_title']) ? article_link($config['kb_newest_id'], $config['kb_newest_uri']) : '',
	'COUNT_ARTICLE'			=> (!empty($config['num_kb_article']) ? $config['num_kb_article'] : null),
	'CONT_CATS'				=> (!empty($data['count_cats']) ? $data['count_cats'] : null),
	'U_CANONICAL'			=> generate_board_url() . '/' . KB_FOLDER . '/',
	'NEWEST_ARTICLE'		=> isset($config['kb_newest_title']) ? $config['kb_newest_title'] : '',
	'KB_TITLE'				=> (!empty($kb_config['kb_title']) ? $kb_config['kb_title'] : null),
	'KB_DESCRIPTION'		=> (!empty($kb_config['kb_description']) ? $kb_config['kb_description'] : null),
	'CLASSIC_INDEX'			=> (!empty($kb_config['kb_mode']) ? $kb_config['kb_mode'] : null),
	'U_MCP'					=> ($auth->acl_get('m_activate_kb') || $auth->acl_get('m_report_kb') || $auth->acl_get('m_log_kb')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=kb&amp;mode=kb_main') : '',
	'NOFORUMNAV'			=> true,
	'SITENAME'				=> $config['sitename'],
	'S_IN_KNOWLEDGE_BASE'	=> true,
	)
);

$template->assign_block_vars('navlinks', array(
	'U_VIEW_FORUM'	=> append_sid("{$kb_root_path}"),
	'FORUM_NAME'	=> $user->lang['KBASE'])
);

// Output page
page_header($user->lang['KBASE']);

$template->set_filenames(array(
	'body' => 'kb/kb_index.html')
);

page_footer();

