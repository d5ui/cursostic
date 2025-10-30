<?php
/**
 * Template part for displaying blog post cards
 *
 * @package Astra Child - CursosTIC
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'cursostic-blog-card' ); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="cursostic-blog-image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'medium_large', array( 'alt' => get_the_title() ) ); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="cursostic-blog-content">

        <div class="cursostic-blog-meta">
            <span><?php echo get_the_date(); ?></span>
            <span>•</span>
            <span><?php the_category( ', ' ); ?></span>
            <?php if ( get_comments_number() > 0 ) : ?>
                <span>•</span>
                <span><?php comments_number( '0 comentarios', '1 comentario', '% comentarios' ); ?></span>
            <?php endif; ?>
        </div>

        <h2 class="cursostic-blog-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <div class="cursostic-blog-excerpt">
            <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
        </div>

        <a href="<?php the_permalink(); ?>" class="cursostic-blog-read-more">
            Leer más →
        </a>

    </div>

</article>
