<?php
include_once 'controllerproductos.php';

$api = new Apiproductos();


$url = $_SERVER['REQUEST_URI'];

if ($url == '/simondice') {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if (isset($_GET['id'])) {
                $sql = $dbConn->prepare("SELECT * FROM posts where id=:id");
                $sql->bindValue(':id', $_GET['id']);
                $sql->execute();
                header("HTTP/1.1 200 OK");
                echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
                exit();
            } else {

                $api->getAll();
            }

            break;

        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'), true);
            if (isset($_POST['nombre']) && isset($_POST['valor_puntaje'])) {

                $item = array(
                    'nombre' =>  $_POST['nombre'],
                    'valor_puntaje' =>  $_POST['valor_puntaje'],
                );
                $api->add($item);
            }  else {
                $api->error('Error al llamar a la API');
            }
            break;
       
    }
} 
