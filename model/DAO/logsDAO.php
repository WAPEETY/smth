<?php

require_once 'model/DAO/classes/connection.php';
require_once 'model/DAO/classes/logger.php';

class LogsDAO {
    private $connection;
    
    public static function getLastLogs($limit){
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM logs ORDER BY time DESC LIMIT :limit";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}