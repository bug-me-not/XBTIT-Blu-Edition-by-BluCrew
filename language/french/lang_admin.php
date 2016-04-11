<?php
$language["ACP_BAN_IP"]="Bannir IP";
$language["ACP_FORUM"]="Configurer le forum";
$language["ACP_USER_GROUP"]="Configurer les groupes";
$language["ACP_STYLES"]="Configurer le style";
$language["ACP_LANGUAGES"]="Configurer la langue";
$language["ACP_CATEGORIES"]="Configurer les catégories";
$language["ACP_TRACKER_SETTINGS"]="Configurer le tracker";
$language["ACP_OPTIMIZE_DB"]="Optimiser la bdd";
$language["ACP_CENSORED"]="Configurer les mots censurés";
$language["ACP_DBUTILS"]="Utilitaire de la bdd";
$language["ACP_HACKS"]="Hacks";
$language["ACP_HACKS_CONFIG"]="Configurer hacks";
$language["ACP_MODULES"]="Modules";
$language["ACP_MODULES_CONFIG"]="Configurer les modules";
$language["ACP_MASSPM"]="MP de masse";
$language["ACP_PRUNE_TORRENTS"]="Èlaguage des torrents";
$language["ACP_PRUNE_USERS"]="Èlaguage des utilisateurs";
$language["ACP_SITE_LOG"]="Voir le journal";
$language["ACP_SEARCH_DIFF"]="Chercher une diff.";
$language["ACP_BLOCKS"]="Configurer les blocs";
$language["ACP_POLLS"]="Configurer les sondages";
$language["ACP_MENU"]="Menu d'administration";
$language["ACP_FRONTEND"]="Configurer le contenu";
$language["ACP_USERS_TOOLS"]="Outils des utilisateurs";
$language["ACP_TORRENTS_TOOLS"]="Outils des torrents";
$language["ACP_OTHER_TOOLS"]="Outils divers";
$language["ACP_MYSQL_STATS"]="Stats MySQL";
$language["XBTT_BACKEND"]="Option xbtt";
$language["XBTT_USE"]=" <a href=\"http://xbtt.sourceforge.net/tracker/\" target=\"_blank\">xbtt</a> as backend?"; // Pas de trad
$language["XBTT_URL"]="URL de base de xbtit http://localhost:2710";
$language["GENERAL_SETTINGS"]="Configuration générale";
$language["TRACKER_NAME"]="Nom du site";
$language["TRACKER_BASEURL"]="Url de base (sans / à la fin)";
$language["TRACKER_ANNOUNCE"]="URL d'annonce du tracker (une par ligne)".($XBTT_USE?"<br />\n<span style=\"color:#FF0000; font-weight: bold;\">Vérifiez les doublons !</span>":"");
$language["TRACKER_EMAIL"]="Adresse du fondateur";
$language["TORRENT_FOLDER"]="Dossier des torrents";
$language["ALLOW_EXTERNAL"]="Permettre les torrents externes";
$language["ALLOW_GZIP"]="Compression GZIP";
$language["ALLOW_DEBUG"]="Afficher la fenêtre de deboguage d'infos sur la page du bas";
$language["ALLOW_DHT"]="Désactiver DHT<br />\nSera mis uniquement sur les nouveaux torrents";
$language["ALLOW_LIVESTATS"]="Activer les stats en direct (Attention, ceci peut surchargé le serveur !)";
$language["ALLOW_SITELOG"]="Activer le fichier journal";
$language["ALLOW_HISTORY"]="Activer l'historique";
$language["ALLOW_PRIVATE_ANNOUNCE"]="Annonce privé";
$language["ALLOW_PRIVATE_SCRAPE"]="Scrape privé";
$language["SHOW_UPLOADER"]="Montrer le pseudo de l'uploadeur";
$language["USE_POPUP"]="Utiliser un popup pour les détails des torrents";
$language["DEFAULT_LANGUAGE"]="Language par defaut";
$language["DEFAULT_CHARSET"]="L'encodage des caractères par défaut<br />\n(si votre langue ne s'affichent pas correctement, essayez UTF-8)";
$language["DEFAULT_STYLE"]="Style par défaut";
$language["MAX_USERS"]="Nombre max. d'utilisateurs (0 = illimite)";
$language["MAX_TORRENTS_PER_PAGE"]="Torrents par page";
$language["SPECIFIC_SETTINGS"]="Configuration spécifique au tracker";
$language["SETTING_INTERVAL_SANITY"]="Intervalle d'élaguage (0 = désactivé, nombre en secondes)<br />La valeur conseillée est de 1800 (30 minutes)";
$language["SETTING_INTERVAL_EXTERNAL"]="Mise à jour externe (0 = désactivé, nombre en secondes)<br />En fonction du nombre de torrents externes";
$language["SETTING_INTERVAL_MAX_REANNOUNCE"]="Intervalle max. de ré-annonce (nombre en secondes)";
$language["SETTING_INTERVAL_MIN_REANNOUNCE"]="Intervalle min. de ré-annonce (nombre en secondes)";
$language["SETTING_MAX_PEERS"]="Nombre max. de partages par requêtes (chiffre)";
$language["SETTING_DYNAMIC"]="Permettre les torrents dynamique (Non recommandé)";
$language["SETTING_NAT_CHECK"]="Verification NAT";
$language["SETTING_PERSISTENT_DB"]="Connexion persistante (Bdd, non recommandé)";
$language["SETTING_OVERRIDE_IP"]="Permettre aux utilisateurs de passer outre la détection d'IP";
$language["SETTING_CALCULATE_SPEED"]="Calculer la vitesse (octets)";
$language["SETTING_PEER_CACHING"]="Mettre les tables en caches (devrait diminuer la charge)";
$language["SETTING_SEEDS_PID"]="Nombre max de seeders par PID";
$language["SETTING_LEECHERS_PID"]="Nombre max. de leechers par PID";
$language["SETTING_VALIDATION"]="Mode de validation";
$language["SETTING_CAPTCHA"]="Anti-bot (Code image)";
$language["SETTING_FORUM"]="Le lien du forum, peut être :<br /><li><font color='#FF0000'>Interne</font> ou vide si vous utilisez le forum interne</li><li><font color='#FF0000'>smf</font> pour intégrer <a target='_new' href='http://www.simplemachines.org'>Simple Machines Forum</a></li><li>Votre propre forum (spécifiez l'url)</li>";
$language["BLOCKS_SETTING"]="Configurer les pages Index/Blocs";
$language["SETTING_CLOCK"]="Type d'horloge";
$language["SETTING_NUM_NEWS"]="Limite d'affichage des nouvelles infos (chiffre)";
$language["SETTING_NUM_POSTS"]="Limite d'affichage des nouveaux forum (chiffre)";
$language["SETTING_NUM_LASTTORRENTS"]="Limite d'affichage des derniers torrents (chiffre)";
$language["SETTING_NUM_TOPTORRENTS"]="Limite d'affichage des torrents les plus populaires (chiffre)";
$language["CLOCK_ANALOG"]="Analogique";
$language["CLOCK_DIGITAL"]="Digitale";
$language["CONFIG_SAVED"]="La configuration à bien été prise en compte !";
$language["CACHE_SITE"]="Intervalle de mise en cache (0 = désactivé, nombre en secondes)";
$language["ALL_FIELDS_REQUIRED"]="Tous les champs sont obligatoires !";
$language["SETTING_CUT_LONG_NAME"]="Couper le nom des torrent trop long aprés x caratéres (0 = pour ne pas couper)";
$language["MAILER_SETTINGS"]="Expéditeur";
$language["SETTING_MAIL_TYPE"]="Type de courriel";
$language["SETTING_SMTP_SERVER"]="Server SMTP";
$language["SETTING_SMTP_PORT"]="Port SMTP";
$language["SETTING_SMTP_USERNAME"]="Nom d'utilisateur SMTP";
$language["SETTING_SMTP_PASSWORD"]="Mot de passe SMTP";
$language["SETTING_SMTP_PASSWORD_REPEAT"]="Mot de passe SMTP (confirmation)";
$language["XBTT_TABLES_ERROR"]="Vous devez insérer un tableau xbtt (voir fichier d'aide)";
$language["XBTT_URL_ERROR"]="L'URL de base est obligatoire";

