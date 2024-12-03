<?php
include 'Modelo/Recetas.php';
include 'Modelo/Paciente.php';



class C_Doctor {
    private $model;
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function acciones() {
        $action = isset($_GET['accion']) ? $_GET['accion'] : '';
        
        switch ($action) {
            case 'consultarCitas':
                $this->consultarCitas();
                break;
            case 'consultarRecetas':
                $this->consultarRecetas();
                break;
            case 'eliminarReceta':
                $this->eliminarReceta();
                break;
            case 'registrarReceta':
                $this->registrarReceta();
                break;
                
            case 'actualizarReceta':
                $this->actualizarReceta();
                break;
            default:
                $this->showDashboard();
                break;
        }
    }

    private function showDashboard() {
        
        include 'Vista/dashboardDoctor.php';
    }

    private function consultarCitas() {
        
            
        include 'Vista/consultaCitaDoctor.php';
    }

    private function consultarRecetas() {

        //Declaramos los modelos a utilizar
        $idDoctor = $_SESSION['idUsuario'];
        $MCita = new Cita($this->conn);
        $MReceta = new Receta($this->conn);
        $MDoctor = new Doctor($this->conn);
        $MPaciente = new Paciente($this->conn);
        $MPrescripcion = new Prescripcion($this->conn);
        $MMedicamento = new Medicamentos($this->conn);

        $Salida="";

        //Obtenemos las citas del doctor
        $CitasDoc = $MCita->ContsultarCitasDoctor($idDoctor);


        //Recorremos las citas
        while($rowCitas = $CitasDoc->fetch_assoc()){


            $Paciente=$MPaciente->ConsultarPaciente($rowCitas['Paciente_idPaciente']);
            $Doctor=$MDoctor->ConsultarDoctores($rowCitas['Doctor_idDoctor']);
            $Receta=$MReceta->obtenerTodasRecetaId($rowCitas['idCita']);


            while($RowReceta = $Receta->fetch_assoc()){

                $ResultPrescripcion = $MPrescripcion->obtenerPrescripcionId($RowReceta['idReceta']);
                $ResultMedicamento = $MMedicamento->ConsultarMedicamento($ResultPrescripcion['Medicamento_idMedicamento']);

                $Salida.="<tr>";
                $Salida.="<td>".$Paciente['Nombre']." </td>";
                $Salida.="<td>".$RowReceta['Fecha_Emision']."</td>";
                
                $Salida.="<td>".$RowReceta['Tension_Arterial']."</td>";
                
                $Salida.="<td>".$RowReceta['Frecuencia_Cardiaca']."</td>";
                $Salida.="<td>".$RowReceta['Frecuencia_Respiratoria']."</td>";
                
                $Salida.="<td>".$RowReceta['Temperatura']."</td>";
                $Salida.="<td>".$RowReceta['Diagnostico']."</td>";
                
                $Salida.="<td>".$ResultMedicamento['Nombre']."</td>";
                $Salida.="<td>".$ResultPrescripcion['Dosis']."</td>";
                $Salida.="<td>".$ResultPrescripcion['Horario']."</td>";
                $Salida.="<td>".$RowReceta['Recomendacion_Doctor']."</td>";
                
                $Salida.="<td>".$RowReceta['Nota_Doctor']."</td>";
                $Salida.="<td><a class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#recetaModificar' data-bs-id='" . $RowReceta["idReceta"] . "' >Modificar</a>
                            </td>";
                $Salida.="<td><a href='#' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminaReceta' data-bs-id='" . $RowReceta["idReceta"] . "' >Eliminar</a>
                           </td>";




            }

        }
        


        
        include 'Vista/consultarRecetas.php';
    }


    private function eliminarReceta() {
        
        $Receta = new Receta($this->conn);
        $idReceta = $_POST['id'];

        $Receta->eliminarReceta($idReceta);

        header("Location: index.php?accion=consultarRecetas");
  
    }


    public function registrarReceta(){

        $MReceta= new Receta($this->conn);
        $MPrescripcion= new Prescripcion($this->conn);
        $MCita= new Cita($this->conn);

            
        $idCita= $this->conn->real_escape_string($_POST['id']);
        $Nota_Doctor=$_POST['nota'];
        $FrecuenciaCardiaca=$_POST['FC'];
        $FrecuenciaRespiratoria=$_POST['FR'];
        $TensionArterial=$_POST['TC'];
        $Temperatura=$_POST['temp'];
        $Diagnostico=$_POST['diagnostico'];
        $Medicamento=$_POST['medicamento'];
        $Dosis=$_POST['dosis'];
        $Horario=$_POST['horario'];
        $Recomendaciones=$_POST['reco'];

        $idReceta=$MReceta->InsertarReceta($Recomendaciones,$Nota_Doctor,$TensionArterial,$FrecuenciaCardiaca,$FrecuenciaRespiratoria,$Temperatura,$Diagnostico,$idCita);

        if ($Medicamento != 1) {

            $MPrescripcion->InsertarPrescripcion($idReceta,$Medicamento,$Dosis,$Horario);
            
        }else{
            
            $MPrescripcion->InsertarPrescripcion($idReceta, $Medicamento, "Ninguno", "Ninguno");

    
        }


        $MCita->ActualizarCitaEstado($idCita);



        header("Location: index.php?accion=consultarCitas");





    }



    public function actualizarReceta(){

        
        $MReceta= new Receta($this->conn);
        $MPrescripcion= new Prescripcion($this->conn);

        $idReceta= $_POST['id'];
        $Nota_Doctor=$_POST['nota'];
        $FrecuenciaCardiaca=$_POST['FC'];
        $FrecuenciaRespiratoria=$_POST['FR'];
        $TensionArterial=$_POST['TC'];
        $Temperatura=$_POST['temp'];
        $Diagnostico=$_POST['diagnostico'];
        $Medicamento=$_POST['medicamento'];
        $Dosis=$_POST['dosis'];
        $Horario=$_POST['horario'];
        $Recomendaciones=$_POST['reco'];


        $MReceta->ActualizarReceta($idReceta,$Recomendaciones,$Nota_Doctor,$TensionArterial,$FrecuenciaCardiaca,$FrecuenciaRespiratoria,$Temperatura,$Diagnostico);

        if ($Medicamento != 1) {

            $MPrescripcion->ActualizarPrescripcion($idReceta,$Medicamento,$Dosis,$Horario);

        }else{
                
            $MPrescripcion->ActualizarPrescripcion($idReceta, $Medicamento, "Ninguno", "Ninguno");
    
        }


        
        header("Location: index.php?accion=consultarRecetas");

    }
}


?>