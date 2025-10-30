<?php
/**
 * Template part for displaying course cards
 *
 * @package Astra Child - CursosTIC
 */

// Get custom fields
$duracion = get_post_meta( get_the_ID(), '_cursostic_duracion', true );
$nivel_terms = get_the_terms( get_the_ID(), 'nivel-curso' );
$categoria_terms = get_the_terms( get_the_ID(), 'categoria-curso' );
$destacado = get_post_meta( get_the_ID(), '_cursostic_destacado', true );
$url_inscripcion = get_post_meta( get_the_ID(), '_cursostic_url_inscripcion', true );
$estudiantes = get_post_meta( get_the_ID(), '_cursostic_estudiantes', true );
?>

<div class="cursostic-course-card">

    <!-- Course Image -->
    <div class="cursostic-course-image">
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'curso-thumb', array( 'alt' => get_the_title() ) ); ?>
            </a>
        <?php else : ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/default-course.jpg' ); ?>"
                     alt="<?php the_title_attribute(); ?>">
            </a>
        <?php endif; ?>

        <?php if ( $destacado ) : ?>
            <span class="cursostic-course-badge">Destacado</span>
        <?php endif; ?>

        <?php if ( $nivel_terms && ! is_wp_error( $nivel_terms ) ) : ?>
            <span class="cursostic-course-level"><?php echo esc_html( $nivel_terms[0]->name ); ?></span>
        <?php endif; ?>
    </div>

    <!-- Course Content -->
    <div class="cursostic-course-content">

        <?php if ( $categoria_terms && ! is_wp_error( $categoria_terms ) ) : ?>
            <div class="cursostic-course-category">
                <?php echo esc_html( $categoria_terms[0]->name ); ?>
            </div>
        <?php endif; ?>

        <h3 class="cursostic-course-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="cursostic-course-excerpt">
            <?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
        </div>

        <!-- Course Meta -->
        <div class="cursostic-course-meta">
            <?php if ( $duracion ) : ?>
                <div class="cursostic-course-meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.2 3.2.8-1.3-4.5-2.7V7z"/>
                    </svg>
                    <span><?php echo esc_html( $duracion ); ?></span>
                </div>
            <?php endif; ?>

            <?php if ( $estudiantes ) : ?>
                <div class="cursostic-course-meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                    </svg>
                    <span><?php echo esc_html( $estudiantes ); ?> estudiantes</span>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Course Footer -->
    <div class="cursostic-course-footer">
        <div class="cursostic-course-price-wrapper">
            <?php echo cursostic_get_curso_price( get_the_ID() ); ?>
        </div>
        <a href="<?php echo $url_inscripcion ? esc_url( $url_inscripcion ) : get_permalink(); ?>"
           class="cursostic-course-btn">
            <?php echo $url_inscripcion ? 'Inscribirme' : 'Ver más'; ?>
        </a>
    </div>

</div>
