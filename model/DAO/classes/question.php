<?php

/*

id	int	NO	PRI	NULL	auto_increment	
question	varchar(512)	NO		NULL		
answers	json	NO		NULL		
qr_id	int	NO	MUL	NULL		
team_id	int	NO	MUL	NULL		
hint	varchar(512)	NO		NULL		

*/

class Question {
    private $id;
    private $question;
    private $answers;
    private $qr_id;
    private $team_id;
    private $hint;
    
    public function __construct($id, $question, $answers, $qr_id, $team_id, $hint){
        $this->id = $id;
        $this->question = $question;
        $this->answers = $answers;
        $this->qr_id = $qr_id;
        $this->team_id = $team_id;
        $this->hint = $hint;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getQuestion(){
        return $this->question;
    }
    
    public function getAnswers(){
        return $this->answers;
    }
    
    public function getQrId(){
        return $this->qr_id;
    }
    
    public function getTeamId(){
        return $this->team_id;
    }
    
    public function getHint(){
        return $this->hint;
    }
}

?>