
<?php

class VentaModel extends Model
{

    public $idVenta;
    public $idTipoDocumentoVenta;
    public $tipoDocumentoVenta;
    public $idCliente;
    public $cliente;
    public $total;
    public $fechaRegistro;
    public $fechaModificacion;

    public function __construct()
    {
        parent::__construct();
    }

    public function obtenerTodos()
    {
        $items = [];

        try {
            $query = $this->prepare('call sp_obtenerVentas()');
            $query->execute();
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new VentaModel();
                $item->idVenta = $p['IdVenta'];
                $item->idTipoDocumentoVenta = $p['IdTipoDocumentoVenta'];
                $item->tipoDocumentoVenta = new TipoDocumentoVentaModel();
                $item->tipoDocumentoVenta->descripcion = $p['tipoDocumentoVenta'];
                $item->idCliente = $p['IdCliente'];
                $item->cliente = new ClienteModel();
                $item->cliente->numeroDocumento = $p['numeroDocumentoCliente'];
                $item->cliente->nombre = $p['nombreCliente'];
                $item->total = $p['Total'];
                $item->fechaRegistro = $p['FechaRegistro'];
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function obtenerVentaDetalle($idVenta)
    {
        $items = [];

        try {
            $query = $this->prepare('call sp_obtenerVentaDetalle(?)');
            $query->bindParam(1, $idVenta, PDO::PARAM_INT);
            $query->execute();
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new VentaDetalleModel();
                $item->idVenta = $p['IdVenta'];
                $item->idVentaDetalle = $p['IdVentaDetalle'];
                $item->item = $p['Item'];
                $item->idProducto = $p['IdProducto'];
                $item->producto = new ProductoModel();
                $item->producto->codigo =$p['codigoProducto'];
                $item->producto->descripcion = $p['descripcionProducto'];
                $item->cantidad = $p['cantidad'];
                $item->precio = $p['precio'];
                $item->subTotal = $p['subTotal'];
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerPorId($idVenta)
    {
        try {
            $query = $this->prepare('SELECT * FROM venta WHERE idVenta = :idVenta');
            $query->execute(['idVenta' => $idVenta]);
            $venta = $query->fetch(PDO::FETCH_ASSOC);

            $this->idVenta = $venta['IdVenta'];
            $this->idTipoDocumentoVenta = $venta['IdTipoDocumentoVenta'];
            $this->idCliente = $venta['IdCliente'];
            $this->total = $venta['Total'];
            $this->fechaRegistro = $venta['FechaRegistro'];
            $this->fechaModificacion = $venta['FechaModificacion'];

            return $this;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function registrar($venta)
    {
        try {
            $query = $this->prepare('call sp_registrarVenta(?,?,?,?,?)');
            $query->bindParam(1, $venta->idTipoDocumentoVenta, PDO::PARAM_INT);
            $query->bindParam(2, $venta->idCliente, PDO::PARAM_INT);
            $query->bindParam(3, $venta->total, PDO::PARAM_STR);
            $query->bindParam(4, $venta->idUsuarioRegistro, PDO::PARAM_INT);
            $query->bindParam(5, $idVenta, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
            $query->execute();

            $venta = $query->fetch(PDO::FETCH_ASSOC);
            $idVenta = $venta['IdVenta'];
        } catch (PDOException $e) {
            throw $e;
        }
        return $idVenta;
    }
    public function registrarDetalle($venta)
    {
        try {
            $query = $this->prepare("call sp_registrarVentaDetalle(?,?,?,?,?)");
            $item = 1;
            foreach ($venta->ventaDetalle as $producto) {
                $query->bindParam(1, $venta->idVenta, PDO::PARAM_INT);
                $query->bindParam(2, $item, PDO::PARAM_INT);
                $query->bindParam(3, $producto->idProducto, PDO::PARAM_STR);
                $query->bindParam(4, $producto->cantidad, PDO::PARAM_INT);
                $query->bindParam(5, $producto->precioVenta, PDO::PARAM_INT);
                $query->execute();
                $item++;
            }
        } catch (PDOException $e) {
            throw $e;
        }
    }
}

?>