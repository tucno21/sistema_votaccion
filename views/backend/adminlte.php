<?php
if ($_SESSION != null) {
    $name = $_SESSION['name'];
    $tipo = $_SESSION['tipo'];
}


// DATOS GENERALES ADMIN
$title = 'AdminLTE <b>3</b>';
$titleBar = 'AdminLTE 3';
$titlelogin = '<b>Admin</b>LTE';
$logo = '../backendAL/img/logo.png';
$mainLink = '/dashboard';


if (isset($_SESSION['photo'])) {
    $photo = '../imagenes/' . $_SESSION['photo'];
} else {
    $photo = '../backendAL/img/user.png';
}

//MENU CERRAR O PERFIL DE ADMINISTRADOR
$menuSession = [
    [

        'text' => $tipo,
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
        'text' => 'user',
        'url'  => '/usuarios',
        // 'class' => 'nav-header',
        'icon' => 'fab fa-fw fa-buffer',
    ],
    ['header' => 'ESTUDIANTES'],
    [
        'mode' => 'menu',
        'text' => 'Estudiantes',
        'url'  => '/estudiantes',
        'icon' => 'fa fa-users',
    ],
    ['header' => 'DISEÑO'],
    [
        'mode' => 'submenu',
        'text'    => 'Ventas',
        'url'    => '#',
        'icon' => 'fas fa-cart-arrow-down',
        'submenu' => [
            [
                'text' => 'Administrar ventas',
                'url'  => '/ventas',
                'icon' => 'fas fa-tasks',
            ],
            [
                'text' => 'Crear ventas',
                'url'  => '/crear-ventas',
                'icon' => 'far fa-plus-square',
            ],
            [
                'text' => 'Reportes de ventas',
                'url'  => '/reportes',
                'icon' => 'fas fa-file-invoice-dollar',
            ],
        ],

    ],
    ['header' => 'CLIENTES'],
];


$linkURL = '../backendAL/';

$linksCss = [
    'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback',
    $linkURL . 'plugins/fontawesome-free/css/all.min.css',
    $linkURL . 'adminLte/css/adminlte.min.css',
];

// $linksCss = [
//     $linkURL . 'plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
//     $linkURL . 'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
//     $linkURL . 'plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
//     $linkURL . 'plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
//     $linkURL . 'plugins/icheck-bootstrap/icheck-bootstrap.min.css',
//     $linkURL . 'plugins/daterangepicker/daterangepicker.css',
//     $linkURL . 'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
// ];

$linksScript = [
    $linkURL . 'plugins/jquery/jquery.min.js',
    $linkURL . 'plugins/bootstrap/js/bootstrap.bundle.min.js',
    $linkURL . 'adminLte/js/adminlte.min.js',
];

// $linksScript = [
//     $linkURL . 'plugins/chart.js/Chart.min.js',
//     $linkURL . 'plugins/moment/moment.min.js',
//     $linkURL . 'pplugins/inputmask/jquery.inputmask.min.js',
//     $linkURL . 'pplugins/inputmask/jquery.inputmask.min.js',
//     $linkURL . 'plugins/daterangepicker/daterangepicker.js',
//     $linkURL . 'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',

//     $linkURL . 'plugins/datatables/jquery.dataTables.min.js'
//     $linkURL . 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'
//     $linkURL . 'plugins/datatables-responsive/js/dataTables.responsive.min.js'
//     $linkURL . 'plugins/datatables-responsive/js/responsive.bootstrap4.min.js'
//     $linkURL . 'plugins/datatables-buttons/js/dataTables.buttons.min.js'
//     $linkURL . 'plugins/datatables-buttons/js/buttons.bootstrap4.min.js'
//     $linkURL . 'plugins/datatables-buttons/js/buttons.html5.min.js'
//     $linkURL . 'plugins/datatables-buttons/js/buttons.print.min.js'
//     $linkURL . 'plugins/datatables-buttons/js/buttons.colVis.min.js'

//     $linkURL . '../js/datatable.js'
//     $linkURL . '../js/visorfoto.js'
//     $linkURL . '../js/fecha.js'

// ];
