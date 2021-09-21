<?php

namespace Controllers;

use MVC\Router;
use Model\Students;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class StudentController
{
    public static function index(Router $router)
    {
        $estudiantes = Students::All();
        $router->render('backend/estudiantes/index', [
            'estudiantes' => $estudiantes,
        ]);
    }

    public static function crear(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // debuguear($_POST['estudiante']);

            if (!$_POST['estudiante']['name']) {
                array_push($errores, "El nombre es obligatorio");
            }
            if (!$_POST['estudiante']['dni']) {
                array_push($errores, "El dni es obligatorio");
            }
            if (!$_POST['estudiante']['aula']) {
                array_push($errores, "El aula es obligatorio");
            }

            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['estudiante']['name']) &&
                preg_match('/^[0-9]+$/', $_POST['estudiante']['dni']) &&
                preg_match('/^[a-zA-z0-9]+$/', $_POST['estudiante']['aula'])
            ) {

                //Buscar ususario y traer
                $colum =  "dni";
                $valorColum = $_POST['estudiante']["dni"];
                $respuesta = Students::FindColumn($colum, $valorColum);
                $buscar = isset($respuesta->dni);
                if (!$buscar) {

                    if (empty($errores)) {

                        $estudiante = $_POST['estudiante'];
                        // debuguear($estudiante);
                        $respuesta = Students::Save($estudiante);
                        // debuguear($respuesta);

                        if ($respuesta == "ok") {
                            header('Location: /estudiantes');
                        }
                    }
                } else {
                    array_push($errores, "El DNI ya existe");
                }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9");
            }
        }

        $router->render('backend/estudiantes/crear', [
            'errores' => $errores,
        ]);
    }

    public static function actualizar(Router $router)
    {
        $errores = [];

        $id = validarORedireccionar('/estudiantes');
        $valorColum = $id;
        //busscar usuario y traer como objeto
        $estudiante = Students::find($valorColum);
        // debuguear($estudiante);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // debuguear($_POST['estudiante']);

            if (!$_POST['estudiante']['name']) {
                array_push($errores, "El nombre es obligatorio");
            }
            if (!$_POST['estudiante']['dni']) {
                array_push($errores, "El dni es obligatorio");
            }
            if (!$_POST['estudiante']['aula']) {
                array_push($errores, "El aula es obligatorio");
            }

            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['estudiante']['name']) &&
                preg_match('/^[0-9]+$/', $_POST['estudiante']['dni']) &&
                preg_match('/^[a-zA-z0-9]+$/', $_POST['estudiante']['aula'])
            ) {

                //Buscar ususario y traer
                // $colum =  "dni";
                // $valorColum = $_POST['estudiante']["dni"];
                // $respuesta = Students::FindColumn($colum, $valorColum);
                // $buscar = isset($respuesta->dni);
                // if (!$buscar) {

                if (empty($errores)) {

                    $estudiante = $_POST['estudiante'];
                    // debuguear($estudiante);
                    $respuesta = Students::update($estudiante, $id);
                    // debuguear($respuesta);

                    if ($respuesta == "ok") {
                        header('Location: /estudiantes');
                    }
                }
                // } else {
                //     array_push($errores, "El DNI ya existe");
                // }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9");
            }
        }



        $router->render('backend/estudiantes/actualizar', [
            'errores' => $errores,
            'estudiante' => $estudiante,
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
                    $respuesta = Students::delete($id);
                    if ($respuesta == "ok") {
                        header('Location: /estudiantes');
                    }
                }
            }
        }
    }

    public static function reporte()
    {
        $resultados = Students::All();
        // debuguear($resultados);

        $excel = new Spreadsheet();
        $hojaActiva = $excel->getActiveSheet();
        $hojaActiva->setTitle('Participación');
        $hojaActiva->getTabColor()->setRGB('FF0000');

        $hojaActiva->getColumnDimension('A')->setWidth(5);
        $hojaActiva->setCellValue('A1', 'N');
        $hojaActiva->getColumnDimension('B')->setWidth(30);
        $hojaActiva->setCellValue('B1', 'NOMBRE Y APELLIDOS');
        $hojaActiva->getColumnDimension('C')->setWidth(10);
        $hojaActiva->setCellValue('C1', 'DNI');
        $hojaActiva->getColumnDimension('D')->setWidth(7);
        $hojaActiva->setCellValue('D1', 'AULA');
        $hojaActiva->getColumnDimension('E')->setWidth(8);
        $hojaActiva->setCellValue('E1', 'PARTICPACIÓN');
        $hojaActiva->getColumnDimension('F')->setWidth(20);
        $hojaActiva->setCellValue('F1', 'FECHA Y HORA');


        $fila = 2;
        foreach ($resultados as $value) {
            $hojaActiva->setCellValue('A' . $fila, $fila - 1);
            $hojaActiva->setCellValue('B' . $fila, $value->name);
            $hojaActiva->setCellValue('C' . $fila, $value->dni);
            $hojaActiva->setCellValue('D' . $fila, $value->aula);
            if ($value->canditatoId == null || $value->canditatoId == '' || $value->canditatoId == 0) {
                $hojaActiva->setCellValue('E' . $fila, 'no');
            } else {
                $hojaActiva->setCellValue('E' . $fila, 'si');
            }
            $hojaActiva->setCellValue('F' . $fila, $value->date_access);
            $fila++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="estudiantes.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
        exit;
    }


    public static function modelo()
    {

        $excel = new Spreadsheet();
        $hojaActiva = $excel->getActiveSheet();
        $hojaActiva->setTitle('modelo');
        $hojaActiva->getTabColor()->setRGB('FF0000');

        $hojaActiva->getColumnDimension('A')->setWidth(30);
        $hojaActiva->setCellValue('A1', 'NOMBRE Y APELLIDOS');
        $hojaActiva->getColumnDimension('B')->setWidth(15);
        $hojaActiva->setCellValue('B1', 'DNI');
        $hojaActiva->getColumnDimension('C')->setWidth(10);
        $hojaActiva->setCellValue('C1', 'AULA');



        $hojaActiva->setCellValue('A2', 'Juan Velarde Fajardo');
        $hojaActiva->setCellValue('B2', '44442222');
        $hojaActiva->setCellValue('C2', '1A');


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="modelo.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
