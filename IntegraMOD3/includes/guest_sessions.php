<?php
/**
 * Guest sessions helper - store lightweight guest session info in cache instead of DB
 */

if (!defined('IN_PHPBB'))
{
    exit;
}

/**
 * Add or update a guest session in cache
 *
 * @param array $data Keys: ip, browser, page, time (optional)
 */
function guest_session_put(array $data)
{
    global $cache, $config;

    $time_now = isset($data['time']) ? (int) $data['time'] : time();
    $keep_seconds = (isset($config['load_online_time']) ? (int) $config['load_online_time'] * 60 : 900);

    $key = isset($data['ip']) ? $data['ip'] : 'unknown';
    // include browser substring to help separate different visitors behind same IP
    $key .= '|' . substr((isset($data['browser']) ? $data['browser'] : ''), 0, 50);
    $id = md5($key);

    $guests = $cache->get('_guest_sessions');
    if (!is_array($guests))
    {
        $guests = array();
    }

    $guests[$id] = array(
        'ip'      => isset($data['ip']) ? $data['ip'] : '',
        'browser' => isset($data['browser']) ? $data['browser'] : '',
        'page'    => isset($data['page']) ? $data['page'] : '',
        'time'    => $time_now,
    );

    // prune old entries
    $expire = $time_now - $keep_seconds;
    foreach ($guests as $gid => $g)
    {
        if ($g['time'] < $expire)
        {
            unset($guests[$gid]);
        }
    }

    // write back with TTL slightly longer than keep_seconds
    $cache->put('_guest_sessions', $guests, $keep_seconds + 30);
}

/**
 * Return guest sessions newer than a given cutoff (seconds)
 * @param int $since_seconds seconds ago
 * @return array list of guest session arrays with keys ip, browser, page, time
 */
function guest_sessions_get($since_seconds = null)
{
    global $cache, $config;

    $time_now = time();
    $keep_seconds = (isset($config['load_online_time']) ? (int) $config['load_online_time'] * 60 : 900);
    $since = ($since_seconds === null) ? ($time_now - $keep_seconds) : ($time_now - (int) $since_seconds);

    $guests = $cache->get('_guest_sessions');
    if (!is_array($guests))
    {
        return array();
    }

    $out = array();
    foreach ($guests as $g)
    {
        if ($g['time'] >= $since)
        {
            $out[] = $g;
        }
    }

    return $out;
}

/**
 * Count distinct guest IPs newer than cutoff (seconds)
 */
function guest_sessions_count_distinct_ips($since_seconds = null)
{
    $guests = guest_sessions_get($since_seconds);
    $ips = array();
    foreach ($guests as $g)
    {
        $ips[$g['ip']] = 1;
    }

    return count($ips);
}

/**
 * Detect ACM backend in use. Prefer runtime $acm_type; fallback parse config.php
 */
function guest_cache_backend()
{
    global $acm_type, $phpbb_root_path;

    if (!empty($acm_type))
    {
        return $acm_type;
    }

    // Fallback: parse config.php
    $cfg = $phpbb_root_path . 'config.php';
    if (!file_exists($cfg))
    {
        return 'file';
    }

    $contents = @file_get_contents($cfg);
    if ($contents && preg_match("/acm_type\s*=\s*'([^']+)'/", $contents, $m))
    {
        return $m[1];
    }

    return 'file';
}
