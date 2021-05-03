<?php
/**
 * The default template for displaying content on a article
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BLUEPRINT_WP
 * @subpackage Components/Layout
 * @since 1.0.0
 * @author Thijs Moens <thijs@thijsmoens.co>
 * @link https://thijsmoens.co
 */
 ?>

        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

               

        </article><!-- .article -->

        <?php comments_template( '', true ); ?>