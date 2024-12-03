<?php
$Tipo = $_SESSION['Tipo'];
$id = $_SESSION['idUsuario'];
$nombre = $_SESSION['Nombre'];

if (isset($_SESSION['Tipo']) && $Tipo == "Paciente") {
    // Usuario autenticado
} else {
    header("Location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Static/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="Static/img/upemor_logo.png" alt="Logo" width="50">
                <span class="ms-5">Usuario: <?php echo $nombre; ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center " id="navbarNav">
            <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link ms-5" href="index.php?accion=registroCita">Registrar Cita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=consultarCitas">Consultar Citas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=consultarRecetasPaciente">Consultar Recetas</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
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
        <h1 class="mb-4">Bienvenido, Alumno <?php echo $nombre; ?></h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Registrar Cita</h5>
                        <p class="card-text">Programa una nueva cita médica.</p>
                        <a href="index.php?accion=registroCita" class="btn btn-primary">Registrar Cita</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Consultar Citas</h5>
                        <p class="card-text">Revisa tus citas médicas programadas.</p>
                        <a href="index.php?accion=consultarCitas" class="btn btn-primary">Consultar Citas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Consultar Recetas</h5>
                        <p class="card-text">Revisa tus recetas médicas.</p>
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