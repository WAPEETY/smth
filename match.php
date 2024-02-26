<?php 
    session_start();

    $server_root = $_SERVER['DOCUMENT_ROOT'];

    require_once 'controllers/controller.php';
    require_once $server_root . '/model/DAO/gamematchDAO.php';
    if(check_login()){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $matchDAO = new GameMatchDAO();
            $match = $matchDAO->getGameMatch($id);
            if($match){
                include 'views/match.php';
            }else{
                launch_404();
            }
        }else{
            $_SESSION['error'] = 'You must select a match';
            echo 'You must select a match';
        }
    }else{
        launch_404();
    }
?>