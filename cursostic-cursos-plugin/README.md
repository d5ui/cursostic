# CursosTIC - Sistema de Cursos

Plugin para gestionar cursos con Custom Post Type, taxonomías, campos personalizados y widgets de Elementor.

**Versión:** 1.0.0

---

## 🎯 ¿Para Qué Sirve Este Plugin?

Este plugin **independiente** te permite gestionar cursos en WordPress de forma profesional, **sin importar qué theme uses** (Astra, Astra Child, o cualquier otro).

### ✅ Ventajas de Usar un Plugin en Lugar del Theme

| Aspecto | ❌ En functions.php del Theme | ✅ En Plugin Independiente |
|---------|------------------------------|---------------------------|
| **Cambiar de theme** | Pierdes todo (CPT, taxonomías, datos) | Mantienes todo funcionando |
| **Actualizar theme** | Riesgo de perder cambios | Sin riesgo |
| **Portabilidad** | No portátil | 100% portátil |
| **Mejores prácticas** | No recomendado | ✅ Recomendado por WordPress.org |
| **Mantenimiento** | Difícil | Fácil |

---

## ✨ Características

### 📚 Custom Post Type "Curso"
- Menú completo en WordPress Admin: **Cursos**
- Taxonomías:
  - **Categorías** (jerárquicas): Programación, Redes, Ciberseguridad, etc.
  - **Niveles** (tags): Principiante, Intermedio, Avanzado
  - **Modalidades** (tags): Online, Presencial, Híbrido

### 📝 Campos Personalizados (Meta Boxes)
- **Detalles del Curso:**
  - Precio (€)
  - Precio de Oferta (€) - con cálculo automático de descuento
  - Duración (ej: "40 horas")
  - Plazas Disponibles
  - Fecha de Inicio
  - Fecha de Fin
  - Instructor
  - URL de Inscripción
  - Incluye Certificado (checkbox)

- **Contenido del Curso:**
  - Objetivos (Qué aprenderás) - textarea
  - Requisitos Previos - textarea
  - Temario del Curso - textarea

### 🎨 Integración con Elementor
- Widget **"Grid de Cursos"** para Elementor
- Categoría personalizada: **CursosTIC**
- Compatible con Display Conditions de Elementor Pro
- Soporte completo para `elementor` en el CPT

### 🔌 Shortcodes
- `[cursostic_cursos_grid]` - Muestra grid de cursos
- `[cursostic_cursos_filters]` - Muestra filtros de cursos

### ⚡ AJAX
- Filtrado de cursos sin recargar la página
- Sistema de filtros por categoría, nivel y modalidad

### 🎯 Automático
- Crea términos por defecto al activar:
  - Niveles: Principiante, Intermedio, Avanzado
  - Modalidades: Online, Presencial, Híbrido
- Flush automático de permalinks
- Compatible con REST API

---

## 📥 Instalación

### Método 1: Instalación Manual (Recomendado)

1. **Descarga la carpeta del plugin** del repositorio:
   ```
   cursostic-cursos-plugin/
   ```

2. **Sube la carpeta** a tu WordPress:
   - Vía FTP/cPanel: Sube a `/wp-content/plugins/`
   - Vía Admin: Comprime la carpeta en ZIP y sube en Plugins → Añadir nuevo

3. **Activa el plugin:**
   - Ve a **Plugins** en WordPress Admin
   - Busca **"CursosTIC - Sistema de Cursos"**
   - Haz clic en **"Activar"**

4. **Verificar:**
   - Deberías ver un nuevo menú: **Cursos** en el panel lateral de WordPress Admin

### Método 2: Vía Git (Para desarrolladores)

```bash
cd /ruta/a/tu/wordpress/wp-content/plugins/
git clone [URL_DEL_REPO] cursostic-cursos-plugin
```

Luego activa el plugin desde WordPress Admin.

---

## 🚀 Uso del Plugin

### 1. Crear un Nuevo Curso

1. Ve a **Cursos → Añadir Nuevo**
2. Introduce:
   - **Título:** Nombre del curso
   - **Contenido:** Descripción general del curso
   - **Imagen destacada:** Imagen del curso (recomendado: 1200x630px)
   - **Excerpt:** Resumen breve para tarjetas

