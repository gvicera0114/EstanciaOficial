<?php  include 'Static/connect/db.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos</title>
        <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Tu archivo de estilos personalizado -->
    <link rel="stylesheet" href="Static/css/styles.css">


</head>
<body>

            <nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="login.php">
                        <img src="Static/img/upemor_logo.png" alt="Bootstrap" width="50" >
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        
                        <a class="nav-link" href="#">Perfil</a>
                        <a class="nav-link" href="#">Cerrar sesion</a>
                        
                    </div>
                    </div>
                </div>
            </nav>

            <div class="container mt-5">
        <h2>Actualizar de medicamentos</h2>
        
        
        <form id="formMedicamento" action="index.php?accion=actualizarMedicamento&id=<?php echo $_GET['id'];?>" class="tipo" method="post">

            <div id="doctor">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="descripción" name="descripción" value="<?php echo $Descripcion ?>" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Contenido</label>
                    <input type="text" class="form-control" id="contenido" name="contenido" value="<?php echo $Concentracion ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="genero" class="form-label">Fecha de caducidad</label>
                    <input type="date" class="form-control" id="caducidad" name="caducidad" value="<?php echo $Fecha ?>" required>
                </div>

                    <div class="d-flex justify-content-center">
                        <button name="actualizarMedicamento" type="submit" class="btn-Registrar btn btn-success mx-2">
                        Actualizar
                        </button>
                        <a href="index.php?accion=consultarMedicamento" class="btn btn-secondary">Regresar</a>

                    </div>

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


       
    
</body>
</html>