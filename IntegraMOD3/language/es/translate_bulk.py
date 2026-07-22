#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import re

# Read the file  
with open(r'C:\Users\jwi19\source\repos\IntegraMOD3.0.16\language\es\common.php', 'r', encoding='utf-8') as f:
	lines = f.readlines()

# Spanish translations - simple key => value mappings
# This maps the keys to their Spanish translations
translations = {
	"'AUTHOR'": "'Autor'",
	"'ALLOWED'": "'Permitido'",
	"'ALL_FILES'": "'Todos los archivos'",
	"'ALL_FORUMS'": "'Todos los foros'",
	"'ALL_MESSAGES'": "'Todos los mensajes'",
	"'ALL_POSTS'": "'Todos los mensajes'",
	"'ALL_TIMES'": "'Todas las horas son %1$s %2$s'",
	"'ALL_TOPICS'": "'Todos los Temas'",
	"'AND'": "'Y'",
	"'ASCENDING'": "'Ascendente'",
	"'ATTACHMENTS'": "'Adjuntos'",
	"'AVATAR_PARTIAL_UPLOAD'": "'El archivo especificado solo fue cargado parcialmente.'",
	"'AVATAR_PHP_SIZE_NA'": "'El tamaño del archivo del avatar es demasiado grande.<br />El tamaño máximo permitido configurado en php.ini no pudo ser determinado.'",
	"'AVATAR_PHP_SIZE_OVERRUN'": "'El tamaño del archivo del avatar es demasiado grande. El tamaño máximo de carga permitido es %1$d %2$s.<br />Por favor ten en cuenta que esto está configurado en php.ini y no puede ser anulado.'",
	"'AVATAR_URL_INVALID'": "'La URL que especificaste es inválida.'",
	"'AVATAR_URL_NOT_FOUND'": "'El archivo especificado no pudo ser encontrado.'",
	"'AVATAR_WRONG_FILESIZE'": "'El tamaño del archivo del avatar debe estar entre 0 y %1$d %2$s.'",
	"'AVATAR_WRONG_SIZE'": "'El avatar enviado tiene %5$d píxeles de ancho y %6$d píxeles de alto. Los avatares deben tener al menos %1$d píxeles de ancho y %2$d píxeles de alto, pero no más de %3$d píxeles de ancho y %4$d píxeles de alto.'",
	"'BAN_TRIGGERED_BY_EMAIL'": "'Se ha emitido un baneo en tu dirección de correo electrónico.'",
	"'BAN_TRIGGERED_BY_IP'": "'Se ha emitido un baneo en tu dirección IP.'",
	"'BAN_TRIGGERED_BY_USER'": "'Se ha emitido un baneo en tu nombre de usuario.'",
	"'BIRTHDAYS'": "'Cumpleaños'",
	"'BYTES'": "'Bytes'",
	"'CANCEL'": "'Cancelar'",
	"'CHANGE'": "'Cambiar'",
	"'CHANGE_FONT_SIZE'": "'Cambiar tamaño de fuente'",
	"'CHANGING_PREFERENCES'": "'Cambiando las preferencias del tablero'",
	"'CHANGING_PROFILE'": "'Cambiando configuración de perfil'",
	"'COLLAPSE_VIEW'": "'Ocultar vista'",
	"'CLOSE_WINDOW'": "'Cerrar ventana'",
	"'COLOUR_SWATCH'": "'Muestra de color'",
	"'CONFIRM'": "'Confirmar'",
	"'CONFIRM_CODE'": "'Código de confirmación'",
	"'CONFIRM_CODE_EXPLAIN'": "'Ingresa el código exactamente como aparece. Todas las letras no distinguen mayúsculas de minúsculas.'",
	"'CONFIRM_CODE_WRONG'": "'El código de confirmación que ingresaste es incorrecto.'",
	"'CONFIRM_OPERATION'": "'¿Estás seguro de que deseas realizar esta operación?'",
	"'CONGRATULATIONS'": "'Felicidades a'",
	"'CONNECTION_FAILED'": "'Conexión fallida.'",
	"'CONNECTION_SUCCESS'": "'¡La conexión fue exitosa!'",
	"'COOKIES_DELETED'": "'Todas las cookies del tablero fueron eliminadas exitosamente.'",
	"'CURRENT_TIME'": "'Actualmente son %s'",
	"'DAY'": "'Día'",
	"'DAYS'": "'Días'",
	"'DELETE'": "'Eliminar'",
	"'DELETE_ALL'": "'Eliminar todo'",
	"'DELETE_COOKIES'": "'Eliminar todas las cookies del tablero'",
	"'DELETE_MARKED'": "'Eliminar marcados'",
	"'DELETE_POST'": "'Eliminar mensaje'",
	"'DELIMITER'": "'Delimitador'",
	"'DESCENDING'": "'Descendente'",
	"'DISABLED'": "'Deshabilitado'",
	"'DISPLAY'": "'Mostrar'",
	"'DISPLAY_GUESTS'": "'Mostrar invitados'",
	"'DISPLAY_MESSAGES'": "'Mostrar mensajes anteriores'",
	"'DISPLAY_POSTS'": "'Mostrar mensajes anteriores'",
	"'DISPLAY_TOPICS'": "'Mostrar temas anteriores'",
	"'DOWNLOADED'": "'Descargado'",
	"'DOWNLOADING_FILE'": "'Descargando archivo'",
	"'DOWNLOAD_COUNT'": "'Descargado %d vez'",
	"'DOWNLOAD_COUNTS'": "'Descargado %d veces'",
	"'DOWNLOAD_COUNT_NONE'": "'No descargado aún'",
	"'VIEWED_COUNT'": "'Visto %d vez'",
	"'VIEWED_COUNTS'": "'Visto %d veces'",
	"'VIEWED_COUNT_NONE'": "'No visto aún'",
	"'EDIT_POST'": "'Editar mensaje'",
	"'EMAIL'": "'Correo electrónico'",
	"'EMAIL_ADDRESS'": "'Dirección de correo'",
	"'EMAIL_INVALID_EMAIL'": "'La dirección de correo electrónico que ingresaste es inválida.'",
	"'EMAIL_SMTP_ERROR_RESPONSE'": "'Se encontraron problemas al enviar correo en <strong>Línea %1$s</strong>. Respuesta: %2$s.'",
	"'EMPTY_SUBJECT'": "'Debes especificar un asunto cuando publicas un nuevo tema.'",
	"'EMPTY_MESSAGE_SUBJECT'": "'Debes especificar un asunto al escribir un nuevo mensaje.'",
	"'ENABLED'": "'Habilitado'",
	"'ENCLOSURE'": "'Enclosure'",
	"'ENTER_USERNAME'": "'Ingresa nombre de usuario'",
}

