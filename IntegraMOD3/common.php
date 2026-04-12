<?php
/**
*
* @package phpBB3
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Minimum Requirement: PHP 4.3.3
*/

/**
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

// error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables

// Uncomment these and comment out the previous "error_reporting" to debug errors
ini_set('display_startup_errors',1); 
ini_set('display_errors',1);
error_reporting  (E_ALL);
// Uncomment these and comment out "error_reporting" to debug errors

/**
* PHP 8 String Function Compatibility
* Works on PHP 5.6 ? 8.5
* Only defines functions if missing.
*/

if (!function_exists('str_contains'))
{
    function str_contains($haystack, $needle)
    {
        return ($needle !== '' && strpos($haystack, $needle) !== false);
    }
}

if (!function_exists('str_starts_with'))
{
    function str_starts_with($haystack, $needle)
    {
        return ($needle !== '' && strncmp($haystack, $needle, strlen($needle)) === 0);
    }
}

if (!function_exists('str_ends_with'))
{
    function str_ends_with($haystack, $needle)
    {
        if ($needle === '') {
            return false;
        }

        $len = strlen($needle);
        return (substr($haystack, -$len) === $needle);
    }
}

if (!function_exists('str_contains_ci'))
{
    // Optional helper: case-insensitive contains (phpBB uses this pattern often)
    function str_contains_ci($haystack, $needle)
    {
        return ($needle !== '' && stripos($haystack, $needle) !== false);
    }
}

if (!function_exists('str_starts_with_ci'))
{
    function str_starts_with_ci($haystack, $needle)
    {
        $len = strlen($needle);
        return ($len && strncasecmp($haystack, $needle, $len) === 0);
    }
}

if (!function_exists('str_ends_with_ci'))
{
    function str_ends_with_ci($haystack, $needle)
    {
        if ($needle === '') {
            return false;
        }

        $len = strlen($needle);
        return (strcasecmp(substr($haystack, -$len), $needle) === 0);
    }
}

/**
* PHP 8.2: safe version of str_contains for arrays (phpBB sometimes passes arrays)
*/
if (!function_exists('str_contains_safe'))
{
    function str_contains_safe($haystack, $needle)
    {
        if (!is_string($haystack)) {
            return false;
        }
        return str_contains($haystack, $needle);
    }
}

require($phpbb_root_path . 'includes/startup.' . $phpEx);

if (file_exists($phpbb_root_path . 'config.' . $phpEx))
{
	require($phpbb_root_path . 'config.' . $phpEx);
}

