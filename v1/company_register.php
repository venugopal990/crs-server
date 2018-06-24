<?php
require_once '../db/db_functions.php';

$db = new DBFunctions();


$name = isset($_POST['name']) ? $_POST['name'] : NULL;
$address = isset($_POST['address']) ? $_POST['address'] : NULL;
$code = isset($_POST['code']) ? $_POST['code'] : NULL;

if($name == NULL || $address == NULL || $code == NULL){
    $res = array();
    $res['error'] = true;
    $res['message'] = 'Required parameters are missing!';
    header('Content-Type: application/json');
    echo json_encode($res);
    return;
}

$cmp = $db->getCompany($code);

if($cmp == NULL){
    $cmp = $db->companyRegister($name, $address, $code);

    $res = array();
    
    if($cmp != NULL){
        // preparing JSON
        $res['companyId'] = $cmp['companyId'];
        $res['name'] = $cmp['name'];
        $res['address'] = $cmp['address'];
        $res['code'] = $cmp['code'];
        
    }else{
        $res['error'] = true;
        $res['message'] = 'Couldn\'t register company';
    }
}else{
    // company already existed
    $res['companyId'] = $cmp['companyId'];
    $res['name'] = $cmp['name'];
    $res['address'] = $cmp['address'];
    $res['code'] = $cmp['code'];
}

header('Content-Type: application/json');
echo json_encode($res);
?>