<?php
/**
 * Template for displaying single curso
 *
 * @package Astra Child - CursosTIC
 */

get_header();

// Get custom fields
$duracion = get_post_meta( get_the_ID(), '_cursostic_duracion', true );
$precio = get_post_meta( get_the_ID(), '_cursostic_precio', true );
$precio_oferta = get_post_meta( get_the_ID(), '_cursostic_precio_oferta', true );
$fecha_inicio = get_post_meta( get_the_ID(), '_cursostic_fecha_inicio', true );
$fecha_fin = get_post_meta( get_the_ID(), '_cursostic_fecha_fin', true );
$instructor = get_post_meta( get_the_ID(), '_cursostic_instructor', true );
$estudiantes = get_post_meta( get_the_ID(), '_cursostic_estudiantes', true );
$certificado = get_post_meta( get_the_ID(), '_cursostic_certificado', true );
$requisitos = get_post_meta( get_the_ID(), '_cursostic_requisitos', true );
$que_aprenderas = get_post_meta( get_the_ID(), '_cursostic_que_aprenderas', true );
$url_inscripcion = get_post_meta( get_the_ID(), '_cursostic_url_inscripcion', true );

$nivel_terms = get_the_terms( get_the_ID(), 'nivel-curso' );
$categoria_terms = get_the_terms( get_the_ID(), 'categoria-curso' );
$modalidad_terms = get_the_terms( get_the_ID(), 'modalidad-curso' );
?>

