<?php

namespace Controllers;

use MVC\Router;
use Model\Turnos;


class TurnoController
{
    public static function index(Router $router)
    {
        $turnos = Turnos::All();
        $router->render('turnos/index', [
            'turnos' => $turnos,
        ]);
    }

    public static function crear(Router $router)
    {
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$_POST['turnos']['turno']) {
                array_push($errores, "El aula es obligatorio");
            }
            if (
                preg_match('/^[a-zA-zñÑáéíóúÁÉÍÓÚ]+$/', $_POST['turnos']['turno'])
            ) {
                //Buscar ususario y traer
                $colum =  "turno";
                $valorColum = $_POST['turnos']["turno"];
                $respuesta = Turnos::FindColumn($colum, $valorColum);
                $buscar = isset($respuesta->turno);
                if (!$buscar) {
                    if (empty($errores)) {
                        $category = $_POST['turnos'];
                        $respuesta = Turnos::Save($category);

                        if ($respuesta == "ok") {
                            header('Location: /turno');
                        }
                    }
                } else {
                    array_push($errores, "El turno ya existe!");
                }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z");
            }
        }
        $router->render('turnos/crear', [
            'errores' => $errores,
        ]);
    }

    public static function actualizar(Router $router)
    {
        $errores = [];
        $id = validarORedireccionar('/turno');
        $valorColum = $id;
        //busscar usuario y traer como objeto
        $turno = Turnos::find($valorColum);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$_POST['turnos']['turno']) {
                array_push($errores, "El turno es obligatorio");
            }
            if (
                preg_match('/^[a-zA-zñÑáéíóúÁÉÍÓÚ]+$/', $_POST['turnos']['turno'])
            ) {
                //Buscar ususario y traer
                $colum =  "turno";
                $valorColum = $_POST['turnos']["turno"];
                $respuesta = Turnos::FindColumn($colum, $valorColum);
                $buscar = isset($respuesta->turno);
                if (!$buscar) {
                    if (empty($errores)) {
                        $args = $_POST['turnos'];
                        $respuesta = Turnos::update($args, $id);

                        if ($respuesta == "ok") {
                            header('Location: /turno');
                        }
                    }
                } else {
                    array_push($errores, "El turno ya existe!");
                }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z");
            }
        }

        $router->render('turnos/actualizar', [
            'errores' => $errores,
            'turno' => $turno,
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
                    $respuesta = Turnos::delete($id);
                    if ($respuesta == "ok") {
                        header('Location: /turno');
                    }
                }
            }
        }
    }
}
