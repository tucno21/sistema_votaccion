<?php

namespace Controllers;

use MVC\Router;
use Model\Aulas;
use Model\Turnos;
use Model\Students;


class StudentController
{
    public static function index(Router $router)
    {
        $estudiantes = Students::AllStudents();
        $router->render('estudiantes/index', [
            'estudiantes' => $estudiantes,
        ]);
    }

    public static function crear(Router $router)
    {
        $errores = [];
        $aulas = Aulas::All();
        $turnos = Turnos::All();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // debuguear($_POST['estudiante']);

            if (!$_POST['estudiante']['name']) {
                array_push($errores, "El nombre es obligatorio");
            }
            if (!$_POST['estudiante']['dni']) {
                array_push($errores, "El dni es obligatorio");
            }
            if (!$_POST['estudiante']['aulaId']) {
                array_push($errores, "El aula es obligatorio");
            }
            if (!$_POST['estudiante']['turnoId']) {
                array_push($errores, "El turno es obligatorio");
            }

            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['estudiante']['name']) &&
                preg_match('/^[0-9]+$/', $_POST['estudiante']['dni']) &&
                preg_match('/^[0-9]+$/', $_POST['estudiante']['aulaId']) &&
                preg_match('/^[0-9]+$/', $_POST['estudiante']['turnoId'])
            ) {

                //Buscar ususario y traer
                $colum =  "dni";
                $valorColum = $_POST['estudiante']["dni"];
                $respuesta = Students::FindColumn($colum, $valorColum);
                $buscar = isset($respuesta->dni);
                if (!$buscar) {

                    if (empty($errores)) {

                        $estudiante = $_POST['estudiante'];
                        // debuguear($estudiante);
                        $respuesta = Students::Save($estudiante);
                        // debuguear($respuesta);

                        if ($respuesta == "ok") {
                            header('Location: /estudiantes');
                        }
                    }
                } else {
                    array_push($errores, "El DNI ya existe");
                }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9");
            }
        }

        $router->render('estudiantes/crear', [
            'aulas' => $aulas,
            'turnos' => $turnos,
            'errores' => $errores,
        ]);
    }

    public static function actualizar(Router $router)
    {
        $errores = [];
        $aulas = Aulas::All();
        $turnos = Turnos::All();

        $id = validarORedireccionar('/estudiantes');
        $valorColum = $id;
        //busscar usuario y traer como objeto
        $estudiante = Students::find($valorColum);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // debuguear($_POST['estudiante']);

            if (!$_POST['estudiante']['name']) {
                array_push($errores, "El nombre es obligatorio");
            }
            if (!$_POST['estudiante']['dni']) {
                array_push($errores, "El dni es obligatorio");
            }
            if (!$_POST['estudiante']['aulaId']) {
                array_push($errores, "El aula es obligatorio");
            }
            if (!$_POST['estudiante']['turnoId']) {
                array_push($errores, "El turno es obligatorio");
            }

            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['estudiante']['name']) &&
                preg_match('/^[0-9]+$/', $_POST['estudiante']['dni']) &&
                preg_match('/^[0-9]+$/', $_POST['estudiante']['aulaId']) &&
                preg_match('/^[0-9]+$/', $_POST['estudiante']['turnoId'])
            ) {

                //Buscar ususario y traer
                $colum =  "dni";
                $valorColum = $_POST['estudiante']["dni"];
                $respuesta = Students::FindColumn($colum, $valorColum);
                $buscar = isset($respuesta->dni);
                if (!$buscar) {

                    if (empty($errores)) {

                        $estudiante = $_POST['estudiante'];
                        // debuguear($estudiante);
                        $respuesta = Students::update($estudiante, $id);
                        // debuguear($respuesta);

                        if ($respuesta == "ok") {
                            header('Location: /estudiantes');
                        }
                    }
                } else {
                    array_push($errores, "El DNI ya existe");
                }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9");
            }
        }



        $router->render('estudiantes/actualizar', [
            'errores' => $errores,
            'estudiante' => $estudiante,
            'aulas' => $aulas,
            'turnos' => $turnos,
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            //validar que el id sea entero
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                //verificar sea tipo usuario
                $tipo = $_GET['tipo'];
                if (validarTipoContenido($tipo)) {
                    $respuesta = Students::delete($id);
                    if ($respuesta == "ok") {
                        header('Location: /estudiantes');
                    }
                }
            }
        }
    }
}
