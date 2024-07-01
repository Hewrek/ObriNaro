<?php
include_once "funciones.php";

// Asegurarse de que la sesión esté iniciada
iniciarSesionSiNoEstaIniciada();

// Obtener la conexión a la base de datos
$conexion = obtenerConexion();

if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, user FROM usuario WHERE email = ? AND password = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        die('Error al preparar la consulta: ' . htmlspecialchars($conexion->errorInfo()[2]));
    }

    $stmt->execute([$email, $password]);

    // Obtener resultados
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró un usuario
    if ($usuario) {
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user'] = $usuario['user'];

        header("Location: inicio.php");
        exit();
    } else {
        // Credenciales incorrectas, mostrar mensaje de error o redirigir al formulario de inicio de sesión
        header("Location: login.html?error=1"); // Redirigir con indicador de error
        exit();
    }
} else {
    // Datos del formulario no enviados, redirigir al formulario de inicio de sesión
    header("Location: login.html");
    exit();
}
?>
