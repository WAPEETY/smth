<?php 
session_start();

$server_root = $_SERVER['DOCUMENT_ROOT'];

include_once $server_root . '/controllers/controller.php';
include_once $server_root . '/model/DAO/questionsDAO.php';
include_once $server_root . '/model/DAO/classes/question.php';
include_once $server_root . '/views/question.php';
include_once $server_root . '/model/DAO/classes/logger.php';

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

        if(!is_numeric($team_id)){
            launch_404();
        }

        Logger::getInstance()->info("params: { place_uuid: '$place_uuid' } -> QR PAGE LOGIN DONE");

        $questionDAO = new QuestionDAO();
        $question = $questionDAO->getQuestionByUUID($team_id, $place_uuid);

        if(!$question){
            launch_404();
        }

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

                    Logger::getInstance()->info("params: { place_uuid: '$place_uuid', team: '$team_id', response: '$response' } -> QR PAGE ANSWER SUBMITTED");

                    if($ans[1]){
                        Logger::getInstance()->info("params: { place_uuid: '$place_uuid', team: '$team_id', response: '$response' } -> QR PAGE ANSWER CORRECT");
                        ?>

                        <?php include_once $server_root . '/views/header.php';
                        include_once $server_root . '/views/import.php'; ?>
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
                            <span class="block sm:inline" onclick="
                                var text = '<?php echo $question['hint']; ?>';
                                var dummy = document.createElement('textarea');
                                document.body.appendChild(dummy);
                                dummy.value = text;
                                dummy.select();
                                document.execCommand('copy');
                                document.body.removeChild(dummy);
                                alert('Hint copied to clipboard');
                            " ><?php echo $question['hint']; ?></span>
                            <?php
                            
                            $_SESSION['team'] = null;
                            unset($_SESSION['team']);
                            session_destroy();
                            ?>
                        </div>

                        <?php
                    }
                    else{
                        $_SESSION['error'] = 'Wrong answer';
                        Logger::getInstance()->info("params: { place_uuid: '$place_uuid', team: '$team_id', response: '$response' } -> QR PAGE ANSWER WRONG");
                        header('Location: /qr.php?place_uuid=' . $place_uuid);
                    }

                }
                else{
                    //LMFAO
                    echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                }

            }else{
                include_once $server_root . '/views/header.php';
                include_once $server_root . '/views/import.php';
                if(isset($_SESSION['error'])){
                    echo '<div class="text-red-500 text-sm font-medium p-2 bg-red-100 rounded-lg m-4">'.$_SESSION['error'].'</div>';
                    unset($_SESSION['error']);
                }
                Logger::getInstance()->info("params: { place_uuid: '$place_uuid', team: '$team_id' } -> QR PAGE QUESTION FORM");
                printQuestionForm($question, $place_uuid);
            }
        }
    }
?>