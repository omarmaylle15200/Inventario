
<?php

class VentaModel extends Model
{

    public $idVenta;
    public $idTipoDocumentoVenta;
    public $idCliente;
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
            $query = $this->query('SELECT * FROM venta');

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new VentaModel();
                $item->idVenta = $p['IdVenta'];
                $item->idTipoDocumentoVenta = $p['IdTipoDocumentoVenta'];
                $item->idCliente = $p['IdCliente'];
                $item->total = $p['Total'];
                $item->fechaRegistro = $p['FechaRegistro'];
                $item->fechaModificacion = $p['FechaModificacion'];
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
            $query = $this->prepare('call sp_registrarVenta(?,?,?,?,?,?,?,?,?)');
            $query->bindParam(1, $venta->codigo, PDO::PARAM_STR);
            $query->bindParam(2, $venta->nombre, PDO::PARAM_STR);
            $query->bindParam(3, $venta->descripcion, PDO::PARAM_STR);
            $query->bindParam(4, $venta->precioCompra, PDO::PARAM_STR);
            $query->bindParam(5, $venta->precioVenta, PDO::PARAM_STR);
            $query->bindParam(6, $venta->cantidad, PDO::PARAM_INT);
            $query->bindParam(7, $venta->idCategoria, PDO::PARAM_INT);
            $query->bindParam(8, $venta->idProveedor, PDO::PARAM_INT);
            $query->bindParam(9, $venta->idUsuarioRegistro, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }
}

?>