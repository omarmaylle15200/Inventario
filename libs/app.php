<?php
require_once 'controllers/errores.php';

class App
{

    function __construct()
    {

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');

        $url = explode('/', $url);

        // cuando se ingresa sin definir controlador
        if (empty($url[0])) {
            $archivoController = 'controllers/login.php';
            require_once $archivoController;
            $controller = new Login();
            $controller->render();
            return false;
        }
        $archivoController = 'controllers/' . $url[0] . '.php';

        // si no hay controlador
        if (!file_exists($archivoController)) {
            $controller = new Errores();
            return;
        }

        require_once $archivoController;

        // inicializar controlador
        $controller = new $url[0];
        // si no hay un método que se requiere cargar
        if (!isset($url[1])) {
            $controller->render();
            return;
        }

        //Si no existe metodo
        if (!method_exists($controller, $url[1])) {
            $controller = new Errores();
            return;
        }

        //Si es un método si parametros
        if (!isset($url[2])) {
            $controller->{$url[1]}();
            return;
        } 

        //el método tiene parámetros
        //sacamos e # de parametros
        $nparam = sizeof($url) - 2;
        //crear un arreglo con los parametros
        $params = [];
        //iterar
        for ($i = 0; $i < $nparam; $i++) {
            array_push($params, $url[$i + 2]);
        }
        //pasarlos al metodo   
        $controller->{$url[1]}($params);

    }
}