// BAN FORM
$language["BAN_NOTE"]="Dans cette partie du panneau d'administration, vous pouvez voir les IP bannies.<br />\nVous devez insérer une gamme de (première IP) (dernière IP).";
$language["BAN_NOIP"]="Il n'y a pas d'IP bannies";
$language["BAN_FIRSTIP"]="Première IP";
$language["BAN_LASTIP"]="Dernière IP";
$language["BAN_COMMENTS"]="Commentaires";
$language["BAN_REMOVE"]="Supprimer";
$language["BAN_BY"]="Par";
$language["BAN_ADDED"]="Date";
$language["BAN_INSERT"]="Ajouter une nouvelle gamme d'IP bannies";
$language["BAN_IP_ERROR"]="Mauvaise adresse IP.";
$language["BAN_NO_IP_WRITE"]="Vous n'avez pas écrit d'adresse IP. Désolé !";
$language["BAN_DELETED"]="La gamme d'adresse IP a été supprimée de la bdd.<br />\n<br />\n<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=banip&amp;action=read\">Retour</a>";

// LANGUAGES
$language["LANGUAGE_SETTINGS"]="Configurer le language";
$language["LANGUAGE"]="Language";
$language["LANGUAGE_ADD"]="Insérer une nouvelle langue";
$language["LANGUAGE_SAVED"]="Félicitations, les changement ont bien été prit en compte !";

