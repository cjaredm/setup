<?php
/**
 * Functions
 *
 * @package Custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_IMAGES', THEME_URI . '/assets/dist/images' );
define( 'THEME_CSS', THEME_URI . '/assets/dist/css' );
define( 'THEME_JS', THEME_URI . '/assets/dist/js' );
define( 'VERSION_CSS', filemtime( get_template_directory() . '/assets/dist/css/custom.css' ) );
define( 'VERSION_JS', filemtime( get_template_directory() . '/assets/dist/js/custom.js' ) );
define( 'GOOGLE_FONTS', '//fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap' );
define( 'RECAPTCHA_SITE_KEY', '6Lcu19EUAAAAAGFG7E5B_c2yMBGP1PsbF2Rmm_G0' );
define( 'RECAPTCHA_SECRET_KEY', '6Lcu19EUAAAAANCVBTyayVJRN0e0RgLtJTUkFg2N' );

require get_parent_theme_file_path( 'functions/index.php' );
