<?php
include 'Modelo/Recetas.php';
include 'Modelo/Paciente.php';



class C_Doctor {
    private $model;
    private $conn;
    //Constructor
    public function __construct($conn) {
        $this->conn = $conn;
    }

    //Funciones de la clase 
    public function acciones() {
        $action = isset($_GET['accion']) ? $_GET['accion'] : '';
        
        //Switch para determinar la acción a realizar
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

    //Funcion mostrar panel del doctor
    private function showDashboard() {
        
        include 'Vista/dashboardDoctor.php';
    }

    //Funcion para consultar las citas del doctor
    private function consultarCitas() {
        
            
        include 'Vista/consultaCitaDoctor.php';
    }
    //Funcion para consultar las recetas del doctor
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

            //Obtenemos los datos del paciente y del doctor
            $Paciente=$MPaciente->ConsultarPaciente($rowCitas['Paciente_idPaciente']);
            $Doctor=$MDoctor->ConsultarDoctores($rowCitas['Doctor_idDoctor']);
            $Receta=$MReceta->obtenerTodasRecetaId($rowCitas['idCita']);

            //Recorremos las recetas
            while($RowReceta = $Receta->fetch_assoc()){
                //Obtenemos los datos de la prescripcion y del medicamento
                $ResultPrescripcion = $MPrescripcion->obtenerPrescripcionId($RowReceta['idReceta']);
                $ResultMedicamento = $MMedicamento->ConsultarMedicamento($ResultPrescripcion['Medicamento_idMedicamento']);
                //Creamos la tabla con los datos
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

    //Funcion para eliminar una receta
    private function eliminarReceta() {
        //Declaramos el modelo a utilizar
        $Receta = new Receta($this->conn);
        $idReceta = $_POST['id'];
        //Eliminamos la receta
        $Receta->eliminarReceta($idReceta);

        header("Location: index.php?accion=consultarRecetas");
  
    }

    //Funcion para registrar una receta
    public function registrarReceta(){
            //Declaramos los modelos a utilizar
        $MReceta= new Receta($this->conn);
        $MPrescripcion= new Prescripcion($this->conn);
        $MCita= new Cita($this->conn);

           //Obtenemos los datos de la receta 
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
        //Insertamos la receta
        $idReceta=$MReceta->InsertarReceta($Recomendaciones,$Nota_Doctor,$TensionArterial,$FrecuenciaCardiaca,$FrecuenciaRespiratoria,$Temperatura,$Diagnostico,$idCita);
        //Insertamos la prescripcion
        if ($Medicamento != 1) {//Si el medicamento es diferente de 1
            //Insertamos la prescripcion
            $MPrescripcion->InsertarPrescripcion($idReceta,$Medicamento,$Dosis,$Horario);
            
        }else{//Si el medicamento es igual a 1
            //Insertamos la prescripcion
            $MPrescripcion->InsertarPrescripcion($idReceta, $Medicamento, "Ninguno", "Ninguno");

    
        }

        //Actualizamos el estado de la cita
        $MCita->ActualizarCitaEstado($idCita);



        header("Location: index.php?accion=consultarCitas");





    }


    //Funcion para actualizar una receta
    public function actualizarReceta(){

        //Declaramos los modelos a utilizar
        $MReceta= new Receta($this->conn);
        $MPrescripcion= new Prescripcion($this->conn);
        //Obtenemos los datos de la receta
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

        //Actualizamos la receta
        $MReceta->ActualizarReceta($idReceta,$Recomendaciones,$Nota_Doctor,$TensionArterial,$FrecuenciaCardiaca,$FrecuenciaRespiratoria,$Temperatura,$Diagnostico);
        //Actualizamos la prescripcion
        if ($Medicamento != 1) {

            $MPrescripcion->ActualizarPrescripcion($idReceta,$Medicamento,$Dosis,$Horario);

        }else{
                
            $MPrescripcion->ActualizarPrescripcion($idReceta, $Medicamento, "Ninguno", "Ninguno");
    
        }


        //Redireccionamos a la vista de consultar recetas
        header("Location: index.php?accion=consultarRecetas");

    }
}


?>