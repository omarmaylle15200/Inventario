
<?php

class ProductoModel extends Model
{

    public $idProducto;
    public $codigo;
    public $nombre;
    public $descripcion;
    public $precioCompra;
    public $precioVenta;
    public $cantidad;
    public $idCategoria;
    public $idProveedor;
    public $esActivo;

    public function __construct()
    {
        parent::__construct();
    }

    public function obtenerTodos()
    {
        $items = [];

        try {
            $query = $this->query('SELECT * FROM producto');

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new ProductoModel();
                $item->idProducto = $p['IdProducto'];
                $item->codigo = $p['Codigo'];
                $item->nombre = $p['Nombre'];
                $item->descripcion = $p['Descripcion'];
                $item->precioCompra = $p['PrecioCompra'];
                $item->precioVenta = $p['PrecioVenta'];
                $item->cantidad = $p['Cantidad'];
                $item->idCategoria = $p['IdCategoria'];
                $item->idProveedor = $p['IdProveedor'];
                $item->esActivo = $p['EsActivo'];
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerPorId($idProducto)
    {
        $items = [];
        try {
            $query = $this->prepare('SELECT * FROM producto WHERE idProducto = :idProducto');
            $query->execute(['idProducto' => $idProducto]);
            $producto = $query->fetch(PDO::FETCH_ASSOC);

            $this->idProducto = $producto['IdProducto'];
            $this->codigo = $producto['Codigo'];
            $this->nombre = $producto['Nombre'];
            $this->descripcion = $producto['Descripcion'];
            $this->precioCompra = $producto['PrecioCompra'];
            $this->precioVenta = $producto['PrecioVenta'];
            $this->cantidad = $producto['Cantidad'];
            $this->idCategoria = $producto['IdCategoria'];
            $this->idProveedor = $producto['IdProveedor'];
            $this->esActivo = $producto['EsActivo'];

            return $this;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function obtenerPorCodigo($codigoProducto)
    {
        $items = [];
        try {
            $query = $this->prepare('SELECT * FROM producto WHERE codigo = :codigoProducto');
            $query->execute(['codigoProducto' => $codigoProducto]);
            $producto = $query->fetch(PDO::FETCH_ASSOC);

            $this->idProducto = $producto['IdProducto'];
            $this->codigo = $producto['Codigo'];
            $this->nombre = $producto['Nombre'];
            $this->descripcion = $producto['Descripcion'];
            $this->precioCompra = $producto['PrecioCompra'];
            $this->precioVenta = $producto['PrecioVenta'];
            $this->cantidad = $producto['Cantidad'];
            $this->idCategoria = $producto['IdCategoria'];
            $this->idProveedor = $producto['IdProveedor'];
            $this->esActivo = $producto['EsActivo'];

            return $this;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function obtenerActivos()
    {
        $items = [];
        try {
            $query = $this->query('SELECT * FROM producto WHERE EsActivo=1');

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new ProductoModel();
                $item->idProducto = $p['IdProducto'];
                $item->codigo = $p['Codigo'];
                $item->nombre = $p['Nombre'];
                $item->descripcion = $p['Descripcion'];
                $item->precioCompra = $p['PrecioCompra'];
                $item->precioVenta = $p['PrecioVenta'];
                $item->cantidad = $p['Cantidad'];
                $item->idCategoria = $p['IdCategoria'];
                $item->idProveedor = $p['IdProveedor'];
                $item->esActivo = $p['EsActivo'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function obtenerPorValor($valor)
    {
        $items = [];

        try {
            $query = $this->prepare("SELECT * FROM producto where (codigo like ? or nombre like ?) and EsActivo=1");
            $query->execute(array("%$valor%", "%$valor%"));

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new ProductoModel();
                $item->idProducto = $p['IdProducto'];
                $item->codigo = $p['Codigo'];
                $item->nombre = $p['Nombre'];
                $item->descripcion = $p['Descripcion'];
                $item->precioCompra = $p['PrecioCompra'];
                $item->precioVenta = $p['PrecioVenta'];
                $item->cantidad = $p['Cantidad'];
                $item->idCategoria = $p['IdCategoria'];
                $item->idProveedor = $p['IdProveedor'];
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function registrar($producto)
    {
        try {
            $query = $this->prepare('call sp_registrarProducto(?,?,?,?,?,?,?,?,?)');
            $query->bindParam(1, $producto->codigo, PDO::PARAM_STR);
            $query->bindParam(2, $producto->nombre, PDO::PARAM_STR);
            $query->bindParam(3, $producto->descripcion, PDO::PARAM_STR);
            $query->bindParam(4, $producto->precioCompra, PDO::PARAM_STR);
            $query->bindParam(5, $producto->precioVenta, PDO::PARAM_STR);
            $query->bindParam(6, $producto->cantidad, PDO::PARAM_INT);
            $query->bindParam(7, $producto->idCategoria, PDO::PARAM_INT);
            $query->bindParam(8, $producto->idProveedor, PDO::PARAM_INT);
            $query->bindParam(9, $producto->idUsuarioRegistro, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function actualizar($producto)
    {
        try {
            $query = $this->prepare('call sp_modificarProducto(?,?,?,?,?,?,?,?,?,?,?)');
            $query->bindParam(1, $producto->idProducto, PDO::PARAM_INT);
            $query->bindParam(2, $producto->codigo, PDO::PARAM_STR);
            $query->bindParam(3, $producto->nombre, PDO::PARAM_STR);
            $query->bindParam(4, $producto->descripcion, PDO::PARAM_STR);
            $query->bindParam(5, $producto->precioCompra, PDO::PARAM_STR);
            $query->bindParam(6, $producto->precioVenta, PDO::PARAM_STR);
            $query->bindParam(7, $producto->cantidad, PDO::PARAM_INT);
            $query->bindParam(8, $producto->idCategoria, PDO::PARAM_INT);
            $query->bindParam(9, $producto->idProveedor, PDO::PARAM_INT);
            $query->bindParam(10, $producto->esActivo, PDO::PARAM_BOOL);
            $query->bindParam(11, $producto->idUsuarioModificacion, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function existe($codigo, $idProducto)
    {
        try {
            $query = $this->prepare("SELECT idProducto FROM producto WHERE codigo = :codigo and idProducto<>:idProducto");
            $query->execute(['codigo' => $codigo, 'idProducto' => $idProducto]);

            if ($query->rowCount() > 0) return true;
            return false;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}

?>