<?php 


$server_root = $_SERVER['DOCUMENT_ROOT'];

require_once $server_root . '/controllers/controller.php';
require_once $server_root . '/model/DAO/classes/team.php';
require_once $server_root . '/model/DAO/teamDAO.php';

session_start();

if(!check_login()){
    launch_404();
}else{
    if (isset($_POST['teamName'])) {
        $name = $_POST['teamName'];
        
        $team = new Team(null, $name, $_POST['secret'], $_POST['matchId']);
        $dao = new TeamDAO();
        $dao->createTeam($team);
    
        header('Location: /index.php');
    }
}



?>