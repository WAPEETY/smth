<?php 
session_start();
require_once 'config.php';
require_once 'model/DAO/classes/connection.php';
require_once 'model/DAO/adminDAO.php';

//check if the user is already logged in
if(isset($_SESSION['admin'])){
    header('Location: admin.php');
}
else if(isset($_SESSION['team'])){
    header('Location: index.php');
}
else if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $adminDAO = new AdminDAO();
    $admin = $adminDAO->getAdmin($username, $password);
    if($admin){
        $_SESSION['admin'] = $admin;
        header('Location: admin.php');
    } else {
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: login.php');
    }
} else {
    include 'views/login.php';
}
?>