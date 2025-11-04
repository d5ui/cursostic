<?php
/**
 * Template Name: Ficha de Curso Profesional
 * Template for displaying single curso with professional layout
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
$temario = get_post_meta( get_the_ID(), '_cursostic_temario', true );

$nivel_terms = get_the_terms( get_the_ID(), 'nivel-curso' );
$categoria_terms = get_the_terms( get_the_ID(), 'categoria-curso' );
$modalidad_terms = get_the_terms( get_the_ID(), 'modalidad-curso' );

$precio_display = $precio_oferta ? $precio_oferta : $precio;
$descuento = 0;
if ( $precio && $precio_oferta ) {
    $descuento = round( ( ( $precio - $precio_oferta ) / $precio ) * 100 );
}
?>

<style>
/* Tabs Navigation */
.cursostic-tabs {
    display: flex;
    gap: 0;
    border-bottom: 2px solid var(--cursostic-border);
    margin: 40px 0 30px;
    flex-wrap: wrap;
}

.cursostic-tab-btn {
    padding: 15px 30px;
    background: transparent;
    border: none;
    border-bottom: 3px solid transparent;
    cursor: pointer;
    font-weight: 600;
    color: var(--cursostic-text-secondary);
    transition: var(--cursostic-transition);
    font-size: 1rem;
}

.cursostic-tab-btn:hover {
    color: var(--cursostic-primary);
    background: var(--cursostic-bg-light);
}

.cursostic-tab-btn.active {
    color: var(--cursostic-primary);
    border-bottom-color: var(--cursostic-primary);
}

.cursostic-tab-content {
    display: none;
    animation: fadeInUp 0.4s ease;
}

.cursostic-tab-content.active {
    display: block;
}

/* Info Cards Grid */
.cursostic-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 30px 0;
}

.cursostic-info-card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: var(--cursostic-shadow);
    text-align: center;
    transition: var(--cursostic-transition);
}

.cursostic-info-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--cursostic-shadow-lg);
}

.cursostic-info-card-icon {
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.cursostic-info-card-label {
    font-size: 0.875rem;
    color: var(--cursostic-text-secondary);
    margin-bottom: 5px;
}

.cursostic-info-card-value {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--cursostic-text-primary);
}

/* Accordion for Temario */
.cursostic-accordion-item {
    background: white;
    border-radius: 8px;
    margin-bottom: 15px;
    overflow: hidden;
    box-shadow: var(--cursostic-shadow-sm);
}

.cursostic-accordion-header {
    padding: 20px 25px;
    background: var(--cursostic-bg-light);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: var(--cursostic-transition);
}

.cursostic-accordion-header:hover {
    background: #e5e7eb;
}

.cursostic-accordion-header.active {
    background: var(--cursostic-primary);
    color: white;
}

.cursostic-accordion-title {
    font-weight: 600;
    font-size: 1.1rem;
    margin: 0;
}

.cursostic-accordion-icon {
    font-size: 1.5rem;
    transition: transform 0.3s ease;
}

.cursostic-accordion-header.active .cursostic-accordion-icon {
    transform: rotate(180deg);
}

.cursostic-accordion-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.cursostic-accordion-content.active {
    max-height: 1000px;
}

.cursostic-accordion-body {
    padding: 25px;
    color: var(--cursostic-text-secondary);
    line-height: 1.8;
}

/* Badges */
.cursostic-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    margin-right: 10px;
    margin-bottom: 10px;
}

.cursostic-badge-primary {
    background: var(--cursostic-primary);
    color: white;
}

.cursostic-badge-success {
    background: var(--cursostic-secondary);
    color: white;
}

.cursostic-badge-warning {
    background: var(--cursostic-accent);
    color: white;
}

.cursostic-badge-outline {
    background: transparent;
    border: 2px solid var(--cursostic-primary);
    color: var(--cursostic-primary);
}

