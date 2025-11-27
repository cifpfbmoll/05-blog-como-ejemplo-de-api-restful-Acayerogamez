# Proyecto: API RESTful para Gestión de Tareas

Este proyecto es una API RESTful desarrollada con CodeIgniter 4 que permite gestionar una lista de tareas (To-Do list). La API carece de front-end y se consume directamente a través de sus endpoints.

## Stack Tecnológico

*   **Framework:** CodeIgniter 4
*   **Lenguaje:** PHP
*   **Base de Datos:** SQLite 3
*   **Gestor de Dependencias:** Composer

## Instalación y Puesta en Marcha

1.  **Clonar el repositorio.**
2.  **Instalar dependencias:** `composer install`
3.  **Configurar entorno:** Copiar `env` a `.env` y asegurarse de que la ruta de la base de datos es correcta.
4.  **Crear y migrar la base de datos:** `php spark migrate`
5.  **Iniciar el servidor:** `php spark serve`

La API estará disponible en `http://localhost:8080`.

## Endpoints de la API

| Método HTTP | Endpoint              | Descripción                                 |
|-------------|-----------------------|---------------------------------------------|
| `GET`       | `/tasks`              | Lista todas las tareas.                     |
| `GET`       | `/tasks/{id}`         | Obtiene una única tarea por su ID.          |
| `POST`      | `/tasks`              | Crea una nueva tarea.                       |
| `PUT`       | `/tasks/{id}`         | Actualiza una tarea existente.              |
| `DELETE`    | `/tasks/{id}`         | Elimina una tarea por su ID.                |
