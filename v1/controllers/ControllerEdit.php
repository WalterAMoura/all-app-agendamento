<?php
include("../config/config.php");
$objEvents = new \Classes\ClassEvents();

//var_dump($_POST);
$headers=getallheaders();
$contentType = $headers['Content-Type'];

if($contentType == 'application/json'){
    $json = json_decode(file_get_contents('php://input'));
    $id=$json->id;
    $date=$json->date;
    $time=$json->time;
    $orador=$json->orador;
    $telefone=$json->telefone;
    $primeiroHino=$json->primeiroHino;
    $hinoFinal=$json->hinoFinal;
    $tema=$json->tema;
    $status=$json->status;
}else{
    $id=filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
    $date=filter_input(INPUT_POST, 'date', FILTER_DEFAULT);
    $time=filter_input(INPUT_POST, 'time', FILTER_DEFAULT);
    $orador=filter_input(INPUT_POST, 'orador', FILTER_DEFAULT);
    $telefone=filter_input(INPUT_POST, 'telefone', FILTER_DEFAULT);
    $primeiroHino=filter_input(INPUT_POST, 'primeiroHino', FILTER_DEFAULT);
    $hinoFinal=filter_input(INPUT_POST, 'hinoFinal', FILTER_DEFAULT);
    $tema=filter_input(INPUT_POST, 'tema', FILTER_DEFAULT);
    $status=filter_input(INPUT_POST, 'status', FILTER_DEFAULT);
}

$title = $orador.' - '.$tema;
$start = new DateTime($date.' '.$time, new \DateTimeZone('America/Sao_Paulo'));

if($status == 'CONFIRMADO'){
    $color='green';
}elseif ($status == 'PENDENTE_CONFIRMAR'){
    $color='yellow';
}elseif($status == 'AGENDADO'){
    $color='orange';
}

$ret=$objEvents->updateEvent(
    $id,
    $title,
    $tema,
    $color,
    $start->format("Y-m-d H:i:s"),
    $start->modify('+1 hours')->format("Y-m-d H:i:s"),
    $telefone,
    $primeiroHino,
    $hinoFinal,
    $status,
    $orador
);

if($ret >0){
    http_response_code(201);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array("success"=>true));
}else{
    http_response_code(404);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array("success"=>false));
}