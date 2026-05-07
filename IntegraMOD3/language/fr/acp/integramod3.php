<?php
/** 
*
* integramod3 [English]
*
* @package phpbb_seo
* @version $Id: integramod.php, 05/05/2008 13:48:48 fds Exp $
* @copyright (c) 2007 IntegraTeam
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

$lang = array_merge($lang, array(

	'IM3'                       => 'IntegraMOD3',
 	'IMTEAM'                    => 'IntegraTeam',
	'INTEGRAMOD3_TITLE'	        => 'Aperçu d’IntegraMOD3',
	'INTEGRAMOD3_SUPPORT_BODY'	=> 'Un support complet est fourni sur le <a href="http://www.integramod.com/forum/index.php?c=6" title="Site de développement IntegraMOD3" target="_new"><b>forum de développement IntegraMOD3</b></a>. Nous répondrons aux questions générales d’installation, aux problèmes de configuration et vous aiderons à identifier les problèmes courants.</p><p>Assurez-vous de visiter nos <a href="http://www.integramod.com" title="IntegraMOD" target="_new"><b>forums IntegraMOD</b></a>.</p><p>Vous devriez <a href="http://www.integramod.com/forum/profile.php?mode=profil&sub=profile_prefer&mod=0" title="S’inscrire sur IntegraMOD" target="_new"><b>vous inscrire</b></a>, vous connecter et vous abonner au sujet <a href="http://www.integramod.com/forum/im3-news-f67.html" target="_new"><b>IM3 News </b></a> afin d’être informé par e-mail ou MP de chaque mise à jour.',
	'INTEGRAMOD3_BODY'	        => 'Bienvenue dans la version Alpha d’IntegraMOD3.</p><p>Veuillez lire <a href="http://www." title="Voir le sujet de publication" target="_new"><b>le sujet de développement IM3</b></a> pour plus d’informations</p><p><strong style="text-transform: uppercase;">Remarque :</strong> IM3 inclut trois versions de réécriture d’URL SEO pour phpBB3. Vous pourrez choisir l’une d’elles.<br/><br/><b>Les trois standards de réécriture d’URL disponibles :</b><ul><li><a href="http://www.phpbb-seo.com/boards/simple-seo-url/simple-phpbb3-seo-url-vt1566.html" title="Plus de détails sur le module Simple"><b>Le module Simple</b></a>,</li><li><a href="http://www.phpbb-seo.com/boards/mixed-seo-url/mixed-phpbb3-seo-url-vt1565.html" title="Plus de détails sur le module Mixed"><b>Le module Mixed</b></a>,</li><li><a href="http://www.phpbb-seo.com/boards/advanced-seo-url/advanced-phpbb3-seo-url-vt1219.html" title="Plus de détails sur le module Advanced"><b>Advanced</b></a>.</li></ul>Ce choix est très important, nous vous encourageons à prendre le temps de bien découvrir les fonctionnalités SEO de ce pré-mod avant de le mettre en ligne.<br/>Ce pré-mod est aussi simple à installer que phpBB3, il suffit de suivre le processus habituel.<br/><br/>
	          <p>Prérequis pour la réécriture d’URL :</p>
	            <ul>
		          <li>Serveur Apache (OS Linux) avec le module mod_rewrite.</li>
		          <li>Serveur IIS (OS Windows) avec le module isapi_rewrite, mais vous devrez adapter les règles de réécriture dans le fichier httpd.ini</li>
	            </ul>
	          <p>Une fois installé, vous devrez aller dans l’ACP pour configurer et activer le mod.</p>
	          <p>Pour une liste complète des mods inclus dans IntegraMOD3, consultez le sujet <a href="http://www.integramod.com/IntegraMOD/" title="Mods inclus dans IntegraMOD3" target="_new"><b>Développement IntegraMOD3</b></a>.</p>',
));
