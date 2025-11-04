<?php
/**
 * Template for displaying single curso
 * Compatible with Elementor and traditional WordPress
 *
 * @package Astra Child - CursosTIC
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();

            // Check if Elementor is active and this post is built with Elementor
            $elementor_page = false;

            if ( did_action( 'elementor/loaded' ) ) {
                $elementor_page = \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() );
            }

            if ( $elementor_page ) {
                // Let Elementor render the content
                the_content();

            } else {
                // Use traditional PHP template
                get_template_part( 'template-parts/single-curso', 'traditional' );
            }

            // Comments section (optional)
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
