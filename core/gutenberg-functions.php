<?php
/**
 * All the functions that are needed for the Gutenberg editor
 *
 * 
 * @link https://developer.wordpress.org/block-editor/developers/themes/
 *
 * @package BLUEPRINT_WP
 * @subpackage Core
 * @since 1.0.0
 * @author Thijs Moens <post@thijsmoens.co>
 * @link https://thijsmoens.co
 */


/**
 * Returns the default editor color palette.
 *
 * @return array
 * @since 1.0.0
 */
if ( ! function_exists( 'blueprintwp_get_editor_color_palette' ) ) :

    function blueprintwp_get_editor_color_palette() {
        return apply_filters(
            'blueprintwp_editor_color_palette',
            array(
                array(
                    'name'  => esc_html__( 'White', 'blueprintwp' ),
                    'slug'  => 'white',
                    'color' => '#FFFFFF',
                ),
                array(
                    'name'  => esc_html__( 'Light Gray', 'blueprintwp' ),
                    'slug'  => 'light-gray',
                    'color' => '#F5F6F7',
                ),
                array(
                    'name'  => esc_html__( 'Gray', 'blueprintwp' ),
                    'slug'  => 'gray',
                    'color' => '#8D95A6',
                ),
                array(
                    'name'  => esc_html__( 'Dark Gray', 'blueprintwp' ),
                    'slug'  => 'dark gray',
                    'color' => '#424658',
                ),
                array(
                    'name'  => esc_html__( 'Accent', 'blueprintwp' ),
                    'slug'  => 'accent',
                    'color' => '#6F76D9',
                ),
            )
        );
    }

endif;

/**
 * Returns the default font sizes for the editor.
 *
 * @return array
 * @since 1.0.0
 */
if ( ! function_exists( 'blueprintwp_get_editor_font_sizes' ) ) :

    function blueprintwp_get_editor_font_sizes() {
        return apply_filters(
            'blueprintwp_editor_font_sizes',
            array(
                array(
                    'name' => esc_html__( 'Small', 'blueprintwp' ),
                    'size' => 16,
                    'slug' => 'small',
                ),
                array(
                    'name' => esc_html__( 'Normal', 'blueprintwp' ),
                    'size' => 20,
                    'slug' => 'normal',
                ),
                array(
                    'name' => esc_html__( 'Medium', 'blueprintwp' ),
                    'size' => 25,
                    'slug' => 'medium',
                ),
                array(
                    'name' => esc_html__( 'Large', 'blueprintwp' ),
                    'size' => 32,
                    'slug' => 'large',
                ),
                array(
                    'name' => esc_html__( 'Extra Large', 'blueprintwp' ),
                    'size' => 41,
                    'slug' => 'extra-large',
                ),
            )
        );
    }

endif;