<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obrinarobd";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los datos de la solicitud
$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['usuario_id']) || !isset($data['productos'])) {
    echo json_encode(["message" => "Error al recibir los datos"]);
    exit;
}

$usuario_id = $data['usuario_id'];
$productos = $data['productos'];

// Insertar en la tabla 'compra'
$sqlCompra = "INSERT INTO compra (usuario_id, fecha, total) VALUES (?, NOW(), ?)";
$stmtCompra = $conn->prepare($sqlCompra);
$total = 0;

foreach ($productos as $producto) {
    $total += $producto['precio'] * $producto['cantidad'];
}

$stmtCompra->bind_param("id", $usuario_id, $total);

if ($stmtCompra->execute()) {
    $compra_id = $stmtCompra->insert_id;

    // Insertar en la tabla 'detalle_compra'
    $sqlDetalle = "INSERT INTO detalle_compra (compra_id, producto_id, cantidad, precio) VALUES (?, ?, ?, ?)";
    $stmtDetalle = $conn->prepare($sqlDetalle);

    foreach ($productos as $producto) {
        $stmtDetalle->bind_param("iiid", $compra_id, $producto['id'], $producto['cantidad'], $producto['precio']);
        $stmtDetalle->execute();
    }

    echo json_encode(["message" => "Compra realizada con éxito"]);
} else {
    echo json_encode(["message" => "Error al realizar la compra"]);
}

$stmtCompra->close();
$stmtDetalle->close();
$conn->close();
?>
