<?php

    include_once 'bd.php';

    class Juego extends DB{

        function obtenerJuegos(){
            $query = $this->connect()->query('SELECT * FROM juegos');

            return $query;
        }
    }

?>