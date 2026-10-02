# Tarea: auth + CRUD de clientes + template

Continúa la guía `README-CLIENTES-1.md`. Se parte de un proyecto que ya completó los pasos 1 a 4 de esa guía (proyecto creado, MySQL conectado, `laravel/ui` instalado y modelo `Cliente` con su migración). El modelo y la migración **no cambian**.

Lo que agrega esta entrega:

1. **CRUD completo**: listar, registrar, editar y eliminar clientes (la guía original solo tenía registrar y listar).
2. **Template propio "Agenda de clientes"** sobre Bootstrap 5, aplicado a login, registro, recuperación de contraseña, registro de cliente y tabla de clientes.
3. **JavaScript**: mostrar/ocultar contraseña, menú lateral en celular, aviso que se cierra solo y modal para confirmar el borrado.

---

## Paso 8. Copiar los archivos

Cada archivo de esta carpeta va en la **misma ruta** dentro de `nameproject`. Si ya existe, se reemplaza.

| Archivo | Nuevo o modificado | Para qué |
| --- | --- | --- |
| `app/Http/Controllers/ClienteController.php` | Modificado | CRUD: `index`, `create`, `store`, `edit`, `update`, `destroy` |
| `app/Http/Controllers/HomeController.php` | Modificado | El inicio muestra total y últimos clientes |
| `app/Providers/AppServiceProvider.php` | Modificado | Paginación con estilo Bootstrap 5 |
| `routes/web.php` | Modificado | `Route::resource` para clientes |
| `resources/views/layouts/auth.blade.php` | Nuevo | Marco de las pantallas de acceso |
| `resources/views/layouts/app.blade.php` | Modificado | Marco del panel (menú lateral) |
| `resources/views/auth/login.blade.php` | Modificado | Login con el template |
| `resources/views/auth/register.blade.php` | Modificado | Registro con el template |
| `resources/views/auth/passwords/email.blade.php` | Modificado | Pedir enlace de recuperación |
| `resources/views/auth/passwords/reset.blade.php` | Modificado | Escribir contraseña nueva |
| `resources/views/home.blade.php` | Modificado | Inicio del panel |
| `resources/views/clientes/index.blade.php` | Nuevo | Tabla de clientes |
| `resources/views/clientes/create.blade.php` | Modificado | Registro de cliente |
| `resources/views/clientes/edit.blade.php` | Nuevo | Editar cliente |
| `resources/views/clientes/_form.blade.php` | Nuevo | Campos compartidos por crear y editar |
| `public/css/panel.css` | Nuevo | Estilos del template |
| `public/js/panel.js` | Nuevo | Interacciones del template |

`Cliente.php`, la migración, `auth/verify.blade.php` y `auth/passwords/confirm.blade.php` se quedan como están.

---

## Paso 9. Qué cambió en el MVC

### Rutas

```php
Route::middleware('auth')->group(function () {
    Route::resource('clientes', ClienteController::class)
        ->except('show')
        ->parameters(['clientes' => 'cliente']);
});
```

Una sola línea publica las seis rutas del CRUD. Se comprueba con:

```bash
php artisan route:list --name=clientes
```

| Método | URL | Nombre | Acción |
| --- | --- | --- | --- |
| GET | /clientes | clientes.index | Tabla |
| GET | /clientes/create | clientes.create | Formulario nuevo |
| POST | /clientes | clientes.store | Guardar |
| GET | /clientes/{cliente}/edit | clientes.edit | Formulario editar |
| PUT | /clientes/{cliente} | clientes.update | Guardar cambios |
| DELETE | /clientes/{cliente} | clientes.destroy | Eliminar |

### Controlador

- `edit(Cliente $cliente)` recibe el cliente ya buscado por su `id` (*route model binding*). Si el id no existe, Laravel responde 404.
- Al editar, la regla `Rule::unique(...)->ignore($cliente->id)` evita que el propio correo del cliente cuente como repetido.
- `index()` filtra con `?buscar=` por nombre o correo y pagina de 10 en 10.
- Los mensajes de validación de clientes están en español.

