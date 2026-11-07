<?php
if (!defined('IN_PHPBB'))
{
    exit;
}

include_once($phpbb_root_path . 'includes/acm/acm_memory.' . $phpEx);

class acm extends acm_memory
{
    var $extension = 'memcached';
    var $memcached;

    function __construct()
    {
        $this->memcached = new \Memcached();
        $this->memcached->addServer('127.0.0.1', 11211);
    }

    // Fallback for older PHP versions expecting class name as constructor
    function acm()
    {
        $this->__construct();
    }

    function purge()
    {
        $this->memcached->flush();
        parent::purge();
    }

    function _get($var)
    {
        return $this->memcached->get($var);
    }

    function _put($var, $data, $ttl = 2592000)
    {
        // The modern ext-memcached extension drops the compression flag
        // so we only pass key, data, and expiration time.
        return $this->memcached->set($var, $data, $ttl);
    }

    function _delete($var)
    {
        return $this->memcached->delete($var);
    }
}
?>