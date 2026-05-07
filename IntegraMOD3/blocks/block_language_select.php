<?php
if (!defined('IN_PHPBB'))
{
	exit;
}

global $user, $template, $phpbb_root_path, $phpEx, $db, $config, $k_blocks;

/*
 * LOAD PORTAL LANGUAGE FILE (fixes FORUM_PORTAL warning)
 */
$user->add_lang('portal/kiss_common');

$current_lang   = $user->data['user_lang'];
$new_lang       = request_var('lang', '');
$make_permanent = request_var('y', 0);

foreach ($k_blocks as &$blk)
{
	if ($blk['html_file_name'] == 'block_language_select.html')
	{
		$blk['title'] = $user->lang['SELECT_LANG'];
	}
}

/*
 * APPLY LANGUAGE IMMEDIATELY + RELOAD LANG FILES
 */
if ($new_lang && is_dir($phpbb_root_path . 'language/' . $new_lang))
{
	if ($new_lang !== $user->data['user_lang'])
	{
		// apply immediately to user + session
		$user->data['user_lang'] = $new_lang;
		$user->lang_name = $new_lang;
		$user->session_lang = $new_lang;

		// reload language system cleanly
		$user->lang = array();
		$user->setup();
		$user->add_lang('portal/kiss_common');
        $user->add_lang('mods/socialnet');

		// persist (always)
		$sql = 'UPDATE ' . USERS_TABLE . "
			SET user_lang = '" . $db->sql_escape($new_lang) . "'
			WHERE user_id = " . (int) $user->data['user_id'];
		$db->sql_query($sql);
	}
}

$lang_count  = 0;
$lang_select = '';
$this_page   = explode('.', $user->page['page']);

// preserve f/t
$appends = '';
$fo = request_var('f', 0);
$to = request_var('t', 0);

if ($fo)
{
	$appends = 'f=' . $fo;
}
if ($to)
{
	$appends .= ($appends ? '&amp;' : '') . 't=' . $to;
}

/*
 * Pretty names + flags
 */
$lang_map = array(
	'en' => array('name' => 'english',     'flag' => 'usa.gif'),
	'fr' => array('name' => 'français',    'flag' => 'france.gif'),
	'de' => array('name' => 'deutsch',     'flag' => 'germany.gif'),
	'es' => array('name' => 'español',     'flag' => 'mexico.gif'),
	'nl' => array('name' => 'nederlands',  'flag' => 'netherlands.gif'),
	'uk' => array('name' => 'українська',  'flag' => 'ukraine.gif'),
);

$lang_dirs = @scandir($phpbb_root_path . 'language/');

if ($lang_dirs !== false)
{
	foreach ($lang_dirs as $dir)
	{
		if ($dir === '.' || $dir === '..')
		{
			continue;
		}

		if (!is_dir($phpbb_root_path . 'language/' . $dir))
		{
			continue;
		}

		$name = isset($lang_map[$dir]['name']) ? $lang_map[$dir]['name'] : strtolower($dir);
		$flag = isset($lang_map[$dir]['flag']) ? $lang_map[$dir]['flag'] : 'unknown.gif';

		$url = append_sid(
			"{$phpbb_root_path}{$this_page[0]}.$phpEx",
			'lang=' . $dir . '&amp;y=1&amp;' . $appends
		);

		++$lang_count;

		$lang_select .= '<option value="' . $url . '" data-flag="' . $flag . '"' .
			($dir === $user->data['user_lang'] ? ' selected="selected"' : '') . '>' .
			htmlspecialchars($name) .
			'</option>';
	}
}

if ($lang_select)
{
	$template->assign_var('LANG_SELECT', $lang_select);
}

$template->assign_vars(array(
	'LANG_COUNT' => $lang_count,
));
