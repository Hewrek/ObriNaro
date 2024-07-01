<?php

function obtenerProductosEnCarrito()
{
    iniciarSesionSiNoEstaIniciada(); 

    if (!isset($_SESSION['user_id'])) {
        return []; 
    }

    $usuario_id = $_SESSION['user_id'];
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("SELECT juegos.id, juegos.titulo,juegos.imagen, juegos.precio, carrito.cantidad
        FROM juegos
        INNER JOIN carrito
        ON juegos.id = carrito.juego_id
        WHERE carrito.usuario_id = ?");
    $sentencia->execute([$usuario_id]);
    return $sentencia->fetchAll();
}

function obtenerProductos()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT * FROM juegos");
    return $sentencia->fetchAll();
}

function productoYaEstaEnCarrito($idProducto)
{
    $ids = obtenerIdsDeProductosEnCarrito();
    foreach ($ids as $id) {
        if ($id == $idProducto) return true;
    }
    return false;
}

function obtenerIdsDeProductosEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $usuario_id = $_SESSION['user_id'];
    $sentencia = $bd->prepare("SELECT juego_id FROM carrito WHERE usuario_id = ?");
    $sentencia->execute([$usuario_id]);
    return $sentencia->fetchAll(PDO::FETCH_COLUMN);
}

function agregarProductoAlCarrito($idProducto)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $usuario_id = $_SESSION['user_id'];
    
    // Verificar si el producto ya está en el carrito
    $sentencia = $bd->prepare("SELECT cantidad FROM carrito WHERE usuario_id = ? AND juego_id = ?");
    $sentencia->execute([$usuario_id, $idProducto]);
    $productoEnCarrito = $sentencia->fetch(PDO::FETCH_OBJ);
    
    if ($productoEnCarrito) {
        // Si el producto ya está en el carrito, incrementar la cantidad
        $nuevaCantidad = $productoEnCarrito->cantidad + 1;
        $sentencia = $bd->prepare("UPDATE carrito SET cantidad = ? WHERE usuario_id = ? AND juego_id = ?");
        return $sentencia->execute([$nuevaCantidad, $usuario_id, $idProducto]);
    } else {
        // Si el producto no está en el carrito, agregarlo con cantidad 1
        $sentencia = $bd->prepare("INSERT INTO carrito(usuario_id, juego_id, cantidad) VALUES (?, ?, 1)");
        return $sentencia->execute([$usuario_id, $idProducto]);
    }
}

function iniciarSesionSiNoEstaIniciada()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function guardarProducto($nombre, $precio, $descripcion)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("INSERT INTO productos(nombre, precio, descripcion) VALUES(?, ?, ?)");
    return $sentencia->execute([$nombre, $precio, $descripcion]);
}

function obtenerVariableDelEntorno($key)
{
    if (defined("_ENV_CACHE")) {
        $vars = _ENV_CACHE;
    } else {
        $file = "env.php";
        if (!file_exists($file)) {
            throw new Exception("El archivo de las variables de entorno ($file) no existe. Favor de crearlo");
        }
        $vars = parse_ini_file($file);
        define("_ENV_CACHE", $vars);
    }
    if (isset($vars[$key])) {
        return $vars[$key];
    } else {
        throw new Exception("La clave especificada (" . $key . ") no existe en el archivo de las variables de entorno");
    }
}

function obtenerConexion()
{
    $password = obtenerVariableDelEntorno("MYSQL_PASSWORD");
    $user = obtenerVariableDelEntorno("MYSQL_USER");
    $dbName = obtenerVariableDelEntorno("MYSQL_DATABASE_NAME");
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}

function mostrarCantidadTotalEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $usuario_id = $_SESSION['user_id'];
    $sentencia = $bd->prepare("SELECT SUM(cantidad) as cantidad_total FROM carrito_usuarios WHERE usuario_id = ?");
    $sentencia->execute([$usuario_id]);
    $resultado = $sentencia->fetch(PDO::FETCH_OBJ);

    if ($resultado) {
        echo "Cantidad total de productos en el carrito: {$resultado->cantidad_total}\n";
    } else {
        echo "No hay productos en el carrito.\n";
    }
}

function limpiarCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $usuario_id = $_SESSION['user_id'];
    $sentencia = $bd->prepare("DELETE FROM carrito WHERE usuario_id = ?");
    return $sentencia->execute([$usuario_id]);
}
function quitarProductoDelCarrito($idProducto)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $usuario_id = $_SESSION['user_id'];

    // Obtener la cantidad actual del producto en el carrito
    $sentencia = $bd->prepare("SELECT cantidad FROM carrito WHERE usuario_id = ? AND juego_id = ?");
    $sentencia->execute([$usuario_id, $idProducto]);
    $productoEnCarrito = $sentencia->fetch(PDO::FETCH_OBJ);

    if ($productoEnCarrito) {
        if ($productoEnCarrito->cantidad > 1) {
            // Si la cantidad es mayor a 1, disminuirla en 1
            $nuevaCantidad = $productoEnCarrito->cantidad - 1;
            $sentencia = $bd->prepare("UPDATE carrito SET cantidad = ? WHERE usuario_id = ? AND juego_id = ?");
            return $sentencia->execute([$nuevaCantidad, $usuario_id, $idProducto]);
        } else {
            // Si la cantidad es 1, eliminar el producto del carrito
            $sentencia = $bd->prepare("DELETE FROM carrito WHERE usuario_id = ? AND juego_id = ?");
            return $sentencia->execute([$usuario_id, $idProducto]);
        }
    }
    return false; // En caso de que el producto no esté en el carrito
}

?>
