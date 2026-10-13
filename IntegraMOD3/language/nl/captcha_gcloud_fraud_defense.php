<?php
/**
*
* captcha_gcloud_fraud_defense [Nederlands]
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

	'GCLOUD_FD_NOT_AVAILABLE'		=> 'Om Google Cloud Fraud Defense te gebruiken moet je een Google Cloud-project met reCAPTCHA Enterprise aanmaken en de site key, API-sleutel en project-ID invoeren.',
	'GCLOUD_FD_INCORRECT'			=> 'Google Cloud Fraud Defense heeft dit verzoek geweigerd. Probeer het opnieuw.',
	'GCLOUD_FD_NOSCRIPT'			=> 'Schakel JavaScript in je browser in zodat Fraud Defense dit formulier kan controleren.',
	'GCLOUD_FD_EXPLAIN'				=> 'Deze site gebruikt Google Cloud Fraud Defense om te bevestigen dat je geen bot bent. Er zijn geen extra stappen nodig.',
	'GCLOUD_FD_PREVIEW_MSG'			=> 'Fraud Defense is onzichtbaar. Na het opslaan van site key, API-sleutel en project-ID scoort Google inzendingen op de achtergrond.',

	'GCLOUD_FD_SITEKEY'				=> 'reCAPTCHA-sitesleutel',
	'GCLOUD_FD_SITEKEY_EXPLAIN'		=> 'Scoregebaseerde sitesleutel van Google Cloud reCAPTCHA / Fraud Defense.',
	'GCLOUD_FD_APIKEY'				=> 'Google Cloud API-sleutel',
	'GCLOUD_FD_APIKEY_EXPLAIN'		=> 'API-sleutel met de reCAPTCHA Enterprise API ingeschakeld. Beperk deze tot recaptchaenterprise.googleapis.com.',
	'GCLOUD_FD_PROJECT'				=> 'Google Cloud-project-ID',
	'GCLOUD_FD_PROJECT_EXPLAIN'		=> 'Het Google Cloud-project-ID dat de reCAPTCHA-sleutel bezit.',
	'GCLOUD_FD_SCORE'				=> 'Minimumscore',
	'GCLOUD_FD_SCORE_EXPLAIN'		=> 'Weiger tokens onder deze waarde (0.00 = meest soepel, 1.00 = meest strikt). Standaard is 0.50.',
));
