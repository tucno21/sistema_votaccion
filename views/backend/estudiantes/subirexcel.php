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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Subir estudiantes</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="mx-auto card w-75">
                <div class="card-header">
                    <a class="btn btn-secondary" href="/estudiantes">Volver</a>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php
                        if (isset($errores)) {
                            foreach ($errores as $error) :
                        ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                        <?php
                            endforeach;
                        }
                        ?>

                        <!-- foto -->
                        <div class="form-group">
                            <label for="imagen">Archivo excel:</label>
                            <div class="input-group border border-success p-1">
                                <div class="input-group-prepend">
                                    <spam class="input-group-text bg-success"><i class="far fa-file-excel"></i></spam>
                                </div>
                                <input type="file" name="file" accept=".xls,.xlsx" required>
                            </div>
                        </div>

                        <div class="text-right card-footer">
                            <button type="submit" class="btn btn-success btn-lg">Enviar</button>
                        </div>
                </form>

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