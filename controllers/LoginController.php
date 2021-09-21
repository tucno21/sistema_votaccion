<?php

namespace Controllers;

use MVC\Router;
use Model\Login;

class LoginController
{
    public static function index(Router $router)
    {
        $router->render('login/index', []);
    }

    public static function login(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {



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
                                        $_SESSION['tipo'] = 'administrador';
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
        ]);
    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}
