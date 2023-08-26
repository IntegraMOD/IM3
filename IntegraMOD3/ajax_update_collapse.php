<?php
/** 
*
* @author Brad Fermanich (Brf) http://castledoom.com
*
* @package phpBB3
* @version $Id: ajax_update_collapse.php 1A January 14, 2008 09:05:47 PM $
* @copyright (c) 2007 Brf 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* This is an Ajax DBUpdate routine and will not display any data to the user
* The echoes are included to be able to signal back to the javascript routine
* that the update is done. This signal is pretty much ignored by the javascript routine.
*/

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
// Start session management
$user->session_begin();

$col_set		= request_var('cset', 0);
$col_unset		= request_var('cunset', 0);
$cat_num		= ($col_set)?$col_set : $col_unset;
@ob_end_clean();
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT'); 
header('Cache-Control: no-cache, must-revalidate'); 
header('Pragma: no-cache');
header('Content-type: text/xml; charset=UTF-8');	
echo '<' . '?xml version="1.0" encoding="UTF-8" ?' . '>
<xml>
<description>';
echo ("user:" . $user ->data['user_id']);
if (!$cat_num || !($user->data['is_registered']))
{
	echo('Nothing');
}
else
{
	$user->get_profile_fields($user->data['user_id']);
	$collapse_list=get_user_collapse();
	$cat_found = false;
	if (count($collapse_list) > 0 )
	{
//	---------- Note: array_search will return 0 if the needle not found OR if it is in cell[0]
//	---------- so we will check that cell first
		if ($collapse_list[0] == $cat_num)
		{
			$cat_index = 0;
			$cat_found = true;
			echo ("1");
		}
		else
		{
			$cat_index = array_search($cat_num,$collapse_list);
			$cat_found = ($cat_index > 0);
			echo("2+" . $cat_found  . " / " . $cat_index); 
		}
	}
	if ($col_set && !($cat_found))
	{
		array_push($collapse_list,$cat_num);
	}
	else if ($col_unset && $cat_found)
	{
		unset($collapse_list[$cat_index]);
	}
	$collapse_string = implode(',',$collapse_list);
	$sql = 'UPDATE ' . PROFILE_FIELDS_DATA_TABLE . "
					SET pf_fcol = '" . $collapse_string . "'
					WHERE user_id = " . $user->data['user_id'];
	$db->sql_query($sql);
	if (!$db->sql_affectedrows())
	{
		$sql = 'INSERT INTO ' . PROFILE_FIELDS_DATA_TABLE . 
				" (user_id,pf_fcol) values ({$user->data['user_id']} , '{$collapse_string}')" ;
		$db->sql_query($sql);
	}		
	if ($col_set)
	{
		echo('set ' . $cat_num);
	}
		else
	{
		echo('unset ' . $cat_num);
	}
}
echo '</description><error></error></xml>';
?>