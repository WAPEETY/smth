<?php

class AdminDAO {
    private $connection;
    
    public function __construct(){
        $this->connection = new Connection();
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