<div class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><?php echo $titlelogin; ?></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Iniciar Sesión</p>

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

                <form method="post">
                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control" placeholder="correo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>

                </form>

            </div>
            <!-- /.login-card-body -->


        </div>
    </div>
    <!-- /.login-box -->
</div>