# 🚀 Instalación Rápida: Plugin CursosTIC Cursos

## 🎯 Solución al Problema

**Problema:** Al desactivar el child theme, desapareció el menú "Cursos" porque el Custom Post Type estaba registrado en `functions.php` del theme.

**Solución:** He creado un **plugin independiente** que funciona con **cualquier theme** (Astra original, Astra Child, o cualquier otro).

---

## ✅ Ventajas de Usar un Plugin

| Aspecto | Theme Child | Plugin |
|---------|-------------|--------|
| Cambiar de theme | ❌ Pierdes todo | ✅ Mantienes todo |
| Compatibilidad con Elementor | ⚠️ Puede dar conflictos | ✅ 100% compatible |
| Actualizar theme | ❌ Riesgo | ✅ Sin riesgo |
| Portabilidad | ❌ No | ✅ Sí |
| Mejores prácticas WP | ❌ No recomendado | ✅ Recomendado |

---

## 📥 INSTALACIÓN EN 3 PASOS

### PASO 1: Descargar el Plugin

El plugin está en la carpeta del repositorio:

```
cursostic-cursos-plugin/
├── cursostic-cursos.php          # Archivo principal
├── README.md                      # Documentación completa
├── assets/                        # CSS y JS
└── elementor/                     # Widget de Elementor
```

**Opciones de descarga:**

**A) Vía Git (recomendado):**
```bash
cd /ruta/a/tu/wordpress
git pull origin claude/astra-theme-review-011CUdNk5MRY3c7agJqfr99n
```

**B) Vía cPanel/FTP:**
1. Descarga la carpeta `cursostic-cursos-plugin` del repositorio
2. Sube a tu servidor en: `/wp-content/plugins/`

**C) Vía ZIP:**
1. Comprime la carpeta `cursostic-cursos-plugin` en ZIP
2. En WordPress: Plugins → Añadir nuevo → Subir plugin
3. Selecciona el ZIP y haz clic en "Instalar ahora"

### PASO 2: Activar el Plugin

1. Ve a **Plugins** en WordPress Admin
2. Busca **"CursosTIC - Sistema de Cursos"**
3. Haz clic en **"Activar"**

### PASO 3: Configurar Permalinks

```
WordPress Admin → Ajustes → Enlaces permanentes → Guardar cambios
```

(Solo haz clic en "Guardar", no cambies nada)

---

## ✅ Verificación

Después de activar el plugin, deberías ver:

1. **Menú nuevo:** **"Cursos"** en el panel lateral de WordPress
   - Con submenús: Todos los Cursos, Añadir Nuevo, Categorías, Niveles, Modalidades

2. **Widget de Elementor:** Si editas con Elementor, verás el widget **"Grid de Cursos"** en la categoría **CursosTIC**

3. **URLs funcionando:** `/cursos/` debería funcionar (después de regenerar permalinks)

---

## 🎨 Configuración del Theme

### Opción A: Usar Astra Original (Recomendado)

```
✅ Activa: Astra theme (el original)
✅ Activa: Plugin CursosTIC Cursos
❌ Desactiva: Astra Child (ya no necesario para cursos)
✅ Usa: Elementor para diseñar páginas
```

**Ventajas:**
- Sin conflictos con templates hardcoded
- Elementor funciona perfectamente
- Actualizaciones del theme sin problemas
- Más limpio y profesional

### Opción B: Usar Astra Child (Avanzado)

Si quieres mantener el child theme para estilos personalizados:

```
✅ Activa: Astra Child
✅ Activa: Plugin CursosTIC Cursos
⚠️ Importante: Elimina código de cursos de functions.php
```

**Qué eliminar de `functions.php` del child theme:**
- Función `cursostic_register_curso_post_type()`
- Función `cursostic_register_taxonomies()`
- Función `cursostic_add_curso_meta_boxes()`
- Todo lo relacionado con el CPT "curso"

**Qué mantener:**
- Estilos CSS personalizados
- Código de Elementor compatibility (si lo hay)
- Otros custom functions que NO sean del CPT

---

## 🎓 Crear Tu Primer Curso

1. **Ve a:** Cursos → Añadir Nuevo

2. **Introduce datos básicos:**
   - Título: "Curso de PHP Avanzado"
   - Contenido: Descripción del curso
   - Imagen destacada: 1200x630px

3. **Asigna taxonomías:**
   - Categoría: Programación
   - Nivel: Avanzado
   - Modalidad: Online

4. **Rellena campos personalizados:**
   - Scroll down hasta "Detalles del Curso"
   - Precio: 99.00
   - Precio Oferta: 49.00
   - Duración: 40 horas
   - Instructor: Tu nombre

5. **Añade contenido:**
   - Objetivos: Lista de qué aprenderá el alumno
   - Requisitos: Qué necesita saber antes
   - Temario: Módulos y lecciones

6. **Publica**

---

## 🎨 Usar con Elementor

### Para Páginas (Inicio, Catálogo, Blog):

1. Crea página nueva
2. Editar con Elementor
3. Importar template (icono carpeta 📁)
4. Busca el template guardado
5. Insertar
6. Publicar

**Funciona perfectamente con:**
- `home-template-pro.json`
- `cursos-template-pro.json`
- `blog-template-pro.json`

### Para Single Curso (Elementor Pro):

