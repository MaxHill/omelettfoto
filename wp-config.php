<?php

if (strpos($_SERVER['SERVER_NAME'],'local') !== false) {

//flera dom�ner
define( 'WP_SITEURL','http://'.$_SERVER['SERVER_NAME'].'/omelettfoto-wp' );
define( 'WP_HOME','http://'.$_SERVER['SERVER_NAME'].'/omelettfoto-wp' );
//slut flera dom�ner


} else {
	//flera dom�ner
	define( 'WP_SITEURL','http://'.$_SERVER['SERVER_NAME'].'' );
	define( 'WP_HOME','http://'.$_SERVER['SERVER_NAME'].'' );
	//slut flera dom�ner
}


/**
 * Baskonfiguration f�r WordPress.
 *
 * Denna fil inneh�ller f�ljande konfigurationer: Inst�llningar f�r MySQL,
 * Tabellprefix, S�kerhetsnycklar, WordPress-spr�k, och ABSPATH.
 * Mer information p� {@link http://codex.wordpress.org/Editing_wp-config.php 
 * Editing wp-config.php}. MySQL-uppgifter f�r du fr�n ditt webbhotell.
 *
 * Denna fil anv�nds av wp-config.php-genereringsskript under installationen.
 * Du beh�ver inte anv�nda webbplatsen, du kan kopiera denna fil direkt till
 * "wp-config.php" och fylla i v�rdena.
 *
 * @package WordPress
 */


// ** MySQL-inst�llningar - MySQL-uppgifter f�r du fr�n ditt webbhotell ** //
/** Namnet p� databasen du vill anv�nda f�r WordPress */
define('DB_NAME', 'raketnu_omelettfoto');

/** MySQL-databasens anv�ndarnamn */
define('DB_USER', 'raketnu_omelett');

/** MySQL-databasens l�senord */
define('DB_PASSWORD', 'raket14');

/** MySQL-server */
define('DB_HOST', 'raket.nu');

/** Teckenkodning f�r tabellerna i databasen. */
define('DB_CHARSET', 'utf8');

/** Kollationeringstyp f�r databasen. �ndra inte om du �r os�ker. */
define('DB_COLLATE', '');

/**#@+
 * Unika autentiseringsnycklar och salter.
 *
 * �ndra dessa till unika fraser!
 * Du kan generera nycklar med {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Du kan n�r som helst �ndra dessa nycklar f�r att g�ra aktiva cookies obrukbara, vilket tvingar alla anv�ndare att logga in p� nytt.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Ange en unik fras h�r');
define('SECURE_AUTH_KEY',  'Ange en unik fras h�r');
define('LOGGED_IN_KEY',    'Ange en unik fras h�r');
define('NONCE_KEY',        'Ange en unik fras h�r');
define('AUTH_SALT',        'Ange en unik fras h�r');
define('SECURE_AUTH_SALT', 'Ange en unik fras h�r');
define('LOGGED_IN_SALT',   'Ange en unik fras h�r');
define('NONCE_SALT',       'Ange en unik fras h�r');

/**#@-*/

/**
 * Tabellprefix f�r WordPress Databasen.
 *
 * Du kan ha flera installationer i samma databas om du ger varje installation ett unikt
 * prefix. Endast siffror, bokst�ver och understreck!
 */
$table_prefix  = 'wp_';

/**
 * WordPress-spr�k, f�rinst�llt f�r svenska.
 *
 * Du kan �ndra detta f�r att �ndra spr�k f�r WordPress.  En motsvarande .mo-fil
 * f�r det valda spr�ket m�ste finnas i wp-content/languages. Exempel, l�gg till
 * sv_SE.mo i wp-content/languages och ange WPLANG till 'sv_SE' f�r att f� sidan
 * p� svenska.
 */
define('WPLANG', 'sv_SE');

/** 
 * F�r utvecklare: WordPress fels�kningsl�ge. 
 * 
 * �ndra detta till true f�r att aktivera meddelanden under utveckling. 
 * Det �r rekommderat att man som till�ggsskapare och temaskapare anv�nder WP_DEBUG 
 * i sin utvecklingsmilj�. 
 */ 
define('WP_DEBUG', false);

/* Det var allt, sluta redigera h�r! Blogga p�. */

/** Absoluta s�kv�g till WordPress-katalogen. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Anger WordPress-v�rden och inkluderade filer. */
require_once(ABSPATH . 'wp-settings.php');