// STYLES
$language["STYLE_SETTINGS"]="Configuration du style";
$language["STYLE_EDIT"]="Èditer le style";
$language["STYLE_ADD"]="Insérer un style";
$language["STYLE_NAME"]="Nom du style";
$language["STYLE_URL"]="Lien du style";
$language["STYLE_FOLDER"]="Dossier du style ";
$language["STYLE_NOTE"]="Dans cette section, vous pouvez gérer vos paramêtres de style, mais vous devez transférer des fichiers par FTP ou sftp.";

// CATEGORIES
$language["CATEGORY_SETTINGS"]="Configurer les catégories";
$language["CATEGORY_IMAGE"]="Images des catégories";
$language["CATEGORY_ADD"]="Créer une nouvelle catégorie";
$language["CATEGORY_SORT_INDEX"]="Index court";
$language["CATEGORY_FULL"]="Catégorie";
$language["CATEGORY_EDIT"]="Èditer la catégorie";
$language["CATEGORY_SUB"]="Sous-catégorie";
$language["CATEGORY_NAME"]="Catégorie";

// CENSORED
$language["CENSORED_NOTE"]="Ècrire <b>un mot par ligne</b> pour le censurer (sera transformé en *censuré*)";
$language["CENSORED_EDIT"]="Èditer";

// BLOCKS
$language["BLOCKS_SETTINGS"]="Configurer les blocs";
$language["ENABLED"]="Activer";
$language["ORDER"]="Ordre";
$language["BLOCK_NAME"]="Nom du bloc";
$language["BLOCK_POSITION"]="Position";
$language["BLOCK_TITLE"]="Titre du language (sera utilisé pour afficher le titre traduit)";
$language["BLOCK_USE_CACHE"]="Mettre en cache ce bloc ?";
$language["ERR_BLOCK_NAME"]="Vous devez sélectionner quelque chose dans la liste déroulante !";
$language["BLOCK_ADD_NEW"]="Ajouter un nouveau bloc";

