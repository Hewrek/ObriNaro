<?php
include_once "funciones.php";
$productos = obtenerProductos();
iniciarSesionSiNoEstaIniciada();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - ObriNaro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/shop.css">

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
                        <button id="todos" class="boton-menu boton-categoria active"><i class="bi bi-hand-index-thumb-fill"></i> Todos los productos</button>
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
            <footer>
                <p class="texto-footer">© 2024 Bolsonaro</p>
            </footer>
        </aside>
        <main>
            <h2 class="titulo-principal" id="titulo-principal">Todos los productos</h2>
            <div id="contenedor-productos" class="contenedor-productos">
                <?php foreach ($productos as $producto) { ?>
                    <div class="producto">
                        <div class="cardBox">
                            <div class="card">
                                <div class="h4">
                                    <img class="producto-imagen" src="<?php echo $producto->imagen ?>" alt="<?php echo $producto->titulo ?>">
                                </div>
                            
                                <div class="content">
                                    <h3 class="producto-titulo"><?php echo $producto->titulo ?></h3>
                                    <br>
                                    <p class="producto-precio"><?php echo $producto->desc ?></p>
                                    <br>
                                    <p class="producto-precio">$<?php echo number_format($producto->precio,0, 2) ?></p>
                                    
                                    <!-- Formulario para agregar al carrito -->
                                    <form id="formAgregarCarrito_<?php echo $producto->id ?>" action="agregar_al_carrito.php" method="post">
                                        <input type="hidden" name="id_producto" value="<?php echo $producto->id ?>">
                                        <button type="button" class="producto-agregar" onclick="agregarAlCarrito(<?php echo $producto->id ?>)">
                                            <i class="fa fa-cart-plus"></i>&nbsp;Agregar al carrito
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </main>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="./js/index.js"></script>
    <script src="./js/menu.js"></script>
</body>
</html>