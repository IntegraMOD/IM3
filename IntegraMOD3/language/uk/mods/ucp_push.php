<?php
/**
* ucp_push [Language File]
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
    'UCP_PUSH_NOTIFICATIONS'			=> 'Push-сповіщення',
    'UCP_PUSH_EXPLAIN'			=> 'Керуйте своїми налаштуваннями push-сповіщень. Тільки типи сповіщень, увімкнені адміністраторами, з\'являться нижче.',
    'USER_PUSH_BROWSER'			=> 'Сповіщення на робочому столі / у браузері',
    'USER_PUSH_BROWSER_EXPLAIN'	=> 'Цей браузер має бути підписаний, перш ніж веб-push з\'явиться на вашому робочому столі. Натисніть Увімкнути, а потім Дозволити, коли браузер запитає.',
    'USER_PUSH_BROWSER_ENABLE'	=> 'Увімкнути сповіщення на робочому столі',
    'USER_PUSH_BROWSER_ON'		=> 'Цей браузер підписаний.',
    'USER_PUSH_BROWSER_OFF'		=> 'Цей браузер не підписаний.',
    'USER_PUSH_BROWSER_LOADING'	=> 'Завантаження сповіщень на робочому столі...',
    'USER_PUSH_BROWSER_BLOCKED'	=> 'Службу сповіщень (cdn.onesignal.com) заблокував ваш браузер або розширення, наприклад DuckDuckGo Privacy Essentials, uBlock Origin, AdGuard, Brave Shields чи суворий захист від відстеження Firefox. Дозвольте її для цього сайту, а потім',
    'USER_PUSH_BROWSER_RETRY'	=> 'спробуйте ще раз',
    'USER_PUSH_BROWSER_DENIED'	=> 'Сповіщення для цього сайту заблоковано в налаштуваннях вашого браузера.',
    'USER_PUSH_BROWSER_UNSUPPORTED'	=> 'Сповіщення на робочому столі не підтримуються в цьому браузері.',
    'USER_PUSH_BROWSER_NOT_CONFIGURED'	=> 'Push-сповіщення не налаштовано.',
    'USER_PUSH_BROWSER_ERROR'	=> 'Не вдалося ініціалізувати сповіщення на робочому столі: %s',
    'UCP_PUSH_SETTINGS'			=> 'Налаштування сповіщень',
    'UCP_PUSH_SETTINGS_SAVED'			=> 'Ваші налаштування push-сповіщень були збережені.',
    'USER_MOBILE'			=> 'Номер мобільного телефону',
    'USER_MOBILE_EXPLAIN'			=> 'Необхідно для SMS-сповіщень.<br> З міркувань безпеки цей номер телефону зашифровано і адміністрація не має до нього доступу.',
    'USER_MOBILE_CC'			=> 'Код країни',
    'USER_MOBILE_CC_EXPLAIN'			=> 'Введіть код своєї країни в першому полі (напр. 380 для України) та номер телефону в другому. Код країни є обов\'язковим.',
    'MOBILE_CC_REQUIRED'			=> 'Разом із номером телефону потрібно ввести код країни. Для надсилання SMS необхідний міжнародний код країни (напр. 380 для України).',
    'EVENT'			=> 'Тип події',
    'WEB_PUSH'			=> 'Web Push',
    'SMS_PUSH'			=> 'SMS Push',
    'USER_PUSH_FRIEND_REQ'			=> 'Запити в друзі',
    'USER_PUSH_FRIEND_ACC'			=> 'Прийняті запити',
    'USER_PUSH_PM'			=> 'Приватні повідомлення',
    'USER_PUSH_LIKE'			=> 'Вподобайки',
    'USER_PUSH_ACTIVITY'			=> 'Сповіщення про активність',
    'USER_PUSH_SUB_POST'			=> 'Відповіді в підписаних темах',
    'USER_PUSH_SUB_TOPIC'			=> 'Оновлення підписаних тем',
    'USER_PUSH_NEWS'			=> 'Новинні трансляції',
    'USER_PUSH_ANNOUNCE'			=> 'Оголошення',
));

?>