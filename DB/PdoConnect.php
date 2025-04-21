<?php  

class PdoConnect {
    private $conn;
    public function __construct(
        private $host,
        private $dbname,
        private $username,
        private $password,
    ) {
        try {

            $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username , $password,[
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
            ]); 
        }
        catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
