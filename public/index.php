<?php
//autoload
require_once __DIR__ . '/../include/app.php';

use MVC\Router;
use Controllers\UserController;
use Controllers\LoginController;
use Controllers\StudentController;
use Controllers\CandidatoController;
use Controllers\DashboardController;

$router = new Router();

// pasamos la url y la funcion al ROUTER
$router->get('/', [LoginController::class, "login"]);
$router->post('/', [LoginController::class, "login"]);
$router->get('/logout', [LoginController::class, "logout"]);

//DASHBOARD
$router->get('/dashboard', [DashboardController::class, "index"]);

// //CRUD USUARIOS
$router->get('/usuarios', [UserController::class, "index"]);
$router->get('/usuarios/crear', [UserController::class, "crear"]);
$router->post('/usuarios/crear', [UserController::class, "crear"]);
$router->get('/usuarios/actualizar', [UserController::class, "actualizar"]);
$router->post('/usuarios/actualizar', [UserController::class, "actualizar"]);
$router->get('/usuarios/eliminar', [UserController::class, "eliminar"]);

// //CRUD ESTUDIANTES
$router->get('/estudiantes', [StudentController::class, "index"]);
$router->get('/estudiantes/crear', [StudentController::class, "crear"]);
$router->post('/estudiantes/crear', [StudentController::class, "crear"]);
$router->get('/estudiantes/actualizar', [StudentController::class, "actualizar"]);
$router->post('/estudiantes/actualizar', [StudentController::class, "actualizar"]);
$router->get('/estudiantes/eliminar', [StudentController::class, "eliminar"]);

// //CRUD CANDIDATOS
$router->get('/candidatos', [CandidatoController::class, "index"]);
$router->get('/candidatos/crear', [CandidatoController::class, "crear"]);
$router->post('/candidatos/crear', [CandidatoController::class, "crear"]);
$router->get('/candidatos/actualizar', [CandidatoController::class, "actualizar"]);
$router->post('/candidatos/actualizar', [CandidatoController::class, "actualizar"]);
$router->get('/candidatos/eliminar', [CandidatoController::class, "eliminar"]);


//lamando el metodo de ruter
$router->comprobarRutas();
