<?php
/**
 * Simple Template for displaying single curso - Elementor Compatible
 *
 * This template is optimized for Elementor and will automatically
 * detect if Elementor is being used and render accordingly.
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
            if ( did_action( 'elementor/loaded' ) ) {
                // Check if this post is built with Elementor
                $elementor_page = \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() );

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
                    // Elementor is installed but not used on this post
                    // Use default single curso template
                    cursostic_render_traditional_single_curso();
                }
            } else {
                // Elementor is not installed
                // Use default single curso template
                cursostic_render_traditional_single_curso();
            }

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();

/**
 * Render traditional single curso layout
 * (Fallback when Elementor is not used)
 */
function cursostic_render_traditional_single_curso() {
    // Get custom fields
    $duracion = get_post_meta( get_the_ID(), 'curso_duracion', true );
    $precio = get_post_meta( get_the_ID(), 'curso_precio', true );
    $precio_oferta = get_post_meta( get_the_ID(), 'curso_precio_oferta', true );
    $fecha_inicio = get_post_meta( get_the_ID(), 'curso_fecha_inicio', true );

    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('cursostic-single-curso'); ?>>

        <header class="entry-header" style="background: linear-gradient(135deg, #1e40af 0%, #0f172a 100%); padding: 60px 20px; color: white; margin-bottom: 40px; border-radius: 12px;">
            <div style="max-width: 1200px; margin: 0 auto;">
                <h1 style="margin: 0 0 15px 0; font-size: 2.5rem; color: white;"><?php the_title(); ?></h1>
                <?php if ( has_excerpt() ) : ?>
                    <p style="font-size: 1.2rem; opacity: 0.95; margin: 0;"><?php echo get_the_excerpt(); ?></p>
                <?php endif; ?>

                <div style="margin-top: 20px; display: flex; gap: 12px; flex-wrap: wrap;">
                    <?php if ( $precio ) : ?>
                        <span style="background: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 6px;">
                            💰 <?php echo esc_html( $precio ); ?>€
                        </span>
                    <?php endif; ?>

                    <?php if ( $duracion ) : ?>
                        <span style="background: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 6px;">
                            ⏱️ <?php echo esc_html( $duracion ); ?>
                        </span>
                    <?php endif; ?>

                    <?php if ( $fecha_inicio ) : ?>
                        <span style="background: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 6px;">
                            📅 <?php echo esc_html( $fecha_inicio ); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="entry-thumbnail" style="margin-bottom: 40px; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.1);">
                <?php the_post_thumbnail( 'full' ); ?>
            </div>
        <?php endif; ?>

        <div class="entry-content" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cursostic' ),
                'after'  => '</div>',
            ) );
            ?>
        </div>

        <footer class="entry-footer" style="max-width: 1200px; margin: 40px auto 0; padding: 0 20px;">
            <?php
            $categories = get_the_terms( get_the_ID(), 'categoria-curso' );
            if ( $categories && ! is_wp_error( $categories ) ) {
                echo '<div style="margin-bottom: 20px;">';
                echo '<strong>Categorías:</strong> ';
                $cat_links = array();
                foreach ( $categories as $category ) {
                    $cat_links[] = '<a href="' . get_term_link( $category ) . '" style="background: #eff6ff; color: #2563eb; padding: 4px 12px; border-radius: 6px; text-decoration: none; display: inline-block; margin-right: 8px;">' . esc_html( $category->name ) . '</a>';
                }
                echo implode( ' ', $cat_links );
                echo '</div>';
            }
            ?>
        </footer>

    </article>
    <?php
}
