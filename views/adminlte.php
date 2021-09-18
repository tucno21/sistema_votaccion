<?php
//link de los JS CSS
$linkURL = '../adminLte/';

// DATOS GENERALES ADMIN
$title = 'AdminLTE <b>3</b>';
$titleBar = 'AdminLTE 3';
$titlelogin = '<b>Admin</b>LTE';
$logo = '../adminLte/dist/img/AdminLTELogo.png';
$mainLink = '/dashboard';


//DATOS DEL USUARIO ADMIN
if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
}

if (isset($_SESSION['photo'])) {
    $photo = '../imagenes/' . $_SESSION['photo'];
} else {
    $photo = '../adminLte/dist/img/loco.png';
}

//MENU CERRAR O PERFIL DE ADMINISTRADOR
$menuSession = [
    [

        'text' => isset($profile) ? $profile : '',
        'url'  => '#',
        'icon' => 'fas fa-address-card',
    ],
    [
        'text' => 'Cerrar sesión',
        'url'  => '/logout',
        'icon' => 'fas fa-times-circle',
    ],
];


//CREACION DE ENLACES PARA EL MENU SIDEBAR

$linksSidebar = [
    ['header' => 'USUARIOS'],
    [
        'mode' => 'menu',
        'text' => 'Categorias',
        'url'  => '/categorias',
        // 'class' => 'nav-header',
        'icon' => 'fab fa-fw fa-buffer',
    ],
    [
        'mode' => 'menu',
        'text' => 'Usuarios',
        'url'  => '/usuarios',
        'icon' => 'fas fa-user',
    ],
    ['header' => 'ESTUDIANTES'],
    [
        'mode' => 'menu',
        'text' => 'Aulas',
        'url'  => '/aulas',
        'icon' => 'fas fa-house-user',
    ],
    [
        'mode' => 'menu',
        'text' => 'Turno',
        'url'  => '/turno',
        'icon' => 'far fa-sun',
    ],
    [
        'mode' => 'menu',
        'text' => 'Estudiantes',
        'url'  => '/estudiantes',
        'icon' => 'fa fa-users',
    ],
    ['header' => 'CANDIDATO'],
    [
        'mode' => 'menu',
        'text' => 'Candidatos',
        'url'  => '/candidatos',
        'icon' => 'far fa-address-card',
    ],
    [
        'mode' => 'menu',
        'text' => 'Fecha Electoral',
        'url'  => '/fechaVotacion',
        'icon' => 'far fa-calendar-alt',
    ],
    ['header' => 'DISEÑO'],
    [
        'mode' => 'menu',
        'text' => 'Diseño',
        'url'  => '/diseño',
        'icon' => 'fas fa-palette',
    ],
];
