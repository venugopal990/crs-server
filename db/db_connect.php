<?php
class DBConnect {
    private $conn;
 
    // Connecting to database
    public function connect() {
        require_once '../config/config.php';
         
        // Connecting to mysql database
        $this->conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE) or die('Database Error!');
         
        // return database handler
        return $this->conn;
    }
}
?>