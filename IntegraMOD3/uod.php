<?php
/**
*
* @package phpBB3 users of the day mod
* @version   0.0.2
* @copyright (c) 2007 sanis
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

require($phpbb_root_path . 'includes/uod.' . $phpEx);

$template->assign_vars(array(
   'USERS_OF_THE_DAY_LIST' => $day_userlist,
));

// Output the page
page_header('Users of the day');


$template->set_filenames(array(
   'body' => 'uod.html')
);

page_footer();

?>
