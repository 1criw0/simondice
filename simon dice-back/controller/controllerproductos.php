<?php

include dirname(__FILE__).'/../model/consultas.php';


class Apiproductos{

    function getAll(){
        $Producto = new Productos();
        $Productos = array();
        $Productos["items"] = array();

        $res = $Producto->obtenerPuntaje();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "id_puntaje"=> $row['id_puntaje'],
                    "nombre" => $row['nombre'],
                    "valor_puntaje" => $row['valor_puntaje'],
                );
                array_push($Productos["items"], $item);
            }
        
            echo json_encode($Productos);
        }else{
            $this->error('No hay elementos');
        }
    }


    function add($item){
        $Producto = new Productos();

        $res = $Producto->nuevoPuntaje($item);
        $this->getAll();
    }
    
    function error($mensaje){
        echo  json_encode(array('mensaje' => $mensaje)) ; 
    }

    function exito($mensaje){
        echo  json_encode(array('mensaje' => $mensaje)) ; 
    }

    function printJSON($array){
        echo json_encode($array);
    }

    
}
