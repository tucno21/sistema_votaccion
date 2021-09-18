<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Editar Aulas</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="mx-auto card w-75">
            <div class="card-header">
                <a class="btn btn-secondary" href="/fechaVotacion">Volver</a>
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
                    <!-- Fecha -->
                    <div class="form-group">
                        <label for="">Ingrese la fecha de la elecciones</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <spam class="input-group-text"><i class="fa fa-calendar"></i></spam>
                            </div>
                            <input type="text" name="fechaelectotal[fecha]" class="form-control datetimepicker-input" id="fechaelectoral" data-toggle="datetimepicker" data-target="#fechaelectoral" required />
                        </div>
                    </div>
                    <!-- Hora inicio -->
                    <div class="form-group">
                        <label for="">Hora - inicio</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <spam class="input-group-text"><i class="fas fa-hourglass-start"></i></spam>
                            </div>
                            <input type="text" name="fechaelectotal[hora_inicio]" class="form-control datetimepicker-input" id="horainicio" data-toggle="datetimepicker" data-target="#horainicio" required />
                        </div>
                    </div>
                    <!-- Hora fin -->
                    <div class="form-group">
                        <label for="">Hora - término</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <spam class="input-group-text"><i class="fas fa-hourglass-end"></i></spam>
                            </div>
                            <input type="text" name="fechaelectotal[hora_fin]" class="form-control datetimepicker-input" id="horafin" data-toggle="datetimepicker" data-target="#horafin" required />
                        </div>
                    </div>

                </div>
                <div class="text-right card-footer">
                    <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->