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
                        <h1>Panel de Estudiantes</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary mt-1" href="/estudiantes/crear">Agregar Estudiante</a>
                    <a href="/estudiantes/reporte" class="btn btn-success mt-1"><i class="fas fa-arrow-down"></i> <i class="far fa-file-excel"></i> Descargar Participación</a>
                    <a href="/estudiantes/modelo" class="btn btn-success mt-1"><i class="fas fa-arrow-down"></i> <i class="far fa-file-excel"></i> Descargar Modelo</a>
                    <a href="/estudiantes/subirdatos" class="btn btn-success mt-1"><i class="fas fa-arrow-circle-up"></i> <i class="far fa-file-excel"></i> Subir Estudiantes</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped dtr-inline dt-responsive tablaDataTable">
                        <thead>
                            <tr>
                                <th style="width: 10px;">N°</th>
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th>Aula</th>
                                <th>Voto</th>
                                <th>Fecha y hora Voto</th>
                                <th>Aciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $fila = 1;
                            foreach ($estudiantes as $estudiante) : ?>
                                <tr>
                                    <td><?php echo $fila; ?></td>
                                    <td><?php echo $estudiante->name; ?></td>
                                    <td><?php echo $estudiante->dni; ?></td>
                                    <td><?php echo $estudiante->aula; ?></td>

                                    <?php if ($estudiante->canditatoId > 0) { ?>
                                        <td>
                                            <p class="btn btn-primary pb-0 pt-0">si</p>
                                        </td>
                                    <?php } else { ?>
                                        <td>
                                            <p class="btn btn-danger pb-0 pt-0">no</p>
                                        </td>
                                    <?php }; ?>

                                    <td><?php echo $estudiante->date_access; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-warning" href="/estudiantes/actualizar?id=<?php echo $estudiante->id; ?>"><i class="fa fa-edit"></i></a>

                                            <a class="btn btn-danger avisoAlertaxx" href="/estudiantes/eliminar?id=<?php echo $estudiante->id; ?>&tipo=estudiante"><i class="fas fa-trash-alt"></i></a>


                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $fila++;
                            endforeach; ?>
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