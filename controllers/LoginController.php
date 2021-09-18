<?php

namespace Controllers;

use MVC\Router;
use Model\Login;
use Model\Diseno;
use Model\Student;
use Model\FechaVotacion;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];

        $id = 1;
        $valorColum = $id;
        $diseño = Diseno::find($valorColum);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            if (isset($_POST["dni"])) {
                if ($_POST["dni"] !== '') {

                    if (preg_match('/^[0-9]{8}+$/', $_POST["dni"])) {

                        $colum =  "dni";
                        $valorColum = $_POST["dni"];
                        $respuesta = Student::FindColumn($colum, $valorColum);

                        $fecha =  1;
                        $respuesta2 = FechaVotacion::find($fecha);

                        date_default_timezone_set('America/Lima');
                        $fechaHoy = date("Y-m-d");
                        $horahoy = date("H:i:s");

                        if (isset($respuesta)) {

                            if ($respuesta2->fecha == $fechaHoy) {

                                if ($horahoy >= $respuesta2->hora_inicio && $horahoy <= $respuesta2->hora_fin) {
                                    $fh = date("Y-m-d H:i:s");
                                    $args['last_access'] = $fh;
                                    $respuesta = Student::update($args, $respuesta->id);

                                    session_start();
                                    $_SESSION["tuvoto"] = "ok";
                                    header('Location: /tuvoto');
                                } else {
                                    $errores = ['La votacion de: ' . $respuesta2->hora_inicio . ' a ' . $respuesta2->hora_fin];
                                }
                            } else {
                                $errores = ['La fecha de votacion es: ' . $respuesta2->fecha];
                            }
                        } else {
                            $errores = ['El DNI no esta registrado en el sistema'];
                        }
                    } else {
                        $errores = ['El DNI tiene 8 digitos'];
                    }
                } else {
                    $errores = ['Ingrese su DNi'];
                }
            }


            // debuguear(isset($_POST["email"]));
            // debuguear(isset($_POST["dni"]));


            // if ($_POST["dni"] !== '') {
            //     // if (
            //     //     preg_match('/^[0-9]+$/', $_POST["dni"])
            //     // ) {
            //     //     $colum =  "dni";
            //     //     $valorColum = $_POST["dni"];
            //     //     $respuesta = Student::FindColumn($colum, $valorColum);
            //     //     if (!$respuesta) {
            //     //         header('Location: /tuvoto');
            //     //     }
            //     // }

            // } else if ($_POST["email"] !== '' && $_POST["password"] !== '') {
            //     if (
            //         preg_match('/^[a-zA-z0-9]+$/', $_POST["password"])
            //     ) {
            //         //variable para las consultas
            //         $colum =  "email";
            //         $valorColum = $_POST["email"];
            //         //conectar y recibir una respuesta del MODEL
            //         //trae la fila del user que estoy buscando...
            //         $respuesta = Login::FindColumn($colum, $valorColum);
            //         // debuguear($respuesta);

            //         if ($respuesta) {
            //             $encritar = password_verify($_POST["password"], $respuesta->password);

            //             //comparar el ingreso con la tabla
            //             if ($respuesta->email == $_POST["email"] && $encritar) {

            //                 if ($respuesta->estado == 1) {
            //                     session_start();
            //                     $_SESSION["iniciarSesion"] = "ok";
            //                     $_SESSION['id'] = $respuesta->id;
            //                     $_SESSION['name'] = $respuesta->name;
            //                     $_SESSION['photo'] = $respuesta->photo;

            //                     // $args = [];
            //                     // $id = $respuesta->id;
            //                     // $envio = Users::update($args, $id);
            //                     // debuguear($envio);
            //                     header('Location: /dashboard');
            //                 } else {
            //                     $errores = ['El usuario esta desactivado'];
            //                 }
            //             } else {
            //                 $errores = ['La contraseña es incorrecta'];
            //             }
            //         } else {
            //             $errores = ['El ususario no existe'];
            //         }
            //     } else {
            //         $errores = ['Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9'];
            //     }
            // } else {
            //     $errores = ['Ingrese datos'];
            // }
        }
        // debuguear($errores);

        $router->render('login/index', [
            'errores' => $errores,
            'diseño' => $diseño,
        ]);
    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}
