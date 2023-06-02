<?php

include_once 'libs/imodel.php';

class Model{
    public $db;
    function __construct(){
        $this->db = new Database();
    }

    function query($query){
        return $this->db->connect()->query($query);
    }

    function prepare($query){
        return $this->db->connect()->prepare($query);
    }
    function beginTransaction(){
        return $this->db->connect()->beginTransaction();
    }
    function commit(){
        return $this->db->connect()->commit();
    }
    function rollback(){
        return $this->db->connect()->rollback();
    }
}

?>