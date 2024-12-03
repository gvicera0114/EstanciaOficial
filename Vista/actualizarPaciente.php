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

            <h2 style="text-align: center;">Actualizar datos del doctor</h2>

            <form id="formPaciente" action="index.php?accion=actualizarPaciente&id=<?php echo $_GET['id']; ?>" class="tipo" method="post">
            <div  id="paciente" >
                <div class="mb-3">
                    <label for="nombrePaciente" class="form-label">Nombre</label>
                    <input
                    type="text"
                    class="form-control"
                    id="nombrePaciente"
                    name="nombrePaciente"
                    value="<?php echo $nombre;?>"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="apellidoPaternoPaciente" class="form-label">Apellido paterno</label>
                    <input
                    type="text"
                    class="form-control"
                    id="apellidoPaternoPaciente"
                    name="apellidoPaternoPaciente"
                    value="<?php echo $Apaterno;?>"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="apellidoMaternoPaciente" class="form-label">Apellido materno</label>
                    <input
                    type="text"
                    class="form-control"
                    id="apellidoMaternoPaciente"
                    name="apellidoMaternoPaciente"
                    value="<?php echo $Amaterno;?>"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <select class="form-select" id="genero" name="genero" required>
                        <option value="Masculino" <?php if($Genero == 'Masculino') echo 'selected'; ?>>Masculino</option>
                        <option value="Femenino" <?php if($Genero == 'Femenino') echo 'selected'; ?>>Femenino</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="matricula" class="form-label">Matricula</label>
                    <input
                    type="text"
                    class="form-control"
                    id="matricula"
                    name="matricula"
                    value="<?php echo $Matricula;?>"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="estadoCivil" class="form-label">Estado civil</label>
                    <select class="form-select" id="estadoCivil" name="estadoCivil" required>
                    <option selected value="Soltero(a)" <?php if($EstadoCivil == 'Soltero(a)') echo 'selected'; ?>>Soltero(a)</option>
                    <option value="Casado(a)" <?php if($EstadoCivil == 'Casado(a)') echo 'selected'; ?>>Casado(a)</option>
                    <option value="Divorciado(a)" <?php if($EstadoCivil == 'Divorciado(a)') echo 'selected'; ?>>Divorciado(a)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="carrera" class="form-label">Carrera</label>
                    <select class="form-select" id="carrera" name="carrera" required>
                        <?php
                        $sql = "SELECT * FROM carrera";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $selected = ($row["idCarrera"] == $carrera) ? "selected" : "";

                                echo "<option value='" . $row["idCarrera"] . "' $selected>" . $row["Nombre"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay carreras disponibles</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fechaNacimiento" class="form-label" >Fecha de nacimiento</label>
                    <input
                    type="date"
                    class="form-control"
                    id="fechaNacimiento"
                    name="fechaNacimiento"
                    value="<?php echo $FechaNac;?>"
                    onchange="obtenerFecha(this)"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input
                    type="text"
                    class="form-control"
                    id="contrasenia"
                    name="contrasenia"
                    value="<?php echo $Contrasenia;?>"
                    required
                    />
                </div>

                <button name="actualizarPaciente" type="submit" class="btn-Registrar btn btn-success">
                Actualizar
                </button>
                <a href="index.php?accion=consultarUsuarios" class="btn btn-secondary">Regresar</a>

                

            </div>

        </form>

        </div>


        <script src="Static/js/formulario.js"></script>
    
</body>
</html>