<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Panel de Turno</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary" href="/turno/crear">Agregar Nuevo Turno</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped dtr-inline dt-responsive tablaDataTable">
                    <thead>
                        <tr>
                            <th style="width: 10px;">N°</th>
                            <th>Turno</th>
                            <th>Aciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $fila = 1;
                        foreach ($turnos as $turno) : ?>
                            <tr>
                                <td><?php echo $fila; ?></td>
                                <td><?php echo $turno->turno; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-warning" href="/turno/actualizar?id=<?php echo $turno->id; ?>"><i class="fa fa-edit"></i></a>

                                        <a class="btn btn-danger avisoAlertaxx" href="/turno/eliminar?id=<?php echo $turno->id; ?>&tipo=turno"><i class="fas fa-trash-alt"></i></a>

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