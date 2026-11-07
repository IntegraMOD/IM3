<?php
/**
*
* ID-stable pretty URLs. The slug is cosmetic; routing never looks up a title.
*
* @package IntegraMOD
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

if (!defined('IM3_SEO_URLS'))
{
	define('IM3_SEO_URLS', true);
}

/**
* Master switch. Define IM3_SEO_URLS as false before common.php to disable.
*/
function im3_seo_enabled()
{
	return (defined('IM3_SEO_URLS') && IM3_SEO_URLS);
}

/**
* Lowercase hyphenated ASCII slug. Empty when the title has no ASCII letters or digits.
*/
function im3_seo_slug($text)
{
	$text = (string) $text;

	if ($text === '')
	{
		return '';
	}

	if (function_exists('utf8_clean_string'))
	{
		$text = utf8_clean_string($text);
	}
	else
	{
		$text = strtolower($text);
	}

	$text = preg_replace('/[^a-z0-9]+/', '-', $text);
	$text = trim($text, '-');

	if (strlen($text) > 80)
	{
		$text = rtrim(substr($text, 0, 80), '-');
	}

	return $text;
}

/**
* Remember a title already loaded for this request. Never queries the database.
*/
function im3_seo_register($kind, $id, $title)
{
	$id = (int) $id;

	if ($id < 1)
	{
		return;
	}

	if (!isset($GLOBALS['im3_seo_slugs']) || !is_array($GLOBALS['im3_seo_slugs']))
	{
		$GLOBALS['im3_seo_slugs'] = array();
	}

	$GLOBALS['im3_seo_slugs'][$kind][$id] = im3_seo_slug($title);
}

/**
* @return string|null Null when this request has not seen the title.
*/
function im3_seo_lookup($kind, $id)
{
	$id = (int) $id;

	if (isset($GLOBALS['im3_seo_slugs'][$kind][$id]))
	{
		return $GLOBALS['im3_seo_slugs'][$kind][$id];
	}

	return null;
}

/**
* One title lookup when a link is built before the page registered the title.
* Cached for the rest of the request so a block does not query once per link.
*/
function im3_seo_ensure($kind, $id)
{
	$id = (int) $id;
	$slug = im3_seo_lookup($kind, $id);

	if ($slug !== null || $id < 1 || ($kind !== 't' && $kind !== 'f' && $kind !== 'u'))
	{
		return $slug;
	}

	global $db;

	if (!isset($db) || !is_object($db))
	{
		return null;
	}

	$title = '';

	if ($kind === 't')
	{
		$sql = 'SELECT topic_title AS im3_seo_title
			FROM ' . TOPICS_TABLE . '
			WHERE topic_id = ' . $id;
	}
	else if ($kind === 'f')
	{
		$sql = 'SELECT forum_name AS im3_seo_title
			FROM ' . FORUMS_TABLE . '
			WHERE forum_id = ' . $id;
	}
	else
	{
		$sql = 'SELECT username AS im3_seo_title
			FROM ' . USERS_TABLE . '
			WHERE user_id = ' . $id;
	}

	$result = $db->sql_query($sql);
	$title = $db->sql_fetchfield('im3_seo_title');
	$db->sql_freeresult($result);

	if ($title === false || $title === null || $title === '')
	{
		im3_seo_register($kind, $id, '');
		return '';
	}

	im3_seo_register($kind, $id, $title);

	return im3_seo_lookup($kind, $id);
}

function im3_seo_id($value)
{
	if (is_array($value) || !preg_match('/^[0-9]+$/', (string) $value))
	{
		return 0;
	}

	$id = (int) $value;

	if ($id < 1 || $id > 16777215)
	{
		return 0;
	}

	return $id;
}

function im3_seo_path($kind, $id, $slug)
{
	$id = (int) $id;
	$slug = ($slug !== null && $slug !== '') ? '-' . $slug : '';

	if ($kind === 'f' || $kind === 'u')
	{
		return $kind . $id . $slug . '/';
	}

	if ($kind === 't')
	{
		return 't' . $id . $slug . '.html';
	}

	return 'p' . $id;
}

function im3_seo_prefix($url)
{
	$path = $url;
	$query = strpos($path, '?');

	if ($query !== false)
	{
		$path = substr($path, 0, $query);
	}

	$slash = strrpos($path, '/');

	if ($slash === false)
	{
		return '';
	}

	return substr($path, 0, $slash + 1);
}

function im3_seo_script($url)
{
	$path = $url;
	$query = strpos($path, '?');

	if ($query !== false)
	{
		$path = substr($path, 0, $query);
	}

	return strtolower(basename(str_replace('\\', '/', $path)));
}

