# 🔍 PLUGINS RECOMENDADOS PARA FILTROS AVANZADOS

## ✅ OPCIÓN 1: Sin Plugin (Incluido en el Theme)

El theme YA incluye filtros funcionales con AJAX. **No necesitas plugin adicional** para funcionalidad básica.

**Características incluidas:**
- ✅ Filtro por categoría
- ✅ Filtro por nivel
- ✅ Filtro por modalidad
- ✅ Filtro por precio (gratis/pago)
- ✅ Buscador por texto
- ✅ Ordenar por fecha/título/popularidad
- ✅ Funcionamiento con AJAX (sin recargar)
- ✅ 100% gratis

**Cuándo usar:** Para la mayoría de casos es suficiente.

---

## 🚀 OPCIÓN 2: FacetWP (RECOMENDADO si necesitas más)

**Plugin:** FacetWP
**Precio:** Premium ($99/año) - PERO hay versión lite gratuita
**Descarga:** https://facetwp.com/
**GitHub (versión lite):** https://github.com/FacetWP/facetwp-lite

### ¿Por qué FacetWP?
✅ El más potente para WordPress
✅ Funciona perfectamente con Elementor
✅ Compatible con custom post types (nuestros cursos)
✅ Filtros avanzados: rango de precios, checkboxes, radio, etc.
✅ AJAX automático
✅ SEO-friendly

### Instalación FacetWP:

```
1. Instala el plugin FacetWP
2. Ve a Settings → FacetWP
3. Crea un nuevo facet:
   - Tipo: Taxonomy
   - Taxonomía: categoria-curso
   - Label: Categoría
4. Crea más facets para nivel, modalidad, etc.
5. Inserta shortcode en Elementor: [facetwp facet="categoria"]
```

### Shortcodes FacetWP:

```html
<!-- En el sidebar de Elementor, añade widget "Shortcode" -->

<!-- Filtro por categoría -->
[facetwp facet="categoria"]

<!-- Filtro por nivel -->
[facetwp facet="nivel"]

<!-- Filtro por modalidad -->
[facetwp facet="modalidad"]

<!-- Rango de precios -->
[facetwp facet="precio"]

<!-- Buscador -->
[facetwp facet="buscar"]

<!-- Botón "Limpiar filtros" -->
[facetwp reset="true"]

<!-- Mostrar resultados -->
[facetwp template="cursos"]
```

---

## 💎 OPCIÓN 3: JetSmartFilters (Para Elementor Pro)

**Plugin:** JetSmartFilters by Crocoblock
**Precio:** $26/año (o incluido en Crocoblock All-Access)
**URL:** https://crocoblock.com/plugins/jetsmartfilters/

### ¿Por qué JetSmartFilters?
✅ Diseñado específicamente para Elementor
✅ Widgets visuales de filtros
✅ Muy fácil de configurar
✅ Múltiples estilos de filtros
✅ Integración perfecta con JetEngine

### Instalación:

```
1. Instala JetSmartFilters
2. En Elementor, busca widgets "JetSmartFilters"
3. Arrastra widgets de filtros al sidebar
4. Configura cada filtro para las taxonomías de cursos
5. ¡Funciona automáticamente!
```

---

## 🆓 OPCIÓN 4: FiboSearch (Solo Búsqueda Mejorada)

**Plugin:** FiboSearch (antes Ajax Search Pro)
**Precio:** GRATIS (con versión Pro)
**URL:** https://wordpress.org/plugins/ajax-search-for-woocommerce/

### Características:
✅ Búsqueda instantánea mientras escribes
✅ Resultados en tiempo real
✅ Compatible con custom post types
✅ Diseño personalizable

### Uso:
```
1. Instala FiboSearch
2. Ve a Settings → FiboSearch
3. Habilita "curso" en post types
4. Usa shortcode: [fibosearch]
```

---

## 🎨 OPCIÓN 5: SearchWP (Búsqueda Avanzada)

**Plugin:** SearchWP
**Precio:** $99/año
**URL:** https://searchwp.com/

### ¿Por qué SearchWP?
✅ Mejora la búsqueda nativa de WordPress
✅ Busca en campos personalizados
✅ Busca en taxonomías
✅ Resultados más relevantes
✅ Compatible con FacetWP

---

## 📊 COMPARATIVA RÁPIDA

