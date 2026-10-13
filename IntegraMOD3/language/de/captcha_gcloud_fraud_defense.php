<?php
/**
*
* captcha_gcloud_fraud_defense [Deutsch]
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

	'GCLOUD_FD_NOT_AVAILABLE'		=> 'Um Google Cloud Fraud Defense zu nutzen, musst du ein Google-Cloud-Projekt mit reCAPTCHA Enterprise anlegen und Site Key, API-Key sowie Projekt-ID eintragen.',
	'GCLOUD_FD_INCORRECT'			=> 'Google Cloud Fraud Defense hat diese Anfrage abgelehnt. Bitte versuche es erneut.',
	'GCLOUD_FD_NOSCRIPT'			=> 'Bitte aktiviere JavaScript in deinem Browser, damit Fraud Defense dieses Formular prüfen kann.',
	'GCLOUD_FD_EXPLAIN'				=> 'Diese Seite verwendet Google Cloud Fraud Defense, um zu bestätigen, dass du kein Bot bist. Es sind keine weiteren Schritte nötig.',
	'GCLOUD_FD_PREVIEW_MSG'			=> 'Fraud Defense ist unsichtbar. Nach dem Speichern von Site Key, API-Key und Projekt-ID bewertet Google Übermittlungen im Hintergrund.',

	'GCLOUD_FD_SITEKEY'				=> 'reCAPTCHA-Site-Key',
	'GCLOUD_FD_SITEKEY_EXPLAIN'		=> 'Score-basierter Site Key aus Google Cloud reCAPTCHA / Fraud Defense.',
	'GCLOUD_FD_APIKEY'				=> 'Google-Cloud-API-Key',
	'GCLOUD_FD_APIKEY_EXPLAIN'		=> 'API-Key mit aktivierter reCAPTCHA Enterprise API. Beschränke ihn auf recaptchaenterprise.googleapis.com.',
	'GCLOUD_FD_PROJECT'				=> 'Google-Cloud-Projekt-ID',
	'GCLOUD_FD_PROJECT_EXPLAIN'		=> 'Die Google-Cloud-Projekt-ID, der der reCAPTCHA-Key gehört.',
	'GCLOUD_FD_SCORE'				=> 'Mindest-Score',
	'GCLOUD_FD_SCORE_EXPLAIN'		=> 'Token unter diesem Wert ablehnen (0.00 = sehr tolerant, 1.00 = sehr streng). Standard ist 0.50.',
));
