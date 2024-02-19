<?php
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once 'model/DAO/adminDAO.php';

    $adminDAO = new AdminDAO();
    if($adminDAO->login($username, $password)){
        header('Location: admin.php');
    }
    else{
        $_SESSION['error'] = 'Invalid username or password';
    }
}

include 'views/login.php';
?>