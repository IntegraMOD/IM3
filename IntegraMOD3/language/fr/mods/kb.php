<?php
/**
*
* Knowledge Base [English]
* @author Tobi Schaefer http://www.tas2580.de/
*
* english translation by RedTrinity
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
	'VIEW_KB_TOPIC'				=> 'View topic in forum',
	'EDIT_REASON'				=> 'Reason for editing this article',
	'ACL_TYPE_KB_'				=> '',
	'ACP_KB_ROLES'				=> 'Knowledge Base-Roles',
	'ACP_KB_ROLES_EXPLAIN'		=> '',
	'KB_CATEGORIE_PERMISSIONS'	=> 'Knowledge Base Category permissions',
	'KB_CATEGORIE_PERMISSIONS_DESC'	=> 'Here you can alter which users and groups can access which category.',
	'LOOK_UP_CATEGORIE'			=> 'Select a category',
	'LOOK_UP_FORUMS_EXPLAIN'	=> 'You are able to select more than one category',
	'ACL_TYPE_LOCAL_KB_'		=> 'Knowledge Base permissions',
	'PERMISSION_TYPE'			=> 'Knowledge Base permissions',
	'ALL_CATEGORIES'			=> 'All categories',
	'SELECT_CATEGORIE_SUBFORUM_EXPLAIN'	=> 'The Category you select here will include all subcategories into the selection.',
	'USER'						=> 'User',
	'ACTIVATE_RATING'			=> 'Allow rating',
	'ACTIVATE_RATING_DESC'		=> 'Allow users to rate articles',
	'YOU_RATED'					=> 'Own rating',
	'ALREADY_RATED'				=> 'ERROR!!! You have already rated',
	'ARTICLE_RATED'				=> 'You have rated this article',
	'RATING'					=> 'Rating',
	'RATINGS'					=> 'Ratings',
	'RATE_GOOD'					=> 'very good',
	'RATE_ACCEPTABLE'			=> 'acceptable',
	'RATE_BAD'					=> 'bad',
	'RATE_ARTICLE'				=> 'Rate article',
	'RATE'						=> 'Rate',
	'ACTIVATE_POST'				=> 'Write posting',
	'ACTIVATE_POST_DESC'		=> 'Write a post to forum when adding an article',
	'ACTIVATE_DIFF'				=> 'Activate history',
	'ACTIVATE_DIFF_DESC'		=> 'When editing an article the old version will be saved',
	'ACTION'					=> 'Action',
	'ACTIVATE_SIMILAR'			=> 'Activate similar articles',
	'ACTIVATE_SIMILAR_DESC'		=> '',
	'DIFFERENCE'				=> 'Difference between version: %s and curent article',
	'DIFF_DEL'					=> 'Delete the old version?',
	'DIFF_RESTORE'				=> 'Restore the old version',
	'ARTICLE_RESTORED'			=> 'The article has been restored',
	'SIMILAR_ARTICLES'			=> 'Similar articles',
	'OLD_VERSIONS'				=> 'Old versions',
	'RESTORE'					=> 'Restore',
	'ARTICLE_DETAIL'			=> 'Article details',
	'ARTICLE_REPORTED'			=> 'This article was reported',
	'DISPLAY_ON_INDEX'			=> 'Show in main category',
	'DISPLAY_ON_INDEX_DESC'		=> '',
	'DELETED'					=> 'The entry was deleted',
	'MCP_REPORT_TITLE'			=> 'Reported articles',
	'MCP_REPORT_EXPLAIN'		=> '',
	'REALY_DELETE'				=> 'Should the entry realy be deleted?',
	'VIEW_REPORTS_OLD'			=> 'View closed reports',
	'VIEW_REPORTS_NEW'			=> 'View open reports',
	'SHOW_ARTICLE'				=> 'Show article',
	'SORT_ORDER'				=> 'Sort order',
	'SORT_ORDER_DESC'			=> 'Sorting of articles in categories',
	'SUB_CATGEGORIES'			=> 'Sub-categories',
	'SEARCH_CATEGORIE'			=> 'Search category',
	'ACP_TYPES'					=> 'Article types',
	'ACP_TYPES_DESC'			=> 'Here you can add and edit article types',
	'ACP_CATEGORIE'				=> 'Category',
	'ACP_CATEGORIE_DESC'		=> 'Here you can add or edit categories for the Knowledge Base.',
	'ACP_CONFIG'				=> 'Configuration',
	'ACP_CONFIG_DESC'			=> 'Here you can edit the configuration of the Knowledge Base.',
	'ARTICLE_ACTIVATED'			=> 'The article has been released!',
	'ARTICLE_DELETED'			=> 'The article has been deleted!',
	'ARTICLE_ADDED'				=> 'The article has been submitted and will be released to the Knowledge Base after being reviewed.',
	'ARTICLE_HISTORY'			=> 'Article Log',
	'ARTICLE_ADD'				=> 'Add an article',
	'ARTICLE_TITLE'				=> 'Title',
	'ARTICLE_DESCRIPTION'		=> 'Description',
	'ARTICLE'					=> 'Article',
	'ARTICLE_TYPES'				=> 'Article types',
	'ARTICLE_TYPES_DESC'		=> 'In which article types you whant to search? Use the &lt;strg&gt; key to choose more that one type, to search in all types choose no type.',
	'ARTICLE_CONT'				=> 'Article in the database',
	'ARTICLE_DEL'				=> 'Should the article really be deleted?',
	'ARTICLE_EDIT'				=> 'Edit article',
	'ARTICLE_EDITED'			=> 'The article has been edited!',
	'ARTICLE_DEACTIVATED'		=> 'Locked article',
	'ARTICLE_POSTET'			=> 'Article posted',
	'AKTIVATE'					=> 'Activate',

	'BACK_ARTICLE'				=> 'Back to article',
	'BACK_KB'					=> 'Return back to the Knowledge Base',
	'BACK_TO_ARTICLE'			=> 'Click %shere%s to view the article.',
	'BACK_TO_POSTING'			=> 'Click %shere%s to go back.',
	'BACK_TO_KB'				=> 'Click %shere%s to go back to Knowledge Base.',
	'BACK_TO_LOG'				=> 'Click %shere%s to go back to article log.',

	'CATEGORIE'					=> 'Category',
	'CHANGED_AT'				=> 'Changed at',
	'CONT_CAT'					=> 'Categories',
	'CATEGORIES'				=> 'categories',
	'CATEGORIES_DESC'			=> 'In which categories you whant to search? Use the &lt;strg&gt; key to choose more that one category, to search in all categories choose no type.',
	'CAT_NOT_EMPTY'				=> 'The category is not empty!',
	'CAT_NAME'					=> 'Category name',
	'CAT_NAME_DESC'				=> 'Name for the category',
	'CAT_IMAGE'					=> 'Category image',
	'CAT_IMAGE_DESC'			=> 'Enter the URL to a image for the category here.',
	'CAT_DECRIPTION_DESC'		=> 'Give a description for the category',
	'CAT_MAIN'					=> 'Main category',
	'CAT_SELECT_MAIN'			=> 'Choose a main category',
	'CAT_ADDED'					=> 'The category was added',
	'CAT_DELETED'				=> 'The category has been deleted.',
	'CAT_UPDATED'				=> 'The category has been updated.',
	'CAT_REALY_DELETE'			=> 'Should the category really be deleted?',
	'CAT_CREATE_NEW'			=> 'New category',
	'DESCRIPTION'				=> 'Description',


	'FIENAME'				=> 'Filename',
	'FOUND_IN'				=> 'Found in',
	'INDEX_POSTS'			=> 'Articles within the index page',
	'INDEX_POSTS_DESC'		=> 'How many articles should be shown in the index page?',
	'KB_NAME'				=> 'Knowledge Base',
	'KB_NAME_DESC'			=> 'The name of the Knowledge Base',
	'KB_DECRIPTION_DESC'	=> 'Enter a description for the Knowledge Base.',
	'KBASE'					=> 'Knowledge Base',
	'KB_DESCRIPTION'		=> 'If you have written an article, you can preview it at the end of the page and submit it for review. If approved, the article will be published to the Knowledge Base. ',

	'LOG_TITEL'				=> 'Article log',
	'LOG_DESCRIPTION'		=> 'Here you can see the time the article was edited and from which user.',
	'LOG_DELETED'			=> 'The article log has been deleted.',

	'MAINCAT_DESC'			=> 'Here you can create main categories, in which you then create sub-categories for the articles.',
	'MODE'					=> 'Mode',
	'MODE_DESC'				=> 'Which mode do you want to use for the Index page?',
	'MODE_MODERN'			=> 'Modern',
	'MODE_CLASSIC'			=> 'Classic',
	'NO_ARTICLE'			=> 'The desired article does not exist!',
	'NEED_INPUT'			=> 'Enter a title and text for the article!',
	'ARTICLE_NEW'			=> 'Unreleased articles',
	'ARTICLE_NEW_DESC'		=> 'The following items are not yet released or have been locked',
	'NAME'					=> 'Category name',
	'NEED_NAME'				=> 'Give a name for the category',
	'ARTICLE_NEWEST'		=> 'The newest article is',
	'NO_TYPE'				=> 'No Type',
	'POST_FORUM'			=> 'Forum for reference to the article',
	'POST_TEMPLATE'			=> 'Post template',
	'POST_MESSAGE'			=> 'Post text',
	'POST_USER'				=> 'User ID',
	'POST_NORMAL'			=> 'Normal',
	'POST_TOPIC_GLOBAL'		=> 'Global Announcement',
	'POST_TOPIC_AS'			=> 'Post topic as',
	'POST_TOPIC_AS_DESC'	=> 'What kind of topic will be created?',
	'POST_USER_DESC'		=> 'The ID of the user that create the posts',
	'POST_SUBJECT'			=> 'Topics Title',
	'POST_SUBJECT_DESC'		=> 'The title of the topic that will be created',
	'POST_FORUM_DESC'		=> 'Give the forums ID of the forum to which a reference to the article is to be created, to no evidence of new articles to give a "0"',
	'POST_MESSAGE_DESC'		=> '{TITLE} = Article title <br />{DESCRIPTION} = Article description<br />{POST_TIME} = Time when writing<br />{TYPE} = Article type<br />{SUB_CAT} = Categorie<br />{URL} = URL to article<br />{AUTHOR} = Autor of article<br />{AUTHOR_ID} = User-ID of author.',
	'RELASED'				=> 'Released on',
	'READ_MORE'				=> 'Show all %s articles',


	'SEARCH_KEYWORDS_DESC'	=> 'Here you can search in the Knowledge Base.',
	'SHOW_EDITS'			=> 'Show edits',
	'SHOW_EDITS_DESC'		=> 'Should edits be shown in the article?',
	'TYPE'					=> 'Article type',
	'TYPE_DESC'				=> 'Give a name for the article type',
	'TYPE_ADDED'			=> 'The type was added',
	'TYPE_UPDATED'			=> 'The type was deleted',

	'NO_SUBCAT_IN_MAINCAT'	=> 'You can not create sub-categories in the index!',
	'CAT_TYPE'				=> 'Category type',
	'CAT_TYPE_DESC'			=> 'Choose a category type',
	'IN_INDEX'				=> 'In Index',
	'CAT_SUB'				=> 'Sub category',

	'CACHE_TIME'			=> 'Cache time',
	'CACHE_TIME_DESC'		=> 'Time for what types and categories will be cached',
	'SECONDS'				=> 'Seconds',
	'ACTIVATE_TYPES'		=> 'Use article types?',
	'ACTIVATE_TYPES_DESC'	=> 'Can you give a type for an article?',
	'UPDATE_POST'			=> 'Refresh post',
	'UPDATE_POST_DESC'		=> 'Should the post for the article be updated when artcle has been updated?',
	'POST_UPDATE_MESSAGE'	=> 'Article updated',
	'POST_ID'				=> 'ID of forums post',
	'ARTICLE_ADDED_AKTIV'	=> 'The article was subited to database and activated',
	'SHOW_POST_EDIT'		=> 'Show updates',
	'SHOW_POST_EDIT_DESC'	=> 'Should a update be shown in the post?',

	'PRINT_TOPIC'			=> 'Print article',
	'SEARCH_CATEGORIE'		=> 'Search in category...',

	'ADS'					=> 'Advertising',
	'KB_COPYRIGHT'			=> 'Knowledge Base by Tobi Schaefer',
	'ADS_DESC'				=> 'Here you can insert code for your Advertising.',
	'URI_IN_USE'			=> 'The URL is already in use',
	'USER_CHANGED'			=> 'The user has been changed',

));


