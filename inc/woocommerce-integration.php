<?php
/**
 * WooCommerce Integration for CursosTIC
 * Integra los cursos con productos de WooCommerce
 *
 * @package Astra Child - CursosTIC
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Check if WooCommerce is active
 */
if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    return;
}

/**
 * Add WooCommerce support to theme
 */
function cursostic_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'cursostic_add_woocommerce_support' );

/**
 * Add custom product type: Curso
 */
class WC_Product_Curso extends WC_Product {

    public function __construct( $product ) {
        $this->product_type = 'curso';
        parent::__construct( $product );
    }

    public function get_type() {
        return 'curso';
    }
}

/**
 * Register Curso product type
 */
function cursostic_register_curso_product_type() {
    class WC_Product_Curso_Type {
        public function __construct() {
            add_filter( 'product_type_selector', array( $this, 'add_curso_product_type' ) );
            add_filter( 'woocommerce_product_data_tabs', array( $this, 'add_curso_product_data_tab' ) );
            add_action( 'woocommerce_product_data_panels', array( $this, 'add_curso_product_data_fields' ) );
            add_action( 'woocommerce_process_product_meta', array( $this, 'save_curso_product_data_fields' ) );
        }

        public function add_curso_product_type( $types ) {
            $types['curso'] = 'Curso';
            return $types;
        }

        public function add_curso_product_data_tab( $tabs ) {
            $tabs['curso'] = array(
                'label'    => 'Datos del Curso',
                'target'   => 'curso_product_data',
                'priority' => 21,
            );
            return $tabs;
        }

        public function add_curso_product_data_fields() {
            global $post;
            ?>
            <div id="curso_product_data" class="panel woocommerce_options_panel">
                <?php
                woocommerce_wp_text_input( array(
                    'id'          => '_curso_duracion',
                    'label'       => 'Duración',
                    'placeholder' => '40 horas',
                    'desc_tip'    => 'true',
                    'description' => 'Duración del curso',
                ));

                woocommerce_wp_text_input( array(
                    'id'          => '_curso_instructor',
                    'label'       => 'Instructor',
                    'placeholder' => 'Nombre del instructor',
                ));

                woocommerce_wp_select( array(
                    'id'      => '_curso_nivel',
                    'label'   => 'Nivel',
                    'options' => array(
                        'basico'      => 'Básico',
                        'intermedio'  => 'Intermedio',
                        'avanzado'    => 'Avanzado',
                        'experto'     => 'Experto',
                    ),
                ));

                woocommerce_wp_checkbox( array(
                    'id'          => '_curso_certificado',
                    'label'       => 'Incluye Certificado',
                    'description' => 'El curso incluye certificado',
                ));

                woocommerce_wp_textarea_input( array(
                    'id'          => '_curso_requisitos',
                    'label'       => 'Requisitos',
                    'placeholder' => 'Requisitos del curso',
                    'desc_tip'    => 'true',
                ));
                ?>
            </div>
            <?php
        }

        public function save_curso_product_data_fields( $post_id ) {
            $fields = array(
                '_curso_duracion',
                '_curso_instructor',
                '_curso_nivel',
                '_curso_certificado',
                '_curso_requisitos',
            );

            foreach ( $fields as $field ) {
                if ( isset( $_POST[ $field ] ) ) {
                    update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
                }
            }
        }
    }

    new WC_Product_Curso_Type();
}
add_action( 'init', 'cursostic_register_curso_product_type' );

/**
 * Link Curso post type with WooCommerce products
 * Añade un campo en el curso para vincular con un producto
 */
