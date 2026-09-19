<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, 14th November, 2005
* @copyright (c) 2005-2008 phpbbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
    exit;
}

global $k_config, $phpbb_root_path, $k_blocks, $template, $user;

// Initialized $total_queries to prevent PHP 8+ undefined variable warnings
$queries = $cached_queries = $total_queries = 0; 
$phpEx = substr(strrchr(__FILE__, '.'), 1);
$show_all_links = false;
$block_cache_time = isset($k_config['k_block_cache_time_default']) ? $k_config['k_block_cache_time_default'] : 0;

foreach ($k_blocks as $blk)
{
    if ($blk['html_file_name'] == 'block_links.html')
    {
        $block_cache_time = $blk['block_cache_time'];
        break; // Stop looping once the target block is found
    }
}

// Retrieve portal config variables safely
$k_links_to_display = (int) $k_config['k_links_to_display'];

if ($k_links_to_display > 0 && $k_links_to_display < 6)
{
    $show_all_links = false;
}
else if ($k_links_to_display == 0)
{
    $show_all_links = true;
}

$links_forum = '';
if (!empty($k_config['k_links_forum_id']))
{
    $links_forum = append_sid("{$phpbb_root_path}posting.$phpEx", 'mode=post&amp;f=' . (int)$k_config['k_links_forum_id']);
}

$imglist = array();
$allowed_extensions = array('gif', 'jpg', 'jpeg', 'png');
$links_dir = $phpbb_root_path . 'images/links/';

// Secure directory reading
if (is_dir($links_dir) && $handle = opendir($links_dir))
{
    while (($file = readdir($handle)) !== false)
    {
        // Skip hidden files and directory traversal dots
        if ($file === '.' || $file === '..') 
        {
            continue;
        }

        // Strictly check the actual file extension
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, $allowed_extensions, true))
        {
            $imglist[] = $file;
        }
    }
    closedir($handle);
}

$total_images_found = sizeof($imglist);
$links_count = $total_images_found;

// Ensure we don't try to display more links than we actually have
if ($k_links_to_display > $links_count || $show_all_links)
{
    $k_links_to_display = $links_count;
}

// Modern, simplified array selection replacing the legacy math logic
$display_images = array();
if ($show_all_links || $k_links_to_display == $links_count) 
{
    $display_images = $imglist;
} 
elseif ($k_links_to_display > 0 && $links_count > 0) 
{
    shuffle($imglist); // Randomize the array safely
    $display_images = array_slice($imglist, 0, $k_links_to_display); // Take the required amount
}

// Process images and assign to template
foreach ($display_images as $image)
{
    // Safely extract the filename without the extension
    $raw_name = pathinfo($image, PATHINFO_FILENAME);
    
    // Reconstruct the URL based on the legacy filename character mapping
    $url = str_replace(array('+', '@', '£'), array('/', '?', '+'), $raw_name);

    // Basic XSS protection to ensure the URL cannot execute JavaScript
    if (preg_match('#^javascript:#i', trim($url)))
    {
        $url = '#'; 
    }

    $template->assign_block_vars('portal_links_row', array(
        'LINKS_IMG' => $phpbb_root_path . 'images/links/' . $image,
        'U_LINKS'   => $url,
    ));
}

$template->assign_vars(array(
    'SUBMIT_LINK'   => $links_forum,
    'LINKS_COUNT'   => $k_links_to_display,
    'TOTAL_LINKS'   => $total_images_found,
    'LINKS_DEBUG'   => sprintf(
        isset($user->lang['PORTAL_DEBUG_QUERIES']) ? $user->lang['PORTAL_DEBUG_QUERIES'] : '', 
        $queries, 
        $cached_queries, 
        $total_queries
    ),
));
?>