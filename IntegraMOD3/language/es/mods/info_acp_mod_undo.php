<?php
/**
*
* Moderator action undo [Español — Usted]
*
* @package language
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
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
	'ACP_MOD_UNDO'						=> 'Deshacer acciones de moderador',
	'ACP_MOD_UNDO_LIST'					=> 'Acciones de moderadores',
	'ACP_MOD_UNDO_LIST_EXPLAIN'			=> 'Acciones realizadas por moderadores: borrados, ediciones, movimientos, divisiones, uniones, cierres, cambios de autor, exclusiones y advertencias. Restaurar devuelve el contenido al estado anterior a la acción. Al revertir varias acciones, se deshacen de la más reciente a la más antigua.',
	'ACP_MOD_UNDO_SETTINGS'				=> 'Configuración de deshacer acciones',
	'ACP_MOD_UNDO_SETTINGS_EXPLAIN'		=> 'Guarda un registro de las acciones de moderadores para que un administrador pueda deshacerlas.',

	'MOD_UNDO_ENABLE'					=> 'Registrar acciones de moderadores',
	'MOD_UNDO_ENABLE_EXPLAIN'			=> 'Se registran borrados, ediciones de mensajes ajenos, movimientos, divisiones, uniones, cierres, cambios de autor, exclusiones y advertencias para poder deshacerlos.',
	'MOD_UNDO_ADMINS'					=> 'Registrar también a administradores',
	'MOD_UNDO_ADMINS_EXPLAIN'			=> 'Registra también las acciones de usuarios con cualquier permiso de administrador. Protege contra una cuenta de administrador comprometida.',
	'MOD_UNDO_DAYS'						=> 'Conservar registros durante',
	'MOD_UNDO_DAYS_EXPLAIN'				=> 'Los registros más antiguos se eliminan junto con sus adjuntos guardados. 0 los conserva para siempre.',

	'MOD_UNDO_ACTION_DELETE_POST'		=> 'Mensaje(s) borrado(s)',
	'MOD_UNDO_ACTION_DELETE_TOPIC'		=> 'Tema(s) borrado(s)',
	'MOD_UNDO_ACTION_EDIT'				=> 'Mensaje editado',
	'MOD_UNDO_ACTION_LOCK'				=> 'Tema(s) cerrado(s)',
	'MOD_UNDO_ACTION_UNLOCK'			=> 'Tema(s) abierto(s)',
	'MOD_UNDO_ACTION_LOCK_POST'			=> 'Mensaje(s) bloqueado(s)',
	'MOD_UNDO_ACTION_UNLOCK_POST'		=> 'Mensaje(s) desbloqueado(s)',
	'MOD_UNDO_ACTION_MOVE'				=> 'Tema(s) movido(s)',
	'MOD_UNDO_ACTION_SPLIT'				=> 'Tema dividido',
	'MOD_UNDO_ACTION_MERGE'				=> 'Mensajes/temas unidos',
	'MOD_UNDO_ACTION_CHANGE_POSTER'		=> 'Autor cambiado',
	'MOD_UNDO_ACTION_BAN'				=> 'Exclusión',
	'MOD_UNDO_ACTION_UNBAN'				=> 'Exclusión retirada',
	'MOD_UNDO_ACTION_WARNING'			=> 'Advertencia',

	'MOD_UNDO_MODERATOR'				=> 'Moderador',
	'MOD_UNDO_SUMMARY'					=> 'Contenido',
	'MOD_UNDO_STATUS'					=> 'Estado',
	'MOD_UNDO_PENDING'					=> 'Se puede restaurar',
	'MOD_UNDO_RESTORED_ON'				=> 'Restaurado',
	'MOD_UNDO_ALL'						=> 'Todos',
	'MOD_UNDO_FILTER_USER'				=> 'Nombre de usuario del moderador',
	'MOD_UNDO_VIEW'						=> 'Ver',
	'MOD_UNDO_DISABLED'					=> 'El registro está desactivado. Los registros existentes aún pueden restaurarse.',
	'MOD_UNDO_NO_ENTRIES'				=> 'No hay acciones de moderadores registradas.',

	'MOD_UNDO_RESTORE_MARKED'			=> 'Restaurar marcados',
	'MOD_UNDO_REVERT_USER'				=> 'Revertir todas las acciones de un moderador',
	'MOD_UNDO_REVERT_USER_EXPLAIN'		=> 'Restaura todas las acciones pendientes de este moderador dentro del número de días elegido, empezando por la más reciente. Utilícelo cuando una cuenta haya sido comprometida.',
	'MOD_UNDO_REVERT_DAYS'				=> 'Días atrás',
	'MOD_UNDO_REVERT'					=> 'Revertir',

	'MOD_UNDO_RESTORED'					=> '%d acción(es) restaurada(s).',
	'MOD_UNDO_ERRORS'					=> 'Estas acciones no pudieron restaurarse:',
	'MOD_UNDO_NOTHING_MARKED'			=> 'No se marcó ninguna acción.',
	'MOD_UNDO_NOTHING_FOUND'			=> 'No se encontraron acciones pendientes de este moderador en ese periodo.',
	'MOD_UNDO_NO_USER'					=> 'Introduzca un nombre de usuario existente y un número de días.',
	'MOD_UNDO_NOT_FOUND'				=> 'El registro ya no existe.',
	'MOD_UNDO_ALREADY'					=> 'Esta acción ya fue restaurada.',
	'MOD_UNDO_BAD_DATA'					=> 'Los datos guardados no se pueden leer.',
	'MOD_UNDO_FORUM_GONE'				=> 'Un foro al que pertenecía este contenido ya no existe.',
	'MOD_UNDO_TOPIC_GONE'				=> 'Un tema al que pertenecía este contenido ya no existe y no formaba parte de este registro.',
	'MOD_UNDO_POST_GONE'				=> 'El mensaje ya no existe.',
	'MOD_UNDO_STATE_CHANGED'			=> 'El contenido se modificó de nuevo después de esta acción; deshaga primero la acción más reciente.',

	'LOG_MOD_UNDO_RESTORE'				=> '<strong>Acción de moderador restaurada</strong><br />» %1$s: %2$s',
));
