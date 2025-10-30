<?php
/**
 * Template Name: Diagnóstico del Sistema
 * Página para diagnosticar problemas con constructores y configuración
 *
 * INSTRUCCIONES:
 * 1. Crea una nueva página en WordPress
 * 2. Selecciona esta plantilla "Diagnóstico del Sistema"
 * 3. Publica y visita la página
 * 4. Verás toda la información del sistema
 *
 * @package Astra Child - CursosTIC
 */

get_header();
?>

<div style="max-width: 1200px; margin: 40px auto; padding: 20px; background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">

    <h1 style="color: #2563eb; margin-bottom: 30px;">🔍 Diagnóstico del Sistema CursosTIC</h1>

    <!-- Theme Activo -->
    <div style="background: #f0f9ff; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #2563eb;">
        <h2 style="margin-top: 0; color: #1e40af;">📱 Theme Activo</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><strong>Theme Actual:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><?php echo wp_get_theme()->get('Name'); ?></td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><strong>Versión:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><?php echo wp_get_theme()->get('Version'); ?></td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><strong>Theme Padre:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><?php echo wp_get_theme()->get('Template'); ?></td>
            </tr>
            <tr>
                <td style="padding: 10px;"><strong>Correcto:</strong></td>
                <td style="padding: 10px;">
                    <?php if (wp_get_theme()->get('Template') === 'astra') : ?>
                        <span style="color: #10b981; font-weight: bold;">✅ SÍ - Child theme de Astra activo</span>
                    <?php else : ?>
                        <span style="color: #ef4444; font-weight: bold;">❌ NO - No es child theme de Astra</span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>

    <!-- Constructores de Páginas Detectados -->
    <div style="background: #fef3c7; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #f59e0b;">
        <h2 style="margin-top: 0; color: #d97706;">🔧 Constructores de Páginas Detectados</h2>
        <?php
        $builders = array(
            'Elementor' => did_action('elementor/loaded'),
            'Divi Builder' => class_exists('ET_Builder_Plugin') || function_exists('et_setup_theme'),
            'Beaver Builder' => class_exists('FLBuilder'),
            'WPBakery' => class_exists('Vc_Manager'),
            'Oxygen Builder' => class_exists('CT_Component'),
            'Brizy' => class_exists('Brizy_Editor'),
            'SiteOrigin' => class_exists('SiteOrigin_Panels'),
            'Thrive Architect' => defined('TVE_VERSION'),
        );

        $active_builders = array_filter($builders);

        if (empty($active_builders)) :
        ?>
            <p style="color: #10b981; font-weight: bold;">✅ No hay constructores de páginas activos</p>
        <?php else : ?>
            <p style="color: #ef4444; font-weight: bold;">⚠️ CONSTRUCTORES ACTIVOS DETECTADOS:</p>
            <ul style="list-style: none; padding: 0;">
                <?php foreach ($active_builders as $builder => $is_active) : ?>
                    <li style="padding: 10px; background: white; margin-bottom: 10px; border-radius: 5px;">
                        <strong style="color: #ef4444;">❌ <?php echo $builder; ?></strong> está ACTIVO
                        <br><small style="color: #6b7280;">Esto puede interferir con las plantillas del theme</small>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div style="background: #fee2e2; padding: 15px; border-radius: 5px; margin-top: 15px;">
                <strong>🔴 SOLUCIÓN:</strong>
                <ol style="margin: 10px 0;">
                    <li>Ve a <strong>Plugins → Plugins instalados</strong></li>
                    <li>Desactiva temporalmente: <?php echo implode(', ', array_keys($active_builders)); ?></li>
                    <li>Recarga la página de inicio y verifica si se soluciona</li>
                    <li>Si funciona, puedes reactivar solo si lo necesitas</li>
                </ol>
            </div>
        <?php endif; ?>
    </div>

    <!-- Configuración de Lectura -->
    <div style="background: #f0fdf4; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #10b981;">
        <h2 style="margin-top: 0; color: #059669;">📖 Configuración de Lectura</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><strong>Tipo de inicio:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;">
                    <?php
                    $show_on_front = get_option('show_on_front');
                    if ($show_on_front === 'page') {
                        echo '<span style="color: #10b981; font-weight: bold;">✅ Página estática</span>';
                    } else {
                        echo '<span style="color: #ef4444; font-weight: bold;">❌ Últimas entradas (INCORRECTO)</span>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><strong>Página de inicio:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;">
                    <?php
                    $page_on_front = get_option('page_on_front');
                    if ($page_on_front) {
                        echo get_the_title($page_on_front) . ' (ID: ' . $page_on_front . ')';
                    } else {
                        echo '<span style="color: #ef4444;">Ninguna seleccionada</span>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px;"><strong>Página de blog:</strong></td>
                <td style="padding: 10px;">
                    <?php
                    $page_for_posts = get_option('page_for_posts');
                    if ($page_for_posts) {
                        echo get_the_title($page_for_posts) . ' (ID: ' . $page_for_posts . ')';
                    } else {
                        echo '<span style="color: #f59e0b;">Ninguna (no es obligatorio)</span>';
                    }
                    ?>
                </td>
            </tr>
        </table>

        <?php if ($show_on_front !== 'page' || !$page_on_front) : ?>
            <div style="background: #fee2e2; padding: 15px; border-radius: 5px; margin-top: 15px;">
                <strong>🔴 PROBLEMA DETECTADO:</strong>
                <p>La configuración de lectura no está correcta.</p>
                <strong>SOLUCIÓN:</strong>
                <ol style="margin: 10px 0;">
                    <li>Ve a <strong>Ajustes → Lectura</strong></li>
                    <li>Selecciona "Una página estática"</li>
                    <li>En "Página de inicio" selecciona tu página "Inicio"</li>
                    <li>Haz clic en "Guardar cambios"</li>
                </ol>
            </div>
        <?php endif; ?>
    </div>

    <!-- Página de Inicio -->
    <?php if ($page_on_front) :
        $homepage = get_post($page_on_front);
    ?>
    <div style="background: #ede9fe; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #8b5cf6;">
        <h2 style="margin-top: 0; color: #7c3aed;">🏠 Página de Inicio</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><strong>Título:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><?php echo get_the_title($page_on_front); ?></td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><strong>Contenido guardado:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;">
                    <?php
                    $content = trim(strip_tags($homepage->post_content));
                    if (empty($content)) {
                        echo '<span style="color: #10b981; font-weight: bold;">✅ Vacío (CORRECTO)</span>';
                    } else {
                        echo '<span style="color: #ef4444; font-weight: bold;">❌ Tiene contenido (' . strlen($content) . ' caracteres)</span>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><strong>Constructor usado:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;">
                    <?php
                    $elementor_data = get_post_meta($page_on_front, '_elementor_edit_mode', true);
                    $divi_data = get_post_meta($page_on_front, '_et_pb_use_builder', true);

                    if ($elementor_data === 'builder') {
                        echo '<span style="color: #ef4444; font-weight: bold;">❌ Elementor activo en esta página</span>';
                    } elseif ($divi_data === 'on') {
                        echo '<span style="color: #ef4444; font-weight: bold;">❌ Divi activo en esta página</span>';
                    } else {
                        echo '<span style="color: #10b981; font-weight: bold;">✅ No detectado</span>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px;"><strong>Plantilla:</strong></td>
                <td style="padding: 10px;">
                    <?php
                    $template = get_page_template_slug($page_on_front);
                    if (empty($template)) {
                        echo '<span style="color: #10b981;">Default (front-page.php se usará automáticamente)</span>';
                    } else {
                        echo '<span style="color: #f59e0b;">' . $template . '</span>';
                    }
                    ?>
                </td>
            </tr>
        </table>

        <?php if (!empty($content)) : ?>
            <div style="background: #fee2e2; padding: 15px; border-radius: 5px; margin-top: 15px;">
                <strong>🔴 PROBLEMA: La página tiene contenido guardado</strong>
                <p><strong>SOLUCIÓN:</strong></p>
                <ol>
                    <li>Ve a <strong>Páginas → <?php echo get_the_title($page_on_front); ?></strong></li>
                    <li><strong>Elimina TODO el contenido</strong> del editor</li>
                    <li>Deja la página completamente vacía</li>
                    <li>Haz clic en "Actualizar"</li>
                </ol>
            </div>
        <?php endif; ?>

        <?php if ($elementor_data === 'builder') : ?>
            <div style="background: #fee2e2; padding: 15px; border-radius: 5px; margin-top: 15px;">
                <strong>🔴 PROBLEMA: Elementor está controlando esta página</strong>
                <p><strong>SOLUCIÓN:</strong></p>
                <ol>
                    <li>Ve a <strong>Páginas → <?php echo get_the_title($page_on_front); ?></strong></li>
                    <li>En "Configuración de Elementor", cambia a "WordPress default"</li>
                    <li>Actualiza la página</li>
                </ol>
            </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Custom Post Types -->
    <div style="background: #fff7ed; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #f97316;">
        <h2 style="margin-top: 0; color: #ea580c;">📚 Custom Post Type "Cursos"</h2>
        <?php
        $cursos_count = wp_count_posts('curso');
        if ($cursos_count) :
        ?>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><strong>Cursos publicados:</strong></td>
                    <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;">
                        <?php echo $cursos_count->publish; ?>
                        <?php if ($cursos_count->publish > 0) : ?>
                            <span style="color: #10b981; font-weight: bold;">✅</span>
                        <?php else : ?>
                            <span style="color: #f59e0b; font-weight: bold;">⚠️ No hay cursos publicados</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><strong>Borradores:</strong></td>
                    <td style="padding: 10px; border-bottom: 1px solid #e5e7eb;"><?php echo $cursos_count->draft; ?></td>
                </tr>
            </table>
        <?php else : ?>
            <p style="color: #ef4444;">❌ El custom post type "curso" no está registrado</p>
        <?php endif; ?>
    </div>

    <!-- Plugins Activos -->
    <div style="background: #f5f3ff; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #a78bfa;">
        <h2 style="margin-top: 0; color: #7c3aed;">🔌 Plugins Activos Relevantes</h2>
        <?php
        $active_plugins = get_option('active_plugins');
        $relevant_plugins = array();

        foreach ($active_plugins as $plugin) {
            if (
                strpos($plugin, 'elementor') !== false ||
                strpos($plugin, 'divi') !== false ||
                strpos($plugin, 'beaver') !== false ||
                strpos($plugin, 'wpbakery') !== false ||
                strpos($plugin, 'oxygen') !== false ||
                strpos($plugin, 'woocommerce') !== false ||
                strpos($plugin, 'acf') !== false ||
                strpos($plugin, 'cache') !== false ||
                strpos($plugin, 'optimization') !== false
            ) {
                $relevant_plugins[] = $plugin;
            }
        }

        if (!empty($relevant_plugins)) :
        ?>
            <ul style="list-style: none; padding: 0;">
                <?php foreach ($relevant_plugins as $plugin) :
                    $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
                ?>
                    <li style="padding: 10px; background: white; margin-bottom: 10px; border-radius: 5px;">
                        <strong><?php echo $plugin_data['Name']; ?></strong>
                        <br><small style="color: #6b7280;"><?php echo $plugin; ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No se detectaron plugins relevantes activos</p>
        <?php endif; ?>
    </div>

    <!-- Resumen de Acciones -->
    <div style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); padding: 30px; border-radius: 8px; color: white;">
        <h2 style="margin-top: 0; color: white;">📋 Resumen de Acciones Recomendadas</h2>
        <?php
        $actions = array();

        if ($show_on_front !== 'page' || !$page_on_front) {
            $actions[] = '1. ⚠️ Configura una página estática como inicio en Ajustes → Lectura';
        }

        if ($page_on_front && !empty(trim(strip_tags(get_post($page_on_front)->post_content)))) {
            $actions[] = '2. ⚠️ Vacía el contenido de tu página de inicio';
        }

        if (!empty($active_builders)) {
            $actions[] = '3. 🔴 CRÍTICO: Desactiva los constructores de páginas: ' . implode(', ', array_keys($active_builders));
        }

        if (empty($actions)) :
        ?>
            <p style="font-size: 1.2rem; font-weight: bold;">✅ ¡Todo parece estar correcto!</p>
            <p>Si aún ves problemas, limpia la caché del navegador (Ctrl+Shift+R) y recarga.</p>
        <?php else : ?>
            <ol style="margin: 15px 0; padding-left: 20px; font-size: 1.05rem;">
                <?php foreach ($actions as $action) : ?>
                    <li style="margin-bottom: 15px;"><?php echo $action; ?></li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
    </div>

</div>

<?php get_footer(); ?>
