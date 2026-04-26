<?php
/**
*
* help_faq [French]
*
* @package language
* @version $Id$
* @copyright (c) 2005 phpBB Group, (c) Maël Soucaze
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
*/
if (!defined('IN_PHPBB'))
{
	exit;
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

$help = array(
	array(
		0 => '--',
		1 => 'Problèmes de connexion et d’inscription'
	),
	array(
		0 => 'Pourquoi ne puis-je pas me connecter ?',
		1 => 'Il existe plusieurs raisons pour lesquelles cela peut se produire. Tout d’abord, assurez-vous que votre nom d’utilisateur et votre mot de passe sont corrects. Si c’est le cas, contactez le propriétaire du forum pour vous assurer que vous n’avez pas été banni. Il est également possible que le propriétaire du site ait une erreur de configuration de son côté et qu’il doive la corriger.'
	),
	array(
		0 => 'Pourquoi dois-je m’inscrire ?',
		1 => 'Ce n’est pas forcément nécessaire, cela dépend de l’administrateur du forum qui décide si vous devez vous inscrire pour pouvoir poster des messages. Cependant, l’inscription vous donnera accès à des fonctionnalités supplémentaires non disponibles pour les invités, telles que des avatars personnalisables, la messagerie privée, l’envoi d’e-mails à d’autres utilisateurs, l’abonnement à des groupes d’utilisateurs, etc. L’inscription ne prend que quelques instants, il est donc recommandé de le faire.'
	),
	array(
		0 => 'Pourquoi suis-je automatiquement déconnecté ?',
		1 => 'Si vous ne cochez pas la case <em>Me connecter automatiquement</em> lors de votre connexion, le forum ne vous gardera connecté que pendant une durée prédéfinie. Cela évite toute utilisation abusive de votre compte par une autre personne. Pour rester connecté, cochez cette case lors de la connexion. Ceci n’est pas recommandé si vous accédez au forum depuis un ordinateur partagé, par exemple une bibliothèque, un cybercafé, une salle informatique universitaire, etc. Si vous ne voyez pas cette case à cocher, cela signifie que l’administrateur du forum a désactivé cette fonctionnalité.'
	),
	array(
		0 => 'Comment empêcher l’apparition de mon nom d’utilisateur dans la liste des utilisateurs en ligne ?',
		1 => 'Dans votre panneau de contrôle utilisateur, sous « Préférences du forum », vous trouverez l’option <em>Masquer votre statut en ligne</em>. Activez cette option avec <samp>Oui</samp> et vous n’apparaîtrez qu’aux administrateurs, aux modérateurs et à vous-même. Vous serez compté comme utilisateur caché.'
	),
	array(
		0 => 'J’ai perdu mon mot de passe !',
		1 => 'Pas de panique ! Même si votre mot de passe ne peut pas être récupéré, il peut facilement être réinitialisé. Rendez-vous sur la page de connexion et cliquez sur <em>J’ai oublié mon mot de passe</em>. Suivez les instructions et vous devriez pouvoir vous reconnecter rapidement.'
	),
	array(
		0 => 'Je me suis inscrit mais je ne peux pas me connecter !',
		1 => 'Vérifiez d’abord votre nom d’utilisateur et votre mot de passe. S’ils sont corrects, alors l’une des deux choses suivantes a pu se produire. Si le support COPPA est activé et que vous avez indiqué avoir moins de 13 ans lors de l’inscription, vous devrez suivre les instructions reçues. Certains forums exigent également que les nouvelles inscriptions soient activées, soit par vous-même soit par un administrateur avant que vous puissiez vous connecter ; cette information était présente lors de l’inscription. Si un e-mail vous a été envoyé, suivez les instructions. Si vous n’avez pas reçu d’e-mail, il est possible que vous ayez fourni une adresse e-mail incorrecte ou que l’e-mail ait été intercepté par un filtre anti-spam. Si vous êtes certain que l’adresse e-mail fournie est correcte, essayez de contacter un administrateur.'
	),
	array(
		0 => 'Je me suis inscrit par le passé mais je ne peux plus me connecter ?!',
		1 => 'Il est possible qu’un administrateur ait désactivé ou supprimé votre compte pour une raison quelconque. De plus, de nombreux forums suppriment périodiquement les utilisateurs qui n’ont pas posté depuis longtemps afin de réduire la taille de la base de données. Si cela s’est produit, essayez de vous inscrire à nouveau et de participer davantage aux discussions.'
	),
	array(
		0 => 'Qu’est-ce que COPPA ?',
		1 => 'COPPA, ou la loi Child Online Privacy and Protection Act de 1998, est une loi des États-Unis exigeant que les sites web susceptibles de collecter des informations auprès de mineurs de moins de 13 ans disposent d’un consentement parental écrit ou d’une autre forme de reconnaissance du représentant légal, permettant la collecte d’informations personnelles identifiables concernant un mineur de moins de 13 ans. Si vous ne savez pas si cela s’applique à vous en tant que personne essayant de vous inscrire ou au site web sur lequel vous essayez de vous inscrire, contactez un conseiller juridique. Veuillez noter que le groupe phpBB ne peut fournir aucun conseil juridique et n’est pas un point de contact pour les questions juridiques de quelque nature que ce soit, sauf indication contraire ci-dessous.',
	),
	array(
		0 => 'Pourquoi ne puis-je pas m’inscrire ?',
		1 => 'Il est possible que le propriétaire du site ait banni votre adresse IP ou interdit le nom d’utilisateur que vous essayez d’enregistrer. Le propriétaire du site peut également avoir désactivé les inscriptions afin d’empêcher les nouveaux visiteurs de s’inscrire. Contactez un administrateur du forum pour obtenir de l’aide.'
	),
	array(
		0 => 'Que fait « Supprimer tous les cookies du forum » ?',
		1 => '« Supprimer tous les cookies du forum » supprime les cookies créés par phpBB qui vous maintiennent authentifié et connecté au forum. Cela fournit également des fonctions telles que le suivi des messages lus si elles ont été activées par le propriétaire du forum. Si vous rencontrez des problèmes de connexion ou de déconnexion, supprimer les cookies du forum peut vous aider.'
	),
	array(
		0 => '--',
		1 => 'Préférences et paramètres utilisateur'
	),
	array(
		0 => 'Comment modifier mes paramètres ?',
		1 => 'Si vous êtes un utilisateur enregistré, tous vos paramètres sont stockés dans la base de données du forum. Pour les modifier, rendez-vous dans votre panneau de contrôle utilisateur ; un lien se trouve généralement en haut des pages du forum. Ce système vous permettra de modifier tous vos paramètres et préférences.'
	),
	array(
		0 => 'Les heures ne sont pas correctes !',
		1 => 'Il est possible que l’heure affichée corresponde à un fuseau horaire différent du vôtre. Si tel est le cas, rendez-vous dans votre panneau de contrôle utilisateur et modifiez votre fuseau horaire afin qu’il corresponde à votre région, par exemple Londres, Paris, New York, Sydney, etc. Veuillez noter que le changement de fuseau horaire, comme la plupart des paramètres, ne peut être effectué que par les utilisateurs enregistrés. Si vous n’êtes pas inscrit, c’est le bon moment pour le faire.'
	),
	array(
		0 => 'J’ai changé le fuseau horaire et l’heure est toujours incorrecte !',
		1 => 'Si vous êtes certain d’avoir correctement défini le fuseau horaire et l’heure d’été/DST et que l’heure est toujours incorrecte, alors l’heure enregistrée sur l’horloge du serveur est incorrecte. Veuillez en informer un administrateur afin qu’il corrige le problème.'
	),
	array(
		0 => 'Ma langue n’est pas dans la liste !',
		1 => 'Soit l’administrateur n’a pas installé votre langue, soit personne n’a traduit ce forum dans votre langue. Essayez de demander à l’administrateur du forum s’il peut installer le pack de langue dont vous avez besoin. Si le pack de langue n’existe pas, n’hésitez pas à créer une nouvelle traduction. Plus d’informations peuvent être trouvées sur le site phpBB (voir le lien en bas des pages du forum).'
	),
	array(
		0 => 'Comment afficher une image à côté de mon nom d’utilisateur ?',
		1 => 'Deux images peuvent apparaître à côté d’un nom d’utilisateur lors de l’affichage des messages. L’une peut être une image associée à votre rang, généralement sous forme d’étoiles, de blocs ou de points, indiquant combien de messages vous avez publiés ou votre statut sur le forum. Une autre, généralement plus grande, est appelée avatar et est généralement unique ou personnelle à chaque utilisateur. Il appartient à l’administrateur du forum d’activer les avatars et de choisir la manière dont ils peuvent être mis à disposition. Si vous ne pouvez pas utiliser les avatars, contactez un administrateur du forum et demandez-lui les raisons.'
	),
	array(
		0 => 'Quel est mon rang et comment puis-je le modifier ?',
		1 => 'Les rangs, qui apparaissent sous votre nom d’utilisateur, indiquent le nombre de messages que vous avez publiés ou identifient certains utilisateurs, par exemple les modérateurs et les administrateurs. En général, vous ne pouvez pas modifier directement le libellé des rangs du forum car ils sont définis par l’administrateur du forum. Veuillez ne pas abuser du forum en publiant inutilement des messages simplement pour augmenter votre rang. La plupart des forums ne tolèrent pas cela et le modérateur ou l’administrateur réduira simplement votre nombre de messages.'
	),
	array(
		0 => 'Lorsque je clique sur le lien e-mail d’un utilisateur, on me demande de me connecter ?',
		1 => 'Seuls les utilisateurs enregistrés peuvent envoyer des e-mails à d’autres utilisateurs via le formulaire d’e-mail intégré, et uniquement si l’administrateur a activé cette fonctionnalité. Cela permet d’éviter toute utilisation malveillante du système d’e-mail par des utilisateurs anonymes.'
	),
	array(
		0 => '--',
		1 => 'Problèmes de publication'
	),
	array(
		0 => 'Comment publier un sujet dans un forum ?',
		1 => 'Pour publier un nouveau sujet dans un forum, cliquez sur le bouton approprié sur l’écran du forum ou du sujet. Vous devrez peut-être vous inscrire avant de pouvoir publier un message. Une liste de vos permissions dans chaque forum est disponible en bas des écrans du forum et du sujet. Exemple : Vous pouvez publier de nouveaux sujets, Vous pouvez voter dans les sondages, etc.'
	),
	array(
		0 => 'Comment modifier ou supprimer un message ?',
		1 => 'À moins d’être administrateur ou modérateur du forum, vous ne pouvez modifier ou supprimer que vos propres messages. Vous pouvez modifier un message en cliquant sur le bouton de modification du message concerné, parfois uniquement pendant une durée limitée après sa publication. Si quelqu’un a déjà répondu au message, vous verrez un petit texte sous le message lorsque vous reviendrez au sujet, indiquant le nombre de fois où vous l’avez modifié ainsi que la date et l’heure. Cela n’apparaîtra que si quelqu’un a répondu ; cela n’apparaîtra pas si un modérateur ou un administrateur a modifié le message, bien qu’ils puissent laisser une note expliquant la raison de leur modification à leur discrétion. Veuillez noter que les utilisateurs normaux ne peuvent pas supprimer un message une fois que quelqu’un y a répondu.'
	),
	array(
		0 => 'Comment ajouter une signature à mon message ?',
		1 => 'Pour ajouter une signature à un message, vous devez d’abord en créer une via votre panneau de contrôle utilisateur. Une fois créée, vous pouvez cocher la case <em>Joindre une signature</em> dans le formulaire de publication pour l’ajouter à votre message. Vous pouvez également ajouter une signature par défaut à tous vos messages en cochant le bouton radio approprié dans votre profil. Si vous le faites, vous pourrez toujours empêcher l’ajout d’une signature à des messages individuels en décochant la case correspondante dans le formulaire de publication.'
	),
	array(
		0 => 'Comment créer un sondage ?',
		1 => 'Lors de la publication d’un nouveau sujet ou de la modification du premier message d’un sujet, cliquez sur l’onglet « Création du sondage » sous le formulaire principal de publication ; si vous ne le voyez pas, vous ne disposez pas des permissions nécessaires pour créer des sondages. Saisissez un titre et au moins deux options dans les champs appropriés, en veillant à ce que chaque option soit sur une ligne séparée dans la zone de texte. Vous pouvez également définir le nombre d’options que les utilisateurs peuvent sélectionner lors du vote sous « Options par utilisateur », une limite de temps en jours pour le sondage (0 pour une durée illimitée) et enfin l’option permettant aux utilisateurs de modifier leur vote.'
	),
	array(
		0 => 'Pourquoi ne puis-je pas ajouter plus d’options au sondage ?',
		1 => 'La limite du nombre d’options de sondage est définie par l’administrateur du forum. Si vous estimez avoir besoin d’ajouter plus d’options à votre sondage que le nombre autorisé, contactez l’administrateur du forum.'
	),
	array(
		0 => 'Comment modifier ou supprimer un sondage ?',
		1 => 'Comme pour les messages, les sondages ne peuvent être modifiés que par l’auteur original, un modérateur ou un administrateur. Pour modifier un sondage, cliquez pour modifier le premier message du sujet ; c’est toujours à ce message que le sondage est associé. Si personne n’a encore voté, les utilisateurs peuvent supprimer le sondage ou modifier n’importe quelle option du sondage. Cependant, si des membres ont déjà voté, seuls les modérateurs ou les administrateurs peuvent le modifier ou le supprimer. Cela évite que les options du sondage soient changées en cours de route.'
	),
	array(
		0 => 'Pourquoi ne puis-je pas accéder à un forum ?',
		1 => 'Certains forums peuvent être limités à certains utilisateurs ou groupes. Pour voir, lire, publier ou effectuer une autre action, vous pouvez avoir besoin d’autorisations spéciales. Contactez un modérateur ou un administrateur du forum pour obtenir l’accès.'
	),
	array(
		0 => 'Pourquoi ne puis-je pas ajouter de pièces jointes ?',
		1 => 'Les autorisations de pièces jointes sont accordées par forum, par groupe ou par utilisateur. L’administrateur du forum peut ne pas avoir autorisé l’ajout de pièces jointes dans le forum spécifique où vous publiez, ou peut-être que seuls certains groupes peuvent publier des pièces jointes. Contactez l’administrateur du forum si vous n’êtes pas sûr de la raison pour laquelle vous ne pouvez pas ajouter de pièces jointes.'
	),
	array(
		0 => 'Pourquoi ai-je reçu un avertissement ?',
		1 => 'Chaque administrateur de forum a son propre ensemble de règles pour son site. Si vous avez enfreint une règle, un avertissement peut vous être attribué. Veuillez noter qu’il s’agit d’une décision de l’administrateur du forum, et que le groupe phpBB n’a rien à voir avec les avertissements sur le site concerné. Contactez l’administrateur du forum si vous ne savez pas pourquoi vous avez reçu un avertissement.'
	),
	array(
		0 => 'Comment signaler un message à un modérateur ?',
		1 => 'Si l’administrateur du forum l’a autorisé, vous devriez voir un bouton de signalement à côté du message que vous souhaitez signaler. En cliquant dessus, vous serez guidé à travers les étapes nécessaires pour signaler le message.'
	),
	array(
		0 => 'À quoi sert le bouton « Enregistrer » lors de la publication d’un sujet ?',
		1 => 'Cela vous permet d’enregistrer un texte afin de le terminer et de le soumettre à une date ultérieure. Pour recharger un texte enregistré, rendez-vous dans le panneau de contrôle utilisateur.'
	),
	array(
		0 => 'Pourquoi mon message doit-il être approuvé ?',
		1 => 'L’administrateur du forum a peut-être décidé que les messages publiés dans le forum où vous postez doivent être vérifiés avant leur soumission. Il est également possible que l’administrateur vous ait placé dans un groupe d’utilisateurs dont les messages nécessitent une approbation préalable. Veuillez contacter l’administrateur du forum pour plus de détails.'
	),
	array(
		0 => 'Comment remonter mon sujet ?',
		1 => 'En cliquant sur le lien « Remonter le sujet » lorsque vous le consultez, vous pouvez faire remonter le sujet en haut du forum sur la première page. Cependant, si vous ne voyez pas ce lien, la fonction de remontée de sujet peut être désactivée ou le délai minimum entre deux remontées n’a pas encore été atteint. Il est également possible de remonter le sujet simplement en y répondant, mais veillez à respecter les règles du forum en le faisant.'
	),
	array(
		0 => '--',
		1 => 'Mise en forme et types de sujets'
	),
	array(
		0 => 'Qu’est-ce que le BBCode ?',
		1 => 'Le BBCode est une implémentation spéciale du HTML, offrant un excellent contrôle de mise en forme sur certains éléments d’un message. L’utilisation du BBCode est autorisée par l’administrateur, mais elle peut également être désactivée message par message depuis le formulaire de publication. Le BBCode lui-même ressemble au HTML, mais les balises sont entourées de crochets [ et ] au lieu de &lt; et &gt;. Pour plus d’informations sur le BBCode, consultez le guide accessible depuis la page de publication.'
	),
	array(
		0 => 'Puis-je utiliser le HTML ?',
		1 => 'Non. Il n’est pas possible de publier du HTML sur ce forum et de le faire afficher comme du HTML. La plupart des mises en forme réalisables en HTML peuvent être appliquées à la place avec le BBCode.'
	),
	array(
		0 => 'Que sont les smileys ?',
		1 => 'Les smileys, ou émoticônes, sont de petites images qui peuvent être utilisées pour exprimer un sentiment à l’aide d’un code court, par exemple :) signifie heureux, tandis que :( signifie triste. La liste complète des émoticônes peut être consultée dans le formulaire de publication. Essayez cependant de ne pas en abuser, car ils peuvent rapidement rendre un message illisible et un modérateur peut les modifier ou supprimer complètement le message. L’administrateur du forum peut également avoir défini une limite au nombre de smileys que vous pouvez utiliser dans un message.'
	),
	array(
		0 => 'Puis-je publier des images ?',
		1 => 'Oui, des images peuvent être affichées dans vos messages. Si l’administrateur a autorisé les pièces jointes, vous pourrez peut-être téléverser l’image sur le forum. Sinon, vous devez créer un lien vers une image stockée sur un serveur web accessible publiquement, par exemple http://www.example.com/mon-image.gif. Vous ne pouvez pas créer de lien vers des images stockées sur votre propre PC (à moins qu’il ne s’agisse d’un serveur accessible publiquement), ni vers des images stockées derrière des mécanismes d’authentification, par exemple des boîtes mail Hotmail ou Yahoo, des sites protégés par mot de passe, etc. Pour afficher l’image, utilisez la balise BBCode [img].'
	),
	array(
		0 => 'Que sont les annonces globales ?',
		1 => 'Les annonces globales contiennent des informations importantes et vous devriez les lire chaque fois que possible. Elles apparaissent en haut de chaque forum ainsi que dans votre panneau de contrôle utilisateur. Les permissions relatives aux annonces globales sont accordées par l’administrateur du forum.'
	),
	array(
		0 => 'Que sont les annonces ?',
		1 => 'Les annonces contiennent souvent des informations importantes concernant le forum que vous consultez actuellement et vous devriez les lire chaque fois que possible. Les annonces apparaissent en haut de chaque page du forum dans lequel elles sont publiées. Comme pour les annonces globales, les permissions sont accordées par l’administrateur du forum.'
	),
	array(
		0 => 'Que sont les sujets épinglés ?',
		1 => 'Les sujets épinglés dans le forum apparaissent sous les annonces et uniquement sur la première page. Ils sont souvent assez importants, vous devriez donc les lire chaque fois que possible. Comme pour les annonces et les annonces globales, les permissions pour les sujets épinglés sont accordées par l’administrateur du forum.'
	),
	array(
		0 => 'Que sont les sujets verrouillés ?',
		1 => 'Les sujets verrouillés sont des sujets auxquels les utilisateurs ne peuvent plus répondre et tout sondage qu’ils contenaient est automatiquement terminé. Les sujets peuvent être verrouillés pour de nombreuses raisons, par le modérateur du forum ou par l’administrateur du forum. Vous pouvez également être autorisé à verrouiller vos propres sujets selon les permissions qui vous ont été accordées par l’administrateur.'
	),
	array(
		0 => 'Que sont les icônes de sujet ?',
		1 => 'Les icônes de sujet sont des images choisies par l’auteur et associées aux messages pour indiquer leur contenu. La possibilité d’utiliser des icônes de sujet dépend des permissions définies par l’administrateur du forum.'
	),
	// This block will switch the FAQ-Questions to the second template column
	array(
		0 => '--',
		1 => '--'
	),
	array(
		0 => '--',
		1 => 'Niveaux d’utilisateurs et groupes'
	),
	array(
		0 => 'Que sont les administrateurs ?',
		1 => 'Les administrateurs sont des membres disposant du niveau de contrôle le plus élevé sur l’ensemble du forum. Ces membres peuvent contrôler tous les aspects du fonctionnement du forum, y compris la définition des permissions, le bannissement des utilisateurs, la création de groupes d’utilisateurs ou de modérateurs, etc., selon le fondateur du forum et les permissions qu’il ou elle a accordées aux autres administrateurs. Ils peuvent également disposer de toutes les capacités de modération dans tous les forums, selon les paramètres définis par le fondateur.'
	),
	array(
		0 => 'Que sont les modérateurs ?',
		1 => 'Les modérateurs sont des personnes (ou des groupes de personnes) qui s’occupent des forums au quotidien. Ils ont l’autorité de modifier ou supprimer les messages, ainsi que de verrouiller, déverrouiller, déplacer, supprimer et scinder les sujets dans le forum qu’ils modèrent. En général, les modérateurs sont présents pour empêcher les utilisateurs de publier hors sujet ou du contenu abusif ou offensant.'
	),
	array(
		0 => 'Que sont les groupes d’utilisateurs ?',
		1 => 'Les groupes d’utilisateurs sont des groupes de membres qui divisent la communauté en sections gérables avec lesquelles les administrateurs du forum peuvent travailler. Chaque utilisateur peut appartenir à plusieurs groupes et chaque groupe peut recevoir des permissions individuelles. Cela permet aux administrateurs de modifier facilement les permissions de nombreux utilisateurs à la fois, par exemple en changeant les permissions des modérateurs ou en accordant l’accès à un forum privé.'
	),
	array(
		0 => 'Où se trouvent les groupes d’utilisateurs et comment en rejoindre un ?',
		1 => 'Vous pouvez voir tous les groupes d’utilisateurs via le lien « Groupes d’utilisateurs » dans votre panneau de contrôle utilisateur. Si vous souhaitez en rejoindre un, cliquez sur le bouton approprié. Cependant, tous les groupes ne sont pas en accès libre. Certains peuvent nécessiter une approbation, d’autres peuvent être fermés, et certains peuvent même avoir une adhésion cachée. Si le groupe est ouvert, vous pouvez le rejoindre en cliquant sur le bouton approprié. Si un groupe nécessite une approbation, vous pouvez demander à le rejoindre en cliquant sur le bouton approprié. Le responsable du groupe devra approuver votre demande et pourra vous demander pourquoi vous souhaitez rejoindre le groupe. Veuillez ne pas harceler un responsable de groupe s’il rejette votre demande ; il aura ses raisons.'
	),
	array(
		0 => 'Comment devenir responsable d’un groupe d’utilisateurs ?',
		1 => 'Un responsable de groupe d’utilisateurs est généralement désigné lorsque les groupes sont créés initialement par un administrateur du forum. Si vous souhaitez créer un groupe d’utilisateurs, votre premier point de contact doit être un administrateur ; essayez de lui envoyer un message privé.',
	),
	array(
		0 => 'Pourquoi certains groupes d’utilisateurs apparaissent-ils dans une couleur différente ?',
		1 => 'Il est possible que l’administrateur du forum attribue une couleur aux membres d’un groupe d’utilisateurs afin de faciliter l’identification des membres de ce groupe.'
	),
	array(
		0 => 'Qu’est-ce qu’un « groupe d’utilisateurs par défaut » ?',
		1 => 'Si vous êtes membre de plusieurs groupes d’utilisateurs, votre groupe par défaut est utilisé pour déterminer la couleur du groupe et le rang de groupe qui doivent être affichés pour vous par défaut. L’administrateur du forum peut vous autoriser à modifier votre groupe d’utilisateurs par défaut via votre panneau de contrôle utilisateur.'
	),
	array(
		0 => 'Qu’est-ce que le lien « L’équipe » ?',
		1 => 'Cette page vous fournit une liste du personnel du forum, y compris les administrateurs et les modérateurs, ainsi que d’autres détails tels que les forums qu’ils modèrent.'
	),
	array(
		0 => '--',
		1 => 'Messagerie privée'
	),
	array(
		0 => 'Je ne peux pas envoyer de messages privés !',
		1 => 'Il y a trois raisons possibles à cela : vous n’êtes pas inscrit et/ou pas connecté, l’administrateur du forum a désactivé la messagerie privée pour l’ensemble du forum, ou l’administrateur du forum vous a empêché d’envoyer des messages. Contactez un administrateur du forum pour plus d’informations.'
	),
	array(
		0 => 'Je continue à recevoir des messages privés non désirés !',
		1 => 'Vous pouvez empêcher un utilisateur de vous envoyer des messages privés en utilisant les règles de messages dans votre panneau de contrôle utilisateur. Si vous recevez des messages privés abusifs d’un utilisateur en particulier, informez-en un administrateur du forum ; il a le pouvoir d’empêcher un utilisateur d’envoyer des messages privés.'
	),
	array(
		0 => 'J’ai reçu un e-mail de spam ou abusif de quelqu’un sur ce forum !',
		1 => 'Nous sommes désolés de l’apprendre. La fonction de formulaire d’e-mail de ce forum comprend des protections permettant d’essayer de suivre les utilisateurs qui envoient ce type de messages. Veuillez envoyer un e-mail à l’administrateur du forum avec une copie complète de l’e-mail reçu. Il est très important que cela inclue les en-têtes contenant les détails de l’utilisateur qui a envoyé l’e-mail. L’administrateur du forum pourra alors prendre les mesures nécessaires.'
	),
	array(
		0 => '--',
		1 => 'Amis et ignorés'
	),
	array(
		0 => 'À quoi servent mes listes d’amis et d’ignorés ?',
		1 => 'Vous pouvez utiliser ces listes pour organiser les autres membres du forum. Les membres ajoutés à votre liste d’amis seront affichés dans votre panneau de contrôle utilisateur pour un accès rapide afin de voir leur statut en ligne et de leur envoyer des messages privés. Selon le support du template, les messages de ces utilisateurs peuvent également être mis en évidence. Si vous ajoutez un utilisateur à votre liste d’ignorés, tous les messages qu’il publie seront masqués par défaut.'
	),
	array(
		0 => 'Comment ajouter / supprimer des utilisateurs de ma liste d’amis ou d’ignorés ?',
		1 => 'Vous pouvez ajouter des utilisateurs à votre liste de deux manières. Dans le profil de chaque utilisateur, il existe un lien permettant de l’ajouter à votre liste d’amis ou d’ignorés. Alternativement, depuis votre panneau de contrôle utilisateur, vous pouvez ajouter directement des utilisateurs en saisissant leur nom de membre. Vous pouvez également supprimer des utilisateurs de votre liste à partir de cette même page.'
	),
	array(
		0 => '--',
		1 => 'Recherche dans les forums'
	),
	array(
		0 => 'Comment rechercher dans un ou plusieurs forums ?',
		1 => 'Saisissez un terme de recherche dans la zone de recherche située sur les pages d’index, de forum ou de sujet. La recherche avancée est accessible en cliquant sur le lien « Recherche avancée », disponible sur toutes les pages du forum. La façon d’accéder à la recherche peut dépendre du style utilisé.'
	),
	array(
		0 => 'Pourquoi ma recherche ne renvoie-t-elle aucun résultat ?',
		1 => 'Votre recherche était probablement trop vague et incluait de nombreux termes courants qui ne sont pas indexés par phpBB3. Soyez plus précis et utilisez les options disponibles dans la recherche avancée.'
	),
	array(
		0 => 'Pourquoi ma recherche renvoie-t-elle une page blanche !?',
		1 => 'Votre recherche a renvoyé trop de résultats pour que le serveur web puisse les gérer. Utilisez la « Recherche avancée » et soyez plus précis dans les termes utilisés ainsi que dans les forums à rechercher.'
	),
	array(
		0 => 'Comment rechercher des membres ?',
		1 => 'Rendez-vous sur la page « Membres » et cliquez sur le lien « Trouver un membre ».'
	),
	array(
		0 => 'Comment puis-je retrouver mes propres messages et sujets ?',
		1 => 'Vos propres messages peuvent être retrouvés soit en cliquant sur « Rechercher les messages de l’utilisateur » dans le panneau de contrôle utilisateur, soit via votre propre page de profil. Pour rechercher vos sujets, utilisez la page de recherche avancée et remplissez les différentes options de manière appropriée.'
	),
	array(
		0 => '--',
		1 => 'Abonnements aux sujets et favoris'
	),
	array(
		0 => 'Quelle est la différence entre les favoris et l’abonnement ?',
		1 => 'L’ajout aux favoris dans phpBB3 ressemble beaucoup à l’ajout aux favoris dans votre navigateur web. Vous n’êtes pas averti lorsqu’il y a une mise à jour, mais vous pouvez revenir au sujet plus tard. L’abonnement, en revanche, vous avertira lorsqu’il y aura une mise à jour du sujet ou du forum sur le forum, selon votre ou vos méthodes de notification préférées.'
	),
	array(
		0 => 'Comment m’abonner à des forums ou sujets spécifiques ?',
		1 => 'Pour vous abonner à un forum spécifique, cliquez sur le lien « S’abonner au forum » en entrant dans le forum. Pour vous abonner à un sujet, répondez au sujet en cochant la case d’abonnement ou cliquez sur le lien « S’abonner au sujet » à l’intérieur du sujet lui-même.'
	),
	array(
		0 => 'Comment supprimer mes abonnements ?',
		1 => 'Pour supprimer vos abonnements, rendez-vous dans votre panneau de contrôle utilisateur et suivez les liens vers vos abonnements.'
	),
	array(
		0 => '--',
		1 => 'Pièces jointes'
	),
	array(
		0 => 'Quelles pièces jointes sont autorisées sur ce forum ?',
		1 => 'Chaque administrateur du forum peut autoriser ou interdire certains types de pièces jointes. Si vous ne savez pas ce qu’il est permis de téléverser, contactez l’administrateur du forum pour obtenir de l’aide.'
	),
	array(
		0 => 'Comment retrouver toutes mes pièces jointes ?',
		1 => 'Pour retrouver la liste des pièces jointes que vous avez téléversées, rendez-vous dans votre panneau de contrôle utilisateur et suivez les liens vers la section des pièces jointes.'
	),

	array(
		0 => '--',
		1 => 'Téléchargements'
	),
	array(
		0 => 'Où puis-je trouver les téléchargements ?',
		1 => 'Les liens vers les téléchargements se trouvent dans la navigation du forum. Lien direct : [<a href="{DL_FAQ_URL}">Téléchargements</a>]'
	),
	array(
		0 => 'Que signifie {DL_IMG_BLUE} ?',
		1 => 'Aucun téléchargement possible. Le trafic global défini par l’administration pour chaque téléchargement ou pour la catégorie affichée a été utilisé pour ce mois.'
	),
	array(
		0 => 'Que signifie {DL_IMG_RED} ?',
		1 => 'Aucun téléchargement possible. Cela peut être dû à :<br />- Le téléchargement est bloqué par un administrateur.<br />- L’utilisateur n’est pas connecté alors que le téléchargement n’est autorisé qu’aux utilisateurs enregistrés.<br />- L’utilisateur n’a pas assez de trafic pour télécharger ce fichier.<br />- L’administrateur a défini un nombre minimum de messages que l’utilisateur n’a pas.<br />- La limite de trafic pour ce fichier est complètement utilisée.'
	),
	array(
		0 => 'Que signifie {DL_IMG_GREY} ?',
		1 => 'Source externe. Le téléchargement sera démarré par un serveur externe. Cela sera traité comme {DL_IMG_GREEN}. Le trafic utilisateur et le trafic global ne seront pas diminués.'
	),
	array(
		0 => 'Que signifie {DL_IMG_WHITE} ?',
		1 => 'Comme {DL_IMG_GREEN}, le trafic utilisateur ne sera pas diminué. Mais seuls les utilisateurs connectés peuvent télécharger gratuitement. Le trafic global, lui, diminuera.'
	),
	array(
		0 => 'Que signifie {DL_IMG_YELLOW} ?',
		1 => 'Téléchargement possible avec restrictions. Le téléchargement n’est possible que pour les utilisateurs enregistrés. L’utilisateur doit être connecté. La taille du fichier sera déduite de votre trafic ainsi que du trafic global.'
	),
	array(
		0 => 'Que signifie {DL_IMG_GREEN} ?',
		1 => 'Téléchargement gratuit. Le téléchargement ne sera pas restreint. Ce fichier peut également être téléchargé par les invités. Vous n’avez pas besoin d’être connecté. Votre trafic ne diminuera pas, mais le trafic global diminuera.'
	),
	array(
		0 => 'Pourquoi ne puis-je télécharger aucun fichier ?',
		1 => 'Cela peut avoir de nombreuses raisons. Consultez les explications sous {DL_IMG_BLUE} et {DL_IMG_RED}.'
	),
	array(
		0 => 'Comment et quand puis-je obtenir du nouveau trafic pour mon compte ?',
		1 => 'Après la première connexion, l’utilisateur recevra un horodatage. Le premier jour de chaque mois, lorsque l’utilisateur accède aux téléchargements, son trafic sera réinitialisé. Demandez à votre administrateur quelle quantité vous sera attribuée.'
	),
	array(
		0 => 'Je veux encore télécharger un fichier, mais je n’ai plus de trafic ?',
		1 => 'Dans ce cas, demandez à l’administrateur. Lui seul peut décider d’augmenter le trafic utilisateur avant que le compte ne reçoive automatiquement un nouveau trafic le mois suivant.'
	),
	array(
		0 => 'Comment puis-je évaluer les téléchargements ?',
		1 => 'Derrière chaque téléchargement dans une catégorie ou dans la vue détaillée, vous trouverez une section d’évaluation.<br />En cliquant sur « Évaluer », un utilisateur enregistré peut noter le téléchargement de 1 point (très mauvais) à 10 points (très bon). Vous ne pouvez évaluer un téléchargement qu’une seule fois.'
	),
	array(
		0 => '--',
		1 => 'Problèmes liés à phpBB 3'
	),
	array(
		0 => 'Qui a écrit ce forum ?',
		1 => 'Ce logiciel (dans sa forme non modifiée) est produit, publié et est protégé par copyright par <a href="https://www.phpbb.com/">le groupe phpBB</a>. Il est mis à disposition sous la licence GNU General Public License et peut être librement distribué. Consultez le lien pour plus de détails.'
	),
	array(
		0 => 'Pourquoi la fonctionnalité X n’est-elle pas disponible ?',
		1 => 'Ce logiciel a été développé et est sous licence du groupe phpBB. Si vous pensez qu’une fonctionnalité devrait être ajoutée, veuillez visiter le <a href="https://www.phpbb.com/ideas/">centre d’idées phpBB</a>, où vous pouvez voter pour des idées existantes ou suggérer de nouvelles fonctionnalités.'
	),
	array(
		0 => 'Qui dois-je contacter concernant des abus et/ou des questions juridiques liées à ce forum ?',
		1 => 'L’un des administrateurs listés sur la page « L’équipe » devrait être un point de contact approprié pour vos plaintes. Si cela ne donne toujours aucune réponse, vous devriez alors contacter le propriétaire du domaine (effectuez une recherche <a href="http://www.google.com/search?q=whois">whois</a>) ou, si ce forum fonctionne sur un service gratuit (par ex. Yahoo!, free.fr, f2s.com, etc.), le service de gestion ou des abus de ce service. Veuillez noter que le groupe phpBB n’a <strong>absolument aucune juridiction</strong> et ne peut en aucun cas être tenu responsable de la manière, de l’endroit ou de la personne qui utilise ce forum. Ne contactez pas le groupe phpBB concernant toute question juridique (mise en demeure, diffamation, commentaire injurieux, etc.) <strong>non directement liée</strong> au site phpBB.com ou au logiciel phpBB lui-même. Si vous envoyez un e-mail au groupe phpBB <strong>à propos de l’utilisation par un tiers</strong> de ce logiciel, vous devez vous attendre à une réponse brève, voire à aucune réponse.'
	)
);
