<?php
/**
*
* acp_portal_config [English]
*
* @package language
* @version $Id: k_config.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* @copyright (c) 2006 phpbbireland Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// phpbbportal profile fields
$lang = array_merge($lang, array(

	'IMOD' 					=> 'IntegraMod',
	'TITLE' 				=> 'Integramod Main Configuration',
	'TITLE_EXPLAIN'			=> 'Here you have access to modifications controlled by IntegraMOD.',
	'IMOD_CONFIG_HEADING'	=> 'IntegraMOD',

	'IMOD_VERSION'			=> 'IntegraMod Version',
	'IMOD_ENABLED'			=> 'Disable/Enable IntegraMod',

	'IMOD_VERSION_EXPLAIN'	=> 'This is the currently installed version.',
	'IMOD_ENABLED_EXPLAIN'	=> '0 (zero) disables, 1 Enables. All other positive numbers enable with debug options.',
));
?>