<?php

namespace Controllers;

use MVC\Router;
use Model\Login;
use Model\Diseno;
use Model\Students;
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
                        $respuesta = Students::FindColumn($colum, $valorColum);
                        // debuguear($respuesta);

                        $fecha =  1;
                        $respuesta2 = FechaVotacion::find($fecha);

                        date_default_timezone_set('America/Lima');
                        $fechaHoy = date("Y-m-d");
                        $horahoy = date("H:i:s");

                        if (isset($respuesta)) {

                            if ($respuesta2->fecha == $fechaHoy) {

                                if ($horahoy >= $respuesta2->hora_inicio && $horahoy <= $respuesta2->hora_fin) {

                                    if ($respuesta->candidatoId == null || $respuesta->candidatoId == '' || $respuesta->candidatoId == 0) {

                                        $fh = date("Y-m-d H:i:s");
                                        $args['last_access'] = $fh;
                                        Students::update($args, $respuesta->id);

                                        session_start();
                                        $_SESSION["tuvoto"] = "ok";
                                        $_SESSION['id'] = $respuesta->id;
                                        $_SESSION['name'] = $respuesta->name;

                                        header('Location: /tuvoto');
                                    } else {
                                        $errores = ['Usted ya voto no puede entrar'];
                                    }
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


            if (isset($_POST["email"]) && isset($_POST["password"])) {
                if ($_POST["email"] !== '' && $_POST["password"] !== '') {
                    if (
                        preg_match('/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/', $_POST["email"])
                    ) {
                        if (
                            preg_match('/^[a-zA-z0-9]+$/', $_POST["password"])
                        ) {
                            $colum =  "email";
                            $valorColum = $_POST["email"];
                            $respuesta = Login::FindColumn($colum, $valorColum);

                            if ($respuesta) {
                                $encritar = password_verify($_POST["password"], $respuesta->password);

                                //comparar el ingreso con la tabla
                                if ($respuesta->email == $_POST["email"] && $encritar) {

                                    if ($respuesta->estado == 1) {

                                        date_default_timezone_set('America/Lima');
                                        $fh = date("Y-m-d H:i:s");
                                        $args['date_access'] = $fh;
                                        Login::update($args, $respuesta->id);

                                        session_start();
                                        $_SESSION["iniciarSesion"] = "ok";
                                        $_SESSION['id'] = $respuesta->id;
                                        $_SESSION['name'] = $respuesta->name;
                                        $_SESSION['tipo'] = $respuesta->rango;
                                        $_SESSION['photo'] = $respuesta->photo;
                                        header('Location: /dashboard');
                                    } else {
                                        $errores = ['El usuario esta desactivado'];
                                    }
                                } else {
                                    $errores = ['La contraseña es incorrecta'];
                                }
                            } else {
                                $errores = ['El email no existe'];
                            }
                        } else {
                            $errores = ['no se admiter caracteres especiales'];
                        }
                    } else {
                        $errores = ['no es un correo valido'];
                    }
                } else {
                    $errores = ['no se admite celdas vacias'];
                }
            }
        }

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