1. **Plantillas → Templates del Tema**
2. Crear nuevo → **Single Post**
3. Nombre: "Single Curso"
4. Importar template guardado: `single-curso-template-pro.json`
5. **Display Conditions:** "Curso | Todos"
6. Guardar

**Esto aplica el diseño a TODOS los cursos automáticamente**

### Widget "Grid de Cursos":

1. Edita cualquier página con Elementor
2. Busca widget: "Grid de Cursos"
3. Arrastra a la página
4. Configura:
   - Número de cursos
   - Columnas (2, 3 ó 4)
   - Filtros opcionales
5. Publicar

---

## 🔧 Troubleshooting

### Problema: No veo el menú "Cursos"

**Solución:**
```
Ajustes → Enlaces permanentes → Guardar cambios
```

Recarga WordPress Admin (Ctrl+Shift+R)

### Problema: URLs de cursos dan 404

**Solución:**
```
Ajustes → Enlaces permanentes → Guardar cambios
```

### Problema: Error "The content area was not found"

**Causa:** El child theme tiene templates hardcoded

**Solución:**
1. Desactiva el child theme
2. Activa Astra original
3. O lee: `elementor-templates/SOLUCION-ERROR-CONTENT-AREA.md`

### Problema: Widget de Elementor no aparece

**Verificar:**
1. ¿Elementor está instalado y activo?
2. ¿El plugin está activado?
3. Regenerar CSS: Elementor → Herramientas → Regenerar CSS

---

## 📊 Comparativa: WooCommerce vs Plugin Cursos

| Aspecto | WooCommerce Productos | Plugin Cursos |
|---------|----------------------|---------------|
| **Propósito** | Venta de productos físicos/digitales | Formación y educación |
| **Campos** | Genéricos (precio, stock, SKU) | Específicos (duración, instructor, objetivos, temario) |
| **Taxonomías** | Categorías productos, etiquetas | Categorías cursos, niveles, modalidades |
| **Complejidad** | Alta (muchas opciones innecesarias) | Justa (solo lo necesario) |
| **Rendimiento** | Más pesado | Más ligero |
| **Flexibilidad** | Limitada para educación | Diseñada para cursos |
| **SEO** | Productos | Cursos (mejor para Schema.org) |
| **Filtros** | De productos | De cursos educativos |

**Recomendación:**
- ✅ **Usa el Plugin Cursos** para gestionar los cursos
- ✅ **Usa WooCommerce** solo si necesitas:
  - Pasarela de pago integrada
  - Gestión de pedidos compleja
  - Cupones y descuentos avanzados
  - Suscripciones

Puedes usar ambos: Plugin para cursos + WooCommerce para vender (vinculando productos a cursos).

---

## 🎁 Lo Que Incluye el Plugin

✅ **Custom Post Type "Curso"**
✅ **3 Taxonomías:** Categorías, Niveles, Modalidades
✅ **15+ Campos Personalizados:** Precio, duración, instructor, objetivos, temario, etc.
✅ **Meta Boxes** profesionales en el admin
✅ **Widget de Elementor:** Grid de Cursos
✅ **2 Shortcodes:** Grid y Filtros
✅ **Sistema AJAX** para filtros sin recargar
✅ **Términos por defecto:** Principiante, Intermedio, Avanzado, Online, Presencial, Híbrido
✅ **Compatible con:** Elementor, Gutenberg, ACF, WPML, cualquier theme
✅ **Documentación completa:** README.md

---

## 📚 Documentación Adicional

**Dentro de la carpeta del plugin:**
- `README.md` - Documentación completa del plugin (400+ líneas)

**Dentro de `elementor-templates/`:**
- `README.md` - Guía de templates de Elementor
- `ACTIVAR-TEMPLATE-CURSOS.md` - Cómo activar template de single curso
- `SOLUCION-ERROR-CONTENT-AREA.md` - Solución a errores de Elementor
- `PLUGINS-FILTROS.md` - Plugins de filtros avanzados recomendados

---

## ✅ Checklist de Instalación

- [ ] Plugin descargado/clonado
- [ ] Plugin subido a `/wp-content/plugins/`
- [ ] Plugin activado en WordPress Admin
- [ ] Permalinks regenerados (Ajustes → Enlaces permanentes → Guardar)
- [ ] Menú "Cursos" visible en WordPress Admin
- [ ] Creado al menos 1 curso de prueba
- [ ] Templates de Elementor importados
- [ ] Theme configurado (Astra original o Astra Child sin código de cursos)
- [ ] Cache limpiado (WordPress, Elementor, navegador)
- [ ] Verificado que todo funciona en frontend

---

## 🎉 ¡Listo!

Con el plugin activado:

✅ Puedes **crear cursos** desde WordPress Admin → Cursos
✅ Puedes **usar cualquier theme** sin perder funcionalidad
✅ Puedes **usar Elementor** sin conflictos
✅ Los **templates importados funcionarán** perfectamente
✅ Puedes **cambiar de theme** en el futuro sin problemas

**Siguiente paso:**
1. Crea algunos cursos de prueba
2. Importa los templates de Elementor
3. Configura las páginas (Inicio, Cursos, Blog)
4. ¡Lanza tu plataforma de cursos! 🚀

---

¿Preguntas? Lee el `README.md` completo dentro de la carpeta del plugin.
