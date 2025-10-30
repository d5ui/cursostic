<?php
/**
 * Template for the front page
 *
 * @package Astra Child - CursosTIC
 */

get_header(); ?>

<!-- Hero Banner -->
<div class="cursostic-hero-banner">
    <div class="cursostic-hero-content">
        <h1>Formación TIC de Calidad</h1>
        <p>Descubre cursos especializados en Tecnologías de la Información y Comunicación</p>

        <div class="cursostic-search-wrapper">
            <form class="cursostic-search-form" action="<?php echo home_url( '/cursos/' ); ?>" method="get" role="search">
                <input type="search"
                       class="cursostic-search-input"
                       placeholder="¿Qué quieres aprender hoy?"
                       aria-label="Buscar cursos"
                       name="s">
                <button type="submit">Buscar Cursos</button>
            </form>
        </div>
    </div>
</div>

<!-- Featured Courses -->
<div class="cursostic-container cursostic-section">
    <h2 class="cursostic-section-title">Cursos Destacados</h2>
    <p class="cursostic-section-subtitle">Los cursos más populares y recomendados de nuestra plataforma</p>

    <div class="cursostic-courses-grid">
        <?php
        $featured_args = array(
            'post_type' => 'curso',
            'posts_per_page' => 6,
            'meta_query' => array(
                array(
                    'key' => '_cursostic_destacado',
                    'value' => '1',
                    'compare' => '='
                )
            )
        );

        $featured_query = new WP_Query( $featured_args );

        if ( $featured_query->have_posts() ) :
            while ( $featured_query->have_posts() ) : $featured_query->the_post();
                get_template_part( 'template-parts/content', 'curso-card' );
            endwhile;
            wp_reset_postdata();
        else :
            // If no featured courses, show latest courses
            $latest_args = array(
                'post_type' => 'curso',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $latest_query = new WP_Query( $latest_args );

            if ( $latest_query->have_posts() ) :
                while ( $latest_query->have_posts() ) : $latest_query->the_post();
                    get_template_part( 'template-parts/content', 'curso-card' );
                endwhile;
                wp_reset_postdata();
            endif;
        endif;
        ?>
    </div>

    <div style="text-align: center; margin-top: 40px;">
        <a href="<?php echo home_url( '/cursos/' ); ?>"
           class="cursostic-course-btn"
           style="display: inline-block; padding: 15px 40px; font-size: 1.1rem;">
            Ver Todos los Cursos →
        </a>
    </div>
</div>

<!-- Categories Section -->
<div style="background: var(--cursostic-bg-light); padding: 60px 0;">
    <div class="cursostic-container">
        <h2 class="cursostic-section-title">Explora por Categorías</h2>
        <p class="cursostic-section-subtitle">Encuentra el curso perfecto según tu área de interés</p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px; margin-top: 40px;">
            <?php
            $categorias = get_terms( array(
                'taxonomy' => 'categoria-curso',
                'hide_empty' => true,
            ));

            if ( ! empty( $categorias ) && ! is_wp_error( $categorias ) ) :
                foreach ( $categorias as $categoria ) :
                    $categoria_link = get_term_link( $categoria );
            ?>
                    <a href="<?php echo esc_url( $categoria_link ); ?>"
                       style="background: white; padding: 30px; border-radius: 12px; text-align: center; text-decoration: none; transition: var(--cursostic-transition); box-shadow: var(--cursostic-shadow); display: block;">
                        <h3 style="font-size: 1.25rem; margin-bottom: 10px; color: var(--cursostic-primary);">
                            <?php echo esc_html( $categoria->name ); ?>
                        </h3>
                        <p style="color: var(--cursostic-text-secondary); margin: 0;">
                            <?php echo $categoria->count; ?> <?php echo $categoria->count === 1 ? 'curso' : 'cursos'; ?>
                        </p>
                    </a>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>

<!-- Latest Blog Posts -->
<div class="cursostic-container cursostic-section">
    <h2 class="cursostic-section-title">Últimas Noticias y Artículos</h2>
    <p class="cursostic-section-subtitle">Mantente al día con las últimas tendencias en TIC</p>

    <div class="cursostic-blog-grid">
        <?php
        $blog_args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $blog_query = new WP_Query( $blog_args );

        if ( $blog_query->have_posts() ) :
            while ( $blog_query->have_posts() ) : $blog_query->the_post();
                get_template_part( 'template-parts/content', 'blog-card' );
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>

    <?php if ( $blog_query->post_count > 0 ) : ?>
        <div style="text-align: center; margin-top: 40px;">
            <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"
               class="cursostic-course-btn"
               style="display: inline-block; padding: 15px 40px; font-size: 1.1rem;">
                Ver Todas las Publicaciones →
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- CTA Section -->
<div style="background: linear-gradient(135deg, var(--cursostic-primary) 0%, var(--cursostic-primary-dark) 100%); color: white; padding: 80px 20px; text-align: center;">
    <div class="cursostic-container">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">¿Listo para empezar tu formación?</h2>
        <p style="font-size: 1.25rem; margin-bottom: 30px; opacity: 0.95;">
            Únete a miles de estudiantes que ya están mejorando sus habilidades TIC
        </p>
        <a href="<?php echo home_url( '/cursos/' ); ?>"
           style="display: inline-block; background: white; color: var(--cursostic-primary); padding: 18px 45px; border-radius: 50px; font-weight: 700; font-size: 1.1rem; text-decoration: none; transition: var(--cursostic-transition); box-shadow: var(--cursostic-shadow-lg);">
            Explorar Cursos
        </a>
    </div>
</div>

<?php get_footer(); ?>
