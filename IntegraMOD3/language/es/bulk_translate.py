#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Bulk Spanish translation for phpBB 3.0.15 language file
This script translates remaining English strings in common.php to Spanish
"""

import re

# Read the file
with open(r'C:\Users\jwi19\source\repos\IntegraMOD3.0.16\language\es\common.php', 'r', encoding='utf-8') as f:
	content = f.read()

# Define translations as (old_value_regex_pattern, new_value) tuples
# These target the RIGHT side of => (the values to be translated)
translations = [
	(r"'The image file you tried to attach is invalid\.'", "'El archivo de imagen que intentaste adjuntar es inválido.'"),
	(r"'Author'", "'Autor'"),
	(r"'The creation of a user profile was unsuccessful\.'", "'La creación de un perfil de usuario no fue exitosa.'"),
	(r"'The upload was rejected because the uploaded file was identified as a possible attack vector\.'", "'La carga fue rechazada porque el archivo cargado fue identificado como un posible vector de ataque.'"),
	(r"'This file cannot be displayed because the extension <strong>%s</strong> is not allowed\.'", "'Este archivo no puede ser mostrado porque la extensión <strong>%s</strong> no está permitida.'"),
	(r"'The specified avatar could not be uploaded because the remote data appears to be invalid or corrupted\.'", "'El avatar especificado no pudo ser cargado porque los datos remotos parecen ser inválidos o están corruptos.'"),
	(r"'The uploaded avatar file is empty\.'", "'El archivo de avatar cargado está vacío.'"),
	(r"'%s is an invalid filename\.'", "'%s es un nombre de archivo inválido.'"),
	(r"'Avatar could not be uploaded\.'", "'El avatar no pudo ser cargado.'"),
	(r"'The width or height of the linked avatar could not be determined\. Please enter them manually\.'", "'El ancho o alto del avatar vinculado no pudo ser determinado. Por favor indícalos manualmente.'"),
	(r"'The specified file was only partially uploaded\.'", "'El archivo especificado solo fue cargado parcialmente.'"),
	(r"'The avatar's filesize is too large\.<br />The maximum allowed filesize set in php\.ini could not be determined\.'", "'El tamaño del archivo del avatar es demasiado grande.<br />El tamaño máximo permitido configurado en php.ini no pudo ser determinado.'"),
	(r"'The avatar's filesize is too large\. The maximum allowed upload size is %1\$d %2\$s\.<br />Please note this is set in php\.ini and cannot be overridden\.'", "'El tamaño del archivo del avatar es demasiado grande. El tamaño máximo de carga permitido es %1$d %2$s.<br />Por favor ten en cuenta que esto está configurado en php.ini y no puede ser anulado.'"),
	(r"'The specified avatar could not be uploaded because the request timed out\.'", "'El avatar especificado no pudo ser cargado porque la solicitud agotó el tiempo.'"),
	(r"'The URL you specified is invalid\.'", "'La URL que especificaste es inválida.'"),
	(r"'The file specified could not be found\.'", "'El archivo especificado no pudo ser encontrado.'"),
	(r"'The avatar's filesize must be between 0 and %1\$d %2\$s\.'", "'El tamaño del archivo del avatar debe estar entre 0 y %1$d %2$s.'"),
	(r"'The submitted avatar is %5\$d pixels wide and %6\$d pixels high\. Avatars must be at least %1\$d pixels wide and %2\$d pixels high, but no larger than %3\$d pixels wide and %4\$d pixels high\.'", "'El avatar enviado tiene %5$d píxeles de ancho y %6$d píxeles de alto. Los avatares deben tener al menos %1$d píxeles de ancho y %2$d píxeles de alto, pero no más de %3$d píxeles de ancho y %4$d píxeles de alto.'"),
	(r"'Top'(?!\w)", "'Arriba'"),
	(r"'Back to previous page'", "'Volver a la página anterior'"),
	(r"'A ban has been issued on your e-mail address\.'", "'Se ha emitido un baneo en tu dirección de correo electrónico.'"),
	(r"'A ban has been issued on your IP address\.'", "'Se ha emitido un baneo en tu dirección IP.'"),
	(r"'A ban has been issued on your username\.'", "'Se ha emitido un baneo en tu nombre de usuario.'"),
	(r"'BBCode guide'", "'Guía de BBCode'"),
	(r"'Birthdays'", "'Cumpleaños'"),
	(r"'Bytes'", "'Bytes'"),
	(r"'Allowed'", "'Permitido'"),
	(r"'All files'", "'Todos los archivos'"),
	(r"'All forums'", "'Todos los foros'"),
	(r"'All messages'", "'Todos los mensajes'"),
	(r"'All posts'", "'Todos los mensajes'"),
	(r"'All times are %1\$s %2\$s'", "'Todas las horas son %1$s %2$s'"),
	(r"'All Topics'", "'Todos los Temas'"),
	(r"'And'(?!\w)", "'Y'"),
	(r"'You have subscribed to be notified of new posts in this forum\.'", "'Te has suscrito para recibir notificaciones de nuevos mensajes en este foro.'"),
	(r"'You have subscribed to be notified of new posts in this topic\.'", "'Te has suscrito para recibir notificaciones de nuevos mensajes en este tema.'"),
	(r"'Ascending'", "'Ascendente'"),
	(r"'Attachments'", "'Adjuntos'"),
	(r"'Change'(?!\w)", "'Cambiar'"),
	(r"'Changing board preferences'", "'Cambiando las preferencias del tablero'"),
	(r"'Changing profile settings'", "'Cambiando la configuración del perfil'"),
	(r"'Collapse view'", "'Ocultar vista'"),
	(r"'Close window'", "'Cerrar ventana'"),
	(r"'Confirmation of login'", "'Confirmación de inicio de sesión'"),
	(r"'Congratulations to'", "'Felicidades a'"),
	(r"'Connection failed\.'", "'Conexión fallida.'"),
	(r"'Connection was successful!'", "'¡La conexión fue exitosa!'"),
	(r"'All board cookies successfully deleted\.'", "'Todas las cookies del tablero fueron eliminadas exitosamente.'"),
	(r"'It is currently %s'", "'Actualmente son %s'"),
	(r"'Day'(?!\w)", "'Día'"),
	(r"'Days'(?!\w)", "'Días'"),
	(r"'Delete'(?!\w)", "'Eliminar'"),
	(r"'Delete all'", "'Eliminar todo'"),
	(r"'Delete all board cookies'", "'Eliminar todas las cookies del tablero'"),
	(r"'Delete marked'", "'Eliminar marcados'"),
	(r"'Delete post'", "'Eliminar mensaje'"),
	(r"'Delimiter'", "'Delimitador'"),
	(r"'Descending'", "'Descendente'"),
	(r"'Disabled'(?!\w)", "'Deshabilitado'"),
	(r"'Display'(?!\w)", "'Mostrar'"),
	(r"'Display guests'", "'Mostrar invitados'"),
	(r"'Display messages from previous'", "'Mostrar mensajes anteriores'"),
	(r"'Display posts from previous'", "'Mostrar mensajes anteriores'"),
	(r"'Display topics from previous'", "'Mostrar temas anteriores'"),
	(r"'Downloaded'(?!\w)", "'Descargado'"),
	(r"'Downloading file'", "'Descargando archivo'"),
	(r"'Downloaded %d time'", "'Descargado %d vez'"),
	(r"'Downloaded %d times'", "'Descargado %d veces'"),
	(r"'Not downloaded yet'", "'No descargado aún'"),
	(r"'Viewed %d time'", "'Visto %d vez'"),
	(r"'Viewed %d times'", "'Visto %d veces'"),
	(r"'Not viewed yet'", "'No visto aún'"),
	(r"'Edit post'", "'Editar mensaje'"),
	(r"'E-mail'(?!\s)", "'Correo electrónico'"),
	(r"'E-mail address'", "'Dirección de correo'"),
	(r"'The e-mail address you entered is invalid\.'", "'La dirección de correo electrónico que ingresaste es inválida.'"),
	(r"'Ran into problems sending e-mail at <strong>Line %1\$s</strong>\. Response: %2\$s\.'", "'Se encontraron problemas al enviar correo en <strong>Línea %1$s</strong>. Respuesta: %2$s.'"),
	(r"'You must specify a subject when posting a new topic\.'", "'Debes especificar un asunto cuando publicas un nuevo tema.'"),
	(r"'You must specify a subject when composing a new message\.'", "'Debes especificar un asunto al escribir un nuevo mensaje.'"),
	(r"'Enabled'", "'Habilitado'"),
	(r"'Enter username'", "'Ingresa nombre de usuario'"),
	(r"'Forum'(?!\w)", "'Foro'"),
	(r"'Forums'(?!\w)", "'Foros'"),
	(r"'Forum rules'", "'Reglas del foro'"),
	(r"'Go'(?!\w)", "'Ir'"),
	(r"'Moderator Control Panel'", "'Panel de Control de Moderador'"),
	(r"'Members'(?!\w)", "'Miembros'"),
	(r"'View complete list of members'", "'Ver lista completa de miembros'"),
	(r"'Search'(?!\w)", "'Buscar'"),
	(r"'Register'(?!\w)", "'Registrarse'"),
	(r"'Log in to check your private messages\.'", "'Inicia sesión para revisar tus mensajes privados.'"),
	(r"'Confirmation of login'", "'Confirmación de inicio de sesión'"),
	(r"'You exceeded the maximum allowed number of login attempts\. In addition to your username and password you now also have to solve the CAPTCHA below\.'", "'Has excedido el número máximo de intentos de inicio de sesión permitido. Además de tu nombre de usuario y contraseña, ahora también debes resolver el CAPTCHA a continuación.'"),
	(r"'You have not been authenticated by Apache\.'", "'No has sido autenticado por Apache.'"),
	(r"'You have specified an incorrect password\. Please check your password and try again\. If you continue to have problems please contact the %sBoard Administrator%s\.'", "'Has especificado una contraseña incorrecta. Por favor verifica tu contraseña e intenta nuevamente. Si continúas teniendo problemas por favor contacta al %sAdministrador del Tablero%s.'"),
	(r"'It was not possible to convert your password when updating this bulletin board's software\. Please %srequest a new password%s\. If you continue to have problems please contact the %sBoard Administrator%s\.'", "'No fue posible convertir tu contraseña al actualizar el software de este tablero de anuncios. Por favor %ssolicita una nueva contraseña%s. Si continúas teniendo problemas por favor contacta al %sAdministrador del Tablero%s.'"),
	(r"'You have specified an incorrect username\. Please check your username and try again\. If you continue to have problems please contact the %sBoard Administrator%s\.'", "'Has especificado un nombre de usuario incorrecto. Por favor verifica tu nombre de usuario e intenta nuevamente. Si continúas teniendo problemas por favor contacta al %sAdministrador del Tablero%s.'"),
	(r"'To view or post in this forum you must enter its password\.'", "'Para ver o publicar en este foro debes ingresar su contraseña.'"),
	(r"'In order to login you must be registered\. Registering takes only a few moments but gives you increased capabilities\. The board administrator may also grant additional permissions to registered users\. Before you register please ensure you are familiar with our terms of use and related policies\. Please ensure you read any forum rules as you navigate around the board\.'", "'Para iniciar sesión debes estar registrado. El registro solo toma unos momentos pero te da capacidades aumentadas. El administrador del tablero también puede otorgar permisos adicionales a los usuarios registrados. Antes de registrarte asegúrate de estar familiarizado con nuestros términos de uso y políticas relacionadas. Asegúrate de leer las reglas del foro mientras navegas por el tablero.'"),
	(r"'The board requires you to be registered and logged in to view this forum\.'", "'El tablero requiere que estés registrado e iniciado sesión para ver este foro.'"),
	(r"'In order to edit posts in this forum you have to be registered and logged in\.'", "'Para editar mensajes en este foro debes estar registrado e iniciado sesión.'"),
	(r"'In order to view the online list you have to be registered and logged in\.'", "'Para ver la lista en línea debes estar registrado e iniciado sesión.'"),
	(r"'Logout'(?!\w)", "'Cerrar sesión'"),
	(r"'Logout \[ %s \]'", "'Cerrar sesión [ %s ]'"),
]

count = 0
for old_pattern, new_value in translations:
	# Use word boundary if not already present
	if content.count(f"=> {old_pattern}") > 0 or content.count(f"=> \"{old_pattern}") > 0:
		# Simple string replacement first try
		simple_old = f"=> {old_pattern},"
		simple_new = f"=> {new_value},"
		if simple_old in content:
			content = content.replace(simple_old, simple_new)
			count += 1
			print(f"✓ {old_pattern[:50]}")
		elif f"=> {old_pattern}" in content:
			# Try without the comma
			content = content.replace(f"=> {old_pattern}", f"=> {new_value}")
			count += 1
			print(f"✓ {old_pattern[:50]}")
		else:
			print(f"✗ {old_pattern[:50]}")

# Write back
with open(r'C:\Users\jwi19\source\repos\IntegraMOD3.0.16\language\es\common.php', 'w', encoding='utf-8') as f:
	f.write(content)

print(f'\n✓ Translated {count} additional entries')
