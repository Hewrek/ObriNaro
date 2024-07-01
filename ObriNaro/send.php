<?php
include_once "funciones.php";
iniciarSesionSiNoEstaIniciada();

// Recepción de datos del formulario
if (isset($_POST['reg_user'], $_POST['reg_fono'], $_POST['reg_email'], $_POST['reg_password'])) {
    $usuario = htmlspecialchars($_POST['reg_user'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['reg_email'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['reg_password'], ENT_QUOTES, 'UTF-8');
    $fono = htmlspecialchars($_POST['reg_fono'], ENT_QUOTES, 'UTF-8');

    if (strlen($password) <= 6) {
        echo '<script>alert("La contraseña debe tener 6 dígitos o más.");
            window.location.href = "registro.html";
            </script>';
        exit();
    }
    if (strlen($fono) != 9) {
        echo '<script>alert("El fono debe tener 9 dígitos.");
            window.location.href = "registro.html";
            </script>';
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("El correo electrónico no es válido.");
            window.location.href = "registro.html";
            </script>';
        exit();
    }

    $conexion = obtenerConexion();

    try {
        // Preparación de la consulta SQL
        $sql = "INSERT INTO usuario (user, email, password, fono) VALUES (:user, :email, :password, :fono)";

        // Preparación de la declaración
        $stmt = $conexion->prepare($sql);

        // Asignación de parámetros a la declaración preparada
        $stmt->bindParam(':user', $usuario);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fono', $fono);

        // Ejecución de la declaración
        if ($stmt->execute()) {
            echo '<script>alert("Usuario registrado exitosamente.");
                window.location.href = "login.html";
                </script>';
        } else {
            echo "Error en la ejecución de la declaración: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cierre de la declaración y conexión
    $stmt = null;
    $conexion = null;
} else {
    echo '<script>alert("Datos del formulario no recibidos.");
        window.location.href = "registro.html";
        </script>';
}
?>
