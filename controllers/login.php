
<?php

class Login extends SessionController
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
        $this->view->render('login/index');
    }

    function authenticate()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);

        $numeroDocumento = $data["numeroDocumento"];
        $clave = $data["clave"];

        //validate data
        if (empty($numeroDocumento) || empty($clave)) {
            echo json_encode("Hi");
            return ;
        }

        echo json_encode($numeroDocumento);
        return;
    }

    function saludo()
    {
    }
}

?>