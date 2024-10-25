<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$host = 'localhost';
$db = 'formulario_productos';
$user = 'root';
$pass = '';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}


// Consulta de datos 
$monedas = $conexion->query("SELECT id, nombre FROM monedas")->fetchAll(PDO::FETCH_ASSOC);
$bodegas = $conexion->query("SELECT id, nombre FROM bodegas")->fetchAll(PDO::FETCH_ASSOC);
$sucursales = $conexion->query("SELECT id, nombre FROM sucursales")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>
    <link rel="stylesheet" href="css/styles.css">
    <script defer src="js/script.js"></script>
</head>
<body>

 


<div id="errorMessages" class="message-box"></div>


<form class="formulario" id="productoForm" method="POST" action="producto.php">

    <h1>Formulario de Producto</h1>
    <div class="form-group">
        <div>
            <label for="codigo">Código</label>
            <input type="text" id="codigo" name="codigo">
        </div>
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre">
        </div>
    </div>
    <div class="form-group">
        <div>
            <label for="bodega">Bodega</label>
            <select id="bodega" name="bodega">
                <option value=""></option>
                <?php foreach ($bodegas as $bodega): ?>
                    <option value="<?php echo $bodega['id']; ?>"><?php echo $bodega['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="sucursal">Sucursal</label>
            <select id="sucursal" name="sucursal">
                <option value=""></option>
                <?php foreach ($sucursales as $sucursal): ?>
                    <option value="<?php echo $sucursal['id']; ?>"><?php echo $sucursal['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div>
            <label for="moneda">Moneda</label>
            <select id="moneda" name="moneda">
                <option value=""></option>
                <?php foreach ($monedas as $moneda): ?>
                    <option value="<?php echo $moneda['id']; ?>"><?php echo $moneda['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="precio">Precio</label>
            <input type="text" id="precio" name="precio">
        </div>
    </div>
    <label>Material del Producto:</label>
    <div class="material-checkbox-group">
        <label><input type="checkbox" name="material[]" value="Plástico"> Plástico</label>
        <label><input type="checkbox" name="material[]" value="Metal"> Metal</label>
        <label><input type="checkbox" name="material[]" value="Madera"> Madera</label>
        <label><input type="checkbox" name="material[]" value="Vidrio"> Vidrio</label>
        <label><input type="checkbox" name="material[]" value="Textil"> Textil</label>
    </div>

    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="descripcion"></textarea>

    <div class="formulario__grupo formulario__grupo-btn-enviar">
        <button type="submit" class="formulario__btn">Guardar Producto</button>
    </div>
</form>
<script src="js/script.js"></script>
</body>
</html>


