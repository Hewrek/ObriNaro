<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Registrada</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de tener tu archivo de estilos CSS -->
    <style>
        /* Estilos específicos para esta página */
        body {
            background-color: #f0f5f4; /* Fondo verde claro */
            font-family: 'Rubik', sans-serif; /* Utilizando la fuente Rubik */
            color: #333; /* Color de texto oscuro */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff; /* Fondo blanco */
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            max-width: 600px;
            width: 100%;
        }

        .titulo {
            color: #4caf50; /* Color verde principal */
            font-size: 2rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .detalle {
            margin-bottom: 1rem;
        }

        .productos {
            margin-bottom: 1rem;
        }

        .total {
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 1rem;
        }

        .regresar {
            text-align: center;
            margin-top: 2rem;
        }

        .regresar a {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #4caf50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .regresar a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="titulo">Compra Registrada</h1>
        <hr>
        <br>
        <?php
        // Incluir archivo de funciones y asegurarse de la sesión iniciada
        include_once "funciones.php";
        iniciarSesionSiNoEstaIniciada();
        $conexion = obtenerConexion();

        // Obtener ID del usuario actual desde la sesión
        $idUsuario = $_SESSION['user_id'];

        // Consulta para obtener datos del usuario
        $sqlUsuario = "SELECT user, email, fono FROM usuario WHERE id = ?";
        $stmtUsuario = $conexion->prepare($sqlUsuario);

        if ($stmtUsuario) {
            // Enlazar el parámetro y ejecutar la consulta
            $stmtUsuario->execute([$idUsuario]);
            $stmtUsuario->bindColumn('user', $nombreUsuario);
            $stmtUsuario->bindColumn('email', $correoUsuario);
            $stmtUsuario->bindColumn('fono', $telefonoUsuario);
            $stmtUsuario->fetch(); // Obtener los resultados
        } else {
            die('Error al preparar la consulta: ' . htmlspecialchars($conexion->error));
        }

        // Mostrar detalles del usuario
        echo "<div class='detalle'><strong>Nombre del Usuario:</strong> " . $nombreUsuario . "</div>";
        echo "<div class='detalle'><strong>Correo del Usuario:</strong> " . $correoUsuario . "</div>";
        echo "<div class='detalle'><strong>Teléfono del Usuario: </strong>+56 " . $telefonoUsuario . "</div>";
        echo "<div class='detalle'><strong>Fecha de Compra:</strong> " . date('d/m/Y H:i:s') . "</div>";

        // Consulta para obtener el último total de la boleta
        $sqlTotalBoleta = "SELECT precio_total FROM compra WHERE usuario_id = ? ORDER BY fecha_actual DESC LIMIT 1";
        $stmtTotalBoleta = $conexion->prepare($sqlTotalBoleta);

        if ($stmtTotalBoleta) {
            // Enlazar el parámetro y ejecutar la consulta
            $stmtTotalBoleta->execute([$idUsuario]);
            $totalBoleta = $stmtTotalBoleta->fetchColumn();
            if ($totalBoleta === false) {
                // No se encontró ningún registro de compra para este usuario
                $totalBoleta = 0;
            }
        } else {
            die('Error al preparar la consulta: ' . htmlspecialchars($conexion->error));
        }

        // Mostrar total de la boleta
        echo "<Hr>";
        echo "<div class='total'><strong>Total de la Boleta:</strong> $" . number_format($totalBoleta, 0,2) . "</div>";

        // Obtener y mostrar los productos comprados
        $productosEnCarrito = obtenerProductosEnCarrito();
        if (!empty($productosEnCarrito)) {
            echo "<div class='productos'><strong>Productos Comprados:</strong><ul>";
            foreach ($productosEnCarrito as $producto) {
                echo "<li>" . $producto->titulo . "</li>";
            }
            echo "</ul></div>";
        }
        ?>

        <div class="regresar">
            <a href="index.php">Regresar a la Tienda</a>
        </div>

    </div>
</body>
</html>
