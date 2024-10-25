
<?php
require 'conexion.php';

if (isset($_GET['bodega_id'])) {
    $bodegaId = $_GET['bodega_id'];

    $stmt = $conexion->prepare("SELECT id, nombre FROM sucursales WHERE bodega_id = ?");
    $stmt->execute([$bodegaId]);
    $sucursales = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($sucursales);
}
?>
