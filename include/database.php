<?php

function conectarBD(): mysqli
{
    $db = new mysqli('localhost', 'root', 'root', 'sistema_votacion');

    if (!$db) {
        echo 'coneccion incorrecta';
        exit;
    }
    // echo 'coneccion exitosa';
    return $db;
}
