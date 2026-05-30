<?php
/**
*
* @package acm
* @copyright (c) 2011 phpBB Group
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
	require($phpbb_root_path . 'includes/acm/acm_memory.' . $phpEx);
}

if (!defined('PHPBB_ACM_REDIS_PORT'))
{
	define('PHPBB_ACM_REDIS_PORT', 6379);
}

if (!defined('PHPBB_ACM_REDIS_HOST'))
{
	define('PHPBB_ACM_REDIS_HOST', '127.0.0.1');
}

/**
* ACM for Redis
*
* Compatible with phpredis
*
* @package acm
*/
class acm extends acm_memory
{
	var $extension = 'redis';

	var $redis;

	function __construct()
	{
		// Call parent constructor
		parent::__construct();

		if (!class_exists('Redis'))
		{
			trigger_error('Redis extension is not available.', E_USER_ERROR);
		}

		$this->redis = new Redis();

		$connected = $this->redis->connect(
			PHPBB_ACM_REDIS_HOST,
			(int) PHPBB_ACM_REDIS_PORT,
			2.5
		);

		if (!$connected)
		{
			trigger_error('Could not connect to Redis server.', E_USER_ERROR);
		}

		// Optional password authentication
		if (defined('PHPBB_ACM_REDIS_PASSWORD') && PHPBB_ACM_REDIS_PASSWORD)
		{
			if (!$this->redis->auth(PHPBB_ACM_REDIS_PASSWORD))
			{
				trigger_error('Incorrect Redis password.', E_USER_ERROR);
			}
		}

		// Enable serializer if supported
		if (
			defined('Redis::OPT_SERIALIZER') &&
			defined('Redis::SERIALIZER_PHP')
		)
		{
			$this->redis->setOption(
				Redis::OPT_SERIALIZER,
				Redis::SERIALIZER_PHP
			);
		}

		// Set cache key prefix if supported
		if (defined('Redis::OPT_PREFIX'))
		{
			$this->redis->setOption(
				Redis::OPT_PREFIX,
				$this->key_prefix
			);
		}

		// Optional Redis database selection
		if (defined('PHPBB_ACM_REDIS_DB'))
		{
			if (!$this->redis->select((int) PHPBB_ACM_REDIS_DB))
			{
				trigger_error('Invalid Redis database.', E_USER_ERROR);
			}
		}
	}

	/**
	* Unload cache resources
	*
	* @return null
	*/
	function unload()
	{
		parent::unload();

		if (is_object($this->redis))
		{
			$this->redis->close();
		}
	}

	/**
	* Purge cache data
	*
	* @return null
	*/
	function purge()
	{
		$this->redis->flushDB();

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
		return $this->redis->get($var);
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
		return $this->redis->setEx($var, (int) $ttl, $data);
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
		if (method_exists($this->redis, 'del'))
		{
			return ($this->redis->del($var) > 0);
		}

		if (method_exists($this->redis, 'delete'))
		{
			return ($this->redis->delete($var) > 0);
		}

		return false;
	}
}