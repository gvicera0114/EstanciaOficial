<?php

    include 'Modelo/Citas.php';
    include 'Modelo/Cuestionario.php';
    include 'Modelo/Doctor.php';
    include 'Modelo/Prescripcion.php';
    include 'Modelo/Medicamento.php';


    class C_Paciente{

        private $conn;


        public function __construct($db){
            $this->conn = $db;
        }


        public function acciones(){
            $action = isset($_GET['accion']) ? $_GET['accion'] : '';

            switch ($action) {
                case 'registroCita':
                    $this->registroCita();
                    break;
                case 'consultarCitas':
                    $this->consultarCitas();
                    break;
                case 'consultarRecetas':
                    $this->consultarRecetas();
                    break;
                case 'InsertarCita':
                    $this->InsertarCita();
                    break; 
                    
                case 'actualizarCita':
                    $this->ActualizarCita();
                    break;
                    
                case 'eliminarCita':
                    $this->eliminarCita();
                    break;
                
                default:
                    $this->mostrarInicio();
                    break;
            }
        }

        private function mostrarInicio(){
            
            include 'Vista/dashboardPaciente.php';
        }

        private function registroCita(){
            
            include 'Vista/registroCita.php';
        }

        private function consultarRecetas(){

            //Creamos un modelo para poder consultar las recetas
            $MCitas= new Cita($this->conn);
            $MRecetas= new Receta($this->conn);
            $MDoctor= new Doctor($this->conn);
            $MPrescripcion= new Prescripcion($this->conn);
            $MMedicamento= new Medicamentos($this->conn);

            $Salida="";

            $ResultCitas=$MCitas->ConsultarCitas($_SESSION['idUsuario']);
            //Mostramos la vista de consultar recetas
            if($ResultCitas->num_rows > 0){
                
                while($row = $ResultCitas->fetch_assoc()){

                    
                    
                    if($row['Estado_Cita']=="Atendida"){

                    //Recuperamos la informacion de la receta
                    $ResultReceta=$MRecetas->obtenerRecetaId($row['idCita']);
                    $ResultPrescripcion=$MPrescripcion->obtenerPrescripcionId($ResultReceta['idReceta']);
                    $ResultDoctor=$MDoctor->ConsultarDoctores($row['Doctor_idDoctor']);
                    $ResultMedicamento=$MMedicamento->nomMedicamento($ResultPrescripcion['Medicamento_idMedicamento']);




                    //Mostramos la informacion de la receta
                    $Salida.="<tr>";
                    $Salida.="<td>".$ResultReceta['idReceta']."</td>";
                    $Salida.="<td>".$ResultDoctor['Nombre']."</td>";
                    $Salida.="<td>".$ResultReceta['Fecha_Emision']."</td>";
                    $Salida.="<td>".$ResultReceta['Diagnostico']."</td>";
                    $Salida.="<td>".$ResultMedicamento['Nombre']."</td>";
                    $Salida.="<td>".$ResultPrescripcion['Dosis']."</td>";
                    $Salida.="<td>".$ResultPrescripcion['Horario']."</td>";
                    $Salida.="</tr>";

                    }


                }
            }

            include 'Vista/consultarRecetaPaciente.php';

        }


        private function consultarCitas(){

            //Creamos un modelo para poder consultar las citas
            $MCitas= new Cita($this->conn);
            $MCuestionario= new Cuestionario($this->conn);
            $MDoctor= new Doctor($this->conn);
            $idUsuario= $_SESSION['idUsuario'];

            $Salida="";

            $ResultCitas=$MCitas->ConsultarCitas($idUsuario);
            //Mostramos la vista de consultar citas
            while($row = $ResultCitas->fetch_assoc()){
                //Recuperamos la informacion de la cita y el cuestionario
                $ResultCuestionario=$MCuestionario->ConsultarCuestionario($row['idCita']);
                $ResultDoctor=$MDoctor->ConsultarDoctores($row['Doctor_idDoctor']);

                //Mostramos la informacion de la cita y el cuestionario
                $Salida.="<tr>";
                $Salida.="<td>".$row['idCita']."</td>";
                $Salida.="<td>".$ResultDoctor['Nombre']."</td>";
                $Salida.="<td>".$row['Fecha_Cita']."</td>";
                $Salida.="<td>".$row['Hora']."</td>";
                $Salida.="<td>".$row['Estado_Cita']."</td>";
                $Salida.="<td>".$row['motivo_cancelacion']."</td>";
                $Salida.="<td>".$ResultCuestionario['Sintomas']."</td>";
                $Salida.="<td>".$ResultCuestionario['Alergias']."</td>";
                $Salida.="<td>".$ResultCuestionario['Medicamentos_Actuales']."</td>";
                $Salida.="<td>".$ResultCuestionario['Historial_Medico']."</td>";

                if($row['Estado_Cita']=="Pendiente"){
                $Salida.="<td>".$ResultCuestionario['Lugar_Dolor']."</td>";
                $Salida.="<td><a class='btn btn-primary' href='index.php?accion=actualizarCita&id=".$row['idCita']."'>Modificar</a></td>";
                $Salida.="<td><a href='#' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalCancelar' data-bs-id='".$row['idCita']."'>Cancelar</a></td>";
                $Salida.="</tr>";

                }else{

                    $Salida.="<td>".$ResultCuestionario['Lugar_Dolor']."</td>";
                    $Salida.="<td></td>";
                    $Salida.="<td></td>";
                    $Salida.="</tr>";
                }
                





            }



            
            
            
            include 'Vista/consultarCitaPaciente.php';
        }


        private function InsertarCita(){

             //Creamos modelos para poder insertar la cita y el cuestionario
            $MCitas= new Cita($this->conn);
            $MCuestionario= new Cuestionario($this->conn);
            //Informacion de la cita recuperada
            $idDoctor=$_POST['doctor'];
            $FechaCita=$_POST['fecha'];
            $Hora=$_POST['hora'];
            //Insertamos la cita
            $idCita= $MCitas->InsertarCita($idDoctor,$FechaCita,$Hora,$_SESSION['idUsuario']);
            //Informacion del cuestionario Recuperada
            $Sintomas=$_POST["sintomas"];
            $Alergias=$_POST["alergias"];
            $Medicamentos=$_POST["medicamentos"];
            $Historial=$_POST["condicion"];
            $Dolor=$_POST["dolor"];

            //Insertamos el cuestionario
            $idCuestionario= $MCuestionario->InsertarCuestionario($Sintomas,$Alergias,$Medicamentos,$Historial,$Dolor);

            //Insertamos la relacion entre la cita y el cuestionario
            $MCitas->InsertarCitaCuestionario($idCita,$idCuestionario);
            //Redireccionamos a la pagina de registro de cita
            header("Location: index.php?accion=registroCita");




        }


        private function ActualizarCita(){
            //Recuperamos el id de la cita
            $id=$_GET['id'];
            //Creamos modelos para poder actualizar la cita y el cuestionario
            $MCitas= new Cita($this->conn);
            $MDoctor= new Doctor($this->conn);
            $MCuestionario= new Cuestionario($this->conn);
            //Recuperamos la informacion de la cita y el cuestionario
            $Cita= $MCitas->ConsultarCita($id);
            $Cuestionario= $MCuestionario->ConsultarCuestionario($id);
            $Doctor= $MDoctor->ConsultarDoctores($Cita['Doctor_idDoctor']);

            //Informacion de la cita
            $NombreDoctor= $Doctor["Nombre"];
            $FechaCita= $Cita['Fecha_Cita'];
            $Hora= $Cita['Hora'];

            //Informacion del cuestionario
            $Sintomas=$Cuestionario["Sintomas"];
            $Alergias=$Cuestionario["Alergias"];
            $Medicamentos=$Cuestionario["Medicamentos_Actuales"];
            $Historial=$Cuestionario["Historial_Medico"];
            $Dolor=$Cuestionario["Lugar_Dolor"];


            if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
                //Recuperamos el id de la cita
                $id=$_GET['id'];
                //Cita
                $idDoctor = $_POST["doctor"];
                $fechaCita= $_POST['fecha'];
                $hora= $_POST['hora'];
        
                //Formulario
                $Sintomas=$_POST["sintomas"];
                $Alergias=$_POST["alergias"];
                $Medicamentos=$_POST["medicamentos"];
                $Historial=$_POST["condicion"];
                $Dolor=$_POST["dolor"];

                //Actualizamos la cita y el cuestionario
                $MCitas->ActualizarCita($id,$idDoctor,$fechaCita,$hora);
                $MCuestionario->ActualizarCuestionario($id,$Sintomas,$Alergias,$Medicamentos,$Historial,$Dolor);
        
                //Redireccionamos a la pagina de consultar citas
                header("Location: index.php?accion=consultarCitas");
            
            }


            //Mostramos la vista de actualizar cita
            include 'Vista/actualizarCita.php';
        }



        private function eliminarCita(){
            //Recuperamos el id de la cita
            $id=$_POST['id'];
            //Creamos un modelo para poder eliminar la cita
            $MCuestionario= new Cuestionario($this->conn);
            $MCitas= new Cita($this->conn);
            //Eliminamos la cita y el cuestionario
            $MCuestionario->EliminarCuestionario($id);
            $MCitas->EliminarCita($id);
            //Redireccionamos a la pagina de consultar citas
            header("Location: index.php?accion=consultarCitas");
        }



        





    }

?>