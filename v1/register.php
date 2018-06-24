<?php
require_once '../db/db_functions.php';

$db = new DBFunctions();

// reading POST params
$name = isset($_POST['name']) ? $_POST['name'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$rollNumber = isset($_POST['rollNumber']) ? $_POST['rollNumber'] : NULL;
$collegeId = isset($_POST['collegeId']) ? $_POST['collegeId'] : NULL;

// checking for required params
if($name == NULL || $email == NULL || $rollNumber == NULL || $collegeId == NULL){
    $res = array();
    $res['error'] = true;
    $res['message'] = 'Required parameters are missing!';
    header('Content-Type: application/json');
    echo json_encode($res);
    return;
}

$user = $db->register($name, $email, $rollNumber, $collegeId);

$res = array();

if($user != NULL){
    // preparing JSON
    $res['name'] = $user['name'];
    $res['email'] = $user['email'];
    $res['rollNumber'] = $user['rollNumber'];
    $res['apiKey'] = '';
    $res['numberOfJobs'] = '';
    $res['collegeName'] = '';
    $res['branch'] = '';
    $res['profileImage'] = '';
}else{
    $res['error'] = true;
    $res['message'] = 'Couldn\'t register user';
}


header('Content-Type: application/json');
echo json_encode($res);
?>