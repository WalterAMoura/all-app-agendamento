<?php
include("../config/config.php");
$objEvents = new \Classes\ClassEvents();

//var_dump($_POST);
//var_dump(json_decode(file_get_contents('php://input')));
$headers=getallheaders();
$contentType = $headers['Content-Type'];

if($contentType == 'application/json'){
    $json = json_decode(file_get_contents('php://input'));
    $idEvent = $json->id;
    $start = new \DateTime($json->start, new \DateTimeZone('America/Sao_Paulo'));
    $end = new \DateTime($json->end, new \DateTimeZone('America/Sao_Paulo'));
}else{
    $idEvent =$_POST['id'];
    $start = new \DateTime($_POST['start'], new \DateTimeZone('America/Sao_Paulo'));
    $end = new \DateTime($_POST['end'], new \DateTimeZone('America/Sao_Paulo'));
}

$ret=$objEvents->updateDropEvent(
  $idEvent,
  $start->format("Y-m-d H:i:s"),
  $end->format("Y-m-d H:i:s")
);

if($ret >0){
    http_response_code(200);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array("success"=>true));
}else{
    http_response_code(404);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array("success"=>false));
}