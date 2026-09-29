<?php
/**
*
* captcha_gcloud_fraud_defense [Español]
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

	'GCLOUD_FD_NOT_AVAILABLE'		=> 'Para usar Google Cloud Fraud Defense debes crear un proyecto de Google Cloud con reCAPTCHA Enterprise e introducir la clave del sitio, la clave API y el ID del proyecto.',
	'GCLOUD_FD_INCORRECT'			=> 'Google Cloud Fraud Defense rechazó esta solicitud. Inténtalo de nuevo.',
	'GCLOUD_FD_NOSCRIPT'			=> 'Activa JavaScript en tu navegador para que Fraud Defense pueda verificar este formulario.',
	'GCLOUD_FD_EXPLAIN'				=> 'Este sitio usa Google Cloud Fraud Defense para confirmar que no eres un bot. No se requieren pasos adicionales.',
	'GCLOUD_FD_PREVIEW_MSG'			=> 'Fraud Defense es invisible. Tras guardar la clave del sitio, la clave API y el ID del proyecto, Google puntúa los envíos en segundo plano.',

	'GCLOUD_FD_SITEKEY'				=> 'Clave del sitio reCAPTCHA',
	'GCLOUD_FD_SITEKEY_EXPLAIN'		=> 'Clave del sitio basada en puntuación de Google Cloud reCAPTCHA / Fraud Defense.',
	'GCLOUD_FD_APIKEY'				=> 'Clave API de Google Cloud',
	'GCLOUD_FD_APIKEY_EXPLAIN'		=> 'Clave API con la API de reCAPTCHA Enterprise habilitada. Restrínjela a recaptchaenterprise.googleapis.com.',
	'GCLOUD_FD_PROJECT'				=> 'ID del proyecto de Google Cloud',
	'GCLOUD_FD_PROJECT_EXPLAIN'		=> 'El ID del proyecto de Google Cloud que posee la clave reCAPTCHA.',
	'GCLOUD_FD_SCORE'				=> 'Puntuación mínima',
	'GCLOUD_FD_SCORE_EXPLAIN'		=> 'Rechazar tokens por debajo de este valor (0.00 = más permisivo, 1.00 = más estricto). El valor predeterminado es 0.50.',
));
