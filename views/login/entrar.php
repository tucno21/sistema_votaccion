<!DOCTYPE html>
<!-- Coding by CodingLab | www.youtube.com/codinglabyt -->
<html lang="es" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Tu_Voto </title>
    <link rel="stylesheet" href="../login/style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="../login/images/frontImg.jpg" alt="">
                <div class="text">
                    <span class="text-1">Elecciones Municipales <br> Escolares 2022</span>
                    <span class="text-2">Tu voto cuenta</span>
                    <span class="text-2"></span>
                </div>
            </div>
            <div class="back">
                <img class="backImg" src="../login/images/backImg.jpg" alt="">
                <div class="text">
                    <span class="text-1">Solo personal Autorizado</span>
                    <span class="text-2">Panel administrativo</span>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Acceso</div>
                    <form method="post">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="far fa-address-card"></i>
                                <input type="number" name="dni" placeholder="DNI" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Entrar">
                            </div>
                            <div class="text sign-up-text">Panel <label for="flip">Administrativo</label></div>
                        </div>
                    </form>
                </div>
                <div class="signup-form">
                    <div class="title">Admin</div>
                    <form method="post">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Entrar">
                            </div>
                            <div class="text sign-up-text">Regreser a <label for="flip">Votar</label></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>