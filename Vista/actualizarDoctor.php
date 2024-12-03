<?php  include 'Static/connect/db.php'?>
<?php


        

?>


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

            <form id="formDoctor" action="index.php?accion=actualizarDoctor&id=<?php echo $_GET['id'];?>"  method="POST" class="tipo">

            <div id="doctor">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" value="<?php echo $nombre;?>" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control" id="apellidoPaterno" value="<?php echo $Apaterno;?>"  name="apellidoPaterno" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control" id="apellidoMaterno"  value="<?php echo $Amaterno;?>" name="apellidoMaterno" required>
                </div>
                
                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <select class="form-select" id="genero" name="genero" required>
                        <option value="Masculino" <?php if($Genero == 'Masculino') echo 'selected'; ?>>Masculino</option>
                        <option value="Femenino" <?php if($Genero == 'Femenino') echo 'selected'; ?>>Femenino</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="text" class="form-control" id="cedula"  value="<?php echo $Cedula;?>" name="cedula" required>
                </div>

                

                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" class="form-control" id="especialidad"  value="<?php echo $Especialidad;?>" name="especialidad" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" value="<?php echo $Telefono;?>" name="telefono" required>
                </div>
                
                <div class="mb-3">
                    <label for="nombre" class="form-label">Correo electrónico</label>
                    <input type="text" class="form-control" id="correo" name="correo" value="<?php echo $Email;?>" required>
                </div>

                <div class="mb-3">
                    <label for="horas" class="form-label">Horario de Atención</label>
                    <input type="time" class="form-control" id="horas" value="<?php echo $Hr_I;?>" name="horas" required>
                </div>

                <div class="mb-3">
                    <label for="horas" class="form-label">Horario de Atención final</label>
                    <input type="time" class="form-control" id="horasFinal" value="<?php echo $Hr_F;?>" name="horasFinal" required>
                </div>

                <div class="mb-3">
                    <label for="fechaIngreso" class="form-label">Fecha de Ingreso</label>
                    
                    <input
                    type="date"
                    class="form-control"
                    id="fechaIngreso"
                    name="fechaIngreso"
                    value="<?php echo $FechaIngreso;?>"
                    onchange="obtenerFecha(this)"
                    required
                    />
                </div>
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" value="<?php echo $Usuario;?>" name="usuario" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="text" class="form-control" id="password" value="<?php echo $Contrasenia;?>" name="password" required>
                </div>


                    <button name="actualizarDoctor" type="submit" class="btn-Registrar btn btn-success">
                    Actualizar
                    </button>
                    <a href="index.php?accion=consultarUsuarios" class="btn btn-secondary">Regresar</a>



                

            </div>

        </form>

        </div>


        <script src="Static/js/formulario.js"></script>
    
</body>
</html>