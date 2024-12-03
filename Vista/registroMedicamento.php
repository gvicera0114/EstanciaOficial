<?php  include 'Static/connect/db.php'?>

<?php

    $Tipo = $_SESSION['Tipo'];
    $id=$_SESSION['idUsuario'];
    $nombre = $_SESSION['Nombre'];


    if(isset($_SESSION['Tipo'] ) && $Tipo=="admin"){
       
    }
    else
    {
        header("Location:index.php");
    }
    

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    
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
        <h2>Registro de medicamentos</h2>
        
        
        <form id="formMedicamento" action="index.php?accion=registroMedicamento" class="tipo" method="post">

            <div id="doctor">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="descripción" name="descripción" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Contenido</label>
                    <input type="text" class="form-control" id="contenido" name="contenido" required>
                </div>
                
                <div class="mb-3">
                    <label for="genero" class="form-label">Fecha de caducidad</label>
                    <input type="date" class="form-control" id="caducidad" name="caducidad" required>
                </div>

                    <button type="submit" class="btn-Registrar btn btn-success">
                    Registrar
                    </button>
                    <button type="reset" class="btn-Cancelar btn btn-danger">
                    Cancelar
                    </button>

            </div>

        </form>
        
    </div>

   <!-- Modal -->
   <div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="validationModalLabel">Error de Validación</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            La fecha de caducidad debe ser mayor a un año desde la fecha actual.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('formMedicamento').addEventListener('submit', function(event) {
            var caducidad = document.getElementById('caducidad').value;
            var fechaActual = new Date();
            var fechaCaducidad = new Date(caducidad);
            var unAnioDespues = new Date(fechaActual.setFullYear(fechaActual.getFullYear() + 1));

            if (fechaCaducidad <= unAnioDespues) {
                var validationModal = new bootstrap.Modal(document.getElementById('validationModal'));
                validationModal.show();
                event.preventDefault();
            }
        });
    </script>
        
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

