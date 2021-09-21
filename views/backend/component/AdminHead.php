<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titleBar; ?></title>

    <link rel="icon" href="<?php echo $logo; ?>">

    <?php foreach ($linksCss as $css) : ?>
        <link rel="stylesheet" href="<?php echo  $css; ?>">
    <?php endforeach; ?>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">

    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- MENU SUPERIOR -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo $mainLink; ?>" class="nav-link">Inicio</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <ul class="nav nav-tabs shadow-sm border border-secondary">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                <!-- <img class="img-circle elevation-2 mr-2" src="<?php echo $photo; ?>" width="25" alt="foto"> -->
                                <span class="hidden-xs">
                                    <?php echo $name; ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu text-center">
                                <?php foreach ($menuSession as $key => $value) { ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo $value['url']; ?>">
                                            <i class="<?php echo $value['icon']; ?>  nav-icon"></i>
                                            <?php echo $value['text']; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

        <!-- MENU LATERAL -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo $mainLink; ?>" class="brand-link">
                <img src="<?php echo $logo; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?php echo $title; ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo $photo; ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $name; ?></a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <?php
                        foreach ($linksSidebar as $linkItem => $value) {
                            if (isset($value['header'])) { ?>
                                <li class="nav-header"><?php echo $value['header']; ?></li>
                                <?php }
                            if (isset($value['mode'])) {
                                if ($value['mode'] == 'menu') { ?>
                                    <li class="nav-item">
                                        <a href="<?php echo $value['url']; ?>" class="nav-link">
                                            <i class="<?php echo $value['icon']; ?> nav-icon"></i>
                                            <p><?php echo $value['text']; ?> </p>
                                        </a>
                                    </li>

                                <?php }
                            }
                            if (isset($value['mode'])) {
                                if ($value['mode'] == 'submenu') {
                                ?>
                                    <li class="nav-item">
                                        <a href="<?php echo $value['url']; ?>" class="nav-link">
                                            <i class="<?php echo $value['icon']; ?> nav-icon"></i>
                                            <p> <?php echo $value['text']; ?>
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>

                                        <?php if (isset($value['submenu'])) {
                                            foreach ($value['submenu'] as $submenuValue) { ?>

                                                <ul class="nav nav-treeview">
                                                    <li class="nav-item">
                                                        <a href="<?php echo $submenuValue['url']; ?>" class="nav-link">
                                                            <i class="<?php echo $submenuValue['icon']; ?> nav-icon"></i>
                                                            <p><?php echo $submenuValue['text']; ?></p>
                                                        </a>
                                                    </li>
                                                </ul>

                                            <?php } ?>
                                    </li>
                    <?php }
                                    }
                                }
                            }

                    ?>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>