/**
* Predefined searches. Key is search_id; value is the public path token.
*
* @return array
*/
function im3_seo_search_map()
{
	return array(
		'newposts'		=> 'newposts',
		'egosearch'		=> 'egosearch',
		'unanswered'	=> 'unanswered',
		'unreadposts'	=> 'unreadposts',
		'active_topics'	=> 'active-topics',
	);
}

function im3_seo_parse_params($url, $params)
{
	$merged = array();
	$query = parse_url($url, PHP_URL_QUERY);

	if (is_string($query) && $query !== '')
	{
		$parsed = array();
		parse_str(str_replace('&amp;', '&', $query), $parsed);

		if (is_array($parsed))
		{
			$merged = $parsed;
		}
	}

	if (is_array($params))
	{
		foreach ($params as $key => $value)
		{
			if ($key === '#')
			{
				continue;
			}

			$merged[$key] = $value;
		}
	}
	else if (is_string($params) && $params !== '')
	{
		$parsed = array();
		parse_str(str_replace('&amp;', '&', $params), $parsed);

		if (is_array($parsed))
		{
			foreach ($parsed as $key => $value)
			{
				$merged[$key] = $value;
			}
		}
	}

	return $merged;
}

/**
* Rewrite a whitelisted append_sid() target. Returns null to keep the classic URL.
*/
function im3_seo_rewrite($url, $params, $is_amp, $session_id, $anchor)
{
	global $_SID, $_EXTRA_URL;

	$style_extra = '';

	if (!empty($_EXTRA_URL))
	{
		foreach ($_EXTRA_URL as $extra)
		{
			if (preg_match('/^style=([0-9]+)$/', (string) $extra, $style_match))
			{
				$style_extra = 'style=' . (int) $style_match[1];
				continue;
			}

			return null;
		}
	}

	if (!im3_seo_enabled() || $session_id !== false || $_SID !== '')
	{
		return null;
	}

	if (strpos($url, '/adm/') !== false || strpos($url, 'adm/') === 0)
	{
		return null;
	}

	$script = im3_seo_script($url);

	if ($script === 'search.php')
	{
		return im3_seo_rewrite_search($url, $params, $is_amp, $anchor, $style_extra);
	}

	if (!in_array($script, array('viewforum.php', 'viewtopic.php', 'memberlist.php'), true))
	{
		return null;
	}

	$merged = im3_seo_parse_params($url, $params);
	$allowed = array('f', 't', 'p', 'u', 'start', 'mode', 'style', 'view', 'hilit');

	foreach ($merged as $key => $value)
	{
		if ($value === '' || $value === null || $value === false)
		{
			continue;
		}

		if (is_array($value) || !in_array($key, $allowed, true))
		{
			return null;
		}

		if ($key === 'view' && (string) $value !== 'unread')
		{
			return null;
		}

		if ($key === 'hilit' && (strlen((string) $value) > 200 || preg_match('/[\x00-\x1F]/', (string) $value)))
		{
			return null;
		}
	}

	$forum_id = isset($merged['f']) ? im3_seo_id($merged['f']) : 0;
	$topic_id = isset($merged['t']) ? im3_seo_id($merged['t']) : 0;
	$post_id = isset($merged['p']) ? im3_seo_id($merged['p']) : 0;
	$user_id = isset($merged['u']) ? im3_seo_id($merged['u']) : 0;
	$start = isset($merged['start']) ? (int) $merged['start'] : 0;
	$mode = isset($merged['mode']) ? (string) $merged['mode'] : '';

	if ($mode !== '' && $mode !== 'viewprofile')
	{
		return null;
	}

	$kind = '';
	$id = 0;
	$keep_forum = false;

	if ($script === 'viewforum.php' && $forum_id && !$topic_id && !$post_id && !$user_id)
	{
		$kind = 'f';
		$id = $forum_id;
	}
	else if ($script === 'viewtopic.php' && $topic_id)
	{
		// Keep the topic slug when a search row also points at the latest post.
		$kind = 't';
		$id = $topic_id;
		$keep_forum = ($forum_id > 0);
	}
	else if ($script === 'viewtopic.php' && $post_id)
	{
		$kind = 'p';
		$id = $post_id;
		$keep_forum = ($forum_id > 0);
	}
	else if ($script === 'memberlist.php' && $mode === 'viewprofile' && $user_id)
	{
		$kind = 'u';
		$id = $user_id;
	}
	else
	{
		return null;
	}

	$slug = im3_seo_ensure($kind, $id);
	$path = im3_seo_path($kind, $id, $slug);
	$query = array();

	if ($keep_forum)
	{
		$query[] = 'f=' . $forum_id;
	}

	if ($kind === 't' && $post_id)
	{
		$query[] = 'p=' . $post_id;
	}

	if ($start > 0)
	{
		$query[] = 'start=' . $start;
	}

	if (isset($merged['view']) && (string) $merged['view'] === 'unread')
	{
		$query[] = 'view=unread';
	}

	if (isset($merged['hilit']) && (string) $merged['hilit'] !== '')
	{
		$query[] = 'hilit=' . rawurlencode((string) $merged['hilit']);
	}

	if (isset($merged['style']) && preg_match('/^[0-9]+$/', (string) $merged['style']))
	{
		$query[] = 'style=' . (int) $merged['style'];
	}
	else if ($style_extra !== '')
	{
		$query[] = $style_extra;
	}

	$delim = ($is_amp) ? '&amp;' : '&';
	$pretty = im3_seo_prefix($url) . $path;

	if (!empty($query))
	{
		$pretty .= '?' . implode($delim, $query);
	}

	return $pretty . $anchor;
}

