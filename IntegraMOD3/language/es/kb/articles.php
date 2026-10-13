<?php
/**
*
* Knowledge Base article catalog [Spanish]
*
* Use whole-field tokens such as {L_RANDOM_NAME} in the article title,
* description, or body when creating a Knowledge Base article.
* Do not merge this file into $user->lang.
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

//
// ARTICLE INDEX
// Search for "START ARTICLE: NAME" to jump directly to an article.
// Each article contains its title, description, and body keys.
//
// 1. RANDOM
// 2. SAVE_FORUM_APP
// 3. PUSH_NOTIFICATIONS
// 4. KB_SETUP
// 5. K_LINKS_BANNER_UPLOAD
// 6. STYLE_INSTALL
// 7. IM_INSTALL
//
$lang = array_merge($lang, array(

// ===== START ARTICLE: RANDOM =====
    'RANDOM_TITLE'       => 'Ejemplo de título localizado',
    'RANDOM_DESCRIPTION' => 'Ejemplo de descripción localizada',
    'RANDOM_ARTICLE'     => 'Este es un ejemplo del cuerpo de un artículo de la Base de Conocimientos localizado. Puede usar BBCode aquí.',

// ===== END ARTICLE: RANDOM =====


// ===== START ARTICLE: SAVE_FORUM_APP =====
    'SAVE_FORUM_APP'			=> 'Guardar el foro como una aplicación',
    'SAVE_FORUM_APP_DESC'		=> 'Añada el foro al escritorio, la pantalla de inicio o el Dock para abrirlo como una aplicación.',
    'SAVE_FORUM_APP_ARTICLE'	=> '[anchor=app_top][/anchor][b]IntegraMOD como aplicación[/b]

Poner el foro en el escritorio o en la pantalla de inicio es solo un acceso directo, pero uno útil. Se abre en su propia ventana en lugar de perderse entre un montón de pestañas. En el móvil queda junto al resto de apps y arranca a pantalla completa. Un toque en la barra de tareas, el Dock o la pantalla de inicio y ya está dentro.

Sigue haciendo falta internet, y la sesión es la misma que en el navegador con el que lo añadió. No se descarga nada de una tienda.

Elija el navegador que usa de verdad y salte a los pasos.

[b]Navegadores de escritorio[/b]
[list]
[*][anchor=toc_chrome goto=chrome]Google Chrome[/anchor]
[*][anchor=toc_edge goto=edge]Microsoft Edge[/anchor]
[*][anchor=toc_safari_mac goto=safari_mac]Safari (Mac)[/anchor]
[*][anchor=toc_firefox_desk goto=firefox_desk]Firefox[/anchor]
[/list]

[b]Navegadores móviles[/b]
[list]
[*][anchor=toc_safari_ios goto=safari_ios]Safari (iPhone / iPad)[/anchor]
[*][anchor=toc_chrome_and goto=chrome_and]Chrome (Android)[/anchor]
[*][anchor=toc_firefox_and goto=firefox_and]Firefox (Android)[/anchor]
[/list]

[b]Después[/b]
[list]
[*][anchor=toc_push_top goto=push]Activar las notificaciones push[/anchor]
[/list]

[anchor=chrome][b]Google Chrome (escritorio)[/b][/anchor]

Funciona en Windows, macOS y Linux.

[list=1]
[*]Abra el foro en Chrome.
[*]En la barra de direcciones suele haber un icono pequeño de instalar. Casi siempre es un ordenador con una flecha hacia abajo, o un más sobre una pantalla.
[*]¿No lo ve? Abra el menú de tres puntos y elija [b]Instalar aplicación[/b] o [b]Instalar este sitio como una aplicación[/b].
[*]Deje o cambie el nombre y pulse [b]Instalar[/b].
[/list]

Chrome lo deja en el menú Inicio o en la carpeta Aplicaciones. Anclelo a la barra de tareas o al Dock si lo quiere a un clic. Se abre en una ventana sencilla, sin la tira de pestañas.

Para quitarlo después, abra la app, use su menú y elija Desinstalar.

[anchor=back_chrome goto=app_top]Volver arriba[/anchor]

[anchor=edge][b]Microsoft Edge (escritorio)[/b][/anchor]

La misma idea que Chrome, y el texto es casi igual.

[list=1]
[*]Abra el foro en Edge.
[*]Pulse el icono de instalar en la barra de direcciones si aparece.
[*]Si no, abra el menú de tres puntos y elija [b]Aplicaciones → Instalar este sitio como una aplicación[/b].
[*]Confirme el nombre y pulse [b]Instalar[/b].
[/list]

Luego puede anclarlo a la barra de tareas o a Inicio. Desinstale desde el menú de la app o borre el acceso directo.

[anchor=back_edge goto=app_top]Volver arriba[/anchor]

[anchor=safari_mac][b]Safari (Mac)[/b][/anchor]

[list=1]
[*]Abra el foro en Safari.
[*]Elija [b]Archivo → Añadir al Dock[/b]. En algunas versiones está bajo Compartir.
[*]Confirme el nombre y añádalo.
[/list]

Safari deja un icono en el Dock. Al pulsarlo, el foro se abre en su propia ventana.

[anchor=back_safari_mac goto=app_top]Volver arriba[/anchor]

[anchor=firefox_desk][b]Firefox (escritorio)[/b][/anchor]

Firefox no instala aplicaciones web como Chrome o Edge. Aun así puede tenerlo a mano:

[list]
[*]marque el foro, o
[*]arrastre el icono del candado / sitio desde la barra de direcciones al escritorio.
[/list]

Ese acceso directo sigue abriendo una ventana normal de Firefox, pero evita buscar entre los marcadores.

[anchor=back_firefox_desk goto=app_top]Volver arriba[/anchor]

[anchor=safari_ios][b]Safari (iPhone / iPad)[/b][/anchor]

Use Safari. Chrome en el iPhone no puede añadir una app de verdad a la pantalla de inicio de la misma forma.

[list=1]
[*]Abra el foro en Safari.
[*]Pulse [b]Compartir[/b] (el cuadrado con la flecha hacia arriba).
[*]Baje por la hoja de compartir y pulse [b]Añadir a pantalla de inicio[/b].
[*]Cambie el nombre si quiere y pulse [b]Añadir[/b].
[/list]

El icono queda en la pantalla de inicio y abre el foro a pantalla completa.

Si no sale Añadir a pantalla de inicio, pulse Editar acciones o Más en la hoja de compartir y actívelo.

[anchor=back_safari_ios goto=app_top]Volver arriba[/anchor]

[anchor=chrome_and][b]Chrome (Android)[/b][/anchor]

[list=1]
[*]Abra el foro en Chrome.
[*]Pulse el menú de tres puntos.
[*]Pulse [b]Instalar aplicación[/b] o [b]Añadir a pantalla de inicio[/b].
[*]Confirme [b]Instalar[/b] o [b]Añadir[/b].
[/list]

A veces Android también muestra un banner de Instalar al pie. Ese también vale.

El icono aparece en la pantalla de inicio o en el cajón de apps y se abre en su propia ventana.

[anchor=back_chrome_and goto=app_top]Volver arriba[/anchor]

[anchor=firefox_and][b]Firefox (Android)[/b][/anchor]

[list=1]
[*]Abra el foro en Firefox.
[*]Abra el menú del navegador.
[*]Pulse [b]Instalar[/b] o [b]Añadir a pantalla de inicio[/b] si el teléfono lo ofrece.
[/list]

Si no sale esa opción, añada un marcador. No queda tan limpio como un icono de app, pero sigue estando a un toque.

[anchor=back_firefox_and goto=app_top]Volver arriba[/anchor]

[b]Cuando ya está instalado[/b]
[list]
[*][anchor=toc_push goto=push]Activar las notificaciones push[/anchor]
[/list]

[anchor=push][b]Activar las notificaciones push[/b][/anchor]

El icono no activa las notificaciones. Solo es una ventana del mismo navegador con el que lo añadió. El push pertenece a ese navegador y no arranca hasta que lo permita con la sesión iniciada.

Abra el foro desde el icono nuevo, no desde una pestaña vieja. Inicie sesión ahí. Luego, en su perfil: [b]Panel de Control de Usuario[/b] → [b]Preferencias de Foros[/b] → [b]Notificaciones Push[/b].

Esa página suscribe [i]este[/i] navegador o ventana de la app. Pulse [b]Activar notificaciones del navegador[/b]. El navegador pedirá permiso; elija [b]Permitir[/b]. Si funcionó, la página dice [b]Este navegador está suscrito.[/b]

Ese permiso solo deja enviar. Debajo, marque [b]Web Push[/b] en los eventos que quiera (mensajes privados, me gusta, temas suscritos, etc.) y pulse [b]Enviar[/b].

Repítalo en cada teléfono, tableta u ordenador donde haya instalado el foro. Activarlo en un aparato no lo enciende en los demás. Si [b]Activar notificaciones del navegador[/b] no hace nada, el navegador o una extensión está bloqueando las notificaciones de este sitio. Permítalo para el foro y pulse el botón otra vez.

[b]Un par de notas más[/b]
[list]
[*]Abra el icono nuevo una vez e inicie sesión. Esa sesión se queda en el navegador con el que lo añadió.
[*]Si el icono abre una página en blanco, bórrelo y añádalo otra vez desde la dirección HTTPS actual, no desde un marcador viejo.
[*]Actualizar el foro no obliga a volver a crear el icono.
[/list]

[anchor=back_push goto=app_top]Volver arriba[/anchor]',

// ===== END ARTICLE: SAVE_FORUM_APP =====


// ===== START ARTICLE: PUSH_NOTIFICATIONS =====
	'PUSH_NOTIFICATIONS'			=> 'Notificaciones push',
	'PUSH_NOTIFICATIONS_DESC'		=> 'Active avisos del navegador para mensajes privados, «me gusta» y otros sucesos del foro.',
	'PUSH_NOTIFICATIONS_ARTICLE'	=> '[anchor=push_top][/anchor][b]Notificaciones push[/b]

Push es un aviso breve del foro cuando ocurre algo y usted no está mirando. Un mensaje privado, un «me gusta», una respuesta en un tema que sigue. Aparece en el navegador o en el teléfono, como en otros sitios.

El foro puede enviar. El navegador tiene que permitirlo. Eso se hace una vez por aparato, mientras está identificado.

[b]Ir a[/b]
[list]
[*][anchor=toc_before goto=before]Antes de empezar[/anchor]
[*][anchor=toc_enable goto=enable]Activarlo[/anchor]
[*][anchor=toc_events goto=events]Elegir sucesos[/anchor]
[*][anchor=toc_devices goto=devices]Más de un aparato[/anchor]
[*][anchor=toc_sms goto=sms]SMS (opcional)[/anchor]
[*][anchor=toc_admin goto=admin]Configuración del administrador[/anchor]
[*][anchor=toc_fix goto=fix]Si no funciona[/anchor]
[/list]

[anchor=before][b]Antes de empezar[/b][/anchor]

[list]
[*]Use HTTPS. Push no funciona en una dirección http simple.
[*]Inicie sesión. Los invitados no pueden suscribirse.
[*]Abra el foro en el navegador (o ventana de aplicación) donde quiera los avisos. El permiso pertenece a ese navegador, no a toda la cuenta.
[/list]

Si añadió el foro como aplicación, ábralo desde ese icono, no desde una pestaña vieja. Luego siga los pasos en esa ventana.

[anchor=back_before goto=push_top]Volver arriba[/anchor]

[anchor=enable][b]Activarlo[/b][/anchor]

[list=1]
[*]Abra [b]Panel de control del usuario[/b] → [b]Preferencias del foro[/b] → [b]Notificaciones Push[/b].
[*]Pulse [b]Activar notificaciones del navegador[/b] (a veces dice [b]Activar notificaciones de escritorio[/b]).
[*]Cuando el navegador pregunte, elija [b]Permitir[/b].
[*]La página debería decir entonces [b]Este navegador está suscrito.[/b]
[/list]

Ese permiso solo deja enviar al foro. Los sucesos se eligen después.

[anchor=back_enable goto=push_top]Volver arriba[/anchor]

[anchor=events][b]Elegir sucesos[/b][/anchor]

Bajo el estado de la suscripción, marque [b]Web Push[/b] en los sucesos que quiera y pulse [b]Enviar[/b].

Sucesos habituales (solo aparecen los que el administrador ha activado):
[list]
[*]Mensajes privados
[*]«Me gusta»
[*]Solicitudes de amistad y aceptaciones
[*]Respuestas en mensajes que sigue
[*]Actualizaciones en temas que sigue
[*]Noticias y anuncios
[*]Menciones, cuando alguien escribe @sunombre en un foro permitido
[*]Nuevos registros y nuevos mensajes, para el personal o los grupos elegidos por el administrador
[/list]

Deje una casilla vacía si no quiere ese aviso.

[anchor=back_events goto=push_top]Volver arriba[/anchor]

[anchor=devices][b]Más de un aparato[/b][/anchor]

Activarlo en un teléfono, tableta u ordenador no lo enciende en los demás. Repita los pasos en cada navegador o ventana de aplicación que haya instalado.

[anchor=back_devices goto=push_top]Volver arriba[/anchor]

[anchor=sms][b]SMS (opcional)[/b][/anchor]

Si el administrador activó SMS, la misma página puede pedir un código de país y un número móvil. Ese número se guarda cifrado. Marque [b]SMS Push[/b] solo en los sucesos que quiera como mensaje de texto.

[anchor=back_sms goto=push_top]Volver arriba[/anchor]

[anchor=admin][b]Configuración del administrador[/b][/anchor]

Abra [b]ACP → General → Notificaciones Push → Ajustes[/b]. Las notificaciones del navegador usan OneSignal. Los SMS pueden usar OneSignal o Twilio.

[b]OneSignal[/b]
[list]
[*]Cree una aplicación en OneSignal y copie su [b]App ID[/b] y su [b]REST API key[/b] en los campos correspondientes.
[*]El sitio debe usar HTTPS. El dominio también debe estar permitido en la aplicación de OneSignal.
[*]Sin App ID, nadie puede suscribirse a las notificaciones del navegador.
[/list]

[b]Twilio[/b]
[list]
[*]Ponga [b]SMS gateway[/b] en [b]Twilio[/b]. Déjelo en OneSignal si los SMS deben enviarse por OneSignal.
[*][b]Twilio SID[/b] es el Account SID de la consola de Twilio.
[*][b]Twilio Token[/b] es el Auth Token de esa cuenta.
[*][b]Twilio From Number[/b] es el número de Twilio que envía el SMS, con el código de país, por ejemplo +15551234567.
[*]Los campos de Twilio se ignoran mientras la pasarela siga en OneSignal.
[/list]

[b]Opciones de sucesos[/b]

La tabla activa o desactiva cada suceso para [b]Web Push[/b] y [b]SMS Push[/b]. Un usuario solo puede elegir un suceso después de activarlo aquí.

[list]
[*][b]Nuevo registro[/b] solo llega a fundadores y administradores. Marque [b]Include moderators[/b] si los moderadores también deben recibirlo.
[*][b]Nuevo mensaje[/b] llega a ese mismo público. Use [b]New-post groups[/b] para añadir otros grupos. Mantenga Ctrl pulsado para elegir varios grupos.
[*][b]Mención[/b] avisa a un usuario cuando se publica una mención válida de @nombre. El usuario también debe activarla en su panel.
[/list]

[b]Menciones[/b]

Las menciones tienen dos controles, y ambos deben estar activos:
[list]
[*][b]ACP → Publicación → Mensajes → Ajustes de mensajes → Permitir menciones[/b] controla todo el foro. Al activarlo por primera vez se activan las menciones en los foros existentes.
[*][b]ACP → Foros → Crear o editar foro → Permitir menciones[/b] controla un foro. Los foros nuevos empiezan activados. Desmárquelo en un foro que no deba permitir menciones.
[/list]

El usuario escribe @nombre en el editor o en la respuesta rápida y elige un nombre de la lista. El mensaje lo guarda como etiqueta de mención. Si cualquiera de los ajustes está desactivado, la lista no aparece y no se envía ninguna notificación.

[anchor=back_admin goto=push_top]Volver arriba[/anchor]

[anchor=fix][b]Si no funciona[/b][/anchor]

[list]
[*]El botón no hace nada, o la página nunca dice que el navegador está suscrito: este sitio tiene bloqueadas las notificaciones. Permítalo en la configuración del navegador y pulse el botón otra vez.
[*]Una extensión como uBlock, AdGuard, Brave Shields, DuckDuckGo o la protección estricta de rastreo de Firefox puede bloquear el servicio. Permítalo para este foro.
[*]No ha iniciado sesión, o abrió un marcador HTTP antiguo.
[*]Lo permitió en un navegador y espera en otro. Suscriba cada uno.
[/list]

Los administradores configuran el servicio en [b]ACP → General → Notificaciones Push → Ajustes[/b]. Sin OneSignal App ID, nadie puede suscribirse. Los SMS también necesitan que la pasarela elegida, OneSignal o Twilio, esté completa. Una mención solo avisa cuando las menciones del sitio, las del foro y la preferencia del usuario están activadas.

[anchor=back_fix goto=push_top]Volver arriba[/anchor]',

// ===== END ARTICLE: PUSH_NOTIFICATIONS =====


// ===== START ARTICLE: KB_SETUP =====
	'KB_SETUP'			=> 'Configurar la Base de conocimientos',
	'KB_SETUP_DESC'		=> 'Cree categorías, tipos y permisos, y luego publique artículos.',
	'KB_SETUP_ARTICLE'	=> '[anchor=kb_top][/anchor][b]Configurar la Base de conocimientos[/b]

La Base de conocimientos es una biblioteca de artículos aparte, no un foro. El equipo escribe artículos; los lectores recorren categorías. Toda la configuración está en el Panel de administración.

[b]Ir a[/b]
[list]
[*][anchor=toc_config goto=config]Configuración[/anchor]
[*][anchor=toc_cats goto=cats]Categorías[/anchor]
[*][anchor=toc_types goto=types]Tipos de artículo[/anchor]
[*][anchor=toc_perms goto=perms]Permisos[/anchor]
[*][anchor=toc_write goto=write]Añadir un artículo[/anchor]
[*][anchor=toc_lang goto=lang]Traducir un artículo[/anchor]
[/list]

[anchor=config][b]Configuración[/b][/anchor]

ACP → [b]Base de conocimientos[/b] → [b]Configuración[/b].

Ponga el nombre y la descripción que ven los lectores en el índice. Luego:
[list]
[*]Cuántos artículos mostrar en ese índice
[*]Diseño del índice: Moderno o Clásico
[*]Tiempo de caché de categorías y tipos
[*]Si los artículos pueden tener tipo, valoración, historial de versiones antiguas y «artículos similares»
[*]Si un artículo nuevo también crea un tema en un foro (el ID de foro [b]0[/b] lo desactiva)
[/list]

Guarde al terminar.

[anchor=back_config goto=kb_top]Volver arriba[/anchor]

[anchor=cats][b]Categorías[/b][/anchor]

ACP → [b]Base de conocimientos[/b] → [b]Categorías[/b].

Cree primero una categoría principal y debajo subcategorías. Los artículos van en las subcategorías; el índice no puede contenerlos.

Dé a cada categoría un nombre, descripción opcional y URL de imagen opcional. Use [b]Mostrar en la categoría principal[/b] si debe aparecer en la portada de la KB.

[anchor=back_cats goto=kb_top]Volver arriba[/anchor]

[anchor=types][b]Tipos de artículo[/b][/anchor]

ACP → [b]Base de conocimientos[/b] → [b]Tipos de artículo[/b].

Los tipos son etiquetas como Manual, FAQ o Política. Son opcionales. Active «Usar tipos de artículo» en Configuración si quiere el campo en el formulario.

[anchor=back_types goto=kb_top]Volver arriba[/anchor]

[anchor=perms][b]Permisos[/b][/anchor]

ACP → [b]Base de conocimientos[/b] → permisos de categoría.

Defina quién puede ver, añadir, editar y aprobar artículos en cada categoría. Sin [b]kb_view_article[/b] esa categoría no se ve. Publicar sin moderador requiere [b]kb_add_article_direct[/b] (o el permiso de moderador [b]m_activate_kb[/b]).

[anchor=back_perms goto=kb_top]Volver arriba[/anchor]

[anchor=write][b]Añadir un artículo[/b][/anchor]

En la Base de conocimientos elija una categoría y [b]Añadir un artículo[/b]. Rellene título, descripción y cuerpo. Puede usar BBCode.

Si el autor no puede publicar directamente, el artículo espera a que un moderador o administrador lo active. Después es público.

[anchor=back_write goto=kb_top]Volver arriba[/anchor]

[anchor=lang][b]Traducir un artículo[/b][/anchor]

Puede tener un solo artículo en la Base de conocimientos y aun así mostrar un título, una descripción y un texto distintos en cada idioma del foro.

[b]1. Elija un nombre corto[/b]

Use mayúsculas y guiones bajos. Ejemplo: [b]PUSH_NOTIFICATIONS[/b].

Los lectores no ven ese nombre. Solo enlaza el artículo con las traducciones.

[b]2. En el formulario del artículo, ponga solo el marcador[/b]

Cada campo debe ser el marcador y nada más. No lo mezcle con otro texto.

[list]
[*]Título: [b]{L_PUSH_NOTIFICATIONS}[/b]
[*]Descripción: [b]{L_PUSH_NOTIFICATIONS_DESC}[/b]
[*]Texto del artículo: [b]{L_PUSH_NOTIFICATIONS_ARTICLE}[/b]
[/list]

[b]3. Ponga el texto real en los archivos de idioma[/b]

Abra [b]language/en/kb/articles.php[/b] y añada tres líneas:

[code]PUSH_NOTIFICATIONS         => Push notifications
PUSH_NOTIFICATIONS_DESC    => Turn on browser alerts.
PUSH_NOTIFICATIONS_ARTICLE => The full article text goes here.[/code]

Copie los mismos tres nombres en [b]language/nl/kb/articles.php[/b], [b]language/de/kb/articles.php[/b] y cada otra carpeta de idioma que use, con el texto traducido.

El inglés es obligatorio. Si falta una línea en un idioma, se muestra el texto inglés.

[b]4. Cómo guardar el archivo[/b]

Guarde como UTF-8 sin BOM. Notepad++ puede hacerlo. El Bloc de notas de Windows a menudo no, y eso puede romper el foro.

Eso es todo. Tras vaciar la caché, cada lector ve el artículo en su idioma.

[anchor=back_lang goto=kb_top]Volver arriba[/anchor]',

// ===== END ARTICLE: KB_SETUP =====


// ===== START ARTICLE: K_LINKS_BANNER_UPLOAD =====
	'K_LINKS_BANNER_UPLOAD'			=> 'Site Banner Exchange',
	'K_LINKS_BANNER_UPLOAD_DESC'	=> 'Configure el foro de Banner Exchange, los permisos, las carpetas de subida y el flujo de aprobación para envíos de banners del sitio.',
	'K_LINKS_BANNER_UPLOAD_ARTICLE'	=> '[anchor=klinks_top][/anchor][b]Site Banner Exchange[/b]

Site Banner Exchange puede usar un foro para envíos de intercambio de banners y permitir que usuarios de confianza suban un banner junto con el mensaje. La función se instala de forma predeterminada. Los administradores solo deben elegir el foro, establecer permisos y asegurarse de que las carpetas de subida sean escribibles.

[b]Ir a[/b]
[list]
[*][anchor=toc_forum goto=forum]Crear el foro de Banner Exchange[/anchor]
[*][anchor=toc_portal goto=portal]Conectarlo al bloque Site Banner Exchange[/anchor]
[*][anchor=toc_permission goto=permission]Permiso de subida de banners[/anchor]
[*][anchor=toc_folders goto=folders]Carpetas de subida[/anchor]
[*][anchor=toc_banner goto=banner]Crear la imagen del banner[/anchor]
[*][anchor=toc_submit goto=submit]Enviar una entrada de Banner Exchange[/anchor]
[*][anchor=toc_approve goto=approve]La aprobación es obligatoria[/anchor]
[*][anchor=toc_fix goto=fix]Si algo no funciona[/anchor]
[/list]

[anchor=forum][b]Crear el foro de Banner Exchange[/b][/anchor]

Cree un foro normal para los envíos de Banner Exchange. Después de guardarlo, anote el ID del foro. Necesitará ese ID al configurar el bloque Site Banner Exchange.

Establezca los permisos normales del foro phpBB para los grupos o usuarios que deban tener acceso. Conceda solo los permisos de foro necesarios, como ver, leer y publicar. Esto controla el acceso al foro en sí.

El permiso para subir banners es independiente. Un usuario puede tener acceso al foro, pero no podrá subir un banner si no tiene también [b]Puede subir banners de enlaces del portal[/b].

[anchor=back_forum goto=klinks_top]Volver arriba[/anchor]

[anchor=portal][b]Conectarlo al bloque Site Banner Exchange[/b][/anchor]

Vaya a los ajustes del bloque del portal para las variables del bloque Site Banner Exchange ([b]k_links_vars[/b]). Establezca [b]Link forum ID[/b] con el ID del foro anotado antes.

La pestaña de subida de banners solo se aplica en ese foro configurado. Si el ID del foro es incorrecto, los usuarios quizá puedan publicar en un foro, pero no verán allí el flujo esperado de banners.

[anchor=back_portal goto=klinks_top]Volver arriba[/anchor]

[anchor=permission][b]Permiso de subida de banners[/b][/anchor]

El permiso es [b]u_k_links_upload[/b]. En el ACP aparece en permisos de usuario o grupo, en Permisos avanzados → Publicar, como [b]Puede subir banners de enlaces del portal[/b].

De forma predeterminada, los administradores y moderadores globales tienen este permiso. También está incluido en el rol de usuario [b]All Features[/b]. Para cualquier otro grupo o usuario, asígnelo manualmente solo si debe ser de confianza para enviar banners.

Este es un permiso global de usuario/grupo. No sustituye los permisos del foro. El usuario aún necesita acceso al foro de Banner Exchange configurado.

[anchor=back_permission goto=klinks_top]Volver arriba[/anchor]

[anchor=folders][b]Carpetas de subida[/b][/anchor]

El foro usa dos carpetas:

[list]
[*][b]images/links/tmp/[/b] — aquí esperan las subidas de banners pendientes.
[*][b]images/links/[/b] — aquí se mueven los banners aprobados.
[/list]

Ambas carpetas deben ser escribibles por el servidor web. Si [b]images/links/tmp/[/b] no existe, el código de subida puede intentar crearla, pero es más seguro crearla y confirmar los permisos durante la configuración.

[anchor=back_folders goto=klinks_top]Volver arriba[/anchor]

[anchor=banner][b]Crear la imagen del banner[/b][/anchor]

Cree una imagen de banner de no más de [b]200px de ancho por 50px de alto[/b]. Los tipos de archivo aceptados son [b]JPG[/b], [b]JPEG[/b], [b]GIF[/b] y [b]PNG[/b].

Nombre la imagen a partir de la dirección web final que debe abrir. Como un nombre de archivo no puede contener [b]/[/b], sustituya cada barra de la ruta de la URL por [b]+[/b]. No incluya [b]https://[/b] ni [b]http://[/b] en el nombre del archivo.

Ejemplo: para [b]https://integramod.com/forum/[/b], nombre la imagen [b]integramod.com+forum.jpg[/b]. Puede usar el mismo nombre con otra extensión permitida, como [b]integramod.com+forum.jpeg[/b], [b]integramod.com+forum.gif[/b] o [b]integramod.com+forum.png[/b].

Cuando el bloque Site Banner Exchange muestra el banner aprobado, reconstruye la URL desde el nombre del archivo sustituyendo [b]+[/b] por [b]/[/b].

[anchor=back_banner goto=klinks_top]Volver arriba[/anchor]

[anchor=submit][b]Enviar una entrada de Banner Exchange[/b][/anchor]

Un usuario autorizado abre el foro configurado como foro de Banner Exchange y empieza un mensaje. El formulario de publicación muestra una pestaña de subida [b]Site Banner Exchange[/b].

Suba el banner JPG, JPEG, GIF o PNG preparado. El archivo no se publica inmediatamente. Queda preparado en [b]images/links/tmp/[/b] mientras el mensaje espera aprobación.

[anchor=back_submit goto=klinks_top]Volver arriba[/anchor]

[anchor=approve][b]La aprobación es obligatoria[/b][/anchor]

Todos los envíos de Banner Exchange requieren aprobación de un administrador o moderador antes de que el envío esté completo. El mensaje debe aprobarse mediante la cola de moderación normal.

Cuando un administrador o moderador aprueba el mensaje, el banner preparado se mueve de [b]images/links/tmp/[/b] a [b]images/links/[/b]. El registro de la cola queda marcado como aprobado con el aprobador y la hora de aprobación.

Hasta que se produzca esa aprobación, el banner solo está pendiente. No debe tratarse como un banner activo de Site Banner Exchange.

[anchor=back_approve goto=klinks_top]Volver arriba[/anchor]

[anchor=fix][b]Si algo no funciona[/b][/anchor]

[list]
[*][b]Falta la pestaña[/b] — confirme que el bloque Site Banner Exchange tiene el Link forum ID correcto, que el usuario puede acceder a ese foro y que tiene [b]Puede subir banners de enlaces del portal[/b].
[*][b]La subida falla[/b] — confirme que el archivo es JPG, JPEG, GIF o PNG, que no mide más de 200px × 50px, que está nombrado desde la URL de destino y que [b]images/links/[/b] e [b]images/links/tmp/[/b] son escribibles.
[*][b]El banner no se mueve[/b] — confirme que el mensaje fue aprobado en la cola de moderación y que el archivo temporal aún existe.
[*][b]Los cambios de permisos no aparecen[/b] — vacíe la caché de phpBB y recargue la página de permisos del ACP.
[/list]

[anchor=back_fix goto=klinks_top]Volver arriba[/anchor]',

// ===== END ARTICLE: K_LINKS_BANNER_UPLOAD =====


// ===== START ARTICLE: STYLE_INSTALL =====
	'STYLE_INSTALL'			=> 'Instalar un estilo',
	'STYLE_INSTALL_DESC'	=> 'Suba una carpeta de estilo e instálela desde el Panel de administración.',
	'STYLE_INSTALL_ARTICLE'	=> '[anchor=style_top][/anchor][b]Instalar un estilo[/b]

Un estilo es el aspecto completo del foro: plantilla, tema (CSS/imágenes) y conjunto de imágenes. core y Alpha son estilos completos. Otros heredan de _portal_common y solo sustituyen lo que necesitan.

[b]Ir a[/b]
[list]
[*][anchor=toc_parent goto=parent]Estilos que necesitan prosilver primero[/anchor]
[*][anchor=toc_upload goto=upload]Poner los archivos en el servidor[/anchor]
[*][anchor=toc_acp goto=acp]Instalar en el ACP[/anchor]
[*][anchor=toc_default goto=default]Dejarlo como predeterminado[/anchor]
[*][anchor=toc_users goto=users]Usuarios aún con el estilo viejo[/anchor]
[*][anchor=toc_notes goto=notes]Herencia y caché[/anchor]
[/list]

[anchor=parent][b]Estilos que necesitan prosilver primero[/b][/anchor]

[b]fiproice[/b], [b]IM_prosilver[/b] y [b]MiMic[/b] heredan los archivos que faltan de [b]prosilver[/b]. Instale y conserve prosilver [i]antes[/i] de instalar esos tres. Si falta prosilver, las páginas se rompen o quedan a medias.

core y Alpha no necesitan prosilver. Son estilos completos.

[anchor=back_parent goto=style_top]Volver arriba[/anchor]

[anchor=upload][b]Poner los archivos en el servidor[/b][/anchor]

[list=1]
[*]Descargue el paquete del estilo y descomprímalo en el ordenador.
[*]Debe haber una carpeta con [b]style.cfg[/b] dentro (y normalmente [b]template/[/b], [b]theme/[/b], [b]imageset/[/b]).
[*]Suba esa carpeta a [b]styles/[/b] en el foro. La ruta debe ser [b]styles/StyleName/style.cfg[/b], no un nivel extra.
[*]Conserve el nombre de carpeta tal cual. No cambie el de core o Alpha salvo que también edite [b]style.cfg[/b].
[/list]

FTP o el administrador de archivos del alojamiento valen. El servidor web debe poder leer los archivos.

[anchor=back_upload goto=style_top]Volver arriba[/anchor]

[anchor=acp][b]Instalar en el ACP[/b][/anchor]

[list=1]
[*]Entre como administrador.
[*]Vaya a [b]ACP → Estilos → Estilos[/b].
[*]Si instala fiproice, IM_prosilver o MiMic, confirme primero que [b]prosilver[/b] ya está en la lista de instalados. Instálelo antes si no lo está.
[*]En estilos no instalados busque el nombre nuevo y pulse [b]Instalar estilo[/b].
[*]Confirme. Si el estilo necesita una plantilla, tema o conjunto de imágenes padre que aún no está instalado, el ACP lo dirá. Instálelos primero.
[/list]

Los estilos instalados aparecen en la lista con un recuento de usuarios. El predeterminado actual lleva un asterisco (*).

[anchor=back_acp goto=style_top]Volver arriba[/anchor]

[anchor=default][b]Dejarlo como predeterminado[/b][/anchor]

En la misma página, póngalo como estilo predeterminado del foro si todos deben usarlo. Puede dejarlo instalado pero no predeterminado si los usuarios pueden elegirlo.

Desactive un estilo en lugar de borrarlo si solo quiere ocultarlo de la lista de usuarios. No desinstale prosilver mientras fiproice, IM_prosilver o MiMic sigan en uso.

[anchor=back_default goto=style_top]Volver arriba[/anchor]

[anchor=users][b]Usuarios aún con el estilo viejo[/b][/anchor]

El estilo guardado de un usuario no siempre cambia al cambiar el predeterminado del foro. Si anular el estilo del usuario está desactivado, conservan la elección antigua hasta que elijan el nuevo en el Panel de control del usuario.

Para forzar el aspecto nuevo: ACP → [b]Ajustes del foro[/b] (o Ajustes de usuario) y active anular el estilo del usuario, o edite usuarios en [b]Usuarios y grupos[/b].

[anchor=back_users goto=style_top]Volver arriba[/anchor]

[anchor=notes][b]Herencia y caché[/b][/anchor]

[list]
[*]Los estilos que heredan de prosilver solo necesitan los archivos que sustituyen. Las plantillas que falten caen al padre.
[*]Tras instalar o editar plantillas, vacíe la caché: ACP → [b]General[/b] → [b]Vaciar caché[/b]. Borre también archivos de [b]cache/[/b] si un cambio no se ve.
[*]No mezcle archivos de dos estilos en una carpeta. Suba un paquete de estilo completo.
[*]Alpha es el mismo código moderno de core con aspecto de foro retro, no un predecesor antiguo.
[/list]

[anchor=back_notes goto=style_top]Volver arriba[/anchor]',

// ===== END ARTICLE: STYLE_INSTALL =====


// ===== START ARTICLE: IM_INSTALL =====
	'IM_INSTALL'			=> 'Instalar IntegraMOD 3',
	'IM_INSTALL_DESC'		=> 'Suba el paquete, elija la caché, ejecute el instalador y luego cierre el foro.',
	'IM_INSTALL_ARTICLE'	=> '[anchor=im_top][/anchor][b]Instalar IntegraMOD 3[/b]

IntegraMOD 3 es un paquete de foro completo. Sube los archivos, ejecuta el instalador una vez y luego quita las carpetas que no deben quedar en un sitio en producción. Necesitas un alojamiento con PHP y una base de datos. Si no conoces los datos de la base, pídelos al host antes de empezar.

[b]Ir a[/b]
[list]
[*][anchor=toc_need goto=need]Qué necesitas[/anchor]
[*][anchor=toc_files goto=files]Poner los archivos en el servidor[/anchor]
[*][anchor=toc_perm goto=perm]Permisos de carpetas[/anchor]
[*][anchor=toc_cache goto=cache]Opciones de caché[/anchor]
[*][anchor=toc_run goto=run]Ejecutar el instalador[/anchor]
[*][anchor=toc_after goto=after]Después — borrar estas carpetas[/anchor]
[*][anchor=toc_config goto=config]Cerrar config.php[/anchor]
[*][anchor=toc_stuck goto=stuck]Si algo falla[/anchor]
[/list]

[anchor=need][b]Qué necesitas[/b][/anchor]

[list]
[*]PHP 7.4 o más nuevo (hasta PHP 8.5)
[*]Una base de datos: MySQL / MariaDB es lo habitual. PostgreSQL, SQLite, Firebird, MS SQL y Oracle también sirven si el host las ofrece
[*]FTP o un administrador de archivos para subir
[*]Nombre de la base, usuario, contraseña y nombre del servidor, dados por el host
[/list]

[anchor=back_need goto=im_top]Volver arriba[/anchor]

[anchor=files][b]Poner los archivos en el servidor[/b][/anchor]

[list=1]
[*]Descomprime el paquete IntegraMOD en el ordenador.
[*]Sube [b]todo[/b] a una carpeta web, conservando las mismas carpetas y nombres. No fuerces los nombres a minúsculas.
[*]Una ruta típica es [b]https://example.com/forum/[/b] o la raíz del sitio.
[/list]

Con SSH puedes subir el zip y descomprimirlo en el servidor en lugar de enviar miles de archivos por FTP.

[anchor=back_files goto=im_top]Volver arriba[/anchor]

[anchor=perm][b]Permisos de carpetas[/b][/anchor]

El instalador debe poder escribir en unos caminos:

[list]
[*][b]config.php[/b] — escribible solo mientras instalas (a menudo 666). Cámbialo después; ver [anchor=toc_config_jump goto=config]Cerrar config.php[/anchor]
[*][b]store/[/b], [b]cache/[/b], [b]files/[/b], [b]images/avatars/upload/[/b] — escribibles (a menudo 777 en hosting compartido)
[/list]

El programa FTP o el administrador de archivos del host pueden hacerlo.

[anchor=back_perm goto=im_top]Volver arriba[/anchor]

[anchor=cache][b]Opciones de caché[/b][/anchor]

El instalador pregunta dónde guardar los datos en caché. Elige lo que el host tenga de verdad.

[list]
[*][b]File (predeterminado)[/b] — escribe archivos de caché bajo [b]store/[/b]. Simple y fiable. Úsalo en la mayoría del hosting compartido.
[*][b]Memcache[/b] o [b]Memcached[/b] — caché rápida en memoria. Requiere la extensión PHP y un servidor memcached.
[*][b]Redis[/b] — almacén rápido en memoria con extras. Requiere la extensión Redis y un servidor Redis.
[*][b]APC / APCu[/b] — caché en memoria dentro de PHP en un solo servidor.
[*][b]WinCache[/b] — solo hosts Windows.
[*][b]XCache[/b] / [b]eAccelerator[/b] — cachés de opcode antiguas; solo si el host aún las tiene.
[*][b]Memory (solo proceso)[/b] — rápida, pero cada proceso PHP tiene su propia caché. No se comparte.
[*][b]Sin caché[/b] — solo para depurar. No lo uses en un foro en vivo.
[/list]

Si no estás seguro, deja [b]File[/b]. Más tarde puedes cambiarlo en el ACP si el host añade Memcached o Redis.

[anchor=back_cache goto=im_top]Volver arriba[/anchor]

[anchor=run][b]Ejecutar el instalador[/b][/anchor]

Abre [b]https://tu-sitio/forum/install/[/b] (añade [b]install/[/b] a donde subiste los archivos).

[list=1]
[*]Lee la intro y abre la pestaña [b]INSTALL[/b].
[*]La página de requisitos comprueba PHP y las carpetas. Corrige lo marcado como obligatorio antes de seguir.
[*]Introduce tipo de base, hostname, nombre, usuario y contraseña. Deja el puerto vacío salvo que el host te diera uno. Conserva el prefijo de tablas salvo que ya tengas otro foro en la misma base.
[*]Elige el tipo de caché (arriba).
[*]Crea la primera cuenta de administrador (tu acceso).
[*]Deja que escriba [b]config.php[/b]. Si no puede, mostrará el contenido para pegarlo a mano.
[/list]

Cuando diga enhorabuena, el foro está instalado.

[anchor=back_run goto=im_top]Volver arriba[/anchor]

[anchor=after][b]Después — borrar estas carpetas[/b][/anchor]

Estas rutas no deben estar en un sitio público. Bórralas de la raíz web (o sácalas del servidor). Dejarlas es un agujero de seguridad.

[list]
[*][b]install/[/b] — [b]tiene[/b] que irse. Mientras exista, solo funciona el Panel de administración, y quien la abra puede destrozar el foro.
[*][b]develop/[/b] — [b]bórrala sobre todo.[/b] Herramientas de desarrollo y código de prueba. Nunca la dejes en un foro en vivo.
[*][b]stk/[/b] — Support Toolkit. Útil al reparar un foro roto; peligroso si extraños pueden abrirlo. Quítalo cuando termines.
[*][b]docs/[/b] — notas de instalación. Puedes borrarlas cuando las hayas leído.
[/list]

Opcional: convierte un foro phpBB 2 antiguo desde el enlace del convertidor en la página de éxito [i]antes[/i] de borrar [b]install/[/b].

Luego entra con la cuenta de administrador que creaste.

[anchor=back_after goto=im_top]Volver arriba[/anchor]

[anchor=config][b]Cerrar config.php[/b][/anchor]

[b]config.php[/b] guarda la contraseña de la base. Durante la instalación a menudo está en [b]666[/b] (escribible por cualquiera) para que el instalador pueda escribir. Eso no puede quedarse así.

Después de instalar:

[list]
[*]Pon [b]config.php[/b] en [b]644[/b] (o [b]640[/b] si el host lo permite). El servidor web aún necesita [i]leerlo[/i].
[*]No lo dejes en [b]666[/b]. Quien pueda escribir ese archivo posee la base de datos.
[/list]

[anchor=back_config goto=im_top]Volver arriba[/anchor]

[anchor=stuck][b]Si algo falla[/b][/anchor]

[list]
[*][b]Could not connect to the database[/b] — hostname, nombre, usuario o contraseña incorrectos. Pregunta al host.
[*]Una carpeta no es escribible — vuelve a poner permisos y pulsa Probar de nuevo en requisitos.
[*]Página en blanco tras instalar — sigue [b]install/[/b], o [b]cache/[/b] no es escribible.
[*]PHP demasiado viejo — el host debe estar en PHP 7.4 o más nuevo.
[/list]

Más detalle en [b]docs/INSTALL.html[/b] del paquete (léelo antes de borrar [b]docs/[/b]).

[anchor=back_stuck goto=im_top]Volver arriba[/anchor]',
));

// ===== END ARTICLE: IM_INSTALL =====
