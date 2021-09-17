<?php

namespace Controllers;

use MVC\Router;
use Model\Aulas;

class AulaController
{
    public static function index(Router $router)
    {
        $aulas = Aulas::All();
        $router->render('aulas/index', [
            'aulas' => $aulas,
        ]);
    }

    public static function crear(Router $router)
    {
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$_POST['aulas']['gradosec']) {
                array_push($errores, "El aula es obligatorio");
            }
            if (
                preg_match('/^[a-zA-z0-9]+$/', $_POST['aulas']['gradosec'])
            ) {
                //Buscar ususario y traer
                $colum =  "gradosec";
                $valorColum = $_POST['aulas']["gradosec"];
                $respuesta = Aulas::FindColumn($colum, $valorColum);
                $buscar = isset($respuesta->gradosec);
                if (!$buscar) {
                    if (empty($errores)) {
                        $category = $_POST['aulas'];
                        $respuesta = Aulas::Save($category);

                        if ($respuesta == "ok") {
                            header('Location: /aulas');
                        }
                    }
                } else {
                    array_push($errores, "El aula ya existe!");
                }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9 sin espacio");
            }
        }
        $router->render('aulas/crear', [
            'errores' => $errores,
        ]);
    }

    public static function actualizar(Router $router)
    {
        $errores = [];
        $id = validarORedireccionar('/aulas');
        $valorColum = $id;
        //busscar usuario y traer como objeto
        $aula = Aulas::find($valorColum);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$_POST['aulas']['gradosec']) {
                array_push($errores, "El aula es obligatorio");
            }
            if (
                preg_match('/^[a-zA-z0-9 ]+$/', $_POST['aulas']['gradosec'])
            ) {
                //Buscar ususario y traer
                $colum =  "gradosec";
                $valorColum = $_POST['aulas']["gradosec"];
                $respuesta = Aulas::FindColumn($colum, $valorColum);
                $buscar = isset($respuesta->gradosec);
                if (!$buscar) {
                    if (empty($errores)) {
                        $args = $_POST['aulas'];
                        $respuesta = Aulas::update($args, $id);

                        if ($respuesta == "ok") {
                            header('Location: /aulas');
                        }
                    }
                } else {
                    array_push($errores, "El aula ya existe!");
                }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9 y sin espacio");
            }
        }

        $router->render('aulas/actualizar', [
            'errores' => $errores,
            'aula' => $aula,
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
                    $respuesta = Aulas::delete($id);
                    if ($respuesta == "ok") {
                        header('Location: /aulas');
                    }
                }
            }
        }
    }
}
