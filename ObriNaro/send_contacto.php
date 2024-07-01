<?php
include_once "funciones.php";
iniciarSesionSiNoEstaIniciada();

if (isset($_SESSION['user_id'])) {
    if (isset($_POST['name'], $_POST['email'], $_POST['message'])) {
        $usuario = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

        // Debug: Log received data
        error_log("Datos recibidos - Nombre: $usuario, Email: $email, Mensaje: $message");

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("El correo electrónico no es válido."); window.location.href = "contacto.php";</script>';
            exit();
        }

        $conexion = obtenerConexion();
        $conexion->beginTransaction();

        try {
            // Insert into 'contacto' table
            $sqlContacto = "INSERT INTO contacto (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)";
            $stmtContacto = $conexion->prepare($sqlContacto);

            if ($stmtContacto === false) {
                throw new Exception('Error en la preparación de la declaración: ' . $conexion->errorInfo()[2]);
            }

            $stmtContacto->bindParam(':nombre', $usuario);
            $stmtContacto->bindParam(':email', $email);
            $stmtContacto->bindParam(':mensaje', $message);

            if (!$stmtContacto->execute()) {
                throw new Exception('Error en la ejecución de la declaración: ' . $stmtContacto->errorInfo()[2]);
            }

            $idContacto = $conexion->lastInsertId();

            // Associate with user in 'usuario_contacto' table
            $idUsuario = $_SESSION['user_id']; // Ensure this matches your session variable

            $sqlUsuarioContacto = "INSERT INTO usuario_contacto (id_usuario, id_contacto) VALUES (:id_usuario, :id_contacto)";
            $stmtUsuarioContacto = $conexion->prepare($sqlUsuarioContacto);

            if ($stmtUsuarioContacto === false) {
                throw new Exception('Error en la preparación de la declaración: ' . $conexion->errorInfo()[2]);
            }

            $stmtUsuarioContacto->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $stmtUsuarioContacto->bindParam(':id_contacto', $idContacto, PDO::PARAM_INT);

            if (!$stmtUsuarioContacto->execute()) {
                throw new Exception('Error en la ejecución de la declaración: ' . $stmtUsuarioContacto->errorInfo()[2]);
            }

            $conexion->commit();

            // Success message and redirect
            echo '<script>alert("Formulario enviado correctamente."); window.location.href = "contacto.php";</script>';
        } catch (Exception $e) {
            $conexion->rollBack();
            echo 'Error: ' . $e->getMessage();
        }

        // Clean up
        $stmtContacto = null;
        $stmtUsuarioContacto = null;
        $conexion = null;
    } else {
        // Redirect if form data not received
        echo '<script>alert("Datos del formulario no recibidos."); window.location.href = "contacto.php";</script>';
    }
} else {
    // Redirect if user not logged in
    echo '<script>alert("Debe iniciar sesión para enviar el formulario."); window.location.href = "login.php";</script>';
}
?>
