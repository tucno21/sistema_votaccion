<?php
//autoload
require_once __DIR__ . '/../include/app.php';

use MVC\Router;
use Controllers\VotoController;
use Controllers\LoginController;
use Controllers\DashboardController;
//llamando al controller


$router = new Router();
// pasamos la url y la funcion al ROUTER
$router->get('/', [LoginController::class, "login"]);
$router->post('/', [LoginController::class, "login"]);
$router->get('/logout', [LoginController::class, "logout"]);

//DASHBOARD
$router->get('/dashboard', [DashboardController::class, "index"]);
//VOTO
$router->get('/tuvoto', [VotoController::class, "index"]);

//lamando el metodo de ruter
$router->comprobarRutas();
