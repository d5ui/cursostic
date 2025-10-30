<?php
/**
 * Astra Child Theme - CursosTIC Functions
 *
 * @package Astra Child - CursosTIC
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define constants
define( 'CURSOSTIC_VERSION', '1.0.0' );
define( 'CURSOSTIC_DIR', get_stylesheet_directory() );
define( 'CURSOSTIC_URI', get_stylesheet_directory_uri() );

/**
 * Include additional files
 */
// Advanced Custom Fields integration (si ACF está activo)
if ( file_exists( CURSOSTIC_DIR . '/inc/acf-fields.php' ) ) {
    require_once CURSOSTIC_DIR . '/inc/acf-fields.php';
}

// WooCommerce integration (si WooCommerce está activo)
if ( class_exists( 'WooCommerce' ) && file_exists( CURSOSTIC_DIR . '/inc/woocommerce-integration.php' ) ) {
    require_once CURSOSTIC_DIR . '/inc/woocommerce-integration.php';
}

// Elementor compatibility (si Elementor está activo)
if ( did_action( 'elementor/loaded' ) && file_exists( CURSOSTIC_DIR . '/inc/elementor-compatibility.php' ) ) {
    require_once CURSOSTIC_DIR . '/inc/elementor-compatibility.php';
}

/**
 * Page Builder compatibility
 * Soporte para múltiples constructores de páginas
 */
function cursostic_page_builder_support() {
    // Elementor
    if ( did_action( 'elementor/loaded' ) ) {
        add_post_type_support( 'curso', 'elementor' );
    }

    // Beaver Builder
    if ( class_exists( 'FLBuilder' ) ) {
        add_post_type_support( 'curso', 'fl-builder' );
    }

    // Divi Builder
    if ( class_exists( 'ET_Builder_Plugin' ) || function_exists( 'et_setup_theme' ) ) {
        add_post_type_support( 'curso', 'et_pb_layout' );
    }

    // Brizy
    if ( class_exists( 'Brizy_Editor' ) ) {
        add_post_type_support( 'curso', 'brizy' );
    }

    // WPBakery Page Builder
    if ( class_exists( 'Vc_Manager' ) ) {
        add_post_type_support( 'curso', 'vc_grid_builder' );
    }

    // Oxygen Builder
    if ( class_exists( 'CT_Component' ) ) {
        add_post_type_support( 'curso', 'oxygen' );
    }
}
add_action( 'init', 'cursostic_page_builder_support', 15 );

/**
 * Force theme templates and disable page builders for specific pages
 * Fuerza el uso de plantillas del theme en la página de inicio
 */
function cursostic_force_theme_templates() {
    // Only on frontend
    if ( is_admin() ) {
        return;
    }

    // Disable Elementor on front page
    if ( is_front_page() && did_action( 'elementor/loaded' ) ) {
        add_filter( 'elementor/frontend/builder_content_display', '__return_false', 999 );
    }

    // Disable Divi builder on front page
    if ( is_front_page() && function_exists( 'et_pb_is_pagebuilder_used' ) ) {
        add_filter( 'et_builder_should_load_framework', '__return_false', 999 );
    }
}
add_action( 'template_redirect', 'cursostic_force_theme_templates', 1 );

/**
 * Clear page builder meta data from front page
 * Limpia los datos de constructores de la página de inicio
 */
function cursostic_clear_builder_data_on_save( $post_id ) {
    // Only for pages
    if ( get_post_type( $post_id ) !== 'page' ) {
        return;
    }

    // Check if this is the front page
    if ( get_option( 'page_on_front' ) == $post_id ) {
        // Clear Elementor data
        delete_post_meta( $post_id, '_elementor_edit_mode' );
        delete_post_meta( $post_id, '_elementor_data' );

        // Clear Divi data
        delete_post_meta( $post_id, '_et_pb_use_builder' );
    }
}
add_action( 'save_post', 'cursostic_clear_builder_data_on_save', 999 );

/**
 * Force front-page.php template priority
 * Da máxima prioridad al template front-page.php
 */
function cursostic_force_front_page_template( $template ) {
    if ( is_front_page() ) {
        $front_page_template = locate_template( array( 'front-page.php' ) );
        if ( $front_page_template ) {
            return $front_page_template;
        }
    }
    return $template;
}
add_filter( 'template_include', 'cursostic_force_front_page_template', 999 );

