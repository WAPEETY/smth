<?php 

include_once 'controller/controller.php';

check_login();

if(!isset($_POST['answer'])){
    include 'views/question.php';
}
else{
    include 'views/hint.php';
}

?>