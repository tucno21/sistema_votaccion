<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear Turno</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card w-75 mx-auto">
            <div class="card-header">
                <a class="btn btn-secondary" href="/turno">Volver</a>
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
                                <spam class="input-group-text"><i class="far fa-sun"></i></spam>
                            </div>
                            <input type="text" class="form-control input-lg" name="turnos[turno]" placeholder="Ingresar un turno" required>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-lg">Agregar</button>
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->