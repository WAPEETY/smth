<?php
/*
id	int	NO	PRI	NULL	auto_increment	
uuid	varchar(23)	NO	UNI	NULL	
*/

class Qr {
    private $id;
    private $uuid;
    
    public function __construct($id, $uuid){
        $this->id = $id;
        $this->uuid = $uuid;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getUuid(){
        return $this->uuid;
    }
}

?>