| Plugin | Precio | Facilidad | Potencia | Elementor |
|--------|--------|-----------|----------|-----------|
| **Theme (incluido)** | Gratis | ⭐⭐⭐⭐⭐ | ⭐⭐⭐ | ✅ |
| **FacetWP** | $99/año | ⭐⭐⭐⭐ | ⭐⭐⭐⭐⭐ | ✅ |
| **JetSmartFilters** | $26/año | ⭐⭐⭐⭐⭐ | ⭐⭐⭐⭐ | ✅✅✅ |
| **FiboSearch** | Gratis | ⭐⭐⭐⭐⭐ | ⭐⭐⭐ | ✅ |
| **SearchWP** | $99/año | ⭐⭐⭐ | ⭐⭐⭐⭐⭐ | ✅ |

---

## 🎯 MI RECOMENDACIÓN

### Para empezar:
**Usa los filtros incluidos en el theme** (gratis, ya funcionan, suficiente para el 90% de casos)

### Si necesitas más funcionalidad:
**JetSmartFilters** ($26/año) - Mejor relación calidad-precio, integración perfecta con Elementor

### Si tienes presupuesto:
**FacetWP** ($99/año) - El más potente, usado por sitios grandes

### Solo para búsqueda:
**FiboSearch** (gratis) - Búsqueda instantánea mientras escribes

---

## 🛠️ CONFIGURACIÓN CON JETSMARTFILTERS (Paso a Paso)

Si decides usar JetSmartFilters, aquí está la configuración exacta:

### 1. Instalación
```
Plugins → Añadir nuevo → Buscar "JetSmartFilters"
Instalar → Activar
```

### 2. Crear Filtros

**Ir a:** JetSmartFilters → Add New

**Filtro 1: Categoría**
- Filter Type: Check Boxes
- Data Source: Taxonomies → categoria-curso
- Query Variable: categoria-curso
- Guardar

**Filtro 2: Nivel**
- Filter Type: Radio
- Data Source: Taxonomies → nivel-curso
- Query Variable: nivel-curso
- Guardar

**Filtro 3: Modalidad**
- Filter Type: Select
- Data Source: Taxonomies → modalidad-curso
- Query Variable: modalidad-curso
- Guardar

**Filtro 4: Precio**
- Filter Type: Range (si tienes JetEngine)
- O usa Check Boxes con opciones: Gratis, Menos de 50€, 50-100€, etc.
- Guardar

### 3. Añadir a Elementor

1. Edita la página de cursos con Elementor
2. En el sidebar, añade widget **"Smart Filters"**
3. Selecciona el filtro que creaste
4. Repite para cada filtro
5. Estiliza con los controles de Elementor

### 4. Configurar Query

1. En el widget "Grid de Cursos", activa JetSmartFilters
2. O usa el widget nativo de Elementor "Posts" configurado para "curso"
3. Los filtros funcionarán automáticamente

---

## 🔗 INTEGRACIÓN CON EL THEME

Los filtros del theme ya están listos. Si usas un plugin:

1. **Mantén el sidebar del template**
2. **Reemplaza el HTML** con los shortcodes o widgets del plugin
3. **Quita los selectores nativos**
4. **Añade los widgets del plugin**

---

## 💡 TIPS PROFESIONALES

### Para mejor UX:
✅ Muestra el número de resultados: "12 cursos encontrados"
✅ Añade un botón "Limpiar filtros"
✅ Usa loading spinner mientras filtra
✅ Mantén los filtros visibles en móvil (accordion)

### Para mejor rendimiento:
✅ Caché de resultados de filtros
✅ Lazy loading de imágenes
✅ Paginación o infinite scroll

---

## 🆘 SOPORTE

¿Necesitas ayuda configurando algún plugin?
- Documentación FacetWP: https://facetwp.com/documentation/
- Documentación JetSmartFilters: https://crocoblock.com/knowledge-base/jetsmartfilters/

---

## 📝 RESUMEN

**Empieza con:** Filtros incluidos en el theme (gratis)
**Si necesitas más:** JetSmartFilters ($26)
**Para sitios grandes:** FacetWP ($99)
**Para búsqueda avanzada:** FiboSearch (gratis)

**La mayoría de usuarios NO necesitarán plugin adicional** porque el theme ya incluye todo lo básico funcionando perfectamente.
