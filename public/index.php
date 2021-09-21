<?php
//autoload
require_once __DIR__ . '/../include/app.php';

use MVC\Router;
use Controllers\IndexController;
use Controllers\LoginController;
use Controllers\DashboardController;

$router = new Router();
//VOTO
$router->get('/', [IndexController::class, "index"]);

// pasamos la url y la funcion al ROUTER
$router->get('/slogin', [LoginController::class, "index"]);
$router->post('/slogin', [LoginController::class, "login"]);
$router->get('/logout', [LoginController::class, "logout"]);

//DASHBOARD
$router->get('/dashboard', [DashboardController::class, "index"]);




//lamando el metodo de ruter
$router->comprobarRutas();
