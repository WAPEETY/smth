<?php
session_start();
$server_root = $_SERVER['DOCUMENT_ROOT'];
include_once $server_root . '/controllers/controller.php';
include_once $server_root . '/model/DAO/gamematchDAO.php';


if(isset($_GET['place_uuid'])){
    include_once $server_root . '/views/header.php';
    include_once $server_root . '/views/secret.php';
    $place = $_GET['place_uuid'];
    $matchDAO = new GameMatchDAO();
    $match = $matchDAO->getGameMatchByPlace($place);
}else{
    if(check_login()){
        header('Location: /admin.php');
    }else{
        header('Location: /404.php');
    } 
}


?>

