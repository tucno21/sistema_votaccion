<?php

namespace Controllers;

use MVC\Router;
use Model\Aulas;
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

        $router->render('dashboard/index', [
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
        $estudiantes = Students::All();

        // debuguear($estudiantes);

        $excel = new Spreadsheet();
        $hojaActiva = $excel->getActiveSheet();
        $hojaActiva->setTitle('resultados');
        $hojaActiva->getTabColor()->setRGB('FF0000');

        $hojaActiva->getColumnDimension('A')->setWidth(7);
        $hojaActiva->setCellValue('A1', 'ID');
        $hojaActiva->getColumnDimension('B')->setWidth(30);
        $hojaActiva->setCellValue('B1', 'NOMBRE');
        $hojaActiva->getColumnDimension('C')->setWidth(15);
        $hojaActiva->setCellValue('C1', 'DNI');
        $hojaActiva->getColumnDimension('D')->setWidth(5);
        $hojaActiva->setCellValue('D1', 'AULA');
        $hojaActiva->getColumnDimension('E')->setWidth(12);
        $hojaActiva->setCellValue('E1', 'TURNO');
        $hojaActiva->getColumnDimension('F')->setWidth(7);
        $hojaActiva->setCellValue('F1', 'VOTO');
        $hojaActiva->getColumnDimension('G')->setWidth(20);
        $hojaActiva->setCellValue('G1', 'FECHA');

        $fila = 2;

        foreach ($estudiantes as $value) {
            $hojaActiva->setCellValue('A' . $fila, $value->id);
            $hojaActiva->setCellValue('B' . $fila, $value->name);
            $hojaActiva->setCellValue('C' . $fila, $value->dni);
            $hojaActiva->setCellValue('D' . $fila, $value->aulaId);
            $hojaActiva->setCellValue('E' . $fila, $value->turnoId);
            $hojaActiva->setCellValue('F' . $fila, $value->voto);
            $hojaActiva->setCellValue('G' . $fila, $value->last_access);
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
