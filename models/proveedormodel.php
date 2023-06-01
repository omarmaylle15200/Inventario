
<?php

class ProveedorModel extends Model{

    public $idProveedor;
    public $idTipoDocumento;
    public $numeroDocumento;
    public $nombre;
    public $direccion;
    public $email;
    public $telefono;
    public $esActivo;

    public function __construct(){
        parent::__construct();
    }

    public function obtenerTodos(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM proveedor');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ProveedorModel();
                $item->idProveedor=$p['IdProveedor']; 
                $item->idTipoDocumento=$p['IdTipoDocumento']; 
                $item->numeroDocumento=$p['NumeroDocumento']; 
                $item->nombre=$p['Nombre']; 
                $item->direccion=$p['Direccion']; 
                $item->email=$p['Email']; 
                $item->telefono=$p['Telefono']; 
                $item->esActivo=$p['EsActivo']; 
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            return false;
        }
    }
    public function obtenerActivos(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM proveedor where esActivo=1');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ProveedorModel();
                $item->idProveedor=$p['IdProveedor']; 
                $item->numeroDocumento=$p['NumeroDocumento']; 
                $item->nombre=$p['Nombre']; 
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            return false;
        }
    }
    public function obtenerPorId($idProveedor){
        try{
            $query = $this->prepare('SELECT * FROM proveedor WHERE idProveedor = :idProveedor');
            $query->execute([ 'idProveedor' => $idProveedor]);
            $proveedor = $query->fetch(PDO::FETCH_ASSOC);

            $this->idProveedor=$proveedor['IdProveedor']; 
            $this->idTipoDocumento=$proveedor['IdTipoDocumento']; 
            $this->numeroDocumento=$proveedor['NumeroDocumento']; 
            $this->nombre=$proveedor['Nombre']; 
            $this->direccion=$proveedor['Direccion']; 
            $this->email=$proveedor['Email']; 
            $this->telefono=$proveedor['Telefono']; 
            $this->esActivo=$proveedor['EsActivo']; 

            return $this;
        }catch(PDOException $e){
            return false;
        }
    }
    public function registrar($proveedor){
        try{
            $query = $this->prepare('call sp_registrarProveedor(
                :v_numeroDocumento,
                :v_nombre,
                :v_direccion,
                :v_email,
                :v_telefono,
                :v_idUsuarioRegistro)');
            $query->bindParam(':v_numeroDocumento', $proveedor->numeroDocumento, PDO::PARAM_STR);
            $query->bindParam(':v_nombre', $proveedor->nombre, PDO::PARAM_STR);
            $query->bindParam(':v_direccion', $proveedor->direccion, PDO::PARAM_STR);
            $query->bindParam(':v_email', $proveedor->email, PDO::PARAM_STR);
            $query->bindParam(':v_telefono', $proveedor->telefono, PDO::PARAM_STR);
            $query->bindParam(':v_idUsuarioRegistro', $proveedor->idUsuarioRegistro, PDO::PARAM_INT);
            $query->execute();
        }catch(PDOException $e){
            throw $e;
        }
    }
    public function actualizar($proveedor){
        try{
            $query = $this->prepare('call sp_modificarProveedor(:v_idProveedor,
                :v_numeroDocumento,
                :v_nombre,
                :v_direccion,
                :v_email,
                :v_telefono,
                :v_esActivo,
                :v_idUsuarioModificacion)');
            $query->bindParam(':v_idProveedor',$proveedor->idProveedor, PDO::PARAM_INT);
            $query->bindParam(':v_numeroDocumento', $proveedor->numeroDocumento, PDO::PARAM_STR);
            $query->bindParam(':v_nombre', $proveedor->nombre, PDO::PARAM_STR);
            $query->bindParam(':v_direccion', $proveedor->direccion, PDO::PARAM_STR);
            $query->bindParam(':v_email', $proveedor->email, PDO::PARAM_STR);
            $query->bindParam(':v_telefono', $proveedor->telefono, PDO::PARAM_STR);
            $query->bindParam(':v_esActivo', $proveedor->esActivo, PDO::PARAM_BOOL);
            $query->bindParam(':v_idUsuarioModificacion', $proveedor->idUsuarioModificacion, PDO::PARAM_INT);
            $query->execute();
        }catch(PDOException $e){
            throw $e;
        }
    }

    public function existe($numeroDocumento,$idProveedor){
        try{
            $query = $this->prepare("SELECT idProveedor FROM proveedor WHERE numeroDocumento = :numeroDocumento and idProveedor<>:idProveedor");
            $query->execute( ['numeroDocumento' => $numeroDocumento,'idProveedor' => $idProveedor]);

            if($query->rowCount() > 0)return true;
            return false;
        }catch(PDOException $e){
            throw $e;
        }
    }

}

?>