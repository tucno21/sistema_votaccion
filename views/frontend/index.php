<?php
// debuguear(isset($_SESSION));
include '../views/frontend/head.php';

if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['iniciarSesion'] ?? false;

?>

<header class="site-header sticky-top py-1">
    <nav class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2" href="#" aria-label="Product">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24">
                <title>Product</title>
                <circle cx="12" cy="12" r="10" />
                <path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94" />
            </svg>
        </a>
        <?php if ($auth) : ?>
            <a class="py-2 d-none d-md-inline-block" href="/logout">cerrar sesion</a>
        <?php else : ?>
            <a class="py-2 d-none d-md-inline-block" href="/slogin">Iniciar sesion</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 fw-normal"> Bienvenido</h1>
            <p class="lead fw-normal">pagina de prueba</p>
            <?php if ($auth) : ?>
                <a class="btn btn-outline-secondary" href="/dashboard">Panel de control</a>
            <?php else : ?>
                <a class="btn btn-outline-secondary" href="/slogin">Iniciar sesion</a>
            <?php endif; ?>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>

</main>

<footer class="container py-5">
    <div class="row">
        Hola
    </div>
</footer>

<?php
include '../views/frontend/footer.php';
?>