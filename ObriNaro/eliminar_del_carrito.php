<?php
session_start();
require_once 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_producto'])) {
        $idProducto = $_POST['id_producto'];

        if (quitarProductoDelCarrito($idProducto)) {
            $_SESSION['toast_message'] = 'Producto eliminado';
        } else {
            $_SESSION['toast_message'] = 'Error al intentar eliminar el producto del carrito';
        }
    } else {
        $_SESSION['toast_message'] = 'ID de producto no proporcionado';
    }

    header('Location: carrito.php');
    exit();
} else {
    $_SESSION['toast_message'] = 'Método de solicitud no válido';
    header('Location: carrito.php');
    exit();
}
?>
