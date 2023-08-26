<?php
/** 
*
* @author MarkDHamill (Mark D Hamill) mark@phpbbservices.com
* @version $Id digests_install.php 2.2.27 2016-02-19 00:00:00GMT MarkDHamill $
* @copyright (c) 2016 Mark D. Hamill
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/

// Written by Mark D. Hamill, mark@phpbbservices.com, http://phpbbservices.com
// This software is designed to work with phpBB Version 3.0.14.

// This is the e-mailing software for the Digests mod. It sends out daily, weekly or monthly
// digests based on settings created by users in the user control panel and stored in the
// phpbb_users table. It must be called hourly by the operating system.

define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_messenger.' . $phpEx); // Used to send emails

// Start session management.
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('mods/ucp_digests','acp/common','ucp'));	// Get language files needed

// If the board is currently disabled, digests should also be disabled too, don't ya think?
if ($config['board_disable'])
{
	write_log_entry('LOG_CONFIG_DIGEST_BOARD_DISABLED');
	garbage_collection();
	exit_handler();
}

// If the digest mod is currently disabled, digests should not go out
if (!$config['digests_enabled'])
{
	write_log_entry('LOG_CONFIG_DIGEST_NOT_ENABLED');
	garbage_collection();
	exit_handler();
}

// If the key parameter is enabled, validate the key parameter. If the parameter value does not match its required key, exit with an error.
if ($config['digests_require_key'])
{
	$supplied_key = request_var('key','NONE');
	if (trim($supplied_key) != trim($config['digests_key_value']))
	{
		write_log_entry('LOG_CONFIG_DIGEST_BAD_KEY_VALUE', $supplied_key);
		garbage_collection();
		exit_handler();
	}
}

// Look for special parameters that allow digests to be created after the fact. If used, date and hour parameters must be specified.

$run_date = request_var('date','NONE');
$run_hour = request_var('hour','NONE');
$irregular_run = false;

if (($run_date !== 'NONE') || ($run_hour !== 'NONE'))
{
	if (($run_date !== 'NONE') && ($run_hour !== 'NONE'))
	{
		// Test for a valid ISO-8601 date
		$date_parts = explode('-',$run_date);
		// Now test for a valid Gregorian date
		if (checkdate($date_parts[1],$date_parts[2],$date_parts[0]))
		{
			// Date is valid, check if hour is valid
			if (is_numeric($run_hour) && !is_float($run_hour) && $run_hour >= 0 && $run_hour < 24)
			{
				$irregular_run = true;
			}
			else
			{
				// Write message that hour is invalid
				write_log_entry('LOG_CONFIG_DIGEST_BAD_HOUR_PARAM', $run_hour);
				garbage_collection();
				exit_handler();
			}
		}
		else
		{
			// Write message that date is invalid
			write_log_entry('LOG_CONFIG_DIGEST_BAD_DATE_PARAM', $run_date);
			garbage_collection();
			exit_handler();
		}
	}
	else
	{
		// Both date and hour must be specified as parameters. If only one is present, issue an error message
		write_log_entry('LOG_CONFIG_DIGEST_NEED_TWO_PARAMS');
		garbage_collection();
		exit_handler();
	}
}

$digests_sent = 0;

// Set an indefinite execution time for this program, since we don't know how many digests
// must be processed for a particular hour or how long it may take. The set_time_limit function
// only works if PHP's safe mode is off.
set_time_limit(0);

// Display a digest mail start processing message. It may get captured in a log.
write_log_entry('LOG_CONFIG_DIGEST_LOG_START');

// Need a board URL since URLs in the digest pointing to the board need to be absolute URLs
$board_url = generate_board_url() . '/';

if ($irregular_run)
{
	$time = mktime($run_hour, 0, 0, $date_parts[1], $date_parts[2], $date_parts[0]);
}
else
{
	$time = time();
}

$server_timezone = floatval(date('O')/100);

$gmt_time = $time - ($server_timezone * 60 * 60);	// Convert server time into GMT time

// Get the current hour in GMT, so applicable digests can be sent out for this hour
$current_hour_gmt = date('G', $gmt_time); // 0 thru 23
$current_hour_gmt_plus_30 = date('G', $gmt_time) + .5;
if ($current_hour_gmt_plus_30 >= 24)
{
	$current_hour_gmt_plus_30 = $current_hour_gmt_plus_30 - 24;	// A very unlikely situation
}

// Create SQL fragment to fetch users wanting a daily digest
$daily_digest_sql = '(' . $db->sql_in_set('user_digest_type', array(DIGEST_DAILY_VALUE)) . ')';

// Create SQL fragment to also fetch users wanting a weekly digest, if today is the day weekly digests should go out
$weekly_digest_sql = (date('w', $gmt_time) == $config['digests_weekly_digest_day']) ? ' OR (' . $db->sql_in_set('user_digest_type', array(DIGEST_WEEKLY_VALUE)) . ')': '';

// Create SQL fragment to also fetch users wanting a monthly digest. This only happens if the current GMT day is the first of the month.
$gmt_year = (int) date('Y', $gmt_time);
$gmt_month = (int) date('n', $gmt_time);
$gmt_day = (int) date('j', $gmt_time);
$gmt_hour = (int) date('G', $gmt_time);

if ($gmt_day == 1) // Since it's the first day of the month in GMT, monthly digests are run too
{
	
	if ($gmt_month == 1)	// If January, the monthly digests are for December of the previous year
	{
		$gmt_month = 12;
		$gmt_year--;
	}
	else
	{
		$gmt_month--;	// Otherwise monthly digests are run for the previous month for the year
	}
	
	$gmt_month_last_day = date('t', mktime(0, 0, 0, $gmt_month, $gmt_day, $gmt_year));
	$gmt_month_1st_begin = mktime(0, 0, 0, $gmt_month, $gmt_day, $gmt_year);
	$gmt_month_lastday_end = mktime(23, 59, 59, $gmt_month, $gmt_month_last_day, $gmt_year);
	$monthly_digest_sql = ' OR (' . $db->sql_in_set('user_digest_type', array(DIGEST_MONTHLY_VALUE)) . ')';
}
else
{
	$monthly_digest_sql = '';
}

// We need to know which auth_option_id corresponds to the forum read privilege (f_read) and forum list (f_list) privilege. Why not use $auth->acl_get?
// Because this is sort of a "command line" program that sends digests for multiple users, so forum authentication will need to be done outside of the 
// regular authentication mechanism, which assumes an individual is logged in.
$auth_options = array('f_read', 'f_list');
$sql = 'SELECT auth_option, auth_option_id
		FROM ' . ACL_OPTIONS_TABLE . '
		WHERE ' . $db->sql_in_set('auth_option', $auth_options);
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result))
{
	if ($row['auth_option'] == 'f_read')
	{
		$read_id = $row['auth_option_id'];
	}
	if ($row['auth_option'] == 'f_list')
	{
		$list_id = $row['auth_option_id'];
	}
}
$db->sql_freeresult($result); // Query be gone!

// Get users requesting digests for the current hour. Also, grab the user's style, so the digest will have a familiar look.
if ($config['override_user_style'])
{
	$sql = 'SELECT u.*, s.* 
		FROM ' . USERS_TABLE . ' u, ' . STYLES_TABLE . ' s
		WHERE s.style_id = ' . $config['default_style'] . ' AND (' . 
			$daily_digest_sql . $weekly_digest_sql . $monthly_digest_sql . 
			") AND (user_digest_send_hour_gmt = $current_hour_gmt OR user_digest_send_hour_gmt = $current_hour_gmt_plus_30) 
			AND user_inactive_reason = 0
			AND user_digest_type <> '" . DIGEST_NONE_VALUE . 
			"' ORDER BY user_lang";
}
else
{
	$sql = 'SELECT u.*, s.* 
		FROM ' . USERS_TABLE . ' u, ' . STYLES_TABLE . ' s
		WHERE u.user_style = s.style_id AND (' . 
			$daily_digest_sql . $weekly_digest_sql . $monthly_digest_sql . 
			") AND (user_digest_send_hour_gmt = $current_hour_gmt OR user_digest_send_hour_gmt = $current_hour_gmt_plus_30) 
			AND user_inactive_reason = 0
			AND user_digest_type <> '" . DIGEST_NONE_VALUE . 
			"' ORDER BY user_lang";
}

if ($config['digests_override_queue'])
{
	$use_mail_queue = false;
}
else
{
	$use_mail_queue = ($config['email_package_size'] > 0) ? true : false;
}

$messenger = new messenger($use_mail_queue);
	
$result = $db->sql_query($sql);

$rowset = $db->sql_fetchrowset($result);	// Gets users receiving digests for this hour

// Fetch all the posts (no private messages) but do it just once for efficiency. These will be filtered later 
// to remove those posts a particular user should not see.

// First, determine a maximum date range fetched: daily, weekly or monthly
if ($monthly_digest_sql <> '')
{
	// In the case of monthly digests, it's important to include posts that support daily and weekly digests as well, hence dates of posts
	// retrieved may exceed post dates for the previous month. Logic to exclude posts past the end of the previous month in the case of 
	// monthly digests must be handled in the create_content function to skip these.
	$date_limit_sql = ' AND p.post_time >= ' . $gmt_month_1st_begin . ' AND p.post_time <= ' . max($gmt_month_lastday_end, $gmt_time);
}
else if ($weekly_digest_sql <> '')	// Weekly
{
	$date_limit = $time - (7 * 24 * 60 * 60);
	$date_limit_sql = ' AND p.post_time >= ' . $date_limit . ' AND p.post_time < ' . $time;
}
else	// Daily
{
	$date_limit = $time - (24 * 60 * 60);
	$date_limit_sql = ' AND p.post_time >= ' . $date_limit. ' AND p.post_time < ' . $time;
}

// Now get all potential posts for all users and place them in an array for parsing

// Prepare SQL
$sql_array = array(
	'SELECT'	=> 'f.*, t.*, p.*, u.*',

	'FROM'		=> array(
		POSTS_TABLE => 'p',
		USERS_TABLE => 'u',
		TOPICS_TABLE => 't',
		FORUMS_TABLE => 'f'),

	'WHERE'		=> "f.forum_id = t.forum_id
				AND p.topic_id = t.topic_id 
				AND t.forum_id = f.forum_id
				AND p.poster_id = u.user_id
				$date_limit_sql
				AND p.post_approved = 1",

	'ORDER_BY'	=> 'f.left_id, f.right_id'
);

// Build query
$sql_posts = $db->sql_build_query('SELECT', $sql_array);

// Execute the SQL to retrieve the relevant posts. Note, if $config['digests_max_items'] == 0 then there is no limit on the rows returned
$result_posts = $db->sql_query_limit($sql_posts, $config['digests_max_items']); 
$rowset_posts = $db->sql_fetchrowset($result_posts); // Get all the posts as a set

// Now that we have all the posts, time to send one digests at a time

foreach ($rowset as $row)
{

	// Each traverse through this loop sends out exactly one digest
	
	$toc = array();			// Create a variable to contain table of contents information
	$toc_post_count = 0; 	// # of posts in the table of contents
	$toc_pm_count = 0; 		// # of private messages in the table of contents

	// Set the text showing the digest type
	switch ($row['user_digest_type'])
	{
		case DIGEST_DAILY_VALUE:
			$digest_type = $user->lang['DIGEST_DAILY'];
		break;
		
		case DIGEST_WEEKLY_VALUE:
			$digest_type = $user->lang['DIGEST_WEEKLY'];
		break;
		
		case DIGEST_MONTHLY_VALUE:
			$digest_type = $user->lang['DIGEST_MONTHLY'];
		break;
		
		default:
			write_log_entry('LOG_CONFIG_DIGEST_BAD_DIGEST_TYPE', $row['user_digest_type']);
			write_log_entry('LOG_CONFIG_DIGEST_LOG_END');
			garbage_collection();
			exit_handler();
		break;
	}
		
	$email_subject = sprintf($user->lang['DIGEST_SUBJECT_TITLE'], $config['sitename'], $digest_type);

	// Set various variables and flags based on the requested digest format
	switch($row['user_digest_format'])
	{
	
		case DIGEST_TEXT_VALUE:
			$format = $user->lang['DIGEST_FORMAT_TEXT'];
			$messenger->template('digests_text'); // Change based on whether text, plain HTML or expanded HTML
			$is_html = false;
			$disclaimer = strip_tags(sprintf($user->lang['DIGEST_DISCLAIMER'], $board_url, $config['sitename'], $board_url, $phpEx, $config['board_contact'], $config['sitename']));
			$powered_by = $config['digests_digests_title'];
			$use_classic_template = false;
		break;
		
		case DIGEST_PLAIN_VALUE:
			$format = $user->lang['DIGEST_FORMAT_PLAIN'];
			$messenger->template('digests_plain_html'); // Change based on whether text, plain HTML or expanded HTML
			$is_html = true;
			$disclaimer = sprintf($user->lang['DIGEST_DISCLAIMER'], $board_url, $config['sitename'], $board_url, $phpEx, $config['board_contact'], $config['sitename']);
			$powered_by = sprintf("<a href=\"%s\">%s</a>",$config['digests_page_url'],$config['digests_digests_title']);
			$use_classic_template = false;
		break;
		
		case DIGEST_PLAIN_CLASSIC_VALUE:
			$format = $user->lang['DIGEST_FORMAT_PLAIN_CLASSIC'];
			$messenger->template('digests_plain_html'); // Change based on whether text, plain HTML or expanded HTML
			$is_html = true;
			$disclaimer = sprintf($user->lang['DIGEST_DISCLAIMER'], $board_url, $config['sitename'], $board_url, $phpEx, $config['board_contact'], $config['sitename']);
			$powered_by = sprintf("<a href=\"%s\">%s</a>",$config['digests_page_url'],$config['digests_digests_title']);
			$use_classic_template = true;
		break;
		
		case DIGEST_HTML_VALUE:
			$format = $user->lang['DIGEST_FORMAT_HTML'];
			$messenger->template('digests_html'); // Change based on whether text, plain HTML or expanded HTML
			$is_html = true;
			$disclaimer = sprintf($user->lang['DIGEST_DISCLAIMER'], $board_url, $config['sitename'], $board_url, $phpEx, $config['board_contact'], $config['sitename']);
			$powered_by = sprintf("<a href=\"%s\">%s</a>",$config['digests_page_url'],$config['digests_digests_title']);
			$use_classic_template = false;
		break;
		
		case DIGEST_HTML_CLASSIC_VALUE:
			$format = $user->lang['DIGEST_FORMAT_HTML_CLASSIC'];
			$messenger->template('digests_html'); // Change based on whether text, plain HTML or expanded HTML
			$is_html = true;
			$disclaimer = sprintf($user->lang['DIGEST_DISCLAIMER'], $board_url, $config['sitename'], $board_url, $phpEx, $config['board_contact'], $config['sitename']);
			$powered_by = sprintf("<a href=\"%s\">%s</a>",$config['digests_page_url'],$config['digests_digests_title']);
			$use_classic_template = true;
		break;
		
		default:
			write_log_entry('DIGEST_FORMAT_ERROR', $row['user_digest_format']);
			write_log_entry('LOG_CONFIG_DIGEST_LOG_END');
			garbage_collection();
			exit_handler();
		break;
		
	}
	
	// Set email header information
	$from_field_email = (isset($config['digests_from_email_address']) && (strlen($config['digests_from_email_address']) > 0)) ? $config['digests_from_email_address'] : $config['board_email'];
	$from_field_name = (isset($config['digests_from_email_name']) && (strlen($config['digests_from_email_name']) > 0)) ? $config['digests_from_email_name'] : $config['sitename'] . ' ' . $user->lang['DIGEST_ROBOT'];
	$reply_to_field_email = (isset($config['digests_reply_to_email_address']) && (strlen($config['digests_reply_to_email_address']) > 0)) ? $config['digests_reply_to_email_address'] : $config['board_email'];

	$messenger->to($row['user_email']);	
	
	// SMTP delivery must strip text names due to likely bug in messenger class
	if ($config['smtp_delivery'])
	{
		$messenger->from($from_field_email);
	}
	else
	{	
		$messenger->from($from_field_name . ' <' . $from_field_email . '>');
	}
	$messenger->replyto($reply_to_field_email);
	$messenger->subject($email_subject);
	
	// Transform user_digest_send_hour_gmt to local time
	$local_send_hour = $row['user_digest_send_hour_gmt'] + ($row['user_timezone'] + $row['user_dst']);
	if ($local_send_hour >= 24)
	{
		$local_send_hour = $local_send_hour - 24;
	}
	else if ($local_send_hour < 0)
	{
		$local_send_hour = $local_send_hour + 24;
	}
	
	if (($local_send_hour >= 24) || ($local_send_hour < 0))
	{
		write_log_entry('DIGEST_BAD_SEND_HOUR', $row['username'], $row['user_digest_send_hour_gmt']);
		write_log_entry('LOG_CONFIG_DIGEST_LOG_END');
		garbage_collection();
		exit_handler();
	}
	
	// Change the filter type into something human readable
	switch($row['user_digest_filter_type'])
	{
	
		case DIGEST_ALL:
			$post_types = $user->lang['DIGEST_POSTS_TYPE_ANY'];
		break;
		
		case DIGEST_FIRST:
			$post_types = $user->lang['DIGEST_POSTS_TYPE_FIRST'];
		break;
		
		case DIGEST_BOOKMARKS:
			$post_types = $user->lang['DIGEST_USE_BOOKMARKS'];
		break;
		
		default:
			write_log_entry('DIGESTS_FILTER_ERROR', $row['user_digest_filter_type']);
			write_log_entry('LOG_CONFIG_DIGEST_LOG_END');
			garbage_collection();
			exit_handler();
			
	}
	
	// Change the sort by into something human readable
	switch ($row['user_digest_sortby'])
	{
	
		case DIGEST_SORTBY_BOARD:
			$sort_by = $user->lang['DIGEST_SORT_USER_ORDER'];
		break;
			
		case DIGEST_SORTBY_STANDARD:
			$sort_by = $user->lang['DIGEST_SORT_FORUM_TOPIC'];
		break;
			
		case DIGEST_SORTBY_STANDARD_DESC:
			$sort_by = $user->lang['DIGEST_SORT_FORUM_TOPIC_DESC'];
		break;
			
		case DIGEST_SORTBY_POSTDATE:
			$sort_by = $user->lang['DIGEST_SORT_POST_DATE'];
		break;
			
		case DIGEST_SORTBY_POSTDATE_DESC:
			$sort_by = $user->lang['DIGEST_SORT_POST_DATE_DESC'];
		break;
			
		default:
			write_log_entry('DIGESTS_SORT_BY_ERROR', $row['user_digest_sortby']);
			write_log_entry('LOG_CONFIG_DIGEST_LOG_END');
			garbage_collection();
			exit_handler();
			
	}
	
	// Send a proper content-language to the output
	$user_lang = $row['user_lang'];
	if (strpos($user_lang, '-x-') !== false)
	{
		$user_lang = substr($user_lang, 0, strpos($user_lang, '-x-'));
	}
	
	// Create proper message for indicating number of posts allowed in digest
	if (($row['user_digest_max_posts'] == 0) && ($config['digests_max_items'] == 0))
	{
		$max_posts = 0;	// 0 means no limit
		$max_posts_msg = $user->lang['DIGEST_NO_LIMIT'];
	}
	else if (($config['digests_max_items'] != 0) && $config['digests_max_items'] < $row['user_digest_max_posts'])
	{
		$max_posts = (int) $row['digests_max_items'];
		$max_posts_msg = sprintf($user->lang['DIGEST_BOARD_LIMIT'], $config['digests_max_items']);
	}
	else
	{
		$max_posts = (int) $row['user_digest_max_posts'];
		$max_posts_msg = $row['user_digest_max_posts'];
	}

	$recipient_time = $gmt_time + (($row['user_timezone'] + $row['user_dst']) * 60 * 60);

	// Print the non-post and non-private message information in the digest. The actual posts and private messages require the full templating system, 
	// because the messenger class is too dumb to do more than basic templating. Note: most language variables are handled automatically by the template system.
	
	$messenger->assign_vars(array(
		'DIGEST_BLOCK_IMAGES'			=> ($row['user_digest_block_images'] == 0) ? $user->lang['NO'] : $user->lang['YES'],
		'DIGEST_COUNT_LIMIT'			=> $max_posts_msg,
		'DIGEST_DISCLAIMER'				=> $disclaimer,
		'DIGEST_FILTER_FOES'			=> ($row['user_digest_remove_foes'] == 0) ? $user->lang['NO'] : $user->lang['YES'],
		'DIGEST_FILTER_TYPE'			=> $post_types,
		'DIGEST_FORMAT_FOOTER'			=> $format,
		'DIGEST_LASTVISIT_RESET'		=> ($row['user_digest_reset_lastvisit'] == 0) ? $user->lang['NO'] : $user->lang['YES'],
		'DIGEST_MAIL_FREQUENCY'			=> $digest_type,
		'DIGEST_MAX_SIZE'				=> ($row['user_digest_max_display_words'] == 0) ? $user->lang['DIGEST_NO_POST_TEXT'] : (($row['user_digest_max_display_words'] == -1) ?  $user->lang['DIGEST_NO_LIMIT'] : $row['user_digest_max_display_words']),
		'DIGEST_MIN_SIZE'				=> ($row['user_digest_min_words'] == 0) ? $user->lang['DIGEST_NO_CONSTRAINT'] : $row['user_digest_min_words'],
		'DIGEST_NO_POST_TEXT'			=> ($row['user_digest_no_post_text'] == 1) ? $user->lang['YES'] : $user->lang['NO'],
		'DIGEST_POWERED_BY'				=> $powered_by,
		'DIGEST_REMOVE_YOURS'			=> ($row['user_digest_show_mine'] == 0) ? $user->lang['YES'] : $user->lang['NO'],
		'DIGEST_SALUTATION'				=> $row['username'],
		'DIGEST_SEND_HOUR'				=> make_hour_string($local_send_hour, $row['user_dateformat']),
		'DIGEST_SEND_IF_NO_NEW_MESSAGES'=> ($row['user_digest_send_on_no_posts'] == 0) ? $user->lang['NO'] : $user->lang['YES'],
		'DIGEST_SHOW_ATTACHMENTS'		=> ($row['user_digest_attachments'] == 0) ? $user->lang['NO'] : $user->lang['YES'],
		'DIGEST_SHOW_NEW_POSTS_ONLY'	=> ($row['user_digest_new_posts_only'] == 1) ? $user->lang['YES'] : $user->lang['NO'],
		'DIGEST_SHOW_PMS'				=> ($row['user_digest_show_pms'] == 0) ? $user->lang['NO'] : $user->lang['YES'],
		'DIGEST_SORT_BY'				=> $sort_by,
		'DIGEST_TOC_YES_NO'				=> ($row['user_digest_toc'] == 0) ? $user->lang['NO'] : $user->lang['YES'],
		'DIGEST_VERSION'				=> $config['digests_version'],
		'L_DIGEST_INTRODUCTION'			=> sprintf($user->lang['DIGEST_INTRODUCTION'], $config['sitename']),
		'L_DIGEST_PUBLISH_DATE'			=> sprintf($user->lang['DIGEST_PUBLISH_DATE'], $row['username'], date(str_replace('|','',$row['user_dateformat']), $recipient_time)),
		'L_DIGEST_TITLE'				=> $email_subject,
		'L_DIGEST_YOUR_DIGEST_OPTIONS'	=> sprintf($user->lang['DIGEST_YOUR_DIGEST_OPTIONS'], $row['username']),
		'S_CONTENT_DIRECTION'			=> $user->lang['DIRECTION'],
		'S_USER_LANG'					=> $user_lang,
		'T_STYLESHEET_LINK'				=> ($config['digests_enable_custom_stylesheets']) ? "{$board_url}styles/" . $config['digests_custom_stylesheet_path'] : "{$board_url}styles/" . $row['style_name'] . '/theme/stylesheet.css',
		'T_THEME_PATH'					=> "{$board_url}styles/" . $row['style_name'] . '/theme',
	));
	
	// Get any private messages for this user
	
	$digest_exception = false;

	if ($row['user_digest_show_pms'])
	{
	
		// If there are any unread private messages, they are fetched separately and passed as a rowset to create_content.
		$pm_sql = 	'SELECT *
					FROM ' . PRIVMSGS_TO_TABLE . ' pt, ' . PRIVMSGS_TABLE . ' pm, ' . USERS_TABLE . ' u
					WHERE pt.msg_id = pm.msg_id
						AND pt.author_id = u.user_id
						AND pt.user_id = ' . $row['user_id'] . '
						AND (pm_unread = 1 OR pm_new = 1)
					ORDER BY message_time';
		$pm_result = $db->sql_query($pm_sql);
		$pm_rowset = $db->sql_fetchrowset($pm_result);
		$db->sql_freeresult();
		
		// Count # of unread and new for this user. Counts may need to be decremented later.
		$total_pm_unread = 0;
		$total_pm_new = 0;
		
		foreach ($pm_rowset as $pm_row)
		{
			if ($pm_row['pm_unread'] == 1)
			{
				$total_pm_unread++;
			}
			if ($pm_row['pm_new'] == 1)
			{
				$total_pm_new++;
			}
		}
		
	}
	else
	{
		// Avoid some PHP Notices...
		$pm_result = NULL;
		$pm_rowset = NULL;
	}

	$requested_forums_names = array();	// Create here so it can be used as a global variable in create_content
	
	// Construct the body of the digest. We use the templating system because of the advanced features missing in the 
	// email templating system, e.g. loops and switches. Note, create_content may set the flag $digest_exception.
	$digest_content = create_content($rowset_posts, $pm_rowset, $row);
	
	// List the subscribed forums, if any
	if ($row['user_digest_filter_type'] == DIGEST_BOOKMARKS)
	{
		$subscribed_forums = $user->lang['DIGEST_USE_BOOKMARKS'];
	}
	else if (sizeof($requested_forums_names) > 0)
	{
		$subscribed_forums = implode(', ', $requested_forums_names);
	}
	else
	{
		// Show that all forums were selected
		$subscribed_forums = $user->lang['DIGEST_ALL_FORUMS'];
	}
			
	// Assemble a digest table of contents
	if ($row['user_digest_toc'] == 1)
	{
	
		// Create Table of Contents header for private messages
		if ($is_html)
		{
			// For HTML digests, the table of contents always appears in a HTML table
			$digest_toc = "<h2 style=\"color:#000000\">" . $user->lang['DIGEST_TOC'] . "</h2>\n";
			$digest_toc .= "<p><a href=\"#skip\">" . $user->lang['DIGEST_SKIP'] . "</a></p>\n";
		}
		else
		{
			$digest_toc = "____________________________________________________________\n\n" . $user->lang['DIGEST_TOC'] . "\n";
		}
		
		if ($row['user_digest_show_pms'] == 1)
		{
			
			// Heading for table of contents
			if ($is_html)
			{
				$digest_toc .= sprintf("<div class=\"content\"><table border=\"1\">\n<tbody>\n<tr>\n<th id=\"j1\">%s</th><th id=\"j2\">%s</th><th id=\"j3\">%s</th><th id=\"j4\">%s</th>\n</tr>\n",
					$user->lang['DIGEST_JUMP_TO'] , ucwords($user->lang['PRIVATE_MESSAGE'] . ' ' . $user->lang['SUBJECT']), $user->lang['DIGEST_SENDER'], $user->lang['DIGEST_DATE']); 
			}
			
			// Add a table row for each private message
			if ($toc_pm_count > 0)
			{
				for ($i=0; $i <= $toc_pm_count; $i++)
				{
					if ($is_html)
					{
						$digest_toc .= (isset($toc['pms'][$i])) ? "<tr>\n<td headers=\"j1\" style=\"text-align: right;\"><a href=\"#m" . $toc['pms'][$i]['message_id'] . '">' . $toc['pms'][$i]['message_id'] . '</a></td><td headers="j2">' . $toc['pms'][$i]['message_subject'] . '</td><td headers="j3">' . $toc['pms'][$i]['author'] . '</td><td headers="j4">' . $toc['pms'][$i]['datetime'] . "</td>\n</tr>\n" : '';
					}
					else
					{
						$digest_toc .= (isset($toc['pms'][$i])) ? $toc['pms'][$i]['author'] . ' ' . $user->lang['DIGEST_SENT_YOU_A_MESSAGE'] . ' ' . $user->lang['DIGEST_OPEN_QUOTE'] . $toc['pms'][$i]['message_subject'] . $user->lang['DIGEST_CLOSED_QUOTE'] . ' ' . $user->lang['DIGEST_ON'] . ' ' . $toc['pms'][$i]['datetime'] . "\n" : '';
					}
				}
			}
			else
			{
				$digest_toc .= ($is_html) ? '<tr><td colspan="4">' . $user->lang['DIGEST_NO_PRIVATE_MESSAGES'] . "</td></tr>" : $digest_toc = $user->lang['DIGEST_NO_PRIVATE_MESSAGES'];
			}
	
			// Create Table of Contents footer for private messages
			$digest_toc .= ($is_html) ? "</tbody></table>\n<br />" : "\n\n"; 
		
		}
		else
		{
			$digest_toc = null;	// Avoid a PHP Notice
		}
		
		// Create Table of Contents header for posts
		if ($is_html)
		{
			// For HTML digests, the table of contents always appears in a HTML table
			$digest_toc .= sprintf("<table border=\"1\">\n<tbody>\n<tr>\n<th id=\"h1\">%s</th><th id=\"h2\">%s</th><th id=\"h3\">%s</th><th id=\"h4\">%s</th><th id=\"h5\">%s</th>\n</tr>\n",
				$user->lang['DIGEST_JUMP_TO'] , $user->lang['FORUM'], $user->lang['TOPIC'], $user->lang['AUTHOR'], $user->lang['DIGEST_DATE']); 
		}
		
		// Add a table row for each post
		if ($toc_post_count > 0)
		{
			for ($i=0; $i <= $toc_post_count; $i++)
			{
				if ($is_html)
				{
					$digest_toc .= (isset($toc['posts'][$i])) ? "<tr>\n<td headers=\"h1\" style=\"text-align: right;\"><a href=\"#p" . $toc['posts'][$i]['post_id'] . '">' . $toc['posts'][$i]['post_id'] . '</a></td><td headers="h2">' . $toc['posts'][$i]['forum'] . '</td><td headers="h3">' . $toc['posts'][$i]['topic'] . '</td><td headers="h4">' . $toc['posts'][$i]['author'] . '</td><td headers="h5">' . $toc['posts'][$i]['datetime'] . "</td>\n</tr>\n" : '';
				}
				else
				{
					$digest_toc .= (isset($toc['posts'][$i])) ? $toc['posts'][$i]['author'] . ' ' . $user->lang['DIGEST_POSTED_TO_THE_TOPIC'] . ' ' . $user->lang['DIGEST_OPEN_QUOTE'] . $toc['posts'][$i]['topic'] . $user->lang['DIGEST_CLOSED_QUOTE'] . ' ' . $user->lang['IN'] . ' ' . $user->lang['DIGEST_OPEN_QUOTE'] . $toc['posts'][$i]['forum'] . $user->lang['DIGEST_CLOSED_QUOTE'] . ' ' . $user->lang['DIGEST_ON'] . ' ' . $toc['posts'][$i]['datetime'] . "\n" : '';
				}
			}
		}
		else
		{
			$digest_toc = ($is_html) ? '<tr><td colspan="5">' . $user->lang['DIGEST_NO_POSTS'] . "</td></tr>" : $user->lang['DIGEST_NO_POSTS'];
		}
		
		// Create Table of Contents footer
		$digest_toc .= ($is_html) ? "</tbody>\n</table></div>\n<br />" : "\n\n"; 
	
		// Publish the table of contents
		$messenger->assign_vars(array(
			'DIGEST_TOC'			=> $digest_toc,	
		));
	
	}
	else
	{
		$digest_toc = null;	// Avoid a PHP Notice
	}
	
	if (!$is_html)
	{
		// This reduces extra lines in the text digests. Apparently the phpBB template engine leaves
		// blank lines where a template contains templates commands.
		$digest_content = str_replace("\n\n", "\n", $digest_content);
	}

	// Publish the digest content, marshaled elsewhere
	$messenger->assign_vars(array(
		'DIGEST_CONTENT'			=> $digest_content,	
		'DIGEST_FORUMS_WANTED'		=> $subscribed_forums,	
	));
	
	// Mark private messages in the digest as read, if so instructed
	if ((sizeof($pm_rowset) != 0) && ($row['user_digest_show_pms'] == 1) && ($row['user_digest_pm_mark_read'] == 1))
	{
		$pm_read_sql = 'UPDATE ' . PRIVMSGS_TO_TABLE . '
			SET pm_new = 0, pm_unread = 0, folder_id = 0 
			WHERE user_id = ' . $row['user_id'] . '
				AND (pm_unread = 1 OR pm_new = 1)';
		$pm_read_sql_result = $db->sql_query($pm_read_sql);
		$db->sql_freeresult($pm_read_sql_result);

		// Decrement the user_unread_privmsg and user_new_privmsg count
		$pm_read_sql = 'UPDATE ' . USERS_TABLE . ' 
			SET user_unread_privmsg = user_unread_privmsg - ' . $total_pm_unread . ',
				user_new_privmsg = user_new_privmsg - ' . $total_pm_new . '
			WHERE user_id = ' . $row['user_id'];
		$db->sql_query($pm_read_sql);
	}
		 
	$db->sql_freeresult($result_posts);
	$db->sql_freeresult($pm_result);

	// Send the digest out only if there are new qualifying posts or the user requests a digest to be sent if there are no posts OR
	// if there are unread private messages, the user wants to see private messages in the digest.
	if (!$digest_exception)
	{
		if ($row['user_digest_send_on_no_posts'] || $toc_post_count > 0 || ((sizeof($pm_rowset) > 0) && $row['user_digest_show_pms']))
		{
			
			$mail_sent = $messenger->send(NOTIFY_EMAIL, false, $is_html, true);
			$posts_in_digest = min($posts_in_digest, $row['user_digest_max_posts']);

			if (!$mail_sent)
			{
				if ($config['digests_show_email'])
				{
					write_log_entry('LOG_CONFIG_DIGEST_LOG_ENTRY_BAD', $row['username'], $row['user_email']);
				}
				else
				{
					write_log_entry('LOG_CONFIG_DIGEST_LOG_ENTRY_BAD_NO_EMAIL', $row['username']);
				}
			}
			else
			{
				$sent_to_created_for = ($use_mail_queue) ? $user->lang['DIGEST_CREATED_FOR'] : $user->lang['DIGEST_SENT_TO'];
				if ($config['digests_show_email'])
				{
					write_log_entry('LOG_CONFIG_DIGEST_LOG_ENTRY_GOOD', $sent_to_created_for, $row['username'], $row['user_email'], $posts_in_digest, sizeof($pm_rowset));
				}
				else
				{
					write_log_entry('LOG_CONFIG_DIGEST_LOG_ENTRY_GOOD_NO_EMAIL', $sent_to_created_for, $row['username'], $posts_in_digest, sizeof($pm_rowset));
				}
				// Capture the fact that a digest should have been successfully sent
				$sql2 = 'UPDATE ' . USERS_TABLE . '
							SET user_digest_last_sent = ' . time() . ' 
							WHERE user_id = ' . $row['user_id'];
				$result2 = $db->sql_query($sql2);
				$digests_sent++;
			}
		}
		else
		{
			if ($config['digests_show_email'])
			{
				write_log_entry('LOG_CONFIG_DIGEST_LOG_ENTRY_NONE', $row['username'], $row['user_email']);
			}
			else
			{
				write_log_entry('LOG_CONFIG_DIGEST_LOG_ENTRY_NONE_NO_EMAIL', $row['username']);
			}
		}
	}

	// Reset messenger object, bug fix provided by robdocmagic
	$messenger->reset();
	// Reset the user's last visit date on the forum, if so requested
	if ($row['user_digest_reset_lastvisit'])
	{
		$sql2 = 'UPDATE ' . USERS_TABLE . '
					SET user_lastvisit = ' . $time . ' 
					WHERE user_id = ' . $row['user_id'];
		$result2 = $db->sql_query($sql2);
	}
	
	unset($toc); // So next user getting digests for this hour won't see duplicates

}

// It turns out it is much faster to mail digests in a batch compared to one at a time
// So using the queue makes sense, providing all items in the queue are mailed before the program
// ends. Otherwise digests may not be sent for the hour wanted.
if (($digests_sent > 0) && $use_mail_queue)
{
	$messenger->queue->save(); // Writes the queue to disk. Seems to be necessary
	$messenger->queue->process(true); // Send everything in the queue, even if it is over the limit.
	write_log_entry('LOG_CONFIG_DIGEST_LOG_EMAILED');
}

// All digests have been processed for this hour
$db->sql_freeresult($sql);

// Kill the session we consumed. We don't want to use session_kill() because it updates user_lastvisit,
// which we don't want to do. 
$sql = 'DELETE FROM ' . SESSIONS_TABLE . "
		WHERE session_id = '" . $db->sql_escape($user->session_id) . "'
			AND session_user_id = " . (int) $user->data['user_id'];
$db->sql_query($sql);

// Display a digest mail end processing message. It may get captured in a log
write_log_entry('LOG_CONFIG_DIGEST_LOG_END');

// Allow connection logout with external auth method logout
$method = basename(trim($config['auth_method']));
include_once($phpbb_root_path . 'includes/auth/auth_' . $method . '.' . $phpEx);
$method = 'logout_' . $method;
if (function_exists($method))
{
	$method($user->data, false); // Do not need a new session
}
garbage_collection();
exit_handler();


function create_content (&$rowset, &$pm_rowset, &$user_row)
{

	// This function creates the bulk of one digest, by marking up private messages and posts
	// as appropriate and passing it back to the calling program.
	
	global $user, $template, $board_url, $phpEx, $config, $is_html, $server_timezone, $use_classic_template, $db, $toc,
		$phpbb_root_path, $auth, $read_id, $date_limit, $digest_exception, $posts_in_digest, $toc_pm_count, $toc_post_count,
		$gmt_month_lastday_end, $time, $max_posts, $requested_forums_names;
		
	// Load the right template
	$mail_template = ($is_html) ? 'mail_digests_html.html' : 'mail_digests_text.html';
			
	$template->set_filenames(array(
	   'mail_digests'      => $mail_template,
	));
	
	$show_post_text = ($user_row['user_digest_no_post_text'] == 0);
	
	$posts_in_digest = 0;
	
	// Process private messages, if any, first since they appear before posts
	
	if ((sizeof($pm_rowset) != 0) && ($user_row['user_digest_show_pms'] == 1))
	{
	
		$template->assign_vars(array(
			'L_FROM'						=> ($is_html) ? $user->lang['FROM'] : ucfirst($user->lang['FROM']),
			'L_YOU_HAVE_PRIVATE_MESSAGES'	=> sprintf($user->lang['DIGEST_YOU_HAVE_PRIVATE_MESSAGES'], $user_row['username']),
			'S_SHOW_PMS'					=> true,
		));
		
		foreach ($pm_rowset as $pm_row)
		{
		
			// If there are inline attachments, remove them otherwise they will show up twice. Getting the styling right
			// in these cases is probably a lost cause due to the complexity to be addressed due to various styling issues.
			$pm_row['message_text'] = preg_replace('#\[attachment=.*?\].*?\[/attachment:.*?]#', '', censor_text($pm_row['message_text']));

			// Now adjust post time to digest recipient's local time
			$recipient_time = $pm_row['message_time'] - ($server_timezone * 60 * 60) + (($user_row['user_timezone'] + $user_row['user_dst']) * 60 * 60);

			// Add to table of contents array
			$toc['pms'][$toc_pm_count]['message_id'] = html_entity_decode($pm_row['msg_id']);
			$toc['pms'][$toc_pm_count]['message_subject'] = html_entity_decode(censor_text($pm_row['message_subject']));
			$toc['pms'][$toc_pm_count]['author'] = html_entity_decode($pm_row['username']);
			$toc['pms'][$toc_pm_count]['datetime'] = date(str_replace('|','',$user_row['user_dateformat']), $recipient_time);
			$toc_pm_count++;

			$flags = (($pm_row['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) +
				(($pm_row['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) + 
				(($pm_row['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
				
			$pm_text = generate_text_for_display(censor_text($pm_row['message_text']), $pm_row['bbcode_uid'], $pm_row['bbcode_bitfield'], $flags);
			
			// User signature wanted?
			$user_sig = ( $pm_row['enable_sig'] && $pm_row['user_sig'] != '' && $config['allow_sig'] ) ? censor_text($pm_row['user_sig']) : '';
			if ($user_sig != '')
			{
				// Format the signature for display
				$user_sig = generate_text_for_display(censor_text($user_sig), $rowset['user_sig_bbcode_uid'], $rowset['user_sig_bbcode_bitfield'], $flags);
			}
		
			// Handle logic to display attachments in private messages
			if ($pm_row['message_attachment'] > 0 && $user_row['user_digest_attachments'])
			{
				$pm_text .= sprintf("<div class=\"box\">\n<p>%s</p>\n", $user->lang['ATTACHMENTS']);
				
				// Get all attachments
				$sql3 = 'SELECT *
					FROM ' . ATTACHMENTS_TABLE . '
					WHERE post_msg_id = ' . $pm_row['msg_id'] . ' AND in_message = 1 
					ORDER BY attach_id';
				$result3 = $db->sql_query($sql3);
				while ($row3 = $db->sql_fetchrow($result3))
				{
					$file_size = round(($row3['filesize']/1024),2);
					// Show images, link to other attachments
					if (substr($row3['mimetype'],0,6) == 'image/')
					{
						$anchor_begin = '';
						$anchor_end = '';
						$pm_image_text = '';
						$thumbnail_parameter = '';
						$is_thumbnail = ($row3['thumbnail'] == 1) ? true : false;
						// Logic to resize the image, if needed
						if ($is_thumbnail)
						{
							$anchor_begin = sprintf("<a href=\"%s\">", $board_url . "download/file.$phpEx?id=" . $row3['attach_id']);
							$anchor_end = '</a>';
							$pm_image_text = $user->lang['DIGEST_POST_IMAGE_TEXT'];
							$thumbnail_parameter = '&t=1';
						}
						$pm_text .= sprintf("%s<br /><em>%s</em> (%s KiB)<br />%s<img src=\"%s\" alt=\"%s\" title=\"%s\" />%s\n<br />%s", censor_text($row3['attach_comment']), $row3['real_filename'], $file_size, $anchor_begin, $board_url . "download/file.$phpEx?id=" . $row3['attach_id'] . $thumbnail_parameter, censor_text($row3['attach_comment']), censor_text($row3['attach_comment']), $anchor_end, $pm_image_text);
					}
					else
					{
						$pm_text .= ($row3['attach_comment'] == '') ? '' : '<em>' . censor_text($row3['attach_comment']) . '</em><br />';
						$pm_text .= 
							sprintf("<img src=\"%s\" title=\"\" alt=\"\" /> ", 
								$board_url . 'styles/' . $user_row['style_name'] . '/imageset/icon_topic_attach.gif') .
							sprintf("<b><a href=\"%s\">%s</a></b> (%s KiB)<br />",
								$board_url . "download/file.$phpEx?id=" . $row3['attach_id'], 
								$row3['real_filename'], 
								$file_size);
					}
				}
				$db->sql_freeresult($result3);
				
				$pm_text .= '</div>';
							
			}
				
			// Add signature to bottom of private message
			$pm_text = ($user_sig != '') ? $pm_text . "\n" . $user->lang['DIGEST_POST_SIGNATURE_DELIMITER'] . "\n" . $user_sig : $pm_text . "\n";

			// If required or requested, remove all images
			if ($config['digests_block_images'] || $user_row['user_digest_block_images'])
			{
				$pm_text = preg_replace('<img.*?\/>', '', $pm_text);
			}
				
			// If a text digest is desired, this is a good point to strip tags, after first replacing <br /> with \n
			if (!$is_html)
			{
				$pm_text = str_replace('<br />', "\n\n", $pm_text);
				$pm_text = html_entity_decode(strip_tags($pm_text));
			}
			else
			{
				// Board URLs must be absolute in the digests, so substitute board URL for relative URL
				$pm_text = str_replace('<img src="' . $phpbb_root_path, '<img src="' . $board_url, $pm_text);
			} 

			$template->assign_block_vars('pm', array(
				'ANCHOR'					=> "<a name=\"m" . $pm_row['msg_id'] . "\"></a>",
				'CONTENT'					=> $pm_text,
				'DATE'						=> date(str_replace('|','',$pm_row['user_dateformat']), $recipient_time) . "\n",
				'FROM'						=> ($is_html) ? sprintf('<a href="%s?mode=viewprofile&amp;u=%s">%s</a>', $board_url . 'memberlist.' . $phpEx, $pm_row['author_id'], $pm_row['username']) : $pm_row['username'],
				'NEW_UNREAD'				=> ($pm_row['pm_new'] == 1) ? $user->lang['DIGEST_NEW'] . ' ' : $user->lang['DIGEST_UNREAD'] . ' ',
				'PRIVATE_MESSAGE_LINK'		=> ($is_html) ? sprintf('<a href="%s?i=pm&amp;mode=view&amp;f=0&amp;p=%s">%s</a>', $board_url . 'ucp.' . $phpEx, $pm_row['msg_id'], $pm_row['msg_id']) . "\n" : html_entity_decode(censor_text($pm_row['message_subject'])) . "\n",
				'PRIVATE_MESSAGE_SUBJECT'	=> ($is_html) ? sprintf('<a href="%s?i=pm&amp;mode=view&amp;f=0&amp;p=%s">%s</a>', $board_url . 'ucp.' . $phpEx, $pm_row['msg_id'], html_entity_decode(censor_text($pm_row['message_subject']))) . "\n" : html_entity_decode(censor_text($pm_row['message_subject'])) . "\n",
				'S_USE_CLASSIC_TEMPLATE'	=> $use_classic_template,
			));
		}

	}
	else
	{
		// Turn off switch that would indicate there are private messages
		$template->assign_vars(array(
			'S_SHOW_PMS'	=> false,
		));
	}
	
	// Process posts next
	
	$last_forum_id = -1;
	$last_topic_id = -1;

	if (sizeof($rowset) != 0)
	{
	
		unset($bookmarked_topics);
		unset($fetched_forums);
		
		// Determine bookmarked topics, if any
		if ($user_row['user_digest_filter_type'] == DIGEST_BOOKMARKS) // Bookmarked topics only
		{
		
			// When selecting bookmarked topics only, we can safely ignore the logic constraining the user to read only 
			// from certain forums. Instead we will create the SQL to get the bookmarked topics only.
			
			$bookmarked_topics = array();
			$sql3 = 'SELECT t.topic_id
				FROM ' . USERS_TABLE . ' u, ' . BOOKMARKS_TABLE . ' b, ' . TOPICS_TABLE . " t
				WHERE u.user_id = b.user_id AND b.topic_id = t.topic_id 
					AND b.user_id = " . $user_row['user_id'];
			$result3 = $db->sql_query($sql3);
			while ($row3 = $db->sql_fetchrow($result3))
			{
				$bookmarked_topics[] = intval($row3['topic_id']);
			}
			$db->sql_freeresult($result3);
			if (sizeof($bookmarked_topics) == 0)
			{
				// Logically, if there are no bookmarked topics for this user_id then there will be nothing in the digest.
				$digest_exception = true;
				write_log_entry('LOG_CONFIG_DIGEST_NO_BOOKMARKS', $user_row['username']);
				return;
			}
			
		}
		else
		{
			// Determine the forums allowed to read
			
			// Get forum read permissions for this user. They are also usually stored in the user_permissions column, but sometimes the field is empty. This always works.
			unset($allowed_forums);
			$allowed_forums = array();
			
			$forum_array = $auth->acl_raw_data_single_user($user_row['user_id']);
			foreach ($forum_array as $key => $value)
			{
				foreach ($value as $auth_option_id => $auth_setting)
				{
					if ($auth_option_id == $read_id)
					{
						if (($auth_setting == 1) && check_all_parents($forum_array, $key))
						{
							$allowed_forums[] = $key;
						}
					}
				}
			}
			
			if (sizeof($allowed_forums) == 0)
			{
				// If this user cannot retrieve ANY forums, no digest can be produced.
				$digest_exception = true;
				write_log_entry('LOG_CONFIG_DIGEST_NO_ALLOWED_FORUMS', $user_row['username']);
				return;
			}
			$allowed_forums[] = 0;	// Add in global announcements forum
	
			// Ensure there are no duplicates
			$allowed_forums = array_unique($allowed_forums);
			
			// Get the requested forums. If none are specified in the phpbb_digests_subscribed_forums table, then all allowed forums are assumed
			unset($requested_forums);
			$requested_forums = array();
			$requested_forums_names = array();
			
			$sql3 = 'SELECT s.forum_id, forum_name 
					FROM ' . DIGESTS_SUBSCRIBED_FORUMS_TABLE . ' s, ' . FORUMS_TABLE . ' f
					WHERE s.forum_id = f.forum_id AND user_id = ' . $user_row['user_id'];
					
			$result3 = $db->sql_query($sql3);
			while ($row3 = $db->sql_fetchrow($result3))
			{
				$requested_forums[] = $row3['forum_id'];
				$requested_forums_names[] = $row3['forum_name'];
			}
			$db->sql_freeresult($result3);
			
			// To capture global announcements when forums are specified, we have to add the pseudo-forum with a forum_id = 0.
			if (sizeof($requested_forums) > 0)
			{
				$requested_forums[] = 0;
			}
			
			// Ensure there are no duplicates
			$requested_forums = array_unique($requested_forums);
			
			// The forums that will be fetched is the array intersection of the requested and allowed forums. 
			$fetched_forums = (sizeof($requested_forums) > 0) ? array_intersect($allowed_forums, $requested_forums): $allowed_forums;
			asort($fetched_forums);
			if (sizeof($fetched_forums) == 0)
			{
				$digest_exception = true;
				write_log_entry('LOG_CONFIG_DIGEST_NO_ALLOWED_FORUMS', $user_row['username']);
				return;
			}
			
			// Add in any required forums
			$required_forums = (isset($config['digests_include_forums'])) ? explode(',',$config['digests_include_forums']) : array();
			if (sizeof($required_forums) > 0)
			{
				$fetched_forums = array_merge($fetched_forums, $required_forums);
			}
			
			// Remove any prohibited forums
			$excluded_forums = (isset($config['digests_exclude_forums'])) ? explode(',',$config['digests_exclude_forums']) : array();
			if (sizeof($excluded_forums) > 0)
			{
				$fetched_forums = array_diff($fetched_forums, $excluded_forums);
			}
			
			// Tidy up the forum list
			$fetched_forums = array_unique($fetched_forums);

		}
		
		// Sort posts by the user's preference.
		
		switch($user_row['user_digest_sortby'])
		{
		
			case DIGEST_SORTBY_BOARD:
			
				$topic_asc_desc = ($user_row['user_topic_sortby_dir'] == 'd') ? SORT_DESC : SORT_ASC;
				$post_asc_desc = ($user_row['user_post_sortby_dir'] == 'd') ? SORT_DESC : SORT_ASC;
				
				switch($user_row['user_topic_sortby_type'])
				
				{
					
					case 'a':
						// Sort by topic author
						foreach ($rowset as $key => $row)
						{
							$left_id[$key]  = $row['left_id'];
							$right_id[$key] = $row['right_id'];
							$topic_first_poster_name[$key] = $row['topic_first_poster_name'];
							switch($user_row['user_post_sortby_type'])
							{
								case 'a':
									$username_clean[$key] = $row['username_clean'];
								break;
								case 't':
									$post_time[$key] = $row['post_time'];
								break;
								case 's':
									$post_subject[$key] = censor_text($row['post_subject']);
								break;
							}
						}
						switch($user_row['user_post_sortby_type'])
						{
							case 'a':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_first_poster_name, $topic_asc_desc, $username_clean, $post_asc_desc, $rowset);
							break;
							case 't':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_first_poster_name, $topic_asc_desc, $post_time, $post_asc_desc, $rowset);
							break;
							case 's':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_first_poster_name, $topic_asc_desc, $post_subject, $post_asc_desc, $rowset);
							break;
						}
					break;
					
					case 't':
						// Sort by topic last post time
						foreach ($rowset as $key => $row)
						{
							$left_id[$key]  = $row['left_id'];
							$right_id[$key] = $row['right_id'];
							$topic_last_post_time[$key] = $row['topic_last_post_time'];
							switch($user_row['user_post_sortby_type'])
							{
								case 'a':
									$username_clean[$key] = $row['username_clean'];
								break;
								case 't':
									$post_time[$key] = $row['post_time'];
								break;
								case 's':
									$post_subject[$key] = censor_text($row['post_subject']);
								break;
							}
						}
						switch($user_row['user_post_sortby_type'])
						{
							case 'a':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_last_post_time, $topic_asc_desc, $username_clean, $post_asc_desc, $rowset);
							break;
							case 't':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_last_post_time, $topic_asc_desc, $post_time, $post_asc_desc, $rowset);
							break;
							case 's':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_last_post_time, $topic_asc_desc, $post_subject, $post_asc_desc, $rowset);
							break;
						}
					break;
					
					case 'r':
						// Sort by topic replies
						foreach ($rowset as $key => $row)
						{
							$left_id[$key]  = $row['left_id'];
							$right_id[$key] = $row['right_id'];
							$topic_replies[$key] = $row['topic_replies'];
							switch($user_row['user_post_sortby_type'])
							{
								case 'a':
									$username_clean[$key] = $row['username_clean'];
								break;
								case 't':
									$post_time[$key] = $row['post_time'];
								break;
								case 's':
									$post_subject[$key] = censor_text($row['post_subject']);
								break;
							}
						}
						switch($user_row['user_post_sortby_type'])
						{
							case 'a':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_replies, $topic_asc_desc, $username_clean, $post_asc_desc, $rowset);
							break;
							case 't':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_replies, $topic_asc_desc, $post_time, $post_asc_desc, $rowset);
							break;
							case 's':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_replies, $topic_asc_desc, $post_subject, $post_asc_desc, $rowset);
							break;
						}
					break;
					
					case 's':
						// Sort by topic title
						foreach ($rowset as $key => $row)
						{
							$left_id[$key]  = $row['left_id'];
							$right_id[$key] = $row['right_id'];
							$topic_title[$key] = censor_text($row['topic_title']);
							switch($user_row['user_post_sortby_type'])
							{
								case 'a':
									$username_clean[$key] = $row['username_clean'];
								break;
								case 't':
									$post_time[$key] = $row['post_time'];
								break;
								case 's':
									$post_subject[$key] = censor_text($row['post_subject']);
								break;
							}
						}
						switch($user_row['user_post_sortby_type'])
						{
							case 'a':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_title, $topic_asc_desc, $username_clean, $post_asc_desc, $rowset);
							break;
							case 't':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_title, $topic_asc_desc, $post_time, $post_asc_desc, $rowset);
							break;
							case 's':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_title, $topic_asc_desc, $post_subject, $post_asc_desc, $rowset);
							break;
						}
					break;
					
					case 'v':
						// Sort by topic views
						foreach ($rowset as $key => $row)
						{
							$left_id[$key]  = $row['left_id'];
							$right_id[$key] = $row['right_id'];
							$topic_views[$key] = $row['topic_views'];
							switch($user_row['user_post_sortby_type'])
							{
								case 'a':
									$username_clean[$key] = $row['username_clean'];
								break;
								case 't':
									$post_time[$key] = $row['post_time'];
								break;
								case 's':
									$post_subject[$key] = censor_text($row['post_subject']);
								break;
							}
						}
						switch($user_row['user_post_sortby_type'])
						{
							case 'a':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_views, $topic_asc_desc, $username_clean, $post_asc_desc, $rowset);
							break;
							case 't':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_views, $topic_asc_desc, $post_time, $post_asc_desc, $rowset);
							break;
							case 's':
								array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_views, $topic_asc_desc, $post_subject, $post_asc_desc, $rowset);
							break;
						}
					break;
					
				}
				
			break;
			
			case DIGEST_SORTBY_STANDARD:
				// Sort by traditional order
				foreach ($rowset as $key => $row)
				{
					$left_id[$key]  = $row['left_id'];
					$right_id[$key] = $row['right_id'];
					$topic_last_post_time[$key] = $row['topic_last_post_time'];
					$post_time[$key] = $row['post_time'];
				}
				array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_last_post_time, SORT_DESC, $post_time, SORT_ASC, $rowset);
			break;
			
			case DIGEST_SORTBY_STANDARD_DESC:
				// Sort by traditional order, newest post first
				foreach ($rowset as $key => $row)
				{
					$left_id[$key]  = $row['left_id'];
					$right_id[$key] = $row['right_id'];
					$topic_last_post_time[$key] = $row['topic_last_post_time'];
					$post_time[$key] = $row['post_time'];
				}
				array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $topic_last_post_time, SORT_DESC, $post_time, SORT_DESC, $rowset);
			break;
			
			case DIGEST_SORTBY_POSTDATE:
				// Sort by post date
				foreach ($rowset as $key => $row)
				{
					$left_id[$key]  = $row['left_id'];
					$right_id[$key] = $row['right_id'];
					$post_time[$key] = $row['post_time'];
				}
				array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $post_time, SORT_ASC, $rowset);
			break;
			
			case DIGEST_SORTBY_POSTDATE_DESC:
				// Sort by post date, newest first
				foreach ($rowset as $key => $row)
				{
					$left_id[$key]  = $row['left_id'];
					$right_id[$key] = $row['right_id'];
					$post_time[$key] = $row['post_time'];
				}
				array_multisort($left_id, SORT_ASC, $right_id, SORT_ASC, $post_time, SORT_DESC, $rowset);
			break;
			
		}
		
		// Fetch foes, if any but only if they want foes filtered out
		if ($user_row['user_digest_remove_foes'] == 1)
		{
		
			unset($foes);
			// Fetch your foes
			$sql3 = 'SELECT zebra_id 
					FROM ' . ZEBRA_TABLE . '
					WHERE user_id = ' . $user_row['user_id'] . ' AND foe = 1';
			$result3 = $db->sql_query($sql3);
			while ($row3 = $db->sql_fetchrow($result3))
			{
				$foes[] = (int) $row3['zebra_id'];
			}
			$db->sql_freeresult($result3);
					
		}
		
		// Put posts in the digests, assuming they should not be filtered out
		foreach ($rowset as $post_row)
		{
			
			// If we've hit the limit of the maximum number of posts in a digest, it's time to exit the loop. If $max_posts == 0 there is no limit.
			if (($max_posts !== 0) && ((int) $posts_in_digest >= (int) $max_posts))
			{
				break;
			}
				
			// Skip post if user wants new posts only (since last visit date) and the post is before the user's last visit date
			if ($user_row['user_digest_new_posts_only'] && ($post_row['post_time'] < $user_row['user_lastvisit']))
			{
				continue;
			}
				
			// Exclude post if from a foe
			if (isset($foes) && sizeof($foes) > 0)
			{
				if ($user_row['user_digest_remove_foes'] == 1 && in_array($post_row['poster_id'], $foes))
				{
					continue;
				}
			}

			// Exclude posts that are before the needed start date/time
			if (($user_row['user_digest_type'] == DIGEST_WEEKLY_VALUE) && ($post_row['post_time'] < $time - (7 * 24 * 60 * 60)))
			{
				continue;
			}
			if (($user_row['user_digest_type'] == DIGEST_DAILY_VALUE) && ($post_row['post_time'] < $time - (24 * 60 * 60)))
			{
				continue;
			}
			
			// Exclude posts for monthly digests that occur after the end of the previous month. Since posts are ordered by date/time
			// when we hit the first occurrence we can exit the post loop.
			if (($user_row['user_digest_type'] == DIGEST_MONTHLY_VALUE) && ($post_row['post_time'] > $gmt_month_lastday_end))
			{
				break;
			}

			// Skip if post has less than minimum words wanted.
			if (($user_row['user_digest_min_words'] > 0) && ((truncate_words(censor_text($post_row['post_text']), $user_row['user_digest_min_words'], true) < $user_row['user_digest_min_words']))) 
			{
				continue;
			}
			
			if ($user_row['user_digest_filter_type'] == DIGEST_BOOKMARKS)
			{
				// Skip post if not a bookmarked topic
				if ((sizeof($bookmarked_topics) > 0) && !in_array($post_row['topic_id'], $bookmarked_topics))
				{
					continue;
				}
			}
			else
			{
				// Skip post if post is not in an allowed forum
				if (!in_array($post_row['forum_id'], $fetched_forums))
				{
					continue;
				}
			}
			
			// Skip for qualifying posts if new posts only logic applies
			if (($user_row['user_digest_new_posts_only']) && ($post_row['post_time'] < max($date_limit, $user_row['user_lastvisit'])))
			{
				continue;
			}

			// Skip posts if first post logic applies and not a first post
			if (($user_row['user_digest_filter_type'] == DIGEST_FIRST) && ($post_row['topic_first_post_id'] <> $post_row['post_id']))
			{
				continue;
			}
			
			// Skip for qualifying posts if remove mine logic applies
			if (($user_row['user_digest_show_mine'] == 0) && ($post_row['poster_id'] == $user_row['user_id']))
			{
				continue;
			}
			
			// If there are inline attachments, remove them otherwise they will show up twice. Getting the styling right
			// in these cases is probably a lost cause due to the complexity to be addressed due to various styling issues.
			$post_text = preg_replace('#\[attachment=.*?\].*?\[/attachment:.*?]#', '', censor_text($post_row['post_text']));
		
			// Now adjust post time to digest recipient's local time
			$recipient_time = $post_row['post_time'] - ($server_timezone * 60 * 60) + (($user_row['user_timezone'] + $user_row['user_dst']) * 60 * 60);
		
			// Add to table of contents array
			$toc['posts'][$toc_post_count]['post_id'] = html_entity_decode($post_row['post_id']);
			$toc['posts'][$toc_post_count]['forum'] = html_entity_decode($post_row['forum_name']);
			$toc['posts'][$toc_post_count]['topic'] = html_entity_decode($post_row['topic_title']);
			$toc['posts'][$toc_post_count]['author'] = html_entity_decode($post_row['username']);
			$toc['posts'][$toc_post_count]['datetime'] = date(str_replace('|','',$user_row['user_dateformat']), $recipient_time);
			$toc_post_count++;

			// Need BBCode flags to translate BBCode
			$flags = (($post_row['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) +
				(($post_row['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) + 
				(($post_row['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
				
			$post_text = generate_text_for_display($post_text, $post_row['bbcode_uid'], $post_row['bbcode_bitfield'], $flags);
			
			// Handle logic to display attachments
			if ($post_row['post_attachment'] > 0 && $user_row['user_digest_attachments'])
			{
				$post_text .= sprintf("<div class=\"box\">\n<p>%s</p>\n", $user->lang['ATTACHMENTS']);
				
				// Get all attachments
				$sql3 = 'SELECT *
					FROM ' . ATTACHMENTS_TABLE . '
					WHERE post_msg_id = ' . $post_row['post_id'] . ' AND in_message = 0 
					ORDER BY attach_id';
				$result3 = $db->sql_query($sql3);
				while ($row3 = $db->sql_fetchrow($result3))
				{
					$file_size = round(($row3['filesize']/1024),2);
					// Show images, link to other attachments
					if (substr($row3['mimetype'],0,6) == 'image/')
					{
						$anchor_begin = '';
						$anchor_end = '';
						$post_image_text = '';
						$thumbnail_parameter = '';
						$is_thumbnail = ($row3['thumbnail'] == 1) ? true : false;
						// Logic to resize the image, if needed
						if ($is_thumbnail)
						{
							$anchor_begin = sprintf("<a href=\"%s\">", $board_url . "download/file.$phpEx?id=" . $row3['attach_id']);
							$anchor_end = '</a>';
							$post_image_text = $user->lang['DIGEST_POST_IMAGE_TEXT'];
							$thumbnail_parameter = '&t=1';
						}
						$post_text .= sprintf("%s<br /><em>%s</em> (%s KiB)<br />%s<img src=\"%s\" alt=\"%s\" title=\"%s\" />%s\n<br />%s", censor_text($row3['attach_comment']), $row3['real_filename'], $file_size, $anchor_begin, $board_url . "download/file.$phpEx?id=" . $row3['attach_id'] . $thumbnail_parameter, censor_text($row3['attach_comment']), censor_text($row3['attach_comment']), $anchor_end, $post_image_text);
					}
					else
					{
						$post_text .= ($row3['attach_comment'] == '') ? '' : '<em>' . censor_text($row3['attach_comment']) . '</em><br />';
						$post_text .= 
							sprintf("<img src=\"%s\" title=\"\" alt=\"\" /> ", 
								$board_url . 'styles/' . $user_row['style_name'] . '/imageset/icon_topic_attach.gif') .
							sprintf("<b><a href=\"%s\">%s</a></b> (%s KiB)<br />",
								$board_url . "download/file.$phpEx?id=" . $row3['attach_id'], 
								$row3['real_filename'], 
								$file_size);
					}
				}
				$db->sql_freeresult($result3);
				
				$post_text .= '</div>';
							
			}
			
			// User signature wanted?
			$user_sig = ( $post_row['enable_sig'] && $post_row['user_sig'] != '' && $config['allow_sig'] ) ? censor_text($post_row['user_sig']) : '';
			if ($user_sig != '')
			{
				// Format the signature for display
				// Fix by phpBB user EAM to handle when post and signature BBCode settings differ
				$sigflags = (($post_row['enable_sig']) ? OPTION_FLAG_BBCODE : 0) +
								(($post_row['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) + 
								(($post_row['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
				$user_sig = generate_text_for_display($user_sig, $post_row['user_sig_bbcode_uid'], $post_row['user_sig_bbcode_bitfield'], $sigflags);
			}
		
			// Add signature to bottom of post
			$post_text = ($user_sig != '') ? $post_text . "\n" . $user->lang['DIGEST_POST_SIGNATURE_DELIMITER'] . "\n" . $user_sig : $post_text . "\n";

			// If required or requested, remove all images
			if ($config['digests_block_images'] || $user_row['user_digest_block_images'])
			{
				$post_text = preg_replace('/(<)([img])(\w+)([^>]*>)/', '', $post_text);
			}
			
			// If a text digest is desired, this is a good point to strip tags
			if (!$is_html)
			{
				$post_text = str_replace('<br />', "\n\n", $post_text);
				$post_text = html_entity_decode(strip_tags($post_text));
			}
			else
			{
				// Board URLs must be absolute in the digests, so substitute board URL for relative URL
				$post_text = str_replace('<img src="' . $phpbb_root_path, '<img src="' . $board_url, $post_text);
			} 
	
			if ($last_forum_id != (int) $post_row['forum_id'])
			{
				// Process a forum break
				$template->assign_block_vars('forum', array(
					'FORUM'			=> ($is_html) ? sprintf('<a href="%sviewforum.%s?f=%s">%s</a>', $board_url, $phpEx, $post_row['forum_id'], html_entity_decode($post_row['forum_name'])) : html_entity_decode($post_row['forum_name']),
				));
				$last_forum_id = (int) $post_row['forum_id'];
			}
					
			if ($last_topic_id != (int) $post_row['topic_id'])
			{
				// Process a topic break
				$template->assign_block_vars('forum.topic', array(
					'S_USE_CLASSIC_TEMPLATE'	=> $use_classic_template,
					'TOPIC'						=> ($is_html) ? sprintf('<a href="%sviewtopic.%s?f=%s&amp;t=%s">%s</a>', $board_url, $phpEx, $post_row['forum_id'], $post_row['topic_id'], html_entity_decode($post_row['topic_title'])) : html_entity_decode($post_row['topic_title']),
				));
				$last_topic_id = (int) $post_row['topic_id'];
			}
			
			// Handle max display words logic
			if ($user_row['user_digest_max_display_words'] > 0)
			{
				$post_text = truncate_words($post_text, $user_row['user_digest_max_display_words']);
			}
			
			if ($show_post_text || $use_classic_template)
			{
				$from_url = sprintf("<a href=\"%s?mode=viewprofile&amp;u=%s\">%s</a>%s", $board_url . 'memberlist.' . $phpEx, $post_row['user_id'], html_entity_decode($post_row['username']), "\n");
			}
			else
			{
				$from_url = sprintf("<a href=\"%sviewtopic.$phpEx?f=%s&amp;t=%s#p%s\">%s</a>%s", $board_url, $post_row['forum_id'], $post_row['topic_id'], $post_row['post_id'], $post_row['username'], "\n");
			}
			
			$template->assign_block_vars('forum.topic.post', array(
				'ANCHOR'		=> "<a name=\"p" . $post_row['post_id'] . "\"></a>",
				'CONTENT'		=> $post_text,
				'DATE'			=> date(str_replace('|','',$user_row['user_dateformat']), $recipient_time) . "\n",
				'FROM'			=> ($is_html) ? $from_url : html_entity_decode($post_row['username']),
				'POST_LINK'		=> ($is_html) ? sprintf("<a href=\"%sviewtopic.$phpEx?f=%s&amp;t=%s&amp;p%s#p%s\">%s</a>%s", $board_url, $post_row['forum_id'], $post_row['topic_id'], $post_row['topic_first_post_id'], $post_row['post_id'], $post_row['post_id'], "\n") : $post_row['post_id'],
				'SUBJECT'		=> ($is_html) ? sprintf("<a href=\"%sviewtopic.$phpEx?f=%s&amp;t=%s#p%s\">%s</a>%s", $board_url, $post_row['forum_id'], $post_row['topic_id'], $post_row['post_id'], html_entity_decode(censor_text($post_row['post_subject'])), "\n") : html_entity_decode(censor_text($post_row['post_subject'])),
				'S_FIRST_POST' 	=> ($post_row['topic_first_post_id'] == $post_row['post_id']), // Hide subject if first post, as it is the same as topic title
			));
			
			$posts_in_digest++;
			
		}
	
	}
	
	// General template variables are set here. Many are inherited from language variables in the template.
	$template->assign_vars(array(
		'DIGEST_TOTAL_PMS'				=> sizeof($pm_rowset),
		'DIGEST_TOTAL_POSTS'			=> $posts_in_digest,
		'L_DIGEST_NO_PRIVATE_MESSAGES'	=> $user->lang['DIGEST_NO_PRIVATE_MESSAGES'] . "\n",
		'L_PRIVATE_MESSAGE'				=> strtolower($user->lang['PRIVATE_MESSAGE']) . "\n",
		'L_PRIVATE_MESSAGE_2'			=> ucwords($user->lang['PRIVATE_MESSAGE']) . "\n",
		'L_YOU_HAVE_PRIVATE_MESSAGES'	=> sprintf($user->lang['DIGEST_YOU_HAVE_PRIVATE_MESSAGES'], $user_row['username']) . "\n",
		'S_SHOW_POST_TEXT'				=> $show_post_text,
	));
	
	// Use the template system to write the content to a variable
	$digest_body = $template->assign_display('mail_digests');
	$template->destroy(); // If you don't destroy the template subsequent users will receive duplicate posts
	return $digest_body;
	
}

function truncate_words($text, $max_words, $just_count_words = false)
{

	// This function returns the first $max_words from the supplied $text. If $just_count_words === true, a word count is returned. Note:
	// for consistency, HTML is stripped. This can be annoying, but otherwise HTML rendered in the digest may not be valid.
	
	global $user;
	
	if ($just_count_words)
	{
		return str_word_count(strip_tags($text));
	}
	
	$word_array = preg_split("/[\s]+/", $text);
	
	if (sizeof($word_array) <= $max_words)
	{
		return rtrim($text);
	}
	else
	{
		$truncated_text = '';
		for ($i=0; $i < $max_words; $i++) 
		{
			$truncated_text .= $word_array[$i] . ' ';
		}
		return rtrim($truncated_text) . $user->lang['DIGEST_MAX_WORDS_NOTIFIER'];
	}
	
}

function check_all_parents($forum_array, $forum_id)
{

	// This function checks all parents for a given forum_id. If any of them do not have the f_list permission
	// the function returns false, meaning the forum should not be displayed because it has a parent that should
	// not be listed. Otherwise it returns true, indicating the forum can be listed.
	
	global $db, $list_id;
	
	$there_are_parents = true;
	$current_forum_id = $forum_id;
	$include_this_forum = true;
	
	static $parents_loaded = false;
	static $parent_array = array();
	
	if (!$parents_loaded)
	{
		// Get a list of parent_ids for each forum and put them in an array.
		$sql = 'SELECT forum_id, parent_id 
			FROM ' . FORUMS_TABLE . '
			ORDER BY 1';
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$parent_array[$row['forum_id']] = $row['parent_id'];
		}
		$parents_loaded = true;
		$db->sql_freeresult();
	}
	
	while ($there_are_parents)
	{
	
		if ($parent_array[$current_forum_id] == 0) 	// No parent
		{
			$there_are_parents = false;
		}
		else
		{
			if (isset($forum_array[$parent_array[$current_forum_id]][$list_id]) && $forum_array[$parent_array[$current_forum_id]][$list_id] == 1)
			{
				// So far so good
				$current_forum_id = $parent_array[$current_forum_id];
			}
			else
			{
				// Danger Will Robinson! No list permission exists for a parent of the requested forum, so this forum should not be shown
				$there_are_parents = false;
				$include_this_forum = false;
			}
		}
		
	}

	return $include_this_forum;
	
}

function write_log_entry()
{

	// This function writes to the admin log when needed, and also to the screen if requested
	
	global $config, $user;
	$args = func_get_args();
	$numargs = func_num_args();

	// This is long winded and rather silly code specifically to keep a PHP Notice from occurring. It matters to some
	// and I haven't figured out a better way to do this.
	switch ($numargs)
	{
		
		case 0:
			add_log('admin', 'LOG_CONFIG_DIGEST_WRITE_LOG_ENTRY_ERROR', $args[0]);
			if ($config['digests_enable_log'])
			{
				echo sprintf($user->lang[$args[0]], $args[1]) . '<br />';
			}
			if ($config['digests_show_output'])
			{	
				echo sprintf($user->lang['LOG_CONFIG_DIGEST_WRITE_LOG_ENTRY_ERROR'], $args[0]) . '<br />';
			}
		break;
		case 1:
			if ($config['digests_enable_log'])
			{
				add_log('admin', $args[0]);
			}
			if ($config['digests_show_output'])
			{	
				echo sprintf($user->lang[$args[0]]) . '<br />';
			}
		break;
		case 2:
			if ($config['digests_enable_log'])
			{
				add_log('admin', $args[0], $args[1]);
			}
			if ($config['digests_show_output'])
			{	
				echo sprintf($user->lang[$args[0]], $args[1]) . '<br />';
			}
		break;
		case 3:
			if ($config['digests_enable_log'])
			{
				add_log('admin', $args[0], $args[1], $args[2]);
			}	
			if ($config['digests_show_output'])
			{	
				echo sprintf($user->lang[$args[0]], $args[1], $args[2]) . '<br />';
			}
		break;
		case 4:
			if ($config['digests_enable_log'])
			{
				add_log('admin', $args[0], $args[1], $args[2], $args[3]);
			}
			if ($config['digests_show_output'])
			{	
				echo sprintf($user->lang[$args[0]], $args[1], $args[2], $args[3]) . '<br />';
			}
		break;
		case 5:
			if ($config['digests_enable_log'])
			{
				add_log('admin', $args[0], $args[1], $args[2], $args[3], $args[4]);
			}
			if ($config['digests_show_output'])
			{	
				echo sprintf($user->lang[$args[0]], $args[1], $args[2], $args[3], $args[4]) . '<br />';
			}
		break;
		case 6:
			if ($config['digests_enable_log'])
			{
				add_log('admin', $args[0], $args[1], $args[2], $args[3], $args[4], $args[5]);
			}
			if ($config['digests_show_output'])
			{	
				echo sprintf($user->lang[$args[0]], $args[1], $args[2], $args[3], $args[4], $args[5]) . '<br />';
			}
		break;
		default:
		break;
		
	}
			
	return;
	
}
?>