<div class="cursostic-container cursostic-section">

    <?php cursostic_breadcrumbs(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'cursostic-single-course' ); ?>>

        <!-- Course Header -->
        <header class="cursostic-course-header">
            <h1><?php the_title(); ?></h1>
            <div class="cursostic-course-header-meta">
                <?php if ( $categoria_terms && ! is_wp_error( $categoria_terms ) ) : ?>
                    <span><?php echo esc_html( $categoria_terms[0]->name ); ?></span>
                <?php endif; ?>

                <?php if ( $nivel_terms && ! is_wp_error( $nivel_terms ) ) : ?>
                    <span>Nivel: <?php echo esc_html( $nivel_terms[0]->name ); ?></span>
                <?php endif; ?>

                <?php if ( $modalidad_terms && ! is_wp_error( $modalidad_terms ) ) : ?>
                    <span>Modalidad: <?php echo esc_html( $modalidad_terms[0]->name ); ?></span>
                <?php endif; ?>

                <?php if ( $estudiantes ) : ?>
                    <span><?php echo esc_html( $estudiantes ); ?> estudiantes inscritos</span>
                <?php endif; ?>
            </div>
        </header>

        <!-- Main Content Area -->
        <div class="cursostic-course-main-content">

            <!-- Course Details -->
            <div class="cursostic-course-details">

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="cursostic-course-featured-image" style="margin-bottom: 30px; border-radius: 12px; overflow: hidden;">
                        <?php the_post_thumbnail( 'curso-large', array( 'style' => 'width: 100%; height: auto;' ) ); ?>
                    </div>
                <?php endif; ?>

                <h2>Descripción del Curso</h2>
                <div class="cursostic-course-description">
                    <?php the_content(); ?>
                </div>

                <?php if ( $que_aprenderas ) : ?>
                    <h2>¿Qué aprenderás?</h2>
                    <ul class="cursostic-features-list">
                        <?php
                        $items = explode( "\n", $que_aprenderas );
                        foreach ( $items as $item ) {
                            if ( trim( $item ) ) {
                                echo '<li>' . esc_html( trim( $item ) ) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                <?php endif; ?>

                <?php if ( $requisitos ) : ?>
                    <h2>Requisitos</h2>
                    <ul class="cursostic-features-list">
                        <?php
                        $items = explode( "\n", $requisitos );
                        foreach ( $items as $item ) {
                            if ( trim( $item ) ) {
                                echo '<li>' . esc_html( trim( $item ) ) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                <?php endif; ?>

            </div>

            <!-- Sidebar Info Card -->
            <aside class="cursostic-course-info-card">

                <div style="text-align: center; margin-bottom: 20px;">
                    <?php
                    $precio_display = $precio_oferta ? $precio_oferta : $precio;
                    if ( $precio_display ) {
                        if ( $precio_oferta ) {
                            echo '<div style="text-decoration: line-through; color: #999; font-size: 1.2rem;">' . esc_html( $precio ) . '€</div>';
                        }
                        echo '<div style="font-size: 2.5rem; font-weight: 700; color: var(--cursostic-primary); margin: 10px 0;">' . esc_html( $precio_display ) . '€</div>';
                    } else {
                        echo '<div style="font-size: 2.5rem; font-weight: 700; color: var(--cursostic-secondary); margin: 10px 0;">GRATIS</div>';
                    }
                    ?>
                </div>

                <?php if ( $url_inscripcion ) : ?>
                    <a href="<?php echo esc_url( $url_inscripcion ); ?>"
                       class="cursostic-course-btn cursostic-btn-enroll"
                       style="display: block; text-align: center; width: 100%; padding: 15px; font-size: 1.1rem; margin-bottom: 20px;">
                        Inscribirme Ahora
                    </a>
                <?php endif; ?>

                <div style="border-top: 1px solid var(--cursostic-border-light); padding-top: 20px;">
                    <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: var(--cursostic-text-primary);">Información del Curso</h3>

                    <?php if ( $duracion ) : ?>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--cursostic-border-light);">
                            <span style="color: var(--cursostic-text-secondary);">Duración:</span>
                            <strong><?php echo esc_html( $duracion ); ?></strong>
                        </div>
                    <?php endif; ?>

                    <?php if ( $nivel_terms && ! is_wp_error( $nivel_terms ) ) : ?>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--cursostic-border-light);">
                            <span style="color: var(--cursostic-text-secondary);">Nivel:</span>
                            <strong><?php echo esc_html( $nivel_terms[0]->name ); ?></strong>
                        </div>
                    <?php endif; ?>

                    <?php if ( $modalidad_terms && ! is_wp_error( $modalidad_terms ) ) : ?>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--cursostic-border-light);">
                            <span style="color: var(--cursostic-text-secondary);">Modalidad:</span>
                            <strong><?php echo esc_html( $modalidad_terms[0]->name ); ?></strong>
                        </div>
                    <?php endif; ?>

                    <?php if ( $instructor ) : ?>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--cursostic-border-light);">
                            <span style="color: var(--cursostic-text-secondary);">Instructor:</span>
                            <strong><?php echo esc_html( $instructor ); ?></strong>
                        </div>
                    <?php endif; ?>

                    <?php if ( $fecha_inicio ) : ?>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--cursostic-border-light);">
                            <span style="color: var(--cursostic-text-secondary);">Fecha inicio:</span>
                            <strong><?php echo date_i18n( 'd/m/Y', strtotime( $fecha_inicio ) ); ?></strong>
                        </div>
                    <?php endif; ?>

                    <?php if ( $fecha_fin ) : ?>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--cursostic-border-light);">
                            <span style="color: var(--cursostic-text-secondary);">Fecha fin:</span>
                            <strong><?php echo date_i18n( 'd/m/Y', strtotime( $fecha_fin ) ); ?></strong>
                        </div>
                    <?php endif; ?>

                    <?php if ( $certificado ) : ?>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--cursostic-border-light);">
                            <span style="color: var(--cursostic-text-secondary);">Certificado:</span>
                            <strong><?php echo $certificado === 'si' ? 'Sí' : 'No'; ?></strong>
                        </div>
                    <?php endif; ?>

                    <?php if ( $estudiantes ) : ?>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0;">
                            <span style="color: var(--cursostic-text-secondary);">Estudiantes:</span>
                            <strong><?php echo esc_html( $estudiantes ); ?></strong>
                        </div>
                    <?php endif; ?>
                </div>

                <div style="margin-top: 20px; padding: 15px; background: var(--cursostic-bg-light); border-radius: 8px; font-size: 0.9rem; color: var(--cursostic-text-secondary);">
                    ℹ️ Compartir este curso:
                    <div style="margin-top: 10px; display: flex; gap: 10px;">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>"
                           target="_blank"
                           style="flex: 1; padding: 8px; background: #3b5998; color: white; text-align: center; border-radius: 5px; text-decoration: none;">
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>"
                           target="_blank"
                           style="flex: 1; padding: 8px; background: #1da1f2; color: white; text-align: center; border-radius: 5px; text-decoration: none;">
                            Twitter
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() ); ?>"
                           target="_blank"
                           style="flex: 1; padding: 8px; background: #0077b5; color: white; text-align: center; border-radius: 5px; text-decoration: none;">
                            LinkedIn
                        </a>
                    </div>
                </div>

            </aside>

        </div>

        <!-- Related Courses -->
        <?php
        if ( $categoria_terms && ! is_wp_error( $categoria_terms ) ) {
            $related_args = array(
                'post_type' => 'curso',
                'posts_per_page' => 3,
                'post__not_in' => array( get_the_ID() ),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categoria-curso',
                        'field' => 'term_id',
                        'terms' => $categoria_terms[0]->term_id,
                    ),
                ),
            );

            $related_query = new WP_Query( $related_args );

            if ( $related_query->have_posts() ) :
        ?>
                <div style="margin-top: 60px;">
                    <h2 style="text-align: center; margin-bottom: 40px; font-size: 2rem;">Cursos Relacionados</h2>
                    <div class="cursostic-courses-grid">
                        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                            <?php get_template_part( 'template-parts/content', 'curso-card' ); ?>
                        <?php endwhile; ?>
                    </div>
                </div>
        <?php
            endif;
            wp_reset_postdata();
        }
        ?>

    </article>

</div>

<?php get_footer(); ?>
