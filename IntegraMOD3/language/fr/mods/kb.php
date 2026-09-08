<?php
/**
*
* Knowledge Base [French]
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package language
* @version $Id$
* @copyright (c) 2007 SEO phpBB http://www.phpbb-seo.de
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



$lang = array_merge($lang, array(
	'VIEW_KB_TOPIC'				=> 'Voir le sujet dans le forum',
	'EDIT_REASON'				=> 'Raison de la modification de cet article',
	'ACL_TYPE_KB_'				=> '',
	'ACP_KB_ROLES'				=> 'Rôles de la base de connaissances',
	'ACP_KB_ROLES_EXPLAIN'		=> '',
	'KB_CATEGORIE_PERMISSIONS'	=> 'Permissions des catégories de la base de connaissances',
	'KB_CATEGORIE_PERMISSIONS_DESC'	=> 'Ici, vous pouvez définir quels utilisateurs et groupes peuvent accéder à quelle catégorie.',
	'LOOK_UP_CATEGORIE'			=> 'Sélectionner une catégorie',
	'LOOK_UP_FORUMS_EXPLAIN'	=> 'Vous pouvez sélectionner plus d’une catégorie',
	'ACL_TYPE_LOCAL_KB_'		=> 'Permissions de la base de connaissances',
	'PERMISSION_TYPE'			=> 'Permissions de la base de connaissances',
	'ALL_CATEGORIES'			=> 'Toutes les catégories',
	'SELECT_CATEGORIE_SUBFORUM_EXPLAIN'	=> 'La catégorie sélectionnée ici inclura toutes les sous-catégories dans la sélection.',
	'USER'						=> 'Utilisateur',
	'ACTIVATE_RATING'			=> 'Autoriser les notes',
	'ACTIVATE_RATING_DESC'		=> 'Autoriser les utilisateurs à noter les articles',
	'YOU_RATED'					=> 'Votre note',
	'ALREADY_RATED'				=> 'ERREUR !!! Vous avez déjà noté',
	'ARTICLE_RATED'				=> 'Vous avez noté cet article',
	'RATING'					=> 'Note',
	'RATINGS'					=> 'Notes',
	'RATE_GOOD'					=> 'très bon',
	'RATE_ACCEPTABLE'			=> 'acceptable',
	'RATE_BAD'					=> 'mauvais',
	'RATE_ARTICLE'				=> 'Noter l’article',
	'RATE'						=> 'Noter',
	'ACTIVATE_POST'				=> 'Créer un message',
	'ACTIVATE_POST_DESC'		=> 'Créer un message dans le forum lors de l’ajout d’un article',
	'ACTIVATE_DIFF'				=> 'Activer l’historique',
	'ACTIVATE_DIFF_DESC'		=> 'Lors de la modification d’un article, l’ancienne version est enregistrée',
	'ACTION'					=> 'Action',
	'ACTIVATE_SIMILAR'			=> 'Activer les articles similaires',
	'ACTIVATE_SIMILAR_DESC'		=> '',
	'DIFFERENCE'				=> 'Différence entre la version : %s et l’article actuel',
	'DIFF_DEL'					=> 'Supprimer l’ancienne version ?',
	'DIFF_RESTORE'				=> 'Restaurer l’ancienne version',
	'ARTICLE_RESTORED'			=> 'L’article a été restauré',
	'SIMILAR_ARTICLES'			=> 'Articles similaires',
	'OLD_VERSIONS'				=> 'Anciennes versions',
	'RESTORE'					=> 'Restaurer',
	'ARTICLE_DETAIL'			=> 'Détails de l’article',
	'ARTICLE_REPORTED'			=> 'Cet article a été signalé',
	'DISPLAY_ON_INDEX'			=> 'Afficher dans la catégorie principale',
	'DISPLAY_ON_INDEX_DESC'		=> '',
	'DELETED'					=> 'L’entrée a été supprimée',
	'MCP_REPORT_TITLE'			=> 'Articles signalés',
	'MCP_REPORT_EXPLAIN'		=> '',
	'REALY_DELETE'				=> 'L’entrée doit-elle vraiment être supprimée ?',
	'VIEW_REPORTS_OLD'			=> 'Voir les signalements fermés',
	'VIEW_REPORTS_NEW'			=> 'Voir les signalements ouverts',
	'SHOW_ARTICLE'				=> 'Afficher l’article',
	'SORT_ORDER'				=> 'Ordre de tri',
	'SORT_ORDER_DESC'			=> 'Tri des articles dans les catégories',
	'SUB_CATGEGORIES'			=> 'Sous-catégories',
	'SEARCH_CATEGORIE'			=> 'Rechercher dans la catégorie',
	'ACP_TYPES'					=> 'Types d’article',
	'ACP_TYPES_DESC'			=> 'Ici, vous pouvez ajouter et modifier les types d’article',
	'ACP_CATEGORIE'				=> 'Catégorie',
	'ACP_CATEGORIE_DESC'		=> 'Ici, vous pouvez ajouter ou modifier les catégories de la base de connaissances.',
	'ACP_CONFIG'				=> 'Configuration',
	'ACP_CONFIG_DESC'			=> 'Ici, vous pouvez modifier la configuration de la base de connaissances.',
	'ARTICLE_ACTIVATED'			=> 'L’article a été publié !',
	'ARTICLE_DELETED'			=> 'L’article a été supprimé !',
	'ARTICLE_ADDED'				=> 'L’article a été soumis et sera publié dans la base de connaissances après validation.',
	'ARTICLE_HISTORY'			=> 'Journal de l’article',
	'ARTICLE_ADD'				=> 'Ajouter un article',
	'ARTICLE_TITLE'				=> 'Titre',
	'ARTICLE_TITLE_LANG_EXPLAIN'	=> 'Pour utiliser une chaîne du catalogue localisé, saisissez le champ entier sous la forme {L_KEY}. Les clés se trouvent dans language/{iso}/kb/articles.php. Enregistrez ce fichier PHP en UTF-8 sans BOM (Notepad++ : Encoding → Convert to UTF-8 without BOM, puis Enregistrer). Le Bloc-notes Windows peut ajouter un BOM et faire planter le forum avec « headers already sent ». Les titres normaux sont enregistrés tels quels.',
	'ARTICLE_DESCRIPTION'		=> 'Description',
	'ARTICLE_DESCRIPTION_LANG_EXPLAIN'	=> 'Facultatif. Utilisez {L_KEY} pour une description localisée, ou du texte normal. Les fichiers catalogue doivent être enregistrés en UTF-8 sans BOM.',
	'ARTICLE_LANG_EXPLAIN'		=> 'Pour localiser le corps de l’article, saisissez uniquement {L_KEY} dans ce champ. Sinon, rédigez l’article comme d’habitude. Éditez language/{iso}/kb/articles.php dans Notepad++ ou un autre éditeur capable d’enregistrer en UTF-8 sans BOM. N’utilisez pas le Bloc-notes Windows.',
	'KB_LANG_KEY_MISSING'		=> 'La clé de langue %s est introuvable dans language/en/kb/articles.php.',
	'ARTICLE'					=> 'Article',
	'ARTICLE_TYPES'				=> 'Types d’article',
	'ARTICLE_TYPES_DESC'		=> 'Dans quels types d’article souhaitez-vous rechercher ? Utilisez la touche Ctrl pour en choisir plusieurs. Ne choisissez aucun type pour rechercher dans tous les types.',
	'ARTICLE_CONT'				=> 'Articles dans la base de données',
	'ARTICLE_DEL'				=> 'L’article doit-il vraiment être supprimé ?',
	'ARTICLE_EDIT'				=> 'Modifier l’article',
	'ARTICLE_EDITED'			=> 'L’article a été modifié !',
	'ARTICLE_DEACTIVATED'		=> 'Article verrouillé',
	'ARTICLE_POSTET'			=> 'Article publié',
	'AKTIVATE'					=> 'Activer',

	'BACK_ARTICLE'				=> 'Retour à l’article',
	'BACK_KB'					=> 'Retour à la base de connaissances',
	'BACK_TO_ARTICLE'			=> 'Cliquez %sici%s pour voir l’article.',
	'BACK_TO_POSTING'			=> 'Cliquez %sici%s pour revenir en arrière.',
	'BACK_TO_KB'				=> 'Cliquez %sici%s pour revenir à la base de connaissances.',
	'BACK_TO_LOG'				=> 'Cliquez %sici%s pour revenir au journal de l’article.',

	'CATEGORIE'					=> 'Catégorie',
	'CHANGED_AT'				=> 'Modifié le',
	'CONT_CAT'					=> 'Catégories',
	'CATEGORIES'				=> 'catégories',
	'CATEGORIES_DESC'			=> 'Dans quelles catégories souhaitez-vous rechercher ? Utilisez la touche Ctrl pour en choisir plusieurs. Ne choisissez aucune catégorie pour rechercher dans toutes.',
	'CAT_NOT_EMPTY'				=> 'La catégorie n’est pas vide !',
	'NO_CAT'					=> 'La catégorie sélectionnée n’existe pas.',
	'CAT_NAME'					=> 'Nom de la catégorie',
	'CAT_NAME_DESC'				=> 'Nom de la catégorie',
	'CAT_IMAGE'					=> 'Image de la catégorie',
	'CAT_IMAGE_DESC'			=> 'Saisissez ici l’URL d’une image pour la catégorie.',
	'CAT_DECRIPTION_DESC'		=> 'Donnez une description pour la catégorie',
	'CAT_MAIN'					=> 'Catégorie principale',
	'CAT_SELECT_MAIN'			=> 'Choisir une catégorie principale',
	'CAT_ADDED'					=> 'La catégorie a été ajoutée',
	'CAT_DELETED'				=> 'La catégorie a été supprimée.',
	'CAT_UPDATED'				=> 'La catégorie a été mise à jour.',
	'CAT_REALY_DELETE'			=> 'La catégorie doit-elle vraiment être supprimée ?',
	'CAT_CREATE_NEW'			=> 'Nouvelle catégorie',
	'DESCRIPTION'				=> 'Description',


	'FIENAME'				=> 'Nom de fichier',
	'FOUND_IN'				=> 'Trouvé dans',
	'INDEX_POSTS'			=> 'Articles sur la page d’index',
	'INDEX_POSTS_DESC'		=> 'Combien d’articles doivent être affichés sur la page d’index ?',
	'KB_NAME'				=> 'Base de connaissances',
	'KB_NAME_DESC'			=> 'Le nom de la base de connaissances',
	'KB_DECRIPTION_DESC'	=> 'Saisissez une description pour la base de connaissances.',
	'KBASE'					=> 'Base de connaissances',
	'KB_DESCRIPTION'		=> 'Si vous avez rédigé un article, vous pouvez le prévisualiser en bas de page et le soumettre pour validation. S’il est approuvé, l’article sera publié dans la base de connaissances. ',

	'LOG_TITEL'				=> 'Journal de l’article',
	'LOG_DESCRIPTION'		=> 'Ici, vous pouvez voir quand l’article a été modifié et par quel utilisateur.',
	'LOG_DELETED'			=> 'Le journal de l’article a été supprimé.',

	'MAINCAT_DESC'			=> 'Ici, vous pouvez créer des catégories principales, dans lesquelles vous créez ensuite des sous-catégories pour les articles.',
	'MODE'					=> 'Mode',
	'MODE_DESC'				=> 'Quel mode souhaitez-vous utiliser pour la page d’index ?',
	'MODE_MODERN'			=> 'Moderne',
	'MODE_CLASSIC'			=> 'Classique',
	'NO_ARTICLE'			=> 'L’article demandé n’existe pas !',
	'NEED_INPUT'			=> 'Saisissez un titre et un texte pour l’article !',
	'ARTICLE_NEW'			=> 'Articles non publiés',
	'ARTICLE_NEW_DESC'		=> 'Les articles suivants ne sont pas encore publiés ou ont été verrouillés',
	'NAME'					=> 'Nom de la catégorie',
	'NEED_NAME'				=> 'Donnez un nom à la catégorie',
	'ARTICLE_NEWEST'		=> 'L’article le plus récent est',
	'NO_TYPE'				=> 'Aucun type',
	'POST_FORUM'			=> 'Forum de référence pour l’article',
	'POST_TEMPLATE'			=> 'Modèle de message',
	'POST_MESSAGE'			=> 'Texte du message',
	'POST_USER'				=> 'ID utilisateur',
	'POST_NORMAL'			=> 'Normal',
	'POST_TOPIC_GLOBAL'		=> 'Annonce globale',
	'POST_TOPIC_AS'			=> 'Publier le sujet en tant que',
	'POST_TOPIC_AS_DESC'	=> 'Quel type de sujet sera créé ?',
	'POST_USER_DESC'		=> 'L’ID de l’utilisateur qui crée les messages',
	'POST_SUBJECT'			=> 'Titre du sujet',
	'POST_SUBJECT_DESC'		=> 'Le titre du sujet qui sera créé',
	'POST_FORUM_DESC'		=> 'Indiquez l’ID du forum dans lequel une référence à l’article doit être créée. Saisissez « 0 » pour ne pas créer de référence aux nouveaux articles.',
	'POST_MESSAGE_DESC'		=> '{TITLE} = Titre de l’article <br />{DESCRIPTION} = Description de l’article<br />{POST_TIME} = Date de rédaction<br />{TYPE} = Type d’article<br />{SUB_CAT} = Catégorie<br />{URL} = URL de l’article<br />{AUTHOR} = Auteur de l’article<br />{AUTHOR_ID} = ID utilisateur de l’auteur.',
	'RELASED'				=> 'Publié le',
	'READ_MORE'				=> 'Afficher les %s articles',


	'SEARCH_KEYWORDS_DESC'	=> 'Ici, vous pouvez rechercher dans la base de connaissances.',
	'SHOW_EDITS'			=> 'Afficher les modifications',
	'SHOW_EDITS_DESC'		=> 'Les modifications doivent-elles être affichées dans l’article ?',
	'TYPE'					=> 'Type d’article',
	'TYPE_DESC'				=> 'Donnez un nom au type d’article',
	'TYPE_ADDED'			=> 'Le type a été ajouté',
	'TYPE_UPDATED'			=> 'Le type a été supprimé',

	'NO_SUBCAT_IN_MAINCAT'	=> 'Vous ne pouvez pas créer de sous-catégories dans l’index !',
	'CAT_TYPE'				=> 'Type de catégorie',
	'CAT_TYPE_DESC'			=> 'Choisissez un type de catégorie',
	'IN_INDEX'				=> 'Dans l’index',
	'CAT_SUB'				=> 'Sous-catégorie',

	'CACHE_TIME'			=> 'Durée du cache',
	'CACHE_TIME_DESC'		=> 'Durée pendant laquelle les types et catégories sont mis en cache',
	'SECONDS'				=> 'Secondes',
	'ACTIVATE_TYPES'		=> 'Utiliser les types d’article ?',
	'ACTIVATE_TYPES_DESC'	=> 'Peut-on attribuer un type à un article ?',
	'UPDATE_POST'			=> 'Actualiser le message',
	'UPDATE_POST_DESC'		=> 'Le message de l’article doit-il être mis à jour lorsque l’article est modifié ?',
	'POST_UPDATE_MESSAGE'	=> 'Article mis à jour',
	'POST_ID'				=> 'ID du message du forum',
	'ARTICLE_ADDED_AKTIV'	=> 'L’article a été enregistré dans la base de données et activé',
	'SHOW_POST_EDIT'		=> 'Afficher les mises à jour',
	'SHOW_POST_EDIT_DESC'	=> 'Une mise à jour doit-elle être affichée dans le message ?',

	'PRINT_TOPIC'			=> 'Imprimer l’article',
	'SEARCH_CATEGORIE'		=> 'Rechercher dans la catégorie...',

	'ADS'					=> 'Publicité',
	'KB_COPYRIGHT'			=> 'Base de connaissances par Tobi Schaefer',
	'ADS_DESC'				=> 'Ici, vous pouvez insérer le code de votre publicité.',
	'URI_IN_USE'			=> 'Cette URL est déjà utilisée',
	'USER_CHANGED'			=> 'L’utilisateur a été modifié',

));