// POLLS (more in lang_polls.php)
$language["POLLS_SETTINGS"]="Configurer le sondage";
$language["POLLID"]="Identifiant du sondage";
$language["INSERT_NEW_POLL"]="Ajouter un nouveau sondage";
$language["CANT_FIND_POLL"]="Ne peut trouver le sondage";
$language["ADD_NEW_POLL"]="Ajouter un sondage";

// GROUPS
$language["USER_GROUPS"]="Configurer le groupe";
$language["VIEW_EDIT_DEL"]="Voir/Èditer/Supprimer";
$language["CANT_DELETE_GROUP"]="Ce niveau/groupe ne peut être annulé !";
$language["GROUP_NAME"]="Nom du groupe";
$language["GROUP_VIEW_NEWS"]="Voir les nouvelles";
$language["GROUP_VIEW_FORUM"]="Voir le forum";
$language["GROUP_EDIT_FORUM"]="Èditer le forum";
$language["GROUP_BASE_LEVEL"]="Choisir le niveau de base";
$language["GROUP_ERR_BASE_SEL"]="Erreur de sélection du niveau de base !";
$language["GROUP_DELETE_NEWS"]="Supprimer la nouvelle";
$language["GROUP_PCOLOR"]="Couleur du prefixe (comme ";
$language["GROUP_SCOLOR"]="Couleur du suffixe (comme ";
$language["GROUP_VIEW_TORR"]="Voir les torrents";
$language["GROUP_EDIT_TORR"]="Èditer les torrents";
$language["GROUP_VIEW_USERS"]="Voir les utilisateurs";
$language["GROUP_DELETE_TORR"]="Supprimer les torrents";
$language["GROUP_EDIT_USERS"]="Èditer les utilisateurs";
$language["GROUP_DOWNLOAD"]="Peut télécharger";
$language["GROUP_DELETE_USERS"]="Supprimer l'utilisateur";
$language["GROUP_DELETE_FORUM"]="Supprimer le forum";
$language["GROUP_GO_CP"]="Peut accèder au panneau d'administration";
$language["GROUP_EDIT_NEWS"]="Èditer les nouvelles";
$language["GROUP_ADD_NEW"]="Ajouter un nouveau groupe";
$language["GROUP_UPLOAD"]="Peut uploader";
$language["GROUP_WT"]="Temps d'attente si le ratio <1";
$language["GROUP_EDIT_GROUP"]="Èditer le groupe";
$language["GROUP_VIEW"]="Voir";
$language["GROUP_EDIT"]="Èditer";
$language["GROUP_DELETE"]="Supprimer";
$language["INSERT_USER_GROUP"]="Insérer un nouveau groupe d'utilisateurs";
$language["ERR_CANT_FIND_GROUP"]="Impossible de trouver le groupe !";
$language["GROUP_DELETED"]="Le groupe à bien été supprimé !";

// MASS PM
$language["USERS_FOUND"]="Utilisateurs trouvés";
$language["USERS_PMED"]="Utilisateurs MP";
$language["WHO_PM"]="Destinataires";
$language["MASS_SENT"]="MP de masse envoyés !!!";
$language["MASS_PM"]="MP de masse";
$language["MASS_PM_ERROR"]="Ècrivez quelque chose avant d'envoyé !!";
$language["RATIO_ONLY"]="ce ratio seulement";
$language["RATIO_GREAT"]="supérieur à ce ratio";
$language["RATIO_LOW"]="inférieur à ce ratio";
$language["RATIO_FROM"]="De";
$language["RATIO_TO"]="Pour";
$language["MASSPM_INFO"]="Info";

// PRUNE USERS
$language["PRUNE_USERS_PRUNED"]="Utilisateurs bannis";
$language["PRUNE_USERS"]="Bannir l'utilisateur";
$language["PRUNE_USERS_INFO"]="Entrez le nombre de jours pendant lesquels les utilisateurs doivent être considérés comme \"inactif\"";

// SEARCH DIFF
$language["SEARCH_DIFF"]="Chercher une diff.";
$language["SEARCH_DIFF_MESSAGE"]="Message";
$language["DIFFERENCE"]="Différence";
$language["SEARCH_DIFF_CHANGE_GROUP"]="Changer le groupe";

