/**
 * CursosTIC Main JavaScript
 *
 * @package Astra Child - CursosTIC
 */

(function($) {
    'use strict';

    /**
     * Course Filtering
     */
    function initCourseFilters() {
        const filterForm = $('.cursostic-filters-form');
        const coursesGrid = $('.cursostic-courses-grid');
        const searchForm = $('.cursostic-search-form');

        if (filterForm.length === 0 && searchForm.length === 0) {
            return;
        }

        // Handle filter form submission
        if (filterForm.length) {
            filterForm.on('submit', function(e) {
                e.preventDefault();
                performFilter();
            });

            // Apply filters button
            $('.cursostic-btn-apply').on('click', function(e) {
                e.preventDefault();
                performFilter();
            });

            // Reset filters button
            $('.cursostic-btn-reset').on('click', function(e) {
                e.preventDefault();
                filterForm[0].reset();
                performFilter();
            });

            // Auto-filter on select change (optional - comment out if not desired)
            $('.cursostic-filter-group select').on('change', function() {
                // Uncomment the line below for auto-filtering on select change
                // performFilter();
            });
        }

        // Handle search form submission
        if (searchForm.length) {
            searchForm.on('submit', function(e) {
                e.preventDefault();
                performFilter();
            });
        }

        function performFilter() {
            const categoria = $('#filter-categoria').val() || '';
            const nivel = $('#filter-nivel').val() || '';
            const modalidad = $('#filter-modalidad').val() || '';
            const search = $('.cursostic-search-input').val() || '';

            // Show loading state
            coursesGrid.html('<div class="cursostic-loading"><p>Cargando cursos...</p></div>');

            // Perform AJAX request
            $.ajax({
                url: cursosticAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'cursostic_filter_courses',
                    nonce: cursosticAjax.nonce,
                    categoria: categoria,
                    nivel: nivel,
                    modalidad: modalidad,
                    search: search
                },
                success: function(response) {
                    if (response.success) {
                        coursesGrid.html(response.data);
                        // Add animation to cards
                        $('.cursostic-course-card').each(function(index) {
                            $(this).css('animation-delay', (index * 0.1) + 's');
                            $(this).addClass('cursostic-fade-in');
                        });
                    } else {
                        coursesGrid.html('<div class="cursostic-no-results"><h3>Error al cargar los cursos</h3></div>');
                    }
                },
                error: function() {
                    coursesGrid.html('<div class="cursostic-no-results"><h3>Error al cargar los cursos</h3><p>Por favor, inténtalo de nuevo</p></div>');
                }
            });
        }
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        $('a[href*="#"]').on('click', function(e) {
            const href = $(this).attr('href');
            const target = $(href);

            if (target.length && href.indexOf('#') !== -1) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 600);
            }
        });
    }

    /**
     * Mobile Menu Enhancements
     */
    function initMobileMenu() {
        // Add any mobile menu specific functionality here
        const menuToggle = $('.menu-toggle');

        if (menuToggle.length) {
            menuToggle.on('click', function() {
                $('body').toggleClass('menu-open');
            });
        }
    }

    /**
     * Lazy Load Images (simple implementation)
     */
    function initLazyLoad() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.add('loaded');
                        imageObserver.unobserve(img);
                    }
                });
            });

            const images = document.querySelectorAll('img[data-src]');
            images.forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    /**
     * Add to Cart / Enrollment functionality
     */
    function initEnrollmentButtons() {
        $('.cursostic-course-btn, .cursostic-btn-enroll').on('click', function(e) {
            const url = $(this).data('url');

            if (url) {
                window.location.href = url;
            }
        });
    }

    /**
     * Course Card Hover Effects
     */
    function initCardEffects() {
        $('.cursostic-course-card').hover(
            function() {
                $(this).addClass('hover');
            },
            function() {
                $(this).removeClass('hover');
            }
        );
    }

    /**
     * Search Input Enhancement
     */
    function initSearchInput() {
        const searchInput = $('.cursostic-search-input');

        if (searchInput.length) {
            // Clear button
            searchInput.on('input', function() {
                const clearBtn = $(this).siblings('.search-clear');
                if ($(this).val().length > 0) {
                    if (clearBtn.length === 0) {
                        $(this).after('<button type="button" class="search-clear" aria-label="Limpiar búsqueda">&times;</button>');
                    }
                } else {
                    clearBtn.remove();
                }
            });

            // Clear button click
            $(document).on('click', '.search-clear', function() {
                $(this).siblings('.cursostic-search-input').val('').focus();
                $(this).remove();
            });
        }
    }

    /**
     * Scroll to Top Button
     */
    function initScrollToTop() {
        // Create scroll to top button if it doesn't exist
        if ($('.cursostic-scroll-top').length === 0) {
            $('body').append('<button class="cursostic-scroll-top" aria-label="Volver arriba">↑</button>');
        }

        const scrollTopBtn = $('.cursostic-scroll-top');

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                scrollTopBtn.addClass('visible');
            } else {
                scrollTopBtn.removeClass('visible');
            }
        });

        scrollTopBtn.on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 600);
        });
    }

    /**
     * Form Validation
     */
    function initFormValidation() {
        $('form.cursostic-form').on('submit', function(e) {
            let isValid = true;

            $(this).find('[required]').each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    $(this).addClass('error');
                } else {
                    $(this).removeClass('error');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Por favor, completa todos los campos requeridos.');
            }
        });
    }

    /**
     * Initialize all functions on document ready
     */
    $(document).ready(function() {
        initCourseFilters();
        initSmoothScroll();
        initMobileMenu();
        initLazyLoad();
        initEnrollmentButtons();
        initCardEffects();
        initSearchInput();
        initScrollToTop();
        initFormValidation();

        // Add fade-in animation to existing course cards on page load
        $('.cursostic-course-card').each(function(index) {
            $(this).css('animation-delay', (index * 0.1) + 's');
            $(this).addClass('cursostic-fade-in');
        });
    });

})(jQuery);
