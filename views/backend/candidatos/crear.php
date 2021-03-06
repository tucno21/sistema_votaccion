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
                            <h1>Crear Candidato</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="mx-auto card w-75">
                    <div class="card-header">
                        <a class="btn btn-secondary" href="/candidatos">Volver</a>
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

                            <!-- NOMBRE -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <spam class="input-group-text"><i class="fa fa-user"></i></spam>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="candidato[name]" placeholder="Ingresar Nombre" required>
                                </div>
                            </div>
                            <!-- DNI -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <spam class="input-group-text"><i class="fas fa-id-card"></i></spam>
                                    </div>
                                    <input type="number" class="form-control input-lg" name="candidato[dni]" placeholder="Ingresar DNI" required>
                                </div>
                            </div>
                            <!-- Nombre del Grupo -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <spam class="input-group-text"><i class="fas fa-signature"></i></spam>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="candidato[group_name]" placeholder="Ingresar el nombre de la agrupaci??n" required>
                                </div>
                            </div>
                            <!-- foto -->
                            <div class="form-group">
                                <label for="imagen">Foto del candidato:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <spam class="input-group-text"><i class="fas fa-image"></i></spam>
                                    </div>
                                    <input type="file" name="candidato[photo]" id="imagen" class="visorFoto" multiple>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="card" style="width: 8rem;">
                                    <img class="img-thumbnail card-img-top previsualizar" src="../backendAL/img/user.png" alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text">Peso m??ximo de 1mb</p>
                                    </div>
                                </div>
                            </div>
                            <!-- LOGO -->
                            <div class="form-group">
                                <label for="imagen">Logo de la agrupaci??n:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <spam class="input-group-text"><i class="fab fa-slack"></i></spam>
                                    </div>
                                    <input type="file" name="candidato[logo]" id="imagen" class="visorLogo" multiple>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="card" style="width: 8rem;">
                                    <img class="img-thumbnail card-img-top previsualizar2" src="../backendAL/img/voto.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text">Peso m??ximo de 1mb</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="candidato[estado]" value="1">
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