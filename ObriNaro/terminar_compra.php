<?php
include_once "funciones.php";
iniciarSesionSiNoEstaIniciada();

// Verificar si se ha enviado el formulario y si el usuario está autenticado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"])) {
    // Obtener el ID del usuario actual
    $idUsuario = $_SESSION["user_id"];

    // Obtener los productos en el carrito
    $productosEnCarrito = obtenerProductosEnCarrito();

    // Inicializar variables para el precio total de la factura
    $precioTotalFactura = 0;

    try {
        $bd = obtenerConexion();
        $bd->beginTransaction();

        foreach ($productosEnCarrito as $producto) {
            $idProducto = $producto->id;
            $cantidad = $producto->cantidad;
            $precioUnitario = $producto->precio;
            $precioTotalProducto = $cantidad * $precioUnitario;

            // Insertar detalles de la compra en la tabla de compras
            $stmt = $bd->prepare("INSERT INTO compra (usuario_id, juego_id, cantidad, precio_producto, precio_total, fecha_actual) VALUES (?, ?, ?, ?, ?, current_timestamp())");
            $stmt->execute([$idUsuario, $idProducto, $cantidad, $precioUnitario, $precioTotalProducto]);

            // Acumular el precio total de la factura
            $precioTotalFactura += $precioTotalProducto;
        }

        // Limpiar el carrito después de terminar la compra
        limpiarCarrito();

        $bd->commit();

        // Redirigir a una página de confirmación o a donde desees
        header("Location: compra_registrada.php");
        exit;
    } catch (PDOException $e) {
        // Manejar errores de base de datos
        $bd->rollBack();
        echo "Error al procesar la compra: " . $e->getMessage();
    }
} else {
    // Si no se ha enviado el formulario correctamente o el usuario no está autenticado, redirigir o manejar el error según sea necesario
    exit;
}
?>
