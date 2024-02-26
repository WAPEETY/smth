<?php

function check_login(){

    $allowedPages = array('index.php','login.php');
    $adminAllowedPages = array('admin.php',
                                'login.php', 
                                'createMatch.php', 
                                'createQuestion.php', 
                                'createTeam.php', 
                                'createQR.php', 
                                'match.php'
                            );


    if (session_status() == PHP_SESSION_NONE) {
        throw new Exception('Session not started');
    }

    $page = basename($_SERVER['PHP_SELF']);

    $server_root = $_SERVER['DOCUMENT_ROOT'];
    require_once $server_root . '/config.php';

    if(isset($_SESSION['admin'])){

        if(in_array($page, $allowedPages) || in_array($page, $adminAllowedPages)){
            return true;
        }
        else{
            $_SESSION['error'] = 'You are not allowed to access this page';
            return false;
        }

    }
    else if(isset($_SESSION['team'])){
        $_SESSION['error'] = 'Not implemented yet';
        return false;
    }
    else{
        $_SESSION['error'] = 'You are not allowed to access this page';
        return false;
    }
}

function launch_404(){
    header('Location: /404.php');
}

?>