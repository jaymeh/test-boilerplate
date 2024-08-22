<?php
/**
 * File for registering CSS and JavaScript.
 *
 * @package WordPress Boilerplate
 */

/**
 * Enqueues boilerplate scripts.
 *
 * @return void
 */
function boilerplate_enqueue_script() {
	Assets::register_vite_script( 'header', 'src/components/header.js', array( 'jquery' ), true );
}
add_action( 'wp_enqueue_scripts', 'boilerplate_enqueue_script' );
