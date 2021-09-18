<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Aulas o salones de clase</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary" href="/aulas/crear">Agregar aula</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped dtr-inline dt-responsive tablaDataTable">
                    <thead>
                        <tr>
                            <th style="width: 10px;">N°</th>
                            <th>Salones</th>
                            <th>Aciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $fila = 1;
                        foreach ($aulas as $aula) : ?>
                            <tr>
                                <td><?php echo $fila; ?></td>
                                <td><?php echo $aula->gradosec; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-warning" href="/aulas/actualizar?id=<?php echo $aula->id; ?>"><i class="fa fa-edit"></i></a>

                                        <a class="btn btn-danger avisoAlertaxx" href="/aulas/eliminar?id=<?php echo $aula->id; ?>&tipo=aula"><i class="fas fa-trash-alt"></i></a>

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