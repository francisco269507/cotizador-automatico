# Cotizador Hyperzas

Sistema de cotización web desarrollado con Laravel para generar cotizaciones profesionales en PDF con cálculo automático de IGV y conversión de divisas.

## 🚀 Características

- Sistema de autenticación con diseño corporativo
- Gestión de productos y servicios
- Cálculo automático de totales con IGV (18%)
- Conversión de USD a PEN con tipo de cambio manual
- Generación de PDF profesional con logo corporativo
- Interfaz intuitiva para selección de productos

## 📋 Requisitos

- PHP >= 8.1
- Composer
- MySQL o SQLite
- Node.js y NPM (opcional, para desarrollo con Vite)

## 🔧 Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/TU-USUARIO/hyperzas-cotizador.git
cd hyperzas-cotizador
```

2. **Instalar dependencias de PHP**
```bash
composer install
```

3. **Configurar variables de entorno**
```bash
copy .env.example .env
```

4. **Generar clave de aplicación**
```bash
php artisan key:generate
```

5. **Configurar base de datos**

Edita el archivo `.env`:
```
DB_CONNECTION=sqlite
# O para MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=hyperzas_cotizador
# DB_USERNAME=root
# DB_PASSWORD=
```

Para SQLite, crea el archivo de base de datos:
```bash
New-Item database/database.sqlite -ItemType File
```

6. **Ejecutar migraciones y seeders**
```bash
php artisan migrate --seed
```

7. **Iniciar el servidor**
```bash
php artisan serve
```

Accede a: `http://localhost:8000`

## 👥 Cuentas de Usuario

El sistema incluye 3 usuarios de prueba:

| Email | Contraseña | Rol | Nombre |
|-------|-----------|-----|--------|
| admin@hyperzas.com | password | Administrador | Administrador |
| francisco@hyperzas.com | password | Vendedor | Francisco |
| mafer@hyperzas.com | password | Vendedor | Mafer |

## 📦 Productos Preconfigurados

El sistema incluye 14 servicios precargados:

**Microsoft 365:**
- Business Basic ($6.00 USD)
- Business Standard ($12.50 USD)
- Business Premium ($22.00 USD)

**Hosting:**
- Hosting Básico (S/. 8.00 PEN)
- Hosting Avanzado (S/. 15.00 PEN)
- Hosting Corporativo (S/. 25.00 PEN)

**Servicios Web:**
- Webmaster - Presencia Web (S/. 250.00 PEN)
- Webmaster - Actualización Continua (S/. 350.00 PEN)
- Dominio .com/.pe ($15.00 USD)
- Correo Corporativo (S/. 8.00 PEN)
- Ecommerce Básico (S/. 80.00 PEN)
- Ecommerce Premium (S/. 150.00 PEN)

**SKontrol:**
- SKontrol Básico (S/. 50.00 PEN)
- SKontrol Avanzado (S/. 80.00 PEN)

## 🎨 Colores Corporativos

- Primario: `#01212E`
- Secundario: `#3A6D82`

## 📝 Uso

1. Inicia sesión con cualquiera de las cuentas disponibles
2. Selecciona productos y cantidades
3. Ingresa los datos del cliente
4. Define el tipo de cambio USD a PEN
5. Selecciona el periodo de facturación (Mensual/Anual/Única)
6. Genera el PDF de la cotización

## 🛠️ Tecnologías

- **Backend:** Laravel 12.x
- **Base de datos:** MySQL/SQLite
- **PDF:** DomPDF (barryvdh/laravel-dompdf)
- **Frontend:** Blade Templates, JavaScript vanilla, CSS
- **Autenticación:** Laravel Auth

## 📄 Licencia

Este proyecto es privado y de uso exclusivo de Hyperzas.

## 👨‍💻 Desarrollador

Desarrollado para Hyperzas - 2025

---

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
