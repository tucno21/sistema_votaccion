<?php
// resetSession();
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
    if ($_SESSION["tipo"] == 'Administrador') {
        // variables generales y creador de muna lateral
        include '../views/backend/adminlte.php';
        include '../views/backend/component/AdminHead.php';
?>


        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="mb-2 row">
                        <div class="col-sm-6">
                            <h1>Modificar el Login</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="/diseño/actualizar">Modificar</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped dtr-inline dt-responsive">
                            <thead>
                                <tr>
                                    <th>Institucion Educativa</th>
                                    <th>Logo</th>
                                    <th>Color base</th>
                                    <th>Color suave</th>
                                    <th>Año de electoral</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($diseños as $di) : ?>
                                    <tr>
                                        <td><?php echo $di->name_ie; ?></td>
                                        <?php if ($di->photo == "") : ?>
                                            <td><img src="../adminLte/dist/img/user2-160x160.jpg" alt="avatar" class="img-thumbnail" width="40px"></td>
                                        <?php else : ?>
                                            <td><img src="../imagenes/<?php echo $di->photo; ?>" alt="avatar" class="img-thumbnail" width="40px"></td>
                                        <?php endif; ?>
                                        <td><?php echo $di->color_b; ?></td>
                                        <td><?php echo $di->color_s; ?></td>
                                        <td><?php echo $di->fecha; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

<?php
        include '../views/backend/component/AdminFooter.php';
    } else {
        header('Location: /dashboard');
    }
} else {
    header('Location: /');
}
?>