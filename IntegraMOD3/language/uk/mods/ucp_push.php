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