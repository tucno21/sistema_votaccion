<?php
//autoload
require_once __DIR__ . '/../include/app.php';

use MVC\Router;
use Controllers\AulaController;
use Controllers\UserController;
use Controllers\VotoController;
use Controllers\LoginController;
use Controllers\TurnoController;
use Controllers\CategoryController;
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
// //CRUD CATEGORIAS
$router->get('/categorias', [CategoryController::class, "index"]);
$router->get('/categorias/crear', [CategoryController::class, "crear"]);
$router->post('/categorias/crear', [CategoryController::class, "crear"]);
$router->get('/categorias/actualizar', [CategoryController::class, "actualizar"]);
$router->post('/categorias/actualizar', [CategoryController::class, "actualizar"]);
$router->get('/categorias/eliminar', [CategoryController::class, "eliminar"]);
// //CRUD USUARIOS
$router->get('/usuarios', [UserController::class, "index"]);
$router->get('/usuarios/crear', [UserController::class, "crear"]);
$router->post('/usuarios/crear', [UserController::class, "crear"]);
$router->get('/usuarios/actualizar', [UserController::class, "actualizar"]);
$router->post('/usuarios/actualizar', [UserController::class, "actualizar"]);
$router->get('/usuarios/eliminar', [UserController::class, "eliminar"]);
// //CRUD AULAS
$router->get('/aulas', [AulaController::class, "index"]);
$router->get('/aulas/crear', [AulaController::class, "crear"]);
$router->post('/aulas/crear', [AulaController::class, "crear"]);
$router->get('/aulas/actualizar', [AulaController::class, "actualizar"]);
$router->post('/aulas/actualizar', [AulaController::class, "actualizar"]);
$router->get('/aulas/eliminar', [AulaController::class, "eliminar"]);
// //CRUD TURNO
$router->get('/turno', [TurnoController::class, "index"]);
$router->get('/turno/crear', [TurnoController::class, "crear"]);
$router->post('/turno/crear', [TurnoController::class, "crear"]);
$router->get('/turno/actualizar', [TurnoController::class, "actualizar"]);
$router->post('/turno/actualizar', [TurnoController::class, "actualizar"]);
$router->get('/turno/eliminar', [TurnoController::class, "eliminar"]);

//lamando el metodo de ruter
$router->comprobarRutas();
