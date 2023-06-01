
<?php

class ClienteModel extends Model{

    public $idCliente;
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
            $query = $this->query('SELECT * FROM cliente');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ClienteModel();
                $item->idCliente=$p['IdCliente']; 
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
            $query = $this->query('SELECT * FROM cliente where esActivo=1');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ClienteModel();
                $item->idCliente=$p['IdCliente']; 
                $item->numeroDocumento=$p['NumeroDocumento']; 
                $item->nombre=$p['Nombre']; 
                $item->direccion=$p['Direccion']; 
                $item->email=$p['Email']; 
                $item->telefono=$p['Telefono']; 
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            return false;
        }
    }
    public function obtenerPorId($idCliente){
        try{
            $query = $this->prepare('SELECT * FROM cliente WHERE idCliente = :idCliente');
            $query->execute([ 'idCliente' => $idCliente]);
            $cliente = $query->fetch(PDO::FETCH_ASSOC);

            $this->idCliente=$cliente['IdCliente']; 
            $this->idTipoDocumento=$cliente['IdTipoDocumento']; 
            $this->numeroDocumento=$cliente['NumeroDocumento']; 
            $this->nombre=$cliente['Nombre']; 
            $this->direccion=$cliente['Direccion']; 
            $this->email=$cliente['Email']; 
            $this->telefono=$cliente['Telefono']; 
            $this->esActivo=$cliente['EsActivo']; 

            return $this;
        }catch(PDOException $e){
            return false;
        }
    }
    public function obtenerPorNumeroDocumento($numeroDocumento){
        try{
            $query = $this->prepare('SELECT * FROM cliente WHERE numeroDocumento = :numeroDocumento');
            $query->execute([ 'numeroDocumento' => $numeroDocumento]);
            $cliente = $query->fetch(PDO::FETCH_ASSOC);

            $this->idCliente=$cliente['IdCliente']; 
            $this->idTipoDocumento=$cliente['IdTipoDocumento']; 
            $this->numeroDocumento=$cliente['NumeroDocumento']; 
            $this->nombre=$cliente['Nombre']; 
            $this->direccion=$cliente['Direccion']; 
            $this->email=$cliente['Email']; 
            $this->telefono=$cliente['Telefono']; 
            $this->esActivo=$cliente['EsActivo']; 

            return $this;
        }catch(PDOException $e){
            return false;
        }
    }
    public function registrar($cliente){
        try{
            $query = $this->prepare('call sp_registrarCliente(
                :v_numeroDocumento,
                :v_nombre,
                :v_direccion,
                :v_email,
                :v_telefono,
                :v_idUsuarioRegistro)');
            $query->bindParam(':v_numeroDocumento', $cliente->numeroDocumento, PDO::PARAM_STR);
            $query->bindParam(':v_nombre', $cliente->nombre, PDO::PARAM_STR);
            $query->bindParam(':v_direccion', $cliente->direccion, PDO::PARAM_STR);
            $query->bindParam(':v_email', $cliente->email, PDO::PARAM_STR);
            $query->bindParam(':v_telefono', $cliente->telefono, PDO::PARAM_STR);
            $query->bindParam(':v_idUsuarioRegistro', $cliente->idUsuarioRegistro, PDO::PARAM_INT);
            $query->execute();
        }catch(PDOException $e){
            throw $e;
        }
    }
    public function actualizar($cliente){
        try{
            $query = $this->prepare('call sp_modificarCliente(:v_idCliente,
                :v_numeroDocumento,
                :v_nombre,
                :v_direccion,
                :v_email,
                :v_telefono,
                :v_esActivo,
                :v_idUsuarioModificacion)');
            $query->bindParam(':v_idCliente',$cliente->idCliente, PDO::PARAM_INT);
            $query->bindParam(':v_numeroDocumento', $cliente->numeroDocumento, PDO::PARAM_STR);
            $query->bindParam(':v_nombre', $cliente->nombre, PDO::PARAM_STR);
            $query->bindParam(':v_direccion', $cliente->direccion, PDO::PARAM_STR);
            $query->bindParam(':v_email', $cliente->email, PDO::PARAM_STR);
            $query->bindParam(':v_telefono', $cliente->telefono, PDO::PARAM_STR);
            $query->bindParam(':v_esActivo', $cliente->esActivo, PDO::PARAM_BOOL);
            $query->bindParam(':v_idUsuarioModificacion', $cliente->idUsuarioModificacion, PDO::PARAM_INT);
            $query->execute();
        }catch(PDOException $e){
            throw $e;
        }
    }

    public function existe($numeroDocumento,$idCliente){
        try{
            $query = $this->prepare("SELECT idCliente FROM cliente WHERE numeroDocumento = :numeroDocumento and idCliente<>:idCliente");
            $query->execute( ['numeroDocumento' => $numeroDocumento,'idCliente' => $idCliente]);

            if($query->rowCount() > 0)return true;
            return false;
        }catch(PDOException $e){
            throw $e;
        }
    }

}

?>