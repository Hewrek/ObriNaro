<?php
include_once "funciones.php";

// Asegurarse de que la sesión esté iniciada
iniciarSesionSiNoEstaIniciada();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Obtener el ID del usuario logueado
$usuario_id = $_SESSION['user_id'];

// Obtener la conexión a la base de datos
$conexion = obtenerConexion();

$sql = "SELECT c.nombre, c.email, c.mensaje FROM contacto c
        JOIN usuario_contacto uc ON c.id_contacto = uc.id_contacto
        WHERE uc.id_usuario = ?";
$stmt = $conexion->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la declaración: ". $conexion->errorInfo()[2]);
}

$stmt->execute([$usuario_id]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - ObriNaro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="css/contacto.css">
</head>
<body>

    <div class="wrapper">
        <header class="header-mobile">
            <h1 class="logo">ObriNaro</h1>
            <button class="open-menu" id="open-menu">
                <i class="bi bi-list"></i>
            </button>
        </header>
        <aside>
            <button class="close-menu" id="close-menu">
                <i class="bi bi-x"></i>
            </button>
            <header>
                <h1 class="logo">ObriNaro</h1>
            </header>
            <nav>
                <ul class="menu">
                    <li>
                        <a class="boton-menu boton-inicio" href="inicio.php">
                            <i class="bi bi-house-door-fill"></i> Inicio
                        </a>
                    </li>
                    <li>
                        <a class="boton-menu boton-categoria" href="index.php">
                            <i class="bi bi-hand-index-thumb-fill"></i> Todos los productos
                        </a>
                    </li>
                    <li>
                        <a class="boton-menu boton-categoria active" href="contacto.php">
                            <i class="bi bi-chat-dots-fill"></i> Contacto
                        </a>
                    </li>
                    <li>
                        <a class="boton-menu boton-carrito" href="cuenta.php">
                            <i class="bi bi-person-circle"></i> Cuenta
                        </a>
                    </li>
                    <li>
                        <a class="boton-menu boton-carrito" href="carrito.php">
                            <i class="bi bi-cart-fill"></i> Carrito
                        </a>
                    </li>
                </ul>
            </nav>
            <footer>
                <p class="texto-footer">© 2024 Bolsonaro</p>
            </footer>
        </aside>
        <main>
            <div class="contact-container">
                <div class="contact-info">
                    <h2>Información de Contacto</h2>
                    <p class="texto"><strong>Sucursal</strong></p>
                    <p class="texto">Dirección: San pablo 4135, Quinta Normal, Santiago</p>
                    <p class="texto">Teléfono: +56 9 3553 8150</p>
                    <p class="texto">Email: contacto@obrinaro.com</p>
                </div>
                
                <div class="map" id="map"></div>

            </div>
            <div class="contact-form-container">
                <h2>Formulario de Contacto</h2>
                <form class="contact-form" action="send_contacto.php" method="POST">
                    <div class="input-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="message">Mensaje</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit">Enviar Mensaje</button>
                </form>
            </div>
            <div class="formularios-container">
                <h2>Formularios Enviados</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Mensaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['mensaje']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="./js/menu.js"></script>
    <script src="./js/map.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap"></script>
        
</body>
</html>
