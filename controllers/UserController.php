<?php

namespace Controllers;

use MVC\Router;
use Model\Login;
use Model\Users;
use Intervention\Image\ImageManagerStatic as Imagex;

class UserController
{
    public static function index(Router $router)
    {

        $users = Users::AllUsers();

        $router->render('usuarios/index', [
            'users' => $users,
        ]);
    }

    public static function crear(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!$_POST['user']['name_u']) {
                array_push($errores, "El nombre es obligatorio");
            }
            if (!$_POST['user']['username']) {
                array_push($errores, "El usuario es obligatorio");
            }
            if (!$_POST['user']['password']) {
                array_push($errores, "La contraseña es obligatorio");
            }
            if (!$_POST['user']['profile']) {
                array_push($errores, "La categoria es obligatorio");
            }
            if (!$_FILES['user']['tmp_name']['photo']) {
                array_push($errores, "La foto es obligatorio");
            }
            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['user']['name_u']) &&
                preg_match('/^[a-zA-z0-9]+$/', $_POST['user']['username']) &&
                preg_match('/^[a-zA-z0-9]+$/', $_POST['user']['password'])
            ) {

                //Buscar ususario y traer
                $colum =  "username";
                $valorColum = $_POST['user']["username"];
                $respuesta = Login::FindColumn($colum, $valorColum);
                $nombre = isset($respuesta->username);
                if (!$nombre) {
                    $password = $_POST['user']['password'];
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                    $_POST['user']['password'] = $passwordHash;

                    //generar nombre unico para la imagen
                    $nameImage = md5(uniqid(rand(), true)) . '.jpg';

                    if ($_FILES['user']['tmp_name']['photo']) {
                        //modificar imagen
                        $image = Imagex::make($_FILES['user']['tmp_name']['photo'])->fit(800, 600);
                        //agregar al array
                        $_POST['user']['photo'] = $nameImage;
                    }
                    $_POST['user']['estado'] = 1;
                    $_POST['user']['last_login'] = date('Y-m-d');
                    $_POST['user']['registration_date'] = date('Y-m-d');

                    if (empty($errores)) {
                        if (!is_dir(CARPETA_IMAGENES)) {
                            mkdir(CARPETA_IMAGENES);
                        }
                        $user = $_POST['user'];
                        $respuesta = Users::Save($user);

                        $image->save(CARPETA_IMAGENES . $nameImage);

                        if ($respuesta == "ok") {
                            header('Location: /usuarios');
                        }
                    }
                } else {
                    array_push($errores, "El usuario existe, asigne otro usuario");
                }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9");
            }
        }

        $router->render('usuarios/crear', [
            'errores' => $errores,
        ]);
    }

    public static function actualizar(Router $router)
    {
        $errores = [];
        $id = validarORedireccionar('/usuarios');
        $valorColum = $id;
        //busscar usuario y traer como objeto
        $user = Users::find($valorColum);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!$_POST['user']['name_u']) {
                array_push($errores, "El nombre es obligatorio");
            }
            if (!$_POST['user']['username']) {
                array_push($errores, "El usuario es obligatorio");
            }
            if (!$_POST['user']['password']) {
                array_push($errores, "La contraseña es obligatorio");
            }
            if (!$_POST['user']['profile']) {
                array_push($errores, "La categoria es obligatorio");
            }
            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['user']['name_u']) &&
                preg_match('/^[a-zA-z0-9]+$/', $_POST['user']['username']) &&
                preg_match('/^[a-zA-z0-9]+$/', $_POST['user']['password'])
            ) {
                $args = $_POST['user'];

                //captutar la contraseña y encriptar
                $password = $_POST['user']['password'];
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);

                //asignar la contraseña encriptada al array 
                $args['password'] = $passwordHash;

                if ($_FILES['user']['tmp_name']['photo']) {
                    //modificar imagen
                    $image = Imagex::make($_FILES['user']['tmp_name']['photo'])->fit(800, 600);
                    //crea un nombre aleatorio
                    $nameImage = md5(uniqid(rand(), true)) . '.jpg';

                    $existeAchivo = file_exists(CARPETA_IMAGENES . $user->photo);
                    if ($existeAchivo) {
                        unlink(CARPETA_IMAGENES . $user->photo);
                    }
                    //enviar nombre foto al array
                    $args['photo'] = $nameImage;
                    //guardar server
                    $image->save(CARPETA_IMAGENES . $nameImage);
                }

                //eenviar el array y actualizar
                $respuesta = Users::update($args, $id);

                if ($respuesta == "ok") {
                    header('Location: /usuarios');
                }
            } else {
                array_push($errores, "Caracteres no admitidos, ingrese caracteres A-Z y/o 0-9");
            }
        }

        $router->render('usuarios/actualizar', [
            'user' => $user,
            'errores' => $errores,
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
                    //traer los datos del ID
                    $user = Users::find($id);
                    //y si existe el arrchivo
                    $existeAchivo = file_exists(CARPETA_IMAGENES . $user->photo);
                    if ($existeAchivo) {
                        unlink(CARPETA_IMAGENES . $user->photo);
                    }
                    $respuesta = Users::delete($id);
                    if ($respuesta == "ok") {
                        header('Location: /usuarios');
                    }
                }
            }
        }
    }
}
