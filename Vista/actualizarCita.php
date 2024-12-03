<?php  include 'static/connect/db.php'?>
<?php

    $Tipo = $_SESSION['Tipo'];
    $idUsuario= $_SESSION['idUsuario'];

    if(isset($_SESSION['Tipo'] ) && $Tipo=="Paciente"){
        
        ?>
        
        <?php
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
    <title>Actualizar de cita</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Tu archivo de estilos personalizado -->
    <link rel="stylesheet" href="Static/css/styles.css">
</head>
<body>
            <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboardPaciente.php">
                    <img src="Static/img/upemor_logo.png" alt="Bootstrap" width="50" >
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    
                    <a class="nav-link" href="#">Perfil</a>
                    <a class="nav-link" href="logout.php">Cerrar sesion</a>
                    
                </div>
                </div>
            </div>
            </nav>

    <div class="container mt-5">
        <div class="custom-container">
            <h2>Actualizar Cita</h2>
            <form action="index.php?accion=actualizarCita&id=<?php echo $_GET['id'];?>" method="post">
                <div class="mb-3">
                    <label for="doctor" class="form-label">Doctor</label>
                    <select class="form-select" id="doctor" name="doctor" onchange="loadAvailableHours()" required>
                        <option value="">Seleccione un doctor</option>
                        <?php

                        $sql = "SELECT * FROM doctor";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $selected = ($row["Nombre"] == $NombreDoctor) ? "selected" : "";
                                echo "<option value='" . $row["idDoctor"] . "'$selected>" . $row["Nombre"] .  " Horario de atención (". substr($row["Horario_Atencion_I"], 0, 5) ."- " . substr($row["Horario_Atencion_F"], 0, 5). ")</option>";
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
                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $FechaCita;?>" onchange="loadAvailableHours()" required>
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
                    <input type="text" class="form-control" id="sintomas" name="sintomas" value="<?php echo $Sintomas;?>"  onkeypress="return soloLetras(event)" required>
                </div>
                <div class="mb-3">
                    <label for="alergias" class="form-label">¿Cuenta con alergias?</label>
                    <input type="text" class="form-control" id="alergias" name="alergias" value="<?php echo $Alergias;?>"  onkeypress="return soloLetras(event)" required>
                </div>
                <div class="mb-3">
                    <label for="medicamentos" class="form-label">¿Qué medicamentos actuales toma?</label>
                    <input type="text" class="form-control" id="medicamentos" name="medicamentos" value="<?php echo $Medicamentos;?>"  onkeypress="return soloLetras(event)" required>
                </div>

                <div class="mb-3">
                    <label for="condicion" class="form-label">¿Alguna condición hereditaria?</label>
                    <input type="text" class="form-control" id="condicion" name="condicion" value="<?php echo $Historial;?>"  onkeypress="return soloLetras(event)" required>
                </div>

                <div class="mb-3">
                    <label for="dolor" class="form-label">¿En qué parte del cuerpo presenta el dolor?</label>
                    <input type="text" class="form-control" id="dolor" name="dolor" value="<?php echo $Dolor;?>"  onkeypress="return soloLetras(event)" required>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="index.php?accion=consultarCitas" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>


    <script >

        function loadAvailableHours() {


            
        var doctorId = document.getElementById("doctor").value;
        var fecha = document.getElementById("fecha").value;
        if (doctorId && fecha) {
            fetch(`Controlador/cargarHoras.php?doctor_id=${doctorId}&fecha=${fecha}&hora=<?php echo $Hora; ?>`)
            .then((response) => response.text())
            .then((data) => {
                document.getElementById("hora").innerHTML = data;
            })
            .catch((error) => console.error("Error al cargar las horas:", error));
        }
        }

        document.addEventListener('DOMContentLoaded', loadAvailableHours);


        function soloLetras(event) {
            var key = event.keyCode || event.which;
            var tecla = String.fromCharCode(key).toLowerCase();
            var letras = "áéíóúabcdefghijklmnñopqrstuvwxyz";
            var especiales = [8, 37, 39, 46]; // Teclas de retroceso, izquierda, derecha y suprimir

            var tecla_especial = false;
            for (var i in especiales) {
                if (key == especiales[i]) {
                tecla_especial = true;
                break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }


    </script>
   
</body>
</html>
