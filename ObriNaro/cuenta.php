<?php
include_once 'funciones.php'; // Incluye el archivo donde están definidas tus funciones

// Inicia la sesión si no está iniciada
iniciarSesionSiNoEstaIniciada();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Redirige a la página de inicio de sesión si no está autenticado
    header("Location: login.html");
    exit();
}

// Obtiene el ID y nombre de usuario de la sesión
$user_id = $_SESSION['user_id'];
$nombre = $_SESSION['user'];

// Obtiene la conexión a la base de datos
try {
    $conexion = obtenerConexion();
} catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

// Consulta SQL para obtener el email y teléfono del usuario
$sql = "SELECT email, fono FROM usuario WHERE id = ?";
$stmt = $conexion->prepare($sql);

if ($stmt) {
    // Enlazar el parámetro y ejecutar la consulta
    $stmt->execute([$user_id]);
    $stmt->bindColumn('email', $email);
    $stmt->bindColumn('fono', $telefono);
    $stmt->fetch(); // Obtener los resultados
} else {
    die('Error al preparar la consulta: ' . htmlspecialchars($conexion->error));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta - ObriNaro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/cuenta.css">
    <link rel="stylesheet" href="css/card.css">
</head>
<body>
    <a href="index.php" class="return-button"> <i class="bi bi-house-fill"></i> Volver a Inicio </a>
    <a href="logout.php" class="logout-button"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
    <div class="container">
        <header class="header">
            <h1>Mi Perfil</h1>
            <br><br>
        </header>
        <section class="profile">
            <div class="profile-picture">
                <img src="img/icon/perfil.png" alt="Foto de Perfil">
            </div>
            <div class="profile-info">
                <h2><?php echo htmlspecialchars($nombre); ?></h2>
                <p>Hola. Soy <?php echo htmlspecialchars($nombre); ?>, un apasionado jugador.</p>
                <p><strong>Email: <?php echo htmlspecialchars($email); ?></strong></p>
                <p><strong>Teléfono:</strong> +56 <?php echo htmlspecialchars($telefono); ?></p>
            </div>
        </section>
    </div>
</body>
</html>
