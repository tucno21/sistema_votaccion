<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Actualizar Estudiante</h1>
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
                            <input type="text" class="form-control input-lg" name="estudiante[name]" placeholder="Ingresar Nombre" value="<?php echo $estudiante->name; ?>" required>
                        </div>
                    </div>
                    <!-- DNI -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <spam class="input-group-text"><i class="fas fa-id-card"></i></spam>
                            </div>
                            <input type="number" class="form-control input-lg" name="estudiante[dni]" placeholder="Ingresar DNI" value="<?php echo $estudiante->dni; ?>" required>
                        </div>
                    </div>
                    <!-- AULA -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <spam class="input-group-text"><i class="fas fa-laptop-house"></i></spam>
                            </div>
                            <select class="form-control input-lg" name="estudiante[aulaId]">
                                <option value="">Seleccione Aula</option>
                                <?php foreach ($aulas as $aula) : ?>
                                    <option <?php echo $estudiante->aulaId === $aula->id ? 'selected' : ''; ?> value="<?php echo $aula->id; ?>"><?php echo $aula->gradosec; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- TURNO -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <spam class="input-group-text"><i class="far fa-sun"></i></spam>
                            </div>
                            <select class="form-control input-lg" name="estudiante[turnoId]">
                                <option value="">Seleccione Turno</option>
                                <?php foreach ($turnos as $turno) : ?>
                                    <option <?php echo $estudiante->turnoId === $turno->id ? 'selected' : ''; ?> value="<?php echo $turno->id; ?>"><?php echo $turno->turno; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </div>
                <!-- <input type="hidden" name="estudiante[voto]" value="0"> -->
                <div class="text-right card-footer">
                    <button type="submit" class="btn btn-primary btn-lg">Modificar</button>
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->