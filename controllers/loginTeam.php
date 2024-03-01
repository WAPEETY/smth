<?php

    $server_root = $_SERVER['DOCUMENT_ROOT'];
    require_once $server_root . '/model/DAO/teamDAO.php';
    require_once $server_root . '/views/import.php';
    //require_once $server_root . '/views/secret.php';

    if(isset($_POST['secret'])){
        $secret = $_POST['secret'];
        echo($secret . "     ");
        $qruuid = $_POST['uuid'];
        echo($qruuid);
        $teamDAO = new TeamDAO();
        $team = $teamDAO->getTeamBySecret($secret);
    }
/*
        if($team){
            //qua hanno fatto il login correttamente quindi possono ricevere la domanda
            $_SESSION['team'] = $team->getId();
            echo($qruuid);
            $header = 'Location: /qr.php?place_uuid='. $qruuid;
            header($header);
        }else{
            $_SESSION['error'] = 'Invalid secret';
            echo("sei un coglione, manco i secret sai scrivere");
            header('Location: /index.php?place_uuid='.$qruuid);
        }
    }
    else{
        launch_404();
    }

*/
?>