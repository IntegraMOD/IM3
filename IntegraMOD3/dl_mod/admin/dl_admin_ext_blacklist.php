<?php

/**
*
* @mod package		Download Mod 6
* @file				dl_admin_ext_blacklist.php 8 2011/05/05 OXPUS
* @copyright		(c) 2006 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/*
* connect to phpBB
*/
if ( !defined('IN_PHPBB') )
{
	exit;
}

if ($cancel)
{
	$action = '';
}

if($action == 'add')
{
	$extention = request_var('extention', '');

	if (!check_form_key('dl_adm_ext'))
	{
		trigger_error('FORM_INVALID', E_USER_WARNING);
	}

	if ($extention)
	{
		$sql = 'SELECT * FROM ' . DL_EXT_BLACKLIST . "
			WHERE extention = '" . $db->sql_escape($extention) . "'";
		$result = $db->sql_query($sql);
		$ext_exist = $db->sql_affectedrows($result);
		$db->sql_freeresult($result);

		if (!$ext_exist)
		{
			$sql = 'INSERT INTO ' . DL_EXT_BLACKLIST . ' ' . $db->sql_build_array('INSERT', array(
				'extention' => $extention));
			$db->sql_query($sql);

			// Purge the blacklist cache
			@unlink($phpbb_root_path . 'cache/data_dl_black.' . $phpEx);

			add_log('admin', 'DL_LOG_EXT_ADD', $extention);
		}
	}

	$action = '';
}

if($action == 'delete')
{
	if (!check_form_key('dl_adm_ext'))
	{
		trigger_error('FORM_INVALID', E_USER_WARNING);
	}

	$extention = request_var('extention', array(''));

	$confirm_delete = false;

	if (!$confirm)
	{
		$template->set_filenames(array(
			'confirm_body' => 'dl_mod/dl_confirm_body.html')
		);

		$s_hidden_fields = array('action' => 'delete');

		for ($i = 0; $i < sizeof($extention); $i++)
		{
			$s_hidden_fields = array_merge($s_hidden_fields, array('extention[' . $i . ']' => htmlspecialchars($extention[$i])));
		}

		add_form_key('dl_adm_ext');

		$template->assign_vars(array(
			'MESSAGE_TITLE' => $user->lang['INFORMATION'],
			'MESSAGE_TEXT' => (sizeof($extention) == 1) ? sprintf($user->lang['DL_CONFIRM_DELETE_EXTENTION'], $extention[0]) : sprintf($user->lang['DL_CONFIRM_DELETE_EXTENTIONS'], implode(', ', $extention)),

			'L_DELETE_FILE_TOO' => (sizeof($extention) == 1) ? $user->lang['DL_DELETE_EXTENTION_CONFIRM'] : $user->lang['DL_DELETE_EXTENTIONS_CONFIRM'],

			'S_CONFIRM_ACTION' => $basic_link,
			'S_HIDDEN_FIELDS' => build_hidden_fields($s_hidden_fields))
		);

		$template->assign_var('S_DL_CONFIRM', true);

		$template->assign_display('confirm_body');

		$confirm_delete = true;
	}
	else
	{
		if (!check_form_key('dl_adm_ext'))
		{
			trigger_error('FORM_INVALID', E_USER_WARNING);
		}

		$sql_ext_in = array();

		for ($i = 0; $i < sizeof($extention); $i++)
		{
			$sql_ext_in[] = htmlspecialchars($extention[$i]);
		}

		if (sizeof($sql_ext_in))
		{
			$sql = 'DELETE FROM ' . DL_EXT_BLACKLIST . '
				WHERE ' . $db->sql_in_set('extention', $sql_ext_in);
			$db->sql_query($sql);

			// Purge the blacklist cache
			@unlink($phpbb_root_path . 'cache/data_dl_black.' . $phpEx);

			add_log('admin', 'DL_LOG_EXT_DEL', implode(', ', $sql_ext_in));

			$message = ((sizeof($extention) == 1) ? $user->lang['EXTENTION_REMOVED'] : $user->lang['EXTENTIONS_REMOVED']) . "<br /><br />" . sprintf($user->lang['CLICK_RETURN_EXTBLACKLISTADMIN'], '<a href="' . $basic_link . '">', '</a>') . adm_back_link($this->u_action);

			trigger_error($message);
		}

		$action = '';
	}
}

if ($action == '')
{
	$template->set_filenames(array(
		'ext_bl' => 'dl_mod/dl_ext_blacklist_body.html')
	);

	$sql = 'SELECT extention FROM ' . DL_EXT_BLACKLIST . '
		ORDER BY extention';
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$template->assign_block_vars('extention_row', array(
			'EXTENTION' => $row['extention'])
		);
	}

	$ext_yes = ($db->sql_affectedrows($result)) ? true : false;

	$db->sql_freeresult($result);

	add_form_key('dl_adm_ext');

	$template->assign_vars(array(
		'S_EXT_YES'				=> $ext_yes,
		'S_DOWNLOADS_ACTION'	=> $basic_link)
	);
}

if (!isset($confirm_delete))
{
	$template->assign_var('S_DL_BLACKLIST', true);

	$template->assign_display('ext_bl');
}

?>