function cursostic_add_product_link_metabox() {
    add_meta_box(
        'cursostic_product_link',
        'Vincular con Producto WooCommerce',
        'cursostic_product_link_callback',
        'curso',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'cursostic_add_product_link_metabox' );

function cursostic_product_link_callback( $post ) {
    wp_nonce_field( 'cursostic_save_product_link', 'cursostic_product_link_nonce' );

    $product_id = get_post_meta( $post->ID, '_cursostic_product_id', true );

    // Get all products
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );

    $products = get_posts( $args );
    ?>
    <p>
        <label for="cursostic_product_id">Producto vinculado:</label>
        <select id="cursostic_product_id" name="cursostic_product_id" style="width: 100%;">
            <option value="">-- Ninguno --</option>
            <?php foreach ( $products as $product ) : ?>
                <option value="<?php echo $product->ID; ?>" <?php selected( $product_id, $product->ID ); ?>>
                    <?php echo esc_html( $product->post_title ); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p class="description">
        Si vinculas este curso con un producto, el botón "Inscribirme" llevará a la página del producto.
    </p>
    <?php
}

function cursostic_save_product_link( $post_id ) {
    if ( ! isset( $_POST['cursostic_product_link_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['cursostic_product_link_nonce'], 'cursostic_save_product_link' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['cursostic_product_id'] ) ) {
        update_post_meta( $post_id, '_cursostic_product_id', sanitize_text_field( $_POST['cursostic_product_id'] ) );
    }
}
add_action( 'save_post_curso', 'cursostic_save_product_link' );

/**
 * Modify curso card button if linked to product
 */
function cursostic_get_curso_link( $post_id ) {
    // Check if linked to a product
    $product_id = get_post_meta( $post_id, '_cursostic_product_id', true );

    if ( $product_id ) {
        return get_permalink( $product_id );
    }

    // Check for custom URL
    $url_inscripcion = get_post_meta( $post_id, '_cursostic_url_inscripcion', true );

    if ( $url_inscripcion ) {
        return $url_inscripcion;
    }

    // Default to curso permalink
    return get_permalink( $post_id );
}

/**
 * Add curso info to WooCommerce product page
 */
function cursostic_add_curso_info_to_product() {
    global $post;

    // Check if this product is linked to a curso
    $args = array(
        'post_type' => 'curso',
        'meta_query' => array(
            array(
                'key' => '_cursostic_product_id',
                'value' => $post->ID,
                'compare' => '='
            )
        ),
        'posts_per_page' => 1
    );

    $curso_query = new WP_Query( $args );

    if ( $curso_query->have_posts() ) {
        while ( $curso_query->have_posts() ) {
            $curso_query->the_post();
            $curso_id = get_the_ID();

            $duracion = get_post_meta( $curso_id, '_cursostic_duracion', true );
            $instructor = get_post_meta( $curso_id, '_cursostic_instructor', true );
            $nivel_terms = get_the_terms( $curso_id, 'nivel-curso' );
            $certificado = get_post_meta( $curso_id, '_cursostic_certificado', true );

            ?>
            <div class="cursostic-product-curso-info" style="background: var(--cursostic-bg-light); padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h3 style="margin-top: 0;">Información del Curso</h3>
                <ul style="list-style: none; padding: 0;">
                    <?php if ( $duracion ) : ?>
                        <li><strong>Duración:</strong> <?php echo esc_html( $duracion ); ?></li>
                    <?php endif; ?>

                    <?php if ( $instructor ) : ?>
                        <li><strong>Instructor:</strong> <?php echo esc_html( $instructor ); ?></li>
                    <?php endif; ?>

                    <?php if ( $nivel_terms && ! is_wp_error( $nivel_terms ) ) : ?>
                        <li><strong>Nivel:</strong> <?php echo esc_html( $nivel_terms[0]->name ); ?></li>
                    <?php endif; ?>

                    <?php if ( $certificado ) : ?>
                        <li><strong>Certificado:</strong> Sí</li>
                    <?php endif; ?>
                </ul>

                <a href="<?php echo get_permalink( $curso_id ); ?>" class="button">
                    Ver información completa del curso →
                </a>
            </div>
            <?php
        }
        wp_reset_postdata();
    }
}
add_action( 'woocommerce_single_product_summary', 'cursostic_add_curso_info_to_product', 25 );

/**
 * Customize WooCommerce loop for curso products
 */
function cursostic_customize_woocommerce_loop() {
    // Add custom classes or modify loop behavior if needed
}
add_action( 'woocommerce_before_shop_loop', 'cursostic_customize_woocommerce_loop' );
