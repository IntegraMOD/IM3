<?php
/**
*
* acp_portal [English]
*
* @package language
* @version $Id: imod.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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

	'IMOD'				=> 'IntegraMod',
	'TITLE' 			=> 'Integramod Information',
	'TITLE_EXPLAIN'		=> 'Extended details for installed blocks... Author, Revision, Site/Links etc.',
	'IMOD_MAIN'			=> 'Main Configuration',
));
?>