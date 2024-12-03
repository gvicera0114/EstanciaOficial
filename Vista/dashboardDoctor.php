<?php



$Tipo = $_SESSION['Tipo'];
$id = $_SESSION['idUsuario'];
$nombre = $_SESSION['Nombre'];

if (isset($_SESSION['Tipo']) && $Tipo == "Doctor") {
    // Usuario autenticado
} else {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Static/css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="Static/img/upemor_logo.png" alt="Logo" width="50">
                <span class="ms-5">Doctor: <?php echo $nombre; ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center ms-5" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item ms-5">
                        <a class="nav-link" href="index.php?accion=consultarCitas">Citas del día</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=consultarRecetas">Consultar Recetas</a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Bienvenido, Doctor <?php echo $nombre; ?></h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Ver citas del día</h5>
                        <p class="card-text">Revisa las consultas de tus citas médicas.</p>
                        <a href="index.php?accion=consultarCitas" class="btn btn-primary">Ver citas del día</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Consultar Recetas</h5>
                        <p class="card-text">Revisa las recetas médicas de tus pacientes.</p>
                        <a href="index.php?accion=consultarRecetas" class="btn btn-primary">Consultar Recetas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>