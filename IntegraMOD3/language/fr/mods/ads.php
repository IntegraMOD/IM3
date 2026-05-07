<?php
/**
*
* @package phpBB3 Advertisement Management
* @version $Id: ads.php 108 2010-05-31 04:02:56Z exreaction@gmail.com $
* @copyright (c) 2008 EXreaction, Lithium Studios
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ADVERTISEMENT_MANAGEMENT_CREDITS'		=> 'Ad Management &copy; <a href="https://www.phpbb.com/customise/db/author/exreaction" class="copyright" target="blank">EXreaction</a>',
	'MY_ADS'								=> 'Mes annonces',

	// Default Positions
	'ABOVE_FOOTER'			=> 'Au-dessus du pied de page',
	'ABOVE_HEADER'			=> 'Au-dessus de l\'en-tête',
	'ABOVE_POSTS'			=> 'Au-dessus des messages',
	'AFTER_EVERY_POST'		=> 'Après chaque message sauf le premier',
	'AFTER_FIRST_POST'		=> 'Après le premier message',
	'BELOW_FOOTER'			=> 'Sous le pied de page',
	'BELOW_HEADER'			=> 'Sous l\'en-tête',
	'BELOW_POSTS'			=> 'Sous les messages',

	// ACP
	'0_OR_NA'									=> '0 ou N/A',

	'ACP_ADVERTISEMENT_MANAGEMENT_EXPLAIN'		=> 'Ici vous pouvez modifier les paramètres de gestion des annonces, ajouter/supprimer/modifier des positions d\'annonces et ajouter/supprimer/modifier des annonces.',
	'ACP_ADVERTISEMENT_MANAGEMENT_SETTINGS'		=> 'Paramètres de gestion des annonces',
	'ADS_ACCURATE_VIEWS'						=> 'Comptage précis des vues',
	'ADS_ACCURATE_VIEWS_EXPLAIN'				=> 'Rend le comptage des vues d\'annonces beaucoup plus précis, mais augmente la charge serveur.',
	'ADS_COUNT_CLICKS'							=> 'Compter les clics sur les annonces',
	'ADS_COUNT_CLICKS_EXPLAIN'					=> 'Si réglé sur non, les clics sur les annonces ne seront pas comptés (moins de charge serveur).',
	'ADS_COUNT_VIEWS'							=> 'Compter les vues des annonces',
	'ADS_COUNT_VIEWS_EXPLAIN'					=> 'Si réglé sur non, les vues des annonces ne seront pas comptées (moins de charge serveur).',
	'AD_CREATED'								=> 'Annonce créée',
	'ADS_ENABLE'								=> 'Activer les annonces',
	'ADS_GROUP'									=> 'Groupe des propriétaires d\'annonces',
	'ADS_GROUP_EXPLAIN'							=> 'Groupe auquel seront ajoutés les propriétaires des annonces (non requis, seulement si vous souhaitez les ajouter à un groupe spécifique pour les suivre).',
	'ADS_RULES_FORUMS'							=> 'Utiliser les règles des forums pour les annonces',
	'ADS_RULES_FORUMS_EXPLAIN'					=> 'Si activé, cela vous permet de contrôler dans quels forums chaque annonce est affichée. Si vous ne prévoyez pas d\'utiliser cela, mettez sur non afin d\'utiliser moins de ressources.',
	'ADS_RULES_GROUPS'							=> 'Utiliser les règles de groupe pour les annonces',
	'ADS_RULES_GROUPS_EXPLAIN'					=> 'Si activé, cela vous permet de contrôler quels groupes voient ou ne voient pas des annonces spécifiques. Si vous ne prévoyez pas d\'utiliser cela, mettez sur non afin d\'utiliser moins de ressources.',
	'ADS_VERSION'								=> 'Version de la gestion des annonces',
	'ADVERTISEMENT'								=> 'Annonce',
	'ADVERTISEMENT_MANAGEMENT_UPDATE_SUCCESS'	=> 'Les paramètres de gestion des annonces ont été mis à jour avec succès !',
	'AD_ADD_SUCCESS'							=> 'Annonce ajoutée avec succès !',
	'AD_CLICK_LIMIT'							=> 'Limite de clics',
	'AD_CLICK_LIMIT_EXPLAIN'					=> '0 pour désactiver, sinon l\'annonce sera désactivée après ce nombre de clics.',
	'AD_CLICKS'									=> 'Clics sur l\'annonce',
	'AD_CLICKS_EXPLAIN'							=> 'Le nombre actuel de clics pour cette annonce (si configuré correctement).',
	'AD_CODE'									=> 'Code de l\'annonce',
	'AD_CODE_EXPLAIN'							=> 'Le code de l\'annonce que vous souhaitez afficher va ici. Tout le code doit être en HTML brut, les BBcodes ne sont pas pris en charge.<br /><strong>Si vous souhaitez activer le compteur de clics, utilisez {COUNT_CLICK} à tout endroit où l\'attribut onclick est autorisé (par exemple dans la balise a).</strong>',
	'AD_EDIT_SUCCESS'							=> 'Annonce modifiée avec succès !',
	'AD_ENABLED'								=> 'Annonce activée',
	'AD_ENABLED_EXPLAIN'						=> 'Décochez pour empêcher l\'affichage de cette annonce.',
	'AD_FORUMS'									=> 'Liste des forums',
	'AD_FORUMS_EXPLAIN'							=> 'Sélectionnez les forums où vous souhaitez afficher cette annonce. Vous pouvez sélectionner plusieurs forums en maintenant la touche CTRL enfoncée.',
	'AD_GROUPS'									=> 'Groupes',
	'AD_GROUPS_EXPLAIN'							=> 'Sélectionnez les groupes auxquels vous ne voulez pas afficher cette annonce. Vous pouvez sélectionner plusieurs groupes en maintenant la touche CTRL enfoncée pendant la sélection.',
	'AD_LIST_NOTICE'							=> 'Les clics sur les annonces ne seront disponibles que si vous avez utilisé {COUNT_CLICK} à un endroit compatible avec l\'attribut onclick.',
	'AD_MAX_VIEWS'								=> 'Vues max',
	'AD_MAX_VIEWS_EXPLAIN'						=> 'Le nombre maximal de vues avant que cette annonce ne soit plus affichée. <strong>0 signifie aucune limite</strong>.',
	'AD_NAME'									=> 'Nom de l\'annonce',
	'AD_NAME_EXPLAIN'							=> 'Utilisé uniquement pour vous permettre d\'identifier l\'annonce.',
	'AD_NOT_EXIST'								=> 'L\'annonce sélectionnée n\'existe pas.',
	'AD_NOTE'									=> 'Notes sur l\'annonce',
	'AD_NOTE_EXPLAIN'							=> 'Saisissez des notes pour cette annonce si vous le souhaitez. Ces notes ne sont affichées que dans l\'ACP.',
	'AD_OWNER'									=> 'Propriétaire de l\'annonce',
	'AD_OWNER_EXPLAIN'							=> 'L\'utilisateur qui possède cette annonce (peut la voir dans son panneau d\'annonces).',
	'AD_POSITIONS'								=> 'Positions',
	'AD_POSITIONS_EXPLAIN'						=> 'Sélectionnez les positions où vous souhaitez afficher cette annonce.',
	'AD_PRIORITY'								=> 'Priorité de l\'annonce',
	'AD_PRIORITY_EXPLAIN'						=> 'Plus le nombre est élevé, plus l\'annonce a de chances d\'être affichée. Par exemple, une annonce avec une priorité de 2 aura deux fois plus de chances d\'être affichée qu\'une annonce avec une priorité de 1, 3 aura trois fois plus de chances, etc.',
	'AD_TIME_END'								=> 'Diffuser jusqu\'à',
	'AD_TIME_END_BEFORE_NOW'					=> 'La date de fin que vous avez saisie est antérieure à la date actuelle. Veuillez vous assurer d\'utiliser une date compatible avec strtotime.',
	'AD_TIME_END_EXPLAIN'						=> 'Saisissez une date valide pour mettre fin à l\'annonce. Après la date indiquée, l\'annonce sera désactivée automatiquement. Notez que cela utilise la fonction PHP <a href="http://us2.php.net/manual/en/function.strtotime.php">strtotime</a>, donc formatez correctement la date sinon elle ne sera pas prise en compte.<br /><br /><strong>Cette date de fin n\'est pas entièrement précise avec les fuseaux horaires, il ne faut donc pas se fier à des heures exactes. Il est recommandé de prévoir une précision d\'environ 1 jour.</strong>',
	'AD_VIEW_LIMIT'								=> 'Limite de vues',
	'AD_VIEW_LIMIT_EXPLAIN'						=> '0 pour désactiver, sinon l\'annonce sera désactivée après ce nombre de vues.',
	'AD_VIEWS'									=> 'Vues de l\'annonce',
	'AD_VIEWS_EXPLAIN'							=> 'Le nombre actuel de vues de cette annonce.',
	'ALL_FORUMS_EXPLAIN'						=> 'Sélectionnez pour afficher dans tous les forums et pages. Notez que si ceci n\'est pas coché, l\'annonce ne s\'affichera pas sur les pages non liées aux forums (comme la page FAQ par exemple).',

	'CREATE_AD'									=> 'Créer une annonce',
	'CREATE_POSITION'							=> 'Créer une position',
	'COPY'										=> 'Copier',

	'DELETE_AD'									=> 'Supprimer l\'annonce',
	'DELETE_AD_CONFIRM'							=> 'Êtes-vous sûr de vouloir supprimer cette annonce ?',
	'DELETE_AD_SUCCESS'							=> 'L\'annonce a été supprimée avec succès !',
	'DELETE_POSITION'							=> 'Supprimer la position',
	'DELETE_POSITION_CONFIRM'					=> 'Êtes-vous sûr de vouloir supprimer cette position ? Si vous supprimez une position, toutes les annonces qui étaient affichées à cet emplacement ne seront plus affichées.',
	'DELETE_POSITION_SUCCESS'					=> 'La position a été supprimée avec succès !',

	'FALSE'										=> 'Faux',

	'NO_ADS_CREATED'							=> 'Aucune annonce créée',
	'NO_AD_NAME'								=> 'Vous devez définir un nom pour l\'annonce.',
	'NO_POSITIONS_CREATED'						=> 'Aucune position créée',

	'POSITION'									=> 'Position',
	'POSITION_CODE'								=> 'Code de position',
	'POSITION_EDIT_SUCCESS'						=> 'Position modifiée avec succès !',
	'POSITION_NAME'								=> 'Nom de la position',
	'POSITION_NAME_EXPLAIN'						=> 'Le nom de la position.',
	'POSITION_NOT_EXIST'						=> 'La position sélectionnée n\'existe pas.',
	'POSTITION_ADD_SUCCESS'						=> 'Position ajoutée avec succès !',
	'POSTITION_ALREADY_EXIST'					=> 'Vous avez déjà une position avec ce nom.',

	'TRUE'										=> 'Vrai',
));