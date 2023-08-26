<?php
/** 
*
* @author MarkDHamill (Mark D Hamill) mark@phpbbservices.com
* @version $Id digests_install.php 2.2.27 2016-02-19 00:00:00GMT MarkDHamill $
* @copyright (c) 2016 Mark D. Hamill
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

class ucp_digests_info
{
	function module()
	{
		return array(
			'filename'	=> 'ucp_digests',
			'title'		=> 'UCP_DIGESTS',
			'version'	=> '2.2.27',
			'modes'		=> array(
				'basics'				=> array('title' => 'UCP_DIGESTS_BASICS', 'auth' => '', 'cat' => array('UCP_MAIN')),
				'forums_selection'		=> array('title' => 'UCP_DIGESTS_FORUMS_SELECTION', 'auth' => '', 'cat' => array('UCP_MAIN')),
				'post_filters'			=> array('title' => 'UCP_DIGESTS_POST_FILTERS', 'auth' => '', 'cat' => array('UCP_MAIN')),
				'additional_criteria'	=> array('title' => 'UCP_DIGESTS_ADDITIONAL_CRITERIA', 'auth' => '', 'cat' => array('UCP_MAIN')),
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