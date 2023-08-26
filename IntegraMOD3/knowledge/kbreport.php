<?php
/**
*
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package Knowledge_Base
* @version $Id: kbreport.php 45 2009-06-11 17:09:25Z tobi.schaefer $
* @copyright (c) 2007 SEO phpBB http://www.phpbb-seo.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/functions_kb.' . $phpEx);
include('kb_common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('mcp', 'mods/kb'));

$artikel_id		= request_var('id', 0);
$reason_id		= request_var('reason_id', 0);
$report_text	= utf8_normalize_nfc(request_var('report_text', '', true));
$user_notify	= ($user->data['is_registered']) ? request_var('notify', 0) : false;
$submit 		= (isset($_POST['submit'])) ? true : false;

// Submit report?
if ($submit && $reason_id)
{
	$sql = 'SELECT *
		FROM ' . REPORTS_REASONS_TABLE . '
		WHERE reason_id = ' . (int) $reason_id;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if (!$row || (!$report_text && strtolower($row['reason_title']) == 'other'))
	{
		trigger_error('EMPTY_REPORT');
	}

	$sql_ary = array(
		'reason_id'		=> (int) $reason_id,
		'article_id'	=> (int) $artikel_id,
		'user_id'		=> (int) $user->data['user_id'],
		'user_notify'	=> (int) $user_notify,
		'report_closed'	=> 0,
		'report_time'	=> (int) time(),
		'report_text'	=> (string) $report_text
	);

	$sql = 'INSERT INTO ' . KB_REPORTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	$db->sql_query($sql);
	$cache->destroy('sql', KB_REPORTS_TABLE);
	$report_id = $db->sql_nextid();

	$sql = 'UPDATE ' . KB_ARTICLE_TABLE . ' SET  reported_id = ' . (int) $report_id . ' WHERE article_id = ' . (int) $artikel_id;
	$db->sql_query($sql);
	$cache->destroy('sql', KB_ARTICLE_TABLE);

	$redirect_url = article_link($artikel_id, false);
	meta_refresh(3, $redirect_url);

	article_log($artikel_id, $user->lang['ARTICLE_REPORTED']);
	$message = $user->lang['POST_REPORTED_SUCCESS'] . '<br /><br />' . sprintf($user->lang['RETURN_TOPIC'], '<a href="' . $redirect_url . '">', '</a>');
	trigger_error($message);
}

// Generate the reasons
display_reasons($reason_id);

$template->assign_vars(array(
	'REPORT_TEXT'		=> $report_text,
	'S_REPORT_ACTION'	=> append_sid("{$kb_root_path}kbreport.$phpEx", 'id=' . $artikel_id),
	'S_NOTIFY'			=> $user_notify,
	'S_CAN_NOTIFY'		=> ($user->data['is_registered']) ? true : false)
);

// Start output of page
page_header($user->lang['REPORT_POST']);

$template->set_filenames(array(
	'body' => 'report_body.html')
);

page_footer();

?>
