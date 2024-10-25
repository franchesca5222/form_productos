<?php
$host = 'localhost';
$db = 'formulario_productos';
$user = 'root';
$pass = '';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}

// Verificando  el tipo de datos solicitado (moneda, bodega o sucursal)

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
    $tabla = '';

    switch ($tipo) {
        case 'moneda':
            $tabla = 'monedas';
            break;
        case 'bodega':
            $tabla = 'bodegas';
            break;
        case 'sucursal':
            $tabla = 'sucursales';
            break;
    }

    if ($tabla != '') {
        $stmt = $conexion->prepare("SELECT id, nombre FROM $tabla");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultados);
    }
}
?>
