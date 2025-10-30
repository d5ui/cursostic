<?php
/**
 * Elementor Widget: Curso Grid
 * Widget para mostrar grid de cursos en Elementor
 *
 * @package Astra Child - CursosTIC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Cursostic_Curso_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'cursostic_curso_grid';
    }

    public function get_title() {
        return 'Grid de Cursos';
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return array( 'cursostic' );
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            array(
                'label' => 'Configuración',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'posts_per_page',
            array(
                'label' => 'Número de Cursos',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 100,
            )
        );

        $this->add_control(
            'show_featured_only',
            array(
                'label' => 'Solo Destacados',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'Sí',
                'label_off' => 'No',
                'default' => 'no',
            )
        );

        $this->add_control(
            'orderby',
            array(
                'label' => 'Ordenar por',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'date',
                'options' => array(
                    'date' => 'Fecha',
                    'title' => 'Título',
                    'rand' => 'Aleatorio',
                ),
            )
        );

        $this->add_control(
            'order',
            array(
                'label' => 'Orden',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => array(
                    'ASC' => 'Ascendente',
                    'DESC' => 'Descendente',
                ),
            )
        );

        // Category filter
        $categories = get_terms( array(
            'taxonomy' => 'categoria-curso',
            'hide_empty' => false,
        ));

        $category_options = array( '' => 'Todas' );
        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
            foreach ( $categories as $cat ) {
                $category_options[ $cat->slug ] = $cat->name;
            }
        }

        $this->add_control(
            'category',
            array(
                'label' => 'Categoría',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => $category_options,
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $args = array(
            'post_type' => 'curso',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
        );

        if ( $settings['show_featured_only'] === 'yes' ) {
            $args['meta_query'] = array(
                array(
                    'key' => '_cursostic_destacado',
                    'value' => '1',
                    'compare' => '='
                )
            );
        }

        if ( ! empty( $settings['category'] ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'categoria-curso',
                    'field' => 'slug',
                    'terms' => $settings['category'],
                )
            );
        }

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) :
            echo '<div class="cursostic-courses-grid">';
            while ( $query->have_posts() ) : $query->the_post();
                get_template_part( 'template-parts/content', 'curso-card' );
            endwhile;
            echo '</div>';
            wp_reset_postdata();
        else :
            echo '<p>No se encontraron cursos.</p>';
        endif;
    }
}
