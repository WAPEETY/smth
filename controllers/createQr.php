<?php 
session_start();

$server_root = $_SERVER['DOCUMENT_ROOT'];

require_once $server_root . '/controllers/controller.php';
require_once $server_root . '/model/DAO/classes/gamematch.php';
require_once $server_root . '/model/DAO/gamematchDAO.php';
require_once $server_root . '/model/DAO/classes/qr.php';
require_once $server_root . '/model/DAO/qrDAO.php';

if(!check_login()){
    launch_404();
}else{
    if (isset($_POST['qrName'])) {
        $name = $_POST['qrName'];
        $matchid = $_POST['matchId'];
        $uuid = $_POST['uuid'];

        $MatchDAO = new GameMatchDAO();
        $match = $MatchDAO->getGameMatch($matchid);

        if($match){
            $qr = new QR(0,$uuid,$name,$matchid);
            $qrDAO = new QrDAO();
            $qrDAO->createQR($qr);
            header('Location: /admin.php');
        }
        else{
            $_SESSION['error'] = 'Invalid match while creating QR';
            header('Location: /index.php');
        }
    }
}



?>