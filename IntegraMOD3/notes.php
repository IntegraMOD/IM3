<?php

/** 
*
* @mod package		Notes Mod 2
* @file				notes.php 4 2009/06/16 OXPUS
* @copyright		(c) 2008 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
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
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/bbcode.' . $phpEx);
include($phpbb_root_path . 'includes/functions_notes.' . $phpEx);

/*
* session management
*/
$user->session_begin();
$auth->acl($user->data);
$user->setup();

/*
* Prevent guest access
*/
if ( !$user->data['is_registered'] )
{
	redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
}

// Init timezone to neutral zone to avoid differences between save, edit and display reminder times
date_default_timezone_set('UTC');
$config['board_timezone'] = 'UTC';
$userdata['user_timezone'] = 'UTC';

/*
* Get the variable contents
*/
$submit				= request_var('submit', '');
$cancel				= request_var('cancel', '');
$sql_order			= request_var('sort_order', 'ASC');
$sql_order_by		= request_var('sort_by', 'note_time');
$search_keywords	= request_var('search_string', '', true);
$sql_search_in		= request_var('search_in', '');
$mode				= request_var('mode', '');
$note_id			= request_var('note_id', 0);
$note_subject		= utf8_normalize_nfc(request_var('subject', '', true));
$note_message		= utf8_normalize_nfc(request_var('message', '', true));
$note_mem_day		= request_var('mem_day', 0);
$note_mem_month		= request_var('mem_month', 0);
$note_mem_year		= request_var('mem_year', 0);
$note_mem_hour		= request_var('mem_hour', 0);
$note_mem_minute	= request_var('mem_minute', 0);
$note_mem_yesno		= request_var('mem_yesno', 0);
$note_mem_drop		= request_var('mem_drop', 0);
$note_mem_time		= request_var('mem_time', 0);

if ($cancel)
{
	$mode = '';
}

$notes_data = array();
$display_notes = 0;

if ($mode == 'delete')
{
	$sql = "DELETE FROM " . NOTES_TABLE . "
			WHERE " . $db->sql_build_array('SELECT', array(
				'note_id' => $note_id,
				'note_user_id' => $user->data['user_id'],
			));
	$db->sql_query($sql);

	$mode = '';
}

/*
* Output page header
*/
if ( $user->data['user_popup_notes'] == true )
{
	$template->assign_var('S_NOTES_POPUP', true);
}

/*
* Check the number of notes for this user
*/
$sql = "SELECT count(note_id) AS total FROM " . NOTES_TABLE . "
	WHERE " . $db->sql_build_array('SELECT', array(
				'note_user_id' => $user->data['user_id'],
			));
$result = $db->sql_query($sql);
$total_notes = intval($db->sql_fetchfield('total'));
$db->sql_freeresult($result);

if ($total_notes < $config['notes'])
{
	$template->assign_var('S_NEW_NOTE', true);
	$allow_new_note = true;
}
else
{
	$allow_new_note = false;
}

/*
* Load needed template
*/
if ($mode == 'new_note' || $mode == 'edit_note')
{
	$body = 'note_edit_body.html';
}
else
{
	$body = 'note_list_body.html';

	/*
	* Prepare sort, search and filter 
	*/
	$sort_order = '<select name="sort_order" class="selectbox">';
	$sort_order .= '<option value="ASC">'.$user->lang['ASCENDING'].'</option>';
	$sort_order .= '<option value="DESC">'.$user->lang['DESCENDING'].'</option>';
	$sort_order .= '</select>';
	$sort_order = str_replace('value="'.$sql_order.'">', 'value="'.$sql_order.'" selected="selected">', $sort_order);
	
	$sort_by = '<select name="sort_by" class="selectbox">';
	$sort_by .= '<option value="note_subject">'.$user->lang['SUBJECT'].'</option>';
	$sort_by .= '<option value="note_time">'.$user->lang['TIME'].'</option>';
	$sort_by .= '<option value="note_mem">'.$user->lang['NOTES_MEM'].'</option>';
	$sort_by .= '</select>';
	$sort_by = str_replace('value="'.$sql_order_by.'">', 'value="'.$sql_order_by.'" selected="selected">', $sort_by);
	
	$search_in = '<select name="search_in" class="selectbox">';
	$search_in .= '<option value="note_subject">'.$user->lang['SUBJECT'].'</option>';
	$search_in .= '<option value="note_text">'.$user->lang['POST'].'</option>';
	$search_in .= '</select>';
	
	$search_in = str_replace('value="'.$sql_search_in.'">', 'value="'.$sql_search_in.'" selected="selected">', $search_in);
	
	$sql_search = '';
	
	/*
	* Prepare search terms
	*/
	if ( $search_keywords != '' )
	{
		$split_search = array();
		$sql_search_terms = '';
		$split_search = split(' ', $search_keywords);
	
		foreach($split_search as $search_word)
		{
			$search_word = utf8_encode($search_word);

			$sql_search_terms .= ( $sql_search_terms != '' ) ? ' OR LOWER(CONVERT(' . $sql_search_in . ' USING latin1)) LIKE (\'%'.$search_word . '%\') ' : ' LOWER(CONVERT(' . $sql_search_in . ' USING latin1)) LIKE (\'%' . $search_word . '%\') ';
		}
	
		$sql_search = ' AND (' . $sql_search_terms . ')';
	}
	else
	{
		$sql_search = '';
	}

	$sql_search .= ($sql_order_by == 'note_mem') ? ' AND note_mem <> 0 ' : '';
	$sql_search .= ($note_mem_time) ? " AND note_mem <= $note_mem_time AND note_mem <> 0 AND note_memx = 1 " : '';
 
	/*
	* Go ahead and pull all data for the notes
	*/
	$sql = "SELECT * FROM " . NOTES_TABLE . "
		WHERE note_user_id = " . $user->data['user_id'] . "
		$sql_search
		ORDER BY $sql_order_by $sql_order";
	$result = $db->sql_query($sql);

	$display_notes = $db->sql_affectedrows($result);
	
	while ($row = $db->sql_fetchrow($result))
	{
		$notes_data[] = $row;
	}

	$db->sql_freeresult($result);
}