if (!defined('PHPBB_INSTALLED'))
{
	// Redirect the user to the installer
	require($phpbb_root_path . 'includes/functions.' . $phpEx);

	// We have to generate a full HTTP/1.1 header here since we can't guarantee to have any of the information
	// available as used by the redirect function
	$server_name = (!empty($_SERVER['HTTP_HOST'])) ? strtolower($_SERVER['HTTP_HOST']) : ((!empty($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : getenv('SERVER_NAME'));
	$server_port = (!empty($_SERVER['SERVER_PORT'])) ? (int) $_SERVER['SERVER_PORT'] : (int) getenv('SERVER_PORT');
	$secure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 1 : 0;

	$script_name = (!empty($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : getenv('PHP_SELF');
	if (!$script_name)
	{
		$script_name = (!empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
	}

	// $phpbb_root_path accounts for redirects from e.g. /adm
	$script_path = trim(dirname($script_name)) . '/' . $phpbb_root_path . 'install/index.' . $phpEx;
	// Replace any number of consecutive backslashes and/or slashes with a single slash
	// (could happen on some proxy setups and/or Windows servers)
	$script_path = preg_replace('#[\\\\/]{2,}#', '/', $script_path);
	// Eliminate . and .. from the path
	$script_path = phpbb_clean_path($script_path);

	$url = (($secure) ? 'https://' : 'http://') . $server_name;

	if ($server_port && (($secure && $server_port <> 443) || (!$secure && $server_port <> 80)))
	{
		// HTTP HOST can carry a port number...
		if (strpos($server_name, ':') === false)
		{
			$url .= ':' . $server_port;
		}
	}

	$url .= $script_path;
	header('Location: ' . $url);
	exit;
}

if (defined('DEBUG_EXTRA'))
{
	$base_memory_usage = 0;
	if (function_exists('memory_get_usage'))
	{
		$base_memory_usage = memory_get_usage();
	}
}

// Load Extensions
// dl() is deprecated and disabled by default as of PHP 5.3.
if (!empty($load_extensions) && function_exists('dl'))
{
	$load_extensions = explode(',', $load_extensions);

	foreach ($load_extensions as $extension)
	{
		@dl(trim($extension));
	}
}

// Include files
require($phpbb_root_path . 'includes/acm/acm_' . $acm_type . '.' . $phpEx);
require($phpbb_root_path . 'includes/cache.' . $phpEx);
require($phpbb_root_path . 'includes/template.' . $phpEx);
require($phpbb_root_path . 'includes/session.' . $phpEx);
require($phpbb_root_path . 'includes/auth.' . $phpEx);

require($phpbb_root_path . 'includes/functions.' . $phpEx);
require($phpbb_root_path . 'includes/functions_content.' . $phpEx);

require($phpbb_root_path . 'includes/constants.' . $phpEx);
require($phpbb_root_path . 'includes/db/' . $dbms . '.' . $phpEx);
require($phpbb_root_path . 'includes/utf/utf_tools.' . $phpEx);


// Start Ultimate Points
require($phpbb_root_path . 'includes/points/functions_points.' . $phpEx);
// End Ultimate Points
// Set PHP error handler to ours
set_error_handler(defined('PHPBB_MSG_HANDLER') ? PHPBB_MSG_HANDLER : 'msg_handler');

// Instantiate some basic classes
$user		= new user();
$auth		= new auth();
$template	= new template();
$cache		= new cache();
$db			= new $sql_db();
// Setup class loader for the gallery
require($phpbb_root_path . 'includes/gallery/class_loader.' . $phpEx);
$gallery_class_loader = new phpbb_gallery_class_loader($phpbb_root_path, '.' . $phpEx, $cache);
$gallery_class_loader->register();

// Connect to DB
$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, defined('PHPBB_DB_NEW_LINK') ? PHPBB_DB_NEW_LINK : false);

// We do not need this any longer, unset for safety purposes
unset($dbpasswd);

// Grab global variables, re-cache if necessary
$config = $cache->obtain_config();
// Start Ultimate Points
if ( isset($config['points_name']) )
{
	$points_config = $cache->obtain_points_config();
	$points_values = $cache->obtain_points_values();
}
// End Ultimate Points
@define('STARGATE', ($config['portal_enabled']));

if (STARGATE)
{
	@define('DEBUG_QUERIES', false);
	$k_config		= $cache->obtain_k_config();    // 1 query
	$k_resources	= $cache->obtain_k_resources(); // 1 query
	$k_groups		= $cache->obtain_k_groups();    // 1 query
	$k_blocks		= $cache->obtain_block_data();  // 1 query
	$k_pages		= $cache->obtain_k_pages();     // 1 query
}

// Add own hook handler
require($phpbb_root_path . 'includes/hooks/index.' . $phpEx);
$phpbb_hook = new phpbb_hook(array('exit_handler', 'phpbb_user_session_handler', 'append_sid', array('template', 'display')));

foreach ($cache->obtain_hooks() as $hook)
{
	@include($phpbb_root_path . 'includes/hooks/' . $hook . '.' . $phpEx);
}


// START Anti-Spam ACP
require($phpbb_root_path . 'antispam/asacp.' . $phpEx);
// END Anti-Spam ACP
