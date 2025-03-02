# **DOCUMENTACIÓN MESA YA**

![Encabezado](assets/logomesaya.png)

> **"Reserva fácil, disfruta sin esperas".**

## 📌 **Guía de Instalación y Uso – MesaYa (Laravel)**

## 3.1 Requisitos Previos
- PHP 8.x, Composer, MySQL/MariaDB, Node.js y npm.
- Laravel 11, servidor web Apache/Nginx.
- Extensiones PHP: pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json, fileinfo.
- Cuenta de Gmail habilitada para enviar correos.

## 3.2 Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/AlbertoBernal02/mesaya.git
```

### 2. Ir a la carpeta del repositorio
```bash
cd mesaya
```

### 3. Instalar las dependencias
```bash
composer install
npm install
```

### 4. Configurar el `.env`
```bash
cp .env.example .env
```

Dentro del `.env`, cambiar:

**Antes:**
```env
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

**Después:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mesaya
DB_USERNAME=root
DB_PASSWORD=
```

**Antes:**
```env
FILESYSTEM_DISK=local
```

**Después:**
```env
FILESYSTEM_DISK=public
```

**Antes:**
```env
MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**Después:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=mesayamail@gmail.com
MAIL_PASSWORD=ieipxixfawvslnnj
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=mesayamail@gmail.com
MAIL_FROM_NAME="MesaYa"
```

### 5. Crear la clave personalizada
```bash
php artisan key:generate
```

### 6. Abrir XAMPP y ejecutar el servidor MySQL

### 7. Ejecutar los siguientes comandos en la terminal del proyecto:

- Para compilar los estilos:
```bash
npm run dev
```

- Para correr las migraciones:
```bash
php artisan migrate:fresh
```

- Para poblar la base de datos:
```bash
php artisan db:seed
```

- Para iniciar el servidor:
```bash
php artisan serve
```

Disponible en [http://127.0.0.1:8000](http://127.0.0.1:8000).
