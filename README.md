# Astra Child Theme - CursosTIC

Child theme profesional de Astra optimizado para sitios web de cursos TIC con funcionalidades completas de SEO, custom post types, filtros, y diseño moderno.

## 🚀 Características Principales

- ✅ **Custom Post Type "Cursos"** con campos personalizados completos
- ✅ **Sistema de filtros avanzado** (categoría, nivel, modalidad)
- ✅ **Buscador de cursos** con AJAX
- ✅ **Tarjetas de cursos vistosas** con diseño moderno
- ✅ **Fichas individuales de curso** completamente personalizadas
- ✅ **Blog personalizado** con diseño atractivo
- ✅ **Optimización SEO** completa (meta tags, Schema.org)
- ✅ **Breadcrumbs** automáticos
- ✅ **Responsive** 100% mobile-friendly
- ✅ **Taxonomías personalizadas** (Categorías, Niveles, Modalidades)
- ✅ **Colores personalizables** mediante variables CSS

## 📋 Requisitos

### Theme Requerido
- **Astra Theme** (versión gratuita): [Descargar desde WordPress.org](https://wordpress.org/themes/astra/)

### Plugins Recomendados (Todos Gratuitos)

#### Esenciales:
1. **Yoast SEO** o **Rank Math**
   - URL: https://wordpress.org/plugins/wordpress-seo/
   - Función: SEO adicional, sitemap XML, análisis de contenido
   - Nota: El theme ya incluye meta tags y Schema.org, pero estos plugins añaden más funcionalidades

2. **Contact Form 7**
   - URL: https://wordpress.org/plugins/contact-form-7/
   - Función: Formularios de contacto e inscripción a cursos

3. **Really Simple SSL**
   - URL: https://wordpress.org/plugins/really-simple-ssl/
   - Función: Configuración automática de HTTPS

#### Optimización y Rendimiento:
4. **LiteSpeed Cache** o **WP Super Cache**
   - URL: https://wordpress.org/plugins/litespeed-cache/
   - Función: Caché de páginas, optimización de rendimiento

5. **Smush** (Image Optimization)
   - URL: https://wordpress.org/plugins/wp-smushit/
   - Función: Optimización automática de imágenes

6. **Autoptimize**
   - URL: https://wordpress.org/plugins/autoptimize/
   - Función: Minificación de CSS, JS y HTML

#### Funcionalidades Adicionales:
7. **Elementor** (opcional, para edición visual)
   - URL: https://wordpress.org/plugins/elementor/
   - Función: Constructor visual de páginas (compatible con Astra)
   - Nota: No necesario si prefieres usar el editor clásico

8. **WP Mail SMTP**
   - URL: https://wordpress.org/plugins/wp-mail-smtp/
   - Función: Mejora la entrega de correos electrónicos

9. **UpdraftPlus** (Backups)
   - URL: https://wordpress.org/plugins/updraftplus/
   - Función: Copias de seguridad automáticas

10. **Wordfence Security**
    - URL: https://wordpress.org/plugins/wordfence/
    - Función: Seguridad y firewall

#### Para E-commerce (si vendes cursos):
11. **WooCommerce** (opcional)
    - URL: https://wordpress.org/plugins/woocommerce/
    - Función: Tienda online para vender cursos
    - Nota: Si usas este plugin, los cursos pueden integrarse con productos

## 📦 Instalación

### Paso 1: Instalar Theme Astra
1. Ve a **Apariencia → Temas → Añadir nuevo**
2. Busca "Astra"
3. Instala y activa el theme Astra

### Paso 2: Instalar Child Theme
1. Descarga este child theme como archivo ZIP
2. Ve a **Apariencia → Temas → Añadir nuevo → Subir tema**
3. Selecciona el archivo ZIP del child theme
4. Instala y **activa** el child theme "Astra Child - CursosTIC"

### Paso 3: Configuración Inicial
1. Ve a **Ajustes → Enlaces permanentes**
2. Selecciona "Nombre de la entrada" y guarda
3. Esto actualizará las reglas de reescritura para los cursos

### Paso 4: Crear Taxonomías Iniciales
1. Ve a **Cursos → Categorías** y crea algunas categorías:
   - Programación
   - Redes y Sistemas
   - Diseño Web
   - Ciberseguridad
   - Bases de Datos
   - etc.

2. Ve a **Cursos → Niveles** y crea:
   - Básico
   - Intermedio
   - Avanzado
   - Experto

3. Ve a **Cursos → Modalidades** y crea:
   - Online
   - Presencial
   - Semipresencial
   - A tu ritmo

### Paso 5: Crear Páginas Necesarias

#### Página de Cursos:
1. Ve a **Páginas → Añadir nueva**
2. Título: "Cursos"
3. En "Atributos de página" → "Plantilla": selecciona **"Página de Cursos"**
4. Publica la página
5. Esta será tu página principal de cursos con buscador y filtros

#### Página de Inicio:
1. Crea una nueva página llamada "Inicio"
2. Publica la página
3. Ve a **Ajustes → Lectura**
4. Selecciona "Una página estática"
5. En "Página de inicio" selecciona "Inicio"
6. En "Página de entradas" crea y selecciona una página "Blog"

### Paso 6: Personalizar Colores

Los colores se pueden personalizar fácilmente editando las variables CSS en `style.css` (líneas 23-39):

```css
:root {
    --cursostic-primary: #2563eb;        /* Cambia este valor para tu color primario */
    --cursostic-secondary: #10b981;      /* Color secundario */
    --cursostic-accent: #f59e0b;         /* Color de acento */
    /* ... más colores ... */
}
```

**Tus colores actuales** (azules profesionales ya configurados):
- Primario: #2563eb (azul vibrante)
- Secundario: #10b981 (verde éxito)
- Acento: #f59e0b (naranja/amarillo)

## 📝 Uso del Custom Post Type "Cursos"

### Crear un Nuevo Curso:
1. Ve a **Cursos → Añadir nuevo**
2. Rellena el título y descripción del curso
3. Añade una imagen destacada (recomendado: 800x500px)
4. Selecciona categoría, nivel y modalidad

### Campos Personalizados Disponibles:

#### Detalles del Curso:
- **Duración**: Ej: "40 horas", "3 meses", etc.
- **Precio**: Precio en euros (dejar vacío si es gratis)
- **Precio Oferta**: Si hay descuento
- **Fecha de Inicio/Fin**: Fechas del curso
- **Instructor**: Nombre del profesor
- **Número de Estudiantes**: Estudiantes inscritos
- **Certificado**: Sí/No
- **Requisitos**: Un requisito por línea
- **¿Qué aprenderás?**: Un ítem por línea
- **URL de Inscripción**: Link externo para inscribirse
- **Curso Destacado**: Checkbox para mostrarlo en inicio

#### SEO del Curso:
- **Meta Title**: Título SEO (50-60 caracteres)
- **Meta Description**: Descripción SEO (150-160 caracteres)
- **Meta Keywords**: Palabras clave separadas por comas

## 🎨 Personalización Avanzada

### Modificar el Banner Principal:
Edita el archivo `page-cursos.php` o `front-page.php`:
- Cambia el texto del H1 y párrafo
- Ajusta el gradiente del fondo modificando las variables CSS

### Añadir un Logo:
1. Ve a **Apariencia → Personalizar → Identidad del sitio**
2. Sube tu logo (recomendado: 400x100px, fondo transparente)

### Personalizar el Footer:
El theme incluye 3 áreas de widgets en el footer:
1. Ve a **Apariencia → Widgets**
2. Añade widgets a "Footer 1", "Footer 2" y "Footer 3"

### Modificar el Menú:
1. Ve a **Apariencia → Menús**
2. Crea un nuevo menú
3. Añade páginas (Inicio, Cursos, Blog, Contacto, etc.)
4. Asigna el menú a "Primary Menu"

## 🔍 SEO - Funcionalidades Incluidas

El theme incluye optimizaciones SEO automáticas:

1. **Meta Tags**: Title, Description, Keywords personalizables por curso
2. **Open Graph**: Para compartir en redes sociales (Facebook, Twitter)
3. **Schema.org JSON-LD**: Marcado de datos estructurados para cursos
4. **Breadcrumbs**: Navegación jerárquica automática
5. **URLs Amigables**: Estructura SEO-friendly
6. **Imágenes Alt Tags**: Soporte para etiquetas alt en imágenes
7. **Sitemap**: Compatible con plugins de sitemap XML

### Recomendaciones SEO Adicionales:
- Instala Yoast SEO o Rank Math para análisis adicional
- Rellena siempre los campos Meta Title y Description
- Usa palabras clave relevantes en títulos y descripciones
- Añade imágenes optimizadas (usa Smush)
- Crea contenido de calidad en la descripción de cursos
- Mantén URLs cortas y descriptivas

## 📱 Responsive Design

El theme es 100% responsive con breakpoints en:
- Desktop: > 1024px
- Tablet: 768px - 1024px
- Mobile: < 768px

Todo el diseño se adapta automáticamente a diferentes tamaños de pantalla.

## 🎯 Estructura de Archivos

```
astra-child-cursostic/
├── style.css                      # Estilos principales del theme
├── functions.php                  # Funcionalidades PHP
├── front-page.php                 # Página de inicio
├── page-cursos.php                # Página de listado de cursos
├── single-curso.php               # Ficha individual de curso
├── archive-curso.php              # Archivo de cursos
├── archive.php                    # Archivo general (blog)
├── single.php                     # Entrada individual de blog
├── template-parts/
│   ├── content-curso-card.php     # Tarjeta de curso
│   └── content-blog-card.php      # Tarjeta de blog
├── assets/
│   ├── js/
│   │   └── cursostic-main.js      # JavaScript principal
│   └── images/
│       └── default-course.jpg     # Imagen por defecto
└── README.md                      # Este archivo
```

## 🛠️ Funcionalidades JavaScript

El archivo `cursostic-main.js` incluye:
- Filtrado AJAX de cursos
- Búsqueda en tiempo real
- Scroll suave
- Botón "Volver arriba"
- Lazy loading de imágenes
- Efectos hover en tarjetas
- Validación de formularios

## 🎨 Variables CSS Personalizables

Todas las variables CSS están en `style.css` (líneas 23-50):

```css
/* Colores principales */
--cursostic-primary: #2563eb;
--cursostic-secondary: #10b981;
--cursostic-accent: #f59e0b;

/* Colores de texto */
--cursostic-text-primary: #1f2937;
--cursostic-text-secondary: #6b7280;

/* Fondos */
--cursostic-bg-light: #f9fafb;
--cursostic-bg-white: #ffffff;

/* Sombras */
--cursostic-shadow: 0 1px 3px rgba(0,0,0,0.1);
--cursostic-shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
```

## 🔄 Actualizaciones del Theme

Para actualizar el child theme:
1. Haz backup de tus personalizaciones
2. Descarga la nueva versión
3. Sube y reemplaza los archivos
4. Los colores y ajustes CSS personalizados se mantendrán

## 📞 Soporte y Contacto

Para dudas sobre el theme:
- Documentación de Astra: https://wpastra.com/docs/
- Foro de WordPress: https://wordpress.org/support/

## 🆕 Changelog

### Versión 1.0.0 (2025)
- Lanzamiento inicial
- Custom Post Type "Cursos"
- Sistema de filtros AJAX
- Buscador de cursos
- Blog personalizado
- SEO completo con Schema.org
- Breadcrumbs
- Responsive design
- 3 taxonomías personalizadas
- Meta boxes personalizados

## 📄 Licencia

GPL v2 or later

---

**Desarrollado para CursosTIC.es** - Theme profesional optimizado para plataformas de cursos TIC
