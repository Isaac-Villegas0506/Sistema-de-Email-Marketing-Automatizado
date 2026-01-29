# Sistema de Email Marketing Automatizado - DEMO

![Laravel](https://img.shields.io/badge/Laravel-11-red)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3-blue)
![SQLite](https://img.shields.io/badge/SQLite-Database-green)

## 📋 Descripción

Sistema de email marketing desarrollado con Laravel 11, diseñado para gestionar campañas de email masivo con seguimiento en tiempo real y análisis detallado.

**⚠️ IMPORTANTE**: Este es un proyecto de **demostración** para portafolio. Los emails y datos son simulados.

## ✨ Características

- 📊 Dashboard en tiempo real con estadísticas
- 📧 Gestión de campañas de email
- 📈 Gráficos de rendimiento interactivos
- 🎯 Sistema de colas asíncrono
- 💾 Base de datos SQLite (portable)
- 🎨 Interfaz moderna con TailwindCSS y Alpine.js
- 🔒 Límite de 3 campañas (auto-limpieza)
- 📱 Diseño responsive

## 🚀 Instalación Local

### Requisitos
- PHP 8.2+
- Composer
- Node.js & NPM

### Pasos

```bash
# 1. Clonar repositorio
git clone <tu-repo>
cd Sistema-de-Email-Marketing-Automatizado

# 2. Instalar dependencias PHP
composer install

# 3. Instalar dependencias Node
npm install

# 4. Configurar entorno
cp .env.example .env
php artisan key:generate

# 5. Crear base de datos
php artisan migrate:fresh

# 6. Poblar con datos de demo
php artisan db:seed --class=DemoDataSeeder

# 7. Compilar assets
npm run build

# 8. Servir aplicación
php artisan serve
```

Visita: `http://localhost:8000`

## 📦 Despliegue en Hosting

### Opción 1: Vercel/Netlify (Recomendado)

1. Conecta tu repositorio Git
2. Configura las variables de entorno:
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=<genera-con-artisan-key-generate>
   DB_CONNECTION=sqlite
   ```

3. Build commands:
   ```
   composer install --optimize-autoloader --no-dev
   npm run build
   php artisan migrate:fresh --seed --force
   ```

### Opción 2: cPanel / Hosting compartido

1. Sube todos los archivos al servidor
2. Configura el DocumentRoot a `/public`
3. Crea archivo `.env`:
   ```bash
   cp .env.example .env
   nano .env # Edita las configuraciones
   ```
4. Ejecuta:
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan key:generate
   php artisan migrate:fresh --seed --force
   php artisan config:cache
   php artisan route:cache
   ```

## 🗄️ Base de Datos

El proyecto usa **SQLite** por defecto (archivo `database/database.sqlite`).

Para resetear los datos de demo:
```bash
php artisan migrate:fresh --seed
```

## 🎯 Datos de Demostración

Al ejecutar el seeder, se crean:
- ✅ 3 campañas de ejemplo
- ✅ 37 emails totales
- ✅ 28 exitosos (75%)
- ✅ 9 fallidos con errores realistas

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 11
- **Frontend**: TailwindCSS 3, Alpine.js
- **Base de datos**: SQLite
- **Build**: Vite
- **Iconos**: Heroicons

## 📝 Notas de Desarrollo

- **Auto-limpieza**: La aplicación mantiene máximo 3 campañas para optimizar la base de datos
- **Rate Limiting**: Máximo 10 requests por hora en rutas de campañas
- **Modo Demo**: No envía emails reales, solo simula el proceso
- **Errores**: Todos los mensajes de error son responsabilidad del destinatario

## 🔐 Seguridad

- ✅ CSRF Protection habilitado
- ✅ Rate limiting configurado
- ✅ Validación de inputs
- ✅ Sanitización automática
- ✅ Headers de seguridad

## 📄 Licencia

Este es un proyecto de demostración para portafolio personal.

## 👤 Autor

**Isaac Villegas**
- GitHub: [@Isaac-Villegas0506](https://github.com/Isaac-Villegas0506)
- Portafolio: 

---

**⚠️ Recordatorio**: Este proyecto es solo una demostración. Los datos son ficticios y no se envían emails reales.
