<?php  include 'Static/connect/db.php'?>
<?php
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
    <title>Consulta de medicamentos</title>
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





<div class="container containerCon" >
    <h2 style="color: black;">Consulta de medicamento</h2>

    
    
    
    <div class="search-bar " id="barraBusqueda">
        <form method="GET" action="">
            <input type="date"  id="fechaBusqueda" name="fechaBusqueda" placeholder="Nombre de usuario" >
            <button type="submit">🔍</button>
        </form>
    </div>

    
    <div class="table-responsive " id="tablaCitas">


    <!-- Tabla de usuarios -->
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nombre del medicamento</th>
            <th>Descripción</th>
            <th>Contenido del producto</th>
            <th>Fecha de caducidad</th>
            <th>Modificar</th>
            <th>Eliminar</th>
            
        </tr>
        <?php
        
            echo $Salida;
        ?>
    </table>
    
    </div>

    <?php include 'modalEliminarMedicamento.php'?>

    

    

    

</div>
    
    <script>

        let eliminaModal = document.getElementById('eliminaMedicamento')

        eliminaModal.addEventListener('shown.bs.modal', event =>{

            let button= event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            eliminaModal.querySelector('.modal-footer #id').value = id



        })

    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
   

    
</body>
</html>
