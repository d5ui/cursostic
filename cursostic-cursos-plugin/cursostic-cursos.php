<?php
/**
 * Plugin Name: CursosTIC - Sistema de Cursos
 * Plugin URI: https://cursostic.es
 * Description: Plugin para gestionar cursos con Custom Post Type, taxonomías, campos personalizados y widgets de Elementor. Funciona con cualquier theme.
 * Version: 1.0.0
 * Author: CursosTIC
 * Author URI: https://cursostic.es
 * Text Domain: cursostic-cursos
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 *
 * @package CursosTIC_Cursos
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'CURSOSTIC_CURSOS_VERSION', '1.0.0' );
define( 'CURSOSTIC_CURSOS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CURSOSTIC_CURSOS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CURSOSTIC_CURSOS_PLUGIN_FILE', __FILE__ );

/**
 * Main Plugin Class
 */
class CursosTIC_Cursos_Plugin {

    /**
     * Instance of this class
     */
    private static $instance = null;

    /**
     * Get instance
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        $this->init_hooks();
        $this->includes();
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        add_action( 'init', array( $this, 'register_post_type' ) );
        add_action( 'init', array( $this, 'register_taxonomies' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post_curso', array( $this, 'save_meta_boxes' ), 10, 2 );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_assets' ) );

        // Elementor integration
        add_action( 'elementor/widgets/register', array( $this, 'register_elementor_widgets' ) );
        add_action( 'elementor/elements/categories_registered', array( $this, 'register_elementor_category' ) );

        // AJAX handlers
        add_action( 'wp_ajax_cursostic_filter_courses', array( $this, 'ajax_filter_courses' ) );
        add_action( 'wp_ajax_nopriv_cursostic_filter_courses', array( $this, 'ajax_filter_courses' ) );

        // Shortcodes
        add_shortcode( 'cursostic_cursos_grid', array( $this, 'shortcode_cursos_grid' ) );
        add_shortcode( 'cursostic_cursos_filters', array( $this, 'shortcode_cursos_filters' ) );
    }

    /**
     * Include required files
     */
    private function includes() {
        // Include additional files if needed
    }

