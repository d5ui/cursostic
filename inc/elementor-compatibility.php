<?php
/**
 * Elementor Compatibility for CursosTIC
 * Widgets y compatibilidad con Elementor
 *
 * @package Astra Child - CursosTIC
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Check if Elementor is active
 */
function cursostic_is_elementor_active() {
    return did_action( 'elementor/loaded' );
}

/**
 * Register Elementor Widgets
 */
function cursostic_register_elementor_widgets() {

    if ( ! cursostic_is_elementor_active() ) {
        return;
    }

    // Register custom Elementor widgets here
    require_once( get_stylesheet_directory() . '/inc/elementor-widgets/curso-grid-widget.php' );
    require_once( get_stylesheet_directory() . '/inc/elementor-widgets/curso-search-widget.php' );

    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Cursostic_Curso_Grid_Widget() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Cursostic_Curso_Search_Widget() );
}
add_action( 'elementor/widgets/widgets_registered', 'cursostic_register_elementor_widgets' );

/**
 * Add Elementor support for Curso post type
 */
function cursostic_add_elementor_support_for_curso() {

    if ( ! cursostic_is_elementor_active() ) {
        return;
    }

    // Add curso post type to Elementor
    add_post_type_support( 'curso', 'elementor' );
}
add_action( 'init', 'cursostic_add_elementor_support_for_curso' );

/**
 * Register Elementor custom category
 */
function cursostic_add_elementor_widget_categories( $elements_manager ) {

    $elements_manager->add_category(
        'cursostic',
        array(
            'title' => 'CursosTIC',
            'icon' => 'fa fa-graduation-cap',
        )
    );
}
add_action( 'elementor/elements/categories_registered', 'cursostic_add_elementor_widget_categories' );

/**
 * Ensure Elementor CSS is loaded for cursos
 */
function cursostic_elementor_curso_css() {
    if ( is_singular( 'curso' ) && cursostic_is_elementor_active() ) {
        $post_id = get_the_ID();
        $elementor_data = get_post_meta( $post_id, '_elementor_data', true );

        if ( $elementor_data ) {
            // Elementor is being used for this curso
            \Elementor\Plugin::$instance->frontend->enqueue_styles();
        }
    }
}
add_action( 'wp_enqueue_scripts', 'cursostic_elementor_curso_css' );
