<?php
/** 
*
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package phpBB3
* @version $Id: kb_common.php 45 2009-06-11 17:09:25Z tobi.schaefer $
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


define('KB_SEO',		false);

$kb_root_path = $phpbb_root_path . KB_FOLDER . '/';


$sql = 'SELECT config_name, config_value
	FROM ' . KB_CONFIG_TABLE;
$result = $db->sql_query($sql, 3600);
while($row = $db->sql_fetchrow($result))
{
	$kb_config[$row['config_name']] = $row['config_value'];
}




?>
