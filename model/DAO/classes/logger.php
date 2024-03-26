<?php

//a singleton class to log everything to the log table which is in the database with this schema:
// id 	int 	NO 	PRI 	NULL 	auto_increment
// message 	varchar(512) 	NO 		NULL 	
// time 	timestamp 	NO 		CURRENT_TIMESTAMP 	DEFAULT_GENERATED

require_once 'connection.php';

class Logger {
    private static $instance = null;
    private $db;
    private function __construct() {
        $c = new Connection();
        $this->db = $c->getConnection();
    }
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }
    private function log($message) {
        $sql = "INSERT INTO logs (message) VALUES (:message)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function prepend_header($type,$message,$trace) {
        $trace_length = count($trace);
        if($trace_length < 2){
            $file = $trace[0]['file'];
        } else{
            $file = $trace[1]['file'];
        }
        $message = "[$type] [ $file ]: $message";
        return $message;
    }

    public function info($message) {
        $trace = debug_backtrace();
        $str = $this->prepend_header("INFO",$message,$trace);
        $this->log($str);
    }

    public function error($message) {
        $trace = debug_backtrace();
        $str = $this->prepend_header("ERROR",$message,$trace);
        $this->log($str);
    }
}

?>