# 🚀 GUÍA RÁPIDA DE INSTALACIÓN - CursosTIC Child Theme

## ⚠️ IMPORTANTE: Pasos en orden

### PASO 1: Instalar Theme Astra (PADRE)
1. Ve a **Apariencia → Temas → Añadir nuevo**
2. Busca "Astra"
3. **Instala** Astra (NO lo actives todavía)

### PASO 2: Instalar Child Theme
1. Descarga el ZIP de este repositorio
2. Ve a **Apariencia → Temas → Añadir nuevo → Subir tema**
3. Sube el ZIP del child theme
4. **ACTIVA** el child theme "Astra Child - CursosTIC"

### PASO 3: Configurar Enlaces Permanentes
1. Ve a **Ajustes → Enlaces permanentes**
2. Selecciona **"Nombre de la entrada"**
3. Haz clic en **Guardar cambios**

### PASO 4: Crear Taxonomías (IMPORTANTE)
1. Ve a **Cursos → Categorías** y crea al menos una categoría (ej: "Programación")
2. Ve a **Cursos → Niveles** y crea: Básico, Intermedio, Avanzado
3. Ve a **Cursos → Modalidades** y crea: Online, Presencial

### PASO 5: Crear Página de Inicio (CRUCIAL)
1. Ve a **Páginas → Añadir nueva**
2. Título: **"Inicio"** (o el nombre que quieras)
3. **NO escribas nada en el contenido** (déjalo vacío)
4. Publica la página

### PASO 6: Crear Página de Cursos
1. Ve a **Páginas → Añadir nueva**
2. Título: **"Cursos"**
3. En el panel derecho, busca **"Atributos de página"**
4. En **"Plantilla"**, selecciona: **"Página de Cursos"**
5. Publica la página

### PASO 7: Crear Página de Blog
1. Ve a **Páginas → Añadir nueva**
2. Título: **"Blog"**
3. **NO escribas nada** (déjalo vacío)
4. Publica la página

### PASO 8: Configurar Páginas Estáticas (ESTO SOLUCIONA EL PROBLEMA)
1. Ve a **Ajustes → Lectura**
2. Selecciona **"Una página estática"** (NO "Tus últimas entradas")
3. En **"Página de inicio"**: Selecciona **"Inicio"**
4. En **"Página de entradas"**: Selecciona **"Blog"**
5. Haz clic en **Guardar cambios**

### PASO 9: Configurar Menú
1. Ve a **Apariencia → Menús**
2. Crea un nuevo menú llamado "Menú Principal"
3. Añade las páginas: Inicio, Cursos, Blog, Contacto (si tienes)
4. En **"Ajustes del menú"**, marca **"Primary Menu"**
5. Guarda el menú

### PASO 10: Añadir tu primer curso de prueba
1. Ve a **Cursos → Añadir nuevo**
2. Título: "Curso de Prueba"
3. Añade una descripción
4. Selecciona una categoría, nivel y modalidad
5. Añade una imagen destacada
6. En **"Detalles del Curso"**:
   - Duración: "40 horas"
   - Precio: 99 (o déjalo vacío si es gratis)
   - Instructor: "Tu nombre"
7. Marca **"Curso Destacado"**
8. Publica el curso

---

## ✅ Resultado Esperado

Después de estos pasos, deberías ver:
- **Página de inicio**: Banner hero + cursos destacados + categorías + últimos posts
- **Página Cursos** (/cursos/): Buscador + filtros + grid de cursos
- **Ficha de curso** (/cursos/nombre-curso/): Información completa del curso
- **Blog** (/blog/): Tus entradas de blog

---

## 🐛 Si sigues viendo contenido mezclado:

### Comprueba esto:
1. **Verifica en Apariencia → Temas** que está activo "Astra Child - CursosTIC"
2. **Verifica en Ajustes → Lectura** que está seleccionado "Una página estática"
3. **Limpia la caché** si usas algún plugin de caché
4. **Prueba en modo incógnito** del navegador

### Si el problema persiste:
Envíame un pantallazo de lo que ves y te ayudo específicamente.

---

## 📞 Problemas Comunes

### "No veo la plantilla 'Página de Cursos'"
- Asegúrate de que el child theme está **ACTIVO**
- Ve a Apariencia → Editor de temas → Verifica que estás en "Astra Child"

### "Los estilos no se aplican"
- Limpia la caché del navegador (Ctrl+Shift+R)
- Si usas un plugin de caché, desactívalo temporalmente
- Ve a Apariencia → Personalizar → y guarda (para forzar regeneración)

### "Error 404 en los cursos"
- Ve a **Ajustes → Enlaces permanentes** y haz clic en **Guardar** otra vez
- Esto regenera las reglas de reescritura

---

## 🎨 Personalizar Colores

Si quieres cambiar los colores, edita el archivo `style.css` líneas 23-39:

```css
:root {
    --cursostic-primary: #2563eb;     /* Tu color primario */
    --cursostic-secondary: #10b981;   /* Tu color secundario */
    --cursostic-accent: #f59e0b;      /* Color de acento */
}
```

Guarda y recarga la página (Ctrl+Shift+R).