/* Single Curso Layout */
.cursostic-single-layout {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

.cursostic-single-header {
    background: linear-gradient(135deg, var(--cursostic-primary) 0%, var(--cursostic-primary-dark) 100%);
    padding: 50px 40px;
    border-radius: 16px;
    color: white;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
}

.cursostic-single-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 400px;
    height: 400px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.cursostic-single-content-wrap {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 40px;
    align-items: start;
}

.cursostic-single-sidebar {
    position: sticky;
    top: 100px;
}

@media (max-width: 1024px) {
    .cursostic-single-content-wrap {
        grid-template-columns: 1fr;
    }

    .cursostic-single-sidebar {
        position: relative;
        top: 0;
        order: -1;
    }
}
</style>

<div class="cursostic-single-layout">

    <?php cursostic_breadcrumbs(); ?>

    <!-- Header del Curso -->
    <div class="cursostic-single-header">

        <?php if ( $categoria_terms && ! is_wp_error( $categoria_terms ) ) : ?>
            <div style="margin-bottom: 15px;">
                <span class="cursostic-badge cursostic-badge-warning">
                    <?php echo esc_html( $categoria_terms[0]->name ); ?>
                </span>
                <?php if ( $nivel_terms && ! is_wp_error( $nivel_terms ) ) : ?>
                    <span class="cursostic-badge cursostic-badge-outline">
                        Nivel: <?php echo esc_html( $nivel_terms[0]->name ); ?>
                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <h1 style="font-size: 2.5rem; margin-bottom: 20px; line-height: 1.2;">
            <?php the_title(); ?>
        </h1>

        <div style="font-size: 1.1rem; opacity: 0.95; margin-bottom: 25px;">
            <?php echo wp_trim_words( get_the_excerpt(), 30 ); ?>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 25px; font-size: 0.95rem; opacity: 0.9;">
            <?php if ( $instructor ) : ?>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 1.2rem;">👨‍🏫</span>
                    <span><?php echo esc_html( $instructor ); ?></span>
                </div>
            <?php endif; ?>

            <?php if ( $estudiantes ) : ?>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 1.2rem;">👥</span>
                    <span><?php echo esc_html( $estudiantes ); ?> estudiantes</span>
                </div>
            <?php endif; ?>

            <?php if ( $duracion ) : ?>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 1.2rem;">⏱️</span>
                    <span><?php echo esc_html( $duracion ); ?></span>
                </div>
            <?php endif; ?>

            <?php if ( $modalidad_terms && ! is_wp_error( $modalidad_terms ) ) : ?>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 1.2rem;">📍</span>
                    <span><?php echo esc_html( $modalidad_terms[0]->name ); ?></span>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Content Layout -->
    <div class="cursostic-single-content-wrap">

        <!-- Main Content -->
        <div class="cursostic-single-main">

            <!-- Featured Image -->
            <?php if ( has_post_thumbnail() ) : ?>
                <div style="margin-bottom: 40px; border-radius: 16px; overflow: hidden; box-shadow: var(--cursostic-shadow-lg);">
                    <?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: auto; display: block;' ) ); ?>
                </div>
            <?php endif; ?>

            <!-- Info Cards Grid -->
            <div class="cursostic-info-grid">
                <?php if ( $duracion ) : ?>
                    <div class="cursostic-info-card">
                        <div class="cursostic-info-card-icon">⏱️</div>
                        <div class="cursostic-info-card-label">Duración</div>
                        <div class="cursostic-info-card-value"><?php echo esc_html( $duracion ); ?></div>
                    </div>
                <?php endif; ?>

                <?php if ( $nivel_terms && ! is_wp_error( $nivel_terms ) ) : ?>
                    <div class="cursostic-info-card">
                        <div class="cursostic-info-card-icon">📊</div>
                        <div class="cursostic-info-card-label">Nivel</div>
                        <div class="cursostic-info-card-value"><?php echo esc_html( $nivel_terms[0]->name ); ?></div>
                    </div>
                <?php endif; ?>

                <?php if ( $certificado ) : ?>
                    <div class="cursostic-info-card">
                        <div class="cursostic-info-card-icon">🎓</div>
                        <div class="cursostic-info-card-label">Certificado</div>
                        <div class="cursostic-info-card-value">Incluido</div>
                    </div>
                <?php endif; ?>

                <?php if ( $modalidad_terms && ! is_wp_error( $modalidad_terms ) ) : ?>
                    <div class="cursostic-info-card">
                        <div class="cursostic-info-card-icon">📍</div>
                        <div class="cursostic-info-card-label">Modalidad</div>
                        <div class="cursostic-info-card-value"><?php echo esc_html( $modalidad_terms[0]->name ); ?></div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tabs Navigation -->
            <div class="cursostic-tabs">
                <button class="cursostic-tab-btn active" data-tab="descripcion">📝 Descripción</button>
                <?php if ( $que_aprenderas ) : ?>
                    <button class="cursostic-tab-btn" data-tab="objetivos">🎯 Qué aprenderás</button>
                <?php endif; ?>
                <?php if ( $temario ) : ?>
                    <button class="cursostic-tab-btn" data-tab="temario">📚 Temario</button>
                <?php endif; ?>
                <?php if ( $requisitos ) : ?>
                    <button class="cursostic-tab-btn" data-tab="requisitos">✅ Requisitos</button>
                <?php endif; ?>
            </div>

            <!-- Tab: Descripción -->
            <div class="cursostic-tab-content active" id="tab-descripcion">
                <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: var(--cursostic-shadow); font-size: 1.05rem; line-height: 1.8;">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- Tab: Qué aprenderás -->
            <?php if ( $que_aprenderas ) : ?>
                <div class="cursostic-tab-content" id="tab-objetivos">
                    <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: var(--cursostic-shadow);">
                        <h2 style="margin-top: 0; margin-bottom: 25px; color: var(--cursostic-primary);">
                            🎯 Objetivos de Aprendizaje
                        </h2>
                        <ul class="cursostic-features-list" style="list-style: none; padding: 0;">
                            <?php
                            $items = explode( "\n", $que_aprenderas );
                            foreach ( $items as $item ) {
                                if ( trim( $item ) ) {
                                    echo '<li style="padding: 15px 0; padding-left: 35px; position: relative; border-bottom: 1px solid var(--cursostic-border-light); font-size: 1.05rem;">';
                                    echo '<span style="position: absolute; left: 0; color: var(--cursostic-secondary); font-weight: bold; font-size: 1.3rem;">✓</span>';
                                    echo esc_html( trim( $item ) );
                                    echo '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Tab: Temario -->
            <?php if ( $temario ) : ?>
                <div class="cursostic-tab-content" id="tab-temario">
                    <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: var(--cursostic-shadow);">
                        <h2 style="margin-top: 0; margin-bottom: 25px; color: var(--cursostic-primary);">
                            📚 Programa del Curso
                        </h2>
                        <div class="cursostic-accordion">
                            <?php
                            // If ACF repeater
                            if ( is_array( $temario ) && function_exists( 'get_field' ) ) {
                                $index = 1;
                                foreach ( $temario as $modulo ) {
                                    ?>
                                    <div class="cursostic-accordion-item">
                                        <div class="cursostic-accordion-header">
                                            <h3 class="cursostic-accordion-title">
                                                Módulo <?php echo $index; ?>: <?php echo esc_html( $modulo['titulo'] ); ?>
                                            </h3>
                                            <span class="cursostic-accordion-icon">▼</span>
                                        </div>
                                        <div class="cursostic-accordion-content">
                                            <div class="cursostic-accordion-body">
                                                <?php echo wpautop( $modulo['descripcion'] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $index++;
                                }
                            } else {
                                // Simple text field
                                $modulos = explode( "\n\n", $temario );
                                $index = 1;
                                foreach ( $modulos as $modulo ) {
                                    if ( trim( $modulo ) ) {
                                        ?>
                                        <div class="cursostic-accordion-item">
                                            <div class="cursostic-accordion-header">
                                                <h3 class="cursostic-accordion-title">
                                                    Módulo <?php echo $index; ?>
                                                </h3>
                                                <span class="cursostic-accordion-icon">▼</span>
                                            </div>
                                            <div class="cursostic-accordion-content">
                                                <div class="cursostic-accordion-body">
                                                    <?php echo wpautop( esc_html( trim( $modulo ) ) ); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $index++;
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Tab: Requisitos -->
            <?php if ( $requisitos ) : ?>
                <div class="cursostic-tab-content" id="tab-requisitos">
                    <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: var(--cursostic-shadow);">
                        <h2 style="margin-top: 0; margin-bottom: 25px; color: var(--cursostic-primary);">
                            ✅ Requisitos Previos
                        </h2>
                        <ul class="cursostic-features-list" style="list-style: none; padding: 0;">
                            <?php
                            $items = explode( "\n", $requisitos );
                            foreach ( $items as $item ) {
                                if ( trim( $item ) ) {
                                    echo '<li style="padding: 15px 0; padding-left: 35px; position: relative; border-bottom: 1px solid var(--cursostic-border-light); font-size: 1.05rem;">';
                                    echo '<span style="position: absolute; left: 0; color: var(--cursostic-text-secondary); font-size: 1.3rem;">•</span>';
                                    echo esc_html( trim( $item ) );
                                    echo '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

        </div>

        <!-- Sidebar -->
        <aside class="cursostic-single-sidebar">
            <div style="background: white; padding: 35px; border-radius: 16px; box-shadow: var(--cursostic-shadow-xl);">

                <!-- Precio -->
                <div style="text-align: center; margin-bottom: 30px; padding-bottom: 30px; border-bottom: 2px solid var(--cursostic-border-light);">
                    <?php if ( $descuento > 0 ) : ?>
                        <div style="background: var(--cursostic-accent); color: white; display: inline-block; padding: 5px 15px; border-radius: 20px; font-weight: 700; font-size: 0.875rem; margin-bottom: 15px;">
                            🔥 -<?php echo $descuento; ?>% DESCUENTO
                        </div>
                    <?php endif; ?>

                    <?php if ( $precio_display ) : ?>
                        <?php if ( $precio_oferta && $precio ) : ?>
                            <div style="text-decoration: line-through; color: #999; font-size: 1.5rem; margin-bottom: 10px;">
                                <?php echo esc_html( $precio ); ?>€
                            </div>
                        <?php endif; ?>
                        <div style="font-size: 3rem; font-weight: 700; color: var(--cursostic-primary); line-height: 1;">
                            <?php echo esc_html( $precio_display ); ?>€
                        </div>
                    <?php else : ?>
                        <div style="font-size: 3rem; font-weight: 700; color: var(--cursostic-secondary); line-height: 1;">
                            GRATIS
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Botón de inscripción -->
                <?php if ( $url_inscripcion ) : ?>
                    <a href="<?php echo esc_url( $url_inscripcion ); ?>"
                       class="cursostic-course-btn"
                       style="display: block; text-align: center; width: 100%; padding: 18px; font-size: 1.1rem; margin-bottom: 20px; text-decoration: none;">
                        🎓 Inscribirme Ahora
                    </a>
                <?php endif; ?>

                <!-- Información del curso -->
                <div style="margin-top: 25px;">
                    <h3 style="font-size: 1.1rem; margin-bottom: 20px; color: var(--cursostic-text-primary);">
                        ℹ️ Información del Curso
                    </h3>

                    <?php
                    $info_items = array();

                    if ( $duracion ) {
                        $info_items[] = array( 'label' => 'Duración', 'value' => $duracion, 'icon' => '⏱️' );
                    }

                    if ( $nivel_terms && ! is_wp_error( $nivel_terms ) ) {
                        $info_items[] = array( 'label' => 'Nivel', 'value' => $nivel_terms[0]->name, 'icon' => '📊' );
                    }

                    if ( $modalidad_terms && ! is_wp_error( $modalidad_terms ) ) {
                        $info_items[] = array( 'label' => 'Modalidad', 'value' => $modalidad_terms[0]->name, 'icon' => '📍' );
                    }

                    if ( $instructor ) {
                        $info_items[] = array( 'label' => 'Instructor', 'value' => $instructor, 'icon' => '👨‍🏫' );
                    }

                    if ( $fecha_inicio ) {
                        $info_items[] = array( 'label' => 'Fecha inicio', 'value' => date_i18n( 'd/m/Y', strtotime( $fecha_inicio ) ), 'icon' => '📅' );
                    }

                    if ( $fecha_fin ) {
                        $info_items[] = array( 'label' => 'Fecha fin', 'value' => date_i18n( 'd/m/Y', strtotime( $fecha_fin ) ), 'icon' => '📅' );
                    }

                    if ( $certificado ) {
                        $info_items[] = array( 'label' => 'Certificado', 'value' => 'Incluido', 'icon' => '🎓' );
                    }

                    if ( $estudiantes ) {
                        $info_items[] = array( 'label' => 'Estudiantes', 'value' => $estudiantes, 'icon' => '👥' );
                    }

                    foreach ( $info_items as $item ) :
                    ?>
                        <div style="display: flex; justify-content: space-between; padding: 14px 0; border-bottom: 1px solid var(--cursostic-border-light);">
                            <span style="color: var(--cursostic-text-secondary); display: flex; align-items: center; gap: 8px;">
                                <span><?php echo $item['icon']; ?></span>
                                <?php echo esc_html( $item['label'] ); ?>:
                            </span>
                            <strong style="color: var(--cursostic-text-primary);">
                                <?php echo esc_html( $item['value'] ); ?>
                            </strong>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Compartir -->
                <div style="margin-top: 30px; padding-top: 30px; border-top: 2px solid var(--cursostic-border-light);">
                    <h4 style="font-size: 0.9rem; margin-bottom: 15px; color: var(--cursostic-text-secondary);">
                        📤 Compartir este curso:
                    </h4>
                    <div style="display: flex; gap: 10px;">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>"
                           target="_blank"
                           style="flex: 1; padding: 10px; background: #3b5998; color: white; text-align: center; border-radius: 8px; text-decoration: none; font-size: 0.85rem; transition: var(--cursostic-transition);">
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>"
                           target="_blank"
                           style="flex: 1; padding: 10px; background: #1da1f2; color: white; text-align: center; border-radius: 8px; text-decoration: none; font-size: 0.85rem; transition: var(--cursostic-transition);">
                            Twitter
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() ); ?>"
                           target="_blank"
                           style="flex: 1; padding: 10px; background: #0077b5; color: white; text-align: center; border-radius: 8px; text-decoration: none; font-size: 0.85rem; transition: var(--cursostic-transition);">
                            LinkedIn
                        </a>
                    </div>
                </div>

                <!-- Garantía / Info adicional -->
                <div style="margin-top: 25px; padding: 20px; background: var(--cursostic-bg-light); border-radius: 8px; font-size: 0.9rem;">
                    <div style="display: flex; align-items: start; gap: 12px; margin-bottom: 15px;">
                        <span style="font-size: 1.5rem;">✅</span>
                        <div>
                            <strong style="display: block; margin-bottom: 5px;">Acceso de por vida</strong>
                            <span style="color: var(--cursostic-text-secondary);">Aprende a tu ritmo</span>
                        </div>
                    </div>
                    <div style="display: flex; align-items: start; gap: 12px; margin-bottom: 15px;">
                        <span style="font-size: 1.5rem;">💬</span>
                        <div>
                            <strong style="display: block; margin-bottom: 5px;">Soporte incluido</strong>
                            <span style="color: var(--cursostic-text-secondary);">Resuelve tus dudas</span>
                        </div>
                    </div>
                    <div style="display: flex; align-items: start; gap: 12px;">
                        <span style="font-size: 1.5rem;">📱</span>
                        <div>
                            <strong style="display: block; margin-bottom: 5px;">Acceso móvil</strong>
                            <span style="color: var(--cursostic-text-secondary);">Estudia desde cualquier dispositivo</span>
                        </div>
                    </div>
                </div>

            </div>
        </aside>

    </div>

    <!-- Cursos Relacionados -->
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
            <div style="margin-top: 80px;">
                <h2 style="text-align: center; margin-bottom: 40px; font-size: 2rem; color: var(--cursostic-text-primary);">
                    📚 Cursos Relacionados
                </h2>
                <div class="cursostic-courses-grid" style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));">
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

</div>

<script>
// Tabs functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.cursostic-tab-btn');
    const tabContents = document.querySelectorAll('.cursostic-tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');

            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to clicked button and corresponding content
            this.classList.add('active');
            document.getElementById('tab-' + targetTab).classList.add('active');
        });
    });

    // Accordion functionality
    const accordionHeaders = document.querySelectorAll('.cursostic-accordion-header');

    accordionHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const isActive = this.classList.contains('active');

            // Close all accordions
            accordionHeaders.forEach(h => {
                h.classList.remove('active');
                h.nextElementSibling.classList.remove('active');
            });

            // Open clicked accordion if it wasn't active
            if (!isActive) {
                this.classList.add('active');
                content.classList.add('active');
            }
        });
    });
});
</script>

<?php get_footer(); ?>
