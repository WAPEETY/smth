<?

require_once 'model/DAO/classes/connection.php';
require_once 'model/DAO/classes/gamematch.php';

class GameMatchDAO {
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getConnection();
    }  

    public function createGameMatch($gameMatch){
        $sql = "INSERT INTO matches (name) VALUES (:name)";
        $stmt = $this->connection->prepare($sql);

        $gameMatch->setName(htmlspecialchars($gameMatch->getName()));

        $stmt->bindParam(':name', $gameMatch->getName());
        $stmt->execute();
    }

    public function getGameMatch($id){
        $sql = "SELECT * FROM matches WHERE id = :id LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return new GameMatch($result['id'], $result['name']);
        }
        return null;
    }

    public function getGameMatches(){
        $sql = "SELECT * FROM matches";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $gameMatches = array();
        foreach($result as $row){
            array_push($gameMatches, new GameMatch($row['id'], $row['name']));
        }
        return $gameMatches;
    }

    public function deleteGameMatch($id){
        $sql = "DELETE FROM matches WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

?>