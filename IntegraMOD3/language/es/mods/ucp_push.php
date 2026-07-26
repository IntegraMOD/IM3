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
    'UCP_PUSH_NOTIFICATIONS'			=> 'Notificaciones Push',
    'UCP_PUSH_EXPLAIN'			=> 'Administre sus preferencias de notificaciones push. Solamente aparecerán debajo los tipos de notificaciones habilitadas por los administradores.',
    'UCP_PUSH_SETTINGS'			=> 'Preferencias de Notificaciones',
    'UCP_PUSH_SETTINGS_SAVED'			=> 'Tus preferencias de notificaciones push han sido guardadas.',
    'USER_MOBILE'			=> 'Número de Teléfono Móvil',
    'USER_MOBILE_EXPLAIN'			=> 'Requerido para notificaciones por SMS.<br> Por seguridad, este número de teléfono está encriptado y no puede ser leído por la administración.',
    'USER_MOBILE_CC'			=> 'Código de país',
    'USER_MOBILE_CC_EXPLAIN'			=> 'Introduzca el código de su país en la primera casilla (p. ej. 34 para España) y su número de teléfono en la segunda. El código de país es obligatorio.',
    'MOBILE_CC_REQUIRED'			=> 'Debe introducir un código de país junto con su número de teléfono. El envío de SMS requiere el código de país internacional (p. ej. 34 para España).',
    'EVENT'			=> 'Tipo de Evento',
    'WEB_PUSH'			=> 'Web Push',
    'SMS_PUSH'			=> 'SMS Push',
    'USER_PUSH_FRIEND_REQ'			=> 'Solicitudes de Amistad',
    'USER_PUSH_FRIEND_ACC'			=> 'Solicitudes Aceptadas',
    'USER_PUSH_PM'			=> 'Mensajes Privados',
    'USER_PUSH_LIKE'			=> 'Me Gusta',
    'USER_PUSH_ACTIVITY'			=> 'Notificaciones de Actividad',
    'USER_PUSH_SUB_POST'			=> 'Respuestas a Temas Suscritos',
    'USER_PUSH_SUB_TOPIC'			=> 'Actualizaciones de Temas Suscritos',
    'USER_PUSH_NEWS'			=> 'Difusión de Noticias',
    'USER_PUSH_ANNOUNCE'			=> 'Difusión de Anuncios',
));

?>