<?php
/** 
*
* @mod package		Meeting MOD 2
* @file				acp_meeting.php 4 2009/05/13 OXPUS
* @copyright		(c) 2009 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
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

class acp_meeting_info
{
	function module()
	{
		return array(
			'filename'	=> 'meeting',
			'title'		=> 'MEETING',
			'version'	=> '2.0.13.2',
			'modes'		=> array(
				'config'	=> array('title' => 'MEETING_CONFIG',	'auth' => 'acl_a_meeting_config',	'cat' => array('MEETING')),
				'add'		=> array('title' => 'MEETING_ADD',		'auth' => 'acl_a_meeting_add',		'cat' => array('MEETING')),
				'manage'	=> array('title' => 'MEETING_MANAGE',	'auth' => 'acl_a_meeting_manage',	'cat' => array('MEETING')),
			),
		);
	}
}

?>