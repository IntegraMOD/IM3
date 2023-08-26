<?php

/**
*
* @mod package		Download MOD 6
* @file				dl_ajax.php 1 2011/06/18 OXPUS
* @copyright		(c) 2011 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

function AJAX_headers()
{
	//No caching whatsoever
	header('Content-Type: application/xml');
	header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	header('Last-Modified: '. gmdate('D, d M Y H:i:s') .' GMT');
	header('Cache-Control: no-cache, must-revalidate');
	header('Pragma: no-cache');

	flush();
}

function AJAX_message_die($data_ar)
{
	global $template, $cache, $db;

	if (!headers_sent())
	{
		AJAX_headers();
	}

	$template->set_filenames(array(
		'ajax_result' => 'dl_mod/dl_ajax.html')
	);

	foreach($data_ar as $key => $value)
	{
		if ($value !== '')
		{
			$value = utf8_encode(htmlspecialchars($value));
			// Get special characters in posts back ;)
			$value = preg_replace('#&amp;\#(\d{1,4});#i', '&#\1;', $value);

			$template->assign_block_vars('tag', array(
				'TAGNAME'	=> $key,
				'VALUE'		=> $value)
			);
		}
	}

	$template->display('ajax_result');

	if (!empty($cache))
	{
		$cache->unload();
	}
	$db->sql_close();

	exit;
}

if (!$df_id || !$rate_point)
{
	$result_ar = array(
		'result'	=> 1,
		'error_msg'	=> 'Incorrect rating data'
	);
	AJAX_message_die($result_ar);
}

$sql = 'INSERT INTO ' . DL_RATING_TABLE . ' ' . $db->sql_build_array('INSERT', array(
	'rate_point'	=> $rate_point,
	'user_id'		=> $user->data['user_id'],
	'dl_id'			=> $df_id));
$db->sql_query($sql);

$sql = 'SELECT AVG(rate_point) AS rating FROM ' . DL_RATING_TABLE . '
	WHERE dl_id = ' . (int) $df_id . '
	GROUP BY dl_id';
$result = $db->sql_query($sql);
$new_rating = ceil($db->sql_fetchfield('rating'));
$db->sql_freeresult($result);

$sql = 'UPDATE ' . DOWNLOADS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
	'rating' => $new_rating)) . ' WHERE id = ' . (int) $df_id;
$db->sql_query($sql);

$rating_img = '';

for ($i = 0; $i < $config['dl_rate_points']; $i++)
{
	$j = $i + 1;

	$rating_img .= ($j <= $new_rating ) ? $user->img('dl_rate_yes') : $user->img('dl_rate_no');
}

// Send it back to client for further processing
$result_ar = array(
	'result'		=> 3,
	'rating_img'	=> $rating_img,
	'df_id'			=> $df_id,
);
AJAX_message_die($result_ar);

?>