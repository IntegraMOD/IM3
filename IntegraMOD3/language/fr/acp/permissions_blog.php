<?php
/**
* @package language(permissions)
* @version $Id: permissions_blog.php 485 2008-08-15 23:33:57Z exreaction@gmail.com $
* @copyright (c) 2008 EXreaction, Lithium Studios
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

// Create the lang array if it does not already exist
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// Create a new category named Blog
$lang['permission_cat']['blog'] = 'Blog';

// User Permissions
$lang = array_merge($lang, array(
	'acl_u_blogview'			=> array('lang' => 'Peut voir les entrées du blog', 'cat' => 'blog'),
	'acl_u_blogpost'			=> array('lang' => 'Peut publier des entrées de blog', 'cat' => 'blog'),
	'acl_u_blogedit'			=> array('lang' => 'Peut modifier ses propres entrées de blog', 'cat' => 'blog'),
	'acl_u_blogdelete'			=> array('lang' => 'Peut supprimer ses propres entrées de blog', 'cat' => 'blog'),
	'acl_u_blognoapprove'		=> array('lang' => 'Les entrées de blog ne nécessitent pas d’approbation avant affichage public', 'cat' => 'blog'),
	'acl_u_blogreport'			=> array('lang' => 'Peut signaler des entrées de blog et des réponses', 'cat' => 'blog'),
	'acl_u_blogreply'			=> array('lang' => 'Peut commenter les entrées de blog', 'cat' => 'blog'),
	'acl_u_blogreplyedit'		=> array('lang' => 'Peut modifier ses propres commentaires', 'cat' => 'blog'),
	'acl_u_blogreplydelete'		=> array('lang' => 'Peut supprimer ses propres commentaires', 'cat' => 'blog'),
	'acl_u_blogreplynoapprove'	=> array('lang' => 'Les commentaires ne nécessitent pas d’approbation avant affichage public', 'cat' => 'blog'),
	'acl_u_blogbbcode'			=> array('lang' => 'Peut utiliser le BBCode dans les entrées de blog et les commentaires', 'cat' => 'blog'),
	'acl_u_blogsmilies'			=> array('lang' => 'Peut utiliser des smileys dans les entrées de blog et les commentaires', 'cat' => 'blog'),
	'acl_u_blogimg'				=> array('lang' => 'Peut publier des images dans les entrées de blog et les commentaires', 'cat' => 'blog'),
	'acl_u_blogurl'				=> array('lang' => 'Peut publier des URLs dans les entrées de blog et les commentaires', 'cat' => 'blog'),
	'acl_u_blogflash'			=> array('lang' => 'Peut publier du contenu Flash dans les entrées de blog et les commentaires', 'cat' => 'blog'),
	'acl_u_blogmoderate'		=> array('lang' => 'Peut modérer (modifier et supprimer) les commentaires dans son propre blog.', 'cat' => 'blog'),
	'acl_u_blogattach'			=> array('lang' => 'Peut publier des pièces jointes dans les entrées de blog et les commentaires', 'cat' => 'blog'),
	'acl_u_blognolimitattach'	=> array('lang' => 'Peut ignorer les limites de taille et de nombre des pièces jointes', 'cat' => 'blog'),

	'acl_u_blog_create_poll'	=> array('lang' => 'Peut créer des sondages', 'cat' => 'blog'),
	'acl_u_blog_vote'			=> array('lang' => 'Peut voter dans les sondages', 'cat' => 'blog'),
	'acl_u_blog_vote_change'	=> array('lang' => 'Peut modifier un vote existant', 'cat' => 'blog'),
	'acl_u_blog_style'			=> array('lang' => 'Peut sélectionner un style pour son propre blog', 'cat' => 'blog'),
	'acl_u_blog_css'			=> array('lang' => 'Peut saisir son propre code CSS pour personnaliser le style de son blog.', 'cat' => 'blog'),
));

// Moderator Permissions
$lang = array_merge($lang, array(
	'acl_m_blogapprove'			=> array('lang' => 'Peut voir les entrées de blog non approuvées et les approuver pour affichage public', 'cat' => 'blog'),
	'acl_m_blogedit'			=> array('lang' => 'Peut modifier les entrées de blog', 'cat' => 'blog'),
	'acl_m_bloglockedit'		=> array('lang' => 'Peut verrouiller la modification des entrées de blog', 'cat' => 'blog'),
	'acl_m_blogdelete'			=> array('lang' => 'Peut supprimer et restaurer des entrées de blog', 'cat' => 'blog'),
	'acl_m_blogreport'			=> array('lang' => 'Peut fermer et supprimer les signalements d’entrées de blog.', 'cat' => 'blog'),
	'acl_m_blogreplyapprove'	=> array('lang' => 'Peut voir les commentaires non approuvés et les approuver pour affichage public', 'cat' => 'blog'),
	'acl_m_blogreplyedit'		=> array('lang' => 'Peut modifier les commentaires', 'cat' => 'blog'),
	'acl_m_blogreplylockedit'	=> array('lang' => 'Peut verrouiller la modification des commentaires', 'cat' => 'blog'),
	'acl_m_blogreplydelete'		=> array('lang' => 'Peut supprimer et restaurer des commentaires', 'cat' => 'blog'),
	'acl_m_blogreplyreport'		=> array('lang' => 'Peut fermer et supprimer les signalements de commentaires.', 'cat' => 'blog'),
));

// Administrator Permissions
$lang = array_merge($lang, array(
	'acl_a_blogmanage'			=> array('lang' => 'Peut modifier les paramètres du blog', 'cat' => 'blog'),
	'acl_a_blogdelete'			=> array('lang' => 'Peut supprimer définitivement des entrées de blog', 'cat' => 'blog'),
	'acl_a_blogreplydelete'		=> array('lang' => 'Peut supprimer définitivement les commentaires des entrées de blog', 'cat' => 'blog'),
));
 