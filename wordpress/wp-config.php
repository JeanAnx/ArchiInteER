<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'SiteEmilie');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'm12gi8gefxJWJRGs');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'EqR~(I)iIWW-kQaq9P)GtxKUv25Wgd%z?y3JX(TY8Z;??_e`djVik>u%*tRzqf<8');
define('SECURE_AUTH_KEY',  'DfcID|nW&`1;w^+al}ej-z`fo*u;(]L$nPY{fl%K6KJ|Crb!]7*(<7x~9;]^69[D');
define('LOGGED_IN_KEY',    'tW6(autH!fS4~4s9~LfU0lflpj_E),)m:SDZmB&aD]QWcUANBHJ>x32yS<}wi2mH');
define('NONCE_KEY',        ':b2%m=A>T`ThYntsLylN]!F`cJ:6_+^:rN?HEQ|Mkv^edrR}9N4[2jn_6*?8<e4%');
define('AUTH_SALT',        'n/+l}t/6/F1 pBSo@#H^)ue| xim]M/:i]WI:9m4|Ek;=s4ex8( /b:_+qQAapB*');
define('SECURE_AUTH_SALT', 'jWrw^}(/:|^HD>p^aQ[f)uDR>ndJc ;3] ppnBxLSdjk d`)X;qaQ/^02l~?AJ8R');
define('LOGGED_IN_SALT',   'r![j`E[y#1_oBN]/PeCL)~`4tK9n(y.MKG!4i#R8Aq1)X/A8S_,4/G+nfaZZ7}_R');
define('NONCE_SALT',       'zf{K;,,Q)Qr{&ylAjlh[n(p:TS&vNmA=Jv2n@$jJi0XlN?bGbOLid+[mTD)]VX##');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');