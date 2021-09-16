<!-- Main Sidebar Container -->
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