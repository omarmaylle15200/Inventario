
<?php

include_once 'dtos/respuestadto.php';
include_once 'dtos/productodto.php';

class Producto extends SessionController
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
        $this->view->render('producto/index');
    }

    function obtenerTodos()
    {
        $lstProducto = [];
        try {
            $productoModel = new ProductoModel();
            $productos = $productoModel->obtenerTodos();

            foreach ($productos as $producto) {
                $productoDto = new ProductoDto();
                $productoDto->idProducto = $producto->idProducto;
                $productoDto->codigo = $producto->codigo;
                $productoDto->nombre = $producto->nombre;
                $productoDto->descripcion = $producto->descripcion;
                $productoDto->precioCompra = $producto->precioCompra;
                $productoDto->precioVenta = $producto->precioVenta;
                $productoDto->cantidad = $producto->cantidad;
                $productoDto->idCategoria = $producto->idCategoria;
                $productoDto->idProducto = $producto->idProducto;
                $productoDto->esActivo = $producto->esActivo;
                array_push($lstProducto, $productoDto);
            }
        } catch (Exception $e) {
        }
        echo json_encode($lstProducto);
        return;
    }
    function obtenerPorId()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);
        $idProducto = $data["idProducto"];

        $productoDto = null;
        try {
            $productoModel = new ProductoModel();
            $producto = $productoModel->obtenerPorId($idProducto);

            $productoDto = new ProductoDto();
            $productoDto->idProducto = $producto->idProducto;
            $productoDto->codigo = $producto->codigo;
            $productoDto->nombre = $producto->nombre;
            $productoDto->descripcion = $producto->descripcion;
            $productoDto->precioCompra = $producto->precioCompra;
            $productoDto->precioVenta = $producto->precioVenta;
            $productoDto->cantidad = $producto->cantidad;
            $productoDto->idCategoria = $producto->idCategoria;
            $productoDto->idProducto = $producto->idProducto;
            $productoDto->esActivo = $producto->esActivo;
        } catch (Exception $e) {
        }
        echo json_encode($productoDto);
        return;
    }
    function obtenerPorCodigo()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);
        $codigoProducto = $data["codigoProducto"];

        $productoDto = null;
        try {
            $productoModel = new ProductoModel();
            $producto = $productoModel->obtenerPorCodigo($codigoProducto);

            $productoDto = new ProductoDto();
            $productoDto->idProducto = $producto->idProducto;
            $productoDto->codigo = $producto->codigo;
            $productoDto->nombre = $producto->nombre;
            $productoDto->descripcion = $producto->descripcion;
            $productoDto->precioCompra = $producto->precioCompra;
            $productoDto->precioVenta = $producto->precioVenta;
            $productoDto->cantidad = $producto->cantidad;
            $productoDto->idCategoria = $producto->idCategoria;
            $productoDto->idProducto = $producto->idProducto;
            $productoDto->esActivo = $producto->esActivo;
        } catch (Exception $e) {
        }
        echo json_encode($productoDto);
        return;
    }
    function obtenerActivos()
    {
        $lstProducto = [];
        try {
            $productoModel = new ProductoModel();
            $productos = $productoModel->obtenerActivos();

            foreach ($productos as $producto) {
                $productoDto = new ProductoDto();
                $productoDto->idProducto = $producto->idProducto;
                $productoDto->codigo = $producto->codigo;
                $productoDto->nombre = $producto->nombre;
                $productoDto->descripcion = $producto->descripcion;
                $productoDto->precioCompra = $producto->precioCompra;
                $productoDto->precioVenta = $producto->precioVenta;
                $productoDto->cantidad = $producto->cantidad;
                $productoDto->idCategoria = $producto->idCategoria;
                $productoDto->idProducto = $producto->idProducto;
                $productoDto->esActivo = $producto->esActivo;
                array_push($lstProducto, $productoDto);
            }
        } catch (Exception $e) {
        }
        echo json_encode($lstProducto);
        return;
    }
    function obtenerPorValor()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);
        $valor = $data["valor"];

        $lstProducto = [];
        try {
            $productoModel = new ProductoModel();
            $productos = $productoModel->obtenerPorValor($valor);

            foreach ($productos as $producto) {
                $productoDto = new ProductoDto();
                $productoDto->idProducto = $producto->idProducto;
                $productoDto->codigo = $producto->codigo;
                $productoDto->nombre = $producto->nombre;
                $productoDto->descripcion = $producto->descripcion;
                $productoDto->precioCompra = $producto->precioCompra;
                $productoDto->precioVenta = $producto->precioVenta;
                $productoDto->cantidad = $producto->cantidad;
                $productoDto->idCategoria = $producto->idCategoria;
                $productoDto->idProducto = $producto->idProducto;
                $productoDto->esActivo = $producto->esActivo;
                array_push($lstProducto, $productoDto);
            }
        } catch (Exception $e) {
        }
        echo json_encode($lstProducto);
        return;
    }
    function registrar()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $producto = json_decode($content); //retorna objeto

        $respuesta = new RespuestaDto();

        try {
            $productoModel = new ProductoModel();
            if ($productoModel->existe($producto->codigo,0)) {
                $respuesta->status = false;
                $respuesta->message = "Código producto ya existe";
                echo json_encode($respuesta);
                return;
            }
            $productoModel->registrar($producto);

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
        $producto = json_decode($content); //retorna objeto

        $respuesta = new RespuestaDto();

        try {
            $productoModel = new ProductoModel();
            if ($productoModel->existe($producto->codigo,$producto->idProducto)) {
                $respuesta->status = false;
                $respuesta->message = "Código producto ya existe";
                echo json_encode($respuesta);
                return;
            }
            $productoModel->actualizar($producto);

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