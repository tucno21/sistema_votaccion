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

                if (isset($_POST['eligio']["voto"]) && $_POST["eligio"]["voto"] != "") {

                    $id = $_POST["eligio"]["id"];
                    $arr['voto'] = $_POST["eligio"]["voto"];

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
