# Docker Setup - Hyperzas Cotizador

Este proyecto incluye una configuración completa de Docker para desarrollo.

## 🚀 Inicio Rápido

### Requisitos Previos
- Docker
- Docker Compose

### Instalación y Configuración

1. **Ejecutar el script de configuración:**
   ```bash
   chmod +x docker-setup.sh
   ./docker-setup.sh
   ```

2. **Acceder a la aplicación:**
   - Aplicación web: http://localhost:8080
   - Vite dev server: http://localhost:5173
   - Base de datos MySQL: localhost:3306

## 📦 Servicios Incluidos

- **app**: Contenedor PHP 8.2 con FPM
- **webserver**: Nginx para servir la aplicación
- **db**: MySQL 8.0 para la base de datos
- **node**: Node.js 20 para compilar assets con Vite

## 🛠️ Comandos Útiles

### Gestión de Contenedores
```bash
# Iniciar servicios
docker-compose up -d

# Detener servicios
docker-compose down

# Ver logs
docker-compose logs -f

# Ver logs de un servicio específico
docker-compose logs -f app
```

### Comandos de Laravel
```bash
# Ejecutar migraciones
docker-compose exec app php artisan migrate

# Crear un controlador
docker-compose exec app php artisan make:controller NombreController

# Limpiar caché
docker-compose exec app php artisan cache:clear

# Acceder al contenedor
docker-compose exec app bash
```

### Comandos de Composer
```bash
# Instalar dependencias
docker-compose exec app composer install

# Actualizar dependencias
docker-compose exec app composer update

# Agregar un paquete
docker-compose exec app composer require nombre/paquete
```

### Comandos de Node/NPM
```bash
# Instalar dependencias
docker-compose exec node npm install

# Compilar assets
docker-compose exec node npm run build

# Acceder al contenedor de Node
docker-compose exec node sh
```

### Base de Datos
```bash
# Acceder a MySQL
docker-compose exec db mysql -u laravel -psecret laravel

# Exportar base de datos
docker-compose exec db mysqldump -u laravel -psecret laravel > backup.sql

# Importar base de datos
docker-compose exec -T db mysql -u laravel -psecret laravel < backup.sql
```

## 🔧 Configuración

### Variables de Entorno
Edita el archivo `.env` para configurar:
- Credenciales de base de datos
- Configuración de la aplicación
- URLs y puertos

### Cambiar Puertos
Edita `docker-compose.yml` para modificar los puertos expuestos:
```yaml
ports:
  - "PUERTO_HOST:PUERTO_CONTENEDOR"
```

## 🐛 Solución de Problemas

### Permisos
Si tienes problemas de permisos:
```bash
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/storage
```

### Reconstruir Contenedores
```bash
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

### Limpiar Todo y Empezar de Nuevo
```bash
docker-compose down -v
./docker-setup.sh
```

## 📝 Notas

- Los cambios en el código se reflejan automáticamente (hot reload con Vite)
- La base de datos persiste en un volumen Docker
- Los logs están disponibles en `storage/logs/` dentro del contenedor
