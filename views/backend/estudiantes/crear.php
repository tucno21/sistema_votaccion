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
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="mb-2 row">
                        <div class="col-sm-6">
                            <h1>Agregar Estudiante</h1>
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
                    <form method="POST">
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

                            <!-- NOMBRE -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <spam class="input-group-text"><i class="fa fa-user"></i></spam>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="estudiante[name]" placeholder="Ingresar Nombre" required>
                                </div>
                            </div>
                            <!-- DNI -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <spam class="input-group-text"><i class="fas fa-id-card"></i></spam>
                                    </div>
                                    <input type="number" class="form-control input-lg" name="estudiante[dni]" placeholder="Ingresar DNI" required>
                                </div>
                            </div>
                            <!-- AULA -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <spam class="input-group-text"><i class="fas fa-laptop-house"></i></spam>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="estudiante[aula]" placeholder="Grado secicion : 2A" required>
                                </div>
                            </div>

                        </div>
                        <!-- <input type="hidden" name="estudiante[voto]" value="0"> -->
                        <div class="text-right card-footer">
                            <button type="submit" class="btn btn-primary btn-lg">Agregar</button>
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
        header('Location: /dashboard');
    }
} else {
    header('Location: /');
}
?>