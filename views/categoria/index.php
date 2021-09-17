<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Categoria Para usuarios</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary" href="/categorias/crear">Agregar Categoria</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped dtr-inline dt-responsive tablaDataTable">
                    <thead>
                        <tr>
                            <th style="width: 10px;">N°</th>
                            <th>Categoria</th>
                            <th>Aciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $fila = 1;
                        foreach ($categories as $category) : ?>
                            <tr>
                                <td><?php echo $fila; ?></td>
                                <td><?php echo $category->category; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-warning" href="/categorias/actualizar?id=<?php echo $category->id; ?>"><i class="fa fa-edit"></i></a>

                                        <a class="btn btn-danger avisoAlertaxx" href="/categorias/eliminar?id=<?php echo $category->id; ?>&tipo=categoria"><i class="fas fa-trash-alt"></i></a>

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