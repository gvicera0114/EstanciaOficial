<?php
$Tipo = $_SESSION['Tipo'];
$id = $_SESSION['idUsuario'];
$nombre = $_SESSION['Nombre'];
if (isset($_SESSION['Tipo']) && $Tipo == "admin") {
} else {
    header("Location:login.php");
}

   
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respaldo de Base de Datos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Tu archivo de estilos personalizado -->
    <link rel="stylesheet" href="Static/css/styles.css">
   
</head>
<body>
    <nav class="navbar navbar-expand-lg ">
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
        <h1 class="mb-4">Respaldo de Base de Datos</h1>
        <form action="index.php?accion=respaldoBD" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <button type="submit" name="action" value="download" class="btn btn-primary">Descargar Respaldo</button>
            </div>
            <div class="mb-3">
                <label for="backup_file" class="form-label">Cargar Respaldo</label>
                <input type="file" name="backup_file" id="backup_file" class="form-control" accept=".sql">
            </div>
            <div class="mb-3">
                <button type="submit" name="action" value="upload" class="btn btn-success">Cargar Respaldo</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>