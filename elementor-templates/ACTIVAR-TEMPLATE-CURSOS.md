# 🎓 Cómo Activar el Template para Todos los Cursos Automáticamente

## 📋 ¿Qué es esto?

Has importado el template `single-curso-template-pro.json`, pero ahora necesitas que se **aplique automáticamente** a **TODOS** los cursos (Custom Post Type "curso").

Hay **2 formas** de hacerlo:

---

## ✅ MÉTODO 1: Con Elementor Pro (RECOMENDADO)

Si tienes **Elementor Pro**, esta es la forma más fácil y profesional.

### Paso 1: Crear el Template

1. Ve a **Plantillas → Templates del Tema** (Theme Builder)
2. Haz clic en **"Agregar nuevo"**
3. Selecciona **"Single Post"**
4. Dale un nombre: **"Single Curso"**
5. Haz clic en **"Crear plantilla"**

### Paso 2: Importar el Diseño

1. Dentro del editor de Elementor, haz clic en el icono de **carpeta** 📁 (arriba a la izquierda)
2. Selecciona **"Plantillas guardadas"**
3. Busca **"Single Curso - CursosTIC"** (el template que importaste)
4. Haz clic en **"Insertar"**
5. El diseño completo se cargará en el editor

### Paso 3: Configurar Display Conditions (Condiciones de Visualización)

**ESTE ES EL PASO MÁS IMPORTANTE**

1. Haz clic en **"Publicar"** (botón verde)
2. Aparecerá un popup: **"Establecer condiciones"**
3. En el dropdown, selecciona:
   - **"Posts"** → Busca **"Curso"** (tu Custom Post Type)
   - O bien: **"Singular"** → **"Curso"** → **"Todos los Cursos"**

4. Quedará así:
   ```
   Mostrar en: Curso | Todos
   ```

5. Haz clic en **"Guardar y cerrar"**

### ✅ ¡LISTO!

Ahora **TODOS** los cursos usarán automáticamente este template profesional.

**Prueba:**
1. Ve a cualquier curso: `tudominio.com/cursos/nombre-del-curso`
2. Verás el diseño profesional con tabs, sidebar sticky, cursos relacionados, etc.

---

## 🔧 MÉTODO 2: Sin Elementor Pro (Código Manual)

Si **NO** tienes Elementor Pro, puedes usar código para forzar que Elementor use el template.

### Paso 1: Obtener el ID del Template

1. Ve a **Plantillas → Plantillas guardadas**
2. Busca **"Single Curso - CursosTIC"**
3. Pasa el ratón sobre el template y mira la URL en la barra inferior del navegador
4. Busca: `post=12345` → **12345** es el ID del template
5. **Anota ese número**

### Paso 2: Añadir Código a functions.php

Abre el archivo `/functions.php` del child theme y añade este código **AL FINAL** del archivo:

```php
/**
 * Aplicar template de Elementor automáticamente a todos los cursos
 */
function cursostic_apply_single_curso_template($template_id) {
    // IMPORTANTE: Reemplaza 12345 con el ID real de tu template
    $single_curso_template_id = 12345; // ← CAMBIAR ESTO

    if (is_singular('curso')) {
        $template_id = $single_curso_template_id;
    }

    return $template_id;
}
add_filter('template_include', function($template) {
    if (is_singular('curso')) {
        // Forzar que Elementor renderice el contenido
        if (did_action('elementor/loaded')) {
            // Obtener el ID del template
            $template_id = 12345; // ← CAMBIAR ESTO (mismo ID de arriba)

            // Verificar que el template existe
            if (get_post_status($template_id) === 'publish') {
                // Forzar el template de Elementor
                update_post_meta(get_the_ID(), '_elementor_template_type', 'single-curso');
                update_post_meta(get_the_ID(), '_elementor_data', get_post_meta($template_id, '_elementor_data', true));
                update_post_meta(get_the_ID(), '_elementor_edit_mode', 'builder');
            }
        }
    }
    return $template;
}, 99);
```

**⚠️ IMPORTANTE:**
- Reemplaza `12345` con el ID real de tu template en **2 lugares**
- Guarda el archivo

### ✅ ¡LISTO!

Ahora todos los cursos usarán el template automáticamente.

---

## 🎯 MÉTODO 3: Aplicar Manualmente a Cada Curso (No Recomendado)

Si prefieres aplicar el template **curso por curso**:

1. Edita un curso
2. Haz clic en **"Editar con Elementor"**
3. Haz clic en el icono de **carpeta** 📁
4. Selecciona **"Plantillas guardadas"**
5. Busca **"Single Curso - CursosTIC"**
6. Haz clic en **"Insertar"**
7. Haz clic en **"Actualizar"**

**❌ DESVENTAJA:** Tienes que hacerlo para **cada curso** manualmente.

---

## 🔍 ¿Cómo saber si está funcionando?

