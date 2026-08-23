<?php
if (!defined('IN_PHPBB'))
{
	exit;
}

if (defined('BLOCK_LANGUAGE_SELECT_RUN'))
{
	return;
}
define('BLOCK_LANGUAGE_SELECT_RUN', true);

global $user, $template, $phpbb_root_path, $phpEx, $db, $config, $k_blocks;

/*
 * LOAD PORTAL LANGUAGE FILE (fixes FORUM_PORTAL warning)
 */
$user->add_lang('portal/kiss_common');

$current_lang   = $user->data['user_lang'];
$new_lang       = request_var('lang', '');
$make_permanent = request_var('y', 0);

// Initialize guest language if they are anonymous
if ($user->data['user_id'] == ANONYMOUS)
{
	$cookie_name = $config['cookie_name'] . '_lang';
	$cookie_lang = request_var($cookie_name, '', false, true);
	$guest_lang = $cookie_lang ? $cookie_lang : $config['default_lang'];

	if ($guest_lang !== $user->data['user_lang'])
	{
		$user->data['user_lang'] = $guest_lang;
		$user->lang_name = $guest_lang;
		$user->session_lang = $guest_lang;

		// reload language system cleanly
		$user->lang = array();
		$user->setup();
		$user->add_lang('portal/kiss_common');
		$user->add_lang('mods/socialnet');
	}
}

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

		if ($user->data['user_id'] != ANONYMOUS)
		{
			// persist (always)
			$sql = 'UPDATE ' . USERS_TABLE . "
				SET user_lang = '" . $db->sql_escape($new_lang) . "'
				WHERE user_id = " . (int) $user->data['user_id'];
			$db->sql_query($sql);
		}
		else
		{
			// persist in cookie for guests
			$user->set_cookie('lang', $new_lang, time() + 31536000);
		}
	}
}

$lang_count  = 0;
$lang_select = '';

$page_name = !empty($user->page['page_name']) ? $user->page['page_name'] : 'index.php';

$queryParams = array();
if (!empty($user->page['query_string']))
{
	parse_str($user->page['query_string'], $queryParams);
}
// remove lang, y, and sid
unset($queryParams['lang']);
unset($queryParams['y']);
unset($queryParams['sid']);

$appends = '';
if (!empty($queryParams))
{
	$appends = http_build_query($queryParams, '', '&amp;');
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

// Determine the language to display as selected: use the effective loaded
// language ($user->lang_name). For guests this is the board default unless
// they explicitly chose another language (cookie / lang parameter).
$active_lang = ($user->lang_name && is_dir($phpbb_root_path . 'language/' . basename($user->lang_name))) ? basename($user->lang_name) : basename($config['default_lang']);

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
			"{$phpbb_root_path}{$page_name}",
			'lang=' . $dir . '&amp;y=1' . ($appends ? '&amp;' . $appends : '')
		);

		++$lang_count;

		$lang_select .= '<option value="' . $url . '" data-flag="' . $flag . '"' .
			($dir === $active_lang ? ' selected="selected"' : '') . '>' .
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
