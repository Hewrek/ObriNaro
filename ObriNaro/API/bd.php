<?php
class DB {
    private $host;
    private $bd;
    private $usuario;
    private $pass;

    public function __construct(){
        $this->host = 'localhost';
        $this->bd = 'obrinarobd';
        $this->usuario ='root'; // Corrección del error tipográfico
        $this->pass = '';
    }

    public function connect() {
        try {
            $conexion = "mysql:host=". $this->host. ";dbname=". $this->bd;

            $option = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false];
            
            $pdo = new PDO($conexion, $this->usuario, $this->pass, $option); // Corrección del error tipográfico
            return $pdo; // Devuelve la conexión para su uso posterior
        } catch (PDOException $e) {
            print_r("Error de conexión: ". $e->getMessage());
        }
    }

    // Método opcional para cerrar la conexión
    public function disconnect() {
        if ($this->pdo) {
            $this->pdo = null;
        }
    }
}
?>