### Vistas

- Los formularios HTML solo envían GET y POST. Para editar y eliminar se usa `@method('PUT')` y `@method('DELETE')`, que Laravel convierte en el método correcto.
- `_form.blade.php` se incluye con `@include` en crear y en editar; `old('nombre', $cliente->nombre)` muestra el valor anterior si la validación falla, o el guardado al editar.
- Hay un solo modal de eliminar. El botón le pasa la URL y el nombre con `data-action` y `data-nombre`, y `panel.js` los coloca al abrirse.

---

## Paso 10. El template

Dos marcos:

- `layouts/auth.blade.php`: pantalla dividida. A la izquierda el panel azul con la marca y un índice A–Z como el de una agenda de papel; a la derecha el formulario. En celular el panel azul queda como barra superior.
- `layouts/app.blade.php`: menú lateral fijo (Inicio, Clientes, Nuevo cliente, usuario y cerrar sesión) y barra superior con el título de la página. En celular el menú se abre con el botón ☰.

Estilos: `public/css/panel.css` se carga **después** de Bootstrap (`@vite`), por eso sus reglas tienen prioridad. Los colores están como variables CSS al inicio del archivo; para cambiar el look basta con editar `--tinta` y `--resaltador`.

Fuentes (Google Fonts) e iconos (Bootstrap Icons) se cargan por CDN en el `<head>` de los dos layouts, así que no hay que instalar nada más.

---

## Paso 11. Probar

Terminal 1: `npm run dev`. Terminal 2: `php artisan serve`.

1. http://127.0.0.1:8000/register: crear usuario.
2. Cerrar sesión y entrar en http://127.0.0.1:8000/login.
3. En login, "¿Olvidaste tu contraseña?": enviar enlace. El enlace aparece en `storage/logs/laravel.log`; copiarlo en el navegador para ver la pantalla de nueva contraseña.
4. Menú "Nuevo cliente": guardar uno. Probar también con un correo repetido para ver el error.
5. Tabla: buscar, editar y eliminar (confirmando en el modal).
6. Reducir la ventana del navegador para mostrar el menú en celular.

**Opcional, mensajes de login en español.** Los errores de autenticación de Laravel salen en inglés. Para traducirlos:

```bash
composer require laravel-lang/common --dev
php artisan lang:add es
```

Y en `.env`: `APP_LOCALE=es`.

---

## Guion sugerido para el video (5–7 min)

| Tiempo | Qué mostrar |
| --- | --- |
| 0:00 – 0:30 | Presentación del equipo y de la tarea |
| 0:30 – 1:30 | `.env` (MySQL), `composer require laravel/ui`, `php artisan ui bootstrap --auth`, `Auth::routes()` en `web.php` |
| 1:30 – 2:30 | Modelo `Cliente` (`$fillable`) y migración; tabla `clientes` en phpMyAdmin |
| 2:30 – 3:45 | `ClienteController`: los 6 métodos, validación y `Rule::unique()->ignore()`; `Route::resource` y `route:list` |
| 3:45 – 4:45 | Vistas: `@extends`, `@section`, `@include('_form')`, `@csrf`, `@method`; `panel.css` (variables) y `panel.js` |
| 4:45 – 6:30 | Demo en el navegador: registro, login, recuperar contraseña (enlace en el log), registrar, buscar, editar y eliminar cliente, cerrar sesión e intentar abrir `/clientes` |
| 6:30 – 7:00 | Cierre: cada integrante dice lo que más le llamó la atención |

Antes de entregar: en YouTube, visibilidad **Pública** (o "No listado" si el docente lo acepta) y abrir el enlace en una ventana de incógnito para confirmar que se ve sin iniciar sesión.
