<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h1 align="center">REIKOSOFT</h1>

<p align="center">
  Sistema modular web desarrollado con Laravel<br>
  Gestión avanzada de módulos, usuarios y secciones personalizadas.
</p>

---

## 📌 Descripción

**REIKOSOFT** es un sistema web modular y adaptable diseñado para facilitar la gestión de contenido, usuarios y secciones dinámicas dentro de una organización. Su estructura está pensada para crecer de forma flexible con nuevas funcionalidades.

## 🚀 Características

- Panel de usuario con foto, tipo de usuario y nombre
- Menú lateral con navegación por secciones
- Carga dinámica de módulos por sección usando AJAX
- Rutas protegidas por autenticación
- Integración con FontAwesome, SweetAlert2 y Bootstrap
- Interfaz responsiva y moderna
- Sistema de módulos con íconos personalizados

## 🧰 Tecnologías utilizadas

- PHP 8.x
- Laravel 10
- MySQL
- JQuery / AJAX
- Bootstrap 4
- FontAwesome 6
- SweetAlert2

## ⚙️ Instalación

```bash
# Clonar repositorio
git clone https://github.com/ADRICASTSYSTEM/REIKOSOFT.git
cd REIKOSOFT

# Instalar dependencias
composer install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Crear base de datos y aplicar migraciones
php artisan migrate --seed

# Instalar dependencias frontend (si se usa Vite o Mix)
npm install && npm run dev

# Iniciar servidor
php artisan serve
```
