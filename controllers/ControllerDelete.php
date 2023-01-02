<?php
include("../config/config.php");
$objEvents = new \Classes\ClassEvents();

//var_dump($_POST);

$id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);
//echo $id;
$ret=$objEvents->deleteEvent($id);

if($ret >0){
    http_response_code(200);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array("success"=>true));
}else{
    http_response_code(404);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array("success"=>false));
}