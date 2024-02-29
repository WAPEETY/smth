<?
$server_root = $_SERVER['DOCUMENT_ROOT'];

require_once $server_root . '/model/DAO/classes/connection.php';
require_once $server_root . '/model/DAO/classes/gamematch.php';
require_once $server_root . '/model/DAO/qrDAO.php';



class QuestionDAO {
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getConnection();
    }  

    public function getQuestion($team_id, $id){
        $query = "SELECT * FROM questions WHERE id = :id AND team_id = :team_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    public function getQuestionByUUID($team_id, $uuid){
        $qrDAO = new qrDAO();
        $id = $qrDAO->getIdByUuid($uuid);
        return $this->getQuestion($team_id, $id);
    }

    public function getQuestionsByQrId($qr_id){
        $query = "SELECT * FROM questions WHERE qr_id = :qr_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':qr_id', $qr_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    public function createQuestion($question){
        $query = "INSERT INTO questions (question, answers, qr_id, team_id, hint) VALUES (:question, :answers, :qr_id, :team_id, :hint)";
        $stmt = $this->connection->prepare($query);

        $q = $question->getQuestion();
        $a = $question->getAnswers();
        $qr_id = $question->getQrId();
        $team_id = $question->getTeamId();
        $h = $question->getHint();


        $stmt->bindParam(':question', $q);
        $stmt->bindParam(':answers', $a);
        $stmt->bindParam(':qr_id', $qr_id);
        $stmt->bindParam(':team_id', $team_id);
        $stmt->bindParam(':hint', $h);
        $stmt->execute();
        
        $stmt->closeCursor();
    }
    
}