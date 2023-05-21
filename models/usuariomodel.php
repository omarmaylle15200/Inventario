<?php

class UsuarioModel extends Model
{

    private $idUsuario;
    private $idTipoDocumento;
    private $numeroDocumento;
    private $idPerfil;
    private $nombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $direccion;
    private $telefono;
    private $email;
    private $esActivo;

    public function __construct()
    {
        parent::__construct();

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
    }

    public function getAll()
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
    public function get($id)
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

}
