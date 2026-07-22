#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import re
import sys

# Read the file
with open(r'C:\Users\jwi19\source\repos\IntegraMOD3.0.16\language\es\common.php', 'r', encoding='utf-8') as f:
	content = f.read()

# Spanish translations dictionary for English strings
translations = {
	"'AUTHOR'\t\t\t\t\t\t\t=> 'Author',": "'AUTHOR'\t\t\t\t\t\t\t=> 'Autor',",
	"'AUTH_NO_PROFILE_CREATED'\t\t=> 'The creation of a user profile was unsuccessful.',": "'AUTH_NO_PROFILE_CREATED'\t\t=> 'La creación de un perfil de usuario no fue exitosa.',",
	"'AVATAR_DISALLOWED_CONTENT'\t\t=> 'The upload was rejected because the uploaded file was identified as a possible attack vector.',": "'AVATAR_DISALLOWED_CONTENT'\t\t=> 'La carga fue rechazada porque el archivo cargado fue identificado como un posible vector de ataque.',",
	"'AVATAR_DISALLOWED_EXTENSION'\t=> 'This file cannot be displayed because the extension <strong>%s</strong> is not allowed.',": "'AVATAR_DISALLOWED_EXTENSION'\t=> 'Este archivo no puede ser mostrado porque la extensión <strong>%s</strong> no está permitida.',",
	"'AVATAR_EMPTY_REMOTE_DATA'\t\t=> 'The specified avatar could not be uploaded because the remote data appears to be invalid or corrupted.',": "'AVATAR_EMPTY_REMOTE_DATA'\t\t=> 'El avatar especificado no pudo ser cargado porque los datos remotos parecen ser inválidos o están corruptos.',",
	"'AVATAR_EMPTY_FILEUPLOAD'\t\t=> 'The uploaded avatar file is empty.',": "'AVATAR_EMPTY_FILEUPLOAD'\t\t=> 'El archivo de avatar cargado está vacío.',",
	"'AVATAR_INVALID_FILENAME'\t\t=> '%s is an invalid filename.',": "'AVATAR_INVALID_FILENAME'\t\t=> '%s es un nombre de archivo inválido.',",
	"'AVATAR_NOT_UPLOADED'\t\t\t=> 'Avatar could not be uploaded.',": "'AVATAR_NOT_UPLOADED'\t\t\t=> 'El avatar no pudo ser cargado.',",
	"'AVATAR_NO_SIZE'\t\t\t\t=> 'The width or height of the linked avatar could not be determined. Please enter them manually.',": "'AVATAR_NO_SIZE'\t\t\t\t=> 'El ancho o alto del avatar vinculado no pudo ser determinado. Por favor indícalos manualmente.',",
	"'AVATAR_PARTIAL_UPLOAD'\t\t=> 'The specified file was only partially uploaded.',": "'AVATAR_PARTIAL_UPLOAD'\t\t=> 'El archivo especificado solo fue cargado parcialmente.',",
	"'AVATAR_PHP_SIZE_NA'\t\t=> 'The avatar's filesize is too large.<br />The maximum allowed filesize set in php.ini could not be determined.',": "'AVATAR_PHP_SIZE_NA'\t\t=> 'El tamaño del archivo del avatar es demasiado grande.<br />El tamaño máximo permitido configurado en php.ini no pudo ser determinado.',",
	"'AVATAR_PHP_SIZE_OVERRUN'\t\t=> 'The avatar's filesize is too large. The maximum allowed upload size is %1$d %2$s.<br />Please note this is set in php.ini and cannot be overridden.',": "'AVATAR_PHP_SIZE_OVERRUN'\t\t=> 'El tamaño del archivo del avatar es demasiado grande. El tamaño máximo de carga permitido es %1$d %2$s.<br />Por favor ten en cuenta que esto está configurado en php.ini y no puede ser anulado.',",
	"'AVATAR_REMOTE_UPLOAD_TIMEOUT'\t\t=> 'The specified avatar could not be uploaded because the request timed out.',": "'AVATAR_REMOTE_UPLOAD_TIMEOUT'\t\t=> 'El avatar especificado no pudo ser cargado porque la solicitud agotó el tiempo.',",
	"'AVATAR_URL_INVALID'\t\t=> 'The URL you specified is invalid.',": "'AVATAR_URL_INVALID'\t\t=> 'La URL que especificaste es inválida.',",
	"'AVATAR_URL_NOT_FOUND'\t\t=> 'The file specified could not be found.',": "'AVATAR_URL_NOT_FOUND'\t\t=> 'El archivo especificado no pudo ser encontrado.',",
	"'AVATAR_WRONG_FILESIZE'\t\t=> 'The avatar's filesize must be between 0 and %1$d %2$s.',": "'AVATAR_WRONG_FILESIZE'\t\t=> 'El tamaño del archivo del avatar debe estar entre 0 y %1$d %2$s.',",
	"'AVATAR_WRONG_SIZE'\t\t\t=> 'The submitted avatar is %5$d pixels wide and %6$d pixels high. Avatars must be at least %1$d pixels wide and %2$d pixels high, but no larger than %3$d pixels wide and %4$d pixels high.',": "'AVATAR_WRONG_SIZE'\t\t\t=> 'El avatar enviado tiene %5$d píxeles de ancho y %6$d píxeles de alto. Los avatares deben tener al menos %1$d píxeles de ancho y %2$d píxeles de alto, pero no más de %3$d píxeles de ancho y %4$d píxeles de alto.',",
	"'BACK_TO_TOP'\t\t\t=> 'Top',": "'BACK_TO_TOP'\t\t\t=> 'Arriba',",
	"'BACK_TO_PREV'\t\t\t=> 'Back to previous page',": "'BACK_TO_PREV'\t\t\t=> 'Volver a la página anterior',",
	"'BAN_TRIGGERED_BY_EMAIL'\t=> 'A ban has been issued on your e-mail address.',": "'BAN_TRIGGERED_BY_EMAIL'\t=> 'Se ha emitido un baneo en tu dirección de correo electrónico.',",
	"'BAN_TRIGGERED_BY_IP'\t\t=> 'A ban has been issued on your IP address.',": "'BAN_TRIGGERED_BY_IP'\t\t=> 'Se ha emitido un baneo en tu dirección IP.',",
	"'BAN_TRIGGERED_BY_USER'\t\t=> 'A ban has been issued on your username.',": "'BAN_TRIGGERED_BY_USER'\t\t=> 'Se ha emitido un baneo en tu nombre de usuario.',",
	"'BBCODE_GUIDE'\t\t\t=> 'BBCode guide',": "'BBCODE_GUIDE'\t\t\t=> 'Guía de BBCode',",
	"'BCC'\t\t\t\t\t\t\t=> 'BCC',": "'BCC'\t\t\t\t\t\t\t=> 'BCC',",
	"'BIRTHDAYS'\t\t\t\t\t=> 'Birthdays',": "'BIRTHDAYS'\t\t\t\t\t=> 'Cumpleaños',",
}

count = 0
for eng, esp in translations.items():
	if eng in content:
		content = content.replace(eng, esp)
		count += 1
		print(f"Translated: {eng[:50]}")
	else:
		print(f"NOT FOUND: {eng[:50]}")

# Write back
with open(r'C:\Users\jwi19\source\repos\IntegraMOD3.0.16\language\es\common.php', 'w', encoding='utf-8') as f:
	f.write(content)

print(f'\nTotal translated: {count} entries')
