<?php

define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function debuguear($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '<br>';
    echo '</pre>';
    exit;
}

function validarORedireccionar(string $url)
{
    //capturar el id del URL y Validar el ID
    $id = $_GET['id']; // ?? null; //?? null trabaja cuando no hay nada en la url
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header("Location: ${url}");
    }

    return $id;
}

//validar tipo de contenido 
function validarTipoContenido($tipo)
{
    $tipos = ['user'];

    return in_array($tipo, $tipos);
}

//escapa / sanitizar del HTML //PARA LOS FORMILARIOS
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}