// PRUNE TORRENTS
$language["PRUNE_TORRENTS_PRUNED"]="Torrent bannis";
$language["PRUNE_TORRENTS"]="Torrents bannis";
$language["PRUNE_TORRENTS_INFO"]="Entrez le nombre de jours pendant lesquels les torrents doivent être considérés comme \"inactif\"";
$language["LEECHERS"]="leecher(s)";
$language["SEEDS"]="seed(s)";

// DBUTILS
$language["DBUTILS_TABLENAME"]="Nom de la table";
$language["DBUTILS_RECORDS"]="Enregistrements";
$language["DBUTILS_DATALENGTH"]="Longueur des données";
$language["DBUTILS_OVERHEAD"]="Dépacement";
$language["DBUTILS_REPAIR"]="Réparer";
$language["DBUTILS_OPTIMIZE"]="Optimiser";
$language["DBUTILS_ANALYSE"]="Analyser";
$language["DBUTILS_CHECK"]="Contrôler";
$language["DBUTILS_DELETE"]="Supprimer";
$language["DBUTILS_OPERATION"]="Opération";
$language["DBUTILS_INFO"]="Info";
$language["DBUTILS_STATUS"]="Statut";
$language["DBUTILS_TABLES"]="Tables";

// MYSQL STATUS
$language["MYSQL_STATUS"]="Statut de MySQL";

// SITE LOG
$language["SITE_LOG"]="Journal";

// FORUMS
$language["FORUM_MIN_CREATE"]="Droit minimum de création";
$language["FORUM_MIN_WRITE"]="Droit minimum d'écriture";
$language["FORUM_MIN_READ"]="Droit minimum de lecture";
$language["FORUM_SETTINGS"]="Configuration du forum";
$language["FORUM_EDIT"]="Èditer le forum";
$language["FORUM_ADD_NEW"]="Ajouter un nouveau forum";
$language["FORUM_PARENT"]="Forum parent";
$language["FORUM_SORRY_PARENT"]="(Desolé, je ne peux pas avoir de parent, parce que je suis moi-meme un forum parent)";
$language["FORUM_PRUNE_1"]="Il y a des sujets et/ou messages dans ce forum !<br />Vous perdrez toutes les données...<br />";
$language["FORUM_PRUNE_2"]="Si vous êtes sur";
$language["FORUM_PRUNE_3"]="sinon faîtes retour.";
$language["FORUM_ERR_CANNOT_DELETE_PARENT"]="Vous ne pouvez pas supprimer un forum qui possède des fils, déplacez l'enfant vers d'autres forums et essayez à nouveau";

// MODULES
$language["ADD_NEW_MODULE"]="Ajouter un nouveau module";
$language["TYPE"]="Type";
$language["DATE_CHANGED"]="La date a été changée";
$language["DATE_CREATED"]="La date a été créée";
$language["ACTIVE_MODULES"]="Modules actifs : ";
$language["NOT_ACTIVE_MODULES"]="Modules inactifs : ";
$language["TOTAL_MODULES"]="Modules totaux : ";
$language["DEACTIVATE"]="Désactivé";
$language["ACTIVATE"]="Activé";
$language["STAFF"]="Èquipe";
$language["MISC"]="Divers";
$language["TORRENT"]="Torrent";
$language["STYLE"]="Style";
$language["ID_MODULE"]="ID";

