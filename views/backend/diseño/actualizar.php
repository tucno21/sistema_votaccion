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
                        <h1>MOdificar Datos</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="mx-auto card w-75">
                <div class="card-header">
                    <a class="btn btn-secondary" href="/diseño">Volver</a>
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
                            <label>Nombre de la IE</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <spam class="input-group-text"><i class="fas fa-school"></i></spam>
                                </div>
                                <input type="text" class="form-control input-lg" name="diseno[name_ie]" value='<?php echo $diseño->name_ie; ?>' required>
                            </div>
                        </div>
                        <!-- color base -->
                        <div class="form-group">
                            <label>Color base formato hex ejempplo: #ff55dd</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <spam class="input-group-text"><i class="fas fa-eye-dropper"></i></spam>
                                </div>
                                <input type="text" class="form-control input-lg" name="diseno[color_b]" value='<?php echo $diseño->color_b; ?>' required>
                            </div>
                        </div>
                        <!-- color base -->
                        <div class="form-group">
                            <label>Color suave formato hex ejempplo: #ff55dd</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <spam class="input-group-text"><i class="fas fa-eye-dropper"></i></spam>
                                </div>
                                <input type="text" class="form-control input-lg" name="diseno[color_s]" value='<?php echo $diseño->color_s; ?>' required>
                            </div>
                            <a class="btn btn-warning btn-xs" target="_blank" href="https://htmlcolorcodes.com/es/">Ver Colores</a>
                        </div>

                        <!-- año  -->
                        <div class="form-group">
                            <label>Año electoral</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <spam class="input-group-text"><i class="fas fa-calendar-check"></i></spam>
                                </div>
                                <input type="text" class="form-control input-lg" name="diseno[fecha]" value='<?php echo $diseño->fecha; ?>' required>
                            </div>
                        </div>

                        <!-- foto -->
                        <div class="form-group">
                            <label for="imagen">Logo:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <spam class="input-group-text"><i class="fas fa-image"></i></spam>
                                </div>
                                <input type="file" name="diseno[photo]" id="imagen" class="visorFoto">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="card" style="width: 8rem;">
                                <?php if (!empty($diseño->photo)) : ?>
                                    <img class="img-thumbnail card-img-top previsualizar" src="../imagenes/<?php echo $diseño->photo; ?>" alt="Card image cap">
                                <?php else : ?>
                                    <img class="img-thumbnail card-img-top previsualizar" src="../backendAL/img/logo.png" alt="Card image cap">
                                <?php endif; ?>
                                <div class="card-body">
                                    <p class="card-text">Peso máximo de 1mb</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="text-right card-footer">
                        <button type="submit" class="btn btn-primary btn-lg">Modificar</button>
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