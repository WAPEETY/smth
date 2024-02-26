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
        $sql = "INSERT INTO qr (uuid, friendlyName, match_id) VALUES (:uuid, :friendlyName, :match_id)";
        $stmt = $this->connection->prepare($sql);

        $qr->setUuid(htmlspecialchars($qr->getUuid()));
        $qr->setFriendlyName(htmlspecialchars($qr->getFriendlyName()));

        $uuid = $qr->getUuid();
        $friendlyName = $qr->getFriendlyName();

        $stmt->bindParam(':uuid', $uuid);
        $stmt->bindParam(':friendlyName', $friendlyName);
        $stmt->bindParam(':match_id', $qr->getMatchId());
        $stmt->execute();
    }
}

?>