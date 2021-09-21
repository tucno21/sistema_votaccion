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
                        <h1>Resultados Electorales</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo count($candidatos); ?></h3>

                            <p>Cant Candidatos</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="/candidatos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo count($estudiantes); ?></h3>

                            <p>Cant Estudiantes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <a href="/estudiantes" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo round(count($votos) / count($estudiantes) * 100, 2); ?>%</h3>

                            <p>Porcentaje de participatión</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-edit"></i>
                        </div>
                        <a href="#" class="small-box-footer">...</a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo (count($estudiantes) - count($votos)); ?></h3>

                            <p>Cant no votaron</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-question-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer">...</a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <div class="card">
                <div class="card-header">
                    <a href="/dashboard/excel" class="btn btn-success">Descargar resultados en Excel</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 col-12">
                            <?php
                            include 'graficos/resultadosBarras.php';
                            ?>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3><?php echo round($ganador->maximo / count($votos) * 100, 2); ?>%</h3>
                                    <h5>Cant votos : <?php echo $ganador->maximo; ?></h5>

                                    <p>Ganador: <?php echo $ganador->name; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <a href="#" class="small-box-footer">...</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">

                        </div>

                    </div>

                </div>


        </section>
        <!-- /.content -->
        </section>
    </div>

<?php
    include '../views/backend/component/AdminFooter.php';
} else {
    header('Location: /');
}
?>