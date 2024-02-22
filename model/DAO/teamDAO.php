<?php

require_once 'model/DAO/classes/connection.php';
require_once 'model/DAO/classes/team.php';

class TeamDAO {
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getConnection();
    }  

    public function createTeam($team){
        $sql = "INSERT INTO teams (name, secret, match_id) VALUES (:name, :secret, :match_id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':name', $team->getName());
        $stmt->bindParam(':secret', $team->getSecret());
        $stmt->bindParam(':match_id', $team->getMatchId());
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

    public function deleteTeam($id){
        $sql = "DELETE FROM teams WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

?>