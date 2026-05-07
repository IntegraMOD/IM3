<?php
/**
*
* @package Kiss Portal Engine (acp_k_blocks) (English)
*
* @package language
* @version $Id:$ 1.0.19
* @copyright (c) 2005-2011 Michael O'Toole (mike@phpbbireland.com)
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
// phpbbportal profile fields
$lang = array_merge($lang, array(

	'ACP_BLOCKS'                  => 'Blocs',
	'ACP_BLOCK_TOOLS'             => 'Outils des blocs',
	'BLOCK_ACTIVE'                => 'Le bloc est actif',
	'BLOCK_ADDED'                 => ' Bloc ajouté !',
	'BLOCK_CACHE_TIME'            => 'Définir le temps de cache du bloc.',
	'BLOCK_CACHE_TIME_EXPLAIN'    => 'Temps de cache par défaut pour les blocs (600).',
	'BLOCK_CACHE_TIME_HEAD'       => 'Temps de cache du bloc',
	'BLOCK_DELETE'                => 'Suppr.',
	'BLOCK_DELETED'               => ' Bloc supprimé',
	'BLOCK_DISABLED_BIG'          => 'Le bloc est désactivé',
	'BLOCK_EDITED'                => ' Bloc modifié !',
	'BLOCK_FNAME_EXPLAIN'         => '(styles/portal_common/template/blocks)',
	'BLOCK_FNAME_H'               => 'Nom du fichier (.html)',
	'BLOCK_FNAME_H_BIG'           => 'Nom du fichier HTML du bloc',
	'BLOCK_FNAME_I'               => 'Icône',
	'BLOCK_FNAME_I_EXPLAIN'       => 'Veuillez noter que les noms de fichiers d’image ne peuvent pas contenir d’espaces.',
	'BLOCK_FNAME_I_BIG'           => 'Mini image du bloc',
	'BLOCK_FNAME_IS_BIG'          => 'Mini images de bloc trouvées',
	'BLOCK_FNAME_IS_BIG2'         => '(images/block_images/block)',
	'BLOCK_FNAME_P'               => 'Nom du fichier (.php)',
	'BLOCK_FNAME_P_BIG'           => 'Nom du fichier PHP du bloc',
	'BLOCK_G_COUNT'               => 'Stockage générique pour les blocs',
	'BLOCK_G_COUNT_EXPLAIN'       => 'Nombre d’annonces, d’actualités ou de sujets récents à afficher si le défilement est désactivé dans leurs blocs associés.',
	'BLOCK_INDEX'                 => '(Index / ordre de tri)',
	'BLOCK_LINE'                  => ', ligne ',
	'BLOCK_MOVE_ERROR'            => 'Les blocs nécessitent une réindexation...<br /><br />Les valeurs ndx des blocs sont hors séquence, vous pouvez revenir en arrière et les corriger manuellement ou utiliser <br /><br /><strong>Gérer tous les blocs</strong> dans le menu de gauche et cliquer sur le bouton [Réindexer les blocs]...<br /><br />Une fois les valeurs ndx corrigées, vous pourrez déplacer les blocs.<br />',
	'BLOCK_NDX'                   => 'NDX',
	'BLOCK_POSITION_BIG'          => 'Position du bloc',
	'BLOCK_SCROLL'                => 'S',
	'BLOCK_TITLE'                 => 'Titre du bloc',
	'BLOCK_TYPE'                  => 'T',
	'BLOCK_TYPE_BIG'              => 'Type de fichier',
	'BLOCK_UPDATED'               => ' Bloc mis à jour',
	'BLOCK_VIEW_ALL'              => 'Optionnellement',
	'BLOCK_VIEW_ALL_EXPLAIN'      => 'Ignorer ces paramètres et définir la visibilité de ce bloc à <strong>tous</strong> les groupes.',
	'BLOCK_VIEW_BY'               => 'Groupes',
	'BLOCK_VIEW_BY_EXPLAIN'       => 'Sélectionnez un groupe à ajouter à la liste actuelle.<br />Sélectionner <b>(Aucun)</b> videra la liste.',
	'BLOCK_VIEW_GROUPS'           => 'Visibilité des groupes du bloc',
	'BLOCK_VIEW_GROUPS_EXPLAIN'   => 'Saisissez manuellement les ID de groupe (séparés par des virgules) ou utilisez la liste déroulante ci-dessous pour les ajouter automatiquement.',
	'BLOCK_SCROLL_BIG'            => 'Autoriser le défilement',
	'BLOCK_SCROLL_BIG_EXPLAIN'    => 'Oui : le contenu du bloc défile, Non : le bloc est statique.',
	'BLOCK_UPDATING'              => 'Positions des blocs mises à jour...<br />',
	'BLOCK_VAR_FILE'              => 'Sélectionnez le fichier de configuration utilisé pour afficher/modifier les variables',
	'BLOCK_VAR_FILE_EXPLAIN'      => '(situé dans le dossier adm/style/k_block_vars).',
	'BLOCKS_ADD_HEADER'           => 'Ajouter un nouveau bloc',
	'BLOCKS_HEADER_ADMIN'         => 'Gestion des blocs',
	'BLOCKS_REINDEX'              => 'Réindexer les blocs',
	'BLOCKS_AUTO_REINDEXED'       => 'L’index des blocs a été corrigé...',
	'BLOCKS_REINDEXED'            => 'Tous les blocs ont été réindexés',

	'CONFIRM_OPERATION_BLOCKS'            => 'Souhaitez-vous supprimer ce bloc ?',
	'CONFIRM_OPERATION_BLOCKS_REINDEX'    => 'Souhaitez-vous réindexer les blocs ?',
	'DELETE_THIS_BLOCK'                   => 'Supprimer ce bloc',
	'DO_NOT_EDIT'                         => ' (Ne pas modifier cette valeur)',
	'EDIT_BLOCK'                          => 'Modifier le bloc',
	'HAS_VARS'                            => 'Le bloc contient des données configurables',
	'HAS_VARS_EXPLAIN'                    => '(les informations de configuration sont stockées dans la base de données).',
	'LEFT_OF_CENTRE'                 => 'Gauche (centre 2x)',
	'MANAGE_PAGES'                   => 'Gérer les pages',
	'MINIMOD_BASED'                  => 'Ce bloc est-il basé sur un minimod SGP ?',
	'MINIMOD_BASED_EXPLAIN'          => 'Sélectionnez Oui si le bloc est basé sur un minimod du portail (configuré ailleurs).',
	'MINIMOD_OPTIONS'                => 'Quel minimod est associé à ce bloc ?',
	'MINIMOD_OPTIONS_EXPLAIN'        => 'Ignorer si le bloc n’est pas basé sur un minimod.',
	'MINIMOD_DETAILS_SHOW'           => 'Ce bloc est basé sur un minimod, voici un lien vers celui-ci !',
	'MINIMOD_DETAILS_NO_EDIT'        => 'Le bloc n’est pas un minimod',

	'MUST_SELECT_VALID_BLOCK_DATA'   => 'ID de bloc invalide',
	'PAGE_ARRAY'                     => 'Tableau des pages',
	'PAGE_ARRAY_EXPLAIN'             => 'Liste de tous les blocs où le bloc est visible',
	'PAGE_CENTRE'                    => 'Centre de la page',
	'PAGE_LEFT'                      => 'Gauche de la page',
	'PAGE_RIGHT'                     => 'Droite de la page',
	'PORTAL_BLOCKS_ENABLED'          => 'Blocs du portail activés',
	'RIGHT_OF_CENTRE'                => 'Droite (centre 2x)',
	'SET_VARIABLES_IN_MINI-MODULES'  => 'Définir les variables dans les mini-modules',

	'BLOCKS_TITLE'                   => 'Administration / gestion des blocs',
	'BLOCKS_TITLE_EXPLAIN'           => '&bull; Les titres des blocs seront remplacés par les variables de langue de l’utilisateur, sinon les valeurs ci-dessous seront utilisées.<br />&bull; Le dernier bloc modifié est mis en évidence (en gras).',
	'BLOCKS_TITLE_EXPLAIN_EXPAND'    => '&bull; Le NDX indique la position par rapport aux autres blocs dans la même colonne.<br />&bull; Les fichiers HTML des blocs se trouvent dans : styles/_portal_common/template/blocks.',

	'UNKNOWN_ERROR'                  => 'Erreur lors du traitement des données enregistrées<br />',
	'VARS_HAS_EDIT'                  => 'Définir les variables du bloc',
	'VARS_NO_EDIT'                   => 'Le bloc ne contient pas de variables',

	'VIEW_PAGE'                 => 'Ajouter une page parmi les pages disponibles :',
	'VIEW_PAGE2'                => 'Pages disponibles :',
	'VIEW_PAGES'                => 'ID des pages où le bloc sera affiché',
	'VIEW_PAGE_EXPLAIN'         => 'Sélectionnez dans cette liste (réutilisable) pour ajouter, sélectionner <strong>Aucun</strong> videra la liste.',
	'VIEW_PAGE_EXPLAIN2'        => 'Sélectionnez les pages où ce bloc sera visible.<br /><br /><strong>Remarques :</strong><br />Les blocs ne seront visibles que sur les pages qui les prennent en charge.<br />Nous ne traitons pas les blocs si les informations qu’ils contiennent sont déjà traitées par la page sur laquelle ils sont affichés.',
	'VIEW_PAGES_EXPLAIN'        => 'La liste sera mise à jour automatiquement.',

));

// Message Settings
$lang = array_merge($lang, array(
	'ACP_MESSAGE_SETTINGS_EXPLAIN'    => 'Vous pouvez définir ici tous les paramètres par défaut pour la messagerie privée',
));

// common single words
$lang = array_merge($lang, array(
	'ACTIVE'      => 'Actif',
	'ALL_GROUPS'  => 'Tous les groupes',
	'BBCODE'      => 'BBCode',
	'DISABLED'    => 'Désactivé',
	'DOWN'        => 'Bas',
	'EDIT'        => 'Modifier',
	'HTML'        => 'HTML',
	'ID'          => 'ID',
	'MOVE'        => 'Déplacer',
	'MOVE_DOWN'   => 'Déplacer vers le bas',
	'MOVE_UP'     => 'Déplacer vers le haut',
	'NONE'        => 'Aucun',
	'POSITION'    => 'Position',
	'PROCESS'     => 'traiter',
	'SAVING'      => 'Modifications enregistrées...',
	'SAVED'       => 'Données enregistrées...',
	'VIEW_BY'     => 'Afficher par',
	'UP'          => 'Haut',
));
