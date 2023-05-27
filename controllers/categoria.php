
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
        $lstCategorias=[];
        try {
            $categoriaModel = new CategoriaModel();
            $categorias = $categoriaModel->obtenerTodos();

            foreach ($categorias as $categoria) {
                $categoriaDto=new CategoriaDto();
                $categoriaDto->idCategoria=$categoria->idCategoria;
                $categoriaDto->codigo=$categoria->codigo;
                $categoriaDto->nombre=$categoria->nombre;
                $categoriaDto->descripcion=$categoria->descripcion;
                $categoriaDto->esActivo=$categoria->esActivo;
                array_push($lstCategorias,$categoriaDto);
            }
            
        } catch (Exception $e) {
            
        }
        echo json_encode($lstCategorias);
        return;
    }
}

?>