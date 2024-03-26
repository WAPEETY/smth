<?php

$base_path = $_SERVER['DOCUMENT_ROOT'];

include_once $base_path . '/model/DAO/classes/logger.php';

function check_login(){

    Logger::getInstance()->info("Checking login");

    $allowedPages = array('index.php','login.php', 'qr.php');
    $adminAllowedPages = array('admin.php',
                                'login.php', 
                                'createMatch.php', 
                                'createQuestion.php', 
                                'createTeam.php', 
                                'createQr.php', 
                                'match.php',
                                'team.php',
                                'question.php'
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
            Logger::getInstance()->error("User not allowed to access this page [admin]");
            return false;
        }

    }
    else if(isset($_SESSION['team'])){
        if(in_array($page, $allowedPages)){
            return true;
        }
        else{
            $_SESSION['error'] = 'You are not allowed to access this page';
            Logger::getInstance()->error("User not allowed to access this page [team]");
            return false;
        }
    }
    else{
        $_SESSION['error'] = 'You are not allowed to access this page';
        Logger::getInstance()->error("User not allowed to access this page [no session]");
        return false;
    }
}

function launch_404(){
    header('Location: /404.php');
}

?>