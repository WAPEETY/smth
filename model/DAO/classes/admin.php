<?php
/*
id	int	NO	PRI	NULL	auto_increment	
name	varchar(32)	NO	UNI	NULL		
password	varchar(60)	NO		NULL	
*/

class Admin {
    private $id;
    private $name;
    private $password;
    private $is_hashed = false;
    
    public function __construct($id, $name, $password, $is_hashed = false){
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->is_hashed = $is_hashed;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getPassword(){
        if($this->is_hashed){
            return $this->password;
        } else {
            return password_hash($this->password, PASSWORD_DEFAULT);
        }
    }

    public function setPassword($password, $hash = true){
        if($hash){
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $this->password = $password;
        }
    }
}

?>