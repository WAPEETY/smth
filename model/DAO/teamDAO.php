<?php

$server_root = $_SERVER['DOCUMENT_ROOT'];

require_once $server_root . '/model/DAO/classes/connection.php';
require_once $server_root . '/model/DAO/classes/team.php';

class TeamDAO {
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getConnection();
    }  

    public function createTeam($team){
        $sql = "INSERT INTO teams (name, secret, match_id) VALUES (:name, :secret, :match_id)";
        $stmt = $this->connection->prepare($sql);

        $name = $team->getName();
        $secret = $team->getSecret();
        $match_id = $team->getMatchId();

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':secret', $secret);
        $stmt->bindParam(':match_id', $match_id);
        $stmt->execute();
    }

    public function getTeam($id){
        $sql = "SELECT * FROM teams WHERE id = :id LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return new Team($result['id'], $result['name'], $result['secret'], $result['match_id']);
        }
        return null;
    }

    public function getTeams(){
        $sql = "SELECT * FROM teams";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $teams = array();
        foreach($result as $row){
            array_push($teams, new Team($row['id'], $row['name'], $row['secret'], $row['match_id']));
        }
        return $teams;
    }

    public function getTeamsByMatchId($matchId){
        $sql = "SELECT * FROM teams WHERE match_id = :match_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':match_id', $matchId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $teams = array();
        foreach($result as $row){
            array_push($teams, new Team($row['id'], $row['name'], $row['secret'], $row['match_id']));
        }
        return $teams;
    }

    public function deleteTeam($id){
        $sql = "DELETE FROM teams WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getTeamBySecret($secret){
        $sql = "SELECT * FROM teams WHERE secret = :secret LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':secret', $secret);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo($result['id']); 
        return $result['id'];        
    }

    public function count($option){
        //NOT SQL INJECTION SAFE
        $sql = "SELECT COUNT(".$option.") FROM teams";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = $result["COUNT(".$option.")"];
        return $result;
    }
}

?>