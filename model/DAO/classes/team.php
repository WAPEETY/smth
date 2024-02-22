<?php

//id, name, secret, match_id

class Team {
    private $id;
    private $name;
    private $secret;
    private $match_id;

    public function __construct($id, $name, $secret, $match_id){
        $this->id = $id;
        $this->name = $name;
        $this->secret = $secret;
        $this->match_id = $match_id;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getSecret(){
        return $this->secret;
    }

    public function getMatchId(){
        return $this->match_id;
    }
}

?>