<?php
/***************************************************************************
 *                           block_style_select.php
 *                            -------------------
 *   begin                : Saturday, Jan 21, 2005
 *   copyright            : (C) 2005 Michaelo - Michael O'Toole
 *   website              : http://www.phpbbireland.com
 *   email                : admin@phpbbireland.com
 *
 *   updated              : 11 February 2013
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	exit;
}

 // Anonymous users can't select a style...
if ($user->data['user_id'] == ANONYMOUS)
{
	return;
}

global $user_id, $user, $template, $phpbb_root_path, $phpEx, $db, $k_blocks;

$current_style = $user->data['user_style'];		// the current style
$new_style = request_var('style', 0);			// selected style
$make_permanent = request_var('y', 0);			// make style permanent

$allow_style_change = ($config['override_user_style']) ? false : true;
$change_db_style = ($allow_style_change && $make_permanent) ? true : false;


//echo 'Current = ' . $current_style . ' new = ' . $new_style . ' makep = ' . $make_permanent . ' allow = ' . $allow_style_change . '<br />';


if ($make_permanent && $new_style != $current_style && $change_db_style)
{
	$sql = "UPDATE " . USERS_TABLE . "
		SET user_style = " . (int)$new_style . "
		WHERE user_id = " . (int)$user_id;
	$db->sql_query($sql);
}

$style_count = 0;
$style_select = '';
$this_page = explode(".", $user->page['page']);

// rebuild forum and topic (viewforum, viewtopic) //
$appends = '';
$fo = request_var('f', 0);
$to = request_var('t', 0);

if ($fo != 0)
{
	$appends = 'f=' . $fo;
}
if ($to != 0)
{
	$appends .= '&amp;t=' . $to;
}

foreach ($k_blocks as $blk)
{
	if ($blk['html_file_name'] == 'block_style_select.html')
	{
		$block_cache_time = $blk['block_cache_time'];
	}
}
$block_cache_time = (isset($block_cache_time) ? $block_cache_time : $k_config['k_block_cache_time_default']);

$sql = 'SELECT style_id, style_name
	FROM ' . STYLES_TABLE . '
	WHERE style_active = 1
	ORDER BY LOWER(style_name) ASC';
$result = $db->sql_query($sql, $block_cache_time);

while ($row = $db->sql_fetchrow($result))
{
	$style = request_var('style', 0);

	if ($style)
	{
		$url = str_replace('style=' . $style, 'style=' . $row['style_id'], append_sid("{$phpbb_root_path}{$this_page[0]}.$phpEx", $appends));
	}
	else
	{
		$url = append_sid("{$phpbb_root_path}{$this_page[0]}.$phpEx", 'style=' . $row['style_id'] . '&amp;' . $appends);
	}
	++$style_count;

	$style_select .= '<option value="' . $url . '"' . ($row['style_id'] == $user->theme['style_id'] ? ' selected="selected"' : '') . '>' . htmlspecialchars(sgp_checksize ($row['style_name'], 16)) . '</option>';
}
$db->sql_freeresult($result);

if (strlen($style_select))
{
	$template->assign_var('STYLE_SELECT', $style_select);
}

$template->assign_vars(array(
	'STYLE_COUNT'	=> $style_count,
	'S_SHOW_PERM'	=> ($this_page[0] == 'portal') ? true : false,
));
?>