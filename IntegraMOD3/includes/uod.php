<?php
/**
*
* @package phpBB3 users of the day mod
* @version   0.0.2
* @copyright (c) 2007 sanis
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

$display_not_day_userlist = 0;	// change to 1 here if you also want the list of the users who didn't visit to be displayed
$users_list_delay = 24;		// change here to the number of hours wanted for the list

    $sql = 'SELECT user_id, username, user_allow_viewonline, user_lastrefresh , user_colour
    FROM ' . USERS_TABLE . '
    WHERE user_id <> ' . ANONYMOUS . '
        AND ' . $db->sql_in_set('user_type', array(USER_NORMAL, USER_FOUNDER)) . '
    ORDER BY user_lastrefresh DESC';
	if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain user/day information', '', __LINE__, __FILE__, $sql);
}
$day_userlist = '';
$day_users = 0;
$not_day_userlist = '';
$not_day_users = 0;

while( $row = $db->sql_fetchrow($result) )
{
	
	if ( $row['user_allow_viewonline'] )
	{
		$user_day_link = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $user->lang['GUEST']);
	}
	else
	{
			$user_day_link = '<i>' . get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $user->lang['GUEST']) . '</i>';
  }
	if ( $row['user_allow_viewonline'] || $auth->acl_get('u_viewonline') )
	{
		if ( $row['user_lastrefresh'] >= ( time() - $users_list_delay * 3600 ) )
		{
			$day_userlist .= ( $day_userlist != '' ) ? ', ' . $user_day_link : $user_day_link;
			$day_users++;
		}
		else
		{
			$not_day_userlist .= ( $not_day_userlist != '' ) ? ', ' . $user_day_link : $user_day_link;
			$not_day_users++;
		}
	}
}

$day_userlist = ( ( isset($forum_id) ) ? '' : sprintf($user->lang['DAY_USERS'], $day_users, $users_list_delay) ) . ' ' . $day_userlist;

$not_day_userlist = ( ( isset($forum_id) ) ? '' : sprintf($user->lang['NOT_DAY_USERS'], $not_day_users, $users_list_delay) ) . ' ' . $not_day_userlist;

if ( $display_not_day_userlist )
{
	$day_userlist .= '<br />' . $not_day_userlist;
}

if (!$user->data['is_registered'])
{
    if ($user->data['is_bot'])
    {

        
    }

    
}
else
{

    $sql = 'UPDATE ' . USERS_TABLE . '
                SET user_lastrefresh = ' . (int) time() . '
                WHERE user_id = ' . (int) $user->data['user_id'];
$db->sql_query($sql);
}
?>
