<?php
/**
*
* @package acm
* @version $Id$
* @copyright (c) 2026 IntegraTeam
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

// Support both new PHPBB_ACM_MEMCACHED_* constants and legacy PHPBB_ACM_MEMCACHE_* constants
if (!defined('PHPBB_ACM_MEMCACHED_PORT'))
{
	define('PHPBB_ACM_MEMCACHED_PORT', defined('PHPBB_ACM_MEMCACHE_PORT') ? PHPBB_ACM_MEMCACHE_PORT : 11211);
}

if (!defined('PHPBB_ACM_MEMCACHED_COMPRESS'))
{
	define('PHPBB_ACM_MEMCACHED_COMPRESS', defined('PHPBB_ACM_MEMCACHE_COMPRESS') ? PHPBB_ACM_MEMCACHE_COMPRESS : false);
}

if (!defined('PHPBB_ACM_MEMCACHED_HOST'))
{
	define('PHPBB_ACM_MEMCACHED_HOST', defined('PHPBB_ACM_MEMCACHE_HOST') ? PHPBB_ACM_MEMCACHE_HOST : 'localhost');
}

if (!defined('PHPBB_ACM_MEMCACHED'))
{
	if (defined('PHPBB_ACM_MEMCACHE'))
	{
		define('PHPBB_ACM_MEMCACHED', PHPBB_ACM_MEMCACHE);
	}
	else
	{
		// can define multiple servers with host1/port1,host2/port2 format
		define('PHPBB_ACM_MEMCACHED', PHPBB_ACM_MEMCACHED_HOST . '/' . PHPBB_ACM_MEMCACHED_PORT);
	}
}

/**
* ACM for Memcached
* @package acm
*/
class acm extends acm_memory
{
	/**
	* @var Memcached
	*/
	var $memcached;

	function __construct()
	{
		// Call the parent constructor
		parent::__construct();

		if (!class_exists('Memcached'))
		{
			trigger_error('Memcached extension is not available.', E_USER_ERROR);
			return;
		}

		// Use persistent instance identifier if supported
		$this->memcached = new Memcached();

		// Configure options
		$this->memcached->setOption(Memcached::OPT_COMPRESSION, (bool) PHPBB_ACM_MEMCACHED_COMPRESS);

		// Prevent adding duplicate servers if using persistent connections
		if (!count($this->memcached->getServerList()))
		{
			$servers = array();
			foreach (explode(',', PHPBB_ACM_MEMCACHED) as $u)
			{
				$parts = explode('/', trim($u));
				$servers[] = array(
					trim($parts[0]),
					isset($parts[1]) ? (int) trim($parts[1]) : 11211,
				);
			}

			$this->memcached->addServers($servers);
		}
	}

	/**
	* Unload the cache resources
	*
	* @return null
	*/
	function unload()
	{
		parent::unload();

		// Memcached does not require explicit connection closing,
		// but quit() can be invoked if you need to tear down connections.
		if ($this->memcached instanceof Memcached)
		{
			$this->memcached->quit();
		}
	}

	/**
	* Purge cache data
	*
	* @return null
	*/
	function purge()
	{
		if ($this->memcached instanceof Memcached)
		{
			$this->memcached->flush();
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
		return $this->memcached->get($this->key_prefix . $var);
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
		return $this->memcached->set($this->key_prefix . $var, $data, $ttl);
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
		return $this->memcached->delete($this->key_prefix . $var);
	}
}