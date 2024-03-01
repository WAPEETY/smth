<?php
session_start();
$server_root = $_SERVER['DOCUMENT_ROOT'];
include_once $server_root . '/controllers/controller.php';
include_once $server_root . '/model/DAO/gamematchDAO.php';
include_once $server_root . '/views/import.php';



if(isset($_GET['place_uuid'])){
    include_once $server_root . '/views/secret.php'; //moved here bc asks for secret also without uuid
    $place = $_GET['place_uuid'];
    echo("DEBUG ONLY. place_uuid: " . $place);
    $matchDAO = new GameMatchDAO();
    $match = $matchDAO->getGameMatchByPlace($place);

}
else{
    include_once $server_root . '/views/login.php'; 
    if(check_login()){
        header('Location: /admin.php');
    }else{
        header('Location: /login.php');
    }
} 

?>