// HACKS
$language["HACK_TITLE"]="Titre";
$language["HACK_VERSION"]="Version";
$language["HACK_AUTHOR"]="Auteur";
$language["HACK_ADDED"]="Ajouté";
$language["HACK_NONE"]="Il n'y a pas de hacks installés";
$language["HACK_ADD_NEW"]="Ajouter un hack";
$language["HACK_SELECT"]="Sélectionner";
$language["HACK_STATUS"]="Statut";
$language["HACK_INSTALL"]="Installer";
$language["HACK_UNINSTALL"]="Désinstaller";
$language["HACK_INSTALLED_OK"]="Le hack a été installé avec succès!<br />\nPour voir quels hacks sont installés retour au <a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=hacks&amp;action=read\">panneau d'administration (Hacks)</a>";
$language["HACK_BAD_ID"]="Erreur de récupération des informations sur le hack avec cet ID.";
$language["HACK_UNINSTALLED_OK"]="Le hack a été désinstallé avec succès!<br />\nPour voir quels hacks sont installés retour au <a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=hacks&amp;action=read\">panneau d'administration (Hacks)</a>";
$language["HACK_OPERATION"]="Opération";
$language["HACK_SOLUTION"]="Solution";

// ADDED REV 520
$language["HACK_WHY_FTP"]="Certains fichiers de l'installateur du hack ne sont pas inscriptibles. <br />\nVous devez mettre vos fichiers en CHMOD 777 sur votre serveur. <br />\nLes informations de votre FTP peuvent être temporairement misent en cache pour le fonctionnement correct de l'installateur de hack.";
$language["HACK_FTP_SERVER"]="Serveur du FTP";
$language["HACK_FTP_PORT"]="Port du FTP";
$language["HACK_FTP_USERNAME"]="Nom d'utilisateur du FTP";
$language["HACK_FTP_PASSWORD"]="Mot de passe du FTP";
$language["HACK_FTP_BASEDIR"]="Chemin d'accès local pour xbtit (chemin de la racine lorsque vous vous connectez via FTP)";

// USERS TOOLS
$language["USER_NOT_DELETE"]="Vous ne pouvez pas supprimer l'utilisateur Invité ou vous meme !";
$language["USER_NOT_EDIT"]="Vous ne pouvez pas éditer l'utilisateur Invité ou vous-meme !";

// MANUAL HACK INSTALL
$language['MHI_VIEW_INSRUCT'] = 'Voir les instructions d\'installation manuel ?';
$language['MHI_MAN_INSRUCT_FOR'] = 'Instructions d\'installation manuel pour';
$language['MHI_RUN_QUERY'] = 'Lancez la requête SQL par phpMyAdmin';
$language['MHI_IN'] = 'Dans';
$language['MHI_ALSO_IN'] = 'Aussi dans';
$language['MHI_FIND_THIS'] = 'trouvez ceci';
$language['MHI_ADD_THIS'] = 'Ajoutez cela';
$language['MHI_IT'] = 'il';
$language['MHI_REPLACE'] = 'Remplacez avec';
$language['MHI_COPY'] = 'Copier';
$language['MHI_AS'] = 'en';

