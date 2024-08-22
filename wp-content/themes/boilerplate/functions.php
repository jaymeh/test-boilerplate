<?php
/**
 * Theme functions file.
 *
 * @package [[[THEME_NAME]]]
 */

// Do not allow direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

// Initialise the internals for the theme.
require_once get_template_directory() . '/core/boot.php';

// Register any scripts needed.
require_once get_template_directory() . '/includes/register-scripts.php';

// Register primary menu location.
add_action(
	'after_setup_theme',
	function () {
		register_nav_menus(
			array(
				'primary' => 'Primary Menu',
			)
		);
	}
);

// Register blocks.
new CreodeBlocks\HeaderBlock();
