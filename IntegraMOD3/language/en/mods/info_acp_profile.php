<?php
/**
* @package mspf
* @version 1.0.0
* @copyright (c) 2011 djchrisnet.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'FIELD_MULTI'				=> 'Multi Selection Fields',
	'MULTI_ENTRIES_EXPLAIN' 	=> 'Enter your options, with an option on each line.',
	'FIELD_MULTI_MIN_CHARS'		=> 'Maximum number of options selected',
	'FIELD_MULTI_MAX_CHARS'		=> 'Minimum number of options selected',
));

?>