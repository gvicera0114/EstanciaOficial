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
                        <a class="nav-link" href="registroMedicamento.php">Registrar Medicamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="consultarMedicamentos.php">Consultar Medicamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reportesPDF.php">Generar Reportes PDF</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="respaldoBD.php">Respaldo Base de Datos</a>
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
        <h2>Registro de Usuario</h2>

        


        

        
            <div class="mb-3">
                <label for="tipoUsuario" class="form-label">Tipo de Usuario</label>
                <select class="form-select" id="tipoUsuario" name="tipoUsuario" required>
                    <option value="ninguno" selected>Ninguno</option>
                    <option value="doctor">Doctor</option>
                    <option value="paciente">Paciente</option>
                </select>
            </div>

        
        
        
        <form id="formDoctor" action="index.php?accion=registrarUsuarios" class="tipo inactive" method="post">

            <div id="doctor">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" required>
                </div>
                
                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <select class="form-select" id="genero" name="genero" required>
                        <option selected value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" required>
                </div>

                

                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" class="form-control" id="especialidad" name="especialidad" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Correo electrónico</label>
                    <input type="text" class="form-control" id="correo" name="correo" required>
                </div>
                <div class="mb-3">
                    <label for="horas" class="form-label">Horario de Atención</label>
                    <input type="time" class="form-control" id="horas" name="horas" required>
                </div>

                <div class="mb-3">
                    <label for="horas" class="form-label">Horario de Atención final</label>
                    <input type="time" class="form-control" id="horasFinal" name="horasFinal" required>
                </div>

                <div class="mb-3">
                    <label for="fechaIngreso" class="form-label">Fecha de Ingreso</label>
                    
                    <input
                    type="date"
                    class="form-control"
                    id="fechaIngreso"
                    name="fechaIngreso"
                    onchange="obtenerFecha(this)"
                    required
                    />
                </div>
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>


                    <button type="submit" class="btn-Registrar btn btn-success">
                    Registrar
                    </button>
                    <button type="reset" class="btn-Cancelar btn btn-danger">
                    Cancelar
                    </button>


                

            </div>

        </form>

        

        <form id="formPaciente" action="index.php?accion=registrarUsuarios" class="tipo inactive" method="post">
            <div  id="paciente" >
                <div class="mb-3">
                    <label for="nombrePaciente" class="form-label">Nombre</label>
                    <input
                    type="text"
                    class="form-control"
                    id="nombrePaciente"
                    name="nombrePaciente"
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
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="generoPaciente" class="form-label">Género</label>
                    <select class="form-select" id="generoPaciente" name="generoPaciente" required>
                    <option  value="Masculino" selected>Masculino</option>
                    <option  value="Femenino">Femenino</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="matricula" class="form-label">Matricula</label>
                    <input
                    type="text"
                    class="form-control"
                    id="matricula"
                    name="matricula"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="estadoCivil" class="form-label">Estado civil</label>
                    <select class="form-select" id="estadoCivil" name="estadoCivil" required>
                    <option selected value="Soltero(a)">Soltero(a)</option>
                    <option value="Casado(a)">Casado(a)</option>
                    <option value="Divorciado(a)">Divorciado(a)</option>
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
                                echo "<option value='" . $row["idCarrera"] . "'>" . $row["Nombre"] . "</option>";
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
                    required
                    />
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
    
    <script src="Static/js/formulario.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
