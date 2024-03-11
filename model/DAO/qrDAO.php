<?php

$server_root = $_SERVER['DOCUMENT_ROOT'];

require_once $server_root . '/model/DAO/classes/connection.php';
require_once $server_root . '/model/DAO/classes/qr.php';

class QrDAO
{
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getConnection();
    }

    public function createQr($qr){
        $sql = "INSERT INTO qrs (uuid, friendly_name, match_id) VALUES (:uuid, :friendlyName, :match_id)";
        $stmt = $this->connection->prepare($sql);

        $qr->setUuid(htmlspecialchars($qr->getUuid()));
        $qr->setFriendlyName(htmlspecialchars($qr->getFriendlyName()));

        $uuid = $qr->getUuid();
        $friendlyName = $qr->getFriendlyName();
        $match_id = $qr->getMatchId();

        $stmt->bindParam(':uuid', $uuid);
        $stmt->bindParam(':friendlyName', $friendlyName);
        $stmt->bindParam(':match_id', $match_id);
        $stmt->execute();
    }

    public function getQr($id){
        $sql = "SELECT * FROM qr WHERE id = :id LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return new Qr($result['id'], $result['uuid'], $result['friendlyName'], $result['match_id']);
        }
        return null;
    }

    public function getQrsByMatchId($matchId){
        $sql = "SELECT * FROM qrs WHERE match_id = :match_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':match_id', $matchId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $qrs = array();
        foreach($result as $row){
            array_push($qrs, new Qr($row['id'], $row['uuid'], $row['friendly_name'], $row['match_id']));
        }
        return $qrs;
    }

    public function getIdByUuid($uuid){
        $sql = "SELECT id FROM qrs WHERE uuid = :uuid LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':uuid', $uuid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result['id'];
        }
        return null;
    }

    public function generateUuid(){
        return substr(md5(uniqid(rand(), true)), 0, 23);
    }

    public function getAvailableTeams($qr_id){
        $sql = "SELECT * FROM teams WHERE id NOT IN (SELECT team_id FROM questions WHERE qr_id = :qr_id) AND match_id = (SELECT match_id FROM qrs WHERE id = :qr_id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':qr_id', $qr_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $teams = array();
        foreach($result as $row){
            array_push($teams, new Team($row['id'], $row['name'], $row['secret'], $row['match_id']));
        }
        return $teams;
    }
}


?>