<?php
/**
* ucp_push [UCP Push Notifications Module]
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
* @package ucp
*/
class ucp_push
{
    var $u_action;

    function main($id, $mode)
    {
        global $db, $user, $auth, $template, $config, $phpbb_root_path, $phpEx;

        if (!function_exists('im3_encrypt_mobile'))
        {
            include($phpbb_root_path . 'includes/functions_push.' . $phpEx);
        }

        $user->add_lang('mods/ucp_push');
        $this->tpl_name = 'ucp_push_settings';
        $this->page_title = 'UCP_PUSH_NOTIFICATIONS';

        $form_key = 'ucp_push';
        add_form_key($form_key);

        $submit = (isset($_POST['submit'])) ? true : false;

        switch ($mode)
        {
            case 'settings':
                $this->page_title = 'UCP_PUSH_SETTINGS';

                if ($submit)
                {
                    if (!check_form_key($form_key))
                    {
                        trigger_error('FORM_INVALID');
                    }

                    // Sanitize country code and mobile, then combine and encrypt
                    $user_mobile_cc = request_var('user_mobile_cc', '');
                    $user_mobile_cc = preg_replace('/[^0-9]/', '', $user_mobile_cc);
                    $user_mobile = request_var('user_mobile', '');
                    $user_mobile = preg_replace('/[^0-9]/', '', $user_mobile);

                    // OneSignal requires the country code - block submission without it
                    if ($user_mobile !== '' && $user_mobile_cc === '')
                    {
                        trigger_error($user->lang['MOBILE_CC_REQUIRED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>'));
                    }

                    // Store in E.164 style with internal separator so the two fields can be re-split for display
                    $combined_mobile = ($user_mobile !== '') ? '+' . $user_mobile_cc . '.' . $user_mobile : '';
                    $encrypted_mobile = im3_encrypt_mobile($combined_mobile);

                    // Update user push notification preferences
                    $sql_ary = array(
                        'user_mobile' => $encrypted_mobile,
                    );
                    $events = array('friend_req', 'friend_acc', 'pm', 'like', 'activity', 'sub_post', 'sub_topic', 'news', 'announce');
                    foreach ($events as $event)
                    {
                        $sql_ary['user_push_web_' . $event] = request_var('user_push_web_' . $event, 0);
                        $sql_ary['user_push_sms_' . $event] = request_var('user_push_sms_' . $event, 0);
                    }

                    $sql = 'UPDATE ' . USERS_TABLE . '
                        SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
                        WHERE user_id = ' . (int) $user->data['user_id'];
                    $db->sql_query($sql);

                    meta_refresh(3, $this->u_action);
                    $message = $user->lang['UCP_PUSH_SETTINGS_SAVED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
                    trigger_error($message);
                }

                // Load current user preferences
                $sql = 'SELECT * 
                        FROM ' . USERS_TABLE . '
                        WHERE user_id = ' . (int) $user->data['user_id'];
                $result = $db->sql_query($sql);
                $row = $db->sql_fetchrow($result);
                $db->sql_freeresult($result);

                $decrypted_mobile = '';
                $decrypted_mobile_cc = '';
                if (!empty($row['user_mobile']))
                {
                    $decrypted = im3_decrypt_mobile($row['user_mobile'], true);
                    if ($decrypted !== false)
                    {
                        // Stored format: +CC.NUMBER - split for the two form fields
                        $decrypted = ltrim($decrypted, '+');
                        if (strpos($decrypted, '.') !== false)
                        {
                            list($decrypted_mobile_cc, $decrypted_mobile) = explode('.', $decrypted, 2);
                        }
                        else
                        {
                            // Legacy single-field format
                            $decrypted_mobile = $decrypted;
                        }
                    }
                }

                // Display settings form with conditional visibility based on global ACP toggles
                $template_vars = array(
                    'U_ACTION'					=> $this->u_action,
                    'USER_MOBILE'				=> $decrypted_mobile,
                    'USER_MOBILE_CC'			=> $decrypted_mobile_cc,
                );

                $events = array('friend_req', 'friend_acc', 'pm', 'like', 'activity', 'sub_post', 'sub_topic', 'news', 'announce');
                foreach ($events as $event)
                {
                    $template_vars['S_PUSH_ALLOW_WEB_' . strtoupper($event)] = isset($config['push_allow_web_' . $event]) && $config['push_allow_web_' . $event];
                    $template_vars['S_PUSH_ALLOW_SMS_' . strtoupper($event)] = isset($config['push_allow_sms_' . $event]) && $config['push_allow_sms_' . $event];

                    $template_vars['USER_PUSH_WEB_' . strtoupper($event)] = isset($row['user_push_web_' . $event]) ? $row['user_push_web_' . $event] : 1;
                    $template_vars['USER_PUSH_SMS_' . strtoupper($event)] = isset($row['user_push_sms_' . $event]) ? $row['user_push_sms_' . $event] : 0;
                }

                $template->assign_vars($template_vars);

            break;
        }
    }
}