$template->set_filenames(array(
	'body' => $body)
);

if ($mode == 'save' && $allow_new_note)
{
	// check form
	if (!check_form_key('posting'))
	{
		trigger_error($user->lang['FORM_INVALID'], E_USER_WARNING);
	}

	// prepare note before save
	$allow_bbcode	= ($config['allow_bbcode']) ? true : false;
	$allow_urls		= true;
	$allow_smilies	= ($config['allow_smilies']) ? true : false;
	$uid = $bitfield = '';
	$flags = 0;

	generate_text_for_storage($note_message, $uid, $bitfield, $flags, $allow_bbcode, $allow_urls, $allow_smilies);

	if ($note_mem_yesno)
	{
		$note_mem = mktime($note_mem_hour, $note_mem_minute, 0, $note_mem_month, $note_mem_day, $note_mem_year);
	}
	else
	{
		$note_mem = 0;
	}

	// Save new/edited note
	if ($note_id)
	{
		$sql = "UPDATE " . NOTES_TABLE . " SET " . $db->sql_build_array('UPDATE', array(
			'note_subject' => $note_subject,
			'note_text' => $note_message,
			'note_uid' => $uid,
			'note_bitfield' => $bitfield,
			'note_flags' => $flags,
			'note_mem' => $note_mem,
			'note_memx' => (($note_mem) ? 1 : 0))) . 
			" WHERE " . $db->sql_build_array('SELECT', array(
				'note_id' => $note_id,
			));
	}
	else
	{
		$sql = "SELECT MAX(note_id) AS max_id FROM " . NOTES_TABLE;
		$result = $db->sql_query($sql);
		$note_id = $db->sql_fetchfield('max_id') + 1;
		$db->sql_freeresult($result);

		$sql = "INSERT INTO " . NOTES_TABLE . "  " . $db->sql_build_array('INSERT', array(
			'note_id' => $note_id,
			'note_user_id' => $user->data['user_id'],
			'note_subject' => $note_subject,
			'note_text' => $note_message,
			'note_time' => time(),
			'note_uid' => $uid,
			'note_bitfield' => $bitfield,
			'note_flags' => (int) $flags,
			'note_mem' => $note_mem,
			'note_memx' => (($note_mem) ? 1 : 0) 
			));
	}

	$db->sql_query($sql);

	redirect(append_sid("{$phpbb_root_path}notes.$phpEx"));
}

page_header($user->lang['NOTES']);

