<?php

$nombre = $_SESSION['Nombre'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Reportes en PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Static/css/styles.css">
</head>
<body><nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="Static/img/upemor_logo.png" alt="Logo" width="50">
                <span class="ms-2">Usuario: <?php echo $nombre; ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=registrarUsuarios">Registrar Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=consultarUsuarios">Consultar Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=registroMedicamento">Registrar Medicamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=consultarMedicamento">Consultar Medicamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=reportesPDF">Generar Reportes PDF</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=respaldoBD">Respaldo Base de Datos</a>
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
        <h1 class="mb-4">Generar Reportes en PDF</h1>
        <form action="index.php?accion=reportesPDF" method="post" target="_blank">
            <div class="mb-3">
                <label for="start_date" class="form-label">Fecha de Inicio</label>
                <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">Fecha de Fin</label>
                <input type="date" name="fechaFinal" id="fechaFinal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="report_type" class="form-label">Tipo de Reporte</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="Citas">Citas</option>
                    <option value="medicamentos">Medicamentos Más Utilizados</option>
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Generar Reporte</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>