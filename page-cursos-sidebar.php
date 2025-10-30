/**
 * Template Name: Página de Cursos con Sidebar
 * Template for displaying courses with sidebar filters and search
 *
 * @package Astra Child - CursosTIC
 */

get_header(); ?>

<style>
/* Layout específico para esta página */
.cursostic-courses-layout {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 40px;
    max-width: 1400px;
    margin: 0 auto;
    padding: 40px 20px;
}

.cursostic-sidebar-filters {
    position: sticky;
    top: 100px;
    height: fit-content;
    background: white;
    padding: 30px;
    border-radius: 16px;
    box-shadow: var(--cursostic-shadow-lg);
}

.cursostic-main-content {
    min-width: 0;
}

.cursostic-courses-grid-sidebar {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

@media (max-width: 1200px) {
    .cursostic-courses-layout {
        grid-template-columns: 250px 1fr;
        gap: 30px;
    }

    .cursostic-courses-grid-sidebar {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 968px) {
    .cursostic-courses-layout {
        grid-template-columns: 1fr;
    }

    .cursostic-sidebar-filters {
        position: relative;
        top: 0;
    }
}
</style>

<!-- Hero Banner -->
<div class="cursostic-hero-banner">
    <div class="cursostic-hero-content">
        <h1>Catálogo de Cursos TIC</h1>
        <p>Encuentra el curso perfecto para impulsar tu carrera profesional</p>

        <div class="cursostic-search-wrapper">
            <form class="cursostic-search-form" role="search">
                <input type="search"
                       class="cursostic-search-input"
                       placeholder="Buscar por nombre de curso..."
                       aria-label="Buscar cursos"
                       name="s">
                <button type="submit">Buscar</button>
            </form>
        </div>
    </div>
</div>

<!-- Layout con Sidebar -->
<div class="cursostic-courses-layout">

    <!-- Sidebar Filters -->
    <aside class="cursostic-sidebar-filters">
        <h3 style="margin-top: 0; margin-bottom: 25px; font-size: 1.5rem; color: var(--cursostic-text-primary);">
            🔍 Filtrar Cursos
        </h3>

        <form class="cursostic-filters-form">

            <!-- Filtro por Categoría -->
            <div class="cursostic-filter-group" style="margin-bottom: 25px;">
                <label for="filter-categoria" style="display: block; font-weight: 600; margin-bottom: 10px; color: var(--cursostic-text-primary);">
                    Categoría
                </label>
                <select id="filter-categoria" name="categoria" style="width: 100%; padding: 12px; border: 2px solid var(--cursostic-border); border-radius: 8px; font-size: 1rem;">
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
            <div class="cursostic-filter-group" style="margin-bottom: 25px;">
                <label for="filter-nivel" style="display: block; font-weight: 600; margin-bottom: 10px; color: var(--cursostic-text-primary);">
                    Nivel
                </label>
                <select id="filter-nivel" name="nivel" style="width: 100%; padding: 12px; border: 2px solid var(--cursostic-border); border-radius: 8px; font-size: 1rem;">
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
            <div class="cursostic-filter-group" style="margin-bottom: 25px;">
                <label for="filter-modalidad" style="display: block; font-weight: 600; margin-bottom: 10px; color: var(--cursostic-text-primary);">
                    Modalidad
                </label>
                <select id="filter-modalidad" name="modalidad" style="width: 100%; padding: 12px; border: 2px solid var(--cursostic-border); border-radius: 8px; font-size: 1rem;">
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

            <!-- Filtro por Precio -->
            <div class="cursostic-filter-group" style="margin-bottom: 25px;">
                <label for="filter-precio" style="display: block; font-weight: 600; margin-bottom: 10px; color: var(--cursostic-text-primary);">
                    Precio
                </label>
                <select id="filter-precio" name="precio" style="width: 100%; padding: 12px; border: 2px solid var(--cursostic-border); border-radius: 8px; font-size: 1rem;">
                    <option value="">Todos</option>
                    <option value="gratis">Gratuitos</option>
                    <option value="pago">De pago</option>
                </select>
            </div>

            <!-- Botones de acción -->
            <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 30px;">
                <button type="submit" class="cursostic-btn-filter cursostic-btn-apply" style="width: 100%; padding: 14px; background: var(--cursostic-primary); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: var(--cursostic-transition);">
                    Aplicar Filtros
                </button>
                <button type="button" class="cursostic-btn-filter cursostic-btn-reset" style="width: 100%; padding: 14px; background: var(--cursostic-bg-light); color: var(--cursostic-text-secondary); border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: var(--cursostic-transition);">
                    Limpiar
                </button>
            </div>
        </form>

        <!-- Info adicional -->
        <div style="margin-top: 30px; padding: 20px; background: var(--cursostic-bg-light); border-radius: 8px;">
            <p style="margin: 0; font-size: 0.9rem; color: var(--cursostic-text-secondary);">
                <strong>💡 Tip:</strong> Usa los filtros para encontrar el curso que mejor se adapte a tus necesidades.
            </p>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="cursostic-main-content">

        <?php cursostic_breadcrumbs(); ?>

        <!-- Contador de resultados -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding: 20px; background: white; border-radius: 12px; box-shadow: var(--cursostic-shadow);">
            <div>
                <?php
                $total_cursos = wp_count_posts( 'curso' )->publish;
                ?>
                <h2 style="margin: 0; font-size: 1.5rem; color: var(--cursostic-text-primary);">
                    <?php echo $total_cursos; ?> <?php echo $total_cursos === 1 ? 'Curso' : 'Cursos'; ?> Disponibles
                </h2>
                <p style="margin: 5px 0 0 0; color: var(--cursostic-text-secondary);">
                    Actualizado recientemente
                </p>
            </div>

            <!-- Ordenar por -->
            <div>
                <select id="ordenar-por" style="padding: 10px 15px; border: 2px solid var(--cursostic-border); border-radius: 8px; font-size: 0.9rem;">
                    <option value="date">Más recientes</option>
                    <option value="title">A-Z</option>
                    <option value="popular">Más populares</option>
                </select>
            </div>
        </div>

        <!-- Grid de Cursos -->
        <div class="cursostic-courses-grid-sidebar cursostic-courses-grid">
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
                echo '<div class="cursostic-no-results" style="grid-column: 1 / -1;">';
                echo '<div style="text-align: center; padding: 60px 20px; background: white; border-radius: 12px; box-shadow: var(--cursostic-shadow);">';
                echo '<h3 style="font-size: 1.5rem; margin-bottom: 10px;">📚 No hay cursos disponibles</h3>';
                echo '<p style="color: var(--cursostic-text-secondary);">Estamos trabajando en añadir nuevos cursos. Vuelve pronto.</p>';
                echo '</div>';
                echo '</div>';
            endif;

            wp_reset_postdata();
            ?>
        </div>

        <!-- Paginación -->
        <?php if ( $cursos_query->max_num_pages > 1 ) : ?>
            <div style="margin-top: 50px; text-align: center;">
                <?php
                echo paginate_links( array(
                    'total' => $cursos_query->max_num_pages,
                    'prev_text' => '← Anterior',
                    'next_text' => 'Siguiente →',
                ));
                ?>
            </div>
        <?php endif; ?>

    </main>

</div>

<?php get_footer(); ?>
