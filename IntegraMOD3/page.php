<?php

/**
*
* Static Pages MOD display page file
*
* @version $Id$
* @copyright (c) 2009 Vojtěch Vondra
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_pages.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/info_acp_pages');

$page_id = request_var('id', 0);
$page_url = request_var('p', '');

// Check if valid page ID entered, if not, show list of pages, else show page
if ($page_id <= 0 && $page_url == '')
{
	// Check if user is anonymous, if yes, server only pages he can se
	$where_sql = ($user->data['user_id'] == ANONYMOUS) ? ' AND p.page_display_guests = 1 ' : '';

	// Get pages from the database
	$sql = 'SELECT p.page_id, p.page_url, p.page_title, p.page_desc, p.page_author, u.username, u.user_colour
					FROM ' . PAGES_TABLE . ' p, ' . USERS_TABLE . " u
					WHERE u.user_id = p.page_author
						AND p.page_display = 1
						$where_sql
					ORDER BY p.page_order ASC, p.page_id ASC";
					
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result))
	{
		$template->assign_block_vars('pagelist', array(
			'PAGE_TITLE' => $row['page_title'],
			'PAGE_DESC' => $row['page_desc'],
			'PAGE_AUTHOR' => get_username_string('full', $row['page_author'], $row['username'], $row['user_colour']),
			'PAGE_LINK'   => append_sid("{$phpbb_root_path}page.$phpEx", 'id=' . (int) $row['page_id']),
		));
	}
	$db->sql_freeresult();
	
	// Send the page header
	page_header($user->lang['PAGES']);
	
	$template->set_filenames(array(
	    'body' => 'page_list.html',
	));
}
else
{
	// See whether the request is defined by a page id or page name
	if ($page_id <= 0)
	{
		$sql_where = "page_url = '" . $db->sql_escape($page_url) . "'";
	}
	else
	{
    $sql_where = 'page_id = ' . $page_id;
	}
	
	// Get the page info from the database
	$sql = 'SELECT page_id, page_title, page_seo_title, page_desc, page_content, page_display, page_display_guests, page_show_title, page_url, page_og_image, page_updated, page_html, bbcode_uid, bbcode_bitfield
					FROM ' . PAGES_TABLE . '
					WHERE ' . $sql_where;
	$result = $db->sql_query($sql, 3600);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult();

	// See if the page exists or if is hidden (to guests)
	if (empty($row) || ($row['page_display'] == 0 && !$auth->acl_getf_global('m_') && !$auth->acl_get('a_')) || ($row['page_display_guests'] == 0 && $user->data['user_id'] == ANONYMOUS))
	{
		// A name address that is not a page must be a real 404, not a board error page
		if (!empty($GLOBALS['im3_seo_route']['type']) && $GLOBALS['im3_seo_route']['type'] === 'page-name')
		{
			header('HTTP/1.0 404 Not Found');
		}

		trigger_error('PAGE_NOT_FOUND');
	}

	if (function_exists('im3_seo_register'))
	{
		im3_seo_register('page', $row['page_id'], $row['page_title']);
	}

	$public_page = (!empty($row['page_display']) && !empty($row['page_display_guests']));

	if ($public_page && function_exists('im3_seo_finalize'))
	{
		// Static pages redirect everyone, not only guests, so the name address is the only one in use
		$GLOBALS['im3_seo_force_redirect'] = true;
		im3_seo_finalize('page', $row['page_id'], $row['page_url']);
		$GLOBALS['im3_seo_force_redirect'] = false;
	}

	// HTML is stored raw. BBCode still goes through the post parser.
	if (!empty($row['page_html']))
	{
		$content = preg_replace('#<\?(?:php)?|\?>|<script\b[^>]*>.*?</script>#isu', '', $row['page_content']);
	}
	else
	{
		$content = generate_text_for_display($row['page_content'], $row['bbcode_uid'], $row['bbcode_bitfield'], 7);
	}
	$seo_title = (!empty($row['page_seo_title'])) ? $row['page_seo_title'] : $row['page_title'];
	$meta_desc = static_page_meta_description($row['page_desc']);
	$canonical = static_page_url($row['page_id'], $row['page_title'], $row['page_url']);
	$og_image = (!empty($row['page_og_image'])) ? $row['page_og_image'] : ((!empty($config['static_pages_og_image'])) ? $config['static_pages_og_image'] : '');
	$updated = (!empty($row['page_updated'])) ? (int) $row['page_updated'] : time();

	$template->assign_block_vars('navlinks', array(
		'FORUM_NAME'	=> $user->lang['PAGES'],
		'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}page.$phpEx"),
	));
	$template->assign_block_vars('navlinks', array(
		'FORUM_NAME'	=> $row['page_title'],
		'U_VIEW_FORUM'	=> $canonical,
	));

	// Push the data to the templates
	$template->assign_vars(array(
		'PAGE_TITLE'		=> $row['page_title'],
		'PAGE_DESC'			=> $row['page_desc'],
		'PAGE_CONTENT'		=> $content,
		'S_PAGE_HIDDEN'		=> (empty($row['page_display'])) ? true : false,
		'S_PAGE_SEO'		=> true,
		'S_PAGE_SHOW_TITLE'	=> (!isset($row['page_show_title']) || !empty($row['page_show_title'])) ? true : false,
		'META_DESCRIPTION'	=> $meta_desc,
		'U_CANONICAL'		=> $canonical,
		'S_NOINDEX'			=> (!$public_page) ? true : false,
		'OG_TITLE'			=> htmlspecialchars($seo_title, ENT_QUOTES, 'UTF-8'),
		'OG_DESCRIPTION'	=> $meta_desc,
		'OG_URL'			=> htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8'),
		'OG_TYPE'			=> 'article',
		'OG_IMAGE'			=> htmlspecialchars($og_image, ENT_QUOTES, 'UTF-8'),
		'ARTICLE_MODIFIED'	=> gmdate('Y-m-d\TH:i:s\Z', $updated),
		'PAGE_JSONLD'		=> static_page_jsonld($row, $canonical, $meta_desc, $og_image),
	));

  // Send the page header with the page title
	page_header($seo_title);

	$template->set_filenames(array(
	    'body' => 'page_body.html',
	));
}

// Send the page footer
page_footer();
?>
