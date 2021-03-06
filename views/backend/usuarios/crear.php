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
                            <h1>Crear usuario</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="mx-auto card w-75">
                    <div class="card-header">
                        <a class="btn btn-secondary" href="/usuarios">Volver</a>
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
                                    <input type="text" class="form-control input-lg" name="user[name]" placeholder="Ingresar Nombre" required>
                                </div>
                            </div>
                            <!-- USUARIO -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <spam class="input-group-text"><i class="fas fa-users-cog"></i></i></spam>
                                    </div>
                                    <input type="email" class="form-control input-lg" name="user[email]" placeholder="Ingresar correo" required>
                                </div>
                            </div>
                            <!-- contrase??a -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <spam class="input-group-text"><i class="fa fa-lock"></i></spam>
                                    </div>
                                    <input type="password" class="form-control input-lg" name="user[password]" placeholder="Ingresar Contrase??a" required>
                                </div>
                            </div>
                            <!-- Perfil -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <spam class="input-group-text"><i class="fas fa-address-card"></i></spam>
                                    </div>
                                    <select class="form-control input-lg" name="user[rango]">
                                        <option value="">Seleccione Perfil</option>
                                        <option value="Administrador">Administrador</option>
                                        <option value="Director">Director</option>
                                        <option value="Docente">Docente</option>
                                    </select>
                                </div>
                            </div>
                            <!-- foto -->
                            <div class="form-group">
                                <label for="imagen">Foto:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <spam class="input-group-text"><i class="fas fa-image"></i></i></spam>
                                    </div>
                                    <input type="file" name="user[photo]" id="imagen" class="visorFoto">
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

                        </div>
                        <input type="hidden" name="user[estado]" value="1">
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