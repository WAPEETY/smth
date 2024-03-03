<?php
    session_start();
    $server_root = $_SERVER['DOCUMENT_ROOT'];
    require_once $server_root . '/model/DAO/teamDAO.php';
    


    if(isset($_POST['secret'])){
        $secret = $_POST['secret'];
        $qruuid = $_POST['uuid'];
        $teamDAO = new TeamDAO();
        $team = $teamDAO->getTeamBySecret($secret);
        if($team){
            $_SESSION['team'] = $team->getId();
            $header = 'Location: /qr.php?place_uuid='. $qruuid;
            header($header);
        }else{
            $_SESSION['error'] = 'Invalid secret';
            header('Location: /index.php?place_uuid='.$qruuid);
        }
    }
?>
