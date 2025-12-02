#!/bin/bash

echo "🐳 Configurando entorno Docker para Hyperzas Cotizador..."

# Crear archivo .env si no existe
if [ ! -f .env ]; then
    echo "📝 Creando archivo .env..."
    cp .env.docker .env
fi

# Levantar contenedores
echo "🚀 Levantando contenedores Docker..."
docker-compose up -d

# Esperar a que los contenedores estén listos
echo "⏳ Esperando a que los servicios estén listos..."
sleep 10

# Instalar dependencias de Composer
echo "📦 Instalando dependencias de Composer..."
docker-compose exec -T app composer install

# Generar key de aplicación
echo "🔑 Generando clave de aplicación..."
docker-compose exec -T app php artisan key:generate

# Ejecutar migraciones
echo "🗄️  Ejecutando migraciones de base de datos..."
docker-compose exec -T app php artisan migrate --force

# Crear enlaces simbólicos de storage
echo "🔗 Creando enlaces simbólicos..."
docker-compose exec -T app php artisan storage:link

# Limpiar caché
echo "🧹 Limpiando caché..."
docker-compose exec -T app php artisan config:clear
docker-compose exec -T app php artisan cache:clear
docker-compose exec -T app php artisan view:clear

echo "✅ ¡Configuración completada!"
echo ""
echo "🌐 La aplicación está disponible en: http://localhost:8080"
echo "🗄️  Base de datos MySQL en: localhost:3306"
echo "⚡ Vite dev server en: http://localhost:5173"
echo ""
echo "📋 Comandos útiles:"
echo "  - Ver logs: docker-compose logs -f"
echo "  - Detener: docker-compose down"
echo "  - Ejecutar comandos: docker-compose exec app php artisan [comando]"
