/**
 * CursosTIC Cursos - Frontend JavaScript
 * Version: 1.0.0
 */

(function($) {
    'use strict';

    /**
     * Initialize Filter Functionality
     */
    function initFilters() {
        $('.cursostic-btn-filter').on('click', function(e) {
            e.preventDefault();
            performFilter();
        });

        // Allow Enter key in selects
        $('.cursostic-filters select').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                performFilter();
            }
        });
    }

    /**
     * Perform AJAX Filter
     */
    function performFilter() {
        var categoria = $('#filter-categoria').val();
        var nivel = $('#filter-nivel').val();
        var modalidad = $('#filter-modalidad').val();

        $.ajax({
            url: cursosticAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'cursostic_filter_courses',
                nonce: cursosticAjax.nonce,
                categoria: categoria,
                nivel: nivel,
                modalidad: modalidad
            },
            beforeSend: function() {
                $('.cursostic-cursos-grid').css('opacity', '0.5');
            },
            success: function(response) {
                if (response.success) {
                    $('.cursostic-cursos-grid').html(response.data);
                    $('.cursostic-cursos-grid').css('opacity', '1');
                }
            },
            error: function() {
                alert('Error al filtrar cursos. Por favor, intenta de nuevo.');
                $('.cursostic-cursos-grid').css('opacity', '1');
            }
        });
    }

    /**
     * Initialize when document is ready
     */
    $(document).ready(function() {
        initFilters();
    });

})(jQuery);
