
<?php

class VentaDetalleModel extends Model
{

    public $idVentaDetalle;
    public $idVenta;
    public $item;
    public $idProducto;
    public $producto;
    public $cantidad;
    public $precio;
    public $subTotal;

    public function __construct()
    {
        parent::__construct();
    }
}

?>