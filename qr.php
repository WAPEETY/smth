<?php 
session_start();

$server_root = $_SERVER['DOCUMENT_ROOT'];

include_once $server_root . '/controllers/controller.php';
include_once $server_root . '/model/DAO/questionsDAO.php';
include_once $server_root . '/model/DAO/classes/question.php';
include_once $server_root . '/views/question.php';

if(!isset($_GET['place_uuid'])){
    launch_404();
}
else{
    if(!check_login()){
        launch_404();
    }
    else{
        $team_id = $_SESSION['team'];
        
        $place_uuid = $_GET['place_uuid'];
        $questionDAO = new QuestionDAO();
        $question = $questionDAO->getQuestionByUUID($team_id, $place_uuid);
        include_once $server_root . '/views/header.php';
        include_once $server_root . '/views/import.php';

            if(isset($_POST['response'])){
                $response = $_POST['response'];

                if(is_numeric($response)){
                    $ans = $question['answers'];
                    $ans = json_decode($ans, true);

                    //check for out of bounds
                    if($response >= count($ans)){
                        //LMFAO
                        echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                    }

                    $ans = $ans[$response];
                    if($ans[1]){
                        ?>
                        <div class="m-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Correct!</strong>
                            <span class="block sm:inline">Read the hint and then close this page!</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm4-10l-6 6-4-4" />
                                </svg>
                            </span>
                        </div>

                        <div class="m-4 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Hint:</strong>
                            <span class="block sm:inline"><?php echo $question['hint']; ?></span>
                            <?php
                            
                            //TODO: click to copy
                            //TODO: unset the session of the team

                            ?>
                        </div>

                        <?php
                    }
                    else{
                        //TODO: in the question page show the wrong answer message
                        $_SESSION['error'] = 'Wrong answer';
                        header('Location: /qr.php?place_uuid=' . $place_uuid);
                    }

                }
                else{
                    //LMFAO
                    echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                }

            }else{
                printQuestionForm($question, $place_uuid);
            }
        }
    }
?>