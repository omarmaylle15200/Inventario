
<?php

include_once 'dtos/respuestadto.php';
include_once 'dtos/usuariodto.php';

class Main extends SessionController
{

    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $actual_link = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actual_link);
        $this->view->errorMessage = '';
        $this->view->render('main/index');
    }
}

?>