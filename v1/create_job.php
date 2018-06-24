<?php
    require_once '../db/db_functions.php';

    $db = new DBFunctions();
    
    // reading POST params
    $title = isset($_POST['title']) ? $_POST['title'] : NULL;
    $companyId = isset($_POST['companyId']) ? $_POST['companyId'] : NULL;
    $skills = isset($_POST['skills']) ? $_POST['skills'] : NULL;

    // generating job code
    $jobCode = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 10)), 0, 10);

    $job = $db->insertJob($title, $jobCode, $companyId, $skills);

    $res = array();

    if($job != NULL){
        $res['jobCode'] = $job['code'];
        $res['title'] = $job['title'];
        $res['skills'] = $job['skills'];
        $res['companyId'] = $job['companyId'];
    }else{
        $res['error'] = true;
        $res['message'] = 'Couldn\'t create new job!';
    }

    header('Content-Type: application/json');
    echo json_encode($res);
?>