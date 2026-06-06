<?php
/**
*
* @package acm
* @version $Id$
* @copyright (c) 2005, 2009 phpBB Group
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

// Include the abstract base
if (!class_exists('acm_memory'))
{
	require("{$phpbb_root_path}includes/acm/acm_memory.$phpEx");
}

/**
 * ACM for APC / APCu
 * @package acm
 * @note APC was removed in PHP 7.0; uses APCu (apcu) for PHP 7.0+ and APC (apc) for PHP 5.6-5.7
 */
class acm extends acm_memory
{
	var $extension = 'apc'; // Will be reset to 'apcu' if running on PHP 7+

	function __construct()
	{
		// PHP 7.0+ removed the APC extension; use APCu instead
		if (defined('PHP_VERSION_ID') ? PHP_VERSION_ID >= 70000 : version_compare(PHP_VERSION, '7.0.0', '>='))
		{
			$this->extension = 'apcu';
		}

		parent::__construct();
	}

	/**
	* Purge cache data
	*
	* @return null
	*/
	function purge()
	{
		// Both APC and APCu use apc_clear_cache() - APCu maintains backward compatibility
		if (function_exists('apc_clear_cache'))
		{
			apc_clear_cache('user');
		}
		elseif (function_exists('apcu_clear_cache'))
		{
			apcu_clear_cache();
		}

		parent::purge();
	}

	/**
	* Fetch an item from the cache
	*
	* @access protected
	* @param string $var Cache key
	* @return mixed Cached data
	*/
	function _read($var)
	{
		return apc_fetch($this->key_prefix . $var);
	}

	/**
	* Store data in the cache
	*
	* @access protected
	* @param string $var Cache key
	* @param mixed $data Data to store
	* @param int $ttl Time-to-live of cached data
	* @return bool True if the operation succeeded
	*/
	function _write($var, $data, $ttl = 2592000)
	{
		return apc_store($this->key_prefix . $var, $data, $ttl);
	}

	/**
	* Remove an item from the cache
	*
	* @access protected
	* @param string $var Cache key
	* @return bool True if the operation succeeded
	*/
	function _delete($var)
	{
		return apc_delete($this->key_prefix . $var);
	}
}
