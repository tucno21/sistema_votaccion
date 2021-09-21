<?php
// resetSession();
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
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
                        <h1>Fecha para las elecciones</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="/fechaVotacion/actualizar">Modificar Fecha</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped dtr-inline dt-responsive">
                        <thead>
                            <tr>
                                <th>fecha electoral</th>
                                <th>hora de inicio</th>
                                <th>fecha y de termino</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($fechahora as $fh) : ?>
                                <tr>
                                    <td><?php echo $fh->fecha; ?></td>
                                    <td><?php echo $fh->hora_inicio; ?></td>
                                    <td><?php echo $fh->hora_fin; ?></td>
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
    header('Location: /');
}
?>