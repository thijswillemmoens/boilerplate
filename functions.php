<?php
/**
 * Theme functions and definitions
 * 
 * This is the file with all the functions for this theme.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BLUEPRINT_WP
 * @subpackage Main
 * @since 1.0.0
 * @author Thijs Moens <thijs@thijsmoens.co>
 * @link https://thijsmoens.co
 */


/**
 * Define all constants.
 */
define( 'BLUEPRINT_WP_DIR', trailingslashit( get_template_directory() ) );
define( 'BLUEPRINT_WP_URI', trailingslashit( get_template_directory_uri() ) );
define( 'BLUEPRINT_WP_THEME_URI', trailingslashit( get_theme_file_uri() ) );
define( 'BLUEPRINT_WP_THEME_PARENT_URI',  trailingslashit( get_parent_theme_file_uri() ) );
define( 'BLUEPRINT_WP_THEME_PARENT_PATH',  trailingslashit( get_parent_theme_file_path() ) );
define( 'BLUEPRINT_WP_CSS', trailingslashit( get_stylesheet_directory() ) );
define( 'BLUEPRINT_WP_CSS_URI', trailingslashit( get_stylesheet_directory_uri() ) );
define( 'BLUEPRINT_WP_THEME_VERSION', '1.0.0' );

/* ***************************** LOAD CORE FUNCTIONS *************************** */


/**
 * You can place all your functions in this functions.php file,
 * but I think it's better to place them in appropriate other files
 * as you see down here.
 */

 /**
 * Main theme_setup() functions.
 */
include_once BLUEPRINT_WP_DIR . '/core/theme-setup.php';

 /**
 * Gutenberg functions.
 */
include_once BLUEPRINT_WP_DIR . '/core/gutenberg-functions.php';

/**
 * Enqueue all styles and scripts.
 */
include_once BLUEPRINT_WP_DIR . '/core/enqueue-styles-and-scripts.php';

/**
 * Register and display menus.
 */
include_once BLUEPRINT_WP_DIR . '/core/register-menus.php';

/**
 * All the theme functionality.
 */
include_once BLUEPRINT_WP_DIR . '/core/theme-functions.php';

/**
 * All the plugins related functionality.
 */
include_once BLUEPRINT_WP_DIR . '/core/plugins-functions.php';
?>