# Configuración de Deploy Automático

## Claves SSH Generadas

### Clave Pública (deploy_key.pub)
```
ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIHlRnAnTredhC0iEnV2RgyazmPeg/tzjc8kDzkwrnxCh hyperzas-cotizador-deploy
```

### Clave Privada (deploy_key)
Ver archivo `deploy_key` en la raíz del proyecto (NO SUBIR A GIT)

---

## Configuración en cPanel

1. **Acceder a cPanel → SSH Access → Manage SSH Keys**

2. **Importar Clave Pública:**
   - Click en "Import Key"
   - Pegar el contenido de `deploy_key.pub`
   - Guardar y autorizar la clave

3. **Verificar puerto SSH:**
   - Generalmente es el puerto 22
   - Algunos cPanel usan 2222 o 2083
   - Verificar en cPanel → SSH Access

---

## Configuración en GitHub

### 1. Agregar Deploy Key (Opcional - solo lectura del repositorio)

1. Ve a tu repositorio → Settings → Deploy keys
2. Click en "Add deploy key"
3. Título: `hyperzas-cotizador-cpanel`
4. Pega el contenido de `deploy_key.pub`
5. **NO marcar** "Allow write access"

### 2. Configurar Secrets (REQUERIDO para el deploy)

Ve a tu repositorio → Settings → Secrets and variables → Actions

Agrega los siguientes secrets:

**SSH_PRIVATE_KEY**
```
Contenido completo del archivo deploy_key (incluye -----BEGIN y -----END)
```

**CPANEL_HOST**
```
tu-dominio.com (o la IP del servidor)
```

**CPANEL_USERNAME**
```
tu_usuario_cpanel
```

**SSH_PORT**
```
22 (o el puerto que uses, típicamente 22, 2222, o 2083)
```

**CPANEL_PATH**
```
/home/usuario/public_html/cotizador (ruta completa donde se desplegará)
```

---

## Configuración del archivo .env en cPanel

Crea un archivo `.env.production` en la raíz del proyecto con la configuración de producción:

```env
APP_NAME="Hyperzas Cotizador"
APP_ENV=production
APP_KEY=base64:TU_CLAVE_GENERADA
APP_DEBUG=false
APP_URL=https://tu-dominio.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=tu_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

---

## Flujo de Deploy

1. **Hacer cambios en el código**
2. **Commit y push a la rama main:**
   ```bash
   git add .
   git commit -m "Descripción del cambio"
   git push origin main
   ```

3. **GitHub Actions automáticamente:**
   - Instala dependencias PHP y Node.js
   - Compila assets
   - Sube archivos a cPanel vía SSH
   - Ejecuta comandos post-deploy (cache, migrations)

4. **Verificar en GitHub:**
   - Ve a la pestaña "Actions" en tu repositorio
   - Verás el progreso del deploy

---

## Seguridad

⚠️ **IMPORTANTE:**
- NO subir `deploy_key` (clave privada) al repositorio
- Ya está en `.gitignore`
- Solo la clave pública se comparte con cPanel
- La clave privada solo va en GitHub Secrets

---

## Troubleshooting

### Error: Permission denied (publickey)
- Verifica que la clave pública esté autorizada en cPanel
- Verifica el puerto SSH correcto
- Verifica el username de cPanel

### Error: Connection timeout
- Verifica que el servidor permita conexiones SSH externas
- Algunos hosts bloquean GitHub Actions IPs
- Contacta con tu proveedor de hosting

### Error: Directory not found
- Verifica la ruta CPANEL_PATH
- Asegúrate que el directorio existe en cPanel
- Crea el directorio manualmente si es necesario
