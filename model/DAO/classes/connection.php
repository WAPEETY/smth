<?php

require_once 'config.php';

class Connection {

    const HOSTNAME = Config::HOSTNAME;
    const DB = Config::DB;
    const USER = Config::USER;
    const PASSWORD = Config::PASSWORD;

    private static $conn = null;

    public static function getConnection() {

        if(Config::DEBUG){
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        } else {
            error_reporting(0);
        }

        $dsn = "mysql:host=" . self::HOSTNAME . ";dbname=" . self::DB;

        if (self::$conn == null) {
            try {
                self::$conn = new PDO($dsn, self::USER, self::PASSWORD);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if(self::$conn){
                    //echo "Successfully connected:<br>" . PHP_EOL;
                }
            } catch (PDOException $e) {
                //echo "Connection failed: " . $e->getMessage() . "<br>" . PHP_EOL;
                throw $e;
            }
        }
        return self::$conn;
    }

}

?>