if (($mode == 'new_note' && $allow_new_note) || $mode == 'edit_note')
{
	// First secure the form ...
	add_form_key('posting');

	// Status for HTML, BBCode, Smilies, Images and Flash,
	$bbcode_status	= ($config['allow_bbcode']) ? true : false;
	$smilies_status	= ($bbcode_status && $config['allow_smilies']) ? true : false;
	$img_status		= false;
	$url_status		= ($config['allow_post_links']) ? true : false;
	$flash_status	= false;
	$quote_status	= true;
	
	// Smilies Block,
	include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
	generate_smilies('inline', 0);

	// BBCode-Block,
	$user->add_lang('posting');
	display_custom_bbcodes();

	// Hidden Fields,
	$s_hidden_fields = array(
		'mode' => 'save',
	);

	$s_note_mem_day = '<select name="mem_day">';
	for ($i = 1; $i <= 31; $i++)
	{
		$s_note_mem_day .= '<option value="' . $i . '">' . $i . '</option>';
	}
	$s_note_mem_day .= '</select>';

	$s_note_mem_month = '<select name="mem_month">';
	for ($i = 1; $i <= 13; $i++)
	{
		$s_note_mem_month .= '<option value="' . $i . '">' . $i . '</option>';
	}
	$s_note_mem_month .= '</select>';
	
	$s_note_mem_year = '<select name="mem_year">';
	for ($i = intval(date('Y')); $i <= intval(date('Y')) + 9; $i++)
	{
		$s_note_mem_year .= '<option value="' . $i . '">' . $i . '</option>';
	}
	$s_note_mem_year .= '</select>';
	
	$s_note_mem_hour = '<select name="mem_hour">';
	for ($i = 0; $i <= 23; $i++)
	{
		$s_note_mem_hour .= '<option value="' . $i . '">' . $i . '</option>';
	}
	$s_note_mem_hour .= '</select>';

	$s_note_mem_minute = '<select name="mem_minute">';
	for ($i = 0; $i <= 59; $i++)
	{
		$s_note_mem_minute .= '<option value="' . $i . '">' . $i . '</option>';
	}
	$s_note_mem_minute .= '</select>';

	if ($mode == 'edit_note')
	{
		$s_hidden_fields = array_merge($s_hidden_fields, array(
			'note_id' => $note_id,
		));

		// At least get the post content for note to edit, if wanted...
		$sql = "SELECT * FROM " . NOTES_TABLE . "
			WHERE " . $db->sql_build_array('SELECT', array('note_id' => $note_id));
		$result = $db->sql_query($sql);
	
		$row = $db->sql_fetchrow($result);

		$subject = $row['note_subject'];
		$message = $row['note_text'];
		$uid = $row['note_uid'];
		$flags = $row['note_flags'];

		$db->sql_freeresult($result);

		if ($row['note_mem'])
		{
			$cur_time = $row['note_mem'];
		}
		else
		{
			$cur_time = time();
		}

		$s_check_yes = ($row['note_mem']) ? 'checked="checked"' : '';
		$s_check_no = (!$row['note_mem']) ? 'checked="checked"' : '';

		$text_ary = generate_text_for_edit($message, $uid, $flags);
		$message = $text_ary['text'];		
	}
	else
	{
		$subject = '';
		$message = '';

		$cur_time = time();

		$s_check_yes = '';
		$s_check_no = 'checked="checked"';
	}

	$sort_order = $sort_by = $search_in = '';

	$s_note_mem_day		= str_replace('value="' . date('d', $cur_time) . '">', 'value="' . date('d', $cur_time) . '" selected="selected">', $s_note_mem_day);
	$s_note_mem_month	= str_replace('value="' . date('n', $cur_time) . '">', 'value="' . date('n', $cur_time) . '" selected="selected">', $s_note_mem_month);
	$s_note_mem_year	= str_replace('value="' . date('Y', $cur_time) . '">', 'value="' . date('Y', $cur_time) . '" selected="selected">', $s_note_mem_year);
	$s_note_mem_hour	= str_replace('value="' . date('H', $cur_time) . '">', 'value="' . date('H', $cur_time) . '" selected="selected">', $s_note_mem_hour);
	$s_note_mem_minute	= str_replace('value="' . date('i', $cur_time) . '">', 'value="' . date('i', $cur_time) . '" selected="selected">', $s_note_mem_minute);

	// ... and now prepare the posting form for edit/post the note
	$template->assign_vars(array(
		'L_NOTE_MODE'		=> ($mode == 'new_note') ? $user->lang['NEW_POST'] : $user->lang['EDIT_POST'],

		'NOTES_SUBJECT'		=> $subject,
		'NOTES_MESSAGE'		=> $message,

		'MEM_CHECKED_YES'	=> $s_check_yes,
		'MEM_CHECKED_NO'	=> $s_check_no,

		'S_NOTE_MEM_HOUR'	=> $s_note_mem_hour,
		'S_NOTE_MEM_MIN'	=> $s_note_mem_minute,
		'S_NOTE_MEM_DAY'	=> $s_note_mem_day,
		'S_NOTE_MEM_MONTH'	=> $s_note_mem_month,
		'S_NOTE_MEM_YEAR'	=> $s_note_mem_year,

		'S_BBCODE_ALLOWED'	=> $bbcode_status,
		'S_BBCODE_IMG'		=> $img_status,
		'S_BBCODE_URL'		=> $url_status,
		'S_BBCODE_FLASH'	=> $flash_status,
		'S_BBCODE_QUOTE'	=> $quote_status,

		'S_FORM_ACTION'		=> append_sid("{$phpbb_root_path}downloads.$phpEx"),
		'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),

		'U_MORE_SMILIES'	=> append_sid("{$phpbb_root_path}posting.$phpEx?mode=smilies"))
	);
}

