<?php
//agregar funciones
require 'functions.php';
require 'database.php';
//agregando autoload
require __DIR__ . '/../vendor/autoload.php';


use Model\Login;
//conectarnos a la base de datos
$connected = conectarBD();

//enviar la coneccion a ActiveRecord
Login::setBD($connected);
