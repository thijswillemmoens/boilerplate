<?php
/**
 * All the custom functions build for your Plugins
 *
 * @package BLUEPRINT_WP
 * @subpackage Core
 * @since 1.0.0
 * @author Thijs Moens <hello@raketwetenschap.com>
 * @link https://raketwetenschap.com
 */



/**
 * Check if a plugin is active
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'blueprintwp_plugin_active' ) ) :

    function blueprintwp_plugin_active( $plugin ) {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if ( is_plugin_active( $plugin ) ) {
            return true;
        }

        return false;
    }

endif;