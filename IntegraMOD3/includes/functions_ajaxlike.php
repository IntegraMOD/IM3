<?php
/**
*
* @package phpBB3
* @version $Id$
* @copyright (c) 2013 github.com/eMosbat
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

// this is an ajax call!
function ajaxlike_post_content($post_id,$topic_id,$forum_id)
{
	global $user, $config, $phpbb_root_path, $phpEx, $template, $auth;
	if(!function_exists('append_sid'))
	{
		include($phpbb_root_path . 'includes/functions.' . $phpEx);
	}
	$user->setup('viewtopic');
	
	$likes_data = fetch_topic_likes($post_id);
	
	$total_likes = (isset($likes_data[0][$post_id]) ? $likes_data[0][$post_id]  : 0);
	$post_likes = (isset($likes_data[0][$post_id]) ? $likes_data[0][$post_id] - (in_array($post_id, $likes_data[1]) ? 1 : 0) : 0);
	$you_liked = (in_array($post_id, $likes_data[1]) ? true : false);
	$like_list =build_like_list(isset($likes_data[2][$post_id]) ? $likes_data[2][$post_id]  : false);


	$template->assign_vars(array(
		'ALTER_MODE_LIKE_LIST'	=> isset($config['ajaxlike_alter_mode']) ? $config['ajaxlike_alter_mode'] : 0,
		'TOTAL_LIKES'			=> $total_likes,
		'POST_LIKES'			=> $post_likes,
		'YOU_LIKED'				=> $you_liked,
		'LIKE_LIST'				=> $like_list,
		'NO_OWN_POST'			=> true,
		'POST_ID'				=> $post_id,
		'TOPIC_ID'				=> $topic_id,
		'FORUM_ID'				=> $forum_id,
		'ALLOW_UNLIKE'			=> $config['ajaxlike_allow_unlike'],
		'LIKE_FROM'				=> $user->data['user_id'],
		'LIKE_CALLBACK'			=> append_sid("{$phpbb_root_path}viewtopic.$phpEx"),
		'LIKE_ACCESS'			=> (($auth->acl_get('u_ajaxlike_mod')) && ($auth->acl_get('f_ajaxlike_mod', $forum_id)) && ($user->data['user_id'] != ANONYMOUS) ? 1 : 0),
		'LAST_LIKE_URL'			=> ($total_likes > 1 ? '#' : append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;un=".$like_list)),
		)
	);
	
	$template->set_filenames(array(
    	'like_body' => 'ajaxlike/like_body.html',
	));
	
	return $template->assign_display('like_body', '', true);
	
}

function fetch_topic_likes($post_id = 0)
{
	global $post_list, $topic_id, $user, $db, $phpEx, $phpbb_root_path;

	if(!function_exists('user_get_id_name'))
	{
		include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
	}
	
	$sql = 'SELECT COUNT(like_id) as num_likes, post_id
		FROM ' . LIKES_TABLE . '
		WHERE topic_id = '. (int) $topic_id .' AND '. $db->sql_in_set('post_id', ($post_id == 0 ? $post_list : array((int) $post_id))) . ' 
		GROUP BY post_id';
	$result = $db->sql_query($sql);
	
	$likes_array = array();
	$last_likes = array();
	
	while($row = $db->sql_fetchrow($result))
	{
		
		$likes_array[$row['post_id']] = $row['num_likes'];
		
		if($row['num_likes']>0)
		{
			
			// we should get user info for each record
			$sql = 'SELECT user_id
				FROM ' . LIKES_TABLE . '
				WHERE post_id = '.  (int) $row['post_id'];
			$result2 = $db->sql_query_limit($sql, 15);
			
			$usernames = array();
			$user_ids = array();
			
			while($row2 = $db->sql_fetchrow($result2))
			{
				$user_ids[] = $row2['user_id'];
			}
			
			$db->sql_freeresult($result2);
			
			user_get_id_name($user_ids, $usernames);
			
			foreach($usernames as $uid => $uname)
			{
				if($uid!=$user->data['user_id'])
				{
					$last_likes[$row['post_id']][] = array(
						'uid' => $uid,
						'username' => $uname
					);
				}
			}
			
			
			unset($user_ids);
			unset($usernames);
		}
		
	}
	
	$db->sql_freeresult($result);
	
	$sql = 'SELECT post_id
		FROM ' . LIKES_TABLE . '
		WHERE topic_id = '. (int) $topic_id .' AND user_id = '. (int) $user->data['user_id'];
	$result = $db->sql_query($sql);
	
	$user_likes = array();
	
	while($row = $db->sql_fetchrow($result))
	{
		$user_likes[] = $row['post_id'];
	}
	
	$db->sql_freeresult($result);
	
	return array($likes_array, $user_likes, $last_likes);

}

// this is an ajax call
function build_like_list($likelist)
{
	$htmllist = "";
	$count_list = 0;
	
	if(is_array($likelist))
	{
		foreach($likelist as $key => $val)
		{
			$htmllist.= ($count_list > 0 ? '<br />' : '') . ($val['username']);
			$count_list++;
		}
	}
	
	return $htmllist;
}

function get_fulllist($post_id)
{

	global $db, $user, $phpEx, $phpbb_root_path;
	
	//include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
	//include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
	
	if(!function_exists('get_username_string'))
	{
		include($phpbb_root_path . 'includes/functions_content.' . $phpEx);
	}
	
	$user->setup('viewtopic');
	
			$sql = 'SELECT l_table.user_id, l_table.like_date, u_table.username, u_table.user_avatar, u_table.user_avatar_type, u_table.user_avatar_width, u_table.user_avatar_height, u_table.user_colour 
				FROM ' . LIKES_TABLE . ' as l_table 
				INNER JOIN ' . USERS_TABLE . ' as u_table ON u_table.user_id = l_table.user_id 
				WHERE l_table.post_id = '. (int) $post_id .' 
				ORDER BY l_table.like_date DESC';
			
			$result = $db->sql_query($sql);
			
			while($row = $db->sql_fetchrow($result))
			{
			
					 $fulllist[]= array(
				 		'uid' 			=> $row['user_id'],
						'username' 		=> ($row['username']),
						'date' 			=> $user->format_date($row['like_date']),
						'avatar' 		=> get_avatar_ajaxlike($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height']),
						'username_full'	=> (get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']))
				 	 );
			}

			$db->sql_freeresult($result);
			
			if(empty($fulllist))
			{
				$fulllist[]= array(
				 		'uid' 			=> 0,
						'username' 		=> $user->lang['AL_ERROR_INVALID_REQUEST'],
						'date' 			=> '',
						'avatar' 		=> '',
						'username_full'	=> ''
				 	 );
			}
			
			@header('Content-type: application/json');
			return @json_encode($fulllist);
}

function ajaxlike_like_post($post_id)
{

	global $db, $user;
	
	$sql = 'SELECT like_id 
		FROM ' . LIKES_TABLE . '
		WHERE post_id = '. (int) $post_id .' AND user_id = '. (int) $user->data['user_id'];
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if(!$row)
	{

		$sql = 'SELECT poster_id, topic_id, forum_id 
			FROM ' . POSTS_TABLE . '
			WHERE poster_id <> '. (int) $user->data['user_id'] .' AND post_id = '. (int) $post_id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
		
		if($row)
		{
			$sql = 'INSERT INTO ' . LIKES_TABLE . ' ' . $db->sql_build_array('INSERT', array(
					'user_id'		=> (int) $user->data['user_id'],
					'post_id'		=> (int) $post_id,
					'topic_id'		=> (int) $row['topic_id'],
					'poster_id'		=> (int) $row['poster_id'],
					'like_date'		=> (int) time(),
					'like_state'	=> AL_LIKE_STATE_UNREAD,
					'like_read'		=> AL_LIKE_STATE_UNREAD
				)
			);
			$db->sql_query($sql);
		}
	
		return ajaxlike_post_content($post_id,$row['topic_id'],$row['forum_id']);
	
	}
	
	$user->setup('viewtopic');
	return $user->lang['AL_ERROR_INVALID_REQUEST'];
}

function ajaxlike_unlike_post($post_id)
{

	global $db, $user;

	$sql = 'SELECT poster_id, topic_id, forum_id 
		FROM ' . POSTS_TABLE . '
		WHERE poster_id <> '. (int) $user->data['user_id'] .' AND post_id = '. (int) $post_id;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if($row)
	{
		
		$sql = 'DELETE FROM ' . LIKES_TABLE . '
			WHERE post_id = '. (int) $post_id .' AND user_id = '. (int) $user->data['user_id'];
		$db->sql_query($sql);
		
		return ajaxlike_post_content($post_id,$row['topic_id'],$row['forum_id']);
	}
	
	$user->setup('viewtopic');
	return $user->lang['AL_ERROR_INVALID_REQUEST'];
}

if (!function_exists('json_encode')) {
    function json_encode($data) { // from php.net/manual/en/function.json-encode.php
         switch ($type = gettype($data)) {
             case 'NULL':
                 return 'null';
             case 'boolean':
                 return ($data ? 'true' : 'false');
             case 'integer':
             case 'double':
             case 'float':
                 return $data;
             case 'string':
                 return '"' . addslashes($data) . '"';
             case 'object':
                 $data = get_object_vars($data);
             case 'array':
                 $output_index_count = 0;
                 $output_indexed = array();
                 $output_associative = array();
                 foreach ($data as $key => $value) {
                     $output_indexed[] = json_encode($value);
                     $output_associative[] = json_encode($key) . ':' . json_encode($value);
                     if ($output_index_count !== NULL && $output_index_count++ !== $key) {
                         $output_index_count = NULL;
                     }
                 }
                 if ($output_index_count !== NULL) {
                     return '[' . implode(',', $output_indexed) . ']';
                 } else {
                     return '{' . implode(',', $output_associative) . '}';
                 }
             default:
                 return ''; // Not supported
         }
     }
}

function get_user_liked($user_id)
{
	global $db;
	
	$sql = 'SELECT COUNT(like_id) as like_count 
		FROM ' . LIKES_TABLE . '
		WHERE poster_id = '. (int) $user_id;
	$result = $db->sql_query($sql);
	$like_count = (int) $db->sql_fetchfield('like_count');
	$db->sql_freeresult($result);
	
	return $like_count;
}

function get_user_likes($user_id)
{
	global $db;
	
	$sql = 'SELECT COUNT(like_id) as like_count 
		FROM ' . LIKES_TABLE . '
		WHERE user_id = '. (int) $user_id;
	$result = $db->sql_query($sql);
	$like_count = (int) $db->sql_fetchfield('like_count');
	$db->sql_freeresult($result);
	
	return $like_count;
}

function get_unread_likes($uid)
{
	global $db;
	
	$sql = 'SELECT COUNT(like_id) as like_count 
		FROM ' . LIKES_TABLE . '
		WHERE poster_id = '. (int) $uid .' AND like_read = ' . AL_LIKE_STATE_UNREAD;
	$result = $db->sql_query($sql);
	$like_count = (int) $db->sql_fetchfield('like_count');
	$db->sql_freeresult($result);
	
	return $like_count;
}

function get_notifications()
{

	global $db, $user, $config, $phpbb_root_path, $phpEx;
	
    $uid=$user->data['user_id'];
	$user->setup('viewtopic');
	
	if($user->data['user_id'] == ANONYMOUS)
	{
		return $user->lang['AL_ERROR_INVALID_REQUEST'];
	}
	
	//include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
	//include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
	
	if(!function_exists('get_username_string'))
	{
		include($phpbb_root_path . 'includes/functions_content.' . $phpEx);
	}
	
			$sql = 'SELECT l_table.user_id, t_table.forum_id, l_table.topic_id, l_table.post_id, l_table.like_id, l_table.like_date, u_table.username, u_table.user_avatar, u_table.user_avatar_type, u_table.user_avatar_width, u_table.user_avatar_height, u_table.user_colour 
				FROM ' . LIKES_TABLE . ' as l_table 
				INNER JOIN ' . USERS_TABLE . ' as u_table ON u_table.user_id = l_table.user_id 
				INNER JOIN ' . TOPICS_TABLE . ' as t_table ON l_table.topic_id = t_table.topic_id 
				WHERE l_table.poster_id = '. (int) $uid .' AND l_table.like_state = ' . AL_LIKE_STATE_UNREAD . ' 
				ORDER BY l_table.like_date DESC';
			
			$result = $db->sql_query_limit($sql,15); // limit it so do not get lot of notifications
			while($row = $db->sql_fetchrow($result))
			{
			          $textp = append_sid($phpbb_root_path . "viewtopic.$phpEx", "f=". $row['forum_id'] ."&amp;t=". $row['topic_id']."&amp;p=".$row['post_id']."#p". $row['post_id'] ."");
					 $notifications[]= array(
				 		'uid' 			=> $row['user_id'],
						'username' 		=> $row['username'],
						'date' 			=> $user->format_date($row['like_date']),
						'post' 			=> $textp,
						'new_likes' 	=> (get_unread_likes($uid)),
						'like_id' 		=> $row['like_id'],
						'like_info' 	=> ($user->lang['AL_LIKE_INFO']),
						'like_text' 	=> ($user->lang['AL_POST_TEXT']),
						'like_new'  	=> ($user->lang['AL_LIKE_NEW']),
						'avatar' 		=> (get_avatar_ajaxlike($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height'])),
						'username_full'	=> (get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']))
				 	 );
			} 

			$db->sql_freeresult($result);

            $sql = 'UPDATE ' . LIKES_TABLE . '
             SET like_state = ' . AL_LIKE_STATE_READ . ' WHERE poster_id = '. (int) $uid .' AND like_state = ' . AL_LIKE_STATE_UNREAD;
            $db->sql_query($sql);
			
		@header('Content-type: application/json');
		return @json_encode($notifications);

}

function get_liked_list()
{

	global $db, $user, $config, $phpbb_root_path, $phpEx;
	
    $uid=$user->data['user_id'];
	$user->setup('viewtopic');
	
	if($user->data['user_id'] == ANONYMOUS)
	{
		return $user->lang['AL_ERROR_INVALID_REQUEST'];
	}

	//include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
	//include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

	if(!function_exists('censor_text'))
	{
		include($phpbb_root_path . 'includes/functions_content.' . $phpEx);
	}
	
	
			$sql = 'SELECT l_table.user_id, t_table.forum_id, l_table.topic_id, l_table.post_id, l_table.like_date, p_table.post_text, u_table.username, u_table.user_avatar, u_table.user_avatar_type, u_table.user_avatar_width, u_table.user_avatar_height, u_table.user_colour, p_table.bbcode_uid 
				FROM ' . LIKES_TABLE . ' as l_table 
				INNER JOIN ' . USERS_TABLE . ' as u_table INNER JOIN ' . POSTS_TABLE . ' as p_table ON u_table.user_id = l_table.user_id  
				INNER JOIN ' . TOPICS_TABLE . ' as t_table ON p_table.topic_id = t_table.topic_id 
				WHERE l_table.poster_id = '. (int) $uid .' AND l_table.like_read = ' . AL_LIKE_STATE_UNREAD . ' AND p_table.post_id = l_table.post_id 
				ORDER BY l_table.like_date DESC';
			
			$result = $db->sql_query_limit($sql,100);
			$rows = $db->sql_fetchrowset($result);
			$db->sql_freeresult($result);
			
			if(!empty($rows))
			{
				foreach($rows as $row)
				{
				
				$post_text = censor_text($row['post_text']);
				
				if($row['bbcode_uid'])
				{
					strip_bbcode($post_text, $row['bbcode_uid']);
				}
				
				$post_text = get_context($post_text, array(), 200);
				
				$textp = append_sid($phpbb_root_path . "viewtopic.$phpEx", "f=". $row['forum_id'] ."&amp;t=". $row['topic_id']."&amp;p=".$row['post_id']."#p". $row['post_id'] ."");
					 $liked_list[]= array(
						'item_class'  	=> 'new',
				 		'uid' 			=> $row['user_id'],
						'username' 		=> $row['username'],
						'post' 			=> $textp,
						'date' 			=> $user->format_date($row['like_date']),
						'avatar' 		=> (get_avatar_ajaxlike($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height'])),
						'post_text' 	=> $post_text,
						'like_info' 	=> ($user->lang['AL_LIKE_INFO']),
						'like_text' 	=> ($user->lang['AL_POST_TEXT']),
						'like_new'  	=> ($user->lang['AL_LIKE_NEW']),
						'username_full'	=> (get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']))
				 	 );
				}
			}

			
			if(count($rows)<30)
			{
				
				$fetch_limit = 30 - count($rows);
				
				$sql = 'SELECT l_table.user_id, t_table.forum_id, l_table.topic_id, l_table.post_id, l_table.like_date, p_table.post_text, u_table.username, u_table.user_avatar, u_table.user_avatar_type, u_table.user_avatar_width, u_table.user_avatar_height, u_table.user_colour, p_table.bbcode_uid 
				FROM ' . LIKES_TABLE . ' as l_table INNER JOIN ' . USERS_TABLE . ' as u_table 
				INNER JOIN ' . POSTS_TABLE . ' as p_table ON u_table.user_id = l_table.user_id 
				INNER JOIN ' . TOPICS_TABLE . ' as t_table ON p_table.topic_id = t_table.topic_id 
				WHERE l_table.poster_id = '. (int) $uid .' AND l_table.like_read = ' . AL_LIKE_STATE_READ . ' AND p_table.post_id = l_table.post_id 
				ORDER BY l_table.like_date DESC';
				
				$result = $db->sql_query_limit($sql, $fetch_limit);
				$rows2 = $db->sql_fetchrowset($result);
				$db->sql_freeresult($result);
				
				if(!empty($rows2))
				{
					foreach($rows2 as $row)
					{
					
					$post_text = censor_text($row['post_text']);
					
					if($row['bbcode_uid'])
					{
						strip_bbcode($post_text, $row['bbcode_uid']);
					}
					
					$post_text = get_context($post_text, array(), 200);
					
					$textp = append_sid($phpbb_root_path . "viewtopic.$phpEx", "f=". $row['forum_id'] ."&amp;t=". $row['topic_id']."&amp;p=".$row['post_id']."#p". $row['post_id'] ."");
					 $liked_list[]= array(
						'item_class'  	=> 'old',
				 		'uid' 			=> $row['user_id'],
						'username' 		=> $row['username'],
						'post' 			=> $textp,
						'date' 			=> $user->format_date($row['like_date']),
						'avatar' 		=> (get_avatar_ajaxlike($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height'])),
						'post_text' 	=> $post_text,
						'like_info' 	=> ($user->lang['AL_LIKE_INFO']),
						'like_text' 	=> ($user->lang['AL_POST_TEXT']),
						'like_new'  	=> ($user->lang['AL_LIKE_NEW']),
						'username_full'	=> (get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']))
				 	 );
					
					}
				}
			}
			

				if(empty($rows) && empty($rows2)) // show something when we have no likes at all.
				{
					 $liked_list[]= array(
						'item_class'  	=> 'old',
				 		'uid' 			=> '',
						'username' 		=> '',
						'post' 			=> '',
						'date' 			=> '',
						'avatar' 		=> '',
						'post_text' 	=> $user->lang['AL_NO_LIKE_RECEIVED'],
						'like_info' 	=> '',
						'like_text' 	=> '',
						'like_new'  	=> ($user->lang['AL_LIKE_NEW']),
						'username_full'	=> '',
				 	 );
					
				}
			
			$sql = 'UPDATE ' . LIKES_TABLE . '
	            SET like_read = ' . AL_LIKE_STATE_READ . ' WHERE poster_id = '. (int) $uid .'';
            $db->sql_query($sql); 
			
			@header('Content-type: application/json');
			return @json_encode($liked_list);
}


function ajaxlike_die($msg,$err_id=0)
{
	global $phpEx, $phpbb_root_path, $user;
	
	if(!function_exists('garbage_collection'))
	{
		include($phpbb_root_path . 'includes/functions.' . $phpEx);
	}
	
	if($err_id != 0) {
		$user->setup('viewtopic');
	
		if($err_id == AL_ERROR_INVALID_REQUEST)
		{//Invalid request!
			$msg = $user->lang['AL_ERROR_INVALID_REQUEST'];
		}
		if($err_id == AL_ERROR_ACCESS_DENIED)
		{//Access Denied!
			$msg = $user->lang['AL_ERROR_ACCESS_DENIED'];
		}
	}
	
	garbage_collection();
	
	(ob_get_level() > 0) ? @ob_flush() : @flush();
	exit($msg);
	
}

function fetch_user_likes($user_id, $likes_limit)
{
	global $user, $auth, $db, $phpEx, $phpbb_root_path;

	if(!function_exists('user_get_id_name'))
	{
		include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
	}
	
	if(!function_exists('censor_text'))
	{
		include($phpbb_root_path . 'includes/functions_content.' . $phpEx);
	}
	
	$sql = 'SELECT l_table.like_id, l_table.poster_id, l_table.post_id, l_table.topic_id, l_table.like_date, p_table.post_text, p_table.bbcode_uid, t_table.topic_title, t_table.forum_id 
		FROM ' . LIKES_TABLE . ' as l_table 
		INNER JOIN ' . POSTS_TABLE . ' as p_table ON l_table.post_id = p_table.post_id 
		INNER JOIN ' . TOPICS_TABLE . ' as t_table ON p_table.topic_id = t_table.topic_id 
		WHERE l_table.user_id = '. (int) $user_id .' 
		ORDER BY l_table.like_date DESC ';
	$result = $db->sql_query_limit($sql, $likes_limit);
	
	$likes_array = array();
	
	while($row = $db->sql_fetchrow($result))
	{
		if($auth->acl_get('f_read', $row['forum_id'])) {
			
			$username_array = array();
			$uid_array = array($row['poster_id']);
			
			user_get_id_name($uid_array, $username_array);
			
			$topic_url_params = "f=".$row['forum_id']."&amp;t=".$row['topic_id']."&amp;p=".$row['post_id']."#p" . $row['post_id'];
			$topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", $topic_url_params);
			
			$post_text = censor_text($row['post_text']);
			
			if($row['bbcode_uid'])
			{
				strip_bbcode($post_text, $row['bbcode_uid']);
			}
			
			$post_text = get_context($post_text, array(), 120);
			
			$likes_array[] = array(
				'topic_title' 	=> $row['topic_title'],
				'poster' 		=> $username_array[$row['poster_id']],
				'post_detail'	=> $post_text,
				'date'			=> $user->format_date($row['like_date']),
				'post_url'		=> $topic_url
			);
		}
	}
	
	$db->sql_freeresult($result);

	return array($likes_array);

}

function get_avatar_ajaxlike($avatar, $avatar_type, $avatar_width, $avatar_height, $alt = 'USER_AVATAR')
{
    global $user, $config, $phpbb_root_path, $phpEx;
	
	$new_width = 50;
	$new_height = 50;
	
	// aspect ratio
	if($avatar_width > 1 && $avatar_height > 1)
	{
		$factor = (float)$new_width / (float)$avatar_width;
		$new_height = $factor * $avatar_height;
	}
	
    if (empty($avatar) || !$avatar_type)
    {
    		return '<img src="'.$phpbb_root_path.'images/avatars/ajaxlike_no_avatar.png" width="'.$new_width.'" height="'.$new_height.'" alt="' . ((!empty($user->lang[$alt])) ? $user->lang[$alt] : $alt) . '" />';
    }

    $avatar_img = '';

      switch ($avatar_type)
   {
      case AVATAR_UPLOAD:
      
         $avatar_img = $phpbb_root_path . "download/file.$phpEx?avatar=";
      break;

      case AVATAR_GALLERY:
      
         $avatar_img = $phpbb_root_path . $config['avatar_gallery_path'] . '/';
      break;

      case AVATAR_REMOTE:
      
      break;
    }

    $avatar_img .= $avatar;
    return '<img src="' . $avatar_img . '" width='.$new_width.'"' . $avatar_width . '" height='.$new_height.'"' . $avatar_height . '" alt="' . ((!empty($user->lang[$alt])) ? $user->lang[$alt] : $alt) . '" />';
}

function ajaxlike_user_showlikes_status($uid)
{

	global $db;

	$sql = 'SELECT show_likes 
		FROM  ' . USERS_TABLE . ' 
		WHERE user_id = '. (int) $uid;
	
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if(empty($row))
		return 0;
	else
		return $row['show_likes'];
}

?>