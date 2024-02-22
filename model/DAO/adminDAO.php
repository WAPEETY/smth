<?php

require_once 'model/DAO/classes/connection.php';
require_once 'model/DAO/classes/admin.php';

class AdminDAO {
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getConnection();
    }  

    #maybe i'll remove this function, it's not necessary
    public function createAdmin($admin){
        $sql = "INSERT INTO admin (name, password) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);
        $admin->setPassword($admin->getPassword(), true); #encrypt password
        $stmt->bind_param('ss', $admin->getName(), $admin->getPassword());
        $stmt->execute();
        $stmt->close();
    }

    public function getAdmin($username, $password){
        $sql = "SELECT * FROM admin WHERE name = ? LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            if(password_verify($password, $result['password'])){
                return new Admin($result['id'], $result['name'], $result['password'], true);
            }
        }
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
