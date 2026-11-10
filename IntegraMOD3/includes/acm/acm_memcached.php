<?php
/**
*
* @package acm
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

if (!defined('PHPBB_ACM_MEMCACHED_PORT'))
{
    define('PHPBB_ACM_MEMCACHED_PORT', defined('PHPBB_ACM_MEMCACHE_PORT') ? PHPBB_ACM_MEMCACHE_PORT : 11211);
}

if (!defined('PHPBB_ACM_MEMCACHED_HOST'))
{
    define('PHPBB_ACM_MEMCACHED_HOST', defined('PHPBB_ACM_MEMCACHE_HOST') ? PHPBB_ACM_MEMCACHE_HOST : '127.0.0.1');
}

if (!defined('PHPBB_ACM_MEMCACHED'))
{
    // host/port pairs, comma separated. Reuse the memcache list when that is already configured.
    define('PHPBB_ACM_MEMCACHED', defined('PHPBB_ACM_MEMCACHE') ? PHPBB_ACM_MEMCACHE : (PHPBB_ACM_MEMCACHED_HOST . '/' . PHPBB_ACM_MEMCACHED_PORT));
}

/**
* ACM for the pecl Memcached extension
* @package acm
*/
class acm extends acm_memory
{
    var $extension = 'memcached';

    var $memcached;

    function __construct()
    {
        parent::__construct();

        if (!class_exists('Memcached'))
        {
            trigger_error('Memcached extension is not available.', E_USER_ERROR);
        }

        $this->memcached = new Memcached();

        $added = false;
        foreach (explode(',', PHPBB_ACM_MEMCACHED) as $u)
        {
            $parts = explode('/', trim($u));
            $host = isset($parts[0]) ? trim($parts[0]) : '';
            $port = (isset($parts[1]) && trim($parts[1]) !== '') ? (int) trim($parts[1]) : (int) PHPBB_ACM_MEMCACHED_PORT;

            if ($host === '')
            {
                continue;
            }

            if ($this->memcached->addServer($host, $port))
            {
                $added = true;
            }
        }

        if (!$added)
        {
            trigger_error('Could not add a Memcached server.', E_USER_ERROR);
        }
    }

    /**
    * Purge cache data
    *
    * @return null
    */
    function purge()
    {
        $this->memcached->flush();

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
        $key = $this->key_prefix . $var;

        // replace() fails when the key is missing; fall back to set().
        if (!$this->memcached->replace($key, $data, (int) $ttl))
        {
            return $this->memcached->set($key, $data, (int) $ttl);
        }

        return true;
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
