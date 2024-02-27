<?php 
session_start();

$server_root = $_SERVER['DOCUMENT_ROOT'];

require_once $server_root . '/controllers/controller.php';
require_once $server_root . '/model/DAO/classes/gamematch.php';
require_once $server_root . '/model/DAO/gamematchDAO.php';

check_login();

if (isset($_POST['matchName'])) {
    $name = $_POST['matchName'];
    
    $gameMatch = new GameMatch(0,$name);
    $dao = new GameMatchDAO();
    $dao->createGameMatch($gameMatch);
    header('Location: /index.php');
}

?>