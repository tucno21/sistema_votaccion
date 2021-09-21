<?php
// resetSession();
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu voto</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../backendAL/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Favicons -->
    <meta name="theme-color" content="#7952b3">

    <style>
        .tamaño {
            font-size: 1.4rem;
            outline: none;
            border: none;
            display: inline-block;
            width: 30rem;
            padding: 5% 1% 1% 1%;
        }

        .color-fondo {
            background-color: <?php echo $colegio[0]->color_b; ?>;
        }

        .color-bot {
            background-color: <?php echo $colegio[0]->color_b; ?>;
            border: 1px solid <?php echo $colegio[0]->color_b; ?>;
        }

        .color-bot:hover {
            background-color: <?php echo $colegio[0]->color_s; ?>;
            border: 1px solid <?php echo $colegio[0]->color_s; ?>;
        }

        .color-footer {
            background-color: <?php echo $colegio[0]->color_s; ?>;
        }
    </style>
</head>

<body>
    <header>
        <div class="shadow-sm color-fondo">
            <div class="container ">
                <p class="pt-1 pb-2 text-center text-white">
                    <strong>Institución Educativa <?php echo $colegio[0]->name_ie; ?></strong>
                </p>
            </div>
        </div>
    </header>

    <main>

        <section class="container py-3 text-center">
            <div class="row py-lg-3">
                <div class="mx-auto col-lg-6 col-md-8">
                    <h1 class="fw-light">Bienvenido: <?php echo $_SESSION['name']; ?></h1>
                    <p class="lead text-muted">Elige al alcalde o alcaldeza escolar para el siguiente año, tu voto vale mucho y vota a conciencia</p>

                </div>
            </div>
            <?php
            if (isset($errores)) {
                foreach ($errores as $error) :
            ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
            <?php
                endforeach;
            }
            ?>
        </section>

        <div class="py-5 album bg-light">
            <div class="container">
                <form method="POST">

                    <?php foreach ($candidatos as $cand) : ?>
                        <div class="row">
                            <div class="border col-6 border-secondary d-flex justify-content-center">
                                <input type="radio" class="btn-check" name="eligio[canditatoId]" id="<?php echo $cand->id; ?>" autocomplete="off" value="<?php echo $cand->id; ?>">
                                <label class="btn btn-outline-dark text-uppercase tamaño" for="<?php echo $cand->id; ?>"><?php echo $cand->group_name; ?></label>
                            </div>
                            <div class="border col-3 border-secondary d-flex justify-content-center">
                                <label for="<?php echo $cand->id; ?>">
                                    <img width="100" class="img-thumbnail" src="../imagenes/<?php echo $cand->logo; ?>" alt="foto">
                                </label>
                            </div>
                            <div class="border col-3 border-secondary d-flex justify-content-center">
                                <label for="<?php echo $cand->id; ?>">
                                    <img width="100" class="img-thumbnail" src="../imagenes/<?php echo $cand->photo; ?>" alt="foto">
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <input type="hidden" name="eligio[id]" value="<?php echo $_SESSION['id']; ?>">

                    <div class="mt-5 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary color-bot" style="width: 18rem;">Votar</button>
                    </div>

                </form>
            </div>
        </div>

    </main>

    <footer class="py-4 text-muted color-footer">
        <div class="container text-white">
            <p class="mb-1">Desarrollador web: Carlos tucno Vasquez</p>
        </div>
    </footer>
    <script src="../backendAL/plugins/jquery/jquery.min.js"></script>
    <script src="../backendAL/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- <script src="../backendAL/js/alertavoto.js"></script> -->
</body>

</html>