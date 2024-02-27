<?php 
session_start();

$server_root = $_SERVER['DOCUMENT_ROOT'];
require_once $server_root . '/controllers/controller.php';
require_once $server_root . '/model/DAO/classes/question.php';

if(!check_login()){
    launch_404();
}

if (isset($_POST['question'])) {
    throw new Exception("Not implemented");
}else{
    launch_404();
}

?>