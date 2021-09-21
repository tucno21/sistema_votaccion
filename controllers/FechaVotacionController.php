<?php

namespace Controllers;

use MVC\Router;
use Model\FechaVotacion;

class FechaVotacionController
{
    public static function index(Router $router)
    {
        $fechahora = FechaVotacion::All();

        $router->render('backend/fechavotacion/index', [
            'fechahora' => $fechahora,
        ]);
    }

    public static function actualizar(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!$_POST["fechaelectotal"]["fecha"]) {
                array_push($errores, "El fecha es obligatorio");
            }
            if (!$_POST["fechaelectotal"]["hora_inicio"]) {
                array_push($errores, "El hora de inicio es obligatorio");
            }
            if (!$_POST["fechaelectotal"]["hora_fin"]) {
                array_push($errores, "El hora de termino es obligatorio");
            }


            if (isset($_POST["fechaelectotal"])) {

                $fecha = $_POST["fechaelectotal"]["fecha"];
                //modificando fecha
                $arr = explode('/', $fecha);
                $_POST["fechaelectotal"]["fecha"] = $arr[2] . '-' . $arr[0] . '-' . $arr[1];


                $horaI = $_POST["fechaelectotal"]["hora_inicio"];
                $hI = date("H:i", strtotime($horaI));
                $_POST["fechaelectotal"]["hora_inicio"] = $hI;

                $horaF = $_POST["fechaelectotal"]["hora_fin"];
                $hF = date("H:i", strtotime($horaF));
                $_POST["fechaelectotal"]["hora_fin"] = $hF;

                $id = 1;
                $fechaTotal = $_POST['fechaelectotal'];
                $respuesta = FechaVotacion::update($fechaTotal, $id);

                if ($respuesta == "ok") {
                    header('Location: /fechaVotacion');
                }
            } else {
                array_push($errores, "No es una fecha valida");
            }
        }
        $router->render('backend/fechavotacion/actualizar', [
            'errores' => $errores,
        ]);
    }
}
