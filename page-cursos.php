<?php
/**
 * Template Name: Página de Cursos
 * Template for displaying courses with filters and search
 *
 * @package Astra Child - CursosTIC
 */

get_header(); ?>

<div class="cursostic-hero-banner">
    <div class="cursostic-hero-content">
        <h1>Encuentra el Curso TIC Perfecto para Ti</h1>
        <p>Explora nuestra amplia oferta de cursos en Tecnologías de la Información y Comunicación</p>

        <div class="cursostic-search-wrapper">
            <form class="cursostic-search-form" role="search">
                <input type="search"
                       class="cursostic-search-input"
                       placeholder="Buscar cursos..."
                       aria-label="Buscar cursos"
                       name="s">
                <button type="submit">Buscar</button>
            </form>
        </div>
    </div>
</div>

<div class="cursostic-container cursostic-section">

    <?php cursostic_breadcrumbs(); ?>

    <!-- Filtros -->
    <div class="cursostic-filters-wrapper">
        <h2 class="cursostic-filters-title">Filtrar Cursos</h2>
        <form class="cursostic-filters-form">
            <div class="cursostic-filters">

                <!-- Filtro por Categoría -->
                <div class="cursostic-filter-group">
                    <label for="filter-categoria">Categoría</label>
                    <select id="filter-categoria" name="categoria">
                        <option value="">Todas las categorías</option>
                        <?php
                        $categorias = get_terms( array(
                            'taxonomy' => 'categoria-curso',
                            'hide_empty' => true,
                        ));
                        if ( ! empty( $categorias ) && ! is_wp_error( $categorias ) ) {
                            foreach ( $categorias as $categoria ) {
                                echo '<option value="' . esc_attr( $categoria->slug ) . '">' . esc_html( $categoria->name ) . ' (' . $categoria->count . ')</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Filtro por Nivel -->
                <div class="cursostic-filter-group">
                    <label for="filter-nivel">Nivel</label>
                    <select id="filter-nivel" name="nivel">
                        <option value="">Todos los niveles</option>
                        <?php
                        $niveles = get_terms( array(
                            'taxonomy' => 'nivel-curso',
                            'hide_empty' => true,
                        ));
                        if ( ! empty( $niveles ) && ! is_wp_error( $niveles ) ) {
                            foreach ( $niveles as $nivel ) {
                                echo '<option value="' . esc_attr( $nivel->slug ) . '">' . esc_html( $nivel->name ) . ' (' . $nivel->count . ')</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Filtro por Modalidad -->
                <div class="cursostic-filter-group">
                    <label for="filter-modalidad">Modalidad</label>
                    <select id="filter-modalidad" name="modalidad">
                        <option value="">Todas las modalidades</option>
                        <?php
                        $modalidades = get_terms( array(
                            'taxonomy' => 'modalidad-curso',
                            'hide_empty' => true,
                        ));
                        if ( ! empty( $modalidades ) && ! is_wp_error( $modalidades ) ) {
                            foreach ( $modalidades as $modalidad ) {
                                echo '<option value="' . esc_attr( $modalidad->slug ) . '">' . esc_html( $modalidad->name ) . ' (' . $modalidad->count . ')</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

            </div>

            <div class="cursostic-filters-actions">
                <button type="submit" class="cursostic-btn-filter cursostic-btn-apply">Aplicar Filtros</button>
                <button type="button" class="cursostic-btn-filter cursostic-btn-reset">Limpiar Filtros</button>
            </div>
        </form>
    </div>

    <!-- Grid de Cursos -->
    <div class="cursostic-courses-grid">
        <?php
        $args = array(
            'post_type' => 'curso',
            'posts_per_page' => 12,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $cursos_query = new WP_Query( $args );

        if ( $cursos_query->have_posts() ) :
            while ( $cursos_query->have_posts() ) : $cursos_query->the_post();
                get_template_part( 'template-parts/content', 'curso-card' );
            endwhile;
        else :
            echo '<div class="cursostic-no-results">';
            echo '<h3>No se encontraron cursos</h3>';
            echo '<p>Actualmente no hay cursos disponibles. Por favor, vuelve más tarde.</p>';
            echo '</div>';
        endif;

        wp_reset_postdata();
        ?>
    </div>

</div>

<?php get_footer(); ?>
