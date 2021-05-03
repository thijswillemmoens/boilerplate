<?php
/**
 * Enqueue styles and scripts
 *
 * Pretty self-explanatory. Here you enqueue all your scripts and styling. 
 * Use the WordPress build in functions wp_enqueue().
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/
 *
 * @package BLUEPRINT_WP
 * @subpackage Core
 * @since 1.0.0
 * @author Thijs Moens <thijs@thijsmoens.co>
 * @link https://thijsmoens.co
 */

if ( ! function_exists( 'blueprintwp_enqueue_styles_and_scripts' ) ) :

    /**
     * Allthough it's not a good practice to let your functions do
     * multiple things and let them return multiple values, in this
     * case you are allowed to do so. Don't make life over complicated.
     *
     */
    function blueprintwp_enqueue_styles_and_scripts() {
        
        // Thrid party Styles.
        wp_enqueue_style( 'blueprintwp-vendors', BLUEPRINT_WP_THEME_URI . '/assets/css/vendors.min.css', false, BLUEPRINT_WP_THEME_VERSION, 'all' );
      
		// Load theme styles.
		wp_enqueue_style( 'blueprintwp-style', BLUEPRINT_WP_THEME_URI  . '/style.css' , false, BLUEPRINT_WP_THEME_VERSION );      

       
        // Vendor scripts.
        wp_enqueue_script( 'blueprintwp-vendors', BLUEPRINT_WP_THEME_URI . '/assets/javascript/vendors.min.js', '', BLUEPRINT_WP_THEME_VERSION, true );

        // Custom scripts.
	    wp_enqueue_script( 'blueprintwp-main', BLUEPRINT_WP_THEME_URI . '/assets/javascript/custom.min.js', array( 'jquery' ), BLUEPRINT_WP_THEME_VERSION, true );
        
		// Load the standard WordPress comments reply javascript
		if ( is_singular( 'post' ) && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
        }

    }
    add_action( 'wp_enqueue_scripts', 'blueprintwp_enqueue_styles_and_scripts' );

endif; ?>