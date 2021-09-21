<?php

namespace Controllers;

use MVC\Router;
use Model\Diseno;
use Model\Students;
use Model\Candidatos;

class VotoController
{
    public static function index(Router $router)
    {
        $candidatos = Candidatos::All();
        $colegio = Diseno::All();
        // debuguear($colegio[0]->name_ie);
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['eligio'])) {
                // debuguear(isset($_POST['eligio']));
                if (isset($_POST['eligio']["canditatoId"]) && $_POST["eligio"]["canditatoId"] != "") {

                    $id = $_POST["eligio"]["id"];
                    $arr['canditatoId'] = $_POST["eligio"]["canditatoId"];

                    $respuesta = Students::update($arr, $id);

                    if ($respuesta == "ok") {
                        session_start();
                        $_SESSION = [];
                        header('Location: /');
                    }
                } else {
                    array_push($errores, "Debe seleccionar uno de la opciones");
                }
            }
        }

        $router->render('voto/index', [
            'candidatos' => $candidatos,
            'colegio' => $colegio,
            'errores' => $errores,
        ]);
    }
}
