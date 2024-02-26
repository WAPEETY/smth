<?php
session_start();
include_once 'controllers/controller.php';
include_once 'model/DAO/gamematchDAO.php';


if(isset($_GET['place_uuid'])){
    $place = $_GET['place_uuid'];
    $matchDAO = new GameMatchDAO();
    $match = $matchDAO->getGameMatchByPlace($place);
}else{
    if(check_login()){
        header('Location: /admin.php');
    }else{
        header('Location: /login.php');
    }
} 

//include_once 'views/import.php';

?>