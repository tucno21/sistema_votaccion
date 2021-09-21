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
    <div class="content-wrapper">

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
                    <table class="table table-bordered table-striped dtr-inline dt-responsive">
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
                                        <td><img src="../backendAL/img/user.png" alt="avatar" class="img-thumbnail" width="40px"></td>
                                    <?php else : ?>
                                        <td><img src="../imagenes/<?php echo $user->photo; ?>" alt="avatar" class="img-thumbnail" width="40px"></td>
                                    <?php endif; ?>

                                    <td><?php echo $user->rango; ?></td>
                                    <?php if ($user->estado != 0) : ?>
                                        <td>
                                            <p class="btn btn-success btn-xs">Activado</p>
                                        </td>
                                    <?php else : ?>
                                        <td>
                                            <p class="btn btn-danger btn-xs">Desactivado</p>
                                        </td>
                                    <?php endif; ?>

                                    <td><?php echo $user->date_access; ?></td>
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
    </div>

<?php
    include '../views/backend/component/AdminFooter.php';
} else {
    header('Location: /');
}
?>