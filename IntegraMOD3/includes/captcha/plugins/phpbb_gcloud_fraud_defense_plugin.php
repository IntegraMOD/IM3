<?php
/**
*
* Google Cloud Fraud Defense (reCAPTCHA Enterprise) captcha plugin
*
* @package VC
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (!class_exists('phpbb_default_captcha'))
{
	include($phpbb_root_path . 'includes/captcha/plugins/captcha_abstract.' . $phpEx);
}

/**
* @package VC
*/
class phpbb_gcloud_fraud_defense extends phpbb_default_captcha
{
	var $assess_server = 'https://recaptchaenterprise.googleapis.com/v1/projects';
	var $response;
	var $action = 'signup';

	function init($type)
	{
		global $user;

		$user->add_lang('mods/captcha_gcloud_fraud_defense');
		parent::init($type);
		$this->response = request_var('gcloud_fd_token', '');
		$this->action = $this->get_expected_action();
	}

	function &get_instance()
	{
		$instance = new phpbb_gcloud_fraud_defense();
		return $instance;
	}

	static function is_available()
	{
		global $config, $user;

		$user->add_lang('mods/captcha_gcloud_fraud_defense');

		return (!empty($config['gcloud_fd_sitekey']) && !empty($config['gcloud_fd_apikey']) && !empty($config['gcloud_fd_project']));
	}

	function has_config()
	{
		return true;
	}

	static function get_name()
	{
		return 'CAPTCHA_GCLOUD_FRAUD_DEFENSE';
	}

	function get_class_name()
	{
		return 'phpbb_gcloud_fraud_defense';
	}

	function get_expected_action()
	{
		if ($this->type == CONFIRM_LOGIN)
		{
			return 'login';
		}

		if ($this->type == CONFIRM_POST)
		{
			return 'post';
		}

		return 'signup';
	}