/**
 * Enqueue parent and child theme styles
 */
function cursostic_enqueue_styles() {
    // Enqueue parent theme style
    wp_enqueue_style( 'astra-parent-style', get_template_directory_uri() . '/style.css' );

    // Enqueue child theme style
    wp_enqueue_style(
        'cursostic-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'astra-parent-style' ),
        CURSOSTIC_VERSION
    );

    // Enqueue custom scripts
    wp_enqueue_script(
        'cursostic-scripts',
        get_stylesheet_directory_uri() . '/assets/js/cursostic-main.js',
        array( 'jquery' ),
        CURSOSTIC_VERSION,
        true
    );

    // Localize script for AJAX
    wp_localize_script( 'cursostic-scripts', 'cursosticAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'cursostic-nonce' )
    ));
}
add_action( 'wp_enqueue_scripts', 'cursostic_enqueue_styles' );

/**
 * Register Custom Post Type: Cursos
 */
function cursostic_register_curso_post_type() {
    $labels = array(
        'name'                  => 'Cursos',
        'singular_name'         => 'Curso',
        'menu_name'             => 'Cursos',
        'name_admin_bar'        => 'Curso',
        'add_new'               => 'Añadir nuevo',
        'add_new_item'          => 'Añadir nuevo curso',
        'new_item'              => 'Nuevo curso',
        'edit_item'             => 'Editar curso',
        'view_item'             => 'Ver curso',
        'all_items'             => 'Todos los cursos',
        'search_items'          => 'Buscar cursos',
        'parent_item_colon'     => 'Cursos padre:',
        'not_found'             => 'No se encontraron cursos',
        'not_found_in_trash'    => 'No se encontraron cursos en la papelera'
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'cursos' ),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-welcome-learn-more',
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
        'show_in_rest'          => true, // Enable Gutenberg editor
    );

    register_post_type( 'curso', $args );
}
add_action( 'init', 'cursostic_register_curso_post_type' );

/**
 * Register Custom Taxonomies for Cursos
 */
function cursostic_register_curso_taxonomies() {
    // Categorías de Curso
    $labels_categoria = array(
        'name'              => 'Categorías de Curso',
        'singular_name'     => 'Categoría de Curso',
        'search_items'      => 'Buscar categorías',
        'all_items'         => 'Todas las categorías',
        'parent_item'       => 'Categoría padre',
        'parent_item_colon' => 'Categoría padre:',
        'edit_item'         => 'Editar categoría',
        'update_item'       => 'Actualizar categoría',
        'add_new_item'      => 'Añadir nueva categoría',
        'new_item_name'     => 'Nombre de nueva categoría',
        'menu_name'         => 'Categorías',
    );

    register_taxonomy( 'categoria-curso', array( 'curso' ), array(
        'hierarchical'      => true,
        'labels'            => $labels_categoria,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categoria-curso' ),
        'show_in_rest'      => true,
    ));

    // Nivel del Curso
    $labels_nivel = array(
        'name'              => 'Niveles',
        'singular_name'     => 'Nivel',
        'search_items'      => 'Buscar niveles',
        'all_items'         => 'Todos los niveles',
        'edit_item'         => 'Editar nivel',
        'update_item'       => 'Actualizar nivel',
        'add_new_item'      => 'Añadir nuevo nivel',
        'new_item_name'     => 'Nombre de nuevo nivel',
        'menu_name'         => 'Niveles',
    );

    register_taxonomy( 'nivel-curso', array( 'curso' ), array(
        'hierarchical'      => true,
        'labels'            => $labels_nivel,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'nivel' ),
        'show_in_rest'      => true,
    ));

    // Modalidad del Curso
    $labels_modalidad = array(
        'name'              => 'Modalidades',
        'singular_name'     => 'Modalidad',
        'search_items'      => 'Buscar modalidades',
        'all_items'         => 'Todas las modalidades',
        'edit_item'         => 'Editar modalidad',
        'update_item'       => 'Actualizar modalidad',
        'add_new_item'      => 'Añadir nueva modalidad',
        'new_item_name'     => 'Nombre de nueva modalidad',
        'menu_name'         => 'Modalidades',
    );

    register_taxonomy( 'modalidad-curso', array( 'curso' ), array(
        'hierarchical'      => true,
        'labels'            => $labels_modalidad,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'modalidad' ),
        'show_in_rest'      => true,
    ));
}
add_action( 'init', 'cursostic_register_curso_taxonomies' );

