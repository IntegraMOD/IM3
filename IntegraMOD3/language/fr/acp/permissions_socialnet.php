<?php
/**
 *
 * @package phpBB Social Network
 * @version 1.0.0
 * @copyright (c) phpBB Social Network Team 2010-2012 http://phpbbsocialnetwork.com
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

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// Social Network Permissions
$lang['permission_cat']['socialnet'] = 'Réseau social';

// Adding the permissions
$lang = array_merge($lang, array(
	'acl_a_sn_settings'			 => array('lang' => 'Peut modifier les paramètres du réseau social', 'cat' => 'settings'),
	'acl_u_sn_im'				 => array('lang' => 'Peut utiliser la messagerie instantanée', 'cat' => 'socialnet'),
	'acl_u_sn_notify'			 => array('lang' => 'Peut utiliser les notifications', 'cat' => 'socialnet'),
	'acl_u_sn_userstatus'		 => array('lang' => 'Peut utiliser le statut utilisateur', 'cat' => 'socialnet'),
	'acl_m_sn_close_reports'	 => array('lang' => 'Peut clôturer les signalements utilisateurs', 'cat' => 'misc'),
));


