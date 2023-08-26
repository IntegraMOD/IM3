<?php
/**
*
* @package acp
* @version $Id: acp_calendar.php 2008-07-24 18:35:00Z livewirestu $
* @copyright (c) 2008 phpbbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @notes This file adapted, with permission, from Handyman's acp_cash.php (Cash mod) (c) 2008 StarTrekGuide Group
*/

/**
* @package module_install
*/
class acp_calendar_info
{
	var $version = '1.0.0b3';

	function module()
	{
		$action = request_var('action', '');

		if ($action == 'add' || $action == 'quickadd')
		{
			$this->install();
		}

		return array(
			'filename'	=> 'acp_calendar',
			'title'		=> 'ACP_CALENDAR',
			'version'	=> $this->version,
			'modes'		=> array(
            'settings'   => array('title' => 'ACP_CALENDAR_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_CALENDAR')),
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