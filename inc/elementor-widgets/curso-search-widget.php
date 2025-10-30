<?php
/**
 * Elementor Widget: Curso Search
 * Widget de búsqueda de cursos para Elementor
 *
 * @package Astra Child - CursosTIC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Cursostic_Curso_Search_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'cursostic_curso_search';
    }

    public function get_title() {
        return 'Buscador de Cursos';
    }

    public function get_icon() {
        return 'eicon-search';
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
            'placeholder',
            array(
                'label' => 'Texto del Placeholder',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '¿Qué quieres aprender hoy?',
            )
        );

        $this->add_control(
            'button_text',
            array(
                'label' => 'Texto del Botón',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Buscar',
            )
        );

        $this->add_control(
            'show_filters',
            array(
                'label' => 'Mostrar Filtros',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'Sí',
                'label_off' => 'No',
                'default' => 'yes',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="cursostic-search-wrapper">
            <form class="cursostic-search-form" action="<?php echo home_url( '/cursos/' ); ?>" method="get" role="search">
                <input type="search"
                       class="cursostic-search-input"
                       placeholder="<?php echo esc_attr( $settings['placeholder'] ); ?>"
                       aria-label="Buscar cursos"
                       name="s">
                <button type="submit"><?php echo esc_html( $settings['button_text'] ); ?></button>
            </form>
        </div>

        <?php if ( $settings['show_filters'] === 'yes' ) : ?>
            <div class="cursostic-filters-wrapper">
                <h3 class="cursostic-filters-title">Filtrar Cursos</h3>
                <form class="cursostic-filters-form">
                    <div class="cursostic-filters">

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
                                        echo '<option value="' . esc_attr( $categoria->slug ) . '">' . esc_html( $categoria->name ) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

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
                                        echo '<option value="' . esc_attr( $nivel->slug ) . '">' . esc_html( $nivel->name ) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

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
                                        echo '<option value="' . esc_attr( $modalidad->slug ) . '">' . esc_html( $modalidad->name ) . '</option>';
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
        <?php endif; ?>
        <?php
    }
}
