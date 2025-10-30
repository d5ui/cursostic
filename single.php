<?php
/**
 * The template for displaying single blog posts
 *
 * @package Astra Child - CursosTIC
 */

get_header(); ?>

<div class="cursostic-container cursostic-section">

    <?php cursostic_breadcrumbs(); ?>

    <?php
    while ( have_posts() ) : the_post();
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header" style="text-align: center; margin-bottom: 40px;">
            <h1 class="entry-title" style="font-size: 2.5rem; margin-bottom: 20px; color: var(--cursostic-text-primary);">
                <?php the_title(); ?>
            </h1>

            <div class="entry-meta cursostic-blog-meta" style="justify-content: center;">
                <span>Por <?php the_author(); ?></span>
                <span>•</span>
                <span><?php echo get_the_date(); ?></span>
                <span>•</span>
                <span><?php the_category( ', ' ); ?></span>
                <?php if ( get_comments_number() > 0 ) : ?>
                    <span>•</span>
                    <span><?php comments_number( '0 comentarios', '1 comentario', '% comentarios' ); ?></span>
                <?php endif; ?>
            </div>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="entry-image" style="margin-bottom: 40px; border-radius: 12px; overflow: hidden;">
                <?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: auto;' ) ); ?>
            </div>
        <?php endif; ?>

        <div class="entry-content" style="max-width: 800px; margin: 0 auto; background: white; padding: 40px; border-radius: 12px; box-shadow: var(--cursostic-shadow); font-size: 1.1rem; line-height: 1.8;">
            <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'astra-child-cursostic' ),
                'after'  => '</div>',
            ));
            ?>
        </div>

        <footer class="entry-footer" style="max-width: 800px; margin: 30px auto; padding: 20px 0; border-top: 2px solid var(--cursostic-border-light);">
            <?php
            $tags_list = get_the_tag_list( '', ', ' );
            if ( $tags_list ) {
                echo '<div style="margin-bottom: 20px;"><strong>Etiquetas:</strong> ' . $tags_list . '</div>';
            }
            ?>

            <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();

                if ( $prev_post ) :
                ?>
                    <a href="<?php echo get_permalink( $prev_post ); ?>" style="flex: 1; padding: 15px; background: var(--cursostic-bg-light); border-radius: 8px; text-decoration: none; color: var(--cursostic-text-primary);">
                        ← <?php echo get_the_title( $prev_post ); ?>
                    </a>
                <?php endif; ?>

                <?php if ( $next_post ) : ?>
                    <a href="<?php echo get_permalink( $next_post ); ?>" style="flex: 1; padding: 15px; background: var(--cursostic-bg-light); border-radius: 8px; text-decoration: none; text-align: right; color: var(--cursostic-text-primary);">
                        <?php echo get_the_title( $next_post ); ?> →
                    </a>
                <?php endif; ?>
            </div>

            <!-- Share Buttons -->
            <div style="margin-top: 30px; padding: 20px; background: var(--cursostic-bg-light); border-radius: 8px;">
                <strong>Compartir este artículo:</strong>
                <div style="margin-top: 15px; display: flex; gap: 10px;">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>"
                       target="_blank"
                       style="flex: 1; padding: 10px; background: #3b5998; color: white; text-align: center; border-radius: 5px; text-decoration: none;">
                        Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>"
                       target="_blank"
                       style="flex: 1; padding: 10px; background: #1da1f2; color: white; text-align: center; border-radius: 5px; text-decoration: none;">
                        Twitter
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() ); ?>"
                       target="_blank"
                       style="flex: 1; padding: 10px; background: #0077b5; color: white; text-align: center; border-radius: 5px; text-decoration: none;">
                        LinkedIn
                    </a>
                    <a href="mailto:?subject=<?php echo urlencode( get_the_title() ); ?>&body=<?php echo urlencode( get_permalink() ); ?>"
                       style="flex: 1; padding: 10px; background: #777; color: white; text-align: center; border-radius: 5px; text-decoration: none;">
                        Email
                    </a>
                </div>
            </div>
        </footer>

    </article>

    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;

    endwhile;
    ?>

</div>

<?php get_footer(); ?>
