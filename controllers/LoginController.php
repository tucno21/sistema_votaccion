<?php

namespace Controllers;

use MVC\Router;
use Model\Login;
use Model\Users;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // debuguear($_POST);
            if ($_POST["email"] !== '' && $_POST["password"] !== '') {
                if (
                    preg_match('/^[a-zA-z0-9]+$/', $_POST["password"])
                ) {
                    //variable para las consultas
                    $colum =  "email";
                    $valorColum = $_POST["email"];
                    //conectar y recibir una respuesta del MODEL
                    //trae la fila del user que estoy buscando...
                    $respuesta = Login::FindColumn($colum, $valorColum);
                    // debuguear($respuesta);

                    if ($respuesta) {
                        $encritar = password_verify($_POST["password"], $respuesta->password);

                        //comparar el ingreso con la tabla
                        if ($respuesta->email == $_POST["email"] && $encritar) {

                            if ($respuesta->estado == 1) {
                                session_start();
                                $_SESSION["iniciarSesion"] = "ok";
                                $_SESSION['id'] = $respuesta->id;
                                $_SESSION['name'] = $respuesta->name;
                                $_SESSION['photo'] = $respuesta->photo;

                                // $args = [];
                                // $id = $respuesta->id;
                                // $envio = Users::update($args, $id);
                                // debuguear($envio);
                                header('Location: /');
                            } else {
                                $errores = ['El usuario esta desactivado'];
                            }
                        } else {
                            $errores = ['La contraseña es incorrecta'];
                        }
                    } else {
                        $errores = ['El ususario no existe'];
                    }
                } else {
                    $errores = ['Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9'];
                }
            } else {
                $errores = ['Ingrese datos'];
            }
        }
        // debuguear($errores);

        $router->render('login/entrar', [
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
