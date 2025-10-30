<?php
/**
 * Advanced Custom Fields Configuration for Cursos
 * Este archivo registra los campos ACF para el custom post type "curso"
 *
 * IMPORTANTE: Instala Advanced Custom Fields si no lo tienes
 * Este código registra los campos por código, pero también puedes crearlos
 * desde la interfaz de ACF en el admin
 *
 * @package Astra Child - CursosTIC
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register ACF Field Groups for Cursos
 * Solo se ejecuta si ACF está activo
 */
function cursostic_register_acf_fields() {

    // Check if ACF function exists
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    /**
     * Field Group: Detalles del Curso
     */
    acf_add_local_field_group( array(
        'key' => 'group_curso_details',
        'title' => 'Detalles del Curso',
        'fields' => array(
            array(
                'key' => 'field_duracion',
                'label' => 'Duración',
                'name' => 'duracion',
                'type' => 'text',
                'instructions' => 'Ej: 40 horas, 3 meses, etc.',
                'placeholder' => '40 horas',
            ),
            array(
                'key' => 'field_precio',
                'label' => 'Precio (€)',
                'name' => 'precio',
                'type' => 'number',
                'instructions' => 'Dejar vacío si el curso es gratis',
                'placeholder' => '0',
                'min' => 0,
            ),
            array(
                'key' => 'field_precio_oferta',
                'label' => 'Precio Oferta (€)',
                'name' => 'precio_oferta',
                'type' => 'number',
                'instructions' => 'Precio con descuento (opcional)',
                'placeholder' => '0',
                'min' => 0,
            ),
            array(
                'key' => 'field_fecha_inicio',
                'label' => 'Fecha de Inicio',
                'name' => 'fecha_inicio',
                'type' => 'date_picker',
                'display_format' => 'd/m/Y',
                'return_format' => 'Y-m-d',
            ),
            array(
                'key' => 'field_fecha_fin',
                'label' => 'Fecha de Fin',
                'name' => 'fecha_fin',
                'type' => 'date_picker',
                'display_format' => 'd/m/Y',
                'return_format' => 'Y-m-d',
            ),
            array(
                'key' => 'field_instructor',
                'label' => 'Instructor',
                'name' => 'instructor',
                'type' => 'text',
                'placeholder' => 'Nombre del instructor',
            ),
            array(
                'key' => 'field_estudiantes',
                'label' => 'Número de Estudiantes',
                'name' => 'estudiantes',
                'type' => 'number',
                'placeholder' => '0',
                'min' => 0,
            ),
            array(
                'key' => 'field_certificado',
                'label' => 'Certificado',
                'name' => 'certificado',
                'type' => 'true_false',
                'message' => 'Este curso incluye certificado',
                'default_value' => 1,
                'ui' => 1,
            ),
            array(
                'key' => 'field_requisitos',
                'label' => 'Requisitos',
                'name' => 'requisitos',
                'type' => 'wysiwyg',
                'instructions' => 'Lista de requisitos del curso',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ),
            array(
                'key' => 'field_que_aprenderas',
                'label' => '¿Qué aprenderás?',
                'name' => 'que_aprenderas',
                'type' => 'wysiwyg',
                'instructions' => 'Objetivos de aprendizaje del curso',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ),
            array(
                'key' => 'field_temario',
                'label' => 'Temario',
                'name' => 'temario',
                'type' => 'repeater',
                'instructions' => 'Módulos y lecciones del curso',
                'button_label' => 'Añadir Módulo',
                'sub_fields' => array(
                    array(
                        'key' => 'field_modulo_titulo',
                        'label' => 'Título del Módulo',
                        'name' => 'titulo',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_modulo_descripcion',
                        'label' => 'Descripción',
                        'name' => 'descripcion',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                ),
            ),
            array(
                'key' => 'field_url_inscripcion',
                'label' => 'URL de Inscripción',
                'name' => 'url_inscripcion',
                'type' => 'url',
                'instructions' => 'Link externo para inscribirse al curso',
                'placeholder' => 'https://',
            ),
            array(
                'key' => 'field_destacado',
                'label' => 'Curso Destacado',
                'name' => 'destacado',
                'type' => 'true_false',
                'message' => 'Mostrar en página de inicio',
                'default_value' => 0,
                'ui' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'curso',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));

    /**
     * Field Group: SEO del Curso
     */
    acf_add_local_field_group( array(
        'key' => 'group_curso_seo',
        'title' => 'SEO del Curso',
        'fields' => array(
            array(
                'key' => 'field_meta_title',
                'label' => 'Meta Title',
                'name' => 'meta_title',
                'type' => 'text',
                'instructions' => 'Óptimo: 50-60 caracteres',
                'maxlength' => 60,
            ),
            array(
                'key' => 'field_meta_description',
                'label' => 'Meta Description',
                'name' => 'meta_description',
                'type' => 'textarea',
                'instructions' => 'Óptimo: 150-160 caracteres',
                'maxlength' => 160,
                'rows' => 3,
            ),
            array(
                'key' => 'field_meta_keywords',
                'label' => 'Meta Keywords',
                'name' => 'meta_keywords',
                'type' => 'text',
                'instructions' => 'Palabras clave separadas por comas',
                'placeholder' => 'curso, TIC, programación',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'curso',
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'normal',
        'style' => 'default',
    ));
}
add_action( 'acf/init', 'cursostic_register_acf_fields' );

/**
 * Helper function to get ACF field with fallback to post meta
 * Esto permite compatibilidad tanto con ACF como con meta boxes nativos
 */
function cursostic_get_field( $field_name, $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    // Try ACF first
    if ( function_exists( 'get_field' ) ) {
        $value = get_field( $field_name, $post_id );
        if ( $value !== false && $value !== null ) {
            return $value;
        }
    }

    // Fallback to post meta
    return get_post_meta( $post_id, '_cursostic_' . $field_name, true );
}
