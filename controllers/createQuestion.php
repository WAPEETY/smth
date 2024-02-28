<?php 
session_start();

function chechAnswers($ans){
    //ans should be a json array of arrays with the following structure:
    // [
    //     ["ans1", true],
    //     ["ans2", false],
    //     ...
    //     ["ans4", false],
    // ]
    $ans = json_decode($ans, true);
    $correct = 0;
    foreach($ans as $a){
        if(!is_string($a[0]) || !is_bool($a[1])){
            return false;
        }
    }
}

$server_root = $_SERVER['DOCUMENT_ROOT'];
require_once $server_root . '/controllers/controller.php';
require_once $server_root . '/model/DAO/classes/question.php';

if(!check_login()){
    launch_404();
}

var_dump($_POST);

if (isset($_POST['q_text'])) {
    $qrid = $_POST['qrId'];
    $teamid = $_POST['teamId'];
    $question = $_POST['q_text'];
    $answers = $_POST['answers'];
    $hint = $_POST['hint'];

    echo $question;
    var_dump($question);

    $question = new Question(-1, $qrid, $teamid, $question, $answers, $hint);

    chechAnswers($question);

    $questionDao = new QuestionDAO();
    //$questionDao->createQuestion($question);

    var_dump($question);

    header('Location: /views/admin.php');
    exit();
}else{
    launch_404();
}

?>