<?php

namespace Controllers;

use MVC\Router;

class FechaVotacionController
{
    public static function index(Router $router)
    {

        $router->render('fechavotacion/index', []);
    }

    public static function actualizar(Router $router)
    {

        $router->render('fechavotacion/actualizar', []);
    }
}
