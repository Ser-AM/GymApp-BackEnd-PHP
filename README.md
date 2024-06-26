# GymApp-BackEnd-PHP
Esta aplicacion es un backend básico desarrollado en PHP y MySQL para GymApp, una aplicación en desarrollo para gestionar ejercicios de gimnasio.

## Changelog

### 1.1.0

    - CRUD completo para la gestión de Rutinas, incluyendo asociación de Ejercicios.
    - Implementación de relaciones entre Ejercicios y Rutinas.
    - Ajuste y expansión de las rutas para soportar operaciones CRUD de Rutinas y la asociación de Ejercicios.
    - Mejoras en el manejo de relaciones y validaciones.
    - Optimización de consultas y mejora de la integridad de datos con claves foráneas.

### 1.0.1

    - Refactorización y simplificación del CRUD de ejercicios.
    - Eliminación de campos innecesarios como `orden` y `activo` en la tabla de ejercicios.
    - Adaptación de las funciones CRUD para ejercicios en el controlador `EjercicioController.php`.
    - Ajustes en el modelo `Ejercicio.php` para reflejar la estructura actualizada de la base de datos.
    - Mejoras generales en el manejo de errores y validaciones en las operaciones CRUD.

### 1.0.0

    - Implementación inicial del CRUD para la gestión de ejercicios.
    - Configuración básica del backend en PHP.
    - Estructura de base de datos para la tabla de ejercicios.