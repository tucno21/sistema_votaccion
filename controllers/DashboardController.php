<?php

namespace Controllers;

use MVC\Router;
use Model\Diseno;
use Model\Students;
use Model\Candidatos;

class DashboardController
{
    public static function index(Router $router)
    {
        $candidatos = Candidatos::All();
        $estudiantes = Students::All();

        $votos = Candidatos::AllVotos();

        $resul = [];
        $contar = 0;
        foreach ($votos as $key => $value) {
            array_push($resul, $value->name);
        }
        $resul2 = array_count_values($resul);
        $resultados = json_decode(json_encode($resul2));


        $ganador = Candidatos::Ganador();

        $color = Diseno::find(1);

        $router->render('dashboard/index', [
            'candidatos' => $candidatos,
            'estudiantes' => $estudiantes,
            'votos' => $votos,
            'resultados' => $resultados,
            'ganador' => $ganador,
            'color' => $color,
        ]);
    }
}
