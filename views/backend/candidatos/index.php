<?php
// resetSession();
if (!isset($_SESSION)) {
    session_start();
    $iniciarSesion = $_SESSION["iniciarSesion"];
    $tipo = $_SESSION["tipo"];
}

if (isset($_SESSION["iniciarSesion"]) && $iniciarSesion == "ok") {
    if ($tipo == 'Administrador' || $tipo == 'Director') {
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
                            <h1>Panel de Candidatos</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="card">
                    <div class="card-header">
                        <?php if ($tipo == 'Administrador') : ?>
                            <a class="btn btn-primary" href="/candidatos/crear">Agregar Candidato</a>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped dtr-inline dt-responsive tablaDataTable">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">N°</th>
                                    <th>Nombre</th>
                                    <th>DNI</th>
                                    <th>Foto</th>
                                    <th>Logo</th>
                                    <th>Nombre del Grupo</th>
                                    <th>Estado</th>
                                    <?php if ($tipo == 'Administrador') : ?>
                                        <th>Aciones</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $fila = 1;
                                foreach ($candidatos as $candidato) : ?>
                                    <tr>
                                        <td><?php echo $fila; ?></td>
                                        <td><?php echo $candidato->name; ?></td>
                                        <td><?php echo $candidato->dni; ?></td>

                                        <?php if ($candidato->photo == "") : ?>
                                            <td><img src="../backendAL/img/user.png" alt="avatar" class="img-thumbnail" width="40px"></td>
                                        <?php else : ?>
                                            <td><img src="../imagenes/<?php echo $candidato->photo; ?>" alt="avatar" class="img-thumbnail" width="40px"></td>
                                        <?php endif; ?>

                                        <?php if ($candidato->logo == "") : ?>
                                            <td><img src="../backendAL/img/voto.jpg"" alt=" avatar" class="img-thumbnail" width="40px"></td>
                                        <?php else : ?>
                                            <td><img src="../imagenes/<?php echo $candidato->logo; ?>" alt="avatar" class="img-thumbnail" width="40px"></td>
                                        <?php endif; ?>


                                        <td><?php echo $candidato->group_name; ?></td>

                                        <?php if ($candidato->estado != 0) : ?>
                                            <td>
                                                <p class="btn btn-success btn-xs">Activado</p>
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <p class="btn btn-danger btn-xs">Desactivado</p>
                                            </td>
                                        <?php endif; ?>

                                        <?php if ($tipo == 'Administrador') : ?>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-warning" href="/candidatos/actualizar?id=<?php echo $candidato->id; ?>"><i class="fa fa-edit"></i></a>

                                                    <a class="btn btn-danger avisoAlertaxx" href="/candidatos/eliminar?id=<?php echo $candidato->id; ?>&tipo=candidato"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </td>
                                        <?php endif; ?>
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
        header('Location: /dashboard');
    }
} else {
    header('Location: /');
}
?>