    /**
     * Register Custom Post Type: Curso
     */
    public function register_post_type() {
        $labels = array(
            'name'                  => _x( 'Cursos', 'Post Type General Name', 'cursostic-cursos' ),
            'singular_name'         => _x( 'Curso', 'Post Type Singular Name', 'cursostic-cursos' ),
            'menu_name'             => __( 'Cursos', 'cursostic-cursos' ),
            'name_admin_bar'        => __( 'Curso', 'cursostic-cursos' ),
            'archives'              => __( 'Archivo de Cursos', 'cursostic-cursos' ),
            'attributes'            => __( 'Atributos del Curso', 'cursostic-cursos' ),
            'parent_item_colon'     => __( 'Curso Padre:', 'cursostic-cursos' ),
            'all_items'             => __( 'Todos los Cursos', 'cursostic-cursos' ),
            'add_new_item'          => __( 'Añadir Nuevo Curso', 'cursostic-cursos' ),
            'add_new'               => __( 'Añadir Nuevo', 'cursostic-cursos' ),
            'new_item'              => __( 'Nuevo Curso', 'cursostic-cursos' ),
            'edit_item'             => __( 'Editar Curso', 'cursostic-cursos' ),
            'update_item'           => __( 'Actualizar Curso', 'cursostic-cursos' ),
            'view_item'             => __( 'Ver Curso', 'cursostic-cursos' ),
            'view_items'            => __( 'Ver Cursos', 'cursostic-cursos' ),
            'search_items'          => __( 'Buscar Curso', 'cursostic-cursos' ),
            'not_found'             => __( 'No se encontraron cursos', 'cursostic-cursos' ),
            'not_found_in_trash'    => __( 'No se encontraron cursos en la papelera', 'cursostic-cursos' ),
            'featured_image'        => __( 'Imagen Destacada', 'cursostic-cursos' ),
            'set_featured_image'    => __( 'Establecer imagen destacada', 'cursostic-cursos' ),
            'remove_featured_image' => __( 'Eliminar imagen destacada', 'cursostic-cursos' ),
            'use_featured_image'    => __( 'Usar como imagen destacada', 'cursostic-cursos' ),
            'insert_into_item'      => __( 'Insertar en el curso', 'cursostic-cursos' ),
            'uploaded_to_this_item' => __( 'Subido a este curso', 'cursostic-cursos' ),
            'items_list'            => __( 'Lista de cursos', 'cursostic-cursos' ),
            'items_list_navigation' => __( 'Navegación de lista de cursos', 'cursostic-cursos' ),
            'filter_items_list'     => __( 'Filtrar lista de cursos', 'cursostic-cursos' ),
        );

        $args = array(
            'label'                 => __( 'Curso', 'cursostic-cursos' ),
            'description'           => __( 'Cursos de formación', 'cursostic-cursos' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', 'elementor' ),
            'taxonomies'            => array( 'categoria-curso', 'nivel-curso', 'modalidad-curso' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-welcome-learn-more',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'cursos',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
            'rewrite'               => array( 'slug' => 'cursos', 'with_front' => false ),
        );

        register_post_type( 'curso', $args );

        // Flush rewrite rules on plugin activation (only once)
        if ( get_option( 'cursostic_cursos_flush_rewrite_rules' ) ) {
            flush_rewrite_rules();
            delete_option( 'cursostic_cursos_flush_rewrite_rules' );
        }
    }

    /**
     * Register Taxonomies
     */
    public function register_taxonomies() {
        // Categoría Curso
        $labels_cat = array(
            'name'              => _x( 'Categorías de Curso', 'taxonomy general name', 'cursostic-cursos' ),
            'singular_name'     => _x( 'Categoría', 'taxonomy singular name', 'cursostic-cursos' ),
            'search_items'      => __( 'Buscar Categorías', 'cursostic-cursos' ),
            'all_items'         => __( 'Todas las Categorías', 'cursostic-cursos' ),
            'parent_item'       => __( 'Categoría Padre', 'cursostic-cursos' ),
            'parent_item_colon' => __( 'Categoría Padre:', 'cursostic-cursos' ),
            'edit_item'         => __( 'Editar Categoría', 'cursostic-cursos' ),
            'update_item'       => __( 'Actualizar Categoría', 'cursostic-cursos' ),
            'add_new_item'      => __( 'Añadir Nueva Categoría', 'cursostic-cursos' ),
            'new_item_name'     => __( 'Nombre de Nueva Categoría', 'cursostic-cursos' ),
            'menu_name'         => __( 'Categorías', 'cursostic-cursos' ),
        );

        register_taxonomy( 'categoria-curso', array( 'curso' ), array(
            'hierarchical'      => true,
            'labels'            => $labels_cat,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => array( 'slug' => 'categoria-curso' ),
        ) );

        // Nivel Curso
        $labels_nivel = array(
            'name'              => _x( 'Niveles', 'taxonomy general name', 'cursostic-cursos' ),
            'singular_name'     => _x( 'Nivel', 'taxonomy singular name', 'cursostic-cursos' ),
            'search_items'      => __( 'Buscar Niveles', 'cursostic-cursos' ),
            'all_items'         => __( 'Todos los Niveles', 'cursostic-cursos' ),
            'edit_item'         => __( 'Editar Nivel', 'cursostic-cursos' ),
            'update_item'       => __( 'Actualizar Nivel', 'cursostic-cursos' ),
            'add_new_item'      => __( 'Añadir Nuevo Nivel', 'cursostic-cursos' ),
            'new_item_name'     => __( 'Nombre de Nuevo Nivel', 'cursostic-cursos' ),
            'menu_name'         => __( 'Niveles', 'cursostic-cursos' ),
        );

        register_taxonomy( 'nivel-curso', array( 'curso' ), array(
            'hierarchical'      => false,
            'labels'            => $labels_nivel,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => array( 'slug' => 'nivel' ),
        ) );

        // Modalidad Curso
        $labels_modalidad = array(
            'name'              => _x( 'Modalidades', 'taxonomy general name', 'cursostic-cursos' ),
            'singular_name'     => _x( 'Modalidad', 'taxonomy singular name', 'cursostic-cursos' ),
            'search_items'      => __( 'Buscar Modalidades', 'cursostic-cursos' ),
            'all_items'         => __( 'Todas las Modalidades', 'cursostic-cursos' ),
            'edit_item'         => __( 'Editar Modalidad', 'cursostic-cursos' ),
            'update_item'       => __( 'Actualizar Modalidad', 'cursostic-cursos' ),
            'add_new_item'      => __( 'Añadir Nueva Modalidad', 'cursostic-cursos' ),
            'new_item_name'     => __( 'Nombre de Nueva Modalidad', 'cursostic-cursos' ),
            'menu_name'         => __( 'Modalidades', 'cursostic-cursos' ),
        );

        register_taxonomy( 'modalidad-curso', array( 'curso' ), array(
            'hierarchical'      => false,
            'labels'            => $labels_modalidad,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => array( 'slug' => 'modalidad' ),
        ) );
    }

    /**
     * Add Meta Boxes
     */
    public function add_meta_boxes() {
        add_meta_box(
            'cursostic_curso_detalles',
            __( 'Detalles del Curso', 'cursostic-cursos' ),
            array( $this, 'render_meta_box_detalles' ),
            'curso',
            'normal',
            'high'
        );

        add_meta_box(
            'cursostic_curso_contenido',
            __( 'Contenido del Curso', 'cursostic-cursos' ),
            array( $this, 'render_meta_box_contenido' ),
            'curso',
            'normal',
            'default'
        );
    }

    /**
     * Render Meta Box: Detalles
     */
    public function render_meta_box_detalles( $post ) {
        wp_nonce_field( 'cursostic_curso_meta_box', 'cursostic_curso_meta_box_nonce' );

        $precio = get_post_meta( $post->ID, 'curso_precio', true );
        $precio_oferta = get_post_meta( $post->ID, 'curso_precio_oferta', true );
        $duracion = get_post_meta( $post->ID, 'curso_duracion', true );
        $fecha_inicio = get_post_meta( $post->ID, 'curso_fecha_inicio', true );
        $fecha_fin = get_post_meta( $post->ID, 'curso_fecha_fin', true );
        $instructor = get_post_meta( $post->ID, 'curso_instructor', true );
        $plazas_disponibles = get_post_meta( $post->ID, 'curso_plazas_disponibles', true );
        $certificado = get_post_meta( $post->ID, 'curso_certificado', true );
        $url_inscripcion = get_post_meta( $post->ID, 'curso_url_inscripcion', true );
        ?>
        <style>
            .cursostic-meta-field { margin-bottom: 20px; }
            .cursostic-meta-field label { display: block; font-weight: 600; margin-bottom: 5px; }
            .cursostic-meta-field input[type="text"],
            .cursostic-meta-field input[type="number"],
            .cursostic-meta-field input[type="date"],
            .cursostic-meta-field input[type="url"] { width: 100%; padding: 8px; }
            .cursostic-meta-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        </style>

        <div class="cursostic-meta-row">
            <div class="cursostic-meta-field">
                <label for="curso_precio"><?php _e( 'Precio (€)', 'cursostic-cursos' ); ?></label>
                <input type="number" id="curso_precio" name="curso_precio" value="<?php echo esc_attr( $precio ); ?>" step="0.01" min="0" placeholder="99.00">
                <p class="description">Deja en blanco o 0 para cursos gratuitos</p>
            </div>

            <div class="cursostic-meta-field">
                <label for="curso_precio_oferta"><?php _e( 'Precio Oferta (€)', 'cursostic-cursos' ); ?></label>
                <input type="number" id="curso_precio_oferta" name="curso_precio_oferta" value="<?php echo esc_attr( $precio_oferta ); ?>" step="0.01" min="0" placeholder="49.00">
                <p class="description">Opcional: Para mostrar descuento</p>
            </div>
        </div>

        <div class="cursostic-meta-row">
            <div class="cursostic-meta-field">
                <label for="curso_duracion"><?php _e( 'Duración', 'cursostic-cursos' ); ?></label>
                <input type="text" id="curso_duracion" name="curso_duracion" value="<?php echo esc_attr( $duracion ); ?>" placeholder="40 horas">
            </div>

            <div class="cursostic-meta-field">
                <label for="curso_plazas_disponibles"><?php _e( 'Plazas Disponibles', 'cursostic-cursos' ); ?></label>
                <input type="number" id="curso_plazas_disponibles" name="curso_plazas_disponibles" value="<?php echo esc_attr( $plazas_disponibles ); ?>" min="0" placeholder="20">
            </div>
        </div>

        <div class="cursostic-meta-row">
            <div class="cursostic-meta-field">
                <label for="curso_fecha_inicio"><?php _e( 'Fecha de Inicio', 'cursostic-cursos' ); ?></label>
                <input type="date" id="curso_fecha_inicio" name="curso_fecha_inicio" value="<?php echo esc_attr( $fecha_inicio ); ?>">
            </div>

            <div class="cursostic-meta-field">
                <label for="curso_fecha_fin"><?php _e( 'Fecha de Fin', 'cursostic-cursos' ); ?></label>
                <input type="date" id="curso_fecha_fin" name="curso_fecha_fin" value="<?php echo esc_attr( $fecha_fin ); ?>">
            </div>
        </div>

        <div class="cursostic-meta-field">
            <label for="curso_instructor"><?php _e( 'Instructor', 'cursostic-cursos' ); ?></label>
            <input type="text" id="curso_instructor" name="curso_instructor" value="<?php echo esc_attr( $instructor ); ?>" placeholder="Nombre del instructor">
        </div>

        <div class="cursostic-meta-field">
            <label for="curso_url_inscripcion"><?php _e( 'URL de Inscripción', 'cursostic-cursos' ); ?></label>
            <input type="url" id="curso_url_inscripcion" name="curso_url_inscripcion" value="<?php echo esc_attr( $url_inscripcion ); ?>" placeholder="https://cursostic.es/inscripcion">
        </div>

        <div class="cursostic-meta-field">
            <label>
                <input type="checkbox" id="curso_certificado" name="curso_certificado" value="1" <?php checked( $certificado, '1' ); ?>>
                <?php _e( 'Incluye certificado oficial', 'cursostic-cursos' ); ?>
            </label>
        </div>
        <?php
    }

    /**
     * Render Meta Box: Contenido
     */
    public function render_meta_box_contenido( $post ) {
        $objetivos = get_post_meta( $post->ID, 'curso_objetivos', true );
        $requisitos = get_post_meta( $post->ID, 'curso_requisitos', true );
        $temario = get_post_meta( $post->ID, 'curso_temario', true );
        ?>
        <style>
            .cursostic-meta-field textarea { width: 100%; min-height: 120px; padding: 8px; }
        </style>

        <div class="cursostic-meta-field">
            <label for="curso_objetivos"><?php _e( 'Objetivos (Qué aprenderás)', 'cursostic-cursos' ); ?></label>
            <textarea id="curso_objetivos" name="curso_objetivos" rows="5"><?php echo esc_textarea( $objetivos ); ?></textarea>
            <p class="description">Un objetivo por línea</p>
        </div>

        <div class="cursostic-meta-field">
            <label for="curso_requisitos"><?php _e( 'Requisitos Previos', 'cursostic-cursos' ); ?></label>
            <textarea id="curso_requisitos" name="curso_requisitos" rows="5"><?php echo esc_textarea( $requisitos ); ?></textarea>
            <p class="description">Un requisito por línea</p>
        </div>

        <div class="cursostic-meta-field">
            <label for="curso_temario"><?php _e( 'Temario del Curso', 'cursostic-cursos' ); ?></label>
            <textarea id="curso_temario" name="curso_temario" rows="10"><?php echo esc_textarea( $temario ); ?></textarea>
            <p class="description">Puedes usar formato libre o listas</p>
        </div>
        <?php
    }

    /**
     * Save Meta Boxes
     */
    public function save_meta_boxes( $post_id, $post ) {
        // Check nonce
        if ( ! isset( $_POST['cursostic_curso_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['cursostic_curso_meta_box_nonce'], 'cursostic_curso_meta_box' ) ) {
            return;
        }

        // Check autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Check permissions
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Save fields
        $fields = array(
            'curso_precio',
            'curso_precio_oferta',
            'curso_duracion',
            'curso_fecha_inicio',
            'curso_fecha_fin',
            'curso_instructor',
            'curso_plazas_disponibles',
            'curso_url_inscripcion',
            'curso_objetivos',
            'curso_requisitos',
            'curso_temario',
        );

        foreach ( $fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }

        // Checkbox field
        update_post_meta( $post_id, 'curso_certificado', isset( $_POST['curso_certificado'] ) ? '1' : '0' );
    }

    /**
     * Enqueue Assets
     */
    public function enqueue_assets() {
        // CSS
        wp_enqueue_style(
            'cursostic-cursos',
            CURSOSTIC_CURSOS_PLUGIN_URL . 'assets/css/cursostic-cursos.css',
            array(),
            CURSOSTIC_CURSOS_VERSION
        );

        // JS
        wp_enqueue_script(
            'cursostic-cursos',
            CURSOSTIC_CURSOS_PLUGIN_URL . 'assets/js/cursostic-cursos.js',
            array( 'jquery' ),
            CURSOSTIC_CURSOS_VERSION,
            true
        );

        wp_localize_script( 'cursostic-cursos', 'cursosticAjax', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'cursostic_nonce' ),
        ) );
    }

    /**
     * Admin Enqueue Assets
     */
    public function admin_enqueue_assets( $hook ) {
        global $post_type;

        if ( 'curso' === $post_type ) {
            wp_enqueue_style(
                'cursostic-cursos-admin',
                CURSOSTIC_CURSOS_PLUGIN_URL . 'assets/css/admin.css',
                array(),
                CURSOSTIC_CURSOS_VERSION
            );
        }
    }

    /**
     * Register Elementor Widgets
     */
    public function register_elementor_widgets( $widgets_manager ) {
        if ( file_exists( CURSOSTIC_CURSOS_PLUGIN_DIR . 'elementor/widgets/curso-grid-widget.php' ) ) {
            require_once CURSOSTIC_CURSOS_PLUGIN_DIR . 'elementor/widgets/curso-grid-widget.php';
            $widgets_manager->register( new \CursosTIC_Curso_Grid_Widget() );
        }
    }

    /**
     * Register Elementor Category
     */
    public function register_elementor_category( $elements_manager ) {
        $elements_manager->add_category(
            'cursostic',
            array(
                'title' => __( 'CursosTIC', 'cursostic-cursos' ),
                'icon'  => 'fa fa-graduation-cap',
            )
        );
    }

    /**
     * AJAX: Filter Courses
     */
    public function ajax_filter_courses() {
        check_ajax_referer( 'cursostic_nonce', 'nonce' );

        $categoria = isset( $_POST['categoria'] ) ? sanitize_text_field( $_POST['categoria'] ) : '';
        $nivel = isset( $_POST['nivel'] ) ? sanitize_text_field( $_POST['nivel'] ) : '';
        $modalidad = isset( $_POST['modalidad'] ) ? sanitize_text_field( $_POST['modalidad'] ) : '';

        $args = array(
            'post_type'      => 'curso',
            'posts_per_page' => -1,
            'tax_query'      => array( 'relation' => 'AND' ),
        );

        if ( $categoria ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'categoria-curso',
                'field'    => 'slug',
                'terms'    => $categoria,
            );
        }

        if ( $nivel ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'nivel-curso',
                'field'    => 'slug',
                'terms'    => $nivel,
            );
        }

        if ( $modalidad ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'modalidad-curso',
                'field'    => 'slug',
                'terms'    => $modalidad,
            );
        }

