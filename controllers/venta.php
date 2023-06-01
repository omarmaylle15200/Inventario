
<?php

include_once 'dtos/respuestadto.php';
include_once 'dtos/ventadto.php';
include_once 'dtos/tipodocumentoventadto.php';

class Venta extends SessionController
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
        $this->view->render('venta/index');
    }

    function obtenerTodos()
    {
        $lstVenta = [];
        try {
            $ventaModel = new VentaModel();
            $ventas = $ventaModel->obtenerTodos();

            foreach ($ventas as $venta) {
                $ventaDto = new VentaDto();
                $ventaDto->idVenta = $venta->idVenta;
                $ventaDto->idTipoDocumentoVenta = $venta->idTipoDocumentoVenta;
                $ventaDto->idCliente = $venta->idCliente;
                $ventaDto->total = $venta->total;
                $ventaDto->fechaRegistro = $venta->fechaRegistro;
                $ventaDto->fechaModificacion = $venta->fechaModificacion;
                array_push($lstVenta, $ventaDto);
            }
        } catch (Exception $e) {
        }
        echo json_encode($lstVenta);
        return;
    }
    function obtenerPorId()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);
        $idVenta = $data["idVenta"];

        $ventaDto = null;
        try {
            $ventaModel = new VentaModel();
            $venta = $ventaModel->obtenerPorId($idVenta);

            $ventaDto = new VentaDto();
            $ventaDto->idVenta = $venta->idVenta;
            $ventaDto->idTipoDocumentoVenta = $venta->idTipoDocumentoVenta;
            $ventaDto->idCliente = $venta->idCliente;
            $ventaDto->total = $venta->total;
            $ventaDto->fechaRegistro = $venta->fechaRegistro;
            $ventaDto->fechaModificacion = $venta->fechaModificacion;
        } catch (Exception $e) {
        }
        echo json_encode($ventaDto);
        return;
    }
    function registrar()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $venta = json_decode($content); //retorna objeto

        $respuesta = new RespuestaDto();

        try {
            $ventaModel = new VentaModel();
            $ventaModel->registrar($venta);

            $respuesta->status = true;
            $respuesta->message = "Registrado correctamente";
        } catch (Exception $e) {
            $respuesta->status = false;
            $respuesta->message = $e->getMessage();
        }
        echo json_encode($respuesta);
        return;
    }

    function obtenerTiposDocumentoVenta()
    {
        $lstTipoDocumentoVenta = [];
        try {
            $ventaModel = new TipoDocumentoVentaModel();
            $ventas = $ventaModel->obtenerActivos();

            foreach ($ventas as $venta) {
                $tipoDocumentoVentaDto = new TipoDocumentoVentaDto();
                $tipoDocumentoVentaDto->idTipoDocumentoVenta = $venta->idTipoDocumentoVenta;
                $tipoDocumentoVentaDto->descripcion = $venta->descripcion;
                array_push($lstTipoDocumentoVenta, $tipoDocumentoVentaDto);
            }
        } catch (Exception $e) {
        }
        echo json_encode($lstTipoDocumentoVenta);
        return;
    }
}

?>