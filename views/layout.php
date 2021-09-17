<?php
session_start();

if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
    // variables generales y creador de muna lateral
    include 'adminlte.php';

    //cabeza de la pplantilla
    include 'adminLte/AdminHead.php';

    //menu supererior
    include 'adminLte/AdminMenu.php';

    //menu lateral
    include 'adminLte/AdminMenuLateral.php';

    //cuerpo en blanco
    // include 'adminLte/paginaWhite.php';
    echo $contenidoLayout;

    //footer
    include 'adminLte/AdminFooter.php';

    //script
    include 'adminLte/AdminScript.php';
} else if (isset($_SESSION["tuvoto"]) && $_SESSION["tuvoto"] == "ok") {
    //login
    include 'voto/index.php';
} else {
    include 'login/index.php';
}
