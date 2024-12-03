<?php
include 'Static/connect/db.php';

$Tipo = $_SESSION['Tipo'];
$id = $_SESSION['idUsuario'];
$nombre = $_SESSION['Nombre'];

if (isset($_SESSION['Tipo']) && $Tipo == "admin") {
    // Usuario autenticado
} else {
    header("Location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Static/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="Static/img/upemor_logo.png" alt="Logo" width="50">
                <span class="ms-2">Usuario: <?php echo $nombre; ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
        <h1 class="mb-4">Bienvenido Administrador</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Registrar Usuarios</h5>
                        <p class="card-text">Añade nuevos usuarios al sistema.</p>
                        <a href="index.php?accion=registrarUsuarios" class="btn btn-primary">Registrar Usuarios</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Consultar Usuarios</h5>
                        <p class="card-text">Revisa los usuarios registrados en el sistema.</p>
                        <a href="index.php?accion=consultarUsuarios" class="btn btn-primary">Consultar Usuarios</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Registrar Medicamentos</h5>
                        <p class="card-text">Añade nuevos medicamentos al sistema.</p>
                        <a href="index.php?accion=registroMedicamento" class="btn btn-primary">Registrar Medicamentos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Consultar Medicamentos</h5>
                        <p class="card-text">Revisa los medicamentos registrados en el sistema.</p>
                        <a href="index.php?accion=consultarMedicamento" class="btn btn-primary">Consultar Medicamentos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Generar Reportes PDF</h5>
                        <p class="card-text">Genera reportes en formato PDF.</p>
                        <a href="index.php?accion=reportesPDF" class="btn btn-primary">Generar Reportes PDF</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Respaldo Base de Datos</h5>
                        <p class="card-text">Realiza un respaldo de la base de datos.</p>
                        <a href="index.php?accion=respaldoBD" class="btn btn-primary">Respaldo Base de Datos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>