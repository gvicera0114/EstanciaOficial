<?php  include 'static/connect/db.php'?>
<?php

    
    $Tipo = $_SESSION['Tipo'];
    $idUsuario= $_SESSION['idUsuario'];
    $nombre = $_SESSION['Nombre'];

    if(isset($_SESSION['Tipo'] ) && $Tipo=="Paciente"){
        
        ?>
        
        <?php
    }
    else
    {
        header("Location:login.php");
    }
    

   


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de cita</title>
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
                        <a class="nav-link" href="index.php?accion=consultarRecetas">Consultar Recetas</a>
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
        <div class="custom-container">
            <h2>Registro de Cita</h2>
            <form action="index.php?accion=InsertarCita" method="post">
                <div class="mb-3">
                    <label for="doctor" class="form-label">Doctor</label>
                    <select class="form-select" id="doctor" name="doctor" onchange="loadAvailableHours()" required>
                        <option value="">Seleccione un doctor</option>
                        <?php

                        $sql = "SELECT * FROM doctor";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["idDoctor"] . "'>" . $row["Nombre"] .  " Horario de atención (". substr($row["Horario_Atencion_I"], 0, 5) ."- " . substr($row["Horario_Atencion_F"], 0, 5). ")</option>";
                            }
                        } else {
                            echo "<option>No hay doctores disponibles</option>";
                        }

                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" onchange="loadAvailableHours()" required>
                </div>
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora</label>
                    <select class="form-select" id="hora" name="hora" required>
                        <option value="">Seleccione una hora</option>
                        <!-- Las horas disponibles se cargarán aquí -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="sintomas" class="form-label">¿Qué sintomas presenta?</label>
                    <input type="text" class="form-control" id="sintomas" name="sintomas"  onkeypress="return soloLetras(event)" required>
                </div>
                <div class="mb-3">
                    <label for="alergias" class="form-label">¿Cuenta con alergias?</label>
                    <input type="text" class="form-control" id="alergias" name="alergias" onkeypress="return soloLetras(event)" required>
                </div>
                <div class="mb-3">
                    <label for="medicamentos" class="form-label">¿Qué medicamentos actuales toma?</label>
                    <input type="text" class="form-control" id="medicamentos" name="medicamentos" onkeypress="return soloLetras(event)" required>
                </div>

                <div class="mb-3">
                    <label for="condicion" class="form-label">¿Alguna condición hereditaria?</label>
                    <input type="text" class="form-control" id="condicion" name="condicion" onkeypress="return soloLetras(event)" required>
                </div>

                <div class="mb-3">
                    <label for="dolor" class="form-label">¿En qué parte del cuerpo presenta el dolor?</label>
                    <input type="text" class="form-control" id="dolor" name="dolor" onkeypress="return soloLetras(event)" required>
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
                <button type="reset" class="btn btn-secondary">Cancelar</button>
            </form>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="Static/js/registroCitas.js"></script>
   
</body>
</html>
