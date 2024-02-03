<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BLUEPRINT_WP
 * @subpackage Main
 * @since 1.0.0
 * @author Thijs Moens <hello@raketwetenschap.com>
 * @link https://raketwetenschap.com
 */

        get_header(); 
     
            if ( have_posts() ) {

                while ( have_posts() ) {
                            
                    the_post();
        
                        get_template_part( 'components/layout/content', get_post_type() );
                        
                }
                
            }

        get_footer(); ?>