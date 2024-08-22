<?php

require_once __DIR__ . '/includes/class-file-string-replacer.php';

// Prompt for the replacement.
// Site name, snake-case e.g. my-site.
echo 'What is the theme (e.g. "Creode Theme"): ';
$theme_name = rtrim( fgets( STDIN ) );

// Convert the theme name to snake-case.
$theme_slug = strtolower( str_replace( ' ', '-', $theme_name ) );

// Replace the theme name and slug.
$file_replacer = new File_String_Replacer();
$file_replacer->replace(
	$keys = array(
		'[[[THEME_NAME]]]',
		'[[[THEME_SLUG]]]',
	),
	array(
		$theme_name,
		$theme_slug,
	),
	array(
		'wp-content/themes/boilerplate',
		'composer.json'
	)
);

// Rename the boilerplate theme to the slug.
exec( 'mv wp-content/themes/boilerplate wp-content/themes/' . $theme_slug );

// Check if WordPress is installed.
if ( ! file_exists( ABSPATH . 'wp-load.php' ) ) {
	WP_CLI::runcommand(
		'core download',
		array(
			'command_args' => [ '--skip-content' ],
		)
	);
}

$pwd = bin2hex(openssl_random_pseudo_bytes(8));

$ddev_url = getenv('DDEV_PRIMARY_URL');

exec('composer install');

WP_CLI::runcommand(
	'core install',
	array(
		'command_args' => array(
			"--url='$ddev_url'",
			"--title=WordPress",
			'--admin_user=admin',
			"--admin_password='$pwd'",
			'--admin_email="dev@creode.co.uk"',
		)
	)
);

echo 'WordPress installed. Admin password: ' . $pwd . PHP_EOL;

// Build assets on boilerplate.
exec( "cd wp-content/themes/$theme_slug && npm install && npm run build" );

// Load in the json config.
$config = json_decode( file_get_contents( 'boilerplate/config.json' ), true );

// Active the theme.
WP_CLI::runcommand( 'theme activate ' . $theme_slug );

// Load in the plugins.
foreach ($config['plugins'] as $plugin) {
	WP_CLI::runcommand('plugin install ' . $plugin, array(
		'command_args' => ['--activate'],
	));
}

echo 'Please provide your ACF Pro Key: ';
$acf_pro_key = rtrim( fgets( STDIN ) );

// Download ACF Pro.
$plugin_path = WP_CLI::runcommand(
	'plugin path',
	array(
		'return'     => true,
		'exit_error' => false,
	)
);

// Install the plugin.
exec("wget -O $plugin_path/acf-pro.zip " . '"https://connect.advancedcustomfields.com/v2/plugins/download?p=pro&k=' . $acf_pro_key . '"');
WP_CLI::runcommand(
	"plugin install $plugin_path/acf-pro.zip",
	array(
		'exit_error'   => false,
		'command_args' => array( '--activate' ),
	)
);

exec( "rm -f $plugin_path/acf-pro.zip" );

// Remove boilerplate.
$answer = false;
while( false === $answer ) {
	echo 'Would you like to remove the boilerplate scripts? (y/n): ';
	$answer = strtolower( rtrim( fgets( STDIN ) ) ) === 'y' ? true : false;
}

if ( $answer ) {
	exec( 'rm -rf boilerplate' );
}
