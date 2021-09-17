<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Panel de Usuarios</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary" href="/usuarios/crear">Agregar Usuario</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped dtr-inline dt-responsive tablaDataTable">
                    <thead>
                        <tr>
                            <th style="width: 10px;">N°</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Ultimo Login</th>
                            <th>Aciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $fila = 1;
                        foreach ($users as $user) : ?>
                            <tr>
                                <td><?php echo $fila; ?></td>
                                <td><?php echo $user->name; ?></td>
                                <td><?php echo $user->email; ?></td>

                                <?php if ($user->photo == "") : ?>
                                    <td><img src="../adminLte/dist/img/user2-160x160.jpg" alt="avatar" class="img-thumbnail" width="40px"></td>
                                <?php else : ?>
                                    <td><img src="../imagenes/<?php echo $user->photo; ?>" alt="avatar" class="img-thumbnail" width="40px"></td>
                                <?php endif; ?>

                                <td><?php echo $user->category; ?></td>
                                <?php if ($user->estado != 0) : ?>
                                    <td>
                                        <p class="btn btn-success btn-xs">Activado</p>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <p class="btn btn-danger btn-xs">Desactivado</p>
                                    </td>
                                <?php endif; ?>

                                <td><?php echo $user->access_date; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-warning" href="/usuarios/actualizar?id=<?php echo $user->id; ?>"><i class="fa fa-edit"></i></a>

                                        <a class="btn btn-danger avisoAlertaxx" href="/usuarios/eliminar?id=<?php echo $user->id; ?>&tipo=user"><i class="fas fa-trash-alt"></i></a>


                                    </div>
                                </td>
                            </tr>
                        <?php
                            $fila++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                FOOTER
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->