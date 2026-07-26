<?php
/**
* ucp_push [UCP Push Notifications Module Info]
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
class ucp_push_info
{
    function module()
    {
        return array(
            'filename'	=> 'ucp_push',
            'title'		=> 'UCP_PUSH_NOTIFICATIONS',
            'version'	=> '1.0.0',
            'modes'		=> array(
                'settings'	=> array('title' => 'UCP_PUSH_SETTINGS', 'auth' => '', 'cat' => array('UCP_PREFS')),
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

