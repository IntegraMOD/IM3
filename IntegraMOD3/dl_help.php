<?php

/**
*
* @mod package		Download Mod 6
* @file				dl_help.php 4 2011/05/31 OXPUS
* @copyright		(c) 2005 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/*
* connect to phpBB
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

/*
* session management
*/
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/dl_help');

$help_key	= request_var('help_key', '');
$value		= request_var('value', '');
$value = ($value == 'undefined') ? '' : $value;

//
// Pull all user config data
//
if ($help_key && isset($user->lang['HELP_' . $help_key]))
{
	$help_string = $user->lang['HELP_' . $help_key];
}
else
{
	$help_string = $user->lang['DL_NO_HELP_AVIABLE'];
}

if ($value)
{
	$help_key = $value;
}

if ($value)
{
	$help_option = $help_key;
}
else if (isset($user->lang[$help_key]))
{
	$help_option = $user->lang[$help_key];
}
else
{
	$help_option = '';
}

$template->assign_vars(array(
	'L_CLOSE' => $user->lang['CLOSE_WINDOW'],

	'HELP_TITLE' => $user->lang['HELP_TITLE'],
	'HELP_OPTION' => $help_option,
	'HELP_STRING' => $help_string)
);

page_header($user->lang['HELP_TITLE'], false);

$template->set_filenames(array(
	'body' => 'dl_mod/dl_help_body.html')
);

page_footer();

?>