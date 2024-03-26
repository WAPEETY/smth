<?php 
    session_start();
    require_once 'controllers/controller.php';
    if(check_login()){
    }else{
        //echo "You are not allowed to access this page";
        header('Location: /login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMTH - Admin Panel</title>
</head>
<body>
<a href="logout.php">Logout</a>

<?php

//new code
require_once 'model/DAO/classes/gamematch.php';
require_once 'model/DAO/gamematchDAO.php';
require_once 'views/match.php';

$gameMatchDAO = new GameMatchDAO();
$gameMatches = $gameMatchDAO->getGameMatches();

?><div class="flex flex-col flex-wrap"><?php
foreach($gameMatches as $gameMatch){
    ?> <div> <?php
    printMatch($gameMatch, true);
    ?> </div> <?php
}
createMatchForm();
?></div>

<div>
    <h2>Logs</h2>
    <table>
        <tr>
            <th>Time</th>
            <th>Message</th>
        </tr>
        <?php
        require_once 'model/DAO/logsDAO.php';

        if(isset($_GET['log'])){
            $log = $_GET['log'];

            if(!is_numeric($log)){
                $log = 10;
            }

            $logs = LogsDAO::getLastLogs($log);
        }else{
            $logs = LogsDAO::getLastLogs(10);
        }
            foreach($logs as $log){
            echo "<tr><td>".$log['time']."</td><td>".$log['message']."</td></tr>";
        }
        ?>
    </table>
</div>

<?php



?>

</body>
</html>