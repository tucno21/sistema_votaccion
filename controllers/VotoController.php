<?php

namespace Controllers;

use MVC\Router;
use Model\Diseno;
use Model\Candidatos;

class VotoController
{
    public static function index(Router $router)
    {
        $candidatos = Candidatos::All();
        $colegio = Diseno::All();
        // debuguear($colegio[0]->name_ie);
        $router->render('voto/index', [
            'candidatos' => $candidatos,
            'colegio' => $colegio,
        ]);
    }

    public static function actualizar(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            debuguear($_POST["eligio"]);
        }
    }
}
