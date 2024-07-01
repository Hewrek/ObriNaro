<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - ObriNaro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="css/carruse.css">
</head>
<body>
<?php
include_once "funciones.php";
iniciarSesionSiNoEstaIniciada();

// Verifica si hay una sesión activa y obtén el nombre de usuario
$nombre = isset($_SESSION['user']) ? $_SESSION['user'] : "Invitado";
?>
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
                    <a class="boton-menu boton-inicio active" href="inicio.php">
                        <i class="bi bi-house-door-fill"></i> Inicio
                    </a>
                </li>
                <li>
                    <a class="boton-menu boton-categoria" href="index.php">
                        <i class="bi bi-hand-index-thumb-fill"></i> Todos los productos
                    </a>
                </li>
                <li>
                    <a class="boton-menu boton-inicio" href="contacto.php">
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
    </aside>
    <main>
        <h2 class="titulo-principal" id="titulo-principal">Inicio</h2>
        <p class="texto"><strong>¡Bienvenido "<?php echo htmlspecialchars($nombre); ?>" a ObriNaro, tu tienda de videojuegos para PC!</strong></p>
        <p class="texto">Desde los títulos más recientes hasta los clásicos inolvidables. Disfruta de una experiencia de compra fácil y segura con descuentos y promociones especiales.</p>
        <p class="texto">¡Prepárate para vivir aventuras épicas con ObriNaro!</p>
        <br>

        <h3 class="titulo-principal">GOTYS recomendados  <strong><i class="bi bi-fire"></i></strong></h3>
        <br>
        <section>
            <div class="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/juegos/04.jpg" alt="Imagen 1">
                    </div>
                    <div class="carousel-item">
                        <img src="img/juegos/02.jpg" alt="Imagen 2">
                    </div>
                    <div class="carousel-item">
                        <img src="img/juegos/03.jpg" alt="Imagen 3">
                    </div>
                </div>
                <a class="prev" onclick="moveSlide(-1)">&#10094;</a>
                <a class="next" onclick="moveSlide(1)">&#10095;</a>
            </div>
        </section>
    </main>
</div>
<script src="./js/menu.js"></script>
<script src="js/carrusel.js"></script>
</body>
</html>
