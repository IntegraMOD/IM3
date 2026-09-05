<?php
/**
* acp_push [ACP Push Notifications Module Info]
*
* @package IntegraMOD
* @version 1.0.0
* @author HelterSkelter
* @copyright (c) 2024 IntegraMOD Team
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
class acp_push_info
{
    function module()
    {
        return array(
            'filename'	=> 'acp_push',
            'title'		=> 'ACP_PUSH_NOTIFICATIONS',
            'version'	=> '1.0.0',
            'modes'		=> array(
                'settings'	=> array('title' => 'ACP_PUSH_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
                'send'		=> array('title' => 'ACP_PUSH_SEND', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
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
