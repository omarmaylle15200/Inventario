<?php

class UsuarioModel extends Model
{
    public $idUsuario;
    public $idTipoDocumento;
    public $numeroDocumento;
    public $idPerfil;
    public $nombre;
    public $apellidoPaterno;
    public $apellidoMaterno;
    public $direccion;
    public $telefono;
    public $email;
    public $esActivo;

    public function __construct()
    {
        parent::__construct();
    }

    public function obtenerTodos()
    {
        $items = [];

        try {
            $query = $this->query('SELECT * FROM users');

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new UserModel();
                $item->setId($p['id']);
                $item->setUsername($p['username']);
                $item->setPassword($p['password'], false);
                $item->setRole($p['role']);
                $item->setBudget($p['budget']);
                $item->setPhoto($p['photo']);
                $item->setName($p['name']);


                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    /**
     *  Gets an item
     */
    public function obtener($id)
    {
        try {
            $query = $this->prepare('SELECT * FROM users WHERE id = :id');
            $query->execute(['id' => $id]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            $this->idUsuario = 0;
            $this->idTipoDocumento = 0;
            $this->numeroDocumento = '';
            $this->idPerfil = 0;
            $this->nombre = '';
            $this->apellidoPaterno = '';
            $this->apellidoMaterno = '';
            $this->direccion = '';
            $this->telefono = '';
            $this->email = '';
            $this->esActivo = false;

            return $this;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function validar($numeroDocumento,$clave)
    {
        try {
            $query = $this->prepare('call sp_validarUsuario(:numeroDocumento,:clave)');
            $query->bindParam(':numeroDocumento', $numeroDocumento, PDO::PARAM_STR);
            $query->bindParam(':clave', $clave, PDO::PARAM_STR);
            $query->execute();
            $usuario = $query->fetch(PDO::FETCH_ASSOC);

            $this->idUsuario =$usuario['IdUsuario'];
            $this->idTipoDocumento = $usuario['IdTipoDocumento'];
            $this->numeroDocumento = $usuario['NumeroDocumento'];
            $this->idPerfil = $usuario['IdPerfil'];
            $this->nombre = $usuario['Nombre'];
            $this->apellidoPaterno = $usuario['ApellidoPaterno'];
            $this->apellidoMaterno = $usuario['ApellidoMaterno'];
            $this->direccion = $usuario['Direccion'];
            $this->telefono = $usuario['Telefono'];
            $this->email = $usuario['Email'];
            $this->esActivo = $usuario['EsActivo'];

            return $this;
        } catch (PDOException $e) {
            throw $e;
        }
    }


}
