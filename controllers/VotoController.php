<?php

namespace Controllers;

use MVC\Router;

class VotoController
{
    public static function index(Router $router)
    {
        $router->render('voto/index', []);
    }
}
