<?php

check_login(){
    $page = basename($_SERVER['PHP_SELF']);

    session_start();
    require_once 'config.php';
    require_once 'model/DAO/classes/connection.php';
    require_once 'model/DAO/adminDAO.php';

    if(isset($_SESSION['admin'])){
        if($page == 'login'){
            header('Location: admin.php');
        }
    }
    else if(isset($_SESSION['team'])){
        if($page == 'login'){
            header('Location: index.php');
        }
        if($page == 'admin'){
            launch_404();
        }
    }
    else{
        if($page != 'login'){
            $_SESSION['error'] = 'You must be logged in to access that page';
            header('Location: login.php');
        }
    }
}

launch_404(){
    header('Location: 404.php');
}

?>