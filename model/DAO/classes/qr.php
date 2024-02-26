<?php

class Qr {
    private $id;
    private $uuid;
    private $friendlyName;
    private $matchId;

    public function __construct($id, $uuid, $friendlyName, $matchId){
        $this->id = $id;
        $this->uuid = $uuid;
        $this->friendlyName = $friendlyName;
        $this->matchId = $matchId;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getUuid(){
        return $this->uuid;
    }

    public function getFriendlyName(){
        return $this->friendlyName;
    }

    public function getMatchId(){
        return $this->matchId;
    }

    public static function generateUuid(){
        return substr(md5(uniqid(rand(), true)), 0, 23);
    }

    public function setUuid($uuid){
        $this->uuid = $uuid;
    }

    public function setFriendlyName($friendlyName){
        $this->friendlyName = $friendlyName;
    }
}

?>