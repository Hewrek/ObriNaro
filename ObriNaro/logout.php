<?php
include_once "funciones.php";
iniciarSesionSiNoEstaIniciada();

// Destruir todas las variables de sesión
session_unset();    // Limpiar todas las variables de sesión
session_destroy();  // Destruir la sesión actual

// Redirigir al usuario al formulario de inicio de sesión u otra página
header("Location: index.php");
exit();  // Asegúrate de que el script se detenga después de redirigir
?>
