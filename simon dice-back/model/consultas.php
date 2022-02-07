<?php

include dirname(__FILE__).'/conexion/db.php';

class Productos extends DB{
    
    function obtenerPuntaje(){
        $query = $this->connect()->query('SELECT * FROM puntaje ORDER BY updated_at desc limit 5');
        return $query;
    }

    function nuevoPuntaje($puntaje){
        $query = $this->connect()->prepare('INSERT INTO puntaje (nombre, valor_puntaje,updated_at) VALUES(:nombre, :valor_puntaje,CURRENT_TIMESTAMP())');
        $query->execute(['nombre' => $puntaje['nombre'], 'valor_puntaje' => $puntaje['valor_puntaje']]);
        return $query;
    }
}

?>