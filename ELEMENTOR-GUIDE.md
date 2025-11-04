# 🚀 GUÍA COMPLETA: Usar CursosTIC Child Theme con Elementor

## ✅ RECOMENDACIÓN: Usa Elementor para la Página de Inicio

Si tienes Elementor instalado, es **MEJOR** usarlo para diseñar visualmente. El theme incluye widgets personalizados.

---

## 📋 PASOS PARA CONFIGURAR CON ELEMENTOR

### PASO 1: Configurar WordPress

1. Ve a **Ajustes → Lectura**
2. Selecciona **"Una página estática"**
3. Crea una página llamada **"Inicio"** si no existe
4. Selecciónala como **"Página de inicio"**
5. Guarda cambios

### PASO 2: Editar la Página de Inicio con Elementor

1. Ve a **Páginas → Inicio**
2. Haz clic en **"Editar con Elementor"**
3. **ELIMINA** todo el contenido existente si lo hay
4. Empieza con una página en blanco

### PASO 3: Crear el Banner Hero

**Arrastra un widget "Heading" (Título):**
- Texto: "Formación TIC de Calidad"
- Estilo HTML: H1
- Color: Blanco
- Alineación: Centro

**Añade otro "Heading" para subtítulo:**
- Texto: "Descubre cursos especializados en Tecnologías de la Información"
- Estilo HTML: H3
- Color: Blanco
- Alineación: Centro

