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
    'USER_PUSH_BROWSER'			=> 'Notificaciones de escritorio / navegador',
    'USER_PUSH_BROWSER_EXPLAIN'	=> 'Este navegador debe estar suscrito antes de que las notificaciones web puedan aparecer en su escritorio. Haga clic en Activar y luego en Permitir cuando el navegador lo solicite.',
    'USER_PUSH_BROWSER_ENABLE'	=> 'Activar notificaciones de escritorio',
    'USER_PUSH_BROWSER_ON'		=> 'Este navegador está suscrito.',
    'USER_PUSH_BROWSER_OFF'		=> 'Este navegador no está suscrito.',
    'USER_PUSH_BROWSER_LOADING'	=> 'Cargando notificaciones de escritorio...',
    'USER_PUSH_BROWSER_BLOCKED'	=> 'El servicio de notificaciones (cdn.onesignal.com) fue bloqueado por su navegador o por una extensión como DuckDuckGo Privacy Essentials, uBlock Origin, AdGuard, Brave Shields o la protección estricta contra rastreo de Firefox. Permítalo para este sitio y luego',
    'USER_PUSH_BROWSER_RETRY'	=> 'reintente',
    'USER_PUSH_BROWSER_DENIED'	=> 'Las notificaciones están bloqueadas para este sitio en la configuración de su navegador.',
    'USER_PUSH_BROWSER_UNSUPPORTED'	=> 'Las notificaciones de escritorio no son compatibles con este navegador.',
    'USER_PUSH_BROWSER_NOT_CONFIGURED'	=> 'Las notificaciones push no están configuradas.',
    'USER_PUSH_BROWSER_ERROR'	=> 'No se pudieron inicializar las notificaciones de escritorio: %s',
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