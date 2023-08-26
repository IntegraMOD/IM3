<?php
/** 
*
* @package ucp
* @version $Id: ucp_bank.php 490 2007-06-27 02:17:56Z roadydude $
* @copyright (c) 2006-2007 StarTrekGuide Development Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class ucp_bank_info
{
	function module()
	{
		return array(
			'filename'	=> 'ucp_bank',
			'title'		=> 'UCP_BANK',
			'version'	=> '0.3.0',
			'modes'		=> array(
				'management'	=> array('title' => 'UCP_BANK_MANAGEMENT', 'auth' => 'acl_a_bank_manage || acl_m_bank_manage', 'cat' => array('UCP_BANK')),
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