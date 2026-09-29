<?php
/**
*
* captcha_gcloud_fraud_defense [English]
*
* @package language
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'CAPTCHA_GCLOUD_FRAUD_DEFENSE'	=> 'Google Cloud Fraud Defense',

	'GCLOUD_FD_NOT_AVAILABLE'		=> 'In order to use Google Cloud Fraud Defense, you must create a Google Cloud project with reCAPTCHA Enterprise, then enter the site key, API key, and project ID.',
	'GCLOUD_FD_INCORRECT'			=> 'Google Cloud Fraud Defense rejected this request. Please try again.',
	'GCLOUD_FD_NOSCRIPT'			=> 'Please enable JavaScript in your browser so Fraud Defense can verify this form.',
	'GCLOUD_FD_EXPLAIN'				=> 'This site uses Google Cloud Fraud Defense to confirm that you are not a bot. No extra steps are required.',
	'GCLOUD_FD_PREVIEW_MSG'			=> 'Fraud Defense is invisible. After you save a site key, API key, and project ID, Google scores submissions in the background.',

	'GCLOUD_FD_SITEKEY'				=> 'reCAPTCHA site key',
	'GCLOUD_FD_SITEKEY_EXPLAIN'		=> 'Score-based site key from Google Cloud reCAPTCHA / Fraud Defense.',
	'GCLOUD_FD_APIKEY'				=> 'Google Cloud API key',
	'GCLOUD_FD_APIKEY_EXPLAIN'		=> 'API key with the reCAPTCHA Enterprise API enabled. Restrict it to recaptchaenterprise.googleapis.com.',
	'GCLOUD_FD_PROJECT'				=> 'Google Cloud project ID',
	'GCLOUD_FD_PROJECT_EXPLAIN'		=> 'The Google Cloud project ID that owns the reCAPTCHA key.',
	'GCLOUD_FD_SCORE'				=> 'Minimum score',
	'GCLOUD_FD_SCORE_EXPLAIN'		=> 'Reject tokens scoring below this value (0.00 = accept most traffic, 1.00 = most strict). Default is 0.50.',
));