3. **Asigna taxonomías:**
   - Selecciona **Categorías** (ej: Programación)
   - Selecciona **Nivel** (ej: Intermedio)
   - Selecciona **Modalidad** (ej: Online)

4. **Rellena campos personalizados:**
   - Scroll down hasta "Detalles del Curso"
   - Introduce precio, duración, instructor, etc.
   - Scroll down hasta "Contenido del Curso"
   - Introduce objetivos, requisitos y temario

5. **Publica** el curso

### 2. Usar el Widget de Elementor

#### Si tienes Elementor:

1. Edita cualquier página con Elementor
2. Busca el widget: **"Grid de Cursos"** (categoría: CursosTIC)
3. Arrastra el widget a tu página
4. Configura:
   - Número de cursos a mostrar
   - Columnas (2, 3 ó 4)
   - Filtrar por categoría
   - Solo destacados (opcional)
   - Ordenar por fecha/título/aleatorio

5. **Publica**

#### Para el template de Single Curso (Elementor Pro):

1. Ve a **Plantillas → Templates del Tema**
2. Crea nuevo **Single Post Template**
3. En Display Conditions: **"Curso | Todos"**
4. Importa el template `single-curso-template-pro.json`
5. Todos los cursos usarán este diseño automáticamente

### 3. Usar Shortcodes

#### Mostrar Grid de Cursos:

```php
[cursostic_cursos_grid posts_per_page="12" columns="3"]
```

**Parámetros:**
- `posts_per_page` - Número de cursos (default: 12)
- `columns` - Columnas: 2, 3 ó 4 (default: 3)
- `categoria` - Filtrar por slug de categoría
- `nivel` - Filtrar por slug de nivel
- `modalidad` - Filtrar por slug de modalidad

**Ejemplo con filtros:**
```php
[cursostic_cursos_grid posts_per_page="6" columns="2" categoria="programacion" nivel="intermedio"]
```

#### Mostrar Filtros:

```php
[cursostic_cursos_filters]
```

Este shortcode muestra dropdowns para filtrar cursos por categoría y nivel con AJAX.

### 4. Usar en Plantillas PHP

```php
<?php
$args = array(
    'post_type' => 'curso',
    'posts_per_page' => 10,
);

$cursos = new WP_Query( $args );

if ( $cursos->have_posts() ) {
    while ( $cursos->have_posts() ) {
        $cursos->the_post();

        // Obtener campos personalizados
        $precio = get_post_meta( get_the_ID(), 'curso_precio', true );
        $duracion = get_post_meta( get_the_ID(), 'curso_duracion', true );

        // Mostrar curso
        echo '<h2>' . get_the_title() . '</h2>';
        echo '<p>Precio: ' . esc_html( $precio ) . '€</p>';
        echo '<p>Duración: ' . esc_html( $duracion ) . '</p>';
    }
    wp_reset_postdata();
}
?>
```

---

## 🔌 Compatibilidad

### ✅ Compatible con:
- WordPress 5.8+
- PHP 7.4+
- Cualquier theme (Astra, Divi, OceanWP, etc.)
- Elementor (gratis y Pro)
- Gutenberg (Block Editor)
- Classic Editor
- ACF (Advanced Custom Fields) - opcional
- WooCommerce - opcional (para vender cursos)
- WPML / Polylang - para traducción

### 🎨 Themes Recomendados:
- **Astra** (gratis) - El usado en CursosTIC
- Astra Pro
- GeneratePress
- Kadence
- OceanWP
- Hello Elementor

---

## ❓ FAQ

### ¿Puedo usar este plugin con Astra theme (sin child theme)?

**Sí, totalmente.** De hecho, es la configuración recomendada:
- Activa **Astra theme** (el original)
- Activa este **plugin**
- Usa **Elementor** para diseñar las páginas
- Los templates de Elementor funcionarán perfectamente

### ¿Qué pasa con el child theme que teníamos?

El child theme ya no es necesario para el CPT "Cursos". Puedes:
- **Opción A:** Desactivarlo completamente y usar Astra original + este plugin
- **Opción B:** Mantenerlo activado solo para estilos CSS personalizados (pero eliminando el código PHP de cursos)

