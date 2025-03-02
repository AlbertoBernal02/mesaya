# **MesaYa – Sistema de Reservas de Restaurantes en Laravel**

## 📌 **Descripción**

**MesaYa** es una aplicación web desarrollada en **Laravel 10** que permite gestionar la reserva de mesas en restaurantes. El sistema incluye autenticación de usuarios, generación de PDFs con detalles de la reserva y envío de correos electrónicos de confirmación a través de **Gmail**.

✅ **Laravel Fortify** para autenticación segura.  
✅ **Generación de PDFs** para confirmar reservas.  
✅ **Envío de correos con Gmail** sin usar Mailtrap.  
✅ **Sistema de roles** donde los administradores pueden gestionar restaurantes y los usuarios pueden hacer reservas.  

---

## 🚀 **Características**

- **Gestión de restaurantes y reservas**  
  - Los administradores pueden agregar, editar y eliminar restaurantes.  
  - Los usuarios pueden buscar restaurantes y realizar reservas.  

- **Sistema de autenticación**  
  - Registro e inicio de sesión con **Laravel Fortify**.  
  - Protección de rutas según roles de usuario.  

- **Envío de correos de confirmación**  
  - El sistema envía un correo automático con los detalles de la reserva.  

- **Generación de PDFs**  
  - Se genera un PDF con los detalles de la reserva para descargar o imprimir.  

---

## 📌 **Instalación**

### **1️⃣ Clona el repositorio**

```sh
git clone https://github.com/tuusuario/mesaya.git
cd mesaya
```

---

### **2️⃣ Instala las dependencias**

```sh
composer install
npm install && npm run build
```

---

### **3️⃣ Configura las variables de entorno**

Renombra el archivo de configuración:

```sh
cp .env.example .env
```

Genera la clave de aplicación:

```sh
php artisan key:generate
```

Modifica el archivo `.env` para establecer los datos de la base de datos:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mesa_ya
DB_USERNAME=root
DB_PASSWORD=
```

---

### **4️⃣ Configurar envío de correos con Gmail**

1. Habilita la autenticación en dos pasos en tu cuenta de Google.
2. Genera una contraseña de aplicación en [Google Security](https://myaccount.google.com/security).
3. Configura el archivo `.env`:

```ini
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-email@gmail.com
MAIL_PASSWORD=tu-clave-generada
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu-email@gmail.com
MAIL_FROM_NAME="MesaYa"
```

---

### **5️⃣ Configurar Laravel Fortify (Autenticación)**

El sistema ya tiene **Laravel Fortify** instalado, pero si necesitas publicar la configuración:

```sh
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
```

---

### **6️⃣ Configurar generación de PDFs**

El sistema usa **barryvdh/laravel-dompdf**. Si necesitas instalarlo:

```sh
composer require barryvdh/laravel-dompdf
```

---

### **7️⃣ Crear la base de datos y ejecutar migraciones**

```sh
php artisan migrate --seed
```

---

### **8️⃣ Iniciar el servidor de desarrollo**

```sh
php artisan serve
```

La aplicación estará disponible en **`http://127.0.0.1:8000/`**.

Si usas Docker con **Sail**:

```sh
./vendor/bin/sail up -d
```

Accede desde `http://localhost`.

---

## 📌 **Uso del Proyecto**

### **1️⃣ Registro e inicio de sesión**
- Los usuarios pueden registrarse y hacer reservas.  
- Los administradores pueden gestionar restaurantes.  

**Cuenta de prueba (Administrador):**  
- **Email:** `admin@mesaya.com`  
- **Contraseña:** `password`  

---

### **2️⃣ Gestión de Restaurantes**
- Los administradores pueden agregar, editar y eliminar restaurantes.  
- Cada restaurante está registrado como un producto en la base de datos.  

---

### **3️⃣ Realizar una Reserva**
- Los usuarios pueden ver restaurantes y reservar una mesa.  
- Se genera un **PDF** con los detalles de la reserva.  
- Se envía un **correo de confirmación** con la información de la reserva.  

---

## 📌 **Despliegue en Producción**
### **1️⃣ Configurar permisos**
```sh
chmod -R 775 storage bootstrap/cache
```

### **2️⃣ Optimizar la aplicación**
```sh
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### **3️⃣ Supervisar tareas en segundo plano**
```sh
php artisan queue:work
```

---

## 📌 **Preguntas Frecuentes**
### **¿Cómo restablezco la base de datos?**
```sh
php artisan migrate:fresh --seed
```

### **¿Cómo accedo a Laravel Tinker para probar consultas?**
```sh
php artisan tinker
```

### **¿Cómo verifico si Laravel está correctamente instalado?**
```sh
php artisan --version
```

---

🚀 ¡Ya tienes todo listo para usar **MesaYa**!
