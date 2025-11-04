<?php
/**
 * Front Page Template - Elementor Compatible
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
    <main id="main" class="site-main" role="main">

        <?php
        while ( have_posts() ) :
            the_post();

            // Check if Elementor is rendering this page
            $elementor_page = false;

            if ( did_action( 'elementor/loaded' ) ) {
                $elementor_page = \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() );
            }

            if ( $elementor_page ) {
                // Let Elementor handle everything
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            } else {
                // Use default content
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cursostic' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>
                </article>
                <?php
            }

        endwhile;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
