<?php
session_start();
require_once "funciones.php";

$productos = obtenerProductosEnCarrito();
$total = 0; // Inicializar el total en 0

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - ObriNaro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="./css/main.css">
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
                <ul>
                    <li>
                        <a class="boton-menu boton-volver" href="index.php">
                            <i class="bi bi-arrow-return-left"></i> Seguir comprando
                        </a>
                    </li>
                    <li>
                        <a class="boton-menu boton-carrito active" href="carrito.php">
                            <i class="bi bi-cart-fill"></i> Carrito
                        </a>
                    </li>
                </ul>
            </nav>
            <footer>
                <p class="texto-footer">© 2022 Carpi Coder</p>
            </footer>
        </aside>
        <main>
            <h2 class="titulo-principal">Carrito</h2>
            <div class="contenedor-carrito">
                <?php if (count($productos) <= 0) { ?>
                <section class="hero is-info">
                    <div class="hero-body">
                        <div class="container">
                            <h1 class="title">No hay productos que mostrar</h1>
                        </div>
                    </div>
                </section>
                <?php } else { ?>
                <div class="columns">
                    <div class="column">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($productos as $producto) {
                                    $total += $producto->precio * $producto->cantidad;
                                ?>
                                <tr>
                                    <td><img class="imagen-table" src="<?php echo $producto->imagen ?>" alt="<?php echo $producto->titulo ?>"></td>
                                    <td><?php echo $producto->titulo ?></td>
                                    <td><?php echo $producto->cantidad ?></td>
                                    <td>$<?php echo number_format($producto->precio * $producto->cantidad, 0, 2) ?></td>
                                    <td>
                                        <form action="eliminar_del_carrito.php" method="post">
                                            <input type="hidden" name="id_producto" value="<?php echo $producto->id; ?>">
                                            <button type="submit" class="button is-danger">
                                                <i class="bi bi-trash text-warning"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="is-size-4 has-text-right"><strong>Total</strong></td>
                                    <td colspan="2" class="is-size-4">$<?php echo number_format($total, 0,2) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                        <br>
                        <div class="carrito-acciones">
                            <form id="formVaciarCarrito" action="vaciar_carrito.php" method="post" onsubmit="return confirmarVaciarCarrito(event);">
                                <button type="submit" class="button is-danger is-large">Vaciar Carrito</button>
                            </form>
                            <form id="formTerminarCompra" action="terminar_compra.php" method="post">
                                <button type="submit" class="button is-success is-large">
                                    <i class="fa fa-check"></i>&nbsp;Terminar compra
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </main>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/menu.js"></script>
    <script src="./js/carro.js"></script>

    <?php if (isset($_SESSION['toast_message'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Toastify({
                text: "Producto eliminado",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true, 
                style: {
                    background: "linear-gradient(to right, #4caf50, #c2e8b6)",
                    borderRadius: "2rem",
                    textTransform: "uppercase",
                    fontSize: ".75rem"
                },
                offset: {
                    x: '1.5rem', 
                    y: '1.5rem'
                },
                onClick: function(){}
            }).showToast();
        });
    </script>
    <?php unset($_SESSION['toast_message']); ?>
    <?php endif; ?>
</body>
</html>
