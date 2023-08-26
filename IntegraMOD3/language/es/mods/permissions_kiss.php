<?php
/**
*
* permissions_kiss [English]
*
* @package language
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang['permission_cat']['portal'] = 'Portal';

$lang = array_merge($lang, array(
	'acl_u_k_tools'		=> array('lang' => 'Puede utilizar las herramientas de portal', 'cat' => 'portal'),
	'acl_a_k_portal'	=> array('lang' => 'Puede administrar la configuración de portal', 'cat' => 'portal'),
	'acl_a_k_tools'		=> array('lang' => 'Puede administrar herramientas del portal', 'cat' => 'portal'),
));

?>