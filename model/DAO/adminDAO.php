<?php

class AdminDAO {
    private $connection;
    
    public function __construct(){
        $this->connection = new Connection();
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
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();
        if($admin){
            if(password_verify($password, $admin['password'])){
                return new Admin($admin['id'], $admin['name'], $admin['password'], true);
            }
        }
        return null;
    }
}

?>