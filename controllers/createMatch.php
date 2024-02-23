<?php 
session_start();
require_once 'controller.php';
require_once 'model/DAO/classes/gamematch.php';

check_login();

if (isset($_POST['createMatch'])) {
    $name = $_POST['name'];
    $gameMatch = new GameMatch($name);
    $dao = new GameMatchDAO();
    $dao->createGameMatch($gameMatch);
    header('Location: index.php');
}

?>