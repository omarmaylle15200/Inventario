
<?php

include_once 'dtos/respuestadto.php';
include_once 'dtos/categoriadto.php';

class Categoria extends SessionController
{

    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $actual_link = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actual_link);
        $this->view->errorMessage = '';
        $this->view->render('categoria/index');
    }

    function obtenerTodos()
    {
        $lstCategorias = [];
        try {
            $categoriaModel = new CategoriaModel();
            $categorias = $categoriaModel->obtenerTodos();

            foreach ($categorias as $categoria) {
                $categoriaDto = new CategoriaDto();
                $categoriaDto->idCategoria = $categoria->idCategoria;
                $categoriaDto->codigo = $categoria->codigo;
                $categoriaDto->nombre = $categoria->nombre;
                $categoriaDto->descripcion = $categoria->descripcion;
                $categoriaDto->esActivo = $categoria->esActivo;
                array_push($lstCategorias, $categoriaDto);
            }
        } catch (Exception $e) {
        }
        echo json_encode($lstCategorias);
        return;
    }
    function obtenerActivos()
    {
        $lstCategorias = [];
        try {
            $categoriaModel = new CategoriaModel();
            $categorias = $categoriaModel->obtenerActivos();

            foreach ($categorias as $categoria) {
                $categoriaDto = new CategoriaDto();
                $categoriaDto->idCategoria = $categoria->idCategoria;
                $categoriaDto->codigo = $categoria->codigo;
                $categoriaDto->nombre = $categoria->nombre;
                array_push($lstCategorias, $categoriaDto);
            }
        } catch (Exception $e) {
        }
        echo json_encode($lstCategorias);
        return;
    }
    function obtenerPorId()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);

        $idCategoria = $data["idCategoria"];

        $categoriaDto=null;
        try {
            $categoriaModel = new CategoriaModel();
            $categoria = $categoriaModel->obtenerPorId($idCategoria);

            $categoriaDto = new CategoriaDto();
            $categoriaDto->idCategoria = $categoria->idCategoria;
            $categoriaDto->codigo = $categoria->codigo;
            $categoriaDto->nombre = $categoria->nombre;
            $categoriaDto->descripcion = $categoria->descripcion;
            $categoriaDto->esActivo = $categoria->esActivo;

        } catch (Exception $e) {
            $categoriaDto=null;
        }
        echo json_encode($categoriaDto);
        return;
    }
    function registrar()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $categoria = json_decode($content);//retorna objeto
        //$categoria = json_decode($content,true);//retorna array
        $respuesta = new RespuestaDto();

        try {
            $categoriaModel = new CategoriaModel();
            $categoriaModel->registrar($categoria);

            $respuesta->status = true;
            $respuesta->message = "Registrado correctamente";
        } catch (Exception $e) {
            $respuesta->status = false;
            $respuesta->message =$e->getMessage();
        }
        echo json_encode($respuesta);
        return;
    }
    function modificar()
    {
        header('Content-Type: application/json');
        $content = trim(file_get_contents("php://input"));
        $categoria = json_decode($content);//retorna objeto
        //$categoria = json_decode($content,true);//retorna array
        $respuesta = new RespuestaDto();

        try {
            $categoriaModel = new CategoriaModel();
            $categoriaModel->actualizar($categoria);

            $respuesta->status = true;
            $respuesta->message = "Actualizado correctamente";
        } catch (Exception $e) {
            $respuesta->status = false;
            $respuesta->message =$e->getMessage();
        }
        echo json_encode($respuesta);
        return;
    }
}

?>