	function acp_page($id, &$module)
	{
		global $config, $template, $user;

		$captcha_vars = array(
			'gcloud_fd_sitekey'	=> 'GCLOUD_FD_SITEKEY',
			'gcloud_fd_apikey'	=> 'GCLOUD_FD_APIKEY',
			'gcloud_fd_project'	=> 'GCLOUD_FD_PROJECT',
			'gcloud_fd_score'	=> 'GCLOUD_FD_SCORE',
		);

		$module->tpl_name = 'captcha_gcloud_fraud_defense_acp';
		$module->page_title = 'ACP_VC_SETTINGS';
		$form_key = 'acp_captcha';
		add_form_key($form_key);

		$submit = request_var('submit', '');

		if ($submit && check_form_key($form_key))
		{
			foreach ($captcha_vars as $captcha_var => $template_var)
			{
				if ($captcha_var === 'gcloud_fd_score')
				{
					$score = (float) request_var('gcloud_fd_score', '0.50');
					if ($score < 0)
					{
						$score = 0;
					}
					else if ($score > 1)
					{
						$score = 1;
					}
					set_config('gcloud_fd_score', sprintf('%.2f', $score));
					continue;
				}

				set_config($captcha_var, request_var($captcha_var, ''));
			}

			add_log('admin', 'LOG_CONFIG_VISUAL');
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($module->u_action));
		}
		else if ($submit)
		{
			trigger_error($user->lang['FORM_INVALID'] . adm_back_link($module->u_action));
		}
		else
		{
			foreach ($captcha_vars as $captcha_var => $template_var)
			{
				$var = isset($config[$captcha_var]) ? $config[$captcha_var] : '';
				if ($captcha_var === 'gcloud_fd_score' && $var === '')
				{
					$var = '0.50';
				}
				$template->assign_var($template_var, $var);
			}

			$template->assign_vars(array(
				'CAPTCHA_PREVIEW'	=> $this->get_demo_template($id),
				'CAPTCHA_NAME'		=> $this->get_class_name(),
				'U_ACTION'			=> $module->u_action,
			));
		}
	}

	function execute_demo()
	{
	}

	function execute()
	{
	}

	function get_template()
	{
		global $config, $user, $template;

		if ($this->is_solved())
		{
			return false;
		}

		$explain = $user->lang(($this->type != CONFIRM_POST) ? 'CONFIRM_EXPLAIN' : 'POST_CONFIRM_EXPLAIN', '<a href="mailto:' . htmlspecialchars($config['board_contact']) . '">', '</a>');

		$template->assign_vars(array(
			'GCLOUD_FD_SITEKEY'		=> isset($config['gcloud_fd_sitekey']) ? $config['gcloud_fd_sitekey'] : '',
			'GCLOUD_FD_ACTION'		=> $this->get_expected_action(),
			'S_GCLOUD_FD_AVAILABLE'	=> $this->is_available(),
			'S_GCLOUD_FD_PREVIEW'	=> defined('IN_ADMIN'),
			'S_CONFIRM_CODE'		=> true,
			'S_TYPE'				=> $this->type,
			'L_CONFIRM_EXPLAIN'		=> $explain,
		));

		return 'captcha_gcloud_fraud_defense.html';
	}

	function get_demo_template($id)
	{
		return $this->get_template();
	}

	function get_hidden_fields()
	{
		$hidden_fields = array();

		if ($this->solved)
		{
			$hidden_fields['confirm_code'] = $this->code;
		}
		$hidden_fields['confirm_id'] = $this->confirm_id;
		return $hidden_fields;
	}

	function uninstall()
	{
		$this->garbage_collect(0);
	}

	function install()
	{
		global $config;

		if (!isset($config['gcloud_fd_sitekey']))
		{
			set_config('gcloud_fd_sitekey', '');
		}
		if (!isset($config['gcloud_fd_apikey']))
		{
			set_config('gcloud_fd_apikey', '');
		}
		if (!isset($config['gcloud_fd_project']))
		{
			set_config('gcloud_fd_project', '');
		}
		if (!isset($config['gcloud_fd_score']))
		{
			set_config('gcloud_fd_score', '0.50');
		}
	}

	function validate()
	{
		if (!parent::validate())
		{
			return false;
		}

		return $this->gcloud_fd_check_answer();
	}

	function gcloud_fd_check_answer()
	{
		global $config, $user;

		if ($this->response == null || strlen($this->response) == 0)
		{
			return $user->lang['GCLOUD_FD_INCORRECT'];
		}

		$project = isset($config['gcloud_fd_project']) ? preg_replace('#[^a-z0-9\-]#', '', strtolower($config['gcloud_fd_project'])) : '';
		$sitekey = isset($config['gcloud_fd_sitekey']) ? $config['gcloud_fd_sitekey'] : '';
		$apikey = isset($config['gcloud_fd_apikey']) ? $config['gcloud_fd_apikey'] : '';
		$threshold = isset($config['gcloud_fd_score']) ? (float) $config['gcloud_fd_score'] : 0.5;

		if ($project === '' || $sitekey === '' || $apikey === '')
		{
			return $user->lang['GCLOUD_FD_INCORRECT'];
		}

		if ($threshold < 0)
		{
			$threshold = 0;
		}
		else if ($threshold > 1)
		{
			$threshold = 1;
		}

		$event = array(
			'token'				=> $this->response,
			'siteKey'			=> $sitekey,
			'expectedAction'	=> $this->action,
		);

		if (!empty($user->ip))
		{
			$event['userIpAddress'] = $user->ip;
		}

		if (!empty($user->browser))
		{
			$event['userAgent'] = $user->browser;
		}

		$payload = array('event' => $event);

		$url = $this->assess_server . '/' . $project . '/assessments?key=' . rawurlencode($apikey);
		$raw = $this->gcloud_fd_post_json($url, $payload);
		if ($raw === false || $raw === '')
		{
			return $user->lang['GCLOUD_FD_INCORRECT'];
		}

		$result = json_decode($raw, true);
		if (!is_array($result))
		{
			return $user->lang['GCLOUD_FD_INCORRECT'];
		}

		$token_valid = (!empty($result['tokenProperties']['valid']));
		$token_action = isset($result['tokenProperties']['action']) ? $result['tokenProperties']['action'] : '';
		$score = isset($result['riskAnalysis']['score']) ? (float) $result['riskAnalysis']['score'] : 0.0;

		if ($token_valid && $token_action === $this->action && $score >= $threshold)
		{
			$this->solved = true;
			return false;
		}

		return $user->lang['GCLOUD_FD_INCORRECT'];
	}

	function gcloud_fd_post_json($url, $payload)
	{
		$body = json_encode($payload);

		if (function_exists('curl_init'))
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			curl_setopt($ch, CURLOPT_TIMEOUT, 8);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			$response = curl_exec($ch);
			curl_close($ch);
			return $response;
		}

		$context = stream_context_create(array(
			'http'	=> array(
				'method'		=> 'POST',
				'header'		=> "Content-Type: application/json\r\n",
				'content'		=> $body,
				'timeout'		=> 8,
				'ignore_errors'	=> true,
			),
		));

		return @file_get_contents($url, false, $context);
	}
}