        $query = new WP_Query( $args );

        ob_start();

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                get_template_part( 'template-parts/content', 'curso-card' );
            }
            wp_reset_postdata();
        } else {
            echo '<p>No se encontraron cursos.</p>';
        }

        $output = ob_get_clean();

        wp_send_json_success( $output );
    }

    /**
     * Shortcode: Cursos Grid
     */
    public function shortcode_cursos_grid( $atts ) {
        $atts = shortcode_atts( array(
            'posts_per_page' => 12,
            'columns'        => 3,
            'categoria'      => '',
            'nivel'          => '',
            'modalidad'      => '',
        ), $atts );

        $args = array(
            'post_type'      => 'curso',
            'posts_per_page' => intval( $atts['posts_per_page'] ),
        );

        if ( ! empty( $atts['categoria'] ) ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'categoria-curso',
                'field'    => 'slug',
                'terms'    => sanitize_text_field( $atts['categoria'] ),
            );
        }

        $query = new WP_Query( $args );

        ob_start();

        if ( $query->have_posts() ) {
            echo '<div class="cursostic-cursos-grid columns-' . esc_attr( $atts['columns'] ) . '">';
            while ( $query->have_posts() ) {
                $query->the_post();
                get_template_part( 'template-parts/content', 'curso-card' );
            }
            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p>No se encontraron cursos.</p>';
        }

        return ob_get_clean();
    }

    /**
     * Shortcode: Cursos Filters
     */
    public function shortcode_cursos_filters( $atts ) {
        ob_start();
        ?>
        <div class="cursostic-filters">
            <select id="filter-categoria">
                <option value="">Todas las categorías</option>
                <?php
                $categorias = get_terms( array( 'taxonomy' => 'categoria-curso', 'hide_empty' => true ) );
                foreach ( $categorias as $cat ) {
                    echo '<option value="' . esc_attr( $cat->slug ) . '">' . esc_html( $cat->name ) . '</option>';
                }
                ?>
            </select>

            <select id="filter-nivel">
                <option value="">Todos los niveles</option>
                <?php
                $niveles = get_terms( array( 'taxonomy' => 'nivel-curso', 'hide_empty' => true ) );
                foreach ( $niveles as $nivel ) {
                    echo '<option value="' . esc_attr( $nivel->slug ) . '">' . esc_html( $nivel->name ) . '</option>';
                }
                ?>
            </select>

            <button class="cursostic-btn-filter">Filtrar</button>
        </div>
        <?php
        return ob_get_clean();
    }
}

/**
 * Initialize the plugin
 */
function cursostic_cursos_init() {
    return CursosTIC_Cursos_Plugin::get_instance();
}
add_action( 'plugins_loaded', 'cursostic_cursos_init' );

/**
 * Activation Hook
 */
function cursostic_cursos_activate() {
    // Set flag to flush rewrite rules
    update_option( 'cursostic_cursos_flush_rewrite_rules', true );

    // Create default terms
    $default_terms = array(
        'nivel-curso' => array( 'Principiante', 'Intermedio', 'Avanzado' ),
        'modalidad-curso' => array( 'Online', 'Presencial', 'Híbrido' ),
    );

    foreach ( $default_terms as $taxonomy => $terms ) {
        foreach ( $terms as $term ) {
            if ( ! term_exists( $term, $taxonomy ) ) {
                wp_insert_term( $term, $taxonomy );
            }
        }
    }
}
register_activation_hook( __FILE__, 'cursostic_cursos_activate' );

/**
 * Deactivation Hook
 */
function cursostic_cursos_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'cursostic_cursos_deactivate' );