// SECURITE SUITE
$language["ACP_SECSUI_SET"]="R&eacute;glages de la Suite de S&eacute;curit&eacute;";
$language["SECSUI_QUAR_SETTING"]="R&eacute;glages de quarantaine des fichiers envoy&eacute;s";
$language["SECSUI_QUAR_TERMS_1"]="Termes de recherche de quarantaine (une par ligne)";
$language["SECSUI_QUAR_TERMS_2"]="S'il vous plaît ajouter ci-dessous des mots qui vont déclencher le fichier de quarantaine :";
$language["SECSUI_QUAR_TERMS_3"]="REMARQUE : Il n'est pas conseillé d'ajouter <b>&lt;?php</b> et <b>?&gt;</b>,  car ils peuvent se produire naturellement dans le fichier, vous devez définir la valeur de <b>short_open_tag</b> &agrave; <b>Off</b> dans le fichier php.ini, cela empêchera votre site d'exécuter du code php qui commence avec <b>&lt?</b> et va forcer les potentiels pirates &agrave; utiliser le longue php open tag.<br /><br />La valeur PHP actuelle est :</b><br />";
$language["SECSUI_QUAR_DIR_1"]="Dossier de quarantaine";
$language["SECSUI_QUAR_DIR_2"]="Ce dossier devrait idéalement être impossible d'accés via l'Internet et au moins un niveau au-dessus de votre dossier racine de votre tracker par exemple :";
$language["SECSUI_QUAR_DIR_3"]="S'il vous plaît assurez vous que le CHOWN/CHMOD de ce répertoire soit de manière appropriée afin que le serveur puisse y écrire des fichiers.";
$language["SECSUI_QUAR_PM"]="ID utilisateur pour envoyer les messages des fichiers mis en quarantaine";
$language["SECSUI_QUAR_INV_USR"]="Utilisateur invalide";
$language["SECSUI_PASS_SETTINGS"]="R&eacute;glages du mot de passe";
$language["SECSUI_PASS_TYPE"]="M&eacute;thode de hachage du mot de passe";
$language["SECSUI_PASS_INFO"]="Ici vous pouvez s&eacute;lectionner l'algorithme de hachage du mot de passe que xbtit utilisera quand il le m&eacute;morisera dans la base :";
$language["SECSUI_NO_MEMBER"]="Aucun utilisateur dans le site avec cet id";
$language["SECSUI_GAZ_TITLE"]="Gazelle Site Salt";
$language["SECSUI_GAZ_DESC"]="&nbsp;Vous devez définir une valeur aléatoire ici, une fois mise vous ne devriez pas le changer, tout le monde aura &agrave; r&eacute;cup&eacute;rer leurs mots de passe.";
$language["SECSUI_COOKIE_SETTINGS"]="R&eacute;glages du cookie";
$language["SECSUI_COOKIE_PRIMARY"]="R&eacute;glages du cookie principal";
$language["SECSUI_COOKIE_TYPE"]="Type de cookie";
$language["SECSUI_COOKIE_EXPIRE"]="Le cookie expirera dans";
$language["SECSUI_COOKIE_T1"]="Classic xbtit";
$language["SECSUI_COOKIE_T2"]="New xbtit (Regular)";
$language["SECSUI_COOKIE_T3"]="New xbtit (Session)";
$language["SECSUI_COOKIE_NAME"]="Nom du cookie";
$language["SECSUI_COOKIE_ITEMS"]="Items du cookie";
$language["SECSUI_COOKIE_PATH"]="Chemin du cookie";
$language["SECSUI_COOKIE_DOMAIN"]="Domaine du cookie";
$language["SECSUI_COOKIE_MIN"]="Minute";
$language["SECSUI_COOKIE_MINS"]="Minutes";
$language["SECSUI_COOKIE_HOUR"]="Heure";
$language["SECSUI_COOKIE_HOURS"]="Heures";
$language["SECSUI_COOKIE_DAY"]="Jour";
$language["SECSUI_COOKIE_DAYS"]="Jours";
$language["SECSUI_COOKIE_WEEK"]="Semaine";
$language["SECSUI_COOKIE_WEEKS"]="Semaines";
$language["SECSUI_COOKIE_MONTH"]="Mois";
$language["SECSUI_COOKIE_MONTHS"]="Mois";
$language["SECSUI_COOKIE_YEAR"]="Ann&eacute;e";
$language["SECSUI_COOKIE_YEARS"]="Ann&eacute;es";
$language["SECSUI_COOKIE_TOO_FAR"]="Je suis désolé, ce serait mettre la dernière date d'expiration de la limite actuelle au mardi 19 Janvier 2038 03:14:07 GMT, s'il vous plaît ajuster votre date d'expiration en conséquence!";
$language["SECSUI_COOKIE_PSALT"]="Mot de passe Salt ";
$language["SECSUI_COOKIE_UAGENT"]="Agent utilisateur ";
$language["SECSUI_COOKIE_ALANG"]="Accepte la langue ";
$language["SECSUI_COOKIE_IP"]="Adresse IP ";
$language["SECSUI_COOKIE_DEF"]="REMARQUE : Tous les types de cookies auront les valeurs suivantes par défaut :<br /><br /><li>Tracker ID</li><li>Password Hash</li><li>Random Number</li>";
$language["SECSUI_COOKIE_PD"]="REMARQUE: Si vous ne savez pas quoi mettre pour le \"chemin du cookie\" ou pour le \"Domaine du Cookie\", vous pouvez les laisser vides et les valeurs par défaut seront utilis&eacute;e";
$language["SECSUI_COOKIE_IP_TYPE_1"] = "1st octet only (Y.N.N.N)";
$language["SECSUI_COOKIE_IP_TYPE_2"] = "2nd octet only (N.Y.N.N)";
$language["SECSUI_COOKIE_IP_TYPE_3"] = "3rd octet only (N.N.Y.N)";
$language["SECSUI_COOKIE_IP_TYPE_4"] = "4th octet only (N.N.N.Y)";
$language["SECSUI_COOKIE_IP_TYPE_5"] = "1st & 2nd octets (Y.Y.N.N)";
$language["SECSUI_COOKIE_IP_TYPE_6"] = "2nd & 3rd octets (N.Y.Y.N)";
$language["SECSUI_COOKIE_IP_TYPE_7"] = "3rd & 4th octets (N.N.Y.Y)";
$language["SECSUI_COOKIE_IP_TYPE_8"] = "1st & 3rd octets (Y.N.Y.N)";
$language["SECSUI_COOKIE_IP_TYPE_9"] = "1st & 4th octets (Y.N.N.Y)";
$language["SECSUI_COOKIE_IP_TYPE_10"] = "2nd & 4th octets (N.Y.N.Y)";
$language["SECSUI_COOKIE_IP_TYPE_11"] = "1st, 2nd & 3rd octets (Y.Y.Y.N)";
$language["SECSUI_COOKIE_IP_TYPE_12"] = "2nd, 3rd & 4th octets (N.Y.Y.Y)";
$language["SECSUI_COOKIE_IP_TYPE_13"] = "Entire IP address (Y.Y.Y.Y)";
$language["SECSUI_PASSHASH_TYPE_1"] = "Classic xbtit";
$language["SECSUI_PASSHASH_TYPE_2"] = "TBDev";
$language["SECSUI_PASSHASH_TYPE_3"] = "TorrentStrike";
$language["SECSUI_PASSHASH_TYPE_4"] = "Gazelle";
$language["SECSUI_PASSHASH_TYPE_5"] = "Simple Machines Forum";
$language["SECSUI_PASSHASH_TYPE_6"] = "New xbtit";
$language["SECSUI_PASS_MUST"] = "Le mot de passe doit";
$language["SECSUI_PASS_BE_AT_LEAST"] = "&Ecirc;tre au moins de ";
$language["SECSUI_PASS_HAVE_AT_LEAST"] = "Avoir au moins ";
$language["SECSUI_PASS_CHAR_IN_LEN"] = "caract&egrave;re de long ";
$language["SECSUI_PASS_CHAR_IN_LEN_A"] = "caract&egrave;res de long ";
$language["SECSUI_PASS_LC_LET"] = "lettre minuscule";
$language["SECSUI_PASS_LC_LET_A"] = "lettres minuscule";
$language["SECSUI_PASS_UC_LET"] = "lettre majuscule";
$language["SECSUI_PASS_UC_LET_A"] = "lettres majuscule";
$language["SECSUI_PASS_NUM"] = "nombre";
$language["SECSUI_PASS_NUM_A"] = "nombres";
$language["SECSUI_PASS_SYM"] = "symbole";
$language["SECSUI_PASS_SYM_A"] = "symboles";
$language["SECSUI_PASS_ERR_1"] = "Vous ne pouvez pas avoir une valeur plus &eacute;lev&eacute;e pour les majuscules + minuscules + chiffres + symboles";
$language["SECSUI_PASS_ERR_2"] = "que vous avez pour le nombre de caract&egrave;res minimum n&eacute;cessaire pour le mot de passe";
//  AJOUTS MANQUANT
$language["USERNAME"]="Nom d'utilisateur ";
$language["SUBMIT"]="Valider";

?>