/**
 * Add Custom Meta Boxes for Cursos
 */
function cursostic_add_curso_meta_boxes() {
    add_meta_box(
        'cursostic_curso_details',
        'Detalles del Curso',
        'cursostic_curso_details_callback',
        'curso',
        'normal',
        'high'
    );

    add_meta_box(
        'cursostic_curso_seo',
        'SEO del Curso',
        'cursostic_curso_seo_callback',
        'curso',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'cursostic_add_curso_meta_boxes' );

/**
 * Curso Details Meta Box Callback
 */
function cursostic_curso_details_callback( $post ) {
    wp_nonce_field( 'cursostic_save_curso_details', 'cursostic_curso_details_nonce' );

    // Get existing values
    $duracion = get_post_meta( $post->ID, '_cursostic_duracion', true );
    $precio = get_post_meta( $post->ID, '_cursostic_precio', true );
    $precio_oferta = get_post_meta( $post->ID, '_cursostic_precio_oferta', true );
    $fecha_inicio = get_post_meta( $post->ID, '_cursostic_fecha_inicio', true );
    $fecha_fin = get_post_meta( $post->ID, '_cursostic_fecha_fin', true );
    $instructor = get_post_meta( $post->ID, '_cursostic_instructor', true );
    $estudiantes = get_post_meta( $post->ID, '_cursostic_estudiantes', true );
    $certificado = get_post_meta( $post->ID, '_cursostic_certificado', true );
    $requisitos = get_post_meta( $post->ID, '_cursostic_requisitos', true );
    $que_aprenderas = get_post_meta( $post->ID, '_cursostic_que_aprenderas', true );
    $url_inscripcion = get_post_meta( $post->ID, '_cursostic_url_inscripcion', true );
    $destacado = get_post_meta( $post->ID, '_cursostic_destacado', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="cursostic_duracion">Duración (ej: 40 horas)</label></th>
            <td><input type="text" id="cursostic_duracion" name="cursostic_duracion" value="<?php echo esc_attr( $duracion ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="cursostic_precio">Precio (€)</label></th>
            <td><input type="text" id="cursostic_precio" name="cursostic_precio" value="<?php echo esc_attr( $precio ); ?>" class="regular-text" placeholder="Dejar vacío si es gratis"></td>
        </tr>
        <tr>
            <th><label for="cursostic_precio_oferta">Precio Oferta (€)</label></th>
            <td><input type="text" id="cursostic_precio_oferta" name="cursostic_precio_oferta" value="<?php echo esc_attr( $precio_oferta ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="cursostic_fecha_inicio">Fecha de Inicio</label></th>
            <td><input type="date" id="cursostic_fecha_inicio" name="cursostic_fecha_inicio" value="<?php echo esc_attr( $fecha_inicio ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="cursostic_fecha_fin">Fecha de Fin</label></th>
            <td><input type="date" id="cursostic_fecha_fin" name="cursostic_fecha_fin" value="<?php echo esc_attr( $fecha_fin ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="cursostic_instructor">Instructor</label></th>
            <td><input type="text" id="cursostic_instructor" name="cursostic_instructor" value="<?php echo esc_attr( $instructor ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="cursostic_estudiantes">Número de Estudiantes</label></th>
            <td><input type="number" id="cursostic_estudiantes" name="cursostic_estudiantes" value="<?php echo esc_attr( $estudiantes ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="cursostic_certificado">Certificado</label></th>
            <td>
                <select id="cursostic_certificado" name="cursostic_certificado">
                    <option value="si" <?php selected( $certificado, 'si' ); ?>>Sí</option>
                    <option value="no" <?php selected( $certificado, 'no' ); ?>>No</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="cursostic_requisitos">Requisitos</label></th>
            <td><textarea id="cursostic_requisitos" name="cursostic_requisitos" rows="4" class="large-text"><?php echo esc_textarea( $requisitos ); ?></textarea>
            <p class="description">Un requisito por línea</p></td>
        </tr>
        <tr>
            <th><label for="cursostic_que_aprenderas">¿Qué aprenderás?</label></th>
            <td><textarea id="cursostic_que_aprenderas" name="cursostic_que_aprenderas" rows="4" class="large-text"><?php echo esc_textarea( $que_aprenderas ); ?></textarea>
            <p class="description">Un ítem por línea</p></td>
        </tr>
        <tr>
            <th><label for="cursostic_url_inscripcion">URL de Inscripción</label></th>
            <td><input type="url" id="cursostic_url_inscripcion" name="cursostic_url_inscripcion" value="<?php echo esc_attr( $url_inscripcion ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="cursostic_destacado">Curso Destacado</label></th>
            <td>
                <input type="checkbox" id="cursostic_destacado" name="cursostic_destacado" value="1" <?php checked( $destacado, '1' ); ?>>
                <label for="cursostic_destacado">Marcar como destacado</label>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Curso SEO Meta Box Callback
 */
function cursostic_curso_seo_callback( $post ) {
    wp_nonce_field( 'cursostic_save_curso_seo', 'cursostic_curso_seo_nonce' );

    // Get existing values
    $meta_title = get_post_meta( $post->ID, '_cursostic_meta_title', true );
    $meta_description = get_post_meta( $post->ID, '_cursostic_meta_description', true );
    $meta_keywords = get_post_meta( $post->ID, '_cursostic_meta_keywords', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="cursostic_meta_title">Meta Title</label></th>
            <td>
                <input type="text" id="cursostic_meta_title" name="cursostic_meta_title" value="<?php echo esc_attr( $meta_title ); ?>" class="large-text">
                <p class="description">Óptimo: 50-60 caracteres. Actual: <span id="title-count">0</span></p>
            </td>
        </tr>
        <tr>
            <th><label for="cursostic_meta_description">Meta Description</label></th>
            <td>
                <textarea id="cursostic_meta_description" name="cursostic_meta_description" rows="3" class="large-text"><?php echo esc_textarea( $meta_description ); ?></textarea>
                <p class="description">Óptimo: 150-160 caracteres. Actual: <span id="description-count">0</span></p>
            </td>
        </tr>
        <tr>
            <th><label for="cursostic_meta_keywords">Meta Keywords</label></th>
            <td>
                <input type="text" id="cursostic_meta_keywords" name="cursostic_meta_keywords" value="<?php echo esc_attr( $meta_keywords ); ?>" class="large-text">
                <p class="description">Separadas por comas</p>
            </td>
        </tr>
    </table>
    <script>
    jQuery(document).ready(function($) {
        function updateCount(field, counter) {
            var count = $(field).val().length;
            $(counter).text(count);
        }

        $('#cursostic_meta_title').on('input', function() {
            updateCount(this, '#title-count');
        });

        $('#cursostic_meta_description').on('input', function() {
            updateCount(this, '#description-count');
        });

        // Initial count
        updateCount('#cursostic_meta_title', '#title-count');
        updateCount('#cursostic_meta_description', '#description-count');
    });
    </script>
    <?php
}

/**
 * Save Curso Meta Box Data
 */
function cursostic_save_curso_meta_boxes( $post_id ) {
    // Check if nonce is set
    if ( ! isset( $_POST['cursostic_curso_details_nonce'] ) && ! isset( $_POST['cursostic_curso_seo_nonce'] ) ) {
        return;
    }

    // Verify nonce
    if ( isset( $_POST['cursostic_curso_details_nonce'] ) ) {
        if ( ! wp_verify_nonce( $_POST['cursostic_curso_details_nonce'], 'cursostic_save_curso_details' ) ) {
            return;
        }
    }

    if ( isset( $_POST['cursostic_curso_seo_nonce'] ) ) {
        if ( ! wp_verify_nonce( $_POST['cursostic_curso_seo_nonce'], 'cursostic_save_curso_seo' ) ) {
            return;
        }
    }

    // Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check permissions
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save curso details
    $fields = array(
        'cursostic_duracion',
        'cursostic_precio',
        'cursostic_precio_oferta',
        'cursostic_fecha_inicio',
        'cursostic_fecha_fin',
        'cursostic_instructor',
        'cursostic_estudiantes',
        'cursostic_certificado',
        'cursostic_requisitos',
        'cursostic_que_aprenderas',
        'cursostic_url_inscripcion',
        'cursostic_meta_title',
        'cursostic_meta_description',
        'cursostic_meta_keywords'
    );

    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }

    // Save destacado checkbox
    if ( isset( $_POST['cursostic_destacado'] ) ) {
        update_post_meta( $post_id, '_cursostic_destacado', '1' );
    } else {
        delete_post_meta( $post_id, '_cursostic_destacado' );
    }
}
add_action( 'save_post_curso', 'cursostic_save_curso_meta_boxes' );

/**
 * Add SEO Meta Tags to Head
 */
function cursostic_add_seo_meta_tags() {
    if ( is_singular( 'curso' ) ) {
        global $post;

        $meta_title = get_post_meta( $post->ID, '_cursostic_meta_title', true );
        $meta_description = get_post_meta( $post->ID, '_cursostic_meta_description', true );
        $meta_keywords = get_post_meta( $post->ID, '_cursostic_meta_keywords', true );

        if ( $meta_title ) {
            echo '<meta property="og:title" content="' . esc_attr( $meta_title ) . '" />' . "\n";
            echo '<meta name="twitter:title" content="' . esc_attr( $meta_title ) . '" />' . "\n";
        }

        if ( $meta_description ) {
            echo '<meta name="description" content="' . esc_attr( $meta_description ) . '" />' . "\n";
            echo '<meta property="og:description" content="' . esc_attr( $meta_description ) . '" />' . "\n";
            echo '<meta name="twitter:description" content="' . esc_attr( $meta_description ) . '" />' . "\n";
        }

        if ( $meta_keywords ) {
            echo '<meta name="keywords" content="' . esc_attr( $meta_keywords ) . '" />' . "\n";
        }

        // Open Graph
        echo '<meta property="og:type" content="article" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\n";

        if ( has_post_thumbnail() ) {
            $image_url = get_the_post_thumbnail_url( $post->ID, 'full' );
            echo '<meta property="og:image" content="' . esc_url( $image_url ) . '" />' . "\n";
            echo '<meta name="twitter:image" content="' . esc_url( $image_url ) . '" />' . "\n";
        }

        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    }
}
add_action( 'wp_head', 'cursostic_add_seo_meta_tags' );

/**
 * Add Schema.org JSON-LD for Courses
 */
function cursostic_add_course_schema() {
    if ( is_singular( 'curso' ) ) {
        global $post;

        $precio = get_post_meta( $post->ID, '_cursostic_precio', true );
        $duracion = get_post_meta( $post->ID, '_cursostic_duracion', true );
        $instructor = get_post_meta( $post->ID, '_cursostic_instructor', true );
        $descripcion = get_the_excerpt( $post->ID );

        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Course',
            'name' => get_the_title(),
            'description' => $descripcion,
            'provider' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo( 'name' ),
                'sameAs' => home_url()
            )
        );

        if ( $instructor ) {
            $schema['instructor'] = array(
                '@type' => 'Person',
                'name' => $instructor
            );
        }

        if ( $precio ) {
            $schema['offers'] = array(
                '@type' => 'Offer',
                'price' => $precio,
                'priceCurrency' => 'EUR',
                'availability' => 'https://schema.org/InStock'
            );
        }

        if ( has_post_thumbnail() ) {
            $schema['image'] = get_the_post_thumbnail_url( $post->ID, 'full' );
        }

        echo '<script type="application/ld+json">' . json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'cursostic_add_course_schema' );

/**
 * AJAX Handler for Course Filtering
 */
function cursostic_filter_courses() {
    check_ajax_referer( 'cursostic-nonce', 'nonce' );

    $categoria = isset( $_POST['categoria'] ) ? sanitize_text_field( $_POST['categoria'] ) : '';
    $nivel = isset( $_POST['nivel'] ) ? sanitize_text_field( $_POST['nivel'] ) : '';
    $modalidad = isset( $_POST['modalidad'] ) ? sanitize_text_field( $_POST['modalidad'] ) : '';
    $search = isset( $_POST['search'] ) ? sanitize_text_field( $_POST['search'] ) : '';

    $args = array(
        'post_type' => 'curso',
        'posts_per_page' => 12,
        'post_status' => 'publish'
    );

    if ( $search ) {
        $args['s'] = $search;
    }

    $tax_query = array();

    if ( $categoria ) {
        $tax_query[] = array(
            'taxonomy' => 'categoria-curso',
            'field' => 'slug',
            'terms' => $categoria
        );
    }

    if ( $nivel ) {
        $tax_query[] = array(
            'taxonomy' => 'nivel-curso',
            'field' => 'slug',
            'terms' => $nivel
        );
    }

    if ( $modalidad ) {
        $tax_query[] = array(
            'taxonomy' => 'modalidad-curso',
            'field' => 'slug',
            'terms' => $modalidad
        );
    }

    if ( ! empty( $tax_query ) ) {
        $tax_query['relation'] = 'AND';
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query( $args );

    ob_start();

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part( 'template-parts/content', 'curso-card' );
        }
    } else {
        echo '<div class="cursostic-no-results">';
        echo '<h3>No se encontraron cursos</h3>';
        echo '<p>Intenta ajustar los filtros de búsqueda</p>';
        echo '</div>';
    }

    wp_reset_postdata();

    $output = ob_get_clean();

    wp_send_json_success( $output );
}
add_action( 'wp_ajax_cursostic_filter_courses', 'cursostic_filter_courses' );
add_action( 'wp_ajax_nopriv_cursostic_filter_courses', 'cursostic_filter_courses' );

/**
 * Add featured image support
 */
function cursostic_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'curso-thumb', 400, 250, true );
    add_image_size( 'curso-large', 800, 500, true );

    // Add support for title tag
    add_theme_support( 'title-tag' );

    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action( 'after_setup_theme', 'cursostic_theme_setup' );

