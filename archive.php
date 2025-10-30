<?php
/**
 * The template for displaying archive pages
 *
 * @package Astra Child - CursosTIC
 */

get_header(); ?>

<div class="cursostic-container cursostic-section">

    <?php cursostic_breadcrumbs(); ?>

    <header class="page-header" style="text-align: center; margin-bottom: 50px;">
        <?php
        the_archive_title( '<h1 class="cursostic-section-title">', '</h1>' );
        the_archive_description( '<div class="cursostic-section-subtitle">', '</div>' );
        ?>
    </header>

    <div class="cursostic-blog-grid">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', 'blog-card' );
            endwhile;
        else :
            echo '<div class="cursostic-no-results">';
            echo '<h3>No se encontraron publicaciones</h3>';
            echo '<p>No hay contenido disponible en este momento.</p>';
            echo '</div>';
        endif;
        ?>
    </div>

    <?php
    // Pagination
    the_posts_pagination( array(
        'mid_size' => 2,
        'prev_text' => '← Anterior',
        'next_text' => 'Siguiente →',
    ));
    ?>

</div>

<?php get_footer(); ?>