/**
* search.php?search_id=newposts becomes search-newposts.html. Unknown searches stay classic.
*/
function im3_seo_rewrite_search($url, $params, $is_amp, $anchor, $style_extra)
{
	$merged = im3_seo_parse_params($url, $params);
	$search_id = isset($merged['search_id']) ? (string) $merged['search_id'] : '';
	$map = im3_seo_search_map();

	if (!isset($map[$search_id]))
	{
		return null;
	}

	$allowed = array('search_id', 'start', 'sr', 'sk', 'sd', 'st', 'style');
	$query = array();

	foreach ($merged as $key => $value)
	{
		if ($value === '' || $value === null || $value === false)
		{
			continue;
		}

		if (is_array($value) || !in_array($key, $allowed, true))
		{
			return null;
		}
	}

	$start = isset($merged['start']) ? $merged['start'] : 0;

	if ($start !== 0 && $start !== '0' && !preg_match('/^[0-9]+$/', (string) $start))
	{
		return null;
	}

	$start = (int) $start;

	if ($start > 0)
	{
		$query[] = 'start=' . $start;
	}

	if (isset($merged['sr']) && $merged['sr'] !== '' && $merged['sr'] !== null && $merged['sr'] !== false)
	{
		if ($merged['sr'] !== 'posts' && $merged['sr'] !== 'topics')
		{
			return null;
		}

		$query[] = 'sr=' . $merged['sr'];
	}

	if (isset($merged['sk']) && $merged['sk'] !== '' && $merged['sk'] !== null && $merged['sk'] !== false)
	{
		if (!in_array((string) $merged['sk'], array('a', 't', 'f', 'i', 's'), true))
		{
			return null;
		}

		$query[] = 'sk=' . $merged['sk'];
	}

	if (isset($merged['sd']) && $merged['sd'] !== '' && $merged['sd'] !== null && $merged['sd'] !== false)
	{
		if ($merged['sd'] !== 'a' && $merged['sd'] !== 'd')
		{
			return null;
		}

		$query[] = 'sd=' . $merged['sd'];
	}

	if (isset($merged['st']) && $merged['st'] !== '' && $merged['st'] !== null && $merged['st'] !== false)
	{
		if (!preg_match('/^[0-9]+$/', (string) $merged['st']) || (int) $merged['st'] > 3650)
		{
			return null;
		}

		$query[] = 'st=' . (int) $merged['st'];
	}

	if (isset($merged['style']) && $merged['style'] !== '' && $merged['style'] !== null && $merged['style'] !== false)
	{
		if (!preg_match('/^[0-9]+$/', (string) $merged['style']))
		{
			return null;
		}

		$query[] = 'style=' . (int) $merged['style'];
	}
	else if ($style_extra !== '')
	{
		$query[] = $style_extra;
	}

	$delim = ($is_amp) ? '&amp;' : '&';
	$pretty = im3_seo_prefix($url) . 'search-' . $map[$search_id] . '.html';

	if (!empty($query))
	{
		$pretty .= '?' . implode($delim, $query);
	}

	return $pretty . $anchor;
}

function im3_seo_profile_url($user_id, $username)
{
	global $phpbb_root_path, $phpEx;

	im3_seo_register('u', $user_id, $username);

	return append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . (int) $user_id);
}

function im3_seo_query_is_clean()
{
	$allowed = array('f', 't', 'p', 'u', 'start', 'mode', 'sid');

	foreach ($_GET as $key => $value)
	{
		if (!in_array($key, $allowed, true))
		{
			return false;
		}
	}

	$mode = request_var('mode', '');

	if ($mode !== '' && $mode !== 'viewprofile')
	{
		return false;
	}

	return true;
}

