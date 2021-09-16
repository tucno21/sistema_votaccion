<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    //recibe las  rutas parametros de PUBLIC/INDEX
    public function get($url, $fn)
    {
        //almacena en rutasGET
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        //almacena en rutasGET
        $this->rutasPOST[$url] = $fn;
    }


    public function comprobarRutas()
    {
        //captura el nombre de la url
        $urlActual = $_SERVER["PATH_INFO"] ?? '/';

        //capturar el tipo de ruta get o post
        $metodo = $_SERVER["REQUEST_METHOD"];


        if ($metodo == "GET") {
            //almacenar la funcion asociada a la url de PUBLIC/INDEX
            $fn =  $this->rutasGET[$urlActual] ?? null;
        } else {
            // debuguear($_POST);
            $fn =  $this->rutasPOST[$urlActual] ?? null;
        }

        if ($fn) {
            //si la url existe con la funcion asociada

            //funcion de php para llamar una funcion cuando no sabemos como se llama la funcion
            //recibe el nombre de la funcion y busca la funcion el el controllador
            // lla a toda el contenido que tiene las dos variables debuguear($this);
            call_user_func($fn, $this);
        } else {
            //o manadar a la pagina 404
            echo "Pagina no existe";
        }

        // debuguear("");
    }

    //mostrar vistas desde el controllador
    public function render($view, $datos = [])
    {

        foreach ($datos as $key => $value) {
            //$$ es variable de variable //captura el nombre de la llave y lo convirte en variable para la vista
            $$key = $value;
        }

        //iniciar almacenamento en memoria la vistas
        ob_start();
        include __DIR__ . "/views/$view.php";
        //pasamos la vista al $contenido y luego se limpia de la memoria

        $contenidoLayout = ob_get_clean();

        //la variable $contenido pasa al loyout de VISTAS
        include __DIR__ . "/views/layout.php";
    }
}
