<?php
/**
 * @package   	OneAll Social Login Mod
 * @copyright 	Copyright 2011-Present http://www.oneall.com - All rights reserved.
 * @license   	GNU/GPL 2 or later
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,USA.
 *
 * The "GNU General Public License" (GPL) is available at
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */
if (!defined ('IN_PHPBB'))
{
	exit;
}

if (!isset ($lang) || !is_array ($lang))
{
	$lang = array ();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a URL you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
$lang = array_merge ($lang,
	array (
		'OASL_DO_AVATARS' => '¿Habilitar la subida de avatares desde la red social?',
		'OASL_DO_AVATARS_DESC' => 'Permite obtener el avatar del perfil del usuario en su red social y almacenarlo en la carpeta de avatares de phpBB.',
		'OASL_DO_AVATARS_ENABLE_YES' => 'Sí, usar avatares de las redes sociales',
		'OASL_DO_AVATARS_ENABLE_NO' => 'No, no usar avatares de las redes sociales',
		'OASL_PROFILE_TITLE' => 'Social Login',
		'OASL_PROFILE_DESC' => 'Vincula tu cuenta a una red social',
		'OASL_WIDGET_TITLE' => 'Iniciar sesión con una red social:',
		'OASL_SETTNGS_UPDATED' => 'Ajustes actualizados correctamente.',
		'OASL_INTRO' => 'Permite que tus visitantes inicien sesión y se registren con redes sociales como Twitter, Facebook, LinkedIn, Hyves, VKontakte, Google y Yahoo, entre otras. Social Login <strong>aumenta tu tasa de registro de usuarios</strong> al simplificar el proceso de registro y proporciona <strong>datos sociales obtenidos de los perfiles de las redes sociales</strong> basados en permisos. Social Login se integra con tu sistema de registro existente para que tú y tus usuarios no tengáis que empezar desde cero.',
		'OASL_TITLE' => 'OneAll Social Login',
		'OASL_TITLE_HELP' => 'Ayuda, actualizaciones &amp; documentación',
		'OASL_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Síguenos</a> en Twitter para mantenerte informado sobre las actualizaciones;',
		'OASL_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/" class="external">Lee</a> la documentación en línea para obtener más información sobre este plugin;',
		'OASL_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Descubre</a> nuestros plugins llave en mano para Drupal, Joomla, WordPress;',
		'OASL_GET_HELP' => '<a href="http://www.oneall.com/company/contact-us/" class="external">Contáctanos</a> si tienes comentarios o necesitas ayuda.',
		'OASL_CREATE_ACCOUNT_FIRST' => 'Para poder usar Social Login, primero debes crear una cuenta gratuita en <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a> y configurar un sitio.',
		'OASL_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Configurar mi cuenta gratuita</a>',
		'OASL_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Crear y ver mis credenciales de API</a>',
		'OASL_API_CONNECTION' => 'Conexión API',
		'OASL_API_CONNECTION_HANDLER' => 'Controlador de conexión API:',
		'OASL_CURL' => 'PHP CURL',
		'OASL_CURL_DESC' => 'Se recomienda usar CURL, pero puede estar deshabilitado en algunos servidores.',
		'OASL_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">Manual de CURL</a>',
		'OASL_FSOCKOPEN' => 'PHP FSOCKOPEN',
		'OASL_FSOCKOPEN_DESC' => 'Usa FSOCKOPEN solo si tienes problemas con CURL.',
		'OASL_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">Manual de FSOCKOPEN</a>',
		'OASL_API_PORT' => 'Puerto de conexión API:',
		'OASL_PORT_443' => 'Comunicación vía HTTPS en el puerto 443',
		'OASL_PORT_443_DESC' => 'Se recomienda usar el puerto 443, pero es posible que tengas que instalar OpenSSL en tu servidor.',
		'OASL_PORT_80' => 'Comunicación vía HTTP en el puerto 80',
		'OASL_PORT_80_DESC' => 'Usar el puerto 80 es un poco más rápido y no necesita OpenSSL, pero es menos seguro.',
		'OASL_API_AUTODETECT' => 'Detectar automáticamente la conexión API',
		'OASL_API_CREDENTIALS_TITLE' => 'Credenciales de API - <a href="https://app.oneall.com/applications/" class="external">Haz clic aquí para crear o ver tus credenciales de API</a>',
		'OASL_API_SUBDOMAIN' => 'Subdominio de API:',
		'OASL_API_PUBLIC_KEY' => 'Clave pública de API:',
		'OASL_API_PRIVATE_KEY' => 'Clave privada de API:',
		'OASL_API_VERIFY' => 'Verificar ajustes de API',
		'OASL_ENABLE_NETWORKS' => 'Habilita las redes sociales/proveedores de identidad que elijas',
		'OASL_DO_ENABLE' => '¿Habilitar Social Login?',
		'OASL_DO_ENABLE_DESC' => 'Te permite deshabilitar temporalmente Social Login sin tener que eliminarlo.',
		'OASL_DO_ENABLE_YES' => 'Habilitar Social Login',
		'OASL_DO_ENABLE_NO' => 'Deshabilitar Social Login',
		'OASL_DEFAULT' => 'Predeterminado',
		'OASL_DO_LINKING' => '¿Habilitar la vinculación de cuentas de redes sociales?',
		'OASL_DO_LINKING_ASK' => '¿Vincular automáticamente las cuentas de redes sociales a las cuentas de usuario existentes?',
		'OASL_DO_LINKING_DESC' => 'Si está habilitado, las cuentas de redes sociales con una dirección de correo electrónico verificada se vincularán a las cuentas de usuario de phpBB existentes que tengan la misma dirección de correo.',
		'OASL_DO_LINKING_YES' => 'Habilitar la vinculación de cuentas',
		'OASL_DO_LINKING_NO' => 'Deshabilitar la vinculación de cuentas',
		'OASL_DO_REDIRECT' => 'Configurar redirección',
		'OASL_DO_REDIRECT_ASK' => 'Redirigir a los usuarios a esta página después de conectarse con su cuenta de red social:',
		'OASL_DO_REDIRECT_DESC' => 'Introduce una URL completa de una página de tu phpBB. Si se deja vacía, el usuario permanece en la misma página.',
		'OASL_API_DETECT_CURL' => 'Se detectó CURL en el puerto %s. ¡No olvides guardar los cambios!',
		'OASL_API_DETECT_FSOCKOPEN' => 'Se detectó FSOCKOPEN en el puerto %s. ¡No olvides guardar los cambios!',
		'OASL_API_DETECT_NONE' => '¡Error de conexión! Tu firewall debe permitir solicitudes salientes en el puerto 80 o 443.',
		'OASL_API_CREDENTIALS_FILL_OUT' => 'Por favor, rellena cada uno de los campos anteriores.',
		'OASL_API_CREDENTIALS_USE_AUTO' => 'El controlador de conexión no parece funcionar. Por favor, usa la detección automática.',
		'OASL_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'El subdominio no existe. ¿Lo has rellenado correctamente?',
		'OASL_API_CREDENTIALS_KEYS_WRONG' => 'Las credenciales de API son incorrectas, por favor comprueba tu clave pública/privada.',
		'OASL_API_CREDENTIALS_CHECK_COM' => 'No se pudo contactar con la API. ¿Está la conexión API configurada correctamente?',
		'OASL_API_CREDENTIALS_UNKNOW_ERROR' => 'Respuesta desconocida. Por favor, asegúrate de haber iniciado sesión.',
		'OASL_API_CREDENTIALS_OK' => 'Los ajustes son correctos. ¡No olvides guardar los cambios!',
		'OASL_SETTINGS' => 'Ajustes de OneAll Social Login',
		'OASL_ENABLE_SOCIAL_NETWORK' => 'Debes habilitar al menos una red social',
		'OASL_ENTER_CREDENTIALS' => 'Debes configurar tus credenciales de API',
		'OASL_ACCOUNT_ALREADY_LINKED' => 'Esta cuenta de red social ya está vinculada a otro usuario del foro.',
		'OASL_ACCOUNT_INACTIVE_OTHER' => 'La cuenta ha sido creada. Sin embargo, los ajustes del foro requieren la activación de la cuenta.<br />Se ha enviado una clave de activación a tu dirección de correo electrónico.',
		'OASL_ACCOUNT_INACTIVE_ADMIN' => 'La cuenta ha sido creada. Sin embargo, los ajustes del foro requieren la activación de la cuenta por parte de un administrador.<br />Se ha enviado un correo a los administradores y se te informará por correo electrónico una vez que tu cuenta haya sido activada.'
	));
