<?php

    include_once 'juego.php';

    class ApiJuegos extends Juego{

        function getAll(){

            $juego= new Juego();
            $juegos = array();
            $juegos["items"] = array();

            $res = $juego->obtenerJuegos();

            if($res->rowCount()){
                while($row = $res->fetch(PDO::FETCH_ASSOC)){
                    $item = array(
                        'id' => $row['id'],
                        'titulo' => $row['titulo'],
                        'imagen' => $row['imagen'],
                        'precio' => $row['precio'],
                        'desc' => $row['desc'],
                    );
                    array_push($juegos["items"], $item);
                }
                echo json_encode($juegos);
            }else{
                echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            }
        }
    }
?>