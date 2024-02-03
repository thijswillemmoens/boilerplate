<?php
/**
 * Sets up theme defaults and registers support for various WordPress features
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/#theme-setup
 *
 * @package BLUEPRINT_WP
 * @subpackage Core
 * @since 1.0.0
 * @author Thijs Moens <hello@raketwetenschap.com>
 * @link https://raketwetenschap.com
 */

/**
 * Always first check if a function excist.
 */
if ( ! function_exists( 'blueprintwp_setup' ) ) :

    /**
     * Make it a good habit to always prefix 
     * your functions, classes, hooks, ext.
     * 
     * @link https://themereview.co/prefix-all-the-things/
     */
    function blueprintwp_setup() {

        /**
         * Flush rewrite rules for custom post types.
         */
        flush_rewrite_rules();

        /**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change 'blueprintwp' to the name of your theme in all the template files.
		 */
        load_theme_textdomain( 'blueprintwp', BLUEPRINT_WP_DIR . '/languages' );
        
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        
		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support( 'title-tag' );
        
		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

        /**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HtmL5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * Make post format for hyperlinking
		 */
		add_theme_support( 'post-formats', array( 'link' ) );
		
		/**
		 * Enable support responsive embedded content
		 * 
		 * @see https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#responsive-embedded-content
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'responsive-embeds' );

		/**
		 * Enabling theme support for align full and align wide option for the block editor
		 * 
		 */
		add_theme_support( 'align-wide' );

		/**
		 * Enabling theme support for styling in Gutenberg
		 * 
		 */
		add_theme_support( 'editor-color-palette', blueprintwp_get_editor_color_palette() );
		add_theme_support( 'editor-font-sizes', blueprintwp_get_editor_font_sizes() );

		/**
		 * Enabling support for the block editor
		 * 
		 * @see https://developer.wordpress.org/block-editor/developers/themes/theme-support/#default-block-styles
		 */
		add_theme_support( 'wp-block-styles' );

	}
	add_action( 'after_setup_theme', 'blueprintwp_setup' );

endif;