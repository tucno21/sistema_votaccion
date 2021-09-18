<?php

namespace Controllers;

use MVC\Router;
use Model\Diseno;
use Intervention\Image\ImageManagerStatic as Imagex;


class DisenoController
{
    public static function index(Router $router)
    {
        $diseños = Diseno::All();

        $router->render('diseño/index', [
            'diseños' => $diseños,
        ]);
    }


    public static function actualizar(Router $router)
    {
        $errores = [];
        // $diseños = Diseno::All();
        $id = 1;
        $valorColum = $id;
        $diseño = Diseno::find($valorColum);


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!$_POST['diseno']['name_ie']) {
                array_push($errores, "El nombre de la IE es obligatorio");
            }
            if (!$_POST['diseno']['color_b']) {
                array_push($errores, "El Color es obligatorio");
            }
            if (!$_POST['diseno']['color_s']) {
                array_push($errores, "El Color es obligatorio");
            }
            if (!$_POST['diseno']['fecha']) {
                array_push($errores, "La fecha es obligatorio");
            }

            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['diseno']['name_ie'])
            ) {

                $fechaActual = date('Y');
                if (
                    preg_match('/^[0-9]{4}+$/', $_POST['diseno']['fecha']) &&
                    $fechaActual <= $_POST['diseno']['fecha']
                ) {

                    if (
                        preg_match('/^#[a-zA-Z0-9]{6}+$/i', $_POST['diseno']['color_b']) &&
                        preg_match('/^#[a-zA-Z0-9]{6}+$/i', $_POST['diseno']['color_s'])
                    ) {

                        if ($_FILES['diseno']['tmp_name']['photo']) {
                            $image = Imagex::make($_FILES['diseno']['tmp_name']['photo'])->fit(400, 400);
                            //crea un nombre aleatorio
                            $nameImage = md5(uniqid(rand(), true)) . '.jpg';

                            $existeAchivo = file_exists(CARPETA_IMAGENES . $diseño->photo);
                            if ($existeAchivo) {
                                unlink(CARPETA_IMAGENES . $diseño->photo);
                            }

                            $_POST['diseno']['photo'] = $nameImage;
                            //guardar server
                            $image->save(CARPETA_IMAGENES . $nameImage);
                        }

                        $moddiseño = $_POST['diseno'];

                        $respuesta = Diseno::update($moddiseño, $id);

                        if ($respuesta == "ok") {
                            header('Location: /diseño');
                        }
                    } else {
                        array_push($errores, "no es un color valido");
                    }
                } else {
                    array_push($errores, "no es un Año valido");
                }
                // debuguear($_POST['diseno']);
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9");
            }
        }

        $router->render('diseño/actualizar', [
            'diseño' => $diseño,
            'errores' => $errores,
        ]);
    }
}
