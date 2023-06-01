
<?php

class TipoDocumentoVentaModel extends Model
{

    public $idTipoDocumentoVenta;
    public $descripcion;

    public function __construct()
    {
        parent::__construct();
    }

    public function obtenerActivos()
    {
        $items = [];

        try {
            $query = $this->query('SELECT * FROM tipodocumentoventa where EsActivo=1');

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new TipoDocumentoVentaModel();
                $item->idTipoDocumentoVenta = $p['IdTipoDocumentoVenta'];
                $item->descripcion = $p['Descripcion'];
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            return false;
        }
    }

  
}

?>