<?php

namespace Classes;

use Models\ModelConnect;

class ClassEvents extends ModelConnect
{
    #Trazer eventos do banco de dados
    public function getEvents()
    {
        $b=$this->connectDB()->prepare("SELECT * FROM events");
        $b->execute();
        $f=$b->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($f);
    }

    #Criação da consulta no banco
    public function createEvent($id=0,$title,$description,$color,$start,$end,$contato,$hinoInicial,$hinoFinal,$status,$orador)
    {
        $b=$this->connectDB()->prepare("INSERT INTO events VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $b->bindParam(1, $id, \PDO::PARAM_INT);
        $b->bindParam(2, $title, \PDO::PARAM_STR);
        $b->bindParam(3, $description, \PDO::PARAM_STR);
        $b->bindParam(4, $color, \PDO::PARAM_STR);
        $b->bindParam(5, $start, \PDO::PARAM_STR);
        $b->bindParam(6, $end, \PDO::PARAM_STR);
        $b->bindParam(7, $contato, \PDO::PARAM_STR);
        $b->bindParam(8, $hinoInicial, \PDO::PARAM_STR);
        $b->bindParam(9, $hinoFinal, \PDO::PARAM_STR);
        $b->bindParam(10, $status, \PDO::PARAM_STR);
        $b->bindParam(11, $orador, \PDO::PARAM_STR);
        $b->execute();
        return $b->rowCount();
    }


    #Buscar Eventos
    public function getEventById($id)
    {
        $b=$this->connectDB()->prepare("SELECT * FROM events WHERE id = ?");
        $b->bindParam(1, $id, \PDO::PARAM_INT);
        $b->execute();
        $f=$b->fetch(\PDO::FETCH_ASSOC);
        return $f;
    }

    #Update banco de dados
    public function updateEvent($id,$title,$description,$color,$start,$end,$contato,$hinoInicial,$hinoFinal,$status,$orador)
    {
        $b=$this->connectDB()->prepare("UPDATE events SET title=?,description=?,color=?,start=?,end=?,contato=?,hino_inicial=?,hino_final=?,status=?,orador=? WHERE id = ?");
        $b->bindParam(1, $title, \PDO::PARAM_STR);
        $b->bindParam(2, $description, \PDO::PARAM_STR);
        $b->bindParam(3, $color, \PDO::PARAM_STR);
        $b->bindParam(4, $start, \PDO::PARAM_STR);
        $b->bindParam(5, $end, \PDO::PARAM_STR);
        $b->bindParam(6, $contato, \PDO::PARAM_STR);
        $b->bindParam(7, $hinoInicial, \PDO::PARAM_STR);
        $b->bindParam(8, $hinoFinal, \PDO::PARAM_STR);
        $b->bindParam(9, $status, \PDO::PARAM_STR);
        $b->bindParam(10, $orador, \PDO::PARAM_STR);
        $b->bindParam(11, $id, \PDO::PARAM_INT);
        $b->execute();
        return $b->rowCount();

    }

    #Deletar evento banco de dados
    public function deleteEvent($id)
    {
        $b=$this->connectDB()->prepare("DELETE FROM events WHERE id = ?");
        $b->bindParam(1, $id, \PDO::PARAM_INT);
        $b->execute();
        return $b->rowCount();
    }

    # Atualização de data e hora, pelo arraste e dimensionamento
    public function updateDropEvent($id,$start,$end){
        $b=$this->connectDB()->prepare("UPDATE events SET start=?,end=? WHERE id = ?");
        $b->bindParam(1, $start, \PDO::PARAM_STR);
        $b->bindParam(2, $end, \PDO::PARAM_STR);
        $b->bindParam(3, $id, \PDO::PARAM_INT);
        $b->execute();
        return $b->rowCount();
    }
}