function im3_seo_can_redirect()
{
	global $user, $_SID;

	if (empty($user->data) || !empty($_POST))
	{
		return false;
	}

	if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST')
	{
		return false;
	}

	if ($_SID !== '' || request_var('sid', '') !== '')
	{
		return false;
	}

	$guest = ((int) $user->data['user_id'] === ANONYMOUS);
	$bot = !empty($user->data['is_bot']);

	if (!$guest && !$bot)
	{
		return false;
	}

	return im3_seo_query_is_clean();
}

function im3_seo_already_canonical($kind, $id, $slug)
{
	if (empty($GLOBALS['im3_seo_route']) || !is_array($GLOBALS['im3_seo_route']))
	{
		return false;
	}

	$route = $GLOBALS['im3_seo_route'];

	if (!isset($route['type']) || $route['type'] !== $kind || (int) $route['id'] !== (int) $id)
	{
		return false;
	}

	$requested = isset($route['slug']) ? strtolower((string) $route['slug']) : '';

	return ($requested === (string) $slug);
}

/**
* Board path for the current request. phpBB's root path is "./" on a vhost root.
*/
function im3_seo_web_root()
{
	$uri = isset($_SERVER['REQUEST_URI']) ? (string) $_SERVER['REQUEST_URI'] : '/';
	$path = parse_url($uri, PHP_URL_PATH);

	if (!is_string($path) || $path === '')
	{
		$path = '/';
	}

	if (preg_match('#^(.*?)/(?:f|t|u|p)[0-9]#', $path, $match))
	{
		$path = ($match[1] === '') ? '/' : $match[1] . '/';
	}
	else
	{
		$path = '/';
	}

	return $path;
}

function im3_seo_absolute($path, $query)
{
	$host = (!empty($_SERVER['HTTP_HOST'])) ? strtolower((string) $_SERVER['HTTP_HOST']) : '';
	$secure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on');
	$url = (($secure) ? 'https://' : 'http://') . $host . rtrim(im3_seo_web_root(), '/') . '/' . ltrim($path, '/');

	if ($query !== '')
	{
		$url .= '?' . $query;
	}

	return $url;
}

function im3_seo_assign_canonical($url)
{
	global $template;

	$tag = '<link rel="canonical" href="' . htmlspecialchars($url, ENT_COMPAT, 'UTF-8') . '" />';
	$existing = '';

	if (isset($template->_tpldata['.'][0]['META']))
	{
		$existing = $template->_tpldata['.'][0]['META'];
	}

	if (strpos($existing, 'rel="canonical"') !== false)
	{
		return;
	}

	$template->assign_vars(array(
		'META' => $existing . $tag,
	));
}

/**
* Set the canonical tag and, for guests and bots, 301 a non-canonical GET here.
*/
function im3_seo_finalize($kind, $id, $title, $start = 0, $forum_id = 0)
{
	if (!im3_seo_enabled())
	{
		return;
	}

	$id = (int) $id;
	$start = (int) $start;
	$forum_id = (int) $forum_id;

	if ($id < 1 || !in_array($kind, array('f', 't', 'u', 'p'), true))
	{
		return;
	}

	$slug = ($kind === 'p') ? '' : im3_seo_slug($title);

	if ($kind !== 'p')
	{
		im3_seo_register($kind, $id, $title);
	}

	$path = im3_seo_path($kind, $id, $slug);
	$query = array();

	if (($kind === 't' || $kind === 'p') && $forum_id > 0 && request_var('f', 0))
	{
		$query[] = 'f=' . $forum_id;
	}

	if ($kind === 't' && request_var('p', 0))
	{
		$query[] = 'p=' . request_var('p', 0);
	}

	if ($kind !== 'p' && $start > 0)
	{
		$query[] = 'start=' . $start;
	}

	$absolute = im3_seo_absolute($path, implode('&', $query));
	im3_seo_assign_canonical($absolute);

	if (!im3_seo_can_redirect() || im3_seo_already_canonical($kind, $id, $slug))
	{
		return;
	}

	redirect($absolute);
}

/**
* Topic pages and post permalinks share viewtopic.php.
*/
function im3_seo_finalize_topic($topic_id, $title, $start, $forum_id, $post_id)
{
	$route_type = (isset($GLOBALS['im3_seo_route']['type'])) ? $GLOBALS['im3_seo_route']['type'] : '';
	$req_t = request_var('t', 0);
	$req_p = request_var('p', 0);

	if ($route_type === 'p' || ($req_p && $route_type !== 't'))
	{
		im3_seo_finalize('p', ($req_p) ? $req_p : (int) $post_id, '', 0, $forum_id);
		return;
	}

	im3_seo_finalize('t', $topic_id, $title, $start, $forum_id);
}
