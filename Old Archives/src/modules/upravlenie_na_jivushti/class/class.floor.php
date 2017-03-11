<?php

require_once "class.db.php";

class floor
{
    private $apps;
    //todo NOT_FINISHED

    public function setAppartments($a,$table) {
        $database = new Database();
        $database->query('INSERT INTO '.$table.' (etaj)');
        $row = $database->resultset();
    }
    public function findByID($id) {
        return $id;
    }



}




?>
