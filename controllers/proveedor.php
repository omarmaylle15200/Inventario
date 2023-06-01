
<?php

include_once 'dtos/respuestadto.php';
include_once 'dtos/proveedordto.php';

class Proveedor extends SessionController
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
        $this->view->render('proveedor/index');
    }

    function obtenerTodos()
    {
        $lstProveedor = [];
        try {
            $proveedorModel = new ProveedorModel();
            $proveedores = $proveedorModel->obtenerTodos();

            foreach ($proveedores as $proveedor) {
                $proveedorDto = new ProveedorDto();
                $proveedorDto->idProveedor = $proveedor->idProveedor;
                $proveedorDto->numeroDocumento = $proveedor->numeroDocumento;
                $proveedorDto->nombre = $proveedor->nombre;
                $proveedorDto->direccion = $proveedor->direccion;
                $proveedorDto->email = $proveedor->email;
                $proveedorDto->telefono = $proveedor->telefono;
                $proveedorDto->esActivo = $proveedor->esActivo;
                array_push($lstProveedor, $proveedorDto);
            }
        } catch (Exception $e) {
        }
        echo json_encode($lstProveedor);
        return;
    }
    function obtenerActivos()
    {
        $lstProveedor = [];
        try {
            $proveedorModel = new ProveedorModel();
            $proveedores = $proveedorModel->obtenerActivos();

            foreach ($proveedores as $proveedor) {
                $proveedorDto = new ProveedorDto();
                $proveedorDto->idProveedor = $proveedor->idProveedor;
                $proveedorDto->numeroDocumento = $proveedor->numeroDocumento;
                $proveedorDto->nombre = $proveedor->nombre;
                array_push($lstProveedor, $proveedorDto);
            }
        } catch (Exception $e) {
        }
        echo json_encode($lstProveedor);
        return;
    }
    function obtenerPorId()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);
        $idProveedor = $data["idProveedor"];

        $proveedorDto = null;
        try {
            $proveedorModel = new ProveedorModel();
            $proveedor = $proveedorModel->obtenerPorId($idProveedor);

            $proveedorDto = new ProveedorDto();
            $proveedorDto->idProveedor = $proveedor->idProveedor;
            $proveedorDto->numeroDocumento = $proveedor->numeroDocumento;
            $proveedorDto->nombre = $proveedor->nombre;
            $proveedorDto->direccion = $proveedor->direccion;
            $proveedorDto->email = $proveedor->email;
            $proveedorDto->telefono = $proveedor->telefono;
            $proveedorDto->esActivo = $proveedor->esActivo;
        } catch (Exception $e) {
        }
        echo json_encode($proveedorDto);
        return;
    }
    function registrar()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $proveedor = json_decode($content); //retorna objeto

        $respuesta = new RespuestaDto();

        try {
            $proveedorModel = new ProveedorModel();
            if ($proveedorModel->existe($proveedor->numeroDocumento,0)) {
                $respuesta->status = false;
                $respuesta->message = "RUC ya existe";
                echo json_encode($respuesta);
                return;
            }
            $proveedorModel->registrar($proveedor);

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
        $proveedor = json_decode($content); //retorna objeto

        $respuesta = new RespuestaDto();

        try {
            $proveedorModel = new ProveedorModel();
            if ($proveedorModel->existe($proveedor->numeroDocumento,$proveedor->idProveedor)) {
                $respuesta->status = false;
                $respuesta->message = "RUC ya existe";
                echo json_encode($respuesta);
                return;
            }
            $proveedorModel->actualizar($proveedor);

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