<?php
/**
*
* common [French]
*
* @package language
* @version $Id: calendar.php,v ALPHA 3.5 2007/10/02 12:00:00 jcc264 Exp $
* @copyright (c) 2007 M and J Media
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
   $lang = array();
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
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// â€™ Â» â€œ â€ â€¦
//

$lang = array_merge($lang, array(

'CAL_CALENDAR'=> array(
   'DAY_INITIAL'=> array(
         0 => 'D',
         1 => 'L',
         2 => 'M',
         3 => 'M',
         4 => 'J',
         5 => 'V',
         6 => 'S',
         ),

   'CAL_DAY'=> array(
         0 => 'Di',
         1 => 'Lu',
         2 => 'Ma',
         3 => 'Me',
         4 => 'Je',
         5 => 'Ve',
         6 => 'Sa',
         ),

   'CAL_LONG_DAY'=> array(
         0 => 'Dimanche',
         1 => 'Lundi',
         2 => 'Mardi',
         3 => 'Mercredi',
         4 => 'Jeudi',
         5 => 'Vendredi',
         6 => 'Samedi',
         ),

   'CAL_MONTH'=> array(
         1 => 'Jan',
         2 => 'Fév',
         3 => 'Mar',
         4 => 'Avr',
         5 => 'Mai',
         6 => 'Jui',
         7 => 'Jul',
         8 => 'Aoû',
         9 => 'Sep',
         10 => 'Oct',
         11 => 'Nov',
         12 => 'Déc',
      ),

   'CAL_LONG_MONTH'=> array(
         1 => 'Janvier',
         2 => 'Février',
         3 => 'Mars',
         4 => 'Avril',
         5 => 'Mai',
         6 => 'Juin',
         7 => 'Juillet',
         8 => 'Août',
         9 => 'Septembre',
         10 => 'Octobre',
         11 => 'Novembre',
         12 => 'Décembre',
      ),
   ),

'NEW_EVENT'                 			=> 'Nouvel événement',

'CALENDAR_ADD_EVENT'        			=> 'Ajouter un événement',
'CALENDAR_EDIT_EVENT'       			=> 'Modifier l\'événement',
'CALENDAR_DELETE_EVENT'     			=> 'Supprimer l\'événement',
'CALENDAR_DELETE_WARN'      			=> 'Une fois supprimé, l\'événement ne peut pas être récupéré. Êtes-vous sûr de vouloir continuer ?',
'CALENDAR_EVENT_NAME'       			=> 'Nom de l\'événement',
'CALENDAR_EVENT_DESC'       			=> 'Description de l\'événement',
'CALENDAR_EVENT_DESC_EXP'   			=> 'Saisissez la description de votre événement ici ; elle ne peut pas dépasser 255 caractères',
'CALENDAR_EVENT_END'        			=> 'Fin de l\'événement',
'CALENDAR_EVENT_START'      			=> 'Début de l\'événement',
'CALENDAR_EVENT_REPEAT'					=> 'Répéter l\'événement',
'CALENDAR_REPEAT_DATES'					=> 'Dates calculées des répétitions',
'CALENDAR_REPEAT_COUNT'					=> 'Nombre de répétitions',
'CALENDAR_REPEAT_PERIOD'				=> 'Période de répétition',
'CALENDAR_ASSOC_EVENT'      			=> 'Événement associé',

'CALENDAR_NAME_ERROR'       			=> 'Vous devez indiquer un nom pour l\'événement.',
'CALENDAR_INPUT_START_TIME_DATE_ERROR'	=> 'Vous devez indiquer une date et une heure de début valides pour l\'événement.',
'CALENDAR_INPUT_END_TIME_DATE_ERROR'  	=> 'Vous devez indiquer une date et une heure de fin valides pour l\'événement.',
'CALENDAR_OVERLAP_ERROR'    			=> 'La fin de l\'événement doit intervenir après le début de l\'événement.',
'CALENDAR_DESC_ERROR'       			=> 'Vous devez fournir une description pour l\'événement.',
'CALENDAR_REPEAT_COUNT_ERROR'			=> 'Le nombre de répétitions n\'est pas dans la plage autorisée',
'CALENDAR_REPEAT_WHEN_ERROR'			=> 'Les paramètres de répétition de l\'événement ne sont pas valides',
'CALENDAR_REPEAT_TIMES_INCONSISTENT'	=> 'Les heures initiales de l\'événement ne sont pas cohérentes avec les paramètres de répétition que vous avez spécifiés',
'CALENDAR_INCONSISTENCY_SPECIFICS'		=> '&rArr; %s n\'est pas le %s %s du mois spécifié',
'CALENDAR_INCONSISTENT_MONTH'			=> '&rArr; %s n\'est pas le %s %s de %s',
'CALENDAR_MUST_SELECT_GROUP'			=> 'Vous devez sélectionner au moins un groupe pour les événements de groupe',
'CALENDAR_MUST_SELECT_USER' 			=> 'Vous devez sélectionner au moins un membre pour les événements privés',
'CALENDAR_INVALID_USERNAME'				=> 'Le nom d\'utilisateur \'%s\' est invalide ou l\'utilisateur n\'existe pas',

'PERIOD_DAYS'							=> 'Chaque jour',
'PERIOD_WEEKS'							=> 'Chaque semaine',
'PERIOD_MONTHS'							=> 'Chaque mois',
'PERIOD_YEARS'							=> 'Chaque année',
'PERIOD_WEEKDAY_MONTH'					=> 'nième jour de la semaine tous les n mois',
'PERIOD_WEEKDAY_MONTH_YEAR'				=> 'nième jour de la semaine du nième mois chaque année',
'PERIOD_SPECIFY_DATES'					=> 'Spécifier plusieurs dates',
'PERIOD_N_DAYS'							=> 'Tous les n jours',
'PERIOD_N_WEEKS'						=> 'Toutes les n semaines',
'PERIOD_N_MONTHS'						=> 'Tous les n mois',
'PERIOD_N_YEARS'						=> 'Toutes les n années',

'SINGLE_EVENT'							=> 'Événement unique',
'INITIAL_EVENT'							=> 'Événement initial',
'REPEAT'								=> 'Répéter',
'REPEATED'								=> 'Répété',

'IS_REPEAT_EVENT'						=> 'Ceci est un événement répété',
'IS_CONTINUED_EVENT'					=> 'Cet événement se poursuit depuis la journée précédente',

'FIRST'									=> 'Premier',
'SECOND'								=> 'Deuxième',
'THIRD'									=> 'Troisième',
'FOURTH'								=> 'Quatrième',
'LAST'									=> 'Dernier',
'EVERY'									=> 'Chaque',
'MONTHS'								=> 'Mois',
'OF'									=> 'de',
'EVERY_YEAR'							=> 'Chaque année',

'INITIAL_EVENT_SETTINGS_NOTICE'			=> 'Les heures de l\'événement initial seront déterminées par les informations saisies ci-dessus',

'NTH_DAY_N_MONTHS_DETAILS'				=> ' le %s %s du mois, tous les %s mois<br />',
'NTH_DAY_NTH_MONTH_EACH_YEAR_DETAILS'	=> '%s %s de %s chaque année',

'ADD_EVENTS_CONFIRM'					=> 'Êtes-vous sûr de vouloir ajouter le(s) événement(s) suivant(s) ?<br />Fréquence de répétition : %s<br />%s',
'EDIT_EVENTS_CONFIRM'					=> 'Êtes-vous sûr de vouloir modifier l\'événement avec les paramètres suivants ?<br />Fréquence de répétition : %s<br />%s',

'DELETE_SINGLE_EVENT_CONFIRM'			=> 'Une fois supprimé, cet événement ne peut pas être récupéré.<br />Êtes-vous sûr de vouloir continuer ?',
'DELETE_MULTIPLE_EVENTS_CONFIRM'		=> 'Des événements répétés sont associés à cet événement. Supprimer cet événement supprimera également les instances répétées associées.<br />Êtes-vous sûr de vouloir continuer ?',
'DELETE_REPEAT_EVENT_INSTANCE_CONFIRM'	=> 'Cliquer sur "OUI" supprimera uniquement cette instance répétée de l\'événement.<br />Une fois supprimé, cet événement ne peut pas être récupéré.<br />Pour supprimer toutes les répétitions associées, vous devez supprimer l\'événement initial.<br />Êtes-vous sûr de vouloir continuer ?',
'DELETE_SINGLE_T_EVENT_CONFIRM'			=> 'Une fois supprimé, cet événement ne peut pas être récupéré.<br />La suppression de cet événement ne supprimera pas le sujet.<br />Êtes-vous sûr de vouloir continuer ?',
'DELETE_MULTIPLE_T_EVENTS_CONFIRM'		=> 'La suppression de cet événement supprimera également les événements répétés qui y sont associés.<br />Une fois supprimés, ces événements ne peuvent pas être récupérés.<br />La suppression de ces événements ne supprimera pas le sujet.<br />Êtes-vous sûr de vouloir continuer ?',
'DELETE_REPEAT_EVENT_T_INSTANCE_CONFIRM'=> 'Cliquer sur "OUI" supprimera uniquement cette instance répétée de l\'événement.<br />Une fois supprimé, cet événement ne peut pas être récupéré.<br />Pour supprimer toutes les répétitions associées, vous devez supprimer l\'événement initial.<br />La suppression de cet événement ne supprimera pas le sujet.<br />Êtes-vous sûr de vouloir continuer ?',

'CALENDAR_EVENT_ADDED'      			=> 'L\'événement a été ajouté avec succès',
'CALENDAR_EVENT_EDITED'     			=> 'L\'événement a été modifié avec succès',
'CALENDAR_EVENT_DELETED'    			=> 'L\'événement a été supprimé avec succès',
'CALENDAR_EVENTS_DELETED'    			=> 'Les événements ont été supprimés avec succès',
'CALENDAR_EVENT_INSTANCE_DELETED'		=> 'L\'instance d\'événement répétée a été supprimée avec succès',
'CALENDAR_REPEAT_EVENT_ADDED'      		=> 'Les événements répétés ont été ajoutés avec succès',
'CALENDAR_REPEAT_EVENT_EDITED'     		=> 'Les événements répétés ont été modifiés avec succès',
'CALENDAR_REPEAT_EVENT_DELETED'    		=> 'Les événements répétés ont été supprimés avec succès',
'ACTION_FAILED'             			=> 'L\'action demandée n\'a pas pu être effectuée',


// Special groups
'GROUP_PRIVATE'             			=> 'Privé',
'GROUP_PUBLIC'              			=> 'Public',

'EVENTS_OF'								=> 'Événements de',
'DATE'                     				=> 'Date',
'DAYS'                     				=> ' Jours, ',
'HOURS'                     			=> ' Heures, ',
'MINUTES'                  				=> ' Minutes ',
'DAY'                     				=> ' Jour, ',
'HOUR'                     				=> ' Heure, ',
'MINUTE'                  				=> ' Minute ',
'WEEK_NUM'                  			=> 'Sem',
'WEEK_NUM_EXPLAIN'          			=> 'Numéros de semaine calculés selon ISO-8601',
'WEEK_NUM_NOTES'            			=> 'Les numéros de semaine se rapportent à la semaine commençant le lundi. Comme votre calendrier est configuré pour afficher les jours commençant le dimanche, le dimanche de chaque semaine appartiendra au numéro de semaine précédent',
'STARTS'                  				=> 'Débute',
'ENDS'                     				=> 'Se termine',
'DURATION'                  			=> 'Durée',

'UNEXPECTED_ERROR'          			=> 'Une erreur inattendue est survenue',
'RETURN_CALENDAR'           			=> 'Retour au calendrier',
'READ_FULL_TOPIC'           			=> ' ...Lire le sujet en entier',

'CALENDAR_SETTINGS'         			=> 'Paramètres du calendrier',
'CAL_START_DAY'             			=> 'Début de la semaine',
'SHOW_WEEK_NUMS'						=> 'Afficher les numéros de semaine ?',
'SHOW_BIRTHDAYS'						=> 'Afficher les anniversaires dans la vue principale du calendrier ?',
'SHOW_UPCOMING_BIRTHDAYS'				=> 'Afficher la liste des anniversaires à venir ?',
'SHOW_UPCOMING_EVENTS'					=> 'Afficher la liste des événements à venir ?',
'UPCOMING_EVENTS_DAYS'					=> 'Événements à venir (Nombre de jours à afficher - Max : %s)',
'UPCOMING_BIRTHDAYS_DAYS'				=> 'Anniversaires à venir (Nombre de jours à afficher - Max : %s)',
'CALENDAR_NOTES'            			=> 'Notes supplémentaires sur le calendrier',
'HAS_ASSOCIATED_EVENT'      			=> 'Ce sujet a un événement qui lui est associé',
'GO_TO_EVENT'               			=> '...Voir dans le contexte du calendrier',
'MORE_EVENTS'               			=> 'Plus d\'événements...',
'BIRTHDAYS'                 			=> 'Anniversaires...',
'UPCOMING_BIRTHDAYS'        			=> 'Anniversaires à venir',
'UPCOMING_EVENTS'       				=> 'Événements à venir',
'NO_UPCOMING_BIRTHDAYS'     			=> 'Aucun anniversaire ce mois-ci',
'NO_UPCOMING_EVENTS'        			=> 'Aucun événement à venir',
'NO_EVENTS_TODAY'						=> 'Aucun événement aujourd\'hui',
'NO_REPEATS_FOUND'						=> 'Aucune instance répétée trouvée pour cet événement',
'ON'                     				=> 'le',
'AT'                     				=> 'à',
'UPCOMING_EVENTS_TIME_FRAME'			=> ' (Dans les %s prochains jours)',

'CALENDAR_EXPORT'						=> 'Exporter le calendrier',
'CALENDAR_EXPORT_ICAL'					=> 'Exporter en ICAL',
'CALENDAR_EXPORT_ICAL_EXPLAIN'			=> 'Exporter le calendrier au format .ical',
'CALENDAR_EXPORT_CSV'					=> 'Exporter en CSV',
'CALENDAR_EXPORT_CSV_EXPLAIN'			=> 'Exporter le calendrier au format .csv',
'CALENDAR_PUBLISH_RSS'					=> 'Publier en RSS',
'CALENDAR_PUBLISH_RSS_EXPLAIN'			=> 'Publier le calendrier au format RSS',
'CALENDAR_SUBSCRIBE_PRIV_CAL'			=> 'S\'abonner au RSS privé',
'CALENDAR_SUBSCRIBE_PRIV_CAL_EXPLAIN'	=> 'S\'abonner au flux RSS privé de votre calendrier',
'CALENDAR_SUBSCRIBE_PUBLIC_CAL'			=> 'S\'abonner au RSS public',
'CALENDAR_SUBSCRIBE_PUBLIC_CAL_EXPLAIN'	=> 'S\'abonner au flux RSS public du calendrier',

'CALENDAR_INVITE_ATTENDEES'				=> 'Inviter des participants ?',
'CALENDAR_SIGN_UP_INVITATION'			=> 'Vous êtes invité à assister ou à participer à cet événement',
'CALENDAR_SIGN_UP_ACCEPT'				=> 'ACCEPTER',
'CALENDAR_SIGN_UP_DECLINE'				=> 'REFUSER',
'CALENDAR_SIGN_UP_CONFIRM'				=> 'Êtes-vous sûr de vouloir vous inscrire à cet événement ?',
'CALENDAR_SIGN_DOWN_CONFIRM'			=> 'Êtes-vous sûr de vouloir refuser votre participation à cet événement ?',
'CALENDAR_SIGNED_UP'					=> 'Vous êtes inscrit à cet événement',
'CALENDAR_SIGNED_DOWN'					=> 'Vous avez indiqué que vous n\'assisterez pas à cet événement',
'CALENDAR_SIGN_UP_SUCCESS'				=> 'Vous avez soumis avec succès votre statut de participation à cet événement',
'CALENDAR_RETRACT_SIGN_UP_SUCCESS'		=> 'Vous avez retiré avec succès votre statut de participation à cet événement',
'CALENDAR_UN_SIGN_UP'					=> 'SE DÉSINSCRIRE',
'CALENDAR_UN_SIGN_UP_CONFIRM'			=> 'Êtes-vous sûr de vouloir vous désinscrire de cet événement ?',
'CALENDAR_EVENT_MEMBERS_SIGNED'			=> 'Membres inscrits à cet événement',
'CALENDAR_EVENT_MEMBERS_SIGNED_NONE'	=> 'Aucun membre ne s\'est inscrit à cet événement',
'CALENDAR_EVENT_MEMBERS_NOT_SIGNED'		=> 'Membres qui ne participeront pas à cet événement',
'CALENDAR_EVENT_MEMBERS_NOT_SIGNED_NONE'=> 'Aucun membre n\'a indiqué qu\'il n\'assistera pas à cet événement',
'CALENDAR'	=> 'Calendrier',

));