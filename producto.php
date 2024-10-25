<?php
$host = 'localhost';
$db = 'formulario_productos';
$user = 'root';
$pass = '';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    //json
    
    header("Content-Type: application/json");
    echo json_encode([
        "success" => false,
        "message" => "Error de conexión: " . $e->getMessage()
    ]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = trim($_POST['codigo']);
    $nombre = trim($_POST['nombre']);
    $bodega = (int)$_POST['bodega'];
    $sucursal = (int)$_POST['sucursal'];
    $moneda = (int)$_POST['moneda'];
    $precio = floatval($_POST['precio']);
    $descripcion = trim($_POST['descripcion']);
    $materiales = isset($_POST['material']) && is_array($_POST['material']) ? $_POST['material'] : [];

    // Validación de campos del formulario
    if (empty($codigo) || empty($nombre) || empty($bodega) || empty($sucursal) || empty($moneda) || $precio < 0 || empty($descripcion)) {
        // Respuesta JSON para error de validación
        header("Content-Type: application/json");
        echo json_encode([
            "success" => false,
            "message" => "Por favor, completa todos los campos requeridos."
        ]);
        exit();
    } else {
        // Insertar el producto en la base de datos
        try {
            $stmt = $conexion->prepare("INSERT INTO productos (codigo, nombre, bodega_id, sucursal_id, moneda_id, precio, descripcion) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$codigo, $nombre, $bodega, $sucursal, $moneda, $precio, $descripcion]);

            $producto_id = $conexion->lastInsertId();

            // Inserta los materiales en la tabla producto_materiales
            foreach ($materiales as $material) {
                $stmt_material = $conexion->prepare("INSERT INTO producto_materiales (producto_id, material) VALUES (?, ?)");
                $stmt_material->execute([$producto_id, $material]);
            }

            // Configuración de respuesta de éxito
            header("Content-Type: application/json");
            echo json_encode([
                "success" => true,
                "message" => "Producto registrado con éxito."
            ]);
            exit();

        } catch (PDOException $e) {
            // Configuración de respuesta de error en caso de fallo de inserción
            header("Content-Type: application/json");
            echo json_encode([
                "success" => false,
                "message" => "Error al guardar el producto: " . $e->getMessage()
            ]);
            exit();
        }
    }
}
?>