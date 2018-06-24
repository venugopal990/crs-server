<?php
class DBFunctions{

    private $conn;

    function __construct() {
        require_once 'db_connect.php';
        // connecting to database
        $db = new DBConnect();
        $this->conn = $db->connect();
    }

    function register($name, $email, $rollNo, $collegeId){
        $query = 'INSERT INTO users(name, email, rollNumber, collegeId) VALUES(?, ?, ?, ?)';

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $name, $email, $rollNo, $collegeId);

        if($result = $stmt->execute()){
            // check for successful store
            if ($result) {
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $user = $stmt->get_result()->fetch_assoc();
                //$stmt->close();
    
                return $user;
            } else {
                return NULL;
            }
        }else{
            return NULL;
        }
 
        

    }
}
?>