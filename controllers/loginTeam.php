<?php
    session_start();
    $server_root = $_SERVER['DOCUMENT_ROOT'];
    require_once $server_root . '/model/DAO/teamDAO.php';
    require_once $server_root . '/model/DAO/classes/logger.php';
    


    if(isset($_POST['secret'])){
        Logger::getInstance()->info("params: { uuid: '$_POST[uuid]' } -> LOGIN TEAM REQUEST" );
        $secret = $_POST['secret'];
        $qruuid = $_POST['uuid'];
        $teamDAO = new TeamDAO();
        $team = $teamDAO->getTeamBySecret($secret);
        if($team){
            $_SESSION['team'] = $team->getId();
            Logger::getInstance()->info("params: { uuid: '$_POST[uuid]' } -> LOGIN TEAM SUCCESS" );
            $header = 'Location: /qr.php?place_uuid='. $qruuid;
            header($header);
        }else{
            $_SESSION['error'] = 'Invalid secret';
            Logger::getInstance()->error("params: { uuid: '$_POST[uuid]' } -> LOGIN TEAM ERROR" );
            header('Location: /index.php?place_uuid='.$qruuid);
        }
    }
?>
