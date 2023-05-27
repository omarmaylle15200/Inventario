
<?php

include_once 'dtos/respuestadto.php';
include_once 'dtos/usuariodto.php';

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
        $respuesta = new RespuestaDto();

        $numeroDocumento = $data["numeroDocumento"];
        $clave = $data["clave"];

        //validate data
        if (empty($numeroDocumento) || empty($clave)) {
            $respuesta->status = false;
            $respuesta->message = "Completar campos";
            echo json_encode($respuesta);
            return;
        }

        try {
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->validar($numeroDocumento, $clave);

            $usuarioDto = new UsuarioDto();
            $usuarioDto->idUsuario = $usuario->idUsuario;
            $usuarioDto->nombre = $usuario->nombre;
            $usuarioDto->apellidoPaterno = $usuario->apellidoPaterno;
            $usuarioDto->apellidoMaterno = $usuario->apellidoMaterno;
            $usuarioDto->numeroDocumento = $usuario->numeroDocumento;
            $usuarioDto->email = $usuario->email;
            $usuarioDto->direccion = $usuario->direccion;

            $respuesta->status = true;
            $respuesta->message = "OK";
            $respuesta->detail=$usuarioDto;
        } catch (Exception $e) {
            $respuesta->status = false;
            $respuesta->message = $e->getMessage();
        }

        echo json_encode($respuesta);
        return;
    }

    function saludo()
    {
    }
}

?>