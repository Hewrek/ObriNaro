<?php
include_once "funciones.php";

// Verificar si se recibió el ID del producto por POST
if (!isset($_POST["id_producto"])) {
    exit("No hay id_producto");
}

// Obtener el ID del producto desde $_POST
$idProducto = $_POST["id_producto"];

// Llamar a la función para agregar el producto al carrito
agregarProductoAlCarrito($idProducto);

// Redirigir al usuario a la página principal (index.php) después de agregar al carrito
header("Location: index.php");
exit(); // Asegura que el script se detenga después de la redirección
?>
