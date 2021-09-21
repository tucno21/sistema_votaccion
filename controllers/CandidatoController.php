<?php

namespace Controllers;

use Model\Candidatos;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Imagex;


class CandidatoController
{
    public static function index(Router $router)
    {
        $candidatos = Candidatos::All();
        $router->render('backend/candidatos/index', [
            'candidatos' => $candidatos,
        ]);
    }

    public static function crear(Router $router)
    {
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // debuguear($_POST['candidato']);

            if (!$_POST['candidato']['name']) {
                array_push($errores, "El nombre es obligatorio");
            }
            if (!$_POST['candidato']['dni']) {
                array_push($errores, "El dni es obligatorio");
            }
            if (!$_POST['candidato']['group_name']) {
                array_push($errores, "El nombre del grupo es obligatorio");
            }
            if (!$_FILES['candidato']['tmp_name']['photo']) {
                array_push($errores, "La foto es obligatorio");
            }
            if (!$_FILES['candidato']['tmp_name']['logo']) {
                array_push($errores, "el logo es obligatorio");
            }
            // debuguear($_FILES['candidato']['tmp_name']);
            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['candidato']['name']) &&
                preg_match('/^[0-9]+$/', $_POST['candidato']['dni']) &&
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['candidato']['group_name'])
            ) {

                //Buscar ususario y traer
                $colum =  "dni";
                $valorColum = $_POST['candidato']["dni"];
                $respuesta = Candidatos::FindColumn($colum, $valorColum);
                $buscar = isset($respuesta->dni);
                if (!$buscar) {

                    if (empty($errores)) {
                        if ($_FILES['candidato']['tmp_name']) {
                            foreach ($_FILES["candidato"]['tmp_name'] as $key => $tmp_name) {
                                if ($tmp_name) {
                                    $namePhoto = md5(uniqid(rand(), true)) . '.jpg';
                                    $image = Imagex::make($tmp_name)->fit(500, 500);
                                    if (!is_dir(CARPETA_IMAGENES)) {
                                        mkdir(CARPETA_IMAGENES);
                                    }
                                    $image->save(CARPETA_IMAGENES . $namePhoto);
                                    $_POST['candidato'][$key] = $namePhoto;
                                }
                            }
                        }

                        $candidato = $_POST['candidato'];
                        // debuguear($candidato);
                        $respuesta = Candidatos::Save($candidato);

                        if ($respuesta == "ok") {
                            header('Location: /candidatos');
                        }
                    }
                } else {
                    array_push($errores, "El dni ya existe");
                }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9");
            }
        }

        $router->render('backend/candidatos/crear', [
            'errores' => $errores,
        ]);
    }

    public static function actualizar(Router $router)
    {
        $errores = [];
        $id = validarORedireccionar('/usuarios');
        $valorColum = $id;
        //busscar usuario y traer como objeto
        $candidato = Candidatos::find($valorColum);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // debuguear($_POST['candidato']);

            if (!$_POST['candidato']['name']) {
                array_push($errores, "El nombre es obligatorio");
            }
            if (!$_POST['candidato']['dni']) {
                array_push($errores, "El dni es obligatorio");
            }
            if (!$_POST['candidato']['group_name']) {
                array_push($errores, "El nombre del grupo es obligatorio");
            }

            // debuguear($_FILES['candidato']['tmp_name']);
            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['candidato']['name']) &&
                preg_match('/^[0-9]+$/', $_POST['candidato']['dni']) &&
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['candidato']['group_name'])
            ) {

                if (empty($errores)) {
                    if ($_FILES['candidato']['tmp_name']) {
                        foreach ($_FILES["candidato"]['tmp_name'] as $key => $tmp_name) {
                            if ($tmp_name) {
                                $namePhoto = md5(uniqid(rand(), true)) . '.jpg';
                                $image = Imagex::make($tmp_name)->fit(500, 500);
                                if (!is_dir(CARPETA_IMAGENES)) {
                                    mkdir(CARPETA_IMAGENES);
                                }
                                $image->save(CARPETA_IMAGENES . $namePhoto);
                                $_POST['candidato'][$key] = $namePhoto;
                            }
                        }
                    }

                    $candidatoEnv = $_POST['candidato'];
                    // debuguear(isset($candidato["photo"]));

                    if (isset($candidatoEnv["photo"])) {
                        $existeAchivo = file_exists(CARPETA_IMAGENES . $candidato->photo);
                        if ($existeAchivo) {
                            unlink(CARPETA_IMAGENES . $candidato->photo);
                        }
                    }
                    if (isset($candidatoEnv["logo"])) {
                        $existeAchivo2 = file_exists(CARPETA_IMAGENES . $candidato->logo);
                        if ($existeAchivo2) {
                            unlink(CARPETA_IMAGENES . $candidato->logo);
                        }
                    }

                    $respuesta = Candidatos::update($candidatoEnv, $id);

                    if ($respuesta == "ok") {
                        header('Location: /candidatos');
                    }
                }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9");
            }
        }

        $router->render('backend/candidatos/actualizar', [
            'candidato' => $candidato,
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
                    //traer los datos del ID
                    $candidato = Candidatos::find($id);
                    //y si existe el arrchivo
                    $existeAchivo = file_exists(CARPETA_IMAGENES . $candidato->photo);
                    if ($existeAchivo) {
                        unlink(CARPETA_IMAGENES . $candidato->photo);
                    }
                    $existeAchivo2 = file_exists(CARPETA_IMAGENES . $candidato->logo);
                    if ($existeAchivo2) {
                        unlink(CARPETA_IMAGENES . $candidato->logo);
                    }


                    $respuesta = Candidatos::delete($id);
                    if ($respuesta == "ok") {
                        header('Location: /candidatos');
                    }
                }
            }
        }
    }
}
