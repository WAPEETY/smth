<?php
session_start();
include_once 'controllers/controller.php';
if(check_login()){
    header('Location: /admin.php');
}else{
    header('Location: /login.php');
}


//include_once 'views/import.php';

?>