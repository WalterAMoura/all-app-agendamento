<?php
#Caminhos absolutos
$dirInt="api/v1/app-agenda/";

define('DIRPAGE', "https://{$_SERVER['HTTP_HOST']}/{$dirInt}");
$bar=(substr($_SERVER['DOCUMENT_ROOT'],-1)=='/')?"":"/";
define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$bar}{$dirInt}");

//echo DIRPAGE.'<br>'.DIRREQ;

#Banco de dados
define('HOST','localhost');
define('DB','agenda');
define('USER','agenda');
define('PASS','jXDBgfrR*cZiQ_Y-');
define("OPTIONS_PDO" , [
    "OPTIONS" => [
        PDO::MYSQL_ATTR_FOUND_ROWS => true,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);


#Incluir arquivos
include(DIRREQ.'lib/composer/vendor/autoload.php');