
<?php

include_once 'dtos/respuestadto.php';
include_once 'dtos/ventadto.php';
include_once 'dtos/tipodocumentoventadto.php';
include_once 'dtos/clientedto.php';
include_once 'dtos/productodto.php';
include_once 'dtos/ventadetalledto.php';

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
    
    function nuevo()
    {
        $actual_link = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actual_link);
        $this->view->errorMessage = '';
        $this->view->render('venta/nuevo');
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
                $ventaDto->tipoDocumentoVenta=new TipoDocumentoVentaDto();
                $ventaDto->tipoDocumentoVenta->descripcion = $venta->tipoDocumentoVenta->descripcion;
                $ventaDto->idCliente=$venta->idCliente;
                $ventaDto->cliente=new ClienteDto();
                $ventaDto->cliente->numeroDocumento= $venta->cliente->numeroDocumento;
                $ventaDto->cliente->nombre= $venta->cliente->nombre;
                $ventaDto->total = $venta->total;
                $ventaDto->fechaRegistro = $venta->fechaRegistro;
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
    function obtenerVentaDetalle()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);
        $idVenta = $data["idVenta"];

        $lstVentaDetalle = [];
        try {
            $ventaModel = new VentaModel();
            $ventasDetalle = $ventaModel->obtenerVentaDetalle($idVenta);

            foreach ($ventasDetalle as $ventaDetalle) {
                $ventaDetalleDto = new VentaDetalleDto();
                $ventaDetalleDto->idVenta = $ventaDetalle->idVenta;
                $ventaDetalleDto->idVentaDetalle = $ventaDetalle->idVentaDetalle;
                $ventaDetalleDto->item = $ventaDetalle->item;
                $ventaDetalleDto->idProducto = $ventaDetalle->idProducto;
                $ventaDetalleDto->producto = new ProductoModel();
                $ventaDetalleDto->producto->codigo =$ventaDetalle->producto->codigo;
                $ventaDetalleDto->producto->descripcion = $ventaDetalle->producto->descripcion;
                $ventaDetalleDto->cantidad =  $ventaDetalle->cantidad ;
                $ventaDetalleDto->precio = $ventaDetalle->precio;
                $ventaDetalleDto->subTotal = $ventaDetalle->subTotal;
                array_push($lstVentaDetalle, $ventaDetalleDto);
            }
        } catch (Exception $e) {
        }
        echo json_encode($lstVentaDetalle);
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
            $idVenta=$ventaModel->registrar($venta);
            $venta->idVenta=$idVenta;
            $ventaModel->registrarDetalle($venta);

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