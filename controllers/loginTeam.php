<?php
    $server_root = $_SERVER['DOCUMENT_ROOT'];
    require_once $server_root . '/model/DAO/teamDAO.php';
    require_once $server_root . '/views/import.php';


    if(isset($_POST['secret'])){
        $secret = $_POST['secret'];
        echo($secret . "     ");
        $qruuid = $_POST['uuid'];
        echo($qruuid);
        $teamDAO = new TeamDAO();
        $team = $teamDAO->getTeamBySecret($secret);
        echo($team);
    }

    /*
        if($team){
            $team_test = 
            $_SESSION['team'] = $team->getId();
            echo($_SESSION['team']);}

        
        
            
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