<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing html tags. Make sure you always include the
 * wp_footer() function, so all the javascript is included.
 * 
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package BLUEPRINT_WP
 * @subpackage Main
 * @since 1.0.0
 * @author Thijs Moens <hello@raketwetenschap.com>
 * @link https://raketwetenschap.com
 */
?>

    </main>

    <?php 
        /**
         * Create a hook where plugins or other 
         * developers can hook into your footer code.
         */
        do_action( 'blueprintwp_before_footer' ); 
        
            get_template_part('components/layout/footer'); 

        do_action( 'blueprintwp_after_footer' ); 

        wp_footer(); ?>

</body>
</html>