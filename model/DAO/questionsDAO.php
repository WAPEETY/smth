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


    
}