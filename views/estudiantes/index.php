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
                <a class="btn btn-primary" href="/estudiantes/crear">Agregar Estudiante</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped dtr-inline dt-responsive tablaDataTable">
                    <thead>
                        <tr>
                            <th style="width: 10px;">N°</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Aula</th>
                            <th>Turno</th>
                            <th>Voto</th>
                            <th>Ultimo Login</th>
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
                                <td><?php echo $estudiante->gradosec; ?></td>
                                <td><?php echo $estudiante->turno; ?></td>
                                <td><?php echo $estudiante->voto; ?></td>
                                <td><?php echo $estudiante->last_access; ?></td>
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