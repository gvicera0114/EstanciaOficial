<?php  include 'Static/connect/db.php'?>
<?php
    $Tipo = $_SESSION['Tipo'];
    $id=$_SESSION['idUsuario'];
    $nombre=$_SESSION['Nombre'];

    if(isset($_SESSION['Tipo'] ) && $Tipo=="Doctor"){
    
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
    <title>Consulta de Receta</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
     <!-- Tu archivo de estilos personalizado -->
     <link rel="stylesheet" href="Static/css/styles.css">
</head>
<body>
    
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="Static/img/upemor_logo.png" alt="Logo" width="50">
                <span class="ms-5">Doctor: <?php echo $nombre; ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center ms-5" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item ms-5">
                        <a class="nav-link" href="index.php?accion=consultarCitas">Citas del día</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=consultarRecetas">Consultar Recetas</a>
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



<div class="container-fluid containerCon"  >
    <h2 style="color: black;">Consulta de recetas</h2>

    
    
    
    <div class="search-bar " id="barraBusqueda">
        <form method="GET" action="">
            <input type="date"  id="fechaBusqueda" name="fechaBusqueda" placeholder="Nombre de usuario" >
            <button type="submit">🔍</button>
        </form>
    </div>

    
    <div class="table-responsive " id="tablaCitas">


    <!-- Tabla de usuarios -->
    <table class="table w-100">
        <tr>
            <th>Nombre del Paciente</th>
            <th>Fecha de Emisión</th>
            <th>Tensión Arterial</th>
            <th>Frecuencia Cardíaca</th>
            <th>Frecuencia Respiratoria</th>
            <th>Temperatura</th>
            <th>Diagnóstico</th>
            <th>Medicamento</th>
            <th>Dosis</th>
            <th>Horario</th>
            <th>Recomendación del Doctor</th>
            <th>Observaciones del Doctor</th>
            <th>Modificar</th>
            <th>Eliminar</th>

        </tr>
        <?php
        
        echo $Salida;
        
        ?>
    </table>
    
    </div>

    <?php include 'modalEliminarReceta.php'?>
    <?php include 'modalModificarReceta.php'?>

    

    

    

</div>
    
    <script>

        let eliminaModal = document.getElementById('eliminaReceta')

        eliminaModal.addEventListener('shown.bs.modal', event =>{

            let button= event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            eliminaModal.querySelector('.modal-footer #id').value = id
        })


        let editarModal = document.getElementById("recetaModificar");
        

        
        // Detener el intervalo cuando el modal se muestra
        editarModal.addEventListener("shown.bs.modal", (event) => {
        
        let button = event.relatedTarget;
        let id = button.getAttribute("data-bs-id");
        let inputId = editarModal.querySelector(".modal-body #id");
        let inputFrecuenciaCardiaca = editarModal.querySelector(".modal-body #FC");
        let inputFrecuenciaRespiratoria = editarModal.querySelector(".modal-body #FR");
        let inputTensionArterial = editarModal.querySelector(
            ".modal-body #TC"
        );
        let inputTemperatura = editarModal.querySelector(
            ".modal-body #temp"
        );
        
        let inputDiagnostico = editarModal.querySelector(".modal-body #diagnostico");
        let inputMedicamento = editarModal.querySelector(".modal-body #medicamento");
        let inputDosis = editarModal.querySelector(".modal-body #dosis");
        let inputAdministracion = editarModal.querySelector(".modal-body #horario");
        let inputRecomendacion = editarModal.querySelector(".modal-body #reco");
        let inputNota = editarModal.querySelector(".modal-body #nota");


        let url = "Controlador/getReceta.php";
        let formData = new FormData();
        formData.append("id", id);
        fetch(url, {
            method: "POST",
            body: formData,
        })
            .then((Response) => Response.json())
            .then((data) => {
                console.log(data);
                inputFrecuenciaCardiaca.value = data.receta.Frecuencia_Cardiaca;
                inputFrecuenciaRespiratoria.value = data.receta.Frecuencia_Respiratoria;
                inputTensionArterial.value = data.receta.Tension_Arterial;
                inputTemperatura.value = data.receta.Temperatura;
                inputMedicamento.value = data.prescripcion.Medicamento_idMedicamento;
                inputDosis.value = data.prescripcion.Dosis;
                inputAdministracion.value = data.prescripcion.Horario;
                inputRecomendacion.value = data.receta.Recomendacion_Doctor;
                inputNota.value = data.receta.Nota_Doctor;
                inputDiagnostico.value = data.receta.Diagnostico;
                inputId.value = id;
                
            
            
            
            })
            .catch((err) => console.log(err));
        });

    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
   

    
</body>
</html>
