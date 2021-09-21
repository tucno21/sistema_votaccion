<?php

namespace Controllers;

use MVC\Router;
use Model\Diseno;
use Model\Students;
use Model\Candidatos;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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

        $router->render('backend/dashboard/index', [
            'candidatos' => $candidatos,
            'estudiantes' => $estudiantes,
            'votos' => $votos,
            'resultados' => $resultados,
            'ganador' => $ganador,
            'color' => $color,
        ]);
    }

    public static function excel(Router $router)
    {

        // $query = "SELECT C.name, C.group_name, COUNT(E.voto) maximo 
        // FROM students E 
        // INNER JOIN candidatos C ON E.voto = C.id 
        // GROUP BY voto 
        // ORDER BY maximo DESC";

        $query = "SELECT C.name, C.group_name, COUNT(E.canditatoId) maximo 
        FROM candidatos C 
        INNER JOIN students E ON C.id = E.canditatoId 
        GROUP BY canditatoId 
        ORDER BY maximo DESC";

        $resultados = Candidatos::mysqlAll($query);


        $excel = new Spreadsheet();
        $hojaActiva = $excel->getActiveSheet();
        $hojaActiva->setTitle('resultados');
        $hojaActiva->getTabColor()->setRGB('FF0000');

        $hojaActiva->getColumnDimension('A')->setWidth(5);
        $hojaActiva->setCellValue('A1', 'N');
        $hojaActiva->getColumnDimension('B')->setWidth(30);
        $hojaActiva->setCellValue('B1', 'NOMBRE GRUPO');
        $hojaActiva->getColumnDimension('C')->setWidth(30);
        $hojaActiva->setCellValue('C1', 'NOMBRE CANDIDATO');
        $hojaActiva->getColumnDimension('D')->setWidth(8);
        $hojaActiva->setCellValue('D1', 'VOTOS TOTAL');


        $fila = 2;
        foreach ($resultados as $value) {
            $hojaActiva->setCellValue('A' . $fila, $fila - 1);
            $hojaActiva->setCellValue('B' . $fila, $value->group_name);
            $hojaActiva->setCellValue('C' . $fila, $value->name);
            $hojaActiva->setCellValue('D' . $fila, $value->maximo);
            $fila++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="resultados.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
