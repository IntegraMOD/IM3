<?php
/**
*
* @package acp
* @version $Id: acp_file_backup.php,v 1.00 2008/02/22 livewirestu Exp $
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class acp_file_backup_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_file_backup',
			'title'		=> 'ACP_FILE_BACKUP',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'backup'	=> array('title' => 'ACP_FILE_BACKUP', 'auth' => 'acl_a_backup', 'cat' => array('ACP_CAT_FILES')),
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