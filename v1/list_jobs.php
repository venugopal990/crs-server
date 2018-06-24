<?php
    require_once '../db/db_functions.php';

    $db = new DBFunctions();

    $companyId = isset($_GET['companyId']) ? $_GET['companyId'] : NULL;

    $jobs = NULL;
    
    if($companyId != NULL){
        $jobs = $db->getAllJobsByCompany($companyId);
    }else{
        $jobs = $db->getAllJobs();
    }

    $res = array();
    while ($job = $jobs->fetch_assoc())
    {
        $tmp = array();
        $tmp['title'] = $job['title'];
        $tmp['code'] = $job['code'];
        $tmp['skills'] = $job['skills'];
        $tmp['companyId'] = $job['companyId'];
        array_push($res, $tmp);
    }

    header('Content-Type: application/json');
    echo json_encode($res);
?>