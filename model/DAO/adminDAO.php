<?php

require_once 'model/DAO/classes/connection.php';
require_once 'model/DAO/classes/admin.php';
require_once 'model/DAO/classes/logger.php';

class AdminDAO {
    private $connection;
    private $logger;
    
    public function __construct(){
        $this->connection = Connection::getConnection();
        $this->logger = Logger::getInstance();
    }

    public function getAdmin($username, $password){
        $sql = "SELECT * FROM admin WHERE name = ? LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->logger->info("params: { username: '$username' } -> LOGIN REQUEST" );
        if($result){
            if(password_verify($password, $result['password'])){
                $this->logger->info("params: { username: '$username' } -> LOGIN SUCCESSFUL" );
                return new Admin($result['id'], $result['name'], $result['password'], true);
            }
        }
        $this->logger->info("params: { username: '$username' } -> LOGIN FAILED" );
        return null;
    }

    public function login($username, $password){
        $admin = $this->getAdmin($username, $password);
        if($admin){
            $_SESSION['admin'] = $admin;
            return true;
        }
        return false;
    }
}

?>
