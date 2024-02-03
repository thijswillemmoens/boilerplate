<?php
/**
 * Register and display menus
 *
 * Register and display all the menus for your theme. Pretty simple.
 * You could place this code in your theme_setup(), but I like it in
 * a seperate file.
 * 
 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
 * @see theme_setup()
 *
 * @package BLUEPRINT_WP
 * @subpackage Core
 * @since 1.0.0
 * @author Thijs Moens <hello@raketwetenschap.com>
 * @link https://raketwetenschap.com
 */

if ( !function_exists( 'blueprintwp_register_menus' ) ) :

	function blueprintwp_register_menus() {
		register_nav_menu( 'blueprintwp-desktop',       esc_html__('Desktop Menu','blueprintwp') );
		register_nav_menu( 'blueprintwp-categories',    esc_html__('Category Menu','blueprintwp') );
    }
    add_action( 'init', 'blueprintwp_register_menus' );
    
endif;