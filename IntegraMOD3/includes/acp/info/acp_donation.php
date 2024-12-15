<?php
/**
*
* @package Paypal Donation MOD
* @copyright (c) 2013 Skouat
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

/**
* @package module_install
*/
class acp_donation_info
{
	function module()
	{
		return array(
			'filename'			=> 'acp_donation',
			'title'				=> 'ACP_DONATION_MOD',
			'version'			=> '1.0.4',
			'modes'		=> array(
				'overview'			=> array('title' => 'DONATION_OVERVIEW',	'auth' => 'acl_a_pdm_manage', 'cat' => array('ACP_DONATION_MOD')),
				'configuration'		=> array('title' => 'DONATION_CONFIG',		'auth' => 'acl_a_pdm_manage', 'cat' => array('ACP_DONATION_MOD')),
				'donation_pages'	=> array('title' => 'DONATION_DP_CONFIG',	'auth' => 'acl_a_pdm_manage', 'cat' => array('ACP_DONATION_MOD')),
				'currency'			=> array('title' => 'DONATION_DC_CONFIG',	'auth' => 'acl_a_pdm_manage', 'cat' => array('ACP_DONATION_MOD')),
			),
		);
	}
	
	function install()
	{
	}

	function uninstall()
	{
	}
}

?>