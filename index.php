<?php
session_start();
$server_root = $_SERVER['DOCUMENT_ROOT'];
include_once $server_root . '/controllers/controller.php';
include_once $server_root . '/model/DAO/gamematchDAO.php';
include_once $server_root . '/model/DAO/classes/logger.php';

if(isset($_GET['place_uuid'])){
    Logger::getInstance()->info("params: { place_uuid: '$_GET[place_uuid]' } -> GAME MATCH REQUEST" );
    include_once $server_root . '/views/header.php';
    include_once $server_root . '/views/secret.php';
    $place = $_GET['place_uuid'];
    $matchDAO = new GameMatchDAO();
    $match = $matchDAO->getGameMatchByPlace($place);
    Logger::getInstance()->info("params: { place_uuid: '$_GET[place_uuid]' } -> GAME MATCH FOUND" );
}else{
    if(check_login()){
        header('Location: /admin.php');
    }else{
        header('Location: /404.php');
    }
}


?>

