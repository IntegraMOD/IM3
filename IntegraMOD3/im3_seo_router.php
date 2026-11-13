<?php
/**
*
* Pretty-URL entry point. Injects the numeric id and hands off to the legacy script.
* Titles are never queried here.
*
* @package IntegraMOD
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (isset($_SERVER['SCRIPT_FILENAME']))
{
	chdir(dirname($_SERVER['SCRIPT_FILENAME']));
}

/**
* @param string $path
* @return string
*/
function im3_seo_router_path($path)
{
	$path = str_replace('\\', '/', (string) $path);
	$script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', $_SERVER['SCRIPT_NAME']) : '';
	$base = rtrim(str_replace('\\', '/', dirname($script)), '/');

	if ($base === '/' || $base === '.')
	{
		$base = '';
	}

	if ($base !== '' && strpos($path, $base . '/') === 0)
	{
		$path = substr($path, strlen($base));
	}

	$router = '/im3_seo_router.php';

	if (strpos($path, $router . '/') === 0)
	{
		$path = substr($path, strlen($router));
	}
	else if ($path === $router)
	{
		$path = '';
	}

	if ($path === '' || $path[0] !== '/')
	{
		$path = '/' . ltrim($path, '/');
	}

	return $path;
}

function im3_seo_router_404()
{
	header('HTTP/1.0 404 Not Found');
	echo 'Not Found';
	exit;
}

$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$path = parse_url($uri, PHP_URL_PATH);

if (!is_string($path) || $path === '')
{
	$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
}

$path = im3_seo_router_path($path);
$type = '';
$id = 0;
$slug = '';

if (preg_match('#^/f([0-9]{1,8})(?:-([^/]*))?/?$#', $path, $match))
{
	$type = 'f';
	$id = (int) $match[1];
	$slug = isset($match[2]) ? strtolower($match[2]) : '';
}
else if (preg_match('#^/t([0-9]{1,8})(?:-([^/]*))?\.html$#', $path, $match))
{
	$type = 't';
	$id = (int) $match[1];
	$slug = isset($match[2]) ? strtolower($match[2]) : '';
}
else if (preg_match('#^/p([0-9]{1,8})/?$#', $path, $match))
{
	$type = 'p';
	$id = (int) $match[1];
}
else if (preg_match('#^/u([0-9]{1,8})(?:-([^/]*))?/?$#', $path, $match))
{
	$type = 'u';
	$id = (int) $match[1];
	$slug = isset($match[2]) ? strtolower($match[2]) : '';
}
else if (preg_match('#^/page([0-9]{1,8})(?:-([^/]*))?/?$#', $path, $match))
{
	$type = 'page';
	$id = (int) $match[1];
	$slug = isset($match[2]) ? strtolower($match[2]) : '';
}
else if (preg_match('#^/([a-z0-9][a-z0-9+-]{0,79})/?$#', $path, $match))
{
	// Name-based static page address, for example /chat
	$type = 'page-name';
	$slug = strtolower($match[1]);
}
else if (preg_match('#^/search-(newposts|egosearch|unanswered|unreadposts|active-topics)\.html$#', $path, $match))
{
	$type = 's';
	$slug = $match[1];
}

$search_ids = array(
	'newposts'		=> 'newposts',
	'egosearch'		=> 'egosearch',
	'unanswered'	=> 'unanswered',
	'unreadposts'	=> 'unreadposts',
	'active-topics'	=> 'active_topics',
);

if ($type === 's')
{
	if (!isset($search_ids[$slug]))
	{
		im3_seo_router_404();
	}
}
else if ($type !== 'page-name' && (!$type || $id < 1 || $id > 16777215 || strpos($slug, '..') !== false))
{
	im3_seo_router_404();
}

// A bare name such as /chat is handed to page.php, which 404s names that are not pages.
// No lookup happens here, so the database class is only loaded once.

$targets = array(
	'f' => 'viewforum.php',
	't' => 'viewtopic.php',
	'p' => 'viewtopic.php',
	'u' => 'memberlist.php',
	's' => 'search.php',
	'page' => 'page.php',
	'page-name' => 'page.php',
);
$target = $targets[$type];
$target_path = __DIR__ . DIRECTORY_SEPARATOR . $target;

if (!is_file($target_path))
{
	im3_seo_router_404();
}

$script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', $_SERVER['SCRIPT_NAME']) : '';
$base = rtrim(str_replace('\\', '/', dirname($script)), '/');

if ($base === '/' || $base === '.')
{
	$base = '';
}

// An internal rewrite can expose the filesystem path and a localhost host.
// phpBB records both before the destination script runs, so correct them here.
$_SERVER['SCRIPT_NAME'] = ($base === '') ? '/' . $target : $base . '/' . $target;
$_SERVER['PHP_SELF'] = $_SERVER['SCRIPT_NAME'];
$_SERVER['SCRIPT_FILENAME'] = $target_path;

if (!empty($_SERVER['HTTP_HOST']))
{
	$_SERVER['SERVER_NAME'] = preg_replace('/:\d+$/', '', strtolower((string) $_SERVER['HTTP_HOST']));
}

$inject = array();

if ($type === 'f')
{
	$inject['f'] = (string) $id;
}
else if ($type === 't')
{
	$inject['t'] = (string) $id;
}
else if ($type === 'p')
{
	$inject['p'] = (string) $id;
}
else if ($type === 'u')
{
	$inject['u'] = (string) $id;
	$inject['mode'] = 'viewprofile';
}
else if ($type === 'page')
{
	$inject['id'] = (string) $id;
}
else if ($type === 'page-name')
{
	$inject['p'] = $slug;
}
else
{
	$inject['search_id'] = $search_ids[$slug];
}

foreach ($inject as $key => $value)
{
	$_GET[$key] = $value;
	$_REQUEST[$key] = $value;
}

$current_query = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
$prefix = array();

foreach ($inject as $key => $value)
{
	$prefix[] = rawurlencode($key) . '=' . rawurlencode($value);
}

$_SERVER['QUERY_STRING'] = implode('&', $prefix) . ($current_query !== '' ? '&' . $current_query : '');

$GLOBALS['im3_seo_route'] = array(
	'type'	=> $type,
	'id'	=> $id,
	'slug'	=> ($type === 's') ? $search_ids[$slug] : $slug,
);

require $target_path;
