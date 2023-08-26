<?php

/** 
*
* @mod package		Notes Mod 2
* @file				notes.php 4 2009/06/16 OXPUS
* @copyright		(c) 2008 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

function notes_format_date($gmepoch, $user)
{
	static $midnight;
	static $date_cache;

	$format = $user->data['user_dateformat'];
	$now = time();
	$delta = $now - $gmepoch;

	$date_cache[$format] = array(
		'is_short'		=> strpos($format, '|'),
		'format_short'	=> substr($format, 0, strpos($format, '|')) . '||' . substr(strrchr($format, '|'), 1),
		'format_long'	=> str_replace('|', '', $format),
		'lang'			=> $user->lang['datetime'],
	);

	// Short representation of month in format? Some languages use different terms for the long and short format of May
	if ((strpos($format, '\M') === false && strpos($format, 'M') !== false) || (strpos($format, '\r') === false && strpos($format, 'r') !== false))
	{
		$date_cache[$format]['lang']['May'] = $user->lang['datetime']['May_short'];
	}

	// Show date <= 1 hour ago as 'xx min ago'
	// A small tolerence is given for times in the future and times in the future but in the same minute are displayed as '< than a minute ago'
	if ($delta <= 3600 && ($delta >= -5 || (($now / 60) % 60) == (($gmepoch / 60) % 60)) && $date_cache[$format]['is_short'] !== false && isset($user->lang['datetime']['AGO']))
	{
		return $user->lang(array('datetime', 'AGO'), max(0, (int) floor($delta / 60)));
	}

	if (!$midnight)
	{
		list($d, $m, $y) = explode(' ', date('j n Y', time()));
		$midnight = mktime(0, 0, 0, $m, $d, $y);
	}

	if ($date_cache[$format]['is_short'] !== false)
	{
		$day = false;

		if ($gmepoch > $midnight + 2 * 86400)
		{
			$day = false;
		}
		else if($gmepoch > $midnight + 86400)
		{
			$day = 'TOMORROW';
		}
		else if ($gmepoch > $midnight)
		{
			$day = 'TODAY';
		}
		else if ($gmepoch > $midnight - 86400)
		{
			$day = 'YESTERDAY';
		}

		if ($day !== false)
		{
			return str_replace('||', $user->lang['datetime'][$day], @strtr(@date($date_cache[$format]['format_short'], $gmepoch), $date_cache[$format]['lang']));
		}
	}

	return @strtr(@date($date_cache[$format]['format_long'], $gmepoch), $date_cache[$format]['lang']);
}

?>