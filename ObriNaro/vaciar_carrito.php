<?php
include_once "funciones.php";
iniciarSesionSiNoEstaIniciada();

// Verificar si se ha enviado el formulario y si el usuario está autenticado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"])) {
    try {
        // Vaciar el carrito para el usuario actual
        $limpiado = limpiarCarrito();

        if ($limpiado) {
            // Éxito al vaciar el carrito
            // Puedes redirigir a una página de éxito o mostrar un mensaje aquí mismo
            header("Location: carrito.php");
        } else {
            // Error al vaciar el carrito
            // Puedes manejar el error según sea necesario
            echo "Error al vaciar el carrito";
        }
    } catch (PDOException $e) {
        // Manejar errores de base de datos
        echo "Error al vaciar el carrito: " . $e->getMessage();
    }
} else {
    // Si no se ha enviado el formulario correctamente o el usuario no está autenticado, redirigir o manejar el error según sea necesario
    echo "Acceso no autorizado";
}
?>
