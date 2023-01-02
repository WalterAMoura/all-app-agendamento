<?php

namespace Models;

use PDO;
use PDOException;

abstract class ModelConnect
{
    protected function connectDB(){
        try {
            $conn = new PDO("mysql:host=".HOST.";dbname=".DB,USER,PASS,OPTIONS_PDO['OPTIONS']);
            return $conn;
        }catch (PDOException $error){
            return $error->getMessage();
        }
    }
}