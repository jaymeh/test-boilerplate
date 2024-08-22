<?php

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/** Authentication Unique Keys and Salts. */
define( 'AUTH_KEY', 'aoxwWyiruwYVSJrsgvZmHrMdqKTHTbqbxYWgDxqlEdwPKWtJVCTKgCCntUGPXHOT' );
define( 'SECURE_AUTH_KEY', 'jvwJWiBLiPGJaGYoILIeLEsPgOVaLZLHixZKwtysRowCQNjhuaANlcoJcClutNkt' );
define( 'LOGGED_IN_KEY', 'qeVPfemCTgKJnpzVHRbryanidjrDrMmtADuMlBlpncqXwVqIKHKVHRFmNxcqhnYl' );
define( 'NONCE_KEY', 'VJzMqbszeinvQWAbDIUENByYSULuFySsTeQTpnMXQRmrZPdhzskObiMeRFIqaBnd' );
define( 'AUTH_SALT', 'kvsdYuHylkdJCOrjElrbnUYkNpaKiIBYGJDAnrNfnVZOaRdjlzrCYASVjYqLyeSc' );
define( 'SECURE_AUTH_SALT', 'vbuPIwwAdBSrpCmlYseUFrCQFMNiUnSeyiwuazuraMAgYAnzprNnOqCtuAYvBVld' );
define( 'LOGGED_IN_SALT', 'xfSagDtSMqCLCUyOmeRUvsThKulAJWouWnYyRGbFDCcxJCnfBhaNuWWdDPdMaXbu' );
define( 'NONCE_SALT', 'xEAanYnmKnaEWwchOBJZocguXzYKRsJGVcetzgKOXzlqkumzKDVRGFvxcANDiJEz' );

/** Absolute path to the WordPress directory. */
defined( 'ABSPATH' ) || define( 'ABSPATH', dirname( __FILE__ ) . '/' );

// Include for settings managed by ddev.
$ddev_settings = dirname( __FILE__ ) . '/wp-config-ddev.php';
if ( ! defined( 'DB_USER' ) && getenv( 'IS_DDEV_PROJECT' ) == 'true' && is_readable( $ddev_settings ) ) {
	require_once( $ddev_settings );
}

// Include local settings.
$local_settings = dirname( __FILE__ ) . '/wp-config-local.php';
if ( is_readable( $local_settings ) ) {
	require_once( $local_settings );
}

if ( ! defined( 'DISALLOW_FILE_MODS' ) ) {
	define( 'DISALLOW_FILE_MODS', true );
}

/** Include wp-settings.php */
if ( file_exists( ABSPATH . '/wp-settings.php' ) ) {
	require_once ABSPATH . '/wp-settings.php';
}