**Configura la sección:**
- Fondo: Gradiente (#2563eb → #1e40af)
- Padding: 80px arriba y abajo
- Altura mínima: 500px

### PASO 4: Usar los Widgets de CursosTIC

El theme incluye estos widgets personalizados de Elementor:

#### 📚 Widget "Grid de Cursos"
**Ubicación:** Panel de Elementor → Categoría "CursosTIC"

**Configuración:**
- Número de cursos: 6
- Solo destacados: Sí
- Ordenar por: Fecha
- Categoría: (opcional)

**Uso:**
1. Arrastra el widget "Grid de Cursos"
2. Configura las opciones
3. Se mostrará automáticamente con el diseño de tarjetas

#### 🔍 Widget "Buscador de Cursos"
**Ubicación:** Panel de Elementor → Categoría "CursosTIC"

**Configuración:**
- Placeholder: "¿Qué quieres aprender hoy?"
- Texto del botón: "Buscar"
- Mostrar filtros: Sí/No

**Uso:**
1. Arrastra el widget donde quieras el buscador
2. Personaliza textos
3. Funciona con AJAX automáticamente

---

## 🎨 ESTRUCTURA RECOMENDADA DE LA PÁGINA DE INICIO

```
┌─────────────────────────────────────┐
│  SECCIÓN 1: HERO BANNER             │
│  - Gradiente azul                   │
│  - Título grande                    │
│  - Subtítulo                        │
│  - Widget: Buscador de Cursos       │
└─────────────────────────────────────┘

┌─────────────────────────────────────┐
│  SECCIÓN 2: CURSOS DESTACADOS       │
│  - Título: "Cursos Destacados"      │
│  - Widget: Grid de Cursos           │
│    (Configurado para destacados)    │
└─────────────────────────────────────┘

┌─────────────────────────────────────┐
│  SECCIÓN 3: CATEGORÍAS              │
│  - Usa widgets "Icon Box" de        │
│    Elementor para cada categoría    │
│  - 3-4 columnas                     │
└─────────────────────────────────────┘

┌─────────────────────────────────────┐
│  SECCIÓN 4: ÚLTIMAS NOTICIAS        │
│  - Usa widget "Posts" de Elementor  │
│  - 3 columnas                       │
└─────────────────────────────────────┘

┌─────────────────────────────────────┐
│  SECCIÓN 5: CALL TO ACTION          │
│  - Botón grande                     │
│  - Fondo azul                       │
└─────────────────────────────────────┘
```

---

## 🛠️ CONFIGURACIÓN DE COLORES EN ELEMENTOR

Para usar los colores del theme en Elementor:

1. Ve a **Elementor → Configuración → Style**
2. Añade estos colores globales:

```
Color Primario:    #2563eb
Color Secundario:  #10b981
Color Acento:      #f59e0b
Texto Primario:    #1f2937
Texto Secundario:  #6b7280
```

---

## 📄 PÁGINA DE CURSOS CON ELEMENTOR

Para la página de listado de cursos:

### Opción A: Usar la Plantilla del Theme
1. Crea página "Cursos"
2. Selecciona plantilla: **"Página de Cursos con Sidebar"**
3. NO uses Elementor en esta página
4. Ya tiene filtros y grid incorporados

### Opción B: Diseñar con Elementor
1. Crea página "Cursos"
2. Edita con Elementor
3. Usa el widget **"Buscador de Cursos"** (con filtros: SÍ)
4. Usa el widget **"Grid de Cursos"** (sin filtrar destacados)

---

## 🎓 FICHAS DE CURSOS INDIVIDUALES

Las fichas de cada curso **NO necesitan Elementor**, ya tienen diseño profesional automático con:
- Tabs organizados
- Sidebar con precio
- Accordion para temario
- Badges visuales
- Cursos relacionados

**NO edites las fichas individuales con Elementor**, funcionan mejor con la plantilla del theme.

---

## 🔧 WIDGETS DE ELEMENTOR NATIVOS ÚTILES

Además de los widgets personalizados de CursosTIC, usa estos de Elementor:

**Para el Hero:**
- Heading (títulos)
- Text Editor (textos)
- Button (botones)

**Para categorías:**
- Icon Box (con icono + título + descripción)
- Image Box

**Para diseño:**
- Spacer (espacios)
- Divider (separadores)
- Inner Section (columnas dentro de secciones)

**Para contenido:**
- Posts (últimas entradas del blog)
- Testimonials
- Image Gallery

---

## 📱 RESPONSIVE CON ELEMENTOR

Elementor tiene controles responsive nativos:

1. Haz clic en el icono **📱** (responsive mode)
2. Ajusta para: Desktop / Tablet / Mobile
3. Cambia:
   - Tamaños de fuente
   - Padding y márgenes
   - Orden de columnas
   - Visibilidad de elementos

---

## 🚫 LO QUE NO DEBES HACER

❌ **NO uses Elementor** para las fichas individuales de cursos
❌ **NO mezcles** widgets de otros themes/plugins con los de CursosTIC
❌ **NO pongas** demasiados elementos en el hero (mantenlo simple)

---

## ✅ VENTAJAS DE USAR ELEMENTOR

✅ Edición visual en tiempo real
✅ Drag & drop sin código
✅ Control total del diseño
✅ Widgets personalizados de CursosTIC incluidos
✅ Responsive fácil
✅ Compatible con Astra
✅ Puedes exportar/importar templates

---

## 🎯 RESULTADO ESPERADO

**Con Elementor + CursosTIC Child Theme tendrás:**

✅ Página de inicio diseñada visualmente
✅ Widgets de cursos funcionando con AJAX
✅ Buscador con filtros integrado
✅ Tarjetas de cursos profesionales
✅ Fichas individuales automáticas y bonitas
✅ Blog con diseño personalizado
✅ Todo responsive y optimizado

---

## 🆘 SOLUCIÓN DE PROBLEMAS

### "Los widgets de CursosTIC no aparecen"
- Verifica que el child theme esté ACTIVO
- Ve a Elementor → Tools → Regenerate CSS
- Limpia caché

### "La página se ve rara"
- Usa plantilla "Elementor Canvas" o "Elementor Full Width"
- Elimina el contenido anterior de la página
- Empieza desde cero

### "Los cursos no se muestran"
- Verifica que tengas cursos publicados
- Verifica que tengan categorías asignadas
- Marca algunos como "destacados" en la edición del curso

---

## 🎬 SIGUIENTE PASO

1. **Abre la página de Inicio** en WordPress
2. **Haz clic en "Editar con Elementor"**
3. **Elimina todo** el contenido existente
4. **Busca en el panel izquierdo** la categoría "CursosTIC"
5. **Arrastra el widget "Grid de Cursos"**
6. **Verás las tarjetas** funcionando inmediatamente

¿Listo para empezar? Dame feedback de cómo va.
