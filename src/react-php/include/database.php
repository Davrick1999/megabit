<?php 

class Database {
    private $serverName;
    private $username;
    private $password;
    private $dbName;

    protected function connectToDb() {
        $this->serverName = "localhost";
        $this->username = "davrick";
        $this->password = "davrick";
        $this->dbName = "react-php";


        $conn = new mysqli($this->serverName, $this->username, $this->password, $this->dbName);
        return $conn;
    }
}

?>