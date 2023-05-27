<?php

class View{
    public $d;
    public $errorMessage;
    function __construct(){
    }

    function render($nombre, $data = []){
        $this->d = $data;     
        require 'views/' . $nombre . '.php';
    }

}

?>