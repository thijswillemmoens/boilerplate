<?php
/**
 * The header for our theme
 * 
 * Make sure you include the wp_head() function as well as the meta charset 
 * and viewport. The rest is optional.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BLUEPRINT_WP
 * @subpackage Main
 * @since 1.0.0
 * @author Thijs Moens <hello@raketwetenschap.com>
 * @link https://raketwetenschap.com
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-type" content="text/html;charset=<?php bloginfo( 'charset' ); ?>">
		
	<?php wp_head(); ?>
	
</head>
	
<body <?php body_class(); ?> data-barba="wrapper">

    <?php
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
	} 

	do_action( 'blueprintwp_before_header' ); 

		get_template_part('components/layout/header');

	do_action( 'blueprintwp_after_header' ); ?>

	<main id="site-content" role="main" data-barba="container">