### Test 1: Verificar en el frontend
1. Ve a cualquier curso: `tudominio.com/cursos/nombre-del-curso`
2. Deberías ver:
   - ✅ Hero banner con gradiente azul
   - ✅ Tabs (Descripción, Objetivos, Temario, Requisitos)
   - ✅ Sidebar sticky con precio y botón de inscripción
   - ✅ Cursos relacionados al final
   - ✅ FAQ con accordion

### Test 2: Verificar en el backend (solo con Elementor Pro)
1. Ve a **Plantillas → Templates del Tema**
2. Busca **"Single Curso"**
3. Debajo debería decir: **"Mostrar en: Curso | Todos"**

---

## 🐛 Troubleshooting (Solución de Problemas)

### Problema: "El template no se aplica"

**Solución 1:** Limpia la caché
```bash
# Si usas WP Rocket, W3 Total Cache, etc.
1. Ve a Ajustes del plugin de caché
2. Haz clic en "Limpiar caché"
3. Recarga la página del curso
```

**Solución 2:** Regenera los CSS de Elementor
```bash
1. Ve a Elementor → Herramientas → Regenerar CSS
2. Haz clic en "Regenerar archivos"
3. Recarga la página del curso
```

**Solución 3:** Verifica que el Custom Post Type existe
```bash
1. Ve a WordPress Admin → Cursos
2. Verifica que hay cursos creados
3. Ve a Ajustes → Enlaces permanentes
4. Haz clic en "Guardar cambios" (para regenerar permalinks)
```

### Problema: "Los campos personalizados no muestran datos"

**Solución:** Rellena los campos personalizados
```bash
1. Edita un curso
2. Baja hasta las meta boxes
3. Rellena los campos:
   - Precio
   - Duración
   - Fecha de inicio
   - Objetivos
   - Temario
   - Requisitos
   - Instructor
4. Guarda el curso
5. Recarga el frontend
```

### Problema: "Solo veo el título del curso, sin diseño"

**Causa:** El template no está asociado correctamente.

**Solución (Método 1 - Elementor Pro):**
1. Ve a Plantillas → Templates del Tema
2. Edita "Single Curso"
3. Haz clic en "Publicar"
4. En "Display Conditions", asegúrate de que dice: **"Curso | Todos"**
5. Guarda

**Solución (Método 2 - Sin Elementor Pro):**
1. Verifica que el ID del template en functions.php es correcto
2. Verifica que el código está **después** de la línea `<?php` y **antes** de `?>`

---

## 🎨 Personalizar el Template

Una vez activado, puedes personalizar el diseño:

### Opción A: Editar el Template Global (Afecta a TODOS los cursos)

1. Ve a **Plantillas → Templates del Tema**
2. Haz clic en **"Editar con Elementor"** en "Single Curso"
3. Cambia colores, textos, diseño
4. Haz clic en **"Actualizar"**
5. **TODOS los cursos** se actualizarán automáticamente

### Opción B: Editar un Curso Individual (Solo ese curso)

1. Edita el curso que quieres personalizar
2. Haz clic en **"Editar con Elementor"**
3. Cambia lo que necesites
4. Haz clic en **"Actualizar"**
5. **Solo ese curso** tendrá los cambios

---

## ✅ Resumen Rápido

| Método | Ventajas | Desventajas | Dificultad |
|--------|----------|-------------|------------|
| **Elementor Pro** | ✅ Fácil<br>✅ Visual<br>✅ Profesional | ❌ Requiere Elementor Pro (€49/año) | ⭐ Fácil |
| **Código en functions.php** | ✅ Gratis<br>✅ Permanente | ❌ Requiere conocimientos técnicos | ⭐⭐ Media |
| **Manual curso por curso** | ✅ Control total | ❌ Muy lento<br>❌ No escala | ⭐⭐⭐ Tedioso |

**🏆 RECOMENDACIÓN:** Si puedes, usa Elementor Pro. Vale la pena la inversión.

---

## 💡 Consejos Finales

✅ **Usa Elementor Pro** si vas a tener muchos cursos (>10)
✅ **Rellena los campos personalizados** para que el diseño luzca profesional
✅ **Añade imágenes destacadas** a todos los cursos (recomendado: 1200x630px)
✅ **Crea categorías** y asigna cursos para que funcionen los filtros
✅ **Limpia la caché** después de cualquier cambio
✅ **Prueba en móvil** - el template es 100% responsive

---

## 📚 Recursos Adicionales

- [Documentación oficial de Elementor Theme Builder](https://elementor.com/help/theme-builder/)
- [Vídeo: Cómo crear Single Post Templates](https://www.youtube.com/results?search_query=elementor+single+post+template)
- [Display Conditions en Elementor Pro](https://elementor.com/help/display-conditions/)

---

¿Tienes dudas? Revisa el archivo `README.md` en la carpeta `elementor-templates/` para más información.
