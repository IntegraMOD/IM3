<?php
/**
*
* captcha_gcloud_fraud_defense [Українська]
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

	'GCLOUD_FD_NOT_AVAILABLE'		=> 'Щоб використовувати Google Cloud Fraud Defense, створіть проєкт Google Cloud із reCAPTCHA Enterprise та вкажіть ключ сайту, ключ API й ідентифікатор проєкту.',
	'GCLOUD_FD_INCORRECT'			=> 'Google Cloud Fraud Defense відхилив цей запит. Спробуйте ще раз.',
	'GCLOUD_FD_NOSCRIPT'			=> 'Увімкніть JavaScript у браузері, щоб Fraud Defense міг перевірити цю форму.',
	'GCLOUD_FD_EXPLAIN'				=> 'Цей сайт використовує Google Cloud Fraud Defense, щоб підтвердити, що ви не бот. Додаткових кроків не потрібно.',
	'GCLOUD_FD_PREVIEW_MSG'			=> 'Fraud Defense працює непомітно. Після збереження ключа сайту, ключа API та ідентифікатора проєкту Google оцінює надсилання у фоні.',

	'GCLOUD_FD_SITEKEY'				=> 'Ключ сайту reCAPTCHA',
	'GCLOUD_FD_SITEKEY_EXPLAIN'		=> 'Ключ сайту на основі оцінки з Google Cloud reCAPTCHA / Fraud Defense.',
	'GCLOUD_FD_APIKEY'				=> 'Ключ API Google Cloud',
	'GCLOUD_FD_APIKEY_EXPLAIN'		=> 'Ключ API з увімкненим reCAPTCHA Enterprise API. Обмежте його recaptchaenterprise.googleapis.com.',
	'GCLOUD_FD_PROJECT'				=> 'Ідентифікатор проєкту Google Cloud',
	'GCLOUD_FD_PROJECT_EXPLAIN'		=> 'Ідентифікатор проєкту Google Cloud, якому належить ключ reCAPTCHA.',
	'GCLOUD_FD_SCORE'				=> 'Мінімальна оцінка',
	'GCLOUD_FD_SCORE_EXPLAIN'		=> 'Відхиляти токени нижче цього значення (0.00 — м’якше, 1.00 — суворіше). Типове значення 0.50.',
));
