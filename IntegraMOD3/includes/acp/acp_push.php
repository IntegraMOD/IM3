<?php
/**
* acp_push [ACP Push Notifications Module]
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
* @package acp
*/
class acp_push
{
    var $u_action;
    var $new_config = array();

    function main($id, $mode)
    {
        global $db, $user, $auth, $template, $cache, $config, $phpbb_root_path, $phpEx;

        $user->add_lang('mods/acp_push');
        $this->tpl_name = 'acp_push';
        $this->page_title = 'ACP_PUSH_NOTIFICATIONS';

        $form_key = 'acp_push';
        add_form_key($form_key);

        $submit = (isset($_POST['submit'])) ? true : false;

        // Load OneSignal functions
        if (!function_exists('trigger_mass_push'))
        {
            include($phpbb_root_path . 'includes/functions_push.' . $phpEx);
        }

        switch ($mode)
        {
            case 'settings':
                $this->page_title = 'ACP_PUSH_SETTINGS';

                if ($submit)
                {
                    if (!check_form_key($form_key))
                    {
                        trigger_error('FORM_INVALID');
                    }

                    // Save OneSignal API credentials
                    set_config('onesignal_app_id', request_var('onesignal_app_id', ''));
                    set_config('onesignal_rest_key', request_var('onesignal_rest_key', ''));

                    // Save SMS gateway settings
                    set_config('sms_gateway', request_var('sms_gateway', ''));
                    set_config('twilio_sid', request_var('twilio_sid', ''));
                    set_config('twilio_token', request_var('twilio_token', ''));
                    set_config('twilio_from_number', request_var('twilio_from_number', ''));

                    // Save global notification toggles
                    $events = array('friend_req', 'friend_acc', 'pm', 'like', 'activity', 'sub_post', 'sub_topic', 'news', 'announce');
                    foreach ($events as $event)
                    {
                        set_config('push_allow_web_' . $event, request_var('push_allow_web_' . $event, 0));
                        set_config('push_allow_sms_' . $event, request_var('push_allow_sms_' . $event, 0));
                    }

                    $cache->destroy('config');

                    trigger_error($user->lang['ACP_PUSH_SETTINGS_SAVED'] . adm_back_link($this->u_action));
                }

                // Display settings form
                $template_vars = array(
                    'U_ACTION'					=> $this->u_action,
                    'S_SETTINGS'				=> true,

                    'ONESIGNAL_APP_ID'			=> isset($config['onesignal_app_id']) ? $config['onesignal_app_id'] : '',
                    'ONESIGNAL_REST_KEY'		=> isset($config['onesignal_rest_key']) ? $config['onesignal_rest_key'] : '',

                    'SMS_GATEWAY'				=> isset($config['sms_gateway']) ? $config['sms_gateway'] : 'onesignal',
                    'TWILIO_SID'				=> isset($config['twilio_sid']) ? $config['twilio_sid'] : '',
                    'TWILIO_TOKEN'				=> isset($config['twilio_token']) ? $config['twilio_token'] : '',
                    'TWILIO_FROM_NUMBER'		=> isset($config['twilio_from_number']) ? $config['twilio_from_number'] : '',
                );

                $events = array('friend_req', 'friend_acc', 'pm', 'like', 'activity', 'sub_post', 'sub_topic', 'news', 'announce');
                foreach ($events as $event)
                {
                    $template_vars['PUSH_ALLOW_WEB_' . strtoupper($event)] = isset($config['push_allow_web_' . $event]) ? $config['push_allow_web_' . $event] : 1;
                    $template_vars['PUSH_ALLOW_SMS_' . strtoupper($event)] = isset($config['push_allow_sms_' . $event]) ? $config['push_allow_sms_' . $event] : 1;
                }

                $template->assign_vars($template_vars);

            break;

            case 'send':
                $this->page_title = 'ACP_PUSH_SEND';

                if ($submit)
                {
                    if (!check_form_key($form_key))
                    {
                        trigger_error('FORM_INVALID');
                    }

                    $notification_title = utf8_normalize_nfc(request_var('notification_title', '', true));
                    $notification_message = utf8_normalize_nfc(request_var('notification_message', '', true));
                    $notification_url = request_var('notification_url', '');
                    $event_type = request_var('event_type', 'news');

                    if (empty($notification_title) || empty($notification_message))
                    {
                        trigger_error($user->lang['ACP_PUSH_SEND_ERROR_EMPTY'] . adm_back_link($this->u_action));
                    }

                    // Send mass push notification
                    try
                    {
                        trigger_mass_push($event_type, $notification_title, $notification_message, $notification_url);
                        trigger_error($user->lang['ACP_PUSH_SEND_SUCCESS'] . adm_back_link($this->u_action));
                    }
                    catch (Exception $e)
                    {
                        trigger_error($user->lang['ACP_PUSH_SEND_ERROR'] . ': ' . $e->getMessage() . adm_back_link($this->u_action));
                    }
                }

                // Display send form
                $template->assign_vars(array(
                    'U_ACTION'	=> $this->u_action,
                    'S_SEND'	=> true,
                ));

            break;
        }
    }
}