$user->add_lang('search');

/*
* Send vars to template
*/
$template->assign_vars(array(
	'L_NOTES_TOTAL'		=> $total_notes . ' / ' . $config['notes'],
	'L_DELETE_NOTE'		=> $user->lang['DELETE'],
	'L_EDIT_NOTE'		=> $user->lang['CHANGE'],
	'L_SEARCH'			=> ($search_keywords == '') ? $user->lang['SEARCH'] : $user->lang['SEARCH'].'*',
	'L_FILTER'			=> ($search_keywords != '' || $sql_order_by == 'note_mem') ? $user->lang['FILTER_NOTES'] : '',
	'L_SORT'			=> $user->lang['SORT_BY'],
	'L_NO_NOTES'		=> ($total_notes) ? $user->lang['NO_SEARCH_RESULTS'] : $user->lang['NO_NOTES'],
	'L_ADD_NOTE'		=> $user->lang['NEW_POST'],

	'L_CLOSE'			=> $user->lang['CLOSE_WINDOW'],

	'SORT_ORDER'		=> $sort_order,
	'SORT_BY'			=> $sort_by,
	'SEARCH_IN'			=> $search_in,

	'S_FORM_ACTION'		=> append_sid("{$phpbb_root_path}notes.$phpEx"),

	'U_NEW_NOTE'		=> append_sid("{$phpbb_root_path}notes.$phpEx?mode=new_note"))
);

/*
* And now put the notes out ... Yeah let the notes out ... bump bump bump ...
*/
if ($mode == '' || !$allow_new_note)
{
	if ($display_notes)
	{
		for($i = 0; $i < $display_notes; $i++)
		{
			$note_date = notes_format_date($notes_data[$i]['note_time'], $user);
			$subject = $notes_data[$i]['note_subject'];
			$message = $notes_data[$i]['note_text'];
	
			$uid = $notes_data[$i]['note_uid'];
			$bitfield = $notes_data[$i]['note_bitfield'];
			$flags = $notes_data[$i]['note_flags'];
	
			$message = censor_text($message);
			$subject = censor_text($subject);
	
			$message = generate_text_for_display($message, $uid, $bitfield, $flags);
	
			if ($search_keywords != '')
			{
				foreach($split_search as $search_word)
				{
					$message = preg_replace('#(?!<.*)(' . utf8_normalize_nfc($search_word) . ')(?![^<>]*>)#is', '<span class="posthilit">\1</span>', $message);
				}
			}
	
			$message = str_replace("\n", "\n<br />\n", $message);
	
			$u_edit = append_sid("{$phpbb_root_path}notes.$phpEx?mode=edit_note&amp;note_id=" . $notes_data[$i]['note_id']);
			$u_del = append_sid("{$phpbb_root_path}notes.$phpEx?mode=delete&amp;note_id=" . $notes_data[$i]['note_id']);

			if ($notes_data[$i]['note_mem'])
			{
				$notes_mem = notes_format_date($notes_data[$i]['note_mem'], $user);
			}
			else
			{
				$notes_mem = '';
			}
	
			$template->assign_block_vars('notes_row', array(
				'NOTE_DATE' 	=> $note_date,
				'NOTE_SUBJECT'	=> $subject,
				'NOTE_TEXT' 	=> $message,
				'NOTES_MEM'		=> $notes_mem,
				'U_DELETE_NOTE'	=> $u_del,
				'U_EDIT_NOTE'	=> $u_edit)
			);
		}
	}
	else
	{
		$template->assign_var('S_NO_NOTES', true);
	}

	if ($note_mem_drop)
	{
		$sql = 'UPDATE ' . NOTES_TABLE . ' SET ';
		$sql .= $db->sql_build_array('UPDATE', array(
			'note_memx' => 0));
		$sql .= ' WHERE note_mem <= ' . $note_mem_time;
		$sql .= ' AND note_user_id = ' . $user->data['user_id'];
		$db->sql_query($sql);
	}
}

page_footer();

?>