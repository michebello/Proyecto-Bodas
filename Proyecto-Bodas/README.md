# ProyectoBodas - Instrucciones de instalación y ejecución

## Descripción
Este proyecto es una plataforma web para la planificación de bodas. Permite a los usuarios crear su propia página web de bodas, gestionar su lista de invitados, contratar proveedores y organizar su evento.

## Requisitos previos

Antes de comenzar, asegúrate de tener lo siguiente instalado en tu computadora:

1. **XAMPP** (que incluye Apache y MySQL)
2. Un navegador web (como Google Chrome, Firefox, etc.)

## Instrucciones de instalación

### 1. Instalar XAMPP

- **Descargar XAMPP**: Ve a [https://www.apachefriends.org/es/index.html](https://www.apachefriends.org/es/index.html) y descarga la versión de XAMPP que corresponda a tu sistema operativo.
- **Instalar XAMPP**: Sigue los pasos del instalador para completar la instalación de XAMPP en tu computadora.

### 2. Activar Apache y MySQL

- **Abrir XAMPP**: Ejecuta el panel de control de XAMPP.
- **Activar Apache y MySQL**:
  - Haz clic en **Start** al lado de **Apache** (servidor web).
  - Haz clic en **Start** al lado de **MySQL** (base de datos).
  
> **Nota**: Si no se puede activar Apache o MySQL, asegúrate de que los puertos 80 y 3306 no estén siendo utilizados por otras aplicaciones.

### 3. Crear la base de datos

Existen dos formas de crear la base de datos:

#### Opción 1: Crear la base de datos manualmente

- **Acceder a phpMyAdmin**:
  - Abre tu navegador y ve a [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
- **Crear base de datos**:
  - En la página principal de **phpMyAdmin**, haz clic en la pestaña **Bases de datos**.
  - Escribe **bodas_db** en el campo de nombre de la base de datos y haz clic en **Crear**.

#### Opción 2: Crear la base de datos automáticamente

- **Acceder al script de configuración**:
  - Abre tu navegador y escribe en la barra de direcciones: `http://localhost:8080/db_setup.php`.
  - Esto ejecutará un script PHP que creará automáticamente la base de datos **bodas_db** y las tablas necesarias para el funcionamiento del proyecto.

### 4. Descargar el proyecto

- **Clonar el repositorio**:
  - Si aún no lo has hecho, clona este repositorio usando Git:
    ```bash
    git clone https://github.com/BrayanM31/ProyectoBodas.git
    ```
  - **Mover los archivos al directorio de XAMPP**:
    - Copia la carpeta `ProyectoBodas` a la carpeta `htdocs` de XAMPP. Por lo general, la ruta es `C:\xampp\htdocs\`.
    - Ahora tu proyecto estará ubicado en: `C:\xampp\htdocs\ProyectoBodas`.

### 5. Acceder al proyecto

- **Abrir el proyecto en tu navegador**:
  - Abre tu navegador y accede a [http://localhost:8080/ProyectoBodas/index.php](http://localhost:8080/ProyectoBodas/index.php).
  
- **Explorar el sitio**:
  - Explora la página principal y navega por las diferentes secciones de la plataforma (inicio, servicios, proveedores, comunidad).

### 6. Crear una cuenta

- **Iniciar sesión o crear cuenta**:
  - Haz clic en "Crear cuenta" o "Iniciar sesión" en el sitio web.
  - Completa el formulario con tus datos, y después de crear una cuenta o iniciar sesión, podrás acceder a las funciones del sitio.

## Notas adicionales

- **Para cerrar XAMPP**: Cuando termines de trabajar, puedes detener los servicios de **Apache** y **MySQL** desde el panel de control de XAMPP.
- **Seguridad**: Asegúrate de que el proyecto esté protegido si decides publicarlo, ya que no se ha implementado seguridad adicional en este proyecto en su estado actual (por ejemplo, protección contra ataques SQL o contraseñas seguras).

## Contribuir

Si deseas contribuir al proyecto, por favor abre un **issue** o envía un **pull request**. Asegúrate de seguir las buenas prácticas de programación y mantener el código limpio y organizado.
