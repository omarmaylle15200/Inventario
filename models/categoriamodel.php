
<?php

class CategoriaModel extends Model{

    public $idCategoria;
    public $codigo;
    public $nombre;
    public $descripcion;
    public $esActivo;

    public function __construct(){
        parent::__construct();
    }

    public function guardar($nombre,$descripcion,$idUsuarioRegistro){
        try{
            $query = $this->prepare('call sp_registrarCategoria(:v_nombre,:v_descripcion,:v_idUsuarioRegistro)');
            $query->bindParam(':v_nombre', $nombre, PDO::PARAM_STR);
            $query->bindParam(':v_descripcion', $descripcion, PDO::PARAM_STR);
            $query->bindParam(':v_idUsuarioRegistro', $idUsuarioRegistro, PDO::PARAM_INT);
            $query->execute();
            if($query->rowCount()) return true;

            return false;
        }catch(PDOException $e){
            return false;
        }
    }
    public function obtenerTodos(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM categoria');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new CategoriaModel();
                $item->idCategoria=$p['IdCategoria']; 
                $item->codigo=$p['Codigo']; 
                $item->nombre=$p['Nombre']; 
                $item->descripcion=$p['Descripcion']; 
                $item->esActivo=$p['EsActivo']; 
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }
    
    public function obtener($idCategoria){
        try{
            $query = $this->prepare('SELECT * FROM categoria WHERE idCategoria = :idCategoria');
            $query->execute([ 'idCategoria' => $idCategoria]);
            $categoria = $query->fetch(PDO::FETCH_ASSOC);

            $this->idCategoria =$categoria['IdCategoria'];
            $this->codigo = $categoria['Codigo'];
            $this->nombre = $categoria['Nombre'];
            $this->descripcion = $categoria['Descripcion'];

            return $this;
        }catch(PDOException $e){
            return false;
        }
    }
    public function eliminar($idCategoria){
        try{
            $query = $this->db->connect()->prepare('DELETE FROM categoria WHERE idCategoria = :idCategoria');
            $query->execute([ 'idCategoria' => $idCategoria]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }
    public function actualizar(){
        try{
            $query = $this->prepare('call sp_modificarCategoria(:v_idCategoria,:v_nombre,:v_descripcion,:v_idUsuarioModificacion)');
            $query->bindParam(':v_idCategoria', $nombre, PDO::PARAM_INT);
            $query->bindParam(':v_nombre', $nombre, PDO::PARAM_STR);
            $query->bindParam(':v_descripcion', $descripcion, PDO::PARAM_STR);
            $query->bindParam(':v_idUsuarioModificacion', $idUsuarioRegistro, PDO::PARAM_INT);
            $query->execute();
            if($query->rowCount()) return true;

            return false;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function existe($name){
        try{
            $query = $this->prepare('SELECT name FROM categoria WHERE name = :name');
            $query->execute( ['name' => $name]);
            
            if($query->rowCount() > 0){
                error_log('CategoriesModel::exists() => true');
                return true;
            }else{
                error_log('CategoriesModel::exists() => false');
                return false;
            }
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    }

}

?>