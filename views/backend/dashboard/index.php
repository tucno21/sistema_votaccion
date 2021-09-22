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
                            <h3><?php echo $estudiantes != null ? round(count($votos) / count($estudiantes) * 100, 2) : ''; ?>%</h3>

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

                                    <h3><?php echo isset($ganador->maximo) ? round($ganador->maximo / count($votos) * 100, 2) : ''; ?>%</h3>

                                    <h5>Cant votos : <?php echo isset($ganador->maximo) ? $ganador->maximo : ''; ?></h5>

                                    <p>Ganador: <?php echo isset($ganador->name) ? $ganador->name : ''; ?></p>
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
    <script src="../backendAL/plugins/jquery/jquery.min.js"></script>
    <script src="../backendAL/plugins/chart.js/Chart.min.js"></script>
    <script>
        //===============================================
        var ticksStyle = {
            fontColor: '#17202A',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true


        var $salesChart = $('#sales-chart-resultados')
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart($salesChart, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                    if ($resultados != null) {
                        foreach ($resultados as $nombre => $cant) {
                            echo "'" . $nombre . "',";
                        }
                    } else {
                        echo "'0',";
                    }
                    ?>
                ],
                datasets: [{
                    // backgroundColor: '#007bff',
                    backgroundColor: '<?php echo $color->color_s; ?>',
                    borderColor: '<?php echo $color->color_b; ?>',
                    data: [
                        <?php
                        if ($resultados != null) {
                            foreach ($resultados as $nombre => $cant) {
                                echo "'" . $cant . "',";
                            }
                        } else {
                            echo "'0',";
                        }
                        ?>
                    ]
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,

                            // Include a dollar sign in the ticks
                            callback: function(value) {
                                if (value >= 1000) {
                                    value /= 1000
                                    value += 'k'
                                }

                                return '' + value
                            }
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
        //===============================================
    </script>

<?php
    include '../views/backend/component/AdminFooter.php';
} else {
    header('Location: /');
}
?>