### ¿Pierdo los cursos que ya tenía creados?

**No.** Los datos están en la base de datos, no en el theme o plugin. Si ya tenías cursos:
1. Activa este plugin
2. Los cursos existentes seguirán ahí
3. Los campos personalizados se mantendrán (siempre que uses los mismos nombres)

### ¿Funciona sin Elementor?

**Sí.** El plugin funciona perfectamente sin Elementor:
- Puedes crear cursos
- Usar shortcodes
- Usar plantillas PHP
- El widget de Elementor simplemente no aparecerá (pero todo lo demás funciona)

### ¿Necesito Elementor Pro?

**No es obligatorio**, pero es muy recomendado si quieres:
- Display Conditions automáticas (aplicar template a todos los cursos)
- Theme Builder para header/footer personalizados
- Más widgets premium

Sin Elementor Pro, puedes aplicar templates manualmente curso por curso.

### ¿Puedo usar WooCommerce para vender los cursos?

**Sí**, hay varias opciones:

1. **WooCommerce + Plugin:** Crea productos de WooCommerce y vincúlalos con cursos
2. **LearnDash + WooCommerce:** Para cursos con lecciones y quizzes
3. **Campo URL de Inscripción:** Apunta a tu página de pago externa

El plugin está preparado para integración con WooCommerce si lo necesitas.

---

## 🛠️ Troubleshooting

### Problema: No veo el menú "Cursos" después de activar

**Solución:**
1. Ve a **Ajustes → Enlaces permanentes**
2. Haz clic en **"Guardar cambios"** (sin cambiar nada)
3. Recarga la página de WordPress Admin
4. El menú "Cursos" debería aparecer

### Problema: Las URLs de cursos dan 404

**Solución:**
```
Ajustes → Enlaces permanentes → Guardar cambios
```

Esto regenera las reglas de rewrite de WordPress.

### Problema: No aparece el widget de Elementor

**Verificar:**
1. ¿Elementor está instalado y activo?
2. ¿El plugin de cursos está activo?
3. Intenta: Elementor → Herramientas → Regenerar CSS

### Problema: Los campos personalizados no se guardan

**Verificar:**
1. ¿Tienes permisos de edición en el post?
2. ¿Hay algún plugin de seguridad bloqueando?
3. Verifica que no haya errores en consola del navegador (F12)

---

## 📁 Estructura del Plugin

```
cursostic-cursos-plugin/
├── cursostic-cursos.php        # Archivo principal del plugin
├── README.md                    # Esta documentación
├── assets/
│   ├── css/
│   │   ├── cursostic-cursos.css  # Estilos frontend
│   │   └── admin.css             # Estilos admin
│   └── js/
│       └── cursostic-cursos.js   # JavaScript frontend (AJAX)
└── elementor/
    └── widgets/
        └── curso-grid-widget.php # Widget de Elementor
```

---

## 🔄 Actualización del Plugin

Para actualizar:

1. **Hacer backup** de la carpeta del plugin
2. **Desactivar** el plugin (no eliminar)
3. Sustituir la carpeta por la nueva versión
4. **Activar** de nuevo el plugin

Los datos de los cursos NO se perderán (están en la base de datos).

---

## 🆘 Soporte

Si tienes problemas:

1. **Verifica requisitos:**
   - WordPress 5.8+
   - PHP 7.4+
   - Theme compatible

2. **Limpia cachés:**
   - WordPress
   - Elementor
   - Plugin de caché
   - Navegador

3. **Verifica permalinks:**
   - Ajustes → Enlaces permanentes → Guardar

4. **Desactiva plugins:**
   - Desactiva otros plugins temporalmente para detectar conflictos

---

## 📄 Licencia

GPL v2 o posterior

---

## 👨‍💻 Autor

**CursosTIC**
- Web: https://cursostic.es
- Version: 1.0.0

---

## 🎉 ¡Listo!

Con este plugin activado, puedes usar **cualquier theme** (Astra, Astra Child, o cualquier otro) y los cursos seguirán funcionando perfectamente.

**Siguiente paso:** Importa los templates de Elementor y empieza a crear cursos 🚀
