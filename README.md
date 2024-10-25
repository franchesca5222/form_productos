Formulario de productos:

Este proyecto es una aplicación web para el registro de productos, que permite a los usuarios ingresar información sobre productos utilizando un formulario. La aplicación está construida utilizando HTML, PHP, AJAX y una base de datos MySQL.

Descripción:

El formulario de registro de productos incluye los siguientes campos:

codigo: Campo obligatorio que debe ser único y validado. Debe contener entre 5 y 15 caracteres alfanuméricos. nombre: Campo obligatorio que debe tener entre 2 y 50 caracteres. bodega: Selección de bodegas cargadas dinámicamente desde la base de datos. sucursal: Selección de sucursales que se cargan dependiendo de la bodega seleccionada. moneda: Selección de monedas cargadas desde la base de datos. precio: Campo obligatorio que debe ser un número positivo con hasta dos decimales. material: Se deben seleccionar al menos dos opciones de materiales. descripcion del producto a registrar: Campo obligatorio que debe tener entre 10 y 1000 caracteres.

Lenguajes usados

HTML: Para la estructura del formulario.
PHP/8.2.12 : Para la lógica del servidor y la interacción con la base de datos.
AJAX: Para la carga dinámica de opciones en los campos de moneda, bodega y sucursal.
MYSQL: Para almacenar la información del producto en la base de datos.
Instrucciones:

Clona el repositorio en tu máquina local:

"bash" git clone https://github.com/tu_usuario/tu_repositorio.git

Asegúrate de tener un servidor web (como XAMPP o WAMP) instalado y funcionando.

Crea una base de datos llamada formulario_productos en tu servidor MySQL.

Importa las tablas necesarias (asegúrate de que las tablas productos, monedas, bodegas, sucursales y producto_materiales estén creadas según las necesidades de tu aplicación).

Configura la conexión a la base de datos en el archivo conexion.php:

php Copiar código $host = 'localhost'; $db = 'formulario_productos'; $user = 'root'; $pass = '';

Uso: Completa el formulario con la información del producto. Haz clic en "Guardar Producto" para enviar los datos. Los mensajes de error se mostrarán como alertas en la página si no se cumplen las validaciones.