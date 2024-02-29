<?php 
session_start();

echo("sei in qr.php");

$server_root = $_SERVER['DOCUMENT_ROOT'];

include_once $server_root . 'controller/controller.php';
include_once $server_root . '/model/DAO/questionDAO.php';

if(!$_GET['place_uuid']){
    launch_404();
}
else{
    if(!check_login()){
        launch_404();
    }
    else{
        $teamid = $_SESSION['team'];
        $place_uuid = $_GET['place_uuid'];

        //ottengo la domanda per quel team dal db
        $questionDAO = new QuestionDAO();
        $question = $questionDAO->getQuestionByUUID($team_id, $place_uuid); //qui il testo della domanda

        //qui printo la domanda
        echo($question);

        }
    }
?>