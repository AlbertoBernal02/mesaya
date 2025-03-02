# **DOCUMENTACIÓN MESA YA**

![Encabezado](assets/logomesaya.png)

> **"Reserva fácil, disfruta sin esperas".**

## 📌 **Guía de Instalación y Uso – MesaYa (Laravel)**

### **Requisitos Previos**

Antes de instalar el proyecto, asegúrate de contar con los siguientes requisitos:

- PHP 8.x
- Composer
- MySQL/MariaDB
- Node.js y npm (para gestionar los assets)
- Laravel 11 (se instalará con Composer)
- Un servidor web como Apache o Nginx
- Extensiones PHP requeridas: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`
- Cuenta de Gmail habilitada para enviar correos

---

## 📌 **Instalación**

### **1️⃣ Clonar el repositorio**

Si el código fuente está en GitHub, clónalo con:

```sh
git clone https://github.com/AlbertoBernal02/mesaya.git
cd mesaya
```

Si lo descargas como `.zip`, extrae la carpeta y accede a ella desde la terminal.

---

### **2️⃣ Instalar dependencias**

Ejecuta los siguientes comandos para instalar las dependencias del proyecto:

```sh
composer install
```

También instala las dependencias de frontend con:

```sh
npm install && npm run build
```

---

### **3️⃣ Configurar variables de entorno**

Duplica el archivo `.env.example` y renómbralo como `.env`:

```sh
cp .env.example .env
```

Después, genera la clave de la aplicación:

```sh
php artisan key:generate
```

Modifica el archivo `.env` y ajusta los valores de conexión a la base de datos:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mesaya
DB_USERNAME=root
DB_PASSWORD=
```

Si estás usando otro usuario o una contraseña diferente, ajústalos según tu configuración.

---

### **4️⃣ Configurar envío de correos con Gmail**

La aplicación envía correos utilizando **Gmail** en lugar de Mailtrap. Para configurarlo:

1. Accede a [Tu cuenta de Google](https://myaccount.google.com/)
2. Habilita la autenticación en dos pasos.
3. Genera una contraseña de aplicación en [Google Security](https://myaccount.google.com/security) → "Contraseñas de aplicaciones".
4. Configura las variables de entorno en `.env`:

```ini
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-email@gmail.com
MAIL_PASSWORD=tu-contraseña-de-aplicacion
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu-email@gmail.com
MAIL_FROM_NAME="MesaYa"
```

---

### **5️⃣ Crear la base de datos**

Crea la base de datos manualmente en MySQL o usa el siguiente código en la herramienta **MySQL Workbench**:

```sql
DROP DATABASE IF EXISTS mesaya;
CREATE DATABASE IF NOT EXISTS mesaya;
```

---

### **6️⃣ Ejecutar migraciones y seeders**

Para crear las tablas e insertar datos de prueba, ejecuta:

```sh
php artisan migrate:fresh
php artisan db:seed
```

Esto creará las tablas y llenará la base de datos con información de prueba.

---

### **7️⃣ Configurar Laravel Fortify**

El proyecto utiliza **Laravel Fortify** para la autenticación. Ya está instalado, pero asegúrate de ejecutar el siguiente comando si aún no está publicado:

```sh
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
```

Si necesitas personalizar la autenticación, revisa el archivo:

```sh
app/Providers/FortifyServiceProvider.php
```

---

### **8️⃣ Configurar generación de PDFs**

El proyecto usa una librería para generar PDFs (**barryvdh/laravel-dompdf**). Si aún no está instalada, hazlo con:

```sh
composer require barryvdh/laravel-dompdf
```

Publica la configuración si necesitas modificar opciones:

```sh
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
```

---

### **9️⃣ Iniciar el servidor de desarrollo**

Ejecuta el siguiente comando para iniciar el servidor local de Laravel:

```sh
php artisan serve
```

El proyecto estará disponible en **[http://127.0.0.1:8000/](http://127.0.0.1:8000/)**.
