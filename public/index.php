<?php
//autoload
require_once __DIR__ . '/../include/app.php';

use MVC\Router;
use Controllers\AulaController;
use Controllers\UserController;
use Controllers\VotoController;
use Controllers\LoginController;
use Controllers\TurnoController;
use Controllers\DisenoController;
use Controllers\StudentController;
use Controllers\CategoryController;
use Controllers\CandidatoController;
use Controllers\DashboardController;
use Controllers\FechaVotacionController;
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
$router->post('/tuvoto', [VotoController::class, "index"]);
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

// //CRUD CANDIDATOS
$router->get('/fechaVotacion', [FechaVotacionController::class, "index"]);
$router->get('/fechaVotacion/actualizar', [FechaVotacionController::class, "actualizar"]);
$router->post('/fechaVotacion/actualizar', [FechaVotacionController::class, "actualizar"]);

// //CRUD CANDIDATOS
$router->get('/diseño', [DisenoController::class, "index"]);
$router->get('/diseño/actualizar', [DisenoController::class, "actualizar"]);
$router->post('/diseño/actualizar', [DisenoController::class, "actualizar"]);

//lamando el metodo de ruter
$router->comprobarRutas();
