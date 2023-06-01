
<?php

include_once 'dtos/respuestadto.php';
include_once 'dtos/clientedto.php';

class Cliente extends SessionController
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
        $this->view->render('cliente/index');
    }

    function obtenerTodos()
    {
        $lstCliente = [];
        try {
            $clienteModel = new ClienteModel();
            $clientees = $clienteModel->obtenerTodos();

            foreach ($clientees as $cliente) {
                $clienteDto = new ClienteDto();
                $clienteDto->idCliente = $cliente->idCliente;
                $clienteDto->numeroDocumento = $cliente->numeroDocumento;
                $clienteDto->nombre = $cliente->nombre;
                $clienteDto->direccion = $cliente->direccion;
                $clienteDto->email = $cliente->email;
                $clienteDto->telefono = $cliente->telefono;
                $clienteDto->esActivo = $cliente->esActivo;
                array_push($lstCliente, $clienteDto);
            }
        } catch (Exception $e) {
        }
        echo json_encode($lstCliente);
        return;
    }
    function obtenerActivos()
    {
        $lstCliente = [];
        try {
            $clienteModel = new ClienteModel();
            $clientees = $clienteModel->obtenerActivos();

            foreach ($clientees as $cliente) {
                $clienteDto = new ClienteDto();
                $clienteDto->idCliente = $cliente->idCliente;
                $clienteDto->numeroDocumento = $cliente->numeroDocumento;
                $clienteDto->nombre = $cliente->nombre;
                array_push($lstCliente, $clienteDto);
            }
        } catch (Exception $e) {
        }
        echo json_encode($lstCliente);
        return;
    }
    function obtenerPorId()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);
        $idCliente = $data["idCliente"];

        $clienteDto = null;
        try {
            $clienteModel = new ClienteModel();
            $cliente = $clienteModel->obtenerPorId($idCliente);

            $clienteDto = new ClienteDto();
            $clienteDto->idCliente = $cliente->idCliente;
            $clienteDto->numeroDocumento = $cliente->numeroDocumento;
            $clienteDto->nombre = $cliente->nombre;
            $clienteDto->direccion = $cliente->direccion;
            $clienteDto->email = $cliente->email;
            $clienteDto->telefono = $cliente->telefono;
            $clienteDto->esActivo = $cliente->esActivo;
        } catch (Exception $e) {
        }
        echo json_encode($clienteDto);
        return;
    }
    function obtenerPorNumeroDocumento()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);
        $numeroDocumento = $data["numeroDocumento"];

        $clienteDto = null;
        try {
            $clienteModel = new ClienteModel();
            $cliente = $clienteModel->obtenerPorNumeroDocumento($numeroDocumento);

            $clienteDto = new ClienteDto();
            $clienteDto->idCliente = $cliente->idCliente;
            $clienteDto->numeroDocumento = $cliente->numeroDocumento;
            $clienteDto->nombre = $cliente->nombre;
            $clienteDto->direccion = $cliente->direccion;
            $clienteDto->email = $cliente->email;
            $clienteDto->telefono = $cliente->telefono;
            $clienteDto->esActivo = $cliente->esActivo;
        } catch (Exception $e) {
        }
        echo json_encode($clienteDto);
        return;
    }
    function registrar()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $cliente = json_decode($content); //retorna objeto

        $respuesta = new RespuestaDto();

        try {
            $clienteModel = new ClienteModel();
            if ($clienteModel->existe($cliente->numeroDocumento,0)) {
                $respuesta->status = false;
                $respuesta->message = "RUC ya existe";
                echo json_encode($respuesta);
                return;
            }
            $clienteModel->registrar($cliente);

            $respuesta->status = true;
            $respuesta->message = "Registrado correctamente";
        } catch (Exception $e) {
            $respuesta->status = false;
            $respuesta->message = $e->getMessage();
        }
        echo json_encode($respuesta);
        return;
    }
    function modificar()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $cliente = json_decode($content); //retorna objeto

        $respuesta = new RespuestaDto();

        try {
            $clienteModel = new ClienteModel();
            if ($clienteModel->existe($cliente->numeroDocumento,$cliente->idCliente)) {
                $respuesta->status = false;
                $respuesta->message = "RUC ya existe";
                echo json_encode($respuesta);
                return;
            }
            $clienteModel->actualizar($cliente);

            $respuesta->status = true;
            $respuesta->message = "Actualizado correctamente";
        } catch (Exception $e) {
            $respuesta->status = false;
            $respuesta->message = $e->getMessage();
        }
        echo json_encode($respuesta);
        return;
    }
}

?>