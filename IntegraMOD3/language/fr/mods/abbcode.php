<?php
/**
*
* abbcode [English]
*
* @package Advanced BBCode Box 3
* @version $Id$
* @copyright (c) 2010 leviatan21 (Gabriel Vazquez) and VSE (Matt Friedman)
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
// You do not need this where single placeholders are used, e.g. "Message %d" is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., "Click %sHERE%s" is fine
// Reference : http://www.phpbb.com/mods/documentation/phpbb-documentation/language/index.php#lang-use-php
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
// Help page
	'ABBC3_HELP_TITLE'			=> 'Advanced BBCode Box 3 :: Page d\'aide',
	'ABBC3_HELP_DESC'			=> 'Description',
	'ABBC3_HELP_WRITE'			=> 'Format d\'utilisation des BBCodes',
	'ABBC3_HELP_VIEW'			=> 'Résultat',
	'ABBC3_HELP_ABOUT'			=> 'Advanced BBCode Box 3 par <a href="http://www.phpbb.com/customise/db/mod/advanced_bbcode_box_3/" onclick="window.open(this.href);return false;">mssti</a>',
//	'ABBC3_HELP_ALT'			=> 'Advanced BBCode Box 3 (aka ABBC3)',

// Image Resizer JS
	'ABBC3_RESIZE_SMALL'		=> 'Cliquer pour voir l\'image en taille réelle.',
	'ABBC3_RESIZE_ZOOM_IN'		=> 'Agrandir (dimensions réelles : %1$s x %2$s)',
	'ABBC3_RESIZE_CLOSE'		=> 'Fermer',
	'ABBC3_RESIZE_ZOOM_OUT'		=> 'Rétablir taille',
	'ABBC3_RESIZE_FILESIZE'		=> 'Cette image a été redimensionnée. L\'image originale fait %1$s x %2$s et pèse %3$sKB.',
	'ABBC3_RESIZE_NOFILESIZE'	=> 'Cette image a été redimensionnée. L\'image originale fait %1$s x %2$s.',
	'ABBC3_RESIZE_FULLSIZE'		=> 'Image redimensionnée à %1$s% de sa taille originale [%2$s x %3$s]',
	'ABBC3_RESIZE_NUMBER'		=> 'Image %1$s sur %2$s',
	'ABBC3_RESIZE_PLAY'			=> 'Lire le diaporama',
	'ABBC3_RESIZE_PAUSE'		=> 'Pause du diaporama',
	'ABBC3_RESIZE_IMAGE'		=> 'Image',
	'ABBC3_RESIZE_OF'			=> 'sur',

// Highslide JS - http://vikjavev.no/highslide/forum/viewtopic.php?t=2119
	'ABBC3_HIGHSLIDE_LOADINGTEXT'		=> 'Chargement...',
	'ABBC3_HIGHSLIDE_LOADINGTITLE'		=> 'Cliquer pour annuler',
	'ABBC3_HIGHSLIDE_FOCUSTITLE'		=> 'Cliquer pour mettre au premier plan',
	'ABBC3_HIGHSLIDE_FULLEXPANDTITLE'	=> 'Agrandir à la taille réelle',
	'ABBC3_HIGHSLIDE_FULLEXPANDTEXT'	=> 'Taille réelle',
	'ABBC3_HIGHSLIDE_CREDITSTEXT'		=> 'Propulsé par <i>Highslide JS</i>',
	'ABBC3_HIGHSLIDE_CREDITSTITLE'		=> 'Aller à la page d\'accueil de Highslide JS',
	'ABBC3_HIGHSLIDE_PREVIOUSTEXT'		=> 'Précédent',
	'ABBC3_HIGHSLIDE_PREVIOUSTITLE'		=> 'Précédent (flèche gauche)',
	'ABBC3_HIGHSLIDE_NEXTTEXT'			=> 'Suivant',
	'ABBC3_HIGHSLIDE_NEXTTITLE'			=> 'Suivant (flèche droite)',
	'ABBC3_HIGHSLIDE_MOVETITLE'			=> 'Déplacer',
	'ABBC3_HIGHSLIDE_MOVETEXT'			=> 'Déplacer',
	'ABBC3_HIGHSLIDE_CLOSETEXT'			=> 'Fermer',
	'ABBC3_HIGHSLIDE_CLOSETITLE'		=> 'Fermer (echap)',
	'ABBC3_HIGHSLIDE_RESIZETITLE'		=> 'Redimensionner',
	'ABBC3_HIGHSLIDE_PLAYTEXT'			=> 'Lire',
	'ABBC3_HIGHSLIDE_PLAYTITLE'			=> 'Lire le diaporama (barre d\'espace)',
	'ABBC3_HIGHSLIDE_PAUSETEXT'			=> 'Pause',
	'ABBC3_HIGHSLIDE_PAUSETITLE'		=> 'Mettre en pause le diaporama (barre d\'espace)',
	'ABBC3_HIGHSLIDE_NUMBER'			=> 'Image %1 de %2',
	'ABBC3_HIGHSLIDE_RESTORETITLE'		=> 'Cliquer pour fermer l\'image. Cliquer et glisser pour déplacer. Utiliser les flèches pour suivant et précédent.',

// Text to be applied to the helpline & mouseover & help page & Wizard texts
	'BBCODE_STYLES_TIP'			=> 'Astuce : les styles peuvent être appliqués rapidement au texte sélectionné.',

	'ABBC3_ERROR'				=> 'Erreur : ',
	'ABBC3_ERROR_TAG'			=> 'Erreur inattendue lors de l\'utilisation du tag : ',
	'ABBC3_NO_EXAMPLE'			=> 'Aucun exemple de données',

	'ABBC3_ID'					=> 'Entrez l\'identifiant :',
	'ABBC3_NOID'				=> 'Vous n\'avez pas saisi l\'identifiant',
	'ABBC3_LINK'				=> 'Entrez un lien pour ',
	'ABBC3_DESC'				=> 'Entrez une description pour ',
	'ABBC3_NAME'				=> 'Description',
	'ABBC3_NOLINK'				=> 'Vous n\'avez pas saisi de lien pour ',
	'ABBC3_NODESC'				=> 'Vous n\'avez pas saisi de description pour ',
	'ABBC3_WIDTH'				=> 'Entrez la largeur',
	'ABBC3_WIDTH_NOTE'			=> 'Remarque : la valeur peut être exprimée en pourcentage',
	'ABBC3_NOWIDTH'				=> 'Vous n\'avez pas saisi la largeur',
	'ABBC3_HEIGHT'				=> 'Entrez la hauteur',
	'ABBC3_HEIGHT_NOTE'			=> 'Remarque : la valeur peut être exprimée en pourcentage',
	'ABBC3_NOHEIGHT'			=> 'Vous n\'avez pas saisi la hauteur',

	'ABBC3_NOTE'				=> 'Remarque',
	'ABBC3_EXAMPLE'				=> 'Exemple',
	'ABBC3_EXAMPLES'			=> 'Exemples',
	'ABBC3_SHORT'				=> 'Sélectionner un BBCode',
	'ABBC3_DEPRECATED'			=> '<div class="error">Le BBCode <em>%1$s</em> est obsolète depuis la version <em>%2$s</em> d\'ABBC3</div>',
	'ABBC3_UNAUTHORISED'		=> 'Vous ne pouvez pas utiliser certains mots : <br /><strong> %s </strong>',
	'ABBC3_NOSCRIPT'			=> 'Votre navigateur a désactivé les scripts ou ne supporte pas l\'exécution côté client. <em>( JavaScript! )</em>',
	'ABBC3_NOSCRIPT_EXPLAIN'	=> 'La page que vous consultez requiert l\'utilisation de JavaScript pour de meilleures performances.<br />Si vous avez intentionnellement désactivé JavaScript, veuillez l\'activer.',
	'ABBC3_FUNCTION_DISABLED'	=> 'Cette fonction n\'est pas disponible sur ce forum.',
	'ABBC3_AJAX_DISABLED'		=> 'Votre navigateur ne supporte pas AJAX (XMLHttpRequest) et n\'a pas pu traiter cette requête.',
	'ABBC3_SUBMIT'				=> 'Insérer dans le message',
	'ABBC3_SUBMIT_SIG'			=> 'Insérer dans la signature',
	'SAMPLE_TEXT'				=> 'Le vif renard brun saute par-dessus le chien paresseux',
	'DEPRECATED_BBCODE'			=> '<strong class="error">Remarque :</strong> ce BBCode est obsolète et a été remplacé par BBvideo.',
));

/**
* TRANSLATORS PLEASE NOTE 
*	Several lines have an special note like "##	For translator: " followed by "yes" and "no"
*	These are lines with mixed code and language. For these lines you can translate anything 
*	under a "yes" but do not change any text under a "no"
**/
$lang = array_merge($lang, array(
// bbcodes texts
	// Font Type Dropdown
	'ABBC3_FONT_MOVER'			=> 'Type de police',
	'ABBC3_FONT_TIP'			=> '[font=Comic Sans MS]texte[/font]',
	'ABBC3_FONT_NOTE'			=> 'Remarque : vous pouvez définir des familles de polices supplémentaires',
	'ABBC3_FONT_VIEW'			=> '[font=Comic Sans MS]' . $lang['SAMPLE_TEXT'] . '[/font]',

	// Font family Groups
	'ABBC3_FONT_ABBC3'			=> 'ABBC Box 3',
	'ABBC3_FONT_SAFE'			=> 'Liste sûre',
	'ABBC3_FONT_WIN'			=> 'Défaut Windows',

	// Font Size Dropdown
	'ABBC3_FONT_GIANT'			=> 'Géante',
	'ABBC3_SIZE_MOVER'			=> 'Taille de police',
	'ABBC3_SIZE_TIP'			=> '[size=150]texte large[/size]',
	'ABBC3_SIZE_NOTE'			=> 'Remarque : la valeur sera interprétée comme un pourcentage',
	'ABBC3_SIZE_VIEW'			=> '[size=150]' . $lang['SAMPLE_TEXT'] . '[/size]',

	// Highlight Font Color Dropdown
	'ABBC3_HIGHLIGHT_MOVER'		=> 'Surligner le texte',
	'ABBC3_HIGHLIGHT_TIP'		=> '[highlight=yellow]texte[/highlight]',
	'ABBC3_HIGHLIGHT_NOTE'		=> 'Astuce : vous pouvez aussi utiliser highlight=#FFFF00',
	'ABBC3_HIGHLIGHT_VIEW'		=> '[highlight=yellow]' . $lang['SAMPLE_TEXT'] . '[/highlight]',

	// Font Color Dropdown
	'ABBC3_COLOR_MOVER'			=> 'Couleur de la police',
	'ABBC3_COLOR_TIP'			=> '[color=red]texte[/color]',
	'ABBC3_COLOR_NOTE'			=> 'Astuce : vous pouvez aussi utiliser color=#FF0000',
	'ABBC3_COLOR_VIEW'			=> '[color=red]' . $lang['SAMPLE_TEXT'] . '[/color]',

	// Tigra Color & Highlight family Groups
	'ABBC3_COLOUR_TIGRA'		=> 'Sélecteur de couleur Tigra',
	'ABBC3_COLOUR_SAFE'			=> 'Palette Web Safe',
	'ABBC3_COLOUR_WIN'			=> 'Palette système Windows',
	'ABBC3_COLOUR_GREY'			=> 'Palette de tons gris',
	'ABBC3_COLOUR_MAC'			=> 'Palette Mac OS',
	'ABBC3_SAMPLE'				=> 'exemple',

	// Cut selected text
	'ABBC3_CUT_MOVER'			=> 'Supprimer le texte sélectionné',
	// Copy selected text
	'ABBC3_COPY_MOVER'			=> 'Copier le texte sélectionné',
	// Paste previously copy text
	'ABBC3_PASTE_MOVER'			=> 'Coller le texte copié',
	'ABBC3_PASTE_ERROR'			=> 'Vous devez d\'abord copier une sélection de texte, puis la coller',
	// Remove BBCode (Removes all BBCode tags from selected text)
	'ABBC3_PLAIN_MOVER'			=> 'Retirer tous les BBCodes du texte sélectionné',
	'ABBC3_NOSELECT_ERROR'		=> 'Aucun texte n\'a été sélectionné.',

	// Code
	'ABBC3_CODE_MOVER'			=> 'Affichage du code',
	'ABBC3_CODE_TIP'			=> '[code]code[/code]',
	'ABBC3_CODE_VIEW'			=> '[code]' . $lang['SAMPLE_TEXT'] . '[/code] or [code=php]' . $lang['SAMPLE_TEXT'] . '[/code]',

	// Quote
	'ABBC3_QUOTE_MOVER'			=> 'Citer le texte',
	'ABBC3_QUOTE_TIP'			=> '[quote]texte[/quote] or [quote=“membre”]texte[/quote]',
##	For translator:                                                            yes              yes
	'ABBC3_QUOTE_VIEW'			=> '[quote]' . $lang['SAMPLE_TEXT'] . '[/quote] ou [quote=&quot;membre&quot;]' . $lang['SAMPLE_TEXT'] . '[/quote]',

	// Spoiler
	'ABBC3_SPOIL_MOVER'			=> 'Texte spoiler',
	'ABBC3_SPOIL_TIP'			=> '[spoil]texte[/spoil]',
	'ABBC3_SPOIL_VIEW'			=> '[spoil]' . $lang['SAMPLE_TEXT'] . '[/spoil]',
	'SPOILER_SHOW'				=> 'Afficher le spoiler',
	'SPOILER_HIDE'				=> 'Masquer le spoiler',

	// Hidden
	'ABBC3_HIDDEN_MOVER'		=> 'Cacher le contenu aux invités non enregistrés',
	'ABBC3_HIDDEN_TIP'			=> '[hidden]texte[/hidden]',
	'ABBC3_HIDDEN_VIEW'			=> '[hidden]' . $lang['SAMPLE_TEXT'] . '[/hidden]',
	'HIDDEN_OFF'				=> 'Contenu caché (pour les membres seulement)',
	'HIDDEN_ON'					=> 'Contenu caché',
	'HIDDEN_EXPLAIN'			=> 'Ce forum requiert que vous soyez enregistré et connecté pour voir le contenu caché.',

	// Moderator
	'ABBC3_MOD_MOVER'			=> 'Message du modérateur',
	'ABBC3_MOD_TIP'				=> '[mod=“name”]texte[/mod]',
##	For translator:                      yes
	'ABBC3_MOD_VIEW'			=> '[mod=&quot;Nom_du_modérateur&quot;]' . $lang['SAMPLE_TEXT'] . '[/mod]',

	// Off Topic
	'OFFTOPIC'					=> 'Hors sujet',
	'ABBC3_OFFTOPIC_MOVER'		=> 'Insérer du texte hors sujet',
	'ABBC3_OFFTOPIC_TIP'		=> '[offtopic]texte[/offtopic]',
	'ABBC3_OFFTOPIC_VIEW'		=> '[offtopic]' . $lang['SAMPLE_TEXT'] . '[/offtopic]',

	// SCRIPPET
	'ABBC3_SCRIPPET_MOVER'		=> 'Scénario',
	'ABBC3_SCRIPPET_TIP'		=> '[scrippet]Texte de scénario[/scrippet]',
##	For translator:                 don't change the "<br />" and don't join the lines into one!
	'ABBC3_SCRIPPET_VIEW'		=> '[scrippet]EXT. ROME ANTIQUE - JOUR<br />' . "\n" . 'ANTONIUS et IPSUM marchent dans une rue étroite et bondée.<br />' . "\n" . 'ANTONIUS<br />' . "\n" . 'Penses-tu que dans mille ans, quelqu\'un se souviendra de nos noms ?<br />' . "\n" . 'IPSUM<br />' . "\n" . 'Pas du tien. Mais on se souviendra du mien. Car j\'ai l\'intention d\'écrire quelque chose d\'si profond qu\'il sera retenu à travers les âges. Les designers du XXe siècle utilisent Lorem Ipsum chaque fois qu\'ils ont besoin de remplir des blocs de texte.[/scrippet]',

	// Tabs
	'ABBC3_TABS_MOVER'			=> 'Onglets',
	'ABBC3_TABS_TIP'			=> '[tabs] [tabs:Title]this tab text[tabs:Another]this tab text[/tabs]',
##	For translator:                              yes             yes                                                                                                                              yes               Yes
	'ABBC3_TABS_VIEW'			=> '[tabs] [tabs:Titre de l\'onglet]&nbsp;Tout le contenu sous cette balise sera affiché dans cet onglet, jusqu\'à ce qu\'un autre onglet soit déclaré avec : &#91;tabs:XXX&#93;.[tabs:Un autre onglet]&nbsp;Et ainsi de suite...jusqu\'à la fin de la page ou optionnellement vous pouvez utiliser &#91;/tabs&#93; pour terminer le dernier onglet et afficher du texte normal en dehors des onglets.[/tabs]',

	// NFO
	'ABBC3_NFO_TITLE'			=> 'Texte NFO',
	'ABBC3_NFO_MOVER'			=> 'Texte NFO',
	'ABBC3_NFO_TIP'				=> '[nfo]Texte NFO[/nfo]',
	'ABBC3_NFO_VIEW'			=> '[nfo]         /\_/\
    ____/ o o \
  /~____  =ø= /
 (______)__m_m)
[/nfo]',

	// Justify Align
	'ABBC3_ALIGNJUSTIFY_MOVER'	=> 'Justifier le texte',
	'ABBC3_ALIGNJUSTIFY_TIP'	=> '[align=justify]texte[/align]',
	'ABBC3_ALIGNJUSTIFY_VIEW'	=> '[align=justify]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Right Align
	'ABBC3_ALIGNRIGHT_MOVER'	=> 'Aligner à droite',
	'ABBC3_ALIGNRIGHT_TIP'		=> '[align=right]texte[/align]',
	'ABBC3_ALIGNRIGHT_VIEW'		=> '[align=right]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Center Align
	'ABBC3_ALIGNCENTER_MOVER'	=> 'Centrer le texte',
	'ABBC3_ALIGNCENTER_TIP'		=> '[align=center]texte[/align]',
	'ABBC3_ALIGNCENTER_VIEW'	=> '[align=center]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Left Align
	'ABBC3_ALIGNLEFT_MOVER'		=> 'Aligner à gauche',
	'ABBC3_ALIGNLEFT_TIP'		=> '[align=left]texte[/align]',
	'ABBC3_ALIGNLEFT_VIEW'		=> '[align=left]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Preformat
	'ABBC3_PRE_MOVER'			=> 'Texte préformaté',
	'ABBC3_PRE_TIP'				=> '[pre]texte[/pre]',
	'ABBC3_PRE_VIEW'			=> '[pre]' . $lang['SAMPLE_TEXT'] . '<br />		' . $lang['SAMPLE_TEXT'] . '[/pre]',

	// Tab
	'ABBC3_TAB_MOVER'			=> 'Indentation du texte',
	'ABBC3_TAB_TIP'				=> '[tab=nn]',
	'ABBC3_TAB_NOTE'			=> 'Entrez un nombre qui sera la marge mesurée en pixels.',
	'ABBC3_TAB_VIEW'			=> '[tab=30]' . $lang['SAMPLE_TEXT'],

	// Superscript
	'ABBC3_SUP_MOVER'			=> 'Texte en exposant',
	'ABBC3_SUP_TIP'				=> '[sup]texte[/sup]',
##	For translator:                 yes                                                         yes
	'ABBC3_SUP_VIEW'			=> 'Ceci est du texte normal [sup]' . $lang['SAMPLE_TEXT'] . '[/sup] ceci est du texte normal',

	// Subscript
	'ABBC3_SUB_MOVER'			=> 'Texte en indice',
	'ABBC3_SUB_TIP'				=> '[sub]texte[/sub]',
##	For translator:                 yes                                                         yes
	'ABBC3_SUB_VIEW'			=> 'Ceci est du texte normal [sub]' . $lang['SAMPLE_TEXT'] . '[/sub] ceci est du texte normal',

	// Bold
	'ABBC3_B_MOVER'				=> 'Texte en gras',
	'ABBC3_B_TIP'				=> '[b]texte[/b]',
	'ABBC3_B_VIEW'				=> '[b]' . $lang['SAMPLE_TEXT'] . '[/b]',

	// Italic
	'ABBC3_I_MOVER'				=> 'Texte en italique',
	'ABBC3_I_TIP'				=> '[i]texte[/i]',
	'ABBC3_I_VIEW'				=> '[i]' . $lang['SAMPLE_TEXT'] . '[/i]',

	// Underline
	'ABBC3_U_MOVER'				=> 'Texte souligné',
	'ABBC3_U_TIP'				=> '[u]texte[/u]',
	'ABBC3_U_VIEW'				=> '[u]' . $lang['SAMPLE_TEXT'] . '[/u]',

	// Strikethrough
	'ABBC3_S_MOVER'				=> 'Texte barré',
	'ABBC3_S_TIP'				=> '[s]texte[/s]',
	'ABBC3_S_VIEW'				=> '[s]' . $lang['SAMPLE_TEXT'] . '[/s]',

	// Text Fade
	'ABBC3_FADE_MOVER'			=> 'Texte fondu (in/out)',
	'ABBC3_FADE_TIP'			=> '[fade]texte[/fade]',
	'ABBC3_FADE_VIEW'			=> '[fade]' . $lang['SAMPLE_TEXT'] . '[/fade]',

	// Text Gradient
	'ABBC3_GRAD_MOVER'			=> 'Texte dégradé',
	'ABBC3_GRAD_TIP'			=> 'Sélectionnez d\'abord du texte',
	'ABBC3_GRAD_VIEW'			=> '[color=#40FF00]I[/color] [color=#B6FF00]a[/color][color=#F0FF00]m[/color] [color=#DD9845]a[/color] [color=#BF4A94]r[/color][color=#BF5EBB]a[/color][color=#BF71E2]i[/color][color=#B57BFF]n[/color][color=#8E67FF]b[/color][color=#6754FF]o[/color][color=#4040FF]w[/color]',
	'ABBC3_GRAD_MIN_ERROR'		=> 'Aucun texte n\'a été sélectionné.',
	'ABBC3_GRAD_MAX_ERROR'		=> 'Seules les sélections de texte de moins de 120 caractères sont autorisées.',
	'ABBC3_GRAD_COLORS'			=> 'Couleurs pré-sélectionnées',
	'ABBC3_GRAD_ERROR'			=> 'Erreur : l\'initialisation de ColorCode a échoué',

	// Glow text
	'ABBC3_GLOW_MOVER'			=> 'Texte lumineux',
	'ABBC3_GLOW_TIP'			=> '[glow=color]texte[/glow]',
	'ABBC3_GLOW_VIEW'			=> '[glow=red]' . $lang['SAMPLE_TEXT'] . '[/glow]',

	// Shadow text
	'ABBC3_SHADOW_MOVER'		=> 'Texte en ombre',
	'ABBC3_SHADOW_TIP'			=> '[shadow=color]texte[/shadow]',
	'ABBC3_SHADOW_VIEW'			=> '[shadow=blue]' . $lang['SAMPLE_TEXT'] . '[/shadow]',

	// Dropshadow text
	'ABBC3_DROPSHADOW_MOVER'	=> 'Texte en dropshadow',
	'ABBC3_DROPSHADOW_TIP'		=> '[dropshadow=color]texte[/dropshadow]',
	'ABBC3_DROPSHADOW_VIEW'		=> '[dropshadow=blue]' . $lang['SAMPLE_TEXT'] . '[/dropshadow]',

	// Blur text
	'ABBC3_BLUR_MOVER'			=> 'Texte flou',
	'ABBC3_BLUR_TIP'			=> '[blur=color]texte[/blur]',
	'ABBC3_BLUR_VIEW'			=> '[blur=blue]' . $lang['SAMPLE_TEXT'] . '[/blur]',

	// Wave text
	'ABBC3_WAVE_MOVER'			=> 'Texte en vague (Seulement pour Internet Explorer)',
	'ABBC3_WAVE_TIP'			=> '[wave=color]texte[/wave]',
	'ABBC3_WAVE_VIEW'			=> '[wave=blue]' . $lang['SAMPLE_TEXT'] . '[/wave]',

	// Unordered List
	'ABBC3_LISTB_MOVER'			=> 'Liste',
	'ABBC3_LISTB_TIP'			=> '[list]texte[/list]',
	'ABBC3_LISTB_NOTE'			=> 'Remarque : utilisez [*] pour chaque élément de la liste',
##	For translator:                          yes      yes      yes           yes         yes            yes                yes
	'ABBC3_LISTB_VIEW'			=> '[list][*]Élément 1[*]Élément 2[*]Élément 3[/list] ou [list][*]Élément 1[list][*]sous-élément 1[list][*]sous-sous-élément1[/list][/list][/list]',

	// Ordered List
	'ABBC3_LISTO_MOVER'			=> 'Liste ordonnée',
	'ABBC3_LISTO_TIP'			=> '[list=1|a|A|i|I]texte[/list]',
	'ABBC3_LISTO_NOTE'			=> 'Remarque : utilisez [*] pour chaque élément de la liste',
##	For translator:                            yes      yes     yes          yes           yes      yes      yes           yes           yes      yes      yes           yes           yes      yes       yes             yes           yes      yes       yes
	'ABBC3_LISTO_VIEW'			=> '[list=1][*]Élément 1[*]Élément2[*]Élément3[/list] ou [list=a][*]Élément a[*]Élément b[*]Élément c[/list] ou [list=A][*]Élément A[*]Élément B[*]Élément C[/list] ou [list=i][*]Élément i[*]Élément ii[*]Élément iii[/list] ou [list=I][*]Élément I[*]Élément II[*]Élément III[/list]',

	// List item
	'ABBC3_LISTITEM_MOVER'		=> 'Élément de liste',
	'ABBC3_LISTITEM_TIP'		=> '[*]texte',
	//'ABBC3_LISTITEM_NOTE'		=> 'Note: Creates bulleted or numbered items inside list',

	// Line Break
	'ABBC3_HR_MOVER'			=> 'Ligne horizontale',
	'ABBC3_HR_TIP'				=> '[hr]',
	'ABBC3_HR_NOTE'				=> 'Remarque : crée une ligne horizontale pour séparer le texte',
	'ABBC3_HR_VIEW'				=> $lang['SAMPLE_TEXT'] . '[hr]' . $lang['SAMPLE_TEXT'],

	// Message Box text direction right to Left
	'ABBC3_DIRRTL_MOVER'		=> 'Direction du texte : droite à gauche',
	'ABBC3_DIRRTL_TIP'			=> '[dir=rtl]texte[/dir]',
	'ABBC3_DIRRTL_VIEW'			=> '[dir=rtl]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Message Box text direction Left to right
	'ABBC3_DIRLTR_MOVER'		=> 'Direction du texte : gauche à droite',
	'ABBC3_DIRLTR_TIP'			=> '[dir=ltr]texte[/dir]',
	'ABBC3_DIRLTR_VIEW'			=> '[dir=ltr]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Marquee Down
	'ABBC3_MARQDOWN_MOVER'		=> 'Faire défiler le texte vers le bas',
	'ABBC3_MARQDOWN_TIP'		=> '[marq=down]texte[/marq]',
	'ABBC3_MARQDOWN_VIEW'		=> '[marq=down]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Up
	'ABBC3_MARQUP_MOVER'		=> 'Faire défiler le texte vers le haut',
	'ABBC3_MARQUP_TIP'			=> '[marq=up]texte[/marq]',
	'ABBC3_MARQUP_VIEW'			=> '[marq=up]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Right
	'ABBC3_MARQRIGHT_MOVER'		=> 'Faire défiler le texte vers la droite',
	'ABBC3_MARQRIGHT_TIP'		=> '[marq=right]texte[/marq]',
	'ABBC3_MARQRIGHT_VIEW'		=> '[marq=right]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Left
	'ABBC3_MARQLEFT_MOVER'		=> 'Faire défiler le texte vers la gauche',
	'ABBC3_MARQLEFT_TIP'		=> '[marq=left]texte[/marq]',
	'ABBC3_MARQLEFT_VIEW'		=> '[marq=left]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Table row cell wizard
	'ABBC3_TABLE_MOVER'			=> 'Insérer un tableau',
	'ABBC3_TABLE_TIP'			=> '[table=(CSS style)][tr=(CSS style)][td=(CSS style)]texte[/td][/tr][/table]',
	'ABBC3_TABLE_VIEW'			=> '[table=width:50%;border:1px solid #cccccc][tr=text-align:center][td=border:1px solid #cccccc]' . $lang['SAMPLE_TEXT'] . '[/td][/tr][/table]',

	'ABBC3_TABLE_STYLE'			=> 'Entrez le style du tableau',
	'ABBC3_TABLE_EXAMPLE'		=> 'width:50%;border:1px solid #cccccc;',

	'ABBC3_ROW_NUMBER'			=> 'Entrez le nombre de lignes du tableau',
	'ABBC3_ROW_ERROR'			=> 'Vous n\'avez pas saisi le nombre de lignes',
	'ABBC3_ROW_STYLE'			=> 'Entrez le style de ligne',
	'ABBC3_ROW_EXAMPLE'			=> 'text-align:center;',

	'ABBC3_CELL_NUMBER'			=> 'Entrez le nombre de cellules',
	'ABBC3_CELL_ERROR'			=> 'Vous n\'avez pas saisi le nombre de cellules',
	'ABBC3_CELL_STYLE'			=> 'Entrez le style de cellule',
	'ABBC3_CELL_EXAMPLE'		=> 'border:1px solid #cccccc;',

	// Anchor
	'ABBC3_ANCHOR_MOVER'		=> 'Insérer une ancre',
	'ABBC3_ANCHOR_TIP'			=> '[anchor=(this anchor name) goto=(target anchor name)]texte[/anchor]',
	'ABBC3_ANCHOR_EXAMPLE'		=> '[anchor=a1 goto=a2]Aller à l\'ancre a2[/anchor]',
##	For translator:                                            yes                         Yes               Yes
	'ABBC3_ANCHOR_VIEW'			=> '[anchor=help_0 goto=help_1]Aller au lien 1[/anchor]<br /> ou  [anchor=help_1]ceci est le lien 1[/anchor]',

	// Hyperlink Wizard
	'ABBC3_URL_TAG'				=> 'page',
	'ABBC3_URL_MOVER'			=> 'Insérer une URL',
	'ABBC3_URL_TIP'				=> '[url]http://url[/url] or [url=http://url]texte URL[/url]',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',
	'ABBC3_URL_VIEW'			=> '[url=http://www.phpbb.com]Visiter phpBB![/url]',

	// Email Wizard
	'ABBC3_EMAIL_TAG'			=> 'email',
	'ABBC3_EMAIL_MOVER'			=> 'Insérer un e-mail',
	'ABBC3_EMAIL_TIP'			=> '[email]user@server.ext[/email] or [email=user@server.ext]Mon e-mail[/email]',
	'ABBC3_EMAIL_EXAMPLE'		=> 'user@server.ext',
	'ABBC3_EMAIL_VIEW'			=> '[email=user@server.ext]user@server.ext[/email]',

	// Ed2k link Wizard
	'ABBC3_ED2K_TAG'			=> 'ed2k',
	'ABBC3_ED2K_MOVER'			=> 'Lien eD2K',
	'ABBC3_ED2K_TIP'			=> '[url]lien ed2k[/url] or [url=lien ed2k]Nom ed2k[/url]',
	'ABBC3_ED2K_EXAMPLE'		=> 'ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/',
	'ABBC3_ED2K_VIEW'			=> '[url=ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/]The_Two_Towers-The_Purist_Edit-Trailer.avi[/url]',
	'ABBC3_ED2K_ADD'			=> 'Ajouter les liens sélectionnés à votre client ed2k',
	'ABBC3_ED2K_FRIEND'			=> 'ami ed2k',
	'ABBC3_ED2K_SERVER'			=> 'serveur ed2k',
	'ABBC3_ED2K_SERVERLIST'		=> 'liste de serveurs ed2k',

	// Web included by iframe
	'ABBC3_WEB_TAG'				=> 'web',
	'ABBC3_WEB_MOVER'			=> 'Insérer un site web dans votre message',
	'ABBC3_WEB_TIP'				=> '[web width=99% height=400]http://url[/web]',
	'ABBC3_WEB_EXAMPLE'			=> 'http://www.phpbb.com',
	'ABBC3_WEB_VIEW'			=> '[web width=99% height=400]http://www.phpbb.com[/web]',
	'ABBC3_WEB_EXPLAIN'			=> '<strong class="error">Remarque :</strong> autoriser l\'insertion d\'autres sites dans les messages peut présenter un risque de sécurité. Utilisez à vos risques et périls, ou attribuez cette permission à des groupes de confiance.',

	// Image & Thumbnail Wizard
	'ABBC3_ALIGN_MODE'			=> 'Aligner l\'image',
##	For translator:							 Don't				Yes
	'ABBC3_ALIGN_SELECTOR'		=> array(	'none'			=> 'Par défaut',
											'left'			=> 'Gauche',
											'center'		=> 'Centre',
											'right'			=> 'Droite',
											'float-left'	=> 'Float-Gauche',
											'float-right'	=> 'Float-Droite'),

	// Image
	'ABBC3_IMG_TAG'				=> 'image',
	'ABBC3_IMG_MOVER'			=> 'Insérer une image',
	'ABBC3_IMG_TIP'				=> '[img]http://image_url[/img] or [img=left|center|right|float-left|float-right]http://image_url[/img]',
	'ABBC3_IMG_EXAMPLE'			=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_IMG_VIEW'			=> '[img]http://www.google.com/intl/en_com/images/logo_plain.png[/img]',

	// Thumbnail
	'ABBC3_THUMBNAIL_TAG'		=> 'vignette',
	'ABBC3_THUMBNAIL_MOVER'		=> 'Insérer une vignette',
	'ABBC3_THUMBNAIL_TIP'		=> '[thumbnail]http://image_url[/thumbnail] or [thumbnail=left|center|right|float-left|float-right]http://image_url[/thumbnail]',
	'ABBC3_THUMBNAIL_EXAMPLE'	=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_THUMBNAIL_VIEW'		=> '[thumbnail]http://www.google.com/intl/en_com/images/logo_plain.png[/thumbnail]',

	// imgshack
	'ABBC3_IMGSHACK_MOVER'		=> 'Insérer une image depuis un service d\'hébergement',
	'ABBC3_IMGSHACK_TIP'		=> '[url=http://imageshack.us][img]http://image_url[/img][/url]',
	'ABBC3_IMGSHACK_VIEW'		=> '[url=http://img22.imageshack.us/my.php?image=abbc3v1012newscreen.gif][img]http://img22.imageshack.us/img22/6241/abbc3v1012newscreen.th.gif[/img][/url]',

	// Rapid share checker
	'ABBC3_RAPIDSHARE_TAG'		=> 'rapidshare',
	'ABBC3_RAPIDSHARE_MOVER'	=> 'Insérer un fichier depuis rapidshare',
	'ABBC3_RAPIDSHARE_TIP'		=> '[rapidshare]http://rapidshare.com/files/...[/rapidshare]',
	'ABBC3_RAPIDSHARE_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip',
	'ABBC3_RAPIDSHARE_VIEW'		=> '[rapidshare]http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip[/rapidshare]',
	'ABBC3_RAPIDSHARE_GOOD'		=> 'Fichier trouvé sur le serveur !',
	'ABBC3_RAPIDSHARE_WRONG'	=> 'Fichier introuvable !',

	// testlink
	'ABBC3_CURL_ERROR'			=> '<strong>Erreur : </strong> Désolé mais il semble que CURL ne soit pas chargé. Veuillez l\'installer pour utiliser cette fonction.',
	'ABBC3_LOGIN_EXPLAIN_VIEW'	=> 'Ce forum requiert que vous soyez enregistré et connecté pour voir les liens.',
	'ABBC3_TESTLINK_TAG'		=> 'vérificateur de lien',
	'ABBC3_TESTLINK_MOVER'		=> 'Insérer un fichier stocké sur un serveur public',
	'ABBC3_TESTLINK_TIP'		=> '[testlink]http://rapidshare.com/files/...[/testlink]',
	'ABBC3_TESTLINK_NOTE'		=> 'Serveurs valides : rapidshare, depositfiles, megashares',
	'ABBC3_TESTLINK_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip',
	'ABBC3_TESTLINK_VIEW'		=> '[testlink]http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip[/testlink]',
	'ABBC3_TESTLINK_GOOD'		=> 'Fichier trouvé sur le serveur !',
	'ABBC3_TESTLINK_WRONG'		=> 'Fichier introuvable !',

	// Click counter
	'ABBC3_CLICK_TAG'			=> 'click',
	'ABBC3_CLICK_MOVER'			=> 'Insérer une URL avec compteur de clics',
	'ABBC3_CLICK_TIP'			=> '[click]http://url[/click] or [click=http://url]Nom du site[/click] or [click][img]http://url[/img][/click]',
	'ABBC3_CLICK_EXAMPLE' 		=> 'http://www.google.com' . ' | ' . 'http://www.google.com/intl/en_com/images/logo_plain.png',
##	For translator:                                                               yes
	'ABBC3_CLICK_VIEW'			=> '[click=http://www.google.com] Google [/click] ou [click][img]http://www.google.com/intl/en_com/images/logo_plain.png[/img][/click]',
	'ABBC3_CLICK_TIME'			=> '( Cliqué %d fois )',
	'ABBC3_CLICK_TIMES'			=> '( Cliqué %d fois )',
	'ABBC3_CLICK_ERROR'			=> '<strong>ERREUR :</strong> Veuillez entrer un ID de click VALIDE dans l\'URL',

	// Search tag
	'ABBC3_SEARCH_MOVER'		=> 'Insérer un mot de recherche',
	'ABBC3_SEARCH_TIP'			=> '[search]texte[/search] or [search=bing|yahoo|google|altavista|lycos|wikipedia]texte[/search]',
##	For translator:                                                              yes                                                 yes                                                   yes                                                    yes                                                       yes                                                   yes
	'ABBC3_SEARCH_VIEW'			=> '[search]Advanced BBCode Box 3[/search]<br /> ou [search=bing]Advanced BBCode Box 3[/search]<br /> ou [search=yahoo]Advanced BBCode Box 3[/search]<br /> ou [search=google]Advanced BBCode Box 3[/search]<br /> ou [search=altavista]Advanced BBCode Box 3[/search]<br /> ou [search=lycos]Advanced BBCode Box 3[/search]<br /> ou [search=wikipedia]Advanced BBCode Box 3[/search]',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_TAG'			=> 'BBvideo',
	'ABBC3_BBVIDEO_MOVER'		=> 'Insérer une vidéo web',
	'ABBC3_BBVIDEO_TIP'			=> '[BBvideo width,height]URL vidéo[/BBvideo]',
	'ABBC3_BBVIDEO_EXAMPLE'		=> 'http://www.youtube.com/watch?v=sP4NMoJcFd4',
	'ABBC3_BBVIDEO_VIEW'		=> '[BBvideo 560,340]http://www.youtube.com/watch?v=sP4NMoJcFd4[/BBvideo]',
	'ABBC3_BBVIDEO_SELECT'		=> 'Sites et formats BBvideo',
	'ABBC3_BBVIDEO_SELECT_ERROR'=> 'Aucun lien vidéo intégré n\'est actuellement autorisé. Veuillez en informer le %sAdministrateur du forum%s à propos de ce problème.<br />En attendant, vous pouvez poster vos liens vidéo en utilisant le BBCode URL standard.',
	'ABBC3_BBVIDEO_FILE'		=> 'Format de fichier',
	'ABBC3_BBVIDEO_VIDEO'		=> 'Sites autorisés',
	'ABBC3_BBVIDEO_WATCH'		=> 'Regarder sur',

	// Flash (swf) Wizard
	'ABBC3_FLASH_TAG'			=> 'flash',
	'ABBC3_FLASH_MOVER'			=> 'Insérer un fichier Flash (swf)',
	'ABBC3_FLASH_TIP'			=> '[flash width=# height=#]URL flash[/flash] or [flash width,height]URL flash[/flash]',
	'ABBC3_FLASH_EXAMPLE'		=> 'http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-177.swf',
	'ABBC3_FLASH_VIEW'			=> '[flash 250,200]http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-177.swf[/flash]',

	// Flash (flv) Wizard
	'ABBC3_FLV_TAG'				=> 'flash',
	'ABBC3_FLV_MOVER'			=> 'Insérer une vidéo Flash (flv)',
	'ABBC3_FLV_TIP'				=> '[flv width=# height=#]URL vidéo flash[/flv] or [flv width,height]URL vidéo flash[/flv]',
	'ABBC3_FLV_EXAMPLE'			=> 'http://www.mediacollege.com/video-gallery/testclips/20051210-w50s.flv',
	'ABBC3_FLV_VIEW'			=> '[flv 250,200]http://www.mediacollege.com/video-gallery/testclips/20051210-w50s.flv[/flv]',
	'ABBC3_FLV_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Streaming Video Wizard
	'ABBC3_VIDEO_TAG'			=> 'video',
	'ABBC3_VIDEO_MOVER'			=> 'Insérer une vidéo',
	'ABBC3_VIDEO_TIP'			=> '[video width=# height=#]URL vidéo[/video]',
	'ABBC3_VIDEO_EXAMPLE'		=> 'http://www.mediacollege.com/video/format/windows-media/streaming/videofilename.wmv',
	'ABBC3_VIDEO_VIEW'			=> '[video 250,200]http://www.mediacollege.com/video/format/windows-media/streaming/videofilename.wmv[/video]',
	'ABBC3_VIDEO_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Streaming Audio Wizard
	'ABBC3_STREAM_TAG'			=> 'sound',
	'ABBC3_STREAM_MOVER'		=> 'Insérer un son',
	'ABBC3_STREAM_TIP'			=> '[stream]URL du stream[/stream]',
	'ABBC3_STREAM_EXAMPLE'		=> 'http://www.robtowns.com/music/first_noel.mp3',
	'ABBC3_STREAM_VIEW'			=> '[stream]http://www.robtowns.com/music/first_noel.mp3[/stream]',
	'ABBC3_STREAM_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Quicktime
	'ABBC3_QUICKTIME_TAG'		=> 'Quicktime',
	'ABBC3_QUICKTIME_MOVER'		=> 'Insérer Quicktime',
	'ABBC3_QUICKTIME_TIP'		=> '[quicktime width=# height=#]URL Quicktime[/quicktime]',
	'ABBC3_QUICKTIME_EXAMPLE'	=> 'http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt',
	'ABBC3_QUICKTIME_VIEW'		=> '[quicktime width=250 height=200]http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt[/quicktime]',
	'ABBC3_QUICKTIME_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// Real Media Wizard
	'ABBC3_RAM_TAG'				=> 'Real Media',
	'ABBC3_RAM_MOVER'			=> 'Insérer Real Media',
	'ABBC3_RAM_TIP'				=> '[ram]URL Real Media[/ram]',
	'ABBC3_RAM_EXAMPLE'			=> 'http://service.real.com/help/library/guides/realone/IntroToStreaming/samples/ramfiles/startend.ram',
	'ABBC3_RAM_VIEW'			=> '[ram width=250 height=200]http://service.real.com/help/library/guides/realone/IntroToStreaming/samples/ramfiles/startend.ram[/ram]',
	'ABBC3_RAM_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Youtube video Wizard
	'ABBC3_YOUTUBE_TAG'			=> 'Vidéo Youtube',
	'ABBC3_YOUTUBE_MOVER'		=> 'Insérer une vidéo depuis Youtube',
	'ABBC3_YOUTUBE_TIP'			=> '[youtube]URL vidéo[/youtube]',
	'ABBC3_YOUTUBE_EXAMPLE'		=> 'http://www.youtube.com/watch?v=sP4NMoJcFd4',
	'ABBC3_YOUTUBE_VIEW'		=> '[youtube]http://www.youtube.com/watch?v=sP4NMoJcFd4[/youtube]',
	'ABBC3_YOUTUBE_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Veoh video
	'ABBC3_VEOH_TAG'			=> 'Veoh',
	'ABBC3_VEOH_MOVER'			=> 'Insérer une vidéo depuis Veoh',
	'ABBC3_VEOH_TIP'			=> '[veoh]URL vidéo[/veoh]',
	'ABBC3_VEOH_EXAMPLE'		=> 'http://www.veoh.com/watch/v27458670er62wkCt',
	'ABBC3_VEOH_VIEW'			=> '[veoh]http://www.veoh.com/watch/v27458670er62wkCt[/veoh]',
	'ABBC3_VEOH_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Collegehumor video
	'ABBC3_COLLEGEHUMOR_TAG'	=> 'Collegehumor',
	'ABBC3_COLLEGEHUMOR_MOVER'	=> 'Insérer une vidéo depuis Collegehumor',
	'ABBC3_COLLEGEHUMOR_TIP'	=> '[collegehumor]URL vidéo collegehumor[/collegehumor]',
	'ABBC3_COLLEGEHUMOR_EXAMPLE'=> 'http://www.collegehumor.com/video:1802097',
	'ABBC3_COLLEGEHUMOR_VIEW'	=> '[collegehumor]http://www.collegehumor.com/video:1802097[/collegehumor]',
	'ABBC3_COLLEGEHUMOR_EXPLAIN'=> $lang['DEPRECATED_BBCODE'],

	// Dailymotion video
	'ABBC3_DM_MOVER'			=> 'Insérer une vidéo depuis dailymotion',
	'ABBC3_DM_TIP'				=> '[dm]ID Dailymotion[/dm]',
	'ABBC3_DM_EXAMPLE'			=> 'http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport',
	'ABBC3_DM_VIEW'				=> '[dm]http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport[/dm]',
	'ABBC3_DM_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Gamespot video
	'ABBC3_GAMESPOT_MOVER'		=> 'Insérer une vidéo depuis Gamespot',
	'ABBC3_GAMESPOT_TIP'		=> '[gamespot]URL vidéo Gamespot[gamespot]',
	'ABBC3_GAMESPOT_EXAMPLE'	=> 'http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8',
	'ABBC3_GAMESPOT_VIEW'		=> '[gamespot]http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8[/gamespot]',
	'ABBC3_GAMESPOT_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// IGN video
	'ABBC3_IGNVIDEO_MOVER'		=> 'Insérer une vidéo depuis IGN',
	'ABBC3_IGNVIDEO_TIP'		=> '[ignvideo]URL vidéo IGN[/ignvideo]',
	'ABBC3_IGNVIDEO_EXAMPLE'	=> 'http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html',
	'ABBC3_IGNVIDEO_VIEW'		=> '[ignvideo]http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html[/ignvideo]',
	'ABBC3_IGNVIDEO_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// LiveLeak video
	'ABBC3_LIVELEAK_MOVER'		=> 'Insérer une vidéo depuis Liveleak',
	'ABBC3_LIVELEAK_TIP'		=> '[liveleak]URL vidéo Liveleak[/liveleak]',
	'ABBC3_LIVELEAK_EXAMPLE'	=> 'http://www.liveleak.com/view?i=166_1194290849',
	'ABBC3_LIVELEAK_VIEW'		=> '[liveleak]http://www.liveleak.com/view?i=166_1194290849[/liveleak]',
	'ABBC3_LIVELEAK_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

// Custom BBCodes

));