/**
 * Customize excerpt length
 */
function cursostic_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'cursostic_excerpt_length' );

/**
 * Customize excerpt more
 */
function cursostic_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'cursostic_excerpt_more' );

/**
 * Add breadcrumbs
 */
function cursostic_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }

    $separator = ' &raquo; ';
    $home_title = 'Inicio';

    echo '<div class="cursostic-breadcrumbs">';
    echo '<a href="' . home_url() . '">' . $home_title . '</a>' . $separator;

    if ( is_post_type_archive( 'curso' ) ) {
        echo 'Cursos';
    } elseif ( is_singular( 'curso' ) ) {
        echo '<a href="' . get_post_type_archive_link( 'curso' ) . '">Cursos</a>' . $separator;
        the_title();
    } elseif ( is_category() || is_single() ) {
        if ( is_single() ) {
            the_category( ', ' );
            echo $separator;
            the_title();
        } else {
            single_cat_title();
        }
    } elseif ( is_page() ) {
        the_title();
    } elseif ( is_search() ) {
        echo 'Resultados de búsqueda para: ' . get_search_query();
    } elseif ( is_404() ) {
        echo 'Página no encontrada';
    }

    echo '</div>';
}

/**
 * Register widget areas
 */
function cursostic_widgets_init() {
    register_sidebar( array(
        'name'          => 'Sidebar Cursos',
        'id'            => 'sidebar-cursos',
        'description'   => 'Widgets para la página de cursos',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar( array(
        'name'          => 'Footer 1',
        'id'            => 'footer-1',
        'description'   => 'Primera columna del footer',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar( array(
        'name'          => 'Footer 2',
        'id'            => 'footer-2',
        'description'   => 'Segunda columna del footer',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar( array(
        'name'          => 'Footer 3',
        'id'            => 'footer-3',
        'description'   => 'Tercera columna del footer',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action( 'widgets_init', 'cursostic_widgets_init' );

/**
 * Helper function to get curso price
 */
function cursostic_get_curso_price( $post_id ) {
    $precio = get_post_meta( $post_id, '_cursostic_precio', true );
    $precio_oferta = get_post_meta( $post_id, '_cursostic_precio_oferta', true );

    if ( empty( $precio ) ) {
        return '<span class="cursostic-course-price free">GRATIS</span>';
    }

    $output = '';
    if ( $precio_oferta ) {
        $output .= '<span class="cursostic-course-price-original" style="text-decoration: line-through; color: #999; font-size: 1rem; margin-right: 10px;">' . $precio . '€</span>';
        $output .= '<span class="cursostic-course-price">' . $precio_oferta . '€</span>';
    } else {
        $output .= '<span class="cursostic-course-price">' . $precio . '€</span>';
    }

    return $output;
}

/**
 * Flush rewrite rules on theme activation
 */
function cursostic_rewrite_flush() {
    cursostic_register_curso_post_type();
    cursostic_register_curso_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'cursostic_rewrite_flush' );
