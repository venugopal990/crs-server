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

    function companyRegister($name, $address, $code){
        $query = 'INSERT INTO companies(name, address, code) VALUES(?, ?, ?)';

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $name, $address, $code);

        if($result = $stmt->execute()){
            // check for successful store
            if ($result) {
                $stmt = $this->conn->prepare("SELECT * FROM  companies WHERE code = ?");
                $stmt->bind_param("s", $code);
                $stmt->execute();
                $cmp = $stmt->get_result()->fetch_assoc();
                //$stmt->close();
    
                return $cmp;
            } else {
                return NULL;
            }
        }else{
            return NULL;
        }
    }

    function insertJob($title, $code, $compamyId, $skills){
        $query = 'INSERT INTO jobs(title, code, companyId, skills) VALUES(?, ?, ?, ?)';

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssis", $title, $code, $compamyId, $skills);

        if($result = $stmt->execute()){
            // check for successful store
            if ($result) {
                $stmt = $this->conn->prepare("SELECT * FROM  jobs WHERE code = ?");
                $stmt->bind_param("s", $code);
                $stmt->execute();
                $cmp = $stmt->get_result()->fetch_assoc();
                //$stmt->close();
    
                return $cmp;
            } else {
                return NULL;
            }
        }else{
            return NULL;
        }
    }

    function getAllJobs(){
        $query = "SELECT * FROM jobs";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    function getAllJobsByCompany($companyId){
        $query = "SELECT * FROM jobs WHERE companyId = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $companyId);
        $stmt->execute();
        return $stmt->get_result();
    }

    function getCompany($code){
        $stmt = $this->conn->prepare("SELECT * FROM  companies WHERE code = ?");
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $cmp = $stmt->get_result()->fetch_assoc();

        return $cmp;
    }

    function getUser($email){
        $stmt = $this->conn->prepare("SELECT * FROM  users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        return $user;
    }
}
?>