# Programación Orientada a Interfaces — Escáner de Datos

**Autores:** Jessica Zheng (8-1033-370) · Erick Hou (8-1017-473)

---

## Descripción

Aplicación web en PHP que recibe datos de un formulario (nombre, email y comentario), los sanitiza y los valida usando un sistema de escáneres basado en una interfaz común. El proyecto aplica los principios de programación orientada a interfaces, métodos estáticos y manejo de excepciones personalizadas.

---

## Estructura del proyecto

```
proyecto/
├── public/
│   ├── index.html        ← Formulario de entrada
│   ├── procesar.php      ← Lógica de sanitización, validación y resultado
│   └── css/
│       └── styles.css
├── src/
│   └── Escaner/
│       └── Escaner.php           ← Interfaz (contrato)
│       └── EscanerException.php  ← Excepción personalizada
│       └── EscanerEmail.php
│       └── EscanerNombre.php
│       └── EscanerTexto.php
├── vendor/               ← Generado por Composer
└── composer.json
```

---

## Conceptos aplicados

### Programación orientada a interfaces

Una interfaz en PHP define un **contrato**: establece qué métodos debe tener una clase sin especificar cómo los implementa. Cualquier clase que use `implements` está obligada a definir todos esos métodos.

```php
interface Escaner {
    public static function limpiar(string $dato): string;
    public static function escanear(string $dato): bool;
}
```

Esto garantiza que `EscanerEmail`, `EscanerNombre` y `EscanerTexto` siempre tendrán `limpiar()` y `escanear()`, independientemente de cómo funcionen internamente.

---

### Métodos estáticos en PHP

Un método estático pertenece a la **clase**, no a una instancia. Se llama directamente sobre la clase con `::` sin necesidad de crear un objeto con `new`.

```php
// Sin instancia:
$nombre = EscanerNombre::limpiar($_POST['nombre']);

// Equivalente con instancia (no estático):
$escaner = new EscanerNombre();
$nombre  = $escaner->limpiar($_POST['nombre']);
```

Son útiles cuando el método no necesita guardar estado interno, como ocurre con las funciones de sanitización y validación de este proyecto, donde cada llamada es independiente de las demás.

---

### Excepciones personalizadas

En lugar de retornar `false` cuando un dato es inválido, los escáneres lanzan una `EscanerException`. Esto permite manejar los errores de forma centralizada en `procesar.php` con un único bloque `try/catch`.

```php
// En EscanerEmail:
throw new EscanerException('El formato del email no es válido.');

// En procesar.php:
try {
    EscanerEmail::escanear($email);
} catch (EscanerException $e) {
    $errores[] = $e->getMessage();
}
```

`EscanerException` extiende `\RuntimeException`, lo que la integra con el sistema de excepciones nativo de PHP.

---

## Funcionalidades del Escáner

Cada escáner implementa dos operaciones sobre el dato recibido:

### `limpiar(string $dato): string` — Sanitización

Elimina contenido peligroso antes de procesar el dato.

| Escáner | Qué elimina | Qué normaliza |
|---|---|---|
| `EscanerNombre` | Etiquetas HTML, caracteres no alfabéticos | Espacios múltiples, capitalización por palabra |
| `EscanerEmail` | Etiquetas HTML, espacios | Convierte a minúsculas |
| `EscanerTexto` | Etiquetas HTML | Espacios múltiples, espacios al inicio y final |

### `escanear(string $dato): bool` — Validación

Verifica que el dato cumpla las reglas del negocio. Lanza `EscanerException` si no las cumple.

| Escáner | Validaciones |
|---|---|
| `EscanerNombre` | No vacío · Entre 2 y 100 caracteres · Solo letras y espacios (incluye acentos) |
| `EscanerEmail` | No vacío · Formato de email válido (`filter_var`) |
| `EscanerTexto` | No vacío · Máximo 500 caracteres |

---

## Instalación

**Requisitos:** PHP 8.0+ · Composer

```bash
# 1. Clonar el repositorio
git clone https://github.com/Jessz3/Programaci-n-orientada-a-interfaces.git
cd Programaci-n-orientada-a-interfaces

# 2. Instalar dependencias y generar el autoloader
composer dump-autoload

# 3. Servir la carpeta public/
php -S localhost:8000 -t public/
```

Luego abrir `http://localhost:8000` en el navegador.

---

## Estándares aplicados

El proyecto sigue las recomendaciones de [PHP-FIG](https://www.php-fig.org/):

- **PSR-1** — Estándar básico: etiqueta `<?php`, `StudlyCaps` para clases, `camelCase` para métodos.
- **PSR-12** — Estilo de código: indentación de 4 espacios, sin etiqueta de cierre `?>` en archivos PHP puros, `declare(strict_types=1)`.
- **PSR-4** — Autoloading: namespace `App\Escaner` mapeado a `src/Escaner/` mediante Composer.