count = 0
new_lines = []

for line in lines:
	# Check if this line contains an English value that needs translation
	modified = False

	# Look for patterns like 'KEY' => 'English text'
	for key, spanish in translations.items():
		# Extract the key name (without quotes)
		key_name = key.strip("'")

		# Create a regex pattern to find and replace the value while preserving structure
		# Match: 'KEY_NAME' ... => 'old_english_text',
		pattern = r"(\s*'" + re.escape(key_name) + r"'\s*=>)\s*'([^']*)'(\s*,.*)?$"

		if re.match(pattern, line, re.IGNORECASE):
			# Get the before part (key and arrow), the value, and the after part
			match = re.match(pattern, line, re.IGNORECASE)
			if match:
				before = match.group(1)
				old_val = match.group(2)
				after = match.group(3) if match.group(3) else ""

				# Check if English text and replace with Spanish
				# Only replace if it's still in English (basic heuristic)
				if old_val and old_val[0].isupper() or " " in old_val:
					# Replace the value part
					new_line = before + " " + spanish + after
					if after and not after.strip().endswith(','):
						new_line = before + " " + spanish + "," + after.lstrip(',')
					else:
						new_line = before + " " + spanish + after.rstrip() + ",\n"

					line = new_line
					modified = True
					count += 1
					print(f"Translated: {key_name}")
					break

	new_lines.append(line)

# Write back
with open(r'C:\Users\jwi19\source\repos\IntegraMOD3.0.16\language\es\common.php', 'w', encoding='utf-8') as f:
	f.writelines(new_lines)

print(f'\nTotal translated: {count} entries')
