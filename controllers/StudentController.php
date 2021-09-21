<?php

namespace Controllers;

use MVC\Router;
use Model\Students;


class StudentController
{
    public static function index(Router $router)
    {
        $estudiantes = Students::All();
        $router->render('backend/estudiantes/index', [
            'estudiantes' => $estudiantes,
        ]);
    }

    public static function crear(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // debuguear($_POST['estudiante']);

            if (!$_POST['estudiante']['name']) {
                array_push($errores, "El nombre es obligatorio");
            }
            if (!$_POST['estudiante']['dni']) {
                array_push($errores, "El dni es obligatorio");
            }
            if (!$_POST['estudiante']['aula']) {
                array_push($errores, "El aula es obligatorio");
            }

            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['estudiante']['name']) &&
                preg_match('/^[0-9]+$/', $_POST['estudiante']['dni']) &&
                preg_match('/^[a-zA-z0-9]+$/', $_POST['estudiante']['aula'])
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

        $router->render('backend/estudiantes/crear', [
            'errores' => $errores,
        ]);
    }

    public static function actualizar(Router $router)
    {
        $errores = [];

        $id = validarORedireccionar('/estudiantes');
        $valorColum = $id;
        //busscar usuario y traer como objeto
        $estudiante = Students::find($valorColum);
        // debuguear($estudiante);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // debuguear($_POST['estudiante']);

            if (!$_POST['estudiante']['name']) {
                array_push($errores, "El nombre es obligatorio");
            }
            if (!$_POST['estudiante']['dni']) {
                array_push($errores, "El dni es obligatorio");
            }
            if (!$_POST['estudiante']['aula']) {
                array_push($errores, "El aula es obligatorio");
            }

            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['estudiante']['name']) &&
                preg_match('/^[0-9]+$/', $_POST['estudiante']['dni']) &&
                preg_match('/^[a-zA-z0-9]+$/', $_POST['estudiante']['aula'])
            ) {

                //Buscar ususario y traer
                // $colum =  "dni";
                // $valorColum = $_POST['estudiante']["dni"];
                // $respuesta = Students::FindColumn($colum, $valorColum);
                // $buscar = isset($respuesta->dni);
                // if (!$buscar) {

                if (empty($errores)) {

                    $estudiante = $_POST['estudiante'];
                    // debuguear($estudiante);
                    $respuesta = Students::update($estudiante, $id);
                    // debuguear($respuesta);

                    if ($respuesta == "ok") {
                        header('Location: /estudiantes');
                    }
                }
                // } else {
                //     array_push($errores, "El DNI ya existe");
                // }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9");
            }
        }



        $router->render('backend/estudiantes/actualizar', [
            'errores' => $errores,
            'estudiante' => $estudiante,
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
