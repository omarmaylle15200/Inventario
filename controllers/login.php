
<?php

include_once 'dtos/respuestadto.php';

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

        $expense = new ExpensesModel();

        $respuesta=new RespuestaDto();
        $respuesta->status=false;
        $respuesta->message="HI";

        //validate data
        if (empty($numeroDocumento) || empty($clave)) {
            echo json_encode($respuesta);
            return ;
        }
        $respuesta->status=true;
        $respuesta->message="OK";
        echo json_encode($respuesta);

        return;
    }

    function saludo()
    {
    }
}

?>